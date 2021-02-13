-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Feb 01. 19:44
-- Kiszolgáló verziója: 10.3.16-MariaDB
-- PHP verzió: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- A tábla adatainak kiíratása `basedays`
--

INSERT INTO `basedays` (`id`, `ceg_id`, `daytype_id`, `datum`, `note`, `pub`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 3, '2019-12-06', 'mikulás', 1, '2019-12-15 19:27:36', '2020-05-08 16:52:39', NULL),
(4, 1, 2, '2020-05-01', NULL, 0, '2020-05-14 15:41:32', '2020-05-14 16:21:30', '2020-05-14 16:21:30'),
(5, 1, 2, '2020-05-15', 'wtgrt', 1, '2020-05-14 16:20:53', '2020-05-14 16:21:24', '2020-05-14 16:21:24');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `worker_id` int(10) UNSIGNED NOT NULL,
  `daytype_id` int(10) UNSIGNED NOT NULL,
  `start` date NOT NULL,
  `end` date DEFAULT NULL,
  `adnote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `worknote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pub` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `bookings`
--

INSERT INTO `bookings` (`id`, `worker_id`, `daytype_id`, `start`, `end`, `adnote`, `worknote`, `pub`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 9, 6, '2020-05-29', '2020-05-31', NULL, NULL, 0, '2020-05-17 13:51:43', '2020-05-17 13:51:43', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `booking_file`
--

CREATE TABLE `booking_file` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 8, 5, NULL, '2020-05-07', NULL, NULL, 50, '2020-05-13 14:19:31', '2020-05-13 14:19:31', NULL),
(2, 8, 5, NULL, '2020-05-13', NULL, NULL, 50, '2020-05-13 14:19:31', '2020-05-13 14:19:31', NULL),
(3, 9, 2, NULL, '2020-05-04', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(4, 9, 2, NULL, '2020-05-05', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(5, 9, 2, NULL, '2020-05-06', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(6, 9, 2, NULL, '2020-05-07', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(7, 9, 2, NULL, '2020-05-08', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(8, 9, 2, NULL, '2020-05-11', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(9, 9, 2, NULL, '2020-05-12', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(10, 9, 2, NULL, '2020-05-13', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(11, 9, 2, NULL, '2020-05-14', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(12, 9, 2, NULL, '2020-05-15', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(13, 9, 2, NULL, '2020-05-18', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(14, 9, 2, NULL, '2020-05-19', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(15, 9, 2, NULL, '2020-05-20', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(16, 9, 2, NULL, '2020-05-21', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(17, 9, 2, NULL, '2020-05-22', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(18, 9, 2, NULL, '2020-05-25', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(19, 9, 2, NULL, '2020-05-26', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(20, 9, 2, NULL, '2020-05-27', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:55', '2020-05-17 13:54:55'),
(21, 9, 2, NULL, '2020-05-29', NULL, NULL, 50, '2020-05-17 13:54:24', '2020-05-17 13:54:55', '2020-05-17 13:54:55'),
(22, 9, 2, NULL, '2020-05-04', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(23, 9, 2, NULL, '2020-05-05', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(24, 9, 2, NULL, '2020-05-06', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(25, 9, 2, NULL, '2020-05-07', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(26, 9, 2, NULL, '2020-05-08', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(27, 9, 2, NULL, '2020-05-11', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(28, 9, 2, NULL, '2020-05-12', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(29, 9, 2, NULL, '2020-05-13', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(30, 9, 2, NULL, '2020-05-14', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(31, 9, 2, NULL, '2020-05-15', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(32, 9, 2, NULL, '2020-05-18', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(33, 9, 2, NULL, '2020-05-19', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(34, 9, 2, NULL, '2020-05-20', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(35, 9, 2, NULL, '2020-05-21', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(36, 9, 2, NULL, '2020-05-22', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(37, 9, 2, NULL, '2020-05-25', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(38, 9, 2, NULL, '2020-05-26', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:54', '2020-05-17 13:54:54'),
(39, 9, 2, NULL, '2020-05-27', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:55', '2020-05-17 13:54:55'),
(40, 9, 2, NULL, '2020-05-29', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:55', '2020-05-17 13:54:55'),
(41, 9, 2, NULL, '2020-05-28', NULL, NULL, 50, '2020-05-17 13:54:44', '2020-05-17 13:54:55', '2020-05-17 13:54:55'),
(42, 12, 3, NULL, '2021-01-01', NULL, NULL, 50, '2021-01-26 17:24:00', '2021-01-26 17:24:00', NULL),
(43, 12, 3, NULL, '2021-01-05', NULL, NULL, 50, '2021-01-26 17:24:00', '2021-01-26 17:24:00', NULL),
(44, 12, 3, NULL, '2021-01-01', NULL, NULL, 50, '2021-01-26 17:24:07', '2021-01-26 17:24:07', NULL),
(45, 12, 3, NULL, '2021-01-05', NULL, NULL, 50, '2021-01-26 17:24:07', '2021-01-26 17:24:07', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `daytypes`
--

CREATE TABLE `daytypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `ceg_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `workday` tinyint(1) NOT NULL DEFAULT 0,
  `szorzo` decimal(4,2) DEFAULT 1.00,
  `fixplusz` int(11) DEFAULT 0,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `background` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userallowed` tinyint(1) NOT NULL DEFAULT 0,
  `pub` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `daytypes`
--

INSERT INTO `daytypes` (`id`, `ceg_id`, `name`, `workday`, `szorzo`, `fixplusz`, `color`, `background`, `note`, `userallowed`, `pub`) VALUES
(2, 1, 'Munkanap', 1, '1.00', 0, NULL, NULL, 'alapértelmezés', 0, 1),
(3, 1, 'Szabadnap', 0, '1.00', 0, NULL, NULL, 'Szombat', 0, 1),
(4, 1, 'Pihenőnap', 0, '1.00', 0, NULL, NULL, 'vasárnap', 0, 1),
(5, 1, 'Szabadság', 0, '1.00', 0, NULL, NULL, '', 0, 1),
(6, 1, 'Betegállomány', 0, '1.00', 0, NULL, NULL, '', 1, 1),
(7, 1, 'Ledolgozás', 1, '1.00', 0, NULL, NULL, '', 0, 0),
(8, 1, 'Ledolgozott nap', 0, '1.00', 0, NULL, NULL, '', 0, 0),
(9, 1, 'Igazolt távollét', 0, '1.00', 0, NULL, NULL, '', 0, 1),
(10, 1, 'Kiküldetés', 1, '1.00', 0, NULL, NULL, '', 0, 1),
(22, 1, 'fizetett ünnep', 0, NULL, NULL, NULL, NULL, 'warfgergw', 0, 0);

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
  `origin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `worknote` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adnote` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `docs`
--

INSERT INTO `docs` (`id`, `ceg_id`, `worker_id`, `cat`, `origin`, `name`, `filename`, `path`, `worknote`, `adnote`, `created_at`, `updated_at`, `deleted_at`) VALUES
(34, 10, 12, 'adatkezeles', 'yfb_adatkezeles_2021_01_31_17_39_16.pdf', 'yfb_adatkezeles_2021-01-31 17:39:16', 'yfb_adatkezeles_2021_01_31_17_39_16.pdf', 'app/public/10/', NULL, NULL, '2021-01-31 16:39:17', '2021-01-31 20:40:10', '2021-01-31 20:40:10'),
(35, 10, 12, 'adatkezeles', 'yfb_adatkezeles_2021_01_31_21_22_52.pdf', 'yfb_adatkezeles_2021-01-31 21:22:52', 'yfb_adatkezeles_2021_01_31_21_22_52.pdf', 'app/public/10/', NULL, NULL, '2021-01-31 20:22:52', '2021-01-31 20:40:15', '2021-01-31 20:40:15'),
(36, 10, 11, 'adatkezeles', 'Otto_Menku_adatkezeles_2021_01_31_21_28_16.pdf', 'Ottó Ménkű_adatkezeles_2021-01-31 21:28:16', 'Otto_Menku_adatkezeles_2021_01_31_21_28_16.pdf', 'app/public/10/', NULL, NULL, '2021-01-31 20:28:16', '2021-01-31 20:40:20', '2021-01-31 20:40:20'),
(37, 10, 11, 'adatkezeles', 'Otto_Menku_adatkezeles_2021_01_31_21_36_43.pdf', 'Ottó Ménkű_adatkezeles_2021-01-31 21:36:43', 'Otto_Menku_adatkezeles_2021_01_31_21_36_43.pdf', 'app/public/10/', NULL, NULL, '2021-01-31 20:36:43', '2021-02-01 17:34:48', '2021-02-01 17:34:48'),
(38, 10, 11, 'tajekoztato', 'Otto_Menku_tajekoztato_2021_01_31_22_28_45.pdf', 'Ottó Ménkű_tajekoztato_2021-01-31 22:28:45', 'Otto_Menku_tajekoztato_2021_01_31_22_28_45.pdf', 'app/public/10/', NULL, NULL, '2021-01-31 21:28:46', '2021-01-31 22:16:02', '2021-01-31 22:16:02'),
(39, 10, 11, 'tajekoztato', 'Otto_Menku_tajekoztato_2021_01_31_22_38_04.pdf', 'Ottó Ménkű_tajekoztato_2021-01-31 22:38:04', 'Otto_Menku_tajekoztato_2021_01_31_22_38_04.pdf', 'app/public/10/', NULL, NULL, '2021-01-31 21:38:05', '2021-01-31 22:16:08', '2021-01-31 22:16:08'),
(40, 10, 11, 'tajekoztato', 'Otto_Menku_tajekoztato_2021_01_31_22_44_08.pdf', 'Ottó Ménkű_tajekoztato_2021-01-31 22:44:08', 'Otto_Menku_tajekoztato_2021_01_31_22_44_08.pdf', 'app/public/10/', NULL, NULL, '2021-01-31 21:44:09', '2021-02-01 17:35:47', '2021-02-01 17:35:47'),
(41, 10, 11, 'tajekoztato', 'Otto_Menku_tajekoztato_2021_01_31_22_49_03.pdf', 'Ottó Ménkű_tajekoztato_2021-01-31 22:49:03', 'Otto_Menku_tajekoztato_2021_01_31_22_49_03.pdf', 'app/public/10/', NULL, NULL, '2021-01-31 21:49:04', '2021-02-01 17:35:29', '2021-02-01 17:35:29');

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
(10, '2017_09_28_153426_create_daytypes_table', 2),
(11, '2017_09_28_153916_create_timetypes_table', 2),
(12, '2017_09_28_155959_create_times_table', 2),
(13, '2017_09_29_153402_create_days_table', 2),
(14, '2019_12_08_000236_create_activity_log_table', 3),
(16, '2017_09_29_153402_create_basedays_table', 4),
(17, '2020_01_17_181835_create_storeds_table', 5),
(18, '2016_01_25_153402_create_files_table', 6),
(19, '2016_01_26_115523_create_day_file_table', 6),
(20, '2016_01_25_153402_create_bookings_table', 7),
(21, '2016_01_26_115523_create_booking_file_table', 7),
(22, '2016_01_25_153402_create_docs_table', 8);

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
  `start` time NOT NULL,
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
(1, 12, 1, '2021-01-01', '01:01:00', NULL, 11, NULL, NULL, 50, '2021-01-26 17:24:43', '2021-01-26 17:24:43', NULL),
(2, 12, 1, '2021-01-05', '01:01:00', NULL, 11, NULL, NULL, 50, '2021-01-26 17:24:43', '2021-01-26 17:24:43', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `timetypes`
--

CREATE TABLE `timetypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `ceg_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `szorzo` decimal(4,2) DEFAULT 1.00,
  `fixplusz` int(11) DEFAULT 0,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `background` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pub` smallint(6) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `timetypes`
--

INSERT INTO `timetypes` (`id`, `ceg_id`, `name`, `szorzo`, `fixplusz`, `color`, `background`, `note`, `pub`) VALUES
(1, 1, 'Normál', '1.00', 0, NULL, NULL, 'alapértelmezés', 1),
(2, 1, 'délután', '1.00', 0, NULL, NULL, 'Szombat', 1),
(3, 1, 'éjszaka', '1.00', 0, NULL, NULL, 'vasárnap', -1),
(4, 1, 'délelőtt', '1.00', 0, NULL, NULL, '', 0),
(5, 1, 'délutáni túlóra', '1.00', 0, NULL, NULL, '', 1),
(6, 1, 'éjszakai túlóra', '1.00', 0, NULL, NULL, '', 1),
(7, 1, 'túlóra1', '1.00', 0, NULL, NULL, NULL, 0),
(8, 1, 'Ledolgozás', '1.00', 0, NULL, NULL, '', 1),
(9, 1, 'Ledolgozott nap', '1.00', 0, NULL, NULL, '', 1),
(10, 1, 'Igazolt távollét', '1.00', 0, NULL, NULL, '', 0),
(17, 1, 'rt5t45tz', NULL, 0, NULL, NULL, '456z4', 0);

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
(2, 'admin', 'admin@dolgozo.com', NULL, '$2y$10$jjvGKRlaxsu.dYfYA2u92u95IF1/FRY7U1jyNISLshkrcbh3BcbbG', '4vM9SA5GpyP5LsCJk5OGAqYn17DKEYMxxVRUmSpUxYQ3pFTVTGl3SRl7z15C', NULL, NULL, NULL),
(27, 'prmanager1', 'prmanager1@gmail.com', NULL, '$2y$10$H2xr8W7dll6VNfpkFBl2fe.TaqdOxb6Bow2NlqYRYcdpVpMNq9l2y', NULL, '2020-05-13 14:16:22', '2020-05-13 14:16:22', NULL),
(28, 'Ottó Ménkű', 'menkuotto@gmail.com', NULL, '$2y$10$WfCPRzRAaIUEcP0lCgwXQeAw3x7rE0rVVRtqHu9VbXl9BM4Zr5C.e', NULL, '2020-05-13 14:18:59', '2020-05-13 14:18:59', NULL),
(29, 'Dr. Taczman Lajos', 'taczmanl@gmail.com', NULL, '$2y$10$.DX/cyvN1q9adLUUDynn1.j2WCJGpo5HmTo460UlZvQprnMRl6bya', '9QW4g4TLa3KyyzXIe45dLvVMaSmvwhdNcLh2bLoaZAH8srjHfbrxe4Bdb98t', '2020-05-14 15:31:41', '2020-05-17 13:47:39', NULL),
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

INSERT INTO `workers` (`id`, `user_id`, `ceg_id`, `position`, `foto`, `fullname`, `workername`, `mothername`, `city`, `cim`, `tel`, `birth`, `birthplace`, `ado`, `tb`, `start`, `end`, `note`, `pub`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 28, 7, NULL, NULL, 'Ottó Ménkű', 'Ottó Ménkű', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-02', NULL, NULL, 1, '2020-05-13 14:18:59', '2020-05-13 14:22:52', NULL),
(9, 30, 8, 'Pénzügyi asszisztens', NULL, 'Babják Éva', 'Babjak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-05-14 15:45:26', '2020-05-14 15:45:26', NULL),
(10, 33, 9, '45tw34', NULL, 'Ottó Ménkű', 'Ottó Ménkű', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-06', NULL, NULL, 1, '2021-01-17 16:40:50', '2021-01-17 16:56:23', NULL),
(11, 36, 10, 'efwe', NULL, 'Ottó Ménkű', 'Ottó Ménkű', 'B. R.', 'jászberény', 'werw fbgsdfgs ', 'we', '1968-09-14', 'Jászberény', 'ewwer', 'we', '2021-01-29', NULL, NULL, 1, '2021-01-17 17:05:51', '2021-01-17 17:05:51', NULL),
(12, 37, 10, 'dgrs', NULL, 'dfgs', 'yfb', NULL, NULL, 'rgwe', 'erger', NULL, NULL, 'ertge', 'ertgew', '2021-01-29', NULL, NULL, 1, '2021-01-23 11:23:57', '2021-01-30 20:15:02', NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `basedays_ceg_id_foreign` (`ceg_id`),
  ADD KEY `basedays_daytype_id_foreign` (`daytype_id`);

--
-- A tábla indexei `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_worker_id_foreign` (`worker_id`),
  ADD KEY `bookings_daytype_id_foreign` (`daytype_id`);

--
-- A tábla indexei `booking_file`
--
ALTER TABLE `booking_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_file_file_id_index` (`file_id`),
  ADD KEY `booking_file_booking_id_index` (`booking_id`);

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
  ADD KEY `daytypes_ceg_id_foreign` (`ceg_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `booking_file`
--
ALTER TABLE `booking_file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `cegs`
--
ALTER TABLE `cegs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `days`
--
ALTER TABLE `days`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT a táblához `daytypes`
--
ALTER TABLE `daytypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT a táblához `day_file`
--
ALTER TABLE `day_file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `docs`
--
ALTER TABLE `docs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT a táblához `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `timetypes`
--
ALTER TABLE `timetypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- Megkötések a táblához `basedays`
--
ALTER TABLE `basedays`
  ADD CONSTRAINT `basedays_ceg_id_foreign` FOREIGN KEY (`ceg_id`) REFERENCES `cegs` (`id`),
  ADD CONSTRAINT `basedays_daytype_id_foreign` FOREIGN KEY (`daytype_id`) REFERENCES `daytypes` (`id`);

--
-- Megkötések a táblához `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_daytype_id_foreign` FOREIGN KEY (`daytype_id`) REFERENCES `daytypes` (`id`),
  ADD CONSTRAINT `bookings_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`);

--
-- Megkötések a táblához `booking_file`
--
ALTER TABLE `booking_file`
  ADD CONSTRAINT `booking_file_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_file_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `daytypes_ceg_id_foreign` FOREIGN KEY (`ceg_id`) REFERENCES `cegs` (`id`);

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
