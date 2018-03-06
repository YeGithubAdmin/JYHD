<?php
/***
 * 用户地址信息
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
class UsersAddressController extends ComController {
    public function add(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $msgArr[3001] = "网络错误请！";
        $msgArr[4006] = "参数缺失！";
        $msgArr[4007] = "参数缺失！";
        $msgArr[5002] = "系统错误，请稍后再试！";
        $msgArr[7001] = "手机号码格式错误！";
        $result = 2001;
        $info     =  array();
        $ComFun   =  D('ComFun');
        $LogLevel = 'INFO';
        $playerid =  $DataInfo['playerid'];
        $Phone    =  $DataInfo['Phone']?$DataInfo['Phone']:'';
        $Address  =  $DataInfo['Address']?$DataInfo['Address']:'';
        $UserName  =  $DataInfo['UserName']?$DataInfo['UserName']:'';
        $Txqq     =  $DataInfo['Txqq']?$DataInfo['Txqq']:'';
        if(empty($playerid)){
             $result   =  4006;
             $LogLevel = 'NOTICE';
             goto response;
        }

        if(empty($Phone)){
            $result   =  4007;
            $LogLevel = 'NOTICE';
            goto response;
        }

        //验证手机号码格式
        $CheckPhone = $ComFun->checkPhone($Phone);
        if(!$CheckPhone){
            $result   =  7001;
            $LogLevel = 'NOTICE';
            goto response;
        }

        //查询是否存在
        $CatUsersAddress = M('log_users_addr')
                            ->where('playerid = '.$playerid)
                            ->field('playerid')
                            ->find();
        $DataUsersAddress = array(
            'playerid'=>$playerid,
            'Phone'=>$Phone,
            'UserName'=>$UserName,
            'Address'=>$Address,
            'Txqq'=>$Txqq,

        );
        $UpData = true;
        if(empty($CatUsersAddress)){
            $DataUsersAddress['playerid'] = $playerid;
             $UpData = M('log_users_addr')->add($DataUsersAddress);
        }

        if($UpData === false){
            $result   =  3001;
            $LogLevel = 'CRITICAL';
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

    public function cat(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $msgArr[4006] = "参数缺失！";
        $result = 2001;
        $info     =  array();
        $ComFun   =  D('ComFun');
        $LogLevel = 'INFO';
        $playerid =  $DataInfo['playerid'];
        if(empty($playerid)){
            $result   =  4006;
            $LogLevel = 'NOTICE';
            goto response;
        }
        //查询是否存在
        $CatUsersAddress = M('log_users_addr')
            ->where('playerid = '.$playerid)
            ->field(array(
                'Phone',
                'UserName',
                'Address',
                'Txqq',
            ))
            ->find();
        $info = $CatUsersAddress;
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