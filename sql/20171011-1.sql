/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.19-0ubuntu0.16.04.1-log : Database - jyhd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `jyhd`;

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
  PRIMARY KEY (`playerid`),
  KEY `regtime` (`regtime`),
  KEY `reg_channel` (`reg_channel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `game_account` */

/*Table structure for table `game_login_action` */

DROP TABLE IF EXISTS `game_login_action`;

CREATE TABLE `game_login_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户登录记录表',
  `playerid` bigint(20) NOT NULL COMMENT '用户ID',
  `account_type` tinyint(1) unsigned NOT NULL COMMENT '帐号类型 (1游客，2自定义)',
  `os_type` tinyint(1) unsigned NOT NULL COMMENT '系统类型 (1ios, 2安卓)',
  `login_channel` varchar(64) NOT NULL COMMENT '登录渠道',
  `reg_channel` varchar(64) NOT NULL COMMENT '注册渠道',
  `game_ver` varchar(24) NOT NULL COMMENT '游戏版本号',
  `name` varchar(24) NOT NULL COMMENT '用户名',
  `vip` int(11) NOT NULL COMMENT 'vip等级',
  `vip_exp` int(11) NOT NULL COMMENT 'vip经验',
  `glevel` int(11) NOT NULL COMMENT '游戏等级',
  `gexp` int(11) NOT NULL COMMENT '游戏经验',
  `gold` bigint(20) NOT NULL COMMENT '金币',
  `diamond` bigint(20) NOT NULL COMMENT '砖石',
  `deposit` bigint(20) NOT NULL COMMENT '存款',
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  PRIMARY KEY (`id`),
  KEY `login_time` (`login_time`,`playerid`),
  KEY `login_channel` (`login_channel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `game_login_action` */

/*Table structure for table `game_player` */

DROP TABLE IF EXISTS `game_player`;

CREATE TABLE `game_player` (
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
  `gun_lv` int(11) DEFAULT NULL COMMENT '炮的等级',
  `sign_day` int(11) DEFAULT NULL COMMENT '累计签到天数',
  `sign_time` bigint(20) DEFAULT NULL COMMENT '签到时间',
  `gunid` int(11) DEFAULT NULL COMMENT '当前炮的id',
  `icon_url` varchar(64) DEFAULT NULL COMMENT '头像',
  `is_mc` int(11) DEFAULT NULL COMMENT '是否是月卡用户',
  `mc_overtime` bigint(20) DEFAULT NULL COMMENT '月卡结束时间',
  PRIMARY KEY (`playerid`),
  KEY `status` (`status`,`level_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `game_player` */

/*Table structure for table `game_reschange_action` */

DROP TABLE IF EXISTS `game_reschange_action`;

CREATE TABLE `game_reschange_action` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `playerid` bigint(20) unsigned DEFAULT NULL COMMENT '用户ID',
  `account_type` tinyint(4) DEFAULT NULL COMMENT '账号类型（1游客，2自定义）',
  `os_type` tinyint(4) DEFAULT NULL COMMENT '系统类型 (1ios, 2安卓)',
  `login_channel` varchar(64) DEFAULT NULL COMMENT '登录渠道',
  `reg_channel` varchar(64) DEFAULT NULL COMMENT '注册渠道',
  `game_ver` varchar(24) DEFAULT NULL COMMENT '游戏版本号',
  `itemid` int(11) DEFAULT NULL COMMENT '物品ID',
  `add_num` int(11) DEFAULT NULL COMMENT '增量',
  `cur_num` int(11) DEFAULT NULL COMMENT '总量',
  `reason` tinyint(4) NOT NULL,
  `opt_time` datetime DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  KEY `playerid` (`playerid`,`reason`,`opt_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `game_reschange_action` */

/*Table structure for table `jy_activity_father_list` */

DROP TABLE IF EXISTS `jy_activity_father_list`;

CREATE TABLE `jy_activity_father_list` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动父表',
  `Code` varchar(20) NOT NULL COMMENT '活动标识',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '活动类型 1-累计充值 2-单笔充值 3-循环充值 4-图片类型',
  `Title` varchar(50) NOT NULL COMMENT '活动标题',
  `AddUpStartTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '累计开始时间',
  `AddUpEndTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '累计结束时间',
  `ShowStartTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '显示开始时间',
  `ShowEndTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '显示结束时间',
  `Describe` varchar(255) NOT NULL COMMENT '活动描述',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Type` (`Type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `jy_activity_father_list` */

insert  into `jy_activity_father_list`(`Id`,`Code`,`Type`,`Title`,`AddUpStartTime`,`AddUpEndTime`,`ShowStartTime`,`ShowEndTime`,`Describe`,`DateTime`) values (5,'1001',1,'累计充值','2017-08-12 02:00:00','2017-09-30 02:00:00','2017-08-11 02:00:00','2017-10-30 02:00:00','aaaaaaaaaaaaaaaaaaaaaa','2017-08-14 11:05:35'),(6,'1002',2,'单笔充值','2017-09-02 02:00:00','2017-11-01 02:00:00','2017-08-13 02:00:00','2017-10-01 02:00:00','','2017-08-14 11:06:18');

/*Table structure for table `jy_activity_son_list` */

DROP TABLE IF EXISTS `jy_activity_son_list`;

CREATE TABLE `jy_activity_son_list` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动子表',
  `FatherID` int(11) unsigned NOT NULL COMMENT '活动父ID',
  `GoodsID` int(11) NOT NULL COMMENT '奖励商品',
  `Title` varchar(50) NOT NULL COMMENT '标题',
  `Number` int(11) NOT NULL COMMENT '奖品数量',
  `Schedule` int(11) NOT NULL COMMENT '条件',
  `ImgCode` varchar(50) NOT NULL COMMENT '图片标识',
  `ImgUrl` varchar(255) NOT NULL COMMENT '活动图片',
  `Code` varchar(20) NOT NULL COMMENT '活动标识',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `FatherID` (`FatherID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `jy_activity_son_list` */

insert  into `jy_activity_son_list`(`Id`,`FatherID`,`GoodsID`,`Title`,`Number`,`Schedule`,`ImgCode`,`ImgUrl`,`Code`,`DateTime`) values (3,5,10,'累计充值68元',1,68,'coin2.png','Uploads/image/2017/08/14/d19631d5c4f5d74141b185c979fcf2bc.jpg','112','2017-08-14 16:29:17'),(5,6,8,'单笔充值30元',1,30,'coin2.png','Uploads/image/2017/08/15/769cba07612fc395cc4836b8228f2174.jpg','eeqwe','2017-08-15 09:54:45'),(6,5,14,'累计充值168元',1,168,'diamond2.png','Uploads/image/2017/08/15/cf12e6f529cea0837305a481cbb9ce8d.jpg','3123','2017-08-15 11:59:18'),(7,6,10,'单笔充值100元',1,100,'coin2.png','Uploads/image/2017/08/15/07b11bc75b486c7f9de69784687d0b25.jpg','321321','2017-08-15 12:00:16'),(10,8,9,'图片1',3213,100,'12','Uploads/image/2017/08/31/2e09eb94307e4657691c845a80a55387.jpg','dsa','2017-08-15 12:02:35'),(11,6,10,'单笔充值200元',1,200,'coin2.png','','777777','2017-09-19 17:02:23'),(12,6,8,'单笔充值500元',1,500,'coin2.png','','11234','2017-09-19 17:02:51'),(13,5,44,'累计充值328元',500,328,'ice.png','','5523','2017-09-19 17:04:55'),(14,5,10,'累计充值648元',1,648,'coin2.png','','234688','2017-09-19 17:05:34');

/*Table structure for table `jy_admin_group` */

DROP TABLE IF EXISTS `jy_admin_group`;

CREATE TABLE `jy_admin_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户管理组',
  `name` varchar(20) NOT NULL COMMENT '组名',
  `authority` text NOT NULL COMMENT '组权限',
  `upid` int(11) NOT NULL DEFAULT '0' COMMENT '上级ID',
  `addId` int(11) NOT NULL COMMENT '添加ID',
  `addName` varchar(20) NOT NULL COMMENT '添加名',
  `islock` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否锁定 1-否 2-是',
  `add` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '添加权限 1-否 2-是',
  `DesktopAddress` varchar(255) NOT NULL COMMENT '添加地址',
  `channel` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否渠道组 1-否 2-是',
  `edit` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否能修改 1-否 2-是',
  `del` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否能删除 1-否 2-是',
  `isdel` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否删除 1-否 2-是',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `addId` (`addId`),
  KEY `isdel` (`isdel`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `jy_admin_group` */

insert  into `jy_admin_group`(`id`,`name`,`authority`,`upid`,`addId`,`addName`,`islock`,`add`,`DesktopAddress`,`channel`,`edit`,`del`,`isdel`,`remark`,`mtime`) values (1,'超级管理员','',0,1,'测试',1,2,'',1,2,2,1,'','2017-08-30 10:11:17'),(6,'渠道','',1,1,'admin',1,1,'/jy_admin/ChannelData/index',1,1,1,1,'','2017-09-29 17:08:08'),(14,'游戏调试','[\"42\",\"59\",\"57\"]',1,1,'测试',1,2,'/jy_admin/UsersAttribute/index',1,2,2,1,'','2017-09-01 17:18:46');

/*Table structure for table `jy_admin_users` */

DROP TABLE IF EXISTS `jy_admin_users`;

CREATE TABLE `jy_admin_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '后台管理员表',
  `name` varchar(20) NOT NULL COMMENT '名字',
  `account` varchar(20) NOT NULL COMMENT '账号',
  `passwd` varchar(32) NOT NULL COMMENT '密码',
  `admingroup` int(11) NOT NULL COMMENT '组ID',
  `default` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否系统默认账号 1-否 2-是',
  `channel` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否渠道 1-否 2-是',
  `addName` varchar(20) NOT NULL COMMENT '添加名',
  `addId` int(11) unsigned NOT NULL COMMENT '添加ID',
  `islock` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否锁定 1-否 2-是',
  `isdel` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否删除 1-否 2-是',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `account` (`account`,`channel`),
  KEY `channel` (`channel`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `jy_admin_users` */

insert  into `jy_admin_users`(`id`,`name`,`account`,`passwd`,`admingroup`,`default`,`channel`,`addName`,`addId`,`islock`,`isdel`,`remark`,`mtime`) values (1,'admin','jyhd@admin','e9ea4bc3f5ad73346051c1a436963521',0,2,1,'',0,1,1,'','2017-07-11 08:28:22'),(5,'倒霉小姐','18899753856','e10adc3949ba59abbe56e057f20f883e',6,1,2,'test',3,1,2,'321','2017-07-12 06:52:35'),(9,'游戏调试','jyhd@163.com','e10adc3949ba59abbe56e057f20f883e',14,1,1,'测试',1,1,2,'','2017-08-30 10:13:03'),(10,'渠道测试','13724894160','e10adc3949ba59abbe56e057f20f883e',6,1,2,'测试',1,1,2,'','2017-08-30 11:21:34'),(11,'JYHD_0','JYHD_0','e10adc3949ba59abbe56e057f20f883e',6,1,2,'测试',1,1,1,'','2017-09-22 17:24:21'),(12,'金立','JYHD_JinLi','934d955c889aacf1cedbf0a3d3c0cb18',6,1,2,'测试',1,1,1,'','2017-09-28 19:51:17'),(13,'xl','13724894160','e10adc3949ba59abbe56e057f20f883e',6,1,2,'测试',1,1,1,'','2017-09-29 10:13:46');

/*Table structure for table `jy_api_visit_log` */

DROP TABLE IF EXISTS `jy_api_visit_log`;

CREATE TABLE `jy_api_visit_log` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'api访问日志',
  `Name` varchar(50) NOT NULL COMMENT '名字',
  `Url` varchar(255) NOT NULL COMMENT '地址',
  `Code` int(4) NOT NULL COMMENT '状态码',
  `Msg` varchar(255) DEFAULT NULL COMMENT '状态说明',
  `TimeOut` varchar(20) DEFAULT NULL COMMENT '耗时',
  `AccessIP` varchar(50) NOT NULL COMMENT '访问IP',
  `DataTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '访问时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_api_visit_log` */

/*Table structure for table `jy_channel_goods` */

DROP TABLE IF EXISTS `jy_channel_goods`;

CREATE TABLE `jy_channel_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '渠道商品',
  `adminUserID` int(11) unsigned NOT NULL COMMENT '渠道ID',
  `goodsID` int(11) unsigned NOT NULL COMMENT '商品ID',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `adminUserID` (`adminUserID`),
  KEY `goodsID` (`goodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=282 DEFAULT CHARSET=utf8;

/*Data for the table `jy_channel_goods` */

insert  into `jy_channel_goods`(`id`,`adminUserID`,`goodsID`,`DateTime`) values (54,3,0,'2017-07-31 15:39:58'),(61,3,3,'2017-07-31 15:42:44'),(65,3,0,'2017-07-31 15:45:29'),(66,3,0,'2017-07-31 15:45:29'),(69,3,0,'2017-07-31 15:49:38'),(70,3,5,'2017-07-31 15:49:38'),(71,3,0,'2017-07-31 15:49:40'),(72,3,0,'2017-07-31 15:49:40'),(73,3,6,'2017-07-31 15:49:40'),(74,3,0,'2017-07-31 15:49:51'),(75,3,0,'2017-07-31 15:49:51'),(76,3,0,'2017-07-31 15:49:51'),(78,5,0,'2017-07-31 15:51:20'),(79,5,5,'2017-07-31 15:51:20'),(80,5,6,'2017-07-31 15:51:20'),(81,5,7,'2017-07-31 15:51:20'),(82,3,7,'2017-08-01 19:53:55'),(83,3,8,'2017-08-11 17:41:09'),(84,3,9,'2017-08-11 17:41:09'),(85,3,10,'2017-08-11 17:41:09'),(86,3,11,'2017-08-11 17:41:09'),(87,3,12,'2017-08-11 17:41:09'),(88,3,13,'2017-08-11 17:41:09'),(89,3,14,'2017-08-11 17:41:09'),(90,3,15,'2017-08-11 17:41:09'),(91,3,16,'2017-08-11 17:41:09'),(92,3,17,'2017-08-11 17:41:09'),(93,5,8,'2017-08-11 17:41:26'),(94,5,9,'2017-08-11 17:41:26'),(95,5,10,'2017-08-11 17:41:26'),(96,5,11,'2017-08-11 17:41:26'),(97,5,12,'2017-08-11 17:41:26'),(98,5,13,'2017-08-11 17:41:26'),(99,5,14,'2017-08-11 17:41:26'),(100,5,15,'2017-08-11 17:41:26'),(101,5,16,'2017-08-11 17:41:26'),(102,5,17,'2017-08-11 17:41:26'),(103,3,0,'2017-08-25 18:33:44'),(104,3,0,'2017-08-25 18:33:44'),(105,3,0,'2017-08-25 18:33:44'),(106,3,0,'2017-08-25 18:33:44'),(107,3,0,'2017-08-25 18:33:44'),(108,3,0,'2017-08-25 18:33:44'),(109,3,0,'2017-08-25 18:33:44'),(110,3,0,'2017-08-25 18:33:44'),(111,3,0,'2017-08-25 18:33:44'),(112,3,0,'2017-08-25 18:33:44'),(113,3,18,'2017-08-25 18:33:44'),(114,3,19,'2017-08-25 18:33:44'),(115,3,20,'2017-08-25 18:33:44'),(116,3,23,'2017-08-25 18:33:44'),(117,3,24,'2017-08-25 18:33:44'),(118,3,25,'2017-08-25 18:33:44'),(119,3,26,'2017-08-25 18:33:44'),(120,3,27,'2017-08-25 18:33:44'),(121,3,28,'2017-08-25 18:33:44'),(122,3,29,'2017-08-25 18:33:44'),(123,3,30,'2017-08-25 18:33:44'),(124,3,31,'2017-08-25 18:33:44'),(125,3,32,'2017-08-25 18:33:44'),(126,10,8,'2017-08-30 11:24:53'),(127,10,9,'2017-08-30 11:24:53'),(128,10,10,'2017-08-30 11:24:53'),(129,10,11,'2017-08-30 11:24:53'),(130,10,12,'2017-08-30 11:24:53'),(131,10,13,'2017-08-30 11:24:53'),(132,10,14,'2017-08-30 11:24:53'),(133,10,15,'2017-08-30 11:24:53'),(134,10,16,'2017-08-30 11:24:53'),(135,10,17,'2017-08-30 11:24:53'),(136,10,18,'2017-08-30 11:24:53'),(137,10,19,'2017-08-30 11:24:53'),(138,10,20,'2017-08-30 11:24:53'),(139,10,23,'2017-08-30 11:24:53'),(140,10,24,'2017-08-30 11:24:53'),(141,10,25,'2017-08-30 11:24:53'),(142,10,26,'2017-08-30 11:24:53'),(143,10,27,'2017-08-30 11:24:53'),(144,10,28,'2017-08-30 11:24:53'),(145,10,29,'2017-08-30 11:24:53'),(146,10,30,'2017-08-30 11:24:53'),(147,10,31,'2017-08-30 11:24:53'),(148,10,32,'2017-08-30 11:24:53'),(149,10,33,'2017-08-30 11:24:53'),(150,10,34,'2017-08-30 11:24:53'),(151,10,0,'2017-08-30 19:20:17'),(152,10,0,'2017-08-30 19:20:17'),(153,10,0,'2017-08-30 19:20:17'),(154,10,0,'2017-08-30 19:20:17'),(155,10,0,'2017-08-30 19:20:17'),(156,10,0,'2017-08-30 19:20:17'),(157,10,0,'2017-08-30 19:20:17'),(158,10,0,'2017-08-30 19:20:17'),(159,10,0,'2017-08-30 19:20:17'),(160,10,0,'2017-08-30 19:20:17'),(161,10,0,'2017-08-30 19:20:17'),(162,10,0,'2017-08-30 19:20:17'),(163,10,0,'2017-08-30 19:20:17'),(164,10,0,'2017-08-30 19:20:17'),(165,10,0,'2017-08-30 19:20:17'),(166,10,0,'2017-08-30 19:20:17'),(167,10,0,'2017-08-30 19:20:17'),(168,10,0,'2017-08-30 19:20:17'),(169,10,0,'2017-08-30 19:20:17'),(170,10,0,'2017-08-30 19:20:17'),(171,10,0,'2017-08-30 19:20:17'),(172,10,0,'2017-08-30 19:20:17'),(173,10,0,'2017-08-30 19:20:17'),(174,10,0,'2017-08-30 19:20:17'),(175,10,0,'2017-08-30 19:20:17'),(176,10,0,'2017-08-30 19:20:17'),(177,10,0,'2017-08-30 19:20:17'),(178,10,38,'2017-08-30 19:20:17'),(179,10,39,'2017-08-30 19:20:17'),(180,11,8,'2017-09-22 17:25:17'),(181,11,9,'2017-09-22 17:25:17'),(182,11,10,'2017-09-22 17:25:17'),(183,11,11,'2017-09-22 17:25:17'),(184,11,12,'2017-09-22 17:25:17'),(185,11,13,'2017-09-22 17:25:17'),(186,11,14,'2017-09-22 17:25:17'),(187,11,15,'2017-09-22 17:25:17'),(188,11,16,'2017-09-22 17:25:17'),(189,11,17,'2017-09-22 17:25:17'),(190,11,18,'2017-09-22 17:25:17'),(191,11,19,'2017-09-22 17:25:17'),(192,11,20,'2017-09-22 17:25:17'),(193,11,23,'2017-09-22 17:25:17'),(194,11,24,'2017-09-22 17:25:17'),(195,11,25,'2017-09-22 17:25:17'),(196,11,26,'2017-09-22 17:25:17'),(197,11,27,'2017-09-22 17:25:17'),(198,11,28,'2017-09-22 17:25:17'),(199,11,29,'2017-09-22 17:25:17'),(200,11,30,'2017-09-22 17:25:17'),(201,11,31,'2017-09-22 17:25:17'),(202,11,32,'2017-09-22 17:25:17'),(203,11,33,'2017-09-22 17:25:17'),(204,11,35,'2017-09-22 17:25:17'),(205,11,36,'2017-09-22 17:25:17'),(206,11,37,'2017-09-22 17:25:17'),(207,11,38,'2017-09-22 17:25:17'),(208,11,39,'2017-09-22 17:25:17'),(209,11,40,'2017-09-22 17:25:17'),(210,11,41,'2017-09-22 17:25:17'),(211,11,42,'2017-09-22 17:25:17'),(212,11,43,'2017-09-22 17:25:17'),(213,11,44,'2017-09-22 17:25:17'),(214,12,8,'2017-09-28 19:53:54'),(215,12,9,'2017-09-28 19:53:54'),(216,12,10,'2017-09-28 19:53:54'),(217,12,11,'2017-09-28 19:53:54'),(218,12,12,'2017-09-28 19:53:54'),(219,12,13,'2017-09-28 19:53:54'),(220,12,14,'2017-09-28 19:53:54'),(221,12,15,'2017-09-28 19:53:54'),(222,12,16,'2017-09-28 19:53:54'),(223,12,17,'2017-09-28 19:53:54'),(224,12,18,'2017-09-28 19:53:54'),(225,12,19,'2017-09-28 19:53:54'),(226,12,20,'2017-09-28 19:53:54'),(227,12,23,'2017-09-28 19:53:54'),(228,12,24,'2017-09-28 19:53:54'),(229,12,25,'2017-09-28 19:53:54'),(230,12,26,'2017-09-28 19:53:54'),(231,12,27,'2017-09-28 19:53:54'),(232,12,28,'2017-09-28 19:53:54'),(233,12,29,'2017-09-28 19:53:54'),(234,12,30,'2017-09-28 19:53:54'),(235,12,31,'2017-09-28 19:53:54'),(236,12,32,'2017-09-28 19:53:54'),(237,12,33,'2017-09-28 19:53:54'),(238,12,35,'2017-09-28 19:53:54'),(239,12,36,'2017-09-28 19:53:54'),(240,12,37,'2017-09-28 19:53:54'),(241,12,38,'2017-09-28 19:53:54'),(242,12,39,'2017-09-28 19:53:54'),(243,12,40,'2017-09-28 19:53:54'),(244,12,41,'2017-09-28 19:53:54'),(245,12,42,'2017-09-28 19:53:54'),(246,12,43,'2017-09-28 19:53:54'),(247,12,44,'2017-09-28 19:53:54'),(248,13,8,'2017-09-29 10:14:13'),(249,13,9,'2017-09-29 10:14:13'),(250,13,10,'2017-09-29 10:14:13'),(251,13,11,'2017-09-29 10:14:13'),(252,13,12,'2017-09-29 10:14:13'),(253,13,13,'2017-09-29 10:14:13'),(254,13,14,'2017-09-29 10:14:13'),(255,13,15,'2017-09-29 10:14:13'),(256,13,16,'2017-09-29 10:14:13'),(257,13,17,'2017-09-29 10:14:13'),(258,13,18,'2017-09-29 10:14:13'),(259,13,19,'2017-09-29 10:14:13'),(260,13,20,'2017-09-29 10:14:13'),(261,13,23,'2017-09-29 10:14:13'),(262,13,24,'2017-09-29 10:14:13'),(263,13,25,'2017-09-29 10:14:13'),(264,13,26,'2017-09-29 10:14:13'),(265,13,27,'2017-09-29 10:14:13'),(266,13,28,'2017-09-29 10:14:13'),(267,13,29,'2017-09-29 10:14:13'),(268,13,30,'2017-09-29 10:14:13'),(269,13,31,'2017-09-29 10:14:13'),(270,13,32,'2017-09-29 10:14:13'),(271,13,33,'2017-09-29 10:14:13'),(272,13,35,'2017-09-29 10:14:13'),(273,13,36,'2017-09-29 10:14:13'),(274,13,37,'2017-09-29 10:14:13'),(275,13,38,'2017-09-29 10:14:13'),(276,13,39,'2017-09-29 10:14:13'),(277,13,40,'2017-09-29 10:14:13'),(278,13,41,'2017-09-29 10:14:13'),(279,13,42,'2017-09-29 10:14:13'),(280,13,43,'2017-09-29 10:14:13'),(281,13,44,'2017-09-29 10:14:13');

/*Table structure for table `jy_channel_info` */

DROP TABLE IF EXISTS `jy_channel_info`;

CREATE TABLE `jy_channel_info` (
  `adminUserID` int(11) unsigned NOT NULL COMMENT '渠道(管理员ID)',
  `platform` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '平台',
  `pattern` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '合作方式',
  `DividedInto` varchar(10) NOT NULL COMMENT '分成',
  `RegisterNum` varchar(10) NOT NULL COMMENT '注册人数（结算率）',
  `RechargeNum` varchar(10) NOT NULL COMMENT '充值人数（结算率）',
  `CorporateName` varchar(50) NOT NULL COMMENT '公司名称',
  `CompanyAddress` varchar(50) NOT NULL COMMENT '公司地址',
  `CompanyPhone` varchar(20) NOT NULL COMMENT '公司电话',
  `contacts` varchar(10) NOT NULL COMMENT '联系人',
  `ContactNumber` varchar(20) NOT NULL COMMENT '联系电话',
  `ContactMailbox` varchar(20) NOT NULL COMMENT '联系邮箱',
  `addName` varchar(20) NOT NULL COMMENT '添加人',
  `addId` int(11) NOT NULL COMMENT '添加ID',
  `isown` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否本公司渠道',
  `remark` varchar(255) NOT NULL COMMENT '备注信息',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`adminUserID`,`mtime`),
  KEY `platform` (`platform`),
  KEY `isown` (`isown`),
  KEY `addId` (`addId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_channel_info` */

insert  into `jy_channel_info`(`adminUserID`,`platform`,`pattern`,`DividedInto`,`RegisterNum`,`RechargeNum`,`CorporateName`,`CompanyAddress`,`CompanyPhone`,`contacts`,`ContactNumber`,`ContactMailbox`,`addName`,`addId`,`isown`,`remark`,`mtime`) values (3,2,1,'','','','dasdas','dsadsa','dasdsa','dsa','dasdsa','dsadas','1',1,1,'','2017-07-26 02:44:18'),(5,1,1,'','','','dsad','dsadsa','dasds','dsad','dsa','dsad','1',1,1,'dasdas','2017-07-26 02:49:36'),(10,2,1,'','','','321312','321','32132','32132','32321','321321','测试',1,1,'321','2017-08-30 11:24:42'),(11,2,1,'','','','3123','321312321','32312','321312','321312','321321','测试',1,1,'','2017-09-22 17:25:10'),(12,2,2,'','','','金立','312321312','321321','321321','321321','321321','测试',1,1,'','2017-09-28 19:53:48'),(13,2,1,'','','','xl','xl','xl','xl','xl','xl','测试',1,1,'xl','2017-09-29 10:14:07');

/*Table structure for table `jy_channel_thirdpay` */

DROP TABLE IF EXISTS `jy_channel_thirdpay`;

CREATE TABLE `jy_channel_thirdpay` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '渠道支付ID',
  `adminUserID` int(11) unsigned NOT NULL COMMENT '渠道ID',
  `PayID` int(11) unsigned NOT NULL COMMENT '支付ID',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `adminUserID` (`adminUserID`),
  KEY `PayID` (`PayID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `jy_channel_thirdpay` */

insert  into `jy_channel_thirdpay`(`id`,`adminUserID`,`PayID`,`DateTime`) values (3,3,4,'2017-08-01 19:32:10'),(5,5,4,'2017-08-01 19:34:09'),(6,3,6,'2017-08-24 14:27:24'),(7,10,6,'2017-09-06 16:01:49'),(8,11,6,'2017-09-22 17:29:15'),(9,10,0,'2017-09-26 14:39:56'),(10,10,13,'2017-09-26 14:39:56'),(13,13,6,'2017-09-29 10:14:19'),(12,12,13,'2017-09-28 19:54:08'),(14,13,13,'2017-09-29 10:14:19');

/*Table structure for table `jy_currency_section` */

DROP TABLE IF EXISTS `jy_currency_section`;

CREATE TABLE `jy_currency_section` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '货币区间',
  `Name` varchar(50) NOT NULL COMMENT '名称',
  `Unit` tinyint(1) unsigned NOT NULL COMMENT '单位 1-个 2-十  3-百 4-千 5-万',
  `Start` bigint(20) NOT NULL COMMENT '起始值',
  `End` bigint(20) NOT NULL DEFAULT '0' COMMENT '结束值 0-无上限',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `Start` (`Start`,`End`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `jy_currency_section` */

insert  into `jy_currency_section`(`Id`,`Name`,`Unit`,`Start`,`End`,`DateTime`) values (2,'[1-1000]',1,1,1000,'2017-09-18 18:44:39'),(3,'（1000-2000]',1,1001,2000,'2017-09-18 18:45:10'),(4,'（2000-3000]',1,2001,3000,'2017-09-18 18:45:23'),(5,'（3000-4000]',1,3001,4000,'2017-09-18 18:45:42'),(6,'（4000-5000]',1,4001,5000,'2017-09-18 18:47:01');

/*Table structure for table `jy_game_form` */

DROP TABLE IF EXISTS `jy_game_form`;

CREATE TABLE `jy_game_form` (
  `Name` varchar(50) NOT NULL COMMENT '游戏项目类型',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1-游戏 2-充值 3-签到 4-兑换 5-月卡 6-首冲',
  PRIMARY KEY (`Type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_game_form` */

insert  into `jy_game_form`(`Name`,`Type`) values ('游戏',1),('充值',2),('签到',3),('兑换',4),('月卡',5),('首冲',6),('vip每日奖励',7);

/*Table structure for table `jy_game_notice` */

DROP TABLE IF EXISTS `jy_game_notice`;

CREATE TABLE `jy_game_notice` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '游戏公告',
  `Content` text NOT NULL COMMENT '公告内容',
  `Title` varchar(255) NOT NULL COMMENT '长标题',
  `Sort` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否置顶 1-否 2否',
  `Num` int(11) unsigned NOT NULL COMMENT '排序',
  `TitleSon` varchar(255) NOT NULL COMMENT '短标题',
  `Btime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '结束时间',
  `Remark` varchar(255) NOT NULL COMMENT '备注',
  `Status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否发布 1-否 2-是',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `Status` (`Status`,`Btime`,`Sort`,`Num`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `jy_game_notice` */

insert  into `jy_game_notice`(`Id`,`Content`,`Title`,`Sort`,`Num`,`TitleSon`,`Btime`,`Remark`,`Status`,`DateTime`) values (3,'为了给玩家创造更加安全稳定的游戏环境，《诛仙3》将于2017年9月19日上午8:00-10:00对所有服务器进行停机维护。\r\n预计停机2小时，如遇特殊情况，开机时间将会顺延。若给您带来不便，敬请谅解。\r\n\r\n \r\n本次维护涉及更新，更新内容如下：\r\n \r\n【 签到奖励 】\r\n9月19日至10月16日期间，仙友们每日登陆游戏即可领取一份签到奖励，本次奖励的大奖依旧为玉虹雪华，仙友们可千万不要错过。\r\n \r\n \r\n【 体验性修改及优化 】\r\n1.载具包裹上限扩充至150格。\r\n2.修复了画影护符材料焱光灼的名称错误问题\r\n \r\n \r\n【 天帝宝库 】\r\n物品上架：\r\n1.商城“礼包—新品热卖”和“天材地宝—包裹仓库”目录分别上架“飞剑/坐骑包裹”，每次使用可扩充12格载具包裹，已达上限150格时使用\r\n无效；\r\n2.商城“礼包—新品热卖”和“时装—男子时装”目录分别上架男款“叹年少装”；\r\n3.商城“礼包—新品热卖”和“时装—女子时装”目录分别上架女款“叹年少装”。\r\n \r\n \r\n物品下架：\r\n1.商城“礼包—新品热卖”目录下架“小凡装大礼包（降临版）”、“碧瑶装大礼包（降临版）”，仍有需要的仙友可\r\n于\r\n“时装—主角时装”目录中购买；\r\n2.商城“礼包—新品热卖”目录下架“月德符”，仍有需要的仙友可于“法器—装备精炼”目录中\r\n购买；\r\n3.商城“礼包—新品热卖”目录下架“玄元天晶”、“紫府星衡”、“棠棣令”，仍有需\r\n要的仙友可于“法器—功能道具”目中中购买；\r\n4.商城“礼包—新品热卖”目录下架“神韵秘文石”，仍有需要的仙友可于“天材地宝—秘文晶石”，目录中购买；\r\n5.商城“礼包—新品热卖”目录下架“奇影画天卷”，仍有需要的仙友可于“时装—时装武器”\r\n目录中购买；\r\n6.商城“礼包—新品热卖”目录下架“同心礼盒”、“蝴蝶飞”、“夜萤火”、“花灯昼”，仍有需\r\n要的仙友可于“法器—师徒夫妻”目录中购买；\r\n7.商城“礼包—新品热卖”目录下架“揽月圣印”，仍有需要的仙友可于“仙宠—飞宝增益”目录中\r\n购买；\r\n8.商城“礼包—新品热卖”目录下架“揽月圣印礼包（绑定）”，仍有需要的仙友可于“礼包—宝券”目录中购买；\r\n9.商城“礼包—新品热卖”目录下架“天河秘琼”，仍有需要的仙友可于“天材地宝—包裹仓库”目录中购买。               \r\n\r\n                                                                                                                      \r\n                                                                                                                                                                                2017年9月19日','2017年9月',1,0,'2017年9月','2017-09-30 19:56:32','',2,'2017-09-15 14:15:19'),(4,'321312\r\n发生大恢复健康\r\n\r\n复合大师科技\r\n福建省断开\r\n\r\n福建省断开了                                            发送动环监控发圣诞节快乐\r\n\r\n\r\n福建省打开了\r\n俯拾地芥阿卡丽','2017-09-',1,0,'312321','2020-09-25 19:56:32','eqweqw',2,'2017-09-15 15:01:47'),(5,'32131232\r\n                 32131232\r\n\r\n\r\n32131232\r\n             32131232\r\n\r\n                                      32131232                       32131232                    32131232           32131232','312321',1,0,'321312','2017-09-18 19:56:32','3123213',2,'2017-09-18 17:47:42'),(6,'大数据侃大山                 加快了打算尽快了                      就发生大方块了                 附近开了\r\n                    发发圣诞节快乐                 发圣诞节快乐\r\n     \r\n\r\n\r\n\r\n\r\n                              附件的索拉卡                 分等级发了                          接口法律手段\r\n\r\n\r\n\r\n                                                                            fksd                    kfsd','321321',1,0,'321321','2017-09-28 19:56:32','312312',2,'2017-09-18 17:47:48'),(7,'321312312','3213123',1,0,'312312','2017-11-30 19:56:32','321312',2,'2017-09-18 17:47:54'),(8,'321312312','321321321',1,0,'','2017-09-18 19:56:32','312312321',2,'2017-09-18 17:48:00'),(9,'312312321321','3213232',1,0,'','2017-09-18 19:56:32','321321312321',2,'2017-09-18 17:48:07'),(10,'312312321321','32132321',1,0,'','2017-09-18 19:56:32','312312321321',2,'2017-09-18 17:48:15'),(11,'32132321312','321321321',1,0,'','2017-09-18 19:56:32','312312321',2,'2017-09-18 17:48:22'),(12,'321312312321','321321321',1,0,'','2017-09-18 19:56:32','321321321',2,'2017-09-18 17:48:30'),(13,'321321','321312',1,0,'','2017-09-28 19:56:32','321312',2,'2017-09-18 18:05:12'),(14,'亲爱的玩家：\r\n        街机在线捕鱼全新发布，超级福利来袭，你捕鱼，我送礼！\r\n        国庆七天乐，充值翻倍赠送，鱼池海量渔券，在线奖励免费领取，话费京东卡兑换到你手软，还等什么快来捕鱼吧！\r\n                                                                      2017年9月29日','全服停机更新维护',2,0,'全服停机','2017-10-04 19:56:32','',2,'2017-09-18 19:47:56');

/*Table structure for table `jy_game_version` */

DROP TABLE IF EXISTS `jy_game_version`;

CREATE TABLE `jy_game_version` (
  `Version` varchar(20) NOT NULL COMMENT '版本号',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `Remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`Version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_game_version` */

insert  into `jy_game_version`(`Version`,`DateTime`,`Remark`) values ('1.0','2017-09-20 14:19:46',''),('1.1','2017-09-20 14:20:09','');

/*Table structure for table `jy_goods_all` */

DROP TABLE IF EXISTS `jy_goods_all`;

CREATE TABLE `jy_goods_all` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '物品表',
  `Name` varchar(255) NOT NULL COMMENT '物品名',
  `Code` varchar(20) NOT NULL COMMENT '物品标识',
  `ImgCode` varchar(20) NOT NULL COMMENT '物品图片标识',
  `CurrencyType` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '货币类型 1-人民币 2-金币 3-砖石',
  `CurrencyNum` varchar(50) NOT NULL COMMENT '货币数量',
  `IssueNum` int(11) NOT NULL DEFAULT '0' COMMENT '发行数量',
  `IssueType` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否限制发行量 1-否 2-是',
  `Type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型  1-金币 2-钻石 3-道具',
  `CateGory` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类别  1-金币 2-砖石 3-道具',
  `GetNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '获得数量',
  `GiveInfo` text NOT NULL COMMENT '赠送物品',
  `ShowType` tinyint(1) NOT NULL DEFAULT '1' COMMENT '展示方式 1-商城',
  `IsGroom` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否推荐 1-否 2-是',
  `TheShelvesTime` varchar(50) DEFAULT NULL COMMENT '定时时间',
  `Status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1-上架 2-定时上架 3-定时下架 4-已下架',
  `Platform` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '平台 1-全部 2-苹果 3-安卓',
  `Proportion` int(4) NOT NULL DEFAULT '0' COMMENT '首冲比例',
  `FaceValue` varchar(20) DEFAULT NULL COMMENT '卡号面值',
  `LimitShop` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '限购 1-不限 2-日 3-周 4-月 5-年',
  `LimitShopNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '限购次数',
  `ExchangeType` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '限购 1-不限 2-日 3-周 4-月 5-年',
  `ExchangeNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '限兑换数量',
  `Describe` varchar(255) NOT NULL COMMENT '商品描述',
  `Broadcast` varchar(255) NOT NULL COMMENT '广播信息',
  `Push` varchar(255) NOT NULL COMMENT '推送信息',
  `Rmark` varchar(255) NOT NULL COMMENT '备注',
  `LimitLevel` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '等级限制 0-不限制',
  `LimitVip` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '会员等级限制 0-不限制',
  `Sort` bigint(20) NOT NULL COMMENT '排序',
  `IsDel` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否删除 1-否 2-是',
  `UpTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`Id`),
  KEY `CateGory` (`CateGory`,`IsDel`),
  KEY `Status` (`Status`),
  KEY `ShowType` (`ShowType`),
  KEY `Platform` (`Platform`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

/*Data for the table `jy_goods_all` */

insert  into `jy_goods_all`(`Id`,`Name`,`Code`,`ImgCode`,`CurrencyType`,`CurrencyNum`,`IssueNum`,`IssueType`,`Type`,`CateGory`,`GetNum`,`GiveInfo`,`ShowType`,`IsGroom`,`TheShelvesTime`,`Status`,`Platform`,`Proportion`,`FaceValue`,`LimitShop`,`LimitShopNum`,`ExchangeType`,`ExchangeNum`,`Describe`,`Broadcast`,`Push`,`Rmark`,`LimitLevel`,`LimitVip`,`Sort`,`IsDel`,`UpTime`,`DateTime`) values (3,'金币','32132','',1,'321312',0,1,1,1,1231,'',1,0,NULL,1,1,0,NULL,1,0,1,0,'','ewqeqw','ewqeqw','ewqewq',0,0,1501136621,2,'2017-08-09 12:32:49','2017-07-27 14:23:41'),(4,'道具','','',1,'1231',0,1,2,1,321321,'',1,0,NULL,3,1,0,NULL,2,32132,2,321312,'','ewqeqw','ewqeqw','ewqeqw',2,2,1501136698,2,'2017-07-28 14:28:14','2017-07-27 14:24:58'),(5,'砖石','123','',1,'321312',0,1,1,1,321312,'{\"0\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"312312\"},\"2\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"3123321\"},\"3\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"1232132\"},\"4\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"321312\"},\"5\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"312312321\"},\"6\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"3213312\"},\"7\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"3123132\"},\"8\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"312321\"}}',1,0,NULL,3,1,12,NULL,4,321312,3,321,'','321312','312312','312312',2,2,1501140444,2,'2017-08-11 11:46:28','2017-07-27 15:27:24'),(6,'测试','321312','',1,'321312',0,1,2,1,321312,'{\"0\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"312312\"},\"2\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"3123321\"},\"3\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"1232132\"},\"4\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"321312\"},\"5\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"312312321\"},\"6\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"3213312\"},\"7\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"3123132\"},\"8\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"312321\"}}',1,0,NULL,3,1,0,NULL,4,321312,3,321,'','321312','312312','312312',2,2,1501140448,2,'2017-08-11 11:46:26','2017-07-27 15:27:28'),(7,'测试1','1','',3,'321312',233,2,1,2,321312,'[{\"Type\":\"1\",\"Id\":\"7\",\"GetNum\":\"1\"}]',1,0,NULL,1,1,0,NULL,4,321312,3,321,'1','1','1','1',2,2,1501140449,2,'2017-08-11 11:51:59','2017-07-27 15:27:29'),(8,'60000金币','60000','coin1.png',1,'0.01',0,1,1,1,60000,'',1,0,'1970-01-01',1,1,100,'',1,0,1,0,'','','','',0,0,1502423245,1,'2017-09-13 01:54:25','2017-08-11 11:47:25'),(9,'30万金币','300000','coin2.png',1,'0.01',0,1,1,1,300000,'',1,0,'1970-01-01',1,1,100,'',1,0,1,0,'','','','',0,0,1502423302,1,'2017-09-13 03:08:05','2017-08-11 11:48:22'),(10,'68万金币','680000','coin3.png',1,'68',0,1,1,1,680000,'',1,0,'1970-01-01',1,1,100,'',1,0,1,0,'','','','',0,0,1502423353,1,'2017-09-08 11:52:56','2017-08-11 11:49:13'),(11,'168万金币','1680000','coin4.png',1,'168',0,1,1,1,1680000,'',1,0,'1970-01-01',1,1,100,'',1,0,1,0,'','','','',0,0,1502423392,1,'2017-09-08 11:53:03','2017-08-11 11:49:52'),(12,'328万金币','3280000','coin5.png',1,'328',0,1,1,1,3280000,'',1,0,'1970-01-01',1,1,100,'',1,0,1,0,'','','','',0,0,1502423439,1,'2017-09-08 11:53:11','2017-08-11 11:50:39'),(13,'648万金币','6480000','coin6.png',1,'648',0,1,1,1,6480000,'',1,0,'1970-01-01',1,1,100,'',1,0,1,0,'','','','',0,0,1502423498,1,'2017-09-28 19:09:13','2017-08-11 11:51:38'),(14,'60钻石','60','diamond1.png',1,'6',0,1,2,2,60,'',1,0,'1970-01-01',1,1,100,'',1,0,1,0,'','','','',0,0,1502423611,1,'2017-09-08 11:53:38','2017-08-11 11:53:31'),(15,'300钻石','300','diamond2.png',1,'30',0,1,2,2,300,'',1,0,'1970-01-01',1,1,100,'',1,0,1,0,'','','','',0,0,1502423637,1,'2017-09-08 11:53:47','2017-08-11 11:53:57'),(16,'680钻石','680','diamond3.png',1,'68',0,1,2,2,680,'',1,0,'1970-01-01',1,1,100,'',1,0,1,0,'','','','',0,0,1502423719,1,'2017-09-08 11:53:55','2017-08-11 11:55:19'),(17,'1680钻石','1680','diamond4.png',1,'168',0,1,2,2,1680,'',1,0,'1970-01-01',1,1,100,'',1,0,1,0,'','','','',0,0,1502423790,1,'2017-09-08 11:54:11','2017-08-11 11:56:30'),(18,'自动发炮','1004','icon3.png',1,'1',0,1,0,0,1,'',3,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1502856196,1,'2017-09-21 05:54:03','2017-08-16 12:03:16'),(19,'捕渔券概率提升','1005','card_big.png',1,'0',0,1,0,0,1,'',3,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1502856414,1,'2017-09-08 11:52:15','2017-08-16 12:06:54'),(20,'3280钻石','3280','diamond5.png',1,'328',0,1,2,2,3280,'',1,0,'1970-01-01',1,1,100,'',1,0,1,0,'','','','',0,0,1502856830,1,'2017-09-08 11:54:20','2017-08-16 12:13:50'),(21,'锁定','道具','',1,'1',0,1,3,3,1,'',1,0,NULL,1,1,0,NULL,1,0,1,0,'','','','',0,0,1502857047,2,'2017-08-16 12:17:51','2017-08-16 12:17:27'),(22,'锁定','1002','',1,'1',0,1,3,0,1,'',1,0,NULL,1,1,0,NULL,1,0,1,0,'','','','',0,0,1502857127,2,'2017-08-16 12:18:58','2017-08-16 12:18:47'),(23,'6480钻石','6480','diamond6.png',1,'648',0,1,2,2,6480,'',1,0,'1970-01-01',1,1,100,'',1,0,1,0,'','','','',0,0,1502866288,1,'2017-09-08 11:54:28','2017-08-16 14:51:28'),(24,'首冲礼包','1002','',1,'6',0,1,0,4,1,'{\"0\":{\"Type\":\"1\",\"Id\":\"42\",\"GetNum\":\"20000\"},\"2\":{\"Type\":\"2\",\"Id\":\"43\",\"GetNum\":\"100\"}}',2,0,'1970-01-01',1,1,0,'',5,0,1,0,'首冲礼包','','','',0,0,1502866444,1,'2017-09-19 07:39:37','2017-08-16 14:54:04'),(25,'月卡','2312','',1,'30',0,1,0,4,1,'{\"0\":{\"Type\":\"0\",\"Id\":\"18\",\"GetNum\":\"1\"},\"2\":{\"Type\":\"2\",\"Id\":\"19\",\"GetNum\":\"1\"},\"3\":{\"Type\":\"1\",\"Id\":\"36\",\"GetNum\":\"1\"},\"4\":{\"Type\":\"2\",\"Id\":\"37\",\"GetNum\":\"1\"},\"5\":{\"Type\":\"2\",\"Id\":\"27\",\"GetNum\":\"3\"},\"6\":{\"Type\":\"2\",\"Id\":\"26\",\"GetNum\":\"8\"}}',3,0,'1970-01-01',1,1,0,NULL,4,0,1,0,'','','','',0,0,1502868263,1,'2017-08-31 06:56:31','2017-08-16 15:24:23'),(26,'锁定*8/天','2','aim.png',1,'1',0,1,3,3,1,'',3,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1502868358,1,'2017-09-08 11:50:48','2017-08-16 15:25:58'),(27,'冰冻*3/天','1','ice.png',1,'1',0,1,3,3,1,'',3,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1502868462,1,'2017-09-08 11:51:03','2017-08-16 15:27:42'),(28,'10万金币','3123','coin2.png',4,'1000',0,1,1,1,100000,'',4,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1503649795,1,'2017-09-22 06:11:21','2017-08-25 16:29:55'),(29,'30万金币','321312','coin2.png',4,'3000',0,1,1,1,300000,'',4,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1503650087,1,'2017-09-22 06:13:40','2017-08-25 16:34:47'),(30,'青铜核弹','3','btnt1.png',4,'2500',0,1,3,3,1,'',4,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1503650132,2,'2017-09-01 11:57:57','2017-08-25 16:35:32'),(31,'蓝色核弹','4','btnt2.png',4,'12500',0,1,3,3,1,'',4,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1503652777,1,'2017-10-10 17:29:12','2017-08-25 17:19:37'),(32,'50元话费','321321','hf50.png',4,'5000',0,1,4,0,1,'',4,0,'1970-01-01',1,1,0,'50',1,0,1,0,'','','','',0,0,1503652851,1,'2017-09-20 03:04:10','2017-08-25 17:20:51'),(33,'100元话费','321321','hf100.png',4,'10000',0,1,4,0,1,'',4,0,'1970-01-01',1,1,0,'100',1,0,1,0,'','','','',0,0,1503657738,1,'2017-09-20 03:04:24','2017-08-25 18:42:18'),(34,'3211111','312111','32111',1,'312',0,1,1,1,312,'',0,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1503914276,2,'2017-08-28 17:58:27','2017-08-28 17:58:27'),(35,'渔券','6','card_big.png',0,'0',0,1,3,0,1,'',0,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1504065287,1,'2017-08-31 07:09:01','2017-08-30 11:54:47'),(36,'50000金币/天','50000','coin1.png',1,'0',0,1,1,0,50000,'',3,0,'',1,1,0,'',1,0,1,0,'','','','',0,0,1504079662,1,'2017-09-22 06:31:52','2017-08-30 15:54:22'),(37,'30钻石/天','30','diamond1.png',1,'0',0,1,2,0,30,'',3,0,'',1,1,0,'',1,0,1,0,'','','','',0,0,1504079771,1,'2017-09-22 06:34:20','2017-08-30 15:56:11'),(38,'300元京东卡','66666','jd300.png',4,'30000',0,1,5,0,1,'',4,0,'',1,1,0,'300',1,0,1,0,'','','','',0,0,1504089051,1,'2017-09-20 03:04:55','2017-08-30 18:30:51'),(39,'500元京东卡','77777','jd500.png',4,'50000',0,1,5,0,1,'',4,0,'',1,1,0,'500',1,0,1,0,'','','','',0,0,1504089105,1,'2017-09-20 03:05:05','2017-08-30 18:31:45'),(40,'50元话费卡','312321','321321',4,'50',0,1,4,0,1,'',4,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1504090689,1,'2017-08-30 18:58:41','2017-08-30 18:58:41'),(41,'6000金币','8888','gold_2.png',0,'0',0,1,1,1,6000,'',0,0,'',1,1,0,'',1,0,1,0,'','','','',0,0,1504147778,1,'2017-09-28 14:28:56','2017-08-31 10:49:38'),(42,'1金币','','1',0,'0',0,1,1,0,1,'',0,0,'',1,1,0,'',1,0,1,0,'','','','',0,0,1505723900,1,'2017-09-18 16:39:12','2017-09-18 16:39:12'),(43,'1钻石','','2',0,'1',0,1,2,0,1,'',0,0,'',1,1,0,'',1,0,1,0,'','','','',0,0,1505723943,1,'2017-09-18 16:39:55','2017-09-18 16:39:55'),(44,'冰封','1','ice.png',0,'0',0,1,3,3,1,'',0,0,'',1,1,0,'',1,0,1,0,'','','','',0,0,1505963598,1,'2017-09-21 11:14:11','2017-09-21 11:14:11');

/*Table structure for table `jy_horse_race_lamp` */

DROP TABLE IF EXISTS `jy_horse_race_lamp`;

CREATE TABLE `jy_horse_race_lamp` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '跑马灯',
  `Content` varchar(255) NOT NULL COMMENT '内容',
  `Status` tinyint(1) NOT NULL COMMENT '是否已发送 1-否 2-是',
  `Timing` tinyint(1) NOT NULL COMMENT '是否定时发送 1-否 2-是',
  `Sort` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '优先级',
  `Btime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '过期时间',
  `Remark` varchar(255) NOT NULL COMMENT '备注',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `Timing` (`Timing`,`Btime`),
  KEY `Sort` (`Sort`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `jy_horse_race_lamp` */

insert  into `jy_horse_race_lamp`(`Id`,`Content`,`Status`,`Timing`,`Sort`,`Btime`,`Remark`,`DateTime`) values (1,'大吉大利，晚上吃鸡!',2,2,2,'2017-10-25 18:13:51','1232','2017-09-15 16:23:42'),(4,'测试跑马灯',2,2,0,'2017-10-17 14:46:58','11321','2017-10-09 14:47:10');

/*Table structure for table `jy_prop_list` */

DROP TABLE IF EXISTS `jy_prop_list`;

CREATE TABLE `jy_prop_list` (
  `Name` varchar(255) NOT NULL COMMENT '名称',
  `Code` int(11) unsigned NOT NULL COMMENT '道具ID',
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_prop_list` */

insert  into `jy_prop_list`(`Name`,`Code`) values ('冰封',1),('锁定',2),('小炮弹',3),('中炮弹',4),('大炮弹',5),('渔劵',6);

/*Table structure for table `jy_real_time_online` */

DROP TABLE IF EXISTS `jy_real_time_online`;

CREATE TABLE `jy_real_time_online` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '在线人数',
  `UserNum` int(11) NOT NULL COMMENT '人数',
  `Screenings` tinyint(1) NOT NULL COMMENT '场次',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`Screenings`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_real_time_online` */

/*Table structure for table `jy_register_macrodata` */

DROP TABLE IF EXISTS `jy_register_macrodata`;

CREATE TABLE `jy_register_macrodata` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '注册分析宏观数据',
  `UserNum` int(11) unsigned NOT NULL COMMENT '注册人数',
  `UserGame` int(11) unsigned NOT NULL COMMENT '游戏人数',
  `UserPayNum` int(11) unsigned NOT NULL COMMENT '付费用户',
  `PayNum` int(11) unsigned NOT NULL COMMENT '付费次数',
  `PayMoney` int(11) unsigned NOT NULL COMMENT '付费金额',
  `BankruptcyNum` int(11) unsigned NOT NULL COMMENT '破产用户',
  `BankruptcyNum30` int(11) NOT NULL COMMENT '充值30内破产',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_register_macrodata` */

/*Table structure for table `jy_seven_days_sign` */

DROP TABLE IF EXISTS `jy_seven_days_sign`;

CREATE TABLE `jy_seven_days_sign` (
  `Id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '七天签到',
  `IsExceed` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否超过28天 1-否 2-是',
  `Day` int(4) unsigned NOT NULL COMMENT '第几天',
  `GoodsID` int(11) unsigned NOT NULL COMMENT '物品ID',
  `Type` tinyint(1) unsigned NOT NULL COMMENT '物品类型',
  `Number` int(11) NOT NULL COMMENT '数量',
  `ImgCode` varchar(50) NOT NULL COMMENT '图片标识',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `IsExceed` (`IsExceed`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `jy_seven_days_sign` */

insert  into `jy_seven_days_sign`(`Id`,`IsExceed`,`Day`,`GoodsID`,`Type`,`Number`,`ImgCode`,`DateTime`) values (1,1,1,41,1,1,'coin1.png','2017-08-03 14:53:08'),(21,1,7,41,1,3,'coin1.png','2017-08-28 16:55:40'),(3,1,3,35,3,150,'card_big.png','2017-08-03 14:53:23'),(4,1,4,41,1,2,'coin1.png','2017-08-03 14:53:32'),(11,1,5,41,1,2,'coin1.png','2017-08-03 19:21:40'),(6,1,6,41,1,2,'coin1.png','2017-08-03 14:53:55'),(13,1,2,41,1,2,'coin1.png','2017-08-07 20:01:04'),(25,2,7,41,1,3,'coin1.png','2017-08-28 17:11:04'),(18,2,5,41,1,2,'coin1.png','2017-08-10 14:57:10'),(24,2,6,41,1,2,'coin1.png','2017-08-28 17:10:02'),(27,2,1,41,1,2,'coin1.png','2017-08-30 12:26:34'),(28,2,3,41,1,2,'coin1.png','2017-08-30 12:26:45'),(29,2,2,41,1,2,'coin1.png','2017-08-30 12:30:22'),(30,2,4,41,1,2,'coin1.png','2017-08-30 12:30:33');

/*Table structure for table `jy_statistics_activem_acroscopic` */

DROP TABLE IF EXISTS `jy_statistics_activem_acroscopic`;

CREATE TABLE `jy_statistics_activem_acroscopic` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '统计活跃-宏观数据',
  `UserNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户数量',
  `WAU` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '7内',
  `MAU` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '30天内',
  `UserPayNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '付费用户数量',
  `UserGame` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户游戏数量',
  `BankruptcyNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '破产数量',
  `BankruptcyNum30` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '付费30分钟破产',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_statistics_activem_acroscopic` */

/*Table structure for table `jy_statistics_activem_diamond` */

DROP TABLE IF EXISTS `jy_statistics_activem_diamond`;

CREATE TABLE `jy_statistics_activem_diamond` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活跃统计-钻石',
  `GroupID` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '区间组ID',
  `UserNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '统计时间',
  KEY `Id` (`Id`),
  KEY `DateTime` (`DateTime`,`GroupID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_statistics_activem_diamond` */

/*Table structure for table `jy_statistics_activem_gold` */

DROP TABLE IF EXISTS `jy_statistics_activem_gold`;

CREATE TABLE `jy_statistics_activem_gold` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活跃金币统计',
  `GroupID` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '区间范围ID',
  `UserNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_statistics_activem_gold` */

/*Table structure for table `jy_statistics_activem_level` */

DROP TABLE IF EXISTS `jy_statistics_activem_level`;

CREATE TABLE `jy_statistics_activem_level` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活跃统计-等级',
  `Level` int(6) unsigned NOT NULL COMMENT '等级',
  `UserNum` int(11) unsigned NOT NULL COMMENT '用户数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`Level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_statistics_activem_level` */

/*Table structure for table `jy_statistics_activem_version` */

DROP TABLE IF EXISTS `jy_statistics_activem_version`;

CREATE TABLE `jy_statistics_activem_version` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活跃统计-版本号',
  `Version` varchar(255) NOT NULL COMMENT '版本号',
  `UserNum` int(11) NOT NULL COMMENT '用户数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_statistics_activem_version` */

/*Table structure for table `jy_statistics_gold` */

DROP TABLE IF EXISTS `jy_statistics_gold`;

CREATE TABLE `jy_statistics_gold` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '金币统计',
  `Number` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `UserNum` int(1) unsigned NOT NULL COMMENT '人数',
  `Frequency` bigint(20) NOT NULL COMMENT '次数',
  `Income` tinyint(1) DEFAULT '1' COMMENT '1-发放 2-回收',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '货币类型 1-金币 2-钻石',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `Type` (`Type`,`DateTime`),
  KEY `Income` (`Income`,`DateTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_statistics_gold` */

/*Table structure for table `jy_statistics_goods` */

DROP TABLE IF EXISTS `jy_statistics_goods`;

CREATE TABLE `jy_statistics_goods` (
  `GoodsID` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '物品ID',
  `SuccessNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '成功数',
  `TotalNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '总下单数',
  PRIMARY KEY (`GoodsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_statistics_goods` */

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
  `RegNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '注册人数',
  `ActiveNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '活跃数',
  `TotalMoney` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '日收入总额',
  `Success` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '成功',
  `UserPayNumOld` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '老用户数量',
  `OrderTotalOld` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '老用户订单总额',
  `OrderTotal` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '订单总数',
  `First` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '首次充值数',
  `Channel` varchar(50) NOT NULL COMMENT '渠道号',
  `FirstMoney` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '首付金额',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`Channel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_statistics_users_pay` */

/*Table structure for table `jy_system_menu` */

DROP TABLE IF EXISTS `jy_system_menu`;

CREATE TABLE `jy_system_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统菜单',
  `name` varchar(20) NOT NULL COMMENT '菜单名',
  `icon` varchar(20) NOT NULL COMMENT '菜单表',
  `url` varchar(100) NOT NULL COMMENT '菜单地址',
  `sort` int(11) unsigned NOT NULL COMMENT '排序',
  `islock` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否锁定',
  `upid` int(11) NOT NULL DEFAULT '0' COMMENT '上级菜单',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

/*Data for the table `jy_system_menu` */

insert  into `jy_system_menu`(`id`,`name`,`icon`,`url`,`sort`,`islock`,`upid`,`remark`,`mtime`) values (1,'系统管理','','###',0,1,0,'','2017-07-12 08:19:33'),(2,'菜单列表','','/jy_admin/menu/index',1,1,1,'','2017-07-11 10:21:22'),(3,'管理员','','/jy_admin/AdminUsers/index',2,1,1,'','2017-07-11 10:24:37'),(4,'管理员组','','/jy_admin/admingroup/index',3,1,1,'','2017-07-11 10:25:13'),(5,'渠道管理','','###',1,1,0,'','2017-07-12 08:19:46'),(6,'渠道列表','','/jy_admin/Channel/index',0,1,5,'','2017-07-11 10:32:45'),(7,'渠道数据','','/jy_admin/ChannelData/index',0,1,5,'','2017-09-27 10:58:11'),(9,'全局数据','','###',3,1,0,'','2017-07-12 08:20:20'),(10,'全局数据','','/jy_admin/GlobalData/index',1,1,9,'','2017-07-12 09:22:13'),(14,'注册分析','','###',4,1,0,'','2017-07-12 08:07:06'),(15,'宏观数据','','/jy_admin/RegisterMacroscopic/index',0,1,14,'','2017-07-15 01:06:32'),(61,'商品分析','','/jy_admin/PayMacroscopic/Goods',2,1,35,'','2017-09-14 17:28:27'),(60,'支付类型','','/jy_admin/PayMacroscopic/PayType',1,1,35,'','2017-09-14 16:59:24'),(66,'签到流水','','###',1,1,65,'','2017-09-23 14:47:17'),(21,'活跃分析','','###',5,1,0,'','2017-07-12 08:12:36'),(22,'宏观数据','','/jy_admin/ActiveMacroscopic/index',1,1,21,'','2017-07-18 07:33:13'),(23,'等级分布','','/jy_admin/ActiveLevel/index',2,1,21,'','2017-07-19 01:46:26'),(24,'版本分布','','/jy_admin/ActiveEdition/index',3,1,21,'','2017-07-19 02:22:07'),(27,'实时数据','','###',6,1,0,'','2017-07-12 08:18:34'),(28,'实时概况','','/jy_admin/RealTimeOverview/index',1,1,27,'','2017-09-20 16:50:52'),(29,'实时在线','','/jy_admin/RealTimeOnline/index',2,1,27,'','2017-09-23 15:50:26'),(30,'实时收入','','/jy_admin/RealTimeRevenue/index',0,1,27,'','2017-09-23 15:19:46'),(31,'留存分析','','###',6,1,0,'','2017-07-12 08:22:54'),(32,'留存数据','','/jy_admin/RetainedData/index',0,1,31,'','2017-07-20 09:02:31'),(33,'流失数据','','/jy_admin/RetainedDataLoss/index',1,1,31,'','2017-09-27 11:05:18'),(35,'付费分析','','###',7,1,0,'','2017-07-12 08:26:06'),(36,'宏观数据','','/jy_admin/PayMacroscopic/index',0,1,35,'','2017-07-25 07:42:04'),(37,'货币流水','','###',8,1,0,'','2017-07-12 08:29:30'),(38,'金币流水','','/jy_admin/GoldStream/index',0,1,37,'','2017-09-15 18:55:01'),(39,'钻石流水','','/jy_admin/DiamondsStream/index',1,1,37,'','2017-09-15 18:52:28'),(40,'道具流水','','/jy_admin/PropStream/index',2,1,37,'','2017-09-19 10:04:07'),(65,'项目流水','','###',10,1,0,'','2017-09-23 14:46:15'),(42,'用户中心','###','###',2,1,0,'','2017-07-12 08:52:45'),(43,'用户列表','','/jy_admin/UsersInfo/index',1,1,42,'','2017-08-29 20:52:52'),(44,'金币分布','','/jy_admin/ActiveGold/index',2,1,21,'','2017-07-20 03:07:07'),(45,'钻石分布','','/jy_admin/ActiveDiamond/index',3,1,21,'','2017-07-20 08:14:53'),(46,'大厅配置','','####',3,1,0,'','2017-07-26 06:36:59'),(47,'商品列表','','/jy_admin/GoodsAll/index',0,1,46,'','2017-07-26 16:04:55'),(48,'七天签到（前四周）','','/jy_admin/SevenDaysSign/index',1,1,46,'','2017-08-10 14:40:48'),(49,'活动列表','','/jy_admin/activityList/index',3,1,46,'','2017-08-11 15:04:06'),(50,'vip等级','','/jy_admin/VipInfo/index',1,1,42,'','2017-07-26 10:08:24'),(59,'发送邮件','','/jy_admin/SendEmail/index',0,1,42,'','2017-09-01 14:27:31'),(52,'支付管理','','###',3,1,0,'','2017-07-26 06:51:29'),(53,'支付配置','','/jy_admin/ThirdpayInfo/index',0,1,52,'','2017-07-31 18:12:01'),(54,'所有订单','###','/jy_admin/UsersOrder/index',4,1,42,'','2017-08-02 16:43:15'),(55,'七天签到（后四周）','','/jy_admin/SevenDaysSignReward/index',2,1,46,'','2017-08-28 17:02:00'),(57,'用户属性','###','/jy_admin/UsersAttribute/index',1,1,42,'','2017-08-28 19:13:56'),(58,'兑换申请','','/jy_admin/UsersExchangeApplication/index',2,1,42,'','2017-08-31 10:13:52'),(62,'游戏公告','','/jy_admin/Notice/index',5,1,46,'###','2017-09-15 10:11:26'),(63,'跑马灯','##','/jy_admin/HorseRaceLamp/index',5,1,46,'','2017-09-15 15:37:53');

/*Table structure for table `jy_thirdpay` */

DROP TABLE IF EXISTS `jy_thirdpay`;

CREATE TABLE `jy_thirdpay` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '支付信息',
  `Name` varchar(20) NOT NULL COMMENT '支付名称',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型 1-支付 2-微信 3-爱贝',
  `Platform` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '平台 1-苹果 2-安卓',
  `PassAgeWay` varchar(50) NOT NULL COMMENT '通道',
  `Recommend` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否推荐',
  `public` text COMMENT '公钥(支付宝，爱贝)',
  `private` text COMMENT '私钥（支付宝，微信，爱贝）',
  `appid` varchar(100) DEFAULT NULL COMMENT '应用ID(微信，爱贝)',
  `partner` varchar(100) DEFAULT NULL COMMENT '合作者id(微信支付宝)',
  `account` varchar(100) DEFAULT NULL COMMENT '支付宝签约账号',
  `Sort` int(11) NOT NULL COMMENT '排序',
  `Notifyurl` varchar(255) NOT NULL COMMENT '回调通知',
  `Describe` varchar(255) NOT NULL COMMENT '通道描述',
  `Support` tinyint(1) NOT NULL DEFAULT '1' COMMENT '所有版本 1-否 2-是',
  `VersionStart` varchar(20) NOT NULL COMMENT '起始版本',
  `VersionEnd` varchar(20) NOT NULL COMMENT '结束版本',
  `IsDel` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否删除 1-是 2-否',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `PassAgeWay` (`PassAgeWay`),
  KEY `IsDel` (`IsDel`),
  KEY `Platform` (`Platform`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `jy_thirdpay` */

insert  into `jy_thirdpay`(`Id`,`Name`,`Type`,`Platform`,`PassAgeWay`,`Recommend`,`public`,`private`,`appid`,`partner`,`account`,`Sort`,`Notifyurl`,`Describe`,`Support`,`VersionStart`,`VersionEnd`,`IsDel`,`DateTime`) values (6,'爱贝',3,2,'iappay',1,'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDtv7IzXBGp486UAFwaLIXsSua8JiTSe5kSKU6IXNiJxZIMZ/2dlKOV66hFIQjP/0u8YV9Du+uk8/3nmTMhdBpanzp9awkXnO2g104ng9x34YxoDMMv24MmOhT7c2mnhCuEyFbz/KkvnhzQn6L+MAwYvkkQInpw/ArHDJ0NkbyJNQIDAQAB','MIICXAIBAAKBgQCR/ZyLQ7Z2pCv8sZcNuqDcgEoEhPQPOT9Ci8l43mIBhjbSCIPuDPiiZJJ9HjaMpy+X1cUZP1SY9TtZDzA3R5pAWd1HY+Ps/Q8aDiRou2mNESlWor5/xmG8TcQcWLshS3VzHWz4cY7i8o+EIACfHbDTSTkqTxCIyjw1BYxGTyqLVwIDAQABAoGAGDGseNPu8DiC5azUuLy+HezQ13DlNYSqPDAIYpSQL2p7uVEZ9CCIL/l04XFZXvPyCjquIGIDdhnmDPtcZTzjjhfltp6N3Uqmtp4D2cPWruR6B2icvve2bno2Lu6OULuAYyEkVMHCdEf5GSSHjShIG6CBahHfHZhWzjoPYZWAZ9ECQQDd/NGvmzcLVHOXM4muml6leF9OmQNqA+qVec9Sqb39t2CNJY4QxdJ/AzQnLeskqVBydQm60P2lbi3M1eCMW+sPAkEAqFvpB1vgkj6dlbySyHGu5mzTiJBRSVvz4c5XAA01iLCNPGdtQGT7jslnkyueXMwdiq3pBDpGuzL9v9QIuw17OQJADv+h+0d1dKKEHNcymkV715pGdj0IagVRuD++rkshtx7Iu0CqVJ/JFSPWRj9n/9YgxVr7CVBNkvvaxFg/D7y2KQJARCqKjG832x69IU5rw/q7jRKNB2MfdmtjsI6iDSRMA58wYD+kLYl1jReg9yaXBQ2j/G1zxkFuOAdqVEweiNXpiQJBAJjblicX+Y7y0EwKfOXP9oU2KjbxGAy5Et5AL+6AdloVbjZAU1o3LYfjuCz+YaU3jPx38FIT1Npe/WWIuTyusZ8=','3015007654','','',1,'http://testphp.juyihd.com/Jy_ThirdpayIapppay/Notifyurl/index','',2,'','',1,'2017-08-24 14:20:31'),(13,'金立',4,2,'JinPay',1,'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCdKgAqh6JxOTz6MdbCt0Ejm2YtK3ix/ryfGY6K954WtpauoaXXvaVzDuT4Oy+4ezVtAfvZGCMruEFIBhoHBiYKGBnTUupggINsK+vq9NKHJfWJv4FXkqRgeVtVB9D+1sep7mMOW6A2sj5scJQee2XRDTvJgYK1h6ipdJg5ii/qjwIDAQAB','MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAJk3rgKvOvKz/NFvdSC7uIO4yGpl3IskuUv9hyr33QS/N2Qxz8W+VHn2H7syoPLbXyAK1QB16uIOtM7mVP6yaXnqCOdOudKRHqG4JvXg8e4oAnn5GNu2RULpafLS+yPL5pl6kwgNwB7uGcpHWuf+zmHnlLThc25BjKyv2Gm8cOuHAgMBAAECgYEAjL4Z6Ttf8dwmC5jPxf7Kcq1F5H6nRWW5lLVR+cVv0FF6J16eVi4M2W+eHE5YjF25Fuz8Voz68ybBLiFkyAXJXpL9WqnLoB4x7KnWkvFUyVN00Hdi8rtrAlnw2ne/wA/+4No/9ALVBBr3axwHRr53brprgGBwA2ffnzKpqRLYIOECQQDt9TR7787JuvuvhTclyhXgeUbb1xpCYZJVNQZh2h6IrESjTAnrIB6M59XET2vjS09pvwXWVSrnJO3oVPS82HjXAkEApNWnJl1vDjI15OXQgbCIKJYSc1mALS1QGr50I2tYXU/9WMketJkGBdAIyAJM77uKD858O0RHyN7KnNUiZ99c0QJBAI+3zzEjj0NruWMzFDGwsjHXTaKtceCxyY3I7sfe0x483V+7JyppRcpYo1Vjmoe3DomRo9blrXnZZg8ycHY2UBUCQCJwlXz5lqOTsBkEP11pgflg6bf6IkLOLed4lZF080CD3v42/1hihJSgU8VeXa7VM1J8JQ7JBGqeyhycl5S2YZECQFIZHlzDPkAlpli8aY5v8GIq738KsBWQfHxRkwUz26peExgPsO8Ux6rNrMIwIkKP5P1U5nQzN6ob2Z3HmlqpRTQ=','C0A4C51F3F9548E8BA2A8DFA1EA522C6','','',2,'pay.juyihd.com','1',1,'','',1,'2017-09-26 12:26:57');

/*Table structure for table `jy_users_activity_theaward_log` */

DROP TABLE IF EXISTS `jy_users_activity_theaward_log`;

CREATE TABLE `jy_users_activity_theaward_log` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户领奖记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned NOT NULL COMMENT '物品ID',
  `GoodsName` varchar(50) NOT NULL COMMENT '物品名',
  `activityID` int(11) unsigned NOT NULL COMMENT '活动ID',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '活动类型',
  `GetNum` int(11) unsigned NOT NULL COMMENT '数量',
  `Number` int(11) unsigned NOT NULL COMMENT '倍数',
  `AddUpStartTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '计费开始时间',
  `Channel` varchar(50) NOT NULL COMMENT '渠道',
  `AddUpEndTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '计费结束时间',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '领取时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`AddUpStartTime`,`AddUpEndTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_activity_theaward_log` */

/*Table structure for table `jy_users_bankruptcy` */

DROP TABLE IF EXISTS `jy_users_bankruptcy`;

CREATE TABLE `jy_users_bankruptcy` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户破产',
  `playerid` bigint(20) NOT NULL COMMENT '用户ID',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '破产时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_bankruptcy` */

/*Table structure for table `jy_users_card_receive_log` */

DROP TABLE IF EXISTS `jy_users_card_receive_log`;

CREATE TABLE `jy_users_card_receive_log` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '月卡领取奖励',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `GoodsID` int(1) NOT NULL COMMENT '物品ID',
  `Type` tinyint(1) NOT NULL COMMENT '类型',
  `Code` varchar(20) NOT NULL COMMENT '物品编号',
  `GetNum` bigint(20) NOT NULL COMMENT '数量',
  `Number` bigint(20) NOT NULL COMMENT '倍数',
  `Channel` varchar(50) NOT NULL COMMENT '渠道',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`DateTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_card_receive_log` */

/*Table structure for table `jy_users_currency_stream` */

DROP TABLE IF EXISTS `jy_users_currency_stream`;

CREATE TABLE `jy_users_currency_stream` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户金币钻石流水',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `Type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型 1-游戏 2-充值 3-签到 4-兑换 5-月卡 6-首冲',
  `CurrencyType` tinyint(1) NOT NULL DEFAULT '1' COMMENT '货币类型 1-金币 2-钻石',
  `Screenings` tinyint(1) NOT NULL DEFAULT '0' COMMENT '场次 1-十 2-百 3-千 4-万',
  `Channel` varchar(50) DEFAULT NULL,
  `Income` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-收入 2-支出',
  `Number` int(20) NOT NULL COMMENT '数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`Type`,`CurrencyType`),
  KEY `DateTime` (`DateTime`,`Type`,`CurrencyType`,`Income`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_currency_stream` */

/*Table structure for table `jy_users_exchange_log` */

DROP TABLE IF EXISTS `jy_users_exchange_log`;

CREATE TABLE `jy_users_exchange_log` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户兑换记录',
  `GoodsName` varchar(50) NOT NULL COMMENT '商品名',
  `Number` int(11) unsigned NOT NULL COMMENT '倍数',
  `GetNum` bigint(20) NOT NULL COMMENT '数量',
  `Order` varchar(20) NOT NULL COMMENT '兑换订单号',
  `Type` tinyint(1) NOT NULL COMMENT '类型',
  `Code` varchar(50) NOT NULL COMMENT '物品ID',
  `StockNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '兑换劵',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `Status` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '状态 1-审核中 2-已发放 3-审核不通过',
  `MessAge` text COMMENT '申请失败原因',
  `Channel` varchar(50) NOT NULL COMMENT '渠道',
  `GoodsID` int(11) unsigned NOT NULL COMMENT '商品ID',
  `UpTime` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '兑换时间',
  PRIMARY KEY (`Id`),
  KEY `DateTimes` (`DateTime`,`Status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_exchange_log` */

/*Table structure for table `jy_users_goods_stream` */

DROP TABLE IF EXISTS `jy_users_goods_stream`;

CREATE TABLE `jy_users_goods_stream` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户物品流水',
  `playerid` bigint(20) NOT NULL COMMENT '用户ID',
  `Code` varchar(20) NOT NULL COMMENT '物品编码',
  `Screenings` tinyint(4) NOT NULL DEFAULT '0' COMMENT '场次 1-十 2-百 3-千 4-万',
  `Type` tinyint(1) unsigned NOT NULL COMMENT '类型 1-游戏 2-充值 3-签到 4-兑换 5-月卡 6-首冲',
  `Channel` varchar(50) DEFAULT NULL COMMENT '渠道',
  `Income` tinyint(1) NOT NULL COMMENT '1-收入 2-支出',
  `Number` int(11) NOT NULL COMMENT '数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`playerid`),
  KEY `Code` (`Code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_goods_stream` */

/*Table structure for table `jy_users_order_goods` */

DROP TABLE IF EXISTS `jy_users_order_goods`;

CREATE TABLE `jy_users_order_goods` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单物品',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `PlatformOrder` varchar(30) NOT NULL COMMENT '订单号',
  `GoodsName` varchar(50) NOT NULL COMMENT '物品名',
  `GoodsCode` varchar(50) NOT NULL COMMENT '物品编码',
  `GetNum` int(1) unsigned NOT NULL COMMENT '物品数量',
  `Proportion` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '首冲赠送比例',
  `GoodsID` int(11) unsigned NOT NULL COMMENT '物品ID',
  `Price` int(11) unsigned NOT NULL COMMENT '价格',
  `IsGive` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否赠送 1-否 2-是',
  `Number` int(4) NOT NULL DEFAULT '1' COMMENT '数量',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '物品类型',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `GoodsId` (`GoodsID`),
  KEY `Order` (`PlatformOrder`,`playerid`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_order_goods` */

insert  into `jy_users_order_goods`(`Id`,`playerid`,`PlatformOrder`,`GoodsName`,`GoodsCode`,`GetNum`,`Proportion`,`GoodsID`,`Price`,`IsGive`,`Number`,`Type`,`DateTime`) values (1,108675,'JYHD2017100954505656','68万金币','680000',680000,100,10,68,1,1,1,'2017-10-09 12:03:50'),(2,108675,'JYHD2017100952505598','30万金币','300000',300000,100,9,0,1,1,1,'2017-10-09 12:08:36'),(3,108675,'JYHD2017100955100549','60000金币','60000',60000,100,8,0,1,1,1,'2017-10-09 12:08:40'),(4,108675,'JYHD2017100998501004','168万金币','1680000',1680000,100,11,168,1,1,1,'2017-10-09 12:08:43'),(5,109132,'JYHD2017100956499910','月卡','2312',1,0,25,30,1,1,0,'2017-10-09 15:29:12'),(6,109132,'JYHD2017100956499910','自动发炮','1004',1,0,18,0,2,1,0,'2017-10-09 15:29:12'),(7,109132,'JYHD2017100956499910','捕渔券概率提升','1005',1,0,19,0,2,1,0,'2017-10-09 15:29:12'),(8,109132,'JYHD2017100956499910','锁定*8/天','2',1,0,26,0,2,8,3,'2017-10-09 15:29:12'),(9,109132,'JYHD2017100956499910','冰冻*3/天','1',1,0,27,0,2,3,3,'2017-10-09 15:29:12'),(10,109132,'JYHD2017100956499910','50000金币/天','50000',50000,0,36,0,2,1,1,'2017-10-09 15:29:12'),(11,109132,'JYHD2017100956499910','30钻石/天','30',30,0,37,0,2,1,2,'2017-10-09 15:29:12'),(12,109198,'JYHD2017100949555497','月卡','2312',1,0,25,30,1,1,0,'2017-10-09 16:46:41'),(13,109198,'JYHD2017100949555497','自动发炮','1004',1,0,18,0,2,1,0,'2017-10-09 16:46:41'),(14,109198,'JYHD2017100949555497','捕渔券概率提升','1005',1,0,19,0,2,1,0,'2017-10-09 16:46:41'),(15,109198,'JYHD2017100949555497','锁定*8/天','2',1,0,26,0,2,8,3,'2017-10-09 16:46:41'),(16,109198,'JYHD2017100949555497','冰冻*3/天','1',1,0,27,0,2,3,3,'2017-10-09 16:46:41'),(17,109198,'JYHD2017100949555497','50000金币/天','50000',50000,0,36,0,2,1,1,'2017-10-09 16:46:41'),(18,109198,'JYHD2017100949555497','30钻石/天','30',30,0,37,0,2,1,2,'2017-10-09 16:46:41'),(19,109624,'JYHD2017100954975610','月卡','2312',1,0,25,30,1,1,0,'2017-10-09 17:56:38'),(20,109624,'JYHD2017100954975610','自动发炮','1004',1,0,18,0,2,1,0,'2017-10-09 17:56:38'),(21,109624,'JYHD2017100954975610','捕渔券概率提升','1005',1,0,19,0,2,1,0,'2017-10-09 17:56:38'),(22,109624,'JYHD2017100954975610','锁定*8/天','2',1,0,26,0,2,8,3,'2017-10-09 17:56:38'),(23,109624,'JYHD2017100954975610','冰冻*3/天','1',1,0,27,0,2,3,3,'2017-10-09 17:56:38'),(24,109624,'JYHD2017100954975610','50000金币/天','50000',50000,0,36,0,2,1,1,'2017-10-09 17:56:38'),(25,109624,'JYHD2017100954975610','30钻石/天','30',30,0,37,0,2,1,2,'2017-10-09 17:56:38'),(26,110246,'JYHD2017100956505552','6480钻石','6480',6480,100,23,648,1,1,2,'2017-10-09 19:25:28'),(27,111020,'JYHD2017101055485248','680钻石','680',680,100,16,68,1,1,2,'2017-10-10 15:10:31'),(28,111020,'JYHD2017101049101525','30万金币','300000',300000,100,9,0,1,1,1,'2017-10-10 15:13:38'),(29,111020,'JYHD2017101054975057','648万金币','6480000',6480000,100,13,648,1,1,1,'2017-10-10 15:14:46'),(30,111020,'JYHD2017101057531004','月卡','2312',1,0,25,30,1,1,0,'2017-10-10 15:19:05'),(31,111020,'JYHD2017101057531004','自动发炮','1004',1,0,18,0,2,1,0,'2017-10-10 15:19:05'),(32,111020,'JYHD2017101057531004','捕渔券概率提升','1005',1,0,19,0,2,1,0,'2017-10-10 15:19:05'),(33,111020,'JYHD2017101057531004','锁定*8/天','2',1,0,26,0,2,8,3,'2017-10-10 15:19:05'),(34,111020,'JYHD2017101057531004','冰冻*3/天','1',1,0,27,0,2,3,3,'2017-10-10 15:19:05'),(35,111020,'JYHD2017101057531004','50000金币/天','50000',50000,0,36,0,2,1,1,'2017-10-10 15:19:05'),(36,111020,'JYHD2017101057531004','30钻石/天','30',30,0,37,0,2,1,2,'2017-10-10 15:19:05'),(37,111083,'JYHD2017101049974810','60000金币','60000',60000,100,8,0,1,1,1,'2017-10-10 15:26:25'),(38,111103,'JYHD2017101010155995','68万金币','680000',680000,100,10,68,1,1,1,'2017-10-10 15:34:06'),(39,111103,'JYHD2017101054575099','680钻石','680',680,100,16,68,1,1,2,'2017-10-10 15:34:46'),(40,111125,'JYHD2017101052545255','月卡','2312',1,0,25,30,1,1,0,'2017-10-10 15:38:12'),(41,111125,'JYHD2017101052545255','自动发炮','1004',1,0,18,0,2,1,0,'2017-10-10 15:38:12'),(42,111125,'JYHD2017101052545255','捕渔券概率提升','1005',1,0,19,0,2,1,0,'2017-10-10 15:38:12'),(43,111125,'JYHD2017101052545255','锁定*8/天','2',1,0,26,0,2,8,3,'2017-10-10 15:38:12'),(44,111125,'JYHD2017101052545255','冰冻*3/天','1',1,0,27,0,2,3,3,'2017-10-10 15:38:12'),(45,111125,'JYHD2017101052545255','50000金币/天','50000',50000,0,36,0,2,1,1,'2017-10-10 15:38:12'),(46,111125,'JYHD2017101052545255','30钻石/天','30',30,0,37,0,2,1,2,'2017-10-10 15:38:12'),(47,111103,'JYHD2017101050495649','月卡','2312',1,0,25,30,1,1,0,'2017-10-10 15:39:14'),(48,111103,'JYHD2017101050495649','自动发炮','1004',1,0,18,0,2,1,0,'2017-10-10 15:39:14'),(49,111103,'JYHD2017101050495649','捕渔券概率提升','1005',1,0,19,0,2,1,0,'2017-10-10 15:39:14'),(50,111103,'JYHD2017101050495649','锁定*8/天','2',1,0,26,0,2,8,3,'2017-10-10 15:39:14'),(51,111103,'JYHD2017101050495649','冰冻*3/天','1',1,0,27,0,2,3,3,'2017-10-10 15:39:14'),(52,111103,'JYHD2017101050495649','50000金币/天','50000',50000,0,36,0,2,1,1,'2017-10-10 15:39:14'),(53,111103,'JYHD2017101050495649','30钻石/天','30',30,0,37,0,2,1,2,'2017-10-10 15:39:14'),(54,111139,'JYHD2017101097565099','6480钻石','6480',6480,100,23,648,1,1,2,'2017-10-10 15:58:02'),(55,111390,'JYHD2017101048515110','30万金币','300000',300000,100,9,0,1,1,1,'2017-10-10 16:32:48'),(56,111390,'JYHD2017101050102514','680钻石','680',680,100,16,68,1,1,2,'2017-10-10 16:33:55'),(57,111390,'JYHD2017101055989710','月卡','2312',1,0,25,30,1,1,0,'2017-10-10 16:35:19'),(58,111390,'JYHD2017101055989710','自动发炮','1004',1,0,18,0,2,1,0,'2017-10-10 16:35:19'),(59,111390,'JYHD2017101055989710','捕渔券概率提升','1005',1,0,19,0,2,1,0,'2017-10-10 16:35:19'),(60,111390,'JYHD2017101055989710','锁定*8/天','2',1,0,26,0,2,8,3,'2017-10-10 16:35:19'),(61,111390,'JYHD2017101055989710','冰冻*3/天','1',1,0,27,0,2,3,3,'2017-10-10 16:35:19'),(62,111390,'JYHD2017101055989710','50000金币/天','50000',50000,0,36,0,2,1,1,'2017-10-10 16:35:19'),(63,111390,'JYHD2017101055989710','30钻石/天','30',30,0,37,0,2,1,2,'2017-10-10 16:35:19'),(64,111390,'JYHD2017101050975310','3280钻石','3280',3280,100,20,328,1,1,2,'2017-10-10 16:36:18'),(65,111442,'JYHD2017101055489752','月卡','2312',1,0,25,30,1,1,0,'2017-10-10 16:37:27'),(66,111442,'JYHD2017101055489752','自动发炮','1004',1,0,18,0,2,1,0,'2017-10-10 16:37:27'),(67,111442,'JYHD2017101055489752','捕渔券概率提升','1005',1,0,19,0,2,1,0,'2017-10-10 16:37:27'),(68,111442,'JYHD2017101055489752','锁定*8/天','2',1,0,26,0,2,8,3,'2017-10-10 16:37:27'),(69,111442,'JYHD2017101055489752','冰冻*3/天','1',1,0,27,0,2,3,3,'2017-10-10 16:37:27'),(70,111442,'JYHD2017101055489752','50000金币/天','50000',50000,0,36,0,2,1,1,'2017-10-10 16:37:27'),(71,111442,'JYHD2017101055489752','30钻石/天','30',30,0,37,0,2,1,2,'2017-10-10 16:37:27'),(72,111615,'JYHD2017101051101534','6480钻石','6480',6480,100,23,648,1,1,2,'2017-10-10 16:39:00'),(73,111848,'JYHD2017101050971009','6480钻石','6480',6480,100,23,648,1,1,2,'2017-10-10 16:57:38'),(74,112842,'JYHD2017101098101100','6480钻石','6480',6480,100,23,648,1,1,2,'2017-10-10 17:08:44'),(75,113001,'JYHD2017101053495110','300钻石','300',300,100,15,30,1,1,2,'2017-10-10 17:23:01'),(76,113096,'JYHD2017101054101539','1680钻石','1680',1680,100,17,168,1,1,2,'2017-10-10 17:28:23'),(77,113647,'JYHD2017101097100989','6480钻石','6480',6480,100,23,648,1,1,2,'2017-10-10 19:14:35'),(78,115049,'JYHD2017101157101975','60000金币','60000',60000,100,8,0,1,1,1,'2017-10-11 12:31:06'),(79,115852,'JYHD2017101155999897','60钻石','60',60,100,14,6,1,1,2,'2017-10-11 14:44:08'),(80,115852,'JYHD2017101152505750','30万金币','300000',300000,100,9,0,1,1,1,'2017-10-11 14:44:36');

/*Table structure for table `jy_users_order_info` */

DROP TABLE IF EXISTS `jy_users_order_info`;

CREATE TABLE `jy_users_order_info` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `OrderName` varchar(50) NOT NULL COMMENT '订单名称',
  `UsersName` varchar(50) NOT NULL COMMENT '用户名',
  `PlatformOrder` varchar(50) NOT NULL COMMENT '平台订单号',
  `MerchantOrder` varchar(50) NOT NULL COMMENT '商户订单号',
  `Status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态  1-待支付 2-已支付 3-订单过期 4-支付失败',
  `Price` float NOT NULL COMMENT '价格',
  `CallbackTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '支付回调时间',
  `ExpireTime` int(11) unsigned DEFAULT NULL COMMENT '订单过期时间',
  `FoundTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `RegisterChannel` varchar(50) NOT NULL COMMENT '注册渠道',
  `MessAge` varchar(255) DEFAULT NULL COMMENT '支付状态说明',
  `IsFirst` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否首次支付 1-否 2-是',
  `PayPlatform` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支付平台 1-支付宝 2-微信 3-爱贝 4-银联',
  `PayChannel` varchar(50) NOT NULL COMMENT '消费渠道',
  `VipLevel` int(4) unsigned DEFAULT NULL COMMENT '购买前用户Vip等级',
  `Form` tinyint(1) NOT NULL DEFAULT '1' COMMENT '来源 1-首冲 2-月卡 3-商城',
  `appuserid` varchar(50) DEFAULT NULL,
  `VipExp` int(11) unsigned DEFAULT NULL COMMENT '购买前用户Vip经验',
  `PayID` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '支付ID',
  `Platform` tinyint(1) NOT NULL DEFAULT '1' COMMENT '平台 1-苹果 2-安卓',
  `PayPassAgeWay` varchar(50) NOT NULL COMMENT '支付通道',
  `PayType` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付类型 0-未支付 1-支付宝 2-微信',
  PRIMARY KEY (`Id`),
  KEY `PlatformOrder` (`PlatformOrder`),
  KEY `Status` (`Status`,`CallbackTime`),
  KEY `playerid` (`playerid`,`Status`),
  KEY `CallbackTime` (`CallbackTime`,`playerid`,`Status`),
  KEY `PayChannel` (`PayChannel`,`FoundTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_order_info` */

/*Table structure for table `jy_users_package_shop_log` */

DROP TABLE IF EXISTS `jy_users_package_shop_log`;

CREATE TABLE `jy_users_package_shop_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户礼包购买记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户Id',
  `Type` tinyint(1) unsigned NOT NULL COMMENT '1-首充 2-月卡',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`Type`,`DateTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_package_shop_log` */

/*Table structure for table `jy_users_shop_log` */

DROP TABLE IF EXISTS `jy_users_shop_log`;

CREATE TABLE `jy_users_shop_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '购买记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `GoodID` int(11) unsigned NOT NULL COMMENT '物品ID',
  `Code` varchar(20) NOT NULL COMMENT '物品编号',
  `GiveNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '赠送数量',
  `IsGive` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否赠送 1-否 2-是',
  `Number` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_shop_log` */

/*Table structure for table `jy_users_sign_log` */

DROP TABLE IF EXISTS `jy_users_sign_log`;

CREATE TABLE `jy_users_sign_log` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户签到记录表',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `GoodsID` bigint(20) unsigned NOT NULL COMMENT '物品ID',
  `Day` tinyint(1) unsigned NOT NULL COMMENT '第几天',
  `Code` varchar(50) NOT NULL COMMENT '物品编码',
  `Type` tinyint(1) unsigned NOT NULL COMMENT '物品类型',
  `GetNum` bigint(20) unsigned NOT NULL COMMENT '数量',
  `Channel` varchar(50) NOT NULL COMMENT '渠道',
  `Number` int(11) NOT NULL COMMENT '倍数',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '签到时间',
  PRIMARY KEY (`Id`),
  KEY `Day` (`Day`),
  KEY `playerid` (`playerid`,`DateTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_sign_log` */

/*Table structure for table `jy_vip_info` */

DROP TABLE IF EXISTS `jy_vip_info`;

CREATE TABLE `jy_vip_info` (
  `level` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '等级',
  `GiveInfo` varchar(50) NOT NULL COMMENT '赠送信息',
  `ImgCode` varchar(50) NOT NULL COMMENT '图标',
  `Describe` varchar(255) NOT NULL COMMENT '描述',
  `experience` int(11) NOT NULL COMMENT '充值额度',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_vip_info` */

insert  into `jy_vip_info`(`level`,`GiveInfo`,`ImgCode`,`Describe`,`experience`,`mtime`) values (0,'','','',0,'2017-09-07 18:02:08'),(1,'赠送武器\"破空\"','gun_02_01.png','每日签到双倍 \r\n每日免费领取 \r\n20000金币',30,'2017-07-26 11:52:02'),(2,'赠送武器\"怒雷\"','gun_03_01.png','在线奖励金币翻倍\r\n每日免费领取\r\n30000金币',100,'2017-08-18 10:48:01'),(3,'赠送武器\"灾星\"','gun_04_01.png','锁定时间x2\r\n每日免费领取\r\n40000金币',300,'2017-08-18 10:48:57'),(4,'赠送武器\"厄运\"','gun_05_01.png','捕鱼概率2倍奖励\r\n每日免费领取\r\n70000金币',800,'2017-08-18 10:49:12'),(5,'赠送武器','gun_06_01.png','捕渔券概率x2\r\n每日免费领取\r\n120000金币',2000,'2017-08-18 10:49:32'),(6,'赠送武器\"苍穹\"','gun_07_01.png','捕鱼概率3倍奖励\r\n每日免费领取\r\n250000金币',5000,'2017-08-18 10:49:39'),(7,'赠送武器','gun_08_01.png','捕渔券概率x4\r\n每日免费领取\r\n400000金币',10000,'2017-08-18 10:49:46'),(8,'赠送武器\"冰魄\"','gun_09_01.png','提升打BOSS概率\r\n每日免费领取\r\n650000金币',20000,'2017-08-18 10:49:57'),(9,'赠送武器\"祸忌\"','gun_10_01.png','获得核弹概率x2\r\n每日免费领取\r\n1000000金币',50000,'2017-08-18 10:50:05'),(10,'赠送武器\"魔神\"','gun_11_01.png','提升捕获所有鱼的概率\r\n每日免费领取\r\n1500000金币',100000,'2017-08-18 10:50:12');

/*Table structure for table `jy_vip_reward` */

DROP TABLE IF EXISTS `jy_vip_reward`;

CREATE TABLE `jy_vip_reward` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'vip每日奖励',
  `Level` int(6) DEFAULT NULL COMMENT '等级',
  `GoodsID` int(10) unsigned NOT NULL COMMENT '物品ID',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `Number` bigint(20) unsigned NOT NULL COMMENT '数量',
  `Remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`Id`),
  KEY `GoodsID` (`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `jy_vip_reward` */

insert  into `jy_vip_reward`(`Id`,`Level`,`GoodsID`,`Type`,`Number`,`Remark`,`DateTime`) values (4,1,42,1,20000,'','2017-09-20 20:54:07'),(5,4,42,1,70000,'','2017-09-21 14:20:51'),(6,8,42,1,650000,'','2017-09-22 11:24:00'),(7,2,42,1,30000,'','2017-09-22 11:45:21'),(8,3,42,1,40000,'','2017-09-22 16:12:31'),(9,5,42,1,120000,'','2017-09-22 16:12:49'),(10,6,42,1,250000,'','2017-09-22 16:13:02'),(11,7,42,1,400000,'','2017-09-22 16:13:11'),(12,9,42,1,1000000,'','2017-09-22 16:13:29'),(13,10,42,1,1500000,'','2017-09-22 16:13:39');

/*Table structure for table `jy_vip_reward_log` */

DROP TABLE IF EXISTS `jy_vip_reward_log`;

CREATE TABLE `jy_vip_reward_log` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'vip 每日奖励领取记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `Level` int(4) unsigned NOT NULL COMMENT '等级',
  `GetNum` bigint(20) unsigned NOT NULL COMMENT '数量',
  `Number` int(11) NOT NULL COMMENT '倍数',
  `Type` tinyint(1) NOT NULL COMMENT '类型',
  `Channel` varchar(50) NOT NULL COMMENT '渠道',
  `GoodsID` int(11) NOT NULL COMMENT '物品ID',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '领取时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`DateTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_vip_reward_log` */

/*Table structure for table `test` */

DROP TABLE IF EXISTS `test`;

CREATE TABLE `test` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `test` */

insert  into `test`(`Id`,`Title`,`DateTime`) values (1,'aaa','2017-09-22 11:14:35'),(2,'aaa','2017-09-22 11:14:45'),(3,'aaa','2017-09-22 12:09:46');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
