<?php
/***
*  爱贝月卡支付回调
**/
namespace Jy_ThirdpayIapppay\Controller;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class CardBackController extends Controller {
    public function index(){
        include IAPPPAY.'base.php';
        $ObjFun   = new \Common\Lib\func();
        $dataThirdpay = $_POST;
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
            3008=>'支付失败',
            4001=>'回调数据为空！',
            4002=>'订单不存在！',
            5001=>'订单不存在',
            5002=>'支付信息不存在！',
            5003=>'商品部存在！',
            5004=>'vip配置不存在！',
            7001=>'价格不匹配！',
            7002=>'验签失败！'

        );
        $result = 2001;
        if($dataThirdpay == null){
            $result = 4001;
            goto  failed;
        }

        $transdata=  $dataThirdpay['transdata'];
        if(stripos("%22",$transdata)){ //判断接收到的数据是否做过 Urldecode处理，如果没有处理则对数据进行Urldecode处理
            $dataThirdpay= array_map ('urldecode',$dataThirdpay);
        }
        $TransdataResult = $dataThirdpay['result'];


        $respData    = 'transdata='.$dataThirdpay['transdata'].'&sign='.$dataThirdpay['sign'].'&signtype='.$dataThirdpay['signtype'];//把数据组装成验签函数要求的参数格式
        //回调信息
        $OrderInfo =  json_decode($dataThirdpay['transdata'],true);

        if(empty($OrderInfo)){
            $result = 4002;
            goto failed;
        }
        //订单号
        $OrderID = $OrderInfo['cporderid'];
        //支付类型
        $paytype = $OrderInfo['paytype'];
        //金额
        $money   = $OrderInfo['money'];
        //实例化数据
        $model = new Model();
        //查询订单信息
        $GoodsInfoField = array(
            'playerid',
            'Price',
            'PayID',
        );
        $GoodsInfo = $model
                     ->table('jy_users_order_info')
                     ->where('PlatformOrder = "'.$OrderID.'"')
                     ->field($GoodsInfoField)
                     ->find();
        if(empty($GoodsInfo)){
            $result = 5001;
            goto failed;
        }
        //金额是否先匹配
        if($GoodsInfo['Price']  !=  $money){
            $result = 7001;
            goto failed;
        }
        //查询支付信息
        $ThirdpayField = array(
            'public',
            'private',
            'appid',
        );
        $Thirdpay = $model
                    ->table('jy_thirdpay')
                    ->field($ThirdpayField)
                    ->where('Id = '.$GoodsInfo['PayID'].' and  IsDel = 1')
                    ->find();
        if(empty($Thirdpay)){
            $result = 5002;
            goto failed;
        }
        //验签
        $parseResp = parseResp($respData,$Thirdpay['public'], $respJson);
        if(!$parseResp){
            $result = 7002;
            goto failed;
        }

        /**********************业务逻辑***********************/
        $UsersOrderGoodsField = array(
            'GoodsID',
            'Type',
            'IsGive',
            'Number*GetNum as Number',
        );
        $UsersOrderGoods = $model
                            ->table('jy_users_order_goods')
                            ->where('playerid = '.$GoodsInfo['playerid'].' and  PlatformOrder = "'.$OrderID.'"')
                            ->field($UsersOrderGoodsField)
                            ->select();
        if(empty($UsersOrderGoods)){
            $result = 5003;
            goto failed;
        }
        $setGoodsid = '';
        foreach ($UsersOrderGoods as $k=>$v){
            if($v['IsGive']== 1){
                $setGoodsid = $v['GoodsID'];
            }
        }
        /**************************服务器查询*******************/
        //已入protobuf 类
        $ObjFun->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'Protos/OptSrc.php',
            'Protos/UsrDataOpt.php',
            'RedisProto/RPB_PlayerData.php',
            'PB_Email.php',
            'PB_ErrorCode.php',
            'PB_BuyGoods.php',
            'EmailType.php',

        ));
        //实例化对象
        $UsrDataOprater          =   new PBS_UsrDataOprater();
        $OptSrc                  =   new OptSrc();
        $UsrDataOpt              =   new UsrDataOpt();
        $ErrorCode               =   new \PB_ErrorCode();
        $PlayerData              =   new RPB_PlayerData();
        $BuyGoods                =   new \PB_BuyGoods();
        $Return                  =   new PBS_UsrDataOpraterReturn();
        /**
        *  获取用户信息
        *  @param   $upgrade  int   是否升级 1-否  2-是
        *  @param   $UpVipExp int   下个等级经验
        *  @param   $VipInfo  array vip等级信息
        ***************/
        $upgrade  = 1;
        $UpVipExp = '';
        $VipInfo = array();
        if($TransdataResult == 0){
            $UsrDataOprater->setPlayerid($GoodsInfo['playerid']);
            $UsrDataOprater->setOpt($UsrDataOpt::Request_Player);
            $UsrDataOprater->setSrc($OptSrc::Src_PHP);
            $String = $UsrDataOprater->serializeToString();
            //发送请求
            $UsrDataOpraterRespond =  $ObjFun->ProtobufSend('protos.PBS_UsrDataOprater',$String,$GoodsInfo['playerid']);
            if(strlen($UsrDataOpraterRespond)==0){
                $result = 3001;
                goto failed;
            }
            if($UsrDataOpraterRespond  == 504){
                $result = 3002;
                goto failed;
            }
            //接受回应

            $Return->parseFromString($UsrDataOpraterRespond);
            $ReplyCode = $Return->getCode();
            //判断结果
            if($ReplyCode != 1){
                $result = 3003;
                goto failed;
            }
            //获得结果
            $ReturnBase  =  $Return->getBase();
            //vip等级
            $VipLevel =  $ReturnBase->getVip();
            //vip经验
            $VipExp   = $ReturnBase->getVipExp();
            //判断是否升级
            $UpVipExp =    $VipExp+ $GoodsInfo['Price'];

            //查询Vip信息
            $VipInfoField = array(
                'level',
                'experience',
            );
            $VipInfo = $model
                ->table('jy_vip_info')
                ->field($VipInfoField)
                ->where('experience <= '.$UpVipExp)
                ->order('level desc')
                ->find();
            if(empty($VipInfo)){
                $result = 5004;
                goto failed;
            }
            if($VipInfo['level'] != $VipLevel){
                $upgrade = 2;
            }
        }

        /**************************服务器添加*******************/
        $Btime = time()+24*60*60*30;
        $UsrDataOprater->reset();
        $Return->reset();
        $UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $UsrDataOprater->setPlayerid($GoodsInfo['playerid']);
        $UsrDataOprater->setOpt ($UsrDataOpt::Modify_Player);
        $setErr = $TransdataResult == 0 ? $ErrorCode::Error_success:$ErrorCode::Error_buy_fail;
        $BuyGoods->setErr($setErr);
        $BuyGoods->setGoodsid($setGoodsid);
        //支付是否成功
        if($TransdataResult == 0){
            $PlayerData->setDiamond(100);
            $PlayerData->setVipExp($UpVipExp);
            if($upgrade == 2){
                $PlayerData->setVip($VipInfo['level']);
                $Email       =   new \PB_Email();
                $EmailType   =   new \EmailType();
                $Email->setType($EmailType::EmailType_Sys);
                $Email->setTitle('vip升级通知');
                $Email->setData('恭喜您，你的vip提升到'.$VipInfo['level']);
                $Email->setSender('系统');
            }
            $PlayerData->setIsMc(true);
            $PlayerData->setMcOvertime($Btime);
            $UsrDataOprater->setPlayerData($PlayerData);
        }
        //添加支付结果
        $UsrDataOprater->setBuyGoodsNotify($BuyGoods);
        $String = $UsrDataOprater->serializeToString();
        //发送请求
        $UsrDataOpraterRespond =  $ObjFun->ProtobufSend('protos.PBS_UsrDataOprater',$String,$GoodsInfo['playerid']);
        if(strlen($UsrDataOpraterRespond)==0){
            $result = 3004;
            goto failed;
        }
        if($UsrDataOpraterRespond  == 504){
            $result = 3005;
            goto failed;
        }
        //接受回应
        $Return =  new PBS_UsrDataOpraterReturn();
        $Return->parseFromString($UsrDataOpraterRespond);
        $ReplyCode = $Return->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = 3006;
            goto failed;
        }
        if($TransdataResult == 0){
            //启动事物
            $model->startTrans();
            /**************************记录*******************/
            $dataUsersCardShopLog =  array(
                'playerid'=>$GoodsInfo['playerid'],
            );

            $dataUsersCardShopLog = $model
                ->table('jy_users_card_shop_log')
                ->add($dataUsersCardShopLog);
            /*************************更改订单状态************/
            $dataUsersOrderInfo = array(
                'CallbackTime'=>time(),
                'PayType'     =>$paytype,
                'Status'      => 2,
            );
            $UpUsersOrderInfo  = $model
                ->table('jy_users_order_info')
                ->where('playerid  = '.$OrderInfo['playerid'].' and PlatformOrder = "'.$OrderID.'"')
                ->save($dataUsersOrderInfo);
            if($dataUsersCardShopLog && $UpUsersOrderInfo){
                $model->commit();
                goto  success;
            }else{
                $model->rollback();
                $result = 3000;
                goto  failed;
            }
        }else{
            $result = 3008;
            goto  failed;
        }

        success:
            echo 'success'."\n";
            exit();
        failed:
        $dataApiVisitLog = array(
            'Name'=>'支付订单',
            'Url'=>'/Jy_ThirdpayIapppay/CardBack/index',
            'Msg'=>$msgArr[$result],
            'Code'=>$result,
            'TimeOut'=>'',
            'AccessIP'=>$_SERVER['REMOTE_ADDR'],
        );
        $addApiVisitLog = M('jy_api_visit_log')
            ->add($dataApiVisitLog);

            echo 'failed'."\n";
            exit();

    }
}