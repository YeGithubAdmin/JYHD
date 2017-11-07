<?php
/****
*   连续签到
**/
namespace Jy_admin\Controller;
use Think\Controller;
class ThirtydaysContinuityGoodsController extends ComController {
    public function index(){
        $Day    = I('param.Day',1,'intval');
        $CatSevenDaysSignField = array(
            'a.Id',
            'b.Name',
            'a.Number',
            'a.DateTime',
        );
        $CatSevenDaysSign = M('conf_thirtyday_continuity_goods as a')
           ->join('jy_goods_all as b on b.Id = a.GoodsID')
            ->field($CatSevenDaysSignField)
            ->where(' a.continuity = '.$Day)
            ->select();
        $this->assign('info',$CatSevenDaysSign);
        $this->assign('Day',$Day);
        $this->display('index');
    }
    //添加
    public function  add(){
        $obj = new \Common\Lib\func();

        $continuity                =   I('param.continuity',0,'intval');
        if($continuity ==0){
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
        if(IS_POST){
            $Type                  =   I('param.Type',0,'intval');
            $Number                =   I('param.Number','','trim');
            $GoodsID               =   I('param.GoodsID',0,'intval');
            $dataSevenDaysSign  = array(
                'GoodsID'        =>       $GoodsID,
                'continuity'     =>       $continuity,
                'Type'           =>       $Type,
                'Number'         =>       $Number,
            );
            //添加
            $addSevenDaysSign = M('conf_thirtyday_continuity_goods')
                ->add($dataSevenDaysSign);
            if($addSevenDaysSign){
                $obj->showmessage('添加成功','/jy_admin/ThirtyDaysSignThree/index');
            }else{
                $obj->showmessage('添加失败');
            }
        }
        $this->assign('continuity',$continuity);
        $this->assign('CatGoodsAll',$CatGoodsAll);
        $this->display('add');
    }
    //修改
    public function edit(){
        $obj = new \Common\Lib\func();
        $id = I('param.Id',0,'intval');
        if($id<=0){
            $obj->showmessage('非法操作');
        }
        $CatInfo = M('conf_thirtyday_continuity_goods')
            ->where('Id = '.$id)
            ->field(array(
                'Id',
                'GoodsID',
                'Number',
                'Type',
            ))
            ->find();
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
            $Type                  =   I('param.Type',0,'intval');
            $Number                =   I('param.Number','','trim');
            $GoodsID               =   I('param.GoodsID',0,'intval');
            $dataSevenDaysSign  = array(
                'GoodsID'        =>       $GoodsID,
                'Type'           =>       $Type,
                'Number'         =>       $Number,
            );

            //修改
            $upSevenDaysSign = M('conf_thirtyday_continuity_goods')
                ->where('Id = '.$id)
                ->save($dataSevenDaysSign);
            if($upSevenDaysSign !== false){
                $obj->showmessage('修改成功','/jy_admin/ThirtyDaysGoods/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }
        $this->assign('CatGoodsAll',$CatGoodsAll);
        $this->assign('info',$CatInfo);
        $this->display('edit');
    }


    //删除
    public function  del(){
        $id = I('param.Id',0,'intval');
        if($id == 0){
            echo  0;
        }else{
            $db = M('conf_thirtyday_continuity_goods');
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