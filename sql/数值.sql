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
  `produce_gold_1` bigint(20) DEFAULT NULL COMMENT '产出金币',
  `consume_gold_1` bigint(20) DEFAULT NULL COMMENT '消耗金币',
  `fish_card_1` bigint(20) DEFAULT NULL COMMENT '产出渔劵',
  `bomb_1` bigint(20) DEFAULT NULL COMMENT '产出核弹',
  `score_1` bigint(20) DEFAULT NULL COMMENT '产出积分',
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
  `boss_award_pool` bigint(20) DEFAULT NULL COMMENT '核弹奖池',
  PRIMARY KEY (`mdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `game_numerical` */

insert  into `game_numerical`(`mdate`,`produce_gold_1`,`consume_gold_1`,`fish_card_1`,`bomb_1`,`score_1`,`produce_gold_2`,`consume_gold_2`,`fish_card_2`,`bomb_2`,`score_2`,`produce_gold_3`,`consume_gold_3`,`fish_card_3`,`bomb_3`,`score_3`,`produce_gold_4`,`consume_gold_4`,`fish_card_4`,`bomb_4`,`score_4`,`boss_award_pool`) values ('2017-11-23',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),('2017-11-24',340,0,0,0,0,0,0,0,0,0,1418400000,0,0,463,141840000,0,0,0,0,0,0),('2017-11-27',1464350,0,1,0,640,2100000,0,0,0,0,1485705000,0,4200,464,144493500,94308000,0,3900,0,3498000,0);

/*Table structure for table `game_player_numerical` */

DROP TABLE IF EXISTS `game_player_numerical`;

CREATE TABLE `game_player_numerical` (
  `playerid` bigint(20) NOT NULL,
  `pay1` int(20) DEFAULT NULL COMMENT '当日充值',
  `pay3` int(20) DEFAULT NULL COMMENT '3日充值',
  `pay7` int(20) DEFAULT NULL COMMENT '7日充值',
  `pay30` int(20) DEFAULT NULL COMMENT '30日充值',
  `exchange_rmb30` float(4,0) DEFAULT NULL COMMENT '玩家30天内兑换的rmb',
  `base_catch_fish_rate_add` float(4,0) DEFAULT NULL COMMENT '基础捕中率加成',
  `key_catch_fish_rate_add` float(4,0) DEFAULT NULL COMMENT 'KEY鱼捕中加成',
  `fish_card_rate` float(4,0) DEFAULT NULL COMMENT '渔券捕中率',
  `key_fish_rate` float(4,0) DEFAULT NULL COMMENT 'KEY鱼捕中率',
  `score` bigint(20) DEFAULT NULL COMMENT '积分',
  `channel` varchar(24) DEFAULT NULL COMMENT '渠道',
  `game_ver` varchar(24) DEFAULT NULL COMMENT '脚本版本号',
  `app_ver` varchar(24) DEFAULT NULL COMMENT '包版本号',
  `draw_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`playerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `game_player_numerical` */

insert  into `game_player_numerical`(`playerid`,`pay1`,`pay3`,`pay7`,`pay30`,`exchange_rmb30`,`base_catch_fish_rate_add`,`key_catch_fish_rate_add`,`fish_card_rate`,`key_fish_rate`,`score`,`channel`,`game_ver`,`app_ver`,`draw_count`) values (107879,0,0,0,0,0,0,0,0,0,0,'0','','',NULL),(110028,0,0,0,0,0,0,0,0,0,17690060,'17690060','1.0.2','1001',NULL),(110334,0,0,0,0,0,0,0,0,0,13508665,'13508665','1.0.2','1001',NULL),(112131,0,0,0,0,0,0,0,0,0,880200,'880200','1.0.2','1001',NULL),(112183,0,0,0,0,0,0,0,1,0,19875,'19875','1.0.2','1001',NULL),(112564,0,0,0,0,0,0,0,0,0,0,'0','1.0.2','1001',NULL),(112580,0,0,0,0,0,0,0,0,0,0,'0','','',NULL),(112600,0,0,0,0,0,0,0,0,0,0,'0','','',NULL),(112701,0,0,0,0,0,0,0,0,0,0,'0','1.0','',NULL),(114704,0,0,0,0,0,0,0,0,0,0,'0','','',NULL),(114705,0,0,0,0,0,0,0,0,0,0,'0','','',NULL),(114706,0,0,0,0,0,0,0,0,0,0,'0','','',NULL),(114707,0,0,0,0,0,0,0,0,0,0,'0','','',NULL),(114708,0,0,0,0,0,0,0,0,0,0,'0','','',NULL),(114710,0,0,0,0,0,0,0,0,0,0,'0','','',NULL),(114711,0,0,0,0,0,0,0,0,0,0,'0','','',NULL),(114712,0,0,0,0,0,0,0,0,0,0,'0','1.0.2','1001',NULL),(114713,0,0,0,0,0,0,0,0,0,0,'0','1.0','',NULL),(114714,0,0,0,0,0,0,0,1,0,0,'0','1.0.2','1001',0),(114715,0,0,0,0,0,0,0,0,0,0,'0','','',NULL),(114716,0,0,0,0,0,0,0,0,0,0,'0','1.0.2','1001',NULL);

/*Table structure for table `log_client` */

DROP TABLE IF EXISTS `log_client`;

CREATE TABLE `log_client` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Key` varchar(255) DEFAULT NULL,
  `Value` text NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Key` (`Key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `log_client` */

/*Table structure for table `log_feed_back` */

DROP TABLE IF EXISTS `log_feed_back`;

CREATE TABLE `log_feed_back` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户反馈表',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `Status` tinyint(4) unsigned NOT NULL COMMENT '1-待处理 2-已处理',
  `Type` tinyint(4) unsigned NOT NULL COMMENT '1-充值 2-游戏体验',
  `Fcontent` text NOT NULL COMMENT '玩家提问内容',
  `Rcontent` text COMMENT '客服回复内容',
  `PackageVersion` varchar(20) NOT NULL COMMENT '包版本',
  `TxQq` varchar(20) DEFAULT NULL COMMENT 'QQ',
  `Phone` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `Channel` varchar(20) NOT NULL COMMENT '渠道号',
  `VerSion` varchar(50) NOT NULL COMMENT '脚本版本',
  `UpDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  `UpName` varchar(50) DEFAULT NULL COMMENT '更新人',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '提交时间',
  `IsDel` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`DateTime`),
  KEY `IsDel` (`IsDel`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `log_feed_back` */

insert  into `log_feed_back`(`Id`,`playerid`,`Status`,`Type`,`Fcontent`,`Rcontent`,`PackageVersion`,`TxQq`,`Phone`,`Channel`,`VerSion`,`UpDateTime`,`UpName`,`DateTime`,`IsDel`) values (1,321,2,1,'32132','2312312','312','31','1','123','1','2017-11-24 11:41:45',NULL,'2017-11-24 11:41:45',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
