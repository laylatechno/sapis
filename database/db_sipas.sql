/*
 Navicat Premium Data Transfer

 Source Server         : Local Host
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : db_sipasc4

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 05/09/2020 15:21:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for accountinfo
-- ----------------------------
DROP TABLE IF EXISTS `accountinfo`;
CREATE TABLE `accountinfo`  (
  `Username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `WorkunitID` int(11) NULL DEFAULT NULL,
  `FullName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `Village` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `SubDistrict` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `District` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `State` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ZIPCode` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `POB` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `DOB` date NULL DEFAULT NULL,
  `Gender` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Religion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of accountinfo
-- ----------------------------
INSERT INTO `accountinfo` VALUES ('admin', 1, 'Ionix Eternal Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for accountlogincounter
-- ----------------------------
DROP TABLE IF EXISTS `accountlogincounter`;
CREATE TABLE `accountlogincounter`  (
  `IndexID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CounterBrowser` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CounterOS` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CounterLog` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`IndexID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for accountuser
-- ----------------------------
DROP TABLE IF EXISTS `accountuser`;
CREATE TABLE `accountuser`  (
  `IndexID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Password` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `RoleID` int(11) NULL DEFAULT NULL,
  `AccountStatus` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `AccountProfile` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `AccountCover` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `Log` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`IndexID`, `Username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of accountuser
-- ----------------------------
INSERT INTO `accountuser` VALUES (1, 'admin', '$2y$10$sbWkPBJ6raF1jwQu7OAF6eCxoyBfEBGPN3lUh.d536mio0xyUNvZ2', NULL, 4, 'yes', NULL, NULL, '2020-08-12 04:56:33');

-- ----------------------------
-- Table structure for appsetting
-- ----------------------------
DROP TABLE IF EXISTS `appsetting`;
CREATE TABLE `appsetting`  (
  `AppID` int(11) NOT NULL AUTO_INCREMENT,
  `AppSmallLogoWhite` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `AppSmallLogoBlack` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `AppLargeLogoWhite` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `AppLargeLogoBlack` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `AppLoginHeader` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`AppID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of appsetting
-- ----------------------------
INSERT INTO `appsetting` VALUES (1, '6nk5moCD7BJy2xV13iwpUsZbTF8Xl9PNzfRYcSQ0jOWruGEqdI.png', 'hdeDw352EckjKSpxWbJCAVfaOYU0uB9XMrIGvzlQgZq1nLFTsR.jpg', 'v2Ladt10XiKEyuDcSO4QPAbkrgjw8fenH7N59hx3zCJMqWZYGm.png', 'R5fmNQnUwyCksSvBOZcKPTdEJIV7jA1LH4YMDWzro0x6lGh9bi.png', 'FRZ0lImLWCxGrJ3cP6Dfo2Uh8dtwnEv9j41qSzgb7piaOHKkTN.jpg');

-- ----------------------------
-- Table structure for companysetting
-- ----------------------------
DROP TABLE IF EXISTS `companysetting`;
CREATE TABLE `companysetting`  (
  `CompanyID` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CompanyType` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CompanyEmail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CompanyAddress` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `CompanyVillage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CompanySubDistrict` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CompanyDistrict` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CompanyState` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CompanyZIPCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CompanyPhone` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`CompanyID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of companysetting
-- ----------------------------
INSERT INTO `companysetting` VALUES (1, 'CV. Ionix Eternal Studio', 'Biro Jasa', 'support@ionixeternal.co.id', 'Alamat Lengkap Perusahaan', 'Kelurahan', 'Kecamatan', 'Kota', 'Provinsi', '41001', '081212862129');

-- ----------------------------
-- Table structure for disposition
-- ----------------------------
DROP TABLE IF EXISTS `disposition`;
CREATE TABLE `disposition`  (
  `DispositionID` int(11) NOT NULL AUTO_INCREMENT,
  `InMailID` int(11) NULL DEFAULT NULL,
  `Username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `DispositionNote` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `DispositionDeadline` date NULL DEFAULT NULL,
  `DispositionStatus` enum('read','unread') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `DispositionLog` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`DispositionID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for dispoted
-- ----------------------------
DROP TABLE IF EXISTS `dispoted`;
CREATE TABLE `dispoted`  (
  `DispositionID` int(11) NOT NULL,
  `Username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`DispositionID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for indeks
-- ----------------------------
DROP TABLE IF EXISTS `indeks`;
CREATE TABLE `indeks`  (
  `IndeksID` int(11) NOT NULL AUTO_INCREMENT,
  `IndeksCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `IndeksName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `IndeksDesc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`IndeksID`, `IndeksCode`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of indeks
-- ----------------------------
INSERT INTO `indeks` VALUES (1, '000', 'Umum', NULL);

-- ----------------------------
-- Table structure for inmail
-- ----------------------------
DROP TABLE IF EXISTS `inmail`;
CREATE TABLE `inmail`  (
  `InMailID` int(11) NOT NULL AUTO_INCREMENT,
  `IndeksID` int(11) NULL DEFAULT NULL,
  `WorkunitID` int(11) NULL DEFAULT NULL,
  `Username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `InMailAgenda` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `InMailNumber` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `InMailOrigin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `InMailContent` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `InMailTrait` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `InMailDate` date NULL DEFAULT NULL,
  `InMailStatus` int(11) NULL DEFAULT 0,
  `InMailLog` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`InMailID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for inmailattachment
-- ----------------------------
DROP TABLE IF EXISTS `inmailattachment`;
CREATE TABLE `inmailattachment`  (
  `AttachmentID` int(11) NOT NULL AUTO_INCREMENT,
  `InMailID` int(11) NULL DEFAULT NULL,
  `AttachmentName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `AttachmentFile` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `AttachmentLog` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`AttachmentID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for inmailcommentar
-- ----------------------------
DROP TABLE IF EXISTS `inmailcommentar`;
CREATE TABLE `inmailcommentar`  (
  `CommentarID` int(11) NOT NULL AUTO_INCREMENT,
  `InMailID` int(11) NULL DEFAULT NULL,
  `Username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CommentarDesc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `CommentarLog` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`CommentarID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for menuaccess
-- ----------------------------
DROP TABLE IF EXISTS `menuaccess`;
CREATE TABLE `menuaccess`  (
  `IndexID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleID` int(11) NULL DEFAULT NULL,
  `GroupID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`IndexID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menuaccess
-- ----------------------------
INSERT INTO `menuaccess` VALUES (1, 4, 1);
INSERT INTO `menuaccess` VALUES (2, 4, 2);
INSERT INTO `menuaccess` VALUES (6, 4, 6);
INSERT INTO `menuaccess` VALUES (7, 4, 7);
INSERT INTO `menuaccess` VALUES (8, 1, 1);
INSERT INTO `menuaccess` VALUES (9, 2, 1);
INSERT INTO `menuaccess` VALUES (11, 2, 3);
INSERT INTO `menuaccess` VALUES (12, 3, 1);
INSERT INTO `menuaccess` VALUES (13, 3, 4);
INSERT INTO `menuaccess` VALUES (14, 3, 5);
INSERT INTO `menuaccess` VALUES (15, 4, 3);
INSERT INTO `menuaccess` VALUES (16, 4, 4);
INSERT INTO `menuaccess` VALUES (17, 4, 5);

-- ----------------------------
-- Table structure for menugroup
-- ----------------------------
DROP TABLE IF EXISTS `menugroup`;
CREATE TABLE `menugroup`  (
  `GroupID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupTitle` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`GroupID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menugroup
-- ----------------------------
INSERT INTO `menugroup` VALUES (1, 'Main Menu');
INSERT INTO `menugroup` VALUES (2, 'Master Data');
INSERT INTO `menugroup` VALUES (3, 'Registrasi');
INSERT INTO `menugroup` VALUES (4, 'Disposisi');
INSERT INTO `menugroup` VALUES (5, 'Laporan');
INSERT INTO `menugroup` VALUES (6, 'Manajemen');
INSERT INTO `menugroup` VALUES (7, 'Pengaturan');

-- ----------------------------
-- Table structure for menumaster
-- ----------------------------
DROP TABLE IF EXISTS `menumaster`;
CREATE TABLE `menumaster`  (
  `MenuID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) NULL DEFAULT NULL,
  `MenuTitle` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `MenuLink` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `MenuIcon` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `MenuType` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`MenuID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menumaster
-- ----------------------------
INSERT INTO `menumaster` VALUES (1, 1, 'Beranda', 'dashboard', 'mdi mdi-view-dashboard', 0);
INSERT INTO `menumaster` VALUES (2, 1, 'Kotak Masuk', 'inbox', 'mdi mdi-email-multiple-outline', 0);
INSERT INTO `menumaster` VALUES (3, 2, 'Indeks Surat', 'indeks', 'mdi mdi-format-list-bulleted-triangle', 0);
INSERT INTO `menumaster` VALUES (4, 3, 'Surat Masuk', 'incoming_mail', 'mdi mdi-inbox-arrow-down', 0);
INSERT INTO `menumaster` VALUES (5, 3, 'Surat Keluar', 'outgoing_mail', 'mdi mdi-inbox-arrow-up', 0);
INSERT INTO `menumaster` VALUES (6, 4, 'Surat Masuk', 'disposition', 'mdi mdi-arrow-right-bold-box-outline', 0);
INSERT INTO `menumaster` VALUES (7, 5, 'Surat Masuk', 'incoming_report', 'mdi mdi-file-import-outline', 0);
INSERT INTO `menumaster` VALUES (8, 5, 'Surat Keluar', 'outgoing_report', 'mdi mdi-file-export-outline', 0);
INSERT INTO `menumaster` VALUES (9, 6, 'Unit Kerja', 'workunit', 'mdi mdi-briefcase', 0);
INSERT INTO `menumaster` VALUES (10, 6, 'Pengguna & Hak Akses', 'users', 'mdi mdi-account-multiple-outline', 0);
INSERT INTO `menumaster` VALUES (11, 7, 'Instansi / Badan Usaha', 'company', 'mdi mdi-battlenet', 0);
INSERT INTO `menumaster` VALUES (12, 7, 'Backup Database', 'mdatabase', 'mdi mdi-backup-restore', 0);

-- ----------------------------
-- Table structure for outmail
-- ----------------------------
DROP TABLE IF EXISTS `outmail`;
CREATE TABLE `outmail`  (
  `OutMailID` int(11) NOT NULL AUTO_INCREMENT,
  `IndeksID` int(11) NULL DEFAULT NULL,
  `WorkunitID` int(11) NULL DEFAULT NULL,
  `Username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `OutMailAgenda` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `OutMailNumber` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `OutMailDestination` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `OutMailContent` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `OutMailTrait` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `OutMailDate` date NULL DEFAULT NULL,
  `OutMailLog` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`OutMailID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for outmailattachment
-- ----------------------------
DROP TABLE IF EXISTS `outmailattachment`;
CREATE TABLE `outmailattachment`  (
  `AttachmentID` int(11) NOT NULL AUTO_INCREMENT,
  `OutMailID` int(11) NULL DEFAULT NULL,
  `AttachmentName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `AttachmentFile` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `AttachmentLog` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`AttachmentID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for rolemaster
-- ----------------------------
DROP TABLE IF EXISTS `rolemaster`;
CREATE TABLE `rolemaster`  (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `RoleColor` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`RoleID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rolemaster
-- ----------------------------
INSERT INTO `rolemaster` VALUES (1, 'Pengguna', 'primary');
INSERT INTO `rolemaster` VALUES (2, 'Operator', 'warning');
INSERT INTO `rolemaster` VALUES (3, 'Pimpinan', 'success');
INSERT INTO `rolemaster` VALUES (4, 'Administrator', 'danger');

-- ----------------------------
-- Table structure for workunit
-- ----------------------------
DROP TABLE IF EXISTS `workunit`;
CREATE TABLE `workunit`  (
  `WorkunitID` int(11) NOT NULL AUTO_INCREMENT,
  `WorkunitCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `WorkunitName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `WorkunitDesc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`WorkunitID`, `WorkunitCode`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of workunit
-- ----------------------------
INSERT INTO `workunit` VALUES (1, 'ADM', 'Bag. Administrasi', NULL);

SET FOREIGN_KEY_CHECKS = 1;
