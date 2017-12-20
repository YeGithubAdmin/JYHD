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
        $where = '1';
        $channel = I('param.channel',0,'intval');
        if($channel != 0 ){
            $where  .= '  and   b.id  = "'.$channel.'"';
        }
        $catChannelField = array(
            'name',
            'account',
            'id',
        );
        $catChannel = M('jy_admin_users')
            ->where('channel = 2 and IsDel = 1')
            ->field($catChannelField)
            ->select();

        $count  = M('jy_horse_race_lamp as a')
            ->join('jy_admin_users as b on a.Channel = b.id and b.channel = 2 and IsDel = 1','left')
            ->where($where)->count();
        $Page       = new \Common\Lib\Page($count,$num);    // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();                        // 分页显示输出
        $catGameNoticeFiled = array(
            'a.Remark',
            'a.Status',
            'b.name',
            'a.Content',
            'a.Timing',
            'a.DateTime',
            'a.Btime',
            'a.Id',
        );

        $catGameNotice = M('jy_horse_race_lamp as a')
            ->join('jy_admin_users as b on a.Channel = b.id and b.channel = 2 and IsDel = 1','left')
            ->field($catGameNoticeFiled)
            ->where($where)
            ->limit($page*$num,$num)
            ->select();
        $this->assign('page',$show);
        $this->assign('channel',$channel);
        $this->assign('catChannel',$catChannel);
        $this->assign('info',$catGameNotice);
        $this->display('index');
    }
    //添加
    public function  add(){

        $Com = D('Com');
        $ObjFun =$Com->ObjFun ;
        $Versionlist = $Com->GetVersionList();
        if(!$Versionlist){
            $Com->ObjFun->showmessage('服务器出错！');
        }
        $catChannelField = array(
            'name',
            'account',
            'id',
        );
        $catChannel = M('jy_admin_users')
            ->where('channel = 2 and IsDel = 1')
            ->field($catChannelField)
            ->select();
        if(IS_POST){
            $Status   = I('param.Status',1,'intval');
            $Content  = I('param.Content','','trim');
            $Timing   = I('param.Timing',1,'intval');
            $Btime    = I('param.Btime','','trim');
            $Sort     = I('param.Sort',0,'intval');
            $Channel  = I('param.Channel',0,'intval');
            $Remark   = I('param.Remark','','trim');
            $Version  = I('param.Version','','trim');
            $dataGameNotice = array(
                'Content' =>    $Content,
                'Status'  =>    $Status,
                'Timing'  =>    $Timing,
                'Sort'   =>    $Sort,
                'Channel' =>    $Channel,
                'Remark'  =>    $Remark,
                'Version'  =>    $Version,
            );
            if($Timing == 2){
                $dataGameNotice['Btime'] = $Btime;
            }

            if($Status == 2){
                $ChannelString = M('jy_admin_users')
                    ->where('id = '.$Channel)
                    ->field('account')
                    ->find();
                $SendProtoc = $this->SendProtoc($Content,$ChannelString['account'],$Version);
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
        $this->assign('catChannel',$catChannel);
        $this->assign('Versionlist',$Versionlist);
        $this->display();

    }
    //修改
    public function edit(){
        $Com = D('Com');
        $ObjFun =$Com->ObjFun ;
        $Versionlist = $Com->GetVersionList();
        if(!$Versionlist){
            $Com->ObjFun->showmessage('服务器出错！');
        }
        $Id = I('param.Id',0,'intval');
        $catChannelField = array(
            'name',
            'account',
            'id',
        );
        $catChannel = M('jy_admin_users')
            ->where('channel = 2 and IsDel = 1')
            ->field($catChannelField)
            ->select();
        if($Id<=0){
            $ObjFun->showmessage('非法操作！');
        }
        $GameNoticeField = array(
            'Id',
            'Content',
            'Status',
            'Timing',
            'Channel',
            'Btime',
            'Sort',
            'Remark',
            'Version',
        );
        $catGameNotice = M('jy_horse_race_lamp')
                         ->field($GameNoticeField)
                         ->where('Id = '.$Id)
                         ->find();
        if(IS_POST){
            $Status   = I('param.Status',1,'intval');
            $Content  = I('param.Content','','trim');
            $Timing   = I('param.Timing',1,'intval');
            $Btime    = I('param.Btime','','trim');
            $Sort     = I('param.Sort',0,'intval');
            $Channel  = I('param.Channel',0,'intval');
            $Remark   = I('param.Remark','','trim');
            $Version  = I('param.Version','','trim');
            if($Status == 2){
                    $ChannelString = M('jy_admin_users')->where('id = '.$Channel)->field('account')->find();
                   $SendProtoc = $this->SendProtoc($Content,$ChannelString['account'],$Version);
                   if(!$SendProtoc){
                       $ObjFun->showmessage('系统');
                   }
            }
            $dataGameNotice = array(
                'Content' =>    $Content,
                'Status'  =>    $Status,
                'Timing'  =>    $Timing,
                'Sort'   =>    $Sort,
                'Channel' =>    $Channel,
                'Remark'  =>    $Remark,
                'Version'  =>    $Version,
            );
            if($Timing == 2){
                $dataGameNotice['Btime'] = $Btime;
            }
            $db = M('jy_horse_race_lamp');
            $UpGameNotice = $db
                ->where('Id = '.$Id)
                ->save($dataGameNotice);

            if($UpGameNotice !== false){
                $ObjFun->showmessage('修改成功',"/jy_admin/notice/index");
            }else{
                $ObjFun->showmessage('修改失败');
            }
        }
        $this->assign('info',$catGameNotice);
        $this->assign('catChannel',$catChannel);
        $this->assign('Versionlist',$Versionlist);
        $this->display();
    }
    //发送
    public function Send(){
        $Id      = I('param.Id',0,'intval');
        $type    = I('param.Type',1,'intval');
        $Code = 1;
        if($Id<=0){
            $Code = 0;
            goto end;
        }
        //查询信息
        $catGameNoticeFiled = array(
            'b.account as Channel',
            'a.Content',
            'a.Status',
            'a.Version',
        );
        $catGameNotice = M('jy_horse_race_lamp as a')
                        ->join('jy_admin_users as b on a.Channel =  b.id and b.Isdel = 1','left')
                        ->where('a.Id = '.$Id)
                        ->field($catGameNoticeFiled)
                        ->find();
        if(empty($catGameNotice)){
            $Code = 0;
            goto end;
        }

        $SendProtoc = $this->SendProtoc($catGameNotice['Content'],$catGameNotice['Channel'],$catGameNotice['Version']);
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

    public function  SendProtoc($contet,$Channel,$Version){
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
        if($Channel){
            $SysBroadcast->setChannel($Channel);
        }else{
            $SysBroadcast->setChannel('global');
        }
        $SysBroadcast->setPhpBc($PhpBroadcast);
        $String = $SysBroadcast->serializeToString();
        $Header = array(
            'PBName:'.'protos.PBS_SysBroadcast',
            'PBSize:'.strlen($String),
            'UID:1',
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$Version,
        );
        $Respond =  $ObjFun->ProtobufSend($Header,$String);
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