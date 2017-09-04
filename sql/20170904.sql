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

insert  into `jy_activity_father_list`(`Id`,`Code`,`Type`,`Title`,`AddUpStartTime`,`AddUpEndTime`,`ShowStartTime`,`ShowEndTime`,`Describe`,`DateTime`) values (5,'1001',1,'累计充值','2017-08-11 11:00:00','2017-09-01 11:00:00','2017-08-10 11:00:00','2017-10-29 11:00:00','aaaaaaaaaaaaaaaaaaaaaa','2017-08-13 20:05:35'),(6,'1002',2,'单笔充值','2017-08-14 11:00:00','2017-08-30 11:00:00','2017-08-12 11:00:00','2017-09-30 11:00:00','','2017-08-13 20:06:18');

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

/*Table structure for table `jy_aisoyo_class` */

DROP TABLE IF EXISTS `jy_aisoyo_class`;

CREATE TABLE `jy_aisoyo_class` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Gname` varchar(200) DEFAULT NULL,
  `Gtitle` varchar(200) DEFAULT NULL,
  `AndroidName` varchar(200) DEFAULT NULL,
  `appleName` varchar(200) DEFAULT NULL,
  `filesize` decimal(18,0) DEFAULT NULL,
  `images` varchar(200) DEFAULT NULL,
  `AndroidQrcode` varchar(100) DEFAULT NULL,
  `AppleQrcode` varchar(100) DEFAULT NULL,
  `BigImage` varchar(200) DEFAULT NULL,
  `Ishot` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `PK_JY_Aisoyo_class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_aisoyo_class` */

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
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

/*Data for the table `jy_api_visit_log` */

insert  into `jy_api_visit_log`(`Id`,`Name`,`Url`,`Code`,`Msg`,`TimeOut`,`AccessIP`,`DataTime`) values (1,'支付订单','/Jy_api/PayOrder/index',2001,'请求成功。','','192.168.0.116','2017-08-24 00:42:18'),(2,'支付订单','/Jy_api/PayOrder/index',2001,'请求成功。','','192.168.0.116','2017-08-24 00:42:29'),(3,'支付订单','/Jy_api/PayOrder/index',2001,'请求成功。','','192.168.0.116','2017-08-24 04:48:35'),(4,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:16'),(5,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:19'),(6,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:20'),(7,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:22'),(8,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:23'),(9,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:24'),(10,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:24'),(11,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:25'),(12,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:25'),(13,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:26'),(14,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:26'),(15,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:27'),(16,'','/Jy_api/CardInfo/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:29:29'),(17,'','/Jy_api/SevenDaysSign/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:30:12'),(18,'','/Jy_api/MallGoodsList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:30:24'),(19,'','/Jy_api/MallExchange/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:31:30'),(20,'','/Jy_api/ExchangeLog/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:31:32'),(21,'','/Jy_api/MallExchange/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:31:41'),(22,'','/Jy_api/ExchangeLog/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:31:42'),(23,'','/Jy_api/MallExchange/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:31:44'),(24,'','/Jy_api/ActivityList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:33:19'),(25,'','/Jy_api/ActivityList/index',6003,'渠道不存在。','','192.168.0.130','2017-08-29 19:33:43'),(26,'','/Jy_api/SevenDaysSign/index',6003,'渠道不存在。','','192.168.0.106','2017-08-29 19:40:58'),(27,'','/Jy_api/SevenDaysSign/index',6003,'渠道不存在。','','192.168.0.106','2017-08-29 19:41:08'),(28,'','/Jy_api/SevenDaysSign/index',6003,'渠道不存在。','','192.168.0.106','2017-08-29 19:41:11'),(29,'','/Jy_api/VipInfo/index',6003,'渠道不存在。','','192.168.0.111','2017-08-29 20:05:01'),(30,'','/Jy_api/VipInfo/index',6003,'渠道不存在。','','192.168.0.111','2017-08-29 20:05:19'),(31,'','/Jy_api/VipInfo/index',6003,'渠道不存在。','','192.168.0.111','2017-08-29 20:05:39'),(32,'','/Jy_api/VipInfo/index',6003,'渠道不存在。','','192.168.0.111','2017-08-29 20:17:03'),(33,'','/Jy_api/SevenDaysSign/index',6003,'渠道不存在。','','192.168.0.111','2017-08-29 20:18:26'),(34,'','/Jy_api/VipInfo/index',6003,'渠道不存在。','','192.168.0.111','2017-08-29 20:18:27'),(35,'','/Jy_api/MallExchange/index',6003,'渠道不存在。','','192.168.0.111','2017-08-29 20:18:34'),(36,'','/Jy_api/VipInfo/index',6003,'渠道不存在。','','192.168.0.111','2017-08-29 20:25:01'),(37,'','/Jy_api/VipInfo/index',6003,'渠道不存在。','','192.168.0.111','2017-08-29 20:25:07'),(38,'','/Jy_api/ExchangeLog/index',6003,'渠道不存在。','','192.168.0.116','2017-08-29 20:26:02'),(39,'','/Jy_api/VipInfo/index',6001,'请求方式不合法。','','192.168.0.116','2017-08-29 20:32:14'),(40,'','/Jy_api/VipInfo/index',6001,'请求方式不合法。','','192.168.0.111','2017-08-29 20:32:53'),(41,'','/Jy_api/VipInfo/index',6001,'请求方式不合法。','','192.168.0.111','2017-08-29 20:33:06'),(42,'','/Jy_api/VipInfo/index',6001,'请求方式不合法。','','192.168.0.116','2017-08-29 20:35:33'),(43,'','/Jy_api/VipInfo/index',6001,'请求方式不合法。','','192.168.0.116','2017-08-29 20:50:13'),(44,'','/Jy_api/VipInfo/index',6001,'请求方式不合法。','','192.168.0.116','2017-08-29 20:50:15'),(45,'','/Jy_api/VipInfo/index',6001,'请求方式不合法。','','192.168.0.116','2017-08-29 20:50:19'),(46,'','/Jy_api/VipInfo/index',6001,'请求方式不合法。','','192.168.0.116','2017-08-29 20:50:33'),(47,'','/Jy_api/VipInfo/index',6001,'请求方式不合法。','','192.168.0.116','2017-08-29 20:51:05');

/*Table structure for table `jy_call_card_list` */

DROP TABLE IF EXISTS `jy_call_card_list`;

CREATE TABLE `jy_call_card_list` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '话费卡',
  `CardNumber` varchar(100) NOT NULL COMMENT '卡号',
  `Cami` varchar(100) NOT NULL COMMENT '卡密',
  `FaceValue` varchar(10) NOT NULL COMMENT '面值',
  `Status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否发放 1-否 2-是',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`Id`),
  KEY `FaceValue` (`FaceValue`,`Status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_call_card_list` */

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `jy_channel_thirdpay` */

insert  into `jy_channel_thirdpay`(`id`,`adminUserID`,`PayID`,`DateTime`) values (3,3,4,'2017-08-01 04:32:10'),(5,5,4,'2017-08-01 04:34:09'),(6,3,6,'2017-08-23 23:27:24');

/*Table structure for table `jy_company` */

DROP TABLE IF EXISTS `jy_company`;

CREATE TABLE `jy_company` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '金币 - 砖石 范围',
  `company` char(5) NOT NULL COMMENT '千',
  `name` varchar(20) NOT NULL,
  `start` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '起始',
  `end` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '结束',
  PRIMARY KEY (`id`),
  KEY `start` (`start`,`end`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `jy_company` */

insert  into `jy_company`(`id`,`company`,`name`,`start`,`end`) values (1,'个','0',0,0),(2,'个','1-1000',1,1000),(3,'个','1000-2000',1000,2000),(4,'个','2000-3000',2000,3000),(5,'个','3000-4000',3000,4000),(6,'个','4000-5000',4000,5000);

/*Table structure for table `jy_goods_all` */

DROP TABLE IF EXISTS `jy_goods_all`;

CREATE TABLE `jy_goods_all` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '物品表',
  `Name` varchar(255) NOT NULL COMMENT '物品名',
  `Code` varchar(20) NOT NULL COMMENT '物品标识',
  `ImgCode` varchar(20) NOT NULL COMMENT '物品图片标识',
  `CurrencyType` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '货币类型 1-人民币 2-金币 3-砖石',
  `CurrencyNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '货币数量',
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

insert  into `jy_goods_all`(`Id`,`Name`,`Code`,`ImgCode`,`CurrencyType`,`CurrencyNum`,`IssueNum`,`IssueType`,`Type`,`CateGory`,`GetNum`,`GiveInfo`,`ShowType`,`IsGroom`,`TheShelvesTime`,`Status`,`Platform`,`Proportion`,`FaceValue`,`LimitShop`,`LimitShopNum`,`ExchangeType`,`ExchangeNum`,`Describe`,`Broadcast`,`Push`,`Rmark`,`LimitLevel`,`LimitVip`,`Sort`,`IsDel`,`UpTime`,`DateTime`) values (3,'金币','32132','',1,321312,0,1,1,1,1231,'',1,0,NULL,1,1,0,NULL,1,0,1,0,'','ewqeqw','ewqeqw','ewqewq',0,0,1501136621,2,'2017-08-08 21:32:49','2017-07-26 23:23:41'),(4,'道具','','',1,1231,0,1,2,1,321321,'',1,0,NULL,3,1,0,NULL,2,32132,2,321312,'','ewqeqw','ewqeqw','ewqeqw',2,2,1501136698,2,'2017-07-27 23:28:14','2017-07-26 23:24:58'),(5,'砖石','123','',1,321312,0,1,1,1,321312,'{\"0\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"312312\"},\"2\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"3123321\"},\"3\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"1232132\"},\"4\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"321312\"},\"5\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"312312321\"},\"6\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"3213312\"},\"7\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"3123132\"},\"8\":{\"Type\":\"1\",\"Id\":\"0\",\"GetNum\":\"312321\"}}',1,0,NULL,3,1,12,NULL,4,321312,3,321,'','321312','312312','312312',2,2,1501140444,2,'2017-08-10 20:46:28','2017-07-27 00:27:24'),(6,'测试','321312','',1,321312,0,1,2,1,321312,'{\"0\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"312312\"},\"2\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"3123321\"},\"3\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"1232132\"},\"4\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"321312\"},\"5\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"312312321\"},\"6\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"3213312\"},\"7\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"3123132\"},\"8\":{\"Type\":\"1\",\"Id\":\"3\",\"GetNum\":\"312321\"}}',1,0,NULL,3,1,0,NULL,4,321312,3,321,'','321312','312312','312312',2,2,1501140448,2,'2017-08-10 20:46:26','2017-07-27 00:27:28'),(7,'测试1','1','',3,321312,233,2,1,2,321312,'[{\"Type\":\"1\",\"Id\":\"7\",\"GetNum\":\"1\"}]',1,0,NULL,1,1,0,NULL,4,321312,3,321,'1','1','1','1',2,2,1501140449,2,'2017-08-10 20:51:59','2017-07-27 00:27:29'),(8,'60000金币','60000','',1,6,0,1,1,1,60000,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423245,1,'2017-08-30 14:18:36','2017-08-10 20:47:25'),(9,'30万金币','300000','',1,30,0,1,1,1,300000,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423302,1,'2017-08-30 14:19:37','2017-08-10 20:48:22'),(10,'68万金币','680000','',1,68,0,1,1,1,680000,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423353,1,'2017-08-30 14:20:17','2017-08-10 20:49:13'),(11,'168万金币','1680000','',1,168,0,1,1,1,1680000,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423392,1,'2017-08-30 14:20:46','2017-08-10 20:49:52'),(12,'328万金币','3280000','',1,328,0,1,1,1,3280000,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423439,1,'2017-08-30 14:21:33','2017-08-10 20:50:39'),(13,'648万金币','6480000','',1,648,0,1,1,1,6480000,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423498,1,'2017-08-30 14:22:14','2017-08-10 20:51:38'),(14,'60钻石','60','321',1,6,0,1,2,2,60,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423611,1,'2017-08-30 14:23:05','2017-08-10 20:53:31'),(15,'300钻石','300','321',1,30,0,1,2,2,300,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423637,1,'2017-08-30 14:26:37','2017-08-10 20:53:57'),(16,'680钻石','680','321',1,68,0,1,2,2,680,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423719,1,'2017-08-30 14:26:13','2017-08-10 20:55:19'),(17,'1680钻石','1680','321',1,168,0,1,2,2,1680,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502423790,1,'2017-08-30 14:27:05','2017-08-10 20:56:30'),(18,'自动发炮','1004','gun_06_01.png',1,1,0,1,0,0,1,'',0,0,'1970-01-01',1,1,0,NULL,1,0,1,0,'','','','',0,0,1502856196,1,'2017-08-30 16:10:41','2017-08-15 21:03:16'),(19,'捕渔券概率提升','1005','card_big.png',1,0,0,1,0,0,1,'',0,0,'1970-01-01',1,1,0,NULL,1,0,1,0,'','','','',0,0,1502856414,1,'2017-08-30 16:09:59','2017-08-15 21:06:54'),(20,'3280钻石','3280','321',1,328,0,1,2,2,3280,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502856830,1,'2017-08-30 14:28:20','2017-08-15 21:13:50'),(21,'锁定','道具','',1,1,0,1,3,3,1,'',1,0,NULL,1,1,0,NULL,1,0,1,0,'','','','',0,0,1502857047,2,'2017-08-15 21:17:51','2017-08-15 21:17:27'),(22,'锁定','1002','',1,1,0,1,3,0,1,'',1,0,NULL,1,1,0,NULL,1,0,1,0,'','','','',0,0,1502857127,2,'2017-08-15 21:18:58','2017-08-15 21:18:47'),(23,'6480钻石','6480','321',1,648,0,1,2,2,6480,'',1,0,'1970-01-01',1,1,100,NULL,1,0,1,0,'','','','',0,0,1502866288,1,'2017-08-30 14:29:05','2017-08-15 23:51:28'),(24,'首冲礼包','1002','',1,6,0,1,1,4,1,'{\"0\":{\"Type\":\"1\",\"Id\":\"23\",\"GetNum\":\"666666\"},\"2\":{\"Type\":\"2\",\"Id\":\"20\",\"GetNum\":\"10\"}}',2,0,NULL,1,1,0,NULL,5,0,1,0,'首冲礼包','','','',0,0,1502866444,1,'2015-03-04 20:05:00','2017-08-15 23:54:04'),(25,'月卡','2312','',1,30,0,1,0,4,1,'{\"0\":{\"Type\":\"0\",\"Id\":\"18\",\"GetNum\":\"1\"},\"2\":{\"Type\":\"2\",\"Id\":\"19\",\"GetNum\":\"1\"},\"3\":{\"Type\":\"1\",\"Id\":\"36\",\"GetNum\":\"1\"},\"4\":{\"Type\":\"2\",\"Id\":\"37\",\"GetNum\":\"1\"},\"5\":{\"Type\":\"2\",\"Id\":\"27\",\"GetNum\":\"3\"},\"6\":{\"Type\":\"2\",\"Id\":\"26\",\"GetNum\":\"8\"}}',3,0,'1970-01-01',1,1,0,NULL,4,0,1,0,'','','','',0,0,1502868263,1,'2017-08-30 15:56:31','2017-08-16 00:24:23'),(26,'锁定*8/天','2','aim.png',1,1,0,1,3,3,8,'',1,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1502868358,1,'2017-08-31 20:58:48','2017-08-16 00:25:58'),(27,'冰冻*3/天','1','ice.png',1,1,0,1,3,3,3,'',1,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1502868462,1,'2017-08-31 20:58:57','2017-08-16 00:27:42'),(28,'10万金币','3123','coin.png',4,1000,0,1,1,1,100000,'',4,0,'1970-01-01',1,1,0,NULL,1,0,1,0,'','','','',0,0,1503649795,1,'2017-08-30 18:22:38','2017-08-25 01:29:55'),(29,'30万金币','321312','coin.png',4,3000,0,1,2,2,300000,'',4,0,'1970-01-01',1,1,0,NULL,1,0,1,0,'','','','',0,0,1503650087,1,'2017-08-30 18:22:08','2017-08-25 01:34:47'),(30,'青铜核弹','3','btnt1.png',4,2500,0,1,3,3,1,'',4,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1503650132,1,'2017-08-31 20:57:57','2017-08-25 01:35:32'),(31,'白银核弹','4','btnt2.png',4,12500,0,1,3,3,1,'',4,0,'1970-01-01',1,1,0,'',1,0,1,0,'','','','',0,0,1503652777,1,'2017-08-31 20:58:03','2017-08-25 02:19:37'),(32,'50元话费','321321','hf50.png',4,5000,0,1,0,0,1,'',4,0,'1970-01-01',1,1,0,NULL,1,0,1,0,'','','','',0,0,1503652851,1,'2017-08-30 18:27:56','2017-08-25 02:20:51'),(33,'100元话费','321321','hf100.png',4,10000,0,1,0,0,1,'',4,0,'1970-01-01',1,1,0,NULL,1,0,1,0,'','','','',0,0,1503657738,1,'2017-08-30 18:28:40','2017-08-25 03:42:18'),(34,'3211111','312111','32111',1,312,0,1,1,1,312,'',0,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1503914276,2,'2017-08-28 02:58:27','2017-08-28 02:58:27'),(35,'渔券','6','card_big.png',0,0,0,1,3,0,1,'',0,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1504065287,1,'2017-08-30 16:09:01','2017-08-29 20:54:47'),(36,'50000金币/天','50000','gold_2.png',1,0,0,1,1,0,50000,'',3,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1504079662,1,'2017-08-30 16:08:35','2017-08-30 00:54:22'),(37,'30钻石/天','30','diamond3.png',1,0,0,1,2,0,30,'',3,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1504079771,1,'2017-08-30 16:08:05','2017-08-30 00:56:11'),(38,'300元京东卡','66666','jd300.png',4,30000,0,1,5,3,1,'',4,0,'',1,1,0,'300',1,0,1,0,'','','','',0,0,1504089051,1,'2017-09-01 18:55:12','2017-08-30 03:30:51'),(39,'500元京东卡','77777','jd500.png',4,50000,0,1,5,1,1,'',4,0,'',1,1,0,'500',1,0,1,0,'','','','',0,0,1504089105,1,'2017-09-01 18:55:31','2017-08-30 03:31:45'),(40,'50元话费卡','312321','321321',4,50,0,1,4,0,1,'',4,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1504090689,1,'2017-08-30 03:58:41','2017-08-30 03:58:41'),(41,'10000金币','8888','coin.png',0,0,0,1,1,1,10000,'',0,0,'',1,1,0,NULL,1,0,1,0,'','','','',0,0,1504147778,1,'2017-08-30 19:49:38','2017-08-30 19:49:38');

/*Table structure for table `jy_pay_macroscopic_log` */

DROP TABLE IF EXISTS `jy_pay_macroscopic_log`;

CREATE TABLE `jy_pay_macroscopic_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '付费分析-宏观数据',
  `DailyIncome` varchar(255) NOT NULL COMMENT '日收入',
  `UserPayNum` int(11) NOT NULL COMMENT '付费用户数',
  `PayNum` int(11) unsigned NOT NULL COMMENT '付费次数',
  `PayRate` varchar(10) NOT NULL COMMENT '活跃付费渗透率',
  `ARPPU` varchar(10) NOT NULL COMMENT 'ARPPU',
  `FirstUserNum` int(11) NOT NULL COMMENT '首付用户数',
  `FirstDailyIncome` int(11) NOT NULL COMMENT '首付金额',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_pay_macroscopic_log` */

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

/*Table structure for table `jy_seven_days_sign_reward` */

DROP TABLE IF EXISTS `jy_seven_days_sign_reward`;

CREATE TABLE `jy_seven_days_sign_reward` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '七天签到奖励',
  `GoodsID` int(11) unsigned NOT NULL COMMENT '物品ID',
  `Type` tinyint(1) NOT NULL COMMENT '商品类型',
  `IsExceed` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否超过28天 1-否 2-是',
  `Number` int(11) NOT NULL COMMENT '数量',
  `Day` tinyint(2) NOT NULL COMMENT '天数',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`Id`),
  KEY `GoodsID` (`GoodsID`),
  KEY `Day` (`Day`),
  KEY `IsExceed` (`IsExceed`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `jy_seven_days_sign_reward` */

insert  into `jy_seven_days_sign_reward`(`Id`,`GoodsID`,`Type`,`IsExceed`,`Number`,`Day`,`DateTime`) values (15,3,1,1,312,7,'2017-08-03 04:30:17'),(14,4,2,1,321,1,'2017-08-03 04:30:02'),(13,5,1,1,45,0,'2017-08-03 04:28:13'),(16,3,1,2,321,1,'2017-08-09 23:32:49'),(17,6,2,2,3213,1,'2017-08-09 23:59:43'),(18,5,1,1,321,1,'2017-08-10 01:48:20');

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

insert  into `jy_system_menu`(`id`,`name`,`icon`,`url`,`sort`,`islock`,`upid`,`remark`,`mtime`) values (1,'系统管理','','###',0,1,0,'','2017-07-11 17:19:33'),(2,'菜单列表','','/jy_admin/menu/index',1,1,1,'','2017-07-10 19:21:22'),(3,'管理员','','/jy_admin/AdminUsers/index',2,1,1,'','2017-07-10 19:24:37'),(4,'管理员组','','/jy_admin/admingroup/index',3,1,1,'','2017-07-10 19:25:13'),(5,'渠道管理','','###',1,1,0,'','2017-07-11 17:19:46'),(6,'渠道列表','','/jy_admin/Channel/index',0,1,5,'','2017-07-10 19:32:45'),(7,'渠道数据','','###',0,1,5,'','2017-07-10 19:26:28'),(9,'全局数据','','###',3,1,0,'','2017-07-11 17:20:20'),(10,'全局数据','','/jy_admin/GlobalData/index',1,1,9,'','2017-07-11 18:22:13'),(14,'注册分析','','###',4,1,0,'','2017-07-11 17:07:06'),(15,'宏观数据','','/jy_admin/RegisterMacroscopic/index',0,1,14,'','2017-07-14 10:06:32'),(16,'版本分布','','/jy_admin/RegisterEdition/index',1,1,14,'','2017-07-17 15:20:59'),(17,'等级分布','','###',3,1,14,'','2017-07-11 17:11:37'),(18,'网络分布','','###',2,1,14,'','2017-07-17 15:16:58'),(19,'地域分布','','###',5,1,14,'','2017-07-11 17:10:22'),(20,'渠道分布','','渠道分布',6,1,14,'','2017-07-11 17:10:14'),(21,'活跃分析','','###',5,1,0,'','2017-07-11 17:12:36'),(22,'宏观数据','','/jy_admin/ActiveMacroscopic/index',1,1,21,'','2017-07-17 16:33:13'),(23,'等级分布','','/jy_admin/ActiveLevel/index',2,1,21,'','2017-07-18 10:46:26'),(24,'版本分布','','/jy_admin/ActiveEdition/index',3,1,21,'','2017-07-18 11:22:07'),(25,'渠道分布','','###',4,1,21,'','2017-07-11 17:17:11'),(26,'道具分布','','###',5,1,21,'','2017-07-11 17:17:27'),(27,'实时数据','','###',6,1,0,'','2017-07-11 17:18:34'),(28,'实时概况','','###',1,1,27,'','2017-07-11 17:18:55'),(29,'实时在线','','###',2,1,27,'','2017-07-11 17:21:44'),(30,'实时收入','','###',0,1,27,'','2017-07-11 17:22:05'),(31,'留存分析','','###',6,1,0,'','2017-07-11 17:22:54'),(32,'留存数据','','/jy_admin/RetainedData/index',0,1,31,'','2017-07-19 18:02:31'),(33,'流失数据','','###',1,1,31,'','2017-07-11 17:24:09'),(34,'回流数据','','###',2,1,31,'','2017-07-19 17:37:43'),(35,'付费分析','','###',7,1,0,'','2017-07-11 17:26:06'),(36,'宏观数据','','/jy_admin/PayMacroscopic/index',0,1,35,'','2017-07-24 16:42:04'),(37,'货币流水','','###',8,1,0,'','2017-07-11 17:29:30'),(38,'金币流水','','###',0,1,37,'','2017-07-11 17:27:28'),(39,'钻石流水','','###',1,1,37,'','2017-07-11 17:27:59'),(40,'道具流水','','###',2,1,37,'','2017-07-11 17:28:15'),(41,'场次数据','','###',8,1,0,'','2017-07-11 17:28:31'),(42,'用户中心','###','###',2,1,0,'','2017-07-11 17:52:45'),(43,'用户列表','','/jy_admin/UsersInfo/index',1,1,42,'','2017-08-29 05:52:52'),(44,'金币分布','','/jy_admin/ActiveGold/index',2,1,21,'','2017-07-19 12:07:07'),(45,'钻石分布','','/jy_admin/ActiveDiamond/index',3,1,21,'','2017-07-19 17:14:53'),(46,'大厅配置','','####',3,1,0,'','2017-07-25 15:36:59'),(47,'商品列表','','/jy_admin/GoodsAll/index',0,1,46,'','2017-07-26 01:04:55'),(48,'七天签到（前四周）','','/jy_admin/SevenDaysSign/index',1,1,46,'','2017-08-09 23:40:48'),(49,'活动列表','','/jy_admin/activityList/index',3,1,46,'','2017-08-11 00:04:06'),(50,'vip等级','','/jy_admin/VipInfo/index',1,1,42,'','2017-07-25 19:08:24'),(59,'发送邮件','','/jy_admin/SendEmail/index',0,1,42,'','2017-08-31 23:27:31'),(52,'支付管理','','###',3,1,0,'','2017-07-25 15:51:29'),(53,'支付配置','','/jy_admin/ThirdpayInfo/index',0,1,52,'','2017-07-31 03:12:01'),(54,'所有订单','###','/jy_admin/UsersOrder/index',4,1,42,'','2017-08-02 01:43:15'),(55,'七天签到（后四周）','','/jy_admin/SevenDaysSignReward/index',2,1,46,'','2017-08-28 02:02:00'),(57,'用户属性','###','/jy_admin/UsersAttribute/index',1,1,42,'','2017-08-28 04:13:56'),(58,'兑换申请','','/jy_admin/UsersExchangeApplication/index',2,1,42,'','2017-08-30 19:13:52');

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
  `CardNotifyurl` varchar(255) NOT NULL COMMENT '月卡回调通知',
  `TheFirstNotifyurl` varchar(255) NOT NULL COMMENT '首冲回调',
  `MallShopNotifyurl` varchar(255) NOT NULL COMMENT '商城充值回调',
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `jy_thirdpay` */

insert  into `jy_thirdpay`(`Id`,`Name`,`Type`,`Platform`,`PassAgeWay`,`Recommend`,`public`,`private`,`appid`,`partner`,`account`,`Sort`,`CardNotifyurl`,`TheFirstNotifyurl`,`MallShopNotifyurl`,`Describe`,`Support`,`VersionStart`,`VersionEnd`,`IsDel`,`DateTime`) values (6,'爱贝',3,1,'iappay',1,'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDtv7IzXBGp486UAFwaLIXsSua8JiTSe5kSKU6IXNiJxZIMZ/2dlKOV66hFIQjP/0u8YV9Du+uk8/3nmTMhdBpanzp9awkXnO2g104ng9x34YxoDMMv24MmOhT7c2mnhCuEyFbz/KkvnhzQn6L+MAwYvkkQInpw/ArHDJ0NkbyJNQIDAQAB','MIICXAIBAAKBgQCR/ZyLQ7Z2pCv8sZcNuqDcgEoEhPQPOT9Ci8l43mIBhjbSCIPuDPiiZJJ9HjaMpy+X1cUZP1SY9TtZDzA3R5pAWd1HY+Ps/Q8aDiRou2mNESlWor5/xmG8TcQcWLshS3VzHWz4cY7i8o+EIACfHbDTSTkqTxCIyjw1BYxGTyqLVwIDAQABAoGAGDGseNPu8DiC5azUuLy+HezQ13DlNYSqPDAIYpSQL2p7uVEZ9CCIL/l04XFZXvPyCjquIGIDdhnmDPtcZTzjjhfltp6N3Uqmtp4D2cPWruR6B2icvve2bno2Lu6OULuAYyEkVMHCdEf5GSSHjShIG6CBahHfHZhWzjoPYZWAZ9ECQQDd/NGvmzcLVHOXM4muml6leF9OmQNqA+qVec9Sqb39t2CNJY4QxdJ/AzQnLeskqVBydQm60P2lbi3M1eCMW+sPAkEAqFvpB1vgkj6dlbySyHGu5mzTiJBRSVvz4c5XAA01iLCNPGdtQGT7jslnkyueXMwdiq3pBDpGuzL9v9QIuw17OQJADv+h+0d1dKKEHNcymkV715pGdj0IagVRuD++rkshtx7Iu0CqVJ/JFSPWRj9n/9YgxVr7CVBNkvvaxFg/D7y2KQJARCqKjG832x69IU5rw/q7jRKNB2MfdmtjsI6iDSRMA58wYD+kLYl1jReg9yaXBQ2j/G1zxkFuOAdqVEweiNXpiQJBAJjblicX+Y7y0EwKfOXP9oU2KjbxGAy5Et5AL+6AdloVbjZAU1o3LYfjuCz+YaU3jPx38FIT1Npe/WWIuTyusZ8=','3015007654','','',1,'http://testphp.juyihd.com/Jy_ThirdpayIapppay/CardBack/index','http://testphp.juyihd.com/Jy_ThirdpayIapppay/TheFirstPunchBack/index','http://testphp.juyihd.com/Jy_ThirdpayIapppay/MallShopBack/index','1',2,'','',1,'2017-08-23 23:20:31'),(7,'321321',1,1,'321321',2,'312321321','1',NULL,'321312','32131232',1,'312321321','32131232121','321312321','',2,'','',1,'2017-08-30 01:34:20'),(8,'3213',2,1,'32321',1,NULL,'312321','321321','323213',NULL,1,'321321','321321','32321','321312',2,'','',1,'2017-08-30 01:37:42'),(9,'3123',3,1,'321312',1,'321321','312312','312321',NULL,NULL,2,'31231232','312321','3123123','31232',2,'','',2,'2017-08-30 01:39:29');

/*Table structure for table `jy_user_active_diamond_logo` */

DROP TABLE IF EXISTS `jy_user_active_diamond_logo`;

CREATE TABLE `jy_user_active_diamond_logo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '活跃砖石',
  `company` int(4) NOT NULL COMMENT 'company表 id',
  `Num` int(11) NOT NULL COMMENT '用户数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `company` (`company`),
  KEY `DateTime` (`DateTime`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `jy_user_active_diamond_logo` */

insert  into `jy_user_active_diamond_logo`(`id`,`company`,`Num`,`DateTime`) values (1,1,0,'2017-07-18 17:23:03'),(2,2,0,'2017-07-18 17:23:03'),(3,3,0,'2017-07-18 17:23:03'),(4,4,0,'2017-07-18 17:23:03'),(5,5,0,'2017-07-18 17:23:03'),(6,6,0,'2017-07-18 17:23:03');

/*Table structure for table `jy_user_active_edition_logo` */

DROP TABLE IF EXISTS `jy_user_active_edition_logo`;

CREATE TABLE `jy_user_active_edition_logo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '活跃版本',
  `num` int(11) unsigned NOT NULL COMMENT '数目',
  `Edition` varchar(10) NOT NULL COMMENT '版本',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `jy_user_active_edition_logo` */

insert  into `jy_user_active_edition_logo`(`id`,`num`,`Edition`,`DateTime`) values (1,30,'1.0.0','2017-07-18 10:56:04'),(2,40,'1.0.0','2017-07-17 10:56:21'),(3,55,'1.0.2','2017-07-18 10:56:41'),(4,60,'1.0.2','2017-07-17 10:56:58'),(5,11,'1.0.1','2017-07-18 10:57:27'),(6,12,'1.0.1','2017-07-17 10:57:38');

/*Table structure for table `jy_user_active_gold_logo` */

DROP TABLE IF EXISTS `jy_user_active_gold_logo`;

CREATE TABLE `jy_user_active_gold_logo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '活跃-金币-砖石',
  `company` int(4) unsigned NOT NULL COMMENT '单位ID',
  `Num` int(11) NOT NULL COMMENT '数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '日期',
  PRIMARY KEY (`id`),
  KEY `company` (`company`),
  KEY `DateTime` (`DateTime`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `jy_user_active_gold_logo` */

insert  into `jy_user_active_gold_logo`(`id`,`company`,`Num`,`DateTime`) values (2,1,1,'2017-07-17 16:10:12'),(3,2,1,'2017-07-17 16:10:12'),(4,3,2,'2017-07-17 16:51:10'),(5,4,0,'2017-07-17 16:10:12'),(6,5,0,'2017-07-17 16:10:12'),(7,6,0,'2017-07-17 16:10:12'),(8,1,0,'2017-07-18 16:10:57'),(9,2,0,'2017-07-18 16:10:57'),(10,3,3,'2017-07-18 16:50:00'),(11,4,0,'2017-07-18 16:10:57'),(12,5,0,'2017-07-18 16:10:57'),(13,6,0,'2017-07-18 16:10:57');

/*Table structure for table `jy_useractivelevellogo` */

DROP TABLE IF EXISTS `jy_useractivelevellogo`;

CREATE TABLE `jy_useractivelevellogo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '活跃分析-等级分布',
  `level` int(4) unsigned NOT NULL COMMENT '等级',
  `num` int(11) unsigned NOT NULL COMMENT '数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '参建时间',
  PRIMARY KEY (`id`),
  KEY `level` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `jy_useractivelevellogo` */

insert  into `jy_useractivelevellogo`(`id`,`level`,`num`,`DateTime`) values (1,1,32,'2017-07-18 20:27:38'),(2,2,3,'2017-07-18 20:27:43'),(3,3,43,'2017-07-18 20:27:49'),(4,1,32,'2017-07-17 20:28:23'),(5,2,0,'2017-07-17 20:28:33'),(6,3,4,'2017-07-17 20:28:35'),(7,3,22,'2017-07-16 10:24:47'),(8,3,1223,'2017-07-15 10:25:52');

/*Table structure for table `jy_useractivemacroscopiclogo` */

DROP TABLE IF EXISTS `jy_useractivemacroscopiclogo`;

CREATE TABLE `jy_useractivemacroscopiclogo` (
  `id` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT '活跃分析-宏观数据',
  `DAU` int(11) unsigned NOT NULL COMMENT '活跃人数',
  `WAU` int(11) NOT NULL COMMENT '前推7日（当日计入天数）',
  `MAU` int(11) NOT NULL COMMENT '前推30日（当日计入天数）',
  `UserGame` int(11) NOT NULL COMMENT '活跃游戏用户数目',
  `Bankruptcy` int(11) NOT NULL COMMENT '破产用户数目',
  `Bankruptcy30` int(11) NOT NULL COMMENT '破产且在30分钟内付费的用户数',
  `level` int(4) NOT NULL COMMENT '等级',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `DateTime` (`DateTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_useractivemacroscopiclogo` */

/*Table structure for table `jy_userbankruptcylog` */

DROP TABLE IF EXISTS `jy_userbankruptcylog`;

CREATE TABLE `jy_userbankruptcylog` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户破产表',
  `UserID` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `DataTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '破产时间',
  PRIMARY KEY (`id`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `jy_userbankruptcylog` */

insert  into `jy_userbankruptcylog`(`id`,`UserID`,`DataTime`) values (1,10012,'2017-06-29 17:35:58');

/*Table structure for table `jy_userlevel` */

DROP TABLE IF EXISTS `jy_userlevel`;

CREATE TABLE `jy_userlevel` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户等级表',
  `level` int(4) unsigned NOT NULL COMMENT '等级',
  PRIMARY KEY (`id`),
  KEY `leve` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `jy_userlevel` */

insert  into `jy_userlevel`(`id`,`level`) values (1,1),(2,2),(3,3),(4,4),(5,5);

/*Table structure for table `jy_users_activity_log` */

DROP TABLE IF EXISTS `jy_users_activity_log`;

CREATE TABLE `jy_users_activity_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户活动记录表',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `Code` varchar(20) NOT NULL COMMENT '活动标识',
  `Number` int(11) NOT NULL COMMENT '数量',
  `ActivityID` int(11) unsigned NOT NULL COMMENT '活动ID',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_activity_log` */

/*Table structure for table `jy_users_activity_reward_log` */

DROP TABLE IF EXISTS `jy_users_activity_reward_log`;

CREATE TABLE `jy_users_activity_reward_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户活动奖励记录',
  `activityID` int(11) DEFAULT NULL,
  `Code` varchar(20) DEFAULT NULL,
  `GoodsID` int(11) DEFAULT NULL,
  `Number` int(11) DEFAULT NULL,
  `playerid` bigint(20) DEFAULT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_activity_reward_log` */

insert  into `jy_users_activity_reward_log`(`Id`,`activityID`,`Code`,`GoodsID`,`Number`,`playerid`,`DateTime`) values (1,3,'321',312,321,1,'2017-08-14 18:54:13'),(2,3,'321',321,3321,1,'2017-08-14 18:54:15'),(3,5,NULL,321,32,1,'2017-08-14 18:55:05');

/*Table structure for table `jy_users_activity_theaward_log` */

DROP TABLE IF EXISTS `jy_users_activity_theaward_log`;

CREATE TABLE `jy_users_activity_theaward_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户领奖记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `GoodsId` int(11) unsigned NOT NULL COMMENT '物品ID',
  `GoodsName` varchar(50) NOT NULL COMMENT '物品名',
  `activityID` int(11) unsigned NOT NULL COMMENT '活动ID',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '活动类型',
  `Number` int(11) unsigned NOT NULL COMMENT '获得数量',
  `AddUpStartTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '计费开始时间',
  `AddUpEndTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '计费结束时间',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '领取时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`AddUpStartTime`,`AddUpEndTime`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_activity_theaward_log` */

insert  into `jy_users_activity_theaward_log`(`Id`,`playerid`,`GoodsId`,`GoodsName`,`activityID`,`Type`,`Number`,`AddUpStartTime`,`AddUpEndTime`,`DateTime`) values (1,1,321,'认为',3,1,321,'2017-08-14 09:56:50','2017-08-31 09:56:56','2017-08-14 18:57:03'),(2,1,312,'大数',8,3,321,'2017-08-14 09:58:33','2017-08-31 09:58:36','2017-08-14 18:58:32');

/*Table structure for table `jy_users_card_receive_log` */

DROP TABLE IF EXISTS `jy_users_card_receive_log`;

CREATE TABLE `jy_users_card_receive_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '月卡领取奖励',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`DateTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_card_receive_log` */

/*Table structure for table `jy_users_card_shop_log` */

DROP TABLE IF EXISTS `jy_users_card_shop_log`;

CREATE TABLE `jy_users_card_shop_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户月卡购买记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户Id',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_card_shop_log` */

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
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_exchange_log` */

insert  into `jy_users_exchange_log`(`Id`,`GoodsName`,`Number`,`Order`,`StockNum`,`playerid`,`Status`,`MessAge`,`GoodsID`,`UpTime`,`DateTime`) values (1,'312',1,'312',321,100171,1,NULL,40,NULL,'2017-08-27 23:20:58'),(2,'500金币',1,'LCVo5191',321,100171,1,'321大时代时代峰峻含税单价开放还是对接客服华东师大尽快发货dsajk\r\nfdsjfsd\r\ngfdjgkdfl',40,NULL,'2017-08-27 23:47:27'),(3,'500金币',1,'sFbC4007',321,100171,1,'',40,NULL,'2017-08-27 23:47:38'),(4,'500金币',1,'IEJy9934',321,100171,1,'eqwewqewqewqeqwfsdfhklsdajfksdljfsdklfjsdkljfsdklajfsdklfjsdakljfdskljfdklsafjsdlkjkldsahkjdjsak',40,NULL,'2017-08-27 23:47:43'),(5,'500金币',1,'xwqo0383',321,100171,2,'',40,'2017-09-01 11:22:55','2017-08-27 23:47:44'),(6,'500金币',1,'wUgO6879',321,100171,2,'',40,NULL,'2017-08-27 23:47:46'),(7,'500金币',1,'KBis4815',32,100171,3,'fsdafsdhjkfsdhjkfdsa\r\nfsdjhfsdjk\r\ngfjsdhfksd',40,'2017-09-01 11:22:31','2017-08-27 23:47:47'),(8,'500金币',1,'ClhB7552',32,100171,3,'32132132123321',40,NULL,'2017-08-27 23:47:49'),(9,'500金币',1,'YGEZ0959',32,100171,3,NULL,40,NULL,'2017-08-27 23:47:50'),(10,'500金币',1,'qRKz2050',32,100171,2,NULL,40,NULL,'2017-08-27 23:47:52'),(11,'500金币',1,'MVEg7969',32,100171,2,'',40,NULL,'2017-08-27 23:47:53'),(12,'500金币',1,'nipw6378',32,100171,2,NULL,40,NULL,'2017-08-27 23:47:54'),(13,'500金币',1,'bhNV4103',32,100171,2,NULL,40,NULL,'2017-08-27 23:47:55'),(14,'500金币',1,'nqfv3535',32,100171,2,NULL,40,NULL,'2017-08-27 23:47:56'),(15,'500金币',1,'frLS4334',32,100171,2,NULL,40,NULL,'2017-08-27 23:48:00'),(16,'500金币',1,'RDha4533',32,100171,2,NULL,40,NULL,'2017-08-27 23:48:03'),(17,'500金币',1,'xwGT5515',312,100171,2,NULL,40,NULL,'2017-08-27 23:48:05'),(18,'500金币',1,'FBHo4610',321,100171,2,NULL,40,NULL,'2017-08-27 23:48:07'),(19,'500金币',1,'inDi7766',321,100171,2,NULL,40,NULL,'2017-08-27 23:56:23'),(20,'500金币',1,'LjRE9016',321,100171,2,NULL,40,NULL,'2017-08-27 23:56:29'),(21,'500金币',1,'UKMG1284',321,100171,2,NULL,40,NULL,'2017-08-27 23:56:32'),(22,'500金币',1,'nJmo9217',321,100100,2,NULL,28,NULL,'2017-08-27 23:56:33'),(23,'500金币',1,'VMHB1423',32,100100,2,NULL,28,NULL,'2017-08-27 23:56:53'),(24,'500金币',1,'Wpse5424',321,100100,2,NULL,28,NULL,'2017-08-27 23:58:55'),(25,'500金币',1,'NRUV9703',321,100100,2,NULL,28,NULL,'2017-08-28 00:01:57'),(26,'500金币',1,'VPps8690',321,100100,2,NULL,28,NULL,'2017-08-28 00:11:49'),(27,'500金币',1,'pdsk7584',321,246233,2,NULL,28,NULL,'2017-08-28 00:59:27'),(28,'500金币',1,'bQrI3113',321,246233,2,NULL,28,NULL,'2017-08-28 01:01:53'),(29,'500金币',1,'qppF2954',321,246233,2,NULL,28,NULL,'2017-08-28 01:18:43'),(30,'500金币',1,'hOoG6635',0,246233,2,NULL,28,NULL,'2017-08-28 01:18:45'),(31,'50砖石',1,'TgEv1685',0,246233,2,NULL,31,NULL,'2017-08-28 01:18:47'),(32,'50砖石',1,'Kvhd4994',0,246233,2,NULL,31,NULL,'2017-08-28 03:17:58'),(33,'500金币',1,'hQDF5225',0,246233,2,NULL,28,NULL,'2017-08-28 03:19:05'),(34,'500金币',1,'LcVB3916',0,246233,2,NULL,28,NULL,'2017-08-28 03:19:23'),(35,'500金币',1,'TAnr8696',0,246233,2,NULL,28,NULL,'2017-08-28 03:19:33'),(36,'500金币',1,'dWRj0102',0,246233,2,NULL,28,NULL,'2017-08-28 03:19:48'),(37,'500金币',1,'yrTg2085',0,246233,2,NULL,28,NULL,'2017-08-28 03:21:44'),(38,'500金币',1,'wFQQ1845',0,246233,2,NULL,28,NULL,'2017-08-28 03:23:10'),(39,'500金币',1,'FFzr6475',0,246233,2,NULL,28,NULL,'2017-08-28 03:23:45'),(40,'500金币',1,'qCwR8547',0,246233,2,NULL,28,NULL,'2017-08-28 03:25:19'),(41,'500金币',1,'gMEn3042',0,246233,2,NULL,28,NULL,'2017-08-28 03:56:21'),(42,'500金币',1,'Udar3271',0,246233,2,NULL,28,NULL,'2017-08-28 03:57:26'),(43,'500金币',1,'SYbo0121',0,246233,2,NULL,28,NULL,'2017-08-28 03:59:07'),(44,'500金币',1,'zqBR6029',0,246233,2,NULL,28,NULL,'2017-08-28 04:01:22'),(45,'500金币',1,'IDrD7991',0,246233,2,NULL,28,NULL,'2017-08-28 04:03:44'),(46,'500金币',1,'bUnC7048',0,246233,2,NULL,28,NULL,'2017-08-28 18:53:36'),(47,'500金币',1,'PRHh0849',0,246233,2,NULL,28,NULL,'2017-08-28 18:53:44'),(48,'500金币',1,'jtZm3368',0,246233,2,NULL,28,NULL,'2017-08-28 19:30:13'),(49,'500金币',1,'LvEg9569',0,100614,2,NULL,28,NULL,'2017-08-29 05:40:49'),(50,'6砖石',1,'uHnj2679',0,100614,2,NULL,29,NULL,'2017-08-29 05:40:54'),(51,'500金币',1,'sFTl1405',0,100614,2,NULL,28,NULL,'2017-08-29 05:41:05'),(52,'6砖石',1,'VNxh9209',0,100614,2,NULL,29,NULL,'2017-08-29 05:41:11'),(53,'500金币',1,'oFVl0140',0,246424,2,NULL,28,NULL,'2017-08-30 00:39:49'),(54,'500金币',1,'VjGz0289',0,246424,2,NULL,28,NULL,'2017-08-30 00:39:55'),(55,'6砖石',1,'qQbT9315',0,246424,2,NULL,29,NULL,'2017-08-30 00:39:58'),(56,'6砖石',1,'VbZU7216',0,246425,2,NULL,29,NULL,'2017-08-30 00:41:42'),(57,'500金币',1,'MlHT6954',0,246447,2,NULL,28,NULL,'2017-08-30 01:46:26'),(58,'500金币',1,'AbHT1372',0,246447,2,NULL,28,NULL,'2017-08-30 01:46:29'),(59,'6砖石',1,'IWye2856',0,246447,2,NULL,29,NULL,'2017-08-30 01:46:34'),(60,'青铜核弹',1,'vDsv4941',0,100167,2,NULL,30,NULL,'2017-08-31 05:49:30'),(61,'青铜核弹',1,'sKyI2497',0,100167,2,NULL,30,NULL,'2017-08-31 05:50:56'),(62,'青铜核弹',1,'MeHg7046',0,100167,2,NULL,30,NULL,'2017-08-31 05:50:59'),(63,'青铜核弹',1,'DAUu7525',0,100167,2,NULL,30,NULL,'2017-08-31 05:51:03'),(64,'青铜核弹',1,'Iugl9264',0,100167,2,NULL,30,NULL,'2017-08-31 05:51:06'),(65,'青铜核弹',1,'qlRu7534',0,100167,2,NULL,30,NULL,'2017-08-31 05:51:08'),(66,'青铜核弹',1,'EpJT1558',0,100167,2,NULL,30,NULL,'2017-08-31 05:51:09'),(67,'青铜核弹',1,'osho7481',0,100167,2,NULL,30,NULL,'2017-08-31 05:51:11'),(68,'青铜核弹',1,'MgDE8151',0,100167,2,NULL,30,NULL,'2017-08-31 05:51:12'),(69,'青铜核弹',1,'oQeL0234',0,100168,2,NULL,30,NULL,'2017-08-31 05:53:44'),(70,'白银核弹',1,'DLEx8947',0,100166,2,NULL,31,NULL,'2017-08-31 05:54:30'),(71,'青铜核弹',1,'lkMa6947',0,100168,2,NULL,30,NULL,'2017-08-31 05:55:10'),(72,'青铜核弹',1,'zusX5840',0,100168,2,NULL,30,NULL,'2017-08-31 05:55:11'),(73,'青铜核弹',1,'ajgx8279',0,100168,2,NULL,30,NULL,'2017-08-31 05:55:13'),(74,'青铜核弹',1,'LrTQ2029',0,100168,2,NULL,30,NULL,'2017-08-31 05:55:14'),(75,'青铜核弹',1,'IBXJ3134',0,100168,2,NULL,30,NULL,'2017-08-31 05:55:16'),(76,'青铜核弹',1,'RaPY9354',0,100168,2,NULL,30,NULL,'2017-08-31 05:55:17'),(77,'青铜核弹',1,'KtLP0417',0,100169,2,NULL,30,NULL,'2017-08-31 05:59:35'),(78,'青铜核弹',1,'ucgN7383',0,100169,2,NULL,30,NULL,'2017-08-31 06:00:40'),(79,'青铜核弹',1,'anJS0222',0,100169,2,NULL,30,NULL,'2017-08-31 06:00:50'),(80,'青铜核弹',1,'shiz6232',0,100169,2,NULL,30,NULL,'2017-08-31 06:00:56'),(81,'白银核弹',1,'XGRC0712',0,100169,2,NULL,31,NULL,'2017-08-31 06:01:59'),(82,'300元京东卡',1,'ybzJ4138',0,100169,2,NULL,38,NULL,'2017-08-31 06:02:05'),(83,'300元京东卡',1,'hJBE1108',0,100169,2,NULL,38,NULL,'2017-08-31 06:02:43'),(84,'青铜核弹',1,'dbPi2467',0,100169,2,NULL,30,NULL,'2017-08-31 06:09:52'),(85,'白银核弹',1,'DRAV8696',0,100169,2,NULL,31,NULL,'2017-08-31 06:09:53'),(86,'青铜核弹',1,'Wghc4037',0,100169,2,NULL,30,NULL,'2017-08-31 06:09:59'),(87,'白银核弹',1,'BeUV3067',0,100169,2,NULL,31,NULL,'2017-08-31 06:10:00'),(88,'300元京东卡',1,'JjGr7966',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:01'),(89,'300元京东卡',1,'Tlbs8251',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:03'),(90,'300元京东卡',1,'Ytvr6489',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:04'),(91,'300元京东卡',1,'aXdi9075',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:04'),(92,'300元京东卡',1,'qSrS6037',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:04'),(93,'300元京东卡',1,'qNoq2413',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:05'),(94,'300元京东卡',1,'ptbZ3042',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:05'),(95,'300元京东卡',1,'zVsx9603',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:06'),(96,'300元京东卡',1,'whjX3482',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:06'),(97,'300元京东卡',1,'ouCj9531',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:07'),(98,'300元京东卡',1,'tutY4658',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:07'),(99,'300元京东卡',1,'iAGY7796',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:08'),(100,'300元京东卡',1,'DeCQ8247',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:08'),(101,'300元京东卡',1,'cQSm0946',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:08'),(102,'300元京东卡',1,'NJev6945',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:09'),(103,'300元京东卡',1,'HEge9522',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:09'),(104,'300元京东卡',1,'ISlI1889',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:09'),(105,'300元京东卡',1,'wfZg3032',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:10'),(106,'300元京东卡',1,'hwTU5379',0,100169,2,NULL,38,NULL,'2017-08-31 06:10:11'),(107,'青铜核弹',1,'Zept3816',0,100170,2,NULL,30,NULL,'2017-08-31 06:10:59'),(108,'青铜核弹',1,'ilVH3537',0,100171,2,NULL,30,NULL,'2017-08-31 06:14:11'),(109,'300元京东卡',1,'UzYf7897',0,100171,2,NULL,38,NULL,'2017-08-31 06:15:07'),(110,'300元京东卡',1,'uuiW5702',30000,100171,2,NULL,38,NULL,'2017-08-31 06:18:22'),(111,'300元京东卡',1,'nckb1672',30000,100171,2,NULL,38,NULL,'2017-08-31 06:20:36'),(112,'300元京东卡',1,'KCol6596',30000,100171,2,NULL,38,NULL,'2017-08-31 06:20:48'),(113,'300元京东卡',1,'Yjnb3289',30000,100171,2,NULL,38,NULL,'2017-08-31 06:23:06'),(114,'300元京东卡',1,'uenb3617',30000,100171,2,NULL,38,NULL,'2017-08-31 06:29:00');

/*Table structure for table `jy_users_gold_change_log` */

DROP TABLE IF EXISTS `jy_users_gold_change_log`;

CREATE TABLE `jy_users_gold_change_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户金币变化',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `Type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型 1-游戏 2-充值 3-签到 4-购买道具',
  `StartMoney` binary(20) NOT NULL,
  `ChangeMoney` bigint(20) NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_gold_change_log` */

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
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_goods_stream` */

insert  into `jy_users_goods_stream`(`Id`,`playerid`,`Code`,`Type`,`Income`,`Number`,`DateTime`) values (1,100141,'123',3,0,103141152,'2017-08-10 01:55:01'),(2,100141,'123',3,0,103141152,'2017-08-10 01:55:04'),(3,100141,'123',3,0,103141152,'2017-08-10 01:55:20'),(4,100141,'123',3,0,103141152,'2017-08-10 02:02:17'),(5,100141,'123',3,0,103141152,'2017-08-10 02:02:49'),(6,100141,'123',3,0,103141152,'2017-08-10 02:05:53'),(7,100141,'123',3,0,103141152,'2017-08-10 02:05:56'),(8,100141,'123',3,0,103141152,'2017-08-10 02:06:01'),(9,100141,'123',3,0,103141152,'2017-08-10 02:06:32'),(10,100164,'123',3,0,103141152,'2017-08-10 02:08:33'),(11,100164,'123',3,0,103141152,'2017-08-10 02:08:37'),(12,100164,'123',3,0,103141152,'2017-08-10 02:08:47'),(13,100164,'123',3,0,103141152,'2017-08-10 02:08:50'),(14,100164,'123',3,0,103141152,'2017-08-10 02:10:43'),(15,100164,'123',3,0,103141152,'2017-08-10 02:10:48'),(16,100164,'123',3,0,103141152,'2017-08-10 02:34:04'),(17,100164,'500',3,0,1000,'2017-08-15 20:06:50'),(18,100453,'500',3,0,500,'2017-08-15 21:29:35'),(19,100454,'500',3,0,500,'2017-08-15 21:54:54'),(20,100455,'500',3,0,500,'2017-08-15 21:57:15'),(21,100456,'500',3,0,500,'2017-08-15 21:57:46'),(22,100457,'500',3,0,500,'2017-08-15 22:02:29'),(23,100460,'500',3,0,500,'2017-08-15 22:05:31'),(24,100461,'500',3,0,500,'2017-08-15 22:13:29'),(25,100464,'500',3,0,500,'2017-08-15 23:14:22'),(26,100465,'500',3,0,500,'2017-08-15 23:15:15'),(27,100466,'500',3,0,500,'2017-08-15 23:16:39'),(28,100467,'500',3,0,500,'2017-08-15 23:21:47'),(29,100468,'500',3,0,500,'2017-08-15 23:23:56'),(30,100469,'500',3,0,500,'2017-08-15 23:26:01'),(31,100470,'500',3,0,500,'2017-08-15 23:28:34'),(32,100475,'500',3,0,500,'2017-08-15 23:31:39'),(33,100477,'500',3,0,500,'2017-08-15 23:34:30'),(34,100478,'500',3,0,500,'2017-08-15 23:35:00'),(35,100479,'500',3,0,500,'2017-08-15 23:36:34'),(36,100480,'500',3,0,500,'2017-08-15 23:36:49'),(37,100482,'500',3,0,500,'2017-08-15 23:40:24'),(38,100483,'500',3,0,500,'2017-08-15 23:49:48'),(39,100487,'500',3,0,500,'2017-08-15 23:52:20'),(40,100488,'500',3,0,500,'2017-08-15 23:53:40'),(41,100489,'500',3,0,500,'2017-08-16 00:08:32'),(42,100494,'500',3,0,500,'2017-08-16 00:28:57'),(43,100495,'500',3,0,500,'2017-08-16 00:29:38'),(44,100496,'500',3,0,500,'2017-08-16 00:30:30'),(45,100497,'500',3,0,500,'2017-08-16 00:35:25'),(46,100498,'500',3,0,500,'2017-08-16 00:35:55'),(47,100499,'500',3,0,500,'2017-08-16 00:37:09'),(48,100507,'500',3,0,500,'2017-08-16 00:59:29'),(49,100508,'500',3,0,500,'2017-08-16 01:00:18'),(50,100509,'500',3,0,500,'2017-08-16 01:00:42'),(51,100514,'500',3,0,500,'2017-08-16 01:17:08'),(52,100515,'500',3,0,500,'2017-08-16 01:17:32'),(53,100516,'500',3,0,500,'2017-08-16 01:17:56'),(54,100519,'500',3,0,500,'2017-08-16 01:20:32'),(55,100520,'500',3,0,500,'2017-08-16 01:34:46'),(56,100522,'500',3,0,500,'2017-08-16 01:42:30'),(57,100524,'500',3,0,500,'2017-08-16 01:45:40'),(58,100525,'500',3,0,500,'2017-08-16 01:47:39'),(59,100526,'500',3,0,500,'2017-08-16 01:59:13'),(60,100527,'500',3,0,500,'2017-08-16 02:00:26'),(61,100528,'500',3,0,500,'2017-08-16 02:10:10'),(62,100541,'500',3,0,500,'2017-08-17 23:29:14'),(63,100542,'500',3,0,500,'2017-08-17 23:29:46'),(64,100543,'500',3,0,500,'2017-08-17 23:29:58'),(65,100544,'500',3,0,500,'2017-08-17 23:39:10'),(66,100547,'500',3,0,500,'2017-08-17 23:42:02'),(67,100548,'500',3,0,500,'2017-08-17 23:44:22'),(68,100549,'500',3,0,500,'2017-08-18 00:37:59'),(69,100613,'500',3,0,500,'2017-08-21 03:27:30'),(70,100614,'500',3,0,500,'2017-08-21 03:27:56'),(71,100614,'500',3,0,1000,'2017-08-21 19:14:31'),(72,100630,'500',3,0,500,'2017-08-21 19:14:43'),(73,124124,'500',3,0,500,'2017-08-22 02:51:21'),(74,246197,'500',3,0,500,'2017-08-24 21:20:54'),(75,100614,'500',3,0,1500,'2017-08-24 23:22:53'),(76,100614,'500',3,0,1000,'2017-08-27 19:10:21'),(77,100614,'500',3,1,1500,'2017-08-29 05:03:10'),(78,246342,'5000',3,1,5000,'2017-08-29 06:11:02'),(79,100614,'500',3,1,500,'2017-08-29 19:22:36'),(80,246371,'6',3,1,150,'2017-08-29 21:05:07'),(81,246379,'32112',3,1,10000,'2017-08-29 21:17:52'),(82,246421,'3213',3,1,10000,'2017-08-30 00:38:04'),(83,246431,'3213',3,1,10000,'2017-08-30 01:09:46'),(84,246441,'3213',3,1,10000,'2017-08-30 01:36:03'),(85,246442,'3213',3,1,10000,'2017-08-30 01:36:15'),(86,100004,'3213',3,1,10000,'2017-08-30 03:02:27'),(87,100005,'3213',3,1,10000,'2017-08-30 03:02:42'),(88,100109,'8888',3,1,10000,'2017-08-31 00:42:33'),(89,100113,'8888',3,1,10000,'2017-08-31 02:16:25'),(90,100109,'8888',3,1,10000,'2017-09-03 19:15:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=600 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_order_goods` */

insert  into `jy_users_order_goods`(`Id`,`playerid`,`PlatformOrder`,`GoodsName`,`GoodsCode`,`GetNum`,`Proportion`,`GoodsID`,`Price`,`IsGive`,`Number`,`Type`,`DateTime`) values (579,100506,'2017082456545510','月卡','2312',1,0,25,30,1,1,0,'2017-08-23 21:12:40'),(580,100506,'2017082456545510','自动发炮','1004',1,0,18,0,2,1,0,'2017-08-23 21:12:40'),(581,100506,'2017082456545510','捕鱼概率提升','1005',1,0,19,0,2,1,0,'2017-08-23 21:12:40'),(582,100506,'2017082456545510','1砖石','1001',1,0,20,0,2,30,2,'2017-08-23 21:12:40'),(583,100506,'2017082456545510','1金币','1002',1,0,23,0,2,50000,1,'2017-08-23 21:12:40'),(584,100506,'2017082456545510','锁定','312',1,0,26,0,2,8,3,'2017-08-23 21:12:40'),(585,100506,'2017082456545510','冰冻','4645',1,0,27,0,2,3,3,'2017-08-23 21:12:40'),(586,100506,'2017082455545297','月卡','2312',1,0,25,30,1,1,0,'2017-08-23 21:12:55'),(587,100506,'2017082455545297','自动发炮','1004',1,0,18,0,2,1,0,'2017-08-23 21:12:55'),(588,100506,'2017082455545297','捕鱼概率提升','1005',1,0,19,0,2,1,0,'2017-08-23 21:12:55'),(589,100506,'2017082455545297','1砖石','1001',1,0,20,0,2,30,2,'2017-08-23 21:12:55'),(590,100506,'2017082455545297','1金币','1002',1,0,23,0,2,50000,1,'2017-08-23 21:12:55'),(591,100506,'2017082455545297','锁定','312',1,0,26,0,2,8,3,'2017-08-23 21:12:55'),(592,100506,'2017082455545297','冰冻','4645',1,0,27,0,2,3,3,'2017-08-23 21:12:55'),(593,100506,'2017082499100975','月卡','2312',1,0,25,30,1,1,0,'2017-08-24 04:48:12'),(594,100506,'2017082499100975','自动发炮','1004',1,0,18,0,2,1,0,'2017-08-24 04:48:12'),(595,100506,'2017082499100975','捕鱼概率提升','1005',1,0,19,0,2,1,0,'2017-08-24 04:48:12'),(596,100506,'2017082499100975','1砖石','1001',1,0,20,0,2,30,2,'2017-08-24 04:48:12'),(597,100506,'2017082499100975','1金币','1002',1,0,23,0,2,50000,1,'2017-08-24 04:48:12'),(598,100506,'2017082499100975','锁定','312',1,0,26,0,2,8,3,'2017-08-24 04:48:12'),(599,100506,'2017082499100975','冰冻','4645',1,0,27,0,2,3,3,'2017-08-24 04:48:12');

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
  `ExpireTime` int(11) unsigned NOT NULL COMMENT '订单过期时间',
  `FoundTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `RegisterChannel` varchar(50) NOT NULL COMMENT '注册渠道',
  `PayPlatform` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支付平台 1-支付宝 2-微信 3-爱贝 4-银联',
  `PayChannel` varchar(50) NOT NULL COMMENT '消费渠道',
  `PayID` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '支付ID',
  `Platform` tinyint(1) NOT NULL DEFAULT '1' COMMENT '平台 1-苹果 2-安卓',
  `PayPassAgeWay` varchar(50) NOT NULL COMMENT '支付通道',
  `PayType` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付类型 0-未支付 1-支付宝 2-微信',
  PRIMARY KEY (`Id`),
  KEY `Status` (`Status`),
  KEY `playerid` (`playerid`),
  KEY `ExpireTime` (`ExpireTime`),
  KEY `PlatformOrder` (`PlatformOrder`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_order_info` */

insert  into `jy_users_order_info`(`Id`,`playerid`,`OrderName`,`UsersName`,`PlatformOrder`,`MerchantOrder`,`Status`,`Price`,`CallbackTime`,`ExpireTime`,`FoundTime`,`RegisterChannel`,`PayPlatform`,`PayChannel`,`PayID`,`Platform`,`PayPassAgeWay`,`PayType`) values (5,100506,'月卡','游客100506','2017082456545510','',1,'30','2017-08-23 21:12:40',0,'2017-08-23 21:12:40','',0,'13724894160',0,2,'',0),(6,100506,'月卡','游客100506','2017082455545297','',1,'30','2017-08-23 21:12:55',0,'2017-08-23 21:12:55','',3,'13724894160',6,2,'iappay',0),(7,100506,'月卡','游客100506','2017082499100976','',1,'0.01','2017-08-24 04:48:12',0,'2017-08-24 04:48:12','',3,'13724894160',6,2,'iappay',0);

/*Table structure for table `jy_users_package_shop_log` */

DROP TABLE IF EXISTS `jy_users_package_shop_log`;

CREATE TABLE `jy_users_package_shop_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户月卡购买记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户Id',
  `Type` tinyint(1) unsigned NOT NULL COMMENT '1-首充 2-月卡',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`Type`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_package_shop_log` */

insert  into `jy_users_package_shop_log`(`Id`,`playerid`,`Type`,`DateTime`) values (1,100506,0,'2017-08-22 14:48:06');

/*Table structure for table `jy_users_retained_register` */

DROP TABLE IF EXISTS `jy_users_retained_register`;

CREATE TABLE `jy_users_retained_register` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户留存',
  `RegisterUserNum` int(11) unsigned NOT NULL COMMENT '当日注册用户数量',
  `LoginUserNum` int(11) NOT NULL COMMENT '登录用户数量',
  `day` int(6) NOT NULL COMMENT '留存天数',
  `Retention` varchar(10) NOT NULL COMMENT '留存率',
  `LoginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  `RegisterTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  PRIMARY KEY (`id`,`RegisterUserNum`),
  KEY `LoginTime` (`LoginTime`),
  KEY `RegisterTime` (`RegisterTime`),
  KEY `day` (`day`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_retained_register` */

insert  into `jy_users_retained_register`(`id`,`RegisterUserNum`,`LoginUserNum`,`day`,`Retention`,`LoginTime`,`RegisterTime`) values (25,1,0,7,'0.0000','2017-07-19 00:00:00','2017-07-12 00:00:00'),(26,1,0,5,'0.0000','2017-07-19 00:00:00','2017-07-14 00:00:00'),(27,2,0,3,'0.0000','2017-07-19 00:00:00','2017-07-15 00:00:00'),(28,1,0,1,'0.0000','2017-07-19 00:00:00','2017-07-18 00:00:00');

/*Table structure for table `jy_users_shop_log` */

DROP TABLE IF EXISTS `jy_users_shop_log`;

CREATE TABLE `jy_users_shop_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '购买记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `GoodID` int(11) unsigned NOT NULL COMMENT '物品ID',
  `Code` varchar(20) NOT NULL COMMENT '物品编号',
  `GiveNum` int(11) unsigned NOT NULL COMMENT '赠送数量',
  `IsGive` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否赠送 1-否 2-是',
  `Number` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_users_shop_log` */

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

/*Table structure for table `jy_versioninfo` */

DROP TABLE IF EXISTS `jy_versioninfo`;

CREATE TABLE `jy_versioninfo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '版本信息表',
  `version` varchar(20) NOT NULL COMMENT '版本号',
  `DataTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_versioninfo` */

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

insert  into `jy_vip_info`(`level`,`GiveInfo`,`ImgCode`,`Describe`,`experience`,`mtime`) values (1,'赠送武器\"紫苑\"','gun_01.png','每日签到双倍 \r\n每日免费领取 \r\n20000金币',30,'2017-07-25 20:52:02'),(2,'赠送武器\"寒光\"','gun_02.png','在线奖励金币翻倍\r\n每日免费领取\r\n30000金币',100,'2017-08-17 19:48:01'),(3,'赠送武器\"海炎\"','gun_03.png','锁定时间x2\r\n每日免费领取\r\n40000金币',300,'2017-08-17 19:48:57'),(4,'赠送武器\"审判\"','gun_04.png','捕鱼概率2倍奖励\r\n每日免费领取\r\n70000金币',800,'2017-08-17 19:49:12'),(5,'赠送武器\"毒药\"','gun_05.png','捕渔券概率x2\r\n每日免费领取\r\n250000金币',2000,'2017-08-17 19:49:32'),(6,'赠送武器\"冰魄\"','gun_06.png','捕鱼概率3倍奖励\r\n每日免费领取\r\n250000金币',5000,'2017-08-17 19:49:39'),(7,'赠送武器\"黯灭\"','gun_01.png','增加2倍炮时间\r\n每日免费领取\r\n40000金币',10000,'2017-08-17 19:49:46'),(8,'赠送武器\"无双\"','tuan_02.png','提升打BOSS概率\r\n每日免费领取\r\n650000金币',20000,'2017-08-17 19:49:57'),(9,'赠送武器\"吞海\"','tuan_02.png','获得核弹概率x2\r\n每日免费领取\r\n1000000金币',50000,'2017-08-17 19:50:05'),(10,'赠送武器\"祸忌\"','tuan_02.png','提升捕获所有鱼的概率\r\n每日免费领取\r\n1500000金币',100000,'2017-08-17 19:50:12');

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

/*Table structure for table `tuserinfo` */

DROP TABLE IF EXISTS `tuserinfo`;

CREATE TABLE `tuserinfo` (
  `UserID` binary(20) NOT NULL COMMENT '用户信息表',
  `Member` int(11) NOT NULL,
  `MatchMember` int(11) NOT NULL,
  `Master` int(11) NOT NULL,
  `GamePower` int(11) NOT NULL,
  `GPLimitTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `WalletMoney` bigint(20) DEFAULT NULL,
  `BankMoney` bigint(20) DEFAULT NULL,
  `Fascination` int(11) DEFAULT NULL,
  `Viptime` int(11) DEFAULT NULL,
  `DoublePointTime` int(11) DEFAULT NULL,
  `ProtectTime` int(11) DEFAULT NULL,
  `LastLoginIP` int(11) DEFAULT NULL,
  `TimeIsMoney` varchar(16) DEFAULT NULL,
  `RegisterTM` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  `version` int(11) NOT NULL COMMENT '客户版本号',
  `platformID` varchar(255) NOT NULL COMMENT '登陆平台信息',
  `AllLoginTime` int(11) DEFAULT NULL,
  `LastLoginTM` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TaxCom` bigint(20) DEFAULT NULL,
  `PhoneNum` varchar(50) DEFAULT NULL,
  `AdrNation` varchar(50) DEFAULT NULL,
  `AdrProvince` varchar(50) DEFAULT NULL,
  `AdrCity` varchar(50) DEFAULT NULL,
  `AdrZone` varchar(50) DEFAULT NULL,
  `OccuPation` varchar(50) DEFAULT NULL,
  `UserType` tinyint(1) DEFAULT NULL,
  `DiamondTime` int(11) DEFAULT NULL,
  `LockMathine` int(11) DEFAULT NULL,
  `MathineCode` varchar(255) DEFAULT NULL,
  `OnlineMinutes` int(11) DEFAULT NULL,
  `RoomLoginTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `PresentCoinNum` int(11) DEFAULT NULL,
  `StatusByGM` int(11) DEFAULT NULL,
  `StatusTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Trader` tinyint(1) DEFAULT NULL,
  `KickUserTime` int(11) DEFAULT NULL,
  `AntiKickTime` int(11) DEFAULT NULL,
  `MyHardID` varchar(50) DEFAULT NULL,
  `AddFriendType` int(11) DEFAULT NULL,
  `ActLoginCount` int(1) DEFAULT NULL,
  `Experience` bigint(20) DEFAULT NULL,
  `gift1` int(11) DEFAULT NULL,
  `gift2` int(11) DEFAULT NULL,
  `gift3` int(11) DEFAULT NULL,
  `gift4` int(11) DEFAULT NULL,
  `gift5` int(11) DEFAULT NULL,
  `Diamond` int(11) DEFAULT NULL,
  `VipLevel` tinyint(2) DEFAULT NULL,
  `BossExpend` bigint(20) DEFAULT NULL,
  `UserLevel` tinyint(2) DEFAULT NULL,
  `TotalBuy` int(11) DEFAULT NULL,
  `RewardOneState` int(11) DEFAULT NULL,
  `RewardTwoState` int(11) DEFAULT NULL,
  `RewardThreeState` int(11) DEFAULT NULL,
  `UserCannonRate` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  KEY `RegisterTM` (`RegisterTM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tuserinfo` */

insert  into `tuserinfo`(`UserID`,`Member`,`MatchMember`,`Master`,`GamePower`,`GPLimitTime`,`WalletMoney`,`BankMoney`,`Fascination`,`Viptime`,`DoublePointTime`,`ProtectTime`,`LastLoginIP`,`TimeIsMoney`,`RegisterTM`,`version`,`platformID`,`AllLoginTime`,`LastLoginTM`,`TaxCom`,`PhoneNum`,`AdrNation`,`AdrProvince`,`AdrCity`,`AdrZone`,`OccuPation`,`UserType`,`DiamondTime`,`LockMathine`,`MathineCode`,`OnlineMinutes`,`RoomLoginTime`,`PresentCoinNum`,`StatusByGM`,`StatusTime`,`Trader`,`KickUserTime`,`AntiKickTime`,`MyHardID`,`AddFriendType`,`ActLoginCount`,`Experience`,`gift1`,`gift2`,`gift3`,`gift4`,`gift5`,`Diamond`,`VipLevel`,`BossExpend`,`UserLevel`,`TotalBuy`,`RewardOneState`,`RewardTwoState`,`RewardThreeState`,`UserCannonRate`) values ('10012\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',1,1,1,1,'2017-07-20 19:43:25',1,1,1,1,NULL,NULL,NULL,NULL,'2017-06-25 11:24:09',1,'',NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00',NULL,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL),('10013\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',1,1,1,1,'2017-07-20 20:01:00',1,1,1,1,1,1,1,'1','2017-06-25 10:52:29',2,'',1,'0000-00-00 00:00:00',1,'1','1','1','1','1','1',1,1,1,'1',1,'0000-00-00 00:00:00',1,1,'0000-00-00 00:00:00',1,1,1,'1',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1),('10014\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',1,1,1,1,'2017-07-18 14:13:01',1,1,1,1,1,1,1,'1','2017-07-12 12:28:20',1,'1',1,'0000-00-00 00:00:00',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00',NULL,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL),('10015\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',1,1,1,1,'2017-07-20 11:53:30',1,1,1,1,1,1,1,'1','2017-07-19 11:53:27',3,'1',1,'0000-00-00 00:00:00',1,'1','1','1','1','1','1',1,1,1,'1',1,'0000-00-00 00:00:00',NULL,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),('10016\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',1,1,1,1,'2017-07-20 11:53:33',1,1,1,1,1,1,1,'1','2017-07-19 11:53:30',1,'1',NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00',NULL,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),('10017\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',1,1,1,1,'2017-07-20 11:53:35',1,1,1,1,1,1,1,'1','2017-07-14 11:53:33',1,'1',NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00',NULL,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL),('10018\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',1,1,1,1,'2017-07-20 11:53:40',1,1,1,1,1,1,1,'1','2017-07-18 11:53:36',1,'1',1,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00',NULL,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tuserlist` */

DROP TABLE IF EXISTS `tuserlist`;

CREATE TABLE `tuserlist` (
  `UserID` int(10) NOT NULL,
  `RemoteID` int(10) NOT NULL,
  `GroupID` int(10) NOT NULL,
  KEY `IX_TUserList_UserID` (`UserID`),
  CONSTRAINT `tuserlist_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `tusers` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tuserlist` */

/*Table structure for table `tuserlogingame` */

DROP TABLE IF EXISTS `tuserlogingame`;

CREATE TABLE `tuserlogingame` (
  `UserID` int(10) NOT NULL,
  `KindID` int(10) NOT NULL,
  `GameID` int(10) NOT NULL,
  `LastTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `LoginCount` int(10) NOT NULL,
  KEY `IX_TUserLoginGame_GameID` (`GameID`),
  KEY `IX_TUserLoginGame_KindID` (`KindID`),
  KEY `IX_TUserLoginGame_UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tuserlogingame` */

insert  into `tuserlogingame`(`UserID`,`KindID`,`GameID`,`LastTime`,`LoginCount`) values (10013,1,33003106,'2017-06-26 19:59:24',27),(10012,1,33003106,'2017-06-26 18:22:44',1);

/*Table structure for table `tusernamerule` */

DROP TABLE IF EXISTS `tusernamerule`;

CREATE TABLE `tusernamerule` (
  `UserID` int(10) NOT NULL,
  `UserName` varchar(20) NOT NULL DEFAULT '',
  `GameInvalidate` bit(1) NOT NULL,
  `OverTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RoomID` int(10) NOT NULL,
  KEY `IX_TUserNameRule` (`UserID`,`RoomID`),
  CONSTRAINT `tusernamerule_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `tusers` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tusernamerule` */

/*Table structure for table `tuserprop` */

DROP TABLE IF EXISTS `tuserprop`;

CREATE TABLE `tuserprop` (
  `UserID` int(10) NOT NULL,
  `PropID` int(10) NOT NULL,
  `HoldCount` int(10) NOT NULL,
  KEY `IX_TUserProp` (`UserID`),
  KEY `FK_TUserProp_TPropDefine` (`PropID`),
  CONSTRAINT `tuserprop_ibfk_1` FOREIGN KEY (`PropID`) REFERENCES `tpropdefine` (`PropID`) ON DELETE CASCADE,
  CONSTRAINT `tuserprop_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `tusers` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tuserprop` */

/*Table structure for table `tusers` */

DROP TABLE IF EXISTS `tusers`;

CREATE TABLE `tusers` (
  `UserID` int(10) NOT NULL COMMENT '用户表',
  `UserName` varchar(20) NOT NULL COMMENT '账号',
  `Pass` varchar(50) NOT NULL DEFAULT 'd0970714757783e6cf17b26fb8e2298f' COMMENT '密码',
  `TwoPassword` varchar(50) NOT NULL DEFAULT 'd0970714757783e6cf17b26fb8e2298f' COMMENT '二级密码',
  `NickName` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `Sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别 1-男 2-女',
  `vip` int(4) NOT NULL COMMENT 'vip等级',
  `vip_exp` int(11) NOT NULL COMMENT 'vip经验',
  `glevel` int(4) NOT NULL DEFAULT '1' COMMENT '游戏等级',
  `gexp` bigint(20) NOT NULL COMMENT '游戏经验',
  `gold` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '金币',
  `diamond` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '砖石',
  `loginTime` int(11) unsigned NOT NULL COMMENT '登录时间',
  `Status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '游戏状态（1离线，2在线，3捕鱼）',
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `PK_TUsers` (`UserID`),
  UNIQUE KEY `IX_TUsers_1` (`NickName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tusers` */

insert  into `tusers`(`UserID`,`UserName`,`Pass`,`TwoPassword`,`NickName`,`Sex`,`vip`,`vip_exp`,`glevel`,`gexp`,`gold`,`diamond`,`loginTime`,`Status`) values (10012,'testUser','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e','testUser',1,0,0,1,0,0,0,0,1),(10013,'Phone10013','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e','Phone10013',1,0,0,1,0,0,0,0,1),(10014,'Phone10014','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e','Phone10014',1,0,0,1,0,0,0,0,1),(10015,'Phone10015','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e','Phone10015',1,0,0,1,0,0,0,0,1),(10016,'2132424242','96e79218965eb72c92a549dd5a330112','96e79218965eb72c92a549dd5a330112','2132424242',1,0,0,1,0,0,0,0,1),(10017,'uuuuii','c19d4968566c347b8fa0e8fb4527d8bb','c19d4968566c347b8fa0e8fb4527d8bb','uuuuii',1,0,0,1,0,0,0,0,1),(10018,'123465','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e','123465',1,0,0,1,0,0,0,0,1);

/*Table structure for table `web_analyrole` */

DROP TABLE IF EXISTS `web_analyrole`;

CREATE TABLE `web_analyrole` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(50) DEFAULT NULL,
  `MenuID` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PK_T_Role` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `web_analyrole` */

/*Table structure for table `web_moneychangelog` */

DROP TABLE IF EXISTS `web_moneychangelog`;

CREATE TABLE `web_moneychangelog` (
  `ID` int(10) NOT NULL AUTO_INCREMENT COMMENT '金币变化',
  `UserID` int(10) NOT NULL COMMENT '用户ID',
  `UserName` varchar(50) NOT NULL COMMENT '用户名',
  `StartMoney` bigint(19) NOT NULL COMMENT '起始金币',
  `ChangeMoney` bigint(19) NOT NULL COMMENT '改变金币',
  `ChangeType` int(10) NOT NULL COMMENT '金币变化类型：1为游戏输赢，2为第三方充值，3为转账，4为购买道具，5为兑换奖品，6为购买VIP，7为推广员结算，8为魅力值兑换金币，9为管理员修改金币，10为购买靓号',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '时间',
  `Remark` varchar(100) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PK_Web_MoneyChangeLog` (`ID`),
  KEY `IX_Web_MoneyChangeLog` (`UserID`),
  KEY `IX_Web_MoneyChangeLog2` (`DateTime`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `web_moneychangelog` */

insert  into `web_moneychangelog`(`ID`,`UserID`,`UserName`,`StartMoney`,`ChangeMoney`,`ChangeType`,`DateTime`,`Remark`) values (1,10001,'testUser',0,10000,26,'2017-07-17 11:52:23','注册赠送web'),(2,10013,'Phone10013',0,10000,26,'2017-06-26 16:26:40','注册赠送'),(3,10014,'Phone10014',0,10000,26,'2017-06-28 10:42:53','注册赠送'),(4,10015,'Phone10015',0,10000,26,'2017-06-28 15:45:34','注册赠送'),(5,10016,'2132424242',0,10000,26,'2017-06-29 11:07:18','注册赠送'),(6,10016,'2132424242',10000,800,50,'2017-06-29 11:19:39','连续签到奖励'),(7,10017,'uuuuii',0,10000,26,'2017-06-29 14:04:05','注册赠送'),(8,10017,'uuuuii',10000,800,50,'2017-06-29 14:11:02','连续签到奖励'),(9,10014,'Phone10014',10000,800,50,'2017-06-29 17:22:11','连续签到奖励'),(10,10013,'Phone10013',10000,800,50,'2017-06-29 17:22:27','连续签到奖励'),(11,10016,'2132424242',0,1000,50,'2017-06-30 09:24:25','连续签到奖励'),(12,10018,'123465',0,10000,26,'2017-06-30 09:36:11','注册赠送');

/*Table structure for table `web_rmbcost` */

DROP TABLE IF EXISTS `web_rmbcost`;

CREATE TABLE `web_rmbcost` (
  `PayID` int(10) NOT NULL AUTO_INCREMENT,
  `Users_ids` int(10) DEFAULT NULL,
  `TrueName` varchar(30) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `PayMoney` int(10) DEFAULT NULL COMMENT '人民（元）',
  `PayType` tinyint(3) unsigned DEFAULT NULL COMMENT '支付类型',
  `TypeInfo` varchar(50) DEFAULT NULL,
  `OrderID` varchar(50) DEFAULT NULL COMMENT '支付订单',
  `AddTime` timestamp NULL DEFAULT NULL,
  `ExchangeRate` int(10) DEFAULT NULL,
  `InMoney` int(10) DEFAULT NULL COMMENT '金币数量',
  `InSuccess` tinyint(1) DEFAULT NULL,
  `PaySuccess` tinyint(1) DEFAULT NULL COMMENT '支付状态 0-失败  1-成功',
  `BackTime` timestamp NULL DEFAULT NULL,
  `EncryptStr` text,
  `Info` text,
  `MoneyFront` bigint(19) DEFAULT NULL,
  `MoneyAfter` bigint(19) DEFAULT NULL,
  `IsGivenMoney` tinyint(3) unsigned DEFAULT NULL,
  `TypeUser` int(10) DEFAULT NULL,
  PRIMARY KEY (`PayID`),
  UNIQUE KEY `PK_Web_RMBCost` (`PayID`),
  KEY `ix_AddTime` (`AddTime`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `web_rmbcost` */

insert  into `web_rmbcost`(`PayID`,`Users_ids`,`TrueName`,`Phone`,`UserName`,`PayMoney`,`PayType`,`TypeInfo`,`OrderID`,`AddTime`,`ExchangeRate`,`InMoney`,`InSuccess`,`PaySuccess`,`BackTime`,`EncryptStr`,`Info`,`MoneyFront`,`MoneyAfter`,`IsGivenMoney`,`TypeUser`) values (1,10012,'1','2','1',321,1,'1','1231','2017-07-21 10:32:15',1,11,1,1,'2017-06-29 10:32:40','321321','321321',1,1,1,1);

/*Table structure for table `web_vuserloginlist` */

DROP TABLE IF EXISTS `web_vuserloginlist`;

CREATE TABLE `web_vuserloginlist` (
  `UserName` varchar(20) DEFAULT NULL COMMENT '用户名',
  `NickName` varchar(50) DEFAULT NULL COMMENT '用户昵称',
  `UserID` int(10) NOT NULL COMMENT '用户ID',
  `MachineCode` varchar(80) DEFAULT NULL COMMENT '机器编码',
  `LastLoginIP` char(16) NOT NULL COMMENT '登录IP',
  `diamond` bigint(20) NOT NULL COMMENT '砖石',
  `money` bigint(20) NOT NULL COMMENT '金币',
  `LastLoginTM` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  `InitialLogin` tinyint(4) NOT NULL COMMENT '是否首次登录 0-否 1-是',
  `RegisterTM` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册IP',
  `Disabled` int(10) DEFAULT NULL COMMENT '是否限制',
  `LockMathine` int(10) NOT NULL,
  `HardID` varchar(40) DEFAULT NULL COMMENT '硬盘编码',
  PRIMARY KEY (`LastLoginTM`),
  KEY `InitialLogin` (`InitialLogin`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `web_vuserloginlist` */

insert  into `web_vuserloginlist`(`UserName`,`NickName`,`UserID`,`MachineCode`,`LastLoginIP`,`diamond`,`money`,`LastLoginTM`,`InitialLogin`,`RegisterTM`,`Disabled`,`LockMathine`,`HardID`) values ('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 16:26:40',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 16:45:11',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 16:59:15',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:02:29',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:02:46',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:09:15',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:09:32',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:11:58',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:24:03',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:24:39',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10012,'123456789','183.12.67.42',0,0,'2017-06-26 17:26:13',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:27:28',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:28:22',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:31:26',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:32:20',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:36:55',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:42:45',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 17:45:29',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 18:12:14',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 18:15:29',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 18:18:02',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 18:22:01',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 18:27:13',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 18:30:30',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 19:51:27',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 19:56:15',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-26 19:59:23',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-27 14:12:28',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-27 14:13:55',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10012,'123456789','183.12.67.42',0,0,'2017-06-27 14:35:40',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-27 15:36:05',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-27 15:36:35',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-27 15:36:52',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-27 15:38:53',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-27 15:40:38',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-27 15:40:58',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-27 15:44:57',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-27 17:34:40',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10014','Phone10014',10014,'123456789','183.12.67.42',0,0,'2017-06-28 10:42:53',0,'2017-06-28 10:42:53',0,0,'2222222'),('Phone10014','Phone10014',10014,'123456789','183.12.67.42',0,0,'2017-06-28 15:20:47',0,'2017-06-28 10:42:53',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-06-28 15:38:34',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10015','Phone10015',10015,'123456789','183.12.67.42',0,0,'2017-06-28 15:45:34',0,'2017-06-28 15:45:34',0,0,'2222222'),('Phone10015','Phone10015',10015,'123456789','183.12.67.42',0,0,'2017-06-28 15:45:49',0,'2017-06-28 15:45:34',0,0,'2222222'),('Phone10015','Phone10015',10015,'123456789','183.12.67.42',0,0,'2017-06-28 15:49:44',0,'2017-06-28 15:45:34',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-28 16:37:59',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10015','Phone10015',10015,'123456789','121.35.211.206',0,0,'2017-06-29 10:09:14',0,'2017-06-28 15:45:34',0,0,'2222222'),('Phone10015','Phone10015',10015,'123456789','121.35.211.206',0,0,'2017-06-29 10:21:00',0,'2017-06-28 15:45:34',0,0,'2222222'),('Phone10015','Phone10015',10015,'123456789','121.35.211.206',0,0,'2017-06-29 10:28:20',0,'2017-06-28 15:45:34',0,0,'2222222'),('2132424242','2132424242',10016,'123456789','121.35.211.206',0,0,'2017-06-29 11:18:58',0,'2017-06-29 11:07:18',0,0,'2222222'),('2132424242','2132424242',10016,'123456789','121.35.211.206',0,0,'2017-06-29 11:32:36',0,'2017-06-29 11:07:18',0,0,'2222222'),('Phone10015','Phone10015',10015,'123456789','121.35.211.206',0,0,'2017-06-29 11:41:28',0,'2017-06-28 15:45:34',0,0,'2222222'),('uuuuii','uuuuii',10017,'123456789','121.35.211.206',0,0,'2017-06-29 14:49:50',0,'2017-06-29 14:04:05',0,0,'2222222'),('uuuuii','uuuuii',10017,'123456789','121.35.211.206',0,0,'2017-06-29 15:05:04',0,'2017-06-29 14:04:05',0,0,'2222222'),('uuuuii','uuuuii',10017,'123456789','121.35.211.206',0,0,'2017-06-29 15:50:15',0,'2017-06-29 14:04:05',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 16:16:06',0,'2017-06-26 16:26:40',0,0,'2222222'),('uuuuii','uuuuii',10017,'123456789','121.35.211.206',0,0,'2017-06-29 16:17:13',0,'2017-06-29 14:04:05',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 16:23:12',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 16:28:14',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 16:29:01',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 16:37:00',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 16:37:20',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 16:43:00',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 16:44:04',0,'2017-06-26 16:26:40',0,0,'2222222'),('uuuuii','uuuuii',10017,'123456789','121.35.211.206',0,0,'2017-06-29 16:48:23',0,'2017-06-29 14:04:05',0,0,'2222222'),('Phone10014','Phone10014',10014,'123456789','121.35.211.206',0,0,'2017-06-29 17:17:36',0,'2017-06-28 10:42:53',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 17:19:19',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 17:19:25',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 17:21:22',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 17:21:31',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 17:25:14',0,'2017-06-26 16:26:40',0,0,'2222222'),('uuuuii','uuuuii',10017,'123456789','121.35.211.206',0,0,'2017-06-29 18:22:19',0,'2017-06-29 14:04:05',0,0,'2222222'),('uuuuii','uuuuii',10017,'123456789','121.35.211.206',0,0,'2017-06-29 18:22:39',0,'2017-06-29 14:04:05',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 18:27:34',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 18:28:17',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 18:31:35',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 18:32:55',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 18:41:32',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 18:41:38',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 18:41:46',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 18:42:09',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 18:46:57',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 18:48:52',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:11:40',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:18:40',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:19:10',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:33:54',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:35:58',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:36:23',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:40:21',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:42:29',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:46:30',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:47:00',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:51:18',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:56:56',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 19:57:24',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 20:03:01',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 20:10:29',0,'2017-06-26 16:26:40',0,0,'2222222'),('testUser','testUser',10012,'123456789','121.35.211.206',0,0,'2017-06-29 20:15:50',0,'2017-06-26 11:48:15',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 20:16:15',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 20:18:55',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 20:20:32',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-29 20:29:21',0,'2017-06-26 16:26:40',0,0,'2222222'),('2132424242','2132424242',10016,'123456789','121.35.211.206',0,0,'2017-06-30 09:23:48',0,'2017-06-29 11:07:18',0,0,'2222222'),('2132424242','2132424242',10016,'123456789','121.35.211.206',0,0,'2017-06-30 09:35:48',0,'2017-06-29 11:07:18',0,0,'2222222'),('123465','123465',10018,'123456789','121.35.211.206',0,0,'2017-06-30 09:36:13',0,'2017-06-30 09:36:11',0,0,'2222222'),('2132424242','2132424242',10016,'123456789','121.35.211.206',0,0,'2017-06-30 09:38:44',0,'2017-06-29 11:07:18',0,0,'2222222'),('123465','123465',10018,'123456789','121.35.211.206',0,0,'2017-06-30 09:56:25',0,'2017-06-30 09:36:11',0,0,'2222222'),('uuuuii','uuuuii',10017,'123456789','121.35.211.206',0,0,'2017-06-30 10:06:07',0,'2017-06-29 14:04:05',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-30 10:07:31',0,'2017-06-26 16:26:40',0,0,'2222222'),('uuuuii','uuuuii',10017,'123456789','121.35.211.206',0,0,'2017-06-30 10:08:20',0,'2017-06-29 14:04:05',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-30 10:10:52',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','121.35.211.206',0,0,'2017-06-30 10:19:35',0,'2017-06-26 16:26:40',0,0,'2222222'),('testUser','testUser',10012,'123456789','121.35.211.206',0,0,'2017-07-17 17:38:10',0,'2017-06-29 11:48:15',0,0,'2222222'),('123465','123465',10018,'123456789','121.35.211.206',1,1,'2017-07-19 15:22:36',1,'2017-06-30 09:36:11',0,0,'2222222'),('testUser','testUser',10013,'123456789','183.12.67.42',1,1,'2017-07-19 15:29:28',0,'2017-06-26 11:48:15',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-07-19 15:41:18',1,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10013,'123456789','183.12.67.42',0,0,'2017-07-25 18:23:16',0,'2017-06-26 16:26:40',0,0,'2222222'),('Phone10013','Phone10013',10018,'123456789','121.35.211.206',0,0,'2017-08-01 09:55:29',0,'2017-06-26 16:26:40',0,0,'2222222'),('uuuuii','uuuuii',10017,'123456789','121.35.211.206',0,0,'2017-08-11 14:07:04',0,'2017-06-29 14:04:05',0,0,'2222222'),('Phone10014','Phone10014',10014,'123456789','121.35.211.206',0,0,'2017-08-11 16:43:41',0,'2017-06-28 10:42:53',0,0,'2222222'),('Phone10013','Phone10013',10018,'123456789','121.35.211.206',0,0,'2017-08-17 09:49:06',0,'2017-06-26 16:26:40',0,0,'2222222');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
