<?php
/***
 *  实时收入
 ***/
namespace Jy_admin\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class RealTimeRevenueController extends ComController {
    public function index(){
         $time    = time();
         $time    = date('Y-m-d');
         $time    = strtotime($time);
         $DayTime = 24*60*60;
         //搜索类型 1-实时收入 2-付费用户 3-次数
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
            $dataFiled = array(
                'date_format(CallbackTime,"%H") as i',
                'sum(Price) as Num',
            );
            $info['Title'] = "实时收入";
            $info['Symbol'] = "￥";
        }elseif ($Type == 2){
            $dataFiled = array(
                'date_format(CallbackTime,"%H") as i',
                'count(distinct playerid) Num',
            );
            $info['Title'] = "付费用户";
            $info['Symbol'] = "人";
        }elseif ($Type == 3){
            $dataFiled = array(
                'date_format(CallbackTime,"%H") as i',
                'count(Id) as Num',
            );
            $info['Title'] = "付费次数";
            $info['Symbol'] = "次";
        }
        //当天
        $SameUserOrderInfo = M('jy_users_order_info')
                              ->where('Status = 2 and CallbackTime  < str_to_date("'.$SameDayEndTime.'","%Y-%m-%d %H:%i:%s")  
                                       and CallbackTime >= str_to_date("'.$SameDayStartTime.'","%Y-%m-%d %H:%i:%s")')
                              ->field($dataFiled)
                              ->group('i')
                              ->select();
         //一天前
        $OneUserOrderInfo = M('jy_users_order_info')
            ->where(' Status = 2 and  CallbackTime  < str_to_date("'.$OneDayStartTime.'","%Y-%m-%d %H:%i:%s")  
                                       and CallbackTime >= str_to_date("'.$OneDayEndTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($dataFiled)
            ->group('i')
            ->select();
        //七天前
        $SevenUserOrderInfo = M('jy_users_order_info')
            ->where(' Status = 2 and  CallbackTime  < str_to_date("'.$SevenDayStartTime.'","%Y-%m-%d %H:%i:%s")  
                                       and CallbackTime >= str_to_date("'.$SevenDayEndTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($dataFiled)
            ->group('i')
            ->select();
        foreach ($SameUserOrderInfo  as $k=>$v) $SameUserOrderInfoSort[$v['i']]  =  $v;
        foreach ($OneUserOrderInfo   as $k=>$v) $OneUserOrderInfoSort[$v['i']]    =  $v;
        foreach ($SevenUserOrderInfo as $k=>$v) $SevenUserOrderInfoSort[$v['i']]  =  $v;
        $dataSameUserOrderInfo    =     array();
        $dataOneUserOrderInfo     =     array();
        $dataSevenUserOrderInfo   =     array();
        foreach ($timeinterval as $k=>$v){
            //当天
            if($SameUserOrderInfoSort[$v['num']]){
                $dataSameUserOrderInfo[$k] =   intval($SameUserOrderInfoSort[$v['num']]['Num']);
            }else{
                $dataSameUserOrderInfo[$k] = 0;
            }
            //一天
            if($OneUserOrderInfoSort[$v['num']]){
                $dataOneUserOrderInfo[$k] =  intval($OneUserOrderInfoSort[$v['num']]['Num']) ;
            }else{
                $dataOneUserOrderInfo[$k] = 0;
            }
            //七天
            if($SevenUserOrderInfoSort[$v['num']]){
                $dataSevenUserOrderInfo[$k] =  intval($SevenUserOrderInfoSort[$v['num']]['Num']) ;
            }else{
                $dataSevenUserOrderInfo[$k] = 0;
            }
         }
         $info['Same']   =   json_encode($dataSameUserOrderInfo);
         $info['One']    =   json_encode($dataOneUserOrderInfo);
         $info['Seven']  =   json_encode($dataSevenUserOrderInfo);
         $this->assign('erverDay',json_encode($erverDay));
         $this->assign('Type',$Type);
         $this->assign('info',$info);
         $this->display();
    }


}