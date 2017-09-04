<?php
/****
*  支付信息
**/
namespace Jy_admin\Controller;
use Think\Controller;
class ThirdpayInfoController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数

        $search['PassAgeWay']       =      I('param.PassAgeWay','','trim');
        $search['Platform']         =      I('param.Platform','','intval');
        $search['Type']             =      I('param.Type','','intval');

        $where = 'IsDel = 1';
        if ($search['PassAgeWay'] != ''){
            $where .= ' and  `PassAgeWay`<="'.$search['PassAgeWay'].'"';
        }
        if ($search['Platform'] != '' &&  $search['Platform'] != 0){
            $where .= ' and  `Platform`>="'.$search['Platform'].'"';
        }
        if ($search['Type'] != '' && $search['Type'] != 0){
            $where .= ' and `Type`="'.$search['Type'].'"';
        }
        $count  = M('jy_thirdpay')->where($where)->count();
        $Page       = new \Common\Lib\Page($count,$num);        // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();                            // 分页显示输出
        $catThirdpay = M('jy_thirdpay')
            ->where($where)
            ->limit($page*$num,$num)
            ->order('Sort asc')
            ->field('Id,Name,PassAgeWay,Recommend,Sort,Describe,Support,Platform,Type,VersionStart,VersionEnd,DateTime')
            ->select();

        $this->assign('page',$show);
        $this->assign('info',$catThirdpay);
        $this->assign('search',$search);
        $this->display('index');

    }
    //支付宝添加
    public function  AlipayAdd(){
        $obj = new \Common\Lib\func();

        if(IS_POST){
            $Name               =   I('param.Name','','trim');          //支付名称
            $Type               =   1;                                  //支付类型   1-支付宝
            $PassAgeWay         =   I('param.PassAgeWay','','trim');    //支付通道
            $Platform           =   I('param.Platform',1,'intval');     //平台 1-苹果 2-安卓
            $Recommend          =   I('param.Recommend',1,'intval');    //是否推荐   1-否 2-是
            $Sort               =   I('param.Sort',0,'intval');         //排序
            $Describe           =   I('param.Describe','','trim');      //通道描述
            $Support            =   I('param.Support',1,'intval');      //是否支持所有版本 1-否 2-是
            $VersionStart       =   I('param.VersionStart','','trim');  //起始版本
            $VersionEnd         =   I('param.VersionEnd','','trim');    //结束版本

            if($Support == 2){
                $VersionStart = '';
                $VersionEnd = '';
            }

            $dataThirdpay = array(
                'Platform'      =>      $Platform,
                'Name'          =>      $Name,
                'Type'          =>      $Type,
                'PassAgeWay'    =>      $PassAgeWay,
                'Recommend'     =>      $Recommend,
                'Sort'          =>      $Sort,
                'Describe'      =>      $Describe,
                'Support'       =>      $Support,
                'VersionStart'  =>      $VersionStart,
                'VersionEnd'    =>      $VersionEnd,
            );


            $addThirdpay  = M('jy_thirdpay')
                ->add($dataThirdpay);

            if($addThirdpay){
                $obj->showmessage('添加成功','/jy_admin/ThirdpayInfo/index');
            }else{
                $obj->showmessage('添加失败');
            }
        }

        $this->display('AlipayAdd');

    }

    //微信添加
    public function WechatAdd(){
        $obj = new \Common\Lib\func();

        if(IS_POST){
            $Platform           =   I('param.Platform',1,'intval');     //平台 1-苹果 2-安卓
            $Name               =   I('param.Name','','trim');          //支付名称
            $Type               =   2;                                  //支付类型   2-微信
            $PassAgeWay         =   I('param.PassAgeWay','','trim');    //支付通道
            $Recommend          =   I('param.Recommend',1,'intval');    //是否推荐   1-否 2-是
            $Sort               =   I('param.Sort',0,'intval');         //排序
            $Describe           =   I('param.Describe','','trim');      //通道描述
            $Support            =   I('param.Support',1,'intval');      //是否支持所有版本 1-否 2-是
            $VersionStart       =   I('param.VersionStart','','trim');  //起始版本
            $VersionEnd         =   I('param.VersionEnd','','trim');    //结束版本

            if($Support == 2){
                $VersionStart = '';
                $VersionEnd = '';
            }

            $dataThirdpay = array(
                'Name'          =>      $Name,
                'Platform'      =>      $Platform,
                'Type'          =>      $Type,
                'PassAgeWay'    =>      $PassAgeWay,
                'Recommend'     =>      $Recommend,
                'Sort'          =>      $Sort,
                'Describe'      =>      $Describe,
                'Support'       =>      $Support,
                'VersionStart'  =>      $VersionStart,
                'VersionEnd'    =>      $VersionEnd,
            );

            $addThirdpay  = M('jy_thirdpay')
                ->add($dataThirdpay);

            if($addThirdpay){
                $obj->showmessage('添加成功','/jy_admin/ThirdpayInfo/index');
            }else{
                $obj->showmessage('添加失败');
            }
        }

        $this->display('WechatAdd');
    }
    //支付宝修改
    public function AlipayEdit(){
        $obj = new \Common\Lib\func();

        $id = I('param.Id',0,'intval');
        if($id<=0){
            $obj->showmessage('非法操作');
        }
        $catThirdpay = M('jy_thirdpay')
                        ->where('Id = '.$id)
                        ->field('Id,Name,PassAgeWay,Recommend,Platform,Sort,Describe,Support,VersionStart,VersionEnd')
                        ->find();
        if(IS_POST){
            $Name               =   I('param.Name','','trim');          //支付名称
            $Platform           =   I('param.Platform',1,'intval');     //平台 1-苹果 2-安卓
            $PassAgeWay         =   I('param.PassAgeWay','','trim');    //支付通道
            $Recommend          =   I('param.Recommend',1,'intval');    //是否推荐   1-否 2-是
            $Sort               =   I('param.Sort',0,'intval');         //排序
            $Describe           =   I('param.Describe','','trim');      //通道描述
            $Support            =   I('param.Support',1,'intval');      //是否支持所有版本 1-否 2-是
            $VersionStart       =   I('param.VersionStart','','trim');  //起始版本
            $VersionEnd         =   I('param.VersionEnd','','trim');    //结束版本

            if($Support == 2){
                $VersionStart = '';
                $VersionEnd = '';
            }
            $dataThirdpay = array(
                'Name'          =>      $Name,
                'Platform'      =>      $Platform,
                'PassAgeWay'    =>      $PassAgeWay,
                'Recommend'     =>      $Recommend,
                'Sort'          =>      $Sort,
                'Describe'      =>      $Describe,
                'Support'       =>      $Support,
                'VersionStart'  =>      $VersionStart,
                'VersionEnd'    =>      $VersionEnd,
            );
            $upThirdpay  = M('jy_thirdpay')
                ->where('Id = '.$id)
                ->save($dataThirdpay);

            if($upThirdpay){
                $obj->showmessage('修改成功','/jy_admin/ThirdpayInfo/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }
        $this->assign('info',$catThirdpay);
        $this->display('AlipayEdit');
    }


    //微信修改
    public function WechatEdit(){
        $obj = new \Common\Lib\func();

        $id = I('param.Id',0,'intval');
        if($id<=0){
            $obj->showmessage('非法操作');
        }
        $catThirdpay = M('jy_thirdpay')
            ->where('Id = '.$id)
            ->field('Name,PassAgeWay,Recommend,Platform,Sort,Describe,Support,VersionStart,VersionEnd')
            ->find();


        if(IS_POST){
            $Name               =   I('param.Name','','trim');          //支付名称
            $PassAgeWay         =   I('param.PassAgeWay','','trim');    //支付通道
            $Platform           =   I('param.Platform',1,'intval');     //平台 1-苹果 2-安卓
            $Recommend          =   I('param.Recommend',1,'intval');    //是否推荐   1-否 2-是
            $Sort               =   I('param.Sort',0,'intval');         //排序
            $Describe           =   I('param.Describe','','trim');      //通道描述
            $Support            =   I('param.Support',1,'intval');      //是否支持所有版本 1-否 2-是
            $VersionStart       =   I('param.VersionStart','','trim');  //起始版本
            $VersionEnd         =   I('param.VersionEnd','','trim');    //结束版本
            if($Support == 2){
                $VersionStart = '';
                $VersionEnd = '';
            }
            $dataThirdpay = array(
                'Name'          =>      $Name,
                'PassAgeWay'    =>      $PassAgeWay,
                'Platform'      =>      $Platform,
                'Recommend'     =>      $Recommend,
                'Sort'          =>      $Sort,
                'Describe'      =>      $Describe,
                'Support'       =>      $Support,
                'VersionStart'  =>      $VersionStart,
                'VersionEnd'    =>      $VersionEnd,
            );
            $upThirdpay  = M('jy_thirdpay')
                ->where('Id = '.$id)
                ->save($dataThirdpay);

            if($upThirdpay){
                $obj->showmessage('修改成功','/jy_admin/ThirdpayInfo/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }

        $this->assign('info',$catThirdpay);
        $this->display('WechatEdit');
    }

    //删除
    public function  del(){
        $id = I('param.Id',0,'intval');
        if($id == 0){
            echo  0;
        }else{
            $db = M('jy_thirdpay');
            $dataThirdpay['IsDel']  =2;
            $info = $db
                ->where('Id = '.$id)
                ->save($dataThirdpay);
            if($info){
                echo 1;
            }else{
                echo 0;
            }
        }
        exit();
    }


}