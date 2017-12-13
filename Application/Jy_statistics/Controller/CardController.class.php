<?php
/**
*   物品流水
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class CardController extends ComController {
    //列表
    public function index(){
        $catDate = M('jy_users_exchange_log as a')
                   ->join('game_player_numerical as b on a.playerid = b.playerid')
                   ->where('a.Status in(1,2) and a.Type > 3')
                   ->field(array(
                       'a.playerid',
                       'b.exchange_rmb30',
                       'sum(a.StockNum) as StockNum',
                       'a.DateTime',
                   ))
                   ->group('a.playerid')
                   ->select();

        print_r($catDate);
    }

}