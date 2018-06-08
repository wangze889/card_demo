/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 5.7.20 : Database - card_demo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`card_demo` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `card_demo`;

/*Table structure for table `card_cash_extra_info` */

DROP TABLE IF EXISTS `card_cash_extra_info`;

CREATE TABLE `card_cash_extra_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '代金券字段',
  `card_id` int(11) DEFAULT NULL,
  `least_cost` int(11) DEFAULT NULL,
  `reduce_cost` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `card_cash_extra_info` */

/*Table structure for table `card_discount_extra_info` */

DROP TABLE IF EXISTS `card_discount_extra_info`;

CREATE TABLE `card_discount_extra_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '折扣券',
  `card_id` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `card_discount_extra_info` */

/*Table structure for table `card_general_coupon_extra_info` */

DROP TABLE IF EXISTS `card_general_coupon_extra_info`;

CREATE TABLE `card_general_coupon_extra_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_id` int(11) DEFAULT NULL,
  `default_detail` varchar(3072) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `card_general_coupon_extra_info` */

/*Table structure for table `card_gift_extra_info` */

DROP TABLE IF EXISTS `card_gift_extra_info`;

CREATE TABLE `card_gift_extra_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '兑换券',
  `card_id` int(11) DEFAULT NULL,
  `gift` varchar(3072) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `card_gift_extra_info` */

/*Table structure for table `card_groupon_extra_info` */

DROP TABLE IF EXISTS `card_groupon_extra_info`;

CREATE TABLE `card_groupon_extra_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_id` int(11) DEFAULT NULL,
  `deal_detail` varchar(3072) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `card_id` (`card_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `card_groupon_extra_info` */

/*Table structure for table `cards` */

DROP TABLE IF EXISTS `cards`;

CREATE TABLE `cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_type` varchar(100) DEFAULT NULL,
  `poi_id` int(11) DEFAULT NULL,
  `code_type` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_name` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notice` varchar(48) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(3072) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` json DEFAULT NULL,
  `date_info` json DEFAULT NULL,
  `use_custom_code` tinyint(4) DEFAULT '0',
  `get_custom_code_mode` varchar(32) DEFAULT NULL,
  `bind_openid` tinyint(4) DEFAULT '0',
  `service_phone` varchar(24) DEFAULT NULL,
  `location_id_list` json DEFAULT NULL,
  `use_all_locations` tinyint(4) DEFAULT '1',
  `center_title` varchar(18) DEFAULT NULL,
  `center_sub_title` varchar(24) DEFAULT NULL,
  `center_url` varchar(128) DEFAULT NULL,
  `center_app_brand_user_name` varchar(128) DEFAULT NULL,
  `center_app_brand_pass` varchar(128) DEFAULT NULL,
  `custom_url_name` varchar(15) DEFAULT NULL,
  `custom_url` varchar(128) DEFAULT NULL,
  `custom_url_sub_title` varchar(18) DEFAULT NULL,
  `custom_app_brand_user_name` varchar(128) DEFAULT NULL,
  `custom_app_brand_pass` varchar(128) DEFAULT NULL,
  `promotion_url_name` varchar(15) DEFAULT NULL,
  `promotion_url` varchar(128) DEFAULT NULL,
  `promotion_url_sub_title` varchar(18) DEFAULT NULL,
  `promotion_app_brand_user_name` varchar(128) DEFAULT NULL,
  `promotion_app_brand_pass` varchar(128) DEFAULT NULL,
  `get_limit` int(11) DEFAULT NULL,
  `use_limit` int(11) DEFAULT NULL,
  `can_share` tinyint(4) DEFAULT '1',
  `can_give_friend` tinyint(4) DEFAULT '0',
  `use_condition` json DEFAULT NULL,
  `abstract` json DEFAULT NULL,
  `text_image_list` json DEFAULT NULL,
  `time_limit` json DEFAULT NULL,
  `business_service` json DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `cards` */

/*Table structure for table `merchant_check_results` */

DROP TABLE IF EXISTS `merchant_check_results`;

CREATE TABLE `merchant_check_results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '子商户微信审核事件',
  `ToUserName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FromUserName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CreateTime` int(11) DEFAULT NULL,
  `MsgType` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Event` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MerchantId` int(11) DEFAULT NULL,
  `IsPass` tinyint(4) DEFAULT NULL,
  `Reason` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `merchant_check_results` */

insert  into `merchant_check_results`(`id`,`ToUserName`,`FromUserName`,`CreateTime`,`MsgType`,`Event`,`MerchantId`,`IsPass`,`Reason`,`updated_at`,`created_at`) values 
(1,'asd','asd',111111,'asd','asd',1312,1,'no reason','2018-05-28 18:31:13','2018-05-28 18:31:13'),
(2,'toUser','FromUser',123456789,'event','card_merchant_check_result',0,1,'reason','2018-05-29 09:46:50','2018-05-29 09:46:50'),
(3,'toUser','FromUser',123456789,'event','card_merchant_check_result',0,1,'reason','2018-05-29 09:49:00','2018-05-29 09:49:00'),
(4,'toUser','FromUser',123456789,'event','card_merchant_check_result',0,1,'reason','2018-05-29 10:10:37','2018-05-29 10:10:37'),
(5,'toUser','FromUser',123456789,'event','card_merchant_check_result',0,1,'reason','2018-05-29 10:12:05','2018-05-29 10:12:05'),
(6,'toUser','FromUser',123456789,'event','card_merchant_check_result',0,1,'reason','2018-05-29 10:22:33','2018-05-29 10:22:33'),
(7,'toUser','FromUser',123456789,'event','card_merchant_check_result',455414903,0,'lashdkajhsdkj','2018-05-30 16:54:26','2018-05-30 16:54:26'),
(8,'toUser','FromUser',123456789,'event','card_merchant_check_result',455414903,0,'lashdkajhsdkj','2018-05-30 16:54:26','2018-05-30 16:54:26'),
(9,'toUser','FromUser',123456789,'event','card_merchant_check_result',455414903,0,'lashdkajhsdkj','2018-06-01 11:50:56','2018-06-01 11:50:56');

/*Table structure for table `merchants` */

DROP TABLE IF EXISTS `merchants`;

CREATE TABLE `merchants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '子商户表',
  `merchant_id` int(11) DEFAULT NULL COMMENT '子商户id',
  `brand_name` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '子商户名称',
  `logo_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '子商户logo',
  `logo_local_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'logo本地路径',
  `protocol` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '授权函id',
  `protocol_local_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '授权函本地路径',
  `begin_time` int(11) DEFAULT NULL,
  `end_time` int(10) unsigned NOT NULL COMMENT '授权函有效期截止时间',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `primary_category_id` smallint(6) NOT NULL COMMENT '	一级类目id',
  `secondary_category_id` smallint(6) NOT NULL COMMENT '二级类目id',
  `agreement_media_id` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '营业执照或个体工商户营业执照彩照或扫描件',
  `agreement_local_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '营业执照或个体工商户营业执照彩照或扫描件本地路径',
  `operator_media_id` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '营业执照内登记的经营者身份证彩照或扫描件',
  `operator_local_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '营业执照内登记的经营者身份证彩照或扫描件本地路径',
  `app_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '子商户公众号app_id，非必填',
  `wx_check_status` tinyint(4) DEFAULT '-1' COMMENT '微信端审核状态，-1待推送，0待审核，1审核通过，2驳回,3协议期已过期',
  `platform_check_status` tinyint(4) DEFAULT '0' COMMENT '平台审核状态，0待审，1通过，2驳回',
  `reason` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '审核不通过信息',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `MERCHANT_ID` (`merchant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `merchants` */

insert  into `merchants`(`id`,`merchant_id`,`brand_name`,`logo_url`,`logo_local_path`,`protocol`,`protocol_local_path`,`begin_time`,`end_time`,`create_time`,`update_time`,`primary_category_id`,`secondary_category_id`,`agreement_media_id`,`agreement_local_path`,`operator_media_id`,`operator_local_path`,`app_id`,`wx_check_status`,`platform_check_status`,`reason`,`created_at`,`updated_at`) values 
(1,455414903,'测试测试','http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHohcYNMaibhMkVIzDeF68AXib3PfvUOeGoa2tMia8cTubI9UibgXEy9FhFl5phygZHGibbFBX1ZaVoQ4ibibQ/0?wx_fmt=png','uploads/merchant_logo/20180529/s7VXwzo0xjZ8Eb7RrexU7P5yWBRk09hGAeTFvxiA.png','YLsXIe0wV3n9VOhedvmgbFnRDvAD5snWtSWoR90slg5uHIsw3nriUrXh8HPJaEEg','uploads/protocol/20180529/lxFGJKT4ielO4WiCPHBVTmJRQ6EUAiy2CYjcf3B5.png',NULL,1655222400,NULL,NULL,6,602,'HIDacoZ2j2olfC-3dqHlLtvcrTKYJt-pC3dijOwMhSgQoGBCv3mEmn-mTK96d068','uploads/agreement/20180529/CAFNb3jHFA2C5TeKy2vBTJFZrqNCQaRQCbNKfjsX.png','YLsXIe0wV3n9VOhedvmgbL3aT-bexPLM84nDvon_WILHayxLa8WdAm1JvpQGKr7P','uploads/operator/20180529/L1kryVJB974lA8l9MOHT4fYsHKQhKpg1O6TuRZvS.png',NULL,2,1,'lashdkajhsdkj',NULL,NULL),
(2,NULL,'测试2','http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHohcYNMaibhMkVIzDeF68AXib3PfvUOeGoa2tMia8cTubI9UibgXEy9FhFl5phygZHGibbFBX1ZaVoQ4ibibQ/0?wx_fmt=png','uploads/merchant_logo/20180529/JArYaUi7NZE5f2LXB00steHO3FV5Pwvuvs1zhoyV.png','KcB0kXf7Mw_SpsHfryetz7YeP4W9JDv3b5SLmrMjq03UG75DoiJoTHdwwLN1D9md','uploads/protocol/20180529/OV4fCijcLmRaWnH0KYGgJIaidpExATZA94SHzpXJ.jpeg',NULL,1527177600,NULL,NULL,4,401,NULL,NULL,NULL,NULL,NULL,-1,1,'',NULL,'2018-06-02 09:05:38');

/*Table structure for table `poi_check_notify` */

DROP TABLE IF EXISTS `poi_check_notify`;

CREATE TABLE `poi_check_notify` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '门店审核推送通知',
  `ToUserName` varchar(100) DEFAULT NULL,
  `FromUserName` varchar(100) DEFAULT NULL,
  `CreateTime` int(11) DEFAULT NULL,
  `MsgType` varchar(50) DEFAULT NULL,
  `Event` varchar(50) DEFAULT NULL,
  `UniqId` varchar(50) DEFAULT NULL,
  `PoiId` int(11) DEFAULT NULL,
  `Result` varchar(10) DEFAULT NULL,
  `msg` varchar(500) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `poi_check_notify` */

insert  into `poi_check_notify`(`id`,`ToUserName`,`FromUserName`,`CreateTime`,`MsgType`,`Event`,`UniqId`,`PoiId`,`Result`,`msg`,`updated_at`,`created_at`) values 
(1,'toUser','fromUser',1408622107,'event','poi_check_notify','123adb',123123,'fail','xxxxxx','2018-06-02 10:24:47','2018-06-02 10:24:47'),
(2,'toUser','fromUser',1408622107,'event','poi_check_notify','123adb',488062215,'fail','xxxxxx','2018-06-07 11:27:26','2018-06-07 11:27:26'),
(3,'toUser','fromUser',1408622107,'event','poi_check_notify','123adb',488062215,'succ','xxxxxx','2018-06-07 11:31:35','2018-06-07 11:31:35'),
(4,'toUser','fromUser',1408622107,'event','poi_check_notify','123adb',488062215,'succ','成功','2018-06-07 11:53:20','2018-06-07 11:53:20');

/*Table structure for table `poi_photo_lists` */

DROP TABLE IF EXISTS `poi_photo_lists`;

CREATE TABLE `poi_photo_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '门店photo',
  `photo_url` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信端url',
  `local_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '服务器储存url',
  `poi_id` int(11) DEFAULT NULL COMMENT 'poi的id，不是poi的poi_id',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `poi_photo_lists` */

insert  into `poi_photo_lists`(`id`,`photo_url`,`local_url`,`poi_id`,`updated_at`,`created_at`) values 
(1,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/4keyD6gIXLDmS6W6ZkYc53I0j2PcCXHNIQBcNAm0.png',NULL,'2018-06-01 16:06:29','2018-06-01 16:06:29'),
(2,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/8BRV20E2sfFzKg7yJfsamXxBujp1Mw7rnG17tak4.png',NULL,'2018-06-01 16:10:54','2018-06-01 16:10:54'),
(3,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/8ShXhd4BsJAHq8JHDzNOv7UvUYsLYayecMqkUhx7.png',NULL,'2018-06-01 16:12:00','2018-06-01 16:12:00'),
(4,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/KwSy82jGvnWbtTTDF95kuc1eaQPXG9CXZAwSmgpj.png',NULL,'2018-06-01 16:18:29','2018-06-01 16:18:29'),
(5,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/5hq0IdlokekhQvFz33zq13EtM44F3nePRznQiN1Q.png',NULL,'2018-06-01 16:22:24','2018-06-01 16:22:24'),
(6,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/tnM0gT7fEUTGcZe4nzTdc1OoYd3tfZWEk2Ka80H3.png',NULL,'2018-06-01 16:27:55','2018-06-01 16:27:55'),
(7,'http://mmbiz.qpic.cn/mmbiz_jpg/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialibtJGTSBXe3m9m3f2efZq7InBhKSicwxpwCNNYh10vbDR0Blwpt6BQBQ/0?wx_fmt=jpeg','uploads/poi_photo/20180601/VL6Pq4QfIj4f7wbMHKZSyIPJDQTMlvVaM5COFA61.jpeg',NULL,'2018-06-01 16:27:58','2018-06-01 16:27:58'),
(8,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialfz5zrnK4QDDDNdaN8bgiao40o2armM7zE0O1UUqIAXSqkJxfFfMRMoQ/0?wx_fmt=png','uploads/poi_photo/20180601/bnO0tUjs8jnvQQaX48Wh5OP7UWmQ9AUXAjpsgVlc.png',NULL,'2018-06-01 16:28:01','2018-06-01 16:28:01'),
(9,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/4IBuokZ9cAL7dAxj3iSOZuQm0RgWJlluIHDa9ImQ.png',NULL,'2018-06-01 16:29:01','2018-06-01 16:29:01'),
(10,'http://mmbiz.qpic.cn/mmbiz_jpg/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialibtJGTSBXe3m9m3f2efZq7InBhKSicwxpwCNNYh10vbDR0Blwpt6BQBQ/0?wx_fmt=jpeg','uploads/poi_photo/20180601/V4aQyZo8QVHrlqNP9p4nZ5bJmc1Ci8cPlGmNHJ9c.jpeg',NULL,'2018-06-01 16:29:06','2018-06-01 16:29:06'),
(11,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/G8UMk0hbEygy0coYOsMf8IaqEmpcIyI9u3m7FVIz.png',NULL,'2018-06-01 16:32:11','2018-06-01 16:32:11'),
(12,'http://mmbiz.qpic.cn/mmbiz_jpg/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialibtJGTSBXe3m9m3f2efZq7InBhKSicwxpwCNNYh10vbDR0Blwpt6BQBQ/0?wx_fmt=jpeg','uploads/poi_photo/20180601/AxJrnvvnrolf0Kd9kmGLBb0wjk6R7xL0kteZ33yh.jpeg',NULL,'2018-06-01 16:32:13','2018-06-01 16:32:13'),
(13,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/czK8dRtz8snk40FsZ7NhCKQrhoNUvukPPJJbNApX.png',NULL,'2018-06-01 16:42:58','2018-06-01 16:42:58'),
(14,'http://mmbiz.qpic.cn/mmbiz_jpg/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialibtJGTSBXe3m9m3f2efZq7InBhKSicwxpwCNNYh10vbDR0Blwpt6BQBQ/0?wx_fmt=jpeg','uploads/poi_photo/20180601/wHXnlSoxTob3tDSarQEIWIlDf1jh4s6iTAEdWXMk.jpeg',NULL,'2018-06-01 16:43:00','2018-06-01 16:43:00'),
(15,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/suF8PKhQoJ8KbmIIoGKBELkaOFAuWgwEthkVCAWj.png',NULL,'2018-06-01 16:43:53','2018-06-01 16:43:53'),
(16,'http://mmbiz.qpic.cn/mmbiz_jpg/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialibtJGTSBXe3m9m3f2efZq7InBhKSicwxpwCNNYh10vbDR0Blwpt6BQBQ/0?wx_fmt=jpeg','uploads/poi_photo/20180601/pfE9LOLzFpsnpoa0Ob3SBN7gkbC2CFBGx8RijaTw.jpeg',NULL,'2018-06-01 16:43:55','2018-06-01 16:43:55'),
(17,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/GyGYMfLQnB3rokVt9yqOFoev5hzy7CxQdb9K13ZX.png',NULL,'2018-06-01 16:44:40','2018-06-01 16:44:40'),
(18,'http://mmbiz.qpic.cn/mmbiz_jpg/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialibtJGTSBXe3m9m3f2efZq7InBhKSicwxpwCNNYh10vbDR0Blwpt6BQBQ/0?wx_fmt=jpeg','uploads/poi_photo/20180601/i0Sq9fXMd9d63fu0IYrikGIIkuBoZNS42OQmKDbP.jpeg',NULL,'2018-06-01 16:44:43','2018-06-01 16:44:43'),
(19,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/3s3Iy53LVDA7HegZYAYXQyiV69iX1fIQIEDHrKOY.png',NULL,'2018-06-01 16:46:22','2018-06-01 16:46:22'),
(20,'http://mmbiz.qpic.cn/mmbiz_jpg/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialibtJGTSBXe3m9m3f2efZq7InBhKSicwxpwCNNYh10vbDR0Blwpt6BQBQ/0?wx_fmt=jpeg','uploads/poi_photo/20180601/pee2zt26i6ZWbDERQhpch0kLahEfXLvuoSzPCZzl.jpeg',NULL,'2018-06-01 16:46:24','2018-06-01 16:46:24'),
(21,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialfz5zrnK4QDDDNdaN8bgiao40o2armM7zE0O1UUqIAXSqkJxfFfMRMoQ/0?wx_fmt=png','uploads/poi_photo/20180601/1mrkeO1aPv4Yk367aG1PKUJkVZUVLBtGZaSHLiVI.png',NULL,'2018-06-01 16:46:26','2018-06-01 16:46:26'),
(22,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/l3ibq6nfX8b5CwmgwvqgapYmMat0NGI2RNZYsSAK.png',NULL,'2018-06-01 16:53:57','2018-06-01 16:53:57'),
(23,'http://mmbiz.qpic.cn/mmbiz_jpg/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialibtJGTSBXe3m9m3f2efZq7InBhKSicwxpwCNNYh10vbDR0Blwpt6BQBQ/0?wx_fmt=jpeg','uploads/poi_photo/20180601/JUaVKzoHZWYEGA9wzkvsR7W2V0z8rwdqwGIO3FGk.jpeg',NULL,'2018-06-01 16:53:58','2018-06-01 16:53:58'),
(24,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialfz5zrnK4QDDDNdaN8bgiao40o2armM7zE0O1UUqIAXSqkJxfFfMRMoQ/0?wx_fmt=png','uploads/poi_photo/20180601/D38ntNBgSIvdNaLzDton2J5IISciVd9RujDZat7k.png',NULL,'2018-06-01 16:54:02','2018-06-01 16:54:02'),
(25,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialtibCcY9CX4Qq1IKGfeJBltsrmb54VGF9wvkibIgPh6SkVpyQBoHDH4dg/0?wx_fmt=png','uploads/poi_photo/20180601/kHldir6Y0O4WaZZbGB9FCg46N7rxtPB3030aQKAJ.png',3,'2018-06-01 16:54:45','2018-06-01 16:54:45'),
(26,'http://mmbiz.qpic.cn/mmbiz_jpg/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialibtJGTSBXe3m9m3f2efZq7InBhKSicwxpwCNNYh10vbDR0Blwpt6BQBQ/0?wx_fmt=jpeg','uploads/poi_photo/20180601/7IXDxtBWhrUq7ovmeUeLBpWXQqsuZRhQxIWbWA5X.jpeg',3,'2018-06-01 16:54:47','2018-06-01 16:54:47'),
(27,'http://mmbiz.qpic.cn/mmbiz_png/wNqm4iaTiaHojCZZfGeAZVETRG0OOgrLialfz5zrnK4QDDDNdaN8bgiao40o2armM7zE0O1UUqIAXSqkJxfFfMRMoQ/0?wx_fmt=png','uploads/poi_photo/20180601/jEq3TuZwqD74wGAe1sbaJs57YI3uzWG4ma40TJMA.png',3,'2018-06-01 16:54:49','2018-06-01 16:54:49');

/*Table structure for table `pois` */

DROP TABLE IF EXISTS `pois`;

CREATE TABLE `pois` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '门店表',
  `poi_id` int(11) DEFAULT NULL COMMENT 'poi_id',
  `merchant_id` int(11) DEFAULT NULL COMMENT '子商户的id，不是merchant_id',
  `business_name` varchar(60) DEFAULT NULL COMMENT '门店名称',
  `branch_name` varchar(80) DEFAULT NULL COMMENT '分店名称',
  `province` varchar(40) DEFAULT NULL COMMENT '门店所在的省份',
  `city` varchar(40) DEFAULT NULL COMMENT '城市',
  `district` varchar(40) DEFAULT NULL COMMENT '地区',
  `address` varchar(400) DEFAULT NULL COMMENT '详细街道地址',
  `telephone` varchar(50) DEFAULT NULL COMMENT '门店的电话（纯数字，区号、分机号均由“-”隔开）',
  `categories` varchar(100) DEFAULT NULL COMMENT '门店的类型,不同级分类用“,”隔开',
  `offset_type` tinyint(4) DEFAULT NULL COMMENT '坐标类型： 1 为火星坐标 2 为sogou经纬度 3 为百度经纬度 4 为mapbar经纬度 5 为GPS坐标 6 为sogou墨卡托坐标',
  `longitude` double DEFAULT NULL COMMENT '经度',
  `latitude` double DEFAULT NULL COMMENT '纬度',
  `recommend` varchar(800) DEFAULT NULL COMMENT '推荐品',
  `special` varchar(800) DEFAULT NULL COMMENT '特色服务',
  `introduction` varchar(1200) DEFAULT NULL COMMENT '商户简介',
  `open_time` varchar(200) DEFAULT NULL COMMENT '营业时间',
  `avg_price` int(11) DEFAULT NULL COMMENT '人均价格',
  `wx_check_status` tinyint(4) DEFAULT '-1' COMMENT '-1,0,1,2',
  `platform_check_status` tinyint(4) DEFAULT '0' COMMENT '0,1,2',
  `reason` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pois` */

insert  into `pois`(`id`,`poi_id`,`merchant_id`,`business_name`,`branch_name`,`province`,`city`,`district`,`address`,`telephone`,`categories`,`offset_type`,`longitude`,`latitude`,`recommend`,`special`,`introduction`,`open_time`,`avg_price`,`wx_check_status`,`platform_check_status`,`reason`,`created_at`,`updated_at`) values 
(1,NULL,NULL,'测试1','测试1','上海市','上海市','黄浦区','测试1','18900000000','美食,江浙菜,上海菜',3,121.48,31.236,NULL,NULL,NULL,NULL,NULL,-1,0,NULL,'2018-06-01 16:44:58','2018-06-01 16:44:58'),
(2,NULL,NULL,'测试1','测试1','上海市','上海市','黄浦区','测试1','18900000000','美食,江浙菜,上海菜',3,121.48,31.236,'测试1','测试1','测试1','02:03-02:06',0,-1,0,NULL,'2018-06-01 16:46:30','2018-06-01 16:46:30'),
(3,488062215,1,'测试1','测试1','上海市','上海市','黄浦区','测试1','18900000000','美食,江浙菜,上海菜',3,121.48,31.236,'测试1','测试1','测试1','09:00-22:00',0,1,1,'成功','2018-06-01 17:09:25','2018-06-07 11:53:20');

/*Table structure for table `tests` */

DROP TABLE IF EXISTS `tests`;

CREATE TABLE `tests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meta` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tests` */

insert  into `tests`(`id`,`meta`) values 
(1,'{\"a\": \"apple\", \"b\": \"bee\"}'),
(2,'{\"a\": \"ace\", \"b\": \"bee\"}'),
(3,'{\"a\": \"啊啊啊啊\", \"b\": \"bee\"}'),
(4,'{\"a\": \"啊啊啊啊\", \"b\": \"bee\"}'),
(5,'{\"a\": \"啊啊啊啊\", \"b\": \"bee\"}'),
(6,'[\"asd\", \"asd\", \"fufj\"]');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
