-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2021 at 10:11 PM
-- Server version: 5.7.34-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bluecarehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `comments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title`, `type`, `comments`, `sign_date`, `created_at`, `updated_at`) VALUES
(1, 'Walking at dawn', 1, 'walking,dawn,health', '2021-01-15 10:59:54', '2021-01-15 10:59:54', '2021-01-15 10:59:54'),
(2, 'Listening music', 1, 'music,listening,ear,health', '2021-01-15 11:00:52', '2021-01-15 11:00:52', '2021-01-15 11:00:52'),
(3, 'Talking', 2, 'talking,memory', '2021-01-15 11:02:27', '2021-01-15 11:02:27', '2021-01-15 11:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caretakerId` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_logs`
--

INSERT INTO `admin_logs` (`id`, `content`, `caretakerId`, `sign_date`, `created_at`, `updated_at`) VALUES
(3, 'Admin gave Aspirin(08:30:00) to Alex', 1, '2021-04-19 09:21:28', '2021-04-19 09:21:28', '2021-04-19 09:21:28'),
(4, 'Admin gave Aspirin(20:30:00) to Alex', 1, '2021-04-19 09:21:38', '2021-04-19 09:21:38', '2021-04-19 09:21:38'),
(5, 'Admin gave Paracetamol(12:00:00) to Sumanta', 1, '2021-05-14 00:01:18', '2021-05-14 00:01:18', '2021-05-14 00:01:18'),
(6, 'Admin gave Paracetamol(07:17) to Sumanta', 1, '2021-05-14 00:20:10', '2021-05-14 00:20:10', '2021-05-14 00:20:10'),
(7, 'Admin gave Walking at dawn(06:00:00) to Sumanta', 1, '2021-05-14 01:05:08', '2021-05-14 01:05:08', '2021-05-14 01:05:08'),
(8, 'Admin gave Walking at dawn(06:00:00) to Sumanta', 1, '2021-05-14 01:08:33', '2021-05-14 01:08:33', '2021-05-14 01:08:33'),
(9, 'Admin gave Talking(10:30:00) to Sumanta', 1, '2021-05-14 01:26:02', '2021-05-14 01:26:02', '2021-05-14 01:26:02'),
(10, 'Admin gave Paracetamol(20:30) to Sumanta', 1, '2021-05-14 12:49:25', '2021-05-14 12:49:25', '2021-05-14 12:49:25'),
(11, 'Anastasia gave Walking at dawn(06:00:00) to Sumanta', 3, '2021-05-15 12:04:17', '2021-05-15 12:04:17', '2021-05-15 12:04:17'),
(12, 'Anastasia gave Talking(10:30:00) to Sumanta', 3, '2021-05-15 12:04:23', '2021-05-15 12:04:23', '2021-05-15 12:04:23'),
(13, 'Admin gave Paracetamol(09:30:00) to Alex', 1, '2021-05-16 15:46:24', '2021-05-16 15:46:24', '2021-05-16 15:46:24'),
(14, 'Admin gave Aspirin(18:09) to Sumanta', 1, '2021-05-23 11:10:44', '2021-05-23 11:10:44', '2021-05-23 11:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `assign_medications`
--

CREATE TABLE `assign_medications` (
  `id` int(10) UNSIGNED NOT NULL,
  `medications` int(10) UNSIGNED NOT NULL,
  `dose` int(11) NOT NULL,
  `resident` int(10) UNSIGNED NOT NULL,
  `route` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `time` time DEFAULT NULL,
  `start_day` date NOT NULL,
  `end_day` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_medications`
--

INSERT INTO `assign_medications` (`id`, `medications`, `dose`, `resident`, `route`, `sign_date`, `time`, `start_day`, `end_day`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, NULL, '2021-01-15 11:08:36', '08:30:00', '2021-01-05', '2021-01-26', '2021-01-15 11:08:36', '2021-01-15 11:08:36'),
(2, 1, 3, 2, NULL, '2021-01-15 11:08:36', '14:30:00', '2021-01-05', '2021-01-26', '2021-01-15 11:08:36', '2021-01-15 11:08:36'),
(3, 1, 3, 2, NULL, '2021-01-15 11:08:36', '20:30:00', '2021-01-05', '2021-01-26', '2021-01-15 11:08:36', '2021-01-15 11:08:36'),
(4, 2, 1, 5, NULL, '2021-05-12 06:39:21', '12:00:00', '2021-05-12', '2021-05-19', '2021-05-12 06:39:21', '2021-05-12 06:39:21'),
(5, 2, 3, 2, NULL, '2021-05-16 15:46:19', '09:30:00', '2021-05-18', '2021-05-21', '2021-05-16 15:46:19', '2021-05-16 15:46:19'),
(6, 2, 3, 2, NULL, '2021-05-16 15:46:19', '15:30:00', '2021-05-18', '2021-05-21', '2021-05-16 15:46:19', '2021-05-16 15:46:19'),
(7, 2, 3, 2, NULL, '2021-05-16 15:46:19', '21:30:00', '2021-05-18', '2021-05-21', '2021-05-16 15:46:19', '2021-05-16 15:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `body_harms`
--

CREATE TABLE `body_harms` (
  `id` int(10) UNSIGNED NOT NULL,
  `resident` int(10) UNSIGNED NOT NULL,
  `sign_date` datetime NOT NULL,
  `comment` int(10) UNSIGNED NOT NULL,
  `screenshot_3d` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `body_harms`
--

INSERT INTO `body_harms` (`id`, `resident`, `sign_date`, `comment`, `screenshot_3d`, `created_at`, `updated_at`) VALUES
(1, 2, '2021-01-17 01:03:19', 2, 'screenshot_6003fd57b6da8.png', '2021-01-17 01:03:19', '2021-01-17 01:03:19'),
(2, 2, '2021-01-18 02:24:16', 1, 'screenshot_600561d0ac295.png', '2021-01-18 02:24:16', '2021-01-18 02:24:16'),
(4, 2, '2021-02-26 14:19:13', 2, 'screenshot_603973e1dbe31.png', '2021-02-26 14:19:13', '2021-02-26 14:19:13'),
(5, 2, '2021-04-17 21:01:06', 3, 'screenshot_607baf02764ce.png', '2021-04-17 21:01:06', '2021-04-17 21:01:06'),
(6, 2, '2021-04-18 23:47:19', 3, 'screenshot_607d277749291.png', '2021-04-18 23:47:19', '2021-04-18 23:47:19'),
(7, 2, '2021-04-19 09:22:50', 3, 'screenshot_607dae5aedfa3.png', '2021-04-19 09:22:50', '2021-04-19 09:22:50'),
(8, 2, '2021-05-11 09:26:34', 2, 'screenshot_609ab03a86b44.png', '2021-05-11 09:26:34', '2021-05-11 09:26:34'),
(10, 5, '2021-05-14 01:43:03', 1, 'screenshot_609e381724e2d.png', '2021-05-14 01:43:03', '2021-05-14 01:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `body_harm_comments`
--

CREATE TABLE `body_harm_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `body_harm_comments`
--

INSERT INTO `body_harm_comments` (`id`, `name`, `sign_date`, `created_at`, `updated_at`) VALUES
(1, 'Blood', '2021-01-15 11:04:26', '2021-01-15 11:04:26', '2021-01-15 11:04:26'),
(2, 'break', '2021-01-15 11:04:34', '2021-01-15 11:04:34', '2021-01-15 11:04:34'),
(3, 'Bruise', '2021-03-24 21:37:52', '2021-03-24 21:37:52', '2021-03-24 21:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_id` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `type`, `name`, `ref_id`, `sign_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'walking', 1, '2021-01-15 10:59:54', '2021-01-15 10:59:54', '2021-01-15 10:59:54'),
(2, 1, 'dawn', 1, '2021-01-15 10:59:54', '2021-01-15 10:59:54', '2021-01-15 10:59:54'),
(3, 1, 'health', 1, '2021-01-15 10:59:54', '2021-01-15 10:59:54', '2021-01-15 10:59:54'),
(4, 1, 'music', 2, '2021-01-15 11:00:52', '2021-01-15 11:00:52', '2021-01-15 11:00:52'),
(5, 1, 'listening', 2, '2021-01-15 11:00:52', '2021-01-15 11:00:52', '2021-01-15 11:00:52'),
(6, 1, 'ear', 2, '2021-01-15 11:00:52', '2021-01-15 11:00:52', '2021-01-15 11:00:52'),
(7, 1, 'health', 2, '2021-01-15 11:00:52', '2021-01-15 11:00:52', '2021-01-15 11:00:52'),
(8, 1, 'talking', 3, '2021-01-15 11:02:27', '2021-01-15 11:02:27', '2021-01-15 11:02:27'),
(9, 1, 'memory', 3, '2021-01-15 11:02:27', '2021-01-15 11:02:27', '2021-01-15 11:02:27'),
(10, 2, 'medicine', 1, '2021-01-15 11:03:21', '2021-01-15 11:03:21', '2021-01-15 11:03:21'),
(11, 2, 'aspirin', 1, '2021-01-15 11:03:21', '2021-01-15 11:03:21', '2021-01-15 11:03:21'),
(12, 2, 'medicine', 2, '2021-01-15 11:04:03', '2021-01-15 11:04:03', '2021-01-15 11:04:03'),
(13, 2, 'paracetamol', 2, '2021-01-15 11:04:03', '2021-01-15 11:04:03', '2021-01-15 11:04:03'),
(14, 2, 'health', 2, '2021-01-15 11:04:03', '2021-01-15 11:04:03', '2021-01-15 11:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_desc` text COLLATE utf8mb4_unicode_ci,
  `site_footer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `site_title`, `site_subtitle`, `site_desc`, `site_footer`, `created_at`, `updated_at`) VALUES
(1, 'Blue Care Hub', 'Blue Care Hub', 'Your Awesome Marketplace', 'Blue Care Hub', '© Copyright 2020 - City of UAE Dubai. All rights reserved.', '2021-01-15 07:12:15', '2021-01-15 19:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `incidences`
--

CREATE TABLE `incidences` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `content` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `localization_settings`
--

CREATE TABLE `localization_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `localization_settings`
--

INSERT INTO `localization_settings` (`id`, `language`, `currency`, `created_at`, `updated_at`) VALUES
(1, 'aed', 'AED', '2021-01-15 07:12:15', '2021-01-15 07:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dose` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`id`, `name`, `dose`, `photo`, `comments`, `sign_date`, `created_at`, `updated_at`) VALUES
(1, 'Aspirin', '3', '51o7qujNkBhuYoPgqyJKI8Gogp2fBqu20aaCov1M.jpeg', 'medicine,aspirin', '2021-01-15 11:03:21', '2021-01-15 11:03:21', '2021-01-15 11:03:21'),
(2, 'Paracetamol', '3', 'Z3HkjC1iZdbHtqyPF35AzLSPuLmJ1nCkAU85kE3O.jpeg', 'medicine,paracetamol,health', '2021-01-15 11:04:03', '2021-01-15 11:04:03', '2021-01-15 11:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_09_17_111127_create_roles_table', 1),
(4, '2018_09_17_111825_create_role_user_table', 1),
(5, '2018_09_22_021222_create_general_settings_table', 1),
(6, '2018_10_08_113434_create_localization_settings_table', 1),
(7, '2020_10_09_141634_create_activities_table', 1),
(8, '2020_10_09_145306_create_incidences_table', 1),
(9, '2020_10_11_193056_create_user_activities_table', 1),
(10, '2020_10_16_060857_create_medications_table', 1),
(11, '2020_10_20_102650_create_assign_medications_table', 1),
(12, '2020_10_21_091916_create_tfg_table', 1),
(13, '2020_10_21_141838_create_user_medications_table', 1),
(14, '2020_10_22_113538_create_comments_table', 1),
(15, '2020_10_28_174414_create_body_harm_comments', 1),
(16, '2020_10_29_085636_create_body_harm_tables', 1),
(17, '2020_10_30_193646_create_notifications_table', 1),
(18, '2020_11_01_090009_create_reminder_configs_table', 1),
(19, '2020_11_09_081058_create_routes_table', 1),
(20, '2020_11_10_072908_create_admin_logs_table', 1),
(21, '2020_11_11_151249_create_useractivity_reports_table', 1),
(22, '2020_12_21_084818_create_switch_reminder_table', 1),
(23, '2020_12_23_093009_create_vital_sign_table', 1),
(24, '2021_01_06_053159_create_resident_information_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contents` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminder_configs`
--

CREATE TABLE `reminder_configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `minutes` int(11) NOT NULL,
  `active` int(11) DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminder_configs`
--

INSERT INTO `reminder_configs` (`id`, `minutes`, `active`, `sign_date`, `created_at`, `updated_at`) VALUES
(1, 5, NULL, '2021-01-16 04:11:10', '2021-01-16 04:11:10', '2021-01-16 04:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `resident_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `type`, `description`, `resident_id`, `user_id`, `sign_date`, `created_at`, `updated_at`) VALUES
(6, 3, '09:30:00 : Paracetamol', 2, 1, '2021-05-16 15:46:24', '2021-05-16 15:46:24', '2021-05-16 15:46:24'),
(7, 4, '18:09:00 : Aspirin', 5, 1, '2021-05-23 11:10:44', '2021-05-23 11:10:44', '2021-05-23 11:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `resident_information`
--

CREATE TABLE `resident_information` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_admitted` date DEFAULT NULL,
  `ssn` text COLLATE utf8mb4_unicode_ci,
  `primary_language` text COLLATE utf8mb4_unicode_ci,
  `representing_party_firstname` text COLLATE utf8mb4_unicode_ci,
  `representing_party_lastname` text COLLATE utf8mb4_unicode_ci,
  `representing_party_street1` text COLLATE utf8mb4_unicode_ci,
  `representing_party_street2` text COLLATE utf8mb4_unicode_ci,
  `representing_party_city` text COLLATE utf8mb4_unicode_ci,
  `representing_party_zip_code` text COLLATE utf8mb4_unicode_ci,
  `representing_party_state` text COLLATE utf8mb4_unicode_ci,
  `representing_party_home_phone` text COLLATE utf8mb4_unicode_ci,
  `representing_party_cell_phone` text COLLATE utf8mb4_unicode_ci,
  `secondary_representative_firstname` text COLLATE utf8mb4_unicode_ci,
  `secondary_representative_lastname` text COLLATE utf8mb4_unicode_ci,
  `secondary_representative_street1` text COLLATE utf8mb4_unicode_ci,
  `secondary_representative_street2` text COLLATE utf8mb4_unicode_ci,
  `secondary_representative_city` text COLLATE utf8mb4_unicode_ci,
  `secondary_representative_zip_code` text COLLATE utf8mb4_unicode_ci,
  `secondary_representative_state` text COLLATE utf8mb4_unicode_ci,
  `secondary_representative_home_phone` text COLLATE utf8mb4_unicode_ci,
  `secondary_representative_cell_phone` text COLLATE utf8mb4_unicode_ci,
  `physician_or_medical_group_firstname` text COLLATE utf8mb4_unicode_ci,
  `physician_or_medical_group_lastname` text COLLATE utf8mb4_unicode_ci,
  `physician_or_medical_group_street1` text COLLATE utf8mb4_unicode_ci,
  `physician_or_medical_group_street2` text COLLATE utf8mb4_unicode_ci,
  `physician_or_medical_group_city` text COLLATE utf8mb4_unicode_ci,
  `physician_or_medical_group_zip_code` text COLLATE utf8mb4_unicode_ci,
  `physician_or_medical_group_state` text COLLATE utf8mb4_unicode_ci,
  `physician_or_medical_group_phone` text COLLATE utf8mb4_unicode_ci,
  `physician_or_medical_group_fax` text COLLATE utf8mb4_unicode_ci,
  `pharmacy_firstname` text COLLATE utf8mb4_unicode_ci,
  `pharmacy_lastname` text COLLATE utf8mb4_unicode_ci,
  `pharmacy_street1` text COLLATE utf8mb4_unicode_ci,
  `pharmacy_street2` text COLLATE utf8mb4_unicode_ci,
  `pharmacy_city` text COLLATE utf8mb4_unicode_ci,
  `pharmacy_zip_code` text COLLATE utf8mb4_unicode_ci,
  `pharmacy_state` text COLLATE utf8mb4_unicode_ci,
  `pharmacy_home_phone` text COLLATE utf8mb4_unicode_ci,
  `pharmacy_fax` text COLLATE utf8mb4_unicode_ci,
  `dentist_name` text COLLATE utf8mb4_unicode_ci,
  `dentist_street1` text COLLATE utf8mb4_unicode_ci,
  `dentist_street2` text COLLATE utf8mb4_unicode_ci,
  `dentist_city` text COLLATE utf8mb4_unicode_ci,
  `dentist_zip_code` text COLLATE utf8mb4_unicode_ci,
  `dentist_state` text COLLATE utf8mb4_unicode_ci,
  `dentist_home_phone` text COLLATE utf8mb4_unicode_ci,
  `dentist_fax` text COLLATE utf8mb4_unicode_ci,
  `advance_directive` text COLLATE utf8mb4_unicode_ci,
  `polst` text COLLATE utf8mb4_unicode_ci,
  `alergies` text COLLATE utf8mb4_unicode_ci,
  `signDate` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resident_information`
--

INSERT INTO `resident_information` (`id`, `date_admitted`, `ssn`, `primary_language`, `representing_party_firstname`, `representing_party_lastname`, `representing_party_street1`, `representing_party_street2`, `representing_party_city`, `representing_party_zip_code`, `representing_party_state`, `representing_party_home_phone`, `representing_party_cell_phone`, `secondary_representative_firstname`, `secondary_representative_lastname`, `secondary_representative_street1`, `secondary_representative_street2`, `secondary_representative_city`, `secondary_representative_zip_code`, `secondary_representative_state`, `secondary_representative_home_phone`, `secondary_representative_cell_phone`, `physician_or_medical_group_firstname`, `physician_or_medical_group_lastname`, `physician_or_medical_group_street1`, `physician_or_medical_group_street2`, `physician_or_medical_group_city`, `physician_or_medical_group_zip_code`, `physician_or_medical_group_state`, `physician_or_medical_group_phone`, `physician_or_medical_group_fax`, `pharmacy_firstname`, `pharmacy_lastname`, `pharmacy_street1`, `pharmacy_street2`, `pharmacy_city`, `pharmacy_zip_code`, `pharmacy_state`, `pharmacy_home_phone`, `pharmacy_fax`, `dentist_name`, `dentist_street1`, `dentist_street2`, `dentist_city`, `dentist_zip_code`, `dentist_state`, `dentist_home_phone`, `dentist_fax`, `advance_directive`, `polst`, `alergies`, `signDate`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-15 11:06:56', '2021-01-15 11:06:56', '2021-01-15 11:06:56'),
(2, '2021-01-01', NULL, 'English', 'Sumanta', 'Dey', 'Brahmapara, Simurali, Nadia', NULL, 'Simurali', '741248', 'West Bengal', '8101731846', '8101731846', 'Chandana', 'Dey', 'Brahmapara, Simurali, Nadia', NULL, 'Simurali', '741248', 'West Bengal', '9749839843', '9749839843', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-12 01:48:18', '2021-05-12 01:48:18', '2021-05-12 01:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-01-15 07:12:15', '2021-01-15 07:12:15'),
(2, 'care taker', '2021-01-15 07:12:15', '2021-01-15 07:12:15'),
(3, 'resident', '2021-01-15 07:12:15', '2021-01-15 07:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-01-15 07:12:15', '2021-01-15 07:12:15'),
(2, 2, 3, '2021-01-15 11:06:56', '2021-01-15 11:06:56'),
(3, 3, 2, '2021-01-15 11:16:12', '2021-01-15 11:16:12'),
(4, 4, 2, '2021-04-18 23:43:32', '2021-04-18 23:43:32'),
(5, 5, 3, '2021-05-12 01:48:18', '2021-05-12 01:48:18'),
(6, 6, 2, '2021-05-14 02:13:58', '2021-05-14 02:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `switch_reminder`
--

CREATE TABLE `switch_reminder` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `set_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tfg`
--

CREATE TABLE `tfg` (
  `id` int(10) UNSIGNED NOT NULL,
  `medications` int(10) UNSIGNED NOT NULL,
  `time` time NOT NULL,
  `resident` int(10) UNSIGNED NOT NULL,
  `comment` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tfg`
--

INSERT INTO `tfg` (`id`, `medications`, `time`, `resident`, `comment`, `file`, `status`, `sign_date`, `created_at`, `updated_at`) VALUES
(1, 2, '07:17:00', 5, 'SOS', NULL, 1, '2021-05-14 00:20:10', '2021-05-14 00:20:10', '2021-05-14 00:20:10'),
(2, 2, '20:30:00', 5, '1', NULL, 1, '2021-05-14 12:49:25', '2021-05-14 12:49:25', '2021-05-14 12:49:25'),
(3, 1, '18:09:00', 5, 'BG -150', NULL, 1, '2021-05-23 11:10:44', '2021-05-23 11:10:44', '2021-05-23 11:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `useractivity_reports`
--

CREATE TABLE `useractivity_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `assign_id` int(10) UNSIGNED NOT NULL,
  `resident` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `comment` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `useractivity_reports`
--

INSERT INTO `useractivity_reports` (`id`, `assign_id`, `resident`, `user`, `comment`, `sign_date`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, NULL, '2021-01-15 11:13:14', '2021-01-15 11:13:14', '2021-01-15 11:13:14'),
(3, 3, 5, 1, NULL, '2021-05-14 01:08:33', '2021-05-14 01:08:33', '2021-05-14 01:08:33'),
(4, 4, 5, 1, NULL, '2021-05-14 01:26:02', '2021-05-14 01:26:02', '2021-05-14 01:26:02'),
(5, 3, 5, 3, NULL, '2021-05-15 12:04:17', '2021-05-15 12:04:17', '2021-05-15 12:04:17'),
(6, 4, 5, 3, '1', '2021-05-15 12:04:23', '2021-05-15 12:04:23', '2021-05-15 12:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `profile_logo` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `email`, `gender`, `birthday`, `street1`, `street2`, `city`, `zip_code`, `state`, `profile_logo`, `email_verified_at`, `password`, `phone_number`, `sign_date`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'admin', 'admin@gmail.com', 0, '1999-10-29', 'Serbia', 'Beograd', 'Beograd', '11042', 'Beograd', '1.png', 1, '$2y$10$43Lgdx7qDxGdj3cDyfcw4uLj5nVQ6vsQ3obexrb/axByYf4B6roZO', '029292162', '2021-01-15 04:01:15', 'tTaNTNCkSyRti7zATi2CnaXsqeiaocVhf8rdoPCPcolb7qB8EzfnMqeytIaJ', '2021-01-15 07:12:15', '2021-01-15 07:12:15'),
(2, 'Alex', 'G', 'GG', NULL, 'alex@gg.com', 0, '2021-01-13', 'Beograd', NULL, 'Beograd', '12039', 'Beograd', 'N01V4sjotsU4rQCfp9LnjwsYrubgSU3l9WzBym7A.jpeg', NULL, '', '123', '2021-01-15 11:06:56', NULL, '2021-01-15 11:06:56', '2021-01-15 11:06:56'),
(3, 'Anastasia', NULL, 'L', 'anastasia', 'anastasia-owera@yandex.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jaIvmftP2Fs2LkMRfqxdwdvE1yXwohvdHTF8ADIE.jpeg', NULL, '$2y$10$zEWyCW74RmvPrEo0dS15DOpYwJ.KyRFPml.iRQbBiiKmgz8J6nFmq', '12123', '2021-01-15 11:16:12', 'ltkQLxexRo2PkR71m4ZMdZDtgqLLHUgDjoIYobFwK2TsnmFqKvrXLqxbGO1d', '2021-01-15 11:16:12', '2021-05-15 19:03:35'),
(4, 'Elsa', NULL, 'Amanuel', 'elsaAman', 'elsaaman@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'vG33VAoc1QzjjrIZ4lLEa9f4Md7Zra6fFpzIsBH4.jpeg', NULL, '$2y$10$Qm6VRO4R6jfChJEqo7aa.uMPu0YzsGyBLHjUPd07sDBrPtkrBHx5O', '2063132874', '2021-04-18 23:43:32', NULL, '2021-04-18 23:43:32', '2021-05-23 18:11:54'),
(5, 'Sumanta', 'Nath', 'Dey', NULL, 'sumantadey@codeulas.com', 0, '1988-02-08', 'Brahmapara, Simurali, Nadia', NULL, 'Simurali', '741248', 'West Bengal', 'rTHMrl45DN2S0lNukdsg5u8x1VLR1N4WihOe4wxY.png', NULL, '', '8101731846', '2021-05-12 01:48:18', NULL, '2021-05-12 01:48:18', '2021-05-12 01:48:18'),
(6, 'Davia', NULL, 'Smith', 'davia', 'sumanta@codeulas.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'oih6KxPN3lo07eFwT8xBrRuzdEvBycRLixNKxLPe.jpeg', NULL, '$2y$10$Dx1IPXaIW1pxOt7Aooiu2.S2zlJ.svD5WiKzHFJW2NnFB3tN8iYde', '8101731846', '2021-05-14 02:13:58', NULL, '2021-05-14 02:13:58', '2021-05-14 02:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `activities` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `resident` int(10) UNSIGNED NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `start_day` date NOT NULL,
  `end_day` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`id`, `activities`, `type`, `time`, `day`, `resident`, `comment`, `other_comment`, `file`, `status`, `sign_date`, `start_day`, `end_day`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '17:20:00', NULL, 2, '4', NULL, NULL, 1, '2021-01-15 11:13:07', '2021-01-15', '2021-01-29', '2021-01-15 11:13:07', '2021-01-15 11:13:07'),
(3, 1, 1, '06:00:00', NULL, 5, '1', NULL, NULL, 1, '2021-05-14 01:06:13', '2021-03-12', '2021-05-13', '2021-05-14 01:06:13', '2021-05-14 01:06:13'),
(4, 3, 1, '10:30:00', NULL, 5, '8', NULL, NULL, 1, '2021-05-14 01:21:39', '2021-05-11', '2021-05-13', '2021-05-14 01:21:39', '2021-05-14 01:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_medications`
--

CREATE TABLE `user_medications` (
  `id` int(10) UNSIGNED NOT NULL,
  `assign_id` int(10) UNSIGNED NOT NULL,
  `resident` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `comment` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_medications`
--

INSERT INTO `user_medications` (`id`, `assign_id`, `resident`, `user`, `comment`, `sign_date`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, NULL, '2021-04-17 20:58:34', '2021-04-17 20:58:34', '2021-04-17 20:58:34'),
(2, 1, 2, 1, NULL, '2021-04-19 09:21:28', '2021-04-19 09:21:28', '2021-04-19 09:21:28'),
(3, 3, 2, 1, NULL, '2021-04-19 09:21:38', '2021-04-19 09:21:38', '2021-04-19 09:21:38'),
(4, 4, 5, 1, NULL, '2021-05-14 00:01:18', '2021-05-14 00:01:18', '2021-05-14 00:01:18'),
(5, 5, 2, 1, NULL, '2021-05-16 15:46:24', '2021-05-16 15:46:24', '2021-05-16 15:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `vital_sign`
--

CREATE TABLE `vital_sign` (
  `id` int(10) UNSIGNED NOT NULL,
  `data` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL,
  `resident_id` int(10) UNSIGNED NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vital_sign`
--

INSERT INTO `vital_sign` (`id`, `data`, `type`, `resident_id`, `sign_date`, `created_at`, `updated_at`) VALUES
(1, '120', 1, 2, '2021-01-15 11:07:21', '2021-01-15 11:07:21', '2021-01-15 11:07:21'),
(2, '120/80', 2, 2, '2021-01-15 11:07:21', '2021-01-15 11:07:21', '2021-01-15 11:07:21'),
(3, '90', 3, 2, '2021-01-15 11:07:21', '2021-01-15 11:07:21', '2021-01-15 11:07:21'),
(4, '700', 1, 2, '2021-01-31 21:24:59', '2021-01-31 21:24:59', '2021-01-31 21:24:59'),
(5, '700000', 2, 2, '2021-01-31 21:24:59', '2021-01-31 21:24:59', '2021-01-31 21:24:59'),
(6, '789', 3, 2, '2021-01-31 21:24:59', '2021-01-31 21:24:59', '2021-01-31 21:24:59'),
(7, '100', 1, 5, '2021-05-14 01:54:45', '2021-05-14 01:54:45', '2021-05-14 01:54:45'),
(8, '130', 2, 5, '2021-05-14 01:54:45', '2021-05-14 01:54:45', '2021-05-14 01:54:45'),
(9, '95', 3, 5, '2021-05-14 01:54:45', '2021-05-14 01:54:45', '2021-05-14 01:54:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_medications`
--
ALTER TABLE `assign_medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_medications_medications_foreign` (`medications`),
  ADD KEY `assign_medications_resident_foreign` (`resident`);

--
-- Indexes for table `body_harms`
--
ALTER TABLE `body_harms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `body_harms_resident_foreign` (`resident`),
  ADD KEY `body_harms_comment_foreign` (`comment`);

--
-- Indexes for table `body_harm_comments`
--
ALTER TABLE `body_harm_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidences`
--
ALTER TABLE `incidences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localization_settings`
--
ALTER TABLE `localization_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `reminder_configs`
--
ALTER TABLE `reminder_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resident_information`
--
ALTER TABLE `resident_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `switch_reminder`
--
ALTER TABLE `switch_reminder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tfg`
--
ALTER TABLE `tfg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tfg_medications_foreign` (`medications`),
  ADD KEY `tfg_resident_foreign` (`resident`);

--
-- Indexes for table `useractivity_reports`
--
ALTER TABLE `useractivity_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `useractivity_reports_assign_id_foreign` (`assign_id`),
  ADD KEY `useractivity_reports_resident_foreign` (`resident`),
  ADD KEY `useractivity_reports_user_foreign` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activities_activities_foreign` (`activities`),
  ADD KEY `user_activities_resident_foreign` (`resident`);

--
-- Indexes for table `user_medications`
--
ALTER TABLE `user_medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_medications_assign_id_foreign` (`assign_id`),
  ADD KEY `user_medications_resident_foreign` (`resident`),
  ADD KEY `user_medications_user_foreign` (`user`);

--
-- Indexes for table `vital_sign`
--
ALTER TABLE `vital_sign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vital_sign_resident_id_foreign` (`resident_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `assign_medications`
--
ALTER TABLE `assign_medications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `body_harms`
--
ALTER TABLE `body_harms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `body_harm_comments`
--
ALTER TABLE `body_harm_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `incidences`
--
ALTER TABLE `incidences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `localization_settings`
--
ALTER TABLE `localization_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reminder_configs`
--
ALTER TABLE `reminder_configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `resident_information`
--
ALTER TABLE `resident_information`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `switch_reminder`
--
ALTER TABLE `switch_reminder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tfg`
--
ALTER TABLE `tfg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `useractivity_reports`
--
ALTER TABLE `useractivity_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_medications`
--
ALTER TABLE `user_medications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vital_sign`
--
ALTER TABLE `vital_sign`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_medications`
--
ALTER TABLE `assign_medications`
  ADD CONSTRAINT `assign_medications_medications_foreign` FOREIGN KEY (`medications`) REFERENCES `medications` (`id`),
  ADD CONSTRAINT `assign_medications_resident_foreign` FOREIGN KEY (`resident`) REFERENCES `users` (`id`);

--
-- Constraints for table `body_harms`
--
ALTER TABLE `body_harms`
  ADD CONSTRAINT `body_harms_comment_foreign` FOREIGN KEY (`comment`) REFERENCES `body_harm_comments` (`id`),
  ADD CONSTRAINT `body_harms_resident_foreign` FOREIGN KEY (`resident`) REFERENCES `users` (`id`);

--
-- Constraints for table `tfg`
--
ALTER TABLE `tfg`
  ADD CONSTRAINT `tfg_medications_foreign` FOREIGN KEY (`medications`) REFERENCES `medications` (`id`),
  ADD CONSTRAINT `tfg_resident_foreign` FOREIGN KEY (`resident`) REFERENCES `users` (`id`);

--
-- Constraints for table `useractivity_reports`
--
ALTER TABLE `useractivity_reports`
  ADD CONSTRAINT `useractivity_reports_assign_id_foreign` FOREIGN KEY (`assign_id`) REFERENCES `user_activities` (`id`),
  ADD CONSTRAINT `useractivity_reports_resident_foreign` FOREIGN KEY (`resident`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `useractivity_reports_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD CONSTRAINT `user_activities_activities_foreign` FOREIGN KEY (`activities`) REFERENCES `activities` (`id`),
  ADD CONSTRAINT `user_activities_resident_foreign` FOREIGN KEY (`resident`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_medications`
--
ALTER TABLE `user_medications`
  ADD CONSTRAINT `user_medications_assign_id_foreign` FOREIGN KEY (`assign_id`) REFERENCES `assign_medications` (`id`),
  ADD CONSTRAINT `user_medications_resident_foreign` FOREIGN KEY (`resident`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_medications_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `vital_sign`
--
ALTER TABLE `vital_sign`
  ADD CONSTRAINT `vital_sign_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
