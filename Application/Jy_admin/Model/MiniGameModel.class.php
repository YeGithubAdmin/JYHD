<?php
namespace jy_admin\Model;

use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use Think\Exception;
use Think\Model;
class MiniGameModel extends Model{
    protected $autoCheckFields = false;
    //获取数值
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

    /***
    *  获取数值
    * @param  $Serverid int 服务器ID
    * @param  $obj  object
    */
    public function Push($obj,$Version){
        $PBS_UsrDataOprater = new PBS_UsrDataOprater();
        $UsrDataOpt         = new  UsrDataOpt();
        $OptSrc             = new  OptSrc();
        $PB_HallNotify      = new \PB_HallNotify();
        $PB_HallNotify->setLittleGameUpdate(true);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBS_UsrDataOprater->setNotify($PB_HallNotify);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        //发送请求
        $Header = array(
            'PBName:'.'protos.PBS_UsrDataOprater',
            'PBSize:'.strlen($PBSUsrDataOpraterString),
            'UID:1',
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$Version,
        );
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend($Header,$PBSUsrDataOpraterString);
        if(strlen($PBS_UsrDataOpraterRespond)==0 || $PBS_UsrDataOpraterRespond  == 504){
            return false;
        }
        //接受回应
        $PBS_UsrDataOpraterReturn =  new  PBS_UsrDataOpraterReturn();
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();

        print_r($ReplyCode);
        //判断结果
        if($ReplyCode == 1) {
            return true;
        }
        return false;

    }


}

