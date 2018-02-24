<?php
/***
 * 提交订单
 * @param array   $msgArr  2*  成功  3.* 超时无响应  4.*丢失或参数缺失  5.* 服务器配置问题  6.*来不明  7.* 权限问题 8.* 配置问题
 * @param int     $page         页码
 * @param int     $num          页数
 * @param int     $channelid    渠道id
 * @param int     $platform     平台号  1-iso  2-安卓
 * @param unknow  $version      版本号
 ***/
namespace Jy_api\Controller;
use Jy_api\Controller\ComController;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class PlaceOrderController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $obj   = new \Common\Lib\func();
        $Platform = $this->platform;
        $msgArr[3002] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3003] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3004] = "网络错误，请稍后再试！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[4007] = "类型缺失！";
        $msgArr[4008] = "物品信息缺失！";
        $msgArr[4009] = "支付类型缺失！";
        $msgArr[4010] = "支付信息错误！";
        $msgArr[4011] = "支付异常！";
        $msgArr[4012] = "下单超时！";
        $msgArr[5002] = "物品不存在！";
        $msgArr[5003] = "支付信息不存在！";
        $msgArr[5004] = "支付类型暂时未接通！";
        $msgArr[5005] = "礼包暂时不可以购买！";
        $msgArr[7002] = "超过限购次数！";
        $msgArr[7003] = "月卡还有效，请等月卡过期在购买！";
        $msgArr[7004] = "支付功能，暂时停止！";
        $result = 2001;
        $info   =  array();
        $ComFun = D('ComFun');
        $LogLevel = 'INFO';
        $time = time();
        $model = new Model();
        $playerid       =  $DataInfo['playerid'];
        $Type           =  $DataInfo['Type'];                  // 3-商城  1-首充  2-月卡
        $GoodsID        =  $DataInfo['GoodsID'];               //商品ID
        $channelid      =  $this->channelid;                   //渠道ID
        $PlatformType   =  $DataInfo['PlatformType'];          //支付平台  1 支付宝 2-微信 3-爱贝 4-金立
        if(empty($playerid)){
            $result = 4006;
            $LogLevel = 'NOTICE';
            goto response;
        }
        if(empty($Type)){
            $result = 4007;
            $LogLevel = 'NOTICE';
            goto response;
        }
        if(empty($GoodsID)){
            $result = 4008;
            $LogLevel = 'NOTICE';
            goto response;
        }
        if(empty($PlatformType)){
            $result = 4009;
            $LogLevel = 'NOTICE';
            goto response;
        }
        //支付是否已停止
        $catGameConfig = M('jy_game_config')
                        ->where('Type = 1  and Status = 1 or Channel = "'.$DataInfo['channel'].'"  and Status = 1')
                        ->order('Type asc')
                        ->select();


        foreach ($catGameConfig as $k=>$v){
            if($v['StopPay'] == 2){
                $result = 7004;
                $LogLevel = 'NOTICE';
                goto response;
            }
        }
        $MoreThan = $playerid%10;
        //查询物品信息
        $catGoodsAllFile = array(
            'Id',
            'Type',
            'GiveInfo',
            'Name',
            'GetNum',
            'Proportion',
            'LimitShop',
            'LimitShopNum',
            'CurrencyNum',
            'IosCode',
            'Code',
        );
        $catGoodsAll = $model->table('jy_goods_all')
            ->where('Id =  '.$GoodsID.' and  IsDel = 1')
            ->field($catGoodsAllFile)
            ->find();
        if(empty($catGoodsAll)){
            $result = 5002;
            $LogLevel = 'ERROR';
            goto  response;
        }
        if($catGoodsAll['LimitShop'] > 1 && $Type == 1){
            $where = ' playerid = '.$playerid.' and GoodsID = '.$catGoodsAll['Id'];
            switch ($catGoodsAll['LimitShop']) {
                //日限购
                case 2:
                    $where .= ' and  TO_DAYS(DateTime) = TO_DAYS(NOW())';
                    break;
                //周先限购
                case 3:
                    $where .= ' and  WEEKOFYEAR(DateTime)=WEEKOFYEAR(now())';
                    break;
                //月限购
                case 4:
                    $where .= ' and MONTH(DateTime)=MONTH(NOW()) and year(DateTime)=year(now())';
                    break;
            }
            $logUsersShop = array(
                'count(Id) as num'
            );
            $logUsersShop = M('log_users_shop_'.$MoreThan)
                ->where($where)
                ->field($logUsersShop)
                ->select();

            if($logUsersShop[0]['num'] >= $catGoodsAll['LimitShopNum'] &&  $catGoodsAll['LimitShop'] != 5){
                $result =  7002;
                goto  response;
            }
            if($catGoodsAll['LimitShop'] == 5 && $logUsersShop[0]['num'] >= 1){
                $result =  7002;
                goto  response;
            }

        }

        //查询用户信息
        $obj->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'RedisProto/RPB_PlayerData.php',
            'RedisProto/RPB_AccountData.php',
            'Protos/OptSrc.php',
            'OptReason.php',
            'RPB_PlayerNumerical.php',
            'Protos/UsrDataOpt.php',
        ));
        $UsrDataOprater         =   new  PBS_UsrDataOprater();
        $UsrDataOpraterReturn   =   new  PBS_UsrDataOpraterReturn();
        $OptSrc                 =   new  OptSrc();
        $UsrDataOpt             =   new  UsrDataOpt();
        $UsrDataOprater->setPlayerid($playerid);
        $UsrDataOprater->setOpt($UsrDataOpt::Request_All);
        $UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $String = $UsrDataOprater->serializeToString();
        //发送请求
        $Header = array(
            'PBName:'.'protos.PBS_UsrDataOprater',
            'PBSize:'.strlen($String),
            'UID:'.$playerid,
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$DataInfo['version'],
        );
        $UsrDataOpraterRespond =  $obj->ProtobufSend($Header,$String);
        if(strlen($UsrDataOpraterRespond)==0){
            $LogLevel = 'CRITICAL';
            $result = 3001;
            goto response;
        }
        if($UsrDataOpraterRespond  == 504){
            $LogLevel = 'CRITICAL';
            $result = 3002;
            goto response;
        }
        //接受回应
        $UsrDataOpraterReturn->parseFromString($UsrDataOpraterRespond);
        $ReplyCode = $UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $LogLevel = 'CRITICAL';
            $result = 3003;
            goto response;
        }
        //获得结果
        $ReturnBase         =   $UsrDataOpraterReturn->getBase();
        $AccountData        =   $UsrDataOpraterReturn->getAccountData();
        //vip等级
        $VipLevel           =  $ReturnBase->getVip();
        //vip经验
        $VipExp             =  $ReturnBase->getVipExp();
        //注册渠道号
        $RegisterChannel    =  $AccountData->getRegChannel();
        //用户名称
        $UserName           =  $ReturnBase->getName();
        $catGoodsAllGive = array();
        $GiveGoods =  $catGoodsAll['GiveInfo'];
        $NewGiveGoods = array();
        if(!empty($GiveGoods)){
            $GiveGoods = json_decode($GiveGoods,true);
            $GiveGoodsID = array();
            $NewGiveGoods = array();
            foreach ($GiveGoods as $k=>$v){
                $NewGiveGoods[$v['Id']] = $v;
                $GiveGoodsID[] = $v['Id'];
            }
            $GiveGoodsID = implode(',',$GiveGoodsID);
            $catGoodsAllGiveField = array(
                    'Name',
                    'Id',
                    'GetNum',
                    'CurrencyNum',
                    'Type',
                    'Code',
            );

            if(!empty($GiveGoodsID)){
                $catGoodsAllGive = $model->table('jy_goods_all')
                    ->where('  Id in('.$GiveGoodsID.')  and  IsDel = 1')
                    ->field($catGoodsAllGiveField)
                    ->select();
            }
        }
        //月卡
        if($Type == 2){
            $IsMc = $ReturnBase->getIsMc();
            if($IsMc){
                $result = 7003;
                goto  response;
            }
        }
        $dataType = array(
            5,
            6,
            7,
            8,
            9,
            10,
        );
        if(!in_array($PlatformType,$dataType)){
            //查询支付信息
            $CatThirdpayField = array(
                'c.Id',
                'c.PassAgeWay',
                'c.Notifyurl',
                'c.public',
                'c.private',
                'c.account',
                'c.appid',
            );
            $CatThirdpay = $model->table('jy_channel_thirdpay as a')
                ->join('jy_thirdpay as c on a.PayID = c.Id  and c.Type = '.$PlatformType)
                ->where('a.adminUserID = '.$channelid)
                ->field($CatThirdpayField)
                ->find();
            if(empty($CatThirdpay)){
                //查询本公司
                $CatThirdpay = $model->table('jy_channel_info as a')
                    ->join('jy_channel_thirdpay as b on a.adminUserID = b.adminUserID')
                    ->join('jy_thirdpay as c on b.PayID = c.Id and c.Type = '.$PlatformType)
                    ->where('a.platform = '.$Platform.' and a.isown = 2')
                    ->field($CatThirdpayField)
                    ->find();
                if(empty($CatThirdpay)){
                    $result = 5003;
                    goto response;
                }
            }
        }else{
             $CatThirdpay['PassAgeWay'] = '';
             $CatThirdpay['Id'] = 0;
        }

        $MoreThan = $playerid%10;

        //是否首次充值
        $catUserOrder = M('log_users_shop_'.$MoreThan)
                        ->where('playerid = '.$playerid)
                        ->limit(0,1)
                        ->find();
        $IsFirst = 1;
        if(empty($catUserOrder)){
            $IsFirst = 2;
        }
        //是否首次购买
        $catUsersShopLog = $model
                            ->table('log_users_shop_'.$MoreThan)
                            ->where('playerid = '.$playerid.'  and  GoodsID = '.$catGoodsAll['Id'])
                            ->field('Id')
                            ->find();
        $Proportion = 0;
        if(empty($catUsersShopLog) && $Type == 3){
            $Proportion = $catGoodsAll['Proportion'];
        }
        //订单号
        $getrand = $obj->RandomNumber();
        $PlatformOrder = $getrand.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        //订单物品信息
        $dataUsersOrderGoods = array();
        $dataUsersOrderGoods[0]['playerid']          = $playerid;
        $dataUsersOrderGoods[0]['PlatformOrder']     = $PlatformOrder;
        $dataUsersOrderGoods[0]['GoodsName']         = $catGoodsAll['Name'];
        $dataUsersOrderGoods[0]['GoodsCode']         = $catGoodsAll['Code'];
        $dataUsersOrderGoods[0]['GetNum']            = $catGoodsAll['GetNum'];
        $dataUsersOrderGoods[0]['GoodsId']           = $catGoodsAll['Id'];
        $dataUsersOrderGoods[0]['Price']             = $catGoodsAll['CurrencyNum'];
        $dataUsersOrderGoods[0]['Proportion']        = $Proportion;
        $dataUsersOrderGoods[0]['IsGive']            = 1;
        $dataUsersOrderGoods[0]['Number']            = 1;
        $dataUsersOrderGoods[0]['Type']              = $catGoodsAll['Type'];
        $num = 1;
        foreach ($catGoodsAllGive as $k=>$v){
            $dataUsersOrderGoods[$num]['playerid']          = $playerid;
            $dataUsersOrderGoods[$num]['PlatformOrder']     = $PlatformOrder;
            $dataUsersOrderGoods[$num]['GoodsName']         = $v['Name'];
            $dataUsersOrderGoods[$num]['GoodsCode']         = $v['Code'];
            $dataUsersOrderGoods[$num]['GetNum']            = $v['GetNum'];
            $dataUsersOrderGoods[$num]['GoodsId']           = $v['Id'];
            $dataUsersOrderGoods[$num]['Proportion']        = 0;
            $dataUsersOrderGoods[$num]['Price']             = 0;
            $dataUsersOrderGoods[$num]['IsGive']            = 2;
            $dataUsersOrderGoods[$num]['Number']            = $NewGiveGoods[$v['Id']]['GetNum'];
            $dataUsersOrderGoods[$num]['Type']              = $v['Type'];
            $num++;
        }
        //订单信息
        $dataUsersOrderInfo = array(
            'playerid'=>$playerid,
            'OrderName'=>$catGoodsAll['Name'],
            'UsersName'=>$UserName,
            'PlatformOrder'=>$PlatformOrder,
            'MerchantOrder'=>'',
            'Status'=>1,
            'Price'=>$catGoodsAll['CurrencyNum'],
            'ExpireTime'=>0,
            'appuserid'=>$playerid.'#'.$catGoodsAll['Id'],
            'VipLevel'=>$VipLevel,
            'VipExp'  =>$VipExp,
            'Form'    =>$Type,
            'IsFirst' =>$IsFirst,
            'RegisterChannel'=>$RegisterChannel,
            'PayChannel'=>$DataInfo['channel'],
            'Platform'=>$Platform,
            'PayPlatform'=>$PlatformType,
            'PayPassAgeWay'=>$CatThirdpay['PassAgeWay'],
            'PayID'=>$CatThirdpay['Id'],
            'Version'=>$DataInfo['version'],
        );
        // 3-商城  1-首充  2-月卡
        $appid = $CatThirdpay['appid'];
        $notifyurl = $CatThirdpay['Notifyurl'];
        //支付平台  1 支付宝 2-微信 3-爱贝 4-金立
        $Payment = false;
        $PayInfo = array();
        switch ($PlatformType){
            case  1:

                break;
            case  2:

                break;
            case  3:
                $Payment = true;
                $PayInfo = array(
                    'appid'          =>         "$appid",
                    'waresid'        =>         3,
                    'waresname'      =>         $catGoodsAll['Name'],
                    'cporderid'      =>         "$PlatformOrder",
                    'price'          =>         (float)$catGoodsAll['CurrencyNum'],        //货币
                    'currency'       =>         "RMB",                              //货币类型
                    'appuserid'      =>         $playerid.'#'.$catGoodsAll['Id'],   //用户在商户应用的唯一标识
                    'cpprivateinfo'  =>         "$PlatformOrder",                   //商户私有信息，支付完成后发送支付结果通知时会透传给商户
                    'notifyurl'      =>         $notifyurl,                         //回调地址
                );
                $transid = $obj->IapppayOrder($PayInfo,$CatThirdpay['private'],$CatThirdpay['public']);
                if($transid){
                    $info['transid'] = $transid;
                }else{
                    $result = 40010;
                    $LogLevel = 'ERROR';
                    goto  response;
                }
                $PayInfo['paytype'] = 1;
                $PayInfo['result'] = 0;
                $PayInfo['money'] = (float)$catGoodsAll['CurrencyNum'];
                $a['transdata'] =  $PayInfo;
                $PayInfo =$a;
                break;
            case 4:
                $Payment = true;
                $deal_price = $catGoodsAll['CurrencyNum'];
                $PayInfo = array(
                    'api_key'         =>         $appid,
                    'subject'         =>         $catGoodsAll['Name'],
                    'out_order_no'    =>         "$PlatformOrder",
                    'deliver_type'    =>         "1",
                    'deal_price'      =>         "$deal_price",
                    'total_fee'       =>         "$deal_price",
                    'notify_url'      =>         $notifyurl,
                    'player_id'       =>         $playerid.'#'.$catGoodsAll['Id'],
                );
                 $info['OrderInfo']    =     $PayInfo ;
                break;
                //苹果支付
            case 5:
                $Payment = true;

                if(!$catGoodsAll['IosCode']){
                    $result = 5005;
                    goto response;
                }


                $info['IosCode'] = $catGoodsAll['IosCode'];
                $info['Order']   = $PlatformOrder;
            break;
                //小米支付
            case 6:
                $Payment = true;
                $info['mibi']        =  $catGoodsAll['CurrencyNum'];
                $info['cpOrderId']   =  $PlatformOrder;
                $info['cpUserInfo']  =  $playerid.'#'.$catGoodsAll['Id'];
            break;
                //华为支付
            case 7:
                $Payment = true;
                include     HUAWEISDK.'HuaWeiFun.php';
                $HuaWeiFun  = new \HuaWeiFun();
                $CurrencyNum = sprintf("%01.2f",$catGoodsAll['CurrencyNum']);
                $info['merchantId']        =        "900086000020554310";
                $info['applicationID'] =        "100106371";
                $info['amount']        =       "$CurrencyNum" ;
                $info['productName']   =        $catGoodsAll['Name'];
                $info['requestId']     =        $PlatformOrder;
                $info['productDesc']   =        $catGoodsAll['Name'];
                $info['sdkChannel']    =        1;
                $info['sign']          =        $HuaWeiFun->redSignkey($info);
                $info['merchantName']      =       '深圳市巨翼互动科技有限公司';
                $info['serviceCatalog']   =       "X6";
              break;
              //联想
            case 8:
                $Payment = true;
                $PayInfo = array(
                    'appid'          =>         "3017088500 ",
                    'waresid'        =>         1,
                    'waresname'      =>         $catGoodsAll['Name'],
                    'cporderid'      =>         "$PlatformOrder",
                    'price'          =>         (float)$catGoodsAll['CurrencyNum'],        //货币
                    'currency'       =>         "RMB",                                     //货币类型
                    'appuserid'      =>         $playerid.'#'.$catGoodsAll['Id'],          //用户在商户应用的唯一标识
                    'cpprivateinfo'  =>         "$PlatformOrder",                          //商户私有信息，支付完成后发送支付结果通知时会透传给商户
                    'notifyurl'      =>         $notifyurl,                                //回调地址
                );
                $Private = 'MIICXAIBAAKBgQDKcquZQQB9AhAor2xBmWbmZJ8wnvc8tJe7c/EXbe1B/6pc/9Ch0nd5jS72I/zcuNqozn79ykiCs0rpeqoC3UkUmIzu5DliaQErTukBaDJ+YCDH8CIeN4oVLY7z2gcwrktIKPqZao9CghvUp+wSnCEX75oHuAXSURBMbKz7j4nlxQIDAQABAoGAEHogyUpnFcWTNxx//R7VJy9NXZGyobg5GUKofrWtt89tOECB5InSu4voJJRtQjGxakfUQieymyComjQnnjAQgH1hopu4KCSae+ykGm+bIuTe4scX5wXBiNiCvPnqP44V3EZArNdQv5OHBWJaT+mdITLlN/X7Fu8n2FEou9MB+QECQQD8KD9bMqyvnoD3ArfW6M21F18rVByubtd2pmwLBbzZnd3IwPBu/s886uMXcPCgCzRl8FOZ1rYsBFukW4QXTqflAkEAzYh9XVCgkgAPdfFGOM60mnD/R2lnruYhfelSsiaHfgc+N0ns8VAxBnt7h3kCHsh7xgTyc9nUJFZbR+6NRXaoYQJAMJstg03kXcIHCBZdC686n/LOZJLFKJazL+rqnsFPYv98VgtjDXJOzmZUuhsKNz+RrSjDZL8vxJJee/MsJjYCRQJAWD6j5K67YjQYb0EaL0XAkRa25AhDdfpkotTMpqSYQ+oEMmTREIKnqerWjMHNwT2+trRlDIyX4soZAvdPPGXHwQJBAI6d56qKeUqk8Jc+atITXMLYFlg1bhteVToUB9PDvdiHWOnYC/Don8yVzZUJMaYYMVsOuQMf71VNbkBIg2m7zH4=';
                $Public  =  'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDAuta/pwkiJAumtuVmUIFw4AZqZ3o4EoPwjBH+z1KqM7WHxADIlmCjsZI41GgH3CHLGm7C23y7QsDwZdNFkBfbw9iAHgprBeIZSgtxnH5mrtjqENm70mEPvUPrERJjShAHJAMuQ2XnK1PQ0qfXyldbvm4Ec5VJcXhXB0h6aXibJQIDAQAB';
                $transid = $obj->IapppayOrder($PayInfo,$Private,$Public);

                if($transid){
                    $info['transid'] = $transid;
                }else{
                    $result = 40010;
                    $LogLevel = 'ERROR';
                    goto  response;
                }
                $PayInfo['paytype'] = 1;
                $PayInfo['result'] = 0;
                $PayInfo['money'] = (float)$catGoodsAll['CurrencyNum'];
                break;
                //vivo
            case 9:
                $Payment = true;
                $PayCom = D('PayCom');
                $AppKey = '55a40a6528176fff6c31fc7da3bf73c7';
                $orderTime = date('YmdHms',time());
                $param = array(
                    'version'       => '1.0.0',
                    'signMethod'    => 'MD5',
                    'cpId'          => "20160512185048379012",

                    'appId'         => 'bec5a96a4a01199e21a7173c4837203b',
                    'cpOrderNumber' =>  $PlatformOrder,
                    'notifyUrl'     =>  SERVER_DOMAIN_NAME.'Jy_Thirdpay/VivoBack/index',
                    'orderTime'     =>  "$orderTime",
                    'orderAmount'   =>  $catGoodsAll['CurrencyNum']*100,
                    'orderTitle'    =>  $catGoodsAll['Name'],
                    'orderDesc'     =>  $catGoodsAll['Name'],


                );
                $ResData = $PayCom->VivoPayOrder($param,$AppKey);
                if(!$PayCom){
                    $result = 40012;
                    $LogLevel = 'CRITICAL';
                    goto  response;
                }
                if($ResData['respCode'] != 200){
                    $result = 40011;
                    $LogLevel = 'CRITICAL';
                    goto  response;
                }
                $info = array(
                    'productName'=>$catGoodsAll['Name'],
                    'productDes'=>$catGoodsAll['Name'],
                    'productPrice'=>$catGoodsAll['CurrencyNum']*100,
                    'vivoSignature'=>$ResData['accessKey'],
                    'appId'=>'bec5a96a4a01199e21a7173c4837203b',
                    'transNo'=>$ResData['orderNumber'],
                );
                break;
                //OPPO
            case 10:
                $Payment = true;
                //订单号
                $info['order']          =    $PlatformOrder;
                //消费总金额，单位为分
                $info['amount']         =   $catGoodsAll['CurrencyNum']*100;
                //商品名
                $info['productName']    =    $catGoodsAll['Name'];
                //商品描述
                $info['callbackUrl']    =    SERVER_DOMAIN_NAME.'Jy_Thirdpay/OppoBack/index';
                break;
            default:
                break;
        }
        if($Payment == false){
            $result = 5004;
            $LogLevel = 'NOTICE';
            goto  response;
        }
        $model->startTrans();
        $addUsersOrderInfo = $model
            ->table('jy_users_order_info')
            ->add($dataUsersOrderInfo);
        $addUsersOrderGoods =   $model
            ->table('jy_users_order_goods')
            ->addAll($dataUsersOrderGoods);
        if($addUsersOrderGoods && $addUsersOrderInfo){
            $model->commit();
            $info['test'] = $PayInfo;
        }else{
            $model->rollback();
            $result = 3004;
            $LogLevel = 'ERROR';
            goto response;
        }
        response:
            $response = array(
                'result' => $result,
                'msg' => $msgArr[$result],
                'sessionid'=>$DataInfo['sessionid'],
                'data' => $info,
            );
            $ComFun->SeasLog($response,$LogLevel);
            $this->response($response,'json');
    }
}