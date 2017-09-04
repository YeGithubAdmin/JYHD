<?php
/***
 *  活跃分析-金币
 ***/
namespace Jy_admin\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class ActiveGoldController extends ComController {
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

        $whereUserComprehensive  =   'b.DateTime > "'.$timeEndStrtotime.'" and  b.DateTime < "'.$timeStartStrtotime.'"';
        $UserComprehensive = M('jy_company as a')
            ->join('jy_user_active_gold_logo as b on a.id = b.company and '.$whereUserComprehensive,'LEFT')
            ->where($whereUserComprehensive)
            ->field('a.company,a.id,a.name,group_concat(b.num ORDER BY b.DateTime DESC) as num')
            ->order('a.end asc')
            ->group('b.company')
            ->select();
        if(!empty($UserComprehensive)){
            foreach ($UserComprehensive as $k=>$v){
                $num = explode(',',$v['num']);
                $countArr =  count($num);
                for ($i =$countArr;$i<$timeEndDay;$i++ ){
                    $num[] = 0;
                }
                $UserComprehensive[$k]['num'] = $num;
            }
        }else{
            $UserComprehensive = M('jy_company')
                ->field('id,company,name')
                ->order('end asc')
                ->select();
            foreach ($UserComprehensive as $k=>$v){
                $num = array();
                for ($i =0;$i<$timeEndDay;$i++ ){
                    $num[] = 0;
                }
                $UserComprehensive[$k]['num'] = $num;
            }
        }

        $this->assign('datemin',$datemin);
        $this->assign('dayNum',$timeEndDay);
        $this->assign('day',$erverDay);
        $this->assign('info',$UserComprehensive);
        $this->display();

    }
    //自动脚本
    public function Script(){
            //前天时间
             $dateTime = time()-24*60*60;
             $dateTime = strtotime('2017-07-18');
             $timeEndStrtotime = date('Y-m-d',$dateTime-24*60*60);
             $timeStartStrtotime = date('Y-m-d',$dateTime+24*60*60);
             $whereUserComprehensive  =   'a.LastLoginTM > "'.$timeEndStrtotime.'" and  a.LastLoginTM < "'.$timeStartStrtotime.'"';
             $UserComprehensive = M('jy_company as b')
                                  ->join('web_vuserloginlist as a on  InitialLogin = 1 and a.money <= b.end and  a.money >= b.start  and ' .$whereUserComprehensive,'LEFT')
                                  ->field('count(distinct a.UserID) as Num,b.id as company')
                                  ->group('id')
                                  ->select();
             $userActiveGoldLogo = M('jy_user_active_gold_logo')->addAll($UserComprehensive);
    }

}