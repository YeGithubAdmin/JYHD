<?php
/***
 * 30签到
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
class ThirtyDaySignController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
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
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$playerid);
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
        $VipLevel = $PBS_UsrDataOpraterReturnBase->getVip();
        $SignTime = strtotime(date('Y-m-d',$SignTime));
        //当天时间
        $SameTime =  strtotime(date('Y-m-d',time()));


        $info['SignDay'] = $SignDay;

        //当天签到状态  1-未签到   2-已签到
        $isSign = 1;
        if($SignTime<$SameTime){
            $isSign = 1;
        }
        if($SignTime == $SameTime){
            $isSign = 2;
        }

        //判断奖励配置
        $Status =  1;
        //判断今天第几天
        $MoSignDay = $SignDay%30;
        $info['MoSignDay'] = $MoSignDay;
        if($SignDay<=30 && $isSign == 2){
            //小余等 30天 当天已签到
            $Status = 1;
        }elseif($SignDay<30){
            //小余 30天
            $Status = 1;
        }elseif($SignDay>=30 &&  $SignDay<60  && $isSign == 1){
            //大于等于 30天  &&  小余 60天   && 未签到
            $Status = 2;
        }elseif ($SignDay>=30 &&  $SignDay<=60 && $isSign == 2){
            $Status = 2;
        }elseif ($SignDay>=60 && $isSign == 1){
            $Status = 3;
        }elseif ($SignDay>60){
            $Status = 3;
        }


        //查询奖励
        $catSignGoods = M('conf_thirtyday_sign')
                        ->where('Status = '.$Status)
                        ->field(array(
                            'ImgCode',
                            'Day',
                            'Color',
                            'LongTitle',
                            'ShortTitle',
                        ))
                        ->order('Day  asc')
                        ->select();
        //修改签到状态 1-未签 2-已签 3-今日  4-明日
        foreach ($catSignGoods as $k=>$v){
             if($MoSignDay == 0 && $isSign == 2){
                 if($v['Day'] == 1){
                     $catSignGoods[$k]['SignStatus'] = 2;
                 }else{
                     $catSignGoods[$k]['SignStatus'] = 1;
                 }
             }
             if($MoSignDay == 0 && $isSign == 1){

                if($v['Day'] == 1){
                    $catSignGoods[$k]['SignStatus'] = 3;
                }else{
                    $catSignGoods[$k]['SignStatus'] = 1;
                }
             }
             if($MoSignDay>0 && $MoSignDay < 30){
                    if($v['Day']<= $MoSignDay){
                        $catSignGoods[$k]['SignStatus'] = 2;
                    }else{
                        $catSignGoods[$k]['SignStatus'] = 1;
                    }
                    if($isSign == 1){
                        if($MoSignDay+1 == $v['Day']){
                            $catSignGoods[$k]['SignStatus'] = 3;
                        }
                    }
             }
        }
        //连续签到信息
        $LogThirtydaySign = M('log_thirtyday_sign')
                            ->where('playerid = '.$playerid)
                            ->field(array(
                                'DayNum',
                                'Status',
                                'Day',
                                'Primary',
                                'Continuity',
                                'DateTime',
                            ))
                            ->find();
        //判断是否中断签到
        $Continuity = 0;
        $Primary    = 1;
        $time = time();

        if(!empty($LogThirtydaySign)){
             $DataTime =  $SignTime;
             $Primary = $LogThirtydaySign['Primary'];
             if($time-$DataTime<48*60*60){
                 $Continuity = $LogThirtydaySign['Continuity'];
             }
        }

        //查询连续签到奖励信息
        $ContinuityConfig = M('conf_thirtyday_continuity')
                            ->field(array(
                                'Name',
                                'ImgCode',
                                'Continuity',
                            ))
                            ->order('continuity asc')
                            ->select();
        $MaxContinuityConfig = $ContinuityConfig[count($ContinuityConfig)-1]['Continuity'];
        //查看领取记录
        $logContinuity   = M('log_thirtyday_continuity')
                           ->where('`Primary` = '.$Primary.'  and  `playerid`  = '.$playerid)
                           ->field(array(
                               'Continuity',
                               'DateTime',
                           ))
                           ->order('Continuity asc')
                           ->select();


        $MaxlogContinuity     = $logContinuity[count($logContinuity)-1]['continuity'];
        $MaxlogContinuityTime = $logContinuity[count($logContinuity)-1]['DateTime'];
        //判断连续签到状态 Status 1-不领取 2-已领取 3-可以领取
        $logContinuitySort = array();
        $MaxlogContinuityTime =  strtotime(date('Y-m-d',strtotime($MaxlogContinuityTime)));


        foreach ($logContinuity as $k=>$v) $logContinuitySort[$v['Continuity']] = $v;

        foreach ($ContinuityConfig as $k=>$v){
              $SortValue = $logContinuitySort[$v['Continuity']];
              if($SortValue && $Continuity >=  $v['Continuity']){
                  $ContinuityConfig[$k]['Status'] = 2;
              }elseif(!$SortValue && $Continuity >=  $v['Continuity']){
                  $ContinuityConfig[$k]['Status'] = 3;
              }else{
                  $ContinuityConfig[$k]['Status'] = 1;
              }
              if($MaxContinuityConfig == $MaxlogContinuity && $time-$MaxlogContinuityTime> 24*60*60){
                  $ContinuityConfig[$k]['Status'] = 1;
                  $Continuity = 0;
              }
        }
        //vip奖励
        //查询奖励
        $catVipReward = array(
            'b.Name',
            'a.Level',
            'b.ImgCode',
            'a.Number*b.GetNum as Number',
        );
        $catVipReward = M('jy_vip_reward as a')
            ->join('jy_goods_all as b on a.GoodsID = b.Id')
            ->where('b.Isdel = 1')
            ->field($catVipReward)
            ->order('a.Level asc')
            ->select();

         //
         $newVipInfo = array();
         foreach ($catVipReward as $k=>$v){
                $newVipInfo[$v['Level']]['level'] = $v['Level'];
         }
         foreach ($catVipReward as $k=>$v){
           $VipSort =$newVipInfo[$v['Level']];
           $dataVip = array();
           if($VipSort){
               $dataVip['Name']    = $v['Name'];
               $dataVip['ImgCode'] = $v['ImgCode'];
               $dataVip['Number']  = $v['Number'];
           }
           $newVipInfo[$v['Level']]['GiveInfo'][] = $dataVip;
         }
        $newVipInfo = array_values($newVipInfo);

        //组装数据
        $info['SignInfo']         =       $catSignGoods;
        $info['VipInfo']          =       $newVipInfo;
        $info['continuityData']   =       $ContinuityConfig;
        $info['continuity']       =       $Continuity;
        $info['Status']           =       $isSign;
        $info['configure']        =       $Status;
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
        $msgArr[5002]  = '连续奖励不存在';
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
        $OptReason          = new \OptReason();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_Player);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        //发送请求
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$playerid);
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
        //判断奖励配置
        $Status =  1;
        //判断今天第几天
        $MoSignDay = $SignDay%30;
        if($SignDay<=30 && $isSign == 2){
            //小余等 30天 当天已签到
            $Status = 1;
        }elseif($SignDay<30){
            //小余 30天
            $Status = 1;
        }elseif($SignDay>=30 &&  $SignDay<60  && $isSign == 1){
            //大于等于 30天  &&  小余 60天   && 未签到
            $Status = 2;
        }elseif ($SignDay>=30 &&  $SignDay<=60 && $isSign == 2){
            $Status = 2;
        }elseif ($SignDay>=60 && $isSign == 1){
            $Status = 3;
        }elseif ($SignDay>60){
            $Status = 3;
        }
        $SignNum = $MoSignDay+1;
        //查询奖励
        $catSignGoods = M('conf_thirtyday_goods as a')
                        ->join('jy_goods_all as b on b.Id = a.GoodsID and b.IsDel = 1')
                        ->where('a.Status = '.$Status.' and  a.Day = '.$SignNum)
                        ->field(array(
                            'b.Type',
                            'b.Code',
                            'a.GoodsID',
                            'a.Number*b.GetNum as Number',
                        ))
                        ->select();
        if(empty($catSignGoods)){
            $result =  5001;
            goto response;
        }
        //签到情况信息
        $LogThirtydaySign = M('log_thirtyday_sign')
                            ->where('playerid = '.$playerid)
                            ->field(
                                array(
                                    'DayNum',
                                    '`Primary`',
                                    'Continuity',
                                    'Status',
                                    'Day',
                                    'DateTime',
                                )
                            )->find();

        //判读连续是否中断
        $Continuity = 0;
        $Primary    = 1;
        $DayNum     = 0;
        if(!empty($LogThirtydaySign)){
            $time = time();
            $DataTime =  $SignTime;
            $Primary = $LogThirtydaySign['Primary'];

            if($time-$DataTime<48*60*60){

                $Continuity = $LogThirtydaySign['Continuity'];
            }else{
                $Primary = $Primary+1;
            }
            $DayNum = $LogThirtydaySign['DayNum'];
        }
        //查询连续最大奖励值
        $ThirtydayContinuity = M('conf_thirtyday_continuity')
                               ->field('max(continuity) as continuity')
                               ->select();

        if(empty($ThirtydayContinuity)){
               $result = 5002;
               goto  response;
        }
        //判断是否已经达到最大奖励
        if($Continuity >= $ThirtydayContinuity[0]['continuity']){
            //连续奖励记录
            $LogThirtydayContinuity = M('log_thirtyday_continuity')
                ->where('playerid = '.$playerid.' 
                         and  `Primary` ='.$Primary.' 
                         and continuity = '.$ThirtydayContinuity[0]['continuity'])
                ->find();
            if(!empty($LogThirtydayContinuity)){
                $Continuity = 1;
                $Primary    = $LogThirtydaySign['Primary']+1;
            }
        }else{
            $Continuity = $Continuity+1;
        }
        $model = new Model();
        $model->startTrans();
        //添加记录
        $dataLogThirtydaySign = array(
            'DayNum'        =>      $DayNum+1,
            'Primary'       =>      $Primary,
            'Continuity'    =>      $Continuity,
            'Status'        =>      $Status,
            'Day'           =>      $SignNum,
            'DateTime'      =>      date('Y-m-d H:i:s'),
        );
        $addThirtydaySign = 1;
        $UpLogThirtydaySign = 1;
        if(!empty($LogThirtydaySign)){
            $db = M('log_thirtyday_sign');
            $UpLogThirtydaySign =  $db
                                   ->where('playerid = '.$playerid)
                                   ->save($dataLogThirtydaySign);
        }else{
            $dataLogThirtydaySign['playerid'] = $playerid;
            $addThirtydaySign = M('log_thirtyday_sign')
                ->add($dataLogThirtydaySign);
        }
        if(!$UpLogThirtydaySign){
            $result = 3001;
            $model->rollback();
            goto  response;
        }
        if(!$addThirtydaySign){
            $result = 3002;
            $model->rollback();
            goto  response;
        }
        //添加奖励
        $PBS_UsrDataOprater->reset();
        $PBS_UsrDataOpraterReturn->reset();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBS_UsrDataOprater->setReason($OptReason::checkin_reward);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $RPB_PlayerData = new RPB_PlayerData();
        $RPB_PlayerData->setSignDay($SignDay+1);
        $RPB_PlayerData->setSignTime(time());

        $infoData = array();
        foreach ($catSignGoods as $k=>$v){
              $num =  $v['Number'];

              if($VipLevel>0){
                 $num =  $num*2;
              }
              if($v['Type']> 0 &&  $v['Type']<=3 ){
                  $infoData[$k]['Type']   =  $v['Type'];
                  $infoData[$k]['Code']   =  $v['Code'];
                  $infoData[$k]['Number'] =  $v['Number'];
              }
              switch ($v['Type']){
                  case 1:
                      $RPB_PlayerData->setGold($num);
                      break;
                  case 2:
                      $RPB_PlayerData->setDiamond($num);
                      break;
                  case 3:
                      $PB_Item = new \PB_Item();
                      $PB_Item->setId($v['Code']);
                      $PB_Item->setNum($num);
                      $PBS_UsrDataOprater->appendItemOpt($PB_Item);
                      break;
              }
        }


        $PBS_UsrDataOprater->setPlayerData($RPB_PlayerData);


        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();

        //发送请求
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$playerid);
        if($PBS_UsrDataOpraterRespond  == 504){
            $result = 3004;
            goto response;
        }
        if(strlen($PBS_UsrDataOpraterRespond)==0){
            $result = 3005;
            goto response;
        }
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            $model->rollback();
            $result = $ReplyCode;
            goto response;
        }
        if($ReplyCode == 1 && $UpLogThirtydaySign && $addThirtydaySign){
            $model->commit();
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
    public function continuity(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $obj            =       new \Common\Lib\func();
        $msgArr[2001]  = '领取成功。';
        $msgArr[3002]  = '与游戏断开，请稍后再试。';
        $msgArr[3003]  = '网络错误，请稍后再试。';
        $msgArr[4006]  = '用户ID缺失。';
        $msgArr[4007]  = '签到信息不存在。';
        $msgArr[4008]  = 'Continuity参数缺失。';
        $msgArr[5001]  = '连续奖励不存在';
        $msgArr[7001]  = '未满足条件。';
        $msgArr[7002]  = '已经领取过。';
        $result = 2001;
        $info      =  array();
        $playerid  = $DataInfo['playerid'];
        $Day       = $DataInfo['Continuity'];
        if(empty($playerid)){
            $result = 4006;
            goto response;
        }


        if(empty($Day)){
            $result = 4008;
            goto response;
        }


        //查看签到情况
        $thirtydaySign = M('log_thirtyday_sign')
                        ->where('playerid = '.$playerid)
                        ->field(
                            array(
                                'DayNum',
                                '`Primary`',
                                'Continuity',
                                'Status',
                                'Day',
                                'DateTime',
                            )
                        )
                        ->find();


        if(empty($thirtydaySign)){
            $result =  4007;
            goto response;
        }
        $Primary    = $thirtydaySign['Primary'];
        //是否已断签
        $time = time();
        $DataTime =  strtotime(date('Y-m-d',strtotime($thirtydaySign['DateTime'])));
        $Continuity = 0;
        if($time-$DataTime<48*60*60){
            $Continuity = $thirtydaySign['Continuity'];
        }
        if($Continuity<$Day){
            $result =  7001;
            goto response;
        }
        //查看连续奖励记录


        $LogThirtydayContinuity = M('log_thirtyday_continuity')
                                  ->where('`playerid` = '.$playerid.'  and  `Continuity` = '.$Day.' and  `Primary` = '.$Primary)
                                  ->field(array(
                                      'Id',
                                  ))
                                  ->find();
        if(!empty($LogThirtydayContinuity)){
            $result =  7002;
            goto response;
        }
        $model = new  Model();
        //查看奖励
        $ThirtydayContinuityGoods = $model
                                    ->table('conf_thirtyday_continuity_goods as a')
                                    ->join('jy_goods_all as b on a.GoodsID = b.Id and IsDel = 1 ')
                                    ->where('continuity = '.$Day)
                                    ->field(array(
                                         'a.Number*b.GetNum as Number',
                                         'b.Type',
                                         'b.Code',
                                         'a.GoodsID',
                                    ))
                                    ->select();
        if(empty($ThirtydayContinuityGoods)){
            $result =  5001;
            goto response;
        }


        $model->startTrans();
        $dataThirtydayContinuity = array(
            'playerid'=>$playerid,
            'Continuity'=>$Day,
            'Primary'=>$thirtydaySign['Primary'],
        );
        $addThirtydayContinuity = M('log_thirtyday_continuity')
                                 ->add($dataThirtydayContinuity);
        if(!$addThirtydayContinuity){
            $model->rollback();
            $result = 3002;
            goto response;
        }

        //添加物品
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
        $PBS_UsrDataOprater         = new PBS_UsrDataOprater();
        $UsrDataOpt                 = new UsrDataOpt();
        $OptSrc                     = new OptSrc();
        $OptReason                  = new \OptReason();
        $RPB_PlayerData             = new RPB_PlayerData();
        $PBS_UsrDataOpraterReturn   = new PBS_UsrDataOpraterReturn();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Request_Player);
        $PBS_UsrDataOprater->setReason($OptReason::checkin_reward);
        $infoData = array();


        foreach ($ThirtydayContinuityGoods as $k=>$v){
                $Num = $v['Number'];
                if($v['Type'] <= 3 && $v['Type']>0){
                    $infoData[$k]['Type'] = $v['Type'];
                    $infoData[$k]['Code'] = $v['Code'];
                    $infoData[$k]['Number'] = $Num;
                }
                switch ($v['Type']){
                    case 1:
                        $RPB_PlayerData->setGold($Num);
                        break;
                    case 2:
                        $RPB_PlayerData->setDiamond($Num);
                        break;
                    case 3:
                        $PB_Item = new \PB_Item();
                        $PB_Item->setNum($Num);
                        $PB_Item->setId($v['Code']);
                        $PBS_UsrDataOprater->appendItemOpt($PB_Item);
                        break;
                }
        }

        $PBS_UsrDataOprater->setPlayerData($RPB_PlayerData);
        $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
        //发送请求
        $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$playerid);
        if($PBS_UsrDataOpraterRespond  == 504){
            $result = 3004;
            goto response;
        }
        if(strlen($PBS_UsrDataOpraterRespond)==0){
            $result = 3005;
            goto response;
        }
        $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
        $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
        //判断结


        if($ReplyCode != 1){
            $model->rollback();
            $result = $ReplyCode;
            goto response;
        }
        if($ReplyCode == 1 && $ThirtydayContinuityGoods){
            $model->commit();
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
}