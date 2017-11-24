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

/*Table structure for table `jy_vip_reward` */

DROP TABLE IF EXISTS `jy_vip_reward`;

CREATE TABLE `jy_vip_reward` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'vip每日奖励',
  `Level` int(6) DEFAULT NULL COMMENT '等级',
  `GoodsID` int(10) unsigned NOT NULL COMMENT '物品ID',
  `Title` varchar(100) NOT NULL COMMENT '奖励名称',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `Number` bigint(20) unsigned NOT NULL COMMENT '数量',
  `Remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`Id`),
  KEY `GoodsID` (`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `jy_vip_reward` */

insert  into `jy_vip_reward`(`Id`,`Level`,`GoodsID`,`Title`,`Type`,`Number`,`Remark`,`DateTime`) values (4,1,42,'2万金币',1,20000,'','2017-09-20 20:54:07'),(5,4,42,'7万金币',1,70000,'','2017-09-21 14:20:51'),(6,8,42,'65万金币',1,650000,'','2017-09-22 11:24:00'),(7,2,42,'3万金币',1,30000,'','2017-09-22 11:45:21'),(8,3,42,'4万金币',1,40000,'','2017-09-22 16:12:31'),(9,5,42,'12万金币',1,120000,'','2017-09-22 16:12:49'),(10,6,42,'25万金币',1,250000,'','2017-09-22 16:13:02'),(11,7,42,'40万金币',1,400000,'','2017-09-22 16:13:11'),(12,9,42,'100万金币',1,1000000,'','2017-09-22 16:13:29'),(13,10,42,'150万金币',1,1500000,'','2017-09-22 16:13:39');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
