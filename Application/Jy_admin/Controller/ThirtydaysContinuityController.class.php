<?php
/****
*  连续签到
**/
namespace Jy_admin\Controller;
use Think\Controller;
class ThirtydaysContinuityController extends ComController {
    public function index(){

        $CatSevenDaysSignField = array(
            'Id',
            ' continuity as Day',
            'ImgCode',
            'DateTime',
        );
        $CatSevenDaysSign = M('conf_thirtyday_continuity')
            ->field($CatSevenDaysSignField)
            ->order('continuity asc')
            ->select();
        $this->assign('info',$CatSevenDaysSign);

        $this->display('index');
    }
    //添加
    public function  add(){
        $obj = new \Common\Lib\func();
        $Status = I('param.Status',1,'intval');
        //所有物品信息
        if(IS_POST){
            //数据
            $ImgCode             =   I('param.ImgCode','','trim');
            $Name                =   I('param.Name','','trim');
            $continuity                =   I('param.continuity',0,'intval');
            $dataSevenDaysSign   = array(
                'ImgCode'       =>       $ImgCode,
                'Name'          =>       $Name,
                'Continuity'    =>       $continuity,

            );
            //添加
            $addSevenDaysSign = M('conf_thirtyday_continuity')
                ->add($dataSevenDaysSign);
            if($addSevenDaysSign){
                $obj->showmessage('添加成功','/jy_admin/ThirtydaysContinuity/index');
            }else{
                $obj->showmessage('添加失败');
            }
        }
        $this->assign('Status',$Status);
        $this->display('add');
    }
    //修改
    public function edit(){
        $obj = new \Common\Lib\func();
        $id = I('param.Id',0,'intval');
        if($id<=0){
            $obj->showmessage('非法操作');
        }
        $CatInfo = M('conf_thirtyday_continuity')
            ->where('Id = '.$id)
            ->field(array(
                'Id',
                'ImgCode',
                'Name',
                'Continuity',
            ))
            ->find();
        if(IS_POST){
            //数据
            //数据
            $ImgCode             =   I('param.ImgCode','','trim');
            $Name                =   I('param.Name',0,'intval');
            $dataSevenDaysSign   = array(
                'ImgCode'        =>       $ImgCode,
                'Name'           =>       $Name,
            );
            //修改
            $upSevenDaysSign = M('conf_thirtyday_continuity')
                ->where('Id = '.$id)
                ->save($dataSevenDaysSign);
            if($upSevenDaysSign !== false){
                $obj->showmessage('修改成功','/jy_admin/ThirtyDaysSign/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }
        $this->assign('info',$CatInfo);
        $this->display('edit');
    }


    //删除
    public function  del(){
        $id = I('param.Id',0,'intval');
        if($id == 0){
            echo  0;
        }else{
            $db = M('conf_thirtyday_continuity');
            $info = $db
                ->where('Id = '.$id)
                ->delete();
            if($info){
                echo 1;
            }else{
                echo 0;
            }
        }
        exit();
    }
    //验证用户是否存在
    public function Verification(){
        $Day =  I('param.Day','','trim');
        $id = I('param.id',0,'intval');
        if($Day == ''){
            echo 0;
            exit();
        }
        $CatsevenDaysSign = M('jy_seven_days_sign')
            ->where('Day = '.$Day.' and IsExceed = 1')
            ->field('Id')
            ->find();
        if(empty($CatsevenDaysSign)){
            echo 1;
            exit();
        }else if ($id == $CatsevenDaysSign['Id']){
            echo 1;
            exit();
        }else{
            echo 2;
            exit();
        }

    }

}