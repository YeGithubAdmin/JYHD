<?php
namespace Jy_Thirdpay\Model;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Model;
class PayComModel extends Model {
    protected $autoCheckFields = false;
    public $UsrDataOprater;
    public $UsrDataOpraterReturn;
    public $PlayerData;
    public $EmailType;
    public $Email;
    public $OptSrc;
    public $UsrDataOpt;
    public $ErrorCode;
    public $BuyGoods;
    public $PB_ResourceChange;
    public $OptReason;
    public $PB_HallNotify;
    public $PB_PlayerVip;
    public $PB_Item;
    public $ObjFun;
    public $playerid;

    public function __construct(){
        $this->ObjFun = new \Common\Lib\func();
        $this->ObjFun->ProtobufObj(
            array(
                'Protos/PBS_UsrDataOprater.php',
                'Protos/PBS_UsrDataOpraterReturn.php',
                'RedisProto/RPB_PlayerData.php',
                'Protos/OptSrc.php',
                'Protos/UsrDataOpt.php',
                'OptReason.php',
                'PB_PlayerVip.php',
                'PB_HallNotify.php',
                'RPB_PlayerNumerical.php',
                'PB_Email.php',
                'PB_Item.php',
                'PB_ResourceChange.php',
                'PB_ErrorCode.php',
                'PB_BuyGoods.php',
                'EmailType.php',
            )
        );
        $this->UsrDataOprater           =   new PBS_UsrDataOprater();
        $this->UsrDataOpraterReturn     =   new PBS_UsrDataOpraterReturn();
        $this->PlayerData               =   new RPB_PlayerData();
        $this->EmailType                =   new \EmailType();
        $this->Email                    =   new \PB_Email();
        $this->OptSrc                   =   new OptSrc();
        $this->UsrDataOpt               =   new UsrDataOpt();
        $this->ErrorCode                =   new \PB_ErrorCode();
        $this->BuyGoods                 =   new \PB_BuyGoods();
        $this->PB_ResourceChange        =   new \PB_ResourceChange();
        $this->OptReason                =   new \OptReason();
        $this->PB_HallNotify            =   new \PB_HallNotify();
        $this->PB_PlayerVip             =   new \PB_PlayerVip();
    }


    /***
    *  查询订单
    *  @param string  $PlatformOrder 订单号
    *  @param string  $playerid      用户ID
    */
    public function CatOrder($OrderID,$playerid =''){

        if(empty($OrderID)){
            return false;
        }

        $Field = array(
            'VipLevel',
            'VipExp',
            'playerid',
            'appuserid',
            'Price',
            'Status',
            'PayID',
            'Form',
            'Version',
        );
        if(!empty($playerid)){
            $where = 'playerid = '.$playerid.' PlatformOrder = "'.$OrderID.'"';
        }else{
            $where = ' PlatformOrder = "'.$OrderID.'"';
        }
        $CatData = M('jy_users_order_info')
                  ->where($where)
                  ->field($Field)
                  ->find();
        return $CatData;
    }
    /***
    * 查询商品
    * @param  int $GoodsID 商品ID
    */
    public function  CatGoods($OrderID,$playerid){
        $Field = array(
            'GoodsName',
            'GoodsCode',
            'GetNum',
            'Proportion',
            'GoodsID',
            'IsGive',
            'Number',
            'Type',
        );
        $CatData = M('jy_users_order_goods')
            ->where('playerid = '.$playerid.' and  PlatformOrder = "'.$OrderID.'"')
            ->field($Field)
            ->select();
        return $CatData;
    }
    /***
    * 设置物品&下推
    * @param array $Goods 物品
    */
    public  function  UserGoodsAdd($Goods){
         foreach ($Goods as $k=>$v){
             switch ($v['Type']){
                 case 1:
                     $this->PlayerData->setGold($v['Num']);
                     $PB_Item = new \PB_Item();
                     $PB_Item->setNum($v['Num']);
                     $PB_Item->setId(8);
                     $this->PB_ResourceChange->appendItems($PB_Item);
                     break;
                 case 2:
                     $this->PlayerData->setDiamond($v['Num']);
                     $PB_Item = new \PB_Item();
                     $PB_Item->setNum($v['Num']);
                     $PB_Item->setId(9);
                     $this->PB_ResourceChange->appendItems($PB_Item);
                     break;
                 case 3:
                     $Item = new \PB_Item();
                     $Item->setId($v['GoodsCode']);
                     $Item->setNum($v['Num']);
                     $this->UsrDataOprater->appendItemOpt($Item);
                     $PB_Item = new \PB_Item();
                     $PB_Item->setNum($v['Num']);
                     $PB_Item->setId($v['GoodsCode']);
                     $this->PB_ResourceChange->appendItems($PB_Item);
                     break;
             }
         }
    }

    /**
    *  查询vip
    */
    public function VipInfo($UpVipExp){
        $VipInfoField = array(
            'level',
            'experience',
        );
        $VipInfo = M('jy_vip_info')
                   ->field($VipInfoField)
                   ->where('experience <= '.$UpVipExp)
                   ->order('level desc')
                   ->find();
        return $VipInfo;
    }
    /***
    * 查询当是否已经领取Vip奖励
    */
    public function Receive($playerid){
        $catVipRewardlogField = array(
            'Id',
        );
        $strtotime = strtotime(date('Y-m-d'),time());
        $StartTime = date('Y-m-d H:i:s',$strtotime);
        $EndTime   = date('Y-m-d H:i:s',$strtotime+24*60*60);
        $catVipRewardlog = M('jy_vip_reward_log')
            ->where('playerid = '.$playerid.'  and  DateTime  >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  and   DateTime <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($catVipRewardlogField)
            ->find();
        return $catVipRewardlog;
    }
    /***
    *  记录
    */
    public function Recordlog($data){
        //是否开启日志
        if(is_array($data)){
            $dataThirdpay = json_encode($data);
        }else{
            $dataThirdpay = $data;
        }
        if(C('ACCESS_lOGS')){
            $dir = C('YQ_ROOT').'Log/pay/'.date('Y').'/'.date('m').'/'.date('d').'/';
            $this->ObjFun->record_log($dir,'access_'.date('Ymd').'.log',$dataThirdpay);
        }
    }



    /***
     *  查询订单 腾讯应用宝
     *  @param string  $PlatformOrder 订单号
     *  @param string  $playerid      用户ID
     */
    public function AtCatOrder($ATtoken,$playerid){
        if(empty($OrderID)){
            return false;
        }
        $Field = array(
            'VipLevel',
            'VipExp',
            'playerid',
            'appuserid',
            'Price',
            'PayType',
            'Status',
            'PayID',
            'Form',
            'PlatformOrder',
            'Version',
        );
        if(!empty($playerid)){
            $where = 'playerid = '.$playerid.' ATtoken = "'.$ATtoken.'"';
        }else{
            $where = ' PlatformOrder = "'.$OrderID.'"';
        }
        $CatData = M('jy_users_order_info')
            ->where($where)
            ->field($Field)
            ->find();
        return $CatData;
    }


}
