/*
 Navicat Premium Data Transfer

 Source Server         : appstarter
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : inventory

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 13/08/2023 11:33:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for divisis
-- ----------------------------
DROP TABLE IF EXISTS `divisis`;
CREATE TABLE `divisis`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_divisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of divisis
-- ----------------------------
INSERT INTO `divisis` VALUES (1, 'produksi', 1, '2023-08-11 14:17:08', '2023-08-11 14:17:08');
INSERT INTO `divisis` VALUES (2, 'umum', 1, '2023-08-11 14:17:16', '2023-08-11 14:17:16');

-- ----------------------------
-- Table structure for drivers
-- ----------------------------
DROP TABLE IF EXISTS `drivers`;
CREATE TABLE `drivers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_driver` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `drivers_kode_driver_unique`(`kode_driver` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of drivers
-- ----------------------------
INSERT INTO `drivers` VALUES (1, '1234', 'sifani', '1', 1, '2023-08-12 11:29:16', '2023-08-13 03:21:07');
INSERT INTO `drivers` VALUES (2, '12777', 'affan', '1', 1, '2023-08-12 15:34:01', '2023-08-12 15:35:28');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for karyawans
-- ----------------------------
DROP TABLE IF EXISTS `karyawans`;
CREATE TABLE `karyawans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `karyawans_nama_karyawan_unique`(`nama_karyawan` ASC) USING BTREE,
  INDEX `karyawans_divisi_id_foreign`(`divisi_id` ASC) USING BTREE,
  INDEX `karyawans_user_id_foreign`(`user_id` ASC) USING BTREE,
  CONSTRAINT `karyawans_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `karyawans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of karyawans
-- ----------------------------
INSERT INTO `karyawans` VALUES (1, 'affann', 1, 23, 'manager', 1, '2023-08-11 15:03:53', '2023-08-11 15:03:53');
INSERT INTO `karyawans` VALUES (2, 'rutt', 2, 24, 'manager', 1, '2023-08-11 15:04:28', '2023-08-11 15:04:28');
INSERT INTO `karyawans` VALUES (3, 'sifani', 2, 25, 'staff', 1, '2023-08-11 18:18:19', '2023-08-11 18:18:19');
INSERT INTO `karyawans` VALUES (4, 'direktur', 1, 26, 'direktur', 1, '2023-08-11 18:18:32', '2023-08-11 18:18:32');
INSERT INTO `karyawans` VALUES (5, 'coba', 1, 27, 'staff', 1, '2023-08-12 15:34:50', '2023-08-12 15:34:50');

-- ----------------------------
-- Table structure for kendaraans
-- ----------------------------
DROP TABLE IF EXISTS `kendaraans`;
CREATE TABLE `kendaraans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_kendaraan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kendaraan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `merk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tahun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kondisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `kendaraans_kode_kendaraan_unique`(`kode_kendaraan` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kendaraans
-- ----------------------------
INSERT INTO `kendaraans` VALUES (1, '12345', 'Kijang', 'Toyota', '2001', 'baik', '1', 1, NULL, '2023-08-13 03:21:07');
INSERT INTO `kendaraans` VALUES (2, '12456', 'Beat', 'Honda', '2020', 'baik', '1', 1, '2023-08-12 15:33:31', '2023-08-12 15:35:28');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_08_10_135457_create_roles_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (4, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (6, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (7, '2023_08_10_134017_create_divisis_table', 1);
INSERT INTO `migrations` VALUES (8, '2023_08_10_135314_create_kendaraans_table', 1);
INSERT INTO `migrations` VALUES (9, '2023_08_10_135329_create_drivers_table', 1);
INSERT INTO `migrations` VALUES (10, '2023_08_10_135342_create_karyawans_table', 1);
INSERT INTO `migrations` VALUES (11, '2023_08_10_135409_create_pemesanans_table', 1);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for pemesanans
-- ----------------------------
DROP TABLE IF EXISTS `pemesanans`;
CREATE TABLE `pemesanans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `karyawan_id` bigint UNSIGNED NOT NULL,
  `driver_id` bigint UNSIGNED NOT NULL,
  `karyawan_approval_id` bigint UNSIGNED NOT NULL,
  `kendaraan_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pemesanans_karyawan_id_foreign`(`karyawan_id` ASC) USING BTREE,
  INDEX `pemesanans_driver_id_foreign`(`driver_id` ASC) USING BTREE,
  INDEX `pemesanans_karyawan_approval_id_foreign`(`karyawan_approval_id` ASC) USING BTREE,
  INDEX `pemesanans_kendaraan_foreign`(`kendaraan_id` ASC) USING BTREE,
  CONSTRAINT `pemesanans_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pemesanans_karyawan_approval_id_foreign` FOREIGN KEY (`karyawan_approval_id`) REFERENCES `karyawans` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pemesanans_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pemesanans_kendaraan_foreign` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraans` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pemesanans
-- ----------------------------
INSERT INTO `pemesanans` VALUES (8, 5, 1, 2, 1, '1', '2023-08-13 03:21:07', '2023-08-13 03:21:07');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', 1, '2023-08-11 14:02:26', '2023-08-11 14:02:26');
INSERT INTO `roles` VALUES (2, 'direktur', 1, NULL, NULL);
INSERT INTO `roles` VALUES (3, 'manager', 1, NULL, NULL);
INSERT INTO `roles` VALUES (4, 'staff', 1, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT 1,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username` ASC) USING BTREE,
  INDEX `users_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, 'admin', '$2y$10$RgCCyxbHVI7g1/XOVkQL1eLWzGlkgOhBsERE5THo7/LpNBk3pNUee', NULL, 1, NULL, '2023-08-11 14:02:27', '2023-08-11 14:02:27');
INSERT INTO `users` VALUES (23, 3, 'fann', '$2y$10$4AQEBHnsAxAGG7D.LPW00.zEO8bNnqN/.oFa8Wz15IU7Tk/ZCqjGm', NULL, 1, NULL, '2023-08-11 15:03:53', '2023-08-11 15:03:53');
INSERT INTO `users` VALUES (24, 3, 'tyy', '$2y$10$ATxcLP98asIOwQtrprw8NOymPDYbBckZZmDup29iqyOIAkftOArwO', NULL, 1, NULL, '2023-08-11 15:04:28', '2023-08-11 15:04:28');
INSERT INTO `users` VALUES (25, 4, 'fannn', '$2y$10$LcgbSImNRDlLoVIufOyo9.nt25lGnu9aOP1TTm.n8g7YeCDDvCQ86', NULL, 1, NULL, '2023-08-11 18:18:18', '2023-08-11 18:18:18');
INSERT INTO `users` VALUES (26, 2, 'top', '$2y$10$AnmbSwRWDwd8IwV5rfrMguFV.l8bWtNICfuuXLjJFCMMt3yGv4e0y', NULL, 1, NULL, '2023-08-11 18:18:32', '2023-08-11 18:18:32');
INSERT INTO `users` VALUES (27, 4, 'affan123', '$2y$10$r.9JZ57ZX7DlI1TZsGnq7eE8KG3u2Z.jUb8aDBLbHjz2qT8HnAUHq', NULL, 1, NULL, '2023-08-12 15:34:50', '2023-08-12 15:34:50');

SET FOREIGN_KEY_CHECKS = 1;
