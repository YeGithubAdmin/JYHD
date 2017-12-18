<?php
/***
*  转化率记录
*/
namespace Jy_script\Controller;
use Think\Controller;
class IpAddrLogController extends Controller {
    public function index(){
        $time       =  strtotime(date('Y-m-d',time()));
        $DaySecond  = 24*60*60;
        $StartTime  =  date('Y-m-d H:i:s',$time-$DaySecond);
        $EndTime    =  date('Y-m-d H:i:s',$time);
        $Field = array(
            'Type',
            'Channel',
            'count(distinct concat(mac,imei,imsi)) as Number',
            'date_format(DateTime,"%Y-%m-%d") as DateTime',
        );
        $catData = M('log_add_ip')
                   ->where('DateTime  >=  str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")
                            and  DateTime <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")')
                   ->field($Field)
                   ->group('Channel,Type')
                   ->select();

        $AddData = M('log_add_ip_pool')
                   ->addAll($catData);


     }
}