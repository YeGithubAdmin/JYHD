<?php
/***
 *  实时在线
 ***/
namespace Jy_admin\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class RealTimeOnlineController extends ComController {
    public function index(){
         $time    = time();
         $time    = date('Y-m-d');
         $time    = strtotime($time);
         $DayTime = 24*60*60;
         //搜索类型 1-注册 2-活跃
         $Type = I('param.Type','','intval');
        //当天时间
         $SameDayStartTime   =  date('Y-m-d H:i:s',$time);
         $SameDayEndTime     =  date('Y-m-d H:i:s',$time+$DayTime);
         //一天前
         $OneDayStartTime    =  date('Y-m-d H:i:s',$time-$DayTime);
         $OneDayEndTime      =  date('Y-m-d H:i:s',$time);
         //七天前
         $SevenDayStartTime  =  date('Y-m-d H:i:s',$time-$DayTime*7);
         $SevenDayEndTime    =  date('Y-m-d H:i:s',$time-$DayTime*6);
         $timeinterval = array();
         $erverDay = array();
         for ($i=0;$i<=23;$i++){
             $erverDay[$i] = $i.'点';
             $timeinterval[$i]['num'] = $i;

         }
         $info = array();
             //注册
             $SameDayregisterField  = array(
                 'DateTime',
                 'date_format(DateTime,"%H") as i',
                 'UserNum',
             );
             //当天
             $SameDayregister  = M('jy_real_time_online')
                 ->where('DateTime < "'.$SameDayEndTime.'"  and  "'.$SameDayStartTime.'" <= DateTime')
                 ->field($SameDayregisterField)
                 ->order('DateTime desc')
                 ->group('i')
                 ->select();

             dump($SameDayregister);

             //一天
             $OneDayregister  = M('jy_real_time_online')
                 ->where('DateTime < "'.$OneDayEndTime.'"  and  "'.$OneDayStartTime.'" <= DateTime')
                 ->field($SameDayregisterField)
                 ->group('i')
                 ->select();
             //七天前
             $SevenDayregister  = M('jy_real_time_online')
                 ->where('DateTime < "'.$SevenDayEndTime.'"  and  "'.$SevenDayStartTime.'" <= DateTime')
                 ->field($SameDayregisterField)
                 ->group('i')
                 ->select();
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
         $this->assign('Type',$Type);
         $this->assign('info',$info);
         $this->display();
    }


}