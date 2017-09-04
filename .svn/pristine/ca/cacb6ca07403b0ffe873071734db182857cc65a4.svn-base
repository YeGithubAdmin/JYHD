<?php
/***
 *  留存信息-留存数据
 ***/
namespace Jy_admin\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class RetainedDataController extends ComController {
    //列表
    public function index(){

        $timeEndDay = 30;
        $time = date('Y-m-d', time());                                                                      //当前时间
        $btime = date('Y-m-d', time() - 24 * 60 * 60);                                          //默认当前昨天
        $datemin = I('param.datemin', $btime, 'trim');                                                            //搜索时间
        if ($datemin == $time) {
            $datemin = $btime;
        }

        $dayTime = 24 * 60 * 60;
        $strtotime = strtotime($datemin);
        $timeStart= $datemin;                                                                                   //时间段：前天
        $timeStartStrtotime = date('Y-m-d', strtotime($timeStart) + $dayTime);
        $timeEnd = date('Y-m-d', $strtotime - ($timeEndDay-1)* $dayTime);                      //时间段：前8天
        $timeEndStrtotime = date('Y-m-d', strtotime($timeEnd) - $timeEnd);
        //30天时间
        for($i=($timeEndDay-1);$i>=0;$i--){
            $erverDayTime = $strtotime-$i*$dayTime;
            if($erverDayTime >= strtotime($timeEnd)){
                $erverDay[$i] = $erverDayTime;

            }
        }
        //排序数组
        ksort($erverDay);

        /**********************注册留存************************/
        $infoDataRegister = M('tuserinfo as a')
                    ->join('web_vuserloginlist as b on a.UserID  = b.UserID  
                      and  date_format(b.LastLoginTM,"%Y-%m-%d")  = date_format(DATE_SUB(a.RegisterTM,INTERVAL -1 DAY),"%Y-%m-%d")','left')

                    ->where('a.RegisterTM > "'.$timeEndStrtotime.'" and  a.RegisterTM < "'.$timeStartStrtotime.'"')
                    ->field('
                        date_format(a.RegisterTM,"%Y-%m-%d") as t
                        ,count(distinct a.UserID) num    
                         ,group_concat(distinct if(date_format(b.LastLoginTM,"%Y-%m-%d") = date_format(DATE_SUB(a.RegisterTM,INTERVAL -1 DAY),"%Y-%m-%d"),b.UserID,null)) as RetentionRate01
                         ,group_concat(distinct if(date_format(b.LastLoginTM,"%Y-%m-%d") = date_format(DATE_SUB(a.RegisterTM,INTERVAL -3 DAY),"%Y-%m-%d"),b.UserID,null)) as RetentionRate03
                         ,group_concat(distinct if(date_format(b.LastLoginTM,"%Y-%m-%d") = date_format(DATE_SUB(a.RegisterTM,INTERVAL -7 DAY),"%Y-%m-%d"),b.UserID,null)) as RetentionRate07
                         ,group_concat(distinct if(date_format(b.LastLoginTM,"%Y-%m-%d") = date_format(DATE_SUB(a.RegisterTM,INTERVAL -14 DAY),"%Y-%m-%d"),b.UserID,null)) as RetentionRate14
                         ,group_concat(distinct if(date_format(b.LastLoginTM,"%Y-%m-%d") = date_format(DATE_SUB(a.RegisterTM,INTERVAL -30 DAY),"%Y-%m-%d"),b.UserID,null)) as RetentionRate30
                            ')
                    ->group('t')
                    ->select(false);
          $infoDataRegister = $this->NewArr($infoDataRegister,$erverDay);
          $infoDataRegister['title'] =  '注册留存';
        /*************************活跃留存******************************/
        $infoDataActive = M('web_vuserloginlist as a')
                            ->join('web_vuserloginlist as b on a.UserID  = b.UserID
                                     ','left')
                          ->where('a.LastLoginTM > "'.$timeEndStrtotime.'" and  a.LastLoginTM < "'.$timeStartStrtotime.'"')
                           ->field('date_format(a.LastLoginTM,"%Y-%m-%d") as t
                                         ,count(distinct a.UserID) num    
                                         ,group_concat(distinct if(date_format(b.LastLoginTM,"%Y-%m-%d") = date_format(DATE_SUB(a.LastLoginTM,INTERVAL -1 DAY),"%Y-%m-%d"),b.UserID,null)) as RetentionRate01
                                         ,group_concat(distinct if(date_format(b.LastLoginTM,"%Y-%m-%d") = date_format(DATE_SUB(a.LastLoginTM,INTERVAL -3 DAY),"%Y-%m-%d"),b.UserID,null)) as RetentionRate03
                                         ,group_concat(distinct if(date_format(b.LastLoginTM,"%Y-%m-%d") = date_format(DATE_SUB(a.LastLoginTM,INTERVAL -7 DAY),"%Y-%m-%d"),b.UserID,null)) as RetentionRate07
                                         ,group_concat(distinct if(date_format(b.LastLoginTM,"%Y-%m-%d") = date_format(DATE_SUB(a.LastLoginTM,INTERVAL -14 DAY),"%Y-%m-%d"),b.UserID,null)) as RetentionRate14
                                         ,group_concat(distinct if(date_format(b.LastLoginTM,"%Y-%m-%d") = date_format(DATE_SUB(a.LastLoginTM,INTERVAL -30 DAY),"%Y-%m-%d"),b.UserID,null)) as RetentionRate30
                                 
                                     ')
                           ->group('t')
                          ->select();
        $infoDataActive = $this->NewArr($infoDataActive,$erverDay);
        $infoDataActive['title'] =  '活跃留存';
        /*************************付费留存******************************/
        $infoDataPay = M('web_rmbcost as a')
            ->join('web_rmbcost as b on a.Users_ids  = b.Users_ids
                                     ','left')
            ->where(' a.PaySuccess = 1 and  a.BackTime > "'.$timeEndStrtotime.'" and  a.BackTime < "'.$timeStartStrtotime.'"')
            ->field('date_format(a.BackTime,"%Y-%m-%d") as t
                                         ,count(distinct a.Users_ids) num    
                                         ,group_concat(distinct if(date_format(b.BackTime,"%Y-%m-%d") = date_format(DATE_SUB(a.BackTime,INTERVAL -1 DAY),"%Y-%m-%d"),b.Users_ids,null)) as RetentionRate01
                                         ,group_concat(distinct if(date_format(b.BackTime,"%Y-%m-%d") = date_format(DATE_SUB(a.BackTime,INTERVAL -3 DAY),"%Y-%m-%d"),b.Users_ids,null)) as RetentionRate03
                                         ,group_concat(distinct if(date_format(b.BackTime,"%Y-%m-%d") = date_format(DATE_SUB(a.BackTime,INTERVAL -7 DAY),"%Y-%m-%d"),b.Users_ids,null)) as RetentionRate07
                                         ,group_concat(distinct if(date_format(b.BackTime,"%Y-%m-%d") = date_format(DATE_SUB(a.BackTime,INTERVAL -14 DAY),"%Y-%m-%d"),b.Users_ids,null)) as RetentionRate14
                                         ,group_concat(distinct if(date_format(b.BackTime,"%Y-%m-%d") = date_format(DATE_SUB(a.BackTime,INTERVAL -30 DAY),"%Y-%m-%d"),b.Users_ids,null)) as RetentionRate30
                                     ')
            ->group('t')
            ->select();

        $infoDataPay = $this->NewArr($infoDataPay,$erverDay);
        $infoDataPay['title'] =  '付费留存';

        /*************************组装******************************/

        $info['infoDataRegister'] = $infoDataRegister;
        $info['infoDataActive'] = $infoDataActive;
        $info['infoDataPay'] = $infoDataPay;


        $newErverDay = array();
        foreach ($erverDay as $k=>$v){

            $newErverDay[] =  '"'.date('n月j日',$v).'"';
        }

        $newErverDay = implode(',',$newErverDay);
        $this->assign('datemin',$datemin);
        $this->assign('newErverDay',$newErverDay);
        $this->assign('erverDay',$erverDay);
        $this->assign('info',$info);
        $this->display();


    }

    /***
    *  日期组装数组 日期为30天
    * @param  $infoDataRegister array   数据源
    * @param  $erverDay         array   日期
    ***/
    public function  NewArr($infoDataRegister,$erverDay){
        $dataArr =  array();

        foreach ($erverDay as $k=>$v){
            $dataTime = date('Y-m-d',$v);
            $dataInfo = array();

            foreach ($infoDataRegister as $key => $val){
                if($dataTime==$val['t']){
                    //当天人数

                    $dataInfo['num'] = $val['num'];

                    //一日留存
                    if(empty($val['RetentionRate01'])){
                        $dataInfo['RetentionRate01'] = 0;

                    }else{
                        $RetentionRate01 = explode(',',$val['RetentionRate01']);
                        $RetentionRate01  = count($RetentionRate01);
                        $dataInfo['RetentionRate01'] = ($RetentionRate01/$val['num'])*100;
                    }
                    //3日留存
                    if(empty($val['RetentionRate03'])){
                        $dataInfo['RetentionRate03'] = 0;

                    }else{
                        $RetentionRate03 = explode(',',$val['RetentionRate03']);
                        $RetentionRate03  = count($RetentionRate03);
                        $dataInfo['RetentionRate03'] = ($RetentionRate03/$val['num'])*100;
                    }
                    //7日留存
                    if(empty($val['RetentionRate07'])){
                        $dataInfo['RetentionRate07'] = 0;

                    }else{
                        $RetentionRate07 = explode(',',$val['RetentionRate07']);
                        $RetentionRate07  = count($RetentionRate07);
                        $dataInfo['RetentionRate07'] = ($RetentionRate07/$val['num'])*100;
                    }
                    //14日留存
                    if(empty($val['RetentionRate14'])){
                        $dataInfo['RetentionRate14'] = 0;

                    }else{
                        $RetentionRate14 = explode(',',$val['RetentionRate14']);
                        $RetentionRate14  = count($RetentionRate14);
                        $dataInfo['RetentionRate14'] = ($RetentionRate14/$val['num'])*100;
                    }
                    //30日留存
                    if(empty($val['RetentionRate30'])){
                        $dataInfo['RetentionRate30'] = 0;

                    }else{
                        $RetentionRate30 = explode(',',$val['RetentionRate30']);
                        $RetentionRate30  = count($RetentionRate30);
                        $dataInfo['RetentionRate30'] = ($RetentionRate30/$val['num'])*100;
                    }
                }
            }
            if(empty($dataInfo)){
                $dataInfo['num'] = 0;
                $dataInfo['RetentionRate01'] = 0;
                $dataInfo['RetentionRate03'] = 0;
                $dataInfo['RetentionRate07'] = 0;
                $dataInfo['RetentionRate14'] = 0;
                $dataInfo['RetentionRate30'] = 0;
            }


            $dataInfo['t'] = date('n月j日',$v);
            $dataArr['data'][$k] = $dataInfo;

        }

        return $dataArr;
    }
}