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

/*Table structure for table `jy_vip_info` */

DROP TABLE IF EXISTS `jy_vip_info`;

CREATE TABLE `jy_vip_info` (
  `level` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '等级',
  `GiveInfo` varchar(50) NOT NULL COMMENT '赠送信息',
  `ImgCode` varchar(50) NOT NULL COMMENT '图标',
  `Describe` varchar(255) NOT NULL COMMENT '描述',
  `Number` int(11) DEFAULT NULL,
  `Type` tinyint(1) DEFAULT NULL,
  `experience` int(11) NOT NULL COMMENT '充值额度',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jy_vip_info` */

insert  into `jy_vip_info`(`level`,`GiveInfo`,`ImgCode`,`Describe`,`Number`,`Type`,`experience`,`mtime`) values (0,'','','',NULL,NULL,0,'2017-09-07 18:02:08'),(1,'破空','gun_02_01.png','每日签到双倍 \r\n每日免费领取',20000,1,30,'2017-07-26 11:52:02'),(2,'怒雷','gun_03_01.png','在线奖励金币翻倍\r\n每日免费领取',30000,1,100,'2017-08-18 10:48:01'),(3,'灾星','gun_04_01.png','锁定时间x2\r\n每日免费领取',40000,1,300,'2017-08-18 10:48:57'),(4,'厄运','gun_05_01.png','捕鱼概率2倍奖励\r\n每日免费领取',70000,1,800,'2017-08-18 10:49:12'),(5,'魔焰','gun_06_01.png','捕渔券概率x2\r\n每日免费领取',120000,1,2000,'2017-08-18 10:49:32'),(6,'苍穹','gun_07_01.png','捕鱼概率3倍奖励\r\n每日免费领取',250000,1,5000,'2017-08-18 10:49:39'),(7,'君主','gun_08_01.png','捕渔券概率x4\r\n每日免费领取',400000,1,10000,'2017-08-18 10:49:46'),(8,'冰魄','gun_09_01.png','提升打BOSS概率\r\n每日免费领取',650000,1,20000,'2017-08-18 10:49:57'),(9,'祸忌','gun_10_01.png','获得核弹概率x2\r\n每日免费领取',1000000,1,50000,'2017-08-18 10:50:05'),(10,'魔神','gun_11_01.png','提升捕获所有鱼的概率\r\n每日免费领取',1500000,1,100000,'2017-08-18 10:50:12');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
