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

/*Table structure for table `log_feed_back` */

DROP TABLE IF EXISTS `log_feed_back`;

CREATE TABLE `log_feed_back` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户反馈表',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `Status` tinyint(4) unsigned NOT NULL COMMENT '1-待处理 2-已处理',
  `Type` tinyint(4) unsigned NOT NULL COMMENT '1-充值 2-游戏体验',
  `Fcontent` text NOT NULL COMMENT '玩家提问内容',
  `Rcontent` text NOT NULL COMMENT '客服回复内容',
  `PackageVersion` varchar(20) NOT NULL COMMENT '包版本',
  `TxQq` varchar(20) DEFAULT NULL COMMENT 'QQ',
  `Phone` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `Channel` varchar(20) NOT NULL COMMENT '渠道号',
  `VerSion` varchar(50) NOT NULL COMMENT '脚本版本',
  `UpDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  `UpName` varchar(50) DEFAULT NULL COMMENT '更新人',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '提交时间',
  `IsDel` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`DateTime`),
  KEY `IsDel` (`IsDel`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
