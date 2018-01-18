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
        $page           =       $this->page;
        $num            =       $this->num;
        $platform       =       $this->platform;
        $channelid      =       $this->channelid;
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;

        $result = 2001;
        $info   =  array();
        $GoodsAll  = M('jy_goods_all as a')
            ->join('jy_channel_goods as b on a.Id = b.goodsID')
            ->where('b.adminUserID = '.$channelid.' and  a.Status in(1,3)  and   a.ShowType = 4 and a.IsDel = 1')
            ->field('a.Id,a.Name,a.CurrencyNum,a.Code,a.Type,a.GetNum,a.ImgCode,a.Describe')
            ->order('a.Sort asc')
            ->select();
        if(empty($GoodsAll)){
            //查询本公司的渠道商品
            $Mychannel = M('jy_channel_info')
                ->where('isown = 2')
                ->limit(($page-1)*$num,$num)
                        ->field('adminUserID')
                        ->find();
            if(empty($Mychannel['adminUserID'])){
                goto  response;
            }
            $GoodsAll  = M('jy_goods_all as a')
                ->join('jy_channel_goods as b on a.Id = b.goodsID')
                ->where('b.adminUserID = '.$channelid.' and  a.Status in(1,3)  and   a.ShowType = 4 and a.IsDel = 1')
                ->field('a.Id,a.Name,a.CurrencyNum,a.Code,a.ImgCode,a.Type,a.GetNum,a.Describe')
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