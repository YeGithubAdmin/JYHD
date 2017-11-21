<?php
/***
*
**/
namespace Jy_Test\Controller;
use Think\Controller;
class TestController extends Controller {
    public  function  index(){
          $catData = M('test')->select();
         dump($catData);
    }
}