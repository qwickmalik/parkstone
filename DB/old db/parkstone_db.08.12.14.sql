-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2014 at 03:37 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

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
-- CREATE DATABASE IF NOT EXISTS `qwickfu1_parkst_inv` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `qwickfu1_parkst_inv`;

-- --------------------------------------------------------

--
-- Table structure for table `balance_sheets`
--

DROP TABLE IF EXISTS `balance_sheets`;
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
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
CREATE TABLE IF NOT EXISTS `banks` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(75) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `banks`
--

REPLACE INTO `banks` (`id`, `bank_name`, `created`) VALUES
(1, 'Access Bank', NULL),
(2, 'Agricultural Development Bank(ADB)', NULL),
(3, 'Barclays Bank of Ghana Ltd.', NULL),
(4, 'Banque Sahélo-Saharienne pour I’Investissement et le Commerce (BSIC Ghana L', NULL),
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
(27, 'Zenith Bank (Ghana) Limited', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cash_accounts`
--

DROP TABLE IF EXISTS `cash_accounts`;
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

DROP TABLE IF EXISTS `cash_flows`;
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

DROP TABLE IF EXISTS `clients`;
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

DROP TABLE IF EXISTS `closing_balances`;
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

DROP TABLE IF EXISTS `credit_payments`;
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

DROP TABLE IF EXISTS `creditors`;
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

DROP TABLE IF EXISTS `currencies`;
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

REPLACE INTO `currencies` (`id`, `currency_name`, `symbol`, `setting_id`) VALUES
(1, 'Ghana Cedi', 'GHS', 1),
(2, 'US Dollar', 'USD', 1),
(3, 'Pound Sterling', 'GBP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_categories`
--

DROP TABLE IF EXISTS `customer_categories`;
CREATE TABLE IF NOT EXISTS `customer_categories` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `customer_category` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customer_categories`
--

REPLACE INTO `customer_categories` (`id`, `customer_category`) VALUES
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

DROP TABLE IF EXISTS `customers`;
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

DROP TABLE IF EXISTS `daily_defaults`;
CREATE TABLE IF NOT EXISTS `daily_defaults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dashboards`
--

DROP TABLE IF EXISTS `dashboards`;
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

DROP TABLE IF EXISTS `debt_payments`;
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

REPLACE INTO `debt_payments` (`id`, `debt_id`, `sale_id`, `amount`, `date`) VALUES
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

DROP TABLE IF EXISTS `debtors`;
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

REPLACE INTO `debtors` (`id`, `client_id`, `sale_id`, `sale_date`, `total_cost`, `amount_paid`, `balance`) VALUES
(47, 20, 192, '2012-11-09 16:34:27', '675.00', '500.00', '175.00');

-- --------------------------------------------------------

--
-- Table structure for table `defaulting_rates`
--

DROP TABLE IF EXISTS `defaulting_rates`;
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

REPLACE INTO `defaulting_rates` (`id`, `monthly_rate`, `expired_rate`, `modified_date`) VALUES
(1, 10, 10, '2013-02-24 22:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `eods`
--

DROP TABLE IF EXISTS `eods`;
CREATE TABLE IF NOT EXISTS `eods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eod_date` date NOT NULL,
  `flag` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `eods`
--

REPLACE INTO `eods` (`id`, `eod_date`, `flag`) VALUES
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

DROP TABLE IF EXISTS `eoms`;
CREATE TABLE IF NOT EXISTS `eoms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` date DEFAULT NULL,
  `flag` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `eoms`
--

REPLACE INTO `eoms` (`id`, `year`, `flag`) VALUES
(1, '2014-03-16', 1),
(2, '2014-04-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `equities`
--

DROP TABLE IF EXISTS `equities`;
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

REPLACE INTO `equities` (`id`, `description`, `beginning_balance`, `Owner_Investment`, `revenue`, `expenditure`, `net_income`, `withdrawal`, `net_loss`, `balance_end`, `flag`, `date`) VALUES
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

DROP TABLE IF EXISTS `expectedinstallments`;
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

DROP TABLE IF EXISTS `expectedpayments`;
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

DROP TABLE IF EXISTS `expenditures`;
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

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `expenses`
--

REPLACE INTO `expenses` (`id`, `payment_name`) VALUES
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

DROP TABLE IF EXISTS `fixed_assets`;
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

DROP TABLE IF EXISTS `fixedasset_extras`;
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

DROP TABLE IF EXISTS `gross_incomes`;
CREATE TABLE IF NOT EXISTS `gross_incomes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `gross_income_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gross_incomes`
--

REPLACE INTO `gross_incomes` (`id`, `gross_income_name`) VALUES
(1, '-Select-'),
(2, 'Below GHC5,000'),
(3, 'GHC5,000-GHC100,000'),
(4, 'Above GHC100,000');

-- --------------------------------------------------------

--
-- Table structure for table `gross_revenues`
--

DROP TABLE IF EXISTS `gross_revenues`;
CREATE TABLE IF NOT EXISTS `gross_revenues` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `gross_revenue_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gross_revenues`
--

REPLACE INTO `gross_revenues` (`id`, `gross_revenue_name`) VALUES
(1, '-Select-'),
(2, 'Below GHC1M'),
(3, 'GHC1M - GHC10M'),
(4, 'Above GHC10M');

-- --------------------------------------------------------

--
-- Table structure for table `hirepurchases`
--

DROP TABLE IF EXISTS `hirepurchases`;
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

DROP TABLE IF EXISTS `idtypes`;
CREATE TABLE IF NOT EXISTS `idtypes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `idtypes`
--

REPLACE INTO `idtypes` (`id`, `id_type`) VALUES
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

DROP TABLE IF EXISTS `income_statements`;
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

REPLACE INTO `income_statements` (`id`, `sale_id`, `cash_account_id`, `description`, `revenue`, `expenditure`, `loancash`, `interest`, `actualinterest`, `saleofassets`, `proceedsonassets`, `taxpaid`, `net_income`, `flag`, `date`) VALUES
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
REPLACE INTO `income_statements` (`id`, `sale_id`, `cash_account_id`, `description`, `revenue`, `expenditure`, `loancash`, `interest`, `actualinterest`, `saleofassets`, `proceedsonassets`, `taxpaid`, `net_income`, `flag`, `date`) VALUES
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

DROP TABLE IF EXISTS `inst_types`;
CREATE TABLE IF NOT EXISTS `inst_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `inst_type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `inst_types`
--

REPLACE INTO `inst_types` (`id`, `inst_type_name`) VALUES
(1, '-Select-'),
(2, 'Local'),
(3, 'Foreign');

-- --------------------------------------------------------

--
-- Table structure for table `institution_types`
--

DROP TABLE IF EXISTS `institution_types`;
CREATE TABLE IF NOT EXISTS `institution_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `inst_type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `institution_types`
--

REPLACE INTO `institution_types` (`id`, `inst_type_name`) VALUES
(1, '-Select-'),
(2, 'Local'),
(3, 'Foreign');

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

DROP TABLE IF EXISTS `instructions`;
CREATE TABLE IF NOT EXISTS `instructions` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `instruction_name` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `instructions`
--

REPLACE INTO `instructions` (`id`, `instruction_name`) VALUES
(1, 'Pay interest'),
(2, 'Rollover principal & inte'),
(3, 'Rollover principal'),
(4, 'Rollover interest'),
(5, 'Other - provide details');

-- --------------------------------------------------------

--
-- Table structure for table `investees`
--

DROP TABLE IF EXISTS `investees`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `investees`
--

REPLACE INTO `investees` (`id`, `currency_id`, `company_name`, `manager_name`, `location`, `postal_address`, `postal_town_suburb`, `postal_city`, `postal_country`, `telephone`, `mobile`, `email`, `product1`, `product2`, `product3`, `product4`, `product5`, `product6`, `product7`, `product8`, `product9`) VALUES
(1, 1, 'Databank Financial Services Ltd.', 'Kojo Addae-Mensah', 'Accra', 'Private Mail Bag', ' Ministries Post Office', 'Accra', 'Ghana', '(233)(302) 610610', '', ' info@databankgroup.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investment_investors`
--

DROP TABLE IF EXISTS `investment_investors`;
CREATE TABLE IF NOT EXISTS `investment_investors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_id` int(11) DEFAULT NULL,
  `investor_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `investment_investors`
--

REPLACE INTO `investment_investors` (`id`, `investment_id`, `investor_id`, `created`, `modified`) VALUES
(1, 56, 4, '2014-10-24 20:04:36', '2014-10-24 20:04:36'),
(2, 57, 4, '2014-10-24 20:08:16', '2014-10-24 20:08:16'),
(3, 58, 4, '2014-10-24 20:09:44', '2014-10-24 20:09:44'),
(4, 59, 4, '2014-10-24 20:10:09', '2014-10-24 20:10:09'),
(5, 60, 4, '2014-10-24 20:14:51', '2014-10-24 20:14:51'),
(6, 61, 4, '2014-10-24 20:46:17', '2014-10-24 20:46:17'),
(7, 62, 2, '2014-10-24 20:47:16', '2014-10-24 20:47:16'),
(8, 62, 4, '2014-10-24 20:47:16', '2014-10-24 20:47:16'),
(9, 62, 1, '2014-10-24 20:47:16', '2014-10-24 20:47:16'),
(10, 63, 5, '2014-10-25 13:02:04', '2014-10-25 13:02:04'),
(11, 64, 4, '2014-10-25 13:29:04', '2014-10-25 13:29:04'),
(12, 64, 3, '2014-10-25 13:29:04', '2014-10-25 13:29:04'),
(13, 65, NULL, '2014-10-25 13:35:53', '2014-10-25 13:35:53'),
(14, 68, 5, '2014-10-25 13:46:22', '2014-10-25 13:46:22'),
(15, 69, 5, '2014-10-25 13:47:48', '2014-10-25 13:47:48'),
(16, 70, 5, '2014-10-25 13:49:55', '2014-10-25 13:49:55'),
(17, 71, 5, '2014-10-25 13:51:16', '2014-10-25 13:51:16'),
(18, 72, 5, '2014-10-25 13:53:11', '2014-10-25 13:53:11'),
(19, 73, 5, '2014-10-25 13:55:03', '2014-10-25 13:55:03'),
(20, 74, 3, '2014-10-27 10:16:46', '2014-10-27 10:16:46'),
(21, 75, 3, '2014-10-27 12:01:18', '2014-10-27 12:01:18'),
(22, 76, 4, '2014-10-27 12:15:30', '2014-10-27 12:15:30'),
(23, 77, 3, '2014-10-27 12:18:41', '2014-10-27 12:18:41'),
(24, 78, 3, '2014-10-27 12:21:38', '2014-10-27 12:21:38'),
(25, 79, 3, '2014-10-27 12:50:52', '2014-10-27 12:50:52'),
(26, 80, 3, '2014-10-27 12:56:44', '2014-10-27 12:56:44'),
(27, 81, 3, '2014-10-27 12:59:09', '2014-10-27 12:59:09'),
(28, 84, 5, '2014-10-27 13:16:23', '2014-10-27 13:16:23'),
(29, 85, 5, '2014-10-27 13:35:40', '2014-10-27 13:35:40'),
(30, 86, NULL, '2014-10-27 13:37:56', '2014-10-27 13:37:56'),
(31, 87, 5, '2014-10-27 13:42:38', '2014-10-27 13:42:38'),
(32, 88, 5, '2014-10-27 13:44:35', '2014-10-27 13:44:35'),
(33, 89, 5, '2014-10-27 13:46:21', '2014-10-27 13:46:21'),
(34, 90, 4, '2014-10-28 11:13:33', '2014-10-28 11:13:33'),
(35, 90, 2, '2014-10-28 11:13:33', '2014-10-28 11:13:33'),
(36, 91, 4, '2014-10-28 11:14:33', '2014-10-28 11:14:33'),
(37, 91, 2, '2014-10-28 11:14:33', '2014-10-28 11:14:33'),
(38, 92, 4, '2014-10-28 11:16:28', '2014-10-28 11:16:28'),
(39, 92, 2, '2014-10-28 11:16:28', '2014-10-28 11:16:28'),
(40, 93, 5, '2014-10-28 11:17:30', '2014-10-28 11:17:30'),
(41, 94, 5, '2014-10-28 11:22:56', '2014-10-28 11:22:56'),
(42, 95, 5, '2014-10-28 11:23:49', '2014-10-28 11:23:49'),
(43, 96, 5, '2014-11-06 12:34:08', '2014-11-06 12:34:08'),
(44, 97, 5, '2014-11-06 12:48:34', '2014-11-06 12:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `investment_payments`
--

DROP TABLE IF EXISTS `investment_payments`;
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

REPLACE INTO `investment_payments` (`id`, `investment_id`, `investor_id`, `user_id`, `amount`, `payment_mode`, `cheque_nos`, `created`, `payment_date`, `delete_status`, `deleted_by`, `edit_details_username_oldnnewamout`) VALUES
(1, 12, 2, NULL, '300.60', 'Cheque', '777-99-fgt', '2014-05-28 17:55:51', '2014-05-28', 'alive', NULL, NULL),
(2, 12, 2, NULL, '40.00', 'Cheque', 'rrtt-www-333', '2014-05-28 18:12:31', '2014-05-28', 'alive', NULL, NULL),
(3, 5, 1, NULL, '60.70', 'Post-dated chq', '55-pp0-ii', '2014-05-28 18:20:45', '2014-05-28', 'alive', NULL, NULL),
(4, 11, 2, NULL, '480.00', 'Cash', '', '2014-09-08 12:16:57', '2014-09-08', 'alive', NULL, NULL),
(5, 14, 2, NULL, '1234.00', 'Cash', '', '2014-10-16 03:09:50', '1970-01-01', 'alive', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investment_products`
--

DROP TABLE IF EXISTS `investment_products`;
CREATE TABLE IF NOT EXISTS `investment_products` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `investment_products`
--

REPLACE INTO `investment_products` (`id`, `product_name`) VALUES
(1, 'Fixed Income'),
(2, 'Equity'),
(3, 'Fixed Income & Equity');

-- --------------------------------------------------------

--
-- Table structure for table `investment_statements`
--

DROP TABLE IF EXISTS `investment_statements`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `investment_terms`
--

DROP TABLE IF EXISTS `investment_terms`;
CREATE TABLE IF NOT EXISTS `investment_terms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term_name` varchar(20) NOT NULL,
  `period_type` enum('Days','Months','Years') DEFAULT 'Years',
  `period` int(4) DEFAULT '0',
  `interest_rate` decimal(3,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `investment_terms`
--

REPLACE INTO `investment_terms` (`id`, `term_name`, `period_type`, `period`, `interest_rate`) VALUES
(1, '1 year', 'Years', 1, '2.50'),
(2, '2 years', 'Years', 2, '3.50'),
(3, '3 years', 'Years', 3, '4.50');

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

DROP TABLE IF EXISTS `investments`;
CREATE TABLE IF NOT EXISTS `investments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investment_no` varchar(20) DEFAULT NULL,
  `investor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `investment_amount` decimal(11,2) DEFAULT '0.00',
  `investment_term_id` int(11) DEFAULT NULL,
  `investor_type_id` int(3) DEFAULT NULL,
  `custom_rate` decimal(3,2) DEFAULT '0.00',
  `amount_due` decimal(11,2) DEFAULT '0.00',
  `amount_paidout` decimal(11,2) DEFAULT '0.00',
  `balance` decimal(11,2) DEFAULT '0.00',
  `interest_earned` decimal(11,2) DEFAULT '0.00',
  `equity` varchar(30) DEFAULT NULL,
  `purchase_price` decimal(11,2) DEFAULT '0.00',
  `numb_shares` int(11) DEFAULT NULL,
  `total_fees` decimal(11,2) DEFAULT '0.00',
  `total_amount` decimal(11,2) DEFAULT '0.00',
  `investment_date` date DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `lastpaidout_date` date DEFAULT NULL,
  `details` varchar(200) DEFAULT NULL,
  `status` enum('Paid','Rolled_over','Cancelled','Part_payment','Invested') DEFAULT 'Invested',
  `old_status` enum('Paid','Rolled_over','Cancelled','Part_payment','Invested') DEFAULT NULL,
  `payment_schedule_id` int(3) DEFAULT NULL,
  `payment_mode_id` int(3) DEFAULT NULL,
  `investment_product_id` int(3) DEFAULT NULL,
  `instruction_id` int(3) DEFAULT NULL,
  `instruction_details` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `investor_types`
--

DROP TABLE IF EXISTS `investor_types`;
CREATE TABLE IF NOT EXISTS `investor_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `investor_type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `investor_types`
--

REPLACE INTO `investor_types` (`id`, `investor_type`) VALUES
(1, '-Select-'),
(2, 'Individual'),
(3, 'Corporate'),
(4, 'Joint'),
(5, 'Group');

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

DROP TABLE IF EXISTS `investors`;
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
  `investor_photo` blob,
  `surname` varchar(30) DEFAULT NULL,
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
  `visible` enum('alive','deleted') DEFAULT 'alive',
  PRIMARY KEY (`id`),
  KEY `surname` (`surname`),
  KEY `other_names` (`other_names`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `investors`
--

REPLACE INTO `investors` (`id`, `user_id`, `entryclerk_name`, `customer_category_id`, `investor_type_id`, `payment_term_id`, `payment_shedule_id`, `payment_mode_id`, `in_trust_for`, `occupation`, `id_expiry`, `id_issue`, `joint_surname`, `joint_other_names`, `joint_dob`, `joint_idtype_id`, `joint_id_number`, `joint_id_issue`, `joint_id_expiry`, `joint_phone`, `joint_email`, `joint_postal_address`, `source_of_income`, `registration_date`, `investor_photo`, `surname`, `other_names`, `fullname`, `dob`, `idtype_id`, `id_number`, `nationality`, `hometown`, `birth_place`, `work_place`, `position_held`, `marital_status`, `children`, `nk_relationship`, `postal_address`, `phone`, `email`, `physical_address`, `gross_income_id`, `next_of_kin_name`, `nk_phone`, `nk_postal_address`, `nk_email`, `investor_signature`, `ceo`, `comp_name`, `nature_biz`, `reg_numb`, `inv_freq`, `date_incorp`, `contact_person`, `position`, `institution_type_id`, `gross_revenue_id`, `contact_mode`, `acc_name`, `bank_id`, `bank_branch`, `acc_number`, `created`, `modified`, `visible`) VALUES
(1, 1, NULL, NULL, 4, NULL, NULL, NULL, 'Ama Mensah', 'Journalist', NULL, '2012-06-14', 'Appiah-Ofori', 'Abena', '1989-12-08', NULL, '12009998', '2014-03-14', '2018-08-15', '0245678987', '', 'PMB OS789, OSU', 'Salary', '2014-12-08', NULL, 'Appiah-Ofori', 'Kwakye', 'Kwakye Appiah-Ofori', '2007-12-08', 7, '2233455667', 'Ghanaian', '', '', 'Choice FM', 'Journalist', 'Married', '1', '', 'PMB OS789, OSU', '0204579876', 'k.appiahofori@hotmail.co.uk', 'Choice FM', 3, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Quarterly', NULL, NULL, NULL, NULL, NULL, NULL, 'Kwakye & Abena Appiah-Ofori', 27, 'Airport', '201023411082', '2014-12-08 14:05:45', '2014-12-08 14:05:45', 'alive');

-- --------------------------------------------------------

--
-- Table structure for table `invoiceold_editions`
--

DROP TABLE IF EXISTS `invoiceold_editions`;
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

DROP TABLE IF EXISTS `invoices`;
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

DROP TABLE IF EXISTS `items`;
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

DROP TABLE IF EXISTS `loan_expectedpayments`;
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

DROP TABLE IF EXISTS `loanpayments`;
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

DROP TABLE IF EXISTS `loans`;
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

DROP TABLE IF EXISTS `marriages`;
CREATE TABLE IF NOT EXISTS `marriages` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `marital_status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `marriages`
--

REPLACE INTO `marriages` (`id`, `marital_status`) VALUES
(1, '-Select-'),
(2, 'Single'),
(3, 'Married'),
(4, 'Widowed'),
(5, 'Divorced');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(30) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `modules`
--

REPLACE INTO `modules` (`id`, `module_name`, `created`) VALUES
(1, 'Investors', '2014-11-26 00:00:00'),
(2, 'Investments', '2014-11-26 00:00:00'),
(3, 'Re-investments', '2014-11-26 00:00:00'),
(4, 'Payments', '2014-11-26 00:00:00'),
(5, 'Company Accounts', '2014-11-26 00:00:00'),
(6, 'Reports', '2014-11-26 00:00:00'),
(7, 'Settings', '2014-11-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
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

DROP TABLE IF EXISTS `orders_items`;
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

DROP TABLE IF EXISTS `payment_modes`;
CREATE TABLE IF NOT EXISTS `payment_modes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `payment_mode_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment_modes`
--

REPLACE INTO `payment_modes` (`id`, `payment_mode_name`) VALUES
(1, 'Cheque'),
(2, 'Bank transfer');

-- --------------------------------------------------------

--
-- Table structure for table `payment_schedules`
--

DROP TABLE IF EXISTS `payment_schedules`;
CREATE TABLE IF NOT EXISTS `payment_schedules` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `payment_schedule_name` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payment_schedules`
--

REPLACE INTO `payment_schedules` (`id`, `payment_schedule_name`) VALUES
(1, 'Semi-annually'),
(2, 'Annually'),
(3, 'Depending on investment product');

-- --------------------------------------------------------

--
-- Table structure for table `payment_terms`
--

DROP TABLE IF EXISTS `payment_terms`;
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

REPLACE INTO `payment_terms` (`id`, `payment_name`, `period_months`, `interest_rate`) VALUES
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

DROP TABLE IF EXISTS `payments`;
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

DROP TABLE IF EXISTS `pettycash_deposits`;
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

DROP TABLE IF EXISTS `pettycash_withdrawals`;
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

DROP TABLE IF EXISTS `pettycashes`;
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

REPLACE INTO `pettycashes` (`id`, `amount`, `balance`, `created`, `created_by`, `modified`, `modified_by`, `zone_id`) VALUES
(4, '110.00', '60.00', '2014-04-03 08:40:52', 0, '2014-08-26 22:41:53', 0, NULL),
(5, '321.00', '-36.00', '2014-04-09 09:57:47', 0, '2014-08-26 21:37:49', 0, NULL),
(6, '200.00', '60.00', '2014-04-11 05:16:15', 0, '2014-04-25 12:30:52', 0, NULL),
(7, '500.00', '340.00', '2014-08-27 00:10:45', 0, '2014-09-01 22:04:39', 0, 18);

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
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

REPLACE INTO `portfolios` (`id`, `payment_name`, `period_months`, `interest_rate`) VALUES
(33, '--None--', 1, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
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

REPLACE INTO `rates` (`id`, `payment_name`, `period_months`, `interest_rate`) VALUES
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

DROP TABLE IF EXISTS `reinvestments`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reinvestments`
--

REPLACE INTO `reinvestments` (`id`, `investment_no`, `investor_id`, `user_id`, `currency_id`, `investment_amount`, `portfolio_id`, `custom_rate`, `amount_due`, `amount_paidout`, `balance`, `interest_earned`, `investment_date`, `due_date`, `lastpaidout_date`, `details`, `status`, `old_status`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, NULL, 1, 39, NULL, '100.00', 27, '0.00', '172.80', '0.00', '0.00', '28.80', '2014-05-09', '1971-05-01', NULL, NULL, 'Rolled_over', 'Cancelled', '2014-05-09 23:52:16', '2014-09-25 04:49:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reinvestors`
--

DROP TABLE IF EXISTS `reinvestors`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reinvestors`
--

REPLACE INTO `reinvestors` (`id`, `currency_id`, `company_name`, `manager_name`, `location`, `postal_address`, `postal_town_suburb`, `postal_city`, `postal_country`, `telephone`, `mobile`, `email`, `accounting_month`) VALUES
(1, 1, 'Parkstone Capital Limited', 'Elsie', 'Accra', ' P.O. Box CS 9161', 'Adjirigano', 'Accra', 'Ghana', '0202088130', '0244327219', 'info@parkstonecapital.com', '2012-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `repossessions`
--

DROP TABLE IF EXISTS `repossessions`;
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

DROP TABLE IF EXISTS `rollovers`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
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

DROP TABLE IF EXISTS `sales_items`;
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

DROP TABLE IF EXISTS `settings`;
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

REPLACE INTO `settings` (`id`, `currency_id`, `company_name`, `owner_name`, `location`, `postal_address`, `postal_town_suburb`, `postal_city`, `postal_country`, `telephone`, `mobile`, `email`, `accounting_month`) VALUES
(1, 1, 'PARKSTONE CAPITAL LIMITED', 'Elsie', 'Accra', ' P.O. Box CS 9161', 'Adjirigano', 'Accra', 'Ghana', '0202088130', '0244327219', 'info@parkstonecapital.com', '2012-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
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

REPLACE INTO `stocks` (`id`, `item`, `item_type`, `supplier_id`, `cost_price`, `selling_price`, `original_quantity`, `remaining_quantity`) VALUES
(1, 'test', '0', 18, 200, 300, 290, 290);

-- --------------------------------------------------------

--
-- Table structure for table `subsidiaries`
--

DROP TABLE IF EXISTS `subsidiaries`;
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

DROP TABLE IF EXISTS `supplierinvoices`;
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

DROP TABLE IF EXISTS `supplieritems`;
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

DROP TABLE IF EXISTS `suppliers`;
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

DROP TABLE IF EXISTS `supply_payments`;
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

DROP TABLE IF EXISTS `taxes`;
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

DROP TABLE IF EXISTS `temp_sales`;
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

DROP TABLE IF EXISTS `tempcash_accounts`;
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

REPLACE INTO `tempcash_accounts` (`id`, `expense_id`, `user_id`, `zone_id`, `expense_type`, `expense_desc`, `expense_date`, `source`, `amount`, `prepared_by`, `paid_to`, `remarks`, `status`) VALUES
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
-- Table structure for table `user_privileges`
--

DROP TABLE IF EXISTS `user_privileges`;
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

REPLACE INTO `user_privileges` (`id`, `usertype_id`, `module_id`, `created_by`, `mod_view`, `mod_delete`, `mod_edit`, `mod_create`, `created`, `modified`) VALUES
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

DROP TABLE IF EXISTS `userdepartments`;
CREATE TABLE IF NOT EXISTS `userdepartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `userdepartments`
--

REPLACE INTO `userdepartments` (`id`, `department`) VALUES
(5, 'OPERATIONS DEPARTMENT'),
(6, 'MARKETING DEPARTMENT'),
(8, 'ADMINISTRATION'),
(9, 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
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

REPLACE INTO `users` (`id`, `userdepartment_id`, `username`, `password`, `firstname`, `lastname`, `usertype_id`, `email`, `date`) VALUES
(1, 3, 'support', 'ccbd43e44efec3dd62688e50cf8f0485', 'Qwick', 'Fusion', 1, NULL, '2013-03-12 00:45:42'),
(2, 5, 'g.onyinah', 'd41d8cd98f00b204e9800998ecf8427e', 'Grace ', 'Opoku Onyinah', 10, '', '2014-12-05 15:51:45'),
(3, 5, 'sam.essien', 'd41d8cd98f00b204e9800998ecf8427e', 'Samuel', 'Essien', 10, '', '2014-12-05 15:53:00'),
(4, 5, 'charles.denu', 'd41d8cd98f00b204e9800998ecf8427e', 'Charles', 'Denu', 10, '', '2014-12-05 15:53:36'),
(5, 8, 'e.enninful', 'd41d8cd98f00b204e9800998ecf8427e', 'Elsie', 'Enninful-Adu', 1, '', '2014-12-05 15:54:30'),
(6, 8, 'doris.ohene', 'd41d8cd98f00b204e9800998ecf8427e', 'Doris', 'Ohene-Djan', 10, '', '2014-12-05 15:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

DROP TABLE IF EXISTS `usertypes`;
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

REPLACE INTO `usertypes` (`id`, `usertype`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(1, 'Super Administrator', NULL, NULL, NULL, NULL),
(10, 'Investment Officer', NULL, NULL, '2014-12-02 17:45:58', '2014-12-02 17:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
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

REPLACE INTO `warehouses` (`id`, `warehouse`, `town`, `address`) VALUES
(1, 'Headquarters', 'Accra', NULL),
(3, 'Nkawkaw', 'Nkawkaw', ''),
(4, 'MAIN-WAREHOUSE', 'ACCRA', 'HEAD-OFFICE'),
(5, 'Repossessed Items', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

DROP TABLE IF EXISTS `zones`;
CREATE TABLE IF NOT EXISTS `zones` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `zone` varchar(15) NOT NULL,
  `suburb` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `zones`
--

REPLACE INTO `zones` (`id`, `zone`, `suburb`) VALUES
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
