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
        $search['datemin']                   =      I('param.datemin',$StartTime,'trim');
        $search['datemax']                   =      I('param.datemax',$EndTime,'trim');
        $search['RoomLevel']                 =      I('param.RoomLevel','','trim');
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
        if($search['RoomLevel']  != '' ){
            $where .= ' and   `room_level` =  '.$search['RoomLevel'] ;
        }

        $count  =M('game_numerical')
                ->where($where)
                ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $infoField = array(
            'mdate',
            'room_level',
            'gold_pool',
            'gold_pump',
            'produce_gold',
            'consume_gold',
            'produce_fish_card',
            'produce_score',
            'produce_bomb_cu',
            'produce_bomb_ag',
            'produce_bomb_au',
            'date_format(mdate,"%Y%m%d") as T'
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




}