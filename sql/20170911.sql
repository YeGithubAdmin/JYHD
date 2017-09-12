/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.19-0ubuntu0.16.04.1 : Database - game_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`game_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `game_db`;

/*Table structure for table `account` */

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account` (
  `playerid` bigint(20) NOT NULL,
  `account_type` int(11) DEFAULT NULL COMMENT '帐号类型 (1游客，2自定义)',
  `os_type` int(11) DEFAULT NULL COMMENT '系统类型 (1ios, 2安卓)',
  `mac` varchar(128) DEFAULT NULL COMMENT 'mac地址',
  `imei` varchar(128) DEFAULT NULL COMMENT '手机序列号',
  `imsi` varchar(128) DEFAULT NULL COMMENT '运营商序列号',
  `uuid` varchar(128) DEFAULT NULL COMMENT '苹果uuid',
  `mobile` bigint(20) DEFAULT NULL COMMENT '手机号',
  `accountstate` int(11) DEFAULT NULL COMMENT '账户状态(1正常, 2封号, 3已经登录)',
  `regtime` varchar(24) DEFAULT NULL COMMENT '注册时间',
  `lasttime` varchar(24) DEFAULT NULL COMMENT '最后登录时间',
  `block_desc` varchar(255) DEFAULT NULL COMMENT '封号原因',
  `loginip` varchar(24) DEFAULT NULL COMMENT '登录ip',
  `reg_channel` varchar(32) DEFAULT NULL COMMENT '注册渠道号',
  `login_channel` varchar(32) DEFAULT NULL COMMENT '登录渠道号',
  `phone_model` varchar(24) DEFAULT NULL COMMENT '手机型号',
  `phone_os_ver` varchar(24) DEFAULT NULL COMMENT '手机系统版本',
  `game_ver` varchar(24) DEFAULT NULL COMMENT '游戏版本号',
  `icon_url` varchar(64) DEFAULT NULL COMMENT '头像url',
  `communiid` bigint(20) DEFAULT NULL COMMENT '通讯id',
  `account_name` varchar(24) DEFAULT NULL COMMENT '自定义账号名',
  `pwd` varchar(24) DEFAULT NULL COMMENT '自定义密码',
  `logout_time` varchar(24) DEFAULT NULL COMMENT '最后离线时间',
  PRIMARY KEY (`playerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `account` */

/*Table structure for table `player` */

DROP TABLE IF EXISTS `player`;

CREATE TABLE `player` (
  `playerid` bigint(20) NOT NULL COMMENT '玩家id',
  `name` varchar(64) DEFAULT NULL COMMENT '昵称',
  `sex` int(11) DEFAULT NULL COMMENT '1 男 2 女',
  `vip` int(11) DEFAULT NULL COMMENT 'vip 等级',
  `vip_exp` int(11) DEFAULT NULL COMMENT 'vip 经验',
  `status` int(11) DEFAULT NULL COMMENT '游戏状态（1离线，2在线，3玩牌）',
  `serverid` int(11) DEFAULT NULL COMMENT '所在游戏服务器id',
  `game_type` int(11) DEFAULT NULL COMMENT '所在游戏类型',
  `room_type` int(11) DEFAULT NULL COMMENT '所在房间类型',
  `level_type` int(11) DEFAULT NULL COMMENT '所在场次类型',
  `roomid` int(11) DEFAULT NULL COMMENT '所在房间id',
  `gold` bigint(20) DEFAULT NULL COMMENT '金币',
  `diamond` bigint(20) DEFAULT NULL COMMENT '钻石',
  `deposit` bigint(20) DEFAULT NULL COMMENT '存款',
  `profit` bigint(20) DEFAULT NULL COMMENT '当日盈利',
  `glevel` int(11) DEFAULT NULL COMMENT '游戏等级',
  `gexp` int(11) DEFAULT NULL COMMENT '游戏经验',
  `gun_coin` int(11) DEFAULT NULL COMMENT '炮的硬币点数',
  `sign_day` int(11) DEFAULT NULL COMMENT '累计签到天数',
  `sign_time` bigint(20) DEFAULT NULL COMMENT '签到时间',
  `gunid` int(11) DEFAULT NULL COMMENT '当前炮的id',
  `is_mc` int(11) DEFAULT NULL COMMENT '是否是月卡用户',
  `mc_overtime` bigint(20) DEFAULT NULL COMMENT '月卡结束时间',
  PRIMARY KEY (`playerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `player` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
