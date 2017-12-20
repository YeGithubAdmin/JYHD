<?php
/***
 * 七天签到信息
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
class SevenDaysSignController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $Platform       =       $this->platform;
        $Version        =       $this->version;
        $obj   = new \Common\Lib\func();
        $msgArr[3002]  = '与游戏断开，请稍后再试。';
        $msgArr[3003]  = '与游戏断开，请稍后再试。';
        $msgArr[4006]  = '用户ID缺失。';
        $msgArr[5001]  = '系统错误，请稍后在试。';
        $result = 2001;
        $info   =  array();
        $playerid  = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }
        //已入protobuf 类
        $obj->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'RedisProto/RPB_PlayerData.php',
            'RedisProto/RPB_AccountData.php',
            'OptReason.php',
            'RPB_PlayerNumerical.php',
            'Protos/UsrDataOpt.php',
            'Protos/OptSrc.php',
        ));
        $PBS_UsrDataOprater = new PBS_UsrDataOprater();
        $OptSrc             = new OptSrc();
        $UsrDataOpt         = new UsrDataOpt();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_All);
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
        //获得结果
        $PBS_UsrDataOpraterReturnBase  =  $PBS_UsrDataOpraterReturn->getBase();

        //累计签到累计
        $SignDay = $PBS_UsrDataOpraterReturnBase->getSignDay();
        //最近签到时间
        $SignTime =  $PBS_UsrDataOpraterReturnBase->getSignTime();
        $SignTime = strtotime(date('Y-m-d',$SignTime));
        //当天时间
        $SameTime =  strtotime(date('Y-m-d',time()));
        //当天签到状态  1-未签到   2-已签到
        $isSign = 1;
        if($SignTime<$SameTime){
            $isSign = 1;
        }
        if($SignTime == $SameTime){
            $isSign = 2;
        }

        //是否超过28天
        $IsExceed = 1;
        if($SignDay == 28){
            if($isSign == 2){
                $IsExceed = 1;
            }else{
                $IsExceed = 2;
            }
        }elseif($SignDay >28){
            $IsExceed = 2;
        }else{
            $IsExceed = 1;
        }




        $SignDay = $SignDay%7;

        //签到信息列表

        $sevenDaysSignFile = array(
            'a.ImgCode',
            'a.Day',
            'b.Type',
            'b.GetNum*a.Number as Number'
            );

        $sevenDaysSign = M('jy_seven_days_sign as a')
            ->join('jy_goods_all as b on b.Id = a.GoodsID','left')
            ->field($sevenDaysSignFile)
            ->where('IsExceed = '.$IsExceed)
            ->order('a.Day asc')
            ->select();
        //status 1-未签 2-已签 3-今日领取  4-明日可以领取
        foreach ($sevenDaysSign as $k=>$v){
            if($isSign == 1){
                if($SignDay == 0){
                    if($v['Day'] == 1){
                        $sevenDaysSign[$k]['Status'] = 3;
                    }elseif($v['Day'] == 2){
                        $sevenDaysSign[$k]['Status'] = 4;
                    }else{
                        $sevenDaysSign[$k]['Status'] = 1;
                    }
                }
                if($SignDay>0 && $SignDay<6){
                    if($SignDay+1 == $v['Day']){
                        $sevenDaysSign[$k]['Status'] = 3;
                    }elseif($SignDay+2 == $v['Day']){
                        $sevenDaysSign[$k]['Status'] = 4;
                    }elseif($SignDay>=$v['Day']){
                        $sevenDaysSign[$k]['Status'] = 2;
                    }elseif ($SignDay<$v['Day']){
                        $sevenDaysSign[$k]['Status'] = 1;
                    }
                }
                if($SignDay==6){
                    if($SignDay+1 == $v['Day']){
                        $sevenDaysSign[$k]['Status'] = 3;
                    }elseif($SignDay >= $v['Day']){
                        $sevenDaysSign[$k]['Status'] = 2;
                    }
                }
            }else{
                if($SignDay == 0){
                    $sevenDaysSign[$k]['Status'] = 2;
                }
                if($SignDay>0 && $SignDay<=6){
                    if($SignDay>=$v['Day']){
                        $sevenDaysSign[$k]['Status'] = 2;
                    }elseif ($SignDay+1 == $v['Day']){
                        $sevenDaysSign[$k]['Status'] = 4;
                    }elseif($SignDay<$v['Day']){
                        $sevenDaysSign[$k]['Status'] = 1;
                    }
                }

            }

        }
        $info['SignInfo']  =   $sevenDaysSign;
        $info['Status']    =   $isSign;

        response:
            $response = array(
                'result' => $result,
                'msg' => $msgArr[$result],
                'sessionid'=>$DataInfo['sessionid'],
                'data' => $info,
            );
            $this->response($response,'json');


    }

    public function Sign(){

        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $obj            =       new \Common\Lib\func();
        $msgArr[2001]  = '签到成功。';
        $msgArr[3002]  = '与游戏断开，请稍后再试。';
        $msgArr[3003]  = '网络错误，请稍后再试。';
        $msgArr[4006]  = '用户ID缺失。';
        $msgArr[5001]  = '签到物品不存在。';
        $msgArr[7001]  = '当天已签到，请勿重复签到。';
        $result = 2001;
        $info   =  array();

        $playerid  = $DataInfo['playerid'];

        if(empty($playerid)){
            $result = 4006;
            goto response;
        }

        /*************************请求服务器获取签到数据**************************/
        //已入protobuf 类
        $obj->ProtobufObj(array(
            'Protos/PBS_UsrDataOprater.php',
            'Protos/PBS_UsrDataOpraterReturn.php',
            'Protos/UsrDataOpt.php',
            'OptReason.php',
            'Protos/OptSrc.php',
            'RPB_PlayerNumerical.php',
            'RedisProto/RPB_PlayerData.php',
            'PB_Item.php',
        ));
        //实例化对象
        $PBS_UsrDataOprater = new PBS_UsrDataOprater();
        $UsrDataOpt         = new UsrDataOpt();
        $OptSrc             = new OptSrc();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_Player);
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
            $result = 3002;
            goto response;
        }
        if(strlen($PBS_UsrDataOpraterRespond)==0){
            $result = 3003;
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
        //获得结果
        $PBS_UsrDataOpraterReturnBase  =  $PBS_UsrDataOpraterReturn->getBase();
        //累计签到累计
        $SignDay        =       $PBS_UsrDataOpraterReturnBase->getSignDay();
        $SignDayRes     =       $SignDay;
        //最近签到时间
        $SignTime =      $PBS_UsrDataOpraterReturnBase->getSignTime();
        $VipLevel =      $PBS_UsrDataOpraterReturnBase->getVip();
        $SignTime =      strtotime(date('Y-m-d',$SignTime));
        //当天时间
        $SameTime =     strtotime(date('Y-m-d',time()));
        //当天签到状态  1-未签到   2-已签到
        $isSign = 1;
        if($SignTime<$SameTime){
            $isSign = 1;
        }
        if($SignTime == $SameTime){
            $isSign = 2;
        }
        //已签到
        if($isSign == 2){
            $result  = 7001;
            goto  response;
        }
        //是否超过28天
        $IsExceed = 1;
        if($SignDay >= 28){
            $IsExceed = 2;
        }else{
            $IsExceed = 1;
        }

        //获取第几天奖励
        $SignDay = $SignDay%7;
        if($SignDay == 0){
            $SignDay = 1;
        }else{
            $SignDay = $SignDay+1;
        }


        //实例化数据库
        $model = new Model();

        //查询奖励
        $rewardInfo =  $model
                        ->table('jy_goods_all as a')
                        ->join('jy_seven_days_sign as b on b.GoodsID  =  a.id and b.Day = '.$SignDay.' and b.IsExceed = '.$IsExceed)
                        ->where('a.IsDel = 1')
                        ->field('a.GetNum,b.Number,a.Id,a.Type,a.Code')
                        ->find();

        if(empty($rewardInfo)){
            $result  = 5001;
            goto  response;
        }

        /****************************发放签到奖励与更天数和时间************************************/
        $PBS_UsrDataOprater->reset();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $RPB_PlayerData   =  new RPB_PlayerData();
        $OptReason        =  new \OptReason();
        $PBS_UsrDataOprater->setReason($OptReason::checkin_reward);
        $dataUsersGoodsStream       = array();      //道具流水
        $dataUsersCurrencyStream    = array();      //金币砖石流水
            $num = $rewardInfo['Number']*$rewardInfo['GetNum'];
            if($VipLevel >= 1){
                $num = $num*2;
            }
            switch ($rewardInfo['Type']){
                  //金币
                case 1:
                    $dataUsersCurrencyStream['playerid']       =   $playerid;
                    $dataUsersCurrencyStream['Type']           =   3;
                    $dataUsersCurrencyStream['CurrencyType']   =   1;
                    $dataUsersCurrencyStream['Income']         =   1;
                    $dataUsersCurrencyStream['Number']         =  $num;
                    $RPB_PlayerData->setGold($num);
                break;
                  //砖石
                case 2:
                    $RPB_PlayerData->setDiamond($num);
                    $dataUsersCurrencyStream['playerid']       =   $playerid;
                    $dataUsersCurrencyStream['Type']           =   3;
                    $dataUsersCurrencyStream['CurrencyType']   =   2;
                    $dataUsersCurrencyStream['Income']         =   1;
                    $dataUsersCurrencyStream['Number']         =  $num;
                break;
                 //道具
                case 3:
                    $PBS_ItemOpt      =  new \PB_Item();
                    $PBS_ItemOpt->setNum($num);
                    $PBS_ItemOpt->setId($rewardInfo['Code']);
                    $PBS_UsrDataOprater->appendItemOpt($PBS_ItemOpt);
                    $dataUsersGoodsStream['playerid']      =       $playerid;
                    $dataUsersGoodsStream['Code']          =       $rewardInfo['Code'];
                    $dataUsersGoodsStream['Type']          =       3;
                    $dataUsersGoodsStream['Income']        =       1;
                    $dataUsersGoodsStream['Number']        =       $num;
                   break;
            }

        $time = time();
        $setSignDay = $SignDayRes+1;
        $RPB_PlayerData->setSignDay($setSignDay);
        $RPB_PlayerData->setSignTime($time);
        $PBS_UsrDataOprater->setPlayerData($RPB_PlayerData);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();


        $Header = array(
            'PBName:'.'protos.PBS_UsrDataOprater',
            'PBSize:'.strlen($PBSUsrDataOpraterString),
            'UID:'.$playerid,
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$DataInfo['version'],
        );

        //发送请求
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend($Header,$PBSUsrDataOpraterString);
        if($PBS_UsrDataOpraterRespond  == 504){
            $result = 3004;
            goto response;
        }
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $result = $ReplyCode;
            goto response;
        }
        /****************************记录签到奖励************************************/
        //签到记录
        $dataUsersSignLog = array(
            'playerid'=>$playerid,
            'GoodsID'=>$rewardInfo['Id'],
            'Code'=>$rewardInfo['Code'],
            'Day'=>$SignDay,
            'Channel'=>$DataInfo['channel'],
            'Type'=>$rewardInfo['Type'],
            'GetNum'=>$rewardInfo['GetNum'],
            'Number'=>$rewardInfo['Number'],
        );
        $addUsersSignLog = M('jy_users_sign_log')
                           ->add($dataUsersSignLog);
        $addUsersCurrencyStream = 1;   //记录金币砖石流水
        $addUsersGoodsStream    = 1;                              //记录道具流水
        if(!empty($dataUsersCurrencyStream)){
            $addUsersCurrencyStream = M('jy_users_currency_stream')
                ->add($dataUsersCurrencyStream);
        }
        if(!empty($dataUsersGoodsStream)){
            $addUsersGoodsStream   = M('jy_users_goods_stream')
                ->add($dataUsersGoodsStream);
        }
        if(!$addUsersGoodsStream || !$addUsersCurrencyStream){
            $result = 3005;
            goto  response;
        }

        if($rewardInfo['Type']>=1){
            if($VipLevel>=1){
                $info['Number'] =  $rewardInfo['Number']*$rewardInfo['GetNum']*2;
            }else{
                $info['Number'] =  $rewardInfo['Number']*$rewardInfo['GetNum'];
            }
            $info['Code']   =  $rewardInfo['Code'];
            $info['Type']   =  $rewardInfo['Type'];
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