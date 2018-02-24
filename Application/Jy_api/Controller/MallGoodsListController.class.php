<?php
/***
 * 商品
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
class MallGoodsListController extends ComController {
    public function index(){

        $channelid      =       $this->channelid;
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $msgArr[4006]  = '类别缺失。';
        $msgArr[4007]  = '展示方式缺失。';
        $msgArr[4008]  = '用户信息缺失！。';
        $msgArr[5001]  = '渠道信息错误。';
        $result = 2001;
        $info   =  array();
        $ComFun = D('ComFun');
        $LogLevel = 'INFO';
        $CateGory       =       $DataInfo['CateGory'];  //类别 1-金币 2-砖石 3-道具
        $ShowType       =       $DataInfo['ShowType'];  //展示方式 1-商城
        if(!isset($CateGory)){
            $result = 4006;
            $LogLevel = 'NOTICE';
            goto  response;
        }
        if(!isset($ShowType)){
            $result = 4007;
            $LogLevel = 'NOTICE';
            goto  response;
        }

        $playerid  = $DataInfo['playerid'];

        if(empty($playerid)){
            $result = 4008;
            $LogLevel = 'NOTICE';
            goto response;
        }
        $GoodsAllField = array(
            'a.Id',
            'a.Name',
            'a.CurrencyType',
            'a.CurrencyNum',
            'a.Code',
            'a.Type',
            'a.GetNum',
            'a.ImgCode',
            'a.Describe',
            'a.Proportion',

        );





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
            ->where('b.adminUserID = '.$Channel.' and  a.Status in(1,3)  and  a.CateGory = '.$CateGory.'  
                      and  a.ShowType = '.$ShowType.' and a.IsDel = 1')
            ->field($GoodsAllField)
            ->group('a.Id')
            ->order('a.Sort asc')
            ->select();

        //过滤首次充值
        $MoreThan = $playerid%10;
        $ShopLogField = array(
            'GoodsID',
        );
        $ShopLog = M('log_users_shop_'.$MoreThan)
                   ->field($ShopLogField)
                   ->where('playerid = '.$playerid)
                   ->select();
        $ShopLogSort = array();
        foreach ($ShopLog as $k=>$v) $ShopLogSort[$v['GoodsID']] = $v;
        if(!empty($GoodsAll)){
            foreach ($GoodsAll as $k=>$v){
                if($ShopLogSort[$v['Id']]){
                    $GoodsAll[$k]['Proportion'] = 0;
                }
            }
        }

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