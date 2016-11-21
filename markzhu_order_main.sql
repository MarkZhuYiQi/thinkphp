/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : tp

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-11-21 17:51:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for markzhu_order_main
-- ----------------------------
DROP TABLE IF EXISTS `markzhu_order_main`;
CREATE TABLE `markzhu_order_main` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(50) NOT NULL COMMENT '订单编号',
  `order_price` decimal(10,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_state` tinyint(4) DEFAULT NULL COMMENT '订单状态',
  `order_time` datetime DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of markzhu_order_main
-- ----------------------------
