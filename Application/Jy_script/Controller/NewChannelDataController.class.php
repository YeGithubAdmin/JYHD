<?php
namespace Jy_script\Controller;
use Think\Controller;
use Think\Model;
class NewChannelDataController extends Controller {
    public function index(){
        //统计时间
        $time = strtotime(date('Y-m-d'),time());
        $day  = 24*60*60;
        $EndTime   = date('Y-m-d H:i:s',$time);
        $StartTime = date('Y-m-d H:i:s',$time-$day);
        $model = new Model();
        $info = $model->query(
            'select
           a.`alipay`,
           a.`weixin`,
           a.`JinPay`,
           a.`iappay`,
           a.`PayNum`,
           a.`UserPayNum`,
           a.`RegNum`,
           a.`EquipmentRegNum`,
           a.`ActiveNum`,
           a.`TotalMoney`,
           a.`Success`,
           a.`UserPayNumOld`,
           a.`OrderTotalOld`,
           a.`OrderTotal`,
           a.`UsersOneNum`,
           a.`UsersTowNum`,
           a.`UsersThreeNum`,
           a.`UsersSevenNum`,
           a.`UsersFifteenNum`,
           a.`UsersThirtyNum`,
           a.`Channel`,
           a.`FirstMoney`,
           a.`DateTime`
         from  (select * from  jy_statistics_users_pay  where 
        `DateTime` < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  
         and  `DateTime` >=  str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")    
         order by `DateTime` desc) as a  group by a.Channel '
        );
        //添加数据
        $addStatisticsUsersPay = $model
            ->table('log_channel_data')
            ->addAll($info);
    exit();

    }
}