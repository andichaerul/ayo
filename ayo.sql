/*
 Navicat Premium Data Transfer

 Source Server         : localMAMP
 Source Server Type    : MySQL
 Source Server Version : 50734
 Source Host           : localhost:8889
 Source Schema         : ayo

 Target Server Type    : MySQL
 Target Server Version : 50734
 File Encoding         : 65001

 Date: 16/03/2022 20:21:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cabang_olahragas
-- ----------------------------
DROP TABLE IF EXISTS `cabang_olahragas`;
CREATE TABLE `cabang_olahragas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_cab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cabang_olahragas
-- ----------------------------
BEGIN;
INSERT INTO `cabang_olahragas` VALUES (1, 'Bola Basket', '2022-03-15 16:42:48', '2022-03-15 16:42:48', NULL);
INSERT INTO `cabang_olahragas` VALUES (2, 'Sepak Bola', '2022-03-15 16:48:17', '2022-03-15 16:48:17', NULL);
INSERT INTO `cabang_olahragas` VALUES (3, 'Sepak Bola 12', '2022-03-15 17:04:07', '2022-03-15 17:38:05', '2022-03-15 17:38:05');
INSERT INTO `cabang_olahragas` VALUES (4, 'Bola Basket 1', '2022-03-15 17:20:53', '2022-03-15 17:37:54', '2022-03-15 17:37:54');
INSERT INTO `cabang_olahragas` VALUES (5, 'Bola Basket 2', '2022-03-15 17:25:41', '2022-03-15 17:37:50', '2022-03-15 17:37:50');
INSERT INTO `cabang_olahragas` VALUES (6, 'Bola Basket 5', '2022-03-15 17:25:56', '2022-03-15 17:37:44', '2022-03-15 17:37:44');
INSERT INTO `cabang_olahragas` VALUES (7, 'Bola Basket 9', '2022-03-15 17:26:05', '2022-03-15 17:37:39', '2022-03-15 17:37:39');
INSERT INTO `cabang_olahragas` VALUES (8, 'Test 1', '2022-03-15 17:52:18', '2022-03-15 19:31:14', '2022-03-15 19:31:14');
INSERT INTO `cabang_olahragas` VALUES (9, 'Bulutangkis', '2022-03-15 18:42:44', '2022-03-16 01:48:15', NULL);
INSERT INTO `cabang_olahragas` VALUES (10, 'test 1mmm', '2022-03-15 19:20:22', '2022-03-15 19:30:38', '2022-03-15 19:30:38');
INSERT INTO `cabang_olahragas` VALUES (11, 'Vollxsacxsacas', '2022-03-15 19:31:24', '2022-03-15 19:31:29', '2022-03-15 19:31:29');
INSERT INTO `cabang_olahragas` VALUES (12, 'Renang', '2022-03-15 19:31:42', '2022-03-16 01:47:26', '2022-03-16 01:47:26');
INSERT INTO `cabang_olahragas` VALUES (13, 'Berenang', '2022-03-16 01:50:52', '2022-03-16 01:50:52', NULL);
COMMIT;

-- ----------------------------
-- Table structure for jadwal_acaras
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_acaras`;
CREATE TABLE `jadwal_acaras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organisasi_id` int(11) NOT NULL,
  `tgl_acara` varchar(255) NOT NULL,
  `desc_acara` varchar(255) NOT NULL,
  `prioritas_acara` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jadwal_acaras
-- ----------------------------
BEGIN;
INSERT INTO `jadwal_acaras` VALUES (1, 2, '2022-03-22', 'desc', 'Wajib', '2022-03-16 08:09:07', '2022-03-16 08:09:07', NULL);
INSERT INTO `jadwal_acaras` VALUES (2, 3, '2022-04-07', 'Test 2', 'Hanya staf', '2022-03-16 08:17:05', '2022-03-16 08:17:05', NULL);
COMMIT;

-- ----------------------------
-- Table structure for laporan_acaras
-- ----------------------------
DROP TABLE IF EXISTS `laporan_acaras`;
CREATE TABLE `laporan_acaras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwal_acara_id` int(11) DEFAULT NULL,
  `organisasi_member_id` int(11) DEFAULT NULL,
  `konstribusi_member` varchar(255) DEFAULT NULL,
  `kehadiran_member` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of laporan_acaras
-- ----------------------------
BEGIN;
INSERT INTO `laporan_acaras` VALUES (22, 1, 4, '10000', 'Ya', '2022-03-16 12:05:40', '2022-03-16 12:05:40');
INSERT INTO `laporan_acaras` VALUES (23, 1, 5, '20000', 'Ya', '2022-03-16 12:05:40', '2022-03-16 12:05:40');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2022_03_15_152903_user', 1);
INSERT INTO `migrations` VALUES (2, '2022_03_15_155618_create_table_cab_olahraga', 2);
INSERT INTO `migrations` VALUES (3, '2022_03_15_193459_create_table_organisasis', 3);
COMMIT;

-- ----------------------------
-- Table structure for organisasi_members
-- ----------------------------
DROP TABLE IF EXISTS `organisasi_members`;
CREATE TABLE `organisasi_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tinggi` int(255) NOT NULL,
  `berat` int(255) NOT NULL,
  `no_phone` varchar(255) NOT NULL,
  `organisasi_id` int(11) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of organisasi_members
-- ----------------------------
BEGIN;
INSERT INTO `organisasi_members` VALUES (1, 'Andi Chaerul', 172, 77, '081527888714', 3, 'Staf', NULL, '2022-03-16 07:24:47', NULL);
INSERT INTO `organisasi_members` VALUES (2, 'Firman Utina', 121, 21, '123414124', 3, 'Ketua', '2022-03-16 07:31:52', '2022-03-16 07:31:52', '2022-03-16 07:11:37');
INSERT INTO `organisasi_members` VALUES (3, 'Firman utina', 160, 77, '081527888714', 3, 'Ketua', NULL, '2022-03-16 07:32:42', '2022-03-16 07:32:42');
INSERT INTO `organisasi_members` VALUES (4, 'Hermansyah', 120, 80, '081527888714', 2, 'Ketua', NULL, '2022-03-16 07:34:13', '2022-03-16 07:34:13');
INSERT INTO `organisasi_members` VALUES (5, 'Firman Utina', 175, 77, '0812322121', 2, 'Ketua', NULL, '2022-03-16 11:02:51', '2022-03-16 11:02:51');
COMMIT;

-- ----------------------------
-- Table structure for organisasis
-- ----------------------------
DROP TABLE IF EXISTS `organisasis`;
CREATE TABLE `organisasis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_organisasi` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_berdiri` int(11) NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cabang_olahraga_id` bigint(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of organisasis
-- ----------------------------
BEGIN;
INSERT INTO `organisasis` VALUES (1, 'Aut vel commodi non', NULL, 1200, 'Jalan lorong', 9, '2022-03-16 02:44:09', '2022-03-16 05:05:35', '2022-03-16 05:05:35');
INSERT INTO `organisasis` VALUES (2, 'PB 01 1', NULL, 2020, 'Jalan Raya 1', 13, '2022-03-16 03:23:36', '2022-03-16 04:49:33', NULL);
INSERT INTO `organisasis` VALUES (3, 'PB 02', NULL, 2012, 'Jalan Maros', 13, '2022-03-16 04:55:34', '2022-03-16 04:55:34', NULL);
COMMIT;

-- ----------------------------
-- Table structure for teams
-- ----------------------------
DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_team` varchar(255) NOT NULL,
  `organisasi_id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teams
-- ----------------------------
BEGIN;
INSERT INTO `teams` VALUES (1, 'Team 1', 2, NULL, '2022-03-16 05:45:26', '2022-03-16 05:34:03');
INSERT INTO `teams` VALUES (2, 'Team PB 01', 2, '2022-03-16 05:52:20', '2022-03-16 05:52:20', '2022-03-16 05:43:10');
INSERT INTO `teams` VALUES (3, 'Berdikasi 01', 3, NULL, '2022-03-16 05:53:13', '2022-03-16 05:53:13');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'Administrator', 'admin', '$2y$10$jpAQAPZEFA2DCyxNz73.h.aM0WcWWMiHez7dbc1SCmZanI4L4mqW.', NULL, NULL, NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
