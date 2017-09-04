<?php
/***
 *  活跃分析-版本
 ***/
namespace Jy_admin\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class ActiveEditionController extends ComController {
    //列表
    public function index()
    {


        $time = date('Y-m-d', time());                                                                      //当前时间
        $btime = date('Y-m-d', time() - 24 * 60 * 60);                                          //默认当前昨天
        $datemin = I('param.datemin', $btime, 'trim');                                                            //搜索时间
        if ($datemin == $time) {
            $datemin = $btime;
        }
        $timeEndDay = I('param.day',15,'intval');
        $dayTime = 24 * 60 * 60;
        $strtotime = strtotime($datemin);
        $timeStart= $datemin;                                                                                   //时间段：前天
        $timeStartStrtotime = date('Y-m-d', strtotime($timeStart) + $dayTime);
        $timeEnd = date('Y-m-d', $strtotime - ($timeEndDay-1)* $dayTime);
        $timeEndStrtotime = date('Y-m-d', strtotime($timeStart) - $dayTime*30);

        for($i=($timeEndDay-1);$i>=0;$i--){
            $erverDayTime = $strtotime-$i*$dayTime;
            if($erverDayTime >= strtotime($timeEnd)){
                $erverDay[$i]['time'] = $erverDayTime;
                $erverDay[$i]['day'] = date('n月j日',$erverDayTime);
                $erverDay[$i]['date'] = date('Y-m-d',$erverDayTime);
            }
        }
        //排序数组
        ksort($erverDay);

        $whereUserComprehensive  =   'DateTime > "'.$timeEndStrtotime.'" and  DateTime < "'.$timeStartStrtotime.'"';
        $UserComprehensive = M('jy_user_active_edition_logo')
            ->where($whereUserComprehensive)
            ->field('Edition,group_concat(num) as num')
            ->order('Edition')
            ->group('Edition')
            ->select();
        foreach ($UserComprehensive as $k=>$v){
            $num = explode(',',$v['num']);
            $countArr =  count($num);
            for ($i =$countArr;$i<$timeEndDay;$i++ ){
                $num[] = 0;
            }
            $UserComprehensive[$k]['num'] = $num;
        }
        $this->assign('datemin',$datemin);
        $this->assign('dayNum',$timeEndDay);
        $this->assign('day',$erverDay);
        $this->assign('info',$UserComprehensive);
        $this->display();
    }

}