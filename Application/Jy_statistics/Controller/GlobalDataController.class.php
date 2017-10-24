<?php
/***
*   全局数据
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class GlobalDataController extends ComController {
    //列表
    public function index(){
        //选择时间
        $DateTime = I('param.DateTime','','trim');
        $TimeDate = I('param.DateTime','','trim');
        $timeEndDay = I('param.day',7,'intval');

        $Type =  I('param.Type',0,'intval');
        //一天的秒数
        $DayTime = 24*60*60;
        if($DateTime == ''){
            $DayDate  = date('Y-m-d',time());
            $DayDate  = strtotime($DayDate)-$DayTime;
            $DateTime =  date('Y-m-d H:i:s',$DayDate);
            $TimeDate =  date('Y-m-d',$DayDate);
        }
        $strtotime = strtotime($DateTime);
        $erverDay = array();
        $dayArr   = array();
        //八天时间
        for($i=($timeEndDay-1);$i>=0;$i--){
            $erverDayTime = $strtotime-$i*$DayTime;
                $erverDay[$i]['date'] = date("Y-m-d",$erverDayTime);
                $dayArr[] = date('n月j日',$erverDayTime);
        }
        $StartTime = $strtotime-$DayTime*6 ;
        $EndTime   = $strtotime+$DayTime ;
        /***
         * 渠道：根据渠道号上报的渠道选择项，eg:OPPO渠道，华为渠道，全渠道（数据汇总）。
         * 日期：统计所选时期，默认为前一天
         * 注册用户：统计所选时期内，每日新增激活的用户数量。
         * 活跃用户：统计所选时期内，每日成功登录游戏的用户数量，去重。
         * 收入：统计所选时期内，每日用户成功充值的金额总值。单位为元。
         * 付费用户数：统计所选时期内，每日成功充值的用户数量，去重。
         * 付费次数：统计所选时期内，每日用户成功充值总次数。
         * 注册付费渗透率：统计所选时期内，当天注册且当天付费的用户数/当天注册用户数
         * 活跃付费渗透率：统计所选时期内，每日成功付费用户占当日活跃用户的比例。
         * ARPPU：日ARPPU=当日充值总额度/当日付费用户数量。
         * 注册1日留存率：统计所选时期内，当日成功登陆游戏的注册用户中，第二日再次登陆游戏的用户数量，占当日游戏新增用户数量的比例。
         * 注册30日留存率：统计所选时期内，当日成功登陆游戏的新增玩家中，往后推第30日（当日不计入天数）登陆游戏的玩家数量，占当日游戏新增玩家数量的比例。
         * 平均在线：统计所选时期内，每日各时间点的玩家在线数量进行平均后的数量。建议每5分钟为一个统计单位。
         * 最高在线：统计所选时期内，平均同时在线数量最高的玩家数量。
         * 环比变化率：=（Y日数值-（Y-1）日数值）/Y日数值，取百分比
         * 同比变化率：=（Y日数值-（Y-7）日数值）/Y日数值，取百分比
         * */
//        $catDate = M('jy_statistics_users_pay')
//                   ->where('')
//                   ->field('')
//                   ->select();



         /******************注册留存********************/
        $dateEndTime = date("Y-m-d H:i:s",$EndTime);
        $dateStartTime = date("Y-m-d H:i:s",$StartTime);
        $RegRetainedField = array(
            'date_format(a.regtime,"%Y-%m-%d") as t',
            'count(a.playerid) as UserRegNum',
            '(count(distinct b.playerid)/count(a.playerid))*100 as UsersOneRate',
            '(count(distinct f.playerid)/count(a.playerid))*100 as UsersThirtyRate',
            'count(distinct c.playerid) as UserRegPayNum',
            '(count(distinct c.playerid)/count(a.playerid))*100 as RegPayRate',
        );
        $RegRetained = M('game_account as a')
            ->join('game_login_action as b on a.playerid = b.playerid 
                                 and b.login_time < str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL -2 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and b.login_time >= str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL -1 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('game_login_action as f on a.playerid = f.playerid 
                                 and f.login_time < str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL -31 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and f.login_time >= str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL  -30 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('jy_users_order_info as c on c.playerid  = a.playerid 
                    and  c.CallbackTime < str_to_date("'.$dateEndTime.'","%Y-%m-%d %H:%i:%s") 
                    and  c.CallbackTime >= str_to_date("'.$dateStartTime.'","%Y-%m-%d %H:%i:%s") and c.Status = 2')
            ->where('a.regtime < str_to_date("'.$dateEndTime.'","%Y-%m-%d %H:%i:%s") and a.regtime >= str_to_date("'.$dateStartTime.'","%Y-%m-%d %H:%i:%s")','left')
            ->group('t')
            ->field($RegRetainedField)
            ->select();
        /******************活跃********************/
        $activeData = array(
            'date_format(login_time,"%Y-%m-%d") as t',
            'count(distinct a.playerid) as activeNum',
            'count(b.playerid) as activePayNum',
            '(count(b.playerid)/count(distinct a.playerid))*100 as activePayRate',

        );
        $activeData = M('game_login_action as a')
                    ->join('jy_users_order_info as b on a.playerid  = b.playerid 
                            and  b.CallbackTime < str_to_date("'.$dateEndTime.'","%Y-%m-%d %H:%i:%s") 
                            and  b.CallbackTime >= str_to_date("'.$dateStartTime.'","%Y-%m-%d %H:%i:%s") and b.Status = 2')
                    ->where('a.login_time < str_to_date("'.$dateEndTime.'","%Y-%m-%d %H:%i:%s") 
                            and  a.login_time >= str_to_date("'.$dateStartTime.'","%Y-%m-%d %H:%i:%s")')
                      ->field($activeData)
                      ->group('t')
                      ->select();
        /******************付费***********************/
        $UsersOrderInfoField = array(
            'date_format(CallbackTime,"%Y-%m-%d") as t',
            'sum(Price) as Price',
            'count(distinct playerid) as UserPayNum',
            'count(Id) as PayNum',
            'sum(Price)/count(distinct playerid) as ARPPU',
        );
        $UsersOrderInfo = M('jy_users_order_info')
            ->where('CallbackTime < str_to_date("'.$dateEndTime.'","%Y-%m-%d %H:%i:%s") 
                    and  CallbackTime >= str_to_date("'.$dateStartTime.'","%Y-%m-%d %H:%i:%s") and Status = 2')
            ->field($UsersOrderInfoField)
            ->group('t')
            ->select();
        /********************在线*********************/
        $RealTimeOnlineField = array(
            'date_format(DateTime,"%Y-%m-%d") as t',
            'max(UserNum) as maxNum',
            'avg(UserNum) as avgNum',
        );
        $RealTimeOnline = M('jy_real_time_online')
                          ->where('DateTime < str_to_date("'.$dateEndTime.'","%Y-%m-%d %H:%i:%s") 
                                 and  DateTime >= str_to_date("'.$dateStartTime.'","%Y-%m-%d %H:%i:%s")')
                          ->field($RealTimeOnlineField)
                          ->group('t')
                          ->select();
        //当天
        $SameStartTime  = date('Y-m-d',$strtotime) ;
        //前天
        $OneStartTime   = date('Y-m-d',$strtotime-$DayTime) ;
        //前8天
        $EightStartTime = date('Y-m-d',$strtotime-$DayTime*8) ;

        $SameDate       = date('n月j日',strtotime($SameStartTime));
        $OneDate        = date('n月j日',strtotime($OneStartTime));
        $EightDate      = date('n月j日',strtotime($EightStartTime));

        $RegRetainedSort        =   array();
        $activeDataSort         =   array();
        $UsersOrderInfoSort     =   array();
        $RealTimeOnlineSort     =   array();
        $dataInfo               =   array();
        foreach ($RegRetained as $k=>$v) $RegRetainedSort[$v['t']] = $v;
        foreach ($activeData as $k=>$v) $activeDataSort[$v['t']] = $v;
        foreach ($UsersOrderInfo as $k=>$v) $UsersOrderInfoSort[$v['t']] = $v;
        foreach ($RealTimeOnline as $k=>$v) $RealTimeOnlineSort[$v['t']] = $v;
        //注册用户
        $dataInfo[]        =  $this->DataArr($RegRetainedSort,'注册','UserRegNum',$SameStartTime,$OneStartTime,$EightStartTime,'',$erverDay);
        //活跃
        $dataInfo[]        =  $this->DataArr($activeDataSort,'活跃','activeNum',$SameStartTime,$OneStartTime,$EightStartTime,'',$erverDay);
        //收入
        $dataInfo[]        =  $this->DataArr($UsersOrderInfoSort,'收入','Price',$SameStartTime,$OneStartTime,$EightStartTime,'',$erverDay);
        //付费用户
        $dataInfo[]        =  $this->DataArr($UsersOrderInfoSort,'付费用户','UserPayNum',$SameStartTime,$OneStartTime,$EightStartTime,'',$erverDay);
        //付费次数
        $dataInfo[]        =  $this->DataArr($UsersOrderInfoSort,'付费次数','PayNum',$SameStartTime,$OneStartTime,$EightStartTime,'',$erverDay);
        //注册付费渗透率
        $dataInfo[]        =  $this->DataArr($RegRetainedSort,'注册付费渗透率','RegPayRate',$SameStartTime,$OneStartTime,$EightStartTime,"%",$erverDay);
        //活跃付费渗透率
        $dataInfo[]        =  $this->DataArr($activeDataSort,'活跃付费渗透率','activePayRate',$SameStartTime,$OneStartTime,$EightStartTime,'%',$erverDay);
        //ARPPU
        $dataInfo[]        =  $this->DataArr($UsersOrderInfoSort,'ARPPU','ARPPU',$SameStartTime,$OneStartTime,$EightStartTime,'',$erverDay);
        //注册1日留存率
        $dataInfo[]        = $this->DataArr($RegRetainedSort,'注册1日留存率','UsersOneRate',$SameStartTime,$OneStartTime,$EightStartTime,"%",$erverDay);
        //注册30日留存率
        $dataInfo[]        = $this->DataArr($RegRetainedSort,'注册30日留存率','UsersThirtyRate',$SameStartTime,$OneStartTime,$EightStartTime,"%",'',$erverDay);
        //平均在线
        $dataInfo[]        = $this->DataArr($RealTimeOnlineSort,'平均在线','avgNum',$SameStartTime,$OneStartTime,$EightStartTime,'',$erverDay);
        //最高在线
        $dataInfo[]        = $this->DataArr($RealTimeOnlineSort,'最高在线','maxNum',$SameStartTime,$OneStartTime,$EightStartTime,'',$erverDay);



        $info =  $dataInfo[$Type];
        $title = $info['Title'];
        $str = $info['str'];
        $this->assign('SameDate',$SameDate);
        $this->assign('TimeDate',$TimeDate);
        $this->assign('OneDate',$OneDate);
        $this->assign('EightDate',$EightDate);
        $this->assign('Type',$Type);
        $this->assign('dayArr',json_encode($dayArr));
        $this->assign('Info',$dataInfo);
        $this->assign('Title',$title);
        $this->assign('str',$str);

        $this->assign('InfoData',json_encode($info['data']));
        $this->display('index');
    }

    /****
    * 组装数组
    * @param  $newArray   array 新数组
    * @param  $arraySort      array 数
    *
    *****/
    public  function  DataArr($arraySort,$title,$key,$timeOne,$timeTow,$timeEight,$str = '',$erverDay){
        $newArray =array();
        $newArray['Title'] = $title;
        $newArray['str'] = $str;
        if($arraySort[$timeOne]){
            $newArray['Same'] = round($arraySort[$timeOne][$key], 2);
        }else{
            $newArray['Same'] = 0;
        }
        if($newArray[$timeTow]){
            $newArray['One'] = round($arraySort[$timeTow][$key], 2);
        }else{
            $newArray['One']= 0;
        }
        if($newArray[$timeEight]){
            $newArray['Eight'] = round($arraySort[$timeEight][$key], 2);
        }else{
            $newArray['Eight'] = 0;
        }
        $Mom =  (($newArray['Same']-$newArray['One'])/$newArray['Same'])*100;
        $An  =  (($newArray['Same']-$newArray['Eight'])/$newArray['Same'])*100;


        $newArray['Mom'] = round($Mom, 2);
        $newArray['An'] = round($An, 2);

        foreach ($erverDay as $k=>$v){
           if($arraySort[$v['date']]){
               $newArray['data'][] =  round($arraySort[$v['date']][$key],2);
           }else{
               $newArray['data'][] = 0;
           }
        }


        return $newArray;
    }

}