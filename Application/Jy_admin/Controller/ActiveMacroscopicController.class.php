<?php
/***
*  活跃分析-宏观数据
***/
namespace Jy_admin\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class ActiveMacroscopicController extends ComController {
    //列表
    public function index()
    {

                                                                     //渠道
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
        *  DAU  UserNum
        *  描述：日活跃，统计所选时期内，每日成功登录游戏的玩家数量。
        *
        *  WAU  WAU
        *  描述：统计所选时期内，当日往前推7日（当日计入天数）期间内，登陆过游戏的玩家总数量，按照玩家ID去重。
        *
        *  MAU  MAU
        *  描述：统计所选时期内，当日往前推30日（当日计入天数）期间内，登陆过游戏的玩家总数量，按照玩家ID去重。
        *
        *  DAU/MAU比值  DAUMAU
        *  描述：统计所选时期内，当日活跃玩家数量与当月活跃玩家数量的比例。此比例越趋近于1，说明游戏玩家的活跃度越高。
        *
        *  活跃游戏率 UserActiveGame
        *  描述：统计所选时期内，每日DAU中有游戏行为的用户/DAU。
        *
        *  活跃付费率  UserActivePayRate
        *  描述：统计所选时期内，每日成功付费用户占当日活跃用户的比例。
        *
        *  破产率   BankruptcyRate
        *  描述：活跃破产率=破产用户/活跃用户。
        *
        *  破产付费率  BankruptcyRate30
        *  描述：破产且在30分钟内付费的用户数/破产用户数。
        ****/


        $whereUserComprehensive  =   'a.LastLoginTM > "'.$timeEndStrtotime.'" and  a.LastLoginTM < "'.$timeStartStrtotime.'"';

        $UserComprehensive = M('web_vuserloginlist as a')
            ->join('Web_RMBCost as b on a.UserID = b.Users_ids and  b.PaySuccess = 1','LEFT')
            ->join('web_moneychangelog as c on a.UserID = c.UserID and c.ChangeType  = 1','LEFT')
            ->join('jy_UserbankruptcyLog as d on d.UserID = a.UserID','LEFT')
            ->where($whereUserComprehensive)
            ->field('date_format(a.LastLoginTM,"%Y-%m-%d") as t
                    ,unix_timestamp(a.LastLoginTM) as time
                    ,count(distinct a.UserID) as UserNum
                    ,count(distinct if(unix_timestamp(date_format(a.LastLoginTM,"%Y-%m-%d"))<=unix_timestamp(date_format(a.LastLoginTM,"%Y-%m-%d"))+6*24*60,a.UserID,NULL)) as WAU
                    ,count(distinct if(unix_timestamp(date_format(a.LastLoginTM,"%Y-%m-%d"))<=unix_timestamp(date_format(a.LastLoginTM,"%Y-%m-%d"))+29*24*60,a.UserID,NULL)) as MAU
                    ,count(distinct a.UserID)/count(distinct if(unix_timestamp(date_format(a.LastLoginTM,"%Y-%m-%d"))<=unix_timestamp(date_format(a.LastLoginTM,"%Y-%m-%d"))+29*24*60,a.UserID,NULL)) as DAUMAU
                    ,count(c.ChangeType)/count(distinct a.UserID) as  UserActiveGame                   
                    ,count(distinct b.Users_ids)/count(a.UserID) as UserActivePayRate
                    ,count(distinct d.UserID)/count(a.UserID) as BankruptcyRate
                    ,count(distinct if((b.BackTime-d.DataTime)/60 <= 30,d.UserID,NULL))/count(distinct d.UserID) as BankruptcyRate30')
            ->group('t')
            ->order('a.LastLoginTM asc')
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
                $UserComprehensiveData[$k]['WAU']        =           $data['WAU'];
                $UserComprehensiveData[$k]['MAU']    =           $data['MAU'];
                $UserComprehensiveData[$k]['DAUMAU']          =           $data['DAUMAU'];
                $UserComprehensiveData[$k]['UserActiveGame']      =           $data['UserActiveGame'];
                $UserComprehensiveData[$k]['UserActivePayRate']            =           $data['UserActivePayRate'];
                $UserComprehensiveData[$k]['BankruptcyRate']            =           $data['BankruptcyRate'];
                $UserComprehensiveData[$k]['BankruptcyRate30']          =           $data['BankruptcyRate30'];

            }else{
                $UserComprehensiveData[$k]['UserNum']             =           0;
                $UserComprehensiveData[$k]['WAU']                 =           0;
                $UserComprehensiveData[$k]['MAU']                 =           0;
                $UserComprehensiveData[$k]['DAUMAU']              =           0;
                $UserComprehensiveData[$k]['UserActiveGame']      =           0;
                $UserComprehensiveData[$k]['BankruptcyRate']      =           0;
                $UserComprehensiveData[$k]['UserActivePayRate']   =           0;
                $UserComprehensiveData[$k]['BankruptcyRate30']    =           0;
            }
            $UserComprehensiveData[$k]['date'] = date('n月j日',$v);
        }
        $this->assign('datemin',$datemin);
        $this->assign('day',$timeEndDay);

        $this->assign('info',$UserComprehensiveData);
        $this->display();
    }


}