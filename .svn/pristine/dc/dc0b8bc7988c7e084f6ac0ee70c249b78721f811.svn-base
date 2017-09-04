<?php
/****
*  七天签到
**/
namespace Jy_admin\Controller;
use Think\Controller;
class SevenDaysSignController extends ComController {
    public function index(){

        $CatSevenDaysSign = M('jy_seven_days_sign')
            ->field('Id,DayName,RewardName,Day,Code,DateTime')
            ->where('IsExceed = 1')
            ->order('Day asc')
            ->select();

        $this->assign('info',$CatSevenDaysSign);
        $this->display('index');

    }
    //添加
    public function  add(){
        $obj = new \Common\Lib\func();

        if(IS_POST){
            //数据

            $DayName            =   I('param.DayName','','trim');
            $RewardName         =   I('param.RewardName','','trim');
            $Day                =   I('param.Day','','trim');
            $Code               =   I('param.Code','','trim');

            $dataSevenDaysSign  = array(
                'DayName'         =>       $DayName,
                'RewardName'      =>       $RewardName,
                'Day'             =>       $Day,
                'IsExceed'             =>       1,
                'Code'            =>       $Code,
            );

            //添加
            $addSevenDaysSign = M('jy_seven_days_sign')
                            ->add($dataSevenDaysSign);
            if($addSevenDaysSign){
                $obj->showmessage('添加成功','/jy_admin/SevenDaysSign/index');
            }else{
                 $obj->showmessage('添加失败');
            }
        }

        $this->display('add');
    }
    //修改
    public function edit(){
        $obj = new \Common\Lib\func();

        $id = I('param.id',0,'intval');
        if($id<=0){
            $obj->showmessage('非法操作');
        }




        //管理员信息
        $CatSevenDaysSign = M('jy_seven_days_sign')
                          ->where('Id = '.$id)
                          ->field('Id,DayName,RewardName,Day,Code')
                          ->find();


        if(IS_POST){
            //数据

            $DayName            =   I('param.DayName','','trim');
            $RewardName         =   I('param.RewardName','','trim');
            $Day                =   I('param.Day','','trim');
            $Code               =   I('param.Code','','trim');

            $dataSevenDaysSign  = array(
                'DayName'         =>       $DayName,
                'RewardName'      =>       $RewardName,
                'Day'             =>       $Day,
                'Code'            =>       $Code,
            );

            //修改
            $upSevenDaysSign = M('jy_seven_days_sign')
                ->where('Id = '.$id)
                ->save($dataSevenDaysSign);
            if($upSevenDaysSign !== false){
                $obj->showmessage('修改成功','/jy_admin/SevenDaysSign/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }


        $this->assign('info',$CatSevenDaysSign);
        $this->display('edit');
    }


    //删除
    public function  del(){
        $id = I('param.id',0,'intval');

        if($id == 0){
            echo  0;
        }else{
            $db = M('jy_seven_days_sign');

            $info = $db
                ->where('id = '.$id)
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