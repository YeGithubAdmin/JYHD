/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.20-0ubuntu0.16.04.1 : Database - jyhd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jyhd` /*!40100 DEFAULT CHARACTER SET utf8 */;

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

insert  into `jy_admin_group`(`id`,`name`,`authority`,`upid`,`addId`,`addName`,`islock`,`add`,`DesktopAddress`,`channel`,`edit`,`del`,`isdel`,`remark`,`mtime`) values (1,'超级管理员','',0,1,'测试',1,2,'',1,2,2,1,'','2017-08-30 10:11:17'),(6,'渠道','',1,1,'admin',1,1,'/jy_admin/ChannelData/index',1,1,1,1,'','2017-09-29 17:08:08'),(14,'游戏调试','[\"105\",\"109\",\"59\",\"63\",\"62\",\"42\",\"119\",\"57\"]',1,1,'测试',1,2,'/jy_admin/UsersAttribute/index',1,2,2,1,'','2017-11-14 11:51:07');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `jy_admin_users` */

insert  into `jy_admin_users`(`id`,`name`,`account`,`passwd`,`admingroup`,`default`,`channel`,`addName`,`addId`,`islock`,`isdel`,`remark`,`mtime`) values (1,'admin','jyhd@admin','e9ea4bc3f5ad73346051c1a436963521',0,2,1,'',0,1,1,'','2017-07-11 08:28:22'),(5,'倒霉小姐','18899753856','e10adc3949ba59abbe56e057f20f883e',6,1,2,'test',3,1,2,'321','2017-07-12 06:52:35'),(9,'游戏调试','jyhd@163.com','e10adc3949ba59abbe56e057f20f883e',14,1,1,'测试',1,1,2,'','2017-08-30 10:13:03'),(10,'渠道测试','13724894160','e10adc3949ba59abbe56e057f20f883e',6,1,2,'测试',1,1,2,'','2017-08-30 11:21:34'),(11,'JYHD_0','JYHD_0','e10adc3949ba59abbe56e057f20f883e',6,1,2,'测试',1,1,1,'','2017-09-22 17:24:21'),(12,'金立','JYHD_JinLi','934d955c889aacf1cedbf0a3d3c0cb18',6,1,2,'测试',1,1,1,'','2017-09-28 19:51:17'),(13,'xl','13724894160','e10adc3949ba59abbe56e057f20f883e',6,1,2,'测试',1,1,1,'','2017-09-29 10:13:46'),(14,'苹果（测试）','JYHD_AS','e10adc3949ba59abbe56e057f20f883e',6,1,2,'admin',1,1,1,'','2017-11-06 11:08:06'),(15,'小米','JYHD_MI','e10adc3949ba59abbe56e057f20f883e',6,1,2,'admin',1,1,1,'','2017-11-07 18:47:15'),(16,'小土豆','jyhd@2017','e10adc3949ba59abbe56e057f20f883e',14,1,1,'admin',1,1,1,'','2017-11-14 11:48:44'),(17,'三星','JYHD_Samsung','f64c85d7de4371ff028f6763fb0fc62f',6,1,2,'admin',1,1,1,'','2017-11-27 11:35:51');

/*Table structure for table `jy_system_menu` */

DROP TABLE IF EXISTS `jy_system_menu`;

CREATE TABLE `jy_system_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统菜单',
  `name` varchar(20) NOT NULL COMMENT '菜单名',
  `icon` varchar(20) NOT NULL COMMENT '菜单表',
  `url` varchar(100) NOT NULL COMMENT '菜单地址',
  `sort` int(11) unsigned NOT NULL COMMENT '排序',
  `Group` varchar(50) DEFAULT NULL COMMENT '上级组',
  `islock` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否锁定',
  `upid` int(11) NOT NULL DEFAULT '0' COMMENT '上级菜单',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;

/*Data for the table `jy_system_menu` */

insert  into `jy_system_menu`(`id`,`name`,`icon`,`url`,`sort`,`Group`,`islock`,`upid`,`remark`,`mtime`) values (1,'系统','','###',0,'{\"upid\":0,\"towid\":0}',1,0,'','2017-11-14 10:51:09'),(2,'菜单','','###',0,'{\"upid\":1,\"towid\":0}',1,1,'','2017-11-14 10:52:10'),(3,'管理员','','/jy_admin/AdminUsers/index',2,'{\"upid\":1,\"towid\":102}',1,102,'','2017-11-14 10:52:50'),(4,'管理员组','','/jy_admin/admingroup/index',3,'{\"upid\":1,\"towid\":102}',1,102,'','2017-11-14 10:52:40'),(5,'渠道管理','','###',1,'{\"upid\":104,\"towid\":0}',1,104,'','2017-11-14 10:56:23'),(6,'渠道列表','','/jy_admin/Channel/index',0,'{\"upid\":104,\"towid\":5}',1,5,'','2017-11-14 10:57:00'),(7,'渠道数据','','/Jy_statistics/ChannelData/index',0,'{\"upid\":104,\"towid\":5}',1,5,'','2017-11-14 10:56:49'),(10,'全局数据','','/Jy_statistics/GlobalData/index',1,'{\"upid\":110,\"towid\":111}',1,111,'','2017-11-14 11:10:01'),(15,'宏观数据','','/Jy_statistics/RegisterMacroscopic/index',0,'{\"upid\":110,\"towid\":112}',1,112,'','2017-11-14 11:10:37'),(61,'商品分析','','/Jy_statistics/PayMacroscopic/Goods',2,'{\"upid\":110,\"towid\":116}',1,116,'','2017-11-14 11:13:12'),(60,'支付类型','','/jy_admin/PayMacroscopic/PayType',1,'{\"upid\":110,\"towid\":116}',1,116,'','2017-11-14 11:13:22'),(22,'宏观数据','','/Jy_statistics/ActiveMacroscopic/index',1,'{\"upid\":110,\"towid\":113}',1,113,'','2017-11-14 11:11:47'),(23,'等级分布','','/Jy_statistics/ActiveLevel/index',2,'{\"upid\":110,\"towid\":113}',1,113,'','2017-11-14 11:12:29'),(24,'版本分布','','/Jy_statistics/ActiveEdition/index',3,'{\"upid\":110,\"towid\":113}',1,113,'','2017-11-14 11:12:17'),(28,'实时概况','','/Jy_statistics/RealTimeOverview/index',1,'{\"upid\":110,\"towid\":115}',1,115,'','2017-11-14 11:14:51'),(29,'实时在线','','/Jy_statistics/RealTimeOnline/index',2,'{\"upid\":110,\"towid\":115}',1,115,'','2017-11-14 11:14:41'),(30,'实时收入','','/Jy_statistics/RealTimeRevenue/index',0,'{\"upid\":110,\"towid\":115}',1,115,'','2017-11-14 11:14:23'),(32,'留存数据','','/Jy_statistics/RetainedData/index',0,'{\"upid\":110,\"towid\":114}',1,114,'','2017-11-14 11:15:53'),(33,'流失数据','','/Jy_statistics/RetainedDataLoss/index',1,'{\"upid\":110,\"towid\":114}',1,114,'','2017-11-14 11:15:18'),(36,'宏观数据','','/jy_admin/PayMacroscopic/index',0,'{\"upid\":110,\"towid\":116}',1,116,'','2017-11-14 11:13:30'),(38,'金币流水','','/Jy_statistics/GoldStream/index',0,'{\"upid\":110,\"towid\":117}',1,117,'','2017-11-14 11:18:09'),(39,'钻石流水','','/Jy_statistics/DiamondsStream/index',1,'{\"upid\":110,\"towid\":117}',1,117,'','2017-11-14 11:18:01'),(40,'道具流水','','/Jy_statistics/PropStream/index',2,'{\"upid\":110,\"towid\":117}',1,117,'','2017-11-14 11:17:53'),(117,'货币流水','','###',6,'{\"upid\":110,\"towid\":0}',1,110,'','2017-11-14 11:36:55'),(42,'用户中心','###','###',2,NULL,1,0,'','2017-07-12 08:52:45'),(43,'用户列表','','/Jy_statistics/UsersInfo/index',1,'{\"upid\":42,\"towid\":119}',1,119,'','2017-11-14 11:38:27'),(44,'金币分布','','/Jy_statistics/ActiveGold/index',2,'{\"upid\":110,\"towid\":113}',1,113,'','2017-11-14 11:11:32'),(45,'钻石分布','','/Jy_statistics/ActiveDiamond/index',3,'{\"upid\":110,\"towid\":113}',1,113,'','2017-11-14 11:11:04'),(47,'商品列表','','/jy_admin/GoodsAll/index',0,'{\"upid\":105,\"towid\":106}',1,106,'','2017-11-14 11:05:49'),(48,'签到（2）','','/jy_admin/ThirtyDaysSign/index/Status/2',7,'{\"upid\":105,\"towid\":107}',1,107,'','2017-11-14 11:02:09'),(49,'活动列表','','/jy_admin/activityList/index',3,'{\"upid\":105,\"towid\":108}',1,108,'','2017-11-14 11:03:32'),(50,'vip等级','','/jy_admin/VipInfo/index',1,'{\"upid\":42,\"towid\":120}',1,120,'','2017-11-14 11:41:49'),(59,'发送邮件','','/jy_admin/SendEmail/index',0,'{\"upid\":105,\"towid\":109}',1,109,'','2017-11-14 11:32:40'),(52,'支付','','###',3,'{\"upid\":0,\"towid\":0}',1,0,'','2017-11-14 11:29:17'),(53,'SDK列表','','/jy_admin/ThirdpayInfo/index',0,'{\"upid\":52,\"towid\":118}',1,118,'','2017-11-14 11:31:08'),(54,'所有订单','###','/jy_admin/UsersOrder/index',4,'{\"upid\":52,\"towid\":121}',1,121,'','2017-11-14 11:42:52'),(55,'签到（1）','','/jy_admin/ThirtyDaysSign/index/Status/1',6,'{\"upid\":105,\"towid\":107}',1,107,'','2017-11-14 11:01:59'),(57,'用户属性','###','/jy_admin/UsersAttribute/index',1,'{\"upid\":42,\"towid\":119}',1,119,'','2017-11-14 11:38:44'),(58,'兑换申请','','/jy_admin/UsersExchangeApplication/index',2,'{\"upid\":42,\"towid\":120}',1,120,'','2017-11-14 11:42:03'),(62,'游戏公告','','/jy_admin/Notice/index',5,'{\"upid\":105,\"towid\":109}',1,109,'###','2017-11-14 11:04:33'),(63,'跑马灯','##','/jy_admin/HorseRaceLamp/index',5,'{\"upid\":105,\"towid\":109}',1,109,'','2017-11-14 11:04:42'),(67,'停服设置','','/jy_admin/GameConfig/index',3,'{\"upid\":1,\"towid\":103}',1,103,'','2017-11-14 10:54:30'),(69,'白名单','','/jy_admin/WhiteList/index',6,'{\"upid\":1,\"towid\":103}',1,103,'','2017-11-14 10:54:42'),(70,'游戏逻辑','','/jy_admin/GameLogic/index',4,'{\"upid\":1,\"towid\":103}',1,103,'','2017-11-14 10:54:22'),(71,'签到（3）','','/jy_admin/ThirtyDaysSign/index/Status/3',8,'{\"upid\":105,\"towid\":107}',1,107,'','2017-11-14 11:01:46'),(72,'连续签到','','/jy_admin/ThirtydaysContinuity/index',5,'{\"upid\":105,\"towid\":107}',1,107,'','2017-11-14 11:00:59'),(73,'新手礼包','','/jy_admin/NovicePack/index',9,'{\"upid\":105,\"towid\":106}',1,106,'','2017-11-14 11:00:42'),(101,'菜单列表','','/jy_admin/menu/index',0,'{\"upid\":1,\"towid\":2}',1,2,'','2017-11-14 10:50:34'),(102,'系统管理','','###',1,'{\"upid\":1,\"towid\":0}',1,1,'','2017-11-14 10:51:56'),(103,'游戏配置','','###',3,'{\"upid\":1,\"towid\":0}',1,1,'','2017-11-14 10:54:03'),(104,'渠道','','###',1,'{\"upid\":0,\"towid\":0}',1,0,'','2017-11-14 10:55:39'),(105,'游戏大厅','','###',2,'{\"upid\":0,\"towid\":0}',1,0,'','2017-11-14 10:58:04'),(106,'礼包配置','##','###',1,'{\"upid\":105,\"towid\":0}',1,105,'','2017-11-14 10:59:57'),(107,'签到','','###',2,'{\"upid\":105,\"towid\":0}',1,105,'','2017-11-14 11:00:21'),(108,'活动配置','','###',0,'{\"upid\":105,\"towid\":0}',1,105,'','2017-11-14 11:02:57'),(109,'公告信息','','###',0,'{\"upid\":105,\"towid\":0}',1,105,'','2017-11-14 11:04:13'),(110,'统计','','###',3,'{\"upid\":0,\"towid\":0}',1,0,'','2017-11-14 11:06:46'),(111,'全局分析','','###',0,'{\"upid\":110,\"towid\":0}',1,110,'','2017-11-14 11:35:17'),(112,'注册分析','','###',1,'{\"upid\":110,\"towid\":0}',1,110,'','2017-11-14 11:35:52'),(113,'活跃分析','','###',2,'{\"upid\":110,\"towid\":0}',1,110,'','2017-11-14 11:36:05'),(114,'留存分析','','###',3,'{\"upid\":110,\"towid\":0}',1,110,'','2017-11-14 11:36:34'),(115,'实时数据','','###',4,'{\"upid\":110,\"towid\":0}',1,110,'','2017-11-14 11:36:19'),(116,'付费分析','','###',5,'{\"upid\":110,\"towid\":0}',1,110,'','2017-11-14 11:36:50'),(118,'SDK管理','','###',0,'{\"upid\":52,\"towid\":0}',1,52,'','2017-11-14 11:30:38'),(119,'用户信息','','###',0,'{\"upid\":42,\"towid\":0}',1,42,'','2017-11-14 11:37:50'),(120,'游戏相关','','###',0,'{\"upid\":42,\"towid\":0}',1,42,'','2017-11-14 11:41:36'),(121,'订单列表','','###',1,'{\"upid\":52,\"towid\":0}',1,52,'','2017-11-14 11:42:38'),(122,'物品流水','','/Jy_statistics/SummaryGoods/index',0,'{\"upid\":110,\"towid\":111}',1,111,'','2017-11-14 16:42:30'),(130,'全局数据','','/Jy_statistics/GameValueOveral/index',0,'{\"upid\":110,\"towid\":127}',1,127,'','2017-11-29 10:30:57'),(124,'客服咨询','','###',0,'{\"upid\":105,\"towid\":0}',1,105,'','2017-11-21 12:12:43'),(125,'反馈列表','','/jy_admin/FeedBack/index',0,'{\"upid\":105,\"towid\":124}',1,124,'','2017-11-21 12:13:55'),(126,'游戏数值','','/jy_admin/SetGameValue/index',0,'{\"upid\":1,\"towid\":103}',1,103,'','2017-11-21 17:08:02'),(127,'游戏数值','','###',0,'{\"upid\":110,\"towid\":0}',1,110,'','2017-11-23 12:00:06'),(128,'场次数据','','/Jy_statistics/GameValue/index',0,'{\"upid\":110,\"towid\":127}',1,127,'','2017-11-29 10:27:08'),(131,'热更流程','','/Jy_statistics/IpAddrLog/index',0,'{\"upid\":110,\"towid\":111}',1,111,'','2017-12-15 17:55:18'),(132,'CDK配置','','###',0,'{\"upid\":105,\"towid\":0}',1,105,'','2017-12-20 14:41:53'),(133,'CDK列表','','/jy_admin/CdkList/index',0,'{\"upid\":105,\"towid\":132}',1,132,'','2017-12-25 14:59:58'),(134,'兑换记录','','###',0,'{\"upid\":105,\"towid\":132}',1,132,'','2017-12-20 14:45:34'),(135,'CDK','','/jy_admin/CdkGoodsConfigure/index',0,'{\"upid\":105,\"towid\":106}',1,106,'','2017-12-21 11:13:30'),(136,'产出CDK','','/jy_admin/CdkConfigure/index',0,'{\"upid\":105,\"towid\":132}',1,132,'','2017-12-22 11:21:39'),(137,'配置更新','','/jy_admin/PushDown/add',0,'{\"upid\":105,\"towid\":106}',1,106,'','2017-12-26 14:21:32');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
