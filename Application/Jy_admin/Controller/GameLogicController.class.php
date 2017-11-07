<?php
/****
*  游戏逻辑
**/
namespace Jy_admin\Controller;
use Protos\PBS_gm_fish_op;
use Protos\PBS_gm_fish_return;
use Think\Controller;
class GameLogicController extends ComController {
    public function index(){
        $catcatGameLogicField = array(
              'Type',
              'Status',
              'AdminID',
              'AdminName',
              'DateTime',
        );
        $catGameLogic= M('conf_game_logic')
                        ->field($catcatGameLogicField)
                        ->select();
        $this->assign('info',$catGameLogic);
        $this->display('index');
    }
    //添加
    public  function add(){
        $obj = new \Common\Lib\func();
        $userInfo = $this->userInfo;
        if(IS_POST){
            $Type       =   I('param.Type','','trim');
            $Status     =   I('param.Status',1,'intval');
            $ServerID   =   I('param.ServerID','','trim');
            $IsGive     =   I('param.IsGive',1,'intval');
            $AdminID    =   $userInfo['id'];
            $AdminName  =   $userInfo['name'];
            $dataGameLogic = array(
                'Type'      =>  $Type,
                'Status'    =>  $Status,
                'AdminID'   =>  $AdminID,
                'AdminName' =>  $AdminName,
            );

            if($IsGive == 1){
                $ServerID = array();
            }


            $Res = $this->OptServer($Type,$Status,$ServerID);
            if(!$Res){
                $obj->showmessage('系统错误');
            }
            $addGameLogic = M('conf_game_logic')
                ->add($dataGameLogic);

            if($addGameLogic){
                $obj->showmessage('操作成功！','/jy_admin/GameLogic/index');
            }else{
                $obj->showmessage('操作失败！');
            }
        }
        $this->display();
    }
    //修改
    public function  edit(){
        $obj = new \Common\Lib\func();
        $Type       =   I('param.Type','','trim');
        $userInfo = $this->userInfo;
        if($Type == ''){
            $obj->showmessage('非法操作');
        }
        //查询信息
        $catGameLogicField = array(
            'Type',
            'Status',
            'AdminID',
            'AdminName',
        );
        $catGameLogic = M('conf_game_logic')
                        ->where('Type = "'.$Type.'"')
                        ->field($catGameLogicField)
                        ->find();
        if(IS_POST){
            $Status     =   I('param.Status',1,'intval');
            $ServerID   =   I('param.ServerID','','trim');
            $AdminID    =   $userInfo['id'];
            $AdminName  =   $userInfo['name'];
            $IsGive     =   I('param.IsGive',1,'intval');
            $dataGameLogic = array(
                'Status'    =>  $Status,
                'AdminID'   =>  $AdminID,
                'AdminName' =>  $AdminName,
            );
            if($IsGive == 1){
                $ServerID = array();
            }
            $Res = $this->OptServer($Type,$Status,$ServerID);
            if(!$Res){
                $obj->showmessage('系统错误');
            }
            $upGameLogic = M('conf_game_logic')
                ->where('Type = "'.$Type.'"')
                ->save($dataGameLogic);
            if($upGameLogic !== false){
                $obj->showmessage('操作成功！','/jy_admin/GameLogic/index');
            }else{
                $obj->showmessage('操作失败！');
            }
        }
        $this->assign('info',$catGameLogic);
        $this->display();
    }
    //删除
    public function  del(){
        $Type       =   I('param.Type','','trim');
       $Code = 1;
       if($Type == ''){
           $Code = 0;
           goto End;
       }
       $delGameLogic = M('conf_game_logic')
                       ->where('Type = "'.$Type.'"')
                       ->delete();
       if(!$delGameLogic){
            $Code = 0;
            goto  End;
       }
       End:
            echo $Code;
            exit();
    }
    //服务器操作
    public  function  OptServer($key,$value,$ServerID){
        $obj = new \Common\Lib\func();
        $obj->ProtobufObj(array(
            'Protos/PBS_gm_fish_op.php',
            'Protos/PBS_gm_fish_return.php',
        ));
        $GmFishOp           = new PBS_gm_fish_op();
        $GmFishOpReturn     = new PBS_gm_fish_return();
        $GmFishOp->setKey($key);
        $GmFishOp->setValue($value);
        if(!empty($ServerID)){
            foreach ($ServerID as $k=>$v){
                $GmFishOp->appendServerid($v);
            }
        }

        $String = $GmFishOp->serializeToString();
        $Respond =  $obj->ProtobufSend('protos.PBS_gm_fish_op',$String,1);
        if(strlen($Respond)==0){
            return false;
        }
        if($Respond  == 504){
            return false;
        }
        $GmFishOpReturn->parseFromString($Respond);
        $ReplyCode =   $GmFishOpReturn->getCode();
        if($ReplyCode != 1){
            return false;
        }
        return true;
    }
    //检测
    public function Inspect(){
           $Type = I('param.Type','','trim');
           $Code = 1;
           if($Type == '' ){
               $Code = 0;
               goto End;
           }
           $catData = M('conf_game_logic')
                      ->where('Type ="'.$Type.'"')
                      ->field('Type')
                      ->find();
           if(!empty($catData)){
               $Code = 2;
           }
           End:
             echo  $Code;
             exit();
    }
}