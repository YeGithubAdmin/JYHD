<?php
/***
 * 新手礼包
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
class NovicePackController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $result = 2001;
        $info   =  array();
        $ComFun = D('ComFun');
        $LogLevel = 'INFO';
        //状态码
        $msgArr[4006] = "新手礼包不存在！";
        //查询信息
        $GoodsInfoFile =  array();
        $GoodsAll = M('jy_goods_all')
            ->field($GoodsInfoFile)
            ->where('ShowType = 5 and  CateGory = 4  and IsDel = 1')
            ->find();
        if(empty($GoodsAll)){
            $result = 4006;
            $LogLevel = 'ERROR';
            goto response;
        }
        $GiveInfo           = json_decode($GoodsAll['GiveInfo'],true);
        $CardGoodsInfo      = array();
        if(!empty($GiveInfo)){
            $GoodID = array();
            foreach ($GiveInfo as $k=>$v){
                $GoodID[] = $v['Id'];
            }
            $CardGoodsInfoFile  = array(
                'Id',
                'Name',
                'GetNum',
                'ImgCode',
                'Type',
            );
            $GoodID = implode(',',$GoodID);
            $CardGoodsInfo      =  M('jy_goods_all')
                ->field($CardGoodsInfoFile)
                ->where('Id in('.$GoodID.')')
                ->select();
            $GiveInfoSort = array();
            foreach ($GiveInfo as $k=>$v) $GiveInfoSort[$v['Id']] = $v;
            foreach ($CardGoodsInfo as $k=>$v){
                $goods = $GiveInfoSort[$v['Id']];
                if($goods){
                    $CardGoodsInfo[$k]['Number'] =  $v['GetNum']*$goods['GetNum'];
                }
                unset($CardGoodsInfo[$k]['GetNum']);
                unset($CardGoodsInfo[$k]['Id']);
            }

        }
        $info = $CardGoodsInfo;
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
    //领取
    public  function  Receive(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $obj = new  \Common\Lib\func();

        $result = 2001;
        $info   =  array();
        $ComFun = D('ComFun');
        $LogLevel = 'INFO';
        //状态码
        $msgArr[2001] = "领取成功！";
        $msgArr[3001] = "网络错误请稍后在试！";
        $msgArr[3003] = "与游戏服务器断开，请稍后再试！";
        $msgArr[3004] = "与游戏服务器断开，请稍后再试！";
        $msgArr[4006] = "用户信息不存在！";
        $msgArr[4007] = "新手礼包不存在！";
        $msgArr[4008] = "奖励不存在！";
        $msgArr[7001] = "已经领取过！";
        //用户ID
        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
                $result = 4006;
                $LogLevel = 'NOTICE';
                goto response;
        }
        //查询记录
        $catNovicePackLogField = array();
        $catNovicePackLog = M('jy_novice_pack_log')
                            ->where('playerid = '.$playerid)
                            ->field($catNovicePackLogField)
                            ->find();
        if(!empty($catNovicePackLog)){
            $result = 7001;
            goto response;
        }
        //查询奖励
        $GoodsInfoFile =  array();
        $GoodsAll = M('jy_goods_all')
            ->field($GoodsInfoFile)
            ->where('ShowType = 5 and  CateGory = 4  and IsDel = 1')
            ->find();
        if(empty($GoodsAll)){
            $result = 4007;
            $LogLevel = 'ERROR';
            goto response;
        }
        $GiveInfo           = json_decode($GoodsAll['GiveInfo'],true);
        $CardGoodsInfo      = array();
        if(!empty($GiveInfo)){
            $GoodID = array();
            foreach ($GiveInfo as $k=>$v){
                $GoodID[] = $v['Id'];
            }
            $CardGoodsInfoFile  = array(
                'Id',
                'Name',
                'GetNum',
                'Code',
                'Type',
            );
            $GoodID = implode(',',$GoodID);
            $CardGoodsInfo      =  M('jy_goods_all')
                ->field($CardGoodsInfoFile)
                ->where('Id in('.$GoodID.')')
                ->select();

            $GiveInfoSort = array();
            foreach ($GiveInfo as $k=>$v) $GiveInfoSort[$v['Id']] = $v;
            foreach ($CardGoodsInfo as $k=>$v){
                $goods = $GiveInfoSort[$v['Id']];
                if($goods){
                    $CardGoodsInfo[$k]['Number'] =  $v['GetNum']*$goods['GetNum'];
                }
            }
        }
        if(empty($CardGoodsInfo)){
            $result = 4008;
            $LogLevel = 'ERROR';
            goto response;
        }
        //添加奖励
        //已入protobuf 类
        $obj->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'Protos/OptSrc.php',
            'Protos/UsrDataOpt.php',
            'OptReason.php',
            'RPB_PlayerNumerical.php',
            'RedisProto/RPB_PlayerData.php',
            'PB_Item.php',
        ));
        $PBS_UsrDataOprater  = new PBS_UsrDataOprater();
        $RPB_PlayerData      = new RPB_PlayerData();
        $UsrDataOpt          = new UsrDataOpt();
        $OptSrc              = new OptSrc();
        $OptReason           = new \OptReason();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $PBS_UsrDataOprater->setReason($OptReason::new_player_gift);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $RPB_PlayerData->setIsGotXslb(true);
        foreach ($CardGoodsInfo as $k=>$v){
            $info[$k]['Number'] = $v['Number'];
            $info[$k]['Type']   = $v['Type'];
            $info[$k]['Code']   = $v['Code'];
            switch ($v['Type']){
                //金币
                case  1 :
                    $RPB_PlayerData->setGold($v['Number']);

                    break;
                //砖石
                case  2 :
                    $RPB_PlayerData->setDiamond($v['Number']);
                    break;
                //道具
                case 3  :
                    $PB_Item  = new \PB_Item();
                    $PB_Item->setNum($v['Number']);
                    $PB_Item->setId($v['Code']);
                    $PBS_UsrDataOprater->appendItemOpt($PB_Item);
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
        if($PBS_UsrDataOpraterRespond  == 504){
            $result = 3003;
            $LogLevel = 'CRITICAL';
            goto response;
        }
        if(strlen($PBS_UsrDataOpraterRespond)==0){
            $result = 3004;
            $LogLevel = 'CRITICAL';
            goto response;
        }
        //接受回应
        $PBS_UsrDataOpraterReturn =  new PBS_UsrDataOpraterReturn();
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = $ReplyCode;
            $LogLevel = 'CRITICAL';
            goto response;
        }
        //添加记录
        foreach ($CardGoodsInfo as $k=>$v){
            $CardGoodsInfo[$k]['Channel'] = $DataInfo['channel'];
            $CardGoodsInfo[$k]['playerid'] = $playerid;
            unset($CardGoodsInfo[$k]['Id']);
            unset($CardGoodsInfo[$k]['GetNum']);
            unset($CardGoodsInfo[$k]['Name']);
        }
        $db = M('jy_novice_pack_log');
        $addNovicePackLog = $db
                            ->addAll($CardGoodsInfo);

        if(!$addNovicePackLog){
            $result = 3001;
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
}