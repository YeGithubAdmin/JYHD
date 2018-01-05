<?php
/***
 *  OPPO支付回调
 **/
namespace Jy_Thirdpay\Controller;
use Protos\OptReason;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class OppoBackController extends Controller {
    //回调数据
    public $dataThirdpay;
    //验签结果
    public $parseResp;
    //第三方支付状态
    public $tradeStatus;
    //订单ID
    public $OrderID;
    //第三方支付类型
    public $paytype;
    //支付金额
    public $money;

    public $PayCom;

    public $ComFun;


    public function __construct(){
        $dataThirdpay = $_POST;

        $PayCom =  D('PayCom');
        $ComFun =  D('ComFun');

        if(!is_array($dataThirdpay)){
            $dataThirdpay = json_decode($dataThirdpay,true);
        }
        $this->tradeStatus =  true;
        $this->OrderID     =  $dataThirdpay['partnerOrder'];
        $this->money       =  $dataThirdpay['price']*100;
        $this->paytype     =  0;
        $this->PayCom      =  $PayCom;
        $this->ComFun      = $ComFun;
        //验签
        $publickey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCmreYIkPwVovKR8rLHWlFVw7YDfm9uQOJKL89Smt6ypXGVdrAKKl0wNYc3/jecAoPi2ylChfa2iRu5gunJyNmpWZzlCNRIau55fxGW0XEu553IiprOZcaw5OuYGlf60ga8QT6qToP0/dpiL/ZbmNUO9kUhosIjEu22uFgR+5cYyQIDAQAB';
        $Pem = chunk_split($publickey,64,"\n");
        $Pem = "-----BEGIN PUBLIC KEY-----\n".$Pem."-----END PUBLIC KEY-----\n";
        $valueMap = $ComFun->UrlToArry($dataThirdpay);
        $this->parseResp =  $ComFun->PayVerification($valueMap,$dataThirdpay['sign'],$Pem);


    }
    public function index(){
        $PayCom       =   $this->PayCom;
        $ObjFun       =   $PayCom->ObjFun;
        $dataThirdpay =   $this->dataThirdpay;
        if(!is_array($dataThirdpay)){
            $dataThirdpay = json_decode($dataThirdpay,'true');
        }
        $PayCom->Recordlog($dataThirdpay);
        $msgArr = array(
            2001=>'支付成功！',
            3000=>'支付并发',
            3001=>'服务器无响应！',
            3002=>'服务器无响应！',
            3003=>'服务器错误！',
            3004=>'服务器无响应',
            3005=>'服务器无响应',
            3006=>'服务器错误！',
            3007=>'支付并发',
            4001=>'回调数据为空！',
            4002=>'数据不存在！',
            5001=>'订单不存在',
            5002=>'支付信息不存在！',
            5003=>'商品不存在！',
            5004=>'vip配置不存在！',
            7001=>'价格不匹配！',
            7002=>'验签失败！'
        );
        $result = 2001;
        if($dataThirdpay == null){
            $result = 4001;
            goto  failed;
        }
        //判断接收到的数据是否做过 Urldecode处理，如果没有处理则对数据进行Urldecode处理
        $parseResp =  $this->parseResp;
        if(!$parseResp){
            $result = 7002;
            goto OrderSave;
        }
        $OrderInfo    = $dataThirdpay;
        if(empty($OrderInfo)){
            $result = 4002;
            goto failed;
        }
        //支付状态  0 成功  1  失败
        if($this->tradeStatus){
            $result = 7003;
            goto failed;
        }
        //订单号
        $OrderID        =   $this->OrderID;
        //支付类型
        $paytype        =   $this->paytype;
        //金额
        $money          =   $this->money;
        /*************************以下通用****************************/
        //实例化数据
        $model = new Model();
        //查询订单信息
        $CatOrder =$PayCom->CatOrder($OrderID);
        if(empty($CatOrder)){
            $result = 5001;
            goto failed;
        }
        if($CatOrder['Status'] == 2){
            goto success;
        }
        //用户ID商品ID
        $appuserid      =  $CatOrder['appuserid'];
        $appuserid      =  explode('#',$appuserid);
        //商品ID
        $GoosID         =  $appuserid[1];
        //用户ID
        $playerid       =  $appuserid[0];
        //金额是否先匹配
        if($CatOrder['Price']  !=  $money){
            $result = 7001;
            goto OrderSave;
        }

        //查询商品
        $GoodsInfo = $PayCom->CatGoods($OrderID,$playerid);
        if(empty($GoodsInfo)){
            $result = 5003;
            goto OrderSave;
        }
        /**
         * 服务器查询
         * statr
         */
        //实例化对象
        $UsrDataOprater         =   $PayCom->UsrDataOprater;
        $PlayerData             =   $PayCom->PlayerData;
        $EmailType              =   $PayCom->EmailType;
        $Email                  =   $PayCom->Email;
        $OptSrc                 =   $PayCom->OptSrc;
        $UsrDataOpt             =   $PayCom->UsrDataOpt;
        $BuyGoods               =   $PayCom->BuyGoods;
        $PB_HallNotify          =   $PayCom->PB_HallNotify;
        $PB_PlayerVip           =   $PayCom->PB_PlayerVip;
        $ErrorCode              =   $PayCom->ErrorCode;
        $OptReason              =   $PayCom->OptReason;
        $PB_ResourceChange      =   $PayCom->PB_ResourceChange;
        $UsrDataOpraterReturn   =   $PayCom->UsrDataOpraterReturn;

        //设置protocbuf
        $PayCom->UsrDataOprater->setPlayerid($playerid);
        $PayCom->UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PayCom->UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $PayCom->PlayerData->setRmb($CatOrder['Price']);

        //支付成功
        $BuyGoods->setErr($ErrorCode::Error_success);
        $BuyGoods->setGoodsid($GoosID);
        //判断是否升级
        $VipLevel =    $CatOrder['VipLevel'];
        $VipExp   =    $CatOrder['VipExp'];
        $UpVipExp =    $VipExp+ $CatOrder['Price'];
        //查询Vip信息
        $VipInfo = $PayCom->VipInfo($UpVipExp);
        if(empty($VipInfo)){
            $result = 5004;
            goto OrderSave;
        }
        $PlayerData->setVipExp($UpVipExp);
        if($VipInfo['level'] != $VipLevel){
            $Statuslevel = $VipInfo['level'];
        }else{
            $PB_PlayerVip->setVip($VipLevel);
            $Statuslevel = $VipLevel;
        }
        $PB_PlayerVip->setVip($Statuslevel);
        $PB_PlayerVip->setExp($UpVipExp);
        //判断是否已经领取 1-否  2-是
        $Status = false;
        if($Statuslevel>0){
            $catVipRewardlog = $PayCom->Receive($playerid);
            if(empty($catVipRewardlog)){
                $Status=true;
            }
        }
        $PB_PlayerVip->setIsCanReward($Status);
        $PB_HallNotify->setPlayerVip($PB_PlayerVip);
        //是否升级 1 否  2 是
        if($VipInfo['level'] != $VipLevel){
            $PlayerData->setVip($VipInfo['level']);
            //发送邮件
            $Email->setSender('系统');
            $Email->setType($EmailType::EmailType_Sys);
            $Email->setTitle('vip等级提升');
            $Email->setData('恭喜您，vip等级提升到'.$VipInfo['level'].'，相关权限请查看vip等级信息列表。');
            $UsrDataOprater->setSendEmail($Email);
        }

        if($CatOrder['Form'] == 1){
            $UsrDataOprater->setReason($OptReason::first_pay);
            $PB_ResourceChange->setReason($OptReason::first_pay);
        }
        //是否月卡
        if($CatOrder['Form'] == 2){
            $UsrDataOprater->setReason($OptReason::buy_yueka_ok);
            $McOvertime = strtotime(date('Y-m-d',time()))+30*24*60*60;
            $PlayerData->setMcOvertime($McOvertime);
            $PlayerData->setIsMc(true);
            $dataLogUsersShop['Number'] = 1;
            $dataLogUsersShop['Type']   = $GoodsInfo[0]['Type'];
            $dataLogUsersShop['Code']   = $GoodsInfo[0]['GoodsCode'];
            $PlayerData->setDiamond(100);
            $Item = new \PB_Item();
            $Item->setId(9);
            $Item->setNum(100);
            $PB_ResourceChange->appendItems($Item);
            $PB_ResourceChange->setReason($OptReason::buy_yueka_ok);
        }
        if($CatOrder['Form'] == 3){
            $UsrDataOprater->setReason($OptReason::mall_reward_sdk);
            $PB_ResourceChange->setReason($OptReason::mall_reward_sdk);
        }
        //添加物品
        $IsGold = 1; //是否添加过金币 1-否 2是 注释：商城
        foreach ($GoodsInfo as $k=>$v){
            if($CatOrder['Form'] == 3){
                $IsGold = 2;
                $GoodsInfo[$k]['Num'] = $v['GetNum']*$v['Number']+($v['GetNum']*$v['Proportion'])*$v['Number']/100;
            }else{
                $GoodsInfo[$k]['Num'] = $v['GetNum']*$v['Number'];
            }
            if($v['IsGive'] == 1){
                $dataLogUsersShop['Number'] = $v['GetNum'];
                $dataLogUsersShop['Type']   = $v['Type'];
                $dataLogUsersShop['Code']   = $v['GoodsCode'];
            }

        }
        if($CatOrder['Form'] == 3 || $CatOrder['Form'] == 1){
            $PayCom->UserGoodsAdd($GoodsInfo);
        }
        if($IsGold == 2){
            $OptReason  =  new \OptReason();
            $UsrDataOprater->setReason($OptReason::pay_gold);
        }
        $PB_ResourceChange->setPlayerid($playerid);
        $PB_HallNotify->setResChanged($PB_ResourceChange);
        $PB_HallNotify->setBuyNotify($BuyGoods);
        $UsrDataOprater->setNotify($PB_HallNotify);
        $UsrDataOprater->setPlayerData($PlayerData);
        //反序列化
        $serialize = $UsrDataOprater->serializeToString();
        //发送请求
        $Header = array(
            'PBName:'.'protos.PBS_UsrDataOprater',
            'PBSize:'.strlen($serialize),
            'UID:'.$playerid,
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$CatOrder['Version'],
        );
        $Respond =  $ObjFun->ProtobufSend($Header,$serialize);
        if(strlen($Respond)!=0 && $Respond != 504){
            $UsrDataOpraterReturn->parseFromString($Respond);
            $ReplyCode = $UsrDataOpraterReturn->getCode();
            if($ReplyCode != 1 ){
                $result = 3006;
                goto OrderSave;
            }
        }else{
            $result = 3004;
            goto OrderSave;
        }

        $MoreThan = $playerid%10;
        //开启事物
        $model->startTrans();
        $dataUsersOrderInfo['CallbackTime']  = date('Y-m-d H:i:s',time());
        $dataUsersOrderInfo['PayType']       = $paytype;
        $dataUsersOrderInfo['MessAge']       = '状态码：'.$result.'说明：'.$msgArr[$result].';';
        $dataUsersOrderInfo['Status']        = 2;
        $UpUsersOrderInfo = $model
            ->table('jy_users_order_info')
            ->where('playerid  = '.$playerid.'  and    PlatformOrder = "'.$OrderID.'"')
            ->save($dataUsersOrderInfo);
        //添加购买物品记录
        $dataLogUsersShop['playerid'] = $playerid;
        $dataLogUsersShop['GoodsID'] = $GoosID;
        $dataLogUsersShop['Price'] = $money;
        $dataLogUsersShop['Form'] = $CatOrder['Form'];
        $addLogUsersShop  =  $model
            ->table('log_users_shop_'.$MoreThan)
            ->add($dataLogUsersShop);
        if($addLogUsersShop && $UpUsersOrderInfo){
            $model->commit();
            goto  success;
        }else{
            $result = 3000;
            $model->rollback();
            goto OrderSave;
        }
        success:
        echo 'result=OK&resultMsg=SUCCESS'."\n";
        exit();
        failed:
        $dataApiVisitLog = array(
            'Name'=>'支付订单',
            'Url'=>'/Jy_ThirdpayIapppay/MallShopBack/index',
            'Msg'=>$msgArr[$result],
            'Code'=>$result,
            'TimeOut'=>'',
            'AccessIP'=>$_SERVER['REMOTE_ADDR'],
        );
        $addApiVisitLog = M('jy_api_visit_log')
            ->add($dataApiVisitLog);
        $PayCom->Recordlog($dataApiVisitLog);


        echo 'result=OK&resultMsg='.$msgArr[$result].''."\n";
        exit();
        OrderSave:
        $dataUsersOrderInfo = array();   //订单数据
        $dataUsersOrderInfo['CallbackTime']  = date('Y-m-d H:i:s',time());
        $dataUsersOrderInfo['PayType']       = $paytype;
        $dataUsersOrderInfo['MessAge']       = '状态码：'.$result.'说明：'.$msgArr[$result].';';
        $dataUsersOrderInfo['Status']        = 4;

        $PayCom->Recordlog($dataUsersOrderInfo);

        $UpUsersOrderInfo = $model
            ->table('jy_users_order_info')
            ->where('playerid  = '.$playerid.'  and    PlatformOrder = "'.$OrderID.'"')
            ->save($dataUsersOrderInfo);
        echo 'result=OK&resultMsg='.$msgArr[$result].''."\n";
        exit();
    }



}