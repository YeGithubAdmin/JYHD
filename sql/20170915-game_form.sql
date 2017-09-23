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

/*Table structure for table `jy_game_form` */

DROP TABLE IF EXISTS `jy_game_form`;

CREATE TABLE `jy_game_form` (
  `Name` varchar(50) NOT NULL COMMENT '游戏项目类型',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1-游戏 2-充值 3-签到 4-兑换 5-月卡 6-首冲',
  PRIMARY KEY (`Type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jy_game_form` */

insert  into `jy_game_form`(`Name`,`Type`) values ('游戏',1),('充值',2),('签到',3),('兑换',4),('月卡',5),('首冲',6);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
