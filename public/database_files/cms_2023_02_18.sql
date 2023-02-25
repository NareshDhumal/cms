-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 18, 2023 at 06:08 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

DROP TABLE IF EXISTS `academic_years`;
CREATE TABLE IF NOT EXISTS `academic_years` (
  `academic_year_id` int(11) NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`academic_year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`academic_year_id`, `academic_year`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2022-23', '2023-01-28 07:27:17', '2023-01-28 07:27:17', NULL),
(2, '2023-25', '2023-01-28 07:32:38', '2023-01-28 07:50:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE IF NOT EXISTS `activity_log` (
  `activity_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `session_id` text,
  `module` varchar(255) DEFAULT NULL,
  `action` text,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`activity_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity_log_id`, `user_id`, `user_name`, `session_id`, `module`, `action`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(227, '1', 'admin user', 'w0hlsmkG0Aw0AyTyu8lIRG3QFPxD9Jhzi0qD39Pc', 'Internal User', 'Internal User Deleted', 'Internal User deleted : Internal User Name  = Vijay', '2023-01-28 06:48:54', '2023-01-28 06:48:54', NULL),
(228, '1', 'admin user', 'w0hlsmkG0Aw0AyTyu8lIRG3QFPxD9Jhzi0qD39Pc', 'Internal User', 'Internal User Deleted', 'Internal User deleted : Internal User Name  = dhumalpqrr', '2023-01-28 06:48:56', '2023-01-28 06:48:56', NULL),
(229, '1', 'admin user', 'w0hlsmkG0Aw0AyTyu8lIRG3QFPxD9Jhzi0qD39Pc', 'Internal User', 'Internal User Deleted', 'Internal User deleted : Internal User Name  = naresh', '2023-01-28 06:48:58', '2023-01-28 06:48:58', NULL),
(230, '1', 'admin user', 'w0hlsmkG0Aw0AyTyu8lIRG3QFPxD9Jhzi0qD39Pc', 'role', 'role Update', 'role Updated : Admin menu_ids=\"24,11,6,22\" submenu_ids=\"43,52,53,24\"', '2023-01-28 10:11:49', '2023-01-28 10:11:49', NULL),
(231, '1', 'admin user', 'w0hlsmkG0Aw0AyTyu8lIRG3QFPxD9Jhzi0qD39Pc', 'role', 'role Update', 'role Updated : Admin menu_ids=\"24,25,11,6,22\"', '2023-01-28 10:32:12', '2023-01-28 10:32:12', NULL),
(232, '1', 'admin user', 'X5kxp3H0BVOeue0FCZXIfa9CeBAUaqXvfyw8qRPz', 'Internal User', 'Internal User Created', 'New Internal User Created : naresh', '2023-01-28 15:15:01', '2023-01-28 15:15:01', NULL),
(233, '1', 'admin user', 'X5kxp3H0BVOeue0FCZXIfa9CeBAUaqXvfyw8qRPz', 'Internal User', 'Internal User Created', 'New Internal User Created : naresh', '2023-01-28 15:15:54', '2023-01-28 15:15:54', NULL),
(234, '1', 'admin user', 'X5kxp3H0BVOeue0FCZXIfa9CeBAUaqXvfyw8qRPz', 'Internal User', 'Internal User Created', 'New Internal User Created : naresh', '2023-01-28 15:17:28', '2023-01-28 15:17:28', NULL),
(235, '1', 'admin user', 'X5kxp3H0BVOeue0FCZXIfa9CeBAUaqXvfyw8qRPz', 'Internal User', 'Internal User Created', 'New Internal User Created : naresh', '2023-01-28 15:18:38', '2023-01-28 15:18:38', NULL),
(236, '1', 'admin user', 'X5kxp3H0BVOeue0FCZXIfa9CeBAUaqXvfyw8qRPz', 'Internal User', 'Internal User Deleted', 'Internal User deleted : Internal User Name  = admin', '2023-01-28 15:23:02', '2023-01-28 15:23:02', NULL),
(237, '1', 'admin user', 'X5kxp3H0BVOeue0FCZXIfa9CeBAUaqXvfyw8qRPz', 'Internal User', 'Internal User Deleted', 'Internal User deleted : Internal User Name  = naresh', '2023-01-28 15:23:56', '2023-01-28 15:23:56', NULL),
(238, '1', 'admin user', 'X5kxp3H0BVOeue0FCZXIfa9CeBAUaqXvfyw8qRPz', 'Internal User', 'Internal User Created', 'New Internal User Created : n', '2023-01-28 15:24:59', '2023-01-28 15:24:59', NULL),
(239, '1', 'admin user', 'X5kxp3H0BVOeue0FCZXIfa9CeBAUaqXvfyw8qRPz', 'Internal User', 'Internal User Created', 'New Internal User Created : n', '2023-01-28 15:26:05', '2023-01-28 15:26:05', NULL),
(240, '1', 'admin user', 'X5kxp3H0BVOeue0FCZXIfa9CeBAUaqXvfyw8qRPz', 'Internal User', 'Internal User Created', 'New Internal User Created : aaa', '2023-01-28 16:03:53', '2023-01-28 16:03:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activity_type`
--

DROP TABLE IF EXISTS `activity_type`;
CREATE TABLE IF NOT EXISTS `activity_type` (
  `activity_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`activity_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_type`
--

INSERT INTO `activity_type` (`activity_type_id`, `activity_type`) VALUES
(1, 'create'),
(2, 'update');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `admin_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(50) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `account_status` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`admin_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_user_id`, `first_name`, `last_name`, `email`, `password`, `mobile_no`, `profile_pic`, `role_id`, `account_status`, `remember_token`, `location_id`, `is_admin`, `user_type`, `role`, `token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'user', 'admin@gmail.com', '$2y$10$3bCXltce2kTRd98mmCG85OLaWURAXlHQZiQt392ur6W3uun06PsmC', '9879879880', NULL, 1, 1, NULL, NULL, 1, NULL, '1', NULL, '2022-09-01 04:07:56', '2023-01-28 15:23:02', NULL),
(26, 'aaa', 'aaaaa', 'naresh@gmail.com', '$2y$10$8bEh4x.v7WHy1ewFOJ96IeQAtl.pIMCyHIgQBSe3DuqWm/z6mUr9O', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '1', NULL, '2023-01-28 16:03:53', '2023-01-28 16:04:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `backend_menubar`
--

DROP TABLE IF EXISTS `backend_menubar`;
CREATE TABLE IF NOT EXISTS `backend_menubar` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) DEFAULT NULL,
  `menu_controller_name` varchar(50) DEFAULT NULL,
  `menu_action_name` varchar(50) DEFAULT NULL,
  `has_submenu` tinyint(4) DEFAULT '0',
  `menu_icon` varchar(200) DEFAULT NULL,
  `permissions` varchar(200) DEFAULT NULL,
  `visibility` tinyint(4) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backend_menubar`
--

INSERT INTO `backend_menubar` (`menu_id`, `menu_name`, `menu_controller_name`, `menu_action_name`, `has_submenu`, `menu_icon`, `permissions`, `visibility`, `sort_order`, `created_at`, `updated_at`) VALUES
(6, 'Roles', 'admin.roles', NULL, 0, 'monitor', '6,7,8,9', 1, 1, '2020-11-05 23:16:01', '2023-01-31 17:04:22'),
(11, 'Master Data', 'admin.roles', NULL, 1, 'list', '6,7,8,9', 1, 2, '2021-01-05 13:17:55', '2023-01-31 17:04:27'),
(22, 'User Management', '#', NULL, 1, 'users', NULL, 1, 3, '2021-09-14 18:12:49', '2023-01-31 17:04:38'),
(24, 'Students', 'admin.students', NULL, 0, NULL, '6,7,8,9', 1, 5, '2023-01-28 10:08:49', '2023-01-31 17:04:42'),
(25, 'Teacher', 'admin.teachers', NULL, 0, NULL, '6,7,8,9', 1, 4, '2023-01-28 10:31:58', '2023-01-31 17:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `backend_submenubar`
--

DROP TABLE IF EXISTS `backend_submenubar`;
CREATE TABLE IF NOT EXISTS `backend_submenubar` (
  `submenu_id` int(11) NOT NULL AUTO_INCREMENT,
  `submenu_name` varchar(50) DEFAULT NULL,
  `submenu_controller_name` varchar(50) DEFAULT NULL,
  `submenu_action_name` varchar(50) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `sub_parent_id` int(11) DEFAULT NULL,
  `submenu_permissions` varchar(200) DEFAULT NULL,
  `visibility` tinyint(4) DEFAULT '1',
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`submenu_id`),
  KEY `submenu_id` (`submenu_id`),
  KEY `menu_id` (`menu_id`),
  KEY `sub_parent_id` (`sub_parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backend_submenubar`
--

INSERT INTO `backend_submenubar` (`submenu_id`, `submenu_name`, `submenu_controller_name`, `submenu_action_name`, `menu_id`, `sub_parent_id`, `submenu_permissions`, `visibility`, `sort_order`, `created_at`, `updated_at`) VALUES
(24, 'Internal Users', 'admin.users', 'grid', 22, NULL, '6,7,8,9', 1, NULL, '2021-09-14 07:14:11', '2022-09-05 20:23:48'),
(39, 'Down', 'admin.sitemanagement.down', NULL, 32, NULL, '7,8', 1, NULL, '2022-07-06 14:41:18', '2022-07-06 14:41:18'),
(40, 'Up', 'admin.sitemanagement.up', NULL, 32, NULL, '7,8', 1, NULL, '2022-07-06 14:41:46', '2022-07-06 14:41:46'),
(43, 'Academic Years', 'admin.year', NULL, 11, NULL, '6,7,8,9', 1, NULL, '2022-09-11 05:19:40', '2023-01-28 07:02:21'),
(52, 'Batches', 'admin.batches', NULL, 11, NULL, NULL, 1, 2, '2023-01-28 08:52:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `base_permissions`
--

DROP TABLE IF EXISTS `base_permissions`;
CREATE TABLE IF NOT EXISTS `base_permissions` (
  `base_permission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `base_permission_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`base_permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `base_permissions`
--

INSERT INTO `base_permissions` (`base_permission_id`, `base_permission_name`, `guard_name`, `created_at`, `updated_at`) VALUES
(6, 'Create', 'admin', '2020-11-20 23:47:05', '2020-11-20 23:47:05'),
(7, 'View', 'admin', '2020-11-20 23:47:26', '2020-11-20 23:47:26'),
(8, 'Update', 'admin', '2020-11-20 23:47:32', '2020-11-20 23:47:32'),
(9, 'Delete', 'admin', '2020-11-20 23:47:37', '2020-11-20 23:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

DROP TABLE IF EXISTS `batches`;
CREATE TABLE IF NOT EXISTS `batches` (
  `batch_id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_name` varchar(255) NOT NULL,
  `full_fees` float NOT NULL,
  `fees` float NOT NULL,
  `teaching_rate` float NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`batch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`batch_id`, `batch_name`, `full_fees`, `fees`, `teaching_rate`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1st', 10001, 8002, 101, 1, '2023-01-28 09:24:44', '2023-01-28 10:04:41', NULL),
(2, '2nd', 10000, 9000, 200, 1, '2023-01-28 10:05:20', '2023-01-28 10:05:33', NULL),
(3, '3rd', 12000, 10000, 220, 1, '2023-01-28 10:06:12', '2023-01-28 10:06:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `sub_category` int(11) DEFAULT NULL,
  `category_slug` varchar(255) DEFAULT NULL,
  `visibility` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `sub_category`, `category_slug`, `visibility`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Buy', 1, 'buy prop', 1, '2023-01-18 13:18:05', '2023-01-18 13:24:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_permission_id` int(11) DEFAULT NULL,
  `base_permission_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `submenu_id` int(11) DEFAULT NULL,
  `is_sub` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=270 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `base_permission_id`, `base_permission_name`, `menu_id`, `submenu_id`, `is_sub`, `created_at`, `updated_at`) VALUES
(5, 'Update Backend Menu', 'admin', 8, 'Update', 2, NULL, 0, '2021-01-03 23:46:32', '2021-01-12 19:10:17'),
(7, 'View Admin Users', 'admin', 7, 'View', 22, 32, 0, '2021-01-03 23:47:00', '2021-11-02 02:30:50'),
(8, 'Update Admin Users', 'admin', 8, 'Update', 22, 32, 0, '2021-01-03 23:47:00', '2021-11-02 02:30:50'),
(11, 'View Backend Menu', 'admin', 7, 'View', 2, NULL, 0, '2021-01-04 11:57:42', '2021-01-12 19:10:17'),
(12, 'View Categories', 'admin', 7, 'View', 4, NULL, 0, '2021-01-04 11:57:51', '2021-01-12 19:10:35'),
(13, 'Update Categories', 'admin', 8, 'Update', 4, NULL, 0, '2021-01-04 11:57:51', '2021-01-12 19:10:35'),
(16, 'View Sub Categories', 'admin', 7, 'View', 7, NULL, 0, '2021-01-04 11:59:04', '2021-01-12 19:16:14'),
(17, 'Update Sub Categories', 'admin', 8, 'Update', 7, NULL, 0, '2021-01-04 11:59:04', '2021-01-12 19:16:14'),
(22, 'Create test my menu', 'admin', 6, 'Create', NULL, NULL, 0, '2021-01-05 12:54:59', '2021-01-05 13:09:19'),
(23, 'View test my menu', 'admin', 7, 'View', NULL, NULL, 0, '2021-01-05 12:54:59', '2021-01-05 13:09:19'),
(24, 'Update test my menu', 'admin', 8, 'Update', NULL, NULL, 0, '2021-01-05 12:54:59', '2021-01-05 13:09:19'),
(25, 'Delete test my menu', 'admin', 9, 'Delete', NULL, NULL, 0, '2021-01-05 12:54:59', '2021-01-05 13:09:19'),
(31, 'Create ', 'admin', 6, 'Create', 11, 21, 0, '2021-01-05 14:50:39', '2021-05-26 00:22:53'),
(32, 'View ', 'admin', 7, 'View', 11, 21, 0, '2021-01-05 14:50:39', '2021-05-26 00:22:53'),
(36, 'Create Sellers', 'admin', 6, 'Create', 11, 6, 0, '2021-01-05 14:58:28', '2021-01-21 14:15:05'),
(37, 'View Sellers', 'admin', 7, 'View', 11, 6, 0, '2021-01-05 14:58:29', '2021-01-21 14:15:05'),
(44, 'Create Admin Users', 'admin', 6, 'Create', 22, 32, 0, '2021-01-05 17:13:25', '2021-11-02 02:30:50'),
(45, 'Delete Admin Users', 'admin', 9, 'Delete', 22, 32, 0, '2021-01-05 17:16:22', '2021-11-02 02:30:50'),
(46, 'Delete Permissions', 'admin', 9, 'Delete', 1, NULL, 0, '2021-01-12 19:10:10', '2021-02-04 15:15:24'),
(47, 'Create Backend Menu', 'admin', 6, 'Create', 2, NULL, 0, '2021-01-12 19:10:17', '2021-01-12 19:10:17'),
(48, 'Delete Backend Menu', 'admin', 9, 'Delete', 2, NULL, 0, '2021-01-12 19:10:17', '2021-01-12 19:10:17'),
(49, 'Create Categories', 'admin', 6, 'Create', 4, NULL, 0, '2021-01-12 19:10:30', '2021-01-12 19:10:35'),
(50, 'Delete Categories', 'admin', 9, 'Delete', 4, NULL, 0, '2021-01-12 19:10:30', '2021-01-12 19:10:35'),
(52, 'Delete Roles', 'admin', 9, 'Delete', 6, NULL, 0, '2021-01-12 19:16:08', '2021-02-04 15:15:57'),
(53, 'Create Sub Categories', 'admin', 6, 'Create', 7, NULL, 0, '2021-01-12 19:16:14', '2021-01-12 19:16:14'),
(54, 'Delete Sub Categories', 'admin', 9, 'Delete', 7, NULL, 0, '2021-01-12 19:16:14', '2021-01-12 19:16:14'),
(55, 'Create Products', 'admin', 6, 'Create', 12, NULL, 0, '2021-01-18 12:09:31', '2021-01-18 12:09:31'),
(56, 'View Products', 'admin', 7, 'View', 12, NULL, 0, '2021-01-18 12:09:31', '2021-01-18 12:09:31'),
(57, 'Update Products', 'admin', 8, 'Update', 12, NULL, 0, '2021-01-18 12:09:31', '2021-01-18 12:09:31'),
(58, 'Delete Products', 'admin', 9, 'Delete', 12, NULL, 0, '2021-01-18 12:09:32', '2021-01-18 12:09:32'),
(59, 'Update Sellers', 'admin', 8, 'Update', 11, 6, 0, '2021-01-21 14:15:05', '2021-01-21 14:15:05'),
(60, 'Delete Sellers', 'admin', 9, 'Delete', 11, 6, 0, '2021-01-21 14:15:05', '2021-01-21 14:15:05'),
(61, 'Update ', 'admin', 8, 'Update', 11, 21, 0, '2021-01-21 14:36:03', '2021-05-26 00:22:53'),
(62, 'Delete ', 'admin', 9, 'Delete', 11, 21, 0, '2021-01-21 14:36:03', '2021-05-26 00:22:53'),
(63, 'Create Packers', 'admin', 6, 'Create', 11, 8, 0, '2021-01-21 14:48:47', '2021-01-21 14:48:47'),
(64, 'View Packers', 'admin', 7, 'View', 11, 8, 0, '2021-01-21 14:48:47', '2021-01-21 14:48:47'),
(65, 'Update Packers', 'admin', 8, 'Update', 11, 8, 0, '2021-01-21 14:48:47', '2021-01-21 14:48:47'),
(66, 'Delete Packers', 'admin', 9, 'Delete', 11, 8, 0, '2021-01-21 14:48:47', '2021-01-21 14:48:47'),
(67, 'Create Importers', 'admin', 6, 'Create', 11, 10, 0, '2021-01-21 14:58:16', '2021-01-21 14:58:16'),
(68, 'View Importers', 'admin', 7, 'View', 11, 10, 0, '2021-01-21 14:58:16', '2021-01-21 14:58:16'),
(69, 'Update Importers', 'admin', 8, 'Update', 11, 10, 0, '2021-01-21 14:58:16', '2021-01-21 14:58:16'),
(70, 'Delete Importers', 'admin', 9, 'Delete', 11, 10, 0, '2021-01-21 14:58:16', '2021-01-21 14:58:16'),
(71, 'Create Product Images', 'admin', 6, 'Create', 13, NULL, 0, '2021-01-27 15:20:39', '2021-01-28 14:21:20'),
(72, 'View Product Images', 'admin', 7, 'View', 13, NULL, 0, '2021-01-27 15:20:40', '2021-01-28 14:21:20'),
(73, 'Update Product Images', 'admin', 8, 'Update', 13, NULL, 0, '2021-01-27 15:20:40', '2021-01-28 14:21:21'),
(74, 'Create Filters', 'admin', 6, 'Create', 29, 11, 0, '2021-02-03 15:58:48', '2022-02-07 23:07:42'),
(75, 'View Filters', 'admin', 7, 'View', 29, 11, 0, '2021-02-03 15:58:48', '2022-02-07 23:07:42'),
(76, 'Update Filters', 'admin', 8, 'Update', 29, 11, 0, '2021-02-03 15:58:49', '2022-02-07 23:07:42'),
(77, 'Delete Filters', 'admin', 9, 'Delete', 29, 11, 0, '2021-02-03 15:58:49', '2022-02-07 23:07:42'),
(78, 'Create Manufacturers', 'admin', 6, 'Create', 11, 7, 0, '2021-02-04 15:13:57', '2021-02-04 15:13:57'),
(79, 'View Manufacturers', 'admin', 7, 'View', 11, 7, 0, '2021-02-04 15:13:57', '2021-02-04 15:13:57'),
(80, 'Update Manufacturers', 'admin', 8, 'Update', 11, 7, 0, '2021-02-04 15:13:57', '2021-02-04 15:13:57'),
(81, 'Delete Manufacturers', 'admin', 9, 'Delete', 11, 7, 0, '2021-02-04 15:13:57', '2021-02-04 15:13:57'),
(82, 'Create Permissions', 'admin', 6, 'Create', 1, NULL, 0, '2021-02-04 15:15:24', '2021-02-04 15:15:24'),
(83, 'View Permissions', 'admin', 7, 'View', 1, NULL, 0, '2021-02-04 15:15:24', '2021-02-04 15:15:24'),
(84, 'Update Permissions', 'admin', 8, 'Update', 1, NULL, 0, '2021-02-04 15:15:24', '2021-02-04 15:15:24'),
(85, 'Create Roles', 'admin', 6, 'Create', 6, NULL, 0, '2021-02-04 15:15:57', '2021-02-04 15:15:57'),
(86, 'View Roles', 'admin', 7, 'View', 6, NULL, 0, '2021-02-04 15:15:57', '2021-02-04 15:15:57'),
(87, 'Update Roles', 'admin', 8, 'Update', 6, NULL, 0, '2021-02-04 15:15:57', '2021-02-04 15:15:57'),
(88, 'Create Colors', 'admin', 6, 'Create', 11, 12, 0, '2021-02-07 18:14:59', '2021-02-07 18:14:59'),
(89, 'View Colors', 'admin', 7, 'View', 11, 12, 0, '2021-02-07 18:14:59', '2021-02-07 18:14:59'),
(90, 'Update Colors', 'admin', 8, 'Update', 11, 12, 0, '2021-02-07 18:14:59', '2021-02-07 18:14:59'),
(91, 'Delete Colors', 'admin', 9, 'Delete', 11, 12, 0, '2021-02-07 18:15:00', '2021-02-07 18:15:00'),
(92, 'Create Sizes', 'admin', 6, 'Create', 11, 13, 0, '2021-02-07 18:15:18', '2021-02-07 18:15:18'),
(93, 'View Sizes', 'admin', 7, 'View', 11, 13, 0, '2021-02-07 18:15:18', '2021-02-07 18:15:18'),
(94, 'Update Sizes', 'admin', 8, 'Update', 11, 13, 0, '2021-02-07 18:15:18', '2021-02-07 18:15:18'),
(95, 'Delete Sizes', 'admin', 9, 'Delete', 11, 13, 0, '2021-02-07 18:15:18', '2021-02-07 18:15:18'),
(96, 'Create CMS Pages', 'admin', 6, 'Create', 14, NULL, 0, '2021-02-23 18:50:43', '2021-02-23 18:50:43'),
(97, 'View CMS Pages', 'admin', 7, 'View', 14, NULL, 0, '2021-02-23 18:50:44', '2021-02-23 18:50:44'),
(98, 'Update CMS Pages', 'admin', 8, 'Update', 14, NULL, 0, '2021-02-23 18:50:44', '2021-02-23 18:50:44'),
(99, 'Delete CMS Pages', 'admin', 9, 'Delete', 14, NULL, 0, '2021-02-23 18:50:44', '2021-02-23 18:50:44'),
(100, 'Create Size Charts', 'admin', 6, 'Create', 11, 14, 0, '2021-03-08 17:49:59', '2021-03-08 17:49:59'),
(101, 'View Size Charts', 'admin', 7, 'View', 11, 14, 0, '2021-03-08 17:50:00', '2021-03-08 17:50:00'),
(102, 'Update Size Charts', 'admin', 8, 'Update', 11, 14, 0, '2021-03-08 17:50:00', '2021-03-08 17:50:00'),
(103, 'Delete Size Charts', 'admin', 9, 'Delete', 11, 14, 0, '2021-03-08 17:50:00', '2021-03-08 17:50:00'),
(104, 'Create FAQs', 'admin', 6, 'Create', 11, 15, 0, '2021-03-15 12:15:17', '2021-03-15 12:15:17'),
(105, 'View FAQs', 'admin', 7, 'View', 11, 15, 0, '2021-03-15 12:15:18', '2021-03-15 12:15:18'),
(106, 'Update FAQs', 'admin', 8, 'Update', 11, 15, 0, '2021-03-15 12:15:18', '2021-03-15 12:15:18'),
(107, 'Delete FAQs', 'admin', 9, 'Delete', 11, 15, 0, '2021-03-15 12:15:18', '2021-03-15 12:15:18'),
(108, 'Create Size Chart Types', 'admin', 6, 'Create', 11, 16, 0, '2021-03-17 17:33:50', '2021-03-17 17:33:50'),
(109, 'View Size Chart Types', 'admin', 7, 'View', 11, 16, 0, '2021-03-17 17:33:50', '2021-03-17 17:33:50'),
(110, 'Update Size Chart Types', 'admin', 8, 'Update', 11, 16, 0, '2021-03-17 17:33:50', '2021-03-17 17:33:50'),
(111, 'Delete Size Chart Types', 'admin', 9, 'Delete', 11, 16, 0, '2021-03-17 17:33:50', '2021-03-17 17:33:50'),
(112, 'Create Home Page', 'admin', 6, 'Create', 15, NULL, 0, '2021-03-18 13:27:58', '2021-03-18 19:04:35'),
(113, 'View Home Page', 'admin', 7, 'View', 15, NULL, 0, '2021-03-18 13:27:58', '2021-03-18 19:04:35'),
(114, 'Update Home Page', 'admin', 8, 'Update', 15, NULL, 0, '2021-03-18 13:27:58', '2021-03-18 19:04:35'),
(115, 'Delete Home Page', 'admin', 9, 'Delete', 15, NULL, 0, '2021-03-18 13:27:58', '2021-03-18 19:04:35'),
(120, 'Create Home Page Sections', 'admin', 6, 'Create', 15, NULL, 0, '2021-03-18 19:05:12', '2021-03-18 19:05:12'),
(121, 'View Home Page Sections', 'admin', 7, 'View', 15, NULL, 0, '2021-03-18 19:05:12', '2021-03-18 19:05:12'),
(122, 'Update Home Page Sections', 'admin', 8, 'Update', 15, NULL, 0, '2021-03-18 19:05:12', '2021-03-18 19:05:12'),
(123, 'Delete Home Page Sections', 'admin', 9, 'Delete', 15, NULL, 0, '2021-03-18 19:05:12', '2021-03-18 19:05:12'),
(124, 'Create Home Page Section Types', 'admin', 6, 'Create', 11, 18, 0, '2021-03-19 14:56:32', '2021-03-19 14:56:32'),
(125, 'View Home Page Section Types', 'admin', 7, 'View', 11, 18, 0, '2021-03-19 14:56:32', '2021-03-19 14:56:32'),
(126, 'Update Home Page Section Types', 'admin', 8, 'Update', 11, 18, 0, '2021-03-19 14:56:32', '2021-03-19 14:56:32'),
(127, 'Delete Home Page Section Types', 'admin', 9, 'Delete', 11, 18, 0, '2021-03-19 14:56:33', '2021-03-19 14:56:33'),
(128, 'Create Footer Content', 'admin', 6, 'Create', 16, NULL, 0, '2021-03-22 13:13:41', '2021-03-23 18:51:35'),
(129, 'View Footer Content', 'admin', 7, 'View', 16, NULL, 0, '2021-03-22 13:13:41', '2021-03-23 18:51:35'),
(130, 'Update Footer Content', 'admin', 8, 'Update', 16, NULL, 0, '2021-03-22 13:13:41', '2021-03-23 18:51:35'),
(131, 'Delete Footer Content', 'admin', 9, 'Delete', 16, NULL, 0, '2021-03-22 13:13:41', '2021-03-23 18:51:35'),
(132, 'Create Featured Products', 'admin', 6, 'Create', 11, 19, 0, '2021-03-23 18:52:24', '2021-03-23 18:52:24'),
(133, 'View Featured Products', 'admin', 7, 'View', 11, 19, 0, '2021-03-23 18:52:24', '2021-03-23 18:52:24'),
(134, 'Update Featured Products', 'admin', 8, 'Update', 11, 19, 0, '2021-03-23 18:52:24', '2021-03-23 18:52:24'),
(135, 'Delete Featured Products', 'admin', 9, 'Delete', 11, 19, 0, '2021-03-23 18:52:25', '2021-03-23 18:52:25'),
(136, 'Create Footer', 'admin', 6, 'Create', 11, 20, 0, '2021-04-19 20:15:36', '2021-04-19 20:15:36'),
(137, 'View Footer', 'admin', 7, 'View', 11, 20, 0, '2021-04-19 20:15:36', '2021-04-19 20:15:36'),
(138, 'Update Footer', 'admin', 8, 'Update', 11, 20, 0, '2021-04-19 20:15:36', '2021-04-19 20:15:36'),
(139, 'Delete Footer', 'admin', 9, 'Delete', 11, 20, 0, '2021-04-19 20:15:38', '2021-04-19 20:15:38'),
(140, 'Create Header Note', 'admin', 6, 'Create', 11, 21, 0, '2021-05-26 00:23:29', '2021-05-26 00:23:29'),
(141, 'View Header Note', 'admin', 7, 'View', 11, 21, 0, '2021-05-26 00:23:30', '2021-05-26 00:23:30'),
(142, 'Update Header Note', 'admin', 8, 'Update', 11, 21, 0, '2021-05-26 00:23:30', '2021-05-26 00:23:30'),
(143, 'Delete Header Note', 'admin', 9, 'Delete', 11, 21, 0, '2021-05-26 00:23:32', '2021-05-26 00:23:32'),
(144, 'Create Coupons', 'admin', 6, 'Create', 17, NULL, 0, '2021-05-26 00:28:01', '2021-05-26 00:28:01'),
(145, 'View Coupons', 'admin', 7, 'View', 17, NULL, 0, '2021-05-26 00:28:01', '2021-05-26 00:28:01'),
(146, 'Update Coupons', 'admin', 8, 'Update', 17, NULL, 0, '2021-05-26 00:28:01', '2021-05-26 00:28:01'),
(147, 'Delete Coupons', 'admin', 9, 'Delete', 17, NULL, 0, '2021-05-26 00:28:02', '2021-05-26 00:28:02'),
(148, 'Create Orders', 'admin', 6, 'Create', 18, NULL, 0, '2021-08-03 18:58:02', '2021-08-03 18:58:02'),
(149, 'View Orders', 'admin', 7, 'View', 18, NULL, 0, '2021-08-03 18:58:02', '2021-08-03 18:58:02'),
(150, 'Update Orders', 'admin', 8, 'Update', 18, NULL, 0, '2021-08-03 18:58:02', '2021-08-03 18:58:02'),
(151, 'Delete Orders', 'admin', 9, 'Delete', 18, NULL, 0, '2021-08-03 18:58:04', '2021-08-03 18:58:04'),
(152, 'Create Missing Payments', 'admin', 6, 'Create', 19, NULL, 0, '2021-08-03 18:59:42', '2021-08-03 18:59:42'),
(153, 'View Missing Payments', 'admin', 7, 'View', 19, NULL, 0, '2021-08-03 18:59:43', '2021-08-03 18:59:43'),
(154, 'Update Missing Payments', 'admin', 8, 'Update', 19, NULL, 0, '2021-08-03 18:59:43', '2021-08-03 18:59:43'),
(155, 'Delete Missing Payments', 'admin', 9, 'Delete', 19, NULL, 0, '2021-08-03 18:59:44', '2021-08-03 18:59:44'),
(156, 'Create Reviews', 'admin', 6, 'Create', 20, NULL, 0, '2021-08-03 19:01:38', '2021-08-03 19:01:38'),
(157, 'View Reviews', 'admin', 7, 'View', 20, NULL, 0, '2021-08-03 19:01:38', '2021-08-03 19:01:38'),
(158, 'Update Reviews', 'admin', 8, 'Update', 20, NULL, 0, '2021-08-03 19:01:38', '2021-08-03 19:01:38'),
(159, 'Delete Reviews', 'admin', 9, 'Delete', 20, NULL, 0, '2021-08-03 19:01:40', '2021-08-03 19:01:40'),
(160, 'Create Newsletters', 'admin', 6, 'Create', 21, NULL, 0, '2021-08-03 19:03:36', '2021-08-03 19:03:36'),
(161, 'View Newsletters', 'admin', 7, 'View', 21, NULL, 0, '2021-08-03 19:03:37', '2021-08-03 19:03:37'),
(162, 'Update Newsletters', 'admin', 8, 'Update', 21, NULL, 0, '2021-08-03 19:03:37', '2021-08-03 19:03:37'),
(163, 'Delete Newsletters', 'admin', 9, 'Delete', 21, NULL, 0, '2021-08-03 19:03:38', '2021-08-03 19:03:38'),
(164, 'Create COD Management', 'admin', 6, 'Create', 11, 22, 0, '2021-09-14 17:40:12', '2021-09-14 17:40:12'),
(165, 'View COD Management', 'admin', 7, 'View', 11, 22, 0, '2021-09-14 17:40:12', '2021-09-14 17:40:12'),
(166, 'Update COD Management', 'admin', 8, 'Update', 11, 22, 0, '2021-09-14 17:40:12', '2021-09-14 17:40:12'),
(167, 'Delete COD Management', 'admin', 9, 'Delete', 11, 22, 0, '2021-09-14 17:40:14', '2021-09-14 17:40:14'),
(168, 'Create Order Return Management', 'admin', 6, 'Create', 30, 28, 0, '2021-09-14 18:11:52', '2022-03-30 20:37:26'),
(169, 'View Order Return Management', 'admin', 7, 'View', 30, 28, 0, '2021-09-14 18:11:53', '2022-03-30 20:37:26'),
(170, 'Update Order Return Management', 'admin', 8, 'Update', 30, 28, 0, '2021-09-14 18:11:53', '2022-03-30 20:37:26'),
(171, 'Delete Order Return Management', 'admin', 9, 'Delete', 30, 28, 0, '2021-09-14 18:11:54', '2022-03-30 20:37:26'),
(172, 'Create Internal Users', 'admin', 6, 'Create', 22, 24, 0, '2021-09-14 18:13:36', '2021-09-14 18:14:11'),
(173, 'View Internal Users', 'admin', 7, 'View', 22, 24, 0, '2021-09-14 18:13:36', '2021-09-14 18:14:11'),
(174, 'Update Internal Users', 'admin', 8, 'Update', 22, 24, 0, '2021-09-14 18:13:38', '2021-09-14 18:14:11'),
(175, 'Delete Internal Users', 'admin', 9, 'Delete', 22, 24, 0, '2021-09-14 18:13:39', '2021-09-14 18:14:11'),
(176, 'Create Students', 'admin', 6, 'Create', 24, NULL, 0, '2021-09-14 18:14:44', '2023-01-28 10:08:49'),
(177, 'View Students', 'admin', 7, 'View', 24, NULL, 0, '2021-09-14 18:14:44', '2023-01-28 10:08:49'),
(178, 'Update Students', 'admin', 8, 'Update', 24, NULL, 0, '2021-09-14 18:14:45', '2023-01-28 10:08:49'),
(179, 'Delete Students', 'admin', 9, 'Delete', 24, NULL, 0, '2021-09-14 18:14:46', '2023-01-28 10:08:49'),
(180, 'Create Special Deals', 'admin', 6, 'Create', 11, 25, 0, '2021-09-15 15:09:49', '2021-09-15 15:09:49'),
(181, 'View Special Deals', 'admin', 7, 'View', 11, 25, 0, '2021-09-15 15:09:49', '2021-09-15 15:09:49'),
(182, 'Update Special Deals', 'admin', 8, 'Update', 11, 25, 0, '2021-09-15 15:09:51', '2021-09-15 15:09:51'),
(183, 'Delete Special Deals', 'admin', 9, 'Delete', 11, 25, 0, '2021-09-15 15:09:51', '2021-09-15 15:09:51'),
(184, 'Create Teacher', 'admin', 6, 'Create', 25, NULL, 0, '2021-09-15 15:26:17', '2023-01-28 10:31:58'),
(185, 'View Teacher', 'admin', 7, 'View', 25, NULL, 0, '2021-09-15 15:26:17', '2023-01-28 10:31:58'),
(186, 'Update Teacher', 'admin', 8, 'Update', 25, NULL, 0, '2021-09-15 15:26:19', '2023-01-28 10:31:58'),
(187, 'Delete Teacher', 'admin', 9, 'Delete', 25, NULL, 0, '2021-09-15 15:26:19', '2023-01-28 10:31:58'),
(188, 'Create Order Cancel Management', 'admin', 6, 'Create', 30, 26, 0, '2021-10-13 14:26:15', '2022-02-17 23:39:20'),
(189, 'View Order Cancel Management', 'admin', 7, 'View', 30, 26, 0, '2021-10-13 14:26:15', '2022-02-17 23:39:20'),
(190, 'Update Order Cancel Management', 'admin', 8, 'Update', 30, 26, 0, '2021-10-13 14:26:17', '2022-02-17 23:39:20'),
(191, 'Delete Order Cancel Management', 'admin', 9, 'Delete', 30, 26, 0, '2021-10-13 14:26:17', '2022-02-17 23:39:20'),
(192, 'Create Company Master', 'admin', 6, 'Create', 11, 27, 0, '2021-10-13 21:17:52', '2021-10-13 21:17:52'),
(193, 'View Company Master', 'admin', 7, 'View', 11, 27, 0, '2021-10-13 21:17:52', '2021-10-13 21:17:52'),
(194, 'Update Company Master', 'admin', 8, 'Update', 11, 27, 0, '2021-10-13 21:17:54', '2021-10-13 21:17:54'),
(195, 'Delete Company Master', 'admin', 9, 'Delete', 11, 27, 0, '2021-10-13 21:17:54', '2021-10-13 21:17:54'),
(196, 'Create GST', 'admin', 6, 'Create', 27, NULL, 0, '2021-10-13 22:12:25', '2021-10-13 22:12:25'),
(197, 'View GST', 'admin', 7, 'View', 27, NULL, 0, '2021-10-13 22:12:25', '2021-10-13 22:12:25'),
(198, 'Update GST', 'admin', 8, 'Update', 27, NULL, 0, '2021-10-13 22:12:27', '2021-10-13 22:12:27'),
(199, 'Delete GST', 'admin', 9, 'Delete', 27, NULL, 0, '2021-10-13 22:12:27', '2021-10-13 22:12:27'),
(200, 'Create Order Delivery Management', 'admin', 6, 'Create', 30, 23, 0, '2021-11-01 20:40:29', '2022-03-30 20:37:20'),
(201, 'View Order Delivery Management', 'admin', 7, 'View', 30, 23, 0, '2021-11-01 20:40:30', '2022-03-30 20:37:20'),
(202, 'Update Order Delivery Management', 'admin', 8, 'Update', 30, 23, 0, '2021-11-01 20:40:31', '2022-03-30 20:37:20'),
(203, 'Delete Order Delivery Management', 'admin', 9, 'Delete', 30, 23, 0, '2021-11-01 20:40:31', '2022-03-30 20:37:20'),
(204, 'Create HSN Codes', 'admin', 6, 'Create', 28, NULL, 0, '2021-11-01 20:53:43', '2021-11-01 21:27:11'),
(205, 'View HSN Codes', 'admin', 7, 'View', 28, NULL, 0, '2021-11-01 20:53:44', '2021-11-01 21:27:11'),
(206, 'Update HSN Codes', 'admin', 8, 'Update', 28, NULL, 0, '2021-11-01 20:53:46', '2021-11-01 21:27:11'),
(207, 'Delete HSN Codes', 'admin', 9, 'Delete', 28, NULL, 0, '2021-11-01 20:53:46', '2021-11-01 21:27:11'),
(208, 'Create Materials', 'admin', 6, 'Create', 11, 30, 0, '2021-11-01 20:55:30', '2021-11-01 20:55:30'),
(209, 'View Materials', 'admin', 7, 'View', 11, 30, 0, '2021-11-01 20:55:32', '2021-11-01 20:55:32'),
(210, 'Update Materials', 'admin', 8, 'Update', 11, 30, 0, '2021-11-01 20:55:32', '2021-11-01 20:55:32'),
(211, 'Delete Materials', 'admin', 9, 'Delete', 11, 30, 0, '2021-11-01 20:55:33', '2021-11-01 20:55:33'),
(212, 'Create Shiping Charges', 'admin', 6, 'Create', 11, 31, 0, '2021-11-02 02:21:46', '2021-11-02 02:21:46'),
(213, 'View Shiping Charges', 'admin', 7, 'View', 11, 31, 0, '2021-11-02 02:21:47', '2021-11-02 02:21:47'),
(214, 'Update Shiping Charges', 'admin', 8, 'Update', 11, 31, 0, '2021-11-02 02:21:48', '2021-11-02 02:21:48'),
(215, 'Delete Shiping Charges', 'admin', 9, 'Delete', 11, 31, 0, '2021-11-02 02:21:48', '2021-11-02 02:21:48'),
(216, 'Create Filter Assign', 'admin', 6, 'Create', 29, 33, 0, '2021-11-02 19:07:36', '2022-02-07 23:07:56'),
(217, 'View Filter Assign', 'admin', 7, 'View', 29, 33, 0, '2021-11-02 19:07:37', '2022-02-07 23:07:56'),
(218, 'Update Filter Assign', 'admin', 8, 'Update', 29, 33, 0, '2021-11-02 19:07:38', '2022-02-07 23:07:56'),
(219, 'Delete Filter Assign', 'admin', 9, 'Delete', 29, 33, 0, '2021-11-02 19:07:38', '2022-02-07 23:07:56'),
(220, 'Create Filters & Values', 'admin', 6, 'Create', 29, 11, 0, '2022-02-07 23:08:10', '2022-02-07 23:08:10'),
(221, 'View Filters & Values', 'admin', 7, 'View', 29, 11, 0, '2022-02-07 23:08:11', '2022-02-07 23:08:11'),
(222, 'Update Filters & Values', 'admin', 8, 'Update', 29, 11, 0, '2022-02-07 23:08:11', '2022-02-07 23:08:11'),
(223, 'Delete Filters & Values', 'admin', 9, 'Delete', 29, 11, 0, '2022-02-07 23:08:15', '2022-02-07 23:08:15'),
(224, 'Create Order Cancel Reasons', 'admin', 6, 'Create', 30, 34, 0, '2022-02-17 23:40:12', '2022-02-17 23:40:12'),
(225, 'View Order Cancel Reasons', 'admin', 7, 'View', 30, 34, 0, '2022-02-17 23:40:13', '2022-02-17 23:40:13'),
(226, 'Update Order Cancel Reasons', 'admin', 8, 'Update', 30, 34, 0, '2022-02-17 23:40:13', '2022-02-17 23:40:13'),
(227, 'Delete Order Cancel Reasons', 'admin', 9, 'Delete', 30, 34, 0, '2022-02-17 23:40:16', '2022-02-17 23:40:16'),
(228, 'Create Order Return Reasons', 'admin', 6, 'Create', 30, 35, 0, '2022-02-17 23:41:39', '2022-02-17 23:41:55'),
(229, 'View Order Return Reasons', 'admin', 7, 'View', 30, 35, 0, '2022-02-17 23:41:39', '2022-02-17 23:41:55'),
(230, 'Update Order Return Reasons', 'admin', 8, 'Update', 30, 35, 0, '2022-02-17 23:41:42', '2022-02-17 23:41:55'),
(231, 'Delete Order Return Reasons', 'admin', 9, 'Delete', 30, 35, 0, '2022-02-17 23:41:42', '2022-02-17 23:41:55'),
(232, 'Create Frontend Images', 'admin', 6, 'Create', 11, 36, 0, '2022-03-09 01:42:48', '2022-03-09 01:49:05'),
(233, 'View Frontend Images', 'admin', 7, 'View', 11, 36, 0, '2022-03-09 01:42:49', '2022-03-09 01:49:05'),
(234, 'Update Frontend Images', 'admin', 8, 'Update', 11, 36, 0, '2022-03-09 01:42:49', '2022-03-09 01:49:05'),
(235, 'Delete Frontend Images', 'admin', 9, 'Delete', 11, 36, 0, '2022-03-09 01:42:52', '2022-03-09 01:49:05'),
(236, 'Create Hot Offers', 'admin', 6, 'Create', 31, NULL, 0, '2022-04-06 18:51:16', '2022-04-06 18:51:16'),
(237, 'View Hot Offers', 'admin', 7, 'View', 31, NULL, 0, '2022-04-06 18:51:16', '2022-04-06 18:51:16'),
(238, 'Update Hot Offers', 'admin', 8, 'Update', 31, NULL, 0, '2022-04-06 18:51:19', '2022-04-06 18:51:19'),
(239, 'Delete Hot Offers', 'admin', 9, 'Delete', 31, NULL, 0, '2022-04-06 18:51:19', '2022-04-06 18:51:19'),
(240, 'Create Download App', 'admin', 6, 'Create', 11, 37, 0, '2022-05-23 20:44:47', '2022-05-23 20:44:47'),
(241, 'View Download App', 'admin', 7, 'View', 11, 37, 0, '2022-05-23 20:44:48', '2022-05-23 20:44:48'),
(242, 'Update Download App', 'admin', 8, 'Update', 11, 37, 0, '2022-05-23 20:44:48', '2022-05-23 20:44:48'),
(243, 'Delete Download App', 'admin', 9, 'Delete', 11, 37, 0, '2022-05-23 20:44:52', '2022-05-23 20:44:52'),
(244, 'Create Login Management', 'admin', 6, 'Create', 11, 38, 0, '2022-06-29 19:26:06', '2022-06-29 19:26:06'),
(245, 'View Login Management', 'admin', 7, 'View', 11, 38, 0, '2022-06-29 19:26:07', '2022-06-29 19:26:07'),
(246, 'Update Login Management', 'admin', 8, 'Update', 11, 38, 0, '2022-06-29 19:26:08', '2022-06-29 19:26:08'),
(247, 'Delete Login Management', 'admin', 9, 'Delete', 11, 38, 0, '2022-06-29 19:26:09', '2022-06-29 19:26:09'),
(250, 'View Down', 'admin', 7, 'View', 32, 39, 0, '2022-07-07 01:41:18', '2022-07-07 01:41:18'),
(251, 'Update Down', 'admin', 8, 'Update', 32, 39, 0, '2022-07-07 01:41:20', '2022-07-07 01:41:20'),
(252, 'View Up', 'admin', 7, 'View', 32, 40, 0, '2022-07-07 01:41:47', '2022-07-07 01:41:47'),
(253, 'Update Up', 'admin', 8, 'Update', 32, 40, 0, '2022-07-07 01:41:48', '2022-07-07 01:41:48'),
(254, 'Create school Master', 'admin', 6, 'Create', 11, 38, 0, '2022-09-15 07:14:25', '2022-09-15 07:14:25'),
(255, 'View school Master', 'admin', 7, 'View', 11, 38, 0, '2022-09-15 07:14:25', '2022-09-15 07:14:25'),
(256, 'Update school Master', 'admin', 8, 'Update', 11, 38, 0, '2022-09-15 07:14:26', '2022-09-15 07:14:26'),
(257, 'Delete school Master', 'admin', 9, 'Delete', 11, 38, 0, '2022-09-15 07:14:26', '2022-09-15 07:14:26'),
(258, 'Create Year Master', 'admin', 6, 'Create', 11, 42, 0, '2022-09-15 07:15:29', '2022-09-15 07:15:29'),
(259, 'View Year Master', 'admin', 7, 'View', 11, 42, 0, '2022-09-15 07:15:29', '2022-09-15 07:15:29'),
(260, 'Update Year Master', 'admin', 8, 'Update', 11, 42, 0, '2022-09-15 07:15:29', '2022-09-15 07:15:29'),
(261, 'Delete Year Master', 'admin', 9, 'Delete', 11, 42, 0, '2022-09-15 07:15:29', '2022-09-15 07:15:29'),
(262, 'Create Academic Year', 'admin', 6, 'Create', 11, 43, 0, '2022-09-15 07:15:36', '2022-09-15 07:15:36'),
(263, 'View Academic Year', 'admin', 7, 'View', 11, 43, 0, '2022-09-15 07:15:36', '2022-09-15 07:15:36'),
(264, 'Update Academic Year', 'admin', 8, 'Update', 11, 43, 0, '2022-09-15 07:15:36', '2022-09-15 07:15:36'),
(265, 'Delete Academic Year', 'admin', 9, 'Delete', 11, 43, 0, '2022-09-15 07:15:37', '2022-09-15 07:15:37'),
(266, 'Create Subjects', 'admin', 6, 'Create', 11, 53, 0, '2023-01-28 10:11:09', '2023-01-28 10:11:09'),
(267, 'View Subjects', 'admin', 7, 'View', 11, 53, 0, '2023-01-28 10:11:10', '2023-01-28 10:11:10'),
(268, 'Update Subjects', 'admin', 8, 'Update', 11, 53, 0, '2023-01-28 10:11:10', '2023-01-28 10:11:10'),
(269, 'Delete Subjects', 'admin', 9, 'Delete', 11, 53, 0, '2023-01-28 10:11:10', '2023-01-28 10:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_ids` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submenu_ids` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sub` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `menu_ids`, `submenu_ids`, `is_sub`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '24,25,11,6,22', '43,52,53,24', 1, '2020-11-19 13:17:45', '2023-01-28 10:32:11'),
(5, 'Manager', 'admin', '1,2', '38,42,46,50,51', 1, '2020-11-20 12:48:41', '2022-11-29 05:08:07'),
(9, 'Demo User', 'admin', '11', '38,42', 1, '2021-02-04 15:11:08', '2022-11-29 03:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) DEFAULT NULL,
  `submenu_id` bigint(20) DEFAULT NULL,
  `is_sub` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`, `menu_id`, `submenu_id`, `is_sub`) VALUES
(52, 1, NULL, NULL, NULL),
(85, 1, NULL, NULL, NULL),
(86, 1, NULL, NULL, NULL),
(87, 1, NULL, NULL, NULL),
(172, 1, NULL, NULL, NULL),
(173, 1, NULL, NULL, NULL),
(174, 1, NULL, NULL, NULL),
(175, 1, NULL, NULL, NULL),
(176, 1, NULL, NULL, NULL),
(177, 1, NULL, NULL, NULL),
(178, 1, NULL, NULL, NULL),
(179, 1, NULL, NULL, NULL),
(184, 1, NULL, NULL, NULL),
(185, 1, NULL, NULL, NULL),
(186, 1, NULL, NULL, NULL),
(187, 1, NULL, NULL, NULL),
(254, 9, NULL, NULL, NULL),
(255, 9, NULL, NULL, NULL),
(256, 9, NULL, NULL, NULL),
(257, 9, NULL, NULL, NULL),
(258, 5, NULL, NULL, NULL),
(259, 5, NULL, NULL, NULL),
(262, 1, NULL, NULL, NULL),
(263, 1, NULL, NULL, NULL),
(263, 5, NULL, NULL, NULL),
(264, 1, NULL, NULL, NULL),
(265, 1, NULL, NULL, NULL),
(266, 1, NULL, NULL, NULL),
(267, 1, NULL, NULL, NULL),
(268, 1, NULL, NULL, NULL),
(269, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `address` text,
  `gender` varchar(10) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `parents_mobile_no` varchar(255) DEFAULT NULL,
  `father_occupation` varchar(255) DEFAULT NULL,
  `mother_occupation` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `icome` int(11) NOT NULL,
  `previous_school` varchar(255) DEFAULT NULL,
  `last_exam` varchar(255) DEFAULT NULL,
  `last_year_percentage` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `father_name`, `mother_name`, `address`, `gender`, `mobile_no`, `email`, `parents_mobile_no`, `father_occupation`, `mother_occupation`, `date_of_birth`, `icome`, `previous_school`, `last_exam`, `last_year_percentage`, `picture`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'aaa', NULL, NULL, NULL, 'Male', 'aaa', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2023-02-14 16:50:31', '2023-02-18 14:07:20', NULL),
(2, 'student2', NULL, NULL, NULL, 'Male', '1122334455', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, '2023-02-15 16:17:26', '2023-02-15 16:17:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` int(11) DEFAULT NULL,
  `subject_name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `batch_id`, `subject_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'math 6', NULL, '2023-01-28 16:35:04', '2023-01-28 16:49:28', NULL),
(2, 1, 'science 9', NULL, '2023-01-28 16:43:04', '2023-01-28 16:58:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_name` varchar(255) DEFAULT NULL,
  `visibility` int(11) DEFAULT NULL,
  `subcategory_details` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sub_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `edu_details` text,
  `address` text,
  `picture` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `full_name`, `email`, `mobile`, `dob`, `gender`, `edu_details`, `address`, `picture`, `resume`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'Naresh mangal dhumal', 'aaaa', '99999', '9999', 'Male', '9999', 'at- goveli, post-rayate, tal-kalyan, dist-thane, 421301', 'img_9_102627.png', 'res_9_102353.pdf', 1, '2023-02-01 17:18:01', '2023-02-07 16:56:27', NULL),
(10, 'ankita', 'ankita@gmail.com', '9876987678', '10/01/2005', 'Female', 'ssjdsxmn', 'dsmnnb,wmdschn,fjwqN', 'img_10_095045.png', 'res_10_095045.pdf', 1, '2023-02-11 04:20:45', '2023-02-11 04:20:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_documents`
--

DROP TABLE IF EXISTS `teacher_documents`;
CREATE TABLE IF NOT EXISTS `teacher_documents` (
  `teacher_document_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `doc_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`teacher_document_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_documents`
--

INSERT INTO `teacher_documents` (`teacher_document_id`, `teacher_id`, `doc_name`, `doc_file`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 'jjh', 'doc_082523.pdf', '2023-02-11 14:55:23', '2023-02-11 14:55:23', NULL),
(2, 9, 'jjh', 'doc_082558.pdf', '2023-02-11 14:55:58', '2023-02-11 15:51:38', '2023-02-11 15:51:38'),
(3, 9, 'jjh', 'doc_082617.pdf', '2023-02-11 14:56:17', '2023-02-11 15:52:14', '2023-02-11 15:52:14'),
(4, 9, 'jjh', 'doc_082658.pdf', '2023-02-11 14:56:58', '2023-02-11 14:56:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_education`
--

DROP TABLE IF EXISTS `teacher_education`;
CREATE TABLE IF NOT EXISTS `teacher_education` (
  `teacher_education_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `institute` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`teacher_education_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_education`
--

INSERT INTO `teacher_education` (`teacher_education_id`, `teacher_id`, `course`, `institute`, `year`, `remark`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 'y', 'y', 'y', 'y', '2023-02-04 17:21:53', '2023-02-04 17:52:02', '2023-02-04 17:52:02'),
(2, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:21:53', '2023-02-04 17:52:02', '2023-02-04 17:52:02'),
(3, 9, 'y', 'y', 'y', 'y', '2023-02-04 17:51:32', '2023-02-04 17:52:02', '2023-02-04 17:52:02'),
(4, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:51:32', '2023-02-04 17:52:02', '2023-02-04 17:52:02'),
(5, 9, 'y', 'y', 'y', 'y', '2023-02-04 17:52:02', '2023-02-04 17:52:23', '2023-02-04 17:52:23'),
(6, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:52:02', '2023-02-04 17:52:23', '2023-02-04 17:52:23'),
(7, 9, 'y', 'y', 'y', 'y', '2023-02-04 17:52:02', '2023-02-04 17:52:23', '2023-02-04 17:52:23'),
(8, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:52:02', '2023-02-04 17:52:23', '2023-02-04 17:52:23'),
(9, 9, 'y', 'y', 'y', 'y', '2023-02-04 17:52:23', '2023-02-04 17:54:33', '2023-02-04 17:54:33'),
(10, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:52:23', '2023-02-04 17:54:33', '2023-02-04 17:54:33'),
(11, 9, 'ccc', 'cc', 'cc', 'cc', '2023-02-04 17:52:23', '2023-02-04 17:54:33', '2023-02-04 17:54:33'),
(12, 9, 'dd', 'dd', 'dd', 'dd', '2023-02-04 17:52:23', '2023-02-04 17:54:33', '2023-02-04 17:54:33'),
(13, 9, 'y', 'y', 'y', 'y', '2023-02-04 17:54:33', '2023-02-04 17:54:51', '2023-02-04 17:54:51'),
(14, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:54:33', '2023-02-04 17:54:51', '2023-02-04 17:54:51'),
(15, 9, 'ccc', 'cc', 'cc', 'cc', '2023-02-04 17:54:33', '2023-02-04 17:54:51', '2023-02-04 17:54:51'),
(16, 9, 'dd', 'dd', 'dd', 'dd', '2023-02-04 17:54:33', '2023-02-04 17:54:51', '2023-02-04 17:54:51'),
(17, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:54:51', '2023-02-04 17:56:04', '2023-02-04 17:56:04'),
(18, 9, NULL, NULL, NULL, NULL, '2023-02-04 17:54:51', '2023-02-04 17:56:04', '2023-02-04 17:56:04'),
(19, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:56:59', '2023-02-04 17:57:09', '2023-02-04 17:57:09'),
(20, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:57:09', '2023-02-04 17:57:14', '2023-02-04 17:57:14'),
(21, 9, 'aa', 'aa', 'aa', 'aa', '2023-02-04 17:57:09', '2023-02-04 17:57:14', '2023-02-04 17:57:14'),
(22, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:57:14', '2023-02-04 17:57:45', '2023-02-04 17:57:45'),
(23, 9, 'aa', 'aa', 'aa', 'aa', '2023-02-04 17:57:14', '2023-02-04 17:57:45', '2023-02-04 17:57:45'),
(24, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:57:45', '2023-02-04 17:57:52', '2023-02-04 17:57:52'),
(25, 9, 'aa', 'aa', 'aa', 'aa', '2023-02-04 17:57:45', '2023-02-04 17:57:52', '2023-02-04 17:57:52'),
(26, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:57:52', '2023-02-04 17:57:58', '2023-02-04 17:57:58'),
(27, 9, 'aa', 'aa', 'aa', 'aa', '2023-02-04 17:57:52', '2023-02-04 17:57:58', '2023-02-04 17:57:58'),
(28, 9, 'b', 'b', 'b', 'd', '2023-02-04 17:57:58', '2023-02-05 06:41:45', '2023-02-05 06:41:45'),
(29, 9, 'aa', 'aa', 'aa', 'aa', '2023-02-04 17:57:58', '2023-02-05 06:41:45', '2023-02-05 06:41:45'),
(30, 9, 'b', 'b', 'b', 'd', '2023-02-05 06:41:45', '2023-02-07 16:29:41', '2023-02-07 16:29:41'),
(31, 9, 'aa', 'aa', 'aa', 'aa', '2023-02-05 06:41:45', '2023-02-07 16:29:41', '2023-02-07 16:29:41'),
(32, 9, 'b', 'b', 'b', 'd', '2023-02-07 16:29:41', '2023-02-07 16:29:53', '2023-02-07 16:29:53'),
(33, 9, 'aa', 'aa', 'aa', 'aa', '2023-02-07 16:29:41', '2023-02-07 16:29:53', '2023-02-07 16:29:53'),
(34, 9, 'b', 'b', 'b', 'd', '2023-02-07 16:29:53', '2023-02-07 16:30:19', '2023-02-07 16:30:19'),
(35, 9, 'aa', 'aa', 'aa', 'aa', '2023-02-07 16:29:53', '2023-02-07 16:30:19', '2023-02-07 16:30:19'),
(36, 9, 'b', 'b', 'b', 'd', '2023-02-07 16:30:19', '2023-02-07 16:31:29', '2023-02-07 16:31:29'),
(37, 9, 'aa', 'aa', 'aa', 'aa', '2023-02-07 16:30:19', '2023-02-07 16:31:29', '2023-02-07 16:31:29'),
(38, 9, 'b', 'b', 'b', 'd', '2023-02-07 16:31:29', '2023-02-07 16:31:42', '2023-02-07 16:31:42'),
(39, 9, 'aa', 'aa', 'aa', 'aa', '2023-02-07 16:31:29', '2023-02-07 16:31:42', '2023-02-07 16:31:42'),
(40, 9, 'b', 'b', 'b', 'd', '2023-02-07 16:31:42', '2023-02-07 16:56:41', '2023-02-07 16:56:41'),
(41, 9, 'aa', 'aa', 'aa', 'aa', '2023-02-07 16:31:42', '2023-02-07 16:56:41', '2023-02-07 16:56:41'),
(42, 9, 'ccc', 'ccc', 'ccc', 'ccc', '2023-02-07 16:31:42', '2023-02-07 16:56:41', '2023-02-07 16:56:41'),
(43, 9, 'b', 'b', 'b', 'd', '2023-02-07 16:56:41', '2023-02-07 17:00:14', '2023-02-07 17:00:14'),
(44, 9, 'aa', 'aa', 'aa', 'aa', '2023-02-07 16:56:41', '2023-02-07 17:00:14', '2023-02-07 17:00:14'),
(45, 9, 'ccc', 'ccc', 'ccc', 'ccc', '2023-02-07 16:56:41', '2023-02-07 17:00:14', '2023-02-07 17:00:14'),
(46, 9, 'b', 'b', 'b', 'd', '2023-02-07 17:00:14', '2023-02-07 17:00:29', '2023-02-07 17:00:29'),
(47, 9, 'ccc', 'ccc', 'ccc', 'ccc', '2023-02-07 17:00:14', '2023-02-07 17:00:29', '2023-02-07 17:00:29'),
(48, 9, 'b', 'b', 'b', 'd', '2023-02-07 17:00:29', '2023-02-07 17:00:35', '2023-02-07 17:00:35'),
(49, 9, 'ccc', 'ccc', 'ccc', 'ccc', '2023-02-07 17:00:29', '2023-02-07 17:00:35', '2023-02-07 17:00:35'),
(50, 9, 'ee', 'ff', 'ff', 'fff', '2023-02-07 17:00:29', '2023-02-07 17:00:35', '2023-02-07 17:00:35'),
(51, 9, 'rr', 'rr', 'rr', 'rr', '2023-02-07 17:00:29', '2023-02-07 17:00:35', '2023-02-07 17:00:35'),
(52, 9, 'b', 'b', 'b', 'd', '2023-02-07 17:00:35', '2023-02-07 17:00:35', NULL),
(53, 9, 'ee', 'ff', 'ff', 'fff', '2023-02-07 17:00:35', '2023-02-07 17:00:35', NULL),
(54, 9, 'rr', 'rr', 'rr', 'rr', '2023-02-07 17:00:35', '2023-02-07 17:00:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE IF NOT EXISTS `user_activity` (
  `user_activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `session_id` text,
  `login time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_time` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`user_activity_id`, `user_id`, `user_name`, `session_id`, `login time`, `logout_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 1, 'admin user', 'cris0Ms8GMFyFieOVFXFvupCd0Ba7pz9ZISV5kat', '2022-12-06 04:10:59', '2022-12-06 09:57:51', '2022-12-06 04:10:59', '2022-12-06 04:27:51', NULL),
(11, 1, 'admin user', 'RrhYGyrSwMkgNPUQwSSZbuUICM3B5RhQvqbJzQuq', '2022-12-06 04:28:29', '2022-12-06 09:59:19', '2022-12-06 04:28:29', '2022-12-06 04:29:19', NULL),
(12, 1, 'admin user', 'z4fyj3hBfSodCWwVYedxD584GJdLDkfiE5EC2nnk', '2022-12-06 04:35:48', NULL, '2022-12-06 04:35:48', '2022-12-06 04:35:48', NULL),
(13, 1, 'admin user', 'bdPQluEAtPfsZgAtlVkUwtj2sfg6u8nblDdy9bcd', '2022-12-06 05:15:48', '2022-12-06 14:41:48', '2022-12-06 05:15:48', '2022-12-06 09:11:48', NULL),
(14, 1, 'admin user', 'g7MwbNJS2gGFQAyQPTE8vSIOXyGYKAOAfjW0uAvs', '2022-12-06 06:01:16', NULL, '2022-12-06 06:01:16', '2022-12-06 06:01:16', NULL),
(15, 1, 'admin user', 'n2fsvousdT3tbwynLdHOO0ntSEBOoLTtsLupq3yT', '2022-12-06 06:17:58', NULL, '2022-12-06 06:17:58', '2022-12-06 06:17:58', NULL),
(16, 1, 'admin user', 'RY47HNneKI2mAbKG7qs3Fk8Y4FHVVBAl7TSXDl6y', '2022-12-06 07:02:52', NULL, '2022-12-06 07:02:52', '2022-12-06 07:02:52', NULL),
(17, 1, 'admin user', '6sAbGlPs7DLfmUPNy8EE4Dq1KqzUgdmx7HOEMl1i', '2022-12-06 09:19:34', '2022-12-06 15:05:30', '2022-12-06 09:19:34', '2022-12-06 09:35:30', NULL),
(18, 1, 'admin user', 'dDYAVUPnqlnqKr7ufKLlhjjvtHkLv0EK1UZzIb3A', '2022-12-06 09:27:04', NULL, '2022-12-06 09:27:04', '2022-12-06 09:27:04', NULL),
(19, 1, 'admin user', 'nOP8FysFWYcwPr6DboPO5D0qwkDtjtdfv4KwLjsf', '2022-12-06 09:37:13', NULL, '2022-12-06 09:37:13', '2022-12-06 09:37:13', NULL),
(20, 1, 'admin user', 'hpDjIXHRg2lP6yEJKLXBkyFzfwyhZO6g2UxfwNxv', '2022-12-06 09:37:26', NULL, '2022-12-06 09:37:26', '2022-12-06 09:37:26', NULL),
(21, 1, 'admin user', 'fahJ7CzF4V87r8kctMhlqJlnojfKCfA5UVxFugbl', '2022-12-06 10:05:35', NULL, '2022-12-06 10:05:35', '2022-12-06 10:05:35', NULL),
(22, 1, 'admin user', 'WBe0MsCBVSHCxfZt0n842ltP1p3bxwoCHHDTbecj', '2022-12-06 10:31:55', '2022-12-06 16:06:20', '2022-12-06 10:31:55', '2022-12-06 10:36:20', NULL),
(23, 1, 'admin user', 'jbJJXsz41N2nyRn0db39ya4Gv8XXRo54YKRMu30B', '2022-12-06 11:23:00', '2022-12-06 16:57:19', '2022-12-06 11:23:00', '2022-12-06 11:27:19', NULL),
(24, 1, 'admin user', 'EEanaruMrpAJf824iffbwMvmhBcMx2jdBI9W9dva', '2022-12-06 11:36:37', NULL, '2022-12-06 11:36:36', '2022-12-06 11:36:36', NULL),
(25, 1, 'admin user', 'jBtoDfZ4KUAucyUjvLB4jWEAzznqHKTXiBEgUE29', '2022-12-07 04:16:37', '2022-12-07 13:00:57', '2022-12-07 04:16:37', '2022-12-07 07:30:57', NULL),
(26, 1, 'admin user', 'zONQAljHE9dFihlIvs1dmTKJhxO9zQEzc9USixBA', '2022-12-07 07:03:25', NULL, '2022-12-07 07:03:25', '2022-12-07 07:03:25', NULL),
(27, 1, 'admin user', 'XUuiP712GLWZmXutvTtm6SSGMugUxv1ZVbUfi0W8', '2022-12-07 08:14:21', NULL, '2022-12-07 08:14:21', '2022-12-07 08:14:21', NULL),
(28, 1, 'admin user', '6DAmPDtOOJSpeBfyHi4sDopxlJaHSifBMj90Ahyj', '2022-12-07 08:16:33', '2022-12-07 13:50:20', '2022-12-07 08:16:33', '2022-12-07 08:20:20', NULL),
(29, 1, 'admin user', 'XTcm6SY5UJyvsH9xvBSDLzdAJ3JCYF8nVHfCFfmA', '2022-12-07 09:42:04', '2022-12-07 15:44:18', '2022-12-07 09:42:04', '2022-12-07 10:14:18', NULL),
(30, 1, 'admin user', 'dzsXDnNNJ2PXsezygGL8oefyqmx25jb7Zp6Ctfkb', '2022-12-07 10:45:07', '2022-12-07 16:42:50', '2022-12-07 10:45:07', '2022-12-07 11:12:50', NULL),
(31, 1, 'admin user', 'o5Xz45wL3ldgCXKMaHFzpO5atQbfhfJBECwjjuzu', '2022-12-08 03:53:23', '2022-12-08 10:50:10', '2022-12-08 03:53:23', '2022-12-08 05:20:10', NULL),
(32, 1, 'admin user', 'UD8ayNunmevK1y2YE5G7g9CIAGdoUpxiWznFdwIP', '2022-12-08 04:39:38', NULL, '2022-12-08 04:39:38', '2022-12-08 04:39:38', NULL),
(33, 1, 'admin user', 'KKI8LctTWUtZPP0NSe7VmfJj9lhC6TwIm84Z772z', '2022-12-08 05:02:53', NULL, '2022-12-08 05:02:53', '2022-12-08 05:02:53', NULL),
(34, 1, 'admin user', '2BlKU8MZkxyBmzfM68nHDmItcjMbsyle70o3aAvb', '2022-12-08 05:45:22', '2022-12-08 13:29:57', '2022-12-08 05:45:22', '2022-12-08 07:59:57', NULL),
(35, 1, 'admin user', 'QZqV3C4pbkDcHVLjsCRtXyD7B6ZChV9dpGW39w6D', '2022-12-08 07:27:20', NULL, '2022-12-08 07:27:20', '2022-12-08 07:27:20', NULL),
(36, 1, 'admin user', 'K1zCbRSwfRyDDpYtFXXUQuqXLLzqqOOB4vOaOIBQ', '2022-12-08 08:43:04', '2022-12-08 14:59:26', '2022-12-08 08:43:04', '2022-12-08 09:29:26', NULL),
(37, 1, 'admin user', 'Bz2FVhSN3cKX8MT1Sx0YBo4K2Bel1yROGT0z0Ox1', '2022-12-08 09:58:35', NULL, '2022-12-08 09:58:35', '2022-12-08 09:58:35', NULL),
(38, 1, 'admin user', '2BmzHqEtmSPZsGHT2zWnM7nV994aaA6CzI5keSEf', '2022-12-08 10:54:44', NULL, '2022-12-08 10:54:44', '2022-12-08 10:54:44', NULL),
(39, 1, 'admin user', 'WL0P1cGhhYoG9sxC5XmzEccL07VrNqRyLvnS3Agx', '2022-12-09 07:34:56', '2022-12-09 13:07:36', '2022-12-09 07:34:56', '2022-12-09 07:37:36', NULL),
(40, 1, 'admin user', 'Axz74j3nHi4EM0XTkU0BmZ2FdwLhLUVTQ2WaQZEL', '2022-12-09 08:08:21', NULL, '2022-12-09 08:08:21', '2022-12-09 08:08:21', NULL),
(41, 1, 'admin user', 'Be6QK4Bs219Q7TBPx3lQBy2YyPJECMIAlyQcihIq', '2022-12-09 09:34:15', '2022-12-09 15:17:31', '2022-12-09 09:34:15', '2022-12-09 09:47:31', NULL),
(42, 1, 'admin user', '97HjEyinwLXfA2xXj6i8mI6A5IgNry7mEXsN7IYe', '2022-12-09 09:49:24', NULL, '2022-12-09 09:49:24', '2022-12-09 09:49:24', NULL),
(43, 1, 'admin user', 'uhoK4xpWA89nrLA9jIDiTVtcKRtVUPOYus9DQsLt', '2022-12-12 12:14:25', '2022-12-12 18:12:51', '2022-12-12 12:14:25', '2022-12-12 12:42:51', NULL),
(44, 1, 'admin user', 'yCKeTvDqNbSezfaTDG5ETGLg8EsV3rRP7YhsWhkt', '2022-12-12 12:43:25', NULL, '2022-12-12 12:43:25', '2022-12-12 12:43:25', NULL),
(45, 1, 'admin user', '2nsNyS4aFLLKWZna7Cs1AShdFYZKpktmqQaGTHoi', '2022-12-13 05:12:21', NULL, '2022-12-13 05:12:21', '2022-12-13 05:12:21', NULL),
(46, 1, 'admin user', 'iZrwT0Aw6E7E9bm8n4432pZBHaNXb3IGNoNFgXyO', '2022-12-13 05:24:37', NULL, '2022-12-13 05:24:37', '2022-12-13 05:24:37', NULL),
(47, 1, 'admin user', '77GWn0QOrFcrXE9AKLnR3Cc2oEjWiAioNZpCKzUC', '2022-12-13 05:40:38', '2022-12-13 11:10:38', '2022-12-13 05:40:38', '2022-12-13 05:40:38', NULL),
(48, 1, 'admin user', 'AFFZdJhkhpGN88vWssrXwGAUYgGa8hrhdUReWTOT', '2022-12-13 05:40:45', '2022-12-13 14:58:30', '2022-12-13 05:40:45', '2022-12-13 09:28:30', NULL),
(49, 1, 'admin user', 'sVHUV26FKyBDlzPDbYeg76Mq8WDyY1LDeERRm6DK', '2022-12-13 06:51:05', NULL, '2022-12-13 06:51:05', '2022-12-13 06:51:05', NULL),
(50, 1, 'admin user', 'ABC2im1w0fwmMO0bGekngVIE4nJqzVlixEGew2Cw', '2022-12-13 07:59:35', NULL, '2022-12-13 07:59:35', '2022-12-13 07:59:35', NULL),
(51, 1, 'admin user', 'WpX4mpuD2Ug0T2YkRnFEvnFtdDi8gegwP8VFc8JK', '2022-12-13 09:27:09', NULL, '2022-12-13 09:27:09', '2022-12-13 09:27:09', NULL),
(52, 1, 'admin user', 'lrSNR0Arq3pzBaOS6iKnXDHghi76ylPmA04n89qD', '2022-12-13 09:29:04', NULL, '2022-12-13 09:29:04', '2022-12-13 09:29:04', NULL),
(53, 1, 'admin user', '3t3RcxFM5TUP9Ghqy334p6kSrFmFzZzkTNBBIEvT', '2022-12-19 04:13:07', '2022-12-19 09:43:32', '2022-12-19 04:13:07', '2022-12-19 04:13:32', NULL),
(54, 1, 'admin user', 'bMKv8ESdbIkrZCcUy4WDREp4ZbJ9kwtsHbrBEldF', '2022-12-26 14:14:50', NULL, '2022-12-26 14:14:50', '2022-12-26 14:14:50', NULL),
(55, 1, 'admin user', 'qqkYUGFIl9suXfvwE9xsHDoSGTolFbpZbBk2imRT', '2022-12-27 14:10:24', NULL, '2022-12-27 14:10:24', '2022-12-27 14:10:24', NULL),
(56, 1, 'admin user', 'wYcA0tgYYKE6Ml4g9MQnuvkK7dPXv9edOGEr1mEy', '2022-12-28 07:56:31', NULL, '2022-12-28 07:56:31', '2022-12-28 07:56:31', NULL),
(57, 1, 'admin user', 'p0ozNuyz5n9IsmBLilsZKhcVrWtNjYCjZEfFRYDx', '2022-12-28 08:18:29', NULL, '2022-12-28 08:18:29', '2022-12-28 08:18:29', NULL),
(58, 1, 'admin user', 'PoAArTsV0Lz7CP7wOoNEEgpk22f6XSpp7haEdoEM', '2022-12-28 08:18:39', NULL, '2022-12-28 08:18:39', '2022-12-28 08:18:39', NULL),
(59, 1, 'admin user', 'zNH7lk2JJ6F0kNWKOnQGscxXTg3B46Rtv5ofeDiZ', '2022-12-28 08:18:59', '2022-12-28 16:26:12', '2022-12-28 08:18:59', '2022-12-28 10:56:12', NULL),
(60, 1, 'admin user', 'DGBZGSEgUovihJ391Jpzb2qWzFLW07FzCqQ3AOk9', '2023-01-27 03:56:16', NULL, '2023-01-27 03:56:16', '2023-01-27 03:56:16', NULL),
(61, 1, 'admin user', 'w0hlsmkG0Aw0AyTyu8lIRG3QFPxD9Jhzi0qD39Pc', '2023-01-28 06:40:07', NULL, '2023-01-28 06:40:07', '2023-01-28 06:40:07', NULL),
(62, 1, 'admin user', '2U1Ggq7bxQyKYrVxqq1SQD0b53H6wAleeur46nKO', '2023-01-28 14:47:28', '2023-01-28 20:17:54', '2023-01-28 14:47:28', '2023-01-28 14:47:54', NULL),
(63, 1, 'admin user', 'X5kxp3H0BVOeue0FCZXIfa9CeBAUaqXvfyw8qRPz', '2023-01-28 14:52:07', '2023-01-28 21:35:41', '2023-01-28 14:52:07', '2023-01-28 16:05:41', NULL),
(64, 1, 'admin user', 'ov9JgVNFth6CDPPPneOeoaFV9vrWW99O01nvuMxD', '2023-01-28 14:59:41', '2023-01-28 20:29:47', '2023-01-28 14:59:41', '2023-01-28 14:59:47', NULL),
(65, 1, 'admin user', 'iXI4mb9DVg9K2Qx5qvRHtJJ0VQtxDauVt2U3Jp5y', '2023-01-28 15:22:12', '2023-01-28 20:52:38', '2023-01-28 15:22:12', '2023-01-28 15:22:38', NULL),
(66, 26, 'aaa aaaaa', 'iO7f9CRb32mrfEXGUMMZStmFzrLAuuduwukVfqFa', '2023-01-28 16:04:09', '2023-01-28 21:35:02', '2023-01-28 16:04:09', '2023-01-28 16:05:02', NULL),
(67, 1, 'admin user', 'yBzt5wfsdYBpB64DjvKDgvOv4sgAOAExWkVAhtoa', '2023-01-28 16:05:50', NULL, '2023-01-28 16:05:50', '2023-01-28 16:05:50', NULL),
(68, 1, 'admin user', 'dyS78JsRt7YSe22vcpszI0aTGMQFsVkhHcgAnJsH', '2023-01-29 03:27:06', NULL, '2023-01-29 03:27:06', '2023-01-29 03:27:06', NULL),
(69, 1, 'admin user', 'PRcDkzSAdu1UgWTu0CJRcnqmJYFsZxTkPjBU7PqZ', '2023-01-29 06:58:18', NULL, '2023-01-29 06:58:18', '2023-01-29 06:58:18', NULL),
(70, 1, 'admin user', 'tUbyfAQWxyj3tCfjgo6NfA07Q02KiMwlMSTCA276', '2023-01-29 16:33:44', NULL, '2023-01-29 16:33:44', '2023-01-29 16:33:44', NULL),
(71, 1, 'admin user', 'zJlZTsAdDMvOphqDLf8H4pkrBdHiFGq3Zu8wiLRl', '2023-01-29 17:01:13', NULL, '2023-01-29 17:01:13', '2023-01-29 17:01:13', NULL),
(72, 1, 'admin user', 'g547koKrYgx1HXYdvOmqk6uIoZISZ3suvDjTO219', '2023-01-30 18:00:14', NULL, '2023-01-30 18:00:14', '2023-01-30 18:00:14', NULL),
(73, 1, 'admin user', '4LHz20Ya6VRmQQdWdZdn2VegXFHx66LTDxvv3Vs7', '2023-01-31 16:38:49', NULL, '2023-01-31 16:38:49', '2023-01-31 16:38:49', NULL),
(74, 1, 'admin user', '8cu3zDVR2KgVTUDYTT0HdxYuVa6OMXYiPkwOm2vs', '2023-01-31 18:03:37', NULL, '2023-01-31 18:03:37', '2023-01-31 18:03:37', NULL),
(75, 1, 'admin user', 'yJvwjRRUTjbedGvAor9ZNS3e6l3GhcpeuB7MELdr', '2023-02-01 16:03:31', NULL, '2023-02-01 16:03:31', '2023-02-01 16:03:31', NULL),
(76, 1, 'admin user', 'EfR9tIGAZY2j6kOaFXgNfxLfj9EObxDlxXBj88IE', '2023-02-02 15:56:04', NULL, '2023-02-02 15:56:04', '2023-02-02 15:56:04', NULL),
(77, 1, 'admin user', 'FHzVZh7KjwJLirIcNs7ZtnnQV1TniezqBdSTq7sT', '2023-02-03 15:37:55', NULL, '2023-02-03 15:37:55', '2023-02-03 15:37:55', NULL),
(78, 1, 'admin user', '4wh0uNfLlWYlviksAWtlupYBLOLI91xDyhLnzfPd', '2023-02-03 15:49:40', NULL, '2023-02-03 15:49:40', '2023-02-03 15:49:40', NULL),
(79, 1, 'admin user', 'VF5culGtqPoL8TAWNPfORwM1n4nAuizTFbpqZU70', '2023-02-03 15:52:56', NULL, '2023-02-03 15:52:56', '2023-02-03 15:52:56', NULL),
(80, 1, 'admin user', 'qnpQzczyRKPdf9tPE75pzoQfVguHUcYYOHgnRBVa', '2023-02-04 13:59:15', NULL, '2023-02-04 13:59:15', '2023-02-04 13:59:15', NULL),
(81, 1, 'admin user', 'NkoJC47DcUO94Q772gDdA73cSSRKHCOt1hNCL5ua', '2023-02-04 16:23:13', NULL, '2023-02-04 16:23:13', '2023-02-04 16:23:13', NULL),
(82, 1, 'admin user', 'lRbsjIDxExJf1YvkRHDiRv9vPkCJsTMiPRrAq1iQ', '2023-02-05 06:36:12', NULL, '2023-02-05 06:36:12', '2023-02-05 06:36:12', NULL),
(83, 1, 'admin user', 'qCckmmWcN6HIcsEyJ7eq9Qke7JBu6jH99atnhvf8', '2023-02-07 15:35:07', NULL, '2023-02-07 15:35:07', '2023-02-07 15:35:07', NULL),
(84, 1, 'admin user', 'aMTWO6jdXv5RGndrYaWiSRJ48XNoBemaefGe2bN7', '2023-02-11 03:24:09', '2023-02-11 09:29:23', '2023-02-11 03:24:09', '2023-02-11 03:59:23', NULL),
(85, 1, 'admin user', 'ZdvEMhJRofxfx64VNXUStwY6ACZNM39n3k78w1Ef', '2023-02-11 04:00:12', NULL, '2023-02-11 04:00:12', '2023-02-11 04:00:12', NULL),
(86, 1, 'admin user', 'ruTY1sVRtqv2KDAt7UOk3GZUTw4DKzgjJxsAVGox', '2023-02-11 08:57:23', NULL, '2023-02-11 08:57:23', '2023-02-11 08:57:23', NULL),
(87, 1, 'admin user', 'K2jvjqqnPZECQvfvSIuNp13c8vnRPeEeTM7UzDTv', '2023-02-11 14:37:11', NULL, '2023-02-11 14:37:11', '2023-02-11 14:37:11', NULL),
(88, 1, 'admin user', 'OZYWHhsRIiAkQvCVSHt1cErkK9edqGvbbbjn7Akc', '2023-02-14 16:11:46', NULL, '2023-02-14 16:11:46', '2023-02-14 16:11:46', NULL),
(89, 1, 'admin user', 'ViLMrLXbUl99hBu8DT2bsjRETTsncJbAcElkCtcl', '2023-02-15 16:15:37', NULL, '2023-02-15 16:15:37', '2023-02-15 16:15:37', NULL),
(90, 1, 'admin user', 'mE9Tr0amSy0odJZzhJlfj7jiSrw6wiHVCvOcnKfd', '2023-02-18 13:56:13', NULL, '2023-02-18 13:56:13', '2023-02-18 13:56:13', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
