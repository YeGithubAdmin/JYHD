<?php
/****
* 小游戏开关
**/
namespace Jy_admin\Controller;
use Think\Controller;
class MiniGameController extends ComController {
    public function index(){
        $obj = new \Common\Lib\func();
        $Channel = I('param.Channel','','trim');
        if($Channel ==''){
            $obj->showmessage('非法操作');
        }
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $where = 'Channel = "'.$Channel.'"';
        $count  = M('conf_mini_game_switch')->where($where)->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $catData = M('conf_mini_game_switch')
            ->where($where)
            ->limit($page*$num,$num)
            ->select();
        foreach ($catData as $k=>$v){
            $Game= array();
            foreach (json_decode($v['Game'],true) as $key=>$val){
                    switch ($val){
                        //水浒传
                        case 'WaterMargin':
                            $Game[] = "水浒传";
                            break;
                        //红黑牌
                        case 'RedBlackCard':
                            $Game[] = "红黑牌";
                            break;
                    }
            }
            $catData[$k]['Game'] = implode('、',$Game);
        }
        $this->assign('page',$show);
        $this->assign('info',$catData);
        $this->assign('Channel',$Channel);
        $this->display('index');

    }
    //添加
    public function  add(){
        $userInfo       = $this->userInfo;          //用户信息
        $obj = new \Common\Lib\func();
       // $MiniGame = D('MiniGame');

        $Channel = I('param.Channel','','trim');
        if($Channel == ''){
            $obj->showmessage('非法操作');
        }
        //小游戏
        $GameList = M('conf_mini_game')
                    ->where('IsLock = 1 and IsDel = 1')
                    ->field(
                        array(
                            'Name',
                            'Code',
                        )
                    )
                    ->select();

        //版本
        $GameVersion = M('jy_game_version')
                       ->field(
                           array(
                               'Version'
                           )
                       )
                       ->select();
        if(IS_POST){
            $Version    =  I('param.Version','','trim');
            $Stauts     =  I('param.Status',1,'intval');
            $Game       =  json_encode(I('param.Game','','trim'));
            $VipLevel   =  I('param.VipLevel',0,'intval');
            $GameLevel  =  I('param.GameLevel',0,'intval');
            if($Stauts == 1){
                $Game       = '';
                $VipLevel   = 0;
                $GameLevel  = 0;
            }
            $Data = array(
                'Channel'       =>  $Channel,
                'Game'          =>  $Game,
                'VipLevel'      =>  $VipLevel,
                'GameLevel'     =>  $GameLevel,
                'Status'        =>  $Stauts,
                'Version'       =>  $Version,
                'Remark'        =>  I('param.Remark','','trim'),
                'AName'         =>  $userInfo['name'],
                'AId'           =>  $userInfo['id'],
                'ConfStatus'    =>  I('param.ConfStatus',1,'intval'),
            );
            //添加
            $addData = M('conf_mini_game_switch')
                ->add($Data);
            if($addData){
                $obj->showmessage('添加成功','/jy_admin/MiniGame/index');
            }else{
                $obj->showmessage('添加失败');
            }
        }
        $this->assign('GameList',$GameList);
        $this->assign('Channel',$Channel);
        $this->assign('GameVersion',$GameVersion);
        $this->display('add');
    }
    //修改
    public function edit(){
        $userInfo       = $this->userInfo;          //用户信息
        $obj = new \Common\Lib\func();
       // $MiniGame = D('MiniGame');
        $Id = I('param.Id',0,'intval');
        if($Id <= 0){
            $obj->showmessage('非法操作');
        }
        //小游戏
        $GameList = M('conf_mini_game')
            ->where('IsLock = 1 and IsDel = 1')
            ->field(
                array(
                    'Name',
                    'Code',
                )
            )
            ->select();
        //版本
        $GameVersion = M('jy_game_version')
            ->field(
                array(
                    'Version'
                )
            )
            ->select();
        //查询信息
        $catData = M('conf_mini_game_switch')
                   ->where('Id = '.$Id)
                   ->field(array(
                       'Game',
                       'VipLevel',
                       'GameLevel',
                       'Version',
                       'Status',
                       'Id',
                   ))
                    ->find();
        if(!empty($catData)){
            $catData['Game'] = json_decode( $catData['Game']);
        }
        if(IS_POST){
            $Stauts     =  I('param.Status',1,'intval');
            $Game       =  json_encode(I('param.Game','','trim'));
            $VipLevel   =  I('param.VipLevel',0,'intval');
            $GameLevel  =  I('param.GameLevel',0,'intval');
            if($Stauts == 1){
                $Game       = '';
                $VipLevel   = 0;
                $GameLevel  = 0;
            }
            $Data = array(
                'Game'          =>  $Game,
                'VipLevel'      =>  $VipLevel,
                'GameLevel'     =>  $GameLevel,
                'Remark'        =>  I('param.Remark','','trim'),
                'Status'        =>  $Stauts,
                'AName'         =>  $userInfo['name'],
                'AId'           =>  $userInfo['id'],
                'ConfStatus'    =>  I('param.ConfStatus',1,'intval'),
            );
            //$Push = $MiniGame->Push($obj,$Version);
            $UpData = M('conf_mini_game_switch')
                ->where('Id = '.$Id)->save($Data);
            if($UpData !== false){
                $obj->showmessage('修改成功','/jy_admin/MiniGame/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }
        $this->assign('GameList',$GameList);
        $this->assign('GameVersion',$GameVersion);
        $this->assign('info',$catData);
        $this->display();
    }
    //删除
    public function  del(){
        $Id = I('param.Id',0,'intval');
        if($Id < 0){
            echo  0;
        }else{
            $db = M('conf_mini_game_switch');
            $info = $db
                ->where('Id = '.$Id)
                ->delete();
            if($info){
                echo 1;
            }else{
                echo 0;
            }
        }
        exit();
    }
    //验证是否存在
    public function Verification(){
        $Channel = I('param.Channel','','trim');
        $Version = I('param.Version','','trim');
        if($Channel  == '' || $Version ==''){
            echo 0;
            exit();
        }
        $catData = M('conf_mini_game_switch')
            ->where('Channel = "'.$Channel.'" and   Version = "'.$Version.'"')
            ->field('Id')
            ->find();
        if(empty($catData)){
            echo 1;
            exit();
        }else{
            echo 2;
            exit();
        }
    }


}