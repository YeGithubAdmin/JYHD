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
        $obj   = new \Common\Lib\func();
        $result = 2001;
        $info   =  array();

        $msgArr[3003] = "网络错误，请稍后再试！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[5003] = "系统错误，请稍后再试！";
        $msgArr[5004] = "系统错误，请稍后再试！";
        $msgArr[5005] = "系统错误，请稍后再试！";
        $msgArr[7002] = "您还未购过买月卡，请先购买月卡！";
        $msgArr[7003] = "您的月卡已经过期，请先购买月卡！";
        $msgArr[7004] = "当天已经领取过，请明天在来！";
        $msgArr[7005] = "您的月卡已经过期，请先购买月卡！";

        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }

        //判断是否拥有月卡
        $UsersCardShopLog = M('jy_users_package_shop_log')
                            ->field('date_format(DateTime,"%Y-%m-%d")')
                            ->where('playerid = '.$playerid.' and Type = 2')
                            ->order('Id desc')
                            ->find();
        if(empty($UsersCardShopLog)){
            $result = 4006;
            goto response;
        }
        //判断月卡是否过期
        $DateTime           =           $UsersCardShopLog['DateTime'];
        $DateTime           =           strtotime($DateTime);
        $CurrentTime        =           strtotime(date('Y-m-d',time()));
        $DayNum             =           ($CurrentTime-$DateTime)/(24*60*60);
        $OneDay             =           24*60*60;
        $StartTime          =           $CurrentTime+$OneDay;
        $EndTime            =           $CurrentTime-$OneDay;
        if($DayNum > 30){
             $result = 7003;
             goto response;
        }




        //判断今天是否已经领取过  1 未领取过  2 领取过
        $IsReceive = 1;
        $UsersCardReceive = M('jy_users_card_receive_log')
                            ->where('playerid = '.$playerid.' and  DateTime <=  UNIX_TIMESTAMP('.$EndTime.') and  DateTime >= ('.$StartTime.')')
                            ->find();
        if(!empty($UsersCardReceive)){
            $IsReceive = 2;
        }

        if($IsReceive == 2){
            $result = 7004;
            goto response;
        }

        if($IsReceive == 1 && $DayNum == 30){
            $result = 7005;
            goto response;
        }

        //查询奖励
        $GoodsInfoFile = array(
            'GiveInfo',
            'CurrencyNum',

        );
        $GoodsAll = M('jy_goods_all')
                     ->field($GoodsInfoFile)
                     ->where('ShowType = 3 and  CateGory = 4  and IsDel = 1')
                     ->find();
        if(empty($GoodsAll)){
            $result = 5003;
        }
        $GiveInfo           = json_decode($GoodsAll['GiveInfo'],true);
        $GoodID             = array();
        if(empty($GiveInfo)){
            $result = 5004;
            goto  response;
        }
        foreach ($GoodID as $k=>$v){
            $GoodID[] = $v['Id'];
        }

        $GoodID = implode(',',$GoodID);
        $CardGoodsInfoFile  = array(
            'Id',
            'Name',
            'Code',
            'GetNum',
             'Type',
        );
        $CardGoodsInfo      =  M('jy_goods_all')
            ->field($CardGoodsInfoFile)
            ->where('Id in('.$GoodID.')')
            ->select();
        if(empty($CardGoodsInfo)){
            $result = 5005;
            goto  response;
        }
        foreach ($CardGoodsInfo as $k=>$v){
            foreach ($GiveInfo as $key=>$val){
                if($val['Id'] == $v['Id']){
                    $CardGoodsInfo[$k]['GetNum'] =  $v['GetNum']*$val['GetNum'];
                }
            }
        }

        //发放奖励
        //已入protobuf 类
        $obj->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'Protos/OptSrc.php',
            'Protos/UsrDataOpt.php',
            'RedisProto/RPB_PlayerData.php',
            'PB_Item.php',
        ));
        $PBS_UsrDataOprater  = new PBS_UsrDataOprater();
        $RPB_PlayerData      = new RPB_PlayerData();
        $UsrDataOpt          = new UsrDataOpt();
        $OptSrc              = new OptSrc();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $dataUsersGoodsStream     = array();      //道具流水
        $dataUsersCurrencyStream  = array();      //金币砖石流水
        foreach ($CardGoodsInfo as $k=>$v){
             switch ($v['Type']){
                 //金币
                 case  1 :
                     $RPB_PlayerData->setGold($v['GetNum']);
                     $dataUsersCurrencyStream[$k]['playerid']       =   $playerid;
                     $dataUsersCurrencyStream[$k]['Type']           =   5;
                     $dataUsersCurrencyStream[$k]['CurrencyType']   =   1;
                     $dataUsersCurrencyStream[$k]['Income']         =   1;
                     $dataUsersCurrencyStream[$k]['Number']         =   $v['GetNum'];
                     break;
                  //砖石
                 case  2 :
                     $RPB_PlayerData->setDiamond($v['GetNum']);
                     $dataUsersCurrencyStream[$k]['playerid']       =   $playerid;
                     $dataUsersCurrencyStream[$k]['Type']           =   5;
                     $dataUsersCurrencyStream[$k]['CurrencyType']   =   2;
                     $dataUsersCurrencyStream[$k]['Income']         =   1;
                     $dataUsersCurrencyStream[$k]['Number']         =   $v['GetNum'];
                     break;
                 //道具
                 case 3  :
                     $PB_Item  = new \PB_Item();
                     $PB_Item->setNum($v['GetNum']);
                     $PB_Item->setId($v['Code']);
                     $PBS_UsrDataOprater->appendItemOpt($PB_Item);
                     $dataUsersGoodsStream[$k]['playerid']      =       $playerid;
                     $dataUsersGoodsStream[$k]['Code']          =       $v['Code'];
                     $dataUsersGoodsStream[$k]['Type']          =       5;
                     $dataUsersGoodsStream[$k]['Income']        =       1;
                     $dataUsersGoodsStream[$k]['Number']        =       $v['GetNum'];
                     break;
             }
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
        //记录
        $dataUsersCardReceiveLog = array(
            'playerid'=>$playerid
        );
        $addUsersCardReceiveLog =M('jy_users_card_receive_log')
                                ->add($dataUsersCardReceiveLog);
        $addUsersCurrencyStream = 1;   //记录金币砖石流水
        $addUsersGoodsStream    = 1;                              //记录道具流水
        if(!empty($dataUsersCurrencyStream)){
            $addUsersCurrencyStream = M('jy_users_currency_stream')
                                      ->addAll($dataUsersCurrencyStream);
        }
        if(!empty($dataUsersGoodsStream)){
            $addUsersGoodsStream   = M('jy_users_goods_stream')
                                    ->addAll($dataUsersGoodsStream);
        }
        if(!$addUsersCardReceiveLog || !$addUsersGoodsStream || !$addUsersCurrencyStream){
            $result = 3002;
            goto  response;
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