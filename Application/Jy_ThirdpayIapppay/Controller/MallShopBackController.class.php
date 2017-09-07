<?php
/***
*  爱贝商城支付回调
**/
namespace Jy_ThirdpayIapppay\Controller;
use Protos\OptSrc;
use Protos\PBS_ItemOpt;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class MallShopBackController extends Controller {
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
        $dataThirdpay ='{"transdata":"{\"appid\":\"3015007654\",\"appuserid\":\"100060#8\",\"cporderid\":\"JYHD2017090510297984\",\"cpprivate\":\"JYHD2017090510297984\",\"currency\":\"RMB\",\"feetype\":0,\"money\":30,\"paytype\":103,\"result\":1,\"transid\":\"32461709051927432068\",\"transtime\":\"2017-09-05 19:34:12\",\"transtype\":0,\"waresid\":3}","sign":"UFLsuiZynuuVoilo466CHuLaXD6LkmPuGeX2DfEqjgUbL8GnFPHsGZxAo4eE7NSNlErfbT8MK5YkQtm0kdJng07bCPJwP7CPSjx2HzNYtihiGLwtEMiTM7ZPSve5sLeQ3kRBdkmgUZ6oRGlU0SFG3F+dQLLyLfTCk0vdBsGMPlU=","signtype":"RSA"}';
        $dataThirdpay = json_decode($dataThirdpay,true);
        $result = 2001;
        if($dataThirdpay == null){
            $result = 4001;
            goto  failed;
        }
        $transdata=  $dataThirdpay['transdata'];
        if(stripos("%22",$transdata)){ //判断接收到的数据是否做过 Urldecode处理，如果没有处理则对数据进行Urldecode处理
            $dataThirdpay= array_map ('urldecode',$dataThirdpay);
        }
        $respData    = 'transdata='.$dataThirdpay['transdata'].'&sign='.$dataThirdpay['sign'].'&signtype='.$dataThirdpay['signtype'];//把数据组装成验签函数要求的参数格式
        $OrderInfo   =  json_decode($dataThirdpay['transdata'],true);
        if(empty($dataThirdpay)){
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
                     ->where('PlatformOrder = "'.$OrderID.'"')
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
        if($parseResp){
            $result = 7002;
            goto failed;
        }

        $TransdataResult = $OrderInfo['result'];
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
            $result = 5003;
            goto failed;
        }
        /**************************服务器查询*******************/
        //已入protobuf 类
        $ObjFun->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'RedisProto/RPB_PlayerData.php',
            'Protos/OptSrc.php',
            'Protos/UsrDataOpt.php',
            'PB_Email.php',
            'PB_Item.php',
            'PB_ErrorCode.php',
            'PB_BuyGoods.php',
            'EmailType.php',
        ));

        //实例化对象
        $PBS_UsrDataOprater         =   new PBS_UsrDataOprater();
        $PBS_UsrDataOpraterReturn   =   new PBS_UsrDataOpraterReturn();
        $RPB_PlayerData             =   new RPB_PlayerData();
        $EmailType                  =   new \EmailType();
        $PB_Email                   =   new \PB_Email();
        $OptSrc                     =   new OptSrc();
        $UsrDataOpt                 =   new UsrDataOpt();
        $PB_ErrorCode               =   new \PB_ErrorCode();
        $PB_BuyGoods                =   new \PB_BuyGoods();
        $upgrade =1;
        if($TransdataResult == 0){
            //获取用户信息
            $PBS_UsrDataOprater->setPlayerid($CatUsersOrderInfo['playerid']);
            $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_Player);
            $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
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
            $VipLevel =    $PBS_UsrDataOpraterReturnBase->getVip();
            //vip经验
            $VipExp   =    $PBS_UsrDataOpraterReturnBase->getVipExp();
            //判断是否升级
            $UpVipExp =    $VipExp+ $CatUsersOrderInfo['Price'];
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
        }
        /********************服务器添加*******************/
        $setErr     = $TransdataResult == 0? $PB_ErrorCode::Error_success:$PB_ErrorCode::Error_buy_fail;
        $setGoodsid =  explode('#',$OrderInfo['appuserid']);
        $PBS_UsrDataOprater->reset();
        $PBS_UsrDataOpraterReturn->reset();
        $PBS_UsrDataOprater->setPlayerid($CatUsersOrderInfo['playerid']);
        $PBS_UsrDataOprater->setOpt ($UsrDataOpt::Modify_Player);
        $PB_BuyGoods->setGoodsid($setGoodsid[1]);
        $PB_BuyGoods->setErr($setErr);
        $PBS_UsrDataOprater->setBuyGoodsNotify($PB_BuyGoods);
        if($TransdataResult == 0){
            $RPB_PlayerData->setVipExp($UpVipExp);
            $dataUsersShopLog = array();
            if($upgrade == 2){
                $RPB_PlayerData->setVip($VipInfo['level']);
                $PB_Email->setType($EmailType::EmailType_Sys);
                $PB_Email->setTitle('vip升级通知');
                $PB_Email->setData('恭喜您，你的vip提升到'.$VipInfo['level']);
                $PB_Email->setSender('系统');
            }
            foreach ($GoodsInfo as $k=>$v){
                $num = 0;
                if($v['IsGive'] == 1){
                    $num = $v['GetNum']*$v['Number']+($v['Proportion']*$v['GetNum']*$v['Number'])/100;
                }else{
                    $num = $v['GetNum']*$v['Number'];
                }
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
                        $PBS_ItemOpt   =   new \PB_Item();
                        $PBS_ItemOpt->setNum($num);
                        $PBS_ItemOpt->setId($v['GoodsCode']);
                        $PBS_UsrDataOprater->appendItemOpt($PBS_ItemOpt);
                        break;
                }
                $dataUsersShopLog[$k]['playerid']          =      $CatUsersOrderInfo['playerid'];
                $dataUsersShopLog[$k]['GoodID']            =      $v['GoodsID'];
                $dataUsersShopLog[$k]['Code']              =      $v['GoodsCode'];
                $dataUsersShopLog[$k]['GiveNum']           =      ($v['Proportion']*$v['GetNum']*$v['Number'])/100;
                $dataUsersShopLog[$k]['IsGive']            =      $v['IsGive'];
                $dataUsersShopLog[$k]['Number']            =      $v['Number'];
            }
            $PBS_UsrDataOprater->setPlayerData($RPB_PlayerData);
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

        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = 3006;
            goto failed;
        }
        //添加记录
        if($TransdataResult == 0){
            $model->startTrans();
            $addUsersShopLog = $model
                ->table('jy_users_shop_log')
                ->addAll($dataUsersShopLog);
            //修改订单
            $dataUsersOrderInfo = array(
                'CallbackTime'=>date('Y-m-d H:i:s',time()),
                'PayType'     =>$paytype,
                'Status'      => 2,
            );
            $UpUsersOrderInfo  = $model
                ->table('jy_users_order_info')
                ->where('playerid  = '.$CatUsersOrderInfo['playerid'].' and PlatformOrder = "'.$OrderID.'"')
                ->save($dataUsersOrderInfo);
            if($addUsersShopLog && $UpUsersOrderInfo){
                $model->commit();
                goto  success;
            }else{
                $model->rollback();
                $result = 3000;
                goto  failed;
            }
        }else{
            //修改订单
            $dataUsersOrderInfo = array(
                'CallbackTime'=>date('Y-m-d H:i:s',time()),
                'PayType'     =>$paytype,
                'Status'      => 3,
            );
            $UpUsersOrderInfo  = $model
                ->table('jy_users_order_info')
                ->where('playerid  = '.$CatUsersOrderInfo['playerid'].' and PlatformOrder = "'.$OrderID.'"')
                ->save($dataUsersOrderInfo);
        }
        success:
            echo 'success'."\n";
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
        print_r($dataApiVisitLog);
        $addApiVisitLog = M('jy_api_visit_log')
            ->add($dataApiVisitLog);

            echo 'failed'."\n";
            exit();

    }
}