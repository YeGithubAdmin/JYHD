<?php
/****
 *  七天签到 28天好后
 **/
namespace Jy_admin\Controller;
use Think\Controller;
class SevenDaysSignRewardController extends ComController {
    public function index(){
        $CatSevenDaysSignField = array(
            'a.Id',
            'a.Day',
            'a.ImgCode',
            'a.DateTime',
            'b.Name',
            'a.Number',
        );
        $CatSevenDaysSign = M('jy_seven_days_sign as a')
            ->join('jy_goods_all as b on a.GoodsID = b.Id','left')
            ->field($CatSevenDaysSignField)
            ->where('a.IsExceed = 2')
            ->order('a.Day asc')
            ->select();
        $this->assign('info',$CatSevenDaysSign);
        $this->display('index');

    }
    //添加
    public function  add(){
        $obj = new \Common\Lib\func();
        //所有物品信息
        $CatGoodsAllField = array(
            'Id',
            'Name',
            'Type',
        );
        $CatGoodsAll = M('jy_goods_all')
            ->where('IsDel = 1')
            ->field($CatGoodsAllField)
            ->select();
        if(IS_POST){
            //数据
            $ImgCode            =   I('param.ImgCode','','trim');
            $GoodsID            =   I('param.GoodsID',0,'intval');
            $Day                =   I('param.Day',0,'intval');
            $Number             =   I('param.Number',0,'intval');
            $Type               =   I('param.Type',0,'intval');
            $dataSevenDaysSign  = array(
                'ImgCode'        =>       $ImgCode,
                'GoodsID'        =>       $GoodsID,
                'IsExceed'       =>       2,
                'Day'            =>       $Day,
                'Number'         =>       $Number,
                'Type'           =>       $Type,
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
        $this->assign('CatGoodsAll',$CatGoodsAll);
        $this->display('add');
    }
    //修改
    public function edit(){
        $obj = new \Common\Lib\func();
        $id = I('param.id',0,'intval');
        if($id<=0){
            $obj->showmessage('非法操作');
        }
        //所有物品信息
        $CatGoodsAllField = array(
            'Id',
            'Name',
            'Type',
        );
        $CatGoodsAll = M('jy_goods_all')
            ->where('IsDel = 1')
            ->field($CatGoodsAllField)
            ->select();

        //签到信息
        $CatSevenDaysSignField = array(
            'Id',
            'Day',
            'ImgCode',
            'Type',
            'GoodsID',
            'Number',
        );
        $CatSevenDaysSign = M('jy_seven_days_sign')
            ->where('Id = '.$id)
            ->field($CatSevenDaysSignField)
            ->find();
        if(IS_POST){
            //数据
            $ImgCode            =   I('param.ImgCode','','trim');
            $GoodsID            =   I('param.GoodsID',0,'intval');
            $Day                =   I('param.Day',0,'intval');
            $Number             =   I('param.Number',0,'intval');
            $Type               =   I('param.Type',0,'intval');
            $dataSevenDaysSign  = array(
                'ImgCode'        =>       $ImgCode,
                'GoodsID'        =>       $GoodsID,
                'Day'            =>       $Day,
                'Number'         =>       $Number,
                'Type'           =>       $Type,
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
        $this->assign('CatGoodsAll',$CatGoodsAll);
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