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
use Think\Model;
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
            $model = new Model();
            //渠道列表
            $ChannelListField = array(
                'account as GroupChannel'
            );
            $ChannelList  = $model
                            ->table('jy_admin_users')
                            ->where('channel = 2')
                            ->field($ChannelListField)
                            ->select();
             $ChannelListSort = array();
            foreach($ChannelList as $k=>$v) $ChannelListSort[] = '"'.$v['GroupChannel'].'"';

            if(empty($ChannelList)){
                die('不存在渠道');
            }

            $ChannelIn = implode(',',$ChannelListSort);

            //活跃统计
            $gameLoginActionField = array(
                'login_channel as GroupChannel',
                'count(distinct playerid) as ActiveNum'
            );
            $gameLoginAction = $model
                               ->table('game_login_action')
                               ->where(' login_channel in ('.$ChannelIn.')  and  login_time < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  and
                                        login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
                               ->field($gameLoginActionField)
                               ->group('GroupChannel')
                               ->select();

            //注册统计
            $GameAccountField = array(
                'reg_channel as GroupChannel',
                'count(playerid) as RegNum',
            );
            $GameAccount   = $model
                            ->table('game_account')
                            ->where(' reg_channel in('.$ChannelIn.')  and  regtime< str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and
                                     regtime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
                            ->field($GameAccountField)
                            ->select();
            //支付统计
            $UsersOrderFiled = array(
                'count(Id) as OrderTotal',
                'count(if(Status = 2,Id,null)) as Success',
                'PayChannel as GroupChannel',
                'count(if(Status = 2,playerid,null)) as PayNum',
                'count(distinct if(Status = 2,playerid,null)) as UserPayNum',
                'round(sum(if(Status = 2,Price,0)),2) as TotalMoney',
                'count(if(Status = 2 and PayPlatform = 1,Id,null)) as alipay',
                'count(if(Status = 2 and PayPlatform = 2,Id,null)) as weixin',
                'count(if(Status = 2 and PayPlatform = 3,Id,null)) as iappay',
                'count(if(Status = 2 and PayPlatform = 4,Id,null)) as JinPay',
                'count(if(Status = 2 and IsFirst = 2,Id,null)) as First',
                'round(sum(if(Status = 2 and IsFirst = 2,Price,0)),2) as FirstMoney',
            );
            $UsersOrder = $model
                         ->table('jy_users_order_info')
                         ->where('PayChannel in ('.$ChannelIn.') and  FoundTime  <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  
                          and  str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  <= FoundTime')
                         ->field($UsersOrderFiled)
                         ->group('GroupChannel')
                         ->select();
            //支付老用户统计
            $GameAccountOldField = array(
                'a.reg_channel as GroupChannel',
                'count(distinct b.playerid) as UserPayNumOld',
                'sum(b.Price) as OrderTotalOld'
            );
            $GameAccountOld   = $model
                ->table('game_account as a')
                ->join('jy_users_order_info as b on b.PayChannel in ('.$ChannelIn.')   and  a.reg_channel = b.PayChannel  and b.Status = 2 and 
                         b.FoundTime  <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  
                         and str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  <= b.FoundTime ')
                ->where(' a.reg_channel in('.$ChannelIn.')    and a.regtime>=str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")')
                ->group('GroupChannel')
                ->field($GameAccountOldField)
                ->select();
            //组装数据
           $gameLoginActionSort     = array();
           $GameAccountSort         = array();
           $UsersOrderSort          = array();
           $GameAccountOldSort      = array();
           foreach ($gameLoginAction as $k=>$v) $gameLoginActionSort[$v['GroupChannel']] = $v;
           foreach ($GameAccount as $k=>$v) $GameAccountSort[$v['GroupChannel']] = $v;
           foreach ($UsersOrder as $k=>$v) $UsersOrderSort[$v['GroupChannel']] = $v;
           foreach ($GameAccountOld as $k=>$v) $GameAccountOldSort[$v['GroupChannel']] = $v;

           $info = array();
           foreach ($ChannelList as $k=>$v){
               //活跃
               $info[$k]['Channel']       = $v['GroupChannel'];
               $info[$k]['DateTime']      = $StartTime;
               if($gameLoginActionSort[$v['GroupChannel']]){
                   $info[$k]['ActiveNum'] = $gameLoginActionSort[$v['GroupChannel']['ActiveNum']] ;
               }else{
                   $info[$k]['ActiveNum'] = 0;
               }
               //注册
               if($GameAccountSort[$v['GroupChannel']]){
                   $info[$k]['RegNum'] = $GameAccountSort[$v['GroupChannel']['RegNum']] ;
               }else{
                   $info[$k]['RegNum'] = 0;
               }
               //支付
               if($UsersOrderSort[$v['GroupChannel']]){
                   $info[$k]['Success']      =    $UsersOrderSort[$v['GroupChannel']]['Success'] ;
                   $info[$k]['OrderTotal']      =    $UsersOrderSort[$v['GroupChannel']]['OrderTotal'] ;
                   $info[$k]['TotalMoney']      =    $UsersOrderSort[$v['GroupChannel']]['TotalMoney'] ;
                   $info[$k]['PayNum']          =    $UsersOrderSort[$v['GroupChannel']]['PayNum'] ;
                   $info[$k]['UserPayNum']      =    $UsersOrderSort[$v['GroupChannel']]['UserPayNum'] ;
                   $info[$k]['alipay']          =    $UsersOrderSort[$v['GroupChannel']]['alipay'] ;
                   $info[$k]['weixin']          =    $UsersOrderSort[$v['GroupChannel']]['weixin'] ;
                   $info[$k]['iappay']          =    $UsersOrderSort[$v['GroupChannel']]['iappay'] ;
                   $info[$k]['JinPay']          =    $UsersOrderSort[$v['GroupChannel']]['JinPay'] ;
                   $info[$k]['First']           =    $UsersOrderSort[$v['GroupChannel']]['First'] ;
                   $info[$k]['FirstMoney']      =    $UsersOrderSort[$v['GroupChannel']]['FirstMoney'] ;
               }else{
                   $info[$k]['Success'] = 0 ;
                   $info[$k]['OrderTotal'] = 0 ;
                   $info[$k]['TotalMoney'] = 0 ;
                   $info[$k]['PayNum'] = 0 ;
                   $info[$k]['UserPayNum'] = 0 ;
                   $info[$k]['alipay'] = 0 ;
                   $info[$k]['weixin'] = 0 ;
                   $info[$k]['iappay'] = 0 ;
                   $info[$k]['JinPay'] = 0 ;
                   $info[$k]['First'] = 0 ;
                   $info[$k]['FirstMoney'] = 0 ;
               }
               if($GameAccountOldSort[$v['GroupChannel']]){
                   $info[$k]['UserPayNumOld'] = $GameAccountOldSort[$v['GroupChannel']['UserPayNumOld']] ;
                   $info[$k]['UserPayNumOld'] = $GameAccountOldSort[$v['GroupChannel']['OrderTotalOld']] ;
               }else{
                   $info[$k]['UserPayNumOld'] = 0;
                   $info[$k]['OrderTotalOld'] = 0;
               }
           }



           //添加数据
            $addStatisticsUsersPay = $model
                                    ->table('jy_statistics_users_pay')
                                    ->addAll($info);
            exit();


    }

}