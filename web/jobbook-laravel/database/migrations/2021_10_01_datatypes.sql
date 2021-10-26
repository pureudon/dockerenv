-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： mysql
-- 產生時間： 2021 年 10 月 01 日 17:58
-- 伺服器版本： 5.7.19
-- PHP 版本： 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `jobbook`
--

-- --------------------------------------------------------

--
-- 資料表結構 `datatypes`
--

CREATE TABLE `datatypes` (
  `id` int(11) NOT NULL,
  `varchartype` varchar(255) DEFAULT NULL,
  `texttype` text,
  `datetype` date DEFAULT NULL,
  `tinyinttype` tinyint(4) DEFAULT NULL,
  `smallinttype` smallint(6) DEFAULT NULL,
  `mediumninttype` mediumint(9) DEFAULT NULL,
  `inttype` int(11) DEFAULT NULL,
  `biginttype` bigint(20) DEFAULT NULL,
  `decimaltype` decimal(10,4) DEFAULT NULL,
  `floattype` float DEFAULT NULL,
  `doubletype` double DEFAULT NULL,
  `realtype` double DEFAULT NULL,
  `bittype` bit(8) DEFAULT NULL,
  `booleantype` tinyint(1) DEFAULT NULL,
  `datetimetype` datetime DEFAULT NULL,
  `timestamptype` timestamp NULL DEFAULT NULL,
  `timetype` time DEFAULT NULL,
  `yeartype` year(4) DEFAULT NULL,
  `chartype` char(255) DEFAULT NULL,
  `tinytexttype` tinytext,
  `mediumtexttype` mediumtext,
  `longtexttype` longtext,
  `binarytype` binary(8) DEFAULT NULL,
  `varbinarytype` varbinary(8) DEFAULT NULL,
  `tinyblobtype` tinyblob,
  `blogtype` blob,
  `mediumblogtype` mediumblob,
  `longblogtype` longblob,
  `geometrytype` geometry DEFAULT NULL,
  `pointtype` point DEFAULT NULL,
  `linestringtype` linestring DEFAULT NULL,
  `polygontype` polygon DEFAULT NULL,
  `multipointtype` multipoint DEFAULT NULL,
  `multipolygontype` multipolygon DEFAULT NULL,
  `geometrycollection` geometrycollection DEFAULT NULL,
  `jsontype` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `datatypes`
--

INSERT INTO `datatypes` (`id`, `varchartype`, `texttype`, `datetype`, `tinyinttype`, `smallinttype`, `mediumninttype`, `inttype`, `biginttype`, `decimaltype`, `floattype`, `doubletype`, `realtype`, `bittype`, `booleantype`, `datetimetype`, `timestamptype`, `timetype`, `yeartype`, `chartype`, `tinytexttype`, `mediumtexttype`, `longtexttype`, `binarytype`, `varbinarytype`, `tinyblobtype`, `blogtype`, `mediumblogtype`, `longblogtype`, `geometrytype`, `pointtype`, `linestringtype`, `polygontype`, `multipointtype`, `multipolygontype`, `geometrycollection`, `jsontype`) VALUES
(1, 'varchart first', 'text first', '2021-01-01', 1, 1, 1, 1, 1, '1.0000', 1, 1, 1, b'00000001', 1, '2021-01-01 01:01:01', '2021-01-01 01:01:01', '01:01:01', 2021, 'char first', 'tinytext first', 'mediumtext first', 'longtext first', 0x0100000000000000, 0x01, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'varchar second', 'text second', '2022-02-02', 2, 2, 2, 2, 2, '2.0000', 2, 2, 2, b'00000000', 2, '2022-02-02 02:02:02', '2022-02-02 02:02:02', '02:02:02', 2022, 'char second', 'tinytext second', 'mediumtext second', 'longtext second', 0x0200000000000000, 0x02, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'varchar third', 'varchar third', '2023-03-03', 3, 3, 3, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-03 03:03:03', NULL, NULL, 2023, NULL, 'varchar third', 'varchar third', 'varchar third', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'fourth', 'fourth', '2024-04-04', 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-04 04:04:04', NULL, NULL, 2024, NULL, 'fourth', 'fourth', 'fourth', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'fifth', 'fifth', '2025-05-05', 5, 5, 5, 5, 5, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-05 05:05:05', NULL, NULL, 2025, NULL, 'fifth', 'fifth', 'fifth', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `datatypes`
--
ALTER TABLE `datatypes`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `datatypes`
--
ALTER TABLE `datatypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
