<?php
/****
*
**/
namespace Jy_admin\Controller;
use Think\Controller;
class UsersOrderController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数

        $search['FoundTime']                 =      I('param.FoundTime','','trim');        //下单时间
        $search['PlatformOrder']             =      I('param.PlatformOrder','','trim');    //平台订单号
        $search['playerid']                  =      I('param.playerid','','intval');         //用户ID
        $search['PayPassAgeWay']             =      I('param.PayPassAgeWay','','trim');    //支付通道
        $search['PayChannel']                =      I('param.PayChannel','','trim');       //支付渠道
        $search['PayType']                   =      I('param.PayType','','intval');        //支付类型
        $search['Platform']                  =      I('param.Platform','','intval');       //平台
        $search['Status']                    =      I('param.Status','','intval');         //状态
        $where = '1';

        if ($search['FoundTime'] != ''){
            $where .= ' and `FoundTime`<="'.$search['FoundTime'].'"';
        }
        if ($search['PlatformOrder'] != ''){
            $where .= ' and `PlatformOrder`<="'.$search['PlatformOrder'].'"';
        }
        if ($search['playerid'] != '' && $search['playerid'] != 0 ){
            $where .= ' and `playerid`='.$search['playerid'];
        }
        if ($search['PayPassAgeWay'] != ''){
            $where .= ' and `PayPassAgeWay`="'.$search['PayPassAgeWay'].'"';
        }
        if ($search['PayChannel'] != ''){
            $where .= ' and `PayChannel`="'.$search['PayChannel'].'"';
        }
        if ($search['PayType'] != '' && $search['PayType'] != 0 ){
            $where .= ' and `PayType`='.$search['PayType'];
        }
        if ($search['Platform'] != '' && $search['Platform'] != 0 ){
            $where .= ' and `Platform`='.$search['Platform'];
        }
        if ($search['Status'] != '' && $search['Status'] != 0 ){
            $where .= ' and `Status`='.$search['Status'];
        }
        $count  = M('jy_users_order_info')
            ->where($where)
            ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $info = M('jy_users_order_info')
            ->where($where)
            ->limit($page*$num,$num)
            ->field('Id,OrderName,playerid,UsersName,PlatformOrder,Status,Price,CallbackTime,FoundTime,PayChannel,Platform,PayPassAgeWay,PayType')
            ->select();

        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->display('index');
    }
    //物品列表
    public  function authority(){
        $obj = new \Common\Lib\func();
        $playerid = I('param.playerid',0,'intval');                 //用户ID
        $PlatformOrder = I('param.PlatformOrder','','trim');        //订单号
        if($playerid<=0 || $PlatformOrder == ''){
            $obj->showmessage('非法操作');
        }
        $catGoods = M('jy_users_order_goods')
                    ->where('playerid = '.$playerid.' and  PlatformOrder = '.$PlatformOrder)
                    ->field('GoodsName,GoodsCode,Price,IsGive,Number')
                    ->select();

        $this->assign('info',$catGoods);
        $this->display('authority');
    }

}