<?php
/***
 * vip领取奖励
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
class VipRewardController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $obj   = new \Common\Lib\func();
        $msgArr[3002] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3003] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3004] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3005] = "与游戏服务器断开，请稍后再试！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[4007] = "网络错误，请稍后再试！";
        $msgArr[5002] = "系统错误，请稍后再试！";
        $msgArr[7001] = "等级不符合，要求！";
        $msgArr[7002] = "今天奖励已领取，请明天再来！";
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
            'Protos/PBS_UsrDataOpraterReturn.php',
            'Protos/UsrDataOpt.php',
            'Protos/OptSrc.php',
            'PB_Item.php',
            'Redis/RPB_PlayerData.php',
            'OptReason.php',
            'RPB_PlayerNumerical.php',
            'RedisProto/RPB_PlayerData.php'
        ));
        $PBS_UsrDataOprater = new PBS_UsrDataOprater();
        $UsrDataOpt         = new UsrDataOpt();
        $OptSrc             = new OptSrc();
        $RPB_PlayerData     = new RPB_PlayerData();
        $OptReason          = new \OptReason();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_Player);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBS_UsrDataOprater->setReason($OptReason::vip_reward);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        //发送请求

        $Header = array(
            'PBName:'.'protos.PBS_UsrDataOprater',
            'PBSize:'.strlen($PBSUsrDataOpraterString),
            'UID:'.$playerid,
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
        if($VipLevel<=0){
            $result = 7001;
            goto response;
        }
        //是否已经领取过奖励
        $catVipRewardlogField = array(
            'Id',
        );
        $strtotime = strtotime(date('Y-m-d'),time());
        $StartTime = date('Y-m-d H:i:s',$strtotime);
        $EndTime   = date('Y-m-d H:i:s',$strtotime+24*60*60);
        $catVipRewardlog = M('jy_vip_reward_log')
                            ->where('playerid = '.$playerid.'  and  DateTime  >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  and   DateTime <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")')
                            ->field($catVipRewardlogField)
                            ->find();
        if(!empty($catVipRewardlog)){
            $result = 7002;
            goto response;
        }
        //查询奖励
        $catVipReward = array(
            'b.GetNum',
            'b.Code',
            'b.Type',
            'b.Id as GoodsID',
            'a.Number',

        );
        $catVipReward = M('jy_vip_reward as a')
                        ->join('jy_goods_all as b on a.GoodsID = b.Id')
                        ->where('a.Level = '.$VipLevel.' and  b.Isdel = 1')
                        ->field($catVipReward)
                        ->select();
        if(empty($catVipReward)){
            $result = 5002;
            goto response;
        }
        //添加物品
        $PBS_UsrDataOprater->reset();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_Player);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        foreach ($catVipReward as $k=>$v){
            $num = $v['Number']*$v['GetNum'];
            switch ($v['Type']){
                //金币
                case 1:
                    $RPB_PlayerData->setGold($num);
                    break;
                //钻石
                case 2:
                    $RPB_PlayerData->setDiamond($num);
                    break;
                //道具
                case 3:
                    $PB_Item = new \PB_Item();
                    $PB_Item->setNum($num);
                    $PB_Item->setId($v['Code']);
                    break;
            }
        }
        $PBS_UsrDataOprater->setPlayerData($RPB_PlayerData);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        //发送请求
        $Header = array(
            'PBName:'.'protos.PBS_UsrDataOprater',
            'PBSize:'.strlen($PBSUsrDataOpraterString),
            'UID:'.$playerid,
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$DataInfo['version'],
        );
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend($Header,$PBSUsrDataOpraterString);
        if(strlen($PBS_UsrDataOpraterRespond)==0){
            $result = 3004;
            goto response;
        }
        if($PBS_UsrDataOpraterRespond  == 504){
            $result = 3005;
            goto response;
        }
        //接受回应
        $PBS_UsrDataOpraterReturn->reset();
        $PBS_UsrDataOpraterReturn =  new PBS_UsrDataOpraterReturn();
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = $ReplyCode;
            goto response;
        }
        $dataVipRewardLog = array();
        $infoData = array();
        foreach ($catVipReward as $k=>$v){
            $infoData[$k]['Code']     = $v['Code'];
            $infoData[$k]['Number']   = $v['GetNum']* $v['Number'];
            $infoData[$k]['Type']     = $v['Type'];
            $dataVipRewardLog[$k]['playerid'] =    $playerid;
            $dataVipRewardLog[$k]['Level']    =    $VipLevel;
            $dataVipRewardLog[$k]['Number']   =    $v['Number'];
            $dataVipRewardLog[$k]['GetNum']   =    $v['GetNum'];
            $dataVipRewardLog[$k]['Code']     =    $v['Code'];
            $dataVipRewardLog[$k]['GoodsID']  =    $v['GoodsID'];
            $dataVipRewardLog[$k]['Type']     =    $v['Type'];
            $dataVipRewardLog[$k]['Channel']  =    $DataInfo['channel'];
        }
        $addVipRewardLog = M('jy_vip_reward_log')
                           ->addAll($dataVipRewardLog);
        if(!$addVipRewardLog){
            $result = 4007;
            goto response;
        }
        $info = $infoData;
        response:
            $response = array(
                'result' => $result,
                'msg' => $msgArr[$result],
                'sessionid'=>$DataInfo['sessionid'],
                'data' => $info,
            );
            $this->response($response,'json');
    }
    //vip 奖励信息
    public function info(){
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
            'UID:'.$playerid,
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
        //查询奖励
        $catVipReward = array(
            'b.Code',
            'b.Type',
            'b.Name',
            'a.Level',
            'b.ImgCode',
            'b.Id as GoodsID',
            'a.Number*b.GetNum as Number',
        );
        $catVipReward = M('jy_vip_reward as a')
            ->join('jy_goods_all as b on a.GoodsID = b.Id')
            ->where('b.Isdel = 1')
            ->field($catVipReward)
            ->order('a.Level')
            ->select();
        if(empty($catVipReward)){
            $result = 5002;
            goto response;
        }
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
        $info['info']   = $catVipReward;
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