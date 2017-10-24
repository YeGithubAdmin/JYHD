<?php
/****
*  白名单
**/
namespace Jy_admin\Controller;
use Protos\PBS_AddWhiteList;
use Protos\PBS_AddWhiteListReturn;
use Think\Controller;
class WhiteListController extends ComController {
    public function index(){
        $catWhiteListField = array(
            'Id',
            'Account',
            'DateTime',

        );
        $catWhiteList = M('jy_white_list')
                        ->field($catWhiteListField)
                        ->select();
        $this->assign('info',$catWhiteList);
        $this->display('index');
    }
    //添加
    public function  add(){
        $obj = new \Common\Lib\func();

        if(IS_POST){
            //数据
            $Account =  I('param.Account','','trim');
            $dataWhiteList  = array(
                'Account'     =>      $Account,

            );
            //添加
            $StopService = $this->StopService($Account);

            if(!$StopService){
                $obj->showmessage('系统错误');
            }
            $db = M('jy_white_list');
            $addWhiteList = $db
                            ->add($dataWhiteList);

            if($addWhiteList && $StopService){
                $obj->showmessage('添加成功','/jy_admin/GameConfig/index');
            }else{
                 $obj->showmessage('添加失败');
            }
        }
        $this->display('add');
    }

//    //删除
//    public function  del(){
//        $id = I('param.Id',0,'intval');
//        if($id == 0){
//            echo  0;
//        }else{
//            $db = M('jy_game_config');
//            $info = $db
//                ->where('id = '.$id)
//                ->delete();
//            if($info){
//                echo 1;
//            }else{
//                echo 0;
//            }
//        }
//        exit();
//    }
    //添加白名单
    public function StopService($Account){
        $ObjFun = new \Common\Lib\func();
        //已入protobuf 类
        $ObjFun->ProtobufObj(array(
            'Protos/PBS_AddWhiteList.php',
            'Protos/PBS_AddWhiteListReturn.php',
        ));
        $PBS_AddWhiteList        = new PBS_AddWhiteList();
        $PBS_AddWhiteListReturn  = new PBS_AddWhiteListReturn();
        $PBS_AddWhiteList->setAccountName($Account);
        $String = $PBS_AddWhiteList->serializeToString();
        $Respond =  $ObjFun->ProtobufSend('protos.PBS_AddWhiteList',$String,0);
        if($Respond  == 504){
           return false;

        }
        if(strlen($Respond)==0){
            return false;
        }
        $PBS_AddWhiteListReturn->parseFromString($Respond);
        $ReplyCode = $PBS_AddWhiteListReturn->getCode();
        //判断结果
        if($ReplyCode != 1){
            return false;
        }
        return true;
    }
}