<?php
/***
* 物品流水
*/
namespace Jy_script\Controller;
use Think\Controller;
class GameReschangeActionController extends Controller {
    public function index(){
        $time       =  strtotime(date('Y-m-d',time()));
        $DaySecond  = 24*60*60;
        $StartTime  =  date('Y-m-d H:i:s',$time-$DaySecond);
        $EndTime    =  date('Y-m-d H:i:s',$time);
        //渠道
        $SummaryGoodsField = array(
            'os_type as Ostype',
            'count(distinct playerid) as UserNum',
            'login_channel as Channel',
            'game_ver as VerSion',
            'itemid as Itemid',
            'reason as Reason',
            'opt_time as DataTime',
            'sum(add_num) as Number',
        );
        $SummaryGoods = M('game_reschange_action')
                        ->where('opt_time  < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  
                            and opt_time  >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
                        ->field($SummaryGoodsField)
                        ->order('Reason')
                        ->group('Ostype,Channel,Itemid,Reason,VerSion')
                        ->select();
        if(empty($SummaryGoods)){
            exit('无数据');
        }
        //添加数据
        $addDate = M('summary_goods')
                  ->addAll($SummaryGoods);
        exit('结束');

     }
}