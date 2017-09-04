<?php
/***
*  系统菜单
*/
namespace Jy_admin\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class MenuController extends ComController {
    //列表
    public function index(){
        $db = M('jy_system_menu');
        $menuList = $db
                    ->field('id,upid,name,sort,icon,url,islock,remark,mtime')
                    ->select();
        foreach($menuList as $k=>$v){
            if($v['upid'] == 0) {
                $menuList[$k]['upName'] = '最上级';
            }else{
                foreach($menuList as $key=>$val){
                    if($v['upid'] == $val['id']){
                        $menuList[$k]['upName'] = $val['name'];
                    }
                }
            }
        }

        $this->assign('menuList',$menuList);
        $this->display('index');
    }
    //添加
    public function add(){
        //菜单
        $obj = new \Common\Lib\func();
        $db = M('jy_system_menu');
        $menuList = $db
            ->where('upid = 0 and islock = 1')
            ->field('id,upid,name')
            ->select();

        if(IS_POST){
            $dataMenu['name'] = I('param.name','','trim');
            $dataMenu['icon'] = I('param.icon','','trim');
            $dataMenu['sort'] = I('param.sort',0,'intval');
            $dataMenu['remark'] = I('param.remark','','trim');
            $dataMenu['url'] = I('param.url','','trim');
            $dataMenu['upid'] = I('param.upid',0,'intval');
            $dataMenu['islock'] = I('param.islock',1,'intval');



            $addMeu = $db
                    ->add($dataMenu);
            if($addMeu){
                $obj->showmessage('添加成功','/jy_admin/menu/index');
            }else{
                $obj->showmessage('添加失败');
            }

        }
        $this->assign('menu',$menuList);
        $this->display('add');
    }
    //修改
    public function  edit(){
        //菜单
        $obj = new \Common\Lib\func();
        $id = I('param.id',0,'intval');
        if($id == 0){
            $obj->showmessage('非法操作');
        }

        $db = M('jy_system_menu');
        $menuList = $db
            ->where('upid = 0  and islock = 1')
            ->field('id,upid,name')
            ->select();

        //菜单信息
        $menuInfo = $db
                    ->where('id = '.$id)
                    ->field('id,upid,name,sort,icon,url,islock,remark,mtime')
                    ->find();



        if(IS_POST){
            $dataMenu['icon'] = I('param.icon','','trim');
            $dataMenu['sort'] = I('param.sort',0,'intval');
            $dataMenu['remark'] = I('param.remark','','trim');
            $dataMenu['url'] = I('param.url','','trim');
            $dataMenu['name'] = I('param.name','','trim');
            $dataMenu['upid'] = I('param.upid',0,'intval');
            $dataMenu['islock'] = I('param.islock',1,'intval');
            $upMenu = $db
                ->where('id = '.$id)
                ->save($dataMenu);
            if($upMenu){
                $obj->showmessage('修改成功','/yq_admin/menu/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }

        $this->assign('menu',$menuList);
        $this->assign('info',$menuInfo);
        $this->display('edit');
    }
    //删除
    public function  del(){
        $id = I('param.id',0,'intval');

        if($id == 0){
           echo  0;
        }else{
            $db = M('jy_system_menu');
            //是否有下级菜单
            $upInfo =  $db
                ->where('upid = '.$id)
                ->find();

            if(!empty($upInfo)){
                echo 2;
            }else{
                $info = $db
                    ->where('id = '.$id)
                    ->delete();
                if($info){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
        exit();
    }
    //启动
    public function start(){
        $id = I('param.id',0,'intval');
        if($id == 0){
            echo 0;
        }else{
            $db = M('system_menu');
            $data  = array('islock'=>1,);
            $info = $db
                    ->where('id = '.$id)
                    ->save($data);
            if($info){
                echo 1;
            }else{
                echo 0;
            }
        }
        exit();
    }
    //锁定
    public function stop(){
        $id = I('param.id',0,'intval');
        if($id == 0){
            echo 0;
        }else{
            $db = M('system_menu');
            $data  = array('islock'=>2,);
            $info = $db
                ->where('id = '.$id)
                ->save($data);
            if($info){
                echo 1;
            }else{
                echo 0;
            }
        }
        exit();
    }
}