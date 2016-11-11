-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2016 at 10:58 AM
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
  `user_pwd` varchar(50) NOT NULL,
  `user_regdate` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `markzhu_users`
--

INSERT INTO `markzhu_users` (`user_id`, `user_name`, `user_pwd`, `user_regdate`) VALUES
(2, 'zhu', '4545ec12dfebcb70043960aa74d17446', '2016-11-09 14:31:56'),
(3, 'zhangsan', '123456', '2016-11-11 16:53:24');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
