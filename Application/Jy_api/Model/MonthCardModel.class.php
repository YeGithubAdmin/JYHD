<?php
namespace Jy_api\Model;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Model;
class MonthCardModel extends Model{
    protected $autoCheckFields = false;
    public    $ObjFun;

    public function __construct(){
        $this->ObjFun = new \Common\Lib\func();
    }
    //获取用户信息
    public function UserInfo($playerid){
         $this->ObjFun->ProtobufObj(
             array(
                 'Protos/PBS_UsrDataOprater.php',
                 'Protos/PBS_UsrDataOpraterReturn.php',
                 'Protos/UsrDataOpt.php',
                 'Protos/OptSrc.php',
                 'OptReason.php',
                 'PB_Item.php',
                 'RPB_PlayerNumerical.php',
                 'RedisProto/RPB_PlayerData.php',
             )
         );
         $PBS_UsrDataOprater        = new PBS_UsrDataOprater();
         $PBS_UsrDataOpraterReturn  = new PBS_UsrDataOpraterReturn();
         $UsrDataOpt                = new UsrDataOpt();
         $OptSrc    = new OptSrc();
         $PBS_UsrDataOprater->setPlayerid($playerid);
         $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
         $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_Player);
         $ToString   =  $PBS_UsrDataOprater->serializeToString();
         $Respond =  $this->ObjFun->ProtobufSend('protos.PBS_UsrDataOprater',$ToString,$playerid);
        if($Respond  == 504 || strlen($Respond)==0){
                return false;
        }
        //接受回应
        $PBS_UsrDataOpraterReturn->parseFromString($Respond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
           return false;
        }
        $Base       =  $PBS_UsrDataOpraterReturn->getBase();

        return  array(
              'IsMc'       => $Base->getIsMc(),
              'McOvertime' => $Base->getMcOvertime(),
        );
    }
    //查询奖励
    public function GoodsList($GoodsAll){
        $GiveInfo           = json_decode($GoodsAll['GiveInfo'],true);
        if(empty($GiveInfo)){
            return false;
        }
        $CardGoodsInfo      = array();
        if(!empty($GiveInfo)){
            $GoodID = array();
            foreach ($GiveInfo as $k=>$v){
                $GoodID[] = $v['Id'];
            }
            $CardGoodsInfoFile  = array(
                'Id',
                'GetNum',
                'ImgCode',
                'Code',
                'Type',
            );
            $GoodID = implode(',',$GoodID);
            $CardGoodsInfo      =  M('jy_goods_all')
                ->field($CardGoodsInfoFile)
                ->where('Id in('.$GoodID.') and IsDel = 1')
                ->select();
            if(!empty($CardGoodsInfo)){
                foreach ($CardGoodsInfo as $k=>$v){
                    foreach ($GiveInfo as $key=>$val){
                        if($val['Id'] == $v['Id']){
                            $CardGoodsInfo[$k]['Number'] =  $val['GetNum'];
                            $CardGoodsInfo[$k]['Name']   =  $val['Name'];
                        }
                    }
                }
            }
        }
        return $CardGoodsInfo;
    }
    //当天是领取过月卡
    public  function IsReceive($playerid){
        $time = strtotime(date('Y-m-d',time()));
        $StartTime = date('Y-m-d H:i:s',$time);
        $EndTime   = date('Y-m-d H:i:s',$time+24*60*60);
        $catData = M('jy_users_card_receive_log')
                   ->where('playerid = '.$playerid.' and 
                            DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s") 
                            and DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")')
                   ->find();

        if(!empty($catData)){
            return true;
        }
        return false;
    }
    //添加物品
    public function AddGoods($CardGoodsInfo,$playerid){
        //已入protobuf 类
        $this->ObjFun->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'Protos/OptSrc.php',
            'Protos/UsrDataOpt.php',
            'OptReason.php',
            'RPB_PlayerNumerical.php',
            'RedisProto/RPB_PlayerData.php',
            'PB_Item.php',
        ));
        $PBS_UsrDataOprater  = new PBS_UsrDataOprater();
        $RPB_PlayerData      = new RPB_PlayerData();
        $UsrDataOpt          = new UsrDataOpt();
        $OptSrc              = new OptSrc();
        $OptReason           = new \OptReason();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $PBS_UsrDataOprater->setReason($OptReason::get_yueka_award);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);

        foreach ($CardGoodsInfo as $k=>$v){
            $num = $v['GetNum']*$v['Number'];
            switch ($v['Type']){
                //金币
                case  1 :
                    $RPB_PlayerData->setGold($num);

                    break;
                //砖石
                case  2 :
                    $RPB_PlayerData->setDiamond($num);
                    break;
                //道具
                case 3  :
                    $PB_Item  = new \PB_Item();
                    $PB_Item->setNum($num);
                    $PB_Item->setId($v['Code']);
                    $PBS_UsrDataOprater->appendItemOpt($PB_Item);
                    break;
            }
        }
        $PBS_UsrDataOprater->setPlayerData($RPB_PlayerData);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        //发送请求
        $PBS_UsrDataOpraterRespond =  $this->ObjFun->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$playerid);
        if(strlen($PBS_UsrDataOpraterRespond)==0 || $PBS_UsrDataOpraterRespond  == 504){
           return false;
        }
        //接受回应
        $PBS_UsrDataOpraterReturn =  new PBS_UsrDataOpraterReturn();
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            return false;
        }
        return true;
    }


}
