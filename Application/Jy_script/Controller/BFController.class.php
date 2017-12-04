<?php
namespace Jy_script\Controller;
use Jy_api\Controller\ComController;
use Protos\OptReason;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;

class BFController extends Controller {
    public function index(){
        $a= array(
            '490478',
            '581705',
            '376197',
            '357226',
            '471638',
            '561935',
            '494760',
            '301836',
            '280056',
            '275050',
            '238194',
            '240223',
            '101507',
            '629707',
            '630638',
            '631826',
            '629707',
            '630638',
            '631826',
            '625992',
            '618881',
            '595806',
            '599676',
            '590110',
            '591797',
            '592993'
        );
        foreach ($a as $k=>$v){
            $num =    $v%10;
            //查询
            $cat = M('log_users_shop_'.$num)
                   ->where('playerid = '.$v.' and  GoodsID = 25')
                    ->find();

            $data = array(
                'GoodsID'=>25,
                'Code'=>7,
                'Type'=>0,
                'Price'=>30,
                'Number'=>1,
                'Form'=>2,
                'DateTime'=>date('Y-m-d H:i:s'),
            );
            if(empty($cat)){
                $data['playerid'] = $v;
                $add = M('log_users_shop_'.$num)->add($data);
            }else{
                $update = M('log_users_shop_'.$num)
                          ->where('playerid = '.$v.' and  GoodsID = 25')
                          ->save($data);
            }
        }

    }
    public function  Cat(){

        $a= array(
            '490478',
            '581705',
            '376197',
            '357226',
            '471638',
            '561935',
            '494760',
            '301836',
            '280056',
            '275050',
            '238194',
            '240223',
            '101507',
            '629707',
            '630638',
            '631826',
            '629707',
            '630638',
            '631826',
            '625992',
            '618881',
            '595806',
            '599676',
            '590110',
            '591797',
            '592993'
        );

        $d = array(
            '632989',
            '633087',
        );
        //print_r(count(array_unique($a)));
        $c= array();
        foreach ($d as $k=>$v){
            $num =    $v%10;
            //查询
            $cat = M('log_users_shop_'.$num)
                ->where('playerid = '.$v.' and  GoodsID = 25')
                ->select();
            $c[$v] = $cat;
        }

        dump($c);

    }

    public function  info(){

        $obj = new \Common\Lib\func();

        $obj->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/UsrDataOpt.php',
            'Protos/OptSrc.php',
            'OptReason.php',
            'PB_Item.php',
            'RPB_PlayerNumerical.php',
            'RedisProto/RPB_PlayerData.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
        ));
        $playerid = 632989;
        $PBS_UsrDataOprater = new PBS_UsrDataOprater();
        $UsrDataOpt         = new UsrDataOpt();
        $OptSrc             = new OptSrc();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_Player);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        //发送请求
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$playerid);

        if(strlen($PBS_UsrDataOpraterRespond)==0){
            $result = 3003;
            goto response;
        }
        if($PBS_UsrDataOpraterRespond  == 504){
            $result = 3002;
            goto response;
        }
        //接受回应
        $PBS_UsrDataOpraterReturn =  new PBS_UsrDataOpraterReturn();
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);

        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();

        //判断结果
        if($ReplyCode != 1){
            $result = $ReplyCode;
            goto response;
        }
        $Base       =  $PBS_UsrDataOpraterReturn->getBase();
        $Base->dump();
        response:
        ;
    }
}