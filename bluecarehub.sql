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
  `clinic_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `comments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `admin_logs`;
CREATE TABLE `admin_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `caretakerId` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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


DROP TABLE IF EXISTS `body_harm_comments`;
CREATE TABLE `body_harm_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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


DROP TABLE IF EXISTS `facilities`;
CREATE TABLE `facilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clinic_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `facilities` (`id`, `clinic_name`, `clinic_id`, `sign_date`, `created_at`, `updated_at`) VALUES
(1,	'Texas\'s clinic',	2,	'2021-07-28 09:52:18',	'2021-07-28 09:52:18',	'2021-07-28 09:52:18');

DROP TABLE IF EXISTS `family_visits`;
CREATE TABLE `family_visits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resident` int(11) NOT NULL,
  `relation` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `fields`;
CREATE TABLE `fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fieldName` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `tab_id` int(11) NOT NULL,
  `sign_date_field` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `field_types`;
CREATE TABLE `field_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typeName` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fieldID` int(11) NOT NULL,
  `sign_date_field_type` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `general_settings`;
CREATE TABLE `general_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_desc` text COLLATE utf8mb4_unicode_ci,
  `site_footer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `general_settings` (`id`, `site_name`, `site_title`, `site_subtitle`, `site_desc`, `site_footer`, `created_at`, `updated_at`) VALUES
(1,	'Blue Care Hub',	'Mambo Dubai Multivendor Marketplace',	'Your Awesome Marketplace',	'Buy . Sell . Admin',	'© Copyright 2020 - City of UAE Dubai. All rights reserved.',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59');

DROP TABLE IF EXISTS `health_care_centers`;
CREATE TABLE `health_care_centers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `health_care_center_type` int(11) NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `health_care_center_types`;
CREATE TABLE `health_care_center_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `incidences`;
CREATE TABLE `incidences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_id` int(11) NOT NULL,
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
(1,	'aed',	'AED',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59');

DROP TABLE IF EXISTS `medications`;
CREATE TABLE `medications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dose` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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
(24,	'2021_01_06_053159_create_resident_information_table',	1),
(25,	'2021_05_12_162412_create_reports_table',	1),
(26,	'2021_06_17_084646_create_setting_tabs_table',	1),
(27,	'2021_06_17_091855_create_fields_table',	1),
(28,	'2021_06_17_091910_create_field_types_table',	1),
(29,	'2021_07_14_072300_create_resident_settings_table',	1),
(30,	'2021_07_20_113151_create_family_visits_table',	1),
(31,	'2021_07_20_122050_create_mood_changes_table',	1),
(32,	'2021_07_20_122618_create_moods_table',	1),
(33,	'2021_07_20_122844_create_relations_table',	1),
(34,	'2021_07_22_123105_create_representatives_table',	1),
(35,	'2021_07_22_123409_create_representative_types_table',	1),
(36,	'2021_07_22_123449_create_health_care_center_types_table',	1),
(37,	'2021_07_22_123503_create_health_care_centers_table',	1),
(38,	'2021_07_24_170131_create_facilities_table',	1);

DROP TABLE IF EXISTS `moods`;
CREATE TABLE `moods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `mood_changes`;
CREATE TABLE `mood_changes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resident` int(11) NOT NULL,
  `mood` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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


DROP TABLE IF EXISTS `relations`;
CREATE TABLE `relations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `reminder_configs`;
CREATE TABLE `reminder_configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `active` int(11) DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `resident_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `representatives`;
CREATE TABLE `representatives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `representative_type` int(11) NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cell_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `representative_types`;
CREATE TABLE `representative_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `resident_information`;
CREATE TABLE `resident_information` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_admitted` date DEFAULT NULL,
  `ssn` text COLLATE utf8mb4_unicode_ci,
  `primary_language` text COLLATE utf8mb4_unicode_ci,
  `signDate` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `resident_information` (`id`, `user_id`, `date_admitted`, `ssn`, `primary_language`, `signDate`, `created_at`, `updated_at`) VALUES
(1,	3,	NULL,	NULL,	NULL,	'2021-07-28 02:56:38',	'2021-07-28 02:56:38',	'2021-07-28 02:56:38');

DROP TABLE IF EXISTS `resident_settings`;
CREATE TABLE `resident_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fieldVal` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59'),
(2,	'care taker',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59'),
(3,	'resident',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59'),
(4,	'clinicowner',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59');

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
(1,	1,	1,	'2021-07-28 09:44:59',	'2021-07-28 09:44:59'),
(2,	2,	4,	'2021-07-28 09:52:18',	'2021-07-28 09:52:18'),
(3,	3,	3,	'2021-07-28 02:56:38',	'2021-07-28 02:56:38');

DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `setting_tabs`;
CREATE TABLE `setting_tabs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `setting_tabs` (`id`, `name`, `sign_date`, `created_at`, `updated_at`) VALUES
(1,	'Health Base Line',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59'),
(2,	'Allergies and Diet',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59'),
(3,	'Advance Directive',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59');

DROP TABLE IF EXISTS `switch_reminder`;
CREATE TABLE `switch_reminder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) NOT NULL,
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
  `street1` text COLLATE utf8mb4_unicode_ci,
  `street2` text COLLATE utf8mb4_unicode_ci,
  `city` text COLLATE utf8mb4_unicode_ci,
  `zip_code` text COLLATE utf8mb4_unicode_ci,
  `state` text COLLATE utf8mb4_unicode_ci,
  `clinic_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `profile_logo` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `email`, `gender`, `birthday`, `street1`, `street2`, `city`, `zip_code`, `state`, `clinic_id`, `status`, `profile_logo`, `email_verified_at`, `password`, `phone_number`, `sign_date`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'Admin',	'Admin',	'admin',	'admin@gmail.com',	0,	'1999-10-29',	'Serbia',	'Beograd',	'Beograd',	'11042',	'Beograd',	0,	NULL,	'1.png',	1,	'$2y$10$43Lgdx7qDxGdj3cDyfcw4uLj5nVQ6vsQ3obexrb/axByYf4B6roZO',	'029292162',	'2021-07-28 09:07:59',	'KpMRELOlWw',	'2021-07-28 09:44:59',	'2021-07-28 09:44:59'),
(2,	'Nemanja',	NULL,	'Jovanovic',	'nemanja',	'jovanovic.nemanja.1029@gmail.com',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'nVxfBYpXKWo7xoTl0sVtQ4h6280XvWBlNSOo4Y9E.png',	NULL,	'$2y$10$xXLkilia4ctV95oixr6UbuPb4fLhdt.Wjc7.B.MuTOTIgo7YJjwNS',	'+381621115827',	'2021-07-28 09:52:18',	'E3JWkg4QXarVCudgU8eA1T79XMcT3xq2ovXHNwSn31lySbflIB3xxq2Ak7PB',	'2021-07-28 09:52:18',	'2021-07-28 09:52:50'),
(3,	'Nina',	NULL,	'Natalija',	NULL,	'nina@natalija.com',	1,	'1999-09-12',	'VOŽDOVAC SLOBODANA JOVIĆA 3V',	NULL,	'BEOGRAD',	'11042',	'BEOGRAD',	2,	NULL,	'resident_610129d65ab1d.png',	NULL,	NULL,	'+381066666',	'2021-07-28 02:56:38',	NULL,	'2021-07-28 02:56:38',	'2021-07-28 02:56:38');

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


-- 2021-07-28 11:40:22
