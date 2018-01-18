<?php
/***
*   活跃玩家分析
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class ActiveAnalysisController extends ComController {
    /**
    *  玩家数
    */
    public  function  UsersNum(){
        $page       = $this->page;
        $time       = date("Y-m-d",time());
        $time       = strtotime($time);
        $Statime    = date('Y-m-d',$time-15*24*60*60);
        $Endtime    = date('Y-m-d',$time);
        $search['datemin']     = I('param.datemin',$Statime,'trim');
        $search['datemax']     = I('param.datemax',$Endtime,'trim');
        $search['Channel']     = I('param.Channel','','trim');
        $search['num']         = I('param.num',30,'intval');
        $where = '1';
        //渠道列表
        $Channel = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field(array(
                'account',
                'name',
            ))
            ->select();
        if ($search['datemin'] != ''){
            $where .= ' and  DateTime >= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        if ($search['datemax'] != ''){
            $datemax =  date('Y-m-d',strtotime($search['datemax'] )+24*60*60);
            $where .= ' and  DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        if ($search['Channel'] != ''){
            $where .= ' and  Channel = "'.$search['Channel'].'"';
        }
        $Db = M('log_channel_data');
        $count =  $Db->where($where)->count();
        $info = $Db
                ->where($where)
                ->field(array(
                    'DateTime',
                    'Channel',
                    'ActiveNum',
                    'RegNum',
                    'WAU',
                    'MAU',
                    '(ActiveNum-RegNum) as OldUser',
                    ' if(ActiveNum/MAU,round(100*ActiveNum/MAU,2),0) as Rate',
                ))
                ->limit($page*$search['num'],$search['num'])
                ->order('DateTime desc')
                ->select();
        $Page       = new \Common\Lib\Page($count,$search['num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);
        $this->assign('search',$search);
        $this->assign('info',$info);
        $this->assign('Channel',$Channel);
        //判断管理还是运营
        $this->display();
    }

    public function UsersNumExcel(){
        $ComFun = D('ComFun');
        $Data   = I('param.data','','trim');

        $expTitle = "活跃用户-玩家数量";
        $expCellName = array(
            '日期',
            '渠道',
            '总账号',
            '新账号数',
            '周活跃',
            '月活跃',
            '老玩家账号数',
            'DAU/MAU',
        );

        $ComFun->exportExcel($expTitle,$expCellName,json_decode($Data,true));

    }
    /***
    * 游戏天数
    */
    public function  GameDay(){
        $time       = date("Y-m-d",time());
        $time       = strtotime($time);
        $Statime    = date('Y-m-d',$time-15*24*60*60);
        $search['datemin']     = I('param.datemin',$Statime,'trim');
        $search['Channel']     = I('param.Channel','','trim');

        $Data = array(
         1=>array(
             'Name'=>'2-3天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         2=>array(
             'Name'=>'4-7天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         3=>array(
             'Name'=>'8-14天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         4=>array(
             'Name'=>'15-30天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         5=>array(
             'Name'=>'31-90天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         6=>array(
             'Name'=>'90天-180天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         7=>array(
             'Name'=>'180-365天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         8=>array(
             'Name'=>'1年以上',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
     );





    }
    /***
    * 区域情况
    */
    public function region(){

    }
}