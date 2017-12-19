<?php
/***
 * 月卡
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
class CardInfoController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $MonthCard      =       D('MonthCard');
        $result = 2001;
        $info   =  array();
        $msgArr[3001] = '与游戏服务器断开！';
        $msgArr[4006] = '用户信息缺失！';
        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }
        //查询奖励
        $GoodsInfoFile = array(
            'Id',
            'GiveInfo',
            'CurrencyNum',

        );
        $GoodsAll = M('jy_goods_all')
            ->field($GoodsInfoFile)
            ->where('Code = 7  and IsDel = 1')
            ->find();
        $CardGoodsInfo = $MonthCard->GoodsList($GoodsAll);
        //用信息


        $UserInfo      = $MonthCard->UserInfo($playerid,$DataInfo);
        if(!$UserInfo){
            $result = 3001;
            goto  response;
        }
        $ShopCard = $UserInfo['IsMc']?2:1;  //是否购买过月卡      1 否  2 是
        $IsReceive = $MonthCard->IsReceive($playerid)?2:1;     //今天是否领取过月卡  false 否   true 是
        $Time = strtotime(date('Y-m-d',time()));
        $McOvertime =  strtotime(date('Y-m-d',$UserInfo['McOvertime']));

        if ($McOvertime < $Time){
            $DayNum = 0;
        }else{
            $DayNum = ($McOvertime-$Time)/(24*60*60);

        }
        //信息
        $info['GoodsInfo']   = $CardGoodsInfo;
        $info['CurrencyNum'] = $GoodsAll['CurrencyNum'];
        $info['DayNum']      = $DayNum;
        $info['ShopCard']    = $ShopCard;
        $info['Id']          = $GoodsAll['Id'];
        $info['IsReceive']   = $IsReceive;

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