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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `activities` (`id`, `title`, `type`, `comments`, `sign_date`, `created_at`, `updated_at`) VALUES
(1,	'Walking at dawn',	1,	'walking,dawn,health',	'2021-01-15 10:59:54',	'2021-01-15 10:59:54',	'2021-01-15 10:59:54'),
(2,	'Listening music',	1,	'music,listening,ear,health',	'2021-01-15 11:00:52',	'2021-01-15 11:00:52',	'2021-01-15 11:00:52'),
(3,	'Talking',	2,	'talking,memory',	'2021-01-15 11:02:27',	'2021-01-15 11:02:27',	'2021-01-15 11:02:27');

DROP TABLE IF EXISTS `admin_logs`;
CREATE TABLE `admin_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caretakerId` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_logs` (`id`, `content`, `caretakerId`, `sign_date`, `created_at`, `updated_at`) VALUES
(1,	'Admin gave Listening music(17:20:00) to Alex',	1,	'2021-01-15 11:13:14',	'2021-01-15 11:13:14',	'2021-01-15 11:13:14');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `assign_medications` (`id`, `medications`, `dose`, `resident`, `route`, `sign_date`, `time`, `start_day`, `end_day`, `created_at`, `updated_at`) VALUES
(1,	1,	3,	2,	NULL,	'2021-01-15 11:08:36',	'08:30:00',	'2021-01-05',	'2021-01-26',	'2021-01-15 11:08:36',	'2021-01-15 11:08:36'),
(2,	1,	3,	2,	NULL,	'2021-01-15 11:08:36',	'14:30:00',	'2021-01-05',	'2021-01-26',	'2021-01-15 11:08:36',	'2021-01-15 11:08:36'),
(3,	1,	3,	2,	NULL,	'2021-01-15 11:08:36',	'20:30:00',	'2021-01-05',	'2021-01-26',	'2021-01-15 11:08:36',	'2021-01-15 11:08:36');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `body_harms` (`id`, `resident`, `sign_date`, `comment`, `screenshot_3d`, `created_at`, `updated_at`) VALUES
(1,	2,	'2021-01-17 01:03:19',	2,	'screenshot_6003fd57b6da8.png',	'2021-01-17 01:03:19',	'2021-01-17 01:03:19'),
(2,	2,	'2021-01-18 02:24:16',	1,	'screenshot_600561d0ac295.png',	'2021-01-18 02:24:16',	'2021-01-18 02:24:16');

DROP TABLE IF EXISTS `body_harm_comments`;
CREATE TABLE `body_harm_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `body_harm_comments` (`id`, `name`, `sign_date`, `created_at`, `updated_at`) VALUES
(1,	'Blood',	'2021-01-15 11:04:26',	'2021-01-15 11:04:26',	'2021-01-15 11:04:26'),
(2,	'break',	'2021-01-15 11:04:34',	'2021-01-15 11:04:34',	'2021-01-15 11:04:34');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `comments` (`id`, `type`, `name`, `ref_id`, `sign_date`, `created_at`, `updated_at`) VALUES
(1,	1,	'walking',	1,	'2021-01-15 10:59:54',	'2021-01-15 10:59:54',	'2021-01-15 10:59:54'),
(2,	1,	'dawn',	1,	'2021-01-15 10:59:54',	'2021-01-15 10:59:54',	'2021-01-15 10:59:54'),
(3,	1,	'health',	1,	'2021-01-15 10:59:54',	'2021-01-15 10:59:54',	'2021-01-15 10:59:54'),
(4,	1,	'music',	2,	'2021-01-15 11:00:52',	'2021-01-15 11:00:52',	'2021-01-15 11:00:52'),
(5,	1,	'listening',	2,	'2021-01-15 11:00:52',	'2021-01-15 11:00:52',	'2021-01-15 11:00:52'),
(6,	1,	'ear',	2,	'2021-01-15 11:00:52',	'2021-01-15 11:00:52',	'2021-01-15 11:00:52'),
(7,	1,	'health',	2,	'2021-01-15 11:00:52',	'2021-01-15 11:00:52',	'2021-01-15 11:00:52'),
(8,	1,	'talking',	3,	'2021-01-15 11:02:27',	'2021-01-15 11:02:27',	'2021-01-15 11:02:27'),
(9,	1,	'memory',	3,	'2021-01-15 11:02:27',	'2021-01-15 11:02:27',	'2021-01-15 11:02:27'),
(10,	2,	'medicine',	1,	'2021-01-15 11:03:21',	'2021-01-15 11:03:21',	'2021-01-15 11:03:21'),
(11,	2,	'aspirin',	1,	'2021-01-15 11:03:21',	'2021-01-15 11:03:21',	'2021-01-15 11:03:21'),
(12,	2,	'medicine',	2,	'2021-01-15 11:04:03',	'2021-01-15 11:04:03',	'2021-01-15 11:04:03'),
(13,	2,	'paracetamol',	2,	'2021-01-15 11:04:03',	'2021-01-15 11:04:03',	'2021-01-15 11:04:03'),
(14,	2,	'health',	2,	'2021-01-15 11:04:03',	'2021-01-15 11:04:03',	'2021-01-15 11:04:03');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `general_settings` (`id`, `site_name`, `site_title`, `site_subtitle`, `site_desc`, `site_footer`, `created_at`, `updated_at`) VALUES
(1,	'Blue Care Hub',	'Blue Care Hub',	'Your Awesome Marketplace',	'Blue Care Hub',	'© Copyright 2020 - City of UAE Dubai. All rights reserved.',	'2021-01-15 07:12:15',	'2021-01-15 19:13:41');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `localization_settings`;
CREATE TABLE `localization_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `localization_settings` (`id`, `language`, `currency`, `created_at`, `updated_at`) VALUES
(1,	'aed',	'AED',	'2021-01-15 07:12:15',	'2021-01-15 07:12:15');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `medications` (`id`, `name`, `dose`, `photo`, `comments`, `sign_date`, `created_at`, `updated_at`) VALUES
(1,	'Aspirin',	'3',	'51o7qujNkBhuYoPgqyJKI8Gogp2fBqu20aaCov1M.jpeg',	'medicine,aspirin',	'2021-01-15 11:03:21',	'2021-01-15 11:03:21',	'2021-01-15 11:03:21'),
(2,	'Paracetamol',	'3',	'Z3HkjC1iZdbHtqyPF35AzLSPuLmJ1nCkAU85kE3O.jpeg',	'medicine,paracetamol,health',	'2021-01-15 11:04:03',	'2021-01-15 11:04:03',	'2021-01-15 11:04:03');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(15,	'2020_10_28_174414_create_body_harm_comments',	1),
(16,	'2020_10_29_085636_create_body_harm_tables',	1),
(17,	'2020_10_30_193646_create_notifications_table',	1),
(18,	'2020_11_01_090009_create_reminder_configs_table',	1),
(19,	'2020_11_09_081058_create_routes_table',	1),
(20,	'2020_11_10_072908_create_admin_logs_table',	1),
(21,	'2020_11_11_151249_create_useractivity_reports_table',	1),
(22,	'2020_12_21_084818_create_switch_reminder_table',	1),
(23,	'2020_12_23_093009_create_vital_sign_table',	1),
(24,	'2021_01_06_053159_create_resident_information_table',	1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `reminder_configs` (`id`, `minutes`, `active`, `sign_date`, `created_at`, `updated_at`) VALUES
(1,	5,	NULL,	'2021-01-16 04:11:10',	'2021-01-16 04:11:10',	'2021-01-16 04:11:10');

DROP TABLE IF EXISTS `resident_information`;
CREATE TABLE `resident_information` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_admitted` date DEFAULT NULL,
  `ssn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_language` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `representing_party_firstname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `representing_party_lastname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `representing_party_street1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `representing_party_street2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `representing_party_city` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `representing_party_zip_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `representing_party_state` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `representing_party_home_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `representing_party_cell_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_representative_firstname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_representative_lastname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_representative_street1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_representative_street2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_representative_city` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_representative_zip_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_representative_state` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_representative_home_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_representative_cell_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physician_or_medical_group_firstname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physician_or_medical_group_lastname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physician_or_medical_group_street1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physician_or_medical_group_street2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physician_or_medical_group_city` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physician_or_medical_group_zip_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physician_or_medical_group_state` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physician_or_medical_group_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physician_or_medical_group_fax` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pharmacy_firstname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pharmacy_lastname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pharmacy_street1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pharmacy_street2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pharmacy_city` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pharmacy_zip_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pharmacy_state` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pharmacy_home_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pharmacy_fax` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dentist_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dentist_street1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dentist_street2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dentist_city` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dentist_zip_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dentist_state` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dentist_home_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dentist_fax` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advance_directive` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `polst` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alergies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signDate` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `resident_information` (`id`, `date_admitted`, `ssn`, `primary_language`, `representing_party_firstname`, `representing_party_lastname`, `representing_party_street1`, `representing_party_street2`, `representing_party_city`, `representing_party_zip_code`, `representing_party_state`, `representing_party_home_phone`, `representing_party_cell_phone`, `secondary_representative_firstname`, `secondary_representative_lastname`, `secondary_representative_street1`, `secondary_representative_street2`, `secondary_representative_city`, `secondary_representative_zip_code`, `secondary_representative_state`, `secondary_representative_home_phone`, `secondary_representative_cell_phone`, `physician_or_medical_group_firstname`, `physician_or_medical_group_lastname`, `physician_or_medical_group_street1`, `physician_or_medical_group_street2`, `physician_or_medical_group_city`, `physician_or_medical_group_zip_code`, `physician_or_medical_group_state`, `physician_or_medical_group_phone`, `physician_or_medical_group_fax`, `pharmacy_firstname`, `pharmacy_lastname`, `pharmacy_street1`, `pharmacy_street2`, `pharmacy_city`, `pharmacy_zip_code`, `pharmacy_state`, `pharmacy_home_phone`, `pharmacy_fax`, `dentist_name`, `dentist_street1`, `dentist_street2`, `dentist_city`, `dentist_zip_code`, `dentist_state`, `dentist_home_phone`, `dentist_fax`, `advance_directive`, `polst`, `alergies`, `signDate`, `created_at`, `updated_at`) VALUES
(1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2021-01-15 11:06:56',	'2021-01-15 11:06:56',	'2021-01-15 11:06:56');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'2021-01-15 07:12:15',	'2021-01-15 07:12:15'),
(2,	'care taker',	'2021-01-15 07:12:15',	'2021-01-15 07:12:15'),
(3,	'resident',	'2021-01-15 07:12:15',	'2021-01-15 07:12:15');

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	'2021-01-15 07:12:15',	'2021-01-15 07:12:15'),
(2,	2,	3,	'2021-01-15 11:06:56',	'2021-01-15 11:06:56'),
(3,	3,	2,	'2021-01-15 11:16:12',	'2021-01-15 11:16:12');

DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `useractivity_reports` (`id`, `assign_id`, `resident`, `user`, `comment`, `sign_date`, `created_at`, `updated_at`) VALUES
(1,	1,	2,	1,	NULL,	'2021-01-15 11:13:14',	'2021-01-15 11:13:14',	'2021-01-15 11:13:14');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `street1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `email`, `gender`, `birthday`, `street1`, `street2`, `city`, `zip_code`, `state`, `profile_logo`, `email_verified_at`, `password`, `phone_number`, `sign_date`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'Admin',	'Admin',	'admin',	'admin@gmail.com',	0,	'1999-10-29',	'Serbia',	'Beograd',	'Beograd',	'11042',	'Beograd',	'1.png',	1,	'$2y$10$43Lgdx7qDxGdj3cDyfcw4uLj5nVQ6vsQ3obexrb/axByYf4B6roZO',	'029292162',	'2021-01-15 04:01:15',	'xj9wnXhuerHdIYrPZ2xgEfkDvHarF0PEDz614C3S6lbgrcadh5xO9jtX82Np',	'2021-01-15 07:12:15',	'2021-01-15 07:12:15'),
(2,	'Alex',	'G',	'GG',	NULL,	'alex@gg.com',	0,	'2021-01-13',	'Beograd',	NULL,	'Beograd',	'12039',	'Beograd',	'N01V4sjotsU4rQCfp9LnjwsYrubgSU3l9WzBym7A.jpeg',	NULL,	'',	'123',	'2021-01-15 11:06:56',	NULL,	'2021-01-15 11:06:56',	'2021-01-15 11:06:56'),
(3,	'Anastasia',	NULL,	'L',	'anastasia',	'anastasia-owera@yandex.com',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'jaIvmftP2Fs2LkMRfqxdwdvE1yXwohvdHTF8ADIE.jpeg',	NULL,	'$2y$10$y1Ehnznd5ecHswWp7DQ2NuDbL/5m3cu9wEA1GOdBQMx0JirT820jC',	'12123',	'2021-01-15 11:16:12',	'jE0zwBCayhvhZoVdyoYgUGm4vS8YYdpM7VgPV1VTWSXhmounR0tZjSofwAmV',	'2021-01-15 11:16:12',	'2021-01-15 11:16:12');

DROP TABLE IF EXISTS `user_activities`;
CREATE TABLE `user_activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activities` int(10) unsigned NOT NULL,
  `type` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `resident` int(10) unsigned NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_activities` (`id`, `activities`, `type`, `time`, `day`, `resident`, `comment`, `other_comment`, `file`, `status`, `sign_date`, `start_day`, `end_day`, `created_at`, `updated_at`) VALUES
(1,	2,	1,	'17:20:00',	NULL,	2,	'4',	NULL,	NULL,	1,	'2021-01-15 11:13:07',	'2021-01-15',	'2021-01-29',	'2021-01-15 11:13:07',	'2021-01-15 11:13:07');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `vital_sign` (`id`, `data`, `type`, `resident_id`, `sign_date`, `created_at`, `updated_at`) VALUES
(1,	'120',	1,	2,	'2021-01-15 11:07:21',	'2021-01-15 11:07:21',	'2021-01-15 11:07:21'),
(2,	'120/80',	2,	2,	'2021-01-15 11:07:21',	'2021-01-15 11:07:21',	'2021-01-15 11:07:21'),
(3,	'90',	3,	2,	'2021-01-15 11:07:21',	'2021-01-15 11:07:21',	'2021-01-15 11:07:21');

-- 2021-01-21 11:40:58
