<?php
/***
 * 兑换商城
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
class MallExchangeController extends ComController {
    public function index(){
        $channelid      =       $this->channelid;
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $result = 2001;
        $info   =  array();
        $ComFun = D('ComFun');
        $LogLevel = 'INFO';
        //渠道信息
        $ChannelInfo = $this->channeinfo;
        if($ChannelInfo['isown'] == 2){
            $Channel = $channelid;
        }else{
            if($ChannelInfo['IsCp'] == 1){
                $Channel = $channelid;
            }else{
                $CatChannelData  = M('jy_admin_users')->where('account = "'.$ChannelInfo['CpChannel'].'"')->field('id')->find();
                if(empty($CatChannelData)){
                    $result = 5002;
                    $LogLevel = 'NOTICE';
                    goto  response;

                }
                $Channel = $CatChannelData['id'];
            }
        }
        $GoodsAll  = M('jy_goods_all as a')
            ->join('jy_channel_goods as b on a.Id = b.goodsID')
            ->where('b.adminUserID = '.$Channel.' and  a.Status in(1,3)  and   a.ShowType = 4 and a.IsDel = 1')
            ->field('a.Id,a.Name,a.CurrencyNum,a.Code,a.Type,a.GetNum,a.ImgCode,a.Describe')
            ->order('a.Sort asc')
            ->select();

        $info = $GoodsAll;
        response:
            $response = array(
                'result' => $result,
                'msg' => $msgArr[$result],
                'sessionid'=>$DataInfo['sessionid'],
                'data' => $info,
            );
           $ComFun->SeasLog($response,$LogLevel);
            $this->response($response,'json');
        ;
    }
}