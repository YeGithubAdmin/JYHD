<?php
namespace Jy_api\Controller;
use Common\Lib\func;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\UsrDataOpt;
use Think\Controller;
class Test2Controller extends Controller {
    public function index()
    {
        $obj = new  \Common\Lib\func();
        $obj->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'Protos/UsrDataOpt.php',
            'Protos/OptSrc.php',
            'Protos/OptReason.php',
            'RPB_PlayerNumerical.php',
            'RedisProto/RPB_PlayerData.php'
        ));
        $PBS_UsrDataOprater = new PBS_UsrDataOprater();
        $UsrDataOpt         = new UsrDataOpt();
        $OptSrc             = new OptSrc();
        $PBS_UsrDataOprater->setPlayerid(100060);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_Player);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        $i = 1;
        while (true){
            $i++;
            if($i == 100){
                sleep(1);
                $i = 0;
            }
            //发送请求
            $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,100060);
            if($PBS_UsrDataOpraterRespond == 504){
                break;
            }
        }
    }
}