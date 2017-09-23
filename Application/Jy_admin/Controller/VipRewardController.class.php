<?php
/****
*  vip每日奖励
**/
namespace Jy_admin\Controller;
use Think\Controller;
class VipRewardController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数

        $ObjFun = new \Common\Lib\func();
        $Level = I('param.level',0,'intval');      //vip等级
        if($Level <= 0){
            $ObjFun->showmessage('非法操作');
        }
        $where = 'b.Level = '.$Level;
        $count  = M('jy_goods_all as a')
                    ->join('jy_vip_reward as b on b.GoodsID = a.Id')
                    ->where($where)
                     ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $catVipInfo = M('jy_goods_all as a')
            ->join('jy_vip_reward as b on b.GoodsID = a.Id')
            ->where($where)
            ->limit($page*$num,$num)
            ->field('b.Id,a.Name,b.Number,b.DateTime,b.Remark')
            ->select();
        $this->assign('page',$show);
        $this->assign('level',$Level);
        $this->assign('info',$catVipInfo);
        $this->display('index');

    }
    //添加
    public function  add(){
        $obj = new \Common\Lib\func();
        $Level = I('param.level',0,'intval');      //vip等级
        if($Level <= 0){
            $obj->showmessage('非法操作');
        }
        //查询所有物品
        $catGoodsAllField = array(
            'Type',
            'Id',
            'Name'
        );
        $catGoodsAll = M('jy_goods_all')
            ->where('IsDel = 1')
            ->field($catGoodsAllField)
            ->select();
        if(IS_POST){
            //数据
            $Type        =           I('param.Type',0,'intval');              //类型
            $GoodsID     =           I('param.GoodsID',0,'intval');              //物品ID
            $Number      =           I('param.Number',0,'intval');              //数量
            $Remark      =            I('param.Remark','','trim');                 //备注
            $dataVipInfo = array(
                'Level'           =>          $Level,
                'GoodsID'         =>          $GoodsID,
                'Number'          =>          $Number,
                'Type'            =>          $Type,
                'Remark'          =>          $Remark
            );
            //添加
            $addVipInfo = M('jy_vip_reward')
                ->add($dataVipInfo);
            if($addVipInfo){
                $obj->showmessage('添加成功','/jy_admin/VipReward/index');
            }else{
                $obj->showmessage('添加失败');
            }
        }
        $this->assign('catGoodsAll',$catGoodsAll);
        $this->assign('level',$Level);
        $this->display('add');
    }
    //修改
    public function edit(){
        $obj = new \Common\Lib\func();
        $Id = I('param.Id',0,'intval');
        if($Id<= 0){
            $obj->showmessage('非法操作');
        }
        //查询用户信息
        $catVipInfo = M('jy_vip_reward')
                      ->where('Id = '.$Id)
                      ->field('Id,level,Number,GoodsID,Type,Remark')
                      ->find();
        //查询所有物品
        $catGoodsAllField = array(
            'Type',
            'Id',
            'Name'
        );
        $catGoodsAll = M('jy_goods_all')
                        ->where('IsDel = 1')
                        ->field($catGoodsAllField)
                        ->select();
        if(IS_POST){
            //数据
            $Type        =           I('param.Type',0,'intval');              //类型
            $GoodsID     =           I('param.GoodsID',0,'intval');              //物品ID
            $Number     =           I('param.Number',0,'intval');              //数量
            $Remark     =            I('param.Remark','','trim');                 //备注
            $dataVipInfo = array(
                'GoodsID'      =>          $GoodsID,
                'Number'        =>         $Number,
                'Type'         =>          $Type,
                'Remark'        =>         $Remark
            );
            //添加
            $upVipInfo = M('jy_vip_reward')
                ->where('Id = '.$Id)
                ->save($dataVipInfo);
            if($upVipInfo !== false){
                $obj->showmessage('修改成功','/jy_admin/VipReward/index');
            }else{
                $obj->showmessage('修改失败');
            }

        }
        $this->assign('info',$catVipInfo);
        $this->assign('catGoodsAll',$catGoodsAll);
        $this->display('edit');
    }

    //删除
    public function  del(){
        $Id = I('param.Id',0,'intval');
        if($Id < 0){
            echo  0;
        }else{
            $db = M('jy_vip_reward');
            $info = $db
                ->where('Id = '.$Id)
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