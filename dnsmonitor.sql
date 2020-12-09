-- phpMyAdmin SQL Dump
-- version 5.0.0-rc1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 29, 2020 at 09:46 AM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnsmonitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(11) NOT NULL,
  `auth_id` int(4) NOT NULL,
  `auth_password` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `auth_id`, `auth_password`, `username`, `password`) VALUES
(1, 4818, 'qwert12345', 'yenleeyen@vistomail.com', 'qwert12345');

-- --------------------------------------------------------

--
-- Table structure for table `dns_records`
--

CREATE TABLE `dns_records` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `domain_name` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `record` varchar(12345) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fail_over` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttl` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dns_records`
--

INSERT INTO `dns_records` (`id`, `domain_name`, `type`, `host`, `record`, `fail_over`, `ttl`, `status`) VALUES
(209598322, 'lstest.xyz', 'NS', '', 'pns101.cloudns.net', 'OFF', '3600', 'ON'),
(209598323, 'lstest.xyz', 'NS', '', 'pns102.cloudns.net', 'OFF', '3600', 'ON'),
(209598324, 'lstest.xyz', 'NS', '', 'pns103.cloudns.net', 'OFF', '3600', 'ON'),
(209598325, 'lstest.xyz', 'NS', '', 'pns104.cloudns.net', 'OFF', '3600', 'ON'),
(209794654, 'lstest.xyz', 'TXT', 'domain-1', 'test-domain-1', 'OFF', '60', 'ON'),
(209794660, 'lstest.xyz', 'TXT', 'domain-2', 'test-domain-2', 'OFF', '60', 'ON'),
(209794661, 'lstest.xyz', 'TXT', 'domain-3', 'test-domain-3', 'OFF', '60', 'ON'),
(209797348, 'lstest.xyz', 'TXT', 'domain-1', 'google-site-verification=P8hs9CkoVy5LmBgLrAbCfwgT/Hc8mFDVZW8f4wp8zL5LnzJxDsJdS42m1AhTKwelH0GYYFe7dg==', 'OFF', '60', 'ON'),
(209797547, 'lstest.xyz', 'TXT', 'domain-1', 'google-site-verification=P8g1smp2XS9UhxserhTddhQM4jJh1ReJMmJg', 'OFF', '60', 'ON'),
(210570755, 'trytest.xyz', 'NS', '', 'pns101.cloudns.net', 'OFF', '3600', 'ON'),
(210570756, 'trytest.xyz', 'NS', '', 'pns102.cloudns.net', 'OFF', '3600', 'ON'),
(210570757, 'trytest.xyz', 'NS', '', 'pns103.cloudns.net', 'OFF', '3600', 'ON'),
(210570758, 'trytest.xyz', 'NS', '', 'pns104.cloudns.net', 'OFF', '3600', 'ON'),
(210570781, 'trytest.xyz', 'TXT', 'testgo', 'google-site-verification=P8hs9CkoVy5LmBgLrAbCfwgT/Hc8mFDVZW8f4wp8zL5LnzJxDsJdS42m1AhTKwelH0GYYFe7dg==', 'OFF', '60', 'ON'),
(214033532, 'job-remote.com', 'NS', '', 'pns101.cloudns.net', 'OFF', '3600', 'ON'),
(214033533, 'job-remote.com', 'NS', '', 'pns102.cloudns.net', 'OFF', '3600', 'ON'),
(214033534, 'job-remote.com', 'NS', '', 'pns103.cloudns.net', 'OFF', '3600', 'ON');

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` bigint(11) NOT NULL,
  `name` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registered_on` date NOT NULL,
  `expires_on` date NOT NULL,
  `privacy_protection` int(1) NOT NULL,
  `account_id` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `name`, `status`, `registered_on`, `expires_on`, `privacy_protection`, `account_id`) VALUES
(1, 'job-remote.com', 'active', '2020-10-03', '2021-10-03', 1, 1),
(2, 'lstest.xyz', 'active', '2020-08-05', '2021-08-05', 0, 1),
(3, 'trydomain5.xyz', 'active', '2020-10-20', '2021-10-21', 1, 1),
(4, 'trydomain6.xyz', 'active', '2020-10-20', '2021-10-21', 1, 1),
(5, 'trytest.xyz', 'active', '2020-08-20', '2021-08-21', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `table_name` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `request_method` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `data` text COLLATE utf8mb4_unicode_ci,
  `recorded_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `table_name`, `request_method`, `data`, `recorded_on`) VALUES
(1, 'DNS_RECORD', 'INSERT', '{\"id\":\"209598322\",\"domain_name\":\"lstest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns101.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:33:22'),
(2, 'DNS_RECORD', 'INSERT', '{\"id\":\"209598323\",\"domain_name\":\"lstest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns102.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:33:22'),
(3, 'DNS_RECORD', 'INSERT', '{\"id\":\"209598324\",\"domain_name\":\"lstest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns103.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:33:22'),
(4, 'DNS_RECORD', 'INSERT', '{\"id\":\"209598325\",\"domain_name\":\"lstest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns104.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:33:22'),
(5, 'DNS_RECORD', 'INSERT', '{\"id\":\"209797547\",\"domain_name\":\"lstest.xyz\",\"type\":\"TXT\",\"host\":\"domain-1\",\"record\":\"google-site-verification=P8g1smp2XS9UhxserhTddhQM4jJh1ReJMmJg\",\"failover\":\"OFF\",\"ttl\":\"60\",\"status\":\"ON\"}', '2020-10-29 09:33:22'),
(6, 'DNS_RECORD', 'INSERT', '{\"id\":\"209797348\",\"domain_name\":\"lstest.xyz\",\"type\":\"TXT\",\"host\":\"domain-1\",\"record\":\"google-site-verification=P8hs9CkoVy5LmBgLrAbCfwgT\\/Hc8mFDVZW8f4wp8zL5LnzJxDsJdS42m1AhTKwelH0GYYFe7dg==\",\"failover\":\"OFF\",\"ttl\":\"60\",\"status\":\"ON\"}', '2020-10-29 09:33:22'),
(7, 'DNS_RECORD', 'INSERT', '{\"id\":\"209794654\",\"domain_name\":\"lstest.xyz\",\"type\":\"TXT\",\"host\":\"domain-1\",\"record\":\"test-domain-1\",\"failover\":\"OFF\",\"ttl\":\"60\",\"status\":\"ON\"}', '2020-10-29 09:33:22'),
(8, 'DNS_RECORD', 'INSERT', '{\"id\":\"209794660\",\"domain_name\":\"lstest.xyz\",\"type\":\"TXT\",\"host\":\"domain-2\",\"record\":\"test-domain-2\",\"failover\":\"OFF\",\"ttl\":\"60\",\"status\":\"ON\"}', '2020-10-29 09:33:22'),
(9, 'DNS_RECORD', 'INSERT', '{\"id\":\"209794661\",\"domain_name\":\"lstest.xyz\",\"type\":\"TXT\",\"host\":\"domain-3\",\"record\":\"test-domain-3\",\"failover\":\"OFF\",\"ttl\":\"60\",\"status\":\"ON\"}', '2020-10-29 09:33:22'),
(10, 'DNS_RECORD', 'INSERT', '{\"id\":\"210570755\",\"domain_name\":\"trytest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns101.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:33:30'),
(11, 'DNS_RECORD', 'INSERT', '{\"id\":\"210570756\",\"domain_name\":\"trytest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns102.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:33:30'),
(12, 'DNS_RECORD', 'INSERT', '{\"id\":\"210570757\",\"domain_name\":\"trytest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns103.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:33:30'),
(13, 'DNS_RECORD', 'INSERT', '{\"id\":\"210570758\",\"domain_name\":\"trytest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns104.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:33:30'),
(14, 'DNS_RECORD', 'INSERT', '{\"id\":\"210570781\",\"domain_name\":\"trytest.xyz\",\"type\":\"TXT\",\"host\":\"testgo\",\"record\":\"google-site-verification=P8hs9CkoVy5LmBgLrAbCfwgT\\/Hc8mFDVZW8f4wp8zL5LnzJxDsJdS42m1AhTKwelH0GYYFe7dg==\",\"failover\":\"OFF\",\"ttl\":\"60\",\"status\":\"ON\"}', '2020-10-29 09:33:30'),
(15, 'DNS_RECORD', 'INSERT', '{\"id\":\"214033532\",\"domain_name\":\"job-remote.com\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns101.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:35:08'),
(16, 'DNS_RECORD', 'INSERT', '{\"id\":\"214033533\",\"domain_name\":\"job-remote.com\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns102.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:35:08'),
(17, 'DNS_RECORD', 'INSERT', '{\"id\":\"214033534\",\"domain_name\":\"job-remote.com\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns103.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:35:08'),
(18, 'DNS_RECORD', 'INSERT', '{\"id\":\"209598322\",\"domain_name\":\"lstest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns101.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:35:09'),
(19, 'DNS_RECORD', 'INSERT', '{\"id\":\"209598323\",\"domain_name\":\"lstest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns102.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:35:09'),
(20, 'DNS_RECORD', 'INSERT', '{\"id\":\"209598324\",\"domain_name\":\"lstest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns103.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:35:09'),
(21, 'DNS_RECORD', 'INSERT', '{\"id\":\"209598325\",\"domain_name\":\"lstest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns104.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:35:09'),
(22, 'DNS_RECORD', 'INSERT', '{\"id\":\"209797547\",\"domain_name\":\"lstest.xyz\",\"type\":\"TXT\",\"host\":\"domain-1\",\"record\":\"google-site-verification=P8g1smp2XS9UhxserhTddhQM4jJh1ReJMmJg\",\"failover\":\"OFF\",\"ttl\":\"60\",\"status\":\"ON\"}', '2020-10-29 09:35:09'),
(23, 'DNS_RECORD', 'INSERT', '{\"id\":\"209797348\",\"domain_name\":\"lstest.xyz\",\"type\":\"TXT\",\"host\":\"domain-1\",\"record\":\"google-site-verification=P8hs9CkoVy5LmBgLrAbCfwgT\\/Hc8mFDVZW8f4wp8zL5LnzJxDsJdS42m1AhTKwelH0GYYFe7dg==\",\"failover\":\"OFF\",\"ttl\":\"60\",\"status\":\"ON\"}', '2020-10-29 09:35:09'),
(24, 'DNS_RECORD', 'INSERT', '{\"id\":\"209794654\",\"domain_name\":\"lstest.xyz\",\"type\":\"TXT\",\"host\":\"domain-1\",\"record\":\"test-domain-1\",\"failover\":\"OFF\",\"ttl\":\"60\",\"status\":\"ON\"}', '2020-10-29 09:35:09'),
(25, 'DNS_RECORD', 'INSERT', '{\"id\":\"209794660\",\"domain_name\":\"lstest.xyz\",\"type\":\"TXT\",\"host\":\"domain-2\",\"record\":\"test-domain-2\",\"failover\":\"OFF\",\"ttl\":\"60\",\"status\":\"ON\"}', '2020-10-29 09:35:09'),
(26, 'DNS_RECORD', 'INSERT', '{\"id\":\"209794661\",\"domain_name\":\"lstest.xyz\",\"type\":\"TXT\",\"host\":\"domain-3\",\"record\":\"test-domain-3\",\"failover\":\"OFF\",\"ttl\":\"60\",\"status\":\"ON\"}', '2020-10-29 09:35:09'),
(27, 'DNS_RECORD', 'INSERT', '{\"id\":\"210570755\",\"domain_name\":\"trytest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns101.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:35:19'),
(28, 'DNS_RECORD', 'INSERT', '{\"id\":\"210570756\",\"domain_name\":\"trytest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns102.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:35:19'),
(29, 'DNS_RECORD', 'INSERT', '{\"id\":\"210570757\",\"domain_name\":\"trytest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns103.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:35:19'),
(30, 'DNS_RECORD', 'INSERT', '{\"id\":\"210570758\",\"domain_name\":\"trytest.xyz\",\"type\":\"NS\",\"host\":\"\",\"record\":\"pns104.cloudns.net\",\"failover\":\"OFF\",\"ttl\":\"3600\",\"status\":\"ON\"}', '2020-10-29 09:35:19'),
(31, 'DNS_RECORD', 'INSERT', '{\"id\":\"210570781\",\"domain_name\":\"trytest.xyz\",\"type\":\"TXT\",\"host\":\"testgo\",\"record\":\"google-site-verification=P8hs9CkoVy5LmBgLrAbCfwgT\\/Hc8mFDVZW8f4wp8zL5LnzJxDsJdS42m1AhTKwelH0GYYFe7dg==\",\"failover\":\"OFF\",\"ttl\":\"60\",\"status\":\"ON\"}', '2020-10-29 09:35:19');

-- --------------------------------------------------------

--
-- Table structure for table `sync_button_logs`
--

CREATE TABLE `sync_button_logs` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `button_name` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recorded_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '//Success or Fail '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sync_button_logs`
--

INSERT INTO `sync_button_logs` (`id`, `button_name`, `recorded_on`, `status`) VALUES
(1, 'btn-sync-all', '2020-10-20 02:59:40', '1'),
(2, 'btn-sync-all', '2020-10-20 03:27:01', '1'),
(3, 'btn-sync-all', '2020-10-20 03:28:51', '1'),
(4, 'btn-sync-all', '2020-10-20 03:36:32', '1'),
(5, 'btn-sync-all', '2020-10-20 03:50:52', '1'),
(6, 'btn-sync-all', '2020-10-20 05:07:52', '1'),
(7, 'btn-sync-all', '2020-10-20 05:17:50', '1'),
(8, 'btn-sync-all', '2020-10-20 05:29:51', '1'),
(9, 'btn-sync-all', '2020-10-20 05:45:59', '1'),
(10, 'btn-sync-all', '2020-10-20 06:19:37', '1'),
(11, 'btn-sync-all', '2020-10-20 06:24:42', '1'),
(12, 'btn-sync-all', '2020-10-20 06:40:15', '1'),
(13, 'btn-sync-all', '2020-10-20 06:45:19', '1'),
(14, 'btn-sync-all', '2020-10-20 06:48:25', '1'),
(15, 'btn-sync-all', '2020-10-20 06:52:33', '1'),
(16, 'btn-sync-all', '2020-10-20 07:52:18', '1'),
(17, 'btn-sync-all', '2020-10-21 02:51:29', '1'),
(18, 'btn-sync-all', '2020-10-21 02:51:31', '1'),
(19, 'btn-sync-all', '2020-10-21 05:51:16', '1'),
(20, 'btn-sync-all', '2020-10-21 05:51:26', '1'),
(21, 'btn-sync-all', '2020-10-21 05:54:27', '1'),
(22, 'btn-sync-all', '2020-10-21 06:07:21', '1'),
(23, 'btn-sync-all', '2020-10-21 06:13:59', '1'),
(24, 'btn-sync-all', '2020-10-21 06:34:35', '1'),
(25, 'btn-sync-all', '2020-10-22 11:22:57', '1'),
(26, 'btn-sync-all', '2020-10-23 03:01:17', '1'),
(27, 'btn-sync-all', '2020-10-23 03:01:39', '1'),
(28, 'btn-sync-all', '2020-10-23 03:45:50', '1'),
(29, 'btn-sync-all', '2020-10-23 03:47:31', '1'),
(30, 'btn-sync-all', '2020-10-23 03:47:43', '1'),
(31, 'btn-sync-all', '2020-10-23 03:51:27', '1'),
(32, 'btn-sync-all', '2020-10-23 03:51:48', '1'),
(33, 'btn-sync-all', '2020-10-23 03:56:27', '1'),
(34, 'btn-sync-all', '2020-10-23 04:01:57', '1'),
(35, 'btn-sync-all', '2020-10-23 04:05:30', '1'),
(36, 'btn-sync-all', '2020-10-23 04:05:49', '1'),
(37, 'btn-sync-all', '2020-10-23 04:06:57', '1'),
(38, 'btn-sync-all', '2020-10-23 04:07:39', '1'),
(39, 'btn-sync-all', '2020-10-23 04:08:12', '1'),
(40, 'btn-sync-all', '2020-10-23 04:09:20', '1'),
(41, 'btn-sync-all', '2020-10-23 04:11:26', '1'),
(42, 'btn-sync-all', '2020-10-23 04:11:52', '1'),
(43, 'btn-sync-all', '2020-10-23 04:12:02', '1'),
(44, 'btn-sync-all', '2020-10-23 04:12:22', '1'),
(45, 'btn-sync-all', '2020-10-23 04:13:04', '1'),
(46, 'btn-sync-all', '2020-10-23 04:13:20', '1'),
(47, 'btn-sync-all', '2020-10-23 04:13:32', '1'),
(48, 'btn-sync-all', '2020-10-23 04:13:36', '1'),
(49, 'btn-sync-all', '2020-10-23 04:13:49', '1'),
(50, 'btn-sync-all', '2020-10-23 04:15:00', '1'),
(51, 'btn-sync-all', '2020-10-23 04:15:09', '1'),
(52, 'btn-sync-all', '2020-10-23 04:15:23', '1'),
(53, 'btn-sync-all', '2020-10-23 04:18:33', '1'),
(54, 'btn-sync-all', '2020-10-23 04:19:39', '1'),
(55, 'btn-sync-all', '2020-10-23 04:20:37', '1'),
(56, 'btn-sync-all', '2020-10-23 04:21:02', '1'),
(57, 'btn-sync-all', '2020-10-23 04:21:54', '1'),
(58, 'btn-sync-all', '2020-10-23 04:22:32', '1'),
(59, 'btn-sync-all', '2020-10-23 04:22:57', '1'),
(60, 'btn-sync-all', '2020-10-23 04:23:22', '1'),
(61, 'btn-sync-all', '2020-10-23 04:24:14', '1'),
(62, 'btn-sync-all', '2020-10-23 04:32:17', '1'),
(63, 'btn-sync-all', '2020-10-23 04:33:36', '1'),
(64, 'btn-sync-all', '2020-10-23 04:40:36', '1'),
(65, 'btn-sync-all', '2020-10-23 04:45:03', '1'),
(66, 'btn-sync-all', '2020-10-23 04:47:50', '1'),
(67, 'btn-sync-all', '2020-10-23 04:57:24', '1'),
(68, 'btn-sync-all', '2020-10-23 05:04:24', '1'),
(69, 'btn-sync-all', '2020-10-23 05:11:24', '1'),
(70, 'btn-sync-all', '2020-10-23 05:18:24', '1'),
(71, 'btn-sync-all', '2020-10-23 05:25:24', '1'),
(72, 'btn-sync-all', '2020-10-23 05:32:24', '1'),
(73, 'btn-sync-all', '2020-10-23 05:39:24', '1'),
(74, 'btn-sync-all', '2020-10-23 05:46:24', '1'),
(75, 'btn-sync-all', '2020-10-23 05:53:24', '1'),
(76, 'btn-sync-all', '2020-10-23 06:01:02', '1'),
(77, 'btn-sync-all', '2020-10-23 06:08:03', '1'),
(78, 'btn-sync-all', '2020-10-23 22:42:12', '1'),
(79, 'btn-sync-all', '2020-10-24 01:04:21', '1'),
(80, 'btn-sync-all', '2020-10-24 05:37:43', '1'),
(81, 'btn-sync-all', '2020-10-24 05:40:49', '1'),
(82, 'btn-sync-all', '2020-10-24 05:41:01', '1'),
(83, 'btn-sync-all', '2020-10-24 05:41:13', '1'),
(84, 'btn-sync-all', '2020-10-24 05:43:27', '1'),
(85, 'btn-sync-all', '2020-10-24 05:43:43', '1'),
(86, 'btn-sync-all', '2020-10-24 05:45:40', '1'),
(87, 'btn-sync-all', '2020-10-24 05:46:30', '1'),
(88, 'btn-sync-all', '2020-10-24 05:47:35', '1'),
(89, 'btn-sync-all', '2020-10-24 05:47:54', '1'),
(90, 'btn-sync-all', '2020-10-24 05:50:21', '1'),
(91, 'btn-sync-all', '2020-10-24 05:50:44', '1'),
(92, 'btn-sync-all', '2020-10-27 02:42:46', '1'),
(93, 'btn-sync-all', '2020-10-27 02:49:46', '1'),
(94, 'btn-sync-all', '2020-10-27 02:50:54', '1'),
(95, 'btn-sync-all', '2020-10-27 02:57:55', '1'),
(96, 'btn-sync-all', '2020-10-27 02:58:36', '1'),
(97, 'btn-sync-all', '2020-10-27 02:59:04', '1'),
(98, 'btn-sync-all', '2020-10-27 03:00:05', '1'),
(99, 'btn-sync-all', '2020-10-27 03:01:26', '1'),
(100, 'btn-sync-all', '2020-10-27 03:01:36', '1'),
(101, 'btn-sync-all', '2020-10-27 03:02:09', '1'),
(102, 'btn-sync-all', '2020-10-27 03:03:14', '1'),
(103, 'btn-sync-all', '2020-10-27 03:09:32', '1'),
(104, 'btn-sync-all', '2020-10-27 03:14:24', '1'),
(105, 'btn-sync-all', '2020-10-27 03:15:57', '1'),
(106, 'btn-sync-all', '2020-10-27 03:15:58', '1'),
(107, 'btn-sync-all', '2020-10-27 03:18:39', '1'),
(108, 'btn-sync-all', '2020-10-27 03:18:40', '1'),
(109, 'btn-sync-all', '2020-10-27 03:18:41', '1'),
(110, 'btn-sync-all', '2020-10-27 03:19:04', '1'),
(111, 'btn-sync-all', '2020-10-27 03:19:11', '1'),
(112, 'btn-sync-all', '2020-10-27 03:20:49', '1'),
(113, 'btn-sync-all', '2020-10-27 03:21:05', '1'),
(114, 'btn-sync-all', '2020-10-27 03:23:48', '1'),
(115, 'btn-sync-all', '2020-10-27 03:23:49', '1'),
(116, 'btn-sync-all', '2020-10-27 03:24:08', '1'),
(117, 'btn-sync-all', '2020-10-27 03:28:08', '1'),
(118, 'btn-sync-all', '2020-10-27 03:28:08', '1'),
(119, 'btn-sync-all', '2020-10-27 03:29:28', '1'),
(120, 'btn-sync-all', '2020-10-27 03:29:28', '1'),
(121, 'btn-sync-all', '2020-10-27 03:30:17', '1'),
(122, 'btn-sync-all', '2020-10-27 04:39:27', '1'),
(123, 'btn-sync-all', '2020-10-27 04:42:18', '1'),
(124, 'btn-sync-all', '2020-10-27 07:07:37', '1'),
(125, 'btn-sync-all', '2020-10-27 07:44:48', '1'),
(126, 'btn-sync-all', '2020-10-28 04:27:57', '1'),
(127, 'btn-sync-all', '2020-10-28 04:38:54', '1'),
(128, 'btn-sync-all', '2020-10-28 04:39:17', '1'),
(129, 'btn-sync-all', '2020-10-28 04:41:31', '1'),
(130, 'btn-sync-all', '2020-10-28 04:41:56', '1'),
(131, 'btn-sync-all', '2020-10-28 04:41:57', '1'),
(132, 'btn-sync-all', '2020-10-28 04:43:00', '1'),
(133, 'btn-sync-all', '2020-10-28 04:44:15', '1'),
(134, 'btn-sync-all', '2020-10-28 04:51:16', '1'),
(135, 'btn-sync-all', '2020-10-28 06:46:37', '1'),
(136, 'btn-sync-all', '2020-10-29 02:57:17', '1'),
(137, 'btn-sync-all', '2020-10-29 06:41:44', '1'),
(138, 'btn-sync-all', '2020-10-29 07:04:58', '1'),
(139, 'btn-sync-all', '2020-10-29 07:05:11', '1'),
(140, 'btn-sync-all', '2020-10-29 07:12:11', '1'),
(141, 'btn-sync-all', '2020-10-29 08:54:29', '1'),
(142, 'btn-sync-all', '2020-10-29 08:55:27', '1'),
(143, 'btn-sync-all', '2020-10-29 09:17:07', '1'),
(144, 'btn-sync-all', '2020-10-29 09:24:08', '1'),
(145, 'btn-sync-all', '2020-10-29 09:31:08', '1'),
(146, 'btn-sync-all', '2020-10-29 09:33:05', '1'),
(147, 'btn-sync-all', '2020-10-29 09:33:22', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dns_records`
--
ALTER TABLE `dns_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sync_button_logs`
--
ALTER TABLE `sync_button_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sync_button_logs`
--
ALTER TABLE `sync_button_logs`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

