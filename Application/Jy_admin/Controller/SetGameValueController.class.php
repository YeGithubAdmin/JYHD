<?php
/****
*  游戏数值
**/
namespace Jy_admin\Controller;
use Protos\game_numerical;
use Protos\PBS_gm_numerical_op_return;
use Protos\game_numerical_const_boss_rate_params;
use Protos\game_numerical_const_down_grade;
use Protos\game_numerical_const_fish_card_rate;
use Protos\game_numerical_const_key_recharge_effect;
use Protos\game_numerical_const_recharge_effect;
use Protos\game_numerical_const_return_gold_rate;
use Protos\PBS_gm_numerical_op;
use Protos\PBS_gm_numerical_require;
use Protos\PBS_gm_numerical_require_return;

class SetGameValueController extends ComController {
    public function index(){
        $obj = new \Common\Lib\func();
        $Serverid = I('param.Serverid',0,'intval');
        if($Serverid != 0){
            $GetModel = D('SetGameValue');
            $infoVal = $GetModel->GetVal($Serverid,$obj);
        }
        if(IS_POST){
            $platform       =       I('param.platform',2,'intval');
            if($platform == 1){
                define('SERVER_PROTO_IOS', 'http://172.18.238.60');
            }
            if($Serverid != 0){
                $GetModel = D('SetGameValue');
                $SetVal =  $GetModel->SetVal($Serverid,$obj);
            }else{
                $obj->showmessage('服务器ID');
            }
            if($SetVal){
                $obj->showmessage('设置成功');
            }else{
                $obj->showmessage('设置失败');
            }
        }
        $this->assign('info',$infoVal);
        $this->assign('Serverid',$Serverid);
        $this->display();
    }





}