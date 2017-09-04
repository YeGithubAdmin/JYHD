<?php
/***
*   系统管理员组
*/
namespace Jy_admin\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class AdmingroupController extends ComController {
    //列表
    public function index(){
        $userInfo       =      $this->userInfo;      //用户信息
        $lowerAdminUser =      $this->upAdmingroup;  //我的下级用户


        $default =  $userInfo['default']; // 系统默认账号  1-否  2-是
        $db = M('jy_admin_group');
        $admingrouList = $db
                    ->where('isdel = 1')
                    ->field('id,upid,name,islock,addId,addName,remark,mtime')
                    ->select();


        foreach($admingrouList as $k=>$v){
            if($v['upid'] == 0) {
                $admingrouList[$k]['upName'] = '最上级';
            }else{
                foreach($admingrouList as $key=>$val){
                    if($v['upid'] == $val['id']){
                        $admingrouList[$k]['upName'] = $val['name'];
                    }
                }
            }
        }

        $NewsAdmingrouList = array();


        if($default  == 1){
            foreach($admingrouList as $k=>$v){
                if(in_array($v['addId'],$lowerAdminUser) || $v['addId'] == $userInfo['id']){
                    $NewsAdmingrouList[] = $v;
                }
            }
        }else{
            $NewsAdmingrouList = $admingrouList;
        }

        $this->assign('menuList',$NewsAdmingrouList);
        $this->assign('userInfo',$userInfo);
        $this->display('index');
    }
    //添加
    public function add(){
        $obj             =  new \Common\Lib\func();
        $userInfo        =  $this->userInfo;
        $lowerAdmingroup =  $this->lowerAdmingroup;

        $admingroup  = M('jy_admin_group')
            ->where('isdel = 1 ')
            ->field('id,upid,name')
            ->select();
        $admingroupInfo = array();
        if($userInfo['default'] == 1){
            foreach ($admingroup as $k=>$v){
                foreach ($lowerAdmingroup as $key=>$val){
                    if($v['id'] == $val || $v['id'] == $userInfo['id']){
                        $admingroupInfo[] = $v;
                    }
                }
            }
        }else{
            $admingroupInfo =  $admingroup;
        }

        if(IS_POST){
            $dataAdmingroup['name']         =         I('param.name','','trim');
            $dataAdmingroup['upid']         =         I('param.upid',0,'intval');
            $dataAdmingroup['DesktopAddress']         =   I('param.DesktopAddress','','trim');
            $dataAdmingroup['authority']    =         I('param.authority','','trim,json_encode');
            $dataAdmingroup['edit']         =         I('param.edit',1,'intval');
            $dataAdmingroup['add']          =          I('param.edit',1,'intval');
            $dataAdmingroup['DesktopAddress']          =          I('param.DesktopAddress',1,'trim');
            $dataAdmingroup['del']          =         I('param.del',1,'intval');
            $dataAdmingroup['islock']       =         I('param.islock',1,'intval');
            $dataAdmingroup['remark']       =         I('param.remark','','trim');
            $dataAdmingroup['addId']        =          $userInfo['id'] ;
            $dataAdmingroup['addName']      =        $userInfo['name'];
            $addAdmingroup = M('admin_group')
                            ->add($dataAdmingroup);

            if($addAdmingroup){
                $obj->showmessage('添加成功','/jy_admin/admingroup/index');
            }else{
               $obj->showmessage('添加失败');
            }
        }
        $this->assign('userInfo',$userInfo);
        $this->assign('admingroupInfo',$admingroupInfo);
        $this->display('add');
    }
    //修改
    public function  edit(){
        $id = I('param.id',0,'intval');

        $obj             =  new \Common\Lib\func();
        if($id<=0){
            $obj->showmessage('非法操作');
        }
        $userInfo        =  $this->userInfo;
        $lowerAdmingroup =  $this->lowerAdmingroup;

        $admingroup  = M('jy_admin_group')
            ->where('isdel = 1 ')
            ->field('id,upid,name')
            ->select();
        $admingroupInfo = array();
        if($userInfo['default'] == 1){
            foreach ($admingroup as $k=>$v){
                if(in_array($v['id'],$lowerAdmingroup)){
                    $admingroupInfo[] = $v;
                }
            }
        }else{
            $admingroupInfo =  $admingroup;
        }
        //查询信息
        $admingroupData = M('jy_admin_group')
                          ->where('id = '.$id.'  and  isdel = 1')
                          ->field('id,name,upid,remark,add,del,edit,islock')
                          ->find();
        if(IS_POST){
            $dataAdmingroup['name']         =         I('param.name','','trim');
            $dataAdmingroup['DesktopAddress']         =   I('param.DesktopAddress','','trim');
            $dataAdmingroup['upid']         =         I('param.upid',0,'intval');
            $dataAdmingroup['authority']    =         I('param.authority','','trim,json_encode');
            $dataAdmingroup['edit']         =         I('param.edit',1,'intval');
            $dataAdmingroup['add']          =          I('param.edit',1,'intval');

            $dataAdmingroup['del']          =         I('param.del',1,'intval');
            $dataAdmingroup['islock']       =         I('param.islock',1,'intval');
            $dataAdmingroup['remark']       =         I('param.remark','','trim');
            $dataAdmingroup['addId']        =          $userInfo['id'] ;
            $dataAdmingroup['addName']      =        $userInfo['name'];
            $addAdmingroup = M('admin_group')
                ->where('id = '.$id)
                ->save($dataAdmingroup);

            if($addAdmingroup){
                $obj->showmessage('修改成功','/jy_admin/admingroup/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }
        $this->assign('admingroupInfo',$admingroupInfo);
        $this->assign('userInfo',$userInfo);
        $this->assign('info',$admingroupData);
        $this->display('edit');


    }
    //删除
    public function  del(){
        $id = I('param.id',0,'intval');
        if($id == 0){
           echo  0;
        }else{
            $db = M('jy_admin_group');
            //是否存在组员
            $admin = M('jy_admin_users')
                    ->where('admingroup = '.$id.'  and  isdel = 1')
                    ->find();
            $upInfo =  $db
                ->where('upid = '.$id)
                ->find();

            if(!empty($admin)){
                echo 2;
            }else{
                $dataAdmingroup['isdel']  =2;
                $info = $db
                    ->where('id = '.$id)
                    ->save($dataAdmingroup);
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
            $db = M('jy_admin_group');
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
            $db = M('jy_admin_group');
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


    public function authority(){
        $obj = new \Common\Lib\func();
        $id = I('param.id',0,'intval');
        $userInfo        =  $this->userInfo;

        $lowerAdmingroup =  $this->lowerAdmingroup;
        if($id == 0){
            $obj->showmessage('非法操作');
        }
        //所有菜单
        $menuAll = M('jy_system_menu')
            ->where('islock = 1')
            ->order('sort asc')
            ->field('id,name,upid,sort')
            ->select();
        //管理组信息
        $infoAdmingroup = M('jy_admin_group')
            ->where('id = '.$id)
            ->field('id,name,authority')
            ->find();

        $authorityData = array();
        if($userInfo['default'] == 1){

            //当前管理组权限
            $myInfoAdmingroup  = M('jy_admin_group')
                ->where('id = '.$userInfo['admingroup'])
                ->field('id,name,authority')
                ->find();
            //过滤当前管理组权限
            $authorityArry = array();
            $MyAuthority = json_decode($myInfoAdmingroup['authority'],true);
            foreach ($menuAll as $k=>$v){
                if(in_array($v['id'],$MyAuthority)){
                    $authorityArry[] = $v;
                }
            }

            //目标管理组权限
            $authority = json_decode($infoAdmingroup['authority'],true);

            foreach ($authorityArry as $k=>$v){
                if(in_array($v['id'],$authority)){
                    $authorityArry[$k]['checked'] = 1;
                }else{
                    $authorityArry[$k]['checked'] = 2;
                }
            }

            $authorityData = $authorityArry;

        }else{
            $authority = json_decode($infoAdmingroup['authority'],true);
            foreach ($menuAll as $k=>$v){
                if(in_array($v['id'],$authority)){
                    $menuAll[$k]['checked'] = 1;
                }else{
                    $menuAll[$k]['checked'] = 2;
                }
            }
            $authorityData  = $menuAll;
        }

        if(IS_POST){
            $authority = I('param.authority','','trim');

            $dataAdminGroup = array(
                                'authority'=>json_encode($authority),
                              );

            $upAdminGroup =  M('jy_admin_group')
                             ->where('id = '.$id)
                             ->save($dataAdminGroup);
            if($upAdminGroup !== false ){
                 $obj->showmessage('修改成功','/jy_admin/admingroup/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }

        $authorityData  = $obj->make_tree($authorityData);
        $this->assign('menuList',$authorityData);
        $this->assign('info',$infoAdmingroup);
        $this->display();

    }
    public function Verification(){
        $adminGrupName =  I('param.adminGrupName','','trim');
        $id = I('param.id',0,'intval');
        if($adminGrupName == ''){
               echo 0;
               exit();
        }

        $adminGrup = M('jy_admin_group')
                      ->where('name = "'.$adminGrupName.'" and isdel = 1')
                      ->field('id')
                      ->find();
        if(empty($adminGrup)){
            echo 1;
            exit();
        }else if ($id == $adminGrup['id']){
            echo 1;
            exit();
        }else{
            echo 2;
            exit();
        }

    }

}