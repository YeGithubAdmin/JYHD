<?php
/***
*  在线人统计
*/
namespace Jy_script\Controller;
use Think\Controller;
class RealTimeOnlineController extends Controller {
    public function index(){
        $catRealTimeOnlineFiel   = array(
            'count(playerid) UserNum',
            'level_type as Screenings'
        );
        $catRealTimeOnline    = M('game_player')
                                ->where('status > 1')
                                ->group('Screenings')
                                ->field($catRealTimeOnlineFiel)
                                ->select();
        print_r($catRealTimeOnline);
        if(!empty($catRealTimeOnline)){
           $addRealTimeOnline = M('jy_real_time_online')
                                ->addAll($catRealTimeOnline);
        }
        exit();
     }
}