<?php
namespace Jy_createtabel\Controller;
use Think\Controller;
use Think\Model;

class ReschangeActionController extends Controller {
    public function index(){
        $model =  new Model();
        $day = 24*60*60;
        $date = date('Ymd',strtotime(date('Y-m-d'))+$day);
        $TableName = 'game_reschange_action'.$date;
        $model->query('DROP TABLE IF EXISTS `'.$TableName.'`;
                        CREATE TABLE `'.$TableName.'` (
                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                          `playerid` bigint(20) unsigned DEFAULT NULL COMMENT \'用户ID\',
                          `account_type` tinyint(4) DEFAULT NULL COMMENT \'账号类型（1游客，2自定义）\',
                          `os_type` tinyint(4) DEFAULT NULL COMMENT \'系统类型 (1ios, 2安卓)\',
                          `login_channel` varchar(64) DEFAULT NULL COMMENT \'登录渠道\',
                          `reg_channel` varchar(64) DEFAULT NULL COMMENT \'注册渠道\',
                          `game_ver` varchar(24) DEFAULT NULL COMMENT \'游戏版本号\',
                          `itemid` int(11) DEFAULT NULL COMMENT \'物品ID\',
                          `add_num` int(11) DEFAULT NULL COMMENT \'增量\',
                          `cur_num` int(11) DEFAULT NULL COMMENT \'总量\',
                          `reason` tinyint(4) NOT NULL,
                          `opt_time` datetime DEFAULT NULL COMMENT \'时间\',
                          PRIMARY KEY (`id`),
                          KEY `playerid` (`playerid`,`reason`,`opt_time`)
                        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;');
    }

}