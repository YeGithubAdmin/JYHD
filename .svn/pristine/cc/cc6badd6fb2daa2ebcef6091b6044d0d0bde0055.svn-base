<?php
/***
*  登陆
**/
namespace Jy_admin\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class LoginController extends ComController {
    public function sign(){
        $obj = new \Common\Lib\func();
        $userInfo = session('userInfo');

        if(!empty($userInfo['name'])){
            header("Location:/jy_admin/index/index");
        }
      
        if(IS_POST){
            $code= I('param.vcode','','trim');
            $username = I('param.username','','trim');
            $password = I('param.passwd','','trim,md5');
            $codes = $this->check_verify($code);
            $result  =  1;
            $msg     = '';
            if($codes){
                //判断用户

                $adminInfo = M('jy_admin_users')
                            ->where('account = "%s"',$username)
                            ->field('id,name,account,passwd,default,islock,islock as grouplock,admingroup')
                            ->find();
                if(empty($adminInfo) || $adminInfo['default'] == 1){
                    $adminInfo = M('jy_admin_users as a')
                        ->join('jy_admin_group as b')
                        ->where('a.account = "%s" and a.isdel = 1',$username)
                        ->field('a.id,a.name,a.account,a.passwd,a.admingroup,a.default,b.del,b.edit,b.add,a.channel,a.islock,a.mtime,b.name as adminGroupName,b.islock as grouplock')
                        ->find();
                }


                if(!empty($adminInfo)){
                    //判断密码
                    if($adminInfo['passwd'] == $password){
                        if($adminInfo['islock'] == 1 && $adminInfo['grouplock'] == 1){
                            $adminInfo['channel'] = 1;
                            session('userInfo',$adminInfo);

                        }else{
                            //被锁定
                            $obj->showmessage('该用户被管理锁定，暂时禁止登陆请与管理员联系');
                            $msg = '该用户被管理锁定，暂时禁止登陆请与管理员联系';
                            $result = 2;
                        }
                    }else{
                       //密码错误
                        $msg = '密码错误';
                        $result = 2;
                    }

                }else{
                    //用户不存在
                    $msg = '用户不存在';
                    $result = 2;

                }
            }else{
                //验证码错误

                $msg = '验证码错误';
                $result = 2;

            }

            echo json_encode(array(
                                'result'=>$result,
                                'msg'=>$msg,
                            ));
            die;
        }



        $this->display();
    }

    //验证码
    public function code(){

        header('Content-type: image/png');
        $config =    array(
            'imageW'    =>    100,    // 验证码字体大小
            'fontSize'  =>   14,
            'length'      =>    4,     // 验证码位数
            'imageH'    =>    41, // 关闭验证码杂点
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
    public function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
    //退出登录
    public  function  signout(){
        session('userInfo',null);
        header("Location:/jy_admin/login/index");
    }
}