<?php
/***
 *  实时在线
 ***/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;

defined('THINK_PATH') or exit('Access Defined!');
class RealTimeOnlineController extends ComController {
    public function index(){
         $time    = date('Y-m-d');
         $time    = strtotime($time);
         $DayTime = 24*60*60;
         //场次
         $Type = I('param.Type',0,'intval');
        //当天时间
         $SameDayStartTime   =  date('Y-m-d H:i:s',$time);
         $SameDayEndTime     =  date('Y-m-d H:i:s',$time+$DayTime);
         //一天前
         $OneDayStartTime    =  date('Y-m-d H:i:s',$time-$DayTime);
         $OneDayEndTime      =  date('Y-m-d H:i:s',$time);
         //七天前
         $SevenDayStartTime  =  date('Y-m-d H:i:s',$time-$DayTime*7);
         $SevenDayEndTime    =  date('Y-m-d H:i:s',$time-$DayTime*6);
         $search['Channel'] = I('param.Channel','','trim');           //登录渠道号
        //查询渠道
         $ChannelFiled = array(
            'account',
            'name',
         );
         $Channel = M('jy_admin_users')
            ->where('channel = 2')
            ->field($ChannelFiled)
            ->select();
         $model = new Model();
         $timeinterval = array();
         $erverDay = array();
         for ($i=0;$i<=23;$i++){
             $erverDay[$i] = $i.'点';
             $timeinterval[$i]['num'] = $i;
         }
         $Screenings = '';
         //场次
         if($Type > 0){
             $Screenings .= '`Screenings` = '.$Type.' AND ';
         }
         //渠道
         if($search['Channel'] != ''){
             $Screenings .= ' `Channel` = "'.$search['Channel'].'"  AND ';
         }
         $info = array();
             //当天
         $SameDayregister = $model->query('SELECT a.`Id`,a.`UserNum`,DATE_FORMAT(`DateTime`,"%k") AS i 
                                              FROM (SELECT `Id`,`UserNum`,`DateTime` FROM jy_real_time_online 
                                              WHERE  '.$Screenings.' `DateTime` <  STR_TO_DATE("'.$SameDayEndTime.'","%Y-%m-%d %H:%i:%s") 
                                              AND   `DateTime`  >= STR_TO_DATE("'.$SameDayStartTime.'","%Y-%m-%d %H:%i:%s")
                                              ORDER BY `Id` DESC ) AS a  
                                              GROUP BY i ORDER BY i');
             //一天
         $OneDayregister = $model->query('SELECT a.`Id`,a.`UserNum`,DATE_FORMAT(`DateTime`,"%H") AS i 
                                              FROM (SELECT `Id`,`UserNum`,`DateTime` FROM jy_real_time_online 
                                              WHERE '.$Screenings.' `DateTime` <  STR_TO_DATE("'.$OneDayEndTime.'","%Y-%m-%d %H:%i:%s") 
                                              AND   `DateTime`  >= STR_TO_DATE("'.$OneDayStartTime.'","%Y-%m-%d %H:%i:%s")
                                              ORDER BY `Id` DESC) AS a  
                                              GROUP BY i ORDER BY i');

             //七天前
         $SevenDayregister = $model->query('SELECT a.`Id`,a.`UserNum`,DATE_FORMAT(`DateTime`,"%H") AS i 
                                              FROM (SELECT `Id`,`UserNum`,`DateTime` FROM jy_real_time_online 
                                              WHERE '.$Screenings.' `DateTime` <  STR_TO_DATE("'.$SevenDayEndTime.'","%Y-%m-%d %H:%i:%s") 
                                              AND   `DateTime`  >= STR_TO_DATE("'.$SevenDayStartTime.'","%Y-%m-%d %H:%i:%s")
                                              ORDER BY `Id` DESC ) AS a  
                                              GROUP BY i ORDER BY i');
         $SameDayregisterSort  = array();
         $dataSameDayregister  = array();
         $OneDayregisterSort   = array();
         $dataOneDayregister   = array();
         $SevenDayregisterSort = array();
         $dataSevenDayregister = array();
         foreach ($SameDayregister  as $k=>$v) $SameDayregisterSort[$v['i']]=$v;
         foreach ($OneDayregister   as $k=>$v) $OneDayregisterSort[$v['i']]=$v;
         foreach ($SevenDayregister as $k=>$v) $SevenDayregisterSort[$v['i']]=$v;
         foreach ($timeinterval as $k=>$v){
             //当天
             if($SameDayregisterSort[$v['num']]){
                 $dataSameDayregister[$k] =   intval($SameDayregisterSort[$v['num']]['UserNum']);
             }else{
                 $dataSameDayregister[$k] = 0;
             }
             //一天
             if($OneDayregisterSort[$v['num']]){
                 $dataOneDayregister[$k] =  intval($OneDayregisterSort[$v['num']]['UserNum']) ;
             }else{
                 $dataOneDayregister[$k] = 0;
             }
             //七天
             if($SevenDayregisterSort[$v['num']]){
                 $dataSevenDayregister[$k] =  intval($SevenDayregisterSort[$v['num']]['UserNum']) ;
             }else{
                 $dataSevenDayregister[$k] = 0;
             }
         }
         $info['Same']   =   json_encode($dataSameDayregister);
         $info['One']    =   json_encode($dataOneDayregister);
         $info['Seven']  =   json_encode($dataSevenDayregister);
         $info['Title']  = "注册";
         $this->assign('erverDay',json_encode($erverDay));
         $this->assign('Channel',$Channel);
         $this->assign('search',$search);
         $this->assign('Type',$Type);
         $this->assign('info',$info);
         $this->display();
    }


}