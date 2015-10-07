-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2015 at 12:21 PM
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
-- Database: `qwickfu1_parkstone_inv2`
--
DROP DATABASE `qwickfu1_parkstone_inv`;
CREATE DATABASE IF NOT EXISTS `qwickfu1_parkstone_inv` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `qwickfu1_parkstone_inv`;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(1, NULL, 1, 1, 'fixed', 1, NULL, NULL, '0.06', 4, 1, 31, 'Day(s)', '30.00', '0.00', '0.06', '0.06', '0.00', '0.06', '0.06', '0.06', '0.00', '2015-07-27', '2015-09-27', NULL, 69, '0.00', NULL, 'Matured', 'Rolled_over', 'part_payment', '2015-08-27 10:19:02', '2015-10-04 13:16:56', 1, 1),
(2, NULL, 1, 1, 'fixed', 1, NULL, NULL, '0.06', 4, 1, 31, 'Day(s)', '30.00', '0.00', '0.06', '0.06', '0.06', '0.00', '0.00', '0.06', '0.00', '2015-07-27', '2015-09-27', '2015-10-04', 69, '0.00', NULL, 'Paid', 'Rolled_over', 'paid', '2015-08-27 10:49:56', '2015-10-04 14:04:13', 1, 1),
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
(6, 1, NULL, '2100.00', '0.00', '0.00', '1730.06', '1730.06', NULL, '0.00', '335.16', '0.00', '2015-02-10 14:24:28', '2015-10-04 14:04:13', NULL),
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
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `transaction_categories`
--

INSERT INTO `transaction_categories` (`id`, `head_id`, `category_name`, `system`, `deleted`) VALUES
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
