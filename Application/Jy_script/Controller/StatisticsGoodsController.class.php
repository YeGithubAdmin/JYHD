<?php
/***
*  商品付费情况
*/
namespace Jy_script\Controller;
use Think\Controller;
class StatisticsGoodsController extends Controller {
    public function index(){
        $time       =  strtotime(date('Y-m-d',time()));
        $time       =  strtotime('2017-10-24');
        $DaySecond  = 24*60*60;
        $StartTime  =  date('Y-m-d H:i:s',$time-$DaySecond);
        $EndTime    =  date('Y-m-d H:i:s',$time);
        //渠道
        $ChannelData = M('jy_admin_users')
                       ->where('channel = 2 and  isdel = 1')
                       ->field('account')
                       ->select();
        if(empty($ChannelData)){
              exit('无渠道');
        }
        foreach ($ChannelData as $k=>$v) $ChannelDataSort[] = '"'.$v['account'].'"';
        $Channel = implode(',',$ChannelDataSort);
        //账号活跃
        $CatUsersOrderField = array(
                'b.GoodsID',
                'a.PayChannel as Channel',
                'count(b.GoodsID) as GoodsTotal',
                'count(if(a.`Status` = 2,b.GoodsID,null)) as GoodsSuccess',
        );
        $CatUsersOrder = M('jy_users_order_info as a')
                         ->join('jy_users_order_goods as b on a.playerid = b.playerid and a.PlatformOrder = b.PlatformOrder and b.IsGive = 1')
                         ->where('a.PayChannel in ('.$Channel.')  and   a.FoundTime  < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") 
                                  and  a.FoundTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
                         ->field($CatUsersOrderField)
                         ->group('b.GoodsID,b.GoodsID')
                         ->select();
        if(!empty($CatUsersOrder)){
            foreach ($CatUsersOrder as $k=>$v){
                $CatUsersOrder[$k]['DateTime'] =   $StartTime;
            }
        }else{
            exit();
        }


        $addStatisticsGoods = M('jy_statistics_goods')
                            ->addAll($CatUsersOrder);
        exit('结束');

     }
}