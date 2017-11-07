<?php
namespace Jy_api\Controller;
use Common\Lib\func;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\UsrDataOpt;
use Think\Controller;
class Test2Controller extends Controller {
    public function index(){
           $a = array(
               'Id'=>4,
               'Title'=>"333311111111111",
           );
           $M = M('test')->data($a)->add('',array(),true);
    }
}