<?php
/***
 * vip 信息
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
class VipInfoController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $obj   = new \Common\Lib\func();
        $msgArr[3002] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3003] = "与游戏服务器断开，请稍后再试！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[5002] = "系统错误，请稍后再试！";
        $result = 2001;
        $info   =  array();
        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }
        //已入protobuf 类
        $obj->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/UsrDataOpt.php',
            'Protos/OptSrc.php',
            'OptReason.php',
            'PB_Item.php',
            'RPB_PlayerNumerical.php',
            'RedisProto/RPB_PlayerData.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
        ));
        $PBS_UsrDataOprater = new PBS_UsrDataOprater();
        $UsrDataOpt         = new UsrDataOpt();
        $OptSrc             = new OptSrc();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_Player);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        //发送请求
        $Header = array(
            'PBName:'.'protos.PBS_UsrDataOprater',
            'PBSize:'.strlen($PBSUsrDataOpraterString),
            'UID:1',
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$DataInfo['version'],
        );
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend($Header,$PBSUsrDataOpraterString);

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
        $Base       =  $PBS_UsrDataOpraterReturn->getBase();
        //vip 等级
        $VipLevel   =  $Base->getVip();
        //vip 经验
        $VipExp     =  $Base->getVipExp();
        //获取vip规则
        $catVipInfoField = array(
            'ImgCode',
            'Describe',
            'level',
            'GiveInfo',
            'Number',
            'Type',
            'experience'
        );
        $catVipInfo = M('jy_vip_info')
                      ->field($catVipInfoField)
                      ->order('level asc')
                      ->select();
        if(empty($catVipInfo)){
            $result = 5002;
            goto response;
        }
        $OrderVipInfo  = array();
        foreach ($catVipInfo as $k=>$v){
            $OrderVipInfo[$v['level']] = $v;
            //status 是否单当前等级   1-否  2-是
            if($v['level'] <= $VipLevel){
                $catVipInfo[$k]['status'] = 2;
            }else{
                $catVipInfo[$k]['status'] = 1;
            }
            if($catVipInfo[$k]['level'] == 0){
                unset($catVipInfo[$k]);
            }
        }
        $MaxLevel  =  $catVipInfo[count($catVipInfo)]['level'];
        //下个等级
        if($MaxLevel == $VipLevel){
            $UpVipLevel = $VipLevel;
        }else{
            $UpVipLevel = $VipLevel+1 ;
        }

        //下个等级升级经验
        $UpVipExp   =  $OrderVipInfo[$UpVipLevel];
        $info['VipInfo']  = array_values($catVipInfo);
        $info['UpVipExp'] = $UpVipExp['experience'];
        $info['UpVipLevel'] = $UpVipExp['level'];
        $info['VipExp']   = $VipExp;

        //判断是否已经领取 1-否  2-是
        $Status = 1;
        $catVipRewardlogField = array(
            'Id',
        );
        $strtotime = strtotime(date('Y-m-d'),time());
        $StartTime = date('Y-m-d H:i:s',$strtotime);
        $EndTime   = date('Y-m-d H:i:s',$strtotime+24*60*60);
        $catVipRewardlog = M('jy_vip_reward_log')
            ->where('playerid = '.$playerid.'  and  
                    DateTime  >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  
                    and   DateTime <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($catVipRewardlogField)
            ->find();
        if(empty($catVipRewardlog) && $VipLevel > 0){
            $Status = 2;
        }
        $info['Status'] = $Status;

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