<?php
/**
 *  实时数据
 ***/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;

defined('THINK_PATH') or exit('Access Defined!');
class RealtimeDataController extends ComController {
    //实时在线
    public function OnLine(){
         $time    = date('Y-m-d');
         $time         = strtotime($time);
         $RealtimeData = D('RealtimeData');
         $DayTime = 24*60*60;
         //场次
         $Type = I('param.Type',0,'intval');
        //当天时间
         $SameDayStartTime   =  date('Y-m-d H:i:s',$time);
         $SameDayEndTime     =  date('Y-m-d H:i:s',$time+$DayTime);
         //一天前
         $OneDayStartTime    =  date('Y-m-d H:i:s',$time-$DayTime);
         $OneDayEndTime      =  date('Y-m-d H:i:s',$time);
         $search['Channel'] = I('param.Channel','','trim');           //登录渠道号
        //查询渠道
         $ChannelFiled = array(
            'account',
            'name',
         );
         $Channel = M('jy_admin_users')
            ->where('channel = 2 and IsDel = 1')
            ->field($ChannelFiled)
            ->select();
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
         $Samewhere = $Screenings.' `DateTime` <  STR_TO_DATE("'.$SameDayEndTime.'","%Y-%m-%d %H:%i:%s") 
                       AND   `DateTime`  >= STR_TO_DATE("'.$SameDayStartTime.'","%Y-%m-%d %H:%i:%s")';
         $SameDayregister =  $RealtimeData->catOnLine($Samewhere);
          //一天
         $Onewhere =  $Screenings.' `DateTime` <  STR_TO_DATE("'.$OneDayEndTime.'","%Y-%m-%d %H:%i:%s") 
                     AND   `DateTime`  >= STR_TO_DATE("'.$OneDayStartTime.'","%Y-%m-%d %H:%i:%s")';
         $OneDayregister = $RealtimeData->catOnLine($Onewhere);
         $SameDayregisterSort  = array();
         $dataSameDayregister  = array();
         $OneDayregisterSort   = array();
         $dataOneDayregister   = array();
         foreach ($SameDayregister  as $k=>$v) $SameDayregisterSort[$v['i']]=$v;
         foreach ($OneDayregister   as $k=>$v) $OneDayregisterSort[$v['i']]=$v;
         foreach ($timeinterval as $k=>$v){
             //当天
             if($SameDayregisterSort[$v['num']]){
                 $dataSameDayregister[$k] =   intval($SameDayregisterSort[$v['num']]['UserNum']);
             }else if(date("H") >= $k){
                 $dataSameDayregister[$k] = 0;
             }
             //一天
             if($OneDayregisterSort[$v['num']]){
                 $dataOneDayregister[$k] =  intval($OneDayregisterSort[$v['num']]['UserNum']) ;
             }else{
                 $dataOneDayregister[$k] = 0;
             }

         }
         $info['Same']   =   json_encode($dataSameDayregister);
         $info['One']    =   json_encode($dataOneDayregister);
         $info['Title']  = "";
         $this->assign('erverDay',json_encode($erverDay));
         $this->assign('Channel',$Channel);
         $this->assign('search',$search);
         $this->assign('Type',$Type);
         $this->assign('info',$info);
         $this->display();
    }


}