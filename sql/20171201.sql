/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.6.33-0ubuntu0.14.04.1-log : Database - jyhd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jyhd` /*!40100 DEFAULT CHARACTER SET utf8 */;

/*Table structure for table `log_channel_data` */

DROP TABLE IF EXISTS `log_channel_data`;

CREATE TABLE `log_channel_data` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户付费统计',
  `alipay` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '支付宝',
  `weixin` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '微信',
  `JinPay` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '金立',
  `iappay` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '爱贝',
  `PayNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '付费次数',
  `UserPayNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '付费用户数',
  `RegNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '账号注册人数',
  `EquipmentRegNum` int(11) NOT NULL DEFAULT '0' COMMENT '设备号',
  `ActiveNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '活跃数',
  `TotalMoney` float unsigned NOT NULL DEFAULT '0' COMMENT '日收入总额',
  `Success` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '成功',
  `UserPayNumOld` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '老用户数量',
  `OrderTotalOld` float unsigned NOT NULL DEFAULT '0' COMMENT '老用户订单总额',
  `OrderTotal` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '订单总数',
  `First` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '首次充值数',
  `UsersOneNum` varchar(10) DEFAULT NULL COMMENT '次日留存',
  `UsersTowNum` varchar(10) DEFAULT NULL COMMENT '二日留存',
  `UsersThreeNum` varchar(10) DEFAULT NULL COMMENT '三日留存',
  `UsersSevenNum` varchar(10) DEFAULT NULL COMMENT '七日留存',
  `UsersFifteenNum` varchar(10) DEFAULT NULL COMMENT '十五留存',
  `UsersThirtyNum` varchar(10) DEFAULT NULL COMMENT '三十日留存',
  `Channel` varchar(50) NOT NULL COMMENT '渠道号',
  `FirstMoney` float unsigned NOT NULL DEFAULT '0' COMMENT '首付金额',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`Channel`)
) ENGINE=MyISAM AUTO_INCREMENT=189 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
