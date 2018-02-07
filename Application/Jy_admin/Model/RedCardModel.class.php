<?php
namespace jy_admin\Model;

use Protos\cfg_hhmf_numerical;
use Protos\PBS_gm_get_hhmf_numerical;
use Protos\PBS_gm_get_hhmf_numerical_return;
use Protos\PBS_gm_set_hhmf_numerical;
use Protos\PBS_gm_set_hhmf_numerical_return;
use Think\Exception;
use Think\Model;
class RedCardModel extends Model{
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
    public function GetVal($Serverid,$obj,$Version){
            $PBS_gm_get_hhmf_numerical           = new PBS_gm_get_hhmf_numerical();
            $PBS_gm_get_hhmf_numerical_return    = new PBS_gm_get_hhmf_numerical_return();
            $PBS_gm_get_hhmf_numerical->setServerid($Serverid);
            $PBS_gm_get_hhmf_numerical->dump();
            $ProtocString = $PBS_gm_get_hhmf_numerical->serializeToString();
            $Header = array(
                'PBName:'.'protos.PBS_gm_get_hhmf_numerical',
                'PBSize:'.strlen($ProtocString),
                'UID:1',
                'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
                'Version:'.$Version,
            );
             dump($Header);
            $Respond  =  $obj->ProtobufSend($Header,$ProtocString);
            if($Respond == 504 || strlen($Respond) == 0){
                return false;
            }
            $PBS_gm_get_hhmf_numerical_return->parseFromString($Respond);
            $Code = $PBS_gm_get_hhmf_numerical_return->getCode();
            if($Code != 1){
                return $Code;
            }
            $Data = $PBS_gm_get_hhmf_numerical_return->getData();
            $Data->getGoldRangeMin();
            $FunArray = array(
                  'GoldRangeMax'=>   $Data->getGoldRangeMax(),
                  'GoldRangeMin'=>   $Data->getGoldRangeMin(),
            );
            return  $FunArray;
    }

    //设置数值
    public function SetVal($Serverid,$obj,$Version){
        $FunArray = array(
            'GoldRangeMax'        =>    I('param.GoldRangeMax','','trim'),
            'GoldRangeMin'        =>    I('param.GoldRangeMin','','trim'),
        );
        $PBS_gm_set_hhmf_numerical        =  new PBS_gm_set_hhmf_numerical();
        $cfg_hhmf_numerical               =  new cfg_hhmf_numerical();
        $PBS_gm_set_hhmf_numerical_return =  new PBS_gm_set_hhmf_numerical_return();
        $PBS_gm_set_hhmf_numerical->setServerid($Serverid);
        $cfg_hhmf_numerical->setGoldRangeMax($FunArray['GoldRangeMax']);
        $cfg_hhmf_numerical->setGoldRangeMin($FunArray['GoldRangeMin']);
        $PBS_gm_set_hhmf_numerical->setData($cfg_hhmf_numerical);
        //发送请求
        $ProtobufString =  $PBS_gm_set_hhmf_numerical->serializeToString();
        $Header = array(
            'PBName:'.'protos.PBS_gm_set_hhmf_numerical',
            'PBSize:'.strlen($ProtobufString),
            'UID:1',
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$Version,
        );
        $Respond   =  $obj->ProtobufSend($Header,$ProtobufString);
        if($Respond == 504){
            return false;
        }
        $PBS_gm_set_hhmf_numerical_return->parseFromString($Respond);
        $Code =$PBS_gm_set_hhmf_numerical_return->getCode();
        if($Code != 1){
            return false;
        }
        return true;
    }

}

