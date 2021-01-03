-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `comments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `activities` (`id`, `title`, `type`, `comments`, `sign_date`, `created_at`, `updated_at`) VALUES
(1,	'Watching',	1,	'TV,Movie,Broadcasting,Online',	'2020-10-26 06:47:57',	'2020-10-25 21:47:57',	'2020-10-25 21:47:57'),
(2,	'Walking',	2,	'park,garden',	'2020-10-26 06:48:56',	'2020-10-25 21:48:56',	'2020-10-25 21:48:56'),
(3,	'breakfast',	1,	'tea,coffie,light food',	'2020-11-25 05:20:56',	'2020-11-25 05:20:56',	'2020-11-25 05:20:56'),
(4,	'PD1',	1,	'Test2',	'2020-11-26 06:56:59',	'2020-11-26 06:56:59',	'2020-11-26 14:57:32'),
(7,	'lunch',	2,	'test',	'2020-11-27 06:07:49',	'2020-11-27 06:07:49',	'2020-11-27 14:08:52'),
(8,	'snax',	1,	'tea,sandwitch',	'2020-11-27 06:17:44',	'2020-11-27 06:17:44',	'2020-11-27 06:17:44');

DROP TABLE IF EXISTS `admin_logs`;
CREATE TABLE `admin_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caretakerId` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_logs` (`id`, `content`, `caretakerId`, `sign_date`, `created_at`, `updated_at`) VALUES
(39,	'Admin gave antibiotic(10:00:00) to Rajib',	1,	'2020-12-23 01:29:31',	'2020-12-23 01:29:31',	'2020-12-23 01:29:31'),
(40,	'Admin gave Paracetamol(22:00) to Rajib',	1,	'2020-12-23 01:32:31',	'2020-12-23 01:32:31',	'2020-12-23 01:32:31'),
(41,	'Admin gave antibiotic(06:12) to Rajib',	1,	'2020-12-30 22:14:47',	'2020-12-30 22:14:47',	'2020-12-30 22:14:47'),
(42,	'Admin gave Paracetamol(10:00:00) to Rajib',	1,	'2020-12-30 22:17:09',	'2020-12-30 22:17:09',	'2020-12-30 22:17:09'),
(43,	'Admin gave Paracetamol(17:34:00) to Rajib',	1,	'2020-12-30 22:17:16',	'2020-12-30 22:17:16',	'2020-12-30 22:17:16'),
(44,	'Admin gave Paracetamol(19:34:00) to Rajib',	1,	'2020-12-30 22:17:20',	'2020-12-30 22:17:20',	'2020-12-30 22:17:20'),
(45,	'Admin gave antibiotic(20:00:00) to Rajib',	1,	'2020-12-30 22:17:25',	'2020-12-30 22:17:25',	'2020-12-30 22:17:25'),
(46,	'Admin gave Paracetamol(20:35:00) to Rajib',	1,	'2020-12-30 22:17:29',	'2020-12-30 22:17:29',	'2020-12-30 22:17:29'),
(47,	'Admin gave Vitamin C(22:00:00) to Rajib',	1,	'2020-12-30 22:17:33',	'2020-12-30 22:17:33',	'2020-12-30 22:17:33'),
(48,	'Admin gave Paracetamol(22:35:00) to Rajib',	1,	'2020-12-30 22:17:37',	'2020-12-30 22:17:37',	'2020-12-30 22:17:37');

DROP TABLE IF EXISTS `assign_medications`;
CREATE TABLE `assign_medications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `medications` int(10) unsigned NOT NULL,
  `dose` int(11) NOT NULL,
  `resident` int(10) unsigned NOT NULL,
  `route` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `time` time DEFAULT NULL,
  `start_day` date NOT NULL,
  `end_day` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assign_medications_medications_foreign` (`medications`),
  KEY `assign_medications_resident_foreign` (`resident`),
  CONSTRAINT `assign_medications_medications_foreign` FOREIGN KEY (`medications`) REFERENCES `medications` (`id`),
  CONSTRAINT `assign_medications_resident_foreign` FOREIGN KEY (`resident`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `assign_medications` (`id`, `medications`, `dose`, `resident`, `route`, `sign_date`, `time`, `start_day`, `end_day`, `created_at`, `updated_at`) VALUES
(18,	2,	1,	25,	'2',	'2020-12-23 00:10:23',	'22:00:00',	'2020-12-23',	'2021-01-22',	'2020-12-23 00:10:23',	'2020-12-23 01:24:59'),
(19,	9,	1,	25,	'2',	'2020-12-23 01:26:16',	'10:00:00',	'2020-12-01',	'2021-01-12',	'2020-12-23 01:26:16',	'2020-12-23 01:26:16'),
(20,	9,	1,	25,	'2',	'2020-12-23 01:26:16',	'20:00:00',	'2020-12-01',	'2021-01-12',	'2020-12-23 01:26:16',	'2020-12-23 01:26:16'),
(21,	3,	2,	25,	'2',	'2020-12-23 05:35:25',	'17:34:00',	'0000-00-00',	'0000-00-00',	'2020-12-23 05:35:25',	'2020-12-23 13:35:48'),
(22,	3,	2,	25,	'2',	'2020-12-23 05:35:25',	'19:34:00',	'0000-00-00',	'0000-00-00',	'2020-12-23 05:35:25',	'2020-12-23 13:35:54'),
(23,	3,	2,	25,	'2',	'2020-12-23 05:35:25',	'20:35:00',	'2020-12-23',	'2020-12-31',	'2020-12-23 05:35:25',	'2020-12-23 05:35:25'),
(24,	3,	2,	25,	'2',	'2020-12-23 05:35:25',	'22:35:00',	'2020-12-23',	'2020-12-31',	'2020-12-23 05:35:25',	'2020-12-23 05:35:25'),
(25,	3,	2,	25,	'2',	'2020-12-24 00:00:36',	'10:00:00',	'2020-12-01',	'2021-01-01',	'2020-12-24 00:00:36',	'2020-12-24 00:00:36');

DROP TABLE IF EXISTS `body_harms`;
CREATE TABLE `body_harms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resident` int(10) unsigned NOT NULL,
  `sign_date` datetime NOT NULL,
  `comment` int(10) unsigned NOT NULL,
  `screenshot_3d` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `body_harms_resident_foreign` (`resident`),
  KEY `body_harms_comment_foreign` (`comment`),
  CONSTRAINT `body_harms_comment_foreign` FOREIGN KEY (`comment`) REFERENCES `body_harm_comments` (`id`),
  CONSTRAINT `body_harms_resident_foreign` FOREIGN KEY (`resident`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `body_harms` (`id`, `resident`, `sign_date`, `comment`, `screenshot_3d`, `created_at`, `updated_at`) VALUES
(37,	25,	'2020-12-26 21:15:35',	8,	'screenshot_5fe818776e4a0.png',	'2020-12-26 21:15:35',	'2020-12-26 21:15:35'),
(38,	25,	'2020-12-27 23:21:42',	8,	'screenshot_5fe9878678bf9.png',	'2020-12-27 23:21:42',	'2020-12-27 23:21:42'),
(39,	25,	'2020-12-28 00:50:53',	8,	'screenshot_5fe99c6d9edda.png',	'2020-12-28 00:50:53',	'2020-12-28 00:50:53');

DROP TABLE IF EXISTS `body_harm_comments`;
CREATE TABLE `body_harm_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `body_harm_comments` (`id`, `name`, `sign_date`, `created_at`, `updated_at`) VALUES
(8,	'A',	'2020-12-26 21:09:25',	'2020-12-26 21:09:25',	'2020-12-26 21:09:25');

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_id` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `comments` (`id`, `type`, `name`, `ref_id`, `sign_date`, `created_at`, `updated_at`) VALUES
(5,	1,	'park',	2,	'2020-10-26 06:48:56',	'2020-10-25 21:48:56',	'2020-10-25 21:48:56'),
(6,	1,	'garden',	2,	'2020-10-26 06:48:56',	'2020-10-25 21:48:56',	'2020-10-25 21:48:56'),
(18,	1,	'tea',	3,	'2020-11-25 05:20:56',	'2020-11-25 05:20:56',	'2020-11-25 05:20:56'),
(19,	1,	'coffie',	3,	'2020-11-25 05:20:56',	'2020-11-25 05:20:56',	'2020-11-25 05:20:56'),
(20,	1,	'light food',	3,	'2020-11-25 05:20:56',	'2020-11-25 05:20:56',	'2020-11-25 05:20:56'),
(23,	1,	'Test2',	4,	'2020-11-26 06:57:32',	'2020-11-26 06:57:32',	'2020-11-26 06:57:32'),
(24,	1,	'TV',	1,	'2020-11-27 02:18:25',	'2020-11-27 02:18:25',	'2020-11-27 02:18:25'),
(25,	1,	'Movie',	1,	'2020-11-27 02:18:25',	'2020-11-27 02:18:25',	'2020-11-27 02:18:25'),
(26,	1,	'Broadcasting',	1,	'2020-11-27 02:18:25',	'2020-11-27 02:18:25',	'2020-11-27 02:18:25'),
(27,	1,	'Online',	1,	'2020-11-27 02:18:25',	'2020-11-27 02:18:25',	'2020-11-27 02:18:25'),
(41,	1,	'test',	7,	'2020-11-27 06:08:52',	'2020-11-27 06:08:52',	'2020-11-27 06:08:52'),
(44,	1,	'tea',	8,	'2020-11-27 06:18:12',	'2020-11-27 06:18:12',	'2020-11-27 06:18:12'),
(45,	1,	'sandwitch',	8,	'2020-11-27 06:18:12',	'2020-11-27 06:18:12',	'2020-11-27 06:18:12'),
(59,	2,	'test',	10,	'2020-11-28 01:28:30',	'2020-11-28 01:28:30',	'2020-11-28 01:28:30'),
(60,	2,	'test',	9,	'2020-11-28 03:53:44',	'2020-11-28 03:53:44',	'2020-11-28 03:53:44'),
(61,	2,	'face',	2,	'2020-11-28 07:15:23',	'2020-11-28 07:15:23',	'2020-11-28 07:15:23'),
(62,	2,	'body',	2,	'2020-11-28 07:15:23',	'2020-11-28 07:15:23',	'2020-11-28 07:15:23'),
(63,	2,	'blood',	2,	'2020-11-28 07:15:23',	'2020-11-28 07:15:23',	'2020-11-28 07:15:23'),
(64,	2,	'tooth',	2,	'2020-11-28 07:15:23',	'2020-11-28 07:15:23',	'2020-11-28 07:15:23'),
(65,	2,	'cold',	3,	'2020-11-28 07:15:33',	'2020-11-28 07:15:33',	'2020-11-28 07:15:33'),
(66,	2,	'hot',	3,	'2020-11-28 07:15:33',	'2020-11-28 07:15:33',	'2020-11-28 07:15:33'),
(67,	2,	'headache',	3,	'2020-11-28 07:15:33',	'2020-11-28 07:15:33',	'2020-11-28 07:15:33');

DROP TABLE IF EXISTS `general_settings`;
CREATE TABLE `general_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_footer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `general_settings` (`id`, `site_name`, `site_title`, `site_subtitle`, `site_desc`, `site_footer`, `created_at`, `updated_at`) VALUES
(1,	'Blue Care Hub',	'Mambo Dubai Multivendor Marketplace',	'Your Awesome Marketplace',	'Buy . Sell . Admin',	'© Copyright 2020 - City of UAE Dubai. All rights reserved.',	'2020-10-26 04:45:50',	'2020-10-26 04:45:50');

DROP TABLE IF EXISTS `incidences`;
CREATE TABLE `incidences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `content` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `incidences` (`id`, `title`, `type`, `content`, `sign_date`, `created_at`, `updated_at`) VALUES
(1,	'fall form chair',	3,	'test',	'2020-11-25 05:26:24',	'2020-11-25 05:26:24',	'2020-11-25 05:26:24'),
(2,	'test',	2,	'test',	'2020-11-25 05:27:26',	'2020-11-25 05:27:26',	'2020-11-25 05:27:26'),
(3,	'Test',	1,	'test',	'2020-11-25 05:27:44',	'2020-11-25 05:27:44',	'2020-11-25 05:27:44'),
(6,	'accident in garden',	3,	'fall',	'2020-11-27 06:20:00',	'2020-11-27 06:20:00',	'2020-11-27 06:20:00');

DROP TABLE IF EXISTS `localization_settings`;
CREATE TABLE `localization_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `localization_settings` (`id`, `language`, `currency`, `created_at`, `updated_at`) VALUES
(1,	'aed',	'AED',	'2020-10-26 04:45:50',	'2020-10-26 04:45:50');

DROP TABLE IF EXISTS `medications`;
CREATE TABLE `medications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dose` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `medications` (`id`, `name`, `dose`, `photo`, `comments`, `sign_date`, `created_at`, `updated_at`) VALUES
(2,	'Vitamin C',	'6',	'ZmZ4sAI6sbkxCpJfDesuDdF0TKIdOat74g95anuy.jpeg',	'face,body,blood,tooth',	'2020-10-26 06:59:41',	'2020-10-25 21:59:41',	'2020-11-28 07:15:23'),
(3,	'Paracetamol',	'2',	'znbHy0UGaWKZIVD2g7En6MaG232v5BU4ytbEDmHC.jpeg',	'cold,hot,headache',	'2020-10-26 07:05:05',	'2020-10-25 22:05:05',	'2020-11-28 07:15:33'),
(9,	'antibiotic',	'6',	'qxW2BRJCwg2w0HEIM24UUeaYk6TiqXTENJpf6KML.png',	'test',	'2020-11-28 01:12:37',	'2020-11-28 01:12:37',	'2020-11-28 11:53:44'),
(10,	'yoga',	'3',	'ZnaJNHYaMxSQt1bkTPGTRw9r0Ho4d6RtSOyyOjB7.png',	'test',	'2020-11-28 01:27:49',	'2020-11-28 01:27:49',	'2020-11-28 09:28:30');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2018_09_17_111127_create_roles_table',	1),
(4,	'2018_09_17_111825_create_role_user_table',	1),
(5,	'2018_09_22_021222_create_general_settings_table',	1),
(6,	'2018_10_08_113434_create_localization_settings_table',	1),
(7,	'2020_10_09_141634_create_activities_table',	1),
(8,	'2020_10_09_145306_create_incidences_table',	1),
(9,	'2020_10_11_193056_create_user_activities_table',	1),
(10,	'2020_10_16_060857_create_medications_table',	1),
(11,	'2020_10_20_102650_create_assign_medications_table',	1),
(12,	'2020_10_21_091916_create_tfg_table',	1),
(13,	'2020_10_21_141838_create_user_medications_table',	1),
(14,	'2020_10_22_113538_create_comments_table',	1),
(15,	'2020_10_28_174414_create_body_harm_comments',	2),
(17,	'2020_10_29_085636_create_body_harm_tables',	3),
(18,	'2020_10_30_193646_create_notifications_table',	4),
(19,	'2020_11_01_090009_create_reminder_configs_table',	5),
(20,	'2020_11_09_081058_create_routes_table',	6),
(21,	'2020_11_10_072908_create_admin_logs_table',	7),
(22,	'2020_11_11_151249_create_useractivity_reports_table',	8);

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contents` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1323 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `notifications` (`id`, `user_name`, `resident_name`, `contents`, `is_read`, `sign_date`, `created_at`, `updated_at`) VALUES
(1299,	'admin',	'Rajib',	'Medication : Paracetamol 22:35:00',	2,	'2020-12-28 22:30:01',	'2020-12-28 22:30:01',	'2020-12-30 22:15:56'),
(1300,	'admin',	'Rajib',	'Medication : antibiotic 10:00:00',	2,	'2020-12-29 09:55:02',	'2020-12-29 09:55:02',	'2020-12-30 22:15:57'),
(1301,	'admin',	'Rajib',	'Medication : Paracetamol 10:00:00',	2,	'2020-12-29 09:55:02',	'2020-12-29 09:55:02',	'2020-12-30 22:15:58'),
(1302,	'admin',	'Rajib',	'Medication : antibiotic 20:00:00',	2,	'2020-12-29 19:55:02',	'2020-12-29 19:55:02',	'2020-12-30 22:15:59'),
(1303,	'admin',	'Rajib',	'Medication : Paracetamol 20:35:00',	2,	'2020-12-29 20:30:01',	'2020-12-29 20:30:01',	'2020-12-30 22:16:01'),
(1304,	'admin',	'Rajib',	'Medication : Vitamin C 22:00:00',	2,	'2020-12-29 21:55:01',	'2020-12-29 21:55:01',	'2020-12-30 22:15:55'),
(1305,	'admin',	'Rajib',	'Medication : Paracetamol 22:35:00',	2,	'2020-12-29 22:30:02',	'2020-12-29 22:30:02',	'2020-12-30 22:16:02'),
(1306,	'admin',	'Rajib',	'Medication : antibiotic 10:00:00',	2,	'2020-12-30 09:55:02',	'2020-12-30 09:55:02',	'2020-12-30 22:16:03'),
(1307,	'admin',	'Rajib',	'Medication : Paracetamol 10:00:00',	2,	'2020-12-30 09:55:02',	'2020-12-30 09:55:02',	'2020-12-30 22:16:04'),
(1308,	'admin',	'Rajib',	'Medication : antibiotic 20:00:00',	2,	'2020-12-30 19:55:02',	'2020-12-30 19:55:02',	'2020-12-30 22:16:05'),
(1309,	'admin',	'Rajib',	'Medication : Paracetamol 20:35:00',	2,	'2020-12-30 20:30:01',	'2020-12-30 20:30:02',	'2020-12-30 22:16:06'),
(1310,	'admin',	'Rajib',	'Medication : Vitamin C 22:00:00',	2,	'2020-12-30 21:55:01',	'2020-12-30 21:55:01',	'2020-12-30 22:16:09'),
(1311,	'admin',	'Rajib',	'Medication : Paracetamol 22:35:00',	1,	'2020-12-30 22:30:01',	'2020-12-30 22:30:01',	'2020-12-30 22:30:01'),
(1312,	'admin',	'Rajib',	'Medication : antibiotic 10:00:00',	1,	'2020-12-31 09:55:02',	'2020-12-31 09:55:02',	'2020-12-31 09:55:02'),
(1313,	'admin',	'Rajib',	'Medication : Paracetamol 10:00:00',	1,	'2020-12-31 09:55:02',	'2020-12-31 09:55:02',	'2020-12-31 09:55:02'),
(1314,	'admin',	'Rajib',	'Medication : antibiotic 20:00:00',	1,	'2020-12-31 19:55:01',	'2020-12-31 19:55:01',	'2020-12-31 19:55:01'),
(1315,	'admin',	'Rajib',	'Medication : Paracetamol 20:35:00',	1,	'2020-12-31 20:30:01',	'2020-12-31 20:30:01',	'2020-12-31 20:30:01'),
(1316,	'admin',	'Rajib',	'Medication : Vitamin C 22:00:00',	1,	'2020-12-31 21:55:02',	'2020-12-31 21:55:02',	'2020-12-31 21:55:02'),
(1317,	'admin',	'Rajib',	'Medication : Paracetamol 22:35:00',	1,	'2020-12-31 22:30:01',	'2020-12-31 22:30:01',	'2020-12-31 22:30:01'),
(1318,	'admin',	'Rajib',	'Medication : antibiotic 10:00:00',	1,	'2021-01-01 09:55:01',	'2021-01-01 09:55:01',	'2021-01-01 09:55:01'),
(1319,	'admin',	'Rajib',	'Medication : Paracetamol 10:00:00',	1,	'2021-01-01 09:55:01',	'2021-01-01 09:55:01',	'2021-01-01 09:55:01'),
(1320,	'admin',	'Rajib',	'Medication : antibiotic 20:00:00',	1,	'2021-01-01 19:55:02',	'2021-01-01 19:55:02',	'2021-01-01 19:55:02'),
(1321,	'admin',	'Rajib',	'Medication : Vitamin C 22:00:00',	1,	'2021-01-01 21:55:02',	'2021-01-01 21:55:02',	'2021-01-01 21:55:02'),
(1322,	'admin',	'Rajib',	'Medication : antibiotic 10:00:00',	1,	'2021-01-02 09:55:01',	'2021-01-02 09:55:01',	'2021-01-02 09:55:01');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `reminder_configs`;
CREATE TABLE `reminder_configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `minutes` int(11) NOT NULL,
  `active` int(11) DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `reminder_configs` (`id`, `minutes`, `active`, `sign_date`, `created_at`, `updated_at`) VALUES
(2,	5,	1,	'2020-11-01 01:23:03',	'2020-10-31 16:23:03',	'2020-12-28 22:07:05'),
(3,	15,	NULL,	'2020-11-01 01:23:16',	'2020-10-31 16:23:16',	'2020-11-25 05:32:19'),
(4,	30,	NULL,	'2020-11-01 01:23:22',	'2020-10-31 16:23:22',	'2020-10-31 16:23:22');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'2020-10-26 04:45:49',	'2020-10-26 04:45:49'),
(2,	'care taker',	'2020-10-26 04:45:49',	'2020-10-26 04:45:49'),
(3,	'resident',	'2020-10-26 04:45:49',	'2020-10-26 04:45:49');

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	'2020-10-26 04:45:49',	'2020-10-26 04:45:49'),
(2,	2,	3,	'2020-10-25 22:10:41',	'2020-10-25 22:10:41'),
(3,	3,	2,	'2020-10-27 14:12:19',	'2020-10-27 14:12:19'),
(4,	4,	3,	'2020-10-31 03:42:24',	'2020-10-31 03:42:24'),
(5,	5,	2,	'2020-11-15 23:02:28',	'2020-11-15 23:02:28'),
(6,	6,	2,	'2020-11-25 06:03:31',	'2020-11-25 06:03:31'),
(7,	7,	3,	'2020-11-25 06:35:56',	'2020-11-25 06:35:56'),
(8,	8,	2,	'2020-11-26 03:38:14',	'2020-11-26 03:38:14'),
(9,	10,	2,	'2020-11-26 04:28:40',	'2020-11-26 04:28:40'),
(10,	11,	2,	'2020-11-26 04:30:12',	'2020-11-26 04:30:12'),
(11,	12,	2,	'2020-11-26 04:32:15',	'2020-11-26 04:32:15'),
(12,	19,	2,	'2020-11-26 04:51:57',	'2020-11-26 04:51:57'),
(13,	20,	3,	'2020-11-26 07:41:06',	'2020-11-26 07:41:06'),
(14,	21,	3,	'2020-11-28 00:51:30',	'2020-11-28 00:51:30'),
(15,	22,	3,	'2020-11-30 21:27:28',	'2020-11-30 21:27:28'),
(16,	23,	2,	'2020-12-10 11:09:46',	'2020-12-10 11:09:46'),
(17,	24,	2,	'2020-12-22 23:55:58',	'2020-12-22 23:55:58'),
(18,	25,	3,	'2020-12-23 00:05:03',	'2020-12-23 00:05:03');

DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `routes` (`id`, `name`, `sign_date`, `created_at`, `updated_at`) VALUES
(2,	'Mouth',	'2020-11-25 05:30:28',	'2020-11-25 05:30:28',	'2020-11-30 21:38:59'),
(3,	'Nasal',	'2020-11-25 06:11:05',	'2020-11-25 06:11:05',	'2020-11-30 21:39:09'),
(4,	'Drops',	'2020-11-25 06:11:14',	'2020-11-25 06:11:14',	'2020-11-30 21:39:17'),
(5,	'test',	'2020-11-25 06:11:24',	'2020-11-25 06:11:24',	'2020-11-25 06:11:24'),
(6,	'testt',	'2020-11-25 06:11:31',	'2020-11-25 06:11:31',	'2020-11-25 06:11:31'),
(7,	'test',	'2020-11-25 06:11:41',	'2020-11-25 06:11:41',	'2020-11-25 06:11:41'),
(8,	'test',	'2020-11-25 06:11:49',	'2020-11-25 06:11:49',	'2020-11-25 06:11:49'),
(9,	'test',	'2020-11-25 06:11:58',	'2020-11-25 06:11:58',	'2020-11-25 06:11:58'),
(10,	'test',	'2020-11-25 06:12:04',	'2020-11-25 06:12:04',	'2020-11-25 06:12:04'),
(11,	'test',	'2020-11-25 06:12:15',	'2020-11-25 06:12:15',	'2020-11-25 06:12:15'),
(12,	'test',	'2020-11-25 06:12:23',	'2020-11-25 06:12:23',	'2020-11-25 06:12:23');

DROP TABLE IF EXISTS `switch_reminder`;
CREATE TABLE `switch_reminder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `set_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tfg`;
CREATE TABLE `tfg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `medications` int(10) unsigned NOT NULL,
  `time` time NOT NULL,
  `resident` int(10) unsigned NOT NULL,
  `comment` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tfg_medications_foreign` (`medications`),
  KEY `tfg_resident_foreign` (`resident`),
  CONSTRAINT `tfg_medications_foreign` FOREIGN KEY (`medications`) REFERENCES `medications` (`id`),
  CONSTRAINT `tfg_resident_foreign` FOREIGN KEY (`resident`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tfg` (`id`, `medications`, `time`, `resident`, `comment`, `file`, `status`, `sign_date`, `created_at`, `updated_at`) VALUES
(12,	3,	'22:00:00',	25,	'SOS',	NULL,	1,	'2020-12-23 01:32:31',	'2020-12-23 01:32:31',	'2020-12-23 01:32:31'),
(13,	9,	'06:12:00',	25,	NULL,	NULL,	1,	'2020-12-30 22:14:47',	'2020-12-30 22:14:47',	'2020-12-30 22:14:47');

DROP TABLE IF EXISTS `useractivity_reports`;
CREATE TABLE `useractivity_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assign_id` int(10) unsigned NOT NULL,
  `resident` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `comment` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `useractivity_reports_assign_id_foreign` (`assign_id`),
  KEY `useractivity_reports_resident_foreign` (`resident`),
  KEY `useractivity_reports_user_foreign` (`user`),
  CONSTRAINT `useractivity_reports_assign_id_foreign` FOREIGN KEY (`assign_id`) REFERENCES `user_activities` (`id`),
  CONSTRAINT `useractivity_reports_resident_foreign` FOREIGN KEY (`resident`) REFERENCES `users` (`id`),
  CONSTRAINT `useractivity_reports_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_logo` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `username`, `email`, `gender`, `birthday`, `address`, `profile_logo`, `email_verified_at`, `password`, `phone_number`, `sign_date`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'admin',	'admin@gmail.com',	0,	'1999-10-29',	'Serbia Beograd',	'1.png',	1,	'$2y$10$43Lgdx7qDxGdj3cDyfcw4uLj5nVQ6vsQ3obexrb/axByYf4B6roZO',	'029292162',	'2020-10-26 01:10:49',	'o7S99g4zXaT1oZmtfNuT8HsJdgMe32HRnFe5n9NVhmtsJk2cYb1iKXBnR2Ej',	'2020-10-26 04:45:49',	'2020-10-26 04:45:49'),
(3,	'jovn',	'jovn',	'jovn@gmail.com',	NULL,	NULL,	NULL,	'tUGdJ06TaYIJugJ2IeVqK9DWA9lcklg7PR7F3gkw.jpeg',	NULL,	'$2y$10$qfUtvUhNafKcQd/SxZxjfulcFp/Qm8iQofVg4EEl7fixGOvFZeL2O',	'123123',	'2020-10-27 23:12:18',	'P8V6gG8hK3ci0ZmAk7Ex7t9YjU5JnVJgVWAQQTY5spFMOB4jucjHZ4D80XXq',	'2020-10-27 14:12:19',	'2020-12-01 06:05:35'),
(5,	'Aman',	'Aman',	'amanelsa@yahoo.com',	NULL,	NULL,	NULL,	'OSHTnp2ePRno2csxGec06KODpN9HJTgOCl7JovFg.jpeg',	NULL,	'$2y$10$MV9bcqnsGnBfqVR/gdTqWOWCYt4tPh3sviBXZwUUCTttp5p9SQMdO',	'2068329507',	'2020-11-15 23:02:28',	'AlfsDxR7nK2Y9FeoO9vYSwQdpqQFwrJNgYfm270pn6rmMf9e6vFV32PTnpkD',	'2020-11-15 23:02:28',	'2020-11-15 23:02:28'),
(19,	'joy das',	'dibdey',	'dibdey@codeulas.com',	NULL,	NULL,	NULL,	'uyagOe4rnoYBROKx78XzB843FDhMaoQj4Nn2nHvx.png',	NULL,	'$2y$10$5ginLQFgeqnb/Lu.EDg3deg8iz53Td0Ftrzd1EM1f1l2EeT3WBNJe',	'8918747412',	'2020-11-26 04:51:57',	NULL,	'2020-11-26 04:51:57',	'2020-11-28 11:53:15'),
(23,	'TOMMY',	'TOMTOM',	'temesgen98@gmail.com',	NULL,	NULL,	NULL,	'YJyfs2OxnGVftr6rTf4YqSmvICi8W0nRYpT8v9Yz.jpeg',	NULL,	'$2y$10$TajwpmM5IhNjrSFmTtCzmeYE4.zflr8F/.l99at1YInaZQ3CJsBmS',	'6786681553',	'2020-12-10 11:09:46',	NULL,	'2020-12-10 11:09:46',	'2020-12-10 11:09:46'),
(24,	'Sumanta',	'sumanta',	'sumanta@codeulas.com',	NULL,	NULL,	NULL,	'PBZUHB4AsvPS1OvpQqGxlvPCbQDJY8sA7vBiXQJJ.jpeg',	NULL,	'$2y$10$6F8ARY9sdIhuTTWE52rYuupQ9AXIeNi55cjqo3fvLA/QOTNMZJLvu',	'8101731846',	'2020-12-22 23:55:57',	NULL,	'2020-12-22 23:55:58',	'2020-12-22 23:55:58'),
(25,	'Rajib',	NULL,	'rajib@codeulas.com',	0,	'1950-06-13',	'UAE',	'K79AV29PFXfHm9vB0QYsHfnjkB9upMFaB0sTyXYb.jpeg',	NULL,	'',	'8101731846',	'2020-12-23 00:05:03',	NULL,	'2020-12-23 00:05:03',	'2020-12-27 05:06:32');

DROP TABLE IF EXISTS `user_activities`;
CREATE TABLE `user_activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activities` int(10) unsigned NOT NULL,
  `time` time DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `resident` int(10) unsigned NOT NULL,
  `type` int(11) NOT NULL,
  `comment` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_comment` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `start_day` date NOT NULL,
  `end_day` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_activities_activities_foreign` (`activities`),
  KEY `user_activities_resident_foreign` (`resident`),
  CONSTRAINT `user_activities_activities_foreign` FOREIGN KEY (`activities`) REFERENCES `activities` (`id`),
  CONSTRAINT `user_activities_resident_foreign` FOREIGN KEY (`resident`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_activities` (`id`, `activities`, `time`, `day`, `resident`, `type`, `comment`, `other_comment`, `file`, `status`, `sign_date`, `start_day`, `end_day`, `created_at`, `updated_at`) VALUES
(118,	4,	'08:00:00',	NULL,	25,	1,	'23',	NULL,	NULL,	1,	'2020-12-26 06:13:22',	'2020-12-23',	'2020-12-28',	'2020-12-26 06:13:22',	'2020-12-26 06:13:22');

DROP TABLE IF EXISTS `user_medications`;
CREATE TABLE `user_medications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assign_id` int(10) unsigned NOT NULL,
  `resident` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `comment` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_medications_assign_id_foreign` (`assign_id`),
  KEY `user_medications_resident_foreign` (`resident`),
  KEY `user_medications_user_foreign` (`user`),
  CONSTRAINT `user_medications_assign_id_foreign` FOREIGN KEY (`assign_id`) REFERENCES `assign_medications` (`id`),
  CONSTRAINT `user_medications_resident_foreign` FOREIGN KEY (`resident`) REFERENCES `users` (`id`),
  CONSTRAINT `user_medications_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_medications` (`id`, `assign_id`, `resident`, `user`, `comment`, `sign_date`, `created_at`, `updated_at`) VALUES
(27,	19,	25,	1,	NULL,	'2020-12-23 01:29:31',	'2020-12-23 01:29:31',	'2020-12-23 01:29:31'),
(28,	25,	25,	1,	NULL,	'2020-12-30 22:17:09',	'2020-12-30 22:17:09',	'2020-12-30 22:17:09'),
(29,	21,	25,	1,	NULL,	'2020-12-30 22:17:16',	'2020-12-30 22:17:16',	'2020-12-30 22:17:16'),
(30,	22,	25,	1,	NULL,	'2020-12-30 22:17:20',	'2020-12-30 22:17:20',	'2020-12-30 22:17:20'),
(31,	20,	25,	1,	NULL,	'2020-12-30 22:17:25',	'2020-12-30 22:17:25',	'2020-12-30 22:17:25'),
(32,	23,	25,	1,	NULL,	'2020-12-30 22:17:29',	'2020-12-30 22:17:29',	'2020-12-30 22:17:29'),
(33,	18,	25,	1,	NULL,	'2020-12-30 22:17:33',	'2020-12-30 22:17:33',	'2020-12-30 22:17:33'),
(34,	24,	25,	1,	NULL,	'2020-12-30 22:17:37',	'2020-12-30 22:17:37',	'2020-12-30 22:17:37');

DROP TABLE IF EXISTS `vital_sign`;
CREATE TABLE `vital_sign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL,
  `resident_id` int(10) unsigned NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vital_sign_resident_id_foreign` (`resident_id`),
  CONSTRAINT `vital_sign_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `vital_sign` (`id`, `data`, `type`, `resident_id`, `sign_date`, `created_at`, `updated_at`) VALUES
(7,	'120/90',	2,	25,	'2020-12-23 23:04:15',	'2020-12-23 23:04:15',	'2020-12-23 23:04:15'),
(8,	'100',	3,	25,	'2020-12-23 23:04:15',	'2020-12-23 23:04:15',	'2020-12-23 23:04:15'),
(9,	'1212',	1,	25,	'2020-12-30 22:19:24',	'2020-12-30 22:19:24',	'2020-12-30 22:19:24'),
(10,	'190/87',	2,	25,	'2020-12-30 22:19:24',	'2020-12-30 22:19:24',	'2020-12-30 22:19:24'),
(11,	'76',	3,	25,	'2020-12-30 22:19:24',	'2020-12-30 22:19:24',	'2020-12-30 22:19:24');

-- 2021-01-03 01:48:06
