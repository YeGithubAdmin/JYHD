<?php
/****
*  主页
**/
namespace Jy_admin\Controller;
use Think\Controller;
class IndexController extends ComController {
    public function index(){
        $userInfo  = $this->userInfo;
        //已入方法类
        $obj = new \Common\Lib\func();
        //管理组
        //所有菜单
        $menuAll   = M('jy_system_menu')
            ->where('islock = 1')
            ->order('sort asc')
            ->field('id,name,icon,upid,url,icon')
            ->select();

        //过滤权限  type   1-普通用户  2-默认账号
        $admingroupMenu = array();
        if($userInfo['default'] == 2){
            $admingroupMenu = $menuAll;
        }else{
            $admingroup =  M('jy_admin_group')
                ->where('id = '.$userInfo['admingroup'])
                ->find();
            $authority = json_decode($admingroup['authority'],true);
            foreach ($menuAll as $key => $val){
                if(in_array($val['id'],$authority)){
                    $admingroupMenu[] = $val;
                }
            }
        }
        $newMenuAll = $obj->make_tree($admingroupMenu);
        $this->assign('menuList',$newMenuAll);
        $this->assign('userInfo',$userInfo);
        $this->display('index');

    }


}