<?php
/***
 *  留存信息-流失
 ***/
namespace Jy_statistics\Controller;
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