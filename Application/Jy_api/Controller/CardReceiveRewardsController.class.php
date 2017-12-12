<?php
/***
 * 领取月卡奖励
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
use Think\Model;
class CardReceiveRewardsController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $MonthCard      =       D('MonthCard');
        $result = 2001;
        $info   =  array();
        $msgArr[3003] = "网络错误，请稍后再试！";
        $msgArr[3003] = "与游戏服务器断开，请稍后再试！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[5003] = "系统错误，请稍后再试！";
        $msgArr[5005] = "系统错误，请稍后再试！";
        $msgArr[7002] = "您还未购过买月卡，请先购买月卡！";
        $msgArr[7004] = "当天已经领取过，请明天在来！";
        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }
        $UserInfo = $MonthCard->UserInfo($playerid);
        if(!$UserInfo){
            $result = 7002;
            goto response;
        }
        //判断今天是否已经领取过  false 未领取过  true 领取过
        $IsReceive = $MonthCard->IsReceive($playerid);
        if($IsReceive){
            $result = 7004;
            goto response;
        }
        //判断是否月卡
        if(!$UserInfo['IsMc']){
            $result = 7002;
            goto response;
        }
        //查询奖励
        $GoodsInfoFile = array(
            'GiveInfo',
            'CurrencyNum',

        );
        $GoodsAll = M('jy_goods_all')
                     ->field($GoodsInfoFile)
                     ->where('Code = 7  and IsDel = 1')
                     ->find();
        if(empty($GoodsAll)){
            $result = 5003;
        }
        $CardGoodsInfo = $MonthCard->GoodsList($GoodsAll);
        if(empty($CardGoodsInfo)){
            $result = 5005;
            goto  response;
        }
        $GoodsAdd = $MonthCard->AddGoods($CardGoodsInfo,$playerid);
        if(!$GoodsAdd){
            $result = 3003;
            goto  response;
        }
        //记录
        $dataUsersCardReceiveLog = array();
        foreach ($CardGoodsInfo as $key=>$val){
            if($val['Type'] > 0){
                $dataUsersCardReceiveLog[$key]['playerid']   =    $playerid;
                $dataUsersCardReceiveLog[$key]['GoodsID']    =    $val['Id'];
                $dataUsersCardReceiveLog[$key]['Type']       =    $val['Type'];
                $dataUsersCardReceiveLog[$key]['Code']       =    $val['Code'];
                $dataUsersCardReceiveLog[$key]['GetNum']     =    $val['GetNum'];
                $dataUsersCardReceiveLog[$key]['Number']     =    $val['Number'];
                $dataUsersCardReceiveLog[$key]['Channel']    =    $DataInfo['channel']  ;
            }
            if($val['Type'] == 0){
                unset($CardGoodsInfo[$key]);
            }
            if($val['Type'] >= 1){
                $info[$key]['Number'] =  $val['GetNum']*$val['Number'];
                $info[$key]['Code']   =  $val['Code'];
                $info[$key]['Type']   =  $val['Type'];
            }
        }
        $dataUsersCardReceiveLog = array_values($dataUsersCardReceiveLog);
        $addUsersCardReceiveLog =M('jy_users_card_receive_log')
            ->addAll($dataUsersCardReceiveLog);
        if(!$addUsersCardReceiveLog){
            $result = 3002;
            $info = array();
            goto  response;
        }
        $info = array_values($info);
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