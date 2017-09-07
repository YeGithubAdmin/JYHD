<?php
/***
* 注册宏观数据
***/
namespace Jy_Script\Controller;
use Think\Controller;
class RegisterMacroscopicController extends Controller {
    public function index(){
        $time = date('Y-m-d',time());
        $time = date('Y-m-d',strtotime($time)-24*60*60);



    }
}