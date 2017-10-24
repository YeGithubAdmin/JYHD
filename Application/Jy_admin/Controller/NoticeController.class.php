<?php
/****
*  游戏公告
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
class NoticeController extends ComController {
    public function index(){
        $page = $this->page;
        $num  = $this->num;
        //渠道号
        $channel = I('param.channel',0,'intval');
        $where = '1';
        if($channel != 0 ){
            $where  .= '  and   b.id  = "'.$channel.'"';
        }
        $count  = M('jy_game_notice as a')
                  ->join('jy_admin_users as b on a.Channel = b.id and b.channel = 2')
                  ->where($where)->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $catChannelField = array(
            'name',
            'account',
            'id',
        );
        $catChannel = M('jy_admin_users')
                      ->where('channel = 2')
                      ->field($catChannelField)
                      ->select();
        $catGameNotice = array(
            'a.Title',
            'a.Remark',
            'b.name',
            'a.Status',
            'a.DateTime',
            'a.Id',
        );
        $catGameNotice = M('jy_game_notice as a')
            ->join('jy_admin_users as b on a.Channel = b.id and b.channel = 2','left')
            ->field($catGameNotice)
            ->where($where)
            ->order('a.Sort desc','a.Num asc')
            ->limit($page*$num,$num)
            ->select();
        $this->assign('page',$show);
        $this->assign('catChannel',$catChannel);
        $this->assign('channel',$channel);
        $this->assign('info',$catGameNotice);
        $this->display('index');
    }
    //添加
    public function  add(){
        $ObjFun = new \Common\Lib\func();
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
            $SendEmail      = I('param.SendEmail',1,'intval');
            $Status         = I('param.Status',1,'intval');
            $EmailContent   = I('param.EmailContent','','trim');
            $TitleContent   = I('param.TitleContent','','trim');
            $Content        = I('param.Content','','trim');
            $Title          = I('param.Title','','trim');
            $TitleSon       = I('param.TitleSon','','trim');
            $Sort           = I('param.Sort',1,'intval');
            $Num            = I('param.Num',1,'intval');
            $Channel        = I('param.Channel',0,'intval');
            $Btime          = I('param.Btime','','trim');
            $Remark         = I('param.Remark','','trim');
            $dataGameNotice = array(
                'Content'       =>    $Content,
                'SendEmail'     =>    $SendEmail,
                'EmailContent'  =>    $EmailContent,
                'TitleContent'  =>    $TitleContent,
                'Status'        =>    $Status,
                'Btime'         =>    $Btime,
                'TitleSon'      =>    $TitleSon,
                'Num'           =>    $Num,
                'Channel'       =>    $Channel,
                'Title'         =>    $Title,
                'Remark'        =>    $Remark,
                'Sort'          =>    $Sort,
            );
            //发送邮件
            if($SendEmail == 2){
                $ChannelString = M('jy_admin_users')->where('id = '.$Channel)->field('account')->find();
                $sendMail  =  $this->sendMail($EmailContent,$ChannelString['account'],$TitleContent);
                if(!$sendMail){
                    $ObjFun->showmessage('发送邮件异常');
                }
            }
            $addGameNotice = M('jy_game_notice')
                ->add($dataGameNotice);
            if($addGameNotice){
                $ObjFun->showmessage('添加成功',"/jy_admin/notice/index");
            }else{
                $ObjFun->showmessage('添加失败');
            }
        }
        $this->assign('catChannel',$catChannel);
        $this->display();

    }
    //修改
    public function edit(){
        $ObjFun = new \Common\Lib\func();
        $Id = I('param.Id',0,'intval');
        $catChannelField = array(
            'name',
            'account',
            'id',
        );
        $catChannel = M('jy_admin_users')
            ->where('channel = 2')
            ->field($catChannelField)
            ->select();
        if($Id<=0){
            $ObjFun->showmessage('非法操作！');
        }
        $GameNoticeField = array(
            'Id',
            'Content',
            'Sort',
            'Status',
            'Num',
            'SendEmail',
            'EmailContent',
            'TitleContent',
            'TitleSon',
            'Channel',
            'Btime',
            'Title',
            'Remark',
        );
        $catGameNotice = M('jy_game_notice')
                         ->field($GameNoticeField)
                         ->where('Id = '.$Id)
                         ->find();
        if(IS_POST){
            $SendEmail      = I('param.SendEmail',1,'intval');
            $Status         = I('param.Status',1,'intval');
            $EmailContent   = I('param.EmailContent','','trim');
            $TitleContent   = I('param.TitleContent','','trim');
            $Content        = I('param.Content','','trim');
            $Title          = I('param.Title','','trim');
            $TitleSon       = I('param.TitleSon','','trim');
            $Sort           = I('param.Sort',1,'intval');
            $Num            = I('param.Num',1,'intval');
            $Channel        = I('param.Channel',0,'intval');
            $Btime          = I('param.Btime','','trim');
            $Remark         = I('param.Remark','','trim');
            $dataGameNotice = array(
                'SendEmail' => $SendEmail,
                'Content'   =>    $Content,
                'EmailContent' =>$EmailContent,
                'TitleContent' =>$TitleContent,
                'Status'    =>    $Status,
                'Btime'     =>    $Btime,
                'TitleSon'  =>    $TitleSon,
                'Num'       =>    $Num,
                'Channel'   =>    $Channel,
                'Title'     =>    $Title,
                'Remark'    =>    $Remark,
                'Sort'      =>    $Sort,
            );
            //发送邮件
            if($SendEmail == 2){
                $ChannelString = M('jy_admin_users')->where('id = '.$Channel)->field('account')->find();
                $sendMail  =  $this->sendMail($EmailContent,$ChannelString['account'],$TitleContent);
                if(!$sendMail){
                    $ObjFun->showmessage('发送邮件异常');
                }
            }

            $UpGameNotice = M('jy_game_notice')
                ->where('Id = '.$Id)
                ->save($dataGameNotice);
            if($UpGameNotice !== false ){
                $ObjFun->showmessage('修改成功',"/jy_admin/notice/index");
            }else{
                $ObjFun->showmessage('修改失败');
            }
        }
        $this->assign('catChannel',$catChannel);
        $this->assign('info',$catGameNotice);
        $this->display();
    }
    //发布
    public function start(){
        $Id = I('param.Id',0,'intval');
        $Code = 1;
        if($Id<=0){
            $Code = 0;
            goto end;
        }
        $dataGameNotice = array(
            'Status'=>2,
        );
        $UpGameNotice = M('jy_game_notice')
                        ->where('Id = '.$Id)
                        ->save($dataGameNotice);
        if(!$UpGameNotice){
            $Code = 0;
            goto end;
        }
        end:
        echo $Code;
        exit();

    }
    //停止发布
    public function stop(){
        $Id = I('param.Id',0,'intval');
        $Code = 1;
        if($Id<=0){
            $Code = 0;
            goto end;
        }
        $dataGameNotice = array(
            'Status'=>1,
        );
        $UpGameNotice = M('jy_game_notice')
            ->where('Id = '.$Id)
            ->save($dataGameNotice);
        if(!$UpGameNotice){
            $Code = 0;
            goto end;
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
        $delGameNotice = M('jy_game_notice')
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


    //删除
    public function authority(){
        $ObjFun = new \Common\Lib\func();
        $Id = I('param.Id',0,'intval');
        if($Id<=0){
            $ObjFun->showmessage('非法操作');
        }
        $catGameNoticeField = array(
            'Content',
        );
        $catGameNotice = M('jy_game_notice')
            ->where('Id = '.$Id)
            ->field($catGameNoticeField)
            ->find();
        $this->assign('info',$catGameNotice);
        $this->display();
    }

    //发送邮件
    public function  sendMail($content,$channel,$title){
        $ObjFun = new \Common\Lib\func();
        //已入protobuf 类
        $ObjFun->ProtobufObj(array(
            'Protos/PBS_SendEmail2All.php',
            'Protos/PBS_SendEmail2AllReturn.php',
            'PB_Email.php',
            'EmailType.php',
        ));
        $PB_Email                   =   new \PB_Email();
        $PBS_SendEmail2All          =   new  PBS_SendEmail2All();
        $PBS_SendEmail2AllReturn    =   new  PBS_SendEmail2AllReturn();
        $EmailType                  =   new  \EmailType();
        $PB_Email->setType($EmailType::EmailType_Sys);
        $PB_Email->setTitle($title);
        if($channel){
            $PBS_SendEmail2All->setChannel($channel);
        }else{
            $PBS_SendEmail2All->setChannel('global');
        }
        $PB_Email->setData($content);
        $PBS_SendEmail2All->setSendEmail($PB_Email);




        $String = $PBS_SendEmail2All->serializeToString();
        $Respond =  $ObjFun->ProtobufSend('protos.PBS_SendEmail2All',$String,1);
        if(strlen($Respond)==0){
            return false;
        }
        if($Respond  == 504){
            return false;
        }
        $PBS_SendEmail2AllReturn->parseFromString($Respond);
        $ReplyCode =   $PBS_SendEmail2AllReturn->getCode();
        if($ReplyCode != 1){
            return false;
        }
        return true;
    }




}