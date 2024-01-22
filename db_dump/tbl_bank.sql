/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100420
 Source Host           : localhost:3306
 Source Schema         : umroh_api

 Target Server Type    : MariaDB
 Target Server Version : 100420
 File Encoding         : 65001

 Date: 06/01/2024 10:59:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_bank
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bank`;
CREATE TABLE `tbl_bank`  (
  `id_bank` int(10) NOT NULL AUTO_INCREMENT,
  `nama_bank` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_input` datetime(0) NULL DEFAULT NULL,
  `tgl_update` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_bank`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 100 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_bank
-- ----------------------------
INSERT INTO `tbl_bank` VALUES (97, 'Bank Mandiri', '2024-01-02 14:20:41', '2024-01-02 14:20:41');
INSERT INTO `tbl_bank` VALUES (98, 'Bank BNI', '2024-01-02 14:20:41', '2024-01-02 14:20:41');
INSERT INTO `tbl_bank` VALUES (99, 'Bank BCA', '2024-01-02 14:20:41', '2024-01-02 14:20:41');

SET FOREIGN_KEY_CHECKS = 1;
