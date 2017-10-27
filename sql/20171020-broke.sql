/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.19-0ubuntu0.16.04.1-log : Database - jyhd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jyhd` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `jyhd`;

/*Table structure for table `game_broke_action` */

DROP TABLE IF EXISTS `game_broke_action`;

CREATE TABLE `game_broke_action` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `playerid` bigint(20) DEFAULT NULL,
  `login_channel` varchar(24) DEFAULT NULL,
  `game_ver` varchar(24) DEFAULT NULL,
  `broke_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `game_broke_action` */

insert  into `game_broke_action`(`id`,`playerid`,`login_channel`,`game_ver`,`broke_time`) values (4,133775,'JYHD_0','1.0','2017-10-23 19:55:17'),(5,133775,'JYHD_0','1.0','2017-10-23 19:55:39'),(6,133775,'JYHD_0','1.0','2017-10-23 19:56:35');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
