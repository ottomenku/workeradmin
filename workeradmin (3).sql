-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Ápr 06. 20:42
-- Kiszolgáló verziója: 10.4.17-MariaDB
-- PHP verzió: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `workeradmin`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `causer_id` int(10) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `basedays`
--

CREATE TABLE `basedays` (
  `id` int(10) UNSIGNED NOT NULL,
  `workday` smallint(6) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datum` date NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pub` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `basedays`
--

INSERT INTO `basedays` (`id`, `workday`, `name`, `datum`, `note`, `pub`, `created_at`, `updated_at`) VALUES
(1, 0, '1848 szh', '2021-03-15', 'az 1848-as szabadságharc ünnepe', 0, '2021-03-27 17:39:12', '2021-03-27 17:39:12'),
(2, 0, 'nagypéntek', '2021-04-02', NULL, 0, '2021-04-05 09:04:00', '2021-04-05 09:04:00'),
(3, 0, 'húsvét', '2021-04-05', NULL, 0, '2021-04-05 09:05:17', '2021-04-05 09:05:17');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `basedaysold`
--

CREATE TABLE `basedaysold` (
  `id` int(10) UNSIGNED NOT NULL,
  `ceg_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `daytype_id` int(10) UNSIGNED NOT NULL,
  `datum` date NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pub` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `basedaysold`
--

INSERT INTO `basedaysold` (`id`, `ceg_id`, `daytype_id`, `datum`, `note`, `pub`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 3, '2019-12-06', 'mikulás', 1, '2019-12-15 19:27:36', '2020-05-08 16:52:39', NULL),
(4, 1, 2, '2020-05-01', NULL, 0, '2020-05-14 15:41:32', '2020-05-14 16:21:30', '2020-05-14 16:21:30'),
(5, 1, 2, '2020-05-15', 'wtgrt', 1, '2020-05-14 16:20:53', '2020-05-14 16:21:24', '2020-05-14 16:21:24'),
(6, 1, 4, '2021-03-15', 'Nemzeti ünnep', 0, '2021-03-22 16:49:25', '2021-03-22 16:49:25', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cegs`
--

CREATE TABLE `cegs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ugyvezeto` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `szekhely` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cim` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ado` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cegnev` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pub` smallint(6) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `cegs`
--

INSERT INTO `cegs` (`id`, `user_id`, `ugyvezeto`, `szekhely`, `cim`, `ado`, `cegnev`, `note`, `pub`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, 'base ceg', 'Ehhez tartoznak az alapértékek amiket minden cég használ pl.: daytype, timetype', NULL, NULL, NULL, NULL),
(7, 27, NULL, NULL, NULL, NULL, 'probaceg1', NULL, 1, '2020-05-13 14:16:22', '2020-05-13 14:16:22', NULL),
(8, 29, NULL, NULL, NULL, NULL, 'M-TL Consulting Kft', NULL, 1, '2020-05-14 15:31:41', '2020-05-14 15:31:41', NULL),
(9, 32, NULL, NULL, NULL, NULL, 'ggg', NULL, 1, '2021-01-17 16:39:40', '2021-01-17 16:56:46', '2021-01-17 16:56:46'),
(10, 35, 'Kis lászló', 'Jászberény', 'Kossuth u.2', '6566', 'szuper g2', NULL, 1, '2021-01-17 16:59:04', '2021-01-17 16:59:04', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `days`
--

CREATE TABLE `days` (
  `id` int(10) UNSIGNED NOT NULL,
  `worker_id` int(10) UNSIGNED NOT NULL,
  `daytype_id` int(10) UNSIGNED NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `datum` date NOT NULL,
  `adnote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `worknote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pub` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `days`
--

INSERT INTO `days` (`id`, `worker_id`, `daytype_id`, `file_id`, `datum`, `adnote`, `worknote`, `pub`, `created_at`, `updated_at`, `deleted_at`) VALUES
(70, 11, 2, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-15 16:19:40', '2021-03-15 16:19:54', '2021-03-15 16:19:54'),
(71, 12, 2, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-15 16:19:40', '2021-03-15 16:19:54', '2021-03-15 16:19:54'),
(72, 11, 1, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-15 16:19:48', '2021-03-15 16:19:54', '2021-03-15 16:19:54'),
(73, 12, 1, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-15 16:19:48', '2021-03-15 16:19:54', '2021-03-15 16:19:54'),
(74, 11, 1, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-15 16:19:57', '2021-03-15 16:20:18', '2021-03-15 16:20:18'),
(75, 12, 1, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-15 16:19:57', '2021-03-15 16:20:18', '2021-03-15 16:20:18'),
(76, 11, 3, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-15 16:20:04', '2021-03-15 16:20:18', '2021-03-15 16:20:18'),
(77, 11, 3, NULL, '2021-03-03', NULL, NULL, 50, '2021-03-15 16:20:04', '2021-03-20 07:51:33', '2021-03-20 07:51:33'),
(78, 12, 3, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-15 16:20:04', '2021-03-15 16:20:18', '2021-03-15 16:20:18'),
(79, 12, 3, NULL, '2021-03-03', NULL, NULL, 50, '2021-03-15 16:20:04', '2021-03-28 08:21:17', '2021-03-28 08:21:17'),
(80, 11, 2, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-15 16:20:25', '2021-03-20 20:49:03', '2021-03-20 20:49:03'),
(81, 12, 2, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-15 16:20:25', '2021-03-20 20:51:58', '2021-03-20 20:51:58'),
(82, 11, 2, NULL, '2021-03-04', NULL, NULL, 50, '2021-03-15 17:13:20', '2021-03-22 17:52:20', '2021-03-22 17:52:20'),
(83, 12, 1, NULL, '2021-03-05', NULL, NULL, 50, '2021-03-15 17:13:41', '2021-03-15 17:13:41', NULL),
(84, 12, 3, NULL, '2021-03-17', NULL, NULL, 50, '2021-03-15 17:21:57', '2021-03-20 21:35:29', '2021-03-20 21:35:29'),
(85, 12, 3, NULL, '2021-03-18', NULL, NULL, 50, '2021-03-15 17:21:57', '2021-03-20 21:37:32', '2021-03-20 21:37:32'),
(86, 11, 2, NULL, '2021-03-17', NULL, NULL, 50, '2021-03-15 17:22:06', '2021-03-20 21:35:43', '2021-03-20 21:35:43'),
(87, 11, 2, NULL, '2021-03-18', NULL, NULL, 50, '2021-03-15 17:22:06', '2021-03-15 17:22:06', NULL),
(88, 11, 2, NULL, '2021-03-19', NULL, NULL, 50, '2021-03-15 17:22:06', '2021-03-20 21:38:24', '2021-03-20 21:38:24'),
(89, 11, 2, NULL, '2021-03-03', NULL, NULL, 50, '2021-03-20 07:51:00', '2021-03-20 07:51:33', '2021-03-20 07:51:33'),
(90, 11, 2, NULL, '2021-03-05', NULL, NULL, 50, '2021-03-20 07:51:00', '2021-03-20 07:51:00', NULL),
(91, 12, 1, NULL, '2021-03-04', NULL, NULL, 50, '2021-03-20 18:27:26', '2021-03-22 17:52:33', '2021-03-22 17:52:33'),
(92, 11, 1, NULL, '2021-03-04', NULL, NULL, 50, '2021-03-20 18:27:37', '2021-03-22 17:52:20', '2021-03-22 17:52:20'),
(93, 11, 1, NULL, '2021-03-08', NULL, NULL, 50, '2021-03-20 18:27:37', '2021-03-20 18:27:37', NULL),
(94, 11, 3, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-20 20:49:03', '2021-03-20 20:53:02', '2021-03-20 20:53:02'),
(95, 11, 3, NULL, '2021-03-16', NULL, NULL, 50, '2021-03-20 21:27:06', '2021-03-20 21:27:45', '2021-03-20 21:27:45'),
(96, 11, 3, NULL, '2021-03-16', NULL, NULL, 50, '2021-03-20 21:31:59', '2021-03-20 21:31:59', NULL),
(97, 11, 3, NULL, '2021-03-23', NULL, NULL, 50, '2021-03-20 21:31:59', '2021-03-20 21:45:49', '2021-03-20 21:45:49'),
(98, 11, 3, NULL, '2021-03-24', NULL, NULL, 50, '2021-03-20 21:34:01', '2021-03-20 21:45:59', '2021-03-20 21:45:59'),
(99, 11, 3, NULL, '2021-03-25', NULL, NULL, 50, '2021-03-20 21:35:23', '2021-03-20 21:35:29', '2021-03-20 21:35:29'),
(100, 11, 3, NULL, '2021-03-25', NULL, NULL, 50, '2021-03-20 21:35:29', '2021-03-20 21:35:43', '2021-03-20 21:35:43'),
(101, 11, 3, NULL, '2021-03-17', NULL, NULL, 50, '2021-03-20 21:35:29', '2021-03-20 21:35:43', '2021-03-20 21:35:43'),
(102, 11, 3, NULL, '2021-03-18', NULL, NULL, 50, '2021-03-20 21:37:32', '2021-03-20 21:37:32', NULL),
(103, 11, 3, NULL, '2021-03-19', NULL, NULL, 50, '2021-03-20 21:38:24', '2021-03-20 21:39:32', '2021-03-20 21:39:32'),
(104, 11, 2, NULL, '2021-03-23', NULL, NULL, 50, '2021-03-20 21:45:49', '2021-03-20 21:45:59', '2021-03-20 21:45:59'),
(105, 11, 1, NULL, '2021-03-23', NULL, NULL, 50, '2021-03-20 21:45:59', '2021-03-20 21:45:59', NULL),
(106, 11, 1, NULL, '2021-03-24', NULL, NULL, 50, '2021-03-20 21:45:59', '2021-03-20 21:45:59', NULL),
(107, 11, 1, NULL, '2021-03-25', NULL, NULL, 50, '2021-03-20 21:48:45', '2021-03-20 21:48:45', NULL),
(108, 11, 1, NULL, '2021-03-19', NULL, NULL, 50, '2021-03-20 21:52:46', '2021-03-20 21:52:57', '2021-03-20 21:52:57'),
(109, 11, 2, NULL, '2021-03-19', NULL, NULL, 50, '2021-03-20 21:52:57', '2021-03-20 21:53:02', '2021-03-20 21:53:02'),
(110, 11, 3, NULL, '2021-03-19', NULL, NULL, 50, '2021-03-20 21:53:02', '2021-03-20 21:53:02', NULL),
(111, 11, 1, NULL, '2021-03-04', NULL, NULL, 50, '2021-03-22 17:52:33', '2021-03-22 17:52:33', NULL),
(112, 12, 1, NULL, '2021-03-11', NULL, NULL, 50, '2021-03-23 17:00:28', '2021-03-23 17:00:28', NULL),
(113, 12, 1, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-28 08:12:27', '2021-03-28 08:12:40', '2021-03-28 08:12:40'),
(114, 12, 1, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-28 08:12:40', '2021-03-28 08:20:57', '2021-03-28 08:20:57'),
(115, 12, 1, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-28 08:20:57', '2021-03-28 08:21:17', '2021-03-28 08:21:17'),
(116, 12, 2, NULL, '2021-03-02', NULL, NULL, 50, '2021-03-28 08:21:17', '2021-03-28 08:21:17', NULL),
(117, 12, 2, NULL, '2021-03-03', NULL, NULL, 50, '2021-03-28 08:21:17', '2021-03-28 08:21:17', NULL),
(118, 11, 1, NULL, '2021-04-01', NULL, NULL, 50, '2021-03-30 17:17:44', '2021-04-01 15:09:45', '2021-04-01 15:09:45'),
(119, 12, 1, NULL, '2021-04-01', NULL, NULL, 50, '2021-04-01 15:09:45', '2021-04-01 15:09:45', NULL),
(120, 12, 1, NULL, '2021-04-09', NULL, NULL, 50, '2021-04-01 15:09:45', '2021-04-04 11:34:03', '2021-04-04 11:34:03'),
(121, 11, 3, NULL, '2021-04-09', NULL, NULL, 50, '2021-04-04 11:34:03', '2021-04-04 11:34:03', NULL),
(122, 11, 3, NULL, '2021-04-10', NULL, NULL, 50, '2021-04-06 15:24:23', '2021-04-06 15:24:23', NULL),
(123, 11, 1, NULL, '2021-04-14', NULL, NULL, 50, '2021-04-06 15:25:29', '2021-04-06 15:26:21', '2021-04-06 15:26:21'),
(124, 11, 2, NULL, '2021-04-14', NULL, NULL, 50, '2021-04-06 15:26:21', '2021-04-06 15:26:21', NULL),
(125, 11, 2, NULL, '2021-04-22', NULL, NULL, 50, '2021-04-06 15:26:21', '2021-04-06 15:26:21', NULL),
(126, 11, 2, NULL, '2021-04-23', NULL, NULL, 50, '2021-04-06 15:26:21', '2021-04-06 15:26:21', NULL),
(127, 11, 2, NULL, '2021-04-21', NULL, NULL, 50, '2021-04-06 15:26:21', '2021-04-06 15:26:21', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `daytypes`
--

CREATE TABLE `daytypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `ceg_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `timetype_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workday` tinyint(1) NOT NULL,
  `szorzo` decimal(4,2) DEFAULT 1.00,
  `fixplusz` int(11) DEFAULT 0,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'grey',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'circle',
  `background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userallowed` tinyint(1) NOT NULL DEFAULT 0,
  `pub` smallint(6) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `daytypes`
--

INSERT INTO `daytypes` (`id`, `ceg_id`, `timetype_id`, `name`, `workday`, `szorzo`, `fixplusz`, `color`, `icon`, `background`, `note`, `userallowed`, `pub`) VALUES
(1, 1, 1, 'alap', 1, '1.00', NULL, '#006633', 'check-square-o', NULL, 'alap nyolcórás munkaidővel', 1, 1),
(2, 1, 5, 'ledolgozott', 1, '1.00', NULL, '#006633', 'check', NULL, 'nincs óra', 0, 1),
(3, 1, 5, 'Szabadnap', 0, NULL, NULL, '#0000ff', 'smile-o', 'yellow', NULL, 1, 1),
(4, 1, 5, 'Ünnepnap', 0, NULL, NULL, '#cc33cc', 'sun-o', NULL, NULL, 100, 1),
(5, 1, 5, 'ledolgozás', 1, NULL, NULL, '#663333', 'meh-o', NULL, NULL, 100, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `day_file`
--

CREATE TABLE `day_file` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_id` int(10) UNSIGNED NOT NULL,
  `day_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `docs`
--

CREATE TABLE `docs` (
  `id` int(10) UNSIGNED NOT NULL,
  `ceg_id` int(10) UNSIGNED NOT NULL,
  `worker_id` int(10) UNSIGNED NOT NULL,
  `cat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `editordata` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `worknote` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adnote` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pub` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `doctemplates`
--

CREATE TABLE `doctemplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `ceg_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `cat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'vegyes',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `editordata` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pub` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `doctemplates`
--

INSERT INTO `doctemplates` (`id`, `ceg_id`, `cat`, `name`, `filename`, `path`, `editordata`, `note`, `pub`, `created_at`, `updated_at`) VALUES
(20, 1, 'kkkppppppppp', 'kkkkkkkk', 'kkkkkkkk', 'doc_tmpl', '<p>&lt;&lt;[\'worker\'][\'birth\']&gt;&gt;&lt;&lt;[\'worker\'][\'cim\']&gt;&gt;&lt;&lt;[\'worker\'][\'birthplace\']&gt;&gt;&lt;&lt;[\'worker\'][\'position\']&gt;&gt;&lt;&lt;[\'worker\'][\'mothername\']&gt;&gt;hjkghk,ghkjghk,ghj&lt;&lt;[\'worker\'][\'fullname\']&gt;&gt;</p>', 'kkkkkkkkkkkkkkk', 1, '2021-03-08 19:37:23', '2021-03-09 18:02:00'),
(21, 1, 'ewrtwertwer', 'zui57i', 'zui57i', 'doc_tmpl', '<p>kljjkléjklé&lt;&lt;[\'worker\'][\'city\']&gt;&gt;</p>', 'nb mbnmb', 1, '2021-03-09 18:01:41', '2021-03-09 18:01:41');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `origin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `worknote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adnote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_15_105324_create_roles_table', 1),
(4, '2016_01_15_114412_create_role_user_table', 1),
(5, '2016_01_26_115212_create_permissions_table', 1),
(6, '2016_01_26_115523_create_permission_role_table', 1),
(7, '2016_02_09_132439_create_permission_user_table', 1),
(8, '2016_10_17_000000_create_cegs_table', 2),
(9, '2016_10_28_154057_create_workers_table', 2),
(12, '2017_09_28_155959_create_times_table', 2),
(13, '2017_09_29_153402_create_days_table', 2),
(14, '2019_12_08_000236_create_activity_log_table', 3),
(17, '2020_01_17_181835_create_storeds_table', 5),
(18, '2016_01_25_153402_create_files_table', 6),
(19, '2016_01_26_115523_create_day_file_table', 6),
(20, '2016_01_25_153402_create_bookings_table', 7),
(21, '2016_01_26_115523_create_booking_file_table', 7),
(22, '2016_01_25_153402_create_docs_table', 8),
(23, '2016_01_25_153403_create_doctemplates_table', 9),
(25, '2017_09_28_153918_create_daytypes_table', 10),
(26, '2017_09_28_153916_create_timetypes_table', 11),
(27, '2017_09_29_153402_create_basedays_table', 12);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `model`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Can View Users', 'view.users', 'Can view users', 'Permission', '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(2, 'Can Create Users', 'create.users', 'Can create new users', 'Permission', '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(3, 'Can Edit Users', 'edit.users', 'Can edit users', 'Permission', '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(4, 'Can Delete Users', 'delete.users', 'Can delete users', 'Permission', '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(2, 2, 2, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(3, 3, 2, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(4, 4, 2, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'superadmin', 'superadmin', 'superadmin role', 100, NULL, NULL, NULL),
(2, 'admin', 'admin', 'admin role', 60, NULL, NULL, NULL),
(3, 'owner', 'owner', 'owner role', 50, NULL, NULL, NULL),
(4, 'manager', 'manager', 'manager role', 40, NULL, NULL, NULL),
(5, 'workadmin', 'workadmin', 'workadmin role', 30, NULL, NULL, NULL),
(6, 'moderator', 'moderator', 'moderator role', 20, NULL, NULL, NULL),
(7, 'worker', 'worker', 'worker role', 10, NULL, NULL, NULL),
(8, 'user', 'user', 'user role', 5, NULL, NULL, NULL),
(9, 'unverified', 'unverified', 'unverified role', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(2, 2, 1, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(3, 2, 2, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(4, 3, 1, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(5, 4, 1, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(6, 5, 1, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(7, 6, 1, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(8, 7, 1, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(9, 8, 1, '2019-12-07 21:43:26', '2019-12-07 21:43:26', NULL),
(34, 3, 27, '2020-05-13 14:16:23', '2020-05-13 14:16:23', NULL),
(35, 4, 27, '2020-05-13 14:16:23', '2020-05-13 14:16:23', NULL),
(36, 5, 27, '2020-05-13 14:16:23', '2020-05-13 14:16:23', NULL),
(37, 7, 28, '2020-05-13 14:18:59', '2020-05-13 14:18:59', NULL),
(38, 3, 29, '2020-05-14 15:31:41', '2020-05-14 15:31:41', NULL),
(39, 4, 29, '2020-05-14 15:31:41', '2020-05-14 15:31:41', NULL),
(40, 5, 29, '2020-05-14 15:31:41', '2020-05-14 15:31:41', NULL),
(41, 7, 30, '2020-05-14 15:45:26', '2020-05-14 15:45:26', NULL),
(45, 7, 33, '2021-01-17 16:40:50', '2021-01-17 16:40:50', NULL),
(46, 3, 35, '2021-01-17 16:59:04', '2021-01-17 16:59:04', NULL),
(47, 4, 35, '2021-01-17 16:59:04', '2021-01-17 16:59:04', NULL),
(48, 5, 35, '2021-01-17 16:59:04', '2021-01-17 16:59:04', NULL),
(49, 7, 36, '2021-01-17 17:05:51', '2021-01-17 17:05:51', NULL),
(50, 7, 37, '2021-01-23 11:23:57', '2021-01-23 11:23:57', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `storeds`
--

CREATE TABLE `storeds` (
  `id` int(10) UNSIGNED NOT NULL,
  `ceg_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `worker_id` int(10) UNSIGNED NOT NULL,
  `datum` date NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fulldata` longtext CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `solverdata` longtext CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `lezarva` tinyint(1) NOT NULL DEFAULT 0,
  `pub` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `storeds`
--

INSERT INTO `storeds` (`id`, `ceg_id`, `user_id`, `worker_id`, `datum`, `name`, `note`, `fulldata`, `solverdata`, `lezarva`, `pub`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 8, 30, 9, '2020-05-01', '2020-05-9', NULL, '{\"calendarbase\":{\"1111-11-0\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":0,\"weekOfYear\":18,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-1\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":1,\"weekOfYear\":18,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-2\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":2,\"weekOfYear\":18,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-3\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":3,\"weekOfYear\":18,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"2020-05-01\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":1,\"datum\":\"2020-05-01\",\"weekOfYear\":18,\"dayOfYear\":122,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-02\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":2,\"datum\":\"2020-05-02\",\"weekOfYear\":18,\"dayOfYear\":123,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-03\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":3,\"datum\":\"2020-05-03\",\"weekOfYear\":18,\"dayOfYear\":124,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-04\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":4,\"datum\":\"2020-05-04\",\"weekOfYear\":19,\"dayOfYear\":125,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-05\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":5,\"datum\":\"2020-05-05\",\"weekOfYear\":19,\"dayOfYear\":126,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-06\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":6,\"datum\":\"2020-05-06\",\"weekOfYear\":19,\"dayOfYear\":127,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-07\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":7,\"datum\":\"2020-05-07\",\"weekOfYear\":19,\"dayOfYear\":128,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-08\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":8,\"datum\":\"2020-05-08\",\"weekOfYear\":19,\"dayOfYear\":129,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-09\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":9,\"datum\":\"2020-05-09\",\"weekOfYear\":19,\"dayOfYear\":130,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-10\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":10,\"datum\":\"2020-05-10\",\"weekOfYear\":19,\"dayOfYear\":131,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-11\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":11,\"datum\":\"2020-05-11\",\"weekOfYear\":20,\"dayOfYear\":132,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-12\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":12,\"datum\":\"2020-05-12\",\"weekOfYear\":20,\"dayOfYear\":133,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-13\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":13,\"datum\":\"2020-05-13\",\"weekOfYear\":20,\"dayOfYear\":134,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-14\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":14,\"datum\":\"2020-05-14\",\"weekOfYear\":20,\"dayOfYear\":135,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-15\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":15,\"datum\":\"2020-05-15\",\"weekOfYear\":20,\"dayOfYear\":136,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-16\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":16,\"datum\":\"2020-05-16\",\"weekOfYear\":20,\"dayOfYear\":137,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-17\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":17,\"datum\":\"2020-05-17\",\"weekOfYear\":20,\"dayOfYear\":138,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-18\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":18,\"datum\":\"2020-05-18\",\"weekOfYear\":21,\"dayOfYear\":139,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-19\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":19,\"datum\":\"2020-05-19\",\"weekOfYear\":21,\"dayOfYear\":140,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-20\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":20,\"datum\":\"2020-05-20\",\"weekOfYear\":21,\"dayOfYear\":141,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-21\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":21,\"datum\":\"2020-05-21\",\"weekOfYear\":21,\"dayOfYear\":142,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-22\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":22,\"datum\":\"2020-05-22\",\"weekOfYear\":21,\"dayOfYear\":143,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-23\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":23,\"datum\":\"2020-05-23\",\"weekOfYear\":21,\"dayOfYear\":144,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-24\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":24,\"datum\":\"2020-05-24\",\"weekOfYear\":21,\"dayOfYear\":145,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-25\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":25,\"datum\":\"2020-05-25\",\"weekOfYear\":22,\"dayOfYear\":146,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-26\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":26,\"datum\":\"2020-05-26\",\"weekOfYear\":22,\"dayOfYear\":147,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-27\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":27,\"datum\":\"2020-05-27\",\"weekOfYear\":22,\"dayOfYear\":148,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-28\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":28,\"datum\":\"2020-05-28\",\"weekOfYear\":22,\"dayOfYear\":149,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-29\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":29,\"datum\":\"2020-05-29\",\"weekOfYear\":22,\"dayOfYear\":150,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-30\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":30,\"datum\":\"2020-05-30\",\"weekOfYear\":22,\"dayOfYear\":151,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-31\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":31,\"datum\":\"2020-05-31\",\"weekOfYear\":22,\"dayOfYear\":152,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"calendar\":{\"1-18\":{\"1111-11-0\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":0,\"weekOfYear\":18,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-1\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":1,\"weekOfYear\":18,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-2\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":2,\"weekOfYear\":18,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-3\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":3,\"weekOfYear\":18,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"2020-05-01\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":1,\"datum\":\"2020-05-01\",\"weekOfYear\":18,\"dayOfYear\":122,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-02\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":2,\"datum\":\"2020-05-02\",\"weekOfYear\":18,\"dayOfYear\":123,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-03\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":3,\"datum\":\"2020-05-03\",\"weekOfYear\":18,\"dayOfYear\":124,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"2-19\":{\"2020-05-04\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":4,\"datum\":\"2020-05-04\",\"weekOfYear\":19,\"dayOfYear\":125,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-05\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":5,\"datum\":\"2020-05-05\",\"weekOfYear\":19,\"dayOfYear\":126,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-06\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":6,\"datum\":\"2020-05-06\",\"weekOfYear\":19,\"dayOfYear\":127,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-07\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":7,\"datum\":\"2020-05-07\",\"weekOfYear\":19,\"dayOfYear\":128,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-08\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":8,\"datum\":\"2020-05-08\",\"weekOfYear\":19,\"dayOfYear\":129,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-09\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":9,\"datum\":\"2020-05-09\",\"weekOfYear\":19,\"dayOfYear\":130,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-10\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":10,\"datum\":\"2020-05-10\",\"weekOfYear\":19,\"dayOfYear\":131,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"3-20\":{\"2020-05-11\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":11,\"datum\":\"2020-05-11\",\"weekOfYear\":20,\"dayOfYear\":132,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-12\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":12,\"datum\":\"2020-05-12\",\"weekOfYear\":20,\"dayOfYear\":133,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-13\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":13,\"datum\":\"2020-05-13\",\"weekOfYear\":20,\"dayOfYear\":134,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-14\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":14,\"datum\":\"2020-05-14\",\"weekOfYear\":20,\"dayOfYear\":135,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-15\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":15,\"datum\":\"2020-05-15\",\"weekOfYear\":20,\"dayOfYear\":136,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-16\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":16,\"datum\":\"2020-05-16\",\"weekOfYear\":20,\"dayOfYear\":137,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-17\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":17,\"datum\":\"2020-05-17\",\"weekOfYear\":20,\"dayOfYear\":138,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"4-21\":{\"2020-05-18\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":18,\"datum\":\"2020-05-18\",\"weekOfYear\":21,\"dayOfYear\":139,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-19\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":19,\"datum\":\"2020-05-19\",\"weekOfYear\":21,\"dayOfYear\":140,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-20\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":20,\"datum\":\"2020-05-20\",\"weekOfYear\":21,\"dayOfYear\":141,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-21\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":21,\"datum\":\"2020-05-21\",\"weekOfYear\":21,\"dayOfYear\":142,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-22\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":22,\"datum\":\"2020-05-22\",\"weekOfYear\":21,\"dayOfYear\":143,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-23\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":23,\"datum\":\"2020-05-23\",\"weekOfYear\":21,\"dayOfYear\":144,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-24\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":24,\"datum\":\"2020-05-24\",\"weekOfYear\":21,\"dayOfYear\":145,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"5-22\":{\"2020-05-25\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":25,\"datum\":\"2020-05-25\",\"weekOfYear\":22,\"dayOfYear\":146,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-26\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":26,\"datum\":\"2020-05-26\",\"weekOfYear\":22,\"dayOfYear\":147,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-27\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":27,\"datum\":\"2020-05-27\",\"weekOfYear\":22,\"dayOfYear\":148,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-28\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":28,\"datum\":\"2020-05-28\",\"weekOfYear\":22,\"dayOfYear\":149,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-29\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":29,\"datum\":\"2020-05-29\",\"weekOfYear\":22,\"dayOfYear\":150,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2020-05-30\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":30,\"datum\":\"2020-05-30\",\"weekOfYear\":22,\"dayOfYear\":151,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2020-05-31\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":31,\"datum\":\"2020-05-31\",\"weekOfYear\":22,\"dayOfYear\":152,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}}},\"basedays\":[],\"times\":{\"datekey\":{\"9\":[]},\"idkey\":[]},\"workerdays\":{\"datekey\":{\"9\":[]},\"idkey\":[]},\"worker_id\":9}', '{\"workerdays\":[1,4,5,6,7,8,11,12,13,14,15,18,19,20,21,22,25,26,27,28,29],\"sumWorkerdays\":21}', 0, 0, '2020-05-14 15:48:33', '2020-05-17 13:58:06', NULL),
(9, 10, 36, 11, '2021-01-01', '2021-01-11', NULL, '{\"calendarbase\":{\"1111-11-0\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":0,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-1\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":1,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-2\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":2,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-3\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":3,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"2021-01-01\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":1,\"datum\":\"2021-01-01\",\"weekOfYear\":53,\"dayOfYear\":1,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-02\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":2,\"datum\":\"2021-01-02\",\"weekOfYear\":53,\"dayOfYear\":2,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-03\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":3,\"datum\":\"2021-01-03\",\"weekOfYear\":53,\"dayOfYear\":3,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-04\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":4,\"datum\":\"2021-01-04\",\"weekOfYear\":1,\"dayOfYear\":4,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-05\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":5,\"datum\":\"2021-01-05\",\"weekOfYear\":1,\"dayOfYear\":5,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-06\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":6,\"datum\":\"2021-01-06\",\"weekOfYear\":1,\"dayOfYear\":6,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-07\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":7,\"datum\":\"2021-01-07\",\"weekOfYear\":1,\"dayOfYear\":7,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-08\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":8,\"datum\":\"2021-01-08\",\"weekOfYear\":1,\"dayOfYear\":8,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-09\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":9,\"datum\":\"2021-01-09\",\"weekOfYear\":1,\"dayOfYear\":9,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-10\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":10,\"datum\":\"2021-01-10\",\"weekOfYear\":1,\"dayOfYear\":10,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-11\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":11,\"datum\":\"2021-01-11\",\"weekOfYear\":2,\"dayOfYear\":11,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-12\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":12,\"datum\":\"2021-01-12\",\"weekOfYear\":2,\"dayOfYear\":12,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-13\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":13,\"datum\":\"2021-01-13\",\"weekOfYear\":2,\"dayOfYear\":13,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-14\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":14,\"datum\":\"2021-01-14\",\"weekOfYear\":2,\"dayOfYear\":14,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-15\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":15,\"datum\":\"2021-01-15\",\"weekOfYear\":2,\"dayOfYear\":15,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-16\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":16,\"datum\":\"2021-01-16\",\"weekOfYear\":2,\"dayOfYear\":16,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-17\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":17,\"datum\":\"2021-01-17\",\"weekOfYear\":2,\"dayOfYear\":17,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-18\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":18,\"datum\":\"2021-01-18\",\"weekOfYear\":3,\"dayOfYear\":18,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-19\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":19,\"datum\":\"2021-01-19\",\"weekOfYear\":3,\"dayOfYear\":19,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-20\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":20,\"datum\":\"2021-01-20\",\"weekOfYear\":3,\"dayOfYear\":20,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-21\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":21,\"datum\":\"2021-01-21\",\"weekOfYear\":3,\"dayOfYear\":21,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-22\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":22,\"datum\":\"2021-01-22\",\"weekOfYear\":3,\"dayOfYear\":22,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-23\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":23,\"datum\":\"2021-01-23\",\"weekOfYear\":3,\"dayOfYear\":23,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-24\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":24,\"datum\":\"2021-01-24\",\"weekOfYear\":3,\"dayOfYear\":24,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-25\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":25,\"datum\":\"2021-01-25\",\"weekOfYear\":4,\"dayOfYear\":25,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-26\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":26,\"datum\":\"2021-01-26\",\"weekOfYear\":4,\"dayOfYear\":26,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-27\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":27,\"datum\":\"2021-01-27\",\"weekOfYear\":4,\"dayOfYear\":27,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-28\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":28,\"datum\":\"2021-01-28\",\"weekOfYear\":4,\"dayOfYear\":28,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-29\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":29,\"datum\":\"2021-01-29\",\"weekOfYear\":4,\"dayOfYear\":29,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-30\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":30,\"datum\":\"2021-01-30\",\"weekOfYear\":4,\"dayOfYear\":30,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-31\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":31,\"datum\":\"2021-01-31\",\"weekOfYear\":4,\"dayOfYear\":31,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"calendar\":{\"1-53\":{\"1111-11-0\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":0,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-1\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":1,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-2\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":2,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-3\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":3,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"2021-01-01\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":1,\"datum\":\"2021-01-01\",\"weekOfYear\":53,\"dayOfYear\":1,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-02\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":2,\"datum\":\"2021-01-02\",\"weekOfYear\":53,\"dayOfYear\":2,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-03\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":3,\"datum\":\"2021-01-03\",\"weekOfYear\":53,\"dayOfYear\":3,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"2-1\":{\"2021-01-04\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":4,\"datum\":\"2021-01-04\",\"weekOfYear\":1,\"dayOfYear\":4,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-05\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":5,\"datum\":\"2021-01-05\",\"weekOfYear\":1,\"dayOfYear\":5,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-06\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":6,\"datum\":\"2021-01-06\",\"weekOfYear\":1,\"dayOfYear\":6,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-07\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":7,\"datum\":\"2021-01-07\",\"weekOfYear\":1,\"dayOfYear\":7,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-08\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":8,\"datum\":\"2021-01-08\",\"weekOfYear\":1,\"dayOfYear\":8,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-09\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":9,\"datum\":\"2021-01-09\",\"weekOfYear\":1,\"dayOfYear\":9,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-10\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":10,\"datum\":\"2021-01-10\",\"weekOfYear\":1,\"dayOfYear\":10,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"3-2\":{\"2021-01-11\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":11,\"datum\":\"2021-01-11\",\"weekOfYear\":2,\"dayOfYear\":11,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-12\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":12,\"datum\":\"2021-01-12\",\"weekOfYear\":2,\"dayOfYear\":12,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-13\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":13,\"datum\":\"2021-01-13\",\"weekOfYear\":2,\"dayOfYear\":13,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-14\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":14,\"datum\":\"2021-01-14\",\"weekOfYear\":2,\"dayOfYear\":14,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-15\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":15,\"datum\":\"2021-01-15\",\"weekOfYear\":2,\"dayOfYear\":15,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-16\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":16,\"datum\":\"2021-01-16\",\"weekOfYear\":2,\"dayOfYear\":16,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-17\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":17,\"datum\":\"2021-01-17\",\"weekOfYear\":2,\"dayOfYear\":17,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"4-3\":{\"2021-01-18\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":18,\"datum\":\"2021-01-18\",\"weekOfYear\":3,\"dayOfYear\":18,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-19\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":19,\"datum\":\"2021-01-19\",\"weekOfYear\":3,\"dayOfYear\":19,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-20\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":20,\"datum\":\"2021-01-20\",\"weekOfYear\":3,\"dayOfYear\":20,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-21\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":21,\"datum\":\"2021-01-21\",\"weekOfYear\":3,\"dayOfYear\":21,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-22\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":22,\"datum\":\"2021-01-22\",\"weekOfYear\":3,\"dayOfYear\":22,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-23\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":23,\"datum\":\"2021-01-23\",\"weekOfYear\":3,\"dayOfYear\":23,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-24\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":24,\"datum\":\"2021-01-24\",\"weekOfYear\":3,\"dayOfYear\":24,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"5-4\":{\"2021-01-25\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":25,\"datum\":\"2021-01-25\",\"weekOfYear\":4,\"dayOfYear\":25,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-26\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":26,\"datum\":\"2021-01-26\",\"weekOfYear\":4,\"dayOfYear\":26,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-27\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":27,\"datum\":\"2021-01-27\",\"weekOfYear\":4,\"dayOfYear\":27,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-28\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":28,\"datum\":\"2021-01-28\",\"weekOfYear\":4,\"dayOfYear\":28,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-29\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":29,\"datum\":\"2021-01-29\",\"weekOfYear\":4,\"dayOfYear\":29,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-30\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":30,\"datum\":\"2021-01-30\",\"weekOfYear\":4,\"dayOfYear\":30,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-31\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":31,\"datum\":\"2021-01-31\",\"weekOfYear\":4,\"dayOfYear\":31,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}}},\"basedays\":[],\"times\":{\"datekey\":{\"11\":[]},\"idkey\":[]},\"workerdays\":{\"datekey\":{\"11\":[]},\"idkey\":[]},\"worker_id\":11}', '{\"workerdays\":[1,4,5,6,7,8,11,12,13,14,15,18,19,20,21,22,25,26,27,28,29],\"sumWorkerdays\":21}', 0, 0, '2021-01-23 11:52:25', '2021-01-23 11:52:25', NULL),
(10, 10, 37, 12, '2021-01-01', '2021-01-12', NULL, '{\"calendarbase\":{\"1111-11-0\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":0,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-1\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":1,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-2\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":2,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-3\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":3,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"2021-01-01\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":1,\"datum\":\"2021-01-01\",\"weekOfYear\":53,\"dayOfYear\":1,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-02\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":2,\"datum\":\"2021-01-02\",\"weekOfYear\":53,\"dayOfYear\":2,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-03\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":3,\"datum\":\"2021-01-03\",\"weekOfYear\":53,\"dayOfYear\":3,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-04\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":4,\"datum\":\"2021-01-04\",\"weekOfYear\":1,\"dayOfYear\":4,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-05\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":5,\"datum\":\"2021-01-05\",\"weekOfYear\":1,\"dayOfYear\":5,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-06\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":6,\"datum\":\"2021-01-06\",\"weekOfYear\":1,\"dayOfYear\":6,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-07\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":7,\"datum\":\"2021-01-07\",\"weekOfYear\":1,\"dayOfYear\":7,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-08\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":8,\"datum\":\"2021-01-08\",\"weekOfYear\":1,\"dayOfYear\":8,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-09\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":9,\"datum\":\"2021-01-09\",\"weekOfYear\":1,\"dayOfYear\":9,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-10\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":10,\"datum\":\"2021-01-10\",\"weekOfYear\":1,\"dayOfYear\":10,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-11\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":11,\"datum\":\"2021-01-11\",\"weekOfYear\":2,\"dayOfYear\":11,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-12\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":12,\"datum\":\"2021-01-12\",\"weekOfYear\":2,\"dayOfYear\":12,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-13\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":13,\"datum\":\"2021-01-13\",\"weekOfYear\":2,\"dayOfYear\":13,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-14\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":14,\"datum\":\"2021-01-14\",\"weekOfYear\":2,\"dayOfYear\":14,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-15\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":15,\"datum\":\"2021-01-15\",\"weekOfYear\":2,\"dayOfYear\":15,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-16\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":16,\"datum\":\"2021-01-16\",\"weekOfYear\":2,\"dayOfYear\":16,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-17\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":17,\"datum\":\"2021-01-17\",\"weekOfYear\":2,\"dayOfYear\":17,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-18\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":18,\"datum\":\"2021-01-18\",\"weekOfYear\":3,\"dayOfYear\":18,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-19\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":19,\"datum\":\"2021-01-19\",\"weekOfYear\":3,\"dayOfYear\":19,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-20\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":20,\"datum\":\"2021-01-20\",\"weekOfYear\":3,\"dayOfYear\":20,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-21\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":21,\"datum\":\"2021-01-21\",\"weekOfYear\":3,\"dayOfYear\":21,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-22\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":22,\"datum\":\"2021-01-22\",\"weekOfYear\":3,\"dayOfYear\":22,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-23\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":23,\"datum\":\"2021-01-23\",\"weekOfYear\":3,\"dayOfYear\":23,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-24\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":24,\"datum\":\"2021-01-24\",\"weekOfYear\":3,\"dayOfYear\":24,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-25\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":25,\"datum\":\"2021-01-25\",\"weekOfYear\":4,\"dayOfYear\":25,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-26\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":26,\"datum\":\"2021-01-26\",\"weekOfYear\":4,\"dayOfYear\":26,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-27\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":27,\"datum\":\"2021-01-27\",\"weekOfYear\":4,\"dayOfYear\":27,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-28\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":28,\"datum\":\"2021-01-28\",\"weekOfYear\":4,\"dayOfYear\":28,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-29\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":29,\"datum\":\"2021-01-29\",\"weekOfYear\":4,\"dayOfYear\":29,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-30\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":30,\"datum\":\"2021-01-30\",\"weekOfYear\":4,\"dayOfYear\":30,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-31\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":31,\"datum\":\"2021-01-31\",\"weekOfYear\":4,\"dayOfYear\":31,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"calendar\":{\"1-53\":{\"1111-11-0\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":0,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-1\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":1,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-2\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":2,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"1111-11-3\":{\"daytype\":\"\",\"name\":\"empty\",\"day\":\"\",\"dayOfWeek\":3,\"weekOfYear\":53,\"dayOfYear\":0,\"daytype_id\":0,\"times\":[],\"type\":\"E\",\"munkanap\":false},\"2021-01-01\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":1,\"datum\":\"2021-01-01\",\"weekOfYear\":53,\"dayOfYear\":1,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-02\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":2,\"datum\":\"2021-01-02\",\"weekOfYear\":53,\"dayOfYear\":2,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-03\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":3,\"datum\":\"2021-01-03\",\"weekOfYear\":53,\"dayOfYear\":3,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"2-1\":{\"2021-01-04\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":4,\"datum\":\"2021-01-04\",\"weekOfYear\":1,\"dayOfYear\":4,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-05\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":5,\"datum\":\"2021-01-05\",\"weekOfYear\":1,\"dayOfYear\":5,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-06\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":6,\"datum\":\"2021-01-06\",\"weekOfYear\":1,\"dayOfYear\":6,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-07\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":7,\"datum\":\"2021-01-07\",\"weekOfYear\":1,\"dayOfYear\":7,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-08\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":8,\"datum\":\"2021-01-08\",\"weekOfYear\":1,\"dayOfYear\":8,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-09\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":9,\"datum\":\"2021-01-09\",\"weekOfYear\":1,\"dayOfYear\":9,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-10\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":10,\"datum\":\"2021-01-10\",\"weekOfYear\":1,\"dayOfYear\":10,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"3-2\":{\"2021-01-11\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":11,\"datum\":\"2021-01-11\",\"weekOfYear\":2,\"dayOfYear\":11,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-12\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":12,\"datum\":\"2021-01-12\",\"weekOfYear\":2,\"dayOfYear\":12,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-13\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":13,\"datum\":\"2021-01-13\",\"weekOfYear\":2,\"dayOfYear\":13,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-14\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":14,\"datum\":\"2021-01-14\",\"weekOfYear\":2,\"dayOfYear\":14,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-15\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":15,\"datum\":\"2021-01-15\",\"weekOfYear\":2,\"dayOfYear\":15,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-16\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":16,\"datum\":\"2021-01-16\",\"weekOfYear\":2,\"dayOfYear\":16,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-17\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":17,\"datum\":\"2021-01-17\",\"weekOfYear\":2,\"dayOfYear\":17,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"4-3\":{\"2021-01-18\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":18,\"datum\":\"2021-01-18\",\"weekOfYear\":3,\"dayOfYear\":18,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-19\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":19,\"datum\":\"2021-01-19\",\"weekOfYear\":3,\"dayOfYear\":19,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-20\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":20,\"datum\":\"2021-01-20\",\"weekOfYear\":3,\"dayOfYear\":20,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-21\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":21,\"datum\":\"2021-01-21\",\"weekOfYear\":3,\"dayOfYear\":21,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-22\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":22,\"datum\":\"2021-01-22\",\"weekOfYear\":3,\"dayOfYear\":22,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-23\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":23,\"datum\":\"2021-01-23\",\"weekOfYear\":3,\"dayOfYear\":23,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-24\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":24,\"datum\":\"2021-01-24\",\"weekOfYear\":3,\"dayOfYear\":24,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}},\"5-4\":{\"2021-01-25\":{\"daytype\":\"Munkanap\",\"name\":\"h\\u00e9tf\\u0151\",\"day\":25,\"datum\":\"2021-01-25\",\"weekOfYear\":4,\"dayOfYear\":25,\"dayOfWeek\":1,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-26\":{\"daytype\":\"Munkanap\",\"name\":\"kedd\",\"day\":26,\"datum\":\"2021-01-26\",\"weekOfYear\":4,\"dayOfYear\":26,\"dayOfWeek\":2,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-27\":{\"daytype\":\"Munkanap\",\"name\":\"szerda\",\"day\":27,\"datum\":\"2021-01-27\",\"weekOfYear\":4,\"dayOfYear\":27,\"dayOfWeek\":3,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-28\":{\"daytype\":\"Munkanap\",\"name\":\"cs\\u00fct\\u00f6rt\\u00f6k\",\"day\":28,\"datum\":\"2021-01-28\",\"weekOfYear\":4,\"dayOfYear\":28,\"dayOfWeek\":4,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-29\":{\"daytype\":\"Munkanap\",\"name\":\"p\\u00e9ntek\",\"day\":29,\"datum\":\"2021-01-29\",\"weekOfYear\":4,\"dayOfYear\":29,\"dayOfWeek\":5,\"munkanap\":true,\"class\":\"workday\",\"times\":[]},\"2021-01-30\":{\"daytype\":\"Pihen\\u0151nap\",\"name\":\"szombat\",\"day\":30,\"datum\":\"2021-01-30\",\"weekOfYear\":4,\"dayOfYear\":30,\"dayOfWeek\":6,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]},\"2021-01-31\":{\"daytype\":\"Szabadnap\",\"name\":\"vas\\u00e1rnap\",\"day\":31,\"datum\":\"2021-01-31\",\"weekOfYear\":4,\"dayOfYear\":31,\"dayOfWeek\":0,\"munkanap\":false,\"class\":\"freeday\",\"times\":[]}}},\"basedays\":[],\"times\":{\"datekey\":{\"12\":[]},\"idkey\":[]},\"workerdays\":{\"datekey\":{\"12\":[]},\"idkey\":[]},\"worker_id\":12}', '{\"workerdays\":[1,4,5,6,7,8,11,12,13,14,15,18,19,20,21,22,25,26,27,28,29],\"sumWorkerdays\":21}', 0, 0, '2021-01-23 11:52:25', '2021-01-23 11:52:25', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `times`
--

CREATE TABLE `times` (
  `id` int(10) UNSIGNED NOT NULL,
  `worker_id` int(10) UNSIGNED NOT NULL,
  `timetype_id` int(10) UNSIGNED NOT NULL,
  `datum` date NOT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `hour` int(11) NOT NULL,
  `adnote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `worknote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pub` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `times`
--

INSERT INTO `times` (`id`, `worker_id`, `timetype_id`, `datum`, `start`, `end`, `hour`, `adnote`, `worknote`, `pub`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 11, 1, '2021-03-12', NULL, NULL, 4, NULL, NULL, 50, '2021-03-18 18:52:16', '2021-03-18 18:52:16', NULL),
(4, 11, 1, '2021-03-05', NULL, NULL, 5, NULL, NULL, 50, '2021-03-18 19:31:40', '2021-03-18 19:31:59', '2021-03-18 19:31:59'),
(5, 11, 1, '2021-03-06', NULL, NULL, 5, NULL, NULL, 50, '2021-03-18 19:31:40', '2021-03-18 19:31:59', '2021-03-18 19:31:59'),
(6, 11, 1, '2021-03-05', NULL, NULL, 5, NULL, NULL, 50, '2021-03-18 19:32:15', '2021-03-20 07:59:30', '2021-03-20 07:59:30'),
(7, 11, 1, '2021-03-06', NULL, NULL, 5, NULL, NULL, 50, '2021-03-18 19:32:15', '2021-03-18 19:32:15', NULL),
(8, 12, 1, '2021-03-04', NULL, NULL, 2, NULL, NULL, 50, '2021-03-18 19:51:13', '2021-03-18 19:51:13', NULL),
(16, 11, 2, '2021-03-10', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 07:58:58', '2021-03-20 07:58:58', NULL),
(17, 11, 3, '2021-03-10', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 07:59:06', '2021-03-20 07:59:06', NULL),
(18, 11, 3, '2021-03-03', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 07:59:06', '2021-03-20 07:59:06', NULL),
(19, 11, 5, '2021-03-05', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 08:06:23', '2021-03-20 08:06:23', NULL),
(20, 11, 5, '2021-03-05', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 08:06:26', '2021-03-20 08:06:26', NULL),
(21, 11, 5, '2021-08-03', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 08:06:26', '2021-03-20 08:06:26', NULL),
(22, 11, 1, '2021-03-02', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 21:01:30', '2021-03-20 21:01:30', NULL),
(23, 11, 1, '2021-03-01', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 21:04:27', '2021-03-20 21:04:27', NULL),
(24, 11, 1, '2021-03-01', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 21:13:12', '2021-03-20 21:13:12', NULL),
(25, 11, 1, '2021-03-01', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 21:14:38', '2021-03-20 21:14:38', NULL),
(26, 11, 1, '2021-03-15', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 21:16:36', '2021-03-20 21:16:36', NULL),
(27, 11, 1, '2021-03-23', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 21:45:59', '2021-03-20 21:45:59', NULL),
(28, 11, 1, '2021-03-24', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 21:45:59', '2021-03-20 21:45:59', NULL),
(29, 11, 1, '2021-03-25', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 21:48:45', '2021-03-20 21:48:45', NULL),
(30, 11, 1, '2021-03-19', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 21:52:46', '2021-03-20 21:53:23', '2021-03-20 21:53:23'),
(31, 11, 2, '2021-03-19', NULL, NULL, 8, NULL, NULL, 50, '2021-03-20 21:59:33', '2021-03-20 21:59:33', NULL),
(32, 11, 1, '2021-03-04', NULL, NULL, 8, NULL, NULL, 50, '2021-03-22 17:52:33', '2021-03-22 17:52:33', NULL),
(33, 12, 1, '2021-03-11', NULL, NULL, 8, NULL, NULL, 50, '2021-03-23 17:00:28', '2021-03-23 17:00:28', NULL),
(34, 12, 2, '2021-03-11', NULL, NULL, 4, NULL, NULL, 50, '2021-03-23 17:00:46', '2021-03-23 17:00:46', NULL),
(35, 12, 2, '2021-03-18', NULL, NULL, 4, NULL, NULL, 50, '2021-03-23 17:00:46', '2021-03-23 17:00:46', NULL),
(36, 12, 1, '2021-03-02', NULL, NULL, 8, NULL, NULL, 50, '2021-03-28 08:12:27', '2021-03-28 08:12:27', NULL),
(37, 12, 1, '2021-03-02', NULL, NULL, 8, NULL, NULL, 50, '2021-03-28 08:12:40', '2021-03-28 08:12:40', NULL),
(38, 12, 1, '2021-03-02', NULL, NULL, 8, NULL, NULL, 50, '2021-03-28 08:20:57', '2021-03-28 08:20:57', NULL),
(39, 12, 1, '2021-03-12', NULL, NULL, 8, NULL, NULL, 50, '2021-03-28 08:25:36', '2021-03-28 08:28:27', '2021-03-28 08:28:27'),
(40, 12, 1, '2021-03-19', NULL, NULL, 8, NULL, NULL, 50, '2021-03-28 08:25:36', '2021-03-28 08:28:27', '2021-03-28 08:28:27'),
(41, 12, 2, '2021-03-12', NULL, NULL, 4, NULL, NULL, 50, '2021-03-28 08:28:44', '2021-03-28 08:28:44', NULL),
(42, 12, 2, '2021-03-19', NULL, NULL, 4, NULL, NULL, 50, '2021-03-28 08:28:44', '2021-03-28 08:28:44', NULL),
(43, 12, 1, '2021-03-26', NULL, NULL, 1, NULL, NULL, 50, '2021-03-28 08:57:51', '2021-03-28 08:57:57', '2021-03-28 08:57:57'),
(44, 12, 1, '2021-03-26', NULL, NULL, 0, NULL, NULL, 50, '2021-03-28 08:58:15', '2021-03-28 08:58:15', NULL),
(45, 11, 1, '2021-04-01', '00:00:00', '00:00:00', 8, NULL, NULL, 50, '2021-03-30 17:17:44', '2021-03-30 17:17:44', NULL),
(46, 12, 1, '2021-04-01', '00:00:00', '00:00:00', 8, NULL, NULL, 50, '2021-04-01 15:09:45', '2021-04-01 15:09:45', NULL),
(47, 12, 1, '2021-04-09', '00:00:00', '00:00:00', 8, NULL, NULL, 50, '2021-04-01 15:09:45', '2021-04-01 15:09:45', NULL),
(48, 11, 1, '2021-04-14', '00:00:00', '00:00:00', 8, NULL, NULL, 50, '2021-04-06 15:25:29', '2021-04-06 15:25:29', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `timetypes`
--

CREATE TABLE `timetypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `ceg_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `szorzo` decimal(4,2) DEFAULT 1.00,
  `fixplusz` int(11) DEFAULT 0,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basehour` int(11) NOT NULL DEFAULT 1,
  `start` time NOT NULL DEFAULT '00:00:00',
  `end` time NOT NULL DEFAULT '00:00:00',
  `note` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pub` smallint(6) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `timetypes`
--

INSERT INTO `timetypes` (`id`, `ceg_id`, `name`, `szorzo`, `fixplusz`, `color`, `background`, `basehour`, `start`, `end`, `note`, `pub`) VALUES
(1, 1, 'alap', '1.00', 0, '#0066ff', NULL, 8, '00:00:00', '00:00:00', 'sima alap nyolcórás munka', 0),
(2, 1, 'éjszakás', '1.50', 0, '#ff3333', NULL, 8, '00:00:00', '00:00:00', NULL, 0),
(3, 1, 'négyórás', NULL, 0, '#339966', NULL, 4, '00:00:00', '00:00:00', NULL, 0),
(4, 1, 'túlóra', '2.00', 0, '#ff0000', NULL, 0, '00:00:00', '00:00:00', '100%', 0),
(5, 1, 'nincs', NULL, 0, '#333333', NULL, 0, '00:00:00', '00:00:00', 'nincs alapértelmezett óraszám', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Szuperadmin', 'root@dolgozo.com', NULL, '$2y$10$moXCPJnMVa//hlRNslZ5vuVTTXssTsbexEtgfoEAXl1STfqXlj8dK', NULL, NULL, NULL, NULL),
(2, 'admin', 'admin@dolgozo.com', NULL, '$2y$10$jjvGKRlaxsu.dYfYA2u92u95IF1/FRY7U1jyNISLshkrcbh3BcbbG', 'CQAjneewvBBhbiV02aWwgCwYUgVlinrgff1vsZBnZYPZJU01De3PilsERV9Y', NULL, NULL, NULL),
(27, 'prmanager1', 'prmanager1@gmail.com', NULL, '$2y$10$H2xr8W7dll6VNfpkFBl2fe.TaqdOxb6Bow2NlqYRYcdpVpMNq9l2y', NULL, '2020-05-13 14:16:22', '2020-05-13 14:16:22', NULL),
(28, 'Ottó Ménkű', 'menkuotto@gmail.com', NULL, '$2y$10$WfCPRzRAaIUEcP0lCgwXQeAw3x7rE0rVVRtqHu9VbXl9BM4Zr5C.e', NULL, '2020-05-13 14:18:59', '2020-05-13 14:18:59', NULL),
(29, 'Dr. Taczman Lajos', 'taczmanl@gmail.com', NULL, '$2y$10$.DX/cyvN1q9adLUUDynn1.j2WCJGpo5HmTo460UlZvQprnMRl6bya', 'LWb6tfA15IjcgZ7yJDXJkvxToPyYibWME9rYuTGCqRbxsym8qBckcPeDfSYo', '2020-05-14 15:31:41', '2020-05-17 13:47:39', NULL),
(30, 'Babjak', 'babjakeva@gmail.com', NULL, '$2y$10$U5pj666cJJ1h/N1JVLZqpuu8MYhGAXlKeC3ioo8Oq8iib8qgYH9Q6', 'CYNOHMB6Ubon3jld5ZbLI629of8MTQhZ03EimmHJ8MqmZcA7zPOw0z2LdjDf', '2020-05-14 15:45:26', '2020-05-17 13:49:07', NULL),
(33, 'Ottó Ménkű', 'menkuottfgtgeo@gmail.com', NULL, '$2y$10$GjwMC7fArAoHs/QgFPdWCu.iTkGyVIRxxVgvoIJqMWu/5fcgdYFSm', NULL, '2021-01-17 16:40:50', '2021-01-17 16:40:50', NULL),
(35, 'ggg', 'ggg2@gmail.com', NULL, '$2y$10$c4h61V2uLcbrg8TEHq4XweXtz8x1BNh/JdaB3qznkiKrElfeDiF7G', NULL, '2021-01-17 16:59:04', '2021-01-17 16:59:04', NULL),
(36, 'Ottó Ménkű', 'menkerfweuotto@gmail.com', NULL, '$2y$10$QGZvnW/0/qwqG.WaJG7lrO7G/jqvXfghWs3GnGTYRqQCA/Cfazgb2', NULL, '2021-01-17 17:05:51', '2021-01-17 17:05:51', NULL),
(37, 'yfb', 'mendfgkuotto@gmail.com', NULL, '$2y$10$8y6u2KXlgOIiZAwPPcHU9ev75JCHTVJs0usD2wcFI6sggVQIJvAWW', NULL, '2021-01-23 11:23:57', '2021-01-23 11:23:57', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `workers`
--

CREATE TABLE `workers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ceg_id` int(10) UNSIGNED NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `workername` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mothername` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alapber` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bertipus` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `szig` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cim` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `birthplace` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pub` smallint(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `workers`
--

INSERT INTO `workers` (`id`, `user_id`, `ceg_id`, `position`, `foto`, `fullname`, `workername`, `mothername`, `alapber`, `bertipus`, `szig`, `city`, `cim`, `tel`, `birth`, `birthplace`, `ado`, `tb`, `start`, `end`, `note`, `pub`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 28, 7, NULL, NULL, 'Ottó Ménkű', 'Ottó Ménkű', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-02', NULL, NULL, 1, '2020-05-13 14:18:59', '2020-05-13 14:22:52', NULL),
(9, 30, 8, 'Pénzügyi asszisztens', NULL, 'Babják Éva', 'Babjak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-05-14 15:45:26', '2020-05-14 15:45:26', NULL),
(10, 33, 9, '45tw34', NULL, 'Ottó Ménkű', 'Ottó Ménkű', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-06', NULL, NULL, 1, '2021-01-17 16:40:50', '2021-01-17 16:56:23', NULL),
(11, 36, 10, 'efwe', NULL, 'Ottó Ménkű', 'Ottó Ménkű', 'B. R.', NULL, NULL, NULL, 'jászberény', 'werw fbgsdfgs ', 'we', '1968-09-14', 'Jászberény', 'ewwer', 'we', '2021-01-29', NULL, NULL, 1, '2021-01-17 17:05:51', '2021-01-17 17:05:51', NULL),
(12, 37, 10, 'dgrs', NULL, 'dfgs', 'yfb', NULL, NULL, NULL, NULL, NULL, 'rgwe', 'erger', NULL, NULL, 'ertge', 'ertgew', '2021-01-29', NULL, NULL, 1, '2021-01-23 11:23:57', '2021-02-18 18:26:13', NULL);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_log_name_index` (`log_name`),
  ADD KEY `subject` (`subject_id`,`subject_type`),
  ADD KEY `causer` (`causer_id`,`causer_type`);

--
-- A tábla indexei `basedays`
--
ALTER TABLE `basedays`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `basedaysold`
--
ALTER TABLE `basedaysold`
  ADD PRIMARY KEY (`id`),
  ADD KEY `basedays_ceg_id_foreign` (`ceg_id`),
  ADD KEY `basedays_daytype_id_foreign` (`daytype_id`);

--
-- A tábla indexei `cegs`
--
ALTER TABLE `cegs`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `days_worker_id_foreign` (`worker_id`),
  ADD KEY `days_daytype_id_foreign` (`daytype_id`);

--
-- A tábla indexei `daytypes`
--
ALTER TABLE `daytypes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daytypes_ceg_id_foreign` (`ceg_id`),
  ADD KEY `daytypes_timetype_id_foreign` (`timetype_id`);

--
-- A tábla indexei `day_file`
--
ALTER TABLE `day_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `day_file_file_id_index` (`file_id`),
  ADD KEY `day_file_day_id_index` (`day_id`);

--
-- A tábla indexei `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docs_ceg_id_foreign` (`ceg_id`),
  ADD KEY `docs_worker_id_foreign` (`worker_id`);

--
-- A tábla indexei `doctemplates`
--
ALTER TABLE `doctemplates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctemplates_ceg_id_foreign` (`ceg_id`);

--
-- A tábla indexei `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- A tábla indexei `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- A tábla indexei `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- A tábla indexei `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_user_permission_id_index` (`permission_id`),
  ADD KEY `permission_user_user_id_index` (`user_id`);

--
-- A tábla indexei `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- A tábla indexei `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- A tábla indexei `storeds`
--
ALTER TABLE `storeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storeds_ceg_id_foreign` (`ceg_id`),
  ADD KEY `storeds_user_id_foreign` (`user_id`),
  ADD KEY `storeds_worker_id_foreign` (`worker_id`);

--
-- A tábla indexei `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `times_worker_id_foreign` (`worker_id`),
  ADD KEY `times_timetype_id_foreign` (`timetype_id`);

--
-- A tábla indexei `timetypes`
--
ALTER TABLE `timetypes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timetypes_ceg_id_foreign` (`ceg_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A tábla indexei `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workers_ceg_id_foreign` (`ceg_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `basedays`
--
ALTER TABLE `basedays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `basedaysold`
--
ALTER TABLE `basedaysold`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `cegs`
--
ALTER TABLE `cegs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `days`
--
ALTER TABLE `days`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT a táblához `daytypes`
--
ALTER TABLE `daytypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `day_file`
--
ALTER TABLE `day_file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `docs`
--
ALTER TABLE `docs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `doctemplates`
--
ALTER TABLE `doctemplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT a táblához `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT a táblához `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT a táblához `storeds`
--
ALTER TABLE `storeds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `times`
--
ALTER TABLE `times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT a táblához `timetypes`
--
ALTER TABLE `timetypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT a táblához `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `days`
--
ALTER TABLE `days`
  ADD CONSTRAINT `days_daytype_id_foreign` FOREIGN KEY (`daytype_id`) REFERENCES `daytypes` (`id`),
  ADD CONSTRAINT `days_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`);

--
-- Megkötések a táblához `daytypes`
--
ALTER TABLE `daytypes`
  ADD CONSTRAINT `daytypes_ceg_id_foreign` FOREIGN KEY (`ceg_id`) REFERENCES `cegs` (`id`),
  ADD CONSTRAINT `daytypes_timetype_id_foreign` FOREIGN KEY (`timetype_id`) REFERENCES `timetypes` (`id`);

--
-- Megkötések a táblához `day_file`
--
ALTER TABLE `day_file`
  ADD CONSTRAINT `day_file_day_id_foreign` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `day_file_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `docs`
--
ALTER TABLE `docs`
  ADD CONSTRAINT `docs_ceg_id_foreign` FOREIGN KEY (`ceg_id`) REFERENCES `cegs` (`id`),
  ADD CONSTRAINT `docs_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`);

--
-- Megkötések a táblához `doctemplates`
--
ALTER TABLE `doctemplates`
  ADD CONSTRAINT `doctemplates_ceg_id_foreign` FOREIGN KEY (`ceg_id`) REFERENCES `cegs` (`id`);

--
-- Megkötések a táblához `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `storeds`
--
ALTER TABLE `storeds`
  ADD CONSTRAINT `storeds_ceg_id_foreign` FOREIGN KEY (`ceg_id`) REFERENCES `cegs` (`id`),
  ADD CONSTRAINT `storeds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `storeds_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`);

--
-- Megkötések a táblához `times`
--
ALTER TABLE `times`
  ADD CONSTRAINT `times_timetype_id_foreign` FOREIGN KEY (`timetype_id`) REFERENCES `timetypes` (`id`),
  ADD CONSTRAINT `times_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`);

--
-- Megkötések a táblához `timetypes`
--
ALTER TABLE `timetypes`
  ADD CONSTRAINT `timetypes_ceg_id_foreign` FOREIGN KEY (`ceg_id`) REFERENCES `cegs` (`id`);

--
-- Megkötések a táblához `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_ceg_id_foreign` FOREIGN KEY (`ceg_id`) REFERENCES `cegs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
