/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.20-0ubuntu0.16.04.1-log : Database - jyhd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jyhd` /*!40100 DEFAULT CHARACTER SET utf8 */;

/*Table structure for table `log_users_shop_0` */

DROP TABLE IF EXISTS `log_users_shop_0`;

CREATE TABLE `log_users_shop_0` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户购物记录表',
  `playerid` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned DEFAULT NULL COMMENT '物品ID',
  `Code` varchar(50) DEFAULT NULL COMMENT '物品编码',
  `Type` tinyint(1) DEFAULT NULL COMMENT '类型',
  `Price` float DEFAULT NULL,
  `Number` bigint(20) DEFAULT NULL,
  `Form` tinyint(1) DEFAULT NULL,
  `DateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Code` (`Code`),
  KEY `DateTime` (`DateTime`),
  KEY `playerid` (`playerid`,`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8;

/*Table structure for table `log_users_shop_1` */

DROP TABLE IF EXISTS `log_users_shop_1`;

CREATE TABLE `log_users_shop_1` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户购物记录表',
  `playerid` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned DEFAULT NULL COMMENT '物品ID',
  `Code` varchar(50) DEFAULT NULL COMMENT '物品编码',
  `Type` tinyint(1) DEFAULT NULL COMMENT '类型',
  `Price` float DEFAULT NULL,
  `Number` bigint(20) DEFAULT NULL,
  `Form` tinyint(1) DEFAULT NULL,
  `DateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Code` (`Code`),
  KEY `DateTime` (`DateTime`),
  KEY `playerid` (`playerid`,`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8;

/*Table structure for table `log_users_shop_2` */

DROP TABLE IF EXISTS `log_users_shop_2`;

CREATE TABLE `log_users_shop_2` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户购物记录表',
  `playerid` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned DEFAULT NULL COMMENT '物品ID',
  `Code` varchar(50) DEFAULT NULL COMMENT '物品编码',
  `Type` tinyint(1) DEFAULT NULL COMMENT '类型',
  `Price` float DEFAULT NULL,
  `Number` bigint(20) DEFAULT NULL,
  `Form` tinyint(1) DEFAULT NULL,
  `DateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Code` (`Code`),
  KEY `DateTime` (`DateTime`),
  KEY `playerid` (`playerid`,`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8;

/*Table structure for table `log_users_shop_3` */

DROP TABLE IF EXISTS `log_users_shop_3`;

CREATE TABLE `log_users_shop_3` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户购物记录表',
  `playerid` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned DEFAULT NULL COMMENT '物品ID',
  `Code` varchar(50) DEFAULT NULL COMMENT '物品编码',
  `Type` tinyint(1) DEFAULT NULL COMMENT '类型',
  `Price` float DEFAULT NULL,
  `Number` bigint(20) DEFAULT NULL,
  `Form` tinyint(1) DEFAULT NULL,
  `DateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Code` (`Code`),
  KEY `DateTime` (`DateTime`),
  KEY `playerid` (`playerid`,`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8;

/*Table structure for table `log_users_shop_4` */

DROP TABLE IF EXISTS `log_users_shop_4`;

CREATE TABLE `log_users_shop_4` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户购物记录表',
  `playerid` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned DEFAULT NULL COMMENT '物品ID',
  `Code` varchar(50) DEFAULT NULL COMMENT '物品编码',
  `Type` tinyint(1) DEFAULT NULL COMMENT '类型',
  `Price` float DEFAULT NULL,
  `Number` bigint(20) DEFAULT NULL,
  `Form` tinyint(1) DEFAULT NULL,
  `DateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Code` (`Code`),
  KEY `DateTime` (`DateTime`),
  KEY `playerid` (`playerid`,`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=277 DEFAULT CHARSET=utf8;

/*Table structure for table `log_users_shop_5` */

DROP TABLE IF EXISTS `log_users_shop_5`;

CREATE TABLE `log_users_shop_5` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户购物记录表',
  `playerid` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned DEFAULT NULL COMMENT '物品ID',
  `Code` varchar(50) DEFAULT NULL COMMENT '物品编码',
  `Type` tinyint(1) DEFAULT NULL COMMENT '类型',
  `Price` float DEFAULT NULL,
  `Number` bigint(20) DEFAULT NULL,
  `Form` tinyint(1) DEFAULT NULL,
  `DateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Code` (`Code`),
  KEY `DateTime` (`DateTime`),
  KEY `playerid` (`playerid`,`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8;

/*Table structure for table `log_users_shop_6` */

DROP TABLE IF EXISTS `log_users_shop_6`;

CREATE TABLE `log_users_shop_6` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户购物记录表',
  `playerid` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned DEFAULT NULL COMMENT '物品ID',
  `Code` varchar(50) DEFAULT NULL COMMENT '物品编码',
  `Type` tinyint(1) DEFAULT NULL COMMENT '类型',
  `Price` float DEFAULT NULL,
  `Number` bigint(20) DEFAULT NULL,
  `Form` tinyint(1) DEFAULT NULL,
  `DateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Code` (`Code`),
  KEY `DateTime` (`DateTime`),
  KEY `playerid` (`playerid`,`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8;

/*Table structure for table `log_users_shop_7` */

DROP TABLE IF EXISTS `log_users_shop_7`;

CREATE TABLE `log_users_shop_7` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户购物记录表',
  `playerid` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned DEFAULT NULL COMMENT '物品ID',
  `Code` varchar(50) DEFAULT NULL COMMENT '物品编码',
  `Type` tinyint(1) DEFAULT NULL COMMENT '类型',
  `Price` float DEFAULT NULL,
  `Number` bigint(20) DEFAULT NULL,
  `Form` tinyint(1) DEFAULT NULL,
  `DateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Code` (`Code`),
  KEY `DateTime` (`DateTime`),
  KEY `playerid` (`playerid`,`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8;

/*Table structure for table `log_users_shop_8` */

DROP TABLE IF EXISTS `log_users_shop_8`;

CREATE TABLE `log_users_shop_8` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户购物记录表',
  `playerid` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned DEFAULT NULL COMMENT '物品ID',
  `Code` varchar(50) DEFAULT NULL COMMENT '物品编码',
  `Type` tinyint(1) DEFAULT NULL COMMENT '类型',
  `Price` float DEFAULT NULL,
  `Number` bigint(20) DEFAULT NULL,
  `Form` tinyint(1) DEFAULT NULL,
  `DateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Code` (`Code`),
  KEY `DateTime` (`DateTime`),
  KEY `playerid` (`playerid`,`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;

/*Table structure for table `log_users_shop_9` */

DROP TABLE IF EXISTS `log_users_shop_9`;

CREATE TABLE `log_users_shop_9` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户购物记录表',
  `playerid` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned DEFAULT NULL COMMENT '物品ID',
  `Code` varchar(50) DEFAULT NULL COMMENT '物品编码',
  `Type` tinyint(1) DEFAULT NULL COMMENT '类型',
  `Price` float DEFAULT NULL,
  `Number` bigint(20) DEFAULT NULL,
  `Form` tinyint(1) DEFAULT NULL,
  `DateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Code` (`Code`),
  KEY `DateTime` (`DateTime`),
  KEY `playerid` (`playerid`,`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
