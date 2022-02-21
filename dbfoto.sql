/*
 Navicat Premium Data Transfer

 Source Server         : XSSDP LOCAL
 Source Server Type    : MySQL
 Source Server Version : 50734
 Source Host           : 127.0.0.1:8889
 Source Schema         : dbfoto

 Target Server Type    : MySQL
 Target Server Version : 50734
 File Encoding         : 65001

 Date: 18/02/2022 13:20:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for carts
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `produk_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jumlahPesanan` int(11) NOT NULL,
  `hargaSatuan` int(11) NOT NULL,
  `totalHarga` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of carts
-- ----------------------------
BEGIN;
INSERT INTO `carts` (`id`, `user_id`, `produk_id`, `created_at`, `updated_at`, `jumlahPesanan`, `hargaSatuan`, `totalHarga`) VALUES (73, 7, 2, '2022-02-18 05:00:50', '2022-02-18 05:00:50', 1, 300000, 300000);
INSERT INTO `carts` (`id`, `user_id`, `produk_id`, `created_at`, `updated_at`, `jumlahPesanan`, `hargaSatuan`, `totalHarga`) VALUES (74, 7, 5, '2022-02-18 05:02:09', '2022-02-18 05:02:09', 1, 20000, 20000);
COMMIT;

-- ----------------------------
-- Table structure for cetakfoto
-- ----------------------------
DROP TABLE IF EXISTS `cetakfoto`;
CREATE TABLE `cetakfoto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `stok` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `updated_at` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  `created_at` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cetakfoto
-- ----------------------------
BEGIN;
INSERT INTO `cetakfoto` (`id`, `gambar`, `harga`, `keterangan`, `stok`, `author`, `updated_at`, `created_at`) VALUES (17, 'a4.jpg', 20000, 'Bingkai Foto A4', 6, 'admin', '2022-01-29 09:08:19.000000', '2022-01-29 09:08:19.000000');
INSERT INTO `cetakfoto` (`id`, `gambar`, `harga`, `keterangan`, `stok`, `author`, `updated_at`, `created_at`) VALUES (18, '4r3.jpg', 30000, 'Bingkai foto R3', 9, 'admin', '2022-02-05 09:59:48.000000', '2022-01-30 03:25:26.000000');
COMMIT;

-- ----------------------------
-- Table structure for detailcetakfoto
-- ----------------------------
DROP TABLE IF EXISTS `detailcetakfoto`;
CREATE TABLE `detailcetakfoto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cetakfoto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `namapemesan` varchar(100) NOT NULL,
  `jumlahpesanan` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `buktitransfer` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `created_at` datetime(6) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of detailcetakfoto
-- ----------------------------
BEGIN;
INSERT INTO `detailcetakfoto` (`id`, `id_cetakfoto`, `id_user`, `namapemesan`, `jumlahpesanan`, `foto`, `no_telp`, `status`, `buktitransfer`, `author`, `updated_at`, `created_at`, `id_product`) VALUES (83, 5, 7, 'liana', 1, 'ft keluat.jpg', '11221', 'Selesai Dicetak', 'ft keluat.jpg', 'liana', '2022-02-18 06:18:30.000000', '2022-02-17 05:26:49.000000', NULL);
INSERT INTO `detailcetakfoto` (`id`, `id_cetakfoto`, `id_user`, `namapemesan`, `jumlahpesanan`, `foto`, `no_telp`, `status`, `buktitransfer`, `author`, `updated_at`, `created_at`, `id_product`) VALUES (84, 5, 7, 'LIANA', 1, ' merchant.png', '098765151', 'Proses Mencetak', ' merchant.png', 'liana', '2022-02-18 06:18:50.000000', '2022-02-18 04:13:03.000000', NULL);
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for galerifoto
-- ----------------------------
DROP TABLE IF EXISTS `galerifoto`;
CREATE TABLE `galerifoto` (
  `id_galeri` int(11) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `updated_at` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  `created_at` datetime(6) NOT NULL,
  PRIMARY KEY (`id_galeri`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of galerifoto
-- ----------------------------
BEGIN;
INSERT INTO `galerifoto` (`id_galeri`, `gambar`, `author`, `updated_at`, `created_at`) VALUES (85, '20220129145623.jpg', 'admin', '2022-01-29 14:56:23.000000', '2022-01-29 14:56:23.000000');
INSERT INTO `galerifoto` (`id_galeri`, `gambar`, `author`, `updated_at`, `created_at`) VALUES (86, '20220209080357.jpg', 'admin', '2022-02-09 08:03:57.000000', '2022-02-09 08:03:57.000000');
INSERT INTO `galerifoto` (`id_galeri`, `gambar`, `author`, `updated_at`, `created_at`) VALUES (87, '20220209080413.jpg', 'admin', '2022-02-09 08:04:13.000000', '2022-02-09 08:04:13.000000');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2022_01_26_144943_remove_unused_field_from_pemesanan', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2022_01_31_000438_create_carts_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2022_02_01_073338_add_jumlah_pesanan_to_carts_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2022_02_01_085354_add_pesanan_to_carts_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2022_02_01_085831_add_pesanans_to_carts_table', 6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11, '2022_02_01_090257_add_pesanandsds_to_carts_table', 7);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12, '2022_02_01_090402_add_pesanasdsadandsds_to_carts_table', 8);
COMMIT;

-- ----------------------------
-- Table structure for paketfoto
-- ----------------------------
DROP TABLE IF EXISTS `paketfoto`;
CREATE TABLE `paketfoto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) NOT NULL,
  `jenispaket` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of paketfoto
-- ----------------------------
BEGIN;
INSERT INTO `paketfoto` (`id`, `gambar`, `jenispaket`, `keterangan`, `harga`, `author`, `updated_at`, `created_at`) VALUES (59, 'foto wedding.jpg', 'Paket Outdoor', 'Paket Wedding', 300000, 'admin', '2022-01-28 08:41:52', '2022-01-28 08:41:52');
INSERT INTO `paketfoto` (`id`, `gambar`, `jenispaket`, `keterangan`, `harga`, `author`, `updated_at`, `created_at`) VALUES (60, 'foto wisuda (1).jpg', 'Paket Studio', 'Paket foto Wisuda', 300000, 'admin', '2022-01-28 16:00:52', '2022-01-28 16:00:52');
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pemesanan
-- ----------------------------
DROP TABLE IF EXISTS `pemesanan`;
CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `namapemesan` varchar(100) NOT NULL,
  `jenispaket` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `tglfoto` date NOT NULL,
  `jam` time NOT NULL,
  `no_telp` varchar(25) NOT NULL,
  `status` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `buktipembayaran` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pemesanan
-- ----------------------------
BEGIN;
INSERT INTO `pemesanan` (`id`, `photo_id`, `id_user`, `namapemesan`, `jenispaket`, `alamat`, `tglfoto`, `jam`, `no_telp`, `status`, `author`, `buktipembayaran`, `updated_at`, `created_at`) VALUES (1, 4, 7, 'LIANA', 'paketfoto', 'JL ANGSA BARU', '2022-02-18', '11:54:00', '121212111', 'Selesai', 'liana', ' merchant.png', '2022-02-18 06:08:27', '2022-02-18 04:54:48');
INSERT INTO `pemesanan` (`id`, `photo_id`, `id_user`, `namapemesan`, `jenispaket`, `alamat`, `tglfoto`, `jam`, `no_telp`, `status`, `author`, `buktipembayaran`, `updated_at`, `created_at`) VALUES (2, 2, 7, '1', 'paketfoto', 'sl,las', '2022-02-19', '12:01:00', '1111', 'Lunas', 'liana', ' merchant.png', '2022-02-18 06:07:47', '2022-02-18 05:01:23');
COMMIT;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for photo
-- ----------------------------
DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` varchar(100) DEFAULT NULL,
  `jenispaket` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `author` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of photo
-- ----------------------------
BEGIN;
INSERT INTO `photo` (`id`, `gambar`, `keterangan`, `harga`, `stok`, `jenispaket`, `type`, `author`, `updated_at`, `created_at`) VALUES (1, 'foto wedding.jpg', 'foto wedding', 300000, NULL, 'Paket Outdoor', 'paketfoto', 'admin', '2022-02-16 00:58:16', '2022-02-16 00:58:16');
INSERT INTO `photo` (`id`, `gambar`, `keterangan`, `harga`, `stok`, `jenispaket`, `type`, `author`, `updated_at`, `created_at`) VALUES (2, 'foto wisuda.jpg', 'foto wisuda', 300000, NULL, 'Paket Studio', 'paketfoto', 'admin', '2022-02-16 00:58:45', '2022-02-16 00:58:45');
INSERT INTO `photo` (`id`, `gambar`, `keterangan`, `harga`, `stok`, `jenispaket`, `type`, `author`, `updated_at`, `created_at`) VALUES (3, 'a4.jpg', 'bingkai a4', 20000, '10', NULL, 'cetakfoto', 'admin', '2022-02-16 00:59:14', '2022-02-16 00:59:14');
INSERT INTO `photo` (`id`, `gambar`, `keterangan`, `harga`, `stok`, `jenispaket`, `type`, `author`, `updated_at`, `created_at`) VALUES (4, 'ft keluat.jpg', 'foto keluarga', 300000, NULL, 'Paket Studio', 'paketfoto', 'admin', '2022-02-17 03:49:24', '2022-02-17 03:49:24');
INSERT INTO `photo` (`id`, `gambar`, `keterangan`, `harga`, `stok`, `jenispaket`, `type`, `author`, `updated_at`, `created_at`) VALUES (5, '4r3.jpg', 'bingkai r3', 20000, '10', NULL, 'cetakfoto', 'admin', '2022-02-17 06:03:34', '2022-02-17 06:03:34');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'admin', 'admin', 'admin@admin.com', NULL, '$2y$10$JunKFzAzZGOXNJoURwitCejwneY723re.8QAypfOZ6sUS/a5HJptW', NULL, '2021-10-09 10:15:23', '2021-10-09 10:15:23');
INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (2, 'user', 'user', 'user@user.com', NULL, '$2y$10$SinrOKRzL0Ub8ldkooWZ7.P3oeU6HtrMCxTa3iYGWX6yDoZSceR9S', NULL, '2021-10-09 10:42:37', '2021-10-09 10:42:37');
INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (3, 'user', 'user', 'user1@user.com', NULL, '$2y$10$Mxc2r7d/x3bhGwLhdxZWWul2PK.JORi5HV9XpopF1zKKpMigNmMe2', NULL, '2021-10-09 10:43:18', '2021-10-09 10:43:18');
INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (4, 'user2', 'user', 'user2@user.com', NULL, '$2y$10$4NZDHPA.oobQBgFyjkDl4.HuTFKUvd6UjfXiiRe18JGfPV8Ta9QUu', NULL, '2021-10-09 13:15:32', '2021-10-09 13:15:32');
INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (7, 'liana', 'user', 'liana@gmail.com', NULL, '$2y$10$6bkhJl.k4qpqm9ez6/s9YuCRMUVBdLbViiiX/2WDPndnx28foTXNO', NULL, '2021-10-21 14:05:43', '2021-10-21 14:05:43');
INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (8, 'lili', 'user', 'lili@gmail.com', NULL, '$2y$10$nh4vOfuGukvFtWcVRZGbBe3teny3B1jKQLNfrOqnts0FPenEwETF6', NULL, '2021-11-03 02:43:09', '2021-11-03 02:43:09');
INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (10, 'sari', 'user', 'sari@gmail.com', NULL, '$2y$10$SAydPxZCh.vnrqdnkOMnyu8sI7vQr77JZbq5npAvSSaWCqKxvcKAa', NULL, '2021-12-19 09:19:05', '2021-12-19 09:19:05');
INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (11, 'mama', 'user', 'mama@gmail.com', NULL, '$2y$10$a8.yH2LvlrYGIF57go8B6.OW2CVT1fBAd5iPt2DCj27fsLYi1dJ6e', NULL, '2022-01-04 07:00:39', '2022-01-04 07:00:39');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
