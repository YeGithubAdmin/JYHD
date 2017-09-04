<?php
/***
 * 支付订单
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
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class PayOrderController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $obj   = new \Common\Lib\func();
        $msgArr[3002] = "网络错误，请稍后再试！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[4007] = "支付平台不明确！";
        $msgArr[4008] = "没有该订单号！";
        $msgArr[4009] = "渠道信息丢失！";
        $msgArr[5002] = "系统错误，请稍后再试！";
        $result = 2001;
        $info   =  array();
        //平台
        $Platform       = $this->platform;
        //用户ID
        $playerid       = $DataInfo['playerid'];
        //支付平台  1 支付宝 2-微信 3-爱贝
        $Type           = $DataInfo['Type'];
        //渠道ID
        $channelid      =  $this->channelid;
        //订单号
        $PlatformOrder = $DataInfo['PlatformOrder'];
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }

        if (empty($Type)){
            $result = 4007;
            goto response;
        }

        if (empty($PlatformOrder)){
            $result = 4008;
            goto response;
        }
        if (empty($channelid)){
            $result = 4009;
            goto response;
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
        $CatThirdpay = M('jy_channel_thirdpay as a')
                       ->join('jy_thirdpay as c on a.PayID = c.Id  and c.Type = '.$Type)
                       ->where('a.adminUserID = '.$channelid)
                       ->field($CatThirdpayField)
                       ->find();
        if(empty($CatThirdpay)){
            //查询本公司
            $CatThirdpay = M('jy_channel_info as a')
                ->join('jy_channel_thirdpay as b on a.adminUserID = b.adminUserID')
                ->join('jy_thirdpay as c on b.PayID = c.Id and c.Type = '.$Type)
                ->where('a.platform = '.$Platform.' and a.isown = 2')
                ->field($CatThirdpayField)
                ->find();
            if(empty($CatThirdpay)){
                $result = 5002;
                goto response;
            }
        }

        $ThirdpayInfo = array();
        $ThirdpayInfo['CardNotifyurl']      =   $CatThirdpay['CardNotifyurl'];
        $ThirdpayInfo['TheFirstNotifyurl']  =   $CatThirdpay['TheFirstNotifyurl'];
        $ThirdpayInfo['MallShopNotifyurl']  =   $CatThirdpay['MallShopNotifyurl'];
        if($Type == 1){
           //支付宝

        }elseif ($Type == 2){
           //微信

        }elseif ($Type == 3){
           //爱贝
            $ThirdpayInfo['appid']   = $CatThirdpay['appid'];
            $ThirdpayInfo['private'] = $CatThirdpay['private'];
            $ThirdpayInfo['public']  = $CatThirdpay['public'];
        }

        //更新订单

        $dataUsersOrderInfo = array(
            'PayPlatform'=>$Type,
            'PayPassAgeWay'=>$CatThirdpay['PassAgeWay'],
            'PayID'=>$CatThirdpay['Id'],
        );




        $UpUsersOrderInfo  = M('jy_users_order_info')
                            ->where('playerid = '.$playerid.' and PlatformOrder = "'.$PlatformOrder.'"')
                            ->save($dataUsersOrderInfo);
        if($UpUsersOrderInfo === false){
            $result = 3002;
            goto  response;
        }

        $info =  $ThirdpayInfo;

        response:
            $response = array(
                'result' => $result,
                'msg' => $msgArr[$result],
                'sessionid'=>$DataInfo['sessionid'],
                'data' => $info,
            );
            $dataApiVisitLog = array(
                'Name'=>'支付订单',
                'Url'=>$this->tagKey,
                'Msg'=>$msgArr[$result],
                'Code'=>$result,
                'TimeOut'=>'',
                'AccessIP'=>$_SERVER['REMOTE_ADDR'],
            );
            $addApiVisitLog = M('jy_api_visit_log')
                              ->add($dataApiVisitLog);
            $this->response($response,'json');
    }
}