<?php
/***
*  邮件发放记录
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class MailGrantLogController extends ComController {
    //列表
    public function index(){
        $page      = $this->page;
        $time = date("Y-m-d",time());
        $DateTime = $time;
        $time = strtotime($time);
        $Statime = date('Y-m-d',$time-15*24*60*60);
        $Endtime = date('Y-m-d',$time);
        $search['datemin']     =    I('param.datemin',$Statime,'trim');
        $search['datemax']     =    I('param.datemax',$Endtime,'trim');
        $search['Channel']     =    I('param.Channel','','trim');
        $search['playerid']    =    I('param.playerid','','trim');
        $search['GoodsCode']   =    I('param.GoodsCode','','trim');
        $search['Num']         =    I('param.Num',15,'trim');
        $search['Source']      =    I('param.Source',3,'trim');
        $search['Style']       =    I('param.Style',1,'trim');
        //渠道列表
        $Channel = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field(array(
                'account',
                'name',
            ))
            ->select();
        //查询数据
        $where = '1';
        if($search['Style'] != ''){
            $where .= ' and  Style = '.$search['Style'];
        }

        if($search['Source'] != ''){
            $where .= ' and  Source = '.$search['Source'];
            if($search['Source'] == 2){
                if ($search['Channel'] != ''){
                    $where .= ' and  Channel = "'.$search['Channel'].'"';
                }
            }
        }
        if($search['playerid'] != ''){
            $where .= ' and  playerid = '.$search['playerid'];
        }

        if ($search['datemin'] != ''){
            $where .= ' and  DateTime >= str_to_date("'.$search['datemin'] .'","%Y-%m-%d %H:%i:%s")';
        }
        if ($search['datemax'] != ''){
            $datemax = date('Y-m-d H:i:s',strtotime($search['datemax'])+24*60*60);
            $where .= ' and  DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        $LogMailGrant = M('log_mail_grant');
        //总计
        $count        =  $LogMailGrant
            ->where($where)
            ->count();
        //列表
        $info         =  $LogMailGrant
            ->where($where)
            ->field(
                array(
                  'Id',
                  'playerid',
                  'Style',
                  'Type',
                  'Code',
                  'GoodsName',
                  'Number',
                  'Channel',
                  'CardNum',
                  'CardMi',
                  'Aname',
                  'Aid',
                  'DateTime',
                )
            )
            ->limit($page* $search['Num'],$search['Num'])
            ->order('DateTime desc')
            ->select();
        $Page         =  new \Common\Lib\Page($count,$search['Num']); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show         =  $Page->show();                                  // 分页显示输出
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->assign('Channel',$Channel);
        $this->assign('count',$count);
        $this->display('index');
    }

}