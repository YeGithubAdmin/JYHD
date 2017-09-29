<?php
/***
 *  留存信息-流失
 ***/
namespace Jy_admin\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class RetainedDataLossController extends ComController {
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
        //30天时间
        for($i=($timeEndDay-1);$i>=0;$i--){
            $erverDayTime = $strtotime-$i*$dayTime;
            if($erverDayTime >= ($strtotime-($timeEndDay-1)* $dayTime)){
                $erverDay[$i] = $erverDayTime;

            }
        }
        //排序数组
         ksort($erverDay);
        //时间范围
        $EndTime   = date('Y-m-d H:i:s',$strtotime+$dayTime);
        $StartTime = date('Y-m-d H:i:s',$strtotime-$timeEndDay*$dayTime);
        $RegInfoField = array(
             'date_format(a.regtime,"%Y-%m-%d") as t',
             'count(a.playerid) as UserNum',
             'count(a.playerid) - count(distinct b.playerid) as UsersOneNum',
             'count(a.playerid) - count(distinct c.playerid) as UsersThreeNum',
             'count(a.playerid) - count(distinct d.playerid) as UsersSevenNum',
             'count(a.playerid) - count(distinct e.playerid) as UsersFourteenNum',
             'count(a.playerid) - count(distinct f.playerid) as UsersThirtyNum',
        );
        $RegInfo = M('game_account as a')
                   ->join('game_login_action as b on a.playerid = b.playerid 
                                 and b.login_time < str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL -2 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and b.login_time >= str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL -1 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
                   ->join('game_login_action as c on a.playerid = c.playerid 
                                 and c.login_time < str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL  -4 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and c.login_time >= str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL  -3 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
                   ->join('game_login_action as d on a.playerid = d.playerid 
                                 and d.login_time < str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL -8 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and d.login_time >= str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL  -7 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
                   ->join('game_login_action as e on a.playerid = e.playerid 
                                 and e.login_time < str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL -15 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and e.login_time >= str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL  -14 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
                   ->join('game_login_action as f on a.playerid = f.playerid 
                                 and f.login_time < str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL -31 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and f.login_time >= str_to_date(date_format(DATE_SUB(a.regtime,INTERVAL  -30 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
                   ->where('a.regtime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and a.regtime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
                    ->group('t')
                   ->field($RegInfoField)
                   ->select();
        $RegInfo = $this->NewArr($RegInfo,$erverDay);
        //活跃留存
        $ActiveInfoField = array(
            'date_format(a.login_time,"%Y-%m-%d") as t',
            'count(distinct a.playerid) - count(distinct a.playerid) as UserNum',
            'count(distinct a.playerid) - count(distinct b.playerid) as UsersOneNum',
            'count(distinct a.playerid) - count(distinct c.playerid) as UsersThreeNum',
            'count(distinct a.playerid) - count(distinct d.playerid) as UsersSevenNum',
            'count(distinct a.playerid) - count(distinct e.playerid) as UsersFourteenNum',
            'count(distinct a.playerid) - count(distinct f.playerid) as UsersThirtyNum',
        );
        $ActiveInfo =  M('game_login_action as a')
            ->join('game_login_action as b on a.playerid = b.playerid 
                                 and b.login_time < str_to_date(date_format(DATE_SUB(a.login_time,INTERVAL -2 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and b.login_time >= str_to_date(date_format(DATE_SUB(a.login_time,INTERVAL -1 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('game_login_action as c on a.playerid = c.playerid 
                                 and c.login_time < str_to_date(date_format(DATE_SUB(a.login_time,INTERVAL  -4 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and c.login_time >= str_to_date(date_format(DATE_SUB(a.login_time,INTERVAL  -3 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('game_login_action as d on a.playerid = d.playerid 
                                 and d.login_time < str_to_date(date_format(DATE_SUB(a.login_time,INTERVAL -8 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and d.login_time >= str_to_date(date_format(DATE_SUB(a.login_time,INTERVAL  -7 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('game_login_action as e on a.playerid = e.playerid 
                                 and e.login_time < str_to_date(date_format(DATE_SUB(a.login_time,INTERVAL -15 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and e.login_time >= str_to_date(date_format(DATE_SUB(a.login_time,INTERVAL  -14 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('game_login_action as f on a.playerid = f.playerid 
                                 and f.login_time < str_to_date(date_format(DATE_SUB(a.login_time,INTERVAL -31 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and f.login_time >= str_to_date(date_format(DATE_SUB(a.login_time,INTERVAL  -30 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->where('a.login_time < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and a.login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
            ->group('t')
            ->field($ActiveInfoField)
            ->select();

        $ActiveInfo = $this->NewArr($ActiveInfo,$erverDay);
        //付费留存
        $PayInfoField = array(
            'date_format(a.CallbackTime,"%Y-%m-%d") as t',
            'count(distinct a.playerid) - count(distinct a.playerid) as UserNum',
            'count(distinct a.playerid) - count(distinct b.playerid) as UsersOneNum',
            'count(distinct c.playerid) as UsersThreeNum',
            'count(distinct d.playerid) as UsersSevenNum',
            'count(distinct e.playerid) as UsersFourteenNum',
            'count(distinct f.playerid) as UsersThirtyNum',
        );
        $PayInfo =  M('jy_users_order_info as a')
            ->join('jy_users_order_info as b on a.playerid = b.playerid 
                                 and b.CallbackTime < str_to_date(date_format(DATE_SUB(a.CallbackTime,INTERVAL -2 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and b.CallbackTime >= str_to_date(date_format(DATE_SUB(a.CallbackTime,INTERVAL -1 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('jy_users_order_info as c on a.playerid = c.playerid 
                                 and c.CallbackTime < str_to_date(date_format(DATE_SUB(a.CallbackTime,INTERVAL  -4 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and c.CallbackTime >= str_to_date(date_format(DATE_SUB(a.CallbackTime,INTERVAL  -3 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('jy_users_order_info as d on a.playerid = d.playerid 
                                 and d.CallbackTime < str_to_date(date_format(DATE_SUB(a.CallbackTime,INTERVAL -8 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and d.CallbackTime >= str_to_date(date_format(DATE_SUB(a.CallbackTime,INTERVAL  -7 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('jy_users_order_info as e on a.playerid = e.playerid 
                                 and e.CallbackTime < str_to_date(date_format(DATE_SUB(a.CallbackTime,INTERVAL -15 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and e.CallbackTime >= str_to_date(date_format(DATE_SUB(a.CallbackTime,INTERVAL  -14 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->join('jy_users_order_info as f on a.playerid = f.playerid 
                                 and f.CallbackTime < str_to_date(date_format(DATE_SUB(a.CallbackTime,INTERVAL -31 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") 
                                 and f.CallbackTime >= str_to_date(date_format(DATE_SUB(a.CallbackTime,INTERVAL  -30 DAY),"%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")','left')
            ->where(' a.Status = 2 and  a.CallbackTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and a.CallbackTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
            ->group('t')

            ->field($PayInfoField)
            ->select();

        $PayInfo = $this->NewArr($PayInfo,$erverDay);




        $info['infoDataRegister'] = $RegInfo;
        $info['infoDataActive']   = $ActiveInfo;
        $info['infoDataPay']   = $PayInfo;
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
                if($dataTime==$val['t']) {
                    $dataInfo['UserNum']                =   $val['UserNum'];
                    $dataInfo['UsersOneNum']            =   round(($val['UsersOneNum']/$val['UserNum'])*100,2);
                    $dataInfo['UsersThreeNum']          =   round(($val['UsersThreeNum']/$val['UserNum'])*100,2);
                    $dataInfo['UsersSevenNum']          =   round(($val['UsersSevenNum']/$val['UserNum'])*100,2);
                    $dataInfo['UsersFourteenNum']       =   round(($val['UsersFourteenNum']/$val['UserNum'])*100,2);
                    $dataInfo['UsersThirtyNum']         =   round(($val['UsersThirtyNum']/$val['UserNum'])*100,2);

                }
            }
            if(empty($dataInfo)){
                $dataInfo['UserNum']            =   0;
                $dataInfo['UsersOneNum']        =   0;
                $dataInfo['UsersThreeNum']      =   0;
                $dataInfo['UsersSevenNum']      =   0;
                $dataInfo['UsersFourteenNum']   =   0;
                $dataInfo['UsersThirtyNum']     =   0;
            }

            $dataInfo['t'] = date('n月j日',$v);
            $dataArr['data'][$k] = $dataInfo;

        }

        return $dataArr;
    }


}