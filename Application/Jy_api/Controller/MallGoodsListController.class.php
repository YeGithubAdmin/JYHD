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
        $page           =       $this->page;
        $num            =       $this->num;
        $platform       =       $this->platform;
        $channelid      =       $this->channelid;
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;


        $msgArr[4006]  = '类别缺失。';
        $msgArr[4007]  = '展示方式缺失。';
        $msgArr[4008]  = '用户信息缺失！。';
        $msgArr[5001]  = '渠道信息错误。';


        $result = 2001;
        $info   =  array();


        $CateGory       =       $DataInfo['CateGory'];  //类别 1-金币 2-砖石 3-道具
        $ShowType       =       $DataInfo['ShowType'];  //展示方式 1-商城


        if(!isset($CateGory)){
            $result = 4006;
            goto  response;
        }

        if(!isset($ShowType)){
            $result = 4007;
            goto  response;
        }

        $playerid  = $DataInfo['playerid'];

        if(empty($playerid)){
            $result = 4008;
            goto response;
        }



        $GoodsAll  = M('jy_goods_all as a')
            ->join('jy_channel_goods as b on a.Id = b.goodsID')
            ->join('jy_users_order_goods as c on  c.GoodsId = a.Id and c.playerid = '.$playerid.' and  c.IsGive = 1','left')
            ->where('b.adminUserID = '.$channelid.' and  a.Status in(1,3)  and  a.CateGory = '.$CateGory.'  and  a.ShowType = '.$ShowType.' and a.IsDel = 1')
            ->field('a.Id,a.Name,a.CurrencyType,a.CurrencyNum,a.Code,a.Type,a.GetNum,a.ImgCode,a.Describe,if(c.GoodsId,0,a.Proportion) as Proportion')
            ->group('a.Id')
            ->order('a.Sort asc')
            ->select();

        if(empty($GoodsAll)){
            //查询本公司的渠道商品
            $Mychannel = M('jy_channel_info')
                ->where('isown = 2 and platform = '.$platform)
                        ->field('adminUserID')
                        ->find();
            if(empty($Mychannel['adminUserID'])){
                goto  response;
            }
            $GoodsAll  = M('jy_goods_all as a')
                ->join('jy_channel_goods as b on a.Id = b.goodsID')
                ->join('jy_users_order_goods as c on  c.GoodsId = a.Id and c.playerid = '.$playerid.' and  c.IsGive = 1','left')
                ->where('b.adminUserID = '.$Mychannel['adminUserID'].' and  a.Status in(1,3)  and  a.CateGory = '.$CateGory.'  and ShowType = '.$ShowType.' and IsDel = 1')
                ->field('a.Id,a.Name,a.CurrencyType,a.CurrencyNum,a.Code,a.ImgCode,a.Type,a.GetNum,a.Describe,if(c.GoodsId,0,a.Proportion)) as Proportion')
                ->group('a.Id')
                ->order('a.Sort asc')
                ->select();

        }
        $info = $GoodsAll;
        response:
            $response = array(
                'result' => $result,
                'msg' => $msgArr[$result],
                'sessionid'=>$DataInfo['sessionid'],
                'data' => $info,
            );
            $this->response($response,'json');
        ;
    }
}