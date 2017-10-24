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
USE `jyhd`;

/*Table structure for table `game_account` */

DROP TABLE IF EXISTS `game_account`;

CREATE TABLE `game_account` (
  `playerid` bigint(20) NOT NULL,
  `account_type` int(11) DEFAULT NULL COMMENT '帐号类型 (1游客，2自定义)',
  `os_type` int(11) DEFAULT NULL COMMENT '系统类型 (1ios, 2安卓)',
  `mac` varchar(128) DEFAULT NULL COMMENT 'mac地址',
  `imei` varchar(128) DEFAULT NULL COMMENT '手机序列号',
  `imsi` varchar(128) DEFAULT NULL COMMENT '运营商序列号',
  `uuid` varchar(128) DEFAULT NULL COMMENT '苹果uuid',
  `mobile` bigint(20) DEFAULT NULL COMMENT '手机号',
  `accountstate` int(11) DEFAULT NULL COMMENT '账户状态(1正常, 2封号, 3已经登录)',
  `regtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `lasttime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后登录时间',
  `block_desc` varchar(255) DEFAULT NULL COMMENT '封号原因',
  `loginip` varchar(24) DEFAULT NULL COMMENT '登录ip',
  `reg_channel` varchar(32) DEFAULT NULL COMMENT '注册渠道号',
  `login_channel` varchar(32) DEFAULT NULL COMMENT '登录渠道号',
  `phone_model` varchar(24) DEFAULT NULL COMMENT '手机型号',
  `phone_os_ver` varchar(24) DEFAULT NULL COMMENT '手机系统版本',
  `game_ver` varchar(24) DEFAULT NULL COMMENT '游戏版本号',
  `communiid` bigint(20) DEFAULT NULL COMMENT '通讯id',
  `account_name` varchar(24) DEFAULT NULL COMMENT '自定义账号名',
  `pwd` varchar(24) DEFAULT NULL COMMENT '自定义密码',
  `logout_time` varchar(24) DEFAULT NULL COMMENT '最后离线时间',
  PRIMARY KEY (`playerid`),
  KEY `regtime` (`regtime`),
  KEY `reg_channel` (`reg_channel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `game_item` */

DROP TABLE IF EXISTS `game_item`;

CREATE TABLE `game_item` (
  `playerid` bigint(20) NOT NULL,
  `item1_num` int(11) NOT NULL,
  `item2_num` int(11) NOT NULL,
  `item3_num` int(11) NOT NULL,
  `item4_num` int(11) NOT NULL,
  `item5_num` int(11) NOT NULL,
  `item6_num` int(11) NOT NULL,
  PRIMARY KEY (`playerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `game_login_action` */

DROP TABLE IF EXISTS `game_login_action`;

CREATE TABLE `game_login_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户登录记录表',
  `playerid` bigint(20) NOT NULL COMMENT '用户ID',
  `account_type` tinyint(1) unsigned NOT NULL COMMENT '帐号类型 (1游客，2自定义)',
  `os_type` tinyint(1) unsigned NOT NULL COMMENT '系统类型 (1ios, 2安卓)',
  `login_channel` varchar(64) NOT NULL COMMENT '登录渠道',
  `reg_channel` varchar(64) NOT NULL COMMENT '注册渠道',
  `game_ver` varchar(24) NOT NULL COMMENT '游戏版本号',
  `name` varchar(24) NOT NULL COMMENT '用户名',
  `vip` int(11) NOT NULL COMMENT 'vip等级',
  `vip_exp` int(11) NOT NULL COMMENT 'vip经验',
  `glevel` int(11) NOT NULL COMMENT '游戏等级',
  `gexp` int(11) NOT NULL COMMENT '游戏经验',
  `gold` bigint(20) NOT NULL COMMENT '金币',
  `diamond` bigint(20) NOT NULL COMMENT '砖石',
  `deposit` bigint(20) NOT NULL COMMENT '存款',
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  PRIMARY KEY (`id`),
  KEY `login_time` (`login_time`,`playerid`),
  KEY `login_channel` (`login_channel`)
) ENGINE=InnoDB AUTO_INCREMENT=462 DEFAULT CHARSET=utf8;

/*Table structure for table `game_player` */

DROP TABLE IF EXISTS `game_player`;

CREATE TABLE `game_player` (
  `playerid` bigint(20) NOT NULL COMMENT '玩家id',
  `name` varchar(64) DEFAULT NULL COMMENT '昵称',
  `sex` int(11) DEFAULT NULL COMMENT '1 男 2 女',
  `vip` int(11) DEFAULT NULL COMMENT 'vip 等级',
  `vip_exp` int(11) DEFAULT NULL COMMENT 'vip 经验',
  `status` int(11) DEFAULT NULL COMMENT '游戏状态（1离线，2在线，3玩牌）',
  `serverid` int(11) DEFAULT NULL COMMENT '所在游戏服务器id',
  `game_type` int(11) DEFAULT NULL COMMENT '所在游戏类型',
  `room_type` int(11) DEFAULT NULL COMMENT '所在房间类型',
  `level_type` int(11) DEFAULT NULL COMMENT '所在场次类型',
  `roomid` int(11) DEFAULT NULL COMMENT '所在房间id',
  `gold` bigint(20) DEFAULT NULL COMMENT '金币',
  `diamond` bigint(20) DEFAULT NULL COMMENT '钻石',
  `deposit` bigint(20) DEFAULT NULL COMMENT '存款',
  `profit` bigint(20) DEFAULT NULL COMMENT '当日盈利',
  `glevel` int(11) DEFAULT NULL COMMENT '游戏等级',
  `gexp` int(11) DEFAULT NULL COMMENT '游戏经验',
  `gun_lv` int(11) DEFAULT NULL COMMENT '炮的等级',
  `sign_day` int(11) DEFAULT NULL COMMENT '累计签到天数',
  `sign_time` bigint(20) DEFAULT NULL COMMENT '签到时间',
  `gunid` int(11) DEFAULT NULL COMMENT '当前炮的id',
  `icon_url` varchar(64) DEFAULT NULL COMMENT '头像',
  `is_mc` int(11) DEFAULT NULL COMMENT '是否是月卡用户',
  `mc_overtime` bigint(20) DEFAULT NULL COMMENT '月卡结束时间',
  PRIMARY KEY (`playerid`),
  KEY `status` (`status`,`level_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `game_reschange_action` */

DROP TABLE IF EXISTS `game_reschange_action`;

CREATE TABLE `game_reschange_action` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `playerid` bigint(20) unsigned DEFAULT NULL COMMENT '用户ID',
  `account_type` tinyint(4) DEFAULT NULL COMMENT '账号类型（1游客，2自定义）',
  `os_type` tinyint(4) DEFAULT NULL COMMENT '系统类型 (1ios, 2安卓)',
  `login_channel` varchar(64) DEFAULT NULL COMMENT '登录渠道',
  `reg_channel` varchar(64) DEFAULT NULL COMMENT '注册渠道',
  `game_ver` varchar(24) DEFAULT NULL COMMENT '游戏版本号',
  `itemid` int(11) DEFAULT NULL COMMENT '物品ID',
  `add_num` int(11) DEFAULT NULL COMMENT '增量',
  `cur_num` int(11) DEFAULT NULL COMMENT '总量',
  `reason` tinyint(4) NOT NULL,
  `opt_time` datetime DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  KEY `playerid` (`playerid`,`reason`,`opt_time`)
) ENGINE=InnoDB AUTO_INCREMENT=4008 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_activity_father_list` */

DROP TABLE IF EXISTS `jy_activity_father_list`;

CREATE TABLE `jy_activity_father_list` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动父表',
  `Code` varchar(20) NOT NULL COMMENT '活动标识',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '活动类型 1-累计充值 2-单笔充值 3-循环充值 4-图片类型',
  `Title` varchar(50) NOT NULL COMMENT '活动标题',
  `AddUpStartTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '累计开始时间',
  `Channel` int(11) NOT NULL COMMENT '渠道列表',
  `AddUpEndTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '累计结束时间',
  `ShowStartTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '显示开始时间',
  `ShowEndTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '显示结束时间',
  `Describe` varchar(255) NOT NULL COMMENT '活动描述',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Type` (`Type`),
  KEY `Channel` (`Channel`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_activity_son_list` */

DROP TABLE IF EXISTS `jy_activity_son_list`;

CREATE TABLE `jy_activity_son_list` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动子表',
  `FatherID` int(11) unsigned NOT NULL COMMENT '活动父ID',
  `GoodsID` int(11) NOT NULL COMMENT '奖励商品',
  `Title` varchar(50) NOT NULL COMMENT '标题',
  `Number` int(11) NOT NULL COMMENT '奖品数量',
  `Schedule` int(11) NOT NULL COMMENT '条件',
  `ImgCode` varchar(50) NOT NULL COMMENT '图片标识',
  `ImgUrl` varchar(255) NOT NULL COMMENT '活动图片',
  `Code` varchar(20) NOT NULL COMMENT '活动标识',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `FatherID` (`FatherID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_admin_group` */

DROP TABLE IF EXISTS `jy_admin_group`;

CREATE TABLE `jy_admin_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户管理组',
  `name` varchar(20) NOT NULL COMMENT '组名',
  `authority` text NOT NULL COMMENT '组权限',
  `upid` int(11) NOT NULL DEFAULT '0' COMMENT '上级ID',
  `addId` int(11) NOT NULL COMMENT '添加ID',
  `addName` varchar(20) NOT NULL COMMENT '添加名',
  `islock` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否锁定 1-否 2-是',
  `add` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '添加权限 1-否 2-是',
  `DesktopAddress` varchar(255) NOT NULL COMMENT '添加地址',
  `channel` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否渠道组 1-否 2-是',
  `edit` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否能修改 1-否 2-是',
  `del` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否能删除 1-否 2-是',
  `isdel` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否删除 1-否 2-是',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `addId` (`addId`),
  KEY `isdel` (`isdel`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_admin_users` */

DROP TABLE IF EXISTS `jy_admin_users`;

CREATE TABLE `jy_admin_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '后台管理员表',
  `name` varchar(20) NOT NULL COMMENT '名字',
  `account` varchar(20) NOT NULL COMMENT '账号',
  `passwd` varchar(32) NOT NULL COMMENT '密码',
  `admingroup` int(11) NOT NULL COMMENT '组ID',
  `default` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否系统默认账号 1-否 2-是',
  `channel` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否渠道 1-否 2-是',
  `addName` varchar(20) NOT NULL COMMENT '添加名',
  `addId` int(11) unsigned NOT NULL COMMENT '添加ID',
  `islock` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否锁定 1-否 2-是',
  `isdel` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否删除 1-否 2-是',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `account` (`account`,`channel`),
  KEY `channel` (`channel`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_api_visit_log` */

DROP TABLE IF EXISTS `jy_api_visit_log`;

CREATE TABLE `jy_api_visit_log` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'api访问日志',
  `Name` varchar(50) NOT NULL COMMENT '名字',
  `Url` varchar(255) NOT NULL COMMENT '地址',
  `Code` int(4) NOT NULL COMMENT '状态码',
  `Msg` varchar(255) DEFAULT NULL COMMENT '状态说明',
  `TimeOut` varchar(20) DEFAULT NULL COMMENT '耗时',
  `AccessIP` varchar(50) NOT NULL COMMENT '访问IP',
  `DataTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '访问时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_channel_goods` */

DROP TABLE IF EXISTS `jy_channel_goods`;

CREATE TABLE `jy_channel_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '渠道商品',
  `adminUserID` int(11) unsigned NOT NULL COMMENT '渠道ID',
  `goodsID` int(11) unsigned NOT NULL COMMENT '商品ID',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `adminUserID` (`adminUserID`),
  KEY `goodsID` (`goodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=282 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_channel_info` */

DROP TABLE IF EXISTS `jy_channel_info`;

CREATE TABLE `jy_channel_info` (
  `adminUserID` int(11) unsigned NOT NULL COMMENT '渠道(管理员ID)',
  `platform` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '平台',
  `pattern` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '合作方式',
  `DividedInto` varchar(10) NOT NULL COMMENT '分成',
  `RegisterNum` varchar(10) NOT NULL COMMENT '注册人数（结算率）',
  `RechargeNum` varchar(10) NOT NULL COMMENT '充值人数（结算率）',
  `CorporateName` varchar(50) NOT NULL COMMENT '公司名称',
  `CompanyAddress` varchar(50) NOT NULL COMMENT '公司地址',
  `CompanyPhone` varchar(20) NOT NULL COMMENT '公司电话',
  `contacts` varchar(10) NOT NULL COMMENT '联系人',
  `ContactNumber` varchar(20) NOT NULL COMMENT '联系电话',
  `ContactMailbox` varchar(20) NOT NULL COMMENT '联系邮箱',
  `addName` varchar(20) NOT NULL COMMENT '添加人',
  `addId` int(11) NOT NULL COMMENT '添加ID',
  `isown` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否本公司渠道',
  `remark` varchar(255) NOT NULL COMMENT '备注信息',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`adminUserID`,`mtime`),
  KEY `platform` (`platform`),
  KEY `isown` (`isown`),
  KEY `addId` (`addId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `jy_channel_thirdpay` */

DROP TABLE IF EXISTS `jy_channel_thirdpay`;

CREATE TABLE `jy_channel_thirdpay` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '渠道支付ID',
  `adminUserID` int(11) unsigned NOT NULL COMMENT '渠道ID',
  `PayID` int(11) unsigned NOT NULL COMMENT '支付ID',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `adminUserID` (`adminUserID`),
  KEY `PayID` (`PayID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_currency_section` */

DROP TABLE IF EXISTS `jy_currency_section`;

CREATE TABLE `jy_currency_section` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '货币区间',
  `Name` varchar(50) NOT NULL COMMENT '名称',
  `Unit` tinyint(1) unsigned NOT NULL COMMENT '单位 1-个 2-十  3-百 4-千 5-万',
  `Start` bigint(20) NOT NULL COMMENT '起始值',
  `End` bigint(20) NOT NULL DEFAULT '0' COMMENT '结束值 0-无上限',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `Start` (`Start`,`End`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_game_config` */

DROP TABLE IF EXISTS `jy_game_config`;

CREATE TABLE `jy_game_config` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '游戏配置',
  `StopService` tinyint(1) unsigned NOT NULL COMMENT '游戏停服 1-正常 2-停服 3-仅白名单进入',
  `StopPay` tinyint(1) unsigned NOT NULL COMMENT '停止支付 1-否 2-是',
  `Type` tinyint(1) unsigned NOT NULL COMMENT '渠道 1-否 2-是',
  `Status` tinyint(1) unsigned NOT NULL COMMENT '是否立即执行 1-否 2-是',
  `Second` tinyint(1) unsigned NOT NULL COMMENT '多少秒发送数据',
  `Channel` varchar(50) NOT NULL COMMENT '渠道号',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_game_form` */

DROP TABLE IF EXISTS `jy_game_form`;

CREATE TABLE `jy_game_form` (
  `Name` varchar(50) NOT NULL COMMENT '游戏项目类型',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1-游戏 2-充值 3-签到 4-兑换 5-月卡 6-首冲',
  PRIMARY KEY (`Type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jy_game_notice` */

DROP TABLE IF EXISTS `jy_game_notice`;

CREATE TABLE `jy_game_notice` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '游戏公告',
  `Content` text NOT NULL COMMENT '公告内容',
  `Title` varchar(255) NOT NULL COMMENT '长标题',
  `Sort` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否置顶 1-否 2否',
  `Num` int(11) unsigned NOT NULL COMMENT '排序',
  `TitleSon` varchar(255) NOT NULL COMMENT '短标题',
  `SendEmail` tinyint(1) unsigned NOT NULL,
  `EmailContent` text NOT NULL,
  `TitleContent` varchar(255) NOT NULL,
  `Channel` int(11) NOT NULL COMMENT '渠道',
  `Btime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '结束时间',
  `Remark` varchar(255) NOT NULL COMMENT '备注',
  `Status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否发布 1-否 2-是',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `Status` (`Status`,`Btime`,`Sort`,`Num`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_game_version` */

DROP TABLE IF EXISTS `jy_game_version`;

CREATE TABLE `jy_game_version` (
  `Version` varchar(20) NOT NULL COMMENT '版本号',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `Remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`Version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jy_goods_all` */

DROP TABLE IF EXISTS `jy_goods_all`;

CREATE TABLE `jy_goods_all` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '物品表',
  `Name` varchar(255) NOT NULL COMMENT '物品名',
  `Code` varchar(20) NOT NULL COMMENT '物品标识',
  `ImgCode` varchar(20) NOT NULL COMMENT '物品图片标识',
  `CurrencyType` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '货币类型 1-人民币 2-金币 3-砖石',
  `CurrencyNum` varchar(50) NOT NULL COMMENT '货币数量',
  `IssueNum` int(11) NOT NULL DEFAULT '0' COMMENT '发行数量',
  `IssueType` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否限制发行量 1-否 2-是',
  `Type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型  1-金币 2-钻石 3-道具',
  `CateGory` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类别  1-金币 2-砖石 3-道具',
  `GetNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '获得数量',
  `GiveInfo` text NOT NULL COMMENT '赠送物品',
  `ShowType` tinyint(1) NOT NULL DEFAULT '1' COMMENT '展示方式 1-商城',
  `IsGroom` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否推荐 1-否 2-是',
  `TheShelvesTime` varchar(50) DEFAULT NULL COMMENT '定时时间',
  `Status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1-上架 2-定时上架 3-定时下架 4-已下架',
  `Platform` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '平台 1-全部 2-苹果 3-安卓',
  `Proportion` int(4) NOT NULL DEFAULT '0' COMMENT '首冲比例',
  `FaceValue` varchar(20) DEFAULT NULL COMMENT '卡号面值',
  `LimitShop` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '限购 1-不限 2-日 3-周 4-月 5-年',
  `LimitShopNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '限购次数',
  `ExchangeType` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '限购 1-不限 2-日 3-周 4-月 5-年',
  `ExchangeNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '限兑换数量',
  `Describe` varchar(255) NOT NULL COMMENT '商品描述',
  `Broadcast` varchar(255) NOT NULL COMMENT '广播信息',
  `Push` varchar(255) NOT NULL COMMENT '推送信息',
  `Rmark` varchar(255) NOT NULL COMMENT '备注',
  `LimitLevel` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '等级限制 0-不限制',
  `LimitVip` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '会员等级限制 0-不限制',
  `Sort` bigint(20) NOT NULL COMMENT '排序',
  `IsDel` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否删除 1-否 2-是',
  `UpTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`Id`),
  KEY `CateGory` (`CateGory`,`IsDel`),
  KEY `Status` (`Status`),
  KEY `ShowType` (`ShowType`),
  KEY `Platform` (`Platform`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_horse_race_lamp` */

DROP TABLE IF EXISTS `jy_horse_race_lamp`;

CREATE TABLE `jy_horse_race_lamp` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '跑马灯',
  `Content` varchar(255) NOT NULL COMMENT '内容',
  `Status` tinyint(1) NOT NULL COMMENT '是否已发送 1-否 2-是',
  `Timing` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否定时发送 1-否 2-是',
  `Sort` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '优先级',
  `Channel` int(11) NOT NULL COMMENT '渠道',
  `Btime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '过期时间',
  `Remark` varchar(255) NOT NULL COMMENT '备注',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `Timing` (`Timing`,`Btime`),
  KEY `Sort` (`Sort`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_novice_pack_log` */

DROP TABLE IF EXISTS `jy_novice_pack_log`;

CREATE TABLE `jy_novice_pack_log` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '新手礼包记录',
  `playerid` bigint(20) unsigned NOT NULL,
  `Code` varchar(20) NOT NULL,
  `Number` int(11) unsigned NOT NULL,
  `Type` tinyint(3) unsigned NOT NULL,
  `Channel` varchar(50) NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`)
) ENGINE=MyISAM AUTO_INCREMENT=233 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_prop_list` */

DROP TABLE IF EXISTS `jy_prop_list`;

CREATE TABLE `jy_prop_list` (
  `Name` varchar(255) NOT NULL COMMENT '名称',
  `Code` int(11) unsigned NOT NULL COMMENT '道具ID',
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `jy_real_time_online` */

DROP TABLE IF EXISTS `jy_real_time_online`;

CREATE TABLE `jy_real_time_online` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '在线人数',
  `UserNum` int(11) NOT NULL COMMENT '人数',
  `Screenings` tinyint(1) NOT NULL COMMENT '场次',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`Screenings`)
) ENGINE=MyISAM AUTO_INCREMENT=563 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_register_macrodata` */

DROP TABLE IF EXISTS `jy_register_macrodata`;

CREATE TABLE `jy_register_macrodata` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '注册分析宏观数据',
  `UserNum` int(11) unsigned NOT NULL COMMENT '注册人数',
  `UserGame` int(11) unsigned NOT NULL COMMENT '游戏人数',
  `UserPayNum` int(11) unsigned NOT NULL COMMENT '付费用户',
  `PayNum` int(11) unsigned NOT NULL COMMENT '付费次数',
  `PayMoney` int(11) unsigned NOT NULL COMMENT '付费金额',
  `BankruptcyNum` int(11) unsigned NOT NULL COMMENT '破产用户',
  `BankruptcyNum30` int(11) NOT NULL COMMENT '充值30内破产',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jy_seven_days_sign` */

DROP TABLE IF EXISTS `jy_seven_days_sign`;

CREATE TABLE `jy_seven_days_sign` (
  `Id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '七天签到',
  `IsExceed` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否超过28天 1-否 2-是',
  `Day` int(4) unsigned NOT NULL COMMENT '第几天',
  `GoodsID` int(11) unsigned NOT NULL COMMENT '物品ID',
  `Type` tinyint(1) unsigned NOT NULL COMMENT '物品类型',
  `Number` int(11) NOT NULL COMMENT '数量',
  `ImgCode` varchar(50) NOT NULL COMMENT '图片标识',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `IsExceed` (`IsExceed`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_statistics_activem_acroscopic` */

DROP TABLE IF EXISTS `jy_statistics_activem_acroscopic`;

CREATE TABLE `jy_statistics_activem_acroscopic` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '统计活跃-宏观数据',
  `UserNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户数量',
  `WAU` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '7内',
  `MAU` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '30天内',
  `UserPayNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '付费用户数量',
  `UserGame` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户游戏数量',
  `BankruptcyNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '破产数量',
  `BankruptcyNum30` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '付费30分钟破产',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `jy_statistics_activem_diamond` */

DROP TABLE IF EXISTS `jy_statistics_activem_diamond`;

CREATE TABLE `jy_statistics_activem_diamond` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活跃统计-钻石',
  `GroupID` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '区间组ID',
  `UserNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '统计时间',
  KEY `Id` (`Id`),
  KEY `DateTime` (`DateTime`,`GroupID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jy_statistics_activem_gold` */

DROP TABLE IF EXISTS `jy_statistics_activem_gold`;

CREATE TABLE `jy_statistics_activem_gold` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活跃金币统计',
  `GroupID` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '区间范围ID',
  `UserNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jy_statistics_activem_level` */

DROP TABLE IF EXISTS `jy_statistics_activem_level`;

CREATE TABLE `jy_statistics_activem_level` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活跃统计-等级',
  `Level` int(6) unsigned NOT NULL COMMENT '等级',
  `UserNum` int(11) unsigned NOT NULL COMMENT '用户数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`Level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `jy_statistics_activem_version` */

DROP TABLE IF EXISTS `jy_statistics_activem_version`;

CREATE TABLE `jy_statistics_activem_version` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '活跃统计-版本号',
  `Version` varchar(255) NOT NULL COMMENT '版本号',
  `UserNum` int(11) NOT NULL COMMENT '用户数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

/*Table structure for table `jy_statistics_goods` */

DROP TABLE IF EXISTS `jy_statistics_goods`;

CREATE TABLE `jy_statistics_goods` (
  `GoodsID` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '物品ID',
  `SuccessNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '成功数',
  `TotalNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '总下单数',
  PRIMARY KEY (`GoodsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `jy_statistics_users_pay` */

DROP TABLE IF EXISTS `jy_statistics_users_pay`;

CREATE TABLE `jy_statistics_users_pay` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户付费统计',
  `alipay` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '支付宝',
  `weixin` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '微信',
  `JinPay` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '金立',
  `iappay` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '爱贝',
  `PayNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '付费次数',
  `UserPayNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '付费用户数',
  `RegNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '账号注册人数',
  `UsersOneNum` float DEFAULT NULL COMMENT '次日留存',
  `UsersTowNum` float DEFAULT NULL COMMENT '二日留存',
  `UsersThreeNum` float DEFAULT NULL COMMENT '三日留存',
  `UsersSevenNum` float DEFAULT NULL COMMENT '七日留存',
  `UsersFifteenNum` float DEFAULT NULL COMMENT '十五留存',
  `UsersThirtyNum` float DEFAULT NULL COMMENT '三十日留存',
  `ActiveNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '活跃数',
  `TotalMoney` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '日收入总额',
  `Success` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '成功',
  `UserPayNumOld` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '老用户数量',
  `OrderTotalOld` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '老用户订单总额',
  `OrderTotal` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '订单总数',
  `EquipmentRegNum` int(11) NOT NULL DEFAULT '0' COMMENT '设备号注册人数',
  `First` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '首次充值数',
  `Channel` varchar(50) NOT NULL COMMENT '渠道号',
  `FirstMoney` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '首付金额',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '统计时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`Channel`)
) ENGINE=MyISAM AUTO_INCREMENT=2194 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_system_menu` */

DROP TABLE IF EXISTS `jy_system_menu`;

CREATE TABLE `jy_system_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统菜单',
  `name` varchar(20) NOT NULL COMMENT '菜单名',
  `icon` varchar(20) NOT NULL COMMENT '菜单表',
  `url` varchar(100) NOT NULL COMMENT '菜单地址',
  `sort` int(11) unsigned NOT NULL COMMENT '排序',
  `islock` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否锁定',
  `upid` int(11) NOT NULL DEFAULT '0' COMMENT '上级菜单',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_thirdpay` */

DROP TABLE IF EXISTS `jy_thirdpay`;

CREATE TABLE `jy_thirdpay` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '支付信息',
  `Name` varchar(20) NOT NULL COMMENT '支付名称',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型 1-支付 2-微信 3-爱贝',
  `Platform` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '平台 1-苹果 2-安卓',
  `PassAgeWay` varchar(50) NOT NULL COMMENT '通道',
  `Recommend` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否推荐',
  `public` text COMMENT '公钥(支付宝，爱贝)',
  `private` text COMMENT '私钥（支付宝，微信，爱贝）',
  `appid` varchar(100) DEFAULT NULL COMMENT '应用ID(微信，爱贝)',
  `partner` varchar(100) DEFAULT NULL COMMENT '合作者id(微信支付宝)',
  `account` varchar(100) DEFAULT NULL COMMENT '支付宝签约账号',
  `Sort` int(11) NOT NULL COMMENT '排序',
  `Notifyurl` varchar(255) NOT NULL COMMENT '回调通知',
  `Describe` varchar(255) NOT NULL COMMENT '通道描述',
  `Support` tinyint(1) NOT NULL DEFAULT '1' COMMENT '所有版本 1-否 2-是',
  `VersionStart` varchar(20) NOT NULL COMMENT '起始版本',
  `VersionEnd` varchar(20) NOT NULL COMMENT '结束版本',
  `IsDel` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否删除 1-是 2-否',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `PassAgeWay` (`PassAgeWay`),
  KEY `IsDel` (`IsDel`),
  KEY `Platform` (`Platform`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_users_activity_theaward_log` */

DROP TABLE IF EXISTS `jy_users_activity_theaward_log`;

CREATE TABLE `jy_users_activity_theaward_log` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户领奖记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `GoodsID` int(11) unsigned NOT NULL COMMENT '物品ID',
  `GoodsName` varchar(50) NOT NULL COMMENT '物品名',
  `activityID` int(11) unsigned NOT NULL COMMENT '活动ID',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '活动类型',
  `GetNum` int(11) unsigned NOT NULL COMMENT '数量',
  `Number` int(11) unsigned NOT NULL COMMENT '倍数',
  `AddUpStartTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '计费开始时间',
  `Channel` varchar(50) NOT NULL COMMENT '渠道',
  `AddUpEndTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '计费结束时间',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '领取时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`AddUpStartTime`,`AddUpEndTime`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_users_bankruptcy` */

DROP TABLE IF EXISTS `jy_users_bankruptcy`;

CREATE TABLE `jy_users_bankruptcy` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户破产',
  `playerid` bigint(20) NOT NULL COMMENT '用户ID',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '破产时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jy_users_card_receive_log` */

DROP TABLE IF EXISTS `jy_users_card_receive_log`;

CREATE TABLE `jy_users_card_receive_log` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '月卡领取奖励',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `GoodsID` int(1) NOT NULL COMMENT '物品ID',
  `Type` tinyint(1) NOT NULL COMMENT '类型',
  `Code` varchar(20) NOT NULL COMMENT '物品编号',
  `GetNum` bigint(20) NOT NULL COMMENT '数量',
  `Number` bigint(20) NOT NULL COMMENT '倍数',
  `Channel` varchar(50) NOT NULL COMMENT '渠道',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`DateTime`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_users_currency_stream` */

DROP TABLE IF EXISTS `jy_users_currency_stream`;

CREATE TABLE `jy_users_currency_stream` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户金币钻石流水',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `Type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型 1-游戏 2-充值 3-签到 4-兑换 5-月卡 6-首冲',
  `CurrencyType` tinyint(1) NOT NULL DEFAULT '1' COMMENT '货币类型 1-金币 2-钻石',
  `Screenings` tinyint(1) NOT NULL DEFAULT '0' COMMENT '场次 1-十 2-百 3-千 4-万',
  `Channel` varchar(50) DEFAULT NULL,
  `Income` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-收入 2-支出',
  `Number` int(20) NOT NULL COMMENT '数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`Type`,`CurrencyType`),
  KEY `DateTime` (`DateTime`,`Type`,`CurrencyType`,`Income`)
) ENGINE=MyISAM AUTO_INCREMENT=399 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_users_exchange_log` */

DROP TABLE IF EXISTS `jy_users_exchange_log`;

CREATE TABLE `jy_users_exchange_log` (
  `Id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户兑换记录',
  `GoodsName` varchar(50) NOT NULL COMMENT '商品名',
  `Number` int(11) unsigned NOT NULL COMMENT '倍数',
  `GetNum` bigint(20) NOT NULL COMMENT '数量',
  `Order` varchar(20) NOT NULL COMMENT '兑换订单号',
  `Type` tinyint(1) NOT NULL COMMENT '类型',
  `Code` varchar(50) NOT NULL COMMENT '物品ID',
  `StockNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '兑换劵',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `Status` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '状态 1-审核中 2-已发放 3-审核不通过',
  `MessAge` text COMMENT '申请失败原因',
  `Channel` varchar(50) NOT NULL COMMENT '渠道',
  `GoodsID` int(11) unsigned NOT NULL COMMENT '商品ID',
  `UpTime` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '兑换时间',
  PRIMARY KEY (`Id`),
  KEY `DateTimes` (`DateTime`,`Status`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_users_goods_stream` */

DROP TABLE IF EXISTS `jy_users_goods_stream`;

CREATE TABLE `jy_users_goods_stream` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户物品流水',
  `playerid` bigint(20) NOT NULL COMMENT '用户ID',
  `Code` varchar(20) NOT NULL COMMENT '物品编码',
  `Screenings` tinyint(4) NOT NULL DEFAULT '0' COMMENT '场次 1-十 2-百 3-千 4-万',
  `Type` tinyint(1) unsigned NOT NULL COMMENT '类型 1-游戏 2-充值 3-签到 4-兑换 5-月卡 6-首冲',
  `Channel` varchar(50) DEFAULT NULL COMMENT '渠道',
  `Income` tinyint(1) NOT NULL COMMENT '1-收入 2-支出',
  `Number` int(11) NOT NULL COMMENT '数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `DateTime` (`DateTime`,`playerid`),
  KEY `Code` (`Code`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_users_order_goods` */

DROP TABLE IF EXISTS `jy_users_order_goods`;

CREATE TABLE `jy_users_order_goods` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单物品',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `PlatformOrder` varchar(30) NOT NULL COMMENT '订单号',
  `GoodsName` varchar(50) NOT NULL COMMENT '物品名',
  `GoodsCode` varchar(50) NOT NULL COMMENT '物品编码',
  `GetNum` int(1) unsigned NOT NULL COMMENT '物品数量',
  `Proportion` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '首冲赠送比例',
  `GoodsID` int(11) unsigned NOT NULL COMMENT '物品ID',
  `Price` int(11) unsigned NOT NULL COMMENT '价格',
  `IsGive` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否赠送 1-否 2-是',
  `Number` int(4) NOT NULL DEFAULT '1' COMMENT '数量',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '物品类型',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `GoodsId` (`GoodsID`),
  KEY `Order` (`PlatformOrder`,`playerid`)
) ENGINE=InnoDB AUTO_INCREMENT=506 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_users_order_info` */

DROP TABLE IF EXISTS `jy_users_order_info`;

CREATE TABLE `jy_users_order_info` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `OrderName` varchar(50) NOT NULL COMMENT '订单名称',
  `UsersName` varchar(50) NOT NULL COMMENT '用户名',
  `PlatformOrder` varchar(50) NOT NULL COMMENT '平台订单号',
  `MerchantOrder` varchar(50) NOT NULL COMMENT '商户订单号',
  `Status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态  1-待支付 2-已支付 3-订单过期 4-支付失败',
  `Price` float NOT NULL COMMENT '价格',
  `CallbackTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '支付回调时间',
  `ExpireTime` int(11) unsigned DEFAULT NULL COMMENT '订单过期时间',
  `FoundTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `RegisterChannel` varchar(50) NOT NULL COMMENT '注册渠道',
  `MessAge` varchar(255) DEFAULT NULL COMMENT '支付状态说明',
  `IsFirst` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否首次支付 1-否 2-是',
  `PayPlatform` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支付平台 1-支付宝 2-微信 3-爱贝 4-银联',
  `PayChannel` varchar(50) NOT NULL COMMENT '消费渠道',
  `VipLevel` int(4) unsigned DEFAULT NULL COMMENT '购买前用户Vip等级',
  `Form` tinyint(1) NOT NULL DEFAULT '1' COMMENT '来源 1-首冲 2-月卡 3-商城',
  `appuserid` varchar(50) DEFAULT NULL,
  `VipExp` int(11) unsigned DEFAULT NULL COMMENT '购买前用户Vip经验',
  `PayID` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '支付ID',
  `Platform` tinyint(1) NOT NULL DEFAULT '1' COMMENT '平台 1-苹果 2-安卓',
  `PayPassAgeWay` varchar(50) NOT NULL COMMENT '支付通道',
  `PayType` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付类型 0-未支付 1-支付宝 2-微信',
  PRIMARY KEY (`Id`),
  KEY `PlatformOrder` (`PlatformOrder`),
  KEY `Status` (`Status`,`CallbackTime`),
  KEY `playerid` (`playerid`,`Status`),
  KEY `CallbackTime` (`CallbackTime`,`playerid`,`Status`),
  KEY `PayChannel` (`PayChannel`,`FoundTime`)
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_users_package_shop_log` */

DROP TABLE IF EXISTS `jy_users_package_shop_log`;

CREATE TABLE `jy_users_package_shop_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户礼包购买记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户Id',
  `Type` tinyint(1) unsigned NOT NULL COMMENT '1-首充 2-月卡',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`Type`,`DateTime`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_users_shop_log` */

DROP TABLE IF EXISTS `jy_users_shop_log`;

CREATE TABLE `jy_users_shop_log` (
  `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '购买记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `GoodID` int(11) unsigned NOT NULL COMMENT '物品ID',
  `Code` varchar(20) NOT NULL COMMENT '物品编号',
  `GiveNum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '赠送数量',
  `IsGive` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否赠送 1-否 2-是',
  `Number` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '数量',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jy_users_sign_log` */

DROP TABLE IF EXISTS `jy_users_sign_log`;

CREATE TABLE `jy_users_sign_log` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户签到记录表',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `GoodsID` bigint(20) unsigned NOT NULL COMMENT '物品ID',
  `Day` tinyint(1) unsigned NOT NULL COMMENT '第几天',
  `Code` varchar(50) NOT NULL COMMENT '物品编码',
  `Type` tinyint(1) unsigned NOT NULL COMMENT '物品类型',
  `GetNum` bigint(20) unsigned NOT NULL COMMENT '数量',
  `Channel` varchar(50) NOT NULL COMMENT '渠道',
  `Number` int(11) NOT NULL COMMENT '倍数',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '签到时间',
  PRIMARY KEY (`Id`),
  KEY `Day` (`Day`),
  KEY `playerid` (`playerid`,`DateTime`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_vip_info` */

DROP TABLE IF EXISTS `jy_vip_info`;

CREATE TABLE `jy_vip_info` (
  `level` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '等级',
  `GiveInfo` varchar(50) NOT NULL COMMENT '赠送信息',
  `ImgCode` varchar(50) NOT NULL COMMENT '图标',
  `Describe` varchar(255) NOT NULL COMMENT '描述',
  `experience` int(11) NOT NULL COMMENT '充值额度',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `jy_vip_reward` */

DROP TABLE IF EXISTS `jy_vip_reward`;

CREATE TABLE `jy_vip_reward` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'vip每日奖励',
  `Level` int(6) DEFAULT NULL COMMENT '等级',
  `GoodsID` int(10) unsigned NOT NULL COMMENT '物品ID',
  `Type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `Number` bigint(20) unsigned NOT NULL COMMENT '数量',
  `Remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`Id`),
  KEY `GoodsID` (`GoodsID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_vip_reward_log` */

DROP TABLE IF EXISTS `jy_vip_reward_log`;

CREATE TABLE `jy_vip_reward_log` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'vip 每日奖励领取记录',
  `playerid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `Level` int(4) unsigned NOT NULL COMMENT '等级',
  `GetNum` bigint(20) unsigned NOT NULL COMMENT '数量',
  `Number` int(11) NOT NULL COMMENT '倍数',
  `Type` tinyint(1) NOT NULL COMMENT '类型',
  `Channel` varchar(50) NOT NULL COMMENT '渠道',
  `GoodsID` int(11) NOT NULL COMMENT '物品ID',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '领取时间',
  PRIMARY KEY (`Id`),
  KEY `playerid` (`playerid`,`DateTime`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `jy_white_list` */

DROP TABLE IF EXISTS `jy_white_list`;

CREATE TABLE `jy_white_list` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '白名单',
  `Account` varchar(50) NOT NULL COMMENT '账号',
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `test` */

DROP TABLE IF EXISTS `test`;

CREATE TABLE `test` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
