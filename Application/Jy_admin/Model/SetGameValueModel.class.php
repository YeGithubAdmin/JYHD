<?php
namespace jy_admin\Model;

use Protos\game_numerical_boss_rate_params_t;
use Protos\game_numerical_down_grade_t;
use Protos\game_numerical_fish_card_rate_t;
use Protos\game_numerical_gold_pool_ratio_t;
use Protos\game_numerical_key_recharge_effect_t;
use Protos\game_numerical_recharge_effect_t;
use Think\Model;
use Protos\game_numerical;

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
            'Protos/PBS_gm_numerical_require.php',
            'Protos/PBS_gm_numerical_op.php',
            'Protos/PBS_gm_numerical_op_return.php',
            'Protos/game_numerical.php',
            'Protos/PBS_gm_numerical_require_return.php',
            'Protos/game_numerical_gold_pool_ratio_t.php',
            'Protos/game_numerical_recharge_effect_t.php',
            'Protos/game_numerical_key_recharge_effect_t.php',
            'Protos/game_numerical_down_grade_t.php',
            'Protos/game_numerical_fish_card_rate_t.php',
            'Protos/game_numerical_boss_rate_params_t.php',

        ));
    }
    public function GetVal($Serverid,$obj,$Version){
        $PBS_gm_numerical_require           =  new PBS_gm_numerical_require();
        $PBS_gm_numerical_require_return    =   new PBS_gm_numerical_require_return();
        $PBS_gm_numerical_require->setServerid($Serverid);
        $PBS_gm_numerical_require_string    =  $PBS_gm_numerical_require->serializeToString();
        $Header = array(
            'PBName:'.'protos.PBS_gm_numerical_require',
            'PBSize:'.strlen($PBS_gm_numerical_require_string),
            'UID:1',
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$Version,
        );
        $PBS_gm_numerical_require_respond   =  $obj->ProtobufSend($Header,$PBS_gm_numerical_require_string);
        if($PBS_gm_numerical_require_respond == 504){
                return $PBS_gm_numerical_require_respond;
        }
        $PBS_gm_numerical_require_return->parseFromString($PBS_gm_numerical_require_respond);

        $Code = $PBS_gm_numerical_require_return->getCode();
        if($Code != 1){
            return $Code;
        }
        $Data = $PBS_gm_numerical_require_return->getData();
        // 奖池系数[a,b,c, A, B]
        $game_numerical_gold_pool_ratio_   = $Data->getGoldPoolRatio();
        $getGoldPoolRatio['getPoolLow']   = $game_numerical_gold_pool_ratio_->getPoolLow();
        $getGoldPoolRatio['getPoolHigh']  = $game_numerical_gold_pool_ratio_->getPoolHigh();
        $getGoldPoolRatio['getMid']       = $game_numerical_gold_pool_ratio_->getMid();
        $getGoldPoolRatio['getHigh']      = $game_numerical_gold_pool_ratio_->getHigh();
        $getGoldPoolRatio['getLow']       = $game_numerical_gold_pool_ratio_->getLow();
        $game_numerical_gold_pool_ratio_->getPoolLow();
        // 奖池系数[a,b,c, A, B]
        $game_numerical_recharge_effect_php = $Data->getRechargeEffect();
        $getRechargeEffect = array();
        for ($i=0;$i<$Data->getRechargeEffectCount();$i++){
            $getRechargeEffect[$i]['getAddRate'] = $game_numerical_recharge_effect_php[$i]->getAddRate();
            $getRechargeEffect[$i]['getPlanRecharge'] = $game_numerical_recharge_effect_php[$i]->getPlanRecharge();
            $getRechargeEffect[$i]['getPayType'] = $game_numerical_recharge_effect_php[$i]->getPayType();
        }

        // KEY鱼捕中加成：影响付费玩家接近临界值时对KEY鱼的捕中率加成
        $game_numerical_key_recharge_effect_ = $Data->getKeyRechargeEffect();
        $getKeyRechargeEffect = array();
        for ($i=0;$i<$Data->getKeyRechargeEffectCount();$i++){
            $getKeyRechargeEffect[$i]['getAddRate'] = $game_numerical_key_recharge_effect_[$i]->getAddRate();
            $getKeyRechargeEffect[$i]['getPlanRecharge'] = $game_numerical_key_recharge_effect_[$i]->getPlanRecharge();
            $getKeyRechargeEffect[$i]['getPayType'] = $game_numerical_key_recharge_effect_[$i]->getPayType();
        }
        // [downGrade]：控制临界值及到临界值时对玩家的补救倍数
        $game_numerical_down_grade_ = $Data->getDownGrade();
        $getDownGrade = array();
        for ($i=0;$i<$Data->getDownGradeCount();$i++){
            $getDownGrade[$i]['getNum']  = $game_numerical_down_grade_[$i]->getNum();
            $getDownGrade[$i]['getType'] = $game_numerical_down_grade_[$i]->getType();
        }
        // 渔券相关配置
        $game_numerical_fish_card_rate_  = $Data->getFishCardRate();
        $getFishCardRate = array();
        for ($i=0;$i<$Data->getFishCardRateCount();$i++){
            $getFishCardRate[$i]['getFcMax'] = $game_numerical_fish_card_rate_[$i]->getFcMax();
            $getFishCardRate[$i]['getRate']  = $game_numerical_fish_card_rate_[$i]->getRate();
        }
        // BOSS捕中率配置 核弹掉落率配置
        $game_numerical_boss_rate_params_ = $Data->getBossRateParams();
        $getBossRateParams = array();
        for ($i=0;$i<$Data->getFishCardRateCount();$i++){
            $getBossRateParams[$i]['getAuRate']    = $game_numerical_boss_rate_params_[$i]->getAuRate();
            $getBossRateParams[$i]['getAgRate']    = $game_numerical_boss_rate_params_[$i]->getAgRate();
            $getBossRateParams[$i]['getCuRate']    = $game_numerical_boss_rate_params_[$i]->getCuRate();
            $getBossRateParams[$i]['getCrrtParam'] = $game_numerical_boss_rate_params_[$i]->getCrrtParam();
            $getBossRateParams[$i]['getStage']     = $game_numerical_boss_rate_params_[$i]->getStage();
            $getBossRateParams[$i]['getBossId']    = $game_numerical_boss_rate_params_[$i]->getBossId();
        }
        $info = array(
            'getPoolRatio'              =>    $Data->getPoolRatio(),                 //dynamic
            'getLimitRatio'             =>    $Data->getLimitRatio(),
            'getChangePoint'            =>    $Data->getChangePoint(),
            'getFishCardP1'             =>    $Data->getFishCardP1(),
            'getFishCardP2'             =>    $Data->getFishCardP2(),
            'getBossAwardPoolLine'      =>    $Data->getBossAwardPoolLine(),
            'getGoldPoolPumpRate'       =>    $Data->getGoldPoolPumpRate(),
            'getReturnGoldRate'         =>    $Data->getReturnGoldRate(),
            'getGoldPool'               =>    $Data->getGoldPool(),                  //dynamic
            'getBossAwardPool'          =>    $Data->getBossAwardPool(),             //dynamic
            'getGoldPoolRatio'          =>    $getGoldPoolRatio,
            'getRechargeEffect'         =>    $getRechargeEffect,
            'getKeyRechargeEffect'      =>    $getKeyRechargeEffect,
            'getDownGrade'              =>    $getDownGrade,
            'getFishCardRate'           =>    $getFishCardRate,
            'getBossRateParams'         =>    $getBossRateParams,
        );
        return  $info;
    }

    //设置数值
    public function SetVal($Serverid,$obj,$Version){
        $PBS_gm_numerical_op            =    new PBS_gm_numerical_op();
        $PBS_gm_numerical_op_return     =    new PBS_gm_numerical_op_return();
        $PBS_gm_numerical               =    new game_numerical();

        $PBS_gm_numerical_op->setServerid($Serverid);


        $getLimitRatio              =   I('param.getLimitRatio','','trim');
        $getChangePoint             =   I('param.getChangePoint','','trim');
        $getFishCardP1              =   I('param.getFishCardP1','','trim');
        $getFishCardP2              =   I('param.getFishCardP2','','trim');
        $getBossAwardPoolLine       =   I('param.getBossAwardPoolLine','','trim');
        $getGoldPoolPumpRate        =   I('param.getGoldPoolPumpRate','','trim');
        $getReturnGoldRate          =   I('param.getReturnGoldRate','','trim');
        $getGoldPoolRatio           =   I('param.getGoldPoolRatio','','trim');



        $getRechargeEffect          =   I('param.getRechargeEffect','','trim');
        $getKeyRechargeEffect       =   I('param.getKeyRechargeEffect','','trim');
        $getDownGrade               =   I('param.getDownGrade','','trim');
        $getFishCardRate            =   I('param.getFishCardRate','','trim');
        $getBossRateParams          =   I('param.getBossRateParams','','trim');



        $a = array(
            '$getLimitRatio'=>$getLimitRatio,
            '$getChangePoint'=>$getChangePoint,
            '$getFishCardP1'=>$getFishCardP1,
            '$getFishCardP2'=>$getFishCardP2,
            '$getBossAwardPoolLine'=>$getBossAwardPoolLine,
            '$getGoldPoolPumpRate'=>$getGoldPoolPumpRate,
            '$getReturnGoldRate'=>$getReturnGoldRate,
            '$getGoldPoolRatio'=>$getGoldPoolRatio,
            '$getRechargeEffect'=>$getRechargeEffect,
            '$getKeyRechargeEffect'=>$getKeyRechargeEffect,
            '$getDownGrade'=>$getDownGrade,
            '$getFishCardRate'=>$getFishCardRate,
            '$getBossRateParams'=>$getBossRateParams,
        );




        $PBS_gm_numerical->setLimitRatio($getLimitRatio);
        $PBS_gm_numerical->setChangePoint($getChangePoint);
        $PBS_gm_numerical->setFishCardP1($getFishCardP1);
        $PBS_gm_numerical->setFishCardP2($getFishCardP2);
        $PBS_gm_numerical->setBossAwardPoolLine($getBossAwardPoolLine);
        $PBS_gm_numerical->setGoldPoolPumpRate($getGoldPoolPumpRate);
        $PBS_gm_numerical->setReturnGoldRate($getReturnGoldRate);


        $GoldPoolRatio  = new   game_numerical_gold_pool_ratio_t();
        $GoldPoolRatio->setPoolLow($getGoldPoolRatio['getPoolLow']);
        $GoldPoolRatio->setPoolHigh($getGoldPoolRatio['getPoolHigh']);
        $GoldPoolRatio->setMid($getGoldPoolRatio['getMid']);
        $GoldPoolRatio->setLow($getGoldPoolRatio['getLow']);
        $GoldPoolRatio->setHigh($getGoldPoolRatio['getHigh']);
        $PBS_gm_numerical->setGoldPoolRatio($GoldPoolRatio);

        $RechargeEffect  = new game_numerical_recharge_effect_t();
        $RechargeEffect->setPlanRecharge($getRechargeEffect['getPlanRecharge']);
        $RechargeEffect->setAddRate($getRechargeEffect['getAddRate']);
        $RechargeEffect->setPayType($getRechargeEffect['getPayType']);
        $PBS_gm_numerical->appendRechargeEffect($RechargeEffect);

        $KeyRechargeEffect = new game_numerical_key_recharge_effect_t();
        $KeyRechargeEffect->setPlanRecharge($getKeyRechargeEffect['getPlanRecharge']);
        $KeyRechargeEffect->setAddRate($getKeyRechargeEffect['getAddRate']);
        $KeyRechargeEffect->setPayType($getKeyRechargeEffect['getPayType']);
        $PBS_gm_numerical->appendKeyRechargeEffect($KeyRechargeEffect);

        $DownGrade =  new game_numerical_down_grade_t();
        $DownGrade->setType($getDownGrade['getType']);
        $DownGrade->setNum($getDownGrade['getNum']);
        $PBS_gm_numerical->appendDownGrade($DownGrade);

        $FishCardRate = new game_numerical_fish_card_rate_t();
        $FishCardRate->setFcMax($getFishCardRate['getFcMax']);
        $FishCardRate->setRate($getFishCardRate['getRate']);
        $PBS_gm_numerical->appendFishCardRate($FishCardRate);

        $BossRateParams = new game_numerical_boss_rate_params_t();
        $BossRateParams->setStage($getBossRateParams['getStage']);
        $BossRateParams->setAuRate($getBossRateParams['getAuRate']);
        $BossRateParams->setAgRate($getBossRateParams['getAgRate']);
        $BossRateParams->setCuRate($getBossRateParams['getCuRate']);
        $BossRateParams->setCrrtParam($getBossRateParams['getCrrtParam']);
        $BossRateParams->setBossId($getBossRateParams['getBossId']);
        $PBS_gm_numerical->appendBossRateParams($BossRateParams);

        $PBS_gm_numerical_op->setData($PBS_gm_numerical);

        $PBS_gm_numerical_op_string =  $PBS_gm_numerical_op->serializeToString();
        $Header = array(
            'PBName:'.'protos.PBS_gm_numerical_op',
            'PBSize:'.strlen($PBS_gm_numerical_op_string),
            'UID:1',
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$Version,
        );
        $PBS_gm_numerical_require_respond   =  $obj->ProtobufSend($Header,$PBS_gm_numerical_op_string);
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

