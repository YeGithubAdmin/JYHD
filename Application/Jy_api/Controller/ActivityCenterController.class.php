<?php
/***
 * 活动列表
 * @param array   $msgArr  2*  成功  3.* 超时无响应  4.*丢失或参数缺失  5.* 服务器配置问题  6.*来不明  7.* 权限问题 8.* 配置问题
 * @param int     $page         页码
 * @param int     $num          页数
 * @param int     $channelid    渠道id
 * @param int     $platform     平台号  1-iso  2-安卓
 * @param unknow  $version      版本号
 ***/
namespace Jy_api\Controller;
use Jy_api\Controller\ComController;
use Think\Controller;
use Think\Model;

class ActivityCenterController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $result = 2001;
        $info   =  array();

        $ComFun = D('ComFun');
        $LogLevel = 'INFO';
        //状态码
        $msgArr[4006] = "用户信息缺失！";
        $Channel        =      $DataInfo['channel'];
        $playerid       =      $DataInfo['playerid'];
        if(empty($playerid)){
             $result   = 4006;
             $LogLevel = "NOTICE";
             goto response;
        }
        $ActivityCenter = D('ActivityCenter');
        //查询活动
        $ActivityList = $ActivityCenter->ActivityList($Channel);
        if(empty($ActivityList)){
            goto response;
        }
        $StyleData = array();
        foreach ($ActivityList as $k=>$v){
            $StyleData[$v['Style']] = $v;
        }

        //累计炮倍
        if($StyleData[1]){
            //获取炮倍信息
            $DoubleGunInfo = $ActivityCenter->DoubleGunInfo($playerid,$DataInfo['version'],strtotime($StyleData[1]['ShowStartTime']),strtotime($StyleData[1]['ShowEndTime']));
            if($DoubleGunInfo === false){
                $result = 3002;
                $LogLevel = "CRITICAL";
                goto response;
            }
        }
        //充值
        if($StyleData[3]){
            //查询充值每日充值
            $ActivityListSort = array();
            $Time = strtotime(date('Y-m-d',time()));
            $StartTime      = date('Y-m-d H:i:s',$Time);
            $EndTime        = date('Y-m-d H:i:s',$Time+24*60*60);
            $UserPay        = $ActivityCenter->UsersPay($playerid,$StartTime,$EndTime);
            $UserPayPrice   = $UserPay[0]['Price']? $UserPay[0]['Price']:0;
            //当日领取
            $ReceiveStatus  = $ActivityCenter->SameReceiveStatus($playerid);
        }
        //转盘
        if($StyleData[4]){
            $DUserPay        = $ActivityCenter->UsersPay($playerid,$StyleData[4]['ShowStartTime'],$StyleData[4]['ShowEndTime']);
            $DUserPayPrice   = $DUserPay[0]['Price']?$DUserPay[0]['Price']:0;


        }
        if($StyleData[4] || $StyleData[1]){
            if($StyleData[4]){
                //查询领奖情况
                $DReceiveStatus  = $ActivityCenter->ReceiveStatus($playerid,$StyleData[4]['ShowStartTime'],$StyleData[4]['ShowEndTime']);
            }elseif ($StyleData[1]){
                $DReceiveStatus  = $ActivityCenter->ReceiveStatus($playerid,$StyleData[4]['ShowStartTime'],$StyleData[1]['ShowEndTime']);
            }
        }


        //获取用户已查看的活动

        $catUsersSon = $ActivityCenter->catUsersSon($playerid);

        foreach ($ActivityList as $k=>$v){
            $DataSon    = array();

            $strtotimeStart = strtotime($v['ShowStartTime']);
            $strtotimeEnd   = strtotime($v['ShowEndTime']);
            $ShowStartTime  = array(
                'year'=>date('Y',$strtotimeStart),
                'month'=>date('m',$strtotimeStart),
                'day'=>date('d',$strtotimeStart),
                'dateTime'=>date('H:i',$strtotimeStart),
            );
            $ShowEndTime = array(
                'year'=>date('Y',$strtotimeEnd),
                'month'=>date('m',$strtotimeEnd),
                'day'=>date('d',$strtotimeEnd),
                'dateTime'=>date('H:i',$strtotimeEnd),
            );
            if($catUsersSon[$v['SonId']]){
                $ActivityListSort[$v['Id']]['IsCat'][]          = $v['SonId'];
            }
            switch ($v['Style']){
                //炮台
                case 1:
                    $DoubleNum  = $DReceiveStatus[$v['SonId']]['Num'] ? $DReceiveStatus[$v['SonId']]['Num']:0;
                    if($DoubleNum <=0 && $DoubleGunInfo[$v['Schedule']]){
                        $Status = 2;
                    }elseif ($DoubleNum > 0 && $DoubleGunInfo[$v['Schedule']]){
                        $Status = 3;
                    }else{
                        $Status = 1;
                    }
                    //组装
                    $GiveInfo = array();
                    foreach (json_decode($v['GiveInfo'],true) as $key=>$val){
                        $GiveInfo[$key]['ImgCode']   = $val['ImgCode'];
                        $GiveInfo[$key]['GoodsName'] = $val['GoodsName'];
                        $GiveInfo[$key]['Number']    = $val['Number']*$val['GetNum'];
                        $GiveInfo[$key]['Type']      = $val['Type'];
                        $GiveInfo[$key]['Code']      = $val['Code'];
                    }
                    $DataSon['GiveInfo']                       = array_values($GiveInfo) ;
                    $DataSon['Status']                         = $Status;
                    $DataSon['SonTitle']                       = $v['SonTitle'];
                    $DataSon['ImgCode']                        = $v['ImgCode'];
                    $DataSon['Schedule']                       = $v['Schedule'];
                    $DataSon['Explain']                        = $v['Explain'];
                    $DataSon['Jump']                           = $v['Jump'];
                    $DataSon['TypeCode']                       = $v['TypeCode'];
                    $DataSon['ActivityId']                     = $v['SonId'];
                    $DataSon['Advance']                        = "0";
                    $ActivityListSort[$v['Id']]['AbroadTitle']      = $v['AbroadTitle'];
                    $ActivityListSort[$v['Id']]['WithinTitle']      = $v['WithinTitle'];
                    $ActivityListSort[$v['Id']]['Sort']             = $v['Sort'];
                    $ActivityListSort[$v['Id']]['Style']            = $v['Style'];
                    $ActivityListSort[$v['Id']]['Hot']              = $v['Hot'];
                    $ActivityListSort[$v['Id']]['FatherID']         = $v['Id'];
                    $ActivityListSort[$v['Id']]['ShowStartTime']    = $ShowStartTime;
                    $ActivityListSort[$v['Id']]['ShowEndTime']      = $ShowEndTime;
                    $ActivityListSort[$v['Id']]['DataSon'][]        = $DataSon ;
                    if($Status == 2){
                        $ActivityListSort[$v['Id']]['DataStatus'][]        = $v['SonId'] ;
                    }
                    break;
                //渔场
                case 2:
                    break;
                //累计充值
                case 3:
                    $Num  = $ReceiveStatus[$v['SonId']]['Num'] ? $ReceiveStatus[$v['SonId']]['Num']:0 ;
                        if($UserPayPrice >= $v['Schedule'] && $Num <= 0 ){
                            $Status = 2;
                        }else if($UserPayPrice >= $v['Schedule'] && $Num > 0 ){
                            $Status = 3;
                        }else{
                            $Status = 1;
                        }

                    //组装
                    $GiveInfo = array();
                    foreach (json_decode($v['GiveInfo'],true) as $key=>$val){
                        $GiveInfo[$key]['ImgCode']   = $val['ImgCode'];
                        $GiveInfo[$key]['GoodsName'] = $val['GoodsName'];
                        $GiveInfo[$key]['Number']    = $val['Number']*$val['GetNum'];
                        $GiveInfo[$key]['Type']      = $val['Type'];
                        $GiveInfo[$key]['Code']      = $val['Code'];
                    }
                    $DataSon['GiveInfo']                       = array_values($GiveInfo);
                    $DataSon['Status']                         = $Status;
                    $DataSon['SonTitle']                       = $v['SonTitle'];
                    $DataSon['ImgCode']                        = $v['ImgCode'];
                    $DataSon['Explain']                        = $v['Explain'];
                    $DataSon['Jump']                           = $v['Jump'];
                    $DataSon['Schedule']                       = $v['Schedule'];
                    $DataSon['TypeCode']                       = $v['TypeCode'];
                    $DataSon['ActivityId']                     = $v['SonId'];
                    $DataSon['Advance']                        = $UserPayPrice;
                    $ActivityListSort[$v['Id']]['AbroadTitle']      = $v['AbroadTitle'];
                    $ActivityListSort[$v['Id']]['WithinTitle']      = $v['WithinTitle'];
                    $ActivityListSort[$v['Id']]['Sort']             = $v['Sort'];
                    $ActivityListSort[$v['Id']]['Style']            = $v['Style'];
                    $ActivityListSort[$v['Id']]['Hot']              = $v['Hot'];
                    $ActivityListSort[$v['Id']]['FatherID']         = $v['Id'];
                    $ActivityListSort[$v['Id']]['ShowStartTime']    = $ShowStartTime;
                    $ActivityListSort[$v['Id']]['ShowEndTime']      = $ShowEndTime;
                    $ActivityListSort[$v['Id']]['DataSon'][]        = $DataSon;
                    if($Status == 2){
                        $ActivityListSort[$v['Id']]['DataStatus'][]        = $v['SonId'] ;
                    }
                    break;
                //抽奖
                case 4:
                    $DNum  = $DReceiveStatus[$v['SonId']]['Num'] ?$DReceiveStatus[$v['SonId']]['Num']:0 ;

                    $Status          = 1;
                    $LuckdrawInfoNum = 0;
                    if($v['TypeCode'] == 4001){

                        $LuckdrawInfoNum =  (floor($DUserPayPrice/$v['Schedule'])-$DNum)<0?0:(floor($DUserPayPrice/$v['Schedule'])-$DNum);
                        if($LuckdrawInfoNum != 0){
                            $Status = 2;
                        }else{
                            $Status = 1;
                        }

                        $ActivityList[$k]['LuckdrawInfoNum'] = $LuckdrawInfoNum;

                    }
                    $GiveInfo = array();
                    $GiveSort = array();
                    if(!empty($v['GiveInfo'])){
                        $GiveSort           =  array_values(json_decode($v['GiveInfo'],true));
                        $column             =  array_column($GiveSort,'Sort');
                        array_multisort($column,SORT_ASC,$GiveSort);
                    }
                    foreach ($GiveSort as $key=>$val){
                        $GiveInfo[$key]['ImgCode']   = $val['ImgCode'];
                        $GiveInfo[$key]['GoodsName'] = $val['GoodsName'];
                        $GiveInfo[$key]['Number']    = $val['Number']*$val['GetNum'];
                        $GiveInfo[$key]['Type']      = $val['Type'];
                        $GiveInfo[$key]['Code']      = $val['Code'];
                    }
                    //组装
                    $DataSon['GiveInfo']         = array_values($GiveSort);
                    $DataSon['Status']           = $Status;
                    $DataSon['SonTitle']         = $v['SonTitle'];
                    $DataSon['Schedule']         = $v['Schedule'];
                    $DataSon['Explain']          = $v['Explain'];
                    $DataSon['Jump']             = $v['Jump'];
                    $DataSon['TypeCode']         = $v['TypeCode'];
                    $DataSon['ActivityId']       = $v['SonId'];
                    $DataSon['LuckdrawInfoNum']  = $LuckdrawInfoNum;
                    $DataSon['Advance']          = "0";
                    $ActivityListSort[$v['Id']]['AbroadTitle']      = $v['AbroadTitle'];
                    $ActivityListSort[$v['Id']]['WithinTitle']      = $v['WithinTitle'];
                    $ActivityListSort[$v['Id']]['Sort']             = $v['Sort'];
                    $ActivityListSort[$v['Id']]['Hot']              = $v['Hot'];
                    $ActivityListSort[$v['Id']]['Style']            = $v['Style'];
                    $ActivityListSort[$v['Id']]['FatherID']         = $v['Id'];
                    $ActivityListSort[$v['Id']]['ShowStartTime']    = $ShowStartTime;
                    $ActivityListSort[$v['Id']]['ShowEndTime']      = $ShowEndTime;
                    $ActivityListSort[$v['Id']]['DataSon'][]        = $DataSon ;
                    if($Status == 2){
                        $ActivityListSort[$v['Id']]['DataStatus'][]        = $v['SonId'] ;
                    }
                    break;
                //图片
                case 5:
                    //组装
                    $ActivityListSort[$v['Id']]['AbroadTitle'] = $v['AbroadTitle'];
                    $ActivityListSort[$v['Id']]['WithinTitle'] = $v['WithinTitle'];
                    $ActivityListSort[$v['Id']]['Sort']        = $v['Sort'];
                    $ActivityListSort[$v['Id']]['Style']       = $v['Style'];
                    $ActivityListSort[$v['Id']]['Hot']         = $v['Hot'];
                    $DataSon['ImgCode']                        = $v['ImgCode'];
                    $DataSon['TypeCode']                       = $v['TypeCode'];
                    $DataSon['Explain']                        = $v['Explain'];
                    $DataSon['Jump']                           = $v['Jump'];
                    $DataSon['Advance']                        = "0";
                    $ActivityListSort[$v['Id']]['ShowStartTime']      = $ShowStartTime;
                    $ActivityListSort[$v['Id']]['ShowEndTime']        = $ShowEndTime;
                    $ActivityListSort[$v['Id']]['FatherID']           = $v['Id'];
                    $ActivityListSort[$v['Id']]['DataSon'][]          = $DataSon;
                    break;
            }
        }
        foreach ($ActivityListSort as $k=>$v){
            if(count($v['DataSon']) == count($v['IsCat']) && empty($v['DataStatus']) ){
                $ActivityListSort[$k]['IsCat'] = 2;
            }else{
                $ActivityListSort[$k]['IsCat'] = 1;
            }
        }

        //排序
        $ActivityListSort =  array_values($ActivityListSort);
        $column           =  array_column($ActivityListSort,'Sort');

        $StyleSort        =  array_column($ActivityListSort,'Style');

        array_multisort($column,SORT_ASC,$StyleSort,SORT_ASC,$ActivityListSort);
        $info = $ActivityListSort;
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
    //领取奖励
    public function ReceiveReward(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $result = 2001;
        $ComFun = D('ComFun');
        $LogLevel = 'INFO';
        $info   =  array();
        $msgArr[3001] = "网络错误，请稍后子再试！";
        $msgArr[3002] = "与游戏服务器断开，请稍后子再试！";
        $msgArr[3003] = "与游戏服务器断开，请稍后子再试！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[4007] = "活动ID丢失！";
        $msgArr[5002] = "活动不存在,或者已下架！";
        $msgArr[5003] = "活动类型值错误！";
        $msgArr[5004] = "奖励不存在！";
        $msgArr[7002] = "不满足领取条件！";
        $msgArr[7004] = "不满足领取条件！";
        $msgArr[7003] = "已经领取过！";
        $msgArr[7005] = "已经领取过！";
        $playerid       =      $DataInfo['playerid'];
        $ActivityId     =      $DataInfo['ActivityId'];
        $ActivityCenter =      D('ActivityCenter');

        if(empty($playerid)){
            $result = 4006;
            $LogLevel = 'NOTICE';
            goto response;
        }
        if(empty($ActivityId)){
            $result = 4007;
            $LogLevel = 'NOTICE';
            goto  response;
        }
        //查询活动信息
        $SingleActivityInfo = $ActivityCenter->SingleActivityInfo($ActivityId,$DataInfo['channel']);
        if(empty($SingleActivityInfo)){
            $result = 5002;
            $LogLevel = 'WARNING';
            goto response;
        }
        //判断活动类型
        $Style     = $SingleActivityInfo['Style'];
        $TypeCode  = $SingleActivityInfo['TypeCode'];
        $Schedule  = $SingleActivityInfo['Schedule'];
        switch ($Style){
            //炮倍
            case 1:
                $DoubleGunInfo = $ActivityCenter->DoubleGunInfo($playerid,$DataInfo['version'],strtotime($SingleActivityInfo['ShowStartTime']),strtotime($SingleActivityInfo['ShowEndTime']));
                if(!$DoubleGunInfo){
                    $result = 3004;
                    $LogLevel = 'WARNING';
                    goto response;
                }
                //查询领奖情况
                $DReceiveStatus  = $ActivityCenter->ReceiveStatus($playerid,$SingleActivityInfo['ShowStartTime'],$SingleActivityInfo['ShowEndTime']);
                if(empty($DoubleGunInfo[$SingleActivityInfo['Schedule']])){
                     $result = 7004;
                     $LogLevel = 'WARNING';
                     goto response;
                }

                $DReceiveStatusNum = $DReceiveStatus[$ActivityId]['Num']?$DReceiveStatus[$ActivityId]['Num']:0;

                if($DReceiveStatusNum > 0){
                     $result = 7005;
                     $LogLevel = 'CRITICAL';
                     goto response;
                }
                break;
            //捕鱼
            case 2:
                break;
             //累计充值
            case 3:
                $Time = strtotime(date('Y-m-d',time()));
                $StartTime      = date('Y-m-d H:i:s',$Time);
                $EndTime        = date('Y-m-d H:i:s',$Time+24*60*60);
                //查询领取奖励想
                    //查看充值
                    $UsersPay   =$ActivityCenter->UsersPay($playerid,$StartTime,$EndTime);
                    $UserPayPrice   = $UsersPay[0]['Price']?$UsersPay[0]['Price']:0;
                    if($UserPayPrice < $Schedule){
                        $LogLevel = 'NOTICE';
                        $result = 7002;
                        goto response;
                    }
                    //当天领奖情况
                    $ReceiveStatus  = $ActivityCenter->SameReceiveStatus($playerid);
                    $ReceiveNum     = $ReceiveStatus[$ActivityId]['Num'] ?$ReceiveStatus[$ActivityId]['Num']:0 ;
                    if($ReceiveNum >0 ){
                        $LogLevel = 'NOTICE';
                        $result = 7003;
                        goto response;
                    }

                break;
            default:
                $result = 5003;
                $LogLevel = 'WARNING';
                goto  response;
        }
        $GiveInfo = json_decode($SingleActivityInfo['GiveInfo'],true);
        if(!$GiveInfo || empty($GiveInfo)){
            $LogLevel = 'WARNING';
            $result = 5004;
            goto response;
        }
        $Success = array();
        //添加记录
        $Model = new Model();
        $Model->startTrans();
        $DataUsersLog = array(
            'playerid'  =>  $playerid,
            'TypeCode'  =>  $TypeCode,
            'Style'     =>  $Style,
            'ActSonId'  =>  $ActivityId,
            'VerSion'   =>  $DataInfo['version'],
            'Channel'   =>  $DataInfo['channel'],
        );
        $AddUsersLog  = $Model->table('log_users_activity')->add($DataUsersLog);
        $DataUsersGoodsLog = array();
        foreach ($GiveInfo as $k=>$v){
            $Success[$k]['Type']   =  $v['Type'];
            $Success[$k]['Code']   =  $v['Code'];
            $Success[$k]['Number'] =  $v['Number']*$v['GetNum'];
            $DataUsersGoodsLog[$k]['playerid']  = $playerid;
            $DataUsersGoodsLog[$k]['Code']      = $v['Code'];
            $DataUsersGoodsLog[$k]['Type']      = $v['Type'];
            $DataUsersGoodsLog[$k]['GoodsName'] = $v['GoodsName'];
            $DataUsersGoodsLog[$k]['GoodsID']   = $v['GoodsID'];
            $DataUsersGoodsLog[$k]['GetNum']    = $v['GetNum'];
            $DataUsersGoodsLog[$k]['Number']    = $v['Number'];
            $DataUsersGoodsLog[$k]['ActSonId']  = $ActivityId;
            $DataUsersGoodsLog[$k]['Style']     = $Style;
            $DataUsersGoodsLog[$k]['TypeCode']  = $TypeCode;
            $DataUsersGoodsLog[$k]['VerSion']   = $DataInfo['version'];
            $DataUsersGoodsLog[$k]['Channel']   = $DataInfo['channel'];

        }
        $AddUsersGoodsLog= $Model->table('log_users_activity_goods')->addAll($DataUsersGoodsLog);
        if(!$AddUsersLog || !$AddUsersGoodsLog){
                $LogLevel = 'CRITICAL';
                $Model->rollback();
                $result = 3001;
                goto response;
        }
        //添加奖励
        $UserGoodsAdd = $ActivityCenter->UserGoodsAdd($playerid,$DataInfo['version'],$Success);
        if(!$UserGoodsAdd){
            $Model->rollback();
            $LogLevel = 'CRITICAL';
            $result = 3002;
            goto response;
        }
        $Model->commit();

        $info = $Success;
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
    //抽奖
    public function Luckdraw(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $result = 2001;
        $ComFun = D('ComFun');
        $LogLevel = 'INFO';
        $info   =  array();
        $msgArr[3001] = "网络错误，请稍后子再试！";
        $msgArr[3002] = "与游戏服务器断开，请稍后子再试！";
        $msgArr[4006] = "用户信息不存在！";
        $msgArr[4007] = "活动ID丢失！";
        $msgArr[5002] = "活动不存在,或者已下架！";
        $msgArr[5003] = "活动类型值错误！";
        $msgArr[5004] = "奖励不存在！";
        $msgArr[5005] = "奖励不存在！";
        $msgArr[7002] = "不满足条件！";
        $msgArr[7003] = "已经领取过！";
        $playerid       =      $DataInfo['playerid'];
        $ActivityId     =      $DataInfo['ActivityId'];
        $ActivityCenter =      D('ActivityCenter');
        if(empty($playerid)){
            $result = 4006;
            $LogLevel = 'NOTICE';
            goto response;
        }
        if(empty($ActivityId)){
            $result = 4007;
            $LogLevel = 'NOTICE';
            goto  response;
        }
        //查询活动信息
        $SingleActivityInfo = $ActivityCenter->SingleActivityInfo($ActivityId,$DataInfo['channel']);
        if(empty($SingleActivityInfo)){
            $result = 5002;
            $LogLevel = 'ERROR';
            goto response;
        }
        //判断活动类型
        $Style     = $SingleActivityInfo['Style'];
        $TypeCode  = $SingleActivityInfo['TypeCode'];
        $Schedule  = $SingleActivityInfo['Schedule'];
        if($Style != 4){
            $result = 5003;
            $LogLevel = 'ERROR';
            goto  response;
        }
        //当天领奖情况
        $ReceiveStatus  = $ActivityCenter->ReceiveStatus($playerid,$SingleActivityInfo['ShowStartTime'],$SingleActivityInfo['ShowEndTime']);
        $ReceiveNum     = $ReceiveStatus[$ActivityId]['Num'] ?$ReceiveStatus[$ActivityId]['Num']:0 ;
        //查看充值
        $UsersPay   =$ActivityCenter->UsersPay($playerid,$SingleActivityInfo['ShowStartTime'],$SingleActivityInfo['ShowEndTime']);
        $UserPayPrice   = $UsersPay[0]['Price']?$UsersPay[0]['Price']:0;
        $LuckdrawInfoNum =  floor($UserPayPrice/$Schedule)-$ReceiveNum;
        if($LuckdrawInfoNum <= 0){
            $result = 7002;
            $LogLevel = 'NOTICE';
            goto response;
        }
        $GiveSort           =  array_values(json_decode($SingleActivityInfo['GiveInfo'],true));
        $column             =  array_column($GiveSort,'Sort');
        array_multisort($column,SORT_ASC,$GiveSort);
        //查询抽奖内容
        $LuckdrawInfo =  $GiveSort ;
        if(empty($LuckdrawInfo)){
            $result = 5004;
            $LogLevel = 'ERROR';
            goto response;
        }
        //抽奖
        $Index= $ActivityCenter->GetLuckDraw($LuckdrawInfo);
        $GetLuckDraw = $LuckdrawInfo[$Index];
        if(empty($GetLuckDraw)){
            $result = 5005;
            $LogLevel = 'ERROR';
            goto response;
        }
        $Model = new  Model();
        $Model->startTrans();
        //添加用户记录
        $DataUsersLog = array(
            'playerid'  =>  $playerid,
            'TypeCode'  =>  $TypeCode,
            'Style'     =>  $Style,
            'ActSonId'  =>  $ActivityId,
            'VerSion'   =>  $DataInfo['version'],
            'Channel'   =>  $DataInfo['channel'],
        );
        $AddUsersLog  = $Model->table('log_users_activity')->add($DataUsersLog);
        //添加物品记录
        $DataUsersGoodsLog = array(
            'playerid'  =>  $playerid,
            'Type'      =>  $GetLuckDraw['Type'],
            'Code'      =>  $GetLuckDraw['Code'],
            'GoodsName' =>  $GetLuckDraw['GoodsName'],
            'GetNum'    =>  $GetLuckDraw['GetNum'],
            'GoodsID'   =>  $GetLuckDraw['GoodsID'],
            'Number'    =>  $GetLuckDraw['Number'],
            'ActSonId'  =>  $ActivityId,
            'Style'     =>  $Style,
            'TypeCode'  =>  $TypeCode,
            'VerSion'   =>  $DataInfo['version'],
            'Channel'   =>  $DataInfo['channel'],
        );

        $GoodsData[0]['Type']       =   $GetLuckDraw['Type'];
        $GoodsData[0]['Code']       =   $GetLuckDraw['Code'];
        $GoodsData[0]['Number']     =   $GetLuckDraw['Number']*$GetLuckDraw['GetNum'];

        $AddUsersGoodsLog= $Model->table('log_users_activity_goods')->add($DataUsersGoodsLog);
        if(!$AddUsersLog || !$AddUsersGoodsLog){
            $Model->rollback();
            $LogLevel = 'CRITICAL';
            $result = 3001;
            goto response;
        }
        if($GetLuckDraw['Type']>3){
            //发送邮件
            $DataEmail = '亲爱的玩家:
            
           恭喜您在幸运转转乐中获得'.$GetLuckDraw['Name'].' X'.$GetLuckDraw['GoodsName'].'，请联系我们客服MM（游戏大厅左下角“鱼锚”处）进行领取。



                                      '.date('Y年m月d日',time()).'
                                      巨翼互动运营团队';
            $UserProto = $ActivityCenter->SenEmail($playerid,$DataInfo['version'],$DataEmail);
        }else{
            //添加物品
            $UserProto = $ActivityCenter->UserGoodsAdd($playerid,$DataInfo['version'],$GoodsData);
        }
        if(!$UserProto){
            $Model->rollback();
            $result = 3002;
            $LogLevel = 'CRITICAL';
            goto response;
        }else{
            $info['Index']  = $Index ;
            $info['Type']   = $GetLuckDraw['Type'] ;
            $info['Code']   = $GetLuckDraw['Code'] ;
            $info['ImgCode']   = $GetLuckDraw['ImgCode'] ;
            $info['Number'] = $GetLuckDraw['Number']*$GetLuckDraw['GetNum'] ;
            $Model->commit();
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
    public function CatSon(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $result = 2001;
        $ComFun = D('ComFun');
        $LogLevel = 'INFO';
        $info   =  array();
        $msgArr[3001] = "网络错误，请稍后子再试！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[4007] = "父级ID缺失！";
        $playerid       =      $DataInfo['playerid'];
        $FatherID       =      $DataInfo['FatherID'];
        if(empty($playerid)){
            $result = 4006;
            $LogLevel = 'NOTICE';
            goto response;
        }

        if(empty($FatherID)){
            $result = 4007;
            $LogLevel = 'NOTICE';
            goto response;
        }

        $ActivityCenter =      D('ActivityCenter');
        $catSonInfo = $ActivityCenter->catSonInfo($FatherID);
        foreach ($catSonInfo as $k=>$v){
            $catSonInfo[$k]['FatherID'] = $FatherID;
            $catSonInfo[$k]['playerid'] = $playerid;
        }
        $addDta = true;
        if(!empty($catSonInfo)){
            $addDta = M('log_cat_activity')
                      ->addAll($catSonInfo);
        }
        if(!$addDta){
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