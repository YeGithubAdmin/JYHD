<?php
namespace Jy_api\Model;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use Think\Exception;
use Think\Model;
class MiniGameSwitchModel extends \Common\Model\ComFunModel {
    protected $autoCheckFields = false;

    public function __construct(){
        spl_autoload_register( array($this,'ProtoClass'));
    }

    public function ProtoClass($ClassName){
        $Class  =   explode('\\',$ClassName);
        $Count  =   count($Class);
        if($Count == 2){
            $FileName = PROTOC_PATH.$Class[0].'/'.$Class[1].'.php';
        }else{
            $FileName = PROTOC_PATH.'/'.$Class[0].'.php';
        }
        try{
            if(file_exists($FileName)){
                include  $FileName;
            }else{
                throw new Exception('file is not exists');
            }
        }catch (Exception $exception){
            $exception->getMessage();
        }
    }
     public function  getUserInfo($playerid,$obj,$version){
         $PBS_UsrDataOprater = new PBS_UsrDataOprater();
         $UsrDataOpt         = new  UsrDataOpt();
         $OptSrc             = new  OptSrc();
         $PBS_UsrDataOprater->setPlayerid($playerid);
         $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_Player);
         $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
         $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
         //发送请求
         $Header = array(
             'PBName:'.'protos.PBS_UsrDataOprater',
             'PBSize:'.strlen($PBSUsrDataOpraterString),
             'UID:'.$playerid,
             'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
             'Version:'.$version,
         );
         $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend($Header,$PBSUsrDataOpraterString);
         if(strlen($PBS_UsrDataOpraterRespond)==0 || $PBS_UsrDataOpraterRespond  == 504){
             return false;
         }
         //接受回应
         $PBS_UsrDataOpraterReturn =  new  PBS_UsrDataOpraterReturn();
         $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
         $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();

         //判断结果
         if($ReplyCode != 1){
            return false;
         }
         $Base       =  $PBS_UsrDataOpraterReturn->getBase();
         //vip 等级
         $Data['VipLevel']   =  $Base->getVip();
         //游戏等级
         $Data['GameLevel']  =  $Base->getGlevel();


         return $Data;


     }

}
