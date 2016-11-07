/*
Navicat MySQL Data Transfer

Source Server         : win10
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : tp

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-11-07 23:30:15
*/

SET FOREIGN_KEY_CHECKS=0;

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
  `user_pwd` varchar(20) NOT NULL,
  `user_regdate` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of markzhu_users
-- ----------------------------
INSERT INTO `markzhu_users` VALUES ('1', 'zhu', 'zhu', '0000-00-00 00:00:00');
