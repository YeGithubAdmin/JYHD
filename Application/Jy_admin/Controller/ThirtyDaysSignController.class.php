<?php
/****
*  30天签到 4-6月
**/
namespace Jy_admin\Controller;
use Think\Controller;
class ThirtyDaysSignController extends ComController {
    public function index(){
        $Status = I('param.Status',1,'intval');
        $CatSevenDaysSignField = array(
            'Id',
            'Day',
            'ImgCode',
            'DateTime',
        );
        $CatSevenDaysSign = M('conf_thirtyday_sign')
            ->field($CatSevenDaysSignField)
            ->where('Status = '.$Status)
            ->order('Day asc')
            ->select();
        $this->assign('info',$CatSevenDaysSign);
        $this->assign('Status',$Status);
        $this->display('index');
    }
    //添加
    public function  add(){
        $obj = new \Common\Lib\func();
        $Status = I('param.Status',1,'intval');
        //所有物品信息
        if(IS_POST){
            //数据
            $ImgCode            =   I('param.ImgCode','','trim');
            $Day                =   I('param.Day',0,'intval');
            $Color                =   I('param.Color','','trim');
            $ShortTitle                =   I('param.ShortTitle','','trim');
            $LongTitle                =   I('param.LongTitle','','trim');
            $dataSevenDaysSign  = array(
                'ImgCode'        =>       $ImgCode,
                'Status'         =>      $Status,
                'Day'            =>       $Day,
                'ShortTitle'     =>       $ShortTitle,
                'Color'     =>       $Color,
                'LongTitle'      =>       $LongTitle,
            );
            //添加
            $addSevenDaysSign = M('conf_thirtyday_sign')
                ->add($dataSevenDaysSign);
            if($addSevenDaysSign){
                $obj->showmessage('添加成功','/jy_admin/ThirtyDaysSignThree/index');
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
        $CatInfo = M('conf_thirtyday_sign')
            ->where('Id = '.$id)
            ->field(array(
                'Id',
                'ImgCode',
                'Day',
                'Color',
                'Status',
                'ShortTitle',
                'LongTitle',
            ))
            ->find();

        if(empty($CatInfo)){
            $obj->showmessage('非法操作');
        }


        $CatSevenDaysSignField = array(
            'a.Id',
            'a.Name as Title',
            'b.Name',
            'a.Number',
            'a.DateTime',
        );

        $CatSevenDaysSign = M('conf_thirtyday_goods as a')
            ->join('jy_goods_all as b on b.Id = a.GoodsID')
            ->field($CatSevenDaysSignField)
            ->where('a.Status = '.$CatInfo['Status'].' and a.Day = '.$CatInfo['Day'])
            ->select();

        if(IS_POST){
            //数据
            $ImgCode            =   I('param.ImgCode','','trim');

            $Color                =   I('param.Color','','trim');
            $ShortTitle                =   I('param.ShortTitle','','trim');
            $LongTitle                =   I('param.LongTitle','','trim');
            $dataSevenDaysSign  = array(
                'ImgCode'        =>       $ImgCode,
                'ShortTitle'     =>       $ShortTitle,
                'Color'     =>       $Color,
                'LongTitle'      =>       $LongTitle,
            );
            //修改
            $upSevenDaysSign = M('conf_thirtyday_sign')
                ->where('Id = '.$id)
                ->save($dataSevenDaysSign);
            if($upSevenDaysSign !== false){
                $obj->showmessage('修改成功','/jy_admin/ThirtyDaysSign/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }

        $this->assign('info',$CatInfo);
        $this->assign('GoodsInfo',$CatSevenDaysSign);
        $this->display('edit');
    }


    //删除
    public function  del(){
        $id = I('param.Id',0,'intval');
        if($id == 0){
            echo  0;
        }else{
            $db = M('conf_thirtyday_sign');
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