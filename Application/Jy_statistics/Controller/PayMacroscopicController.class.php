<?php
/***
 *  付费分析
 *
 *  日收入  DailyIncome
 *  描述：当日收入总额。
 *
 *  付费用户数 UserPayNum
 *  描述：当日付费用户数。
 *
 *  付费次数： PayNum
 *  描述：当日付费次数  。
 *
 *  活跃付费渗透率  PayRate
 *  描述：每日成功付费用户占当日活跃用户的比例。
 *
 *  ARPPU： ARPPU
 *  描述：日ARPPU=当日充值总额度/当日付费用户数量。
 *
 *  首付用户数  FirstUserNum
 *  描述：当日首次付费用户数量。
 *
 *  首付金额  FirstDailyIncome
 *  描述 ：当日首付总额。
 ***/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class PayMacroscopicController extends ComController {
    //列表
    public function index(){


        $page      = $this->page;
        $search['datemin']     = I('param.datemin','','trim');
        $search['datemax']     = I('param.datemax','','trim');
        $search['num']         = I('param.num',30,'intval');
        $search['channel']     = I('param.channel','','trim');
        $model = new Model;
        //判断管理还是运营
        $whereData = 'a.channel = 2 and a.Isdel = 1';
        //管理
        $ChannelListField = array(
            'Id',
            'name',
            'account',
        );
        $ChannelList = $model
            ->table('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field($ChannelListField)
            ->select();
        if ($search['channel'] != ''){
            $whereData .= ' and a.`account`="'.$search['channel'].'"';
        }
        //默认前15天数据
        $time = date("Y-m-d",time());
        $time = strtotime($time);
        $Statime = date('Y-m-d H:i:s',$time-15*24*60*60);
        $Endtime = date('Y-m-d H:i:s',$time+24*60*60);
        $datemin = date('Y-m-d H:i:s',strtotime($search['datemin']));
        $datemax = date('Y-m-d H:i:s',strtotime($search['datemax'])+24*60*60);
        $JoinGameAccount = '';
        if ($search['datemin'] != ''){
            $JoinGameAccount = ' and  c.regtime >= str_to_date("'.$datemin.'","%Y-%m-%d %H:%i:%s")';
            $whereData .= ' and  c.DateTime >= str_to_date("'.$datemin.'","%Y-%m-%d %H:%i:%s")';
        }else{
            $whereData .= ' and  c.DateTime >= str_to_date("'.$Statime.'","%Y-%m-%d %H:%i:%s")';
            $JoinGameAccount .= ' and  c.regtime >= str_to_date("'.$Statime.'","%Y-%m-%d %H:%i:%s")';
        }
        if ($search['datemax'] != ''){
            $whereData .= ' and  c.DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
            $JoinGameAccount .= ' and  c.regtime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }else{
            $JoinGameAccount .= ' and  c.regtime < str_to_date("'.$Endtime.'","%Y-%m-%d %H:%i:%s")';
            $whereData .= ' and  c.DateTime < str_to_date("'.$Endtime.'","%Y-%m-%d %H:%i:%s")';
        }
        /***
         *'渠道ID',    GroupChannel
         *'渠道名称',  name
         *'报表日期',  t
         *'新增用户',  RegNum
         *'付费金额',  TotalMoney
         *'注册ARPU',  RegArpu
         *'活跃ARPU',  ActiveArpu
         *'次日留存',  UsersOneNum
         *'付费金额（老用户', OrderTotalOld
         *'活跃用户', ActiveNum
         *'付费转化', PayConversion
         *'付费用户（老用户）', UserPayNumOld
         *'付费转化（老用户）', PayConversionOld
         *'订单数量',  Success
         *'2日留存',  UsersTowNum
         *'3日留存', UsersThreeNum
         *'7日留存',  UsersSevenNum
         *'15日留存', UsersFifteenNum
         *'30日留存', UsersThirtyNum
         **********/
        $count =  $model->query('
                  SELECT 
                  a.account as GroupChannel,
                  date_format(c.DateTime,"%Y-%m-%d") as t  
                  FROM jy_admin_users as a INNER JOIN jy_channel_info as b on b.adminUserID = a.Id
                  INNER JOIN jy_statistics_users_pay as c on c.Channel = a.account  
                  WHERE ( '.$whereData.') GROUP BY  `GroupChannel`,`t`');

        $catData = $model->query('
                  SELECT * FROM (
                  SELECT 
                  a.account as GroupChannel,
                  a.name,
                  c.PayNum,
                  c.First,
                  c.FirstMoney,
                  c.UserPayNum,
                  c.ActiveNum,
                  c.Success,
                  c.TotalMoney,
                  date_format(c.DateTime,"%Y-%m-%d") as t  
                  FROM jy_admin_users as a INNER JOIN jy_channel_info as b on b.adminUserID = a.Id
                  INNER JOIN jy_statistics_users_pay as c on c.Channel = a.account  
                  WHERE ( '.$whereData.') ORDER BY c.DateTime desc) as 
                  catData GROUP BY  catData.`GroupChannel`,catData.`t` ORDER BY catData.`t` desc  LIMIT '.$search['num']*$page.','.$search['num']);
        $count      = count($count) ;
        $Page       = new \Common\Lib\Page($count,$search['num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('ChannelList',$ChannelList);
        $this->assign('info',$catData);
        $this->display('index');
    }
    //支付类型
    public function PayType(){

        $this->display();
    }
    public function Goods(){
        //默认 30天
        $day = 24*60*60;
        $time = strtotime(date('Y-m-d',time()));
        $StartTime = date('Y-m-d',$time-30*$day);
        $EndTime   = date('Y-m-d',$time-$day);
        $search['datemin']     = I('param.datemin',$StartTime,'trim');
        $search['datemax']     = I('param.datemax',$EndTime,'trim');
        $search['channel']     = I('param.channel','','trim');
        $ChannelListField = array(
            'Id',
            'name',
            'account',
        );
        $where =  '';
        if($search['channel']  != '' ){
            $where .= '  and  b.`Channel` = "'.$search['channel'].'"';
        }
        if($search['datemin'] !=  ''){
            $where .= '  and  b.`DateTime` >=   str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['datemax'] !=  ''){
            $datemax = date('Y-m-d',strtotime($search['datemax'])+24*60*60);
            $where .= '  and b.`DateTime` <   str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        $ChannelList = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field($ChannelListField)
            ->select();
        $infoField = array(
            'a.Name',
            'sum(b.GoodsSuccess) as Success',
            'sum(b.GoodsTotal) as Total',
        );
        $info =  M('jy_goods_all as a')
                ->join('jy_statistics_goods as b on b.GoodsID = a.Id '.$where,'left')
                ->field($infoField)
                ->where(' a.ShowType = 1  and  a.IsDel = 1 or 
                            a.ShowType = 2 and  a.CateGory = 4  and a.IsDel = 1  
                            or a.ShowType = 3 and  a.CateGory = 4  and a.IsDel = 1')
                ->group('a.Id')
                ->select();
        $this->assign('info',$info);
        $this->assign('ChannelList',$ChannelList);
        $this->assign('search',$search);
        $this->display();
    }
}