<?php
/***
 *  活跃分析-版本
 ***/
namespace Jy_statistics\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class ActiveEditionController extends ComController {
    //列表
    public function index(){
        //默认30天
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $DayTime = 24*60*60;
        $StartTime  = date('Y-m-d',time()-$DayTime*31);
        $EndTime    = date('Y-m-d',time()-$DayTime);
        $search['Version'] = I('param.Version','','trim');
        $search['DateTime'] = I('param.DateTime',$StartTime,'trim');
        $search['datemax'] = I('param.datemax',$EndTime,'trim');
        $where = '1';
        if($search['DateTime'] != ''){
            $where .= ' and DateTime >= str_to_date("'.$search['DateTime'] .'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['datemax'] != ''){
            $datemax =  date('Y-m-d',strtotime($search['datemax'])+$DayTime);
            $where .= ' and DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['Version'] != ''){
            $where .= ' and Version = "'.$search['Version'].'"';
        }
         //版本信息
        $catGameVer  = M('jy_game_version')
                       ->field(array(
                           'Version',
                       ))
                       ->select();


        //条数
        $count = M('jy_statistics_activem_acroscopic')
                 ->where($where)
                 ->field(array(
                     'date_format(DateTime,"%Y-%m-%d")  as t',
                     'VerSion',
                 ))
                 ->group('VerSion,t')
                 ->select();


        $Page       = new \Common\Lib\Page(count($count),$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        //查询数据
        $catDataField = array(
            'sum(Account) as Account',
            'sum(EquipmentAndroid)+sum(EquipmentIos) as Equipment',
            'VerSion',
            'date_format(DateTime,"%Y-%m-%d")  as t'
        );
        $catData = M('jy_statistics_activem_acroscopic')
            ->where($where)
            ->field($catDataField)
            ->group('VerSion,t')
            ->limit($page*$num,$num)
            ->select();
//        dump($catData);
        //分组
        $this->assign('info',$catData);
        $this->assign('page',$show);
        $this->assign('GameVer',$catGameVer);
        $this->assign('search',$search);
        $this->display();
    }
}