-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2015 at 10:23 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qwickfu1_parkst_inv`
--
DROP DATABASE `qwickfu1_parkst_inv`;
CREATE DATABASE IF NOT EXISTS `qwickfu1_parkst_inv` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `qwickfu1_parkst_inv`;

-- --------------------------------------------------------

--
-- Table structure for table `accounting_heads`
--

CREATE TABLE IF NOT EXISTS `accounting_heads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `head_name` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `accounting_heads`
--

INSERT INTO `accounting_heads` (`id`, `head_name`) VALUES
(1, 'Revenue'),
(2, 'Expense'),
(3, 'Equity'),
(4, 'Asset'),
(5, 'Liability');

-- --------------------------------------------------------

--
-- Table structure for table `balance_sheets`
--

CREATE TABLE IF NOT EXISTS `balance_sheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) DEFAULT NULL,
  `fixed_asset_id` int(11) DEFAULT NULL,
  `cash_account_id` int(11) DEFAULT NULL,
  `cash` decimal(11,2) DEFAULT '0.00',
  `injections` decimal(11,2) DEFAULT '0.00',
  `deposit` decimal(11,2) DEFAULT '0.00',
  `acc_receivable_debtors` decimal(11,2) DEFAULT '0.00',
  `stock` decimal(11,2) DEFAULT '0.00',
  `total` decimal(11,2) DEFAULT '0.00',
  `property_plant_equipment` decimal(11,2) DEFAULT '0.00',
  `land_n_building` decimal(11,2) DEFAULT '0.00',
  `description` varchar(50) DEFAULT NULL,
  `sloans` decimal(11,2) DEFAULT '0.00',
  `lgloans` decimal(11,2) DEFAULT '0.00',
  `interest` decimal(11,2) DEFAULT '0.00',
  `depreciation` decimal(11,2) DEFAULT '0.00',
  `purchaseofppe` decimal(11,2) DEFAULT '0.00',
  `acc_payable_creditors` decimal(11,2) DEFAULT '0.00',
  `taxation` decimal(11,2) DEFAULT '0.00',
  `other_liabilities` decimal(11,2) DEFAULT '0.00',
  `owner_equity` decimal(11,2) DEFAULT '0.00',
  `profit_n_loss` decimal(11,2) DEFAULT '0.00',
  `drawings` decimal(11,2) DEFAULT '0.00',
  `flag` int(2) NOT NULL DEFAULT '0',
  `fixedasset_status` enum('available','not') DEFAULT 'available',
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(40) NOT NULL,
  `account_no` varchar(25) NOT NULL,
  `bank_id` int(5) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `branch` varchar(35) NOT NULL,
  `setting_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `account_name`, `account_no`, `bank_id`, `currency_id`, `branch`, `setting_id`) VALUES
(1, 'Parkstone Capital Limited', '123456789', 3, 1, 'High Street, Accra', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_balances`
--

CREATE TABLE IF NOT EXISTS `bank_balances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT '0.00',
  `balance` decimal(11,2) DEFAULT '0.00',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=122 ;

--
-- Dumping data for table `bank_balances`
--

INSERT INTO `bank_balances` (`id`, `bank_id`, `account_id`, `amount`, `balance`, `created`, `modified`, `user`) VALUES
(1, NULL, 3, '0.00', '0.00', '2015-06-01 00:00:00', '2015-06-01 01:52:05', 'Qwick Fusion'),
(56, NULL, 3, '1000.00', '0.00', '2015-06-03 10:13:48', '2015-06-03 10:13:48', 'Qwick Fusion'),
(57, NULL, 3, '0.00', '0.00', '2015-06-03 10:15:54', '2015-06-03 10:15:54', 'Qwick Fusion'),
(58, NULL, 2, '0.00', '0.00', NULL, NULL, NULL),
(59, NULL, 4, '0.00', '0.00', NULL, NULL, NULL),
(60, NULL, 6, '0.00', '0.00', NULL, NULL, NULL),
(61, NULL, 6, '1000.00', '0.00', '2015-06-03 10:32:59', '2015-06-03 10:32:59', 'Qwick Fusion'),
(62, NULL, 3, '-50.00', '0.00', '2015-06-03 19:27:52', '2015-06-03 19:27:52', 'Qwick Fusion'),
(63, NULL, 3, '0.00', '0.00', '2015-06-03 19:27:54', '2015-06-03 19:27:54', 'Qwick Fusion'),
(64, NULL, 6, '933.00', '0.00', '2015-06-03 19:28:16', '2015-06-03 19:28:16', 'Qwick Fusion'),
(65, NULL, 3, '-450.00', '0.00', '2015-06-03 19:28:36', '2015-06-03 19:28:36', 'Qwick Fusion'),
(66, NULL, 4, '-98.00', '0.00', '2015-06-03 19:29:10', '2015-06-03 19:29:10', 'Qwick Fusion'),
(67, NULL, 4, '0.00', '0.00', '2015-06-03 19:30:35', '2015-06-03 19:30:35', 'Qwick Fusion'),
(68, NULL, 3, '0.00', '0.00', '2015-06-03 19:30:38', '2015-06-03 19:30:38', 'Qwick Fusion'),
(69, NULL, 6, '1000.00', '0.00', '2015-06-03 19:30:40', '2015-06-03 19:30:40', 'Qwick Fusion'),
(70, NULL, 3, '-73.00', '0.00', '2015-06-03 19:31:11', '2015-06-03 19:31:11', 'Qwick Fusion'),
(71, NULL, 3, '-773.00', '0.00', '2015-06-03 19:31:38', '2015-06-03 19:31:38', 'Qwick Fusion'),
(72, NULL, 3, '-803.00', '0.00', '2015-06-03 19:31:59', '2015-06-03 19:31:59', 'Qwick Fusion'),
(73, NULL, 3, '197.00', '0.00', '2015-06-03 19:32:36', '2015-06-03 19:32:36', 'Qwick Fusion'),
(74, NULL, 3, '797.00', '0.00', '2015-06-03 19:32:52', '2015-06-03 19:32:52', 'Qwick Fusion'),
(75, NULL, 3, '1597.00', '0.00', '2015-06-03 19:33:50', '2015-06-03 19:33:50', 'Qwick Fusion'),
(76, NULL, 3, '797.00', '0.00', '2015-06-03 19:33:53', '2015-06-03 19:33:53', 'Qwick Fusion'),
(77, NULL, 3, '1797.00', '0.00', '2015-06-03 19:34:24', '2015-06-03 19:34:24', 'Qwick Fusion'),
(78, NULL, 3, '2797.00', '0.00', '2015-06-03 19:34:40', '2015-06-03 19:34:40', 'Qwick Fusion'),
(79, NULL, 3, '2297.00', '0.00', '2015-06-03 19:34:59', '2015-06-03 19:34:59', 'Qwick Fusion'),
(80, NULL, 3, '1797.00', '0.00', '2015-06-03 19:35:14', '2015-06-03 19:35:14', 'Qwick Fusion'),
(81, NULL, 3, '2797.00', '0.00', '2015-06-03 19:35:56', '2015-06-03 19:35:56', 'Qwick Fusion'),
(82, NULL, 6, '0.00', '0.00', '2015-06-03 19:37:39', '2015-06-03 19:37:39', 'Qwick Fusion'),
(83, NULL, 3, '3797.00', '0.00', '2015-06-03 20:23:50', '2015-06-03 20:23:50', 'Qwick Fusion'),
(84, NULL, 3, '4797.00', '0.00', '2015-06-03 20:33:00', '2015-06-03 20:33:00', 'Qwick Fusion'),
(85, NULL, 3, '5097.00', '0.00', '2015-06-03 23:29:25', '2015-06-03 23:29:25', 'Qwick Fusion'),
(86, NULL, 3, '4797.00', '0.00', '2015-06-03 23:33:19', '2015-06-03 23:33:19', 'Qwick Fusion'),
(87, NULL, 3, '5297.00', '0.00', '2015-06-03 23:35:31', '2015-06-03 23:35:31', 'Qwick Fusion'),
(88, NULL, 3, '6297.00', '0.00', '2015-06-04 00:06:05', '2015-06-04 00:06:05', 'Qwick Fusion'),
(89, NULL, 3, '5297.00', '0.00', '2015-06-04 00:11:08', '2015-06-04 00:11:08', 'Qwick Fusion'),
(90, NULL, 3, '4297.00', '0.00', '2015-06-04 00:16:42', '2015-06-04 00:16:42', 'Qwick Fusion'),
(91, NULL, 3, '3397.00', '0.00', '2015-06-04 00:51:35', '2015-06-04 00:51:35', 'Qwick Fusion'),
(92, NULL, 3, '7897.00', '0.00', '2015-06-04 00:55:58', '2015-06-04 00:55:58', 'Qwick Fusion'),
(93, NULL, 3, '8797.00', '0.00', '2015-06-04 00:57:01', '2015-06-04 00:57:01', 'Qwick Fusion'),
(94, NULL, 3, '8797.00', '0.00', '2015-06-04 00:57:42', '2015-06-04 00:57:42', 'Qwick Fusion'),
(95, NULL, 3, '10797.00', '0.00', '2015-06-04 02:17:55', '2015-06-04 02:17:55', 'Qwick Fusion'),
(96, NULL, 3, '15797.00', '0.00', '2015-06-04 02:22:29', '2015-06-04 02:22:29', 'Qwick Fusion'),
(97, NULL, 3, '14797.00', '0.00', '2015-06-04 02:25:19', '2015-06-04 02:25:19', 'Qwick Fusion'),
(98, NULL, 3, '13797.00', '0.00', '2015-06-04 02:27:02', '2015-06-04 02:27:02', 'Qwick Fusion'),
(99, NULL, 3, '17797.00', '0.00', '2015-06-04 02:27:34', '2015-06-04 02:27:34', 'Qwick Fusion'),
(100, NULL, 3, '19797.00', '0.00', '2015-06-04 03:46:38', '2015-06-04 03:46:38', 'Qwick Fusion'),
(101, NULL, 3, '18797.00', '0.00', '2015-06-04 03:47:16', '2015-06-04 03:47:16', 'Qwick Fusion'),
(102, NULL, 3, '17797.00', '0.00', '2015-06-04 03:47:37', '2015-06-04 03:47:37', 'Qwick Fusion'),
(103, NULL, 3, '19797.00', '0.00', '2015-06-04 03:48:06', '2015-06-04 03:48:06', 'Qwick Fusion'),
(104, NULL, 3, '18797.00', '0.00', '2015-06-04 03:56:33', '2015-06-04 03:56:33', 'Qwick Fusion'),
(105, NULL, 3, '17797.00', '0.00', '2015-06-04 04:06:24', '2015-06-04 04:06:24', 'Qwick Fusion'),
(106, NULL, 3, '18697.00', '0.00', '2015-06-04 04:07:39', '2015-06-04 04:07:39', 'Qwick Fusion'),
(107, NULL, 3, '18797.00', '0.00', '2015-06-04 04:08:00', '2015-06-04 04:08:00', 'Qwick Fusion'),
(108, NULL, 3, '19797.00', '0.00', '2015-06-04 04:14:06', '2015-06-04 04:14:06', 'Qwick Fusion'),
(109, NULL, 3, '18797.00', '0.00', '2015-06-04 04:14:48', '2015-06-04 04:14:48', 'Qwick Fusion'),
(110, NULL, 3, '17797.00', '0.00', '2015-06-04 04:15:03', '2015-06-04 04:15:03', 'Qwick Fusion'),
(111, NULL, 3, '16797.00', '0.00', '2015-06-04 04:15:29', '2015-06-04 04:15:29', 'Qwick Fusion'),
(112, NULL, 3, '20797.00', '0.00', '2015-06-04 04:16:24', '2015-06-04 04:16:24', 'Qwick Fusion'),
(113, NULL, 3, '18797.00', '0.00', '2015-06-04 04:16:40', '2015-06-04 04:16:40', 'Qwick Fusion'),
(114, NULL, 3, '19797.00', '0.00', '2015-06-04 04:16:58', '2015-06-04 04:16:58', 'Qwick Fusion'),
(115, NULL, 3, '17797.00', '0.00', '2015-06-04 04:17:09', '2015-06-04 04:17:09', 'Qwick Fusion'),
(116, NULL, 3, '15797.00', '0.00', '2015-06-04 04:39:55', '2015-06-04 04:39:55', 'Qwick Fusion'),
(117, NULL, 3, '15797.00', '0.00', '2015-06-04 04:41:17', '2015-06-04 04:41:17', 'Qwick Fusion'),
(118, NULL, 3, '15797.00', '0.00', '2015-06-08 00:35:59', '2015-06-08 00:35:59', 'Qwick Fusion'),
(119, NULL, 3, '15527.00', '0.00', '2015-06-08 00:36:11', '2015-06-08 00:36:11', 'Qwick Fusion'),
(120, NULL, 3, '15347.00', '0.00', '2015-06-08 00:36:37', '2015-06-08 00:36:37', 'Qwick Fusion'),
(121, NULL, 3, '15347.00', '0.00', '2015-06-08 00:41:12', '2015-06-08 00:41:12', 'Qwick Fusion');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transfers`
--

CREATE TABLE IF NOT EXISTS `bank_transfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_date` date DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `source_account_id` int(11) DEFAULT NULL,
  `dest_account_id` int(11) DEFAULT NULL,
  `payment_mode_id` int(3) DEFAULT NULL,
  `cheque_no` varchar(35) DEFAULT NULL,
  `cheque_cleared` tinyint(1) DEFAULT '0',
  `remarks` text,
  `user` varchar(35) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `bank_transfers`
--

INSERT INTO `bank_transfers` (`id`, `transfer_date`, `amount`, `source_account_id`, `dest_account_id`, `payment_mode_id`, `cheque_no`, `cheque_cleared`, `remarks`, `user`, `create_date`, `modified_date`) VALUES
(3, '2015-05-23', '5000.00', 3, 2, NULL, '2341234', 0, 'adfc asdf asdf adf af ', 'Support', '2015-05-23 03:22:00', '2015-05-23 03:22:00'),
(4, '2015-05-25', '200.00', 3, 2, NULL, '4234', 1, 'asdfadfadf', 'Support', '2015-05-23 00:27:00', '0000-00-00 00:00:00'),
(6, '2015-05-23', '1000.00', 2, 3, NULL, '234234', 0, 'a asdf af adsf adf adf ', 'Support', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '2015-05-25', '3000.00', 2, 4, NULL, '2312423', 1, '4asdfafva', 'Support', '2015-05-23 03:21:00', '0000-00-00 00:00:00'),
(8, '2015-05-23', '50.00', 4, 3, NULL, '123', 0, 'adfdfadfafa adf adf ', 'Support', '2015-05-23 03:26:00', '2015-05-23 03:26:00'),
(9, '2015-05-23', '10.00', 3, 2, NULL, '234123414', 0, 'adfa fad faf a f', 'Support', '2015-05-23 03:28:00', '2015-05-23 03:28:00'),
(10, '2015-05-25', '1.00', 3, 2, NULL, '2341234', 1, 'af adf afd adf adf ', 'Support', '2015-05-23 03:28:00', '0000-00-00 00:00:00'),
(11, '2015-05-25', '15.00', 3, 2, NULL, '2341234', 1, 'af adf afd adf adf ', 'Support', '2015-05-23 03:28:00', '0000-00-00 00:00:00'),
(12, '2015-05-25', '300.00', 2, 3, NULL, '6787789', 1, '', 'Support', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE IF NOT EXISTS `banks` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(75) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `created`) VALUES
(1, 'Parkstone Capital Limited', NULL),
(2, 'Access Bank', NULL),
(3, 'Agricultural Development Bank(ADB)', NULL),
(4, 'Barclays Bank of Ghana Ltd.', NULL),
(5, 'Bank of Africa (Gh) Ltd', NULL),
(6, 'Bank of Baroda (Ghana) Limited', NULL),
(7, 'CAL Bank Limited', NULL),
(8, 'Energy Bank (Ghana) Ltd', NULL),
(9, 'Ecobank Ghana Limited', NULL),
(10, 'First Capital Plus Bank Limited', NULL),
(11, 'First Atlantic Bank Ltd', NULL),
(12, 'Fidelity Bank Ghana Limited', NULL),
(13, 'Guaranty Trust Bank (Ghana) Limited', NULL),
(14, 'Ghana Commercial Bank Limited', NULL),
(15, 'HFC Bank Ltd', NULL),
(16, 'International Commercial Bank Limited', NULL),
(17, 'Merchant Bank (Ghana) Limited', NULL),
(18, 'National Investment Bank Ltd', NULL),
(19, 'Prudential Bank Ltd', NULL),
(20, 'Stanbic Bank Ghana Ltd', NULL),
(21, 'SG Bank', NULL),
(22, 'Standard Chartered Bank Ghana Limited', NULL),
(23, 'The Royal Bank Ltd', NULL),
(24, 'UT Bank Limited', NULL),
(25, 'uniBank Ghana Ltd', NULL),
(26, 'United Bank for Africa (Ghana) Ltd.', NULL),
(27, 'Zenith Bank (Ghana) Limited', '2015-05-06 01:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `cash_accounts`
--

CREATE TABLE IF NOT EXISTS `cash_accounts` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(40) NOT NULL,
  `account_no` varchar(25) NOT NULL,
  `bank_id` int(5) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `branch` varchar(35) NOT NULL,
  `setting_id` int(11) NOT NULL,
  `zone_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cash_accounts`
--

INSERT INTO `cash_accounts` (`id`, `account_name`, `account_no`, `bank_id`, `currency_id`, `branch`, `setting_id`, `zone_id`) VALUES
(1, 'Parkstone Capital Limited', '123456789', 3, 1, 'High Street, Accra', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cash_flows`
--

CREATE TABLE IF NOT EXISTS `cash_flows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `operating` decimal(11,2) DEFAULT NULL,
  `investing` decimal(11,2) DEFAULT NULL,
  `financing` decimal(11,2) DEFAULT NULL,
  `net_cashflow` decimal(11,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cash_receipt_modes`
--

CREATE TABLE IF NOT EXISTS `cash_receipt_modes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `cash_receipt_mode` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cash_receipt_modes`
--

INSERT INTO `cash_receipt_modes` (`id`, `cash_receipt_mode`) VALUES
(1, 'Cash'),
(2, 'Cheque'),
(3, 'Bank Transfer'),
(4, 'Ledger Balance'),
(5, 'Standing order');

-- --------------------------------------------------------

--
-- Table structure for table `client_ledgers`
--

CREATE TABLE IF NOT EXISTS `client_ledgers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investor_id` int(11) DEFAULT NULL,
  `total_debit` decimal(11,2) DEFAULT '0.00',
  `total_credit` decimal(11,2) DEFAULT '0.00',
  `total_cash` decimal(11,2) DEFAULT '0.00',
  `available_cash` decimal(11,2) DEFAULT '0.00',
  `invested_amount` decimal(11,2) DEFAULT '0.00',
  `total_rollover` decimal(11,2) DEFAULT '0.00',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `client_ledgers`
--

INSERT INTO `client_ledgers` (`id`, `investor_id`, `total_debit`, `total_credit`, `total_cash`, `available_cash`, `invested_amount`, `total_rollover`, `created`, `modified`) VALUES
(1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2015-06-09 07:45:21', '2015-08-07 19:07:02'),
(2, 2, '0.00', '0.00', '0.00', '50.20', '999.06', '0.00', '2015-07-17 12:16:39', '2015-08-27 11:14:47'),
(3, 3, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2015-08-04 11:22:29', '2015-08-04 11:22:29'),
(4, 4, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2015-08-11 11:32:29', '2015-08-11 11:32:29'),
(5, 5, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2015-08-11 11:42:06', '2015-08-11 11:42:06'),
(6, 6, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2015-08-11 11:43:19', '2015-08-11 11:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `closing_balances`
--

CREATE TABLE IF NOT EXISTS `closing_balances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `balance` decimal(11,2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `credit_payments`
--

CREATE TABLE IF NOT EXISTS `credit_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creditor_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `creditors`
--

CREATE TABLE IF NOT EXISTS `creditors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `supply_cost` decimal(11,2) NOT NULL,
  `amount_disbursed` decimal(11,2) NOT NULL,
  `balance` decimal(11,2) NOT NULL,
  `supply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_disb_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_name` (`supplier_id`,`supply_date`,`last_disb_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(20) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `is_local` int(1) NOT NULL DEFAULT '0',
  `setting_id` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_name`, `symbol`, `is_local`, `setting_id`) VALUES
(1, 'Ghana Cedi', 'GHS', 0, 1),
(2, 'US Dollar', 'USD', 0, 1),
(3, 'Pound Sterling', 'GBP', 0, 1),
(4, 'Nigerian Niara', 'N', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_categories`
--

CREATE TABLE IF NOT EXISTS `customer_categories` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `customer_category` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `customer_categories`
--

INSERT INTO `customer_categories` (`id`, `customer_category`) VALUES
(1, '-Select-'),
(3, 'AGRIC WORKERS'),
(4, 'ARTISANS'),
(5, 'PETTY TRADERS'),
(6, 'GOVT WORKERS'),
(7, 'PRIVATE FORMAL'),
(9, 'EDUCAT. WORKERS'),
(10, 'PRIVATE INFORMA');

-- --------------------------------------------------------

--
-- Table structure for table `daily_defaults`
--

CREATE TABLE IF NOT EXISTS `daily_defaults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `daily_interest_statements`
--

CREATE TABLE IF NOT EXISTS `daily_interest_statements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_id` int(11) DEFAULT NULL,
  `investor_id` int(11) DEFAULT NULL,
  `principal` decimal(11,2) DEFAULT '0.00',
  `interest` decimal(11,2) DEFAULT '0.00',
  `total` decimal(11,2) DEFAULT '0.00',
  `accrued_days` int(4) DEFAULT '0',
  `date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `daily_interest_statements`
--

INSERT INTO `daily_interest_statements` (`id`, `investment_id`, `investor_id`, `principal`, `interest`, `total`, `accrued_days`, `date`, `created`, `modified`) VALUES
(1, 1, 2, '900.00', '0.57', '900.57', 0, '2015-08-17', '2015-08-17 17:15:51', '2015-08-17 17:15:51'),
(2, 2, 2, '150.00', '0.09', '150.09', 0, '2015-08-17', '2015-08-17 17:15:51', '2015-08-17 17:15:51'),
(3, 1, 2, '900.00', '0.57', '901.14', 6, '2015-08-23', '2015-08-23 19:14:23', '2015-08-23 19:14:23'),
(4, 2, 2, '150.00', '0.09', '150.18', 6, '2015-08-23', '2015-08-23 19:14:23', '2015-08-23 19:14:23'),
(5, 1, 2, '1000.00', '0.63', '1001.77', 6, '2015-08-23', '2015-08-23 20:08:05', '2015-08-23 20:08:05'),
(6, 2, 2, '250.00', '0.16', '250.34', 6, '2015-08-23', '2015-08-23 20:08:05', '2015-08-23 20:08:05'),
(7, 3, 2, '100.00', '0.06', '100.06', 0, '2015-08-23', '2015-08-23 20:08:05', '2015-08-23 20:08:05'),
(8, 4, 2, '200.00', '0.13', '200.13', 0, '2015-08-23', '2015-08-23 20:08:05', '2015-08-23 20:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `daily_reinvestinterest_statements`
--

CREATE TABLE IF NOT EXISTS `daily_reinvestinterest_statements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reinvestment_id` int(11) DEFAULT NULL,
  `reinvestor_id` int(11) DEFAULT NULL,
  `principal` decimal(11,2) DEFAULT '0.00',
  `interest` decimal(11,2) DEFAULT '0.00',
  `total` decimal(11,2) DEFAULT '0.00',
  `accrued_days` int(4) DEFAULT '0',
  `date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dashboards`
--

CREATE TABLE IF NOT EXISTS `dashboards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_name` varchar(50) NOT NULL,
  `path` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `debt_payments`
--

CREATE TABLE IF NOT EXISTS `debt_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `debt_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `debtors`
--

CREATE TABLE IF NOT EXISTS `debtors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_cost` decimal(11,2) NOT NULL,
  `amount_paid` decimal(11,2) NOT NULL,
  `balance` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_name` (`client_id`,`sale_date`,`sale_id`,`balance`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `defaulting_rates`
--

CREATE TABLE IF NOT EXISTS `defaulting_rates` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `monthly_rate` int(2) DEFAULT NULL,
  `expired_rate` int(2) DEFAULT NULL,
  `early_termination_fee` decimal(5,2) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `defaulting_rates`
--

INSERT INTO `defaulting_rates` (`id`, `monthly_rate`, `expired_rate`, `early_termination_fee`, `modified_date`) VALUES
(1, 20, 27, NULL, '2015-06-09 07:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `eods`
--

CREATE TABLE IF NOT EXISTS `eods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eod_date` date NOT NULL,
  `flag` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `eoms`
--

CREATE TABLE IF NOT EXISTS `eoms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` date DEFAULT NULL,
  `flag` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `equities`
--

CREATE TABLE IF NOT EXISTS `equities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(25) NOT NULL,
  `beginning_balance` decimal(11,2) DEFAULT '0.00',
  `Owner_Investment` decimal(11,2) DEFAULT '0.00',
  `revenue` decimal(11,2) NOT NULL DEFAULT '0.00',
  `expenditure` decimal(11,2) NOT NULL DEFAULT '0.00',
  `net_income` decimal(11,2) DEFAULT '0.00',
  `withdrawal` decimal(11,2) DEFAULT '0.00',
  `net_loss` decimal(11,2) DEFAULT '0.00',
  `balance_end` decimal(11,2) DEFAULT '0.00',
  `flag` int(2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `equities_lists`
--

CREATE TABLE IF NOT EXISTS `equities_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equity_name` varchar(50) DEFAULT NULL,
  `equity_abbrev` varchar(10) DEFAULT NULL,
  `share_price` decimal(6,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `equities_lists`
--

INSERT INTO `equities_lists` (`id`, `equity_name`, `equity_abbrev`, `share_price`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'Cocoa Processing Company Limited', 'CPC', '2.00', NULL, NULL, NULL, NULL),
(2, 'Ghana Oil Company Limited', 'GOIL', '3.00', NULL, NULL, NULL, NULL),
(3, 'Fan Milk Limited - Ghana', 'FML', '4.00', NULL, NULL, NULL, NULL),
(4, 'Ghana Commercial Bank Limited', 'GCB', '2.20', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equity_orders`
--

CREATE TABLE IF NOT EXISTS `equity_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_id` int(11) DEFAULT NULL,
  `equities_list_id` int(11) DEFAULT NULL,
  `shares_req` int(6) DEFAULT NULL,
  `numb_shares_sold` int(6) DEFAULT '0',
  `sale_price` decimal(6,2) DEFAULT '0.00',
  `total_price` decimal(11,2) DEFAULT '0.00',
  `status` enum('ordered','processed') DEFAULT 'ordered',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exchange_rates`
--

CREATE TABLE IF NOT EXISTS `exchange_rates` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `currency_id` int(11) DEFAULT NULL,
  `foreign_currency` decimal(5,2) NOT NULL DEFAULT '0.00',
  `local_currency` decimal(5,2) NOT NULL DEFAULT '0.00',
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `exchange_rates`
--

INSERT INTO `exchange_rates` (`id`, `currency_id`, `foreign_currency`, `local_currency`, `user_id`, `created`, `modified`) VALUES
(1, 2, '1.00', '3.20', 5, '2014-06-13 08:44:57', '2014-06-13 17:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `expectedinstallments`
--

CREATE TABLE IF NOT EXISTS `expectedinstallments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `zone_id` int(2) DEFAULT NULL,
  `expected_installment` int(11) DEFAULT '0',
  `paid_install` int(11) DEFAULT '0',
  `balance` int(11) DEFAULT '0',
  `default_interest` int(11) DEFAULT '0',
  `payment_status` enum('no_payment','part_payment','full_payment') DEFAULT 'no_payment',
  `defaulter` enum('1','0') DEFAULT '0',
  `installment_no` int(2) DEFAULT '0',
  `newinstallment_no` int(2) DEFAULT '0',
  `due_date` date DEFAULT NULL,
  `previouspaid_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expectedpayments`
--

CREATE TABLE IF NOT EXISTS `expectedpayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `expected_amount` int(11) DEFAULT NULL,
  `expected_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

CREATE TABLE IF NOT EXISTS `expenditures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) DEFAULT NULL,
  `expense_type` int(1) NOT NULL,
  `expense_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` decimal(11,2) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `paid_to` varchar(50) DEFAULT NULL,
  `prepared_by` int(11) DEFAULT NULL,
  `userdepartment_id` int(11) DEFAULT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_name` (`expense_id`,`expense_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `payment_name`) VALUES
(2, 'UTILITIES'),
(3, 'STATIONERY'),
(4, 'CLEANING'),
(5, 'GENERAL REPAIRS'),
(6, 'FUEL'),
(7, 'VEHICLE MAINTENANCE'),
(9, 'STATUTORY PAYMENTS'),
(11, 'TRAINNING'),
(12, 'PRINT MATERIALS'),
(13, 'ADVERTS'),
(14, 'SALARY EXPENSES'),
(16, 'OUT-STATION EXPENSES'),
(17, 'PHONE & INTERNET SERVICES'),
(18, 'ACCOUNTING & LEGAL FEES'),
(19, 'BANK BALANCE'),
(20, 'Offertory'),
(21, 'Design n Printing of Banners'),
(22, 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `fixed_assets`
--

CREATE TABLE IF NOT EXISTS `fixed_assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `asset_name` varchar(30) DEFAULT NULL,
  `asset_type` int(2) DEFAULT NULL,
  `dep_begin` enum('Yes','No') DEFAULT NULL,
  `description` text,
  `cost` decimal(11,2) DEFAULT '0.00',
  `status` enum('sold','expired','alive','deleted') DEFAULT 'alive',
  `depreciation_rate` int(3) DEFAULT '0',
  `year_end_deduction` decimal(11,2) DEFAULT '0.00',
  `purchase_date` date DEFAULT NULL,
  `disposal_date` date DEFAULT NULL,
  `disposal_amt` decimal(11,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fixedasset_extras`
--

CREATE TABLE IF NOT EXISTS `fixedasset_extras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fixed_asset_id` int(11) DEFAULT NULL,
  `asset_value` decimal(11,2) DEFAULT '0.00',
  `year_end_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gross_incomes`
--

CREATE TABLE IF NOT EXISTS `gross_incomes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `gross_income_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gross_incomes`
--

INSERT INTO `gross_incomes` (`id`, `gross_income_name`) VALUES
(1, '-Select-'),
(2, 'Below GHC5,000'),
(3, 'GHC5,000-GHC100,000'),
(4, 'Above GHC100,000');

-- --------------------------------------------------------

--
-- Table structure for table `gross_revenues`
--

CREATE TABLE IF NOT EXISTS `gross_revenues` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `gross_revenue_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gross_revenues`
--

INSERT INTO `gross_revenues` (`id`, `gross_revenue_name`) VALUES
(1, '-Select-'),
(2, 'Below GHC1M'),
(3, 'GHC1M - GHC10M'),
(4, 'Above GHC10M');

-- --------------------------------------------------------

--
-- Table structure for table `idtypes`
--

CREATE TABLE IF NOT EXISTS `idtypes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `idtypes`
--

INSERT INTO `idtypes` (`id`, `id_type`) VALUES
(1, '-Select-'),
(2, 'National ID'),
(3, 'NHIS ID'),
(4, 'Drivers License'),
(5, 'Passport'),
(7, 'Voters ID');

-- --------------------------------------------------------

--
-- Table structure for table `income_statements`
--

CREATE TABLE IF NOT EXISTS `income_statements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) DEFAULT NULL,
  `cash_account_id` int(11) DEFAULT NULL,
  `description` varchar(50) NOT NULL,
  `revenue` decimal(11,2) DEFAULT '0.00',
  `expenditure` decimal(11,2) DEFAULT '0.00',
  `loancash` decimal(11,2) DEFAULT '0.00',
  `interest` decimal(11,2) DEFAULT '0.00',
  `actualinterest` decimal(11,2) DEFAULT '0.00',
  `saleofassets` decimal(11,2) DEFAULT '0.00',
  `proceedsonassets` decimal(11,2) DEFAULT '0.00',
  `taxpaid` decimal(11,2) DEFAULT '0.00',
  `net_income` decimal(11,2) DEFAULT '0.00',
  `flag` int(2) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inst_types`
--

CREATE TABLE IF NOT EXISTS `inst_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `inst_type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `inst_types`
--

INSERT INTO `inst_types` (`id`, `inst_type_name`) VALUES
(1, '-Select-'),
(2, 'Local'),
(3, 'Foreign');

-- --------------------------------------------------------

--
-- Table structure for table `institution_types`
--

CREATE TABLE IF NOT EXISTS `institution_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `inst_type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `institution_types`
--

INSERT INTO `institution_types` (`id`, `inst_type_name`) VALUES
(1, '-Select-'),
(2, 'Local'),
(3, 'Foreign');

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE IF NOT EXISTS `instructions` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `instruction_name` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `instructions`
--

INSERT INTO `instructions` (`id`, `instruction_name`) VALUES
(1, 'Pay interest'),
(2, 'Pay Principal '),
(3, ' Pay Principal & Interest '),
(4, 'Rollover interest'),
(5, 'Rollover principal '),
(6, 'Rollover principal & inte '),
(7, 'Other - provide details');

-- --------------------------------------------------------

--
-- Table structure for table `interest_accruals`
--

CREATE TABLE IF NOT EXISTS `interest_accruals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investor_id` int(11) DEFAULT NULL,
  `investment_id` int(11) DEFAULT NULL,
  `interest_amounts` decimal(11,2) DEFAULT '0.00',
  `interest_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `interest_accruals`
--

INSERT INTO `interest_accruals` (`id`, `investor_id`, `investment_id`, `interest_amounts`, `interest_date`, `created`, `modified`) VALUES
(1, 2, 1, '0.00', '2015-08-17', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(2, 2, 2, '0.00', '2015-08-17', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(3, 2, 1, '0.57', '2015-08-17', '2015-08-17 17:15:51', '2015-08-17 17:15:51'),
(4, 2, 2, '0.09', '2015-08-17', '2015-08-17 17:15:51', '2015-08-17 17:15:51'),
(5, 2, 1, '0.57', '2015-08-23', '2015-08-23 19:14:23', '2015-08-23 19:14:23'),
(6, 2, 2, '0.09', '2015-08-23', '2015-08-23 19:14:23', '2015-08-23 19:14:23'),
(7, 2, 3, '0.00', '2015-08-23', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(8, 2, 4, '0.00', '2015-08-23', '2015-08-23 20:05:12', '2015-08-23 20:05:12'),
(9, 2, 1, '0.63', '2015-08-23', '2015-08-23 20:08:05', '2015-08-23 20:08:05'),
(10, 2, 2, '0.16', '2015-08-23', '2015-08-23 20:08:05', '2015-08-23 20:08:05'),
(11, 2, 3, '0.06', '2015-08-23', '2015-08-23 20:08:05', '2015-08-23 20:08:05'),
(12, 2, 4, '0.13', '2015-08-23', '2015-08-23 20:08:05', '2015-08-23 20:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `inv_dest_products`
--

CREATE TABLE IF NOT EXISTS `inv_dest_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_destination_id` int(11) DEFAULT NULL,
  `inv_dest_product` varchar(50) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `inv_dest_products`
--

INSERT INTO `inv_dest_products` (`id`, `investment_destination_id`, `inv_dest_product`, `created`, `modified`, `user_id`, `modified_by`) VALUES
(4, 1, 'Gold', '2015-02-09 14:30:03', '2015-02-09 14:30:03', NULL, NULL),
(5, 2, 'Fixed Deposit', '2015-03-20 13:49:44', '2015-03-20 13:49:44', NULL, NULL),
(6, 3, 'FIXED DEPOSIT', '2015-04-30 13:40:17', '2015-04-30 13:40:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investees`
--

CREATE TABLE IF NOT EXISTS `investees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `manager_name` varchar(100) DEFAULT NULL,
  `location` varchar(50) NOT NULL,
  `postal_address` varchar(100) NOT NULL,
  `postal_town_suburb` varchar(50) NOT NULL,
  `postal_city` varchar(20) NOT NULL,
  `postal_country` varchar(25) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `mobile` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `product1` varchar(40) DEFAULT NULL,
  `product2` varchar(40) DEFAULT NULL,
  `product3` varchar(40) DEFAULT NULL,
  `product4` varchar(40) DEFAULT NULL,
  `product5` varchar(40) DEFAULT NULL,
  `product6` varchar(40) DEFAULT NULL,
  `product7` varchar(40) DEFAULT NULL,
  `product8` varchar(40) DEFAULT NULL,
  `product9` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `investees`
--

INSERT INTO `investees` (`id`, `currency_id`, `company_name`, `manager_name`, `location`, `postal_address`, `postal_town_suburb`, `postal_city`, `postal_country`, `telephone`, `mobile`, `email`, `product1`, `product2`, `product3`, `product4`, `product5`, `product6`, `product7`, `product8`, `product9`) VALUES
(1, 1, 'Databank Financial Services Ltd.', 'Kojo Addae-Mensah', 'Accra', 'Private Mail Bag', ' Ministries Post Office', 'Accra', 'Ghana', '(233)(302) 610610', '', ' info@databankgroup.com', 'MFUND', 'EPACK', 'BFUND', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 0, 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'me@u.com', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `investment_cashes`
--

CREATE TABLE IF NOT EXISTS `investment_cashes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reinvestor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `investment_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `reinvestor_deposit_id` int(11) DEFAULT NULL,
  `investor_deposit_id` int(11) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT '0.00',
  `available_amount` decimal(11,2) DEFAULT '0.00',
  `investment_type` enum('fixed','equity') DEFAULT NULL,
  `payment_mode` varchar(20) DEFAULT NULL,
  `investment_date` date DEFAULT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `status` enum('available','invested','paid','part_investment','processed') DEFAULT 'available',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `investment_cashes`
--

INSERT INTO `investment_cashes` (`id`, `reinvestor_id`, `user_id`, `investment_id`, `currency_id`, `reinvestor_deposit_id`, `investor_deposit_id`, `amount`, `available_amount`, `investment_type`, `payment_mode`, `investment_date`, `modified`, `modified_by`, `status`) VALUES
(1, 1, 1, 1, 1, NULL, 1, '900.00', '900.00', 'fixed', 'Cheque', '2015-08-17', '2015-08-17 17:15:38', NULL, 'processed'),
(2, 1, 1, 2, 1, NULL, 2, '150.00', '150.00', 'fixed', 'Cheque', '2015-08-17', '2015-08-23 19:14:34', NULL, 'processed'),
(3, 1, 1, 1, 1, NULL, 3, '100.00', '100.00', 'fixed', 'Cash', '2015-08-23', '2015-08-23 20:07:36', NULL, 'processed'),
(4, 1, 1, 2, 1, NULL, 4, '100.00', '100.00', 'fixed', 'Cash', '2015-08-23', '2015-08-27 10:49:15', NULL, 'processed'),
(5, 1, 1, 3, 1, NULL, 5, '100.00', '100.00', 'fixed', 'Cash', '2015-08-23', '2015-08-23 19:48:25', NULL, 'available'),
(6, 1, 1, 4, 1, NULL, 6, '200.00', '200.00', 'fixed', 'Cash', '2015-08-23', '2015-08-23 20:05:14', NULL, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `investment_destinations`
--

CREATE TABLE IF NOT EXISTS `investment_destinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `postal_address` varchar(100) DEFAULT NULL,
  `country` varchar(25) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `investment_destinations`
--

INSERT INTO `investment_destinations` (`id`, `company_name`, `telephone`, `email`, `location`, `postal_address`, `country`, `created`, `modified`, `user_id`) VALUES
(1, 'Tilapia Investments', '0302-221432', 'info@tilapiainvestments.com', 'Sakumono', 'PMB S 423, Sakumono - Tema', 'Ghana', '2015-02-09 14:08:01', '2015-02-09 14:08:01', NULL),
(2, 'Catamount Finance', '', '', 'Madina, Opposite post office', '', 'Ghana', '2015-03-20 13:48:51', '2015-03-20 13:48:51', NULL),
(3, 'ADOM SIKA', '0244209836', 'ADJJJJ@YAHOO.COM', 'EAST LEGON', '', 'GHANA', '2015-04-30 13:39:05', '2015-04-30 13:39:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investment_investors`
--

CREATE TABLE IF NOT EXISTS `investment_investors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_id` int(11) DEFAULT NULL,
  `investor_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `investment_payments`
--

CREATE TABLE IF NOT EXISTS `investment_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_id` int(11) DEFAULT NULL,
  `investor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `instruction_id` int(3) DEFAULT NULL,
  `ledger_transaction_id` int(11) DEFAULT NULL,
  `selling_price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(11,2) DEFAULT '0.00',
  `penalty` decimal(6,2) DEFAULT '0.00',
  `receipt_no` varchar(30) DEFAULT NULL,
  `numb_shares_sold` int(11) DEFAULT '0',
  `payment_mode_id` int(11) DEFAULT NULL,
  `cheque_nos` varchar(100) DEFAULT NULL,
  `event_type` enum('Payment','Rolledover','Termination') DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `created` datetime NOT NULL,
  `payment_date` date DEFAULT NULL,
  `delete_status` enum('dead','alive') DEFAULT 'alive',
  `deleted_by` varchar(200) DEFAULT NULL,
  `edit_details_username_oldnnewamout` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `investment_payments`
--

INSERT INTO `investment_payments` (`id`, `investment_id`, `investor_id`, `user_id`, `instruction_id`, `ledger_transaction_id`, `selling_price`, `amount`, `penalty`, `receipt_no`, `numb_shares_sold`, `payment_mode_id`, `cheque_nos`, `event_type`, `event_date`, `created`, `payment_date`, `delete_status`, `deleted_by`, `edit_details_username_oldnnewamout`) VALUES
(1, 4, 2, 1, NULL, 14, '0.00', '200.00', '0.00', NULL, 0, NULL, NULL, 'Termination', '2015-08-23', '2015-08-23 20:11:13', '2015-08-23', 'alive', NULL, NULL),
(2, 4, 2, 1, 3, 15, '0.00', '200.00', '0.00', '0823150821554', 0, 2, NULL, 'Payment', '2015-08-23', '2015-08-23 20:21:55', '2015-08-23', 'alive', NULL, NULL),
(3, 2, 2, 1, NULL, 17, '0.00', '250.74', '0.00', NULL, 0, NULL, NULL, 'Termination', '2015-08-23', '2015-08-23 20:24:55', '2015-08-23', 'alive', NULL, NULL),
(4, 2, 2, 1, 1, 18, '0.00', '250.74', '0.00', '0823150837123', 0, 2, 'eere', 'Payment', '2015-08-23', '2015-08-23 20:37:12', '2015-08-23', 'alive', NULL, NULL),
(5, 3, 2, 1, NULL, 20, '0.00', '100.20', '0.00', NULL, 0, NULL, NULL, 'Termination', '2015-08-27', '2015-08-27 11:14:24', '2015-08-27', 'alive', NULL, NULL),
(6, 3, 2, 1, 3, 21, '0.00', '100.00', '0.00', '0827151114474', 0, 1, NULL, 'Payment', '2015-08-27', '2015-08-27 11:14:47', '2015-08-27', 'alive', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investment_products`
--

CREATE TABLE IF NOT EXISTS `investment_products` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `investment_products`
--

INSERT INTO `investment_products` (`id`, `product_name`) VALUES
(1, 'Fixed Income'),
(2, 'Equity'),
(3, 'Fixed Income & Equity');

-- --------------------------------------------------------

--
-- Table structure for table `investment_returns`
--

CREATE TABLE IF NOT EXISTS `investment_returns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `reinvestment_id` int(11) DEFAULT NULL,
  `cash_receipt_mode_id` int(3) DEFAULT NULL,
  `instruction_id` int(3) DEFAULT NULL,
  `principal` decimal(11,2) DEFAULT '0.00',
  `interest` decimal(11,2) DEFAULT '0.00',
  `returns` decimal(11,2) DEFAULT '0.00',
  `rate` decimal(6,2) DEFAULT '0.00',
  `penalty` decimal(6,2) DEFAULT '0.00',
  `cheque_nos` varchar(30) DEFAULT NULL,
  `return_type` enum('Matured','Rolled_over','Terminated') DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `investment_returns`
--

INSERT INTO `investment_returns` (`id`, `user_id`, `reinvestment_id`, `cash_receipt_mode_id`, `instruction_id`, `principal`, `interest`, `returns`, `rate`, `penalty`, `cheque_nos`, `return_type`, `date`, `created`, `modified`) VALUES
(1, 1, 1, 1, NULL, '100.00', '2.55', '100.00', '30.00', '0.00', '', 'Terminated', '2015-08-27', '2015-08-27 10:20:11', '2015-08-27 10:20:11'),
(2, 1, 2, 1, NULL, '100.00', '2.55', '100.00', '30.00', '0.00', '', 'Terminated', '2015-08-27', '2015-08-27 10:51:55', '2015-08-27 10:51:55'),
(3, 1, 1, 1, NULL, '2.55', '0.06', '2.55', '30.00', '0.00', '', 'Terminated', '2015-08-27', '2015-08-27 10:53:17', '2015-08-27 10:53:17'),
(4, 1, 2, 1, NULL, '2.55', '0.06', '2.55', '30.00', '0.00', '', 'Terminated', '2015-08-27', '2015-08-27 10:54:43', '2015-08-27 10:54:43'),
(5, 1, 3, 1, NULL, '200.00', '0.00', '100.00', '30.00', '0.00', '', 'Terminated', '2015-08-27', '2015-08-27 10:56:46', '2015-08-27 10:56:46'),
(6, 1, 3, 1, NULL, '30.00', '0.00', '30.00', '30.00', '0.00', '', 'Terminated', '2015-08-27', '2015-08-27 11:08:28', '2015-08-27 11:08:28'),
(7, 1, 3, 1, NULL, '30.00', '0.00', '30.00', '30.00', '0.00', '', 'Terminated', '2015-08-27', '2015-08-27 11:09:17', '2015-08-27 11:09:17'),
(8, 1, 3, 1, NULL, '30.00', '0.00', '30.00', '30.00', '0.00', '', 'Terminated', '2015-08-27', '2015-08-27 11:09:42', '2015-08-27 11:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `investment_statements`
--

CREATE TABLE IF NOT EXISTS `investment_statements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_id` int(11) DEFAULT NULL,
  `investor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `principal` decimal(11,2) DEFAULT '0.00',
  `interest` decimal(11,2) DEFAULT '0.00',
  `total` decimal(11,2) DEFAULT '0.00',
  `maturity_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=817 ;

--
-- Dumping data for table `investment_statements`
--

INSERT INTO `investment_statements` (`id`, `investment_id`, `investor_id`, `user_id`, `principal`, `interest`, `total`, `maturity_date`, `created`, `modified`) VALUES
(1, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-18', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(2, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-19', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(3, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-20', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(4, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-21', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(5, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-22', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(6, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-23', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(7, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-24', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(8, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-25', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(9, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-26', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(10, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-27', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(11, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-28', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(12, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-29', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(13, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-30', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(14, 1, 2, 1, '900.00', '0.57', '900.57', '2015-08-31', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(15, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-01', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(16, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-02', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(17, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-03', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(18, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-04', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(19, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-05', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(20, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-06', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(21, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-07', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(22, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-08', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(23, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-09', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(24, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-10', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(25, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-11', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(26, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-12', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(27, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-13', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(28, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-14', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(29, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-15', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(30, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-16', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(31, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-17', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(32, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-18', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(33, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-19', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(34, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-20', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(35, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-21', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(36, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-22', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(37, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-23', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(38, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-24', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(39, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-25', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(40, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-26', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(41, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-27', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(42, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-28', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(43, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-29', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(44, 1, 2, 1, '900.00', '0.57', '900.57', '2015-09-30', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(45, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-01', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(46, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-02', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(47, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-03', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(48, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-04', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(49, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-05', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(50, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-06', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(51, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-07', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(52, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-08', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(53, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-09', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(54, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-10', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(55, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-11', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(56, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-12', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(57, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-13', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(58, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-14', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(59, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-15', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(60, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-16', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(61, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-17', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(62, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-18', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(63, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-19', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(64, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-20', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(65, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-21', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(66, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-22', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(67, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-23', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(68, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-24', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(69, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-25', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(70, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-26', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(71, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-27', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(72, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-28', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(73, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-29', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(74, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-30', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(75, 1, 2, 1, '900.00', '0.57', '900.57', '2015-10-31', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(76, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-01', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(77, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-02', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(78, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-03', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(79, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-04', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(80, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-05', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(81, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-06', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(82, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-07', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(83, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-08', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(84, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-09', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(85, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-10', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(86, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-11', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(87, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-12', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(88, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-13', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(89, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-14', '2015-08-17 16:39:36', '2015-08-17 16:39:36'),
(90, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-15', '2015-08-17 16:39:37', '2015-08-17 16:39:37'),
(91, 1, 2, 1, '900.00', '0.57', '900.57', '2015-11-16', '2015-08-17 16:39:37', '2015-08-17 16:39:37'),
(92, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-18', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(93, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-19', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(94, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-20', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(95, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-21', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(96, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-22', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(97, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-23', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(98, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-24', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(99, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-25', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(100, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-26', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(101, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-27', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(102, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-28', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(103, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-29', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(104, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-30', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(105, 2, 2, 1, '150.00', '0.09', '150.09', '2015-08-31', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(106, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-01', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(107, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-02', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(108, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-03', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(109, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-04', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(110, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-05', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(111, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-06', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(112, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-07', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(113, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-08', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(114, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-09', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(115, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-10', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(116, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-11', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(117, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-12', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(118, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-13', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(119, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-14', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(120, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-15', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(121, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-16', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(122, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-17', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(123, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-18', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(124, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-19', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(125, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-20', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(126, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-21', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(127, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-22', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(128, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-23', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(129, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-24', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(130, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-25', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(131, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-26', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(132, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-27', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(133, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-28', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(134, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-29', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(135, 2, 2, 1, '150.00', '0.09', '150.09', '2015-09-30', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(136, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-01', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(137, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-02', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(138, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-03', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(139, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-04', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(140, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-05', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(141, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-06', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(142, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-07', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(143, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-08', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(144, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-09', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(145, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-10', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(146, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-11', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(147, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-12', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(148, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-13', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(149, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-14', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(150, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-15', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(151, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-16', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(152, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-17', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(153, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-18', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(154, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-19', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(155, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-20', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(156, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-21', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(157, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-22', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(158, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-23', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(159, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-24', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(160, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-25', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(161, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-26', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(162, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-27', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(163, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-28', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(164, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-29', '2015-08-17 16:55:20', '2015-08-17 16:55:20'),
(165, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-30', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(166, 2, 2, 1, '150.00', '0.09', '150.09', '2015-10-31', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(167, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-01', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(168, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-02', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(169, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-03', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(170, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-04', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(171, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-05', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(172, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-06', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(173, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-07', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(174, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-08', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(175, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-09', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(176, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-10', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(177, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-11', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(178, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-12', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(179, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-13', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(180, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-14', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(181, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-15', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(182, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-16', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(183, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-17', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(184, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-18', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(185, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-19', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(186, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-20', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(187, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-21', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(188, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-22', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(189, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-23', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(190, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-24', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(191, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-25', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(192, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-26', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(193, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-27', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(194, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-28', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(195, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-29', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(196, 2, 2, 1, '150.00', '0.09', '150.09', '2015-11-30', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(197, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-01', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(198, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-02', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(199, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-03', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(200, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-04', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(201, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-05', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(202, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-06', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(203, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-07', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(204, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-08', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(205, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-09', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(206, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-10', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(207, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-11', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(208, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-12', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(209, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-13', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(210, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-14', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(211, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-15', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(212, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-16', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(213, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-17', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(214, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-18', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(215, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-19', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(216, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-20', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(217, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-21', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(218, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-22', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(219, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-23', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(220, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-24', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(221, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-25', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(222, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-26', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(223, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-27', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(224, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-28', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(225, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-29', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(226, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-30', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(227, 2, 2, 1, '150.00', '0.09', '150.09', '2015-12-31', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(228, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-01', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(229, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-02', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(230, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-03', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(231, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-04', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(232, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-05', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(233, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-06', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(234, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-07', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(235, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-08', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(236, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-09', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(237, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-10', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(238, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-11', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(239, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-12', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(240, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-13', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(241, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-14', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(242, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-15', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(243, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-16', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(244, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-17', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(245, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-18', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(246, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-19', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(247, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-20', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(248, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-21', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(249, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-22', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(250, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-23', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(251, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-24', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(252, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-25', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(253, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-26', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(254, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-27', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(255, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-28', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(256, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-29', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(257, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-30', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(258, 2, 2, 1, '150.00', '0.09', '150.09', '2016-01-31', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(259, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-01', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(260, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-02', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(261, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-03', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(262, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-04', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(263, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-05', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(264, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-06', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(265, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-07', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(266, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-08', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(267, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-09', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(268, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-10', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(269, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-11', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(270, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-12', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(271, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-13', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(272, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-14', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(273, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-15', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(274, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-16', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(275, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-17', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(276, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-18', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(277, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-19', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(278, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-20', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(279, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-21', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(280, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-22', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(281, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-23', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(282, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-24', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(283, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-25', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(284, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-26', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(285, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-27', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(286, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-28', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(287, 2, 2, 1, '150.00', '0.09', '150.09', '2016-02-29', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(288, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-01', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(289, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-02', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(290, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-03', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(291, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-04', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(292, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-05', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(293, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-06', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(294, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-07', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(295, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-08', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(296, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-09', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(297, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-10', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(298, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-11', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(299, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-12', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(300, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-13', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(301, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-14', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(302, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-15', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(303, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-16', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(304, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-17', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(305, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-18', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(306, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-19', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(307, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-20', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(308, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-21', '2015-08-17 16:55:21', '2015-08-17 16:55:21'),
(309, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-22', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(310, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-23', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(311, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-24', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(312, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-25', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(313, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-26', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(314, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-27', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(315, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-28', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(316, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-29', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(317, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-30', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(318, 2, 2, 1, '150.00', '0.09', '150.09', '2016-03-31', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(319, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-01', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(320, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-02', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(321, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-03', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(322, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-04', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(323, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-05', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(324, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-06', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(325, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-07', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(326, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-08', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(327, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-09', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(328, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-10', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(329, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-11', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(330, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-12', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(331, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-13', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(332, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-14', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(333, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-15', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(334, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-16', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(335, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-17', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(336, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-18', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(337, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-19', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(338, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-20', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(339, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-21', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(340, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-22', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(341, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-23', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(342, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-24', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(343, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-25', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(344, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-26', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(345, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-27', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(346, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-28', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(347, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-29', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(348, 2, 2, 1, '150.00', '0.09', '150.09', '2016-04-30', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(349, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-01', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(350, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-02', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(351, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-03', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(352, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-04', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(353, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-05', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(354, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-06', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(355, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-07', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(356, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-08', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(357, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-09', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(358, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-10', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(359, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-11', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(360, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-12', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(361, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-13', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(362, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-14', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(363, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-15', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(364, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-16', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(365, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-17', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(366, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-18', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(367, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-19', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(368, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-20', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(369, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-21', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(370, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-22', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(371, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-23', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(372, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-24', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(373, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-25', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(374, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-26', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(375, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-27', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(376, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-28', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(377, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-29', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(378, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-30', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(379, 2, 2, 1, '150.00', '0.09', '150.09', '2016-05-31', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(380, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-01', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(381, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-02', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(382, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-03', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(383, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-04', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(384, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-05', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(385, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-06', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(386, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-07', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(387, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-08', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(388, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-09', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(389, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-10', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(390, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-11', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(391, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-12', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(392, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-13', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(393, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-14', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(394, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-15', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(395, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-16', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(396, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-17', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(397, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-18', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(398, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-19', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(399, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-20', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(400, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-21', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(401, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-22', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(402, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-23', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(403, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-24', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(404, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-25', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(405, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-26', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(406, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-27', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(407, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-28', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(408, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-29', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(409, 2, 2, 1, '150.00', '0.09', '150.09', '2016-06-30', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(410, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-01', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(411, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-02', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(412, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-03', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(413, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-04', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(414, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-05', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(415, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-06', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(416, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-07', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(417, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-08', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(418, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-09', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(419, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-10', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(420, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-11', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(421, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-12', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(422, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-13', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(423, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-14', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(424, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-15', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(425, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-16', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(426, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-17', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(427, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-18', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(428, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-19', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(429, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-20', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(430, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-21', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(431, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-22', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(432, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-23', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(433, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-24', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(434, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-25', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(435, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-26', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(436, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-27', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(437, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-28', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(438, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-29', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(439, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-30', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(440, 2, 2, 1, '150.00', '0.09', '150.09', '2016-07-31', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(441, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-01', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(442, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-02', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(443, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-03', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(444, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-04', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(445, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-05', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(446, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-06', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(447, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-07', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(448, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-08', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(449, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-09', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(450, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-10', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(451, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-11', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(452, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-12', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(453, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-13', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(454, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-14', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(455, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-15', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(456, 2, 2, 1, '150.00', '0.09', '150.09', '2016-08-16', '2015-08-17 16:55:22', '2015-08-17 16:55:22'),
(457, 3, 2, 1, '100.00', '0.06', '100.06', '2015-08-24', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(458, 3, 2, 1, '100.00', '0.06', '100.06', '2015-08-25', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(459, 3, 2, 1, '100.00', '0.06', '100.06', '2015-08-26', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(460, 3, 2, 1, '100.00', '0.06', '100.06', '2015-08-27', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(461, 3, 2, 1, '100.00', '0.06', '100.06', '2015-08-28', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(462, 3, 2, 1, '100.00', '0.06', '100.06', '2015-08-29', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(463, 3, 2, 1, '100.00', '0.06', '100.06', '2015-08-30', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(464, 3, 2, 1, '100.00', '0.06', '100.06', '2015-08-31', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(465, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-01', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(466, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-02', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(467, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-03', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(468, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-04', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(469, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-05', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(470, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-06', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(471, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-07', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(472, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-08', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(473, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-09', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(474, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-10', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(475, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-11', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(476, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-12', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(477, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-13', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(478, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-14', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(479, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-15', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(480, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-16', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(481, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-17', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(482, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-18', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(483, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-19', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(484, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-20', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(485, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-21', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(486, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-22', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(487, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-23', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(488, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-24', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(489, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-25', '2015-08-23 19:48:23', '2015-08-23 19:48:23');
INSERT INTO `investment_statements` (`id`, `investment_id`, `investor_id`, `user_id`, `principal`, `interest`, `total`, `maturity_date`, `created`, `modified`) VALUES
(490, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-26', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(491, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-27', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(492, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-28', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(493, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-29', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(494, 3, 2, 1, '100.00', '0.06', '100.06', '2015-09-30', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(495, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-01', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(496, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-02', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(497, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-03', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(498, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-04', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(499, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-05', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(500, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-06', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(501, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-07', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(502, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-08', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(503, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-09', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(504, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-10', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(505, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-11', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(506, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-12', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(507, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-13', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(508, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-14', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(509, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-15', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(510, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-16', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(511, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-17', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(512, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-18', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(513, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-19', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(514, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-20', '2015-08-23 19:48:23', '2015-08-23 19:48:23'),
(515, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-21', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(516, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-22', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(517, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-23', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(518, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-24', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(519, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-25', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(520, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-26', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(521, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-27', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(522, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-28', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(523, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-29', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(524, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-30', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(525, 3, 2, 1, '100.00', '0.06', '100.06', '2015-10-31', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(526, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-01', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(527, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-02', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(528, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-03', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(529, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-04', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(530, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-05', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(531, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-06', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(532, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-07', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(533, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-08', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(534, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-09', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(535, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-10', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(536, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-11', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(537, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-12', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(538, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-13', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(539, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-14', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(540, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-15', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(541, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-16', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(542, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-17', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(543, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-18', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(544, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-19', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(545, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-20', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(546, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-21', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(547, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-22', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(548, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-23', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(549, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-24', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(550, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-25', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(551, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-26', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(552, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-27', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(553, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-28', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(554, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-29', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(555, 3, 2, 1, '100.00', '0.06', '100.06', '2015-11-30', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(556, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-01', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(557, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-02', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(558, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-03', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(559, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-04', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(560, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-05', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(561, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-06', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(562, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-07', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(563, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-08', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(564, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-09', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(565, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-10', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(566, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-11', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(567, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-12', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(568, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-13', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(569, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-14', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(570, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-15', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(571, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-16', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(572, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-17', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(573, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-18', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(574, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-19', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(575, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-20', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(576, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-21', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(577, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-22', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(578, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-23', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(579, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-24', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(580, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-25', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(581, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-26', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(582, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-27', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(583, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-28', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(584, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-29', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(585, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-30', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(586, 3, 2, 1, '100.00', '0.06', '100.06', '2015-12-31', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(587, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-01', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(588, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-02', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(589, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-03', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(590, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-04', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(591, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-05', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(592, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-06', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(593, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-07', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(594, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-08', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(595, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-09', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(596, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-10', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(597, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-11', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(598, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-12', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(599, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-13', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(600, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-14', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(601, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-15', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(602, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-16', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(603, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-17', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(604, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-18', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(605, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-19', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(606, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-20', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(607, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-21', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(608, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-22', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(609, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-23', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(610, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-24', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(611, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-25', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(612, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-26', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(613, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-27', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(614, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-28', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(615, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-29', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(616, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-30', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(617, 3, 2, 1, '100.00', '0.06', '100.06', '2016-01-31', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(618, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-01', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(619, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-02', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(620, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-03', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(621, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-04', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(622, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-05', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(623, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-06', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(624, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-07', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(625, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-08', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(626, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-09', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(627, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-10', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(628, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-11', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(629, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-12', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(630, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-13', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(631, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-14', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(632, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-15', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(633, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-16', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(634, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-17', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(635, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-18', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(636, 3, 2, 1, '100.00', '0.06', '100.06', '2016-02-19', '2015-08-23 19:48:24', '2015-08-23 19:48:24'),
(637, 4, 2, 1, '200.00', '0.13', '200.13', '2015-08-24', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(638, 4, 2, 1, '200.00', '0.13', '200.13', '2015-08-25', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(639, 4, 2, 1, '200.00', '0.13', '200.13', '2015-08-26', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(640, 4, 2, 1, '200.00', '0.13', '200.13', '2015-08-27', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(641, 4, 2, 1, '200.00', '0.13', '200.13', '2015-08-28', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(642, 4, 2, 1, '200.00', '0.13', '200.13', '2015-08-29', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(643, 4, 2, 1, '200.00', '0.13', '200.13', '2015-08-30', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(644, 4, 2, 1, '200.00', '0.13', '200.13', '2015-08-31', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(645, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-01', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(646, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-02', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(647, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-03', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(648, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-04', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(649, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-05', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(650, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-06', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(651, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-07', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(652, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-08', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(653, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-09', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(654, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-10', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(655, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-11', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(656, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-12', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(657, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-13', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(658, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-14', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(659, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-15', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(660, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-16', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(661, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-17', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(662, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-18', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(663, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-19', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(664, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-20', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(665, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-21', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(666, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-22', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(667, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-23', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(668, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-24', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(669, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-25', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(670, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-26', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(671, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-27', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(672, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-28', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(673, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-29', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(674, 4, 2, 1, '200.00', '0.13', '200.13', '2015-09-30', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(675, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-01', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(676, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-02', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(677, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-03', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(678, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-04', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(679, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-05', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(680, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-06', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(681, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-07', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(682, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-08', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(683, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-09', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(684, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-10', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(685, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-11', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(686, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-12', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(687, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-13', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(688, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-14', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(689, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-15', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(690, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-16', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(691, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-17', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(692, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-18', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(693, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-19', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(694, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-20', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(695, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-21', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(696, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-22', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(697, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-23', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(698, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-24', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(699, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-25', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(700, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-26', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(701, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-27', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(702, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-28', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(703, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-29', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(704, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-30', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(705, 4, 2, 1, '200.00', '0.13', '200.13', '2015-10-31', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(706, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-01', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(707, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-02', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(708, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-03', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(709, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-04', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(710, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-05', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(711, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-06', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(712, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-07', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(713, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-08', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(714, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-09', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(715, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-10', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(716, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-11', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(717, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-12', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(718, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-13', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(719, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-14', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(720, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-15', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(721, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-16', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(722, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-17', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(723, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-18', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(724, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-19', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(725, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-20', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(726, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-21', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(727, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-22', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(728, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-23', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(729, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-24', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(730, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-25', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(731, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-26', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(732, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-27', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(733, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-28', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(734, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-29', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(735, 4, 2, 1, '200.00', '0.13', '200.13', '2015-11-30', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(736, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-01', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(737, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-02', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(738, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-03', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(739, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-04', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(740, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-05', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(741, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-06', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(742, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-07', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(743, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-08', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(744, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-09', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(745, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-10', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(746, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-11', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(747, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-12', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(748, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-13', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(749, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-14', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(750, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-15', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(751, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-16', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(752, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-17', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(753, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-18', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(754, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-19', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(755, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-20', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(756, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-21', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(757, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-22', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(758, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-23', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(759, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-24', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(760, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-25', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(761, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-26', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(762, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-27', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(763, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-28', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(764, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-29', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(765, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-30', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(766, 4, 2, 1, '200.00', '0.13', '200.13', '2015-12-31', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(767, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-01', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(768, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-02', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(769, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-03', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(770, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-04', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(771, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-05', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(772, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-06', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(773, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-07', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(774, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-08', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(775, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-09', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(776, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-10', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(777, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-11', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(778, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-12', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(779, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-13', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(780, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-14', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(781, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-15', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(782, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-16', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(783, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-17', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(784, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-18', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(785, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-19', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(786, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-20', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(787, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-21', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(788, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-22', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(789, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-23', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(790, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-24', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(791, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-25', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(792, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-26', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(793, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-27', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(794, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-28', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(795, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-29', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(796, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-30', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(797, 4, 2, 1, '200.00', '0.13', '200.13', '2016-01-31', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(798, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-01', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(799, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-02', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(800, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-03', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(801, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-04', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(802, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-05', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(803, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-06', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(804, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-07', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(805, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-08', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(806, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-09', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(807, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-10', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(808, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-11', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(809, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-12', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(810, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-13', '2015-08-23 20:05:13', '2015-08-23 20:05:13'),
(811, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-14', '2015-08-23 20:05:14', '2015-08-23 20:05:14'),
(812, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-15', '2015-08-23 20:05:14', '2015-08-23 20:05:14'),
(813, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-16', '2015-08-23 20:05:14', '2015-08-23 20:05:14'),
(814, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-17', '2015-08-23 20:05:14', '2015-08-23 20:05:14'),
(815, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-18', '2015-08-23 20:05:14', '2015-08-23 20:05:14'),
(816, 4, 2, 1, '200.00', '0.13', '200.13', '2016-02-19', '2015-08-23 20:05:14', '2015-08-23 20:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `investment_terms`
--

CREATE TABLE IF NOT EXISTS `investment_terms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term_name` varchar(20) NOT NULL,
  `period_type` enum('Days','Months','Years') DEFAULT 'Years',
  `period` int(4) DEFAULT '0',
  `interest_rate` int(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `investment_terms`
--

INSERT INTO `investment_terms` (`id`, `term_name`, `period_type`, `period`, `interest_rate`) VALUES
(1, '1 year', 'Years', 1, 3),
(2, '2 years', 'Years', 2, 4),
(3, '3 years', 'Years', 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE IF NOT EXISTS `investments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_no` varchar(20) DEFAULT NULL,
  `investor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `investment_amount` decimal(11,2) DEFAULT '0.00',
  `investment_term_id` int(11) DEFAULT NULL,
  `investor_type_id` int(3) DEFAULT NULL,
  `custom_rate` decimal(6,2) DEFAULT '0.00',
  `amount_due` decimal(11,2) DEFAULT '0.00',
  `total_amount_earned` decimal(11,2) DEFAULT '0.00',
  `earned_balance` decimal(11,2) DEFAULT '0.00',
  `balance` decimal(11,2) DEFAULT '0.00',
  `interest_accrued` decimal(11,2) DEFAULT '0.00',
  `interest_earned` decimal(11,2) DEFAULT '0.00',
  `expected_interest` decimal(11,2) DEFAULT '0.00',
  `total_fees` decimal(11,2) DEFAULT '0.00',
  `management_fee_type` varchar(30) DEFAULT NULL,
  `base_fees` decimal(11,2) DEFAULT '0.00',
  `benchmark_rate` decimal(6,2) DEFAULT '0.00',
  `base_rate` decimal(6,2) DEFAULT '0.00',
  `basefee_duedate` date DEFAULT NULL,
  `accrued_basefee` decimal(11,2) DEFAULT '0.00',
  `total_amount` decimal(11,2) DEFAULT '0.00',
  `investment_date` date DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `numb_shares` int(11) DEFAULT '0',
  `numb_shares_sold` int(11) DEFAULT '0',
  `numb_shares_left` int(11) DEFAULT '0',
  `due_date` date DEFAULT NULL,
  `duration` int(6) DEFAULT '0',
  `investment_period` varchar(10) DEFAULT NULL,
  `total_tenure` int(6) DEFAULT '0',
  `accrued_days` int(4) DEFAULT '0',
  `details` varchar(200) DEFAULT NULL,
  `status` enum('Paid','Rolled_over','Cancelled','Part_payment','Invested','Matured','Termination_Requested','Payment_Requested','Termination_Approved','Payment_Approved','Disposal_Requested','Disposal_Approved') DEFAULT 'Invested',
  `old_status` enum('Paid','Rolled_over','Cancelled','Part_payment','Invested','Matured','Termination_Requested','Payment_Requested','Termination_Approved','Payment_Approved','Disposal_Requested','Disposal_Approved') DEFAULT NULL,
  `payment_schedule_id` int(3) DEFAULT NULL,
  `payment_mode_id` int(3) DEFAULT NULL,
  `cashreceiptmode_id` int(3) DEFAULT NULL,
  `cheque_no` varchar(50) DEFAULT NULL,
  `investment_product_id` int(3) DEFAULT NULL,
  `instruction_id` int(3) DEFAULT NULL,
  `instruction_details` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `investment_no`, `investor_id`, `user_id`, `currency_id`, `investment_amount`, `investment_term_id`, `investor_type_id`, `custom_rate`, `amount_due`, `total_amount_earned`, `earned_balance`, `balance`, `interest_accrued`, `interest_earned`, `expected_interest`, `total_fees`, `management_fee_type`, `base_fees`, `benchmark_rate`, `base_rate`, `basefee_duedate`, `accrued_basefee`, `total_amount`, `investment_date`, `purchase_date`, `numb_shares`, `numb_shares_sold`, `numb_shares_left`, `due_date`, `duration`, `investment_period`, `total_tenure`, `accrued_days`, `details`, `status`, `old_status`, `payment_schedule_id`, `payment_mode_id`, `cashreceiptmode_id`, `cheque_no`, `investment_product_id`, `instruction_id`, `instruction_details`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'PARKST-INV-001', 2, 1, 1, '1000.00', NULL, 2, '23.00', '1056.97', '1001.77', '1001.77', '0.00', '1.77', '56.97', '51.61', '0.00', 'Management & Performance Fee', '54.00', '23.00', '6.00', '2015-09-17', '0.00', '0.00', '2015-08-17', NULL, 0, 0, 0, '2015-11-16', 91, 'Day(s)', 91, 6, '', 'Termination_Requested', 'Invested', 3, 2, NULL, '', 1, 4, '', '2015-08-17 16:39:35', '2015-09-02 19:22:13', NULL, NULL),
(2, 'PARKST-INV-002', 2, 1, 1, '250.00', NULL, 2, '18.00', '-250.74', '250.74', '0.00', '0.00', '0.34', '0.74', '57.12', '0.00', 'Management & Performance Fee', '9.00', '23.00', '6.00', '2015-09-17', '0.00', '0.00', '2015-08-17', NULL, 0, 0, 0, '2016-08-16', 6, 'Day(s)', 365, 6, '', 'Paid', 'Invested', 3, 2, NULL, '', 1, 4, 'Pay Principal & Interest', '2015-08-17 16:55:19', '2015-08-23 20:37:12', NULL, NULL),
(3, 'PARKST-INV-003', 2, 1, 1, '100.00', NULL, 2, '18.00', '-100.00', '100.20', '0.20', '0.00', '0.06', '0.20', '11.34', '0.00', 'Management & Performance Fee', '6.00', '23.00', '6.00', '2015-09-23', '0.00', '0.00', '2015-08-23', NULL, 0, 0, 0, '2016-02-19', 4, 'Day(s)', 180, 4, '', 'Invested', 'Invested', 2, 1, NULL, '', 1, 4, 'Pay Principal & Interest', '2015-08-23 19:48:22', '2015-08-27 11:14:47', NULL, NULL),
(4, 'PARKST-INV-004', 2, 1, 1, '200.00', NULL, 2, '18.00', '-200.00', '200.00', '0.00', '0.00', '0.13', '0.00', '22.68', '0.00', 'Management & Performance Fee', '12.00', '23.00', '6.00', '2015-09-23', '0.00', '0.00', '2015-08-23', NULL, 0, 0, 0, '2016-02-19', 0, 'Day(s)', 180, 0, '', 'Paid', 'Invested', 2, 1, NULL, '', 1, 5, 'Pay Principal & Interest', '2015-08-23 20:05:12', '2015-08-23 20:21:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investor_deposits`
--

CREATE TABLE IF NOT EXISTS `investor_deposits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ledger_transaction_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `investment_id` int(11) DEFAULT NULL,
  `topup_id` int(11) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT '0.00',
  `receipt_no` varchar(30) DEFAULT NULL,
  `deposit_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `investor_deposits`
--

INSERT INTO `investor_deposits` (`id`, `ledger_transaction_id`, `user_id`, `investment_id`, `topup_id`, `amount`, `receipt_no`, `deposit_date`, `created`, `modified`) VALUES
(1, 2, 1, 1, NULL, '1000.00', '0817150439173', '2015-08-16', '2015-08-17 16:39:37', '2015-08-17 16:39:37'),
(2, 4, 1, 2, NULL, '100.00', '0817150455072', '2015-08-16', '2015-08-17 16:55:23', '2015-08-17 16:55:23'),
(3, 6, 1, 1, 1, '100.00', '', '2015-08-23', '2015-08-23 19:15:19', '2015-08-23 19:15:19'),
(4, 8, 1, 2, 2, '100.00', '0823150745292', '2015-08-23', '2015-08-23 19:45:29', '2015-08-23 19:45:29'),
(5, 10, 1, 3, NULL, '100.00', '0823150748093', '2015-08-22', '2015-08-23 19:48:25', '2015-08-23 19:48:25'),
(6, 12, 1, 4, NULL, '200.00', '0823150805012', '2015-08-22', '2015-08-23 20:05:14', '2015-08-23 20:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `investor_equities`
--

CREATE TABLE IF NOT EXISTS `investor_equities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_id` int(11) DEFAULT NULL,
  `equities_list_id` int(11) DEFAULT NULL,
  `numb_shares` int(11) DEFAULT NULL,
  `purchase_price` decimal(6,2) DEFAULT NULL,
  `min_share_price` decimal(6,2) DEFAULT NULL,
  `max_share_price` decimal(6,2) DEFAULT NULL,
  `numb_shares_sold` int(11) DEFAULT '0',
  `numb_shares_left` int(11) DEFAULT '0',
  `purchase_date` date DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `investor_types`
--

CREATE TABLE IF NOT EXISTS `investor_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `investor_type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `investor_types`
--

INSERT INTO `investor_types` (`id`, `investor_type`) VALUES
(1, '-Select-'),
(2, 'Individual'),
(3, 'Corporate'),
(4, 'Joint'),
(5, 'Group');

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE IF NOT EXISTS `investors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `entryclerk_name` varchar(80) DEFAULT NULL,
  `customer_category_id` int(3) DEFAULT NULL,
  `investor_type_id` int(3) DEFAULT NULL,
  `payment_term_id` int(11) DEFAULT NULL,
  `payment_shedule_id` int(3) DEFAULT NULL,
  `payment_mode_id` int(3) DEFAULT NULL,
  `in_trust_for` varchar(70) DEFAULT NULL,
  `occupation` varchar(25) DEFAULT NULL,
  `id_expiry` date DEFAULT NULL,
  `id_issue` date DEFAULT NULL,
  `joint_surname` varchar(30) DEFAULT NULL,
  `joint_other_names` varchar(35) DEFAULT NULL,
  `joint_dob` date DEFAULT NULL,
  `joint_idtype_id` int(3) DEFAULT NULL,
  `joint_id_number` varchar(25) DEFAULT NULL,
  `joint_id_issue` date DEFAULT NULL,
  `joint_id_expiry` date DEFAULT NULL,
  `joint_phone` varchar(15) DEFAULT NULL,
  `joint_email` varchar(35) DEFAULT NULL,
  `joint_postal_address` varchar(50) DEFAULT NULL,
  `source_of_income` varchar(20) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `investor_photo` longblob,
  `GRAPHIC_TYPE` varchar(30) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `other_names` varchar(35) DEFAULT NULL,
  `fullname` varchar(80) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `idtype_id` int(3) DEFAULT NULL,
  `id_number` varchar(25) DEFAULT NULL,
  `nationality` varchar(20) DEFAULT NULL,
  `hometown` varchar(30) DEFAULT NULL,
  `birth_place` varchar(30) DEFAULT NULL,
  `work_place` varchar(30) DEFAULT NULL,
  `position_held` varchar(25) DEFAULT NULL,
  `marital_status` enum('Single','Married','Widowed','Divorced') DEFAULT 'Single',
  `children` varchar(15) DEFAULT NULL,
  `nk_relationship` varchar(25) DEFAULT NULL,
  `postal_address` varchar(50) DEFAULT NULL,
  `phone` varchar(35) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `physical_address` varchar(70) DEFAULT NULL,
  `gross_income_id` int(3) DEFAULT NULL,
  `next_of_kin_name` varchar(50) DEFAULT NULL,
  `nk_phone` varchar(15) DEFAULT NULL,
  `nk_postal_address` varchar(50) DEFAULT NULL,
  `nk_email` varchar(35) DEFAULT NULL,
  `investor_signature` blob,
  `ceo` varchar(70) DEFAULT NULL,
  `comp_name` varchar(70) DEFAULT NULL,
  `nature_biz` varchar(30) DEFAULT NULL,
  `reg_numb` varchar(20) DEFAULT NULL,
  `inv_freq` varchar(15) DEFAULT NULL,
  `date_incorp` date DEFAULT NULL,
  `contact_person` varchar(70) DEFAULT NULL,
  `position` varchar(25) DEFAULT NULL,
  `institution_type_id` int(3) DEFAULT NULL,
  `gross_revenue_id` int(3) DEFAULT NULL,
  `contact_mode` varchar(10) DEFAULT NULL,
  `acc_name` varchar(50) DEFAULT NULL,
  `bank_id` int(5) DEFAULT NULL,
  `bank_branch` varchar(30) DEFAULT NULL,
  `acc_number` varchar(25) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `visible` enum('alive','deleted') DEFAULT 'alive',
  PRIMARY KEY (`id`),
  KEY `surname` (`surname`),
  KEY `other_names` (`other_names`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` (`id`, `user_id`, `entryclerk_name`, `customer_category_id`, `investor_type_id`, `payment_term_id`, `payment_shedule_id`, `payment_mode_id`, `in_trust_for`, `occupation`, `id_expiry`, `id_issue`, `joint_surname`, `joint_other_names`, `joint_dob`, `joint_idtype_id`, `joint_id_number`, `joint_id_issue`, `joint_id_expiry`, `joint_phone`, `joint_email`, `joint_postal_address`, `source_of_income`, `registration_date`, `investor_photo`, `GRAPHIC_TYPE`, `surname`, `other_names`, `fullname`, `dob`, `idtype_id`, `id_number`, `nationality`, `hometown`, `birth_place`, `work_place`, `position_held`, `marital_status`, `children`, `nk_relationship`, `postal_address`, `phone`, `email`, `physical_address`, `gross_income_id`, `next_of_kin_name`, `nk_phone`, `nk_postal_address`, `nk_email`, `investor_signature`, `ceo`, `comp_name`, `nature_biz`, `reg_numb`, `inv_freq`, `date_incorp`, `contact_person`, `position`, `institution_type_id`, `gross_revenue_id`, `contact_mode`, `acc_name`, `bank_id`, `bank_branch`, `acc_number`, `created`, `modified`, `approved`, `visible`) VALUES
(1, 1, 'Qwick Fusion', NULL, 2, NULL, NULL, NULL, 'Afreh-Nuamah Kwaku2', 'Software Professional', NULL, '2013-03-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Personal Savings', '2015-07-21', 0xffd8ffe000104a46494600010101004800480000ffe135044578696600004d4d002a00000008000c010e000200000006000008aa010f00020000000f000008b00110000200000006000008c0011200030000000100010000011a000500000001000008c6011b000500000001000008ce012800030000000100020000013100020000002e000008d6013200020000001400000904021300030000000100020000876900040000000100000918ea1c00070000080c0000009e000012941cea0000000800000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000004f72736179004c4720456c656374726f6e69637300004b4335353000000000480000000100000048000000014d6963726f736f66742057696e646f77732050686f746f2056696577657220362e312e373630302e313633383500323031323a30313a32362030373a30343a3536000016829a00050000000100001232829d0005000000010000123a8822000300000001000200008827000300000002019000009000000700000004303232309003000200000014000012429004000200000014000012569101000700000004010203009201000a000000010000126a9202000500000001000012729204000a000000010000127a920700030000000100020000920900030000000100000000920a00050000000100001282a00000070000000430313030a00100030000000100010000a00200040000000100000780a00300040000000100000a00a40200030000000100020000a40300030000000100000000a4040005000000010000128aea1c00070000080c00000a26000000001cea000000080000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010000001e0000001c0000000a323031323a30313a32352031383a34353a313500323031323a30313a32352031383a34353a313500000000050000000100000003000000010000000000000001000001c000000064000000000000006400000006010300030000000100060000011a000500000001000012e2011b000500000001000012ea0128000300000001000200000201000400000001000012f202020004000000010000220a0000000000000048000000010000004800000001ffd8ffdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc0001108014000f003012100021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00a5e5b20cf5ad5d2fc4377a710aae5e2ef1b74adae69289da695afd9ea585cf9729fe06eff4ad9721067196ec2b3e5332ab4444bbd8fccdd69b71a847693206562703e94260c922beb6b8ca64f3d322acc50431c9bd22457fef05c1aa6c948b91cdd9bf3a9f8ab4c96829fd85592145003853854b01c29c2a5887d2d48c702077a4de83f88548ec1e7251e70f43458a0f34fa526f268b0c5ce7bd28a621d8a5c548d1f3cb1c28fa8fe74f6557ea3f1a773ba4896c27b8d37508af21c3f96794e9915d8787f53b8bfd4e6fb4393ba3de00e839aab9c9289d15c0e94973669756c015c9c7159a119fa769ef0999d89ebc0f4ad719c66a9887a9a956429f4a698344eb206fad4dd856d73212972077a004f3107f10a3cf4f7a96d0583ed03fbb47da1bd054b65728be7487bd26f63fc46a6e161453a818e069c2801d4a2801e2945003c1a7548d1f3ab9f93f11fcea50691e89321ae8bc2473abc9ff005c8ff314d1cf58ecae7b7d2ac20f913e948c072a2ec3c75349b31542136e29690c4ce39a944ef8eb55cc2b085dcff11a6e695c4385385003853c5310e14e1400e14ecd002d385002e69e280141a78a0628a766901f3a39f947fbc3f9d4c2a4f489a3eb5d1f83ff00e42b3fa08bfa8a68e7ac76773daada0f917e948e71c3ee7e3455086914d3c5218d340e2810f06a1babcb7b284cd7332451aff131a00e4eefe20db2b14b0b492e08fe363b47f8d3acfc76ecdfe99a6ba47fdf8ce71f81ad790573aeb1beb6d42dd67b6944919ee3b7b55b15021c29d400e14500385385002d3c1a00514e140c70a75007ce6edc0ff787f3ab2b591e9b2c42473c5743e0ee752bb3fc3b3fad5c4e6aa763715757ee8a0e7147dcfc68cd31084d30d48c61a5a00492558a3691c85451924f615e43ac6bb26bfa9bcd213f654e218fd07afd6b480865a49fbc1f27cbe80574105cc26d8a3a7e95a8ec4da75f0d3350596d9be56fbf1e7861fe35e8b04a93c492a1ca30c83ed59c8964a296a043852d002d385301d4b400e069d4c6385385203e6d790f00a90770f71d6ac87ac8f5196a193deba7f059ff004dbbfa7f5aa89cd58ec2e720d5b07e514ce61e3fd58fad349a6210d34d48c61a70e940187e319cdb784f50753cecd9f9903fad78ec1284405c9c7a0ef5ac045dfed47b4da7ecc403fc45ab563d6e1751230c0ef546961f16a7657730313ec93d1b8af4af0b5c34da5946ff009652151f4ebfd6a6466cdd14ea824506968016945301d4b9a007034a39a632414f1c0a903e6990fca3fde1fcea7dd591eb13c4d8aebfc0e3f7f78ff41571397107617479ab4bd0533947ff00cb31f5a6d362129a6a4069a917a0a00e07e226b65216d156207cd4577909e9cf03f4af3b1666e7e54902e3815a15144ada2c823df2cdf28e8339c56d7d815fc3a142fcfe67defc29b668919422bab57fb3fd9b78ebbb6f26bd7bc1685742476ce5dbbfd00a246323a4cd3aa091c0d2d310b4a2801d4b4c628a729c500489cd494867ccf29e07fbc3f9d4b9ac0f5c9e26aecbc099335f73c7cbfd6ae272e20ec2e7ad595ed5472127fcb31f5a6669b10525480d3522f41401e69f126d5d35386e767c8d1707dc13ff00d6af3c8ae4c771d7f5ad0a8b352f2f276b656859430e80ff003a82df55d663db103e6ab37231c1aa48d5b3a24be703631c48bdabd13c18e5f486739f9a5fe82a646523a414ea9331c29698850696801d4a298c5a5cd004b13014e63cf5a433e6793f87fdf1531ae73d82684f4aed3c079325ff00d57fad690ea72620ebee0f35685339090ffaa1f5a61aa64899a335231a4d48bd05003668a29e2292c6aebe8c335f366a4a6d7529a2239490afeb5a4069891dd4aee3f7888beac338ada8a6955018b548276ff9e6576e6b42cbd6314ba8de42a062577098f7af67d234f4d2ec23b546ddb7ab6319359c8cae688a5a92470a5a602d28a005a766818b9a334c07038a76e340cf9ae4fe1ff7c54c4f35cc7b04d0f6aedbc05ff2fe7fdb5feb5a43a9c9883adb8fbd56853390933fba1f5a61354c91b9a4cd48c6935229e0500327b848232599777604e335f39f8899e4d52e6e76e049233103b735b4102666dbcd17463c56ad925a0c9427776ad2c55cf50f00f87d804d5ae0e579f247bf42d5e86b5848824069d4891453b34c05cd2d002d2d03169734c050697340cf9b243f77fdf1529ae63d92786bb8f009f96fbfeba0feb5a43a9c789e87593fdeab39a67231e4fee87d6984d3621334d269031ace14124803deb1355f18e91a55bb37daa39e65e9144db893f874aa51626ce1f44f125ceb7e2a79aed81263c4718e8a33f7455ef14785175746d434d55de47cc9ff003d3dc7bd752464a4790dddb3db5c3232b2329e411820d6ae891995b079aa343e85d1225b3d2edacb81243126f4ee38ad5535c9204c7835266900a2969885a766800cd2834c0514b9a0619a5cd033e6e90e36ff00bc2a426b98f649e135dc7800fcb7c3fdb1fd6b487538f13d0eb67fbd5680279a67231cdc44bf5a825952242f23aa2af56638029b11877be31d12cb766f56571fc110ddff00d6fd6b93d47e24dc3e56c2d5221d9e53b8fe5d3f9d691a64f31ca6a1af6a3a97fc7dde4920feee70bf90e2b21db39add4519dc2cae9ac35086e5588dadce3d3bd7b35bce7ca530731b2867c0ce07a8ab44b303c67e17d36fac7edbf6982d6e00f96491c012fb1ac2f01f86bccf11db2df4d6d1c28db8279e84c87b018345997cc8e9fc7fa8ea5e1bf18dbdfda12217b6589c91956392706aee8df112d2eb116a317d9a4ff9e89f327f88fd6b271bab8948ecedeea1ba884b04a92c67a32364558539ae7341e29c0d310b9a506800cd2e6980b9a5cd030cd19a067cd6e8176fccdf78704e6ac138e6b94f649a23ef5de7800010de1cff00cb4e9f9d690ea71e27a1d5ce7e6aada95d4d6f6e4c7215391fceb589c722b69ba95dcf72219ce53aa9c75ae57e276aef0476ba746c46ff00dec9cf51d07f5a70f889679c19c38dd5199eba0cc8659432919fc6a11313d7861d698c6b393df35ea3e0fd5352bef0bf9567f6757b76f2ccafcb01db8c62ad13238bd6bedd67abbc3a94ad2be721c9ce47b559b6b8b4853292207f435d94ec734d33d111350d4bc25f65d5f4fb8ba80a6e4b88f9923fc0f5af2df31a06789b3b94ed391835c8edd0da269e9daf5e69b206b5b992227aed3c1fc2bd13c31e3d9efa58ecaee20f33b05474e3f31fe159389a23bcdc4e39a5ac24521734a0d48c334b9a062834b9a003341340cf9ba5fe0ff78548d5cc7b44f01e057a078008fb0ddfaf9d5a43a9c789e875137deaccd6ee61584a19577fcbf2e79eb5ac4e2914747983dfaed6c819ef5e75f11750173e289d55c32c2ab18c7ea3f3269c37259c7ace795cd34dc67bd74122193233519948e7f3a602efaf41f849a9247afdc6952b612f62f93fdf5e47e99aa4c991d9f8ff00c3d6526991df61b7af2071c1ff000ae1207dd1794dc9aeca2ee8e599ef3a2dcc17da35b3c4d88e5807cbc707a1af05f1cd89d3fc492865016438e9deb863a3773789cd3c9b48ad9f0e6a6d67acdaceadf72407f0a6cb3e8184c98fde15cffb352e6b964cb42e697348033466818e0697750019a426819f384a7eeffbc2a5ce4d731ed93427a57a07c3f3ff0012fba1ff004dcff2ad2071e24ea663f3d56bdd363bc6dc7ef551c4c8ac74c8749b5924cf249627dabe7ed4aedaeeee7b87fbd23973f52735b40832d9c8351f9b87c56b718f59320fad01bdea912223952633d3f86afe91a94ba4ead6b7f092248250e3f03d2a9099eebe2ebab6bcf0525fa4a7ca91772658f73c0af32d3ee37b104f35d940e39a3d7bc196e93787a0987de52ea7071df35c5fc40816f05cb9077c472a49cf22b093f799a44f349db7286ab3a227da35682069562579029918e0019eb58b37b1f4b4670a066a4cd721419a5cd001ba8cd0521c1a973400b9a426803e7197f83fde15203f30e6b98f6cb10fdeaf41f002e34fb96cf2d31ad2071e24ea25fbd53551c4cafa9a349a45c46bf79a2703eb835f32dc315e2b7810536707ad5691c8707354d943a39b069fe7e29a6210cc1a9eb2e467bd5a62677d6baf0d43c036fa73b1f3ad6e70067aa1c91fae6a8594bb2702bbe89c7347b4f806683fe11e8d5ca17fb43641ebd2b0fc7b0db3c9305e10727078f5ae6927ccca89e272dc80c41f5a6c579e54a1d6b267458fa6b40b97bad06c2696368e46850956ea0e2b4f35c830dd555752b693ed0b148246807ce14f7feefd69a881cd3f8ed059a4e9a74df33eccb37cbf9e2a4b5f19993065b550becf4729691bb65aed8def093057feeb9c1ad2dd4841ba82d401f39cc784ff007853d891cfa5729ee16216cf35e89e00c1d3ae0f7f388ad21d4e2c5f43a694fcf5383567104847943d2be5ed5caa6a370a98d9e63631e99ada2419ac7f2aab21e7834e450aad52eddfc8a1011b02b48ae57e94c0d2d2ee7ca9f04fca6ba147fde035e8e1a4725547b2f816eed23f0db19e48d0add7f11f615cc7c4cd56dbcdf2ad5a32cc801643dbf0a89a7ccc513c6e7c9949ec29d6ce1db6ed627b10335caf73a4fa0bc05e204bcf0f4305d9482e2d87958638dca07079ae9aef57b2b1b66b89a75d8bfddf989fa015838b1dce13c4be3ab8bbb6369a4db5cc21bef4cc36b63d0562f8435d974ab89a0bb81fc9979de7b356f08d8c9b31758d61ceb52fef0bdb1977afa0f6fa56d47730de59c9346c7089bb8acea23a69ea47a1eac97af3c7fc4bd09f4aed3c2fae88a59a0bcbbdb16dca79878acd22aa58e9ff00b6f4dff9fe87fefba43ade9bff003fb0ff00df7459995cf06933846c74614e66cf3deb90f70b10f6af43f007fc82e7ff00af83fc85690ea7162fa1d3cc7e7a9c1ab388c8f166a5fd97e17bab9070fb4a27fbc78af9bef799335bc510537355243448a01ed5223eda94c64e4ac83dea0742bf4ab24740fb5c57436b71be21cfccb5d7869195547a8782f58b58f43b94ba70811fcddc7a74c7f4ae075dd4db55bf9a7eccdc0f41e95acf7663139abfe17e5ed4ed25ca4170d9f9b181f981fd6b8dee749df59c513e0872377bd69a5a29ff0096c7f3ad2c8c6e53ba8d62d4ada20d90ead9e7e957459c1d778a2d606cc4f105ac0b6c76b0dd595e19d4a582f56d1b2431c6dc6723d2b2a88de8b2fdd983c2faa4b1dbb1793ba3761d71f5ad9d3e6fb742b23e1777607a565036a85e16e9fdfa634298ff0059fad7458e4b9c9b4e7604dad8661d4548c6bcb3e849e26ed5e8bf0fcffc4aa6e3fe5bb7f4ab81c98ae874f37faca9b356709c1fc55bbf2f44b1b6cffac9598fe1ff00ed5789dd3735d2b621151b18ce6aa375ace458a0d3a92014656a45933c55a10c718e6b73c3da9416d7599ed21b8dcb80b2e700faf047eb5a53bf4259a775aa8b7b196c9063cd903920f007a7e759892e73ea6baea3b98a4763e0cf075bf88f4ed4dee87f0f9503ff0075fae7f97e75c34b6571a45cdc58dd218e78a40aca7ebfcab8f9bde363a2b4d4963504b55a3ae7a356f732b151b592fa8a393f750e2a46d74fad4dc394a575a9fda0726b2dee5a39d2785ca48bd08a8933485d11cf3cd73299a6919e46ea49ad1d33517b453f39fcea11a366a2ebae47dfa0eb327f7ab4b99587391f264646e152b715e61ef0e88e1abd0fe1e3ff00c4bee467fe5b55c0e4c5743ab94fef2a607356709e67f16dceed317b047fe62bc8e7f9cd74af8484547e38aaee0e738ace4580a5cd4a014330ef4a1fd57f2ab421eaea78cfe74e00c6c1d0f23a55a6264d3dcb4cf9ab36ad9ef935b735c8b1f407836c469fe15b14c61a44f35beadcff002c0af1ef88edb7c73a88f5319ffc7057327ef16738b7076e334f5b82475adee4d88cce7ccce79a0ce4d4dcab0cf38fad30c9ef53263428938a724c7d69263b1324e7d6a5139aab8ac746ecbf264ff10ad8b3d2daf55a407e507185049ae18a3d4ab3e51b73a65c5abb62191917ef36c3c7d6bb0f8787fd0eece78f3aaa3d4c2b4b9a28eba46f9ea656aa38cf35f8baea069833f36d7cf3db22bc824c924e78adfec928acc773568dec3b7c39a64ddda69c7e5b2a59464d38053ec6900f119fad2f944d5a421e20f7a42aa9c03c9aab00eec38e9e957b4b85ae6f61b74fbd2b041f53c55127d290288208e24fba8a1457847c4d1ff15a5db7a84ffd04573c4a390df4a1eb5b8c377cd4bbe95c04dd484d2b8006a5cd218f0f5207aa11d04bb951483f36e1deba887c4d6563142b0d9468e40cb84dc41fa9e6b9227a55d3636f7c43757790256f2d860e4f35d3fc3b7fdc5efa79b571ea7354568a3b177f9c558534ce63ca3e2b9075ab7f9fa5b0e3fe04d5e5b3c80f19e2ba3ec928acd9ebdaba9f1269efa7f85fc371c83124914b311fef1047e98acca3970b4a529808ac53bd4a2426a9310e2c7d6a2279155701e0d5bd32edecf5082e53ef452071f81a2e0cfa520984d0a4aa72acbb85789fc504ff008ab663fde8d0fe958c00e1ba52835630cd1ba801334b9a900cd2e6818a0e29c0d311d2dce7e4fa8fe757f4c012d6e6645cdcc67e42790063f9d72c4f4eb96ee897586461f3b2f35d87c3d3fb8bcffaeb56ba9cd53e04760edf3d5b8db34ce53c63e24ba3f8aae549270a9f8702b809162cf5ae92510321fe10b5d0ebf793dde8be1efb431664b46193e824603f4515051858fd69bb0fad50802afad2e42d0034b5275a062e6a48721b38a108fa17c2977f6bf0be9d2e79f2821fa8e3fa57987c51c7fc25471de14cd447706704692a98c33466900519a0614b480334f069a03aa94f03fdf1fceae6937063b99a350a58f20138cd72c4f52b22cde4cf218c48144aa0ee0bd3fce2bb1f87e7f7177ff5d6ad75392afc08eb9cfcf566334ce53c5be224322f8b2f37746dac3e9815c53aaaf6ae925103213ce703d055ab99cc96763193c450951ff7f18ff5a928a809f4a7734c42103d69091fe4500270286e833d7b5031c3a0e94aad8e6988f6bf86d75e7785827fcf19597faff5ae63e25d9a4fac8955807585770c7b91d6a63f10339ab6f08cd790895275c1f6a867f09dd4209de0d6fecd19fb4338e8d721ca6391cfe1519d32e07f09acfd997cc86fd826e063ad2c7612ca70bd6a7d9b1f302e9d331db8e6a54d2677729dd4ed34f903987368f3a0c9c7bfb538693201963df69f634d40398d994f03fdf1fce95d15983771d08ae03db64f1e0577bf0fff00e3daece7fe5b569138b11f0a3ae90fcf53c2d4ce33cb7e2c4063d6ed27c712c039f704ff00f5abce9f2790457422485c377c5468c781f950c629a4e7d280109a8c6e6e8290891576f2d4c2db9b3da8631c0d1401eb7f0aa466d2af50e30b28c73ed54be2067fb5e6f4fb2a7fe8469c7e326455d1ee3cab0419a7de5f0c115d273d8e7ee2f40bc8db3807287e86a496e142cadf4c5497621322afcdfdd5aad672ec890ff9eb414895675170703f847f3a6db5de6e6e0fab0353718e8af3cd9ee149c86c539ae375ccb19e8c01fc698585954000e32770e49cf7a949f7af30f799246735dff807fe3cee4ffd36ad2271e236475b27decd3e26a6711c7fc57b512e8765738f9a2936fe0c3ffad5e38d95e057422464b9d9cd429b8e718a18c0893d4d26c73dcfe74acc00478a9785a622177dd4aa33496a31b9a70a00f4ef8553e1f50873c108dfce93e213635871ff004e8bff00a11a71f8c991916526db08fe9552f6726ba4c4c4b8727273c8ab2f2ee87fde351734b097521588fbd451b15894734810c121fb41ff0076990391239cd22921d6ce7ce26a4121fb586cd051a531f973fed0fe74f63cfb579a7b63e335e85e041b74e99b3d6723f415a44e2c49d5b9e6846c551c6607c448a49fc28c108014ab3e476fff005e2bc4db06b78903195bd2ab64a4b8f5aa90226eb498a004660b503316a963100a9d171096aaa684426807b540cf40f85d284d76e23fef407f98ab1f111b1af81eb683f9b535f109987652eeb302a9ddc99c8ae93246639eb4e89f28833d2b32c5bb7c902958e00a06459fdf67da92338635252084fcc69e4fef29a11ad31f90fd453d8f4af3cf70922ed5e89e0838d3241ff4d89fd055c4e3c49d4c879a6a9aa388afe215593c3f788c323eccdfcabc0d93e622b7890201f29154a71821aae403a3395a19f152321273474a80133de95e62e8100c014d4ac0c281401d9fc3972be28887f7a3707f2ad8f892b8d56d24fef5bb0fc8ff00f5e9af884ce5ec1bfd1b155ae58735d0668a0c69b1360e3deb2b9a03b65c7d6a476e6981183fbccfb5229c31a91a056c0634a5b2d9a00d99bee1a79ed5c27b44911af43f059ff40907fd34ab89c9883a973cd301a6710ebc885cda1809e2484a7e62bc6efbc33aa5bde79525b105ba1c823f4ade2c93aff0dfc3dd2d3373aedc17555dfe5abec403dcf5fe55e6daeadaa6b37d15a94fb32cefe56d391b73c60fd2b46c9b196182f00d349cd6572829339a0046f4a6d201e3a5385340761f0ec7fc55509ffa66ff00cab7fe257fc7d69febe549fd29f51338ab262223505c3726b72514d8d461b0e6b22c03fcc0d297cd1701037349bb9cd02173d451bb2293291b929f90d3db3c5719ec92447a57a27833034e27d64ab89c9883a873cd460d33889a46c797feed359b715e98539e957724f3df8896d224d692a990c0cbb76963b43579a5d7fae3e95a26558af8a5a9244a5e9cd3013de9a6900e5a78a680edfe1ac25fc40f2e0e2385bf9815bdf1221dc9a7cfd81743f88ffeb53ea0ce06dbe54273c5579cf35b108aad4b6f02cd2619b681d4d665966382d33c8908f76ffeb54bb6c57fe5db3f573fe355644ea48b258a8ff8f38f3eecc7fad385cd98ff00972871f4a7a06a38dd59f6b283fef9acfba31bfcc90aa7ae05276291a727fab34e3ce2bcf3d91f0d7a2f83bfe41b8cff001d5c4e5c41d3c87ad400d51c64b72d831ffbb4c0f4d8918be30856e7c337791f344be62fb115e23264f35a40191e283e98a6210e05275a04069b4862d3d5bda803d0be1810b7d7ab9e4c4bfceba1f8809bf408dbbacebfc88a3a81e5f0bed0466a199ab724acc69f0bec62719e2a13188653e8714ecca7a237e54eec42aa4eed8114849e9f2d2f9571f31f29be5ebed46a1717c8b9001f2cfcc70391cd4935adc2c4fe62edd98c8dc0d3b0cb5203e59cb7e15216ae03d82489cfad7a1f82d89b27ff007aae273620eaa435006a6720fba6f9a3ff0076a20d4d89197e2325fc3f7ea0ff00cb16fe55e24d5a404c4a3a73542184679a4e948434f340a43169e9401df7c37e352ba3ff004cbfad751e381bfc2f31feeba1fd68ea079321c16a8a46ad4921abb612085dcf1928692196daed1a58c6005036fe98a49ef9996d813f75ab4ba26cc6497256584a9fbb50aca5d36e7ef1c9a571d891ee33327a46b9fc690c9f2b2139c824fd7145c63dcfeedbe94a4d79e7ae3e3622bd13c14d9b07ff007eae273d73ac7355c1a6720ebb3f3c7feed41ba9c8119fac36ed2aed7b185bf9578b3f0c6aa02911e68e4d592049a61627b526037a9a70a0029ebf5a60769e0cbf8b4b8751be995992289785ea726b5356f175beada34f6b1db3af9ab8cb10714f975136700e4a484542ed552043334e4931939a9b8c72b9e39a1dcb60669dc43d5f924d246fb7069dc04121dc4e69cae739c9a2e3341f88cfad275c5711eb0e4af43f04ff00c83dcffd35ab89cf5ceb243d6ab834ce41d787f791ff00bb5559a9c8114350f9ece64fef211fa578dcbc39aa80488e8ab200e3ae69a4d260369450014f14c0eefc076697f67ab5bbfdd962543f8eeae6c452d8dccb67700acb1b6d229c5fbc268af7699e6b3cd54810da5a818a0d28eb40833d68cd318669c0e2819a6ff70d1d85729ea8f1f7abd03c14e3ec722fa38cd544e7ae75b277aaaa7914ce51d787f78bfeed56dacfc014d8221bb36f6b19372fcff7075af19bb5db70e3d18d544522b507354480e69a452108294503178a5a607a77c2bb669adf527033f320fe7599f11ed92d3c476f20187961cb0fc48cd4af8819ccb10ca0d66ce9b1fd8d744c9445456250669c3a669880d0681852d006abfdc34a0702b98f50727eb5dd7825bfd1e61fed8aa898573b073d6aa034ce527994338673b5020c9aa33ea3ff002cecd703fe7a1a6c11912a725dc966f535e6dac2edd4e71db79a711c8cfa0d5998da704dd9e29011d28a0029d4c0effe1ecd2436b76d1c8c9f38e871dab23c73792ddf88499642c638d5013f9ff5a95f10d95acec5a6b50f55eff4d7584bff0076ba9a324cc6a2b9cd029698828a062d1480d76e869474ac0f518a9c576be0c70219877de2a918563b273548b91cd0ce64413349363cd7c81d076a85c81c52b8ca172fc63bd79e6b831aa4deb9ab80a466515666255cb1406390b0caf03ad448b82d4a2e36b114a2a91214b4c475fe0fbf1696b3a98d9833f55fa566788dfed5abcf3206d8718c8f6a98fc45c96868f87a4dd0ecab1aaa8fb338ed8aeb39ce2cc58efc52f95ef5858d43ca27bd0633dcd16109e59f5a77967d69586022ff006a8f28e3ad1611aaca707340e145739ea8bc66bb1f0730d938cf3b855230ac764e79aa25a8673a2366aa934985273486645cdd05f954fcdeb5c66b3cdfbb7f7aae05491994a2acc06915ab61039b653fc279a891ad25a99f7aa23ba91474a805523390b45311d1e80f1a5bb872465fb0acb9a4617328c92779ebf5a98fc45c97ba6af87df6c8d5a7a9b0303575a39ce3d860914a9fad646818ef4e61bd7de9d84357e9cf7a55eb40c561f951f77a8e280341ba1a68fba2b8cf4c728c5759e0f385bafaaff5a68c6a1d8b35512d4339d15a798229e6b2ee2e19b2074a45c514db03e690fe75cb6b441be3f85540babf09954b5a9cc2edc9c575104012158fe650062b2a87451473baa00351980f5fe9552ae2612f885a5aa11bba50ff0042246776eaa3a8c2d0dd6e3d1c6e1592f88de4bdc2ee8f2a445d9d80fa9abd757914b19018577459c6d1cf4a855c8c114d43cfb56450f239c520f978a621a4ed7cf634f6148a173914f182b8aa02eb8eb4c51c0ae23d31c3af5ae9bc2ad8f3c76e29a31a875c6407bd67cb26c5c1228673a33279bcce1beed5735274462425013924d72bab737f374eb57026aec67528ad0e62e69d079f760765f98d74cae800503e958d43aa89cb6ad8fed19b15480ed5ac4e697c42d2815423a3d12376b3f94f1bbbd47aec0e238a565e876e6b15f11d525ee1abe1d9f438b4855d4f468eee5f30912195d0e3d3e5615a1732783658c8fec5b883d1a1ba6ffd9b35d91671389c34aa0310bf77b67ae2a2c5480e46e706a475079c5311132f6a58cee18ef48a1c06da3ee9a607ffd9ffe131b8687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f003c3f787061636b657420626567696e3d27efbbbf272069643d2757354d304d7043656869487a7265537a4e54637a6b633964273f3e0d0a3c783a786d706d65746120786d6c6e733a783d2261646f62653a6e733a6d6574612f223e3c7264663a52444620786d6c6e733a7264663d22687474703a2f2f7777772e77332e6f72672f313939392f30322f32322d7264662d73796e7461782d6e7323223e3c7264663a4465736372697074696f6e207264663a61626f75743d22757569643a66616635626464352d626133642d313164612d616433312d6433336437353138326631622220786d6c6e733a786d703d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f223e3c786d703a43726561746f72546f6f6c3e4d6963726f736f66742057696e646f77732050686f746f2056696577657220362e312e373630302e31363338353c2f786d703a43726561746f72546f6f6c3e3c2f7264663a4465736372697074696f6e3e3c2f7264663a5244463e3c2f783a786d706d6574613e0d0a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020200a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020203c3f787061636b657420656e643d2777273f3effdb0043000c0a08090b1417130e0b090d11202c452c2e110c080c0f132833374c604e2c393027130b201c30492c52595053403e2d1d283357526049314036453d50525a4fffdb0043010d140e0e254f4f4f4f1310344f4f4f4f4f4f4f2c1325344f4f4f4f4f4f4f4f4f4f4f4f144f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4fffc00011080a00078003012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00ab4ca45c1a7838ad405a41c50334b8a6014e14dcd20dd4807e4d389a8b9a7d050fdd4b4ca5a092c4770d1f7ad5b3d5f3d6b0e804a74a407689728fdea5ae4a0be3eb5af06abea6a1a035e8a852e11bbd4b4877169334b482800a28c514085a4a28a002968a5a401452e29698094ea290d0014da5cd26280136d3b14b4f514c040b4669c6a326a8421359f73747a0ab12c9e954fcaa8b8c8e34cd5b0314c8d2a6c520145494c14ea004a722d252a5302c114c22a6238a86a891945069335648ea9a0a86a5828192b1a8bad4ad515310ea8e9d9a6d00152c751d488280283c4e64f6ab05295db0d5250054682922801ea29cd310f8a9c0a96333e7d1a17fbbf29aa6b6f7b071f7856fd1815172cc1fec3327278fc2ad5a68e917279ad4a28d4040314b9a28a422557a92ab53c39aab889b145206a7558828a28a0028a2969809452d14084a29692800a28a5a006d3a928a0028c5145030a4a5a282428a28a00292968a630a5a4a2810b4ea6d3e818da4a7526281094b4514009452d1400945145001452d140c29314b45020a4a5a281894b45140094b451400514b452012969296810514514c028a28a401452d140094514b40094b8a28a0028a28a005a4a5a28012968a5a004a5a4a5a430a28a281051451400b45145030a28a29085a4a2968012968a2800a28a2800a5a292800a28a5a0028c5145200a28a2800a28a2800a28a5a0028a5a290c4a2968a04145145030a28a2810b4514500252d1450312968a281051451400514b4948614b451400514b4940c28a28a005a28a2818514514005145148028a28a601451452185145140051451400514514005145140c28a28a0028a29334085a299ba8df4c571f45337526ea0649499a6525021fba937d36971400b9345145002514514c028a28a004a5c51450014b494b4005252d18a004a75252d200a28a2810da314ea298c4c5253a8c5201b8a0538d25301694d2519a40252eda414ea0046a6d29145303c9dadfdeabeec55fa85a206847434459069f9150bc2e3eed01cf7aa32b325e293ad1c51b315420a75271499a0070a7b034ce94e2d400e534528e291cfa5485c414ef31aa3cd2ad30e62f4576c9deb6ed7520fd6b98248a9a19c8a5603b20d466b0935364f7abd16a51bd4580d1a4a8125dd53d20b8b4514b40094ea4a5a00752d251400b9a6934518a004c53a8c5498aa01a052d14d271542109aad2cde944b2fa53152a18ec089448953014d75a9022514b4ea4a0614f14dc53a81053968a05302d76a84d4bdaa3354844740a5a4ab10b52c350934f8dc5005863511a4dd494c4145149400ea9a2a82a78e801a54514e349408aaa54b74a98d288b148d52ca0cd2d3696a0a1696928a40145145002d14945002d4ab25454555c0b345401b153039aab902d2d252d5005252d140052514b400525145020a28a298c28a2968109451450014b4514861494514c41452d25021d4b494ea0625252d25001452d250014514500252d14500252d252d02128a5a2800a29296800a28a2800a5a4a5a061494b45200a28a2800a28a2800a2968a0028a4a5a041494b45001451450316928a2801692968a00296928a4014b494b400514628a0028a292810ea2929690c5a2928a0028a5a2810514525002d2d25140c5a4a5a2810514514861451450014b4945002d252d25020a5a28a062d252d25210b451450014b4945030a2968a0028a28a0028a28a00296928a4014b4945002d14945002d1494b4005145140c296928a062d14514005145148028a28a061451499a005a29bbe8df4c075151f9946fa05724a2a2dd450324cd26ea8e8a0449be937d328a0076f3499a4a2980b45251400b45149400b45252d002d1494520168a28a6014b494b4802928a298051452d03128a5a4a042d1494b40052d2514802969b4b4c05a28a2900628a28a005a4a2968189452d25002d369d494085a28a5a0625253a900a00f2bcd369d8a61a48ea1473418a36a01a7517111bdb8ed50e1aace734706a919f295b26969e6ddfa8a8b9155722c49d68dd4c069f8a0052dbbda907bd2527354226e293151d3f8a4212941a6d28a651637715223d41bb8a4dc6913635a1d4644ad682fe393bd72de69a923b93f4a9b01d882b4a2b9c835392b622bb56a8e51976978a87cda9b228016928a281894fc50053e9884c52d26693354210d56965ec28965f4a8d5295c0555a90518a75494394535ea4148f40880d253a92900528a4a51400fa4a5cd20a605acf155de45152e78aa17284d301ed729511bbacfdc453b78aab9259fb53d209daa1eb4628b858bcb775651c62b22a6598d3b8cd2de2941acdf30d1e7b0ef4c9b1a7bea58d8562fda7dea5495bd695c7635c8a8771151c7754f12ee38a63e527cd46d5262a3349884a28a2a0a16969b4b4842d145140c314b494b40051451400b4a0d251401287a7d414a1cd6971589852d37752d5121452d25002d14945002d252d2500145145300a29296810514514005145140052d149400ea753453a8012929692810514b450310d252d140094b45140828a4a5a0614514500252d145001452d14009451450216928a5a06252d145200a5a4a2800a5a2928016928a5a0028a28a04145145030a5a4a2800a5a292810b4628a2800a28a5a430a28a4a042d145140c5a29296810514514805a28a281894b494b40828a28a005a2928a402d1494b4005145140c28a296800a292968016928a280168a4a2900b451450014b4945002d1499a5a005a4a28a0028a28a002968a2900945145300a5a6e68de2818b4b4cf305279b4012515179949bcd004d466a1de693340136e146e150d14012f98293cca8e96818bbe8dd49450019a33451400514669690c4a5a29281052d2514c62d1452502168a28a005a4a28a43168a4a280168a4a5a60252d145020a5a4a28016928a5a0028a28a40145145300a28a2800a28a2800a5a4a280168a29690094b494b4c414514b486252d21a5a004a5a29280169314b4b40c4a28a28012968a5a0028a4a2901e579a653a9b9a0ec1cb4ec531697340828a5e28a062a3d432c59e86a4155e47aa3190d19a3cc353254ad02bd098b94ac0d2e2878997a734c12551161d9fc2972290106969883340a4a75301775252fe94da421f4f46a8e80e05005b57ab11dd32d52dc29e1a819b2ba9fad6a5bdcab8ae5864f4e6b66c2da41c9a9b08d8a905468b536da43b8514526681066ab4937a524b37614d54a2e1600b52628a7549420a75253a810f148f4a2924a0080d369e69b40094b4945003c50290528a0098d40fcd4f51d00654d05562315ad3459aa2f1d00570d526fa8d929bd2981628a8b7d3b753112669714cc8a7034c05f2969e0814dc8a7ed0690c7ab83534736da8d60a97c8a00ba9386a2ab2262ac50c028cd14548094b4945003b34ea653b34c0296928a402d19a28a0028a28a0414b494b4c05a915ea2a29dc0b145421ea5c8ab245a28a4a62168a28a0028a4a5a630a4a5a4a42168c514500145145002d14514c05a75369d4804a292969884a29692818514514009452d2502168a28a06145251400b4519a2800a28a2800a5a4a290051452d00145252d00252d145020a28a281852e6928a002968a3140051494b4082968a4a005a4a5a2818514514842d145140c4a5a28a0414b49450316928a2810ea4a28a402d145140c28a4a5a0414514b4009452d140094b494b4005145148028a28a002968a2800a5a4a2818b452514805a29bb8526f14c07d14cf3293cca009296a1f30d26f34809f3499150e69281d89b78a4f32a2cd14012f9949e61a8e8a063f79a6e4d369680168a4a2800a28a290052d252d03169292969885a4a5a4a43168a28a620a5a4a280168a292900b4514500149452d0014514500145145300a5a28a430a28a28012968a5a6212968a281851451484145145300a5a28a06028a28a042d25145200a28a2800a28a298052d25148614b494b4085a28a28012968a281052d14505094b45140098a75251400b45252d2185252d14005252d25311e5238a28c53691d761453db6d3053b1430138a5a0519a2c20aab21e78ab26aabf5a68ce4598c54bcd362e94e618a4520069bb11fb5068e940c8ded40e95161876ab618d0ca1aaae66e055c502868d97a53377b5593624228cd1d68a0963b14dc0a5638a69c5003b22944955f752e3de981b760b0f5635d1c383d2b8db59315d4585d892b311aa38a5a4069334c009aa33df05e3350df6a413e55eb58ecc5b9cd0236a3991aad835cc0b865ef5a9677a4fdea9b146ad2e290734ea40252d140a007814d7a78a6b5004269334e349400da4a5a4a0070a414a28a00b1daa3a988e2a3a008cad55922abb4c2bed40196c9503255f922c54056802a15c5266a631d31968019ba9e24a80e454625ab11741a995aa8a3b569dba03401246e6ac6ecd33cbc53a90c78a9b3508a905201d4514500252d14500145149480752d252d0014b451400514514c028a29681052d25140c28cd1494c44aaf4fa8334e0f55711351499cd2d50828a28a004a5a28a620a2929690051451400b452514c0753a9b4ea402525145310514525002d145140c292968a004a5a4c52d001451494805a28a2800a28a298c28a28a420a28a2800a29692810b494b45001451450014b49450014514b400514514005145140c5a292814085a5a4a290c2968a4a042d14525002d145140051451400b45145200a28a5a004a5a28a0028a28a002969b9a4de2801d4b4cf30534cb40c968a87cca4f30d2027a4dd506e34940ec58de29be6543450325f368f30d474520b0e2e69326928a005a28a4a062d2d251408296928a402d1494503168a28a648b45252d2185251450014b494b4c028a4a5a00296928a402d14518a06145145310b45252d00145252d00145145218514514c42d14945200a5a29280168a28a005a4a296800a4a5a2800a28a298c5a28a4a005a28a290052d2514c414b494b4804a5a28a004a534b494c0292969280168a2928016969b4ea0028a5a4a402d14525003a92814b400b494514005145140c5a28a4a005a28a2800a28a290c28a28a00f28cd2528e29b458ea145296a6e69c4d03026969052e681062a9c9d6ae5546eb5466cbd0e3143b66a284d3cd48ec273453a9b4142d029294734085a69507b53b1480d0222f20f6a8b7e3ad5ccd42f16ea77158664d3334e36eebd29bf855dcc9a23ce290b54863a88ad3242399b35b96574518560e315a16a4123e6c7e34981dcc72822b3b51d4fcbe17ad527d59635daa416fad66b166ea690ec1bcb724d3b71c543520aa100ad658c3018ac76e2b66ca4056811ad08c0a9b34c8e9f5914252d252d003c531a9e29a6802334da71a6e2900da28a298052d369c2802d669b8a7d3680131452d14015a58f3553656932e6a9bad00405055774ab751b0cd0067ca2abaa55d916a044e6a807a475a96c955235ad4816988565a654ce2a1a918e14ea68a75004828a4a5a0414514521851451408296928a0638514d14ea042d145140c296929698051494b40828a292800a29692980b9a943d434b45c0b1495107a901ab245a28a298828a28a602d14945003a929296801f4b4da5a420a4a29698c4a28a2800a28a4a005a28a2800a28a280128a28a0028a2968012969296801296929690828a28a0028a29698051451486252d145020a5a4a2800a5a334500145145030a28a281052d149400b45145200a5a6d2e6800a29370a378a005a5a8fcd149e6d004b4543e61a4de690cb19a4cd57dd452b8ec4dbc51e654345170b12f9b49e753292818ede69371a2929085a28a281852d25140c5a28a4a042d1494b48028a28a061452d140828a28a0614b494502168a4a5a630a5a4a280168a28a40145252d0014514531051494b48028a28a005a2928a005c514514c02968a2800a28a5a43128a28a602d1494b40828a28a0028a28a04145141a402d1494b40c4a5a28a0028a28a0028a296800a28a2800a28a280168a4a5a06252d252d31052d251400b494b45200a28a298c28a28a420a28a2800a29693340052d253a800a31451400b49451400b45252d00145145030a28a280168a28a43128a29698828a29290cf280f9a33ed401ed450758629fc7d6a3a7e314120053734ecd141425569192ac66aa3f34d194996a122a538a862e94f34862e4d14828cd05053d69869c28014d0314530e6801f40a6814feb40809a69029d494030c6eaac50a9e95629dd6aae43894d973e94cf2d855e6b70d5118cad332b10286156c3b9ed510dbdaadc631541a0c898d58e94dc51408637353d9ce55aaa935241d699275f0b64549515bf4a9ab12c28c5145003c531aa414c7a0088d369e6994009494ea6d00140a4a70a00b7494bda92800a28a28012a09533562908a00cf2b4c3569a3a8596802a3a66a38e1ab2c29d1ad301121abf08a89455a45ab10c92a2a9a5a8b1523014ea6d3a900ea75369d400514514804a28a28105145140c296928a603e8a4a5a401451453016928a5a0028a28a04149452d002514b4940053b7629b453026dd4ea829c1eaae225a28a2992145145318b452514c91e29d4ca7520128a28a630a4a5a4a0028a28a042d14945002d25145030a28a2800a5a4a2800a28a280168a4a5a0028a28a4014b45250014b4514c028a28a40145264526ea007514cde293cd1401252d43e6d26f34ae3b13519a8371a4e695c5627de293cc150d145c64be6d27994ca2a6e31c5cd264d251400b46692968185145148028a296800a28a31400514514c05a28a29009452d14c4145145200a5a4a5a60252d2518a0614514520168a28a620a5a4a5a004a5a28a0028a28a402d1494b4c028a28a005a28a281851494b40828a28a401451453012968a280168a4a5a40145252d30168a4a2818b4514521051452d030a2928a0414b494b4c028a4a5cd200a5a4a2810b494514c614b452520168a28a00314514b40051494b40c5a4a28a041452d140094b4945002e68a29280168a29698c2928a281052d25140c296928a005a28a2900b40a4a28016969b4ea60145252d20168a28a0028a5a6d002d14945021d4945140c29692969005252d140cf27a434734941d628a79151d3f9a0414525140c302a9b75abad549c73548ca45c4e94a4d247d29d8a92c418a4146292818fa75474fa620dd451da9a290c753be9494b8a04250292905021d4e02994fa06148cbbf8a5a5140b42bf9057a1a72c922d4f8148cb55721c47c7286a7ba8a83152a9f5ab31e56478a96db1baa273525afdea6075b074a9aa287a54b588c4a75369c2801eb4d7a70a6b500466a334f34ca004a6d3a9b40052ad25397ad005cdb4da71269b40051451400514514011b2d42c956b15191401499688d6a765a6c6b4c448ab569062a20b53815622296a1ab125438a865062929d45200a75252d001452d25001494b494c028a28a402d2514b40094b452d002e68a4a5a62168a4a280168a2928016928a2800a28a290051452530168a4a5a603835481ea1a29dc458a2a21253f35448ea05252d500fa5a414b4804a2928a620a5a29290c292968a60145145200a28a29805145148028a28a0614b4c2e293cc145c07d14cf369be69a570d49696a0de69b934ae162c669378a828a5cc3b131929be6d4745170b126f349934da295c62d145252016928a2980b494518a042d14945002d2d25148614b4514c028a28a002968a290094b45140052d149400b46692968105145140c5a4a28a602d251450014b45148028a28a00296928a60145145210b45252d3012968c52d2185145140051494b4082969296800a28a4a602d2d25140052d252d218514514005145140828a28a0618a28a5a004a5a4a5a6014514521052d252d00252d145300a28a2800a5a292900b451450014514500145145301692968a430a4a28a620a5a4a5a005a28a4a005a28a290052d25140052d14b4c04a28a290c2968a4a0028a5a280128a5a4a6014b494b4804a5a28a6014514520168a28a620a28a2900b4b4da5a062d145140094b8a28a002929d4da005a5a4a4e6801d45149486794e7de9b40a08a0eb1314fa61a7d2012969b46714085cd522d83576a9bf5abb9932da74e29fc9a6c1c0a7549a09ba9334bc527140c0d28a281400b4d14e34948075389a6538d31098a7014d14fa006629fd2928a42179a5141a68a621f4a28a4a0639b814c8c9a79e94c885688c240c29f6ed86a6bd2409934c8d4ebade452383562a9d9c7b455cac8a0a51494ea009169af4e5a63d00446994f34da0065369f4da004a7a5369c94016e8a0d25002d14514005145140053714ea4a0088ad222d49428a603c548298054956491bd458a99a9950511d2e2971494805a5a4a280168a28a601494ea4a40251451400514514c028a28a401452d14c42d2d2668a43169296929805145140828a5a4a430a314514c4251452d001494b4940053835369698128714fcd56cd481eaae22714e35186a766a890cd149464502168a6ef14864145c63e92a232d26f3537193515064d19345c2c4db8527982a1a28b8ec4be6d37cd34ca295c2c3b79a4c9a4a2a462d1499a2800a5a28a062514b45001451450014b494b40094b494b4c41451494805a28a280129d4945300a5a28a0028a296900945145002d2d369680173452514c02969296810514514802968a2800a2929681851452d3109452d14861451494085a28a281851452d002514514c02968a2900514514c02968a290828a4a5a0028a2969805145148028a28a630a5a4a5cd00145145001451494805a292969882968a281894514502168a28a4014514503168c5145020a296928016928a3340c5a28a28105145140051494b40051494b4c414514503168a28a402d25145030a5a28a0414514503168cd1450212969296800a28a281851451400b45252d300a28a4a4014514b4c029714514805a4a33450014514b400514945002d14945002d2d251400b4514500145145002d25149401e4f4bbb34947348ec108a7734da7e681873494b9a5e29084e6a931e79abd5458f354672b176334ea62629f525894ccd3b14da603a940a4c528a04068a4c8a5140c5a534948c6801eb4fcd3052d20109a5a4a514c4293482834034123e81452d0315a922a1ba54719ab4632257a2dbef531cd3edcf3546675b6fc2d4d55ad8e56acd6450b4b4da750048298f4fa635004469b4ea6d00369b4e34500329c82929c940172929692800a5a4a2800a29692800a28a2801a684a5348b4c0929f48296ac9236a4a56a4a82829b4fa4a40368a5a4a0028a29680128a5a2800a4c52d1400da5a28a0028a29680128a28a602d1451400b45252d001494b494842d145140c4a29714da60145145020a28a2818514514085c525145031dd28c9a28a421726928a2980514514005145140051452503168a28a04149451400b4945140062968a2900514514c028a28a005a4a5a2800cd14945003a92968a60145145200a28a28185145140828a28a002968a2800a5a4a5a6014514520168a28a60145145200a28a281052d251400b45252d001452d25002e28a4a2818b45145300a28a2800cd2d25148028a5a298828a4c52d21851452d020a28a4a0614b451400b4514500145145310514514861452d25020a2968a06145145001450692810ea29052d03128a28a042d14945002d14514c05a33494520168a28a0028a4a7503128a5a4a042d1494b9a0028a28a0028a28a005a4a28a062d1494502168a5a4a062d2514502168a294d00251494b40052d25140c2968a2800a28a2800a28a2980b49452d200a29296810b45252d31898a5a292810b45145002d25145218b4514500145145300a28a2900b45145001494b49401e4d4a4d20a5c523b4334b8c53334f0d45804a7533753f34084aa67ad5baa87ad332916e2a92989d29e291a094da7f151d218b9a5a4e69d4c04a2968340839a28a4a0090014520a2801d40a4cd3b348421a16839a55a648ee94a29b9a4140c7bf4a8d69ce78a893eb548c6448dcd496e39a8aa6b4fbd5a199d55afdda9ea0b6e953d6250ea51494ea005a47a7e2a36a0088d253a9b48069a4a5a4a6014f8bad479a913ad005c618a65389cd36800a33451400b494b4500252d145301b42d0684a0096969296ac9236a4a534541414514b4806d253a8a60368a5a4a4014514b8a60145145200a4a5a280128a5a4a004a2968a60145145200a28a2980b451494085a28a290c2929692800a4a75250021a28a2800a5a4a4a0028a28a0070a28a2988296928a062d145140828a28a0028a28a0028a296900da28a5a60252d252d020a2929681852514b4084a5a29681894514b40094b45140051452d00145251400b451450014514500145145002d14668a06145145020a5a28a0028a28a002968a28012968a5a60145145200a28a2800a28a2810b452514c614b494b48028a28a620a5a29290c29692968105252d140c28a5a4a0414b494b40051451400b49452d001494b450014514503168a28a04145251400b4525140c5a4a5a29884a5a334520014b4945300a5a4a2900b494b4503168a4a5a0028a28a041451453185145148414b4945300a28a2800a28a280168a4a2900b4b4945031692968a620a28a2818e14514940051451400514514082969334b40c4a5a0d148028a4a5a620a28cd140c5a3140a290051452d3105252d140c28a28a0028a28a402d1451400514514005145140051452d0014da5a4a00f28eb4b8a33486a4ec1bd69f49c53a9dc04fad1494b48425533d6ad9355723354432dc74f06a35e95252286b0a03514da0a1f46292968106da314668a3510628eb450b4807d3714b4945c050b4f149453181a5145016908314ecd3696992121e29894f61c5316ad19c8766a6b5c06a831535afdeab333ad83a54d50c1d2a6ac4614e14da5140125318d482a36a008cd369cd4ca0043494b8a4a004a9169a29cbd6802d668a3345001494b4628012968a2800a4a5a4a004a54a4a12981352d20a5ab248cd2529a4a8285a4a296900525145001462968a006d14b494c028a5a2800a4a28a0028a5a4a4021a2968a004a29692800a28a5a004a29692800a5a4a2800a28a2800a2928a00292968a62128a5a4a062514514843d690d028a062d1494b4085a28a281852e69b4b40052d25140052734b45310525145001452d25001452d148028a4a5a60145149400b451450014b45140051452d002518a28a005a292968012968a2800a28a2800a5a4a5a06145145020a5a4a5a0028a28a6014b494b8a420a5cd251400b45252d030a28a281052d14940c2969296800a2929681051451400514b4940c5a4a5a2800a28a2800a5a4a2810b49452d0014514500145145002d1451400514514c028a28a40145252d00145145300a5a4a290052d149400b451494c05a28a280168a4a5a00296928a4316928a5a0028a28a0414514500145145300a28a2900514b45300a4a29690094b452d030a4a5a4a005a5a4a7e314c06d14869690094b4514c028a28a40252d1450014b452502168a4a2800a5a28a630a28a5a005a2928a005a4a28a04145145031696928a430a5a4a5a620a28a28012968a2800a28a4a005a4a292908f29cd0cc29734dc523b44c669e0d478c548a68185069282052012a9f535748aa5b4e6ad1948b8952546869f526804d3734114a29885a5a61a77152019a2928a6171734ec0a6eda7e6818940e68a4a043a9d4da70a090a5a69a55140c5a294d2502124e951c7cd49274a8a26ab463226a96d81dd51355ab21c8a649d443d2a5a8e3e952566025394d25385004951b549519a008e994f34da006d369d4940082a45a8ea54a00b14b4628a0028a2971400945145002d14b4da006d2ad1425302514b494b564919a4a5349525051452d2105145140c28c5145200a6d3a8a004a28a5a006d14b4940052d252d001498a28a002929d49400945145020a28a298c2928a5c52105252d25030a2968a004a28a280128a28a0425252d25004828a0514c6252d2514842d2d25140c5a4a28a002968a281051451400628a28a0028a5a4a0028a28a0614514500252d1494085a28a280168a4a2980b4514500145252d001451450014514b40051451400b4525140051452d0019a5a4a5a0614514502168a28a4014b494531052d145001451450316929692810b8a28a281851494b40051452d02128a5a2800a28a28016928a2818519a4a5a0414b494b40c28a28a0028a296800a2928a042d1494b4005145140828a28a630a4a5a2800a5a4a290052d252d002514b494c05a28c5148028a28a63168a28a420a5a28a0028a28a06145252d001494b4500145145020a28a298c28a28a420a5a4a5a0028a5a3140c514b9a4a29884a28a2900b494b453185145068105145140c28a0514842d2514b4c6251452d020a28a290c5a28a4a602d145140094ea4a5a0028a28a0028a28a0028a28a0028a28a0028a5a2800a4a2931408f28a56a6e69c6a4ed1b4ea6d385031683474a290842715489f7ab86a977aa46732f20a7d4694fc6691a21b4a0d20a2800a7714518a4303403486814c91e283452503173484d20e696824753a99d6946ea0571d4a290502818b9a39a29d400c71c530254afd2a256aa8984873e6add8d5476ab7a78c9aa24ea63e95253221c53eb30169c29b4e14012546d4fa8cd0030d369e699400ca296928012a44a654919a00b34b4da7500149452d00145149400514b45301a685a434ab4c44b4b48296a844668a0d254142d14514804a5a28a602d25145200a28a28012968a4a00292968a0028a28a003145149400514b494005252d14005251450014514500145145002628a28a0028a28a004a28a5a60368a5a4148078e2929693140052d251400b45145001451450014b4945020a5a28a0028a28a061451450014514500145252d0216928a2800a28a28016928a6e6801d4b5566d42184658d65bf89e0ed9fcaaac06ed34b8f5ae565f13c9d85674dad5eb7fcb423fdd269f2b24eefcd5f5a4f3e3f515c00bc98f576fce9a6ee41dff005aae4633d07ed11ff787e74f122d79e9bb73dcd4d1eaf729f7646a3902e77b4b5c745e24b91d707eb9adab6d7eddfef1da7dcd4f2b19af4542b731b7461f9d4c1aa0614b494b400514514c05a28a281052d252d002d14945200a5a292980b45145020a5a4a5a06145252d0212969296980514514805a28a2800a28a5a004a2968a062514514085a2929681851451400514514082968a28012968a2800a28a2800a28a4a602d14514803345145300a28a2900b45252d300a28a290c5a2928a042d1451400514514005145140c296928a002968a298094b45140828a28a402d2514503168a4a5a005cd1494ea004a5a4a2810b4514940c5a28a2980514514085a4a28a061451450216928a281852d2628a042d2d25140c28a28a0414b494b40c296928a002968a4a0414b494b40c28a28a00314b4514009452d250216928a0d00793d2d0d9a4cd49dc3734f1ba998a78a005cd26296929086e6a9f7ab86a97435763365f534ecd314d3ea0d08e94529a6d00494b4de2969801a00a0d14085cd2514b40052d369c281099a7e6a3a901a004cd385252d002d2d369c290c6cbd2a206a593a546b5a239a421357f4efbd54315a3a6afcd5423a94a7535696b201d9a78a8ea41400fa88d49519a0061a6d38d36801a6929d4da004a9e2a82a78e981628a4a5a40252d252d300a4c514b4802929d49400da1694d22d31130a0d253aac44468a0d2548c5c514515230a28a298828a5a4a430a28a281094b4514009452d25030a28a2800a28a2800a28a280128a5a4a004a28a28012968a4a0028a28a0028a28cd0014514500251451400520a5a2801d494ea6d0212968a281852d252d002d25252d020a28a281852d251400b45251400b45252d0212968a2818514945002d1499a864b944ea450226cd4525d449d5947d4d73b79e23ed1fe758736a12cdd58d5f281d4dcf88a08beefcdf4359371e25b893a6d4fa73fceb0f7e6937e6aec892ccf772cdf79d8ff00c08d41bb14cce29d54217752d45be8e6992499a5dcb49b78a40314143cd02806802980b4fdc4521a2a46598af264fe223f1ad9b3f116de1f27e9ff00ebae709a5c9a5619df5bea104ff75c55baf3c86f268f9048ae8f4ff1007e25e0fa8e959f281d0d25316456a7d48c5a5a4a2800a5a28a005a28a2800a28a5a04145252d00145145002d25145002e68a28a0614b49450014514502168a28a0614529a4a00296928a042d1451400514514005145140052d149400b4514500145145002d25252d00145252d030a28a28105145140051494b4c05a4a5a281894ea4a29082968a2800a29296800a28a2800a28a280168a28a06145145002d25145020a28a2800a5a4a2818ea2928a0414b4514c62d25149400b4b494b40052514b40828a292818b494b45001494b9a2810514b45030a292968105145140c29734945002d1451400b45251400b45252d001451450014b49466810b4514503129734949401e51451486a4ed129eb4ce69eb48619a28a6d3103d53279ab8c7354f1f353466cb89526298314f3526834d26053a929a10878a905369d48043498a751408414b40a4a004a39a5c5285a60005498a4a5a40252d14e1400de94e1494a2810d9471518a925e950926b4463216b4b4afbd59e1735b1a3a8cd320e8052d1456603a9c2994f1400fa8cd494c340119a6d3e99400da4a5cd25001534750d588968025a2969280168a296980da5a28cd001494ea6d0210d2ad369cb4c09450681486a891868a0d254162d1451484145145030a2968a004a4a752500145145020a28a281894b45250029a4a28a0028a28a004a4a7525002514514005252d14009452e292800a28a4a0031452d250014514500252d2528a007d369452500145145002d251450014b451400b49452d002514514005145140052d25140051494b400546f32a75aaf73a8456ff0078d72da86b525c1e3217d334ec2b9b37bae2a7dc209ae76eb559e5eac7f03545e43eb51ee35af29049bb34d3480536a863947ad251b0d49e5b520b0ca904752adbd4c23a2e5f2958474be5559110a7e295c394ac23352086a6c528145c762bfd9f34ab6c6ad04a904740ac535809a77d9aaef954857d680b19fe5d308ad0d82a26805170b14a9f9c74a90c55162a89356cb59961ef915d4db5ec738c8ae0055cb5be7b739c9fcea5a0b9de52d66d9ead14fec6b441cd6431696929681852d252d020a5a4a5a0028a28a041452d250014b4525031692968a04145145002d25145031714514500145145002d1494502168a4a5a06145252d002d149450014b45140829334b453012968a29009452d14005145140094b494b4005145140051451400b452d25030a5a4a2800a28a5a62128a2969005145140051452d3012968a4a402d2514b400525145002d1494b40051452d002d25145002d14945318b494b450014b49450014b49450014b4525002d252d1400514514005145140052d252d020a4a5a2818b49451400b451450014b4945002d252d1400514514082968a5a4312929692800a5a4a2981e4d41a4a5350770669e2a2cd494008683452d00318554fe2ab8dd2aa77e299932f0a3340cd148d029052d02824514e029334b9a4303494bba8a0560c514b49834c02956929453017ad2d02969084a929b8a7500368a5a05310c9ba543534c38a88d5230912eead6d17a9ac4cd6c68afcd311d1d1452d40053d6994f1400ea61a92a33400ca6d2d2500328a5a4a002a786abd4f150059a4a28a005a28a4a0028a28a620a4a5a4a00434ab4868514c0985232d28a0d5124745068a82c28a28a4014b49450019a5a4a29885a4a28a061451452105145140c292968a0414945140c2929692800a2969280128a28a00292968a0033451494005252d25002d25145001494b4500251451400f1494b4940051451400514b4940052d14500252d145001494514082968a4a062d14525002d54bbbc481724feb52cb308c64d71baa6a7f6838fe1aa484417daa3dcb7b567339a0b0a4adb4204fd69569db3d29c903d1718bb734e5b5a9d22c54b50511ac4a2a4e28cd33340c76ea76e34ccd28a431e053c0a45152f14086eca7ac74e029c2985c58d0d5954151a1ab02a8428869a6dea719a7530331a235130ad275aab22548ee56d80d42d055ad949b690148c151722b44a547e4834c45786e5e33906bacd3f578e7e380de99ae46580af4a449594f191f8d16259e879a5acad36ff00cf1cb735ab590c5a28a5a0614514b400519a28a042d145140c4a5a28cd0212968a4a005a28a280168a4a2818b45251400b45145020a4a5a28185145140052d145020a28a281852d2514085a2928a005a4a2968012968c514c0292968a4014514500145145001452d140c28a28a041451450014b494b4005145140094b45140829692968282928a2810b49451400514b45001494b4500253a929698051451400b45252d2185252d14c414525140c5a5a4cd1400b49452d00252d14940052d252d0014514b400da75252d00145145001451450014518a2800a5a4a5a0028a296800a28a280168a4a2800a28a2800a5a28c500793504d3694d64770c005482a3a916801d4da0514c06383555739ab449aaa1b9aa46322f52f5a414fed526a36814bc515402d251462810b8a05252d20b8ea314829714c414b8a653e810a29c45354d4940094a28a2900da78a6d380a64914d50f4a9e7e950b366ad1948656d68bd6b19456de8fd69927442968a2b30169c2994f1400e34c34fa61a008c8a4a534dcd0021a6d3a928012ac4555ea78c5005834520a5a60145145200c514514082929692980d34e5a69a72d3422514b4d14b5404668a0d1505051494b40828a29690c28a4a5a0425145140094b452503168c5145020a4a5a4a0614504d1400668a4a28016928a4a0414945140c5a4a28a042d2514503128a5a2801b4b4525002d252d250014a292956801f4da7536800a2834500145145002d25145002d1451400945145002d2514500151c92841934fac2d7350f2976af53408cbd575a79784240ac1794d0eec6998c56c46a28a9516a253cd5a414c689d100a70a6034a5aa4a1f4d2690b5349a43024d19a696cd25003f26a453508a98714c44e9520a814d4c0d31b25dd46698296802c21a9d4d554a9d0d324ba0d2d57df4f0f4c01b35032d4acd5117a9286eda4db4f0d45311114a8b1564d44d4808f606aa53db915769d80d4032a5a5f3dbb0e4d7676b74932e41ae2e6b7dbd2ade99a9790dc938a9623b3a5a8a39038a92a005a28a2818b45145020a28a5a06145145200a4a28a621696928a06145145020a5a28a061451450212968a2800a28a5c50312968a4a042d2d25140c5a2929681052514b4005145140051451400514514005145140051451400514514c05a4a5a2800a28a290c5a4a29681094b4525002d145140052d25140052d251400b494514c05a28a290051452d03128a5a28012968a4a005a5a4a2800a28a5a0028a4a29885a28a4a00752514940c5a5a28a00292968a003345145002d252d25002d1494b40094b494b4085a2929690c4a5a28a005a4a28a602d1494b40052d25140052d149400b45149480f250295a9a29e4d41de479a78a6629f4c41934b49499a40235530bcd5d6e954c75aa462cd01d2839a414b526c2e292969b4085a751460d0036968a5c5310a3228a334868240d3835474e06802414fcd31296800cd3e994e0680129d4940cd3019702a023153cc6a0dd568c6401ab774715888b5bfa453641bb4520a5acc029e2994f1400ea653a986801869b4ea6d0025252d21a004ab10d57ab3053026a28a290051451400514514c02929690d0034d3c5308a78aa42241451455124668a28accb0a28a290828a4a5a60145145030a28a29005252e68a004a5a4a5a002928a2800a4a28a005a4a2968012928a2800a4a5a4a00296928a00296928a002928a2800a4a5a2800a4a28a004a72d2528a007d252d21a004a28a2800a28a2800a5a4a2800a29692800a4a5a2800a4a28a00ad7372225249c570ba85fbdcb7b56eebf7a17e51d6b94635a2440c634039a33eb4015a82255535656a05cd4eb5059271494dcd264d2016929adcd250087e68a6d3a900ea9334ccd286a604e0d481aa114edd4c0901a786a8435383d202c06a994e2aa0615306a605a0f4bbaab6fa532517027df4cdf50e68a009c53ea10f8a93cca6019a8cb53c9a849a910668535197a375004ff7bad54960643c0e2ad29a90a861408bda3ea3fc26ba0cd70a330357576172655a903428a4a5a918b45252d020a5a4a2818b4514500145145002d1494b40051494b40051451400514b4940051451400b494b49400b4b4da5a0028a28a04252d145002e28a28a06145145001451494085a28a2800a28a28016928a281851452d020a4a5a4a0614b45141214514b40c4a5a292800a5a28a0028a5a4a0614b4525002d1494502168a4a5a004a5a4a5a0028a28a005a4a5a4a602d145148028a29681894b4945301692968a0028a28a002929692810b4b4945031692968a0028a28a005a4a28a002969296800a28a280168a4a5a0028a29280168a5a281851451400b452519a42168c51494c47928229339a3f0a0d627785380a6d28aa0169714da5a60364e954d7ad5b6e95514f34cca48d15a29aa06296a4d43345273499cd5123e9d4c14f5a4021e29d4c34b400b45264d2d3019525474f1482e48a4d2d34714ea62129d48734ea04252e692969011cfd2a15a965a8f005688c644aa95bba48c562435bda65041b14514540053e9b4e1400a6986a4a8cd00329b4ea4a004a6d2d250015620aaf53c74c09e928a2900b45145300a28cd25002d369d4948069a7ad30d3d6a844828340a0d58888d141a2a0a168a4a5a9012968a4a6014b4945002d2514500145145200a28a2800a334945001494b450014b494b400da29692800a4a28a005a4a5a4a005a4a28a004a28a2800a4a5a4a005a2928a004a51450280241486969a6800a28a2800a29692800a28a2800a28a28105145140c4a86798463353562eb973e5a7523e9401ca6a57467909acf3523b5256e48de69d48314f145c0956a4a6034bcd4942ad2e6a326901cd004b49d29334b9a4014a29179a50b4c2e3b69a7814b8a7014804a7d3bcba5c50312969de5d2f966810d153034cc53855143f34669a294d210b9a4dd4ce451408983526f350e69d9a603fcda61714c2698695c093752d441a97340589d5ead230aa40d4e8c681134d106156347b921b6e6a35aa7feade811db8a70aab692f9880d59acc05a28a4a005a28a2818b45145001451450014514502168a4a5a062d251462800a2969281051451400514b45030a4a29681094b452d00252d14500145145030a28a2810514525002d145140c296928a0414514b40c4a28a281051451400b4514500145145002d145140c28a4a5a04145252d31851451400514b494805a28a4a602d028a29082969296800a29296818518a4a5a60252d252d001452d2500145145002d2628a5a002929692810b451450316928a280168a28a0028a4a5a0028a28a007525145002d1494b400514518a0028a28a005a2928a005a51452d200a4a5a4a04791d2d20a56db599e809d6814da755083ad3a994a4d2183f4aa61b9e9569ba5541d6a8ca562fa9a5e291696a0d02929692ac029c0d18a406a442d2e6928aa0179a0d19a2905829c29b4e534c924a7669b45002eea7d474fa042538d34507140114d51e69f35455a44e691652ba0d28f15ce466b7f49a181b745252d6602d3a9314ea0053519a90d47400d34ca7536800a4a292800c5588aa0a9e2069812d2d252d0014514948028a28a0028a2929801a78a61a78a6224a434506ac44545252d665052d251400b4945140828a28a061451452105145140c28a28a002929692800a28a2800a29296801292968a004a28a2800a29692800a4a5a4a041451450312968a4a00292968a004a51494a28024148695690d00251494b400514b450014da75250018a28a2800a28a2801a4d71be23ba2cdb47f3aec257c0af3ed566df21e735712599dba8a434b9cd6a21e2a618a8179a907148b449d69791510a7e6a442f140e2928eb4876169e05305480d5068386053e9bb69e01a9631467d29f8a4c5389a431ea2a4c544952a1a604c1682b4f14b401052629e69b40052034b49400ea6eda753b834c4461294a54c1682b408aac95114ab863a81a9010d2e294ad18a6039735614d56a910d202ea354174b52252ca3229926a68b7991b49adeae334f9bcb92bb046cd4b01f4b494548c75252d2502168a4a5a0614514500145145002d19a4a2801696928a0028a29690051494b4c028a28a0028a292810ea2928a005a2928a0029692968016928a2800a28a28012968a2800a28a281851451408296928a005a4a5a2800a28a2800a28a2800a5a28a630a28cd1484252d145001451450316928a2801692968a0414514940c5a28a2810b45145030a28a2800a28a298052d25140051452d020a2928a062d14514005145140051452d00252d251400b4525140829d494b40c5a4a28a00296928a005a5a4a5a00434514b40051452e280014ea6d2d200a6d3a905023c87bd3ea05b85ef52ef06b3b1dc04d141a514c6149d28a2a4a10d531d6ad135543735a18345f534a4d3129f506c19a4e6839a0d3245a073499a7503129714dcd385048668a5cd0453189d2a406a3a72e6824901a753296810e14ea6034b9a403a969a2973540453547906a498d4600ab460c912ba2d2ba573e95d0695d28649ae29d4da75400b4e14ca90500388a84d4a6a222801869b4e34da006d253a9b40055984d56ab115004f494514c05a4a5a4a40145145300a0d14940843520a8cd4829812521a0519aa111514515050b494b4520128a28a0028a4a5a0028a28a0028a28a0028a2928016928a281051494b400514525030a4a5a280128a28a0028a5a4a002929692800a4a5a4a042e6928a5a0625145266801681494a2801e2929d494005252d250216929692818b49451400514514009452d250057ba385af39bb62646aeff53902466bcea5ebd6b4890c6f1494534d58684aa6a4a850d4ca6a4b41ba955a8a76295c2c14a053945480520b0c54a955714ec0a538a076176d3c2d47479b40cb1b2938a845cd3649f03ad219353d1c551fb46475a9125a623503d2e6a924d52092a8098d369bbe8a042d2d474a1e9012538545526ea43b13d2eda801c54cb20a6219516cab5c54656981588a8ea76a8f1484329eb4d2b4805005b43523722abad4fc5022b29d8d5d9594bbd0571ad8ae8f469815eb4846cd1452d48c28a28a002968a2800a28a4a402d14514c028a28a042d145140c28a28a0414b4945002d1494b40094b494b400514525002d2d25140051451400b9a4a5a33400514945002d252d140c28a4a5a04145149400b4b49466800a28a280168a4a5a0028a292801696928a0028a5a2800a28a2800a5a4a281851451400b4b4da5a002929692988296929690c5a2928a602d1494b4804a28a280168a4a5a6014b4945002d2514b40094b494b40094b4945002d145140051451400514b450014b4da7500145145002d145140828a29681851494b400b4b494a29005145140052514b401e29f663498912aee294f3daa2e76f294c4e7bd4d1dc29a1e11511b7355a11ef1681a0b552ccab520b8a2c3e6273551179a9bcd06a1439a0965e14e34d14a4d41a8ea4dd46693ad310bd6945250280169338a5a05001cd2d203494c075385369c28245029f4da2801d8a5a4cd3b3408052d341a7d3190cf4da74f4c5ad11cec950d6fe93d2b05456ee9269320daa5a4a5a818ea70a653c50029a8cd4ae2a3340119a6548699400da4a5a28012acc5556ad434012d14b49400514525002d14945001452d253010d482a33520a621e290d2d06a8445451456630a28a2980514525030a5a292900b49452d002514514c41452d140c4a28a290094b451400519a28a004cd14514005251450014514940828a28a062514b4940828a28a061452d36800a51494b400fa4a5a28012968a2800a28a280128a28a04145145030a28a4a00c8d758085ab809315ddebe3f746b84735a2246e69a33416a5e95404ab8a70a6669c0d22c78a90544bf5a933f854d80986293785a84dc0aaece5a802df9d4a66c55105a9d926988b3f6ba8cde55660699b49aa0d49ccfe868fb566ab1534a050172512d4cb3d54029f9352068a4c6aca37bd65ac956525a459a1bc538495543d2efa065add485aabf9c697cca6493834a24a8438a697a0a2cf9d4a26acf927a689cd311b0b3e6a50f58cb758a9d2ee9125f614c65a816e3352090520065a6f3530a314c561ab52ad300a750221938ad4d15fe6aa0c2a7d2cfef45049d852d3569f599414514b4c02928a5a0028a4a5a0028a4a5a04145145030a5a4a5a042d25145030a28a281052d14500149452d001451450014514b4005252d25001452d140094b494b40094514b40094b494b400514514005145140051451400b45251400b45145030a28a28105145140052e692969805145148028a4a5a602d2514b400945145218b494b45001452514085a28a5a004a28a5a0625145140052d145300a28cd140c28a28a04145145002d2514b4005145140052d253a801b4b4b4b40828a4a2818b45028a005a2928a0028cd0292810fa5a4a5a4312968a28012969b4a6803c7c1a7669052d41e8094b494a28014d40d083530a0d2bb1150c38a623126ad9aaa9f7bdab4b99348bcb4a4d369f599a8dfa514a69b5448e14ecd3169d9a94501a4a096a4a621f4878a6f5a5a2e087528a6e29d4087d2d34134ea620cd3e994ecd0028a753734b4c4452d35696e299d2ad18489d0d6ee938ac28ab774a5a641b74b494b5980b4f14d14f1400ad51d4c6a13400d351d486a3340094945140095622aaf5661a00968a4a280168a4a2980b494514802968a4a6021a905474f14c43e834b486a8923a29296a0a16928a2900521a5a4a062d251450014628a2800a28a5a04251452503168a4a5a004a5a28a0028a292800a4a28a00292968a0028a28a004a28a2800a4a5a28012968a4a002929692800a5cd252d003e8a28a0029714945002d252d25001494b450025252d1400628a293140183e217db157084d767e26fba39ae31ab64891b8a725369c94864b4a01346da729c52b941951513cf4b2354148076ea7525381c51a00e03daa548a85ab0856a8087ecb4c687157c38a69db408ca2b4cabb2a8aa8eb8a40479029f4de29770a65683b9a994d434f15205812e2a5125551cd4ca29943fcc34e0f4ddb8a666a492432526fa889a899fde98ee3e439a4df516ea4cd5123bcca7acb5010b4de68b125f498d584baacc069eae6985cdc4b915604a0d614531ab6b706a6c3b9af4b8aab05c06ab7400c6a5b6cf9831c50e29b067cc14c476719c8a92a28ba0a96b30168a4a5a0028a5a4a005a2928a0028a28a042d145140c28a28a042d1451400514514005145140052d2514005145140052d252d001452d140c4a5a4a5a004a5a4a281051452d031296929681052514b40051494b4005145140c296928a0414514530168a28a0028a296800a2928a0029692968012968a4a005a28a280169b4ea4a40145145318b494b4940053a9b4b40828a29290c5a28cd2d30128a28a005a2928a4014b494b4c028a28a0028a28a002968a2810b49453c503128a290d002d14525003851499a05003a86a28340094b494b400b4b4da5148029453696980b494d34b408f2118a5a68a5359687a4252ad20a334122d2d1498a422393a5558f00d5992ab47c9ad110cbf9a5a6629f9a935169a68cd2502014e5a4a5a601494b9a290b40a00a4a5a603a85a6e4d28614124ab4b4d14b9a431453a9b4ea62169c0d32969888e7a8ea498d475713064d1574fa601b6b98879ae9f4bfbb4320d3a5a296a00752d369f40c79a84d4cc2a1340869a8cd3cd466800a4a293340054f15415622a00968a296800a4a292800a5a29714005251450025482a3a70aa112d21a51486a84454b494541414b4514804a28a4a005a29296800a28a4a042d1494b4005145250014b494b40051494500145145030a4a5a4a0414514503128a5a2800a4a28a0028a292801692968a004a4a5a4a00296928a009168a052d020a4a5a281851451400da2968a004a29692810b49452503395f140e07f8571cc715d8789bf86b9196b6448dc5491ad458c54f1ae6a58c939a66ea94d577348a184d267da85a4c9f6a0a14669d81dea02d8a699a98b42d79b4ab331aaaac299e71fff005501746a0ff7a9a77ff7ab3bcf63c66937c9ead4ec4dcb4f23542d2e7d68114b8eb51ee3405c7efa07d6a3a72a9ef40913d48b4c435320a4684c8b9ab91439a8a25ad28221486573055392002b75e1c0acab85a09466918a89b3533022a07aa0194e14ca92a8963b666a65b527da96222ad24a29010fd84d27d95eb49265a716434ae0657978a916ad4918aac571401246c56b5ade40c2b1456859c9408d0614b64332514fb05ccb5207569d29f4c5a75400b4b4514c028a28a0028a28a042d25145030a28a5a0028a28a0414514503168a28a0028a28a041451450014514b4c028a28a4014b494503168a292810668a5a4a005a4a5a280128a296800a292968012968a4a005a28a2800a28a2800a28a298052d252d00145149480752514530168a4a2900b494b45300a28a28185252d140828a28a4014514530168a28a4014514531852d251400514514005252d140052d251408296928a062d2514b400a28a28a04385142d19a0029296929805028a5a430a28c51400b4b4d14b4000a71a402971400940a5a5a004a4c52d068013ad3a9283401e3f43528a4ac8f444c52ad253a8b80b4868e2971f8d1a08824e955a3eb56a51f2d568bad5a3165e0696929db6a6c6a2669b4fa4a00052d2514085cd253a8a004a3345145c02940a4c1a5c9a448f02969053b3414038a71a40682d4c914549518a75022197ad2512f34018ad4e764d10ae9f4c3f2d6040808ae834de9489d0d114b452d480e14f14ca72d004925406a796a03400ca6d38d32801b451450036acc355b15622a009e8a4a2800a29296980b452668a401452d2500253c530d3c55089290d2d21aa248a8a4a5accb16928a2800a28a2800a28a2800a4a28a005a2928a0028a5a4a0414b4945030a28a5a00293345250216929692800a4a296800a4a5a280128a5a4a061494b4940828a28a0614514868016929692802414b9a4028a0414514b40c296929680129b4ea4a002928a2801334df317d6b1355d6fc8f957ad736fa9ccc7fd6499ff007cff008d3e511b3e24fba0ff005ae35eb52e2fee655da5b23dff00fd7598d5a00dce6aea2002aa46b93577a52632192a1e0d39b2693b505116698c48a976d1e552b8150e45479357bcaf6a8de3ab2422506992c5b2a4418a94aeea90b19e71522834e6b46cd4b15bb2d68497e14016ab4b6dbba0a9f79a4cd66558a223f2fe95294c8a9de3cd461291561156aca2d4612a745a4522c44b8ad6b4c566c6b5af68828068b53a7cb5852735d0cdf76b0a64a6c9465c8b542406b59d6a8bc59342132a734e08477a91cedf4a5589a4ad04247f5ab71ac67f8aa8989d2a512211fdd6fad3b117350dae47c8f55da5913ad505be9d3f88d595bd1275148b2c2dceea9b01ab3dd71d2a6866acc0971535b75a61152c039a6235c74ab1a6a664aaabd2b47474c93480df14ea4a5a80168a4a5a60145145002d145140828a296800a29296800a28a2800a31451400b4519a2800a28a2800a28cd1400b45251400b49451400b45252d00145149400b451450014b499a281851452502168a28a0028a5a280128a5a2800a28a2800a5a4a2800a5a4a5a6014514940052d149400b4514500145145002d25145002d14525002d1452503168a28a002969296810519a292818b4b9a6d2d020a2929690c28a28a60145145020a2928a002968a5a0614b499a5140872d26294d373400b453a91a818868a28a005cd2d340a75001494f14da005a75262931400ea29294d201293ad1482980e1453aa33401e45c52669294d647a361314ab498a55cd00069d494b408827aaf175ab128355a31cd59932f8e69c2980d2e2a0d07521a38a4a2c021a75369d9a630cd0285a5a4212968cd145805a55a4cd19a64d8753e994b405c514b4da5a0914549cd3053a98114dd69b4b29e68ad0c197ad4d7436038ae7ad46eae8ec9714320bd4ea6d28a801d4f14ca75004925426a46a8cd0030d329d4da004a6d3a9b9a004ab10d415621140135252d1400da28a2800a75251400b49451400da9169869e2a84494869690d5088a8a4a5acc61451450014945140c2968a280128a5a4a042d252d25030a28a28105145140c28a28a0028a28a004a28a28105252d140052514b4009452d25001494b4940051452d03128c514500145145003c52d145020a28a2800a29692800a4a5a4a002abddcfe5293562b03c4373b23c7f5a00e46f2e9a6627bd56f3714ac3bd46066b5027520d4522d03e5a93752184229cc6957814c34808f39a4029e169719a57290ddb4a054a16a411503b15f15132e6af7914cfb35228a1e59a7aef1573ecd47d98d5904346dab0b6a6a71698eb4ae2296ca9445573c9514ddb45c7ca532b9a045568ae05424e2a4a23e6a4031494feb40ec598eb56dab25056ada1a0a65b98f158f3735b13f4ac7945532114d8556962357996a2db9a91999f67f5e6acc785ab3e40a615c75156677295d550ad57547159ed0915640d03deac884e2991438ab61f6d20d4acb215e09a4ce0d2323139a705f5a405d8e4dd5720acb858ad68c0690cd646e2b6747e9d2b0e2e6ba5d362da94846852d252d48c5a28a2800a5a4a2810b45149400b45252d0014b4945001451450014b494b40051451480296929698c28a28c5020a28a2800a29692800a28a28016928a280168a29280168a28a004a2968a0028a2968012968a4a6014b4945002d1451486145145310514518a0028a28a00296931450014b494b400514b49400514b4940051451400b4519a281851451408296929681852514502168a4a5a002928a5a0028a28a061452d2500145145001451450014b4945003e928145003a905252d31052d0282690c28a4a514c43e928a2900ea0d252d21852d251400d6a5145274a603ea334ea68a00f205a5a5a43591de2528a6d38522c5a29b4b41245337155a23cd4f38c8aad0e735664cbf4ea6ad3b1506a2e29bd29d494c06d385262939a403a9281cd2e2a8428a753053a900b45252834f510e14b499a5cd201714b4829682470a29053a9810cbd6806925eb42e6b43999a36439ae92d6b9eb1ae8adba50c92d52d253aa400548b4cc528a00924a8a9e6a33400d34ca71a650026690d2d250015622aaf5622a0094514525001451450014b4945002d145140098a78a653c5508929ad4ea691544915145159942d14525002d1494b40c4a5a4a2800a2969281052d252d03128a28a04145145030a28a2800a4a28a0414514500145149400b45251400514514005252d140052514500145145002514b45031e29681450212969296800a28a2800a4a5a2801b5c7f88e6cb62bb06ae235dff5b4d018bb69db00a75349ad00898546296492a388d032de78a8e95a99cd4021569eb510cd488714ca261522bd43bb35266a0a245a94544b8a9053289140a7714ccd2e698878005296069b4a282436531aa5a8de9810335576cd2bb50a940c754829bb6a403150512c75a96b59698ad5b3cd086589c7159720ad89578acb992a990546a674a988a858548137979a430834b13d4c45592664f65e9548875ed5d06dcd40f68ad57726c63893da97755e6b2a6fd93daa6e51084534f3699ab71d9ad4de4d0232fecd8ab512e2ae7940d33cac517116ed96bacb5185ae4612456bda6a8f9c35224dea5a6236ea7540c5a28a5a04145145301692968a004a5a4a280168a28a0028a296800a28a2800a28a2800cd145140052d1450014514500145145001452d25002d14525002d1451400525145002d14945002d14945021696928a0614b4525001452d1400514514c028a28a401451450014b494b4c028a4a5a40145145300a28a2800a28a281051452d030a4a5a2800a29296900b494514c028a28a0028a5a4a005a4a2968016928a2818b49451400b4945140051451400b494668a005a28a2801d4bc5251400526696971408753a928cd218ea28a290c4a69a53495420cd25149400ea4a39a2811e439a4e69451589e88de942e6929e185031314ea6e29698b52193a55787ad589ba55680734cc597e8cd0b4541b0ecd3696909aa244342d18cd2ad31899a7669b8a514c05e69c2994fc8a8016928a753105069066949a60c5ce29c29b40cd210f14ea68a5a64914bd69569b275a056a8e765a8642a6baab19372d72515759a78f9686497a968a5a80169d4d14f5a0057a8aa57a88d0030d329e6994009494b494005598aab5598e8024a4a28a04145145002d2514503168a28a004a78a653c5508929a69690d5124545145665052d2514005145140c296928a005a4a28a0028a28a04145145030a4a5a28012968a2800a4a5a4a0028a28a00292968a004a28a5a0436968a280128a28a0028a28a0028a28a004a2968a063c52d20a5a0414514500145145001451453012b8cf10261ebb3ae63c45177a680e682d40c71567a0aaceb9aa60573cd48b1014aabcd3a8188d51d48f55e90126696a2cd28a0d098494ff36abeea5dc6a445b592a50f55054e1e802c034fa850d4f4c6396a414ca52c16810a5aabc8f4492d5479a980fe1aa78e3aab1b0ab91c95259294a8ea62eb551e651480b518ad1b67db59305c2d5bfb42d3037320d529905544d4295aef35440d31d40eb5389450d1e6a40ae95690e6aa32eca9237aa02c1e29053734b9c5310aca0d3768a42d4bbaa443b18a5a4c8a4cd22876696a3a706a6431eb5585d9f3368ab22a9c11eeb915407716bf70558a8e218152d6620a5a4a5a6014b494b40094514b40094b494b40828a4a5a00296928a0028a28a005a29296800a5a4a281852d2514085a28a2800a28a4a0075149450014514b40094b4945001451450014b49450014b4519a0028a29680131452d25002d1494b400514514005145140051452d00252d25140051452d300a4a5a2800a28a2800a28a2800a28a2800a2969280168a28a0028a28a005a4a28a005a4a5a4a005a28a28189452d26281052d252d001451453185252d252017145145002d14945002d2d252d300a7d345385210e14114527340c5a2908cd262810ea6d3a9940c2969b4b9a620dd452d2a9a433c7b9a334ee2822b13d0100a4c5251400a29e053452d170219aab43d6accb55e2eb5a23365de696928a8341d4ce69c0525020a052528a6317751494a690829c29b4b9a2c21d9a5a4a5ce6980b9a5a4a4a007e28a4cd2d048b4ec1a40453a8195e6eb494b21e6815a239992c479aec2c7eed7231e09e2baeb0fb82864176971494ea901453c5329e28006a8cd4d2543400c34c34f34ca004a4a5a6d002d588eabe6ac474c07d2d2514805a28a2800a28a28016929692800a78a653c5512494d34ea6b55088a8a4a5accb0a28a2810514525030a5a4a5a0028a28a004a5a28a041451450312968a2801296928a0028a28a0028a28a002928a5a04145251400514514009452d140094514500145149400b9a29296818f14b40a3140828a296800a292968185252d25300ae7fc403e5ae82b075e1f253423916a83ad4e4d40d5a00300b519a9f66fa8192a4a02d55ea7d95035021b9a76ea6734d1f5a450fa942d439a901a009d6a5aae1aa5de29328b2a71567359ead53c72134c0b351bbfad1e65412499a43b0d66cd40c454a16aacf914c449bb147daeaaeea818d2b05cd037d51f9f9acd2e4d224f5762548d58e5ab22e8d65c6f53efa8b1a17d6e69ff0069f7acbf300a469beb4589b9ac9795762baf7ae692e2adc775ef401bd261c5578db14c86e73516fc3502b1a2ae2a4cd5449054e0d31d818533352e6986992377e28df4d6a66690c9f75394d41ba9ea69105ba658213714a86934e6ff0048a623b65a753569d5002d1451400b45145310514519a00296928a005a29296800a28a2800a31452d001451450014514500145145002d145250014b494530168a28a40145145020a5a4a281852d2514c028a29680128a29690051494b4c02969b4b40052d2514805a28a5a6026296929680128a28a401451450014b494b4c028a28a00292968a0028a29280168a28a0028a5c5140094b451400514514005145140051451400b4514503128a5a4a620a5a28a430a31494b40828a28a061494b49400b4b4945002d1494b400e14e14da29889a92901a75414368a5a69aa10b9a6669c6931400ca5a5c50698086901c52d250079229a69a5147358d8f446814ea414b9a00519a2933452110cbd2abc1d6ac4d9aaf0119ad0c597734ea6d3b8a966a19a4a5a654821d4504514c029734868a0051462928cd003e9d4ca514c05e28a29682751d45251408902d3a9ab9a5e681913f5a4a1fad26456a72b2785726bb0b2185ae420aebecbeed26496e9d494b5202d3c5329eb40031a8cd48f5150036994ea69a004a4a5a4a00315623aaf5623a6049494b494802969296810b4945140052d252d0312a4151d482a843e9ad4ea635512454b49456658b4514502128a5a281851494502168a28a06145149408296928a0028a28a0614514502169b4b49400b4514503128a5a4a005a4a28a0028a28a0028a28a042514b4503128a292810b4525140c9169d4d5a71a04252d251400b45252d0312968a2810958fad45ba3ad8aab791798a6981e7ae94d2b56ee23dad8aae456805562cbd2a22cc7ad5a63559e91422d44d52e6abbe7b5225b137d267da8c500505dc4e94fcd464e7ad3c1aa025cd2ab54742b1a92916c54ea6a9efa9d5e905c9b34c346ecd3d52818006a8dd0615a3556419a649965bdea266ab125a9cf7a6fd92a85a95b1522c58ed56d6d854c910a3982c67aa9a5f33d6adcd6c3b553f28d3ba02427dea0cfae6a4e94cc51a0868dd9f6ab4b55c54cabef4988d0826356fad56b4b526ae3c748bb88ad8ab28f550362a75714865a1499a877d3b7d201f4cdb46fa5e299236a414d342b0a44dcb294eb13fbda629ab1a745ba4aa11d8274a7d3169d5980b4b4945003a928a5a601494b450212968a2800a5a4a280168a4a5a005a2928a4014514530168a28a0028a28a005a2928a005a2928a005a28a2800a28a2800a28a2800a28a2800a28a2800a28a281052d25140c29692969805145148029734945002d14514c028a4a5a40145145300a28a280168a4a2900b452514c02968a2900b494b453185253a9b40828a296800a28a2800a5a4a2800a3345140051451400b4945140c28a29714084a28a2800a28a2800a5a4a2800a5a6d2e6818ea29296801dba814da5a622514ea8853b34863b345369d4806528a09a6eea6039a8229a69726801bd28a5ce690d007915379a70349591e807e340a6914aa69d862d1d28a2a464339e2abc279ab13d41175ad0c997b3474a418a5acc628a4c0a5ce293340c28e28a6d08071a3f0a4a519a0028a4c9a5e6a863a9d4da754922d1494a29d843a93341a4a604aa69d4c5a7a8a6495dc7349c53a4eb495a239996200d9aec6d3eed72509c9aeb6d3eed0c459a5a6d3aa00753d69829c28015aa2a91aa3a0069a61a71a6d00253696928016ac4755aacc62801f451450014514b40051451408296928a0625482a3a9055123e90d2d2355888a8a4a5ac8b0a4a5a4a00296929680129294d25021696928a00296928a005a334945002d2514b40c4a28a5a042514525002d145140c29296928016928a2800a28a2810518a28a0625145140828a292800a28a2802402968149400b494b45001451466800a2969334005230cd2d1401c86b767b0e40ac335dfded925c2e2b8bbed366b73f76b443286da81c0a949c5444d3023a889a9b654120a90630f34d2697a5368280026900a534de68d4926c8a5079a68a72d234270053ba544a4d3e802cad4c2aaa93536ec5316a0cf519a6b36699be900e229bb69375349a60398d343536940abb00ecd37cb0d4e55cd4bb691253310a8b6d68793513454c5cc57f233e953436a73562386aec710a928b30c6aa299262a55a6bad1711448a0353dd6a11c54944dba9c1aa1cd140cb01853eab8a9d69903e9b4a734462990594e95aba420dd591bfb5741a3c5de819b94b8a4a5acc05a28a5a0028a28a60145145021696928cd0014514b400945145002d1494b40051451400514b49400b45149400b4b4945002d252d25002d14669280168a4a5a0028a4a5a60145145201296928a042d145140c28a4a5a620a28a29005145140c5a5a4a2801692968a0028a28a0028a28a6018a28cd140052d25140052d252d0014514500145145002d25145002d25145200a5a4a2980b45145020a28a281851451400514518a0028a28a630a28a290829714945030e9451450014514b40051451400ea29b4f3408514b9a68145318fcd2e6a3a5a40149494530168a4a70e6801a28a4a70a40790a8a2928dd591e901a4a28c502168cd19a314c08a7e45410f5a9e7e955edce0d33165fcd3a994ad9accd45eb4d34a05253186693a529a0d310b4828a290877e34869b4ea6171727da9d4ca7d03168c5028a6216978a434669124b4f14da5a622b4bf7a8e94b20e685ad4e565bb71cd75d69f76b9281abadb6fbb4988b34b4945480fa7d30538500235329e698680194da753680129296928012ad46dc556ab2838a043a92968a0614514b400945145002d14525020a90547522d5087d21a7530d5088a969296b32c4a296928016928a28105145140051494b40052d25140c296928a0028a28a0028a28a0028a292810b45145001494b4940c28a28a00292969281051452d002514b49400514525001451450048b4b48296801334b4945003a928a3340c296928a042d2514500151bc08ff78035252d3030ee3c3167274ca7d2a14f0959afdedcff00538fe55bf451763384d63495b43f27ddae7a415def886db7479f4f6ae165a7a81598547d2a46e6a335602fe3486a3a729a0a24e94e5269b4f14863ea71815053f7d02250c297cca8f34d66a350b92134ca6e69375315c706c51834e45a9d42d202310e6a716e28f3529fe6d08b17ecb8a5f229c928a9fcc4a6491adbd2359d49f6aa5138a622bf978353a1a79daf511522908b21a918d56129a7eea9b05c6c8b551aad920d579568288c1340cd2126941cd301ead53c66ab5598e824958d3a214ca9e3c504889164d75da643b52b9db5877b62baf85360a4c092969296a062d14514c02968a2810b49452d00145145001451450014514b4804a2968a601494b45001452d14804a28a298052d14500145145002d2514b40094b494b4c0292968a401451450014b494b400514945002d14525002d145140051494b40051494b4c028a5a4a4014b4525002d1494b4c0314514500145145200a28a2980b45251400b49452d200a28a2980b45251400514b450014514500145145301692928a402d145140051452d031296928a041452d25030a28a281094b494b40052d145318b4514ea004a752525003a9b4bba92810629714668dd40c2928a4a005a7ae29b4b480f20a4a5cd15ce7a03692949a660d6886494bcd3714edd486417238a820c54d7038a8a0eb5660cb94fc9f4a6a9a75646a029a4528a4a0008a4a752550c4c0a29d45048da5a4e296801569f4d5a5a02c2d3853696801452d2528a044b4b4ca70a6490499cd27cd448df3519ad4e565a80ae6bafb5fbb5c7dbf515d8dafdda4c458a51494ea801d4e14d14ea6034d329e4d32801b4da5a4a006d14b4da005ab0955aacad003a8a5a4a005a4a296800a28a2801692968a0436a51515482a84494d6a7535aa8445451456658514b494085a4a5a4a0028a28a06252d252d020c5141a28185145140828a28a06145145020a4a5a2800a4a5a4a0028a28a0028a28a062514b4940828a5a4a0614514500145252d00252d25140891694d20a5a002929692800a28a5a0028a4a5a005a4a292980b4514b4806d253a9b4019bac26617fa579bca724e2bd37505dd19af38ba4da4d52033f18a4eb5235475431a569b4fcd37348a1c0d2d3569f48078fce9f9a8e93766ac0937d1bb35192c6a3dd8a6225634e1557cecd2f9f40bdd2e0976d0d73553cea6ee346832d896a41706a98dcd41dd4ac5973ed55379fef59caded4bb8d33345ef371dea4f3eb3fcc6a5f31a803496e6aec7383d6b155cd4c26c522ac69b8a8f7546971ba90bd2249339a6b6714d0e29fba80b95d81a054a6a3c5003c0a9c13512549408956a78bad3ecec5ae0e0574769a04517de3b8fd29085d32c76fcc456c5354629d523168a28a4014b494b4c414b494b40052d251400b45252e6800a28a2800a5a4a5a0028a28a0028a28a0028a29680128a5a290828a28a630a28a2800a2968a004a5a292810b494b45001494b4940c5a2929680168a4a28016928a280168a28a004a5a4a5a0028a28a0028a28a0028a28a0028a28a042d1494531852d145001451450014b49450014b4514804a5a28a0028a28a602d25145002d2514b400514525002d145140c28a4a2810b4b4da5a002969292818ea4a28a005a4a28a0028a28a002969296800a5a4a5a005a09a4a2800a28a298828a4a2818b452668a005cd25149480f25a4269c69b8ac4f404a314b4da062934bd68c52d00413938a82006a69f9151424e79ad0c997052e68cd04549a85140a4a448514514861452528a6018146052f34868247ad2d35453a8186694514a2810629d8a6f34f5a603e969b9a7d022a49f7a8a56e1a8e2b647232cdaf5aecedbeed7196ff007857676df7694844f4fa653aa00753a9a2968010d47521a6500329b4ea6d0025252d2500255b5aa95692801d451450014b494b40828a4a5a0614b494b4086d4a2a2a96ad089298d4ea6b55088a8a4a5ac8a0a28a4a062d14514005145140094514b4084a29734500149451400b45252d0312968a28105145140c4a28a28105145140c4a5a2928016928a2800a28a2810b4945140c292968a004a28a4a009452d3452d020a28a2800a5a4a5a004a29296818b4519a4a042d2d369680129296928021b81f2d79c6a4bb5cd7a549d2bcf75b5d923552030ea3c53dcd47cd6831b9f6a4e697069b8a90b0a3e94bba99ba857f5a064d9a4a67346ea76017762a36c9a5a72d3115886f4a4f98d5dc7d28f2c7a5170d0ae911357e1b5a9638453c9dbd05174522d45a7c55646911b76aa915d11d6b4a2bb53de91a5c84e83ed55868dcd6bfdaf6f7a5fb42f5a6174660d0fdaa37d148adafb70a85ee8501739b96ce58aab1908ae99d55bb566dce9f9e9419b33966a905c533ec72d345b1155a105d439ab0b5463c8eb5751aa043da936914feb4aa290c00142ae4d29a9ace32ec281e874da25a6066b77155ace2d882acd4085a28a5a4019a29296810b45252d300a5a4a280168a4a5a0028a296800a28a2800a28a5a0028a28a40145145030a5a4a5a62128a28a005a4a5a2800a28a2800a28a2800a28a298828a5a290c4a2969280168a28a00296928a0028a28a60145145020a5a4a5a430a292945300a28a5a006d3a928a4014514530168a4a5a40145252d00252d251400ea4a4a5a0028a4a5a601452d1c50014514500145145002d251450014b494b40051494b40c4a5a29281051452d0014629296800a2928a005a5a4a281852d145020a29692818519a4a5a005a2928a00766834da29885a4a296818da29d462801b4b41a2901e4b4da5a4c5627a21494868a7a00f268a334940104c2abdb93e956263c5436c79ab322f0a33494b9ac8d6c2d252d25300a4a534da0429a292969e82171498a534503169d4ca78a042d3aa31520a601cd381a61a5028b104d49452d005590e1a9569651cd20c0ad8e5659b6fbe2bb4b71f2d71f68bf38aeca1fbb52c44b4b4da7548c752e29052d021b4c34fa6d00329a69d4da004a4a752500255a5e9556acad003a8a28a00296928a002968a2800a5a4a28105482a2a9455887d31a9f4d6a6222a29296b32c5a4a29280168a28a0028a28a004a2969281051452d03128a28a042d25145002d2514500145145030a28a2801296929681094b4945030a4a5a281052514b4005252d2500145145030a4a28a04482969051400b49452d0014514500145145031296928a043a8a29280169b8a75250030d70fe228407cf15dc9ae3bc4a9cd3423902b51138a9df350e7d6b568698c2f518fad3b9a6f6e948771d4948293a501763d5e96983de9438a6085a7a530f14668192b5264d19ff002686f5a43251758a93cecd5224d254d81b34379a9527db59be715a5fb4fad32b98da5ba1527da876ac35b9a70bcaab13cc6c1973de812564add1a97ed3e9405cd94985065158e2eaa5123d48ae5d620d55914d381a1a988ae2aca5418a7ad5125bfa53a9a29cc2a40666b7345b7dcd9ac545cd75da2db6d5cd2606d8a753696b318b451450014b4945021696928a602d2e6928a062d2514b40828a28a005a28a280168a29280168a4a2900b45145300a28a2800a28a2800a5a4a280168a28a00296928a005a2928a005a4a296800a28a2800a28a4a005a28cd140051452d001494b494c028a28a4014b452530168a28a430a28a298828a28a4014514500145145300a28a2810514b45218514514c028a28a005a28a4cd002e292969280168a28a002969296800a4a28a005a4a5a4a0028a28a0028a28a0028a28a062d251450014ecd3696810b9a2928a005a2928a602e692968a430a28a5a004a5c5145300a4a29c31400ca29c4536803c9290d14671581e809494eeb4948071a43452d50caf39e2a380d3ae00a65b62acc8b94ee69a29d599a85069f8a6d304368c53b14d19a401b714b4869682581a4c529e692818a29d482970681053e9b4bf8531053929b522d1701e0d033498a514845795ceea4229646c9a2b739597ac7ef5763174ae3b4f1f30aeca3e949923e9d494b5231c2969b525022334c34f34da0061a6d29a4a004a3349450028ab2b5585591400b451466800a28a2800a5a28a6014514500254a2a1ef528a6492531a9f4c6aa022a28a2b3285a4a5a4a0414b45140c4a5a28a0414514940051494b4005145140051494b4005145140c28a292810b4945140051451400514525002d2514b40094514500145145031296928a04145145003e9681450014514503168a4a5a002929692810b494b49400b4518a2800a28a2980d35cb789874aea6b99f120f968038893355cd5a912ab735a8889a9bbea47c5438a650ea6efa7939a67e148029dcfb0a29314807d14cfc69cb40c9569718ef4da5352302b4cc5482838154845665a65586514c0b5771117e94f5c53b653f14c43054aab42af35388e80e51152ad8a622d2d6432706838a877d381a602d28a68c54d8cd2249d315148d52138a8a319a606869f6ed2b8aeee08422d60e87a76cf9aba2a863168a4a2a407525145003a8a4a5a002968a298829296968012968a290052d2514c05a28a2900b494945002d14514c42d14945031692968a0028a28a005a4a28a042d1494503168a28a0031452d140051451400514514c028a28a004a5a4a5a4018a28a280168a28a601494b45200a28a4a005a28a298094b4514804a5a28a04145145030a28a298051494b40051451480296928a602d25145021692969290c5a28a2980b45149400b45149400b4514500145145218514514c4145251400b451450312968a2900b45252d3012971452d02128a5a2800a28a05030a2968a6025145140051494b400b4da5a43480f225a5c5228f5a70ac0f46c2114dcd3e994c05069d499a775a00a9706996d525c66a2b6ad0c5978628a414b517361e6928a4353701b45293466988314bc519a28011850294d20cd002e69e2a3a7014c9169d494fc5218da72d36a4aa10a69c29b4e14c4566eb4b4d7eb4eab472b2fe9f9cd761174ae3f4fe5857631f4a1903e9f4ca754143a9d4d14f14c430d329c699400c34da751400da4a5a6d0028ab22aad5b140052d145001451450014b4945300a296929086f7a98543530ab10fa6b53a9ad54221a75251591614b452500145145020a28a2800a28a2800a4a5a280129692968012968a2800a2928a0028a28a0028a28a061494b4940828a28a005a4a28a0614945140828a28a0028a29280168a4a5a063c52d20a5a04252d252d00145145001494b49400ea4a4a5a005a29297340051452134c00d731e236f96af6a1abf93d2b97bebf7b8ea6ab9588c5985542b575f9f7aaadc55815f7e7b53714e34ddd4c2e3cd439a92994b428514ea66e02814c07ed34aa314829e2a4029e38a6d2e2985c7eda6e29c0528a455c4da0d34254f8a7eda622a95c74a5f2f77ad58d95208ea8440b0d4e13353a46297cba8b822100d3b03daa6099f6a66ca02c5638a72b1a791ed4c514c91fd6ad2546ab52918a43187ad69e97a799dbdaa8416cf3360035dce9da7adbaf4e6a40b91441054b4515002d14b450014b494b40052d1450014668a298053a928a042d14525002d2d251400b45252d200a28a2800c514514c05a4a28a002968a2800a28a2800a28a2800a28a280168a29280168a4a31400b45145001452d25300a28a280168cd2514805a28a298051494b4085a33494b40c28a28a0028a28a0028a28a0028a28a40145145300a28a4a402d1452d30128a28a005a2929690094b4945300a5a28a0028a296800a4a5a4a402d1494b4c028a28a0028a28a061494b45020a28a2800a28a4a005a28a2800c51451400b4ea66696818ea4a33450014b4945002d149450014b8a4a2980514529a06368a5a31484790d1d29451589e90669bcd2e6938a043853a9a334b9a43209ea2b7a927e9d6a3b635a1916f9a752502b3341d4d34fcd4679a620a2940a4a005a2998a7e6980b4ddd4b9a4e2908753a9b4b4c07538536969085a72d25380a0070a4cd2d19a64954e734fa6b75a70adce591a5a7f5aeb63e95c9e9fd6bac8fa54b211253a9b4ea928752d252d00369a69d4c3400da6d2d36800a4c52d250002aca8aac2ad0a005a28a2800a4a28a005a2929681051452d301bdea5150f7a9855012546d4fcd35aa8922a29296b22828a5a4a0028a29281852d252d0212968a4a005a4a28a06145145020a5a4a5a062514b494005145250216928a280168a4a2800a28a281894b4514084a29692800a28a281894b45140094b494500494b499a28105145140052d25140c5a4a28cd020a5a4a5a005c5252d253016a299f02a4aa52c99a6908cad46dbcc435cab2edaede6e4571d7800735a90673d556156daa165a0b2a1a81bad5b2a2a17414ca21cd29a69c76a697a90b8b4fc9a8f34ec9a621e09a70cd4352669148969d9a8b346690b42515329155c353f7d0059db4ef30556f38d395e9813e69e8f55f814a314c0b7bcd4e08aa0b2115307cd1626e5aeb51d206cd0cf40c8da954505b34aa69013203522234ad802920cbf02ba8d2f4411fccc39a9112e97a32c3c9eb5b74018a5a82828a5a4a4216968a2800a5a4a280168cd14502168a28a630a5a4a5a0414b4945002d145148029693145300a5a4c514805a5a4a2800a5a4a29885a2929681851494b8a004a5a28a04145145030a5a4a280168a4a5a041494b494c62d1452d201296928a0028a28a60145145002d2514b400514514005145148414b452531852d1494805a4a29714c4145145030a28a4a005a28a2800a28a2800a5a4a280168a4a5a0028a28a0028a28a005a4a5a4a00296929690051494530168a4a280168a28a0614514500145251400b451450216928a4a0075145140c5a2928a0028a28a6014b4945002d2668a290052e69b4b9a005a4cd149401e47452506b03d1171498a7525002d045141a02e56b91914db5c53ee0e2996d5a99685ba534504d666a3a9b4bd69b8a4018a08c77a334bc1a0068e2978a61a5aa10ea28a7500029c29a6945021d4b4da70e69001a7ad34d385301f4828c5396913629bf5a7a9cd35fad3856e8e4669d801b85759174ae4f4ce5abad8c7149928929c29b4ea918ea2929dc500329a69e699400da6d2d250036929d4940082ad8aaa2ac8a005a28a28105145140c2968a4a042d14525031bdeac0aafdea715621f4c6a7d31a992454a29b4b59942d145140051494503168a4a4a043a928a2800a28a2818514514005145140051494b4082928a2800a28a2800a2928a062d145140094b49494085a2928a005a4a28a06145145020a28a5a063a96905140052d145021296928a005a28a28185252d25021d4c69157ad53bfd560b45cb9fc2b8dbed72e2f0f52a9fdd06ad44573b13aac0c76ab6efa537358fa441b5335a85aac919713002b8ebc7fde1aea445e71e7a5656afa505f9d3f2ab20c0a89b9a94d215a966a55615130cd59916a220d016293002a2dbeb571d6ab95c550c8cd0a734b814d1cd480f1f5a43f5a450b4a571ef4ec31734034dc53b8a910fde053c1aaf4edc684325e6a4dfe950f34bd0d31b2c6fa764e2abf34f4dd4c927534e47a8734f434c9b17a37a6e7355c353fde8b0ae4b5205a6237ad49bb353a81b5a1da877cd766a315ce78760c0cd74d58b34168a4a29085a28a280168a4a5a005a28a28016969b4b4085a28a4a007514da5a602d1494b40051451400b45252d0014b494520168a3145300a28a281052d252d030cd2e69b4b40c28a4a28245a2929681852d252d00252d2514c05a2928a402d14949400b45145300a5cd1494805a28a4a602d14514842d1494b40c28a28a620a28a290c5a28a280128a5a298094b452500145145002d14514805a4a28a601452d250014b4945002d1494b400514514005145140051494b400b49451400514514005145140c28a28a402d2514b4c02928a280168a4a5a0028a4a5a005a292968016928a2800a31452d002514525002d2514b4005252d1401e4545252d627a429a6d3a9bf8d301734a49a6e69e48a422adce29b6c334e9e996a39eb55a98976929714541b8b494a6928b9225141a38aa18da297145020a5a33482900f1499a514b814c05c8a5a4c514842d3c66a3a945310b9a93351e29f408a6dd6941a6b0e69eb5ba3919b3a60e6ba94ae574c3cd756b4a44a169f4d14ea818b452d1400da6d3a9a6801845369d4da004a4a5a4a00055aaaab5685002d14525003a928a5a004a28a2810b4514940c6f7a9c541dea715648fa6b53a98d4c08a8a4a2b318b45145002d25145030a2928a00296928a0414b4945002d149450014b4945001451450316928a2800a4a5a4a041451450316928a4a0414514500145145030a28a28105266969281852d252e2801f4514500145145002d2514b4009451494085aa37fa84768849a7dddfc36cb96602b85d57577bd6ee17d3354a222b5f6a93dd3e5a996c85daaad6ce936f9e6ba0cec7476246d029d33f6aa96f3795d6ad44bbce690cb3126d152344ae3079a053c5481ca6a7a398f94e958ad5e87244ae39ae5b54d18c7f328e2aae59cfb53335330351eda9190b2d5771569aa26a00a641cd34d5978feb5032d50c8e90b1ef4b499a090cd380a693c5379145ca26e941a87753bccfad004b934a2a3f3053838a043f26a5573507cd5283544dc92a455a8866a718ff00eb5049271522d3360a9c5201a56a4854d156215e6908ed345876c75af5474dff0056bc62af5739a8514514805a28a2800a5a4a5a005a28a280168a28a6014519a280168a28a005a2928cd0216969b4b40051451400b45145002d145140051451400519a29280168a4a5a04145145030a5a28a6014b4945200a28a2980b494514005253a8a004a28a280168a28a0028c5252d020a29296818514514805a28a298051494502168a28a061451452016928a2980628a28a0028a5a29005252d2530168a29290052d1494c05a29296800a28a2818514514082969296818514514005145140051451484145145318514514005252d140051451400b4526297140099a5a28a0028cd145002f1452514c05a334945200a33451400525145023c8e940a4c528ac0f485069b4e38a653014669f4da0d2b0caf71d2a3b5a96e07151daad6a645da5c536949ac6c6819a4a534daa180c9a5349d297340829bd2968a042629d8a4229dc5318b9c53a98297a521126693069052d310a69d4da7a9a402e6a4a8e9f544951bad2f5a490f3429ad8e466de98a2ba74ae534f2722bab4e94a44224a75329e2a0a169d4da28012994ea4a0065369c69b400949451400b8ab22ab0ab02801d451450014514500145252d00145145021bdea7155fbd4e2a843e9ad4ea6355088a969b4eacca0a28a4a0028a28a06145145020a29296818514514005145140828a28a061451494085a4a28a061451450014525140828a29280168a28a0028a4a5a06145149400b494525002e6969b45004b494b4940052d149400b451499a0419ac7d535d8ad781867f4a8b58f10c56bf2ae19eb879eee494e58e4d5a892d966eb509ee0e5df354f3f8d30b53726b501735d168ac2b9add9ad4d36eb1c5322e6e5c1f9ab62df18acc16fb973dea7b49f6f06981a829d4d069d5030a6ba061834fa63b814c0e5f55d1b67cd18fc2b9e21abb398b4e7dab2b51d11b1b945502673a698454cc8454748d081aa2c62ac31aaec0d022bc829a54f6a9daa32314c2c454a6976e7bd2115031b4ecd228cf534bb298c318ed4a28cd20a68448334f5cd32a514c44a8d5613155a3ab0a2a892c8a7f4a48ea5a810b576d63cb555519ad2b14f98500767663e4153d36dbeed3eb16520a28a2a0a168a4a5a002968a4a00752d2525003a8a4a280168a28a6014b494b4841452514c07514da5a002968a4a00751494b4006696928a007525252d00145145002d14945002d149450014b494b40051451400668a28a601494b4940052e69314b400514945002d14525002d145140052d145002d25145200a5a4a2980b45145200a28a4a00296928a005a28a33400514514c028a29280168a4a5a0028a28a005a28a4a005a28a2800a33452d00252d251400b494514861452e69298052d145020a28a28185145148028a4a5a0028a4a5a60145145200a5a4a5a6014514500145145001451450014514b40094514500251451408f23c52ad329f9ac4f48424d19a28c5030cd2b520a79c5022adc0e29b6cc29f3d476d56665ca33494b8accb16929714d2698c0d251474a603fa5329c6900e39a420a5eb494ee94000a5a414fa4c414aa690d381a60253f34da753247e69d9a6d2d022993cd2802987ad3c1add1c923674fea2bab4ae4b4e3cd7591f4a5225224a5a4a754142d29a414b400c34da5349400d34da5349400da2969b400e5ab35556ad500145145002d148296800a29296810514514c0677a9c5418e6a715403e98d4f34c34c922a5a6d2d6658b494b4502128a4a2800a5a6d2e6800a28a2818b45251400b45252d00145149400b49451400514514009452d25020a296928185145148414945140c296928a60145149400b4945140052d36968024a4a28a0029699bd7d6a19afa188659d40f734089da40bd6b9bd57c531479587e66f5cf1599abf88a4b9ca44c517d7bd60330ad540571f2cef21cb126ab9a539a666b43261c5286a41f9d25052419ab7a794590552a9629369a61a1ddc041150cf098ce4532c27dca2b48a87148912d6e4355d1582775bb56b41701c5368772c1205674f31978152dccfd852dbdbd30086db6d4ac99a9a92a00c4bbd0a19790369f615caddd84b6dc115e878acebcd3d261c8a655ce00e2a0ad5bdd3a4b76c1e9eb59de5d3190ba8a84d5961ef511148a21e29a454840a61534ac0331cd069c294b7b503101a5c518a70a621453d49a6e69c828113c60d5b882d408b532d04164353864d3054e05302455ad6d37ad65a9ae8b44b438dc6803a0b49b70a9aa3f2b6f2293cf5ce2b290d1252d252d645851451400b45252d02168cd252d03168a28a6014514502168a4a280168a28a005a28a281852d2514085a29296900b4b4da5cd30168a29280168a28a0028a28a0028a28a0028a28a602d1494b400525145020a28a5a06252d251400b4b4da5a0028a29680128a5a2900945145310b45145200a28a2818b45149400b452514c42d14945030a5a4a2900b494b45002514514c05a28a29005145140051494b4c0296929681851494502168a28a0028a28a0028a28a061452d25020a5a4a280168a4a280168a4a2818b41a4a2900514b494c05a28a4a402d2d2514c4145252d318b494514805a4a28a005a4a28a0028a292803c9285a653c5627a570eb48734e00d26298061a9d4da5a9d4456b8a6db669d714cb6cd59917696982973526a3e9845389a4a063129697146280d0753694d252240629c45301a775a63014fa8c53e824534ecd3734edb4c42d38547522ad210ea534628a6053ef4e5a6739a9539adce491ada72722bac4e95ca69ff007abaa5a4c84494ea653aa0a1c2969a296801a6994f34ca006d253a9b4009494b4da0072d59aac2acd00145252d001452d14005252d25002d14945021bdea7155fbd5815621d4c6a7d31a9888e8a4a5accb0a28a4a0033452d2502128a5a4a002968a2800a2928a062d1494b400b45251400b49494500145145020a28a28185149450014514500145149400514b494085a2929bbb140c75155a7d42de11f3baafe358b71e2db65ff56ace7d48c0ff001a2cc474248a864bd822fbf222ff00bce0571d71e23bc97f8bcbff0070d65bdc3c9d58b7d5b357c823b39fc57611f46673feca1acb9bc6531ff57120ff007d89fe55cc33d266af9113cc6a4daf6a12f59d87b21da2a8b4ccdd493f53506ea2a8571f4c345373414069bc1a5c9a653274154536945252180349ba94b5341a00e9b45b9dc315d1235711a54e637aec227cd5124f3c2b20acafb43db9c56bee005665d47e71e3ad5224b96bfbde6b514560db48f6e79e95b91c81aa58c7d14b495231b8a6b2d3e9b48650bbb1498608ae4751d264833dc7d2bbb22aacf6eadd4034c773cd0d455d3ea5a1639887e15cfbc5ed4c655db4da908a465c531a2106929c28352861be9c39a6d2d318b52ad46054cbf4a649623a9d6ab29ab0a0d0432cad4c0d57514fdd4145fb48bcf702bbcb3b558c0005727e1fb6666dd8aede3143207ecae535d9a4b565643835d75725e2b4f941a4334b4dd5a2bc4c8c6efeee6b46bcd34cd51ed1f23a7a57a15addc73a865208fad62e25dcb545252d40c28a28a602d2d2514842d14514c62d1494b40052d251400b45149400b45149400ea29b9a7502168a414b40051451400b45145300a5a4a290052d1494085a28a2818514525021d45251400514514c6145145002d14518a0028a296800a2928a402d14945001452d250014b4514085a4a28a06145145300a5a4a2800a28a280168a4a2900514514c028a28a0028a28a041451450014514503168a28a005a2928a005a28a4a0614b8a292810b4514940c5a2929698828a4a5a401494b45030a28a2800a28a2800a28a2800a2929680168a28a004a5a292800a5a29280168a292800a5a4a2800a28a4a047918a7669b4ecd627a42e714da5a6e690c7e6969b4a2992413362920db4975c536d304d599172824518a4db591b8e229b8a5a0d50868a53453450029a5141a4a0402969b4a680171520a8866a5a0916a557c54029f9aa1d871229ca6a3a78a42169738a653a99253ef52af14cc1cd489d6b547248d7d301dd5d5ad72fa730dc2ba953448943a969b4ea82870a5a4a5a008cd2538d32801b494526680129a69d49400f4ab155a3ab26800a28a2800a5a4a281052d14940c5a28a2810cef53d57ef56055087531a9f51b53023a5a4a5a8282929692810514b9a4a0614945140051452d020a2928a0614514500145145002d251466800a4a28a005a2929280168a2928016928a42d400b45559b51b787efc8abfe7dab26e7c57027dc567ffc77fa53b08dfcd579afe08465dd57ea6b90b8f11decbdfcbf64acb9262dc924d5aa64dceaee3c596ebfeac339f7f94563dc7886f26fe3d83fe99f159068aae5421ef33375a84f341a515a12252014a6985a90c4a5c8a6e69280b875a7669a0d2e6906804d474ea8c9aa01c69334534e2810bf8d1494cce69142e56928cd34669889e393635765653ef506b87e41ae874abdf9719fd681b37659eacda45dcd65c5fbd6ad98f8a66632e6db75416b7261e0f4ad1154ee2d7b8a0669ab669d58f6b78633b5ba56b2b0353618b4da75319b1486349c553966a269ea3588c9f4aab125721dfa0acebed03cc1b9786f4c574cb0aad31e3a5719e692c0d170ca73555ebbcd53454b85c81f3fe15c5cf015383c506972a1149815314a6628019d6900a5d94e55a4520a955299520cfd6ac5a13a2d4ead5028a9450492e4d4b14664602ab1635bda058f9c7776fa5320eb349b458500e2b6c0acd4b474e6ae43367ad4889eb9af1527ee6ba7ae7fc4cb981bfc290cf35dd5d1e81ad7d9dbcb72761f7ae65b20d4b1cb8aa68a67ad2306a7d725a478991576ce4ffbdd6ba486fa09b94915be86b9ac59668a40696a442d2d252d030a334514084a5a4a5a602d1499a280173451450316928a281052d2628a005a5a6d2d310ea2929681852d2514841452d2530168a29690c4a5a2929882968a4a062d1494b48028a28a0028a29280168a28a62168a29290c5a28a2800a28a2800a28a2810b45145030a28a2800a3145140051451400514514c028a28a04145149400b45252d030a28a2800a292968105145140c5a28a2800a5a4a280168a4a2800a5a4a290052d2514c05a4a28a062d2668a28016928a280168a4a280168a28a0028a28a0028a28a0028a2968109451450014514500145145030a28a2800a4a5a4a00f24c519a052e00ac2e7a42518a5140aa100a5c5369d9a4515eeb914cb5e296e0d2dbb035660d16e9b4a0d266b336141a1a9b41a005a6d06806aac216929c0d369300a7534d028b8870a98f4a845487eb45c06d3f34c152521082a4e6a3a92980b46292973544957a1a963eb55f9dd53c4335ba38e46a5837cf5d644722b96b28d41aea21e95322224d4ea653aa0b169d8a05296a0088d34d38d36801b4da5a4a0029a69692801c86acd554ab3400b494b45002d25145002d2514b40828a28a0633bd4e2a0a9d6a9123cd446a53511aa111d1452d6658514525002d369692800a28a2800a28a2800a28a2800a28a4a0028a28a0414514500145149ba818515527d4ad60ff00592a2fd5ab16e7c5918ff568c7dd8e29d80e8cb8aa93ead6b07df9147b679ae3ee35dbd9bfe5a6dff738feb598ce7d6af908b9d6dc78b231fead4b7b9e2b1ee35fbe97fe5a141ff4cfe5acac9a4cd5f2a02479ddbb93f534cdd4da407d6a85a8f269b452520149a2931473400138a053334e26a842f14c34521a62108a6629f4da41a028a534894a4d03b8cdd494ea6d20109cd2714ad4cc5301334bf9514703b50018348697a5039a0ab0d3562ce52ad55d8f6a54245033b6b24c0cd6829ac9d2ee7ce415a8299916d5aa5e0d55435601a91942ead7d296cef4afcad5a0466b2eeedc273562359a55aa72cb9acc875063c356ac106fe4d160b91c50349d6af2a05a7e00a2a6e0369b8a7d2548c8596b9fd534033e593ef57498a65319e5f2c12427041a86bbcd57434b8e5061be9ffd6ae36e2d2580e1908fc28342aeda36d2d146a3d03152038a6d3a8043b7e6a4dd51d2726a8865b8a23290a2bbed16c044156b0fc3da4ffcb5719fad76ba743de9905e0b55e5871c8ab98a5d959dc08627dc2b23c44a4dbbd6a30311accd79bfd1dfe94c0f2991b27d3f1a44344dd699cd6ad08bb1b9ab71dcc91f2acc3dd588acf526a74a8037ed7c537b17df2251fed601fd056edaf8a6ce6fbd98cffb5d3f3ae1a97715a8e588f98f508e747e841fa1a96bcdadb539edbee395fa574167e2dcf132ff00c096b3e4655ceaa8cd548350b79fee3ab7d0d590735050ea2928a43168a4a2980b45252d002d14945002d1494b9a0414b4dcd3a801696928a00296929680168a4a5a0028a4a5a0028a4a5a602d25145020a28a280168a28a0614514500145145200a5a4a2810b452514c02968a290c28a4a5a0414514503168a4a280173494514c42d1494b40c4a5a292900b45252d300a2929680128a28a0414b9a4a2800a5a4a5a0028a28a06145145001451450014b494b40094b4514005145140051452d03128a28a0028a28a00296928a005a4a28a4014b4525300a5a28a0028a292810ea4a4a5a0614514500145145001452514005149450079252d253ab03d217a5329fc525021b4b4bf852d302adcf4a4b518a75d1a8ed7356882f8a6f3421a53505880ad069b4ec53d06369053b14d19a5710e18a33480514804e4d19a75369887d385349a70a060b5254629d40870a7e6a214f02824752d252d324a87ad4a8715077a9d4574239266b69ef5d4c3d2b91b07f9abae87a54c8844d4b4dcd3aa0b1f4520a5a008e9a69cd4ca004a6d3a9b400945149400a9566ab2559a002968a5a0028a28a0028a5a5c500368a5a2810ca9c541538aa10e3511a94d446a808e8a4a5acca0a28a4a0028a28a0028a4a2800a5a4a2800a5a4a2810b494ddc298d731a7de603ea7140c968acd975eb08ff00e5b29ff7416fe42a949e2bb41f75643f801ffb351661737b3514b7514632cca07b9ae4ae3c5974ff00eac08fdfa9fd4564cb793cbcbc8edfef39357c84dceaeebc536b1fdddce7db8158b73e25bd9780ca9fee03fe35905f34c357ca857253331ea7351330a334cab10fcd378a6e690d04dc93349c5251d2900ea4e0d25250314f1406a4a4a602eea09a6e69681ea1ba9734ca29923f229bc536941c5495a0530d1bb34954492038a46a5349ba90c5a652d0314c5718cb49b29d494c637a5068c50c2a42e3693a538e292986a301a6926a4c527e19a0a36744badadb7d6bad5af3e82568d8115ddd8cc26406820b42a546151e29cb4124f9acfb87f3b814fb8b8dbc52db43543335ac1a2e7b569d9ddf6356da304564cb0b407da9dc0dccd2e2a859de6ee0d5facc04c52629d462914368db4fdb4b8a008b6566ea5a1c776be8deb5ae702aa49783a2f34ec173ce6fb4d96d5b0ea6a88fa57a5dd595a5e0fde019f51c1ae7750f094c9feab7483d96a8a39ac6292b5ffe11ebeff9e322fd54d452e897917ccd19a0ab99c16b5b4ed2dee1871c532d346b8b860a07e95e85a7e9505920e941372b45134402e2ba3b68f628acc8479d27b56daad29198e14ec5253eb11904880d73dad3621615d2b573fadc25d4e066b4888f32b9879e954eb765b7ebd7358ef16deb5bb10d5356118d57a01f7a828bdd68e6a347a7e6a40534fdd8a630a5dc28158b50de4b17dd723e86b7ecfc50e9c4c377fb43ad72e29e0d4d90ee7a35b6a36f71f72453eddead66bcda2ba743c311f435b967e279138946ef70466b3e42ee75d4b5996dae59cfff002d141f463835a01d4f7a82875145148029d4ca5a603a8a4a5a042514945003a9d4da5a621696929690c28a4a5a6014b9a4a280168a4a5a042d14945030a28a4a042d145140c5a4a28a00296928a005a29296800a4a28a042d2d25140c5a28a4a005a28a2900514514085a4a28a6316928a2900b494525301d49452d001494514005145140052d25140052d149400b4514500145149400b4514b40094b49450014514500145145030a29692800a5a292810b494b9a4a062d252d250014b4525002d14945002d1451400b4b4da5cd00252d252d001494b494005145140c5a4a292810b49451480f24ce6945253b26b23d313229334e5f7a42c291214a40a4a52698156e48a6dae69d7469b6956625d0d4ad4da53599b894b9a6f3da9d4804a4a39a2a842734ea61269c0d0019a5a4a7d1701a69dc537ad3a95891c053f8a8f34ea6300d4fcd46b5285a0029d9e2994fe299052ef5623a838dd5663ae8471ccbfa7fdeaeb62e95cc69f160d75082a644a2414b48296a0a1c2969052d0030d30d3e9a68019494ea4a006d14525003e31539a812a7a005a28a762800a29d494005253b14500368a7628a008fbd4e2a03d6a7154481a8cd4ad509aa111d2d25159961452d25001451450014da5a4a005cd4524e91f2cc07d4d45757696ebb98e2b8dd475796e4f5c2fa53b1373a293c4d64a7037b7d13fc4d41378ae103f768ec7fdac0feb5c96fa371fafe35af221731a73788af9ff00e5aedf65551fd335424bc77e492df8d577a6ee0298ae3fcc229775462973f4aa1a169b9a1b14de69123f34d068a6d021734a69b4521851d69314b543b8bcd18a37519a420a40683494c0539a4268cd379a6014b91494548876734ccd26ef5a6f14c0b000a8f14d56a539a6501c8a68fad1b877a38ed40879c8a6f5a6ef34e0e2905828f9452e0518f7a0437ad140534edab4c08e95a976014c6348107149498141341571b9145149cd318e402ba9d06e8fddcf15cb2f15a5a75cf9522d326c8eef19a6b9083348932edcd5491da6381d29903155a56cd6a46bb6a386df6d58028630a49220fd6a4c52e2a0661c9135b9f6ad1b5bcdfc54f25bac9d4564b40f6add78ad093780a762aa5ade230e4d3e6d4608ba91599459c557b8bd861ea6b0aebc531f48cfe86b9bbdd5e695bef1fcead459373a4bbf10c7dd828ac39bc57ff3ca3fc4bfff00635907afcc69b298ff00807e95af29173513c4178c7e67c7fc057fc2b6adbc47d37bae2b8f28e3b6296490e385a5c88b4cf465d634d61ff1f36fff007dd46756d2b9dd716e47a6e0d5e74a26c671f8d480923bd2f66bcc677e9e22d26d53e40bff00000b9fe75957be2a9653955f93d37fff00635ca049bfba7f2a9fa2f0ad9fa55f210773a3f892cfa336c6ff0068575d6f791cbd08fcebc7d62cf5ad3b7bbbab2c18673feed4ba6173d5e96b92d2fc648f85b91e5b7af6fe55d5473248320e6b95c5962b5674a3735683d678e5a9c40e5756d2d51f3dab9ebbd3ebd22fecbce4f7ae5a7b4adae238861b78a6e0569ea166633d2b348a009929ea40a8212454ca7352592934da50683c5210bbc8a92a2a7734087834fcd378a66ea0196564c5685aeb5750ff001e47a373591baa40691573b3b4f12412fdff00dd9faf1fcab656547e841af3512d5eb4d5ae6d7ee371e87a567c83e63bfa4c56358f88ede7e1ff0076defd2b64306acec50b451499a062d00d250280171453d452e2810da5a7628db4c06d2d2eda36d002514edb462980da5a76da31484368a7629b40c2928a2900b45252d300a28a28016928a4a005a28a28105145140052d145030a28a290828a28a63168a292900b45252d020a2928a602d1494b40c2929692810b45252d21894b4945002d14945310b452628a062d14514803345145300a5a4a5a061494b450212968a2818514514085a4a28a0614b49450014514502168a4a2818b4525140052d19a2801296928a005a29296800a28a281851451408292968a0028a292818b9a4a4a2908f1e17687da9c274f5a88da5446d5bb546876b722f6f5a062a908e5a69f3c7ad3b0739a14b59e2e255a7fdb69728f9d12dc8e29b682a2927df525b6453b08b99a71e299c53cd626847cd3a90d2f38ab1852514828244a78029869c0500280695a8ce29b93400b8a70a2905301c0528a6a9a752602e0d482a215203408334e1d2929c29a24a247353a9f4a87bd4e8335ba38e68d9d34d74d1f4ae574fca9aea62e9448889352e0d20a766b32c751494e340111a6d38d3280034da71a6d002525069b9a00952a7aac953d301f9a7e6ab33e29dbe8b08b14556f38d279cd4f94572dd43f688fd6abb4ed55cdd5a0fef16ff3ef47285cd30ebeb4ec8ac4f3bdcd482e64fef54d86699a996b2bed4f5617501dea80d06a80d37edd11a4f353d69922519a4a5a82c28a292810514514005358e296b3756befb3c66819ceebda9798fb14f02b0b750f36e39a8ab73224dded4edc6a2df4e0698892a3614ecd2e734ca23071464534fcb482818ec519a4a334085269b8a534d14082945191499a0561734714ddd45003a92929334143e937537766814843e9a28db9a6f145c05c521a5ca9a6e3d2818840a849a9aabb8a05a02c8d5643d51cd5985853d07624651d6a339ed52f34ca2c03727bd3b34d3cd260d310ef9c0eb49e611da8329a5e290c5f3c7ad395c1a88c6869a531de822c4c6414ceb4ca50682877e14c0d5267d699c53b09880d1f5a402839a450f0d5321ef553a7bd3d58d1615fc8ebf4f964b951c9adfb7b7095cbe837615b078aec179abb903b14b8a7014ec548c4c53b14b8a8dee112901262b3f519edc29dc4566ea1e258e1e17e66f41ffeaae56ef56b9ba3f330c7f7455a42b9764d74afdcebf5aa12df4d727f78ec47a66aa6ec9e69cdb7f86b515c73f278a5208c656828e073c50efbba926b424591b77602830ba8cf14bfb9dbc6ecd323427b01f8d0412bbb48bc914792193ef2fe7cd32373f776e69618b0796c7e14c64aa77ae09cd396de3d9f787e7427980e157afb53bca119f9f3f85031d1b67e4fe94fb74183f30fa518607e5e9ef5298c21f9811f85326e3a362df2ed5fad4b145d7a533cc087280e3dc53db04f61f5a091afd31b467eb57b4cd7aeec4800ee8ffbb5458203cd40d2b74e2a0a3d46d75282f13723034d515c0e95a84f6872adc7a576da5dfadc8ffebd73f29adcd2521ab1ef6c829f6ad836fe9c554ba8662bd335280e4350d3b3c62b93b8b7309c1af4491838c30e6b99d4acc3fa558d1cbfe9528a6b8c1c52afbd497626534fcd402a406802434bba938a65488919a9f8cd479a79905310da78a87766a45e2818fa50d519969d40894495a769adddc1d24247f758e6b1f34ecd22ae765078a61ff968ac3dc735ad0df412fdd606bcf037bd4c970e3a311f8d47201e89b8504d71707882ee2ea77ffbd5bb6fe20b79fafc87dea395946ead3aaba5c237422a5dd5a12494b9a8f34668024a5aa73de087b67f1ffeb55b13c4c808a87336f632173466999a2acc47669734cdd466801fdaa3cd2b1e2a25a9603e8a4a5a82828a28c503128cd2d14804a5a4a753012968a281094b494520168a4a5a002968a4a005a28a2800a28a2980b452514805a4a28a601451450014514500145145030a5a4a2900514525003a8a4a4a005a5a4a280168a4a2980b4514500145145002d1494b40c28a28a004a5a28a002928a280168a28a0028a28a0028a28a0028a28a0414b494940c5a28a2800a28a2800a28a2800a28a2900514525001494b49401e4b42d340a78cb5627a228a42052e2938a918c6890fa533ecc9e952e0d2e2a85689467831dea4b6f7a5b8a6db64d68645d14a6994fcd666c349a5069b9a70a60252114b49cd02129681834868d44494949d296818b494a29b4c4385380a68a7d0019a7af351e2a5a090a7d3296802b1eb5229a8b773532a135ba38e66be9ad5d447d2b9cd36215d22d291089297348296a0a1c28340a534011d369c69b400869b4e34ca0029b4ea61a00912a5a852a6a60324a414b2515489129b4b4dab24866e95959e6b566e95927ad2193e68cd3297359143fcdc527daaa27cd519a4286a846c096a412d528a4c8a97341469412e6add66da75ad1a9016929692810b4945250310d71be24bddc760fe75d5dd4c22526bce6ee7f3d8b67f5aa441568c7bd26693756c4e82d481aa1dd4bbe8026cd283510a766818e6e6a314fcfbd444d3112e29334ca50f4c62d3734534bd2245cd2e2994fc9a43129334d269d4085a6d2519a02e2b53b22a3cd3b3c5301ead9151d2e6930690c5145264525200351b2d3cd06a845661488c54d4e5722aa9e29145e0f4c350432f6ab4734ee51174a7fe3484d373413643b6d34ae3a52eea4cd030a4fbd4a73453ba16a3734ee2936514c8d44e6900a705a2915a894520a526828314a82900cd1d3bd2116e094ad775a4ea1e7afcdd6bcfe123deba2d3aec01d7047bd686676d4d7b945ac27d7c638e4d66cb7f3cdd5a95866d5d788218f8ce4fa0ae7eeb55b99fbe07a0aa5860dd0d4e2266fe1abb12527527d6aa3e07d6b5bcaaa77107b531153007714c1be874c1a4dcc38ed5404cb203d734ef37031b53ebdea18e4001f9727eb4a8533f39c7e04d004b16cfe2c8a5e59b02a36e7eed4af1b275ab209b0f09ce4539be6e4d47cb0ce0d4e1fcc18c2ff00df55421d305e369cd3bef8e431a58e2057fd68fa669d0393f292dff7c8aa10aea8ebf207fc40ff001a53bdd79de69f104e41661f85351b1f292f8fa71484c5ca6de1db77fba698f33c83939fc29c8061be75fa31a8fcccae368a043db2b8dfc546767d6a3c337ad2ecc75a82ae5e80715a563a8c96ad9159114d8ab1e6d646a7a2586ab0dc8e0fe15a3d6bcc20be921395247e35d3d8f8a633feb0e3fcfd2b174cab9a5776caadbb1595aae88846f8f8addfb4c374bc303f8d323c11b1b14eec47965fd83446b2f1835de6b5a5e33c571170854d32c5a766a246352e2a4072d3aa1ce29fb8d3193654557277538d267d29087018a7eea8b7539690850bba9f4ccd3f77154005ea45350e6947d690c9a9e1b150efa766901206a916635066956811a115f4d1f4761f435b365e262389ff00efaae641a5dc698cf488a749465483f43535709a6eb525b1e795f4aed2deea3997729c8a902668d1fa8cd3c2a8a81ae9077a16f223fc42a6c6ca73eec9f345369d4cc85a2928a0071a40286a40d52ca0a33499a5acc614b4514c028a28a0028a28a420a28a28016928cd140052d252d3185145148414b494530168a28a430a28a2810514514c6145252d020a28a3340c28a28a0414514940c5a28a4a005a28a2900514514c0296928a0028a28a002968a4a005a5a6d2d002d14945030a5a4a2810b45252d218514945002d149450014b49450014514500253a928a042d1494b4c61451450014518a2800a28a280128a28a0029334b49480f25a76714ca5ac4f4c7673494b41a561094e20526691a9a02b5c91496945c629b6b5a18974e29d4da2a0d40d2ae6928a2c0078a0fb50684a602f4a8aa4734ca421f4e005460d49486252734ad4b45c428a7534134ea60c2a4a8b3520a007519a4a502a91255fe2abb8aa9fc5d2ad83bab74714d9b3a6f6ae84560e9bb6b785448487d148296a463e969a29680186994fa6d0034d369c69280129b4ea6d00396a6a856a7a60472528a1e8ab440ca6d3a92a84579fa564f7ad69fa564e39a4325a28a2b32c2b2ef0735a9542ea0dd4d08b36ff76ac66abc1c0a9a9017acfad69565d9f5ad4a4014514940c5a4a5a69a04607886eb6478cd70e4d743e23b9dcfb6b9cad92244e94de6949a38aa2405264d26ea4cd031fe667b5396a314fcd0492e334c753406a75160225a76476a6d3a82c37526e5a4c527028245cd26693753a8181c520a4ce68c50038b521a69a4dd4c0751d69297a77a02c2734bbcd2521a043a905213450029a434526ea061baa275cd3c6294d262b14eadc726eaaf247446d83458a2c9a4a5a4a64a1bf38a3e6a5dc452d328179a6d2d1ba9083767b518f7a052e681d819a9b4bd696980da6d3e938a42133494628a044d1d59b7de5b8aa2ad56ede5c3035680e920d2673d41ab91e8a7bd6ad8482540d577653b906049a422d16b6abd0d6ccc9c56647f2bd5081f4e88f6aa92692a6b6715130a8b8ce1afecda06f6aa0dcd765a8da89074ae4e6b7f9bd2ac92b37b52c8981d79a306a363cfad5a2ac4a04847b54919f6fd2a0f31bb9c0f4ab115c6de300d50ac5b5b8765db95a7db88b9dc79fa5558fcbddf31db4edff37c954432da06dd855cfd6aca48f113c27e35524324447386ff0064d49d79e4fd6ac82d797f303bc734f919e16e194d324922c7ca817f1a1dc6c0db547e3405c468897ec7daa1da8b9df52cf3c6dca803fe0550f97b88e4fe3523d037f151fccc6a42a075eb4b1abca7815051a50db06ed4f6b5f6ab3656ef8abff67f6ac4d0c436e29bf67fad6d9b106a33a79a398563323bdbab6fb8d5662f13cbbb2cdfa7f80a57d3e4f4ac79ecde26e86a8563ac9b5bb2bc4ebcd717abc233914b24522f4cd5692e9f187e6b3b16538ea706a966ac2bd22ee4854d19a5ce690d2205a6676d2e6978a450002969a29e0d51360071522bd46314b480434ee2984d28cd218fa93350669c29813668cd3334134013669ead506734e06813243f2d6c697abc96dc672be958e4e6951e81dcdb9b51790e6a7b29d9dc565a366b434dfbe2b03d2ba3b153c53e98b4fad0f3828a4a29803d354114f7a4acd8c5cd14515250b4514521052514531852d14734084a5a4a280168a28a0028a28a0028a28a4014b4945318514b45210514514c028a292801d4945148028a28a63168a4a2801692968a401494525301696928a005a2929690094b494b4c028a4a5a0614514521052d2519a63168a292810b49451400b45252d030a2928a0414514520168a28a06145145300a2929690051451400514514c028a28a0414514b40c4a28a280128a294d203c8853e9bbbda973591e98fa653a92a491abcd3f14c1526453029ce29b6abcd3ae692d98d686562dd3ba53734eacb53513a52034a6905300eb4bbb14edb519340052628a4a00729c53ea2e29734c2c3a9c2999a92810ea76690504d002714e14dc0a905021334e1494ec5311573cd4dcd57c7353035d28e291bda66fae8d3a5606915d08a8912870a5a414b5050e14b451400c34da71a6d0030d252d1400da4a5a4a0072d4d500a9a98846a4a52292a912c61a65389a8f3562193f4ac9ef5a9374acbef48649451d68c566317353b599c64d240133cd5c76cd0066f4a29f25474865cb4eb5a959569d6b4e818ea28a2800a8a56c0a92ab5e36d43408e035590bccdfe359a6a7b86dccd501e2b710ca5cd373481a98828dd4d273ed4138ef522b8f1498f7a652ff009eb54368996a53cd400d39734c5611c52669fd6a1e69087f3486941a6922980734bcd37753779a4049499a3349ba82839a5069031a6e6824752519a6b034f401c5bda814b9a6eea062939a4a29334804e7d69693269b934c43e8cfe14ca334ec02d42cb8ed531a6b2e680151f3525554931daad0a06211499a5cd32818e39a663de97eb4dcd2258fa39f5a3f0a282ac1452538629b00e29a697229b4818bd293ad2934d0d4805dd8a9a1355b9a7c66ac96775e18bbc8284d7538af3ed0ae7c89873c1af425a6491bae6b19970f5be56b1ee170d54892c62a361563191501a9195648f35ce6a5a71ea2baa6aa73c01e981c13aba9a8836c39eb5b77d61e59ac76415a2603415279e94ac173c74a8f671d6801a9816648c0fe2cd4ac9b065ba5574491fbed156e2b246fbcccd5a19958dfa7b934a75899936ec03dc5687d86dfa6dffc7697fb3621ceda61ee98be7cdd32714bf68bae9ba4c7a6735b5f628377ddcfe1562286d543068d49ff00779a5a8ef139e13c83d6ae7f68ccfb416cd5ff00ecf8bdaabdd6968a7f764fe5485a12c6de656ee8765e613d2b99589e3aeebc2716e8dfeb59b1a2dda41ce2b4c5a0a8c45e5c95aab1d65228a3f6214e1623d2b47cba784acb98a33bfb357d2b2353d1863207e95d562abdcc7b9685303847b15c722b2eef4a4ed5d64b175158f3256c49c5cf6ac951a356cdfc1584c0835362ae5bcd14d4614f268180a6e76d26690d031d42d19a6b9cf6a431dbb352022a3e2969100f4b9a635266a87725e29739a8a941a41725069e0d454a062a464839a5a653c551362657a05460d3cb1a065b81b9adbd287ef056046d5d6e876a8c3cccd4346d1a87402968a28310c500514b4c047a286a5acd94266969296a462d2514500145145030a28a2801692969290828a28a630a5a4a29085cd14514c6145252d002d14525200a5a4a2988296929681851452520168a2929885a28a4a43168a4a5a630a2928a042d1494b48028a28a0028a28a00296928a602d14945002d1494503168a28a0414b494521852d2514c05a4a292810ea29b4b480296929681894b49453105145140c29692968105145140c28a2928016969b4b40052514500145149480f26a29a29e2b13d20cd18a29375021bd2a515115a72d032adc9a4b534ebba4b4ad0c4b469d4d34b8accd428cd04518e2a805e69a68269335001451455301b8a71a4c51400ea7d4608a905003852e29a29f40ac253d69b4a2810ea5a68a70e699255ef52019a8fbd4f128ef5d08e291d2e8f16056e566697f76b4eb36342d3a9052d201e2949a68a0d0032929692801b4da53494009494b49400ab53542b5350203494a692ad088cd478a79a8eac44571d2b273cd6bdc7ddac61d693116314a69b4b5058cf336b55bf3aa94a94e8db35232563519a79a4e28116ed3ad695665a9e6b4e818ea29296800ac7d76ebc988d6be6b8ef145c924276a684730cd49834ee29a5ab6248a83b7d69c454679a62109fca91fe94bc0a42d8a005cd19a6714ecd218e06a5dd5053f34c352506a1929d914d9298ae1cd2d47bb34fcd016414605260d27348ab214b134a0d3692a891e71eb4c347e548690ac3a8a6e6969142d25033484d021d4da052d210868dd4d3462a805a43474a686a063bad3b9a68229c4fb5172ac44e94e4929c429aac7e53c530d0bae45369aade94bf8d0217ad3314530e69098ee69435145500a1a8a4a5cd4884e2908fc68c9a298c09c5275a52a290714842538546d520aa28d0b494ab0af53b195668d5877af2485cd7a3f846ec4d0edee0d3219bdb2b32f63adadb556ea10c299054b71bd6a2922c549632053b4d5e92056a1818c454452ae490edaaed48666dd5a892b96bdb2319e95dab0cd665ed9ab8e945ca389906de7ad10e4f6ab77b6db4f34d8551856c992d165cc3fc3534573e51ff00eb5411a84f7fa8a99e4127207e42b433d4b8937fb3560dca95db8fd2a9457861ab114aa7aaf354215658979dbff7d0a6ee8d8934f9ae11d71b7f214e8e6853f847fc09683310f93b3a0ddf5a8c5aee232f8a53e5b7349322f1b0b1a453202b93b6bbdf0cd81861c9ef5c3a865e6bbed22fb7409c735848d11a1776fdc54d6d306150f9b31fe1aaade7c07705e2b2b146d53eb3e3bdc8fbb5645da562e2caba27a611517dac537ed62972b1dd1937716c6ac6ba8ab7f50756158f71f30ae920e7eee1cf6ae62ee1c1aec665cd73da85b522919519ab1cd5307655a46a0a108a63d4878a6d21586ab669e0d1b0526291419a78dd4da706a0069a664d2c951e4d0493e73494d14e26a463c114e24541bea4c9a60499a01a8c31a70e691372656a796f6a84669fd698cb086bacf0ddce772e7f5ae3d6b7342b8f2a5039e6988eea96a30d4ecd4143a96994a0d310af452134b59b2c5cd14945400b4514531851451484145145300a28a2900514518a005a4a28a602d1451486145145300a28a29005145140828a28a061451453105145140052d252d20128a28a630a4a5a2800a28a2800a28a2900b45252d3185149450216969292801d452514805a28a4a631d45251400514514082928a5a0028a28a430a28a29885a4a28a40145145030a5a4a280168a4a29885cd25145030a28a2800a28a4a0028a28a00f24c52f1466815ce7a43e8a4cd23034c033ef4ee2a3a7669815ee69b6d45c525a7156645c340a4a70ac8d06919a5fc68345500629a68cd140073494868a7600a5a5149458628a75371520c54887015262a206a4068101a05369d9346a2176d28a28aa44958f5a9e2c66abf7a9a3cd6e7233b0d33a569d66698bf2d69d66c43a969296801d45251400da4a5349400c3494ea6d0025252e69b400f5a96a25a929885a434ea69aa44911a65486a3ab1115c7ddac61d6b667fbb58cbd6828b145251590c2916929814d2027c534d28a4a00b569d6b4eb32d7ad6a0a062d2d251400c73815e7baccc6598f35dfdcb6d535e6f76f97635712195cf15130cfb53cd47beb50d0653734e2699c5016034609a6961413485610e3bd1d29319a6d500fcf3520351e4528352324e2838a60269d9a622214e34cc9a0b531120a08a68346e341602949a0b534d2245cd3690f1453247034a0f6a8cb37a529a0a250293029bb8d00e680d00714e34de28a062629c69b4b9cd031b47e9466914fad3158514e524d47d2941a007f351c89525252190c6e41eb56460d557e29e92d313256e6936d3b34da91585a29a052f34cad029714ddb49b8d040ea07bd3413477a603f14ca5cd06a4621a45c519a29812c725755e18bd9239b6ab6335c9466b534eba3148ac38e6ad099eb212e8f7a6b5adcb77ab76d70b2a822a7cd2e733b1ccbd94a9272d8ad58ece423fd67e94b7cbdea5b59322b46d8ac44da731fe2aa92e8d27f0b56ce68cd657651c94f65771d50786e5fa9aed668d5eb06e620b55719ce4ba22cbf78fe958d2d925b311d4575ce6b0b5265cf4ad22c4ca0f2a1400228fa53126f2f91c7e14f5d9b7eed135c79dcf1f956e642f9a656cedddec16acdbdd95c8e99aa827688f42bff0001a9a272cd9c67f0a64d8b394c7dda4674723b0f614f176a1766dfd2991b4431c71e8698ac878fb373ebf5a8d22c91f3e3f1a74aa923646d0291d1140da4eefa520bb227c86c6722bd17c39e5b5b27cbfa579e88e4eb5d8f84eff786526b0a85c51d60029b2a0614fa2b84d8a16b8e9573c85aa6ff00ba92b401ad24219e4ad21856a5a4aceec7628dc5bab0e95cbcde6a646335d83d73d74b8735d11649cdbdc7ad67dd856ef5b1751ae7a5645d5b8ed54347373a106951ea5b98dc1aac1aa4a2d139a6834f8f148e281081a94e45333520e6a463738a77069869719ef4c7a84882a1152b83515201e334669a18d05c500ec3d71525479a5a0761734a0d20e6968172922922a5150e69dba8116055eb29b63ab5505a9a334c0f488a4dc2a4cd73f63a849b055bfb749e86b328d5dd4edd593f6e93d29c2f65f4a05635e9d556ddddbad59a9285a28a4a918b45149400b4b494502168a4a281851451400b452514842e68a4a280168a4a298c751494b40051494b40828a28a430a28a2800a29296800a28a4a602d1452520168a29280168a4a2980b451494805a2929698051494b4861451450216928a5a630a28a28105145140c5a2928a005a28a29084a28a298c28a28a402d1494502168a4cd1400b49494b4c62d1494b400514514804a5a4a29885a28a4a062d25145200a28a33401e4d8a4029680d589e9098a7534d3b14c0652814714a28195ae4114db534fb8a8edbad5181729c05329cb506a04d14d6a5a630a6e296928185370696972698833498cd3853051a8870a9545479a78a4c43d69d9151ad2d21d829f4ca96aae486696929681150f5a992a2c735229e6b647233b3d30e56b4ab2b493f256a54123a9d4da75002d18a29680194da7536801b4da71a6d002514b8a4a0072d4b512d4b400ea61a75349ab44919a6d3e99564904fd2b17f8ab6a7fbb58608cd032dd25145645886933486a32a68112d385300a752196edbad698acbb5eb5a62801d451450056bd3fbb35e6f31c926bb2f10ea9e426d1d4d712ef5ac45a10b134c34e34d602ac919cd37ad1e61f4a4c9a431334669b453648b9a4e2933452d4a485a7eea6525004a1b34b9a6034e5a648d75cd373f8548706a0fc68025cd373518cd3e818f0693148cc050727bd030229338ed4b934991e94ee48b9a292838a650fdd4995a68f7a5dc314842d253bad274a7624419a534da514142edc8a68e29734dc521dc53cd369314a281590fa29b474a0623ae6ab8256add5791696a04e8f9a755788d4eb9a04d0134dcd3cd4755a00e19f5a705c5478cd3c5212b88292807069588aa1d900a3ad2734bd681d86f4a33ef4bc521a402a35598daab0c5491d51163d4bc277fe75b85eebc74ae9b35e6fe11bff2a6d9bbe53ef5e8c2a59041783e5a82c9aadccb95aceb3c8356846b53696822b32861ac9bd4ad66159b7754230a43583a8e3756ecd5877d70636e3bfb55c4087ed25a2d9c7e555b73276c7bd4f186c1c27e3b698d76eebb3ae3daba8c2e35e67b8e7049fa54893bdbb74e6a3124b161b95fc29ff68699b25727e94143d661cfcb533cd1ba05e07b8a896ebcbdc3d6a05317fb59fa5324be91dbd3042cddf1f8d39fca6c6c0abff02a6f9602e77f3e948049b7c671b81fc6af68d7ff0064954e2a90491ba7eb4c126e23af1521a9eb68e0d4958ba25efda205e79ad7cd79ed1b95af23ef535bbee5a261b8556b17ea2a80d0a0d251589446d589a8261b35b84567ea10e56b689272b7ab59930cd6dddc79158d20ad00c3b94cd64baedadfb98eb16e179a43111ea7fbd551180ab0ad41a0a452034e269b4881eded4cdb41068e9414856cd415331a801cfb5003f3ed4714da41489251499a6134fe2818e5e29fbaa1cd38516024cd3f70a8a94629a1ea5c06a45a854d3d0d224ebfc3acb206538ae8becd1fa571de1c9f12e2bb715932c87ec91fa528b58fd2a5a5a8186d028a292980b4514520168a4a5a60145145001494b49400b451494085a4a5a290c296928a0028a28a005a2928a005a29296800a28a2980b49452520168a28a0028a28a0028a2968012968a4a0028a28a6014514500145145002d251450014b452503168a28a04145145200a5a4a2980b45252d21852d251400514514c028a28a0028a292810b494b4940062968a290c28a28a602d251450014514500145145002d2514948028a28a00f25cd00d21a701581e90ea434669d4c647c5380a434ab408af73515b53ee9a996f56645e14e4a6d02a0d4434a1a986940a602d27d28c50281730dcd253c0a4a430c7d68e28068cd32470a753452f3400fa29b4fa043726a4a4a766900a68a28aa422b03cd48a6a2cf35228adec71c8eb346395adaac7d1a30a95b159b250b4ecd252d03168a296801869b4ea650025252d36800a4a292801c2a5cd46b525310d2d59f2ea5b3b55f6acbba868b808757141d5455131533cba7cc2b1764d4558564ed6dd9cd4fe5537cba771d89379a77986a06151b330ef523b16bcca5f3ab3bed320353098d31177cda5f345430fcf56d34fdd4864d68d935ac2aa5b5908aadd201699249b453eb37589fcb858ff5c50071bab5e35c484e78aca6e2a5693350bb56e4f2a199a69341e69b9a620a8f753a9b8a421314b4d6c8a775eb41434607bd34934ea675a7a0c5a4dd4b498140b5241d296a3cd029089775444014ff00d69ac334c437228df8a66da901a650e349ba90d26ea403e8a6e4d14007d294d21a2980bc518a4538a5cd31585045293ed4ca7531010290d2d36a7500e94e0d4d3c526698c6914a29d8e29b8340585a5a28a042eea47e7b519a763de828a86a58e4a6c9516714032fe4d36914e69d9a0420a5a6d2d210def4b8a5fc2999aa01d9c52d329d48770e946fa4ce69314842034f492994f18a6069585cf90eaebd41f5af60b2b859e3561debc5627af4df085f8961f2f8caff00b54c83a72bc564a0daf5b38aca9d36bd3892690a5a6c4d914a6a0a18f597755a521acab9354230e63585a8072c36a93f856ecd589a948d1918cfe15a211125dc9182b5161f1f70e3d76d2c4d2bff0006efc293ed2e06cae9311ad74d30f5c7b53e399a16dd8c7e1516580cedc0f5a7bde99f05c7e94c63da44739229fbe1d9f746ef5a5599067e45fc4530451e3ef734089628a32402f4344ffc343c51123cac7e2dfe14f58b018f9b8c7f0e6801645921fe20df43518ca7257f3a913ce7e833f514c9252df2b548f43a2f0a5ded2c991cd763bebcdf4cba4b7950f4f7aed935088ff10fceb9e512d33537550b67c494bf6a4f5aa0974be6d42455ce8f3466ab0b814ff34563ca512d43326e1526ea6d007377117515853475d4dea6d6ac4bb82b611817095857a2ba69d2b02f23f5a4332b68ab319a81852c4d48b2e7e14dc50a4d3e9011f4a6e45398d3702810a40a86a6e9505318e19a4c5346452f5a091734ea4eb49ba9142d28a0f3474a02c3b34e1f9530629ea696a4d89d5aa6535085352006a846d6892ed9d2bbf535e6fa5cbb264af464aca4592514518a8282969296800a28a4a043a929296800a5a4a290c5a28a4a6014b4945002d2519a2900b49451400b452514085a28a281852d2514c42d149450014514b486145252d00252d251400514514c05a4a28a4014b4da5a602d14525200a5a4a28016969b45318b4514521052d252d00252d145030a5a4a298052d2514005145140828a28a062d2514520168a4a280168a4a2810b452668a0614b4949400b452d2530168a28a40252d145030a4a28a04145149401e4ac6941145281581e90714b9a69a2985c314bd6908a55a00ad73d2a3b6a9ae6a1b7ab44176a4cf1518cd381a458da4cd2b52628015a9334668c9a9243268a434e140c68a053a92800a9053452e68b087e0d2d347d69d9a076133520a8b1528c5040a68a28aa422a739ab108c9155c75ab76d8dd5b1c6cebb4d185ad2aceb0e95a150c10ecd3a9a29d400b4520a5a00652529a4a0061a6d3a928012928a2801eb52d42b5350034d54b88f3572a265cd006494a88a55b75c5336d0054229bb6ac3474cd94015ca540cb5748a85d680335a3e6a744a1fad4a91e69813da2d6c402aad9db569ac78a00752d2514805ae67c4f75b536e7ad74d5c17892e3cc9b1e9ef551259899151ee3473486b510d269b9a75369dc91298d4fcd34d4943734a4d339a75318da4a53494802933451405851cd2838a4e2933544926fa69a1734ec8a02c57e73d6941348d4a2818ea5cd26f140a5601d466901a5e698051bb14536985c7e6983345145c07eea775a6e3f0a334842f4a4c62929d9a6318c6941a4fc297068b886ef2694520a419a19571d4628a5a420c8a0d141f6aa1086ab1ab550b8a4308a4ab216a954f14948459cd479a51410280139a4c502949a0761b4ea6e68ce6a84252e690d25310eeb481cd192694540c911cd759e12d4bc8b8009e1b8eb5c9838ab96b36c604568893dc41acbd41c29a8b4dd4a5bd895c2feb4dbe8266eb4e31332c5adfa62a56be1e9546c20c8abdf66aa7ca2d4ad2ded655cddb7a56c496e2b3ae205a5a14604d34958f7cd2b95f949ae8a4885626ac3cada7bd5a24ae934901c7434ccc9cf19fc29a9248cd9da58ff00ba4d49f6b2991eb5b0888de315d9e94ab3a2e381f9545bb83c0fca9ef74b205181f80a646a58795246dc7ff1da9879463e9f37b9a86dde0cf2991fed52ec56c9e31e94c9fbc9228471b9d47d0d2189b3c1e2965893e5f2c9269cb14982778e3b6ee6801ce648bbfeb4d5709ced1f8d01d9bf8771f719a73dd2baec231483412100b8e42fd2bac8b4f7c719ae4ff758e3afd6bbfd39b742bceef73594ae5a339ede61eb542049377435d2cfc0acdb45c9a9e62ec384930ec69ff6a97fdaabc314617d0545cab1597507a946a54ff293d29a6d22fee8147ba053d46f06dcd65bde24a2b46feca3dbdeb1a1878355a08af260d65de5b6f15a8f00aab2c64540f539574dbc5411b6d35ad7900eb8e6b21b8a45dcb88f52eecd568cf153a9152310d369e29b4c0035576e4d4c2a16e2a4621a3814a6981a80250453714a33ed41a43b099a7649a4e3b500d316a2d48951d2a66901603f6ab155578ab0ad4c82d5b1dac3922bd3616c815e5f09e457a65a1f916b39148b34ea6d15058b451450014b494502168a28a06145252d200a2928a602d25145210b4525140c5a2928a007514945002d2514530168a4a5a420a2928a005a292968185145140051494530168a4a2900b45252d318946696929085a29296800a28a4a007525145030a5a4a29885a28a4a402d1494ea004a28a28017345149400b451466800a4a28a005a28a4a0614b494530168a4a5a0028a28a40145149400b4b4945001451494085a28a4a062d14525300a4a5a4a423ca4d368345627a8380c521a050690094e5a6e29698886ef3505bd4b7551db8ad4c8baa6978a4cd36b3351cdcd20141a45a9b001c52d2520a062f34628e9466810514a290b5580e1c52d3307d69f485a0bbbda9d49b68a0029eb4da07146822422929d450414c1e6ac47d6a0039a9e21c8ae83959d8e9a7e5ad2aced37eed68d66c91c29d4ca7d002d140a534011d369f4da0061a6d3a92801b452d2500390d4d512d4b4c04a4a7525202a4d1d57f2eb41973506ca00abe5d4662abbb28d94019fe5544d1d6898a98d0d02311a0e6afc16d52341cd5c8a2aa027b78b15608a48c539a988868a5a4a8288e67daa6bcc6fa7f32563fe7f9d7a06b370628188eb5e6ec2ae24b1b9a69e68e69771ad881b494d39a7647d691686f4a69e29f4ccd210dce6939a2976d2d462537752d0466980d3499a31ef4de680b8fa5cd45934a334219282697935164d4a1aa89229169953302473500a9f994494669a38a5a00703ed4ea66714b9aa10668a6d14c0752d267da936d40890fd79a0d18a5cd172801a4c9a28c8aa10134514520194b494a3340016a752518a043c0149f4a5c7bd37f1a0ab084d30e69d8a56141056a40d835232e2a235251755fd2942e6ab44d8ab4b5a1361bb31499a730a61a43168228005275a004a5cd20a2980b46296939a403b352c4fcd434f53cd581e95e0dd4f729849e9d3915d35e74af30d0b5136b32b7f0d7a5dcb6e5a666c8f4e3d6b47159ba677ad434a4245492b36e2b524acf985006438ae7f5a0e7680335d2ca95ce6bcc63d95684677da25b739e86a1f34f5e4d365bb2e7269c97be5e723afb57411743d6f308538fca991320fe1a8f2be95349346c8aa1547b85a604f249139e3e5fa558885b6d6c924fd6aa5b0b7ddfbc1b97eb526c462d82a07d69904d15b1623e603f1a4f99490b934e688205dadb8fb0a55867c13dbd491fe34123b7cb01e45246f18e4afe949e66f3c8dd4ef39586dc05fc29143b6a337602bbbd1b1e4280738ae11122e79c9aedfc399f2003cfe359542e25dbb1f29aa3651d6a5dc7f21aa764bc5628b25c53aa4db4cc521894d269d511a00a97cff2d6445d2afea527159ea7e5aa110c955a419ab0c6a2350332ae22cd73d7516d6aea674ac4bd8b8a6333d2a615550edab39a928973484519a0b5318cdd5139e6a6e0d472ad212b8d6c5478a7526d348a0069e6994fc0a081a38a7034ca3148d05152c7511352ad1626e4953a556cd581c502b176d232cc057a5db8c28ae2bc3f60659376df945772062a24343a969296b32828a28a602d145148028a28a005a4a28a6014b494520168a4a2800a28a29805145148028a28a0419a28a5a0619a5cd36969885a29296818525145001452628a007525145200a292969805145148028a292801696928a062d251450014b494669885a28a290094b9a2928016969b4b400b4519a4a00752514668016928a2800a28a2800a5a4a281852d251400b494514c05a2928a402d14945002d14945002d25145002d1494b4c6251451484251451408f27e29296900ac11ea0bcd2d19a08a6212930690353853190dcd45054d726abdbd519178520f7a51401599a03668f9683f5a6ad318a6901a5e68c521052e29b814b408052e0514bc55dc62114b8a4a5a007eea28cd19a004a7d369c291992514514d08a80f356603f30aad9e6a788735b9c923b0d35b22b4ab2f4b5e2b56b36243a9d4da5a403a90d2d25301a69b4ea6d003692969b400945149400f5a96a25a9a80128a5a4a0418a615a928a06438a36d498a314088f6d37cba9b14629814dd39ab0894a5454c169a00514ad4e029ad54221a5a28acca39af14cfb63c7f4ae189aea3c5737cea3fad72b9ad90ae34d0bcd3a938154211a8a5cd235218dcd45cd49d6a3cd04099349cd05b3da8dd4006dcd19149453185253b269369348ab0dc0a28a0d3b0909934fa6528a007d40d5366a17a007519a881a7e6a063f14bc5267346055136173498a76df7a8ea9b18fcfe3453296a096494b4c069f4c63b8ef9fc2a32b4bc52558852d4668a5cd2286528268a42298c901349d69a0914b9a44dc7138a0628a4cd21ea29a43cd19a5aab886303501156aa265a56021ab313e6abe3148a4ad22f52f714c3c500d15640c66a70a4fc28cd201714628dd46699419a6d3a9b9a421f4ab4dcd22d324bd6f2115e99a45ffda6d57d4715e588d5d7786b5029943d0d6866ced34d3f31ad6ac5d3dbe735b5532122092a84b5a0f54a5a4519d2572fe22fe0aea2535c6eb57eb24a029fbb56892925dbc277600fc2a2691646dc453ae2e7cde5a88ae224fe153f515b902c7711aa91b173ebb466a31b698be5927d6a76106c18186f5dd5432493ece71e5fc83eb562da28886c9e7d2aa431c05807271ed8a9027cc42e31f5a082d4714ad8e76ffc0f14e91a452573ba9a60d8aa7cccfb0e69c04e727cbddef9a64ea3966787aa63f0a747243fc59a87ed1e69f9b26a4764600008bef8a2c2fbc77979390540ff007abb7f0e2ed8c8ddbab8911a6debcfb5761e16dde5b67d6b299713a39464550b31d6b46a8c636b9ae546c4ecb51d5822a2c50040d501a9e4aaec2a80c8d49aaa13f2d3f516f9aa092a892134829696a0b20996b16e96b6e6ac8bce940180c39a9874a429c64734d4348a64ca29db7f3a686a5cd0161314d9334fcd368021c9a5c50f9a4c503b89b694668a55a40479a70343e29a01a43149a979a87daa534c48957157ec2d8dc385ace02b7fc36f1a5c0dc69058eeb4fb14b640055ea629a7d6050b45251400b4b4945002d2d369680168a4a280168a4a280168a4a5a004a5a4a2980b452628a402d14514c028a28cd2012968a280168a4a5a0028a28a0028a334940051451400514514c05a4a28a401494b450014b9a4cd25003a8a4a2980b4519a2818514945021696928a430a5a6d2d020a5a4a2801d49494b4c62d25145201692969281052d2668a005a28a281851451400514514c028a296900945145020a28a28185145140051452d0014525140c29a69d49408f27cd14134958d8f4c5c52d2d26ea40302d2d19a4fc6a844375c8a8206c54d71d2a1b5415463a9a1f85253a9b53646a81a900a0d28a9280d3452d191556448b8a4cd381a4a43b005a5db4868c9a6c0752669296810eeb4ec5369e2980de2a414ca7ad021f49464d141054ef56233cd4008cd482b63959d86947e5ad6ac7d2395ad8a86421453a9b4ea063a9314529a0065369d4da0069a6d38d36801292968a007254d512d49400b452514085a28a2800a4a29681851452d0030f5a9aa13d6a7ab448531a9f4c6a6221a434ea649d2b32cf3df11cc5e73585d6b47559f7cad9acce95b90c7629b4b49400a18d3a9945050dc9a61e69dba929d806f14da75236291234e68ed4b453d0620c7ad1be8c0a050c6372296928dd8a03514d21c50296a462d324a76692419aa115e9f9a4cd1915031e0d2d3452f35448fcd34d028a06253a90d19c502145482a3a72b556a03a8a3346690584cd068a0d1a80da5068a4e4d003b34629bd29c2810eeb452d253b1490668a4638a334c571d8f7a8e9d4b40c84ad45566a274a901637a98d54c9a941a42b129145251cd3b922f1494869df855142669052d1f35002671450d40a64932d69585c14604139acb0d56607c1eb544b3d4f4c9b7b2b71cfbd7426b85f0e5eeef97b8aeeb34488217aa329ab923567cd20a45189abde8b74273cd706d20635d3f882788f05fa76c573109ef815ba3327491148251587a30a6b9859f38c0f6a7dc3c521e8a83fd95c52426df2772647fbd5a102c4d6db4e53e6f5cd46117b934d01064f4a9d960da36b316f7a0b09628b38889ff8162a78adf863e6018f7a822b4dc403263de8db229201e3d6988b5179a718cd5969268f2a7f9d40a9322ee63c7d6a50656c9f2b77beda640e8e7f2ff871f8511ac59f98d31a612e33918f61529f24ae1719f7340004c93b781f5aecbc34362b0ce6b8ef2f6ae777e15bbe1fba923ddfe159c8a47722a9cff238351c7a85437b7391c57328b34b9a94c2b5560d4015e952fdae33dea795808cb55e45ab1bd4f7a8a4c62a80e62ed77494c910d59641e6d4924556065eda6d4ceb50135050c7ac6d4a40056bb9ae7f527ddc50865445aae1361c55e5155671835231452d341cf14bcd22c5dd49494114c81ac2929dc5308a43d428a2973482c466929cc6929b1ea14fcd376d2834844eb566262bd2abc553818a43d4edb43f10f9ff0024a7e6f5ae981af2eb7728720e0d7a1e9b7bf698c377a8605fa5a4a5a91853a9b45201734b4da5a005a2928a005a4a28a042d1494b4c6145145200a5cd251400b494b4940052d252d0014519a4a002968a28016928a2810514525030a28a298051452520168a28a60145145200a28a2800a28a2818b452514085a29296800a5a4a2818b49452d00252d251408296928a062d2d251400b451450014b49450014514502168a334940c5cd14945002d14945310ea29b46690c751494668016928a5a004a28a2800a4a5a4a002929692803c9c9a37629692b13d3173462929dc5210de94dcd3b9a6d30219c7151db7269f71c525af078ab322ef41cd20348cc4d2541629a41cd38d3291629e29b4b495421e314a29a29453107268a2978a4312968a4e6810bc9a93151e6a4a420a70a6d385003e8c514551255ef4fe6999e69f5b9c923acd0cfeeeb6eb0f42fb95b62b36421f4514b40c5a28a0d0034d329e6994009494a69b4009494b49400f5a96a35a9280168a28a04145252d00145145001451450036a7a809a98558875466a4a88d3111541727084d4f55af4feecd6659e5f76db98ff3aaa41ab135419cd745d13a0dc8a5c5271484d21073498a5a68a0031484d267340eb4008681431a6d002fdda4a7e6998a0a0a6d494c22801b4d152ed151d02004d296a4a4e695ca1734b494bba98884d148d9a05201c29e0d474b4843e948a6504d3017f0a4e68c9a4a0448a69c2a35a70fad3431f4efc6a3cd381a6202697148692980b40cd26ea295877034ea4a2988314ecd2669050501a4a5a334c91568a28cd21d84a5a03526680222314ce95395a80d481601269dcd564735601a7a80a0668a68a5e2994369db8d2671499a648ecd2669452605003828a910d45d29d19a6896743a45e186415e951dfb32f735e476f2e08af59d2aed6e2046c0e95ab66362296799bf84d674ed71e95b52d66dcf02a6e3382d41b7bb67ad505c55dbedbb8e0eef7aab16dee323d335b124d13419f99772fd698e2366f41f5a74fe4b37ca368fad114709cef27f0ab26e22a5bb2b72dbbf4a62478fe2029ab1f5a95ad82a86f3c31feeedff00eca82874d6e626c249bffdac63ff0066a923825393bfff001ea8a282795b1b941ff68d199132073ee298ae4f1cb31e3e623fddab9f6899321863daaaa7da54038c2fa9a9bcfc9c940e69916258e48873b7f3a608d18f2c07d294c81c01f2affc0694a47b7e4e5fea299038a9ce074ae9fc3d16370600fbd732222013bff0cd74de1624efcd652364756b027f7454735ac6c3ee8ab2298d5c7766a53b489718a91ec94d476bc39ad0ab6d92671b06ec4d44d632ff0078d6c0a0a8a9f68c2c7153472c32773534931f435a9a9c401ce2ab300c2b6b9260cb70b55cdc0ad0b8817d2b3ded96a342f52acb71583349bdeb7a4b507bd640b5f9b1d698868912abdd11c62ac3d98cf7aa52262a0b4c68a76ea86a4a455c7d2533e6a32698052e334ca78c5480da28340cd0035852539b38e6998a900152af350834fce2a80b0062a746aac1b3dea4561480b8ad5d67862e7ef27e35c7a35749e1b3fbeffebd26076f4ea6d2e6b1285a28a5a06252d145020a28a2800a28a298051451480296928a005a28cd36801d45251400b45252d00252d145002d14945002d14945300a28a2800a28a4a40145149400b4b4da5a0028a28a005a2928a062d1494b40051499a5a0028a4a2810ea4a28eb40c5a28a4a005a28a3340051451400b45251400b45149400b4b4945020a5a4a280168a4a5a061451494c42d2514520168a4a5a06145149400b45251400b4b9a6d1400b453696800a28a4a407949a60229dda9a2b2d4f4479c5267345380a5618da28a52281956e4d36da96e145168b9ad4c4b79cd26294d25646a1d29334bba9a29d8071a653cd35be9400e14ea6714ea06253a8e941a0404534538f345310b4ecd3003525002629d9a414ea091d9a39a5a0d31153bd482a2ef5623419add1c4cea342fbb5b959ba5c4156b4ab3602834ea6d3a801690d2d1400ca4a5a4a004cd36969280129b4ea6d0048b52d42b5350025145140828a5a2800a28a2800a28a2818c3535446a615648b519a92a3354222aab7ff00eacd5aaad7a331b56459e572e727bd4249156250726ab9cd6f61098149914525320534ce9de94d369142734d34ea6e281066901a0527e3499761d9a4a6d028247d19a406938aa1b1df8d369db6928023eb45388a6914804cd2668c1ff2c28e29361618f494a69b523169c1a931494807d14941aa10519a28a180f068cd479a70e29a18f069fbc5474ea2e21e6994500d55c03069734869281587641a09a652f4a100ece690525389a002933480d19f5a680775a29b9a3752421e29734ccd2e6818b9a8da9f4da6323a955aa22281c54dc09e901c520e69d57a13712939a5a39a431734940a518a005a70a60a7555c65985abbff085f8c344493debcee36c56f68da81b6991ea8c8f4e96b2aef815a2640e2b2ef7ee9ff1a0938174c83d2a04e9e9523743fd292dd17f8ba7b574195c7c6b093f374a89a3f9be5e952488bbbe5e94a90a303fbdc63b63ff00af4c488fecc366ef3467fbb4c48e46c723f3e298049f854f2c12c6a3715e7fbad4ca1d2c7342d8e0b7b1a5459f9c0247ad313ed129e14b3502e654c8a044cb72ec029e40f5ab897250ff00abdbc7f72a8c6ec39dbf8d5a92e9246dcc1aa84c9a2f27ab7e547960b750a28df1328185cfae29db22da79f9bda8250326d38539aea7c31e60670db7f035caa23904effceba5f0a3b177c8edd6b399699da669b4b482b88d8a00ed96b46b2ee3890569035722494529a68a766b128cdd462dcb59517ddaddb81915cf21c3115ba24ad7359ec2b52e16b35a81959ab2d461cd6bb8acc7186a6322956b1ae0fcd5b73f4ac27e4d494ac43c53b35177a786a4ca1e4914330f5a66691852106ef4a7d435266828752f15196a456aab08739a66ea7b3d47d6b31894ea4a2a89448188a9c3556dd5207a45e85b8deba3f0edd049867bd72a86b46d6e0c6c1876a083d554d3aaad9dc09d030ef566b028752d3696800a5a4a280168a28a601494b49400514b45201296928a0028a28a005a29692800a28a2800a28a2800a28a2800a5a4a280168a4a3340051452e334c06d144f2456c332305a83edd6e7a38a2cc44f4b512dd407fe5a27fdf62a40c87b8a2c02e69296a369557ad2287d159f36b56d177acd93c5087ee0fd69d981d0eea6b38f5ae70ebaff00e4d567d5a63de8b01d579cbeb4e128ae517519bd6a64d425f5a761d8ea370a4dd5ceff006abd4e9ab52037334b590baa035723bc53de8117292982414fcd210b45252d03168a4a2810b4525140c5a5a6d1400b45145300a5a6d2d200a5a4a5cd0019a29296800a28a4a602d1494b486145145020a28a28185252d25020a2969281866928a4a0479566938a0d20ac8f4c7d252e28148621348c734b494ee22bcfd296cd8524e38f4a8eda9a31341c7a532a527d2a2a866a18146683498a35287534e69dd69a684205a75369c05318b4b49c52d4884a4a5a335a123b269f510a905480669e2a3a901cd310ea4a5a4a649536f3576d47cc2aa77ab9667e6ad8e5676967f76acd54b261b6add41028a7520a7520168cd1494c04a653a92801b494b4da0029b4ea4a0072d4d508a96800a2969280168a28a0028a5a4a0414518a2980d22a6a86a6aa10b519a94d4469888ea1b8194353669920e2b32cf2cbc5c48ddaa9915abacc5e5ccf5935b086f4a6934b9a69aa1067da9a68cd15231b41a29735404646da33475a2930b89f2d369c31498a43600d28a6d14c0945345341345310b9a6d14b9a4219486968a450c6a6669c6995221d9a5cd34514863e90d14550585a4a5db4da489169d4ca7714142e69f50d3f26a8924dd4da4a314143b3499a69a5cd50833466929295c4480e69334de68cd4943b3475a66697755085e7d69051499a02c48296a3a5cd1601d9a3269b4035421d4ca5cd36a463a37a954d418a914d087624e69334d2d49cd50ae2d2e29293ad311264520634838a4a9b0136fab90c959e2ac4727b56866cf4bd0b5237307cc7e61ef535f1f90d729e1fd40c526d3c035d1ddc995a641c57940aff00f5ea1118edfce87c629f6b1a1eafb6ba0cc963811b8326dfc3355f9e82a568981f95b342db9da5b727d37734c0635bc9b03ee43ec1aa31e7376cd00b91ed524be7c18ce57fe05ffd7a0a10c92c0de8d4d0cdcfca4fbe29dba4739dace7e84d392f0a864fe95640f1785d421edef56a09e143cc40fd5455142bfddab724b1c8f9c6c1e918c503b162311f5269ed102c76703fdea6afd9f6718dff00ed352adb0e72ff0080a6215e2653857ddf8574be1712acac1b1d3b573691487277fe75b9e16918cdcfa75ace408ee8d02985a9d5c46e665ef0d5a111e2b36feb422fba2b4622c6ea42f4d268ac806495cdc8db6535bf29c5739738f36b5421666cd66c9579eb3e5a0061acfb8157aaa5d74a0654bb6c2d6031ad6bb97e4aca63c522910114a734d14adf5a92c55a4734829add6801d9a70350ee14e534b518f622941a8a9d9c5218f26814c268068b085a66e34a734cdd480764d2863eb4ca3340cb11c95763931599bc5598a4a641e91e17badf16dcf4ae96b8cf0823fccddabb2ac9942d1499a5cd480b45252d00252d1450014514500145149400b45252d0014b4945002e6928a280168cd25140052d251400514b45030a4a2a296e238865980fad0226cd42f7512f5615cfde7888b9d9064fbd6869fa2bfdfb8393fddcd69c84dcd588f9b564055a8f2abd2985eaac4dce67c53a90f30281d0573e2f5fdeb73c496837ab7ad73ff2d3192ff6849dc9a9e1d5a45e8d547e5a7c11a29a2e33aa835b902e5eb32f75473deaa09cb1aa972ecf599a1134d2ce7daa68d00a8c714f0d4c09f3499a606a5a404e1aa5cd4282a602900b9a729a6d3b140c786a956561dea014ecd219716f641deacc7aabf7acadd4bbe824e862d491bad5d57535c8f9d8ab70ea4e9408e968acc875743d6ae2dd44dfc54809e9699bc1a7d00145252d200a5a4a334c02969b4b4c05a2928a402d1494b40052d368a603a92928cd20168a2928017345149400b45251400b9a28a3340c4a314525023caa928e296b13d20a55c52014828042e68c525293482c55b9e454769cd4b3e31515b56a665ee29714abd29bbab334034dc53cf34dc5318134d2697349500283527e350d3c0aa024a05252d021b4a45349c52f340c51520a68029d4b5244c53e9bcd28aa10f34628a5c5022a77abd64b93544e735a166d8ae83899d6581f96ae565e94f915ad5988514fa60a75003b9a4a51486801b4da5a4a006d252d250025028a4a0090549510a928017345253a800a2928a042d1494b40052d251400d3535426a6ab4216a2352d4469888e8a28accb380f1241b66cfad738c6bb2f15dbf46ae39856e89199a6e28a6b1c5310da538a6e68a9284a297a533354029fc29a2978a6e2a6c0045146ea5a2e2136fbd369dc5253284a0e68a4a04029722929bcd2b80ecd1cd1914d63486235329e69940051494b9a910a0d14514c05a09cd1462818da5cd2529a91075a70a4a5cd580e349ba8a4a63d428e68c52734085349d28a2900b466928a60252d2514085a4a4a2818fc9a2928a431dba9334dcd2e6a843b7629334ca7d4ea21334a1a8a6d05138341151a934f06ac90141a77151d506a2e69734828a403c66a45350d3d4d17034a0988e9fcebaffb5f99167af15c3c6f5bb6b7bfbb2335aa3168a2d16473c5007a546cdc75a9adadccbd1957ead5b99a255859b3f301f5ff00f5557f9fb74a76e7ce3fad29867db9c714c2e3648e68d72cbc54465924e70cdfa9a5df2b0c76a70964858654a7e18354171f1dd3c2de87e9518239e294cdb9b71193528b98f615f2d777f7b1cd0214cf1b22aed55c7751535bbdb6ef99723fde354e331fff005b35624f219fe4f917db9a02e594489b3f3281e99a9a48b9f9338f76a8238e1d9fedfb918a9d2dcf24b63e954483ac89d1b756c681234338dff2e47ad63c7e7fff00aeafe905e6979150c11de2de45fde14a6f63fef5672d8b1a78b135cd689b5d85fce981c8abf6b28d82b06fe1618abb6c972abf77f5abb227535f346e159c5a71fc26a0334edc7cc2a394a2dde4adfc18ac396393764d5c6866f5359774d72a0f26aac4931e4552956a2b4bd6e7754ad711b52711a6418aab75d2ad165aab763e5a928c0b893354dea495aa026931a230b462933b7d69b5251274aafe6669f235439a9341f914a4d47ba97934ae21d46ea0293522a0a620e68e9487da8cd218bda998a93b53714086f5a5f2f9a3934f140c4f2eb6b46d06e2f4f0a427f7ab256baef0e6bbf67c46ff0077d696a23b3d374e8ac936ad5fa8d4e69d9ac863e8a4a2980ea2928a402d14945003a8cd2514006696928a0028a28a00296928a00296928a005a28a2800a2928a005a4a696c573baa789963f961c13eb4c2e69dfeb305a0ea0b7f7735c85eeb171747e63c7a03c5519eede4396624fbd421b26b75021b3a2d0ed977866fd6bb4dd5c8e9a4a6caea03d5b20796a8f34d692aa4b738a9191eb51acd0ff00b42b8967aee2389e7e1ba5721a8e9e6d642b48a4574a9224794f02ad69fa54b272df28ad8f2adac5738c7bd62e46b1445a7684d33852719f6ffebd56d67453612eddc187ae2ac69be25db72ac627f2fdbad4be25baf3a5de3ee7634aecb39b6e294540ec334452fbd59997453f6d247cd4c05218f5e294353697340126ea42d5197a697a4512eea5df55f7d1be90c9f752efaae24a5dd401297a37d369bcd004cae6aca5c38aab1d5a45a00b69a838ef5762d52b20ad43b9a99163ac8eed1fbd4f9ae4e3bb6157a1d55a95846f52d518b5146ab62406900fa292968012968a4a042d1494b40c28a29280168a29280168a28a0028a4a5a00292968a0028a4a2818b4da5c51401e52dd29a39a79c7bd2002b03d21f9a6f068eb46314c04143526294d2b0105cf4a8ad6a4b9e951da8ab322ee68229052b1a934173494edc29b46831314940e68a6021a50690d373537026fc29f4c14e2680194b9a434034c4380a905479a7629885a901a86a41484499a29bba96a91255cfcd5a56d802b33bd5f45c0eb5b1cace8f463f2d6c564e8a06cad7a824752d3453a810ecd140a4a0061a4a71a6d003690d2d2500251494b400e5a96a2152d0014b451400525145002d2514502168a28a0069a96a23d6a5ab10b519a92a334c447451456659cf789a2cc39ee2b8073ed5e91af81e43d79cbd6a892034da79a8cd56a318683ed499a46a417063484d1c52669884068e9474a6e6a7518b4b834da5cd0029a293228140c296909a4aa10ca29f9c530d40c40690e0d2f14da6014945254884a5a4a5a0614ea4a5a6028a434628a40252d2d14c03229734dc0a5a77014d1452d30128a5a0d0c436929d4da4014b4da750025252e292980a692968a918bc5368a2a80296931450014a1a9b4a2a6e2168c51466ac619a786a65266a6e226eb463148290e6a842d2d2669b4c63b39a92a1a786a5719614e2adc73d500d56236ada266cb9e4e475a745b87dda8496c71534115c1c95ae8b98132473e0b01c7ae4545e73b0c76a412bf229df385cedc0fa53241b72632ac9f55c536694cc771dc695a7697ad093f9441daa7d98532921d15d05cfcabf95440a73c504abb64d49be1d98d8377ae6822e39da02aa1502fbee352431daeef9d8e3fd961fe15555225eb9356244b72ffbbf957dcd3192c6bfed003ebffd7ab8f06dfb8fbbdf18feb55a3b78b6e7773e953c70487f8f6fe354262912c78f9f7fe39ad7d1048b301b7f5ac7884ee7039fad6ae8133493ad448513bb414fc539053b15c46e63df0f996b462185aa5a870c2af427e5ad043a98114f6a90d22d48c8d94565dfc2bb4f15b0cb59d7a3e56a6072a9688d513d99ecd57e2ef51b2d5dc8329d275f7aa17577274e95ad752f962b9d966de6917629b605445a9cc6936e6a0b88c351f34f3513362a40468f777a4d98eb51e68c9a8287ee4a375328a431fbe9cb4de297e94c00d2a525396980e3cd22d3f68a42b408653e936d3f19a48761dd2ae5ab7239aa6aa2ac439534ec1a1eb362e5a2427ae2add67e973a4b121073c7ad6856003a9734da5a005a5a6d2d002d2d368a007514945002d251450014b4945002e6928a5a004a2968a0029692928016a19eea284658e2a3bcbf8ad57739ae1352d6a7bb6ff67d01aa480bfaa7891a7f95384fad603be69a5a999adac88b8b9068069334035423abb3907948735bb15da95eb5c9698fe6a915d069e8bfc55645cb79924e9522c0abef53f02a2359dca1ead8acdd6ec924d927e7577355ef183c654d219cfde6bacbf242a3fdecff00f5aaa5d6b32cf1a46dfc355ee5562aa3bab2491bab1a96d2003a55d9e533dbe7a95ac7b79b8a9975130064fe16f7aa194e43440a4d47bc355bb55ef41268443152d4686a60b5031714d3c53e9a690c88d369fb697cbaa020a6835362ab3549a1266943d300a696a422cf9b52ad64fda3e6ad1865a432cad5953500c53d1a84227aac6ac8355e5ab206134d0c477a4069185311623b86157a2d4197bd6464d488d4847596d7825ab75cad8dc90e2ba915221d494514005145140051451400514525002d2d25140051494b40052d2514005145250316928a4a00f2ba6f229d4d26b9cf44774a55a7536aae3169bba8cd3734c44171d29969525c70b51dad51897a822984d073599b0ecd06929299419a4a5a4a1080d21c519c536819246714fe6a35e29f412252814d34e14ae0380a7f4a8c66a4340846a93754469e28245a514528ad04ca83ef5694015c56777ad3d3f15a9c4ce83470d8ad8aa161d2afd4301d4b4940a4048bc5358d2d21a6034d329f4ca004a6d2d2500251451400f5a96a0153500389a6d2d2502168a28a0614514502168a4a5a6030f5a9aa1a9aa90853519a92a334c44745252d665993ae7fa86af36706bd1fc41ff1eed5e726b58904479a84e6a424545cd3650ca438a08c519a901b4ea650334d00668db494a08f4a004e45379a7163450027e14fa6d25021682d9a28ab1d82994ecd266a406e2929d4d35031b8a4a5cd36800a3a51466900ecd148a697ad500529a292a4028a296a84252d2519a009314a2981a9735603a9a6969d484369314fa434c6369b4fa6f4a0031486968a431b452d152213ad1494bd698094b494ecd218828a4a5a004a5149451a80b4da5cd252b80f0d4f1cd454e06a9087f4a6d14a2ac414b9a4268a0078a9d4d5615321cd55c45d4ab29230e954d1b156937e338ade262d120f331f738f5c51f68665c76a4f3dcaede71f5a6ee007ddad481cb285c638fc2896512b64fe42925b8f37a8a74124287e6553f5a6342a4d10dc0a293ea6a10100a32a4e4d492791e5f09893d779a005996df8f2f70ff78d49043013f3b91f4aad1c5165433363daa568977e236f97d58f3544932c64f43c7d6ad35b3c6c36b9638edd2a05b71b37799ff01ab1047349df1f53412c7b2cc801cd69e80d224e831c1f6aca4f30fcbcb7e15a5a54ae2e2307d6a58247a3253f14c8fa5495c074195a98e95660fbb516a238a96d8fcb5a924942d14a290c47359f76dc1abcd59974d9cd0060c4d9cd239c54713609aad7f77e5ad5b1193a9dcef381d2b28d586c9a81cd22881b3519a7b1a65494333513d484d40d50323a4a5a0566cb1c734a00a4dd40a007d26ea29b5602d2a5213402295c45956a7e335543d58596a89b0bb29aa86a7dc0f4a0a548110a990e0f5a8a806981d8f8735cf23f7529c2f624d76ea735e40929aed3c3be20dffba90fd0d4491475d4ea6034ecd643168a4a5a602d252d25002d2d2519a042d1494503168a292810b45145001451485c0a403aa296558c64f4a82e352b787ef3815c9eb3e21fb47c919f96a92115759d59ee9ffd9158fba909a406b7b19362efa6d213499aa025c814cfc6a32d416a451a36177f676aea2d6e47045711e6ff009cd6c69da8638cd5a22477aa770a63554b2bb575ab064a818c2d55676a95e4aa8ed48a399d51bdab1b7d6e6ab1679ae7c9c549b731324a6a493e6aab9a7ef14031eafcf4ad08e4c5678e6acc6fcd4b1235a27a9d1eaa06029ead52596f34951eea2a4a2455cd588d6a28b9ab1d2988ab2478aa1362b4a7358eac4be2a4d2c59fba2a934bc558b938aa1238c55123206e6b4629eb19240beb5612639a1891bc92e6ac21ac859b15a11b96a9b165f56cd452d2c74f7a66653069d9a6b52ad31075a14d349a05022d590cca9f5aec56b8fb29447229aeb51c38e281125145148425145148614b4945020a5a28a0028a28a00292968a601494b4503128a28a0029b4ea4a04796678a6014a0d20c5647a83f14b4da5152212929d484d302b4e78a8edb8a7dcb536db15a5cc8b9834114da7b1accd0683430a41cd29e2980de69dcd25388a91919a69a7e334dc8a7a087af14f22a314fa430a5a4c5157a00ea97151e69c4d49360a75369eb4122d2d2628c5509a2b0eb5a16f2ed159c3ef62aea915b1c8cec34d0767357c553d37fd583572a1923a969b9a5a007d2528a42680194ca79a6d00369334b4da0028a4cd2d00396a5a88549400b4b4da5a0028a2968105145140c296928a006f7a9aa1ef53d5882a334fa8cd0223cd145150518be233fb835e7b2f15dff894fee0d79fb75ad624955a9acc6a6c540e6ab401849a43413413525094947cb45161094bd28201a290828a4e945500b4de94f229b48a1b4b4536988290514668b0013499cd14950026da69a5a6d218b494b48290053a8a2ac05a4cd2e28a4014b8a4a75003714a2909a2980a2969294531587d19a6d2834c05a5519ffebe7fc29c3028a621bb6929f4dc53b00cc52629f8a6eda9b0c6d29a5a6d2b0011451499a60141a5cd14590c6d069734540098a29692a804e68c52d15220c502928a604a08a2a31522d5dc6252d26714b9cd1710a29f5153c1cd340598cd5d8a7238ace46c55a4615b5ccda2d99140a259fcd03fc295ae7cc5dbda9b9418e3f3ae8462395d10838523d18531846cdd87b0a74b24729e8abec06296336d93bd33c7f7b1fd698b41cbf67da72877fd6abedf7a51524896fb06d2fbbdf18a431d3c70e47945f1fede33fa54b15bc6c4fef71f85411443203c981eb8a7345b58857c8f5a62245463dff5abcd149063e6c9ff006327fa555483e4dc645ff7467353c42e1d863afd6a844bfe9110dd8e3eb5734d9e45990e3bd67ef94fcb856f6ab56f395719078a44a3d4929f514669dbab80e82b5f2e5299647e5a7de38d86aa58ce315a12681a6d33cda76fa432b48e6b3ae0b60d68c856a85c38c53039a590a939ac5bcb8f30d5fbbb9c64563b559288db8aaced531a80d48c8cd35b34a79a693526846cd503354a6a3c5458a19453a9d53618ca5c669f91499c5301bd28a3934da91851494da2c225a7e6abe4d3f75302c89315604959e1b15389053116f8a6ed350a4b5389077aa245cd5cb498c4c0838aa9f254b19a0343d5aca7f3a356f5ab758da0c83ecd1f23a56c66b98b168a28a062e696929280168a28a0028a29681094b4dcd64ea1afc36dc0f99fd3fc8a606a9900ef5525d66d23eb22d71b73acdc4fd4f159cd3bd5fb326e76573e2ab74fb9f3fe047f3158975e22bb97a36dff0076b13766937d5728ae4af752377a80b7e74d6a666ac05cd21a439a6e681580f34de69714531d829b453714c41baa58e5db55f06a41484751a6ea58addf3f777ae020b968cf7ae96c752c8e4d311b05ea26351198542f740548cab7c9bab9b9e2da6b6eeaf73d2b16704d161dcab4f02a23b969bbaa19a96fcdfa54f19ace153249da958669f9e6a649eb344952a4950346c2b5499aa51495683669165c81aace2a8c2d8abc39a6054b93c565464039ad89d78ac191f6d4142dd4d9ef59cf25134a4d56e6b451326c7ee352ab7350d3a988d059077ad7b67ae6e2979ad78e4ac99a266ec4e0d4c4566c4e6ae4725032191698b53cb500354206a6d38d25040edd8ae9b4a9cc8b5cb135b9a3dc2af1408e868a6e696a441466929680168a4a2980b9a4cd14520173499a28a63168a6d3a81051499a2801692928a062d251494847960a6014fa05647a63a907d2968cd020a695a5a434c656b9a8ed853eef914cb4cd51817314ea4a9bc938cd49adc838a56a294d4ea50d3c53ea334b48423668fc28cb526680178a334dcd1f353024a5c52714fa62015253453e98c6f14e19a6669e0d2b923b14ea653aa84cab91baa743558fdeab09c56c719dbe99feac55daa1a61fdd0abf5248b4e14da70a403e9b4fc8a6500329b4ea6d0034d253a9b400da752518a0072d4b518a92800a5a4a2801696928a005a4a28a042d2d251400def538aafdeac558843519a94d446981152d1484d6651ccf8aae46c09eb5c395adcd7ef3cf9dbd071584462b744113835113531a84ad31ea31a99d29c4537353618869052e2928275169783d69b4ea06262968a5c6290c4e692969b8a005a69a5a4cd3621b451c5252189498a7518a918da652e28a004a28cd2520179a752514c05cd149401400ee2928c52f14084a5a4a515602d341a5a2a06381a29b4b557112528a6669f557017345266978a64852629d9a5a6322c521a908a69a918ca4a7eda42952c43290d3b149414252d252d4809452d262a9883f5a28a38a061494ea6e2a4414f534ca5dd4c07d145266a805a78a683453025522a7056ab54cb564dcb48feb8ab52ccb27f0aa8ff657154455b8bcbc8eff008e2b78b33b0f8becdbbe75c8ff00788a4f2d0d230899b8f947b9a922483e6ddbfdb18c56a4098b6d84fcdbfea315088c7ad02207bd3e58a3006c7727d2822e3a78554811c99f72314e8edb7e7e70b8a8d2dcbb053205f73ffeba468dc3101b3eff00e4d50c78f30fae2b4089a0c6e393fef5545b69026eca91e9bb9ab36ff68948daac5bd0f1fce992480cea3763f1c53e1b9dadbb6fe99a61964c6d3b4fb53b79fba53f0db401e856fa9aec14afaa629d65140d127eed7a7f76993c517f713fef915cba1a1997bad7cbc62a95b6aee83eee7fe05ffd6a9afe0831f717f2a4b7b18f1d2abdd16a5a8f5c5fe2523f1cd4c35d84f7fd0ff85536b24a68d3075cd2f747a934baba5539f51522a196c3fdb35977dfbae37e68d0651b89726aa934fa89cfb50044c6a17e29c4d30d40c8ea32d5274a89e91a11d2014ee29c16a010cdb4714fa8f6d050d3498a5a666988338a4268a6b1acca1e2936d229c549d698c8b140cd38c66a6b68b7374a4218d03af5152456b33fdd526acdc3ef35a36a0c2b4f524c9860794e055ffecb90f7151dab1129ad6df4c5733974b987a7e752c7a6cdea2adf9869c27a7a8b42c5a49a85a7fab7e3f3ae82d3c433ff00cb54fc56b9d1354ab726a6c3b9dd457b149d1854a254f515c3ade37ad49fda0e3f8aa3945cc76be6a7ad2f98beb5c68d424fef528d525fef1fce8e52cec7cc14bbc7ad7203549bfbc68fed39ff00bc7f3a5ca2b9d7ee1eb49e60f5ae47fb4e7fef1fce93fb4a5fef1fce8e519a7ab6b7e57c91727d6b9394cb21ce0d69b4f9a6f98be82b4488b993e4cc7b1a70b594f6ad4f30537cec50499c2c26f4a78d29cf52b573ce349e79a7a81467d3248c6721be94b15943df27f1ab723e56a9c725032cfd962f4a69b68bd05283ef49ba95806fd962f4a6fd913d2a4dc69bbcd3b05c87ec91fa5305aaf7156e9b54057fb3253fecf1fa549494084f223f4a7aa81d29b9c528a622533b0ef5034cc7bd388a8dd290c8189a81f3564ad31a2a0a33ca9a68ab7e5d44eb520995c802987766a46a69e282c7893356637aa2188a9165a45235239b15791eb2e3da6adc528acec334d1aaf46d5949255b8a6a92cbb225737a9a18cd7488fbab3f55b3122f14167274da1f8a6eead4c2e3b34f2d4da5dcb501a8e535a36d266b2cf1576d64e699a23751aaca35558855b55ac8a256e6abb54a4e2a36aa26e368a28cd3241aa68e431f22a06a7a9e2988d45d6de9dfdb72562efc51baaec41b5fdb7252ff006d49587be9fbe9580dafedb7a4fedb7ac4f328de69d857377fb6e4a3fb71eb0b7d2efa7ca1cc6dff006dc947f6d3d627994bbe95866cff006d3d075b92b1fcca42c68b01b1fdb32d2ff6d49589e653bcca7615cdafeda7a3fb65eb177d383d4d80d7feda7a0eb6f58c65c534b9a3940c746a414829d8ae63d51452d276a07e35201c5329e4d336e680209e92d68b9a4b3cd5dcc8bd1a64d4b34a7a526368cd573cd4dca10934fa4a5c52658ca5a4a5a6312928e94b9150489406a5a4ad007e2a418a8e946695c05a93351a93525021b52ad45d69f4843cd1494a4d51056ddcd4d19e6abf7ab3167d2b7b1ca76fa72fee855ba8ad46d8c0a96a1923a969b4ea0050294d28a43400ca434ea69a006d369692801b4a28a4a007ad4b512d4b400b9a2928a005a29296800a4a5a280168a3345310d3d6a7a83bd4f5420350b54a6a234c08eaa6a373e444cd56ab98f155dfc823f5a84339195f71ebcd40d4a4d46d5b9030d40dcd4c78a81e994309a4a5a435030e29334668a602d26292a4152319452d2668003494bd69bb68620069b4b495402d21a0d34548839fad14536828534ca5a4a4c04a38a292a0076694d329d4c05a28a2800a5a4a514300a29334b4c43a92933486801d8a5a4cd2d3b0c2969053a9887528a68a33549887d2e6a3a766801d8a31482973ed54c4215a69cd49d6998a6322cd2548453315900dc51452d21852668a29805252d15230a4a28a04141a5a4aa01453aa3a729a403c52f5a402815403c54ca45414f15aa649381ef5347c9eb8aae95229f5ad04682083f8f3f83545e57bf1f5a62283dea611c4549dcfbbd38c56e8c453144133bceef4ff00269814ff00780a6e38e69f344aa06d7ddf85021d730089b0b26ff7cd2c56f23eef9978ff006a991dbc92b05de80fab1c537f78a700d3024432e3be2adef9edc8c9e7d383fd6aa9866450d9e3eb53c46e25618058fd299362d23cd8cf95c7f7b61a789fe6dc5726abf9ef8298523ea7fc6a6371b7e5d9b3e8a2a893d1b4e937c287da925cd47a4ffc7bc7f4f4ab4c95c26e605f0dcc16ad818a8e54ccb5676d5088714e66c0a791504adc52199f71362b98ba9da46cd6a6a77581b456166a843b350bb669ed5030f4a07a91be2a2cd48f5162a4631b14ca7eccd18a431bb69dd29714e150ca4434c35332d576fad03227a6d29a4a430cd3334e34cacc072d2e69b4669944fbab5b4e857cb9246ac315acb379716daa4c927b085267e45696a5e5463838aced3e423a532fa323ab568664566d97e4d6b562dab735b6a38a006536a4c51b280056a9035340a5db4124a1a9f51ad3b9a062efa50f4ca5db40b525dd4bbcd43cd3a958a25dd4799510a298ae3fcca5df8a675a520d003b7534b5252e29006ea297147b5210c73f29aa11b9abf3f0b596af4c19a294fa8e239a9f140c6d1b69fb68c1a006734549b68db4011f14629e450168022c52d484526da0061149b6a6db4dda69810e054645592b4c68b34c0a8c2aac8b5a2d1d556a91941f02a1c0ab92fd2a911eb48b10d355a9303d69054945d8a5abf1c958aaf835a3149ba901a226c54eb25660973ed5615e931a66d43355c6f9c5645bb56a21a835395d5ac0c6db8743590c7debb7beb51329ae3a6b5f2c9154a4449116f34f127ad43c0a05511764bbf3ed56227e6ab2465f819ad9b3d3368cb0e6a3986ae5b86792b4a1b907ad6611b2a349996a0d8da2e2a326a80baa905d66a8ccb5d29bbaab9b95a164cd55844f532d55e45595cd481148b51d4d25435b232628a29314bb698ae14b4945002d2d376d1cd02b8fa4e68c50452285cd26e346290d30137519a4a5c5040bba9779a660d141571fba9a4d1d28348665e69734ddb4e0b5c67ac3852eea67e340a43168ce2834d38a44ea41738a6da1345c74a5b4ad0ccbb2cb9e2a3a534983506b61314ecd3734ea0634d381a4a290ac3694d07149cd1a885a5db49d69698c766945369d8a4310122a514c14f14d923714f19a69a70a043a834829d8cd34414f3f355b83935531cd5c80735d071b3b9b6e56a7154ec14edf5ab950c42d2d253a900e14869450d400ca69a5a69a004a4cd14940051494b400e15253053e80168a4c52d020a5a4a280168a28a0614b49450213bd4d5054e2ad080d446a43519a60444d79febd77e74c79e0715dadfdc082266af3699c93d734446c85ea234fce7ad32b433187350b1a94d446828898e29b8a9314c348a128a5a406a2ec039a29693f1a043b349499a4eb54863c1a8e9734da6c0286a5a4a40368a5a4348625251484d201292969b49b00e28a292a005a5a4a766ac0296928a0028a4a335202d2e68a4a602d25252d30169775252d002fe34bba994b408928c53334b57718e14b4da7e5699214b4da70354026453a9b914a334001a6548d4cdb4ac0478a4a791498a818da28a314005252d19a5700a4a5a4a5700a4a7629298c43cd2034ea4a4224c8a2982a4aa0015266999a03534227a7d460d3b762b61176de38483b8b67eb42a7bd5543ef56cc5184c89496feee2b74ccda1f2420229126e3e9b71fd698aac703701f5a4d8d4e9a1311c07573fec9cd5fde6761640c8d80777d29cb04a416e31fef0cff003a44b79a427047e26a2df274a603c34878c1a9f7dcdbb73946aaf22cf17df422a6f36794e76b31fce9816a37900ff5631fded9533ce1db76dfeb5563b9931b7b7a13568ce071b36d3333bfd2670d12d68573ba35cfeed79adf47cd719b99d22fef6a6a64ebfbca7b714c442f54ef5f62e6acd606bd7f8f901a43306eee3cd6aaf4dcd06ac8173511634ecd464d234232d4c6615274a880a4002834014e2b50509c519c52114948047aacd53540f4c688f34da79a674acae588c69b8a28a818b45252d500f8c64d6a5d26cc0aa168bb9c55ebde5fad5c483534bb5f96b3751fbd5af63f2c7d6b06f5ceeab2505b9adf8ba5605b1adeb734c44be5d3761ab148528208d569714fc518a56188ab4ec548169db68020d94a054db6976d30d48f6d26cab1b69854d21b20db5204a90454e11d311179747975636d26da4041e5628d95636527974010eca77975388e8db408a1779c56329e6b72efa56086148a34e235716b3a16ad14a648fc5380a785a02d0323228d9536d14edb4015b6668d86acf974ddb40106da5d953628a008b6d3706a7da68c0a00836d308a9cd30d319548aaaeb579d6ab3d4819d20aa5266b4264354664c522915ea3a96a2a45055a825ed55a85734b419ad1b8a9d45508981ab51b9a9ba2ac69c15ab1495871c95a10cb9a865235366eac0d634dfe2515bf6e7349770e4549b1e7478a7c70b39c0ae93fb120639233f89a48f4c8ede4c8fca9f31972321b5d33c8e58e4fd2b44b01524b8c55079a9163257aa8643eb44b2d405bdea89246b8a68bac556cd29ab32e62d7da7357ac9f756544b9ad9b65a9b8d5cba0f3562aba8e6acb0a82c8246cd205a6b8a9c2d6e8c6447b6945498a3cbab3323d9498a971498cd050da4d94fdb4ed94808b6d262a629498a622322936d4bb2936d00441697152e28c50510e28c549b68a04438a2a52b4dda2908c8140a414eae03d91296901a753101a4345370690882e7a525b37b52cdd29b6f56645a39a5269ad42d41b0869e290e293eb4c053494ea68a401494a6a3cd5087502853520a431714e5a653c5001c0a92994ece6a443719a938a6629f5420a5a6eea5a6415bbd5bb71f3554ef572d0e5aba51c523b6b47c2d591552d7eed5aacd890fa5a6d3a90c7534d38521a006d34d3a99400da4a53486801b4b451400e53530a856a5a005a28a28105145140c5a2928a005a28a4a004ef562ab77ab15448951b54950cad8154072be27bdc011648cd71acdcd69eb375e7ccc6b3335a2111d23521a4a352061a8e973487141a1131a6e69ef8a69150037752f1da8e2916a862e2900a775a4cd480d228dd4bcd253d0429c0a6d2d19a4c625252d3698c5e949494548094da5cd2134009494b499a9012929692900b4ea68a5a6014b4945301d494514804a5a296980629314525201697348692980b4ecd3334b408766969b4b9aa18fa5a8c53a82478c52d34514c63e8c629b4b9aa10ea4e6933413400b4ddb4ea3340b5223495215a6e3152323a314a692a461cd145140c5a31494b4c425252d2520129f9a6519a432614ea62b53b1569887834f0bef51e3152568881ca6ac2f355853c1c56d702ecf07958c49bcfb0a122924603280ffb4d8a4489db1c8cfb9a47dc8dd777d2b531172e0f1cfbd2b4532aeec71eb424529c918c7d6a2f364618a61a8f5926930305bdb93520b99623c6437e54c2d342c32ac87e98a37bb12d8cfbe29813c52b01d31ef8abd25c098ee6527f1acffb6ee4da7eefa55e8af546709b734c9b1bba65c71d87d2ba6b59ab86b3bad9c60d74567a845fdf5ffbeab95a28db953241a6bd35ee63db9dc3f3a73e08ce690ca334cb082cdc0ae16eeea49dcb1adaf10ea3ff002c95beb5cd6ecd5a450ea8ce4d2b5479a091d4d3cd30b52f148a10b5369d8a4a40252d252f348ab898151914a69b9a404669b8a76dcd254944456a13561aab9ac86368a292a0a1734b4da70ab02ee9ff007e9edf3494db2ee696dbefd6841d0636c7f2d7393e735d04e5963ae6dce4d02458b7cd6e5bd635b035b115512680a4e2a356a7e68247f1453334ea60494f1516454aa6801714fdb8a3a52d20b094e0293ad3f14805db4519a314c05c52d1d29339a601b68c52519a402e2929d9cd2b502336fb3835cf035d1df7ddae6fbd22ec685bd6b475936e0d6ac54c45a02940a686a7034122814628a5a0a1734628a5cd00336d1b69734bba8121b46294d274a6323351b549baa1634088daab39a999aab48f4868824acf947ad5c964aa5292682ae415132d4d8351e3352511e69a0b53f14c06b3196a37ab6b2566ab55a06a19773422cb56c5b5a3d67e9d1ad74b6e0506a2a23c54f91c115708465aceb8f9454b2919c6e421a8a69d4f3595797655aa03744d2b0cd19aeb7f7aa2d2d57f35bd699baaec6649bff1a6eecd3375266999ea3f069e232698b56370a770561f1435a7171596b26da985d1f5a43b1b10be4d5b6e6b22d2715a9e6d4328695152815097a951b35ac4ca485c668229f495a990cdb4629c69a6815c314aa29053f340c314d229f49400ca314f229334086e280b40a507340c4a3ad2d21a004c5331526699408c25a71a45c51deb84f64318a7668c6692a409522dd43fcb48188a9dd3bd324cd9b9ed515be79e2adccbb474aab6ed9ab332d914801a29c0541a91b714f5e69186691298c7b71481b343d20a90ba0a8f34fa8e980fa9299520a0637069f9a8cd4894891dd28a334b40829d4ca70cd002d2d3714f04559054ef56ad87cd55c8c9ab16ff007ab74714cee6cbeed59aab61f72acd66c42d3853453e818f1486814500369869f4d34011d369d49400da5a4a2801eb52d46b525002d252d250014b494b400514514005149450213bd4f55fbd58156212b2f58bbfb3c0e7fa56a9ae3bc59779db1fe35423906351114f7a656a46a4669952546dc540dc44db8a61c53f351c94cbba23a4c5388c5373486266928dc69295c62fd2928cd21a910b9a68a5a4a6ec02d1ba928c9a005a6d3a9b4d805309a5a290c65253b8a2a4436928a290c4a5a292900b4b4945002d1494b40053a9296980668c5252e2a8414514521898a2968a40368c52d140094ea4c51400ea334dcd2d500fdd466999a5cd0225cd2e6a2df4ecd3b81250d51e69d4c05a29314b4121498a5a05003714da929869b18da6d498a6540094b48296a861494b4526804a6d3f753690c01ab01aaae29e1a8405814a29a86a4c56c40b49ba93834b9c530275964f5ab291c8d9231f9d538f754c2671c0ae8460c5591f9c53e459620372eda6b0955738e2977c9263e563edc9aa024f3279ce76bb9fc4d22de3282beb4ab3c9137753e94cf5f96a8a1565dbc803eb57fedbe73ef2809aa2d78f22aa9e71566deebcb3c28e462a8cda35ecf130e7f955afb09ed55b4d3d78ad715ccdb2ac8afb658a3eff009d5bfed2920832fb6a9df4fb56b0b50be69b09bb8a77158a92cf24a4963b8d479a6d216a450aed51e68cd26ef6a92838a7134ca5e6810ecd14a28c52189b4530b0a7919a8aa406b1a6734e7a6f341426294d273de9690d1131aaec2ad11503d448a21a4c538d25645053862995255016adf3b4d496609718a8a36c21a9ec3ad6c666adf4aca9d2b9eeb5b57f3e056329a408bd6d5a886b2edc56829aa2196b7549bf150ad3bad324985381a8852e6901386dd52ad5756a995a98589b34f0d55f753fcca43b930a754029dba81926ea707a87751bc50326df4bbaa0df47994c449ba9e1aa0dd46fa4227df4b9a801a76ea068af7f228439ae5c1adfd45be5ae7c0e78a0ab1af695a71e6b2ed38ad247a441353c1a83cca7669889f70a5dd55c31a379a0658de28f32ab6fa5f3681931928df55cc98a514c9b936fa6f99516ea6339a0a24692a02f4d2f519340031aaef21a779b513b5486842ef555f9a9641509e3a501719cfd299b2a4a2a4d0ae547bd32a622998a0088f1562293dea06340c8a92ce96c9f1e95b904f8ae4ed6ed056b457758b3a558e87ed23d6b3af2f45517d43deb2ee6f4b77a43285d4a5daa2576f5a5606987f2ab39893cc34edd4ce29eab40ec2609a9516947146ea06389a6f99519a0d513624df49e635331f5a5a0762edbdc62b47edf8ac3dd8a5dec6a6c51b22f779c56a426b02d11f3cd6da356a8c1b2d6ea37d56f329c5aacc89c9a4cd43e651be8289c519a8377bd2efa044f46ea87cc346fa064a5a9371a8f70a4f3334058937d01aa2de052799480b1be8dd55f7d05a98c94e0d37351b3537ccf7a05a197b714526ecd1c9ae03d91d4714cc8a29d809d572455a918553dd5614ab5519b21d43fd5d67da55dbf19154ed7e94d99a4596a70f969b4e5ac8dc43428a53466980ac45341a0f34959bb0838a4a314d3543145482a2a969808b8a900a8c0a78a091d4ee6a3a7d2188d525338a76714c43a8a6669d5422b679ab306735576e4d5cb7519ae8470cae77365feac54f50d97fab153543250e14b494ea918f1494514c06534d3e98680194da753680128cd1494013253ea34a7d003a933451400519a28a04145145030a28a2810def562a01d6a7aa01ae6bce35eb9f3ae18f61c57a0de4c218d9b3d05795cac5b9feb5b22484e6a334fcd37354031a9879a7d45d6a46181519a730349c548ac46c29a453ff1a2995623a4e28229306a4419a4cd2d145c6371452d2f5a2e02114da7d0280b09c8a0d29a6d301869b4f34da901292969bd29001a4a29290c28c514520168a2969805252d252016969052d50052e6928cd002d1451400514b41a004a2968a7a00945145201b452e29314085a2928a431f4b4da5a0077145368cd6803c669fc5454fa091685a6d38b5000452d1450014d229d48d4c647b68c53fad1b695808e929e6995230a28a290098a4a75371480915aa7077554a9e16ad108b185a8f7034a4d016b510e5356d63b8dbbb6fcbf855335a5616f7375fbb89249bfd85e6b45233e522df238c633ed8cd4dfbd84e76907f2aeaad7c0ba9b61e5105b0ff00a692f3ff008e8ad84f086971f37570eede8adb0566f134bf990d40f3df2e4724edfce9bf6970a63ed5e9eada4d9e45b40a7fda6c9ffd092b8af10c63ccde23033dc2d386222cbe5f53081d983b71563ed6f23e4c6189f6351bdcc93ed182d8ff00669c97725b13f2e09ff66bb0c0d9b0ba2702b692b134753291fbbc7be2b69d4c7d6b9e62462eb373ce335879269f7d726490fa542282876ea6139a526a1cd201e68069b8a4a9192669d4c5a7d031578ed4edd499a6e6908424544c69c4d3188a0a0a4c52814b9a4034d20a2af69764d7132ad0323b9d36e60037a32e6b35d715ebd75a5c1751ec6518af39d5f4396c9b0c323d4038ac79ca300d369ed4ca9285a79a60a7b5302d71e5d59d3719aa8ff7455ad3f15a220b1a9b21aca4ad0d4b69acd8e9dc0d186ae06aa9062ad0aa21a2d2b538542a69c0d316a4fba901a653866802606a4f32a0dd4f14c9d498353b3512d2f3523b1386c526fa8cb5301a4327dd466a32699bf34c0977d2ab543ba8df4089cb53726a3df4df3281327f30d3bccaafbe8df4c3520d49fe5ac34cd6aea0dc565a541a235adf357d4d5289b8e2acabd5124a4d2eea8b751b850225df49e6544cd4d268113efa4df516e346ea0d09435064a837e3bd1e6504126f34ddf4cf3299bb8a0090b544cd46ea61a06266a167f5a79351b9a07623350915311516da430a6eda7e693140c84a54478ab26a12b9a8195cad264d39853690c787db5716f2b3fad381a5645dcb6f727fc9a8b7e6a0a7034f9464b41a8f9a5f32b3025e694d43be977e7da95809b75377547923bd389c74aa01ff007a8e2a3ebde8f3168b85c941a46f6a66ecd481ea896c9162cd5d8add455546ab31bd511cc5e4c558df5451b1e94ff32a882def1479b55b751be901737d26ec556dd417a632d06a50d55d5e94c98a62b1633ef49bea012526fa432c1614d2fe9558cb49ba988b3ba826a0df49e66681d8b21a8df55bcda379a4512eef7a38a877d377d33321347e340e691abcfd4f6829e29053a9885c7a53d50e7b7e34cdf8a8cc94c0b3a88f92b36d8d3a7663ff00eba65b55b312dd38134da51591b0d6a5141e6815621cd4da730a68ac8029a4629e292a8600d2e2a319a9b3400ce69e84d3714b401213453734eaab0829e29869f9a81098e69682296b424af1fdfad28bcb06b2ff008aadc19dd5d071cceeacfee54f55ec7ee55806b3640b4f14da75218ecd2514500369869e6986801b494b494009452514012253e9894fa042d251450014b49450316969292810b45145003475ab155fbd58aa4061f89ae3cab63cf5e2bced9b35d878c2e3fd5a7e35c73006b744116690d38c74ca6491fdda33ed4f2b9a86a4b10d2538814c348a12938a439a4a06328cd069315202f5a5c5251cd3d04251d296969e821b4bc52f4a6d49421cd14ea6d310c34da71348695c6369296909a80128a4a2900b494518a005a2929d4c04a5a28a000514b8a4a005a2928a005a2973494c05a28cd153700a3a5252d580b9a4a28348414519a2aee0262929d495030a2968a0028a4a4a603e9734da5a770b0ecd1cd36979a621d40269053a90c5a3349495421734a4d26294d031869314ea28d0447453a9a6a462514514805a41914b494202ca11529c62a986c55956cd6d7244ad3d1f527b3995d7f2db9acec5206a9921267a8cbaf1fe399bf0ff00ec6b3e5d71057230cf391cca71f41fe152c70176e11a43fee96ac638229d446b4be23fee927fdd8dbff89ace9f5592e8608e3fcfb5315de02c36a8cd22249b4e1323fbdb6bb61878231f6ac8cf9b1e0e0a7d57149be495f7ecddff0001a492e259b00e5f152fda6784fddd9ed8c574991b5e1c9cc93aa91c735ade27996d22c8e18d637874c892a65081ebc8aa5e25d5fedb3e324a2f1d78ac24688c60f9a7d44a68dd505e8485e9a066938346ec501a8bb852014ca91690029a901a68c52e6826c3b9ed4d34139a8f348a038a6eca51834ea004a052d373482c0bcd759e13b02cc6423a572ab5e95a159fd9e05f5a8917635b159dab6951df4454aae7b122b4a92b9ca3c66f6d1addca918aa46bbef17687ff002dd33efc66b83618ad006ad39a9829e473401230e2ae590aaaea702ad5956a8cc4be57f5aa698ab77ce6a9a5219a30f22aca55286ac839ad045a56f4a7648a851aa4dd4124e0d3eaba9a9b340c7eea75479a5dc4504938349b8d43be82f4864dbf148ad50eea3ccc50226df49baa10e29bba81931929f9aa99a5f33340ae592c28e2abd1bbde8026269378f5a819a90bd3115eedce2a9c679a96e1aa08aa0d0d689aae06ace8f22acac94c44e5a937543e65217a044a68f32a266a6efa65244ad252efcd57df9a3750413e69379a8b76da412d21936fa66ea8b7d26fa2e04b51934cf3293762a807e6a3269be69a335031bba9318a766985c5300a5c9a4de29a64a458354678f5a7e7349489216a8cd49d2a32290d0c1474a760d26ca92c28c51f9528e2aae1a813480d230cd2e45486a21349ba8c52e2900b9a7e6a3a786a6029a41494b4582e3aa55150814f14ecc9275a9c7155c54a92d508b41aa4dd554354bc52113f998a457e6a2f3051b8531345a2f4ddf5543d49e65319677533cca8b77bd2190d2027de697cca801068dd4ca262d49baa03252e6811629adcf4a6339a8b79a064e3de9d9c557dd4649a408977d26fa883534fd699996290fd6ab7db569af7a95c7667afcf12ed2b553fb70f4e693edded4f945ce8be4546c3f1aaad7e7d29ad7c7d3153cac9f6887dcd16b8a8249d9aa6b2e7354c8e645b34b9a630a51516371734525385242b0a6999a7d302d03066a4f969dd29b400b835253296800a51ef4da29887d3c54629d9c51601cc69c0d329c3da988534a290d385505ca79e6b52d7cbc8acbfe2abb6a3e6ad8f3e476568c715741aa9649f2d5c152c4870a7d329f523168a5a4a0069351d494c3400d34da534da0028a4a5a007a5494c4a7d002e29334b4940052d14940052d251400b45252d0020eb53543dea535684703e28b8f32e31fdd18ac03573559fcd9e46f7ed59e4d6d610dcd4669cd4ce69883754669e699dfa540c69c530d3ca8a6d301b4d2451c8a4eb48626292834ddd5231c314b8a60a76690682d2514b4c4c4cd145250c0534dcd1494806d34d3a9a4d21894da7536a40292968a6025145152014b4945301f494945301d45252d03128a28a042d18a29334c07668a4068a402d18a4a5cd0014bc525251701c68a4a7559225253e8c52288e8a762908a40252d1499a4014b466929800a7d329734c076696999a75580ea292905021d4b494548c5a6d2d2531098a4e2969334806e28a28cd48051452d31895246d8a8e8aa02e07a0d57493153f5ab209ed59b76073f8d6a4b35ddbb65976bfa06e7f4ac44664e95a28679987763eadfe35d1166722c44f70ed9552c69a2e241b938fa669a659e17c7f17d6a454b9219827cbebc7f8d6c6431dae1141d8631ebb314e0f3c877eddfef838a4f3ee65da07cd8ec053659ee23dc1b20f714c621d527887cadf9550c5064dd42f02b99b37b202b4cce6959a90715204c3151d216a4a007d38520c52d2024cd217a4df4c34087e6931428cd18a063871462941a4c5210869314fc5371408b9a5daf9f32ae2bd46350a00ae2fc2767ba4327a577158ccd105252d2d645156eed52e63647e86bc9b56d324b390ab0af61ae73c4da08bd8f7a01e62d34c0f305eb4f239a7795b1b1fd2987ad50124adc0ab767c55493156ad2b622c36f994d544ab17a05578ea465d8f8a9d4d578da9e5eb424b409a706aae869e1a815cb5914f06ab838a3750265add46ea837e29be66698160b51bea0dd4d67348342c6ea6eea8b7d267f1a01935064a8b349c521ea49ba949a8734bba8b8c9f75337d43e6505e9104dbea266a616a631a65684331a6a3524a734d5e2819a48d536eaab1c9526ea044a4d3779a66fa6b1a450fddef4bbc545c62937629887efa5de6a22f49be905897750ac2a1cd345022732526f3519614dddef482c4b9a42d516ea4cfad5012e5696a2c52d031c29add79149e66698d9a621d4869a1a937d4943f732d3693731a5068010b0a8e9dc521a876286b1a37526680d4869894ec5251c5310628db4e181de9290c4c52514b50018a318a5c536ac18ecd0052114645210e1528c5458cd3a98c9064fb53d6a3a729a62265db4edd50d2f9b4c3424df4edd8aae18549bc502b92ef14fdf500f9a9cad4c44b9a5249a8739a50f8a63b128a335106a52deb485a1251e6fa71516ea6eee699259df4d67a8f2a3bd21348be624cd2eea83e6a76f1400e2f41a8e9c1a8207ff67afad3bec11f7ab269718f7ae4e63d4e44571671d3becb1d4a29d8a572ac8812ce3a56b487fc9a945389a4993ca8ceb88d47b5496745d52d9568459165a9d4503dab3371a78a2948148726908534de69c6900a6201453a9bc5218669c0d3294714085e69415a29b5403853a9a169c3eb4862d3867b523538549229a51494b5622b77ad1b05cb56667e6ad0b4245741c723b5b4395ab22a8d837cb576a5998f14ea68a515231f494b4d340086a334fcd32801292969b4009452d1400e414fa6a1a7d002d252934940052d2525003a928a2800a28a2801075a5b87d884d277aa7adc9b6da5fa55a11e693364d41b6a46eb4d35d067619c534d29229b5031948c7346692916262a36e29e69845310ca4a71a6f140c4c53294d262a442d2f14da054dc63e8a4eb4022a843b229b4b4dcd318629b8a5a4cd4dc62534d3e9a6900da4a5a6d480514945200a5a4a51400b494b49400b49451400b451450014b494b540068a292900a2929692980b451474a0414b494520169d9a6e2901aa024a293345318b498a5a5e2810cc526da7d21a63194b8a76da4c54086e28a5a4a0614a28a4cd301f9a5cd328a7710fcd3a994b4c028a5a28109b68229682282911d21a7d25480c14ea6d2d021690d19a5a0618a951ea2a4a6988b84d4b1c8e31c9fceaaa499ab76b1f98d80d1a7bc8f815ba666cb914770ee76f27af26812cff32fcffd2a2cccadf293f5dd532c53052dbc63d03d75a31b123fdae3099c8f4c60ff002aad34b39dc7f3a9835cc9b7fae2b3e776279349c8a4474fa414c26b94d47f148714dcd44c690c90353c5442a4aa1138c525337519a900a29a4d39715231c17de9fcd029c07ad3402014014b499a0803c53d7e94ce2b434cb6fb44aab4868edbc3b63e44038e4d6d53218c46a00a92b9cd04a5a29290c29314b4502388f12786403e7c4bc7702b8520e6bd975100c3267d0d78e38e69a18f963e9562d63cd56909ef566dc915b924374ac0d4494fb9909351a0a90d4b2b52839a815aa70462b410fe94fcd43934e069089569f50f98694bd50896a3dd4ddf4da043c1f7a716a8b8a37d2192d3b79a8b7519a61a936f14da66ea41482e3f345333ef41a005cd19a8c9cd2eefa5020268349914d3c5050c734d56f6a46a6a9a8197148a933502d498aa0b0fcd2335337504fd2810f0d4192a20d49bb34c07e68ddef4cebd69030a801d9a5045337519ab631fd29a69a5a9334ae843bf1a7d441a9b96a422506804d474e04d030e9464b7d28dded518a65587eec5328cd3335231e49a534ccd20268b887d328a33523170b4628a3348a0a5c0a6e7f0a298893029314d14ece4d4805331526ea61cd310e14dc53a901a1dca006940cd3697f1a091d4b4537766a86c7e28a4cd2d02b0fdc7bd008a8f2f4bba98f424dc3d690e698714edc4502b122b53bcca801a753d056250f46ea8f39a5cd02d4928c1cd32939cd0325e05273e9485a8cfbd01a0b9a5ce2985a978a07a0b9cd0f519a70a007f14d634da43408d4fc69d9a43495c67ac2e453c9a8853ea44381a56e6994edfea28b1053b8a5b4a75d73d292d54d6a4dcb0734e5a4a55e2b2340cd23504d156019a050714df9aa2e019a70a667e94fc1a621683cd262834862525296a6814c078a771480d06801d8a7f34ca9293244a5cd0452722ac455ef576ddf04554ef56221cf5ad8e2676b60415ad0acdd33ee568d43247e69d4ca7500494868a4a006d30d3a9a680129b453680168a4a51400f4a7d3569d400b494b49400514525003a928a2800a5a4a5a004ef58de299316c47a9ad7ef5cff008ba4fdda0f7ab449c339a6d39b14ccd6c48d6a8b753cd338a076129a734e39a6e29143734da334d3520045368e69281e8369b9a7e6995021334b9c51c5068b0c4cd3f34da5069887669314ea4c8a7718da6e2968a4019a4a2834086534d3cd32a58c4a28a2800a28a2900b45145300a31466969009452d1480314b4945580a28a4a5a004a28a290051451400b494b49480296928a621d9a2928a631d4b9a6e69334c0938a0d368cd1701d452519a621714da766978a18c8e8c5498a6e2900dc518a753714c05a5a6e296988752d2514c070a4eb4a29280136d34d4b4d3486478a4c53b148680128a28a401452d25020ab11c9f8557a50714d311af042d2066f3635c7f7e5c1a5513e38e9fef0ff1aa96ec4f7ab8d0ed8f709327d0576a660d0ebaf36dfacaac7fd87c8fe554072734e9598f53fae6900a86cb0cd30d29e2a1794d62cb0dd4da4a70145c63c5381a6d271542242690734deb4f02a407014fc629a05498a621453ea31f5a5a4048334940a33410ec2835d6f852c724c87f9572806eaf48d12d3ecf028a89329235296928ac0d028a28a062514514014b53ff005127fba6bc79f86af62d471e4c99f435e3d275a690092499abb6d262a94956edb02b52482e9f27a542a6a4b80a0d30629012a9a93351834fc9ad007eea01a606c53c355089b3485e99914deb40324df4dcd368fc6825066941a8a9f40c97752669864a707a48a24cd1ba980d3722801f9a5a8e8cd021e693a533753854b186690d21a4614011b9c5341143fe74cc5202d034fdc2a2538a52734d887eea4ce69bba86cf6a0a168a6d038a7710b9a334de68ce690c750b4d7a68a043c9a4cd36948a800a5a65255e803f3464d368dc6810fdf498a6e28e9543149c520cd2519c56630cd206a0e29375048e0d4527142e29962d2529a4a91d80d28cd34d3b34085191ef4526696920169334525506a480d202298681405c7353739a39a4c7b54812647ad266998a7600a603f342d338a50d8a604849a6e4d2039a01c5201f4e19a869c5a8b8127148dcd33229d5483ee1d4a4d30f14e0734098e5a56342e29acd4c05a5dd4deb4ab430b0353b75349349bb340c7e69f5152efcf6a9d4131b4f3ed4d241f6a4ce6a846c7140a422941ae13d2107d29dc50b9a28284cd2d28c5211541a156763e956eda3dc2aadc9ab7613e4559831cd195a8eacc928355871d2b335e61c569b8a750698c5a6d3b8a69a5610c6a783ef4dcd342d3192e6928a4a402934800a31405a810ea71a653b06a84c41520cd329e869b10edd4139a4a378aa115bbd584aad9e6ad475a1c6d9d6e944ed15af593a674ad5a4c843e9d4ca7d031f4868cd21a0065369d4d3400dcd25149400b452529a0072d3ea353525002d1494b4005145140051452d0018a28a2801bdeb93f183f310aeb3bd71de2e7fdf27fbb5a211cb3d44726a5351b56848ca6134ec5369922547521a8ea4ad469a46a37521a0a194529a31520329314fc5369009d6814b4714b51886968c53aa804a6d3a9b481894da7525310668a4a5a431845253cd47520251451480296928a00334b4518a005a4a28a002973451400628a28a7a0051451400b45369680168cd2518a40145145500b49452548052d2515402d2514520168cd251400ecd14da33400fcd381a8f34034c09334b51669dba9dc092814c06973400514b455084a414ec525201734a69b8a7629dc05a08a4cd2f5a62129b8a7d262801845253f145218ca4a5e4525200a5a28a431eac455cf9b6f26b3eac2b1ae88333245e69fd299b6a377a06124a2a1a4e69d5050b4ee94ce697352217349494f4aa10f1522f34dc52d318fe94fa68a5a0916940a6d3c5003e954530d2d04d8bfa75a19e655c77af4d8d702b8af0bda6f9377a7b576f58ccd05a28a2b32828a28a002928a4a0452d53fd449f4af206eb5ec5a87fa993e86bc78e6ae2035c60d5a885536cd598d8815684433f5a62d1272690521938a5a8c1a7555c43fad14de68aa4c4494b9a67345500e3498a6e697348414b9a29b8c5058b9a75369b9cd4e8226dd4ddd4deb4502241b69722a2cd3e8d4614b4d1499e695c760cd1ba8e69b557248da81413466a063f34e269b9a6d3d463e9dbaa306949a431d914b9a66685a64dc7d253793466900a5e9b9a0d262980b4b4dcd2d200a4a29280169734ca526801f9a4dd4da298c713ed4ccd029715020a4fc28a4cd031d452526698c7e69334dcd2eea5700a51494555c0767d696994ea80149a334d3466ab50168a5dd4ca005a7034da4cd201dcd1c9a4a3346803f81ef499a6d28a043f34829b8a50d46a51270692999a5c9a090a7f14ccd15403c53875a6eea3346a0499a6b628e69a7e94863f751934dc51c5580fdd48290e3d69775000453b351ed3435201f91460d479cd3b75222e6cfe14ee697ad26eae3b9ea88053fad2014ea2e17198341a52734550cab70334eb414d9e9d698f5aa322cd295c534e6a70322a4a22db471de96a36340c9300534518a2a406b628c52914ddb8a603c535a9696a47713340a4cd15648ecd3a9829d50161d9a506994a298c969b4520abd082b77e956e16c9aabdeac439cf15b2389d8ebb4f7ad6cd64e9f5ac2a5889053aa3152d200a0d2d21a006534d3a999a004a6d2d25002669d4da75002a549518a7d002d1452d00252d14500145145001452d1400def5c4f8b31e7ffc06bb61d6b87f167fc7cfe15a444ce6cd31aa4351b0ab204a8f34ee698d9ed40c631a66ea71e298691429a4db451cd301b8a4a7668e2801a28229768a0fb5210ca314b41a40342d2d19a4c9a6014da5a4a91852519a290c4a294d14c04351d4b8abfa3e986fe7098f97a9fa526065e0d25696b7088ae6450302b3a9005145140052669683400b46281452012968a2800a29296a802969b4b52018a5a4cd14c05a4a5a2800a4a5a2980da2968a4014628a2800a4a5a280128a5a28012968cd2d301b4b452d003696969290c4cd2d2514087669dbaa3a5aa024cd2d459a334c44b9a299ba9775003a96994ecd310b4e1494b4c62514b8a4a04056a32b4fa71a6321a334e2b4dc54882acc62a14c54a64c53b003c98a83ad079a5a401452d3735571851452e2900a2a40298296a90893752e6998a750171e29f4c534e14c2c3b34fe2a3c1a9052245a728a4a923e718eb408eebc336db22dd8ebed5d0553d361f2a141ede9576b98d028a4a5cd03128a28a0419a28a2802adf8fdcbe3d2bc8587b57afde9c44ff004af2066e6ae232bb1353a48076a81b19a9463156882166cd141a70a431453b34dfc47d39cff2a535602e4d3bf1a68a4cd301f499a28a0414669734da005dd413494a2a6e5585069052e69bcd210edb4b4669bbaa8070a5e2938a43400ecd19a6e6969009451c52134011e3d6969b9a7548c7f4a31451540252d36826801f499cd3734a290ac19a293146ea431dcd37752eea414c029297a514804cd283451c50019a0d345396a800d37b529346690855a52d4da5152ca1334521a2980668a4145200a28c52e281584ce6979a4a39a4214d3a99c52d050fa375329738a005a6e69cc29b4030c53f8a652520b8ecd2d329cd9abd00052e4537340e69087134b8a6e314ea10c5a4dd4a69bb714807eea6f3452e6ac4383d2f34d1466810fa5a419a6d050e268029334ec0029dc42714bc8a60eb4fa062d069a0505b1d2a405db8a1b1499a6b9a6268df069b8a5a5ae43d4108a5cfa505a9334805c538d274a5a622adce28b4a6dcd16bc559916cd4d13543b475e6941a93462b5475235376d021d9a6e29c29b400ea8f9a92999a0600d18348052eea430271494b4629923a826901cd3a80129eb8a6d3c115202d14669339aa132be79ab50b60d54dbcd4c95ba3864763a7356ad63e97d2b6054b250f1520a8e9e290c7521a5a6d00369b4e34da00434da5a6d0014b494b400ab4fa6ad3a801d4514500145145001452d25002d2d25266801075ae23c5bff1f1f8576e3ad715e2d1fbf1feed69124e63753739a73530fd6b4621ad519352631ef519a2e1a9116a4dd4bb699498c7d3734bda9b4142e6929734ca340b0fcd2669b9a3346802b7348452e28a9ba0b0c3494ea6f14c948334dc8a5e292a4a0a5cd2514001a28a53400daf41f08695e5426660373f4e3b579f8af59d0b1f6387b7cb59b03cfbc5498ba3f4ac1ae9fc6298b907d56b99a601452d1400b4da28a7700a29692900ea4c514ecd301b45068a40252d252d3016928a280173499a4a2980ec8a334da295c07521a4cd3b34c42514b4940c5a314669680128a28a004a5a4a5a041451466818b8a4cd14500149452d002514b462801b453b1494ac01451494c0334e0f4da29089375383d434b9aa4c64f9a5a87753c3d697245a50d49498a403ea32296999a4512a814d346ea6e73542178a294d18a4021a36d14b4c7a0829d4da7521051ba9b9a5a621d9a75369e2980e1528351714f0690b5250f4ab480d19aa10fab963107950727e9548735b7e1e837dc2fa7d281d8f40886d02a5a68a5ae5282929d4940c4a5a28a04145145032b5eaee89c7b5791c8a3757addeb6227fa1af2492ae205571cd3c535852d5888cad14868a00766969b4bc5210ea5a66453a9dc05a52d4ce696980e14669b9a3753017752d345266801d4b4945031d4034d1466900ecf6a314ce94e1cd0c053452514805349ba929334c43696999a5a918fcd2f4a6d14f401dc5266928a042d3b34ca5a005cd25041a290c5a50453722928b80bba928c52d200ce692969281852d36969922f4a3228c53682878228eb49499a571e82d341a5eb4de6988334b9a4c52e690052f14da5a45094a08a4c0a314c80a5a4a2818bcd2d27e945003a90d2519a0028e9474a2a4052d4edc0547453b05c5dc294534538d1701734869052d031d9a09dd49499a421f4dcd0d495403f229d8a674a3269e804838a0536941068ba18669d4c34b9aab922f229d9a6eea5a91a13752f141a4c5568029a03d341a5200a00dec519a3ad266b8b43d4d05a52b8a6d0314c91c0d2e39eb4dc5028195ae4fad2d9d32e454969546059e69b934ec51b5a958d493b545baa4fbab4cdd45894c5069280694fd28b0f512929cd4ddd40c1569314f1482a4045a5a052d50c4c52b53a9299371b8c5480536a45a800348052b536ac92be39a9905403ef54cb9ad8e36759a33f1dab6ab9dd2030ae8454b2490549518a5a4049494941a004cd369d4ca006d369d4da00334b4da280255a753053a801d45252d002d2e2928a005a2928a005a4a5a4a0068ae3bc5e3f7b1fd2bb31d6b92f180f9e23c74357124e3d854669ec4d309ad882326999a7b547d291a0d34cc5389a6938a801292973484d3b8ec1cd329f9a6934980537a52d26ea421fba94b530539851a0084d378a5229b9a60252d2668148614a28a2800c514b467340082bd6b436cda43feed79381e95eb7a2802d61ff76a181c5f8da3fdec67dab92aee7c6d17087deb85a6014b8a4a314805a4a5a4cd301692968a40252d1450014629334ecd3109453a9281894519a29009462968a601494b4b400da5a3145300a296929880514b4b4804c514b45031b8a5a5c52eda04369714519a7618525252f14ac02d25145310b494519a2c30a08a5a2810628a28a06368a752520131453a8aa0194b4b8a3152019a787cd37146daad40933410299b6969880d20a69a75218fdb4e6522a48e22f80334b704eec118fc2b4d4920e69734514b401b45293498a43171498a28a043bad381a6d3c1a6502d480034ca70a64928e3bd3853453c1a64bb0ee3e95d5784adfe666eb5caaf3dabbbf0bc3b6226a2433a3a2933466b02c5a28a4a005a2928cd001451494010dc8ca37d2bc8e5c66bd72ebfd5b7d2bc864ce6b4888aef499a731a0d30d0889a290e2945480b494b4550582977669b4a295c07e6929b45500fa6d1450028a534da28016969b45002eea5a6d2d4dc05eb4ee94d1495448b4b4da55a5a941d29b4e348680194b4515203a939a7526298ec1f5a5c52668e68b085a4c5252d1700a5eb494dcd218a696928a621d475a60a28b8c77d68a4cd2669885a0514715202e2928cd25500ea3349d692a6e03b8a6e69493499c5030cd3b8a6d14c04a7669b4ea061d28a61a70a0429a33494b9a431296928a62179a4a767349d2936160a2905267153a80bd68c500d14c052334a0629338a4cd003a8cd3451542b8eeb4a29b4b486068a370a2818a29d9a41499a621ca296928348614a1852500d5102fd6973e9466929d8a0cd2efa08a318a41a8dc53cd368dc6a82e8dfa1453837b525719e908c4d029d4845002819a7e16a319a7ec269014ee4d3ad296e63f4a2da36c559917512ac0da82a92ee5f5a71724530b12c8d55b9a9b9c5425e914870a764d11806ae1f2f1c0a62948a269e13d69e054d1dbb355197b42a51b4d6b79310ed4df2d7d054587ed0cae94eabaf6a87eb5499369e6958d149099cd2e293146691604d4a2a1a7834087d029a6945324a9dcd5987af355bf8aac262b7389a3a3d29f9ae856b13490b8adc152c43853c5329690125250290d00151d3e99400da4a5a4a004a28a5a00916969aa4d3a80169690519a402d1494b4c05a4cd2d14005149450003ad731e2f8f888fd6ba715ccf8bdf0b1d6889389c5324a9188a85f15a088ea3a71a8c8a0629c5464814ec66938a450ddd48c69c45371485a8d2d4a4d2629690c4eb4869452d21052b1349c521a2e3b8869a6834da402d1494b400fcd14945500b9a2929734842c75ec1a726d8221fec8af218c64d7b1db2e117e959b28e5bc68bfb907dfd2bcf6bd27c631e6dcfd4579b1a64894b45140c4a5a28a60149452d002514514802973494b4805a7e6a2a5aab80f294d2314a1e9dd69e803292a6d8298528b310ca334a68c5001494b4500145145031c052629734940052d1494c05a2928a4019a4a7629b4001a4a5a314084a5a70a4c53189453f6d2629ea21b4b4edb462801b4b8a7628db4ec0369714fdb494804a4c5498a6d002518a762940ab244094ee28a4a0634b629291e84a9d4631853e365ef43734dd9480b9f6af2bfd59e6a1df9eb4cdb4b8aab80b4ec0a4a4a63061494b486912252e297140a7600a753696a58c5e69e0e29839a90534c925514f1518cd48b564b255af47d1a0f26de31ed5e7f631f99228e6bd32050aa056522c9696928cd6450ea4a4a5a00296928a002928cd140114e7e535e4f758dc719fc6bd66519535e4d759dc6ae20527146286a6e0d51288cd141a291414b401494085a5cd252d031334668a29922d14da70a6014b4da5cd2285cd251494843a969b46ea631fba8a6d19a62168a2929318ea69345149821b4b9a4a2988929334945001ba8a4c528a57101a5149c52522875348a01a5a4171334525069887529229b9c52f1543169b451408052d26296a46145274a414c07834da7114de4d3017750d498a4da690f50068a3345224296834531894b4da5cd201734629a452d002d2d329734c07500fad20145480014ad499a281e826696929450203452e69280629149494ea3501bd69e29b4e34c04c538d34e4529cd318514b494c428e29d9f6a6d1406a3b75341a28db489171451b852e71545586d3f8a6d3b814804a5cd263de933401d0521a5e9457258f4c5152673e94ceb4f5e69922f6e2a3dc734e6e290355136239e4f6a4b79198d32e64e2a3b36abb1997c4941a62e6a67391e9525936415aa7b2ad27dda48630796e2989489ad2c4bf18ad23a3b8ed552d6668b95ad05d564f4aa399b654fecd74eb455cb9be32718154ea5809cd388a514ac6a4084ad45326ea9a9b40ccb2290d58987350523a86eea941a80e6a5cd2003cd3b6d379a5cd0055ddcd588c6eaaddeacc4d8adce568e9f4752b5bb591a5f4ad7a966428a9054629e2801f48697349400da6d29a650014da7669280128a28a00916969052d003b349494b400b4b4945002d14525002d2d2514002d729e2feb18aead6b90f1737ef13e95a444724e2a02454ced50b56a4919cd30b53ce698d5250d34da5229b4ae02e29b4ea46a0614da4c9a754d804029d4ea6d30109a61a0d333498837536968a918b40a4a514c07d19a28aa10bba9282293140166ce2df2a8f7af62518af28d162f32ea11fed57ac0aca4330bc4c9bada4fa7a579730af53f1237fa349f4af2d6a680652e6928a0028a28a60145252d200a29692980b498a29734c04a4a5a334804cd2e6928a007ee3520615066969812e3346da606a766aae20db498a7e69c280220293152e29b8a5601b8a29c053b6d3b011d25498a4db40c652d3b6d2e29088e969f8a36d3b00dc514ec1a29d806d28a751c520136d3a8a5aa18940a2971408314514629805369d451624294e29052d2b157128a5a4ab2429a5a909a6e6a18c6b53969a6954d4943a9c29a28aa245340a4a5a401466929d40f51b9a7669334bf853189ba8e28a2988752e29a2941a403a969a296a89255ab0b5596ac8a406e7876d7cc9c67a0e6bbd02b96f09dbe159cd75358c8a168a28a918b451466800a28a2800a4a5a4a006bd793de7df35eaed5e577830ed9e6ae20671a0d0d4366ac920a5145254dca16928a280169292978a005a2929681052d368a602d14940a0076692969b40c5a5a4a280141a7714d34b520146693346ea602d23514d34085a2929698c766929692900b49403455085c52514b53718da5a2909a910ea4cd148298c5a293346ea042d25068a062d140a3140013494514c05a4c9a28a005cd1ba929073482e3bad251482980ea4a4a5a431b4fa6d19a0414528a5a90b094514b8ab012968a4a402d1452531052e05368a6314d14515980b4b494555c028cd274a5a918b4a48a69a2aee03f8a4a6e29690852296929338a063b34ecd328ab10e069c4d328fc695c05c52d3694d1700a6f34edd41e69033a0a42714848a63495cb63d2b137146714c4f7a1a45ab01c58d480a81516e5c54753a8588a6901a2dcedf4a64f459a1e6b43165e56ab3b3d4d55000a937d2b9a5993038e94f00c842d41bea34958353462cea134e403a8a9bfb3828ce4565a5ffbd3e6d4b03ef559ce58fecfb86edfa8ff001a47d36f139f29b1f87f8d4506b7ff004d5ff0c8a927d5e7718134df8557ba2d45b7d36ee7e7632afb8ab2749907635243ae4c8b81ff00a08ff0a9ff00b53549feedbfe38c7f3a5a06a654d67e5f5aa0f7016b75f49bdb8ff5b2227ebfcbfc6947876c57fd6bbbfd0ecfe551a1472f24dbfa0a586cae65fb90ccdfeec6c6bb0b7b0d360e5614fc496fe66adb5faf60052d0bf68ce3cf87f50c67c961f564ff00e2aa9bc0f17de041fa5768d739accbf86395693b16aa3399a0d399706a36a48d2e561f7aaca37d2ab28e6a75fa56e72b3b1d3718ad6ac1d35cf15b950c81f4f151d3c5201f494506801b9a6e29d4ca004a6d3a9280128a4a5a0095696802933400b45145002d2d3696900b4514530168a28a0045ae1bc533ac93e3fbb5dac92888127a5799decfe7c8ec73c9ad22052c531b9a79a88f15a1244f4dcd398d34d41421a69e282ded494ae006928a7814d886e33da94f14fe299baa862134ca71702a335170109a652d254ea025380a4a2810ea4a2814ec31d4b4da75508334b4da5a606ef8561df791fb57a7579f782e1dd70cde8bfcebd06b19146078a0916d2639e2bcc08af4df1491f667ed5e68d548923a29d4da40145145030a4a5a2a8029d49499a4014e14945580518a28a801314514b4806d14b494c05a5a4a05301c0d3c49515029dc09f34b5086a90355087918a45a3ad1cd5122d379a50695a8284cd1498a7521094b9a4a534ca128a5a4c5200a29451412252d252e05310bc5145140c31452d21a041f8534d381a46c5002d19a01a6e698c52d4ca2999a402d1499a4a901a6a44a69a55a48a1c68a4a5a620cd3b34da514c05c0a4c5281401486252d04d253012968a4e2a405a752515402e453852002969a24955aa7439aad8ab56806f19a047a368d6de4c0a3bd69547100a2a4ae7285a05145031696928a005a28a4a0029296928108d5e57a80c4af9f5af536af30d557f7cdef5711994d48694f141ad0443c5369e69335231b45149480514b9a4a4a4014b499a2810b4519a4cd500b4b4da7508614945148029d49450002969b4b400b4bb4532968b80ec5309a5a2980da5e28a05480ecd2502814c0314b4b4d2698052d2519a3401314b4b9a4a900a05145001462973499a002928a2801734b4dcd293480292969335603f39a6f14515201494b49400519a5a4c500068a5a2800dd4019a4a5e940094a2933ed4b9a5a0094b8a4a5aa00a28068a4021cd2e68a28003494514c429a4a5a4a431c68e29334bc548c4a5a6d28a6214506929690c5cd1405a38aa16a29c52669052d31851c501a978aa158514605378a76ea900a5c5329734863a909a2937629899b6e698695cd3375721ea168baeda8569aa7de9771aa0b0f14a3dfa5346eed4d39a41a0db9618e2996ee7d69b73d29b6ec056b730668104738a70a60763deb42cb45bcbafb8a31fde2dc521ba8545dcb5180775755078431feb2e147fb899fe75a11e83a3c1d54b9ff0069cd56863ce8e5111cff00031fa0ab91e8d7b3ff00cb17c7fb585fe66ba7125a45feaa1897fdd8d47f4a61be73d38a2e45ccb83c2cff00c7246bfee8cff856847a369f1fde2ee7ddf1fca8f3c9ef4c6928b8b52d2b5ac5f7225fca90deb76e2a919c5426eaa445f370cdd4d44f35513746a233fe340173ed54d373543ccf4a46908a45177ed34c96e38aa7bbdea19ae28048aae726a3eb48c6949a48ea2a06e6ac46d50639a953ad741c6cea34c7c56ea9ae734cc9ef5d12d4322e3ea414ca70a40494da5a4a006d34d3a9b4806d251494c0296929734012d2528a280168cd2d140094b494b400b45145002d145140193aedc7956ef5e78f5dbf8a5bfd1f1ea6b86635aa26e4672698d4e22a3ab22e47c0a6e6972290907a0a45ea3334de69e01a7f4a9b14354628df417a6135448a4d349a69269291434d19a4a0540829296968d4031494537348614514945c05a7d3334e06a80052d29a31408eebc110712bfe15d8d73be108765a67d4d7459ac994731e2f9310639eb5e746bbef18e7cb1f5ae06ad086d369e45369886d2d252e690c5a4a5a4a005a0d1450014bd6928a602e69334b4da402d14514c04a29714520128a29698084d252d140052d2514807ee3520350d3aac43c114b51e68cd3b812668cd3734a71480752e699ba8cd301d9a0d369775301452668a4a403a8a6f4a5a2e21d9a299466980fa29b9a28b80ecd2134ddd4869a01f4da29b45ca128c514b50025068a4a402134e5a69a55a2e03e928a5cd5200c52d252d001cd145148028a4a298875329734953a80b4ea68a5aa01dc52d251934c44a1aa78ce2aad4c298cf54b197cd895aad560f866e7ccb70339c7bd6f5738c5a2929680168a4a5cd002d14668a6021a28a4a4006bcc3551899c74e6bd35abcdf5cff5eff5f4ab8818845295a534dcd59242d4829e6995250941a29334ae002968cd25200c5141a3354014b494520168a4a51400ea6d1466980500d252d210b9a5a66694d301d4b4ca7531899a6d3a9a4d4885a4a514bcd3180a0d25266810ea4a70a4a630a4a5a4a91052d19a4a430a2928cd002d29a4a5cd00251499a5a0028a28a0028a5a4a6014b4714d14805a28a4a620a7efe31c7e54da4a062d2e2928a06141a6d3a81066928a5a900a5a6d2d30168a4a5a00339a5a6834b9cd21e825252d29a62138a33494a29a01d4dcd2d25200a29734da00752d2514c050c452d340a5cd080524519a4a334f40014ecd21a4db5202e69f4d028aa18628db49ba9770a0426297eb4525023658537152b21a6015ce7ac22d28734f55a5a090069b4ec538ad408ab30fa5431e454f38e2a08d855a326580715d5e87a81d981815c8eead4d266da6a89923b1f398f56fd699bea8fda0d31a7f7a0e72d9b85a88ddfb556de299bea40b4d7269866fad552e69775302733533cda8f8a3140c37e68c50580aa771758e954348b26645ef5135ea76e6b3b75347148d7d9970de33544589a841a937d22ec069d9a6f1452e528adbb9a996a11d6a6cfa56e7248e874a20d7482b98d17ad74e0d4c8cc78a7e69829d480929a68a434009494525201a692969b4c05a4a28a009852d22d2d003a929692800a5a4a70a004a5a28a0028a28a00e6bc54dfba5fad710d5daf8b47ee93fdeae309ada24103537152e0531a9b158869147e1536cef51e6922c46a61269c690b0a42199f6a6934a5a98696a3133466928c53b8c4a40b4e1454884c521268cd36801734da29290c28a28a402d385369ca6a8078a72f5a6d69e8b65f69b88d3de981e95a4db7d9ede24f4157b142d15901c9f8c7fd57e3e95c057a0f8c17f73f8d79f9ad5086d475253695806d18a5a28189452d14b500a5a2948a603694504525001452d2d021b4b45252b0ee1452d1540252e28cd2669006292968a004a5a4a2900b4b494b54028a5a4a4a402d2d252d55c56173452668a062d1c5145021681498a28b085a292945300a518a6d14c6069d9a4cd18a402514ea6d21051475a2a9141494a69bb6908292969290094e4a61a72d48c7134521a5ab00cd2e68cd140838a4a2969085c51499a0d318b452514c62d2519a290870a5a68a5a901c0d4ea6a0a905592759e13b8daed1fad76b5e6ba2dd7933a376af48159c8a1d4514540c5a29297340052d2519a005a4c52e6928012bceb5f5c4ef5e8c6bcfbc48bfbe6aa881ce9349c50d498ad89223494e34de2a06371494ec5262958625253a8a401494b8a6d002d3a9b4b4c02969b4b45805a6d141a005a4e28a50290052514b4805a3340c514c04a4a7532801453a9b4ea4014945154018a5a4a4a007525140148414b498a28185145266900a4d252d26298052d252d0018a01a3349400b452514805a28a4a02e2d252d19a005a6814a0d140051498a281052d25140c09a2834502169734da5cd055c296928a42169b9a5a0530014a69052d218da5a4a7034f500c5253bad3681052d2518a005a4a5a6d031dc514945210a297ad1494c05cd02929d8a60274a514b41e290586d3b0292835602eda51485b34991401bdcfbd21e29fdaa322b90f4c10e69cd4838e94ea062629bb8d398d005022bcf5523535725150415a18482af594b8351f91446bb0d05337fcd3499f7acff00b77b5466edfd7148cb919a9e605ea7f5aaada9c0bd1837d2a89726aa3c409cd31389a4dac7b54f0df07ef5cf9c8a58dc8fff005d5588b1d4efa5f305624574f8ea691e795fa9fca8e51d8d59a523eef3541f27ae69915cb568e11fb54968a192293ad4d2a63a54348d85a75333ed521a041c53f35153b2690100e0d4aa6a0ef530adce36741a18e6ba7ae6743eb5d35432470a75369c2801f4d34b8a691400949451400da4a5a280128a4a5a009529691696801d49451400b4b4945002d2d368a005cd2d251401cef8a57f71f8d71078aee7c518f247d6b88c56a82c4250d14f3f5a61cd51231b9a876d4ad9a89aa4069351b53f8eb51b505094d34946ea002969b9a5a402521a29b9a900a4a5a514804029315252714ec0328a7eda0d0c0653a9314ee2801c39aedbc17a7e77cc578e80ff003ae3615dc4715eb1a4d80b38113033f4a4d817e8a292a46737e2dff8f735e74d5e91e28ff8f76ff1af3635aa44894da5a293b80ca5a53451a8c29334b494805a70a4a502a9008714da7902a3a1887814ee94da753185262969d45808883494f34da560128a7d262900dcd2d145301b452d1480052d369695c05a28a6e6980fcd29a8f34b9a2e03a941a683494c43f346ea6d2d002d2f349453016969b9a76ea62169b4a2834f51894b452521051452548c51452515630a4a5cd02a6e0252514bc5488653d6994f5aa1866945262945021692969290c29692978aa10514945002d14628a4312968a28d4400d2d2514089145499a8969e2ac65a88ed35ea169379b1ab641fc6bcad6bd0fc3d3efb641e9c5673123668a28acca16969b4b400b45149400b452514084cd709e26ff5c6bbbae17c51febbd2aa2339734869e6984d6a411e29b8a5a05414340a294d3690c4a2968a2e021a29334b4ee02d029296801292968a40140a05148028a28a6014b494b400519a4a5a4212929692800a752633450316928eb45310a2929692818b4628a0530128c53a995202d14514c001a2929d40082968a4c5200a28a4a005a28149400ec51d29052d171813494714521052d25255085a4a5a5a43128a28a005a2928a004a5a28a000d19a28a900a297345558028cd14550094514b9a900a4a334b4009c538525250038d21a4cd2d301d8a402806933400ea6f34ea4eb42180a39a4a753100a28a2a405a39a2839aa18868a39a0d1a88dfa61152530d72dd9e98ab43520a5cd3b885ce690b530b505a90864bc54109c9a9ae38155e06ad0c5b2f6699b89a51484d4ab1b5c76694547ba945590c7e698cb4a29acfc502d0898534119a639cf278a9aded5a53c03566372414a2b497476ef8147f657be6a47cc8a29c55c8aec254325acb1f51517141a685b3387ed50b53d63e2a3635030eb4b9a4cd2e2818669d4cc538668b015fbd4c951d4a95adce46743a24449cd74b5ce691d7ad744052640fa514da75202414d34521a006d2668a4a004a4a29280168a4cd19a009453e98b4fcd002d14514805a5a28a60368a5a280168a2909a00e5bc533fdc4cd7258ad6d6eebcf9db9e2b24d6889646cc2999a566a81a4ab15c576a83752b1a8b3415714b521a613495030a38a29b4ae01466928a403b3498a4cd25003c52d328cd5087519a66692a464a0d2f06a3dd4a0d3b80fc53697752d508e97c2ba57da660ec0ec4e73cd7a2d711e0cd4154b427bf23fce2bb6ac58c5a2969b480e77c56f880d79cb577be3093f7407bd7055aa15c6d21a76293ad5086d3a8a2aac5086905389a4acc029c29b4b4c071151e2a5a6371540369d4da70a9b80b9a5eb4ca70a620e29a69d4940c76292939a4cd201db69b49ba933400ea4a6f34b86a400692976d26281094b4bc51ba90c4a5c53734e19a002814bb6814c07668a514b8aa01b494ea6d048b4a2929d4ca10d2e28a29884a4e6969298828a28a9ba1894669692a4028a4a2818b4945148432a4151d48b4d00b494b40ab630cd14a28a800e293ad0c68aa10668a4a70a4301c519a4a4cd003f3494da5a57017141a28c5302455a7d474e15404ab5daf8527dc1d7d2b8a15d3785a6225dbd88a19276f4520a5ac0a1734b494b9a0414514531894b4514802b85f150266fc2bb8ae23c547f7b5480e558534d3e9a6b5648c39a653d8d251a0c69a6d38d36a461451c514804a2973499a401451452012945252d300a31452d0025028a280168a4a5a0028cd25252016929692980a2969b4b4803345145310514b450312969b4b9a005cd20a0d1400668a29b480751494b400514525002d028a4c5002d14525002e69723d3f5c7f4a4c525002d145266801696928cd5200a2929690094514b520252d1494c0334b4525003a96998a5cd00253a928c5002d2d2628a2cc04a3141a2900b8a4a5a290c414514bb7dc0fae7fa0a621283466948aa0129d4945201d4629b4a281dc5e28c525283400519148697154014b494b48a1306971499a426990741da9b5263e9486b951e98d56a1a81814af4088a8c505a9b9c550863bd45063d2a4981c54313f3d2acc8b8c2a3c7bd29cf6a6e71599614fcd465b14c67f4a64161587af14d58d9fe94b1ec6e0d68c2b176ad0c64ca71d83c87a7f856e430c700e051147b6919f152c926f329bbaa033c7eb4e4707bd004879aceb8b62a78e95a348ebbc505a666f4a8f754b2478a8318a4cdd0a07e74ec8a4069cd48634d3b349834bdaa892b02d9a94102a3a941ad4e66747a4735d0573fa29ae80543331f520a6528a00969a4d28a69a006d252d21a0069a4a5a4a004a51494b4012ad3ea35a75003e8a4a2801f494514005145140054570db549a96abde0cc6df4a00f359773739a85b3eb4f6a889adc82176a888ab056a22281d910546454e6a3268d0088ad37152d36a063314dc54c714cc52b0c662929f462801b494fa4a2c0328c53f6d2eda2c045454fe5d376d3b011d2eda940a302a4066da2959e9b9a605bb4bb78245643822bd66caee3ba8d645e87debc754d7a07836f83c6d113caf352d0ceae929692a44713e307fb82b8e35d5f8b8fef12b9435a886d2d2526680168229692a8618a6d3e9b52021a334b486988906290e290538d004540a1a8db5230cd26ea5c53b2b400da5cd1ba93750002976527347cd4c0761693e5a6eda368a042efa4de68e28dd4b5187cd46c349ba8c9a0076d147cb49cd1b6980edc29bba97cba7702900ca514fa6b5022414dc52034eab000692969280168a29375318668a4a4a09168a4a3353718514b8a4a2c014514530129734528a006d069690d400ca7ad371522d3431b4b413494087514519a6006928cd2f15230c514b49d6a802814521a4014a68a4a0414f069b4ea007034fcd3053d715621e2b63449b65c47db9ac65ab96926d914d501ea40d2d4511dc3352573143a8a4a28016969296800a4a5a4340095c378a8e26edd2bb9ae2fc589fbc5fa5544472441a6b1a918d309ad4923269bba9e79a662a2c3169b8a5a434862628a28aa40251451486252d14500145253a80128145148033494b45200a2928a002971452d301b452d25300a5a292900b9a38a293140052d19a2800a534945200a28a280128a28a402d14b4550098a28a4a402d1452530169334b494805cd2514b8a004a5a4a5a00292968a0053f403fcfd69b45148028a7525001494b45300cd14525200a29692980519a5a4a402d2d252f5aab8c2928a2a44145029714c2c252e68a295804cd14b486980514ab466801692940a36d0025252d029885cd2d252d318a0d1ba9b9a5a92ae25252d2d5127402994f069bdeb991ea5868a79a4a711412576a3752b0a6669dc4472d32234f92a38a9d8c8b54d6c518a6e6a0b1192a3c7352bfb52429b9ab44266adae937520c885f1ec86acc7632447e6561f55c569d9dfcd1a8e9f90a75c5f34bd76d59cb72916c552b8907ad596ac9ba720d40c4526ac8b8d83a55117156d0ee154c0b56f74d27518fc6ae0aa718f4ab95016209d76d51e2aedc9aa3bb14cdd083229e29a297152cd2c1cd3a9294d324abbf9e9532e2a2a914d6c8e466fe915d1a8ae7b48ae8854b207d385369e2a407d21a3348698099a6d2d2503129b4b494085a4a4a5a009053853453a801f453696801c2969296800a28a43400b514a320d4b4d6a00f2f9536d5526b47564f2a6917dfd2b3ab52429879a4dd4bb8d58889b7530e6a7e2986901030a8f1561a98568288b146da976e293148645486a42b4628b05c8f14b52114605210d141a4271516ea9158903d377d479a4a063b79a4dd4945218b45145002d74be11b8d9740766e2b9aad7d024f2eea1ff007a8047ab534d28a46acc679e78adff007e07b7ad73b9adcf131cdc9fa56156e891b494e26939a402d068a298828a2945031b494ea28012a418a8e9dcd301869b8a79a6f35231314bb68a5c520128269714bb2980ccd27352ed1499a4219b4d28434fcd14ec033653bcaa7e68a10c4f2c526d14ea053601d6908a78a4a621b8a6e69f9a38a561898348569d9a4cd36086e29d4946452421c28a414da602d251464521894b452531094b4506a4028a4a2980b4514b48761b4b46692980a4d252d25210ca91734da7a74a10c6934b41a4a0070a4a4a28b80b4b41a414807525140a60368a75368016939a296a4029dcd3734e069e803c0a753334b5a104a054cafcd42a6a55354347a6699309614233d3bd5dac4f0e4dbadc0f4adbae618514b4503173452514085a28a281895c9f8b62fb8ddebacae6fc587e48feb4203836a6d3d8d466b72469a6e29d8a4cd48c6d252d1b85301b45146290c4a28a4a1882968a290052eda4a5a062514b49400514945001452d25200a0514b4005369d4da402d14b49400a692969298062968a4a005a292968012968a290094529a4a0028a5a280128a28340051452d002526296968012969b4ea60140a4a280168268a2900de6969db8525002514869d40094b9a4a2800a28a2900b45252e680128a29452012968a518aa0128a52692980514a052520d44a5a28a40252e68a43400e1474a4cd14c05cd252d3680169697a519a60071401494ea402034bc1a4cd140c314114b41a606f8a6b53a9b8ae73d012a43cd474a7148b1afc5438a9b9a8b1cd3b90d114a78a8e0eb534c2a18bad598dcb54dda69ff351506a44dc5351f0c29ceb4c43cf6ad132646c2cf2f6ab90bb1eb5411aaf426839da1ee6b32f2006b4f355a65dd419985b0e6afc28cc3ad56c73fd6ad4541a58bf08da2ac29aaf18cd5c2117a52d04cab739c552abb73543341b4478a09a0734d3591a8ea71a653cf35a08addea68c7e7501eb56226ad11c66fe941875ae80561d821adc5a6c81fbb14f14ca90548c7534d3b6d21a04329334ea6d20133494525301296929d401203450b8a2900ecd385340a75003a8a4a5a6014514b400521a283401c0f88d00b83582466b675e9035cbfb7158bc56c8919b4d369cd519a062f994869b9a5a0604e29b9a3347155700a426909a6e6a4071c51c537ad235170173494949ba810d209a6eca9734b480876d215a9b069314ac86438a5a94ad01452b011e28c54946daa023c55fd31b13c7fef554c5686889baea11fed5481eaf4d7e94a291cf15981e63afb66e64ac8ad2d689fb4c959b5b884a4e6969b5002e296900a5aa01c452519a29809452e29b480053e994ecd24021340cd04528aa0129d8a693407a3400c52d14b8a421a699535478a0a0a2932696900b45252d310b4a29b4e069009cd3b6d2734ddd54018a7668dd486a407537229a4d2669b18ecd264537345002d2734525480ea29b4ecd001453696980b48696933400525145020a5a28a43014b49466a807525250680129cb4ca70a800a5a4a5aa01052d1466a4340a28a2980514868cd310514b4940c39a5068a290052d2f14940870a7d345381aa01c2a65a86a45ab03b4f0acbf2bad7515c5785a6c4ac3d457660d63218ea28a2a405a5a6d19a00752669692800ae67c587e48feb5d2d72de2d3f2c629a038b6a8a9e69a4d6e48ca6e294d3726b2181a28eb41ab01b452e69280128a28a900a31494b9a06369d494b40051c514da005a4a5a4a402d14668a00296928a005cd25251400b4514b9a9001494b494c028a28a401451455082973494b486251452d30128a53494802928a5a6014514b4804a2973494ec014b4525300a2971462800a4a5a2a404a5c5271466800a5a28a00434b4514862514b4948029296969884a5a4a514c41494a4525031d4da5a4c50317345145001494528a91094a682692a802969682280b052528a4a6029a5a652d0028c9a28a3340c5a0519a2900941a4e69d4c93a0c8a6fe34a00a46c5739e90dc53f14c34f14ca12998a76298d48647374aaf00e6accdd2abc39cf4a673b45ceb453a928362bbb5357ad3da99410cd4078ab96e6a80e957adaa8e7262b9a86e3e55ab19a6f961a9106033f356626157db4d89bda85d3a24f5a655c20ab142a01450221b9e9546af5d74acfe948d623b2452d0282291a8b4b9a6734efc2a8441dea55a87a9a9aace56741a5bd746b5ce69095d10a4c81d520a653c5210fa43466834c08cd369d48680186929d498a004a5a4a2818a33532546b520a043e928a4a00752d3734ec520168a28a6014c7a75324381401e71a93ee9a43efdab389ab32b924d5635b00ce0d4752531b14088cfb52669734ccd21884d26e348c6a335221e4d26ea6d36828764d1ba8a4a620cd266814a6800dd5206a8697914809b752134c1474aa01f9a42693345002d3aa3cd2d0029ad3d04edba87fdeacbcd58b29bcb951bd0d4823d7d69b2f4a514c9beed6607976aa7f7f2743cf5c55035775220cf21f7aa44d6c032929c69a693244cd2f14629282875281494034c43a998c53a90d030a506a3cd3e9085a41494b5402d262969a681853b9a65396a443e98d4fa69aa023a5a28a91894668a2900b9a7034c6a334012534f340a6d3602d3b8a6528a421714da71a6d50c4a29d49484031498a70a4a918514629334c05a4a5a4a005a28c5140094a69296800a4a502971540329696976d00368a5c52520129c299526690084502969d7370d3b6480bec3a53111d3a9b4a32696a0149526c349b69d8625252d152018a29734954014ec5253b3400dc5482306994fcfa5508361149cfa53bf794be77aad31881aa55614c1b1a9fe58ed4c9363429765c257a1a9af2db591a1719af4f46c8aca6325a2938a5a818b4945140052d2514005725e2c7ff00575d6d715e2c6fde27d29a03956151d494cc56e40da653a92b3284a292929d861494b451a884a28345300a28cd2548c5a4a28a0028e29c4d32900b494b4520129734525002d2514b40098a5a4cd28a6029a4a3349400b45252d021296928a43168a53494c05a4a28a402e452514500252d145001452514c05a29296900b4da70a4a0028a31453016928a4a402d14945003b8a2928a40140a4a5a6014b4945002d25252d200a4a296980514500d20145275a32692a805a28a4a901d4514bc53b0c6e6973494b4841494506a805a28a2900514525002f14b4da05301d4b81494940c52d4b9a6e2971484028a28a00e836d1b7de8148d8ae7b1e908453b9a8cf3520aa4000d31a9c1a95883520412f0b50c039eb56262d8aab6edcd599b2ed2914e183486a2e68567a66335230a87e606b425a3490f1576d6a90e9572d8d339d96f6e2969a296a5990f38a6d21a2914141a28aa2482e7eed67715a3759c5676dcd23a623d4d1cd3453c9a45852d3734ecd2b832bf39a9066a3c9cd3f35d07148e93475ae816b03476c56fad4324753c5474f148648291a969a6810da4a29298099a6e694d2500145252d0048b4e14894b400b45145002d3ea3a9280168a28a002aa5f49b2273ed56eb375838b793e9401e74c314cc53dea167f6ae822e464d46e453996a36353a82194dcd3cd3715058ca4eb52b5369086f028c518a7d3b0c8b14e0b4ec528e2a84336d2e3da9d49cd160b8dd94bb29734eeb4808f14dc5486a32d40c4a293752526038b519a6e6929012714a8692843cd203d7b4f9fce8637f55152dc74aa5a17fc7a41feed59bb6010d481e5b7cd991b1eb556a691f2c48a8cd6e48ce2936d38b0a4a92b41b8a4a5a4a603a940a6e69690682f34869690d310da7034da51400a681494dcd1f3025e6998a70a520500474bd28c1a2801e0d264520a298098a5db494f14b40198a4a7537750006900a5269bcd400f068a66d6a76d6ab18b4da77974be58a448ccd2e6976500d0ca100a08cd3c521aa10dc514ea4cd218949452d4809452d250014629d8a2980da296969000a5269b9a5a0028a7537756821d8a314cdd499352021a7547cd3ea462ab95a65252d003b14e208a9238b774a92f32adb7695c762281107e74a6929b8aa18ea2928c54005141a4aa10a296905140c775a39a29735621cad4b51038a7834ee2140cd3f9ec69bba9d401324deb5e996130922522bccd1735de78711d6dc66b390237296928acca168a292800a28a2800cd719e2989bcc070d8c7e15d9d52beba86dd7738cd34c47981e3ad45935b3a9dfdb5df3e4ec7f6c5631cd6c2184d37069692a402928a4a7718b4945250014525153700a5a4a281852d369d4009494b9a4a402d19a292801734945148028cd251400b40a4a298871a4a28a0628a4a292810ea28cd26681852d21a2a405a2933494c07d2519a3340c28a29281052d2519a005a4cd1452016928345300cd1494b4005145140051451400b452519a07a062968a4a042d251452014525252d30168a4a5a402514668a005a29334b4c04a314519a402d2d25266980e349cd2514802973494b4d00b494da5a0075252d140c4a5a6d14085a753697a500252d028340c5a4a314629dc47427068a28e95ce7a2329e39a8e9e28b8c4a302819a0d3191482a08319ab1374aad08e6af43265ecd0e694d2356268577cd44d53b8f7a86b54c4cd14391566d5aa92483156edda91cacbde720ea2a2175b8fca9fad46f55bccd9548836edece593e63c2541fda7a774f9bebb78aab73abaf91e5a6f1f47ac46c915b127509358cc711cca4fa1c8fe62a596d5a3ae395a443c1e7eb5d54529741d7f13593b0105c938acdad0b93c550eb5274c45a527da91686a92c3ad4951ae6a4dd4015bbd3948a8f1cd482b7396563a2d19b35d10ac0d107b574153233169d4da70a902414845141a6032929d49486369b4b494c414514669012aad148a68a6028a7629053a80169452528a007525145001597ae1c5bbd6a66b335c19b692803cf1ce6a16a9a41ef50915b9162026986a46a693498c6b0a662a4a6fd695c634d2ed068229315202eda4c521a39aa43169290d1542169714519a63128dc05377546c6a0019a9375369715202514fdb4a1680194b8a7e29d4ec033142ad3a9b8a407ab689ff1e90ffbb4bab38485ce71c543a0366d21fa543e239365bbd6651e778a4a5a43c57492308a6d38d36b31086814b48698c5c5252e69280169c2994e1400c34e0690d2669887e2998a5cd3734807ab52e6a3c1a76d6a631d49c1a3cbf534bb168019ba97767b52f028f3050213068d8d479949e61a5a00f11fbd26d14ccbd186a3e4049f28a6ef149e5d288c51a80196937b53b6514b518cde69db9ea4c514086fcf51835337151f9746a30cd1be9bb69db6801339a2971452012968a70ab023a5c53a90d200a4a5c5140051452669085a3229334dcd301c69b495220a43198a7814b4b814011b0a295e806801845008a5a4db5205d86e121e57ef54124d24c4b39cb5438a92ac5a09cd3b3e94514c0334bc52520a918ec63ad369734da602d2d1453b02168a414b5448da7d36950d4143f753f8a86a402a844ead5daf862eb746c9e95c30ae9fc3136d908f5a9607694b494b590c514b4949400b45252668016b0fc4511316456dd417308990afad203cc5d4d42ca6b4a780a3906abf939e2ba4828e29bd6a7788a9a8a8b0c8f8a2a4094e095361905262ad086945b55728ae532281577ec868fb21a7ca1729628c55dfb29a4fb29a7ca17296da5db573ecb4dfb3d4f28268ab8a6e2adfd9cd020a8b328a98a5c66ad7934cf26ab958ae41b693153f95418a972b0b9015a4c54a63a4d86a6cc2e478a5c53b1498a43131498a7e2929d806e28a781498a7601b8a36d3a931480314629696810cc514ea315231b453b146da7610da29db68db400da314b4b486369697140a006d14ea31400da314bb69450032969d8a4a004c52e08a5145002628c53b14629d806d2014e0b46280108a314ea4a560136d14fc53714ec02628a7914d145804a4a7d2628b084a5c52814b40c6628db4ec528148066292a5a4db4c06629714bb28db4ec02514e029db6958647b69315298e998a2c20c521a7e28da6818d028a76ca502810c14edb4b814ed94011e2971526ca5a760ba230a690ad4a053bcbaa066c63de8a4c1a0ad719e98ca7669869e29800a420d386283f5a6041374aaf0f5ab5374aab6ff009d233772f06a19f34529a468567e2a26c5589055692b4b92c9109ab96d9cd5182aec046ee69183468b0cd5495055ee297ca4f4aad0c8c94453dead240856a76b28e97ecbef4f989b192d0006b76df1b0556fb047ef53040952d8c86e9ea97152ccfcd423e948e843d5694d19c51ba82c139a7533f1a71c53422b9fbd4f14cef520f9ab438d9d368cd5bf8ae6f48ae8854c8924a75474f148078a434e14869811d21a534da430c5252e69a6988292945262802614b48b4b400b4b494b400b4b9a6d2d201d4b4945301d547538fcc8241ed576a29977291401e58cb51907d6ad4d194241aae6b7248185232d3e9a4d218c34ce6a66e69940866334b471eb41a0a2334bc5252e2980dc53b14ee299baa4009a8c9a5cd32a84368c53a9c0566311529db69c052d680262929c29b520251c519a29886734ecd252ad219e9de1d5c5a45f4aa9e2b3fb83d3b56be9d008608d7d056078be5c4607bd648670e6968068ae82069a6e2834545c6191484d2734628189ba93753f60a38a421b4bcd1ba8dd40c36d1b7149934006801c3147cb49b280b4c037d1e61a76c14a29811e5a8c35494940ae37651b29f41a5618d0b4a052d14c9171494b4da63168a5cd26690c5cd266933494c05c9a0669334b9a4214e6980d2b532931927149499a295c05068a0525210a68a0d1c55218b499a334829e802d1452548099a2929690828a29c29943453c53b145508434a28a46a340237a45a4342d400fc52d3714b4c07eda4c5206a7531098a4c53a9335231b4b45255085c0a5a4a29dc05a4e68a5348626ea5cd252d0216994ea6f4a2e325a76ea8e9f8a7715c9056e787a42b70a335842b534b7d9321c7fe3d8a607a30a75310d3ab018ea2928a0028a292800a46a5a82ee4d88c680389d465433970075a6ba625fe1c7b55795b2c7353499cae2ba519b443a843deb376d6edec598eb1298c411d581154695623aa20916daa55b5a952ae220a5702a8b4147d9bdab44253bcba771199f64a68b5c56af934df2681196f699a8cda56b7915198e81994d6d4c3066b57cbf6a6fd9f140f532bc9151986b53cac76a84c54c4e4677914860ad0f269ad154b0b940dbd47e4d6818aa2f2ea4d1328982a268eb48a0ef503434ec86544e69c613411b4d6808f7af41480cd087e94d2b571e0c52ac54582e54315336d5d7871516ca4d0ae41b68db567c9a53162958398a9b68c54fb0522a54d8ab9100293153ec14812a8645b69a6ac6ca36d2e5110eca5db52f974846681dc8b6526da9963cd29029088314a56a4d941a6171a1298455954150375a2c17128c539aa548f228b015b6d48b1e696a6846684221d946cab257da93cacd161dcafe5d0508ed57044291d7fc9a094523d284426a5d94b6ea4fa549642d4edbf2e69adc55a861dc954172af18a02669d8a9d00a604052848b3573c906a48a1028b0b4335930691aad5d205355d852122458f752797566d57fce29d3c1b698ca7e5d48b1e69d8ab30c7ed4c572a98315194f6ad278cfa557686802ba439a798b156a1b7a74816988a1b0fa52986aeac59ed4ef2690ee6674a2a7319069812a4ad44f2cd3306af42b9eb4c9a2db564a2a62ad087351f9556e1a432b7914d68f15a4d129a8655a06ac522b52ad376d0ad83ed4c4691a434a69339ae03d51940a29e1a8d441b6908a3914954223947155e2eb5658f15523eb548cdb2f8a0d22834a6b3341879aace2ac31a6b0dd4c1a2a249b2aca5c0f6a81c0a8c355181d15bccac3ad59cd73f6d71e59ad88ae564a0cd960e6a347269f9a7831814ee66373556e6e3149717c91f1d4d67b397348d5224a514d0334fa9361739a5229a01a79aa188bf4a7f5a45a5a0455ef532d4447352ab56c7233a4d1a235be2b17453f256cd4c881d4f151d482900f18a434a290d00308a8f9a969a4500328c52d14009451450048334ea41494807d2668cd2d301d45252d003b349494b4085a0d2d25033cef5d83cab87f7e6b2f02ba5f14c0048adea3fbb5cc1c56a806b28a4db4669bc50c42645307341a29d82c3185253a9280129314ee68a0067d690d3c8a69a6223c514ec53b6548c6d3a8346314c029334ea4e2900dc518c52d1b69e80369a6a4cd465a90ec2669e9c9f4a8b352423e61517047b0c430a2b8df18be7cb15d929ae17c5eff00bc4fa54c40e6971484d1914b9ad4426053495a5da68d8290c4df4df9aa4da28a7a88684a4d95262928b0db19b69fb69b4ee690094b494b540252d2668a0414669334940c79a4a4cd15202e69c0d30514c075368a4a621d4da7669b4805a28a2801b4b9a292900bd6971494b9cd318d6a2909a4a910ea4cd14520168a292980b4b498c52e698c29b4ea4a571066928a281899a5a29c2900539452e292ac04cd2d2f5a314c9020d444d486a2a9631b4f5a6d394d4a18b4518a2980b4ecd3334b4c43a8c52734669801a4c53a9b9a4019a4e6968a10052d14b4862514b8a4e6ac05cd31a9f8a69a403d69e2a25a901a091c2ae5abec65aaab53a1aa03d450d3eabda36501a9eb0287519a2928016928a2800acdd65bf72d5a558faeb621a00e289f7a9e63f77ae6aa9eb56a47e16ba11916dc398eb14ae2b783ef8b1582dc550c45356a396a98156233e94c469c66ae2567426afc669925a1528a881a97348614a14502956810c65a8f6d4e69bc50222d94d2b521a6e681dc8b666a378c54fd69bb6802994a4299ab2cb515311014a882d59a6eda432ab479a8da2ab5b4546c3d2901972c756b4e6078269b2ae2ab5b49e53d06869cb1014df26aeeddd4cdb419ea50996aba266addc0a644b48b1d1c54c963db57e34aa73f2698ae55118a77919a9624a9f650051688014c5157244aaeab9a2c026d14d2b56b671d2a32a28021d94bb054b8c76a5db482e401314c75ab1b298cb4ac321c52f9752aa52eca042084fad547e0d6960fa567480e6865e806adc606daa6f57e31f254945100558b61516ce6ac418cd32495d691066a595453631cd3112aa541355cc77aad714c48a34fb35f9a93152d9261a81dcab3c6326af69dc83fcaaa5d7de3d2ade99523b95a68806f4a7aad59bc8ea28c67b53235278945580b51c7f4a9b7530b9957a2aa1e957af9aa91c6da9b148bb626adce954b4f6e6b56451540cce55f4a9a3a5db4ec520262b55cc02ac2f14a141ed401180547bd532e6af4bf28acfc91ef4c2372dc043558f2f1542d9ce6b5339a2c232e65a83f0abb731557c669163adbaf356e7886de954a35e6b5768614ccb53140f5a72b6d3534c983513a53d0b34a201aa29e3e29966fdaaddc018a4332a9b228cd3de95928b08b3834126909a53835c573d6194e5a6914e43ed9a0001e6834b48f8a06452eec7f8555873baaccbc0aa9072d55639d9a2bc538d26683526c35b34ca91969b8a2c04654555921abbcd31973419b45301aa6491d7a518a72ad326c591a84b48d7b3b75a876134608a64f20d5058f35600a40b52039a456a3c5252afbd29a46820a71a6d2d02141a750293a50056ef530a879cd4a1ab6471b3a9d1feed6d573fa2b1adfa99124829c2980d3c52112d34d28a69a60369b4ea4a40369294d36980514525004cb4522d1400ecd14da514807d2d25283400e0296928a602e2968a4a00e67c5717c88dcd714c2bd03c4a99b6cfa1f4af3f73edc7b56a221cd19a6b5230a6081a8a6f349480766978a6628aa18b4dcd1ba9b484c5a5c1a4fad266818e145377d2eeaa24766834da38a9003482978a4a63177d2134da4348069a4a5c53b1486478a721c1a5db495981ebf6d3acb1ab8c608ed5e7fe279bccb9c7a0aeb7c3b3f99651fb71f95713adcc1ae64e9d7ad24333314fc519a2b5200d2519a4a06149452934c04a4cd19a4a9016928a5a431292968a6014528a4a6014668029298094ea28ce690828a292818b494b4502b0b49451ba9e8317349494548073494b4530140a42b8a4cd3e9088cd0290d2d21852514520168a292801d4669a28a602e68a4a5a04145253a81898a78a402969885a5c5029c053186da6134ecd464d5310d269b451590c295692945003e92948a4a60252d252d02168a4a5a6317ad25145300a334a69b400b9a2929734805a29b4b400ea652e29298872d3ea35a9a801c18d4d19e6a1152a9c55927a469726e8233ed57eb2f44606dd3a1fa569d73962e68a28a0028a0d2500158fe20ff00535af58fe20ff53401c374357644e16a91eb575c70bfe35d062684457cbac29c735b7046765634ec734ca45615347daa1a9d01a622fc557a3c5508daae47c53132ead4b9a811aa5a648fcd3b9a8e945021f494ddd450314d3693346680b0da8f34fa612281886a234f2d519229086e698cbef4bd69334c06631494e6351d228ad3565b820d6a91f4359d70a6a58d5cdab57deb539accd366ed5a34c450b804d4b1442924c16ab118a6225e959d39abce702a84d48a1d1715676e6ab442ad6de29d89b9048b51a254af518e291649daabe71f4a797a8c9a421f8a6f5a9545211e94c190907341a5cf341a2c2b9185f5a9c2d33e9531e2a47711fa566b9c9ad166ed598e79a45a63181ad183eed67b569c5f7292136542bcd4d10a630a9a2aab09b24909a54151c8d4b1531684e2a2702a5cd42d9a0085466a4b68b9a14015661c50558cabbe18d5cd3b8aa37c46fab7a7b7153728b73f3514494f91b34898a62b128f9694629b4e4c5320a17b8aa7fc356ef4d555e952593581c356bbd625abfcd5b3be9a14ac575ebdff003a7e7349914a1a80b128352d57a93b530b8c9dab3b356ee1ab3e81dcb495acb8ac64735a91b6690ac326e6a9006b424aa6700d32861fa8ad182a832558b734084bd5aa6bcf5ad0ba03159838a40490b1535a9feb0563375e2b4ed1f8eb54122a4d1b6681c8e6a6b91fe7355d39e291162c9a6f38a90f1ef51e2b82e7ae4752a1c5305396ac629a47146286a80b91c8bc5528860d5e97a7ff005ea9c3f7aacc997e969a734fcd41a88699ba9c69bd6ab50139a5a314ea9b888b146ca906292ab515908ab4e6cd2d3b3da9fde039d78a60a7bd32a4843f34509f2d2d55ca1a09a791498a4eb4ae21cb4ee2937629dd68bb1157bd3c5336fcd4f5adce4674ba2a8adfac1d1b15bb50c91d520a8e9eb4809714d34ea61a042669b4b49400da38a29b4c05a2928cd0048b4522d2d21852d18a51480752d252d310fe28a6d2d301c296933450233f598fccb597e95e6d2715eb1247e6215f5af2a9518715aa11508a6366a53511cd00369b8a71e29b9a0a1d48693341e68012939a5a3a53250ca4c1a71e6929142514b405a004cd3a994e1c548052525253b887e69b4b498a3518b40cd252e2a8419a4a29a6a067a078525dd6857d0d71da8c9be690fbd6d786b5158629c3363bf5ae71e4ddd6848a630669f9a8b34faa331d494e269bba818941a51484d3b809451495230a33494b40099a51494530168a38a29885a293345030a4a4e6969080714b4525218b9a3229292980e269b45148029d8a4a2980519a514dc5210b4134941a431945252d201d499a4a2900b9a6d3a9b400b8a75369698052d252d300c53c2d00529a62128a4c9a70a6039696929b9a63118d479a5269b51700a2968a042528a4a515231d4529a6d500514514085a2929690c5268c51499aa016929734940052f4a4a2801692971494c0752514b400ca787229a696a02e4eae0d4ab552a5592b5449e81e1a9b7438f435bb5c8f856e3975feb5d6d63228751494b4802929c692801b593af0fdc9ebf956bd64eba3309a00e0d8f356cf45aa6c39ab7239dab5d36332fc6c765644a726b5a26f92b2a7c5008adc54cb5054e94c772ec55755ab3e2abe98aa22e5906a60d50af3520340ac3f751ba99ba93cca448fcd38b545ba8dd40c7e6999a09a6134c6389a652734dcd200a635048a61714c05dd4dcd3378f5a6992a42e264d3718a5f32984d318d726a8dc2d5c622ab48b52590d8c986adaddc573f1b946ad947c8a10988179ab6a2ab8a9371aa10e7aa0e0fad5a76354ea068b118e9560b66a04fad484e0555c4c89e99f9d49c1a8d8d048c2467bd1d6a3cd48169164c290d2834c3c500474e005341f6a7d00900a90d26168fa9a09b11cad598fd6afcb9acf3d6933414e2b4a2cedacc35a4adf2d088233538a802e6a5e94f42b5ec293eb4ab50f39eb5325031fd291b9a4a370a62b11a035697a557a94b5226c64dd1cb55eb2231546e319abb6c302916c998d252669314c8d4901fc69dba981a9722802a5d3e6ab2118a96e3e6a823a0a1d6e3e6ad9c0c56345f7ab5837150818ce29777d29a5a901f6c5681cc4df8d4951119a09a09229f9aa5deac4b213557bf35172c9726b4606245651ce6b42dcd302e6eaa729e6ac17aace47a66840397269d154687f0fc6a5538a6224909c7ad65bf5f4ad2639acc988140c1ff2ab966e6a91c1a9ada4db4b9845d9aaae4d5c739154f9cd31160d2b50692b851eb8ca996a2a70cd3186050cb401ef4521588e4aab1373565fa5558c8cd510cbf41a3a51506818a6e29d934caa10e14a6834da9602669d4dc52d3d44c78a4da6938a45626ac96c91b750b8a4634dcd048f14ea68c9a7f4a8d4a1569a7f1a0538d520d029734816941a422be4e6a55c1a8c9a91056c7248ea7484f96b62b1f4cf9456c54903a9e2a314f14844a292969298c6521a5a4a4025329d4869805369d494087034a0d0b45002d3853696900fa5a6d2d003a969b4ea005a5a4c52d301ebd2bcd75a83cab895471cd7a5a0ae1fc596fb25ddd985688839426a2ce29e734d3556286714d229d486958623514502801450c29c290500369314fa055088c0a4e69e39a2a4430834629d8a4a06376d2734ea29d804c518a929bb6818dd9ef4114fdb4d6a6223a4a33499acc64914d22671de929b4ea602e3da969b9a5a603c51451da95804a28e94caab085a6e69f4d352312969334e14806d2529a4aa10b4a6999a750019a75329690c314628a2af400a29296a404a4a752502128a50296a461494eeb498a6036968c538d30129a4d2e29a6a406d2d252d4805252d2d5009452e28a004a7629ca29d400ddb4bb714a28cd580521a5cd25486820a7ad0052532456e2a2cd38b5333414251452d4805252e68a004a29692900f3494ea434c0314941a296802d1b6928a602d2d2518a6014514940053a931494805a297349400b451450014edb494b458426da7e69314e02ac93b0f0be9b32fef5b815d656478765df6a9edc56cd64ca0a5a4a290c5c521a28cd001597ade3c86cff3ad3acdd63fd435008e024eb56db6ec5aa9275ab6d11655ae9219753604ac79d79cd6d795f2d624caf9a622006a65a86ac25032e455752a9255c4e29904eb4fa8c352b1a044b9a68a4cd19c5301d9a33eb4cc8a4a007f995196a4dc29b9a403b351f341a6f4a616034c6f6a5dc2985e90ec861a4a693413e940d08d4dce69acc69a690084e2a266a9777b540c686522a3706b4eddc62b364ab568770eb528248d21250ce2a2dd8a775ad0ceec6c8c6ab66a7635029e6915a9690d4ad4c8f18a5671520318d4069ecc6a1938aa18dc0a9d14d55dd56d1b152363f229ae73ff00eba375349fc2824605a93351d3d78a6048298e69739a6b503b10ccd547bd5995b355866a0ad4561cd69270b59e7ad5f0f5426346ea937fb53338a66e229820635207a8cf6a70352512eea6134a2984d3331f96f4a773d69809a466a45ab1426e4d5eb7385acf94f357a0e94b402524fa52734d24fe146734c43c1a5f3299484d501565a8538a96539a628accab09137cd5a85ab29739ad2078a222602a4e2a1e69f56224cfb7eb5116f6a52691aa89b32bc8c6a2a7b9c75351fd2b2344856356eddcfd2a9bf153c3f5a62d4d0a89e9df35318530116a6cfad401aa4cd5123f359f71cd5e3546526a4a191d2c6d8348869a5b9a65686a67e5a81853d1e98f4c82c93e9435145701eb8c34e1c5329c31de900b9a290d2315a62b89263d2a8a7deab4f32e2ab4639aa3191a19a285a5353a1a8cc52352fd29bb8d55c070a5dd4dc52e6a405a4fc6839a414c4c752a024d3724d2c5d7ad04bb038a414e3495421c29d4dc528a4316970691686cd30b120e28c5341c529352901074a963a86a64eb5d08e4674fa6ee35b3593a5f4ad6acd903c5381a8e9e052026cd34d2d21a6223a4a75369009452d36818514525301e28cd02929087e6945252d3016969b4ea403a94520a5c5301d4b4945004a9d2b9ef155a7990eec6715d0a556bfb6fb444e9ea2b424f28618a849cd4d720a9c11cd426acab8dce7d290e3da90d3680023149ba8a4a90240d401518a5cd1601d4b4ca78a620a09a40697342b084a31460521a0620cd14b9a08340839a051484d30d44c9151e4d2d349a450da28a5a80014a28a053014d28a534da0448290d369734c028a2929dc619a5eb4da5a5640250294d20a004a29714a05021b4b4b8a2958618a4a5a2a8041498a79a4a91094b4869680128a29334c070a434034cde2818fa299be93754dc07d2d454945c090b530d14edb4c04c518a7d2d1640336d3b14ea4c550060518a5c529a00334521a290808a4eb4ea4a0604514b4daa10669334dcd266a79861494b4540051494b40051494edb4c425252e2814863e9a452d1540252d251480296929698828a4a290c5a4a5a5a004a5c51494005141a29d805069734de94a280169f8151d3e8b80fa05028ab24ee7c2921f248f435d1d725e139b1bd735d6d60ca0cd3a9b466801d9a4a28a004aced5ffd43d68d50d5b985850079e4bd6aeb6fd8a79aa738e6af79d889457419b2e0462958b3b3035b22e0ecac9988ef4c0a62acc75054e940ec5c8aad8355a122acad51362414bba8c8a314c81e293753451d2900ecd253738a4c8a63178a6e71494d2c6a405a8f752e7d0d33341430b5309cd3b2b4c34ee20c7bd271484d34b521a137d2536909a07ccc731a85e9c5aa37cd21903d3eda4c531aa38db69a919b3914bbaa056e29e0d684315ea01d69ece4d301e6a4a2d2714ee0d3294d048c7aaacd9ab0d551a810e5e2a71502fbd4e28450feb4d6a7669ad4009bc1a06ecd37e56a90b01400a7da9af46fa89dc8a351f310ca6a00c73523e6a38c5432c76726afc7b715438cd5d4aa25851c1f4a0fe54dda69dc3414252834da41c532ae481a97151e683cd1620371a18d1cd35ab3ba158a7266ae407e5aa721ab3074a92c9a9db6938a43cd684d878a63507da999a604127e151a8a52684accbb8cdc735a313567719abb11aa8889ba5029bbb34a6ac05a8de9db6a276a44913d369b4e35058e71f4a74671d6a1929e949033537e0546c3dea214adc1ad0cdb6380f7a973506e14e02988796aa4ed56deaabd49644a683814abd69acbcd4945d889229fbaa1818d3f356645bcd34cabdf154374a7d697ecd29ffebd71a3d4e764e664a88dde3ee8a77d9197a9a922b443da86d13ef15bcf969fb246ec6ad08957b0a7d2e72947cca06d8d31383571c5545eb55cc4b48d14348680a69371a8351285c53a9993541a0fa4a4a2900bcd2668a4c5210b9a720a8f6e6950e2a84c731a414ad4ddb411726a3a535734a454962d1d68a5aa1683852e6914d19a6057ef530cd400f3d2ac2019adae7133a6d2338adaac8d29702b5ab310e14fc5329c2908945140a0d30184d369d486900da4a5a4a062514514c43e9281403480752d3696801d9a5a6d3a801c2969b4ea6028a7669829680274a1e91295aac47997882d7c9b87f4eb58df85763e2db3e564fc2b8d90fa550b510e2a3a79069868286514b487148033474a29b8a00753a99cd3b26980a28ce29bcd2e2a8917340149ba96a6e5728b42b628a4e94f510e3519a91aa22290c4a6f5a5a4a3501294534d28a801d49475a0558879a31494ec503140a4229c0d0c6a82c37146293763bd26fa4214521a6f994df32a2e3251464545e61a4de68b813526ea877526680272d49bc543cd251ccc09bcca3cc1515145d80ff329379a6d14805de68dc6928a401934514b4009452e292980514ec514ec0369d8a296800029c2971474aa1062969334a0531853a9b475a003752529a414c43e931452d0018a43466986a74186ea6e694d36a0028a4a5cd0014514b400945141aa00c52d0296980d34f54e33519a78dd8f6aa56105252d36a062d1494b48028a5a4a004a5a2928016969b4a280168a4a5a601452d250ac02d14945003a969281401229a75329fb6ac93a1f0bc989f1edfdeaee6bcef449765c47f5fe75e882b19140734b4dcd28a403a928a5a042552d486617fa55daa7a97faa7fa5219e713706afa61a219eb54663cd5c550d10ae84665e52bb6b266506b5542edac7983558109a910d439a9a3a432f46b56d45528eae266a8925a5cd329682475373499cd079aa186691a9b9c526ea910ec7bd32824d3775318d34ca73547d29009914d2d48c290d2280d464e28a434c90a617fa51934846690c5ebda9a4d0734da82c691558f5a9cd40f49946844d9152826a95bb55cad4cc635363a79614474124d8a7669bd68c71537191b1f5e2aab354cc7d6a03cd050e8cd58e4d551c55914123e98d4f634cc7bd260312a6dd4ca2980e35048c2a535598834ee3b0ceb4d4a66ea7a1ac4d00d5c8aa9d5c8eb444b14ad371fe734e6e3a5339146a03b02933da93f4a5e2914142b6682681544811519e29e6a37a902b3d5886ab9a9e2cd4a289b14ecd377519cd6840b9a8c9a716f6a8d88a43216e69c94ccd2ad49486a8e6ad211553a5598e8b88b141e7e94c00b53aa8109b8d46f4bba987eb40111a0535852ad480acd4a948685a05a97d318a4351a354a6ad082334ef331518dc6976d0029355a4a94eea85b3402b8d414d62d4aa687159164b167f0a9b9aaea48ab1bbd715a10cb6571d2971ed4119a3e6ae13d51a69452629d4ca0c5378a5a6d4d890638aa3deaf14aa03ef56865234013453149f4a5a46a3981a6d3f7d309a420a703db8a40314b826aae31294534d15203c522f269b4aad8a6262b8cd301634f6a02fbd040fc1a2945148a614a4d028c50039690520a5cd58aec8768153c755bbd5986b43919d46975af595a6a802b52a1903853c5474f140128a2814845021b4dcd3a9290094da5a6d300a5a4a334c63a905145210ea5a6d2d20169d4da75301d4b4ca75301d4b4da5cd00585a4342d06ac939ff00135bf9b6cd8c71cd79e15af56bd8bcd8d97d45795c99aa11036453715230a61a45586629314ea3750025253a9a453189d6834bcd2669b0128a0d36a043f8a4c50297a53d004a5a414e20558877151d3e931432b52222978a0d152034814669d51d480ecd048a8e945201fe652ef349450170de69b4ea2980da4a7e293145806d254869b4804a4a7e28a006d2629d4b4806d2629d46298094bc5145002514b45301296928a005a28a314005252e297140094b8a5c52e31408653b14ec525030a5a29f4088f14b834ea4ab0128a5a5c50014b8a6e28a062d18a314500369334134da80128a292900514945201d466928aa00a5a052d001466969334009531538ebf85440548735aa4219494b4dacc62d1494b5201451499a2e02d2d2514c028a4a5a42168a28a630a2971494c05a28a2800cd28a4c528348070cd49510a96ac82dd93ec7041c57a70af2b8bad7a6da4a648d4f5e3ad4328b14b494b5030a2968a004354b52c792f9f4ab954b52c792ff00e3401e7328c1abab9f2aa9cca335753fd5d6a99058543b7ad66cad5a88df2d66cbd6b4115335225467ad4899aa2cbc83f1ab898aa71d5b50683324a5c51486810dc514b9a673400a4d349a0d30fbd0038b5338a7715193405c334cfc6909a6eecd03b8ca6b1a01229bf97ebfe1408375266928c1a92d0d3484e3da8a08a062530d3a9bb79a56012a192a635138a901603578b6eace8cf357c35340c19714aa69a734e519ad044cb4353572291aa42e42f51629ed51fe352c648ab538155d2acd313406a327daa4e6994c910669dba9b8a5e28280b5566a9f355de8d06406a48c533352a56650def560715055951421314934c2c69d8a67f2ab240f1ef4e0290f34a2828526931b69371ef4eeb4804dc0d44d52818a8da802bb1a9216a85cd490d663659cd28a4cd20ab330a8dcd3e98d4ee5244269c2938a05218856a64aae6a78f8a94059a6e7d68e28f9456a31b91519e6a4e6a22715021a680b9a4a70a5a8c69a1334f6a414058b31d48f8a8a2a92ac428e7bd1d3a536941a62431b8a81aa56cf7a89a90f51829d25253dc8a818911ab5d6a9c4b56c62ad5c1a2e1e28028620d0a4f6ae0b1ea0949cd1c8a3155ca21714869c69b8aab8c6b74aa1c83575f35533f35347348bcbcd29f9a9169c6b23a0418a4229d9a4ab100a754639ef4a0d400e38a674a7114d3560494c671e94b9a653112e69a0d19f6a4eb41249474a4a760d218a0d18a418a514085a78e6998a3154221239a9e2eb5064e6a783ad688e36751a7e715aa2b334e0b8ef5a952c91c29c29053a90c901a5a41494009494b4da4210d369d494c63714b4528a602d251494843852d329c280169d4945003e969b466801f452034b4c09d29c69a94ad5649038af32d621f267907bd7a7579ff89e1ff48fc2981cf535a9e78a6e6994348a6d49519a0419a42696928189b8d20a7d26da6161949b69d451a12028c53a9c68d0a19494efc28c53245e69b4f39a85a93181a4a4cd00d48c5a61a7526da340194a28a2a409453f6d3569f56223c51b6a5a4148088d36a52a282b4c08e92a4db4ddb5031b453b149b6801b453b6d1834c0652d3f149b4d00368a76da314084a4a7e296aac03314548292a463714b8a5a5e2af4109b68a70c5368b0c4a752628a910518a5a5cd50c0714b49454868266968c518aa10b8a4a314520169bc8a5dd4dcd2186ea375368268010d36968a910945145030a28a2900b4514550052d2500d003b6d36973495421ea94f74c77cd0d1000739a429ef5b088f34b41e3de92b1284a5cd18140a900069297145002514528a40252834525310eeb494668a631d494518a0076292968a6025385369d53600a96a2c53c734c9b13a75af43d1d8b409f4f5af3b515df78764dd6cb4d8cd8c52d20a5ac8619a28a28013354b53ff0052ff004aba6a96a5fea5fb71d6803ce663cd5d83fd5d5198d5db71ba335d022e44e36565dc75ad08231b7ad66cebcd321101e2a58ea1cd4a98a68a2e479abaaf5521ab6a453331e28a6e2978a62128a6939a456a0614dcd3b1519a42148a69db4b9a8e8284a88d4a4e2a134806ee14808ef4ea6f5a450ccd3734e3814ca0571334da314bcd03b86693ad2d3734861519a939a61a40442aec6462a89ab519349144e48a7466a3229eb5641266a375f7a766998f5a056213519a91c0a8aa409949a9c5428b562986a235309a7e4d33afb503b0b460520a3a53288dc8c5566a9d8d406a443454cb50d4b5230ef53806abe6ac21a042e69bd6949069a08aa181a4e9471fe4d20a431f467149ba973ed564e806a334fcd46c2a0a2b353e234d6a74752162d8a298b4e185ad081334c269e48a8c9148a22a551494a95231a6a5438a8f8a728a00b3ba8e3d29ab4f35422334c229f51f3407c869a78c54669e28d0621e69ca2a3a50d500585a947351a528aa10b83453b3c75a8eac91a78f7a6139ed4fa4245494887a548578a8cd4ddbd2a0b21506aca54208a956ad5c469520fca90d3b0d5c67a430d19a28db48031460d2934534c631c5502a335a06a8b75aa319a2ead494c4c6053f1532341bc51d68d9451a808b4bc526680298f40c31a4a7038a6eea926e2734e340a31ef5a5c40b4949d0d498cd480a2969a38f7a713523168e0520c0a31544920a5cd3452f4a11243deac4239aafbb9f5ab3075ad8e63a7d3b35a95434f1c55fa9640f14e14ca70a90251494a0d21aa01b494b9a2900da4a753680128a28a602d369dc5252016969b4ecd210b9a5a4a5a602d3a994ea005a5a4a298165686a44a535622135c578a93f78be98aed08ae57c5316761c50238a7a4db4e92999aa1d84e6918529a43405c6d2629f49d28189494adcd2e298098348052ed34735203b34dcd0050698074a5a6d3aa842d444d49cd32a18ec474629d8a5029d806629c7da9db4525224868a5a654944c2a4c8a841a905581274a4a4a5a602e6994ea4c55122e690d2d262a4a0a29283c53101a502929690c4a5e69b8a334ac0028e94518a04266973401452d46149ba8a314c41498a5a5a042514514ae50ea6e69734da005a4a5a2988752d2507340052d1494d80946ea4e94940c292929335201494515201494b45200a28a2980514514805c52d26296a804a5c514734c028c519a704f7a6843ca63b8a74d105e8dbbfcfd6874031839a6f97cf26b6b12478a4a561b7de92b02c290d2d252016929693140051451480292968a6014b45140052d251400b4b4945002d2d3734b9a043a9c29b4fe2a80945771e187fdcf1ebeb5c30aecfc2aff238f7a24347494b494b590051498a5a002a96a7fea1fe9576a8ea7fea64fa1a4079ccdd6ac439d87155e5ab16cd8538ae94c82d5b96db5427639abd0cbc552948dd4c48af9a7ad46c7352a7e7473165c8f8ab4b556319ab09e95662c9bf1a4a5e0531beb481a0fc68028c6699b6810edd8a88e69f4c2282871fcaa2269d4c6618a4508699c52668d940869f6a664d38d34d0323db453daa265a571d85e291c514d34863a9bc51474a005a8cd3f23d69a68195cd58809a888a5889a9196e9f8351d2eead4cc91726987af5a07d692439a4044d4cc669e734c06a06588fa54bf8d42952f3540d87e34869d45024479a5dfeb4dc9a42290c63d438a91aa13505854b9a8c54dc62a909a19b73561054393522d1ca48f26a32053e98b40c4e28a4e69451a0c701464d2528c1a043734c39a71a675a00aed52454c6a7c66b328b231452538ad513610d458a7354754cab88685a434ab520253d0d35b9a72d21932ad3f753734d22a8910f5eb4da0b0a8e818b8a7e78a8aa4da7bd4dc7719c53d2a3a78a2e4963f1a7734c14e18ad0618a4a713499a4c488cd4678a9985404e7d295c4254a7a545c9a981e282b52115614d5635347d28b85cd2cd3f35153ff001ae33d40c7bd3467d6969314843f6d369c453453189cd5038abadc55161cd5a319dcbeb8229ff8d451fe35252668079a33499a28188052e6999a5db4c071a6914a2834122d1cd2d2d48c61a78a69a14551361e28a3752d46a161df8527b519f7a4cd048ec52e28a4ad00601cd4d166abf7ab1156a8e66751a6c9c56a66b2b4b8980e6b58543321453f14ca70a4325148685a53400ca2969b400521a5cd34d300a28cd1400d3c52d38d369085a5a6d14807d2d20a5a602d2d369d4c0514b494b4016168342d21ab1109ac1f11c2d24076f51ed9ade3581ad6ab0c6af1f04e3d6811c1c9bbe950e6ac4bcd43c5514369692979340acc6e290d4941a771ea466978a7534d0025252d3690ae068a7014550c51474a4e68cd021d9a61140e297ad031b8a29d9a36d48829941a8e90c69a6d29a4a801ca2a4a603453192d2e6994fab2476292978149c5505808a4a5a61cd031d4940a29080d25253bad3b884a50b40a2a4a128a5a4a603a929b4b8a40149834ee280734f41098a28a4cd310b494b8a5a818629052d15402d14946da918b451499154021340a4a6d262149a6e690d152317ad3696929005145148028a28aa00a28a5a402514b4b40099a28a2988514b4ca5a061561a3400609fc6a01536cf7ade28426df7a74898e944b1283f2b669a1013cb55888cd369cdc1a6e2b9d9414628a2a005a28cd253012968cd2d201b4514b400b9a05252d30129696928016969b4b45c07629314669d40099a78a68a7531128c5753e147c338ae514574be167fdeb0e7a55303b5a29b4eac461452d262800aa1aa63c97fa55faced5ff00d449f4a00f3c7c54f6a460d5792a5b61d6b6422edbec02a84c326addbc7eb552e1b9e9564109a72f14c34e1c52d0b2ec46ad0c5548aac8ad0cc989a4c52e3149c1f6a420a4cd05e938a4032909c518a69a6019a8ce2949a6e41a42e61083f4a6eec77a76ea6640a0b1b8c9a6b1269c4d478a06333499a7669b8140832690e2931ef4bc5228314a56909a4a90129314fc2d32818c34d4eb4f351f7a902ee69783ed4cdde94b8ad443ea326a4351b5021b48293ad396b31930c53f915128cd4b5a12c29a5a9f914c34863734c6e69dbb151331a06358d3334ecd32a2e3402a6a854558028421005a940a8c29a78cd3571811519f96a4cd46c298842d9a519a0628eb4143b069c2a3a76695806934cc9a909a61152495da9f1d35a95291458534ec9a62914fcd5137194ce29c69a6a46349a54c521069540a7718d638a55a0814b4032614b48a4d28aa11133536a465a652b8ac475376a86a4e715258dcd4a9cd422a514d08901a7e314d1c52e7dea82c2bd372051c53b6fad5e84d8858e69952bf1ef519a8d0760a701518a9467da8d0646545397348d8a07e752266a114b4163499ae33d602734b9149d2999fad593725eb4deb431fc2954d21ea3585527c66ae35516c9ab319b2fc74fcd451e715203ed48b429a4cd2b7cd4ca401b68e29734da342876dc501692939a426388a01fc6929473ed400501b14ea29921460d28c51f8d260c29d4d268355701e0d28a4e8291734c9647f78d4f0715077a9e2419ad11c6d9d769b8dbeb5a15434f8b6a0abf522169d9a653a9012e6909a51494c04a28cd266900da4a5a4a0414b49466980ea652d14862d028cd1400fa2928a402e69d499a4cd310fa4a2929816d690d0941ab2484d709ae87f35db8ebebffd7aeecd707adb7ef5c55211872d406acba66abb1a76286714525159d8ab8fcd069b4fc835624479f6a752edc526ecd30b0c3495260530d310514d14ea90b89494b4a69dc06eea33452548c563499c5379a4eb4c07e6986968a4223349521a6548c434a290d029012669c05329c2ac0753a9b8a3ad50875252f1494ac0145028c8a60068a4cd2834084cd02929450312968a4a3500a39a5a4a005c525029698011494e3cd36a442d18a29d4ca0a6eea292810519a4a52690c38a6d14da900e69334519a0033494b4948028a5a4a0028a28a6014514b4c0314b46292a405c5252d21a6014519a280177514629314c448ab56278e05ff56cc47fb58a478e25036927ea4527969c65b8f6aeaf9103022e46e38fa534a0cd3e454cfca78f7a4554ee697c8a223c7a52529a4ae6631b4b452d218633e83eb9fe82928a2800a28228a402d36973450019a29297340052d252d0014b498a5a602d3a9a6969dc05cd2d253a98875741e1a389eb9e15b5a13e2e23ff000aa607a0e68a414b580c5a2929734005676b07f70ff4ad0aced63fd43d0079dcdd6a580d4320a92db1deb6116a2dfef55e6ab11ca2a098d508ad9a729a4c7a50a68116d2ac21aaa86ac2835646a59db4bc1a8f34ea63b09b4d2631de82693ad04d8426999a92a2247bd228427151f4a931ed518a40253718a733547cd0086f3494e14c66cd2650d6346290d2548c0d1494a2a8037521a3149523169b4a71494c04a89b8a94d42d50c6594e6a4c54119a9d45592d0e1c534e0d3aa2e2801bb69683cd2839a404b18229f4da7e2a881bf3537269c69849a0ad00e298c452d333537288e9b4f26a3a819228a9338e94c8ea43c715602ae6979a4cd39714c911aa32d4fa6d001ba9b475a5a455d0a28a29b48914e691a9d9a635263226a12908a55352327fad3ce2a3069d5a0b4109a60a79a6014ac2186945252ad218d34f5a660d3c66a409852934c5069c6ac621351134ecd262900c094fa6e7de9cdd29dc64752d462a4142449286a5dcb4d5a3355618fcd21a4c514c818720537352fd6a36c545cbb11d49d6a3cd48b9a1098c34a840a1852f068b08d5a42283ed46715c47aa2362834868c5508735028a70a918daa0f9dd5789aa2dd6aee653b9723ce29fc834c8b753dcd49a0ea6d2d21c7d6ac04cd2714b9a40052630e69c692827e9488129e1aa3a51ed41571f9a5a68a514c560a314b8a5a80129719a334629a26c2d3c520a755015f9dd56611cff00f5eab87e6ae5aafcc2b7392c76900c28a9334d8beed3b8acd902d2e69b914e14089568342d2d0319494b4940094d34fa61a002969053a9801a4a0d148414b494b8a43168a0519a6217345145003a8ef4945302e2d23522d21ad0446d5c6ebf633799b823b03fdd426bb2aced45cc71330c647ad2b88e2f51d39ad563cf048e958ecb5bb7b7df698c090e5c771584f5432324521341a6e690f41fcd00d2500d35601dcd029692818ca2948a69a0cc514b4d0714b5631a68a752e2a46368c0a760d1d690ee458a5a76da4db4ec17194845498a29d9086d44d53e08a84d4318ccd28a4a5a901c29f4c14ea603b6d146696ac070e6969052669030a4a5149834c419a4c53a9281094a28a4e68285a3f4a28a40068c7bd2d2d30b0da5cd262968109b4d18a5cd140584a5a4a4cd0014b9a6e692900ee94da5cd32980ea6d14540c4a4a5a29809451495203a928a281852d14521052538d25300a2968a003349450734c04a5a4a762900669c0669b532a2fad6d1403b67bd3e74833fbb2fb7fe9a633fa53a78e11fead9b1fed11fd0534471ff001138f6c574198c58e3cfcc78f63ffd6a8c85cd3d8479e0e07bd2652a4a213452e294d733450ca2968a90128a5e94520128a5a2801292968a002948a4a5cd00252d252d0014ea68a5a005a2929d5421d4b814ddd9a70a06380ad1d31f64d19f7ace1cd5981d811d2a80f4f5a70a8d0e466a4ac405a29334b400954357ff008f793e957ea96a9fea5e803cda4a7c18cd365a64479adc572f4718cd457029f12927ad3675c551055e94b51924d3d6a4a2cc6c4558439aac9562338ab192e2a518a8f3f5a5cfb53330141cd38546c68189cd4678a7e693340ac37351e4d2d309fc690c5e699bf14f2722a3a0b19d6834b914dc9a091b45293ed4993598c4a4a290d318b48296929922e314da5a4c5263b898a89aa5a8c8a43162cd5915511aad2fbd0843a9878f4a5a69ab631334e5a6e3ff00d54a95022506a4a68a3354026e34dc52f4a69cd171099a8dbad3b269a6a2e58dcd30d38e69a6801ebc5499a6ad2d3b887629dd2906ea7e2b4b80dc547906a4eb51d400869df8d149d695c2c14ec0a0d3680b0b4c39a7530d20b8c6a45a1a9528193814669334ec5558434d379a70a693520329c299cd38521e82538353734ece3b5301f4ea68f5a7e7345c436985a9c6999a0a18314f7c533bd3c834806835362a2029f4d3112fd29993520e6987ad3b884a7d20c77a396ab2469a6529148c2b22c6d3c0f5a662a4a6035a9695b0690d016350eda4cd29a01ae53d2034526693e953718fa45a38a33556188d549fad5caa92f069a3391651f8a77e54c8e9e6914484d37e949ce2861c504864526280a2969940d482939a157dea6e2169d4d6e28ab18e140e29b9a760d048a7342d252d22877140e69314ea448efc297752528a64900c66afd97df1547bd5ed3cfef056e8e5676a9d28a55fbb4dac881f40a6d3b34c44a0d3a9829d40c6d252d2520129b4ea6d50829d499a290c1a9334a68a004a5cd252e69087669334da5a602d2e68a2801d499a5a434c0b6291a8148d5648c354ee605994a9e956ea1a919e7f7d079591dc565366ba7f11db18e4dc07caded5ce31e2b4b858af814dd98a7914cc548f4038a338a68cd2e2a82e38b52669b4b400b4868dd484d02179a5029a187ad3948a77014629d494f1542139a4e94ecd27341421a69a75329884a434ee292b318dc542d529a8d852603292968a901734b4ccd3b3480900a774a8e815a0684b9a0734dcd285a007534d2eccd2d00373452b525313168a4a5a602514b9a0d2b0094ea4a4e9458029690514863b69a6d1bcd266a85a0b4d269734d35030c8a4a28a40252668a4a2e02d2514b9a40149451400669692969009452d14c02969296980514bc526690099a28a2800345149400e146ea3345300ab4d1c600da5bf1c5401054a1063ad74c1123828e33fce9d70b0eefdd96d9fed75a59e2897846247fb5ffeaa445881f9be61f522b4208d7677a88e29cfb73ed5134958b97a1a584de697351d4b9ac4636968a4a005cd2514b8a560129451450025253a9290094ea4a5a004a28a2980528a4a2900fa29053a9802d3b22938a2a84482a55e2a1a955e988f4cb1937c487a7156ab37486dd6f1f4e9dab473589414b494b400554bf1fba7ebd3b55ba82e94b211401e5f2fe549154972793d2a1435b925d12e1a9267cf6a51b7752dc6da62291a33452503b9641a9917deaaa5585f4a64b2d21a766a35a9314c91726994e14de681919e69a38a7eefc29a5f140598d2f51b53cb532818d39fa5252b1a66690f41291a969bf5a07a085a9b4e34da90b0668c514dcd021c78a67269fcd373523140a4e2928db576014d31a9d4de6a742860356948355318a9d29098fa61a7d309aa243269c0d47522f1421936e34a79a8f9a7d682b8de4521a4cd26ec7a56652b094ca53cd36a440d51e69fc9a8e9157265a9453169cb4c429dd4e1ba8a4c9354210e3b52668e69bcd27700e68e94669282f41db852673de9bf853b69a0914d32969b4088f142d3985340cd4944e294d0bf852d56a0379a69a731a6e286047d29c39a4e29540a910da78a6e69453192834a69a052e69ea1cc266a334fe94d3520329ec4d329cc7348015c53d6a3a996a8962d2528146ee698c5a6fe14e279e29092298846151b548d499a45588bad4a8715153ea007536930d4f1401a6c45216a539f5a4db5c87a41d29b8a7353726a863f147d29bbe9c69000f7aa12939f5abdf8d51949cd5a66532c4678a96a18fdeac0a4c614acd494dc516284fc68ff003d69c40a4a10ec2669c831cd26334a2aec4b0cf34dc52ede68071ef48a129f9a6d2ad201d4e14c26978f5a5a91717a5283452814877243463e9f9d37f5a7555c9221d6aed8afef16a88ebd2aeda7df5eb5b9c8ced474a6e684fbb4b8acc81452d2528a064ab4ea68345310536969290c29b4ea6d030a052528a09026929c4536818bcd2d25148029d4945310ecd14da75002d1de928a605ca61a70a46ab248aa3a90d4552ca286ad631dcc4771db8fe2c66b809b68ce39af48ba4df1b0f6af399223551b89951853314f39a6550c4a5e293ad18a004e69314a73473400506936d3aa85718168a71149c54d803352e715153d4d5d80931498a5a6d3062d3739a5a4a42198a6f3f4a5cd152312a3352546c290c8e8a5c52540094b4945201d4f14ca5ad044829734da5c52b00fcd19a4e680298c53494b4845300db4629052d1710da5cd146298094ea4a290c29296998a402e68a4cd250c90a4cd19a4a8b8c5a2928a630a4a5a4a00294514b8a40368a28a005a28a2800a314b498a6014a28a4cd1701d4da28c50014945148028a296900b49452aae6a90122ad5896285546d6627fdac534a42a830cc5a9a10776aecb10382af1b8f144be56ef973b6967108384271ee6ab349b7a735326211a5f4a8a8a2b92e681520a8ea5a004a4a5a4a005a38a4a2a805a31494a290053714ea4a40253a928a602d1498a2800a5a292900fe2928a506900a053a9a29473562241520a885498aa19dfe80fbadd2b5ab07c2ef983f1adfac402973494b9a00299274a7531ba500798ddf0c6aba75abfaa26267fafa55015b5c562f08f2692e230b4cf3483de96624d509b2a1068c53ff001a6af5a404ab53a66a0153a534227526a5fc6a119a9326ac341d4cdd4b834ce948913ad37141a4c1a6084e290d2f4a61229144671494e18a69e29007351e29e09a652b801c53334efd6931414069168a295c9149149c520a4a9b162e68a5a6d5009cd369d4da9248daa78d8544d4e8a828969339a53cf4a65310efc69c29b4a2a844bba97e6a60c77a5a421a452114ea6e698ec2531969d4d26a0a1a4d369692908b007140a1696a84c7d25145003775341a5a6f6a060d45252531d87668c9a370a414123b8a4e28a4e2a4631a9aa69cc298a2a065914526da41561763b229869c49a65310c34ab498a55a40069ca2a339cd4805318e14e6c534d2fd680185a8e29d4d26a1c58223a90d332287a450a054c2a25cd3eab5207d2518c53335431f91464536a40b4c08e8c52e29a7268d4061a70229a69ca2b3602d00914945581ab4b91466936d719e9084d34d3a823d681dc318a5f9a91a969084aa72f5ab7f85529320d599c8b51e3152e6a28b9152f148685a6e734bcd2628b8c4e0d2926969b4b428703499a4e29722a80463451c1a76280128eb466973ed4d898a36fbd1c5146ca9b93a01269e3228005262901216f41416fa500518aa111c6a73572dc90d55a026ac444035a9c8ced216cad3aa9d9cdb96add4b242a4a6d385003853f14d5a7d3019494ea65200a434b494c04a01a2945020269294d25218519a5a4a420a5cd14034c05a752714530168a5a6d005c148681486ac923a8aa435166a1940dd2bcfb5150924817a67a57a09af3ebf3991feb5480caa6d4841cd32b4b00cfc2929dba92a58c3269726929dd6958426dfa51d69722818ab10ce69b8352914ca6c560a771494e02aca0cd3b9a6814e140829b9a938a662a4084d14e34da91094d34fe690f140c8b1454b8a8d8540c8e92968a901c2969a296a8092945329c2900ecd29269bc53b9abd091a29c68a4a63168a4a2980514a69b495803ad2514ea2e0328a5a4a918536969290828a29290c334b9a6d14085a4a5c525031692968a4019a00a296a80292968a00292968a002928cd1480334b4949400b4945140094ea31462908314f5db51e69b54865ac0c75a7c8910c6d27f1aae0afbfe34a5f1ef5d372456602a026949a4ae67218514515230a7834ca7814c05a4a522814009452d14c04a2834b4802928a2900668a314b5402514514805a36d14b9a004a5a28a005a70a60a78aab887ad480d458a931540763e166f95c574b5caf855bfd60fa575559343168a28a401486968a00f3cd6c6db87fad6483cd6f789976cc6b000ad419783806965606a211e31ce6a59914559053f969b46da4a0a274c77a954d42953a31a913240d539e6a156a982d6866193494ee82a31f5a603587bd212694ad23516290c3934ca909a6122a4633f0a8ce69e49a4db4806f4a4a4a28107f9eb4dc9a5349523108cd253a9b4ca62514628c54883349453a90c6536a4eb4da008da9d1523522d2404fd29869e69b4d8062a5e2a3a335448fcd38e690506a8637349d694d36b31894869690d00368c52d00d3026534e0298314ecd50074a4cd3cfe74ca448869a09a5a42690c5a31480d2d32828a6914e50293121b4734e38a6e7daa6c323348a69f8a681483526a5a41435682109cd3714eeb4d348426290714b9a33487a09cd386690d28a48094628ce69b4ee9ef4ee363334d34fa6d301941cd14ad500392a4c53147e3527cb56034934ccd3f7546681b1c08a9031a88d3a815c77eb4c34edc6999a7716825381a61a5cd4941ba8e697146ecfb502353f1a5a4e3b52e4d73b3d211a94a9a4a424d2b8c1b3e94b91473498145c428cd5298f3576aa4a28444cb11629f51438c5494c68751ba973475a0a1b451b69b9a8b300a538a066948aa012977629a0d29a0414fc629b4b9fc69087669050314a69d862e2945369c0814b9443f34a5693ad28ad04314e3a1ab102ee6f5a8514679ab30b6c6ad11c8ce9ad222a2af5456c72b52e6a59014ea6d3aa4078a7d3053e980da6d3a9b4005369d9a4a60252d252d2010d14a692800a5a4340a005a28a281094fa4a2801696928ef4c0b74d634ea61ab10ca8aa5350d48c5af3cbb0de63fd6bd0c9af3fbbfbef8c75a7103365e2a2ab0d81ef50d58119c8e29314f2a4d348c55009d29d494bd6a588653852d18a091714c229f8cd07141761829d4dfa53ba55087628a2819fc298828e94b914cab019494fa666a180530d485a9bc566c61511a9aa36a60414b452d6630a5a4a2980feb4aa6999a7669d82e3cd2d369e2a80375262978a4cd3420a75369690c6fe34519a4a401466933452010d251467340094514500145145001494b45020a28a4a4317345253a801296928a602e6928a33400b499a5cd266800a4a2978a4019a4a28a601452d1520028a28a6034d25145201734134da5a2e0145145200a5cd2514c029c0d3694500494da296a8029d914ca5a2e025145252016929d4500252d1453602514b494805db453a9280168a4a5a0029c051b68aa1585506a50699b69ebf5a633a8f0ab7ccf5d7571be15e246fa576550c05a4a28a900a29734520389f138fde8fa5735b6baaf1527ce9f4ae59ab6249c678a925c9a40e38a91a5f6154051dc69334f2453692192015610d411d4d5a124ea08a9b24542b525048ea6eda900a667de8111b5217a52be94cc1fad3280ad458c549bea3e2a0ab8c6a4cd3a999a6200050693341148a12999a5a5c5480cdd4bba92968d40434dcd3b8a60a0438d2734ec0a42b48a0dd4c229d9a4a2c21a69a3ad3a9952327dd498a414bc550829c0d1c502980ec537069ffad349a7713436928a5cd4d8068a4269dd29b9140c4a05253b340c9b8a414b4e438f7aa648a2a3734efa5369201b4b8a6d2f141439a9bc52e3349523128a30697145c91b4ee69b45003734252ed1eb4d140c9b8a434629698839a6914b9a2861a0c0699526298b487a8a694523d2ae2801e2834668a0402984d3e90d4ea511d2b9a4a1a988917352e6a14a97a55a10ca6f4ed4ea406968509d69c29b4b4843e9869dc52715570d088d3c521a504d45c028e69d9149d6aae06a51de8c52ad729e909b68cd21a5a3510b41fad2373e9498cd22875509473d6af1cd529be94d19c8b316314f18a861e95362a6e03b77b5267d28ef4a4556a58d228e28a08a00051d299d69fb6906a2e0fb52669452134c06814fdb8ef4d14f07da9b203069c09a65386690c29f8cd4793526eaa4263c9140a0734829122c6a41f5ab02a04a997935ba3964757667e41564555b1fbb572a19220a75329f5203d69f9a6ad29a004cd2529a4c50014da7536a804a5a6d3b14805a6d041a280149a5a4a2800a2901a5a421696994e0d4c0751de8a4ef4c0b74d34b4d6ab248ea2a92a3a9650a6b82bbff0058ff005aef4d709a8c3891feb444199922541d2a77df4c64ad44467dcd369ffad329886e334e19ed473450507e34a4e69b4e040a40274a5c52f5a315621945078a415231f4a4d339a76edd5420c50052e4d06aae161acb5174a95b351d66c561a4d3a9b4ec548c6e6a3353669845302122929c69b590c5a5c5251400b4b4525301e2a4a8c5482a921075a4cd19a2aae01c525068a398621a4345254805252d25002514b45480868a28a60145145200c518a28a002929714530169296929085a2929698c4a4a5a4a900a296928012968a2988296928a43014b494ea6034d21a7d47400514515201451453016928a2800a2969280168a28a007d252d25500b4da5a2900628a296801296928a00296928a0029d4945002d253a92aac02f4a334947348076734b494ab400e14f151e6a4aa03a5f0b1fde37d2bb1ae37c2dfeb5b9e315d9d67200a5a4a4a403a928a280394f158fb9fe15c89aed3c558d895c535588b28b9c54d227155c16c0a9be6c568665429466939a4eb48a255a90544a2a714c5625de6a6c544bc54a09aa10e2690d028e281d8424545934f229a5a98c8ce054669edcd3281099a6629d8a6d6630a6d141a0a1a78a4e697149834591226ea294d36818a41a6d3b9a4a06148d4b48454ea210628340a291414c6a7f34d354c42ad3b8a6834b5203a9d4cc528aa01c68a2928105271474a296a50714dc518a3340094a2994f5a2e492934e06994b45c62134de69d4dc551226296929315250ecd2d2628c50c351334668cd250316971498a28018685341a290135369692a95c90a69a5a28b00da38a3228c52290a6914d041a14548c783452d36a891d4c34ecd2352191e68634529a044a94b48b8a7135571d88e90fb538d329006ea70c114dcd3979a403a936d21a70cd50588da97148dd6954e2a005db4ea61a766aee1a1ab9148b9a4eb474ae6d0f4431461a81c50cdcf14162f5a4a4c5057141019aab375ab555666a64c89a3353039eb50c3f854d9a968a42114b9a3349814c61b6929d49d28d062e29bcd0d4b9145805a4dbf85149d6824518a914d458fc69c78a57014f34e029b834ff96a8046a70a6e29c292024a4a5cd369a2054ce6acc639aae8a7357156b53924747667e5ab754ac871576a091696929680244a7d3169d40094945273400526290d14c0053a9a2968006a4a1a8a421334b9a314b40094b49471400b4514b400b49de8a3bd302e0a6353a986ac430d435354352c0766b8bd614895ebb4ae4f5e1b26fa8a10d982c2a2353b8aae6b510de09a69a92a320d318ca75181498c50160db8a4cd38536988766909a5c814dce6a0437ad26d34b9a6efa772ac8928a68a75592c5ce697a53e2b7964fbaaedf45ad8b5f0a5f4fcb2ec1fed6e0dff00a0550cc3269a20b97fbb1c87fed99ff0aefecfc156f1ff00ac5f37fdf03fc2aedf5845696f23048d703b201516445cf2ff006a7629bce69d52cd03148d4a69bf5a4222614ca9aa32b5031b4b4945002e6968145002835283510a79ab017269699451710b4945201486252d2514006692834524014b9a6d2d480514525500b413494b814804a2968a002978a2929801a4a5a6d201d41a29334c61499a5a281066929692900b494b8a298094b46292900a2968a2801a69b4a69b480751494b40094b494ea004a4a5a4a005a2928a602d145148075140a5cd5005252d1458028a6d2d200a28149400b452e28cd3b00a28a4a41400ea514940a603851494bc5002d14838a5c50028a90715154a07ad5224ea3c2e3e77fa7a575d5ca785fef3d757593285cd252d14804a051450073de29ff54383d6b8735def8947ee3f1ae11ead012ab9c5592f95e2a140bb6ac12847a55925326a2a7b5474c64c29f5129a97ad50c97f1a9435422a5a76209778a652e452e6815c8f3519e7d69f4dcd02b0ce69bf8d3b70a616a658dcfad3726a438a8f8a8d0a0e4d329d48c6a513a052629297f1a342869a338a4a0ad210fa68a514849a450532971452244a0d14955600cd369f4da43116a4a8c53aa4070a762994a2b510b462838a69353701334e0d49c5146a019a0d195a4a4310d39734c34f4a621dcd494da39f5a06349a6eea2978a3510629734d145200cd3a93a5078a06369690d02801d9a339a4e94b4c04a653a9a2901252e69052eda621322940a4008a4a430a6d3b34dc53017b509484500520d47669dc8a6f5a5a601452d370693019cd0d4b43520244a7f35125484d0319494a45349a3401314a38a5a6d021f9a766999a71aa111d2e694ad2015230a334b4114058d5e29d4ca71dd8ae7e53d3034dcd19a763da810da4a0114a48a018daab355eeb54a70734ccda2684e6a6a821ab18a96544514353453b34ac5099a68a5eb498ad0028a4c5385493610d19cd3bad34f1421d83a53b19a6f14efa5301d45369775021f40a414ea421d4e069b4a29923cb826ad4205530bcd594639ad51cace96cba55bcd52b16f96aed41219a78a8f1525318f4a7d3169d9a0029334a692801b4da5a2988334b4da7d2010d369c69b40c5a28ce2909a0419a5a4a5a042d1494b4862d277a5a41d6a845c151b5494c354223a8aa522a1a9631f583e2283856adeaa7a9db19a22075a101c2480d406acba1ef55cad6e411d369e569bf9503d48d69c4d274a5e0d48ee2281498a7e28c5301bc52e314d0b4f2b9e9486454dc55e874e9a4fe1ad0874160416cfe2b54232e0d3ee27fba86ba4b1f076fe663f8038fe95bf67a74310e1456bc31d224a769a25bc03e48d47e15af15a28a7254d9aa24428a2b07c4819ad66dbe95ba5ab23571ba19075e0d00790375a334878a2a4d053c5253bad069886521a391454011d262a4c5252b14368a5c52d16011453a929334ee216928a2818ea652d20a918514514c4149452f348028a4a2800a5a292a842d252d1486252d14520128a3141a401452528a004a5a28a6021a5a4a2900b4da7514c005251450014a292968014d369d9a61a004a28a2a4028a5a2980514514c028a28a40145149400b451494c070a5c520a7530128a4a5a40252d145001494b450014b4945002d25145003a8cd141a402d2f14deb4ea6014ea6d2d500e02a402a35a78a623acf0b0e5ebaaae57c2bfc75d566b36316969b452017148296928031fc42a4c06b816aeffc41ff001eed5c03554407ae5854df672075a8d1bdaa6677c56c414db8a6d398e2995050e06a55c5442a518a68689bb53c7350a9a994d59931fd29c69b4ea60308a888f7a9698d8a91d8615a6549515001b690d28cd379a45e83462969b814134084268a4a762900da434a69290ee27e54518a5ce7d3f018a4014da534521e825369d474a60253714e34948432a4a8ea414862e68a4c502ac41453ba52520b313340a4a5a0028cd2515202548b51d28a632514940a4ab00a4c5252835002d19a4a4aa01d9a0d2514806d14b48296a03a8c514669dc3412a3a79a6d481252d20a77e94086e69314bc52734f500a0d2d21a631c0e6994520a43b8ea5a5c525021314b9c506909cd002f14d39a4c52d218e5a5a4a5cd5921ba994fc536a47a8da78a6629d480534e145373561a010690504d2038a9b0c71a4a28245311add68cd02949cd72e87a8379a524d27e740dd4c91a053873464514861baabcd53d579ce299122586a6aad03559eb50c6ac20a09a5a4c5505c29bcd3ceea60a7718fa6629d9cd20340829091f8d19a09140c314f069b9f7a7668b9214a69324d2f5a77402d397148690366a492656069c0d45f854a8cb57a087719a9514e6ab03f3d5e438ad4e466ed8b7157b3546c47157c5400e1466929334809d314a714d4a4a603a9b4b45021292969b40c29d9a6d00d0214d20a09a4a402d2d2519a601452669680168a28a6014a3ad148bd68117298d4fa61ab2461a86a66a86a19487529a414ea00e3356b1f21cf1c1ac76aeef54d3fed51f1f7ab8b7b4981c6c3bbfbb8e6b44c19505309ad21a2ea0dd2d67fc536ff00e858a864d32e63387001fad5682b9469dd2ae7f67483d0d396d3caf9a5c01fef7f81a0762860d3bcb6a9b0c4e455b8ecd8f5e6802a2d9b3f41cd6b5a69007b9a9e380256cdb4205400db6d3957a8a9aea1e2ae2d3674dcb56891f66772d68c758fa7cbdab5e36a605a14fcd45be90bd021ccf59d7d27c86acbbd52b8e9ff00d7a0479249e951d58b95d8cd55f2293341d9a75446943d003ce2998a37519140829282682d482e3a9a4d19a61353718669334945480b4b9a6d2d30177525251400b9a334525002d2d36968016928a4a005a33499a280173494b4520168a292a861452514842d14945002d2d368a4019a28a5a60252e69334500145145002d2d18a33400d34da53452012968a5a004a28a28012968a29805145148028a28a40252d14530141a75474f14ee029a6d2d14c028a4a5a4019a29696900945068aa18945145210b9a28c52d00253e994b9a007714a2814b4c439714e5a60a954569a01d5f850ff00acfc2ba8ae67c2c3fd6574d58318b4b4da5a00296928a00c2f12b621c7bfa66b857aee3c4e3f723eb5c331ab8813c18c55af936e2aa44b91567ecec17ad6c8829baae6a3cd3a4a6548c729c53f26982a50284558917e94f19a664f6a914532091734118a6a50735648de947d68cd33ad480ad4ce28cd328b0c4c5252d3334862f148dc514366a0b0a4cd07346295c04a4a4a5c555c039a4a052d48c4cd252934da042d2714a292818946734b4869084618a4a52692a407e68cd2668e6a843a933494645031314519a2980b9a314034526c04a7d475203400a28cd19a6d31899a28a5a2c20e452d341a2801692968a006d1453e9009452628cd3b8082834a29b48070a753452e6900668cd21a4a621d452668a002929d4946850669052e692810b9a5e2928340003452514c07e68a4a334087e453775275a4a0a108a5a4340a3415c775a5e2936fa537350029068a4dd4b400a290d2e69a4d501b19a5fbb4d14bb6b9cf484c9a5c8a0fb537155600a71a318a2a6c02554b8356f18aad30cd33398f831daa7a82102a7e948b42538eef6a41c5231a5a80b9a4c514134c760e6994edd4debd29923e908c528a414140a052ab529f6a4e2810fdc29334a2939ef4807d2500d28aa247834f0298a29eb489102f356d58554ef564262b6392563a0b0638ad1159f60bf2d5fa8603a90514b4809d6969ab4b5421a6929690d201290d3a90d0312969296810dcd14b494805a4a75368016969b4b4c029d4da4a00750bd68a41d6988bb4c6a7531aac434d418a98d426a18c7d2d3453850014cd83d2a4c5250026dae6b566db2574d559b4f82e0e5914fd507f85341738f677eca6a292d667fbdc575cda3af603f2aceb9d3d81ad8452834f503d6acac5ed5712cdf1d2a45b17f4a9194d63cd6a43d299f66db4e829580b6b4f22a314fcd3119e8de5495b08f9ac6bb1b4e6a65d52045cb3aafd5b1542364353249957bd72b7de36823e21fde9f70ca3f9573779e23bebbff968547a271ffd7a5a8f94ee2efc47616ff7a61f4018ff00215cf5f78d3764429f8c95cb72d4be5521d9114d297393c9f5a84d4ac31509a9602d21a4a4a2e019a5cd2519a402e69b451400b9a4a28a004a5a4a5a4014b4940a000d1452e6980941a28a0028a296800a29296800a28e692980514b4948028cd2d25002d25149400b4b4da5a4014bc52514c029452514802929d494000a5a29fc5500da4a7532a404a28a5a60252e6928a401452d2d301b4514500145145200a28a2800a28a2800a5069b4e1400b9a4a7525300a281450014b494b4001a4a5a36d301b4ea31494805a5a4e68a00334ea4a766980b4a0e69a29f408334f423de9829d9ab11d8f85870fd6ba6ae6bc2abfbb7fafa574b593282929692900514b4940189e251fb9fc6b836af41d7d7fd1dabcfd85500f89b8ab2b21db504214f5ab88d1aad6c66ca0cf511352c9d6998c52287253ea25a9453b9571ea6a6cd458a9299238d02968e9daa881b9a8cd494c75a92c675a6d3e994ae53129a714b4da4488568e4527346690c08c521e6973486a46369c5bf1a43482a8053499a5a69a4014da752521094528a6d0862d21a5a3148029b43502a062e696928ab10b9a4a28a40386290d2019a5a0a1292968aa244a7d329d400669334b450c001a5a6d2d08028a4cd14ae014ea6d1cd2d4029e2a3c669f4ee20634941a4a062d281498a948c53022a2928a4014bc5147e5f95558414669292a463c0cd2352e7141e6a8068c514515980b9a6d2e68aa01d8a4a995322a135403b34de6928a5701c08a53834de29b5255c522914d4de5f15162992068a33494ac014fc5369c281a0a61a90f351d311af9f4a77cc69b4edc6b9cf4c33eb4de69e39a69eb40842d8a56c534d28028275063504a6ac55696992ee3a23ed53d41166a7c521c45ce6948a4da6977d058ca5a46f6a29801229b8a4269dd6a442d22fe54bd692a8078a3a52afbd008a4c77168a15cd2e335248df969eab8a6e7b5394d3b00f14f14c18f5a78a0908fef54c5b9aac300d5c862c9add5ce3773a1d3cfcb57aa8da0c55ea96216956929c281922d3a90529a04369296928010d36968a00296994ea0418a414a69b4863b3494a29314c02968c5250028a0d1452016917ad148bd6a845ea8da9f4cab02335054ec6a0cd480f14e14da514807514526690c2a486a3a7c5d69a112b8acbbc1cd6ab1accbdadd105a847ca2a4db515b3e56a5cd20219055357c1abd25663eeddf28cd4965c0d55ae758b7b7fbcd527d9646fbcc47d2b175ad351137724fb9a9b814351f14493710ae3fda6e6b01e79dce5c93539515175ed4cb19b58d382d3b38a33deb4109464d2e7345488af2d438ab128cd56348425252e28a9012968e293145802928a2800a28c5148028a292900b45145300a28a2800a29692980514525201d45252e68185252d25310b494514c05a4a28a4014114b499a4014b4945002d1499345500514668a40145145201452d1494c019a9b494b400b4668a2900514514c05a4a5a4a002929692900514514000a29296801296929680129c29b4a2900ea0d14b4c04a28a2980b494b482980134514b4805e9494514c039a28a284018a5a296a405cd3b351d3c55123a9eb4ca92a8676be19c7927eb5bf9ac6f0eae2df9ad8ac862d2d253a801b4668a4a00ced6f9b77fa579dbd7a36ac33049f4f4af3a7eb5480923a9d23cad5680d4cb29ad512caeebe94d35235309cd41436a414c14e5aa4413d3b9ed518a91726a807d296a5e9d69a7da980da0b13da8c1a4dd4021a4d37028c9a31415abe83334c34ec536a4910d028a456148604d19a434940c56a4a4e451cd4d8075369d8a6d031314519a334b500a6f4a5a4a0028a5a4a401cd36969b5203a8cd252e2aee019a5cd3697340051452520168a4a28014529a33466a8419a052515250ea4a4a4a042e6968c5014fa1a2c02d275a7796fd714a2290f407f2aab30b8d14b527d92e7fe79c9ff7ecd3bec175ff003cd8d1cb20ba2b52d5d5d1ee8ff081ed9e6a4fec3b9f6fce8b315cce15267357c68739f4a77f61cc3afe869d98ee6635256c0f0f37fcf414aba00fe273ff0001a76279918b4a2b7bfb0211fc64fd6a41a0daff007cd160e639ca05749fd8d6bfe4d20d16cbfdaffbeffc68e50b9ced394d745fd8f683ff00d74bfd93667b73f5a39439ce6b14b835d20d2ad7d3f33521d26cfd3f5a2c3e6472b4a4574bfd8d6d4efec4b6ef9fcc7f854f28f98e6fcca6115d38d12d3fc9a0e8769dc7fe3d8a762798e5f14574ff00d8f683d7f3a53a2d9fa7eb4f947cc73028c574cba3d9d2ff0064d9fa7e4d4728731ce9351b1cd746da45b76e3e8dfe350b6830766707fde1fe14728b9d1cfd2d6cff006147fdf3f98ff0a8db4619e1ff004a5ca3e64655266af3e94ebfc6bf9d43f62714ac3210d4de6a568699501a9afc0a4cd23520acac7a43fe94d24fd68a681484c5a01a5fbb48bc505585a826ab19aab3835464ee3a0e2ac75aaf17156054b290538d3053fa52650c14bb8d2114bf951601b8c500d2e699f95003b34514bbaaca034abc5253d501a440829453dd00a60a910e34b49d28e6801c3e94f5cd37a53900a64898e6b5ad96b279dd5af6c78adce491ad6ad57aa8dae6af54b10b4b4da75202514ea68a7500369294d21a402526296929884a5cd1494c018d14868a4316973494b48414519a4a602d21a5a2801b4e4eb494abd6988b74c6a92a33562186abd4e6a0cd4b18fa753696a405a2928a005cd2a9c5328a0659661542efa53cab7f7a97ca53d79abe6158af693f1567cc90f414a001da9e0d2720b11f96cdf78d3d6355e829d9a39a402d52d42dfce8c8c55da6b51703cd5f8a8beb576e60f2dd87a1aa8c01ad0d48e9714e0298d56489b79a56cd369d4892371555aadb0aa8d9a5a886e68a4a5c566018a28a298c69a2968a0419a4a5c525001451450014514b4804a28a514c02928a334800d14514c05a4a0514ae30a28a298851494a282681894514521051494b4c028a314952014b494b4c028a29698094fe293029b4c07714c34514ae014514520169692969805253a9280b0514941a60140a4a4a402d068a4a0028a28a402d25149400b494b45003a8a0514c05a5a6d2d200a50290514c05a29296800a28a2980ecd379a3f0a4a403b269692968016941a4a2a809694536a68be957a08ef3425c5b274e6b50556b087ca8917d0559ac6e3168a4a5a4316928a2908ab7cbba27efc579a495ea32a8c73cd7994ebb19875ad100d8319e6adef8c0c554403356920dd5a225a2ac84530d3e48f14d2a698082a45c0a6629cb482e4a0d3c35329c39aa01e0e69a78a02edf5a38a00338a6f5a7714da624309c53734ee4d260fd6a742ede6479a29718a6d0262525141e2a402938a0d1c548c6d2e3145155a00669b4bd692a6e02d34528f7a31400526696905300a4a5a4a4025253a956267e9520328a9c59ca7b5598f4d1fc4d4ecc5cc50a315b51595bfa66a4786d4748d3fef9155ca4f3185b1aa51653b745ad7fb4469f740fc285b9efc53e51dd99bfd99377e3f1a98694cddc54cf72c4d4ab39aad08bb2bc7a529382dfa558fec9813ab16a6895b34af3531ebdc7a69b69dff009d4834fb4cf4155d5cfad3fcd34b41ebdc93ec1643f869f1da590eb1c67fe002aab4869a26a0cf52ff009367d923ff00bf607f4a5c5aff007573feed52f33de99e75319a48625ec334a6643d40acd2d9a6f98d4235b1a82f40a4fb48acc121a377bd049a4d762817c6b30b8a7f984f4a649a1f696a3ed39acf5969779a4558bff6ba8fed26aaefa67986912d170dc67bd2fda3dea98973d4d34be69945bfb49a3cf3eb54f7d064a00b9e713d4d3fce354bcda709aa4ad0b4b39a7f9c6a989b1479bef4125cfb451f6aaa5e61a5df4c65efb46293ed19aa7ba9bbe802f19f3479fef540494bbfd29928b9f683479d54c35234c29165cfb563f8a9bf6b3eb543cda377d281e85b6b8f7a8cc8deb55b39ef4c2fe9fce90895a43ef9aaf2ce7f0a524d57724d4dc6c19b351e68a02d401ad914828ed425607a428c52e0fa51d2824fad048da5c52353ba505067155a6ab1b6abca2a8890b0558cd5580d5819148103714ee28c66936d2b0c0d00525005494231a38a5c7e14dad091734a01a414126a6e02934e57a6e734e007d28d4351d97a4a051f4e6818ea5069b9c539681126fa514ce69cb9a489173cd6b5a9e2b27f8ab5ad856e71c8d8b55ab955adb18ab35220a5dd4dcd3852192834ea62d3a9886d14b9a2900da28a4c5300c53a9b4b4c061a5a1a92900ea4a28a005a2928a062d2d369734804c5393ad2509d6a845da8da9f51b1aa248cd43529350d2631f4b4da5a4316969b4b40051499a290052d2514c0502969b4a2810e1466928a403a92929d4c0e235842b338c564605753e21b4e4495ccc8b546844cf486929d5570139a052726806aae40c639aaed53d404517111d253a92a004cd253b8a4a5600c514bcd25318945149522168a4a5a005cd19a4c51400628a5a4a60145145200a5a4a2980514b494803345145300a5a4a29000a28a280145252d2500c5a4a28a005c51494b9a601462969698098a4a52c2a3cd480b45253a98094ea28cd002d149450014525140052514500251452d200a4a5a4a005a4a296900945145300a5a4a2900b4e14ca70a603a9b4ea4a602d1494034c029d4d34b48028cd145580b498a5a2a004a75369c680014fc0a65385301c1aadd9a798ea3deaa015a5a4ae674f4cd55c0f425c629d4d5a7564316834514085cd2519a290c46af3ad623f2ee241ef5e8b5c6789e1db283ea2aa2c473f1939ab2923fbd574201ab71caa0f6ad44caf266a3dd9a9a57c9a8db6d55c91178a7d3724d3c1146831e3e9452671d29c3f2a091d9a7669940e6986a3b2054269dcd36906a274a66fa93e5a8b8a0ab89907ad2629c69b5231b41a5a6e69ea0252d1498a818b906928c669298c2929d4dc54884e68cd2d2629d802929c69b400519a7714da402e69caf8a65491c65a80b931b96e94f8977f734e4b6f5156e3017b015b13ee8a4ec1555e5f7a5965aaa4d17024c9a4dc7d69a0d1482c87fd6a6cd40198d29340136682c6a1a7efa092453466a2a6ff9eb46a327dd51efa46e29bba8b94c7efcfb51c533eb4004d021fbbde8dc6999a69e295c64b9c51b8d338a4e94c56241934fdd8ef506e34b9a9289558d2eff005a87e94555c826f30f6a09cd44b8f5a6935251279949e6547c1a2a844a4d3492698314517192ac98a427dea3e29334c64ed21a40f51e3148cd48964fe6d2efc5401e8ce68d069968c94cdd516ea4a342894be2937b1a8fafff005e9bb8d220b25a999fa1fa8a6e6984d0531588a504547cd2669dc94c764d264521e29bcd2289335094a7834acc2a2e5dae458c532a438a8f6d224d6a6834eeb45731e80828c51fa53a9ea3198a713da9292825dc786cd579ea7150c80558a44702d5bc556879e9567150c9886694f14948d9a0d408a4a4f9a9d408675a5a5a4fc6988285cd2f3de814b500c629e293f1a6d0324db4fdb50f34f1400bd29569b4e14891f8a293ad0b4ec48fef5af6f58fdeb66d538e6b7b1cb2362d80c558aa96cd9ab750c90eb4f14da70a43245a79a629a7e29884a4a28a06348a4a28a0414b4da5a60235369cc29b4862d145140828a28a005a29294d002d2a75a6e69c879a622dd46d525466a8089aa0a9d8d56a960494b4829690c5a5069b4b40075a4a28a62168a4a314862d2d3696988751494b48614b49450045756e93a956e6b84beb76b77286bd02b135ed34489bc0191de99499c6eca422a5c5308fad3b9430b5349a7d432362aae48d66a8a94521a6c823a38a538a6d4805253a92900525145021692968a631296928a005a28a4a005a28c502800e28a28a004c518a5a4a002968a0d0018a31464d19a402514b8a4a00296929c2801b45145001494b45200a5c514ecd500514869a4d17012928a5a4018a5a4a5c5300a5a314502171494525030a4a28a402d1451486251452d310da28a290051451400b4519a2980514b4948029452514c0752d00d250028a4a29453012969690d20b0514945500ea314519a3418514514085a7ad3314f14c0774ae8340b3324a1bb0ac115db787117c8cf7fa50c353768a05256402d29a28a0620a5a28a6025733e2a8be5438ae9b358be234dd0679e0d0070c0559880aac3353a2126b6426138155c2d4d28a80d224917152605449532814d00ee29c29323d29dc550c4c66900146283914310c341c7a52d36968033afad2102969b4580439a40d4b49cd228673431a76290d4ea48d2452538ad252b8c4a334a692b410b8a4eb45159942525389a4e280b0da5a31453105145145c04c5488c45373480d48cd58eec01cd31e4ddedf8d57e3d28ce2b4640d67a66734eeb460500341a5a052d328178e9cd3ce29b9a5a090ce2973b8d19a6d2287e3de90114de0525500f269306838a693520c77eb4b4d14d06a4639a9297752e062a890a4e68a5539a6313a76cd2d372452e7359ea21738a3269bc51c9e95621d9a299ba932698c70a4c51f7a8a9d42c2d28e7ad27141069942f1499fa50453719a043fad041f6a01c523362958614b4da29dd087ae4d2d305049a918edfe94845252734c91d463d68e7bd19a6509b4d2e29318a4a0914d2609a76d6a7715655880ad2f966a7f2e8d807bd67602b9871519a99c9aaf5006d74a8f9a71a43581e80119a766999a7530169b4a4d2115231d9aaf2d4e2a09b18a643120ab3baaac19ab74d821bc50c714bf8d07148d04c8a6e29c7da90668b88319ef4868c8a0e2810849a338a5346714c1dc334b4114a2a405a5dd494b8a62178a78a61e29fbbd28b8d8fa145339a91315489101c1adbb7618ac423e6ad7b535a239646c5b2d59cd436fcd4f52c9178a75348a5a340255a753529f4086d2529a4a004cd266969281894ea4a05301a69b9a56a4c8a421f4868cd140c28a4a2810b4518a5a4014a9d692963eb5405ccd44d52d44d542226aaf561aab54b18fa766994fa005a39a4a334805a4a5a2800a5a4cd19a0028a334b4c02969292810ea4a28a005cd473c61c11525373401e7f736e609194d405aba2f11d9e3f7a3f957359a11b5c3701555db269598d47576316c29334b8a6d310da6d3e9b40c4cd2629692a405a29296800a4a5a290094b452f4a616129297349400b4014b4da002968a5a0029296929d802928a5a9189451450216928a5aab009452d2d2b00da5a4a2900528a314b4ec0252d21a69a0052692928a402d1452d0002968028aa00a2971494580290d2d34d48051451400b494b4940c28a28a041494b9a4a4014514b4c04a5a4a5a60145145200a28a5a004a766994b9a007e6928a5a602529a4a2980b494ea280b0734a2929e0d318ca2968a90014edd8a6f5a4a77112a926bbcf0dff00c7bfe35c22d777e1dff8f7143036a8a296a004a28a5e2818525293494005676b49bade4ad1aa9a92ee85c7b50079c3715287db4c73cf414e545cf35a89b077dd50ee153305150ecaa041e6d3d5aa2a916a44c9b752826a30d4fdd57726c3e985a971e94dc555c62e6928a8f348487629a07e54a4d36a4a0fa5309a7107d69bc520d4683f852f5a36d140908c684a434549414352514c04a2968a4025253a9290584a28a4a4014b9a5e292980628145380a902d2c2ffece3da9bb6a789cfb52362b633e620a61a92a3c8a450da72fe74b8a2915617229734da298016a4a3ad25240c296938a2980ff00a52629b416a005e68c5379a5dd4085a556a42d4d06818fcd04fb5333466988534bbe90fe949486149413499a3510eeb466928a4317349452628e62470a5269b46ea631e5b348334da371a3401d4ad8a6668fc6a462e697a5329d4c037d3cd434fa4ae388e39a334cdd4b4c449bb3486900a09a0a0dd8e29c3151d2f1419dc9725a918914ca5e714ee31fe630a6bbd2114c2a2a4a1879a6d38d36908d7229b9a73669b9cd731e90b9f6a40d4a16971562199a76ea36d03e951600a827a9cf3c8a8a4e29a264470559aaf09ab39cd028894b49b452e29dd1a0cdd4e1498a553f4a915c4db494b9a4c53d0406807da8c51d290f51d9a4db9a6609a9718aa00a5a434e5fc2900b8f5a5e29bf9549c504899c548b8a8f34f4ab10eea6b4ed931598170dcd6b5bd5239646b5b355aaa96cc6ae01410029f9a6538548c914e2a4a62d3b34c04a4a29280128345140052d3696810c6a6d0d498a063852d3696810ecd251498cd031d4669314b8a42169d1f5a653e3eb5405ba89ea5a84d5088cd55ab2c6ab5201f4b48296a0a173452514c43e928a4a0614b4945003a929296988334ea6d3a800a2928a403a9b4b4940ca97d009e365feb5c0caac876b706bd15b15c0eac36dc4bf5a681196d4d34734568485369d415a5610da61a9bf2a8cd2189494514c053482968a0028dd45262900b9a434949cd201d452668cd301dc52528a5a0636814b4734084268cd149400b494ec506818da29693140828cd2e28c50036979a7629680136d2d2e69bbe801d9a66690b525200cd2514b40094b4528a0028a28a6014b451400b498a051540266929692a0028a29680128a2814005252d2500145145002d2514b40094b452d0020a5a4a5a002928a2800a28a28016969b466801f4ee29b9a2a8028a5349400b452519a0075349a28a91853e9453a8b12390d771e1de60ea3af6ae215abb5f0d9fdce31fa55b19bb466928acc63b34525148414529a280145417032a6a6a6bf4a067994c14138a02b53ef50f98c3de9a4e315b92c1e33501ab3b89aae5cd03b21a69d9c52e3342e29031e3e94bba901cd1cd511a8fdc7e94019a4a5a6310d26ea70fc2a32314c0534c14fce69a052b8c4a4cd29e699cd4001a6b5389a4a3501b4134e34da42101a514945500628a0519a9285a4a4a5e9482e2529a4a4a402f3451495402d0694525202e45d297753170168c8ad8cec0dcd31a937534d64cb1f49d29b4dcd031fba9bcd1406a43006978a6e68cd5085cd2e69a6806980ecd2521a6d4898f0d499c51c525201dcd1499a334d0c5e29b40a5cd0ee026ea7669a69690099a70229a48a68aab8126fa4cd3696a0029734dcd15648e0d499f6a4e94bbe9142e69052668a00751494948638b628cfb5251b8d2b8066977526692aee21c296a3a762900ec91499a4cd2d48c504d3bad337501aa8824e294d46282699438b5464d153a422a6c5116ca88f356d863daab1aa689b9b18a4f96937523571d8f46e3b8a4eb40c503340c653b029714d0bcf5aa648e1504dc54d514a78ed4c572286adf155a3ab149890e3b7eb45369706916149b68a29884228e941634bcd3b1421a4c50714bdb8a5f2100e2969a314ea2e48b8f41fad3d2994fa7700c629e2980e29dba9b010d4b1ad340142e734913ca4cfd6b4ed8564ff156bc06b5399a352daad81556d7156693245c53c53694520265a71a6ad3a810dcd2668cd14005252525002d1494ea604469334ad40a401c52f1451400b499a5cd25031d499a28a603a9d1f5a653a3eb4125ca859aa5a85aa8085ea0a9daabd2024a334da5a918ea290519a4316928a5a601452669680168a4a5a6216969b4b400b494514842d2668cd21a0a10d70de248fcb9f3ea2bb8cd727e29886e8db8fce9dc472e7341341a4c55a10b49b7de8a5045301314d34ea434806d18a0d2e6a4028a28aa0128a75250025252d266958028a2942d0018a4c53e92801b494e34da6019a33498a31480766928a2980b9a2928a5a80fa4a6d25301f9a4cd2536900ea434b9a4a43128a28a420a5a3145300a51451400b494b45300a28a298094529a4cd200a4a5cd25002d149466900514514802928a298051451400b452d25300a28a5a40145149400b8a4a5a4a602d369696900da2971450019a5a4a506801052e6928a005a5a29d8a004a7e2999a7e698053a834b54161ea05767e1b27cb3ec7d6b8b5e6baef0cb7df149823a4a5a4a5cd40c292969680b09451466800a61a7d262811e79aaa6d9e4fad40a0115735b1fbf7acfc1c56a8094fb556c7ad4ecb8aac735402f4a7edcd46053b26a4093834bcd30d3f3562b0a053b34d069587bd04d84cd34f34b4868b8c4069b4e14da901327d2929c29bba91436929c39a46a5701b466968c530b094a6928069e802eda6d2e69b503d05a6d2d2629dc91d499a28c52185380f7a6e68a4029a4a3345171932f14cdd4ecf151e6a89173466929280168cd2525031dba834ccd283480766933499a4a2e224cd369375148a17345275a298ac2d19a6d2d3d005a33494b9a430cd2669734de94ee21c6969b45480514dcd3b345c0314b4ddd4b9a03412969b4b400b4a69b4a0d01a073499a5cd20a005a28a5a63139a5a4c51408524d1484b51b734ac30cd19a4c1a7043e940ac029dbbb64e3eb49b314dc1a6161f9a4a1159a8d8de8698052e68fb3cbfdd34be4c9e946a1716319ab62503fbb55fc99053e3b1964a7a95743249b75406b425d33ca5c96cfe1ffd7aa0d8a4d126ae40a611451cd73fc8f4b51c28cd3734edcb4c05dd4de2826973522b8e5c5433a8a916a298d513a11c439eb566aac78156e93262250286a41528b1d8fa537347d2818a003751d681c515420c52e69727d29b9141418a5a5a685a421dbe9dcf7a6714f19a6c9d408a700293a53aa462d380a285ab10aa7e6ad681eb280e6b4633835a1cb236ad8d5baa56b57693245a5a4a752112253e9899a7503128a4a2810d3462969298c2969b4b48431a9294d36818ea2928a0414b4940a00752d369690c29f1f5a653a2eb5422e66a06a9ea07aa1114955ea76aaf52c078a5cd3696a463a8a6d2d001d29692969805028a5a0614b4da75310514514805a4a5a4a00290d2e69b4001ae4fc52adf21e31fad7555cd78a24c2a0a680e4f069b4b9a4aa10b49451542b0ea69e69d8a69a43129314b494900514525500514ee69280128a5a5a901b4b415a29885e68a3345318714c229d81494c06d2802971482a402968a762801314714a28a603690e29d4da4025262968a900c0a4a5c50680128a5a2900514519aa00a29692800028a5a4a402d1452e2980da29692800a28a2900949451400ea6d2d250014b494b4005252e28a0028a29280168a5a314005252d14005145140c4a5a4a5a0414da75250018a314b45300a31451480751453b154014eda2994fc5002d38525140122915d17871ff0078467b57398ae87c398f37f0ab6075f4b4da2b118ea5a6d2d200c52d252d020a434b8a61a00e1fc4236dc1e2b311b02b63c48b89bf0f5ac88c66b5100626a06ab436e38aacd5603375383527cb4b815004991d29718a8e9f9ab0b8714e19346ca3752121bf74d2d36938a0131dd69b4bbc5308ff0039a062d3453a9bcd2ba18941a4a2988434b4de29d9a9189494e34dc8a7600341a05266a0629a6d3f34ddb4842f4a0f34d269680b85069452531051d2929c9c9a631c5c1a8f756a358a119155fec400e6aac2b94b3455bfb0f19a8bc8cd48ee41455e4d359866a1fb3d3b316857a2aea69fbc77cd345a669d82e54a5a9fecd523e9e40dddaa6cc655a68ab22d3deac47a666aac2724679a4abe74fc360d5a8f488d87539a3942e63d15b51e92a0e0807f13552e6dd51b03a52b0ca3498357df6903029f68137fcd4580cf2a6902b1adad42d510f41f95544e0f4e28b09328796de94be5b7a56e0b412fcc39aace02b53e50b99ff6590f6a618cad6ca0183d2b3de3268b06a3059b1fff005d4b0e96efed4fb6942f5ad3b33815a589b99674ddbd4d4e3475f5e2acca39c8fe59a5925db1e295a24ea65cc908e9fce9a238b150f2c69eab526859b4b25989ff001a9bec88bdaa4d34ec0c68cd55857121b189bffd555eea28c1c015795bcb19eb594cfb9b9a063d7ca1d684883374a4c54b6c32d5232c5e5b42b8c7f2a86ce15dfc8e3dea5b8ceeeb4d83efd508bb2da459fba2a95e3aa1c002afbbd63dcb6e6cd02b8be72ff769b232f6151669501a9b946a6990a6198e2a4364adff00d6a74081169fbfbe6b42351e2248c76aa934b1a74c7e5493dcfb9acfdcee6917624927dded5a76078ac873ed5ad69f22d4ea0c65fb6e18ac4295a776e7dab39fe943b017f38a3fcf5a46029a6b9aecf4751c169dc76a6538d436219cd3ff004a6348b51198d161684e5aa191f34d0acdd69cd101562d464479ab40d544ebd2ad0a44c50fdb4dc0a534ca8351df4a683f4a71a6f14c2c38b537752d349a76025dd4cce28cd29a2e02e334a334da5e69922d3f7545e654b9153a8f40e6a41ef51e734b9a9025c50b4ddf47356226ef5743e2b3b255aae29cd6a8e491bd62d578566d966b4452648ea05252d20274a7669ab49400514941a004a4a5a4a620a5a28a4046d46686a4a43169052d14c42d2e45368a431d45369698066a48fad478a7c5d69a24b79a89aa5a898d5810b1aab561eab5430241452014bc548c5a05145301697349b8514141466928a09169d4da2818ea29296810b4525266818668cd368a0009ae5bc4c46e4cd74e6b95f11e37afae29a11cc9a6f34e3499ab109452d250005e9314b450025252e69281851499a5a2c21d499c5251400b4514b8a2c3106694d20c0a5a04252d20a7f14ac0328a280698052d2f14530128a4c52d4ea014da773485aaae025369d4548098a4a5a2800cd250296818da5a28a0419a2968a0051499a2969d806d14b4520129d9a4a290c09a6d3a814c42521a5c518a063734b494548828a5a2980668a3145030a28a2810a28a334940c5a2928a042d252d14c04cd14b4500252d252e2a4028a4a5a602d2514b4c028a4a5a00752e734528a602f4a7546453e98052d0a168cf6a621cb5d1f873fd676e95ce8dd5d0f86cfef0f3dbd690cebb34b494b5914253a929682428a28c50014514503390f140c48bf4ac0435d278a132c86b9b15ac4639142d44eb9a9324f6a89eb4244c71483de8069715202e314134bd68e2813245fad18cd229a4068109cd2538b7e34d26980d34668229b5203a929d8c5328d0a129314aa29e6902433a5369f4da00434da70a38a4019a4a29714c02928a414805a5a4346450021a5a5a290098cd4d8dbe95201b074a8739aab01bb6ebb96ab4899ab1664e29cf815a181518055aa6b92d56679bb536d63cb74cd2d4d2c695b458159d3c7835b00ed1d2b326e69a205b6aa93e51ead4271556eb97a452114f1cd6a04592dc718acb71c75ad5b43fb9a433323e3ad5bb79b9aad20c1a7466aae0cbd3a8eb441446cadef4b4c92cb3639ac9bf1cf157b71aa17873de917128e48a9eda4c48298b86a6a7dea561b352fdb70aa8b82b56ae006515522a6162e594c7a5413afcf4f80ec3493ad324727435417a9ab38f97ad5407e6a4ec5219d0d6b5b4b91cd664ebcd59b57a9521b4cbf54eea4c8c0a9da409ef542e1aaccd10c49eb4f7c1e94bc05a645c9a82d17d0ec4a447a7374a837e2b4209656e2a8034f66a6ae09f4acd1a123354d69c55694e0d5bb72299248f4d8c62a56f9a976015631263c7a565927357a76f7acfce6a188936e69f10dcf8ed4d2dc55ab55a92f42dbc83a557927f4e94b330aa921ad2c4588de477a9907b7eb50d3c9a431c9963d2b499f62f355208bbe696ea5cf7a81bb949db71a7dcc5b545322009abd70a0a7154223cd33a5219ea3dacddc57358eee7629b814d691da9cb6d530c7a520b4880427bd49e52d494b8f4a2e5f2a1b8a490714ac3de9b2f4a911145cfb54f9aaf1f1560e05364a1f4dcd2d3291a8b4a2931f852d02109a4c0a5c669a298890628a8f34e0d49a18fdd49d68fc291b348072e3eb4a78a67d29d4c42eea7a53339a7253024a00a6669ea29a4224ddeb566239aaddfa55b86ad1c9246d58d68d65da362b505040b4a28a0521932d2d3569f400da38a290d218da4a28aa10b4b9a6d2e28018f494e6a6e690c514b49499a09168a28a430a7537345002e69f0f5a8e9f0d508b66a17a9aa16ab110366a01561eabd66c62d2d029690c2968a28b8c28ce28a4c5310b499a5a5c50014b9a4a280169692929580526994b8a4a602d19a29334862135c8f88dbf78bf4f4aeb6b99f11a8f93a55211cb9a653da9a455121499a5a29d80686a2976d2d30194b4a69b520145149400b4b49453016971499a5a402e05252668a6171d4668a4a631297141a314840296928cd37710519a5cd36a4619a4a5a6d0028a5c8a4a280128a5a29d804a28a4a4014b451400518a28aa016928a3352029a4a28a602d14949400519a292a40753696928189452d2521052d145300a5a4a5a602514518a005a31494520169297345300a4a5a5a43128a0d140828a314500252d2528a602d2d266968189452d14085a33494b400bcd2f345283400e34bd3b514ee6ac03a5743e1ae1cff8d73d5d0f86db2edc7e9434075b9a514da5cd6231f9a4cd252d0014a2929681052514500737e275e12b96056baef1327eec1e3ad71cbcd6b10b932ca39a8653e952eca8dc629ea043baa45349b05266801ec0a9e87f1a524d250a2a80705a377b514504b109a57a4a43525064530d3b61a414806838a297834da6022d3b34ccd2d201334b470292900b914dc52d155ca212968cd2548c7629314b49ba801314714bba8e2980aa0d395452669c5a9e821d23e6a31c51d693152c0dcb30d8a2734db667d950c8d9ad08d0af262acda555ea6aedbd03b96d9b8e6a83b7a1a9a69aa9a9a760255f97eb55269326ac8355643cd4c8690e35a569c2d6633568dbbfcb55a86856945471b54d3556069017a2f96a5598ff0076aaac9f8d4d9a603a694fbd5198d4eee6ab348286511c6f491fdfa6a8a4079a8035a7395cd518bad5ace4540073e9564130e3bd3de99b682f4848889c75aaa3ad4cf935103433443e7a20349253633480bacf5524ab38154e4354d92908cd4f82a26ab30035032c3331f4aafbaa6aaed56323734f8d454556907d2a6c3216f6e6ac47519db534345c9b1374a0ff009cd25319d71564a488a7f7aa40d5895ea05c66b32f41e2afc4315520da4d58634d00924b5549a7bd34609aad44393146cc9a73aeda58c52d465a4f9474aa93b6eab4ef8aa2fcd05587db8039eb57a5fb95523418f7ab04955f5a6415445b3ef53fa76a7bfcd4c02b86e77d878029b40a75558b0e2937e29ccb4ddc3d2a0418a64878eb4f34d7a60c863ab279aaf1eda9c9ab64a1d9e3b52119a0506a0b01498a17028a7710940a5a4a0621e29d4845355a815c7e5a977519c53322a84c7834fa6e452d218b9a09a75338f434220907b714e03de9983eb4bcd515724ef5761f7aa98e98ab9164d6a72c8d5b54dd5aaa31595699ad55a8640ea28a0548c9969d51ad3f340829334e34da06368a292a8414b494b400c739a6d2b5148029296834804a5a29698094b4945021d4e8a994f845302dd42f53542f5422092ab55892abd4b18fa76690514862d1494520176d1494b45802968a4a0614a29334a2a841452d2520109a28a4cd31052669c29a6a461581e22fb8bf5adde6b13c41feafb75aa4173916eb5154af9a8ea890a6e69692818a6928cd154213ad18a39a2a004a3345154014b4e14bc521d867069734bb69b485a894b4a79a4cd300cd2e69292ac43a83494ea9284a414b4551214dcd3e9b5031b45145001494ea2801296969b4300a296928012968a2900518a296a80292969290c4a294521a420a314519a602514514805a4a292800a5a4a5a005a4a5a4cd0014514a280128a0d14c028cd2d2520014b451400519a36d140051451400668a28a2c02d253a9b4c05a2929450014ea4e28340c538a4a2968245a51494ea7718fa70cd329c2980a38ae8bc39f7dbe95cf5745e1ce1cfd29b03aaa29296b11853a929334c05a753734b4085a2933452030fc48a3c9cfbd71ab5dcebd1eeb73edcd70c39ad0351f4d98352f4a243540414da7139a415204993453569e129a10b4bf4a4c914d0b5621727e94b4dcd3b77d3f2149d8a1a4d37a514952028a6d19a0a8a482e37229c7148696801b9a29334b4084a5a4a5aab80520a296a462668a2814804a75252d301c31475a4dd40a6216903734a4d20a433623fb9d31f4aaacdea6a70ff0025556c568676107353ac98a8474eb4edd4c44af20a80d064c5305473234fb893355dea7ddf855790d3634d923355e8beed67b138ab7039029a64b11df3508e3d2a566a85b34d8f42546fa54bbbdeab29a9b752108d2540ff00853c9a89b140ee3178a4079a4079a33cd643347f4a6eea0118a33e86b4158903546d8a6eef7a4aa110b7d6a2ef5338a82a18ec4c7a5311b14f3c8a62d206582f55189ab15039ab012aca6455602ac2f4a40485ea124d296a61228b8ee262ac223557535601a105c6363b54dbea3c8a4069a259397a899e9fc9a81ea87c831daa114e6348056432ddb26391523be7da9bd0715131ab10993f5a7c4bf37351d3d450843dc669e8b8a8a977d03091ea2c7348ef406cd40c9578ab5e67cb8aa8b56727156210e29334b81da9b8ae33d2e51719a53499f5a514c052714d34ad4dcd201c2a397a52f229ac734c4c813157055456ab5cd37622285a6629dcd19a45d83ad071403498a44881a8a4a5a0a169a3e94ea0f14c42d37f1a5a4514031f9a706a68a78a340b0b8cd028e949b8d42287629dde99d69e2b4449255c8b7553e73eb57e2ad0e491a96c2b4d6b3edc5680a4c843f345149536289d69d4c434f34c04a4a28a0069a4a5c525020a31494b8a621a69b9a7353334862f14537ad3a90c2949a4a29885a5a6d068016a486a3cd49175a622d66a16a9b1503d592432557ab12557150ca449499a6d3b348a1696928a005a4cd252d021714947346690c29693345310b484e28a334805a4a28a004a0d14da6006b1f5dff563eb5acd595ace4c27d7e9401c8b8a80d4c548eb50b6e15a123706929d498a006d18a29734086d1cd3b6d14861494868cd318e14668a4a431d49451c53b122f14d0334502900b494a68154018a5a4cd1cd002d26292939a57016928cd152014518a4aab00e1498a5a0535600a4a7e292801b4b8a00345301b4b4ea6eda800a4cd14b8a004a0d14500252d2514805a314945002514514861494b49542168a4a2900b45145200a29692980514b494c05a4a5a290051452e69809451453003452d25200a28a5a4025029692980b8a5a4a5a062d251450214528a6d381a402e29d4da7d5d8760a75308a928b08916b7bc3c7f787e95838c56f78733bcf07a7a53633aacd2d26692b118fa2928a02c2d1452d020a28a4c50051d6109b793e9eb5c062bd1ee537c6c2bcedc63daad05831eb44d49d68706aee0c8b8a4a029a6834805a905333cd3b755103f145369d4363437834514d233ed4ac3139a402948a4a80b06291a8a319aa1803498a4c52e290909498a52692900514518a601474a3a5266900b40340a4c53602e6940c5252f35403f1eb494b499a004a1693a503ad481a7fc355aa563f2d57dcd5a581728ffad377d05b34cdd9a5710734ea679b4eebff00eba5f201f9aaed531e2a27a5218ee7153c4fc62ab64d48a714058958fd2a2e69e69b8cd310ab528f7a8171529a2c21bd6a36a94f151532ac4629a7ad14ee2a02c4f1d3fa9a64669cd54203499a1985373ef543d0473519a77e351f22b3b06a4dda9a0353d39e951e334c44d55cf5a9b3eb503e68d4771454ebc54095376aa402114d34536801c2aca9e2ab2d4ff88a057138269b9c5388141a9017754720cd21148cd9a65109a7c4b9a8cd4d1a54a1139e7daa3634a69b5631714fc62806939cd510d0f00d349f6a4dd8a6b1a963236340069a4e6a503152ac3b0b1806a7cf150092a5c13f4abb01203c5343d2515c87a17026968e2940a570406822867e2981b75315c93351b8a7f029a7de98d95d339ab79354c75e2add0cce22ef3ed4d26814b8a0d45ebd697e951e69d915084045267da94b629a2ac6c5268eb475a09a1d8cc0d0a29c0d37e948a1f4e069b4ee291570e949b89a4cd2d512498069dc5474efc696a3b0f079ad189ab3ba9abf19ad4e39a362d5eb48566588ddd6b4c52640ea766999a29144c94ecd354d3a9084a5a4a6d30169b4b4b9a63128a2929086bd329ed4ca005a5a4c51400b4669296800068a297a502139a7c1d69b9a922eb4c45935049560d5792a808243506ea9a4e9500a963251466901a29143a93a5273450014b4945210b4525140c29690514085cd14945002e69b4b9a4c53d062d2514948434d50d51330b55f26a96a1f344dfe340ce21ea3a99cd406b720424525251503b8629297a514200a6d3a929084a5a422815603a995251c1a450949494ea572433499a6d19a403f3499a4a75500da752519a3500e28a6d2e690051494b4000a5149ba96a805a4c51c5148070a4c52668cd031692909a3340ae2d14668a002928a5a004a5a334940052514520129294d2d201b451450019a2928a402d1451400b4519a4a6014514b9a002928a2801692968a004a29714530129dba928a0033462968cd00251452d480514b9c536980ea2929698c31451494ee21d452528a00514ecd3734eeb4201d8a5a6d392aaec44ab5bfe1d4fde37d2b056ba2f0e27ced50c68e968cd0692a063a97269b4ea0614514b4082969b4b40c46af3bbe4f2a575f7af45cd713e218f6cd9fe954896642714bbd8d3131537c98ad00ad9a6e4538e05474843e9dba90734ea602d3b34ccd14c42e69b9a28c8a430c534d3f77a0a8e818fa6f4a4cd266a7400e2969b9a334c2e19a4a5a06280128a5a3ad201734828a4cd201c69b9a334530168eb40a2801d9346ea6d2f1540148294d22d40174b0c541c548dc5435a923b71a650692b32870029dba9bbe94e292285cd319b77a0fc297814c26aae4dc70a51f5a6ad28340898fd6994ea6e29b1853b71ed51d480d310d3934ccd389a635218c6341a334106a409d2977d310d380ab26e3aa3a7f4a4e2a4ab11e68a0d20a044d09347e9429c52d59221355daa66c0a84d4b650e152e6a15a941a401494a7f0a41cd031c0538e6a35a92a834179a29375203ba8b8035479a7b1a898d48c6558cd575ab039eb4b416a147149f850b57701d4b9a4a320532750dded4d34a6a339a9b141521e2a3a7943fe4d243019a94b1a683487d2a89689852e0500d15c87a218a76d14ceb4edc3de80168fc290628c1a6310523d3a9a4d04b201f9558aae3ad59e29b250a17bd34b669739a4c0148ad42969a2814f40d4038a38a4fc28db485763e9b8a4cd389a3518a31474a293ad50c7e29770a6838a36d66c5af61f46e14d3e940e2a82e4dc522f34da06ef4a04d960463d6ae47b6b3f9abb0726b5473c8dfb2abf59d666b4686622d2d3696a4a25534fcd3235a774a041494514c04a4a5a6d050b9a753053a824635369cc69b48a17349498a5a420a28a2818b4a00a05250216a48319a8e9f175aa116eabbd58cd576aa1104955c55897a5402a58c78a2900a306a462d21a292810e069314b4941414514a69805145140099a2928a0419a334b4da918b9a6e68a4cd3012aa5f0fddb55b26abdcb0d8d4c0e224a81aa571f5a8c9ad590454869e39a69a81d828a5a6d5085a4cd19a4a4029a6d3a90d50062956928a900a5a2834c06d14b9a4a00334668a0115202f5a4a4cd3aa806d2d14b40094a68a290098a4c52d14005140145200a28a4a601452e690d0014b9a4a08a4014ecd36806980b9a29b45201734525148029c29b4530169b4ea4a004a5a4a290052d252d30129d494b4009494ea298098a28a2900b4514500145145300a2969290051452d300a5a6d2d0018a4a28a002968cd14802971494ecd30002970292814c05e452d04d2e050805a70a68a518aab0895735d4787531bcd732bb6babf0ea615aa58ec6e52d1b69b9ac8a168a4a334c05a5cd37752e45310ea335134c16a07b8a00b4645ae47c43f3495bcd35737a9282734d08c61526ca6f4f7a90366b5b0884d43561866ab91536631d9c53f39a8c1a751a88296929c6a4627cb4a7149d29339a601d28c8a334de94200a2818a4a4014b499c529340c6e6969b4ea4210d14515402d2668c9a280171452d371400b9a4cd14520d45db494b41a600695464d329e8714807b53578a7393de9956d923b753734b4cc54943853ea2e69e0d0029a8cd38b534d049228f7a29169715450ea6eea7034dc6280b052f3499a2a442f5a8cd3a9b400dc53cd3452b51718f5a78a628a7671562129294d379a918940a0034e18a901e39a70148b4ee9564a18d501a91aa2a96ca1eb4fa62d3a8014b5203499a01aa0b8fa70a60a76e34801a9b8a527341614c06d3334134da9b85c7a1a949f4a8c52e28b0eec5e0d14945310f208a6d068e95571086928dd9a5a43d0418a7e690e074a5a4589525420d3c9a64168534b7b529a4ae53d1178a2929c0d310946ea322909a043a9b274a55348f8c5206578eacd551562a8ca23b8a534281435237101a29cbc5369001a414b482993617149814ea6fa531b1d482939a5a4038734b48334ff00ad0d0c6b1a4e28c7e3467da82090296fef1fa53c60d45cd49baa9144bef56e123354f730ab7156a8e39b376d0568d675a1ad1a864d85a052668a4327414f26a34a7d0036929692824290d14940c053a933453018d4da534940c5a5a6d3a900d3c514ea4a0029c2994b4122d3e11cd4752c34d016aa07a9cd56715422296ab5587355ea59449473494b5230a28a280128a296a841451499a4316969b450316931494b4804a4cd1499a648504d02928282ab5c7dd3560d4133607ff5a824e2660a1aab1ab337155eaee48c34de29f4de945ca1375281494b8aa24290d28a4cd45c61494525310ea4a0525200a5a28fd2a8028a4a5a2c0252eda4a2a404a5c528c514c00d253b1455009c52669db7348569009494b46da0419a4a5c518a430a28a4c50014518a0d2003466928a402d14da7668189451494c42d145148028a314b8a6021a414a4536900ea28a298052d252d30014ea6e69690c4a2945140094519a5a0420a294514c04c52d18a280128a290d201c4d14da7629dc04dd4514b8a0005253b34da403a92929d4c0514520a298c5a29c48a6d20b0669e6998a78a621d9a052669714089825759e1e53b5bfc6b935fad761e1fff0057dbad39219b19accd4f585b31c7dff4ad191b68c9ae0353ba6b8958e7bfb7f85669145c6f10de13feb08fa52ff6e5d7f7dffefb358c1f15286ef562b9b5fdb173fdf27f1a93fb627fef5642934feb5761dd1adfdab2fad2ff006bb0ac90dc52d4589e634cead9fe1fd6a8cb3f9950f3d29a56ab9445664a01db4e2b48c29b41a913542735315150d301b4f06998a762a500ea5c8a4141a3418b81eb4da4a5e6800068149495203a994e069290c4eb4b4628c5021b4b4b8a4a43128c5252d310e3452525318bba945369681094518a2a407134941a29805392a3a9168b00ad4ca90d478a02c19a33413498cd003b34a29b8a762980534d2d266900f5a0e69ab4e3562169b4e1482a6c30e68346292980a290d25213400014134aa29b480945148ad45500518a69a5a5a00b40a6d3d4d3026071d69a68f37da9246a6031b15153cd4759889734ecd3294551481852034b4dc55087f5a7134d19a5dc29201291b8a5cd140ec47494b8a4a915892969b4b40c5a7669a290d318ec521a6d06aae4898a75345296a8016928a2980ea79c5314d0c78ab02e8a6d3694d7258f46e1d6a4e2a3e94e268250ad4d14ea66451a8c7c751c86a4c7d69b2631489762a29cd5b02aaad5a18aa66511722928ef4edbef526da89453b3eb4c39f4a653605a9b4a79a39a09b8b8a68269734eeb4009d29b9a7d207146a01ba9d4c06a4a02e2668df462907155a0893763b7eb4ee29334ec7b548c7eec62a78db9aadcd5889456a99cf33a4b35e2afd50b2e957e9332168a28e690c9d29d4d4a75003690d29a4c5020a6d28a4a6014a0d252d2191b532a434ca42168a4a5ce6900b9a6e68a5a6014b494b4c0753e0351d3e1a6496ea07a9eabc94c0825a8054d2d402a58c7e69734da5a061451d28cd20014b9a4a281866928a51406a252d27145300a292933400ea6d14b400dcd1ba8a4a004355e7e86ac5432f22819c5cbc93fd6ab1153cbd4d406b5206669a4e69683500252668a5e94009b8d1494a0d3109d29314b45300a4a5a3348033452822933486252d252d020cd20a5a415402d146292a74016969b4b55701d4537752d002d2d2525300a29734da901d4da766929b01b4538d378a1009453a90d48094629451400da5a5a314009453a9280128a6d385300a6d29a4a0029d9a6d14805a5a68a7520168a4a2a805cd252d2d0037a514b4520128a5a5340c6d253a929882929d46290094b93451486252e6928a6216928a280168a2929dc075140a4a00752519a2985c753f38a8f34fa6317ad2ad3734ecd0493a0fa5763a1afeeab8e02bb4d087ee45268a2ddf92227c7a579cb0c1af4c9a3f3148f5af3abc84c12146eded531195b26a4f32a2cd3b8ad082c2be2a48daab873538c5171d8947f9e69d8f7a69e9c519aa10bbfd78a6134f3b6994c9622ae3b5378a929adcd055c84ad40cb564fd38a8b6d16115a9453c8c532b2287669775029b400519a2929885a4069c4d341a4314e29bcd38d37268d4614669052f145c4253bad21a4a9b005141a2980668cd140a620a5a4a334862d2519a5a061494b498a0414f5a8e9f40016a41494b8a1b0128a292801c2973499a4a602f34b403484d0028a7134d069dbaa841c0a4cd149c5218ea6d14b53701b9a6d388a4a6028a5eb494a280169693347d28003494a68eb48620cd3a9b4ee29887514b814c6aa18ca051d28cd4889299bb14519a2e171c09a052734801a009062938a414b4c040334da766986a6ec7a06692968cd003d714a4d345275a7a80e14940a28b884a75369734c2e1c526da5c5148614b9a5cd37eb4807605274a4145508ba6928a52b581e85c6e6a4cd474ffa5020a434f038e692a06038a56c1a8f14e6f6a6495475e2a7c62a0c62a70b5667163e90d3a9b8a0dc7025a9b4a78a407353a005368a2826c1b69d41e280d9a2c3b07348051b8d2e680d02a4056a3c53b8ab2418d1b73452eea43b0a05499a8f20d3969091255945a830739a9d066b5461237f4f2715a79acfd3c7157b754b3317349450b4844e94ea44a2980b494668a9189494b455086d3a8a4a0630d3734ac94ca403a928a314087514dc9a539a431694714d14a29885a920351d490d3116eab3d58a824ab115a5a8454f29a817150ca43a9692977548c28a28cd318527e14506800a28a6d210b4b4da534c04a434bd692800fa5145140c290d149400950b9f5a94d44d401c74d8c9c73554d599c619aaae6ac96c6714da71a69a042514519a0039a4a5dd4948414941a5a601494a68a40c296928a631334b9a29cb8a62131494b4503128a2978a900a4a28aa1052e692968014d252514c05a4a31ef462900514668a43177534d2e2909a005149453690875252d25300cd2d18a33480514dcd2d14c61453a9a680194b494521051451400b4514b40094b4525002d028a280141a4a29453180c518a4a280168cd2514805a2929280168c518a5a621314b8a297348a105252e68a090a5a4e69c2818da5a28a62169b5253334c185380a6d3f14900ea5029b4b408b0335dae8a310257191ae7ad771a6ffaa4fa5122cbb5cff892c03a79817915d0556bf844d13af1d3a9a9b81e6d4e0d48719a2b5249873532555cd58434ca25ce69ff004aae2a5e682490e29bc9e693934b934ee21a0d318e7ad3f9a69ebfe26a90ac337521a78db4c340ae44c3d2a265ab18a8f9aceccb23a0514b4804c51c5266948a5a80da29dd693340064d252d26680128a514118a40252e69296800a4a5dd4668189494b9a4a4216905145002d2514b4c029334b834829000a7d3453a980d34668a2800a38a4a2900e18a4cd145301692968a2e014ea6d3e9809494b499a900a28a29a1886928a314ec21db292968cd21e82e2978a4eb4868d44140341c521a0029680692ac0933ef494d14503b8c26956929d50214514514c05a4a314a2818b4734868e680129b4ea6d21052e2929c280000d28a5c8a69a351d85a4a51486a804a5c8a314940879a4a4cd2d48c5e28a4a751a0c68a4e69c5a9335449739a5c9a2819ae73d0108a79a69a00fc68025de2986945291ed8a5a05865235388a6629e84b216e2a653502ed5ab400aa3388de6969bd28cd2351793e9f8d1c51466a404a375028cd32828c014ea33ec0d0262714840f5a700293653b85836d382fbd2022968bb26c2e451d69a6970695839872f34fe0537a528c77aa4512e7f1ab30e6aa123b55a864c559cd23a2b11b56ae73552cba55dc54b320c51494e140c9d0d2d22d2e69884a4a7629a69009451474a005a4a4cd2d0031aa334f6a6d0014b494b40c4e28069b9cd3e9085a01a4a5a6316a486a3a92134d1259a85ea5a89ea845690d41534b508c54b28752d252e0d48c29314a68a042d3696834ca1bc52d21a2908051494b9a062668268e28cd0213346696986801d49486909a6021351b538b54649a43393bac2bb718aa58abfa82fef0d5126b4208f34da5231495402139a6d3a92a018b9a41cd028a620a4a3345001494b49400b4519a0d500514b4714804a4a752520168269b451618ee94da29734c42d25252d20168a4cd02801d91494b4869a0d44a5c528a5e280194b8a5c525001c518a5e28cd218dc52d266968d042514dcd2eea0614941a4a421e1a9a6814868b8c4a28a5a04145252d002d2514b4c0292968a5700a334520a005a33494b4c028a29680129693145200a297349400ea4a4a5a602e283452550c5a292969085cd21a28a91dc28a5a4a620a5a31494c05a2929e0520b00352822a3029d83560585c5777a78c429f4f4ae0e3aefac07ee939cf1eb59c98ee58dd41a296a4679f6af65f679987af3d2b38d769e24b0f322f300195f7ed5c69ad11201b1522d4429ea698163cc14fde0d45ba9f8a603d4e7ff00d74e5a6e31da94530b0ac2998a3f5a5c66b40644568c0a78e29bd69136194d0334fc5467350ca23db494e22a3a4171694d2515231b8a29c69b48404d369d49400829f49d29281894b8a4a29082968c514c029334b4948028a292980b45145002e6928a5a43d4052d145021b4edd4869b400ee28a4a5cd030c514b462a84253a9b4520169d51d3e90c522928a4a61a0734b484d1400940a334e1405853498a5a2a804a52a2834da620a5cd2529a80014500514c05ce29b4e34948069a0525385002d252d25003a8ce2929298c5269334edb46280b31b9a4cd145210669d814ca75218a6928dd4b40800a4a5a6d30168a2945500538914669b48614b498a39140828e29296802f818a334dceca7645739e8dc6d38714da7e2815c77149c51ba9a734ec0148692a4c502653ef5600a81f19a954d366511f8a5a434a4523510f34b814a36d34914ae3b0d06814b9147e54c917146da438ff00f5519a761dc713466936d254942d28cd253b15621703de9314bba933485a0a297149cd3e8258a540ab508aa84f4cfe557edd6ad18b3a2b1e9573354ec7a55ca19985028eb4548cb02969a94ec55084cd252e29b4805a6d2d26680129d8a28a09226a6d3de994142d2e2933464d21894e1494ec52242928df45500ea7c551e6a5869a02c1a85ea66a81b1544959ea315249510a9650e14b4b4dcd218b466928a40149cd3a9b40c39a293345310514668a431314514b4c04a4a292900521a292980d34ca92a3a9b01cd6a980f59479ad6d5fef564735b12c69a6d38be6a334992252d2e28eb40c6d2e68eb494c42d369c29b400ecd140a4cd48c5a0d2506980518a314b4009453a9b54203498a7e4521a431b499a53494842d14668a402d2526296ab4014529a6d3b14804a5cd2525003a994b45030cd14514084a28a3140c4a28c52d21094514b4c02929690d218514525001452d2d002514514082968a4a4014a2928a603a931499a7668012969296a805a2937525218b8a4a4a5a005a2933450217a528a4cd25031683494502168a4a5a431734536969887525149400ea2900a3348078152734c0453c715404d1e2bd02d01f2d7a74ed5c047edd7debd06018503f9529144b494b4b50056bc844d1b27a8af387575e1860d7a715ae3bc43a53c6de6a8f90fb53449cf54838a67345697027c8a96abd4a1fd69813eea2a3c9a556cf5aa40d8fa77b5307bd3b34c5a08714ca7534d16063293a538e29293191e6a322a5dd519350244741a28a430cd369d8a6d2014525145200eb4b494531894519a5a0419a2928cd002d2669692800a3141a29000a4a752500253852519a0079a652e692800a05145002d252e694c6c3a823eb4c625273452d310519a28a900a76290519cd301d914dc5146680129694e29940c334e069b4f0281094b4669298075a762929b52171734b9a4a4aad005a3149cd2f34005252d15231b4ecd369698876569314a293a5030a5a2901a40009a29692a804a4a5a422908334b4629d8a07662519a29714ac0252629c1693a50002969296a841466826834c350a09a334a6a4634538934829d4c68ba79eb4813da9dbb3483eb581dc371412452b529e68b8ac252d369579a0619a378a43498a186a5761baac20c5563d6ac83b7de9b32881c53cd33753bad235138a5e29286fc29883a52d3697f1a41a06ef6a2968c503b01348067da863464d02614639a29d4d80a38a0d2f3464d480e5a5c114d07da9e6ac681b06ae5b1aadb78ab36d568e6923a5b1e956f06aa58918ab46933216900a2945228b094b4894b40094da5a4a0414da5c514c4253a929690c85a9b4f6a65200069d4828a602d1d28cd19a901b4ea6d3aac43a9f05369f150058a85aa63511aa24ab35442a596a1150cb1d4ea6d18a402d252d264d301692969a690051451cd31894529a6d48c5a4a5a4c55085a652d2502014da7536914231a8cd3cd31a98cc0d663e4562bd741ac0e0560b66af532b111fa532a4fc6994806d18a71c0a4a6036971494b4c4252d250d48029b4ea4a4014ec5369d9a004a2929ec298c2998a5a29dc4252d2d25200a6e29f8a31487619462968a62128a28a403a8a4a298052d281494804db451450018a29296800a2929698c29293345210b46692928016929692818514514085a5a4a280129d45253016969b4b9a06252d14b4c42514519a402e2928a290051451400514514c0296929690c4a296814006696822933480434b4b8a4a6018a5a5a4a0028033452734c43c0a31494ec629142914b8a675a900aa26c4c99ed5e8b1d79e458cd7a2ad4c876169d494a2a0625433429202ac322a7a69a00f3bd4b4f367295edd7a551aeef5dd2fed51e57ef0ae14ae2b4421d4f1c5422a5cd55c090494f5a60a901c531585a0d20cd49b6b4d09d467268c53a9b9f6a9b8c8cd1934ea6d30186936fd29f4c6a404278a4cd4b8a8f1599484a4a334114ae0369739a292810b4b494a6a8069a28a5a900c5252e692818a2838a292900514514c414514a6800a00a4a753010d2514b9a9012968a4e698052d21a4a402d2e2928a6014b49452016969b4b5401494514805a4228a334005494ca753010514b4ef968b9561983494ea4c52246d2d145201453b752734dc53b943b14d34525048528a052d002d21345266980b9a4c514520168a29298c4a28345488752d3694d5142d2eea6f149522b8e26928a298c4a753694532456a5a4cd250cab8ec519a4a426a4638668dd499a5c550177667da8a43ed4bcd6276682114a28a290c56a6d39a908a06c4a5349c504502b95c8e6a7aadd0d4e94cc9126297a7bd07fcf34e141b0ce3d294ad2b714ce6a44291f4a652d25310fa40b4b9a434031c714debeb4b46698c338a5ce69bd292912ee3f752d1c352516249297348314719a0b2402ae5a7354c55db44db5a26633376cb8abc2b3acdb35a58a6cc428a0d15232ca52d350d148414514869884268a32290d30168a68a750510b0a4a73d32a442f34b498a5cd031296931ef4b544894ea4c52d48c754909a8aa58aa8572c135013531a85aa892b4d5166a596a3c8a82c5cd2d3683400b9a0b5251cd021734525148a026939a5a298c6e3340a5e693348917348692969142714dc53f1494c06d252e2936d4886b53306a62a6936550ae636b08760ff000ae709aebb5440623deb9139aa111e0534e296994f5101a4cd2d3690829294d14c053cf4a4a5a6d318b9a4a5a05216a2669693a529a003346734da70a6019a5c53714b480314b451d298c4a5a6d1405c534940a3348033494b4502131453a9b4c0752d02969d8632929d484d210868cd18a290052669692800a314b4500368a7525200a4a7536980514514805a5a314530128a5a4a005a4a29cb8a063453a92929885a290514805a29296818034b4da5a6014a0d3697140b50a2968cd2180a4a5a414862f5a434b494c91d9a6d2d2530168a296800e696928c521852d20a5a0414f029a314ecd56a05fb18f32c6338e6bd053a579fe983f7c871bbdb35e86a2a18c4a314ecd1520252629692818c22b85d7ac7ecd31feeb73fe3debbcae77c4f685d15c0e9548471d4ea6d2eeab11367f0a93ad44adeb4fdc6a82e494e5dd51e7de9fbbf0aa017a53437b5031ebba834ec40c39140fad3b229314ae31a0669bc53b1eb4cdb54ee2bb109a6e73521e2a3a92d323cd252914dac462514668a0414502834c028cd19a4a402d14514c00525145002d252d25002d266969280169c4d36834804a5cd14668016933452530168a4a75480945252d300a5a4a2801714501b14134c7a073494b494082834628a00514ecd205a2818b9a2928a402519a2929885a514da5a4014514b4c0514ca753298c701474a052eda420a28a426800a5a6d1400b494b8a4a4006933452d003c52134941a0614b8c5252e698833499a70029a68282945369714123b34868a5cd0312976d2e2834c621f6a4a28c8a902fd18f7a4e94719acced148a4ef4e61470682ac2e2994e34ddb9a402eda69a5c9141a64b4566a9f02abb7d2a65c506285193daa61c75a68cd19a0d95c0f34da71a500540ec30d3453d929a2a89b12629314a451814cb626051de9dc546691238ad250b40c52275245e29b4e66a3341414bc5252e3157602615a5001b7deb2c735ab0ed02a9239e46859256af4accb0f7ad3a199050292968193ad2d3178a75201714da7d34d00252114b9a6d31053b349814a2a4085e9952bd329161cd3b8a4a4a09129692969885a00a0d2e682c5cd4b1545534554664ad509353b5406a845596982a496a3152cb1734b49cd2d20128a314b53a8c4a28a28100a28ce28cd318ca5a5a050313149d29c693a5002521a751b29884db9a5c5385285cd21094042d53ac3526145508cdbfb40626ef5c2ca0835e837337071cd79fc9c13de99243519a976d30d318ca4a9314c3cd020a5e29b8a4a43b8b9a4a28a62168a28c5218b8a4a5a434804a5a4a314c43a90d19a5a0620a2928a60149834a296801b4b4525200c514514085a28a4a00752d369698052629714b8a631b41a28a91094b452d301b8a314ecd25031b452d148421a4a281480296929714c05cd1494503b8b4520a5a0028a5c52502002814668a061494b4531094a6814520129d8a4db4eaab0c6d2d252d4885a0525141421a28a28245a28a5140c4a538a09a4cd36019a5a4a281052669f4dc5300e6969690d480538525382d303534553e7c7f5af42515e7fa1ffc7cc75e84054c8a1a452d3a83520328c53f1498a0430d50d520f360907b568e4535d01a433cb185378ab5a95b7912bae31cfad54ad01922d4bc77a8a9db856a891f4e34c15262a85663d452eca6734bc9a6210ad205a534ddac693b15f2131494a79a41c532350dded51e314fe69bcd416467e6a8aaceca85d003598f523c514ec536a4560a28a2a80295703ad25152019a314b4956014628a5cd2010ad253a9b4805a4a28a6028a28e28a401452518a0029692968016928c5140c2928a2810b4bc52519a60252d2e292900b494a28a631b4b41a2810ea29052d00141a3348690094b452eeaa0128a2971523105389cd14d3540251452d21051ba8a2800a28e6945001494a6901a003341a2928189452e297a521582978a052353014514628a062e6984d2d0298ae252d2a8c53f02818ca29c690d002669775368c50014a78a4c52d202fe28c514959b3d0168068e292a4571d8a6b2d1934ea9286d19a6d1d6a88b909a917150bf5a9d29b3343d68cd27e34b41a89cd28a5e29b9a34126291f5a6f5a764d328247e69692929143c734da94d479a431dc52527269411de801d494bc5359b1408013dea4a68a522a89b0f5e2b460359d572de4cf15713191ad6729cd6b8ac0b46f9f15be286657168146697352513253b8a6ad3aa84271494525200a4a3a53b14c91339a5a4a5a0646c6a314f7a8ea4619a051473480771499a314b4c04cd2d253a980edd52c550d4b11a622c1aaec6a735035588af2547524b518a8285a28a334805a4a292900734b4941340051452f4a43129314b4b4c4252e29714edb48066297152aa66a5110aa110ac26a60aa294b85aad24f9aa0b1334cab555a626a33255792755eb40124ade95c65e8c3b63039add9ef98fddc8ac1b95e69a1d8add69a69738a4228b123775253a9b40c4cd068a2a49128a5c53b8f5a63b0da31499a5a00290d2d04d1710514945002d2d19a4a63128eb494fc5310da2969b4805a434b4948028a5a4cd300c514b45218629692973400b494b4869830e9499a2929085cd02928a07703494b4b4084a28a5a431b452668aa1052d145001452d252012968a2801d4114946681851452e69884c5029c69b40c28a28a0419a5a00a5fc698c6e28c53a9335001413452530b8514b45310514b45031b4b4b4da42169734da2980ea434a292a40314b4b4da650ea5149da945324d9f0f1cdd47c57a0d70be168bccb91f435dff00d9476350c688e8a7181e9bb5c76a81894a692937d301db69b4ecd23500705e2845171c7a56156c788a60f70dcfb5630cd5a631d9a901c54429e09ab20916a4dc3d3f5a8c53f8aa0b3250051fad30629d400a5734de9da918d26ef5cd5580319a0a8a16804f7a09b8dc521a5c525318051519a79a6d6632bd253c8a6d48c4a5a4a5a0421a052528a4019a28a29805252d148028a5a4a616128a28a005a28345200a28069690c4a5a6d2d310529a4a280b8514b486aac01452528148076692969b486c5c5146690500252d14e5a620068a4c53a980536968c52189494b474a04252eea28a4316909a4a5a602519a0d1408314b8a28cd300a705a6d3b75304253452d15001d2929f4cc532ac146692969122eea53494b9a6313345145020a2969281852d2519a621d494525002f5a524502936d4962e29739a4c62834c0bd9a294e3bd1f856476ea1d2907149c52d201714b4d0283cd21dc461ef49b68e7bf34b9a082bb75a99698f4f18c53247102978c5028a668263d29029a514fdd400d3c5376d389a6d0214d0b48c6977d21121cd467229f9a4cd3298da7d37a52efa42019a0f34edc3e949b73ed40317e94e069bd297068b0d31ed566ddbe95539ab10631d6b439a46b59a7cdc56d81593635af43330a5a28a80274352546b4fa6006998a71a6e69808696928cd02168a4a5a6044f51d48dc5474862d1482979a43168e69714940052d19a2980ece2a48aa2a961a6892cd40d53d567aa24826a8e9d2d3054943e93341a290c28145148a0e692968a0418a314e029fb680181734bb69d8f4a9562f5a09230b9a9562a940c531e50b54217a542f73e9513cb5033d301ed266a07931513dd0aa324cef41a58965bbfeed536666ebcd3fcba31486418accbc1cf4add11d656a69b4d066cc9c8a4a71a69ab01b8a434ea4a901869d9a5a69a44851498a7d514371494b4522428a6d3e801b4bd6929466980628a5a4c5050b9a434b4955a084a39a75254886d1d69692801694629b45002d1494b4805c525145318ee28c8a68a33400b494514841494514c04a5a5c53a90c6f1486969b400945145020a5a5a4a4014b4525318628a28a041451453014d20a5a280169b9a5e2834861494a28a042ad2668cd1d681866929714b8a401494514c4145281494c05c52538525030a0514b9a40252d25140062968cd266980edd46692979a431334e1494b4c93a5f0803f69f6c57a166b80f0883e7b74c62bbda8603e83499a5cd218dd80fa534dba9a7d2e6802b7d96a29216abd9aa7a9cbe5c3237b1a00f2ebc944cece7a9aa84d4d375a85aaca014ece29829d4c9241cf7a781512d4838ad407373526da68727ad0a0fad310ecd3690f5a5a0350c8feed37753e9000680ba1bba82297e942fbd01a0cc1a4cd49ba982958089862a1e6acb62ab9ac806d2d145200c5145140c297349494c41452eda4a005a4a5a4a00296928a402d1452d301b4b4628a9012968a514c06d14ecd25201714da534555c028db4b499a430a28a29922e68cd25252285e696929d4c42d26680683400946ea0d25218a692968a04145252d300a28a3ad218da5a5e2929885a28a5a6014da5a2900bb69b8a7536800a28a290062968a290c2948a38a4cd300a4a5a298855a0d2669281dc5c51c5253e9886d2e2928a5a00b4b40a69a0a1d4da4a71a622ff1f5a5a4e9498ac4ef169a4d3b14b520c6d2669d4dc5021f49814829298ee42edcd4bdaa224679a996accd0f069370a39a6d49a0e0df4a77029b8a6d00873514a69b934ac0252f5a314629903f6d3318a7629801a650e1f414b4bb714b4ae82c0066969a1b3da94d020a72fe740a3a9e38a007b54d0f4a80e69f081548c646ed856c74ac6d3eb669b3217349453c54812c54f34c4a79a631b49c51453109494b8a4a005a5a4a3a520237a8ea47a662900519a2931400ea4cd149400ea33494a2801d52c350d4b155016eab4b53d559699057939a414af8a0549614b499a3ad2003452eda93140c6629c169d8a7019a0437a548b19a9162a9318a7610c11814bbd56a392e31d2aa973eb542b12c939aaecf4d7940aa72ddd22ac4ef3e2a94972c6a26776a36e7a8a8b9764252eda9020a7eda07722d94be5d49455086e2b2f5341815aac6b3b51fbb4c8673ec29869ed51d53b8ae2d3714b4d6a43d043c514e18a4a4489cd14b495431734da5145048629d9a6d148614fa6d1ba98c6e69d9a4cd25021d9a414506810b4534d140c5a4a28a004cd14628a42168c50282699404528a4a31480292968a62171462929d484252629d499aa631052e690d36a4571692968a602514514862d2514b4084cd14628a0028a28a0028a5c525002d149453b80a4d1494b4001345145200a51499a05318ecd3734b4948770a2968145c41494b4940878a6d14948a62d1cd29a6e6a8438d19a4eb4629005252d25020a796a652d031c0d14da78a00e83c3523c72363d3fbd5d78d45c571da011b98e2ba4cd219aa9a90ef53ade466b181068cd48f43784c87bd3f8ac0f35fd6a55bd9477a6236c562f8926db6cdd47d0d4cba9b561789efc4b185f7a00e34d3295a986a82e14b4628a0070a7e73518a783ed5a1248a69fd698053d40ed9ad3980700290e69d4b4ae0c6669138f7a5dbed4e028b090da4e947348734243ba14d3714ea6ff9eb482e47f2d46cb52b2d47500434668a0d48064d1494b4009453a9b480766928a2818b8a6d2e68a041494b41a6014bc5251400b4945266900b40345140094b494b8a005e2928a4a005a5a4cd2d3b8052628a05201697ad348a298ee3b8a29b4ea0400506928a0028a5cd25030cd252d3b0280b0dc51452502168140c51525210d1494ec53244cd19c5145002d18a5c6292980a16900a28a450628a7530d310ec51494b4804cd29a4a0d31851c518a514084a5c52527340ae2d3a928e2818bc529a66697340ee2d068141a063714edd4cc9a75049a38a651d696b13bc28514dc8a519a0571718a5ce6929db7e9483519b0d3853771a09aa1dd1131a7ad30d489c53207052292941a3ad4b34b21c714cdb4e0292a842d19a318a6934843b9a6f34fc54791eb484041a505a98d4f5f9bbe29885de6939a76da5c629b6805231cf4a4a77ca699baa4638629d5183ed4e02980e156205cfbd57723156ad8fad688c266a580c56dd63d9b2fad6b2e4d26623e94520a5a92c9929d9a6253e992251451400945252d31894b8a4a5a0431a99436ea6e691414b9a4a5c520128a5a281075a28cd2d0316a584d43534754496aaa4956aaac94c44125329f2520148a014fdb4ec528a90102d3e9c2226a611814c446b0d4a1714bbb155e4baa604cf2a8aa8f393dea32d9a89a4c50048cd55a6ba0bef503dc96a8704d03b034ccf4d0b4f0be9526ca9288b6d4845285a76da004db4629c4d26ea631b494ea4a0434d52be5ca1e9f8d5bdd55ee4f06981cbb0a61356245c541c555c9b0ca319a5cd25048ca5a28a420a434b4530128a5c5250014e34941a0a0a07fba0fd73fe3494b48903452d25532800a0d3a99489614b9a4a2980514b4da918b494b4940828eb494b48028a28a005a2929734c606945369d8a0428a4a28a06379a5a5a4cd020152f979151e6a40fc62828af4a2834b412252d2514c051452e69b48614b4945020cd253b14940c29693345021d494514ca1690d1466900b499a5c506a8414669296a442d25140cd031334b494b542169b4b45200cd145149805146692980eeb498a5a290c0d2514ea06369cb9a4a2824e8bc3e0e5aba4ae77c3c7efd74233525852e68a4dd40c5dded45140152026715ce6b527ce38fd6ba5ae4f576064ab4232a998a7fe94d635a068328a2806a042fcd4e5cd2034e0698ac4aa6a600d451e73563655a218c514ec66a454dbef4bb2ac647f35371564803d1be99a66d0298acc81a9b83529cd2eda0688b1f4a6ecef9a976fe3463b5228acc2a3e6ad3a547838e948929b0a4ab0c0fa5406b3b0c6d2e68a4a402e681494b40c292969b4085a28a2900b45146298094b494b4009452d2520168cd149400b4514500252d14500146ea051400b49453aa806d14b45480b4941a2ab4185149450216928e28a402d2d140a431b4b41a29884a5a4a290052d2528a0008a4a334a39a061494ea4c530b01a4a753690ec1452d18a042034b46da53483512928a5aa0128a5a29085c5369e291a98ec19a4a3a52e68003cd18a4a5c9a004c53a9314ac6914368cd252d320d214ca7d25607a361b4801a2941cd32341e73487de97a526691771bc6695968a4dc2826c888d393351b0a9d73546687eda43c519a4c52b9a8ab480d3a9982295c9b31d93e941a339a69ab2846268db4ea434d8ac18a762938a435031f9a299d69f54c038ed4119a00a5a8416136e29cded453738f6abb103f1c54f131151548954999c91af683f0adb4ac5b538ef5b2868673a1f9a05252e68b964d1d3e9b1d3cd2012994ea4a091b4668a5a61a8b4526452e6801921a869f2532a4614e2452714b48045cd14b40a062528a434b5421454b175a8e9f18e69816ea9c82ad540f4c4576cd385231a7a47eb48051cd4eb1814e5502959d568b00b5135c01d2abbca5fdaa1ce29d844af296a8d9ea29270b551e666a572ac5896ec76aa6ceef408ea50b8a5728608e9fb69f8a5db520340a5229e168e94c4328e68cd19143284a4dd41a4c628101c530d3b8a4db4c634d412a8c54c6a07a0939b9873ffd7a85aa7b85c1ff00ebd5766cd59372314ea4a3754809498a70a6d3244a5e94519140c5a4028a280169b8a50734bc5031052d264519a0404528349452003cd2519a5aa10b452628e940c290d2d1486252529a4a04c514da5a5a40252d146298094519a0d021d9a2929281dc7d140e686a63b0da514668a44894ea722eea0e2915621a2834a28244a5a4345300a5a4a5a004a5a4a28017345252d00140a28a4014514a298051c5252d030c504d2d25300a4a296900b4946692818628a51494c90a2968348614bc520a38a402e6929692980ea6d2e6931482c253fa53714b4c0434f045329471405ce97c3d8f9ff0ae80d60787ff008eb7735250e14a2928a420a5cd252d000c6b8cd41b32b5763274ae26e5c163dff1aa432beea653b8a6b1ab206e6929c6932290c51c53c547c5480d202f5bf963fd6558645fe1aa71ed6ef5761522b710d084d205356760a5fc2a892bec346d26a63498a62e6f520d9434753eda4c549456d8d4ad1d4ff85263f1a4057c7b54633e957318a8cad20b941d5aab480d6a6cf6aa52ad219528a5a056401452519a601452d250029a28a290052514b4c04a51451400b4941a290c4a28a5a0414b494b40c4a4a52692988334b45148028a292980b9a2968a18c282692969006292968a42138a39a5a334c61453734b54217345252d48098a28cd140052d2514c05a168a01a43173499a28a6018a4cd19a2a443b349452e2a8619c525251482e2d25145002d1452d00266949a5a6d0019a4a5c514c0297751d693af5a0420a75252eea43129314bba9280d0d334c14669b863deb2476363b6d203452eda341d876ea40690114ec8a631a79a69a5cd04fb5264e8426a646a89ea58d2ac84499a4a5a4a46e28434526ea0d4922671da9b4fa4037531b1b8cd2d2e07bd0295c48281452d21894e5a402907e54c81f4dc52fe94eed4c77100f5a521693069298ac3c7d2a48d6a10e7d2a585b1e9548cd9b3056e478c561dbd6da2f1433143a945369454813c74fc54519a9b34c06d20a5a4a042668a4a5a06253a9b4b9a04324a8aa57a8a900a0514525050a29734ddd4a280429a4a4a05049253a2eb4ca7c5d6a80b7559eacd40f54221db56557151f4a634b52048d3fa5572f4d2f55e4b802a864c5c2d5692eaa07999a854a8b9431958f7a90474e55c54a290c685a55514a296980d229452d20a421d48d466994ae31bc1a68069d4b4c341314668a6f34c04a6b1a5269869e850d350b53cd464e2910cc2ba4cb1aa46af5e7deffeb5533cd697218da6d38d3735230a4614b9a6d01a05266968a04253a928345c04e94ea414b8a7710dc52d2629d5230a290d18aa18628a3a52d32429314b4da2e3169b4b45201e6998a534948628c518a4146680b8529346292800a434b494085c521a2971480514bc5369698c334633499a9604dc68122cf95b12ab55e9f815471506cc8de994f7a65523162e28a5cd2530128a5a281094b4945002d2e0d2505b34142d271494531053b8a4a29005140a290013451455085a5a6d2d21852d1914628284a514941a090a4c52d25020a75369c0d03129d9a6d2d300a4a28cd4880d2d251400ea314946698ce9bc3dc87addc5617878615ab76a4b034b4514098a33ed45252d20229b3b4ff8d712e3bf5aed2efee35716e6a948761951b353c5262ac923cd14a453454923c629c2a3a9314c65b8c0abb11354adf35752b72342cd228cd3b19a7eda646a33f0a6eca94252d2195953eb463daa620d1e58a4322e2a3da73563005370690f5186314ddbc54e40c543d2816842c2aa4f18abad5526a1946638c520a966a86b118b45148698c296928a42145252d25001453b8a6d301d494668148614668a4a4029a28a4aa017145028cd210628a5cd25300a28a5c520128a0d140c5cd2514530b8b453b7014ca40c28a28a6216928a33486145253a81094014b499a002978a6d2d030c5252d140828a3228a602e6928a4a005a05253a800ce6969283c5494252d2f14d34085a4a28c55885a28a5cd218629296931400b494b499a60068a4a5a0414519a0d2602d2b629a69314c66a1fc29b9a0b1a6673deb1d0ee0231ef4b834ea6e28616f3178a3e5f7a43814e1ef4084c8a77cbe94ddd4ee28d0a2b31152c7514b8a746d419226c9a0b1f4148314869960314e3498a334805cd21a08a39a450534e297ad348aad091696968cd210b9c52f5a4cd00d03d47b05a652fd69463d690c705cf7a68a78c5371eb8a685f3240bc76a215c9f4a6e78a96cd72dd455a32958d8b75c74ad88c9c5654639ad48d8629b311f4514e0690c912a5a8e334f6a910dc51452550098a4a766931400669d4da291232426994f7a6522c28c5145200e2978a4cd1ba982414500d1400ee94e8a999a226e6988bd50354a0d40f205ea6ac94248d50b4800a6cf749fc3541b2dd49a96ca246b9cd45f7a9c23a9156a46336d3d453f68145218bb680b4b8a7531586518a79a6d031b9a28dd47340828a4a43458351b9a534c5a5a061499a39a298863547f954ad516452b9434e0530e29e6a26cd50998b79f7aa93d5ebffbd542afdd20666994fcd2f5a810ca4cd3a92ac426683452d2189494f2053290da1d4da5a28105382e6999a7034c00d2514a08a06369d91486929887b2d341f5a5cd252061494f14da7700a4a534952216994ecd2d318da5cd1401484252d252d32828a4cd3b35221334b480d14c6156ec87355739ab7641bb54b2e24d7554f691572e149aac41a48b206a65487351551800a296929885c52519a52690c4a297345301452628a4a00294514b4c04a4a5a290808a4a5a4a602d3b34da5cd2284a70a6d148571c714828a298c3141a4cd14085a3228a4a005cd14734bc5300a4a294d20128a28a040681494b8a062548bb69bb69681ea74da0fdc6e95b60d62e843e435b152cb1e4d06928dd4843b23bd1b852521a4220bc3fba7fa571879aec2f41313ff8d71cc6ae221ad462839a6e0d5b10869a78a7e29a68e5102d3c1fc6982a4028432cc5cd5d8e407daa806ab2a056889d3b1a09e95362aa21e78ab299aa20772b4ec52f5a5c53288b1453ba51b681116da0fe3f954878a6d229a05cf715035583b8d40690b423354a6e4d5c26ab49480a12d56ab322e3af4f6aad59141452d19a002826928a062d2519a2862169297349400b494b4500149452e6900514945002d253a93a5300a28eb45002e2806954e29b48a149a4a28a620a4a5a5a42128a28a0028a3345030cd1474a5a004a4a5a5a04250d4628a062514b453b0829297ad145804a5a3228a40149452d170129c2928a631c69b4e34da4361494b40a09178a31451c5050b9a4e2939a29dc43a8341229b9a005c52514502168a5a434c614b8a6e29dc548c4a4c52e29491480bfc52629e14521da2a6c76098a4c0a5e68d9e9523f90e22938a5c9a6e2818506949a675a1937216c9a9169aeb4f45c76a640ecd3b8a4619a4205069a80e69471498c528cd2013f3a76f14dc914deb407cc538a4a76da00a00306931527e351e33541a0b9a7669bcd495221452114818d00d02ba179a5e69a58d28e94c5a0ee6acda75a801e2a481f07ff00af56999c8dc86b4d702b32ddb35a49f4a1988fa5069b4e06a464d19a9335121a90d310da2969298c31494ea6669085cd14da753018d4cc548f5154dca1334b49462900ecd369c68e298c414a4d329453109cd4249a9d8d40690c77dae65a85ee0bd4949e58a7a88836549e5d3c253f6d218cc52d3a92980629690669d9a420a69a3347d6818529a6d02801293228e941a004a1a814848a003e5a4cd251400629869f4c268b888f6d358539b34ceb4c630d2629f8a613405cc8d4396ef59b9ad2bffbd59cd5a12329b4ea693412252538d25210b4da56a4a062d369f8a6e6900b9a42d494b8a004a5cd19a4c5003a929296800a5a6d3a8181145069a298871e2908a5eb4114ac014839a4a05500fa61a76699523168a4a514c9128a51494862d145148028a28a602568d98e3d2b3eb4e1040c505c512fb537ca43434856905cc67b1a432396db6d67356beedde86b29873421323a28a29998628a5a2801296928a402d28a5a6d328334b4da5cd02169b4b4a05021b4b4b8a4a6019c514b4940c2968c51520140a534531d84a00a0d148419a4a28c1a621d8a6d2e6968284a28c5029e848a69b4f269314862529a4a28014352e69829d40731d4685feacf5ad7dd58da21c47e9cd6c67d2a4d078a4a419341a4214b50b4bc514010de7fab6ae2dd715dbc9d3b571737048f7eb548441b68a5e94d06ac80e69a69dd6936d20105482a2a7e714219616adafd6a9a3d581f356c846827cde82ad21acf52d5691bf0aa20b39a7669b914edd482c30519346e14bcd3210dc7ad3714a41a4cfe3ed9a0a6c693519152134ce2a4a20c8e955e5f96a66a8a5e6a856652978aa5575eaa115ce68373494ec1a36d02128a7631498a00414b4edb46ca40328a93cba4db4c06d25498149b680194b4b8a36d21899a29db452629d84252b52eda4da690c292942d2eca006d14bb68c50210d252ed346d34c0538a434bb68db48636945145020a28029714c04a29f814dc52189452e28db4084a4a522971400d14ea36d2d031b9a2948a6d310b4514516012969d8a36d1601b49526da6e290c33494fc5210690d8ca5a514bb699225253ca0a36532869a5c8a31453b0ae2668a704cd1b6a46328a7f974dc55122514ec52f9740ec3296976d3b60a403290e29c529bb6988d319a654b8a8f6d6373d0141a539a6668a0571d46ea5cd237348621c1a38ed4bf8521c50ec045231a504d23d2a026b432d47f5a5141a2b2340a052629d8a62b8868071494bb37501a899a6eea7d33a53131fb4d0452e7fce698723de8b30b8e14e2b4da936d03d06814b8a5df49f2d31098cd2f4a6e7d29dfad170d07e6acdbedf6aabf2ff934e46db5513291b701cf4ad58b9ac383e95b501e29c8c1135381a6d28a82c9a3a90e2a18cd4a6a841498a5cd25201334518a0d0312968a4a04349a8b3529e2a2a402e6901a0034ecd0506da4a4f9a9714804c8a33462938a004dd498a5a4a63131452eda28109d2973452d310d34d14ea6d03179a297349cd4009452d3726a8425252d25030a4069314bba9001c5368a281098a3a74a334551486b1a6934b9a8f39a90027d698c6979a6edaa01a4d34e0d3f34d352232f515e46315946b5b5053d6b288f5ad086378a6e29c69bbcd2189494bb68141226ea434ec6292a8614da752521094ea6d3b753042628e69334b4ae3129568069b4c9246a3752514160297bd21a4cd02148a294d36810514b498a002929dd2994818b9a28a29b105068a2a4a0a2814b54201494b49400f4e7b56a8fc2b3edd726b4ba5672378a2ab9dd51018ef53361a99f2d05d84dc6aabd5922a091715464c809a5a0d0053320a5a4a5a0621a4a5a4a042d1494ec50036945028a7710b4b9a4a5cd22829b4b8a5a042514b4bd6980da5c52668a9014934668a0531884d18a0d14c41494a46292810ec5262969291428a4c514b41214a29b4b9a6306a306936d1934862528a29d8a09352c5c81c1ad04be94567d8ae57ffaf5736fb56773a0b8353c5585d4227eb5958f6a6d2bb03744c8dd0d3c1ac0577ebb8d4ab7722fad166497f5298a475ca486b6ee6e9a5420d61c95a12c88d3b03b5039a5c5519d98838a5a5a4c530b30c034c65c529a4a0096338ab2bc5574e6ac2eef7ab1d8b438ab11f355a2c0f53f8d5946aa3265a51ef4e18a6254a08a761883e6a4f9bf0a7003ae69734088da9838a95b06a1cedf5a60d20c545d2a5a8f3525901fc2a09054c4b8aacc7d68d49522bc800aac6ad4955bad6658869314fcd2629dc06d2629fd69b48626296901149484481a938a68a5e29e8171d46c229334bd6a804c5252ed34b802a404a41450ab498094bba82292985c753b14ccd381a4001734ddb52714991400ce696948f7a334c6ee37a51cd3a9334804db498a7f4a6d0210c64500d3b34c6c8a00775a01a6d2e0d20d45a0d2eda00f5ab0129c326938a703ed4810c1452e68a00319a662a4c518fa540ec3714da7ad056a84369466901a71a602b5342d3b750280140a4a5a4a0a6478a752d0dcf6c54d992031499a5a4e94c351f4d2297029c16a8a00690f34ed948a71492246eda6e29589a5ce6a8a1063d334ecd2eda68535361ea21a08a1a94f14c91314114734b9a9d47a1733f5a4a5c536b13b850052d262948a402134bf7bb514b9a6026da6e29c4e69a5f1483422929d1d3188a7a551912134014d34f14b4341052a8fc28dd460d003734ee693028c1a63d40e69a29fd685fa5222c19a6eca7e3ffd546323de9ea0345499a6e31495362b41334f0a29297af4aaba04347e14ea3cbc52e0545d8063d29d08f5a4a488e5bdab58984cd4b7e6b7611c563a0db5b1074a72304896968cd2d66683e3a9ba5431d4c4d511603494668a4586692933494c90a5a4a5e29811b3d3334f6c547400b40a28cd4143a99ba9d4d14c03ad14bb69b40094628a5148420a7520a298052034521a621734c18a5a4a0614b4da526a405a69a4a5a631a29783484d15431bba9b4e3cd36908286a4a4ceea900a4cd06985e982034cdd4ecd21a0a1334941a0628b08300d25381a6eda00cbd4c9ac72715afa8b564115a1931a714d34f2b486915623c9a334b45040a49a69634b4da63171452d3715201452d266aac20a2976d3a90c6e28a334b8cd301b4b9a53480521052d0681543171494b4869d80426929692931052538518a402d1d69b466915710d3a86c7620fb8cff00514829882971499a290c3ad3a90d2d032d59a939ab65a996ebb453cd41d0915d81a4cd2b73498c524213f1a64f4f34c7fa5311549a4a5a6f4ab301d451494c41494b9a0d48094b451400034ee69b4e14ca1b4b4668a648b8a08a051c9a062519a28a09178a31453691429a283462810514b49400ea652d18340c3a5253e9b405828a28a3410b41e29294d002525380a5c0a43b094a29b464d0236ac0e12aee6a95901b455cc1edcd49ba63bf5a6eca7f4a6f3de90c6041414a90d2d3405665e3d2a87929f5ab12ce18d572d5691988d1a0a77c8cbd290b1c543f4a645c6bc64537677a932e69f139154ec4a2beef6a63d5874c540724d0315715697355454e8e7e954845c43ed8ab68463ffad54d1ff0ab294c82d46cde9c7ad49c9a893815301562b0fa6301eb4b4e603d290c8e9b8f7a7fd699b4530185b151b1f4a7e093da9ad4b41a2bb7e355daad735038a42b14dbf3a80ad5976aafc564cd10cdd4e1cd26051542173499069c1d7bd37028064668a936d4552c07628a5145002e453b6d329c09cd5006da4cd3c9cd2d21f28d069b4b4da0571d4628cd18a570128c734ea6e0d50c70a2994e1484069714bf35078a02cc3029a453e907d2a8065380a00e6822a404c5079a0536986832a4069aff004a68acc09b3499a169715a14329694d039a44094b8348b4a3eb4ca13068a70c7ad21fc29086e29e0d3693ad5006294814b49c5480b8f7a51494e0298c09f61451c9a1ba51618629b4ecd2b5210d148f4b4536c6329c0d1cd06824771de938a4094b91da98c37520e29c569b9a962b8a452fd29b4bd281dc283cd1b714734c620a43f4a78e298d4c45e34c6352934cc572a3d07719814fe2987ad3ea8c908697814d660b4c2e5e98f9871c7ad47b5da9e9163a9a939148762be36d4899ed4c71f4a9149e82ab4207521a514ec54d8d46e7da9475a29ab9a44dc76697268381da9304d3b148334668e9da9699234fd6954fd69993520152489f5a5a690452f5a652b8ee9ef42d19a3a527618a7eb8a5a6e4529a2c21dda923434bdbd29613cf5aa4448d783f3ad78864564c19ad78fa55339ec498a5a6f34ecd40c963a94d45154b4c6252514668244a4cd145318518a6e69e29086b547814f7a8e916068cd368a2c4dc774a292940a5618da3268a2a8428fad26683c526290c339a28a5eb45c06d2d18a4a621b9a753453e818dc53694d2669082933413482985843cd2d1482914328cd2e290d3b884cd3692984d0c05a61e29c294e2a4760c530353893498a006d3a931513bd3b00f2c2a3696a30d4d3f9d3029def3dab26b5eec1aca7e69932433205213475a2a8432907bd494ce9489109a29714550c2938a7536a44c28a297b5001cd14a29282829051c529aa2428c8a29b4842d3f6d3697340c4cd2e05146298c31498a33494802929fb734952161b4ec51c525003694d21a29885a4a70a281899a9507351d4f6ab96a4345f5e2918d2eff6a8b7fad49bea34d18a69cd3aa46386da638c534135231aa033cd349a7b52568730829b4ee6928130a28a2900b494529140c6d2d140cd324314bd28cd25218b9a4a775a315416129734945001494b4ea4303d2994e26929031334b4628cd00380a6f34b49400b4514ecd03432973451412252669d40c502128a5e28a0614a314b9142e29146d59e367a55a0d55acfeefafd6a7a96cd47e41a38a36d25201718aad7333462a7aa37d2f0066a8452f33d45373487de8ad0c6c49cd04d47f353f342b9571d9f6e7eb48a714607bd309a7a10cb1d7b7eb5524e2a7dd49336e5e94156215a9631eb55c0ab08d54892c263d2ae0354d491df3f855a8ea892ec66a5aac99ab239aa27985e2973f8d149d284160cf151e71c548d4c38a06479151939e2a52a2a060fed484308aaefc54c3834c928348a2948d5589cd597155d9715958351334868a762818817de9a29f49542b0019a6914ec1a169362b0d0f4b4c2314f0d5250525291494f510ecd2f5a6528a402e29c7f0a4e94e0a075aa6c2c33069d9f6fd6977d152161a4d34d2d38d55808f229e314da70a35041ba949dd4dcd05a8d0078a4e69eb82299cd0368314a0f6a5dd46d5a7617cc662976d28a4aa0b0c269878a929ae3358940a69e4d4429f4c9142d1fca8a36d2b0c3146dcfb50bc52eeaa0f9880d1b68cd3a9884e2998a7e2929ea21129cd4ca5a63169ff8d34668a8b00e34da7e282b5681dc674a53cd253ce2a008d49a7ee2681c5236e14dc4680d329f9a4e69d84c375348a7647a527cd40c5a1a9b934ea04371f8d3873453b6d2d4120a46534e19cd2eea65084d32968acd12cb639edfad379a7f15134b59a3bdb1718a8cc9e94bf33549e58a6411e37d49b79e29452e71503b09f7a90fe540a4fc314ee510bd3e334d76a234dd557302734521a5a9b9d3713ad252f34a3348914e69bc8a71a667d8fe74ee36388a414ccd4956d885db4e6a8e96a40185381cd368cfa52621fd69a56976d21a9b831a0734fc934ca7d321063753e2041a683ed4a8735a2224cd981c76ad78eb16d7a56c43d29b32b9353b8a6538735251229a96a28ea6a0420a28a4a004a28340a042528cd148334c074955b353b9a8314862e28eb4519a4026681499a7e695c06d14dc52d3186e1484d145030a051c52d21094114bcd377501a0506928cd0025252934da004a28cd25301294669c05266900951b669c69b40c6934da71229a7da9001a43cd3697a5580b474a6e7151b498a450af262a1dc29b82dffeba8f663bd32112e452545be9c7d691a104e72b592456c4fb48358f544b2334ca90ad47546220a5e68cd05a90682134514d38a603a928a31408296976d379a918bcd3aa3a5cd50730b8a292814ae31d484d2528a6020a29738a5a6200052934da4a4171d4dc51cd14805cd369c05148a1b46697146d34c9d44141a2933480514a0d18a434c62d5ab5c55506a68f752b948b4d30fe1a8b24f5a150d3b9ef537351cb4bc0a5028e2a0a054ef4115206a784a06654e306a3156eed707ffad552b539809a4c52e693341214669706933400668cd18a4a6216941a6e68a00296929690052d1ba969942528a4a5cd310da7e6928a0a10d253a9b41228a2928a402f149452d002d2669690d0314d36968a09168cd2e7d292914379a5a334b542178a3a5262814c0dbb3e9d3f5ab7d2996d190a3a558f2c9acb434562314ee94ef2985336b7d6a5177131595a8f5ffeb56a9cfa5666a29d3d6b424a19a5534dc5256b7331dcd499151669ea6a490a4a7669a0d05683958d35b34ab252b55888c5491d4552aa9a490b52ca355a5354e33e956e338ed5adc92dc4d52e3151c46a5047ad00387eb4f3c53770fad28a0052334cd94ecfb544c73d2a46231a8cf1ff00d7a97a5414c089fd31511c7ad4ad91cd40576d212b95df20d567ab73363b5553cd416c8a97269734da043a900a33494b41dc79e29829696908383d699c0a5eb486920245c9a5d9510735256802714714bd3d29315202e68a3e94014ae02e29d8a6d27357a00bc537a52fd692900ab8a29b4b8a421df853300d2f349d290c78e2929b4f5a600314ea660d480555c2c31b34a29690d3010ad348a7934ca92c8cad381a43cd3454904d8a5e2994b4c2e1d69295683482e28a5db4d3ed4ee2a980b494d3413f5a4021a51f2d19a4e2980e3ed405a03d28345c07eea4ebcd2669148a06e40ded4ad47cb9a56a6212919714b8a4da68017ad05a9b934bba91426ea5a08a419a9b008c314829fba8c7b55dc42548a71ef5162806b328973f4a3f2a8b3526f15a0ae19c8e829a29e83775a09c54e82601cb54cb128ea0fe54ff002e807d6b1ba3b35186834f200a6b0f7cd3d004a7669334e27b54968631f4a33eb4a292a4444e0628892892a4503b56b733b0ac36f34a1b34629abf4a9b163e8a334d15031e48a69714e6e7da99c0ab13b8ce9db8a7d264d3b6d02414946714bc7ae290ee1c0a3f2a6f5a36e3b5326c3f77f9cd2e29b9a7600a0686803dea4e2a3a56a42d077cddf34e885347bff3a546db569b2646d4082b562ac4b594d6dc5d29b39f9512d22e68e697e950512254f504753531052514940094628a4a042e28dd4b494c635cd424d4cc0543523141a4db9a5ce282d40c3814514a78a918d3453452d310714bba8a4e29883147345264d318b9a68a09a5a4019a6d19a3752d4421a434b45050deb4519a5cd0026692933499a006914da71a65306212299be9775260548c76da1881de90b62a267cd592359f3516fa0b9a675a458bbe917148334a78a7a1490bf2d34e4d1be826b3b0586498c562bf5ada772c38c563b75e6b546731b519a79351d51021e2994fa062991613229314a052d218a0521145373415742669c4e69052e68246d2d252d201692968e28286d3862929c450210d1934da78a7a084a29db8530d1718bba929768a43489771686a6d3b340c4a5c9a31494c04a2968a900a7114da298c3157a34c0aa710c9ad21c54c99a40458bfce6936d4c36d26df4e2b33722c52e2a5c7e74be57ad3191a27ad58ca8a6d46e4d2158ad7f542af5c74aa15a23998b494b453244cd25145048b462929698052538536818b8a2973494c340a5a4a29085a292814f4017346682b42d2b9429a6d3da9b40052e29314b48426292973455085a4c500d3b75495a09494ee292a805a0525191520262968a314f401e5a9168a55a6173a0b791368f9aad071eb59318e054be67d6b236e5348c9f8d018550599bd69eb31ef4c2c5ee2b23565381d3f5cd5d175505f9568f8a6990d1859a334a2905686619a7eefc299452024c514a1a940c53023a93a8a610b453b88654d1b530ad3a3e2a865943ef5654f3d2a98ab89b7ff00d555a9372da366a61b6a14c54d4c078e29d51afd3f5a75519dc5fbd51631536da61e6a4bb0c26a1db525474011b9a81feb5316cd57752bef46822b4b9a88d4f2633c55727deb3d0a1b4ca71a6914343b8629451cd018520d029739a4cd266930173e9411ef40a319a680654d195a615cd2ae052b8d0f229a4fb53b34cdd4d80ec2d20149d29c28b084cd1cfad3c20a00ff0038a02c371494b494c6c28df498a5db4ae48d5cd19c539b029b4ee362d2eea4a286c0764d3c35328a6171cd49d3a53a909f6aa101a6d296a3350591e298454c4714d38a42056a50b51e69c31482e3f8a5e299c52d50bee1314b4b9f6a439a7a0b4014b8340a5a572ac867b5274a70a5f969e8223a70346cc5377540126ea29060d3ea81dc31f4a5c6693069778a486328269c31486a90831c521a39a314681f213f0a4cd3b9fad27148007e54e19a4a5cd5008d4cc54a70690d1ca806668e290e69c2b3d477154e3de9f9a87269735422f6ecd37a1e69cb81438ae63d00209fa52628058505bd2983482949f6fd29051d68169dc4c8ef4dc529340a92536472539299252822aec4dc9a81c5369d9148d44385a51c535b1494882466a8c669e4d3735450b8a690697e6cd2d1a084cfd691b9eb4fa38340ac22afe3485a9dbb1466948a0db4b494668b88075a5c9a4e69fb968d42de6373ed48a3da9c6903b55d8e765fb361baba18fa573965f7aba38ea992494fa674a78e6a043d4d4b51254b9a0028a4a3348614da5a42d5448b9a053734b40031a80d4ad9a86a2c50ee0d36940a5e281874a42734d34e0b8ef40c4a534d14a6810a2838140a434c06d14669b4843a9297148698075a69a7d46690c53484d29a6e68180a53cd26ea33400ca4e94edd4c634c91a5a9b483148d8a458bd2a276f4a775a6ed34ec481e2ab39a919ea323354591f34a69d451a0c69dd4d2d8a91b34cf2f348a434a351b5aa5c5385401011590e0027d6b708f6158d38e78ad119c915f9a45a5c9a4c55990da0d29a426a0425369c451c5001452d26ea0614da7e69298099a7714868c50021a4a766929884c53e92979a0604528e29b413482e29a1a8a5c550c6d1452549218a5a051ba801326929734a2800a6d3b3499a43168a29734c64d6cb96ad3fcaa9da01d6ae85acd9d101845387e149f85017d8d4156629069c0d2d26714ee260f5053cb52a8a90b95275fff005566d6a5e2d6656e8e79094b9a0514c81297140a334085db48052d14c7a094a16931466800c5252d14085c52519a290c2971499a3140829c052538bf6e3f2148a18697a5145310b4da5a2801b4ee28a4a042d14b8a38a1942521a5cd141214628a051601f41a6d29a458dcd4898a654918a6ec4a3481e29cb4813de9cbcd62ceb1e39e68269db6938145c62e2a19d491ff00d7a9369a90f22a8968c1e68dd4e71b4d32b539853cd381a69a5a2e48a1a9f9a8c0a7106a83514ad34d49c523629ea16232f4f50698453c1a43254cf7ab8833559455b515adc8b16e35a996a146c7bd4bba81926680734cdd4b9f4a64dc09a6f229edf8537340861a8f771d29edd3a7eb51f51414465aa1909fa54c41f4a8e451523b145aa1ab12e2a2a40446909a5349598c760d478a782c78e4d073ed4ddc06f4a36e6979a4cd2602e28a5cd19a6026291aa43498348062b54c56a00715643e690d5889a852294f34a0645024368eb4e39a38154900cc7d697f3a5e69724d002714a29a29df2d201ac2902d3c9a8e9884cd38521a281ea3cd2eea6d03154171d8269c47aff2a602475069d9a0913eb4bb714b9f6a52c3fc8a4511e07bd464fb54db8533ad31d884d3c1148d480d65a88786a7e298bf8515404b4d514e39a4c9aa0138a4c628a5a4ec02668a414ec7ad2013934de29f9fc6998a601934f5cd2114a28561d98b9c9a77dda62f5a7e0d35715c38a46e6970690f1416329ff4a46a4fd29e84010c2929f49c5031bcd2f0696948353715800a71a6f5a7e2ab40e622a5e3d314f2b4dc7a51a1430ae29b9c54869a12a445c03f2a4c1f5a71c7e14118ac0ee6262931f41484e2978a057100a5e7f0a6f34ff2fbe2864a128ce69db79a0fd282c89f9a14014c62052a8cd558cefe44bd691533d68e681f5a458ec629383da8c669714804a053b151e31576017a526ea0d0a6b310b475a5c52e05514376b0a4269fb71dc51b41fad1622e3b34808a0e7149d2a0a0a53c5039a42ac6ac43c2e6a3c11ed4ea6fe3548ca46858f35d245d2b9fb15f6adf8cd0cc89719eb4aad4a45316a40914d4d5029a985300a4a33466983128a293348404d2d3734ea602115153e4900a8326a752c7934c1934e14b9a3418de94b9a28cd21074a334da29887034da5cd267348770a4a5a4dd45c43b3484d2519a003349ba929298ee21229b494548c0d21a452290b8a6029c546d46ea6669a0d05073498f5a509b698ce2a8428a4f36a2dd51d415626dea7b530a29a6106999ab1d8970690a30a660f634be63f7a572be42d2608a2a4e28d04459349ba9f95a671503b85645d019ad5295952fde3542915c3537752f4a6f5ad0e717a532948a290c39146d3d690b514c028c669720532908930beb4869b4b41421e69451494c414668028aa10a7f0345251523b8b8a5c537069d4001a307d68cd041a401498a3269dc5021368a6d2d06801b4ea4a28b08514da29d40c4a2969f1af34ae3b17e08c0153e197bd26d1da9437ad433ac727b9a5eb4d2dfe714a0e28b00fa63014bc54600a810ec53829f6a6f4352669d87a146f4566f15a57a9f8d66d688c262d21a4cd29aa331a28cd2d252245a5a4e68a630a28a3340851498a33466818b49453a801b46696929885a4a5a4140c28a5cd14804a5a01a534804a2968cd30b099a5a2909a0602834529a042514e18a4a0036934a6939f5a4a005cd4b1f5a8854f063348714699a5e94da7fe1591d649c54679a9298d40b40fb94fcad570f4e26988cebc8f6b7d6a01576ec03cd52e456a73b43b146ea4cd045002d2d379a051610ea7714ccd3f02b54c4c6015228a6e0500e29068598c55b4f9aa9a73565299362e271528f6a853f1fc2a64ad42c494ddb4ddc69dd6826c87715186f7a5c5478ff0039a4039ba5455267151b6074a45fdc309e7a9aaee40a949a8641f8d3b124447ad5764a9dfafa7e3511acd95a10834d34f34deb5401463146283598075a4c502937520168e949453403c520a01a5e29a0236c53d1a908a6ab62a409f03f0a6a9fcaa4debe829814d53403f39a6f5ed462978a4ee31bf85140a2a841494838a5ce6900b498a3f5fc296900d349ba9707d2930681dd86ea5a414b9cd3b0870a0fd293a52834c078cd2605018d1487a09411451b734362226151e2a620d46cb5202d3b1518a905021c8294e6982a42d9edfad3403714dc53a802a84285a46a338a71a572861f6a6d3c9a6715160629a5a68a7f06ab4188334fddeb4defc53f20738a42b203f2d2352b51b89a006839a53cf7fd293a51541a8b41a4c504d21875a68a5dff00e71453448f23fc8a5cd379a519f4aa18b9146ec1e68a29587a9195cf4a5a503eb49c53b08b59e293f2a067fbbfad498ae73b88f6fbd19029fb477a00fa5486a34d14a5690d3b14200c29cc45267d695b152c644f191da90539bde916aae65624e29b9ef4a451b87a52b17a8bb69b8a7d3580a91b4369d8a05376ff00b55648e35185ff0022a5e3de9aa295c63b9a4fca9c7a545834c4c79a5a434734ae4dc5a28561e94eaa04c68e29f9349484d2285342e0d263da8e9d28b99b342c5b6f7fc2ba28ce6b9bb05c9ae913a5533225cd30d2d262a6c48f5a9aa04a96988752529a4a450514dcd009a62034a05262968108d10a848a998e6ab93414389a414d14f1536012969334a290c4e2905389a65301e69a2969b4200c518a4a5cd21084d2138a69146ec503034d24d2e69b5430cd34d2e290d201a38a66ea71f7a8b34c6869e69c9c5266994c448ef50e68e68c526322cd2e29db40a4c37ad2d0b1b4bb4529140145c61b714b9c8a064d3d52a46376d38eda3348d4011f92290c23dea4a8cc828e626c237d2b1662326b5f7d634e0926b4444861fa53318a51485855190d6e7bd252d06810829c2994ecd05202b49b69e6a3a40d2171494b453244a28a2800a28a514c04a7668a4a431775140c518a60253b3499a6e69582e494da753298d894a053e998a44d853c518a5c669b4862902929690d318b8ab7669b9aaa8ad0b14ee2a245c51776afd29bf675a5cd396b3b1b9134457a52f352b74cd376d3288f834d29cd4fe58ef48501a1324663777a9314891e2a4d94c4675ed6656bea1c8ac9ad118c86d25293453331b453a9298ac2eea29314b8a431b4ec5252d02022900a4a2801d4b494bba98094b4669290c5eb498a5a6d3d442d02929d48036d1499346681852669dc5369887669b9a7536900ea375149405c5a4a5a5a40252e28a0d030a960cee1510c8ab16fcb0e9f953046a6d34bb71eb5211e9495ce750cdff5a84e69ecfe82a300d5a284069e07f9146da295c923b94e2b3056a30e2b3df835aa666d111a70a434bba8310a5c8a69a555a602814e14dc9a4ce6a807b2e2900cd3a9bd2a912588f8ab911154a323eb57632b561f32cc64d3fb74a8d38a956acceec7038a2827349bbd0520d0371151e69cf51e69031e77545c53cb629bd47148762265cd44d83cd4dc531ea86881c543c54ae87d6a165a8b8ee40dd693a53b14b85a910ca4a7e052549561318a5c520cd045300a2928e2810b9a36d1814b40c71a8985499a6eda918f5a763150f4a9c63bd59220a4e94f614cc1a0a171494ddc68fa52b8ae29c7bd1b7e94bd68a680334714da5a7624539229053e9ac2b335f98c383464d14b4c9107d6a45a8c629f409587ad3734dcfb668279abb80f38349bb140a4a9d40314c2b4ee45252020a929ad4b83eb482cc973494dcd3835500a0d2d2525201fc7d4fd698734f03149d2801b9a053dbd285028b95ca336e290549c5336d31342e294134da526a063c366979f4e2983029e735a5c426da6d281cf34a71400da434e34c35284c7e73d8d18cd3339a7053f8555c629a900f5a66476a76e06a352b41c49f4a67f3a4f9b34fc56a4ea3496f4a671dea6391ef519a5a8ac59e9f4a37538e2a31c7ffaeb0b9dda0feb4811a90fd293e63ea2a41bf51d4ec01ef51e3f0a5a63b8d209a51cfb5039ef4efad3b810b1a445a7489491d2207ec34b8a72934dc8a77344852734bc530b0a38a9421699c669d96a4e955624751494e1516431699526e06a3fc29dc6c7f4eb499a1a85fc29921d69702937ad3b86a91a41b968db49814b4c0290669c1e8db8354ac6522f590d87d2ba28ab9cb4273c8cd747174a0cc90d36834dcd210f8fad4fc54118a9a818e34da2814c04a5a290d020a29334bc531016155bbd5822abd2285a3e94b454805141a3340c6f4a414ac292980bd28a4a3754883f1a4dd4dc52f14c698d6a0e0526283c5020e29b9a5c531df14ca0a6efc547bc9a4eb4ec1f211cb1a66d35275a6669008c699b8d0ed4638cd30b06693229b8fad2102900e269fb8771fad37a51bf353a94829c169839a780450593054a6b10b4cde7fc8a6eea9631452f5a61a6f998abb00f20d44f4ff333471df9a4220319eb58f2b1dc6b6e72a17bfe7ffd6ac227278ab5722561a694814da424d518e8262936d3e984e2aac210f14b9a0d25002d340a7d21cd48098a39a5526937501a0d14fe29b46ea621694536a4a6521bc8a4a527348052101e28cd069452109b6969292801f49467fc8a4cd505c5cd1ba814548c5c518a00cd25003b14876d2f34da655c415af0294502b2e14dc6b5b06a1d8ba687875f7a7f07d6a13c7ffae9577567737d49a9c950d395f9a4225e1bb7eb460f6a40f52641a4161bd69fc8a66692af51943503ed8aca26b5351dd5955a23998514a693141026694d252d300e94514521898a5a0d2d30194a28a29923b349c5140a43169294a8f5a422985850694d3694d200a292940a004a4a5cd18cd0213140a70a4c5020a5a4a51c5050628228a5c517012973452014891314fa29314ca0cd4f6ff7f8a82a7b5e1875a423707d2a39594501ea1624d6476a0dd4ec530f14edd4c2e21a5c538e28245218de2a8dd47b79abe23fce92e6db747548cd98c2969391499ad0e61d494e146681d83a5252e734983ed54989a260a2998c52a3534d080b11815762f6acf8f35a11127ffd55b991614549bfdaa239142bfa505a63cbb7a537cdf63f8537773d3f5a8cbe3da991664acc7d8fe34dce7da9a0d309c9a57026278eb4dce7eef151160297ad2285c8a66dff002682c3d29ac49a40d11b7d79a61229e54542690ee46c29b9c52e6978a562c6934cdd4b8f7a5e948912929dd69b8a188334941c52f353a0052529cd005500b9a70514dcd2d40c662a54351b62856aa11391fe734a4d26ec8a3a7bd50219498a7961e94d6a4df90586f14a4d20a57c54ea020c5487149b69b8c5318ee2900a7629b540215f6a2928c521062968ed429a007518fc69a49a514b4283762929585262a89d45cd22ad253d4fd2b30b11b2d36a6205418a56287ed345354d2b550893e94a31e9518a78148414bd68cd19c5500854d25297cd203ed523603de8a290f14c62e79a5229140a71e94ae3199f6a7f4a60a763de9902d21cd3b8a4cd50063f0a611cd3a86cd318da916a3c91da9e1bb1a34041b051f2d1b31ffeba6fe14809a8c8ff00269bd3ad2e314142fd2a36c0ed4fa616aa219676eea7631f5a45140cf7ae43bac1fa50293a51c550f98718cd215a3752f4a4d8b41157bd0c7da81fe79a4cd2632266a48cd2b0a55e3fc9aab103f9a6e4fa549f2d26f34d0f518714bd281499c76a90b8fc35369c4ff9cd26453101e6978a0014a7a54b28438a31ed41e4508a2aec488b4ee94d34edd48042568f9bda97e5a6d021c0527994039a08a631f50e4939e6a5519a084cd3465334acbaf4adf8fa56058f5add5352c44869b494b9a007a54d50ad4b9a4486ea28a2a800d1ba8a3a5001d68a414b9a00466c557dd9a9deabd201fba814ccd29a0a1692814e38a9019473453775021d4da5a4cd5009ba969bc51486069b4ecd45ba80063511e695dea1269d8ad492a32453371a4a90262df8533349f5a00aa1887e949d29f9148714806d1e58a775a4ef46a1611b9e94a805373cd3b3ef4d0d0bb5681499a5720d4976027d28db4cdd513ca693103c98e951353e908a2e300b9f6fc69452e69f4ae056ba3c5639ad5bc3f2d666dc715b2660c4a6134fc629a066a88684a4614673494ae201494ecd262a9a00d94828c514ac20dd4526296906a2519a52b4bf2d01a89c514a697a55142504629c1bda93ad40c4a696a752719ab2350a4a5c52d480e0ded4d34668db4c6d8f18a69a5fc28cd050da5a6e2968331c298d4edb49c5228b9651f39ad3f2d4d54b6f957a559f379f4ac59d68468c7f934a0528db4e1c5218cfc2938153527cb521623c1fa52e69ecb4879ab111f23ffd7522c9430a685268d492adfc9c564e6b5aed6b288ad4ce626e3494669299830a5a6d3b340c3ad29a4a76698c4a4a4a298828a297a520b06ea4c1a5a5cd21852669334b4c02968c52520169d9a65250170269452d369885a0538526052014d252628a062e68e29d4ca043c527346ea5c503133c519a3f0a4a05a8e38a9ed4f3501ab369f7a932e268e3eb4ea9314cf2eb33a2e34aa9a40aa2a5da3f1a69152323cfe3498029cca7a54cb10229ea50e817be69f21dd4ded4d26a446048304d32ad5dc7b4d56e95d07234252e6949cd0a699028a4a51cd34e29942e69f9a685a7ba9a762752488f3d6afac8a2b292a7dec2b402fb4f49e67b5512ed479cc68116bcdc77a4ddcf5aa99fca9d9a7a0d16fcdcd377d57cd283f8d004a5d69de60ff26ab1614ecd2024df9a52d9a87ccfce9379a043cc8294f3ff00d6a849a9ad274471e67dda91d8aee98eb4deb5b9a9c30e320562617b1aad02cc41c526734fe949520371494ea4a86313031d69035387d2998a2c2149268a5e9482a8618a4c9a5e94035020a4352f5eb4c345c2c3e315263155d4eda973561a0bb8fb51498a4273406a20a2945348c50d08062969091480e2ab401d4734e1f4a5e2801a69bcd3c8a6edf4a431b9a7d349a2a405efe94a1a838a303b552b1428349d29bf769377346848e6a5c5373cd2822a404cff009cd35aa5a630a5a14434f1498a5028245e69f4ca76e145c63a8c8f4a368a53f2d310537f1a5e3ad26334ac303f5cd26da77cbde931f43fe7eb40ec0682d4da7628b084029d9cd252d3421314b8268c62a51ed5770b0cc7a530bd3b1415c734b50b0848ed499a3ad3dc0ed482c36979a4a5faf3f8d030cefa5148b8f4a71354160fd29b9a9339a8daa445b1f950c79a3752139ae63b50b81415a5c6ee0629bf28aab97640569a12949ddef499c5172341d834de47bd2d2f348b444d425121c51155b31b92e6928e2937516340a5e29a0e29d503133498c52b1c50b9f4a1dc80294a545380c50db47ffae9dc7ca3473d297f1e68047d29bc1345c638d253376df7a75021c0668c77e9466835201ba8fc3f5a314ddd5a0ae48af4d7eb4aa68cd1a1136cbb6b21cf4adf43c573f6abcf7adf881c54b3324e696932290114892502a6e2a05a9f14c614352514c570a5cd3738a4a61a0a0d2d33069e08a064721c5422a6900ef506734ae31697ad30669d9a901f9a66ecd0334a4505084d3734edb4dc504ea368a19a9a185310e14d660b41a3029143739a613b6a52eb51b0a7a0106ecd446a5229879ed45cd2e30e697f0fd68db4fd84548c66297eed2eea434c41402690d3d48efc53109ba8a92650bd2a0cd08a14f3c537a52eea557145c42e2985f148d262a1fbd5231d9a5da297f0a69e297c860dc7d69ce053473e948f4ca0e476cd3b914ec53f6d408cebc3c7359bcd69ea10e3073597cd6e8c1867d682d4a290d3111d34834e228c537632129d9a1c0f4a6d4962d285cd369334c43a86a052139a630a5a4e94b9a4213346690b52ad5083347d295a8fc2a4a128e29053b14122ae2928c518a0b02c29d49c505a99219a4eb450290851461a8c539707ad0cb486d3979229a6acdac07ad216a5e54c53f8a4c9a76cac8e9136e6a755a1235a78a92ec20434cdb8a9307bd215340ae2605274a77d6901357601b9a6eef6a909dd5115a8114ae7245661ad7b85e2b25ab646331b8a4a7d21a66432949a28a6486da5a375148a12945252d5084a3269738a05200a0d2d068189c51494e14086f4a752d263348ab094b452e698ac273499a2928131734629296810b9a280334b4142506941a4a0072d2f4a434dcd002e69c298d4a3348351777b558b3fbd554d5bb33cff00f5a82e26befcff008e68c7be6a1c67ff00ad4edd59b3a6c4e290eda8c53ea4418e6a4ce0d37f1a539a2e1a8dce68e9473e9fad3c0c53d0774656a02b3eb56fc363dab2f65688e66251b694d20aa205a5a41462985c78ab0e99f6aaa09ad7b7b4fb4ae0100fbd5a2798cedb4dc915dc47f0c75c64054591ff00b7c3ff00c6ab2af3c17ac5b37cd6573f58e16907e82af50e789ce92451cd6949a35e0ff977bb1ff6e72fff001ba83fb36e4758a61ff6c5ff00f89a39587347c8a5cd3aad8d3e53fc0df5d869c2c24f43f950930454e692af1b07f4a60b575e28b032a05cd36adfd91fdea2683d68b0684279a56a714f6a6ec3e9484349a69cd1d2907359ea55c93ce908c678a6b6297069319ab10529e2908f6a6d480b9a6d3e9956c0908fc2994a334d3500c29d498cd25568170273451495002d1cd2e7f1a3340015e2950d34e693914c64c6929aa69dcd310de6969314b5420fc29cd499149f37b5458a245e949b7d6946eefd3f0a28b887eca62d3714a187a5050dc628a0d00814c91a169d823d29bd69d93414981a291b9a5cd3b1225078a439a5a571b626ea2814bb854e80308a67352734c3ba801d9a72b530352d261724a0669149ef4a1a9dd821c293a51c526734f984c71e05332714fd94839a6914c6120d1b8d3b8f4fc73499a9d4400d049a3a529a630e453b71f6fc0527149d2b444d98b41ff3cd26734520d45294c048a5cb1a07d290c37d28fa52134aaded4c4273ebf853c9a4e07b9fa50377a7e75286ec05a9d9f451487fcf346ea3402ded34b49d68231591dc1923a7151edfc69ff8d18a9d4068a4299e6a4dbf87d68a62e51b8a5dbef4dc9ed922958669301928fc6a38da9c4d1195f4a3532b0e14b4de5ba51fce996d8b8a70c37ffae93a518a5601d406f7a46cf5a6d171b63feb4cf97eb4b9a502a47a81a6e00a53483e95420c0eff00a528e2976e7b6293a5492394fe1416268149f855942e7149c53fe5a6fe34c05cd01853801df9f7a8d94534652e62f5b356f21e2b020551f5adc88f14999dc9a9579a6d2e6a409c5482a00d530e941418a0352d369102d250692980b4b8a6519a6039aabd4efc55414b52879268c52014b400edd8a37547f8d1d690c5dd4d634b8a6b8a686309a6e2969dba993a0b8c75a84cb4166351d22ac2f9b485b35197a5a430e3b5206a314f028284c5253ce734ce054148053189ed4f14daa10849a3ad3f351d05060fad3852e3d69b56486298c29dcd2f02a18ee45b7d680b537ca7ae298e050035a9319a900fc69b8a57191d3d416ed4f087bd380c5310041485b14e2d51134c0a17ed9c7f5acecd5cbeebeb54375688c1b1db8d2d337e69334c9b8d65a29692908376683494550aec0b5252e3345480a0d266969b4c6c5268cd26da5a421294352eda4a63b30a50d4945200c52d2518354039b9a4a434b4c42e2930694d333520c70a3a528a3140c4a3a53a8e3d69859882b5a08c28ace81371e95a19f4aca4cd624aabed5616223d6a21b854e5f3d715958e8108a606229c0afbd4a1476c5501197a707cd34a8a5db46a2172b48314dfbbef4da2e21f8a38a053f3520cab74bf2fff005ab05b8ae82e880b5cf939ad518cc4a29690d5190da5140a09a0421a5cd029298584a50694628c530171499a290d0019a5a0d1458043451b696810bba8a6d2d22ae3a9322947bd21a0636968cd1d691004525498a65036829781de97145360145369c290ee2e69b4b4b9ab1312940a4a70e6a4626dab36639aaf566cc7349948d0e9d052ad1c528635836ce914a8fa7e34507141a5a8c42c6a40feb51d2f5aa16a3f78a787aafb6979ed41761f72032f5ac36ad825b9ac995706ae29983223cd251834a2b439c29c690034954842e6ba2d0a35924452d8f7ae756b674a93638c7f3aa407b21b896cb8137e828fedb73fc42b929753dddff5a8bedbef4c0ed5757f7ffc7a95b50b77fbd0c27eb1a1ff00d96b8a1a87fb5fad397506f5fd6815ced56e34d3f7ad6d7ff01e3ffe2691a3d05bef69f627eb616e7ff65ae3ff00b45bfbd4efed37fef51f789c63fcabee3ac3a4f8625ff972b1ff00c04dbffb2d46de0ff0cc9d2d6dc7fd7393ff00af5cd0d55ffbd4e1ac3ff7a8f7bbcbef1f2aecbee3625f871a3bfdd92f23fa187ff8cd5293e16d91e97b3ffc0a08ea01ad3d48baf483f8a8e69f7fc02cbcff00f027fe65197e154e3fd5dcdab7fbe08ffd92b3ee3e18eadd9ac4fd2eb1fcd2ba31e219ff00bedff7d9a4fede7fef53e6f407cdfccfee5ffc89c15ef82358b7eb0a30ff0062743fd6b9cf28a1239cfd2bd666d48b8eb5e69a8aa895f1c73eb4865034722978a3340263771a4c53b8a4cd016129b8a9293a54b0e51a28ea690f34a2818d39a70634134b8a57158466a4cd285348c054dc62834669314d15448fa18d14ec1e948646af5267351814f18f5a6807a11de94b7f9c54629cbc550ee1f8514b9a4fca98878f9a903d28ff0038a652b087d05a8df9ed48067ffd740c6e4d253b70a50bf4fca80b0ce94fc0a4208a0fbd22860229cb8fad18a3a553246eea314629428a842d46d2d18a4aa18bba919714a0e29e5aa5a1fccad9a945464528a048939a4cd068dbebc531b1f834a3149d68cd31120151d381fad1b7f0aa1b23a5a52bf9d280beb522109a6b715295c544ca69245bb8e5a1bf0a052ece79a3516a262971f81a71db4dfc2ac91290f14fa4001a9d7b8ac30afe34e06931f8d19c1a65031a5dd4cef536054ea16106d3435308a7eda6ac3b96fef7bfe349e663d69719feefd68d8b9ac2e7688714b9cd26d5a4a7cc1af90163e99fc6900cd3d80a4c8a620cd048348587d68e40ed525111cd22003fcfff005a929d183eb4ee63725084520e29d4c248e2834f901207a526e14326694567a0b514b9a4db9a7eda69a6506da4c8a3f5a5aad4043b7de901fce9cfd28500fb504ea3b07d6834b8e38e94ccd0c63b8f7a0ad271eb4b827ffd7522d45a157da8db8ef4873ef5624c986dc62a2017e9499fa8a7164a488996a215b300e2b161e3ff00ae6b662ce2a9b249b753b34d14fa9b1048054bd2a25e6a5a005069339a4c8a4cd310ea4a01a4348614e02984e29eb40909263e9557bd597355f2b40c5271487f3a5a4cd22c4cd28a5a69cd3b902eea8f934a58534363ad050dfbb519a79e6a12051a142eea6f14d34b4b4108db680b48569c3355a00b9f6a3149ba903546a68293515399a8c6291228a0b629a4d2114ec50edfed4bc537767b6294d2b942d34814b4d2ded4c42d347d69d91498a9d441c8a6124d3871485bdab418038a78a6fe14f5351a0f41e3f3a697a6efa8ceeab003c9ef4e1116a14d49e68ed53726ccc8d406c6c66a8ec2dffd619ab77b92d54fbf35a231637149814e2452f14c91808a5c0a653691371e569b9c53a8c551414da3068a440b8a4c52669d4914368a5029c5a9b246d2e292928287e69a452734b934d88314b430a4069dc62d14a682690c29b4b8a31413a8ff0097d6909029a281415717ad038a2940cd022e5ac7deae0c7e3496f162a63b57b0ac9b4758a283934d19a949c56372860149ba972bda9bd69887ef3479cfe99a6856a335416245901eb41e7dc5570587bd49d28e52352522999c51934a7dc1fad2b1457b8dfb793c562375f4ad9bd6caf158f8ad918486d18a775a4c53331828a28cd5122e292a4dc29b48b194ea4a762826c34d2d2502810ee29d4ca5a2ecb0cd2514b8a620a4a334034842eda5fc2933463341429029829c6928258b93494a0525002d2e29a69dd690c314a70290d155a0c285a5a5d94080d25377519a4171dcd5db16354f755fb15a96cb45de29553bd1ed4f504564fe674e83595a8da6ac8fa52e05171dd954014ddb564c54d683d2926490d2814ef2d85273f4ab000a0d665dc7b0d6b88f159fa82d342958cbdd499a7114d15672ea3851498a7f02aee2b09d2b534e3c8acbeb5a9629c521346d34fcfde34dfb67bd526a61156997c85d5bdcd3a3bff7fd6a8ed148140a2e4721a7f6dcf7fd69ff006cf7acacfb52eec74a771f29a9f6da3ed86b2d9f8a66e6f5fc2aae235bfb48d385fe7bd636ef7a4f376fad0163686a98ef527f690ac1dcb4be77d69682379b5303bd72774df31e9579a6f7acd93935232234b4fc5466a842f14ca902fad33153718362814a31484af1430d44e68068cd001a8010fd69c29a451cd505c5dd49b734b8a3eb52cb003146076a09a414c90269c299cd281408465a0114ea8cd301f4e069a0d2d55c428a51494b93498c7d27cd4edf9a6fe1400ec53734ad8a68f734c2ec5094ee29a36d00d055c06052669dc629a2800c5253bf1a314c9b087229314bd39a0f353643108c73914da29d5571683338a5cd1b6971500478a6e69f4d2b4810e0694734d1473400fdd4f66cf414cdb4e5ab02407da87fca99f5a7305a94cb107f934d029d9a1fd6aee40de94668c521c540ee3b27f0a6a9345202b55715c76da55634ec5301a71639225419a6ee1e83fcfe14de94f34ec17187349d29c6822b3288da9e76e29198d1f2fad2b800618e948d4aa477a6902a8877340ab7a7eb5167dea45e98a6f7ec2b9cee17763fc68fa5231a41ed4d0ae3f8a6f14bd7eb41a18c55414c233ed4ab4bc7f93431d882414aab8e99a71a62fd6833689b9f6a4cff00934a55a8d94cbb8b8a613f4a5038ebfad201f4a8d0a13a9e69d4373c0eb48bb8d519dc70fa51d4d04fd6968655c6b52814868c91484da168a6eea763eb40c1453b7e3af34d201a33bbd29885e281498cd1c9a9b88916a27db9a39ec295413d14fe556432cdb6e63d3f4adc1c0ac785b69ef5b299a96644ca68eb4d14e15431eb52eea6640a8cca290922c525303d1ba819274a617349bcd3a8005a92a1a7292698c7b605402a52b518e2810da5e28638a899aa07a079bed4d3266a376cf4a40a2aac3b324a8d8d3d980a89b340585eb4da4df4c62d458d1126050314d0d4b52160a6f1eb48c73481686217a5212290d233d0ae50dcae6a4cd45c52b352d7c807d272695549fa54a30b400ddb814c39352b20a8c81de801a18529c76a6f2282698c5f96908a4a4df5000734bb07ad2e47ad2eec7bd55c18b8c53377b53b71f6a666818bd6855a714e28da4fb5021bba9b9a79c7a546f2281e955a018f76496ef5060539db7134957639d11eda0d3d58534d321a0fc29a4d3835371484c4a314ee4d33a53181a296918520b060529a4a526986827146334995f4fd69f9a76109b694629c464546314ac5051462948a64894b494e52281a0db4538f14da572ac2922938a40ac7ff00d74e355a923692941a38a44882ac5bc619aa202af59a54c99b451a01d476a6b7cd5271d69a79ac343a440d46efc698e0d381fc28b0c3029785a36fa0a6e3d4d3b22341db877a09a8c8a72834143979a5ebef51d28e3daa891e377a53b19a667de9e38a91d8a37d9acaad0d424aa06b6473484a4268a534c8194528e2834c9129ca69d4da934b094525385510368a5a4a005a39a7629b520c5c519a0518fa0fcffa0aa01314ea4cd28cd0018a051cd26da43148a6d2fd296801734de2969b4805a5a6d3a9d842d20a5ce29bcd218ecd27e3499a5db4c570a5a4a4a007568d8938e2b3d6b534f5e29346b145c58f34f1c500fbd3f02b1d4e843b8a0526690d210bba9dbaa3a71c7a5003ff005a5c254629680061e9552f60dc95777814c93695a0939865f7c50bb7bd4b28c76a8ab731145275a5e2938a645c7af35b9631855ce2b117e53deb6627f9691aa43a43516ea24cf5e6a1df571209bcc38a6799eb9a6eff00f39a679b55f22742627d2937d447db9a3e7a61f7937994feb55f771fe0053b19e869087eef4a334de839fe548bd3d6a8ab8fca0eb81f4a679b1d378349b3e868e5275192153d2a239a73151ed4cf328b068339a4c52b53b2de9485619cd2629fb69b835160014da28269886914fe293eb494f4285e290628fc6945210da50477a4241a33f4a4303452e69a334ac224a3a52518269a2850734c7a7014139fad5937235c53f3f8d4669ea3dea340d49290fb5264d1939aa1dc7d01969083494c4d921907d690352628e0d0805c114de0d0334e0b406a348a29697ad48c3a1a4e280f4530d00eda6e29c7e949c5084c6eda5cff009029e3149b7d29582c3377ad2edcd0529371534c0314c6a7b313ed4dcd48f4194fa6d0290c9375206a6fe34e53548448241480530549c8a2c02ec3e99a6e727d29e5bd29a69e80d0102a33f4a95b9a616c5201a169fb4019dbfad37346ea62d0551ba957148370a3e6cd0317eb4e14ddd9f6a012b473310bf5a414ecd2ede282b97d488f268228cf34acf405d0dc8a77e3f853053cb7ad04e87fffd9, 'image/jpeg', 'Kwaku', 'Afreh-Nuamah', 'Afreh-Nuamah Kwaku', '1986-04-23', 7, 'V1111', 'Ghanaian', '', '', '', '', 'Single', '', '', '', '0243080560', '', 'Ofankor', 2, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', 27, '', '', '2015-06-09 07:45:21', '2015-07-21 11:25:39', 1, 'alive');
INSERT INTO `investors` (`id`, `user_id`, `entryclerk_name`, `customer_category_id`, `investor_type_id`, `payment_term_id`, `payment_shedule_id`, `payment_mode_id`, `in_trust_for`, `occupation`, `id_expiry`, `id_issue`, `joint_surname`, `joint_other_names`, `joint_dob`, `joint_idtype_id`, `joint_id_number`, `joint_id_issue`, `joint_id_expiry`, `joint_phone`, `joint_email`, `joint_postal_address`, `source_of_income`, `registration_date`, `investor_photo`, `GRAPHIC_TYPE`, `surname`, `other_names`, `fullname`, `dob`, `idtype_id`, `id_number`, `nationality`, `hometown`, `birth_place`, `work_place`, `position_held`, `marital_status`, `children`, `nk_relationship`, `postal_address`, `phone`, `email`, `physical_address`, `gross_income_id`, `next_of_kin_name`, `nk_phone`, `nk_postal_address`, `nk_email`, `investor_signature`, `ceo`, `comp_name`, `nature_biz`, `reg_numb`, `inv_freq`, `date_incorp`, `contact_person`, `position`, `institution_type_id`, `gross_revenue_id`, `contact_mode`, `acc_name`, `bank_id`, `bank_branch`, `acc_number`, `created`, `modified`, `approved`, `visible`) VALUES
(2, 2, 'Qwick Fusion', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-17', NULL, NULL, NULL, NULL, 'Qwickfusion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Single', NULL, NULL, '', '0243080560', 'wahid@qwickfusion.com', 'P. O. Box OS 729,Osu-Accra', NULL, NULL, NULL, NULL, NULL, NULL, 'Kwaku Afreh-Nuamah', 'Qwickfusion', 'ICT', '11111111', NULL, '2014-01-02', 'Wahid Abdul Sulley', 'Application Support', 3, 2, 'Email', 'Qwickfusion', 27, '', '', '2015-07-17 12:16:39', '2015-07-17 12:19:54', 1, 'alive'),
(3, 1, 'Qwick Fusion', NULL, 2, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2015-08-04', NULL, NULL, '66', '66', '66 66', '1970-01-01', 1, '66', '66', '', '', '', '', 'Single', '', '', '', '66', '', '66', 1, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '2015-08-04 11:22:29', '2015-08-04 11:22:29', 0, 'alive'),
(4, 1, 'Qwick Fusion', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-08-11', NULL, NULL, NULL, NULL, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Single', NULL, NULL, 'test', 'test', 'test@me.com', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'test', '', 'test', NULL, '2014-01-02', 'test', '', 1, 1, '', '', NULL, '', '', '2015-08-11 11:32:29', '2015-08-11 11:32:29', 0, 'alive'),
(5, 1, 'Qwick Fusion', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-08-11', NULL, NULL, NULL, NULL, 'test4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Single', NULL, NULL, '', 'test4', 'test4@me.com', 'test4', NULL, NULL, NULL, NULL, NULL, NULL, 'test4', 'test4', 'test4', 'test4', NULL, '2014-03-02', 'test4', '', 1, 1, '', '', NULL, '', '', '2015-08-11 11:42:06', '2015-08-11 11:42:06', 0, 'alive'),
(6, 1, 'Qwick Fusion', NULL, 4, NULL, NULL, NULL, NULL, 'test6', NULL, NULL, 'test6', 'test6', '2010-08-11', NULL, 'test6', '2014-02-01', NULL, 'test6', '', '', '', '2015-08-11', NULL, NULL, 'test6', 'test6', 'test6 test6', '2015-03-02', 2, 'test6', 'test6', '', '', '', '', 'Single', '', NULL, '', 'test6', '', 'test6', 1, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '2015-08-11 11:43:19', '2015-08-17 17:06:58', 1, 'alive');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_id` int(11) DEFAULT NULL,
  `item` varchar(200) NOT NULL,
  `serialno` varchar(70) DEFAULT NULL,
  `supply_invoiceno` varchar(70) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modelno` varchar(200) DEFAULT NULL,
  `item_item` varchar(200) DEFAULT NULL,
  `item_type` varchar(11) DEFAULT NULL,
  `description` varchar(20) DEFAULT NULL,
  `brand` varchar(30) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `original_quantity` int(11) NOT NULL DEFAULT '0',
  `remaining_quantity` int(11) NOT NULL DEFAULT '0',
  `delete_status` enum('deleted','alive') DEFAULT 'alive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_transactions`
--

CREATE TABLE IF NOT EXISTS `ledger_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_ledger_id` int(11) DEFAULT NULL,
  `cash_receipt_mode_id` int(3) DEFAULT NULL,
  `payment_mode_id` int(3) DEFAULT NULL,
  `investment_id` int(11) DEFAULT NULL,
  `cheque_no` varchar(70) DEFAULT NULL,
  `voucher_no` varchar(25) DEFAULT NULL,
  `debit` decimal(11,2) DEFAULT '0.00',
  `credit` decimal(11,2) DEFAULT '0.00',
  `description` varchar(70) DEFAULT NULL,
  `management_fee` decimal(11,2) DEFAULT '0.00',
  `benchmark` decimal(6,2) DEFAULT '0.00',
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `ledger_transactions`
--

INSERT INTO `ledger_transactions` (`id`, `client_ledger_id`, `cash_receipt_mode_id`, `payment_mode_id`, `investment_id`, `cheque_no`, `voucher_no`, `debit`, `credit`, `description`, `management_fee`, `benchmark`, `user_id`, `date`, `created`, `modified`) VALUES
(1, 2, 1, NULL, 1, '', NULL, '0.00', '1000.00', 'Deposit for investment with receipt no:0817150439173', '0.00', '0.00', 1, '2015-08-17', '2015-08-17 16:39:37', '2015-08-17 16:39:37'),
(2, 2, 1, NULL, 1, '', NULL, '900.00', '0.00', 'Fixed income investment for 91 Day(s)', '0.00', '0.00', 1, '2015-08-17', '2015-08-17 16:39:37', '2015-08-17 16:39:37'),
(3, 2, 1, NULL, 2, '', NULL, '0.00', '100.00', 'Deposit for investment with receipt no:0817150455072', '0.00', '0.00', 1, '2015-08-17', '2015-08-17 16:55:23', '2015-08-17 16:55:23'),
(4, 2, 1, NULL, 2, '', NULL, '150.00', '0.00', 'Fixed income investment for 365 Day(s)', '0.00', '0.00', 1, '2015-08-17', '2015-08-17 16:55:23', '2015-08-17 16:55:23'),
(5, 2, 1, NULL, 1, '', '', '0.00', '100.00', 'â€™Deposit for Topup on PARKST-INV-001', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 19:15:19', '2015-08-23 19:15:19'),
(6, 2, 1, NULL, NULL, '', NULL, '100.00', '0.00', 'Fixed Income Topup on PARKST-INV-001', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 19:15:19', '2015-08-23 19:15:19'),
(7, 2, 1, NULL, 2, '', '0823150745292', '0.00', '100.00', 'â€™Deposit for Topup on PARKST-INV-002', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 19:45:29', '2015-08-23 19:45:29'),
(8, 2, 1, NULL, NULL, '', NULL, '100.00', '0.00', 'Fixed Income Topup on PARKST-INV-002', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 19:45:29', '2015-08-23 19:45:29'),
(9, 2, 1, NULL, 3, '', NULL, '0.00', '100.00', 'Deposit for investment with receipt no:0823150748093', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 19:48:25', '2015-08-23 19:48:25'),
(10, 2, 1, NULL, 3, '', NULL, '100.00', '0.00', 'Fixed income investment for 180 Day(s)', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 19:48:25', '2015-08-23 19:48:25'),
(11, 2, 1, NULL, 4, '', NULL, '0.00', '200.00', 'Deposit for investment with receipt no:0823150805012', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 20:05:14', '2015-08-23 20:05:14'),
(12, 2, 1, NULL, 4, '', NULL, '200.00', '0.00', 'Fixed income investment for 180 Day(s)', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 20:05:14', '2015-08-23 20:05:14'),
(13, 2, NULL, NULL, NULL, NULL, 'PARKST-INV-004', '0.00', '0.00', 'Debit on PARKST-INV-004 for settlement of accrued management fee', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 20:11:13', '2015-08-23 20:11:13'),
(14, 2, NULL, NULL, NULL, NULL, 'PARKST-INV-004', '0.00', '200.00', 'Discounting of PARKST-INV-004', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 20:11:13', '2015-08-23 20:11:13'),
(15, 2, NULL, 2, NULL, NULL, '0823150821554', '200.00', '0.00', 'Payment of Investment Proceeds', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 20:21:55', '2015-08-23 20:21:55'),
(16, 2, NULL, NULL, NULL, NULL, 'PARKST-INV-002', '0.00', '0.00', 'Debit on PARKST-INV-002 for settlement of accrued management fee', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 20:24:55', '2015-08-23 20:24:55'),
(17, 2, NULL, NULL, NULL, NULL, 'PARKST-INV-002', '0.00', '250.74', 'Discounting of PARKST-INV-002', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 20:24:55', '2015-08-23 20:24:55'),
(18, 2, NULL, 2, NULL, 'eere', '0823150837123', '250.74', '0.00', 'Payment of Investment Proceeds', '0.00', '0.00', 1, '2015-08-23', '2015-08-23 20:37:12', '2015-08-23 20:37:12'),
(19, 2, NULL, NULL, NULL, NULL, 'PARKST-INV-003', '0.00', '0.00', 'Debit on PARKST-INV-003 for settlement of accrued management fee', '0.00', '0.00', 1, '2015-08-27', '2015-08-27 11:14:24', '2015-08-27 11:14:24'),
(20, 2, NULL, NULL, NULL, NULL, 'PARKST-INV-003', '0.00', '100.20', 'Discounting of PARKST-INV-003', '0.00', '0.00', 1, '2015-08-27', '2015-08-27 11:14:24', '2015-08-27 11:14:24'),
(21, 2, NULL, 1, NULL, NULL, '0827151114474', '100.00', '0.00', 'Payment of Investment Proceeds', '0.00', '0.00', 1, '2015-08-27', '2015-08-27 11:14:47', '2015-08-27 11:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `loan_expectedpayments`
--

CREATE TABLE IF NOT EXISTS `loan_expectedpayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) DEFAULT NULL,
  `cash_account_id` int(11) DEFAULT NULL,
  `principal_due` decimal(11,2) NOT NULL DEFAULT '0.00',
  `interest_due` decimal(11,2) NOT NULL DEFAULT '0.00',
  `amount_due` decimal(11,2) NOT NULL DEFAULT '0.00',
  `principal_paid` decimal(11,2) NOT NULL DEFAULT '0.00',
  `interest_paid` decimal(11,2) DEFAULT '0.00',
  `amount_paid` decimal(11,2) NOT NULL DEFAULT '0.00',
  `principal_balance` decimal(11,2) NOT NULL DEFAULT '0.00',
  `interest_balance` decimal(11,2) NOT NULL DEFAULT '0.00',
  `amount_balance` decimal(11,2) NOT NULL DEFAULT '0.00',
  `payment_status` enum('no_payment','part_payment','full_payment') DEFAULT 'no_payment',
  `due_date` date DEFAULT NULL,
  `previous_payment` int(11) NOT NULL,
  `loanpayment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loanpayments`
--

CREATE TABLE IF NOT EXISTS `loanpayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cash_account_id` int(11) DEFAULT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `interest` decimal(11,2) DEFAULT '0.00',
  `principal` decimal(11,2) DEFAULT '0.00',
  `payment_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cash_account_id` int(11) NOT NULL,
  `loan_name` varchar(70) DEFAULT NULL,
  `principal` decimal(11,2) DEFAULT '0.00',
  `interest` decimal(11,2) DEFAULT '0.00',
  `amount_balance` decimal(11,2) DEFAULT '0.00',
  `principal_paid` decimal(11,2) DEFAULT '0.00',
  `interest_paid` decimal(11,2) DEFAULT '0.00',
  `principal_balance` decimal(11,2) DEFAULT '0.00',
  `interest_balance` decimal(11,2) DEFAULT '0.00',
  `totalpayment` decimal(11,2) DEFAULT '0.00',
  `schedule_type` varchar(30) DEFAULT NULL,
  `schedule_duration` int(5) DEFAULT NULL,
  `first_payment` date DEFAULT NULL,
  `expected_finish` date DEFAULT NULL,
  `actual_finish` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `management_fees`
--

CREATE TABLE IF NOT EXISTS `management_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_id` int(11) DEFAULT NULL,
  `base_fee` decimal(11,2) DEFAULT '0.00',
  `accrued_fee` decimal(11,2) DEFAULT '0.00',
  `fee_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modifeid` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `marriages`
--

CREATE TABLE IF NOT EXISTS `marriages` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `marital_status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `marriages`
--

INSERT INTO `marriages` (`id`, `marital_status`) VALUES
(1, '-Select-'),
(2, 'Single'),
(3, 'Married'),
(4, 'Widowed'),
(5, 'Divorced');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(30) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `created`) VALUES
(1, 'Investors', '2014-11-26 00:00:00'),
(2, 'Inbound Investmt', '2014-11-26 00:00:00'),
(3, 'Outbound Investmt', '2014-11-26 00:00:00'),
(4, 'Payments', '2014-11-26 00:00:00'),
(5, 'Comp Accounts', '2014-11-26 00:00:00'),
(6, 'Reports', '2014-11-26 00:00:00'),
(7, 'Settings', '2014-11-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_modes`
--

CREATE TABLE IF NOT EXISTS `payment_modes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `payment_mode_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `payment_modes`
--

INSERT INTO `payment_modes` (`id`, `payment_mode_name`) VALUES
(1, 'Cash'),
(2, 'Cheque'),
(3, 'Bank transfer'),
(4, 'Post-dated chq'),
(5, 'Standing order'),
(6, 'Visa');

-- --------------------------------------------------------

--
-- Table structure for table `payment_schedules`
--

CREATE TABLE IF NOT EXISTS `payment_schedules` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `payment_schedule_name` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `payment_schedules`
--

INSERT INTO `payment_schedules` (`id`, `payment_schedule_name`) VALUES
(1, 'Monthly'),
(2, 'Quarterly'),
(3, 'Semi-Annually'),
(4, 'Yearly');

-- --------------------------------------------------------

--
-- Table structure for table `payment_terms`
--

CREATE TABLE IF NOT EXISTS `payment_terms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(15) NOT NULL,
  `period_months` int(4) NOT NULL,
  `interest_rate` decimal(3,3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `payment_terms`
--

INSERT INTO `payment_terms` (`id`, `payment_name`, `period_months`, `interest_rate`) VALUES
(1, '3 months', 3, '0.030'),
(2, '4 months', 4, '0.040'),
(3, '5 months', 5, '0.045'),
(4, '6 months', 6, '0.050'),
(5, '7 months', 7, '0.055'),
(6, '--None--', 1, '0.000');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `creditor_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `zone_id` int(2) DEFAULT NULL,
  `expectedpayment_id` int(11) DEFAULT NULL,
  `payment_type` varchar(30) NOT NULL,
  `payment_mode` varchar(20) DEFAULT NULL,
  `amount` decimal(11,2) NOT NULL,
  `deleted_amount` decimal(11,2) DEFAULT '0.00',
  `used_chequenos` varchar(100) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pettycash_deposits`
--

CREATE TABLE IF NOT EXISTS `pettycash_deposits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pettycash_id` int(11) DEFAULT NULL,
  `cash_account_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT '0.00',
  `zone_id` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pettycash_withdrawals`
--

CREATE TABLE IF NOT EXISTS `pettycash_withdrawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pettycash_id` int(11) DEFAULT NULL,
  `cash_account_id` int(11) DEFAULT NULL,
  `zone_id` int(2) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT '0.00',
  `created_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pettycashes`
--

CREATE TABLE IF NOT EXISTS `pettycashes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(11,2) DEFAULT '0.00',
  `balance` decimal(11,2) DEFAULT '0.00',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `zone_id` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE IF NOT EXISTS `portfolios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(15) NOT NULL,
  `period_months` int(4) NOT NULL,
  `interest_rate` decimal(3,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `payment_name`, `period_months`, `interest_rate`) VALUES
(33, '--None--', 1, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(15) NOT NULL,
  `period_months` int(4) NOT NULL,
  `interest_rate` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `payment_name`, `period_months`, `interest_rate`) VALUES
(19, '1 month', 1, 8),
(21, '2 months', 2, 13),
(22, '3 months', 3, 18),
(23, '4 months', 4, 24),
(25, '6 months', 6, 34),
(26, '7 months', 7, 41),
(27, '8 months', 8, 48),
(28, '9 months', 9, 54),
(29, '10 months', 10, 62),
(30, '11 months', 11, 69),
(31, '12 months', 12, 77),
(32, '5 months', 5, 29),
(33, '--None--', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reinvest_interest_accruals`
--

CREATE TABLE IF NOT EXISTS `reinvest_interest_accruals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reinvestor_id` int(11) DEFAULT NULL,
  `reinvestment_id` int(11) DEFAULT NULL,
  `interest_amounts` decimal(11,2) DEFAULT '0.00',
  `interest_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `reinvest_interest_accruals`
--

INSERT INTO `reinvest_interest_accruals` (`id`, `reinvestor_id`, `reinvestment_id`, `interest_amounts`, `interest_date`, `created`, `modified`) VALUES
(1, 1, 1, '2.55', '2015-07-27', '2015-08-27 10:19:02', '2015-08-27 10:19:02'),
(2, 1, 1, '0.00', '2015-08-27', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(3, 1, 2, '2.55', '2015-07-27', '2015-08-27 10:49:57', '2015-08-27 10:49:57'),
(4, 1, 2, '0.00', '2015-08-27', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(5, 1, 3, '0.00', '2015-08-27', '2015-08-27 10:56:02', '2015-08-27 10:56:02'),
(6, 1, 3, '0.00', '2015-08-27', '2015-08-27 10:59:25', '2015-08-27 10:59:25'),
(7, 1, 2, '0.00', '2015-08-27', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(8, 1, 1, '0.00', '2015-08-27', '2015-08-27 11:13:49', '2015-08-27 11:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `reinvestment_rollovers`
--

CREATE TABLE IF NOT EXISTS `reinvestment_rollovers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reinvestment_id` int(11) DEFAULT NULL,
  `reinvestor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT '0.00',
  `old_interest_rate` decimal(6,2) DEFAULT '0.00',
  `old_accrued_interest` decimal(11,2) DEFAULT '0.00',
  `interest_rate` decimal(6,2) DEFAULT '0.00',
  `created` datetime NOT NULL,
  `rollover_date` date DEFAULT NULL,
  `delete_status` enum('dead','alive') DEFAULT 'alive',
  `deleted_by` varchar(200) DEFAULT NULL,
  `edit_details_username_oldnnewamout` varchar(200) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `reinvestment_rollovers`
--

INSERT INTO `reinvestment_rollovers` (`id`, `reinvestment_id`, `reinvestor_id`, `user_id`, `amount`, `old_interest_rate`, `old_accrued_interest`, `interest_rate`, `created`, `rollover_date`, `delete_status`, `deleted_by`, `edit_details_username_oldnnewamout`, `modified`) VALUES
(1, 1, 1, 1, '2.55', '30.00', '2.55', '30.00', '2015-08-27 10:21:38', '2015-09-27', 'alive', NULL, NULL, '2015-08-27 10:21:38'),
(2, 2, 1, 1, '2.55', '30.00', '2.55', '30.00', '2015-08-27 10:53:52', '2015-09-27', 'alive', NULL, NULL, '2015-08-27 10:53:52'),
(3, 3, 1, 1, '30.00', '30.00', '0.00', '30.00', '2015-08-27 10:59:25', '2015-08-26', 'alive', NULL, NULL, '2015-08-27 10:59:25'),
(4, 2, 1, 1, '0.06', '30.00', '0.00', '30.00', '2015-08-27 11:09:05', '2015-09-27', 'alive', NULL, NULL, '2015-08-27 11:09:05'),
(5, 1, 1, 1, '0.06', '30.00', '0.00', '30.00', '2015-08-27 11:13:49', '2015-09-27', 'alive', NULL, NULL, '2015-08-27 11:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `reinvestment_statements`
--

CREATE TABLE IF NOT EXISTS `reinvestment_statements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reinvestment_id` int(11) DEFAULT NULL,
  `reinvestor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `principal` decimal(11,2) DEFAULT '0.00',
  `interest` decimal(11,2) DEFAULT '0.00',
  `total` decimal(11,2) DEFAULT '0.00',
  `maturity_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=126 ;

--
-- Dumping data for table `reinvestment_statements`
--

INSERT INTO `reinvestment_statements` (`id`, `reinvestment_id`, `reinvestor_id`, `user_id`, `principal`, `interest`, `total`, `maturity_date`, `created`, `modified`) VALUES
(1, 1, 1, 1, '2.55', '0.00', '2.55', '2015-08-28', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(2, 1, 1, 1, '2.55', '0.00', '2.55', '2015-08-29', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(3, 1, 1, 1, '2.55', '0.00', '2.55', '2015-08-30', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(4, 1, 1, 1, '2.55', '0.00', '2.55', '2015-08-31', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(5, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-01', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(6, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-02', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(7, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-03', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(8, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-04', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(9, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-05', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(10, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-06', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(11, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-07', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(12, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-08', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(13, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-09', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(14, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-10', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(15, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-11', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(16, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-12', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(17, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-13', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(18, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-14', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(19, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-15', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(20, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-16', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(21, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-17', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(22, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-18', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(23, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-19', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(24, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-20', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(25, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-21', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(26, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-22', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(27, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-23', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(28, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-24', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(29, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-25', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(30, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-26', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(31, 1, 1, 1, '2.55', '0.00', '2.55', '2015-09-27', '2015-08-27 10:21:38', '2015-08-27 10:21:38'),
(32, 2, 1, 1, '2.55', '0.00', '2.55', '2015-08-28', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(33, 2, 1, 1, '2.55', '0.00', '2.55', '2015-08-29', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(34, 2, 1, 1, '2.55', '0.00', '2.55', '2015-08-30', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(35, 2, 1, 1, '2.55', '0.00', '2.55', '2015-08-31', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(36, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-01', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(37, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-02', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(38, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-03', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(39, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-04', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(40, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-05', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(41, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-06', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(42, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-07', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(43, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-08', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(44, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-09', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(45, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-10', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(46, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-11', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(47, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-12', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(48, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-13', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(49, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-14', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(50, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-15', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(51, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-16', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(52, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-17', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(53, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-18', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(54, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-19', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(55, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-20', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(56, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-21', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(57, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-22', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(58, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-23', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(59, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-24', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(60, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-25', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(61, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-26', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(62, 2, 1, 1, '2.55', '0.00', '2.55', '2015-09-27', '2015-08-27 10:53:52', '2015-08-27 10:53:52'),
(63, NULL, NULL, NULL, '0.00', '0.00', '0.00', NULL, '2015-08-27 10:59:25', '2015-08-27 10:59:25'),
(64, 2, 1, 1, '0.06', '0.00', '0.06', '2015-08-28', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(65, 2, 1, 1, '0.06', '0.00', '0.06', '2015-08-29', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(66, 2, 1, 1, '0.06', '0.00', '0.06', '2015-08-30', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(67, 2, 1, 1, '0.06', '0.00', '0.06', '2015-08-31', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(68, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-01', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(69, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-02', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(70, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-03', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(71, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-04', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(72, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-05', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(73, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-06', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(74, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-07', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(75, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-08', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(76, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-09', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(77, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-10', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(78, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-11', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(79, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-12', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(80, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-13', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(81, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-14', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(82, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-15', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(83, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-16', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(84, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-17', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(85, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-18', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(86, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-19', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(87, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-20', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(88, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-21', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(89, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-22', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(90, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-23', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(91, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-24', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(92, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-25', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(93, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-26', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(94, 2, 1, 1, '0.06', '0.00', '0.06', '2015-09-27', '2015-08-27 11:09:05', '2015-08-27 11:09:05'),
(95, 1, 1, 1, '0.06', '0.00', '0.06', '2015-08-28', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(96, 1, 1, 1, '0.06', '0.00', '0.06', '2015-08-29', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(97, 1, 1, 1, '0.06', '0.00', '0.06', '2015-08-30', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(98, 1, 1, 1, '0.06', '0.00', '0.06', '2015-08-31', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(99, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-01', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(100, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-02', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(101, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-03', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(102, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-04', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(103, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-05', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(104, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-06', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(105, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-07', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(106, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-08', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(107, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-09', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(108, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-10', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(109, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-11', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(110, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-12', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(111, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-13', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(112, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-14', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(113, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-15', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(114, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-16', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(115, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-17', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(116, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-18', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(117, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-19', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(118, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-20', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(119, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-21', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(120, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-22', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(121, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-23', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(122, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-24', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(123, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-25', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(124, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-26', '2015-08-27 11:13:49', '2015-08-27 11:13:49'),
(125, 1, 1, 1, '0.06', '0.00', '0.06', '2015-09-27', '2015-08-27 11:13:49', '2015-08-27 11:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `reinvestment_topups`
--

CREATE TABLE IF NOT EXISTS `reinvestment_topups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `reinvestment_id` int(11) DEFAULT NULL,
  `payment_mode_id` int(3) DEFAULT NULL,
  `topup_amount` decimal(11,2) DEFAULT NULL,
  `topup_interest` decimal(11,2) DEFAULT '0.00',
  `topup_tenure` int(4) DEFAULT '0',
  `topup_period` varchar(10) DEFAULT NULL,
  `old_investmentamt` decimal(11,2) DEFAULT NULL,
  `oldinterest_earned` decimal(11,2) DEFAULT NULL,
  `oldtotal_amount_earned` decimal(11,2) DEFAULT NULL,
  `oldearned_balance` decimal(11,2) DEFAULT NULL,
  `oldamount_due` decimal(11,2) DEFAULT NULL,
  `investment_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reinvestments`
--

CREATE TABLE IF NOT EXISTS `reinvestments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_no` varchar(20) DEFAULT NULL,
  `reinvestor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `investment_type` enum('fixed','equity') DEFAULT 'fixed',
  `currency_id` int(11) DEFAULT NULL,
  `investment_cash_id` int(11) DEFAULT NULL,
  `equities_list_id` int(11) DEFAULT NULL,
  `investment_amount` decimal(11,2) DEFAULT '0.00',
  `inv_dest_product_id` int(11) DEFAULT NULL,
  `investment_destination_id` int(11) DEFAULT NULL,
  `duration` int(6) DEFAULT NULL,
  `investment_period` varchar(10) DEFAULT NULL,
  `interest_rate` decimal(6,2) DEFAULT '0.00',
  `penalty` decimal(6,2) DEFAULT '0.00',
  `amount_due` decimal(11,2) DEFAULT '0.00',
  `total_amount_earned` decimal(11,2) DEFAULT '0.00',
  `amount_paidout` decimal(11,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(11,2) NOT NULL DEFAULT '0.00',
  `earned_balance` decimal(11,2) DEFAULT '0.00',
  `interest_earned` decimal(11,2) DEFAULT '0.00',
  `expected_interest` decimal(11,2) DEFAULT '0.00',
  `investment_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `lastpaidout_date` date DEFAULT NULL,
  `accrued_days` int(4) DEFAULT '0',
  `accrued_interest` decimal(11,2) DEFAULT NULL,
  `details` varchar(200) DEFAULT NULL,
  `status` enum('Paid','Rolled_over','Cancelled','Part_payment','Invested','Termination_Requested','Payment_Requested','Terminated','Payment_Processed','Matured') DEFAULT 'Invested',
  `old_status` enum('Paid','Rolled_over','Cancelled','Part_payment','Invested','Termination_Requested','Payment_Requested','Terminated','Payment_Processed','Matured') DEFAULT NULL,
  `payment_status` enum('paid','unpaid','part_payment') DEFAULT 'unpaid',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `reinvestments`
--

INSERT INTO `reinvestments` (`id`, `investment_no`, `reinvestor_id`, `user_id`, `investment_type`, `currency_id`, `investment_cash_id`, `equities_list_id`, `investment_amount`, `inv_dest_product_id`, `investment_destination_id`, `duration`, `investment_period`, `interest_rate`, `penalty`, `amount_due`, `total_amount_earned`, `amount_paidout`, `balance`, `earned_balance`, `interest_earned`, `expected_interest`, `investment_date`, `due_date`, `lastpaidout_date`, `accrued_days`, `accrued_interest`, `details`, `status`, `old_status`, `payment_status`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, NULL, 1, 1, 'fixed', 1, NULL, NULL, '0.06', 4, 1, 31, 'Day(s)', '30.00', '0.00', '0.06', '0.06', '0.00', '0.06', '0.06', '0.06', '0.00', '2015-07-27', '2015-09-27', NULL, 31, '0.00', NULL, 'Rolled_over', NULL, 'part_payment', '2015-08-27 10:19:02', '2015-08-27 11:13:49', 1, 1),
(2, NULL, 1, 1, 'fixed', 1, NULL, NULL, '0.06', 4, 1, 31, 'Day(s)', '30.00', '0.00', '0.06', '0.06', '0.00', '0.06', '0.06', '0.06', '0.00', '2015-07-27', '2015-09-27', NULL, 31, '0.00', NULL, 'Rolled_over', NULL, 'part_payment', '2015-08-27 10:49:56', '2015-08-27 11:09:05', 1, 1),
(3, NULL, 1, 1, 'fixed', 1, NULL, NULL, '30.00', 5, 2, 0, 'Year(s)', '30.00', '0.00', '30.00', '0.00', '0.00', '30.00', '0.00', '0.00', '0.00', '2015-08-27', '2015-08-26', NULL, 0, '0.00', NULL, 'Terminated', NULL, 'paid', '2015-08-27 10:56:02', '2015-08-27 11:09:42', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reinvestments_equities`
--

CREATE TABLE IF NOT EXISTS `reinvestments_equities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_no` varchar(20) DEFAULT NULL,
  `reinvestor_id` int(11) DEFAULT NULL,
  `investor_id` int(11) NOT NULL,
  `investment_cash_id` int(11) DEFAULT NULL,
  `investment_type` enum('fixed','equity') DEFAULT 'equity',
  `currency_id` int(11) DEFAULT NULL,
  `investment_amount` decimal(11,2) DEFAULT '0.00',
  `total_amount` decimal(11,2) DEFAULT NULL,
  `equities_list_id` int(11) DEFAULT NULL,
  `purchase_price` decimal(6,2) DEFAULT '0.00',
  `total_fees` decimal(11,2) DEFAULT '0.00',
  `other_fees` decimal(11,2) DEFAULT '0.00',
  `numb_shares` int(11) DEFAULT NULL,
  `numb_shares_sold` int(11) DEFAULT '0',
  `numb_shares_left` int(11) DEFAULT '0',
  `investment_date` date DEFAULT NULL,
  `reinvestment_date` date DEFAULT NULL,
  `lastpaidout_date` date DEFAULT NULL,
  `details` varchar(200) DEFAULT NULL,
  `status` enum('Paid','Rolled_over','Cancelled','Part_payment','Invested') DEFAULT 'Invested',
  `old_status` enum('Paid','Rolled_over','Cancelled','Part_payment','Invested') DEFAULT NULL,
  `payment_status` enum('paid','unpaid') DEFAULT 'unpaid',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reinvestor_cashaccounts`
--

CREATE TABLE IF NOT EXISTS `reinvestor_cashaccounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reinvestor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fixed_inv_amount` decimal(11,2) DEFAULT '0.00',
  `equity_inv_amount` decimal(11,2) DEFAULT '0.00',
  `equity_inv_balance` decimal(11,2) DEFAULT '0.00',
  `fixed_inv_balance` decimal(11,2) DEFAULT '0.00',
  `total_balance` decimal(11,2) DEFAULT '0.00',
  `equity_amount_paidout` decimal(11,2) DEFAULT NULL,
  `fixed_amount_paidout` decimal(11,2) DEFAULT '0.00',
  `fixed_inv_returns` decimal(11,2) DEFAULT '0.00',
  `equity_inv_returns` decimal(11,2) DEFAULT '0.00',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `reinvestor_cashaccounts`
--

INSERT INTO `reinvestor_cashaccounts` (`id`, `reinvestor_id`, `user_id`, `fixed_inv_amount`, `equity_inv_amount`, `equity_inv_balance`, `fixed_inv_balance`, `total_balance`, `equity_amount_paidout`, `fixed_amount_paidout`, `fixed_inv_returns`, `equity_inv_returns`, `created`, `modified`, `notes`) VALUES
(6, 1, NULL, '2100.00', '0.00', '0.00', '1730.00', '1730.00', NULL, '0.00', '335.10', '0.00', '2015-02-10 14:24:28', '2015-08-27 11:09:42', NULL),
(7, 3, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '2015-02-10 14:24:28', '2015-02-10 14:24:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reinvestor_deposits`
--

CREATE TABLE IF NOT EXISTS `reinvestor_deposits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reinvestor_id` int(11) DEFAULT NULL,
  `investment_product_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `payment_mode_id` int(11) DEFAULT NULL,
  `investment_date` datetime DEFAULT NULL,
  `fixed_inv_amount` decimal(11,2) DEFAULT '0.00',
  `equity_inv_amount` decimal(11,2) DEFAULT '0.00',
  `equity_inv_balance` decimal(11,2) DEFAULT '0.00',
  `fixed_inv_balance` decimal(11,2) DEFAULT '0.00',
  `notes` text,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reinvestor_equities`
--

CREATE TABLE IF NOT EXISTS `reinvestor_equities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reinvestment_id` int(11) DEFAULT NULL,
  `equities_list_id` int(11) DEFAULT NULL,
  `numb_shares` int(11) DEFAULT NULL,
  `purchase_price` decimal(6,2) DEFAULT NULL,
  `min_share_price` decimal(6,2) DEFAULT NULL,
  `max_share_price` decimal(6,2) DEFAULT NULL,
  `numb_shares_sold` int(11) DEFAULT NULL,
  `numb_shares_left` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reinvestors`
--

CREATE TABLE IF NOT EXISTS `reinvestors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `manager_name` varchar(100) DEFAULT NULL,
  `location` varchar(50) NOT NULL,
  `postal_address` varchar(100) NOT NULL,
  `postal_town_suburb` varchar(50) NOT NULL,
  `postal_city` varchar(20) NOT NULL,
  `postal_country` varchar(25) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `mobile` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `accounting_month` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `reinvestors`
--

INSERT INTO `reinvestors` (`id`, `currency_id`, `company_name`, `manager_name`, `location`, `postal_address`, `postal_town_suburb`, `postal_city`, `postal_country`, `telephone`, `mobile`, `email`, `accounting_month`) VALUES
(1, 1, 'Parkstone Capital Limited', 'Elsie', 'Accra', ' P.O. Box CS 9161', 'Adjirigano', 'Accra', 'Ghana', '0202088130', '0244327219', 'info@parkstonecapital.com', '2012-10-30'),
(2, 0, 'Qwickfusion', 'Malik Abdul Sulley', 'East Legon', 'P.O. Box OS 729', 'Osu', 'Accra', 'Ghana', '0243080560', '0243080560', 'info@qwickfusion.net', NULL),
(3, 0, 'GCNet', 'Arwin Mustapha', '5th Avenue, Cantonments', 'PMB CT890', '', 'Accra', 'Ghana', '0302-67830', '0243050660', 'info@gcnetghana.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repossessions`
--

CREATE TABLE IF NOT EXISTS `repossessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `orders_item_id` int(11) DEFAULT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `item_condition` varchar(20) DEFAULT NULL,
  `reimbursement` decimal(11,2) DEFAULT '0.00',
  `depreciation` int(3) DEFAULT NULL,
  `reposs_reason` varchar(40) DEFAULT NULL,
  `other_remarks` varchar(255) DEFAULT NULL,
  `reposs_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rollovers`
--

CREATE TABLE IF NOT EXISTS `rollovers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_id` int(11) DEFAULT NULL,
  `investor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `old_investment_amount` decimal(11,2) DEFAULT '0.00',
  `old_interest_accrued` decimal(11,2) DEFAULT '0.00',
  `custom_rate` decimal(6,2) DEFAULT '0.00',
  `old_custom_rate` decimal(6,2) DEFAULT '0.00',
  `created` datetime NOT NULL,
  `rollover_date` date DEFAULT NULL,
  `delete_status` enum('dead','alive') DEFAULT 'alive',
  `deleted_by` varchar(200) DEFAULT NULL,
  `edit_details_username_oldnnewamout` varchar(200) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `owner_name` varchar(100) DEFAULT NULL,
  `location` varchar(50) NOT NULL,
  `postal_address` varchar(100) NOT NULL,
  `postal_town_suburb` varchar(50) NOT NULL,
  `postal_city` varchar(20) NOT NULL,
  `postal_country` varchar(25) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `mobile` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `penalty` int(11) DEFAULT '0',
  `accounting_month` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `currency_id`, `company_name`, `owner_name`, `location`, `postal_address`, `postal_town_suburb`, `postal_city`, `postal_country`, `telephone`, `mobile`, `email`, `penalty`, `accounting_month`) VALUES
(1, 3, 'PARKSTONE CAPITAL LIMITED', 'Elsie', 'Accra', ' P.O. Box CS 9161', 'Adjirigano', 'Accra', 'Ghana', '0202088130', '0244327219', 'info@parkstonecapital.com', 0, '2012-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `stated_bank_balances`
--

CREATE TABLE IF NOT EXISTS `stated_bank_balances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `statement_date` date DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT '0.00',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `stated_bank_balances`
--

INSERT INTO `stated_bank_balances` (`id`, `bank_id`, `account_id`, `statement_date`, `amount`, `created`, `modified`, `user`) VALUES
(31, NULL, 3, '2015-06-03', '10000.00', '2015-06-03 06:27:13', '2015-06-03 06:27:13', 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `subsidiaries`
--

CREATE TABLE IF NOT EXISTS `subsidiaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `manager_name` varchar(100) DEFAULT NULL,
  `location` varchar(50) NOT NULL,
  `postal_address` varchar(100) NOT NULL,
  `postal_town_suburb` varchar(50) NOT NULL,
  `postal_city` varchar(20) NOT NULL,
  `postal_country` varchar(25) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `mobile` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `accounting_month` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplierinvoices`
--

CREATE TABLE IF NOT EXISTS `supplierinvoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supply_date` date DEFAULT NULL,
  `supply_invoiceno` varchar(70) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `cost_price` decimal(11,2) DEFAULT '0.00',
  `amountpaid` decimal(11,2) DEFAULT '0.00',
  `balance` decimal(11,2) DEFAULT '0.00',
  `payment_mode` varchar(15) DEFAULT NULL,
  `payment_status` enum('no_payment','part_payment','full_payment','expired') DEFAULT 'no_payment',
  `cheque_nos` varchar(400) DEFAULT NULL,
  `used_chequenos` varchar(400) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_disb_date` date DEFAULT NULL,
  `first_date` date DEFAULT NULL,
  `payment_finish_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplieritems`
--

CREATE TABLE IF NOT EXISTS `supplieritems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `serialno` varchar(70) DEFAULT NULL,
  `supply_invoiceno` varchar(70) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `original_quantity` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_address` varchar(100) DEFAULT NULL,
  `supplier_tel` varchar(50) NOT NULL,
  `supplier_email` varchar(30) DEFAULT NULL,
  `bank1_name` varchar(100) DEFAULT '',
  `bank1_branch` varchar(50) DEFAULT '',
  `bank1_acc_no` varchar(50) DEFAULT '',
  `bank2_name` varchar(100) DEFAULT '',
  `bank2_branch` varchar(50) DEFAULT '',
  `bank2_acc_no` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `supplier_name` (`supplier_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supply_payments`
--

CREATE TABLE IF NOT EXISTS `supply_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplierinvoice_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_type` varchar(30) NOT NULL,
  `payment_mode` varchar(20) DEFAULT NULL,
  `amount` decimal(11,2) NOT NULL,
  `used_chequenos` varchar(100) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sysaudits`
--

CREATE TABLE IF NOT EXISTS `sysaudits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `AUDITTYPE` varchar(30) DEFAULT NULL,
  `AUDITDATE` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `EVENT` varchar(150) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE IF NOT EXISTS `taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(100) NOT NULL,
  `tax_rate` decimal(11,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tempcash_accounts`
--

CREATE TABLE IF NOT EXISTS `tempcash_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `zone_id` int(2) DEFAULT NULL,
  `expense_type` int(1) NOT NULL,
  `expense_desc` varchar(27) DEFAULT NULL,
  `expense_date` date NOT NULL,
  `source` varchar(15) DEFAULT NULL,
  `amount` decimal(11,2) NOT NULL,
  `prepared_by` varchar(50) DEFAULT NULL,
  `paid_to` varchar(70) DEFAULT NULL,
  `remarks` text NOT NULL,
  `status` enum('Approved','Rejected','Pending') DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  KEY `expense_name` (`category_id`,`expense_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `topups`
--

CREATE TABLE IF NOT EXISTS `topups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `investment_id` int(11) DEFAULT NULL,
  `cash_receipt_mode_id` int(3) DEFAULT NULL,
  `topup_amount` decimal(11,2) DEFAULT NULL,
  `tenure` int(4) DEFAULT '0',
  `period` varchar(10) DEFAULT NULL,
  `topup_interest` decimal(11,2) DEFAULT '0.00',
  `old_investmentamt` decimal(11,2) DEFAULT NULL,
  `oldinterest_earned` decimal(11,2) DEFAULT NULL,
  `oldtotal_amount_earned` decimal(11,2) DEFAULT NULL,
  `oldearned_balance` decimal(11,2) DEFAULT NULL,
  `oldamount_due` decimal(11,2) DEFAULT NULL,
  `investment_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `topups`
--

INSERT INTO `topups` (`id`, `user_id`, `investment_id`, `cash_receipt_mode_id`, `topup_amount`, `tenure`, `period`, `topup_interest`, `old_investmentamt`, `oldinterest_earned`, `oldtotal_amount_earned`, `oldearned_balance`, `oldamount_due`, `investment_date`, `created`, `modified`) VALUES
(1, 1, 1, 1, '100.00', 85, 'Day(s)', '5.36', '900.00', '0.00', '901.14', '901.14', '951.61', '2015-08-23', '2015-08-23 19:15:19', '2015-08-23 19:15:19'),
(2, 1, 2, 1, '100.00', 359, 'Day(s)', '22.62', '150.00', '0.00', '150.18', '150.18', '184.50', '2015-08-23', '2015-08-23 19:45:29', '2015-08-23 19:45:29');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_categories`
--

CREATE TABLE IF NOT EXISTS `transaction_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `head_id` int(11) DEFAULT NULL,
  `category_name` varchar(35) DEFAULT NULL,
  `system` int(1) DEFAULT '0',
  `delete` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `transaction_categories`
--

INSERT INTO `transaction_categories` (`id`, `head_id`, `category_name`, `system`, `delete`) VALUES
(22, 2, 'Bank & Credit Card Fees', 1, 0),
(23, 2, 'Water Bill', 1, 0),
(24, 2, 'Cash Withdrawal or Transfer', 1, 0),
(26, 2, 'Electricity Bill', 1, 0),
(27, 2, 'Internet Fees', 1, 0),
(32, 2, 'Entertainment', 1, 0),
(33, 2, 'Medical Costs', 1, 0),
(34, 2, 'Furniture & Electronics', 1, 0),
(35, 2, 'Maintenance Work', 1, 0),
(36, 2, 'Telephone Bill or Credit', 1, 0),
(37, 2, 'Insurance - Health', 1, 0),
(38, 2, 'Insurance - Property', 1, 0),
(39, 2, 'Insurance - Vehicles', 1, 0),
(40, 2, 'Insurance - Life & Disability', 1, 0),
(41, 2, 'Mobile Phone Bill or Credit', 1, 0),
(42, 2, 'Rent', 1, 0),
(44, 2, 'Vehicle - Repairs & Maintenance', 1, 0),
(45, 2, 'Vehicle - Fuel', 1, 0),
(46, 2, 'Travel - Ticket/Airfare', 1, 0),
(47, 2, 'Travel - Allowances', 1, 0),
(48, 2, 'Other Transportation', 1, 0),
(49, 2, 'Uncagetorized Expense', 1, 0),
(50, 2, 'Salaries', 1, 0),
(51, 2, 'Subscriptions', 1, 0),
(52, 2, 'Donations & Gifts', 1, 0),
(53, 2, 'Office Consumables', 1, 0),
(54, 2, 'Prof. Services - Legal', 1, 0),
(55, 2, 'Prof. Services - Accounting', 1, 0),
(56, 2, 'Taxes & Licenses', 1, 0),
(57, 2, 'Postage, Shipping or Couriers', 1, 0),
(58, 2, 'Education & Training', 1, 0),
(59, 2, 'Advertising', 1, 0),
(60, 2, 'Insurance - Accident', 1, 0),
(61, 1, 'Sales', 1, 0),
(62, 1, 'Returns on Investment', 1, 0),
(63, 2, 'Investment', 1, 0),
(64, 2, 'Travel - Transport & Transit', 1, 0),
(65, 2, 'Insurance - Travel', 1, 0),
(66, 2, 'Travel - Hotel/Lodging', 1, 0),
(67, 3, 'Retained Earnings', 1, 0),
(68, 3, 'Owner Equity', 1, 0),
(70, 1, 'Uncategorized Income', 1, 0),
(71, 2, 'Mortgage', 1, 0),
(73, 1, 'Asset Disposal', 1, 0),
(74, 5, 'Bank Loan', 1, 0),
(75, 4, 'Accounts receivable', 1, 0),
(76, 4, 'Interest Receivable', 1, 0),
(77, 4, 'Inventory', 1, 0),
(78, 4, 'Prepaid Expenses', 1, 0),
(79, 4, 'Other Current Investments', 1, 0),
(80, 4, 'Investments', 1, 0),
(81, 4, 'Property and Equipment (Long term)', 1, 0),
(82, 4, 'Notes Receivable (Long Term)', 1, 0),
(83, 4, 'Intangibles', 1, 0),
(84, 4, 'Other Assets', 1, 0),
(85, 5, 'Accounts payable', 1, 0),
(86, 5, 'Dividends payable', 1, 0),
(87, 5, 'Accrued expenses payable', 1, 0),
(88, 5, 'Income tax payable', 1, 0),
(89, 5, 'Unearned Franchise fees', 1, 0),
(90, 5, 'Notes Payable (Long term)', 1, 0),
(91, 5, 'Other long term liabilities', 1, 0),
(92, 5, 'Deferred Income Tax', 1, 0),
(93, 5, 'Long-term Debt', 1, 0),
(94, 5, 'Short-term Loans', 1, 0),
(95, 5, 'Accrued Salaries & Wages', 1, 0),
(96, 5, 'VAT+NHIL Payable', 1, 0),
(98, 5, 'Unearned Revenue', 1, 0),
(100, 4, 'Accumulated Depreciation (Less)', 1, 0),
(101, 4, 'Cash Asset', 1, 0),
(102, 4, 'Fixed Asset', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `head_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `paymentmode_id` int(3) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `effect` int(1) DEFAULT NULL COMMENT '0=Decrease, 1=Increase',
  `amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `debit` decimal(11,2) DEFAULT '0.00',
  `credit` decimal(11,2) DEFAULT '0.00',
  `cheque_no` varchar(35) DEFAULT NULL,
  `cheque_cleared` tinyint(1) NOT NULL DEFAULT '0',
  `prepared_by` varchar(50) DEFAULT NULL,
  `paid_to` varchar(70) DEFAULT NULL,
  `remarks` text NOT NULL,
  `random_salt` varchar(20) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `delete` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `expense_name` (`category_id`,`transaction_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_privileges`
--

CREATE TABLE IF NOT EXISTS `user_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usertype_id` int(3) DEFAULT NULL,
  `module_id` int(4) DEFAULT NULL,
  `created_by` varchar(150) DEFAULT NULL,
  `mod_view` int(1) DEFAULT '0',
  `mod_delete` int(1) DEFAULT '0',
  `mod_edit` int(1) DEFAULT '0',
  `mod_create` int(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `user_privileges`
--

INSERT INTO `user_privileges` (`id`, `usertype_id`, `module_id`, `created_by`, `mod_view`, `mod_delete`, `mod_edit`, `mod_create`, `created`, `modified`) VALUES
(1, 1, 1, 'support', 1, 1, 1, 1, NULL, NULL),
(2, 1, 2, 'support', 1, 0, 1, 1, NULL, NULL),
(17, 10, 1, '', NULL, 0, 1, 1, '2014-12-02 17:45:58', '2014-12-02 17:45:58'),
(18, 10, 2, '', NULL, 0, 1, 1, '2014-12-02 17:45:58', '2014-12-02 17:45:58'),
(19, 10, 3, '', NULL, 0, 1, 1, '2014-12-02 17:45:59', '2014-12-02 17:45:59'),
(20, 10, 4, '', NULL, 0, 0, 1, '2014-12-02 17:45:59', '2014-12-02 17:45:59'),
(21, 10, 5, '', 0, 0, 0, 1, '2014-12-02 17:45:59', '2014-12-02 17:45:59'),
(22, 10, 6, '', 0, 0, 0, 0, '2014-12-02 17:45:59', '2014-12-02 17:45:59'),
(23, 10, 7, '', NULL, 0, 0, 1, '2014-12-02 17:45:59', '2014-12-02 17:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `userdepartments`
--

CREATE TABLE IF NOT EXISTS `userdepartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `userdepartments`
--

INSERT INTO `userdepartments` (`id`, `department`) VALUES
(5, 'OPERATIONS DEPARTMENT'),
(6, 'MARKETING DEPARTMENT'),
(8, 'ADMINISTRATION'),
(9, 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userdepartment_id` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `usertype_id` int(11) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userdepartment_id`, `username`, `password`, `firstname`, `lastname`, `usertype_id`, `email`, `date`) VALUES
(1, 3, 'support', 'ccbd43e44efec3dd62688e50cf8f0485', 'Qwick', 'Fusion', 1, NULL, '2013-03-12 00:45:42'),
(2, 5, 'g.onyinah', '15e5c87b18c1289d45bb4a72961b58e8', 'Grace ', 'Opoku Onyinah', 10, 'g.onyinah@parkstonecap.com', '2014-12-05 15:51:45'),
(3, 5, 'sam.essien', '332532dcfaa1cbf61e2a266bd723612c', 'Samuel', 'Essien', 10, '', '2014-12-05 15:53:00'),
(4, 5, 'charles.denu', 'a5410ee37744c574ba5790034ea08f79', 'Charles', 'Denu', 10, 'g.onyinah@parkstonecap.com', '2014-12-05 15:53:36'),
(5, 8, 'e.enninful', 'd41d8cd98f00b204e9800998ecf8427e', 'Elsie', 'Enninful-Adu', 1, '', '2014-12-05 15:54:30'),
(6, 8, 'doris.ohene', 'd41d8cd98f00b204e9800998ecf8427e', 'Doris', 'Ohene-Djan', 10, '', '2014-12-05 15:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE IF NOT EXISTS `usertypes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `usertype` varchar(20) NOT NULL,
  `created_by` varchar(150) DEFAULT NULL,
  `modified_by` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`id`, `usertype`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(1, 'Super Administrator', NULL, NULL, NULL, NULL),
(10, 'Investment Officer', NULL, NULL, '2014-12-02 17:45:58', '2014-12-02 17:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE IF NOT EXISTS `zones` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `zone` varchar(15) NOT NULL,
  `suburb` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `zone`, `suburb`) VALUES
(7, 'ZONE B-1', 'HO'),
(8, 'ZONE B-2', 'HOHOE'),
(9, 'ZONE B-3', 'NKWANTA'),
(10, 'ZONE C-1', 'NKWAKWA'),
(11, 'ZONE C-2', 'KADE'),
(12, 'ZONE D-1', 'TAKORADI'),
(13, 'ZONE A-1', 'ACCRA'),
(14, 'ZONE A-2', 'ACCRA'),
(15, 'ZONE A-3', 'ACCRA'),
(16, 'ZONE A-4', 'ACCRA'),
(17, 'ZONE CHEQUES', 'ACCRA'),
(18, 'test', 'Support_Testing'),
(19, 'ZONE STAFFS', 'ACCRA');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
