<?php
/****
*  游戏数值
**/
namespace Jy_statistics\Controller;
use Protos\PBS_GetGameNumerical;
use Protos\PBS_GetGameNumericalReturn;
use Protos\PBS_ItemOpt;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;

class GameValueController extends ComController {
    public function index(){
        $obj = new  \Common\Lib\func();
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $Day = 24*60*60;

        $time = strtotime(date('Y-m-d',time()));
        $StartTime = date("Y-m-d",$time-$Day*29);
        $EndTime   =  date("Y-m-d",$time);
        $search['datemin']                   =      I('param.datemin',$StartTime,'trim');                 //注册时间
        $search['datemax']                   =      I('param.datemax',$EndTime,'trim');                 //注册时间
        $search['Status']                    =      I('param.Status',0,'intval');                 //游戏状态
        $search['VerSion']                   =      I('param.VerSion','','trim');                 //脚本游戏版本
        $search['PackageVersion']            =      I('param.PackageVersion','','trim');                 //脚本游戏版本
        $search['Channel']                   =      I('param.regchannel','','trim');              //渠道
        $search['num']                       =      I('param.num',0,'intval');                    //条数
        $num =  $search['num'] == 0? $num: $search['num'] ;
        $where = '1';
        //查询渠道
        $ChannelFiled = array(
            'account',
            'name',
        );
        $Channel = M('jy_admin_users')
            ->where('channel = 2')
            ->field($ChannelFiled)
            ->select();
        //注册时间
        if($search['datemin']  != '' ){
            $where .= ' and   `mdate` >=  str_to_date("'.$search['datemin'].'","%Y-%m-%d  %H:%i:%s") ';
        }
        if($search['datemax']  != '' ){
            $datemax  =   date("Y-m-d H:i:s",strtotime($search['datemax'])+24*60*60);
            $where .= ' and   `mdate` < str_to_date("'.$datemax.'","%Y-%m-%d  %H:%i:%s") ';
        }

        $count  =M('game_numerical')
                ->where($where)
                ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $infoField = array(
            'mdate',
            'produce_gold_1',
            'consume_gold_1',
            'fish_card_1',
            'bomb_1',
            'score_1',
            'produce_gold_2',
            'consume_gold_2',
            'fish_card_2',
            'bomb_2',
            'score_2',
            'produce_gold_3',
            'consume_gold_3',
            'fish_card_3',
            'bomb_3',
            'score_3',
            'produce_gold_4',
            'consume_gold_4',
            'fish_card_4',
            'bomb_4',
            'score_4',
            'boss_award_pool',
        );
        $info = M('game_numerical')
                ->where($where)
                ->limit($page*$num,$num)
                ->order('mdate desc')
                ->field($infoField)
                ->select();
        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->assign('Channel',$Channel);
        $this->assign('search',$search);
        $this->display('index');
    }

    //用户详细信息
    public function  info(){
        $obj = new \Common\Lib\func();
        $playerid = I('param.playerid',0,'intval');
        if($playerid<=0){
            $obj->showmessage('非法操作');
        }
        //账号信息
        $catGameAccountField = array(
            'playerid',
            'account_type',
            'os_type',
            'mac',
            'imei',
            'imsi',
            'uuid',
            'mobile',
            'accountstate',
            'regtime',
            'lasttime',
            'block_desc',
            'reg_channel',
            'login_channel',
            'phone_model',
            'phone_os_ver',
            'game_ver',
            'communiid',
            'account_name',
            'logout_time',
            'online_time',
            'reg_channel',
        );
        $catGameAccount = M('game_account')
                          ->where('playerid = '.$playerid)
                          ->field($catGameAccountField)
                          ->find();
        //玩家信息

        $catGamePlayerField = array(
            'playerid',
            'name',
            'sex',
            'vip',
            'vip_exp',
            'status',
            'serverid',
            'game_type',
            'room_type',
            'level_type',
            'roomid',
            'gold',
            'diamond',
            'deposit',
            'profit',
            'glevel',
            'gexp',
            'gun_lv',
            'sign_day',
            'sign_time',
            'gunid',
            'icon_url',
            'is_mc',
            'date_format(mc_overtime,"%Y-%m-%d %H:%i:%s") as McOvertime',
        );
        $catGamePlayer =  M('game_player')
                          ->where('playerid = '.$playerid)
                          ->field($catGamePlayerField)
                          ->find();
        //道具信息
        $catGameItem   =  M('game_item')
                         ->where('playerid = '.$playerid)
                         ->find();
        //总充值
        $catUserOderInfoField = array(
            'sum(Price) as Price'
        );
        $catUserOderInfo = M('jy_users_order_info')
                           ->where('playerid = '.$playerid.' and  Status = 2')
                            ->field($catUserOderInfoField)
                            ->select();
        $time = strtotime(date("Y-m-d",time()));
        //今日时间
        $day = 24*60*60;
        $OneStart = date('Y-m-d H:i:s',$time);
        $OneEnd = date('Y-m-d H:i:s',$time+$day);
        //昨日时间
        $TowStart = date('Y-m-d H:i:s',$time-$day);
        $TowEnd = date('Y-m-d H:i:s',$time);
        //今日充值
         $catToDayUserOderInfo =    M('jy_users_order_info')
             ->where('playerid = '.$playerid.' and  Status = 2 
                      and  CallbackTime < str_to_date("'.$OneEnd.'","%Y-%m-%d %H:%i:%s")  
                      and  CallbackTime  >= str_to_date("'.$OneStart.'","%Y-%m-%d %H:%i:%s")')
             ->field($catUserOderInfoField)
             ->select();
        //昨日充值
        $catTowDayUserOderInfo = M('jy_users_order_info')
            ->where('playerid = '.$playerid.' and  Status = 2 
                      and  CallbackTime < str_to_date("'.$TowEnd.'","%Y-%m-%d %H:%i:%s")  
                      and  CallbackTime  >= str_to_date("'.$TowStart.'","%Y-%m-%d %H:%i:%s")')
            ->field($catUserOderInfoField)
            ->select();
        //今日启动
        $GameLoginActionField = array(
            'count(id) as num'
        );
        $catToDayGameLoginAction = M('game_login_action')
            ->where('playerid = '.$playerid.' and 
                      login_time < str_to_date("'.$OneEnd.'","%Y-%m-%d %H:%i:%s")  
                      and  login_time  >= str_to_date("'.$OneStart.'","%Y-%m-%d %H:%i:%s")')
            ->field($GameLoginActionField)
            ->select();
        //昨日启动
        $catTowDayGameLoginAction = M('game_login_action')
            ->where('playerid = '.$playerid.' 
                      and  login_time < str_to_date("'.$TowEnd.'","%Y-%m-%d %H:%i:%s")  
                      and  login_time  >= str_to_date("'.$TowStart.'","%Y-%m-%d %H:%i:%s")')
            ->field($GameLoginActionField)
            ->select();

        $this->assign('catGameAccount',$catGameAccount);
        $this->assign('catUserOderInfo',$catUserOderInfo);
        $this->assign('catToDayUserOderInfo',$catToDayUserOderInfo);
        $this->assign('catTowDayUserOderInfo',$catTowDayUserOderInfo);
        $this->assign('catTowDayGameLoginAction',$catTowDayGameLoginAction);
        $this->assign('catToDayGameLoginAction',$catToDayGameLoginAction);
        $this->assign('catGameItem',$catGameItem);
        $this->assign('catGamePlayer',$catGamePlayer);
        $this->display('info');
    }



}