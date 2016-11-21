/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : tp

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-11-21 17:50:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for markzhu_order_detail
-- ----------------------------
DROP TABLE IF EXISTS `markzhu_order_detail`;
CREATE TABLE `markzhu_order_detail` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL COMMENT '商品ID',
  `product_num` int(11) DEFAULT '1' COMMENT '商品数量',
  `product_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of markzhu_order_detail
-- ----------------------------
