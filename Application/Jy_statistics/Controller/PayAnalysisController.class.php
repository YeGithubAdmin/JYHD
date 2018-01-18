<?php
/***
*   付费分析
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class PayAnalysisController extends ComController {
    //日付费统计
    public function DailyPay(){
       $this->display();
    }
    //首充付费时间统计
    public function TimeStatistics(){
        $this->display();
    }
    //订单流水
    public function OrderFlow(){
        $this->display();
    }
}