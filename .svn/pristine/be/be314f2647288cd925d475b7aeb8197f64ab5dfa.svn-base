<?php
/***
*   全局数据
*/
namespace Jy_admin\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class GlobalDataController extends ComController {
    //列表
    public function index(){
        $time   = date('Y-m-d',time());                                           //当前时间
        $btime   = date('Y-m-d',time()-24*60*60);                       //默认当前昨天
        $datemin = I('param.datemin',$btime,'trim');                                     //搜索时间
        if($datemin == $time){
            $datemin = $btime;

        }
         $strtotime  = strtotime($datemin);
         $timeOne = $datemin;                                                                       //时间段：前天
         $timeOneStrtotime = date('Y-m-d',strtotime($timeOne)+60*60*24) ;
         $timeTow  = date('Y-m-d',$strtotime-24*60*60);                  //时间段：大前天
         $timeEight = date('Y-m-d',$strtotime-7*24*60*60);                      //时间段：前8天
         $timeEightStrtotime =  date('Y-m-d',strtotime($timeEight)-60*60*24) ;
         $erverDay = array();
          //八天时间
            for($i=7;$i>=0;$i--){
                $erverDayTime = $strtotime-$i*24*60*60;
                if($erverDayTime >= strtotime($timeEight)){
                    $erverDay[$i] = $erverDayTime;
                }
            }
        //排序数组
        ksort($erverDay);
        /***
         *注册用户
         * 描述：统计所选时期内，每日新增激活的用户数量。
         ***/
        $webUsers = M('web_users')
                    ->where('RegisterTM >= "%s" and  RegisterTM < "%s"',$timeEightStrtotime,$timeOneStrtotime)
                    ->field('date_format(RegisterTM,"%Y-%m-%d") as t,count(UserID) as num,unix_timestamp(RegisterTM) as time')
                    ->group('t')
                    ->order('RegisterTM asc')
                    ->select();
        $webUsersData = array();
        $webUsersData = $this->DataArr($webUsers,$webUsersData,$erverDay,$timeOne,$timeTow,$timeEight);
        $webUsersData['Mom'] =  ($webUsersData['timeTow']/$webUsersData['timeOne'])*100;
        $webUsersData['An'] =   ($webUsersData['timeEight']/$webUsersData['timeOne'])*100;
        $webUsersData['title'] = "注册用户";
        $webUsersData['Symbol'] = "人";
        /***
         * 活跃用户
         * 描述：统计所选时期内，每日成功登录游戏的用户数量，去重。
         ***/
        $WebvUserLoginList = M('web_vuserloginlist')
                            ->where('LastLoginTM >= "%s" and  LastLoginTM < "%s"',$timeEightStrtotime,$timeOneStrtotime)
                            ->field('date_format(LastLoginTM,"%Y-%m-%d") as t,count(distinct  UserID) as num,unix_timestamp(LastLoginTM) as time')
                            ->group('t')
                            ->select();
        $WebvUserLoginListData = array();
        $WebvUserLoginListData = $this->DataArr($WebvUserLoginList,$WebvUserLoginListData,$erverDay,$timeOne,$timeTow,$timeEight);
        $WebvUserLoginListData['Mom'] =  ($WebvUserLoginListData['timeTow']/$WebvUserLoginListData['timeOne'])*100;
        $WebvUserLoginListData['An'] =   ($WebvUserLoginListData['timeEight']/$WebvUserLoginListData['timeOne'])*100;
        $WebvUserLoginListData['title'] = "活跃用户";
        $WebvUserLoginListData['Symbol'] = "人";

        /***
         * 收入(元)
         * 描述：统计所选时期内，每日用户成功充值的金额总值。单位为元。
         ***/
        $webRmbcost = M('web_rmbcost')
            ->where('PaySuccess = 1  and BackTime >= "%s" and  BackTime < "%s"',$timeEightStrtotime,$timeOneStrtotime)
            ->field('date_format(BackTime,"%Y-%m-%d") as t,count(PayMoney) as num,unix_timestamp(BackTime) as time')
            ->group('t')
            ->select();

        $webRmbcostData = array();
        $webRmbcostData = $this->DataArr($webRmbcost,$webRmbcostData,$erverDay,$timeOne,$timeTow,$timeEight);
        $webRmbcostData['Mom'] =  ($webRmbcostData['timeTow']/$webRmbcostData['timeOne'])*100;
        $webRmbcostData['An'] =   ($webRmbcostData['timeEight']/$webRmbcostData['timeOne'])*100;
        $webRmbcostData['title'] = "收入分析";
        $webRmbcostData['Symbol'] = "元";
        /****
         * 付费用户数
         * 描述：统计所选时期内，每日成功充值的用户数量，去重。
         **/
        $webRmbcostUsersNum = M('web_rmbcost')
            ->where('PaySuccess = 1  and BackTime >= "%s" and  BackTime < "%s"',$timeEightStrtotime,$timeOneStrtotime)
            ->field('date_format(BackTime,"%Y-%m-%d") as t,count(distinct Users_ids) as num,unix_timestamp(BackTime) as time')
            ->group('t')
            ->select();
        $webRmbcostUsersNumData = array();
        $webRmbcostUsersNumData = $this->DataArr($webRmbcostUsersNum,$webRmbcostUsersNumData,$erverDay,$timeOne,$timeTow,$timeEight);
        $webRmbcostUsersNumData['Mom'] =  ($webRmbcostUsersNumData['timeTow']/$webRmbcostUsersNumData['timeOne'])*100;
        $webRmbcostUsersNumData['An'] =   ($webRmbcostUsersNumData['timeEight']/$webRmbcostUsersNumData['timeOne'])*100;
        $webRmbcostUsersNumData['title'] = "付费用户数";
        $webRmbcostUsersNumData['Symbol'] = "";
        /***
         * 付费次数
         * 描述:统计所选时期内，每日用户成功充值总次数。
         ***/


        $webRmbcostUsers = M('web_rmbcost')
            ->where('PaySuccess = 1  and BackTime >= "%s" and  BackTime < "%s"',$timeEightStrtotime,$timeOneStrtotime)
            ->field('date_format(BackTime,"%Y-%m-%d") as t,count(distinct Users_ids) as num,unix_timestamp(BackTime) as time')
            ->group('t')
            ->select();
        $webRmbcostUsersData = array();
        $webRmbcostUsersData = $this->DataArr($webRmbcostUsers,$webRmbcostUsersData,$erverDay,$timeOne,$timeTow,$timeEight);
        $webRmbcostUsersData['Mom'] =  ($webRmbcostUsersData['timeTow']/$webRmbcostUsersData['timeOne'])*100;
        $webRmbcostUsersData['An'] =   ($webRmbcostUsersData['timeEight']/$webRmbcostUsersData['timeOne'])*100;
        $webRmbcostUsersData['title'] = "付费次数";
        $webRmbcostUsersData['Symbol'] = "";

        /***
         * 注册付费渗透率
         * 描述：统计所选时期内，当天注册且当天付费的用户数/当天注册用户数
         ***/
            //用户注册数量
        $registerUserNum = $webUsersData;
           //用户注册且付费
        $registerUserPay = M('web_users as a')
            ->join('web_rmbcost as b')
            ->where('a.UserID  = b.Users_ids  and   b.PaySuccess  = 1  and a.RegisterTM >= "%s" and  a.RegisterTM < "%s"  and b.BackTime >= "%s" and  b.BackTime < "%s" ',$timeEightStrtotime,$timeOneStrtotime,$timeEightStrtotime,$timeOneStrtotime)
            ->field('date_format(a.RegisterTM,"%Y-%m-%d") as t,count(distinct b.Users_ids) as num,unix_timestamp(a.RegisterTM) as time')
            ->group('t')
            ->order('a.RegisterTM asc')
            ->select();

        $registerUserPayData =  array();
        $registerUserPayData = $this->DataArr($registerUserPay,$registerUserPayData,$erverDay,$timeOne,$timeTow,$timeEight);

        $NewRegisterUserPayData = array();
        foreach ($registerUserPayData['erverDay'] as $k=>$v){
           foreach ($registerUserNum['erverDay'] as $key=>$val){
               if($k == $key){
                   $NewRegisterUserPayData['erverDay'][$key]['num'] = $v['num']/$val['num']*100;
                   $NewRegisterUserPayData['erverDay'][$key]['day'] = $v['day'];
               }

           }
        }
        $NewRegisterUserPayData['timeOne']          =  $registerUserPayData['timeOne']/$registerUserNum['timeOne']*100;
        $NewRegisterUserPayData['timeTow']          =  $registerUserPayData['timeTow']/$registerUserNum['timeTow']*100;
        $NewRegisterUserPayData['timeEight']        =  $registerUserPayData['timeTow']/$registerUserNum['timeTow']*100;
        $NewRegisterUserPayData['Mom'] =  ($registerUserPayData['timeTow']/$registerUserPayData['timeOne'])*100;
        $NewRegisterUserPayData['An'] =   ($registerUserPayData['timeEight']/$registerUserPayData['timeOne'])*100;
        $NewRegisterUserPayData['title'] = "注册付费渗透率";
        $NewRegisterUserPayData['Symbol'] = "%";
        /****
         * 活跃付费渗透率
         * 描述：统计所选时期内，每日成功付费用户占当日活跃用户的比例。
         */
        $activePayData = array();
        foreach ($webRmbcostUsersNumData['erverDay'] as $k=>$v){
            foreach ($WebvUserLoginListData['erverDay'] as $key=>$val){
                if($k == $key){
                    $activePayData['erverDay'][$key]['num'] = $v['num']/$val['num']*100;
                    $activePayData['erverDay'][$key]['day'] = $v['day'];
                }

            }
        }

        $activePayData['timeOne']          =  $webRmbcostUsersNumData['timeOne']/$WebvUserLoginListData['timeOne']*100;
        $activePayData['timeTow']          =  $webRmbcostUsersNumData['timeTow']/$WebvUserLoginListData['timeTow']*100;
        $activePayData['timeEight']        =  $webRmbcostUsersNumData['timeTow']/$WebvUserLoginListData['timeTow']*100;
        $activePayData['Mom'] =  ($webRmbcostUsersNum['timeTow']/$webRmbcostUsersNum['timeOne'])*100;
        $activePayData['An'] =   ($webRmbcostUsersNum['timeEight']/$webRmbcostUsersNum['timeOne'])*100;
        $activePayData['title'] = "活跃付费渗透率";
        $activePayData['Symbol'] = "%";

        /***
         * ARPPU
         * 描述：日ARPPU=当日充值总额度/当日付费用户数量。
         **/
        $ARPPUData = array();
        foreach ($webRmbcostData['erverDay'] as $k=>$v){
            foreach ($webRmbcostUsersNumData['erverDay'] as $key=>$val){
                if($k == $key){
                    $ARPPUData['erverDay'][$key]['num'] = $v['num']/$val['num']*100;
                    $ARPPUData['erverDay'][$key]['day'] = $v['day'];
                }
            }
        }
        $ARPPUData['timeOne']          =  $webRmbcostData['timeOne']/$webRmbcostUsersNumData['timeOne']*100;
        $ARPPUData['timeTow']          =  $webRmbcostData['timeTow']/$webRmbcostUsersNumData['timeTow']*100;
        $ARPPUData['timeEight']        =  $webRmbcostData['timeTow']/$webRmbcostUsersNumData['timeTow']*100;
        $ARPPUData['Mom'] =  ($webRmbcostData['timeTow']/$webRmbcostData['timeOne'])*100;
        $ARPPUData['An'] =   ($webRmbcostData['timeEight']/$webRmbcostData['timeOne'])*100;
        $ARPPUData['title'] = "ARPPU";
        $ARPPUData['Symbol'] = "%";






        /**********************************注册1日留存率****************************************/

        /**********************************注册30日留存率****************************************/

        /**********************************注册30日留存率****************************************/

        /**********************************平均在线****************************************/

        /**********************************最高在线****************************************/

        /**********************************数组****************************************/
         $dataInfo['webUsersData']  = $webUsersData;                        //注册分析
         $dataInfo['WebvUserLoginListData']  = $WebvUserLoginListData;      //活跃分析
         $dataInfo['webRmbcostData']  = $webRmbcostData;                    //收入分析
         $dataInfo['webRmbcostUsersNumData']  = $webRmbcostUsersNumData;    //付费用户数
         $dataInfo['webRmbcostUsersData']  = $webRmbcostUsersData;          //付费次数
         $dataInfo['NewRegisterUserPayData']  = $NewRegisterUserPayData;    //注册付费渗透率
         $dataInfo['activePayData']  = $activePayData;                      //活跃付费渗透率
         $dataInfo['ARPPUData']  = $ARPPUData;                      //ARPPU
        $this->assign('timeOne',date('n月j日',$strtotime));
        $this->assign('timeTow',date('n月j日',$strtotime-24*60*60));
        $this->assign('timeEight',date('n月j日',$strtotime-8*24*60*60));
        $this->assign('datemin',$datemin);
        $this->assign('dataInfo',$dataInfo);
        $this->display('index');
    }

    /****
    * 组装数组
    * @param  $webRmbcostUsersNum   array      新数组
    * @param  $erverDay             array      8天时间
    * @param  $timeOne               array      前一天
    * @param  $timeTow               array      大前天
    * @param  $timeEight               array      大前天
    * @param  $timeEight               array      8天前
    *****/
    public  function  DataArr($webRmbcostUsersNum,$webRmbcostUsersNumData,$erverDay,$timeOne,$timeTow,$timeEight){

        foreach ($webRmbcostUsersNum as $k=>$v){
            if($v['t'] == $timeOne){
                $webRmbcostUsersNumData['timeOne'] = $v['num'];
            }
            if($v['t'] == $timeTow){
                $webRmbcostUsersNumData['timeTow'] = $v['num'];
            }
            if($v['t'] == $timeEight){
                $webRmbcostUsersNumData['timeEight'] = $v['num'];
            }
        }

        foreach ($erverDay as $k=>$v){
            $vTime =  date('Y-m-d',$v);

            $valTime = 0;
            foreach ($webRmbcostUsersNum as $key =>$val){
                if($val['t'] == $vTime){
                    $valTime  = $val['num'];
                }
            }
            $webRmbcostUsersNumData['erverDay'][$k]['num'] = $valTime;
            $webRmbcostUsersNumData['erverDay'][$k]['day'] = date('n月j日',$v);
        }
        //判断是否为空值
        if(empty($webRmbcostUsersNumData['timeOne'])){
            $webRmbcostUsersNumData['timeOne'] = 0;
        }

        if(empty($webRmbcostUsersNumData['timeTow'])){
            $webRmbcostUsersNumData['timeTow'] = 0;
        }

        if(empty($webRmbcostUsersNumData['timeEight'])){
            $webRmbcostUsersNumData['timeEight'] = 0;
        }

        return $webRmbcostUsersNumData;
    }

}