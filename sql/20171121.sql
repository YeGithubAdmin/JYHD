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

/*Table structure for table `conf_game_logic` */

DROP TABLE IF EXISTS `conf_game_logic`;

CREATE TABLE `conf_game_logic` (
  `Type` varchar(20) NOT NULL COMMENT '类型',
  `Status` tinyint(1) NOT NULL COMMENT '1-开启 2-关闭',
  `AdminID` int(6) NOT NULL COMMENT '操作人ID',
  `AdminName` varchar(50) NOT NULL COMMENT '操作人名',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `conf_novice_pack` */

DROP TABLE IF EXISTS `conf_novice_pack`;

CREATE TABLE `conf_novice_pack` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '新手礼包',
  `Title` varchar(50) NOT NULL COMMENT '标题图片',
  `DescribeBomb` varchar(50) DEFAULT NULL,
  `DescribeGold` varchar(50) NOT NULL COMMENT '描述图片',
  `Bomb` varchar(50) NOT NULL COMMENT '导弹图片',
  `GoodsID` int(1) NOT NULL COMMENT '物品ID',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `Remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`Id`),
  KEY `GoosID` (`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `conf_thirtyday_continuity` */

DROP TABLE IF EXISTS `conf_thirtyday_continuity`;

CREATE TABLE `conf_thirtyday_continuity` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '连续签到奖励',
  `Name` varchar(50) NOT NULL COMMENT '名称',
  `ImgCode` varchar(100) NOT NULL COMMENT '图片名称',
  `Continuity` int(4) NOT NULL COMMENT '天数',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '操作时间',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `conf_thirtyday_continuity_goods` */

DROP TABLE IF EXISTS `conf_thirtyday_continuity_goods`;

CREATE TABLE `conf_thirtyday_continuity_goods` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Number` int(11) NOT NULL,
  `Type` tinyint(1) NOT NULL,
  `GoodsID` int(11) NOT NULL,
  `continuity` int(4) NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `conf_thirtyday_goods` */

DROP TABLE IF EXISTS `conf_thirtyday_goods`;

CREATE TABLE `conf_thirtyday_goods` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '签到奖励',
  `Day` int(4) NOT NULL COMMENT '天数',
  `Status` tinyint(1) NOT NULL,
  `GoodsID` int(11) NOT NULL,
  `Number` int(11) NOT NULL,
  `Sort` int(4) NOT NULL,
  `Type` tinyint(1) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Day` (`Day`,`Status`),
  KEY `CoodsID` (`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Table structure for table `conf_thirtyday_sign` */

DROP TABLE IF EXISTS `conf_thirtyday_sign`;

CREATE TABLE `conf_thirtyday_sign` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '签到形象配置',
  `ImgCode` varchar(50) NOT NULL COMMENT '图片',
  `Day` int(4) NOT NULL COMMENT '天数',
  `Color` tinyint(1) NOT NULL DEFAULT '1' COMMENT '底色 1-否 2-是',
  `LongTitle` varchar(50) NOT NULL COMMENT '长标题',
  `ShortTitle` varchar(50) NOT NULL COMMENT '短标题',
  `Status` tinyint(1) NOT NULL COMMENT '1-第1个月 2-第2,3个月 第4,5,6个月',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '操作时间',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Day` (`Day`,`Status`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
