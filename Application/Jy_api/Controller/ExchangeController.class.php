<?php
/***
 * 兑换
 * @param array   $msgArr  2*  成功  3.* 超时无响应  4.*丢失或参数缺失  5.* 服务器配置问题  6.*来不明  7.* 权限问题 8.* 配置问题
 * @param int     $page         页码
 * @param int     $num          页数
 * @param int     $channelid    渠道id
 * @param int     $platform     平台号  1-iso  2-安卓
 * @param unknow  $version      版本号
 ***/
namespace Jy_api\Controller;
use Jy_api\Controller\ComController;
use Protos\OptReason;
use Protos\OptSrc;
use Protos\PBS_ItemOpt;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class ExchangeController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $obj   = new \Common\Lib\func();
        $result = 2001;
        $info   =  array();
        $msgArr[3002] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3003] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3004] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3005] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3006] = "网络错误，请稍后再试！";
        $msgArr[4006] = "用户信息，缺失！";
        $msgArr[4007] = "物品信息，缺失！";
        $msgArr[5002] = "物品信息，缺失！";


        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }
        $GoodsID =  $DataInfo['GoodsID'];
        if(empty($GoodsID)){
            $result = 4007;
            goto response;
        }
        $Number = empty($DataInfo['Number'])? 1:$DataInfo['Number'];
        //查询物品信息
        $catGoodsAllFile = array(
            'Id',
            'Name',
            'Code',
            'CurrencyType',
            'CurrencyNum',
            'IssueType',
            'FaceValue',
            'GetNum',
            'Type',
        );
        $catGoodsAll = M('jy_goods_all')
                       ->where('Id ='.$GoodsID.' and IsDel = 1')
                       ->field($catGoodsAllFile)
                       ->find();
        //已入protobuf 类
        $obj->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'Protos/UsrDataOpt.php',
            'Protos/OptSrc.php',
            'RedisProto/RPB_PlayerData.php',
            'PB_Item.php',
            'OptReason.php',
            'RPB_PlayerNumerical.php',
        ));
        //实例化数据
        $PBS_UsrDataOprater = new PBS_UsrDataOprater();
        $PBS_ItemOpt        = new \PB_Item();
        $RPB_PlayerData     = new RPB_PlayerData();
        $UsrDataOpt         = new UsrDataOpt();
        $OptSrc             = new OptSrc();
        $OptReason          = new \OptReason();
        //填充数据
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBS_UsrDataOprater->setReason($OptReason::exchange);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $PBS_ItemOpt->setId(6);
        $PBS_ItemOpt->setNum(-$catGoodsAll['CurrencyNum']);
        $PBS_UsrDataOprater->appendItemOpt($PBS_ItemOpt);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$playerid);
        if($PBS_UsrDataOpraterRespond  == 504){
            $result = 3002;
            goto response;
        }
        if(strlen($PBS_UsrDataOpraterRespond)==0){
            $result = 3003;
            goto response;
        }
        //接受回应
        $PBS_UsrDataOpraterReturn =  new PBS_UsrDataOpraterReturn();
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = $ReplyCode;
            goto response;
        }

        $PBS_UsrDataOprater->reset();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBS_UsrDataOprater->setReason($OptReason::exchange);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        //判断类型
        $Type       = $catGoodsAll['Type'];
        $GetNum     = $catGoodsAll['GetNum'];
        $GoodsCode  = $catGoodsAll['Code'];
        $Status     =  2;
        $dataUsersGoodsStream     = array();      //道具流水
        $dataUsersCurrencyStream  = array();      //金币砖石流水
        switch ($Type){
            //金币
            case 1:
                $RPB_PlayerData->setGold($GetNum);
                $dataUsersCurrencyStream['playerid']       =   $playerid;
                $dataUsersCurrencyStream['Type']           =   4;
                $dataUsersCurrencyStream['CurrencyType']   =   1;
                $dataUsersCurrencyStream['Income']         =   1;
                $dataUsersCurrencyStream['Number']         =   $GetNum;
                break;
            //钻石
            case 2:
                $RPB_PlayerData->setDiamond($GetNum);
                $dataUsersCurrencyStream['playerid']       =   $playerid;
                $dataUsersCurrencyStream['Type']           =   4;
                $dataUsersCurrencyStream['CurrencyType']   =   2;
                $dataUsersCurrencyStream['Income']         =   1;
                $dataUsersCurrencyStream['Number']         =   $GetNum;
                break;
            //道具
            case 3:
                $PBS_ItemOpt  = new \PB_Item();
                $PBS_ItemOpt->setId($GoodsCode);
                $PBS_ItemOpt->setNum($GetNum);
                $PBS_UsrDataOprater->appendItemOpt($PBS_ItemOpt);
                $dataUsersGoodsStream['playerid']      =       $playerid;
                $dataUsersGoodsStream['Code']          =       $GoodsCode;
                $dataUsersGoodsStream['Type']          =       4;
                $dataUsersGoodsStream['Income']        =       1;
                $dataUsersGoodsStream['Number']        =       $GetNum;
                break;
            //话费卡
            default:
                $Status = 1;
                break;
        }
        $PBS_UsrDataOprater->setPlayerData($RPB_PlayerData);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        //发送请求
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$playerid);
        if($PBS_UsrDataOpraterRespond  == 504){
            $result = 3002;
            goto response;
        }
        if(strlen($PBS_UsrDataOpraterRespond)==0){
            $result = 3003;
            goto response;
        }
        //接受回应
        $PBS_UsrDataOpraterReturn =  new PBS_UsrDataOpraterReturn();
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = $ReplyCode;
            goto response;
        }
        //增加兑换记录
        $dataUsersExchangeLog = array(
            'Number'        =>      $Number,
            'GetNum'        =>      $GetNum,
            'Code'          =>      $GoodsCode,
            'GoodsName'     =>      $catGoodsAll['Name'],
            'playerid'      =>      $playerid,
            'Order'         =>      $obj->RandomNumber(),
            'StockNum'      =>      $catGoodsAll['CurrencyNum'] ,
            'GoodsID'       =>      $catGoodsAll['Id'],
            'Type'          =>      $catGoodsAll['Type'],
            'Channel'       =>      $DataInfo['channel'],
            'Status'        =>      $Status,
        );
        $addUsersExchangeLog = M('jy_users_exchange_log')
                              ->add($dataUsersExchangeLog);
        $addUsersCurrencyStream = 1;   //记录金币砖石流水
        $addUsersGoodsStream    = 1;                              //记录道具流水
        if(!empty($dataUsersCurrencyStream)){
            $addUsersCurrencyStream = M('jy_users_currency_stream')
                ->add($dataUsersCurrencyStream);
        }
        if(!empty($dataUsersGoodsStream)){
            $addUsersGoodsStream   = M('jy_users_goods_stream')
                ->add($dataUsersGoodsStream);
        }
        if(!$addUsersExchangeLog || !$addUsersCurrencyStream || !$addUsersGoodsStream){
            $result = 3006;
            goto response;
        }

        $info['Type'] =  $catGoodsAll['Type'];
        $info['Code'] =  $GoodsCode;
        $info['Number'] =  $Number*$GetNum;
        response:
            $response = array(
                'result' => $result,
                'msg' => $msgArr[$result],
                'sessionid'=>$DataInfo['sessionid'],
                'data' => $info,
            );
            $this->response($response,'json');


    }
}