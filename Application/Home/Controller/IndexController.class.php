<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $obj = new \Common\Lib\func();
        $xlsData = array(
            array('312'),
            array(321),
            array('321')
        );
        $xlsName  = "User";
        $xlsCell  = array(
            array('id','账号序列'),
            array('account','登录账户'),
            array('nickname','账户昵称')
        );

        $xlsCell = array(
            'GroupChannel'=>'渠道ID',
            'GroupChannel'=>'渠道名称',
            'GroupChannel'=>'报表日期',
            'GroupChannel'=>'新增用户',
            'GroupChannel'=>'注册ARPU',
            'GroupChannel'=>'活跃ARPU',
            'GroupChannel'=>'次日留存',
            'GroupChannel'=>'付费金额（老用户',
            'GroupChannel'=>'活跃用户',
            'GroupChannel'=>'付费转化',
            'GroupChannel'=>'付费用户（老用户）',
            'GroupChannel'=>'付费转化（老用户）',
            'GroupChannel'=>'订单数量',
            'GroupChannel'=>'2日留存',
            'GroupChannel'=>'3日留存',
        );


        $obj->exportExcel($xlsName,$xlsCell,$xlsData);
    }
}