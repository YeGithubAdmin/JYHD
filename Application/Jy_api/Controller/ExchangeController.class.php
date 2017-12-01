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

        $msgArr[2001] = '兑换成功，已发放到邮件';
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
            'PB_Email.php',
            'EmailType.php',
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
        $EmailType          = new  \EmailType();
        $PB_Email           = new  \PB_Email();
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
        switch ($Type){
            //金币
            case 1:
                $PB_Email->setGold($GetNum);
                break;
            //钻石
            case 2:
                $PB_Email->setDiamond($GetNum);
                break;
            //道具
            case 3:
                $PBS_ItemOpt  = new \PB_Item();
                $PBS_ItemOpt->setId($GoodsCode);
                $PBS_ItemOpt->setNum($GetNum);
                $PB_Email->appendItems($PBS_ItemOpt);
                break;
            //话费卡
            default:
             $Status = 1;
                $PBS_UsrDataOprater->setExchangeRmb($catGoodsAll['FaceValue']);
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
        //设置用户
        $PBS_UsrDataOprater->reset();
        $PBS_UsrDataOpraterReturn->reset();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        //发送者
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        //发送类型
        $PBS_UsrDataOprater->setReason($OptReason::gm_tool);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $PB_Email->setType($EmailType::EmailType_Sys);
        //标题
        $PB_Email->setTitle('兑换通知');
        $PB_Email->setSender('系统');
        //正文
        if($Type <= 3){
            $PB_Email->setData('恭喜您成兑换'.$catGoodsAll['Name'].'。');
        }else{
            $msgArr[2001] = '兑换成功，该物品需要进行人审核，请留意邮件审核状态。';
            $PB_Email->setData('您兑换的'.$catGoodsAll['Name'].',需要进行审核，审核结果已邮件的形式发送到您的邮箱，请留意邮箱信息。');
        }
        $PBS_UsrDataOprater->setSendEmail($PB_Email);
        $UsrDataString = $PBS_UsrDataOprater->serializeToString();
        //发送请求
        $Respond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$UsrDataString,$playerid);
        if($Respond  == 504){
            $result = 3003;
            goto response;
        }
        if(strlen($Respond)==0){
            $result = 3004;
            goto response;
        }
        //接受回应
        $PBS_UsrDataOpraterReturn->parseFromString($Respond);
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
        if(!$addUsersExchangeLog){
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