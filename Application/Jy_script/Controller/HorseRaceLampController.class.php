<?php
/**
* 跑马灯
*/
namespace Jy_script\Controller;
use Protos\PBS_SysBroadcast;
use Protos\PBS_SysBroadcastReturn;
use Think\Controller;
class HorseRaceLampController extends Controller {
    public function index(){
           // 查询跑马灯信息
        $time = date('Y-m-d H:i:s',time());
        $CatHorseRaceLampField = array(
            'Content',
            'Status',
             'Id'
        );
        $CatHorseRaceLamp = M('jy_horse_race_lamp')
                             ->where('Timing = 2 and Btime > str_to_date("'.$time.'","%Y-%m-%d %H:%i:%s")')
                             ->field($CatHorseRaceLampField)
                             ->select();
        if(empty($CatHorseRaceLamp)){
               exit();
        }
        foreach ($CatHorseRaceLamp as $k=>$v){
               $send  =  $this->SendProtoc($v['Content']);
               if(!$send){
                   exit();
               }else{
                   if($v['Status']  == 1){
                       $dataHorseRaceLamp = array(
                           'Status'=>2,
                       );
                       $upHorseRaceLamp = M('jy_horse_race_lamp')->where('Id = '.$v['Id'])->save($dataHorseRaceLamp);
                   }
               }
        }
    }
    public function  SendProtoc($contet){
        $ObjFun = new \Common\Lib\func();
        //已入protobuf 类
        $ObjFun->ProtobufObj(array(
            'Protos/PBS_SysBroadcast.php',
            'Protos/PBS_SysBroadcastReturn.php',
            'PB_PhpBroadcast.php',
        ));
        $SysBroadcast           =   new PBS_SysBroadcast();
        $SysBroadcastReturn     =   new PBS_SysBroadcastReturn();
        $PhpBroadcast           =   new \PB_PhpBroadcast();
        $PhpBroadcast->setData($contet);
        $SysBroadcast->setPhpBc($PhpBroadcast);
        $String = $SysBroadcast->serializeToString();
        $Respond =  $ObjFun->ProtobufSend('protos.PBS_SysBroadcast',$String,1);
        if(strlen($Respond)==0){
            return false;
        }
        if($Respond  == 504){
            return false;
        }
        $SysBroadcastReturn->parseFromString($Respond);
        $ReplyCode =   $SysBroadcastReturn->getCode();

        if($ReplyCode != 1){
            return false;
        }
        return true;
    }
}