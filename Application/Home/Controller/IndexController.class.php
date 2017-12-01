<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $obj = new \Common\Lib\func();


        $key  =  C('AesKey');
        print_r($key);
        $data = '312321';


        $a =  $obj->Encrypted($data,$key);
        echo $a;
        echo '<br/>';
        echo  $obj->Decrypt($a,$key);

    }



}