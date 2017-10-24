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
        $time = strtotime(date('Y-m-d',time()));
        $StartTime = date("Y-m-d",$time);
        $EndTime   =  date("Y-m-d",$time+24*60*60);
        $search['datemin']                   =      I('param.datemin',$StartTime,'trim');        //下单时间
        $search['datemax']                   =      I('param.datemax',$StartTime,'trim');        //下单时间
        $search['PlatformOrder']             =      I('param.PlatformOrder','','trim');    //平台订单号
        $search['playerid']                  =      I('param.playerid','','intval');         //用户ID
        $search['PayPassAgeWay']             =      I('param.PayPassAgeWay','','trim');    //支付通道
        $search['PayPlatform']               =      I('param.PayPlatform',0,'intval');        //支付平台
        $search['Channel']                   =      I('param.Channel','','trim');        //渠道
        $search['Platform']                  =      I('param.Platform','','intval');       //平台
        $search['Status']                    =      I('param.Status','','intval');         //状态
        $where = '1';
        //查询渠道
        $ChannelFiled = array(
            'account',
            'name',
        );
        $Channel = M('jy_admin_users')
            ->where('channel = 2')
            ->field($ChannelFiled)
            ->select();
        //默认当天订单

        //支付渠道
        if ($search['Channel'] != ''){
            $where .= ' and `PayChannel`="'.$search['Channel'].'"';
        }
        //订单号
        if ($search['PlatformOrder'] != ''){
            $where .= ' and `PlatformOrder`="'.$search['PlatformOrder'].'"';
        }
        //用户ID
        if ($search['playerid'] != '' && $search['playerid'] != 0 ){
            $where .= ' and `playerid`='.$search['playerid'];
        }
        //支付平台
        if ($search['PayPlatform'] != '' && $search['PayPlatform'] != 0 ){
            $where .= ' and `PayPlatform`='.$search['PayPlatform'];
        }
        //平台
        if ($search['Platform'] != '' && $search['Platform'] != 0 ){
            $where .= ' and `Platform`='.$search['Platform'];
        }
        //支付状态
        if ($search['Status'] != '' && $search['Status'] != 0 ){
            $where .= ' and `Status`='.$search['Status'];
        }
        //起始时间
        if ($search['datemin'] != ''){
            $where .= ' and `FoundTime`>= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        //结束时间
        if ($search['datemax'] != ''){
            $datemax = date("Y-m-d H:i:s",strtotime($search['datemax'])+24*60*60) ;
            $where .= ' and `FoundTime` < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        $countFiled = array(
            'count(Id) as num',
            ' round(sum(Price),2) as Price',
        );
        $count  = M('jy_users_order_info')
            ->field($countFiled)
            ->where($where)
            ->select();
        $Page       = new \Common\Lib\Page($count[0]['num'],$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $infoField = array(
            'Id',
            'OrderName',
            'playerid',
            'UsersName',
            'PlatformOrder',
            'Status',
            'Price',
            'CallbackTime',
            'FoundTime',
            'PayChannel',
            'PayPlatform',
            'Platform',
            'PayPassAgeWay',
            'PayType'
        );
        $info = M('jy_users_order_info')
            ->where($where)
            ->limit($page*$num,$num)
            ->order('CallbackTime desc')
            ->field($infoField)
            ->select();
        $Price = !empty($count[0]['Price']) ? $count[0]['Price']:0.00;
        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->assign('Channel',$Channel);
        $this->assign('search',$search);
        $this->assign('Price',$Price);
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
            ->where('playerid = '.$playerid.' and  PlatformOrder = "'.$PlatformOrder.'"')
            ->field('GoodsName,GoodsCode,Price,IsGive,Number')
            ->select();
        $this->assign('info',$catGoods);

        $this->display('authority');
    }
}