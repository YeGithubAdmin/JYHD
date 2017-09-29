<?php
/***
*   渠道数据
*/
namespace Jy_admin\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class ChannelDataController extends ComController {
    //列表
    public function index(){
        $userInfo  = $this->userInfo;

        $default   = $userInfo['default'];
        $channel   = $userInfo['channel'];
        $page      = $this->page;
        $lowerAdminUser = $this->lowerAdminUser;    //我的下级组
        $search['datemin']     = I('param.datemin','','trim');
        $search['datemax']     = I('param.datemax','','trim');
        $search['num']         = I('param.num',10,'intval');
        $search['channel']     = I('param.channel','','trim');
        $model = new Model;
        //判断管理还是运营
        $whereData = 'a.channel = 2 and a.Isdel = 1';
        if($channel == 2){
            $whereData .="  and  a.account = '".$userInfo['account']."'";
            //渠道
        }else{
            //管理
            if($default != 2){
                $lowerAdminUser[]   =   $userInfo['id'];
                $lowerAdminUser     =   implode(',',$lowerAdminUser);
                $whereData  .= ' and a.addId in('.$lowerAdminUser.')';
            }
            $ChannelListField = array(
                'a.Id',
                'a.name',
                'a.account',
            );
            $ChannelList = $model
                ->table('jy_admin_users as a')
                ->join('jy_channel_info as b on b.adminUserID = a.Id')
                ->where($whereData)
                ->field($ChannelListField)
                ->select();
            if ($search['channel'] != ''){
                $whereData .= ' and a.`account`="'.$search['channel'].'"';
            }

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
            $whereData .= ' and  c.DateTime <= str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
            $JoinGameAccount .= ' and  c.regtime <= str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }else{
            $JoinGameAccount .= ' and  c.regtime <= str_to_date("'.$Endtime.'","%Y-%m-%d %H:%i:%s")';
            $whereData .= ' and  c.DateTime <= str_to_date("'.$Endtime.'","%Y-%m-%d %H:%i:%s")';
        }

        //查询数据
        $catDataField = array(
            'a.account as GroupChannel',
            'a.name',
            'c.PayNum',
            'c.UserPayNum',
            'c.RegNum',
            'c.ActiveNum',
            'if(round((c.TotalMoney/c.RegNum),2),round((c.TotalMoney/c.RegNum),2),0)  as  RegArpu',
            ' if(round((c.TotalMoney/c.ActiveNum),2),round((c.TotalMoney/c.ActiveNum),2),0)    as  ActiveArpu',
            'c.Success',
            ' if(round((c.UserPayNum/c.ActiveNum)*100,2),round((c.UserPayNum/c.ActiveNum)*100,2) ,0)  PayConversion',
            ' if(round((c.UserPayNumOld/c.ActiveNum)*100,2),round((c.UserPayNum/c.ActiveNum)*100,2) ,0)  PayConversionOld',
            'c.TotalMoney',
            'c.UserPayNumOld',
            'c.OrderTotalOld',
            'date_format(c.DateTime,"%Y-%m-%d") t'
        );
        $count  = M('jy_admin_users as a')
                  ->join('jy_channel_info as b on b.adminUserID = a.Id')
                  ->join('jy_statistics_users_pay as c on c.Channel = a.account')
                  ->where($whereData)
                  ->count();
        $Page       = new \Common\Lib\Page($count,$search['num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $catData = $model
            ->table('jy_admin_users as a')
            ->join('jy_channel_info as b on b.adminUserID = a.Id')
            ->join('jy_statistics_users_pay as c on c.Channel = a.account')
            ->where($whereData)
            ->limit(($page-$search['num'])*$page,$search['num'])
            ->field($catDataField)
            ->select();
        //计算留存
        $RetainedDataField = array(
            'count(c.playerid) as UserNum',
            'c.reg_channel as GroupChannel',
            'date_format(c.regtime,"%Y-%m-%d") t',
            'round(count(distinct d.playerid)*100/count(c.playerid),2) as UsersOneNum',
            'round(count(distinct f.playerid)*100/count(c.playerid),2) as UsersTowNum',
            'round(count(distinct q.playerid)*100/count(c.playerid),2) as UsersThreeNum',
            'round(count(distinct g.playerid)*100/count(c.playerid),2) as UsersSevenNum',
            'round(count(distinct h.playerid)*100/count(c.playerid),2) as UsersFifteenNum',
            'round(count(distinct i.playerid)*100/count(c.playerid),2) as UsersThirtyNum',
        );
        $RetainedData = $model
            ->table('jy_admin_users as a')
            ->join('jy_channel_info as b on b.adminUserID = a.Id')
            ->join('game_account as c on c.reg_channel = a.account'.$JoinGameAccount)
            ->join('game_login_action as d on c.playerid = d.playerid 
                                 and d.login_time < str_to_date(date_format(DATE_SUB(c.regtime,INTERVAL -2 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and d.login_time >= str_to_date(date_format(DATE_SUB(c.regtime,INTERVAL -1 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('game_login_action as f on c.playerid = f.playerid 
                                 and f.login_time < str_to_date(date_format(DATE_SUB(c.regtime,INTERVAL  -3 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and f.login_time >= str_to_date(date_format(DATE_SUB(c.regtime,INTERVAL  -2 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('game_login_action as g on c.playerid = g.playerid 
                                 and g.login_time < str_to_date(date_format(DATE_SUB(c.regtime,INTERVAL -8 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and g.login_time >= str_to_date(date_format(DATE_SUB(c.regtime,INTERVAL  -7 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('game_login_action as h on c.playerid = h.playerid 
                                 and h.login_time < str_to_date(date_format(DATE_SUB(c.regtime,INTERVAL -16 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and h.login_time >= str_to_date(date_format(DATE_SUB(c.regtime,INTERVAL  -15 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('game_login_action as i on c.playerid = i.playerid 
                                 and i.login_time < str_to_date(date_format(DATE_SUB(c.regtime,INTERVAL -31 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and i.login_time >= str_to_date(date_format(DATE_SUB(c.regtime,INTERVAL  -30 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('game_login_action as q on c.playerid = q.playerid 
                                 and q.login_time < str_to_date(date_format(DATE_SUB(c.regtime,INTERVAL  -4 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and q.login_time >= str_to_date(date_format(DATE_SUB(c.regtime,INTERVAL  -3 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->field($RetainedDataField)
            ->group('GroupChannel,t')
            ->select();
            //组装留存
        $RetainedDataSort = array();
        $info             = array();
        foreach ($RetainedData as $k=>$v) $RetainedDataSort[$v['t'].$v['GroupChannel']] = $v;
        foreach ($catData as $k=>$v){
            $data = $RetainedDataSort[$v['t'].$v['GroupChannel']];
            if(!empty($data)){
                $catData[$k]['UsersOneNum']         = $data['UsersOneNum'];
                $catData[$k]['UsersTowNum']         = $data['UsersTowNum'];
                $catData[$k]['UsersThreeNum']         = $data['UsersThreeNum'];
                $catData[$k]['UsersSevenNum']       = $data['UsersSevenNum'];
                $catData[$k]['UsersFifteenNum']     = $data['UsersFifteenNum'];
                $catData[$k]['UsersThirtyNum']      = $data['UsersThirtyNum'];
            }else{
                $catData[$k]['UsersOneNum']         = "0.00";
                $catData[$k]['UsersTowNum']         = "0.00";
                $catData[$k]['UsersThreeNum']       = "0.00";
                $catData[$k]['UsersSevenNum']       = "0.00";
                $catData[$k]['UsersFifteenNum']     = "0.00";
                $catData[$k]['UsersThirtyNum']      = "0.00";
            }
        }
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('ChannelList',$ChannelList);
        $this->assign('userinfo',$userInfo);
        $this->assign('info',$catData);
        $this->display('index');
    }

}