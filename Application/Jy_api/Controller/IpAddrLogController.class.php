<?php
/***
 * IP记录
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
class IpAddrLogController extends Controller {
    public function index(){
        $DataInfo = file_get_contents('php://input');
        if(!is_array($DataInfo)){
            $DataInfo = json_decode($DataInfo,true);
        }
        $msgArr = array(
            2001=>'请求成功！',
            3001=>'网络错误，请稍后再试！',
            4001=>'渠道缺失！',
            4002=>'类型缺失！',
        );
        $result = 2001;
        $info   = array();
        if(empty($DataInfo['Channel'])){
            $result = 4001;
            goto  response;
        }

        if(empty($DataInfo['Type'])){
            $result = 4002;
            goto  response;
        }

        $Data = array(
            'IpAddr'=>$_SERVER['REMOTE_ADDR'],
            'Type'=>$DataInfo['Type'],
            'mac'=>$DataInfo['mac'],
            'imei'=>$DataInfo['imei'],
            'imsi'=>$DataInfo['imsi'],
            'Channel'=>$DataInfo['Channel'],
        );
        $AddData = M('log_add_ip')
                   ->add($Data);
        if (!$AddData){
            $result = 3001;
            goto  response;
        }
        response:
        $response = array(
            'result' => $result,
            'msg' => $msgArr[$result],
            'sessionid'=>$DataInfo['sessionid'],
            'data' => $info,
        );
        echo json_encode($response);
    }

}