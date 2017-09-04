<?php
/****
*   活动列表
**/
namespace Jy_admin\Controller;
use Think\Controller;
class ActivityListController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $where = 1;
        $count  = M('jy_activity_father_list')
            ->where($where)
            ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出

        $activityFatherlistFile = array(
            'Id',
            'Type',
            'Title',
            'Code',
            'AddUpStartTime',
            'AddUpEndTime',
            'ShowStartTime',
            'ShowEndTime',
            'Describe',
        );
        $info = M('jy_activity_father_list')
            ->where($where)
            ->limit($page*$num,$num)
            ->field($activityFatherlistFile)
            ->select();

        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->display('index');
    }
    //添加
    public  function add(){
        $obj = new \Common\Lib\func();
        if(IS_POST){
            $Type                   =       I('param.Type',1,'intval');                 //活动类型  1-累计充值 2-单笔充值   3-循环充值    4-图片类型
            $Title                  =       I('param.Title','','trim');                //标题
            $Code                   =       I('param.Code','','trim');                 //活动标识
            $AddUpStartTime         =       I('param.AddUpStartTime','','trim');       //计费开始时间
            $AddUpEndTime           =       I('param.AddUpEndTime','','trim');         //计费结束时间
            $ShowStartTime          =       I('param.ShowStartTime','','trim');        //显示开始时间
            $ShowEndTime            =       I('param.ShowEndTime','','trim');          //显示结束时间
            $Describe               =       I('param.Describe ','','trim');
            $dataActivityFatherList = array(
                'Type'              =>      $Type,
                'Title'             =>      $Title,
                'Code'              =>      $Code,
                'AddUpStartTime'    =>      $AddUpStartTime,
                'AddUpEndTime'      =>      $AddUpEndTime,
                'ShowStartTime'     =>      $ShowStartTime,
                'ShowEndTime'       =>      $ShowEndTime,
                'Describe'          =>      $Describe,
            );
            $addActivityFatherList = M('jy_activity_father_list')
                ->add($dataActivityFatherList);
            if($addActivityFatherList){
                $obj->showmessage('添加成功','/jy_admin/ActivityList/index');
            }else{
                $obj->showmessage('添加失败');
            }
        }

        $this->display('add');
    }
    //修改
    public function edit(){
        $obj = new \Common\Lib\func();
        $Id = I('param.Id',0,'intval');
        if ($Id<=0){
            $obj->showmessage('非法操作');
        }

        //查询信息

        $ActivityFatherListField = array(
            'Id',
            'Type',
            'Code',
            'Title',
            'AddUpStartTime',
            'AddUpEndTime',
            'ShowStartTime',
            'ShowEndTime',
            'Describe',
        );

        $ActivityFatherList = M('jy_activity_father_list')
                              ->where('Id = '.$Id)
                              ->field($ActivityFatherListField)
                              ->find();
        if(IS_POST){
            $Type                   =       I('param.Type',1,'intval');                 //活动类型  1-累计充值 2-单笔充值   3-循环充值    4-图片类型
            $Title                  =       I('param.Title','','trim');                //标题
            $Code                   =       I('param.Code','','trim');                 //活动标识
            $AddUpStartTime         =       I('param.AddUpStartTime','','trim');       //计费开始时间
            $AddUpEndTime           =       I('param.AddUpEndTime','','trim');         //计费结束时间
            $ShowStartTime          =       I('param.ShowStartTime','','trim');        //显示开始时间
            $ShowEndTime            =       I('param.ShowEndTime','','trim');          //显示结束时间
            $Describe               =       I('param.Describe','','trim');            //描述
            $dataActivityFatherList = array(
                'Title'             =>      $Title,
                'Code'              =>      $Code,
                'AddUpStartTime'    =>      $AddUpStartTime,
                'AddUpEndTime'      =>      $AddUpEndTime,
                'ShowStartTime'     =>      $ShowStartTime,
                'ShowEndTime'       =>      $ShowEndTime,
                'Describe'          =>      $Describe,
            );
            $addActivityFatherList = M('jy_activity_father_list')
                ->where('Id = '.$Id)
                ->save($dataActivityFatherList);
            if($addActivityFatherList !== false ){
                $obj->showmessage('修改成功','/jy_admin/ActivityList/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }
        $this->assign('info',$ActivityFatherList);
        $this->display('edit');
    }
    //删除
    public function del(){
        $Id = I('param.Id',0,'intval');
        if($Id == 0){
            echo  0;
        }else{
            $db = M('jy_activity_father_list');
            $info = $db
                ->where('id = '.$Id)
                ->delete();
            if($info){
                echo 1;
            }else{
                echo 0;
            }
        }
        exit();
    }

    //验证类型爱过是否存在
    public function Verification(){
        $Type =  I('param.Type',0,'intval');
        if($Type == ''){
            echo 0;
            exit();
        }

        $activityFatherList = M('jy_activity_father_list')
            ->where('Type = "'.$Type.'"')
            ->field('id')
            ->find();
        if(empty($activityFatherList)){
            echo 1;
            exit();
        }else{
            echo 2;
            exit();
        }

    }

}