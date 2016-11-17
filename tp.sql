/*
Navicat MySQL Data Transfer

Source Server         : win10
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : tp

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-11-17 23:21:54
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

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
INSERT INTO `markzhu_info` VALUES ('19', 'HAMILTON 汉米尔顿 JAZZMASTER 爵士系列 H42515785 男款机械表', '0', '典雅小三针，简约耐看，商务风格，再到好价~', '汉米尔顿Hamilton于1892年成立于美国宾夕法尼亚州兰开斯特市，是世界上最大的钟表制造商和经销商Swatch集团的成员。这款爵士大师H42515785男款机械腕表，采用ETA-2895-2的机芯，是2892的小三针版，27钻，28800次/小时，背透设计。深灰色磨砂金属光泽表盘，银色夜光剑型表针，3点钟日期小窗，6点钟小盘为秒针盘，外壳采用银色精钢材质，黑色牛皮表带和整体的配色非常的和谐，40mm表径，50m日常防水。风格简约适合商务人士佩戴。', '2016-11-15 22:23:10', '2');
INSERT INTO `markzhu_info` VALUES ('20', 'SONY 索尼 ILCE-7M2K 28-70mm镜头 标准单镜头套装', '0', '全金属机身，5轴防抖技术', '作为全画幅无反相机A7的新款，ILCE-7M2（A7 Mark2）则是全球首款搭载有5轴防抖技术的全画幅无反相机。外观方面，A7 II沿用了前代的全金属机身，并优化了快门按键与手柄位的调节拨轮，更加符合人体工学设计。最大的亮点是采用了机身5轴防抖技术，包括有垂直、水平、垂直翻转、水平翻转和滚转5个方向，可使用户在拍摄照片时得到最高4.5档的防抖补偿。对焦采用了最新的相位差算法，拥有117个相位差和25个反差式对焦检测，可使对焦速度提升30%。', '2016-11-15 22:25:25', '2');
INSERT INTO `markzhu_info` VALUES ('21', '预售： iRobot Roomba 980 智能扫地机器人 旗舰款', '0', 'Evolution Robotics 是一家提供人工智能技术及解决方案的美国公司，其合作伙伴包括SONY、Bandai甚至US Navy美国海军，其实力可见一斑。我站曾多次推荐过Roomba系列的770、780、780等款型，口碑一向不错。', '相比两年之前发布的iRobot Roomba 880，新款的Roomba 980加入了iRobot的VSLAM（Vision Simultaneous Localization and Mapping）技术，在清洁房间的同时可以绘制房间的地图，以知晓哪些地方需要清洁、哪些地方够不到，在下次清理的同时速度能够大大加快。2016年iRobot最新款Roomba 980扫地机器人还使用了AeroForce强力真空吸尘系统，双反向旋转技术让清洁效果更好，强力提升50%的效率，最大吸尘面积可达到185平方米。', '2016-11-15 22:26:08', '2');

-- ----------------------------
-- Table structure for markzhu_info_meta
-- ----------------------------
DROP TABLE IF EXISTS `markzhu_info_meta`;
CREATE TABLE `markzhu_info_meta` (
  `im_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_id` int(11) NOT NULL,
  `im_key` varchar(30) NOT NULL,
  `im_value` varchar(200) NOT NULL,
  `im_pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`im_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of markzhu_info_meta
-- ----------------------------
INSERT INTO `markzhu_info_meta` VALUES ('1', '1', 'views', '1', '0');
INSERT INTO `markzhu_info_meta` VALUES ('2', '2', 'views', '231', '0');
INSERT INTO `markzhu_info_meta` VALUES ('3', '3', 'views', '21', '0');
INSERT INTO `markzhu_info_meta` VALUES ('5', '5', 'origin_price', '299', '0');
INSERT INTO `markzhu_info_meta` VALUES ('6', '5', 'current_price', '99', '0');
INSERT INTO `markzhu_info_meta` VALUES ('7', '6', 'origin_price', '88', '0');
INSERT INTO `markzhu_info_meta` VALUES ('8', '6', 'current_price', '68', '0');
INSERT INTO `markzhu_info_meta` VALUES ('9', '8', 'views', '21', '0');
INSERT INTO `markzhu_info_meta` VALUES ('10', '9', 'views', '21', '0');
INSERT INTO `markzhu_info_meta` VALUES ('11', '10', 'views', '21', '0');
INSERT INTO `markzhu_info_meta` VALUES ('12', '11', 'views', '21', '0');
INSERT INTO `markzhu_info_meta` VALUES ('13', '12', 'views', '21', '0');
INSERT INTO `markzhu_info_meta` VALUES ('14', '13', 'views', '21', '0');
INSERT INTO `markzhu_info_meta` VALUES ('15', '14', 'views', '21', '0');
INSERT INTO `markzhu_info_meta` VALUES ('16', '15', 'views', '21', '0');
INSERT INTO `markzhu_info_meta` VALUES ('17', '16', 'views', '21', '0');
INSERT INTO `markzhu_info_meta` VALUES ('18', '17', 'views', '21', '0');
INSERT INTO `markzhu_info_meta` VALUES ('19', '18', 'views', '21', '0');
INSERT INTO `markzhu_info_meta` VALUES ('20', '19', 'current_price', '499', '0');
INSERT INTO `markzhu_info_meta` VALUES ('21', '20', 'current_price', '10699', '0');
INSERT INTO `markzhu_info_meta` VALUES ('22', '21', 'current_price', '5799', '0');
INSERT INTO `markzhu_info_meta` VALUES ('23', '19', 'bimg', '/Public/images/watch.jpg', '0');
INSERT INTO `markzhu_info_meta` VALUES ('24', '20', 'bimg', '/Public/images/camera.jpg', '0');
INSERT INTO `markzhu_info_meta` VALUES ('25', '21', 'bimg', '/Public/images/robot.jpg', '0');
INSERT INTO `markzhu_info_meta` VALUES ('26', '19', 'market_price', '999', '0');
INSERT INTO `markzhu_info_meta` VALUES ('27', '19', 'product_standard', '单手表', '0');
INSERT INTO `markzhu_info_meta` VALUES ('28', '19', 'product_standard', '手表+表带组合', '0');
INSERT INTO `markzhu_info_meta` VALUES ('29', '19', 'product_popularity', '21312', '0');
INSERT INTO `markzhu_info_meta` VALUES ('30', '19', 'current_price', '699', '28');
INSERT INTO `markzhu_info_meta` VALUES ('31', '19', 'product_color', '钛色', '0');
INSERT INTO `markzhu_info_meta` VALUES ('32', '19', 'product_color', '黑色', '0');
INSERT INTO `markzhu_info_meta` VALUES ('33', '19', 'current_price', '799', '31');
INSERT INTO `markzhu_info_meta` VALUES ('34', '19', '33', '28', '0');
INSERT INTO `markzhu_info_meta` VALUES ('38', '19', 'current_price', '699', '32');
INSERT INTO `markzhu_info_meta` VALUES ('39', '19', '38', '28', '0');
INSERT INTO `markzhu_info_meta` VALUES ('40', '19', 'current_price', '599', '31');
INSERT INTO `markzhu_info_meta` VALUES ('41', '19', '40', '27', '0');

-- ----------------------------
-- Table structure for markzhu_info_widget
-- ----------------------------
DROP TABLE IF EXISTS `markzhu_info_widget`;
CREATE TABLE `markzhu_info_widget` (
  `widget_id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_title` varchar(200) NOT NULL,
  `widget_tpl` varchar(200) NOT NULL,
  `widget_model` text NOT NULL,
  PRIMARY KEY (`widget_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of markzhu_info_widget
-- ----------------------------
INSERT INTO `markzhu_info_widget` VALUES ('1', '最新发布', 'w:list', 'table(\'markzhu_info\')->where(\'info_type=1\')->order(\'info_id DESC\')->limit(5)->select()');

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
INSERT INTO `markzhu_nav` VALUES ('1', '新闻', '/index.php/Home/info?type=1', '1', '1');
INSERT INTO `markzhu_nav` VALUES ('2', '商品', '/index.php/Home/info?type=2', '2', '1');
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
