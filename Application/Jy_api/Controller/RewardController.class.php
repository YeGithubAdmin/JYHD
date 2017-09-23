<?php
/***
 * 活动领取奖励
 * @param array   $msgArr  2*  成功  3.* 超时无响应  4.*丢失或参数缺失  5.* 服务器配置问题  6.*来不明  7.* 权限问题 8.* 配置问题
 * @param int     $page         页码
 * @param int     $num          页数
 * @param int     $channelid    渠道id
 * @param int     $platform     平台号  1-iso  2-安卓
 * @param unknow  $version      版本号
 ***/
namespace Jy_api\Controller;
use Jy_api\Controller\ComController;
use Protos\OptReason;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
class RewardController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $obj = new  \Common\Lib\func();
        $result = 2001;
        $info   =  array();
        //当前时间
        $time = date('Y-m-d H:i:s',time());
        //状态码
        $msgArr[2001] = "领取成功！";
        $msgArr[3002] = "网络错误，请稍后再试！";
        $msgArr[3003] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3004] = "游戏服务器断开，请稍后再试！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[4007] = "活动不存在，或者过期！";
        $msgArr[5002] = "活动不存在，或者过期！";
        $msgArr[5003] = "系统错误，请稍后再试";
        $msgArr[7002] = "条件未达成，无法领取！";
        $msgArr[7003] = "奖励已经领取过！";

        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result  = 4006;
            goto response;
        }
        $activityID = $DataInfo['activityID'];
        //判断活动是否过期或者不存在
        if(empty($activityID)){
            $result  = 4007;
            goto response;
        }
        //活动信息
        $activityInfoFile = array(
            'b.GoodsID',
            'a.Type',
            'a.AddUpStartTime',
            'a.AddUpEndTime',
            'b.Id',
            'b.Number',
            'b.Schedule',
        );
        $activityInfo = M('jy_activity_father_list as a')
                        ->join('jy_activity_son_list as b on a.Id = b.FatherID')
                        ->field($activityInfoFile)
                        ->where('b.Id = '.$activityID.'  and  a.AddUpStartTime  <= str_to_date("'.$time.'","%Y-%m-%d %H:%i:%s")  and  a.AddUpEndTime >= str_to_date("'.$time.'","%Y-%m-%d %H:%i:%s")')
                        ->find();

        if(empty($activityInfo)){
            $result  = 5002;
            goto response;
        }
        //查询充值记录   PayMax   单笔充值最大数  PapUp 累计充值
        $catUserOrderField = array(
            'sum(Price) as PriceNum',
            'max(Price) as PriceMax',
        );
        $catUserOrder = M('jy_users_order_info')
            ->where('playerid = '.$playerid. ' and CallbackTime  <= str_to_date("'.$activityInfo['AddUpEndTime'].'","%Y-%m-%d %H:%i:%s")  and CallbackTime >= str_to_date("'.$activityInfo['AddUpStartTime'].'","%Y-%m-%d %H:%i:%s")')
            ->field($catUserOrderField)
            ->select();
        $newUserOder  =  array();
        foreach ($catUserOrder as $k=>$v){
            $newUserOder[$v['Type']] = $v;
        }
        //查询领奖记录想
        $TheawardLogFile = array(
            'count(activityID) as num'
        );
        $TheawardLog = M('jy_users_activity_theaward_log')
                       ->where(' Id = '.$activityID.' and playerid  =  '.$playerid.' and  Type = '.$activityInfo['Type'].'  and  AddUpStartTime  <= str_to_date("'.$time.'","%Y-%m-%d %H:%i:%s") and  AddUpEndTime >= str_to_date("'.$time.'","%Y-%m-%d %H:%i:%s")')
                       ->field($TheawardLogFile)
                       ->select();
        $status         = 1;
        $Schedule       = $activityInfo['Schedule'];
        $PriceNum       = !empty($catUserOrder[0]['PriceNum'])? $catUserOrder[0]['PriceNum']:0;
        $PriceMax       = !empty($catUserOrder[0]['PriceMax'])? $catUserOrder[0]['PriceMax']:0;
        $Num            = empty($TheawardLog)? 0: $TheawardLog[0]['num'];

        switch ($activityInfo['Type']){
            //累计
            case 1:
                if($Schedule>$PriceNum) {
                    $status = 1;
                }
                if($Num != 0){
                    $status = 3;
                }
                if($Num == 0 && $Schedule<=$PriceNum){
                    $status = 2;
                }
            break;
            //单笔
            case 2:
                if($Schedule>$PriceMax) {
                    $status = 1;
                }
                if($Num != 0){
                    $status = 3;
                }
                if($Num == 0 || $Schedule<=$PriceMax){
                    $status = 2;
                }
            break;
            //循环
            case 3:
                $ScheduleNum = floor($PriceNum/$Schedule['Schedule']);         //总共可以领取次数
                $SureNum     =  $ScheduleNum-$Num;
                if($SureNum>0){
                    $status = 2;
                }else{
                    $status = 1;
                }
            break;
        }
        //判断状态
        if($status == 1){
            $result  = 7002;
            goto response;
        }elseif ($status == 3){
            $result  = 7003;
            goto response;
        }
        //查询奖励
        $GoodsInfoField = array(
            'GetNum',
            'Type',
            'Name',
            'Code'
        );
        $GoodsInfo  = M('jy_goods_all')
                    ->where('Id = '.$activityInfo['GoodsID'].' and IsDel = 1')
                    ->field($GoodsInfoField)
                    ->find();
        if(empty($GoodsInfo)){
            $result = 5003;
            goto response;
        }

        //发放奖励
        $obj->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'Protos/UsrDataOpt.php',
            'Protos/OptSrc.php',
            'Protos/OptReason.php',
            'RPB_PlayerNumerical.php',
            'RedisProto/RPB_PlayerData.php',
            'PB_Item.php',
        ));
        //实例化对象
        $PBS_UsrDataOprater = new PBS_UsrDataOprater();
        $UsrDataOpt         = new UsrDataOpt();
        $OptSrc             = new OptSrc();
        $OptReason          = new OptReason();
        //填充数据
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBS_UsrDataOprater->setReason($OptReason::promotion_reward);
        $RPB_PlayerData  = new RPB_PlayerData();
        $num = $GoodsInfo['GetNum']*$activityInfo['Number'];
        $dataUsersGoodsStream     = array();      //道具流水
        $dataUsersCurrencyStream  = array();      //金币砖石流水
        switch ($GoodsInfo['Type']){
            //金币
            case 1:
                $RPB_PlayerData->setGold($num);
                $dataUsersCurrencyStream['playerid']       =   $playerid;
                $dataUsersCurrencyStream['Type']           =   7;
                $dataUsersCurrencyStream['CurrencyType']   =   1;
                $dataUsersCurrencyStream['Income']         =   1;
                $dataUsersCurrencyStream['Number']         =  $num;
            break;
            //砖石
            case 2:
                $RPB_PlayerData->setDiamond($num);
                $dataUsersCurrencyStream['playerid']       =   $playerid;
                $dataUsersCurrencyStream['Type']           =   7;
                $dataUsersCurrencyStream['CurrencyType']   =   2;
                $dataUsersCurrencyStream['Income']         =   1;
                $dataUsersCurrencyStream['Number']         =  $num;
            break;
            //道具
            case 3:
                $PB_Item            = new \PB_Item();
                $PB_Item->setId($GoodsInfo['Code']);
                $PB_Item->setNum($num);
                $PBS_UsrDataOprater->appendItemOpt($PB_Item);
                $dataUsersGoodsStream['playerid']      =       $playerid;
                $dataUsersGoodsStream['Code']          =       $GoodsInfo['Code'];
                $dataUsersGoodsStream['Type']          =       7;
                $dataUsersGoodsStream['Income']        =       1;
                $dataUsersGoodsStream['Number']        =       $num;

                break;
        }
        $PBS_UsrDataOprater->setPlayerData($RPB_PlayerData);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        //发送请求
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$playerid);
        if($PBS_UsrDataOpraterRespond  == 504){
            $result = 3003;
            goto response;
        }
        if(strlen($PBS_UsrDataOpraterRespond)==0){
            $result = 3004;
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
        //记录奖励
        $dataUsersActivityTheawardLog = array(
            'playerid'=>$playerid,
            'GoodsID'=>$activityInfo['GoodsID'],
            'GoodsName'=>$GoodsInfo['Name'],
            'GetNum'=>$GoodsInfo['GetNum'],
            'activityID'=>$activityInfo['Id'],
            'Type'=>$activityInfo['Type'],
            'Channel'=>$DataInfo['channel'],
            'Number'=>$activityInfo['Number'],
            'AddUpStartTime'=>$activityInfo['AddUpStartTime'],
            'AddUpEndTime'=>$activityInfo['AddUpEndTime'],
        );

        $addUsersActivityTheawardLog = M('jy_users_activity_theaward_log')->add($dataUsersActivityTheawardLog);
        $addUsersCurrencyStream = 1;   //记录金币砖石流水
        $addUsersGoodsStream    = 1;   //记录道具流水
        if(!empty($dataUsersCurrencyStream)){
            $addUsersCurrencyStream = M('jy_users_currency_stream')
                ->add($dataUsersCurrencyStream);
        }
        if(!empty($dataUsersGoodsStream)){
            $addUsersGoodsStream   = M('jy_users_goods_stream')
                ->add($dataUsersGoodsStream);
        }
        if(!$addUsersActivityTheawardLog || !$addUsersGoodsStream || !$addUsersCurrencyStream){
           $result = 3002;
           goto  response;
        }

        $info = array(
            'Number'=>$num,
            'Type'=>$GoodsInfo['Type'],
            'Code'=>$GoodsInfo['Code'],
        );
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