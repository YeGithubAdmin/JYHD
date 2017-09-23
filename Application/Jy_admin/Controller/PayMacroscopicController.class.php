<?php
/***
 *  付费分析
 *
 *  日收入  DailyIncome
 *  描述：当日收入总额。
 *
 *  付费用户数 UserPayNum
 *  描述：当日付费用户数。
 *
 *  付费次数： PayNum
 *  描述：当日付费次数  。
 *
 *  活跃付费渗透率  PayRate
 *  描述：每日成功付费用户占当日活跃用户的比例。
 *
 *  ARPPU： ARPPU
 *  描述：日ARPPU=当日充值总额度/当日付费用户数量。
 *
 *  首付用户数  FirstUserNum
 *  描述：当日首次付费用户数量。
 *
 *  首付金额  FirstDailyIncome
 *  描述 ：当日首付总额。
 ***/
namespace Jy_admin\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class PayMacroscopicController extends ComController {
    //列表
    public function index()
    {

        $timeEndDay = I('param.day',7,'intval');
        $time = date('Y-m-d', time());                                                                      //当前时间
        $btime = date('Y-m-d', time() - 24 * 60 * 60);                                          //默认当前昨天
        $datemin = I('param.datemin', $btime, 'trim');                                                            //搜索时间
        if ($datemin == $time) {
            $datemin = $btime;
        }
        $dayTime = 24 * 60 * 60;
        $strtotime = strtotime($datemin);
        $EndTime   = date('Y-m-d H:i:s',$strtotime);
        $StartTime = date('Y-m-d H:i:s',$strtotime - $timeEndDay* $dayTime);

        $erverDay = array();
        //八天时间
        for($i=($timeEndDay-1);$i>=0;$i--){
            $erverDayTime = $strtotime-$i*$dayTime;
            if($erverDayTime >= strtotime($strtotime - $timeEndDay* $dayTime)){
                $erverDay[$i] = $erverDayTime;
            }
        }
        //排序数组
        ksort($erverDay);
        $infoField = array(
            'date_format(DateTime,"%Y-%m-%d") as t',
            'PayNum',
            'UserPayNum',
            'TotalMoney',
            'PayNum/ActiveNum as ActiveRate',
            'First',
            'TotalMoney/UserPayNum as ARPPU',
            'FirstMoney',
        );
        $info =  M('jy_statistics_users_pay')
                ->where('DateTime <= str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
                ->field($infoField)
                ->select();

        $infoSort = array();
        foreach ($info as $k=>$v){
            $info[$v['t']]  = $v;
        }
        $infoData = array();
        foreach ($erverDay as $k=>$v){
            $dateTime = date('Y-m-d',$v);
            $infoData[$k]['DateTime'] =   date('n月j日',$v);
            if(!empty($infoSort[$dateTime])){
                $infoData[$k]['PayNum']         =       $infoSort[$dateTime]['PayNum'];
                $infoData[$k]['UserPayNum']     =       $infoSort[$dateTime]['UserPayNum'];
                $infoData[$k]['TotalMoney']     =       $infoSort[$dateTime]['TotalMoney'];
                $infoData[$k]['ActiveRate']     =       $infoSort[$dateTime]['ActiveRate'];
                $infoData[$k]['First']          =       $infoSort[$dateTime]['First'];
                $infoData[$k]['FirstMoney']          =       $infoSort[$dateTime]['FirstMoney'];
                $infoData[$k]['ARPPU']          =       $infoSort[$dateTime]['ARPPU'];
                $infoData[$k]['FirstMoney']     =       $infoSort[$dateTime]['FirstMoney'];
            }else{
                $infoData[$k]['PayNum']         =       0;
                $infoData[$k]['UserPayNum']     =       0;
                $infoData[$k]['TotalMoney']     =       0;
                $infoData[$k]['ActiveRate']     =       0;
                $infoData[$k]['FirstMoney']     =       0;
                $infoData[$k]['First']          =       0;
                $infoData[$k]['ARPPU']          =       0;
                $infoData[$k]['FirstMoney']     =       0;
            }
        }

        $this->assign('datemin',$datemin);
        $this->assign('day',$timeEndDay);
        $this->assign('info',$infoData);
        $this->display();
    }


    //支付类型
    public function PayType(){
        $timeEndDay = I('param.day',7,'intval');
        $time = date('Y-m-d', time());                                                                      //当前时间
        $btime = date('Y-m-d', time() - 24 * 60 * 60);                                          //默认当前昨天
        $datemin = I('param.datemin', $btime, 'trim');                                                            //搜索时间
        if ($datemin == $time) {
            $datemin = $btime;
        }
        $dayTime = 24 * 60 * 60;
        $strtotime = strtotime($datemin);
        $EndTime   = date('Y-m-d H:i:s',$strtotime);
        $StartTime = date('Y-m-d H:i:s',$strtotime - $timeEndDay* $dayTime);

        $erverDay = array();
        //八天时间
        for($i=($timeEndDay-1);$i>=0;$i--){
            $erverDayTime = $strtotime-$i*$dayTime;
            if($erverDayTime >= strtotime($strtotime - $timeEndDay* $dayTime)){
                $erverDay[$i] = $erverDayTime;
            }
        }
        //排序数组
        ksort($erverDay);
        $infoField = array(
            'date_format(DateTime,"%Y-%m-%d") as t',
            'OrderTotal',
            'alipay/OrderTotal as alipay',
            'weixin/OrderTotal as weixin',
            'iappay/OrderTotal as iappay',

        );
        $info =  M('jy_statistics_users_pay')
            ->where('DateTime <= str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($infoField)
            ->select();

        $infoSort = array();
        foreach ($info as $k=>$v){
            $info[$v['t']]  = $v;
        }
        $infoData = array();
        foreach ($erverDay as $k=>$v){
            $dateTime = date('Y-m-d',$v);
            $infoData[$k]['DateTime'] =   date('n月j日',$v);
            if(!empty($infoSort[$dateTime])){
                $infoData[$k]['OrderTotal']         =       $infoSort[$dateTime]['OrderTotal'];
                $infoData[$k]['alipay']     =       $infoSort[$dateTime]['alipay'];
                $infoData[$k]['weixin']     =       $infoSort[$dateTime]['weixin'];
                $infoData[$k]['iappay']     =       $infoSort[$dateTime]['iappay'];

            }else{
                $infoData[$k]['OrderTotal']     =       0;
                $infoData[$k]['alipay']         =       0;
                $infoData[$k]['weixin']         =       0;
                $infoData[$k]['iappay']         =       0;
            }
        }

        $this->assign('datemin',$datemin);
        $this->assign('day',$timeEndDay);
        $this->assign('info',$infoData);
        $this->display();
    }

    public function Goods(){

        $infoField = array(
            'a.name',
            'if(b.SuccessNum,b.SuccessNum,0) as SuccessNum',
            'if(b.TotalNum,b.TotalNum,0) as TotalNum',
            'if(b.SuccessNum/b.TotalNum,b.SuccessNum/b.TotalNum,0) as SuccessRate'
        );
        $info =  M('jy_goods_all as a')
                ->join('jy_statistics_goods as b on b.GoodsID = a.Id','left')
                ->field($infoField)
                ->where(' a.ShowType = 1  and  a.IsDel = 1')
                ->group('a.Id')
                ->select();
        $this->assign('info',$info);
        $this->display();
    }

    //统计脚本
    public function Calculation(){
            //统计时间
            $time = strtotime(date('Y-m-d'),time());
            $day  = 24*60*60;
            $EndTime   = date('Y-m-d H:i:s',$time);
            $StartTime = date('Y-m-d H:i:s',$time-$day);

            //活跃用户
            $ActiveInfoField = array(
                'count(distinct playerid) as ActiveNum',
            );
            $ActiveInfo = M('jy_users_login_log')
                         ->where('LastTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and  str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  <= LastTime')
                         ->field($ActiveInfoField)
                         ->select();
            //计算订单
            $UsersOrderFiled = array(
                'count(Id) as OrderTotal',
                'count(if(Status = 2,playerid,null)) as PayNum',
                'count(distinct if(Status = 2,playerid,null)) as UserPayNum',
                'sum(if(Status = 2,Price,null)) as TotalMoney',
                'count(if(Status = 2 and PayPlatform = 1,Id,null)) as alipay',
                'count(if(Status = 2 and PayPlatform = 2,Id,null)) as weixin',
                'count(if(Status = 2 and PayPlatform = 3,Id,null)) as iappay',
                'count(if(Status = 2 and IsFirst = 2,Id,null)) as First',
                'sum(if(Status = 2 and IsFirst = 2,Price,0)) as FirstMoney',
            );
            $UsersOrder = M('jy_users_order_info')
                          ->where('FoundTime  <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  and  str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  <= FoundTime')
                          ->field($UsersOrderFiled)
                          ->select();
            $dataStatisticsUsersPay = array(
                'OrderTotal'        =>  $UsersOrder[0]['OrderTotal'],
                'PayNum'            =>  $UsersOrder[0]['PayNum'],
                'UserPayNum'        =>  $UsersOrder[0]['UserPayNum'],
                'TotalMoney'        =>  $UsersOrder[0]['TotalMoney'],
                'alipay'            =>  $UsersOrder[0]['alipay'],
                'weixin'            =>  $UsersOrder[0]['weixin'],
                'iappay'            =>  $UsersOrder[0]['iappay'],
                'ActiveNum'         =>  $ActiveInfo[0]['ActiveNum'],
                'DateTime'          =>  $StartTime,
            );
            $addStatisticsUsersPay = M('jy_statistics_users_pay')->add($dataStatisticsUsersPay);
    }

}