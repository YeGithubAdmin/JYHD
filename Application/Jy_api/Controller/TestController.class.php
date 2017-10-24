<?php
namespace Jy_api\Controller;
use Common\Lib\func;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use Think\Controller;
class TestController extends Controller {
    public function index()
    {
        $obj = new  \Common\Lib\func();
        //查询用户信息


            $obj->ProtobufObj(array(
                'Protos/PBS_UsrDataOprater.php',
                'Protos/PBS_UsrDataOpraterReturn.php',
                'RedisProto/RPB_PlayerData.php',
                'RedisProto/RPB_AccountData.php',
                'Protos/OptSrc.php',
                'OptReason.php',
                'RPB_PlayerNumerical.php',
                'Protos/UsrDataOpt.php',
            ));

        $UsrDataOprater         =   new  PBS_UsrDataOprater();
        $UsrDataOpraterReturn   =   new  PBS_UsrDataOpraterReturn();
        $OptSrc                 =   new  OptSrc();
        $UsrDataOpt             =   new  UsrDataOpt();
        $playerid = 100006;
        $UsrDataOprater->setPlayerid($playerid);
        $UsrDataOprater->setOpt($UsrDataOpt::Request_All);
        $UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $String = $UsrDataOprater->serializeToString();
        //发送请求
        $UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$String,$playerid);
        if(strlen($UsrDataOpraterRespond)==0){
            $result = 3001;
            goto response;
        }
        if($UsrDataOpraterRespond  == 504){
            $result = 3002;
            goto response;
        }
        //接受回应
        $UsrDataOpraterReturn->parseFromString($UsrDataOpraterRespond);
        $ReplyCode = $UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = $ReplyCode;
            goto response;
        }
        //获得结果
        $ReturnBase         =   $UsrDataOpraterReturn->getBase();
        $ReturnBase->dump();
        $AccountData        =   $UsrDataOpraterReturn->getAccountData();

        print_r(12312);
        print_r($AccountData);
        //vip等级
        $VipLevel           =  $ReturnBase->getVip();
        //vip经验
        $VipExp             =  $ReturnBase->getVipExp();
        //注册渠道号
        $RegisterChannel    =  $AccountData->getRegChannel();
        //用户名称
        $UserName           =  $ReturnBase->getName();;
        $UsrDataOprater->setOpt($UsrDataOpt::Request_All);
        $UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $String = $UsrDataOprater->serializeToString();
        //发送请求
        $UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$String,$playerid);
        if(strlen($UsrDataOpraterRespond)==0){
            $result = 3001;
            goto response;
        }
        if($UsrDataOpraterRespond  == 504){
            $result = 3002;
            goto response;
        }
        //接受回应
        $UsrDataOpraterReturn->parseFromString($UsrDataOpraterRespond);
        $ReplyCode = $UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = 3003;
            goto response;
        }
        //获得结果
        $ReturnBase         =   $UsrDataOpraterReturn->getBase();
        $AccountData        =   $UsrDataOpraterReturn->getAccountData();
        //vip等级
        $VipLevel           =  $ReturnBase->getVip();
        //vip经验
        $VipExp             =  $ReturnBase->getVipExp();
        //注册渠道号
        $RegisterChannel    =  $AccountData->getRegChannel();
        //用户名称
        $UserName           =  $ReturnBase->getName();
        response:
         echo $result;

    }
}