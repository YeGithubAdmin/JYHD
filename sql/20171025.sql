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

USE `jyhd`;

/*Table structure for table `jy_statistics_activem_acroscopic` */

DROP TABLE IF EXISTS `jy_statistics_activem_acroscopic`;

CREATE TABLE `jy_statistics_activem_acroscopic` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '统计活跃-宏观数据',
  `Account` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '账号活跃',
  `EquipmentAndroid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '设备活跃-安卓',
  `EquipmentIos` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '设备活跃-苹果',
  `WAU` int(11) NOT NULL DEFAULT '0' COMMENT '周活跃',
  `MAU` int(11) NOT NULL DEFAULT '0' COMMENT '月活跃',
  `UserGame` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户游戏数量',
  `BankruptcyNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '破产数量',
  `Channel` varchar(50) NOT NULL COMMENT '渠道',
  `VerSion` varchar(50) NOT NULL COMMENT '版本',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`Channel`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `jy_statistics_activem_acroscopic` */

insert  into `jy_statistics_activem_acroscopic`(`Id`,`Account`,`EquipmentAndroid`,`EquipmentIos`,`WAU`,`MAU`,`UserGame`,`BankruptcyNum`,`Channel`,`VerSion`,`DateTime`) values (1,0,0,0,0,0,0,0,'JYHD_0','1.0','2017-10-23 18:52:18'),(2,0,0,0,0,0,0,0,'JYHD_0','1.1','2017-10-23 18:52:18'),(3,0,0,0,0,0,0,0,'JYHD_JinLi','1.0','2017-10-23 18:52:18'),(4,0,0,0,0,0,0,0,'JYHD_JinLi','1.1','2017-10-23 18:52:18'),(5,0,0,0,0,0,0,0,'13724894160','1.0','2017-10-23 18:52:18'),(6,0,0,0,0,0,0,0,'13724894160','1.1','2017-10-23 18:52:18');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
