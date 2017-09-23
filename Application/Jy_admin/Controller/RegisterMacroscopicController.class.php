<?php
/***
*  注册分析-宏观数据
***/
namespace Jy_admin\Controller;
use Think\Controller;
use Think\Model;
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
        $where  =   'a.regtime  >  str_to_date("'.$timeEndStrtotime.'","%Y-%m-%d %H:%i:%s") and  regtime  < str_to_date("'.$timeStartStrtotime.'","%Y-%m-%d %H:%i:%s")';
        $RegisterMacrodataFile = array(
                'date_format(a.regtime,"%Y-%m-%d") as t',
                'count(a.playerid) as  UserNum',
                'count(distinct c.playerid) UserGame',
                'count(distinct c.playerid)/count(a.playerid) as UserGameRate',
                'count(distinct b.playerid) UserPayNum',
                'count(b.playerid)  PayNum',
                'count(distinct b.playerid)/count(a.playerid)  as UserNumPayRate',
                'count(b.Price) PayMoney',
                'count(distinct d.playerid) as BankruptcyNum',
                'count(distinct d.playerid)/count(a.playerid)  as BankruptcyRate',

        );
        $UserComprehensive = M('game_account as a')
                            ->join('jy_users_order_info as b on a.playerid = b.playerid and b.status = 2','left')
                            ->join('jy_users_currency_stream  as c on a.playerid = c.playerid and c.CurrencyType = 1 and c.Type = 1','left')
                            ->join('jy_users_bankruptcy as d on a.playerid = c.playerid','left')
                            ->field($RegisterMacrodataFile)
                            ->group('t')
                            ->where($where)
                            ->select();
        $newData = array();
        foreach ($UserComprehensive as $k=>$v){
            $newData[$v['t']] = $v;
        }
        $info = array();
        foreach ($erverDay as $k=>$v){
             $DateTime = date('Y-m-d',$v);
             $value = $newData[$DateTime];
            $info[$k]['DateTime'] = date('n月j日',$v);
             if(!empty($value)){
                 $info[$k]['UserNum']           =   $value['UserNum'];
                 $info[$k]['UserGame']          =   $value['UserGame'];
                 $info[$k]['UserGameRate']      =   $value['UserGameRate'];
                 $info[$k]['UserPayNum']        =   $value['UserPayNum'];
                 $info[$k]['PayNum']            =   $value['PayNum'];
                 $info[$k]['UserNumPayRate']    =   $value['UserNumPayRate'];
                 $info[$k]['PayMoney']          =   $value['PayMoney'];
                 $info[$k]['BankruptcyNum']     =   $value['BankruptcyNum'];
                 $info[$k]['BankruptcyRate']    =   $value['BankruptcyRate'];
             }else{
                 $info[$k]['UserNum']           =   0;
                 $info[$k]['UserGame']          =   0;
                 $info[$k]['UserGameRate']      =   0;
                 $info[$k]['UserPayNum']        =   0;
                 $info[$k]['PayNum']            =   0;
                 $info[$k]['UserNumPayRate']    =   0;
                 $info[$k]['PayMoney']          =   0;
                 $info[$k]['BankruptcyNum']     =   0;
                 $info[$k]['BankruptcyRate']    =   0;
             }
        }
        $this->assign('datemin',$datemin);
        $this->assign('day',$timeEndDay);
        $this->assign('info',$info);
        $this->display();
    }



}