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
-- 資料表結構 `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ename` varchar(255) DEFAULT NULL,
  `cname` varchar(255) DEFAULT NULL,
  `myobname` varchar(255) DEFAULT NULL,
  `shortname` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `website` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `br` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ci` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `contact_tel` varchar(255) DEFAULT NULL,
  `contact_tel2` varchar(255) DEFAULT NULL,
  `contact_fax` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `servicehours` varchar(255) DEFAULT NULL,
  `relatedsales` varchar(255) DEFAULT NULL,
  `printcode` varchar(255) DEFAULT NULL,
  `remark` varchar(1024) DEFAULT NULL,
  `followup` varchar(255) DEFAULT NULL,
  `followup_name` varchar(255) DEFAULT NULL,
  `fontcolor` varchar(255) DEFAULT NULL,
  `bgcolor` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_byname` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_byname` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `company`
--

INSERT INTO `company` (`id`, `category`, `ref`, `name`, `ename`, `cname`, `myobname`, `shortname`, `website`, `br`, `ci`, `address`, `address2`, `contact`, `contact_tel`, `contact_tel2`, `contact_fax`, `contact_email`, `servicehours`, `relatedsales`, `printcode`, `remark`, `followup`, `followup_name`, `fontcolor`, `bgcolor`, `created_by`, `created_byname`, `updated_by`, `updated_byname`, `created_at`, `updated_at`) VALUES
(1, 'Government', 'CR000001', '公司註冊處', 'Company Registry', '公司註冊處', 'Chun Fai Const. Co., Ltd.', '公司註冊處', 'www.cr.gov.hk', NULL, NULL, '14th floor, High Block, Queensway Government Offices, 66 Queensway, Hong Kong', '香港金鐘道66號金鐘道政府合署高座14樓', '電話諮詢熱線', '(852) 2234 9933', NULL, NULL, NULL, NULL, '', '0001', '星期一至五\r\n上午8:30至下午12:45\r\n下午1:45至5:45\r\n\r\n領取證書櫃檯\r\n\r\n星期一至五\r\n上午8:30至下午5:45', NULL, NULL, 'Red', NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:56:38'),
(2, 'Bank', 'CR000002', 'HSBC 匯豐', 'The Hongkong and Shanghai Banking Corporation Limited', '香港上海滙豐銀行有限公司', 'Cornwall Contracting Co., Ltd.', '滙豐', 'www.hsbc.com.hk', NULL, NULL, 'Hong Kong Office, Level 3, HSBC Main Building, 1 Queen\'s Road Central', '香港中環皇后大道中1號滙豐總行大廈3樓', '滙豐卓越理財客戶', '(852) 2233 3322', NULL, NULL, NULL, NULL, '', '0002', NULL, NULL, NULL, 'Red', NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:56:38'),
(3, 'Client', 'CR000003', 'PureUdon 清水烏冬', 'Pure Udon Limited', '清水烏冬有限公司', 'Sharp Hing E & M Ltd.', '清水烏冬', 'www.pureudon.com', NULL, NULL, 'Unit 2002, Port 33, 33 Tseuk Luk Street, San Po Kong, Kowloon', '香港九龍新蒲崗爵祿街33號 \"PORT 33\" 20樓02室', '黃先生', '69988556', NULL, NULL, 'info@pureudon.com', NULL, '', '0003', NULL, NULL, NULL, 'DarkViolet', NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:56:21'),
(4, 'Organization', 'CR000004', 'HKJC 香港賽馬會', 'The Hong Kong Jockey Club', '香港賽馬會', 'Sun Hing A.V. & Electronics H.K.', '香港賽馬會', 'www.hkjc.com', NULL, NULL, '2 Sports Road, Happy Valley, Hong Kong Island', '香港島跑馬地體育道2號', '馬會熱線', '1817', NULL, NULL, NULL, NULL, '', '0004', NULL, NULL, NULL, 'DarkViolet', NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:56:21'),
(5, 'Vendor', 'CR000005', 'HKTVmall', 'Hong Kong Technology Venture Company Limited', '香港科技探索有限公司', '3S Design & Decoration Co.', 'HKTV', 'www.hktvmall.com', NULL, NULL, 'HKTV Multimedia and Ecommerce Centre, 1 Chun Cheong Street, Tseung Kwan O Industrial Estate, Tseung Kwan O', '香港新界將軍澳工業村駿昌街1號', '巿場部', '+852 3145 6888', NULL, NULL, 'marketing@hktv.com.hk', NULL, '', '0010', NULL, NULL, NULL, 'DarkViolet', NULL, NULL, NULL, NULL, NULL, '2021-10-04 20:03:15', '2021-10-05 03:56:21');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `c14` (`ref`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
