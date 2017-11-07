<?php
namespace Jy_api\Controller;
use Common\Lib\func;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
class Test1Controller extends Controller {
    public function index()
    {
        $obj = new  \Common\Lib\func();
        $obj->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'Protos/UsrDataOpt.php',
            'RedisProto/RPB_PlayerData.php',
            'RedisProto/RPB_AccountData.php',
            'Protos/OptSrc.php',
            'OptReason.php',
            'RPB_PlayerNumerical.php',

        ));
        $RPB_PlayerData   = new RPB_PlayerData();
        $PBS_UsrDataOprater = new PBS_UsrDataOprater();
        $UsrDataOpt         = new UsrDataOpt();
        $OptSrc             = new OptSrc();
        $PBS_UsrDataOprater->setPlayerid(107765);

        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_All);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,107765);

        //接受回应
        $PBS_UsrDataOpraterReturn =  new PBS_UsrDataOpraterReturn();
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $base = $PBS_UsrDataOpraterReturn->getBase();




        $base->dump();


    }
}