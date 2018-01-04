<?php
/***
 * vivo 登录
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
class VivoLoginController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $obj        = new \Common\Lib\func();
        $VivoLogin =  D('VivoLogin');
        $msgArr[2000] = "验证成功！";
        $msgArr[3002] = "网络超时，请稍后再试！";
        $msgArr[3003] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3004] = "与游戏服务器断开，请稍后再试！";
        $msgArr[4006] = "Authtoken缺失！";
        $msgArr[7001] = "非法登陆！";
        $result = 2001;
        $info              =  array();
        $Authtoken      =  $DataInfo['Authtoken'];
        if(empty($Authtoken)){
            $result = 4006;
            goto response;
        }
        $Channel = $DataInfo['channel'];
        $LoginInfo = $VivoLogin->Login($Authtoken);
        if(!$LoginInfo){
            $result = 3002;
            goto response;
        }

        if($LoginInfo['retcode'] != 0){
            $result = 7001;
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
        $PBS_ThirdPartyLogin->setLoginCode($Authtoken);
        $PBS_ThirdPartyLogin->setUid($LoginInfo['data']['openid']);
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
            goto response;
        }
        if(strlen($Respond)==0){
            $result = 3004;
            goto response;
        }
        $PBS_ThirdPartyLoginReturn->parseFromString($Respond);
        $ReplyCode = $PBS_ThirdPartyLoginReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = $ReplyCode;
            goto response;
        }
        $info = array(
            'AuthPasswd'=>$Authtoken,
        );
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