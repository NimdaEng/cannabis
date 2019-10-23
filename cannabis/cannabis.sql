/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MariaDB
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 23/10/2019 10:29:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cannabis
-- ----------------------------
DROP TABLE IF EXISTS `cannabis`;
CREATE TABLE `cannabis`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ชื่อ',
  `lastname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'นามสกุล',
  `cid` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'บัตรประชาชน',
  `birthday_en` date NOT NULL COMMENT 'วันเดือนปีเกิด ค.ศ.',
  `disease` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'โรคประจำตัว ผู้ป่วย 4 กลุ่มโรค',
  `screening` date NOT NULL COMMENT 'วันที่ประสงค์เข้าคัดกรอง',
  `mobile` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'เบอร์โทร',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `index_cid`(`cid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
