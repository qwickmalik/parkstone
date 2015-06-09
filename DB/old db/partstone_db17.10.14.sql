-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2014 at 01:34 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qwickfu1_parkst_inv`
--

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cash_accounts`
--

CREATE TABLE IF NOT EXISTS `cash_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `zone_id` int(2) DEFAULT NULL,
  `expense_type` int(1) NOT NULL,
  `expense_desc` varchar(27) DEFAULT NULL,
  `expense_date` date DEFAULT NULL,
  `deposit_type` int(2) DEFAULT NULL,
  `amount` decimal(11,2) NOT NULL,
  `principal` decimal(11,2) DEFAULT '0.00',
  `scd_type` int(3) DEFAULT '0',
  `ln_months` int(5) DEFAULT '0',
  `prepared_by` varchar(50) DEFAULT NULL,
  `paid_to` varchar(70) DEFAULT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_name` (`expense_id`,`expense_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `client_contact` varchar(100) NOT NULL,
  `zone_id` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `setting_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_name`, `symbol`, `setting_id`) VALUES
(1, 'Ghana Cedi', 'GHS', 1),
(2, 'US Dollar', 'USD', 1),
(3, 'Pound Sterling', 'GBP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_categories`
--

CREATE TABLE IF NOT EXISTS `customer_categories` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `customer_category` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
(8, 'PRIVATE INFORMA'),
(9, 'EDUCAT. WORKERS');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(2) NOT NULL DEFAULT '1',
  `marriage_id` int(3) DEFAULT NULL,
  `investor_type_id` int(3) DEFAULT NULL,
  `idtype_id` int(3) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `entryclerk_name` varchar(80) DEFAULT NULL,
  `customer_category_id` int(3) DEFAULT NULL,
  `registration_date` date NOT NULL,
  `customer_photo` blob NOT NULL,
  `surname` varchar(20) NOT NULL,
  `other_names` varchar(35) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `fullname` varchar(80) DEFAULT NULL,
  `dob` date NOT NULL,
  `id_number` varchar(25) NOT NULL,
  `postal_address` varchar(50) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `work_no` varchar(15) DEFAULT NULL,
  `work_place` varchar(50) DEFAULT NULL,
  `work_department` varchar(30) DEFAULT NULL,
  `work_location` varchar(50) DEFAULT NULL,
  `position` varchar(40) DEFAULT NULL,
  `no_of_yrs` varchar(40) DEFAULT NULL,
  `guarantor_name` varchar(30) NOT NULL,
  `guarantor_work_place` varchar(50) DEFAULT NULL,
  `guarantor_no` varchar(15) NOT NULL,
  `guarantor_signature` enum('Yes','No') DEFAULT NULL,
  `last_school` varchar(50) DEFAULT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `religion_location` varchar(50) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `house_no` varchar(10) NOT NULL,
  `street` varchar(30) DEFAULT NULL,
  `area` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `landmark` varchar(50) DEFAULT NULL,
  `emergency_person` varchar(50) NOT NULL,
  `emergency_no` varchar(15) NOT NULL,
  `cust_signature` enum('Yes','No') DEFAULT NULL,
  `visible` enum('alive','deleted') DEFAULT 'alive',
  PRIMARY KEY (`id`),
  KEY `surname` (`surname`),
  KEY `other_names` (`other_names`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `daily_defaults`
--

CREATE TABLE IF NOT EXISTS `daily_defaults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=324 ;

--
-- Dumping data for table `daily_defaults`
--

INSERT INTO `daily_defaults` (`id`, `date`, `flag`) VALUES
(2, '2013-03-05', 1),
(3, '2013-03-07', 1),
(4, '2013-03-08', 1),
(5, '2013-03-09', 1),
(6, '2013-03-10', 1),
(7, '2013-03-11', 1),
(8, '2013-03-12', 1),
(9, '2013-03-13', 1),
(10, '2013-03-14', 1),
(11, '2013-03-15', 1),
(12, '2013-03-16', 1),
(13, '2013-03-17', 1),
(14, '2013-03-18', 1),
(15, '2013-03-20', 1),
(16, '2013-03-21', 1),
(17, '2013-03-22', 1),
(18, '2013-03-23', 1),
(19, '2013-03-24', 1),
(20, '2013-03-25', 1),
(21, '2013-03-26', 1),
(22, '2013-03-27', 1),
(23, '2013-04-29', 1),
(24, '2013-04-30', 1),
(25, '2013-05-01', 1),
(26, '2013-05-02', 1),
(27, '2013-05-03', 1),
(28, '2013-05-04', 1),
(29, '2013-05-05', 1),
(30, '2013-05-06', 1),
(31, '2013-05-07', 1),
(32, '2013-05-08', 1),
(33, '2013-05-09', 1),
(34, '2013-05-10', 1),
(35, '2013-05-11', 1),
(36, '2013-05-12', 1),
(37, '2013-05-13', 1),
(38, '2013-05-14', 1),
(39, '2013-05-15', 1),
(40, '2013-05-16', 1),
(41, '2013-05-17', 1),
(42, '2013-05-18', 1),
(43, '2013-05-19', 1),
(44, '2013-05-20', 1),
(45, '2013-05-21', 1),
(46, '2013-05-22', 1),
(47, '2013-05-23', 1),
(48, '2013-05-24', 1),
(49, '2013-05-25', 1),
(50, '2013-05-26', 1),
(51, '2013-05-27', 1),
(52, '2013-05-28', 1),
(53, '2013-05-29', 1),
(54, '2013-05-30', 1),
(55, '2013-06-27', 1),
(56, '2013-06-28', 1),
(57, '2013-06-29', 1),
(58, '2013-06-30', 1),
(59, '2013-07-01', 1),
(60, '2013-07-03', 1),
(61, '2013-07-04', 1),
(62, '2013-07-05', 1),
(63, '2013-07-06', 1),
(64, '2013-07-07', 1),
(65, '2013-07-08', 1),
(66, '2013-07-09', 1),
(67, '2013-07-10', 1),
(68, '2013-07-11', 1),
(69, '2013-07-12', 1),
(70, '2013-07-13', 1),
(71, '2013-07-14', 1),
(72, '2013-07-15', 1),
(73, '2013-07-16', 1),
(74, '2013-07-17', 1),
(75, '2013-07-18', 1),
(76, '2013-07-19', 1),
(77, '2013-07-20', 1),
(78, '2013-07-21', 1),
(79, '2013-07-22', 1),
(80, '2013-07-23', 1),
(81, '2013-07-24', 1),
(82, '2013-07-25', 1),
(83, '2013-07-26', 1),
(84, '2013-07-27', 1),
(85, '2013-07-28', 1),
(86, '2013-07-29', 1),
(87, '2013-07-30', 1),
(88, '2013-07-31', 1),
(89, '2013-08-01', 1),
(90, '2013-08-02', 1),
(91, '2013-08-03', 1),
(92, '2013-08-04', 1),
(93, '2013-08-05', 1),
(94, '2013-08-06', 1),
(95, '2013-08-07', 1),
(96, '2013-08-08', 1),
(97, '2013-08-09', 1),
(98, '2013-08-10', 1),
(99, '2013-08-11', 1),
(100, '2013-08-12', 1),
(101, '2013-08-13', 1),
(102, '2013-08-14', 1),
(103, '2013-08-15', 1),
(104, '2013-08-16', 1),
(105, '2013-08-17', 1),
(106, '2013-08-18', 1),
(107, '2013-08-19', 1),
(108, '2013-08-20', 1),
(109, '2013-08-21', 1),
(110, '2013-08-22', 1),
(111, '2013-08-23', 1),
(112, '2013-08-24', 1),
(113, '2013-08-25', 1),
(114, '2013-08-26', 1),
(115, '2013-08-27', 1),
(116, '2013-08-28', 1),
(117, '2013-08-29', 1),
(118, '2013-08-30', 1),
(119, '2013-08-31', 1),
(120, '2013-09-01', 1),
(121, '2013-09-02', 1),
(122, '2013-09-03', 1),
(123, '2013-09-04', 1),
(124, '2013-09-05', 1),
(125, '2013-09-06', 1),
(126, '2013-09-07', 1),
(127, '2013-09-08', 1),
(128, '2013-09-09', 1),
(129, '2013-09-10', 1),
(130, '2013-09-11', 1),
(131, '2013-09-12', 1),
(132, '2013-09-13', 1),
(133, '2013-09-14', 1),
(134, '2013-09-15', 1),
(135, '2013-09-16', 1),
(136, '2013-09-17', 1),
(137, '2013-09-18', 1),
(138, '2013-09-19', 1),
(139, '2013-09-20', 1),
(140, '2013-09-21', 1),
(141, '2013-09-22', 1),
(142, '2013-09-23', 1),
(143, '2013-09-24', 1),
(144, '2013-09-25', 1),
(145, '2013-09-26', 1),
(146, '2013-09-27', 1),
(147, '2013-09-28', 1),
(148, '2013-09-30', 1),
(149, '2013-10-01', 1),
(150, '2013-10-02', 1),
(151, '2013-10-03', 1),
(152, '2013-10-04', 1),
(153, '2013-10-05', 1),
(154, '2013-10-06', 1),
(155, '2013-10-07', 1),
(156, '2013-10-08', 1),
(157, '2013-10-09', 1),
(158, '2013-10-10', 1),
(159, '2013-10-11', 1),
(160, '2013-10-12', 1),
(161, '2013-10-13', 1),
(162, '2013-10-14', 1),
(163, '2013-10-15', 1),
(164, '2013-10-16', 1),
(165, '2013-10-17', 1),
(166, '2013-10-18', 1),
(167, '2013-10-19', 1),
(168, '2013-10-20', 1),
(169, '2013-10-21', 1),
(170, '2013-10-22', 1),
(171, '2013-10-23', 1),
(172, '2013-10-24', 1),
(173, '2013-10-25', 1),
(174, '2013-10-26', 1),
(175, '2013-10-27', 1),
(176, '2013-10-28', 1),
(177, '2013-10-29', 1),
(178, '2013-10-30', 1),
(179, '2013-10-31', 1),
(180, '2013-11-01', 1),
(181, '2013-11-02', 1),
(182, '2013-11-03', 1),
(183, '2013-11-04', 1),
(184, '2013-11-05', 1),
(185, '2013-11-06', 1),
(186, '2013-11-07', 1),
(187, '2013-11-08', 1),
(188, '2013-11-09', 1),
(189, '2013-11-10', 1),
(190, '2013-11-11', 1),
(191, '2013-11-12', 1),
(192, '2013-11-13', 1),
(193, '2013-11-14', 1),
(194, '2013-11-15', 1),
(195, '2013-11-16', 1),
(196, '2013-11-17', 1),
(197, '2013-11-18', 1),
(198, '2013-11-19', 1),
(199, '2013-11-20', 1),
(200, '2013-11-21', 1),
(201, '2013-11-22', 1),
(202, '2013-11-23', 1),
(203, '2013-11-24', 1),
(204, '2013-11-25', 1),
(205, '2013-11-26', 1),
(206, '2013-11-27', 1),
(207, '2013-11-28', 1),
(208, '2013-11-29', 1),
(209, '2013-11-30', 1),
(210, '2013-12-01', 1),
(211, '2013-12-02', 1),
(212, '2013-12-03', 1),
(213, '2013-12-04', 1),
(214, '2013-12-05', 1),
(215, '2013-12-06', 1),
(216, '2013-12-07', 1),
(217, '2013-12-08', 1),
(218, '2013-12-09', 1),
(219, '2013-12-10', 1),
(220, '2013-12-11', 1),
(221, '2013-12-12', 1),
(222, '2013-12-13', 1),
(223, '2013-12-14', 1),
(224, '2013-12-15', 1),
(225, '2013-12-16', 1),
(226, '2013-12-17', 1),
(227, '2013-12-18', 1),
(228, '2013-12-19', 1),
(229, '2013-12-20', 1),
(230, '2013-12-21', 1),
(231, '2013-12-22', 1),
(232, '2013-12-23', 1),
(233, '2013-12-24', 1),
(234, '2013-12-25', 1),
(235, '2013-12-26', 1),
(236, '2013-12-27', 1),
(237, '2013-12-28', 1),
(238, '2013-12-29', 1),
(239, '2013-12-30', 1),
(240, '2013-12-31', 1),
(241, '2014-01-01', 1),
(242, '2014-01-02', 1),
(243, '2014-01-03', 1),
(244, '2014-01-04', 1),
(245, '2014-01-05', 1),
(246, '2014-01-06', 1),
(247, '2014-01-07', 1),
(248, '2014-01-08', 1),
(249, '2014-01-09', 1),
(250, '2014-01-10', 1),
(251, '2014-01-11', 1),
(252, '2014-01-12', 1),
(253, '2014-01-13', 1),
(254, '2014-01-14', 1),
(255, '2014-01-16', 1),
(256, '2014-01-17', 1),
(257, '2014-01-18', 1),
(258, '2014-01-19', 1),
(259, '2014-01-20', 1),
(260, '2014-01-22', 1),
(261, '2014-01-23', 1),
(262, '2014-01-24', 1),
(263, '2014-01-25', 1),
(264, '2014-01-26', 1),
(265, '2014-01-27', 1),
(266, '2014-01-28', 1),
(267, '2014-01-29', 1),
(268, '2014-01-30', 1),
(269, '2014-01-31', 1),
(270, '2014-02-01', 1),
(271, '2014-02-02', 1),
(272, '2014-02-03', 1),
(273, '2014-02-04', 1),
(274, '2014-02-05', 1),
(275, '2014-02-06', 1),
(276, '2014-02-07', 1),
(277, '2014-02-08', 1),
(278, '2014-02-09', 1),
(279, '2014-02-10', 1),
(280, '2014-02-11', 1),
(281, '2014-02-12', 1),
(282, '2014-02-13', 1),
(283, '2014-02-14', 1),
(284, '2014-02-15', 1),
(285, '2014-02-16', 1),
(286, '2014-02-17', 1),
(287, '2014-02-18', 1),
(288, '2014-02-19', 1),
(289, '2014-02-20', 1),
(290, '2014-02-21', 1),
(291, '2014-02-22', 1),
(292, '2014-02-23', 1),
(293, '2014-02-24', 1),
(294, '2014-02-25', 1),
(295, '2014-02-26', 1),
(296, '2014-02-27', 1),
(297, '2014-02-28', 1),
(298, '2014-03-01', 1),
(299, '2014-03-02', 1),
(300, '2014-03-03', 1),
(301, '2014-03-04', 1),
(302, '2014-03-05', 1),
(303, '2014-03-06', 1),
(304, '2014-03-07', 1),
(305, '2014-03-08', 1),
(306, '2014-03-09', 1),
(307, '2014-03-10', 1),
(308, '2014-03-11', 1),
(309, '2014-03-12', 1),
(310, '2014-03-13', 1),
(311, '2014-03-14', 1),
(312, '2014-03-15', 1),
(313, '2014-03-16', 1),
(314, '2014-03-17', 1),
(315, '2014-03-18', 1),
(316, '2014-03-19', 1),
(317, '2014-03-20', 1),
(318, '2014-03-21', 1),
(319, '2014-03-22', 1),
(320, '2014-03-23', 1),
(321, '2014-03-24', 1),
(322, '2014-03-25', 1),
(323, '2014-03-26', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `debt_payments`
--

INSERT INTO `debt_payments` (`id`, `debt_id`, `sale_id`, `amount`, `date`) VALUES
(31, 0, 105, '5.00', '2012-09-09 17:25:11'),
(32, 0, 92, '5.00', '2012-10-10 19:16:19'),
(33, 0, 174, '7100.00', '2012-10-19 13:49:46'),
(34, 0, 171, '2.00', '2012-10-19 13:53:04'),
(35, 0, 92, '100.00', '2012-10-19 13:55:25'),
(36, 0, 92, '10.00', '2012-10-19 13:57:57'),
(37, 0, 92, '10.00', '2012-10-19 13:58:40'),
(38, 0, 97, '1.00', '2012-10-19 14:46:28'),
(39, 0, 109, '1000.00', '2012-10-29 02:47:13');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `debtors`
--

INSERT INTO `debtors` (`id`, `client_id`, `sale_id`, `sale_date`, `total_cost`, `amount_paid`, `balance`) VALUES
(47, 20, 192, '2012-11-09 16:34:27', '675.00', '500.00', '175.00');

-- --------------------------------------------------------

--
-- Table structure for table `defaulting_rates`
--

CREATE TABLE IF NOT EXISTS `defaulting_rates` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `monthly_rate` int(2) DEFAULT NULL,
  `expired_rate` int(2) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `defaulting_rates`
--

INSERT INTO `defaulting_rates` (`id`, `monthly_rate`, `expired_rate`, `modified_date`) VALUES
(1, 10, 10, '2013-02-24 22:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `eods`
--

CREATE TABLE IF NOT EXISTS `eods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eod_date` date NOT NULL,
  `flag` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `eods`
--

INSERT INTO `eods` (`id`, `eod_date`, `flag`) VALUES
(1, '2014-02-15', 1),
(2, '2014-02-28', 1),
(3, '2014-03-01', 1),
(4, '2014-03-02', 1),
(5, '2014-03-03', 1),
(6, '2014-03-04', 1),
(7, '2014-03-05', 1),
(8, '2014-03-06', 1),
(9, '2014-03-07', 1),
(10, '2014-03-08', 1),
(11, '2014-03-09', 1),
(12, '2014-03-10', 1),
(13, '2014-03-11', 1),
(14, '2014-03-12', 1),
(15, '2014-03-13', 1),
(16, '2014-03-14', 1),
(17, '2014-03-15', 1),
(18, '2014-03-16', 1),
(19, '2014-03-17', 1),
(20, '2014-03-18', 1),
(21, '2014-03-19', 1),
(22, '2014-03-20', 1),
(23, '2014-03-21', 1),
(24, '2014-03-22', 1),
(25, '2014-03-23', 1),
(26, '2014-03-24', 1),
(27, '2014-03-25', 1),
(28, '2014-03-26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `eoms`
--

CREATE TABLE IF NOT EXISTS `eoms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` date DEFAULT NULL,
  `flag` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `eoms`
--

INSERT INTO `eoms` (`id`, `year`, `flag`) VALUES
(1, '2014-03-16', 1),
(2, '2014-04-18', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `equities`
--

INSERT INTO `equities` (`id`, `description`, `beginning_balance`, `Owner_Investment`, `revenue`, `expenditure`, `net_income`, `withdrawal`, `net_loss`, `balance_end`, `flag`, `date`) VALUES
(1, 'Sale/Service Revenue', '0.00', '0.00', '45.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(2, 'Sale/Service Revenue', '0.00', '0.00', '43.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(3, 'Sale/Service Revenue', '0.00', '0.00', '40.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(4, 'Sale/Service Revenue', '0.00', '0.00', '72.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(5, 'Sale/Service Revenue', '0.00', '0.00', '72.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(6, 'Sale/Service Revenue', '0.00', '0.00', '72.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(7, 'Sale/Service Revenue', '0.00', '0.00', '72.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(8, 'Sale/Service Revenue', '0.00', '0.00', '72.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(9, 'EOM', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 2, '2014-03-16');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
-- Table structure for table `hirepurchases`
--

CREATE TABLE IF NOT EXISTS `hirepurchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_name` varchar(50) NOT NULL,
  `path` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(6, 'Social Security'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=416 ;

--
-- Dumping data for table `income_statements`
--

INSERT INTO `income_statements` (`id`, `sale_id`, `cash_account_id`, `description`, `revenue`, `expenditure`, `loancash`, `interest`, `actualinterest`, `saleofassets`, `proceedsonassets`, `taxpaid`, `net_income`, `flag`, `date`) VALUES
(1, NULL, NULL, 'Sale/Service Revenue', '45.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(2, NULL, NULL, 'Sale/Service Revenue', '43.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(3, NULL, NULL, 'Sale/Service Revenue', '40.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(4, NULL, NULL, 'Sale/Service Revenue', '72.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(5, NULL, NULL, 'Sale/Service Revenue', '72.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(6, NULL, NULL, 'Sale/Service Revenue', '72.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(7, NULL, NULL, 'Sale/Service Revenue', '72.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(8, NULL, NULL, 'Sale/Service Revenue', '72.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(9, NULL, NULL, 'test', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(10, NULL, NULL, 'test', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(11, NULL, NULL, 'test', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(12, NULL, NULL, 'test', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(13, NULL, NULL, 'Account Deletion', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(14, NULL, NULL, 'Account Deletion', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(15, NULL, NULL, 'Account Deletion', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(16, NULL, NULL, 'Account Deletion', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(17, NULL, NULL, 'ACCOUNTING & LEGAL FEES', '0.00', '1000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(18, NULL, NULL, 'GENERAL REPAIRS', '0.00', '230.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(19, NULL, NULL, 'Account Deletion', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(20, NULL, NULL, 'ACCOUNTING & LEGAL FEES', '0.00', '1000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(21, NULL, NULL, 'daily', '0.00', '1000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '-1000.00', 1, '2014-02-28'),
(22, NULL, NULL, 'Cost of Sales', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2030-05-07'),
(23, NULL, NULL, 'Cost of Sales', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2030-05-07'),
(24, 1399, NULL, 'Sales Revenue', '272.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(25, 1400, NULL, 'Sales Revenue', '693.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-02'),
(26, 1401, NULL, 'Sales Revenue', '339.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(27, 1402, NULL, 'Sales Revenue', '275.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(28, 1403, NULL, 'Sales Revenue', '396.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(29, 1405, NULL, 'Sales Revenue', '53.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(30, 1406, NULL, 'Sales Revenue', '140.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(31, 971, NULL, 'Sales Revenue', '307.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-27'),
(32, 781, NULL, 'Sales Revenue', '188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(33, 1123, NULL, 'Sales Revenue', '940.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(34, 1323, NULL, 'Sales Revenue', '96.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-28'),
(35, 788, NULL, 'Sales Revenue', '118.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(36, 1061, NULL, 'Sales Revenue', '170.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(37, 934, NULL, 'Sales Revenue', '310.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(38, 906, NULL, 'Sales Revenue', '190.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(39, 1311, NULL, 'Sales Revenue', '298.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(40, 1311, NULL, 'Sales Revenue', '-298.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(41, 1311, NULL, 'Sales Revenue', '257.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(42, 1225, NULL, 'Sales Revenue', '298.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(43, 1154, NULL, 'Sales Revenue', '128.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(44, 259, NULL, 'Sales Revenue', '206.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(45, 1363, NULL, 'Sales Revenue', '34.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(46, 1137, NULL, 'Sales Revenue', '132.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(47, 1188, NULL, 'Sales Revenue', '247.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(48, 1192, NULL, 'Sales Revenue', '615.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(49, NULL, NULL, 'Cost of Sales', '0.00', '4350.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-03'),
(50, NULL, NULL, 'Cost of Sales', '0.00', '2000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-18'),
(51, NULL, NULL, 'Account Deletion', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(52, NULL, NULL, 'Account Deletion', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(53, 1123, NULL, 'Sales Revenue', '245.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(54, 1387, NULL, 'Sales Revenue', '300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(55, 1252, NULL, 'Sales Revenue', '267.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(56, 909, NULL, 'Sales Revenue', '38.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(57, 883, NULL, 'Sales Revenue', '129.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(58, 1293, NULL, 'Sales Revenue', '213.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(59, 306, NULL, 'Sales Revenue', '200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(60, 914, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(61, 1233, NULL, 'Sales Revenue', '192.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(62, 1284, NULL, 'Sales Revenue', '260.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(63, 1004, NULL, 'Sales Revenue', '200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(64, 451, NULL, 'Sales Revenue', '210.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(65, 1306, NULL, 'Sales Revenue', '160.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(66, 1366, NULL, 'Sales Revenue', '128.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(67, 1025, NULL, 'Sales Revenue', '157.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(68, 1003, NULL, 'Sales Revenue', '145.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(69, 879, NULL, 'Sales Revenue', '320.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(70, 649, NULL, 'Sales Revenue', '400.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-27'),
(71, 548, NULL, 'Sales Revenue', '245.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(72, 1371, NULL, 'Sales Revenue', '220.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(73, 1160, NULL, 'Sales Revenue', '300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(74, 255, NULL, 'Sales Revenue', '380.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(75, 715, NULL, 'Sales Revenue', '157.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(76, 1072, NULL, 'Sales Revenue', '157.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(77, 955, NULL, 'Sales Revenue', '67.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(78, 1125, NULL, 'Sales Revenue', '300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(79, 1365, NULL, 'Sales Revenue', '660.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(80, 1179, NULL, 'Sales Revenue', '56.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(81, 522, NULL, 'Sales Revenue', '70.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(82, 1266, NULL, 'Sales Revenue', '300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(83, 1161, NULL, 'Sales Revenue', '161.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(84, 1189, NULL, 'Sales Revenue', '160.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(85, 1353, NULL, 'Sales Revenue', '167.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(86, 1041, NULL, 'Sales Revenue', '82.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(87, 1067, NULL, 'Sales Revenue', '323.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(88, 1116, NULL, 'Sales Revenue', '410.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(89, 932, NULL, 'Sales Revenue', '114.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(90, 315, NULL, 'Sales Revenue', '175.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(91, 1289, NULL, 'Sales Revenue', '78.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(92, 1282, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(93, 1158, NULL, 'Sales Revenue', '157.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(94, 412, NULL, 'Sales Revenue', '188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(95, 412, NULL, 'Sales Revenue', '188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(96, 412, NULL, 'Sales Revenue', '188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(97, 412, NULL, 'Sales Revenue', '188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(98, 412, NULL, 'Sales Revenue', '188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(99, 412, NULL, 'Sales Revenue', '188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(100, 412, NULL, 'Sales Revenue', '188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(101, 412, NULL, 'Sales Revenue', '-188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(102, 412, NULL, 'Sales Revenue', '-188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(103, 412, NULL, 'Sales Revenue', '-188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(104, 412, NULL, 'Sales Revenue', '-188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(105, 412, NULL, 'Sales Revenue', '-188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(106, 412, NULL, 'Sales Revenue', '-188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(107, 412, NULL, 'Sales Revenue', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(108, 1157, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(109, 718, NULL, 'Sales Revenue', '250.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-27'),
(110, 1261, NULL, 'Sales Revenue', '269.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-27'),
(111, 1231, NULL, 'Sales Revenue', '328.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(112, 1309, NULL, 'Sales Revenue', '244.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(113, 579, NULL, 'Sales Revenue', '70.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(114, 764, NULL, 'Sales Revenue', '300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(115, 1364, NULL, 'Sales Revenue', '29.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(116, 170, NULL, 'Sales Revenue', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(117, 171, NULL, 'Sales Revenue', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(118, 172, NULL, 'Sales Revenue', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(119, NULL, NULL, 'daily', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '2014-03-10'),
(120, 1095, NULL, 'Sales Revenue', '286.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(121, 1087, NULL, 'Sales Revenue', '528.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(122, 1029, NULL, 'Sales Revenue', '158.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(123, 1060, NULL, 'Sales Revenue', '210.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(124, 431, NULL, 'Sales Revenue', '40.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(125, 494, NULL, 'Sales Revenue', '157.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(126, 754, NULL, 'Sales Revenue', '80.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(127, 1190, NULL, 'Sales Revenue', '322.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(128, 1089, NULL, 'Sales Revenue', '65.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(129, 1313, NULL, 'Sales Revenue', '440.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(130, 1221, NULL, 'Sales Revenue', '500.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(131, 1016, NULL, 'Sales Revenue', '114.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(132, 1357, NULL, 'Sales Revenue', '82.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(133, 1362, NULL, 'Sales Revenue', '473.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(134, 1170, NULL, 'Sales Revenue', '280.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(135, 1376, NULL, 'Sales Revenue', '65.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(136, 1265, NULL, 'Sales Revenue', '684.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(137, 1288, NULL, 'Sales Revenue', '200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(138, 353, NULL, 'Sales Revenue', '188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(139, 305, NULL, 'Sales Revenue', '151.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(140, 420, NULL, 'Sales Revenue', '686.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(141, 296, NULL, 'Sales Revenue', '176.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(142, 1369, NULL, 'Sales Revenue', '450.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(143, 1250, NULL, 'Sales Revenue', '248.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(144, 1274, NULL, 'Sales Revenue', '65.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(145, 287, NULL, 'Sales Revenue', '105.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(146, 1216, NULL, 'Sales Revenue', '353.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(147, 832, NULL, 'Sales Revenue', '500.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-08'),
(148, 715, NULL, 'Sales Revenue', '157.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-08'),
(149, 1229, NULL, 'Sales Revenue', '128.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(150, 1230, NULL, 'Sales Revenue', '165.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(151, 1254, NULL, 'Sales Revenue', '192.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(152, 1227, NULL, 'Sales Revenue', '388.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(153, 1251, NULL, 'Sales Revenue', '136.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(154, 1180, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(155, 943, NULL, 'Sales Revenue', '162.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(156, 312, NULL, 'Sales Revenue', '376.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(157, 1156, NULL, 'Sales Revenue', '78.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(158, 1314, NULL, 'Sales Revenue', '575.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(159, 1307, NULL, 'Sales Revenue', '135.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(160, 1370, NULL, 'Sales Revenue', '97.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(161, 1051, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-21'),
(162, 1132, NULL, 'Sales Revenue', '405.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-21'),
(163, 1183, NULL, 'Sales Revenue', '129.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-21'),
(164, 1361, NULL, 'Sales Revenue', '150.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-22'),
(165, 1146, NULL, 'Sales Revenue', '103.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-22'),
(166, 583, NULL, 'Sales Revenue', '152.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-24'),
(167, 1336, NULL, 'Sales Revenue', '54.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-24'),
(168, 793, NULL, 'Sales Revenue', '206.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-24'),
(169, 807, NULL, 'Sales Revenue', '67.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-24'),
(170, 1267, NULL, 'Sales Revenue', '128.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-24'),
(171, 976, NULL, 'Sales Revenue', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-24'),
(172, 1334, NULL, 'Sales Revenue', '30.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-24'),
(173, 1184, NULL, 'Sales Revenue', '232.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(174, 1052, NULL, 'Sales Revenue', '314.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(175, 1134, NULL, 'Sales Revenue', '-109.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-01-27'),
(176, 1134, NULL, 'Sales Revenue', '109.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(177, 1295, NULL, 'Sales Revenue', '30.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(178, 536, NULL, 'Sales Revenue', '118.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(179, 1347, NULL, 'Sales Revenue', '135.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(180, 1256, NULL, 'Sales Revenue', '128.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(181, 1248, NULL, 'Sales Revenue', '257.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(182, 354, NULL, 'Sales Revenue', '150.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(183, 1360, NULL, 'Sales Revenue', '111.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(184, 1195, NULL, 'Sales Revenue', '296.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(185, 1085, NULL, 'Sales Revenue', '272.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(186, 1294, NULL, 'Sales Revenue', '68.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(187, 1361, NULL, 'Sales Revenue', '196.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(188, 1132, NULL, 'Sales Revenue', '377.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(189, 1130, NULL, 'Sales Revenue', '206.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(190, 1100, NULL, 'Sales Revenue', '104.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(191, 1194, NULL, 'Sales Revenue', '157.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(192, 1246, NULL, 'Sales Revenue', '206.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-27'),
(193, 1246, NULL, 'Sales Revenue', '104.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(194, 1257, NULL, 'Sales Revenue', '271.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(195, 1135, NULL, 'Sales Revenue', '128.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(196, 1133, NULL, 'Sales Revenue', '133.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(197, 521, NULL, 'Sales Revenue', '95.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(198, 1136, NULL, 'Sales Revenue', '291.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(199, 1182, NULL, 'Sales Revenue', '371.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(200, 728, NULL, 'Sales Revenue', '150.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(201, 725, NULL, 'Sales Revenue', '235.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(202, 1327, NULL, 'Sales Revenue', '371.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(203, 1301, NULL, 'Sales Revenue', '400.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(204, 1390, NULL, 'Sales Revenue', '13.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(205, 1321, NULL, 'Sales Revenue', '141.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(206, 1352, NULL, 'Sales Revenue', '237.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-27'),
(207, 1217, NULL, 'Sales Revenue', '53.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-27'),
(208, 1236, NULL, 'Sales Revenue', '73.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-27'),
(209, 1358, NULL, 'Sales Revenue', '150.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(210, 1319, NULL, 'Sales Revenue', '30.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(211, 1315, NULL, 'Sales Revenue', '150.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(212, 1279, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(213, 948, NULL, 'Sales Revenue', '20.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(214, 1258, NULL, 'Sales Revenue', '128.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(215, 1319, NULL, 'Sales Revenue', '50.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(216, 1235, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(217, 480, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(218, 1234, NULL, 'Sales Revenue', '207.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(219, 1296, NULL, 'Sales Revenue', '266.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(220, 1045, NULL, 'Sales Revenue', '1096.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(221, 1303, NULL, 'Sales Revenue', '128.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(222, 1304, NULL, 'Sales Revenue', '35.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(223, 1305, NULL, 'Sales Revenue', '33.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(224, 480, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(225, 1235, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(226, 1238, NULL, 'Sales Revenue', '63.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(227, 1319, NULL, 'Sales Revenue', '30.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-08'),
(228, 1379, NULL, 'Sales Revenue', '30.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(229, 1317, NULL, 'Sales Revenue', '36.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(230, 1338, NULL, 'Sales Revenue', '217.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(231, 1210, NULL, 'Sales Revenue', '40.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(232, NULL, NULL, 'ACCOUNTING & LEGAL FEES', '0.00', '1000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-01-22'),
(233, 1340, NULL, 'Sales Revenue', '32.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-15'),
(234, 1373, NULL, 'Sales Revenue', '50.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-17'),
(235, 1199, NULL, 'Sales Revenue', '29.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-17'),
(236, 1206, NULL, 'Sales Revenue', '13.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-19'),
(237, 324, NULL, 'Sales Revenue', '500.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-20'),
(238, 1143, NULL, 'Sales Revenue', '157.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-24'),
(239, 1300, NULL, 'Sales Revenue', '172.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(240, 610, NULL, 'Sales Revenue', '141.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-25'),
(241, 767, NULL, 'Sales Revenue', '50.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-26'),
(242, 1373, NULL, 'Sales Revenue', '40.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-27'),
(243, 275, NULL, 'Sales Revenue', '50.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-27'),
(244, 1203, NULL, 'Sales Revenue', '32.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(245, 819, NULL, 'Sales Revenue', '67.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(246, 1271, NULL, 'Sales Revenue', '300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(247, 1166, NULL, 'Sales Revenue', '186.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(248, 1166, NULL, 'Sales Revenue', '4.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(249, 1204, NULL, 'Sales Revenue', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(250, 748, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(251, 1244, NULL, 'Sales Revenue', '80.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(252, 1298, NULL, 'Sales Revenue', '76.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(253, 1240, NULL, 'Sales Revenue', '300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(254, 1297, NULL, 'Sales Revenue', '207.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(255, 1299, NULL, 'Sales Revenue', '207.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(256, 1345, NULL, 'Sales Revenue', '260.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(257, 978, NULL, 'Sales Revenue', '63.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(258, 979, NULL, 'Sales Revenue', '200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-03'),
(259, 1243, NULL, 'Sales Revenue', '200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-04'),
(260, 1342, NULL, 'Sales Revenue', '39.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(261, 362, NULL, 'Sales Revenue', '50.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(262, 261, NULL, 'Sales Revenue', '200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(263, 619, NULL, 'Sales Revenue', '50.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-05'),
(264, 1323, NULL, 'Sales Revenue', '258.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(265, 1312, NULL, 'Sales Revenue', '82.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(266, 804, NULL, 'Sales Revenue', '41.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(267, 1407, NULL, 'Sales Revenue', '34.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(268, 173, NULL, 'Sales Revenue', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(269, 174, NULL, 'Sales Revenue', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(270, 175, NULL, 'Sales Revenue', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(271, 176, NULL, 'Sales Revenue', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(272, 177, NULL, 'Sales Revenue', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(273, 1408, NULL, 'Sales Revenue', '290.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(274, 1409, NULL, 'Sales Revenue', '383.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-12'),
(275, 1410, NULL, 'Sales Revenue', '55.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(276, 1411, NULL, 'Sales Revenue', '55.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(277, 178, NULL, 'Sales Revenue', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(278, 179, NULL, 'Sales Revenue', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(279, 180, NULL, 'Sales Revenue', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(280, NULL, NULL, 'daily', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '2014-03-13'),
(281, 1412, NULL, 'Sales Revenue', '110.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(282, 1413, NULL, 'Sales Revenue', '554.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(283, 1414, NULL, 'Sales Revenue', '96.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-01-31'),
(284, 1414, NULL, 'Sales Revenue', '96.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(285, 1415, NULL, 'Sales Revenue', '253.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(286, 1415, NULL, 'Sales Revenue', '2.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(287, 1054, NULL, 'Sales Revenue', '160.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-17'),
(288, 1108, NULL, 'Sales Revenue', '281.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-19'),
(289, 1273, NULL, 'Sales Revenue', '86.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-27'),
(290, 1368, NULL, 'Sales Revenue', '252.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(291, 1326, NULL, 'Sales Revenue', '180.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(292, 1416, NULL, 'Sales Revenue', '339.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(293, 1417, NULL, 'Sales Revenue', '339.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(294, 1418, NULL, 'Sales Revenue', '180.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-11'),
(295, 1310, NULL, 'Sales Revenue', '120.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(296, 1263, NULL, 'Sales Revenue', '300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(297, 1155, NULL, 'Sales Revenue', '160.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(298, 1328, NULL, 'Sales Revenue', '165.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(299, 880, NULL, 'Sales Revenue', '150.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(300, 880, NULL, 'Sales Revenue', '135.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2013-07-31'),
(301, 1081, NULL, 'Sales Revenue', '177.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(302, 1332, NULL, 'Sales Revenue', '110.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(303, 1149, NULL, 'Sales Revenue', '270.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(304, 942, NULL, 'Sales Revenue', '150.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(305, 1186, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(306, 737, NULL, 'Sales Revenue', '74.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(307, 882, NULL, 'Sales Revenue', '71.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(308, 1308, NULL, 'Sales Revenue', '230.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-12'),
(309, 780, NULL, 'Sales Revenue', '82.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(310, 1282, NULL, 'Sales Revenue', '64.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(311, 1419, NULL, 'Sales Revenue', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(312, 1197, NULL, 'Sales Revenue', '331.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(313, 1222, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(314, 673, NULL, 'Sales Revenue', '132.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(315, 1320, NULL, 'Sales Revenue', '29.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(316, 1062, NULL, 'Sales Revenue', '300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-14'),
(317, 1211, NULL, 'Sales Revenue', '200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-14'),
(318, 1259, NULL, 'Sales Revenue', '96.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(319, 1198, NULL, 'Sales Revenue', '78.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(320, 1205, NULL, 'Sales Revenue', '75.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(321, 966, NULL, 'Sales Revenue', '120.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(322, 609, NULL, 'Sales Revenue', '40.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(323, 1163, NULL, 'Sales Revenue', '50.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-12'),
(324, NULL, NULL, 'UTILITIES', '0.00', '1536.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(325, 578, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(326, 387, NULL, 'Sales Revenue', '962.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-14'),
(327, NULL, NULL, 'daily', '0.00', '1536.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '-1536.00', 1, '2014-03-18'),
(328, 1420, NULL, 'Sales Revenue', '79.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-19'),
(329, 1421, NULL, 'Sales Revenue', '335.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(330, 1422, NULL, 'Sales Revenue', '289.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-17'),
(331, 1423, NULL, 'Sales Revenue', '79.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(332, 1420, NULL, 'Sales Revenue', '-79.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-19'),
(333, 1420, NULL, 'Sales Revenue', '347.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(334, 552, NULL, 'Sales Revenue', '175.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2013-07-30'),
(335, 552, NULL, 'Sales Revenue', '14.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2013-07-30'),
(336, 307, NULL, 'Sales Revenue', '63.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2013-05-13'),
(337, 1424, NULL, 'Sales Revenue', '477.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(338, NULL, NULL, 'Cost of Sales', '0.00', '3000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-21'),
(339, NULL, NULL, 'Cost of Sales', '0.00', '1300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-21'),
(340, NULL, NULL, 'daily', '0.00', '4300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '-4300.00', 1, '2014-03-21'),
(341, 1425, NULL, 'Sales Revenue', '388.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2013-12-21'),
(342, 330, NULL, 'Sales Revenue', '190.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-17'),
(343, 547, NULL, 'Sales Revenue', '329.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(344, 547, NULL, 'Sales Revenue', '300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2013-05-28'),
(345, 1213, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(346, 1381, NULL, 'Sales Revenue', '180.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(347, 1382, NULL, 'Sales Revenue', '76.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(348, 1039, NULL, 'Sales Revenue', '300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-19'),
(349, 1387, NULL, 'Sales Revenue', '290.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-19'),
(350, 816, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(351, 396, NULL, 'Sales Revenue', '163.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(352, 1112, NULL, 'Sales Revenue', '300.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-13'),
(353, 1272, NULL, 'Sales Revenue', '86.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-14'),
(354, 1418, NULL, 'Sales Revenue', '180.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-17'),
(355, 1378, NULL, 'Sales Revenue', '176.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(356, 1375, NULL, 'Sales Revenue', '28.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(357, 873, NULL, 'Sales Revenue', '82.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(358, 1385, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-19'),
(359, 1273, NULL, 'Sales Revenue', '19.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-19'),
(360, 1385, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-21'),
(361, 1385, NULL, 'Sales Revenue', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-25'),
(362, NULL, NULL, 'daily', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '100.00', 1, '2014-03-25'),
(363, 393, NULL, 'Sales Revenue', '80.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-14'),
(364, 928, NULL, 'Sales Revenue', '528.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-14'),
(365, 1329, NULL, 'Sales Revenue', '210.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(366, 1145, NULL, 'Sales Revenue', '193.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(367, 423, NULL, 'Sales Revenue', '106.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(368, 1061, NULL, 'Sales Revenue', '200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-21'),
(369, 1377, NULL, 'Sales Revenue', '592.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-21'),
(370, 1280, NULL, 'Sales Revenue', '156.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-21'),
(371, 1402, NULL, 'Sales Revenue', '275.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-24'),
(372, 1088, NULL, 'Sales Revenue', '261.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-24'),
(373, 796, NULL, 'Sales Revenue', '116.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-24'),
(374, 999, NULL, 'Sales Revenue', '342.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-25'),
(375, 1313, NULL, 'Sales Revenue', '440.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-25'),
(376, 1273, NULL, 'Sales Revenue', '-19.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-19'),
(377, 1273, NULL, 'Sales Revenue', '60.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-19'),
(378, 1386, NULL, 'Sales Revenue', '378.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-20'),
(379, 1110, NULL, 'Sales Revenue', '68.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-20'),
(380, 1111, NULL, 'Sales Revenue', '82.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-20'),
(381, 1273, NULL, 'Sales Revenue', '18.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-20'),
(382, 686, NULL, 'Sales Revenue', '61.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-20'),
(383, 993, NULL, 'Sales Revenue', '65.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-20'),
(384, 1292, NULL, 'Sales Revenue', '103.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-24'),
(385, 1212, NULL, 'Sales Revenue', '212.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-24'),
(386, 1111, NULL, 'Sales Revenue', '120.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-24'),
(387, 1157, NULL, 'Sales Revenue', '94.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-24'),
(388, 1398, NULL, 'Sales Revenue', '305.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-25'),
(389, 1158, NULL, 'Sales Revenue', '160.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-25'),
(390, 1084, NULL, 'Sales Revenue', '188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-27'),
(391, 543, NULL, 'Sales Revenue', '136.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(392, 368, NULL, 'Sales Revenue', '167.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(393, 1159, NULL, 'Sales Revenue', '130.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-02-28'),
(394, 841, NULL, 'Sales Revenue', '172.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(395, 1043, NULL, 'Sales Revenue', '188.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-07'),
(396, 1193, NULL, 'Sales Revenue', '128.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-08'),
(397, 1115, NULL, 'Sales Revenue', '206.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-08'),
(398, 294, NULL, 'Sales Revenue', '20.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(399, 367, NULL, 'Sales Revenue', '67.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10'),
(400, 557, NULL, 'Sales Revenue', '122.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-10');
INSERT INTO `income_statements` (`id`, `sale_id`, `cash_account_id`, `description`, `revenue`, `expenditure`, `loancash`, `interest`, `actualinterest`, `saleofassets`, `proceedsonassets`, `taxpaid`, `net_income`, `flag`, `date`) VALUES
(401, 1208, NULL, 'Sales Revenue', '67.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(402, 1218, NULL, 'Sales Revenue', '257.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-11'),
(403, 866, NULL, 'Sales Revenue', '230.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-12'),
(404, 1147, NULL, 'Sales Revenue', '40.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-14'),
(405, 519, NULL, 'Sales Revenue', '200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-14'),
(406, 1249, NULL, 'Sales Revenue', '200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-14'),
(407, 1131, NULL, 'Sales Revenue', '161.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-14'),
(408, 586, NULL, 'Sales Revenue', '47.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-17'),
(409, 294, NULL, 'Sales Revenue', '25.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-17'),
(410, 827, NULL, 'Sales Revenue', '205.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(411, 629, NULL, 'Sales Revenue', '200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-18'),
(412, 1335, NULL, 'Sales Revenue', '78.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-19'),
(413, 368, NULL, 'Sales Revenue', '124.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-03-01'),
(414, 989, NULL, 'Sales Revenue', '149.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-01-20'),
(415, NULL, NULL, 'Cost of Sales', '0.00', '500.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '2014-08-27');

-- --------------------------------------------------------

--
-- Table structure for table `inst_types`
--

CREATE TABLE IF NOT EXISTS `inst_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `inst_type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
  `instruction_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `instructions`
--

INSERT INTO `instructions` (`id`, `instruction_name`) VALUES
(1, 'Pay interest'),
(2, 'Rollover principal & inte'),
(3, 'Rollover principal'),
(4, 'Rollover interest'),
(5, 'Other - provide details');

-- --------------------------------------------------------

--
-- Table structure for table `investment_payments`
--

CREATE TABLE IF NOT EXISTS `investment_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_id` int(11) DEFAULT NULL,
  `investor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT '0.00',
  `payment_mode` varchar(20) DEFAULT NULL,
  `cheque_nos` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL,
  `payment_date` date DEFAULT NULL,
  `delete_status` enum('dead','alive') DEFAULT 'alive',
  `deleted_by` varchar(200) DEFAULT NULL,
  `edit_details_username_oldnnewamout` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `investment_payments`
--

INSERT INTO `investment_payments` (`id`, `investment_id`, `investor_id`, `user_id`, `amount`, `payment_mode`, `cheque_nos`, `created`, `payment_date`, `delete_status`, `deleted_by`, `edit_details_username_oldnnewamout`) VALUES
(1, 12, 2, NULL, '300.60', 'Cheque', '777-99-fgt', '2014-05-28 17:55:51', '2014-05-28', 'alive', NULL, NULL),
(2, 12, 2, NULL, '40.00', 'Cheque', 'rrtt-www-333', '2014-05-28 18:12:31', '2014-05-28', 'alive', NULL, NULL),
(3, 5, 1, NULL, '60.70', 'Post-dated chq', '55-pp0-ii', '2014-05-28 18:20:45', '2014-05-28', 'alive', NULL, NULL),
(4, 11, 2, NULL, '480.00', 'Cash', '', '2014-09-08 12:16:57', '2014-09-08', 'alive', NULL, NULL),
(5, 14, 2, NULL, '1234.00', 'Cash', '', '2014-10-16 03:09:50', '1970-01-01', 'alive', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

--
-- Dumping data for table `investment_statements`
--

INSERT INTO `investment_statements` (`id`, `investment_id`, `investor_id`, `user_id`, `principal`, `interest`, `total`, `maturity_date`, `created`, `modified`) VALUES
(1, 17, 2, 39, '1225.00', '25.00', '1250.00', '2015-07-11', '2014-09-11 23:22:35', '2014-09-11 23:22:37'),
(2, 20, 2, 39, '1225.00', '25.00', '1250.00', '2015-07-11', '2014-09-11 23:28:09', '2014-09-11 23:28:10'),
(3, 21, 2, 39, '1000.00', '25.00', '1025.00', '2014-10-11', '2014-09-11 23:46:40', '2014-09-11 23:46:40'),
(4, 21, 2, 39, '1025.00', '25.00', '1050.00', '2014-11-11', '2014-09-11 23:46:40', '2014-09-11 23:46:40'),
(5, 21, 2, 39, '1050.00', '25.00', '1075.00', '2014-12-11', '2014-09-11 23:46:40', '2014-09-11 23:46:40'),
(6, 21, 2, 39, '1075.00', '25.00', '1100.00', '2015-01-11', '2014-09-11 23:46:40', '2014-09-11 23:46:40'),
(7, 21, 2, 39, '1100.00', '25.00', '1125.00', '2015-02-11', '2014-09-11 23:46:40', '2014-09-11 23:46:40'),
(8, 21, 2, 39, '1125.00', '25.00', '1150.00', '2015-03-11', '2014-09-11 23:46:40', '2014-09-11 23:46:40'),
(9, 21, 2, 39, '1150.00', '25.00', '1175.00', '2015-04-11', '2014-09-11 23:46:40', '2014-09-11 23:46:40'),
(10, 21, 2, 39, '1175.00', '25.00', '1200.00', '2015-05-11', '2014-09-11 23:46:40', '2014-09-11 23:46:40'),
(11, 21, 2, 39, '1200.00', '25.00', '1225.00', '2015-06-11', '2014-09-11 23:46:41', '2014-09-11 23:46:41'),
(12, 21, 2, 39, '1225.00', '25.00', '1250.00', '2015-07-11', '2014-09-11 23:46:41', '2014-09-11 23:46:41'),
(13, 21, 2, 39, '1250.00', '31.25', '1281.25', '2015-08-11', '2014-09-12 00:01:05', '2014-09-12 00:01:05'),
(14, 21, 2, 39, '1281.25', '31.25', '1312.50', '2015-09-11', '2014-09-12 00:01:05', '2014-09-12 00:01:05'),
(15, 21, 2, 39, '1312.50', '31.25', '1343.75', '2015-10-11', '2014-09-12 00:01:05', '2014-09-12 00:01:05'),
(16, 21, 2, 39, '1343.75', '31.25', '1375.00', '2015-11-11', '2014-09-12 00:01:05', '2014-09-12 00:01:05'),
(17, 21, 2, 39, '1375.00', '31.25', '1406.25', '2015-12-11', '2014-09-12 00:01:05', '2014-09-12 00:01:05'),
(18, 21, 2, 39, '1406.25', '31.25', '1437.50', '2016-01-11', '2014-09-12 00:01:05', '2014-09-12 00:01:05'),
(19, 21, 2, 39, '1437.50', '31.25', '1468.75', '2016-02-11', '2014-09-12 00:01:05', '2014-09-12 00:01:05'),
(20, 21, 2, 39, '1468.75', '31.25', '1500.00', '2016-03-11', '2014-09-12 00:01:05', '2014-09-12 00:01:05'),
(21, 21, 2, 39, '1500.00', '31.25', '1531.25', '2016-04-11', '2014-09-12 00:01:05', '2014-09-12 00:01:05'),
(22, 21, 2, 39, '1531.25', '31.25', '1562.50', '2016-05-11', '2014-09-12 00:01:05', '2014-09-12 00:01:05'),
(23, 19, 2, 39, '1250.00', '31.25', '1281.25', '2015-08-11', '2014-09-12 00:06:49', '2014-09-12 00:06:49'),
(24, 19, 2, 39, '1281.25', '31.25', '1312.50', '2015-09-11', '2014-09-12 00:06:49', '2014-09-12 00:06:49'),
(25, 19, 2, 39, '1312.50', '31.25', '1343.75', '2015-10-11', '2014-09-12 00:06:49', '2014-09-12 00:06:49'),
(26, 19, 2, 39, '1343.75', '31.25', '1375.00', '2015-11-11', '2014-09-12 00:06:49', '2014-09-12 00:06:49'),
(27, 19, 2, 39, '1375.00', '31.25', '1406.25', '2015-12-11', '2014-09-12 00:06:49', '2014-09-12 00:06:49'),
(28, 19, 2, 39, '1406.25', '31.25', '1437.50', '2016-01-11', '2014-09-12 00:06:49', '2014-09-12 00:06:49'),
(29, 19, 2, 39, '1437.50', '31.25', '1468.75', '2016-02-11', '2014-09-12 00:06:49', '2014-09-12 00:06:49'),
(30, 19, 2, 39, '1468.75', '31.25', '1500.00', '2016-03-11', '2014-09-12 00:06:49', '2014-09-12 00:06:49'),
(31, 19, 2, 39, '1500.00', '31.25', '1531.25', '2016-04-11', '2014-09-12 00:06:49', '2014-09-12 00:06:49'),
(32, 19, 2, 39, '1531.25', '31.25', '1562.50', '2016-05-11', '2014-09-12 00:06:49', '2014-09-12 00:06:49'),
(33, 19, 2, 39, '1562.50', '39.06', '1601.56', '2016-06-11', '2014-09-12 00:08:10', '2014-09-12 00:08:10'),
(34, 19, 2, 39, '1601.56', '39.06', '1640.63', '2016-07-11', '2014-09-12 00:08:10', '2014-09-12 00:08:10'),
(35, 19, 2, 39, '1640.63', '39.06', '1679.69', '2016-08-11', '2014-09-12 00:08:10', '2014-09-12 00:08:10'),
(36, 19, 2, 39, '1679.69', '39.06', '1718.75', '2016-09-11', '2014-09-12 00:08:10', '2014-09-12 00:08:10'),
(37, 19, 2, 39, '1718.75', '39.06', '1757.81', '2016-10-11', '2014-09-12 00:08:10', '2014-09-12 00:08:10'),
(38, 19, 2, 39, '1757.81', '39.06', '1796.88', '2016-11-11', '2014-09-12 00:08:10', '2014-09-12 00:08:10'),
(39, 19, 2, 39, '1796.88', '39.06', '1835.94', '2016-12-11', '2014-09-12 00:08:10', '2014-09-12 00:08:10'),
(40, 19, 2, 39, '1835.94', '39.06', '1875.00', '2017-01-11', '2014-09-12 00:08:10', '2014-09-12 00:08:10'),
(41, 19, 2, 39, '1875.00', '39.06', '1914.06', '2017-02-11', '2014-09-12 00:08:10', '2014-09-12 00:08:10'),
(42, 19, 2, 39, '1914.06', '39.06', '1953.13', '2017-03-11', '2014-09-12 00:08:10', '2014-09-12 00:08:10'),
(43, 22, 3, 1, '1000.00', '25.00', '1025.00', '2014-10-22', '2014-09-22 07:44:19', '2014-09-22 07:44:19'),
(44, 14, 2, 39, '864.00', '21.60', '885.60', '2016-06-23', '2014-09-23 03:52:00', '2014-09-23 03:52:00'),
(45, 14, 2, 39, '885.60', '21.60', '907.20', '2016-07-23', '2014-09-23 03:52:00', '2014-09-23 03:52:00'),
(46, 14, 2, 39, '907.20', '21.60', '928.80', '2016-08-23', '2014-09-23 03:52:00', '2014-09-23 03:52:00'),
(47, 14, 2, 39, '928.80', '21.60', '950.40', '2016-09-23', '2014-09-23 03:52:00', '2014-09-23 03:52:00'),
(48, 14, 2, 39, '950.40', '21.60', '972.00', '2016-10-23', '2014-09-23 03:52:00', '2014-09-23 03:52:00'),
(49, 14, 2, 39, '972.00', '21.60', '993.60', '2016-11-23', '2014-09-23 03:52:00', '2014-09-23 03:52:00'),
(50, 14, 2, 39, '993.60', '21.60', '1015.20', '2016-12-23', '2014-09-23 03:52:00', '2014-09-23 03:52:00'),
(51, 14, 2, 39, '1015.20', '21.60', '1036.80', '2017-01-23', '2014-09-23 03:52:00', '2014-09-23 03:52:00'),
(52, 21, 2, 39, '1562.50', '39.06', '1601.56', '2016-06-11', '2014-09-23 07:33:34', '2014-09-23 07:33:34'),
(53, 21, 2, 39, '1601.56', '39.06', '1640.63', '2016-07-11', '2014-09-23 07:33:34', '2014-09-23 07:33:34'),
(54, 21, 2, 39, '1640.63', '39.06', '1679.69', '2016-08-11', '2014-09-23 07:33:34', '2014-09-23 07:33:34'),
(55, 21, 2, 39, '1679.69', '39.06', '1718.75', '2016-09-11', '2014-09-23 07:33:34', '2014-09-23 07:33:34'),
(56, 21, 2, 39, '1718.75', '39.06', '1757.81', '2016-10-11', '2014-09-23 07:33:34', '2014-09-23 07:33:34'),
(57, 21, 2, 39, '1757.81', '39.06', '1796.88', '2016-11-11', '2014-09-23 07:33:34', '2014-09-23 07:33:34'),
(58, 21, 2, 39, '1796.88', '39.06', '1835.94', '2016-12-11', '2014-09-23 07:33:34', '2014-09-23 07:33:34'),
(59, 21, 2, 39, '1835.94', '39.06', '1875.00', '2017-01-11', '2014-09-23 07:33:34', '2014-09-23 07:33:34'),
(60, 21, 2, 39, '1875.00', '39.06', '1914.06', '2017-02-11', '2014-09-23 07:33:34', '2014-09-23 07:33:34'),
(61, 21, 2, 39, '1914.06', '39.06', '1953.13', '2017-03-11', '2014-09-23 07:33:34', '2014-09-23 07:33:34'),
(62, 23, 3, 1, '900.00', '22.50', '922.50', '2014-10-25', '2014-09-25 03:18:19', '2014-09-25 03:18:19'),
(63, 1, 1, 39, '120.00', '3.00', '123.00', '1970-01-31', '2014-09-25 04:49:02', '2014-09-25 04:49:02'),
(64, 1, 1, 39, '123.00', '3.00', '126.00', '1970-03-03', '2014-09-25 04:49:02', '2014-09-25 04:49:02'),
(65, 1, 1, 39, '126.00', '3.00', '129.00', '1970-04-03', '2014-09-25 04:49:02', '2014-09-25 04:49:02'),
(66, 1, 1, 39, '129.00', '3.00', '132.00', '1970-05-03', '2014-09-25 04:49:02', '2014-09-25 04:49:02'),
(67, 1, 1, 39, '132.00', '3.00', '135.00', '1970-06-03', '2014-09-25 04:49:02', '2014-09-25 04:49:02'),
(68, 1, 1, 39, '135.00', '3.00', '138.00', '1970-07-03', '2014-09-25 04:49:02', '2014-09-25 04:49:02'),
(69, 1, 1, 39, '138.00', '3.00', '141.00', '1970-08-03', '2014-09-25 04:49:02', '2014-09-25 04:49:02'),
(70, 1, 1, 39, '141.00', '3.00', '144.00', '1970-09-03', '2014-09-25 04:49:02', '2014-09-25 04:49:02'),
(71, 1, 1, 39, '144.00', '3.60', '147.60', '1970-10-01', '2014-09-25 04:49:37', '2014-09-25 04:49:37'),
(72, 1, 1, 39, '147.60', '3.60', '151.20', '1970-11-01', '2014-09-25 04:49:37', '2014-09-25 04:49:37'),
(73, 1, 1, 39, '151.20', '3.60', '154.80', '1970-12-01', '2014-09-25 04:49:37', '2014-09-25 04:49:37'),
(74, 1, 1, 39, '154.80', '3.60', '158.40', '1971-01-01', '2014-09-25 04:49:37', '2014-09-25 04:49:37'),
(75, 1, 1, 39, '158.40', '3.60', '162.00', '1971-02-01', '2014-09-25 04:49:37', '2014-09-25 04:49:37'),
(76, 1, 1, 39, '162.00', '3.60', '165.60', '1971-03-01', '2014-09-25 04:49:37', '2014-09-25 04:49:37'),
(77, 1, 1, 39, '165.60', '3.60', '169.20', '1971-04-01', '2014-09-25 04:49:37', '2014-09-25 04:49:37'),
(78, 1, 1, 39, '169.20', '3.60', '172.80', '1971-05-01', '2014-09-25 04:49:37', '2014-09-25 04:49:37'),
(79, 24, 3, 1, '566.00', '14.15', '580.15', '2014-10-25', '2014-09-25 09:34:48', '2014-09-25 09:34:48'),
(80, 25, 3, 1, '1000.00', '25.00', '1025.00', '2014-10-25', '2014-09-25 10:01:56', '2014-09-25 10:01:56'),
(81, 26, 3, 1, '2100.00', '52.50', '2152.50', '2014-10-25', '2014-09-25 21:03:09', '2014-09-25 21:03:09'),
(82, 26, 3, 1, '2152.50', '52.50', '2205.00', '2014-11-25', '2014-09-25 21:03:09', '2014-09-25 21:03:09'),
(83, 26, 3, 1, '2205.00', '52.50', '2257.50', '2014-12-25', '2014-09-25 21:03:09', '2014-09-25 21:03:09'),
(84, 26, 3, 1, '2257.50', '52.50', '2310.00', '2015-01-25', '2014-09-25 21:03:09', '2014-09-25 21:03:09'),
(85, 26, 3, 1, '2310.00', '52.50', '2362.50', '2015-02-25', '2014-09-25 21:03:09', '2014-09-25 21:03:09'),
(86, 26, 3, 1, '2362.50', '52.50', '2415.00', '2015-03-25', '2014-09-25 21:03:09', '2014-09-25 21:03:09'),
(87, 27, 3, 1, '1000.00', '25.00', '1025.00', '2014-10-25', '2014-09-25 21:04:39', '2014-09-25 21:04:39'),
(88, 27, 3, 1, '1025.00', '25.00', '1050.00', '2014-11-25', '2014-09-25 21:04:39', '2014-09-25 21:04:39'),
(89, 27, 3, 1, '1050.00', '25.00', '1075.00', '2014-12-25', '2014-09-25 21:04:39', '2014-09-25 21:04:39'),
(90, 27, 3, 1, '1075.00', '25.00', '1100.00', '2015-01-25', '2014-09-25 21:04:39', '2014-09-25 21:04:39'),
(91, 27, 3, 1, '1100.00', '25.00', '1125.00', '2015-02-25', '2014-09-25 21:04:39', '2014-09-25 21:04:39'),
(92, 27, 3, 1, '1125.00', '25.00', '1150.00', '2015-03-25', '2014-09-25 21:04:39', '2014-09-25 21:04:39'),
(93, 14, 2, 39, '1036.80', '25.92', '1062.72', '2017-02-23', '2014-09-25 21:13:34', '2014-09-25 21:13:34'),
(94, 14, 2, 39, '1062.72', '25.92', '1088.64', '2017-03-23', '2014-09-25 21:13:34', '2014-09-25 21:13:34'),
(95, 14, 2, 39, '1088.64', '25.92', '1114.56', '2017-04-23', '2014-09-25 21:13:34', '2014-09-25 21:13:34'),
(96, 14, 2, 39, '1114.56', '25.92', '1140.48', '2017-05-23', '2014-09-25 21:13:34', '2014-09-25 21:13:34'),
(97, 14, 2, 39, '1140.48', '25.92', '1166.40', '2017-06-23', '2014-09-25 21:13:34', '2014-09-25 21:13:34'),
(98, 14, 2, 39, '1166.40', '25.92', '1192.32', '2017-07-23', '2014-09-25 21:13:34', '2014-09-25 21:13:34'),
(99, 14, 2, 39, '1192.32', '25.92', '1218.24', '2017-08-23', '2014-09-25 21:13:34', '2014-09-25 21:13:34'),
(100, 14, 2, 39, '1218.24', '25.92', '1244.16', '2017-09-23', '2014-09-25 21:13:34', '2014-09-25 21:13:34'),
(101, 28, 2, 1, '100.00', '2.50', '102.50', '2006-08-18', '2014-09-26 04:19:54', '2014-09-26 04:19:54'),
(102, 29, 2, 1, '500.00', '12.50', '512.50', '2011-09-22', '2014-09-26 04:31:17', '2014-09-26 04:31:17'),
(103, 29, 2, 1, '512.50', '12.50', '525.00', '2011-10-22', '2014-09-26 04:31:17', '2014-09-26 04:31:17'),
(104, 29, 2, 1, '525.00', '12.50', '537.50', '2011-11-22', '2014-09-26 04:31:17', '2014-09-26 04:31:17'),
(105, 29, 2, 1, '537.50', '12.50', '550.00', '2011-12-22', '2014-09-26 04:31:17', '2014-09-26 04:31:17'),
(106, 6, 1, 39, '110.00', '2.75', '112.75', '2014-10-10', '2014-09-26 04:44:56', '2014-09-26 04:44:56'),
(107, 6, 1, 39, '112.75', '2.75', '115.50', '2014-11-10', '2014-09-26 04:44:56', '2014-09-26 04:44:56'),
(108, 6, 1, 39, '115.50', '2.75', '118.25', '2014-12-10', '2014-09-26 04:44:56', '2014-09-26 04:44:56'),
(109, 6, 1, 39, '118.25', '2.75', '121.00', '2015-01-10', '2014-09-26 04:44:56', '2014-09-26 04:44:56'),
(110, 7, 1, 39, '110.00', '2.75', '112.75', '2014-10-10', '2014-09-26 04:47:30', '2014-09-26 04:47:30'),
(111, 7, 1, 39, '112.75', '2.75', '115.50', '2014-11-10', '2014-09-26 04:47:30', '2014-09-26 04:47:30'),
(112, 7, 1, 39, '115.50', '2.75', '118.25', '2014-12-10', '2014-09-26 04:47:30', '2014-09-26 04:47:30'),
(113, 7, 1, 39, '118.25', '2.75', '121.00', '2015-01-10', '2014-09-26 04:47:30', '2014-09-26 04:47:30'),
(114, 30, 3, 1, '89.00', '2.23', '91.23', '2014-10-29', '2014-09-29 05:32:46', '2014-09-29 05:32:46'),
(115, 31, 3, 1, '4556.00', '0.00', '4556.00', '2014-11-04', '2014-10-04 20:04:40', '2014-10-04 20:04:40'),
(116, 32, 1, 1, '1222.00', '0.00', '1222.00', '2014-11-09', '2014-10-09 21:58:07', '2014-10-09 21:58:07'),
(117, 33, 3, 1, '29700.00', '0.00', '29700.00', '2014-11-09', '2014-10-09 22:03:02', '2014-10-09 22:03:02'),
(118, 34, 3, 1, '6000.00', '0.00', '6000.00', '2014-11-09', '2014-10-09 22:03:54', '2014-10-09 22:03:54'),
(119, 35, 3, 1, '233.00', '0.00', '233.00', '2014-11-09', '2014-10-09 22:07:44', '2014-10-09 22:07:44'),
(120, 36, 3, 1, '234.00', '0.00', '234.00', '2014-11-09', '2014-10-09 22:08:22', '2014-10-09 22:08:22'),
(121, 37, 3, 1, '233333.00', '0.00', '233333.00', '2014-11-09', '2014-10-09 22:09:31', '2014-10-09 22:09:31'),
(122, 38, 3, 1, '400.00', '0.00', '400.00', '2014-11-09', '2014-10-09 22:10:46', '2014-10-09 22:10:46'),
(123, 39, 3, 1, '343434.00', '0.00', '343434.00', '2014-11-09', '2014-10-09 22:13:23', '2014-10-09 22:13:23'),
(124, 40, 3, 1, '222.00', '0.00', '222.00', '2014-11-09', '2014-10-09 22:14:38', '2014-10-09 22:14:38'),
(125, 41, 3, 1, '400.00', '0.00', '400.00', '2014-11-09', '2014-10-09 22:16:28', '2014-10-09 22:16:28'),
(126, 42, 3, 1, '900.00', '0.00', '900.00', '2014-11-09', '2014-10-09 22:17:06', '2014-10-09 22:17:06'),
(127, 43, 3, 1, '333.00', '0.00', '333.00', '2014-11-09', '2014-10-09 22:19:46', '2014-10-09 22:19:46'),
(128, 44, 4, 1, '555.00', '0.00', '555.00', '2014-11-09', '2014-10-09 22:22:44', '2014-10-09 22:22:44'),
(129, 45, 4, 1, '333.00', '0.00', '333.00', '2014-11-09', '2014-10-09 22:23:38', '2014-10-09 22:23:38'),
(130, 46, 1, 1, '2000.00', '0.00', '2000.00', '2014-11-13', '2014-10-13 07:56:04', '2014-10-13 07:56:04'),
(131, 47, 1, 1, '1666.00', '0.00', '1666.00', '2014-11-13', '2014-10-13 14:36:42', '2014-10-13 14:36:42'),
(132, 48, 1, 1, '500.00', '0.00', '500.00', '2014-11-13', '2014-10-13 14:45:55', '2014-10-13 14:45:55'),
(133, 49, 1, 1, '10000.00', '0.00', '10000.00', '2014-11-13', '2014-10-13 14:55:50', '2014-10-13 14:55:50'),
(134, 50, 1, 1, '20000.00', '0.00', '20000.00', '2014-11-13', '2014-10-13 14:56:55', '2014-10-13 14:56:55'),
(135, 51, 1, 1, '20000.00', '0.00', '20000.00', '2014-11-13', '2014-10-13 14:59:20', '2014-10-13 14:59:20'),
(136, 52, 1, 1, '20000.00', '0.00', '20000.00', '2014-11-13', '2014-10-13 14:59:52', '2014-10-13 14:59:52'),
(137, 53, 1, 1, '20000.00', '0.00', '20000.00', '2014-11-13', '2014-10-13 15:00:35', '2014-10-13 15:00:35'),
(138, 54, 1, 1, '24444.00', '0.00', '24444.00', '2014-11-13', '2014-10-13 15:01:24', '2014-10-13 15:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `investment_terms`
--

CREATE TABLE IF NOT EXISTS `investment_terms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `investment_terms`
--

INSERT INTO `investment_terms` (`id`, `term_name`) VALUES
(1, '1 year'),
(2, '2 years'),
(3, '3 years');

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE IF NOT EXISTS `investments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_no` varchar(20) DEFAULT NULL,
  `investor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `investment_amount` decimal(11,2) DEFAULT '0.00',
  `portfolio_id` int(11) DEFAULT NULL,
  `custom_rate` decimal(3,2) DEFAULT '0.00',
  `amount_due` decimal(11,2) DEFAULT '0.00',
  `amount_paidout` decimal(11,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(11,2) NOT NULL DEFAULT '0.00',
  `interest_earned` decimal(11,2) DEFAULT '0.00',
  `investment_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `lastpaidout_date` date DEFAULT NULL,
  `details` varchar(200) DEFAULT NULL,
  `status` enum('Paid','Rolled_over','Cancelled','Part_payment','Invested') DEFAULT 'Invested',
  `old_status` enum('Paid','Rolled_over','Cancelled','Part_payment','Invested') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `investment_no`, `investor_id`, `user_id`, `currency_id`, `investment_amount`, `portfolio_id`, `custom_rate`, `amount_due`, `amount_paidout`, `balance`, `interest_earned`, `investment_date`, `due_date`, `lastpaidout_date`, `details`, `status`, `old_status`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, NULL, 1, 39, NULL, '100.00', 27, '0.00', '172.80', '0.00', '0.00', '28.80', '2014-05-09', '1971-05-01', NULL, NULL, 'Rolled_over', 'Cancelled', '2014-05-09 23:52:16', '2014-09-25 04:49:37', NULL, NULL),
(2, NULL, 1, 39, NULL, '100.00', 27, '0.00', '120.00', '0.00', '0.00', '20.00', '2014-05-10', '2015-01-10', NULL, NULL, 'Invested', 'Cancelled', '2014-05-10 01:57:12', '2014-05-10 01:57:12', NULL, NULL),
(3, NULL, 1, 39, NULL, '100.00', 27, '0.00', '120.00', '0.00', '0.00', '20.00', '2014-05-10', '2015-01-10', NULL, NULL, 'Invested', 'Cancelled', '2014-05-10 02:02:53', '2014-05-10 02:02:53', NULL, NULL),
(4, NULL, 1, 39, NULL, '100.00', 27, '0.00', '120.00', '0.00', '0.00', '20.00', '2014-05-10', '2015-01-10', NULL, NULL, 'Invested', 'Cancelled', '2014-05-10 02:13:58', '2014-05-10 02:13:58', NULL, NULL),
(5, NULL, 1, 39, NULL, '100.00', 25, '0.00', '115.00', '121.40', '-6.40', '15.00', '2014-05-10', '2014-11-10', '2014-05-28', NULL, 'Paid', 'Cancelled', '2014-05-10 02:14:52', '2014-05-28 18:20:45', NULL, NULL),
(6, NULL, 1, 39, NULL, '100.00', 23, '0.00', '121.00', '0.00', '0.00', '11.00', '2014-05-10', '2015-01-10', NULL, NULL, 'Rolled_over', 'Cancelled', '2014-05-10 02:21:24', '2014-09-26 04:44:56', NULL, NULL),
(7, NULL, 1, 39, NULL, '100.00', 23, '0.00', '121.00', '0.00', '0.00', '11.00', '2014-05-10', '2015-01-10', NULL, NULL, 'Rolled_over', 'Invested', '2014-05-10 02:22:58', '2014-09-26 04:47:30', NULL, NULL),
(8, NULL, 1, 39, NULL, '100.00', 23, '0.00', '110.00', '0.00', '0.00', '10.00', '2014-05-10', '2014-09-10', NULL, NULL, 'Invested', 'Invested', '2014-05-10 02:24:56', '2014-05-10 02:24:56', NULL, NULL),
(9, NULL, 1, 39, NULL, '100.00', 23, '0.00', '110.00', '0.00', '0.00', '10.00', '2014-05-10', '2014-09-10', NULL, NULL, 'Invested', 'Invested', '2014-05-10 02:25:09', '2014-05-10 02:25:09', NULL, NULL),
(10, NULL, 2, 39, NULL, '5000.00', 25, '0.00', '5750.00', '0.00', '0.00', '750.00', '2014-05-23', '2014-11-23', NULL, NULL, 'Cancelled', 'Cancelled', '2014-05-23 17:02:05', '2014-09-11 15:11:54', NULL, NULL),
(11, 'UCSL-INV-0011', 2, 39, NULL, '400.00', 27, '0.00', '480.00', '480.00', '0.00', '80.00', '2014-05-23', '2015-01-23', '2014-09-08', NULL, 'Paid', 'Cancelled', '2014-05-23 17:45:40', '2014-09-08 12:16:57', NULL, NULL),
(12, 'UCSL-INV-0012', 2, 39, NULL, '400.00', 26, '0.00', '470.00', '641.20', '-171.20', '70.00', '2014-05-23', '2014-12-23', '2014-05-28', NULL, 'Paid', 'Cancelled', '2014-05-23 18:08:54', '2014-05-28 18:12:31', NULL, NULL),
(13, 'UCSL-INV-0013', 2, 39, NULL, '600.00', 28, '0.00', '900.38', '500.00', '235.00', '165.38', '2014-05-23', '2015-11-23', '2014-05-28', NULL, 'Cancelled', 'Cancelled', '2014-05-23 18:10:00', '2014-09-23 03:51:51', NULL, NULL),
(14, 'UCSL-INV-0014', 2, 39, NULL, '500.00', 27, '0.00', '1244.16', '1234.00', '10.16', '207.36', '2014-05-23', '2017-09-23', '1970-01-01', NULL, 'Part_payment', 'Cancelled', '2014-05-23 18:12:47', '2014-10-16 03:09:50', NULL, NULL),
(15, 'UCSL-INV-0015', 2, 39, NULL, '400.00', 23, '0.00', '484.00', '0.00', '0.00', '44.00', '2014-05-29', '2015-01-29', NULL, NULL, 'Rolled_over', 'Cancelled', '2014-05-29 15:53:47', '2014-09-09 20:52:24', NULL, NULL),
(16, 'UCSL-INV-0016', 1, 39, NULL, '400.00', 25, '0.00', '460.00', '0.00', '0.00', '60.00', '2014-09-08', '2015-03-08', NULL, NULL, 'Invested', 'Cancelled', '2014-09-08 11:15:21', '2014-09-08 11:15:21', NULL, NULL),
(17, 'UCSL-INV-0017', 2, 39, NULL, '1000.00', 29, '0.00', '1250.00', '0.00', '0.00', '250.00', '2014-09-11', '2015-07-11', NULL, NULL, 'Invested', 'Cancelled', '2014-09-11 23:22:35', '2014-09-23 07:33:15', NULL, NULL),
(18, NULL, 2, 39, NULL, '1000.00', 29, '0.00', '1250.00', '0.00', '0.00', '250.00', '2014-09-11', '2015-07-11', NULL, NULL, 'Invested', 'Cancelled', '2014-09-11 23:26:48', '2014-09-23 07:33:28', NULL, NULL),
(19, NULL, 2, 39, NULL, '1000.00', 29, '0.00', '1953.13', '0.00', '0.00', '390.63', '2014-09-11', '2017-03-11', NULL, NULL, 'Rolled_over', NULL, '2014-09-11 23:27:43', '2014-09-12 00:08:10', NULL, NULL),
(20, NULL, 2, 39, NULL, '1000.00', 29, '0.00', '1250.00', '0.00', '0.00', '250.00', '2014-09-11', '2015-07-11', NULL, NULL, 'Invested', NULL, '2014-09-11 23:28:09', '2014-09-11 23:28:09', NULL, NULL),
(21, 'UCSL-INV-0021', 2, 39, NULL, '1000.00', 29, '0.00', '1953.13', '0.00', '0.00', '390.63', '2014-09-11', '2017-03-11', NULL, NULL, 'Rolled_over', NULL, '2014-09-11 23:46:40', '2014-09-23 07:33:34', NULL, NULL),
(22, 'UCSL-INV-0022', 3, 1, NULL, '1000.00', 19, '0.00', '1025.00', '0.00', '0.00', '25.00', '2014-09-22', '2014-10-22', NULL, NULL, 'Invested', NULL, '2014-09-22 07:44:18', '2014-09-22 07:44:19', NULL, NULL),
(23, 'PARKST-INV-0023', 3, 1, NULL, '900.00', 19, '0.00', '922.50', '0.00', '0.00', '22.50', '2014-09-25', '2014-10-25', NULL, NULL, 'Invested', NULL, '2014-09-25 03:18:19', '2014-09-25 03:18:19', NULL, NULL),
(24, 'PARKST-INV-0024', 3, 1, NULL, '566.00', 19, '0.00', '580.15', '0.00', '0.00', '14.15', '2014-09-25', '2014-10-25', NULL, NULL, 'Invested', NULL, '2014-09-25 09:34:48', '2014-09-25 09:34:48', NULL, NULL),
(25, 'PARKST-INV-0025', 3, 1, NULL, '1000.00', 19, '0.00', '1025.00', '0.00', '0.00', '25.00', '2014-09-25', '2014-10-25', NULL, NULL, 'Invested', NULL, '2014-09-25 10:01:56', '2014-09-25 10:01:56', NULL, NULL),
(26, 'PARKST-INV-0026', 3, 1, NULL, '2100.00', 25, '0.00', '2415.00', '0.00', '0.00', '315.00', '2014-09-25', '2015-03-25', NULL, NULL, 'Invested', NULL, '2014-09-25 21:03:09', '2014-09-25 21:03:09', NULL, NULL),
(27, 'PARKST-INV-0027', 3, 1, NULL, '1000.00', 25, '0.00', '1150.00', '0.00', '0.00', '150.00', '2014-09-25', '2015-03-25', NULL, NULL, 'Invested', NULL, '2014-09-25 21:04:39', '2014-09-25 21:04:39', NULL, NULL),
(28, 'PARKST-INV-0028', 2, 1, NULL, '100.00', 19, '0.00', '102.50', '0.00', '0.00', '2.50', '2006-07-18', '2006-08-18', NULL, NULL, 'Invested', NULL, '2014-09-26 04:19:54', '2014-09-26 04:19:54', NULL, NULL),
(29, 'PARKST-INV-0029', 2, 1, NULL, '500.00', 23, '0.00', '550.00', '0.00', '0.00', '50.00', '2011-08-22', '2011-12-22', NULL, NULL, 'Invested', NULL, '2014-09-26 04:31:17', '2014-09-26 04:31:17', NULL, NULL),
(30, 'PARKST-INV-0030', 3, 1, NULL, '89.00', 19, '0.00', '91.23', '0.00', '0.00', '2.23', '2014-09-29', '2014-10-29', NULL, NULL, 'Invested', NULL, '2014-09-29 05:32:46', '2014-09-29 05:32:46', NULL, NULL),
(31, 'PARKST-INV-0031', 3, 1, NULL, '4556.00', 33, '0.00', '4556.00', '0.00', '0.00', '0.00', '2014-10-04', '2014-11-04', NULL, NULL, 'Invested', NULL, '2014-10-04 20:04:40', '2014-10-04 20:04:40', NULL, NULL),
(32, 'PARKST-INV-0032', 1, 1, NULL, '1222.00', 33, '0.00', '1222.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 21:58:07', '2014-10-09 21:58:07', NULL, NULL),
(33, 'PARKST-INV-0033', 3, 1, NULL, '29700.00', 33, '0.00', '29700.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:03:02', '2014-10-09 22:03:02', NULL, NULL),
(34, 'PARKST-INV-0034', 3, 1, NULL, '6000.00', 33, '0.00', '6000.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:03:54', '2014-10-09 22:03:54', NULL, NULL),
(35, 'PARKST-INV-0035', 3, 1, NULL, '233.00', 33, '0.00', '233.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:07:44', '2014-10-09 22:07:44', NULL, NULL),
(36, 'PARKST-INV-0036', 3, 1, NULL, '234.00', 33, '0.00', '234.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:08:22', '2014-10-09 22:08:22', NULL, NULL),
(37, 'PARKST-INV-0037', 3, 1, NULL, '233333.00', 33, '0.00', '233333.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:09:31', '2014-10-09 22:09:31', NULL, NULL),
(38, 'PARKST-INV-0038', 3, 1, NULL, '400.00', 33, '0.00', '400.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:10:46', '2014-10-09 22:10:46', NULL, NULL),
(39, 'PARKST-INV-0039', 3, 1, NULL, '343434.00', 33, '0.00', '343434.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:13:23', '2014-10-09 22:13:23', NULL, NULL),
(40, 'PARKST-INV-0040', 3, 1, NULL, '222.00', 33, '0.00', '222.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:14:38', '2014-10-09 22:14:38', NULL, NULL),
(41, 'PARKST-INV-0041', 3, 1, NULL, '400.00', 33, '0.00', '400.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:16:28', '2014-10-09 22:16:28', NULL, NULL),
(42, 'PARKST-INV-0042', 3, 1, NULL, '900.00', 33, '0.00', '900.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:17:06', '2014-10-09 22:17:06', NULL, NULL),
(43, 'PARKST-INV-0043', 3, 1, NULL, '333.00', 33, '0.00', '333.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:19:46', '2014-10-09 22:19:46', NULL, NULL),
(44, 'PARKST-INV-0044', 4, 1, NULL, '555.00', 33, '0.00', '555.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:22:44', '2014-10-09 22:22:44', NULL, NULL),
(45, 'PARKST-INV-0045', 4, 1, NULL, '333.00', 33, '0.00', '333.00', '0.00', '0.00', '0.00', '2014-10-09', '2014-11-09', NULL, NULL, 'Invested', NULL, '2014-10-09 22:23:38', '2014-10-09 22:23:38', NULL, NULL),
(46, 'PARKST-INV-0046', 1, 1, NULL, '2000.00', 33, '0.00', '2000.00', '0.00', '0.00', '0.00', '2014-10-13', '2014-11-13', NULL, NULL, 'Invested', NULL, '2014-10-13 07:56:04', '2014-10-13 07:56:04', NULL, NULL),
(47, 'PARKST-INV-0047', 1, 1, NULL, '1666.00', 33, '0.00', '1666.00', '0.00', '0.00', '0.00', '2014-10-13', '2014-11-13', NULL, NULL, 'Invested', NULL, '2014-10-13 14:36:41', '2014-10-13 14:36:42', NULL, NULL),
(48, 'PARKST-INV-0048', 1, 1, NULL, '500.00', 33, '0.00', '500.00', '0.00', '0.00', '0.00', '2014-10-13', '2014-11-13', NULL, NULL, 'Invested', NULL, '2014-10-13 14:45:55', '2014-10-13 14:45:55', NULL, NULL),
(49, 'PARKST-INV-0049', 1, 1, NULL, '10000.00', 33, '0.00', '10000.00', '0.00', '0.00', '0.00', '2014-10-13', '2014-11-13', NULL, NULL, 'Invested', NULL, '2014-10-13 14:55:50', '2014-10-13 14:55:50', NULL, NULL),
(50, 'PARKST-INV-0050', 1, 1, NULL, '20000.00', 33, '0.00', '20000.00', '0.00', '0.00', '0.00', '2014-10-13', '2014-11-13', NULL, NULL, 'Invested', NULL, '2014-10-13 14:56:55', '2014-10-13 14:56:55', NULL, NULL),
(51, 'PARKST-INV-0051', 1, 1, NULL, '20000.00', 33, '0.00', '20000.00', '0.00', '0.00', '0.00', '2014-10-13', '2014-11-13', NULL, NULL, 'Invested', NULL, '2014-10-13 14:59:20', '2014-10-13 14:59:20', NULL, NULL),
(52, 'PARKST-INV-0052', 1, 1, NULL, '20000.00', 33, '0.00', '20000.00', '0.00', '0.00', '0.00', '2014-10-13', '2014-11-13', NULL, NULL, 'Invested', NULL, '2014-10-13 14:59:52', '2014-10-13 14:59:52', NULL, NULL),
(53, 'PARKST-INV-0053', 1, 1, NULL, '20000.00', 33, '0.00', '20000.00', '0.00', '0.00', '0.00', '2014-10-13', '2014-11-13', NULL, NULL, 'Invested', NULL, '2014-10-13 15:00:35', '2014-10-13 15:00:35', NULL, NULL),
(54, 'PARKST-INV-0054', 1, 1, NULL, '24444.00', 33, '0.00', '24444.00', '0.00', '0.00', '0.00', '2014-10-13', '2014-11-13', NULL, NULL, 'Invested', NULL, '2014-10-13 15:01:24', '2014-10-13 15:01:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investor_types`
--

CREATE TABLE IF NOT EXISTS `investor_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `investor_type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `investor_types`
--

INSERT INTO `investor_types` (`id`, `investor_type`) VALUES
(1, '-Select-'),
(2, 'Individual'),
(3, 'Grp/Joint'),
(4, 'Corporate');

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
  `gifts_inheritance` decimal(11,2) DEFAULT '0.00',
  `registration_date` date DEFAULT NULL,
  `investor_photo` blob,
  `surname` varchar(20) NOT NULL,
  `other_names` varchar(35) NOT NULL,
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
  `personal_savings` decimal(11,2) DEFAULT '0.00',
  `salary` decimal(11,2) DEFAULT '0.00',
  `nk_relationship` varchar(25) NOT NULL,
  `postal_address` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(35) DEFAULT NULL,
  `physical_address` varchar(70) DEFAULT NULL,
  `gross_income_id` int(3) DEFAULT NULL,
  `next_of_kin_name` varchar(50) DEFAULT NULL,
  `nk_phone` varchar(15) DEFAULT NULL,
  `nk_postal_address` varchar(50) DEFAULT NULL,
  `nk_email` varchar(35) DEFAULT NULL,
  `income_other` decimal(11,2) DEFAULT '0.00',
  `investor_signature` blob,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `visible` enum('alive','deleted') DEFAULT 'alive',
  PRIMARY KEY (`id`),
  KEY `surname` (`surname`),
  KEY `other_names` (`other_names`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` (`id`, `user_id`, `entryclerk_name`, `customer_category_id`, `investor_type_id`, `payment_term_id`, `payment_shedule_id`, `payment_mode_id`, `in_trust_for`, `occupation`, `id_expiry`, `id_issue`, `gifts_inheritance`, `registration_date`, `investor_photo`, `surname`, `other_names`, `fullname`, `dob`, `idtype_id`, `id_number`, `nationality`, `hometown`, `birth_place`, `work_place`, `position_held`, `marital_status`, `children`, `personal_savings`, `salary`, `nk_relationship`, `postal_address`, `phone`, `email`, `physical_address`, `gross_income_id`, `next_of_kin_name`, `nk_phone`, `nk_postal_address`, `nk_email`, `income_other`, `investor_signature`, `created`, `modified`, `visible`) VALUES
(1, 15, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '2014-04-21', 0x2f66696c65732f75706c6f6164732f447a6966612d70686f746f2d313936372d30342d32312e706e67, 'Dzifa', '', 'Ama Dzifa', '1967-04-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '0.00', '0.00', '00-GHADEN-789', '', '0243080560', 'me@you.com', 'Apaloo Crescent', NULL, 'Maame Esi Sam', '0249896120', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'alive'),
(2, 18, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '2014-04-22', 0x2f66696c65732f75706c6f6164732f4779616d66692d70686f746f2d323031322d30342d32322e6a7067, 'Gyamfi', '', 'kwaku Gyamfi', '2012-04-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '0.00', '0.00', '44rr', '', '0243080560', 'me@you.com', 'Apaloo Crescent', NULL, 'Maame Esi Sam', '0249896120', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'alive'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '2014-09-22', NULL, 'Otchere', 'Benjamin Kwame Inkoom', 'Benjamin Kwame Inkoom Otchere', '1967-09-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '0.00', '0.00', 'Brother-in-law', 'PMB L75 Legon', '+88435765987', 'ben@live.com', 'No 8 Downing Street London', NULL, 'Charles Inglebert Abesinada', '+233254890543', 'P.O. Box S345 Sakumono', 'charles@gmail.com', '0.00', NULL, '2014-09-22 05:07:39', '2014-09-22 05:07:39', 'alive'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '2014-09-22', NULL, 'test', 'test', 'test test', '2014-09-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '0.00', '0.00', 'test', 'test', '0243080560', 'test@gmail.com', 'test', NULL, 'test', 'test', 'test', 'test', '0.00', NULL, '2014-09-22 05:13:13', '2014-09-22 05:13:13', 'alive');

-- --------------------------------------------------------

--
-- Table structure for table `invoiceold_editions`
--

CREATE TABLE IF NOT EXISTS `invoiceold_editions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `custom_rate` decimal(3,3) DEFAULT NULL,
  `discount` decimal(3,3) NOT NULL DEFAULT '0.000',
  `zone_id` int(11) DEFAULT NULL,
  `balance` decimal(11,2) DEFAULT NULL,
  `mthly_install` decimal(11,2) DEFAULT NULL,
  `payment_term` varchar(20) DEFAULT NULL,
  `hp_price` decimal(11,2) NOT NULL,
  `rate_id` int(11) DEFAULT NULL,
  `tax_charge` int(3) DEFAULT NULL,
  `cash_price` int(11) DEFAULT NULL,
  `last_date` date DEFAULT NULL,
  `payment_mode` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_date` date DEFAULT NULL,
  `delivery_date` int(11) DEFAULT NULL,
  `invoice_decision_date` date DEFAULT NULL,
  `customer_id` int(9) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `work_place` varchar(50) DEFAULT NULL,
  `category` varchar(10) DEFAULT NULL,
  `sales_person` varchar(50) DEFAULT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `cash_price` int(11) NOT NULL,
  `interest_rate` decimal(3,3) DEFAULT NULL,
  `payment_mode` varchar(15) DEFAULT NULL,
  `payment_term` varchar(20) DEFAULT NULL,
  `quantity` int(3) DEFAULT NULL,
  `tax_charge` int(3) DEFAULT NULL,
  `hp_price` decimal(11,2) NOT NULL,
  `mthly_install` decimal(11,2) NOT NULL,
  `discount` int(3) NOT NULL DEFAULT '0',
  `approved` int(1) NOT NULL DEFAULT '0',
  `status` enum('Pending Approval','Rejected','Approved','Deleted') NOT NULL DEFAULT 'Pending Approval',
  `delivery` enum('No','Warehouse Processing','En-route','Delivered') NOT NULL DEFAULT 'No',
  `invoice_no` varchar(15) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `first_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_person` (`sales_person`),
  KEY `invoice_number` (`invoice_no`,`due_date`,`first_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `invoice_decision_date` date DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `work_place` varchar(50) DEFAULT NULL,
  `category` varchar(10) DEFAULT NULL,
  `sales_person` varchar(50) DEFAULT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `cash_price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `payment_mode` varchar(15) DEFAULT NULL,
  `payment_term` varchar(20) DEFAULT NULL,
  `rate_id` int(11) DEFAULT NULL,
  `custom_rate` int(3) DEFAULT NULL,
  `quantity` int(3) NOT NULL,
  `tax_charge` int(3) DEFAULT NULL,
  `hp_price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `mthly_install` decimal(11,2) NOT NULL,
  `discount` decimal(3,2) DEFAULT '0.00',
  `amount_paid` decimal(11,2) NOT NULL,
  `balance` decimal(11,2) NOT NULL,
  `differencefrmexpected` int(11) DEFAULT '0',
  `interest_accrued` decimal(11,2) NOT NULL DEFAULT '0.00',
  `cheque_nos` varchar(400) DEFAULT NULL,
  `used_chequenos` varchar(400) DEFAULT NULL,
  `payment_status` enum('no_payment','part_payment','full_payment','expired') NOT NULL DEFAULT 'no_payment',
  `approved` int(1) NOT NULL DEFAULT '0',
  `status` enum('Pending Approval','Rejected','Approved','Deleted','Repossesed') NOT NULL DEFAULT 'Pending Approval',
  `delivery` enum('No','Warehouse Processing','En-route','Delivered') NOT NULL DEFAULT 'No',
  `invoice_no` varchar(15) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `previouspayment_date` date DEFAULT NULL,
  `payment_finish_date` date DEFAULT NULL,
  `first_date` date DEFAULT NULL,
  `last_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_person` (`sales_person`),
  KEY `invoice_number` (`invoice_no`,`due_date`,`first_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE IF NOT EXISTS `orders_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reimbursement` decimal(11,2) DEFAULT '0.00',
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `repossed` enum('Yes','No','Pending Repossession') NOT NULL DEFAULT 'No',
  `pending_repossed` enum('Yes','No') NOT NULL DEFAULT 'No',
  `quantity` int(11) NOT NULL,
  `qty_stock` int(11) NOT NULL,
  `cost_price` decimal(18,2) NOT NULL,
  `unit_price` decimal(18,2) NOT NULL,
  `hp_price` decimal(18,2) NOT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_modes`
--

CREATE TABLE IF NOT EXISTS `payment_modes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `payment_mode_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment_modes`
--

INSERT INTO `payment_modes` (`id`, `payment_mode_name`) VALUES
(1, 'Cheque'),
(2, 'Bank transfer');

-- --------------------------------------------------------

--
-- Table structure for table `payment_schedules`
--

CREATE TABLE IF NOT EXISTS `payment_schedules` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `payment_schedule_name` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payment_schedules`
--

INSERT INTO `payment_schedules` (`id`, `payment_schedule_name`) VALUES
(1, 'Semi-annually'),
(2, 'Annually'),
(3, 'Depending on investment product');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `pettycash_deposits`
--

INSERT INTO `pettycash_deposits` (`id`, `pettycash_id`, `cash_account_id`, `created_by`, `created`, `amount`, `zone_id`) VALUES
(15, 4, NULL, NULL, '2014-04-03 08:40:52', '10.00', NULL),
(16, 4, NULL, NULL, '2014-04-03 08:41:26', '10.00', NULL),
(17, 4, NULL, NULL, '2014-04-03 08:45:35', '10.00', NULL),
(18, 4, NULL, NULL, '2014-04-07 02:39:46', '80.00', NULL),
(19, 5, NULL, NULL, '2014-04-09 09:57:47', '121.00', NULL),
(20, 5, NULL, NULL, '2014-04-09 10:04:46', '200.00', NULL),
(21, 6, NULL, NULL, '2014-04-11 05:16:15', '200.00', NULL),
(22, 7, NULL, NULL, '2014-08-27 00:10:45', '500.00', 18);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pettycash_withdrawals`
--

INSERT INTO `pettycash_withdrawals` (`id`, `pettycash_id`, `cash_account_id`, `zone_id`, `amount`, `created_by`, `created`) VALUES
(1, 6, 55, NULL, '10.00', NULL, '2014-04-15 11:47:22'),
(2, 6, 65, NULL, '20.00', NULL, '2014-04-25 12:29:35'),
(3, 6, 66, NULL, '80.00', NULL, '2014-04-25 12:29:40'),
(4, 6, 67, NULL, '20.00', NULL, '2014-04-25 12:30:05'),
(5, 6, 68, NULL, '10.00', NULL, '2014-04-25 12:30:52'),
(6, 7, 5, 18, '60.00', NULL, '2014-08-27 00:13:25'),
(7, 7, 6, 18, '100.00', NULL, '2014-09-01 22:04:39');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pettycashes`
--

INSERT INTO `pettycashes` (`id`, `amount`, `balance`, `created`, `created_by`, `modified`, `modified_by`, `zone_id`) VALUES
(4, '110.00', '60.00', '2014-04-03 08:40:52', 0, '2014-08-26 22:41:53', 0, NULL),
(5, '321.00', '-36.00', '2014-04-09 09:57:47', 0, '2014-08-26 21:37:49', 0, NULL),
(6, '200.00', '60.00', '2014-04-11 05:16:15', 0, '2014-04-25 12:30:52', 0, NULL),
(7, '500.00', '340.00', '2014-08-27 00:10:45', 0, '2014-09-01 22:04:39', 0, 18);

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
-- Table structure for table `reinvestments`
--

CREATE TABLE IF NOT EXISTS `reinvestments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_no` varchar(20) DEFAULT NULL,
  `investor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `investment_amount` decimal(11,2) DEFAULT '0.00',
  `portfolio_id` int(11) DEFAULT NULL,
  `custom_rate` decimal(3,2) DEFAULT '0.00',
  `amount_due` decimal(11,2) DEFAULT '0.00',
  `amount_paidout` decimal(11,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(11,2) NOT NULL DEFAULT '0.00',
  `interest_earned` decimal(11,2) DEFAULT '0.00',
  `investment_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `lastpaidout_date` date DEFAULT NULL,
  `details` varchar(200) DEFAULT NULL,
  `status` enum('Paid','Rolled_over','Cancelled','Part_payment','Invested') DEFAULT 'Invested',
  `old_status` enum('Paid','Rolled_over','Cancelled','Part_payment','Invested') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `reinvestments`
--

INSERT INTO `reinvestments` (`id`, `investment_no`, `investor_id`, `user_id`, `currency_id`, `investment_amount`, `portfolio_id`, `custom_rate`, `amount_due`, `amount_paidout`, `balance`, `interest_earned`, `investment_date`, `due_date`, `lastpaidout_date`, `details`, `status`, `old_status`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, NULL, 1, 39, NULL, '100.00', 27, '0.00', '172.80', '0.00', '0.00', '28.80', '2014-05-09', '1971-05-01', NULL, NULL, 'Rolled_over', 'Cancelled', '2014-05-09 23:52:16', '2014-09-25 04:49:37', NULL, NULL);

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
  `amount` decimal(11,2) DEFAULT '0.00',
  `created` datetime NOT NULL,
  `rollover_date` date DEFAULT NULL,
  `delete_status` enum('dead','alive') DEFAULT 'alive',
  `deleted_by` varchar(200) DEFAULT NULL,
  `edit_details_username_oldnnewamout` varchar(200) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `rollovers`
--

INSERT INTO `rollovers` (`id`, `investment_id`, `investor_id`, `user_id`, `amount`, `created`, `rollover_date`, `delete_status`, `deleted_by`, `edit_details_username_oldnnewamout`, `modified`) VALUES
(1, 14, 1, 39, '144.00', '2014-09-09 20:32:33', '1971-05-01', 'alive', NULL, NULL, '2014-09-25 04:49:37'),
(2, 14, 2, 39, '600.00', '2014-09-09 20:42:18', '2015-09-23', 'alive', NULL, NULL, NULL),
(3, 14, 2, 39, '600.00', '2014-09-09 20:48:58', '2015-09-23', 'alive', NULL, NULL, NULL),
(6, NULL, 1, 39, '110.00', '2014-09-26 04:44:56', '2015-01-10', 'alive', NULL, NULL, '2014-09-26 04:44:56'),
(7, NULL, 1, 39, '110.00', '2014-09-26 04:47:30', '2015-01-10', 'alive', NULL, NULL, '2014-09-26 04:47:30'),
(13, NULL, 2, 39, '735.00', '2014-09-09 21:02:35', '2015-11-23', 'alive', NULL, NULL, NULL),
(14, NULL, 2, 39, '1036.80', '2014-09-09 20:51:08', '2017-09-23', 'alive', NULL, NULL, '2014-09-25 21:13:34'),
(15, NULL, 2, 39, '440.00', '2014-09-09 20:52:24', '2015-01-29', 'alive', NULL, NULL, NULL),
(19, NULL, 2, 39, '1562.50', '2014-09-12 00:06:49', '2017-03-11', 'alive', NULL, NULL, '2014-09-12 00:08:10'),
(21, NULL, 2, 39, '1562.50', '2014-09-12 00:01:05', '2017-03-11', 'alive', NULL, NULL, '2014-09-23 07:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sales_person` varchar(50) DEFAULT NULL,
  `total_cost` decimal(18,2) NOT NULL,
  `amount_paid` decimal(18,2) NOT NULL,
  `balance` decimal(18,2) NOT NULL,
  `tax_charge` decimal(11,2) NOT NULL DEFAULT '0.00',
  `status` enum('alive','deleted') DEFAULT 'alive',
  `payment_status` varchar(20) NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE IF NOT EXISTS `sales_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `cost_price` decimal(18,2) NOT NULL,
  `unit_price` decimal(18,2) NOT NULL,
  `hp_price` decimal(18,2) NOT NULL,
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
  `accounting_month` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `currency_id`, `company_name`, `owner_name`, `location`, `postal_address`, `postal_town_suburb`, `postal_city`, `postal_country`, `telephone`, `mobile`, `email`, `accounting_month`) VALUES
(1, 1, 'PARKSTONE CAPITAL LIMITED', 'Elsie', 'Accra', ' P.O. Box CS 9161', 'Adjirigano', 'Accra', 'Ghana', '0202088130', '0244327219', 'info@parkstonecapital.com', '2012-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(200) NOT NULL,
  `item_type` varchar(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `original_quantity` int(11) NOT NULL DEFAULT '0',
  `remaining_quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `item`, `item_type`, `supplier_id`, `cost_price`, `selling_price`, `original_quantity`, `remaining_quantity`) VALUES
(1, 'test', '0', 18, 200, 300, 290, 290);

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
-- Table structure for table `temp_sales`
--

CREATE TABLE IF NOT EXISTS `temp_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sales_person` varchar(50) DEFAULT NULL,
  `selling_price` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tempcash_accounts`
--

CREATE TABLE IF NOT EXISTS `tempcash_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) DEFAULT NULL,
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
  KEY `expense_name` (`expense_id`,`expense_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tempcash_accounts`
--

INSERT INTO `tempcash_accounts` (`id`, `expense_id`, `user_id`, `zone_id`, `expense_type`, `expense_desc`, `expense_date`, `source`, `amount`, `prepared_by`, `paid_to`, `remarks`, `status`) VALUES
(1, 6, 41, 8, 0, '0', '2014-04-02', '0', '-10.00', 'Serracou.jacinta', 'ADIABU FRANCIS', 'FUEL FOR CASHIER', 'Approved'),
(2, 20, 41, 8, 0, '0', '2014-04-11', '0', '-5.00', 'Serracou.jacinta', 'ADIABU FRANCIS', 'DELIVERY OF FRIDGE REPLACEMENT', 'Pending'),
(3, 7, 41, 8, 0, '0', '2014-04-11', '0', '-10.00', 'Serracou.jacinta', 'ADIABU FRANCIS', 'ENGINE OIL', 'Approved'),
(4, 29, 41, 8, 0, '1', '2014-04-11', '0', '-4.00', 'Serracou.jacinta', 'ADIABU FRANCIS', 'TRANSPORTATION TO KPANDO ', 'Pending'),
(5, 29, 41, 8, 0, '1', '2014-04-12', '0', '-8.00', 'Serracou.jacinta', 'SERRACOU JACINTA', 'SENDING ITEM TO HO', 'Pending'),
(6, 6, 41, 8, 0, '0', '2014-04-14', '0', '-20.00', 'Serracou.jacinta', 'ADIABU FRANCIS', 'FUEL FOR FRANCIS', 'Approved'),
(7, 34, 41, 8, 0, '1', '2014-04-15', '0', '-50.00', 'Serracou.jacinta', 'SHOWROOM-HOHOE', 'PREPAID FOR SHOWROOM\r\n', 'Rejected'),
(8, 32, 41, 8, 0, '1', '2014-04-16', '0', '-80.00', 'Serracou.jacinta', 'MUNICIPAL ASSEMBLY', 'OPERATION PAYMENT', 'Approved'),
(9, 6, 41, 8, 0, '0', '2014-04-23', '0', '-20.00', 'Serracou.jacinta', 'ADIABU FRANCIS', 'FUEL FOR FRANCIS', 'Approved'),
(10, 27, 41, 8, 0, '0', '2014-04-25', '0', '-3.00', 'Serracou.jacinta', 'SHOWROOM-HOHOE', 'TO BUY SOLUTIONTAPE', 'Rejected'),
(11, 1, NULL, 18, 0, '0', '2014-05-20', '0', '-100.00', 'Showroom', 'support', 'test', 'Pending'),
(12, 1, NULL, 18, 0, '0', '2014-05-20', '0', '-100.00', 'Showroom', 'support', 'test', 'Pending'),
(13, 1, NULL, 18, 0, '0', '2014-05-20', '0', '-100.00', 'Showroom', 'support', 'test', 'Approved'),
(14, 6, NULL, 18, 0, '1', '2014-08-27', '0', '-60.00', 'Test_sales', 'support', 'hh', 'Approved');

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
(7, 'DELIVERY DEPARTMENT'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userdepartment_id`, `username`, `password`, `firstname`, `lastname`, `usertype_id`, `email`, `date`) VALUES
(10, 6, 'ASIEDU.SAMUEL', 'd64c09f2046952119d1a789c8c148c7b', 'SAMUEL', 'ASIEDU NTOW', 8, NULL, '2013-03-11 18:12:54'),
(12, 6, 'AMENTOR.TITUS', '3d436dc71f63bbcc9eec801654ea4b4a', 'AMENTOR', 'TITUS', 4, NULL, '2013-03-11 18:18:29'),
(14, 6, 'DZEFE.VINCENT', 'd41d8cd98f00b204e9800998ecf8427e', 'VINCENT', 'DZEFE', 4, NULL, '2013-03-11 18:23:06'),
(18, 6, 'KWAKYE.MARY', '2d2e4115857e860bf65372cd05a494bb', 'KWAKYE', 'MARY', 4, NULL, '2013-03-11 18:32:10'),
(22, 6, 'YEKPLE.WISDOM', '0c7de33da2eb283d3fd7a31e6550ca90', 'WISDOM', 'YEKPLE', 4, NULL, '2013-03-11 18:45:34'),
(24, 6, 'ZIGAH.SAMUEL', 'd94f0eb9de48a903df6a457bfacf81a7', 'SAMUEL', 'ZIGAH', 4, NULL, '2013-03-11 18:46:13'),
(26, 6, 'ANKU.EDWARD', 'd41d8cd98f00b204e9800998ecf8427e', 'EDWARD', 'ANKU', 4, NULL, '2013-03-11 18:56:18'),
(27, 8, 'dominic', 'e16de995344277381c0727c5f0a11b6a', 'DOMINIC', 'ANYASOR', 1, NULL, '2013-03-11 18:57:20'),
(28, 5, 'MENSAH.ABRAHAM', '16c7d319a8d442f6900e2f99124edac9', 'ABRAHAM', 'MENSAH', 6, NULL, '2013-03-11 19:01:58'),
(29, 5, 'QUARSHIE.BRIGHT', 'e846cf3bded18115ede8370c0c6549f4', 'BRIGHT', 'QUARSHIE', 6, NULL, '2013-03-11 19:02:58'),
(30, 5, 'WAGBIL.IDDRISU', 'f5c93f0f242de94019333d46926f9007', 'IDDRISU', 'WAGBIL', 6, NULL, '2013-03-11 19:04:04'),
(32, 5, 'KONTOR.WISDOM', 'd41d8cd98f00b204e9800998ecf8427e', 'WISDOM', 'KONTOR', 6, NULL, '2013-03-11 19:05:54'),
(34, 6, 'SHOWROOM.ACCRA', 'a5974c2c22ac82ab8a985cdfb52f047b', 'ACCRA', 'SHOWROOM', 4, NULL, '2013-03-11 19:07:45'),
(35, 6, 'SHOWROOM.HO', 'f32e0b2c54d86d4af8c39b266ec0e5e2', 'HO', 'SHOWROOM', 4, NULL, '2013-03-11 19:08:17'),
(36, 6, 'SHOWROOM.HOHOE', '8a75452c846e5eb067a846ec97d5b2ae', 'HOHOE', 'SHOWROOM', 4, NULL, '2013-03-11 19:12:08'),
(38, 6, 'SHOWROOM.NKWANTA', 'e2c49f3db0c990ae305b1c4f206062aa', 'NKWANTA', 'SHOWROOM', 4, NULL, '2013-03-11 19:13:41'),
(39, 3, 'support', 'ccbd43e44efec3dd62688e50cf8f0485', 'Qwick', 'Fusion', 1, NULL, '2013-03-12 00:45:42'),
(41, 8, 'amadzifa', '0765f966655bc412161b5b7d94611fb3', 'dzifa', 'anyasor', 1, NULL, '2013-03-13 09:06:20'),
(44, 8, 'MANAGEMENT SALES', '9fb500f0d3b5a752568335649787cf4e', 'MANAGEMENT', 'SALES', 4, NULL, '2013-03-17 12:55:51'),
(49, 6, 'OKRAH.RAYMOND', 'daf3958565ad7f2e725c8467c08a4a87', 'RAYMOND', 'OKRAH', 4, NULL, '2013-03-17 17:51:40'),
(52, 6, 'ATUAHENE.FAUSTINA', 'ed4cc160202d72e4c50ff5693c683694', 'FAUSTINA', 'ATAUAHENE', 3, NULL, '2013-03-20 09:18:43'),
(57, 6, 'ANYASOR.COMFORT', '4ec3990831017d61281d26a851f16ca3', 'COMFORT', 'ANYASOR', 3, NULL, '2013-03-20 09:24:24'),
(59, 6, 'SORKPAH.AMINA', 'aca7bc2e2a051eef2d812565f03ecdd2', 'AMINA', 'SORKPAH', 3, NULL, '2013-03-20 09:25:38'),
(61, 6, 'WORNAGLO.INNOCENT', '1ee813abc143e57312e895a9c16d91b4', 'INNOCENT', 'WORNAGLO', 4, NULL, '2013-03-27 16:12:52'),
(63, 6, 'SALES.HO', 'd41d8cd98f00b204e9800998ecf8427e', 'SALES', 'HO', 6, NULL, '2013-03-28 07:54:04'),
(64, 6, 'SALES.ACCRA', '6eaac4e77743bc4a502187bb46d7fbd5', 'SALES', 'ACCRA', 6, NULL, '2013-03-28 07:55:02'),
(65, 6, 'SALES.HOHOE', '7a8ccb9e818c9f3953c62d5c296e6387', 'SALES', 'HOHOE', 6, NULL, '2013-03-28 07:55:58'),
(68, 6, 'SALES.NKAWKAW', '440abd18fcb6f83adef30b56ef170f90', 'SALES', 'NKAWKAW', 6, NULL, '2013-03-28 07:57:11'),
(70, 5, 'AGYAPONG.LOUIS', '4a7a69a86247211055d70a9466cfbd22', 'LOUIS', 'AGYAPONG', 6, NULL, '2013-04-01 14:11:36'),
(71, 6, 'AZIMEY.VIDA', '1ae0050f443de17fc009150421e203e5', 'VIDA', 'AZIMEY', 3, NULL, '2013-04-08 13:28:45'),
(72, 6, 'NAA.YUSH', 'a3ac7b591dd17cf73c9db4d00e968259', 'YUSHAWU', 'SALIFU', 8, NULL, '2013-04-08 13:38:00'),
(73, 5, 'POSTDATED.CHEQUES', 'fdb671f0f350c17f73cebbf96bc9a55a', 'POSTDATED', 'CHEQUES', 6, NULL, '2013-04-11 12:53:01'),
(76, 6, 'NELSON COFIE.LESLIE', '592b4144dbff270319557dee49cc46fb', 'LESLIE', 'NELSON COFFIE', 8, NULL, '2013-04-15 09:37:06'),
(77, 6, 'YEKPLE, TITUS & VINCENT', '3e90870d028d574462733a6bc766f038', 'YEKPLE, TITUS', 'VINCENT', 4, NULL, '2013-04-26 08:34:32'),
(78, 5, 'DIRECT TRANSFER', '3646bf7e696ad834ce2df22a634bc57f', 'DIRECT', 'TRANSFER', 6, NULL, '2013-04-26 14:19:48'),
(81, 5, 'MOBILE.MONEY', 'f26d05aa8628d8721278d3e11c034705', 'MOBILE', 'MONEY', 6, NULL, '2013-05-13 18:58:39'),
(86, 9, 'test_cashier', 'ccbd43e44efec3dd62688e50cf8f0485', 'Qwicfusion', 'Support', 6, NULL, '2013-06-08 14:44:44'),
(87, 9, 'test_sales', 'e16631ae93116cb783a4683feff2af3b', 'Qwicfusion', 'support', 4, '', '2013-06-08 16:01:54'),
(88, 5, 'OPERATIONS.MANAGER', 'f2d88d1d04eaa85011b8f5640897b2d8', 'OPERATIONS', 'MANAGER', 6, NULL, '2013-06-15 10:22:36'),
(92, 5, 'DELIVERY.TEAM', 'df9e5532fa6d1523c54629e9d300e56a', 'DELIVERY', 'TEAM', 6, NULL, '2013-08-30 12:45:17'),
(94, 6, 'AMPADU.EBENEZAR', '3a2ece7c06b9ed867800871f8d7cc628', 'AMPADU', 'EBENEZAR', 4, NULL, '2013-10-03 10:06:13'),
(95, 6, 'ABOAGYE.SAMUEL', '2d7c70afc6d294f3f130d93883b0ea37', 'ABOAGYE', 'SAMUEL', 4, NULL, '2013-10-03 10:06:46'),
(99, 6, 'ATITSOGBUI.PROSPER', 'bf655fe9a0acb038385db31db0a739ed', 'ATITSOGBUI', 'PROSPER', 4, NULL, '2013-10-24 17:10:45'),
(100, 6, 'AMENGONU.ISAAC', 'd7c5d9d1f5ea616fc54d7b0cd1846ff9', 'AMENGONU', 'ISAAC', 4, NULL, '2013-10-24 17:11:25'),
(101, 5, 'ADIABU.FRANCIS', '33167d4b8cc9562b9a56ae6fd6ac3b17', 'FRANCIS', 'ADIABU', 6, NULL, '2013-11-21 16:30:46'),
(102, 5, 'LOGODZO.WILLIAM', '65780868158db7e30eb0bfec71b3248f', 'WILLIAM', 'LOGODZO', 6, NULL, '2013-11-21 16:32:08'),
(103, 6, 'GAMENYO.MOSES', '3ae2630bcf8386937d888b09b873777e', 'MOSES', 'GAMENYO', 4, NULL, '2013-12-04 11:54:06'),
(104, 6, 'ASARE.ERIC', 'd332cf33939d5f3bcc1eaf4ac64aa2b0', 'ASARE', 'ERIC', 4, NULL, '2014-01-08 11:55:47'),
(107, 9, 'managertest', 'ccbd43e44efec3dd62688e50cf8f0485', 'Kwaku', 'Support', 8, NULL, '2014-01-09 23:16:09'),
(108, 6, 'SEDI.NAKI', '44f77dedd6ef2f928b061b67b3bccf94', 'SEDI.NAKI', 'SEDI.NAKI', 8, NULL, '2014-01-10 11:41:50'),
(109, 5, 'ENAM.AFI', 'dbdfdc6bbff9f762957dcd6582ef53c8', 'ENAM', 'AFI', 3, NULL, '2014-01-15 15:27:15'),
(111, 6, 'AKOE.DIVINE', 'e955e0b380a27ff7334d95917c9b2dcd', 'DIVINE', 'AKOE', 4, NULL, '2014-03-26 14:44:41'),
(112, 9, 'showroom', 'c3a59f2cb9b5b5ef18984f23ea69239c', 'showroom', 'showroom', 6, 'showroom', '2014-05-20 14:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE IF NOT EXISTS `usertypes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `usertype` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`id`, `usertype`) VALUES
(7, 'Administrator'),
(6, 'Field Cashiers'),
(8, 'Managers'),
(4, 'Sales Persons'),
(3, 'Showroom Executive'),
(1, 'Super Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse` varchar(30) DEFAULT NULL,
  `town` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `warehouse`, `town`, `address`) VALUES
(1, 'Headquarters', 'Accra', NULL),
(3, 'Nkawkaw', 'Nkawkaw', ''),
(4, 'MAIN-WAREHOUSE', 'ACCRA', 'HEAD-OFFICE'),
(5, 'Repossessed Items', '', '');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
