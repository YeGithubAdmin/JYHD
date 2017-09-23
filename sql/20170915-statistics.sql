/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.6.33-0ubuntu0.14.04.1 : Database - jyhd
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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
