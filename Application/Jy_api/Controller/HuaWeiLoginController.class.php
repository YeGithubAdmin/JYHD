<?php
/***
 * 华为登录
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
class HuaWeiLoginController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        include     HUAWEISDK.'HuaWeiFun.php';

        $obj        = new \Common\Lib\func();
        $msgArr[2000] = "验证成功！";
        $msgArr[3002] = "网络超时，请稍后再试！";
        $msgArr[3003] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3004] = "与游戏服务器断开，请稍后再试！";
        $msgArr[4006] = "LoginPlayerId缺失！";
        $msgArr[4007] = "IsAuth缺失！";
        $msgArr[5002] = "系统错误，请稍后再试！";
        $msgArr[7001] = "非法登陆！";
        $result = 2001;
        $info              =  array();
        $ComFun = D('ComFun');
        $LogLevel = 'INFO';
        $GameAuthSign      =  $DataInfo['GameAuthSign'];
        $LoginPlayerId     =  $DataInfo['LoginPlayerId'];
        $IsAuth            =  $DataInfo['IsAuth'];
        $PlayerLevel          =$DataInfo['PlayerLevel'];
        $SignTime          =$DataInfo['SignTime'];
        $LoginCode = $obj->RandomNumber(); ;
        if(empty($LoginPlayerId)){
            $result = 4006;
            $LogLevel = 'NOTICE';
            goto  response;
        }
        if($IsAuth == null){
            $LogLevel = 'NOTICE';
            $result = 4007;
            goto  response;
        }
        $Channel = $DataInfo['channel'];
        if($IsAuth == 1){
            $Content = array(
                'method'            =>  'external.hms.gs.checkPlayerSign',
                'appId'             =>  "100106371",
                'cpId'              =>  "900086000020554310",
                'ts'                =>  $SignTime,
                'playerId'          =>  $LoginPlayerId,
                'playerLevel'       =>  $PlayerLevel,
                'playerSSign'       =>  $GameAuthSign,
            );
            $LoginVerification = $this->Verification($Content);
            $LoginVerification = json_decode($LoginVerification,true);


            if($LoginVerification['rtnCode'] != 0){
                $result = 7001;
                $LogLevel = 'CRITICAL';
                goto response;
            }
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
        $PBS_ThirdPartyLogin->setUid($LoginPlayerId);
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
            $LogLevel = 'CRITICAL';
            $result = $ReplyCode;
            goto response;
        }
        $info = array(
            'LoginCode'=>$LoginCode,
        );
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


    public function Verification($param){
        $obj        = new \Common\Lib\func();
        $HuaWeiFun  = new \HuaWeiFun();
        $url        = "https://gss-cn.game.hicloud.com/gameservice/api/gbClientApi";
         $cpSign =  $HuaWeiFun->SHA256WithRSA($param);
        ksort($param);
        $arg = "";
        while (list ($key, $val) = each ($param)) {
            $arg.=$key."=".urlencode($val)."&";
        }
        //去掉最后一个&字符
        $arg = substr($arg,0,count($arg)-2);
        $arg = $arg.'&cpSign='.urlencode($cpSign);
        $res = $obj->curl($url,$arg);
        return $res;
    }

}