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

/*Table structure for table `log_thirtyday_sign` */

DROP TABLE IF EXISTS `log_thirtyday_sign`;

CREATE TABLE `log_thirtyday_sign` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '签到记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `DayNum` int(11) NOT NULL COMMENT '累计签到天数',
  `Primary` int(11) NOT NULL DEFAULT '1' COMMENT '轮回次数',
  `Continuity` int(4) unsigned NOT NULL COMMENT '连续签到天数',
  `Status` tinyint(1) NOT NULL COMMENT '第几个月',
  `Day` int(4) NOT NULL COMMENT '第几天',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '签到时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`DateTime`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
