<?php
/***
 * 客服
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
class FeedBackController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $msgArr[2001] = "请求成功";
        $msgArr[3001] = "网络错误";
        $msgArr[4006] = "用户信息缺失！";
        $result = 2001;
        $info = array();
        //用户ID
        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto  response;
        }
        //查询时间
        $time        = time();
        $DayNum      = 24*60*60;
        $DayTime     = strtotime(date('Y-m-d'),$time);
        $StartTime   = date('Y-m-d H:i:s',$DayTime-15*$DayNum);
        $EndTime     = date('Y-m-d H:i:s',$DayTime+$DayNum);

        $LogFeedBack = D('LogFeedBack');
        //反馈记录
        $Field = array(
            'Id',
            'Fcontent',
            'Rcontent',
            'Type',
            'Read',
            'Status',
            'DateTime',
        );
        $where = 'playerid = '.$playerid.' and  DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  
                 and  DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s") and IsDel = 1';
        $CatFeedBack =  $LogFeedBack->Info($Field,$where);
        foreach ($CatFeedBack as $k=>$v){
             $strtotime= strtotime($v['DateTime']);
             $CatFeedBack[$k]['DateTime'] =$LogFeedBack->TimeAgo($strtotime);
        }

        $info = $CatFeedBack;
        response:
            $response = array(
                'result' => $result,
                'msg' => $msgArr[$result],
                'sessionid'=>$DataInfo['sessionid'],
                'data' => $info,
            );
            $this->response($response,'json');
    }
    //提交问题
    public  function Submit(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $LogFeedBack    =       D('LogFeedBack');
        $msgArr[2001]   = "请求成功";
        $msgArr[3001]   = "网络错误,请稍后在试！";
        $msgArr[4006]   = "用户信息缺失！";
        $msgArr[4007]   = "内容缺失！";
        $msgArr[4008]   = "问题类型缺失！";
        $msgArr[4009]   = "请填写一个或者以上的联系方式！";
        $msgArr[7001]   = "内容长度不符合！";
        $msgArr[7003]   = "超过提交次数提交次数，一个小时内最多提交6次！";
        $result = 2001;
        $info = array();
        //用户ID
        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto  response;
        }
        //内容
        $Fcontent = $DataInfo['Fcontent'];
        if(empty($Fcontent)){
            $result = 4007;
            goto  response;
        }
        //问题类型
        $Type     =  $DataInfo['Type'];
        if(empty($Type)){
            $result = 4008;
            goto  response;
        }
        //电话 或  QQ
        $Phone = $DataInfo['Phone'];
        $TxQq  = $DataInfo['TxQq'];
        if(empty($Phone) && empty($TxQq)){
            $result = 4009;
            goto  response;
        }
        //判断字符
        $Lenth = strlen($Fcontent);
        if($Lenth >200){
            $result = 7001;
            goto response;
        }
        //是否超过条数
        //查询时间

//        $CatCunt =  $LogFeedBack->CatCount($playerid);
//        if(!$CatCunt){
//            $result = 7002;
//            goto response;
//        }
        //是否超过次数
        $SendCount = $LogFeedBack->SendCount($playerid);
        if(!$SendCount){
            $result = 7003;
            goto response;
        }
        //过滤敏感
        $Fcontent = $LogFeedBack->SensitiveWords($Fcontent);
        $DateAdd = array(
            'playerid'       =>    $playerid,
            'Status'         =>    1,
            'Fcontent'       =>    $Fcontent,
            'Rcontent'       =>    '',
            'Type'           =>    $Type,
            'Phone'          =>    $Phone,
            'TxQq'           =>    $TxQq,
            'PackageVersion' =>    $DataInfo['PackageVersion'],
            'Channel'        =>    $DataInfo['channel'],
            'VerSion'        =>    $DataInfo['version'],
        );
        $AddDate =$LogFeedBack->AddDate($DateAdd);

        if(!$AddDate){
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
        $this->response($response,'json');
    }

    //阅读
    public function Read(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $msgArr[2001]   = "请求成功";
        $msgArr[3001]   = "网络错误,请稍后在试！";
        $msgArr[4006]   = "用户信息缺失！";
        $msgArr[4007]   = "Id缺失！";
        $result = 2001;
        $info = array();
        //用户ID
        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result = 4006;
            goto  response;
        }

        $Id = $DataInfo['Id'];
        if(empty($Id)){
            $result = 4006;
            goto  response;
        }
        $dataUp = array(
            'Read'       =>    2,
        );
        $UpDate =M('log_feed_back')
                 ->where('Id ='.$Id)
                 ->save($dataUp);

        if($UpDate === false){
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
        $this->response($response,'json');
    }
}