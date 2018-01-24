<?php
namespace jy_admin\Model;
use Protos\cfg_shuiguoji_rand_1;
use Protos\cfg_shuiguoji_rand_2;
use Protos\cfg_shuihu_fluctuate;
use Protos\cfg_shuihu_fluctuate_range;
use Protos\cfg_shuihu_numerical;
use Protos\PBS_gm_get_shuihu_numerical;
use Protos\PBS_gm_get_shuihu_numerical_return;
use Protos\PBS_gm_set_shuihu_numerical;
use Protos\PBS_gm_set_shuihu_numerical_return;
use RedisProto\RPB_PlayerData;
use Think\Exception;
use Think\Model;
class WaterMarginModel extends Model{
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
            $PBS_gm_get_shuihu_numerical_return = new PBS_gm_get_shuihu_numerical_return();
            $PBS_gm_get_shuihu_numerical        = new PBS_gm_get_shuihu_numerical();
            $PBS_gm_get_shuihu_numerical->setServerid($Serverid);
            $ProtocString = $PBS_gm_get_shuihu_numerical->serializeToString();
            $Header = array(
                'PBName:'.'protos.PBS_gm_get_shuihu_numerical',
                'PBSize:'.strlen($ProtocString),
                'UID:1',
                'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
                'Version:'.$Version,
            );
            $Respond  =  $obj->ProtobufSend($Header,$ProtocString);
            if($Respond == 504 || strlen($Respond) == 0){
                return false;
            }
            $PBS_gm_get_shuihu_numerical_return->parseFromString($Respond);
            $Code = $PBS_gm_get_shuihu_numerical_return->getCode();
            if($Code != 1){
                return $Code;
            }
            $Data = $PBS_gm_get_shuihu_numerical_return->getData();
             // 影响玩家抽奖波动走势
            for ($i=0;$i<$Data->getCfgShuihuFluctuateCount();$i++){
                $CfgShuihuFluctuate[$i]['Index'] = $Data->getCfgShuihuFluctuate()[$i]->getIndex();
                $CfgShuihuFluctuate[$i]['Value'] = $Data->getCfgShuihuFluctuate()[$i]->getValue();
            }
            // 影响玩家抽奖波动幅度
            $CfgShuihuFluctuateRange['Max'] = $Data->getCfgShuihuFluctuateRange()->getMax();
            $CfgShuihuFluctuateRange['Min'] = $Data->getCfgShuihuFluctuateRange()->getMin();
            // 影响返奖率和最高返奖倍数
            $CfgShuihuReturnMultiple = $Data->getCfgShuihuReturnMultiple();
            //(-200,700)影响小玛丽最高奖励倍数上限和首次奖励即退出的概率
            $CfgShuiguojiRand1['Min'] = $Data->getCfgShuiguojiRand1()->getMin();
            $CfgShuiguojiRand1['Max'] = $Data->getCfgShuiguojiRand1()->getMax();
            // (1，100)/100  根据奖励种类设置，奖励种类调整则需要跟着调整
            $CfgShuiguojiRand2['Min'] = $Data->getCfgShuiguojiRand2()->getMin();
            $CfgShuiguojiRand2['Max'] = $Data->getCfgShuiguojiRand2()->getMax();
            // 水果机公式分母1
            $CfgShuiguojiDenominator1 = $Data->getCfgShuiguojiDenominator1();
            // 水果机公式分母2
            $CfgShuiguojiDenominator2 = $Data->getCfgShuiguojiDenominator2();
            $FunArray = array(
                 'CfgShuihuFluctuate'        =>    $CfgShuihuFluctuate,
                 'CfgShuihuFluctuateRange'   =>    $CfgShuihuFluctuateRange,
                 'CfgShuihuReturnMultiple'   =>    $CfgShuihuReturnMultiple,
                 'CfgShuiguojiRand1'         =>    $CfgShuiguojiRand1,
                 'CfgShuiguojiRand2'         =>    $CfgShuiguojiRand2,
                 'CfgShuiguojiDenominator1'  =>    $CfgShuiguojiDenominator1,
                 'CfgShuiguojiDenominator2'  =>    $CfgShuiguojiDenominator2,
            );
            return  $FunArray;
    }

    //设置数值
    public function SetVal($Serverid,$obj,$Version){
        $FunArray = array(
            'CfgShuihuFluctuate'        =>    I('param.CfgShuihuFluctuate','','trim'),
            'CfgShuihuFluctuateRange'   =>    I('param.CfgShuihuFluctuateRange','','trim'),
            'CfgShuihuReturnMultiple'   =>    I('param.CfgShuihuReturnMultiple','','trim'),
            'CfgShuiguojiRand1'         =>    I('param.CfgShuiguojiRand1','','trim'),
            'CfgShuiguojiRand2'         =>    I('param.CfgShuiguojiRand2','','trim'),
            'CfgShuiguojiDenominator1'  =>    I('param.CfgShuiguojiDenominator1','','trim'),
            'CfgShuiguojiDenominator2'  =>    I('param.CfgShuiguojiDenominator2','','trim'),
        );
        $PBS_gm_set_shuihu_numerical         = new PBS_gm_set_shuihu_numerical();
        $PBS_gm_set_shuihu_numerical_return  = new PBS_gm_set_shuihu_numerical_return();
        $cfg_shuihu_numerical                = new cfg_shuihu_numerical();
        $PBS_gm_set_shuihu_numerical->setServerid($Serverid);
        // 影响玩家抽奖波动走势
        $CfgShuihuFluctuate = new  cfg_shuihu_fluctuate();
        $CfgShuihuFluctuate->setValue($FunArray['CfgShuihuFluctuate']['Value']);
        $CfgShuihuFluctuate->setIndex($FunArray['CfgShuihuFluctuate']['Index']);
        $cfg_shuihu_numerical->appendCfgShuihuFluctuate($CfgShuihuFluctuate);
        // 影响玩家抽奖波动幅度
        $CfgShuihuFluctuateRange = new cfg_shuihu_fluctuate_range();
        $CfgShuihuFluctuateRange->setMax($FunArray['CfgShuihuFluctuateRange']['Max']);
        $CfgShuihuFluctuateRange->setMin($FunArray['CfgShuihuFluctuateRange']['Min']);
        $cfg_shuihu_numerical->setCfgShuihuFluctuateRange($CfgShuihuFluctuateRange);
        // 影响返奖率和最高返奖倍数
        $cfg_shuihu_numerical->setCfgShuihuReturnMultiple($FunArray['CfgShuihuReturnMultiple']);
        //(-200,700)影响小玛丽最高奖励倍数上限和首次奖励即退出的概率
        $CfgShuiguojiRand1 = new cfg_shuiguoji_rand_1();
        $CfgShuiguojiRand1->setMin($FunArray['CfgShuiguojiRand1']['Min']);
        $CfgShuiguojiRand1->setMax($FunArray['CfgShuiguojiRand1']['Max']);
        $cfg_shuihu_numerical->setCfgShuiguojiRand1($CfgShuiguojiRand1);
        // (1，100)/100  根据奖励种类设置，奖励种类调整则需要跟着调整
        $CfgShuiguojiRand2 = new cfg_shuiguoji_rand_2();
        $CfgShuiguojiRand2->setMin($FunArray['CfgShuiguojiRand2']['Min']);
        $CfgShuiguojiRand2->setMax($FunArray['CfgShuiguojiRand2']['Max']);
        $cfg_shuihu_numerical->setCfgShuiguojiRand2($CfgShuiguojiRand2);
        // 水果机公式分母1
        $cfg_shuihu_numerical->setCfgShuiguojiDenominator1($FunArray['CfgShuiguojiDenominator1']);
        // 水果机公式分母2
        $cfg_shuihu_numerical->setCfgShuiguojiDenominator2($FunArray['CfgShuiguojiDenominator2']);
        $PBS_gm_set_shuihu_numerical->setData($cfg_shuihu_numerical);
        //发送请求
        $ProtobufString =  $PBS_gm_set_shuihu_numerical->serializeToString();
        $Header = array(
            'PBName:'.'protos.PBS_gm_set_shuihu_numerical',
            'PBSize:'.strlen($ProtobufString),
            'UID:1',
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$Version,
        );
        $Respond   =  $obj->ProtobufSend($Header,$ProtobufString);
        if($Respond == 504){
            return false;
        }
        $PBS_gm_set_shuihu_numerical_return->parseFromString($Respond);
        $Code =$PBS_gm_set_shuihu_numerical_return->getCode();
        if($Code != 1){
            return false;
        }
        return true;
    }

}

