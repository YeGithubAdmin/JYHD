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

/*Table structure for table `game_numerical` */

DROP TABLE IF EXISTS `game_numerical`;

CREATE TABLE `game_numerical` (
  `mdate` date NOT NULL,
  `produce_gold_1` bigint(20) DEFAULT NULL,
  `consume_gold_1` bigint(20) DEFAULT NULL,
  `fish_card_1` bigint(20) DEFAULT NULL,
  `bomb_1` bigint(20) DEFAULT NULL,
  `score_1` bigint(20) DEFAULT NULL,
  `produce_gold_2` bigint(20) DEFAULT NULL,
  `consume_gold_2` bigint(20) DEFAULT NULL,
  `fish_card_2` bigint(20) DEFAULT NULL,
  `bomb_2` bigint(20) DEFAULT NULL,
  `score_2` bigint(20) DEFAULT NULL,
  `produce_gold_3` bigint(20) DEFAULT NULL,
  `consume_gold_3` bigint(20) DEFAULT NULL,
  `fish_card_3` bigint(20) DEFAULT NULL,
  `bomb_3` bigint(20) DEFAULT NULL,
  `score_3` bigint(20) DEFAULT NULL,
  `produce_gold_4` bigint(20) DEFAULT NULL,
  `consume_gold_4` bigint(20) DEFAULT NULL,
  `fish_card_4` bigint(20) DEFAULT NULL,
  `bomb_4` bigint(20) DEFAULT NULL,
  `score_4` bigint(20) DEFAULT NULL,
  `boss_award_pool` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`mdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `game_player_numerical` */

DROP TABLE IF EXISTS `game_player_numerical`;

CREATE TABLE `game_player_numerical` (
  `playerid` bigint(20) NOT NULL,
  `pay1` int(20) DEFAULT NULL,
  `pay3` int(20) DEFAULT NULL,
  `pay7` int(20) DEFAULT NULL,
  `pay30` int(20) DEFAULT NULL,
  `exchange_rmb30` float(4,0) DEFAULT NULL,
  `base_catch_fish_rate_add` float(4,0) DEFAULT NULL,
  `key_catch_fish_rate_add` float(4,0) DEFAULT NULL,
  `fish_card_rate` float(4,0) DEFAULT NULL,
  `key_fish_rate` float(4,0) DEFAULT NULL,
  `score` bigint(20) DEFAULT NULL,
  `channel` varchar(24) DEFAULT NULL,
  `game_ver` varchar(24) DEFAULT NULL,
  `app_ver` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`playerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
