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
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
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
        $msgArr[5002] = "物品不存在！";
        $msgArr[5003] = "支付信息不存在！";
        $msgArr[5004] = "支付类型暂时未接通！";
        $msgArr[7002] = "首冲只允许购买一次，请勿重复购买！";
        $msgArr[7003] = "月卡还有效，请等月卡过期在购买！";
        $result = 2001;
        $info   =  array();
        $time = time();
        $model = new Model();
        $playerid       =  $DataInfo['playerid'];
        $Type           =  $DataInfo['Type'];                  // 3-商城  1-首充  2-月卡
        $GoodsID        =  $DataInfo['GoodsID'];               //商品ID
        $channelid      =  $this->channelid;                   //渠道ID
        $PlatformType   =  $DataInfo['PlatformType'];          //支付平台  1 支付宝 2-微信 3-爱贝
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }

        if(empty($Type)){
            $result = 4007;
            goto response;
        }

        if(empty($GoodsID)){
            $result = 4008;
            goto response;
        }
        if(empty($PlatformType)){
            $result = 4009;
            goto response;
        }

        //首充
        if($Type == 2){
            $UsersPackageShopLog = $model->table('jy_users_package_shop_log')
                                  ->where('playerid = '.$playerid.' and Type = 1')
                                  ->find();
            if(!empty($UsersPackageShopLog)){
                $result = 7002;
                goto response;
            }
        }
        //月卡
        if($Type == 3){
            $UsersPackageShopLog = $model->table('jy_users_package_shop_log')
                ->where('playerid = '.$playerid.' and Type = 1')
                ->field('UNIX_TIMESTAMP(DateTime) as DateTime')
                ->order('Id desc')
                ->find();
            $DateTime = $UsersPackageShopLog['DateTime']+24*60*60*30;
            if(!empty($UsersPackageShopLog)){
                if($time < $DateTime){
                    $result = 7003;
                    goto response;
                }
            }
        }

        //查询物品信息
        $catGoodsAllFile = array(
            'Id',
            'Type',
            'GiveInfo',
            'Name',
            'GetNum',
            'Proportion',
            'CurrencyNum',
            'Code',
        );
        $catGoodsAll = $model->table('jy_goods_all')
                       ->where('Id =  '.$GoodsID.' and  IsDel = 1')
                       ->field($catGoodsAllFile)
                       ->find();
        if(empty($catGoodsAll)){
            $result = 5002;
            goto  response;
        }
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
                     'Proportion',
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
        //查询支付信息
        $CatThirdpayField = array(
            'c.Id',
            'c.PassAgeWay',
            'c.CardNotifyurl',
            'c.TheFirstNotifyurl',
            'c.MallShopNotifyurl',
            'c.public',
            'c.private',
            'c.account',
            'c.appid',
        );
        $CatThirdpay = $model->table('jy_channel_thirdpay as a')
            ->join('jy_thirdpay as c on a.PayID = c.Id  and c.Type = '.$Type)
            ->where('a.adminUserID = '.$channelid)
            ->field($CatThirdpayField)
            ->find();
        if(empty($CatThirdpay)){
            //查询本公司
            $CatThirdpay = $model->table('jy_channel_info as a')
                ->join('jy_channel_thirdpay as b on a.adminUserID = b.adminUserID')
                ->join('jy_thirdpay as c on b.PayID = c.Id and c.Type = '.$Type)
                ->where('a.platform = '.$Platform.' and a.isown = 2')
                ->field($CatThirdpayField)
                ->find();
            if(empty($CatThirdpay)){
                $result = 5003;
                goto response;
            }
        }
        //是否首次购买
        $catUsersShopLog = $model
                            ->table('jy_users_shop_log')
                            ->where('playerid = '.$playerid.'  and  GoodID = '.$catGoodsAll['Id'].' and  IsGive = 1')
                            ->field('Id')->find();
        $Proportion = 0;
        if(empty($catUsersShopLog)){
            $Proportion = $catGoodsAll['Proportion'];
        }
        //订单号
        $PlatformOrder = 'JYHD'.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
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
        $RegisterChannel = "";
        $UserName        = "";
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
            'RegisterChannel'=>$RegisterChannel,
            'PayChannel'=>$DataInfo['channel'],
            'Platform'=>$Platform,
            'PayPlatform'=>$Type,
            'PayPassAgeWay'=>$CatThirdpay['PassAgeWay'],
            'PayID'=>$CatThirdpay['Id'],
        );
        // 3-商城  1-首充  2-月卡
        $appid = $CatThirdpay['appid'];
        $notifyurl = '';
        if($Type == 1){
            $notifyurl = $CatThirdpay['CardNotifyurl'];
        }elseif ($Type == 2){
            $notifyurl = $CatThirdpay['TheFirstNotifyurl'];
        }elseif ($Type == 3){
            $notifyurl = $CatThirdpay['MallShopNotifyurl'];
        }
        //支付平台  1 支付宝 2-微信 3-爱贝
        $Payment = false;
        switch ($PlatformType){
            case  1:
                $Payment = true;
                break;
            case  2:
                $Payment = true;
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
                    goto  response;
                }
                break;
            default:
                break;
        }
        if($Payment == false){
            $result = 5004;
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
        }else{
            $model->rollback();
            $result = 3004;
            goto response;
        }

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