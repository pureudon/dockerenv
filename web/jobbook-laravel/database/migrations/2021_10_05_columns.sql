-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： mysql
-- 產生時間： 2021 年 10 月 04 日 22:10
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
-- 資料庫： `jobbooklaravel`
--

-- --------------------------------------------------------

--
-- 資料表結構 `columns`
--

CREATE TABLE `columns` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `ref` varchar(12) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `tablename` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `fieldname` varchar(255) DEFAULT NULL,
  `variablename` varchar(255) DEFAULT NULL,
  `display` varchar(255) DEFAULT NULL,
  `visibility` tinyint(1) DEFAULT NULL,
  `view1visibility` tinyint(1) DEFAULT NULL,
  `view2visibility` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `editable` tinyint(1) DEFAULT NULL,
  `searchable` tinyint(1) DEFAULT NULL,
  `orderable` tinyint(1) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `length` varchar(20) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_byname` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_byname` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `columns`
--

INSERT INTO `columns` (`id`, `date`, `ref`, `type`, `tablename`, `name`, `fieldname`, `variablename`, `display`, `visibility`, `view1visibility`, `view2visibility`, `position`, `editable`, `searchable`, `orderable`, `description`, `status`, `remark`, `length`, `created_by`, `created_byname`, `updated_by`, `updated_byname`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 'company', 'id', 'id', 'db_company_id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', NULL),
(2, NULL, NULL, NULL, 'company', 'category', 'category', 'db_company_category', '分類', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-04 20:03:15'),
(3, NULL, NULL, NULL, 'company', 'name', 'name', 'db_company_name', '公司簡稱', 1, 1, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-04 20:03:15'),
(4, NULL, NULL, NULL, 'company', 'ename', 'ename', 'db_company_ename', '英文名', 1, 0, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-04 20:03:15'),
(5, NULL, NULL, NULL, 'company', 'cname', 'cname', 'db_company_cname', '中文名', 1, 0, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-04 20:03:15'),
(6, NULL, NULL, NULL, 'company', 'myobname', 'myobname', 'db_company_myobname', 'MYOB名', 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', NULL),
(7, NULL, NULL, NULL, 'company', 'shortname', 'shortname', 'db_company_shortname', '短名', 1, 0, 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-04 20:03:15'),
(8, NULL, NULL, NULL, 'company', 'website', 'website', 'db_company_website', 'Website', 1, 1, 1, 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(9, NULL, NULL, NULL, 'company', 'br', 'br', 'db_company_br', 'BR', 1, 0, 0, 9, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(10, NULL, NULL, NULL, 'company', 'ci', 'ci', 'db_company_ci', 'Certificate(CR)', 1, 0, 0, 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(11, NULL, NULL, NULL, 'company', 'address', 'address', 'db_company_address', '主要地址(英)', 1, 1, 1, 11, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(12, NULL, NULL, NULL, 'company', 'address2', 'address2', 'db_company_address2', '次要地址(中)', 1, 0, 0, 12, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(13, NULL, NULL, NULL, 'company', 'contact', 'contact', 'db_company_contact', '公司聯絡人', 1, 1, 1, 13, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(14, NULL, NULL, NULL, 'company', 'contact_tel', 'contact_tel', 'db_company_contact_tel', '公司電話1', 1, 1, 1, 14, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(15, NULL, NULL, NULL, 'company', 'contact_tel2', 'contact_tel2', 'db_company_contact_tel2', '公司電話2', 1, 0, 0, 15, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(16, NULL, NULL, NULL, 'company', 'contact_fax', 'contact_fax', 'db_company_contact_fax', '公司Fax', 1, 0, 0, 16, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(17, NULL, NULL, NULL, 'company', 'contact_email', 'contact_email', 'db_company_contact_email', '公司Email', 1, 1, 1, 17, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(18, NULL, NULL, NULL, 'company', 'printcode', 'printcode', 'db_company_printcode', '列印編號', 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', NULL),
(19, NULL, NULL, NULL, 'company', 'remark', 'remark', 'db_company_remark', '備註', 1, 1, 1, 18, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(20, NULL, NULL, NULL, 'company', 'ref', 'ref', 'db_company_ref', 'CR#', 1, 1, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-04 20:03:15'),
(23, NULL, NULL, NULL, 'company', 'followup', 'followup', 'db_company_followup', '跟進同事#', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', NULL),
(24, NULL, NULL, NULL, 'company', 'followup_name', 'followup_name', 'db_company_followup_name', '跟進同事', 1, 0, 1, 19, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(33, NULL, NULL, NULL, 'company', 'fontcolor', 'fontcolor', 'db_company_fontcolor', '顏色', 1, 0, 0, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(34, NULL, NULL, NULL, 'company', 'bgcolor', 'bgcolor', 'db_company_bgcolor', 'bgcolor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', NULL),
(35, NULL, NULL, NULL, 'company', 'created_by', 'created_by', 'db_company_created_by', 'created_by', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', NULL),
(36, NULL, NULL, NULL, 'company', 'created_byname', 'created_byname', 'db_company_created_byname', 'created_byname', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', NULL),
(37, NULL, NULL, NULL, 'company', 'updated_by', 'updated_by', 'db_company_updated_by', 'updated_by', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', NULL),
(38, NULL, NULL, NULL, 'company', 'updated_byname', 'updated_byname', 'db_company_updated_byname', 'updated_byname', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', NULL),
(39, NULL, NULL, NULL, 'company', 'created_at', 'created_at', 'db_company_created_at', '建立時間', 1, 0, 1, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(40, NULL, NULL, NULL, 'company', 'updated_at', 'updated_at', 'db_company_updated_at', '修改時間', 1, 0, 1, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:49:21'),
(41, NULL, NULL, NULL, 'company', 'action', 'action', 'db_company_action', '操作', 1, 1, 1, 3, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-04 20:03:15');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `columns`
--
ALTER TABLE `columns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ref` (`ref`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `columns`
--
ALTER TABLE `columns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
