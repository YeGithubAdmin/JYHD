<?php
/****
*  跑马灯
**/
namespace Jy_admin\Controller;
use Protos\OptSrc;
use Protos\PBS_ItemOpt;
use Protos\PBS_SysBroadcast;
use Protos\PBS_SysBroadcastReturn;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
class HorseRaceLampController extends ComController {
    public function index(){
        $page = $this->page;
        $num  = $this->num;
        $count  = M('jy_horse_race_lamp')->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $catGameNotice = array(
            'Remark',
            'Status',
            'Content',
            'DateTime',
            'Id',
        );
        $catGameNotice = M('jy_horse_race_lamp')
            ->limit($page*$num,$num)
            ->field($catGameNotice)
            ->select();
        $this->assign('page',$show);
        $this->assign('info',$catGameNotice);
        $this->display('index');
    }
    //添加
    public function  add(){
        $ObjFun = new \Common\Lib\func();
        if(IS_POST){
            $Status = I('param.Status',1,'intval');
            $Content = I('param.Content','','trim');
            $Timing  = I('param.Timing',1,'intval');
            $Btime  = I('param.Btime','','trim');
            $Remark  = I('param.Remark','','trim');
            $dataGameNotice = array(
                'Content' =>    $Content,
                'Status'  =>    $Status,
                'Timing'  =>    $Timing,
                'Remark'  =>    $Remark,
                'Btime'  =>    $Btime,

            );
            if($Status == 2){
                $SendProtoc = $this->SendProtoc($Content);
                if(!$SendProtoc){
                    $ObjFun->showmessage('系统');
                }
            }
            $addGameNotice = M('jy_horse_race_lamp')
                ->add($dataGameNotice);
            if($addGameNotice){
                $ObjFun->showmessage('添加成功',"/jy_admin/notice/index");
            }else{
                $ObjFun->showmessage('添加失败');
            }
        }
        $this->display();

    }
    //修改
    public function edit(){
        $ObjFun = new \Common\Lib\func();
        $Id = I('param.Id',0,'intval');
        if($Id<=0){
            $ObjFun->showmessage('非法操作！');
        }
        $GameNoticeField = array(
            'Id',
            'Content',
            'Status',
            'Remark',
        );
        $catGameNotice = M('jy_horse_race_lamp')
                         ->field($GameNoticeField)
                         ->where('Id = '.$Id)
                         ->find();
        if(IS_POST){
            $Status = I('param.Status',1,'intval');
            $Content = I('param.Content','','trim');
            $Timing  = I('param.Timing',1,'intval');
            $Btime  = I('param.Btime','','trim');
            $Remark  = I('param.Remark','','trim');
            if($Status == 2){
                   $SendProtoc = $this->SendProtoc($Content);
                   if(!$SendProtoc){
                       $ObjFun->showmessage('系统');
                   }
            }
            $dataGameNotice = array(
                'Content' =>    $Content,
                'Status'  =>    $Status,
                'Timing'  =>    $Timing,
                'Remark'  =>    $Remark,
                'Btime'  =>    $Btime,
            );
            $UpGameNotice = M('jy_horse_race_lamp')
                ->where('Id = '.$Id)
                ->save($dataGameNotice);
            if($UpGameNotice){
                $ObjFun->showmessage('修改成功',"/jy_admin/notice/index");
            }else{
                $ObjFun->showmessage('修改失败');
            }
        }
        $this->assign('info',$catGameNotice);
        $this->display();
    }
    //发送
    public function Send(){
        $Id = I('param.Id',0,'intval');
        $Code = 1;
        if($Id<=0){
            $Code = 0;
            goto end;
        }
        //查询信息
        $catGameNoticeFiled = array(
            'Content',
            'Status',
        );
        $catGameNotice = M('jy_horse_race_lamp')
                        ->where('Id = '.$Id)
                        ->field($catGameNoticeFiled)
                        ->find();

        if(empty($catGameNotice)){
            $Code = 0;
            goto end;
        }
        $SendProtoc = $this->SendProtoc($catGameNotice['Content']);
        if(!$SendProtoc){
            $Code = 0;
            goto end;
        }
        if($catGameNotice['Status'] != 2){
            $dataGameNotice = array(
                'Status'=>2,
            );
            $UpGameNotice = M('jy_horse_race_lamp')
                ->where('Id = '.$Id)
                ->save($dataGameNotice);
            if($UpGameNotice === false){
                $Code = 0;
                goto end;
            }
        }
        end:
        echo $Code;
        exit();

    }
    //删除
    public function del(){
        $Id = I('param.Id',0,'intval');
        $Code = 1;
        if($Id<=0){
            $Code = 0;
            goto end;
        }
        $delGameNotice = M('jy_horse_race_lamp')
            ->where('Id = '.$Id)
            ->delete();
        if(!$delGameNotice){
            $Code = 0;
            goto end;
        }
        end:
        echo $Code;
        exit();
    }

    public function  SendProtoc($contet){
        $ObjFun = new \Common\Lib\func();
        //已入protobuf 类
        $ObjFun->ProtobufObj(array(
            'Protos/PBS_SysBroadcast.php',
            'Protos/PBS_SysBroadcastReturn.php',
            'PB_PhpBroadcast.php',
        ));
        $SysBroadcast           =   new PBS_SysBroadcast();
        $SysBroadcastReturn     =   new PBS_SysBroadcastReturn();
        $PhpBroadcast           =   new \PB_PhpBroadcast();
        $PhpBroadcast->setData($contet);
        $SysBroadcast->setPhpBc($PhpBroadcast);
        $String = $SysBroadcast->serializeToString();
        $Respond =  $ObjFun->ProtobufSend('protos.PBS_SysBroadcast',$String,1);
        if(strlen($Respond)==0){
           return false;
        }
        if($Respond  == 504){
            return false;
        }
        $SysBroadcastReturn->parseFromString($Respond);
        $ReplyCode =   $SysBroadcastReturn->getCode();

        if($ReplyCode != 1){
            return false;
        }
        return true;
    }


}