<?php
/***
*   BOOS数值
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class BoosNumericalValueController extends ComController {
    //日付费统计
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
        $search['Num']         = I('param.Num',$num,'trim');
        $where = '1';
        //渠道列表
        if($search['datemin'] != ''){
            $where .= ' and mdate >= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['datemax'] != ''){
            $datemax = date('Y-m-d',strtotime($search['datemax'])+$DayTime);
            $where .= ' and mdate < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        $count  = M('game_boss_numerical')
                  ->where($where)
                  ->count();
        $Page       = new \Common\Lib\Page($count,$search['Num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)

        $catData = M('game_boss_numerical')
            ->where($where)
            ->field(
                array(
                   'mdate',
                   'boss_award_pool',
                   'boss_consume',
                   'boss_produce_gold',
                   'boss_produce_bomb_gold',
                )
            )->order('mdate desc')
            ->limit($page*$search['Num'],$search['Num'])
            ->select();
        $show  = $Page->show();// 分页显示输出
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('info',$catData);
        $this->assign('count',$count);
        $this->display();
    }

    /***
    * 导出
    */
    public function  DExcel(){
        $ComFun = D('ComFun');
        $DayTime  = 24*60*60;
        $search['datemin']     = I('param.datemin','','trim');
        $search['datemax']     = I('param.datemax','','trim');
        $where = '1';
        if($search['datemin'] != ''){
            $where .= ' and mdate >= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['datemax'] != ''){
            $datemax = date('Y-m-d',strtotime($search['datemax'])+$DayTime);
            $where .= ' and mdate < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        $catData = M('game_boss_numerical')
            ->where($where)
            ->field(
                array(
                    'mdate',
                    'boss_award_pool',
                    'boss_consume',
                    'boss_produce_gold',
                    'boss_produce_bomb_gold',
                )
            )->order('mdate desc')
            ->select();
        $expTitle = "游戏数值 -BOSS";
        $expCellName = array(
            '日期',
            'boss奖池',
            'boss消耗',
            'boss产出',
            '产出核弹对应金币',

        );
        $ComFun->exportExcel($expTitle,$expCellName,$catData);
    }




}