<?php
namespace Jy_createtabel\Controller;
use Think\Controller;
use Think\Model;

class ReschangeActionController extends Controller {
    public function index(){
        $model =  new Model();
        $day = 24*60*60;
        $date = date('Y-m-d',strtotime(date('Y-m-d'))+$day);
        $TableName = 'game_reschange_action_'.$date;
        $model->query('
                        CREATE TABLE `'.$TableName.'` (
                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                          `playerid` bigint(20) unsigned DEFAULT NULL,
                          `account_type` tinyint(4) DEFAULT NULL,
                          `os_type` tinyint(4) DEFAULT NULL,
                          `login_channel` varchar(64) DEFAULT NULL,
                          `reg_channel` varchar(64) DEFAULT NULL,
                          `game_ver` varchar(24) DEFAULT NULL,
                          `itemid` int(11) DEFAULT NULL,
                          `add_num` int(11) DEFAULT NULL,
                          `cur_num` int(11) DEFAULT NULL,
                          `reason` tinyint(4) DEFAULT NULL,
                          `opt_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                          PRIMARY KEY (`id`),
                          KEY `itemid` (`itemid`) USING BTREE,
                          KEY `reason` (`reason`) USING BTREE,
                          KEY `playerid` (`playerid`) USING BTREE,
                          KEY `opt_time` (`opt_time`)
                        ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;');
    }

}