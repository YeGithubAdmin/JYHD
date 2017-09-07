/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.19-0ubuntu0.16.04.1 : Database - jyhd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jyhd` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `jyhd`;

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

insert  into `account`(`playerid`,`account_type`,`os_type`,`mac`,`imei`,`imsi`,`uuid`,`mobile`,`accountstate`,`regtime`,`lasttime`,`block_desc`,`loginip`,`reg_channel`,`login_channel`,`phone_model`,`phone_os_ver`,`game_ver`,`icon_url`,`communiid`,`account_name`,`pwd`,`logout_time`) values (246192,1,2,'mac_win2011','imei_win16078','imsi_win3838','',0,1,'2017-08-24 19:42:56','2017-08-24 19:42:56','','','','','','','','1',0,'','','2017-08-24 19:46:35'),(246193,1,2,'mac_win36245','imei_win99857','imsi_win71437','',0,1,'2017-08-24 19:46:38','2017-08-24 19:46:38','','','','','','','','1',0,'','','2017-08-24 19:48:56'),(246194,1,2,'mac_win15686','imei_win89205','imsi_win62907','',0,1,'2017-08-24 19:48:58','2017-08-24 19:48:58','','','','','','','','1',0,'','','2017-08-24 19:59:02'),(246195,1,2,'mac_win74678','imei_win94852','imsi_win36035','',0,1,'2017-08-25 10:57:27','2017-08-25 10:57:27','','','','','','','','1',0,'','','2017-08-25 10:57:56'),(246196,1,2,'mac_win39994','imei_win1529','imsi_win71239','',0,1,'2017-08-25 11:35:34','2017-08-25 11:35:34','','','','','','','','1',0,'','','2017-08-25 12:24:21'),(246197,1,2,'mac_win17812','imei_win21791','imsi_win62984','',0,1,'2017-08-25 12:18:19','2017-08-25 12:18:19','','','','','','','','3',0,'','','2017-08-25 12:26:52'),(246198,1,2,'mac_win1787','imei_win87263','imsi_win55828','',0,1,'2017-08-25 12:24:22','2017-08-25 12:24:22','','','','','','','','1',0,'','','2017-08-25 12:24:59'),(246199,1,2,'mac_win94403','imei_win59392','imsi_win44401','',0,1,'2017-08-25 12:25:01','2017-08-25 12:25:01','','','','','','','','1',0,'','','2017-08-25 12:25:29'),(246200,1,2,'mac_win55302','imei_win49553','imsi_win47842','',0,3,'2017-08-25 12:25:32','2017-08-25 12:25:32','','','','','','','','1',-131,'','',''),(246201,1,2,'mac_win42497','imei_win62658','imsi_win22210','',0,1,'2017-08-25 12:26:44','2017-08-25 12:26:44','','','','','','','','1',0,'','','2017-08-25 13:23:37'),(246202,1,2,'mac_win59408','imei_win1606','imsi_win51505','',0,1,'2017-08-25 12:26:54','2017-08-25 12:26:54','','','','','','','','1',0,'','','2017-08-25 14:11:24'),(246203,1,2,'mac_win74814','imei_win84537','imsi_win25660','',0,1,'2017-08-25 14:12:39','2017-08-25 14:12:39','','','','','','','','1',0,'','','2017-08-25 14:13:00'),(246204,1,2,'mac_win18988','imei_win84823','imsi_win41114','',0,1,'2017-08-25 14:13:10','2017-08-25 14:13:10','','','','','','','','1',0,'','','2017-08-25 14:13:13'),(246205,1,2,'mac_win61426','imei_win80971','imsi_win7130','',0,3,'2017-08-25 14:32:08','2017-08-25 14:32:08','','','','','','','','1',-139,'','','');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `jy_activity_father_list` */

insert  into `jy_activity_father_list`(`Id`,`Code`,`Type`,`Title`,`AddUpStartTime`,`AddUpEndTime`,`ShowStartTime`,`ShowEndTime`,`Describe`,`DateTime`) values (5,'1001',1,'累计充值','2017-08-11 11:00:00','2017-09-29 11:00:00','2017-08-10 11:00:00','2017-10-29 11:00:00','aaaaaaaaaaaaaaaaaaaaaa','2017-08-13 20:05:35'),(6,'1002',2,'单笔充值','2017-08-14 11:00:00','2017-08-30 11:00:00','2017-08-12 11:00:00','2017-09-30 11:00:00','','2017-08-13 20:06:18');

/*Table structure for table `jy_activity_son_list` */

DROP TABLE IF EXISTS `jy_activity_son_list`;

CREATE TABLE `jy_activity_son_list` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动子表',
  `FatherID` int(11) unsigned NOT NULL COMMENT '活动父ID',
  `GoodsID` int(11) NOT NULL COMMENT '奖励商品',
  `Title` varchar(50) NOT NULL COMMENT '标题',
  `Number` int(11) NOT NULL COMMENT '奖品数量',
  `Schedule` int(11) NOT NULL COMMENT '条件',
  `ImgCode` int(11) unsigned NOT NULL COMMENT '图片标识',
  `ImgUrl` varchar(255) NOT NULL COMMENT '活动图片',
  `Code` varchar(20) NOT NULL COMMENT '活动标识',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `FatherID` (`FatherID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `jy_activity_son_list` */

insert  into `jy_activity_son_list`(`Id`,`FatherID`,`GoodsID`,`Title`,`Number`,`Schedule`,`ImgCode`,`ImgUrl`,`Code`,`DateTime`) values (3,5,33,'累积充值50元',15,50,0,'Uploads/image/2017/08/14/d19631d5c4f5d74141b185c979fcf2bc.jpg','112','2017-08-14 01:29:17'),(5,6,8,'单笔1',321,200,0,'Uploads/image/2017/08/15/769cba07612fc395cc4836b8228f2174.jpg','eeqwe','2017-08-14 18:54:45'),(6,5,8,'累计2',312,300,0,'Uploads/image/2017/08/15/cf12e6f529cea0837305a481cbb9ce8d.jpg','3123','2017-08-14 20:59:18'),(7,6,10,'单笔2',32121,300,0,'Uploads/image/2017/08/15/07b11bc75b486c7f9de69784687d0b25.jpg','321321','2017-08-14 21:00:16'),(8,7,9,'循环1',3321,30,0,'Uploads/image/2017/08/15/3f1ef0ccffc3513c47d72b992561a045.jpg','312321','2017-08-14 21:01:24'),(9,7,10,'循环2',321,100,0,'Uploads/image/2017/08/15/0ecd4e3960ab489440ac8195a8b0698d.jpg','312321','2017-08-14 21:02:07'),(10,8,9,'图片1',3213,100,0,'Uploads/image/2017/08/31/2e09eb94307e4657691c845a80a55387.jpg','dsa','2017-08-14 21:02:35');

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

insert  into `jy_admin_group`(`id`,`name`,`authority`,`upid`,`addId`,`addName`,`islock`,`add`,`DesktopAddress`,`channel`,`edit`,`del`,`isdel`,`remark`,`mtime`) values (1,'超级管理员','',0,1,'测试',1,2,'',1,2,2,1,'','2017-08-29 19:11:17'),(6,'渠道','[\"5\",\"7\"]',1,1,'测试',1,1,'###',1,1,1,1,'','2017-07-11 15:09:01'),(14,'游戏调试','[\"42\",\"59\",\"57\"]',1,1,'测试',1,2,'/jy_admin/UsersAttribute/index',1,2,2,1,'','2017-09-01 02:18:46');

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
  KEY `account` (`account`,`channel`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `jy_admin_users` */

insert  into `jy_admin_users`(`id`,`name`,`account`,`passwd`,`admingroup`,`default`,`channel`,`addName`,`addId`,`islock`,`isdel`,`remark`,`mtime`) values (1,'测试','admin','21232f297a57a5a743894a0e4a801fc3',0,2,1,'',0,1,1,'','2017-07-10 17:28:22'),(5,'倒霉小姐','18899753856','e10adc3949ba59abbe56e057f20f883e',6,1,2,'test',3,1,1,'321','2017-07-11 15:52:35'),(9,'游戏调试','jyhd@163.com','e10adc3949ba59abbe56e057f20f883e',14,1,1,'测试',1,1,1,'','2017-08-29 19:13:03'),(10,'渠道测试','13724894160','e10adc3949ba59abbe56e057f20f883e',6,1,2,'测试',1,1,1,'','2017-08-29 20:21:34');

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
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

/*Data for the table `jy_api_visit_log` */

insert  into `jy_api_visit_log`(`Id`,`Name`,`Url`,`Code`,`Msg`,`TimeOut`,`AccessIP`,`DataTime`) values (85,'支付订单','/Jy_ThirdpayIapppay/MallShopBack/index',5001,'订单不存在','','192.168.0.116','2017-09-06 01:24:43'),(84,'支付订单','/Jy_ThirdpayIapppay/MallShopBack/index',5001,'订单不存在','','192.168.0.116','2017-09-06 01:24:26'),(83,'支付订单','/Jy_ThirdpayIapppay/MallShopBack/index',5001,'订单不存在','','192.168.0.116','2017-09-06 01:23:24');

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
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8;

/*Data for the table `jy_channel_goods` */

insert  into `jy_channel_goods`(`id`,`adminUserID`,`goodsID`,`DateTime`) values (54,3,0,'2017-07-31 00:39:58'),(61,3,3,'2017-07-31 00:42:44'),(65,3,0,'2017-07-31 00:45:29'),(66,3,0,'2017-07-31 00:45:29'),(69,3,0,'2017-07-31 00:49:38'),(70,3,5,'2017-07-31 00:49:38'),(71,3,0,'2017-07-31 00:49:40'),(72,3,0,'2017-07-31 00:49:40'),(73,3,6,'2017-07-31 00:49:40'),(74,3,0,'2017-07-31 00:49:51'),(75,3,0,'2017-07-31 00:49:51'),(76,3,0,'2017-07-31 00:49:51'),(78,5,0,'2017-07-31 00:51:20'),(79,5,5,'2017-07-31 00:51:20'),(80,5,6,'2017-07-31 00:51:20'),(81,5,7,'2017-07-31 00:51:20'),(82,3,7,'2017-08-01 04:53:55'),(83,3,8,'2017-08-11 02:41:09'),(84,3,9,'2017-08-11 02:41:09'),(85,3,10,'2017-08-11 02:41:09'),(86,3,11,'2017-08-11 02:41:09'),(87,3,12,'2017-08-11 02:41:09'),(88,3,13,'2017-08-11 02:41:09'),(89,3,14,'2017-08-11 02:41:09'),(90,3,15,'2017-08-11 02:41:09'),(91,3,16,'2017-08-11 02:41:09'),(92,3,17,'2017-08-11 02:41:09'),(93,5,8,'2017-08-11 02:41:26'),(94,5,9,'2017-08-11 02:41:26'),(95,5,10,'2017-08-11 02:41:26'),(96,5,11,'2017-08-11 02:41:26'),(97,5,12,'2017-08-11 02:41:26'),(98,5,13,'2017-08-11 02:41:26'),(99,5,14,'2017-08-11 02:41:26'),(100,5,15,'2017-08-11 02:41:26'),(101,5,16,'2017-08-11 02:41:26'),(102,5,17,'2017-08-11 02:41:26'),(103,3,0,'2017-08-25 03:33:44'),(104,3,0,'2017-08-25 03:33:44'),(105,3,0,'2017-08-25 03:33:44'),(106,3,0,'2017-08-25 03:33:44'),(107,3,0,'2017-08-25 03:33:44'),(108,3,0,'2017-08-25 03:33:44'),(109,3,0,'2017-08-25 03:33:44'),(110,3,0,'2017-08-25 03:33:44'),(111,3,0,'2017-08-25 03:33:44'),(112,3,0,'2017-08-25 03:33:44'),(113,3,18,'2017-08-25 03:33:44'),(114,3,19,'2017-08-25 03:33:44'),(115,3,20,'2017-08-25 03:33:44'),(116,3,23,'2017-08-25 03:33:44'),(117,3,24,'2017-08-25 03:33:44'),(118,3,25,'2017-08-25 03:33:44'),(119,3,26,'2017-08-25 03:33:44'),(120,3,27,'2017-08-25 03:33:44'),(121,3,28,'2017-08-25 03:33:44'),(122,3,29,'2017-08-25 03:33:44'),(123,3,30,'2017-08-25 03:33:44'),(124,3,31,'2017-08-25 03:33:44'),(125,3,32,'2017-08-25 03:33:44'),(126,10,8,'2017-08-29 20:24:53'),(127,10,9,'2017-08-29 20:24:53'),(128,10,10,'2017-08-29 20:24:53'),(129,10,11,'2017-08-29 20:24:53'),(130,10,12,'2017-08-29 20:24:53'),(131,10,13,'2017-08-29 20:24:53'),(132,10,14,'2017-08-29 20:24:53'),(133,10,15,'2017-08-29 20:24:53'),(134,10,16,'2017-08-29 20:24:53'),(135,10,17,'2017-08-29 20:24:53'),(136,10,18,'2017-08-29 20:24:53'),(137,10,19,'2017-08-29 20:24:53'),(138,10,20,'2017-08-29 20:24:53'),(139,10,23,'2017-08-29 20:24:53'),(140,10,24,'2017-08-29 20:24:53'),(141,10,25,'2017-08-29 20:24:53'),(142,10,26,'2017-08-29 20:24:53'),(143,10,27,'2017-08-29 20:24:53'),(144,10,28,'2017-08-29 20:24:53'),(145,10,29,'2017-08-29 20:24:53'),(146,10,30,'2017-08-29 20:24:53'),(147,10,31,'2017-08-29 20:24:53'),(148,10,32,'2017-08-29 20:24:53'),(149,10,33,'2017-08-29 20:24:53'),(150,10,34,'2017-08-29 20:24:53'),(151,10,0,'2017-08-30 04:20:17'),(152,10,0,'2017-08-30 04:20:17'),(153,10,0,'2017-08-30 04:20:17'),(154,10,0,'2017-08-30 04:20:17'),(155,10,0,'2017-08-30 04:20:17'),(156,10,0,'2017-08-30 04:20:17'),(157,10,0,'2017-08-30 04:20:17'),(158,10,0,'2017-08-30 04:20:17'),(159,10,0,'2017-08-30 04:20:17'),(160,10,0,'2017-08-30 04:20:17'),(161,10,0,'2017-08-30 04:20:17'),(162,10,0,'2017-08-30 04:20:17'),(163,10,0,'2017-08-30 04:20:17'),(164,10,0,'2017-08-30 04:20:17'),(165,10,0,'2017-08-30 04:20:17'),(166,10,0,'2017-08-30 04:20:17'),(167,10,0,'2017-08-30 04:20:17'),(168,10,0,'2017-08-30 04:20:17'),(169,10,0,'2017-08-30 04:20:17'),(170,10,0,'2017-08-30 04:20:17'),(171,10,0,'2017-08-30 04:20:17'),(172,10,0,'2017-08-30 04:20:17'),(173,10,0,'2017-08-30 04:20:17'),(174,10,0,'2017-08-30 04:20:17'),(175,10,0,'2017-08-30 04:20:17'),(176,10,0,'2017-08-30 04:20:17'),(177,10,0,'2017-08-30 04:20:17'),(178,10,38,'2017-08-30 04:20:17'),(179,10,39,'2017-08-30 04:20:17');

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

insert  into `jy_channel_info`(`adminUserID`,`platform`,`pattern`,`DividedInto`,`RegisterNum`,`RechargeNum`,`CorporateName`,`CompanyAddress`,`CompanyPhone`,`contacts`,`ContactNumber`,`ContactMailbox`,`addName`,`addId`,`isown`,`remark`,`mtime`) values (3,2,1,'','','','dasdas','dsadsa','dasdsa','dsa','dasdsa','dsadas','1',1,1,'','2017-07-25 11:44:18'),(5,1,1,'','','','dsad','dsadsa','dasds','dsad','dsa','dsad','1',1,1,'dasdas','2017-07-25 11:49:36'),(10,2,1,'','','','321312','321','32132','32132','32321','321321','测试',1,1,'321','2017-08-29 20:24:42');

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `jy_channel_thirdpay` */

insert  into `jy_channel_thirdpay`(`id`,`adminUserID`,`PayID`,`DateTime`) values (3,3,4,'2017-08-01 04:32:10'),(5,5,4,'2017-08-01 04:34:09'),(6,3,6,'2017-08-23 23:27:24'),(7,10,6,'2017-09-06 01:01:49');

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

/*Data for the table `jy_goods_all` */

insert  into `jy_goods_all`(`Id`,`Name`,`Code`,`ImgCode`,`CurrencyType`,`CurrencyNum`,`IssueNum`,`IssueType`,`Type`,`CateGory`,`GetNum`,`GiveInfo`,`ShowType`,`IsGroom`,`TheShelvesTime`,`Status`,`Platform`,`Proportion`,`FaceValue`,`LimitShop`,`LimitShopNum`,`ExchangeType`,`ExchangeNum`,`Describe`,`Broadcast`,`Push`,`Rmark`,`LimitLevel`,`LimitVip`,`Sort`,`IsDel`,`UpTime`,`DateTime`) values (3,'金币','32132','',1,'321312',0,1,1,1,1231,'',1,0,NULL,1,1,0,NULL,1,0,1,0,'','ewqeqw','ewqeqw','ewqewq',0,0,1501136621,2,'2017-08-08 21:32:49','2017-07-26 23:23:41'),(4,'道具','','',1,'1231',0,1,2,1,321321,'',1,0,NULL,3,1,0,NULL,2,32132,2,321312,'','ewqeqw','ewqeqw','ewqeqw',2,2,1501136698,2,'2017-07-27 23:28:14','2017-07-26 23:24:58'),(5,'砖石','123','',1,'321312',0,1,1,1,321312,'{\"0\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"312312\"},\"2\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"3123321\"},\"3\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"1232132\"},\"4\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"321312\"},\"5\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"312312321\"},\"6\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"3213312\"},\"7\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"3123132\"},\"8\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"312321\"}}',1,0,NULL,3,1,12,NULL,4,321312,3,321,'','321312','312312','312312',2,2,1501140444,2,'2017-08-10 20:46:28','2017-07-27 00:27:24'),(6,'测试','321312','',1,'321312',0,1,2,1,321312,'{\"0\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"312312\"},\"2\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"3123321\"},\"3\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"1232132\"},\"4\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"321312\"},\"5\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"312312321\"},\"6\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"3213312\"},\"7\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"3123132\"},\"8\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"312321\"}}',1,0,NULL,3,1,0,NULL,4,321312,3,321,'','321312','312312','312312',2,2,1501140448,2,'2017-08-10 20:46:26','2017-07-27 00:27:28'),(7,'测试1','1','',3,'321312',233,2,1,2,321312,'[{\"Type\":\"1\",\"Id\":\"7\",\"GetNum\":\"1\"}]',1,0,NULL,1,1,0,NULL,4,321312,3,321,'1','1','1','1',2,2,1501140449,2,'2017-08-10 20:51:59','2017-07-27 00:27:29'),(8,'60000金币','60000','',1,'6',0,1,1,1,60000,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423245,1,'2017-08-30 14:18:36','2017-08-10 20:47:25'),(9,'30万金币','300000','',1,'30',0,1,1,1,300000,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423302,1,'2017-08-30 14:19:37','2017-08-10 20:48:22'),(10,'68万金币','680000','',1,'68',0,1,1,1,680000,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423353,1,'2017-08-30 14:20:17','2017-08-10 20:49:13'),(11,'168万金币','1680000','',1,'168',0,1,1,1,1680000,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423392,1,'2017-08-30 14:20:46','2017-08-10 20:49:52'),(12,'328万金币','3280000','',1,'328',0,1,1,1,3280000,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423439,1,'2017-08-30 14:21:33','2017-08-10 20:50:39'),(13,'648万金币','6480000','',1,'648',0,1,1,1,6480000,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423498,1,'2017-08-30 14:22:14','2017-08-10 20:51:38'),(14,'60钻石','60','321',1,'6',0,1,2,2,60,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423611,1,'2017-08-30 14:23:05','2017-08-10 20:53:31'),(15,'300钻石','300','321',1,'30',0,1,2,2,300,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423637,1,'2017-08-30 14:26:37','2017-08-10 20:53:57'),(16,'680钻石','680','321',1,'68',0,1,2,2,680,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423719,1,'2017-08-30 14:26:13','2017-08-10 20:55:19'),(17,'1680钻石','1680','321',1,'168',0,1,2,2,1680,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423790,1,'2017-08-30 14:27:05','2017-08-10 20:56:30'),(18,'自动发炮','1004','gun_06_01.png',1,'1',0,1,0,0,1,'',0,0,'1970-01-01',1,1,0,NULL,1,0,1,0,'','','','',0,0,1502856196,1,'2017-08-30 16:10:41','2017-08-15 21:03:16'),(19,'捕渔券概率提升','1005','card_big.png',1,'0',0,1,0,0,1,'',0,0,'1970-01-01',1,1,0,NULL,1,0,1,0,'','','','',0,0,1502856414,1,'2017-08-30 16:09:59','2017-08-15 21:06:54'),(20,'3280钻石','3280','321',1,'328',0,1,2,2,3280,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502856830,1,'2017-08-30 14:28:20','2017-08-15 21:13:50'),(21,'锁定','道具','',1,'1',0,1,3,3,1,'',1,0,NULL,1,1,0,NULL,1,0,1,0,'','','','',0,0,1502857047,2,'2017-08-15 21:17:51','2017-08-15 21:17:27'),(22,'锁定','1002','',1,'1',0,1,3,0,1,'',1,0,NULL,1,1,0,NULL,1,0,1,0,'','','','',0,0,1502857127,2,'2017-08-15 21:18:58','2017-08-15 21:18:47'),(23,'6480钻石','6480','321',1,'648',0,1,2,2,6480,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502866288,1,'2017-08-30 14:29:05','2017-08-15 23:51:28'),(24,'首冲礼包','1002','',1,'6',0,1,1,4,1,'{\"0\":{\"Type\":\"1\",\"Id\":\"23\",\"GetNum\":\"666666\"},\"2\":{\"Type\":\"2\",\"Id\":\"20\",\"GetNum\":\"10\"}}',2,0,NULL,1,1,0,NULL,5,0,1,0,'首冲礼包','','','',0,0,1502866444,1,'2015-03-04 20:05:00','2017-08-15 23:54:04'),(25,'月卡','2312','',1,'30',0,1,0,4,1,'{\"0\":{\"Type\":\"0\",\"Id\":\"18\",\"GetNum\":\"1\"},\"2\":{\"Type\":\"2\",\"Id\":\"19\",\"GetNum\":\"1\"},\"3\":{\"Type\":\"1\",\"Id\":\"36\",\"GetNum\":\"1\"},\"4\":{\"Type\":\"2\",\"Id\":\"37\",\"GetNum\":\"1\"},\"5\":{\"Type\":\"2\",\"Id\":\"27\",\"GetNum\":\"3\"},\"6\":{\"Type\":\"2\",\"Id\":\"26\",\"GetNum\":\"8\"}}',3,0,'1970-01-01',1,1,0,NULL,4,0,1,0,'','','','',0,0,1502868263,1,'2017-08-30 15:56:31','2017-08-16 00:24:23'),(26,'锁定*8/天','2','aim.png',1,'1',0,1,3,3,8,'',1,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1502868358,1,'2017-08-31 20:58:48','2017-08-16 00:25:58'),(27,'冰冻*3/天','1','ice.png',1,'1',0,1,3,3,3,'',1,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1502868462,1,'2017-08-31 20:58:57','2017-08-16 00:27:42'),(28,'10万金币','3123','coin.png',4,'1000',0,1,1,1,100000,'',4,0,'1970-01-01',1,1,0,NULL,1,0,1,0,'','','','',0,0,1503649795,1,'2017-08-30 18:22:38','2017-08-25 01:29:55'),(29,'30万金币','321312','coin.png',4,'3000',0,1,2,2,300000,'',4,0,'1970-01-01',1,1,0,NULL,1,0,1,0,'','','','',0,0,1503650087,1,'2017-08-30 18:22:08','2017-08-25 01:34:47'),(30,'青铜核弹','3','btnt1.png',4,'2500',0,1,3,3,1,'',4,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1503650132,1,'2017-08-31 20:57:57','2017-08-25 01:35:32'),(31,'白银核弹','4','btnt2.png',4,'12500',0,1,3,3,1,'',4,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1503652777,1,'2017-08-31 20:58:03','2017-08-25 02:19:37'),(32,'50元话费','321321','hf50.png',4,'5000',0,1,0,0,1,'',4,0,'1970-01-01',1,1,0,NULL,1,0,1,0,'','','','',0,0,1503652851,1,'2017-08-30 18:27:56','2017-08-25 02:20:51'),(33,'100元话费','321321','hf100.png',4,'10000',0,1,0,0,1,'',4,0,'1970-01-01',1,1,0,NULL,1,0,1,0,'','','','',0,0,1503657738,1,'2017-08-30 18:28:40','2017-08-25 03:42:18'),(34,'3211111','312111','32111',1,'312',0,1,1,1,312,'',0,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1503914276,2,'2017-08-28 02:58:27','2017-08-28 02:58:27'),(35,'渔券','6','card_big.png',0,'0',0,1,3,0,1,'',0,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1504065287,1,'2017-08-30 16:09:01','2017-08-29 20:54:47'),(36,'50000金币/天','50000','gold_2.png',1,'0',0,1,1,0,50000,'',3,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1504079662,1,'2017-08-30 16:08:35','2017-08-30 00:54:22'),(37,'30钻石/天','30','diamond3.png',1,'0',0,1,2,0,30,'',3,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1504079771,1,'2017-08-30 16:08:05','2017-08-30 00:56:11'),(38,'300元京东卡','66666','jd300.png',4,'30000',0,1,5,3,1,'',4,0,'',1,1,0,'300',1,0,1,0,'','','','',0,0,1504089051,1,'2017-09-01 18:55:12','2017-08-30 03:30:51'),(39,'500元京东卡','77777','jd500.png',4,'50000',0,1,5,1,1,'',4,0,'',1,1,0,'500',1,0,1,0,'','','','',0,0,1504089105,1,'2017-09-01 18:55:31','2017-08-30 03:31:45'),(40,'50元话费卡','312321','321321',4,'50',0,1,4,0,1,'',4,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1504090689,1,'2017-08-30 03:58:41','2017-08-30 03:58:41'),(41,'10000金币','8888','coin.png',0,'0',0,1,1,1,10000,'',0,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1504147778,1,'2017-08-30 19:49:38','2017-08-30 19:49:38');

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
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `jy_register_macrodata` */

insert  into `jy_register_macrodata`(`Id`,`UserNum`,`UserGame`,`UserPayNum`,`PayNum`,`PayMoney`,`BankruptcyNum`,`DateTime`) values (1,312,321312,321321,312,321,312,'2017-09-06 19:22:09');

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

insert  into `jy_seven_days_sign`(`Id`,`IsExceed`,`Day`,`GoodsID`,`Type`,`Number`,`ImgCode`,`DateTime`) values (1,1,1,41,1,1,'coin.png','2017-08-02 23:53:08'),(21,1,7,35,3,150,'card_big.png','2017-08-28 01:55:40'),(3,1,3,35,3,150,'card_big.png','2017-08-02 23:53:23'),(4,1,4,41,1,1,'coin.png','2017-08-02 23:53:32'),(11,1,5,41,1,1,'coin.png','2017-08-03 04:21:40'),(6,1,6,41,1,1,'coin.png','2017-08-02 23:53:55'),(13,1,2,41,1,1,'coin.png','2017-08-07 05:01:04'),(25,2,7,41,1,1,'coin.png','2017-08-28 02:11:04'),(18,2,5,41,1,1,'coin.png','2017-08-09 23:57:10'),(24,2,6,41,1,1,'coin.png','2017-08-28 02:10:02'),(27,2,1,41,1,1,'coin.png','2017-08-29 21:26:34'),(28,2,3,41,1,1,'coin.png','2017-08-29 21:26:45'),(29,2,2,41,1,1,'coin.png','2017-08-29 21:30:22'),(30,2,4,41,1,1,'coin.png','2017-08-29 21:30:33');

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
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

/*Data for the table `jy_system_menu` */

insert  into `jy_system_menu`(`id`,`name`,`icon`,`url`,`sort`,`islock`,`upid`,`remark`,`mtime`) values (1,'系统管理','','###',0,1,0,'','2017-07-11 17:19:33'),(2,'菜单列表','','/jy_admin/menu/index',1,1,1,'','2017-07-10 19:21:22'),(3,'管理员','','/jy_admin/AdminUsers/index',2,1,1,'','2017-07-10 19:24:37'),(4,'管理员组','','/jy_admin/admingroup/index',3,1,1,'','2017-07-10 19:25:13'),(5,'渠道管理','','###',1,1,0,'','2017-07-11 17:19:46'),(6,'渠道列表','','/jy_admin/Channel/index',0,1,5,'','2017-07-10 19:32:45'),(7,'渠道数据','','###',0,1,5,'','2017-07-10 19:26:28'),(9,'全局数据','','###',3,1,0,'','2017-07-11 17:20:20'),(10,'全局数据','','/jy_admin/GlobalData/index',1,1,9,'','2017-07-11 18:22:13'),(14,'注册分析','','###',4,1,0,'','2017-07-11 17:07:06'),(15,'宏观数据','','/jy_admin/RegisterMacroscopic/index',0,1,14,'','2017-07-14 10:06:32'),(20,'渠道分布','','渠道分布',6,1,14,'','2017-07-11 17:10:14'),(21,'活跃分析','','###',5,1,0,'','2017-07-11 17:12:36'),(22,'宏观数据','','/jy_admin/ActiveMacroscopic/index',1,1,21,'','2017-07-17 16:33:13'),(23,'等级分布','','/jy_admin/ActiveLevel/index',2,1,21,'','2017-07-18 10:46:26'),(24,'版本分布','','/jy_admin/ActiveEdition/index',3,1,21,'','2017-07-18 11:22:07'),(25,'渠道分布','','###',4,1,21,'','2017-07-11 17:17:11'),(26,'道具分布','','###',5,1,21,'','2017-07-11 17:17:27'),(27,'实时数据','','###',6,1,0,'','2017-07-11 17:18:34'),(28,'实时概况','','###',1,1,27,'','2017-07-11 17:18:55'),(29,'实时在线','','###',2,1,27,'','2017-07-11 17:21:44'),(30,'实时收入','','###',0,1,27,'','2017-07-11 17:22:05'),(31,'留存分析','','###',6,1,0,'','2017-07-11 17:22:54'),(32,'留存数据','','/jy_admin/RetainedData/index',0,1,31,'','2017-07-19 18:02:31'),(33,'流失数据','','###',1,1,31,'','2017-07-11 17:24:09'),(34,'回流数据','','###',2,1,31,'','2017-07-19 17:37:43'),(35,'付费分析','','###',7,1,0,'','2017-07-11 17:26:06'),(36,'宏观数据','','/jy_admin/PayMacroscopic/index',0,1,35,'','2017-07-24 16:42:04'),(37,'货币流水','','###',8,1,0,'','2017-07-11 17:29:30'),(38,'金币流水','','###',0,1,37,'','2017-07-11 17:27:28'),(39,'钻石流水','','###',1,1,37,'','2017-07-11 17:27:59'),(40,'道具流水','','###',2,1,37,'','2017-07-11 17:28:15'),(41,'场次数据','','###',8,1,0,'','2017-07-11 17:28:31'),(42,'用户中心','###','###',2,1,0,'','2017-07-11 17:52:45'),(43,'用户列表','','/jy_admin/UsersInfo/index',1,1,42,'','2017-08-29 05:52:52'),(44,'金币分布','','/jy_admin/ActiveGold/index',2,1,21,'','2017-07-19 12:07:07'),(45,'钻石分布','','/jy_admin/ActiveDiamond/index',3,1,21,'','2017-07-19 17:14:53'),(46,'大厅配置','','####',3,1,0,'','2017-07-25 15:36:59'),(47,'商品列表','','/jy_admin/GoodsAll/index',0,1,46,'','2017-07-26 01:04:55'),(48,'七天签到（前四周）','','/jy_admin/SevenDaysSign/index',1,1,46,'','2017-08-09 23:40:48'),(49,'活动列表','','/jy_admin/activityList/index',3,1,46,'','2017-08-11 00:04:06'),(50,'vip等级','','/jy_admin/VipInfo/index',1,1,42,'','2017-07-25 19:08:24'),(59,'发送邮件','','/jy_admin/SendEmail/index',0,1,42,'','2017-08-31 23:27:31'),(52,'支付管理','','###',3,1,0,'','2017-07-25 15:51:29'),(53,'支付配置','','/jy_admin/ThirdpayInfo/index',0,1,52,'','2017-07-31 03:12:01'),(54,'所有订单','###','/jy_admin/UsersOrder/index',4,1,42,'','2017-08-02 01:43:15'),(55,'七天签到（后四周）','','/jy_admin/SevenDaysSignReward/index',2,1,46,'','2017-08-28 02:02:00'),(57,'用户属性','###','/jy_admin/UsersAttribute/index',1,1,42,'','2017-08-28 04:13:56'),(58,'兑换申请','','/jy_admin/UsersExchangeApplication/index',2,1,42,'','2017-08-30 19:13:52');

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `jy_thirdpay` */

insert  into `jy_thirdpay`(`Id`,`Name`,`Type`,`Platform`,`PassAgeWay`,`Recommend`,`public`,`private`,`appid`,`partner`,`account`,`Sort`,`Notifyurl`,`Describe`,`Support`,`VersionStart`,`VersionEnd`,`IsDel`,`DateTime`) values (6,'爱贝',3,2,'iappay',1,'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDtv7IzXBGp486UAFwaLIXsSua8JiTSe5kSKU6IXNiJxZIMZ/2dlKOV66hFIQjP/0u8YV9Du+uk8/3nmTMhdBpanzp9awkXnO2g104ng9x34YxoDMMv24MmOhT7c2mnhCuEyFbz/KkvnhzQn6L+MAwYvkkQInpw/ArHDJ0NkbyJNQIDAQAB','MIICXAIBAAKBgQCR/ZyLQ7Z2pCv8sZcNuqDcgEoEhPQPOT9Ci8l43mIBhjbSCIPuDPiiZJJ9HjaMpy+X1cUZP1SY9TtZDzA3R5pAWd1HY+Ps/Q8aDiRou2mNESlWor5/xmG8TcQcWLshS3VzHWz4cY7i8o+EIACfHbDTSTkqTxCIyjw1BYxGTyqLVwIDAQABAoGAGDGseNPu8DiC5azUuLy+HezQ13DlNYSqPDAIYpSQL2p7uVEZ9CCIL/l04XFZXvPyCjquIGIDdhnmDPtcZTzjjhfltp6N3Uqmtp4D2cPWruR6B2icvve2bno2Lu6OULuAYyEkVMHCdEf5GSSHjShIG6CBahHfHZhWzjoPYZWAZ9ECQQDd/NGvmzcLVHOXM4muml6leF9OmQNqA+qVec9Sqb39t2CNJY4QxdJ/AzQnLeskqVBydQm60P2lbi3M1eCMW+sPAkEAqFvpB1vgkj6dlbySyHGu5mzTiJBRSVvz4c5XAA01iLCNPGdtQGT7jslnkyueXMwdiq3pBDpGuzL9v9QIuw17OQJADv+h+0d1dKKEHNcymkV715pGdj0IagVRuD++rkshtx7Iu0CqVJ/JFSPWRj9n/9YgxVr7CVBNkvvaxFg/D7y2KQJARCqKjG832x69IU5rw/q7jRKNB2MfdmtjsI6iDSRMA58wYD+kLYl1jReg9yaXBQ2j/G1zxkFuOAdqVEweiNXpiQJBAJjblicX+Y7y0EwKfOXP9oU2KjbxGAy5Et5AL+6AdloVbjZAU1o3LYfjuCz+YaU3jPx38FIT1Npe/WWIuTyusZ8=','3015007654','','',1,'321312','',2,'','',1,'2017-08-23 23:20:31'),(7,'321321',1,1,'321321',2,'312321321','1',NULL,'321312','32131232',1,'321111111111111222','',2,'','',1,'2017-08-30 01:34:20'),(8,'3213',2,1,'32321',1,NULL,'312321','321321','323213',NULL,0,'31233333','321312',2,'','',1,'2017-08-30 01:37:42'),(9,'3123',3,1,'321312',1,'321321','312312','312321',NULL,NULL,2,'31231232','31232',2,'','',2,'2017-08-30 01:39:29'),(10,'ce111',1,2,'3213',1,'321312','321321',NULL,'312','321',312,'312312','3123',2,'','',2,'2017-09-06 02:29:16'),(11,'eqweqw',2,1,'3123',1,NULL,'321321','321','321',NULL,1,'321321','32132',2,'','',2,'2017-09-06 02:29:42'),(12,'1111',3,1,'2321',1,'321312','321321','321321',NULL,NULL,1,'321321','321',2,'','',2,'2017-09-06 02:30:07');

/*Table structure for table `jy_users_activity_theaward_log` */

DROP TABLE IF EXISTS `jy_users_activity_theaward_log`;

CREATE TABLE `jy_users_activity_theaward_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户领奖记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned NOT NULL COMMENT '物品ID',
  `GoodsName` varchar(50) NOT NULL COMMENT '物品名',
  `activityID` int(11) unsigned NOT NULL COMMENT '活动ID',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '活动类型',
  `Number` int(11) unsigned NOT NULL COMMENT '获得数量',
  `AddUpStartTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '计费开始时间',
  `AddUpEndTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '计费结束时间',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '领取时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`AddUpStartTime`,`AddUpEndTime`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_activity_theaward_log` */

insert  into `jy_users_activity_theaward_log`(`Id`,`playerid`,`GoodsID`,`GoodsName`,`activityID`,`Type`,`Number`,`AddUpStartTime`,`AddUpEndTime`,`DateTime`) values (3,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 05:43:30'),(4,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 05:43:35'),(5,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 05:43:37'),(6,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 05:43:52'),(7,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 05:43:54'),(8,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 05:44:00'),(9,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 05:44:16'),(10,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 05:44:21'),(11,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 05:44:24'),(12,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 05:50:29'),(13,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 05:52:16'),(14,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 05:53:08'),(15,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 06:01:39'),(16,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 06:03:48'),(17,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 06:03:51'),(18,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 06:04:16'),(19,100006,33,'100元话费',3,1,15,'2017-08-11 11:00:00','2017-09-29 11:00:00','2017-09-04 06:06:23');

/*Table structure for table `jy_users_card_receive_log` */

DROP TABLE IF EXISTS `jy_users_card_receive_log`;

CREATE TABLE `jy_users_card_receive_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '月卡领取奖励',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`DateTime`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_card_receive_log` */

insert  into `jy_users_card_receive_log`(`Id`,`playerid`,`DateTime`) values (10,100006,'2017-09-04 04:44:59'),(9,100006,'2017-09-04 04:44:57'),(8,100006,'2017-09-04 04:44:53'),(7,100006,'2017-09-04 04:38:37'),(6,100006,'2017-09-04 04:37:37'),(11,100006,'2017-09-04 04:44:59'),(12,100006,'2017-09-04 04:45:01'),(13,100006,'2017-09-04 04:51:28'),(14,100006,'2017-09-04 04:52:33');

/*Table structure for table `jy_users_currency_stream` */

DROP TABLE IF EXISTS `jy_users_currency_stream`;

CREATE TABLE `jy_users_currency_stream` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户金币钻石流水',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `Type` tinyint(1) NOT NULL COMMENT '类型 1-游戏 2-充值 3-签到 4-兑换 5-月卡 6-首冲',
  `CurrencyType` tinyint(1) NOT NULL COMMENT '货币类型 1-金币 2-钻石',
  `Income` tinyint(1) NOT NULL COMMENT '1-收入 2-支出',
  `Number` int(20) NOT NULL COMMENT '数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`),
  KEY `DateTime` (`DateTime`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_currency_stream` */

insert  into `jy_users_currency_stream`(`Id`,`playerid`,`Type`,`CurrencyType`,`Income`,`Number`,`DateTime`) values (32,100200,2,1,1,60000,'2017-09-06 01:46:45'),(31,100200,2,1,1,60000,'2017-09-06 01:46:25'),(30,100200,2,1,1,60000,'2017-09-06 01:45:40'),(29,100200,2,1,1,60000,'2017-09-06 01:45:25'),(28,100200,2,1,1,60000,'2017-09-06 01:44:10');

/*Table structure for table `jy_users_exchange_log` */

DROP TABLE IF EXISTS `jy_users_exchange_log`;

CREATE TABLE `jy_users_exchange_log` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户兑换记录',
  `GoodsName` varchar(50) NOT NULL COMMENT '商品名',
  `Number` int(11) unsigned NOT NULL COMMENT '数量',
  `Order` varchar(20) NOT NULL COMMENT '兑换订单号',
  `StockNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '兑换劵',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `Status` tinyint(1) unsigned DEFAULT '2' COMMENT '状态 1-审核中 2-已发放 3-审核不通过',
  `MessAge` text COMMENT '申请失败原因',
  `GoodsID` int(11) unsigned NOT NULL COMMENT '商品ID',
  `UpTime` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '兑换时间',
  PRIMARY KEY (`Id`),
  KEY `DateTimes` (`DateTime`,`Status`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_exchange_log` */

insert  into `jy_users_exchange_log`(`Id`,`GoodsName`,`Number`,`Order`,`StockNum`,`playerid`,`Status`,`MessAge`,`GoodsID`,`UpTime`,`DateTime`) values (1,'312',1,'312',321,100006,1,NULL,40,NULL,'2017-08-27 23:20:58'),(2,'500金币',1,'LCVo5191',321,100171,1,'321大时代时代峰峻含税单价开放还是对接客服华东师大尽快发货dsajk\r\nfdsjfsd\r\ngfdjgkdfl',40,NULL,'2017-08-27 23:47:27'),(3,'500金币',1,'sFbC4007',321,100171,1,'',40,NULL,'2017-08-27 23:47:38'),(4,'500金币',1,'IEJy9934',321,100171,1,'eqwewqewqewqeqwfsdfhklsdajfksdljfsdklfjsdkljfsdklajfsdklfjsdakljfdskljfdklsafjsdlkjkldsahkjdjsak',40,NULL,'2017-08-27 23:47:43'),(5,'500金币',1,'xwqo0383',321,100171,2,'',40,'2017-09-01 11:22:55','2017-08-27 23:47:44'),(6,'500金币',1,'wUgO6879',321,100171,2,'',40,NULL,'2017-08-27 23:47:46'),(7,'500金币',1,'KBis4815',32,100171,3,'fsdafsdhjkfsdhjkfdsa\r\nfsdjhfsdjk\r\ngfjsdhfksd',40,'2017-09-01 11:22:31','2017-08-27 23:47:47'),(8,'500金币',1,'ClhB7552',32,100171,3,'32132132123321',40,NULL,'2017-08-27 23:47:49'),(9,'500金币',1,'YGEZ0959',32,100171,3,NULL,40,NULL,'2017-08-27 23:47:50'),(10,'500金币',1,'qRKz2050',32,100171,2,NULL,40,NULL,'2017-08-27 23:47:52'),(11,'500金币',1,'MVEg7969',32,100171,2,'',40,NULL,'2017-08-27 23:47:53'),(12,'500金币',1,'nipw6378',32,100171,2,NULL,40,NULL,'2017-08-27 23:47:54'),(13,'500金币',1,'bhNV4103',32,100171,2,NULL,40,NULL,'2017-08-27 23:47:55'),(14,'500金币',1,'nqfv3535',32,100171,2,NULL,40,NULL,'2017-08-27 23:47:56'),(15,'500金币',1,'frLS4334',32,100171,2,NULL,40,NULL,'2017-08-27 23:48:00'),(16,'500金币',1,'RDha4533',32,100171,2,NULL,40,NULL,'2017-08-27 23:48:03'),(17,'500金币',1,'xwGT5515',312,100171,2,NULL,40,NULL,'2017-08-27 23:48:05'),(18,'500金币',1,'FBHo4610',321,100171,2,NULL,40,NULL,'2017-08-27 23:48:07'),(19,'500金币',1,'inDi7766',321,100171,2,NULL,40,NULL,'2017-08-27 23:56:23'),(20,'500金币',1,'LjRE9016',321,100171,2,NULL,40,NULL,'2017-08-27 23:56:29'),(21,'500金币',1,'UKMG1284',321,100171,2,NULL,40,NULL,'2017-08-27 23:56:32'),(22,'500金币',1,'nJmo9217',321,100100,2,NULL,28,NULL,'2017-08-27 23:56:33'),(23,'500金币',1,'VMHB1423',32,100100,2,NULL,28,NULL,'2017-08-27 23:56:53'),(24,'500金币',1,'Wpse5424',321,100100,2,NULL,28,NULL,'2017-08-27 23:58:55'),(25,'500金币',1,'NRUV9703',321,100100,2,NULL,28,NULL,'2017-08-28 00:01:57'),(26,'500金币',1,'VPps8690',321,100100,2,NULL,28,NULL,'2017-08-28 00:11:49'),(27,'500金币',1,'pdsk7584',321,246233,2,NULL,28,NULL,'2017-08-28 00:59:27'),(28,'500金币',1,'bQrI3113',321,246233,2,NULL,28,NULL,'2017-08-28 01:01:53'),(29,'500金币',1,'qppF2954',321,246233,2,NULL,28,NULL,'2017-08-28 01:18:43'),(30,'500金币',1,'hOoG6635',0,246233,2,NULL,28,NULL,'2017-08-28 01:18:45'),(31,'50砖石',1,'TgEv1685',0,246233,2,NULL,31,NULL,'2017-08-28 01:18:47'),(32,'50砖石',1,'Kvhd4994',0,246233,2,NULL,31,NULL,'2017-08-28 03:17:58'),(33,'500金币',1,'hQDF5225',0,246233,2,NULL,28,NULL,'2017-08-28 03:19:05'),(34,'500金币',1,'LcVB3916',0,246233,2,NULL,28,NULL,'2017-08-28 03:19:23'),(35,'500金币',1,'TAnr8696',0,246233,2,NULL,28,NULL,'2017-08-28 03:19:33'),(36,'500金币',1,'dWRj0102',0,246233,2,NULL,28,NULL,'2017-08-28 03:19:48'),(37,'500金币',1,'yrTg2085',0,246233,2,NULL,28,NULL,'2017-08-28 03:21:44'),(38,'500金币',1,'wFQQ1845',0,246233,2,NULL,28,NULL,'2017-08-28 03:23:10'),(39,'500金币',1,'FFzr6475',0,246233,2,NULL,28,NULL,'2017-08-28 03:23:45'),(40,'500金币',1,'qCwR8547',0,246233,2,NULL,28,NULL,'2017-08-28 03:25:19'),(41,'500金币',1,'gMEn3042',0,246233,2,NULL,28,NULL,'2017-08-28 03:56:21'),(42,'500金币',1,'Udar3271',0,246233,2,NULL,28,NULL,'2017-08-28 03:57:26'),(43,'500金币',1,'SYbo0121',0,246233,2,NULL,28,NULL,'2017-08-28 03:59:07'),(44,'500金币',1,'zqBR6029',0,246233,2,NULL,28,NULL,'2017-08-28 04:01:22'),(45,'500金币',1,'IDrD7991',0,246233,2,NULL,28,NULL,'2017-08-28 04:03:44'),(46,'500金币',1,'bUnC7048',0,246233,2,NULL,28,NULL,'2017-08-28 18:53:36'),(47,'500金币',1,'PRHh0849',0,246233,2,NULL,28,NULL,'2017-08-28 18:53:44'),(48,'500金币',1,'jtZm3368',0,246233,2,NULL,28,NULL,'2017-08-28 19:30:13'),(49,'500金币',1,'LvEg9569',0,100614,2,NULL,28,NULL,'2017-08-29 05:40:49'),(50,'6砖石',1,'uHnj2679',0,100614,2,NULL,29,NULL,'2017-08-29 05:40:54'),(51,'500金币',1,'sFTl1405',0,100614,2,NULL,28,NULL,'2017-08-29 05:41:05'),(52,'6砖石',1,'VNxh9209',0,100614,2,NULL,29,NULL,'2017-08-29 05:41:11'),(53,'500金币',1,'oFVl0140',0,246424,2,NULL,28,NULL,'2017-08-30 00:39:49'),(54,'500金币',1,'VjGz0289',0,246424,2,NULL,28,NULL,'2017-08-30 00:39:55'),(55,'6砖石',1,'qQbT9315',0,246424,2,NULL,29,NULL,'2017-08-30 00:39:58'),(56,'6砖石',1,'VbZU7216',0,246425,2,NULL,29,NULL,'2017-08-30 00:41:42'),(57,'500金币',1,'MlHT6954',0,246447,2,NULL,28,NULL,'2017-08-30 01:46:26'),(58,'500金币',1,'AbHT1372',0,246447,2,NULL,28,NULL,'2017-08-30 01:46:29'),(59,'6砖石',1,'IWye2856',0,246447,2,NULL,29,NULL,'2017-08-30 01:46:34'),(60,'青铜核弹',1,'vDsv4941',0,100167,2,NULL,30,NULL,'2017-08-31 05:49:30'),(61,'青铜核弹',1,'sKyI2497',0,100167,2,NULL,30,NULL,'2017-08-31 05:50:56'),(62,'青铜核弹',1,'MeHg7046',0,100167,2,NULL,30,NULL,'2017-08-31 05:50:59'),(63,'青铜核弹',1,'DAUu7525',0,100167,2,NULL,30,NULL,'2017-08-31 05:51:03'),(64,'青铜核弹',1,'Iugl9264',0,100167,2,NULL,30,NULL,'2017-08-31 05:51:06'),(65,'青铜核弹',1,'qlRu7534',0,100167,2,NULL,30,NULL,'2017-08-31 05:51:08'),(66,'青铜核弹',1,'EpJT1558',0,100167,2,NULL,30,NULL,'2017-08-31 05:51:09'),(67,'青铜核弹',1,'osho7481',0,100167,2,NULL,30,NULL,'2017-08-31 05:51:11'),(68,'青铜核弹',1,'MgDE8151',0,100167,2,NULL,30,NULL,'2017-08-31 05:51:12'),(69,'青铜核弹',1,'oQeL0234',0,100168,2,NULL,30,NULL,'2017-08-31 05:53:44'),(70,'白银核弹',1,'DLEx8947',0,100166,2,NULL,31,NULL,'2017-08-31 05:54:30'),(71,'青铜核弹',1,'lkMa6947',0,100168,2,NULL,30,NULL,'2017-08-31 05:55:10'),(72,'青铜核弹',1,'zusX5840',0,100168,2,NULL,30,NULL,'2017-08-31 05:55:11'),(73,'青铜核弹',1,'ajgx8279',0,100168,2,NULL,30,NULL,'2017-08-31 05:55:13'),(74,'青铜核弹',1,'LrTQ2029',0,100168,2,NULL,30,NULL,'2017-08-31 05:55:14'),(75,'青铜核弹',1,'IBXJ3134',0,100168,2,NULL,30,NULL,'2017-08-31 05:55:16'),(76,'青铜核弹',1,'RaPY9354',0,100168,2,NULL,30,NULL,'2017-08-31 05:55:17'),(77,'青铜核弹',1,'KtLP0417',0,100169,2,NULL,30,NULL,'2017-08-31 05:59:35'),(78,'青铜核弹',1,'ucgN7383',0,100169,2,NULL,30,NULL,'2017-08-31 06:00:40'),(79,'青铜核弹',1,'anJS0222',0,100169,2,NULL,30,NULL,'2017-08-31 06:00:50'),(80,'青铜核弹',1,'shiz6232',0,100169,2,NULL,30,NULL,'2017-08-31 06:00:56'),(81,'白银核弹',1,'XGRC0712',0,100169,2,NULL,31,NULL,'2017-08-31 06:01:59'),(82,'300元京东卡',1,'ybzJ4138',0,100169,2,NULL,38,NULL,'2017-08-31 06:02:05'),(83,'300元京东卡',1,'hJBE1108',0,100169,2,NULL,38,NULL,'2017-08-31 06:02:43'),(84,'青铜核弹',1,'dbPi2467',0,100169,2,NULL,30,NULL,'2017-08-31 06:09:52'),(85,'白银核弹',1,'DRAV8696',0,100169,2,NULL,31,NULL,'2017-08-31 06:09:53'),(86,'青铜核弹',1,'Wghc4037',0,100169,2,NULL,30,NULL,'2017-08-31 06:09:59'),(87,'白银核弹',1,'BeUV3067',0,100169,2,NULL,31,NULL,'2017-08-31 06:10:00'),(88,'300元京东卡',1,'JjGr7966',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:01'),(89,'300元京东卡',1,'Tlbs8251',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:03'),(90,'300元京东卡',1,'Ytvr6489',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:04'),(91,'300元京东卡',1,'aXdi9075',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:04'),(92,'300元京东卡',1,'qSrS6037',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:04'),(93,'300元京东卡',1,'qNoq2413',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:05'),(94,'300元京东卡',1,'ptbZ3042',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:05'),(95,'300元京东卡',1,'zVsx9603',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:06'),(96,'300元京东卡',1,'whjX3482',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:06'),(97,'300元京东卡',1,'ouCj9531',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:07'),(98,'300元京东卡',1,'tutY4658',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:07'),(99,'300元京东卡',1,'iAGY7796',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:08'),(100,'300元京东卡',1,'DeCQ8247',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:08'),(101,'300元京东卡',1,'cQSm0946',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:08'),(102,'300元京东卡',1,'NJev6945',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:09'),(103,'300元京东卡',1,'HEge9522',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:09'),(104,'300元京东卡',1,'ISlI1889',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:09'),(105,'300元京东卡',1,'wfZg3032',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:10'),(106,'300元京东卡',1,'hwTU5379',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:11'),(107,'青铜核弹',1,'Zept3816',0,100170,2,NULL,30,NULL,'2017-08-31 06:10:59'),(108,'青铜核弹',1,'ilVH3537',0,100171,2,NULL,30,NULL,'2017-08-31 06:14:11'),(109,'300元京东卡',1,'UzYf7897',0,100171,2,NULL,38,NULL,'2017-08-31 06:15:07'),(110,'300元京东卡',1,'uuiW5702',30000,100171,2,NULL,38,NULL,'2017-08-31 06:18:22'),(111,'300元京东卡',1,'nckb1672',30000,100171,2,NULL,38,NULL,'2017-08-31 06:20:36'),(112,'300元京东卡',1,'KCol6596',30000,100171,2,NULL,38,NULL,'2017-08-31 06:20:48'),(113,'300元京东卡',1,'Yjnb3289',30000,100171,2,NULL,38,NULL,'2017-08-31 06:23:06'),(114,'300元京东卡',1,'uenb3617',30000,100171,2,NULL,38,NULL,'2017-08-31 06:29:00'),(115,'10万金币',1,'fekN0550',1000,100214,2,NULL,28,NULL,'2017-09-04 04:13:07');

/*Table structure for table `jy_users_goods_stream` */

DROP TABLE IF EXISTS `jy_users_goods_stream`;

CREATE TABLE `jy_users_goods_stream` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户物品流水',
  `playerid` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `Code` varchar(20) NOT NULL COMMENT '物品编码',
  `Type` tinyint(1) unsigned NOT NULL COMMENT '类型 1-游戏 2-充值 3-签到 4-兑换 5-月卡 6-首冲',
  `Income` tinyint(1) NOT NULL COMMENT '1-收入 2-支出',
  `Number` int(11) NOT NULL COMMENT '数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`playerid`),
  KEY `Code` (`Code`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_goods_stream` */

insert  into `jy_users_goods_stream`(`Id`,`playerid`,`Code`,`Type`,`Income`,`Number`,`DateTime`) values (107,100006,'1',5,1,9,'2017-09-04 04:52:33'),(106,100006,'2',5,1,64,'2017-09-04 04:52:33'),(105,100006,'1',5,1,9,'2017-09-04 04:51:28'),(104,100006,'2',5,1,64,'2017-09-04 04:51:28'),(103,100006,'1',5,1,9,'2017-09-04 04:45:01'),(102,100006,'2',5,1,64,'2017-09-04 04:45:01'),(101,100006,'1',5,1,9,'2017-09-04 04:44:59'),(100,100006,'2',5,1,64,'2017-09-04 04:44:59'),(99,100006,'1',5,1,9,'2017-09-04 04:44:59'),(98,100006,'2',5,1,64,'2017-09-04 04:44:59'),(97,100006,'1',5,1,9,'2017-09-04 04:44:57'),(96,100006,'2',5,1,64,'2017-09-04 04:44:57'),(95,100006,'1',5,1,9,'2017-09-04 04:44:53'),(94,100006,'2',5,1,64,'2017-09-04 04:44:53');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_order_goods` */

insert  into `jy_users_order_goods`(`Id`,`playerid`,`PlatformOrder`,`GoodsName`,`GoodsCode`,`GetNum`,`Proportion`,`GoodsID`,`Price`,`IsGive`,`Number`,`Type`,`DateTime`) values (1,100200,'JYHD2017090653505599','60000金币','60000',60000,100,8,6,1,1,1,'2017-09-06 01:10:48'),(2,100200,'JYHD2017090651514853','60000金币','60000',60000,0,8,6,1,1,1,'2017-09-06 01:19:15');

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
  `Price` varchar(20) NOT NULL COMMENT '价格',
  `CallbackTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '支付回调时间',
  `ExpireTime` int(11) unsigned DEFAULT NULL COMMENT '订单过期时间',
  `FoundTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `RegisterChannel` varchar(50) NOT NULL COMMENT '注册渠道',
  `MessAge` varchar(255) DEFAULT NULL COMMENT '支付状态说明',
  `PayPlatform` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支付平台 1-支付宝 2-微信 3-爱贝 4-银联',
  `PayChannel` varchar(50) NOT NULL COMMENT '消费渠道',
  `VipLevel` int(4) unsigned DEFAULT NULL COMMENT '购买前用户Vip等级',
  `Form` tinyint(1) NOT NULL DEFAULT '1' COMMENT '来源 1-首冲 2-月卡 3-商城',
  `VipExp` int(11) unsigned DEFAULT NULL COMMENT '购买前用户Vip经验',
  `PayID` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '支付ID',
  `Platform` tinyint(1) NOT NULL DEFAULT '1' COMMENT '平台 1-苹果 2-安卓',
  `PayPassAgeWay` varchar(50) NOT NULL COMMENT '支付通道',
  `PayType` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付类型 0-未支付 1-支付宝 2-微信',
  PRIMARY KEY (`Id`),
  KEY `Status` (`Status`),
  KEY `playerid` (`playerid`),
  KEY `ExpireTime` (`ExpireTime`),
  KEY `PlatformOrder` (`PlatformOrder`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_order_info` */

insert  into `jy_users_order_info`(`Id`,`playerid`,`OrderName`,`UsersName`,`PlatformOrder`,`MerchantOrder`,`Status`,`Price`,`CallbackTime`,`ExpireTime`,`FoundTime`,`RegisterChannel`,`MessAge`,`PayPlatform`,`PayChannel`,`VipLevel`,`Form`,`VipExp`,`PayID`,`Platform`,`PayPassAgeWay`,`PayType`) values (1,100200,'60000金币','游客100200','JYHD2017090653505599','',2,'6','2017-09-06 16:46:45',0,'2017-09-06 01:10:47','','状态码：2001说明：支付成功！;',3,'13724894160',0,1,24,6,2,'iappay',103),(2,100200,'60000金币','游客100200','JYHD2017090651514853','',1,'6','2017-09-06 01:19:15',0,'2017-09-06 01:19:15','',NULL,3,'13724894160',3,3,0,6,2,'iappay',0);

/*Table structure for table `jy_users_package_shop_log` */

DROP TABLE IF EXISTS `jy_users_package_shop_log`;

CREATE TABLE `jy_users_package_shop_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户礼包购买记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户Id',
  `Type` tinyint(1) unsigned NOT NULL COMMENT '1-首充 2-月卡',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`Type`,`DateTime`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_package_shop_log` */

insert  into `jy_users_package_shop_log`(`Id`,`playerid`,`Type`,`DateTime`) values (4,100200,1,'2017-09-06 01:46:45'),(3,100200,2,'2017-09-06 01:46:25');

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
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_shop_log` */

insert  into `jy_users_shop_log`(`Id`,`playerid`,`GoodID`,`Code`,`GiveNum`,`IsGive`,`Number`,`DateTime`) values (1,100201,25,'2312',0,1,1,'2017-09-05 04:17:27'),(2,100201,18,'1004',0,2,1,'2017-09-05 04:17:27'),(3,100201,19,'1005',0,2,1,'2017-09-05 04:17:27'),(4,100201,20,'1001',0,2,30,'2017-09-05 04:17:27'),(5,100201,23,'1002',0,2,50000,'2017-09-05 04:17:27'),(6,100201,26,'312',0,2,8,'2017-09-05 04:17:27'),(7,100201,27,'4645',0,2,3,'2017-09-05 04:17:27'),(8,100201,25,'2312',0,1,1,'2017-09-05 04:18:37'),(9,100201,18,'1004',0,2,1,'2017-09-05 04:18:37'),(10,100201,19,'1005',0,2,1,'2017-09-05 04:18:37'),(11,100201,20,'1001',0,2,30,'2017-09-05 04:18:37'),(12,100201,23,'1002',0,2,50000,'2017-09-05 04:18:37'),(13,100201,26,'312',0,2,8,'2017-09-05 04:18:37'),(14,100201,27,'4645',0,2,3,'2017-09-05 04:18:37'),(15,100201,25,'2312',0,1,1,'2017-09-05 04:18:40'),(16,100201,18,'1004',0,2,1,'2017-09-05 04:18:40'),(17,100201,19,'1005',0,2,1,'2017-09-05 04:18:40'),(18,100201,20,'1001',0,2,30,'2017-09-05 04:18:40'),(19,100201,23,'1002',0,2,50000,'2017-09-05 04:18:40'),(20,100201,26,'312',0,2,8,'2017-09-05 04:18:40'),(21,100201,27,'4645',0,2,3,'2017-09-05 04:18:40'),(22,100201,25,'2312',0,1,1,'2017-09-05 04:18:42'),(23,100201,18,'1004',0,2,1,'2017-09-05 04:18:42'),(24,100201,19,'1005',0,2,1,'2017-09-05 04:18:42'),(25,100201,20,'1001',0,2,30,'2017-09-05 04:18:42'),(26,100201,23,'1002',0,2,50000,'2017-09-05 04:18:42'),(27,100201,26,'312',0,2,8,'2017-09-05 04:18:42'),(28,100201,27,'4645',0,2,3,'2017-09-05 04:18:42'),(29,100201,25,'2312',0,1,1,'2017-09-05 04:18:44'),(30,100201,18,'1004',0,2,1,'2017-09-05 04:18:44'),(31,100201,19,'1005',0,2,1,'2017-09-05 04:18:44'),(32,100201,20,'1001',0,2,30,'2017-09-05 04:18:44'),(33,100201,23,'1002',0,2,50000,'2017-09-05 04:18:44'),(34,100201,26,'312',0,2,8,'2017-09-05 04:18:44'),(35,100201,27,'4645',0,2,3,'2017-09-05 04:18:44'),(36,100201,25,'2312',0,1,1,'2017-09-05 04:19:00'),(37,100201,18,'1004',0,2,1,'2017-09-05 04:19:00'),(38,100201,19,'1005',0,2,1,'2017-09-05 04:19:00'),(39,100201,20,'1001',0,2,30,'2017-09-05 04:19:00'),(40,100201,23,'1002',0,2,50000,'2017-09-05 04:19:00'),(41,100201,26,'312',0,2,8,'2017-09-05 04:19:00'),(42,100201,27,'4645',0,2,3,'2017-09-05 04:19:00'),(43,100201,25,'2312',0,1,1,'2017-09-05 04:20:45'),(44,100201,18,'1004',0,2,1,'2017-09-05 04:20:45'),(45,100201,19,'1005',0,2,1,'2017-09-05 04:20:45'),(46,100201,20,'1001',0,2,30,'2017-09-05 04:20:45'),(47,100201,23,'1002',0,2,50000,'2017-09-05 04:20:45'),(48,100201,26,'312',0,2,8,'2017-09-05 04:20:45'),(49,100201,27,'4645',0,2,3,'2017-09-05 04:20:45'),(50,100201,25,'2312',0,1,1,'2017-09-05 04:20:52'),(51,100201,18,'1004',0,2,1,'2017-09-05 04:20:52'),(52,100201,19,'1005',0,2,1,'2017-09-05 04:20:52'),(53,100201,20,'1001',0,2,30,'2017-09-05 04:20:52'),(54,100201,23,'1002',0,2,50000,'2017-09-05 04:20:52'),(55,100201,26,'312',0,2,8,'2017-09-05 04:20:52'),(56,100201,27,'4645',0,2,3,'2017-09-05 04:20:52'),(57,100201,25,'2312',0,1,1,'2017-09-05 04:54:03'),(58,100201,18,'1004',0,2,1,'2017-09-05 04:54:03'),(59,100201,19,'1005',0,2,1,'2017-09-05 04:54:03'),(60,100201,20,'1001',0,2,30,'2017-09-05 04:54:03'),(61,100201,23,'1002',0,2,50000,'2017-09-05 04:54:03'),(62,100201,26,'312',0,2,8,'2017-09-05 04:54:03'),(63,100201,27,'4645',0,2,3,'2017-09-05 04:54:03'),(64,100201,25,'2312',0,1,1,'2017-09-05 04:55:15'),(65,100201,18,'1004',0,2,1,'2017-09-05 04:55:15'),(66,100201,19,'1005',0,2,1,'2017-09-05 04:55:15'),(67,100201,20,'1001',0,2,30,'2017-09-05 04:55:15'),(68,100201,23,'1002',0,2,50000,'2017-09-05 04:55:15'),(69,100201,26,'312',0,2,8,'2017-09-05 04:55:15'),(70,100201,27,'4645',0,2,3,'2017-09-05 04:55:15'),(71,100201,25,'2312',0,1,1,'2017-09-05 04:56:40'),(72,100201,18,'1004',0,2,1,'2017-09-05 04:56:40'),(73,100201,19,'1005',0,2,1,'2017-09-05 04:56:40'),(74,100201,20,'1001',0,2,30,'2017-09-05 04:56:40'),(75,100201,23,'1002',0,2,50000,'2017-09-05 04:56:40'),(76,100201,26,'312',0,2,8,'2017-09-05 04:56:40'),(77,100201,27,'4645',0,2,3,'2017-09-05 04:56:40'),(78,100201,25,'2312',0,1,1,'2017-09-05 04:57:09'),(79,100201,18,'1004',0,2,1,'2017-09-05 04:57:09'),(80,100201,19,'1005',0,2,1,'2017-09-05 04:57:09'),(81,100201,20,'1001',0,2,30,'2017-09-05 04:57:09'),(82,100201,23,'1002',0,2,50000,'2017-09-05 04:57:09'),(83,100201,26,'312',0,2,8,'2017-09-05 04:57:09'),(84,100201,27,'4645',0,2,3,'2017-09-05 04:57:09'),(85,100201,25,'2312',0,1,1,'2017-09-05 05:01:21'),(86,100201,18,'1004',0,2,1,'2017-09-05 05:01:21'),(87,100201,19,'1005',0,2,1,'2017-09-05 05:01:21'),(88,100201,20,'1001',0,2,30,'2017-09-05 05:01:21'),(89,100201,23,'1002',0,2,50000,'2017-09-05 05:01:21'),(90,100201,26,'312',0,2,8,'2017-09-05 05:01:21'),(91,100201,27,'4645',0,2,3,'2017-09-05 05:01:21'),(92,100201,25,'2312',0,1,1,'2017-09-05 05:04:21'),(93,100201,18,'1004',0,2,1,'2017-09-05 05:04:21'),(94,100201,19,'1005',0,2,1,'2017-09-05 05:04:21'),(95,100201,20,'1001',0,2,30,'2017-09-05 05:04:21'),(96,100201,23,'1002',0,2,50000,'2017-09-05 05:04:21'),(97,100201,26,'312',0,2,8,'2017-09-05 05:04:21'),(98,100201,27,'4645',0,2,3,'2017-09-05 05:04:21'),(99,100201,25,'2312',0,1,1,'2017-09-05 05:08:34'),(100,100201,18,'1004',0,2,1,'2017-09-05 05:08:34'),(101,100201,19,'1005',0,2,1,'2017-09-05 05:08:34'),(102,100201,20,'1001',0,2,30,'2017-09-05 05:08:34'),(103,100201,23,'1002',0,2,50000,'2017-09-05 05:08:34'),(104,100201,26,'312',0,2,8,'2017-09-05 05:08:34'),(105,100201,27,'4645',0,2,3,'2017-09-05 05:08:34'),(106,100201,25,'2312',0,1,1,'2017-09-05 05:11:55'),(107,100201,18,'1004',0,2,1,'2017-09-05 05:11:55'),(108,100201,19,'1005',0,2,1,'2017-09-05 05:11:55'),(109,100201,20,'1001',0,2,30,'2017-09-05 05:11:55'),(110,100201,23,'1002',0,2,50000,'2017-09-05 05:11:55'),(111,100201,26,'312',0,2,8,'2017-09-05 05:11:55'),(112,100201,27,'4645',0,2,3,'2017-09-05 05:11:55'),(113,100201,25,'2312',0,1,1,'2017-09-05 05:12:06'),(114,100201,18,'1004',0,2,1,'2017-09-05 05:12:06'),(115,100201,19,'1005',0,2,1,'2017-09-05 05:12:06'),(116,100201,20,'1001',0,2,30,'2017-09-05 05:12:06'),(117,100201,23,'1002',0,2,50000,'2017-09-05 05:12:06'),(118,100201,26,'312',0,2,8,'2017-09-05 05:12:06'),(119,100201,27,'4645',0,2,3,'2017-09-05 05:12:06'),(120,100201,25,'2312',0,1,1,'2017-09-05 05:12:17'),(121,100201,18,'1004',0,2,1,'2017-09-05 05:12:17'),(122,100201,19,'1005',0,2,1,'2017-09-05 05:12:17'),(123,100201,20,'1001',0,2,30,'2017-09-05 05:12:17'),(124,100201,23,'1002',0,2,50000,'2017-09-05 05:12:17'),(125,100201,26,'312',0,2,8,'2017-09-05 05:12:17'),(126,100201,27,'4645',0,2,3,'2017-09-05 05:12:17');

/*Table structure for table `jy_users_sign_log` */

DROP TABLE IF EXISTS `jy_users_sign_log`;

CREATE TABLE `jy_users_sign_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户签到记录表',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned NOT NULL COMMENT '物品ID',
  `Day` tinyint(1) unsigned NOT NULL COMMENT '第几天',
  `Number` int(11) NOT NULL COMMENT '数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '签到时间',
  PRIMARY KEY (`Id`),
  KEY `Day` (`Day`),
  KEY `playerid` (`playerid`,`DateTime`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_sign_log` */

insert  into `jy_users_sign_log`(`Id`,`playerid`,`GoodsID`,`Day`,`Number`,`DateTime`) values (1,2,1,1,2,'2017-08-07 04:46:21'),(3,2,1,1,32,'2017-07-31 20:08:09'),(4,2,2,2,32,'2017-08-01 20:08:29'),(5,2,2,3,213,'2017-08-02 20:10:49'),(6,2,2,4,2,'2017-08-03 20:11:52'),(7,2,32,5,32,'2017-08-04 20:11:55'),(8,2,32,6,321,'2017-08-05 20:11:58'),(9,2,312,7,312,'2017-08-06 20:12:01');

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

insert  into `jy_vip_info`(`level`,`GiveInfo`,`ImgCode`,`Describe`,`experience`,`mtime`) values (0,'','','',0,'2017-09-05 04:10:22'),(1,'赠送武器\"紫苑\"','gun_01.png','每日签到双倍 \r\n每日免费领取 \r\n20000金币',30,'2017-07-25 20:52:02'),(2,'赠送武器\"寒光\"','gun_02.png','在线奖励金币翻倍\r\n每日免费领取\r\n30000金币',100,'2017-08-17 19:48:01'),(3,'赠送武器\"海炎\"','gun_03.png','锁定时间x2\r\n每日免费领取\r\n40000金币',300,'2017-08-17 19:48:57'),(4,'赠送武器\"审判\"','gun_04.png','捕鱼概率2倍奖励\r\n每日免费领取\r\n70000金币',800,'2017-08-17 19:49:12'),(5,'赠送武器\"毒药\"','gun_05.png','捕渔券概率x2\r\n每日免费领取\r\n250000金币',2000,'2017-08-17 19:49:32'),(6,'赠送武器\"冰魄\"','gun_06.png','捕鱼概率3倍奖励\r\n每日免费领取\r\n250000金币',5000,'2017-08-17 19:49:39'),(7,'赠送武器\"黯灭\"','gun_01.png','增加2倍炮时间\r\n每日免费领取\r\n40000金币',10000,'2017-08-17 19:49:46'),(8,'赠送武器\"无双\"','tuan_02.png','提升打BOSS概率\r\n每日免费领取\r\n650000金币',20000,'2017-08-17 19:49:57'),(9,'赠送武器\"吞海\"','tuan_02.png','获得核弹概率x2\r\n每日免费领取\r\n1000000金币',50000,'2017-08-17 19:50:05'),(10,'赠送武器\"祸忌\"','tuan_02.png','提升捕获所有鱼的概率\r\n每日免费领取\r\n1500000金币',100000,'2017-08-17 19:50:12');

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
  `gun_lv` int(11) DEFAULT NULL COMMENT '炮的等级',
  `sign_day` int(11) DEFAULT NULL COMMENT '累计签到天数',
  `sign_time` bigint(20) DEFAULT NULL COMMENT '签到时间',
  `gunid` int(11) DEFAULT NULL COMMENT '当前炮的id',
  `is_mc` int(11) DEFAULT NULL COMMENT '是否是月卡用户',
  `mc_overtime` bigint(20) DEFAULT NULL COMMENT '月卡结束时间',
  PRIMARY KEY (`playerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `player` */

insert  into `player`(`playerid`,`name`,`sex`,`vip`,`vip_exp`,`status`,`serverid`,`game_type`,`room_type`,`level_type`,`roomid`,`gold`,`diamond`,`deposit`,`profit`,`glevel`,`gexp`,`gun_lv`,`sign_day`,`sign_time`,`gunid`,`is_mc`,`mc_overtime`) values (246192,'游客246192',1,0,0,1,0,-1,0,-1,-1,100000,0,0,0,1,0,10,0,0,1,0,0),(246193,'游客246193',1,0,0,1,0,-1,0,-1,-1,100000,0,0,0,1,0,10,0,0,1,0,0),(246194,'游客246194',1,0,0,1,0,-1,0,-1,-1,203900,0,0,103900,1,0,10,0,0,1,0,0),(246195,'游客246195',1,0,0,1,0,-1,0,-1,-1,100000,0,0,0,1,0,10,0,0,1,0,0),(246196,'游客246196',1,0,0,0,0,-1,0,-1,-1,100000,0,0,0,1,0,1,0,0,1,0,0),(246197,'游客246197',1,0,0,0,0,-1,0,-1,-1,100000,0,0,0,1,0,1,0,0,1,0,0),(246198,'游客246198',1,0,0,0,0,-1,0,-1,-1,100000,0,0,0,1,0,1,0,0,1,0,0),(246199,'游客246199',1,0,0,0,0,-1,0,-1,-1,100000,0,0,0,1,0,1,0,0,1,0,0),(246200,'游客246200',1,0,0,0,0,-1,0,-1,-1,100000,0,0,0,1,0,1,0,0,1,0,0),(246201,'游客246201',1,0,0,0,0,-1,0,-1,-1,100000,0,0,0,1,0,1,0,0,1,0,0),(246202,'游客246202',1,0,0,0,0,-1,0,-1,-1,100000,0,0,0,1,0,1,0,0,1,0,0),(246203,'游客246203',1,0,0,0,0,-1,0,-1,-1,100000,0,0,0,1,0,1,0,0,1,0,0),(246204,'游客246204',1,0,0,0,0,-1,0,-1,-1,100000,0,0,0,1,0,1,0,0,1,0,0),(246205,'游客246205',1,0,0,0,0,-1,0,-1,-1,9528710,0,0,9428710,1,0,1,0,0,1,0,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
