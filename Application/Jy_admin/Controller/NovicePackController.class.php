<?php
/****
*   新手礼包列表
**/
namespace Jy_admin\Controller;
use Think\Controller;
class NovicePackController extends ComController {
    public function index(){
        $CatNovicePack = M('conf_novice_pack as a')
                        ->join('jy_goods_all as b on  a.GoodsID = b.Id and  b.IsDel = 1')
                        ->field(array(
                               'a.Id',
                               'a.Title',
                               'a.DescribeBomb',
                               'a.DescribeGold',
                               'a.Bomb',
                               'b.Name',
                               'a.DateTime',
                               'a.Remark',
                            'b.CurrencyNum as `Price`',
                        ))
                        ->order('`Price` asc')
                        ->select();
        $this->assign('info',$CatNovicePack);
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
            ->where('`CateGory` = 4  and `ShowType` = 2 and `Type` = 0 and `IsDel` = 1')
            ->field($CatGoodsAllField)
            ->select();
        if(IS_POST){
            $DescribeBomb             =   I('param.DescribeBomb','','trim');
            $DescribeGold             =   I('param.DescribeGold','','trim');
            $Bomb                     =   I('param.Bomb','','trim');
            $Title                    =   I('param.Title','','trim');
            $Remark                   =   I('param.Remark','','trim');
            $GoodsID                  =   I('param.GoodsID',0,'intval');
            $dataSevenDaysSign  = array(
                'GoodsID'         =>       $GoodsID,
                'Title'           =>       $Title,
                'DescribeBomb'    =>       $DescribeBomb,
                'DescribeGold'    =>       $DescribeGold,
                'Bomb'            =>       $Bomb,
                'Remark'          =>       $Remark,
            );
            //添加
            $addSevenDaysSign = M('conf_novice_pack')
                ->add($dataSevenDaysSign);
            if($addSevenDaysSign){
                $obj->showmessage('添加成功','/jy_admin/NovicePack/index');
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
        $id = I('param.Id',0,'intval');
        if($id<=0){
            $obj->showmessage('非法操作');
        }
        $CatInfo = M('conf_novice_pack')
            ->where('Id = '.$id)
            ->field(array(
                'Id',
                'DescribeBomb',
                'DescribeGold',
                'Bomb',
                'Title',
                'Remark',
                'GoodsID',
            ))
            ->find();
        //所有物品信息
        $CatGoodsAllField = array(
            'Id',
            'Name',
            'Type',
        );
        $CatGoodsAll = M('jy_goods_all')
            ->where('`CateGory` = 4  and `ShowType` = 2 and `Type` = 0 and `IsDel` = 1')
            ->field($CatGoodsAllField)
            ->select();
        if(IS_POST){
            //数据
            $DescribeBomb             =   I('param.DescribeBomb','','trim');
            $DescribeGold             =   I('param.DescribeGold','','trim');
            $Bomb                     =   I('param.Bomb','','trim');
            $Title                    =   I('param.Title','','trim');
            $Remark                   =   I('param.Remark','','trim');
            $GoodsID                  =   I('param.GoodsID',0,'intval');

            $dataSevenDaysSign  = array(
                'GoodsID'         =>       $GoodsID,
                'Title'           =>       $Title,
                'DescribeBomb'    =>       $DescribeBomb,
                'DescribeGold'    =>       $DescribeGold,
                'Bomb'            =>       $Bomb,
                'Remark'          =>       $Remark,
            );

            dump();
            //修改
            $upSevenDaysSign = M('conf_novice_pack')
                ->where('Id = '.$id)
                ->save($dataSevenDaysSign);
            if($upSevenDaysSign !== false){
                $obj->showmessage('修改成功','/jy_admin/NovicePack/index');
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
            $db = M('conf_novice_pack');
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

}