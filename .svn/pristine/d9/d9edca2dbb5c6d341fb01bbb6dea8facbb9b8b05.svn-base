<?php
/***
*  注册分析-宏观数据
***/
namespace Jy_admin\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class RegisterMacroscopicController extends ComController {
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

        /***
         *
         *  注册用户  UserNum
         *  描述：统计所选时期内，每日新增激活的用户数量。
         *
         *  当天游戏用户 UserGame
         *  描述：统计所选时期内，每日新增激活中，有游戏行为的用户数量。
         *
         *  注册游戏率： UserGameRate
         *  描述  当天游戏用户/注册用户。
         *
         *  付费用户  UserPayNum
         *  描述：统计所选时期内，每日新增激活中，有游戏行为的用户数量。
         *
         *  付费次数  PayNum
         *  描述：统计所选时期内，当天注册且当天付费的用户数每日成功充值总次数。
         *
         *  注册付费渗透率  UserNumPayRate
         *  描述：=付费用户/注册用户。
         *
         *  付费金额：PayMoney
         *  描述：即收入，统计所选时期内，当日注册用户成功充值的金额总值。
         *
         *  ARPPU： ARPPU
         *  描述：日ARPPU=当日充值总额度/当日付费用户数量。
         *
         *  破产用户 BankruptcyNum
         *  描述：注册当天有过金币小于0（此处数值可控）的用户数。
         *
         *  破产率  BankruptcyRate
         *  描述 ：注册破产率=破产用户/注册用户。
         ***/

        $whereUserComprehensive = '';
        if($channel != '' ){
            $whereUserComprehensive = 'a.channel = '.$channel.' and  ';
        }

        $whereUserComprehensive  .=   'a.RegisterTM > "'.$timeEndStrtotime.'" and  a.RegisterTM < "'.$timeStartStrtotime.'"';


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

        $UserComprehensiveData =array();
        foreach ($erverDay as $k=>$v){
            $arr = array();
                $vTime =  date('Y-m-d',$v);

                $data  = array();
                foreach ($UserComprehensive as $key =>$val){
                    if($val['t'] == $vTime){
                        $data  = $val;

                    }
                }

            if(!empty($data)){
                $UserComprehensiveData[$k]['UserNum']           =           $data['UserNum'];
                $UserComprehensiveData[$k]['UserPayNum']        =           $data['UserPayNum'];
                $UserComprehensiveData[$k]['UserNumPayRate']    =           $data['UserNumPayRate'];
                $UserComprehensiveData[$k]['UserGame']          =           $data['UserGame'];
                $UserComprehensiveData[$k]['UserGameRate']      =           $data['UserGameRate'];
                $UserComprehensiveData[$k]['PayNum']            =           $data['PayNum'];
                $UserComprehensiveData[$k]['PayMoney']          =           $data['PayMoney'];
                $UserComprehensiveData[$k]['ARPPU']             =           $data['ARPPU'];
                $UserComprehensiveData[$k]['BankruptcyNum']     =           $data['BankruptcyNum'];
                $UserComprehensiveData[$k]['BankruptcyRate']    =           $data['ARPPU'];
            }else{
                $UserComprehensiveData[$k]['UserNum']           =           0;
                $UserComprehensiveData[$k]['UserPayNum']        =           0;
                $UserComprehensiveData[$k]['UserNumPayRate']    =           0;
                $UserComprehensiveData[$k]['UserGame']          =           0;
                $UserComprehensiveData[$k]['UserGameRate']      =           0;
                $UserComprehensiveData[$k]['PayNum']            =           0;
                $UserComprehensiveData[$k]['PayMoney']          =           0;
                $UserComprehensiveData[$k]['ARPPU']             =           0;
                $UserComprehensiveData[$k]['BankruptcyNum']     =           0;
                $UserComprehensiveData[$k]['BankruptcyRate']    =           0;
            }
            $UserComprehensiveData[$k]['date'] = date('n月j日',$v);


        }
        $this->assign('datemin',$datemin);
        $this->assign('day',$timeEndDay);
        $this->assign('info',$UserComprehensiveData);
        $this->display();
    }

}