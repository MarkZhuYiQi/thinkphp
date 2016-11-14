/*
Navicat MySQL Data Transfer

Source Server         : win10
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : tp

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-11-15 00:01:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for markzhu_info
-- ----------------------------
DROP TABLE IF EXISTS `markzhu_info`;
CREATE TABLE `markzhu_info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_title` varchar(50) NOT NULL,
  `info_user` int(11) NOT NULL,
  `info_des` varchar(200) NOT NULL,
  `info_content` text NOT NULL,
  `info_date` datetime NOT NULL,
  `info_type` tinyint(4) NOT NULL,
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of markzhu_info
-- ----------------------------
INSERT INTO `markzhu_info` VALUES ('1', '测试新闻标题1', '0', '测试新闻简介1', '测试新闻内容1', '2016-11-14 16:28:38', '1');
INSERT INTO `markzhu_info` VALUES ('2', '测试新闻标题2', '0', '测试新闻简介2', '测试新闻内容2', '2016-11-14 16:41:37', '1');
INSERT INTO `markzhu_info` VALUES ('3', '测试新闻标题3', '0', '测试新闻简介3', '测试新闻内容3', '2016-11-14 16:41:37', '1');
INSERT INTO `markzhu_info` VALUES ('4', '测试新闻标题4', '0', '测试新闻简介4', '测试新闻内容4', '2016-11-14 16:41:37', '1');
INSERT INTO `markzhu_info` VALUES ('5', '商品1', '0', '商品简介1', '商品内容1', '2016-11-14 16:44:20', '2');
INSERT INTO `markzhu_info` VALUES ('6', '商品2', '0', '商品简介2', '商品内容2', '2016-11-14 16:45:17', '2');
INSERT INTO `markzhu_info` VALUES ('8', '测试新闻标题5', '0', '测试新闻简介5', '测试新闻内容5', '2016-11-14 16:28:38', '1');
INSERT INTO `markzhu_info` VALUES ('9', '测试新闻标题6', '0', '测试新闻简介6', '测试新闻内容6', '2016-11-14 16:28:38', '1');
INSERT INTO `markzhu_info` VALUES ('10', '测试新闻标题7', '0', '测试新闻简介7', '测试新闻内容7', '2016-11-14 21:33:28', '1');
INSERT INTO `markzhu_info` VALUES ('11', '测试新闻标题8', '0', '测试新闻简介8', '测试新闻内容8', '2016-11-14 21:33:39', '1');
INSERT INTO `markzhu_info` VALUES ('12', '测试新闻标题9', '0', '测试新闻简介9', '测试新闻内容9', '2016-11-14 21:33:51', '1');
INSERT INTO `markzhu_info` VALUES ('13', '测试新闻标题10', '0', '测试新闻简介10', '测试新闻内容10', '2016-11-14 21:34:02', '1');
INSERT INTO `markzhu_info` VALUES ('14', '测试新闻标题11', '0', '测试新闻简介11', '测试新闻内容11', '2016-11-14 21:34:10', '1');
INSERT INTO `markzhu_info` VALUES ('15', '测试新闻标题12', '0', '测试新闻简介12', '测试新闻内容12', '2016-11-14 21:34:18', '1');
INSERT INTO `markzhu_info` VALUES ('16', '测试新闻标题13', '0', '测试新闻简介13', '测试新闻内容13', '2016-11-14 21:34:25', '1');
INSERT INTO `markzhu_info` VALUES ('17', '测试新闻标题14', '0', '测试新闻简介14', '测试新闻内容14', '2016-11-14 21:34:33', '1');
INSERT INTO `markzhu_info` VALUES ('18', '测试新闻标题15', '0', '测试新闻简介15', '测试新闻内容15', '2016-11-14 21:34:42', '1');

-- ----------------------------
-- Table structure for markzhu_info_meta
-- ----------------------------
DROP TABLE IF EXISTS `markzhu_info_meta`;
CREATE TABLE `markzhu_info_meta` (
  `im_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_id` int(11) NOT NULL,
  `im_key` varchar(30) NOT NULL,
  `im_value` varchar(200) NOT NULL,
  PRIMARY KEY (`im_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of markzhu_info_meta
-- ----------------------------
INSERT INTO `markzhu_info_meta` VALUES ('1', '1', 'views', '1');
INSERT INTO `markzhu_info_meta` VALUES ('2', '2', 'views', '231');
INSERT INTO `markzhu_info_meta` VALUES ('3', '3', 'views', '21');
INSERT INTO `markzhu_info_meta` VALUES ('5', '5', 'origin_price', '299');
INSERT INTO `markzhu_info_meta` VALUES ('6', '5', 'current_price', '99');
INSERT INTO `markzhu_info_meta` VALUES ('7', '6', 'origin_price', '88');
INSERT INTO `markzhu_info_meta` VALUES ('8', '6', 'current_price', '68');
INSERT INTO `markzhu_info_meta` VALUES ('9', '8', 'views', '21');
INSERT INTO `markzhu_info_meta` VALUES ('10', '9', 'views', '21');
INSERT INTO `markzhu_info_meta` VALUES ('11', '10', 'views', '21');
INSERT INTO `markzhu_info_meta` VALUES ('12', '11', 'views', '21');
INSERT INTO `markzhu_info_meta` VALUES ('13', '12', 'views', '21');
INSERT INTO `markzhu_info_meta` VALUES ('14', '13', 'views', '21');
INSERT INTO `markzhu_info_meta` VALUES ('15', '14', 'views', '21');
INSERT INTO `markzhu_info_meta` VALUES ('16', '15', 'views', '21');
INSERT INTO `markzhu_info_meta` VALUES ('17', '16', 'views', '21');
INSERT INTO `markzhu_info_meta` VALUES ('18', '17', 'views', '21');
INSERT INTO `markzhu_info_meta` VALUES ('19', '18', 'views', '21');

-- ----------------------------
-- Table structure for markzhu_nav
-- ----------------------------
DROP TABLE IF EXISTS `markzhu_nav`;
CREATE TABLE `markzhu_nav` (
  `nav_id` int(11) NOT NULL AUTO_INCREMENT,
  `nav_title` varchar(50) DEFAULT NULL,
  `nav_href` varchar(200) DEFAULT NULL,
  `nav_index` int(11) DEFAULT NULL COMMENT '排序',
  `nav_isShow` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`nav_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of markzhu_nav
-- ----------------------------
INSERT INTO `markzhu_nav` VALUES ('1', '新闻', null, '1', '1');
INSERT INTO `markzhu_nav` VALUES ('2', '观点', null, '2', '1');
INSERT INTO `markzhu_nav` VALUES ('3', '文章', null, '3', '1');
INSERT INTO `markzhu_nav` VALUES ('4', '就不告诉你', null, '4', '0');

-- ----------------------------
-- Table structure for markzhu_news
-- ----------------------------
DROP TABLE IF EXISTS `markzhu_news`;
CREATE TABLE `markzhu_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of markzhu_news
-- ----------------------------
INSERT INTO `markzhu_news` VALUES ('1', '测试标题');

-- ----------------------------
-- Table structure for markzhu_users
-- ----------------------------
DROP TABLE IF EXISTS `markzhu_users`;
CREATE TABLE `markzhu_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_pwd` varchar(200) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of markzhu_users
-- ----------------------------
INSERT INTO `markzhu_users` VALUES ('2', 'zhu', '$P$B63CqcsUUOrx8OdJmLY4Pezpe0j1a/1');
INSERT INTO `markzhu_users` VALUES ('3', 'zhangsan', '123456');
INSERT INTO `markzhu_users` VALUES ('4', 'lilii', '4567');
INSERT INTO `markzhu_users` VALUES ('5', 'red', '$P$Bf9/JKME5P543WC61ZCcvAwvk7/mJ31');

-- ----------------------------
-- Table structure for markzhu_users_meta
-- ----------------------------
DROP TABLE IF EXISTS `markzhu_users_meta`;
CREATE TABLE `markzhu_users_meta` (
  `meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `meta_key` varchar(200) DEFAULT NULL,
  `meta_value` text,
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of markzhu_users_meta
-- ----------------------------
INSERT INTO `markzhu_users_meta` VALUES ('1', '5', 'reg_date', '2016-11-14 10:23:47');
