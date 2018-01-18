<?php
/***
 * 记录定时礼包
 * @param array   $msgArr  2*  成功  3.* 超时无响应  4.*丢失或参数缺失  5.* 服务器配置问题  6.*来不明  7.* 权限问题 8.* 配置问题
 * @param int     $page         页码
 * @param int     $num          页数
 * @param int     $channelid    渠道id
 * @param int     $platform     平台号  1-iso  2-安卓
 * @param unknow  $version      版本号
 ***/
namespace Jy_api\Controller;
use Jy_api\Controller\ComController;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class TimedSendController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $result = 2001;
        $info   =  array();
        $msgArr[2001] = "请求成功！";
        $msgArr[3001] = "网络错误请稍后再试！";
        $msgArr[4006] = "用户信息缺失！";

        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto  response;
        }
        $Data = array(
            'playerid'=>$playerid
        );

        $LogTimedSend = M('log_timed_send')->add($Data);
        if(!$LogTimedSend){
            $result = 3001;
            goto  response;
        }
        response:

            $response = array(
                'result'    => $result,
                'msg'       => $msgArr[$result],
                'sessionid' => $DataInfo['sessionid'],
                'data'      => $info,
            );
       $this->response($response,'json');
    }
}