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
class ThirdPartyLoginController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        include  JY_ROOT.'thirdpay/Mipay/miapi.php';
        $obj   = new \Common\Lib\func();
        $msgArr[2000] = "验证成功！";
        $msgArr[3002] = "网络超时，请稍后再试！";
        $msgArr[3003] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3004] = "与游戏服务器断开，请稍后再试！";
        $msgArr[4006] = "uid缺失！";
        $msgArr[4007] = "LoginCode缺失！";
        $msgArr[5002] = "系统错误，请稍后再试！";
        $result = 2001;
        $info   =  array();
        $ComFun = D('ComFun');
        $LogLevel = 'INFO';
        $uid = $DataInfo['uid'];
        if(empty($uid)){
            $result  = 4006;
            goto  response;
        }

        $LoginCode = $DataInfo['LoginCode'];
        if(empty($LoginCode)){
            $result  = 4007;
            $LogLevel = 'NOTICE';
            goto response;
        }
        $Channel = $DataInfo['channel'];
        //验证
        $miapi = new \Miapi();
        $appid = '2882303761517630341';
        $key ='bFn9ZhgrimiXJ/379DyiyA==';

        $VerificationSession = $miapi->VerificationSession($appid,$key,$uid,$LoginCode);

        if($VerificationSession == 504){
            $LogLevel = 'NOTICE';
            $result  = 3001;
            goto response;
        }
        $VerificationSession = json_decode($VerificationSession,true);

        if($VerificationSession['errcode'] != 200){
            $result = $VerificationSession['errcode'];
            $msgArr[$result] = $VerificationSession['errMsg'];
            $LogLevel = 'CRITICAL';
            goto response;
        }
        //游戏服务器
        $obj->ProtobufObj(array(
            'Protos/PBS_ThirdPartyLogin.php',
            'Protos/PBS_ThirdPartyLoginReturn.php',
        ));
        $PBS_ThirdPartyLogin         = new PBS_ThirdPartyLogin();
        $PBS_ThirdPartyLoginReturn   = new PBS_ThirdPartyLoginReturn();
        $PBS_ThirdPartyLogin->setChannel($Channel);
        $PBS_ThirdPartyLogin->setLoginCode($LoginCode);
        $PBS_ThirdPartyLogin->setUid($uid);
        $prcoto = $PBS_ThirdPartyLogin->serializeToString();
        $Header = array(
            'PBName:'.'protos.PBS_ThirdPartyLogin',
            'PBSize:'.strlen($prcoto),
            'UID:1',
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$DataInfo['version'],
        );

        $Respond =  $obj->ProtobufSend($Header,$prcoto);
        if($Respond  == 504){
            $result = 3003;
            $LogLevel = 'CRITICAL';
            goto response;
        }
        if(strlen($Respond)==0){
            $result = 3004;
            $LogLevel = 'CRITICAL';
            goto response;
        }

        $PBS_ThirdPartyLoginReturn->parseFromString($Respond);
        $ReplyCode = $PBS_ThirdPartyLoginReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = $ReplyCode;
            $LogLevel = 'CRITICAL';
            goto response;
        }
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