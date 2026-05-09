-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2026 at 02:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peerconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_logs`
--

CREATE TABLE `access_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `method` varchar(10) NOT NULL,
  `path` varchar(255) NOT NULL,
  `route_name` varchar(255) DEFAULT NULL,
  `status_code` smallint(5) UNSIGNED NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `access_logs`
--

INSERT INTO `access_logs` (`id`, `user_id`, `method`, `path`, `route_name`, `status_code`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, NULL, 'GET', 'login', 'login', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', '2026-05-07 07:40:40', '2026-05-07 07:40:40'),
(2, 1, 'POST', 'login', 'login.store', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', '2026-05-07 07:40:40', '2026-05-07 07:40:40'),
(3, 1, 'GET', 'admin', 'admin.dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', '2026-05-07 07:40:41', '2026-05-07 07:40:41'),
(4, 1, 'GET', 'admin/access-logs/export', 'admin.access-logs.export', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', '2026-05-07 07:40:41', '2026-05-07 07:40:41'),
(5, NULL, 'GET', '/', 'home', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:41:53', '2026-05-07 07:41:53'),
(6, NULL, 'GET', 'login', 'login', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:42:07', '2026-05-07 07:42:07'),
(7, 1, 'POST', 'login', 'login.store', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:42:18', '2026-05-07 07:42:18'),
(8, 1, 'GET', 'admin', 'admin.dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:42:18', '2026-05-07 07:42:18'),
(9, 1, 'GET', 'admin/access-logs/export', 'admin.access-logs.export', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:42:29', '2026-05-07 07:42:29'),
(10, 1, 'GET', 'admin', 'admin.dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:43:44', '2026-05-07 07:43:44'),
(11, 1, 'GET', 'profiles', 'profiles.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:43:46', '2026-05-07 07:43:46'),
(12, 1, 'GET', 'profiles', 'profiles.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:06', '2026-05-07 07:44:06'),
(13, 1, 'GET', 'profiles', 'profiles.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:09', '2026-05-07 07:44:09'),
(14, 1, 'GET', 'profiles', 'profiles.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:11', '2026-05-07 07:44:11'),
(15, 1, 'GET', 'profiles', 'profiles.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:17', '2026-05-07 07:44:17'),
(16, 1, 'GET', 'dashboard', 'dashboard', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:23', '2026-05-07 07:44:23'),
(17, 1, 'GET', 'profiles', 'profiles.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:23', '2026-05-07 07:44:23'),
(18, 1, 'GET', 'contact-messages', 'contact-messages.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:28', '2026-05-07 07:44:28'),
(19, 1, 'GET', 'messages', 'messages.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:33', '2026-05-07 07:44:33'),
(20, 1, 'GET', 'connections', 'connections.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:34', '2026-05-07 07:44:34'),
(21, 1, 'GET', 'interests', 'interests.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:36', '2026-05-07 07:44:36'),
(22, 1, 'GET', 'admin', 'admin.dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:38', '2026-05-07 07:44:38'),
(23, NULL, 'POST', 'logout', 'logout', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:42', '2026-05-07 07:44:42'),
(24, NULL, 'GET', '/', 'home', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:42', '2026-05-07 07:44:42'),
(25, NULL, 'GET', 'login', 'login', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:45', '2026-05-07 07:44:45'),
(26, NULL, 'POST', 'login', 'login.store', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:50', '2026-05-07 07:44:50'),
(27, NULL, 'GET', 'login', 'login', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:50', '2026-05-07 07:44:50'),
(28, NULL, 'POST', 'login', 'login.store', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:57', '2026-05-07 07:44:57'),
(29, NULL, 'GET', 'login', 'login', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 07:44:57', '2026-05-07 07:44:57'),
(30, NULL, 'GET', 'login', 'login', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', '2026-05-07 07:58:39', '2026-05-07 07:58:39'),
(31, 2, 'POST', 'login', 'login.store', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', '2026-05-07 07:58:40', '2026-05-07 07:58:40'),
(32, 2, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', '2026-05-07 07:58:40', '2026-05-07 07:58:40'),
(33, NULL, 'GET', 'login', 'login', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', '2026-05-07 07:58:41', '2026-05-07 07:58:41'),
(34, 1, 'POST', 'login', 'login.store', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', '2026-05-07 07:58:41', '2026-05-07 07:58:41'),
(35, 1, 'GET', 'admin', 'admin.dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', '2026-05-07 07:58:42', '2026-05-07 07:58:42'),
(36, NULL, 'GET', '/', 'home', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:00:17', '2026-05-07 08:00:17'),
(37, NULL, 'GET', 'login', 'login', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:00:21', '2026-05-07 08:00:21'),
(38, 2, 'POST', 'login', 'login.store', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:00:35', '2026-05-07 08:00:35'),
(39, 2, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:00:35', '2026-05-07 08:00:35'),
(40, 2, 'POST', 'dashboard/react/7', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:00:59', '2026-05-07 08:00:59'),
(41, 2, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:00:59', '2026-05-07 08:00:59'),
(42, 2, 'POST', 'dashboard/react/8', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:06', '2026-05-07 08:01:06'),
(43, 2, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:07', '2026-05-07 08:01:07'),
(44, 2, 'POST', 'dashboard/react/6', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:15', '2026-05-07 08:01:15'),
(45, 2, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:15', '2026-05-07 08:01:15'),
(46, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:17', '2026-05-07 08:01:17'),
(47, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:17', '2026-05-07 08:01:17'),
(48, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:18', '2026-05-07 08:01:18'),
(49, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:18', '2026-05-07 08:01:18'),
(50, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:18', '2026-05-07 08:01:18'),
(51, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:18', '2026-05-07 08:01:18'),
(52, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:18', '2026-05-07 08:01:18'),
(53, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:18', '2026-05-07 08:01:18'),
(54, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:19', '2026-05-07 08:01:19'),
(55, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:19', '2026-05-07 08:01:19'),
(56, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:19', '2026-05-07 08:01:19'),
(57, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:19', '2026-05-07 08:01:19'),
(58, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:19', '2026-05-07 08:01:19'),
(59, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:20', '2026-05-07 08:01:20'),
(60, 2, 'POST', 'dashboard/react/16', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:20', '2026-05-07 08:01:20'),
(61, 2, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:20', '2026-05-07 08:01:20'),
(62, 2, 'POST', 'dashboard/react/20', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:23', '2026-05-07 08:01:23'),
(63, 2, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:24', '2026-05-07 08:01:24'),
(64, 2, 'POST', 'dashboard/react/15', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:27', '2026-05-07 08:01:27'),
(65, 2, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:27', '2026-05-07 08:01:27'),
(66, 2, 'POST', 'dashboard/react/18', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:30', '2026-05-07 08:01:30'),
(67, 2, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:30', '2026-05-07 08:01:30'),
(68, 2, 'POST', 'dashboard/react/17', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:41', '2026-05-07 08:01:41'),
(69, 2, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:41', '2026-05-07 08:01:41'),
(70, 2, 'POST', 'dashboard/react/5', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:44', '2026-05-07 08:01:44'),
(71, 2, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:44', '2026-05-07 08:01:44'),
(72, 2, 'POST', 'dashboard/react/19', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:52', '2026-05-07 08:01:52'),
(73, 2, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:53', '2026-05-07 08:01:53'),
(74, NULL, 'POST', 'logout', 'logout', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:56', '2026-05-07 08:01:56'),
(75, NULL, 'GET', '/', 'home', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:56', '2026-05-07 08:01:56'),
(76, NULL, 'GET', 'login', 'login', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:01:58', '2026-05-07 08:01:58'),
(77, 6, 'POST', 'login', 'login.store', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:02:24', '2026-05-07 08:02:24'),
(78, 6, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:02:24', '2026-05-07 08:02:24'),
(79, 6, 'POST', 'dashboard/react/1', 'dashboard.react', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:02:31', '2026-05-07 08:02:31'),
(80, 6, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:02:31', '2026-05-07 08:02:31'),
(81, 6, 'GET', 'connections/11', 'connections.show', 403, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:02:35', '2026-05-07 08:02:35'),
(82, 6, 'GET', 'contact', 'contact', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:02:53', '2026-05-07 08:02:53'),
(83, 6, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:02:55', '2026-05-07 08:02:55'),
(84, 6, 'GET', 'profiles', 'profiles.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:03:02', '2026-05-07 08:03:02'),
(85, 6, 'GET', 'dashboard', 'dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:03:04', '2026-05-07 08:03:04'),
(86, NULL, 'POST', 'logout', 'logout', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:03:10', '2026-05-07 08:03:10'),
(87, NULL, 'GET', '/', 'home', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:03:10', '2026-05-07 08:03:10'),
(88, NULL, 'GET', 'login', 'login', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:03:20', '2026-05-07 08:03:20'),
(89, NULL, 'GET', '/', 'home', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:36:25', '2026-05-07 08:36:25'),
(90, NULL, 'GET', '/', 'home', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:36:26', '2026-05-07 08:36:26'),
(91, NULL, 'GET', 'login', 'login', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:37:50', '2026-05-07 08:37:50'),
(92, 1, 'POST', 'login', 'login.store', 302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:38:03', '2026-05-07 08:38:03'),
(93, 1, 'GET', 'admin', 'admin.dashboard', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:38:06', '2026-05-07 08:38:06'),
(94, 1, 'GET', 'interests', 'interests.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:38:36', '2026-05-07 08:38:36'),
(95, 1, 'GET', 'contact', 'contact', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:38:56', '2026-05-07 08:38:56'),
(96, 1, 'GET', 'profiles', 'profiles.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:38:58', '2026-05-07 08:38:58'),
(97, 1, 'GET', 'profiles', 'profiles.index', 200, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', '2026-05-07 08:39:04', '2026-05-07 08:39:04');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `connections`
--

CREATE TABLE `connections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'liked',
  `note` text DEFAULT NULL,
  `matched_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `connections`
--

INSERT INTO `connections` (`id`, `sender_id`, `receiver_id`, `status`, `note`, `matched_at`, `created_at`, `updated_at`) VALUES
(1, 2, 8, 'liked', NULL, NULL, '2026-05-07 08:00:59', '2026-05-07 08:00:59'),
(2, 2, 9, 'liked', NULL, NULL, '2026-05-07 08:01:06', '2026-05-07 08:01:06'),
(3, 2, 7, 'liked', NULL, NULL, '2026-05-07 08:01:15', '2026-05-07 08:01:15'),
(4, 2, 17, 'liked', NULL, NULL, '2026-05-07 08:01:17', '2026-05-07 08:01:17'),
(5, 2, 21, 'liked', NULL, NULL, '2026-05-07 08:01:23', '2026-05-07 08:01:23'),
(6, 2, 16, 'liked', NULL, NULL, '2026-05-07 08:01:27', '2026-05-07 08:01:27'),
(7, 2, 19, 'liked', NULL, NULL, '2026-05-07 08:01:30', '2026-05-07 08:01:30'),
(8, 2, 18, 'liked', NULL, NULL, '2026-05-07 08:01:41', '2026-05-07 08:01:41'),
(9, 2, 6, 'matched', NULL, '2026-05-07 08:02:31', '2026-05-07 08:01:44', '2026-05-07 08:02:31'),
(10, 2, 20, 'liked', NULL, NULL, '2026-05-07 08:01:52', '2026-05-07 08:01:52'),
(11, 6, 2, 'matched', NULL, '2026-05-07 08:02:31', '2026-05-07 08:02:31', '2026-05-07 08:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_resolved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `name`, `category`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Laravel', 'Web', 'Building MVC applications with Laravel.', '2026-05-07 07:33:41', '2026-05-07 07:33:41'),
(2, 'Data Analysis', 'BI', 'Dashboards, reporting, and data-driven decisions.', '2026-05-07 07:33:41', '2026-05-07 07:33:41'),
(3, 'UX Design', 'Design', 'Creating friendly interfaces for real users.', '2026-05-07 07:33:41', '2026-05-07 07:33:41'),
(4, 'Machine Learning', 'AI', 'Introductory AI and prediction projects.', '2026-05-07 07:33:41', '2026-05-07 07:33:41'),
(5, 'Project Management', 'Professional Skills', 'Planning, teamwork, and presentations.', '2026-05-07 07:33:41', '2026-05-07 07:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `interest_profile`
--

CREATE TABLE `interest_profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `interest_id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interest_profile`
--

INSERT INTO `interest_profile` (`id`, `interest_id`, `profile_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(2, 2, 1, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(3, 5, 1, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(4, 2, 2, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(5, 3, 2, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(6, 5, 2, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(7, 2, 3, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(8, 4, 3, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(9, 5, 3, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(10, 1, 4, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(11, 5, 4, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(12, 1, 5, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(13, 3, 5, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(14, 5, 5, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(15, 2, 6, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(16, 5, 6, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(17, 2, 7, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(18, 4, 7, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(19, 5, 7, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(20, 3, 8, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(21, 5, 8, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(22, 3, 9, '2026-05-07 07:58:15', '2026-05-07 07:58:15'),
(23, 5, 9, '2026-05-07 07:58:15', '2026-05-07 07:58:15'),
(24, 2, 10, '2026-05-07 07:58:15', '2026-05-07 07:58:15'),
(25, 5, 10, '2026-05-07 07:58:15', '2026-05-07 07:58:15'),
(26, 2, 11, '2026-05-07 07:58:15', '2026-05-07 07:58:15'),
(27, 4, 11, '2026-05-07 07:58:15', '2026-05-07 07:58:15'),
(28, 1, 12, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(29, 5, 12, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(30, 3, 13, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(31, 5, 13, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(32, 1, 14, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(33, 2, 14, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(34, 1, 15, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(35, 2, 15, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(36, 5, 16, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(37, 2, 17, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(38, 3, 17, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(39, 4, 18, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(40, 5, 18, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(41, 1, 19, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(42, 3, 19, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(43, 5, 19, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(44, 3, 20, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(45, 5, 20, '2026-05-07 07:58:17', '2026-05-07 07:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_01_152733_create_connections_table', 1),
(5, '2026_05_01_152733_create_contact_messages_table', 1),
(6, '2026_05_01_152733_create_interests_table', 1),
(7, '2026_05_01_152733_create_messages_table', 1),
(8, '2026_05_01_152733_create_profiles_table', 1),
(9, '2026_05_01_152736_create_interest_profile_table', 1),
(10, '2026_05_07_083901_create_access_logs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `headline` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `department` varchar(255) NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `avatar_path` varchar(255) DEFAULT NULL,
  `available_for_mentoring` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `headline`, `bio`, `department`, `level`, `avatar_path`, `available_for_mentoring`, `created_at`, `updated_at`) VALUES
(1, 2, 'Looking for a Laravel mentor', 'I am building my final web project and want feedback on the matching experience.', 'Business Intelligence', '2-LBC-BI', NULL, 0, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(2, 3, 'Interested in dashboards and UX', 'I want to connect with teachers who can help me build a practical BI platform.', 'Business Information Systems', '2-LBC-BIS', NULL, 0, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(3, 4, 'Need help with machine learning ideas', 'I am searching for guidance to choose a simple and useful AI project topic.', 'Data Science', 'L2', NULL, 0, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(4, 5, 'Preparing a project presentation', 'I need a mentor who can help me organize features and explain the technical choices clearly.', 'Computer Science', '2-LBC-BI', NULL, 0, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(5, 6, 'Laravel teacher available for mentoring', 'I help students structure Laravel projects with clean MVC, validation, and database relationships.', 'Computer Science', 'Teacher', NULL, 1, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(6, 7, 'BI mentor for student projects', 'I guide students on dashboards, reporting, and practical business intelligence ideas.', 'Business Intelligence', 'Teacher', NULL, 1, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(7, 8, 'AI and data science project coach', 'I help students choose realistic machine learning projects and prepare strong presentations.', 'Data Science', 'Teacher', NULL, 1, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(8, 9, 'UX and product mentor', 'I support students who want their web applications to feel useful, simple, and polished.', 'Digital Design', 'Teacher', NULL, 1, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(9, 10, 'Exploring UX for student apps', 'I want to learn how to make academic platforms easier and more pleasant to use.', 'Digital Design', '2-LBC-BIS', NULL, 0, '2026-05-07 07:58:15', '2026-05-07 07:58:15'),
(10, 11, 'Building a data dashboard', 'I am looking for feedback on charts, KPIs, and database organization for a BI project.', 'Business Intelligence', 'L2', NULL, 0, '2026-05-07 07:58:15', '2026-05-07 07:58:15'),
(11, 12, 'Searching for AI project guidance', 'I need help choosing a realistic machine learning topic with simple data and clear results.', 'Data Science', '2-LBC-BI', NULL, 0, '2026-05-07 07:58:15', '2026-05-07 07:58:15'),
(12, 13, 'Laravel beginner looking for support', 'I want a mentor to review my controllers, validation, migrations, and Blade views.', 'Computer Science', 'L2', NULL, 0, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(13, 14, 'Interested in product presentation', 'I need help turning my project features into a clear story for the final presentation.', 'Business Information Systems', '2-LBC-BIS', NULL, 0, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(14, 15, 'Looking for database design advice', 'I want to improve my entity relationships and make my Laravel app data model stronger.', 'Computer Science', '2-LBC-BI', NULL, 0, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(15, 16, 'Database and Eloquent mentor', 'I help students model relationships, write migrations, and use Eloquent clearly.', 'Computer Science', 'Teacher', NULL, 1, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(16, 17, 'Presentation and project coach', 'I help students prepare confident demos, project reports, and feature explanations.', 'Professional Skills', 'Teacher', NULL, 1, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(17, 18, 'Dashboard design advisor', 'I mentor students building BI dashboards with useful metrics and readable layouts.', 'Business Intelligence', 'Teacher', NULL, 1, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(18, 19, 'Machine learning mentor', 'I help students keep AI projects practical, understandable, and presentation-ready.', 'Data Science', 'Teacher', NULL, 1, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(19, 20, 'Full-stack Laravel guide', 'I support students from database design to Blade pages, validation, and final deployment.', 'Web Development', 'Teacher', NULL, 1, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(20, 21, 'User experience reviewer', 'I review student projects and suggest improvements to flows, labels, and interface clarity.', 'Digital Design', 'Teacher', NULL, 1, '2026-05-07 07:58:17', '2026-05-07 07:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('eJVDQ92bv3avAfwMAAklMrTVUjyTVS03Ptbwr4cJ', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN25rZzMxcjByYzZpam83NWFtcVVrOXM5aHlxbnlxMnVMQ1AwQWRpWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODA5OS9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1778144320),
('kHPeZiRIQj7Pm2AICvJ4k6zpQH5KyISEb9dt1VIs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTzBhQ0cydzJWcDRDRWNlWXp1Z0dhWHc2NXoycHdCZVM0bVl2TmVLSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODA5OS9pbnRlcmVzdHMiO3M6NToicm91dGUiO3M6MTU6ImludGVyZXN0cy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1778142865),
('pCPQgt0rC9wupWIazwGbTB9KRXHjksQQerYeAuFQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWWVHV1RXZUxPTVBaZVJTdmFnVVJCaVE0cUNHWVo3a2o2WUlueFJ1QSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODA5OS9hZG1pbiI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1778144322),
('qhAYV1B80N4bQBJRufHYGMKFfwJCxZQaIxXJL4Ew', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNVlka2R2eGlJVTdEdW44eDVtOTFUcW82eHZFc2FHcEFNY1VBU1F5bCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlcz9wYWdlPTIiO3M6NToicm91dGUiO3M6MTQ6InByb2ZpbGVzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1778146744),
('S0ZKCaQgIvdaCGvc0Y6fexqNZSlMp1PIwJFSjLrb', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.26100.7462', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidVJGdkNTN1BqaU5COEFlcVN6QloyVU9jVjJVVTBSSnQ1OW1UbVI1QSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODA5OS9hZG1pbi9hY2Nlc3MtbG9ncy9leHBvcnQiO3M6NToicm91dGUiO3M6MjQ6ImFkbWluLmFjY2Vzcy1sb2dzLmV4cG9ydCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1778143241),
('tCKnm9paCtBjdlrYQuo4rG5yT2b73P3mCmLzLalL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN0lkRFEwYUhtVmNRVkRhTVpCSFVmaTRQY1hXWUh6Vnk5cTljTFQ1SyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO319', 1778144600),
('WA3xW2roug04X67K8z8ozUVfLNf4v6laz8YOE7ea', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieG91MXVHREtTZVpwcFFxeUxkRzFGNkVCd1R3dWxQeVNYZmhtdnk4OSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778146585);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'student',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'PeerConnect Admin', 'admin@peerconnect.test', 'admin', NULL, '$2y$12$0g//a9NyHDhzSEFX1CsJcuT0p0b41qABzwhy9u38l1D3.mQD30P1G', NULL, '2026-05-07 07:33:41', '2026-05-07 07:33:41'),
(2, 'Yasmine Student', 'yasmine@student.peerconnect.test', 'student', NULL, '$2y$12$ziOHKe5a/bTeKZyLd6jESugy1qee00DGGJybM.hoyuMu3vs0RsBie', NULL, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(3, 'Rami Student', 'rami@student.peerconnect.test', 'student', NULL, '$2y$12$H0Wc0KTp4g7tY7al4wlIbOsT381YDKcwVr6LqSbmrL./HhVyaFrc.', NULL, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(4, 'Lina Student', 'lina@student.peerconnect.test', 'student', NULL, '$2y$12$edy.YMKt45LUoQn7dU.67e3B29nHbgqr4Weeqg83YP43K1s2L9tn.', NULL, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(5, 'Anis Student', 'anis@student.peerconnect.test', 'student', NULL, '$2y$12$cARYruTxASYBbgZb1JcUA.VfTUMl4xmYDISM3/owZ6h1snu3I84sG', NULL, '2026-05-07 07:40:00', '2026-05-07 07:40:00'),
(6, 'Nadia Teacher', 'nadia.teacher@peerconnect.test', 'teacher', NULL, '$2y$12$f321VjYYkh382DovmeSZw./FxvU0.Wj3BKcYz9U61R4HiEgwHPDDm', NULL, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(7, 'Sami Teacher', 'sami.teacher@peerconnect.test', 'teacher', NULL, '$2y$12$r1weyBr/Cpvv83ecpbPUduMoMILUcDU5qrEYzF0KQspSmjLqbYnvW', NULL, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(8, 'Hanen Teacher', 'hanen.teacher@peerconnect.test', 'teacher', NULL, '$2y$12$kFAw2wBDrNs19Rm1MzJ33Ohq8OJgRW/utgVj0HPTA0SEt4pAhuJk.', NULL, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(9, 'Meriem Teacher', 'meriem.teacher@peerconnect.test', 'teacher', NULL, '$2y$12$kXCGt3SVajsxVcpTTahAwe.ei1tq7EMsZwOBgZIMB7dcO6tDlO2Ce', NULL, '2026-05-07 07:40:01', '2026-05-07 07:40:01'),
(10, 'Nour Student', 'nour@student.peerconnect.test', 'student', NULL, '$2y$12$cxnjUY33zXcueEEwWBCtd.ll0CZREn.bPXm6UIHAhiyGVsyk3oTXq', NULL, '2026-05-07 07:58:15', '2026-05-07 07:58:15'),
(11, 'Malek Student', 'malek@student.peerconnect.test', 'student', NULL, '$2y$12$37Cgjf9WRw/JqVh2xCtO8.ZI2.LMqDutb8.eqGDIBrLqgdAfvCKna', NULL, '2026-05-07 07:58:15', '2026-05-07 07:58:15'),
(12, 'Ines Student', 'ines@student.peerconnect.test', 'student', NULL, '$2y$12$y1mtdrO3SL8loigdQsq3Guurf/YS6SYwKbSHl3R59KtRm5umIVkve', NULL, '2026-05-07 07:58:15', '2026-05-07 07:58:15'),
(13, 'Omar Student', 'omar@student.peerconnect.test', 'student', NULL, '$2y$12$R0Jwqz06V0u3WZTEJRxOWOn/RyJew67PKa/zsRgMq73x.ITwR6ofG', NULL, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(14, 'Salma Student', 'salma@student.peerconnect.test', 'student', NULL, '$2y$12$9Uz8nghsn.qBSBByRnsA4O3x.zECcP5DNrm.OMGB6sEwTMXsfq1kK', NULL, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(15, 'Fares Student', 'fares@student.peerconnect.test', 'student', NULL, '$2y$12$y7LdqQHNgODyYyMqSE/Z8O9VGrF7z6vp6RsvBB/M60pHvDH4CX/oS', NULL, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(16, 'Walid Teacher', 'walid.teacher@peerconnect.test', 'teacher', NULL, '$2y$12$LWs53DC2oU1XUk7ZCL3iIu6QxCpb3l8.nLwd87ylRhEYXGYSUQ4OG', NULL, '2026-05-07 07:58:16', '2026-05-07 07:58:16'),
(17, 'Amina Teacher', 'amina.teacher@peerconnect.test', 'teacher', NULL, '$2y$12$74B.izF9hQ9dwIoAE4mYMeDUtx3ElS3F09rdK3B.8OPAN7tOBpmoy', NULL, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(18, 'Youssef Teacher', 'youssef.teacher@peerconnect.test', 'teacher', NULL, '$2y$12$GpHg.zOtasoegljRKAGFquP.8NV3KMWOcE4pe/TibymRto8.KWdWO', NULL, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(19, 'Rim Teacher', 'rim.teacher@peerconnect.test', 'teacher', NULL, '$2y$12$W0eYtz1h1l4U0AgIM5nV/ezaJ0DE2YNVUhyEXGpHvxnaibz48FDRG', NULL, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(20, 'Tarek Teacher', 'tarek.teacher@peerconnect.test', 'teacher', NULL, '$2y$12$Qx0X4Gg8fvV7IOeGNErHduPOdB0QFKIICDlMnuS4tUE2vRa2EAGOW', NULL, '2026-05-07 07:58:17', '2026-05-07 07:58:17'),
(21, 'Sonia Teacher', 'sonia.teacher@peerconnect.test', 'teacher', NULL, '$2y$12$WCn6OoMyql3fupe5kaaHGOWRfvax5MzH75FxwY94eLtYjrZbiCpkq', NULL, '2026-05-07 07:58:17', '2026-05-07 07:58:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_logs`
--
ALTER TABLE `access_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `connections_sender_id_receiver_id_unique` (`sender_id`,`receiver_id`),
  ADD KEY `connections_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `interests_name_unique` (`name`);

--
-- Indexes for table `interest_profile`
--
ALTER TABLE `interest_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `interest_profile_interest_id_profile_id_unique` (`interest_id`,`profile_id`),
  ADD KEY `interest_profile_profile_id_foreign` (`profile_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_connection_id_foreign` (`connection_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_logs`
--
ALTER TABLE `access_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `connections`
--
ALTER TABLE `connections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `interest_profile`
--
ALTER TABLE `interest_profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_logs`
--
ALTER TABLE `access_logs`
  ADD CONSTRAINT `access_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `connections`
--
ALTER TABLE `connections`
  ADD CONSTRAINT `connections_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `connections_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interest_profile`
--
ALTER TABLE `interest_profile`
  ADD CONSTRAINT `interest_profile_interest_id_foreign` FOREIGN KEY (`interest_id`) REFERENCES `interests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `interest_profile_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_connection_id_foreign` FOREIGN KEY (`connection_id`) REFERENCES `connections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
