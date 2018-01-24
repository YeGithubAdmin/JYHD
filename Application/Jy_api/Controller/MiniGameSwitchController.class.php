<?php
/***
 * vip 信息
 * @param array   $msgArr  2*  成功  3.* 超时无响应  4.*丢失或参数缺失  5.* 服务器配置问题  6.*来不明  7.* 权限问题 8.* 配置问题
 * @param int     $page         页码
 * @param int     $num          页数
 * @param int     $channelid    渠道id
 * @param int     $platform     平台号  1-iso  2-安卓
 * @param unknow  $version      版本号
 ***/
namespace Jy_api\Controller;
use Jy_api\Controller\ComController;
use Protos\OptReason;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class MiniGameSwitchController extends ComController {



    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $obj   = new \Common\Lib\func();
        $msgArr[3002] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3003] = "与游戏服务器断开，请稍后再试！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[5002] = "系统错误，请稍后再试！";
        $result = 2001;
        $info   =  array();
        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }
        $MiniGameSwitch = D('MiniGameSwitch');
        $UserGameInfo = $MiniGameSwitch->getUserInfo($playerid,$obj,$DataInfo['version']);
        if(!$UserGameInfo){
            $result = 3002;
            goto  response;
        }
        //vip 等级
        $VipLevel   =  $UserGameInfo['VipLevel'];
        //游戏等级
        $GameLevel  =  $UserGameInfo['GameLevel'];
        //渠道信息
        $ChannelInfo = $this->channeinfo;
        if($ChannelInfo['isown'] == 2){
            $Channel = $DataInfo['channel'];
        }else{
            if($ChannelInfo['IsCp'] == 1){
                $Channel = $DataInfo['channel'];
            }else{
                $Channel = $ChannelInfo['CpChannel'];
            }
        }
        $MiniGameWwitch = M('conf_mini_game_switch')
                          ->where('Channel = "'.$Channel.'" and  Version = "'.$DataInfo['version'].'" and  ConfStatus = 2')
                          ->field(array(
                                'Game',
                                'VipLevel',
                                'GameLevel',
                                'Status',
                          ))->find();
        //规则是否存在
        if(empty($MiniGameWwitch)){
            $info['Status'] = 1;
            $info['Game']   = array();
            goto  response;
        }
        //状态
        if($MiniGameWwitch['Status'] == 1){
            $info['Status'] = 1;
            $info['Game']   = array();
            goto  response;
        }
        //判断条件
        if($VipLevel<$MiniGameWwitch['VipLevel'] || $GameLevel<$MiniGameWwitch['GameLevel']) {
            $info['Status'] = 1;
            $info['Game']   = array();
            goto  response;
        }
        $info['Status'] = 2;
        $info['Game']   = json_decode($MiniGameWwitch['Game'],true);
        response:
            $response = array(
                'result' => $result,
                'msg' => $msgArr[$result],
                'sessionid'=>$DataInfo['sessionid'],
                'data' => $info,
            );
            $this->response($response,'json');
    }
}