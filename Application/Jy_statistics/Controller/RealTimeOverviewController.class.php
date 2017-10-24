<?php
/***
 *  实时概况
 ***/
namespace Jy_statistics\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class RealTimeOverviewController extends ComController {
    public function index(){
         $time    = time();
         $time    = date('Y-m-d');
         $time    = strtotime($time);
         $DayTime = 24*60*60;

         //搜索类型 1-注册 2-活跃
        $Type = I('param.Type',1,'intval');


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

         if($Type == 1){
             //注册
             $SameDayregisterField  = array(
                 'date_format(regtime,"%H") as i',
                 'count(playerid) as UserNum',
             );
             //当天
             $SameDayregister  = M('game_account')
                 ->where('regtime < "'.$SameDayEndTime.'"  and  "'.$SameDayStartTime.'" <= regtime')
                 ->field($SameDayregisterField)
                 ->group('i')
                 ->select();
             //一天
             $OneDayregister  = M('game_account')
                 ->where('regtime < "'.$OneDayEndTime.'"  and  "'.$OneDayStartTime.'" <= regtime')
                 ->field($SameDayregisterField)
                 ->group('i')
                 ->select();
             //七天前
             $SevenDayregister  = M('game_account')
                 ->where('regtime < "'.$SevenDayEndTime.'"  and  "'.$SevenDayStartTime.'" <= regtime')
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

         }elseif ($Type == 2){
            //活跃
             $SameDayActiveField  = array(
                 'FROM_UNIXTIME(login_time,"%H") as i',
                 'count(distinct playerid) as UserNum',
             );

             //当天
             $SameDayactive  = M('game_login_action')
                 ->where('login_time <    str_to_date("'.$SameDayEndTime.'","%Y-%m-%d %H:%i:%d")  and    str_to_date("'.$SameDayStartTime.'","%Y-%m-%d %H:%i:%d")  <= login_time')
                 ->field($SameDayActiveField)
                 ->group('i')
                 ->select();

             //一天
             $OneDayActive  = M('game_login_action')
                 ->where('login_time <  str_to_date("'.$OneDayEndTime.'","%Y-%m-%d %H:%i:%d")  and   str_to_date("'.$OneDayStartTime.'","%Y-%m-%d %H:%i:%d") <= login_time')
                 ->field($SameDayActiveField)
                 ->group('i')
                 ->select();

             //七天前
             $SevenDayActive  = M('game_login_action')
                 ->where('login_time <   str_to_date("'.$SevenDayEndTime.'","%Y-%m-%d %H:%i:%d")   and   str_to_date("'.$SevenDayStartTime.'","%Y-%m-%d %H:%i:%d")  <= login_time')
                 ->field($SameDayActiveField)
                 ->group('i')
                 ->select();
             $SameDayactiveSort  = array();
             $dataSameDayactive = array();
             $OneDayactiveSort   = array();
             $dataOneDayactive   = array();
             $SevenDayactiveSort = array();
             $dataSevenDayactive= array();
             foreach ($SameDayactive  as $k=>$v) $SameDayactiveSort[$v['i']]=$v;
             foreach ($OneDayActive   as $k=>$v) $OneDayactiveSort[$v['i']]=$v;
             foreach ($SevenDayActive as $k=>$v) $SevenDayactiveSort[$v['i']]=$v;
             foreach ($timeinterval as $k=>$v){
                 //当天
                 if($SameDayactiveSort[$v['num']]){
                     $dataSameDayactive[$k] =   intval($SameDayactiveSort[$v['num']]['UserNum']);
                 }else{
                     $dataSameDayactive[$k] = 0;
                 }
                 //一天
                 if($OneDayactiveSort[$v['num']]){

                     $dataOneDayactive[$k] =  intval($OneDayactiveSort[$v['num']]['UserNum']) ;
                 }else{
                     $dataOneDayactive[$k] = 0;
                 }
                 //七天
                 if($SevenDayactiveSort[$v['num']]){
                     $dataSevenDayactive[$k] =  intval($SevenDayactiveSort[$v['num']]['UserNum']) ;
                 }else{
                     $dataSevenDayactive[$k] = 0;
                 }
             }
             $info['Same']   =   json_encode($dataSameDayactive);
             $info['One']    =   json_encode($dataOneDayactive);
             $info['Seven']  =   json_encode($dataSevenDayactive);
             $info['Title']  = "活跃";

         }
         $this->assign('erverDay',json_encode($erverDay));
         $this->assign('Type',$Type);
         $this->assign('info',$info);
         $this->display();
    }


}