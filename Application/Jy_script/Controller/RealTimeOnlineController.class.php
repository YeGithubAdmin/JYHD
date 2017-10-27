<?php
/***
*  在线人统计
*/
namespace Jy_script\Controller;
use Think\Controller;
class RealTimeOnlineController extends Controller {
    public function index(){
        $catRealTimeOnlineFiel   = array(
            'count(a.playerid) UserNum',
            'b.login_channel as Channel',
            'a.level_type as Screenings',
        );
        $catRealTimeOnline    = M('game_player as a')
                                ->join('game_account as b on  a.playerid = b.playerid')
                                ->where('status > 1')
                                ->group('Screenings,Channel')
                                ->field($catRealTimeOnlineFiel)
                                ->select();
        if(!empty($catRealTimeOnline)){
           $addRealTimeOnline = M('jy_real_time_online')
                                ->addAll($catRealTimeOnline);
        }
        exit();
     }
}