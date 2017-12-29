<?php
/***
 * Cdk兑换
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
use Protos\PBS_ItemOpt;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class CdkExchangeController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $ProtoFun       =       D("ProtoFun");
        $ObjFun         =       $ProtoFun->ObjFun;

        $Model = new Model();
        $result = 2001;
        $info   =  array();
        $msgArr[2001] = '兑换成功，已发放到邮件';
        $msgArr[3002] = "抱歉，礼包兑换失败，请联系客服同学进行核实处理！";
        $msgArr[3003] = "抱歉，礼包兑换失败，请联系客服同学进行核实处理！";
        $msgArr[3004] = "抱歉，礼包兑换失败，请联系客服同学进行核实处理！";
        $msgArr[4006] = "抱歉，礼包兑换失败，请联系客服同学进行核实处理！";
        $msgArr[4007] = "抱歉，礼包兑换失败，CDK为空！";
        $msgArr[5002] = "抱歉，礼包兑换失败，CDKEY不合法！";
        $msgArr[5003] = "抱歉，礼包兑换失败，CDKEY不在活动时间范围！";
        $msgArr[5004] = "抱歉，礼包兑换失败，CDKEY已被使用！";
        $msgArr[5005] = "抱歉，礼包兑换失败，请联系客服同学进行核实处理！";
        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }
        $CDK =  $DataInfo['CDK'];
        if(empty($CDK)){
            $result = 4007;
            goto response;
        }
        //查询CDK
        $CatCdk = $Model
                  ->table('conf_cdk_list')
                  ->where('CDK = "'.$CDK.'"')
                  ->field(array(

                        'Code',
                        'Cid',
                        'Status',
                        'StartTime',
                        'EndTime',
                  ))
                  ->find();
        if(empty($CatCdk)){
            $result =  5002;
            goto response;
        }
        $StartTime = strtotime($CatCdk['StartTime']);
        $EndTime   = strtotime($CatCdk['EndTime']);
        if($EndTime < time() || $StartTime > time()){
            $result =  5003;
            goto  response;
        }
        if($CatCdk['Status'] == 2){
            $result = 5004;
            goto  response;
        }
        //查询物品
        $CatGoods = $Model
                          ->table('conf_ckd_good_continuity')
                          ->where('Code = '.$CatCdk['Code'].' and Status = 2')
                          ->field(array(
                              'GiveInfo',
                          ))
                          ->find();
        if(empty($CatGoods) || empty($CatGoods['GiveInfo'])){
              $result = 5005;
              goto  response;
        }
        $GoodsID  = array();
        $GiveInfo = json_decode($CatGoods['GiveInfo'],true);
        foreach ($GiveInfo as $k=>$v){
            $GoodsID[] = $v['Id'];
        }
        $GoodsID   = implode(',',$GoodsID);
        if(empty($GoodsID)){
            $result = 5006;
            goto  response;
        }
        $GoodsInfo = $Model
                     ->table('jy_goods_all')
                     ->where('Id in ('.$GoodsID.')')
                     ->field(
                         array(
                             'Id',
                             'GetNum',
                             'Code',
                             'Type',
                         )
                     )
                     ->select();

        if(empty($GoodsInfo)){
            $result = 5007;
            goto  response;
        }
        $GoodsInfoSort = array();
        foreach ($GoodsInfo as $k=>$v) $GoodsInfoSort[$v['Id']] =  $v;

        foreach ($GiveInfo as $k=>$v){
              if($GoodsInfoSort[$v['Id']]){
                  $GiveInfo[$k]['Number'] = $v['GetNum']*$GoodsInfoSort[$v['Id']]['GetNum'];
                  $GiveInfo[$k]['Code']   = $GoodsInfoSort[$v['Id']]['Code'];
              }else{
                  unset($GiveInfo[$k]);
              }
        }

        $Param = array(
            'Title'=>'CDK兑换',
            'Sender'=>'系统',
            'Data'=>'',
        );
        $OptSrc    = $ProtoFun->OptSrc;
        $OptReason = $ProtoFun->OptReason;

        $UsrDataOpt = $ProtoFun->UsrDataOpt;
        $ProtoFun->SendMail($Param,1,$GiveInfo);
        $ProtoFun->UsrDataOprater->setPlayerid($playerid);
        $ProtoFun->UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $ProtoFun->UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $ProtoFun->UsrDataOprater->setReason($OptReason::exchange);
        $String = $ProtoFun->UsrDataOprater->serializeToString();

        $Header = array(
            'PBName:'.'protos.PBS_UsrDataOprater',
            'PBSize:'.strlen($String),
            'UID:'.$playerid,
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$DataInfo['version'],
        );



        $Respond        = $ObjFun->ProtobufSend($Header,$String);
        $ProtoFun->UsrDataOpraterReturn->parseFromString($Respond);
        if($Respond  == 504){
            $result = 3002;
            goto response;
        }
        if(strlen($Respond)==0){
            $result = 3003;
            goto response;
        }
        $ReplyCode      = $ProtoFun->UsrDataOpraterReturn->getCode();
        if($ReplyCode != 1){
            $result = $ReplyCode;
            goto response;
        }
        //修改CDK值
        $DataCdk = array(
            'Status'=>2,
            'playerid'=>$playerid,
        );
        $DataCdk = $Model
                   ->table('conf_cdk_list')
                   ->where('CDK = "'.$CDK.'"')
                   ->save($DataCdk);
        if($DataCdk === false){
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