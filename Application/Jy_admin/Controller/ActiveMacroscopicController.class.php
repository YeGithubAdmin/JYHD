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
        $where  =   'DateTime > str_to_date("'.$timeEndStrtotime.'","%Y-%m-%d %H:%i:%s") and  DateTime < str_to_date("'.$timeStartStrtotime.'","%Y-%m-%d %H:%i:%s")';

        $infoFile = array(
            'UserNum',
            'WAU',
            'MAU',
            'UserNum/MAU as DAUMAU',
            'UserGame/UserNum as UserActiveGame',
            'UserPayNum/UserNum as UserActivePayRate',
            'BankruptcyNum/UserNum as BankruptcyRate',
            'BankruptcyNum30/BankruptcyNum as BankruptcyRate30',
            'date_format(DateTime,"%Y-%m-%d") as DateTime'
        );
        $info = M('jy_statistics_activem_acroscopic')
                ->where($where)
                ->field($infoFile)
                ->select();
        $sortInfo =  array();
        foreach ($info as $k=>$v){
            $sortInfo[$v['DateTime']] = $v;
        }

        $dataInfo = array();
        foreach ($erverDay as $k=>$v){
            $dateTime = date('Y-m-d',$v);
            $time = date('n月j日',$v);
            $dataInfo[$k]['DateTime'] = $time;
            if(!empty($sortInfo[$dateTime])){
                $dataInfo[$k]['UserNum']            = $info['UserNum'];
                $dataInfo[$k]['WAU']                = $info['WAU'];
                $dataInfo[$k]['MAU']                = $info['MAU'];
                $dataInfo[$k]['UserActiveGame']     = $info['UserActiveGame'];
                $dataInfo[$k]['UserActivePayRate']  = $info['UserActivePayRate'];
                $dataInfo[$k]['BankruptcyRate']     = $info['BankruptcyRate'];
            }else{
                $dataInfo[$k]['UserNum']            = 0;
                $dataInfo[$k]['WAU']                = 0;
                $dataInfo[$k]['MAU']                = 0;
                $dataInfo[$k]['UserActiveGame']     = 0;
                $dataInfo[$k]['UserActivePayRate']  = 0;
                $dataInfo[$k]['BankruptcyRate']     = 0;
            }
        }




        $this->assign('datemin',$datemin);
        $this->assign('day',$timeEndDay);

        $this->assign('info',$dataInfo);
        $this->display();
    }
    public function Calculation(){
            $time          =   time();
            $StartTime        =   strtotime(date('Y-m-d',strtotime('-1 day')));   //开始时间
            $StartTime        =   date('Y-m-d H:i:s',$StartTime);
            $StartTime07      =   strtotime(date('Y-m-d',strtotime('-7 day')));   //开始时间
            $StartTime07      =   date('Y-m-d H:i:s',$StartTime07);
            $StartTime30      =   strtotime(date('Y-m-d',strtotime('-30 day')));   //开始时间
            $StartTime30      =   date('Y-m-d H:i:s',$StartTime30);
            $EndTime          =   strtotime(date('Y-m-d',strtotime('+1 day')));;   //结束时间
            $EndTime          =   date('Y-m-d H:i:s',$EndTime);
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
             *  破产率   BankruptcyNum
             *  描述：活跃破产率=破产用户/活跃用户。
             *
             *  破产付费率  BankruptcyRate30
             *  描述：破产且在30分钟内付费的用户数/破产用户数。
             ****/
            $InfoField = array(
                'count(a.playerid) as UserNum',
                'count(distinct d.playerid) as UserActiveGame',
                'count(distinct c.playerid) as UserPayNum',
                'count(distinct b.playerid) as BankruptcyNum',
                'count(distinct if((c.CallbackTime-b.DateTime)/60 <= 30,c.playerid,NULL)) as BankruptcyRate30',

            );
           $InfoData = M('account as a')
                       ->join('jy_users_bankruptcy as b on a.playerid = b.playerid and b.DateTime < str_to_date ("'.$EndTime.'","%Y-%m-%d %H%i%s")  and  b.DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H%i%s")','left')
                       ->join('jy_users_order_info as c on a.playerid = c.playerid and c.Status = 2 and c.CallbackTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H%i%s")  and c.CallbackTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H%i%s")','left')
                       ->join('jy_users_goods_stream as d on a.playerid = d.playerid  and  d.Type = 1  and d.DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H%i%s") and d.DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H%i%s")','left')
                       ->where('a.lasttime < str_to_date("'.$EndTime.'","%Y-%m-%d %H%i%s") and  a.lasttime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H%i%s")')
                       ->field($InfoField)
                       ->select();
           $WAUINFOFILE = array(
                'count(distinct playerid) as WAU'
           );

           $WAUINFO = M('jy_users_login_log')
                      ->where('LastTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H%i%s") and LastTime >= str_to_date("'.$StartTime07.'","%Y-%m-%d %H%i%s") ')
                      ->field($WAUINFOFILE)
                      ->select();


            $MAUINFOFILE = array(
                'count(distinct playerid) as MAU'
            );

            $MAUINFO = M('jy_users_login_log')
                ->where('LastTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H%i%s") and LastTime >= str_to_date("'.$StartTime30.'","%Y-%m-%d %H%i%s") ')
                ->field($MAUINFOFILE)
                ->select();
            $data = array(
                'UserNum'         =>  $InfoData[0]['UserNum'],
                'WAU'             =>  $WAUINFO[0]['WAU'],
                'MAU'             =>  $MAUINFO[0]['MAU'],
                'UserPayNum'      =>  $InfoData[0]['UserPayNum'],
                'BankruptcyNum'   =>  $InfoData[0]['BankruptcyNum'],
                'UserGame'        =>  $InfoData[0]['UserActiveGame'],
                'BankruptcyNum30' =>  $InfoData[0]['BankruptcyRate30'],
                'DateTime'        =>  $StartTime,

            );
            $addDb = M('jy_statistics_activem_acroscopic')->add($data);


    }

}