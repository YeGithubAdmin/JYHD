<?php
/****
*  游戏配置
**/
namespace Jy_admin\Controller;
use Protos\PBS_ServerRegisterReturn;
use Protos\PBS_SetServerState;
use Protos\PBS_SetServerStateReturn;
use Think\Controller;
class GameConfigController extends ComController {
    public function index(){
        $catGameCofingField = array(
            'a.Id',
            'b.name',
            'a.Channel',
            'a.Status',
            'a.StopService',
            'a.StopPay',
            'a.Type',
        );
        $catGameCofing = M('jy_game_config as a')
                        ->join('jy_admin_users as b on a.Channel = b.Id','left')
                        ->field($catGameCofingField)
                        ->select();
        $this->assign('info',$catGameCofing);
        $this->display('index');
    }
    //添加
    public function  add(){
        $obj = new \Common\Lib\func();
        $catChannelField = array(
            'name',
            'account',
            'id',
        );
        $catChannel = M('jy_admin_users')
            ->where('channel = 2')
            ->field($catChannelField)
            ->select();
        if(IS_POST){
            //数据
            $StopService =  I('param.StopService',1,'intval');
            $StopPay =  I('param.StopPay',1,'intval');
            $Type =  I('param.Type',1,'intval');
            $Second =  I('param.Second',0,'intval');
            $Status=  I('param.Status',1,'intval');
            $Channel =  I('param.Channel','','trim');
            if($Type == 1){
                $Channel = '';
            }
            $dataGameCofing  = array(
                'StopService'     =>      $StopService,
                'StopPay'         =>      $StopPay,
                'Type'            =>      $Type,
                'Status'          =>      $Status,
                'Second'          =>      $Second,
                'Channel'         =>      $Channel,
            );

            if($Status == 2){
                      $StopServiceFun = $this->StopService($StopService,$Channel,$Second);
                      if(!$StopServiceFun){
                          $obj->showmessage('系统错误');
                      }
            }
            //添加
            $db = M('jy_game_config');
            $addGameCofing = $db
                            ->add($dataGameCofing);
            if($addGameCofing){
                $obj->showmessage('添加成功','/jy_admin/GameConfig/index');
            }else{
                 $obj->showmessage('添加失败');
            }
        }
        $this->assign('catChannel',$catChannel);
        $this->display('add');
    }
    //修改
    public function edit(){
        $obj = new \Common\Lib\func();
        $Id = I('param.Id',0,'intval');
        if($Id<=0){
            $obj->showmessage('非法操作');
        }
        $catGameCofingField = array(
            'StopService',
            'StopPay',
            'Type',
            'Second',
            'Status',
            'Channel',
            'Id',
        );
        $catGameCofing = M('jy_game_config')
            ->where('Id = '.$Id)
            ->field($catGameCofingField)
            ->find();
        $catChannelField = array(
            'name',
            'account',
            'id',
        );
        $catChannel = M('jy_admin_users')
            ->where('channel = 2')
            ->field($catChannelField)
            ->select();
        if(IS_POST){
            $StopService =  I('param.StopService',1,'intval');
            $StopPay =  I('param.StopPay',1,'intval');
            $Second =  I('param.Second',0,'intval');
            $Type =  I('param.Type',1,'intval');
            $Channel =  I('param.Channel','','trim');
            $Status=  I('param.Status',3,'intval');
            $dataGameCofing  = array(
                'StopService'     =>      $StopService,
                'StopPay'         =>      $StopPay,
                'Type'            =>      $Type,
                'Status'          =>      $Status,
                'Second'          =>      $Second,
                'Channel'         =>      $Channel,
            );
            if($Status == 2){
                $StopServiceFun = $this->StopService($StopService,$Channel,$Second);
                if(!$StopServiceFun){
                    $obj->showmessage('系统错误');
                }
            }
            $upGameCofing = M('jy_game_config')
                ->where('Id = '.$Id)
                ->save($dataGameCofing);
            if($upGameCofing !== false){
                $obj->showmessage('修改成功','/jy_admin/GameConfig/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }
        $this->assign('catChannel',$catChannel);
        $this->assign('info',$catGameCofing);
        $this->display('edit');
    }
    //删除
    public function  del(){
        $id = I('param.Id',0,'intval');
        if($id == 0){
            echo  0;
        }else{
            $db = M('jy_game_config');
            $info = $db
                ->where('id = '.$id)
                ->delete();
            if($info){
                echo 1;
            }else{
                echo 0;
            }
        }
        exit();
    }
    public function StopService($state,$channel,$after_second){
        $ObjFun = new \Common\Lib\func();
        //已入protobuf 类
        $ObjFun->ProtobufObj(array(
            'Protos/PBS_SetServerState.php',
            'Protos/PBS_SetServerStateReturn.php',
        ));
        $PBS_SetServerState         = new  PBS_SetServerState();
        $PBS_SetServerStateReturn   = new  PBS_SetServerStateReturn();
        $PBS_SetServerState->setState($state);
        if($channel != '' ){
            $PBS_SetServerState->setChannel($channel);
        }else{
            $PBS_SetServerState->setChannel('global');
        }

        $PBS_SetServerState->setAfterSecond($after_second);

        $String = $PBS_SetServerState->serializeToString();
        $Respond =  $ObjFun->ProtobufSend('protos.PBS_SetServerState',$String,1);
        if(strlen($Respond)==0){
            return false;
        }
        if($Respond  == 504){
            return false;
        }
        $PBS_SetServerStateReturn->parseFromString($Respond);
        $ReplyCode =   $PBS_SetServerStateReturn->getCode();
        if($ReplyCode != 1){
            return false;
        }
        return true;
    }



}