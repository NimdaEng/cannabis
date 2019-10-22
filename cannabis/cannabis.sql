/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100125
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MariaDB
 Target Server Version : 100125
 File Encoding         : 65001

 Date: 22/10/2019 14:09:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cannabis
-- ----------------------------
DROP TABLE IF EXISTS `cannabis`;
CREATE TABLE `cannabis`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'ชื่อ',
  `lastname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'นามสกุล',
  `cid` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'บัตรประชาชน',
  `birthday_en` date DEFAULT NULL COMMENT 'วันเดือนปีเกิด ค.ศ.',
  `disease` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'โรคประจำตัว ผู้ป่วย 4 กลุ่มโรค',
  `screening` date DEFAULT NULL COMMENT 'วันที่ประสงค์เข้าคัดกรอง',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
