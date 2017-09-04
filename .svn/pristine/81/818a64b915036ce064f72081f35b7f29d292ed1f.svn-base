<?php
/***
 * 兑换记录
 * @param array   $msgArr  2*  成功  3.* 超时无响应  4.*丢失或参数缺失  5.* 服务器配置问题  6.*来不明  7.* 权限问题 8.* 配置问题
 * @param int     $page         页码
 * @param int     $num          页数
 * @param int     $channelid    渠道id
 * @param int     $platform     平台号  1-iso  2-安卓
 * @param unknow  $version      版本号
 ***/
namespace Jy_api\Controller;
use Jy_api\Controller\ComController;
use Protos\PBS_ItemOpt;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class ExchangeLogController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $page           =       $this->page;
        $num            =       $this->num;

        $result = 2001;
        $info   =  array();
        $msgArr[4006] = "用户信息，缺失！";
        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }
        $UsersExchangeLogField = array(
            'GoodsName',
            'Order',
            'Status',
            'date_format(DateTime,"%Y.%m.%d") as Time',

        );
        $UsersExchangeLog = M('jy_users_exchange_log')
                            ->where('playerid = '.$playerid)
                            ->field($UsersExchangeLogField)
                            ->limit(($page-1)*$num,$num)
                            ->order('DateTime desc')
                            ->select();
        $info = $UsersExchangeLog;
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