<?php
/***
 * 第3方登录
 * @param array   $msgArr  2*  成功  3.* 超时无响应  4.*丢失或参数缺失  5.* 服务器配置问题  6.*来不明  7.* 权限问题 8.* 配置问题
 * @param int     $page         页码
 * @param int     $num          页数
 * @param int     $channelid    渠道id
 * @param int     $platform     平台号  1-iso  2-安卓
 * @param unknow  $version      版本号
 ***/
namespace Jy_api\Controller;
use Jy_api\Controller\ComController;
use Protos\OptSrc;
use Protos\PBS_ThirdPartyLogin;
use Protos\PBS_ThirdPartyLoginReturn;
use Think\Controller;
use Think\Model;
class AppliedTreasureLoginController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $msgArr[2000] = "登陆成功！";
        $msgArr[3001] = "登陆验证失败";
        $msgArr[3002] = "登陆验证失败";
        $msgArr[3003] = "与游戏服务器断开，请稍后再试！";
        $msgArr[4006] = "参数缺失！";
        $msgArr[4007] = "参数缺失！";
        $msgArr[4008] = "参数缺失！";
        $msgArr[4009] = "参数缺失！";
        $msgArr[4010] = "参数缺失！";
        $msgArr[7001] = "非法登陆！";
        $result   = 2001;
        $info     =  array();
        $ComFun   = D('ComFun');
        $Protobuf = D('Protobuf');
        $AppliedTreasure = D('AppliedTreasure');


        $LogLevel = 'INFO';
        $Time = time();
        $Openid =  $DataInfo['Openid'];
        if(empty($Openid)){
            $result = 4006;
            $LogLevel = 'NOTICE';
            goto  response;
        }
        $Type = $DataInfo['Type'];
        if(empty($Type)){
            $result = 4009;
            $LogLevel = 'NOTICE';
            goto  response;
        }
        $AccessToken = $DataInfo['AccessToken'];
        if(empty($AccessToken)){
            $result = 4010;
            $LogLevel = 'NOTICE';
            goto  response;
        }
        $ServerType = $DataInfo['ServerType'];
        if($ServerType == 1 && SERVER_TYPE == 1){
            $ServerName = 'ysdktest.qq.com';
        }else{
            $ServerName = 'ysdk.qq.com';
        }
        $LoginCode = $ComFun->RandomNumber(); ;

        $Appid  = '1106745978';
        $Appkey = 'UCRzuSY38B5SmTGL';

        if($Type == 2){
            //请求参数
            $Params = array(
                'appid' =>$Appid,
                'openid' => $Openid,
                'sig' => md5($Appkey.$Time),
                'access_token' => $AccessToken,
                'timestamp' => $Time,
            );
            $ATCheckCoken = $AppliedTreasure->wx_check_token($Params,$ServerName);
        }else if($Type == 1){
            $Params = array(
                'appid'     => $Appid,
                'openid'    => $Openid,
                'openkey'   => $AccessToken,
                'sig'       =>   md5($Appkey.$Time),
                'timestamp' => $Time,
            );
            $ATCheckCoken = $AppliedTreasure->qq_check_token($Params,$ServerName);
        }else{
            $result = 7001;
            $LogLevel = 'NOTICE';
            goto  response;
        }
        //发送请求

        if($ATCheckCoken === false ){
            $result   = 3001;
            $LogLevel =  'CRITICAL';


            goto  response;
        }
        if($ATCheckCoken['ret'] !== 0){
            $result   = 3002;
            $LogLevel =  'CRITICAL';
            $info = $ATCheckCoken;
            goto  response;
        }
        $ThirdLoginData = array(
            'Channel'   => $DataInfo['channel'],
            'Uid'       => $Openid,
            'LoginCode' => $LoginCode,
        );
        $ThirdLogin = $Protobuf->ThirdLogin($ThirdLoginData);
        if($ThirdLogin == false){
            $result   = 3003;
            $LogLevel =  'CRITICAL';
            goto  response;
        }
        if($ThirdLogin != 1){
            $result   = $ThirdLogin;
            $LogLevel =  'CRITICAL';
            goto  response;
        }
        $info['LoginCode'] = $LoginCode;
        //发送服务器
        response:
            $response = array(
                'result' => $result,
                'msg' => $msgArr[$result],
                'sessionid'=>$DataInfo['sessionid'],
                'data' => $info,
            );
            $ComFun->SeasLog($response,$LogLevel);
            $this->response($response,'json');
    }

}