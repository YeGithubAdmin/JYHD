<?php
/****
*  游戏公告
**/
namespace Jy_admin\Controller;
use Protos\OptSrc;
use Protos\PBS_ItemOpt;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
class NoticeController extends ComController {
    public function index(){
        $page = $this->page;
        $num  = $this->num;
        $count  = M('jy_game_notice')->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $catGameNotice = array(
            'Title',
            'Remark',
            'Status',
            'DateTime',
            'Id',
        );
        $catGameNotice = M('jy_game_notice')
            ->limit($page*$num,$num)
            ->field($catGameNotice)
            ->order('Sort desc','Num asc')
            ->select();
        $this->assign('page',$show);
        $this->assign('info',$catGameNotice);
        $this->display('index');
    }
    //添加
    public function  add(){
        $ObjFun = new \Common\Lib\func();
        if(IS_POST){
            $Status = I('param.Status',1,'intval');
            $Content = I('param.Content','','trim');
            $Title   = I('param.Title','','trim');
            $TitleSon   = I('param.TitleSon','','trim');
            $Sort    = I('param.Sort',1,'intval');
            $Num     = I('param.Num',1,'intval');
            $Btime   = I('param.Btime','','trim');
            $Remark  = I('param.Remark','','trim');
            $dataGameNotice = array(
                'Content' =>    $Content,
                'Status'  =>    $Status,
                'Btime'   =>   $Btime,
                'TitleSon'   =>   $TitleSon,
                'Num'   =>   $Num,
                'Title'   =>    $Title,
                'Remark'  =>    $Remark,
                'Sort'    =>    $Sort,
            );

            $addGameNotice = M('jy_game_notice')
                ->add($dataGameNotice);
            if($addGameNotice){
                $ObjFun->showmessage('添加成功',"/jy_admin/notice/index");
            }else{
                $ObjFun->showmessage('添加失败');
            }
        }
        $this->display();

    }
    //修改
    public function edit(){
        $ObjFun = new \Common\Lib\func();
        $Id = I('param.Id',0,'intval');
        if($Id<=0){
            $ObjFun->showmessage('非法操作！');
        }
        $GameNoticeField = array(
            'Id',
            'Content',
            'Sort',
            'Status',
            'Num',
            'TitleSon',
            'Btime',
            'Title',
            'Remark',
        );
        $catGameNotice = M('jy_game_notice')
                         ->field($GameNoticeField)
                         ->where('Id = '.$Id)
                         ->find();
        if(IS_POST){
            $Status = I('param.Status',1,'intval');
            $Content = I('param.Content','','trim');
            $Title   = I('param.Title','','trim');
            $TitleSon   = I('param.TitleSon','','trim');
            $Sort    = I('param.Sort',1,'intval');
            $Num     = I('param.Num',1,'intval');
            $Btime   = I('param.Btime','','trim');
            $Remark  = I('param.Remark','','trim');
            $dataGameNotice = array(
                'Content' =>    $Content,
                'Status'  =>    $Status,
                'Btime'   =>   $Btime,
                'TitleSon'   =>   $TitleSon,
                'Num'   =>   $Num,
                'Title'   =>    $Title,
                'Remark'  =>    $Remark,
                'Sort'    =>    $Sort,
            );
            $UpGameNotice = M('jy_game_notice')
                ->where('Id = '.$Id)
                ->save($dataGameNotice);
            if($UpGameNotice){
                $ObjFun->showmessage('修改成功',"/jy_admin/notice/index");
            }else{
                $ObjFun->showmessage('修改失败');
            }
        }
        $this->assign('info',$catGameNotice);
        $this->display();
    }
    //发布
    public function start(){
        $Id = I('param.Id',0,'intval');
        $Code = 1;
        if($Id<=0){
            $Code = 0;
            goto end;
        }
        $dataGameNotice = array(
            'Status'=>2,
        );
        $UpGameNotice = M('jy_game_notice')
                        ->where('Id = '.$Id)
                        ->save($dataGameNotice);
        if(!$UpGameNotice){
            $Code = 0;
            goto end;
        }
        end:
        echo $Code;
        exit();

    }
    //停止发布
    public function stop(){
        $Id = I('param.Id',0,'intval');
        $Code = 1;
        if($Id<=0){
            $Code = 0;
            goto end;
        }
        $dataGameNotice = array(
            'Status'=>1,
        );
        $UpGameNotice = M('jy_game_notice')
            ->where('Id = '.$Id)
            ->save($dataGameNotice);
        if(!$UpGameNotice){
            $Code = 0;
            goto end;
        }
        end:
        echo $Code;
        exit();
    }
    //删除
    public function del(){
        $Id = I('param.Id',0,'intval');
        $Code = 1;
        if($Id<=0){
            $Code = 0;
            goto end;
        }
        $delGameNotice = M('jy_game_notice')
            ->where('Id = '.$Id)
            ->delete();
        if(!$delGameNotice){
            $Code = 0;
            goto end;
        }
        end:
        echo $Code;
        exit();
    }


    //删除
    public function authority(){
        $ObjFun = new \Common\Lib\func();
        $Id = I('param.Id',0,'intval');
        if($Id<=0){
            $ObjFun->showmessage('非法操作');
        }
        $catGameNoticeField = array(
            'Content',
        );
        $catGameNotice = M('jy_game_notice')
            ->where('Id = '.$Id)
            ->field($catGameNoticeField)
            ->find();
        $this->assign('info',$catGameNotice);
        $this->display();
    }

}