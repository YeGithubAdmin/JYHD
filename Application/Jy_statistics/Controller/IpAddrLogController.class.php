<?php
/**
*   转化
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class IpAddrLogController extends ComController {
    //列表
    public function index(){
        $page      = $this->page;
        $num       = $this->num;
        //默认30天数据
        $time =  strtotime(date('Y-m-d',time()-24*60*60));
        $DayTime  = 24*60*60;
        $StartTime  = date('Y-m-d',$time-$DayTime*29);
        $EndTime    = date('Y-m-d',$time);
        $search['datemin']     = I('param.datemin',$StartTime,'trim');
        $search['datemax']     = I('param.datemax',$EndTime,'trim');
        $search['Channel']     = I('param.Channel','','trim');
        $search['Num']         = I('param.Num',$num,'trim');
        $search['Type']        = I('param.Type','','trim');
        $where = '1';
        //渠道列表
        $Channel = M('jy_admin_users')
                   ->where('channel = 2 and isdel = 1')
                   ->field(array(
                       'account',
                       'name',
                   ))
                   ->select();
        if($search['datemin'] != ''){
            $where .= ' and DateTime >= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['datemax'] != ''){
            $datemax = date('Y-m-d',strtotime($search['datemax'])+$DayTime);
            $where .= ' and DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['Channel'] != ''){
            $where .= ' and Channel = "'.$search['Channel'].'"';
        }
        if($search['Type'] != ''){
            $where .= ' and Type = '.$search['Type'];
        }

        $count  = M('log_add_ip_pool')
                  ->where($where)
                  ->count();
        $Page       = new \Common\Lib\Page($count,$search['Num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $catData = M('log_add_ip_pool')
                  ->where($where)
                  ->field(
                    array(
                       'Channel',
                       'Number',
                       'Type',
                       'DateTime',
                    )
                  )->order('DateTime desc')
                  ->limit($page*$search['Num'],$search['Num'])
                  ->select();
        $show  = $Page->show();// 分页显示输出
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('Channel',$Channel);
        $this->assign('info',$catData);
        $this->display('index');
    }


}