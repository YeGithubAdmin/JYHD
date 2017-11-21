<?php
/****
*  系统管理员
**/
namespace Jy_admin\Controller;
use Think\Controller;
class AdminUsersController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $userInfo       = $this->userInfo;          //用户信息
        $lowerAdminUser = $this->lowerAdminUser;    //我的下级组
        //已入方法类
        $obj = new \Common\Lib\func();
        $search['datemax']     =      I('param.datemax','','trim');
        $search['datemin']     =      I('param.datemin','','trim');
        $search['account']     =      I('param.account','','trim');
        $search['islock']      =      I('param.islock','','intval');
        $where = 'a.admingroup = b.id and a.isdel = 1';
        if ($search['datemax'] != ''){
            $where .= ' and a.`mtime`<="'.$search['datemax'].'"';
        }
        if ($search['datemin'] != ''){
            $where .= ' and a.`mtime`>="'.$search['datemin'].'"';
        }
        if ($search['account'] != ''){
            $where .= ' and a.`account`="'.$search['account'].'"';
        }
        if ($search['islock'] != '') {
            $where .= ' and a.`islock`=' . $search['islock'];
        }
        if($userInfo['default'] == 1){
            $lowerAdminUser[] = $userInfo['id'];
            $lowerAdminUser  = implode(',',$lowerAdminUser);
            $where .= ' and a.addId in('.$lowerAdminUser.')';
        }
        $count  = M('jy_admin_users as a')->join('jy_admin_group as b')->where($where)->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $adminUsers = M('jy_admin_users as a')
            ->join('jy_admin_group as b')
            ->where($where)
            ->limit($page*$num,$num)
            ->field('a.id,a.name,a.account,b.name as admingroup,a.channel,a.addName,a.addId,a.islock,a.remark,a.mtime')
            ->select();

        $this->assign('page',$show);
        $this->assign('info',$adminUsers);
        $this->assign('search',$search);
        $this->display('index');

    }
    //添加
    public function  add(){
        $obj = new \Common\Lib\func();
        $userInfo = $this->userInfo;
        $lowerAdmingroup  = $this->lowerAdmingroup;
        $adminGroup = M('jy_admin_group')
                        ->where('isdel = 1')
                        ->field('id,name')
                        ->select();
        $adminGroupInfo = array();
        if($userInfo['default']  == 1){
            foreach ($adminGroup as $k=>$v){
                if(in_array($v['id'],$lowerAdmingroup) || $v['id'] == $userInfo['admingroup']){
                    $adminGroupInfo[] = $v;
                }
            }
        }else{
            $adminGroupInfo =  $adminGroup;
        }
        if(IS_POST){
            //数据
            $dataAdminUsers  = array(
                'name'         =>       I('param.name','','trim'),
                'account'      =>       I('param.account','','trim'),
                'passwd'       =>       I('param.passwd','','trim,md5'),
                'admingroup'   =>       I('param.admingroup',0,'intval'),
                'addName'      =>       $userInfo['name'],
                'addId'        =>       $userInfo['id'],
                'islock'       =>       I('param.islock',1,'intval'),
                'remark'       =>       I('param.remark','','trim'),
            );
            //添加
            $addAdminUsers = M('jy_admin_users')
                            ->add($dataAdminUsers);
            if($addAdminUsers){
                $obj->showmessage('添加成功','/jy_admin/AdminUsers/index');
            }else{
                 $obj->showmessage('添加失败');
            }
        }
        //当前管理员的用户组
        $this->assign('adminGroupInfo',$adminGroupInfo);
        $this->display('add');
    }


    //修改
    public function edit(){
        $obj = new \Common\Lib\func();
        $id = I('param.id',0,'intval');
        if($id<=0){
            $obj->showmessage('非法操作');
        }
        $userInfo = $this->userInfo;
        $lowerAdmingroup  = $this->lowerAdmingroup;
        $adminGroup = M('jy_admin_group')
            ->where('isdel = 1')
            ->field('id,name')
            ->select();
        $adminGroupInfo = array();
        if($userInfo['default']  == 1){
            foreach ($adminGroup as $k=>$v){
                if(in_array($v['id'],$lowerAdmingroup) || $v['id'] == $userInfo['admingroup']){
                    $adminGroupInfo[] = $v;
                }
            }
        }else{
            $adminGroupInfo =  $adminGroup;
        }
        $adminUsersInfo = M('jy_admin_users')
            ->where('id = '.$id.' and isdel = 1')
            ->field('id,name,passwd,account,admingroup,islock,remark')
            ->find();
        //管理员信息

        if(IS_POST){
            //数据
            $dataAdminUsers  = array(
                'name'         =>       I('param.name','','trim'),
                'admingroup'   =>       I('param.admingroup',0,'intval'),
                'islock'       =>       I('param.islock',1,'intval'),
                'remark'       =>       I('param.remark','','trim'),

            );
            $passwd = I('param.passwd','','trim,md5');
            if($passwd != ''){
                $dataAdminUsers['passwd'] =  $passwd;
            }
            //添加
            $upAdminUsers = M('jy_admin_users')
                ->where('id = '.$id)
                ->save($dataAdminUsers);
            if($upAdminUsers !== false){
                $obj->showmessage('修改成功','/jy_admin/AdminUsers/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }
        //当前管理员的用户组
        $this->assign('adminGroupInfo',$adminGroupInfo);
        $this->assign('info',$adminUsersInfo);
        $this->display('edit');
    }


    //删除
    public function  del(){
        $id = I('param.id',0,'intval');
        if($id == 0){
            echo  0;
        }else{
            $db = M('jy_admin_users');
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
        exit();
    }
    //启动
    public function start(){
        $id = I('param.id',0,'intval');
        if($id == 0){
            echo 0;
        }else{
            $db = M('jy_admin_users');
            $data  = array('islock'=>1);
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
            $db = M('jy_admin_users');
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

    //验证用户是否存在
    public function Verification(){
        $account =  I('param.account','','trim');
        $id = I('param.id',0,'intval');
        if($account == ''){
            echo 0;
            exit();
        }

        $adminUsers = M('jy_admin_users')
            ->where('account = "'.$account.'" and isdel = 1')
            ->field('id')
            ->find();
        if(empty($adminUsers)){
            echo 1;
            exit();
        }else if ($id == $adminUsers['id']){
            echo 1;
            exit();
        }else{
            echo 2;
            exit();
        }

    }

}