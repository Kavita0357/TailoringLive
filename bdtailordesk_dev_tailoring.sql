-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2026 at 11:56 PM
-- Server version: 11.4.10-MariaDB
-- PHP Version: 8.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdtailordesk_dev_tailoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `account_number` varchar(191) NOT NULL,
  `account_details` text DEFAULT NULL,
  `account_type_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `business_id`, `name`, `account_number`, `account_details`, `account_type_id`, `note`, `created_by`, `is_closed`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'TEST ACCOUNT', 'aaasfafafa', '[{\"label\":null,\"value\":null},{\"label\":null,\"value\":null},{\"label\":null,\"value\":null},{\"label\":null,\"value\":null},{\"label\":null,\"value\":null},{\"label\":null,\"value\":null}]', 0, NULL, 2, 0, NULL, '2025-07-24 05:03:52', '2025-07-24 05:03:52'),
(2, 2, 'Bkash', '0171000000', '[{\"label\":null,\"value\":null},{\"label\":null,\"value\":null},{\"label\":null,\"value\":null},{\"label\":null,\"value\":null},{\"label\":null,\"value\":null},{\"label\":null,\"value\":null}]', 0, NULL, 2, 0, NULL, '2025-09-14 07:20:12', '2025-09-14 07:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `account_transactions`
--

CREATE TABLE `account_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL,
  `type` enum('debit','credit') NOT NULL,
  `sub_type` enum('opening_balance','fund_transfer','deposit') DEFAULT NULL,
  `amount` decimal(22,4) NOT NULL,
  `reff_no` varchar(191) DEFAULT NULL,
  `operation_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `transaction_payment_id` int(11) DEFAULT NULL,
  `transfer_transaction_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_transactions`
--

INSERT INTO `account_transactions` (`id`, `account_id`, `type`, `sub_type`, `amount`, `reff_no`, `operation_date`, `created_by`, `transaction_id`, `transaction_payment_id`, `transfer_transaction_id`, `note`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'credit', NULL, 470.0000, NULL, '2025-07-18 16:42:00', 2, 35, 22, NULL, NULL, '2025-08-26 00:07:22', '2025-07-24 05:03:58', '2025-08-26 00:07:22'),
(2, 1, 'credit', NULL, 1.0000, NULL, '2025-07-24 00:03:00', 2, 50, 35, NULL, NULL, '2025-08-26 00:07:28', '2025-07-24 05:04:21', '2025-08-26 00:07:28'),
(3, 1, 'credit', NULL, 100.0000, NULL, '2025-07-23 23:51:00', 2, 47, 33, NULL, NULL, '2025-08-25 09:18:00', '2025-07-25 18:18:38', '2025-08-25 09:18:00'),
(4, 1, 'credit', NULL, 100.0000, NULL, '2025-07-26 00:32:00', 2, 56, 42, NULL, NULL, '2025-08-25 09:17:49', '2025-07-25 18:33:03', '2025-08-25 09:17:49'),
(5, 1, 'credit', NULL, 100.0000, NULL, '2025-07-25 16:11:00', 2, 56, 41, NULL, NULL, '2025-08-25 09:17:49', '2025-07-25 18:33:37', '2025-08-25 09:17:49'),
(6, 1, 'credit', NULL, 100.0000, NULL, '2025-07-29 22:58:00', 2, 56, 43, NULL, NULL, '2025-08-25 09:17:49', '2025-07-29 16:58:35', '2025-08-25 09:17:49'),
(7, 1, 'credit', NULL, 200.0000, NULL, '2025-08-01 22:54:00', 2, 62, 44, NULL, NULL, '2025-08-25 09:17:42', '2025-08-01 16:55:59', '2025-08-25 09:17:42'),
(8, 1, 'credit', NULL, 100.0000, NULL, '2025-08-01 22:56:00', 2, 62, 45, NULL, NULL, '2025-08-25 09:17:42', '2025-08-01 16:56:34', '2025-08-25 09:17:42'),
(9, 1, 'credit', NULL, 100.0000, NULL, '2025-08-05 15:46:00', 2, 63, 46, NULL, NULL, '2025-08-26 00:07:51', '2025-08-05 09:47:03', '2025-08-26 00:07:51'),
(10, 1, 'credit', NULL, 500.0000, NULL, '2025-08-05 16:32:00', 2, 66, 47, NULL, NULL, '2025-08-25 09:17:07', '2025-08-05 10:34:03', '2025-08-25 09:17:07'),
(11, 1, 'credit', NULL, 100.0000, NULL, '2025-08-05 16:34:00', 2, 67, 48, NULL, NULL, '2025-08-05 10:35:39', '2025-08-05 10:35:27', '2025-08-05 10:35:39'),
(12, 1, 'credit', NULL, 50.0000, NULL, '2025-08-06 10:34:00', 2, 63, 51, NULL, NULL, '2025-08-26 00:07:51', '2025-08-06 04:35:00', '2025-08-26 00:07:51'),
(13, 1, 'credit', NULL, 100.0000, NULL, '2025-08-08 14:06:00', 2, 68, 52, NULL, NULL, '2025-08-25 07:23:52', '2025-08-08 08:06:32', '2025-08-25 07:23:52'),
(14, 1, 'credit', NULL, 600.0000, NULL, '2025-08-19 12:11:00', 2, 69, 54, NULL, NULL, '2025-08-25 07:23:38', '2025-08-19 06:12:03', '2025-08-25 07:23:38'),
(15, 1, 'credit', NULL, 100.0000, NULL, '2025-08-25 15:02:00', 2, 70, 55, NULL, NULL, '2025-08-26 00:07:39', '2025-08-25 09:03:32', '2025-08-26 00:07:39'),
(16, 1, 'credit', NULL, 100.0000, NULL, '2025-08-25 15:03:00', 2, 71, 56, NULL, NULL, '2025-08-26 00:07:44', '2025-08-25 09:04:41', '2025-08-26 00:07:44'),
(17, 1, 'credit', NULL, 100.0000, NULL, '2025-08-25 15:10:00', 2, 72, 57, NULL, NULL, '2025-08-25 09:17:04', '2025-08-25 09:11:30', '2025-08-25 09:17:04'),
(18, 1, 'credit', NULL, 20.0000, NULL, '2025-08-25 15:11:00', 2, 72, 58, NULL, NULL, '2025-08-25 09:17:04', '2025-08-25 09:11:47', '2025-08-25 09:17:04'),
(19, 1, 'credit', NULL, 100.0000, NULL, '2025-08-25 15:53:44', 2, 73, 59, NULL, NULL, '2025-08-26 00:07:36', '2025-08-25 09:53:44', '2025-08-26 00:07:36'),
(20, 1, 'credit', NULL, 25.0000, NULL, '2025-08-25 15:53:44', 2, 73, 60, NULL, NULL, '2025-08-26 00:07:36', '2025-08-25 09:53:44', '2025-08-26 00:07:36'),
(21, 1, 'credit', NULL, 100.0000, NULL, '2025-08-26 06:24:00', 2, 75, 63, NULL, NULL, NULL, '2025-08-26 00:25:13', '2025-08-26 01:03:34'),
(22, 1, 'credit', NULL, 50.0000, NULL, '2025-08-26 07:06:00', 2, 76, 64, NULL, NULL, '2025-08-26 04:44:31', '2025-08-26 01:06:29', '2025-08-26 04:44:31'),
(23, 1, 'credit', NULL, 20.0000, NULL, '2025-08-26 09:45:00', 2, 76, 65, NULL, NULL, NULL, '2025-08-26 03:45:39', '2025-08-26 04:26:39'),
(24, 1, 'credit', NULL, 30.0000, NULL, '2025-08-26 09:45:00', 2, 76, 66, NULL, NULL, NULL, '2025-08-26 03:45:59', '2025-08-26 04:26:39'),
(25, 1, 'credit', NULL, 0.0000, NULL, '2025-08-15 21:35:00', 2, NULL, 53, NULL, NULL, NULL, '2025-08-26 04:45:09', '2025-08-26 04:45:09'),
(26, 2, 'debit', NULL, 100000.0000, NULL, '2025-09-14 13:54:00', 2, 77, 67, NULL, NULL, NULL, '2025-09-14 07:57:19', '2025-09-14 07:57:19'),
(27, 1, 'debit', NULL, 60000.0000, NULL, '2025-09-14 14:00:00', 2, 78, 68, NULL, NULL, NULL, '2025-09-14 08:01:36', '2025-09-14 08:01:36'),
(28, 1, 'credit', NULL, 500.0000, NULL, '2025-09-14 14:03:28', 2, 79, 69, NULL, NULL, NULL, '2025-09-14 08:03:28', '2025-09-14 08:03:28'),
(29, 2, 'credit', NULL, 200.0000, NULL, '2025-09-14 14:03:28', 2, 79, 70, NULL, NULL, NULL, '2025-09-14 08:03:28', '2025-09-14 08:03:28'),
(30, 2, 'credit', NULL, 10.0000, NULL, '2025-10-05 11:25:00', 2, 80, 71, NULL, NULL, NULL, '2025-10-05 05:42:39', '2025-10-09 17:21:19'),
(31, 2, 'credit', NULL, 500.0000, NULL, '2025-10-05 16:47:00', 2, 81, 72, NULL, NULL, NULL, '2025-10-05 10:48:59', '2025-10-09 16:06:25'),
(32, 1, 'credit', NULL, 200.0000, NULL, '2025-10-05 23:14:00', 2, 82, 73, NULL, NULL, NULL, '2025-10-05 17:15:14', '2025-10-05 17:15:14'),
(33, 2, 'credit', NULL, 250.0000, NULL, '2025-10-05 23:17:00', 2, 83, 74, NULL, NULL, NULL, '2025-10-05 17:17:40', '2025-10-05 17:17:40'),
(34, 2, 'credit', NULL, 20.0000, NULL, '2025-10-09 23:37:00', 2, 80, 75, NULL, NULL, NULL, '2025-10-09 17:37:56', '2025-10-09 17:37:56'),
(35, 1, 'credit', NULL, 100.0000, NULL, '2025-10-09 23:49:17', 2, 84, 76, NULL, NULL, NULL, '2025-10-09 17:49:17', '2025-10-09 17:49:17'),
(36, 1, 'credit', NULL, 1.2500, NULL, '2025-10-10 06:45:16', 2, 85, 77, NULL, NULL, NULL, '2025-10-10 00:45:16', '2025-10-10 00:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `parent_account_type_id` int(11) DEFAULT NULL,
  `business_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `log_name` varchar(191) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(191) DEFAULT NULL,
  `event` varchar(191) DEFAULT NULL,
  `business_id` int(11) DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(191) DEFAULT NULL,
  `properties` text DEFAULT NULL,
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `event`, `business_id`, `causer_id`, `causer_type`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2024-03-22 10:18:25', '2024-03-22 10:18:25'),
(2, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2024-03-22 11:36:00', '2024-03-22 11:36:00'),
(3, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2024-03-22 11:54:36', '2024-03-22 11:54:36'),
(4, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2024-03-23 09:50:50', '2024-03-23 09:50:50'),
(5, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2024-03-23 09:59:11', '2024-03-23 09:59:11'),
(6, 'default', 'logout', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2024-03-23 10:45:47', '2024-03-23 10:45:47'),
(7, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-07-02 04:59:42', '2025-07-02 04:59:42'),
(8, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-07-02 05:14:28', '2025-07-02 05:14:28'),
(9, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-02 04:50:42', '2025-07-02 04:50:42'),
(10, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-02 04:55:37', '2025-07-02 04:55:37'),
(11, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-02 04:55:43', '2025-07-02 04:55:43'),
(12, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-07-03 04:55:28', '2025-07-03 04:55:28'),
(13, 'default', 'logout', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-07-03 04:55:37', '2025-07-03 04:55:37'),
(14, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-03 04:25:43', '2025-07-03 04:25:43'),
(15, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-03 05:01:48', '2025-07-03 05:01:48'),
(16, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-03 05:12:00', '2025-07-03 05:12:00'),
(17, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-07-03 05:42:03', '2025-07-03 05:42:03'),
(18, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-03 05:28:06', '2025-07-03 05:28:06'),
(19, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-03 06:32:32', '2025-07-03 06:32:32'),
(20, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-07-04 04:42:55', '2025-07-04 04:42:55'),
(21, 'default', 'logout', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-07-04 04:51:34', '2025-07-04 04:51:34'),
(22, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-04 04:21:40', '2025-07-04 04:21:40'),
(23, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-07 08:47:47', '2025-07-07 08:47:47'),
(24, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-07 10:13:06', '2025-07-07 10:13:06'),
(25, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-08 05:04:48', '2025-07-08 05:04:48'),
(26, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-08 05:57:45', '2025-07-08 05:57:45'),
(27, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-08 09:43:55', '2025-07-08 09:43:55'),
(28, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-10 05:13:53', '2025-07-10 05:13:53'),
(29, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-10 05:21:04', '2025-07-10 05:21:04'),
(30, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-10 07:37:38', '2025-07-10 07:37:38'),
(31, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-10 16:43:02', '2025-07-10 16:43:02'),
(32, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-11 04:01:35', '2025-07-11 04:01:35'),
(33, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-11 04:55:04', '2025-07-11 04:55:04'),
(34, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-11 08:47:22', '2025-07-11 08:47:22'),
(35, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-11 09:06:01', '2025-07-11 09:06:01'),
(36, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-11 09:25:49', '2025-07-11 09:25:49'),
(37, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-11 09:26:54', '2025-07-11 09:26:54'),
(38, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-11 10:21:07', '2025-07-11 10:21:07'),
(39, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-11 10:21:10', '2025-07-11 10:21:10'),
(40, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-11 11:30:30', '2025-07-11 11:30:30'),
(41, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-11 18:13:13', '2025-07-11 18:13:13'),
(42, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-12 03:24:55', '2025-07-12 03:24:55'),
(43, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-12 04:44:09', '2025-07-12 04:44:09'),
(44, 'default', 'added', 3, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-12 05:21:49', '2025-07-12 05:21:49'),
(45, 'default', 'edited', 3, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-12 05:22:32', '2025-07-12 05:22:32'),
(46, 'default', 'added', 2, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":2.5}}', NULL, '2025-07-12 05:25:08', '2025-07-12 05:25:08'),
(47, 'default', 'edited', 2, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":2.5},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":\"2.5000\"}}', NULL, '2025-07-12 05:26:18', '2025-07-12 05:26:18'),
(48, 'default', 'edited', 2, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"payment_status\":\"paid\",\"final_total\":2.5},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":\"2.5000\"}}', NULL, '2025-07-12 05:27:26', '2025-07-12 05:27:26'),
(49, 'default', 'edited', 2, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":2.5},\"old\":{\"type\":\"sell\",\"status\":\"draft\",\"payment_status\":\"paid\",\"final_total\":\"2.5000\"}}', NULL, '2025-07-12 05:27:50', '2025-07-12 05:27:50'),
(50, 'default', 'added', 3, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":12.5}}', NULL, '2025-07-12 05:39:24', '2025-07-12 05:39:24'),
(51, 'default', 'edited', 3, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":22.5},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":\"12.5000\"}}', NULL, '2025-07-12 05:40:34', '2025-07-12 05:40:34'),
(52, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-07-12 06:12:15', '2025-07-12 06:12:15'),
(53, 'default', 'sell_deleted', 2, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":2,\"invoice_no\":\"0001\",\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":\"2.5000\"}}', NULL, '2025-07-12 05:51:23', '2025-07-12 05:51:23'),
(54, 'default', 'added', 4, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"shipping_status\":\"ordered\",\"payment_status\":\"partial\",\"final_total\":30.5}}', NULL, '2025-07-12 08:45:59', '2025-07-12 08:46:00'),
(55, 'default', 'added', 5, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"shipping_status\":\"packed\",\"payment_status\":\"partial\",\"final_total\":29.7}}', NULL, '2025-07-12 09:01:11', '2025-07-12 09:01:11'),
(56, 'default', 'added', 6, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":12.5}}', NULL, '2025-07-12 09:43:27', '2025-07-12 09:43:27'),
(57, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-14 05:38:48', '2025-07-14 05:38:48'),
(58, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-14 05:44:27', '2025-07-14 05:44:27'),
(59, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-15 04:01:00', '2025-07-15 04:01:00'),
(60, 'default', 'added', 8, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-15 04:47:26', '2025-07-15 04:47:26'),
(61, 'default', 'added', 9, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-15 04:54:33', '2025-07-15 04:54:33'),
(62, 'default', 'added', 10, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-15 05:21:39', '2025-07-15 05:21:39'),
(63, 'default', 'added', 11, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-15 05:32:37', '2025-07-15 05:32:37'),
(64, 'default', 'added', 12, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-15 05:37:16', '2025-07-15 05:37:16'),
(65, 'default', 'added', 13, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-15 05:46:46', '2025-07-15 05:46:46'),
(66, 'default', 'added', 14, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":12.5}}', NULL, '2025-07-15 05:50:19', '2025-07-15 05:50:19'),
(67, 'default', 'added', 15, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-15 06:51:31', '2025-07-15 06:51:31'),
(68, 'default', 'added', 16, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-15 06:56:28', '2025-07-15 06:56:28'),
(69, 'default', 'added', 24, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-15 07:18:32', '2025-07-15 07:18:32'),
(70, 'default', 'added', 28, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":512.5}}', NULL, '2025-07-15 07:27:02', '2025-07-15 07:27:02'),
(71, 'default', 'shipping_edited', 24, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-07-15 08:54:04', '2025-07-15 08:54:04'),
(72, 'default', 'added', 29, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-15 09:07:20', '2025-07-15 09:07:20'),
(73, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-16 05:45:32', '2025-07-16 05:45:32'),
(74, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 05:05:55', '2025-07-18 05:05:55'),
(75, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 05:18:00', '2025-07-18 05:18:00'),
(76, 'default', 'added', 30, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 05:36:58', '2025-07-18 05:36:58'),
(77, 'default', 'added', 31, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 06:53:19', '2025-07-18 06:53:19'),
(78, 'default', 'added', 32, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"final_total\":12.5}}', NULL, '2025-07-18 07:20:15', '2025-07-18 07:20:15'),
(79, 'default', 'edited', 29, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 10:55:27', '2025-07-18 10:55:27'),
(80, 'default', 'added', 35, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":470}}', NULL, '2025-07-18 11:24:39', '2025-07-18 11:24:39'),
(81, 'default', 'added', 36, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 11:33:38', '2025-07-18 11:33:38'),
(82, 'default', 'edited', 36, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 11:55:01', '2025-07-18 11:55:01'),
(83, 'default', 'edited', 36, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 12:00:21', '2025-07-18 12:00:21'),
(84, 'default', 'edited', 36, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 12:00:59', '2025-07-18 12:00:59'),
(85, 'default', 'edited', 36, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 12:01:16', '2025-07-18 12:01:16'),
(86, 'default', 'edited', 36, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 12:12:30', '2025-07-18 12:12:30'),
(87, 'default', 'edited', 36, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 12:12:52', '2025-07-18 12:12:52'),
(88, 'default', 'edited', 36, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 12:13:04', '2025-07-18 12:13:04'),
(89, 'default', 'edited', 36, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 12:13:40', '2025-07-18 12:13:40'),
(90, 'default', 'added', 37, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 12:16:21', '2025-07-18 12:16:21'),
(91, 'default', 'edited', 37, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 12:16:50', '2025-07-18 12:16:50'),
(92, 'default', 'edited', 37, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-18 12:17:17', '2025-07-18 12:17:17'),
(93, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-19 11:03:54', '2025-07-19 11:03:54'),
(94, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-19 13:15:15', '2025-07-19 13:15:15'),
(95, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-19 13:42:34', '2025-07-19 13:42:34'),
(96, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-21 03:43:23', '2025-07-21 03:43:23'),
(97, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-21 04:40:26', '2025-07-21 04:40:26'),
(98, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-21 05:02:30', '2025-07-21 05:02:30'),
(99, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-21 11:11:53', '2025-07-21 11:11:53'),
(100, 'default', 'edited', 2, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-21 11:31:34', '2025-07-21 11:31:34'),
(101, 'default', 'edited', 2, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-21 11:31:55', '2025-07-21 11:31:55'),
(102, 'default', 'edited', 37, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-21 11:37:42', '2025-07-21 11:37:42'),
(103, 'default', 'edited', 37, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-21 11:38:04', '2025-07-21 11:38:04'),
(104, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-21 11:45:12', '2025-07-21 11:45:12'),
(105, 'default', 'added', 42, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":125}}', NULL, '2025-07-21 11:53:10', '2025-07-21 11:53:10'),
(106, 'default', 'added', 43, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-21 13:37:55', '2025-07-21 13:37:55'),
(107, 'default', 'shipping_edited', 35, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null,\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"shipping_status\":\"ordered\",\"payment_status\":\"paid\",\"final_total\":\"470.0000\"},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":\"470.0000\"}}', NULL, '2025-07-21 13:59:22', '2025-07-21 13:59:22'),
(108, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-22 08:57:53', '2025-07-22 08:57:53'),
(109, 'default', 'added', 44, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-22 11:30:52', '2025-07-22 11:30:52'),
(110, 'default', 'edited', 44, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-22 11:31:15', '2025-07-22 11:31:15'),
(111, 'default', 'edited', 44, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-22 11:31:37', '2025-07-22 11:31:37'),
(112, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-23 04:05:58', '2025-07-23 04:05:58'),
(114, 'default', 'sell_deleted', 44, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":44,\"invoice_no\":\"0014\"}', NULL, '2025-07-23 04:10:57', '2025-07-23 04:10:57'),
(115, 'default', 'added', 45, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-23 05:45:14', '2025-07-23 05:45:14'),
(116, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-23 09:00:35', '2025-07-23 09:00:35'),
(117, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-23 16:47:14', '2025-07-23 16:47:14'),
(118, 'default', 'edited', 45, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-23 16:55:40', '2025-07-23 16:55:40'),
(119, 'default', 'added', 4, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-23 17:00:31', '2025-07-23 17:00:31'),
(120, 'default', 'edited', 45, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-23 17:16:01', '2025-07-23 17:16:01'),
(121, 'default', 'added', 5, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-23 17:35:09', '2025-07-23 17:35:09'),
(122, 'default', 'added', 46, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-23 17:46:05', '2025-07-23 17:46:05'),
(123, 'default', 'added', 47, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-23 17:52:02', '2025-07-23 17:52:02'),
(124, 'default', 'added', 48, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-23 17:52:58', '2025-07-23 17:52:58'),
(125, 'default', 'added', 49, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-23 18:03:00', '2025-07-23 18:03:00'),
(126, 'default', 'added', 50, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":2.5}}', NULL, '2025-07-23 18:03:33', '2025-07-23 18:03:33'),
(127, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-24 03:27:29', '2025-07-24 03:27:29'),
(128, 'default', 'edited', 48, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-24 04:02:13', '2025-07-24 04:02:13'),
(129, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-24 04:23:52', '2025-07-24 04:23:52'),
(130, 'default', 'edited', 48, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-24 04:48:07', '2025-07-24 04:48:07'),
(131, 'default', 'edited', 48, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-24 05:01:39', '2025-07-24 05:01:39'),
(132, 'default', 'added', 51, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-24 05:38:49', '2025-07-24 05:38:49'),
(133, 'default', 'added', 52, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-24 05:39:31', '2025-07-24 05:39:31'),
(134, 'default', 'added', 53, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-24 05:43:03', '2025-07-24 05:43:03'),
(135, 'default', 'sell_deleted', 51, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":51,\"invoice_no\":\"2025\\/0007\"}', NULL, '2025-07-24 05:43:15', '2025-07-24 05:43:15'),
(136, 'default', 'sell_deleted', 52, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":52,\"invoice_no\":\"2025\\/0008\"}', NULL, '2025-07-24 05:43:20', '2025-07-24 05:43:20'),
(137, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-24 11:32:02', '2025-07-24 11:32:02'),
(138, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-24 12:46:36', '2025-07-24 12:46:36'),
(139, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 02:40:39', '2025-07-25 02:40:39'),
(140, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 06:05:33', '2025-07-25 06:05:33'),
(141, 'default', 'added', 56, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 06:07:46', '2025-07-25 06:07:46'),
(142, 'default', 'sell_deleted', 48, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":48,\"invoice_no\":\"2025\\/0006\"}', NULL, '2025-07-25 06:23:15', '2025-07-25 06:23:15'),
(143, 'default', 'edited', 42, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"proforma\",\"final_total\":\"125.0000\"},\"old\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":\"125.0000\"}}', NULL, '2025-07-25 06:26:42', '2025-07-25 06:26:42'),
(144, 'default', 'edited', 53, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 06:35:48', '2025-07-25 06:35:48'),
(145, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 09:13:46', '2025-07-25 09:13:46'),
(146, 'default', 'edited', 56, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 09:39:21', '2025-07-25 09:39:21'),
(147, 'default', 'edited', 56, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 09:39:48', '2025-07-25 09:39:48'),
(148, 'default', 'edited', 53, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 09:40:27', '2025-07-25 09:40:27'),
(149, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 10:07:15', '2025-07-25 10:07:15'),
(150, 'default', 'payment_edited', 56, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 10:11:26', '2025-07-25 10:11:26'),
(151, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 18:00:52', '2025-07-25 18:00:52'),
(152, 'default', 'delivery_edited', 56, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-07-25 18:12:32', '2025-07-25 18:12:32'),
(153, 'default', 'delivery_edited', 53, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":\"hello\"}', NULL, '2025-07-25 18:13:16', '2025-07-25 18:13:16'),
(154, 'default', 'delivery_edited', 53, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-07-25 18:13:39', '2025-07-25 18:13:39'),
(155, 'default', 'edited', 47, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 18:18:38', '2025-07-25 18:18:38'),
(156, 'default', 'edited', 47, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 18:19:02', '2025-07-25 18:19:02'),
(157, 'default', 'edited', 47, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 18:19:28', '2025-07-25 18:19:28'),
(158, 'default', 'edited', 47, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 18:20:13', '2025-07-25 18:20:13'),
(159, 'default', 'delivery_edited', 47, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":\"Tomorrow\"}', NULL, '2025-07-25 18:20:41', '2025-07-25 18:20:41'),
(160, 'default', 'edited', 46, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 18:21:52', '2025-07-25 18:21:52'),
(161, 'default', 'payment_edited', 56, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 18:33:03', '2025-07-25 18:33:03'),
(162, 'default', 'added', 57, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 18:38:30', '2025-07-25 18:38:30'),
(163, 'default', 'edited', 57, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 18:58:03', '2025-07-25 18:58:03'),
(164, 'default', 'edited', 55, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-25 18:59:43', '2025-07-25 18:59:43'),
(165, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-26 11:57:20', '2025-07-26 11:57:20'),
(166, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-28 10:47:20', '2025-07-28 10:47:20'),
(167, 'default', 'added', 58, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-28 10:47:55', '2025-07-28 10:47:55'),
(168, 'default', 'edited', 58, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-28 10:48:00', '2025-07-28 10:48:00'),
(169, 'default', 'edited', 58, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-28 11:51:00', '2025-07-28 11:51:00'),
(170, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-29 01:59:35', '2025-07-29 01:59:35'),
(171, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-29 11:36:46', '2025-07-29 11:36:46'),
(172, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-29 12:03:53', '2025-07-29 12:03:53'),
(173, 'default', 'delivery_edited', 56, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-07-29 12:06:36', '2025-07-29 12:06:36'),
(174, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-29 16:44:12', '2025-07-29 16:44:12'),
(175, 'default', 'added', 59, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-29 16:53:01', '2025-07-29 16:53:01'),
(176, 'default', 'added', 60, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-29 16:55:22', '2025-07-29 16:55:22'),
(177, 'default', 'edited', 60, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-29 16:55:54', '2025-07-29 16:55:54'),
(178, 'default', 'delivery_edited', 60, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-07-29 16:56:15', '2025-07-29 16:56:15'),
(179, 'default', 'payment_edited', 57, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-29 16:56:36', '2025-07-29 16:56:36'),
(180, 'default', 'payment_edited', 55, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-29 16:56:56', '2025-07-29 16:56:56'),
(181, 'default', 'added', 61, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-29 16:57:32', '2025-07-29 16:57:32'),
(182, 'default', 'payment_edited', 56, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-07-29 16:58:35', '2025-07-29 16:58:35'),
(183, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-01 16:51:46', '2025-08-01 16:51:46'),
(184, 'default', 'added', 62, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-01 16:55:59', '2025-08-01 16:55:59'),
(185, 'default', 'payment_edited', 62, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-01 16:56:34', '2025-08-01 16:56:34'),
(186, 'default', 'delivery_edited', 62, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-08-01 16:58:23', '2025-08-01 16:58:23'),
(187, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-03 11:49:24', '2025-08-03 11:49:24'),
(188, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-05 09:10:02', '2025-08-05 09:10:02'),
(189, 'default', 'added', 63, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":200}}', NULL, '2025-08-05 09:47:03', '2025-08-05 09:47:03'),
(190, 'default', 'added', 64, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"final_total\":250}}', NULL, '2025-08-05 10:03:27', '2025-08-05 10:03:27'),
(191, 'default', 'sell_deleted', 42, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":42,\"invoice_no\":\"2025\\/0004\",\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"proforma\",\"final_total\":\"125.0000\"}}', NULL, '2025-08-05 10:03:35', '2025-08-05 10:03:35'),
(192, 'default', 'sell_deleted', 64, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":64,\"invoice_no\":\"2025\\/0017\",\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"final_total\":\"250.0000\"}}', NULL, '2025-08-05 10:04:26', '2025-08-05 10:04:26'),
(193, 'default', 'added', 65, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"final_total\":125}}', NULL, '2025-08-05 10:04:55', '2025-08-05 10:04:55'),
(194, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-05 10:05:19', '2025-08-05 10:05:19'),
(195, 'default', 'added', 66, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-05 10:34:03', '2025-08-05 10:34:03'),
(196, 'default', 'added', 67, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-05 10:35:27', '2025-08-05 10:35:27'),
(197, 'default', 'sell_deleted', 67, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":67,\"invoice_no\":\"0025\"}', NULL, '2025-08-05 10:35:39', '2025-08-05 10:35:39'),
(198, 'default', 'payment_edited', 62, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-05 11:25:46', '2025-08-05 11:25:46'),
(199, 'default', 'payment_edited', 66, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-05 11:26:06', '2025-08-05 11:26:06'),
(200, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-05 11:53:06', '2025-08-05 11:53:06'),
(201, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-08-05 12:23:17', '2025-08-05 12:23:17'),
(202, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-05 11:53:46', '2025-08-05 11:53:46'),
(203, 'default', 'added', 3, 'App\\User', NULL, 2, 2, 'App\\User', '{\"name\":\" Aatif Sarkar\"}', NULL, '2025-08-05 11:59:15', '2025-08-05 11:59:15'),
(204, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-05 18:49:44', '2025-08-05 18:49:44'),
(205, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-06 04:04:54', '2025-08-06 04:04:54'),
(206, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-06 04:04:57', '2025-08-06 04:04:57'),
(207, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-08-06 04:35:25', '2025-08-06 04:35:25'),
(208, 'default', 'logout', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-08-06 04:37:54', '2025-08-06 04:37:54'),
(209, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-06 04:07:58', '2025-08-06 04:07:58'),
(210, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-06 04:27:35', '2025-08-06 04:27:35'),
(211, 'default', 'payment_edited', 63, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"200.0000\"},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"200.0000\"}}', NULL, '2025-08-06 04:35:00', '2025-08-06 04:35:00'),
(212, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-06 09:39:03', '2025-08-06 09:39:03'),
(213, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-06 10:15:29', '2025-08-06 10:15:29'),
(214, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-08-06 10:45:46', '2025-08-06 10:45:46'),
(215, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-06 10:16:30', '2025-08-06 10:16:30'),
(216, 'default', 'logout', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-08-06 10:50:05', '2025-08-06 10:50:05'),
(217, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-06 10:22:04', '2025-08-06 10:22:04'),
(218, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-07 05:22:34', '2025-08-07 05:22:34'),
(219, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-07 05:24:33', '2025-08-07 05:24:33'),
(220, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-07 05:25:39', '2025-08-07 05:25:39'),
(221, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-08-07 05:56:20', '2025-08-07 05:56:20'),
(222, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-07 05:26:44', '2025-08-07 05:26:44'),
(223, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-08-07 05:56:48', '2025-08-07 05:56:48'),
(224, 'default', 'logout', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-08-07 05:58:09', '2025-08-07 05:58:09'),
(225, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-07 05:29:05', '2025-08-07 05:29:05'),
(226, 'default', 'logout', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-08-07 06:02:38', '2025-08-07 06:02:38'),
(227, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-07 05:32:44', '2025-08-07 05:32:44'),
(228, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-07 06:04:21', '2025-08-07 06:04:21'),
(229, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-07 06:04:26', '2025-08-07 06:04:26'),
(230, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-07 06:04:30', '2025-08-07 06:04:30'),
(231, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-08-07 06:34:42', '2025-08-07 06:34:42'),
(232, 'default', 'logout', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-08-07 06:39:27', '2025-08-07 06:39:27'),
(233, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-07 06:09:31', '2025-08-07 06:09:31'),
(234, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-07 06:56:47', '2025-08-07 06:56:47'),
(235, 'default', 'added', 4, 'App\\User', NULL, 2, 2, 'App\\User', '{\"name\":\" Nahid \"}', NULL, '2025-08-07 06:58:46', '2025-08-07 06:58:46'),
(236, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-07 20:32:17', '2025-08-07 20:32:18'),
(237, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-08 06:07:49', '2025-08-08 06:07:49'),
(238, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-08 07:47:21', '2025-08-08 07:47:21'),
(239, 'default', 'added', 68, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-08 08:06:32', '2025-08-08 08:06:32'),
(240, 'default', 'delivery_edited', 68, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-08-08 08:06:45', '2025-08-08 08:06:45'),
(241, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-15 15:35:04', '2025-08-15 15:35:04'),
(242, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-17 04:53:52', '2025-08-17 04:53:52'),
(243, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-18 06:31:32', '2025-08-18 06:31:32'),
(244, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-19 06:11:03', '2025-08-19 06:11:03'),
(245, 'default', 'added', 69, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-19 06:12:03', '2025-08-19 06:12:03'),
(246, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-25 07:22:08', '2025-08-25 07:22:08'),
(247, 'default', 'sell_deleted', 69, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":69,\"invoice_no\":\"0027\"}', NULL, '2025-08-25 07:23:38', '2025-08-25 07:23:38'),
(248, 'default', 'sell_deleted', 68, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":68,\"invoice_no\":\"0026\"}', NULL, '2025-08-25 07:23:52', '2025-08-25 07:23:52'),
(249, 'default', 'delivery_edited', 66, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-08-25 08:01:29', '2025-08-25 08:01:29'),
(250, 'default', 'added', 6, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-25 09:02:52', '2025-08-25 09:02:52'),
(251, 'default', 'added', 70, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":125}}', NULL, '2025-08-25 09:03:32', '2025-08-25 09:03:32'),
(252, 'default', 'added', 71, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":200}}', NULL, '2025-08-25 09:04:41', '2025-08-25 09:04:41'),
(253, 'default', 'added', 7, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-25 09:11:01', '2025-08-25 09:11:01'),
(254, 'default', 'added', 72, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-25 09:11:30', '2025-08-25 09:11:30'),
(255, 'default', 'payment_edited', 72, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-25 09:11:47', '2025-08-25 09:11:47'),
(256, 'default', 'delivery_edited', 72, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-08-25 09:11:56', '2025-08-25 09:11:56'),
(257, 'default', 'sell_deleted', 72, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":72,\"invoice_no\":\"0030\"}', NULL, '2025-08-25 09:17:04', '2025-08-25 09:17:04'),
(258, 'default', 'sell_deleted', 66, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":66,\"invoice_no\":\"0024\"}', NULL, '2025-08-25 09:17:07', '2025-08-25 09:17:07'),
(259, 'default', 'sell_deleted', 45, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":45,\"invoice_no\":\"0015\"}', NULL, '2025-08-25 09:17:12', '2025-08-25 09:17:12'),
(260, 'default', 'sell_deleted', 62, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":62,\"invoice_no\":\"0022\"}', NULL, '2025-08-25 09:17:42', '2025-08-25 09:17:42'),
(261, 'default', 'sell_deleted', 60, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":60,\"invoice_no\":\"0021\"}', NULL, '2025-08-25 09:17:44', '2025-08-25 09:17:44'),
(262, 'default', 'sell_deleted', 57, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":57,\"invoice_no\":\"2025\\/0011\"}', NULL, '2025-08-25 09:17:47', '2025-08-25 09:17:47'),
(263, 'default', 'sell_deleted', 56, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":56,\"invoice_no\":\"0020\"}', NULL, '2025-08-25 09:17:49', '2025-08-25 09:17:49'),
(264, 'default', 'sell_deleted', 55, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":55,\"invoice_no\":\"2025\\/0010\"}', NULL, '2025-08-25 09:17:52', '2025-08-25 09:17:52'),
(265, 'default', 'sell_deleted', 53, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":53,\"invoice_no\":\"2025\\/0009\"}', NULL, '2025-08-25 09:17:54', '2025-08-25 09:17:54'),
(266, 'default', 'sell_deleted', 49, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":49,\"invoice_no\":\"0017\"}', NULL, '2025-08-25 09:17:58', '2025-08-25 09:17:58'),
(267, 'default', 'sell_deleted', 47, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":47,\"invoice_no\":\"0016\"}', NULL, '2025-08-25 09:18:00', '2025-08-25 09:18:00'),
(268, 'default', 'sell_deleted', 46, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":46,\"invoice_no\":\"2025\\/0005\"}', NULL, '2025-08-25 09:18:03', '2025-08-25 09:18:03'),
(269, 'default', 'added', 73, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":125}}', NULL, '2025-08-25 09:53:44', '2025-08-25 09:53:44'),
(270, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-26 00:04:55', '2025-08-26 00:04:55'),
(271, 'default', 'sell_deleted', 35, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":35,\"invoice_no\":\"0010\",\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"shipping_status\":\"ordered\",\"payment_status\":\"paid\",\"final_total\":\"470.0000\"}}', NULL, '2025-08-26 00:07:22', '2025-08-26 00:07:22'),
(272, 'default', 'sell_deleted', 50, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":50,\"invoice_no\":\"0018\",\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"2.5000\"}}', NULL, '2025-08-26 00:07:28', '2025-08-26 00:07:28'),
(273, 'default', 'sell_deleted', 73, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":73,\"invoice_no\":\"0031\",\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":\"125.0000\"}}', NULL, '2025-08-26 00:07:36', '2025-08-26 00:07:36'),
(274, 'default', 'sell_deleted', 70, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":70,\"invoice_no\":\"0028\",\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"125.0000\"}}', NULL, '2025-08-26 00:07:39', '2025-08-26 00:07:39'),
(275, 'default', 'sell_deleted', 71, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":71,\"invoice_no\":\"0029\",\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"200.0000\"}}', NULL, '2025-08-26 00:07:44', '2025-08-26 00:07:44'),
(276, 'default', 'sell_deleted', 63, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"id\":63,\"invoice_no\":\"0023\",\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"200.0000\"}}', NULL, '2025-08-26 00:07:51', '2025-08-26 00:07:51'),
(277, 'default', 'added', 74, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":125}}', NULL, '2025-08-26 00:08:19', '2025-08-26 00:08:19'),
(278, 'default', 'payment_edited', 74, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"125.0000\"},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"125.0000\"}}', NULL, '2025-08-26 00:08:44', '2025-08-26 00:08:44'),
(279, 'default', 'added', 75, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-26 00:25:13', '2025-08-26 00:25:13'),
(280, 'default', 'edited', 75, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-26 00:57:45', '2025-08-26 00:57:45'),
(281, 'default', 'edited', 75, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-26 01:03:34', '2025-08-26 01:03:34'),
(282, 'default', 'added', 76, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-26 01:06:29', '2025-08-26 01:06:29'),
(283, 'default', 'delivery_edited', 76, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-08-26 02:14:30', '2025-08-26 02:14:30'),
(284, 'default', 'delivery_edited', 76, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-08-26 02:14:47', '2025-08-26 02:14:47'),
(285, 'default', 'delivery_edited', 76, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":\"\\u09a3\\u09a6\\u09b8\\u099c\\u09a4\\u09be\\u09c2\\u09be\\u09cd\"}', NULL, '2025-08-26 02:18:59', '2025-08-26 02:18:59'),
(286, 'default', 'delivery_edited', 76, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-08-26 02:42:09', '2025-08-26 02:42:09'),
(287, 'default', 'delivery_edited', 75, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-08-26 02:43:38', '2025-08-26 02:43:38'),
(288, 'default', 'payment_edited', 76, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-26 03:45:39', '2025-08-26 03:45:39'),
(289, 'default', 'payment_edited', 76, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-26 03:45:59', '2025-08-26 03:45:59'),
(290, 'default', 'payment_edited', 74, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"125.0000\"},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"125.0000\"}}', NULL, '2025-08-26 03:46:49', '2025-08-26 03:46:49'),
(291, 'default', 'payment_deleted', 62, 'App\\TransactionPayment', NULL, 2, 2, 'App\\User', '{\"id\":62,\"ref_no\":\"SP2025\\/0044\"}', NULL, '2025-08-26 03:46:49', '2025-08-26 03:46:49'),
(292, 'default', 'edited', 76, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-26 04:26:39', '2025-08-26 04:26:39'),
(293, 'default', 'payment_edited', 76, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-08-26 04:44:31', '2025-08-26 04:44:31'),
(294, 'default', 'payment_deleted', 64, 'App\\TransactionPayment', NULL, 2, 2, 'App\\User', '{\"id\":64,\"ref_no\":\"SP2025\\/0046\"}', NULL, '2025-08-26 04:44:31', '2025-08-26 04:44:31'),
(295, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-03 23:33:08', '2025-09-03 23:33:08'),
(296, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-05 09:44:52', '2025-09-05 09:44:52'),
(297, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-14 07:15:44', '2025-09-14 07:15:44'),
(298, 'default', 'delivery_edited', 76, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-09-14 07:23:01', '2025-09-14 07:23:01'),
(299, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-14 07:24:12', '2025-09-14 07:24:12'),
(300, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-09-14 07:54:23', '2025-09-14 07:54:23'),
(301, 'default', 'added', 8, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-14 07:26:15', '2025-09-14 07:26:15'),
(302, 'default', 'added', 9, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-14 07:35:54', '2025-09-14 07:35:54'),
(303, 'default', 'edited', 8, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-14 07:51:14', '2025-09-14 07:51:14'),
(304, 'default', 'added', 77, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"purchase\",\"status\":\"ordered\",\"payment_status\":\"due\",\"final_total\":172000}}', NULL, '2025-09-14 07:57:19', '2025-09-14 07:57:19'),
(305, 'default', 'added', 78, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"purchase\",\"status\":\"received\",\"payment_status\":\"due\",\"final_total\":60000}}', NULL, '2025-09-14 08:01:36', '2025-09-14 08:01:36'),
(306, 'default', 'added', 79, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":1000}}', NULL, '2025-09-14 08:03:28', '2025-09-14 08:03:28'),
(307, 'default', 'added', 10, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-14 08:21:49', '2025-09-14 08:21:49'),
(308, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-21 16:38:54', '2025-09-21 16:38:54'),
(309, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-21 18:30:56', '2025-09-21 18:30:56'),
(310, 'default', 'edited', 3, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-21 18:33:16', '2025-09-21 18:33:16'),
(311, 'default', 'edited', 3, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-21 18:33:38', '2025-09-21 18:33:38'),
(312, 'default', 'edited', 3, 'App\\Contact', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-21 18:33:47', '2025-09-21 18:33:47'),
(313, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-22 06:52:29', '2025-09-22 06:52:29'),
(314, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-22 08:42:48', '2025-09-22 08:42:48'),
(315, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-22 17:25:42', '2025-09-22 17:25:42'),
(316, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-09-22 18:43:21', '2025-09-22 18:43:21'),
(317, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-01 16:54:51', '2025-10-01 16:54:51'),
(318, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-03 12:04:26', '2025-10-03 12:04:26'),
(319, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-04 07:21:02', '2025-10-04 07:21:02'),
(320, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-05 04:56:46', '2025-10-05 04:56:46'),
(321, 'default', 'added', 80, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-05 05:42:39', '2025-10-05 05:42:39'),
(322, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-05 10:41:48', '2025-10-05 10:41:48'),
(323, 'default', 'added', 81, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-05 10:48:59', '2025-10-05 10:48:59'),
(324, 'default', 'edited', 81, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-05 10:49:25', '2025-10-05 10:49:25'),
(325, 'default', 'delivery_edited', 81, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"update_note\":null}', NULL, '2025-10-05 12:40:49', '2025-10-05 12:40:49'),
(326, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-05 17:10:30', '2025-10-05 17:10:30'),
(327, 'default', 'added', 82, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-05 17:15:14', '2025-10-05 17:15:14'),
(328, 'default', 'added', 83, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":250}}', NULL, '2025-10-05 17:17:40', '2025-10-05 17:17:40'),
(329, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-06 03:10:45', '2025-10-06 03:10:45'),
(330, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-08 05:24:02', '2025-10-08 05:24:02'),
(331, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-08 15:42:12', '2025-10-08 15:42:12');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `event`, `business_id`, `causer_id`, `causer_type`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(332, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-08 15:46:38', '2025-10-08 15:46:38'),
(333, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-08 16:46:39', '2025-10-08 16:46:39'),
(334, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-08 16:57:17', '2025-10-08 16:57:17'),
(335, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-08 23:05:38', '2025-10-08 23:05:38'),
(336, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 16:04:59', '2025-10-09 16:04:59'),
(337, 'default', 'edited', 81, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 16:06:25', '2025-10-09 16:06:25'),
(338, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 17:20:02', '2025-10-09 17:20:02'),
(339, 'default', 'edited', 80, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 17:20:33', '2025-10-09 17:20:33'),
(340, 'default', 'edited', 80, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 17:21:19', '2025-10-09 17:21:19'),
(341, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 17:26:32', '2025-10-09 17:26:32'),
(342, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-10-09 17:56:41', '2025-10-09 17:56:41'),
(343, 'default', 'logout', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2025-10-09 18:05:04', '2025-10-09 18:05:04'),
(344, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 17:35:08', '2025-10-09 17:35:08'),
(345, 'default', 'payment_edited', 80, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 17:37:56', '2025-10-09 17:37:56'),
(346, 'default', 'added', 84, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":250}}', NULL, '2025-10-09 17:49:17', '2025-10-09 17:49:17'),
(347, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 18:28:19', '2025-10-09 18:28:19'),
(348, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 22:49:07', '2025-10-09 22:49:07'),
(349, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 22:51:08', '2025-10-09 22:51:08'),
(350, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 22:51:57', '2025-10-09 22:51:57'),
(351, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 22:51:58', '2025-10-09 22:51:58'),
(352, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-09 22:52:02', '2025-10-09 22:52:02'),
(353, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-10 00:14:04', '2025-10-10 00:14:04'),
(354, 'default', 'added', 85, 'App\\Transaction', NULL, 2, 2, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":1.25}}', NULL, '2025-10-10 00:45:16', '2025-10-10 00:45:16'),
(355, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-10 19:14:26', '2025-10-10 19:14:26'),
(356, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-12 07:33:31', '2025-10-12 07:33:31'),
(357, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-12 07:39:23', '2025-10-12 07:39:23'),
(358, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-12 08:18:24', '2025-10-12 08:18:24'),
(359, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-13 05:42:31', '2025-10-13 05:42:31'),
(360, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-17 18:47:14', '2025-10-17 18:47:14'),
(361, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-17 19:14:47', '2025-10-17 19:14:47'),
(362, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-18 07:45:14', '2025-10-18 07:45:14'),
(363, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-19 11:23:31', '2025-10-19 11:23:31'),
(364, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2025-10-29 05:23:26', '2025-10-29 05:23:26'),
(365, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-17 16:45:31', '2026-03-17 16:45:31'),
(366, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-17 17:05:34', '2026-03-17 17:05:35'),
(367, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-17 18:11:00', '2026-03-17 18:11:00'),
(368, 'default', 'added', 86, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-17 18:13:12', '2026-03-17 18:13:12'),
(369, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-18 15:27:20', '2026-03-18 15:27:20'),
(370, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-18 17:01:33', '2026-03-18 17:01:33'),
(371, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-19 17:29:47', '2026-03-19 17:29:47'),
(372, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-20 16:13:43', '2026-03-20 16:13:43'),
(373, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-20 17:08:24', '2026-03-20 17:08:24'),
(374, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-22 14:52:18', '2026-03-22 14:52:18'),
(375, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-22 14:58:59', '2026-03-22 14:58:59'),
(376, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-22 15:30:13', '2026-03-22 15:30:13'),
(377, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2026-03-24 16:02:14', '2026-03-24 16:02:14'),
(378, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2026-03-24 17:53:40', '2026-03-24 17:53:40'),
(379, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2026-03-24 17:59:07', '2026-03-24 17:59:07'),
(380, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-24 17:32:02', '2026-03-24 17:32:02'),
(381, 'default', 'added', 87, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-24 17:32:47', '2026-03-24 17:32:47'),
(382, 'default', 'added', 88, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-24 17:33:04', '2026-03-24 17:33:04'),
(383, 'default', 'added', 89, 'App\\Transaction', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-24 17:33:22', '2026-03-24 17:33:22'),
(384, 'default', 'logout', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-24 18:17:07', '2026-03-24 18:17:07'),
(385, 'default', 'login', 5, 'App\\User', NULL, 3, 5, 'App\\User', '[]', NULL, '2026-03-24 18:47:19', '2026-03-24 18:47:19'),
(386, 'default', 'added', 92, 'App\\Transaction', NULL, 3, 5, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":2.5}}', NULL, '2026-03-24 18:50:09', '2026-03-24 18:50:09'),
(387, 'default', 'edited', 11, 'App\\Contact', NULL, 3, 5, 'App\\User', '[]', NULL, '2026-03-24 18:53:16', '2026-03-24 18:53:16'),
(388, 'default', 'edited', 11, 'App\\Contact', NULL, 3, 5, 'App\\User', '[]', NULL, '2026-03-24 18:54:01', '2026-03-24 18:54:01'),
(389, 'default', 'added', 93, 'App\\Transaction', NULL, 3, 5, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":1.25}}', NULL, '2026-03-24 18:54:30', '2026-03-24 18:54:30'),
(390, 'default', 'added', 94, 'App\\Transaction', NULL, 3, 5, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":1.25}}', NULL, '2026-03-24 18:54:54', '2026-03-24 18:54:54'),
(391, 'default', 'added', 95, 'App\\Transaction', NULL, 3, 5, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":1.25}}', NULL, '2026-03-24 18:56:05', '2026-03-24 18:56:05'),
(392, 'default', 'added', 96, 'App\\Transaction', NULL, 3, 5, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":1.25}}', NULL, '2026-03-24 18:56:23', '2026-03-24 18:56:23'),
(393, 'default', 'added', 97, 'App\\Transaction', NULL, 3, 5, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":1.25}}', NULL, '2026-03-24 18:56:35', '2026-03-24 18:56:35'),
(394, 'default', 'added', 98, 'App\\Transaction', NULL, 3, 5, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":1.25}}', NULL, '2026-03-24 18:58:14', '2026-03-24 18:58:14'),
(395, 'default', 'added', 99, 'App\\Transaction', NULL, 3, 5, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":1.25}}', NULL, '2026-03-24 19:01:42', '2026-03-24 19:01:42'),
(396, 'default', 'added', 100, 'App\\Transaction', NULL, 3, 5, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":1.25}}', NULL, '2026-03-24 19:01:56', '2026-03-24 19:01:56'),
(397, 'default', 'added', 101, 'App\\Transaction', NULL, 3, 5, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":1.25}}', NULL, '2026-03-24 19:02:08', '2026-03-24 19:02:08'),
(398, 'default', 'added', 102, 'App\\Transaction', NULL, 3, 5, 'App\\User', '[]', NULL, '2026-03-24 19:03:20', '2026-03-24 19:03:20'),
(399, 'default', 'added', 103, 'App\\Transaction', NULL, 3, 5, 'App\\User', '[]', NULL, '2026-03-24 19:03:31', '2026-03-24 19:03:31'),
(400, 'default', 'edited', 11, 'App\\Contact', NULL, 3, 5, 'App\\User', '[]', NULL, '2026-03-24 19:05:04', '2026-03-24 19:05:04'),
(401, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-25 16:33:06', '2026-03-25 16:33:06'),
(402, 'default', 'login', 1, 'App\\User', NULL, 1, 1, 'App\\User', '[]', NULL, '2026-03-25 17:04:38', '2026-03-25 17:04:38'),
(403, 'default', 'login', 2, 'App\\User', NULL, 2, 2, 'App\\User', '[]', NULL, '2026-03-27 04:21:42', '2026-03-27 04:21:42');

-- --------------------------------------------------------

--
-- Table structure for table `barcodes`
--

CREATE TABLE `barcodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `width` double(22,4) DEFAULT NULL,
  `height` double(22,4) DEFAULT NULL,
  `paper_width` double(22,4) DEFAULT NULL,
  `paper_height` double(22,4) DEFAULT NULL,
  `top_margin` double(22,4) DEFAULT NULL,
  `left_margin` double(22,4) DEFAULT NULL,
  `row_distance` double(22,4) DEFAULT NULL,
  `col_distance` double(22,4) DEFAULT NULL,
  `stickers_in_one_row` int(11) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_continuous` tinyint(1) NOT NULL DEFAULT 0,
  `stickers_in_one_sheet` int(11) DEFAULT NULL,
  `business_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barcodes`
--

INSERT INTO `barcodes` (`id`, `name`, `description`, `width`, `height`, `paper_width`, `paper_height`, `top_margin`, `left_margin`, `row_distance`, `col_distance`, `stickers_in_one_row`, `is_default`, `is_continuous`, `stickers_in_one_sheet`, `business_id`, `created_at`, `updated_at`) VALUES
(1, '20 Labels per Sheet', 'Sheet Size: 8.5\" x 11\", Label Size: 4\" x 1\", Labels per sheet: 20', 4.0000, 1.0000, 8.5000, 11.0000, 0.5000, 0.1250, 0.0000, 0.1875, 2, 0, 0, 20, NULL, '2017-12-18 00:13:44', '2017-12-18 00:13:44'),
(2, '30 Labels per sheet', 'Sheet Size: 8.5\" x 11\", Label Size: 2.625\" x 1\", Labels per sheet: 30', 2.6250, 1.0000, 8.5000, 11.0000, 0.5000, 0.1880, 0.0000, 0.1250, 3, 0, 0, 30, NULL, '2017-12-18 00:04:39', '2017-12-18 00:10:40'),
(3, '32 Labels per sheet', 'Sheet Size: 8.5\" x 11\", Label Size: 2\" x 1.25\", Labels per sheet: 32', 2.0000, 1.2500, 8.5000, 11.0000, 0.5000, 0.2500, 0.0000, 0.0000, 4, 0, 0, 32, NULL, '2017-12-17 23:55:40', '2017-12-17 23:55:40'),
(4, '40 Labels per sheet', 'Sheet Size: 8.5\" x 11\", Label Size: 2\" x 1\", Labels per sheet: 40', 2.0000, 1.0000, 8.5000, 11.0000, 0.5000, 0.2500, 0.0000, 0.0000, 4, 0, 0, 40, NULL, '2017-12-17 23:58:40', '2017-12-17 23:58:40'),
(5, '50 Labels per Sheet', 'Sheet Size: 8.5\" x 11\", Label Size: 1.5\" x 1\", Labels per sheet: 50', 1.5000, 1.0000, 8.5000, 11.0000, 0.5000, 0.5000, 0.0000, 0.0000, 5, 0, 0, 50, NULL, '2017-12-17 23:51:10', '2017-12-17 23:51:10'),
(6, 'Continuous Rolls - 31.75mm x 25.4mm', 'Label Size: 31.75mm x 25.4mm, Gap: 3.18mm', 1.2500, 1.0000, 1.2500, 0.0000, 0.1250, 0.0000, 0.1250, 0.0000, 1, 0, 1, NULL, NULL, '2017-12-17 23:51:10', '2017-12-17 23:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `waiter_id` int(10) UNSIGNED DEFAULT NULL,
  `table_id` int(10) UNSIGNED DEFAULT NULL,
  `correspondent_id` int(11) DEFAULT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `booking_start` datetime NOT NULL,
  `booking_end` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `booking_status` varchar(191) NOT NULL,
  `booking_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `business_id`, `name`, `description`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test', 'test', 1, NULL, '2025-07-03 05:42:58', '2025-07-03 05:42:58'),
(2, 2, 'First', NULL, 2, NULL, '2025-07-03 05:43:50', '2025-07-03 05:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `currency_id` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `tax_number_1` varchar(100) DEFAULT NULL,
  `tax_label_1` varchar(10) DEFAULT NULL,
  `tax_number_2` varchar(100) DEFAULT NULL,
  `tax_label_2` varchar(10) DEFAULT NULL,
  `code_label_1` varchar(191) DEFAULT NULL,
  `code_1` varchar(191) DEFAULT NULL,
  `code_label_2` varchar(191) DEFAULT NULL,
  `code_2` varchar(191) DEFAULT NULL,
  `default_sales_tax` int(10) UNSIGNED DEFAULT NULL,
  `default_profit_percent` double(5,2) NOT NULL DEFAULT 0.00,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `time_zone` varchar(191) NOT NULL DEFAULT 'Asia/Kolkata',
  `fy_start_month` tinyint(4) NOT NULL DEFAULT 1,
  `accounting_method` enum('fifo','lifo','avco') NOT NULL DEFAULT 'fifo',
  `default_sales_discount` decimal(5,2) DEFAULT NULL,
  `sell_price_tax` enum('includes','excludes') NOT NULL DEFAULT 'includes',
  `logo` varchar(191) DEFAULT NULL,
  `sku_prefix` varchar(191) DEFAULT NULL,
  `enable_product_expiry` tinyint(1) NOT NULL DEFAULT 0,
  `expiry_type` enum('add_expiry','add_manufacturing') NOT NULL DEFAULT 'add_expiry',
  `on_product_expiry` enum('keep_selling','stop_selling','auto_delete') NOT NULL DEFAULT 'keep_selling',
  `stop_selling_before` int(11) NOT NULL COMMENT 'Stop selling expied item n days before expiry',
  `enable_tooltip` tinyint(1) NOT NULL DEFAULT 1,
  `purchase_in_diff_currency` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Allow purchase to be in different currency then the business currency',
  `purchase_currency_id` int(10) UNSIGNED DEFAULT NULL,
  `p_exchange_rate` decimal(20,3) NOT NULL DEFAULT 1.000,
  `transaction_edit_days` int(10) UNSIGNED NOT NULL DEFAULT 30,
  `stock_expiry_alert_days` int(10) UNSIGNED NOT NULL DEFAULT 30,
  `keyboard_shortcuts` text DEFAULT NULL,
  `pos_settings` text DEFAULT NULL,
  `woocommerce_api_settings` text DEFAULT NULL,
  `woocommerce_skipped_orders` text DEFAULT NULL,
  `woocommerce_wh_oc_secret` varchar(191) DEFAULT NULL,
  `woocommerce_wh_ou_secret` varchar(191) DEFAULT NULL,
  `woocommerce_wh_od_secret` varchar(191) DEFAULT NULL,
  `woocommerce_wh_or_secret` varchar(191) DEFAULT NULL,
  `weighing_scale_setting` text NOT NULL COMMENT 'used to store the configuration of weighing scale',
  `enable_brand` tinyint(1) NOT NULL DEFAULT 1,
  `enable_category` tinyint(1) NOT NULL DEFAULT 1,
  `enable_sub_category` tinyint(1) NOT NULL DEFAULT 1,
  `enable_price_tax` tinyint(1) NOT NULL DEFAULT 1,
  `enable_purchase_status` tinyint(1) DEFAULT 1,
  `enable_lot_number` tinyint(1) NOT NULL DEFAULT 0,
  `default_unit` int(11) DEFAULT NULL,
  `enable_sub_units` tinyint(1) NOT NULL DEFAULT 0,
  `enable_racks` tinyint(1) NOT NULL DEFAULT 0,
  `enable_row` tinyint(1) NOT NULL DEFAULT 0,
  `enable_position` tinyint(1) NOT NULL DEFAULT 0,
  `enable_editing_product_from_purchase` tinyint(1) NOT NULL DEFAULT 1,
  `sales_cmsn_agnt` enum('logged_in_user','user','cmsn_agnt') DEFAULT NULL,
  `item_addition_method` tinyint(1) NOT NULL DEFAULT 1,
  `enable_inline_tax` tinyint(1) NOT NULL DEFAULT 1,
  `currency_symbol_placement` enum('before','after') NOT NULL DEFAULT 'before',
  `enabled_modules` text DEFAULT NULL,
  `date_format` varchar(191) NOT NULL DEFAULT 'm/d/Y',
  `time_format` enum('12','24') NOT NULL DEFAULT '24',
  `currency_precision` tinyint(4) NOT NULL DEFAULT 2,
  `quantity_precision` tinyint(4) NOT NULL DEFAULT 2,
  `ref_no_prefixes` text DEFAULT NULL,
  `theme_color` char(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `enable_rp` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `rp_name` varchar(191) DEFAULT NULL COMMENT 'rp is the short form of reward points',
  `amount_for_unit_rp` decimal(22,4) NOT NULL DEFAULT 1.0000 COMMENT 'rp is the short form of reward points',
  `min_order_total_for_rp` decimal(22,4) NOT NULL DEFAULT 1.0000 COMMENT 'rp is the short form of reward points',
  `max_rp_per_order` int(11) DEFAULT NULL COMMENT 'rp is the short form of reward points',
  `redeem_amount_per_unit_rp` decimal(22,4) NOT NULL DEFAULT 1.0000 COMMENT 'rp is the short form of reward points',
  `min_order_total_for_redeem` decimal(22,4) NOT NULL DEFAULT 1.0000 COMMENT 'rp is the short form of reward points',
  `min_redeem_point` int(11) DEFAULT NULL COMMENT 'rp is the short form of reward points',
  `max_redeem_point` int(11) DEFAULT NULL COMMENT 'rp is the short form of reward points',
  `rp_expiry_period` int(11) DEFAULT NULL COMMENT 'rp is the short form of reward points',
  `rp_expiry_type` enum('month','year') NOT NULL DEFAULT 'year' COMMENT 'rp is the short form of reward points',
  `email_settings` text DEFAULT NULL,
  `sms_settings` text DEFAULT NULL,
  `custom_labels` text DEFAULT NULL,
  `common_settings` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `name`, `currency_id`, `start_date`, `tax_number_1`, `tax_label_1`, `tax_number_2`, `tax_label_2`, `code_label_1`, `code_1`, `code_label_2`, `code_2`, `default_sales_tax`, `default_profit_percent`, `owner_id`, `time_zone`, `fy_start_month`, `accounting_method`, `default_sales_discount`, `sell_price_tax`, `logo`, `sku_prefix`, `enable_product_expiry`, `expiry_type`, `on_product_expiry`, `stop_selling_before`, `enable_tooltip`, `purchase_in_diff_currency`, `purchase_currency_id`, `p_exchange_rate`, `transaction_edit_days`, `stock_expiry_alert_days`, `keyboard_shortcuts`, `pos_settings`, `woocommerce_api_settings`, `woocommerce_skipped_orders`, `woocommerce_wh_oc_secret`, `woocommerce_wh_ou_secret`, `woocommerce_wh_od_secret`, `woocommerce_wh_or_secret`, `weighing_scale_setting`, `enable_brand`, `enable_category`, `enable_sub_category`, `enable_price_tax`, `enable_purchase_status`, `enable_lot_number`, `default_unit`, `enable_sub_units`, `enable_racks`, `enable_row`, `enable_position`, `enable_editing_product_from_purchase`, `sales_cmsn_agnt`, `item_addition_method`, `enable_inline_tax`, `currency_symbol_placement`, `enabled_modules`, `date_format`, `time_format`, `currency_precision`, `quantity_precision`, `ref_no_prefixes`, `theme_color`, `created_by`, `enable_rp`, `rp_name`, `amount_for_unit_rp`, `min_order_total_for_rp`, `max_rp_per_order`, `redeem_amount_per_unit_rp`, `min_order_total_for_redeem`, `min_redeem_point`, `max_redeem_point`, `rp_expiry_period`, `rp_expiry_type`, `email_settings`, `sms_settings`, `custom_labels`, `common_settings`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Microwebs POS', 134, '2024-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.00, 1, 'Asia/Dhaka', 1, 'fifo', 0.00, 'includes', NULL, NULL, 0, 'add_expiry', 'keep_selling', 0, 1, 0, NULL, 1.000, 30, 30, '{\"pos\":{\"express_checkout\":\"shift+e\",\"pay_n_ckeckout\":\"shift+p\",\"draft\":\"shift+d\",\"cancel\":\"shift+c\",\"recent_product_quantity\":\"f2\",\"weighing_scale\":null,\"edit_discount\":\"shift+i\",\"edit_order_tax\":\"shift+t\",\"add_payment_row\":\"shift+r\",\"finalize_payment\":\"shift+f\",\"add_new_product\":\"f4\"}}', '{\"amount_rounding_method\":null,\"cmmsn_calculation_type\":\"invoice_value\",\"razor_pay_key_id\":null,\"razor_pay_key_secret\":null,\"stripe_public_key\":null,\"stripe_secret_key\":null,\"cash_denominations\":null,\"enable_cash_denomination_on\":\"pos_screen\",\"disable_pay_checkout\":0,\"disable_draft\":0,\"disable_express_checkout\":0,\"hide_product_suggestion\":0,\"hide_recent_trans\":0,\"disable_discount\":0,\"disable_order_tax\":0,\"is_pos_subtotal_editable\":0}', NULL, NULL, NULL, NULL, NULL, NULL, '{\"label_prefix\":null,\"product_sku_length\":\"4\",\"qty_length\":\"3\",\"qty_length_decimal\":\"2\"}', 1, 1, 1, 1, 1, 0, NULL, 0, 0, 0, 0, 1, NULL, 1, 0, 'before', '[\"purchases\",\"add_sale\",\"pos_sale\",\"stock_transfers\",\"stock_adjustment\",\"expenses\",\"tailoring\"]', 'm/d/Y', '24', 2, 2, '{\"purchase\":\"PO\",\"purchase_return\":null,\"purchase_requisition\":null,\"purchase_order\":null,\"stock_transfer\":\"ST\",\"stock_adjustment\":\"SA\",\"sell_return\":\"CN\",\"expense\":\"EP\",\"contacts\":\"CO\",\"purchase_payment\":\"PP\",\"sell_payment\":\"SP\",\"expense_payment\":null,\"business_location\":\"BL\",\"username\":null,\"subscription\":null,\"draft\":null,\"sales_order\":null}', 'primary', NULL, 0, NULL, 1.0000, 1.0000, NULL, 1.0000, 1.0000, NULL, NULL, NULL, 'year', '{\"mail_driver\":\"smtp\",\"mail_host\":null,\"mail_port\":null,\"mail_username\":null,\"mail_password\":null,\"mail_encryption\":null,\"mail_from_address\":null,\"mail_from_name\":null}', '{\"sms_service\":\"other\",\"nexmo_key\":null,\"nexmo_secret\":null,\"nexmo_from\":null,\"twilio_sid\":null,\"twilio_token\":null,\"twilio_from\":null,\"url\":null,\"send_to_param_name\":\"to\",\"msg_param_name\":\"text\",\"request_method\":\"post\",\"header_1\":null,\"header_val_1\":null,\"header_2\":null,\"header_val_2\":null,\"header_3\":null,\"header_val_3\":null,\"param_1\":null,\"param_val_1\":null,\"param_2\":null,\"param_val_2\":null,\"param_3\":null,\"param_val_3\":null,\"param_4\":null,\"param_val_4\":null,\"param_5\":null,\"param_val_5\":null,\"param_6\":null,\"param_val_6\":null,\"param_7\":null,\"param_val_7\":null,\"param_8\":null,\"param_val_8\":null,\"param_9\":null,\"param_val_9\":null,\"param_10\":null,\"param_val_10\":null}', '{\"payments\":{\"custom_pay_1\":null,\"custom_pay_2\":null,\"custom_pay_3\":null,\"custom_pay_4\":null,\"custom_pay_5\":null,\"custom_pay_6\":null,\"custom_pay_7\":null},\"contact\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null,\"custom_field_7\":null,\"custom_field_8\":null,\"custom_field_9\":null,\"custom_field_10\":null},\"product\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null,\"custom_field_7\":null,\"custom_field_8\":null,\"custom_field_9\":null,\"custom_field_10\":null,\"custom_field_11\":null,\"custom_field_12\":null,\"custom_field_13\":null,\"custom_field_14\":null,\"custom_field_15\":null,\"custom_field_16\":null,\"custom_field_17\":null,\"custom_field_18\":null,\"custom_field_19\":null,\"custom_field_20\":null},\"product_cf_details\":{\"1\":{\"type\":null,\"dropdown_options\":null},\"2\":{\"type\":null,\"dropdown_options\":null},\"3\":{\"type\":null,\"dropdown_options\":null},\"4\":{\"type\":null,\"dropdown_options\":null},\"5\":{\"type\":null,\"dropdown_options\":null},\"6\":{\"type\":null,\"dropdown_options\":null},\"7\":{\"type\":null,\"dropdown_options\":null},\"8\":{\"type\":null,\"dropdown_options\":null},\"9\":{\"type\":null,\"dropdown_options\":null},\"10\":{\"type\":null,\"dropdown_options\":null},\"11\":{\"type\":null,\"dropdown_options\":null},\"12\":{\"type\":null,\"dropdown_options\":null},\"13\":{\"type\":null,\"dropdown_options\":null},\"14\":{\"type\":null,\"dropdown_options\":null},\"15\":{\"type\":null,\"dropdown_options\":null},\"16\":{\"type\":null,\"dropdown_options\":null},\"17\":{\"type\":null,\"dropdown_options\":null},\"18\":{\"type\":null,\"dropdown_options\":null},\"19\":{\"type\":null,\"dropdown_options\":null},\"20\":{\"type\":null,\"dropdown_options\":null}},\"location\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"user\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"purchase\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"purchase_shipping\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null},\"sell\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"shipping\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null},\"types_of_service\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null}}', '{\"default_credit_limit\":null,\"default_datatable_page_entries\":\"25\"}', 1, '2024-03-22 09:48:05', '2025-07-02 05:24:25'),
(2, 'Test Business', 134, '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.00, 2, 'Asia/Kolkata', 1, 'fifo', 0.00, 'includes', '1751431818_sourcenet.png', NULL, 0, 'add_expiry', 'keep_selling', 0, 1, 0, NULL, 1.000, 160, 30, '{\"pos\":{\"express_checkout\":\"shift+e\",\"pay_n_ckeckout\":\"shift+p\",\"draft\":\"shift+d\",\"cancel\":\"shift+c\",\"recent_product_quantity\":\"f2\",\"weighing_scale\":null,\"edit_discount\":\"shift+i\",\"edit_order_tax\":\"shift+t\",\"add_payment_row\":\"shift+r\",\"finalize_payment\":\"shift+f\",\"add_new_product\":\"f4\"}}', '{\"amount_rounding_method\":null,\"allow_overselling\":\"1\",\"cmmsn_calculation_type\":\"invoice_value\",\"enable_payment_link\":\"1\",\"razor_pay_key_id\":null,\"razor_pay_key_secret\":null,\"stripe_public_key\":null,\"stripe_secret_key\":null,\"cash_denominations\":null,\"enable_cash_denomination_on\":\"pos_screen\",\"disable_pay_checkout\":0,\"disable_draft\":0,\"disable_express_checkout\":0,\"hide_product_suggestion\":0,\"hide_recent_trans\":0,\"disable_discount\":0,\"disable_order_tax\":0,\"is_pos_subtotal_editable\":0}', NULL, NULL, NULL, NULL, NULL, NULL, '{\"label_prefix\":null,\"product_sku_length\":\"4\",\"qty_length\":\"3\",\"qty_length_decimal\":\"2\"}', 1, 1, 1, 1, 1, 0, 2, 0, 0, 0, 0, 1, NULL, 1, 0, 'before', '[\"purchases\",\"add_sale\",\"pos_sale\",\"stock_transfers\",\"stock_adjustment\",\"expenses\",\"account\",\"tailoring\"]', 'm/d/Y', '24', 2, 2, '{\"purchase\":\"PO\",\"purchase_return\":null,\"purchase_requisition\":null,\"purchase_order\":null,\"stock_transfer\":\"ST\",\"stock_adjustment\":\"SA\",\"sell_return\":\"CN\",\"expense\":\"EP\",\"contacts\":\"CO\",\"purchase_payment\":\"PP\",\"sell_payment\":\"SP\",\"expense_payment\":null,\"business_location\":\"BL\",\"username\":null,\"subscription\":null,\"draft\":null,\"sales_order\":null}', NULL, 1, 0, NULL, 1.0000, 1.0000, NULL, 1.0000, 1.0000, NULL, NULL, NULL, 'year', '{\"mail_driver\":\"smtp\",\"mail_host\":null,\"mail_port\":null,\"mail_username\":null,\"mail_password\":null,\"mail_encryption\":null,\"mail_from_address\":null,\"mail_from_name\":null}', '{\"sms_service\":\"other\",\"nexmo_key\":null,\"nexmo_secret\":null,\"nexmo_from\":null,\"twilio_sid\":null,\"twilio_token\":null,\"twilio_from\":null,\"url\":null,\"send_to_param_name\":\"to\",\"msg_param_name\":\"text\",\"request_method\":\"post\",\"header_1\":null,\"header_val_1\":null,\"header_2\":null,\"header_val_2\":null,\"header_3\":null,\"header_val_3\":null,\"param_1\":null,\"param_val_1\":null,\"param_2\":null,\"param_val_2\":null,\"param_3\":null,\"param_val_3\":null,\"param_4\":null,\"param_val_4\":null,\"param_5\":null,\"param_val_5\":null,\"param_6\":null,\"param_val_6\":null,\"param_7\":null,\"param_val_7\":null,\"param_8\":null,\"param_val_8\":null,\"param_9\":null,\"param_val_9\":null,\"param_10\":null,\"param_val_10\":null}', '{\"payments\":{\"custom_pay_1\":null,\"custom_pay_2\":null,\"custom_pay_3\":null,\"custom_pay_4\":null,\"custom_pay_5\":null,\"custom_pay_6\":null,\"custom_pay_7\":null},\"contact\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null,\"custom_field_7\":null,\"custom_field_8\":null,\"custom_field_9\":null,\"custom_field_10\":null},\"product\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null,\"custom_field_7\":null,\"custom_field_8\":null,\"custom_field_9\":null,\"custom_field_10\":null,\"custom_field_11\":null,\"custom_field_12\":null,\"custom_field_13\":null,\"custom_field_14\":null,\"custom_field_15\":null,\"custom_field_16\":null,\"custom_field_17\":null,\"custom_field_18\":null,\"custom_field_19\":null,\"custom_field_20\":null},\"product_cf_details\":{\"1\":{\"type\":null,\"dropdown_options\":null},\"2\":{\"type\":null,\"dropdown_options\":null},\"3\":{\"type\":null,\"dropdown_options\":null},\"4\":{\"type\":null,\"dropdown_options\":null},\"5\":{\"type\":null,\"dropdown_options\":null},\"6\":{\"type\":null,\"dropdown_options\":null},\"7\":{\"type\":null,\"dropdown_options\":null},\"8\":{\"type\":null,\"dropdown_options\":null},\"9\":{\"type\":null,\"dropdown_options\":null},\"10\":{\"type\":null,\"dropdown_options\":null},\"11\":{\"type\":null,\"dropdown_options\":null},\"12\":{\"type\":null,\"dropdown_options\":null},\"13\":{\"type\":null,\"dropdown_options\":null},\"14\":{\"type\":null,\"dropdown_options\":null},\"15\":{\"type\":null,\"dropdown_options\":null},\"16\":{\"type\":null,\"dropdown_options\":null},\"17\":{\"type\":null,\"dropdown_options\":null},\"18\":{\"type\":null,\"dropdown_options\":null},\"19\":{\"type\":null,\"dropdown_options\":null},\"20\":{\"type\":null,\"dropdown_options\":null}},\"location\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"user\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"purchase\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"purchase_shipping\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null},\"sell\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"shipping\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null},\"types_of_service\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null}}', '{\"default_credit_limit\":null,\"default_datatable_page_entries\":\"25\"}', 1, '2025-07-02 04:50:18', '2025-10-10 00:44:57'),
(3, 'NEW', 134, '2026-03-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.00, 5, 'Asia/Dhaka', 1, 'fifo', 0.00, 'includes', NULL, NULL, 0, 'add_expiry', 'keep_selling', 0, 1, 0, NULL, 1.000, 30, 30, '{\"pos\":{\"express_checkout\":\"shift+e\",\"pay_n_ckeckout\":\"shift+p\",\"draft\":\"shift+d\",\"cancel\":\"shift+c\",\"recent_product_quantity\":\"f2\",\"weighing_scale\":null,\"edit_discount\":\"shift+i\",\"edit_order_tax\":\"shift+t\",\"add_payment_row\":\"shift+r\",\"finalize_payment\":\"shift+f\",\"add_new_product\":\"f4\"}}', '{\"amount_rounding_method\":null,\"cmmsn_calculation_type\":\"invoice_value\",\"razor_pay_key_id\":null,\"razor_pay_key_secret\":null,\"stripe_public_key\":null,\"stripe_secret_key\":null,\"cash_denominations\":null,\"enable_cash_denomination_on\":\"pos_screen\",\"disable_pay_checkout\":0,\"disable_draft\":0,\"disable_express_checkout\":0,\"hide_product_suggestion\":0,\"hide_recent_trans\":0,\"disable_discount\":0,\"disable_order_tax\":0,\"is_pos_subtotal_editable\":0}', NULL, NULL, NULL, NULL, NULL, NULL, '{\"label_prefix\":null,\"product_sku_length\":\"4\",\"qty_length\":\"3\",\"qty_length_decimal\":\"2\"}', 1, 1, 1, 1, 1, 0, NULL, 0, 0, 0, 0, 1, NULL, 1, 0, 'before', '[\"purchases\",\"add_sale\",\"pos_sale\",\"stock_transfers\",\"stock_adjustment\",\"expenses\",\"tailoring\"]', 'm/d/Y', '24', 2, 2, '{\"purchase\":\"PO\",\"purchase_return\":null,\"purchase_requisition\":null,\"purchase_order\":null,\"stock_transfer\":\"ST\",\"stock_adjustment\":\"SA\",\"sell_return\":\"CN\",\"expense\":\"EP\",\"contacts\":\"CO\",\"purchase_payment\":\"PP\",\"sell_payment\":\"SP\",\"expense_payment\":null,\"business_location\":\"BL\",\"username\":null,\"subscription\":null,\"draft\":null,\"sales_order\":null}', NULL, 1, 0, NULL, 1.0000, 1.0000, NULL, 1.0000, 1.0000, NULL, NULL, NULL, 'year', '{\"mail_driver\":\"smtp\",\"mail_host\":null,\"mail_port\":null,\"mail_username\":null,\"mail_password\":null,\"mail_encryption\":null,\"mail_from_address\":null,\"mail_from_name\":null}', '{\"sms_service\":\"other\",\"nexmo_key\":null,\"nexmo_secret\":null,\"nexmo_from\":null,\"twilio_sid\":null,\"twilio_token\":null,\"twilio_from\":null,\"url\":null,\"send_to_param_name\":\"to\",\"msg_param_name\":\"text\",\"request_method\":\"post\",\"header_1\":null,\"header_val_1\":null,\"header_2\":null,\"header_val_2\":null,\"header_3\":null,\"header_val_3\":null,\"param_1\":null,\"param_val_1\":null,\"param_2\":null,\"param_val_2\":null,\"param_3\":null,\"param_val_3\":null,\"param_4\":null,\"param_val_4\":null,\"param_5\":null,\"param_val_5\":null,\"param_6\":null,\"param_val_6\":null,\"param_7\":null,\"param_val_7\":null,\"param_8\":null,\"param_val_8\":null,\"param_9\":null,\"param_val_9\":null,\"param_10\":null,\"param_val_10\":null}', '{\"payments\":{\"custom_pay_1\":null,\"custom_pay_2\":null,\"custom_pay_3\":null,\"custom_pay_4\":null,\"custom_pay_5\":null,\"custom_pay_6\":null,\"custom_pay_7\":null},\"contact\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null,\"custom_field_7\":null,\"custom_field_8\":null,\"custom_field_9\":null,\"custom_field_10\":null},\"product\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null,\"custom_field_7\":null,\"custom_field_8\":null,\"custom_field_9\":null,\"custom_field_10\":null,\"custom_field_11\":null,\"custom_field_12\":null,\"custom_field_13\":null,\"custom_field_14\":null,\"custom_field_15\":null,\"custom_field_16\":null,\"custom_field_17\":null,\"custom_field_18\":null,\"custom_field_19\":null,\"custom_field_20\":null},\"product_cf_details\":{\"1\":{\"type\":null,\"dropdown_options\":null},\"2\":{\"type\":null,\"dropdown_options\":null},\"3\":{\"type\":null,\"dropdown_options\":null},\"4\":{\"type\":null,\"dropdown_options\":null},\"5\":{\"type\":null,\"dropdown_options\":null},\"6\":{\"type\":null,\"dropdown_options\":null},\"7\":{\"type\":null,\"dropdown_options\":null},\"8\":{\"type\":null,\"dropdown_options\":null},\"9\":{\"type\":null,\"dropdown_options\":null},\"10\":{\"type\":null,\"dropdown_options\":null},\"11\":{\"type\":null,\"dropdown_options\":null},\"12\":{\"type\":null,\"dropdown_options\":null},\"13\":{\"type\":null,\"dropdown_options\":null},\"14\":{\"type\":null,\"dropdown_options\":null},\"15\":{\"type\":null,\"dropdown_options\":null},\"16\":{\"type\":null,\"dropdown_options\":null},\"17\":{\"type\":null,\"dropdown_options\":null},\"18\":{\"type\":null,\"dropdown_options\":null},\"19\":{\"type\":null,\"dropdown_options\":null},\"20\":{\"type\":null,\"dropdown_options\":null}},\"location\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"user\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"purchase\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"purchase_shipping\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null},\"sell\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"shipping\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null},\"types_of_service\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null}}', '{\"default_credit_limit\":null,\"default_datatable_page_entries\":\"25\"}', 1, '2026-03-24 18:17:02', '2026-03-24 19:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `business_locations`
--

CREATE TABLE `business_locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` varchar(191) DEFAULT NULL,
  `name` varchar(256) NOT NULL,
  `landmark` text DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` char(7) NOT NULL,
  `invoice_scheme_id` int(10) UNSIGNED NOT NULL,
  `sale_invoice_scheme_id` int(11) DEFAULT NULL,
  `invoice_layout_id` int(10) UNSIGNED NOT NULL,
  `sale_invoice_layout_id` int(11) DEFAULT NULL,
  `selling_price_group_id` int(11) DEFAULT NULL,
  `print_receipt_on_invoice` tinyint(1) DEFAULT 1,
  `receipt_printer_type` enum('browser','printer') NOT NULL DEFAULT 'browser',
  `printer_id` int(11) DEFAULT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `alternate_number` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `website` varchar(191) DEFAULT NULL,
  `featured_products` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `default_payment_accounts` text DEFAULT NULL,
  `custom_field1` varchar(191) DEFAULT NULL,
  `custom_field2` varchar(191) DEFAULT NULL,
  `custom_field3` varchar(191) DEFAULT NULL,
  `custom_field4` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_locations`
--

INSERT INTO `business_locations` (`id`, `business_id`, `location_id`, `name`, `landmark`, `country`, `state`, `city`, `zip_code`, `invoice_scheme_id`, `sale_invoice_scheme_id`, `invoice_layout_id`, `sale_invoice_layout_id`, `selling_price_group_id`, `print_receipt_on_invoice`, `receipt_printer_type`, `printer_id`, `mobile`, `alternate_number`, `email`, `website`, `featured_products`, `is_active`, `default_payment_accounts`, `custom_field1`, `custom_field2`, `custom_field3`, `custom_field4`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'BL0001', 'Microwebs POS', 'Khilgaon', 'Bangladesh', 'Dhaka', 'Dhaka', '1219', 1, NULL, 1, 1, NULL, 1, 'browser', NULL, '01713569417', '', '', '', NULL, 1, '{\"cash\":{\"is_enabled\":1,\"account\":null},\"card\":{\"is_enabled\":1,\"account\":null},\"cheque\":{\"is_enabled\":1,\"account\":null},\"bank_transfer\":{\"is_enabled\":1,\"account\":null},\"other\":{\"is_enabled\":1,\"account\":null},\"custom_pay_1\":{\"is_enabled\":1,\"account\":null},\"custom_pay_2\":{\"is_enabled\":1,\"account\":null},\"custom_pay_3\":{\"is_enabled\":1,\"account\":null},\"custom_pay_4\":{\"is_enabled\":1,\"account\":null},\"custom_pay_5\":{\"is_enabled\":1,\"account\":null},\"custom_pay_6\":{\"is_enabled\":1,\"account\":null},\"custom_pay_7\":{\"is_enabled\":1,\"account\":null}}', NULL, NULL, NULL, NULL, NULL, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(2, 2, 'BL0001', 'Test Business', 'Surat', 'India', 'Gujrat', 'Surat', '394030', 2, NULL, 2, 2, NULL, 1, 'browser', NULL, '', '', '', '', NULL, 1, '{\"cash\":{\"is_enabled\":1,\"account\":null},\"card\":{\"is_enabled\":1,\"account\":null},\"cheque\":{\"is_enabled\":1,\"account\":null},\"bank_transfer\":{\"is_enabled\":1,\"account\":null},\"other\":{\"is_enabled\":1,\"account\":null},\"custom_pay_1\":{\"is_enabled\":1,\"account\":null},\"custom_pay_2\":{\"is_enabled\":1,\"account\":null},\"custom_pay_3\":{\"is_enabled\":1,\"account\":null},\"custom_pay_4\":{\"is_enabled\":1,\"account\":null},\"custom_pay_5\":{\"is_enabled\":1,\"account\":null},\"custom_pay_6\":{\"is_enabled\":1,\"account\":null},\"custom_pay_7\":{\"is_enabled\":1,\"account\":null}}', NULL, NULL, NULL, NULL, NULL, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(3, 2, 'BL0002', 'Location 2', NULL, 'BD', 'Dhaka', 'Dhaka', '1233', 2, 2, 2, 2, NULL, 1, 'browser', NULL, NULL, NULL, NULL, NULL, NULL, 1, '{\"cash\":{\"is_enabled\":\"1\",\"account\":null},\"card\":{\"is_enabled\":\"1\",\"account\":null},\"cheque\":{\"is_enabled\":\"1\",\"account\":null},\"bank_transfer\":{\"is_enabled\":\"1\",\"account\":null},\"other\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_1\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_2\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_3\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_4\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_5\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_6\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_7\":{\"is_enabled\":\"1\",\"account\":null}}', NULL, NULL, NULL, NULL, NULL, '2025-08-07 09:22:47', '2025-08-07 09:22:47'),
(4, 3, 'BL0001', 'NEW', '122', 'bd', 'bd', 'bd', '1211', 3, NULL, 3, 3, NULL, 1, 'browser', NULL, '', '', '', '', NULL, 1, '{\"cash\":{\"is_enabled\":1,\"account\":null},\"card\":{\"is_enabled\":1,\"account\":null},\"cheque\":{\"is_enabled\":1,\"account\":null},\"bank_transfer\":{\"is_enabled\":1,\"account\":null},\"other\":{\"is_enabled\":1,\"account\":null},\"custom_pay_1\":{\"is_enabled\":1,\"account\":null},\"custom_pay_2\":{\"is_enabled\":1,\"account\":null},\"custom_pay_3\":{\"is_enabled\":1,\"account\":null},\"custom_pay_4\":{\"is_enabled\":1,\"account\":null},\"custom_pay_5\":{\"is_enabled\":1,\"account\":null},\"custom_pay_6\":{\"is_enabled\":1,\"account\":null},\"custom_pay_7\":{\"is_enabled\":1,\"account\":null}}', NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:17:02', '2026-03-24 18:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `cash_denominations`
--

CREATE TABLE `cash_denominations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `amount` decimal(22,4) NOT NULL,
  `total_count` int(11) NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_registers`
--

CREATE TABLE `cash_registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('close','open') NOT NULL DEFAULT 'open',
  `closed_at` datetime DEFAULT NULL,
  `closing_amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `total_card_slips` int(11) NOT NULL DEFAULT 0,
  `total_cheques` int(11) NOT NULL DEFAULT 0,
  `denominations` text DEFAULT NULL,
  `closing_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_registers`
--

INSERT INTO `cash_registers` (`id`, `business_id`, `location_id`, `user_id`, `status`, `closed_at`, `closing_amount`, `total_card_slips`, `total_cheques`, `denominations`, `closing_note`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, 'close', '2025-09-14 14:16:12', 700.0000, 0, 0, NULL, NULL, '2025-07-08 11:09:00', '2025-09-14 08:16:12'),
(2, 2, 2, 2, 'open', NULL, 0.0000, 0, 0, NULL, NULL, '2025-09-14 08:16:00', '2025-09-14 08:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `cash_register_transactions`
--

CREATE TABLE `cash_register_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `cash_register_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `pay_method` varchar(191) DEFAULT NULL,
  `type` enum('debit','credit') NOT NULL,
  `transaction_type` varchar(191) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_register_transactions`
--

INSERT INTO `cash_register_transactions` (`id`, `cash_register_id`, `amount`, `pay_method`, `type`, `transaction_type`, `transaction_id`, `created_at`, `updated_at`) VALUES
(3, 1, 500.0000, 'cash', 'credit', 'sell', 79, '2025-09-14 08:03:28', '2025-09-14 08:03:28'),
(4, 1, 200.0000, 'cash', 'credit', 'sell', 79, '2025-09-14 08:03:28', '2025-09-14 08:03:28'),
(5, 2, 100.0000, 'cash', 'credit', 'sell', 84, '2025-10-09 17:49:17', '2025-10-09 17:49:17'),
(6, 2, 1.2500, 'cash', 'credit', 'sell', 85, '2025-10-10 00:45:16', '2025-10-10 00:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `short_code` varchar(191) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `woocommerce_cat_id` int(11) DEFAULT NULL,
  `category_type` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorizables`
--

CREATE TABLE `categorizables` (
  `category_id` int(11) NOT NULL,
  `categorizable_type` varchar(191) NOT NULL,
  `categorizable_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cloths`
--

CREATE TABLE `cloths` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `cloth_name` varchar(191) NOT NULL,
  `serial_no` int(11) NOT NULL,
  `cloth_image` varchar(191) DEFAULT NULL,
  `wages` decimal(8,2) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cloths`
--

INSERT INTO `cloths` (`id`, `business_id`, `cloth_name`, `serial_no`, `cloth_image`, `wages`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(9, 2, 'শর্ট পান্জাবী', 1, 'cloths/i4ldjHvdrCF6DIVo0zyaGGyRUd0XQbKvVBzMVwbb.png', 200.00, 2, NULL, '2025-08-19 06:11:25', '2025-08-26 05:17:44'),
(10, 2, 'কল্লিদার পান্জাবী', 2, NULL, 500.00, 2, NULL, '2025-08-26 05:16:51', '2025-08-26 05:16:51'),
(11, 2, 'একছাটা পান্জাবী', 3, NULL, 200.00, 2, NULL, '2025-08-26 05:17:12', '2025-08-26 05:17:12'),
(12, 2, 'পায়জামা', 4, NULL, 200.00, 2, NULL, '2025-08-26 05:17:31', '2025-08-26 05:17:31'),
(13, 2, 'আরব জুব্বা', 5, NULL, 200.00, 2, NULL, '2025-08-26 05:18:05', '2025-08-26 05:18:05'),
(14, 2, 'এক ছাটা জুব্বা', 6, NULL, 300.00, 2, NULL, '2025-08-26 05:18:19', '2025-08-26 05:18:19'),
(15, 2, 'কাবলি', 7, NULL, 200.00, 2, NULL, '2025-08-26 05:18:34', '2025-08-26 05:18:34'),
(16, 2, 'সেলোয়ার', 8, NULL, 200.00, 2, NULL, '2025-08-26 05:18:48', '2025-08-26 05:18:48'),
(17, 2, 'গোল জামা', 9, NULL, 300.00, 2, NULL, '2025-08-26 05:19:00', '2025-08-26 05:19:00'),
(18, 2, 'কটি', 10, NULL, 300.00, 2, NULL, '2025-08-26 05:19:16', '2025-08-26 05:19:16'),
(19, 2, 'পাঞ্জাবী শেরওয়ানী', 11, NULL, 500.00, 2, NULL, '2025-08-26 05:19:46', '2025-08-26 05:19:46'),
(20, 2, 'একছাটা ছেলয়ার', 12, NULL, 500.00, 2, NULL, '2025-08-26 05:20:03', '2025-08-26 05:20:03'),
(21, 2, 'ফতুয়া', 13, NULL, 500.00, 2, NULL, '2025-08-26 05:20:20', '2025-08-26 05:20:20'),
(22, 2, 'চোষ পায়জামা', 14, NULL, 500.00, 2, NULL, '2025-08-26 05:20:32', '2025-08-26 05:20:32'),
(23, 2, 'শেরওয়ানী', 15, NULL, 500.00, 2, NULL, '2025-08-26 05:20:42', '2025-08-26 05:20:42'),
(24, 2, 'রাউন কাবলি', 16, NULL, 200.00, 2, NULL, '2025-08-26 05:20:58', '2025-08-26 05:20:58'),
(26, 2, 'কোর্ট', 17, NULL, 500.00, 2, NULL, '2025-08-26 05:21:24', '2025-08-26 05:21:24'),
(27, 2, 'একছাটা পায়জামা', 18, NULL, 600.00, 2, NULL, '2025-08-26 05:21:38', '2025-08-26 05:21:38'),
(33, 2, 'Shirt', 1, NULL, 500.00, 2, NULL, '2025-10-09 23:36:59', '2025-10-09 23:36:59'),
(34, 2, 'Short Panjabi', 1, NULL, 500.00, 2, NULL, '2025-10-29 05:25:05', '2025-10-29 05:25:05'),
(36, 3, 'Shirt', 1, NULL, 500.00, 5, NULL, '2026-03-24 19:02:32', '2026-03-24 19:02:32'),
(37, 3, 'Pant', 2, NULL, 300.00, 5, NULL, '2026-03-24 19:02:54', '2026-03-24 19:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `cloth_customizations`
--

CREATE TABLE `cloth_customizations` (
  `id` int(10) UNSIGNED NOT NULL,
  `cloth_id` int(10) UNSIGNED NOT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `measurements` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`measurements`)),
  `styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`styles`)),
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cloth_customizations`
--

INSERT INTO `cloth_customizations` (`id`, `cloth_id`, `contact_id`, `measurements`, `styles`, `note`, `created_at`, `updated_at`) VALUES
(9, 14, 8, '[{\"id\":\"20\",\"measurement_name\":\"\\u09ac\\u09a1\\u09bf\",\"value\":\"40\",\"sub_measurements\":[{\"id\":\"13\",\"sub_measurement_name\":\"\\u09ac\\u09a1\\u09bf\\u09b0 \\u09b2\\u09c1\\u099c\",\"value\":\"47\"},{\"id\":\"14\",\"sub_measurement_name\":\"\\u09aa\\u09c7\\u099f \\u098f\\u09b0 \\u09b2\\u09c1\\u099c\",\"value\":\"45\"},{\"id\":\"15\",\"sub_measurement_name\":\"\\u09a8\\u09bf\\u099a\\u09c7\\u09b0 \\u0998\\u09c7\\u09b0\",\"value\":\"30.5\"},{\"id\":\"16\",\"sub_measurement_name\":\"\\u09aa\\u09c7\\u099f\",\"value\":\"38\"}]},{\"id\":\"19\",\"measurement_name\":\"\\u09b2\\u09ae\\u09cd\\u09ac\\u09be\",\"value\":\"53.5\",\"sub_measurements\":[{\"id\":\"12\",\"sub_measurement_name\":\"\\u09aa\\u09cd\\u09b2\\u09c7\\u099f \\u09ab\\u09be\\u09dc\\u09be\",\"value\":\"13\"}]},{\"id\":\"24\",\"measurement_name\":\"\\u09aa\\u09c1\\u099f\",\"value\":\"19.5\"},{\"id\":\"25\",\"measurement_name\":\"\\u0995\\u09b2\\u09be\\u09b0\",\"value\":\"17.75\"},{\"id\":\"26\",\"measurement_name\":\"\\u09b9\\u09be\\u09a4\\u09be\\u09b0 \\u09ae\\u09c1\\u09b9\\u09c1\\u09b0\\u09c0\",\"value\":\"13.5\"},{\"id\":\"28\",\"measurement_name\":\"\\u09ae\\u09cb\\u09b0\\u09be\",\"value\":\"12\"},{\"id\":\"21\",\"measurement_name\":\"\\u09b9\\u09be\\u09a4\\u09be\",\"value\":\"25.5\",\"sub_measurements\":[{\"id\":\"17\",\"sub_measurement_name\":\"\\u09aa\\u0995\\u09c7\\u099f \\u099a\\u09be\\u0995\\u09be\\u09a8\",\"value\":\"12\"}]}]', '[]', NULL, '2025-09-14 07:29:44', '2025-09-14 07:29:44'),
(10, 9, 2, '[{\"id\":\"19\",\"measurement_name\":\"\\u09b2\\u09ae\\u09cd\\u09ac\\u09be\",\"value\":\"12\",\"sub_measurements\":[{\"id\":\"12\",\"sub_measurement_name\":\"\\u09aa\\u09cd\\u09b2\\u09c7\\u099f \\u09ab\\u09be\\u09dc\\u09be\",\"value\":\"12\"}]},{\"id\":\"20\",\"measurement_name\":\"\\u09ac\\u09a1\\u09bf\",\"value\":\"1\",\"sub_measurements\":[{\"id\":\"13\",\"sub_measurement_name\":\"\\u09ac\\u09a1\\u09bf\\u09b0 \\u09b2\\u09c1\\u099c\",\"value\":\"12\"},{\"id\":\"14\",\"sub_measurement_name\":\"\\u09aa\\u09c7\\u099f \\u098f\\u09b0 \\u09b2\\u09c1\\u099c\",\"value\":\"12\"},{\"id\":\"15\",\"sub_measurement_name\":\"\\u09a8\\u09bf\\u099a\\u09c7\\u09b0 \\u0998\\u09c7\\u09b0\",\"value\":\"12\"},{\"id\":\"16\",\"sub_measurement_name\":\"\\u09aa\\u09c7\\u099f\",\"value\":\"12\"}]},{\"id\":\"24\",\"measurement_name\":\"\\u09aa\\u09c1\\u099f\",\"value\":\"12\"},{\"id\":\"21\",\"measurement_name\":\"\\u09b9\\u09be\\u09a4\\u09be\",\"value\":\"12\",\"sub_measurements\":[{\"id\":\"17\",\"sub_measurement_name\":\"\\u09aa\\u0995\\u09c7\\u099f \\u099a\\u09be\\u0995\\u09be\\u09a8\",\"value\":\"12\"}]},{\"id\":\"25\",\"measurement_name\":\"\\u0995\\u09b2\\u09be\\u09b0\",\"value\":\"12\"},{\"id\":\"26\",\"measurement_name\":\"\\u09b9\\u09be\\u09a4\\u09be\\u09b0 \\u09ae\\u09c1\\u09b9\\u09c1\\u09b0\\u09c0\",\"value\":\"12\"},{\"id\":\"27\",\"measurement_name\":\"\\u0995\\u09ab\",\"value\":\"12\"},{\"id\":\"28\",\"measurement_name\":\"\\u09ae\\u09cb\\u09b0\\u09be\",\"value\":\"12\"},{\"id\":\"29\",\"measurement_name\":\"\\u09ae\\u09be\\u09a6\\u09be\\u09a8\\u09bf\",\"value\":\"12\"},{\"id\":\"30\",\"measurement_name\":\"\\u09aa\\u09c7\\u099f \\u098f\\u09b0 \\u09b2\\u09c1\\u099c\",\"value\":\"12\"}]', '[{\"id\":\"14\",\"name\":\"asc\",\"designs\":[{\"design_value\":null}]},{\"id\":\"10\",\"name\":\"\\u0995\\u09b2\\u09be\\u09b0\",\"designs\":[{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null}]},{\"id\":\"11\",\"name\":\"\\u09aa\\u09cd\\u09b2\\u09c7\\u0987\\u099f\",\"designs\":[{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null}]},{\"id\":\"12\",\"name\":\"\\u0995\\u09be\\u09ab\",\"designs\":[{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null}]}]', 'Description : Test test', '2025-09-14 07:39:54', '2026-03-20 16:20:30'),
(11, 9, 10, '[{\"id\":\"19\",\"measurement_name\":\"\\u09b2\\u09ae\\u09cd\\u09ac\\u09be\",\"value\":\"44\",\"sub_measurements\":[{\"id\":\"12\",\"sub_measurement_name\":\"\\u09aa\\u09cd\\u09b2\\u09c7\\u099f \\u09ab\\u09be\\u09dc\\u09be\",\"value\":\"13\"}]},{\"id\":\"20\",\"measurement_name\":\"\\u09ac\\u09a1\\u09bf\",\"value\":\"40\",\"sub_measurements\":[{\"id\":\"13\",\"sub_measurement_name\":\"\\u09ac\\u09a1\\u09bf\\u09b0 \\u09b2\\u09c1\\u099c\",\"value\":\"46\"},{\"id\":\"14\",\"sub_measurement_name\":\"\\u09aa\\u09c7\\u099f \\u098f\\u09b0 \\u09b2\\u09c1\\u099c\",\"value\":\"43\"},{\"id\":\"15\",\"sub_measurement_name\":\"\\u09a8\\u09bf\\u099a\\u09c7\\u09b0 \\u0998\\u09c7\\u09b0\",\"value\":\"25\"},{\"id\":\"16\",\"sub_measurement_name\":\"\\u09aa\\u09c7\\u099f\",\"value\":\"36\"}]},{\"id\":\"24\",\"measurement_name\":\"\\u09aa\\u09c1\\u099f\",\"value\":\"18\"},{\"id\":\"21\",\"measurement_name\":\"\\u09b9\\u09be\\u09a4\\u09be\",\"value\":\"25\",\"sub_measurements\":[{\"id\":\"17\",\"sub_measurement_name\":\"\\u09aa\\u0995\\u09c7\\u099f \\u099a\\u09be\\u0995\\u09be\\u09a8\",\"value\":\"8\"}]},{\"id\":\"25\",\"measurement_name\":\"\\u0995\\u09b2\\u09be\\u09b0\",\"value\":\"16.75\"},{\"id\":\"26\",\"measurement_name\":\"\\u09b9\\u09be\\u09a4\\u09be\\u09b0 \\u09ae\\u09c1\\u09b9\\u09c1\\u09b0\\u09c0\",\"value\":\"11.5\"},{\"id\":\"27\",\"measurement_name\":\"\\u0995\\u09ab\",\"value\":\"4\"},{\"id\":\"28\",\"measurement_name\":\"\\u09ae\\u09cb\\u09b0\\u09be\",\"value\":\"8\"},{\"id\":\"29\",\"measurement_name\":\"\\u09ae\\u09be\\u09a6\\u09be\\u09a8\\u09bf\",\"value\":\"8\"},{\"id\":\"30\",\"measurement_name\":\"\\u09aa\\u09c7\\u099f \\u098f\\u09b0 \\u09b2\\u09c1\\u099c\",\"value\":\"54\"}]', '[{\"id\":\"10\",\"name\":\"\\u0995\\u09b2\\u09be\\u09b0\",\"designs\":[{\"id\":\"15\",\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null}]},{\"id\":\"11\",\"name\":\"\\u09aa\\u09cd\\u09b2\\u09c7\\u0987\\u099f\",\"designs\":[{\"id\":\"24\",\"design_value\":\"1.25\"},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null}]},{\"id\":\"12\",\"name\":\"\\u0995\\u09be\\u09ab\",\"designs\":[{\"design_value\":null},{\"design_value\":null},{\"design_value\":null},{\"design_value\":null}]}]', NULL, '2025-09-14 08:24:59', '2025-09-14 08:24:59'),
(12, 11, 2, '[{\"id\":\"19\",\"measurement_name\":\"\\u09b2\\u09ae\\u09cd\\u09ac\\u09be\",\"value\":\"12\",\"sub_measurements\":[{\"id\":\"12\",\"sub_measurement_name\":\"\\u09aa\\u09cd\\u09b2\\u09c7\\u099f \\u09ab\\u09be\\u09dc\\u09be\",\"value\":\"12\"}]},{\"id\":\"30\",\"measurement_name\":\"\\u09aa\\u09c7\\u099f \\u098f\\u09b0 \\u09b2\\u09c1\\u099c\",\"value\":\"12\"},{\"id\":\"29\",\"measurement_name\":\"\\u09ae\\u09be\\u09a6\\u09be\\u09a8\\u09bf\",\"value\":\"12\"},{\"id\":\"28\",\"measurement_name\":\"\\u09ae\\u09cb\\u09b0\\u09be\",\"value\":\"12\"},{\"id\":\"27\",\"measurement_name\":\"\\u0995\\u09ab\",\"value\":\"12\"},{\"id\":\"26\",\"measurement_name\":\"\\u09b9\\u09be\\u09a4\\u09be\\u09b0 \\u09ae\\u09c1\\u09b9\\u09c1\\u09b0\\u09c0\",\"value\":\"12\"},{\"id\":\"25\",\"measurement_name\":\"\\u0995\\u09b2\\u09be\\u09b0\",\"value\":\"12\"},{\"id\":\"24\",\"measurement_name\":\"\\u09aa\\u09c1\\u099f\",\"value\":\"12\"},{\"id\":\"20\",\"measurement_name\":\"\\u09ac\\u09a1\\u09bf\",\"value\":\"12\",\"sub_measurements\":[{\"id\":\"13\",\"sub_measurement_name\":\"\\u09ac\\u09a1\\u09bf\\u09b0 \\u09b2\\u09c1\\u099c\",\"value\":\"12\"},{\"id\":\"14\",\"sub_measurement_name\":\"\\u09aa\\u09c7\\u099f \\u098f\\u09b0 \\u09b2\\u09c1\\u099c\",\"value\":\"12\"},{\"id\":\"15\",\"sub_measurement_name\":\"\\u09a8\\u09bf\\u099a\\u09c7\\u09b0 \\u0998\\u09c7\\u09b0\",\"value\":\"12\"},{\"id\":\"16\",\"sub_measurement_name\":\"\\u09aa\\u09c7\\u099f\",\"value\":\"12\"}]},{\"id\":\"21\",\"measurement_name\":\"\\u09b9\\u09be\\u09a4\\u09be\",\"value\":\"12\",\"sub_measurements\":[{\"id\":\"17\",\"sub_measurement_name\":\"\\u09aa\\u0995\\u09c7\\u099f \\u099a\\u09be\\u0995\\u09be\\u09a8\",\"value\":\"12\"}]}]', '[]', NULL, '2026-03-17 18:12:52', '2026-03-17 18:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `cloth_measurement`
--

CREATE TABLE `cloth_measurement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cloth_id` int(10) UNSIGNED NOT NULL,
  `measurement_id` int(10) UNSIGNED NOT NULL,
  `serial_no` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cloth_measurement`
--

INSERT INTO `cloth_measurement` (`id`, `cloth_id`, `measurement_id`, `serial_no`, `created_at`, `updated_at`) VALUES
(30, 9, 19, 1, NULL, NULL),
(31, 9, 20, 2, NULL, NULL),
(32, 9, 21, 4, NULL, NULL),
(33, 9, 24, 3, NULL, NULL),
(34, 9, 25, 5, NULL, NULL),
(35, 9, 26, 6, NULL, NULL),
(36, 9, 27, 7, NULL, NULL),
(37, 9, 28, 8, NULL, NULL),
(38, 9, 29, 9, NULL, NULL),
(39, 9, 30, 10, NULL, NULL),
(41, 10, 19, NULL, NULL, NULL),
(42, 10, 20, NULL, NULL, NULL),
(43, 10, 24, NULL, NULL, NULL),
(45, 10, 25, NULL, NULL, NULL),
(46, 10, 26, NULL, NULL, NULL),
(47, 10, 27, NULL, NULL, NULL),
(48, 10, 28, NULL, NULL, NULL),
(49, 10, 29, NULL, NULL, NULL),
(50, 10, 30, NULL, NULL, NULL),
(51, 11, 19, NULL, NULL, NULL),
(52, 11, 20, NULL, NULL, NULL),
(53, 11, 24, NULL, NULL, NULL),
(55, 11, 25, NULL, NULL, NULL),
(56, 11, 26, NULL, NULL, NULL),
(57, 11, 27, NULL, NULL, NULL),
(58, 11, 28, NULL, NULL, NULL),
(59, 11, 29, NULL, NULL, NULL),
(60, 11, 30, NULL, NULL, NULL),
(62, 12, 32, NULL, NULL, NULL),
(63, 12, 33, NULL, NULL, NULL),
(64, 12, 34, NULL, NULL, NULL),
(65, 12, 35, NULL, NULL, NULL),
(66, 12, 36, NULL, NULL, NULL),
(67, 12, 37, NULL, NULL, NULL),
(68, 12, 38, NULL, NULL, NULL),
(69, 13, 19, NULL, NULL, NULL),
(70, 13, 39, NULL, NULL, NULL),
(71, 13, 24, NULL, NULL, NULL),
(73, 13, 25, NULL, NULL, NULL),
(74, 13, 26, NULL, NULL, NULL),
(75, 13, 28, NULL, NULL, NULL),
(77, 14, 20, NULL, NULL, NULL),
(78, 14, 19, NULL, NULL, NULL),
(79, 14, 24, NULL, NULL, NULL),
(81, 14, 25, NULL, NULL, NULL),
(82, 14, 26, NULL, NULL, NULL),
(83, 14, 28, NULL, NULL, NULL),
(84, 10, 21, NULL, NULL, NULL),
(85, 11, 21, NULL, NULL, NULL),
(86, 13, 21, NULL, NULL, NULL),
(87, 14, 21, NULL, NULL, NULL),
(88, 15, 19, NULL, NULL, NULL),
(89, 13, 20, NULL, NULL, NULL),
(90, 15, 20, NULL, NULL, NULL),
(91, 15, 24, NULL, NULL, NULL),
(92, 15, 21, NULL, NULL, NULL),
(93, 15, 25, NULL, NULL, NULL),
(94, 15, 27, NULL, NULL, NULL),
(95, 15, 28, NULL, NULL, NULL),
(96, 16, 40, NULL, NULL, NULL),
(97, 16, 33, NULL, NULL, NULL),
(98, 16, 34, NULL, NULL, NULL),
(99, 16, 35, NULL, NULL, NULL),
(100, 16, 36, NULL, NULL, NULL),
(101, 16, 37, NULL, NULL, NULL),
(102, 17, 19, NULL, NULL, NULL),
(103, 17, 39, NULL, NULL, NULL),
(104, 17, 24, NULL, NULL, NULL),
(105, 17, 21, NULL, NULL, NULL),
(106, 17, 25, NULL, NULL, NULL),
(107, 17, 26, NULL, NULL, NULL),
(108, 17, 27, NULL, NULL, NULL),
(109, 17, 41, NULL, NULL, NULL),
(110, 17, 28, NULL, NULL, NULL),
(111, 18, 33, NULL, NULL, NULL),
(112, 18, 42, NULL, NULL, NULL),
(113, 18, 30, NULL, NULL, NULL),
(114, 18, 43, NULL, NULL, NULL),
(115, 18, 44, NULL, NULL, NULL),
(116, 18, 24, NULL, NULL, NULL),
(117, 18, 45, NULL, NULL, NULL),
(118, 18, 46, NULL, NULL, NULL),
(119, 12, 19, NULL, NULL, NULL),
(120, 33, 52, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cloth_orders`
--

CREATE TABLE `cloth_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED DEFAULT NULL,
  `is_kitchen_order` tinyint(1) NOT NULL DEFAULT 0,
  `res_table_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'fields to restaurant module',
  `res_waiter_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'fields to restaurant module',
  `res_order_status` enum('received','cooked','served') DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `sub_type` varchar(20) DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `sub_status` varchar(191) DEFAULT NULL,
  `is_quotation` tinyint(1) NOT NULL DEFAULT 0,
  `payment_status` enum('paid','due','partial') DEFAULT NULL,
  `adjustment_type` enum('normal','abnormal') DEFAULT NULL,
  `contact_id` int(11) UNSIGNED DEFAULT NULL,
  `customer_group_id` int(11) DEFAULT NULL COMMENT 'used to add customer group while selling',
  `invoice_no` varchar(191) DEFAULT NULL,
  `ref_no` varchar(191) DEFAULT NULL,
  `source` varchar(191) DEFAULT NULL,
  `subscription_no` varchar(191) DEFAULT NULL,
  `subscription_repeat_on` varchar(191) DEFAULT NULL,
  `transaction_date` datetime NOT NULL,
  `total_before_tax` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'Total before the purchase/invoice tax, this includeds the indivisual product tax',
  `tax_id` int(10) UNSIGNED DEFAULT NULL,
  `tax_amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `discount_type` enum('fixed','percentage') DEFAULT NULL,
  `discount_amount` decimal(22,4) DEFAULT 0.0000,
  `rp_redeemed` int(11) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `rp_redeemed_amount` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'rp is the short form of reward points',
  `shipping_details` varchar(191) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `shipping_status` varchar(191) DEFAULT NULL,
  `delivered_to` varchar(191) DEFAULT NULL,
  `delivery_person` bigint(20) DEFAULT NULL,
  `shipping_charges` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `shipping_custom_field_1` varchar(191) DEFAULT NULL,
  `shipping_custom_field_2` varchar(191) DEFAULT NULL,
  `shipping_custom_field_3` varchar(191) DEFAULT NULL,
  `shipping_custom_field_4` varchar(191) DEFAULT NULL,
  `shipping_custom_field_5` varchar(191) DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `staff_note` text DEFAULT NULL,
  `is_export` tinyint(1) NOT NULL DEFAULT 0,
  `export_custom_fields_info` longtext DEFAULT NULL,
  `round_off_amount` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'Difference of rounded total and actual total',
  `additional_expense_key_1` varchar(191) DEFAULT NULL,
  `additional_expense_value_1` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `additional_expense_key_2` varchar(191) DEFAULT NULL,
  `additional_expense_value_2` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `additional_expense_key_3` varchar(191) DEFAULT NULL,
  `additional_expense_value_3` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `additional_expense_key_4` varchar(191) DEFAULT NULL,
  `additional_expense_value_4` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `final_total` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `expense_category_id` int(10) UNSIGNED DEFAULT NULL,
  `expense_sub_category_id` int(11) DEFAULT NULL,
  `expense_for` int(10) UNSIGNED DEFAULT NULL,
  `commission_agent` int(11) DEFAULT NULL,
  `document` varchar(191) DEFAULT NULL,
  `is_direct_sale` tinyint(1) NOT NULL DEFAULT 0,
  `is_suspend` tinyint(1) NOT NULL DEFAULT 0,
  `exchange_rate` decimal(20,3) NOT NULL DEFAULT 1.000,
  `total_amount_recovered` decimal(22,4) DEFAULT NULL COMMENT 'Used for stock adjustment.',
  `transfer_parent_id` int(11) DEFAULT NULL,
  `return_parent_id` int(11) DEFAULT NULL,
  `opening_stock_product_id` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `woocommerce_order_id` int(11) DEFAULT NULL,
  `purchase_requisition_ids` text DEFAULT NULL,
  `prefer_payment_method` varchar(191) DEFAULT NULL,
  `prefer_payment_account` int(11) DEFAULT NULL,
  `sales_order_ids` text DEFAULT NULL,
  `purchase_order_ids` text DEFAULT NULL,
  `custom_field_1` varchar(191) DEFAULT NULL,
  `custom_field_2` varchar(191) DEFAULT NULL,
  `custom_field_3` varchar(191) DEFAULT NULL,
  `custom_field_4` varchar(191) DEFAULT NULL,
  `import_batch` int(11) DEFAULT NULL,
  `import_time` datetime DEFAULT NULL,
  `types_of_service_id` int(11) DEFAULT NULL,
  `packing_charge` decimal(22,4) DEFAULT NULL,
  `packing_charge_type` enum('fixed','percent') DEFAULT NULL,
  `service_custom_field_1` text DEFAULT NULL,
  `service_custom_field_2` text DEFAULT NULL,
  `service_custom_field_3` text DEFAULT NULL,
  `service_custom_field_4` text DEFAULT NULL,
  `service_custom_field_5` text DEFAULT NULL,
  `service_custom_field_6` text DEFAULT NULL,
  `is_created_from_api` tinyint(1) NOT NULL DEFAULT 0,
  `rp_earned` int(11) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `order_addresses` text DEFAULT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT 0,
  `recur_interval` double(22,4) DEFAULT NULL,
  `recur_interval_type` enum('days','months','years') DEFAULT NULL,
  `recur_repetitions` int(11) DEFAULT NULL,
  `recur_stopped_on` datetime DEFAULT NULL,
  `recur_parent_id` int(11) DEFAULT NULL,
  `invoice_token` varchar(191) DEFAULT NULL,
  `pay_term_number` int(11) DEFAULT NULL,
  `pay_term_type` enum('days','months') DEFAULT NULL,
  `selling_price_group_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cloth_order_lines`
--

CREATE TABLE `cloth_order_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variation_id` int(10) UNSIGNED NOT NULL,
  `quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `secondary_unit_quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `quantity_returned` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `unit_price_before_discount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `unit_price` decimal(22,4) DEFAULT NULL COMMENT 'Sell price excluding tax',
  `line_discount_type` enum('fixed','percentage') DEFAULT NULL,
  `line_discount_amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `unit_price_inc_tax` decimal(22,4) DEFAULT NULL COMMENT 'Sell price including tax',
  `item_tax` decimal(22,4) NOT NULL COMMENT 'Tax for one quantity',
  `tax_id` int(10) UNSIGNED DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `lot_no_line_id` int(11) DEFAULT NULL,
  `sell_line_note` text DEFAULT NULL,
  `woocommerce_line_items_id` int(11) DEFAULT NULL,
  `so_line_id` int(11) DEFAULT NULL,
  `so_quantity_invoiced` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `res_service_staff_id` int(11) DEFAULT NULL,
  `res_line_order_status` varchar(191) DEFAULT NULL,
  `parent_sell_line_id` int(11) DEFAULT NULL,
  `children_type` varchar(191) NOT NULL DEFAULT '' COMMENT 'Type of children for the parent, like modifier or combo',
  `sub_unit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cloth_order_lines_purchase_lines`
--

CREATE TABLE `cloth_order_lines_purchase_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `sell_line_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'id from transaction_sell_lines',
  `stock_adjustment_line_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'id from stock_adjustment_lines',
  `purchase_line_id` int(10) UNSIGNED NOT NULL COMMENT 'id from purchase_lines',
  `quantity` decimal(22,4) NOT NULL,
  `qty_returned` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cloth_order_payments`
--

CREATE TABLE `cloth_order_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(11) UNSIGNED DEFAULT NULL,
  `business_id` int(11) DEFAULT NULL,
  `is_return` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Used during sales to return the change',
  `amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `method` varchar(191) DEFAULT NULL,
  `payment_type` varchar(191) DEFAULT NULL,
  `transaction_no` varchar(191) DEFAULT NULL,
  `card_transaction_number` varchar(191) DEFAULT NULL,
  `card_number` varchar(191) DEFAULT NULL,
  `card_type` varchar(191) DEFAULT NULL,
  `card_holder_name` varchar(191) DEFAULT NULL,
  `card_month` varchar(191) DEFAULT NULL,
  `card_year` varchar(191) DEFAULT NULL,
  `card_security` varchar(5) DEFAULT NULL,
  `cheque_number` varchar(191) DEFAULT NULL,
  `bank_account_number` varchar(191) DEFAULT NULL,
  `paid_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `paid_through_link` tinyint(1) NOT NULL DEFAULT 0,
  `gateway` varchar(191) DEFAULT NULL,
  `is_advance` tinyint(1) NOT NULL DEFAULT 0,
  `payment_for` int(11) DEFAULT NULL COMMENT 'stores the contact id',
  `parent_id` int(11) DEFAULT NULL,
  `note` varchar(191) DEFAULT NULL,
  `document` varchar(191) DEFAULT NULL,
  `payment_ref_no` varchar(191) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cloth_style`
--

CREATE TABLE `cloth_style` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cloth_id` int(10) UNSIGNED NOT NULL,
  `style_id` int(10) UNSIGNED NOT NULL,
  `serial_no` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cloth_style`
--

INSERT INTO `cloth_style` (`id`, `cloth_id`, `style_id`, `serial_no`, `created_at`, `updated_at`) VALUES
(18, 9, 10, 1, NULL, NULL),
(19, 9, 11, 2, NULL, NULL),
(20, 9, 12, 3, NULL, NULL),
(21, 9, 14, NULL, NULL, NULL),
(22, 10, 14, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `contact_type` varchar(191) DEFAULT NULL,
  `supplier_business_name` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `prefix` varchar(191) DEFAULT NULL,
  `first_name` varchar(191) DEFAULT NULL,
  `middle_name` varchar(191) DEFAULT NULL,
  `last_name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `contact_id` varchar(191) DEFAULT NULL,
  `contact_status` varchar(191) NOT NULL DEFAULT 'active',
  `tax_number` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `address_line_1` text DEFAULT NULL,
  `address_line_2` text DEFAULT NULL,
  `zip_code` varchar(191) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `mobile` varchar(191) NOT NULL,
  `landline` varchar(191) DEFAULT NULL,
  `alternate_number` varchar(191) DEFAULT NULL,
  `pay_term_number` int(11) DEFAULT NULL,
  `pay_term_type` enum('days','months') DEFAULT NULL,
  `credit_limit` decimal(22,4) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `balance` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `total_rp` int(11) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `total_rp_used` int(11) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `total_rp_expired` int(11) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `shipping_address` text DEFAULT NULL,
  `shipping_custom_field_details` longtext DEFAULT NULL,
  `is_export` tinyint(1) NOT NULL DEFAULT 0,
  `export_custom_field_1` varchar(191) DEFAULT NULL,
  `export_custom_field_2` varchar(191) DEFAULT NULL,
  `export_custom_field_3` varchar(191) DEFAULT NULL,
  `export_custom_field_4` varchar(191) DEFAULT NULL,
  `export_custom_field_5` varchar(191) DEFAULT NULL,
  `export_custom_field_6` varchar(191) DEFAULT NULL,
  `position` varchar(191) DEFAULT NULL,
  `customer_group_id` int(11) DEFAULT NULL,
  `custom_field1` varchar(191) DEFAULT NULL,
  `custom_field2` varchar(191) DEFAULT NULL,
  `custom_field3` varchar(191) DEFAULT NULL,
  `custom_field4` varchar(191) DEFAULT NULL,
  `custom_field5` varchar(191) DEFAULT NULL,
  `custom_field6` varchar(191) DEFAULT NULL,
  `custom_field7` varchar(191) DEFAULT NULL,
  `custom_field8` varchar(191) DEFAULT NULL,
  `custom_field9` varchar(191) DEFAULT NULL,
  `custom_field10` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `business_id`, `type`, `contact_type`, `supplier_business_name`, `name`, `prefix`, `first_name`, `middle_name`, `last_name`, `email`, `contact_id`, `contact_status`, `tax_number`, `city`, `state`, `country`, `address_line_1`, `address_line_2`, `zip_code`, `dob`, `mobile`, `landline`, `alternate_number`, `pay_term_number`, `pay_term_type`, `credit_limit`, `created_by`, `balance`, `total_rp`, `total_rp_used`, `total_rp_expired`, `is_default`, `shipping_address`, `shipping_custom_field_details`, `is_export`, `export_custom_field_1`, `export_custom_field_2`, `export_custom_field_3`, `export_custom_field_4`, `export_custom_field_5`, `export_custom_field_6`, `position`, `customer_group_id`, `custom_field1`, `custom_field2`, `custom_field3`, `custom_field4`, `custom_field5`, `custom_field6`, `custom_field7`, `custom_field8`, `custom_field9`, `custom_field10`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'customer', NULL, NULL, 'Customer 1', NULL, NULL, NULL, NULL, NULL, 'CO0001', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0.0000, 1, 0.0000, 0, 0, 0, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-22 09:48:05', '2024-03-22 09:48:05'),
(2, 2, 'customer', 'individual', NULL, 'KB', NULL, 'KB', NULL, NULL, NULL, 'CO0002', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4545', NULL, NULL, NULL, NULL, NULL, 2, 80.0000, 0, 0, 0, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-02 04:50:18', '2025-08-26 03:46:49'),
(3, 2, 'customer', 'individual', NULL, 'Walk-in-Customer', NULL, 'Walk-in-Customer', NULL, NULL, NULL, 'CO0001', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1999-09-05', '9909431333', NULL, NULL, NULL, NULL, NULL, 2, 0.0000, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-12 05:21:49', '2025-09-21 18:33:47'),
(4, 2, 'customer', 'individual', NULL, 'Aarif', NULL, 'Aarif', NULL, NULL, NULL, 'CO0003', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01713569417', NULL, NULL, NULL, NULL, NULL, 2, 0.0000, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-23 17:00:31', '2025-07-23 17:00:31'),
(5, 2, 'customer', 'individual', NULL, 'ABC', NULL, 'ABC', NULL, NULL, NULL, 'CO0004', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51556', NULL, NULL, NULL, NULL, NULL, 2, 0.0000, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-23 17:35:09', '2025-07-23 17:35:09'),
(6, 2, 'customer', 'individual', NULL, 'ABC', NULL, 'ABC', NULL, NULL, NULL, 'CO0005', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4545454', NULL, NULL, NULL, NULL, NULL, 2, 0.0000, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 09:02:52', '2025-08-25 09:02:52'),
(7, 2, 'customer', 'individual', NULL, 'XYZ', NULL, 'XYZ', NULL, NULL, NULL, 'CO0006', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2323232', NULL, NULL, NULL, NULL, NULL, 2, 0.0000, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 09:11:01', '2025-08-25 09:11:01'),
(8, 2, 'customer', 'individual', NULL, 'Foysal Forazi 14491/14492', NULL, 'Foysal Forazi 14491/14492', NULL, NULL, NULL, 'CO0007', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01966310440', NULL, NULL, NULL, NULL, NULL, 2, 0.0000, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-14 07:26:15', '2025-09-14 07:51:14'),
(9, 2, 'supplier', 'individual', NULL, 'World Trade', NULL, 'World Trade', NULL, NULL, NULL, 'CO0008', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '352325', NULL, NULL, NULL, NULL, NULL, 2, 0.0000, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-14 07:35:54', '2025-09-14 07:35:54'),
(10, 2, 'customer', 'individual', NULL, 'Kawsar 017', NULL, 'Kawsar', '017', NULL, NULL, 'CO0009', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01793789382', NULL, NULL, NULL, NULL, NULL, 2, 0.0000, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-14 08:21:49', '2025-09-14 08:21:49'),
(11, 3, 'customer', 'individual', NULL, 'Walk-in-Customer', NULL, 'Walk-in-Customer', NULL, NULL, NULL, 'CO0001', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017', NULL, NULL, NULL, NULL, 0.0000, 5, 0.0000, 0, 0, 0, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:17:02', '2026-03-24 19:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `country` varchar(100) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `code` varchar(25) NOT NULL,
  `symbol` varchar(25) NOT NULL,
  `thousand_separator` varchar(10) NOT NULL,
  `decimal_separator` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `country`, `currency`, `code`, `symbol`, `thousand_separator`, `decimal_separator`, `created_at`, `updated_at`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek', ',', '.', NULL, NULL),
(2, 'America', 'Dollars', 'USD', '$', ',', '.', NULL, NULL),
(3, 'Afghanistan', 'Afghanis', 'AF', '؋', ',', '.', NULL, NULL),
(4, 'Argentina', 'Pesos', 'ARS', '$', ',', '.', NULL, NULL),
(5, 'Aruba', 'Guilders', 'AWG', 'ƒ', ',', '.', NULL, NULL),
(6, 'Australia', 'Dollars', 'AUD', '$', ',', '.', NULL, NULL),
(7, 'Azerbaijan', 'New Manats', 'AZ', 'ман', ',', '.', NULL, NULL),
(8, 'Bahamas', 'Dollars', 'BSD', '$', ',', '.', NULL, NULL),
(9, 'Barbados', 'Dollars', 'BBD', '$', ',', '.', NULL, NULL),
(10, 'Belarus', 'Rubles', 'BYR', 'p.', ',', '.', NULL, NULL),
(11, 'Belgium', 'Euro', 'EUR', '€', ',', '.', NULL, NULL),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$', ',', '.', NULL, NULL),
(13, 'Bermuda', 'Dollars', 'BMD', '$', ',', '.', NULL, NULL),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b', ',', '.', NULL, NULL),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM', ',', '.', NULL, NULL),
(16, 'Botswana', 'Pula\'s', 'BWP', 'P', ',', '.', NULL, NULL),
(17, 'Bulgaria', 'Leva', 'BG', 'лв', ',', '.', NULL, NULL),
(18, 'Brazil', 'Reais', 'BRL', 'R$', ',', '.', NULL, NULL),
(19, 'Britain [United Kingdom]', 'Pounds', 'GBP', '£', ',', '.', NULL, NULL),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$', ',', '.', NULL, NULL),
(21, 'Cambodia', 'Riels', 'KHR', '៛', ',', '.', NULL, NULL),
(22, 'Canada', 'Dollars', 'CAD', '$', ',', '.', NULL, NULL),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$', ',', '.', NULL, NULL),
(24, 'Chile', 'Pesos', 'CLP', '$', ',', '.', NULL, NULL),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥', ',', '.', NULL, NULL),
(26, 'Colombia', 'Pesos', 'COP', '$', ',', '.', NULL, NULL),
(27, 'Costa Rica', 'Colón', 'CRC', '₡', ',', '.', NULL, NULL),
(28, 'Croatia', 'Kuna', 'HRK', 'kn', ',', '.', NULL, NULL),
(29, 'Cuba', 'Pesos', 'CUP', '₱', ',', '.', NULL, NULL),
(30, 'Cyprus', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(31, 'Czech Republic', 'Koruny', 'CZK', 'Kč', ',', '.', NULL, NULL),
(32, 'Denmark', 'Kroner', 'DKK', 'kr', ',', '.', NULL, NULL),
(33, 'Dominican Republic', 'Pesos', 'DOP ', 'RD$', ',', '.', NULL, NULL),
(34, 'East Caribbean', 'Dollars', 'XCD', '$', ',', '.', NULL, NULL),
(35, 'Egypt', 'Pounds', 'EGP', '£', ',', '.', NULL, NULL),
(36, 'El Salvador', 'Colones', 'SVC', '$', ',', '.', NULL, NULL),
(37, 'England [United Kingdom]', 'Pounds', 'GBP', '£', ',', '.', NULL, NULL),
(38, 'Euro', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£', ',', '.', NULL, NULL),
(40, 'Fiji', 'Dollars', 'FJD', '$', ',', '.', NULL, NULL),
(41, 'France', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(42, 'Ghana', 'Cedis', 'GHS', '¢', ',', '.', NULL, NULL),
(43, 'Gibraltar', 'Pounds', 'GIP', '£', ',', '.', NULL, NULL),
(44, 'Greece', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q', ',', '.', NULL, NULL),
(46, 'Guernsey', 'Pounds', 'GGP', '£', ',', '.', NULL, NULL),
(47, 'Guyana', 'Dollars', 'GYD', '$', ',', '.', NULL, NULL),
(48, 'Holland [Netherlands]', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(49, 'Honduras', 'Lempiras', 'HNL', 'L', ',', '.', NULL, NULL),
(50, 'Hong Kong', 'Dollars', 'HKD', '$', ',', '.', NULL, NULL),
(51, 'Hungary', 'Forint', 'HUF', 'Ft', ',', '.', NULL, NULL),
(52, 'Iceland', 'Kronur', 'ISK', 'kr', ',', '.', NULL, NULL),
(53, 'India', 'Rupees', 'INR', '₹', ',', '.', NULL, NULL),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp', ',', '.', NULL, NULL),
(55, 'Iran', 'Rials', 'IRR', '﷼', ',', '.', NULL, NULL),
(56, 'Ireland', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(57, 'Isle of Man', 'Pounds', 'IMP', '£', ',', '.', NULL, NULL),
(58, 'Israel', 'New Shekels', 'ILS', '₪', ',', '.', NULL, NULL),
(59, 'Italy', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$', ',', '.', NULL, NULL),
(61, 'Japan', 'Yen', 'JPY', '¥', ',', '.', NULL, NULL),
(62, 'Jersey', 'Pounds', 'JEP', '£', ',', '.', NULL, NULL),
(63, 'Kazakhstan', 'Tenge', 'KZT', 'лв', ',', '.', NULL, NULL),
(64, 'Korea [North]', 'Won', 'KPW', '₩', ',', '.', NULL, NULL),
(65, 'Korea [South]', 'Won', 'KRW', '₩', ',', '.', NULL, NULL),
(66, 'Kyrgyzstan', 'Soms', 'KGS', 'лв', ',', '.', NULL, NULL),
(67, 'Laos', 'Kips', 'LAK', '₭', ',', '.', NULL, NULL),
(68, 'Latvia', 'Lati', 'LVL', 'Ls', ',', '.', NULL, NULL),
(69, 'Lebanon', 'Pounds', 'LBP', '£', ',', '.', NULL, NULL),
(70, 'Liberia', 'Dollars', 'LRD', '$', ',', '.', NULL, NULL),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF', ',', '.', NULL, NULL),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt', ',', '.', NULL, NULL),
(73, 'Luxembourg', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(74, 'Macedonia', 'Denars', 'MKD', 'ден', ',', '.', NULL, NULL),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM', ',', '.', NULL, NULL),
(76, 'Malta', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(77, 'Mauritius', 'Rupees', 'MUR', '₨', ',', '.', NULL, NULL),
(78, 'Mexico', 'Pesos', 'MXN', '$', ',', '.', NULL, NULL),
(79, 'Mongolia', 'Tugriks', 'MNT', '₮', ',', '.', NULL, NULL),
(80, 'Mozambique', 'Meticais', 'MZ', 'MT', ',', '.', NULL, NULL),
(81, 'Namibia', 'Dollars', 'NAD', '$', ',', '.', NULL, NULL),
(82, 'Nepal', 'Rupees', 'NPR', '₨', ',', '.', NULL, NULL),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ', ',', '.', NULL, NULL),
(84, 'Netherlands', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(85, 'New Zealand', 'Dollars', 'NZD', '$', ',', '.', NULL, NULL),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$', ',', '.', NULL, NULL),
(87, 'Nigeria', 'Nairas', 'NGN', '₦', ',', '.', NULL, NULL),
(88, 'North Korea', 'Won', 'KPW', '₩', ',', '.', NULL, NULL),
(89, 'Norway', 'Krone', 'NOK', 'kr', ',', '.', NULL, NULL),
(90, 'Oman', 'Rials', 'OMR', '﷼', ',', '.', NULL, NULL),
(91, 'Pakistan', 'Rupees', 'PKR', '₨', ',', '.', NULL, NULL),
(92, 'Panama', 'Balboa', 'PAB', 'B/.', ',', '.', NULL, NULL),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs', ',', '.', NULL, NULL),
(94, 'Peru', 'Nuevos Soles', 'PE', 'S/.', ',', '.', NULL, NULL),
(95, 'Philippines', 'Pesos', 'PHP', 'Php', ',', '.', NULL, NULL),
(96, 'Poland', 'Zlotych', 'PL', 'zł', ',', '.', NULL, NULL),
(97, 'Qatar', 'Rials', 'QAR', '﷼', ',', '.', NULL, NULL),
(98, 'Romania', 'New Lei', 'RO', 'lei', ',', '.', NULL, NULL),
(99, 'Russia', 'Rubles', 'RUB', 'руб', ',', '.', NULL, NULL),
(100, 'Saint Helena', 'Pounds', 'SHP', '£', ',', '.', NULL, NULL),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '﷼', ',', '.', NULL, NULL),
(102, 'Serbia', 'Dinars', 'RSD', 'Дин.', ',', '.', NULL, NULL),
(103, 'Seychelles', 'Rupees', 'SCR', '₨', ',', '.', NULL, NULL),
(104, 'Singapore', 'Dollars', 'SGD', '$', ',', '.', NULL, NULL),
(105, 'Slovenia', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$', ',', '.', NULL, NULL),
(107, 'Somalia', 'Shillings', 'SOS', 'S', ',', '.', NULL, NULL),
(108, 'South Africa', 'Rand', 'ZAR', 'R', ',', '.', NULL, NULL),
(109, 'South Korea', 'Won', 'KRW', '₩', ',', '.', NULL, NULL),
(110, 'Spain', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(111, 'Sri Lanka', 'Rupees', 'LKR', '₨', ',', '.', NULL, NULL),
(112, 'Sweden', 'Kronor', 'SEK', 'kr', ',', '.', NULL, NULL),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF', ',', '.', NULL, NULL),
(114, 'Suriname', 'Dollars', 'SRD', '$', ',', '.', NULL, NULL),
(115, 'Syria', 'Pounds', 'SYP', '£', ',', '.', NULL, NULL),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$', ',', '.', NULL, NULL),
(117, 'Thailand', 'Baht', 'THB', '฿', ',', '.', NULL, NULL),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$', ',', '.', NULL, NULL),
(119, 'Turkey', 'Lira', 'TRY', 'TL', ',', '.', NULL, NULL),
(120, 'Turkey', 'Liras', 'TRL', '£', ',', '.', NULL, NULL),
(121, 'Tuvalu', 'Dollars', 'TVD', '$', ',', '.', NULL, NULL),
(122, 'Ukraine', 'Hryvnia', 'UAH', '₴', ',', '.', NULL, NULL),
(123, 'United Kingdom', 'Pounds', 'GBP', '£', ',', '.', NULL, NULL),
(124, 'United States of America', 'Dollars', 'USD', '$', ',', '.', NULL, NULL),
(125, 'Uruguay', 'Pesos', 'UYU', '$U', ',', '.', NULL, NULL),
(126, 'Uzbekistan', 'Sums', 'UZS', 'лв', ',', '.', NULL, NULL),
(127, 'Vatican City', 'Euro', 'EUR', '€', '.', ',', NULL, NULL),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs', ',', '.', NULL, NULL),
(129, 'Vietnam', 'Dong', 'VND', '₫', ',', '.', NULL, NULL),
(130, 'Yemen', 'Rials', 'YER', '﷼', ',', '.', NULL, NULL),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$', ',', '.', NULL, NULL),
(132, 'Iraq', 'Iraqi dinar', 'IQD', 'د.ع', ',', '.', NULL, NULL),
(133, 'Kenya', 'Kenyan shilling', 'KES', 'KSh', ',', '.', NULL, NULL),
(134, 'Bangladesh', 'Taka', 'BDT', '৳', ',', '.', NULL, NULL),
(135, 'Algerie', 'Algerian dinar', 'DZD', 'د.ج', ' ', '.', NULL, NULL),
(136, 'United Arab Emirates', 'United Arab Emirates dirham', 'AED', 'د.إ', ',', '.', NULL, NULL),
(137, 'Uganda', 'Uganda shillings', 'UGX', 'USh', ',', '.', NULL, NULL),
(138, 'Tanzania', 'Tanzanian shilling', 'TZS', 'TSh', ',', '.', NULL, NULL),
(139, 'Angola', 'Kwanza', 'AOA', 'Kz', ',', '.', NULL, NULL),
(140, 'Kuwait', 'Kuwaiti dinar', 'KWD', 'KD', ',', '.', NULL, NULL),
(141, 'Bahrain', 'Bahraini dinar', 'BHD', 'BD', ',', '.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `amount` double(5,2) NOT NULL,
  `price_calculation_type` varchar(191) DEFAULT 'percentage',
  `selling_price_group_id` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_configurations`
--

CREATE TABLE `dashboard_configurations` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `color` varchar(191) NOT NULL,
  `configuration` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE `designs` (
  `id` int(10) UNSIGNED NOT NULL,
  `style_id` int(10) UNSIGNED NOT NULL,
  `design_name` varchar(191) NOT NULL,
  `serial_no` varchar(191) NOT NULL,
  `design_image` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designs`
--

INSERT INTO `designs` (`id`, `style_id`, `design_name`, `serial_no`, `design_image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(15, 10, 'শেরওয়ানী রাউন্ড কলার', '1', NULL, NULL, '2025-08-26 09:40:44', '2025-08-26 09:40:44'),
(16, 10, 'শেরওয়ানী কলার কোনা', '2', NULL, NULL, '2025-08-26 09:40:44', '2025-08-26 09:40:44'),
(17, 10, 'ব্যান্ড কলার', '3', NULL, NULL, '2025-08-26 09:40:44', '2025-08-26 09:40:44'),
(18, 10, 'ব্যান্ড রাউন্ড', '4', NULL, NULL, '2025-08-26 09:40:44', '2025-08-26 09:40:44'),
(19, 10, 'রাউন্ড কলার', '5', NULL, NULL, '2025-08-26 09:40:44', '2025-08-26 09:40:44'),
(20, 10, 'ডিজাইন কলার', '6', NULL, NULL, '2025-08-26 09:40:44', '2025-08-26 09:40:44'),
(21, 10, 'শার্ট কলার', '7', NULL, NULL, '2025-08-26 09:40:44', '2025-08-26 09:40:44'),
(22, 10, 'শার্ট কলার এরো', '8', NULL, NULL, '2025-08-26 09:40:44', '2025-08-26 09:40:44'),
(23, 10, 'শেরওয়ানী কলার', '9', NULL, NULL, '2025-08-26 09:40:44', '2025-08-26 09:40:44'),
(24, 11, 'সিংগেল প্লেট', '1', NULL, NULL, '2025-08-26 09:42:42', '2025-08-26 09:42:42'),
(25, 11, 'ডাবল প্লেট', '2', NULL, NULL, '2025-08-26 09:42:42', '2025-08-26 09:42:42'),
(26, 11, 'প্লেট চোক্কা', '3', NULL, NULL, '2025-08-26 09:42:42', '2025-08-26 09:42:42'),
(27, 11, 'প্লেট চোক্কা', '4', NULL, NULL, '2025-08-26 09:42:42', '2025-08-26 09:42:42'),
(28, 11, 'প্লেটে নরম পেস্টিং', '5', NULL, NULL, '2025-08-26 09:42:42', '2025-08-26 09:42:42'),
(29, 12, 'কফ কোনা', '1', NULL, NULL, '2025-08-26 09:44:58', '2025-08-26 09:44:58'),
(30, 12, 'কফ রাউন', '2', NULL, NULL, '2025-08-26 09:44:58', '2025-08-26 09:44:58'),
(31, 12, 'কফ কোনা কাটা', '3', NULL, NULL, '2025-08-26 09:44:58', '2025-08-26 09:44:58'),
(32, 12, 'ডাবল কফ', '4', NULL, NULL, '2025-08-26 09:44:58', '2025-08-26 09:44:58'),
(33, 14, 'asca', '1', NULL, NULL, '2025-10-13 05:52:19', '2025-10-13 05:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `business_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `discount_type` varchar(191) DEFAULT NULL,
  `discount_amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `starts_at` datetime DEFAULT NULL,
  `ends_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `spg` varchar(100) DEFAULT NULL COMMENT 'Applicable in specified selling price group only. Use of applicable_in_spg column is discontinued',
  `applicable_in_cg` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount_variations`
--

CREATE TABLE `discount_variations` (
  `discount_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_and_notes`
--

CREATE TABLE `document_and_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `notable_id` int(11) NOT NULL,
  `notable_type` varchar(191) NOT NULL,
  `heading` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_sub_taxes`
--

CREATE TABLE `group_sub_taxes` (
  `group_tax_id` int(10) UNSIGNED NOT NULL,
  `tax_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_layouts`
--

CREATE TABLE `invoice_layouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `header_text` text DEFAULT NULL,
  `invoice_no_prefix` varchar(191) DEFAULT NULL,
  `quotation_no_prefix` varchar(191) DEFAULT NULL,
  `invoice_heading` varchar(191) DEFAULT NULL,
  `sub_heading_line1` varchar(191) DEFAULT NULL,
  `sub_heading_line2` varchar(191) DEFAULT NULL,
  `sub_heading_line3` varchar(191) DEFAULT NULL,
  `sub_heading_line4` varchar(191) DEFAULT NULL,
  `sub_heading_line5` varchar(191) DEFAULT NULL,
  `invoice_heading_not_paid` varchar(191) DEFAULT NULL,
  `invoice_heading_paid` varchar(191) DEFAULT NULL,
  `quotation_heading` varchar(191) DEFAULT NULL,
  `sub_total_label` varchar(191) DEFAULT NULL,
  `discount_label` varchar(191) DEFAULT NULL,
  `tax_label` varchar(191) DEFAULT NULL,
  `total_label` varchar(191) DEFAULT NULL,
  `round_off_label` varchar(191) DEFAULT NULL,
  `total_due_label` varchar(191) DEFAULT NULL,
  `paid_label` varchar(191) DEFAULT NULL,
  `show_client_id` tinyint(1) NOT NULL DEFAULT 0,
  `client_id_label` varchar(191) DEFAULT NULL,
  `client_tax_label` varchar(191) DEFAULT NULL,
  `date_label` varchar(191) DEFAULT NULL,
  `date_time_format` varchar(191) DEFAULT NULL,
  `show_time` tinyint(1) NOT NULL DEFAULT 1,
  `show_brand` tinyint(1) NOT NULL DEFAULT 0,
  `show_sku` tinyint(1) NOT NULL DEFAULT 1,
  `show_cat_code` tinyint(1) NOT NULL DEFAULT 1,
  `show_expiry` tinyint(1) NOT NULL DEFAULT 0,
  `show_lot` tinyint(1) NOT NULL DEFAULT 0,
  `show_image` tinyint(1) NOT NULL DEFAULT 0,
  `show_sale_description` tinyint(1) NOT NULL DEFAULT 0,
  `sales_person_label` varchar(191) DEFAULT NULL,
  `show_sales_person` tinyint(1) NOT NULL DEFAULT 0,
  `table_product_label` varchar(191) DEFAULT NULL,
  `table_qty_label` varchar(191) DEFAULT NULL,
  `table_unit_price_label` varchar(191) DEFAULT NULL,
  `table_subtotal_label` varchar(191) DEFAULT NULL,
  `cat_code_label` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `show_logo` tinyint(1) NOT NULL DEFAULT 0,
  `show_business_name` tinyint(1) NOT NULL DEFAULT 0,
  `show_location_name` tinyint(1) NOT NULL DEFAULT 1,
  `show_landmark` tinyint(1) NOT NULL DEFAULT 1,
  `show_city` tinyint(1) NOT NULL DEFAULT 1,
  `show_state` tinyint(1) NOT NULL DEFAULT 1,
  `show_zip_code` tinyint(1) NOT NULL DEFAULT 1,
  `show_country` tinyint(1) NOT NULL DEFAULT 1,
  `show_mobile_number` tinyint(1) NOT NULL DEFAULT 1,
  `show_alternate_number` tinyint(1) NOT NULL DEFAULT 0,
  `show_email` tinyint(1) NOT NULL DEFAULT 0,
  `show_tax_1` tinyint(1) NOT NULL DEFAULT 1,
  `show_tax_2` tinyint(1) NOT NULL DEFAULT 0,
  `show_barcode` tinyint(1) NOT NULL DEFAULT 0,
  `show_payments` tinyint(1) NOT NULL DEFAULT 0,
  `show_customer` tinyint(1) NOT NULL DEFAULT 0,
  `customer_label` varchar(191) DEFAULT NULL,
  `commission_agent_label` varchar(191) DEFAULT NULL,
  `show_commission_agent` tinyint(1) NOT NULL DEFAULT 0,
  `show_reward_point` tinyint(1) NOT NULL DEFAULT 0,
  `highlight_color` varchar(10) DEFAULT NULL,
  `footer_text` text DEFAULT NULL,
  `module_info` text DEFAULT NULL,
  `common_settings` text DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `business_id` int(10) UNSIGNED NOT NULL,
  `show_letter_head` tinyint(1) NOT NULL DEFAULT 0,
  `letter_head` varchar(191) DEFAULT NULL,
  `show_qr_code` tinyint(1) NOT NULL DEFAULT 0,
  `qr_code_fields` text DEFAULT NULL,
  `design` varchar(190) DEFAULT 'classic',
  `cn_heading` varchar(191) DEFAULT NULL COMMENT 'cn = credit note',
  `cn_no_label` varchar(191) DEFAULT NULL,
  `cn_amount_label` varchar(191) DEFAULT NULL,
  `table_tax_headings` text DEFAULT NULL,
  `show_previous_bal` tinyint(1) NOT NULL DEFAULT 0,
  `prev_bal_label` varchar(191) DEFAULT NULL,
  `change_return_label` varchar(191) DEFAULT NULL,
  `product_custom_fields` text DEFAULT NULL,
  `contact_custom_fields` text DEFAULT NULL,
  `location_custom_fields` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_layouts`
--

INSERT INTO `invoice_layouts` (`id`, `name`, `header_text`, `invoice_no_prefix`, `quotation_no_prefix`, `invoice_heading`, `sub_heading_line1`, `sub_heading_line2`, `sub_heading_line3`, `sub_heading_line4`, `sub_heading_line5`, `invoice_heading_not_paid`, `invoice_heading_paid`, `quotation_heading`, `sub_total_label`, `discount_label`, `tax_label`, `total_label`, `round_off_label`, `total_due_label`, `paid_label`, `show_client_id`, `client_id_label`, `client_tax_label`, `date_label`, `date_time_format`, `show_time`, `show_brand`, `show_sku`, `show_cat_code`, `show_expiry`, `show_lot`, `show_image`, `show_sale_description`, `sales_person_label`, `show_sales_person`, `table_product_label`, `table_qty_label`, `table_unit_price_label`, `table_subtotal_label`, `cat_code_label`, `logo`, `show_logo`, `show_business_name`, `show_location_name`, `show_landmark`, `show_city`, `show_state`, `show_zip_code`, `show_country`, `show_mobile_number`, `show_alternate_number`, `show_email`, `show_tax_1`, `show_tax_2`, `show_barcode`, `show_payments`, `show_customer`, `customer_label`, `commission_agent_label`, `show_commission_agent`, `show_reward_point`, `highlight_color`, `footer_text`, `module_info`, `common_settings`, `is_default`, `business_id`, `show_letter_head`, `letter_head`, `show_qr_code`, `qr_code_fields`, `design`, `cn_heading`, `cn_no_label`, `cn_amount_label`, `table_tax_headings`, `show_previous_bal`, `prev_bal_label`, `change_return_label`, `product_custom_fields`, `contact_custom_fields`, `location_custom_fields`, `created_at`, `updated_at`) VALUES
(1, 'Default', NULL, 'Invoice No.', NULL, 'Invoice', NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'Subtotal', 'Discount', 'Tax', 'Total', NULL, 'Total Due', 'Total Paid', 0, NULL, NULL, 'Date', NULL, 1, 0, 1, 1, 0, 0, 0, 0, NULL, 0, 'Product', 'Quantity', 'Unit Price', 'Subtotal', NULL, NULL, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 'Customer', NULL, 0, 0, '#000000', '', NULL, NULL, 1, 1, 0, NULL, 0, NULL, 'classic', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2024-03-22 09:48:05', '2024-03-22 09:48:05'),
(2, 'Default', NULL, 'Invoice No.', NULL, 'Invoice', NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'Subtotal', 'Discount', 'Tax', 'Total', NULL, 'Total Due', 'Total Paid', 0, NULL, NULL, 'Date', NULL, 1, 0, 1, 1, 0, 0, 0, 0, NULL, 0, 'Product', 'Quantity', 'Unit Price', 'Subtotal', NULL, NULL, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 'Customer', NULL, 0, 0, '#000000', '', NULL, NULL, 1, 2, 0, NULL, 0, NULL, 'classic', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(3, 'Default', NULL, 'Invoice No.', NULL, 'Invoice', NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'Subtotal', 'Discount', 'Tax', 'Total', NULL, 'Total Due', 'Total Paid', 0, NULL, NULL, 'Date', NULL, 1, 0, 1, 1, 0, 0, 0, 0, NULL, 0, 'Product', 'Quantity', 'Unit Price', 'Subtotal', NULL, NULL, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 'Customer', NULL, 0, 0, '#000000', '', NULL, NULL, 1, 3, 0, NULL, 0, NULL, 'classic', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:17:02', '2026-03-24 18:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_schemes`
--

CREATE TABLE `invoice_schemes` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `scheme_type` enum('blank','year') NOT NULL,
  `number_type` varchar(100) NOT NULL DEFAULT 'sequential',
  `prefix` varchar(191) DEFAULT NULL,
  `start_number` int(11) DEFAULT NULL,
  `invoice_count` int(11) NOT NULL DEFAULT 0,
  `total_digits` int(11) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_schemes`
--

INSERT INTO `invoice_schemes` (`id`, `business_id`, `name`, `scheme_type`, `number_type`, `prefix`, `start_number`, `invoice_count`, `total_digits`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 1, 'Default', 'blank', 'sequential', '', 1, 0, 4, 1, '2024-03-22 09:48:05', '2024-03-22 09:48:05'),
(2, 2, 'Default', 'blank', 'sequential', '', 1, 45, 4, 1, '2025-07-02 04:50:18', '2026-03-24 17:33:22'),
(3, 3, 'Default', 'blank', 'sequential', '', 1, 12, 4, 1, '2026-03-24 18:17:02', '2026-03-24 19:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `measurement_name` varchar(191) NOT NULL,
  `serial_no` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `business_id`, `measurement_name`, `serial_no`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(19, 2, 'লম্বা', 1, 2, NULL, '2025-08-19 06:11:50', '2025-08-26 05:22:42'),
(20, 2, 'বডি', 2, 2, NULL, '2025-08-26 05:23:17', '2025-08-26 05:23:37'),
(21, 2, 'হাতা', 4, 2, NULL, '2025-08-26 05:31:08', '2025-08-26 08:35:58'),
(24, 2, 'পুট', 3, 2, NULL, '2025-08-26 06:31:51', '2025-08-26 06:32:06'),
(25, 2, 'কলার', 5, 2, NULL, '2025-08-26 06:32:55', '2025-08-26 06:34:02'),
(26, 2, 'হাতার মুহুরী', 6, 2, NULL, '2025-08-26 06:33:26', '2025-08-26 06:34:28'),
(27, 2, 'কফ', 7, 2, NULL, '2025-08-26 06:35:11', '2025-08-26 06:35:11'),
(28, 2, 'মোরা', 8, 2, NULL, '2025-08-26 06:36:01', '2025-08-26 06:36:01'),
(29, 2, 'মাদানি', 9, 2, NULL, '2025-08-26 06:36:18', '2025-08-26 06:36:57'),
(30, 2, 'পেট এর লুজ', 10, 2, NULL, '2025-08-26 06:36:35', '2025-08-26 06:37:01'),
(31, 2, 'বডি', 11, 2, NULL, '2025-08-26 06:36:49', '2025-08-26 06:37:06'),
(32, 2, 'মুহুরী', NULL, 2, NULL, '2025-08-26 07:45:54', '2025-08-26 07:45:54'),
(33, 2, 'লম্বা', NULL, 2, NULL, '2025-08-26 07:51:02', '2025-08-26 07:51:02'),
(34, 2, 'হাই', NULL, 2, NULL, '2025-08-26 07:52:49', '2025-08-26 07:52:49'),
(35, 2, 'রান', NULL, 2, NULL, '2025-08-26 07:53:00', '2025-08-26 07:53:00'),
(36, 2, 'কোমর', NULL, 2, NULL, '2025-08-26 07:53:12', '2025-08-26 07:53:12'),
(37, 2, 'রাবার', NULL, 2, NULL, '2025-08-26 07:53:46', '2025-08-26 07:53:46'),
(38, 2, 'ফিতা', NULL, 2, NULL, '2025-08-26 07:53:53', '2025-08-26 07:53:53'),
(39, 2, 'বডি', NULL, 2, NULL, '2025-08-26 07:56:35', '2025-08-26 07:56:35'),
(40, 2, 'নিচের মুহুরী', NULL, 2, NULL, '2025-08-26 08:51:36', '2025-08-26 08:51:36'),
(41, 2, 'বোতাম নং', NULL, 2, NULL, '2025-08-26 09:02:41', '2025-08-26 09:02:41'),
(42, 2, 'বডি', NULL, 2, NULL, '2025-08-26 09:06:15', '2025-08-26 09:06:15'),
(43, 2, 'বডির লুজ', NULL, 2, NULL, '2025-08-26 09:08:04', '2025-08-26 09:08:04'),
(44, 2, 'হিপের লুজ', NULL, 2, NULL, '2025-08-26 09:21:34', '2025-08-26 09:21:34'),
(45, 2, 'পেট', NULL, 2, NULL, '2025-08-26 09:29:01', '2025-08-26 09:29:01'),
(46, 2, 'গলা', NULL, 2, NULL, '2025-08-26 09:30:14', '2025-08-26 09:30:14'),
(52, 2, 'Length', 1, 2, NULL, '2025-10-12 07:35:49', '2025-10-12 07:35:49'),
(53, 2, 'Asa', 1, 2, NULL, '2025-10-13 05:52:00', '2025-10-13 05:52:00'),
(54, 2, 'test123', NULL, 2, NULL, '2026-02-11 12:53:16', '2026-02-11 12:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `measurement_sub_measurement`
--

CREATE TABLE `measurement_sub_measurement` (
  `measurement_id` int(10) UNSIGNED NOT NULL,
  `sub_measurement_id` int(10) UNSIGNED NOT NULL,
  `serial_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measurement_sub_measurement`
--

INSERT INTO `measurement_sub_measurement` (`measurement_id`, `sub_measurement_id`, `serial_no`) VALUES
(19, 12, 1),
(20, 13, 1),
(20, 14, 2),
(20, 15, 3),
(20, 16, 4),
(21, 17, 1),
(39, 13, 2),
(39, 15, 4),
(39, 16, 1),
(39, 29, 3),
(42, 16, 1),
(42, 30, 2),
(52, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `model_type` varchar(191) NOT NULL,
  `woocommerce_media_id` int(11) DEFAULT NULL,
  `model_media_type` varchar(191) DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `business_id`, `file_name`, `description`, `uploaded_by`, `model_type`, `woocommerce_media_id`, `model_media_type`, `model_id`, `created_at`, `updated_at`) VALUES
(1, 2, '1752837529_934964018_rewards2.png', NULL, 2, 'App\\Variation', NULL, NULL, 3, '2025-07-18 11:18:49', '2025-07-18 11:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2017_07_05_071953_create_currencies_table', 1),
(9, '2017_07_05_073658_create_business_table', 1),
(10, '2017_07_22_075923_add_business_id_users_table', 1),
(11, '2017_07_23_113209_create_brands_table', 1),
(12, '2017_07_26_083429_create_permission_tables', 1),
(13, '2017_07_26_110000_create_tax_rates_table', 1),
(14, '2017_07_26_122313_create_units_table', 1),
(15, '2017_07_27_075706_create_contacts_table', 1),
(16, '2017_08_04_071038_create_categories_table', 1),
(17, '2017_08_08_115903_create_products_table', 1),
(18, '2017_08_09_061616_create_variation_templates_table', 1),
(19, '2017_08_09_061638_create_variation_value_templates_table', 1),
(20, '2017_08_10_061146_create_product_variations_table', 1),
(21, '2017_08_10_061216_create_variations_table', 1),
(22, '2017_08_19_054827_create_transactions_table', 1),
(23, '2017_08_31_073533_create_purchase_lines_table', 1),
(24, '2017_10_15_064638_create_transaction_payments_table', 1),
(25, '2017_10_31_065621_add_default_sales_tax_to_business_table', 1),
(26, '2017_11_20_051930_create_table_group_sub_taxes', 1),
(27, '2017_11_20_063603_create_transaction_sell_lines', 1),
(28, '2017_11_21_064540_create_barcodes_table', 1),
(29, '2017_11_23_181237_create_invoice_schemes_table', 1),
(30, '2017_12_25_122822_create_business_locations_table', 1),
(31, '2017_12_25_160253_add_location_id_to_transactions_table', 1),
(32, '2017_12_25_163227_create_variation_location_details_table', 1),
(33, '2018_01_04_115627_create_sessions_table', 1),
(34, '2018_01_05_112817_create_invoice_layouts_table', 1),
(35, '2018_01_06_112303_add_invoice_scheme_id_and_invoice_layout_id_to_business_locations', 1),
(36, '2018_01_08_104124_create_expense_categories_table', 1),
(37, '2018_01_08_123327_modify_transactions_table_for_expenses', 1),
(38, '2018_01_09_111005_modify_payment_status_in_transactions_table', 1),
(39, '2018_01_09_111109_add_paid_on_column_to_transaction_payments_table', 1),
(40, '2018_01_25_172439_add_printer_related_fields_to_business_locations_table', 1),
(41, '2018_01_27_184322_create_printers_table', 1),
(42, '2018_01_30_181442_create_cash_registers_table', 1),
(43, '2018_01_31_125836_create_cash_register_transactions_table', 1),
(44, '2018_02_07_173326_modify_business_table', 1),
(45, '2018_02_08_105425_add_enable_product_expiry_column_to_business_table', 1),
(46, '2018_02_08_111027_add_expiry_period_and_expiry_period_type_columns_to_products_table', 1),
(47, '2018_02_08_131118_add_mfg_date_and_exp_date_purchase_lines_table', 1),
(48, '2018_02_08_155348_add_exchange_rate_to_transactions_table', 1),
(49, '2018_02_09_124945_modify_transaction_payments_table_for_contact_payments', 1),
(50, '2018_02_12_113640_create_transaction_sell_lines_purchase_lines_table', 1),
(51, '2018_02_12_114605_add_quantity_sold_in_purchase_lines_table', 1),
(52, '2018_02_13_183323_alter_decimal_fields_size', 1),
(53, '2018_02_14_161928_add_transaction_edit_days_to_business_table', 1),
(54, '2018_02_15_161032_add_document_column_to_transactions_table', 1),
(55, '2018_02_17_124709_add_more_options_to_invoice_layouts', 1),
(56, '2018_02_19_111517_add_keyboard_shortcut_column_to_business_table', 1),
(57, '2018_02_19_121537_stock_adjustment_move_to_transaction_table', 1),
(58, '2018_02_20_165505_add_is_direct_sale_column_to_transactions_table', 1),
(59, '2018_02_21_105329_create_system_table', 1),
(60, '2018_02_23_100549_version_1_2', 1),
(61, '2018_02_23_125648_add_enable_editing_sp_from_purchase_column_to_business_table', 1),
(62, '2018_02_26_103612_add_sales_commission_agent_column_to_business_table', 1),
(63, '2018_02_26_130519_modify_users_table_for_sales_cmmsn_agnt', 1),
(64, '2018_02_26_134500_add_commission_agent_to_transactions_table', 1),
(65, '2018_02_27_121422_add_item_addition_method_to_business_table', 1),
(66, '2018_02_27_170232_modify_transactions_table_for_stock_transfer', 1),
(67, '2018_03_05_153510_add_enable_inline_tax_column_to_business_table', 1),
(68, '2018_03_06_210206_modify_product_barcode_types', 1),
(69, '2018_03_13_181541_add_expiry_type_to_business_table', 1),
(70, '2018_03_16_113446_product_expiry_setting_for_business', 1),
(71, '2018_03_19_113601_add_business_settings_options', 1),
(72, '2018_03_26_125334_add_pos_settings_to_business_table', 1),
(73, '2018_03_26_165350_create_customer_groups_table', 1),
(74, '2018_03_27_122720_customer_group_related_changes_in_tables', 1),
(75, '2018_03_29_110138_change_tax_field_to_nullable_in_business_table', 1),
(76, '2018_03_29_115502_add_changes_for_sr_number_in_products_and_sale_lines_table', 1),
(77, '2018_03_29_134340_add_inline_discount_fields_in_purchase_lines', 1),
(78, '2018_03_31_140921_update_transactions_table_exchange_rate', 1),
(79, '2018_04_03_103037_add_contact_id_to_contacts_table', 1),
(80, '2018_04_03_122709_add_changes_to_invoice_layouts_table', 1),
(81, '2018_04_09_135320_change_exchage_rate_size_in_business_table', 1),
(82, '2018_04_17_123122_add_lot_number_to_business', 1),
(83, '2018_04_17_160845_add_product_racks_table', 1),
(84, '2018_04_20_182015_create_res_tables_table', 1),
(85, '2018_04_24_105246_restaurant_fields_in_transaction_table', 1),
(86, '2018_04_24_114149_add_enabled_modules_business_table', 1),
(87, '2018_04_24_133704_add_modules_fields_in_invoice_layout_table', 1),
(88, '2018_04_27_132653_quotation_related_change', 1),
(89, '2018_05_02_104439_add_date_format_and_time_format_to_business', 1),
(90, '2018_05_02_111939_add_sell_return_to_transaction_payments', 1),
(91, '2018_05_14_114027_add_rows_positions_for_products', 1),
(92, '2018_05_14_125223_add_weight_to_products_table', 1),
(93, '2018_05_14_164754_add_opening_stock_permission', 1),
(94, '2018_05_15_134729_add_design_to_invoice_layouts', 1),
(95, '2018_05_16_183307_add_tax_fields_invoice_layout', 1),
(96, '2018_05_18_191956_add_sell_return_to_transaction_table', 1),
(97, '2018_05_21_131349_add_custom_fileds_to_contacts_table', 1),
(98, '2018_05_21_131607_invoice_layout_fields_for_sell_return', 1),
(99, '2018_05_21_131949_add_custom_fileds_and_website_to_business_locations_table', 1),
(100, '2018_05_22_123527_create_reference_counts_table', 1),
(101, '2018_05_22_154540_add_ref_no_prefixes_column_to_business_table', 1),
(102, '2018_05_24_132620_add_ref_no_column_to_transaction_payments_table', 1),
(103, '2018_05_24_161026_add_location_id_column_to_business_location_table', 1),
(104, '2018_05_25_180603_create_modifiers_related_table', 1),
(105, '2018_05_29_121714_add_purchase_line_id_to_stock_adjustment_line_table', 1),
(106, '2018_05_31_114645_add_res_order_status_column_to_transactions_table', 1),
(107, '2018_06_05_103530_rename_purchase_line_id_in_stock_adjustment_lines_table', 1),
(108, '2018_06_05_111905_modify_products_table_for_modifiers', 1),
(109, '2018_06_06_110524_add_parent_sell_line_id_column_to_transaction_sell_lines_table', 1),
(110, '2018_06_07_152443_add_is_service_staff_to_roles_table', 1),
(111, '2018_06_07_182258_add_image_field_to_products_table', 1),
(112, '2018_06_13_133705_create_bookings_table', 1),
(113, '2018_06_15_173636_add_email_column_to_contacts_table', 1),
(114, '2018_06_27_182835_add_superadmin_related_fields_business', 1),
(115, '2018_07_10_101913_add_custom_fields_to_products_table', 1),
(116, '2018_07_17_103434_add_sales_person_name_label_to_invoice_layouts_table', 1),
(117, '2018_07_17_163920_add_theme_skin_color_column_to_business_table', 1),
(118, '2018_07_24_160319_add_lot_no_line_id_to_transaction_sell_lines_table', 1),
(119, '2018_07_25_110004_add_show_expiry_and_show_lot_colums_to_invoice_layouts_table', 1),
(120, '2018_07_25_172004_add_discount_columns_to_transaction_sell_lines_table', 1),
(121, '2018_07_26_124720_change_design_column_type_in_invoice_layouts_table', 1),
(122, '2018_07_26_170424_add_unit_price_before_discount_column_to_transaction_sell_line_table', 1),
(123, '2018_07_28_103614_add_credit_limit_column_to_contacts_table', 1),
(124, '2018_08_08_110755_add_new_payment_methods_to_transaction_payments_table', 1),
(125, '2018_08_08_122225_modify_cash_register_transactions_table_for_new_payment_methods', 1),
(126, '2018_08_14_104036_add_opening_balance_type_to_transactions_table', 1),
(127, '2018_09_04_155900_create_accounts_table', 1),
(128, '2018_09_06_114438_create_selling_price_groups_table', 1),
(129, '2018_09_06_154057_create_variation_group_prices_table', 1),
(130, '2018_09_07_102413_add_permission_to_access_default_selling_price', 1),
(131, '2018_09_07_134858_add_selling_price_group_id_to_transactions_table', 1),
(132, '2018_09_10_112448_update_product_type_to_single_if_null_in_products_table', 1),
(133, '2018_09_10_152703_create_account_transactions_table', 1),
(134, '2018_09_10_173656_add_account_id_column_to_transaction_payments_table', 1),
(135, '2018_09_19_123914_create_notification_templates_table', 1),
(136, '2018_09_22_110504_add_sms_and_email_settings_columns_to_business_table', 1),
(137, '2018_09_24_134942_add_lot_no_line_id_to_stock_adjustment_lines_table', 1),
(138, '2018_09_26_105557_add_transaction_payments_for_existing_expenses', 1),
(139, '2018_09_27_111609_modify_transactions_table_for_purchase_return', 1),
(140, '2018_09_27_131154_add_quantity_returned_column_to_purchase_lines_table', 1),
(141, '2018_10_02_131401_add_return_quantity_column_to_transaction_sell_lines_table', 1),
(142, '2018_10_03_104918_add_qty_returned_column_to_transaction_sell_lines_purchase_lines_table', 1),
(143, '2018_10_03_185947_add_default_notification_templates_to_database', 1),
(144, '2018_10_09_153105_add_business_id_to_transaction_payments_table', 1),
(145, '2018_10_16_135229_create_permission_for_sells_and_purchase', 1),
(146, '2018_10_22_114441_add_columns_for_variable_product_modifications', 1),
(147, '2018_10_22_134428_modify_variable_product_data', 1),
(148, '2018_10_30_181558_add_table_tax_headings_to_invoice_layout', 1),
(149, '2018_10_31_122619_add_pay_terms_field_transactions_table', 1),
(150, '2018_10_31_161328_add_new_permissions_for_pos_screen', 1),
(151, '2018_10_31_174752_add_access_selected_contacts_only_to_users_table', 1),
(152, '2018_10_31_175627_add_user_contact_access', 1),
(153, '2018_10_31_180559_add_auto_send_sms_column_to_notification_templates_table', 1),
(154, '2018_11_02_171949_change_card_type_column_to_varchar_in_transaction_payments_table', 1),
(155, '2018_11_08_105621_add_role_permissions', 1),
(156, '2018_11_26_114135_add_is_suspend_column_to_transactions_table', 1),
(157, '2018_11_28_104410_modify_units_table_for_multi_unit', 1),
(158, '2018_11_28_170952_add_sub_unit_id_to_purchase_lines_and_sell_lines', 1),
(159, '2018_11_29_115918_add_primary_key_in_system_table', 1),
(160, '2018_12_03_185546_add_product_description_column_to_products_table', 1),
(161, '2018_12_06_114937_modify_system_table_and_users_table', 1),
(162, '2018_12_13_160007_add_custom_fields_display_options_to_invoice_layouts_table', 1),
(163, '2018_12_14_103307_modify_system_table', 1),
(164, '2018_12_18_133837_add_prev_balance_due_columns_to_invoice_layouts_table', 1),
(165, '2018_12_18_170656_add_invoice_token_column_to_transaction_table', 1),
(166, '2018_12_20_133639_add_date_time_format_column_to_invoice_layouts_table', 1),
(167, '2018_12_21_120659_add_recurring_invoice_fields_to_transactions_table', 1),
(168, '2018_12_24_154933_create_notifications_table', 1),
(169, '2019_01_08_112015_add_document_column_to_transaction_payments_table', 1),
(170, '2019_01_10_124645_add_account_permission', 1),
(171, '2019_01_16_125825_add_subscription_no_column_to_transactions_table', 1),
(172, '2019_01_28_111647_add_order_addresses_column_to_transactions_table', 1),
(173, '2019_02_13_173821_add_is_inactive_column_to_products_table', 1),
(174, '2019_02_19_103118_create_discounts_table', 1),
(175, '2019_02_21_120324_add_discount_id_column_to_transaction_sell_lines_table', 1),
(176, '2019_02_21_134324_add_permission_for_discount', 1),
(177, '2019_03_04_170832_add_service_staff_columns_to_transaction_sell_lines_table', 1),
(178, '2019_03_09_102425_add_sub_type_column_to_transactions_table', 1),
(179, '2019_03_09_124457_add_indexing_transaction_sell_lines_purchase_lines_table', 1),
(180, '2019_03_12_120336_create_activity_log_table', 1),
(181, '2019_03_15_132925_create_media_table', 1),
(182, '2019_05_08_130339_add_indexing_to_parent_id_in_transaction_payments_table', 1),
(183, '2019_05_10_132311_add_missing_column_indexing', 1),
(184, '2019_05_14_091812_add_show_image_column_to_invoice_layouts_table', 1),
(185, '2019_05_25_104922_add_view_purchase_price_permission', 1),
(186, '2019_06_17_103515_add_profile_informations_columns_to_users_table', 1),
(187, '2019_06_18_135524_add_permission_to_view_own_sales_only', 1),
(188, '2019_06_19_112058_add_database_changes_for_reward_points', 1),
(189, '2019_06_28_133732_change_type_column_to_string_in_transactions_table', 1),
(190, '2019_07_13_111420_add_is_created_from_api_column_to_transactions_table', 1),
(191, '2019_07_15_165136_add_fields_for_combo_product', 1),
(192, '2019_07_19_103446_add_mfg_quantity_used_column_to_purchase_lines_table', 1),
(193, '2019_07_22_152649_add_not_for_selling_in_product_table', 1),
(194, '2019_07_29_185351_add_show_reward_point_column_to_invoice_layouts_table', 1),
(195, '2019_08_08_162302_add_sub_units_related_fields', 1),
(196, '2019_08_26_133419_update_price_fields_decimal_point', 1),
(197, '2019_09_02_160054_remove_location_permissions_from_roles', 1),
(198, '2019_09_03_185259_add_permission_for_pos_screen', 1),
(199, '2019_09_04_163141_add_location_id_to_cash_registers_table', 1),
(200, '2019_09_04_184008_create_types_of_services_table', 1),
(201, '2019_09_06_131445_add_types_of_service_fields_to_transactions_table', 1),
(202, '2019_09_09_134810_add_default_selling_price_group_id_column_to_business_locations_table', 1),
(203, '2019_09_12_105616_create_product_locations_table', 1),
(204, '2019_09_17_122522_add_custom_labels_column_to_business_table', 1),
(205, '2019_09_18_164319_add_shipping_fields_to_transactions_table', 1),
(206, '2019_09_19_170927_close_all_active_registers', 1),
(207, '2019_09_23_161906_add_media_description_cloumn_to_media_table', 1),
(208, '2019_10_18_155633_create_account_types_table', 1),
(209, '2019_10_22_163335_add_common_settings_column_to_business_table', 1),
(210, '2019_10_29_132521_add_update_purchase_status_permission', 1),
(211, '2019_11_09_110522_add_indexing_to_lot_number', 1),
(212, '2019_11_19_170824_add_is_active_column_to_business_locations_table', 1),
(213, '2019_11_21_162913_change_quantity_field_types_to_decimal', 1),
(214, '2019_11_25_160340_modify_categories_table_for_polymerphic_relationship', 1),
(215, '2019_12_02_105025_create_warranties_table', 1),
(216, '2019_12_03_180342_add_common_settings_field_to_invoice_layouts_table', 1),
(217, '2019_12_05_183955_add_more_fields_to_users_table', 1),
(218, '2019_12_06_174904_add_change_return_label_column_to_invoice_layouts_table', 1),
(219, '2019_12_11_121307_add_draft_and_quotation_list_permissions', 1),
(220, '2019_12_12_180126_copy_expense_total_to_total_before_tax', 1),
(221, '2019_12_19_181412_make_alert_quantity_field_nullable_on_products_table', 1),
(222, '2019_12_25_173413_create_dashboard_configurations_table', 1),
(223, '2020_01_08_133506_create_document_and_notes_table', 1),
(224, '2020_01_09_113252_add_cc_bcc_column_to_notification_templates_table', 1),
(225, '2020_01_16_174818_add_round_off_amount_field_to_transactions_table', 1),
(226, '2020_01_28_162345_add_weighing_scale_settings_in_business_settings_table', 1),
(227, '2020_02_18_172447_add_import_fields_to_transactions_table', 1),
(228, '2020_03_13_135844_add_is_active_column_to_selling_price_groups_table', 1),
(229, '2020_03_16_115449_add_contact_status_field_to_contacts_table', 1),
(230, '2020_03_26_124736_add_allow_login_column_in_users_table', 1),
(231, '2020_04_13_154150_add_feature_products_column_to_business_loactions', 1),
(232, '2020_04_15_151802_add_user_type_to_users_table', 1),
(233, '2020_04_22_153905_add_subscription_repeat_on_column_to_transactions_table', 1),
(234, '2020_04_28_111436_add_shipping_address_to_contacts_table', 1),
(235, '2020_06_01_094654_add_max_sale_discount_column_to_users_table', 1),
(236, '2020_06_12_162245_modify_contacts_table', 1),
(237, '2020_06_22_103104_change_recur_interval_default_to_one', 1),
(238, '2020_07_09_174621_add_balance_field_to_contacts_table', 1),
(239, '2020_07_23_104933_change_status_column_to_varchar_in_transaction_table', 1),
(240, '2020_09_07_171059_change_completed_stock_transfer_status_to_final', 1),
(241, '2020_09_21_123224_modify_booking_status_column_in_bookings_table', 1),
(242, '2020_09_22_121639_create_discount_variations_table', 1),
(243, '2020_10_05_121550_modify_business_location_table_for_invoice_layout', 1),
(244, '2020_10_16_175726_set_status_as_received_for_opening_stock', 1),
(245, '2020_10_23_170823_add_for_group_tax_column_to_tax_rates_table', 1),
(246, '2020_11_04_130940_add_more_custom_fields_to_contacts_table', 1),
(247, '2020_11_10_152841_add_cash_register_permissions', 1),
(248, '2020_11_17_164041_modify_type_column_to_varchar_in_contacts_table', 1),
(249, '2020_12_18_181447_add_shipping_custom_fields_to_transactions_table', 1),
(250, '2020_12_22_164303_add_sub_status_column_to_transactions_table', 1),
(251, '2020_12_24_153050_add_custom_fields_to_transactions_table', 1),
(252, '2020_12_28_105403_add_whatsapp_text_column_to_notification_templates_table', 1),
(253, '2020_12_29_165925_add_model_document_type_to_media_table', 1),
(254, '2021_02_08_175632_add_contact_number_fields_to_users_table', 1),
(255, '2021_02_11_172217_add_indexing_for_multiple_columns', 1),
(256, '2021_02_23_122043_add_more_columns_to_customer_groups_table', 1),
(257, '2021_02_24_175551_add_print_invoice_permission_to_all_roles', 1),
(258, '2021_03_03_162021_add_purchase_order_columns_to_purchase_lines_and_transactions_table', 1),
(259, '2021_03_11_120229_add_sales_order_columns', 1),
(260, '2021_03_16_120705_add_business_id_to_activity_log_table', 1),
(261, '2021_03_16_153427_add_code_columns_to_business_table', 1),
(262, '2021_03_18_173308_add_account_details_column_to_accounts_table', 1),
(263, '2021_03_18_183119_add_prefer_payment_account_columns_to_transactions_table', 1),
(264, '2021_03_22_120810_add_more_types_of_service_custom_fields', 1),
(265, '2021_03_24_183132_add_shipping_export_custom_field_details_to_contacts_table', 1),
(266, '2021_03_25_170715_add_export_custom_fields_info_to_transactions_table', 1),
(267, '2021_04_15_063449_add_denominations_column_to_cash_registers_table', 1),
(268, '2021_05_22_083426_add_indexing_to_account_transactions_table', 1),
(269, '2021_07_08_065808_add_additional_expense_columns_to_transaction_table', 1),
(270, '2021_07_13_082918_add_qr_code_columns_to_invoice_layouts_table', 1),
(271, '2021_07_21_061615_add_fields_to_show_commission_agent_in_invoice_layout', 1),
(272, '2021_08_13_105549_add_crm_contact_id_to_users_table', 1),
(273, '2021_08_25_114932_add_payment_link_fields_to_transaction_payments_table', 1),
(274, '2021_09_01_063110_add_spg_column_to_discounts_table', 1),
(275, '2021_09_03_061528_modify_cash_register_transactions_table', 1),
(276, '2021_10_05_061658_add_source_column_to_transactions_table', 1),
(277, '2021_12_16_121851_add_parent_id_column_to_expense_categories_table', 1),
(278, '2022_04_14_075120_add_payment_type_column_to_transaction_payments_table', 1),
(279, '2022_04_21_083327_create_cash_denominations_table', 1),
(280, '2022_05_10_055307_add_delivery_date_column_to_transactions_table', 1),
(281, '2022_06_13_123135_add_currency_precision_and_quantity_precision_fields_to_business_table', 1),
(282, '2022_06_28_133342_add_secondary_unit_columns_to_products_sell_line_purchase_lines_tables', 1),
(283, '2022_07_13_114307_create_purchase_requisition_related_columns', 1),
(284, '2022_08_25_132707_add_service_staff_timer_fields_to_products_and_users_table', 1),
(285, '2023_01_28_114255_add_letter_head_column_to_invoice_layouts_table', 1),
(286, '2023_02_11_161510_add_event_column_to_activity_log_table', 1),
(287, '2023_02_11_161511_add_batch_uuid_column_to_activity_log_table', 1),
(288, '2023_03_02_170312_add_provider_to_oauth_clients_table', 1),
(289, '2023_03_21_122731_add_sale_invoice_scheme_id_business_table', 1),
(290, '2023_03_21_170446_add_number_type_to_invoice_scheme', 1),
(291, '2023_04_17_155216_add_custom_fields_to_products', 1),
(292, '2023_04_28_130247_add_price_type_to_group_price_table', 1),
(293, '2023_06_21_033923_add_delivery_person_in_transactions', 1),
(294, '2023_09_13_153555_add_service_staff_pin_columns_in_users', 1),
(295, '2023_09_15_154404_add_is_kitchen_order_in_transactions', 1),
(296, '2023_12_06_152840_add_contact_type_in_contacts', 1),
(297, '2018_06_27_185405_create_packages_table', 2),
(298, '2018_06_28_182803_create_subscriptions_table', 2),
(299, '2018_07_17_182021_add_rows_to_system_table', 2),
(300, '2018_07_19_131721_add_options_to_packages_table', 2),
(301, '2018_08_17_155534_add_min_termination_alert_days', 2),
(302, '2018_08_28_105945_add_business_based_username_settings_to_system_table', 2),
(303, '2018_08_30_105906_add_superadmin_communicator_logs_table', 2),
(304, '2018_11_02_130636_add_custom_permissions_to_packages_table', 2),
(305, '2018_11_05_161848_add_more_fields_to_packages_table', 2),
(306, '2018_12_10_124621_modify_system_table_values_null_default', 2),
(307, '2019_05_10_135434_add_missing_database_column_indexes', 2),
(308, '2019_08_16_115300_create_superadmin_frontend_pages_table', 2),
(309, '2023_06_10_132121_create_coupons_table', 2),
(310, '2023_06_16_141928_add_column_in_subscriptions', 2),
(311, '2023_06_29_183442_add_mark_package_as_popular', 2),
(312, '2023_07_04_151432_add_column_business', 2),
(313, '2023_07_13_191306_add_businesses_column_in_coupons', 2),
(314, '2018_10_10_110400_add_module_version_to_system_table', 3),
(315, '2018_10_10_122845_add_woocommerce_api_settings_to_business_table', 3),
(316, '2018_10_10_162041_add_woocommerce_category_id_to_categories_table', 3),
(317, '2018_10_11_173839_create_woocommerce_sync_logs_table', 3),
(318, '2018_10_16_123522_add_woocommerce_tax_rate_id_column_to_tax_rates_table', 3),
(319, '2018_10_23_111555_add_woocommerce_attr_id_column_to_variation_templates_table', 3),
(320, '2018_12_03_163945_add_woocommerce_permissions', 3),
(321, '2019_02_18_154414_change_woocommerce_sync_logs_table', 3),
(322, '2019_04_19_174129_add_disable_woocommerce_sync_column_to_products_table', 3),
(323, '2019_06_08_132440_add_woocommerce_wh_oc_secret_column_to_business_table', 3),
(324, '2019_10_01_171828_add_woocommerce_media_id_columns', 3),
(325, '2020_09_07_124952_add_woocommerce_skipped_orders_fields_to_business_table', 3),
(326, '2021_02_16_190608_add_woocommerce_module_indexing', 3),
(327, '2025_06_27_123022_create_sub_measurements_table', 3),
(328, '2025_07_02_123022_create_sub_measurements_table', 4),
(329, '2025_07_03_123226_create_measurements_table', 5),
(330, '2025_07_03_123426_create_measurements_table', 6),
(331, '2025_07_03_123742_create_measurement_sub_measurement_table', 7),
(332, '2025_07_04_101618_create_styles_table', 8),
(333, '2025_07_04_101803_create_designs_table', 8),
(334, '2025_07_04_105024_add_serial_no_to_styles_table', 9),
(335, '2025_07_04_105125_add_serial_no_to_designs_table', 9),
(336, '2025_07_07_143717_create_cloths_table', 10),
(337, '2025_07_07_144004_create_cloth_measurement_table', 10),
(338, '2025_07_07_144024_create_cloth_style_table', 10),
(339, '2025_07_07_151912_update_serial_no_in_designs_table', 11),
(340, '2025_07_07_153017_make_cloth_image_nullable_in_cloths_table', 12),
(341, '2025_07_08_111000_change_serial_no_to_integer_in_measurements_table', 13),
(342, '2025_07_08_112045_change_serial_no_to_integer_in_all_table', 14),
(343, '2025_07_08_120957_add_serial_no_to_measurement_sub_measurement_table', 15),
(344, '2025_07_11_122300_make_serial_no_nullable_in_measurements_and_styles_tables', 16),
(345, '2025_07_11_122544_add_serial_no_to_cloth_style_and_cloth_measurement_tables', 16),
(346, '2025_07_14_113937_add_cloth_id_to_transaction_sell_lines', 17),
(347, '2025_07_14_113957_make_product_id_and_variation_id_nullable_in_transaction_sell_lines', 18),
(348, '2025_07_16_160155_add_delivery_status_to_transactions_table', 19),
(349, '2025_07_18_111109_create_cloth_customizations_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(80, 'App\\User', 3),
(80, 'App\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(3, 'App\\User', 2),
(3, 'App\\User', 3),
(4, 'App\\User', 4),
(5, 'App\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `template_for` varchar(191) NOT NULL,
  `email_body` text DEFAULT NULL,
  `sms_body` text DEFAULT NULL,
  `whatsapp_text` text DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `cc` varchar(191) DEFAULT NULL,
  `bcc` varchar(191) DEFAULT NULL,
  `auto_send` tinyint(1) NOT NULL DEFAULT 0,
  `auto_send_sms` tinyint(1) NOT NULL DEFAULT 0,
  `auto_send_wa_notif` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `business_id`, `template_for`, `email_body`, `sms_body`, `whatsapp_text`, `subject`, `cc`, `bcc`, `auto_send`, `auto_send_sms`, `auto_send_wa_notif`, `created_at`, `updated_at`) VALUES
(1, 1, 'new_sale', '<p>Dear {contact_name},</p>\n\n                    <p>Your invoice number is {invoice_number}<br />\n                    Total amount: {total_amount}<br />\n                    Paid amount: {received_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(2, 1, 'payment_received', '<p>Dear {contact_name},</p>\n\n                <p>We have received a payment of {received_amount}</p>\n\n                <p>{business_logo}</p>', 'Dear {contact_name}, We have received a payment of {received_amount}. {business_name}', NULL, 'Payment Received, from {business_name}', NULL, NULL, 0, 0, 0, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(3, 1, 'payment_reminder', '<p>Dear {contact_name},</p>\n\n                    <p>This is to remind you that you have pending payment of {due_amount}. Kindly pay it as soon as possible.</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, You have pending payment of {due_amount}. Kindly pay it as soon as possible. {business_name}', NULL, 'Payment Reminder, from {business_name}', NULL, NULL, 0, 0, 0, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(4, 1, 'new_booking', '<p>Dear {contact_name},</p>\n\n                    <p>Your booking is confirmed</p>\n\n                    <p>Date: {start_time} to {end_time}</p>\n\n                    <p>Table: {table}</p>\n\n                    <p>Location: {location}</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, Your booking is confirmed. Date: {start_time} to {end_time}, Table: {table}, Location: {location}', NULL, 'Booking Confirmed - {business_name}', NULL, NULL, 0, 0, 0, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(5, 1, 'new_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'Dear {contact_name}, We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible. {business_name}', NULL, 'New Order, from {business_name}', NULL, NULL, 0, 0, 0, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(6, 1, 'payment_paid', '<p>Dear {contact_name},</p>\n\n                    <p>We have paid amount {paid_amount} again invoice number {order_ref_number}.<br />\n                    Kindly note it down.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have paid amount {paid_amount} again invoice number {order_ref_number}.\n                    Kindly note it down. {business_name}', NULL, 'Payment Paid, from {business_name}', NULL, NULL, 0, 0, 0, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(7, 1, 'items_received', '<p>Dear {contact_name},</p>\n\n                    <p>We have received all items from invoice reference number {order_ref_number}. Thank you for processing it.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have received all items from invoice reference number {order_ref_number}. Thank you for processing it. {business_name}', NULL, 'Items received, from {business_name}', NULL, NULL, 0, 0, 0, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(8, 1, 'items_pending', '<p>Dear {contact_name},<br />\n                    This is to remind you that we have not yet received some items from invoice reference number {order_ref_number}. Please process it as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'This is to remind you that we have not yet received some items from invoice reference number {order_ref_number} . Please process it as soon as possible.{business_name}', NULL, 'Items Pending, from {business_name}', NULL, NULL, 0, 0, 0, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(9, 1, 'new_quotation', '<p>Dear {contact_name},</p>\n\n                    <p>Your quotation number is {invoice_number}<br />\n                    Total amount: {total_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(10, 1, 'purchase_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new purchase order with reference number {order_ref_number}. The respective invoice is attached here with.</p>\n\n                    <p>{business_logo}</p>', 'We have a new purchase order with reference number {order_ref_number}. {business_name}', NULL, 'New Purchase Order, from {business_name}', NULL, NULL, 0, 0, 0, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(11, 2, 'new_sale', '<p>Dear {contact_name},</p>\n\n                    <p>Your invoice number is {invoice_number}<br />\n                    Total amount: {total_amount}<br />\n                    Paid amount: {received_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(12, 2, 'payment_received', '<p>Dear {contact_name},</p>\n\n                <p>We have received a payment of {received_amount}</p>\n\n                <p>{business_logo}</p>', 'Dear {contact_name}, We have received a payment of {received_amount}. {business_name}', NULL, 'Payment Received, from {business_name}', NULL, NULL, 0, 0, 0, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(13, 2, 'payment_reminder', '<p>Dear {contact_name},</p>\n\n                    <p>This is to remind you that you have pending payment of {due_amount}. Kindly pay it as soon as possible.</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, You have pending payment of {due_amount}. Kindly pay it as soon as possible. {business_name}', NULL, 'Payment Reminder, from {business_name}', NULL, NULL, 0, 0, 0, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(14, 2, 'new_booking', '<p>Dear {contact_name},</p>\n\n                    <p>Your booking is confirmed</p>\n\n                    <p>Date: {start_time} to {end_time}</p>\n\n                    <p>Table: {table}</p>\n\n                    <p>Location: {location}</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, Your booking is confirmed. Date: {start_time} to {end_time}, Table: {table}, Location: {location}', NULL, 'Booking Confirmed - {business_name}', NULL, NULL, 0, 0, 0, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(15, 2, 'new_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'Dear {contact_name}, We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible. {business_name}', NULL, 'New Order, from {business_name}', NULL, NULL, 0, 0, 0, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(16, 2, 'payment_paid', '<p>Dear {contact_name},</p>\n\n                    <p>We have paid amount {paid_amount} again invoice number {order_ref_number}.<br />\n                    Kindly note it down.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have paid amount {paid_amount} again invoice number {order_ref_number}.\n                    Kindly note it down. {business_name}', NULL, 'Payment Paid, from {business_name}', NULL, NULL, 0, 0, 0, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(17, 2, 'items_received', '<p>Dear {contact_name},</p>\n\n                    <p>We have received all items from invoice reference number {order_ref_number}. Thank you for processing it.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have received all items from invoice reference number {order_ref_number}. Thank you for processing it. {business_name}', NULL, 'Items received, from {business_name}', NULL, NULL, 0, 0, 0, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(18, 2, 'items_pending', '<p>Dear {contact_name},<br />\n                    This is to remind you that we have not yet received some items from invoice reference number {order_ref_number}. Please process it as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'This is to remind you that we have not yet received some items from invoice reference number {order_ref_number} . Please process it as soon as possible.{business_name}', NULL, 'Items Pending, from {business_name}', NULL, NULL, 0, 0, 0, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(19, 2, 'new_quotation', '<p>Dear {contact_name},</p>\n\n                    <p>Your quotation number is {invoice_number}<br />\n                    Total amount: {total_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(20, 2, 'purchase_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new purchase order with reference number {order_ref_number}. The respective invoice is attached here with.</p>\n\n                    <p>{business_logo}</p>', 'We have a new purchase order with reference number {order_ref_number}. {business_name}', NULL, 'New Purchase Order, from {business_name}', NULL, NULL, 0, 0, 0, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(21, 3, 'new_sale', '<p>Dear {contact_name},</p>\n\n                    <p>Your invoice number is {invoice_number}<br />\n                    Total amount: {total_amount}<br />\n                    Paid amount: {received_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2026-03-24 18:17:02', '2026-03-24 18:17:02'),
(22, 3, 'payment_received', '<p>Dear {contact_name},</p>\n\n                <p>We have received a payment of {received_amount}</p>\n\n                <p>{business_logo}</p>', 'Dear {contact_name}, We have received a payment of {received_amount}. {business_name}', NULL, 'Payment Received, from {business_name}', NULL, NULL, 0, 0, 0, '2026-03-24 18:17:02', '2026-03-24 18:17:02'),
(23, 3, 'payment_reminder', '<p>Dear {contact_name},</p>\n\n                    <p>This is to remind you that you have pending payment of {due_amount}. Kindly pay it as soon as possible.</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, You have pending payment of {due_amount}. Kindly pay it as soon as possible. {business_name}', NULL, 'Payment Reminder, from {business_name}', NULL, NULL, 0, 0, 0, '2026-03-24 18:17:02', '2026-03-24 18:17:02'),
(24, 3, 'new_booking', '<p>Dear {contact_name},</p>\n\n                    <p>Your booking is confirmed</p>\n\n                    <p>Date: {start_time} to {end_time}</p>\n\n                    <p>Table: {table}</p>\n\n                    <p>Location: {location}</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, Your booking is confirmed. Date: {start_time} to {end_time}, Table: {table}, Location: {location}', NULL, 'Booking Confirmed - {business_name}', NULL, NULL, 0, 0, 0, '2026-03-24 18:17:02', '2026-03-24 18:17:02'),
(25, 3, 'new_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'Dear {contact_name}, We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible. {business_name}', NULL, 'New Order, from {business_name}', NULL, NULL, 0, 0, 0, '2026-03-24 18:17:02', '2026-03-24 18:17:02'),
(26, 3, 'payment_paid', '<p>Dear {contact_name},</p>\n\n                    <p>We have paid amount {paid_amount} again invoice number {order_ref_number}.<br />\n                    Kindly note it down.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have paid amount {paid_amount} again invoice number {order_ref_number}.\n                    Kindly note it down. {business_name}', NULL, 'Payment Paid, from {business_name}', NULL, NULL, 0, 0, 0, '2026-03-24 18:17:02', '2026-03-24 18:17:02'),
(27, 3, 'items_received', '<p>Dear {contact_name},</p>\n\n                    <p>We have received all items from invoice reference number {order_ref_number}. Thank you for processing it.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have received all items from invoice reference number {order_ref_number}. Thank you for processing it. {business_name}', NULL, 'Items received, from {business_name}', NULL, NULL, 0, 0, 0, '2026-03-24 18:17:02', '2026-03-24 18:17:02'),
(28, 3, 'items_pending', '<p>Dear {contact_name},<br />\n                    This is to remind you that we have not yet received some items from invoice reference number {order_ref_number}. Please process it as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'This is to remind you that we have not yet received some items from invoice reference number {order_ref_number} . Please process it as soon as possible.{business_name}', NULL, 'Items Pending, from {business_name}', NULL, NULL, 0, 0, 0, '2026-03-24 18:17:02', '2026-03-24 18:17:02'),
(29, 3, 'new_quotation', '<p>Dear {contact_name},</p>\n\n                    <p>Your quotation number is {invoice_number}<br />\n                    Total amount: {total_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2026-03-24 18:17:02', '2026-03-24 18:17:02'),
(30, 3, 'purchase_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new purchase order with reference number {order_ref_number}. The respective invoice is attached here with.</p>\n\n                    <p>{business_logo}</p>', 'We have a new purchase order with reference number {order_ref_number}. {business_name}', NULL, 'New Purchase Order, from {business_name}', NULL, NULL, 0, 0, 0, '2026-03-24 18:17:02', '2026-03-24 18:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `secret` varchar(100) NOT NULL,
  `provider` varchar(191) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `location_count` int(11) NOT NULL COMMENT 'No. of Business Locations, 0 = infinite option.',
  `user_count` int(11) NOT NULL,
  `product_count` int(11) NOT NULL,
  `bookings` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Enable/Disable bookings',
  `kitchen` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Enable/Disable kitchen',
  `order_screen` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Enable/Disable order_screen',
  `tables` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Enable/Disable tables',
  `invoice_count` int(11) NOT NULL,
  `interval` enum('days','months','years') NOT NULL,
  `interval_count` int(11) NOT NULL,
  `cloths_count` int(11) DEFAULT NULL,
  `orders_count` int(11) DEFAULT NULL,
  `trial_days` int(11) NOT NULL,
  `price` decimal(22,4) NOT NULL,
  `custom_permissions` longtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL,
  `mark_package_as_popular` tinyint(1) NOT NULL,
  `businesses` longtext DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `is_one_time` tinyint(1) NOT NULL DEFAULT 0,
  `enable_custom_link` tinyint(1) NOT NULL DEFAULT 0,
  `custom_link` varchar(191) DEFAULT NULL,
  `custom_link_text` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `location_count`, `user_count`, `product_count`, `bookings`, `kitchen`, `order_screen`, `tables`, `invoice_count`, `interval`, `interval_count`, `cloths_count`, `orders_count`, `trial_days`, `price`, `custom_permissions`, `created_by`, `sort_order`, `is_active`, `mark_package_as_popular`, `businesses`, `is_private`, `is_one_time`, `enable_custom_link`, `custom_link`, `custom_link_text`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Free', 'Free for lifetime', 1, 1, 50, 0, 0, 0, 0, 500, 'months', 1, NULL, NULL, 0, 0.0000, '', 1, 1, 1, 0, NULL, 0, 0, 0, '', '', '2024-03-22 10:18:47', '2024-03-22 10:09:32', '2024-03-22 10:18:47'),
(2, 'Small Entrepreneur', 'Such as Grocery Shop, Small Pharmacy', 0, 5, 300, 0, 0, 0, 0, 0, 'years', 1, NULL, NULL, 0, 299.0000, '', 1, 2, 1, 0, NULL, 0, 0, 0, '', '', NULL, '2024-03-22 10:15:28', '2025-08-07 06:09:14'),
(3, 'Free', 'Free for lifetime', 1, 1, 50, 0, 0, 0, 0, 500, 'years', 1, NULL, NULL, 0, 0.0000, '', 1, 1, 1, 0, NULL, 0, 0, 0, '', '', NULL, '2024-03-22 10:18:35', '2024-03-22 10:18:59'),
(4, 'New', 'asasas', 0, 0, 2, 0, 0, 0, 0, 2, 'years', 1, 2, 2, 0, 0.0000, '', 1, 1, 1, 0, NULL, 0, 0, 0, '', '', NULL, '2026-03-24 17:31:29', '2026-03-24 18:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'profit_loss_report.view', 'web', '2024-03-22 09:42:38', NULL),
(2, 'direct_sell.access', 'web', '2024-03-22 09:42:38', NULL),
(3, 'product.opening_stock', 'web', '2024-03-22 09:42:39', '2024-03-22 09:42:39'),
(4, 'crud_all_bookings', 'web', '2024-03-22 09:42:39', '2024-03-22 09:42:39'),
(5, 'crud_own_bookings', 'web', '2024-03-22 09:42:39', '2024-03-22 09:42:39'),
(6, 'access_default_selling_price', 'web', '2024-03-22 09:42:40', '2024-03-22 09:42:40'),
(7, 'purchase.payments', 'web', '2024-03-22 09:42:40', '2024-03-22 09:42:40'),
(8, 'sell.payments', 'web', '2024-03-22 09:42:40', '2024-03-22 09:42:40'),
(9, 'edit_product_price_from_sale_screen', 'web', '2024-03-22 09:42:40', '2024-03-22 09:42:40'),
(10, 'edit_product_discount_from_sale_screen', 'web', '2024-03-22 09:42:40', '2024-03-22 09:42:40'),
(11, 'roles.view', 'web', '2024-03-22 09:42:40', '2024-03-22 09:42:40'),
(12, 'roles.create', 'web', '2024-03-22 09:42:40', '2024-03-22 09:42:40'),
(13, 'roles.update', 'web', '2024-03-22 09:42:40', '2024-03-22 09:42:40'),
(14, 'roles.delete', 'web', '2024-03-22 09:42:40', '2024-03-22 09:42:40'),
(15, 'account.access', 'web', '2024-03-22 09:42:40', '2024-03-22 09:42:40'),
(16, 'discount.access', 'web', '2024-03-22 09:42:40', '2024-03-22 09:42:40'),
(17, 'view_purchase_price', 'web', '2024-03-22 09:42:41', '2024-03-22 09:42:41'),
(18, 'view_own_sell_only', 'web', '2024-03-22 09:42:41', '2024-03-22 09:42:41'),
(19, 'edit_product_discount_from_pos_screen', 'web', '2024-03-22 09:42:41', '2024-03-22 09:42:41'),
(20, 'edit_product_price_from_pos_screen', 'web', '2024-03-22 09:42:41', '2024-03-22 09:42:41'),
(21, 'access_shipping', 'web', '2024-03-22 09:42:41', '2024-03-22 09:42:41'),
(22, 'purchase.update_status', 'web', '2024-03-22 09:42:41', '2024-03-22 09:42:41'),
(23, 'list_drafts', 'web', '2024-03-22 09:42:42', '2024-03-22 09:42:42'),
(24, 'list_quotations', 'web', '2024-03-22 09:42:42', '2024-03-22 09:42:42'),
(25, 'view_cash_register', 'web', '2024-03-22 09:42:42', '2024-03-22 09:42:42'),
(26, 'close_cash_register', 'web', '2024-03-22 09:42:42', '2024-03-22 09:42:42'),
(27, 'print_invoice', 'web', '2024-03-22 09:42:43', '2024-03-22 09:42:43'),
(28, 'user.view', 'web', '2024-03-22 09:42:45', NULL),
(29, 'user.create', 'web', '2024-03-22 09:42:45', NULL),
(30, 'user.update', 'web', '2024-03-22 09:42:45', NULL),
(31, 'user.delete', 'web', '2024-03-22 09:42:45', NULL),
(32, 'supplier.view', 'web', '2024-03-22 09:42:45', NULL),
(33, 'supplier.create', 'web', '2024-03-22 09:42:45', NULL),
(34, 'supplier.update', 'web', '2024-03-22 09:42:45', NULL),
(35, 'supplier.delete', 'web', '2024-03-22 09:42:45', NULL),
(36, 'customer.view', 'web', '2024-03-22 09:42:45', NULL),
(37, 'customer.create', 'web', '2024-03-22 09:42:45', NULL),
(38, 'customer.update', 'web', '2024-03-22 09:42:45', NULL),
(39, 'customer.delete', 'web', '2024-03-22 09:42:45', NULL),
(40, 'product.view', 'web', '2024-03-22 09:42:45', NULL),
(41, 'product.create', 'web', '2024-03-22 09:42:45', NULL),
(42, 'product.update', 'web', '2024-03-22 09:42:45', NULL),
(43, 'product.delete', 'web', '2024-03-22 09:42:45', NULL),
(44, 'purchase.view', 'web', '2024-03-22 09:42:45', NULL),
(45, 'purchase.create', 'web', '2024-03-22 09:42:45', NULL),
(46, 'purchase.update', 'web', '2024-03-22 09:42:45', NULL),
(47, 'purchase.delete', 'web', '2024-03-22 09:42:45', NULL),
(48, 'sell.view', 'web', '2024-03-22 09:42:45', NULL),
(49, 'sell.create', 'web', '2024-03-22 09:42:45', NULL),
(50, 'sell.update', 'web', '2024-03-22 09:42:45', NULL),
(51, 'sell.delete', 'web', '2024-03-22 09:42:45', NULL),
(52, 'purchase_n_sell_report.view', 'web', '2024-03-22 09:42:45', NULL),
(53, 'contacts_report.view', 'web', '2024-03-22 09:42:45', NULL),
(54, 'stock_report.view', 'web', '2024-03-22 09:42:45', NULL),
(55, 'tax_report.view', 'web', '2024-03-22 09:42:45', NULL),
(56, 'trending_product_report.view', 'web', '2024-03-22 09:42:45', NULL),
(57, 'register_report.view', 'web', '2024-03-22 09:42:45', NULL),
(58, 'sales_representative.view', 'web', '2024-03-22 09:42:45', NULL),
(59, 'expense_report.view', 'web', '2024-03-22 09:42:45', NULL),
(60, 'business_settings.access', 'web', '2024-03-22 09:42:45', NULL),
(61, 'barcode_settings.access', 'web', '2024-03-22 09:42:45', NULL),
(62, 'invoice_settings.access', 'web', '2024-03-22 09:42:45', NULL),
(63, 'brand.view', 'web', '2024-03-22 09:42:45', NULL),
(64, 'brand.create', 'web', '2024-03-22 09:42:45', NULL),
(65, 'brand.update', 'web', '2024-03-22 09:42:45', NULL),
(66, 'brand.delete', 'web', '2024-03-22 09:42:45', NULL),
(67, 'tax_rate.view', 'web', '2024-03-22 09:42:45', NULL),
(68, 'tax_rate.create', 'web', '2024-03-22 09:42:45', NULL),
(69, 'tax_rate.update', 'web', '2024-03-22 09:42:45', NULL),
(70, 'tax_rate.delete', 'web', '2024-03-22 09:42:45', NULL),
(71, 'unit.view', 'web', '2024-03-22 09:42:45', NULL),
(72, 'unit.create', 'web', '2024-03-22 09:42:45', NULL),
(73, 'unit.update', 'web', '2024-03-22 09:42:45', NULL),
(74, 'unit.delete', 'web', '2024-03-22 09:42:45', NULL),
(75, 'category.view', 'web', '2024-03-22 09:42:45', NULL),
(76, 'category.create', 'web', '2024-03-22 09:42:45', NULL),
(77, 'category.update', 'web', '2024-03-22 09:42:45', NULL),
(78, 'category.delete', 'web', '2024-03-22 09:42:45', NULL),
(79, 'expense.access', 'web', '2024-03-22 09:42:45', NULL),
(80, 'access_all_locations', 'web', '2024-03-22 09:42:45', NULL),
(81, 'dashboard.data', 'web', '2024-03-22 09:42:45', NULL),
(82, 'location.1', 'web', '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(83, 'location.2', 'web', '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(84, 'woocommerce.syc_categories', 'web', '2025-07-02 05:03:23', '2025-07-02 05:03:23'),
(85, 'woocommerce.sync_products', 'web', '2025-07-02 05:03:23', '2025-07-02 05:03:23'),
(86, 'woocommerce.sync_orders', 'web', '2025-07-02 05:03:23', '2025-07-02 05:03:23'),
(87, 'woocommerce.map_tax_rates', 'web', '2025-07-02 05:03:23', '2025-07-02 05:03:23'),
(88, 'woocommerce.access_woocommerce_api_settings', 'web', '2025-07-02 05:03:23', '2025-07-02 05:03:23'),
(89, 'location.3', 'web', '2025-08-07 09:22:47', '2025-08-07 09:22:47'),
(90, 'location.4', 'web', '2026-03-24 18:17:02', '2026-03-24 18:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `printers`
--

CREATE TABLE `printers` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `connection_type` enum('network','windows','linux') NOT NULL,
  `capability_profile` enum('default','simple','SP2000','TEP-200M','P822D') NOT NULL DEFAULT 'default',
  `char_per_line` varchar(191) DEFAULT NULL,
  `ip_address` varchar(191) DEFAULT NULL,
  `port` varchar(191) DEFAULT NULL,
  `path` varchar(191) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `type` enum('single','variable','modifier','combo') DEFAULT NULL,
  `unit_id` int(11) UNSIGNED DEFAULT NULL,
  `secondary_unit_id` int(11) DEFAULT NULL,
  `sub_unit_ids` text DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `sub_category_id` int(10) UNSIGNED DEFAULT NULL,
  `tax` int(10) UNSIGNED DEFAULT NULL,
  `tax_type` enum('inclusive','exclusive') NOT NULL,
  `enable_stock` tinyint(1) NOT NULL DEFAULT 0,
  `alert_quantity` decimal(22,4) DEFAULT NULL,
  `sku` varchar(191) NOT NULL,
  `barcode_type` enum('C39','C128','EAN13','EAN8','UPCA','UPCE') DEFAULT 'C128',
  `expiry_period` decimal(4,2) DEFAULT NULL,
  `expiry_period_type` enum('days','months') DEFAULT NULL,
  `enable_sr_no` tinyint(1) NOT NULL DEFAULT 0,
  `weight` varchar(191) DEFAULT NULL,
  `product_custom_field1` varchar(191) DEFAULT NULL,
  `product_custom_field2` varchar(191) DEFAULT NULL,
  `product_custom_field3` varchar(191) DEFAULT NULL,
  `product_custom_field4` varchar(191) DEFAULT NULL,
  `product_custom_field5` varchar(191) DEFAULT NULL,
  `product_custom_field6` varchar(191) DEFAULT NULL,
  `product_custom_field7` varchar(191) DEFAULT NULL,
  `product_custom_field8` varchar(191) DEFAULT NULL,
  `product_custom_field9` varchar(191) DEFAULT NULL,
  `product_custom_field10` varchar(191) DEFAULT NULL,
  `product_custom_field11` varchar(191) DEFAULT NULL,
  `product_custom_field12` varchar(191) DEFAULT NULL,
  `product_custom_field13` varchar(191) DEFAULT NULL,
  `product_custom_field14` varchar(191) DEFAULT NULL,
  `product_custom_field15` varchar(191) DEFAULT NULL,
  `product_custom_field16` varchar(191) DEFAULT NULL,
  `product_custom_field17` varchar(191) DEFAULT NULL,
  `product_custom_field18` varchar(191) DEFAULT NULL,
  `product_custom_field19` varchar(191) DEFAULT NULL,
  `product_custom_field20` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `woocommerce_media_id` int(11) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `woocommerce_product_id` int(11) DEFAULT NULL,
  `woocommerce_disable_sync` tinyint(1) NOT NULL DEFAULT 0,
  `preparation_time_in_minutes` int(11) DEFAULT NULL,
  `warranty_id` int(11) DEFAULT NULL,
  `is_inactive` tinyint(1) NOT NULL DEFAULT 0,
  `not_for_selling` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `business_id`, `type`, `unit_id`, `secondary_unit_id`, `sub_unit_ids`, `brand_id`, `category_id`, `sub_category_id`, `tax`, `tax_type`, `enable_stock`, `alert_quantity`, `sku`, `barcode_type`, `expiry_period`, `expiry_period_type`, `enable_sr_no`, `weight`, `product_custom_field1`, `product_custom_field2`, `product_custom_field3`, `product_custom_field4`, `product_custom_field5`, `product_custom_field6`, `product_custom_field7`, `product_custom_field8`, `product_custom_field9`, `product_custom_field10`, `product_custom_field11`, `product_custom_field12`, `product_custom_field13`, `product_custom_field14`, `product_custom_field15`, `product_custom_field16`, `product_custom_field17`, `product_custom_field18`, `product_custom_field19`, `product_custom_field20`, `image`, `woocommerce_media_id`, `product_description`, `created_by`, `woocommerce_product_id`, `woocommerce_disable_sync`, `preparation_time_in_minutes`, `warranty_id`, `is_inactive`, `not_for_selling`, `created_at`, `updated_at`) VALUES
(2, 'Product 1', 2, 'single', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'exclusive', 0, 0.0000, '101', 'C128', NULL, NULL, 0, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1752837134_rewards4.png', NULL, NULL, 2, NULL, 0, NULL, NULL, 0, 0, '2025-07-18 11:12:14', '2025-09-14 07:54:17'),
(3, 'Product 2', 2, 'single', 3, NULL, NULL, 2, NULL, NULL, NULL, 'inclusive', 1, 10.0000, '0003', 'C128', NULL, NULL, 0, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1752837529_rewards3.png', NULL, NULL, 2, NULL, 0, NULL, NULL, 0, 0, '2025-07-18 11:18:49', '2025-09-14 07:54:27'),
(4, 'New Product', 2, 'single', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'exclusive', 1, NULL, '0004', 'C128', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, NULL, 0, 0, '2025-07-23 17:18:01', '2025-07-23 17:18:01'),
(5, 'xyz', 2, 'single', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'exclusive', 1, NULL, '0005', 'C128', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, NULL, 0, 0, '2025-07-23 17:29:19', '2025-07-23 17:29:19'),
(6, 'abc', 2, 'single', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'exclusive', 1, NULL, '0006', 'C128', NULL, NULL, 0, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 2, NULL, 0, NULL, NULL, 0, 0, '2025-07-23 17:29:40', '2025-09-14 07:54:07'),
(7, 'Tory 005', 2, 'single', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'exclusive', 1, NULL, '0007', 'C128', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, NULL, 0, 0, '2025-09-14 08:00:14', '2025-09-14 08:00:14'),
(8, 'ABC', 3, 'single', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'exclusive', 0, 0.0000, '0008', 'C128', NULL, NULL, 0, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 5, NULL, 0, NULL, NULL, 0, 0, '2026-03-24 18:47:44', '2026-03-24 18:55:46'),
(9, 'XYZ', 3, 'single', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'exclusive', 1, NULL, '0009', 'C128', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 0, NULL, NULL, 0, 0, '2026-03-24 18:47:54', '2026-03-24 18:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_locations`
--

CREATE TABLE `product_locations` (
  `product_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_locations`
--

INSERT INTO `product_locations` (`product_id`, `location_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(7, 3),
(8, 4),
(9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_racks`
--

CREATE TABLE `product_racks` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `rack` varchar(191) DEFAULT NULL,
  `row` varchar(191) DEFAULT NULL,
  `position` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` int(10) UNSIGNED NOT NULL,
  `variation_template_id` int(11) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `is_dummy` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `variation_template_id`, `name`, `product_id`, `is_dummy`, `created_at`, `updated_at`) VALUES
(2, NULL, 'DUMMY', 2, 1, '2025-07-18 11:12:14', '2025-07-18 11:12:14'),
(3, NULL, 'DUMMY', 3, 1, '2025-07-18 11:18:49', '2025-07-18 11:18:49'),
(4, NULL, 'DUMMY', 4, 1, '2025-07-23 17:18:01', '2025-07-23 17:18:01'),
(5, NULL, 'DUMMY', 5, 1, '2025-07-23 17:29:19', '2025-07-23 17:29:19'),
(6, NULL, 'DUMMY', 6, 1, '2025-07-23 17:29:40', '2025-07-23 17:29:40'),
(7, NULL, 'DUMMY', 7, 1, '2025-09-14 08:00:14', '2025-09-14 08:00:14'),
(8, NULL, 'DUMMY', 8, 1, '2026-03-24 18:47:44', '2026-03-24 18:47:44'),
(9, NULL, 'DUMMY', 9, 1, '2026-03-24 18:47:54', '2026-03-24 18:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_lines`
--

CREATE TABLE `purchase_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variation_id` int(10) UNSIGNED NOT NULL,
  `quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `secondary_unit_quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `pp_without_discount` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'Purchase price before inline discounts',
  `discount_percent` decimal(5,2) NOT NULL DEFAULT 0.00 COMMENT 'Inline discount percentage',
  `purchase_price` decimal(22,4) NOT NULL,
  `purchase_price_inc_tax` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `item_tax` decimal(22,4) NOT NULL COMMENT 'Tax for one quantity',
  `tax_id` int(10) UNSIGNED DEFAULT NULL,
  `purchase_requisition_line_id` int(11) DEFAULT NULL,
  `purchase_order_line_id` int(11) DEFAULT NULL,
  `quantity_sold` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'Quanity sold from this purchase line',
  `quantity_adjusted` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'Quanity adjusted in stock adjustment from this purchase line',
  `quantity_returned` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `po_quantity_purchased` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `mfg_quantity_used` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `mfg_date` date DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `lot_number` varchar(191) DEFAULT NULL,
  `sub_unit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_lines`
--

INSERT INTO `purchase_lines` (`id`, `transaction_id`, `product_id`, `variation_id`, `quantity`, `secondary_unit_quantity`, `pp_without_discount`, `discount_percent`, `purchase_price`, `purchase_price_inc_tax`, `item_tax`, `tax_id`, `purchase_requisition_line_id`, `purchase_order_line_id`, `quantity_sold`, `quantity_adjusted`, `quantity_returned`, `po_quantity_purchased`, `mfg_quantity_used`, `mfg_date`, `exp_date`, `lot_number`, `sub_unit_id`, `created_at`, `updated_at`) VALUES
(3, 33, 2, 2, 100.0000, 0.0000, 100.0000, 0.00, 100.0000, 100.0000, 0.0000, NULL, NULL, NULL, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL, '2025-07-18 11:12:28', '2025-07-18 11:12:28'),
(4, 34, 3, 3, 100.0000, 0.0000, 200.0000, 0.00, 200.0000, 200.0000, 0.0000, NULL, NULL, NULL, 5.0000, 0.0000, 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL, '2025-07-18 11:20:25', '2025-10-09 17:49:17'),
(5, 77, 3, 3, 500.0000, 0.0000, 160.0000, 0.00, 160.0000, 160.0000, 0.0000, NULL, NULL, NULL, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL, '2025-09-14 07:57:19', '2025-09-14 07:57:19'),
(6, 77, 4, 4, 200.0000, 0.0000, 460.0000, 0.00, 460.0000, 460.0000, 0.0000, NULL, NULL, NULL, 2.0000, 0.0000, 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL, '2025-09-14 07:57:19', '2025-10-09 16:06:25'),
(7, 78, 7, 7, 600.0000, 0.0000, 100.0000, 0.00, 100.0000, 100.0000, 0.0000, NULL, NULL, NULL, 5.0000, 0.0000, 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL, '2025-09-14 08:01:36', '2025-09-14 08:03:28'),
(8, 90, 8, 8, 2.0000, 0.0000, 1.0000, 0.00, 1.0000, 1.0000, 0.0000, NULL, NULL, NULL, 2.0000, 0.0000, 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL, '2026-03-24 18:48:35', '2026-03-24 18:54:30'),
(9, 91, 9, 9, 2.0000, 0.0000, 1.0000, 0.00, 1.0000, 1.0000, 0.0000, NULL, NULL, NULL, 2.0000, 0.0000, 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL, '2026-03-24 18:48:43', '2026-03-24 18:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `reference_counts`
--

CREATE TABLE `reference_counts` (
  `id` int(10) UNSIGNED NOT NULL,
  `ref_type` varchar(191) NOT NULL,
  `ref_count` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reference_counts`
--

INSERT INTO `reference_counts` (`id`, `ref_type`, `ref_count`, `business_id`, `created_at`, `updated_at`) VALUES
(1, 'contacts', 1, 1, '2024-03-22 09:48:05', '2024-03-22 09:48:05'),
(2, 'business_location', 1, 1, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(3, 'contacts', 9, 2, '2025-07-02 04:50:18', '2025-09-14 08:21:49'),
(4, 'business_location', 2, 2, '2025-07-02 04:50:18', '2025-08-07 09:22:47'),
(5, 'sell_payment', 54, 2, '2025-07-08 06:47:51', '2025-10-10 00:45:16'),
(6, 'draft', 18, 2, '2025-07-12 05:27:26', '2025-08-05 10:04:55'),
(10, 'purchase_payment', 14, 2, '2025-07-25 10:11:26', '2025-10-09 17:37:56'),
(11, 'purchase', 2, 2, '2025-09-14 07:57:19', '2025-09-14 08:01:36'),
(12, 'contacts', 1, 3, '2026-03-24 18:17:02', '2026-03-24 18:17:02'),
(13, 'business_location', 1, 3, '2026-03-24 18:17:02', '2026-03-24 18:17:02'),
(14, 'sell_payment', 10, 3, '2026-03-24 18:50:09', '2026-03-24 19:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `res_product_modifier_sets`
--

CREATE TABLE `res_product_modifier_sets` (
  `modifier_set_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL COMMENT 'Table use to store the modifier sets applicable for a product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `res_tables`
--

CREATE TABLE `res_tables` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_service_staff` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `business_id`, `is_default`, `is_service_staff`, `created_at`, `updated_at`) VALUES
(1, 'Admin#1', 'web', 1, 1, 0, '2024-03-22 09:48:05', '2024-03-22 09:48:05'),
(2, 'Cashier#1', 'web', 1, 0, 0, '2024-03-22 09:48:05', '2024-03-22 09:48:05'),
(3, 'Admin#2', 'web', 2, 1, 0, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(4, 'Cashier#2', 'web', 2, 0, 0, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(5, 'Admin#3', 'web', 3, 1, 0, '2026-03-24 18:17:02', '2026-03-24 18:17:02'),
(6, 'Cashier#3', 'web', 3, 0, 0, '2026-03-24 18:17:02', '2026-03-24 18:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(25, 2),
(26, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(80, 2),
(25, 4),
(26, 4),
(48, 4),
(49, 4),
(50, 4),
(51, 4),
(25, 6),
(26, 6),
(48, 6),
(49, 6),
(50, 6),
(51, 6),
(80, 6);

-- --------------------------------------------------------

--
-- Table structure for table `selling_price_groups`
--

CREATE TABLE `selling_price_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sell_line_warranties`
--

CREATE TABLE `sell_line_warranties` (
  `sell_line_id` int(11) NOT NULL,
  `warranty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments_temp`
--

CREATE TABLE `stock_adjustments_temp` (
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment_lines`
--

CREATE TABLE `stock_adjustment_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variation_id` int(10) UNSIGNED NOT NULL,
  `quantity` decimal(22,4) NOT NULL,
  `secondary_unit_quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `unit_price` decimal(22,4) DEFAULT NULL COMMENT 'Last purchase unit price',
  `removed_purchase_line` int(11) DEFAULT NULL,
  `lot_no_line_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE `styles` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `style_name` varchar(191) NOT NULL,
  `serial_no` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `business_id`, `style_name`, `serial_no`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(10, 2, 'কলার', 1, 2, NULL, '2025-08-19 06:22:40', '2025-08-26 09:31:27'),
(11, 2, 'প্লেইট', NULL, 2, NULL, '2025-08-26 09:42:42', '2025-08-26 09:42:42'),
(12, 2, 'কাফ', NULL, 2, NULL, '2025-08-26 09:44:58', '2025-08-26 09:44:58'),
(14, 2, 'asc', 1, 2, NULL, '2025-10-13 05:52:19', '2025-10-13 05:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `trial_end_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `package_price` decimal(22,4) NOT NULL,
  `original_price` decimal(22,4) DEFAULT NULL,
  `coupon_code` varchar(191) DEFAULT NULL,
  `package_details` longtext NOT NULL,
  `created_id` int(10) UNSIGNED NOT NULL,
  `paid_via` varchar(191) DEFAULT NULL,
  `payment_transaction_id` varchar(191) DEFAULT NULL,
  `status` enum('approved','waiting','declined') NOT NULL DEFAULT 'waiting',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `business_id`, `package_id`, `start_date`, `trial_end_date`, `end_date`, `package_price`, `original_price`, `coupon_code`, `package_details`, `created_id`, `paid_via`, `payment_transaction_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2025-07-02', '2026-07-02', '2025-08-04', 0.0000, 0.0000, NULL, '{\"location_count\":1,\"user_count\":1,\"product_count\":50,\"invoice_count\":500,\"name\":\"Free\"}', 2, NULL, 'FREE', 'approved', NULL, '2025-07-02 05:08:06', '2025-08-05 11:56:41'),
(2, 2, 2, '2025-08-05', '2026-08-03', '2025-09-05', 299.0000, 299.0000, NULL, '{\"location_count\":\"0\",\"user_count\":\"5\",\"product_count\":\"300\",\"invoice_count\":\"0\",\"name\":\"Small Entrepreneur\"}', 1, 'offline', NULL, 'approved', NULL, '2025-08-05 11:56:26', '2025-08-07 06:09:14'),
(3, 2, 2, '2025-09-14', '2026-09-14', '2026-03-23', 299.0000, 299.0000, NULL, '{\"location_count\":0,\"user_count\":5,\"product_count\":300,\"invoice_count\":0,\"name\":\"Small Entrepreneur\"}', 1, 'offline', NULL, 'approved', NULL, '2025-09-14 07:24:44', '2026-03-24 17:33:43'),
(4, 2, 2, '2026-09-15', '2027-09-15', '2027-09-15', 299.0000, 299.0000, NULL, '{\"location_count\":0,\"user_count\":5,\"product_count\":300,\"invoice_count\":0,\"name\":\"Small Entrepreneur\"}', 1, 'offline', NULL, 'approved', NULL, '2025-10-09 17:29:02', '2025-10-09 17:29:02'),
(5, 1, 2, '2025-10-09', '2026-10-09', '2026-10-09', 299.0000, 299.0000, NULL, '{\"location_count\":0,\"user_count\":5,\"product_count\":300,\"invoice_count\":0,\"name\":\"Small Entrepreneur\"}', 1, 'offline', NULL, 'approved', NULL, '2025-10-09 17:29:40', '2025-10-09 17:29:40'),
(6, 2, 4, '2026-03-24', '2028-09-16', '2027-03-24', 0.0000, 0.0000, NULL, '{\"location_count\":0,\"user_count\":0,\"product_count\":2,\"invoice_count\":2,\"cloths_count\":2,\"orders_count\":2,\"name\":\"New\"}', 1, 'offline', NULL, 'approved', NULL, '2026-03-24 17:31:43', '2026-03-24 17:33:43'),
(7, 3, 4, '2026-03-25', '2027-03-25', '2027-03-25', 0.0000, 0.0000, NULL, '{\"location_count\":0,\"user_count\":0,\"product_count\":2,\"invoice_count\":0,\"cloths_count\":2,\"orders_count\":2,\"name\":\"New\"}', 1, 'offline', NULL, 'approved', NULL, '2026-03-24 18:17:02', '2026-03-24 18:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `sub_measurements`
--

CREATE TABLE `sub_measurements` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `sub_measurement_name` varchar(191) NOT NULL,
  `serial_no` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_measurements`
--

INSERT INTO `sub_measurements` (`id`, `business_id`, `sub_measurement_name`, `serial_no`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(12, 2, 'প্লেট ফাড়া', NULL, 2, NULL, '2025-08-26 05:24:15', '2025-08-26 05:24:15'),
(13, 2, 'বডির লুজ', NULL, 2, NULL, '2025-08-26 05:24:45', '2025-08-26 05:24:45'),
(14, 2, 'পেট এর লুজ', NULL, 2, NULL, '2025-08-26 05:24:53', '2025-08-26 05:24:53'),
(15, 2, 'নিচের ঘের', NULL, 2, NULL, '2025-08-26 05:24:59', '2025-08-26 05:24:59'),
(16, 2, 'পেট', NULL, 2, NULL, '2025-08-26 05:25:07', '2025-08-26 05:25:07'),
(17, 2, 'পকেট চাকান', NULL, 2, NULL, '2025-08-26 05:25:20', '2025-08-26 05:25:20'),
(18, 2, 'পুট', NULL, 2, NULL, '2025-08-26 05:26:53', '2025-08-26 05:26:53'),
(20, 2, 'মোরা', NULL, 2, NULL, '2025-08-26 05:27:29', '2025-08-26 05:27:29'),
(21, 2, 'মাদানি', NULL, 2, NULL, '2025-08-26 05:27:49', '2025-08-26 05:27:49'),
(22, 2, 'বডি', NULL, 2, NULL, '2025-08-26 05:28:04', '2025-08-26 05:28:04'),
(23, 2, 'মুহুরী', NULL, 2, NULL, '2025-08-26 07:44:13', '2025-08-26 07:44:13'),
(26, 2, 'কোমর', NULL, 2, NULL, '2025-08-26 07:44:48', '2025-08-26 07:44:48'),
(28, 2, 'ফিতা', NULL, 2, NULL, '2025-08-26 07:45:00', '2025-08-26 07:45:00'),
(29, 2, 'কল্লি', NULL, 2, NULL, '2025-08-26 07:56:52', '2025-08-26 07:56:52'),
(30, 2, 'হিপ', NULL, 2, NULL, '2025-08-26 09:05:58', '2025-08-26 09:05:58'),
(31, 2, 'Test', NULL, 2, NULL, '2025-10-10 00:03:51', '2025-10-10 00:03:51'),
(32, 2, 'ascac', NULL, 2, NULL, '2025-10-13 05:52:08', '2025-10-13 05:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin_communicator_logs`
--

CREATE TABLE `superadmin_communicator_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_ids` text DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin_coupons`
--

CREATE TABLE `superadmin_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(191) NOT NULL,
  `discount_type` varchar(191) NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `applied_on_packages` varchar(191) DEFAULT NULL,
  `applied_on_business` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin_frontend_pages`
--

CREATE TABLE `superadmin_frontend_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `content` longtext NOT NULL,
  `is_shown` tinyint(1) NOT NULL,
  `menu_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `key`, `value`) VALUES
(1, 'db_version', '5.40'),
(2, 'default_business_active_status', '1'),
(3, 'superadmin_version', '5.0'),
(4, 'app_currency_id', '2'),
(5, 'invoice_business_name', 'Microwebs POS'),
(6, 'invoice_business_landmark', 'Landmark'),
(7, 'invoice_business_zip', 'Zip'),
(8, 'invoice_business_state', 'State'),
(9, 'invoice_business_city', 'City'),
(10, 'invoice_business_country', 'Country'),
(11, 'email', 'superadmin@example.com'),
(12, 'package_expiry_alert_days', '5'),
(13, 'enable_business_based_username', '0'),
(14, 'woocommerce_version', '4.1'),
(15, 'superadmin_register_tc', NULL),
(16, 'welcome_email_subject', NULL),
(17, 'welcome_email_body', NULL),
(18, 'additional_js', NULL),
(19, 'additional_css', NULL),
(20, 'offline_payment_details', NULL),
(21, 'superadmin_enable_register_tc', '0'),
(22, 'allow_email_settings_to_businesses', '0'),
(23, 'enable_new_business_registration_notification', '0'),
(24, 'enable_new_subscription_notification', '0'),
(25, 'enable_welcome_email', '0'),
(26, 'enable_offline_payment', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tax_rates`
--

CREATE TABLE `tax_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `amount` double(22,4) NOT NULL,
  `is_tax_group` tinyint(1) NOT NULL DEFAULT 0,
  `for_tax_group` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(10) UNSIGNED NOT NULL,
  `woocommerce_tax_rate_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED DEFAULT NULL,
  `is_kitchen_order` tinyint(1) NOT NULL DEFAULT 0,
  `res_table_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'fields to restaurant module',
  `res_waiter_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'fields to restaurant module',
  `res_order_status` enum('received','cooked','served') DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `sub_type` varchar(20) DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `delivery_status` varchar(191) DEFAULT NULL,
  `sub_status` varchar(191) DEFAULT NULL,
  `is_quotation` tinyint(1) NOT NULL DEFAULT 0,
  `payment_status` enum('paid','due','partial') DEFAULT NULL,
  `adjustment_type` enum('normal','abnormal') DEFAULT NULL,
  `contact_id` int(11) UNSIGNED DEFAULT NULL,
  `customer_group_id` int(11) DEFAULT NULL COMMENT 'used to add customer group while selling',
  `invoice_no` varchar(191) DEFAULT NULL,
  `ref_no` varchar(191) DEFAULT NULL,
  `source` varchar(191) DEFAULT NULL,
  `subscription_no` varchar(191) DEFAULT NULL,
  `subscription_repeat_on` varchar(191) DEFAULT NULL,
  `transaction_date` datetime NOT NULL,
  `total_before_tax` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'Total before the purchase/invoice tax, this includeds the indivisual product tax',
  `tax_id` int(10) UNSIGNED DEFAULT NULL,
  `tax_amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `discount_type` enum('fixed','percentage') DEFAULT NULL,
  `discount_amount` decimal(22,4) DEFAULT 0.0000,
  `rp_redeemed` int(11) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `rp_redeemed_amount` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'rp is the short form of reward points',
  `shipping_details` varchar(191) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `shipping_status` varchar(191) DEFAULT NULL,
  `delivered_to` varchar(191) DEFAULT NULL,
  `delivery_person` bigint(20) DEFAULT NULL,
  `shipping_charges` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `shipping_custom_field_1` varchar(191) DEFAULT NULL,
  `shipping_custom_field_2` varchar(191) DEFAULT NULL,
  `shipping_custom_field_3` varchar(191) DEFAULT NULL,
  `shipping_custom_field_4` varchar(191) DEFAULT NULL,
  `shipping_custom_field_5` varchar(191) DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `staff_note` text DEFAULT NULL,
  `is_export` tinyint(1) NOT NULL DEFAULT 0,
  `export_custom_fields_info` longtext DEFAULT NULL,
  `round_off_amount` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'Difference of rounded total and actual total',
  `additional_expense_key_1` varchar(191) DEFAULT NULL,
  `additional_expense_value_1` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `additional_expense_key_2` varchar(191) DEFAULT NULL,
  `additional_expense_value_2` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `additional_expense_key_3` varchar(191) DEFAULT NULL,
  `additional_expense_value_3` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `additional_expense_key_4` varchar(191) DEFAULT NULL,
  `additional_expense_value_4` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `final_total` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `expense_category_id` int(10) UNSIGNED DEFAULT NULL,
  `expense_sub_category_id` int(11) DEFAULT NULL,
  `expense_for` int(10) UNSIGNED DEFAULT NULL,
  `commission_agent` int(11) DEFAULT NULL,
  `document` varchar(191) DEFAULT NULL,
  `is_direct_sale` tinyint(1) NOT NULL DEFAULT 0,
  `is_suspend` tinyint(1) NOT NULL DEFAULT 0,
  `exchange_rate` decimal(20,3) NOT NULL DEFAULT 1.000,
  `total_amount_recovered` decimal(22,4) DEFAULT NULL COMMENT 'Used for stock adjustment.',
  `transfer_parent_id` int(11) DEFAULT NULL,
  `return_parent_id` int(11) DEFAULT NULL,
  `opening_stock_product_id` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `woocommerce_order_id` int(11) DEFAULT NULL,
  `purchase_requisition_ids` text DEFAULT NULL,
  `prefer_payment_method` varchar(191) DEFAULT NULL,
  `prefer_payment_account` int(11) DEFAULT NULL,
  `sales_order_ids` text DEFAULT NULL,
  `purchase_order_ids` text DEFAULT NULL,
  `custom_field_1` varchar(191) DEFAULT NULL,
  `custom_field_2` varchar(191) DEFAULT NULL,
  `custom_field_3` varchar(191) DEFAULT NULL,
  `custom_field_4` varchar(191) DEFAULT NULL,
  `import_batch` int(11) DEFAULT NULL,
  `import_time` datetime DEFAULT NULL,
  `types_of_service_id` int(11) DEFAULT NULL,
  `packing_charge` decimal(22,4) DEFAULT NULL,
  `packing_charge_type` enum('fixed','percent') DEFAULT NULL,
  `service_custom_field_1` text DEFAULT NULL,
  `service_custom_field_2` text DEFAULT NULL,
  `service_custom_field_3` text DEFAULT NULL,
  `service_custom_field_4` text DEFAULT NULL,
  `service_custom_field_5` text DEFAULT NULL,
  `service_custom_field_6` text DEFAULT NULL,
  `is_created_from_api` tinyint(1) NOT NULL DEFAULT 0,
  `rp_earned` int(11) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `order_addresses` text DEFAULT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT 0,
  `recur_interval` double(22,4) DEFAULT NULL,
  `recur_interval_type` enum('days','months','years') DEFAULT NULL,
  `recur_repetitions` int(11) DEFAULT NULL,
  `recur_stopped_on` datetime DEFAULT NULL,
  `recur_parent_id` int(11) DEFAULT NULL,
  `invoice_token` varchar(191) DEFAULT NULL,
  `pay_term_number` int(11) DEFAULT NULL,
  `pay_term_type` enum('days','months') DEFAULT NULL,
  `selling_price_group_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `business_id`, `location_id`, `is_kitchen_order`, `res_table_id`, `res_waiter_id`, `res_order_status`, `type`, `sub_type`, `status`, `delivery_status`, `sub_status`, `is_quotation`, `payment_status`, `adjustment_type`, `contact_id`, `customer_group_id`, `invoice_no`, `ref_no`, `source`, `subscription_no`, `subscription_repeat_on`, `transaction_date`, `total_before_tax`, `tax_id`, `tax_amount`, `discount_type`, `discount_amount`, `rp_redeemed`, `rp_redeemed_amount`, `shipping_details`, `shipping_address`, `delivery_date`, `shipping_status`, `delivered_to`, `delivery_person`, `shipping_charges`, `shipping_custom_field_1`, `shipping_custom_field_2`, `shipping_custom_field_3`, `shipping_custom_field_4`, `shipping_custom_field_5`, `additional_notes`, `staff_note`, `is_export`, `export_custom_fields_info`, `round_off_amount`, `additional_expense_key_1`, `additional_expense_value_1`, `additional_expense_key_2`, `additional_expense_value_2`, `additional_expense_key_3`, `additional_expense_value_3`, `additional_expense_key_4`, `additional_expense_value_4`, `final_total`, `expense_category_id`, `expense_sub_category_id`, `expense_for`, `commission_agent`, `document`, `is_direct_sale`, `is_suspend`, `exchange_rate`, `total_amount_recovered`, `transfer_parent_id`, `return_parent_id`, `opening_stock_product_id`, `created_by`, `woocommerce_order_id`, `purchase_requisition_ids`, `prefer_payment_method`, `prefer_payment_account`, `sales_order_ids`, `purchase_order_ids`, `custom_field_1`, `custom_field_2`, `custom_field_3`, `custom_field_4`, `import_batch`, `import_time`, `types_of_service_id`, `packing_charge`, `packing_charge_type`, `service_custom_field_1`, `service_custom_field_2`, `service_custom_field_3`, `service_custom_field_4`, `service_custom_field_5`, `service_custom_field_6`, `is_created_from_api`, `rp_earned`, `order_addresses`, `is_recurring`, `recur_interval`, `recur_interval_type`, `recur_repetitions`, `recur_stopped_on`, `recur_parent_id`, `invoice_token`, `pay_term_number`, `pay_term_type`, `selling_price_group_id`, `created_at`, `updated_at`) VALUES
(33, 2, 2, 0, NULL, NULL, NULL, 'opening_stock', NULL, 'received', NULL, NULL, 0, 'paid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-01 16:42:28', 100.0000, NULL, 0.0000, NULL, 0.0000, 0, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 10000.0000, NULL, NULL, NULL, NULL, NULL, 0, 0, 1.000, NULL, NULL, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-18 11:12:28', '2025-07-18 11:12:28'),
(34, 2, 2, 0, NULL, NULL, NULL, 'opening_stock', NULL, 'received', NULL, NULL, 0, 'paid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-01 16:50:25', 200.0000, NULL, 0.0000, NULL, 0.0000, 0, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 20000.0000, NULL, NULL, NULL, NULL, NULL, 0, 0, 1.000, NULL, NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-18 11:20:25', '2025-07-18 11:20:25'),
(58, 2, 2, 0, NULL, NULL, NULL, 'order', NULL, 'draft', NULL, 'quotation', 1, 'due', NULL, 2, NULL, '2025/0012', '', NULL, NULL, NULL, '2025-07-28 16:47:00', 1500.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2025-07-28 16:47:00', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 1500.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-28 10:47:55', '2025-07-28 11:51:00'),
(59, 2, 2, 0, NULL, NULL, NULL, 'order', NULL, 'draft', NULL, NULL, 0, NULL, NULL, 4, NULL, '2025/0014', '', NULL, NULL, NULL, '2025-07-29 22:50:00', 445.0000, NULL, 0.0000, 'fixed', 45.0000, 0, 0.0000, NULL, NULL, '2025-08-02 22:50:00', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 400.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-29 16:53:01', '2025-07-29 16:53:01'),
(61, 2, 2, 0, NULL, NULL, NULL, 'order', NULL, 'draft', NULL, 'quotation', 1, NULL, NULL, 2, NULL, '2025/0016', '', NULL, NULL, NULL, '2025-07-29 22:57:00', 100.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2025-07-29 22:57:00', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 100.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-29 16:57:32', '2025-07-29 16:57:32'),
(65, 2, 2, 0, NULL, NULL, NULL, 'sell', NULL, 'draft', NULL, NULL, 0, NULL, NULL, 2, NULL, '2025/0018', '', NULL, NULL, NULL, '2025-08-05 16:04:00', 125.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2025-08-05 16:04:55', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 125.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-05 10:04:55', '2025-08-05 10:04:55'),
(74, 2, 2, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'partial', NULL, 2, NULL, '0032', '', NULL, NULL, NULL, '2025-08-26 06:07:00', 125.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2025-08-26 06:08:19', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 125.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 00:08:19', '2025-08-26 00:08:19'),
(75, 2, 2, 0, NULL, NULL, NULL, 'order', NULL, 'final', 'delivered', NULL, 0, 'partial', NULL, 2, NULL, '0033', '', NULL, NULL, NULL, '2025-08-26 06:24:00', 200.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2025-08-26 06:24:00', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 400.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 00:25:13', '2025-08-26 02:43:38'),
(76, 2, 2, 0, NULL, NULL, NULL, 'order', NULL, 'final', 'delivered', NULL, 0, 'partial', NULL, 2, NULL, '0034', '', NULL, NULL, NULL, '2025-08-26 07:06:00', 600.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, 'Test Shipping', 'Test Shipping Address', '2025-08-26 07:06:00', 'ordered', 'Shariatpur', 3, 20.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, 'Tea', 10.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 630.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 01:06:29', '2025-09-14 07:23:01'),
(77, 2, 2, 0, NULL, NULL, NULL, 'purchase', NULL, 'received', NULL, NULL, 0, 'partial', NULL, 9, NULL, NULL, 'PO2025/0001', NULL, NULL, NULL, '2025-09-14 13:54:00', 172000.0000, NULL, 0.0000, NULL, 0.0000, 0, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 172000.0000, NULL, NULL, NULL, NULL, NULL, 0, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-14 07:57:19', '2025-09-14 07:57:55'),
(78, 2, 2, 0, NULL, NULL, NULL, 'purchase', NULL, 'received', NULL, NULL, 0, 'paid', NULL, 9, NULL, NULL, 'PO2025/0002', NULL, NULL, NULL, '2025-09-14 14:00:00', 60000.0000, NULL, 0.0000, NULL, 0.0000, 0, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 60000.0000, NULL, NULL, NULL, NULL, NULL, 0, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-14 08:01:36', '2025-09-14 08:01:36'),
(79, 2, 2, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'partial', NULL, 8, NULL, '0035', '', NULL, NULL, NULL, '2025-09-14 14:03:28', 1000.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2025-09-14 14:03:28', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 1000.0000, NULL, NULL, NULL, NULL, NULL, 0, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, 0, '2025-09-14 08:03:28', '2025-09-14 08:03:28'),
(80, 2, 2, 0, NULL, NULL, NULL, 'order', NULL, 'final', 'received', NULL, 0, 'partial', NULL, 2, NULL, '0036', '', NULL, NULL, NULL, '2025-10-05 11:25:00', 200.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2025-10-05 11:25:00', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 200.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 05:42:39', '2025-10-09 17:21:19'),
(81, 2, 2, 0, NULL, NULL, NULL, 'order', NULL, 'final', 'ready_to_deliver', NULL, 0, 'partial', NULL, 2, NULL, '0037', '', NULL, NULL, NULL, '2025-10-05 16:47:00', 2500.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2025-10-05 16:47:00', NULL, NULL, 3, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 2500.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 10:48:59', '2025-10-09 16:06:25'),
(82, 2, 2, 0, NULL, NULL, NULL, 'order', NULL, 'final', 'received', NULL, 0, 'paid', NULL, 2, NULL, '0038', '', NULL, NULL, NULL, '2025-10-05 23:14:00', 200.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2025-10-05 23:14:00', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 200.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 17:15:14', '2025-10-05 17:15:14'),
(83, 2, 2, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'paid', NULL, 2, NULL, '0039', '', NULL, NULL, NULL, '2025-10-05 23:17:00', 250.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2025-10-05 23:17:40', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 250.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 17:17:40', '2025-10-05 17:17:40'),
(84, 2, 2, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'partial', NULL, 2, NULL, '0040', '', NULL, NULL, NULL, '2025-10-09 23:49:17', 250.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2025-10-09 23:49:17', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 250.0000, NULL, NULL, NULL, NULL, NULL, 0, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, 0, '2025-10-09 17:49:17', '2025-10-09 17:49:17'),
(85, 2, 2, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'paid', NULL, 2, NULL, '0041', '', NULL, NULL, NULL, '2025-10-10 06:45:16', 1.2500, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2025-10-10 06:45:16', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 1.2500, NULL, NULL, NULL, NULL, NULL, 0, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, 0, '2025-10-10 00:45:16', '2025-10-10 00:45:16'),
(86, 2, 2, 0, NULL, NULL, NULL, 'order', NULL, 'final', 'received', NULL, 0, 'due', NULL, 2, NULL, '0042', '', NULL, NULL, NULL, '2026-03-18 00:12:00', 600.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-18 00:12:00', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 600.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-17 18:13:12', '2026-03-17 18:13:12'),
(87, 2, 2, 0, NULL, NULL, NULL, 'order', NULL, 'final', 'received', NULL, 0, 'due', NULL, 2, NULL, '0043', '', NULL, NULL, NULL, '2026-03-24 23:32:00', 200.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-24 23:32:00', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 200.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 17:32:47', '2026-03-24 17:32:47'),
(88, 2, 2, 0, NULL, NULL, NULL, 'order', NULL, 'final', 'received', NULL, 0, 'due', NULL, 2, NULL, '0044', '', NULL, NULL, NULL, '2026-03-24 23:32:00', 500.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-24 23:32:00', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 500.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 17:33:04', '2026-03-24 17:33:04'),
(89, 2, 2, 0, NULL, NULL, NULL, 'order', NULL, 'final', 'received', NULL, 0, 'due', NULL, 2, NULL, '0045', '', NULL, NULL, NULL, '2026-03-24 23:33:00', 200.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-24 23:33:00', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 200.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 17:33:22', '2026-03-24 17:33:22'),
(90, 3, 4, 0, NULL, NULL, NULL, 'opening_stock', NULL, 'received', NULL, NULL, 0, 'paid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-01 00:48:35', 1.0000, NULL, 0.0000, NULL, 0.0000, 0, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 2.0000, NULL, NULL, NULL, NULL, NULL, 0, 0, 1.000, NULL, NULL, NULL, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:48:35', '2026-03-24 18:48:35'),
(91, 3, 4, 0, NULL, NULL, NULL, 'opening_stock', NULL, 'received', NULL, NULL, 0, 'paid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-01 00:48:43', 1.0000, NULL, 0.0000, NULL, 0.0000, 0, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 2.0000, NULL, NULL, NULL, NULL, NULL, 0, 0, 1.000, NULL, NULL, NULL, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:48:43', '2026-03-24 18:48:43'),
(92, 3, 4, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'paid', NULL, 11, NULL, '0001', '', NULL, NULL, NULL, '2026-03-25 00:49:00', 2.5000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-25 00:50:09', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 2.5000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:50:09', '2026-03-24 18:50:09'),
(93, 3, 4, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'due', NULL, 11, NULL, '0002', '', NULL, NULL, NULL, '2026-03-25 00:54:00', 1.2500, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-25 00:54:30', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 1.2500, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:54:30', '2026-03-24 18:54:30'),
(94, 3, 4, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'paid', NULL, 11, NULL, '0003', '', NULL, NULL, NULL, '2026-03-25 00:54:00', 1.2500, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-25 00:54:54', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 1.2500, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:54:54', '2026-03-24 18:54:54'),
(95, 3, 4, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'due', NULL, 11, NULL, '0004', '', NULL, NULL, NULL, '2026-03-25 00:55:00', 1.2500, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-25 00:56:05', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 1.2500, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:56:05', '2026-03-24 18:56:05'),
(96, 3, 4, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'paid', NULL, 11, NULL, '0005', '', NULL, NULL, NULL, '2026-03-25 00:56:00', 1.2500, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-25 00:56:23', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 1.2500, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:56:23', '2026-03-24 18:56:23'),
(97, 3, 4, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'paid', NULL, 11, NULL, '0006', '', NULL, NULL, NULL, '2026-03-25 00:56:00', 1.2500, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-25 00:56:35', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 1.2500, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:56:35', '2026-03-24 18:56:35'),
(98, 3, 4, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'paid', NULL, 11, NULL, '0007', '', NULL, NULL, NULL, '2026-03-25 00:58:00', 1.2500, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-25 00:58:14', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 1.2500, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:58:14', '2026-03-24 18:58:14'),
(99, 3, 4, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'paid', NULL, 11, NULL, '0008', '', NULL, NULL, NULL, '2026-03-25 01:01:00', 1.2500, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-25 01:01:42', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 1.2500, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 19:01:42', '2026-03-24 19:01:42'),
(100, 3, 4, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'paid', NULL, 11, NULL, '0009', '', NULL, NULL, NULL, '2026-03-25 01:01:00', 1.2500, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-25 01:01:56', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 1.2500, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 19:01:56', '2026-03-24 19:01:56'),
(101, 3, 4, 0, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, NULL, 0, 'paid', NULL, 11, NULL, '0010', '', NULL, NULL, NULL, '2026-03-25 01:01:00', 1.2500, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-25 01:02:08', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 1.2500, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 19:02:08', '2026-03-24 19:02:08'),
(102, 3, 4, 0, NULL, NULL, NULL, 'order', NULL, 'final', 'received', NULL, 0, 'paid', NULL, 11, NULL, '0011', '', NULL, NULL, NULL, '2026-03-25 01:03:00', 500.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-25 01:03:00', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 500.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 19:03:19', '2026-03-24 19:03:19'),
(103, 3, 4, 0, NULL, NULL, NULL, 'order', NULL, 'final', 'received', NULL, 0, 'paid', NULL, 11, NULL, '0012', '', NULL, NULL, NULL, '2026-03-25 01:03:00', 500.0000, NULL, 0.0000, 'percentage', 0.0000, 0, 0.0000, NULL, NULL, '2026-03-25 01:03:00', NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, NULL, 0.0000, 500.0000, NULL, NULL, NULL, NULL, NULL, 1, 0, 1.000, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 19:03:31', '2026-03-24 19:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_payments`
--

CREATE TABLE `transaction_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(11) UNSIGNED DEFAULT NULL,
  `business_id` int(11) DEFAULT NULL,
  `is_return` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Used during sales to return the change',
  `amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `method` varchar(191) DEFAULT NULL,
  `payment_type` varchar(191) DEFAULT NULL,
  `transaction_no` varchar(191) DEFAULT NULL,
  `card_transaction_number` varchar(191) DEFAULT NULL,
  `card_number` varchar(191) DEFAULT NULL,
  `card_type` varchar(191) DEFAULT NULL,
  `card_holder_name` varchar(191) DEFAULT NULL,
  `card_month` varchar(191) DEFAULT NULL,
  `card_year` varchar(191) DEFAULT NULL,
  `card_security` varchar(5) DEFAULT NULL,
  `cheque_number` varchar(191) DEFAULT NULL,
  `bank_account_number` varchar(191) DEFAULT NULL,
  `paid_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `paid_through_link` tinyint(1) NOT NULL DEFAULT 0,
  `gateway` varchar(191) DEFAULT NULL,
  `is_advance` tinyint(1) NOT NULL DEFAULT 0,
  `payment_for` int(11) DEFAULT NULL COMMENT 'stores the contact id',
  `parent_id` int(11) DEFAULT NULL,
  `note` varchar(191) DEFAULT NULL,
  `document` varchar(191) DEFAULT NULL,
  `payment_ref_no` varchar(191) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_payments`
--

INSERT INTO `transaction_payments` (`id`, `transaction_id`, `business_id`, `is_return`, `amount`, `method`, `payment_type`, `transaction_no`, `card_transaction_number`, `card_number`, `card_type`, `card_holder_name`, `card_month`, `card_year`, `card_security`, `cheque_number`, `bank_account_number`, `paid_on`, `created_by`, `paid_through_link`, `gateway`, `is_advance`, `payment_for`, `parent_id`, `note`, `document`, `payment_ref_no`, `account_id`, `created_at`, `updated_at`) VALUES
(53, NULL, 2, 0, 0.0000, 'cash', 'credit', NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-15 21:35:00', 2, 0, NULL, 1, 5, NULL, NULL, NULL, 'SP2025/0036', 1, '2025-08-15 15:35:31', '2025-08-26 04:45:09'),
(61, 74, 2, 0, 20.0000, 'advance', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 06:07:00', 2, 0, NULL, 0, 2, NULL, NULL, NULL, 'SP2025/0043', NULL, '2025-08-26 00:08:19', '2025-08-26 00:08:19'),
(63, 75, 2, 0, 100.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 06:24:00', 2, 0, NULL, 0, 2, NULL, NULL, NULL, 'SP2025/0045', 1, '2025-08-26 00:25:13', '2025-08-26 01:03:34'),
(65, 76, 2, 0, 20.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 09:45:00', 2, 0, NULL, 0, 2, NULL, NULL, NULL, 'PP2025/0010', 1, '2025-08-26 03:45:39', '2025-08-26 04:26:39'),
(66, 76, 2, 0, 30.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 09:45:00', 2, 0, NULL, 0, 2, NULL, NULL, NULL, 'PP2025/0011', 1, '2025-08-26 03:45:59', '2025-08-26 04:26:39'),
(67, 77, 2, 0, 100000.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-14 13:54:00', 2, 0, NULL, 0, 9, NULL, NULL, NULL, 'PP2025/0012', 2, '2025-09-14 07:57:19', '2025-09-14 07:57:19'),
(68, 78, 2, 0, 60000.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-14 14:00:00', 2, 0, NULL, 0, 9, NULL, NULL, NULL, 'PP2025/0013', 1, '2025-09-14 08:01:36', '2025-09-14 08:01:36'),
(69, 79, 2, 0, 500.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-14 14:03:28', 2, 0, NULL, 0, 8, NULL, NULL, NULL, 'SP2025/0047', 1, '2025-09-14 08:03:28', '2025-09-14 08:03:28'),
(70, 79, 2, 0, 200.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-14 14:03:28', 2, 0, NULL, 0, 8, NULL, NULL, NULL, 'SP2025/0048', 2, '2025-09-14 08:03:28', '2025-09-14 08:03:28'),
(71, 80, 2, 0, 10.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 11:25:00', 2, 0, NULL, 0, 2, NULL, NULL, NULL, 'SP2025/0049', 2, '2025-10-05 05:42:39', '2025-10-09 17:21:19'),
(72, 81, 2, 0, 500.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 16:47:00', 2, 0, NULL, 0, 2, NULL, NULL, NULL, 'SP2025/0050', 2, '2025-10-05 10:48:59', '2025-10-09 16:06:25'),
(73, 82, 2, 0, 200.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 23:14:00', 2, 0, NULL, 0, 2, NULL, NULL, NULL, 'SP2025/0051', 1, '2025-10-05 17:15:14', '2025-10-05 17:15:14'),
(74, 83, 2, 0, 250.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-05 23:17:00', 2, 0, NULL, 0, 2, NULL, NULL, NULL, 'SP2025/0052', 2, '2025-10-05 17:17:40', '2025-10-05 17:17:40'),
(75, 80, 2, 0, 20.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-09 23:37:00', 2, 0, NULL, 0, 2, NULL, NULL, NULL, 'PP2025/0014', 2, '2025-10-09 17:37:56', '2025-10-09 17:37:56'),
(76, 84, 2, 0, 100.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-09 23:49:17', 2, 0, NULL, 0, 2, NULL, NULL, NULL, 'SP2025/0053', 1, '2025-10-09 17:49:17', '2025-10-09 17:49:17'),
(77, 85, 2, 0, 1.2500, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-10 06:45:16', 2, 0, NULL, 0, 2, NULL, NULL, NULL, 'SP2025/0054', 1, '2025-10-10 00:45:16', '2025-10-10 00:45:16'),
(78, 92, 3, 0, 2.5000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 00:49:00', 5, 0, NULL, 0, 11, NULL, NULL, NULL, 'SP2026/0001', NULL, '2026-03-24 18:50:09', '2026-03-24 18:50:09'),
(79, 94, 3, 0, 1.2500, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 00:54:00', 5, 0, NULL, 0, 11, NULL, NULL, NULL, 'SP2026/0002', NULL, '2026-03-24 18:54:54', '2026-03-24 18:54:54'),
(80, 96, 3, 0, 1.2500, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 00:56:00', 5, 0, NULL, 0, 11, NULL, NULL, NULL, 'SP2026/0003', NULL, '2026-03-24 18:56:23', '2026-03-24 18:56:23'),
(81, 97, 3, 0, 1.2500, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 00:56:00', 5, 0, NULL, 0, 11, NULL, NULL, NULL, 'SP2026/0004', NULL, '2026-03-24 18:56:35', '2026-03-24 18:56:35'),
(82, 98, 3, 0, 1.2500, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 00:58:00', 5, 0, NULL, 0, 11, NULL, NULL, NULL, 'SP2026/0005', NULL, '2026-03-24 18:58:14', '2026-03-24 18:58:14'),
(83, 99, 3, 0, 1.2500, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 01:01:00', 5, 0, NULL, 0, 11, NULL, NULL, NULL, 'SP2026/0006', NULL, '2026-03-24 19:01:42', '2026-03-24 19:01:42'),
(84, 100, 3, 0, 1.2500, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 01:01:00', 5, 0, NULL, 0, 11, NULL, NULL, NULL, 'SP2026/0007', NULL, '2026-03-24 19:01:56', '2026-03-24 19:01:56'),
(85, 101, 3, 0, 1.2500, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 01:01:00', 5, 0, NULL, 0, 11, NULL, NULL, NULL, 'SP2026/0008', NULL, '2026-03-24 19:02:08', '2026-03-24 19:02:08'),
(86, 102, 3, 0, 500.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 01:03:00', 5, 0, NULL, 0, 11, NULL, NULL, NULL, 'SP2026/0009', NULL, '2026-03-24 19:03:19', '2026-03-24 19:03:19'),
(87, 103, 3, 0, 500.0000, 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 01:03:00', 5, 0, NULL, 0, 11, NULL, NULL, NULL, 'SP2026/0010', NULL, '2026-03-24 19:03:31', '2026-03-24 19:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_sell_lines`
--

CREATE TABLE `transaction_sell_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `cloth_id` int(10) UNSIGNED DEFAULT NULL,
  `variation_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `completed_quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `delivered_quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `secondary_unit_quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `quantity_returned` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `unit_price_before_discount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `unit_price` decimal(22,4) DEFAULT NULL COMMENT 'Sell price excluding tax',
  `line_discount_type` enum('fixed','percentage') DEFAULT NULL,
  `line_discount_amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `unit_price_inc_tax` decimal(22,4) DEFAULT NULL COMMENT 'Sell price including tax',
  `item_tax` decimal(22,4) NOT NULL COMMENT 'Tax for one quantity',
  `tax_id` int(10) UNSIGNED DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `lot_no_line_id` int(11) DEFAULT NULL,
  `sell_line_note` text DEFAULT NULL,
  `woocommerce_line_items_id` int(11) DEFAULT NULL,
  `so_line_id` int(11) DEFAULT NULL,
  `so_quantity_invoiced` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `res_service_staff_id` int(11) DEFAULT NULL,
  `res_line_order_status` varchar(191) DEFAULT NULL,
  `parent_sell_line_id` int(11) DEFAULT NULL,
  `children_type` varchar(191) NOT NULL DEFAULT '' COMMENT 'Type of children for the parent, like modifier or combo',
  `sub_unit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_sell_lines`
--

INSERT INTO `transaction_sell_lines` (`id`, `transaction_id`, `product_id`, `cloth_id`, `variation_id`, `quantity`, `completed_quantity`, `delivered_quantity`, `secondary_unit_quantity`, `quantity_returned`, `unit_price_before_discount`, `unit_price`, `line_discount_type`, `line_discount_amount`, `unit_price_inc_tax`, `item_tax`, `tax_id`, `discount_id`, `lot_no_line_id`, `sell_line_note`, `woocommerce_line_items_id`, `so_line_id`, `so_quantity_invoiced`, `res_service_staff_id`, `res_line_order_status`, `parent_sell_line_id`, `children_type`, `sub_unit_id`, `created_at`, `updated_at`) VALUES
(162, 59, 2, NULL, 2, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 125.0000, 125.0000, 'fixed', 0.0000, 125.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-07-29 16:53:01', '2025-07-29 16:53:01'),
(169, 65, 2, NULL, 2, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 125.0000, 125.0000, 'fixed', 0.0000, 125.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-08-05 10:04:55', '2025-08-05 10:04:55'),
(179, 74, 2, NULL, 2, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 125.0000, 125.0000, 'fixed', 0.0000, 125.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-08-26 00:08:19', '2025-08-26 00:08:19'),
(182, 75, NULL, 9, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-08-26 01:03:34', '2025-08-26 01:03:34'),
(185, 76, NULL, 9, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-08-26 04:26:39', '2025-08-26 04:26:39'),
(186, 76, NULL, 9, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-08-26 04:26:39', '2025-08-26 04:26:39'),
(187, 76, 3, NULL, 3, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-08-26 04:26:39', '2025-08-26 04:26:39'),
(188, 79, 7, NULL, 7, 5.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-09-14 08:03:28', '2025-09-14 08:03:28'),
(192, 82, NULL, 9, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-10-05 17:15:14', '2025-10-05 17:15:14'),
(193, 83, 3, NULL, 3, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 250.0000, 250.0000, 'fixed', 0.0000, 250.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-10-05 17:17:40', '2025-10-05 17:17:40'),
(194, 81, NULL, 10, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 500.0000, 500.0000, 'fixed', 0.0000, 500.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-10-09 16:06:25', '2025-10-09 16:06:25'),
(195, 81, NULL, 11, NULL, 2.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-10-09 16:06:25', '2025-10-09 16:06:25'),
(196, 81, NULL, 26, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 500.0000, 500.0000, 'fixed', 0.0000, 500.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-10-09 16:06:25', '2025-10-09 16:06:25'),
(197, 81, 4, NULL, 4, 2.0000, 0.0000, 0.0000, 0.0000, 0.0000, 550.0000, 550.0000, 'fixed', 0.0000, 550.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-10-09 16:06:25', '2025-10-09 16:06:25'),
(200, 80, NULL, 9, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-10-09 17:21:19', '2025-10-09 17:21:19'),
(201, 84, 3, NULL, 3, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 250.0000, 250.0000, 'fixed', 0.0000, 250.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-10-09 17:49:17', '2025-10-09 17:49:17'),
(202, 85, 6, NULL, 6, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 1.2500, 1.2500, 'fixed', 0.0000, 1.2500, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2025-10-10 00:45:16', '2025-10-10 00:45:16'),
(203, 86, NULL, 9, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-17 18:13:12', '2026-03-17 18:13:12'),
(204, 86, NULL, 9, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-17 18:13:12', '2026-03-17 18:13:12'),
(205, 86, NULL, 11, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-17 18:13:12', '2026-03-17 18:13:12'),
(206, 87, NULL, 9, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 17:32:47', '2026-03-24 17:32:47'),
(207, 88, NULL, 10, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 500.0000, 500.0000, 'fixed', 0.0000, 500.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 17:33:04', '2026-03-24 17:33:04'),
(208, 89, NULL, 9, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 200.0000, 200.0000, 'fixed', 0.0000, 200.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 17:33:22', '2026-03-24 17:33:22'),
(209, 92, 8, NULL, 8, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 1.2500, 1.2500, 'fixed', 0.0000, 1.2500, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 18:50:09', '2026-03-24 18:50:09'),
(210, 92, 9, NULL, 9, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 1.2500, 1.2500, 'fixed', 0.0000, 1.2500, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 18:50:09', '2026-03-24 18:50:09'),
(211, 93, 8, NULL, 8, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 1.2500, 1.2500, 'fixed', 0.0000, 1.2500, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 18:54:30', '2026-03-24 18:54:30'),
(212, 94, 9, NULL, 9, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 1.2500, 1.2500, 'fixed', 0.0000, 1.2500, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 18:54:54', '2026-03-24 18:54:54'),
(213, 95, 8, NULL, 8, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 1.2500, 1.2500, 'fixed', 0.0000, 1.2500, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 18:56:05', '2026-03-24 18:56:05'),
(214, 96, 8, NULL, 8, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 1.2500, 1.2500, 'fixed', 0.0000, 1.2500, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 18:56:23', '2026-03-24 18:56:23'),
(215, 97, 8, NULL, 8, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 1.2500, 1.2500, 'fixed', 0.0000, 1.2500, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 18:56:35', '2026-03-24 18:56:35'),
(216, 98, 8, NULL, 8, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 1.2500, 1.2500, 'fixed', 0.0000, 1.2500, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 18:58:14', '2026-03-24 18:58:14'),
(217, 99, 8, NULL, 8, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 1.2500, 1.2500, 'fixed', 0.0000, 1.2500, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 19:01:42', '2026-03-24 19:01:42'),
(218, 100, 8, NULL, 8, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 1.2500, 1.2500, 'fixed', 0.0000, 1.2500, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 19:01:56', '2026-03-24 19:01:56'),
(219, 101, 8, NULL, 8, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 1.2500, 1.2500, 'fixed', 0.0000, 1.2500, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 19:02:08', '2026-03-24 19:02:08'),
(220, 102, NULL, 36, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 500.0000, 500.0000, 'fixed', 0.0000, 500.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 19:03:19', '2026-03-24 19:03:19'),
(221, 103, NULL, 36, NULL, 1.0000, 0.0000, 0.0000, 0.0000, 0.0000, 500.0000, 500.0000, 'fixed', 0.0000, 500.0000, 0.0000, NULL, NULL, NULL, '', NULL, NULL, 0.0000, NULL, NULL, NULL, '', NULL, '2026-03-24 19:03:31', '2026-03-24 19:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_sell_lines_purchase_lines`
--

CREATE TABLE `transaction_sell_lines_purchase_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `sell_line_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'id from transaction_sell_lines',
  `stock_adjustment_line_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'id from stock_adjustment_lines',
  `purchase_line_id` int(10) UNSIGNED NOT NULL COMMENT 'id from purchase_lines',
  `quantity` decimal(22,4) NOT NULL,
  `qty_returned` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_sell_lines_purchase_lines`
--

INSERT INTO `transaction_sell_lines_purchase_lines` (`id`, `sell_line_id`, `stock_adjustment_line_id`, `purchase_line_id`, `quantity`, `qty_returned`, `created_at`, `updated_at`) VALUES
(3, 2, NULL, 1, 1.0000, 0.0000, '2025-07-12 05:39:24', '2025-07-12 05:39:24'),
(4, 3, NULL, 1, 3.0000, 0.0000, '2025-07-12 08:45:59', '2025-07-12 08:45:59'),
(5, 4, NULL, 1, 3.0000, 0.0000, '2025-07-12 09:01:11', '2025-07-12 09:01:11'),
(6, 5, NULL, 1, 1.0000, 0.0000, '2025-07-12 09:43:27', '2025-07-12 09:43:27'),
(7, 22, NULL, 1, 1.0000, 0.0000, '2025-07-15 05:50:19', '2025-07-15 05:50:19'),
(8, 38, NULL, 2, 1.0000, 0.0000, '2025-07-15 07:27:02', '2025-07-15 07:27:02'),
(9, 42, NULL, 2, 1.0000, 0.0000, '2025-07-18 05:36:58', '2025-07-18 05:36:58'),
(11, 49, NULL, 4, 2.0000, 0.0000, '2025-07-18 11:33:38', '2025-07-18 11:33:38'),
(20, 187, NULL, 4, 1.0000, 0.0000, '2025-08-26 04:26:39', '2025-08-26 04:26:39'),
(21, 188, NULL, 7, 5.0000, 0.0000, '2025-09-14 08:03:28', '2025-09-14 08:03:28'),
(22, 193, NULL, 4, 1.0000, 0.0000, '2025-10-05 17:17:40', '2025-10-05 17:17:40'),
(23, 197, NULL, 6, 2.0000, 0.0000, '2025-10-09 16:06:25', '2025-10-09 16:06:25'),
(24, 201, NULL, 4, 1.0000, 0.0000, '2025-10-09 17:49:17', '2025-10-09 17:49:17'),
(25, 202, NULL, 0, 1.0000, 0.0000, '2025-10-10 00:45:16', '2025-10-10 00:45:16'),
(26, 209, NULL, 8, 1.0000, 0.0000, '2026-03-24 18:50:09', '2026-03-24 18:50:09'),
(27, 210, NULL, 9, 1.0000, 0.0000, '2026-03-24 18:50:09', '2026-03-24 18:50:09'),
(28, 211, NULL, 8, 1.0000, 0.0000, '2026-03-24 18:54:30', '2026-03-24 18:54:30'),
(29, 212, NULL, 9, 1.0000, 0.0000, '2026-03-24 18:54:54', '2026-03-24 18:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `types_of_services`
--

CREATE TABLE `types_of_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `business_id` int(11) NOT NULL,
  `location_price_group` text DEFAULT NULL,
  `packing_charge` decimal(22,4) DEFAULT NULL,
  `packing_charge_type` enum('fixed','percent') DEFAULT NULL,
  `enable_custom_fields` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `actual_name` varchar(191) NOT NULL,
  `short_name` varchar(191) NOT NULL,
  `allow_decimal` tinyint(1) NOT NULL,
  `base_unit_id` int(11) DEFAULT NULL,
  `base_unit_multiplier` decimal(20,4) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `business_id`, `actual_name`, `short_name`, `allow_decimal`, `base_unit_id`, `base_unit_multiplier`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pieces', 'Pc(s)', 0, NULL, NULL, 1, NULL, '2024-03-22 09:48:06', '2024-03-22 09:48:06'),
(2, 2, 'Pieces', 'Pc(s)', 0, NULL, NULL, 2, NULL, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(3, 2, 'Yard', 'Yard', 1, NULL, NULL, 2, NULL, '2025-09-14 07:53:05', '2025-09-14 07:53:20'),
(4, 3, 'Pieces', 'Pc(s)', 0, NULL, NULL, 5, NULL, '2026-03-24 18:17:02', '2026-03-24 18:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) NOT NULL DEFAULT 'user',
  `surname` char(10) DEFAULT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) DEFAULT NULL,
  `username` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `language` char(7) NOT NULL DEFAULT 'en',
  `contact_no` char(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `business_id` int(10) UNSIGNED DEFAULT NULL,
  `available_at` datetime DEFAULT NULL COMMENT 'Service staff avilable at. Calculated from product preparation_time_in_minutes',
  `paused_at` datetime DEFAULT NULL COMMENT 'Service staff available time paused at, Will be nulled on resume.',
  `max_sales_discount_percent` decimal(5,2) DEFAULT NULL,
  `allow_login` tinyint(1) NOT NULL DEFAULT 1,
  `status` enum('active','inactive','terminated') NOT NULL DEFAULT 'active',
  `is_enable_service_staff_pin` tinyint(1) NOT NULL DEFAULT 0,
  `service_staff_pin` text DEFAULT NULL,
  `crm_contact_id` int(10) UNSIGNED DEFAULT NULL,
  `is_cmmsn_agnt` tinyint(1) NOT NULL DEFAULT 0,
  `cmmsn_percent` decimal(4,2) NOT NULL DEFAULT 0.00,
  `selected_contacts` tinyint(1) NOT NULL DEFAULT 0,
  `dob` date DEFAULT NULL,
  `gender` varchar(191) DEFAULT NULL,
  `marital_status` enum('married','unmarried','divorced') DEFAULT NULL,
  `blood_group` char(10) DEFAULT NULL,
  `contact_number` char(20) DEFAULT NULL,
  `alt_number` varchar(191) DEFAULT NULL,
  `family_number` varchar(191) DEFAULT NULL,
  `fb_link` varchar(191) DEFAULT NULL,
  `twitter_link` varchar(191) DEFAULT NULL,
  `social_media_1` varchar(191) DEFAULT NULL,
  `social_media_2` varchar(191) DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `current_address` text DEFAULT NULL,
  `guardian_name` varchar(191) DEFAULT NULL,
  `custom_field_1` varchar(191) DEFAULT NULL,
  `custom_field_2` varchar(191) DEFAULT NULL,
  `custom_field_3` varchar(191) DEFAULT NULL,
  `custom_field_4` varchar(191) DEFAULT NULL,
  `bank_details` longtext DEFAULT NULL,
  `id_proof_name` varchar(191) DEFAULT NULL,
  `id_proof_number` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `surname`, `first_name`, `last_name`, `username`, `email`, `password`, `language`, `contact_no`, `address`, `remember_token`, `business_id`, `available_at`, `paused_at`, `max_sales_discount_percent`, `allow_login`, `status`, `is_enable_service_staff_pin`, `service_staff_pin`, `crm_contact_id`, `is_cmmsn_agnt`, `cmmsn_percent`, `selected_contacts`, `dob`, `gender`, `marital_status`, `blood_group`, `contact_number`, `alt_number`, `family_number`, `fb_link`, `twitter_link`, `social_media_1`, `social_media_2`, `permanent_address`, `current_address`, `guardian_name`, `custom_field_1`, `custom_field_2`, `custom_field_3`, `custom_field_4`, `bank_details`, `id_proof_name`, `id_proof_number`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'user', 'Mr', 'Super', 'Admin', 'superadmin', 'support@microwebs.co', '$2y$10$MfSSQ2iX44fml.srxSwuy.ju8y1hcv8nzB.d58dJDcUgPJGxNrT6O', 'en', NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 'active', 0, NULL, NULL, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-22 09:48:05', '2024-03-22 09:48:05'),
(2, 'user', NULL, 'Test', NULL, 'test', 'test@gmail.com', '$2y$10$GWrnVR..KizPlhdYXCxOSOEckNCG/xgE4WlYkW2iMT7SuO15riRfC', 'en', NULL, NULL, 'FvVEnVQqGkS4fioemukdf3h52PX86O6aTPBLj7OP612PHN1w2l38e8pDq8Qx', 2, NULL, NULL, NULL, 1, 'active', 0, NULL, NULL, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-02 04:50:18', '2025-07-02 04:50:18'),
(3, 'user', NULL, 'Aatif', 'Sarkar', 'aarif', 'aa@aa.com', '$2y$10$W.6XdEKDGrHLC5idTuTm7u3dC./itCg.gzDhz6Ja0iNDL2073IBWq', 'en', NULL, NULL, NULL, 2, NULL, NULL, NULL, 1, 'active', 0, NULL, NULL, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"account_holder_name\":null,\"account_number\":null,\"bank_name\":null,\"bank_code\":null,\"branch\":null,\"tax_payer_id\":null}', NULL, NULL, NULL, '2025-08-05 11:59:15', '2025-08-05 11:59:15'),
(4, 'user', NULL, 'Nahid', NULL, 'nahid', 'contact@madrazkitchen.com', '$2y$10$soqc8CwgSwn28puOF4YATO7d0YYXGhgFlI6O0XnhEX4VOlafq.aCe', 'en', NULL, NULL, NULL, 2, NULL, NULL, NULL, 1, 'active', 0, NULL, NULL, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dhali Food Court - Bashundhara R/A', NULL, NULL, NULL, NULL, NULL, NULL, '{\"account_holder_name\":null,\"account_number\":null,\"bank_name\":null,\"bank_code\":null,\"branch\":null,\"tax_payer_id\":null}', NULL, NULL, NULL, '2025-08-07 06:58:46', '2025-08-07 06:58:46'),
(5, 'user', NULL, 'Test', NULL, 'test01', 'aaa@aa.com', '$2y$10$OnP9wLQabKZ.DrdoWBD4mOF7F9xieSRNWVUaMgJsH9coX2oxhXkrW', 'en', NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 'active', 0, NULL, NULL, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:17:02', '2026-03-24 18:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_contact_access`
--

CREATE TABLE `user_contact_access` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_contact_access`
--

INSERT INTO `user_contact_access` (`id`, `user_id`, `contact_id`) VALUES
(1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE `variations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `sub_sku` varchar(191) DEFAULT NULL,
  `product_variation_id` int(10) UNSIGNED NOT NULL,
  `woocommerce_variation_id` int(11) DEFAULT NULL,
  `variation_value_id` int(11) DEFAULT NULL,
  `default_purchase_price` decimal(22,4) DEFAULT NULL,
  `dpp_inc_tax` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `profit_percent` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `default_sell_price` decimal(22,4) DEFAULT NULL,
  `sell_price_inc_tax` decimal(22,4) DEFAULT NULL COMMENT 'Sell price including tax',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `combo_variations` text DEFAULT NULL COMMENT 'Contains the combo variation details'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`id`, `name`, `product_id`, `sub_sku`, `product_variation_id`, `woocommerce_variation_id`, `variation_value_id`, `default_purchase_price`, `dpp_inc_tax`, `profit_percent`, `default_sell_price`, `sell_price_inc_tax`, `created_at`, `updated_at`, `deleted_at`, `combo_variations`) VALUES
(2, 'DUMMY', 2, '101', 2, NULL, NULL, 100.0000, 100.0000, 25.0000, 125.0000, 125.0000, '2025-07-18 11:12:14', '2025-09-14 07:54:17', NULL, '[]'),
(3, 'DUMMY', 3, '0003', 3, NULL, NULL, 160.0000, 160.0000, 56.2500, 250.0000, 250.0000, '2025-07-18 11:18:49', '2025-09-14 07:57:19', NULL, '[]'),
(4, 'DUMMY', 4, '0004', 4, NULL, NULL, 460.0000, 460.0000, 19.5652, 550.0000, 550.0000, '2025-07-23 17:18:01', '2025-09-14 07:57:19', NULL, '[]'),
(5, 'DUMMY', 5, '0005', 5, NULL, NULL, 1.0000, 1.0000, 25.0000, 1.2500, 1.2500, '2025-07-23 17:29:19', '2025-07-23 17:29:19', NULL, '[]'),
(6, 'DUMMY', 6, '0006', 6, NULL, NULL, 1.0000, 1.0000, 25.0000, 1.2500, 1.2500, '2025-07-23 17:29:40', '2025-09-14 07:54:07', NULL, '[]'),
(7, 'DUMMY', 7, '0007', 7, NULL, NULL, 100.0000, 100.0000, 20.0000, 120.0000, 120.0000, '2025-09-14 08:00:14', '2025-09-14 08:00:14', NULL, '[]'),
(8, 'DUMMY', 8, '0008', 8, NULL, NULL, 1.0000, 1.0000, 25.0000, 1.2500, 1.2500, '2026-03-24 18:47:44', '2026-03-24 18:55:46', NULL, '[]'),
(9, 'DUMMY', 9, '0009', 9, NULL, NULL, 1.0000, 1.0000, 25.0000, 1.2500, 1.2500, '2026-03-24 18:47:54', '2026-03-24 18:47:54', NULL, '[]');

-- --------------------------------------------------------

--
-- Table structure for table `variation_group_prices`
--

CREATE TABLE `variation_group_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `variation_id` int(10) UNSIGNED NOT NULL,
  `price_group_id` int(10) UNSIGNED NOT NULL,
  `price_inc_tax` decimal(22,4) NOT NULL,
  `price_type` varchar(191) NOT NULL DEFAULT 'fixed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variation_location_details`
--

CREATE TABLE `variation_location_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_variation_id` int(10) UNSIGNED NOT NULL COMMENT 'id from product_variations table',
  `variation_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `qty_available` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variation_location_details`
--

INSERT INTO `variation_location_details` (`id`, `product_id`, `product_variation_id`, `variation_id`, `location_id`, `qty_available`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 2, 2, 100.0000, '2025-07-18 11:12:28', '2025-07-18 11:12:28'),
(3, 3, 3, 3, 2, 598.0000, '2025-07-18 11:20:25', '2025-10-09 17:49:17'),
(4, 6, 6, 6, 2, 0.0000, '2025-07-23 17:52:02', '2025-10-10 00:45:16'),
(5, 4, 4, 4, 2, 201.0000, '2025-08-01 16:55:59', '2025-09-14 07:57:55'),
(6, 7, 7, 7, 2, 595.0000, '2025-09-14 08:01:36', '2025-09-14 08:03:28'),
(7, 8, 8, 8, 4, 0.0000, '2026-03-24 18:48:35', '2026-03-24 18:54:30'),
(8, 9, 9, 9, 4, 0.0000, '2026-03-24 18:48:43', '2026-03-24 18:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `variation_templates`
--

CREATE TABLE `variation_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `woocommerce_attr_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variation_value_templates`
--

CREATE TABLE `variation_value_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `variation_template_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warranties`
--

CREATE TABLE `warranties` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `business_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `duration_type` enum('days','months','years') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `woocommerce_sync_logs`
--

CREATE TABLE `woocommerce_sync_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `sync_type` varchar(191) NOT NULL,
  `operation_type` varchar(191) DEFAULT NULL,
  `data` longtext DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_business_id_index` (`business_id`),
  ADD KEY `accounts_account_type_id_index` (`account_type_id`),
  ADD KEY `accounts_created_by_index` (`created_by`);

--
-- Indexes for table `account_transactions`
--
ALTER TABLE `account_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_transactions_account_id_index` (`account_id`),
  ADD KEY `account_transactions_transaction_id_index` (`transaction_id`),
  ADD KEY `account_transactions_transaction_payment_id_index` (`transaction_payment_id`),
  ADD KEY `account_transactions_transfer_transaction_id_index` (`transfer_transaction_id`),
  ADD KEY `account_transactions_created_by_index` (`created_by`),
  ADD KEY `account_transactions_type_index` (`type`),
  ADD KEY `account_transactions_sub_type_index` (`sub_type`),
  ADD KEY `account_transactions_operation_date_index` (`operation_date`);

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_types_parent_account_type_id_index` (`parent_account_type_id`),
  ADD KEY `account_types_business_id_index` (`business_id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `barcodes`
--
ALTER TABLE `barcodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barcodes_business_id_foreign` (`business_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_contact_id_foreign` (`contact_id`),
  ADD KEY `bookings_business_id_foreign` (`business_id`),
  ADD KEY `bookings_created_by_foreign` (`created_by`),
  ADD KEY `bookings_table_id_index` (`table_id`),
  ADD KEY `bookings_waiter_id_index` (`waiter_id`),
  ADD KEY `bookings_location_id_index` (`location_id`),
  ADD KEY `bookings_booking_status_index` (`booking_status`),
  ADD KEY `bookings_correspondent_id_index` (`correspondent_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_business_id_foreign` (`business_id`),
  ADD KEY `brands_created_by_foreign` (`created_by`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_owner_id_foreign` (`owner_id`),
  ADD KEY `business_currency_id_foreign` (`currency_id`),
  ADD KEY `business_default_sales_tax_foreign` (`default_sales_tax`);

--
-- Indexes for table `business_locations`
--
ALTER TABLE `business_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_locations_business_id_index` (`business_id`),
  ADD KEY `business_locations_invoice_scheme_id_foreign` (`invoice_scheme_id`),
  ADD KEY `business_locations_invoice_layout_id_foreign` (`invoice_layout_id`),
  ADD KEY `business_locations_sale_invoice_layout_id_index` (`sale_invoice_layout_id`),
  ADD KEY `business_locations_selling_price_group_id_index` (`selling_price_group_id`),
  ADD KEY `business_locations_receipt_printer_type_index` (`receipt_printer_type`),
  ADD KEY `business_locations_printer_id_index` (`printer_id`);

--
-- Indexes for table `cash_denominations`
--
ALTER TABLE `cash_denominations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_denominations_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `cash_registers`
--
ALTER TABLE `cash_registers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_registers_business_id_foreign` (`business_id`),
  ADD KEY `cash_registers_user_id_foreign` (`user_id`),
  ADD KEY `cash_registers_location_id_index` (`location_id`);

--
-- Indexes for table `cash_register_transactions`
--
ALTER TABLE `cash_register_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_register_transactions_cash_register_id_foreign` (`cash_register_id`),
  ADD KEY `cash_register_transactions_transaction_id_index` (`transaction_id`),
  ADD KEY `cash_register_transactions_type_index` (`type`),
  ADD KEY `cash_register_transactions_transaction_type_index` (`transaction_type`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_business_id_foreign` (`business_id`),
  ADD KEY `categories_created_by_foreign` (`created_by`),
  ADD KEY `categories_parent_id_index` (`parent_id`),
  ADD KEY `categories_woocommerce_cat_id_index` (`woocommerce_cat_id`);

--
-- Indexes for table `categorizables`
--
ALTER TABLE `categorizables`
  ADD KEY `categorizables_categorizable_type_categorizable_id_index` (`categorizable_type`,`categorizable_id`);

--
-- Indexes for table `cloths`
--
ALTER TABLE `cloths`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cloths_business_id_foreign` (`business_id`),
  ADD KEY `cloths_created_by_foreign` (`created_by`),
  ADD KEY `cloths_serial_no_unique` (`serial_no`) USING BTREE;

--
-- Indexes for table `cloth_customizations`
--
ALTER TABLE `cloth_customizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cloth_customizations_cloth_id_foreign` (`cloth_id`),
  ADD KEY `cloth_customizations_contact_id_foreign` (`contact_id`);

--
-- Indexes for table `cloth_measurement`
--
ALTER TABLE `cloth_measurement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cloth_measurement_cloth_id_foreign` (`cloth_id`),
  ADD KEY `cloth_measurement_measurement_id_foreign` (`measurement_id`);

--
-- Indexes for table `cloth_orders`
--
ALTER TABLE `cloth_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_tax_id_foreign` (`tax_id`),
  ADD KEY `transactions_business_id_index` (`business_id`),
  ADD KEY `transactions_type_index` (`type`),
  ADD KEY `transactions_contact_id_index` (`contact_id`),
  ADD KEY `transactions_transaction_date_index` (`transaction_date`),
  ADD KEY `transactions_created_by_index` (`created_by`),
  ADD KEY `transactions_location_id_index` (`location_id`),
  ADD KEY `transactions_expense_for_foreign` (`expense_for`),
  ADD KEY `transactions_expense_category_id_index` (`expense_category_id`),
  ADD KEY `transactions_sub_type_index` (`sub_type`),
  ADD KEY `transactions_return_parent_id_index` (`return_parent_id`),
  ADD KEY `type` (`type`),
  ADD KEY `transactions_status_index` (`status`),
  ADD KEY `transactions_sub_status_index` (`sub_status`),
  ADD KEY `transactions_res_table_id_index` (`res_table_id`),
  ADD KEY `transactions_res_waiter_id_index` (`res_waiter_id`),
  ADD KEY `transactions_res_order_status_index` (`res_order_status`),
  ADD KEY `transactions_payment_status_index` (`payment_status`),
  ADD KEY `transactions_discount_type_index` (`discount_type`),
  ADD KEY `transactions_commission_agent_index` (`commission_agent`),
  ADD KEY `transactions_transfer_parent_id_index` (`transfer_parent_id`),
  ADD KEY `transactions_types_of_service_id_index` (`types_of_service_id`),
  ADD KEY `transactions_packing_charge_type_index` (`packing_charge_type`),
  ADD KEY `transactions_recur_parent_id_index` (`recur_parent_id`),
  ADD KEY `transactions_selling_price_group_id_index` (`selling_price_group_id`),
  ADD KEY `transactions_delivery_date_index` (`delivery_date`),
  ADD KEY `transactions_delivery_person_index` (`delivery_person`),
  ADD KEY `transactions_woocommerce_order_id_index` (`woocommerce_order_id`);

--
-- Indexes for table `cloth_order_lines`
--
ALTER TABLE `cloth_order_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_sell_lines_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_sell_lines_product_id_foreign` (`product_id`),
  ADD KEY `transaction_sell_lines_variation_id_foreign` (`variation_id`),
  ADD KEY `transaction_sell_lines_tax_id_foreign` (`tax_id`),
  ADD KEY `transaction_sell_lines_children_type_index` (`children_type`),
  ADD KEY `transaction_sell_lines_parent_sell_line_id_index` (`parent_sell_line_id`),
  ADD KEY `transaction_sell_lines_line_discount_type_index` (`line_discount_type`),
  ADD KEY `transaction_sell_lines_discount_id_index` (`discount_id`),
  ADD KEY `transaction_sell_lines_lot_no_line_id_index` (`lot_no_line_id`),
  ADD KEY `transaction_sell_lines_sub_unit_id_index` (`sub_unit_id`),
  ADD KEY `transaction_sell_lines_woocommerce_line_items_id_index` (`woocommerce_line_items_id`);

--
-- Indexes for table `cloth_order_lines_purchase_lines`
--
ALTER TABLE `cloth_order_lines_purchase_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sell_line_id` (`sell_line_id`),
  ADD KEY `stock_adjustment_line_id` (`stock_adjustment_line_id`),
  ADD KEY `purchase_line_id` (`purchase_line_id`);

--
-- Indexes for table `cloth_order_payments`
--
ALTER TABLE `cloth_order_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_payments_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_payments_created_by_index` (`created_by`),
  ADD KEY `transaction_payments_parent_id_index` (`parent_id`),
  ADD KEY `transaction_payments_payment_type_index` (`payment_type`);

--
-- Indexes for table `cloth_style`
--
ALTER TABLE `cloth_style`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cloth_style_cloth_id_foreign` (`cloth_id`),
  ADD KEY `cloth_style_style_id_foreign` (`style_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_business_id_foreign` (`business_id`),
  ADD KEY `contacts_created_by_foreign` (`created_by`),
  ADD KEY `contacts_type_index` (`type`),
  ADD KEY `contacts_contact_status_index` (`contact_status`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_groups_business_id_foreign` (`business_id`),
  ADD KEY `customer_groups_created_by_index` (`created_by`),
  ADD KEY `customer_groups_price_calculation_type_index` (`price_calculation_type`),
  ADD KEY `customer_groups_selling_price_group_id_index` (`selling_price_group_id`);

--
-- Indexes for table `dashboard_configurations`
--
ALTER TABLE `dashboard_configurations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dashboard_configurations_business_id_foreign` (`business_id`);

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designs_style_id_foreign` (`style_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_business_id_index` (`business_id`),
  ADD KEY `discounts_brand_id_index` (`brand_id`),
  ADD KEY `discounts_category_id_index` (`category_id`),
  ADD KEY `discounts_location_id_index` (`location_id`),
  ADD KEY `discounts_priority_index` (`priority`),
  ADD KEY `discounts_spg_index` (`spg`);

--
-- Indexes for table `discount_variations`
--
ALTER TABLE `discount_variations`
  ADD KEY `discount_variations_discount_id_index` (`discount_id`),
  ADD KEY `discount_variations_variation_id_index` (`variation_id`);

--
-- Indexes for table `document_and_notes`
--
ALTER TABLE `document_and_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_and_notes_business_id_index` (`business_id`),
  ADD KEY `document_and_notes_notable_id_index` (`notable_id`),
  ADD KEY `document_and_notes_created_by_index` (`created_by`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_categories_business_id_foreign` (`business_id`);

--
-- Indexes for table `group_sub_taxes`
--
ALTER TABLE `group_sub_taxes`
  ADD KEY `group_sub_taxes_group_tax_id_foreign` (`group_tax_id`),
  ADD KEY `group_sub_taxes_tax_id_foreign` (`tax_id`);

--
-- Indexes for table `invoice_layouts`
--
ALTER TABLE `invoice_layouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_layouts_business_id_foreign` (`business_id`);

--
-- Indexes for table `invoice_schemes`
--
ALTER TABLE `invoice_schemes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_schemes_business_id_foreign` (`business_id`),
  ADD KEY `invoice_schemes_scheme_type_index` (`scheme_type`),
  ADD KEY `invoice_schemes_number_type_index` (`number_type`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `measurements_business_id_foreign` (`business_id`),
  ADD KEY `measurements_created_by_foreign` (`created_by`),
  ADD KEY `measurements_serial_no_unique` (`serial_no`) USING BTREE;

--
-- Indexes for table `measurement_sub_measurement`
--
ALTER TABLE `measurement_sub_measurement`
  ADD PRIMARY KEY (`measurement_id`,`sub_measurement_id`),
  ADD KEY `measurement_sub_measurement_sub_measurement_id_foreign` (`sub_measurement_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_business_id_index` (`business_id`),
  ADD KEY `media_uploaded_by_index` (`uploaded_by`),
  ADD KEY `media_woocommerce_media_id_index` (`woocommerce_media_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `printers`
--
ALTER TABLE `printers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `printers_business_id_foreign` (`business_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_tax_foreign` (`tax`),
  ADD KEY `products_name_index` (`name`),
  ADD KEY `products_business_id_index` (`business_id`),
  ADD KEY `products_unit_id_index` (`unit_id`),
  ADD KEY `products_created_by_index` (`created_by`),
  ADD KEY `products_warranty_id_index` (`warranty_id`),
  ADD KEY `products_type_index` (`type`),
  ADD KEY `products_tax_type_index` (`tax_type`),
  ADD KEY `products_barcode_type_index` (`barcode_type`),
  ADD KEY `products_secondary_unit_id_index` (`secondary_unit_id`),
  ADD KEY `products_woocommerce_product_id_index` (`woocommerce_product_id`),
  ADD KEY `products_woocommerce_media_id_index` (`woocommerce_media_id`);

--
-- Indexes for table `product_locations`
--
ALTER TABLE `product_locations`
  ADD KEY `product_locations_product_id_index` (`product_id`),
  ADD KEY `product_locations_location_id_index` (`location_id`);

--
-- Indexes for table `product_racks`
--
ALTER TABLE `product_racks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_racks_business_id_index` (`business_id`),
  ADD KEY `product_racks_location_id_index` (`location_id`),
  ADD KEY `product_racks_product_id_index` (`product_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variations_name_index` (`name`),
  ADD KEY `product_variations_product_id_index` (`product_id`);

--
-- Indexes for table `purchase_lines`
--
ALTER TABLE `purchase_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_lines_transaction_id_foreign` (`transaction_id`),
  ADD KEY `purchase_lines_product_id_foreign` (`product_id`),
  ADD KEY `purchase_lines_variation_id_foreign` (`variation_id`),
  ADD KEY `purchase_lines_tax_id_foreign` (`tax_id`),
  ADD KEY `purchase_lines_sub_unit_id_index` (`sub_unit_id`),
  ADD KEY `purchase_lines_lot_number_index` (`lot_number`);

--
-- Indexes for table `reference_counts`
--
ALTER TABLE `reference_counts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reference_counts_business_id_index` (`business_id`);

--
-- Indexes for table `res_product_modifier_sets`
--
ALTER TABLE `res_product_modifier_sets`
  ADD KEY `res_product_modifier_sets_modifier_set_id_foreign` (`modifier_set_id`);

--
-- Indexes for table `res_tables`
--
ALTER TABLE `res_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `res_tables_business_id_foreign` (`business_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_business_id_foreign` (`business_id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `selling_price_groups`
--
ALTER TABLE `selling_price_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `selling_price_groups_business_id_foreign` (`business_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `stock_adjustment_lines`
--
ALTER TABLE `stock_adjustment_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_adjustment_lines_product_id_foreign` (`product_id`),
  ADD KEY `stock_adjustment_lines_variation_id_foreign` (`variation_id`),
  ADD KEY `stock_adjustment_lines_transaction_id_index` (`transaction_id`),
  ADD KEY `stock_adjustment_lines_lot_no_line_id_index` (`lot_no_line_id`);

--
-- Indexes for table `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `styles_business_id_foreign` (`business_id`),
  ADD KEY `styles_created_by_foreign` (`created_by`),
  ADD KEY `styles_serial_no_unique` (`serial_no`) USING BTREE;

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_business_id_foreign` (`business_id`),
  ADD KEY `subscriptions_package_id_index` (`package_id`),
  ADD KEY `subscriptions_created_id_index` (`created_id`);

--
-- Indexes for table `sub_measurements`
--
ALTER TABLE `sub_measurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_measurements_business_id_foreign` (`business_id`),
  ADD KEY `sub_measurements_created_by_foreign` (`created_by`),
  ADD KEY `sub_measurements_serial_no_unique` (`serial_no`) USING BTREE;

--
-- Indexes for table `superadmin_communicator_logs`
--
ALTER TABLE `superadmin_communicator_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superadmin_coupons`
--
ALTER TABLE `superadmin_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superadmin_frontend_pages`
--
ALTER TABLE `superadmin_frontend_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tax_rates_business_id_foreign` (`business_id`),
  ADD KEY `tax_rates_created_by_foreign` (`created_by`),
  ADD KEY `tax_rates_woocommerce_tax_rate_id_index` (`woocommerce_tax_rate_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_tax_id_foreign` (`tax_id`),
  ADD KEY `transactions_business_id_index` (`business_id`),
  ADD KEY `transactions_type_index` (`type`),
  ADD KEY `transactions_contact_id_index` (`contact_id`),
  ADD KEY `transactions_transaction_date_index` (`transaction_date`),
  ADD KEY `transactions_created_by_index` (`created_by`),
  ADD KEY `transactions_location_id_index` (`location_id`),
  ADD KEY `transactions_expense_for_foreign` (`expense_for`),
  ADD KEY `transactions_expense_category_id_index` (`expense_category_id`),
  ADD KEY `transactions_sub_type_index` (`sub_type`),
  ADD KEY `transactions_return_parent_id_index` (`return_parent_id`),
  ADD KEY `type` (`type`),
  ADD KEY `transactions_status_index` (`status`),
  ADD KEY `transactions_sub_status_index` (`sub_status`),
  ADD KEY `transactions_res_table_id_index` (`res_table_id`),
  ADD KEY `transactions_res_waiter_id_index` (`res_waiter_id`),
  ADD KEY `transactions_res_order_status_index` (`res_order_status`),
  ADD KEY `transactions_payment_status_index` (`payment_status`),
  ADD KEY `transactions_discount_type_index` (`discount_type`),
  ADD KEY `transactions_commission_agent_index` (`commission_agent`),
  ADD KEY `transactions_transfer_parent_id_index` (`transfer_parent_id`),
  ADD KEY `transactions_types_of_service_id_index` (`types_of_service_id`),
  ADD KEY `transactions_packing_charge_type_index` (`packing_charge_type`),
  ADD KEY `transactions_recur_parent_id_index` (`recur_parent_id`),
  ADD KEY `transactions_selling_price_group_id_index` (`selling_price_group_id`),
  ADD KEY `transactions_delivery_date_index` (`delivery_date`),
  ADD KEY `transactions_delivery_person_index` (`delivery_person`),
  ADD KEY `transactions_woocommerce_order_id_index` (`woocommerce_order_id`);

--
-- Indexes for table `transaction_payments`
--
ALTER TABLE `transaction_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_payments_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_payments_created_by_index` (`created_by`),
  ADD KEY `transaction_payments_parent_id_index` (`parent_id`),
  ADD KEY `transaction_payments_payment_type_index` (`payment_type`);

--
-- Indexes for table `transaction_sell_lines`
--
ALTER TABLE `transaction_sell_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_sell_lines_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_sell_lines_product_id_foreign` (`product_id`),
  ADD KEY `transaction_sell_lines_variation_id_foreign` (`variation_id`),
  ADD KEY `transaction_sell_lines_tax_id_foreign` (`tax_id`),
  ADD KEY `transaction_sell_lines_children_type_index` (`children_type`),
  ADD KEY `transaction_sell_lines_parent_sell_line_id_index` (`parent_sell_line_id`),
  ADD KEY `transaction_sell_lines_line_discount_type_index` (`line_discount_type`),
  ADD KEY `transaction_sell_lines_discount_id_index` (`discount_id`),
  ADD KEY `transaction_sell_lines_lot_no_line_id_index` (`lot_no_line_id`),
  ADD KEY `transaction_sell_lines_sub_unit_id_index` (`sub_unit_id`),
  ADD KEY `transaction_sell_lines_woocommerce_line_items_id_index` (`woocommerce_line_items_id`),
  ADD KEY `transaction_sell_lines_cloth_id_foreign` (`cloth_id`);

--
-- Indexes for table `transaction_sell_lines_purchase_lines`
--
ALTER TABLE `transaction_sell_lines_purchase_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sell_line_id` (`sell_line_id`),
  ADD KEY `stock_adjustment_line_id` (`stock_adjustment_line_id`),
  ADD KEY `purchase_line_id` (`purchase_line_id`);

--
-- Indexes for table `types_of_services`
--
ALTER TABLE `types_of_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `types_of_services_business_id_index` (`business_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `units_business_id_foreign` (`business_id`),
  ADD KEY `units_created_by_foreign` (`created_by`),
  ADD KEY `units_base_unit_id_index` (`base_unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_business_id_foreign` (`business_id`),
  ADD KEY `users_user_type_index` (`user_type`),
  ADD KEY `users_crm_contact_id_foreign` (`crm_contact_id`);

--
-- Indexes for table `user_contact_access`
--
ALTER TABLE `user_contact_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_contact_access_user_id_index` (`user_id`),
  ADD KEY `user_contact_access_contact_id_index` (`contact_id`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variations_product_id_foreign` (`product_id`),
  ADD KEY `variations_product_variation_id_foreign` (`product_variation_id`),
  ADD KEY `variations_name_index` (`name`),
  ADD KEY `variations_sub_sku_index` (`sub_sku`),
  ADD KEY `variations_variation_value_id_index` (`variation_value_id`),
  ADD KEY `variations_woocommerce_variation_id_index` (`woocommerce_variation_id`);

--
-- Indexes for table `variation_group_prices`
--
ALTER TABLE `variation_group_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_group_prices_variation_id_foreign` (`variation_id`),
  ADD KEY `variation_group_prices_price_group_id_foreign` (`price_group_id`);

--
-- Indexes for table `variation_location_details`
--
ALTER TABLE `variation_location_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_location_details_location_id_foreign` (`location_id`),
  ADD KEY `variation_location_details_product_id_index` (`product_id`),
  ADD KEY `variation_location_details_product_variation_id_index` (`product_variation_id`),
  ADD KEY `variation_location_details_variation_id_index` (`variation_id`);

--
-- Indexes for table `variation_templates`
--
ALTER TABLE `variation_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_templates_business_id_foreign` (`business_id`),
  ADD KEY `variation_templates_woocommerce_attr_id_index` (`woocommerce_attr_id`);

--
-- Indexes for table `variation_value_templates`
--
ALTER TABLE `variation_value_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_value_templates_name_index` (`name`),
  ADD KEY `variation_value_templates_variation_template_id_index` (`variation_template_id`);

--
-- Indexes for table `warranties`
--
ALTER TABLE `warranties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warranties_business_id_index` (`business_id`),
  ADD KEY `warranties_duration_type_index` (`duration_type`);

--
-- Indexes for table `woocommerce_sync_logs`
--
ALTER TABLE `woocommerce_sync_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `account_transactions`
--
ALTER TABLE `account_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=404;

--
-- AUTO_INCREMENT for table `barcodes`
--
ALTER TABLE `barcodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `business_locations`
--
ALTER TABLE `business_locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cash_denominations`
--
ALTER TABLE `cash_denominations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_registers`
--
ALTER TABLE `cash_registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cash_register_transactions`
--
ALTER TABLE `cash_register_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cloths`
--
ALTER TABLE `cloths`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `cloth_customizations`
--
ALTER TABLE `cloth_customizations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cloth_measurement`
--
ALTER TABLE `cloth_measurement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `cloth_orders`
--
ALTER TABLE `cloth_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cloth_order_lines`
--
ALTER TABLE `cloth_order_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cloth_order_lines_purchase_lines`
--
ALTER TABLE `cloth_order_lines_purchase_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cloth_order_payments`
--
ALTER TABLE `cloth_order_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cloth_style`
--
ALTER TABLE `cloth_style`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dashboard_configurations`
--
ALTER TABLE `dashboard_configurations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_and_notes`
--
ALTER TABLE `document_and_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_layouts`
--
ALTER TABLE `invoice_layouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_schemes`
--
ALTER TABLE `invoice_schemes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `printers`
--
ALTER TABLE `printers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_racks`
--
ALTER TABLE `product_racks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchase_lines`
--
ALTER TABLE `purchase_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reference_counts`
--
ALTER TABLE `reference_counts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `res_tables`
--
ALTER TABLE `res_tables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `selling_price_groups`
--
ALTER TABLE `selling_price_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_adjustment_lines`
--
ALTER TABLE `stock_adjustment_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `styles`
--
ALTER TABLE `styles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_measurements`
--
ALTER TABLE `sub_measurements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `superadmin_communicator_logs`
--
ALTER TABLE `superadmin_communicator_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `superadmin_coupons`
--
ALTER TABLE `superadmin_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `superadmin_frontend_pages`
--
ALTER TABLE `superadmin_frontend_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tax_rates`
--
ALTER TABLE `tax_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `transaction_payments`
--
ALTER TABLE `transaction_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `transaction_sell_lines`
--
ALTER TABLE `transaction_sell_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `transaction_sell_lines_purchase_lines`
--
ALTER TABLE `transaction_sell_lines_purchase_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `types_of_services`
--
ALTER TABLE `types_of_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_contact_access`
--
ALTER TABLE `user_contact_access`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `variation_group_prices`
--
ALTER TABLE `variation_group_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variation_location_details`
--
ALTER TABLE `variation_location_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `variation_templates`
--
ALTER TABLE `variation_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variation_value_templates`
--
ALTER TABLE `variation_value_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warranties`
--
ALTER TABLE `warranties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `woocommerce_sync_logs`
--
ALTER TABLE `woocommerce_sync_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barcodes`
--
ALTER TABLE `barcodes`
  ADD CONSTRAINT `barcodes_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brands_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `business_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `business_default_sales_tax_foreign` FOREIGN KEY (`default_sales_tax`) REFERENCES `tax_rates` (`id`),
  ADD CONSTRAINT `business_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `business_locations`
--
ALTER TABLE `business_locations`
  ADD CONSTRAINT `business_locations_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `business_locations_invoice_layout_id_foreign` FOREIGN KEY (`invoice_layout_id`) REFERENCES `invoice_layouts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `business_locations_invoice_scheme_id_foreign` FOREIGN KEY (`invoice_scheme_id`) REFERENCES `invoice_schemes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cash_registers`
--
ALTER TABLE `cash_registers`
  ADD CONSTRAINT `cash_registers_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cash_registers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cash_register_transactions`
--
ALTER TABLE `cash_register_transactions`
  ADD CONSTRAINT `cash_register_transactions_cash_register_id_foreign` FOREIGN KEY (`cash_register_id`) REFERENCES `cash_registers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cloths`
--
ALTER TABLE `cloths`
  ADD CONSTRAINT `cloths_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cloths_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cloth_customizations`
--
ALTER TABLE `cloth_customizations`
  ADD CONSTRAINT `cloth_customizations_cloth_id_foreign` FOREIGN KEY (`cloth_id`) REFERENCES `cloths` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cloth_customizations_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cloth_measurement`
--
ALTER TABLE `cloth_measurement`
  ADD CONSTRAINT `cloth_measurement_cloth_id_foreign` FOREIGN KEY (`cloth_id`) REFERENCES `cloths` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cloth_measurement_measurement_id_foreign` FOREIGN KEY (`measurement_id`) REFERENCES `measurements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cloth_style`
--
ALTER TABLE `cloth_style`
  ADD CONSTRAINT `cloth_style_cloth_id_foreign` FOREIGN KEY (`cloth_id`) REFERENCES `cloths` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cloth_style_style_id_foreign` FOREIGN KEY (`style_id`) REFERENCES `styles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contacts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD CONSTRAINT `customer_groups_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dashboard_configurations`
--
ALTER TABLE `dashboard_configurations`
  ADD CONSTRAINT `dashboard_configurations_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `designs`
--
ALTER TABLE `designs`
  ADD CONSTRAINT `designs_style_id_foreign` FOREIGN KEY (`style_id`) REFERENCES `styles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD CONSTRAINT `expense_categories_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_sub_taxes`
--
ALTER TABLE `group_sub_taxes`
  ADD CONSTRAINT `group_sub_taxes_group_tax_id_foreign` FOREIGN KEY (`group_tax_id`) REFERENCES `tax_rates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_sub_taxes_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax_rates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_layouts`
--
ALTER TABLE `invoice_layouts`
  ADD CONSTRAINT `invoice_layouts_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_schemes`
--
ALTER TABLE `invoice_schemes`
  ADD CONSTRAINT `invoice_schemes_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `measurements`
--
ALTER TABLE `measurements`
  ADD CONSTRAINT `measurements_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `measurements_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `measurement_sub_measurement`
--
ALTER TABLE `measurement_sub_measurement`
  ADD CONSTRAINT `measurement_sub_measurement_measurement_id_foreign` FOREIGN KEY (`measurement_id`) REFERENCES `measurements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `measurement_sub_measurement_sub_measurement_id_foreign` FOREIGN KEY (`sub_measurement_id`) REFERENCES `sub_measurements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `printers`
--
ALTER TABLE `printers`
  ADD CONSTRAINT `printers_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_tax_foreign` FOREIGN KEY (`tax`) REFERENCES `tax_rates` (`id`),
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_lines`
--
ALTER TABLE `purchase_lines`
  ADD CONSTRAINT `purchase_lines_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_lines_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax_rates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_lines_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_lines_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `res_product_modifier_sets`
--
ALTER TABLE `res_product_modifier_sets`
  ADD CONSTRAINT `res_product_modifier_sets_modifier_set_id_foreign` FOREIGN KEY (`modifier_set_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `res_tables`
--
ALTER TABLE `res_tables`
  ADD CONSTRAINT `res_tables_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `selling_price_groups`
--
ALTER TABLE `selling_price_groups`
  ADD CONSTRAINT `selling_price_groups_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_adjustment_lines`
--
ALTER TABLE `stock_adjustment_lines`
  ADD CONSTRAINT `stock_adjustment_lines_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_adjustment_lines_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_adjustment_lines_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `styles`
--
ALTER TABLE `styles`
  ADD CONSTRAINT `styles_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `styles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_measurements`
--
ALTER TABLE `sub_measurements`
  ADD CONSTRAINT `sub_measurements_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_measurements_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD CONSTRAINT `tax_rates_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tax_rates_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_expense_for_foreign` FOREIGN KEY (`expense_for`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `business_locations` (`id`),
  ADD CONSTRAINT `transactions_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax_rates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_payments`
--
ALTER TABLE `transaction_payments`
  ADD CONSTRAINT `transaction_payments_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_sell_lines`
--
ALTER TABLE `transaction_sell_lines`
  ADD CONSTRAINT `transaction_sell_lines_cloth_id_foreign` FOREIGN KEY (`cloth_id`) REFERENCES `cloths` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_sell_lines_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_sell_lines_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax_rates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_sell_lines_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_sell_lines_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `units_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_crm_contact_id_foreign` FOREIGN KEY (`crm_contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variations`
--
ALTER TABLE `variations`
  ADD CONSTRAINT `variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `variations_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variation_group_prices`
--
ALTER TABLE `variation_group_prices`
  ADD CONSTRAINT `variation_group_prices_price_group_id_foreign` FOREIGN KEY (`price_group_id`) REFERENCES `selling_price_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `variation_group_prices_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variation_location_details`
--
ALTER TABLE `variation_location_details`
  ADD CONSTRAINT `variation_location_details_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `business_locations` (`id`),
  ADD CONSTRAINT `variation_location_details_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`);

--
-- Constraints for table `variation_templates`
--
ALTER TABLE `variation_templates`
  ADD CONSTRAINT `variation_templates_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variation_value_templates`
--
ALTER TABLE `variation_value_templates`
  ADD CONSTRAINT `variation_value_templates_variation_template_id_foreign` FOREIGN KEY (`variation_template_id`) REFERENCES `variation_templates` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
