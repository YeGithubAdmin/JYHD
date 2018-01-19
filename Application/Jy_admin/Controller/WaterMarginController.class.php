<?php
/****
*   水浒装数值
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

class WaterMarginController extends ComController {
    public function index(){
        $Com = D('Com');
        $obj =$Com->ObjFun ;
        $Versionlist = $Com->GetVersionList();
        if(!$Versionlist){
            $Com->ObjFun->showmessage('服务器出错！');
        }
        $Serverid = I('param.Serverid',0,'intval');
        $Version  = I('param.Version','','trim');

        if($Serverid != 0 && $Version !='' ){
            $GetModel = D('WaterMargin');
            $infoVal = $GetModel->GetVal($Serverid,$obj,$Version);
        }
        if(IS_POST){
            if($Serverid != 0 && $Version !='' ){
                $GetModel = D('WaterMargin');
                $SetVal =  $GetModel->SetVal($Serverid,$obj,$Version);
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
        $this->assign('Version',$Version);
        $this->assign('Versionlist',$Versionlist);
        $this->display();
    }





}