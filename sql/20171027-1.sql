/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.6.33-0ubuntu0.14.04.1-log : Database - jyhd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jyhd` /*!40100 DEFAULT CHARACTER SET utf8 */;

/*Table structure for table `game_account` */

DROP TABLE IF EXISTS `game_account`;

CREATE TABLE `game_account` (
  `playerid` bigint(20) NOT NULL,
  `account_type` int(11) DEFAULT NULL COMMENT '帐号类型 (1游客，2自定义)',
  `os_type` int(11) DEFAULT NULL COMMENT '系统类型 (1ios, 2安卓)',
  `mac` varchar(128) DEFAULT NULL COMMENT 'mac地址',
  `imei` varchar(128) DEFAULT NULL COMMENT '手机序列号',
  `imsi` varchar(128) DEFAULT NULL COMMENT '运营商序列号',
  `uuid` varchar(128) DEFAULT NULL COMMENT '苹果uuid',
  `mobile` bigint(20) DEFAULT NULL COMMENT '手机号',
  `accountstate` int(11) DEFAULT NULL COMMENT '账户状态(1正常, 2封号, 3已经登录)',
  `regtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `lasttime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后登录时间',
  `block_desc` varchar(255) DEFAULT NULL COMMENT '封号原因',
  `loginip` varchar(24) DEFAULT NULL COMMENT '登录ip',
  `reg_channel` varchar(32) DEFAULT NULL COMMENT '注册渠道号',
  `login_channel` varchar(32) DEFAULT NULL COMMENT '登录渠道号',
  `phone_model` varchar(24) DEFAULT NULL COMMENT '手机型号',
  `phone_os_ver` varchar(24) DEFAULT NULL COMMENT '手机系统版本',
  `game_ver` varchar(24) DEFAULT NULL COMMENT '游戏版本号',
  `communiid` bigint(20) DEFAULT NULL COMMENT '通讯id',
  `account_name` varchar(24) DEFAULT NULL COMMENT '自定义账号名',
  `pwd` varchar(24) DEFAULT NULL COMMENT '自定义密码',
  `logout_time` varchar(24) DEFAULT NULL COMMENT '最后离线时间',
  `online_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`playerid`),
  KEY `regtime` (`regtime`),
  KEY `reg_channel` (`reg_channel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `game_player_numerical` */

DROP TABLE IF EXISTS `game_player_numerical`;

CREATE TABLE `game_player_numerical` (
  `playerid` bigint(20) NOT NULL,
  `gold_pay` bigint(20) DEFAULT NULL,
  `diamond_day` bigint(20) DEFAULT NULL,
  `diamond_newp` bigint(20) DEFAULT NULL,
  `fish_card_newp` bigint(20) DEFAULT NULL,
  `catch_fish_num` bigint(20) DEFAULT NULL,
  `item_day` bigint(20) DEFAULT NULL,
  `gold_newp` bigint(20) DEFAULT NULL,
  `licence` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`playerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `jy_real_time_online` */

DROP TABLE IF EXISTS `jy_real_time_online`;

CREATE TABLE `jy_real_time_online` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '在线人数',
  `UserNum` int(11) NOT NULL COMMENT '人数',
  `Screenings` tinyint(1) NOT NULL COMMENT '场次',
  `Channel` varchar(50) DEFAULT NULL COMMENT '渠道',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`Screenings`)
) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_statistics_users_pay` */

DROP TABLE IF EXISTS `jy_statistics_users_pay`;

CREATE TABLE `jy_statistics_users_pay` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户付费统计',
  `alipay` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '支付宝',
  `weixin` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '微信',
  `JinPay` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '金立',
  `iappay` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '爱贝',
  `PayNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '付费次数',
  `UserPayNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '付费用户数',
  `RegNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '账号注册人数',
  `EquipmentRegNum` int(11) NOT NULL DEFAULT '0' COMMENT '设备号',
  `ActiveNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '活跃数',
  `TotalMoney` float unsigned NOT NULL DEFAULT '0' COMMENT '日收入总额',
  `Success` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '成功',
  `UserPayNumOld` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '老用户数量',
  `OrderTotalOld` float unsigned NOT NULL DEFAULT '0' COMMENT '老用户订单总额',
  `OrderTotal` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '订单总数',
  `First` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '首次充值数',
  `UsersOneNum` varchar(10) DEFAULT NULL COMMENT '次日留存',
  `UsersTowNum` varchar(10) DEFAULT NULL COMMENT '二日留存',
  `UsersThreeNum` varchar(10) DEFAULT NULL COMMENT '三日留存',
  `UsersSevenNum` varchar(10) DEFAULT NULL COMMENT '七日留存',
  `UsersFifteenNum` varchar(10) DEFAULT NULL COMMENT '十五留存',
  `UsersThirtyNum` varchar(10) DEFAULT NULL COMMENT '三十日留存',
  `Channel` varchar(50) NOT NULL COMMENT '渠道号',
  `FirstMoney` float unsigned NOT NULL DEFAULT '0' COMMENT '首付金额',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`Channel`)
) ENGINE=MyISAM AUTO_INCREMENT=3225 DEFAULT CHARSET=utf8;

/*Table structure for table `summary_goods` */

DROP TABLE IF EXISTS `summary_goods`;

CREATE TABLE `summary_goods` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '物品流水汇总',
  `Channel` varchar(50) NOT NULL COMMENT '渠道',
  `Reason` tinyint(4) NOT NULL COMMENT '来源',
  `Ostype` tinyint(1) NOT NULL COMMENT '手机系统',
  `Number` bigint(20) NOT NULL COMMENT '数量',
  `VerSion` varchar(20) NOT NULL COMMENT '版本',
  `Itemid` tinyint(4) NOT NULL COMMENT '物品ID',
  `DataTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
