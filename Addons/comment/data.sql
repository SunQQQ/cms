/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : tpcms

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-12-31 14:21:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `onethink_comment`
-- ----------------------------
DROP TABLE IF EXISTS `onethink_comment`;
CREATE TABLE `onethink_comment` (
  `id` mediumint(7) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章ID',
  `cid` mediumint(7) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `authorid` mediumint(7) NOT NULL DEFAULT '0' COMMENT '审核者ID',
  `uid` mediumint(7) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '提交时间',
  `content` text NOT NULL COMMENT '评论内容',
  `ip` varchar(15) NOT NULL DEFAULT '' COMMENT '用户IP地址',
  `icon` tinyint(3) NOT NULL DEFAULT '0' COMMENT '表情',
  `yz` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否验证',
  `ifcom` tinyint(1) NOT NULL DEFAULT '0',
  `agree` mediumint(5) NOT NULL DEFAULT '0',
  `disagree` mediumint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `fid` (`cid`),
  KEY `uid` (`uid`),
  KEY `ifcom` (`ifcom`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of onethink_comment
-- ----------------------------
INSERT INTO `onethink_comment` VALUES ('1', '604', '39', '1', '1', 'admin', '1289286091', '好东西大家要一起分离的哦', '127.0.0.1', '1', '1', '0', '0', '0');
INSERT INTO `onethink_comment` VALUES ('2', '566', '39', '1', '1', 'admin', '1289286118', '受教非浅.大家都要过来看看,不看会后悔的呀\\', '127.0.0.1', '1', '1', '0', '0', '0');
INSERT INTO `onethink_comment` VALUES ('3', '567', '39', '1', '1', 'admin', '1289286144', '想要在电子商务方面成功,实战很重要!', '127.0.0.1', '1', '1', '0', '0', '0');
INSERT INTO `onethink_comment` VALUES ('24', '1', '2', '0', '1', 'Administrator', '1419909163', 'sdfsdf', '127.0.0.1', '0', '1', '0', '0', '0');
INSERT INTO `onethink_comment` VALUES ('25', '1', '2', '0', '0', '', '1419909353', 'sdfsf', '127.0.0.1', '0', '1', '0', '0', '0');
INSERT INTO `onethink_hooks` (`name`,`description`,`type`,`update_time`,`addons`,`status`) VALUES ('aritcleComment', '文章本地评论插件', '1', '1418612693', 'Comment', '1');
