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
class NoticeController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $result = 2001;
        $info   =  array();
        $dateTime =date('Y-m-d H:i:s',time());
        $catGameNoticeField = array(
            'TitleSon',
            'Content',
            'Title',
        );
        $ChannelID =  $this->channelid;
        $catGameNotice = M('jy_game_notice')
                         ->where(' Channel = '.$ChannelID.'  and Status = 2 and Btime > str_to_date("'.$dateTime.'","%Y-%m-%d %H:%i:%s") or  Channel = 0  and Status = 2 and Btime > str_to_date("'.$dateTime.'","%Y-%m-%d %H:%i:%s")')
                         ->field($catGameNoticeField)
                         ->order('Sort desc','Num asc')
                         ->limit(0,10)
                         ->select();
        $info =  $catGameNotice;
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