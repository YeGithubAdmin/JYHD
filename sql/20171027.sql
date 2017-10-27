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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `summary_goods` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
