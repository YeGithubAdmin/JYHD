<?php
/***
*  爱贝支付回调
**/
namespace Jy_ThirdpayIapppay\Controller;
use Protos\OptReason;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class NotifyurlController extends Controller {
    public function index(){
        include IAPPPAY.'base.php';
        $ObjFun   = new \Common\Lib\func();
        $dataThirdpay = file_get_contents('php://input');
        if(C('ACCESS_lOGS')){
            $dir = C('YQ_ROOT').'Log/api/'.date('Y').'/'.date('m').'/'.date('d').'/';
            $ObjFun->record_log($dir,'access_'.date('Ymd').'.log',$dataThirdpay);
        }
        $dataThirdpay = json_decode($dataThirdpay,true);
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
        $dataThirdpay = json_decode($dataThirdpay['test'],true);
        $transdata=  $dataThirdpay['transdata'];
        if(stripos("%22",$transdata)){ //判断接收到的数据是否做过 Urldecode处理，如果没有处理则对数据进行Urldecode处理
            $dataThirdpay= array_map ('urldecode',$dataThirdpay);
        }
        $respData    = 'transdata='.$dataThirdpay['transdata'].'&sign='.$dataThirdpay['sign'].'&signtype='.$dataThirdpay['signtype'];//把数据组装成验签函数要求的参数格式
        $OrderInfo      = $dataThirdpay['transdata'];
        if(empty($OrderInfo)){
            $result = 4002;
            goto failed;
        }
        //订单号
        $OrderID        = $OrderInfo['cporderid'];
        //支付类型
        $paytype        = $OrderInfo['paytype'];
        //金额
        $money          =   $OrderInfo['money'];
        //用户ID商品ID
        $appuserid      =  $OrderInfo['appuserid'];
        $appuserid      =  explode('#',$appuserid);
        //商品ID
        $GoosID         =  $appuserid[1];
        //用户ID
        $playerid       =  $appuserid[0];

        //实例化数据
        $model = new Model();
        //查询订单信息
        $CatUsersOrderInfoField = array(
            'VipLevel',
            'VipExp',
            'playerid',
            'Price',
            'PayID',
            'Form',
        );
        $CatUsersOrderInfo = $model
                     ->table('jy_users_order_info')
                     ->where('playerid  = '.$playerid.'  and  PlatformOrder = "'.$OrderID.'"')
                     ->field($CatUsersOrderInfoField)
                     ->find();
        if(empty($CatUsersOrderInfo)){
            $result = 5001;
            goto failed;
        }

        //金额是否先匹配
        if($CatUsersOrderInfo['Price']  !=  $money){
            $result = 7001;
            goto OrderSave;
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
            goto OrderSave;
        }
        //验签
        $parseResp = parseResp($respData, $Thirdpay['public'], $respJson);
        if($parseResp){
            $result = 7002;
            goto OrderSave;
        }
        //支付状态  0 成功  1  失败
        $TransdataResult = $OrderInfo['result'];
        //查询商品
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
            goto OrderSave;
        }
        //金币 砖石
        $dataUsersCurrencyStream = array();
        foreach ($GoodsInfo as $k=>$v){
            if($v['Type'] == 1 || $v['Type'] == 2){
                $dataUsersCurrencyStream[$k]['playerid']      =   $playerid;
                $dataUsersCurrencyStream[$k]['Type']          =   2;
                $dataUsersCurrencyStream[$k]['CurrencyType']  =   $v['Type'];
                $dataUsersCurrencyStream[$k]['Income']        =   1;
                $dataUsersCurrencyStream[$k]['Number']        =   $v['Number']*$v['GetNum'];

            }
        }
        $dataUsersCurrencyStream = array_values($dataUsersCurrencyStream);
        $DatausersGoodsStream = array();
        //道具
        foreach ($GoodsInfo as $k=>$v){
            if($v['Type'] == 3){
                $DatausersGoodsStream[$k]['playerid'] =      $playerid;
                $DatausersGoodsStream[$k]['Code']     =      $v['GoodsCode'];
                $DatausersGoodsStream[$k]['Type']     =      2;
                $DatausersGoodsStream[$k]['Income']   =      1;
                $DatausersGoodsStream[$k]['Number']   =      $v['Number']*$v['GetNum'];
            }
        }
        $DatausersGoodsStream = array_values($DatausersGoodsStream);
        /**
         * 服务器查询
         * statr
         */
        $ObjFun->ProtobufObj(array(
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
        ));
        //实例化对象
        $UsrDataOprater         =   new PBS_UsrDataOprater();
        $UsrDataOpraterReturn   =   new PBS_UsrDataOpraterReturn();
        $PlayerData             =   new RPB_PlayerData();
        $EmailType              =   new \EmailType();
        $Email                  =   new \PB_Email();
        $OptSrc                 =   new OptSrc();
        $UsrDataOpt             =   new UsrDataOpt();
        $ErrorCode              =   new \PB_ErrorCode();
        $BuyGoods               =   new \PB_BuyGoods();
        $PB_ResourceChange      =   new \PB_ResourceChange();
        $OptReason              =   new \OptReason();
        $PB_HallNotify  = new \PB_HallNotify();
        $PB_PlayerVip   = new \PB_PlayerVip();
        //设置protocbuf
        $UsrDataOprater->setPlayerid($playerid);
        $UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        if($TransdataResult == 0){
            //支付成功
            $BuyGoods->setErr($ErrorCode::Error_success);
            $BuyGoods->setGoodsid($GoosID);
            //判断是否升级
            $VipLevel =    $CatUsersOrderInfo['VipLevel'];
            $VipExp   =    $CatUsersOrderInfo['VipExp'];
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
                goto OrderSave;
            }
            $PlayerData->setVipExp($UpVipExp);
            $Statuslevel = 0;
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
            //是否月卡
            if($CatUsersOrderInfo['Form'] == 2){
                $UsrDataOprater->setReason($OptReason::buy_yueka_ok);
                $PlayerData->setMcOvertime(time());
                $PlayerData->setIsMc(true);
            }
            //添加物品
            $IsGold = 1; //是否添加过金币 1-否 2是 注释：商城
            if($CatUsersOrderInfo['Form'] == 3 || $CatUsersOrderInfo['Form'] == 1){
                if($CatUsersOrderInfo['Form'] == 1){
                    $UsrDataOprater->setReason($OptReason::first_pay);
                }
                if($CatUsersOrderInfo['Form'] == 3){
                    $UsrDataOprater->setReason($OptReason::mall_reward_sdk);
                }
                foreach ($GoodsInfo as $k=>$v){
                    if($CatUsersOrderInfo['Form'] == 3){
                        $num = $v['GetNum']*$v['Number']+($v['GetNum']*$v['Proportion'])*$v['Number']/100;
                    }else{
                        $num =  $v['GetNum']*$v['Number'];
                    }
                    switch ($v['Type']){
                        //金币
                        case  1:
                            $PlayerData->setGold($num);
                            if($CatUsersOrderInfo['Form'] == 3){
                                $IsGold = 2;
                            }
                            $PB_Item = new \PB_Item();
                            $PB_Item->setNum($num);
                            $PB_Item->setId(8);
                            $PB_ResourceChange->appendItems($PB_Item);
                            break;
                        //砖石
                        case  2:
                            $PlayerData->setDiamond($num);
                            $PB_Item = new \PB_Item();
                            $PB_Item->setNum($num);
                            $PB_Item->setId(9);
                            $PB_ResourceChange->appendItems($PB_Item);

                            break;
                        //道具
                        case  3:
                            $Item = new \PB_Item();
                            $Item->setId($v['GoodsCode']);
                            $Item->setNum($num);
                            $UsrDataOprater->appendItemOpt($Item);
                            $PB_Item = new \PB_Item();
                            $PB_Item->setNum($num);
                            $PB_Item->setId($v['GoodsCode']);
                            $PB_ResourceChange->appendItems($PB_Item);

                            break;
                    }
                }
            }

            if($IsGold == 2){
                $OptReason  =  new \OptReason();
                $UsrDataOprater->setReason($OptReason::pay_gold);
            }
            if($CatUsersOrderInfo['Form'] == 1){
                $PB_ResourceChange->setReason($OptReason::first_pay);
            }elseif ($CatUsersOrderInfo['Form'] == 2){
                $PlayerData->setDiamond(100);
                $Item = new \PB_Item();
                $Item->setId(9);
                $Item->setNum(100);
                $PB_ResourceChange->appendItems($Item);
                $PB_ResourceChange->setReason($OptReason::buy_yueka_ok);
            }elseif ($CatUsersOrderInfo['Form'] == 3){
                $PB_ResourceChange->setReason($OptReason::mall_reward_sdk);
            }

            $PB_ResourceChange->setPlayerid($playerid);
            $PB_HallNotify->setResChange($PB_ResourceChange);
            $PB_HallNotify->setBuyNotify($BuyGoods);
            $UsrDataOprater->setNotify($PB_HallNotify);
            $UsrDataOprater->setPlayerData($PlayerData);

        }else{
            //支付失败
            $BuyGoods->setErr($ErrorCode::Error_buy_fail);
            $BuyGoods->setGoodsid($GoosID);
            $UsrDataOprater->setBuyGoodsNotify($BuyGoods);
            $result = 7003;
            goto OrderSave;
        }
        //反序列化

        $serialize = $UsrDataOprater->serializeToString();
        //发送请求
        $Respond =  $ObjFun->ProtobufSend('protos.PBS_UsrDataOprater',$serialize,$playerid);
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
        if($result == 2001 || $result == 1){
            //开启事物
            $model->startTrans();
            //月卡 首冲
            $addUsersPackageShopLog = 1;
            $addUsersGoodsStream    = 1;
            $addUsersCurrencyStream = 1;
            $addUsersCardReceiveLog  = 1;
            if($CatUsersOrderInfo['Form'] == 1 || $CatUsersOrderInfo['Form'] == 2){
                $dataUsersPackageShopLog = array(
                    'playerid'=>$CatUsersOrderInfo['playerid'],
                    'Type'=>$CatUsersOrderInfo['Form'],
                );
                $addUsersPackageShopLog = $model
                    ->table('jy_users_package_shop_log')
                    ->add($dataUsersPackageShopLog);

            }
            //金币砖石
            if(!empty($dataUsersCurrencyStream)){
                $addUsersCurrencyStream  =   $model->table('jy_users_currency_stream')->addAll($dataUsersCurrencyStream);
            }
            //道具
            if(!empty($DatausersGoodsStream)){
                $addUsersGoodsStream = $model->table('jy_users_goods_stream')->addAll($DatausersGoodsStream);
            }
            //修改订单
            $dataUsersOrderInfo['CallbackTime']  = date('Y-m-d H:i:s',time());
            $dataUsersOrderInfo['PayType']       = $paytype;
            $dataUsersOrderInfo['MessAge']       = '状态码：'.$result.'说明：'.$msgArr[$result].';';
            $dataUsersOrderInfo['Status']        = 2;
            $UpUsersOrderInfo = $model
                ->table('jy_users_order_info')
                ->where('playerid  = '.$playerid.'  and    PlatformOrder = "'.$OrderID.'"')
                ->save($dataUsersOrderInfo);

            if($addUsersPackageShopLog && $addUsersGoodsStream && $addUsersCurrencyStream && $UpUsersOrderInfo){
                $model->commit();
                goto  success;
            }else{
                $result = 3000;
                $model->rollback();
                goto OrderSave;

            }
        }else{
            goto OrderSave;
        }
        success:
        $response = array(
            'result' => $result,
            'msg' => $msgArr[$result],
            'data' => array(),
        );
        echo json_encode($response);
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
            echo 'failed'."\n";
            exit();
        OrderSave:
        $dataUsersOrderInfo = array();   //订单数据
        $dataUsersOrderInfo['CallbackTime']  = date('Y-m-d H:i:s',time());
        $dataUsersOrderInfo['PayType']       = $paytype;
        $dataUsersOrderInfo['MessAge']       = '状态码：'.$result.'说明：'.$msgArr[$result].';';
        $dataUsersOrderInfo['Status']        = 4;

        $UpUsersOrderInfo = $model
                            ->table('jy_users_order_info')
                            ->where('playerid  = '.$playerid.'  and    PlatformOrder = "'.$OrderID.'"')
                            ->save($dataUsersOrderInfo);
        echo 'failed'."\n";
        exit();
    }
}