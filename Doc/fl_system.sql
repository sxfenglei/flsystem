/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.47 : Database - fl_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fl_system` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `fl_system`;

/*Table structure for table `fl_auth_group` */

DROP TABLE IF EXISTS `fl_auth_group`;

CREATE TABLE `fl_auth_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  `rules_str` text NOT NULL,
  `desc` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `fl_auth_group` */

insert  into `fl_auth_group`(`id`,`title`,`status`,`rules`,`rules_str`,`desc`) values (1,'管理员',1,'1,2,3,4,7,8,9,22,10,11,12,13,14,15,16,17,18,19,20,21','主模块,默认控制器,主页面,系统配置,基本信息设置,微信设置,邮件设置,基本设置,店铺管理,店铺列表,创建店铺,编辑店铺,删除店铺,虚拟删除店铺,应用管理员员工管理,员工列表,添加员工,编辑员工,虚拟删除员工,删除员工',''),(2,'店长',1,'1,2,3','主模块,默认控制器,主页面',''),(4,'财务',1,'1,2,3','主模块,默认控制器,主页面',''),(5,'普通员工',1,'1,2,3','主模块,默认控制器,主页面',''),(6,'测试角色哦',1,'1,2,3,10,11,12,13,16,21','主模块,默认控制器,主页面,店铺管理,店铺列表,创建店铺,编辑店铺,应用管理员员工管理,删除员工','');

/*Table structure for table `fl_auth_group_access` */

DROP TABLE IF EXISTS `fl_auth_group_access`;

CREATE TABLE `fl_auth_group_access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `fl_auth_group_access` */

insert  into `fl_auth_group_access`(`id`,`uid`,`group_id`) values (5,5,1);

/*Table structure for table `fl_auth_rule` */

DROP TABLE IF EXISTS `fl_auth_rule`;

CREATE TABLE `fl_auth_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '0为顶级权限',
  `name` varchar(80) NOT NULL,
  `title` varchar(30) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `path` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `condition` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `fl_auth_rule` */

insert  into `fl_auth_rule`(`id`,`parent_id`,`name`,`title`,`type`,`path`,`status`,`condition`) values (1,0,'/Admin/','主模块',1,'0-1',1,''),(2,1,'/Admin/Index/','默认控制器',1,'0-1-2',1,''),(3,2,'/Admin/Index/index/','主页面',1,'0-1-2-3',1,''),(4,1,'/Admin/Setting/','系统配置',1,'0-1-4',1,''),(7,4,'/Admin/Setting/info/','基本信息设置',1,'0-1-4-7',1,''),(8,4,'/Admin/Setting/wx/','微信设置',1,'',1,''),(9,4,'/Admin/Setting/email/','邮件设置',1,'',1,''),(10,1,'/Admin/Shop/','店铺管理',1,'',1,''),(11,10,'/Admin/Shop/index/','店铺列表',1,'',1,''),(12,10,'/Admin/Shop/add/','创建店铺',1,'',1,''),(13,10,'/Admin/Shop/edit/','编辑店铺',1,'',1,''),(14,10,'/Admin/Shop/del/','删除店铺',1,'',1,''),(15,10,'/Admin/Shop/virtualDel/','虚拟删除店铺',1,'',1,''),(16,1,'/Admin/Admin/','应用管理员员工管理',1,'',1,''),(17,16,'/Admin/Admin/index/','员工列表',1,'',1,''),(18,16,'/Admin/Admin/add/','添加员工',1,'',1,''),(19,16,'/Admin/Admin/edit/','编辑员工',1,'',1,''),(20,16,'/Admin/Admin/virtualDel/','虚拟删除员工',1,'',1,''),(21,16,'/Admin/Admin/del/','删除员工',1,'',1,''),(22,4,'/Admin/Setting/index/','基本设置',1,'',1,''),(23,0,'/Admin/Test/aa/','测试a',1,'',1,''),(24,23,'/Admin/Test/bb/','测试bb',1,'',1,'');

/*Table structure for table `fl_category` */

DROP TABLE IF EXISTS `fl_category`;

CREATE TABLE `fl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `icon` varchar(45) NOT NULL,
  `desc` varchar(80) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `fl_category` */

/*Table structure for table `fl_employee` */

DROP TABLE IF EXISTS `fl_employee`;

CREATE TABLE `fl_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `phone` varchar(20) NOT NULL,
  `login_name` varchar(30) NOT NULL,
  `login_pwd` char(32) NOT NULL,
  `salt` char(8) NOT NULL,
  `real_name` varchar(30) NOT NULL,
  `head_img` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `shop_id` int(11) NOT NULL COMMENT '所属店铺',
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='员工表';

/*Data for the table `fl_employee` */

/*Table structure for table `fl_goods` */

DROP TABLE IF EXISTS `fl_goods`;

CREATE TABLE `fl_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sub_name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `original_price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
  `sales_price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '销售价',
  `discount_price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '折扣价',
  `discount_startdate` int(11) NOT NULL COMMENT '折扣价开始日期',
  `discount_enddate` int(11) NOT NULL COMMENT '折扣价结束日期',
  `tag` varchar(100) NOT NULL COMMENT '标签',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `fl_goods` */

/*Table structure for table `fl_manage` */

DROP TABLE IF EXISTS `fl_manage`;

CREATE TABLE `fl_manage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_name` varchar(30) NOT NULL,
  `login_pwd` varchar(32) NOT NULL,
  `salt` char(8) NOT NULL,
  `real_name` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 1正常 0禁用 -1删除',
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `fl_manage` */

insert  into `fl_manage`(`id`,`login_name`,`login_pwd`,`salt`,`real_name`,`phone`,`status`,`update_time`,`create_time`) values (1,'manage','59ffe4ebb70c766807628d8d46d9ad96','sI3l5dEp','超级管理员','13468600000',1,0,0);

/*Table structure for table `fl_order` */

DROP TABLE IF EXISTS `fl_order`;

CREATE TABLE `fl_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_num` varchar(20) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(45) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `goods_name` varchar(50) NOT NULL,
  `goods_num` int(11) NOT NULL,
  `goods_price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '购买时单价',
  `discount_coupon_id` int(11) NOT NULL COMMENT '优惠券',
  `discount_price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '折扣',
  `cash_coupon_id` int(11) NOT NULL COMMENT '代金券',
  `cash_coupon_price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '代金券金额',
  `total_price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总价',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `fl_order` */

/*Table structure for table `fl_setting` */

DROP TABLE IF EXISTS `fl_setting`;

CREATE TABLE `fl_setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `fl_setting` */

insert  into `fl_setting`(`id`,`key`,`value`) values (2,'webtitle','网站标题内容'),(3,'webkeywords','网站关键字'),(4,'webdescription','网站描述'),(5,'webfooter','网站脚'),(6,'integral','10'),(7,'integralLevel1_start','1'),(8,'integralLevel1_end','9999'),(9,'integralLevel2_start','10000'),(10,'integralLevel2_end','99999'),(11,'integralLevel3_start','100000'),(12,'integralLevel3_end','999999'),(13,'wxappid',''),(14,'wxsecret',''),(15,'wxtoken',''),(16,'pay_pos','2'),(17,'pay_unionpay','2');

/*Table structure for table `fl_shop` */

DROP TABLE IF EXISTS `fl_shop`;

CREATE TABLE `fl_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `head_img` varchar(100) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_addr` varchar(80) NOT NULL,
  `company_tel` varchar(45) NOT NULL,
  `company_stel` varchar(45) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lng` varchar(20) NOT NULL,
  `shop_singlepage_id` int(11) NOT NULL,
  `company_desc` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `fl_shop` */

/*Table structure for table `fl_template` */

DROP TABLE IF EXISTS `fl_template`;

CREATE TABLE `fl_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tpl_name` varchar(30) NOT NULL DEFAULT '默认模板',
  `tpl_enname` varchar(30) NOT NULL DEFAULT 'default',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `fl_template` */

insert  into `fl_template`(`id`,`tpl_name`,`tpl_enname`,`status`,`create_time`) values (1,'默认模板','default',1,0),(2,'医院模板','hospital',1,0),(3,'驾校模板','driving',1,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
