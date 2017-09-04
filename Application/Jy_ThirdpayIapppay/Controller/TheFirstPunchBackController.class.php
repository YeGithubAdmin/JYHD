<?php
/***
*  爱首冲支付回调
**/
namespace Jy_ThirdpayIapppay\Controller;
use Protos\PBS_ItemOpt;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class TheFirstPunchBackController extends Controller {
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
            $string= array_map ('urldecode',$dataThirdpay);
        }
        $respData    = 'transdata='.$dataThirdpay['transdata'].'&sign='.$dataThirdpay['sign'].'&signtype='.$dataThirdpay['signtype'];//把数据组装成验签函数要求的参数格式
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
        $CatUsersOrderInfoField = array(
            'playerid',
            'Price',
            'PayID',
        );
        $CatUsersOrderInfo = $model
                     ->table('jy_users_order_info')
                     ->where('PlatformOrder = '.$OrderID)
                     ->field($CatUsersOrderInfoField)
                     ->find();
        if(empty($CatUsersOrderInfo)){
            $result = 5001;
            goto failed;
        }
        //金额是否先匹配
        if($CatUsersOrderInfo['Price']  !=  $money){
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
                    ->where('Id = '.$CatUsersOrderInfo['PayID'].' and  IsDel = 1')
                    ->find();
        if(empty($Thirdpay)){
            $result = 5002;
            goto failed;
        }
        //验签
        $parseResp = parseResp($respData, $Thirdpay['public'], $respJson);
        if(!$parseResp){
            $result = 7002;
            goto failed;
        }


        /*****************************业务逻辑*********************************/
        //查询物品
        $GoodsInfoField = array(
            'GoodsName',
            'GoodsCode',
            'GetNum',
            'Proportion',
            'GoodsID',
            'IsGive',
            'Number',
            'Type',
        );
        $GoodsInfo = $model
                    ->table('jy_users_order_goods')
                    ->where('playerid = '.$CatUsersOrderInfo['playerid'].' and  PlatformOrder = "'.$OrderID.'"')
                    ->field($GoodsInfoField)
                    ->select();
        if(empty($GoodsInfo)){
            $result = 5002;
            goto failed;
        }
        /**************************服务器查询*******************/
        //已入protobuf 类
        $ObjFun->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'RedisProto/RPB_PlayerData.php',
            'Protos/PBS_ItemOpt.php',
        ));
        $PBS_UsrDataOprater = new PBS_UsrDataOprater();
        $PBS_UsrDataOprater->setPlayerid($CatUsersOrderInfo['playerid']);
        $PBS_UsrDataOprater->setOpt(2);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        //发送请求
        $PBS_UsrDataOpraterRespond =  $ObjFun->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$GoodsInfo['playerid']);

        if(strlen($PBS_UsrDataOpraterRespond)==0){
            $result = 3001;
            goto failed;
        }
        if($PBS_UsrDataOpraterRespond  == 504){
            $result = 3002;
            goto failed;
        }
        //接受回应
        $PBS_UsrDataOpraterReturn =  new PBS_UsrDataOpraterReturn();
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = 3003;
            goto failed;
        }
        //获得结果
        $PBS_UsrDataOpraterReturnBase  =  $PBS_UsrDataOpraterReturn->getBase();
        //vip等级
        $VipLevel =  $PBS_UsrDataOpraterReturnBase->getVip();
        //vip经验
        $VipExp   = $PBS_UsrDataOpraterReturnBase->getVipExp();
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
        //是否升级 1 否  2 是
        $upgrade = 1;
        if($VipInfo['level'] != $VipLevel){
            $upgrade = 2;
        }
        /********************服务器添加*******************/
        $PBS_UsrDataOprater->reset();
        $PBS_UsrDataOpraterReturn->reset();
        $PBS_ItemOpt        = new PBS_ItemOpt();
        $RPB_PlayerData     = new RPB_PlayerData();
        $PBS_UsrDataOprater->setPlayerid($GoodsInfo['playerid']);
        $PBS_UsrDataOprater->setOpt (5);
        $RPB_PlayerData->setVipExp($UpVipExp);
        if($upgrade == 2){
            $RPB_PlayerData->setVip($VipInfo['level']);
        }
        $IsAddProp = 1;
        foreach ($GoodsInfo as $k=>$v){
                  $num = $v['GetNum']*$v['Number'];

              switch ($v['Type']){
                  //金币
                  case 1:
                      $RPB_PlayerData->setGold($num);
                      break;
                  //砖石
                  case 2:
                      $RPB_PlayerData->setDiamond($num);
                      break;
                  //道具
                  case 3:
                      $IsAddProp = 2;
                      $PBS_ItemOpt->setNum($num);
                      $PBS_ItemOpt->setItemid($v['GoodsCode']);
                      break;
              }


        }
        $PBS_UsrDataOprater->setPlayerData($RPB_PlayerData);
        if($IsAddProp == 2){
            $PBS_UsrDataOprater->appendItemOpt($PBS_ItemOpt);
        }
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        //发送请求
        $PBS_UsrDataOpraterRespond =  $ObjFun->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$GoodsInfo['playerid']);

        if(strlen($PBS_UsrDataOpraterRespond)==0){
            $result = 3004;
            goto failed;
        }
        if($PBS_UsrDataOpraterRespond  == 504){
            $result = 3005;
            goto failed;
        }
        //接受回应
        $PBS_UsrDataOpraterReturn =  new PBS_UsrDataOpraterReturn();
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = 3006;
            goto failed;
        }
        //添加记录
        $model->startTrans();
        $dataUsersPackageShopLog = array(
            'playerid'=>$CatUsersOrderInfo['playerid'],
            'Type'=>1,
        );
        $addUsersPackageShopLog = $model
                           ->table('jy_users_package_shop_log')
                            ->addAll($dataUsersPackageShopLog);
        //修改订单
        $dataUsersOrderInfo = array(
            'CallbackTime'=>time(),
            'PayType'     =>$paytype,
            'Status'      => 2,
        );
        $UpUsersOrderInfo  = $model
            ->table('jy_users_order_info')
            ->where('playerid  = '.$CatUsersOrderInfo['playerid'].' and PlatformOrder = "'.$OrderID.'"')
            ->save($dataUsersOrderInfo);
        if($addUsersPackageShopLog && $UpUsersOrderInfo){
            $model->commit();
            goto  success;
        }else{

            $model->rollback();
            $result = 3000;
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