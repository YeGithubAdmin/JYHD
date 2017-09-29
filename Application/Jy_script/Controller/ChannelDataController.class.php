<?php
namespace Jy_script\Controller;
use Think\Controller;
use Think\Model;
class ChannelDataController extends Controller {
    public function index(){
        //统计时间
        $time = strtotime(date('Y-m-d'),time());
        $day  = 24*60*60;
        $EndTime   = date('Y-m-d H:i:s',$time+$day);
        $StartTime = date('Y-m-d H:i:s',$time);
        $model = new Model();
        //渠道列表
        $ChannelListField = array(
            'account as GroupChannel'
        );
        $ChannelList  = $model
            ->table('jy_admin_users')
            ->where('channel = 2 and IsDel = 1')
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
                $info[$k]['ActiveNum'] = $gameLoginActionSort[$v['GroupChannel']]['ActiveNum'] ;
            }else{
                $info[$k]['ActiveNum'] = 0;
            }
            //注册
            if($GameAccountSort[$v['GroupChannel']]){
                $info[$k]['RegNum'] = $GameAccountSort[$v['GroupChannel']]['RegNum'] ;
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