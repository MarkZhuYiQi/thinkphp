-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2016 at 10:59 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tp`
--

-- --------------------------------------------------------

--
-- Table structure for table `markzhu_info`
--

CREATE TABLE IF NOT EXISTS `markzhu_info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_title` varchar(50) NOT NULL,
  `info_user` int(11) NOT NULL,
  `info_des` varchar(200) NOT NULL,
  `info_content` text NOT NULL,
  `info_date` datetime NOT NULL,
  `info_type` tinyint(4) NOT NULL,
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `markzhu_info`
--

INSERT INTO `markzhu_info` (`info_id`, `info_title`, `info_user`, `info_des`, `info_content`, `info_date`, `info_type`) VALUES
(1, '测试新闻标题1', 0, '测试新闻简介1', '测试新闻内容1', '2016-11-14 16:28:38', 1),
(2, '测试新闻标题2', 0, '测试新闻简介2', '测试新闻内容2', '2016-11-14 16:41:37', 1),
(3, '测试新闻标题3', 0, '测试新闻简介3', '测试新闻内容3', '2016-11-14 16:41:37', 1),
(4, '测试新闻标题4', 0, '测试新闻简介4', '测试新闻内容4', '2016-11-14 16:41:37', 1),
(5, '商品1', 0, '商品简介1', '商品内容1', '2016-11-14 16:44:20', 2),
(6, '商品2', 0, '商品简介2', '商品内容2', '2016-11-14 16:45:17', 2),
(8, '测试新闻标题5', 0, '测试新闻简介5', '测试新闻内容5', '2016-11-14 16:28:38', 1),
(9, '测试新闻标题6', 0, '测试新闻简介6', '测试新闻内容6', '2016-11-14 16:28:38', 1),
(10, '测试新闻标题7', 0, '测试新闻简介7', '测试新闻内容7', '2016-11-14 21:33:28', 1),
(11, '测试新闻标题8', 0, '测试新闻简介8', '测试新闻内容8', '2016-11-14 21:33:39', 1),
(12, '测试新闻标题9', 0, '测试新闻简介9', '测试新闻内容9', '2016-11-14 21:33:51', 1),
(13, '测试新闻标题10', 0, '测试新闻简介10', '测试新闻内容10', '2016-11-14 21:34:02', 1),
(14, '测试新闻标题11', 0, '测试新闻简介11', '测试新闻内容11', '2016-11-14 21:34:10', 1),
(15, '测试新闻标题12', 0, '测试新闻简介12', '测试新闻内容12', '2016-11-14 21:34:18', 1),
(16, '测试新闻标题13', 0, '测试新闻简介13', '测试新闻内容13', '2016-11-14 21:34:25', 1),
(17, '测试新闻标题14', 0, '测试新闻简介14', '测试新闻内容14', '2016-11-14 21:34:33', 1),
(18, '测试新闻标题15', 0, '测试新闻简介15', '测试新闻内容15', '2016-11-14 21:34:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `markzhu_info_meta`
--

CREATE TABLE IF NOT EXISTS `markzhu_info_meta` (
  `im_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_id` int(11) NOT NULL,
  `im_key` varchar(30) NOT NULL,
  `im_value` varchar(200) NOT NULL,
  PRIMARY KEY (`im_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `markzhu_info_meta`
--

INSERT INTO `markzhu_info_meta` (`im_id`, `info_id`, `im_key`, `im_value`) VALUES
(1, 1, 'views', '1'),
(2, 2, 'views', '231'),
(3, 3, 'views', '21'),
(5, 5, 'origin_price', '299'),
(6, 5, 'current_price', '99'),
(7, 6, 'origin_price', '88'),
(8, 6, 'current_price', '68'),
(9, 8, 'views', '21'),
(10, 9, 'views', '21'),
(11, 10, 'views', '21'),
(12, 11, 'views', '21'),
(13, 12, 'views', '21'),
(14, 13, 'views', '21'),
(15, 14, 'views', '21'),
(16, 15, 'views', '21'),
(17, 16, 'views', '21'),
(18, 17, 'views', '21'),
(19, 18, 'views', '21');

-- --------------------------------------------------------

--
-- Table structure for table `markzhu_info_widget`
--

CREATE TABLE IF NOT EXISTS `markzhu_info_widget` (
  `widget_id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_title` varchar(200) NOT NULL,
  `widget_tpl` varchar(200) NOT NULL,
  `widget_model` text NOT NULL,
  PRIMARY KEY (`widget_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `markzhu_info_widget`
--

INSERT INTO `markzhu_info_widget` (`widget_id`, `widget_title`, `widget_tpl`, `widget_model`) VALUES
(1, '最新发布', 'w:list', 'table(''markzhu_info'')->where(''info_type=1'')->order(''info_id DESC'')->limit(5)->select()');

-- --------------------------------------------------------

--
-- Table structure for table `markzhu_nav`
--

CREATE TABLE IF NOT EXISTS `markzhu_nav` (
  `nav_id` int(11) NOT NULL AUTO_INCREMENT,
  `nav_title` varchar(50) DEFAULT NULL,
  `nav_href` varchar(200) DEFAULT NULL,
  `nav_index` int(11) DEFAULT NULL COMMENT '排序',
  `nav_isShow` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`nav_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `markzhu_nav`
--

INSERT INTO `markzhu_nav` (`nav_id`, `nav_title`, `nav_href`, `nav_index`, `nav_isShow`) VALUES
(1, '新闻', NULL, 1, 1),
(2, '观点', NULL, 2, 1),
(3, '文章', NULL, 3, 1),
(4, '就不告诉你', NULL, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `markzhu_news`
--

CREATE TABLE IF NOT EXISTS `markzhu_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `markzhu_news`
--

INSERT INTO `markzhu_news` (`news_id`, `news_title`) VALUES
(1, '测试标题');

-- --------------------------------------------------------

--
-- Table structure for table `markzhu_users`
--

CREATE TABLE IF NOT EXISTS `markzhu_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_pwd` varchar(200) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `markzhu_users`
--

INSERT INTO `markzhu_users` (`user_id`, `user_name`, `user_pwd`) VALUES
(2, 'zhu', '$P$B63CqcsUUOrx8OdJmLY4Pezpe0j1a/1'),
(3, 'zhangsan', '123456'),
(4, 'lilii', '4567'),
(5, 'red', '$P$Bf9/JKME5P543WC61ZCcvAwvk7/mJ31');

-- --------------------------------------------------------

--
-- Table structure for table `markzhu_users_meta`
--

CREATE TABLE IF NOT EXISTS `markzhu_users_meta` (
  `meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `meta_key` varchar(200) DEFAULT NULL,
  `meta_value` text,
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `markzhu_users_meta`
--

INSERT INTO `markzhu_users_meta` (`meta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 5, 'reg_date', '2016-11-14 10:23:47');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
