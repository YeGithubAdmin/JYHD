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
        $Com = D('Com');
        $obj =$Com->ObjFun ;
        $Versionlist = $Com->GetVersionList();
        if(!$Versionlist){
            $obj->showmessage('服务器出错！');
        }

        if(IS_POST){
            //数据
            $Account =  I('param.Account','','trim');
            $Version =  I('param.Version','','trim');
            $dataWhiteList  = array(
                'Account'     =>      $Account,
                'Version'     =>      $Version,

            );
            //添加
            $StopService = $this->StopService($Account,$Version);
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
        $this->assign('Versionlist',$Versionlist);
        $this->display('add');
    }


    //添加白名单
    public function StopService($Account,$Version){
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
        $Header = array(
            'PBName:'.'protos.PBS_AddWhiteList',
            'PBSize:'.strlen($String),
            'UID:1',
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$Version,
        );
        $Respond =  $ObjFun->ProtobufSend($Header,$String);
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