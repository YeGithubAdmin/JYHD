<?php
/***
 *  付费分析-宏观数据
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

        $channel = I('param.channel','','trim');                                                                    //渠道
        $timeEndDay = I('param.day',7,'intval');
        $time = date('Y-m-d', time());                                                                      //当前时间
        $btime = date('Y-m-d', time() - 24 * 60 * 60);                                          //默认当前昨天
        $datemin = I('param.datemin', $btime, 'trim');                                                            //搜索时间
        if ($datemin == $time) {
            $datemin = $btime;
        }

        $dayTime = 24 * 60 * 60;
        $strtotime = strtotime($datemin);
        $timeStart= $datemin;                                                                                   //时间段：前天
        $timeStartStrtotime = date('Y-m-d', strtotime($timeStart) + $dayTime);
        $timeEnd = date('Y-m-d', $strtotime - ($timeEndDay-1)* $dayTime);                      //时间段：前8天
        $timeEndStrtotime = date('Y-m-d', strtotime($timeEnd) - $timeEnd);

        $erverDay = array();
        //八天时间
        for($i=($timeEndDay-1);$i>=0;$i--){
            $erverDayTime = $strtotime-$i*$dayTime;
            if($erverDayTime >= strtotime($timeEnd)){
                $erverDay[$i] = $erverDayTime;
            }
        }
        //排序数组
        ksort($erverDay);




        $PayInfo = M('TuserInfo')
                    ->where('')
                    ->field('')
                    ->select();




        $whereUserComprehensive  =   'a.RegisterTM > "'.$timeEndStrtotime.'" and  a.RegisterTM < "'.$timeStartStrtotime.'"';


        $UserComprehensive = M('tuserinfo as a')
            ->join('Web_RMBCost as b on a.UserID = b.Users_ids and  b.PaySuccess = 1','LEFT')
            ->join('web_moneychangelog as c on a.UserID = c.UserID and c.ChangeType  = 1','LEFT')
            ->join('jy_UserbankruptcyLog as d on d.UserID = a.UserID','LEFT')
            ->where($whereUserComprehensive)
            ->field('date_format(a.RegisterTM,"%Y-%m-%d") as t,count(a.UserID) as UserNum,
                    unix_timestamp(a.RegisterTM) as time,count(distinct b.Users_ids) as UserPayNum,count(distinct b.Users_ids)/count(a.UserID) as UserNumPayRate
                    ,count(c.ChangeType) as UserGame,count(c.ChangeType)/count(a.UserID) as  UserGameRate 
                    ,count(b.Users_ids) as PayNum,count(b.PayMoney) as PayMoney,count(b.PayMoney)/count(distinct b.Users_ids) as ARPPU
                    ,count(distinct d.UserID) as BankruptcyNum,count(distinct d.UserID)/count(a.UserID) as BankruptcyRate')
            ->group('t')
            ->order('a.RegisterTM asc')
            ->select();



        $this->assign('datemin',$datemin);
        $this->assign('day',$timeEndDay);
        $this->assign('info',$UserComprehensiveData);
        $this->display();
    }
    //统计脚本
    public function Script(){
        $dateTimeStart =  date('Y-m-d',time()-2*24*60*60);
        $dateTimeEnd   = date('Y-m-d',time());
        /***
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
        $PayInfo = M('TuserInfo as a')
            ->join('web_rmbcost as b on a.UserID = b.Users_ids and  b.LastLoginTM >'.$dateTimeEnd.'   and   b.LastLoginTM >'.$dateTimeStart,'LEFT')
            ->join('web_vuserloginlist as c on c.UserID = a.UserID and  b.PaySuccess = 1  and  b.BackTime >'.$dateTimeEnd.'   and   b.BackTime >'.$dateTimeStart,'LEFT')
            ->field('
            ,date_format(b.BackTime,"%Y-%m-%d as t")
            ,num(a.PayMoney) as DailyIncome
            ,count(distinct PayID) as PayNum
            ,count(distinct Users_ids)/count(distinct UserID) PayRate
            ,num(b.PayMoney)/count(distinct Users_ids) as ARPPU,
            ')
            ->select();
        $dataInfo = M('TuserInfo as a')
                    ->join('web_rmbcost as b on a.UserID = b.Users_ids and  b.LastLoginTM >'.$dateTimeEnd.'   and   b.LastLoginTM >'.$dateTimeStart,'LEFT')
                    ->where('a.RegisterTM > '.$dateTimeEnd.' and '.$dateTimeStart.' < a.RegisterTM')
                    ->field('')
                    ->select();

    }

}