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
        $ChannelInfo = D('ChannelInfo');
        $ChannelList = $ChannelInfo->ChannelList();
        if(!$ChannelList){
            die('不存在渠道');
        }
        $ChannelIn   = $ChannelList['ChannelIn'] ;
        $ChannelData = D('ChannelData');
        $gameLoginActionSort  = $ChannelData->gameLoginAction($ChannelIn,$StartTime,$EndTime);
        $UsersOrderSort       = $ChannelData->UsersOrder($ChannelIn,$StartTime,$EndTime);
        $GameAccountOldSort   = $ChannelData->GameAccountOld($ChannelIn,$StartTime,$EndTime);
        $EquipmentAndroidSort = $ChannelData->EquipmentAndroid($ChannelIn,$StartTime,$EndTime);
        $EquipmentIosSort     = $ChannelData->EquipmentIos($ChannelIn,$StartTime,$EndTime);
        $info = array();
        foreach ($ChannelList['ChannelList'] as $k=>$v){
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
            $info[$k]['UsersOneNum'] = 0.00;
            $info[$k]['UsersTowNum'] = 0.00;
            $info[$k]['UsersThreeNum'] = 0.00;
            $info[$k]['UsersSevenNum'] = 0.00;
            $info[$k]['UsersFifteenNum'] = 0.00;
            $info[$k]['UsersThirtyNum'] = 0.00;
        }
        //添加数据
        $addStatisticsUsersPay = $model
            ->table('jy_statistics_users_pay')
            ->addAll($info);
        exit();
    }
   //

}