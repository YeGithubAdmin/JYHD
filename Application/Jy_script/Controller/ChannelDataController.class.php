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
        //活跃统计 ios
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


        //活跃统计 android


        //注册 ios
        $EquipmentIosField = array(
            'reg_channel as GroupChannel',
            'count(playerid) as RegNum',
            'count(distinct uuid) as ios',
        );
        $EquipmentIos   = $model
            ->table('game_account')
            ->where(' reg_channel in('.$ChannelIn.')  and  os_type = 1  and  regtime< str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and
                                     regtime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($EquipmentIosField)
            ->group('GroupChannel')
            ->select();


        //注册 android
        $EquipmentAndroidField = array(
            'reg_channel as GroupChannel',
            'count(playerid) as RegNum',
            'count(distinct concat(mac,imei,imsi)) as android',
        );
        $EquipmentAndroid   = $model
            ->table('game_account')
            ->where(' reg_channel in('.$ChannelIn.')  and  os_type = 2  and  regtime< str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and
                                     regtime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($EquipmentAndroidField)
            ->group('GroupChannel')
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
            ->where('PayChannel in ('.$ChannelIn.')   and  FoundTime  <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  
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
            ->join('jy_users_order_info as b on     a.playerid  = b.playerid  and  b.PayChannel in ('.$ChannelIn.')    and  a.reg_channel = b.PayChannel  and b.Status = 2 and 
                         b.FoundTime  <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  
                         and str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  <= b.FoundTime ')
            ->where(' a.reg_channel in('.$ChannelIn.')    and a.regtime < str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
            ->group('GroupChannel')
            ->field($GameAccountOldField)
            ->select();


        //组装数据
        $gameLoginActionSort     = array();
        $UsersOrderSort          = array();
        $GameAccountOldSort      = array();
        //注册
        $EquipmentAndroidSort    = array();
        $EquipmentIosSort        = array();
        foreach ($gameLoginAction as $k=>$v) $gameLoginActionSort[$v['GroupChannel']] = $v;
        foreach ($UsersOrder as $k=>$v) $UsersOrderSort[$v['GroupChannel']] = $v;
        foreach ($GameAccountOld as $k=>$v) $GameAccountOldSort[$v['GroupChannel']] = $v;
        foreach ($EquipmentAndroid as $k=>$v) $EquipmentAndroidSort[$v['GroupChannel']] = $v;
        foreach ($EquipmentIos as $k=>$v) $EquipmentIosSort[$v['GroupChannel']] = $v;

        /***
         * 计算留存
         * UsersOneNum          次日
         * UsersTowNum          二日
         * UsersThreeNum        三日
         * UsersSevenNum        7日
         * UsersFifteenNum      15日
         * UsersThirtyNum       30日
         *******/
        //次日 UsersOneNum
        $OneNumStartTime = date("Y-m-d H:i:s",$time-24*60*60);
        $OneNumEndTime =  date('Y-m-d H:i:s',$time) ;
        $UsersOneNumField = array(
            'a.reg_channel as  GroupChannel',
            'count(distinct a.playerid) as UserNum',
            'a.regtime',
            'b.login_time',
            'count(distinct b.playerid) as UsersOneNum',
            'count(distinct b.playerid)/count(a.playerid)  Retained'
        );
        $UsersOneNum = M('game_account as a')
                       ->join('game_login_action as b on  a.reg_channel = b.login_channel  and  a.playerid = b.playerid  
                                and   b.login_time < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") 
                                and b.login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")','left')
                       ->where('a.regtime < str_to_date("'.$OneNumEndTime.'","%Y-%m-%d %H:%i:%s")
                                and a.regtime >= str_to_date("'.$OneNumStartTime.'","%Y-%m-%d %H:%i:%s")')
                       ->field($UsersOneNumField)
                       ->group('GroupChannel')
                       ->select();


        //二日 UsersTowNum
        $TowNumStartTime        = date("Y-m-d H:i:s",$time-2*24*60*60);
        $TowNumEndTime      =  date('Y-m-d H:i:s',$time-24*60*60) ;
        $UsersTowNum = M('game_account as a')
            ->join('game_login_action as b on  a.reg_channel = b.login_channel  and  a.playerid = b.playerid  
                                and   b.login_time < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") 
                                and b.login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")','left')
            ->where('a.regtime < str_to_date("'.$TowNumEndTime.'","%Y-%m-%d %H:%i:%s") 
                                and a.regtime >= str_to_date("'.$TowNumStartTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($UsersOneNumField)
            ->group('GroupChannel')
            ->select();

        //3日 UsersThreeNum
        $ThreeNumStartTime        = date("Y-m-d H:i:s",$time-3*24*60*60);
        $ThreeNumEndTime      =  date('Y-m-d H:i:s',$time-2*60*60*24) ;
        $UsersThreeNum =  M('game_account as a')
            ->join('game_login_action as b on  a.reg_channel = b.login_channel  and  a.playerid = b.playerid  
                                and   b.login_time < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") 
                                and b.login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")','left')
            ->where('a.regtime < str_to_date("'.$ThreeNumEndTime.'","%Y-%m-%d %H:%i:%s") 
                                and a.regtime >= str_to_date("'.$ThreeNumStartTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($UsersOneNumField)
            ->group('GroupChannel')
            ->select();
        //7日 UsersSevenNum
        $SevenNumStartTime        = date("Y-m-d H:i:s",$time-7*24*60*60);
        $SevenNumEndTime      =  date('Y-m-d H:i:s',$time-6*60*60*24) ;
        $UsersSevenNum =  M('game_account as a')
            ->join('game_login_action as b on  a.reg_channel = b.login_channel  and  a.playerid = b.playerid  
                                and   b.login_time < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") 
                                and b.login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")','left')
            ->where('a.regtime < str_to_date("'.$SevenNumEndTime.'","%Y-%m-%d %H:%i:%s") 
                                and a.regtime >= str_to_date("'.$SevenNumStartTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($UsersOneNumField)
            ->group('GroupChannel')
            ->select(false);

        //15日  UsersFifteenNum
        $FifteenNumStartTime        = date("Y-m-d H:i:s",$time-15*24*60*60);
        $FifteenNumEndTime      =  date('Y-m-d H:i:s',$time-14*60*60*24) ;
        $UsersFifteenNum =  M('game_account as a')
            ->join('game_login_action as b on  a.reg_channel = b.login_channel  and  a.playerid = b.playerid  
                                and   b.login_time < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") 
                                and  b.login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")','left')
            ->where('a.regtime < str_to_date("'.$FifteenNumEndTime.'","%Y-%m-%d %H:%i:%s") 
                                and a.regtime >= str_to_date("'.$FifteenNumStartTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($UsersOneNumField)
            ->group('GroupChannel')
            ->select();
        //30日  UsersThirtyNum
        $ThirtyNumStartTime         =  date("Y-m-d H:i:s",$time-30*24*60*60);
        $ThirtyNumEndTime           =  date('Y-m-d H:i:s',$time-29*60*60*24) ;
        $UsersThirtyNum =  M('game_account as a')
            ->join('game_login_action as b on  a.reg_channel = b.login_channel  and  a.playerid = b.playerid  
                                and   b.login_time < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") 
                                and b.login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")','left')
            ->where('   a.regtime < str_to_date("'.$ThirtyNumEndTime.'","%Y-%m-%d %H:%i:%s") 
                                and a.regtime >= str_to_date("'.$ThirtyNumStartTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($UsersOneNumField)
            ->group('GroupChannel')
            ->select();
        //留存组装
        /***
         * 计算留存
         * UsersOneNum          次日
         * UsersTowNum          二日
         * UsersThreeNum        三日
         * UsersSevenNum        7日
         * UsersFifteenNum      15日
         * UsersThirtyNum       30日
         *******/
        $UsersOneNumSort = array();
        $UsersTowNumSort = array();
        $UsersThreeNumSort = array();
        $UsersSevenNumSort = array();
        $UsersFifteenNumSort = array();
        $UsersThirtyNumSort = array();
        foreach ($UsersOneNum as $k=>$v) $UsersOneNumSort[$v['GroupChannel']] = $v;
        foreach ($UsersTowNum as $k=>$v) $UsersTowNumSort[$v['GroupChannel']] = $v;
        foreach ($UsersThreeNum as $k=>$v) $UsersThreeNumSort[$v['GroupChannel']] = $v;
        foreach ($UsersSevenNum as $k=>$v) $UsersSevenNumSort[$v['GroupChannel']] = $v;
        foreach ($UsersFifteenNum as $k=>$v) $UsersFifteenNumSort[$v['GroupChannel']] = $v;
        foreach ($UsersThirtyNum as $k=>$v) $UsersThirtyNumSort[$v['GroupChannel']] = $v;
        $info = array();
        foreach ($ChannelList as $k=>$v){
            $info[$k]['Channel']       = $v['GroupChannel'];
            //活跃 ios
            if($gameLoginActionSort[$v['GroupChannel']]){
                $info[$k]['ActiveNum'] = $gameLoginActionSort[$v['GroupChannel']]['ActiveNum'] ;
            }else{
                $info[$k]['ActiveNum'] = 0;
            }

            //注册 ios
            $EquipmentRegNum = 0;
            $RegNum          = 0;
            if($EquipmentIosSort[$v['GroupChannel']]){
                $EquipmentRegNum =  $EquipmentIosSort[$v['GroupChannel']]['ios']+$EquipmentRegNum;
                $RegNum =  $EquipmentIosSort[$v['GroupChannel']]['RegNum']+$RegNum;
            }
            //注册 android
            if($EquipmentAndroidSort[$v['GroupChannel']]){
                $EquipmentRegNum =  $EquipmentAndroidSort[$v['GroupChannel']]['android']+$EquipmentRegNum;
                $RegNum =  $EquipmentAndroidSort[$v['GroupChannel']]['RegNum']+$RegNum;
            }
            $info[$k]['RegNum'] = $RegNum;
            $info[$k]['EquipmentRegNum'] = $EquipmentRegNum;
            //支付
            if($UsersOrderSort[$v['GroupChannel']]){
                $info[$k]['Success']         =    $UsersOrderSort[$v['GroupChannel']]['Success'] ;
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
                $info[$k]['UserPayNumOld'] = $GameAccountOldSort[$v['GroupChannel']]['UserPayNumOld'] ;
                $info[$k]['OrderTotalOld'] = $GameAccountOldSort[$v['GroupChannel']]['OrderTotalOld'] ;
            }else{
                $info[$k]['UserPayNumOld'] = 0;
                $info[$k]['OrderTotalOld'] = 0;
            }
            //次日
            if($UsersOneNumSort[$v['GroupChannel']]){
                $info[$k]['UsersOneNum'] = $UsersOneNumSort[$v['GroupChannel']]['Retained'] ;
            }else{
                $info[$k]['UsersOneNum'] = 0.00;
            }
            //二日
            if($UsersTowNumSort[$v['GroupChannel']]){
                $info[$k]['UsersTowNum'] = $UsersTowNumSort[$v['GroupChannel']]['Retained'] ;
            }else{
                $info[$k]['UsersTowNum'] = 0.00;
            }
            //三日
            if($UsersThreeNumSort[$v['GroupChannel']]){
                $info[$k]['UsersThreeNum'] = $UsersThreeNumSort[$v['GroupChannel']]['Retained'] ;
            }else{
                $info[$k]['UsersThreeNum'] = 0.00;
            }
            //七日
            if($UsersSevenNumSort[$v['GroupChannel']]){
                $info[$k]['UsersSevenNum'] = $UsersSevenNumSort[$v['GroupChannel']]['Retained'] ;
            }else{
                $info[$k]['UsersSevenNum'] = 0.00;
            }
            //十五日
            if($UsersFifteenNumSort[$v['GroupChannel']]){
                $info[$k]['UsersFifteenNum'] = $UsersFifteenNumSort[$v['GroupChannel']]['Retained'] ;
            }else{
                $info[$k]['UsersFifteenNum'] = 0.00;
            }
            //三十日
            if($UsersThirtyNumSort[$v['GroupChannel']]){
                $info[$k]['UsersThirtyNum'] = $UsersThirtyNumSort[$v['GroupChannel']]['Retained'] ;
            }else{
                $info[$k]['UsersThirtyNum'] = 0.00;
            }

        }
        //添加数据
        $addStatisticsUsersPay = $model
            ->table('jy_statistics_users_pay')
            ->addAll($info);
        exit();

    }
}