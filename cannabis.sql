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

 Date: 24/10/2019 13:40:39
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
  `create_at` datetime(0) NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `index_cid`(`cid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cannabis
-- ----------------------------
INSERT INTO `cannabis` VALUES (11, 'ทดสอบชื่อ', 'ทดสอบนามสกุล', '1111111111119', '1982-01-05', 'พาร์กินสัน (Parkinson’s disease)', '2019-11-04', '0813907061', '2019-10-23 11:16:57');
INSERT INTO `cannabis` VALUES (12, 'ทดสอบชื่อ', 'ทดสอบนามสกุล', '1111111111116', '1982-01-05', 'พาร์กินสัน (Parkinson’s disease)', '2019-11-04', '0813907061', '2019-10-23 11:17:01');
INSERT INTO `cannabis` VALUES (13, 'ทดสอบชื่อ', 'ทดสอบนามสกุล', '1111111111111', '1982-01-05', 'พาร์กินสัน (Parkinson’s disease)', '2019-11-04', '0813907061', '2019-10-23 11:17:12');
INSERT INTO `cannabis` VALUES (14, 'ทดสอบชื่อ', 'ทดสอบนามสกุล', '1111111111112', '1982-01-05', 'พาร์กินสัน (Parkinson’s disease)', '2019-11-04', '0813907061', '2019-10-23 11:17:16');
INSERT INTO `cannabis` VALUES (15, 'ทดสอบชื่อ', 'ทดสอบนามสกุล', '1111111111113', '1982-01-05', 'โรคปวดจากปลายประสาท หรือ โรคที่มีอาการปวดรุนแรง เช่น ไมเกรน(migrain) ปลายประสาทใบหน้าอักเสบ (trigeminal nerve pain) เป็นต้น', '2019-11-06', '0813907061', '2019-10-23 11:17:22');
INSERT INTO `cannabis` VALUES (16, 'ทดสอบชื่อ', 'ทดสอบนามสกุล', '1111111111114', '1982-01-05', 'พาร์กินสัน (Parkinson’s disease)', '2019-11-07', '0813907061', '2019-10-23 11:17:26');
INSERT INTO `cannabis` VALUES (17, 'ทดสอบชื่อ', 'ทดสอบนามสกุล', '1111111111115', '1982-01-05', 'พาร์กินสัน (Parkinson’s disease)', '2019-11-05', '0813907061', '2019-10-23 11:17:30');
INSERT INTO `cannabis` VALUES (18, 'ทดสอบชื่อ', 'ทดสอบนามสกุล', '1111111111117', '1982-01-05', 'โรคปวดจากปลายประสาท หรือ โรคที่มีอาการปวดรุนแรง เช่น ไมเกรน(migrain) ปลายประสาทใบหน้าอักเสบ (trigeminal nerve pain) เป็นต้น', '2019-11-05', '0813907061', '2019-10-23 11:17:35');
INSERT INTO `cannabis` VALUES (19, 'ทดสอบชื่อ', 'ทดสอบนามสกุล', '1111111111118', '1982-01-05', 'โรคปวดจากปลายประสาท หรือ โรคที่มีอาการปวดรุนแรง เช่น ไมเกรน(migrain) ปลายประสาทใบหน้าอักเสบ (trigeminal nerve pain) เป็นต้น', '2019-11-05', '0813907061', '2019-10-23 11:16:43');
INSERT INTO `cannabis` VALUES (20, 'ทดสอบชื่อ', 'ทดสอบนามสกุล', '1111111111199', '1982-01-05', 'พาร์กินสัน (Parkinson’s disease)', '2019-11-08', '0813907061', '2019-10-23 15:06:28');
INSERT INTO `cannabis` VALUES (21, 'ทดสอบชื่อ', 'ทดสอบนามสกุล', '3340701740851', '1982-01-05', 'โรคปวดจากปลายประสาท หรือ โรคที่มีอาการปวดรุนแรง เช่น ไมเกรน(migrain) ปลายประสาทใบหน้าอักเสบ (trigeminal nerve pain) เป็นต้น', '2019-11-06', '0813907061', '2019-10-23 15:23:52');

SET FOREIGN_KEY_CHECKS = 1;
