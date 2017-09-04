<?php
/****
*  用户信息
**/
namespace Jy_admin\Controller;
use Protos\PBS_ItemOpt;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use RedisProto\RPB_PlayerData;
use Think\Controller;
class UsersInfoController extends ComController {
    public function index(){
        $this->display();
    }

}