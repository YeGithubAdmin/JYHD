<?php
/****
*   活动列表
**/
namespace Jy_admin\Controller;
use Think\Controller;
class ActivityListSonController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数

        $obj = new \Common\Lib\func();

        $Id = I('param.Id',0,'intval');
        $Type = I('param.Type',0,'intval');         //活动类型 1-累计充值 2-单笔充值 3-循环充值 4-图片类型

        if($Id == 0 || $Type == 0){
            $obj->showmessage('非法操作');
        }
        $where = 'a.FatherID = '.$Id;
        $count  = M('jy_activity_son_list as a')
            ->where($where)
            ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出

        $activityFatherlistFile = array(
            'a.Id',
            'a.FatherID',
            'a.Code',
            'b.Name',
            'a.Number',
            'a.Schedule',
            'a.ImgUrl',
            'a.Code',
            'a.DateTime'
        );
        $info = M('jy_activity_son_list as a')
            ->join('jy_goods_all as b on b.Id = a.GoodsID and b.IsDel')
            ->where($where)
            ->limit($page*$num,$num)
            ->field($activityFatherlistFile)
            ->select();
        $count = count($info);
        $this->assign('Id',$Id);
        $this->assign('Type',$Type);
        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->assign('count',$count);
        $this->display('index');
    }
    //添加
    public  function add(){
        $obj = new \Common\Lib\func();

        //查询所有物品

        $Id = I('param.Id',0,'intval');
        $Type = I('param.Type',0,'intval');         //活动类型 1-累计充值 2-单笔充值 3-循环充值 4-图片类型
        if($Id == 0 || $Type == 0){
            $obj->showmessage('非法操作');
        }





        $catGoodsAllFiled = array(
            'Id',
            'Name',
            'Type',
        );

        $catGoodsAll = M('jy_goods_all')
            ->where('IsDel = 1')
            ->field($catGoodsAllFiled)
            ->select();
        if(IS_POST){
            $FatherID                   =       $Id;                 //父级ID
            $GoodsID                    =       I('param.GoodsID','','trim');                   //物品ID
            $Number                     =       I('param.Number','','trim');                    //物品数量
            $Schedule                   =       I('param.Schedule',0,'intval');                  //条件数值
            $ImgUrl                     =       I('param.pic','','trim');                    //图片
            $ImgUrl                     =       $ImgUrl[0];
            $Code                       =       I('param.Code','','trim');                      //标识
            $Title                      =       I('param.Title','','trim');                      //标题
            $dataActivitySonList = array(
                'FatherID'=>$FatherID,
                'GoodsID'=>$GoodsID,
                'Number'=>$Number,
                'Schedule'=>$Schedule,
                'ImgUrl'=>$ImgUrl,
                'Code'=>$Code,
                'Title'=>$Title,
            );

            $addActivitySonList = M('jy_activity_son_list')
                ->add($dataActivitySonList);
            if($addActivitySonList){
                $obj->showmessage('添加成功','/jy_admin/ActivityListSon/index');
            }else{
                $obj->showmessage('添加失败');
            }
        }
        $this->assign('Id',$Id);
        $this->assign('Type',$Type);
        $this->assign('catGoodsAll',$catGoodsAll);
        $this->display('add');
    }
    //修改
    public function edit(){
        $obj = new \Common\Lib\func();
        $Id = I('param.Id',0,'intval');
        if ($Id<=0){
            $obj->showmessage('非法操作');
        }

        //查询所有物品

        $catGoodsAllFiled = array(
            'Id',
            'Name',
            'Type',
        );

        $catGoodsAll = M('jy_goods_all')
                        ->where('IsDel = 1')
                        ->field($catGoodsAllFiled)
                        ->select();

        //查询子活动信息
        $ActivitySonListField = array(
            'a.GoodsID',
            'a.Number',
            'a.Schedule',
            'a.Id',
            'a.Title',
            'a.ImgUrl',
            'a.Code',
            'b.Type',
        );
        $ActivitySonList = M('jy_activity_son_list as a')
                              ->join('jy_goods_all as b on b.Id = a.GoodsID and b.IsDel = 1')
                              ->where('a.Id = '.$Id)
                              ->field($ActivitySonListField)
                              ->find();
        if(IS_POST){

            $GoodsID                    =       I('param.GoodsID','','trim');                   //物品ID
            $Number                     =       I('param.Number','','trim');                    //物品数量
            $Schedule                   =       I('param.Schedule',0,'intval');                  //条件数值
            $ImgUrl                     =       I('param.pic','','trim');                    //图片
            $ImgUrl                     =       $ImgUrl[0];
            $Code                       =       I('param.Code','','trim');                      //标识
            $Title                      =       I('param.Title','','trim');                      //标题
            $dataActivitySonList = array(

                'GoodsID'=>$GoodsID,
                'Number'=>$Number,
                'Schedule'=>$Schedule,
                'ImgUrl'=>$ImgUrl,
                'Code'=>$Code,
                'Title'=>$Title,
            );
            $addActivitySonList = M('jy_activity_son_list')
                ->where('Id = '.$Id)
                ->save($dataActivitySonList);
            if($addActivitySonList !== false ){
                $obj->showmessage('修改成功','/jy_admin/ActivityListSon/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }
        $this->assign('info',$ActivitySonList);
        $this->assign('catGoodsAll',$catGoodsAll);
        $this->display('edit');
    }
    //删除
    public function del(){
        $Id = I('param.Id',0,'intval');
        if($Id == 0){
            echo  0;
        }else{
            $db = M('jy_activity_son_list');
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
}