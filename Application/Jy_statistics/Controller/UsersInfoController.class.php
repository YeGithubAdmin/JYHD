<?php
/****
*  用户信息
**/
namespace Jy_statistics\Controller;
use Protos\PBS_ItemOpt;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;

class UsersInfoController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $time = strtotime(date('Y-m-d',time()));
        $StartTime = date("Y-m-d",$time);
        $EndTime   =  date("Y-m-d",$time+24*60*60);
        $search['datemin']                   =      I('param.datemin','','trim');                 //注册时间
        $search['datemax']                   =      I('param.datemax','','trim');                 //注册时间
        $search['playerid']                  =      I('param.playerid','','intval');              //用户ID
        $search['Status']                    =      I('param.Status',0,'intval');                 //游戏状态
        $search['glevel']                    =      I('param.glevel',0,'intval');                 //游戏等级
        $search['VerSion']                   =      I('param.VerSion','','trim');                 //游戏版本
        $search['reg_channel']               =      I('param.regchannel','','trim');             //注册渠道号
        $search['login_channel']             =      I('param.loginchannel','','trim');           //登录渠道号
        $search['SortName']                  =      I('param.SortName','','trim');                //排序类型
        $search['Sort']                      =      I('param.Sort','','trim');                    //排序
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
            $where .= ' and   a.regtime >=  str_to_date("'.$search['datemin'].'","%Y-%m-%d  %H:%i:%s") ';
        }
        if($search['datemax']  != '' ){
            $datemax  =   date("Y-m-d H:i:s",strtotime($search['datemax'])+24*60*60);
            $where .= ' and   a.regtime < str_to_date("'.$datemax.'","%Y-%m-%d  %H:%i:%s") ';
        }
        //用户ID
        if ($search['playerid'] != '' && $search['playerid'] != 0 ){
            $where .= ' and a.`playerid`='.$search['playerid'];
        }
        //游戏状态
        if( $search['Status'] != 0  ){
            $where .= ' and b.`status`='.$search['Status'];
        }
        //游戏等级
        if( $search['glevel'] != 0  ){
            $where .= ' and b.`glevel`='.$search['glevel'];
        }
        //游戏版本
        if( $search['VerSion'] != ''  ){
            $where .= ' and a.`game_ver`="'.$search['VerSion'].'"';
        }
        //注册渠道号
        if( $search['reg_channel'] != ''  ){
            $where .= ' and a.`reg_channel`="'.$search['reg_channel'].'"';
        }
        //登录渠道号
        if( $search['login_channel'] != ''  ){
            $where .= ' and a.`login_channel`="'.$search['login_channel'].'"';
        }

        if($search['playerid']  == 0 ){
            $search['playerid'] = '';
        }

        $order =  'a.playerid desc';
        //排序
        if($search['SortName']  != '' ){
            $order = $search['SortName'].' '.$search['Sort'] ;
        }

        $countFiled = array(
            'count(distinct b.playerid) as num',
            'sum(d.Price) as Price',
            'sum(c.item1_num) as item1_num',
            'sum(c.item2_num) as item2_num',
            'sum(c.item3_num) as item3_num',
            'sum(c.item4_num) as item4_num',
            'sum(c.item5_num) as item5_num',
            'sum(c.item6_num) as item6_num',
            'sum(b.gold) as gold',
            'sum(b.diamond) as diamond',
        );
        $count  =M('game_player as b')
            ->join('game_account as a  on b.playerid = a.playerid')
            ->join('game_item as c on  b.playerid = c.playerid','left')
            ->join('(SELECT SUM(`Price`) AS Price,playerid FROM  jy_users_order_info  WHERE  `Status` = 2  GROUP BY playerid) as d ON d.playerid = a.playerid','left')
            ->where($where)
            ->field($countFiled)
            ->select();

        $TheNumberOf = $count[0]['num'];
        $Page       = new \Common\Lib\Page($TheNumberOf,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $infoField = array(
            'a.playerid',
            'b.name',
            'b.glevel',
            'b.vip',
            'b.gold',
            'b.diamond',
            'b.deposit',
            'b.profit',
            'a.account_type',
            'a.os_type',
            'a.accountstate',
            '(UNIX_TIMESTAMP(a.logout_time)-UNIX_TIMESTAMP(a.LastTime))/60  AS  WhenLong',
            'b.status',
            'a.regtime',
            'a.logout_time',
            'a.reg_channel',
            'a.login_channel',
            'a.phone_os_ver',
            ' sum(d.Price) as Price',
            'c.item1_num',
            'c.item2_num',
            'c.item3_num',
            'c.item4_num',
            'c.item5_num',
            'c.item6_num',
        );
        $info = M('game_account as a')
                ->join('game_player as b  on a.playerid = b.playerid')
                ->join('game_item as c on  a.playerid = c.playerid','left')
                ->join('jy_users_order_info  as d on  a.playerid = d.playerid and d.Status = 2','left')
                ->where($where)
                ->limit($page*$num,$num)
                ->group('a.playerid')
                ->order($order)
                ->field($infoField)
                ->select();
        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->assign('Channel',$Channel);
        $this->assign('count',$count);
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
        $catGameAccount = M('game_account')
                          ->where('playerid = '.$playerid)
                          ->find();
        //玩家信息
        $catGamePlayer =  M('game_player')
                          ->where('playerid = '.$playerid)
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