<?php
/****
*  配置下推
**/
namespace Jy_admin\Controller;
use Protos\OptSrc;
use Protos\PBS_ItemOpt;
use Protos\PBS_SendEmail2All;
use Protos\PBS_SendEmail2AllReturn;
use Protos\PBS_SysBroadcastReturn;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;

class PushDownController extends ComController {

    //添加
    public function  add(){
        $ProtoFun =  D('ProtoFun');
        $Com = D('Com');
        $ObjFun = $ProtoFun->ObjFun;
        $catChannelField = array(
            'name',
            'account',
            'id',
        );
        $Versionlist = $Com->GetVersionList();
        if(!$Versionlist){
            $Com->ObjFun->showmessage('服务器出错！');
        }
        $catChannel = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field($catChannelField)
            ->select();
        if(IS_POST){
            $Channel        = I('param.Channel','','trim');
            $Version        = I('param.Version','','trim');
            $Param          = I('param.Param','','trim');
            foreach ($Version as $k=>$v){
                $PushDown  = $ProtoFun->PushDown($Param,$v,$Channel);
            }
            if($PushDown){
                $ObjFun->showmessage('更新成功');
            }else{
                $ObjFun->showmessage('更新失败');
            }
        }
        $this->assign('catChannel',$catChannel);
        $this->assign('Versionlist',$Versionlist);
        $this->display();
    }

}