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
            array(
                '账号序列',
                '登录账户',
                '账户昵称',
            ),
            array(
                '账号序列',
                '登录账户',
                '账户昵称',
            ),
        array(
            '账号序列',
            '登录账户',
            '账户昵称',
        ),

        );
//        $xlsCell = array(
//            'GroupChannel'=>'渠道ID',
//            'GroupChannel'=>'渠道名称',
//            'GroupChannel'=>'报表日期',
//            'GroupChannel'=>'新增用户',
//            'GroupChannel'=>'注册ARPU',
//            'GroupChannel'=>'活跃ARPU',
//            'GroupChannel'=>'次日留存',
//            'GroupChannel'=>'付费金额（老用户',
//            'GroupChannel'=>'活跃用户',
//            'GroupChannel'=>'付费转化',
//            'GroupChannel'=>'付费用户（老用户）',
//            'GroupChannel'=>'付费转化（老用户）',
//            'GroupChannel'=>'订单数量',
//            'GroupChannel'=>'2日留存',
//            'GroupChannel'=>'3日留存',
//        );

        $dataResult = array();
        $headTitle = "XX保险公司 优惠券赠送记录";
        $title = "优惠券记录";
        $headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>";
        $titlename = "<tr> 
               <th style='width:70px;' >合作商户</th> 
               <th style='width:70px;' >会员卡号</th> 
               <th style='width:70px;'>车主姓名</th> 
               <th style='width:150px;'>手机号</th> 
               <th style='width:70px;'>车牌号</th> 
               <th style='width:100px;'>优惠券类型</th> 
               <th style='width:70px;'>优惠券名称</th> 
               <th style='width:70px;'>优惠券面值</th> 
               <th style='width:70px;'>优惠券数量</th> 
               <th style='width:70px;'>赠送时间</th> 
               <th style='width:90px;'>截至有效期</th> 
           </tr>";
        $filename = $title.".xls";

        $obj->excelData($titlename,$titlename,$headtitle,$filename);
//        $obj->exportExcel($xlsName,$xlsCell,$xlsData);
    }
}