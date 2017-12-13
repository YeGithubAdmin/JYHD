<?php
/***
 *  苹果支付
 **/
namespace Jy_Thirdpay\Controller;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Model;
use Think\Controller;
class  IosBackController extends Controller {
    public function index(){
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
            3008=>'SDK超时！',
            4001=>'回调数据为空！',
            4002=>'订单不存在！',
            4003=>'门票不存在！',
            4004=>'用户ID不存在！',
            5001=>'订单不存在',
            5002=>'支付信息不存在！',
            5003=>'商品部存在！',
            5004=>'vip配置不存在！',
            7001=>'价格不匹配！',
            7002=>'验签失败！',
            7003=>'该订单已支付过，请勿重复支付',
        );
        $model = new Model();
        $ObjFun      =  new \Common\Lib\func();
        $result      =  2001;
        $DataInfo = file_get_contents('php://input');
        if(empty($DataInfo)){
            $result = 4001;
            goto failed;
        }
        $DataInfo = json_decode($DataInfo,true);
        $receipt     =   $DataInfo['strReceipt'];
        $Order       =   $DataInfo['Order'];
       // $isSandbox   =   $DataInfo['isSandbox'];
        $playerid    =   $DataInfo['playerid'];
        if(!$playerid){
            $result = 4004;
            goto  failed;
        }
        if(!$Order){
            $result = 4003;
            goto  failed;
        }
        $CatOrderField = array(
            'VipLevel',
            'VipExp',
            'playerid',
            'appuserid',
            'Status',
            'Price',
            'Form',
        );
        //查询订单信息
        $CatOrderInfo = $model
            ->table('jy_users_order_info')
            ->where(' playerid =  '.$playerid.'  and PlatformOrder = "'.$Order.'"')
            ->field($CatOrderField)
            ->find();
        if(empty($CatOrderInfo)){
            $result = 5001;
            goto failed;
        }
        $appuserid      =   $CatOrderInfo['appuserid'];
        $appuserid      =   explode('#',$appuserid);
        //商品ID
        $GoosID         =   $appuserid[1];
        //查询物品
        $Status = $CatOrderInfo['Status'];
        $money  = $CatOrderInfo['Price'];
        if($Status == 2){
            $result = 7003;
            goto success;
        }
        if(C('ACCESS_lOGS')){
            $dir = C('YQ_ROOT').'Log/pay/'.date('Y').'/'.date('m').'/'.date('d').'/';
            $ObjFun->record_log($dir,'access_'.date('Ymd').'.log',json_encode($DataInfo));
        }
        //如果是沙盒模式，请求苹果测试服务器,反之，请求苹果正式的服务器  1 沙盒 2 -正式
        if(!$receipt){
            $result = 4003;
            goto  failed;
        }
        $postData = json_encode(
            array('receipt-data' => $receipt)
        );
        $response = $this->Curl(2,$postData);

        if($response == -2){
            $result = 7004;
            goto  failed;
        }
        $IsTest = 2;
        $data = json_decode($response,true);

        if(C('ACCESS_lOGS')){
            $dir = C('YQ_ROOT').'Log/test/'.date('Y').'/'.date('m').'/'.date('d').'/';
            $ObjFun->record_log($dir,'access_'.date('Ymd').'.log',$response.'|'.json_encode($DataInfo));
        }
        if($data['status'] !=0){
            $IsTest = 1;
            $response = $this->Curl(1,$postData);
            if(C('ACCESS_lOGS')){
                $dir = C('YQ_ROOT').'Log/test/'.date('Y').'/'.date('m').'/'.date('d').'/';
                $ObjFun->record_log($dir,'access_test'.date('Ymd').'.log',$response.'|'.json_encode($DataInfo));
            }
            $data = json_decode($response,true);
            if($data['status']  || $data['status'] !=0){
                $result = 7002;
                goto failed;
            }
        }



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
            ->where('playerid = '.$playerid.' and  PlatformOrder = "'.$Order.'"')
            ->field($GoodsInfoField)
            ->select();
        if(empty($GoodsInfo)){
            $result = 5003;
            goto OrderSave;
        }
        //添加物品
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
        $PB_HallNotify          =   new \PB_HallNotify();
        $PB_PlayerVip           =   new \PB_PlayerVip();

        $UsrDataOprater->setPlayerid($playerid);
        $UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $BuyGoods->setErr($ErrorCode::Error_success);
        $BuyGoods->setGoodsid($GoosID);
        if($IsTest == 2){
            $PlayerData->setRmb($CatOrderInfo['Price']);
        }
        //判断是否升级
        $VipLevel =    $CatOrderInfo['VipLevel'];
        $VipExp   =    $CatOrderInfo['VipExp'];
        $UpVipExp =    $VipExp+ $CatOrderInfo['Price'];
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
                ->where('playerid = '.$playerid.'  and  DateTime  >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  
                         and   DateTime <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")')
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
        if($CatOrderInfo['Form'] == 2){
            $dataLogUsersShop['Number'] = 1;
            $dataLogUsersShop['Type']   = $GoodsInfo[0]['Type'];
            $dataLogUsersShop['Code']   = $GoodsInfo[0]['GoodsCode'];
            $UsrDataOprater->setReason($OptReason::buy_yueka_ok);
            $McOvertime = strtotime(date('Y-m-d',time()))+30*24*60*60;
            $PlayerData->setMcOvertime($McOvertime);
            $PlayerData->setIsMc(true);
        }
        //添加物品
        $IsGold = 1; //是否添加过金币 1-否 2是 注释：商城
        if($CatOrderInfo['Form'] == 3 || $CatOrderInfo['Form'] == 1){
            if($CatOrderInfo['Form'] == 1){
                $UsrDataOprater->setReason($OptReason::first_pay);
            }
            if($CatOrderInfo['Form'] == 3){
                $UsrDataOprater->setReason($OptReason::mall_reward_sdk);
            }
            foreach ($GoodsInfo as $k=>$v){
                if($CatOrderInfo['Form'] == 3){
                    $num = $v['GetNum']*$v['Number']+($v['GetNum']*$v['Proportion'])*$v['Number']/100;
                }else{
                    $num =  $v['GetNum']*$v['Number'];
                }
                if($v['IsGive'] == 1){
                    $dataLogUsersShop['Number'] = $v['GetNum'];
                    $dataLogUsersShop['Type']   = $v['Type'];
                    $dataLogUsersShop['Code']   = $v['GoodsCode'];
                }
                switch ($v['Type']){
                    //金币
                    case  1:
                        $PlayerData->setGold($num);
                        if($CatOrderInfo['Form'] == 3){
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
        if($CatOrderInfo['Form'] == 1){
            $PB_ResourceChange->setReason($OptReason::first_pay);
        }elseif ($CatOrderInfo['Form'] == 2){
            $PlayerData->setDiamond(100);
            $Item = new \PB_Item();
            $Item->setId(9);
            $Item->setNum(100);
            $PB_ResourceChange->appendItems($Item);
            $PB_ResourceChange->setReason($OptReason::buy_yueka_ok);
        }elseif ($CatOrderInfo['Form'] == 3){
            $PB_ResourceChange->setReason($OptReason::mall_reward_sdk);
        }
        $PB_ResourceChange->setPlayerid($playerid);
        $PB_HallNotify->setResChanged($PB_ResourceChange);
        $PB_HallNotify->setBuyNotify($BuyGoods);
        $UsrDataOprater->setNotify($PB_HallNotify);
        $UsrDataOprater->setPlayerData($PlayerData);
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
        $model->startTrans();
        $MoreThan = $playerid%10;
        //添加购物记录
        $dataLogUsersShop['playerid'] = $playerid;
        $dataLogUsersShop['GoodsID'] = $GoosID;
        $dataLogUsersShop['Price'] = $CatOrderInfo['Price'];
        $dataLogUsersShop['Form'] = $CatOrderInfo['Form'];



        $addLogUsersShop  = M('log_users_shop_'.$MoreThan)->add($dataLogUsersShop);
        //修改订单
        $dataUsersOrderInfo['CallbackTime']  = date('Y-m-d H:i:s',time());
        $dataUsersOrderInfo['PayType']       = 0;
        $dataUsersOrderInfo['IsTest'] = $IsTest;
        $dataUsersOrderInfo['MessAge']       = '状态码：'.$result.'说明：'.$msgArr[$result].';';
        $dataUsersOrderInfo['Status']        = 2;
        $UpUsersOrderInfo = $model
            ->table('jy_users_order_info')
            ->where('playerid  = '.$playerid.'  and  PlatformOrder = "'.$Order.'"')
            ->save($dataUsersOrderInfo);
        if($addLogUsersShop  && $UpUsersOrderInfo){
            $model->commit();
            goto  success;
        }else{
            $result = 3000;
            $model->rollback();
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
        OrderSave:
        $dataUsersOrderInfo = array();   //订单数据
        $dataUsersOrderInfo['CallbackTime']  = date('Y-m-d H:i:s',time());
        $dataUsersOrderInfo['PayType']       = 0;
        $dataUsersOrderInfo['MessAge']       = '状态码：'.$result.'说明：'.$msgArr[$result].';';
        $dataUsersOrderInfo['Status']        = 4;
        $UpUsersOrderInfo = $model
            ->table('jy_users_order_info')
            ->where('playerid  = '.$playerid.'  and    PlatformOrder = "'.$Order.'"')
            ->save($dataUsersOrderInfo);
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
            'Url'=>'/Jy_Thirdpay/IosBack/index',
            'Msg'=>$msgArr[$result],
            'Code'=>$result,
            'TimeOut'=>'',
            'AccessIP'=>$_SERVER['REMOTE_ADDR'],
        );
        $addApiVisitLog = M('jy_api_visit_log')
            ->add($dataApiVisitLog);
        $response = array(
            'result' => $result,
            'msg' => $msgArr[$result],
            'data' => array(),
        );
        echo json_encode($response);
        exit();
    }

    public function Curl($url,$postData,$timeOut =60){
        $buy = 'https://buy.itunes.apple.com/verifyReceipt';
        $sandbox = 'https://sandbox.itunes.apple.com/verifyReceipt';
        $url = $url == 1? $sandbox:$buy;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_TIMEOUT,$timeOut);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);  //这两行一定要加，不加会报SSL 错误
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($ch);
        $errno    = curl_errno($ch);
        if($errno){
            return -2;
        }
        curl_close($ch);
        return $response;
    }
}