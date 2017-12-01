<?php
namespace jy_admin\Model;
use Protos\game_numerical_const_gold_pool_level;
use Protos\game_numerical_const_gold_pool_ratio;
use Think\Model;
use Protos\game_numerical;
use Protos\game_numerical_const_boss_rate_params;
use Protos\game_numerical_const_down_grade;
use Protos\game_numerical_const_fish_card_rate;
use Protos\game_numerical_const_key_recharge_effect;
use Protos\game_numerical_const_recharge_effect;
use Protos\game_numerical_const_return_gold_rate;
use Protos\game_numerical_dynamic_gold_pool;
use Protos\PBS_gm_numerical_op;
use Protos\PBS_gm_numerical_op_return;
use Protos\PBS_gm_numerical_require;
use Protos\PBS_gm_numerical_require_return;

class SetGameValueModel extends Model{
    protected $autoCheckFields = false;
    //获取数值

    public function __construct(){
        $obj = new \Common\Lib\func();
        $obj->ProtobufObj(array(
            'Protos/game_numerical.php',
            'Protos/PBS_gm_numerical_require_return.php',
            'Protos/PBS_gm_numerical_require.php',
            'Protos/PBS_gm_numerical_op_return.php',
            'Protos/PBS_gm_numerical_op.php',
            'Protos/game_numerical_const_boss_rate_params.php',
            'Protos/game_numerical_const_down_grade.php',
            'Protos/game_numerical_const_fish_card_rate.php',
            'Protos/game_numerical_const_key_recharge_effect.php',
            'Protos/game_numerical_const_recharge_effect.php',
            'Protos/game_numerical_const_return_gold_rate.php',

            'Protos/game_numerical_const_gold_pool_ratio.php',
            'Protos/game_numerical_const_gold_pool_level.php',
            'Protos/game_numerical_dynamic_gold_pool.php',
        ));
    }
    public function GetVal($Serverid,$obj){
        $PBS_gm_numerical_require           =  new PBS_gm_numerical_require();
        $PBS_gm_numerical_require_return    =   new PBS_gm_numerical_require_return();
        $PBS_gm_numerical_require->setServerid($Serverid);
        $PBS_gm_numerical_require_string    =  $PBS_gm_numerical_require->serializeToString();
        $PBS_gm_numerical_require_respond   =  $obj->ProtobufSend('protos.PBS_gm_numerical_require',$PBS_gm_numerical_require_string,1);
        if($PBS_gm_numerical_require_respond == 504){
                return $PBS_gm_numerical_require_respond;
        }
        $PBS_gm_numerical_require_return->parseFromString($PBS_gm_numerical_require_respond);
        $Code = $PBS_gm_numerical_require_return->getCode();
        if($Code != 1){
            return $Code;
        }
        $Data = $PBS_gm_numerical_require_return->getData();
        $getReturnGoldRate    = $Data->getReturnGoldRate();
        $getReturnGoldRateArray = array();
        for($i=0;$i<$Data->getReturnGoldRateCount();$i++){
            $getReturnGoldRateArray[$i]['GoldRate'] = $getReturnGoldRate[$i]->getRate();
            $getReturnGoldRateArray[$i]['RoomLevel'] = $getReturnGoldRate[$i]->getRoomLevel();
        }

        $getRechargeEffect          = $Data->getRechargeEffect();
        $getRechargeEffectArray     = array();
        for($i=0;$i<$Data->getRechargeEffectCount();$i++){
            $getRechargeEffectArray[$i]['AddRate'] = $getRechargeEffect[$i]->getAddRate();
            $getRechargeEffectArray[$i]['PayType'] = $getRechargeEffect[$i]->getPayType();
            $getRechargeEffectArray[$i]['PlanRecharge'] = $getRechargeEffect[$i]->getPlanRecharge();
        }

        $getKeyRechargeEffect          = $Data->getKeyRechargeEffect();
        $getKeyRechargeEffectArray     = array();
        for($i=0;$i<$Data->getRechargeEffectCount();$i++){
            $getKeyRechargeEffectArray[$i]['KeyAddRate'] = $getKeyRechargeEffect[$i]->getAddRate();
            $getKeyRechargeEffectArray[$i]['KeyPayType'] = $getKeyRechargeEffect[$i]->getPayType();
            $getKeyRechargeEffectArray[$i]['KeyPlanRecharge'] = $getKeyRechargeEffect[$i]->getPlanRecharge();
        }

        $getDownGrade         = $Data->getDownGrade();
        $getDownGradeArray     = array();
        for($i=0;$i<$Data->getDownGradeCount();$i++){
            $getDownGradeArray[$i]['Type'] = $getDownGrade[$i]->getType();
            $getDownGradeArray[$i]['Num'] = $getDownGrade[$i]->getNum();
        }

        $getFishCardRate      = $Data->getFishCardRate();

        $getFishCardRateArray     = array();
        for($i=0;$i<$Data->getFishCardRateCount();$i++){
            $getFishCardRateArray[$i]['FishRate'] = $getFishCardRate[$i]->getRate();
            $getFishCardRateArray[$i]['FishFcMax'] = $getFishCardRate[$i]->getFcMax();
        }

        $getBossRateParams    = $Data->getBossRateParams();
        $getBossRateParamsArray = array();
        for($i=0;$i<$Data->getBossRateParamsCount();$i++){
            $getBossRateParamsArray[$i]['BossId']    = $getBossRateParams[$i]->getBossId();
            $getBossRateParamsArray[$i]['Stage']     = $getBossRateParams[$i]->getStage();
            $getBossRateParamsArray[$i]['CrrtParam'] = $getBossRateParams[$i]->getCrrtParam();
            $getBossRateParamsArray[$i]['CuRate']    = $getBossRateParams[$i]->getCuRate();
            $getBossRateParamsArray[$i]['AgRate']    = $getBossRateParams[$i]->getAgRate();
            $getBossRateParamsArray[$i]['AuRate']    = $getBossRateParams[$i]->getAuRate();
        }

        $getGoldPoolRatio       = $Data->getGoldPoolRatio();
        $getGoldPoolRatioArray['low']     = $getGoldPoolRatio->getLow();
        $getGoldPoolRatioArray['mid']     = $getGoldPoolRatio->getMid();
        $getGoldPoolRatioArray['high']    = $getGoldPoolRatio->getHigh();


        $getGoldPoolLevel       = $Data->getGoldPoolLevel();
        $getGoldPoolLevelArray['low']     = $getGoldPoolLevel->getLow();
        $getGoldPoolLevelArray['high']    = $getGoldPoolLevel->getHigh();

        $getDynamicGoldPool       = $Data->getGoldPool();
        $getDynamicGoldPoolArray = array();
        for($i=0;$i<$Data->getGoldPoolCount();$i++){
            $getDynamicGoldPoolArray[$i]['RoomLevel']   = $getDynamicGoldPool[$i]->getRoomLevel();
            $getDynamicGoldPoolArray[$i]['PoolRatio']   = $getDynamicGoldPool[$i]->getPoolRatio();
            $getDynamicGoldPoolArray[$i]['Pool']        = $getDynamicGoldPool[$i]->getPool();
            $getDynamicGoldPoolArray[$i]['Pump']        = $getDynamicGoldPool[$i]->getPump();
        }
        $info    = array(
            'getReturnGoldRate'   =>    $getReturnGoldRateArray,
            'getRechargeEffect'   =>    $getRechargeEffectArray,
            'getKeyRechargeEffect'=>    $getKeyRechargeEffectArray,
            'getDownGrade'        =>    $getDownGradeArray,
            'getFishCardRate'     =>    $getFishCardRateArray,
            'getBossRateParams'   =>    $getBossRateParamsArray,
            'getGoldPoolRatio'    =>    $getGoldPoolRatioArray,
            'getGoldPoolLevel'    =>    $getGoldPoolLevelArray,
            'getDynamicGoldPool'  =>    $getDynamicGoldPoolArray,
            'base'=>array(
                'PoolRatio'=>$Data->getPoolRatio(),
                'LimitRatio'=>$Data->getLimitRatio(),
                'ChangePoint'=>$Data->getChangePoint(),
                'BossAwardPool'=>$Data->getBossAwardPool(),
                'FishCardP1'=>$Data->getFishCardP1(),
                'FishCardP2'=>$Data->getFishCardP2(),
                'GoldPoolPumpRate'=>$Data->getGoldPoolPumpRate(),
            ),
        );
        return  $info;
    }

    //设置数值
    public function SetVal($Serverid,$obj){
        $PBS_gm_numerical_op            =    new PBS_gm_numerical_op();
        $PBS_gm_numerical_op_return     =    new PBS_gm_numerical_op_return();
        $PBS_gm_numerical               =    new game_numerical();
        $const_return_gold_rate         =    new game_numerical_const_return_gold_rate();
        $PBS_gm_numerical_op->setServerid($Serverid);

        $RoomLevel                      =    I('param.RoomLevel',0,'intval');
        $Rate                           =    I('param.GoldRate',0,'trim');
        $const_return_gold_rate->setRate($Rate);
        $const_return_gold_rate->setRoomLevel($RoomLevel);
        $PBS_gm_numerical->appendReturnGoldRate($const_return_gold_rate);
        $const_recharge_effect          =   new game_numerical_const_recharge_effect();
        $PayType        = I('param.PayType','','trim');
        $AddRate        = I('param.AddRate','','trim');
        $PlanRecharge   = I('param.PlanRecharge',0,'intval');
        $const_recharge_effect->setAddRate($AddRate);
        $const_recharge_effect->setPayType($PayType);
        $const_recharge_effect->setPlanRecharge($PlanRecharge);
        $PBS_gm_numerical->appendRechargeEffect($const_recharge_effect);

        $const_key_recharge_effect      =   new game_numerical_const_key_recharge_effect();

        $KeyPayType        = I('param.KeyPayType','','trim');
        $KeyAddRate        = I('param.KeyAddRate','','trim');
        $KeyPlanRecharge   = I('param.KeyPlanRecharge',0,'intval');
        $const_key_recharge_effect->setPayType($KeyPayType);
        $const_key_recharge_effect->setAddRate($KeyAddRate);
        $const_key_recharge_effect->setPlanRecharge($KeyPlanRecharge);
        $PBS_gm_numerical->appendKeyRechargeEffect($const_key_recharge_effect);

        $const_down_grade               =   new game_numerical_const_down_grade();
        $Type                           =    I('param.Type','','trim');
        $Num                            =    I('param.Num',0,'intval');
        $const_down_grade->setType($Type);
        $const_down_grade->setNum($Num);
        $PBS_gm_numerical->appendDownGrade($const_down_grade);

        $const_fish_card_rate           =   new game_numerical_const_fish_card_rate();
        $FishFcMax                      =    I('param.FishFcMax',0,'intval');
        $FishRate                       =    I('param.FishRate',0,'intval');
        $const_fish_card_rate->setRate($FishRate);
        $const_fish_card_rate->setFcMax($FishFcMax);
        $PBS_gm_numerical->appendFishCardRate($const_fish_card_rate);

        $const_boss_rate_params   =   new game_numerical_const_boss_rate_params();
        $BossId                   =   I('param.BossId',0,'intval');
        $Stage                    =   I('param.Stage',0,'intval');
        $CrrtParam                =   I('param.CrrtParam',0,'intval');
        $CuRate                   =   I('param.CuRate',0,'intval');
        $AgRate                   =   I('param.AgRate',0,'intval');
        $Aurate                   =   I('param.AuRate',0,'intval');
        $const_boss_rate_params->setBossId($BossId);
        $const_boss_rate_params->setStage($Stage);
        $const_boss_rate_params->setCrrtParam($CrrtParam);
        $const_boss_rate_params->setCuRate($CuRate);
        $const_boss_rate_params->setAgRate($AgRate);
        $const_boss_rate_params->setAuRate($Aurate);
        $PBS_gm_numerical->appendBossRateParams($const_boss_rate_params);

        $const_gold_pool_ratio  =   new game_numerical_const_gold_pool_ratio();
        $Ratiolow               =   I('param.Ratiolow',0,'intval');
        $RatioMid               =   I('param.RatioMid',0,'intval');
        $RatioHigh              =   I('param.RatioHigh',0,'intval');
        $const_gold_pool_ratio->setHigh($RatioHigh);
        $const_gold_pool_ratio->setLow($Ratiolow);
        $const_gold_pool_ratio->setMid($RatioMid);
        $const_gold_pool_ratio->dump();
        $PBS_gm_numerical->setGoldPoolRatio($const_gold_pool_ratio);


        $const_gold_pool_level  =   new game_numerical_const_gold_pool_level();
        $LevelLow                =   I('param.LevelLow',0,'intval');
        $LevelHigh               =   I('param.LevelHigh',0,'intval');
        $const_gold_pool_level->setHigh($LevelLow);
        $const_gold_pool_level->setLow($LevelHigh);

        $PBS_gm_numerical->setGoldPoolLevel($const_gold_pool_level);
        $PBS_gm_numerical_op->setData($PBS_gm_numerical);


        $LimitRatio         = I('param.LimitRatio','','trim');
        $ChangePoint        = I('param.ChangePoint','','trim');
        $BossAwardPool      = I('param.BossAwardPool','','trim');
        $FishCardP1         = I('param.FishCardP1','','trim');
        $FishCardP2         = I('param.FishCardP2','','trim');
        $GoldPoolPumpRate   = I('param.GoldPoolPumpRate','','trim');
        $PBS_gm_numerical->setLimitRatio($LimitRatio);
        $PBS_gm_numerical->setChangePoint($ChangePoint);
        $PBS_gm_numerical->setBossAwardPool($BossAwardPool);
        $PBS_gm_numerical->setFishCardP1($FishCardP1);
        $PBS_gm_numerical->setFishCardP2($FishCardP2);
        $PBS_gm_numerical->setGoldPoolPumpRate($GoldPoolPumpRate);

        $PBS_gm_numerical_op_string =  $PBS_gm_numerical_op->serializeToString();

        $PBS_gm_numerical_require_respond   =  $obj->ProtobufSend('protos.PBS_gm_numerical_op',$PBS_gm_numerical_op_string,1);
        if($PBS_gm_numerical_require_respond == 504){
            return false;
        }
        $PBS_gm_numerical_op_return->parseFromString($PBS_gm_numerical_require_respond);
        $Code =$PBS_gm_numerical_op_return->getCode();
        if($Code != 1){
            return false;
        }
        return true;
    }

}

