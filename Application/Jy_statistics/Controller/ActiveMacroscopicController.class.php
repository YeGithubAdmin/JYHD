<?php
/***
*  活跃分析-宏观数据
***/
namespace Jy_statistics\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class ActiveMacroscopicController extends ComController {
    //列表
    public function index(){

        //默认时间线
        $time        = time();
        $EndTime     = date('Y-m-d',$time-24*60*60);
        $StartTime   =  date('Y-m-d',$time-30*24*60*60);
        $search['datemin']     = I('param.datemin',$StartTime,'trim');
        $search['datemax']     = I('param.datemax',$EndTime,'trim');
        $search['num']         = I('param.num',30,'intval');
        $search['channel']     = I('param.channel','','trim');
        $search['Version']     = I('param.Version','','trim');
        //版本
        $GameVersion = M('jy_game_version')
                       ->field('Version')
                       ->order('Version asc')
                       ->select();
        $ChannelListField = array(
            'Id',
            'name',
            'account',
        );
        $ChannelList = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field($ChannelListField)
            ->select();
        $where = 1;
        //时间范围
        if($search['datemin']  != '' ) {
            $where .= '  and  `DateTime` >= str_to_date("' . $search['datemin'] . '","%Y-%m-%d %H:%i:%s")  ';
        }
        if($search['datemax']  != ''){
            $datemax = date('Y-m-d H:i:s',strtotime($search['datemax'])+24*60*60);
            $where .= '  and  `DateTime` < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s") ';
        }
        //渠道
        if( $search['channel']  != ''){
            $where .= '  and  `Channel` =  "'.  $search['channel'].'"';
        }
        //版本
        if( $search['VerSion']  != ''){
            $where .= '  and  `VerSion` =  "'.  $search['VerSion'].'"';
        }
        /***
        *
        *  DAU  UserNum
        *  描述：日活跃，统计所选时期内，每日成功登录游戏的玩家数量。
        *
        *  WAU  WAU
        *  描述：统计所选时期内，当日往前推7日（当日计入天数）期间内，登陆过游戏的玩家总数量，按照玩家ID去重。
        *
        *  MAU  MAU
        *  描述：统计所选时期内，当日往前推30日（当日计入天数）期间内，登陆过游戏的玩家总数量，按照玩家ID去重。
        *
        *  DAU/MAU比值  DAUMAU
        *  描述：统计所选时期内，当日活跃玩家数量与当月活跃玩家数量的比例。此比例越趋近于1，说明游戏玩家的活跃度越高。
        *
        *  活跃游戏率 UserActiveGame
        *  描述：统计所选时期内，每日DAU中有游戏行为的用户/DAU。
        *
        *  活跃付费率  UserActivePayRate
        *  描述：统计所选时期内，每日成功付费用户占当日活跃用户的比例。
        *
        *  破产率   BankruptcyRate
        *  描述：活跃破产率=破产用户/活跃用户。
        *
        *  破产付费率  BankruptcyRate30
        *  描述：破产且在30分钟内付费的用户数/破产用户数。
        ****/
        $infoFile = array(
            'Id',
            'Account',
            'EquipmentAndroid',
            'EquipmentIos',
            'WAU',
            'MAU',
            'BankruptcyTotal',
            'UserGame',
            'PayNum',
            'BankruptcyNum',
            'Channel',
            'VerSion',
            'DateTime',
        );
        $info = M('jy_statistics_activem_acroscopic')
                ->where($where)
                ->field($infoFile)
                ->order('DateTime desc')
                ->select();
        $this->assign('ChannelList',$ChannelList);
        $this->assign('search',$search);
        $this->assign('GameVersion',$GameVersion);
        $this->assign('info',$info);
        $this->display();
    }

}