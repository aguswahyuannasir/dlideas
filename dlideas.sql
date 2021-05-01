/*
 Navicat Premium Data Transfer

 Source Server         : mysql_localhost
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : dlideas

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 01/05/2021 12:57:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_menu
-- ----------------------------
DROP TABLE IF EXISTS `m_menu`;
CREATE TABLE `m_menu` (
  `MENU_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MENU_PARENT` int(11) DEFAULT '0',
  `MENU_NAME` varchar(255) DEFAULT NULL,
  `MENU_ORDER` int(11) DEFAULT NULL,
  `MENU_ICON` varchar(255) DEFAULT NULL,
  `MENU_URL` varchar(255) DEFAULT NULL,
  `MENU_MODULE` varchar(255) DEFAULT NULL,
  `MENU_CONTROLLER` varchar(255) DEFAULT NULL,
  `MENU_STATUS` enum('0','1','99') DEFAULT '1',
  `MENU_CREATED_DATE` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `MENU_CREATED_BY` int(11) DEFAULT NULL,
  `MENU_UPDATED_DATE` timestamp NULL DEFAULT NULL,
  `MENU_UPDATED_BY` int(11) DEFAULT NULL,
  PRIMARY KEY (`MENU_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of m_menu
-- ----------------------------
BEGIN;
INSERT INTO `m_menu` VALUES (2, 0, 'Question 1', 2, 'book-open', NULL, NULL, 'question1', '1', '2021-03-04 21:47:24', NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (3, 0, 'Question 2', 3, 'book-open', NULL, NULL, 'question2', '1', '2021-04-28 22:11:48', NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (4, 0, 'Question 3', 4, 'book-open', NULL, NULL, 'question3', '1', '2021-04-28 22:11:57', NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_role
-- ----------------------------
DROP TABLE IF EXISTS `m_role`;
CREATE TABLE `m_role` (
  `ROLE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ROLE_NAME` varchar(255) NOT NULL,
  `ROLE_FOLDER` varchar(255) NOT NULL,
  `ROLE_MENU` text NOT NULL,
  `ROLE_STATUS` enum('0','1','99') DEFAULT '1' COMMENT '0 = inactive, 1=active, 99=delete',
  `ROLE_CREATED_DATE` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ROLE_CREATED_BY` int(11) DEFAULT NULL,
  `ROLE_UPDATED_DATE` timestamp NULL DEFAULT NULL,
  `ROLE_UPDATED_BY` int(11) DEFAULT NULL,
  `ROLE_DESCRIPTION` text,
  PRIMARY KEY (`ROLE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of m_role
-- ----------------------------
BEGIN;
INSERT INTO `m_role` VALUES (2, 'USER', 'user', '2,3,4', '1', '2021-05-01 12:50:45', 99, '2016-04-26 11:44:11', NULL, 'bisa semua kecuali master data.');
COMMIT;

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_USERNAME` varchar(32) DEFAULT NULL,
  `USER_PASSWORD` varchar(255) DEFAULT NULL,
  `USER_INITIAL` varchar(10) DEFAULT NULL,
  `USER_NAME` varchar(32) DEFAULT NULL,
  `USER_ROLE_ID` varchar(255) DEFAULT NULL,
  `USER_TITLE` varchar(255) DEFAULT NULL,
  `USER_EMAIL` varchar(255) DEFAULT NULL,
  `USER_CUS_COMPANY` text,
  `USER_UNIT` varchar(255) DEFAULT NULL,
  `USER_IS_ACTIVE` enum('0','1','99') NOT NULL DEFAULT '1',
  `USER_CREATED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USER_UPDATED_DATE` timestamp NULL DEFAULT NULL,
  `USER_CUS_ID` varchar(255) DEFAULT NULL,
  `USER_TYPE` enum('0','1','2') DEFAULT '0' COMMENT '0=normal, 1=view, 2=cssm',
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=365 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of m_user
-- ----------------------------
BEGIN;
INSERT INTO `m_user` VALUES (30, 'admin', '1f32aa4c9a1d2ea010adcf2348166a04', 'unknown', 'ADMIN', '1,2', 'Account Manager & Sales', 'fds.firdaus@gmail.com', '1', NULL, '1', '2017-11-10 08:40:04', '2017-12-05 10:43:29', NULL, '0');
INSERT INTO `m_user` VALUES (364, 'user', '1f32aa4c9a1d2ea010adcf2348166a04', NULL, 'user', '2', NULL, NULL, NULL, NULL, '1', '2019-03-25 22:09:53', NULL, NULL, '0');
COMMIT;

-- ----------------------------
-- Table structure for sys_log_history
-- ----------------------------
DROP TABLE IF EXISTS `sys_log_history`;
CREATE TABLE `sys_log_history` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_us_id` int(11) DEFAULT NULL,
  `log_role_id` int(11) DEFAULT NULL,
  `log_other_user` varchar(255) DEFAULT NULL,
  `log_ip_address` varchar(255) DEFAULT NULL,
  `log_type` varchar(255) DEFAULT NULL,
  `log_created_date` datetime DEFAULT NULL,
  `log_activity` varchar(255) DEFAULT NULL,
  `log_param_id` text,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25805 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_log_history
-- ----------------------------
BEGIN;
INSERT INTO `sys_log_history` VALUES (25804, 364, 2, '', '::1', 'login', '2021-05-01 12:56:02', 'Login AS USER', '2');
COMMIT;

-- ----------------------------
-- Table structure for tbl_question3
-- ----------------------------
DROP TABLE IF EXISTS `tbl_question3`;
CREATE TABLE `tbl_question3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` text,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_question3
-- ----------------------------
BEGIN;
INSERT INTO `tbl_question3` VALUES (6, 'task list', 'Remind');
INSERT INTO `tbl_question3` VALUES (7, 'okayy', 'Hobby');
COMMIT;

-- ----------------------------
-- View structure for v_log_history
-- ----------------------------
DROP VIEW IF EXISTS `v_log_history`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_log_history` AS select `b`.`USER_ID` AS `USER_ID`,`b`.`USER_NAME` AS `USER_NAME`,`b`.`USER_INITIAL` AS `USER_INITIAL`,`a`.`log_id` AS `log_id`,`a`.`log_us_id` AS `log_us_id`,`a`.`log_role_id` AS `log_role_id`,`a`.`log_ip_address` AS `log_ip_address`,`a`.`log_other_user` AS `log_other_user`,`a`.`log_type` AS `log_type`,`a`.`log_created_date` AS `log_created_date`,`a`.`log_activity` AS `log_activity`,`a`.`log_param_id` AS `log_param_id` from (`sys_log_history` `a` left join `m_user` `b` on((`b`.`USER_ID` = `a`.`log_us_id`)));

-- ----------------------------
-- View structure for v_menu
-- ----------------------------
DROP VIEW IF EXISTS `v_menu`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_menu` AS select `m_menu`.`MENU_ID` AS `ID_MENU`,`m_menu`.`MENU_STATUS` AS `IS_ACTIVE`,`m_menu`.`MENU_NAME` AS `MENU`,`m_menu`.`MENU_PARENT` AS `MENU2`,`m_menu`.`MENU_MODULE` AS `MODULE`,`m_menu`.`MENU_CONTROLLER` AS `CONTROLLER`,'' AS `METHOD` from `m_menu`;

SET FOREIGN_KEY_CHECKS = 1;
