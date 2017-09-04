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
        $msgArr[5002] = "系统错误，请稍后再试！";
        $msgArr[7002] = "首冲只允许购买一次，请勿重复购买！";
        $msgArr[7003] = "月卡还有效，请等月卡过期在购买！";
        $result = 2001;
        $info   =  array();
        $time = time();
        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }
        $Type = $DataInfo['Type'];      // 3-商城  1-首充  2-月卡
        if(empty($Type)){
            $result = 4007;
            goto response;
        }
        $GoodsID =  $DataInfo['GoodsID'];
        if(empty($GoodsID)){
            $result = 4008;
            goto response;
        }
        //首充
        if($Type == 2){
            $UsersPackageShopLog = M('jy_users_package_shop_log')
                                  ->where('playerid = '.$playerid.' and Type = 1')
                                  ->find();
            if(!empty($UsersPackageShopLog)){
                $result = 7002;
                goto response;
            }
        }
        //月卡
        if($Type == 3){
            $UsersPackageShopLog = M('jy_users_package_shop_log')
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
            'CurrencyNum',
            'Code',
        );
        $catGoodsAll = M('jy_goods_all')
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
                    'CurrencyNum',
                    'Type',
                    'Code',
            );
            if(!empty($GiveGoodsID)){
                $catGoodsAllGive = M('jy_goods_all')
                    ->where('  Id in('.$GiveGoodsID.')  and  IsDel = 1')
                    ->field($catGoodsAllGiveField)
                    ->select();
            }

        }


        $model = new Model();

        $model->startTrans();
        $PlatformOrder = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        //订单物品信息
        $dataUsersOrderGoods = array();
        $dataUsersOrderGoods[0]['playerid']          = $playerid;
        $dataUsersOrderGoods[0]['PlatformOrder']     = $PlatformOrder;
        $dataUsersOrderGoods[0]['GoodsName']         = $catGoodsAll['Name'];
        $dataUsersOrderGoods[0]['GoodsCode']         = $catGoodsAll['Code'];
        $dataUsersOrderGoods[0]['GetNum']            = $catGoodsAll['GetNum'];
        $dataUsersOrderGoods[0]['GoodsId']           = $catGoodsAll['Id'];
        $dataUsersOrderGoods[0]['Price']             = $catGoodsAll['CurrencyNum'];
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
            $dataUsersOrderGoods[$num]['Price']             = 0;
            $dataUsersOrderGoods[$num]['IsGive']            = 2;
            $dataUsersOrderGoods[$num]['Number']            = $NewGiveGoods[$v['Id']]['GetNum'];
            $dataUsersOrderGoods[$num]['Type']                 = $v['Type'];
            $num++;
        }

        $addUsersOrderGoods =   $model
                                ->table('jy_users_order_goods')
                                ->addAll($dataUsersOrderGoods);

        //获取用户信息

        $obj->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'RedisProto/RPB_PlayerData.php',
            'RedisProto/RPB_AccountData.php',

        ));
        $PBS_UsrDataOprater = new PBS_UsrDataOprater();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setOpt(1);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();

        //发送请求
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$playerid);

        if(strlen($PBS_UsrDataOpraterRespond)==0){
            $result = 3003;
            goto response;
        }
        if($PBS_UsrDataOpraterRespond  == 504){
            $result = 3002;
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
        $PBS_UsrDataOpraterReturnAccountData =  $PBS_UsrDataOpraterReturn->getAccountData();
        $PBS_UsrDataOpraterReturnPlayerData  =  $PBS_UsrDataOpraterReturn->getBase();
        //用名
        $UserName = $PBS_UsrDataOpraterReturnPlayerData->getName();
        $RegisterChannel = $PBS_UsrDataOpraterReturnAccountData->getRegChannel();



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
            'PayPassAgeWay'=>'',
        );
        print_r($dataUsersOrderInfo);
        $addUsersOrderInfo = $model
                            ->table('jy_users_order_info')
                            ->add($dataUsersOrderInfo);
        if($addUsersOrderGoods && $addUsersOrderInfo){
            $info['Order'] =  $PlatformOrder;
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