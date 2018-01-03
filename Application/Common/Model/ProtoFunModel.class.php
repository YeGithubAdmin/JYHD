<?php
namespace Common\Model;
use Protos\OptSrc;
use Protos\PBS_ConfigChanged;
use Protos\PBS_ConfigChangedReturn;
use Protos\PBS_SendEmail2All;
use Protos\PBS_SendEmail2AllReturn;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Model;
class ProtoFunModel extends Model{
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
    public $PBS_ConfigChanged;
    public $PBS_ConfigChangedReturn;
    public $PBS_SendEmail2All;
    public $PBS_SendEmail2AllReturn;
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
                'Protos/PBS_ConfigChanged.php',
                'Protos/PBS_ConfigChangedReturn.php',
                'Protos/PBS_SendEmail2All.php',
                'Protos/PBS_SendEmail2AllReturn.php'
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
        $this->PBS_ConfigChanged        =   new PBS_ConfigChanged();
        $this->PBS_ConfigChangedReturn  =   new PBS_ConfigChangedReturn();
        $this->PBS_SendEmail2All        =   new PBS_SendEmail2All();
        $this->PBS_SendEmail2AllReturn  =   new PBS_SendEmail2AllReturn();

    }
    //添加物品
    public  function  UserGoodsAdd($Goods){
        foreach ($Goods as $k=>$v){
            switch ($v['Type']){
                case 1:
                    $this->PlayerData->setGold($v['Num']);
                    break;
                case 2:
                    $this->PlayerData->setDiamond($v['Num']);
                    break;
                case 3:
                    $Item = new \PB_Item();
                    $Item->setId($v['GoodsCode']);
                    $Item->setNum($v['Num']);
                    $this->UsrDataOprater->appendItemOpt($Item);
                    break;
            }
        }

    }
    //发送邮件
    public function SendMail($param,$type,$Goods = array()){
        $Email      = $this->Email;
        $EmailType  = $this->EmailType;
        if($type == 1){
            $Email->setType($EmailType::EmailType_Sys);
            foreach ($Goods as $k=>$v){
                switch ($v['Type']){
                    //金币
                    case 1:
                        $Email->setGold($v['Number']);
                        break;
                    //钻石
                    case 2:
                        $Email->setDiamond($v['Number']);
                        break;
                    //道具
                    case 3:
                        $PBS_ItemOpt  = new \PB_Item();
                        $PBS_ItemOpt->setId($v['Code']);
                        $PBS_ItemOpt->setNum($v['Number']);
                        $Email->appendItems($PBS_ItemOpt);
                        break;
                }
            }
        }else if ($type == 2){
            $Email->setCardPwd($param['CardPwd']);
            $Email->setCardNum($param['CardNum']);
            $Email->setType($EmailType::EmailType_Card);
        }
        $Email->setTitle($param['Title']);
        $Email->setSender($param['Sender']);
        $Email->setData($param['Data']);
        $this->UsrDataOprater->setSendEmail($Email);
    }

    /*后台推*/
    public function   PushDown($Param,$Version,$Chanel,$Debug =false){
        $PBS_ConfigChanged          = $this->PBS_ConfigChanged;
        $PBS_ConfigChangedReturn    = $this->PBS_ConfigChangedReturn;
        $PBS_ConfigChanged->setChannel($Chanel);
        $PBS_ConfigChanged->setCfgType($Param);
        if($Debug){
            $PBS_ConfigChanged->dump();
        }
        $String = $PBS_ConfigChanged->serializeToString();
        $Header = array(
            'PBName:'.'protos.PBS_ConfigChanged',
            'PBSize:'.strlen($String),
            'UID:1',
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$Version,
        );
        $Respond  = $this->ObjFun->ProtobufSend($Header,$String);
        if($Respond == 504){
            return false;
        }
        $PBS_ConfigChangedReturn->parseFromString($Respond);
        $ReplyCode = $PBS_ConfigChangedReturn->getCode();
        if($ReplyCode != 1){
            return false;
        }
        return true;
    }
    //客服下推
    public function FeedBack($playerid,$Version){
        $UsrDataOprater         = $this->UsrDataOprater;
        $UsrDataOpraterReturn   = $this->UsrDataOpraterReturn;
        $PB_HallNotify          = $this->PB_HallNotify;
        $OptSrc                 = $this->OptSrc;
        $UsrDataOpt             = $this->UsrDataOpt;
        $PB_HallNotify->setCsNewMsg(true);
        $UsrDataOprater->setPlayerid($playerid);
        $UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $UsrDataOprater->setNotify($PB_HallNotify);
        $String = $UsrDataOprater->serializeToString();
        $Header = array(
            'PBName:'.'protos.PBS_UsrDataOprater',
            'PBSize:'.strlen($String),
            'UID:1',
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$Version,
        );
        $Respond = $this->ObjFun->ProtobufSend($Header,$String);

        if($Respond == 504){
            return false;
        }

        if(strlen($Respond) == 0){
            return false;
        }

        $UsrDataOpraterReturn->parseFromString($Respond);
        $ReplyCode = $UsrDataOpraterReturn->getCode();
        if($ReplyCode != 1){
            return false;
        }
        return true;

    }


}
