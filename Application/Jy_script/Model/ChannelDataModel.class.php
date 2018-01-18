<?php
namespace Jy_script\Model;
use Think\Model;
class ChannelDataModel extends Model{
     //停止表名检查
      protected $autoCheckFields = false;
      //活跃统计
      public function gameLoginAction($ChannelIn,$StartTime,$EndTime){
          $gameLoginActionField = array(
              'login_channel as GroupChannel',
              'count(distinct playerid) as ActiveNum'
          );
          $gameLoginAction = M('game_login_action')
              ->where(' login_channel in ('.$ChannelIn.')  and  
                        login_time < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  
                        and login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
              ->field($gameLoginActionField)
              ->group('GroupChannel')
              ->select();
          $gameLoginActionSort = array();
          foreach ($gameLoginAction as $k=>$v) {
              $gameLoginActionSort[$v['GroupChannel']] = $v;
          }
          return $gameLoginActionSort;
      }
      //注册 ios
      public  function EquipmentIos($ChannelIn,$StartTime,$EndTime){
          $EquipmentIosField = array(
              'reg_channel as GroupChannel',
              'count(playerid) as RegNum',
              'count(distinct uuid) as ios',
          );
          $EquipmentIos   = M('game_account')
                           ->where(' reg_channel in('.$ChannelIn.')  and  os_type = 1  
                                      and  regtime< str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and
                                      regtime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
                           ->field($EquipmentIosField)
                           ->group('GroupChannel')
                           ->select();
          $EquipmentIosSort = array();
          foreach ($EquipmentIos as $k=>$v){
              $EquipmentIosSort[$v['GroupChannel']] = $v;
          }
          return $EquipmentIosSort;
      }
      //注册 android
      public function EquipmentAndroid($ChannelIn,$StartTime,$EndTime){
          $EquipmentAndroidField = array(
              'reg_channel as GroupChannel',
              'count(playerid) as RegNum',
              'count(distinct concat(mac,imei,imsi)) as android',
          );
          $EquipmentAndroid   = M('game_account')
                                ->where(' reg_channel in('.$ChannelIn.')  and  os_type = 2  
                                and  regtime< str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and
                                regtime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
                                ->field($EquipmentAndroidField)
                                ->group('GroupChannel')
                                ->select();
          $EquipmentAndroidSort    = array();
          foreach ($EquipmentAndroid as $k=>$v){
              $EquipmentAndroidSort[$v['GroupChannel']] = $v;
          }
          return $EquipmentAndroidSort ;
      }
    //支付统计
    public  function  UsersOrder($ChannelIn,$StartTime,$EndTime){
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
        $UsersOrder = M('jy_users_order_info')
                      ->where('PayChannel in ('.$ChannelIn.')   and  
                               FoundTime  <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  
                               and  str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  <= FoundTime and IsTest = 2')
                      ->field($UsersOrderFiled)
                      ->group('GroupChannel')
                      ->select();
        $UsersOrderSort = array();
        foreach ($UsersOrder as $k=>$v){
            $UsersOrderSort[$v['GroupChannel']] = $v;
        }
        return  $UsersOrderSort;
    }
    //活跃设备号
    public function EquipmentAct($ChannelIn,$StartTime,$EndTime){
        $EquipmentAndroidField = array(
            'reg_channel as GroupChannel',
            'count(distinct concat(mac,imei,imsi,uuid)) as EquipmentActNum',
        );
        $EquipmentAndroid   = M('game_login_action')
            ->where(' login_channel in('.$ChannelIn.')  
                                and  login_time< str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and
                                login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($EquipmentAndroidField)
            ->group('GroupChannel')
            ->select();
        $EquipmentAndroidSort    = array();
        foreach ($EquipmentAndroid as $k=>$v){
            $EquipmentAndroidSort[$v['GroupChannel']] = $v;
        }
        return $EquipmentAndroidSort ;
    }
    //周活跃
    public function WauAct($ChannelIn,$Time){
            $field = array(
                'reg_channel as GroupChannel',
                'count(distinct playerid) as WAU',
            );
             $EndTime   = $Time;
             $StartTime = date('Y-m-d H:i:s',strtotime($Time)-7*24*60*60) ;
             $catData   = M('game_login_action')
                                ->where(' login_channel in('.$ChannelIn.')  
                                and  login_time< str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and
                                login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
                                ->field($field)
                                ->group('GroupChannel')
                                ->select();
             $catDataSort    = array();
            foreach ($catData as $k=>$v){
                $catDataSort[$v['GroupChannel']] = $v;
            }
            return $catDataSort ;

<<<<<<< HEAD
=======
    }
    //月活跃
    public function MauAct($ChannelIn,$Time){
        $field = array(
            'reg_channel as GroupChannel',
            'count(distinct playerid) as MAU',
        );
        $EndTime   = $Time;
        $StartTime = date('Y-m-d H:i:s',strtotime($Time)-30*24*60*60) ;
        $catData   = M('game_login_action')
            ->where(' login_channel in('.$ChannelIn.')  
                                and  login_time< str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and
                                login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($field)
            ->group('GroupChannel')
            ->select();
        $catDataSort    = array();
        foreach ($catData as $k=>$v){
            $catDataSort[$v['GroupChannel']] = $v;
        }
        return $catDataSort ;
    }
>>>>>>> Admin1.0.2
    //支付老用户统计
    public  function  GameAccountOld($ChannelIn,$StartTime,$EndTime){
        $GameAccountOldField = array(
            'a.reg_channel as GroupChannel',
            'count(distinct b.playerid) as UserPayNumOld',
            'sum(b.Price) as OrderTotalOld'
        );
        $GameAccountOld   = M('game_account as a')
                            ->join('jy_users_order_info as b on     a.playerid  = b.playerid  
                                    and  b.PayChannel in ('.$ChannelIn.')   and  
                                    a.reg_channel = b.PayChannel  and b.Status = 2 and 
                                    b.FoundTime  <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  
                                    and str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  <= b.FoundTime ')
                                    ->where(' a.reg_channel in('.$ChannelIn.')    and a.regtime < str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s") and IsTest = 2')
                            ->group('GroupChannel')
                            ->field($GameAccountOldField)
                            ->select();
        $GameAccountOldSort      = array();
        foreach ($GameAccountOld as $k=>$v){
            $GameAccountOldSort[$v['GroupChannel']] = $v;
        }
        return $GameAccountOldSort;
    }
}