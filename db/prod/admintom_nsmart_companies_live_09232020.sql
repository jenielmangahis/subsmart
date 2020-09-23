-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2020 at 09:33 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admintom_nsmart_companies`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1= active',
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `account_name`, `status`, `company_id`) VALUES
(1, 'Bank', 1, NULL),
(2, 'Income', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_bill`
--

CREATE TABLE `accounting_bill` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `vendor_id` varchar(11) NOT NULL,
  `mailing_address` text NOT NULL,
  `terms` varchar(255) NOT NULL,
  `bill_date` date NOT NULL,
  `due_date` date NOT NULL,
  `bill_number` int(11) NOT NULL,
  `permit_number` int(11) NOT NULL,
  `memo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_bill`
--

INSERT INTO `accounting_bill` (`id`, `transaction_id`, `vendor_id`, `mailing_address`, `terms`, `bill_date`, `due_date`, `bill_number`, `permit_number`, `memo`) VALUES
(1, 106, '0', 'rersr', 'Net 30', '2020-08-22', '2020-08-26', 44444, 4334, ''),
(4, 90, '1', 'asfdasdfasdf', 'Net 15', '2020-08-19', '2020-08-19', 3665, 46464, ''),
(5, 108, '0', 'sdfsdfdsf', 'Net 15', '2020-08-28', '2020-09-01', 44444, 565464, ''),
(6, 109, '2', 'resrser', 'Net 30', '2020-08-22', '2020-08-30', 666, 66, ''),
(7, 110, '2', 'dsfdsfsd', 'Net 15', '2020-08-24', '2020-08-26', 44444, 4334, 'tes test');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_chart_of_accounts`
--

CREATE TABLE `accounting_chart_of_accounts` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `acc_detail_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `sub_acc_id` int(11) DEFAULT NULL,
  `time` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `time_date` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = inactive , 1 = active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting_chart_of_accounts`
--

INSERT INTO `accounting_chart_of_accounts` (`id`, `account_id`, `acc_detail_id`, `name`, `description`, `sub_acc_id`, `time`, `balance`, `time_date`, `active`, `created_at`, `updated_at`) VALUES
(1, 2, 9, 'Other Primary Income', 'descp', 2, 'Other', '2000', '22.07.2020', 1, '2020-07-16 13:18:54', '0000-00-00 00:00:00'),
(2, 1, 5, 'Savings', 'descp', 2, 'Other', '3000', '30.07.2020', 1, '2020-07-16 13:19:05', '0000-00-00 00:00:00'),
(8, 1, 1, 'Cash on hand 1', 'descp', 1, 'Other', '1000', '14.07.2020', 1, '2020-07-28 13:20:53', '0000-00-00 00:00:00'),
(15, 2, 9, 'savings', 'descp123', 2, 'other', '4000', '31.07.2020', 1, '2020-08-01 10:17:16', '2020-08-01 10:17:16');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_check`
--

CREATE TABLE `accounting_check` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `vendor_id` varchar(15) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `mailing_address` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `check_number` int(11) NOT NULL,
  `print_later` tinyint(4) DEFAULT NULL,
  `permit_number` int(11) NOT NULL,
  `memo` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_check`
--

INSERT INTO `accounting_check` (`id`, `transaction_id`, `vendor_id`, `bank_id`, `mailing_address`, `payment_date`, `check_number`, `print_later`, `permit_number`, `memo`) VALUES
(6, 11, '1', 1, 'asdfsdfsadf', '2020-08-07', 2, 1, 1234, ''),
(60, 79, '1', 3, 'asdfsdf', '2020-08-14', 3, 1, 5555, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_existing_attachment`
--

CREATE TABLE `accounting_existing_attachment` (
  `id` int(11) NOT NULL,
  `attachment_id` int(11) NOT NULL,
  `attachment_from_id` int(11) NOT NULL,
  `trans_from_id` int(11) NOT NULL,
  `expenses_type` varchar(100) NOT NULL,
  `expenses_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `accounting_expense`
--

CREATE TABLE `accounting_expense` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `vendor_id` varchar(15) NOT NULL,
  `payment_account` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `ref_number` int(11) NOT NULL,
  `permit_number` int(11) NOT NULL,
  `memo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_expense`
--

INSERT INTO `accounting_expense` (`id`, `transaction_id`, `vendor_id`, `payment_account`, `payment_date`, `payment_method`, `ref_number`, `permit_number`, `memo`) VALUES
(1, 100, '5', 'Cash on hand', '2020-08-28', 'Cash', 333, 5555, 'testst'),
(3, 103, '5', 'Cash on hand', '2020-08-22', 'Cash', 5555, 666656, 'sdfsdfsd'),
(4, 104, '5', 'Cash on hand', '2020-08-21', 'Cash', 1231, 6565, 'eresr');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_expense_attachment`
--

CREATE TABLE `accounting_expense_attachment` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `expenses_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `original_filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `accounting_expense_category`
--

CREATE TABLE `accounting_expense_category` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `expenses_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_expense_category`
--

INSERT INTO `accounting_expense_category` (`id`, `transaction_id`, `expenses_id`, `category_id`, `description`, `amount`) VALUES
(1, 57, 3, 1, 'losi mo po1313', 140.00),
(2, 57, 3, 2, 'losi mo po', 130.00),
(7, 96, 61, 2, 'new text0123', 999.00),
(8, 96, 61, 4, 'gjgjgjkgjgl', 1.00),
(9, 91, 4, 3, 'sadfasdfsd', 4645.00);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_expense_transaction`
--

CREATE TABLE `accounting_expense_transaction` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `total` double(10,2) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_expense_transaction`
--

INSERT INTO `accounting_expense_transaction` (`id`, `type`, `total`, `date_created`, `date_modified`) VALUES
(11, 'Check', 0.00, '2020-07-31 11:33:10', '2020-08-17 22:18:44'),
(13, 'Expense', 0.00, '2020-08-03 11:12:22', '2020-08-18 03:10:38'),
(57, 'Vendor Credit', 270.00, '2020-08-05 11:32:26', '2020-08-21 09:44:11'),
(90, 'Bill', 0.00, '2020-08-10 17:37:45', '2020-08-17 02:07:57'),
(91, 'Vendor Credit', 0.00, '2020-08-18 02:07:13', '2020-08-19 01:11:55'),
(96, 'Check', 0.00, '2020-08-18 20:27:51', '2020-08-19 00:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_list_category`
--

CREATE TABLE `accounting_list_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sub_account` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting_list_category`
--

INSERT INTO `accounting_list_category` (`id`, `category_name`, `display_name`, `type`, `description`, `sub_account`, `date_created`, `status`) VALUES
(1, 'Advertising', '', 'Expenses', '', '', '0000-00-00 00:00:00', 1),
(2, 'Bad Debts', '', 'Expenses', '', '', '0000-00-00 00:00:00', 1),
(3, 'Bank Charges', '', 'Expenses', '', '', '0000-00-00 00:00:00', 1),
(4, 'Commissions & Fees', '', 'Expenses', '', '', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_paydown`
--

CREATE TABLE `accounting_paydown` (
  `id` int(11) NOT NULL,
  `credit_card_id` int(11) NOT NULL,
  `date_payment` date NOT NULL,
  `payment_account` varchar(255) NOT NULL,
  `check_number` int(11) NOT NULL,
  `memo` text NOT NULL,
  `attachment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `accounting_receipts`
--

CREATE TABLE `accounting_receipts` (
  `id` int(11) NOT NULL,
  `receipt_img` varchar(255) NOT NULL,
  `document_type` varchar(100) NOT NULL,
  `payee_id` int(11) NOT NULL,
  `bank_account` varchar(255) NOT NULL,
  `transaction_date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `memo` varchar(255) NOT NULL,
  `ref_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_receipts`
--

INSERT INTO `accounting_receipts` (`id`, `receipt_img`, `document_type`, `payee_id`, `bank_account`, `transaction_date`, `description`, `total_amount`, `category`, `memo`, `ref_number`) VALUES
(67, '403c4696ae0064492483ffb670f9c921.jpg', '', 0, '', '0000-00-00', '', 0.00, '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_reconcile`
--

CREATE TABLE `accounting_reconcile` (
  `id` int(11) NOT NULL,
  `chart_of_accounts_id` int(11) NOT NULL,
  `ending_balance` varchar(255) NOT NULL,
  `ending_date` varchar(255) NOT NULL,
  `first_date` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `expense_account` varchar(255) NOT NULL,
  `second_date` varchar(255) NOT NULL,
  `interest_earned` varchar(255) NOT NULL,
  `income_account` varchar(255) NOT NULL,
  `adjustment_date` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = inactive , 1 = active	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting_reconcile`
--

INSERT INTO `accounting_reconcile` (`id`, `chart_of_accounts_id`, `ending_balance`, `ending_date`, `first_date`, `service_charge`, `expense_account`, `second_date`, `interest_earned`, `income_account`, `adjustment_date`, `active`) VALUES
(2, 1, '2000', '28.08.2020', '28.08.2020', '200', 'Cash on hand', '20.08.2020', '20', 'Cash on hand', '20.08.2020', 1),
(4, 2, '10000', '09.06.2020', '10.06.2020', '100', 'Cash on hand', '10.06.2020', '200', 'Cash on hand', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_rules`
--

CREATE TABLE `accounting_rules` (
  `id` int(11) NOT NULL,
  `rules_name` varchar(255) NOT NULL,
  `banks` int(11) NOT NULL,
  `apply_type` varchar(255) NOT NULL,
  `include` varchar(255) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `memo` text NOT NULL,
  `auto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_rules`
--

INSERT INTO `accounting_rules` (`id`, `rules_name`, `banks`, `apply_type`, `include`, `transaction_type`, `payee`, `memo`, `auto`) VALUES
(31, 'Sample name', 1, 'Money in', 'All', 'Expenses', 'Advertising', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_rules_category`
--

CREATE TABLE `accounting_rules_category` (
  `id` int(11) NOT NULL,
  `rules_id` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_rules_category`
--

INSERT INTO `accounting_rules_category` (`id`, `rules_id`, `percentage`, `category`) VALUES
(4, 31, 25, 'Advertising'),
(5, 31, 50, 'Bank Charges'),
(6, 31, 55, 'Bank Charges');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_rules_conditions`
--

CREATE TABLE `accounting_rules_conditions` (
  `id` int(11) NOT NULL,
  `rules_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `contain` varchar(255) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_rules_conditions`
--

INSERT INTO `accounting_rules_conditions` (`id`, `rules_id`, `description`, `contain`, `comment`) VALUES
(71, 31, 'Bank text', 'Doesn\'t contain', 'sample text');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_time_activity`
--

CREATE TABLE `accounting_time_activity` (
  `id` int(11) NOT NULL,
  `vendor_id` varchar(15) NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(50) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `service` text NOT NULL,
  `billable` int(3) DEFAULT NULL,
  `taxable` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `break` time DEFAULT NULL,
  `time` time DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_time_activity`
--

INSERT INTO `accounting_time_activity` (`id`, `vendor_id`, `date`, `name`, `customer`, `service`, `billable`, `taxable`, `start_time`, `end_time`, `break`, `time`, `description`) VALUES
(1, 'qwe123', '2020-07-22 00:00:00', '', 'BillieJoe', 'Credit', 0, 0, '00:00:00', '00:00:00', '00:00:00', '17:05:00', 'Hello world'),
(2, 'iph17', '2020-08-29 00:00:00', 'Stephen Cabalida', 'sfsdf', 'Discount', 1, 0, '00:00:00', '00:00:00', '00:00:00', '12:35:00', 'dsfsdfds');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_vendors`
--

CREATE TABLE `accounting_vendors` (
  `id` int(12) NOT NULL,
  `vendor_id` int(12) NOT NULL,
  `title` varchar(20) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `m_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `suffix` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `to_display` tinyint(1) NOT NULL,
  `street` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `billing_rate` int(20) NOT NULL,
  `terms` int(5) NOT NULL,
  `opening_balance` varchar(50) NOT NULL,
  `opening_balance_as_of_date` datetime NOT NULL,
  `account_number` int(15) NOT NULL,
  `business_number` varchar(50) NOT NULL,
  `default_expense_amount` int(50) NOT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `attachments` varchar(500) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_by` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting_vendors`
--

INSERT INTO `accounting_vendors` (`id`, `vendor_id`, `title`, `f_name`, `m_name`, `l_name`, `suffix`, `email`, `company`, `display_name`, `to_display`, `street`, `city`, `state`, `zip`, `country`, `phone`, `mobile`, `fax`, `website`, `billing_rate`, `terms`, `opening_balance`, `opening_balance_as_of_date`, `account_number`, `business_number`, `default_expense_amount`, `notes`, `attachments`, `status`, `created_by`, `date_created`, `date_modified`) VALUES
(1, 1, 'test title', 'Billie', 'Joe', 'Armstrong', '', 'billie@email.com', 'billiejoe', 'BillieJoe', 0, '', '', '', '', '', '', '', NULL, NULL, 0, 0, '', '0000-00-00 00:00:00', 0, '', 0, NULL, NULL, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 'test title 2', 'Kirk ', 'Terepa', 'Hammett', '', 'kirk@email.com', '', 'Kirk Hammett', 0, '', '', '', '', '', '', '', NULL, NULL, 0, 0, '', '0000-00-00 00:00:00', 0, '', 0, NULL, NULL, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'test1', 'Layne', '', 'Staley', '', 'sample@mail.com', 'AIC', '', 0, 'sample', 'sample', 'sample', '8979', 'sample', '4656464', '564646', '', '', 2, 0, '50', '2020-08-26 00:00:00', 12131313, '111313', 21313131, '', '', 1, '2', '2020-08-12 09:19:49', '2020-08-12 09:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_vendor_credit`
--

CREATE TABLE `accounting_vendor_credit` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `vendor_id` varchar(15) NOT NULL,
  `mailing_address` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `ref_number` int(11) NOT NULL,
  `permit_number` int(11) NOT NULL,
  `memo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_vendor_credit`
--

INSERT INTO `accounting_vendor_credit` (`id`, `transaction_id`, `vendor_id`, `mailing_address`, `payment_date`, `ref_number`, `permit_number`, `memo`) VALUES
(3, 57, '1', 'asdfsdf', '2020-08-28', 14654, 5555, '');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_has_account_details`
--

CREATE TABLE `accounts_has_account_details` (
  `account_id` int(11) NOT NULL,
  `acc_detail_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts_has_account_details`
--

INSERT INTO `accounts_has_account_details` (`account_id`, `acc_detail_id`, `company_id`) VALUES
(1, 1, NULL),
(1, 2, NULL),
(1, 3, NULL),
(1, 4, NULL),
(1, 5, NULL),
(1, 6, NULL),
(2, 7, NULL),
(2, 8, NULL),
(2, 9, NULL),
(2, 10, NULL),
(2, 11, NULL),
(2, 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_has_sub_account`
--

CREATE TABLE `accounts_has_sub_account` (
  `account_id` int(11) NOT NULL,
  `sub_acc_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `account_detail`
--

CREATE TABLE `account_detail` (
  `acc_detail_id` int(11) NOT NULL,
  `acc_detail_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 = active',
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_detail`
--

INSERT INTO `account_detail` (`acc_detail_id`, `acc_detail_name`, `status`, `company_id`) VALUES
(1, 'Cash on hand', 1, NULL),
(2, 'Checking', 1, NULL),
(3, 'Money market', 1, NULL),
(4, 'Rents Held in Trust', 1, NULL),
(5, 'Savings', 1, NULL),
(6, 'Trust account', 1, NULL),
(7, 'Discounts/Refunds Given', 1, NULL),
(8, 'Non-Profit Income', 1, NULL),
(9, 'Other Primary Income', 1, NULL),
(10, 'Sales of Product Income', 1, NULL),
(11, 'Service/Fee Income', 1, NULL),
(12, 'Unapplied Cash Payment Income', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `account_sub_account`
--

CREATE TABLE `account_sub_account` (
  `sub_acc_id` int(11) NOT NULL,
  `sub_acc_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = active',
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_sub_account`
--

INSERT INTO `account_sub_account` (`sub_acc_id`, `sub_acc_name`, `status`, `company_id`) VALUES
(1, 'Cash on hand', 1, NULL),
(2, 'Corporate Account (XXXXXX 5850)', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acs_access`
--

CREATE TABLE `acs_access` (
  `access_id` int(11) NOT NULL,
  `fk_prof_id` int(11) UNSIGNED NOT NULL,
  `portal_status` varchar(20) NOT NULL,
  `reset_password` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `acs_custom_field1` varchar(100) NOT NULL,
  `acs_custom_field2` varchar(100) NOT NULL,
  `acs_cancel_date` varchar(20) NOT NULL,
  `acs_collect_date` varchar(20) NOT NULL,
  `acs_cancel_reason` varchar(250) NOT NULL,
  `collect_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acs_access`
--

INSERT INTO `acs_access` (`access_id`, `fk_prof_id`, `portal_status`, `reset_password`, `login`, `password`, `acs_custom_field1`, `acs_custom_field2`, `acs_cancel_date`, `acs_collect_date`, `acs_cancel_reason`, `collect_amount`) VALUES
(15, 32, '1', '', '', '', '', '', '9/20/2020', '9/20/2020', '', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `acs_alarm`
--

CREATE TABLE `acs_alarm` (
  `alarm_id` int(11) NOT NULL,
  `fk_prof_id` int(2) NOT NULL,
  `monitor_comp` varchar(200) NOT NULL,
  `monitor_id` int(11) NOT NULL,
  `install_date` varchar(20) NOT NULL,
  `credit_score_alarm` int(11) NOT NULL,
  `acct_type` varchar(50) NOT NULL,
  `acct_info` varchar(100) NOT NULL,
  `passcode` varchar(100) NOT NULL,
  `install_code` int(100) NOT NULL,
  `mcn` int(11) NOT NULL,
  `scn` int(11) NOT NULL,
  `contact1` varchar(100) NOT NULL,
  `contact2` varchar(100) NOT NULL,
  `contact3` varchar(100) NOT NULL,
  `contact_name1` varchar(100) NOT NULL,
  `contact_name2` varchar(100) NOT NULL,
  `contact_name3` varchar(100) NOT NULL,
  `panel_type` varchar(100) NOT NULL,
  `system_type` varchar(100) NOT NULL,
  `mon_waived` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acs_alarm`
--

INSERT INTO `acs_alarm` (`alarm_id`, `fk_prof_id`, `monitor_comp`, `monitor_id`, `install_date`, `credit_score_alarm`, `acct_type`, `acct_info`, `passcode`, `install_code`, `mcn`, `scn`, `contact1`, `contact2`, `contact3`, `contact_name1`, `contact_name2`, `contact_name3`, `panel_type`, `system_type`, `mon_waived`) VALUES
(5, 31, '', 0, '9/12/2020', 0, 'In-House', '', '', 0, 0, 0, '', '', '', '', '', '', 'DIGI', '', ''),
(6, 32, 'moni', 67, '9/20/2020', 654, 'In-House', '', 'jesus', 4112, 765432, 2147483647, 'sandy Nguyen 8506195018', '', '', '', '', '', 'CPDB', 'HONEYWELL 5200', 'yes or no');

-- --------------------------------------------------------

--
-- Table structure for table `acs_assign`
--

CREATE TABLE `acs_assign` (
  `ass_id` int(11) NOT NULL,
  `fk_prof_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acs_billing`
--

CREATE TABLE `acs_billing` (
  `bill_id` int(11) NOT NULL,
  `fk_prof_id` int(2) NOT NULL,
  `card_fname` varchar(100) NOT NULL,
  `card_lname` varchar(100) NOT NULL,
  `card_address` varchar(250) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `mmr` decimal(10,2) NOT NULL,
  `bill_freq` varchar(30) NOT NULL,
  `bill_day` int(2) NOT NULL,
  `contract_term` int(2) NOT NULL,
  `bill_method` varchar(100) NOT NULL,
  `bill_start_date` varchar(20) NOT NULL,
  `bill_end_date` varchar(20) NOT NULL,
  `check_num` varchar(100) NOT NULL,
  `routing_num` varchar(100) NOT NULL,
  `acct_num` varchar(100) NOT NULL,
  `credit_card_num` int(20) NOT NULL,
  `credit_card_exp` varchar(10) NOT NULL,
  `credit_card_exp_mm_yyyy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acs_billing`
--

INSERT INTO `acs_billing` (`bill_id`, `fk_prof_id`, `card_fname`, `card_lname`, `card_address`, `city`, `state`, `zip`, `mmr`, `bill_freq`, `bill_day`, `contract_term`, `bill_method`, `bill_start_date`, `bill_end_date`, `check_num`, `routing_num`, `acct_num`, `credit_card_num`, `credit_card_exp`, `credit_card_exp_mm_yyyy`) VALUES
(5, 31, '', '', '', '', '', '', 0.00, '', 0, 0, '0', '9/12/2020', '9/12/2020', '', '', '', 0, '', ''),
(6, 32, '', '', '', '', '', '', 44.99, 'Every 1 Month', 13, 60, '3', '9/20/20', '', '7654', '675443322', '5677889909', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `acs_office`
--

CREATE TABLE `acs_office` (
  `off_id` int(11) NOT NULL,
  `fk_prof_id` int(2) NOT NULL,
  `welcome_sent` int(2) NOT NULL,
  `rebate` int(2) NOT NULL,
  `commision_scheme` int(2) NOT NULL,
  `rep_comm` decimal(10,2) NOT NULL,
  `rep_upfront_pay` decimal(10,2) NOT NULL,
  `tech_comm` decimal(10,2) NOT NULL,
  `tech_upfront_pay` decimal(10,2) NOT NULL,
  `rep_charge_back` decimal(10,2) NOT NULL,
  `rep_payroll_charge_back` decimal(10,2) NOT NULL,
  `pso` int(2) NOT NULL,
  `assign_to` varchar(100) NOT NULL,
  `points_include` int(11) NOT NULL,
  `price_per_point` decimal(10,2) NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `purchase_multiple` decimal(10,2) NOT NULL,
  `purchase_discount` decimal(10,2) NOT NULL,
  `entered_by` varchar(100) NOT NULL,
  `time_entered` varchar(20) NOT NULL,
  `sales_date` varchar(20) NOT NULL,
  `credit_score` int(20) NOT NULL,
  `language` varchar(20) NOT NULL,
  `fk_sales_rep_office` int(11) NOT NULL,
  `technician` varchar(100) NOT NULL,
  `save_date` varchar(20) NOT NULL,
  `save_by` varchar(100) NOT NULL,
  `cancel_date` varchar(20) NOT NULL,
  `cancel_reason` varchar(10) NOT NULL,
  `sched_conflict` int(2) NOT NULL,
  `install_date` varchar(20) NOT NULL,
  `tech_arrive_time` varchar(20) NOT NULL,
  `tech_depart_time` varchar(20) NOT NULL,
  `pre_install_survey` varchar(10) NOT NULL,
  `post_install_survey` varchar(10) NOT NULL,
  `rebate_offer` int(2) NOT NULL,
  `rebate_check1` decimal(10,2) NOT NULL,
  `rebate_check1_amt` decimal(10,2) NOT NULL,
  `rebate_check2` decimal(10,2) NOT NULL,
  `rebate_check2_amt` decimal(10,2) NOT NULL,
  `activation_fee` varchar(20) NOT NULL,
  `way_of_pay` varchar(10) NOT NULL,
  `lead_source` varchar(20) NOT NULL,
  `url` varchar(250) NOT NULL,
  `verification` varchar(20) NOT NULL,
  `warranty_type` varchar(100) NOT NULL,
  `office_custom_field1` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acs_office`
--

INSERT INTO `acs_office` (`off_id`, `fk_prof_id`, `welcome_sent`, `rebate`, `commision_scheme`, `rep_comm`, `rep_upfront_pay`, `tech_comm`, `tech_upfront_pay`, `rep_charge_back`, `rep_payroll_charge_back`, `pso`, `assign_to`, `points_include`, `price_per_point`, `purchase_price`, `purchase_multiple`, `purchase_discount`, `entered_by`, `time_entered`, `sales_date`, `credit_score`, `language`, `fk_sales_rep_office`, `technician`, `save_date`, `save_by`, `cancel_date`, `cancel_reason`, `sched_conflict`, `install_date`, `tech_arrive_time`, `tech_depart_time`, `pre_install_survey`, `post_install_survey`, `rebate_offer`, `rebate_check1`, `rebate_check1_amt`, `rebate_check2`, `rebate_check2_amt`, `activation_fee`, `way_of_pay`, `lead_source`, `url`, `verification`, `warranty_type`, `office_custom_field1`) VALUES
(6, 32, 1, 1, 1, 400.00, 100.00, 125.00, 0.00, 0.00, 0.00, 1, '', 0, 35.00, 0.00, 62.00, 0.00, 'need employee list', '9/15/20', '9/20/2020', 0, 'English', 0, '', '9/20/2020', '', '', '', 0, '9/20/2020', '5:19 AM', '5:19 AM', 'Pass', 'Pass', 1, 7865.00, 65.00, 0.00, 0.00, '0.000000', 'Check', 'Door', '', 'TrunsUnion', 'limited or extended or standard', '');

-- --------------------------------------------------------

--
-- Table structure for table `acs_profile`
--

CREATE TABLE `acs_profile` (
  `prof_id` int(11) NOT NULL,
  `fk_user_id` int(2) NOT NULL,
  `fk_sa_id` int(2) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `prefix` varchar(15) NOT NULL,
  `suffix` varchar(20) NOT NULL,
  `business_name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ssn` varchar(50) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `phone_h` varchar(50) NOT NULL,
  `phone_w` varchar(50) NOT NULL,
  `phone_m` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `mail_add` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `cross_street` varchar(100) NOT NULL,
  `subdivision` varchar(100) NOT NULL,
  `img_path` text NOT NULL,
  `pay_history` varchar(200) NOT NULL,
  `notes` tinytext NOT NULL,
  `assign` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acs_profile`
--

INSERT INTO `acs_profile` (`prof_id`, `fk_user_id`, `fk_sa_id`, `first_name`, `last_name`, `middle_name`, `prefix`, `suffix`, `business_name`, `email`, `ssn`, `date_of_birth`, `phone_h`, `phone_w`, `phone_m`, `fax`, `mail_add`, `city`, `state`, `country`, `zip_code`, `cross_street`, `subdivision`, `img_path`, `pay_history`, `notes`, `assign`) VALUES
(32, 11, 1, 'Tommy', 'Nguyen', 't', '', '', '', 'moresecureadi@gmail.com', '', '9/15/1971', '8506195914', '8506195675', '8507896432', 'none', '6055 BORN CT', 'PENSACOLA', 'FL', 'United States ', '32504', '', 'river gardens ', '', '1', ' ', 13);

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `title`, `user`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, ' (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'User:  Logged Out', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, ' (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'User:  Logged Out', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, ' (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, ' (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, ' (admin) Logged in', 2, '119.94.187.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, ' (admin) Logged in', 2, '203.189.118.144', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, ' (admin) Logged in', 2, '72.213.205.141', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, ' (admin) Logged in', 2, '203.189.118.191', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, ' (admin) Logged in', 2, '110.54.247.114', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, ' (admin) Logged in', 2, '72.213.205.141', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'User:  Logged Out', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'User:  Logged Out', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'User:  Logged Out', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, ' (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, ' (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, ' (admin) Logged in', 2, '112.198.75.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, ' (admin) Logged in', 2, '112.198.75.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, ' (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, ' (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, ' (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, ' (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'User:  Logged Out', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, ' (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, ' (admin) Logged in', 2, '157.32.88.247', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, ' (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, ' (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, ' (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, ' (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, ' (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'User:  Logged Out', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'john  (admin) Logged in', 2, '72.213.205.141', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'john  (admin) Logged in', 2, '110.54.247.53', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'john  (admin) Logged in', 2, '72.213.205.141', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'john  (admin) Logged in', 2, '72.213.205.141', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'john  (admin) Logged in', 2, '110.54.246.25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'john  (admin) Logged in', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'User:  Logged Out', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'john  (admin) Logged in', 2, '157.32.214.161', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'john  (admin) Logged in', 2, '43.241.146.238', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'john  (admin) Logged in', 2, '110.54.247.31', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'john  (admin) Logged in', 2, '203.189.118.71', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'john  (admin) Logged in', 2, '203.189.118.71', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'john  (admin) Logged in', 2, '72.213.205.141', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'john  (admin) Logged in', 2, '72.213.205.141', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'john  (admin) Logged in', 2, '72.213.205.141', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'john  (admin) Logged in', 2, '203.189.118.61', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'john  (admin) Logged in', 2, '49.34.110.240', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'john  (admin) Logged in', 2, '172.58.171.213', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'john  (admin) Logged in', 2, '174.235.137.139', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'john  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'john  (admin) Logged in', 2, '203.189.118.226', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'john  (admin) Logged in', 2, '157.32.170.170', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'john  (admin) Logged in', 2, '157.32.77.167', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'john  (admin) Logged in', 2, '43.241.146.42', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'john  (admin) Logged in', 2, '43.241.146.42', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'User:  Logged Out', 2, '43.241.146.42', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'john  (admin) Logged in', 2, '43.241.146.42', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'john  (admin) Logged in', 2, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'john  (admin) Logged in', 2, '203.189.118.133', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'john  (admin) Logged in', 2, '174.235.137.139', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'john  (admin) Logged in', 2, '110.54.248.53', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'john  (admin) Logged in', 2, '203.189.118.154', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'john  (admin) Logged in', 2, '203.189.118.154', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'john  (admin) Logged in', 2, '203.189.116.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'john  (admin) Logged in', 2, '203.189.118.154', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'john  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'john  (admin) Logged in', 2, '112.198.72.169', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'john  (admin) Logged in', 2, '112.198.73.125', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'john  (admin) Logged in', 2, '112.198.73.125', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'john  (admin) Logged in', 2, '203.189.118.190', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'john  (admin) Logged in', 2, '203.189.118.190', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'User:  Logged Out', 2, '203.189.118.190', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'john  (admin) Logged in', 2, '112.198.72.21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'john  (admin) Logged in', 2, '203.189.118.178', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'john  (admin) Logged in', 2, '112.198.73.125', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'john  (admin) Logged in', 2, '72.24.36.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'john  (admin) Logged in', 2, '112.198.73.125', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'john  (admin) Logged in', 2, '72.24.36.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'john  (admin) Logged in', 2, '112.198.73.125', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'john  (admin) Logged in', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'User:  Logged Out', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'john  (admin) Logged in', 2, '203.189.118.4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'john  (admin) Logged in', 2, '203.189.118.4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'john  (admin) Logged in', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'User:  Logged Out', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'john  (admin) Logged in', 2, '112.198.73.125', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'john  (admin) Logged in', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'User:  Logged Out', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'john  (admin) Logged in', 2, '112.198.73.116', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'john  (admin) Logged in', 2, '43.250.156.160', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'john  (admin) Logged in', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'User:  Logged Out', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'john  (admin) Logged in', 2, '112.198.72.243', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'john  (admin) Logged in', 2, '110.54.249.55', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'john  (admin) Logged in', 2, '110.54.246.54', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'john  (admin) Logged in', 2, '112.198.74.222', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'john  (admin) Logged in', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'User:  Logged Out', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'john  (admin) Logged in', 2, '43.241.146.173', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'john  (admin) Logged in', 2, '43.241.146.173', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'john  (admin) Logged in', 2, '112.198.72.243', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'Bart (bsimpson) Logged in', 3, '110.54.246.79', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'john  (admin) Logged in', 2, '124.104.184.101', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'john  (admin) Logged in', 2, '112.198.72.57', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'Bart (bsimpson) Logged in', 3, '112.198.75.161', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'User:  Logged Out', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'john  (admin) Logged in', 2, '203.189.118.93', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'Bart (bsimpson) Logged in', 3, '110.54.250.35', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'User:  Logged Out', 3, '110.54.250.35', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'john  (admin) Logged in', 2, '110.54.250.35', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'john  (admin) Logged in', 2, '110.54.250.35', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'john  (admin) Logged in', 2, '203.189.118.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'User:  Logged Out', 2, '203.189.118.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'john  (admin) Logged in', 2, '203.189.118.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'john  (admin) Logged in', 2, '110.54.250.35', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'john  (admin) Logged in', 2, '203.189.118.204', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'john  (admin) Logged in', 2, '203.189.118.8', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'john  (admin) Logged in', 2, '203.189.116.218', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'User:  Logged Out', 2, '203.189.116.218', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'john  (admin) Logged in', 2, '203.189.116.218', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'john  (admin) Logged in', 2, '112.198.73.171', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'john  (admin) Logged in', 2, '112.198.73.171', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'john  (admin) Logged in', 2, '112.198.73.171', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'john  (admin) Logged in', 2, '111.125.119.204', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'User #1 Deleted by User:', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'User #1 Deleted by User:', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'Tommy (tommy) Logged in', 5, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'User:  Logged Out', 5, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'john  (admin) Logged in', 2, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'User:  Logged Out', 2, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'john  (admin) Logged in', 2, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'New User $8 Created by User:john ', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'john  (admin) Logged in', 2, '110.54.248.84', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'User:  Logged Out', 2, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'john  (admin) Logged in', 2, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'User:  Logged Out', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'User:  Logged Out', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'john  (admin) Logged in', 2, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'User:  Logged Out', 2, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'john  (admin) Logged in', 2, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'User:  Logged Out', 2, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'john  (admin) Logged in', 2, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'User:  Logged Out', 2, '110.54.249.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'john  (admin) Logged in', 2, '203.189.118.226', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'john  (admin) Logged in', 2, '119.94.187.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'john  (admin) Logged in', 2, '203.189.118.226', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'john  (admin) Logged in', 2, '110.54.248.84', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'New User $9 Created by User:john ', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'User #1 Deleted by User:', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'john  (admin) Logged in', 2, '110.54.251.47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'john  (admin) Logged in', 2, '203.189.118.173', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'john  (admin) Logged in', 2, '110.54.248.152', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'john  (admin) Logged in', 2, '110.54.251.47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'User: John  Smith Logged Out', 2, '110.54.251.47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'john  (admin) Logged in', 2, '110.54.251.47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, 'john  (admin) Logged in', 2, '49.146.43.181', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(241, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(242, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(243, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(244, 'john  (admin) Logged in', 2, '110.54.251.47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(245, 'john  (admin) Logged in', 2, '110.54.251.47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(246, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(247, 'john  (admin) Logged in', 2, '45.155.89.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(248, 'john  (admin) Logged in', 2, '110.54.250.130', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(249, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(250, 'inventory imported successfully. Total Rows (104) | Inserted (104) | Updated (0) | Not Inserted (0)', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(251, 'New User $10 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(252, 'New User $11 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(253, 'New User $12 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(254, 'New User $13 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(255, 'New User $14 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(256, 'New User $15 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(257, 'New User $16 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(258, 'New User $17 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(259, 'New User $18 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(260, 'New User $19 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(261, 'New User $20 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(262, 'New User $21 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(263, 'User #1 Deleted by User:', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(264, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(265, 'User #1 Deleted by User:', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(266, 'New item Categories # Created by User: #2', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(267, 'john  (admin) Logged in', 2, '119.94.187.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(268, 'john  (admin) Logged in', 2, '119.94.187.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(269, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(270, 'User #1 Deleted by User:', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(271, 'New User $22 Created by User:john ', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(272, 'john  (admin) Logged in', 2, '43.250.156.21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(273, 'john  (admin) Logged in', 2, '112.198.74.71', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(274, 'john  (admin) Logged in', 2, '106.76.80.223', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(275, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(276, 'john  (admin) Logged in', 2, '203.189.118.50', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(277, 'john  (admin) Logged in', 2, '203.189.118.50', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(278, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(279, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(280, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(281, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(282, 'john  (admin) Logged in', 2, '203.189.118.92', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(283, 'john  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(284, 'john  (admin) Logged in', 2, '112.198.75.37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(285, 'User: John  Smith Logged Out', 2, '112.198.75.37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(286, 'john  (admin) Logged in', 2, '112.198.75.37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(287, 'john  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(288, 'john  (admin) Logged in', 2, '45.155.89.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(289, 'john  (admin) Logged in', 2, '119.94.187.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(290, 'john  (admin) Logged in', 2, '174.235.131.56', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(291, 'john  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(292, 'inventory imported successfully. Total Rows (104) | Inserted (0) | Updated (104) | Not Inserted (0)', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(293, 'Jon (jonc) Logged in', 6, '112.198.75.37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(294, 'john  (admin) Logged in', 2, '112.198.75.37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(295, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(296, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(297, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(298, 'New Job # Created by User: #2', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(299, 'New Job # Created by User: #2', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(300, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(301, 'john  (admin) Logged in', 2, '112.198.75.37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(302, 'john  (admin) Logged in', 2, '174.240.129.63', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(303, 'john  (admin) Logged in', 2, '203.189.118.120', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(304, 'john  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(305, 'john  (admin) Logged in', 2, '174.240.129.63', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(306, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(307, 'john  (admin) Logged in', 2, '110.54.248.178', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(308, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(309, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(310, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(311, 'john  (admin) Logged in', 2, '119.94.187.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(312, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(313, 'john  (admin) Logged in', 2, '110.54.249.76', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(314, 'john  (admin) Logged in', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(315, 'User: John  Smith Logged Out', 2, '103.137.204.28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(316, 'john  (admin) Logged in', 2, '110.54.247.83', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(317, 'john  (admin) Logged in', 2, '112.110.74.247', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(318, 'john  (admin) Logged in', 2, '157.32.87.180', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(319, 'john  (admin) Logged in', 2, '119.94.187.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(320, 'john  (admin) Logged in', 2, '203.189.118.4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(321, 'john  (admin) Logged in', 2, '49.146.43.181', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(322, 'john  (admin) Logged in', 2, '103.105.234.66', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(323, 'john  (admin) Logged in', 2, '43.241.145.239', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(324, 'User: John  Smith Logged Out', 2, '103.105.234.66', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(325, 'john  (admin) Logged in', 2, '103.105.234.66', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(326, 'john  (admin) Logged in', 2, '119.94.187.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(327, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(328, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(329, 'New item Categories # Created by User: #2', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(330, 'New item #106 Created by User: #2', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(331, 'New item #107 Created by User: #2', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(332, 'john  (admin) Logged in', 2, '203.189.118.59', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(333, 'john  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(334, 'john  (admin) Logged in', 2, '110.54.251.238', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(335, 'john  (admin) Logged in', 2, '110.54.251.238', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(336, 'john  (admin) Logged in', 2, '110.54.251.238', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(337, 'john  (admin) Logged in', 2, '43.250.156.14', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(338, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(339, 'john  (admin) Logged in', 2, '119.94.187.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(340, 'john  (admin) Logged in', 2, '49.146.43.181', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(341, 'john  (admin) Logged in', 2, '103.252.35.116', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(342, 'User: John  Smith Logged Out', 2, '103.252.35.116', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(343, 'john  (admin) Logged in', 2, '203.189.118.168', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(344, 'john  (admin) Logged in', 2, '43.241.145.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(345, 'User: John  Smith Logged Out', 2, '43.241.145.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(346, 'john  (admin) Logged in', 2, '43.241.145.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(347, 'john  (admin) Logged in', 2, '43.241.145.136', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(348, 'john  (admin) Logged in', 2, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(349, 'User: John  Smith Logged Out', 2, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(350, 'john  (admin) Logged in', 2, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(351, 'User: John  Smith Logged Out', 2, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(352, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(353, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(354, 'john  (admin) Logged in', 2, '119.94.187.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(355, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(356, 'john  (admin) Logged in', 2, '203.189.118.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(357, 'john  (admin) Logged in', 2, '110.54.246.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(358, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(359, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(360, 'john  (admin) Logged in', 2, '119.94.187.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(361, 'john  (admin) Logged in', 2, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(362, 'john  (admin) Logged in', 2, '43.241.145.114', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(363, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(364, 'john  (admin) Logged in', 2, '203.189.118.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(365, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(366, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(367, 'Company Settings Updated by User: #2', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(368, 'User: John  Smith Logged Out', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(369, 'john  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(370, 'New Before/After Created by User: #2', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(371, 'New Before/After Created by User: #2', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(372, 'New Before/After Created by User: #2', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(373, 'New Before/After Created by User: #2', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(374, 'User: John  Smith Logged Out', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(375, 'john  (admin) Logged in', 2, '72.24.36.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(376, 'john  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(377, 'john  (admin) Logged in', 2, '72.24.36.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(378, 'john  (admin) Logged in', 2, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(379, 'User: John  Smith Logged Out', 2, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(380, 'john  (admin) Logged in', 2, '112.198.72.219', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(381, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(382, 'john  (admin) Logged in', 2, '112.198.75.100', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(383, 'john  (admin) Logged in', 2, '112.198.75.100', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(384, 'john  (admin) Logged in', 2, '124.104.218.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(385, 'john  (admin) Logged in', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(386, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(387, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(388, 'john  (admin) Logged in', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(389, 'User: John  Smith Logged Out', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(390, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(391, 'john  (admin) Logged in', 2, '124.104.218.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(392, 'john  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(393, 'john  (admin) Logged in', 2, '112.198.75.100', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(394, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(395, 'john  (admin) Logged in', 2, '49.146.43.181', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(396, 'john  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(397, 'John  (admin) Logged in', 2, '124.104.205.47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(398, 'John  (admin) Logged in', 2, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(399, 'User: John  Smith Logged Out', 2, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(400, 'John  (admin) Logged in', 2, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(401, 'John  (admin) Logged in', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(402, 'John  (admin) Logged in', 2, '43.250.156.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(403, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(404, 'New Before/After Created by User: #2', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(405, 'Before/After Updated by User: #2', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(406, 'John  (admin) Logged in', 2, '124.104.205.47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(407, 'John  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(408, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(409, 'John  (admin) Logged in', 2, '124.104.205.47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(410, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(411, 'John  (admin) Logged in', 2, '110.54.248.130', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(412, 'John  (admin) Logged in', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(413, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(414, 'John  (admin) Logged in', 2, '203.189.118.8', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(415, 'User: John  Smith Logged Out', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(416, 'John  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(417, 'John  (admin) Logged in', 2, '49.146.43.181', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(418, 'John  (admin) Logged in', 2, '43.241.145.88', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(419, 'John  (admin) Logged in', 2, '124.104.205.47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(420, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(421, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(422, 'John  (admin) Logged in', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(423, 'User: John  Smith Logged Out', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(424, 'John  (admin) Logged in', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(425, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(426, 'John  (admin) Logged in', 2, '219.91.196.142', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(427, 'John  (admin) Logged in', 2, '110.54.248.130', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(428, 'John  (admin) Logged in', 2, '43.241.145.13', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(429, 'John  (admin) Logged in', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(430, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(431, 'User: John  Smith Logged Out', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(432, 'John  (admin) Logged in', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(433, 'User: John  Smith Logged Out', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(434, 'John  (admin) Logged in', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(435, 'User: John  Smith Logged Out', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(436, 'John  (admin) Logged in', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(437, 'User: John  Smith Logged Out', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(438, 'John  (admin) Logged in', 2, '112.198.74.201', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(439, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(440, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(441, 'John  (admin) Logged in', 2, '174.235.137.4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(442, 'John  (admin) Logged in', 2, '203.189.118.164', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(443, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(444, 'John  (admin) Logged in', 2, '203.189.118.111', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(445, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(446, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(447, 'John  (admin) Logged in', 2, '110.54.250.219', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(448, 'John  (admin) Logged in', 2, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(449, 'User: John  Smith Logged Out', 2, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(450, 'John  (admin) Logged in', 2, '124.104.14.69', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(451, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(452, 'John  (admin) Logged in', 2, '68.225.66.214', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(453, 'John  (admin) Logged in', 2, '112.198.72.40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(454, 'John  (admin) Logged in', 2, '124.104.14.69', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(455, 'John  (admin) Logged in', 2, '110.54.250.71', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(456, 'John  (admin) Logged in', 2, '112.198.72.40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(457, 'John  (admin) Logged in', 2, '112.198.74.184', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(458, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(459, 'John  (admin) Logged in', 2, '112.198.72.40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(460, 'John  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(461, 'John  (admin) Logged in', 2, '110.54.250.71', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(462, 'User: John  Smith Logged Out', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(463, 'John  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(464, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(465, 'User: John  Smith Logged Out', 2, '110.54.250.71', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(466, 'Tommy (tommy) Logged in', 5, '110.54.250.71', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(467, 'John  (admin) Logged in', 2, '106.77.157.8', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(468, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(469, 'John  (admin) Logged in', 2, '110.54.250.71', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(470, 'John  (admin) Logged in', 2, '112.198.74.184', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(471, 'John  (admin) Logged in', 2, '203.189.118.135', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(472, 'John  (admin) Logged in', 2, '110.54.250.71', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(473, 'John  (admin) Logged in', 2, '49.146.43.181', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(474, 'John  (admin) Logged in', 2, '43.241.146.232', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(475, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(476, 'John  (admin) Logged in', 2, '203.189.118.137', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(477, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(478, 'User: John  Smith Logged Out', 2, '203.189.118.137', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(479, 'John  (admin) Logged in', 2, '110.54.251.214', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(480, 'John  (admin) Logged in', 2, '43.250.156.116', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(481, 'John  (admin) Logged in', 2, '174.240.152.232', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(482, 'John  (admin) Logged in', 2, '43.250.156.148', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(483, 'John  (admin) Logged in', 2, '110.54.251.214', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(484, 'John  (admin) Logged in', 2, '174.235.138.23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(485, 'John  (admin) Logged in', 2, '174.235.138.23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(486, 'John  (admin) Logged in', 2, '174.235.138.23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(487, 'John  (admin) Logged in', 2, '174.235.138.23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(488, 'John  (admin) Logged in', 2, '174.235.138.23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(489, 'John  (admin) Logged in', 2, '174.235.138.23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(490, 'John  (admin) Logged in', 2, '175.176.70.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(491, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(492, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(493, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(494, 'John  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(495, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(496, 'John  (admin) Logged in', 2, '110.54.251.223', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(497, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(498, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(499, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(500, 'John  (admin) Logged in', 2, '175.176.40.67', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(501, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(502, 'John  (admin) Logged in', 2, '123.201.70.145', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(503, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(504, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(505, 'John  (admin) Logged in', 2, '43.241.146.81', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `activity_logs` (`id`, `title`, `user`, `ip_address`, `created_at`, `updated_at`) VALUES
(506, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(507, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(508, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(509, 'John  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(510, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(511, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(512, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(513, 'User: John  Smith Logged Out', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(514, 'John  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(515, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(516, 'John  (admin) Logged in', 2, '112.198.72.87', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(517, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(518, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(519, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(520, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(521, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(522, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(523, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(524, 'John  (admin) Logged in', 2, '110.54.248.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(525, 'User: John  Smith Logged Out', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(526, 'John  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(527, 'John  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(528, 'John  (admin) Logged in', 2, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(529, 'John  (admin) Logged in', 2, '203.189.118.203', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(530, 'John  (admin) Logged in', 2, '203.189.118.204', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(531, 'John  (admin) Logged in', 2, '180.191.211.35', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(532, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(533, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(534, 'John  (admin) Logged in', 2, '43.241.146.99', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(535, 'John  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(536, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(537, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(538, 'John  (admin) Logged in', 2, '110.54.248.33', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(539, 'John  (admin) Logged in', 2, '203.189.116.204', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(540, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(541, 'John  (admin) Logged in', 2, '203.189.116.204', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(542, 'John  (admin) Logged in', 2, '43.241.145.212', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(543, 'John  (admin) Logged in', 2, '43.241.145.212', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(544, 'John  (admin) Logged in', 2, '43.241.145.13', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(545, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(546, 'John  (admin) Logged in', 2, '203.189.118.203', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(547, 'John  (admin) Logged in', 2, '43.241.145.212', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(548, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(549, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(550, 'John  (admin) Logged in', 2, '112.198.72.87', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(551, 'John  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(552, 'John  (admin) Logged in', 2, '110.54.248.33', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(553, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(554, 'John  (admin) Logged in', 2, '112.198.72.87', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(555, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(556, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(557, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(558, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(559, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(560, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(561, 'John  (admin) Logged in', 2, '180.191.211.35', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(562, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(563, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(564, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(565, 'John  (admin) Logged in', 2, '123.201.65.73', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(566, 'John  (admin) Logged in', 2, '43.250.156.89', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(567, 'John  (admin) Logged in', 2, '43.241.146.189', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(568, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(569, 'John  (admin) Logged in', 2, '110.54.248.33', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(570, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(571, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(572, 'John  (admin) Logged in', 2, '112.198.72.87', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(573, 'John  (admin) Logged in', 2, '203.189.118.85', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(574, 'John  (admin) Logged in', 2, '112.198.72.87', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(575, 'John  (admin) Logged in', 2, '106.76.89.168', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(576, 'User: John  Smith Logged Out', 2, '203.189.118.85', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(577, 'John  (admin) Logged in', 2, '203.189.118.85', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(578, 'User: John  Smith Logged Out', 2, '112.198.72.87', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(579, 'John  (admin) Logged in', 2, '174.235.135.64', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(580, 'John  (admin) Logged in', 2, '174.235.135.64', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(581, 'John  (admin) Logged in', 2, '174.235.135.64', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(582, 'John  (admin) Logged in', 2, '174.235.135.64', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(583, 'John  (admin) Logged in', 2, '174.235.135.64', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(584, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(585, 'John  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(586, 'Gil (gil) Logged in', 15, '103.252.35.125', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(587, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.125', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(588, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(589, 'Updated item # Created by User: #2', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(590, 'Updated item # Created by User: #2', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(591, 'User #2 Updated his/her Profile Image updated.', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(592, 'User #2 Updated his/her Profile Image updated.', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(593, 'John  (admin) Logged in', 2, '203.109.114.244', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(594, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(595, 'John  (admin) Logged in', 2, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(596, 'John  (admin) Logged in', 2, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(597, 'John  (admin) Logged in', 2, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(598, 'John  (admin) Logged in', 2, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(599, 'User: John  Smith Logged Out', 2, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(600, 'John  (admin) Logged in', 2, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(601, 'John  (admin) Logged in', 2, '219.91.190.6', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(602, 'User: John  Smith Logged Out', 2, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(603, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(604, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(605, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(606, 'John  (admin) Logged in', 2, '203.189.118.151', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(607, 'John  (admin) Logged in', 2, '203.189.118.151', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(608, 'John  (admin) Logged in', 2, '203.189.116.91', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(609, 'John  (admin) Logged in', 2, '203.189.118.154', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(610, 'John  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(611, 'John  (admin) Logged in', 2, '203.189.118.154', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(612, 'John  (admin) Logged in', 2, '219.91.191.25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(613, 'John  (admin) Logged in', 2, '43.250.156.122', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(614, 'John  (admin) Logged in', 2, '210.185.171.21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(615, 'John  (admin) Logged in', 2, '203.189.118.154', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(616, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(617, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(618, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(619, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(620, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(621, 'Tommy (tommy) Logged in', 5, '203.189.118.154', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(622, 'Tommy (tommy) Logged in', 5, '203.189.118.154', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(623, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(624, 'John  (admin) Logged in', 2, '203.189.116.91', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(625, 'John  (admin) Logged in', 2, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(626, 'John  (admin) Logged in', 2, '110.54.249.19', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(627, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(628, 'John  (admin) Logged in', 2, '203.109.114.193', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(629, 'John  (admin) Logged in', 2, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(630, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(631, 'John  (admin) Logged in', 2, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(632, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(633, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(634, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(635, 'John  (admin) Logged in', 2, '210.185.171.21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(636, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(637, 'John  (admin) Logged in', 2, '203.189.118.151', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(638, 'John  (admin) Logged in', 2, '203.189.118.151', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(639, 'John  (admin) Logged in', 2, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(640, 'John  (admin) Logged in', 2, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(641, 'John  (admin) Logged in', 2, '203.189.116.141', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(642, 'John  (admin) Logged in', 2, '203.189.118.154', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(643, 'John  (admin) Logged in', 2, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(644, 'User: John  Smith Logged Out', 2, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(645, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(646, 'John  (admin) Logged in', 2, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(647, 'John  (admin) Logged in', 2, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(648, 'User: John  Smith Logged Out', 2, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(649, 'John  (admin) Logged in', 2, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(650, 'User: John  Smith Logged Out', 2, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(651, 'John  (admin) Logged in', 2, '203.189.118.154', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(652, 'John  (admin) Logged in', 2, '219.91.191.6', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(653, 'John  (admin) Logged in', 2, '219.91.191.6', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(654, 'John  (admin) Logged in', 2, '43.241.146.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(655, 'John  (admin) Logged in', 2, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(656, 'John  (admin) Logged in', 2, '180.191.211.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(657, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(658, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(659, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(660, 'John  (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(661, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(662, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(663, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(664, 'John  (admin) Logged in', 2, '219.91.196.232', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(665, 'John  (admin) Logged in', 2, '203.189.118.154', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(666, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(667, 'John  (admin) Logged in', 2, '68.225.66.214', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(668, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(669, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(670, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(671, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(672, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(673, 'John  (admin) Logged in', 2, '203.189.118.155', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(674, 'John  (admin) Logged in', 2, '210.185.171.139', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(675, 'Gil (gil) Logged in', 15, '175.176.40.111', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(676, 'User #2 changed the password !', 0, '203.189.118.155', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(677, 'John  (admin) Logged in', 2, '203.189.118.155', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(678, 'User: John  Smith Logged Out', 2, '203.189.118.155', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(679, 'Tommy (tommy) Logged in', 5, '203.189.118.155', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(680, 'User #5 changed the password !', 0, '203.189.118.155', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(681, 'Tommy (tommy) Logged in', 5, '203.189.118.155', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(682, 'User: Tommy N Logged Out', 5, '203.189.118.155', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(683, 'John  (admin) Logged in', 2, '43.250.156.96', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(684, 'John  (admin) Logged in', 2, '43.250.156.96', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(685, 'John  (admin) Logged in', 2, '43.250.156.96', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(686, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(687, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(688, 'Artemeo (artemeo) Logged in', 11, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(689, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(690, 'Artemeo (artemeo) Logged in', 11, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(691, 'User: Artemeo Alberca Logged Out', 11, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(692, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(693, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(694, 'Before/After Updated by User: #2', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(695, 'Before/After Updated by User: #2', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(696, 'Updated item # Created by User: #2', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(697, 'Updated item # Created by User: #2', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(698, 'Updated item # Created by User: #2', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(699, 'Updated item # Created by User: #2', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(700, 'Updated item # Created by User: #2', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(701, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(702, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(703, 'Artemeo (artemeo) Logged in', 11, '175.176.71.143', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(704, 'Artemeo (artemeo) Logged in', 11, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(705, 'Artemeo (artemeo) Logged in', 11, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(706, 'New Before/After Created by User: #11', 11, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(707, 'New Before/After Created by User: #11', 11, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(708, 'New Before/After Created by User: #11', 11, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(709, 'New Before/After Created by User: #11', 11, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(710, 'New Before/After Created by User: #11', 11, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(711, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(712, 'Tommy (tommy) Logged in', 5, '203.189.118.188', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(713, 'John  (admin) Logged in', 2, '174.235.138.119', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(714, 'Artemeo (artemeo) Logged in', 11, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(715, 'inventory imported successfully. Total Rows (104) | Inserted (0) | Updated (104) | Not Inserted (0)', 11, '110.54.249.199', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(716, 'John  (admin) Logged in', 2, '203.189.118.196', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(717, 'John  (admin) Logged in', 2, '123.201.70.214', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(718, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(719, 'Before/After Updated by User: #2', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(720, 'New Before/After Created by User: #2', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(721, 'John  (admin) Logged in', 2, '203.109.114.139', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(722, 'John  (admin) Logged in', 2, '174.235.133.181', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(723, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(724, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(725, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(726, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(727, 'John  (admin) Logged in', 2, '49.146.42.43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(728, 'John  (admin) Logged in', 2, '43.241.146.41', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(729, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(730, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(731, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(732, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(733, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(734, 'Artemeo (artemeo) Logged in', 11, '112.198.74.103', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(735, 'Artemeo (artemeo) Logged in', 11, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(736, 'User: Artemeo Alberca Logged Out', 11, '112.198.74.103', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(737, 'Artemeo (artemeo) Logged in', 11, '112.198.74.103', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(738, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(739, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(740, 'John  (admin) Logged in', 2, '123.201.67.180', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(741, 'John  (admin) Logged in', 2, '43.241.146.86', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(742, 'Gil (gil) Logged in', 15, '175.176.41.73', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(743, 'User: Gil Francis Carillo Logged Out', 15, '175.176.41.73', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(744, 'Artemeo (artemeo) Logged in', 11, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(745, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(746, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(747, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(748, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(749, 'Artemeo (artemeo) Logged in', 11, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(750, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(751, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(752, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(753, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(754, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(755, 'John  (admin) Logged in', 2, '43.250.156.45', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(756, 'Artemeo (artemeo) Logged in', 11, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(757, 'John  (admin) Logged in', 2, '43.241.146.1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(758, 'John  (admin) Logged in', 2, '203.189.118.65', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(759, 'John  (admin) Logged in', 2, '43.241.146.8', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(760, 'John  (admin) Logged in', 2, '203.189.118.65', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(761, 'Artemeo (artemeo) Logged in', 11, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(762, 'John  (admin) Logged in', 2, '43.241.146.1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(763, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(764, 'John  (admin) Logged in', 2, '203.189.118.65', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(765, 'John  (admin) Logged in', 2, '203.189.118.65', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(766, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(767, 'John  (admin) Logged in', 2, '43.241.146.1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(768, 'Artemeo (artemeo) Logged in', 11, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(769, 'Artemeo (artemeo) Logged in', 11, '112.198.74.166', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(770, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(771, 'John  (admin) Logged in', 2, '203.189.118.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(772, 'John  (admin) Logged in', 2, '43.241.146.184', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(773, 'John  (admin) Logged in', 2, '49.145.200.24', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(774, 'John  (admin) Logged in', 2, '43.241.146.184', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(775, 'John  (admin) Logged in', 2, '43.241.146.184', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(776, 'John  (admin) Logged in', 2, '203.189.118.99', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(777, 'John  (admin) Logged in', 2, '203.189.118.99', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(778, 'John  (admin) Logged in', 2, '112.198.74.62', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(779, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(780, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(781, 'John  (admin) Logged in', 2, '49.146.42.46', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(782, 'John  (admin) Logged in', 2, '43.250.156.37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(783, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(784, 'Artemeo (artemeo) Logged in', 11, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(785, 'User: Artemeo Alberca Logged Out', 11, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(786, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(787, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(788, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(789, 'John  (admin) Logged in', 2, '49.146.42.46', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(790, 'John  (admin) Logged in', 2, '203.189.118.215', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(791, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(792, 'John  (admin) Logged in', 2, '49.146.42.46', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(793, 'John  (admin) Logged in', 2, '43.250.156.120', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(794, 'John  (admin) Logged in', 2, '43.250.156.120', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(795, 'John  (admin) Logged in', 2, '43.250.156.120', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(796, 'John  (admin) Logged in', 2, '203.189.118.215', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(797, 'John  (admin) Logged in', 2, '43.250.156.120', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(798, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(799, 'John  (admin) Logged in', 2, '43.241.145.84', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(800, 'John  (admin) Logged in', 2, '203.189.118.253', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(801, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(802, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(803, 'Artemeo (artemeo) Logged in', 11, '110.54.251.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(804, 'inventory imported successfully. Total Rows (100) | Inserted (0) | Updated (100) | Not Inserted (0)', 11, '110.54.251.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(805, 'inventory imported successfully. Total Rows (100) | Inserted (0) | Updated (100) | Not Inserted (0)', 11, '110.54.251.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(806, 'Artemeo (artemeo) Logged in', 11, '110.54.251.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(807, 'inventory imported successfully. Total Rows (104) | Inserted (0) | Updated (104) | Not Inserted (0)', 11, '110.54.251.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(808, 'John  (admin) Logged in', 2, '203.189.118.253', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(809, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(810, 'John  (admin) Logged in', 2, '49.146.42.46', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(811, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(812, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(813, 'John  (admin) Logged in', 2, '203.189.118.253', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(814, 'John  (admin) Logged in', 2, '203.189.118.4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(815, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(816, 'John  (admin) Logged in', 2, '112.198.74.62', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(817, 'John  (admin) Logged in', 2, '203.189.118.253', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(818, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(819, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(820, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(821, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(822, 'Artemeo (artemeo) Logged in', 11, '110.54.251.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(823, 'Artemeo (artemeo) Logged in', 11, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(824, 'John  (admin) Logged in', 2, '49.146.42.46', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(825, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(826, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(827, 'John  (admin) Logged in', 2, '203.189.118.4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(828, 'John  (admin) Logged in', 2, '43.241.145.208', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(829, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(830, 'Artemeo (artemeo) Logged in', 11, '110.54.251.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(831, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(832, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(833, 'Artemeo (artemeo) Logged in', 11, '110.54.251.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(834, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(835, 'John  (admin) Logged in', 2, '49.146.42.46', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(836, 'John  (admin) Logged in', 2, '43.241.146.213', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(837, 'Artemeo (artemeo) Logged in', 11, '210.185.171.156', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(838, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(839, 'John  (admin) Logged in', 2, '180.190.198.110', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(840, 'Artemeo (artemeo) Logged in', 11, '210.185.171.156', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(841, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(842, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(843, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(844, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(845, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(846, 'User: John  Smith Logged Out', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(847, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(848, 'John  (admin) Logged in', 2, '203.189.118.186', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(849, 'John  (admin) Logged in', 2, '203.189.118.105', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(850, 'John  (admin) Logged in', 2, '43.241.146.228', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(851, 'John  (admin) Logged in', 2, '49.145.192.148', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(852, 'John  (admin) Logged in', 2, '203.189.118.186', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(853, 'John  (admin) Logged in', 2, '110.54.251.229', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(854, 'John  (admin) Logged in', 2, '49.146.43.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(855, 'Artemeo (artemeo) Logged in', 11, '210.185.171.156', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(856, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(857, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(858, 'John  (admin) Logged in', 2, '50.89.220.128', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(859, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(860, 'John  (admin) Logged in', 2, '49.146.43.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(861, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(862, 'John  (admin) Logged in', 2, '110.54.247.133', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(863, 'John  (admin) Logged in', 2, '203.189.118.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(864, 'Artemeo (artemeo) Logged in', 11, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(865, 'User: Artemeo Alberca Logged Out', 11, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(866, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(867, 'Artemeo (artemeo) Logged in', 11, '210.185.171.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(868, 'User: Artemeo Alberca Logged Out', 11, '210.185.171.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(869, 'Artemeo (artemeo) Logged in', 11, '210.185.171.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(870, 'John  (admin) Logged in', 2, '50.89.220.128', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(871, 'User: John  Smith Logged Out', 2, '50.89.220.128', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(872, 'John  (admin) Logged in', 2, '50.89.220.128', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(873, 'User #11 Updated his/her Profile Image updated.', 11, '210.185.171.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(874, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(875, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(876, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(877, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(878, 'John  (admin) Logged in', 2, '203.189.118.15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(879, 'John  (admin) Logged in', 2, '203.189.118.8', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(880, 'John  (admin) Logged in', 2, '203.189.116.235', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(881, 'User: John  Smith Logged Out', 2, '203.189.118.15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(882, 'John  (admin) Logged in', 2, '203.189.118.15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(883, 'John  (admin) Logged in', 2, '203.189.118.15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(884, 'John  (admin) Logged in', 2, '203.189.118.15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(885, 'Bryann (bryann) Logged in', 17, '203.189.116.235', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(886, 'Artemeo (artemeo) Logged in', 11, '112.199.97.162', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(887, 'John  (admin) Logged in', 2, '123.201.70.159', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(888, 'John  (admin) Logged in', 2, '174.240.141.191', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(889, 'John  (admin) Logged in', 2, '203.189.118.234', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(890, 'John  (admin) Logged in', 2, '203.189.118.8', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(891, 'John  (admin) Logged in', 2, '112.198.74.51', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(892, 'John  (admin) Logged in', 2, '43.241.146.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(893, 'Artemeo (artemeo) Logged in', 11, '210.185.171.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(894, 'John  (admin) Logged in', 2, '106.76.91.47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(895, 'John  (admin) Logged in', 2, '174.240.141.191', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(896, 'User: Artemeo Alberca Logged Out', 11, '210.185.171.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(897, 'Artemeo (artemeo) Logged in', 11, '210.185.171.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(898, 'User: Artemeo Alberca Logged Out', 11, '210.185.171.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(899, 'Artemeo (artemeo) Logged in', 11, '210.185.171.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(900, 'User: Artemeo Alberca Logged Out', 11, '210.185.171.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(901, 'Artemeo (artemeo) Logged in', 11, '210.185.171.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(902, 'Artemeo (artemeo) Logged in', 11, '210.185.171.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(903, 'John  (admin) Logged in', 2, '174.240.141.191', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(904, 'John  (admin) Logged in', 2, '106.77.70.107', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(905, 'Artemeo (artemeo) Logged in', 11, '175.176.71.192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(906, 'John  (admin) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(907, 'John  (admin) Logged in', 2, '49.146.43.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(908, 'John  (admin) Logged in', 2, '203.189.118.42', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(909, 'John  (admin) Logged in', 2, '43.241.146.99', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(910, 'John  (admin) Logged in', 2, '27.61.231.100', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(911, 'Artemeo (artemeo) Logged in', 11, '210.185.171.168', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(912, 'Artemeo (artemeo) Logged in', 11, '210.185.171.168', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(913, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(914, 'Jerry  (jerry) Logged in', 12, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(915, 'User: Jerry  Tiu Logged Out', 12, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(916, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(917, 'John  (admin) Logged in', 2, '49.146.43.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(918, 'John  (admin) Logged in', 2, '203.189.118.202', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(919, 'John  (admin) Logged in', 2, '203.189.118.144', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(920, 'John  (admin) Logged in', 2, '203.189.116.143', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(921, 'John  (admin) Logged in', 2, '203.189.118.26', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(922, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(923, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(924, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(925, 'User #2 Updated by User:', 0, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(926, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(927, 'Artemeo (artemeo) Logged in', 11, '210.185.171.168', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(928, 'John  (admin) Logged in', 2, '210.185.171.170', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(929, 'John  (admin) Logged in', 2, '180.191.207.64', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(930, 'John  (admin) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(931, 'John  (admin) Logged in', 2, '112.198.74.7', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(932, 'Artemeo (artemeo) Logged in', 11, '210.185.171.168', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(933, 'Artemeo (artemeo) Logged in', 11, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(934, 'User #2 Updated by User:Artemeo', 11, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(935, 'User #2 Updated by User:Artemeo', 11, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(936, 'User #1 Deleted by User:', 11, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(937, 'User #1 Deleted by User:', 11, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(938, 'User #2 Updated by User:Artemeo', 11, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(939, 'User #2 Updated by User:Artemeo', 11, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(940, 'Jerry  (jerry) Logged in', 12, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(941, 'User: Jerry  Tiu Logged Out', 12, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(942, 'Artemeo (artemeo) Logged in', 11, '180.191.207.64', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(943, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(944, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(945, 'Artemeo (artemeo) Logged in', 11, '210.185.171.168', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(946, 'Lauren (Lauren) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(947, 'Lauren (Lauren) Logged in', 2, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(948, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(949, 'Artemeo (artemeo) Logged in', 11, '210.185.171.168', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(950, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(951, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(952, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(953, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(954, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(955, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(956, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(957, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(958, 'Artemeo (artemeo) Logged in', 11, '110.54.247.198', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(959, 'Jerry  (jerry) Logged in', 12, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(960, 'User: Jerry  Tiu Logged Out', 12, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(961, 'Jerry  (jerry) Logged in', 12, '43.241.145.231', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(962, 'Jerry  (jerry) Logged in', 12, '106.77.79.8', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(963, 'Gil (gil) Logged in', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(964, 'User: Gil Francis Carillo Logged Out', 15, '103.252.35.124', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(965, 'Artemeo (artemeo) Logged in', 11, '110.54.247.198', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(966, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(967, 'Artemeo (artemeo) Logged in', 11, '110.54.247.198', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(968, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(969, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(970, 'Artemeo (artemeo) Logged in', 11, '110.54.247.198', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(971, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(972, 'Artemeo (artemeo) Logged in', 11, '112.198.72.174', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(973, 'Lauren (Lauren) Logged in', 2, '49.146.43.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(974, 'Artemeo (artemeo) Logged in', 11, '112.198.72.174', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(975, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(976, 'Lauren (Lauren) Logged in', 2, '180.191.207.64', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(977, 'Lauren (Lauren) Logged in', 2, '203.189.118.247', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(978, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(979, 'Lauren (Lauren) Logged in', 2, '180.191.207.64', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(980, 'Lauren (Lauren) Logged in', 2, '112.198.74.117', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(981, 'Artemeo (artemeo) Logged in', 11, '110.54.247.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(982, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(983, 'User #2 Updated by User:Lauren', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(984, 'Artemeo (artemeo) Logged in', 11, '110.54.247.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(985, 'User #2 Updated by User:Artemeo', 11, '110.54.247.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(986, 'User #10 Updated by User:Artemeo', 11, '110.54.247.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(987, 'User #2 Updated by User:Lauren', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(988, 'User #2 Updated by User:Lauren', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(989, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(990, 'inventory imported successfully. Total Rows (105) | Inserted (2) | Updated (103) | Not Inserted (0)', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(991, 'inventory imported successfully. Total Rows (105) | Inserted (0) | Updated (105) | Not Inserted (0)', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(992, 'Lauren (Lauren) Logged in', 2, '180.191.207.64', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(993, 'Lauren (Lauren) Logged in', 2, '203.189.118.84', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(994, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(995, 'Lauren (Lauren) Logged in', 2, '49.146.43.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(996, 'Lauren (Lauren) Logged in', 2, '203.189.118.84', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `activity_logs` (`id`, `title`, `user`, `ip_address`, `created_at`, `updated_at`) VALUES
(997, 'Artemeo (artemeo) Logged in', 11, '110.54.247.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(998, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(999, 'User #10 Updated by User:Lauren', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1000, 'User #11 Updated by User:Lauren', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1001, 'User #12 Updated by User:Lauren', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1002, 'User #13 Updated by User:Lauren', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1003, 'User #14 Updated by User:Lauren', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1004, 'User #15 Updated by User:Lauren', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1005, 'User #17 Updated by User:Lauren', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1006, 'User #22 Updated by User:Lauren', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1007, 'Artemeo (artemeo) Logged in', 11, '110.54.247.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1008, 'Artemeo (artemeo) Logged in', 11, '110.54.247.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1009, 'Artemeo (artemeo) Logged in', 11, '110.54.247.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1010, 'Artemeo (artemeo) Logged in', 11, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1011, 'User #10 Updated by User:Artemeo', 11, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1012, 'User #11 Updated by User:Artemeo', 11, '12.182.223.132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1013, 'Artemeo (artemeo) Logged in', 11, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1014, 'Artemeo (artemeo) Logged in', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1015, 'Lauren (Lauren) Logged in', 2, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1016, 'Lauren (Lauren) Logged in', 2, '49.146.43.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1017, 'Artemeo (artemeo) Logged in', 11, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1018, 'Artemeo (artemeo) Logged in', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1019, 'Lauren (Lauren) Logged in', 2, '49.146.43.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1020, 'Jerry  (jerry) Logged in', 12, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1021, 'Lauren (Lauren) Logged in', 2, '203.189.118.188', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1022, 'Jerry  (jerry) Logged in', 12, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1023, 'Artemeo (artemeo) Logged in', 11, '174.69.30.11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1024, 'Lauren (Lauren) Logged in', 2, '110.54.247.218', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1025, 'Artemeo (artemeo) Logged in', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1026, 'Artemeo (artemeo) Logged in', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1027, 'Lauren (Lauren) Logged in', 2, '203.189.118.40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1028, 'User #17 Updated by User:Lauren', 2, '203.189.118.40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1029, 'Lauren (Lauren) Logged in', 2, '49.146.43.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1030, 'Lauren (Lauren) Logged in', 2, '110.54.247.218', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1031, 'Gil (gil) Logged in', 15, '103.36.19.84', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1032, 'Artemeo (artemeo) Logged in', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1033, 'Jerry  (jerry) Logged in', 12, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1034, 'User: Gil Francis Carillo Logged Out', 15, '103.36.19.84', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1035, 'Gil (gil) Logged in', 15, '103.36.19.84', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1036, 'User: Gil Francis Carillo Logged Out', 15, '103.36.19.84', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1037, 'Artemeo (artemeo) Logged in', 11, '175.176.71.223', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1038, 'Lauren (Lauren) Logged in', 2, '174.240.133.220', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1039, 'Artemeo (artemeo) Logged in', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1040, 'Artemeo (artemeo) Logged in', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1041, 'Artemeo (artemeo) Logged in', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1042, 'affiliates imported successfully. Total Rows (5) | Inserted (5) | Updated (0) | Not Inserted (0)', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1043, 'Lauren (Lauren) Logged in', 2, '174.235.129.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1044, 'affiliates imported successfully. Total Rows (5) | Inserted (5) | Updated (0) | Not Inserted (0)', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1045, 'New item #1 Created by User: #11', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1046, 'New item #11 Created by User: #11', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1047, 'Lauren (Lauren) Logged in', 2, '49.146.43.183', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1048, 'Artemeo (artemeo) Logged in', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1049, 'Artemeo (artemeo) Logged in', 11, '210.185.171.233', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1050, 'Artemeo (artemeo) Logged in', 11, '174.235.131.40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1051, 'Artemeo (artemeo) Logged in', 11, '174.240.132.163', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1052, 'Lauren (Lauren) Logged in', 2, '174.240.132.163', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1053, 'Lauren (Lauren) Logged in', 2, '110.54.247.198', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1054, 'Lauren (Lauren) Logged in', 2, '49.146.36.94', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1055, 'Lauren (Lauren) Logged in', 2, '174.235.140.67', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1056, 'Lauren (Lauren) Logged in', 2, '174.235.140.67', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1057, 'Lauren (Lauren) Logged in', 2, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1058, 'User: Lauren Williams Logged Out', 2, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1059, 'Lauren (Lauren) Logged in', 2, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1060, 'User: Lauren Williams Logged Out', 2, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1061, 'Jon (jonc) Logged in', 6, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1062, 'User: Jon C Logged Out', 6, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1063, 'Jon (jonc) Logged in', 6, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1064, 'User: Jon C Logged Out', 6, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1065, 'Lauren (Lauren) Logged in', 2, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1066, 'User: Lauren Williams Logged Out', 2, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1067, 'Lauren (Lauren) Logged in', 2, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1068, 'User: Lauren Williams Logged Out', 2, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1069, 'Lauren (Lauren) Logged in', 2, '103.225.136.74', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1070, 'User: Lauren Williams Logged Out', 2, '103.225.139.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1071, 'Lauren (Lauren) Logged in', 2, '49.146.36.94', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1072, 'Lauren (Lauren) Logged in', 2, '98.162.170.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ac_dashboard_sort`
--

CREATE TABLE `ac_dashboard_sort` (
  `acds_id` int(11) NOT NULL,
  `fk_user_id` int(2) UNSIGNED NOT NULL,
  `ds_values` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ac_dashboard_sort`
--

INSERT INTO `ac_dashboard_sort` (`acds_id`, `fk_user_id`, `ds_values`) VALUES
(4, 11, 'earning,analytics,report,activity,report2,newsletter,spotlight,bulletin,stats,installs'),
(5, 2, 'earning,analytics,newsletter,spotlight,bulletin,report,activity,report2,installs,stats'),
(6, 15, 'earning,analytics,report,activity,report2,newsletter,spotlight,bulletin,stats,installs'),
(7, 17, 'earning,analytics,report,activity,report2,newsletter,spotlight,bulletin,stats,installs'),
(8, 12, 'earning,analytics,report,activity,report2,newsletter,spotlight,bulletin,job,estimate,invoice,stats,installs'),
(9, 6, 'earning,analytics,report,activity,report2,newsletter,spotlight,bulletin,job,estimate,invoice,stats,installs');

-- --------------------------------------------------------

--
-- Table structure for table `ac_leads`
--

CREATE TABLE `ac_leads` (
  `leads_id` int(11) NOT NULL,
  `fk_lead_id` int(11) NOT NULL,
  `fk_assign_id` int(11) NOT NULL,
  `fk_sr_id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middle_initial` varchar(10) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `suffix` varchar(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `county` varchar(100) NOT NULL,
  `country` varchar(10) NOT NULL,
  `phone_home` varchar(50) NOT NULL,
  `phone_cell` varchar(50) NOT NULL,
  `email_add` varchar(150) NOT NULL,
  `sss_num` varchar(100) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ac_leads`
--

INSERT INTO `ac_leads` (`leads_id`, `fk_lead_id`, `fk_assign_id`, `fk_sr_id`, `firstname`, `middle_initial`, `lastname`, `suffix`, `address`, `zip`, `state`, `city`, `county`, `country`, `phone_home`, `phone_cell`, `email_add`, `sss_num`, `date_of_birth`, `status`) VALUES
(1, 5, 1, 23, 'Jane ', 't', 'Smith', '', '', '32504', 'FL', 'PENSACOLA', 'escambia', 'USA', '850-666-5675', '888-778-9876', 'moresecureadi@gmail.com', '785-766-6544', '09/15/1971', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ac_leadtypes`
--

CREATE TABLE `ac_leadtypes` (
  `lead_id` int(11) NOT NULL,
  `lead_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ac_leadtypes`
--

INSERT INTO `ac_leadtypes` (`lead_id`, `lead_name`) VALUES
(3, 'Telemarketing'),
(4, 'Affinty'),
(5, 'Self Generating'),
(6, 'Social Networks'),
(7, 'Google Ads'),
(8, 'Referrals');

-- --------------------------------------------------------

--
-- Table structure for table `ac_module_sort`
--

CREATE TABLE `ac_module_sort` (
  `ams_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `ams_values` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ac_module_sort`
--

INSERT INTO `ac_module_sort` (`ams_id`, `fk_user_id`, `ams_values`) VALUES
(7, 11, 'profile,score,tech,access,admin,office,owner,docu,tasks,memo,invoice,assign,cim,billing,alarm,dispute'),
(8, 2, 'profile,score,tech,access,admin,office,owner,docu,tasks,memo,invoice,assign,cim,billing,alarm,dispute');

-- --------------------------------------------------------

--
-- Table structure for table `ac_salesarea`
--

CREATE TABLE `ac_salesarea` (
  `sa_id` tinyint(2) NOT NULL,
  `fk_comp_id` tinyint(2) UNSIGNED NOT NULL,
  `sa_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ac_salesarea`
--

INSERT INTO `ac_salesarea` (`sa_id`, `fk_comp_id`, `sa_name`) VALUES
(1, 0, 'Corporate'),
(2, 0, 'Corporate'),
(3, 0, 'Branch Locations');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `address1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `customer_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address1`, `address2`, `city`, `state`, `postal_code`, `address_type`, `contact_name`, `email`, `phone`, `mobile`, `notes`, `user_id`, `customer_id`) VALUES
(2, '6055 Born Court', '', 'pensacola', 'FL', '32504', NULL, 'Tommy Nguyen', 'sales@nsmartrac.com', '8506195914', '', '', 23, 0),
(7, '6867 Pine Forest Road', '', 'Pensacola', 'FL', '32526', NULL, 'John Doe', 'john.doe@yopmail.com', '', '', '', 0, 2),
(8, '6055 Born Ct', '', 'Pensacola', 'FL', '32504', NULL, 'Tommy Nguyen', 'moresecureadi@gmail.com', '', '', '', 0, 3),
(9, '6967 Pines Forest Road', '', 'Pensacola', 'FL', '32526', NULL, 'Jane Smith', 'jpabanil@yopmail.com', '(888) 888-8888', '', '', 0, 1),
(10, '6055 Born Ct', '', 'Pensacola ', 'FL', '32504', NULL, 'tom test', 'moresecureadi@gmail.com', '(850) 619-5917', '', '', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `website_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email` varchar(55) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `phone` varchar(55) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `phone_ext` varchar(55) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `alternate_phone` varchar(55) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `fax` varchar(55) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `mailing_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `city` varchar(55) COLLATE utf8_unicode_ci DEFAULT '0',
  `state` varchar(55) COLLATE utf8_unicode_ci DEFAULT '0',
  `country` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(55) COLLATE utf8_unicode_ci DEFAULT '0',
  `status` varchar(55) COLLATE utf8_unicode_ci DEFAULT '0',
  `notes` text COLLATE utf8_unicode_ci,
  `photo` varchar(55) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `assigned_to` varchar(55) COLLATE utf8_unicode_ci DEFAULT '0',
  `add_master_contact_list` tinyint(4) DEFAULT '0',
  `portal_access` tinyint(4) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `affiliates`
--

INSERT INTO `affiliates` (`id`, `company_id`, `first_name`, `last_name`, `gender`, `company`, `website_url`, `email`, `phone`, `phone_ext`, `alternate_phone`, `fax`, `mailing_address`, `city`, `state`, `country`, `zipcode`, `status`, `notes`, `photo`, `assigned_to`, `add_master_contact_list`, `portal_access`, `date_created`) VALUES
(6, 1, 'Alex', 'Goolsby', 'Male', 'IdentityClub', 'https://identityclub.com', 'alex@identityclub.com', '(800) 928-6307', '', '', '', '<div style=\"border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;\">\r\n\r\n<h4>A PHP Error was encountered</h4>\r\n\r\n<p>Severity: Notice</p>\r\n<p>Message:  Undefined property: stdClass::$mail_address</p>\r\n<p>Filename: affiliate/add.php</p>\r\n<p>Line Numbe', '', 'all', 'United States', '', 'Active', '', 'light_bulb.png', '1', 0, NULL, '2020-09-18 06:08:36'),
(7, 1, 'Ken', 'Kandell', 'Male', 'Identity IQ', '', 'ken@ars101.com', '(410) 596-5304', '', '', '', '', '', '', 'United States', '', 'Active', 'this is not the correct email address for Ken Kandellhttps://www.identityiq.com/help-you-to-save-money.aspx?offercode=431145E2', '0', '0', 0, 0, '2020-09-18 06:07:43'),
(8, 1, 'Rachel', 'Contreras', 'Female', 'SmartCredit', 'http://www.consumerdirect.com', 'rcontreras@consumerdirect.com', '(714) 431-0005', '249', '', '', '', '', '', 'United States', '', 'Active', 'https://www.smartcredit.com/?PID=98955https://www.smartcredit.com/ficoheroes', '0', '0', 0, 0, '2020-09-18 06:07:43'),
(9, 1, 'Rafal', 'Tidio', 'Male', 'Tidio', '', 'rafal@tidio.net', '8503417665', '', '', '', '', '', 'Florida', 'United States', '', 'Active', 'https://www.tidio.com/en/?ref=tommynguyen2', '0', '0', 0, 0, '2020-09-18 06:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointments_id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banking_info`
--

CREATE TABLE `banking_info` (
  `banking_info_id` int(11) NOT NULL,
  `bank_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `routing` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `verified` tinyint(4) DEFAULT NULL,
  `payment_method_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `before_after`
--

CREATE TABLE `before_after` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `group_number` int(11) DEFAULT NULL,
  `before_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `after_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `before_after`
--

INSERT INTO `before_after` (`id`, `company_id`, `customer_id`, `group_number`, `before_image`, `after_image`, `note`, `created_at`) VALUES
(11, 1, 0, 1, 'Before.jpg', 'After.jpg', '', '2020-08-16 03:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `booking_category`
--

CREATE TABLE `booking_category` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_category`
--

INSERT INTO `booking_category` (`id`, `company_id`, `user_id`, `name`, `date_created`) VALUES
(1, 0, 2, 'Hardware Fixing', '2020-07-17 18:51:58'),
(2, 0, 2, 'Hardware Cleaner', '2020-07-17 18:52:12'),
(3, 0, 2, 'Test Cat', '2020-08-03 22:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `booking_coupons`
--

CREATE TABLE `booking_coupons` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `discount_from_total` float NOT NULL,
  `discount_from_total_type` varchar(100) NOT NULL,
  `date_valid_from` date NOT NULL,
  `date_valid_to` date NOT NULL,
  `used_per_coupon` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_coupons`
--

INSERT INTO `booking_coupons` (`id`, `company_id`, `user_id`, `coupon_name`, `coupon_code`, `discount_from_total`, `discount_from_total_type`, `date_valid_from`, `date_valid_to`, `used_per_coupon`, `status`, `date_created`) VALUES
(1, 0, 2, '40% Discount', 'coupon40', 40, '1', '2020-07-31', '2020-08-19', 10, 1, '2020-08-01 02:32:54'),
(2, 0, 2, '30% Discount', 'coupon30', 30, '1', '2020-07-28', '2020-08-12', 3, 1, '2020-08-01 04:21:48'),
(3, 0, 2, '50% Discount', 'coupon50', 50, '1', '2020-08-10', '2020-08-31', 5, 1, '2020-08-03 22:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `booking_forms`
--

CREATE TABLE `booking_forms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `field_name` text NOT NULL,
  `label` text NOT NULL,
  `type` int(11) NOT NULL,
  `is_required` int(11) NOT NULL,
  `is_visible` int(11) NOT NULL,
  `is_default` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_forms`
--

INSERT INTO `booking_forms` (`id`, `user_id`, `field_name`, `label`, `type`, `is_required`, `is_visible`, `is_default`, `sort`, `date_created`) VALUES
(60, 2, 'full_name', 'Full name', 1, 0, 0, 1, 1, '2020-08-04 04:30:29'),
(61, 2, 'contact_number', 'Contact number', 1, 0, 0, 1, 2, '2020-08-04 04:30:29'),
(62, 2, 'email', 'Email', 1, 1, 1, 1, 3, '2020-08-04 04:30:29'),
(63, 2, 'address', 'Address', 1, 1, 1, 1, 4, '2020-08-04 04:30:29'),
(64, 2, 'message', 'Message', 1, 1, 1, 1, 5, '2020-08-04 04:30:29'),
(65, 2, 'preferred_time_to_contact', 'Preferred time to contact', 1, 1, 1, 1, 6, '2020-08-04 04:30:29'),
(66, 2, 'how_did_you_hear_about_us', 'How did you hear about us', 1, 1, 1, 1, 7, '2020-08-04 04:30:29'),
(67, 2, 'social_media', 'Social media', 1, 1, 1, 0, 8, '2020-08-04 04:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `booking_info`
--

CREATE TABLE `booking_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `message` text NOT NULL,
  `preferred_time_to_contact` varchar(100) NOT NULL,
  `how_did_you_hear_about_us` varchar(256) NOT NULL,
  `form_data` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_info`
--

INSERT INTO `booking_info` (`id`, `user_id`, `name`, `phone`, `email`, `address`, `message`, `preferred_time_to_contact`, `how_did_you_hear_about_us`, `form_data`, `status`, `date_created`) VALUES
(1, 2, 'bryann revina', '029123123123', 'bryann@nsmartrac.com', 'test address', 'test message', '1', 'test', '', 4, '2020-08-01 01:33:37'),
(2, 2, 'bryann revina', '029123123123', 'bryann@nsmartrac.com', 'sample address', 'test message', '0', 'test', '', 1, '2020-08-01 01:47:57'),
(3, 2, 'bryann revina', '029123123123', 'bryann@nsmartrac.com', 'sample address', 'test message', '0', 'test', '', 1, '2020-08-01 01:52:55'),
(4, 2, 'Bryann Rev', '029123123123', 'bryann@nsmartrac.com', 'sample address', 'test message', '0', 'test', '', 4, '2020-08-01 01:54:00'),
(5, 2, 'Juan Dela Cruz', '09279983995', 'juan.delacruz@gmail.com', '254 Gen., Malvart', 'This is only a test', '0', 'TOmmy', '', 1, '2020-08-03 23:51:50'),
(6, 2, 'Bryann M', '5545', 'testUser01@test.com', '254 Gen., Malvart', 'Test only', '0', 'dfd', '', 1, '2020-08-03 23:56:36'),
(7, 2, 'Bryann D Revina', '63298946464', 'bryann.revina@gmail.com', '254 Gen., Malvart, Don Pablo Subd., San Vicente, Binan, Laguna', 'Test Message', '2', 'Testing', 'a:1:{s:12:\"social_media\";s:18:\"facebook/bryann.03\";}', 1, '2020-08-04 05:40:41'),
(8, 2, 'bryann test', '12312312312', 'bryann@nsmartrac.com', 'test address ', 'test message only ', '2', 'test only', 'a:1:{s:12:\"social_media\";s:15:\"test only media\";}', 1, '2020-08-05 05:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `booking_schedule_assigned_users`
--

CREATE TABLE `booking_schedule_assigned_users` (
  `id` int(11) NOT NULL,
  `booking_setting_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_service_items`
--

CREATE TABLE `booking_service_items` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `price_unit` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `is_visible` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=visible,0=not visible',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_service_items`
--

INSERT INTO `booking_service_items` (`id`, `company_id`, `user_id`, `category_id`, `name`, `description`, `price`, `price_unit`, `image`, `is_visible`, `date_created`) VALUES
(3, 0, 2, 1, 'booking 1 ', 'test booking', 30, 'each', '', 1, '2020-08-01 01:44:15'),
(4, 0, 2, 2, 'booking 2', 'test only description', 50, 'each', '10154944_10203967112557232_7287505534776788576_n.jpg', 1, '2020-08-01 01:46:07'),
(5, 0, 2, 2, 'booking 2', 'test only description', 50, 'each', '10154944_10203967112557232_7287505534776788576_n.jpg', 1, '2020-08-01 01:46:07'),
(6, 0, 2, 3, 'Test Cat Item 1', 'Test Cat Item 1', 20, 'each', '', 1, '2020-08-03 22:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `booking_settings`
--

CREATE TABLE `booking_settings` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `page_title` varchar(256) NOT NULL,
  `page_introduction` text NOT NULL,
  `page_instruction` text NOT NULL,
  `product_listing_mode` varchar(100) NOT NULL,
  `appointment_per_time_slot` int(11) NOT NULL,
  `minimum_price_for_entier_booking` float NOT NULL,
  `minimum_price_alert` int(11) NOT NULL,
  `notification_email` int(11) NOT NULL,
  `notification_app` int(11) NOT NULL,
  `accept_blocked_time` int(11) NOT NULL,
  `accept_booking_overlap_calendar_event` int(11) NOT NULL,
  `auto_schedule_work_order` int(11) NOT NULL,
  `google_analytics_tracking_id` text NOT NULL,
  `website_url` text NOT NULL,
  `widget_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_settings`
--

INSERT INTO `booking_settings` (`id`, `company_id`, `user_id`, `page_title`, `page_introduction`, `page_instruction`, `product_listing_mode`, `appointment_per_time_slot`, `minimum_price_for_entier_booking`, `minimum_price_alert`, `notification_email`, `notification_app`, `accept_blocked_time`, `accept_booking_overlap_calendar_event`, `auto_schedule_work_order`, `google_analytics_tracking_id`, `website_url`, `widget_status`) VALUES
(1, 0, 2, 'Online Booking', 'this is a sample instruction ', 'this is a sample instruction ', 'grid', 0, 60, 0, 1, 1, 1, 1, 0, '123123123', 'http://www.google.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking_time_slots`
--

CREATE TABLE `booking_time_slots` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_start` varchar(100) NOT NULL,
  `time_end` varchar(100) NOT NULL,
  `days` text NOT NULL,
  `availability` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_time_slots`
--

INSERT INTO `booking_time_slots` (`id`, `company_id`, `user_id`, `time_start`, `time_end`, `days`, `availability`, `date_created`) VALUES
(9, 0, 2, '08:00 AM', '10:00 AM', 'a:6:{s:3:\"mon\";s:3:\"Mon\";s:3:\"tue\";s:3:\"Tue\";s:3:\"wed\";s:3:\"Wed\";s:3:\"thu\";s:3:\"Thu\";s:3:\"fri\";s:3:\"Fri\";s:3:\"sat\";s:3:\"Sat\";}', '1', '2020-08-03 22:26:18'),
(10, 0, 2, '10:30 AM', '12:30 PM', 'a:3:{s:3:\"tue\";s:3:\"Tue\";s:3:\"thu\";s:3:\"Thu\";s:3:\"sat\";s:3:\"Sat\";}', '1', '2020-08-03 22:26:18'),
(11, 0, 2, '01:00 PM', '03:00 PM', 'a:4:{s:3:\"mon\";s:3:\"Mon\";s:3:\"wed\";s:3:\"Wed\";s:3:\"fri\";s:3:\"Fri\";s:3:\"sun\";s:3:\"Sun\";}', '1', '2020-08-03 22:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `booking_work_orders`
--

CREATE TABLE `booking_work_orders` (
  `id` int(11) NOT NULL,
  `booking_info_id` int(11) NOT NULL,
  `service_item_id` int(11) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `quantity_ordered` int(11) NOT NULL,
  `total_amout` double(8,2) NOT NULL DEFAULT '0.00',
  `total_discount` double(8,2) NOT NULL DEFAULT '0.00',
  `schedule_time_from` time NOT NULL,
  `schedule_time_to` time NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `schedule_day` varchar(100) NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_time` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_work_orders`
--

INSERT INTO `booking_work_orders` (`id`, `booking_info_id`, `service_item_id`, `coupon_id`, `quantity_ordered`, `total_amout`, `total_discount`, `schedule_time_from`, `schedule_time_to`, `schedule_id`, `schedule_day`, `schedule_date`, `schedule_time`, `date_created`) VALUES
(1, 4, 1, NULL, 5, 0.00, 0.00, '12:00:00', '03:00:00', 0, '', '2020-08-05', '', '2020-08-01 01:54:00'),
(2, 4, 4, NULL, 1, 0.00, 0.00, '12:00:00', '03:00:00', 0, '', '2020-08-05', '', '2020-08-01 01:54:00'),
(3, 5, 5, NULL, 2, 0.00, 0.00, '08:00:00', '10:00:00', 0, '', '2020-08-08', '', '2020-08-03 23:51:50'),
(4, 5, 4, NULL, 2, 0.00, 0.00, '08:00:00', '10:00:00', 0, '', '2020-08-08', '', '2020-08-03 23:51:50'),
(5, 6, 4, NULL, 1, 0.00, 0.00, '10:30:00', '12:30:00', 0, '', '2020-08-08', '', '2020-08-03 23:56:38'),
(6, 6, 3, NULL, 1, 0.00, 0.00, '10:30:00', '12:30:00', 0, '', '2020-08-08', '', '2020-08-03 23:56:38'),
(7, 7, 4, 3, 2, 0.00, 0.00, '08:00:00', '10:00:00', 0, '', '2020-08-10', '', '2020-08-04 05:40:41'),
(8, 7, 3, 3, 3, 0.00, 0.00, '08:00:00', '10:00:00', 0, '', '2020-08-10', '', '2020-08-04 05:40:41'),
(9, 8, 6, 3, 3, 0.00, 0.00, '10:30:00', '12:30:00', 0, '', '2020-08-08', '', '2020-08-05 05:45:34'),
(10, 8, 4, 3, 2, 0.00, 0.00, '10:30:00', '12:30:00', 0, '', '2020-08-08', '', '2020-08-05 05:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `business_profile`
--

CREATE TABLE `business_profile` (
  `id` int(11) NOT NULL COMMENT 'company_id',
  `contact_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_subcategory` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `is_emergency_support` tinyint(1) DEFAULT NULL COMMENT '1=true',
  `year_est` char(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employee_count` int(6) DEFAULT NULL,
  `is_subcontract_allowed` tinyint(1) DEFAULT NULL,
  `EIN` char(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_desc` text COLLATE utf8_unicode_ci,
  `business_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'path of the logo',
  `nsmart_plans_id` int(11) NOT NULL,
  `nsmart_plans_valid_from` date NOT NULL,
  `nsmart_plans_valid_to` date NOT NULL,
  `nsmart_plans_next_billing_date` date NOT NULL,
  `nsmart_plans_next_payment` double(10,2) NOT NULL,
  `nsmart_plans_is_auto_renew` tinyint(1) NOT NULL DEFAULT '1',
  `folder_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED ZEROFILL NOT NULL COMMENT 'user_id',
  `user_id` int(11) DEFAULT NULL,
  `business_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suite_unit` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `office_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `office_phone_extn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_emergency` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_public_phone` tinyint(1) DEFAULT NULL,
  `is_public_office_phone` tinyint(1) DEFAULT NULL,
  `service_location` text COLLATE utf8_unicode_ci,
  `working_days` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_time_of_day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_time_of_day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `working_off_from` date NOT NULL,
  `working_of_to` date NOT NULL,
  `is_business_insured` tinyint(1) NOT NULL DEFAULT '0',
  `insured_amount` double(10,2) DEFAULT NULL,
  `insurance_expiry_date` date DEFAULT NULL,
  `is_bonded` tinyint(1) NOT NULL DEFAULT '0',
  `bond_amount` double(10,2) DEFAULT NULL,
  `bond_expiry_date` date DEFAULT NULL,
  `is_licensed` tinyint(1) NOT NULL DEFAULT '0',
  `license_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `license_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `license_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `license_expiry_date` date DEFAULT NULL,
  `is_bbb_accredited` tinyint(1) NOT NULL DEFAULT '0',
  `bbb_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_phone_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_facebook_connected` tinyint(1) NOT NULL DEFAULT '0',
  `is_google_connected` tinyint(1) NOT NULL DEFAULT '0',
  `b_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_profile`
--

INSERT INTO `business_profile` (`id`, `contact_name`, `business_name`, `business_email`, `business_image`, `service_category`, `service_subcategory`, `website`, `timezone`, `is_emergency_support`, `year_est`, `employee_count`, `is_subcontract_allowed`, `EIN`, `business_desc`, `business_logo`, `nsmart_plans_id`, `nsmart_plans_valid_from`, `nsmart_plans_valid_to`, `nsmart_plans_next_billing_date`, `nsmart_plans_next_payment`, `nsmart_plans_is_auto_renew`, `folder_name`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `user_id`, `business_number`, `street`, `suite_unit`, `city`, `postal_code`, `state`, `business_phone`, `office_phone`, `office_phone_extn`, `phone_emergency`, `is_public_phone`, `is_public_office_phone`, `service_location`, `working_days`, `start_time_of_day`, `end_time_of_day`, `working_off_from`, `working_of_to`, `is_business_insured`, `insured_amount`, `insurance_expiry_date`, `is_bonded`, `bond_amount`, `bond_expiry_date`, `is_licensed`, `license_class`, `license_number`, `license_state`, `license_expiry_date`, `is_bbb_accredited`, `bbb_link`, `is_phone_verified`, `is_email_verified`, `is_facebook_connected`, `is_google_connected`, `b_name`) VALUES
(1, 'Alarm Direct', 'ADi', 'moresecureadi@gmail.com', 'uploads/BusinessBanner/banner-1-1598434331058.jpg', 'Residential', 'Security', 'https://alarm.com', '', 1, '2013', 12, 1, NULL, 'Panhandle\'s Honeywell alarm dealership', 'uploads/BusinessLogo/logo-1-1598434293833.jpg', 2, '0000-00-00', '0000-00-00', '0000-00-00', 0.00, 1, '3lbcYw1j8y', '2020-08-12 13:24:04', '2020-09-06 17:02:55', '0000-00-00 00:00:00', 00000000002, NULL, NULL, '6866 Pine Forest Road', '', 'Pensacola', '32526', 'FL', '(850) 478-0530', '', NULL, '(850) 619-5914', NULL, NULL, NULL, 'Mon, Tue, Wed, Thur, Fri', '8:00 am', '5:00 pm', '0000-00-00', '0000-00-00', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `business_address` text NOT NULL,
  `number_of_employee` varchar(256) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `email_address`, `phone_number`, `business_name`, `business_address`, `number_of_employee`, `industry`, `password`, `date_created`, `date_modified`) VALUES
(1, 'fdf', 'dfdf', 'bryann@gmail.com', '211', 'Fresno', 'Fresno Fresno CountyCaliforniaUnited States', '2-3', 'Home Inspection', 'dfdsfd', '2020-09-14 21:41:19', '2020-09-15 02:41:19'),
(2, 'test bryan5', 'test last', 'testbryann5@gmail.com', '12312312312', 'Testour', 'Testour TestourBejaTunisia', '2-3', 'Home Inspection', 'abc123', '2020-09-15 03:26:37', '2020-09-15 08:26:37'),
(3, 'test bryan 5', 'test last', 'testbryab5@gmail.com', '123123123', '12312 Will Clayton Pkwy', '12312 Will Clayton ParkwayHumbleHarris County', '2-3', 'Drywall', 'abc123', '2020-09-15 03:35:58', '2020-09-15 08:35:58');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `relation_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `type`, `user_id`, `relation_id`, `comment`, `comment_date`, `company_id`) VALUES
(1, 'task', 15, 7, 'Will work on these later', '2020-08-06 07:38:48', 1),
(2, 'task', 15, 6, 'Issue fixed', '2020-09-03 07:30:29', 1),
(3, 'task', 15, 6, 'Task on evaluation by the management ', '2020-09-03 07:34:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies_has_modules`
--

CREATE TABLE `companies_has_modules` (
  `company_id` int(11) NOT NULL,
  `modules_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `mobile`, `notes`, `customer_id`, `company_id`) VALUES
(5, 'John Smith', 'john@gmail.com', '', '', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `contracts_id` int(11) NOT NULL,
  `contract_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `base_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'template location',
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_cards`
--

CREATE TABLE `credit_cards` (
  `id` int(11) NOT NULL,
  `card_holder` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'encrypt',
  `expiration` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `cvv` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `card_type` enum('AMEX','Visa','Master','Discover') COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `customer_type` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `notify_email` tinyint(1) NOT NULL DEFAULT '0',
  `notify_sms` tinyint(1) NOT NULL DEFAULT '0',
  `birthday` date NOT NULL,
  `customer_group` int(11) NOT NULL,
  `comments` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `contact_id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `suite_unit` varchar(255) NOT NULL,
  `street_address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `notification_method` varchar(50) NOT NULL,
  `additional_info` text NOT NULL,
  `card_info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='data should be encrypted';

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `customer_type`, `company_name`, `contact_name`, `contact_email`, `mobile`, `phone`, `notify_email`, `notify_sms`, `birthday`, `customer_group`, `comments`, `status`, `contact_id`, `source_id`, `company_id`, `suite_unit`, `street_address`, `city`, `state`, `postal_code`, `notification_method`, `additional_info`, `card_info`) VALUES
(1, 0, 'Residential', '', 'Jane Smith', 'jpabanil@yopmail.com', '(888) 888-8888', '', 1, 0, '1995-08-25', 0, '', 1, 0, 0, 1, '', '', '', '', '', '', '', ''),
(2, 0, 'Residential', '', 'John Doe', 'john.doe@yopmail.com', '', '', 1, 0, '2020-08-26', 0, '', 1, 0, 0, 1, '', '', '', '', '', '', '', ''),
(3, 0, 'Residential', 'ADI', 'Tommy Nguyen', 'moresecureadi@gmail.com', '(850) 619-59-14', '', 1, 1, '2020-08-29', 0, 'sweet lady', 1, 0, 0, 1, '', '', '', '', '', '', '', ''),
(4, 0, '', '', 'tom test', 'moresecureadi@gmail.com', '', '(850) 619-5917', 1, 1, '2020-09-20', 0, '', 1, 0, 0, 1, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customers_has_customer_settings`
--

CREATE TABLE `customers_has_customer_settings` (
  `customer_id` int(11) NOT NULL,
  `customer_settings_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_settings`
--

CREATE TABLE `customer_settings` (
  `customer_settings_id` int(11) NOT NULL,
  `setting_type` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'contact_type, source, customer_group',
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_sources`
--

CREATE TABLE `customer_sources` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_types`
--

CREATE TABLE `customer_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_types`
--

INSERT INTO `customer_types` (`id`, `name`, `company_id`) VALUES
(1, 'Commercial', 1),
(2, 'Residential', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customize_lead_forms`
--

CREATE TABLE `customize_lead_forms` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `field` varchar(255) NOT NULL,
  `visible` int(11) NOT NULL,
  `required` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customize_lead_forms`
--

INSERT INTO `customize_lead_forms` (`id`, `company_id`, `field`, `visible`, `required`, `type`) VALUES
(1, 0, 'Name', 1, 1, 'default'),
(2, 0, 'Phone', 1, 1, 'default'),
(3, 0, 'Email', 1, 1, 'default'),
(4, 1, 'Address', 0, 1, 'lead_form'),
(5, 0, 'Message', 0, 0, 'default'),
(6, 1, 'Preferred time to contact', 0, 0, 'lead_form'),
(7, 1, 'How did you hear about us', 1, 1, 'lead_form');

-- --------------------------------------------------------

--
-- Table structure for table `custom_forms`
--

CREATE TABLE `custom_forms` (
  `forms_id` int(11) NOT NULL,
  `form_title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `custom_forms`
--

INSERT INTO `custom_forms` (`forms_id`, `form_title`, `created`, `created_by`, `description`, `company_id`) VALUES
(1, 'Test form', '2020-06-12 23:22:46', 2, NULL, 1),
(2, 'test 2', '2020-07-14 05:43:06', 2, NULL, 1),
(3, 'phone address check', '2020-07-22 12:59:38', 2, NULL, 1),
(4, 'workorder', '2020-08-03 10:47:54', 2, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `hire_date` date DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `employment_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `pay_rate` decimal(8,2) DEFAULT NULL,
  `pay_type` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notify_email` tinyint(1) NOT NULL DEFAULT '0',
  `notify_sms` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `role_id`, `status`, `hire_date`, `title`, `about`, `comments`, `employment_type`, `dob`, `pay_rate`, `pay_type`, `notify_email`, `notify_sms`, `user_id`, `company_id`) VALUES
(1, 3, 1, '2020-04-09', 'Cool Company Owner', '', '', '', '1985-02-10', 55000.00, 'Salary', 0, 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `esign_components`
--

CREATE TABLE `esign_components` (
  `id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `component_type` varchar(30) NOT NULL,
  `location` varchar(255) NOT NULL,
  `assigned_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `estimates`
--

CREATE TABLE `estimates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `job_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estimate_number` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `estimate_type` enum('Standard','Option') COLLATE utf8_unicode_ci NOT NULL,
  `estimate_value` double NOT NULL,
  `estimate_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `purchase_order_number` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `estimate_items` text COLLATE utf8_unicode_ci,
  `estimate_eqpt_cost` text COLLATE utf8_unicode_ci,
  `deposit_request` mediumtext COLLATE utf8_unicode_ci,
  `customer_message` text COLLATE utf8_unicode_ci,
  `terms_conditions` text COLLATE utf8_unicode_ci,
  `attachments` text COLLATE utf8_unicode_ci,
  `instructions` text COLLATE utf8_unicode_ci,
  `template_id` int(11) DEFAULT NULL,
  `status` enum('Draft','Submitted','Accepted','Invoiced','Lost','Declined By Customer') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '''Draft'',''Submitted'',''Accepted'',''Invoiced'',''Lost'',''Declined By Customer''',
  `signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'uploads/Signatures/<company_id>',
  `sign_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `estimates`
--

INSERT INTO `estimates` (`id`, `user_id`, `company_id`, `customer_id`, `job_location`, `job_name`, `estimate_number`, `estimate_type`, `estimate_value`, `estimate_date`, `expiry_date`, `purchase_order_number`, `plan_id`, `estimate_items`, `estimate_eqpt_cost`, `deposit_request`, `customer_message`, `terms_conditions`, `attachments`, `instructions`, `template_id`, `status`, `signature`, `sign_date`, `created_at`, `updated_at`) VALUES
(3, NULL, 1, 1, '6055 Born Court , Pensacola, FL 32504', '', 'EST-00002', 'Standard', 722.05, '2020-08-26', '2020-09-24', 0, NULL, NULL, NULL, '', 'I would be happy to have an opportunity to work with you.', '', NULL, '', NULL, 'Submitted', 'uploads/Signatures/1/EST-00002_1598441603088.jpg', '2020-08-26', '2020-08-26 03:51:47', '2020-08-26 03:51:47'),
(4, NULL, 1, 1, '6055 Born Court , Pensacola, FL 32504', 'Jane Smith', 'EST-00003', 'Standard', 719.28, '2020-08-27', '2020-09-25', 0, NULL, NULL, NULL, '', 'I would be happy to have an opportunity to work with you.', '', NULL, '', NULL, 'Draft', '', '0000-00-00', '2020-08-26 16:18:30', '2020-08-26 16:18:30'),
(5, NULL, 1, 3, '6055 Born Ct , Pensacola, FL 32504', 'T N T Building', 'EST-00004', 'Standard', 821.15, '2020-08-29', '2020-09-27', 0, NULL, NULL, NULL, '50', 'I would be happy to have an opportunity to work with you.', '50% deposit', NULL, 'please sign', NULL, 'Draft', '', '0000-00-00', '2020-08-29 21:34:53', '2020-08-29 21:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `estimates_items`
--

CREATE TABLE `estimates_items` (
  `estimates_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estimates_items`
--

INSERT INTO `estimates_items` (`estimates_id`, `items_id`, `qty`) VALUES
(4, 2, 1),
(4, 4, 1),
(5, 5, 1),
(5, 9, 2),
(5, 106, 1);

-- --------------------------------------------------------

--
-- Table structure for table `estimates_photo`
--

CREATE TABLE `estimates_photo` (
  `id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'uploads/CompanyPhoto/<company_id>/<file_name>',
  `estimate_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `estimates_photo`
--

INSERT INTO `estimates_photo` (`id`, `path`, `estimate_id`, `company_id`) VALUES
(1, 'uploads/CompanyPhoto/1/EST-00004_photo_1598736894982.jpg', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `estimate_settings`
--

CREATE TABLE `estimate_settings` (
  `id` int(11) NOT NULL,
  `estimate_num_prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'EST-',
  `estimate_num_next` int(11) NOT NULL DEFAULT '1',
  `default_expire_period` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '4 weeks' COMMENT 'number of weeks',
  `capture_customer_signature` tinyint(1) NOT NULL DEFAULT '1',
  `hide_item_price` tinyint(1) NOT NULL DEFAULT '0',
  `hide_item_qty` tinyint(1) NOT NULL DEFAULT '0',
  `hide_item_tax` tinyint(1) NOT NULL DEFAULT '0',
  `hide_item_discount` tinyint(1) NOT NULL DEFAULT '0',
  `hide_item_total` tinyint(1) NOT NULL DEFAULT '0',
  `hide_grand_total` tinyint(1) NOT NULL DEFAULT '0',
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `terms_and_conditions` text COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `estimate_settings`
--

INSERT INTO `estimate_settings` (`id`, `estimate_num_prefix`, `estimate_num_next`, `default_expire_period`, `capture_customer_signature`, `hide_item_price`, `hide_item_qty`, `hide_item_tax`, `hide_item_discount`, `hide_item_total`, `hide_grand_total`, `message`, `terms_and_conditions`, `company_id`) VALUES
(1, 'EST-', 5, '4 weeks', 1, 1, 1, 1, 1, 0, 0, 'I would be happy to have an opportunity to work with you.', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0' COMMENT '0 for blocked events',
  `event_description` varchar(255) NOT NULL,
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `start_time` varchar(10) NOT NULL,
  `end_date` date NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `event_color` enum('#4cb052','#d96666','#e67399','#b373b3','#8c66d9','#668cd9','#59bfb3','#65ad89','#f2a640') NOT NULL,
  `customer_reminder_notification` varchar(255) DEFAULT NULL COMMENT 'leave empty for blocks',
  `instructions` text NOT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `workorder_id` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `notify_at` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `customer_id`, `event_description`, `employee_id`, `start_date`, `start_time`, `end_date`, `end_time`, `event_color`, `customer_reminder_notification`, `instructions`, `is_recurring`, `date_created`, `date_updated`, `company_id`, `workorder_id`, `description`, `notify_at`, `status`) VALUES
(1, 1, 'Test event', 2, '2020-08-03', '8:00 am', '2020-08-03', '9:00 am', '#4cb052', '1 day before', '', 0, '2020-08-01 08:02:53', '0000-00-00 00:00:00', 1, 0, '', '', 0),
(2, 0, 'Test Block', 0, '2020-08-04', '8:00 am', '2020-08-04', '5:00 pm', '#e67399', '', '', 0, '2020-08-01 08:02:53', '0000-00-00 00:00:00', 1, 0, '', '', 0),
(3, 1, 'Event for Jane', 2, '2020-09-01', '2:00 pm', '2020-09-01', '4:00 pm', '#d96666', '1 day before', 'replace motion and inspection needed', 0, '2020-08-29 21:20:47', '0000-00-00 00:00:00', 1, 0, '', '', 0),
(4, 3, 'Test Event for Tommy', 2, '2020-09-09', '2:00 pm', '2020-09-09', '3:00 pm', '#4cb052', '1 day before', '', 0, '2020-09-08 15:28:17', '0000-00-00 00:00:00', 1, 0, '', '', 0),
(5, 0, 'Mama Birthday', 2, '2020-09-06', '12:00 am', '2020-09-06', '11:59 pm', '#4cb052', '1 day before', '', 0, '2020-09-11 11:13:03', '0000-00-00 00:00:00', 1, 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_settings`
--

CREATE TABLE `event_settings` (
  `id` int(11) NOT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auto_sync_icloud_cal` tinyint(1) NOT NULL DEFAULT '0',
  `auto_sync_google_cal` tinyint(1) NOT NULL DEFAULT '0',
  `auto_sync_outlook_cal` tinyint(1) NOT NULL DEFAULT '0',
  `display_color_codes` tinyint(1) NOT NULL DEFAULT '1',
  `display_customer_info` tinyint(1) NOT NULL DEFAULT '1',
  `display_job_info` tinyint(1) NOT NULL DEFAULT '1',
  `display_job_price` tinyint(1) NOT NULL DEFAULT '1',
  `auto_sync_offline` tinyint(1) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event_settings`
--

INSERT INTO `event_settings` (`id`, `timezone`, `auto_sync_icloud_cal`, `auto_sync_google_cal`, `auto_sync_outlook_cal`, `display_color_codes`, `display_customer_info`, `display_job_info`, `display_job_price`, `auto_sync_offline`, `company_id`) VALUES
(1, 'Central Time (UTC -5)', 0, 1, 0, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fb_choices`
--

CREATE TABLE `fb_choices` (
  `fc_id` int(11) NOT NULL,
  `fc_element_id` int(11) DEFAULT NULL,
  `fc_choice` int(11) DEFAULT NULL COMMENT 'Label of the choice',
  `fc_is_correct_answer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='A list of choices connected to the elements of the form under Form Buider Module';

-- --------------------------------------------------------

--
-- Table structure for table `fb_forms`
--

CREATE TABLE `fb_forms` (
  `forms_id` int(11) NOT NULL,
  `forms_title` varchar(64) DEFAULT NULL,
  `forms_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `forms_user_created` int(11) DEFAULT '0',
  `forms_slag` varchar(50) DEFAULT NULL COMMENT 'This column is used for url links',
  `forms_set_private_note` text,
  `forms_social_desc` text,
  `forms_social_image` varchar(64) DEFAULT NULL,
  `forms_use_start_date` tinyint(4) DEFAULT NULL,
  `forms_use_closing_date` tinyint(4) DEFAULT NULL,
  `forms_use_results_limit` tinyint(4) DEFAULT NULL,
  `forms_start_date` date DEFAULT NULL,
  `forms_start_time` time DEFAULT NULL,
  `forms_start_title` varchar(32) DEFAULT NULL,
  `forms_start_message` text,
  `forms_end_date` date DEFAULT NULL,
  `forms_end_time` time DEFAULT NULL,
  `forms_end_title` varchar(32) DEFAULT NULL,
  `forms_end_message` text,
  `forms_results_limit` text,
  `forms_results_max_title` varchar(32) DEFAULT NULL,
  `forms_results_max_message` text,
  `forms_success_title` varchar(32) DEFAULT NULL,
  `forms_success_message` text,
  `forms_redirect_link` text,
  `forms_show_repeat_form_check` text,
  `forms_header_text` text,
  `forms_footer_text` text,
  `forms_is_score_monitored` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='The main list of forms registered under the Form Builder Module';

--
-- Dumping data for table `fb_forms`
--

INSERT INTO `fb_forms` (`forms_id`, `forms_title`, `forms_date_created`, `forms_user_created`, `forms_slag`, `forms_set_private_note`, `forms_social_desc`, `forms_social_image`, `forms_use_start_date`, `forms_use_closing_date`, `forms_use_results_limit`, `forms_start_date`, `forms_start_time`, `forms_start_title`, `forms_start_message`, `forms_end_date`, `forms_end_time`, `forms_end_title`, `forms_end_message`, `forms_results_limit`, `forms_results_max_title`, `forms_results_max_message`, `forms_success_title`, `forms_success_message`, `forms_redirect_link`, `forms_show_repeat_form_check`, `forms_header_text`, `forms_footer_text`, `forms_is_score_monitored`) VALUES
(7, 'Blank Formysss', '2020-08-12 10:22:07', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(8, 'dddBlank Formy', '2020-08-12 10:22:07', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(9, 'Blank Formy', '2020-08-12 10:22:07', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fb_forms_answers`
--

CREATE TABLE `fb_forms_answers` (
  `fa_id` int(11) NOT NULL,
  `fa_form_id` int(11) NOT NULL,
  `fa_element_id` int(11) NOT NULL,
  `fa_session_id` varchar(16) DEFAULT NULL,
  `fa_value` text,
  `fa_date_answered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fb_forms_elements`
--

CREATE TABLE `fb_forms_elements` (
  `fe_id` int(11) NOT NULL,
  `fe_form_id` int(11) DEFAULT '0',
  `fe_element_id` int(2) DEFAULT '0' COMMENT 'There''s a file under forms placed for reference',
  `fe_label` varchar(32) DEFAULT NULL,
  `fe_minlength` int(2) DEFAULT '0',
  `fe_maxlength` int(2) DEFAULT '0',
  `fe_validation_type` varchar(16) DEFAULT NULL,
  `fe_is_required` tinyint(4) DEFAULT NULL,
  `fe_is_readonly` tinyint(4) DEFAULT NULL,
  `fe_default_value` varchar(32) DEFAULT NULL,
  `fe_placeholder_text` varchar(16) DEFAULT NULL,
  `fe_pop_up_message` text,
  `fe_enable_score` tinyint(4) DEFAULT NULL,
  `fe_row` int(11) DEFAULT NULL,
  `fe_span` int(11) DEFAULT NULL,
  `fe_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='A list of form elements under designated forms under Form Builder Module';

--
-- Dumping data for table `fb_forms_elements`
--

INSERT INTO `fb_forms_elements` (`fe_id`, `fe_form_id`, `fe_element_id`, `fe_label`, `fe_minlength`, `fe_maxlength`, `fe_validation_type`, `fe_is_required`, `fe_is_readonly`, `fe_default_value`, `fe_placeholder_text`, `fe_pop_up_message`, `fe_enable_score`, `fe_row`, `fe_span`, `fe_order`) VALUES
(44, 9, 6, 'What\'s the date today? sup', 0, 0, NULL, 1, 0, '', 'choicess', NULL, 0, NULL, 2, 2),
(63, 9, 3, 'What\'s your email?', 0, 0, NULL, 1, 1, '', 'Place something ', NULL, 0, NULL, 2, 1),
(64, 9, 6, 'calendar', 0, 0, NULL, 1, 0, '', 'choice', NULL, 0, NULL, 3, 4),
(65, 9, 6, 'What\'s the date today?', 0, 0, NULL, 1, 0, '', 'choicess', NULL, NULL, NULL, 1, 3),
(66, 9, 3, 'Another field', 0, 0, NULL, 1, 0, '', '', NULL, 0, NULL, 4, 5),
(67, 9, 5, 'short-answer', 0, 0, NULL, 0, 0, '', 'choice', NULL, NULL, NULL, 1, 7),
(68, 9, 5, 'Another field', 0, 0, NULL, 0, 0, '', '', NULL, 0, NULL, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `fb_forms_products`
--

CREATE TABLE `fb_forms_products` (
  `fp_id` int(11) NOT NULL,
  `fp_form_id` int(11) DEFAULT NULL,
  `fp_element_id` int(11) DEFAULT NULL,
  `fp_item_id` int(11) DEFAULT NULL,
  `fp_quantity` int(11) DEFAULT NULL,
  `fp_total_price` int(11) DEFAULT NULL,
  `fp_date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `filevault`
--

CREATE TABLE `filevault` (
  `file_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Set a name for your own reference',
  `title` varchar(255) NOT NULL,
  `description` text,
  `file_path` text NOT NULL,
  `modified` datetime NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_size` int(11) DEFAULT NULL,
  `folder_id` int(11) NOT NULL,
  `attach_to_estimates` varchar(255) NOT NULL,
  `attach_to_invoices` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `alt_text` text,
  `company_id` int(11) DEFAULT NULL,
  `downloads_count` int(11) DEFAULT NULL,
  `previews_count` int(11) DEFAULT NULL,
  `softdelete` int(1) DEFAULT '0',
  `softdelete_date` datetime DEFAULT NULL,
  `softdelete_by` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filevault`
--

INSERT INTO `filevault` (`file_id`, `name`, `title`, `description`, `file_path`, `modified`, `created`, `file_size`, `folder_id`, `attach_to_estimates`, `attach_to_invoices`, `user_id`, `alt_text`, `company_id`, `downloads_count`, `previews_count`, `softdelete`, `softdelete_date`, `softdelete_by`, `category_id`, `modified_by`) VALUES
(14, '', 'picture test 002.png', '', '/Francis - Files/Francis - Files - Others/picture test 002.png', '2020-08-21 10:39:44', '2020-08-21 15:39:44', 385082, 22, '', '', 15, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(13, '', 'picture test 001.png', '', '/Francis - Files/Francis - Files - Others/picture test 001.png', '2020-08-21 10:39:30', '2020-08-21 15:39:30', 385082, 22, '', '', 15, NULL, 1, 1, 2, 0, NULL, NULL, NULL, NULL),
(12, '', 'picture test 2.jpg', '', '/Francis - Files/picture test 2.jpg', '2020-08-21 10:34:29', '2020-08-21 15:34:29', 4854, 21, '', '', 15, NULL, 1, NULL, 2, 0, NULL, NULL, NULL, NULL),
(11, '', 'picture test 1.png', '', '/Francis - Files/picture test 1.png', '2020-08-21 10:34:00', '2020-08-21 15:34:00', 385082, 21, '', '', 15, NULL, 1, NULL, 4, 0, NULL, NULL, NULL, NULL),
(15, '', 'Sample Application Form.pdf', '', '/Generic/Sample Application Form.pdf', '2020-08-24 07:56:15', '2020-08-24 12:56:15', 188048, 23, '', '', 15, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(16, '', 'Sample 1.pdf', '', '/Francis - Files/Francis - Tests/Sample 1.pdf', '2020-09-03 07:28:04', '2020-09-01 12:16:30', 188048, 27, '', '', 15, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, 15),
(17, '', 'Sample.pdf', '', '/iOS Files/Sample.pdf', '2020-09-02 08:30:12', '2020-09-02 13:30:12', 3028, 24, '', '', 2, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(18, '', 'Sample.pdf', '', '/Sample.pdf', '2020-09-02 08:30:40', '2020-09-02 13:30:40', 3028, 0, '', '', 2, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(19, '', 'logo-1-1597842036651.jpg', '', '/logo-1-1597842036651.jpg', '2020-09-02 08:30:53', '2020-09-02 13:30:53', 89567, 0, '', '', 2, NULL, 1, NULL, 1, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file_folders`
--

CREATE TABLE `file_folders` (
  `folder_id` int(11) NOT NULL,
  `folder_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `path` text COLLATE utf8_unicode_ci,
  `permissions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'array (link to roles / specific users)',
  `created_by` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `password_protection` tinyint(1) DEFAULT NULL COMMENT '1=yes',
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `softdelete` int(1) DEFAULT '0',
  `softdelete_date` datetime DEFAULT NULL,
  `softdelete_by` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT '0',
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `file_folders`
--

INSERT INTO `file_folders` (`folder_id`, `folder_name`, `parent_id`, `description`, `path`, `permissions`, `created_by`, `create_date`, `password_protection`, `password`, `company_id`, `softdelete`, `softdelete_date`, `softdelete_by`, `category_id`, `date_modified`, `modified_by`) VALUES
(21, 'Francis - Files', 0, '', '/Francis - Files/', NULL, 15, '2020-08-21 15:28:36', NULL, NULL, 1, 0, NULL, NULL, 0, NULL, NULL),
(22, 'Francis - Files - Others', 21, '', '/Francis - Files/Francis - Files - Others/', NULL, 15, '2020-08-21 15:39:06', NULL, NULL, 1, 0, NULL, NULL, 0, NULL, NULL),
(23, 'Generic', 0, '', '/Generic/', NULL, 15, '2020-08-24 12:55:42', NULL, NULL, 1, 0, NULL, NULL, 0, NULL, NULL),
(24, 'iOS Files', 0, 'This is test folder for iOS', '/iOS Files/', NULL, 2, '2020-08-29 10:27:08', NULL, NULL, 1, 0, NULL, NULL, 0, NULL, NULL),
(27, 'Francis - Tests', 21, '', '/Francis - Files/Francis - Tests/', NULL, 15, '2020-09-01 12:16:04', NULL, NULL, 1, 0, NULL, NULL, 0, '2020-09-03 07:28:04', 15),
(29, 'Business Plan Templates', 0, '', '/Business Plan Templates/', NULL, 15, '2020-09-04 14:26:45', NULL, NULL, 1, 0, NULL, NULL, 3, NULL, NULL),
(30, 'How to write a business plan', 0, '', '/How to write a business plan/', NULL, 15, '2020-09-04 14:27:00', NULL, NULL, 1, 0, NULL, NULL, 3, NULL, NULL),
(31, 'Business Plan Examples', 0, '', '/Business Plan Examples/', NULL, 15, '2020-09-04 14:27:20', NULL, NULL, 1, 0, NULL, NULL, 3, NULL, NULL),
(32, 'Executive Summary', 0, '', '/Executive Summary/', NULL, 15, '2020-09-04 14:27:40', NULL, NULL, 1, 0, NULL, NULL, 3, NULL, NULL),
(33, 'Financial Projections', 0, '', '/Financial Projections/', NULL, 15, '2020-09-04 14:27:56', NULL, NULL, 1, 0, NULL, NULL, 3, NULL, NULL),
(34, 'Starting a Business', 0, '', '/Starting a Business/', NULL, 15, '2020-09-04 14:28:14', NULL, NULL, 1, 0, NULL, NULL, 3, NULL, NULL),
(35, 'Incorporation', 0, '', '/Incorporation/', NULL, 15, '2020-09-04 14:28:29', NULL, NULL, 1, 0, NULL, NULL, 3, NULL, NULL),
(36, 'Shareholders Agreement', 0, '', '/Shareholders Agreement/', NULL, 15, '2020-09-04 14:29:12', NULL, NULL, 1, 0, NULL, NULL, 3, NULL, NULL),
(37, 'Stock Equity Financing', 0, '', '/Stock Equity Financing/', NULL, 15, '2020-09-04 14:57:30', NULL, NULL, 1, 0, NULL, NULL, 3, NULL, NULL),
(38, 'Business Loan', 0, '', '/Business Loan/', NULL, 15, '2020-09-04 14:58:38', NULL, NULL, 1, 0, NULL, NULL, 3, NULL, NULL),
(39, 'Marketing Plan', 0, '', '/Marketing Plan/', NULL, 15, '2020-09-04 14:59:08', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(40, 'Sales Proposals', 0, '', '/Sales Proposals/', NULL, 15, '2020-09-04 15:00:09', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(41, 'Marketing & Sales Contracts', 0, '', '/Marketing & Sales Contracts/', NULL, 15, '2020-09-04 15:00:26', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(42, 'Marketing Strategy', 0, '', '/Marketing Strategy/', NULL, 15, '2020-09-04 15:00:39', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(43, 'Business Growth', 0, '', '/Business Growth/', NULL, 15, '2020-09-04 15:00:55', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(44, 'Market Analysis', 0, '', '/Market Analysis/', NULL, 15, '2020-09-04 15:01:08', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(45, 'Market Research', 0, '', '/Market Research/', NULL, 15, '2020-09-04 15:01:26', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(46, 'Competitive Analysis', 0, '', '/Competitive Analysis/', NULL, 15, '2020-09-04 15:01:58', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(47, 'Customer Surveys', 0, '', '/Customer Surveys/', NULL, 15, '2020-09-04 15:02:20', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(48, 'Customer Feedback', 0, '', '/Customer Feedback/', NULL, 15, '2020-09-04 15:02:37', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(49, 'Market Tests', 0, '', '/Market Tests/', NULL, 15, '2020-09-04 15:02:59', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(50, 'Business Website', 0, '', '/Business Website/', NULL, 15, '2020-09-04 15:03:19', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(51, 'Advertising', 0, '', '/Advertising/', NULL, 15, '2020-09-04 15:03:31', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(52, 'Customer Relationships', 0, '', '/Customer Relationships/', NULL, 15, '2020-09-04 15:03:47', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(53, 'Bids & Quotes', 0, '', '/Bids & Quotes/', NULL, 15, '2020-09-04 15:04:00', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(54, 'Sales Letters', 0, '', '/Sales Letters/', NULL, 15, '2020-09-04 15:04:46', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(55, 'Customer Service', 0, '', '/Customer Service/', NULL, 15, '2020-09-04 15:04:56', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(56, 'Press & Media', 0, '', '/Press & Media/', NULL, 15, '2020-09-04 15:05:11', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(57, 'Call Center', 0, '', '/Call Center/', NULL, 15, '2020-09-04 15:05:23', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(58, 'Sales Representatives', 0, '', '/Sales Representatives/', NULL, 15, '2020-09-04 15:05:41', NULL, NULL, 1, 0, NULL, NULL, 4, NULL, NULL),
(59, 'Employee Handbook', 0, '', '/Employee Handbook/', NULL, 15, '2020-09-04 15:07:22', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(60, 'Company Policies', 0, '', '/Company Policies/', NULL, 15, '2020-09-04 15:07:38', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(61, 'Performance Review', 0, '', '/Performance Review/', NULL, 15, '2020-09-04 15:07:50', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(62, 'Employee Contracts', 0, '', '/Employee Contracts/', NULL, 15, '2020-09-04 15:08:01', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(63, 'Employee Forms', 0, '', '/Employee Forms/', NULL, 15, '2020-09-04 15:08:26', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(64, 'Job Descriptions', 0, '', '/Job Descriptions/', NULL, 15, '2020-09-04 15:08:40', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(65, 'Hire an Employee', 0, '', '/Hire an Employee/', NULL, 15, '2020-09-04 15:08:54', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(66, 'Employee Termination', 0, '', '/Employee Termination/', NULL, 15, '2020-09-04 15:10:19', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(67, 'Staff Management', 0, '', '/Staff Management/', NULL, 15, '2020-09-04 15:10:31', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(68, 'Employee Letters', 0, '', '/Employee Letters/', NULL, 15, '2020-09-04 15:11:56', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(69, 'Code of Conduct', 0, '', '/Code of Conduct/', NULL, 15, '2020-09-04 15:12:18', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(70, 'Interview Guides', 0, '', '/Interview Guides/', NULL, 15, '2020-09-04 15:12:30', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(71, 'Employee Records', 0, '', '/Employee Records/', NULL, 15, '2020-09-04 15:13:03', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(72, 'Vacation and Abscences', 0, '', '/Vacation and Abscences/', NULL, 15, '2020-09-04 15:13:24', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(73, 'Payroll Management', 0, '', '/Payroll Management/', NULL, 15, '2020-09-04 15:13:36', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(74, 'Motivation & Appreciation', 0, '', '/Motivation & Appreciation/', NULL, 15, '2020-09-04 15:13:59', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(75, 'Surveys & Feedbacks', 0, '', '/Surveys & Feedbacks/', NULL, 15, '2020-09-04 15:14:11', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(76, 'References & Recommendations', 0, '', '/References & Recommendations/', NULL, 15, '2020-09-04 15:14:28', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(77, 'Behavior & Discipline', 0, '', '/Behavior & Discipline/', NULL, 15, '2020-09-04 15:15:15', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(78, 'Health & Medical', 0, '', '/Health & Medical/', NULL, 15, '2020-09-04 15:15:37', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(79, 'Imdemnity & Compensation', 0, '', '/Imdemnity & Compensation/', NULL, 15, '2020-09-04 15:16:01', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(80, 'Employee Benefits', 0, '', '/Employee Benefits/', NULL, 15, '2020-09-04 15:16:17', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(81, 'Personality & Skills Tests', 0, '', '/Personality & Skills Tests/', NULL, 15, '2020-09-04 15:16:41', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(82, 'Resignation Letters', 0, '', '/Resignation Letters/', NULL, 15, '2020-09-04 15:16:53', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(83, 'Background & Reference', 0, '', '/Background & Reference/', NULL, 15, '2020-09-04 15:17:15', NULL, NULL, 1, 0, NULL, NULL, 5, NULL, NULL),
(84, 'Financial Statements', 0, '', '/Financial Statements/', NULL, 15, '2020-09-04 15:17:31', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(85, 'Credit Application', 0, '', '/Credit Application/', NULL, 15, '2020-09-04 15:17:47', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(86, 'Cash Flow Projections', 0, '', '/Cash Flow Projections/', NULL, 15, '2020-09-04 15:17:59', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(87, 'Term Sheet', 0, '', '/Term Sheet/', NULL, 15, '2020-09-04 15:18:10', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(88, 'Purchase Orders', 0, '', '/Purchase Orders/', NULL, 15, '2020-09-04 15:18:21', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(89, 'Invoices & Receipts', 0, '', '/Invoices & Receipts/', NULL, 15, '2020-09-04 15:18:42', NULL, NULL, 1, 0, NULL, NULL, 6, '2020-09-04 10:19:05', 15),
(90, 'Profit & Loss Statement', 0, '', '/Profit & Loss Statement/', NULL, 15, '2020-09-04 15:19:26', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(91, 'Balance Sheet', 0, '', '/Balance Sheet/', NULL, 15, '2020-09-04 15:19:47', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(92, 'Income Statement', 0, '', '/Income Statement/', NULL, 15, '2020-09-04 15:20:03', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(93, 'Sales Projections', 0, '', '/Sales Projections/', NULL, 15, '2020-09-04 15:20:45', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(94, 'Due Diligence', 0, '', '/Due Diligence/', NULL, 15, '2020-09-04 15:20:58', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(95, 'Service Agreements', 0, '', '/Service Agreements/', NULL, 15, '2020-09-04 15:25:15', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(96, 'Buy & Sell Shares', 0, '', '/Buy & Sell Shares/', NULL, 15, '2020-09-04 15:25:22', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(97, 'Non-Disclosure Agreements', 0, '', '/Non-Disclosure Agreements/', NULL, 15, '2020-09-04 15:25:37', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(98, 'Employee Profit Sharing', 0, '', '/Employee Profit Sharing/', NULL, 15, '2020-09-04 15:25:40', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(99, 'Shareholders Agreements', 0, '', '/Shareholders Agreements/', NULL, 15, '2020-09-04 15:26:26', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(100, 'Partnership Agreements', 0, '', '/Partnership Agreements/', NULL, 15, '2020-09-04 15:26:47', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(101, 'Management Agreements', 0, '', '/Management Agreements/', NULL, 15, '2020-09-04 15:27:01', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(102, 'Employee Stock Option', 0, '', '/Employee Stock Option/', NULL, 15, '2020-09-04 15:27:24', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(103, 'Memorandum of Understanding', 0, '', '/Memorandum of Understanding/', NULL, 15, '2020-09-04 15:27:48', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(104, 'Business Banking', 0, '', '/Business Banking/', NULL, 15, '2020-09-04 15:27:51', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(105, 'License Agreements', 0, '', '/License Agreements/', NULL, 15, '2020-09-04 15:28:02', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(106, 'Business Financing', 0, '', '/Business Financing/', NULL, 15, '2020-09-04 15:28:06', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(107, 'Confidentiality Agreements', 0, '', '/Confidentiality Agreements/', NULL, 15, '2020-09-04 15:28:17', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(108, 'Equity Capital Funding', 0, '', '/Equity Capital Funding/', NULL, 15, '2020-09-04 15:28:22', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(109, 'Contractor Agreements', 0, '', '/Contractor Agreements/', NULL, 15, '2020-09-04 15:28:29', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(110, 'Loan Agreements', 0, '', '/Loan Agreements/', NULL, 15, '2020-09-04 15:28:43', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(111, 'Business Loans', 0, '', '/Business Loans/', NULL, 15, '2020-09-04 15:28:53', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(112, 'Venture Capital', 0, '', '/Venture Capital/', NULL, 15, '2020-09-04 15:29:07', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(113, 'Convertible Note', 0, '', '/Convertible Note/', NULL, 15, '2020-09-04 15:29:27', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(114, 'Consulting Agreements', 0, '', '/Consulting Agreements/', NULL, 15, '2020-09-04 15:29:29', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(115, 'Business Insurance', 0, '', '/Business Insurance/', NULL, 15, '2020-09-04 15:29:38', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(116, 'Joint Venture Agreements', 0, '', '/Joint Venture Agreements/', NULL, 15, '2020-09-04 15:29:43', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(117, 'Business Accounting', 0, '', '/Business Accounting/', NULL, 15, '2020-09-04 15:29:55', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(118, 'Distribution Agreements', 0, '', '/Distribution Agreements/', NULL, 15, '2020-09-04 15:29:58', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(119, 'Payments', 0, '', '/Payments/', NULL, 15, '2020-09-04 15:30:04', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(120, 'Credit & Collection', 0, '', '/Credit & Collection/', NULL, 15, '2020-09-04 15:30:17', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(121, 'Sales Commission Agreements', 0, '', '/Sales Commission Agreements/', NULL, 15, '2020-09-04 15:30:19', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(122, 'Transfer & Assignment Agreements', 0, '', '/Transfer & Assignment Agreements/', NULL, 15, '2020-09-04 15:30:38', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(123, 'Financial Projection', 0, '', '/Financial Projection/', NULL, 15, '2020-09-04 15:31:35', NULL, NULL, 1, 0, NULL, NULL, 6, NULL, NULL),
(124, 'Stock Purchase & Sale Agreement', 0, '', '/Stock Purchase & Sale Agreement/', NULL, 15, '2020-09-04 15:32:02', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(125, 'Lease Agreements', 0, '', '/Lease Agreements/', NULL, 15, '2020-09-04 15:32:19', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(126, 'Business Plan', 0, '', '/Business Plan/', NULL, 15, '2020-09-04 15:32:27', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(127, 'Manufacturing & Supply Agreements', 0, '', '/Manufacturing & Supply Agreements/', NULL, 15, '2020-09-04 15:32:49', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(128, 'Company Policy', 0, '', '/Company Policy/', NULL, 15, '2020-09-04 15:32:50', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(129, 'Business Procedures', 0, '', '/Business Procedures/', NULL, 15, '2020-09-04 15:33:06', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(130, 'Franchise Agreements', 0, '', '/Franchise Agreements/', NULL, 15, '2020-09-04 15:33:08', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(131, 'Meeting Minutes', 0, '', '/Meeting Minutes/', NULL, 15, '2020-09-04 15:33:18', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(132, 'Agency Agreements', 0, '', '/Agency Agreements/', NULL, 15, '2020-09-04 15:33:21', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(133, 'Payment Agreements', 0, '', '/Payment Agreements/', NULL, 15, '2020-09-04 15:33:38', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(134, 'Exclusivity Agreements', 0, '', '/Exclusivity Agreements/', NULL, 15, '2020-09-04 15:33:54', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(135, 'Shareholders & Investors', 0, '', '/Shareholders & Investors/', NULL, 15, '2020-09-04 15:34:00', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(136, 'Equipment Agreements', 0, '', '/Equipment Agreements/', NULL, 15, '2020-09-04 15:34:06', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(137, 'Board of Directors', 0, '', '/Board of Directors/', NULL, 15, '2020-09-04 15:34:15', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(138, 'Litigation & Settlement', 0, '', '/Litigation & Settlement/', NULL, 15, '2020-09-04 15:34:30', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(139, 'Management', 0, '', '/Management/', NULL, 15, '2020-09-04 15:34:33', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(140, 'Employees', 0, '', '/Employees/', NULL, 15, '2020-09-04 15:34:46', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(141, 'Purchase & Sale Agreements', 0, '', '/Purchase & Sale Agreements/', NULL, 15, '2020-09-04 15:34:48', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(142, 'Clients & Prospects', 0, '', '/Clients & Prospects/', NULL, 15, '2020-09-04 15:35:04', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(143, 'Incorporation Agreements', 0, '', '/Incorporation Agreements/', NULL, 15, '2020-09-04 15:35:06', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(144, 'Partners & Associates', 0, '', '/Partners & Associates/', NULL, 15, '2020-09-04 15:35:22', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(145, 'Employment Agreements', 0, '', '/Employment Agreements/', NULL, 15, '2020-09-04 15:35:24', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(146, 'Suppliers & Providers', 0, '', '/Suppliers & Providers/', NULL, 15, '2020-09-04 15:35:37', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(147, 'Last Will & Testaments', 0, '', '/Last Will & Testaments/', NULL, 15, '2020-09-04 15:35:44', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(148, 'Consultants & Contractors', 0, '', '/Consultants & Contractors/', NULL, 15, '2020-09-04 15:35:52', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(149, 'Non-Compete Agreements', 0, '', '/Non-Compete Agreements/', NULL, 15, '2020-09-04 15:35:58', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(150, 'Distributors & Resellers', 0, '', '/Distributors & Resellers/', NULL, 15, '2020-09-04 15:36:07', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(151, 'Promissory Notes', 0, '', '/Promissory Notes/', NULL, 15, '2020-09-04 15:36:10', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(152, 'Creditors & Lenders', 0, '', '/Creditors & Lenders/', NULL, 15, '2020-09-04 15:36:26', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(153, 'Competitors', 0, '', '/Competitors/', NULL, 15, '2020-09-04 15:36:34', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(154, 'Guaranties & Collateral', 0, '', '/Guaranties & Collateral/', NULL, 15, '2020-09-04 15:36:39', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(155, 'Board Resolutions', 0, '', '/Board Resolutions/', NULL, 15, '2020-09-04 15:36:46', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(156, 'Business Strategy', 0, '', '/Business Strategy/', NULL, 15, '2020-09-04 15:36:58', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(157, 'Copyrights, Patents & Trademark', 0, '', '/Copyrights, Patents & Trademark/', NULL, 15, '2020-09-04 15:37:02', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(158, 'Business Analysis', 0, '', '/Business Analysis/', NULL, 15, '2020-09-04 15:37:08', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(159, 'Business Checklist', 0, '', '/Business Checklist/', NULL, 15, '2020-09-04 15:37:25', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(160, 'Development Agreements', 0, '', '/Development Agreements/', NULL, 15, '2020-09-04 15:37:42', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(161, 'Business Assessment', 0, '', '/Business Assessment/', NULL, 15, '2020-09-04 15:37:57', NULL, NULL, 1, 0, NULL, NULL, 8, NULL, NULL),
(162, 'Franchise Agreement', 0, '', '/Franchise Agreement/', NULL, 15, '2020-09-04 15:38:06', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(163, 'Terms & Conditions', 0, '', '/Terms & Conditions/', NULL, 15, '2020-09-04 15:38:17', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(164, 'Real Estate Purchase Agreements', 0, '', '/Real Estate Purchase Agreements/', NULL, 15, '2020-09-04 15:38:48', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(165, 'Purchasing & Ordering', 0, '', '/Purchasing & Ordering/', NULL, 15, '2020-09-04 15:39:01', NULL, NULL, 1, 0, NULL, NULL, 9, NULL, NULL),
(166, 'Receiving', 0, '', '/Receiving/', NULL, 15, '2020-09-04 15:39:08', NULL, NULL, 1, 0, NULL, NULL, 9, NULL, NULL),
(167, 'Sales Representative Agreements', 0, '', '/Sales Representative Agreements/', NULL, 15, '2020-09-04 15:39:14', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(168, 'Shipping', 0, '', '/Shipping/', NULL, 15, '2020-09-04 15:39:18', NULL, NULL, 1, 0, NULL, NULL, 9, NULL, NULL),
(169, 'Equipment & Machinery', 0, '', '/Equipment & Machinery/', NULL, 15, '2020-09-04 15:39:39', NULL, NULL, 1, 0, NULL, NULL, 9, NULL, NULL),
(170, 'Limited Partnership Agreements', 0, '', '/Limited Partnership Agreements/', NULL, 15, '2020-09-04 15:39:44', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(171, 'Production Management', 0, '', '/Production Management/', NULL, 15, '2020-09-04 15:39:51', NULL, NULL, 1, 0, NULL, NULL, 9, NULL, NULL),
(172, 'Contract Termination', 0, '', '/Contract Termination/', NULL, 15, '2020-09-04 15:39:57', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(173, 'Suppliers & Vendors', 0, '', '/Suppliers & Vendors/', NULL, 15, '2020-09-04 15:40:03', NULL, NULL, 1, 0, NULL, NULL, 9, NULL, NULL),
(174, 'Storage & Inventory', 0, '', '/Storage & Inventory/', NULL, 15, '2020-09-04 15:40:15', NULL, NULL, 1, 0, NULL, NULL, 9, NULL, NULL),
(175, 'LLC Operating Agreements', 0, '', '/LLC Operating Agreements/', NULL, 15, '2020-09-04 15:40:15', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(176, 'Quality Assurance', 0, '', '/Quality Assurance/', NULL, 15, '2020-09-04 15:40:29', NULL, NULL, 1, 0, NULL, NULL, 9, NULL, NULL),
(177, 'Merger & Acquisition Agreements', 0, '', '/Merger & Acquisition Agreements/', NULL, 15, '2020-09-04 15:40:33', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(178, 'Research & Development', 0, '', '/Research & Development/', NULL, 15, '2020-09-04 15:40:40', NULL, NULL, 1, 0, NULL, NULL, 9, NULL, NULL),
(179, 'Affidavits', 0, '', '/Affidavits/', NULL, 15, '2020-09-04 15:40:43', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(180, 'Deeds', 0, '', '/Deeds/', NULL, 15, '2020-09-04 15:40:52', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(181, 'Product Management', 0, '', '/Product Management/', NULL, 15, '2020-09-04 15:40:52', NULL, NULL, 1, 0, NULL, NULL, 9, NULL, NULL),
(182, 'Power of Attorney', 0, '', '/Power of Attorney/', NULL, 15, '2020-09-04 15:41:13', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(183, 'Release Agreements', 0, '', '/Release Agreements/', NULL, 15, '2020-09-04 15:41:24', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL),
(184, 'Service, Support & Maintenance', 0, '', '/Service, Support & Maintenance/', NULL, 15, '2020-09-04 15:41:42', NULL, NULL, 1, 0, NULL, NULL, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file_folders_categories`
--

CREATE TABLE `file_folders_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `date_last_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `file_folders_categories`
--

INSERT INTO `file_folders_categories` (`category_id`, `category_name`, `category_desc`, `company_id`, `created_by`, `date_created`, `modified_by`, `date_last_modified`) VALUES
(3, 'Business Plan Kit', 'Everything you need to create a business plan, start your business and raise financing', 1, 15, '2020-09-04 09:06:29', NULL, NULL),
(4, 'Sales & Marketing', 'Everything you need to grow your business sales & market share', 1, 15, '2020-09-04 09:14:52', NULL, NULL),
(5, 'Human Resources', 'Everything you need to hire, motivate and manage your team', 1, 15, '2020-09-04 09:17:10', NULL, NULL),
(6, 'Finance & Accounting', 'Everything you need to manage your business finances & raise financing', 1, 15, '2020-09-04 09:18:37', NULL, NULL),
(7, 'Legal Agreements', 'Everything you need to create contracts & protect your legal rights', 1, 15, '2020-09-04 09:19:31', NULL, NULL),
(8, 'Administration', 'Everything you need to manage your business & stakeholders relationships', 1, 15, '2020-09-04 09:20:25', NULL, NULL),
(9, 'Production & Operations', 'Everything you need to manage product development & production', 1, 15, '2020-09-04 09:26:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file_folders_permissions_roles`
--

CREATE TABLE `file_folders_permissions_roles` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `create_folder` int(1) NOT NULL DEFAULT '0',
  `add_file` int(1) NOT NULL DEFAULT '0',
  `edit_folder_file` int(1) NOT NULL DEFAULT '0',
  `move_folder_file` int(1) NOT NULL DEFAULT '0',
  `trash_folder_file` int(1) NOT NULL DEFAULT '0',
  `remove_folder_file` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_folders_permissions_users`
--

CREATE TABLE `file_folders_permissions_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `create_folder` int(1) NOT NULL DEFAULT '0',
  `add_file` int(1) NOT NULL DEFAULT '0',
  `edit_folder_file` int(1) NOT NULL DEFAULT '0',
  `move_folder_file` int(1) NOT NULL DEFAULT '0',
  `trash_folder_file` int(1) NOT NULL DEFAULT '0',
  `remove_folder_file` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `file_folders_permissions_users`
--

INSERT INTO `file_folders_permissions_users` (`id`, `user_id`, `company_id`, `create_folder`, `add_file`, `edit_folder_file`, `move_folder_file`, `trash_folder_file`, `remove_folder_file`) VALUES
(1, 15, 1, 0, 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `form_responses`
--

CREATE TABLE `form_responses` (
  `id` int(11) NOT NULL,
  `key` int(11) NOT NULL COMMENT 'link to question',
  `value` text NOT NULL,
  `response_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `google_accounts`
--

CREATE TABLE `google_accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `google_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `google_access_token` text COLLATE utf8_unicode_ci NOT NULL,
  `google_refresh_token` text COLLATE utf8_unicode_ci NOT NULL,
  `enabled_calendars` text COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gps_location`
--

CREATE TABLE `gps_location` (
  `gps_location_id` int(11) NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `coordinates` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `job_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_type` enum('Deposit','Partial Payment','Final Payment','Total Due') COLLATE utf8_unicode_ci NOT NULL,
  `work_order_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `po_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_issued` date NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('Draft','Partially Paid','Paid','Due','Overdue') COLLATE utf8_unicode_ci NOT NULL,
  `total_due` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `deposit_request` decimal(10,2) NOT NULL,
  `accept_credit_card` tinyint(4) NOT NULL DEFAULT '1',
  `accept_check` tinyint(4) NOT NULL DEFAULT '1',
  `accept_cash` tinyint(4) NOT NULL DEFAULT '1',
  `accept_direct_deposit` tinyint(4) NOT NULL DEFAULT '1',
  `accept_credit` tinyint(4) NOT NULL DEFAULT '0',
  `message_to_customer` text COLLATE utf8_unicode_ci NOT NULL,
  `terms_and_conditions` text COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `is_recurring` int(11) NOT NULL DEFAULT '0',
  `invoice_totals` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customer_id`, `job_location`, `job_name`, `invoice_type`, `work_order_number`, `po_number`, `invoice_number`, `date_issued`, `due_date`, `status`, `total_due`, `balance`, `deposit_request`, `accept_credit_card`, `accept_check`, `accept_cash`, `accept_direct_deposit`, `accept_credit`, `message_to_customer`, `terms_and_conditions`, `date_created`, `date_updated`, `company_id`, `is_recurring`, `invoice_totals`, `user_id`, `phone`) VALUES
(1, 1, '6055 Born Court , Pensacola, FL 32504', 'Jane Smith', 'Total Due', 'WO-00003', '', 'INV-00001', '2020-08-27', '2020-08-27', 'Draft', 719.28, 0.00, 0.00, 1, 1, 1, 1, 0, 'Thank you for your business.', '', '2020-08-26 16:18:00', '0000-00-00 00:00:00', 1, 0, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_items`
--

CREATE TABLE `invoices_items` (
  `invoice_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices_items`
--

INSERT INTO `invoices_items` (`invoice_id`, `items_id`, `qty`) VALUES
(1, 2, 1),
(1, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_payment_schedule`
--

CREATE TABLE `invoices_payment_schedule` (
  `id` int(11) NOT NULL,
  `payment_type` enum('Fixed','Percent') COLLATE utf8_unicode_ci NOT NULL,
  `payment_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `invoice_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices_photo`
--

CREATE TABLE `invoices_photo` (
  `id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'uploads/CompanyPhoto/<company_id>/<file_name>',
  `invoice_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_has_items`
--

CREATE TABLE `invoice_has_items` (
  `ihi_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `locations` text COLLATE utf8_unicode_ci,
  `total_value` decimal(9,2) DEFAULT NULL,
  `discount` decimal(9,2) NOT NULL,
  `discount_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'percent, amount per, fixed total',
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_settings`
--

CREATE TABLE `invoice_settings` (
  `id` int(11) NOT NULL,
  `invoice_num_prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'INV-',
  `invoice_num_next` int(11) NOT NULL DEFAULT '1',
  `check_payable_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accept_credit_card` tinyint(1) NOT NULL DEFAULT '1',
  `accept_check` tinyint(1) NOT NULL DEFAULT '1',
  `accept_cash` tinyint(1) NOT NULL DEFAULT '1',
  `accept_direct_deposit` tinyint(1) NOT NULL DEFAULT '1',
  `accept_credit` tinyint(1) NOT NULL DEFAULT '1',
  `mobile_payment` tinyint(1) NOT NULL DEFAULT '1',
  `capture_customer_signature` tinyint(4) NOT NULL DEFAULT '1',
  `hide_item_price` tinyint(1) NOT NULL DEFAULT '0',
  `hide_item_qty` tinyint(1) NOT NULL DEFAULT '0',
  `hide_item_tax` tinyint(1) NOT NULL DEFAULT '0',
  `hide_item_discount` tinyint(1) NOT NULL DEFAULT '0',
  `hide_item_total` tinyint(1) NOT NULL DEFAULT '0',
  `hide_from_email` tinyint(1) NOT NULL DEFAULT '0',
  `hide_item_subtotal` tinyint(1) NOT NULL DEFAULT '0',
  `hide_business_phone` tinyint(1) NOT NULL DEFAULT '1',
  `hide_office_phone` tinyint(1) NOT NULL DEFAULT '1',
  `accept_tip` tinyint(1) NOT NULL DEFAULT '1',
  `due_terms` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auto_convert_completed_work_order` tinyint(1) NOT NULL DEFAULT '1',
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `terms_and_conditions` text COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `commercial_message` text COLLATE utf8_unicode_ci NOT NULL,
  `commercial_terms_and_conditions` text COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_fee_percent` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_fee_amount` int(11) DEFAULT NULL,
  `recurring` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice_settings`
--

INSERT INTO `invoice_settings` (`id`, `invoice_num_prefix`, `invoice_num_next`, `check_payable_to`, `accept_credit_card`, `accept_check`, `accept_cash`, `accept_direct_deposit`, `accept_credit`, `mobile_payment`, `capture_customer_signature`, `hide_item_price`, `hide_item_qty`, `hide_item_tax`, `hide_item_discount`, `hide_item_total`, `hide_from_email`, `hide_item_subtotal`, `hide_business_phone`, `hide_office_phone`, `accept_tip`, `due_terms`, `auto_convert_completed_work_order`, `message`, `terms_and_conditions`, `company_id`, `commercial_message`, `commercial_terms_and_conditions`, `logo`, `payment_fee_percent`, `payment_fee_amount`, `recurring`) VALUES
(1, 'INV-', 2, '', 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, '', 1, 'Thank you for your business.', '', 1, 'Thank you for your business.', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(15) NOT NULL COMMENT 'service, material, product, fee',
  `description` text NOT NULL,
  `model` varchar(100) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `COGS` decimal(8,2) NOT NULL COMMENT 'cost of goods sold',
  `price` decimal(8,2) NOT NULL,
  `cost per` varchar(20) NOT NULL,
  `url` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `item_categories_id` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL COMMENT '1=active\\n0=non active',
  `vendor_id` int(11) NOT NULL,
  `units` varchar(25) DEFAULT NULL,
  `frequency` varchar(255) NOT NULL,
  `estimated_time` smallint(6) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attached_image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `company_id`, `title`, `type`, `description`, `model`, `brand`, `COGS`, `price`, `cost per`, `url`, `notes`, `item_categories_id`, `is_active`, `vendor_id`, `units`, `frequency`, `estimated_time`, `modified`, `attached_image`) VALUES
(2, 1, '4 Button Remote', 'product', '', '58069', 'Honeywell', 159.00, 159.00, '', '', '', 0, 1, 3, '100', '', 0, '2020-09-11 00:07:53', ''),
(4, 1, '8 Channel Stream Video Recorder', 'product', 'DVR', '71499', 'Avycon', 499.00, 499.00, '', 'test', '', 1, 1, 1, '5', '', 0, '2020-09-11 00:07:53', ''),
(5, 1, 'AIO SMART Control Panel', 'product', '', '1179', 'Alarm.com', 179.00, 179.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(6, 1, 'Alarm Billable Rate per Hour', 'product', 'Junior Tech', 'BR75', 'ADI', 79.00, 79.00, '', 'adialarms.com', '', 1, 1, 1, '', '', 0, '2020-09-11 00:07:53', ''),
(7, 1, 'Alarm.com Door Bell Slim', 'product', 'Skybell', '41209', 'Alarm.com', 299.00, 299.00, '', 'alarm.com', '', 0, 1, 1, '', '', 0, '2020-09-11 00:07:53', ''),
(8, 1, 'Alarm.com IP Outdoor Camera', 'product', '', '71199', 'Alarm.com', 299.00, 299.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(9, 1, 'ALARM.COM Thermostat', 'product', '', '71099', 'Honeywell', 249.00, 249.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(10, 1, 'Alpha Keypad 6160 RF', 'product', '', '11299', 'Arlo', 299.00, 299.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(11, 1, 'Arlo 2 CAM IP', 'product', '', '71599', 'ADI', 799.00, 799.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(12, 1, 'CCTV Billable Rate per Hour', 'product', '', 'BR105', 'Honeywell', 105.00, 105.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(13, 1, 'Cellular Card Honeywell Lynx Plus', 'product', '', '17200', 'Honeywell', 399.00, 399.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(14, 1, 'Cellular Honeywell Radio Vista', 'product', '', '27279', 'Honeywell', 399.00, 399.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(15, 1, 'Commercial Alarm QSP', 'product', '', '39059', 'ADI', 59.00, 59.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(16, 1, 'Commercial DVR QSP', 'product', '', '39089', 'Honeywell', 89.00, 89.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(17, 1, 'Commercial Fire Alarm Service', 'product', 'per hour', '39165', 'Honeywell', 165.00, 165.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(18, 1, 'Commercial Installation up to 5000 sq feet', 'product', '', '39799', 'Honeywell', 799.00, 799.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(19, 1, 'Commercial Vista with Sem', 'product', '', '39399', 'Honeywell', 399.00, 399.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(20, 1, 'Consultation', 'product', '', '39250', 'ADI', 250.00, 250.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(21, 1, 'Designated Surge Protector', 'product', '', '27859', 'ADI', 59.00, 59.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(22, 1, 'Detached Garage Motion', 'product', '', '33299', 'Honeywell', 299.00, 299.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(23, 1, 'Doorbell Chime Setup', 'product', '', '41079', 'ADI', 79.00, 79.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(24, 1, 'Doorbell Kit', 'product', '', '41055', 'ADI', 55.00, 55.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(25, 1, 'Doorbell Video (Existing)', 'product', 'Add-on $5 on MMR', '41249', 'Honeywell', 249.00, 249.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(26, 1, 'Doorbell Video (non existing)', 'product', 'non working or no current doorbell at location', '41279', 'Alarm.com', 279.00, 279.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(27, 1, 'DSL Phone Line Filter', 'product', '', '17020', 'Honeywell', 50.00, 50.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(28, 1, 'Extended Antenna', 'product', '', '10299', 'Honeywell', 299.00, 299.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(29, 1, 'Extender', 'product', '', '10149', 'Honeywell', 149.00, 149.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(30, 1, 'Extra Recessed  Door', 'product', '', '', '', 159.00, 159.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-08-20 20:49:55', ''),
(31, 1, 'Extra Wireless Door/Window', 'product', '', '32139', 'Honeywell', 139.00, 139.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(32, 1, 'Eye Fixed HD', 'product', '', '71199', 'Avycon', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(33, 1, 'Eye Varifocal HD', 'product', '', '71179', 'Avycon', 299.00, 299.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(34, 1, 'Fixed Honeywell Indoor Camera', 'product', '', '48199', 'Honeywell', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(35, 1, 'Fixed Honeywell Outdoor Video Camera', 'product', '', '48399', 'Honeywell', 399.00, 399.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(36, 1, 'Go Panel 2', 'product', '', '11450', 'Alarm.com', 799.00, 799.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(37, 1, 'Go Panel 3', 'product', '', '11650', 'Alarm.com', 999.00, 999.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(38, 1, 'HDMI Sold Per 1 FT', 'product', '', '20005', 'ADI', 5.00, 5.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(39, 1, 'Honeywell 6150RF', 'product', '', '11199', 'Honeywell', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(40, 1, 'Honeywell Alpha 6160', 'product', '', '11249', 'Honeywell', 249.00, 249.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(41, 1, 'Honeywell Lynx 3000 (Quick Connect)', 'product', '', '11290', 'Honeywell', 499.00, 499.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(42, 1, 'Honeywell Lynx Touch Screen', 'product', '', '11550', 'Honeywell', 799.00, 799.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(43, 1, 'Honeywell Skybell Cam', 'product', '', '11359', 'Honeywell', 359.00, 359.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(44, 1, 'Honeywell Thermostat', 'product', '', '38149', 'Honeywell', 399.00, 399.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(45, 1, 'Honeywell Total Connect Access Point', 'product', '', '41055', 'Honeywell', 89.00, 89.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(46, 1, 'Honeywell Vista 15P with GSM', 'product', '', '27698', 'Honeywell', 698.00, 698.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(47, 1, 'Honeywell Vista 15P with Sem', 'product', '', '71698', 'Honeywell', 698.00, 698.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(48, 1, 'Honeywell Wifi Card', 'product', '', '17099', 'Honeywell', 99.00, 99.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(49, 1, 'Indoor DVR Camera', 'product', '', '71199', 'Avycon', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(50, 1, 'Interior IP Camera', 'product', 'Add $5 extra MMR', '48299', 'Alarm.com', 299.00, 299.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(51, 1, 'Key Pad W/L 5828', 'product', '', '11190', 'Honeywell', 499.00, 499.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(52, 1, 'Keyless Entry Doorlock', 'product', '', '40299', 'Yale', 299.00, 299.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(53, 1, 'LYNX TOUCH Honeywell GSM', 'product', '', '37229', 'Honeywell', 499.00, 499.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(54, 1, 'Medical Alert', 'product', '', '32079', 'Honeywell', 149.00, 149.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(55, 1, 'Medical Panic', 'product', 'Extra $7 to MMR', '32199', 'Honeywell', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(56, 1, 'Net Gear Router', 'product', '', '27215', 'ADI', 215.00, 215.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(57, 1, 'Network Issue Diagnostics', 'product', 'per hour', '27269', 'ADI', 69.00, 69.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(58, 1, 'New Medical Pendant', 'product', '', '32149', 'PERS', 149.00, 149.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(59, 1, 'Outdoor Camera', 'product', 'Extra $5 MMR', '48399', 'Avycon', 399.00, 399.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(60, 1, 'Outside Gate Contact', 'product', '', '31131', 'Honeywell', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(61, 1, 'Overhead Contact', 'product', '', '31199', 'Honeywell', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(62, 1, 'Pan and Tilt Video Camera (ip-cam-pt)', 'product', '', '31130', 'Honeywell', 499.00, 499.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(63, 1, 'PERS with monitoring', 'product', '', '32699', 'ADI', 699.00, 699.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(64, 1, 'POE Outdoor IP Camera Commercial', 'product', '', '71339', 'Avycon', 499.00, 499.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(65, 1, 'Power Supply (6-24V 2.5A)', 'product', '', '10090', 'ADI', 149.00, 149.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(66, 1, 'Prewire (rough end)', 'product', '', '20195', 'ADI', 195.00, 195.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(67, 1, 'Program & Setup', 'product', '', '20199', 'ADI', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(68, 1, 'Recess Door Contact', 'product', '', '32099', 'Honeywell', 99.00, 99.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(69, 1, 'Remote View Kit', 'product', '', '26199', 'ADI', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(70, 1, 'Residential 4 CH Wire Run', 'product', '', '26299', 'ADI', 299.00, 299.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(71, 1, 'Residential Installation up to 1900 sq feet', 'product', '', '26499', 'ADI', 499.00, 499.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(72, 1, 'Residential Program and Setup', 'product', '', '26099', 'ADI', 99.00, 99.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(73, 1, 'Residential Smart Home Program and Setup', 'product', '', '27177', 'ADI', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(74, 1, 'Residential Smart QSP', 'product', '', '27053', 'ADI', 53.00, 53.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(75, 1, 'RF Transceiver', 'product', '', '10199', 'ADI', 289.00, 289.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(76, 1, 'RJ Jack', 'product', '', '27030', 'ADI', 55.00, 55.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(77, 1, 'Run cat5 & high cable', 'product', '', '27219', 'ADI', 219.00, 219.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(78, 1, 'Safe Contact', 'product', '', '32100', 'Honeywell', 100.00, 100.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(79, 1, 'SEM Module Honeywell Hardwire', 'product', '', '71399', 'Alarm.com', 499.00, 499.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(80, 1, 'Surface Contact', 'product', '2 for $100', '32149', 'Honeywell', 149.00, 149.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(81, 1, 'System Battery', 'product', '', '17065', 'Honeywell', 65.00, 65.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(82, 1, 'Talking Key Pad W/L 5828', 'product', '', '11229', 'Honeywell', 550.00, 550.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(83, 1, 'Translator Universal', 'product', '', '28199', 'Alarm.com', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(84, 1, 'Trenching Run to Detached Building', 'product', '', '28399', 'ADI', 399.00, 399.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(85, 1, 'Universal AC Transformer', 'product', '', '20089', 'Honeywell', 79.00, 79.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(86, 1, 'Vista 20 panel upgrade', 'product', '', '28100', 'Honeywell', 100.00, 100.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(87, 1, 'Warranty Deductible', 'product', '', 'WD35', 'ADI', 35.00, 35.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(88, 1, 'Warranty Deductible /Trip', 'product', '', 'WD65', 'ADI', 65.00, 65.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(89, 1, 'White Bullet HD', 'product', '', '71199', 'Avycon', 299.00, 299.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(90, 1, 'Wire Drop', 'product', 'per location', '28065', 'ADI', 65.00, 65.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(91, 1, 'Wireless Carbon Monoxide', 'product', '', '35119', 'Honeywell', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(92, 1, 'Wireless GlassBreak', 'product', '', '33099', 'Honeywell', 179.00, 179.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(93, 1, 'Wireless Heat Detector', 'product', '', '35125', 'Honeywell', 299.00, 299.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(94, 1, 'Wireless Motion Detector Commercial', 'product', '', '33159', 'Honeywell', 299.00, 299.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(95, 1, 'Wireless Motion Detector Residential', 'product', '', '33089', 'Honeywell', 229.00, 229.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(96, 1, 'Wireless Outdoor Contact', 'product', '', '31130', 'Honeywell', 199.00, 199.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(97, 1, 'Wireless Repeater (Strength RF Signal)', 'product', '', '10100', 'Honeywell', 249.00, 249.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(98, 1, 'Wireless Siren', 'product', '', '14149', 'Honeywell', 279.00, 279.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(99, 1, 'Wireless Smoke Detector Resi/Comm', 'product', '', '35099', 'Honeywell', 399.00, 399.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(100, 1, 'WireLoop for Double Windows', 'product', '', '32025', 'Honeywell', 179.00, 179.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(101, 1, 'Yale Deadbolt Locks', 'product', '', '40299', 'Yale', 299.00, 299.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(102, 1, 'Yale Handle Door Locks', 'product', '', '40399', 'Yale', 399.00, 399.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(103, 1, 'Z-wave module', 'product', '', '40149', 'Alarm.com', 149.00, 149.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(104, 1, 'Z-wave plug', 'product', '', '40065', 'Alarm.com', 69.00, 69.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(106, 1, 'Alarm Inspection', 'product', 'Test all devices & replace batteries and send signals', '39099', 'ADI', 99.00, 99.00, '', '', '', 0, 1, 0, NULL, 'Yearly', 0, '2020-09-11 00:07:53', ''),
(107, 1, 'Invoicing', 'product', 'Paper Billing', '39001', 'ADI', 3.00, 3.00, '', '', '', 0, 1, 0, NULL, 'One Time', 0, '2020-09-11 00:07:53', ''),
(109, 1, 'Extra Recessed Door', 'product', '', '32159', 'Honeywell', 159.00, 159.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', ''),
(110, 1, 'Late Fee/Return Fee', 'product', '', '37035', 'ADI', 49.00, 49.00, '', '', '', 0, 1, 0, NULL, '', 0, '2020-09-11 00:07:53', '');

-- --------------------------------------------------------

--
-- Table structure for table `items_has_files`
--

CREATE TABLE `items_has_files` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items_has_storage_loc`
--

CREATE TABLE `items_has_storage_loc` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `inserted_by` int(11) DEFAULT NULL,
  `insert_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `qty` int(11) DEFAULT '0',
  `company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items_has_storage_loc`
--

INSERT INTO `items_has_storage_loc` (`id`, `item_id`, `name`, `inserted_by`, `insert_date`, `qty`, `company_id`) VALUES
(1, 4, 'test', NULL, '2020-07-31 07:22:38', 1, 1),
(2, 5, 'art', NULL, '2020-08-01 07:09:20', 3, 1),
(3, 4, 'Tyler Car', NULL, '2020-08-01 19:56:35', 50, 1),
(4, 5, 'TC Car', NULL, '2020-08-06 23:23:20', 23, 1),
(14, 2, 'art', NULL, '2020-09-10 23:58:43', 122, 1),
(13, 2, 'TC Car', NULL, '2020-09-06 17:04:23', 100, 1),
(8, 4, 'sdsd', NULL, '2020-08-20 20:49:55', 33, 1),
(12, 2, 'Pensacola', NULL, '2020-08-27 13:43:26', 100, 1),
(15, 2, 'test', NULL, '2020-09-10 23:58:43', 8, 1),
(16, 2, '', NULL, '2020-09-10 23:58:43', NULL, 1),
(17, 4, 'test', NULL, '2020-09-10 23:58:43', 1, 1),
(18, 4, 'Tyler Car', NULL, '2020-09-10 23:58:43', 50, 1),
(19, 4, 'sdsd', NULL, '2020-09-10 23:58:43', 33, 1),
(20, 4, '', NULL, '2020-09-10 23:58:43', 0, 1),
(21, 4, '', NULL, '2020-09-10 23:58:43', NULL, 1),
(22, 5, 'art', NULL, '2020-09-10 23:58:43', 3, 1),
(23, 5, 'TC Car', NULL, '2020-09-10 23:58:43', 23, 1),
(24, 5, '', NULL, '2020-09-10 23:58:43', NULL, 1),
(25, 6, 'Corporate', NULL, '2020-09-10 23:58:43', 10000, 1),
(26, 6, 'art', NULL, '2020-09-10 23:58:43', 2200, 1),
(27, 6, 'test', NULL, '2020-09-10 23:58:43', 87, 1),
(28, 6, '', NULL, '2020-09-10 23:58:43', NULL, 1),
(29, 2, 'art', NULL, '2020-09-11 00:07:53', 122, 1),
(30, 2, 'test', NULL, '2020-09-11 00:07:53', 8, 1),
(31, 2, '', NULL, '2020-09-11 00:07:53', NULL, 1),
(32, 4, 'test', NULL, '2020-09-11 00:07:53', 1, 1),
(33, 4, 'Tyler Car', NULL, '2020-09-11 00:07:53', 50, 1),
(34, 4, 'sdsd', NULL, '2020-09-11 00:07:53', 33, 1),
(35, 4, '', NULL, '2020-09-11 00:07:53', 0, 1),
(36, 4, '', NULL, '2020-09-11 00:07:53', NULL, 1),
(37, 5, 'art', NULL, '2020-09-11 00:07:53', 3, 1),
(38, 5, 'TC Car', NULL, '2020-09-11 00:07:53', 23, 1),
(39, 5, '', NULL, '2020-09-11 00:07:53', NULL, 1),
(40, 6, 'Corporate', NULL, '2020-09-11 00:07:53', 10000, 1),
(41, 6, 'art', NULL, '2020-09-11 00:07:53', 2200, 1),
(42, 6, 'test', NULL, '2020-09-11 00:07:53', 87, 1),
(43, 6, '', NULL, '2020-09-11 00:07:53', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `item_categories_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`item_categories_id`, `name`, `description`, `parent_id`, `company_id`) VALUES
(1, 'Cameras', '', 1, 1),
(2, 'Security', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobs_id` int(11) NOT NULL,
  `job_number` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `job_type` int(11) DEFAULT NULL COMMENT 'questions > Job_type\\nOptions >user defined',
  `priority` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobs_id`, `job_number`, `job_location`, `job_name`, `description`, `job_type`, `priority`, `status`, `created_by`, `created_date`, `company_id`) VALUES
(1, '1000', '', 'test job', '', 1, 'low', 'New', 2, '2020-07-11 02:34:04', 1),
(2, '1001', '', 'Test job 2', '', 1, 'medium', 'Scheduled', 2, '2020-07-11 02:37:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_address`
--

CREATE TABLE `jobs_has_address` (
  `jobs_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jobs_has_address`
--

INSERT INTO `jobs_has_address` (`jobs_id`, `address_id`) VALUES
(1, 0),
(2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_contracts`
--

CREATE TABLE `jobs_has_contracts` (
  `jobs_id` int(11) NOT NULL,
  `contracts_id` int(11) NOT NULL,
  `contract_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file with inserted information',
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_customers`
--

CREATE TABLE `jobs_has_customers` (
  `jobs_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jobs_has_customers`
--

INSERT INTO `jobs_has_customers` (`jobs_id`, `id`) VALUES
(1, 0),
(2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_employees`
--

CREATE TABLE `jobs_has_employees` (
  `jobs_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `emp_role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_files`
--

CREATE TABLE `jobs_has_files` (
  `jobs_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_job_settings`
--

CREATE TABLE `jobs_has_job_settings` (
  `jobs_id` int(11) NOT NULL,
  `job_settings_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_time_record`
--

CREATE TABLE `jobs_has_time_record` (
  `jobs_id` int(11) NOT NULL,
  `timesheet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_has_custom_form`
--

CREATE TABLE `job_has_custom_form` (
  `job_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_settings`
--

CREATE TABLE `job_settings` (
  `job_settings_id` int(11) NOT NULL,
  `setting_type` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'job type\\npriority\\nstatus',
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_settings`
--

INSERT INTO `job_settings` (`job_settings_id`, `setting_type`, `value`, `status`, `created_at`, `company_id`) VALUES
(1, 'Job Type', 'Type 1', 1, '2020-07-07 04:31:41', 1),
(5, 'Job Type', 'Type 2', 1, '2020-07-07 04:32:08', 1),
(7, 'priority', 'low', 1, '2020-07-10 16:16:10', 1),
(8, 'priority', 'medium', 1, '2020-07-10 16:16:10', 1),
(9, 'priority', 'high', 1, '2020-07-10 16:16:50', 1),
(10, 'Job Status', 'New', 1, '2020-07-10 16:17:21', 1),
(11, 'Job Status', 'Scheduled', 1, '2020-07-10 16:18:23', 1),
(12, 'Job Status', 'Waiting on Customer', 1, '2020-07-10 16:18:23', 1),
(13, 'Job Status', 'Waiting for Parts', 1, '2020-07-10 16:18:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `customer_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suite_unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `notify_email` tinyint(1) NOT NULL,
  `notify_sms` tinyint(1) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('New','Contacted','Follow Up','Assigned','Converted','Closed') COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `customer_type`, `company_name`, `contact_name`, `contact_email`, `phone`, `street_address`, `suite_unit`, `city`, `postal_code`, `state`, `source`, `comments`, `notify_email`, `notify_sms`, `type`, `status`, `date_created`, `company_id`) VALUES
(1, 'Residential', '', 'Jane Doe', 'jane.doe@gmail.com', '', '', '', '', '', '', '', '', 1, 0, 'Manual Entry', 'New', '2020-09-08 06:15:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lead_source`
--

CREATE TABLE `lead_source` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lead_source`
--

INSERT INTO `lead_source` (`id`, `name`, `company_id`) VALUES
(1, 'Facebook', 1),
(2, 'Google', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `modules_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings`
--

CREATE TABLE `notification_settings` (
  `id` int(11) NOT NULL,
  `notify_email` tinyint(1) NOT NULL,
  `notify_sms` tinyint(1) NOT NULL,
  `notify_residential_when_scheduling` tinyint(1) NOT NULL,
  `notify_residential_during_rescheduling_cancelling` tinyint(1) NOT NULL,
  `set_default_commercial_value_as_residential` tinyint(1) NOT NULL,
  `notify_commercial_when_scheduling` tinyint(1) NOT NULL,
  `notify_commercial_during_rescheduling_cancelling` tinyint(1) NOT NULL,
  `customer_reminder_notification` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1 day before',
  `customer_first_heads_up_notification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_second_heads_up_notification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business_reminder_notification` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2 hours before',
  `task_reminder_notification` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '5 minutes before',
  `copy_when_sending_estimate` tinyint(1) NOT NULL,
  `copy_when_sending_invoice` tinyint(1) NOT NULL,
  `notify_when_employees_arrive` tinyint(1) NOT NULL,
  `notify_tenant_from_service_address` tinyint(1) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification_settings`
--

INSERT INTO `notification_settings` (`id`, `notify_email`, `notify_sms`, `notify_residential_when_scheduling`, `notify_residential_during_rescheduling_cancelling`, `set_default_commercial_value_as_residential`, `notify_commercial_when_scheduling`, `notify_commercial_during_rescheduling_cancelling`, `customer_reminder_notification`, `customer_first_heads_up_notification`, `customer_second_heads_up_notification`, `business_reminder_notification`, `task_reminder_notification`, `copy_when_sending_estimate`, `copy_when_sending_invoice`, `notify_when_employees_arrive`, `notify_tenant_from_service_address`, `company_id`) VALUES
(1, 1, 0, 0, 0, 1, 0, 0, '1 day before', 'None', 'None', '2 hours before', '5 minutes before', 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nsmart_features`
--

CREATE TABLE `nsmart_features` (
  `id` int(11) NOT NULL,
  `feature_name` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `feature_description` text COLLATE utf8_unicode_ci NOT NULL,
  `plan_heading_id` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nsmart_features`
--

INSERT INTO `nsmart_features` (`id`, `feature_name`, `feature_description`, `plan_heading_id`, `date_created`, `date_updated`) VALUES
(1, 'FEATURE AAA', 'TEST AAA', 2, '2020-08-10 05:20:39', NULL),
(2, 'FEATURE AAA', 'TEST AAA', 2, '2020-08-10 05:21:49', NULL),
(3, 'FEATURE BBBB', 'BBBB', 2, '2020-08-10 05:45:33', NULL),
(4, 'FEATURE CCC', 'CC', 1, '2020-08-10 06:11:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nsmart_plans`
--

CREATE TABLE `nsmart_plans` (
  `nsmart_plans_id` int(11) NOT NULL,
  `plan_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `plan_description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` float(11,2) NOT NULL,
  `discount` float(11,2) NOT NULL,
  `discount_type` smallint(2) NOT NULL,
  `status` smallint(2) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nsmart_plans`
--

INSERT INTO `nsmart_plans` (`nsmart_plans_id`, `plan_name`, `plan_description`, `price`, `discount`, `discount_type`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Simple Start', 'Simple Start', 24.00, 19.00, 0, 1, '2020-08-11 08:19:40', NULL),
(2, 'Essential', 'Essential', 99.00, 84.00, 1, 1, '2020-08-11 08:20:00', NULL),
(3, 'Plus', 'Plus', 100.00, 90.00, 1, 1, '2020-08-11 08:20:28', NULL),
(4, 'PremierPro', 'PremierPro', 100.00, 90.00, 1, 1, '2020-09-15 02:40:47', '2020-09-15 03:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `nsmart_plans_has_modules`
--

CREATE TABLE `nsmart_plans_has_modules` (
  `nsmart_plans_id` int(11) NOT NULL,
  `nsmart_feature_id` int(11) NOT NULL,
  `plan_heading_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nsmart_plans_has_modules`
--

INSERT INTO `nsmart_plans_has_modules` (`nsmart_plans_id`, `nsmart_feature_id`, `plan_heading_id`) VALUES
(1, 2, 1),
(1, 3, 2),
(1, 4, 1),
(2, 2, 1),
(2, 3, 2),
(2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`access_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
('62af2a28b725c647991e3d6490611826a07cc36a', 'admintom_admin', 'support@nsmartrac.com', '2020-07-07 02:12:07', NULL),
('808f6edc917389392120f859d5ef6462ff46184e', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 06:57:35', NULL),
('29fd9cb9e0fdbca02919aa2a7a317d04252afa6d', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 08:57:34', NULL),
('4f88dd82479114821adf9fa80456a9e9305b5d50', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 09:09:01', NULL),
('4e0eb08d6b4eb3e2546b2317ed7d7827145e9e06', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 09:12:45', NULL),
('b6ee005d3151c5ac46ac573dbef7fd703938f08f', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 09:28:09', NULL),
('88e44f4be39772eefec7ab1f36d7a98c1bdd6267', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 09:42:02', NULL),
('6eec5a51650622870888d6e531bd2be6418ff570', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 10:16:57', NULL),
('a9351f8bfb1d0d94b1147af26cb162888f7b31c1', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 11:26:00', NULL),
('c87a18479657fa325c2b3c2ba134c6fb5af27e4f', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 12:37:42', NULL),
('97d6bf63cd4759a3a230937a4315a86cb642b7d9', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 12:42:47', NULL),
('c206c5d85d362ca64072e91d2ad6c75cddc4fa05', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 12:44:06', NULL),
('45597c96950a83119430bcf5a33bb2e9bae742b9', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 12:51:18', NULL),
('80089b21be18b1cdd563d751a9e57fd892d8eadf', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 12:53:57', NULL),
('0362c19d7f431590427b59f0356103087074e9bb', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 15:16:37', NULL),
('fb13e910501bb1e932f8aef9701b0fa58bbd6501', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 15:43:00', NULL),
('4c516313ec2cf8e8005e8ed5a67f4bb656306c5f', 'admintom_admin', 'support@nsmartrac.com', '2020-07-22 09:37:56', NULL),
('eba51431c1bb2c98a0c8542697ba91e9c097ea88', 'admintom_admin', 'support@nsmartrac.com', '2020-07-22 12:50:28', NULL),
('60e1fc3bf12eb99837df7f42cf293a4ed6322d2e', 'admintom_admin', 'support@nsmartrac.com', '2020-07-22 13:42:21', NULL),
('9d5524a0685303e69cd4559f4b6225ce52dac962', 'admintom_admin', 'support@nsmartrac.com', '2020-07-22 13:54:31', NULL),
('bf328ca6c33aadd49a5b963a8d48c98d5cf7a32a', 'admintom_admin', 'support@nsmartrac.com', '2020-07-22 14:01:12', NULL),
('e68fa7041a92c8c6705848c97e07be12888d6042', 'admintom_admin', 'support@nsmartrac.com', '2020-07-22 23:54:09', NULL),
('973b551aebc6823c64e26929b2721fbdef77e1e4', 'admintom_admin', 'support@nsmartrac.com', '2020-07-23 02:21:48', NULL),
('a73a3a4bbda272c5dc322189f966846f529b94bb', 'admintom_admin', 'support@nsmartrac.com', '2020-07-23 07:21:56', NULL),
('322b9eab37f9fe73177942dd2f77d2f87c62de50', 'admintom_admin', 'support@nsmartrac.com', '2020-07-23 08:43:22', NULL),
('fbde5c21276806bcaf92fc6af93f0a1f8b91fd33', 'admintom_admin', 'support@nsmartrac.com', '2020-07-23 09:08:30', NULL),
('7cfa3fd7655288972563f0f46b5349254d36c00d', 'admintom_admin', 'support@nsmartrac.com', '2020-07-23 09:58:46', NULL),
('7c5a5fb6be06bb1b29c9ee1ea14b93121a0873ca', 'admintom_admin', 'support@nsmartrac.com', '2020-07-24 04:57:45', NULL),
('42d3e8acc072ba294fade84e555a7d53917b1864', 'admintom_admin', 'support@nsmartrac.com', '2020-07-24 11:13:40', NULL),
('128484db4b1103a8ab0c3da1ab46e1ff51533a60', 'admintom_admin', 'support@nsmartrac.com', '2020-07-24 12:26:09', NULL),
('f06845563ee4102f48ca96a0366f7d53212b0f55', 'admintom_admin', 'support@nsmartrac.com', '2020-07-24 12:33:43', NULL),
('2c441268ea1dac8406699cfb448d2cce956599d2', 'admintom_admin', 'support@nsmartrac.com', '2020-07-24 12:44:10', NULL),
('7741998b89ba09fb2eb94bc539722d3cfba04072', 'admintom_admin', 'support@nsmartrac.com', '2020-07-24 12:45:19', NULL),
('baec7b8b7d9640a67cb79fb0ec46087622f06757', 'admintom_admin', 'support@nsmartrac.com', '2020-07-24 12:48:03', NULL),
('4b2342fef7eabc836d54c339699537ff9c10c03f', 'admintom_admin', 'support@nsmartrac.com', '2020-07-24 13:46:29', NULL),
('606e2715fbb9fce82d6bc6d0af44ae1def11ffb5', 'admintom_admin', 'support@nsmartrac.com', '2020-07-25 12:10:04', NULL),
('d2f7c8d5598e04c584a30decf62d726ba7ac033f', 'admintom_admin', 'support@nsmartrac.com', '2020-07-25 12:11:27', NULL),
('eadb1b6c6e0f3466e60490beb160684a3051bc20', 'admintom_admin', 'support@nsmartrac.com', '2020-07-25 12:12:08', NULL),
('f21ba7c1893db502cb3026ced0695cd96f85f098', 'admintom_admin', 'support@nsmartrac.com', '2020-07-25 13:21:30', NULL),
('46db8e36a297a18fd6d0ea46956ba383845c0226', 'admintom_admin', 'support@nsmartrac.com', '2020-07-26 02:25:58', NULL),
('7eb0f9f764c4918f13a2a9771c3c90b33de3fb5c', 'admintom_admin', 'support@nsmartrac.com', '2020-07-26 09:48:19', NULL),
('8258a21f4acc5a976d1f9f55c9725fcf43c9fe59', 'admintom_admin', 'support@nsmartrac.com', '2020-07-26 14:08:59', NULL),
('fb5672a409dc86397da7ff75517440f4f18d6cd4', 'admintom_admin', 'support@nsmartrac.com', '2020-07-26 14:13:47', NULL),
('fa458bd17c1f31fe9921f1de438c60474fc19d0e', 'admintom_admin', 'support@nsmartrac.com', '2020-07-26 19:01:16', NULL),
('89a4c1371905410c7c84987d670beb4541a660c5', 'admintom_admin', 'support@nsmartrac.com', '2020-07-27 02:11:36', NULL),
('a2bc6dbaf091a455c339a4859cc9436b784a65ad', 'admintom_admin', 'support@nsmartrac.com', '2020-07-27 02:54:20', NULL),
('6d563c75632d566dba82327ddd4b78c6a623330e', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 02:16:06', NULL),
('e2d36241231f55ea67c6edc3bbb3f7d57c00a501', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 02:16:29', NULL),
('052d1a077549994f2b487e79d86e40b77ab15974', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 02:17:37', NULL),
('f4afaf23d3134bac586f32296c123a507e751990', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 02:28:55', NULL),
('9b66342e0da62440a455f56c5854b68861944637', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 05:29:16', NULL),
('0092c9da95a312952e945eacdbf26a5db4a07478', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 05:47:38', NULL),
('10d072a1935cf3cf37c0d462d04e05ccd7e13158', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 05:51:24', NULL),
('e7a34cbc8fa80deede76a423ca6043bed4221ce9', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 07:01:57', NULL),
('b06d4d9232ba0905dacfa298327fd318b169323b', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 07:12:11', NULL),
('ab9f3998ba7b0a1bac22794b109eeaf9d751dc8b', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 07:14:38', NULL),
('834a9d7e943f1a8935aff78ca0ab243dfddc5991', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 09:12:59', NULL),
('3e6d6120b4715129eefeb75bf3263dc4208e8e40', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 09:21:59', NULL),
('89730678c32e47ee4bbf89a8d604cd0772b33b3d', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 09:56:58', NULL),
('a320cf2597d8495b30295b47907558b3fcb8d293', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 10:17:30', NULL),
('b8c968a237c351f14ad0203fa8d1ae7c378959ea', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 10:49:18', NULL),
('15eac3039a5bb48adcb4ca44d46468d77583c85c', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 11:20:11', NULL),
('9c06b08170db4a76a7ce8e0216a6a4f0d21ea3ea', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 11:21:53', NULL),
('07001743c58c267622094a6e6fc829cc0adf401a', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 11:32:36', NULL),
('cecd137989b8f05052a6db9086b38ccb94fbbc90', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 11:38:14', NULL),
('30e47d3b709970445aa12a706c2af8a09b7216d7', 'admintom_admin', 'support@nsmartrac.com', '2020-07-28 11:42:56', NULL),
('73e00e85c70a9dde76a008268217d0918558b1f9', 'admintom_admin', 'support@nsmartrac.com', '2020-07-29 03:38:48', NULL),
('94e15f8e312ac66992dd8ad4655d75e23ce4b6c5', 'admintom_admin', 'support@nsmartrac.com', '2020-07-29 07:54:12', NULL),
('607759b7aedb7558c3130e4cb5d09724472723e3', 'admintom_admin', 'support@nsmartrac.com', '2020-07-29 11:37:44', NULL),
('b0336ae2f0f4846ce8f3cf34456614cb732ba070', 'admintom_admin', 'support@nsmartrac.com', '2020-07-29 11:52:51', NULL),
('e124fcb37bf021733af9bf5dce857c9ce904c330', 'admintom_admin', 'support@nsmartrac.com', '2020-07-29 11:54:34', NULL),
('3f4c2c2324cadc9d9cd8cca823f5dc37436429df', 'admintom_admin', 'support@nsmartrac.com', '2020-07-29 11:56:35', NULL),
('04d9590a205de4f57ecee14ca153982cfbde03f5', 'admintom_admin', 'support@nsmartrac.com', '2020-07-29 11:56:58', NULL),
('a476c9ded40060487986169ec73c4766f4dff652', 'admintom_admin', 'support@nsmartrac.com', '2020-07-29 12:02:15', NULL),
('ebd0fa720588324bfb54dc3a30dc3993d57c9db4', 'admintom_admin', 'support@nsmartrac.com', '2020-07-29 12:10:08', NULL),
('00ef9e05ef1afed254648e89b10fa9f8f2796072', 'admintom_admin', 'support@nsmartrac.com', '2020-07-29 12:13:45', NULL),
('342a646d2a724b2c9d583182cc1228768243edfe', 'admintom_admin', 'support@nsmartrac.com', '2020-07-29 13:45:21', NULL),
('66e53aa679a8c153ba09aaada21cace334bceeca', 'admintom_admin', 'support@nsmartrac.com', '2020-07-30 10:49:17', NULL),
('c08e201206fa527f9da488260995a657963d6480', 'admintom_admin', 'support@nsmartrac.com', '2020-07-31 08:22:44', NULL),
('98197c57b9d61c3430995cbabfb27cfd64843d7b', 'admintom_admin', 'support@nsmartrac.com', '2020-07-31 08:52:58', NULL),
('7b5b82f1d613c28bbb20159c27fff127b99915e7', 'admintom_admin', 'support@nsmartrac.com', '2020-07-31 12:54:18', NULL),
('87a0b2e5bb65780350ab5f8b6b0b60169b46a478', 'admintom_admin', 'support@nsmartrac.com', '2020-07-31 12:55:13', NULL),
('4aed8c413e5dc1e7fd90f6b72ccd6397bff584f9', 'admintom_admin', 'support@nsmartrac.com', '2020-07-31 14:46:04', NULL),
('dfb88c4ed33733c1cadfbe55ab1ab85814c1d647', 'admintom_admin', 'support@nsmartrac.com', '2020-07-31 14:53:10', NULL),
('0176d9975179e091d608b99b11a50811deef1aba', 'admintom_admin', 'support@nsmartrac.com', '2020-07-31 15:31:28', NULL),
('efbeb82744601401b1f57bf7f3b506464322fdf6', 'admintom_admin', 'support@nsmartrac.com', '2020-07-31 15:34:48', NULL),
('f0afbf560379a5c44a6b69fd3277878520eee735', 'admintom_admin', 'support@nsmartrac.com', '2020-07-31 15:36:33', NULL),
('2dca5095f995a36da7f6c1063bc3e53363378287', 'admintom_admin', 'support@nsmartrac.com', '2020-07-31 15:40:57', NULL),
('bb6cd9713253174185cfa6f0bc658c69bbaaa5bf', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 02:04:17', NULL),
('dfab1fa56ff25b54573013c844a3ae58a64a7467', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 06:13:38', NULL),
('3ba743cdee1822b1df749ee7fca04c5ef6bae635', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 09:49:28', NULL),
('1d4011cd0b4d8d839b9737f1d2d90db7925ebcf0', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 09:59:51', NULL),
('dd44fec857c544fcc08d60008e8c385df9865e3a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 10:02:03', NULL),
('fa15e16aaa1b264129ec42d9835a298a02abd8b5', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 10:54:36', NULL),
('6fff1084267c7071de988ca56ba1ce248539e468', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 10:56:25', NULL),
('f46dd2d2588281ce674a4b4f091c2b1b66c4b44a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 10:57:54', NULL),
('4965d5faa483a82d488f6ffae0c76074d2dfc94d', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 11:05:30', NULL),
('c0decf29381ad9ef25289980b1ec1bc2714c056a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 11:15:43', NULL),
('7a6eb85050ad45b67c87c1fcff13b9f23aacd258', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 11:27:36', NULL),
('1120f26d6d3856cdf0bf47c16c8b1af03586b728', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 11:45:54', NULL),
('1ee252905b7f5fb246235d9814db61cd0f47e447', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 13:34:13', NULL),
('31f3923c0a4d87026d128cd1ea81e934e8f17bfa', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 13:59:01', NULL),
('bdac1d7e656e9e4ce6d84fda1e0e812af2891368', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 14:22:55', NULL),
('f14718f85f1fd3c1a91a48e63a0f8ad1fee57936', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 14:28:19', NULL),
('af12aaedda700225d0291710b0a506cd453349c9', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 14:40:04', NULL),
('9d700b6cf3a004902060e3a253e692fd0d2b20e0', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 14:42:42', NULL),
('d3e023f530d0bcf38292900abb6214a3803c1fe7', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 15:21:01', NULL),
('1e3f4bb8c9109d3a7fd24e73b8b7bc53dc9c119f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 15:22:12', NULL),
('c6ba04d4d6a5008458ce2dfd41e718c264059e15', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 15:23:59', NULL),
('3060af01a17df79187591ea37c753a97e839dbcd', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 15:42:29', NULL),
('f2b224c6e9f2e7c446295f54f6ce13d5525d2509', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 15:44:34', NULL),
('55610263b142883dec10cd58eb1583ce2005809d', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 15:48:17', NULL),
('42447aebcc86330ab87580061f7a5e84c93b2de1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 15:54:51', NULL),
('250478d4770a9d0be04fc3f46f44094bc6537845', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 15:55:36', NULL),
('a542991f51b60b59f45f991c66d719468372e0dd', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 16:57:46', NULL),
('85bb784fe351d1972d9dab5d3ca199de5c2a944a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 17:17:47', NULL),
('c22c53e352e845dc5eca6f22798e6dc71a5fafe1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-01 17:18:09', NULL),
('afd8347e717a56eae1c155d16ff1abe920f65832', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 01:50:21', NULL),
('2316d5c4ed12fea2b2f4efb518d5efc04b2e41c2', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 01:55:21', NULL),
('250f6a7562d48949169b0e725c781233c15b196f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 03:13:33', NULL),
('bf9c87b9bbe34e6d7d91a2588721ecc5ee8d053d', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 03:22:31', NULL),
('45a7c1bb62aa91ce22bb7adb19cebc0c0d345c1e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 03:59:17', NULL),
('03ae428fdee31396b172f8978d270821ee7b590c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 05:38:59', NULL),
('7dbf7395298fe07cb84fd05ad419d6a7f3b2cd8b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 06:10:25', NULL),
('82a48ede1891df985780f4ddb4614bd9b6dfd423', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 06:25:10', NULL),
('80c0dcb37a55b4870a9e62de46d51bcf88e79a42', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 06:36:52', NULL),
('a3bb7d228ec180ad70ce48881c0dd1fab3773434', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 06:44:24', NULL),
('839952f0a2c96c445ec3587a5c84b24a7e30533c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 06:47:22', NULL),
('44914bf24a7150708ca801d909133ebfbcc23dfe', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 06:50:32', NULL),
('a005e95286bf65a90f76ac94a30ccb00c4969f48', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 09:09:45', NULL),
('754136c1d63c507506bd84669b3cda75da9b7265', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 10:08:39', NULL),
('59945b01061a4269604f5c7392ac347bc37e0b4b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 10:20:52', NULL),
('8db0ce1327de7b1fc85ad6d526a090124fce3dcb', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 10:27:18', NULL),
('59fbf2c0344453b1157cb2291e45c3bf56acab97', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 10:33:53', NULL),
('8420ffbe2277d568e2b8e040b8b1458ddf00cc85', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 10:37:54', NULL),
('ad624ead9cd27d97f86bcf08f204cbf6b2850dcc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 11:03:23', NULL),
('c7a85a12a3cbcd70b900492911332880fa3b7d00', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 11:09:29', NULL),
('cd0ed2a8eef54e4ee8f933a23d147a74f5f9154f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 11:13:31', NULL),
('07bd728f8f544b08333c424f1fbcd6fd065551b9', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 11:17:13', NULL),
('eca5b8b9f8d09a8d2e23ea5fe5365f6f8727c724', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 11:19:35', NULL),
('940d22d2b5ad909cb70ab62f075b202368725a0b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 11:24:22', NULL),
('658ac7d20ece1f0a0d86235c58d16a2024abb8e5', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 11:53:47', NULL),
('6d429b25b914f97b309c08b9910a1b8a39df43dd', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 12:16:33', NULL),
('bb86cb03dbd093630030e89cdc92e4c4c34f9501', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 12:17:50', NULL),
('37f037938a0c26350c6c4f4a31ddf075675947cc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 12:20:30', NULL),
('6e63b60f9ebbd927c81bc2e6662807d84a03637d', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 12:34:27', NULL),
('4e772cd2f59fda6ac41b420d703c9de4d0f76783', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 12:48:41', NULL),
('8eeac0f5dbf36c4627ca7030e848d41112a1e74b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 13:14:31', NULL),
('7a9a963a432272074918140233beacb75b98aad1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 13:55:11', NULL),
('bf84d7eb0af5c1fdb986556ad3b34e2e6114c382', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 14:04:37', NULL),
('14f13a09303ef8ba50d8f688f3cc155a5771634f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 14:29:50', NULL),
('dfb7ea6d30de60db9f009dd3b4992c338ae4f6f7', 'admintom_admin', 'support@nsmartrac.com', '2020-08-02 19:33:05', NULL),
('bc1755f9832a576911874eeecb78c59e55b5f181', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 00:11:17', NULL),
('d7f98965b40d92b7c1bf9a34c6a9a2c038989b41', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 03:26:02', NULL),
('517c9ea0528693237726c3ee1693dbd396801b2c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 03:52:29', NULL),
('c5e000d266c66a1532a4ee13758d94a671c88187', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 03:54:59', NULL),
('fa69bb90e13e6c9f44fb16ac8280bb5d46362a85', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 04:00:11', NULL),
('ccc8c918b75a4405bdb5b695203795dc18be656c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 05:12:30', NULL),
('01e3c369620a2c73f8a97ece4512149972c03054', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 05:21:30', NULL),
('ccc82c568c4177dfa934e73a87b2a872709fa93a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 05:26:08', NULL),
('984478d66c57b390f95ce24e959b010029a59c21', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 05:40:23', NULL),
('0890d3f31f59ac72ad1a7853158c9c3934f67c38', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 05:41:00', NULL),
('10bbc5186436466218e74afc4ac7c7fd03744a4b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 11:05:43', NULL),
('c8e07115a18948f3ab0842f485ebf4b4ca6703cc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 12:01:24', NULL),
('7a3a42962945f6cdda80e0b5dfa357d68f71f000', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 12:27:15', NULL),
('016c9c30e5498b244c59b83d68cf136cbdcc8173', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 12:29:46', NULL),
('0bebcbfeeab0089fb27316380c1376a5e897faab', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 12:30:35', NULL),
('7517486da8cdc64336021f3cc7bb6f036b6ed6a8', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 12:31:47', NULL),
('059ff06fca50a57ba4b10dbf7818b77c875ac6d1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 14:36:44', NULL),
('8cf73e45ceba952322ae8ff169a76d318659e604', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 14:42:25', NULL),
('c34db56d1cff2497c79c218f113aa8285f801db7', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 14:45:11', NULL),
('6857bc2a927fa3c24e45da3a78db380f7f6686bc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-03 19:33:09', NULL),
('0285031b85bb6f3f4fa3f11b725bcf91612b7140', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 01:19:06', NULL),
('e1d4a08058639b1dbaf27159cadee771a87009d1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 01:20:49', NULL),
('a6c63aa025e3574bd400c57d972d9c2fe2721ae4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 01:47:00', NULL),
('195ffc22d97ecf7b8d8cf9600b6f326a3621a92f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 04:39:00', NULL),
('d304cce2f707a6474371418e01a93edf124c9041', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 05:22:00', NULL),
('2dc414a5c41065e56d643cbce184bb81fb19c49f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 05:25:06', NULL),
('1a091cd633a5af9e6332d654c42354fe299ffe66', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 05:25:52', NULL),
('6094ee386821cb8518ccd581958cfea1b09ff6d6', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 05:27:20', NULL),
('02947d59ae529ead6a851b21e297b0dd7a29a504', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 11:36:45', NULL),
('a8db4d27a8212c8ce804a75e0672c02ff44ef5ec', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 11:52:09', NULL),
('fb0294e6c0eda100c7995479327076fa772fd4cc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 11:53:21', NULL),
('9fc38df94a6d510a0721c9f558bfd7a0d36ae120', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 12:19:52', NULL),
('7dda5f5c5c736b9bd57391b6d1474a910005bbc1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 12:22:43', NULL),
('5a7fb4b22a091f4107b9b50ad8d13bb2bf9e76e9', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 12:25:16', NULL),
('c265a7c745fe394c83736e993316cb2e6aed1d6a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 13:01:06', NULL),
('f2be19c298d0ac2c8cb1794133723feca8771e8c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 13:17:35', NULL),
('d3406b57d687e848ef9fe12703c372f8bf5331c8', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 14:00:19', NULL),
('4d794ea258bff147e11078969bb2065ffe40cefd', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 14:07:31', NULL),
('136be5b090109458ed4b78176e7b5f9b2dd6146a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 14:31:57', NULL),
('d7b16ff9ca90f6b8bb0c1db63701bea016a2616c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 15:20:30', NULL),
('826ef40996c857f311162b778547b7e537df3482', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 15:25:47', NULL),
('a5a1656200bf1d8e8327ad516276cb906b0f0d55', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 00:31:53', NULL),
('2e323c9657b198bce1d54b2df6a4ffad726eac76', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 00:32:02', NULL),
('8896913b9bc6be3d032f5029fa810c07c3820999', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 03:44:42', NULL),
('e09ec0f705445455df3334c5ea1b008bd0c0e62a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 07:20:03', NULL),
('9bc71f9377ff3836e0d1975fd26e60a06f73626d', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 10:52:58', NULL),
('8db5143aa1a917aa106d78a81254ff4eb9c4ecf2', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 11:03:11', NULL),
('8cddc71be998ea269d29ad98233cc323a7c902b1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 11:05:39', NULL),
('3f5ac90a97aa00248f1255883ecdab4a3bbe4d53', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 11:10:26', NULL),
('c82422cf6e05c1b745ab614aac0d032d486f086d', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 11:11:37', NULL),
('b05c19acfa60c60fac69a4556ac34efc827e6b68', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 11:15:16', NULL),
('57dd93fafdf91105531d092551933472a79dd9cd', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 11:27:16', NULL),
('9c472d656e60bc51a84f68dc427c764ecc8d68d4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 00:23:27', NULL),
('90cbb908cb24342213595da940d951f01ae4c698', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 04:47:33', NULL),
('bf4517e3cafe5035ff4b669ff3b7ff34b4e05e1a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 13:30:44', NULL),
('1591bbe6465528cde95afb74462dec78faf74118', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 15:06:51', NULL),
('a6b8003d611459e994b4e5beb6af3cb47a067fb6', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 15:25:33', NULL),
('d0edb69e2a6b0a2c6d327909eeb9493bf8d78555', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 15:35:24', NULL),
('a6d819910e8b4d3cf031ba6a64632552611aa114', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 15:39:12', NULL),
('0e868a7ff4942ec8e4a7149b5da6e19351d8b699', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 15:42:31', NULL),
('6f6e9872cdd64ec9c06f053da33e8dbabc690d30', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 15:43:59', NULL),
('d000aa36964f04aa06ea27e69bd68a6c48c19c54', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 15:44:51', NULL),
('d69e464011cc90f4a6d40df6333ce52f0d097cbc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 15:45:42', NULL),
('f8149162d6317c4af201ee38e5ab55dac8fd3fe8', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 15:46:22', NULL),
('1ffc0a9b185c743ea558bfb5148ae087e284d2ee', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 16:04:12', NULL),
('6917dd79365357f7c0cfd763c9a571358e076ed4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 16:07:21', NULL),
('840c1635bfd56d60d4b952fbe380c0bcf06c7ea1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 16:14:00', NULL),
('47f44f46a49cdf783e3f1643b7f3e3610c8fd08b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 19:14:08', NULL),
('9116655c9bef36ed0daa5727532f0463e917b969', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 19:17:33', NULL),
('5e03b3fec1db1be64ad28fe0a0680f9747b19561', 'admintom_admin', 'support@nsmartrac.com', '2020-08-07 03:56:11', NULL),
('3b05c8c2b7c1b8196b3afde64f81e8ec628f09d5', 'admintom_admin', 'support@nsmartrac.com', '2020-08-07 11:59:35', NULL),
('e53f1c992d9a088e4ea8323fbe0997d2b4d92c63', 'admintom_admin', 'support@nsmartrac.com', '2020-08-07 14:37:46', NULL),
('b42262ffd9b81def7c4209f757380203dcb7aa1b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-07 20:35:31', NULL),
('eb05553cfc5ce4dd9fdd57118030fe3dc0508c08', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 04:18:52', NULL),
('4e7daeae9d0b04f3b6f46c7fbe9e44e85718b3ec', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 04:35:57', NULL),
('705433b607a4eb5dfb9d865d42a13d4d60fc6f5a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 04:51:21', NULL),
('8a922a952cf8ebeb19b1b8e65474ae38141af24e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 04:52:31', NULL),
('700d33e7e0b00f4e277afa750f9c1ec4600eeff7', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 04:54:46', NULL),
('c3aa7fee5d89a6ba3912751a77a2a2b1eb853a0a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 04:55:55', NULL),
('59e58c6f9c3fc9d850150547fa59b91e1aba3583', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 10:19:18', NULL),
('388a8dd64005b8fa90c7831686cafe6b4112de79', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 11:47:42', NULL),
('21c6812068956b2ec40ada73a09bbc19fd899da3', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 12:11:29', NULL),
('996385c06a9df1381c505614ece9c4e74f64db40', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 12:18:21', NULL),
('f8581a274aefc0d00f953bf5c59d552b41e058e0', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 12:25:10', NULL),
('2a2c099ebb87a50ce440ab7ef1d7ef56b631da21', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 12:32:42', NULL),
('15abea10255bb22041a6f06fbb33204d6cab2c65', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 13:25:13', NULL),
('887ea39898b31bd068fcf6952f44a00cfceda793', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 13:26:51', NULL),
('4b433e71c92438ea1be4604229a1176f8411c050', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 13:32:28', NULL),
('89ae32d1ca6fdb4fe925bca874c4f3c774e8b9cd', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 13:34:32', NULL),
('84e9abf872f89ea65d1ceb7114423bd23bfb47fc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 13:35:59', NULL),
('4ad282ea1facbeede44d27ecc9a5210bd15a98e3', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 13:49:41', NULL),
('efeb0709921ae8885ddc7f5695638f86b41fe527', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 13:52:20', NULL),
('009eafcb1cba780e35905eafd03cbcb02cf75a27', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 14:42:06', NULL),
('7475846e896ebff107c284037b733b2b72be5569', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 15:00:34', NULL),
('192fb4507b8fc0488cdbc50fbae1a7f824929518', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 15:03:36', NULL),
('1b131a07c78946a8bb6152ed32c1af2e13b5af85', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 15:40:11', NULL),
('3bc3ca453ebb1ed8aeac25fb51ceb108660b0a04', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 15:50:52', NULL),
('2aa61f4b40fb6c851e5f0b087f56346e5ca31b21', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 20:14:51', NULL),
('ed2f9c6e822eb58ca93f8dfe61363b84f9bcfcab', 'admintom_admin', 'support@nsmartrac.com', '2020-08-09 19:54:58', NULL),
('8f94526cbc43ed4fb4406660332857f55b25e971', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 11:55:13', NULL),
('edddf2c4bc10f916987a344a6d02dc693e54568d', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 12:08:38', NULL),
('8f12937e96add9f4edb29ba112bfb107fb7f25ba', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 12:10:01', NULL),
('bcba809eb8d4797f5168e8ce88d0b5740cccf000', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 12:40:57', NULL),
('f89a68d246f3b1022178217e9606ad2057ecc0b7', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 12:44:30', NULL),
('651abbe51c432a1d601907f90b8b1a032d83bc8e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 13:02:00', NULL),
('d1fd16179ccfc5fd833c9871daafdd80df9a9305', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 13:17:25', NULL),
('2439c2452e78797dd8db625c61c828e7562be859', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 13:24:33', NULL),
('6a514aa48ae6247d839333f376a43e19abb43168', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 13:27:28', NULL),
('d5c48a3ac17fb290051de789ff4e2ed2db07a9f2', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 13:36:47', NULL),
('40e41f8404c7db70543dcf1dbf679a10f8ae259e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 13:49:58', NULL),
('581673d44c9dd3dc50124c90ddfc58ffcd7d6387', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 13:51:27', NULL),
('c228306eb24267f75d6819fe55e617217f65ebd9', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 02:26:47', NULL),
('84aee4f3d4e62bff0c1939d48cfe6620d51ec926', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 02:42:20', NULL),
('aff0fc1e2c00016933dc04db30cf8ef08de8a474', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 02:45:46', NULL),
('a513b919bf3fc240e71fd757d172d9d8c617a18f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 02:48:14', NULL),
('3164728c300ff782b036859a7f2fab2a41b7b0f8', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 02:49:42', NULL),
('ca207112069ca83b64fac6e5bd76983f6528cbd0', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 03:00:54', NULL),
('a411d5145c0acdc482f7b882b248894b7461df16', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 03:20:51', NULL),
('a9a0385e8ca1a17fab4a2dec607a5c33764d9219', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 03:22:00', NULL),
('db6fc1bdfe20357429acd0f7a8cf1cbaa8f455c2', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 12:13:54', NULL),
('1813a4170540c32abc445457dfa1a1501a83bf54', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 13:55:12', NULL),
('24f4947b230ce3770c79bdbd21129090eb19a586', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 15:01:18', NULL),
('8325de483ab0afd655de63f443ab6cf6b48f5595', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 15:03:22', NULL),
('b6675b541e43a2e19c5fff900db4d2537e59eeb8', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 15:05:40', NULL),
('e97d925773c665032a6a981eef853bd087075af5', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 08:06:24', NULL),
('89470857f6d001568a97f96c07eec392aa04008c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 08:26:11', NULL),
('c0852a48e4bdc2c607b811c3b4fce89e0523d124', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 12:37:40', NULL),
('351cfdf90ae2745ad1f8f76b461bd302e35ffbbe', 'admintom_admin', 'support@nsmartrac.com', '2020-08-23 05:42:20', NULL),
('624cb63fbdc1b4ff1bd4fbbae434d7f211d53265', 'admintom_admin', 'support@nsmartrac.com', '2020-08-23 05:45:10', NULL),
('bdd514af999f80b403c22d57c59d41ccf7842110', 'admintom_admin', 'support@nsmartrac.com', '2020-08-23 05:50:33', NULL),
('5d2e4550388b9a3fcbd8f11d20bec0aeec6b200b', 'admintom_admin', 'support@nsmartrac.com', '2020-09-17 14:27:15', NULL),
('cf92057033efc23cf0c16a85ecb44f25620cf0b6', 'admintom_admin', 'support@nsmartrac.com', '2020-09-17 14:28:47', NULL),
('dd9b48ba7fa5cb058663a542561de4dfa41a4d0d', 'admintom_admin', 'support@nsmartrac.com', '2020-09-21 09:59:36', NULL),
('8951449134af47e30b15edd1d8b20387308ee532', 'admintom_admin', 'support@nsmartrac.com', '2020-09-21 10:33:38', NULL),
('7eb4c440688c0a3bf1d3fad026fdda07f5da469c', 'admintom_admin', 'support@nsmartrac.com', '2020-09-21 10:43:08', NULL),
('ff1527dda28595de800c047abee8794233fcfcf3', 'admintom_admin', 'support@nsmartrac.com', '2020-09-22 15:26:57', NULL),
('7f703fc57c7f344b0182b78d829b1a88e6d1fd7e', 'admintom_admin', 'support@nsmartrac.com', '2020-10-04 19:37:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_authorization_codes`
--

CREATE TABLE `oauth_authorization_codes` (
  `authorization_code` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect_uri` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_token` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `client_id` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `client_secret` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect_uri` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grant_types` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scope` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`client_id`, `client_secret`, `redirect_uri`, `grant_types`, `scope`, `user_id`) VALUES
('admintom_admin', 'nSmarTrac1', NULL, 'password', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_jwt`
--

CREATE TABLE `oauth_jwt` (
  `client_id` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_key` varchar(2000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`refresh_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
('23e7ab91e370940588ee2d1e310d8370f99d3fcb', 'admintom_admin', 'support@nsmartrac.com', '2020-07-21 02:12:07', NULL),
('db3207f493e3b5c44183d988931ee4a19b61bc7b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 06:57:35', NULL),
('613302e4ade08285f94a288d73d2192b898938a6', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 08:57:34', NULL),
('2247c275864e0db41178f8626eaee12e70825dab', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 09:09:01', NULL),
('61608e6e25e5fe860a38b260bfeb037c2906ee02', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 09:12:45', NULL),
('68d533cd98f6e7f07a7c7508d63ad4ffa1683758', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 09:28:09', NULL),
('37132388629e1c4cc2a3ad887d494a3b837c8228', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 09:42:02', NULL),
('6633bbd3a0bc42a4a0f60a5818bb5706fa349068', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 10:16:57', NULL),
('bfc187d675600071fa414ff4743274732353e29b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 11:26:00', NULL),
('8de6c43bfbea1391b97a5dcf80d1c1af9303b56b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 12:37:42', NULL),
('2a10ebdd9b5be938a450efe50e7717662944719a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 12:42:47', NULL),
('189e0e625fbf2f3e41995e6e995fb27cdbc19e67', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 12:44:06', NULL),
('9ea3787ab643daaff9665343601aa9a9d8310349', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 12:51:18', NULL),
('bef38da24399f2ca4c33767902d6043778ec141f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 12:53:57', NULL),
('104d017efe1016569cb7a0fc8e252f3070e8f4a0', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 15:16:37', NULL),
('f78bc698e7476e711717a592049f70efddca3966', 'admintom_admin', 'support@nsmartrac.com', '2020-08-04 15:43:00', NULL),
('8cd4281cc2e19c8571af82900945caec2ab4cb11', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 09:37:56', NULL),
('5751b3a9cea5510373f1a950a9058ed08fda7110', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 12:50:28', NULL),
('eab151c711de599cdd3236148659ce509c92b67e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 13:42:21', NULL),
('cf85d93f3b61ae5616193391ee723d7a06130021', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 13:54:31', NULL),
('fdc1cc87054a5f51682f6f2648d09cc4928be318', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 14:01:12', NULL),
('e247a4efb85add42f3314a26c197e67ae5057401', 'admintom_admin', 'support@nsmartrac.com', '2020-08-05 23:54:09', NULL),
('68c8179ff82d423f6b19924629273827152a024a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 02:21:48', NULL),
('34b43441bd95c29478543ecbc16b7a4d7de85266', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 07:21:56', NULL),
('8aa847777bcec794b61c1d55f0fb74da12f9e919', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 08:43:22', NULL),
('82d215bbb5a6afd98046d46e67b16ba481ce1560', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 09:08:30', NULL),
('8e448c25da97b8bad7d02239b61638c8bd2590a0', 'admintom_admin', 'support@nsmartrac.com', '2020-08-06 09:58:46', NULL),
('b298ce39e24f0a57b55f7e62d2d6b66d973e3957', 'admintom_admin', 'support@nsmartrac.com', '2020-08-07 04:57:45', NULL),
('1a5c7b71a49e879a3519e2eed91ffc93f2126a43', 'admintom_admin', 'support@nsmartrac.com', '2020-08-07 11:13:40', NULL),
('21e82182822d816fbf93521c919da0fb9da06a1f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-07 12:26:09', NULL),
('f962a64bccf50443e4467f92f5115d738851d96e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-07 12:33:43', NULL),
('268cb26288e1adb4e4abc566e980898a3329e3b0', 'admintom_admin', 'support@nsmartrac.com', '2020-08-07 12:44:10', NULL),
('5636a9144620a679b23a32677c95a9694d2bdc25', 'admintom_admin', 'support@nsmartrac.com', '2020-08-07 12:45:19', NULL),
('db90650e732e4a741550e98303b3dda0c8b66326', 'admintom_admin', 'support@nsmartrac.com', '2020-08-07 12:48:03', NULL),
('dd399cf71edf482e54b00ae412d33012488b30f3', 'admintom_admin', 'support@nsmartrac.com', '2020-08-07 13:46:29', NULL),
('4de6445d99767c8aea9a67ef4801ff6cbc8a11a4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 12:10:04', NULL),
('3b9319401c812b2d68169456bb0ccd9f9fdcb95b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 12:11:27', NULL),
('af6710e2e05ac7e9378d8c2dce5b4f72a4c293e9', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 12:12:08', NULL),
('e61203b49064419cce7e618ca6a0c779a7317e9b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-08 13:21:30', NULL),
('a660c46d1feb494b588c92e088d91ff5f2c1a2c1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-09 02:25:58', NULL),
('527378fa144d623bc9e8b0241ecea703a6489c1c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-09 09:48:19', NULL),
('7689ee48f7ec114d13dc4cd3dbc5c9d30e3468c6', 'admintom_admin', 'support@nsmartrac.com', '2020-08-09 14:08:59', NULL),
('a570fe5d1ca92e6fe010b7a7081c7cbd990ab839', 'admintom_admin', 'support@nsmartrac.com', '2020-08-09 14:13:47', NULL),
('ac38efffbb0364582b3170780f877aaf2667f123', 'admintom_admin', 'support@nsmartrac.com', '2020-08-09 19:01:16', NULL),
('1dcc04fce46cb98d3373513d5770bb82b62b4d6f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 02:11:36', NULL),
('188b87bd4e5d90ae6f4a7e143d5e238aad91bc2b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-10 02:54:20', NULL),
('43ebabae110160331af3a3cad8fbdcf6b9871e5f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 02:16:06', NULL),
('0ea21cfc884f84ac19c494a0ef668b3474ececfd', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 02:16:29', NULL),
('4099f135fa9a1754a655b08ec1e98ac3f1a8e830', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 02:17:37', NULL),
('abffe1ec91d5e18c1a32fda43dae0965b932a715', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 02:28:55', NULL),
('cf045b352c7d3d2e86e0795a505fc4f0821aefe5', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 05:29:16', NULL),
('294cc772c2c0e20fa5dacabc656c6d90961cf937', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 05:47:38', NULL),
('d3fc79093290881fe5769722c14471d1714c43e4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 05:51:24', NULL),
('0340464e1f63db3c7a678fb6e18ddce97ab4a698', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 07:01:57', NULL),
('8155bfa3cbca880147e795329c64dd4cc0851704', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 07:12:11', NULL),
('c6df33c5d284042c1377e33ae8396cbeec8a732f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 07:14:38', NULL),
('cd53f48565665c87711faed3c9b169a9244f0587', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 09:12:59', NULL),
('8b3a80b9440a61af7993971b3804a73f1674109a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 09:21:59', NULL),
('357f4871b60a447e93af2661da5a1e713329cf2b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 09:56:58', NULL),
('4ffcd5d004000564e76d8542f0913de19944977a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 10:17:30', NULL),
('f1f4ccacdb2dd0b03271965419e1657dd314d65a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 10:49:18', NULL),
('7ed15b2f8236e5de5966a3c5fb81284c71e6cd91', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 11:20:11', NULL),
('6d5d577ae2452e1b31de670d52e9ccc936851541', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 11:21:53', NULL),
('b2afc5a0d7884405993f9196059990160725db79', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 11:32:36', NULL),
('0529c3ae1a75c56f892364860dafadd6db60c7cc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 11:38:14', NULL),
('fb2d5d2a1ce073fc2e81b3b8b0e7303e1a2f5331', 'admintom_admin', 'support@nsmartrac.com', '2020-08-11 11:42:56', NULL),
('f23445adca0cfac1f8afc49486c295c089c5c1b8', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 03:38:48', NULL),
('07c37364f59a4270070fc93fceb7fa5115ae8e4c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 07:54:12', NULL),
('06792b5c6d7dd39222f3358c91d4769819f405d9', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 11:37:44', NULL),
('3c33d133ca365b4cbe4a0d933fcbec1dd8b253ef', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 11:52:51', NULL),
('9ac9e5a5dbb0ffa823bb3e8bdc9f86fcca43f150', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 11:54:34', NULL),
('0b35b2bef6bf3ea111a04c46d4e464d6ac301912', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 11:56:35', NULL),
('96c6605a2250791c579fed9c5513789b3304e8be', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 11:56:58', NULL),
('743e0f7179bcbe0113e36a74891b5083865f9a8d', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 12:02:15', NULL),
('44eeb19c3c61d1704580bba41cbb8010769b4f84', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 12:10:08', NULL),
('6b3d171347f4116365ba451d7bb7ce381cbb15c1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 12:13:45', NULL),
('b01414b562ee07f3ca3ea7e33dfcdc6ac3087356', 'admintom_admin', 'support@nsmartrac.com', '2020-08-12 13:45:21', NULL),
('6ab53cf772fec676e889010ad42f7a2b36a91f4f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-13 10:49:18', NULL),
('95db5ab65fd1ab4eb1e6d639e7097b2c1fa03ae8', 'admintom_admin', 'support@nsmartrac.com', '2020-08-14 08:22:44', NULL),
('44d15a62451274b70d67cc42560a145da4377db4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-14 08:52:58', NULL),
('5c2494fc8cd4309cfd87f31cc0dcbee89ef3ef95', 'admintom_admin', 'support@nsmartrac.com', '2020-08-14 12:54:18', NULL),
('f0a0bcb8744c668abda824008ed8d622d7d5fad2', 'admintom_admin', 'support@nsmartrac.com', '2020-08-14 12:55:13', NULL),
('1acca537684a310c39632800c82eb338a2f8aa2a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-14 14:46:04', NULL),
('1fb38302171b958a4bdc7ad45c45f3b81211fbe4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-14 14:53:10', NULL),
('783fc7489f6564dabac2dfdb91bd1ae481bb5af3', 'admintom_admin', 'support@nsmartrac.com', '2020-08-14 15:31:28', NULL),
('fc3558fee8e615df26344cb00c5785984371f79e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-14 15:34:48', NULL),
('b46bbaabedab70a1ea9b72fef223a1c65177fb58', 'admintom_admin', 'support@nsmartrac.com', '2020-08-14 15:36:33', NULL),
('fac31be1773835a46f54a2ab01e9091f0cd61f5e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-14 15:40:57', NULL),
('a9541f38e54801938eb735d2b06caf7a1cb464f7', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 02:04:17', NULL),
('ccae16e332dd83031a25096c9f4ad102dd454280', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 06:13:38', NULL),
('f6daa4aab4081106f45c5f58c404eb5903f5dad0', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 09:49:28', NULL),
('2e5fe08e752ed87edeb29f45a96a8cdec8da4866', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 09:59:51', NULL),
('b40ba9257b5ef21c0a6ff6e940a7e3d29f54b9c4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 10:02:03', NULL),
('2a203b145a8601c8fb84a299a053cd417b390708', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 10:54:36', NULL),
('25a5039f5f50db282521475f5f3da2549e33350c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 10:56:25', NULL),
('ad8eab604fea344a1f773e1bd058fc03cf492716', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 10:57:54', NULL),
('6a82cf92dfbd116639937347730cfb0575ddc4e7', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 11:05:30', NULL),
('0f3866f4ff78ccfe047c4929fa717f871aa3c313', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 11:15:43', NULL),
('2f7b51e4404ff1e6d6afe15d2cf1cedb20612daf', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 11:27:36', NULL),
('836590d4a3bfc72faf55bb555cea79f6fdaffed6', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 11:45:54', NULL),
('e80e6708ed36ffb01993ce53deba954d26ec91d6', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 13:34:13', NULL),
('3e8e3f4ba2742028e3e4b759fb38a20c788a3720', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 13:59:01', NULL),
('799299596464a039a9cd510c1cf85fedac71da9b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 14:22:55', NULL),
('30660b3d1c981975f6e99938739fe95b12a6e7cc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 14:28:19', NULL),
('3de09eb5c9eb0ea23ed9887b4e2c24b27783ce66', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 14:40:04', NULL),
('3b3bd992e9cee8b1df275976af9653da1875cc5e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 14:42:42', NULL),
('23bfeec0dbb9d6306e21fb445531c14ac7970e3a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 15:21:01', NULL),
('c6b99d2a5e3a4db30451331e6b2f7da21c699355', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 15:22:12', NULL),
('7e3d555b35b0f1d1055815b1e05de55a56f0a738', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 15:23:59', NULL),
('0ea36efc2831a79e189cace7ce898b0ca6c91615', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 15:42:29', NULL),
('2faefdc99194bfe7d90d1ad7e0bcdf7145045113', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 15:44:34', NULL),
('bdb0e6b1e06c2695274b71e0da62e3b9899ac157', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 15:48:17', NULL),
('52a6bc7b744ce3d50387489065b093189dfa296d', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 15:54:51', NULL),
('39f95d0c960d56c5f70cff583932b4cd052d3bfd', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 15:55:36', NULL),
('42cd7c2a6c834280706d75640fe4fb51bb16ffb6', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 16:57:46', NULL),
('81df0630414b82ee0c5328e8c0ceda52802bc4da', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 17:17:47', NULL),
('83bf40870bef2250a96f80746c3c0053322a8641', 'admintom_admin', 'support@nsmartrac.com', '2020-08-15 17:18:09', NULL),
('d66600d6ee9634ceb4ba51af79f5ef2335e4ee32', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 01:50:21', NULL),
('170b039c9fb4064655a785f5b484dfc1b6fdf0c9', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 01:55:21', NULL),
('f3b9f8c07418015ae719cc7c48ab584f6b1410e2', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 03:13:33', NULL),
('ff4f60da243405f7681a9507142c287d08fb8896', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 03:22:31', NULL),
('b368b6e408856e891a7cd08db15732e14282c9ba', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 03:59:17', NULL),
('4010f1ba2acc8ae69b502b84e879f09596408496', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 05:38:59', NULL),
('1731d038271837120354504a2e6e4cf362b71041', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 06:10:25', NULL),
('ce5129f76ffada82cf1eff2d6c14dd65e07dd1d4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 06:25:10', NULL),
('aad50590a8b3eb2b42fceae2cbca494fd1525b8b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 06:36:52', NULL),
('69a4edb78be82d7ac49e1faefd5c44f21cdbd7b8', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 06:44:24', NULL),
('94acaadc6e6206faffbcccdb0affce09ec6a1f6d', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 06:47:22', NULL),
('f4085d86ef16c1e3f832d8f371ecbe17804f63fc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 06:50:32', NULL),
('8670e79a91950176c96e31468feb6e70a8c99c93', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 09:09:45', NULL),
('8eb16ab4fb36bce60a6a78ba18ab621e6bd0b613', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 10:08:39', NULL),
('50b5a7502b65f350483770de9ac48f9771de1c56', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 10:20:52', NULL),
('ec6720b2f5afa6577a9cbfe0fc6da97370893d70', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 10:27:18', NULL),
('08e9a93cff5d9842366538a15f17b6515c64ce75', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 10:33:53', NULL),
('2e97012fada000361ba542c108c9286de42a69d0', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 10:37:54', NULL),
('7cbed492a6eda868909a640fd85c7e0ba7ae2587', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 11:03:23', NULL),
('f38c4baf451d9011c3f096fd47157f33bc430e18', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 11:09:29', NULL),
('f24b24c61de96e03e24d7cea48467c34e6f7509b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 11:13:31', NULL),
('d5c9a782575c0f3bfeceb6dfd5280666ed3648db', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 11:17:13', NULL),
('3d2ed25f99fb9fb3dbbcf108a3f4a1ab345d4769', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 11:19:35', NULL),
('a2755a0cef277f12704e365f94efd4c1096cc12f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 11:24:22', NULL),
('cf8c35bbbd290391de198d40ed31c8913073c372', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 11:53:47', NULL),
('bc49732bf4cde10bca387e26fe2321eef54fd028', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 12:16:33', NULL),
('5f8d8f240a8e48b80bff39d387ab920c13576240', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 12:17:50', NULL),
('f1991b2ee0f8714f81d931983aa08ea42b558e18', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 12:20:30', NULL),
('c2a75ef6c99b4409f6297b27094d514bf15c8418', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 12:34:27', NULL),
('1c36bc3eaac1522a7e21dda4a044dfb91398faf8', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 12:48:41', NULL),
('b81f5a00713cf328e742efe8e2b43961412c129d', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 13:14:31', NULL),
('e02a2d261ce805b3856712040a7fc8e433ccc254', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 13:55:11', NULL),
('97760b2556eade8f9775da1ee0d6861c6bcbb06a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 14:04:37', NULL),
('b43911e5035eb157724035ff19e32df2449f8140', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 14:29:50', NULL),
('0f54be7484e7c1d7c2e7576f51ce912e943bd653', 'admintom_admin', 'support@nsmartrac.com', '2020-08-16 19:33:05', NULL),
('1f4732cfd3101231d2ed15da637debfa7a49957c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 00:11:17', NULL),
('6b959d94521367d3fefd2650e60ed0b42193ece4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 03:26:02', NULL),
('fb780e24261a1173d00394fb258c77b0c2a9a2ab', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 03:52:29', NULL),
('08e8fab40ae3ddf16096e153ac05ff409283addb', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 03:54:59', NULL),
('c69d0f7817326ab2905b3bbd50b7accba2efcc15', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 04:00:11', NULL),
('bd83c291431e53b945931bb8ba0e0a131afee6e7', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 05:12:30', NULL),
('3bdde3d765dbda954ee12cf3d5c0f902495adb9e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 05:21:30', NULL),
('19ac98ae29c72a9c51d0c03b034ebafaff7bc8b3', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 05:26:08', NULL),
('3296b505bc9ea85036507af2b1a31d555db2e1e4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 05:40:23', NULL),
('7749e5e2cf00054f2047e57698a38633296db155', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 05:41:00', NULL),
('c28cd43f044b8a3f872307930ab05ffc431a8a32', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 11:05:43', NULL),
('1d78a887c0d8ffa3e9e6be142342d614f1851307', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 12:01:24', NULL),
('d5135b422a70e3749d667a2d194e0affc63c8fae', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 12:27:15', NULL),
('1fddcdf1c09608fa81699ce284633719c85f7e39', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 12:29:46', NULL),
('929ed26b681fc3e9250d2c446a6102ff45b064ae', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 12:30:35', NULL),
('19ec79ea9d90398d709c07faee1f76548bfe6145', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 12:31:47', NULL),
('097ddc40eab6329d74fbf114ce164ca23e5e5bd7', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 14:36:44', NULL),
('922c7848819eea5bb2d565f702f8b797be23ed61', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 14:42:25', NULL),
('84b02111164937f176b027d00a63b6862a102c18', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 14:45:11', NULL),
('68d73b9988929a0007146f8fd848420102a7fd01', 'admintom_admin', 'support@nsmartrac.com', '2020-08-17 19:33:09', NULL),
('f5b907a20b1b7fd5950fa44af6b8f3e4489ad60f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 01:19:06', NULL),
('714fd21b5c576eed08fc3f0c7eff02d867d2ddb8', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 01:20:49', NULL),
('8609f0d5159466d7ba2e3fdef95b4d05fa226b91', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 01:47:00', NULL),
('6eacfed3647307a7953f92371ddb7b326fb60221', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 04:39:00', NULL),
('8f5d43187e2229fc00e41e9cfbd1c2484eb3fbe6', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 05:22:00', NULL),
('288963d7a75fae401f40c93230363726b2fafcb3', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 05:25:06', NULL),
('70b7acf1f6b23aed9d3f7af20782e3ca5820043b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 05:25:52', NULL),
('546656c348717fa381b074af4a29cd9dd79aedd8', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 05:27:20', NULL),
('d8401390c1125ed83b59ac38d7118c33129aa41f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 11:36:45', NULL),
('2aa3ab137c8885708057a7b1e64479d0943d1271', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 11:52:09', NULL),
('6c846657de02952399eed0647c1195bde5b0d90c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 11:53:21', NULL),
('80789a2f0b061a7fc9bb94420a4814be3d771da4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 12:19:52', NULL),
('47e41d98660163eb80bc52e25f4dfe1f712e4a3c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 12:22:43', NULL),
('d6f4d4db7f36cbee8c1845218567658095038485', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 12:25:16', NULL),
('a1964d821b63fc063715c0039caf8e14e043428b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 13:01:07', NULL),
('0f08a348aa5d36a2b400c2337c4e734848b9cd73', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 13:17:35', NULL),
('1553a44f3b762ef3dc926ad52405d1951b37598d', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 14:00:19', NULL),
('d2bca39eb6a1314a6120c588b53d49c17d90fbc7', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 14:07:31', NULL),
('948062c8809a32f022cc2eb0bcdfda65540b96ed', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 14:31:57', NULL),
('d0a332c5220969a2564370bca0cd70d390b467b4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 15:20:30', NULL),
('e3613b3b08abaee5e16a980b18f111e56b04bbae', 'admintom_admin', 'support@nsmartrac.com', '2020-08-18 15:25:47', NULL),
('09b817706fc66a37091efb2367b0be45d186bb7e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-19 00:31:53', NULL),
('34e426bab4330f3f6c81110506e4ecbfc1ad2f5e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-19 00:32:02', NULL),
('715d1fc8e95bffb9ecd99253d02f49f69d92adca', 'admintom_admin', 'support@nsmartrac.com', '2020-08-19 03:44:42', NULL),
('549b7affaf0c1697217acc472a5f051795e8ebe1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-19 07:20:03', NULL),
('705d1b93ea4d29f77c0b48d12351741b01f2b1c3', 'admintom_admin', 'support@nsmartrac.com', '2020-08-19 10:52:58', NULL),
('bdace98c02a1f0ca306aa816a3411ef36e10145b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-19 11:03:11', NULL),
('238f394f070aa27735e5f262604a1c1c2cfb5de1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-19 11:05:39', NULL),
('78bc3c9cf47f78492353d509d1a0758372012791', 'admintom_admin', 'support@nsmartrac.com', '2020-08-19 11:10:26', NULL),
('0486a06e7b3883ce8405753da9ff355e673473d0', 'admintom_admin', 'support@nsmartrac.com', '2020-08-19 11:11:37', NULL),
('cecbf094e1301679f41cc7953d692c5e12f12052', 'admintom_admin', 'support@nsmartrac.com', '2020-08-19 11:15:16', NULL),
('1e25fa7a7e8aa639dbbde313e646e95476ef2e6a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-19 11:27:16', NULL),
('0455cea98f1c03504a15a75772fa6815067fe31a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 00:23:27', NULL),
('5e40dd73651ff9901ffda47e3ffc2c6da4ac77bd', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 04:47:33', NULL),
('9ebf17034d2fa2e5952df1216638a51f55b83d48', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 13:30:44', NULL),
('d2571f6dfa306c7bcf090de6864fcd0fa462e456', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 15:06:51', NULL),
('71d5d4739ad00b7bd1ff4bee5d48c6554d4460d7', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 15:25:33', NULL),
('bdc8ced430323b4f542e3d9f48ed8565e7c36156', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 15:35:24', NULL),
('880b147dfe0c43fb567cb98c9ad895fa80dd9a77', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 15:39:12', NULL),
('6e9f179e1170b2a07563ce0722371c11dbd1c62a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 15:42:31', NULL),
('9ac4e28a5f04ce86f7d1939cc0889b5dc0b5b993', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 15:43:59', NULL),
('2b33e9366fb43502df2544394e32c16026e8e314', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 15:44:51', NULL),
('656ec6aa16706c726078a0132230f7755286fd76', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 15:45:42', NULL),
('ef2ea9a0d74854e6c5892b9d62c3243b2a922f32', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 15:46:22', NULL),
('489b390e2ef999ced267aae70e38a2ba2fbb4da1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 16:04:12', NULL),
('05fc6b0e11fe6f425ab1069673b08e7824a98a71', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 16:07:21', NULL),
('10abc7d6d0c7be37683a363f2ec4df0b0e1019e2', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 16:14:00', NULL),
('e58ce8367f92b62d0d3a86ccb29bf3d2cfa4c3fb', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 19:14:08', NULL),
('ff334fd00c808209635469378a20815ec80fe199', 'admintom_admin', 'support@nsmartrac.com', '2020-08-20 19:17:33', NULL),
('5f7f1a3e37ad71ef3014a883a883bac4c773add1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-21 03:56:11', NULL),
('e81852331aa36de746dfda07fcf2f9fe4d4bc30c', 'admintom_admin', 'support@nsmartrac.com', '2020-08-21 11:59:35', NULL),
('751c01aa2b23b1dc470cfed1bc0fe3cc27324133', 'admintom_admin', 'support@nsmartrac.com', '2020-08-21 14:37:46', NULL),
('9f752ec950de914f1931867f7bf7833d8ce164e9', 'admintom_admin', 'support@nsmartrac.com', '2020-08-21 20:35:31', NULL),
('4e4e5e410eb53a1cb2b81fc3cc4b536a53abc058', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 04:18:52', NULL),
('334ae9cec64a3fa531d0d2fa7f1eea5b7cde4614', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 04:35:57', NULL),
('e0eac52e1694cbfa97bc2f5eb5a9a0bbb0a9c3c3', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 04:51:21', NULL),
('2b726911f4d2d488403193df563a383db14966bc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 04:52:31', NULL),
('e6cc2ba859396f757e0a595ee3c325e0770722de', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 04:54:46', NULL),
('bb351988a07fa496bed5d9b3ea59c7eccecb40fc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 04:55:55', NULL),
('bbea802203c9f9995e0ce8c8da3ff92cb824631f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 10:19:18', NULL),
('b30a5fec466731f11a88b435d3d4611abed319e9', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 11:47:42', NULL),
('d7ae664274d4b4c88d8afe361a9368f51df67a22', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 12:11:29', NULL),
('7e6cf20c4abd6976484d6c93ecdef3ceee201a63', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 12:18:21', NULL),
('af9be3a8c216395b4493b936a07a5420ece5ea62', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 12:25:10', NULL),
('404017a084d51ce242f14112b56196917d28b1a4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 12:32:42', NULL),
('293b8940bddc43fd7a4526ec255619f636a2c040', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 13:25:13', NULL),
('3748c369d00f38c1dd43b4ca53cb676d5b765bd4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 13:26:51', NULL),
('11135960a93a4bb059069593c3b631f3e2bf32a0', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 13:32:28', NULL),
('1e6c2e7ae5a0bc0dc7c7c1ace6cc659a56217446', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 13:34:32', NULL),
('7c1dfd9d64079a89b1c3cfbb3a592c6718ed37e5', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 13:35:59', NULL),
('5dec17325b93e0a9a6f06dc090fc19bbc290293a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 13:49:41', NULL),
('db46441cfc43d93f79215119ba852ef6a5e3319f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 13:52:20', NULL),
('7a483d5d081ace69b2ab765ec9747b7848facec1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 14:42:06', NULL),
('38f4335f820b31cff26db0340f620d729360e618', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 15:00:34', NULL),
('53fa49206776a7d255f379ff62b41e97e05f2d47', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 15:03:36', NULL),
('5dcdf12bcfa2bed7a3b2a0d6016c7f5aea35ce7a', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 15:40:11', NULL),
('98c1f77c7f951d3c313b46f2bc6ca2b159101df9', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 15:50:52', NULL),
('2132b53ecc4a7d9c54d91b937edf2b219f0da261', 'admintom_admin', 'support@nsmartrac.com', '2020-08-22 20:14:51', NULL),
('00763ae7b5c00d8ae38d1942316b46419bf228ab', 'admintom_admin', 'support@nsmartrac.com', '2020-08-23 19:54:58', NULL),
('9dd8b0d7bde3b50cde42558668a013b388599cf1', 'admintom_admin', 'support@nsmartrac.com', '2020-08-24 11:55:13', NULL),
('b33552fbf39a22231acef9a027bdcd9b99b26a4e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-24 12:08:38', NULL),
('22b7f9471415c38ed4dd9464161ca14c9e552342', 'admintom_admin', 'support@nsmartrac.com', '2020-08-24 12:10:01', NULL),
('2348653091313f7be34c02c3811114a104e4586b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-24 12:40:57', NULL),
('7c48113a23167b065db9fa8d09f55698feafed56', 'admintom_admin', 'support@nsmartrac.com', '2020-08-24 12:44:30', NULL),
('7b8d9445d35c098efb7b6d0539be0c7f2257b916', 'admintom_admin', 'support@nsmartrac.com', '2020-08-24 13:02:00', NULL),
('5c3d9e45e8ae5d18b250b5b361ae17e2a1a7922f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-24 13:17:25', NULL),
('9a9888f6a0580cdda457370e233b7386c64ce198', 'admintom_admin', 'support@nsmartrac.com', '2020-08-24 13:24:33', NULL),
('65734b12fe662184b9d95dfd2ef709a1cec76801', 'admintom_admin', 'support@nsmartrac.com', '2020-08-24 13:27:28', NULL),
('85e576d3745d62ebd9799586de7f453901a95e13', 'admintom_admin', 'support@nsmartrac.com', '2020-08-24 13:36:47', NULL),
('2854276484f82064e7602445e8b21cfe75b18972', 'admintom_admin', 'support@nsmartrac.com', '2020-08-24 13:49:58', NULL),
('1d0634b835851f6f43c56dc56a67060c49535ba4', 'admintom_admin', 'support@nsmartrac.com', '2020-08-24 13:51:27', NULL),
('6a07996615e690668deb7db4d2025034158db1ac', 'admintom_admin', 'support@nsmartrac.com', '2020-08-26 02:26:47', NULL),
('309336c7f060036db354fd27208a27951a1ba564', 'admintom_admin', 'support@nsmartrac.com', '2020-08-26 02:42:20', NULL),
('1e4e30f8a96d5f21161ee2935c5483b292488a65', 'admintom_admin', 'support@nsmartrac.com', '2020-08-26 02:45:46', NULL),
('878019c5e4e4ad5462614b38e37c3dcd63d98d7e', 'admintom_admin', 'support@nsmartrac.com', '2020-08-26 02:48:14', NULL),
('d50ea2da3c3a637d69dfd47093d51d1676846339', 'admintom_admin', 'support@nsmartrac.com', '2020-08-26 02:49:42', NULL),
('ccadb4e7690e294203eb3cfe95370cbf4bad33ce', 'admintom_admin', 'support@nsmartrac.com', '2020-08-26 03:00:54', NULL),
('cd829382ecdb2d42644c64b342d6840db0154cba', 'admintom_admin', 'support@nsmartrac.com', '2020-08-26 03:20:51', NULL),
('fb20b42c9797d257531526a52b3fd114f736a31f', 'admintom_admin', 'support@nsmartrac.com', '2020-08-26 03:22:00', NULL),
('eb449b5564aec650defd50455ef6332eb976bbca', 'admintom_admin', 'support@nsmartrac.com', '2020-08-31 12:13:54', NULL),
('e7712656e9ef852fe42f2ecf4d9ff884a46e42c5', 'admintom_admin', 'support@nsmartrac.com', '2020-08-31 13:55:12', NULL),
('758a67829af44030034f11c071fcaf836d910525', 'admintom_admin', 'support@nsmartrac.com', '2020-08-31 15:01:18', NULL),
('0207501f0b681fa92fa0e4df9e456f98cccfd30b', 'admintom_admin', 'support@nsmartrac.com', '2020-08-31 15:03:22', NULL),
('53c8e7c554d8fdd7f371c38f14d21e53334402fc', 'admintom_admin', 'support@nsmartrac.com', '2020-08-31 15:05:40', NULL),
('cb55058064d73677f6ce81490c06fb45e526c4c9', 'admintom_admin', 'support@nsmartrac.com', '2020-09-01 08:06:24', NULL),
('a2225a8207399e8397c632c352ed27d153f6d167', 'admintom_admin', 'support@nsmartrac.com', '2020-09-01 08:26:11', NULL),
('c2dcc01b92812af5adf254b108ab2e0be7658333', 'admintom_admin', 'support@nsmartrac.com', '2020-09-01 12:37:40', NULL),
('5e6fa0966c6814e631d1851826fdb302530b389a', 'admintom_admin', 'support@nsmartrac.com', '2020-09-06 05:42:20', NULL),
('906ce3691d600dad92602479a694659ec453e45e', 'admintom_admin', 'support@nsmartrac.com', '2020-09-06 05:45:10', NULL),
('2f43382412dbef26ec5dfe861def8597630dedde', 'admintom_admin', 'support@nsmartrac.com', '2020-09-06 05:50:33', NULL),
('8a8bede1d41aa32d4b5537fd4d91b18d1ade7b67', 'admintom_admin', 'support@nsmartrac.com', '2020-10-01 14:27:15', NULL),
('59b27f59208195535d830001ce56796aa4b9886e', 'admintom_admin', 'support@nsmartrac.com', '2020-10-01 14:28:47', NULL),
('9c5e92900276bc6c8d9ce21d4e95e34ccef60e9f', 'admintom_admin', 'support@nsmartrac.com', '2020-10-05 09:59:36', NULL),
('af944decce68aa108d75bd4d266911e448447961', 'admintom_admin', 'support@nsmartrac.com', '2020-10-05 10:33:38', NULL),
('68ac45bc64c77917b7d0eb5d326941074c387316', 'admintom_admin', 'support@nsmartrac.com', '2020-10-05 10:43:08', NULL),
('27ecb08abe7337d140a170bd71681ffdd8f3479c', 'admintom_admin', 'support@nsmartrac.com', '2020-10-06 15:26:57', NULL),
('5e7e92d2208e848f00ac20dc0e949907cdd19cdb', 'admintom_admin', 'support@nsmartrac.com', '2020-10-18 19:37:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_scopes`
--

CREATE TABLE `oauth_scopes` (
  `scope` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_users`
--

CREATE TABLE `oauth_users` (
  `username` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT NULL,
  `scope` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_lead_form`
--

CREATE TABLE `online_lead_form` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `iframe_code` text,
  `javascript_code` text,
  `contact_page_url` text,
  `text_color` varchar(50) DEFAULT NULL,
  `text_size` varchar(50) DEFAULT NULL,
  `text_font` varchar(50) DEFAULT NULL,
  `button_color` varchar(50) DEFAULT NULL,
  `button_text_color` varchar(50) DEFAULT NULL,
  `app_notification` int(11) DEFAULT NULL,
  `email_notification` int(11) DEFAULT NULL,
  `google_analytics_tracking_id` varchar(255) DEFAULT NULL,
  `google_analytics_origin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `online_lead_form`
--

INSERT INTO `online_lead_form` (`id`, `company_id`, `type`, `iframe_code`, `javascript_code`, `contact_page_url`, `text_color`, `text_size`, `text_font`, `button_color`, `button_text_color`, `app_notification`, `email_notification`, `google_analytics_tracking_id`, `google_analytics_origin`) VALUES
(4, 1, '0', '0', '0', '0', '#276cb8', '0', '0', '#276cb8', '#276cb8', 0, 0, 'aaa', 'bbb');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `options_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `options` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `option_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `option_order` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`options_id`, `question_id`, `options`, `option_value`, `option_order`, `create_date`) VALUES
(1, 3, 'Option 1', 'yes', 1, '2020-06-12 00:00:00'),
(2, 3, 'Option 2', 'no', 2, '2020-06-12 00:00:00'),
(3, 3, 'Option 3', 'What is code?', 3, '2020-06-12 00:00:00'),
(4, 4, 'Option 1', 'Pig Latin', 1, '2020-06-12 00:00:00'),
(5, 4, 'Option 2', 'JavaScript', 2, '2020-06-12 00:00:00'),
(6, 4, 'Option 3', 'English', 3, '2020-06-12 00:00:00'),
(7, 9, 'Option 1', 'car', 1, '2020-06-12 00:00:00'),
(8, 9, 'Option 2', 'Money', 2, '2020-06-12 00:00:00'),
(9, 9, 'Option 3', 'Relationship', 3, '2020-06-12 00:00:00'),
(10, 9, 'Option 4', 'A hard time', 4, '2020-06-12 00:00:00'),
(11, 9, 'Option 5', 'Success', 5, '2020-06-12 00:00:00'),
(12, 15, 'Option 1', '1', 1, '2020-07-14 00:00:00'),
(13, 15, 'Option 2', '2', 2, '2020-07-14 00:00:00'),
(14, 15, 'Option 3', '3', 3, '2020-07-14 00:00:00'),
(15, 16, 'Option 1', '1', 1, '2020-07-14 00:00:00'),
(16, 16, 'Option 2', '2', 2, '2020-07-14 00:00:00'),
(17, 16, 'Option 3', '3', 3, '2020-07-14 00:00:00'),
(18, 17, 'Option 1', '1', 1, '2020-07-14 00:00:00'),
(19, 17, 'Option 2', '2', 2, '2020-07-14 00:00:00'),
(20, 17, 'Option 3', '3', 3, '2020-07-14 00:00:00'),
(21, 32, 'Option 1', 'Tommy Nguyen', 1, '2020-08-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payments_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` decimal(9,2) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_method_id` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ontime, late, return',
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `payment_method` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quick_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permissions_id` int(11) NOT NULL,
  `section_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permissions_id`, `section_name`) VALUES
(1, 'All'),
(2, 'users'),
(3, 'jobs'),
(4, 'files'),
(5, 'file-folders'),
(6, 'appointments'),
(7, 'surveys'),
(8, 'invoices'),
(9, 'customer-records'),
(10, 'custom-forms'),
(11, 'company-settings'),
(12, 'employee-records'),
(13, 'customer-payment-details'),
(14, 'vendors'),
(15, 'items'),
(16, 'user-profile'),
(17, 'time-records'),
(18, 'reports'),
(19, 'employee-locations'),
(20, 'tasks'),
(21, 'contracts'),
(22, 'customer-leads'),
(23, 'employee-records'),
(24, 'customer-payment-details'),
(25, 'vendors'),
(26, 'items'),
(27, 'user-profile'),
(28, 'time-records'),
(29, 'reports'),
(30, 'employee-locations'),
(31, 'tasks'),
(32, 'contracts'),
(33, 'customer-leads');

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `phone_id` int(11) NOT NULL,
  `number` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'mobile, landline, voip, fax, office',
  `is_primary` tinyint(1) DEFAULT NULL,
  `accept_text` tinyint(1) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phone`
--

INSERT INTO `phone` (`phone_id`, `number`, `extension`, `type`, `is_primary`, `accept_text`, `user_id`) VALUES
(1, '8506195914', NULL, NULL, NULL, NULL, 23);

-- --------------------------------------------------------

--
-- Table structure for table `plan_headings`
--

CREATE TABLE `plan_headings` (
  `id` int(110) NOT NULL,
  `title` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plan_headings`
--

INSERT INTO `plan_headings` (`id`, `title`, `date_created`, `date_updated`) VALUES
(3, 'Management', '2020-08-11 08:24:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plan_type`
--

CREATE TABLE `plan_type` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1= active',
  `modified` datetime NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plan_type_has_custom_form`
--

CREATE TABLE `plan_type_has_custom_form` (
  `plan_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plan_type_has_items`
--

CREATE TABLE `plan_type_has_items` (
  `id` int(11) NOT NULL,
  `id1` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_pictures`
--

CREATE TABLE `portfolio_pictures` (
  `id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'uploads/PortfolioPictures/<company_id>/<file_name>',
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `priority_list`
--

CREATE TABLE `priority_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `Questions_id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `q_type` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `forms_id` int(11) NOT NULL,
  `question_order` int(11) DEFAULT NULL,
  `parent_question` int(11) DEFAULT NULL,
  `parameter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conditions` text COLLATE utf8_unicode_ci,
  `style` text COLLATE utf8_unicode_ci,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`Questions_id`, `question`, `q_type`, `description`, `forms_id`, `question_order`, `parent_question`, `parameter`, `conditions`, `style`, `company_id`) VALUES
(1, 'Your Name PLEASE', 'text', 'Put your first name first, and your last name last', 1, 1, 0, '{\"required\":\"true\",\"encrypt\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(2, 'WHAT DO YOU EVEN DO?', 'textarea', '', 1, 2, 0, '{\"required\":\"false\",\"encrypt\":\"false\",\"reachtextboxformatting\":\"true\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\",\"limit\":\"false\",\"limit_range\":\"\"}', '', '', 1),
(3, 'Do you even code? ', 'selection', '', 1, 3, 0, '{\"required\":\"false\",\"allow_other\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\",\"selection_type\":\"radio\"}', '', '', 1),
(4, 'Pick a Language', 'selection', '', 1, 4, 0, '{\"required\":\"false\",\"allow_other\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\",\"selection_type\":\"dropdown\"}', '', '', 1),
(5, 'Upload your face', 'file-upload', '', 1, 5, 0, '{\"required\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(6, 'What day is your favorite ever?', 'date-picker', '', 1, 6, 0, '{\"required\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(7, 'Enter your digits', 'phone', '', 1, 7, 0, '{\"required\":\"false\",\"extension\":\"true\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\",\"phone_type_selector\":\"true\"}', '', '', 1),
(8, 'Who should we spam', 'email', 'provide an email', 1, 8, 0, '{\"required\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(9, 'Pick what you want', 'selection', '', 1, 9, 0, '{\"required\":\"false\",\"allow_other\":\"true\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\",\"selection_type\":\"checkbox\"}', '', '', 1),
(10, 'Places you have been', 'reperator', '', 1, 10, 0, '', '', '', 1),
(11, 'Where have you been', 'address', '', 1, 11, 10, '{\"required\":\"false\",\"country_input\":\"true\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(12, 'I dont want this', 'group', '', 1, 12, 0, '', '', '', 1),
(13, 'text field', 'text', '', 2, 1, 0, '{\"required\":\"false\",\"encrypt\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(14, 'Area', 'textarea', '', 2, 2, 0, '{\"required\":\"false\",\"encrypt\":\"false\",\"reachtextboxformatting\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\",\"limit\":\"false\",\"limit_range\":\"\"}', '', '', 1),
(15, 'a selection? ', 'selection', '', 2, 3, 0, '{\"required\":\"false\",\"allow_other\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(16, 'another selection', 'selection', '', 2, 4, 0, '{\"required\":\"false\",\"allow_other\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(17, 'another selection 2', 'selection', '', 2, 5, 0, '{\"required\":\"false\",\"allow_other\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(18, 'phone', 'phone', '', 2, 6, 0, '{\"required\":\"false\",\"extension\":\"true\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\",\"phone_type_selector\":\"true\"}', '', '', 1),
(19, 'date', 'date-picker', '', 2, 7, 0, '{\"required\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(20, 'email', 'email', '', 2, 8, 0, '{\"required\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(21, 'address', 'address', '', 2, 9, 0, '{\"required\":\"false\",\"country_input\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(22, 'file', 'file-upload', '', 2, 10, 0, '{\"required\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(23, 'group', 'group', '', 3, 1, 0, '', '', '', 1),
(24, 'phone', 'phone', '', 3, 2, 23, '{\"required\":\"false\",\"extension\":\"true\",\"phone_type_selector\":\"true\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(25, 'address', 'address', '', 3, 3, 23, '{\"required\":\"false\",\"country_input\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(26, 'repeater', 'reperator', '', 3, 4, 0, '', '', '', 1),
(27, 'name', 'text', '', 3, 5, 26, '{\"required\":\"false\",\"encrypt\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(28, 'email', 'email', '', 3, 6, 26, '{\"required\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(29, 'DOB', 'date-picker', '', 3, 7, 26, '{\"required\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(30, 'New Work Order', 'group', 'Add your new work order', 4, 1, 0, '', '', '', 1),
(31, 'Work Order', 'textarea', 'Wo-00710', 4, 2, 30, '{\"column_width\":\"col-sm-1\",\"required\":\"false\",\"encrypt\":\"false\",\"limit\":\"false\",\"limit_range\":\"\",\"reachtextboxformatting\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_f', '', '', 1),
(32, 'Customer', 'dropdown', 'Select Customer', 4, 3, 30, '{\"column_width\":\"col-sm-5\",\"required\":\"false\",\"allow_other\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_font_color\":\"#000000\"}', '', '', 1),
(33, 'Job Location', 'textarea', '(select from existing addresses or add new one)', 4, 4, 30, '{\"column_width\":\"col-sm-6\",\"required\":\"false\",\"encrypt\":\"false\",\"limit\":\"false\",\"limit_range\":\"\",\"reachtextboxformatting\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_f', '', '', 1),
(34, 'Customer', 'textarea', 'Select Customer', 4, 2, 30, '{\"column_width\":\"col-sm-6\",\"required\":\"false\",\"encrypt\":\"false\",\"limit\":\"false\",\"limit_range\":\"\",\"reachtextboxformatting\":\"false\",\"question_styling_class\":\"\",\"question_styling_maxlength\":\"\",\"question_styling_background_color\":\"#ffffff\",\"question_styling_f', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quick_links`
--

CREATE TABLE `quick_links` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quick_links`
--

INSERT INTO `quick_links` (`id`, `category`, `name`, `url`, `company_id`) VALUES
(1, 'Car', 'nprohub', 'nprohub.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `records_id` int(11) NOT NULL,
  `record_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_no` int(11) DEFAULT NULL,
  `jobs_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `company_id`) VALUES
(1, 'NSmart-Admin', NULL),
(2, 'NSmart- Tech', NULL),
(3, 'Owner', NULL),
(4, 'Manager', NULL),
(5, 'Human Resources', NULL),
(6, 'IT', NULL),
(7, 'Tech', NULL),
(8, 'Sales', NULL),
(9, 'Appointment Setter', NULL),
(10, 'Assistant Sales Manager', NULL),
(11, 'Corporate Office Administrator', NULL),
(12, 'Credit Portal', NULL),
(13, 'Credit Report - View', NULL),
(14, 'Human Resource', NULL),
(15, 'Import-Export', NULL),
(16, 'Inventory Admin', NULL),
(17, 'Inventory Manager', NULL),
(18, 'Lead Rep', NULL),
(19, 'Lead Technician', NULL),
(20, 'Office Administrator', NULL),
(21, 'Office Use', NULL),
(22, 'Other', NULL),
(23, 'Payment information', NULL),
(24, 'Payroll', NULL),
(25, 'Recruiter', NULL),
(26, 'Regional Recruiter', NULL),
(27, 'Regional Sales Manager', NULL),
(28, 'Sales Agent', NULL),
(29, 'Sales Manager', NULL),
(30, 'Staff', NULL),
(31, 'Sub Dealer', NULL),
(32, 'Technician', NULL),
(33, 'Timecard Admin', NULL),
(34, 'TimeCards', NULL),
(35, 'Trainer', NULL),
(36, 'General Manager', NULL),
(38, 'IT', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permissions_id` int(11) NOT NULL,
  `create_record` tinyint(1) DEFAULT NULL,
  `read_record` tinyint(1) DEFAULT NULL,
  `update_record` tinyint(1) DEFAULT NULL,
  `delete_record` tinyint(1) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated`, `updated_by`) VALUES
(1, 'company_name', 'nSmartrac', '2018-06-21 17:07:59', NULL, NULL),
(2, 'company_email', 'nsmartrac@gmail.com', '2018-07-11 10:39:58', NULL, NULL),
(3, 'timezone', 'America/Chicago', '2018-07-15 19:24:17', NULL, NULL),
(4, 'login_theme', '1', '2019-06-06 13:34:28', NULL, NULL),
(5, 'date_format', 'd F, Y', '2020-01-04 02:01:45', NULL, NULL),
(6, 'datetime_format', 'h:m a - d M, Y ', '2020-01-04 02:02:24', NULL, NULL),
(7, 'google_recaptcha_enabled', '0', '2020-01-05 01:14:03', NULL, NULL),
(8, 'google_recaptcha_sitekey', '6LdIWswUAAAAAMRp6xt2wBu7V59jUvZvKWf_rbJc', '2020-01-05 01:14:17', NULL, NULL),
(9, 'google_recaptcha_secretkey', '6LdIWswUAAAAAIsdboq_76c63PHFsOPJHNR-z-75', '2020-01-05 01:14:40', NULL, NULL),
(10, 'bg_img_type', 'jpeg', '2020-01-07 00:23:33', NULL, NULL),
(11, 'schedule', 'a:8:{s:17:\"calendar_timezone\";s:15:\"America/Chicago\";s:21:\"calendar_default_view\";s:5:\"Month\";s:18:\"calendar_first_day\";s:1:\"0\";s:22:\"calender_day_starts_on\";s:7:\"7:00 AM\";s:20:\"calender_day_ends_on\";s:7:\"7:00 PM\";s:24:\"work_order_show_customer\";s:1:\"1\";s:23:\"work_order_show_details\";s:1:\"1\";s:21:\"work_order_show_price\";s:1:\"1\";}', '2020-03-27 14:16:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting_email_brandings`
--

CREATE TABLE `setting_email_brandings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email_from_name` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_template_footer_text` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `logo` text COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting_notifications`
--

CREATE TABLE `setting_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting_online_payments`
--

CREATE TABLE `setting_online_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paypal_email_address` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_is_active` tinyint(2) NOT NULL,
  `created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signatures`
--

CREATE TABLE `signatures` (
  `signatures_id` int(11) NOT NULL,
  `signer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sign_date` datetime DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'customer, employee, witness',
  `jobs_id` int(11) NOT NULL,
  `contracts_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storage_loc`
--

CREATE TABLE `storage_loc` (
  `loc_id` int(11) NOT NULL,
  `location_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` int(11) UNSIGNED NOT NULL,
  `workspace_id` int(11) NOT NULL,
  `count_timer` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `published` tinyint(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_published` timestamp NULL DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `theme_id` int(12) NOT NULL,
  `useBackgroundImage` tinyint(4) NOT NULL,
  `backgroundImage` varchar(32) DEFAULT NULL,
  `hasProgressBar` tinyint(1) NOT NULL,
  `canRedirectOnComplete` tinyint(1) NOT NULL,
  `redirectionLink` text NOT NULL,
  `isNewRespondentsClosed` tinyint(1) NOT NULL,
  `hasClosedDate` tinyint(1) NOT NULL,
  `closingDate` date NOT NULL,
  `hasResponseLimit` tinyint(1) NOT NULL,
  `responseLimit` int(4) NOT NULL,
  `hasCustomClosedMessage` tinyint(1) NOT NULL,
  `closingMessage` varchar(123) NOT NULL,
  `isPublished` int(11) NOT NULL,
  `temp_id` int(11) NOT NULL,
  `customBackgroundImage` varchar(64) NOT NULL,
  `isScoreMonitored` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `workspace_id`, `count_timer`, `count`, `title`, `published`, `created_by`, `date_created`, `date_published`, `company_id`, `theme_id`, `useBackgroundImage`, `backgroundImage`, `hasProgressBar`, `canRedirectOnComplete`, `redirectionLink`, `isNewRespondentsClosed`, `hasClosedDate`, `closingDate`, `hasResponseLimit`, `responseLimit`, `hasCustomClosedMessage`, `closingMessage`, `isPublished`, `temp_id`, `customBackgroundImage`, `isScoreMonitored`) VALUES
(1, 1, '', 0, 'template choice test', 0, 2, '2020-08-05 11:41:37', NULL, 0, 11, 0, 'get-in-touch-wallpaper.jpg', 0, 0, '', 0, 0, '0000-00-00', 0, 0, 0, '', 0, 0, '', 0),
(3, 2, '', 0, 'template choice test', 0, 7, '2020-08-07 02:45:03', NULL, 0, 0, 0, '', 0, 0, '', 0, 0, '0000-00-00', 0, 0, 0, '', 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `survey_answer`
--

CREATE TABLE `survey_answer` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `session_id` varchar(9) NOT NULL,
  `isCorrectAnswer` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey_logic`
--

CREATE TABLE `survey_logic` (
  `sl_rec_no` int(11) NOT NULL,
  `sl_survey_id` int(11) NOT NULL,
  `sl_question_source` int(11) DEFAULT NULL,
  `sl_question_id_from` varchar(16) DEFAULT NULL,
  `sl_question_id_to` int(11) DEFAULT NULL,
  `sl_value` varchar(64) DEFAULT NULL,
  `sl_condition` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_logic`
--

INSERT INTO `survey_logic` (`sl_rec_no`, `sl_survey_id`, `sl_question_source`, `sl_question_id_from`, `sl_question_id_to`, `sl_value`, `sl_condition`) VALUES
(4, 27, 27, '27', 274, 'no', 'is-equal-to'),
(5, 43, 43, '43', 434, 'no', 'is-equal-to'),
(6, 5, 51, '51', 55, 'no', 'is-equal-to');

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `question` text NOT NULL,
  `template_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `active` tinyint(1) DEFAULT NULL,
  `required` tinyint(1) DEFAULT NULL,
  `description` text NOT NULL,
  `description_label` varchar(255) NOT NULL,
  `image_background` text NOT NULL,
  `image_position` int(5) NOT NULL,
  `isImageDisplayed` bigint(5) NOT NULL,
  `maxcharacters` int(2) NOT NULL,
  `mincharacters` int(2) NOT NULL,
  `custom_button_text` varchar(32) NOT NULL,
  `custom_text_color` varchar(8) NOT NULL,
  `custom_button_color` varchar(8) NOT NULL,
  `hasGroup` tinyint(4) NOT NULL,
  `groupId` int(11) NOT NULL,
  `isScoreCounted` tinyint(4) NOT NULL,
  `correctAnswer` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_questions`
--

INSERT INTO `survey_questions` (`id`, `survey_id`, `question`, `template_id`, `order`, `active`, `required`, `description`, `description_label`, `image_background`, `image_position`, `isImageDisplayed`, `maxcharacters`, `mincharacters`, `custom_button_text`, `custom_text_color`, `custom_button_color`, `hasGroup`, `groupId`, `isScoreCounted`, `correctAnswer`) VALUES
(1, 1, 'Interested in our product? Answer a few short questions and we\'ll get in touch with you!', 1, 1, NULL, 0, '', '', '', 0, 0, 0, 0, '', '', '', 0, 0, 0, NULL),
(2, 1, 'Cool! And your surname?', 9, 3, NULL, 1, '', '', '', 0, 0, 0, 0, '', '', '', 0, 0, 0, NULL),
(3, 1, 'Great. Now what\'s your email?', 5, 4, NULL, 1, '', '', '', 0, 0, 0, 0, '', '', '', 0, 0, 0, NULL),
(4, 1, 'Last question, what product are you interested in?', 9, 6, NULL, 1, '', '', '', 0, 0, 0, 0, '', '', '', 0, 0, 0, NULL),
(5, 1, 'And your phone number?', 8, 5, NULL, 1, '', '', '', 0, 0, 0, 0, '', '', '', 0, 0, 0, NULL),
(6, 1, 'All good! We\'ve got that. We\'ll be in touch soon!', 19, 6, NULL, 1, '', '', '', 0, 0, 0, 0, '', '', '', 0, 0, 0, NULL),
(7, 1, 'First up, what should we call you?', 9, 2, NULL, 1, '', '', '', 0, 0, 0, 0, '', '', '', 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `survey_template_answer`
--

CREATE TABLE `survey_template_answer` (
  `id` int(11) NOT NULL,
  `survey_template_id` varchar(255) NOT NULL,
  `survey_template_choice` text NOT NULL,
  `choices_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_template_answer`
--

INSERT INTO `survey_template_answer` (`id`, `survey_template_id`, `survey_template_choice`, `choices_label`) VALUES
(2, '73', '<div class=\"form-group\">                                         <label>Answer</label>                                         <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">\r\n</div>', ''),
(3, '74', '<div class=\"form-group\">                                         <label>Answer</label>                                         <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">\r\n</div>\r\n', ''),
(4, '75', '<div class=\"form-group\">                                         <label>Answer</label>                                         <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">\r\n</div>', ''),
(5, '76', '<div class=\"form-group\">                                         <label>Answer</label>                                         <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(6, '77', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\" type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(7, '78', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(8, '77', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\" disabled\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(9, '77', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\" disabled\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(10, '77', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\" disabled\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(11, '77', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\" disabled\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(12, '78', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input disabled type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(13, '79', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(14, '80', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(15, '81', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(16, '82', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(17, '83', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(18, '84', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(19, '85', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(20, '86', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(21, '87', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(22, '88', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(23, '89', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(24, '90', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(25, '91', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', 'test'),
(26, '92', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', 'test'),
(27, '93', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(28, '94', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(29, '95', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(30, '96', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(31, '97', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(32, '98', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(33, '99', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(34, '100', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(35, '101', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(36, '102', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(37, '103', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(38, '104', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(39, '105', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(40, '106', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(41, '106', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(42, '107', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(43, '108', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(44, '108', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(45, '109', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(46, '110', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(47, '110', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(48, '111', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(49, '112', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(50, '113', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(51, '114', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(52, '115', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(53, '116', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(54, '117', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(55, '118', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(56, '119', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(57, '120', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(58, '119', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(59, '120', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(60, '119', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(61, '114', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(62, '121', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" aria-label=\"Text input with radio button\">\r\n                                </div>', ''),
(63, '120', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\">\r\n                                  </div>', ''),
(64, '122', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\" value=\"test\" name=\"option\">\r\n                                  </div>', ''),
(65, '122', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" aria-label=\"Text input with checkbox\" value=\"test\" name=\"option\">\r\n                                  </div>', ''),
(66, '123', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\"  value=\"test\" name=\"option\">\r\n                                  </div>', '12342'),
(67, '123', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\"  value=\"test\" name=\"option\">\r\n                                  </div>', '12342'),
(68, '124', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\"  value=\"test\" name=\"option\">\r\n                                  </div>', 'aw'),
(69, '124', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\"  value=\"test\" name=\"option\">\r\n                                  </div>', 'aw'),
(70, '123', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\"  value=\"\" name=\"option\">\r\n                                  </div>', '22'),
(71, '123', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', '24'),
(72, '123', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test'),
(73, '123', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test'),
(74, '125', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'test'),
(75, '125', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'test'),
(76, '125', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'aw'),
(77, '124', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', ''),
(78, '126', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(79, '127', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(80, '128', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(81, '129', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(82, '130', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(83, '131', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(84, '132', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'awawdawdawdaw'),
(85, '132', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'awdawdawdawdawddawdawd'),
(86, '133', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(87, '133', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'awdawdawd'),
(88, '134', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(89, '135', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(90, '136', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(91, '137', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(92, '138', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(93, '139', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(94, '140', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(95, '141', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(96, '142', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(97, '143', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'awda'),
(98, '143', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'dawdawdawda'),
(99, '144', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'test'),
(100, '145', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'awdaw'),
(101, '145', '<div class=\"input-group mb-3\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'ysefsxef'),
(102, '146', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'dawdawdawdawd'),
(103, '146', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'awdawd');
INSERT INTO `survey_template_answer` (`id`, `survey_template_id`, `survey_template_choice`, `choices_label`) VALUES
(104, '146', '<div class=\"input-group mb-2\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'etserfsefsef'),
(105, '147', '', ''),
(106, '148', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(107, '149', '<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input type=\"file\" class=\"custom-file-input\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div>\r\n', ''),
(108, '150', '<div class=\"form-group\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input type=\"file\" class=\"custom-file-input\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(109, '151', '', ''),
(110, '152', '<div class=\"form-group\">\r\n    <label for=\"for_email\">Email address</label>\r\n    <input type=\"email\" class=\"form-control\" name=\"answer\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(111, '153', '<div class=\"form-group\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input type=\"file\" class=\"custom-file-input\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(112, '154', ' 		<div class=\"form-group\">                                     <label for=\"contact_phone\">Phone</label>                                     <input type=\"text\" class=\"form-control valid\" name=\"contact_phone\" id=\"contact_phone\" placeholder=\"(555) 555-5555\" aria-invalid=\"false\">                                 </div>', ''),
(113, '155', ' 		<div class=\"form-group\">                                     <label for=\"contact_phone\">Phone</label>                                     <input type=\"text\" class=\"form-control valid\" name=\"contact_phone\" id=\"contact_phone\" placeholder=\"(555) 555-5555\" aria-invalid=\"false\">                                 </div>', ''),
(114, '156', '<div class=\"form-group\">\r\n    <label for=\"for_email\">Email address</label>\r\n    <input type=\"email\" class=\"form-control\" name=\"answer\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(115, '157', '<div class=\"form-group\">\r\n    <label for=\"for_email\">Email address</label>\r\n    <input type=\"email\" class=\"form-control\" name=\"answer\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(116, '158', '<div class=\"form-group\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(117, '159', '', ''),
(118, '159', '', ''),
(119, '160', '<div class=\"form-group\">\r\n    <label for=\"for_email\">Email address</label>\r\n    <input type=\"email\" class=\"form-control\" name=\"answer\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(120, '161', '', ''),
(121, '162', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(122, '163', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(123, '164', '<div class=\"form-group\">\r\n    <label for=\"for_email\">Email address</label>\r\n    <input type=\"email\" class=\"form-control\" name=\"answer\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(124, '165', '<div class=\"form-group\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input type=\"file\" class=\"custom-file-input\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(125, '166', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'Option 1'),
(126, '167', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'Multiple 1'),
(127, '166', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'Option 2'),
(128, '167', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'Multiple 2'),
(129, '168', '', ''),
(130, '169', '<div class=\"form-group\">\r\n    <label for=\"for_email\">Email address</label>\r\n    <input type=\"email\" class=\"form-control\" name=\"answer\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(131, '170', '<div class=\"form-group\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(132, '171', '<div class=\"form-group\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input type=\"file\" class=\"custom-file-input\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(133, '172', '', ''),
(134, '173', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(135, '174', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(136, '175', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(137, '176', '', ''),
(138, '177', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(139, '178', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(140, '179', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'Bottle '),
(141, '180', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(142, '181', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'Liquid Distribution'),
(143, '181', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'Solid Solution'),
(144, '181', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'Gas Reactor'),
(145, '179', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'Cup'),
(146, '179', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'Bowl'),
(147, '182', '', ''),
(148, '183', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(149, '184', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(150, '185', '', ''),
(151, '186', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(152, '187', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(153, '188', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(154, '189', '', ''),
(155, '190', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(156, '191', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(157, '192', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(158, '193', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(159, '194', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test'),
(160, '195', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(161, '181', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', ''),
(162, '181', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', ''),
(163, '196', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(164, '197', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(165, '198', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(166, '199', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(167, '200', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', ''),
(168, '200', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', ''),
(169, '200', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', ''),
(170, '200', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', ''),
(171, '201', '<div class=\"form-group\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(172, '202', '<div class=\"form-group\">\r\n    <label for=\"for_email\">Email address</label>\r\n    <input type=\"email\" class=\"form-control\" name=\"answer\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(173, '203', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'TEST'),
(174, '203', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'TEST'),
(175, '203', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test'),
(176, '204', '', ''),
(177, '205', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'Local'),
(178, '206', '<div class=\"form-group\">\r\n   \r\n    <input type=\"email\" class=\"form-control\" name=\"answer\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(179, '207', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(180, '205', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'Host'),
(181, '205', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'Local'),
(182, '208', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(183, '209', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(184, '210', '', ''),
(185, '211', '', ''),
(186, '212', '', ''),
(187, '213', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(188, '214', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(189, '215', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(190, '216', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', ''),
(191, '217', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', ''),
(192, '218', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(193, '219', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(194, '220', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(195, '221', '', ''),
(196, '222', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(197, '223', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(198, '224', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(199, '225', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', ''),
(200, '226', '<div class=\"form-group\">\r\n   \r\n    <input type=\"email\" class=\"form-control\" name=\"answer\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(201, '227', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(202, '228', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(203, '229', '', ''),
(204, '230', '', ''),
(205, '231', '', ''),
(206, '232', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(207, '233', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(208, '234', '<div class=\"form-group\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(209, '235', '', ''),
(210, '236', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(211, '237', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(212, '238', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(213, '239', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(214, '240', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(215, '241', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(216, '242', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(217, '243', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(218, '244', '<div class=\"form-group\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input type=\"file\" class=\"custom-file-input\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(219, '245', ' 		<div class=\"form-group\">                                     <label for=\"contact_phone\">Phone</label>                                     <input type=\"text\" class=\"form-control valid\" name=\"contact_phone\" id=\"contact_phone\" placeholder=\"(555) 555-5555\" aria-invalid=\"false\">                                 </div>', ''),
(220, '246', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(221, '247', '<div class=\"form-group\">\r\n                                        <input type=\"checkbox\" checked data-toggle=\"toggle\" name=\"answer\"  data-on=\"Yes\" data-off=\"No\">                                   \r\n                                     </div>', ''),
(222, '248', '<div class=\"form-group\">\r\n                                        <input type=\"checkbox\" checked data-toggle=\"toggle\" name=\"answer\"  data-on=\"Yes\" data-off=\"No\">                                   \r\n                                     </div>', ''),
(223, '249', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(224, '250', '', ''),
(225, '251', '', ''),
(226, '252', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(227, '253', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(228, '254', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(229, '255', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', ''),
(230, '256', '', ''),
(231, '257', '<div class=\"form-group\">\r\n                                        <input type=\"checkbox\" checked data-toggle=\"toggle\" name=\"answer\"  data-on=\"Yes\" data-off=\"No\">                                   \r\n                                     </div>', ''),
(232, '258', '', ''),
(233, '259', '', ''),
(234, '260', '', ''),
(235, '261', '', ''),
(236, '262', '', ''),
(237, '263', '', ''),
(238, '264', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(239, '265', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(240, '266', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', '1st'),
(241, '267', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', '1st'),
(242, '268', '<div class=\"form-group\">\r\n   \r\n    <input type=\"email\" class=\"form-control\" name=\"answer\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(243, '269', '<div class=\"form-group\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(244, '270', '<div class=\"form-group\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input type=\"file\" class=\"custom-file-input\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(245, '271', ' 		<div class=\"form-group\">                                     <label for=\"contact_phone\">Phone</label>                                     <input type=\"text\" class=\"form-control valid\" name=\"contact_phone\" id=\"contact_phone\" placeholder=\"(555) 555-5555\" aria-invalid=\"false\">                                 </div>', ''),
(246, '272', '<div class=\"form-group\">                                          <input type=\"text\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(247, '273', '<div class=\"form-group\">\r\n                                        <input type=\"checkbox\" checked data-toggle=\"toggle\" name=\"answer\"  data-on=\"Yes\" data-off=\"No\">                                   \r\n                                     </div>', ''),
(248, '274', ' <div class=\"form-group\" id=\"rating-ability-wrapper\">\r\n                                   	    <input type=\"hidden\" id=\"selected_rating\" name=\"answer\" value=\"\" required=\"required\">\r\n                                   	    </label>\r\n                                   	    <h2 class=\"bold rating-header\" style=\"\">\r\n                                   	    <span class=\"selected-rating\">0</span><small> / 5</small>\r\n                                   	    </h2>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"1\" id=\"rating-star-1\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"2\" id=\"rating-star-2\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"3\" id=\"rating-star-3\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"4\" id=\"rating-star-4\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"5\" id=\"rating-star-5\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	</div>', ''),
(249, '275', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(250, '276', '<div class=\"form-group\">\r\n    <input type=\"url\" class=\"form-control\" name=\"answer\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(251, '277', '  <div class=\"form-group\">\r\n    <label for=\"exampleFormControlSelect1\">Example select</label>\r\n    <select class=\"form-control\" id=\"exampleFormControlSelect1\">\r\n      <option>1</option>\r\n      <option>2</option>\r\n      <option>3</option>\r\n      <option>4</option>\r\n      <option>5</option>\r\n    </select>\r\n  </div>', 'test1'),
(252, '278', '<div class=\"form-row\">\r\n                                        <div class=\"form-group col-md-6\">\r\n                                          <input type=\"number\" class=\"form-control\" id=\"inputEmail4\" placeholder=\"Card Number\">\r\n                                        </div>\r\n                                        <div class=\"form-group col-md-6\">\r\n                                          <input type=\"text\" class=\"form-control\" id=\"inputPassword4\" placeholder=\"MM/YY\">\r\n                                        </div>\r\n                                      </div>\r\n                                      <div class=\"form-group\">\r\n                                        <input type=\"text\" class=\"form-control\" id=\"inputAddress\" placeholder=\"Card Name\">\r\n                                      </div>', ''),
(253, '279', '<div class=\"form-group\">                                          <input type=\"date\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(254, '280', '<div class=\"form-group\">                                          <input type=\"date\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(255, '266', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', '2nd'),
(256, '266', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', '3rd'),
(257, '267', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', '2nd'),
(258, '267', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', '3rd'),
(259, '267', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', '4th');
INSERT INTO `survey_template_answer` (`id`, `survey_template_id`, `survey_template_choice`, `choices_label`) VALUES
(260, '277', '  <div class=\"form-group\">\r\n    <label for=\"exampleFormControlSelect1\">Example select</label>\r\n    <select class=\"form-control\" id=\"exampleFormControlSelect1\">\r\n      <option>1</option>\r\n      <option>2</option>\r\n      <option>3</option>\r\n      <option>4</option>\r\n      <option>5</option>\r\n    </select>\r\n  </div>', 'test2'),
(261, '277', '  <div class=\"form-group\">\r\n    <label for=\"exampleFormControlSelect1\">Example select</label>\r\n    <select class=\"form-control\" id=\"exampleFormControlSelect1\">\r\n      <option>1</option>\r\n      <option>2</option>\r\n      <option>3</option>\r\n      <option>4</option>\r\n      <option>5</option>\r\n    </select>\r\n  </div>', 'test3'),
(262, '281', '<div class=\"form-group\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(263, '282', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'test1'),
(264, '282', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'test2'),
(265, '282', '<div class=\"input-group mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'test3'),
(266, '283', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test1'),
(267, '283', '<div class=\"input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test2'),
(268, '284', '<div class=\"form-group\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(269, '285', '<div class=\"form-group\">                                          <input type=\"date\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(270, '286', '<div class=\"input-content form-group\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(271, '287', '<div class=\"form-group input-content\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(272, '288', '<div class=\"form-group input-content\">\r\n   \r\n    <input type=\"email\" class=\"form-control\" name=\"answer[]\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(273, '289', '<div class=\"form-group input-content\">                                          <input type=\"date\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(274, '290', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input form-control\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(275, '291', '<div class=\"input-content form-group\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(276, '292', '<div class=\"input-group input-content mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'test1'),
(277, '293', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test1'),
(278, '292', '<div class=\"input-group input-content mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'test2'),
(279, '294', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input form-control\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(280, '295', '', ''),
(281, '296', '', ''),
(282, '297', '', ''),
(283, '298', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test'),
(284, '298', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test'),
(285, '298', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test'),
(286, '299', '<div class=\"input-content form-group\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(287, '300', '<div class=\"form-group input-content\">                                          <input type=\"text\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(288, '301', '<div class=\"form-row input-content\">\r\n                                        <div class=\"form-group col-md-6\">\r\n                                          <input name=\"payment_answer_email\" type=\"number\" class=\"form-control\" id=\"inputEmail4\" placeholder=\"Card Number\">\r\n                                        </div>\r\n                                        <div class=\"form-group col-md-6\">\r\n                                          <input  name=\"payment_answer_date\"  type=\"text\" class=\"form-control\" id=\"inputPassword4\" placeholder=\"MM/YY\">\r\n                                        </div>\r\n                                      </div>\r\n                                      <div class=\"form-group\">\r\n                                        <input  name=\"payment_answer_name\"  type=\"text\" class=\"form-control\" id=\"inputAddress\" placeholder=\"Card Name\">\r\n                                      </div>', ''),
(289, '302', '', ''),
(290, '303', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test 1'),
(291, '303', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test 2'),
(292, '303', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test 3'),
(293, '303', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test 4'),
(294, '304', '<div class=\"form-group input-content\">\r\n   \r\n    <input type=\"email\" class=\"form-control\" name=\"answer[]\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(295, '305', '<div class=\"form-group input-content\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(296, '306', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input form-control\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(297, '307', '<div class=\"form-group input-content\">\r\n                                        <input type=\"checkbox\" checked data-toggle=\"toggle\" name=\"answer[]\"  data-on=\"Yes\" data-off=\"No\">                                   \r\n                                     </div>', ''),
(298, '308', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(299, '303', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'test 5'),
(300, '309', '', ''),
(301, '310', '<div class=\"form-row input-content\">\r\n                                        <div class=\"form-group col-md-6\">\r\n                                          <input name=\"payment_answer_email\" type=\"number\" class=\"form-control\" id=\"inputEmail4\" placeholder=\"Card Number\">\r\n                                        </div>\r\n                                        <div class=\"form-group col-md-6\">\r\n                                          <input  name=\"payment_answer_date\"  type=\"text\" class=\"form-control\" id=\"inputPassword4\" placeholder=\"MM/YY\">\r\n                                        </div>\r\n                                      </div>\r\n                                      <div class=\"form-group\">\r\n                                        <input  name=\"payment_answer_name\"  type=\"text\" class=\"form-control\" id=\"inputAddress\" placeholder=\"Card Name\">\r\n                                      </div>', ''),
(302, '311', '<div class=\"form-row input-content\">\r\n                                        <div class=\"form-group col-md-6\">\r\n                                          <input name=\"payment_answer_email\" type=\"number\" class=\"form-control\" id=\"inputEmail4\" placeholder=\"Card Number\">\r\n                                        </div>\r\n                                        <div class=\"form-group col-md-6\">\r\n                                          <input  name=\"payment_answer_date\"  type=\"text\" class=\"form-control\" id=\"inputPassword4\" placeholder=\"MM/YY\">\r\n                                        </div>\r\n                                      </div>\r\n                                      <div class=\"form-group\">\r\n                                        <input  name=\"payment_answer_name\"  type=\"text\" class=\"form-control\" id=\"inputAddress\" placeholder=\"Card Name\">\r\n                                      </div>', ''),
(303, '312', '<div class=\"container\">\r\n     \r\n    <h1>Codeigniter Stripe Payment Integration Example <br/> ItSolutionStuff.com</h1>\r\n     \r\n    <div class=\"row\">\r\n        <div class=\"col-md-6 col-md-offset-3\">\r\n            <div class=\"panel panel-default credit-card-box\">\r\n                <div class=\"panel-heading display-table\" >\r\n                    <div class=\"row display-tr\" >\r\n                        <h3 class=\"panel-title display-td\" >Payment Details</h3>\r\n                        <div class=\"display-td\" >                            \r\n                            <img class=\"img-responsive pull-right\" src=\"http://i76.imgup.net/accepted_c22e0.png\">\r\n                        </div>\r\n                    </div>                    \r\n                </div>\r\n                <div class=\"panel-body\">\r\n    \r\n                    <?php if($this->session->flashdata(\'success\')){ ?>\r\n                    <div class=\"alert alert-success text-center\">\r\n                            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>\r\n                            <p><?php echo $this->session->flashdata(\'success\'); ?></p>\r\n                        </div>\r\n                    <?php } ?>\r\n     \r\n                    <form role=\"form\" action=\"/stripePost\" method=\"post\" class=\"require-validation\"\r\n                                                     data-cc-on-file=\"false\"\r\n                                                    data-stripe-publishable-key=\"<?php echo $this->config->item(\'stripe_key\') ?>\"\r\n                                                    id=\"payment-form\">\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\"row\">\r\n                            <div class=\"col-xs-12\">\r\n                                <button class=\"btn btn-primary btn-lg btn-block\" type=\"submit\">Pay Now ($100)</button>\r\n                            </div>\r\n                        </div>\r\n                             \r\n                    </form>\r\n                </div>\r\n            </div>        \r\n        </div>\r\n    </div>\r\n         ', ''),
(304, '313', '<div class=\"container\">\r\n     \r\n    <h1>Codeigniter Stripe Payment Integration Example <br/> ItSolutionStuff.com</h1>\r\n     \r\n    <div class=\"row\">\r\n        <div class=\"col-md-6 col-md-offset-3\">\r\n            <div class=\"panel panel-default credit-card-box\">\r\n                <div class=\"panel-heading display-table\" >\r\n                    <div class=\"row display-tr\" >\r\n                        <h3 class=\"panel-title display-td\" >Payment Details</h3>\r\n                        <div class=\"display-td\" >                            \r\n                            <img class=\"img-responsive pull-right\" src=\"http://i76.imgup.net/accepted_c22e0.png\">\r\n                        </div>\r\n                    </div>                    \r\n                </div>\r\n                <div class=\"panel-body\">\r\n    \r\n                    <?php if($this->session->flashdata(\'success\')){ ?>\r\n                    <div class=\"alert alert-success text-center\">\r\n                            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>\r\n                            <p><?php echo $this->session->flashdata(\'success\'); ?></p>\r\n                        </div>\r\n                    <?php } ?>\r\n     \r\n                   \r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\"row\">\r\n                            <div class=\"col-xs-12\">\r\n                                <button class=\"btn btn-primary btn-lg btn-block\" type=\"submit\">Pay Now ($100)</button>\r\n                            </div>\r\n                        </div>\r\n                             \r\n                    \r\n                </div>\r\n            </div>        \r\n        </div>\r\n    </div>\r\n         ', ''),
(305, '314', ' <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>\r\n      ', ''),
(306, '315', '<div class=\"require-validation\" data-cc-on-file=\"false\"\r\n                                                    data-stripe-publishable-key=\"<?php echo $this->config->item(\'stripe_key\') ?>\"\r\n                                                    id=\"payment-form\">\r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>\r\n                        </div>', ''),
(307, '316', ' <div class=\"require-validation\" data-cc-on-file=\"false\"\r\n                                                    data-stripe-publishable-key=\"pk_test_wuRSMY1bhccBD6nNwKiMNG7t006YIzNwM8>\"\r\n                                                    id=\"payment-form\">\r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>\r\n                        </div>', ''),
(308, '317', ' <div class=\"require-validation\" data-cc-on-file=\"false\"\r\n                                                    data-stripe-publishable-key=\"pk_test_wuRSMY1bhccBD6nNwKiMNG7t006YIzNwM8>\"\r\n                                                    id=\"payment-form\">\r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>\r\n                        </div>', ''),
(309, '318', ' <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>', ''),
(310, '319', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(311, '320', ' <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>', ''),
(312, '321', ' <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>', ''),
(313, '322', ' <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>', '');
INSERT INTO `survey_template_answer` (`id`, `survey_template_id`, `survey_template_choice`, `choices_label`) VALUES
(314, '323', ' <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>', ''),
(315, '324', ' <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>', ''),
(316, '325', ' <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>', ''),
(317, '326', '', ''),
(318, '327', '<div class=\"input-group input-content mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(319, '328', ' <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>', ''),
(320, '329', '', ''),
(321, '330', '', ''),
(322, '331', '<div class=\"input-content form-group\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(323, '332', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', ''),
(324, '333', '', ''),
(325, '334', '<div class=\"input-content form-group\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(326, '335', '<div class=\"input-group input-content mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(327, '336', '', ''),
(328, '337', '', ''),
(329, '338', '<div class=\"form-group input-content\">\r\n                                        <input type=\"checkbox\" checked data-toggle=\"toggle\" name=\"answer[]\"  data-on=\"Yes\" data-off=\"No\">                                   \r\n                                     </div>', ''),
(330, '339', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input form-control\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(331, '340', '<div class=\"form-group input-content\">                                          <input type=\"text\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(332, '341', '<div class=\"form-group input-content\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(333, '342', '<div class=\"form-group input-content\">                                          <input type=\"text\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(334, '343', '', ''),
(335, '344', '', ''),
(336, '345', '', ''),
(337, '346', '<div class=\"form-group input-content\">                                          <input type=\"text\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(338, '347', '<div class=\"form-group input-content\">\r\n                                        <input type=\"checkbox\" checked data-toggle=\"toggle\" name=\"answer[]\"  data-on=\"Yes\" data-off=\"No\">                                   \r\n                                     </div>', ''),
(339, '348', '<div class=\"form-group input-content\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(340, '349', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input form-control\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(341, '350', '<div class=\"form-group input-content\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(342, '351', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input form-control\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(343, '352', '<div class=\"form-group input-content\">                                          <input type=\"text\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(344, '353', '<div class=\"form-group input-content\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(345, '354', ' 		<div class=\"form-group input-content\">                                   <input type=\"text\" class=\"form-control valid\" name=\"answer[]\" id=\"contact_phone\" placeholder=\"(555) 555-5555\" aria-invalid=\"false\">                                 </div>', ''),
(346, '355', '<div class=\"form-group input-content\">\r\n    <input type=\"url\" class=\"form-control\" name=\"answer[]\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(347, '356', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input form-control\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(348, '357', '', ''),
(349, '358', '<div class=\"form-group input-content\">                                          <input type=\"text\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(350, '359', '<div class=\"form-group input-content\">\r\n                                        <input type=\"checkbox\" checked data-toggle=\"toggle\" name=\"answer[]\"  data-on=\"Yes\" data-off=\"No\">                                   \r\n                                     </div>', ''),
(351, '360', '<div class=\"form-group input-content\">                                          <input type=\"text\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(352, '361', ' 		<div class=\"form-group input-content\">                                   <input type=\"text\" class=\"form-control valid\" name=\"answer[]\" id=\"contact_phone\" placeholder=\"(555) 555-5555\" aria-invalid=\"false\">                                 </div>', ''),
(353, '362', '<div class=\"form-group input-content\">\r\n   \r\n    <input type=\"email\" class=\"form-control\" name=\"answer[]\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(354, '363', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input form-control\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(355, '364', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input form-control\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', ''),
(356, '365', '<div class=\"form-group input-content\">\r\n   \r\n    <input type=\"email\" class=\"form-control\" name=\"answer[]\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', ''),
(357, '366', '<div class=\"form-group input-content\">                                          <input type=\"date\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(358, '367', '<div class=\"form-group input-content\">                                          <input type=\"text\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(359, '368', '', ''),
(360, '369', '<div class=\"input-content form-group\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(361, '370', ' 		<div class=\"form-group input-content\">                                   <input type=\"text\" class=\"form-control valid\" name=\"answer[]\" id=\"contact_phone\" placeholder=\"(555) 555-5555\" aria-invalid=\"false\">                                 </div>', ''),
(362, '371', '<div class=\"form-group input-content\">\r\n                                        <input type=\"checkbox\" checked data-toggle=\"toggle\" name=\"answer[]\"  data-on=\"Yes\" data-off=\"No\">                                   \r\n                                     </div>', ''),
(363, '372', '<div class=\"input-content form-group\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(364, '373', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'Car'),
(365, '373', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'Bike'),
(366, '373', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'Walk'),
(367, '374', '', ''),
(368, '375', ' <div class=\"form-group input-content\" id=\"rating-ability-wrapper\">\r\n                                   	    <input type=\"hidden\" id=\"selected_rating\" name=\"answer[]\" value=\"\" required=\"required\">\r\n                                   	    </label>\r\n                                   	    <h2 class=\"bold rating-header\" style=\"\">\r\n                                   	    <span class=\"selected-rating\">0</span><small> / 5</small>\r\n                                   	    </h2>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"1\" id=\"rating-star-1\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"2\" id=\"rating-star-2\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"3\" id=\"rating-star-3\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"4\" id=\"rating-star-4\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"5\" id=\"rating-star-5\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	</div>', ''),
(369, '376', '<div class=\"form-group input-content\">                                          <input type=\"text\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', ''),
(370, '377', '<div class=\"input-group input-content mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'A'),
(371, '377', '<div class=\"input-group input-content mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'E'),
(372, '377', '<div class=\"input-group input-content mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'all of the above'),
(373, '378', ' 		<div class=\"form-group input-content\">                                   <input type=\"text\" class=\"form-control valid\" name=\"answer[]\" id=\"contact_phone\" placeholder=\"(555) 555-5555\" aria-invalid=\"false\">                                 </div>', ''),
(374, '379', '<div class=\"form-group input-content\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(375, '380', '<div class=\"input-content form-group\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', ''),
(376, '381', '', ''),
(377, '382', '', ''),
(378, '383', '<div class=\"input-group input-content mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', ''),
(379, '384', '<div class=\"form-group input-content\">                                          <input type=\"text\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', '');

-- --------------------------------------------------------

--
-- Table structure for table `survey_template_questions`
--

CREATE TABLE `survey_template_questions` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `icon` text NOT NULL,
  `color` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_template_questions`
--

INSERT INTO `survey_template_questions` (`id`, `type`, `question`, `answer`, `icon`, `color`) VALUES
(1, 'Welcome Screen', 'Welcome Message', '', 'fa fa-clone', 'rgb(150, 206, 220)'),
(2, 'Long Text', '', '<div class=\"input-content form-group\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', 'fa fa-align-justify', 'rgb(226, 109, 90)'),
(3, 'Single Choice', '', '<div class=\"input-group input-content mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'fa fa-circle', 'rgb(116, 164, 191)'),
(4, 'Multiple Choice', '', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'fa fa-check', 'rgb(79, 169, 179)'),
(5, 'Email', '', '<div class=\"form-group input-content\">\r\n   \r\n    <input type=\"email\" class=\"form-control\" name=\"answer[]\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', 'fa fa-envelope', 'rgb(58, 118, 133)'),
(6, 'Number', '', '<div class=\"form-group input-content\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', 'fa fa-sort-numeric-up-alt', 'rgb(224, 79, 120)'),
(7, 'Image', '', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input form-control\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', 'fa fa-images', 'rgb(160, 134, 196)'),
(8, 'Phone Number', '', ' 		<div class=\"form-group input-content\">                                   <input type=\"text\" class=\"form-control valid\" name=\"answer[]\" id=\"contact_phone\" placeholder=\"(555) 555-5555\" aria-invalid=\"false\">                                 </div>', 'fa fa-phone-square', 'rgb(63, 196, 106)'),
(9, 'Short Text', '', '<div class=\"form-group input-content\">                                          <input type=\"text\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', 'fa fa-grip-lines', 'rgb(255, 186, 73)'),
(11, 'Yes/No', '', '<div class=\"form-group input-content\">\r\n                                        <input type=\"checkbox\" checked data-toggle=\"toggle\" name=\"answer[]\"  data-on=\"Yes\" data-off=\"No\">                                   \r\n                                     </div>', 'fa fa-adjust', 'rgb(191, 57, 91)'),
(12, 'Rating', '', ' <div class=\"form-group input-content\" id=\"rating-ability-wrapper\">\r\n                                   	    <input type=\"hidden\" id=\"selected_rating\" name=\"answer[]\" value=\"\" required=\"required\">\r\n                                   	    </label>\r\n                                   	    <h2 class=\"bold rating-header\" style=\"\">\r\n                                   	    <span class=\"selected-rating\">0</span><small> / 5</small>\r\n                                   	    </h2>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"1\" id=\"rating-star-1\">\r\n                                   	        <i class=\"fa fa-star text-white\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"2\" id=\"rating-star-2\">\r\n                                   	        <i class=\"fa fa-star text-white\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"3\" id=\"rating-star-3\">\r\n                                   	        <i class=\"fa fa-star text-white\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"4\" id=\"rating-star-4\">\r\n                                   	        <i class=\"fa fa-star text-white\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"5\" id=\"rating-star-5\">\r\n                                   	        <i class=\"fa fa-star text-white\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	</div>', 'fa fa-star', 'rgb(243, 205, 89)'),
(13, 'Statement', '', '<div class=\"form-group input-content\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', 'fa fa-quote-right', 'rgb(148, 174, 137)'),
(14, 'Website', '', '<div class=\"form-group input-content\">\r\n    <input type=\"url\" class=\"form-control\" name=\"answer[]\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', 'fa fa-link', 'rgb(186, 194, 108)'),
(15, 'Dropdown', '', '  <div class=\"form-group input-content\">\r\n    <label for=\"exampleFormControlSelect1\">Example select</label>\r\n    <select class=\"form-control\" id=\"exampleFormControlSelect1\">\r\n      <option>1</option>\r\n      <option>2</option>\r\n      <option>3</option>\r\n      <option>4</option>\r\n      <option>5</option>\r\n    </select>\r\n  </div>', 'fa fa-chevron-down', 'rgb(88, 69, 122)'),
(16, 'Payment', '', ' <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>', 'fa fa-credit-card', 'rgb(69, 122, 83)'),
(17, 'Date', '', '<div class=\"form-group input-content\">                                          <input type=\"date\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', 'fa fa-calendar-alt', 'rgb(240, 159, 151)'),
(18, 'File', '', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', 'fa fa-folder', 'rgb(60, 105, 151)'),
(19, 'Closing Screen', 'Closing Screen', '', 'fa fa-clone', 'rgb(158, 118, 233)');

-- --------------------------------------------------------

--
-- Table structure for table `survey_themes`
--

CREATE TABLE `survey_themes` (
  `sth_rec_no` int(12) NOT NULL,
  `sth_theme_name` varchar(64) NOT NULL,
  `sth_primary_color` varchar(32) NOT NULL COMMENT 'value should be in hex format.',
  `sth_secondary_color` varchar(32) NOT NULL,
  `sth_tertiary_color` varchar(32) NOT NULL,
  `sth_success_color` varchar(32) NOT NULL,
  `sth_warning_color` varchar(32) NOT NULL,
  `sth_info_color` varchar(32) NOT NULL,
  `sth_danger_color` varchar(32) NOT NULL,
  `sth_text_color` varchar(32) NOT NULL,
  `sth_dark_text_color` varchar(32) NOT NULL,
  `sth_primary_image` varchar(32) NOT NULL,
  `sth_primary_image_class` varchar(128) NOT NULL,
  `sth_is_visible` tinyint(1) NOT NULL,
  `company_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_themes`
--

INSERT INTO `survey_themes` (`sth_rec_no`, `sth_theme_name`, `sth_primary_color`, `sth_secondary_color`, `sth_tertiary_color`, `sth_success_color`, `sth_warning_color`, `sth_info_color`, `sth_danger_color`, `sth_text_color`, `sth_dark_text_color`, `sth_primary_image`, `sth_primary_image_class`, `sth_is_visible`, `company_id`) VALUES
(3, 'Revolution', '#247c70', '#c5823a', '#c5603a', '#07cd14', '#ff7e08', '#0499e9', '#ff0000', '#ffffff', '#000000', 'revolution.jpg', 'filter: brightness(0.5) grayscale(0.8);', 1, 0),
(4, 'Home', '#058be9', '#ffb300', '#FC400A', '#07cd14', '#ff7e08', '#0499e9', '#ff0000', '#ffffff', '#000000', 'girl-with-camera.jpg', '', 1, 0),
(5, 'Crisia', '#027494', '#EFB700', '#E3001F', '#07cd14', '#ff7e08', '#0499e9', '#ff0000', '#ffffff', '#000000', 'lady-facemask-city.jpg', '', 1, 0),
(6, 'Matter', '#AAAA39', '#277554', '#AA7939', '#07cd14', '#ff7e08', '#0499e9', '#ff0000', '#ffffff', '#000000', 'gray-office.jpg', '', 1, 0),
(7, 'Darkrise', '#642C81', '#C1793C', '#247474', '#07cd14', '#ff7e08', '#0499e9', '#ff0000', '#ffffff', '#000000', 'orange-moon.jpg', '', 1, 0),
(8, 'Work', '#9d344b', '#257059', '#8aa236', '#00bc0c', '#ef6c00', '#045899', '#ef0000', '#ffffff', '#222222', 'work.jpg', '', 0, 0),
(9, 'Astra', '#9d344b', '#257059', '#8aa236', '#00bc0c', '#ef6c00', '#045899', '#ef0000', '#ffffff', '#222222', 'astra.jpg', '', 0, 0),
(10, '', '#9d344b', '#257059', '#8aa236', '#00bc0c', '#ef6c00', '#045899', '#ef0000', '#ffffff', '#222222', '.jpg', '', 0, 0),
(11, 'Preparation', '#9d344b', '#257059', '#8aa236', '#00bc0c', '#ef6c00', '#045899', '#ef0000', '#ffffff', '#222222', 'preparation.jpg', '', 0, 0),
(12, 'Rays', '#9d344b', '#257059', '#8aa236', '#00bc0c', '#ef6c00', '#045899', '#ef0000', '#ffffff', '#222222', 'rays.jpg', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `survey_workspaces`
--

CREATE TABLE `survey_workspaces` (
  `id` int(9) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `users` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `survey_workspaces`
--

INSERT INTO `survey_workspaces` (`id`, `name`, `users`) VALUES
(1, 'FICO HEROES ', '[0]'),
(2, 'ADI', '[0]'),
(3, 'Credit Repair', '[0]'),
(4, 'New workspace', '[0]'),
(5, 'my space', '[0]'),
(6, 'FICO HEROES ', '[0]'),
(7, 'asdf', '[0]');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estimated_date_complete` date DEFAULT NULL,
  `actual_date_complete` date DEFAULT NULL,
  `task_color` enum('#4cb052','#d96666','#e67399','#b373b3','#8c66d9','#668cd9','#59bfb3','#65ad89','#f2a640') NOT NULL,
  `status_id` int(11) NOT NULL,
  `priority` enum('Low','Medium','High') NOT NULL,
  `company_id` int(11) NOT NULL,
  `view_count` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `subject`, `description`, `created_by`, `date_created`, `estimated_date_complete`, `actual_date_complete`, `task_color`, `status_id`, `priority`, `company_id`, `view_count`) VALUES
(3, 'Do something cool', 'If you dont do something cool, your are boring', 2, '2020-06-12 05:00:00', '2020-06-15', NULL, '#4cb052', 1, 'Low', 1, 0),
(4, 'Clean office', 'calendar is not current.  need clipboard shortcut', 2, '2020-06-15 05:00:00', '2020-07-29', NULL, '#4cb052', 1, 'Low', 1, 0),
(10, 'test4', 'testv4', 2, '2020-08-30 17:53:51', '2020-08-13', NULL, '#4cb052', 1, 'Low', 1, 0),
(6, 'File Vault', '1. Fix the undefined issue in delete file or folder pop up', 15, '2020-08-06 12:34:26', '2020-08-07', NULL, '#4cb052', 5, 'Low', 1, 6),
(7, 'TaskHub', '1. Make sure that viewing of task should only be set as viewed only for the user assigned to the task', 15, '2020-08-06 12:38:26', '2020-08-07', NULL, '#4cb052', 1, 'Low', 1, 3),
(9, 'Test Task from iOS', 'Lorem ipsum dolor', 2, '2020-08-28 00:30:54', '2020-08-30', NULL, '#4cb052', 1, 'High', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tasks_participants`
--

CREATE TABLE `tasks_participants` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_assigned` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks_participants`
--

INSERT INTO `tasks_participants` (`id`, `task_id`, `user_id`, `is_assigned`) VALUES
(22, 4, 16, 1),
(29, 10, 2, 1),
(28, 10, 22, 0),
(19, 3, 4, 0),
(32, 6, 15, 1),
(31, 6, 14, 0),
(30, 6, 23, 0),
(26, 7, 23, 0),
(27, 9, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks_status`
--

CREATE TABLE `tasks_status` (
  `status_id` int(11) UNSIGNED NOT NULL,
  `status_text` varchar(255) NOT NULL,
  `status_color` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks_status`
--

INSERT INTO `tasks_status` (`status_id`, `status_text`, `status_color`) VALUES
(1, 'New', '#E0FFFF'),
(2, 'On Going', '#FFFACD'),
(3, 'On Hold', '#D3D3D3'),
(4, 'Resumed', '#FFFACD'),
(5, 'For Evaluation', '#E6E6FA'),
(6, 'Complete', '#90EE90'),
(7, 'ReOpened', '#E0FFFF');

-- --------------------------------------------------------

--
-- Table structure for table `tasks_updates`
--

CREATE TABLE `tasks_updates` (
  `update_id` int(11) UNSIGNED NOT NULL,
  `task_id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `performed_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks_updates`
--

INSERT INTO `tasks_updates` (`update_id`, `task_id`, `notes`, `performed_by`, `date_updated`) VALUES
(3, 4, 'Modified:\n- Assignee\n', 2, '2020-06-18 06:16:47'),
(4, 3, 'Modified:\n- Assignee\n', 2, '2020-06-18 06:20:10'),
(5, 3, 'Modified:\n- Assignee\n', 2, '2020-06-18 06:20:31'),
(6, 4, 'Modified:\n- Subject\n- Description\n- Estimated Date of Completion\n- Assignee\n', 2, '2020-07-20 09:13:25'),
(7, 6, 'Fixed issue', 15, '2020-09-03 07:31:06'),
(8, 6, 'Modified:\n- Status\n', 15, '2020-09-03 07:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `tax_rates`
--

CREATE TABLE `tax_rates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate` double(5,2) NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tax_rates`
--

INSERT INTO `tax_rates` (`id`, `name`, `rate`, `is_default`, `company_id`) VALUES
(1, 'Standard Rate', 7.50, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_attendance`
--

CREATE TABLE `timesheet_attendance` (
  `id` int(11) NOT NULL,
  `week_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift_duration` decimal(10,2) NOT NULL,
  `break_duration` decimal(10,2) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_logs`
--

CREATE TABLE `timesheet_logs` (
  `id` int(11) NOT NULL,
  `attendance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` int(11) DEFAULT NULL,
  `entry_type` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_code` int(11) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_settings`
--

CREATE TABLE `timesheet_settings` (
  `id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `total_duration_w` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `time_record`
--

CREATE TABLE `time_record` (
  `timesheet_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `action` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'In\\nOut\\njob-in\\nJob-out\\nlunch-in\\nlunch-out',
  `timestamp` datetime DEFAULT NULL,
  `entry_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'manual\\nclock\\nadjusted',
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'pending, rejected, approved',
  `approved_by` int(11) NOT NULL COMMENT 'link to employee_id',
  `company_id` int(11) DEFAULT NULL,
  `job_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `time_record`
--

INSERT INTO `time_record` (`timesheet_id`, `employees_id`, `action`, `timestamp`, `entry_type`, `status`, `approved_by`, `company_id`, `job_code`, `notes`) VALUES
(1, 2, 'Clock In', '2020-07-24 09:54:00', 'Normal', '', 0, NULL, NULL, NULL),
(2, 2, 'Clock Out', '2020-07-24 09:54:00', 'Normal', '', 0, NULL, NULL, NULL),
(3, 10, 'Clock In', '2020-07-24 09:54:00', 'Normal', '', 0, NULL, NULL, NULL),
(4, 10, 'Clock Out', '2020-07-26 19:25:00', 'Normal', '', 0, NULL, NULL, NULL),
(5, 11, 'Clock In', '2020-07-27 10:58:00', 'Normal', '', 0, NULL, NULL, NULL),
(6, 11, 'Clock Out', '2020-07-28 16:34:00', 'Normal', '', 0, NULL, NULL, NULL),
(7, 12, 'Clock In', '2020-07-28 21:32:00', 'Normal', '', 0, NULL, NULL, NULL),
(8, 2, 'Clock Out', '2020-07-28 21:33:00', 'Normal', '', 0, NULL, NULL, NULL),
(9, 2, 'Clock In', '2020-07-29 09:04:00', 'Normal', '', 0, NULL, NULL, NULL),
(10, 12, 'Clock Out', '2020-07-29 19:20:00', 'Normal', '', 0, NULL, NULL, NULL),
(11, 2, 'Clock Out', '2020-08-01 14:57:00', 'Normal', '', 0, NULL, NULL, NULL),
(12, 2, 'Clock In', '2020-08-05 09:09:00', 'Normal', '', 0, NULL, NULL, NULL),
(13, 10, 'Clock In', '2020-08-05 09:09:00', 'Normal', '', 0, NULL, NULL, NULL),
(14, 11, 'Clock In', '2020-08-05 09:09:00', 'Normal', '', 0, NULL, NULL, NULL),
(15, 12, 'Clock In', '2020-08-05 09:09:00', 'Normal', '', 0, NULL, NULL, NULL),
(16, 13, 'Clock In', '2020-08-05 09:09:00', 'Normal', '', 0, NULL, NULL, NULL),
(17, 14, 'Clock In', '2020-08-05 09:09:00', 'Normal', '', 0, NULL, NULL, NULL),
(18, 2, 'Clock Out', '2020-08-05 18:38:00', 'Normal', '', 0, NULL, NULL, NULL),
(19, 11, 'Clock Out', '2020-08-05 18:38:00', 'Normal', '', 0, NULL, NULL, NULL),
(20, 10, 'Clock Out', '2020-08-05 18:38:00', 'Normal', '', 0, NULL, NULL, NULL),
(21, 2, 'Clock In', '2020-08-05 18:39:00', 'Normal', '', 0, NULL, NULL, NULL),
(22, 2, 'Clock Out', '2020-08-05 18:39:00', 'Normal', '', 0, NULL, NULL, NULL),
(23, 2, 'Clock In', '2020-08-06 14:09:00', 'Normal', '', 0, NULL, NULL, NULL),
(24, 10, 'Clock In', '2020-08-06 14:09:00', 'Normal', '', 0, NULL, NULL, NULL),
(25, 2, 'Clock Out', '2020-08-06 18:29:00', 'Normal', '', 0, NULL, NULL, NULL),
(26, 10, 'Clock Out', '2020-08-06 20:54:00', 'Normal', '', 0, NULL, NULL, NULL),
(27, 2, 'Clock In', '2020-08-11 23:40:00', 'Normal', '', 0, NULL, NULL, NULL),
(28, 2, 'Clock Out', '2020-08-11 23:45:00', 'Normal', '', 0, NULL, NULL, NULL),
(29, 2, 'Clock In', '2020-08-12 09:52:00', 'Normal', '', 0, NULL, NULL, NULL),
(30, 10, 'Clock In', '2020-08-12 09:52:00', 'Normal', '', 0, NULL, NULL, NULL),
(31, 10, 'Clock Out', '2020-08-12 09:53:00', 'Normal', '', 0, NULL, NULL, NULL),
(32, 10, 'Clock Out', '2020-08-12 09:53:00', 'Normal', '', 0, NULL, NULL, NULL),
(33, 11, 'Clock In', '2020-08-12 09:53:00', 'Normal', '', 0, NULL, NULL, NULL),
(34, 2, 'Clock Out', '2020-08-12 20:58:00', 'Normal', '', 0, NULL, NULL, NULL),
(35, 2, 'Clock In', '2020-08-18 23:38:00', 'Normal', '', 0, NULL, NULL, NULL),
(36, 10, 'Clock In', '2020-08-18 23:38:00', 'Normal', '', 0, NULL, NULL, NULL),
(37, 11, 'Clock In', '2020-08-18 23:38:00', 'Normal', '', 0, NULL, NULL, NULL),
(38, 12, 'Clock In', '2020-08-18 23:38:00', 'Normal', '', 0, NULL, NULL, NULL),
(39, 13, 'Clock In', '2020-08-18 23:38:00', 'Normal', '', 0, NULL, NULL, NULL),
(40, 10, 'Clock In', '2020-08-20 21:13:00', 'Normal', '', 0, NULL, NULL, NULL),
(41, 2, 'Clock In', '2020-08-20 21:13:00', 'Normal', '', 0, NULL, NULL, NULL),
(42, 2, 'Clock Out', '2020-08-20 22:49:00', 'Normal', '', 0, NULL, NULL, NULL),
(43, 11, 'Clock In', '2020-08-20 22:49:00', 'Normal', '', 0, NULL, NULL, NULL),
(44, 10, 'Clock Out', '2020-08-20 22:49:00', 'Normal', '', 0, NULL, NULL, NULL),
(45, 2, 'Clock In', '2020-08-21 09:31:00', 'Normal', '', 0, NULL, NULL, NULL),
(46, 10, 'Clock In', '2020-08-21 09:31:00', 'Normal', '', 0, NULL, NULL, NULL),
(47, 2, 'Clock Out', '2020-08-21 09:31:00', 'Normal', '', 0, NULL, NULL, NULL),
(48, 10, 'Clock Out', '2020-08-21 09:31:00', 'Normal', '', 0, NULL, NULL, NULL),
(49, 11, 'Clock In', '2020-08-21 09:31:00', 'Normal', '', 0, NULL, NULL, NULL),
(50, 2, 'Clock In', '2020-08-23 22:50:00', 'Normal', '', 0, NULL, NULL, NULL),
(51, 10, 'Clock In', '2020-08-23 22:50:00', 'Normal', '', 0, NULL, NULL, NULL),
(52, 11, 'Clock In', '2020-08-23 22:50:00', 'Normal', '', 0, NULL, NULL, NULL),
(53, 11, 'Clock In', '2020-08-23 22:50:00', 'Normal', '', 0, NULL, NULL, NULL),
(54, 12, 'Clock In', '2020-08-23 22:50:00', 'Normal', '', 0, NULL, NULL, NULL),
(55, 12, 'Clock In', '2020-08-23 22:51:00', 'Normal', '', 0, NULL, NULL, NULL),
(56, 13, 'Clock In', '2020-08-23 22:51:00', 'Normal', '', 0, NULL, NULL, NULL),
(57, 14, 'Clock In', '2020-08-23 22:51:00', 'Normal', '', 0, NULL, NULL, NULL),
(58, 15, 'Clock In', '2020-08-23 22:51:00', 'Normal', '', 0, NULL, NULL, NULL),
(59, 16, 'Clock In', '2020-08-23 22:51:00', 'Normal', '', 0, NULL, NULL, NULL),
(60, 17, 'Clock In', '2020-08-23 22:51:00', 'Normal', '', 0, NULL, NULL, NULL),
(61, 17, 'Clock In', '2020-08-23 22:51:00', 'Normal', '', 0, NULL, NULL, NULL),
(62, 18, 'Clock In', '2020-08-23 22:51:00', 'Normal', '', 0, NULL, NULL, NULL),
(63, 18, 'Clock In', '2020-08-23 22:51:00', 'Normal', '', 0, NULL, NULL, NULL),
(64, 2, 'Clock In', '2020-08-24 20:44:00', 'Normal', '', 0, NULL, NULL, NULL),
(65, 2, 'Clock Out', '2020-08-24 20:44:00', 'Normal', '', 0, NULL, NULL, NULL),
(66, 2, 'Clock Out', '2020-08-24 20:45:00', 'Normal', '', 0, NULL, NULL, NULL),
(67, 10, 'Clock In', '2020-08-24 20:45:00', 'Normal', '', 0, NULL, NULL, NULL),
(68, 10, 'Clock Out', '2020-08-24 20:46:00', 'Normal', '', 0, NULL, NULL, NULL),
(69, 2, 'Clock Out', '2020-08-24 20:47:00', 'Normal', '', 0, NULL, NULL, NULL),
(70, 2, 'Clock In', '2020-08-27 23:32:00', 'Normal', '', 0, NULL, NULL, NULL),
(71, 2, 'Clock Out', '2020-08-27 23:32:00', 'Normal', '', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ts_settings_day`
--

CREATE TABLE `ts_settings_day` (
  `id` int(11) NOT NULL,
  `ts_settings_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ts_settings_day`
--

INSERT INTO `ts_settings_day` (`id`, `ts_settings_id`, `user_id`, `day`, `start_date`, `start_time`, `end_time`, `duration`) VALUES
(6, 4, 0, 'Monday', '2020-09-07', '00:00:00', '06:00:00', 6),
(16, 14, 0, 'Monday', '2020-09-07', '01:00:00', '03:00:00', 2),
(25, 21, 2, 'Tuesday', '2020-09-08', '01:00:00', '03:00:00', 2),
(26, 21, 2, 'Wednesday', '2020-09-09', '01:00:00', '06:00:00', 5),
(28, 4, 0, 'Tuesday', '2020-09-08', '03:00:00', '12:00:00', 9),
(32, 14, 0, 'Tuesday', '2020-09-08', '01:00:00', '05:00:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ts_settings_total_day`
--

CREATE TABLE `ts_settings_total_day` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `day` varchar(100) NOT NULL,
  `total_duration` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ts_total_week_duration`
--

CREATE TABLE `ts_total_week_duration` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total_duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ts_weekly_total_shift`
--

CREATE TABLE `ts_weekly_total_shift` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `week_of` date NOT NULL,
  `total_shift` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `FName` varchar(255) DEFAULT NULL,
  `LName` varchar(255) DEFAULT NULL,
  `username` varchar(35) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_plain` varchar(255) NOT NULL COMMENT 'column will be removed',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` int(11) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `about` text NOT NULL,
  `comments` text NOT NULL,
  `notify_email` tinyint(1) NOT NULL DEFAULT '0',
  `notify_sms` tinyint(1) NOT NULL DEFAULT '0',
  `employment_type` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `date_hired` date NOT NULL,
  `pay_type` varchar(255) NOT NULL,
  `pay_rate` decimal(8,2) NOT NULL,
  `travel_rate` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `profile_img` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `img_type` text NOT NULL,
  `profile_img_type` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `menus` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FName`, `LName`, `username`, `email`, `password`, `password_plain`, `last_login`, `role`, `reset_token`, `status`, `about`, `comments`, `notify_email`, `notify_sms`, `employment_type`, `birthdate`, `date_hired`, `pay_type`, `pay_rate`, `travel_rate`, `created_at`, `updated_at`, `profile_img`, `company_id`, `img_type`, `profile_img_type`, `address`, `phone`, `mobile`, `menus`) VALUES
(2, 'Lauren', 'Williams', 'Lauren', 'support@nsmartrac.com', '1be0222750aaf3889ab95b5d593ba12e4ff1046474702d6b4779f4b527305b23', 'Password2', '2020-09-22 14:09:21', 1, '$2y$10$QHAQRM8x5JmAkGg6lnXDlOXU9mjDyRKEwdA9XQ04OoRrCF15X4VTG', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '0000-00-00 00:00:00', '2020-09-22 14:21:51', 0, 1, 'jpg', 0, 0, '0', '', 'Work Order, Tasks, Bulletin, Wizard, Files Vault, Trac360, Reports, Estimates, Accounting, Marketing, Leads, Invoices, Cost Estimator, Route Planner, Customers, Collage Maker, Virtual Estimator, Inventory, Quick Links, Business Contacts, Employees, Time Clock, eSign, Calendar'),
(5, 'Tommy', 'N', 'tommy', 'tommy@nsmartrac.com', '2a931915c226b6fa050191e0e32f44a9882d76a595bbf7de63109fdc6b2ec416', 'sony@123', '2020-08-28 14:09:24', 1, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '0000-00-00 00:00:00', '2020-08-28 14:09:24', NULL, 2, '', 0, 0, '', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(6, 'Jon', 'C', 'jonc', 'jonc@nsmartrac.com', '2fcc60a9f1471784dfa4407e8bcdff01cca9bd27a9174ad3177f1ba2bb65850c', 'sony@123', '2020-09-22 04:09:53', 1, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '0000-00-00 00:00:00', '2020-09-22 04:53:28', NULL, 2, '', 0, 0, '', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(10, 'Stephen', 'Cabalida', 'stephen', 'stephencabalida80@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-09-13 07:22:39', 38, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-07-06 21:55:34', '2020-09-13 07:22:39', NULL, 1, 'jpg', 0, 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(11, 'Artemeo', 'Alberca', 'artemeo', 'jeykell125@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-09-20 10:09:17', 38, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-07-06 22:01:38', '2020-09-20 10:17:46', NULL, 1, 'jpg', 0, 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(12, 'Jerry ', 'Tiu', 'jerry', 'rarecandy06@gmail.co', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-09-16 13:09:38', 22, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-07-06 22:03:08', '2020-09-16 13:38:10', NULL, 1, 'jpg', 0, 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(13, 'Welyelf', 'Hisula', 'welyelf', 'wrhisula1123@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-09-12 13:25:58', 22, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-07-06 22:04:46', '2020-09-12 13:25:58', NULL, 1, 'jpg', 0, 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(14, 'Jonah ', 'Pacas-Abanil', 'jonah', 'jonahpacas.cpe@icloud.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-09-12 13:26:48', 22, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-07-06 22:08:07', '2020-09-12 13:26:48', NULL, 1, 'jpg', 0, 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(15, 'Gil', 'Francis Carillo', 'gil', 'gilfranciscarillo@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-09-16 14:09:01', 22, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-07-06 22:10:45', '2020-09-16 14:01:21', NULL, 1, 'jpg', 0, 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(16, 'Neil', 'Diagdal', 'neil', 'neildiagdal@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-08-28 14:09:24', 6, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-07-06 22:12:20', '2020-08-28 14:09:24', NULL, 1, '', 0, 0, '', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(17, 'Bryann', 'Revina', 'bryann', 'bryann.revina03@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-09-12 13:28:50', 22, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-07-06 22:13:35', '2020-09-12 13:28:50', NULL, 1, 'jpg', 0, 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(18, 'Gene', 'Terry Rejano', 'gene', 'geneterryrejano@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-08-28 14:09:24', 6, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-07-06 22:17:19', '2020-08-28 14:09:24', NULL, 1, '', 0, 0, '', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(22, 'Nik', 'Estrada', 'nik', 'logicalcodes09@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-09-12 13:29:35', 22, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-07-07 04:02:46', '2020-09-12 13:29:35', NULL, 1, 'jpg', 0, 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(23, 'Tommy', 'Nguyen', '', 'sales@nsmartrac.com', '', '', '2020-08-28 14:09:24', 0, '', 1, '', '', 0, 1, '', '1971-11-06', '2020-07-25', '', 1.00, 12.00, '2020-07-25 20:37:08', '2020-08-28 14:09:24', 0, 1, '', 0, 0, '', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(24, 'fdf', 'dfdf', 'bryann@gmail.com', 'bryann@gmail.com', '496ab265df01fa02e5e0bacbd0a7977f783598cb79552ebad0601c8b19ed0aae', 'dfdsfd', '2020-09-15 02:41:19', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-09-15 02:41:19', '0000-00-00 00:00:00', NULL, 1, '', 0, 0, '', '', NULL),
(25, 'test bryan5', 'test last', 'testbryann5@gmail.com', 'testbryann5@gmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', 'abc123', '2020-09-15 08:26:37', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-09-15 08:26:37', '0000-00-00 00:00:00', NULL, 2, '', 0, 0, '', '', NULL),
(26, 'test bryan 5', 'test last', 'testbryab5@gmail.com', 'testbryab5@gmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', 'abc123', '2020-09-15 08:35:59', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', 0.00, 0.00, '2020-09-15 08:35:59', '0000-00-00 00:00:00', NULL, 3, '', 0, 0, '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_break`
--

CREATE TABLE `user_break` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `break_end_time` datetime NOT NULL,
  `duration` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_break`
--

INSERT INTO `user_break` (`id`, `user_id`, `date`, `break_end_time`, `duration`, `status`) VALUES
(37, 11, '2020-09-13', '1969-12-31 18:00:00', '60:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `details_id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_docfile`
--

CREATE TABLE `user_docfile` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `docFile` varchar(255) DEFAULT NULL COMMENT 'string array to be separated with comma',
  `type` enum('Single','Multiple') NOT NULL COMMENT 'single or multiple signers',
  `status` enum('Action Required','Waiting for Others','Completed','Draft','Canceled') NOT NULL DEFAULT 'Draft',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_docfile`
--

INSERT INTO `user_docfile` (`id`, `user_id`, `name`, `docFile`, `type`, `status`, `created_at`, `updated_at`, `company_id`) VALUES
(1, 2, 'Sample.pdf', '1600701184076_Sample.pdf', 'Single', 'Action Required', '2020-09-21 15:13:07', '2020-09-21 15:13:20', 1),
(2, 2, 'Get Started with Dropbox.pdf', '1600701783240_Get Started with Dropbox.pdf', 'Multiple', 'Draft', '2020-09-21 15:23:14', '2020-09-22 02:20:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_docfile_recipients`
--

CREATE TABLE `user_docfile_recipients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `docfile_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `role` enum('Needs to Sign','Signs in Person','Receives a copy') NOT NULL,
  `host_name` varchar(255) DEFAULT NULL,
  `host_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_docfile_recipients`
--

INSERT INTO `user_docfile_recipients` (`id`, `user_id`, `docfile_id`, `name`, `email`, `role`, `host_name`, `host_email`) VALUES
(1, 2, 1, 'Lauren Williams', 'support@nsmartrac.com', 'Needs to Sign', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_docphoto`
--

CREATE TABLE `user_docphoto` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `docphoto` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_docphoto`
--

INSERT INTO `user_docphoto` (`id`, `user_id`, `docphoto`, `status`, `created_at`, `updated_at`, `company_id`) VALUES
(5, 2, '1592465173_4912642_team-member-5.jpg', 1, '2020-06-18 07:26:13', NULL, 0),
(6, 2, '1592465180_8407874_team-member-5.jpg', 1, '2020-06-18 07:26:20', NULL, 0),
(7, 2, '1592491155_1160425_', 1, '2020-06-18 14:39:15', NULL, 0),
(8, 2, '1592923806_7740182_', 1, '2020-06-23 14:50:06', NULL, 0),
(9, 2, '1596364658_7137590_', 1, '2020-08-02 10:37:38', NULL, 0),
(10, 2, '1598240090_4755629_', 1, '2020-08-24 03:34:51', NULL, 0),
(11, 2, '1598240108_585557_images.jpg', 1, '2020-08-24 03:35:09', NULL, 0),
(12, 2, '1598255490_408271_team-member-5.jpg', 1, '2020-08-24 07:51:30', NULL, 0),
(13, 2, '1598334588_9376500_team-member-5.jpg', 1, '2020-08-25 05:49:48', NULL, 0),
(14, 11, '1600597534_7495489_page_image (6).png', 1, '2020-09-20 10:25:34', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_sign`
--

CREATE TABLE `user_sign` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `signature_image` longtext,
  `initial_image` longtext,
  `show_identity` tinyint(1) NOT NULL DEFAULT '0',
  `display_company_title` tinyint(1) NOT NULL DEFAULT '0',
  `display_address_phone` tinyint(1) NOT NULL DEFAULT '0',
  `display_usage_history` tinyint(1) NOT NULL DEFAULT '0',
  `date_format_for_signers` enum('5/31/2020','31-05-20','31-05-2020','May-31-2020','2020-05-31','May 31, 2020') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sign`
--

INSERT INTO `user_sign` (`id`, `user_id`, `signature_image`, `initial_image`, `show_identity`, `display_company_title`, `display_address_phone`, `display_usage_history`, `date_format_for_signers`, `status`, `created_at`, `updated_at`, `company_id`) VALUES
(1, 2, NULL, NULL, 1, 1, 1, 1, '5/31/2020', 1, '2020-08-13 03:40:59', '2020-09-04 16:04:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `business_URL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suite_unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `vendor_name`, `status`, `business_URL`, `email`, `mobile`, `phone`, `street_address`, `suite_unit`, `city`, `postal_code`, `state`, `company_id`) VALUES
(2, 'Test Vendor', NULL, NULL, 'test.vendor@gmail.com', '', '(888) 888-8888', '', '', 'Pensacola', '', 'FL', 1),
(3, 'Honeywell', NULL, NULL, 'honeywell.com', '', '', '', '', '', '', '', 1),
(4, 'Alarm.com', NULL, NULL, 'alarm.com', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_has_users`
--

CREATE TABLE `vendor_has_users` (
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='contacts';

-- --------------------------------------------------------

--
-- Table structure for table `wizard_apps`
--

CREATE TABLE `wizard_apps` (
  `id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_img` varchar(255) NOT NULL,
  `show_app` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= hide , 1= show',
  `defaultdata` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wizard_apps`
--

INSERT INTO `wizard_apps` (`id`, `app_name`, `app_img`, `show_app`, `defaultdata`) VALUES
(26, 'Gmail', 'wizard/img/google-ic2.png', 1, 1),
(27, 'Google Docs', 'wizard/img/google-ic1.png', 1, 1),
(45, 'Google Sheets', 'wizard/img/google-ic6.png', 1, 1),
(46, 'Google Calendar', 'wizard/img/google-ic4.png', 1, 1),
(47, 'Google Drive', 'wizard/img/google-ic5.png', 1, 1),
(49, 'Google Contacts', 'wizard/img/googlecontacts.jpg', 1, 1),
(50, 'Google Forms', 'wizard/img/googleforms.png', 1, 1),
(52, 'Evernote', 'wizard/img/evernote.png', 1, 1),
(53, 'Google Tasks', 'wizard/img/googletasks.png', 1, 1),
(54, 'Calendly', 'wizard/img/calendly.png', 1, 1),
(55, 'Gmail', 'wizard/img/google-ic2.png', 1, 0),
(56, 'Google Docs', 'wizard/img/google-ic1.png', 1, 0),
(57, 'Google Sheets', 'wizard/img/google-ic6.png', 1, 0),
(58, 'Google Calendar', 'wizard/img/google-ic4.png', 1, 0),
(59, 'Google Drive', 'wizard/img/google-ic5.png', 1, 0),
(60, 'Google Contacts', 'wizard/img/googlecontacts.jpg', 1, 0),
(61, 'Google Forms', 'wizard/img/googleforms.png', 1, 0),
(62, 'Google Tasks', 'wizard/img/googletasks.png', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wizard_workspace`
--

CREATE TABLE `wizard_workspace` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wizard_workspace`
--

INSERT INTO `wizard_workspace` (`id`, `name`, `created_at`) VALUES
(13, 'Universal Flow Templates', '2020-08-18 01:40:54'),
(14, 'tommy', '2020-08-18 09:19:27'),
(15, 'Testing 19', '2020-08-19 02:02:51'),
(16, 'Construction Industry Flow Templatess', '2020-08-19 02:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `work_orders`
--

CREATE TABLE `work_orders` (
  `id` int(11) NOT NULL,
  `work_order_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `job_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `start_time` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` date NOT NULL,
  `end_time` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `event_color` enum('#4cb052','#d96666','#e67399','#b373b3','#8c66d9','#668cd9','#59bfb3','#65ad89','#f2a640') COLLATE utf8_unicode_ci NOT NULL,
  `customer_reminder_notification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `date_issued` date NOT NULL,
  `job_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('New','Scheduled','Started','Paused','Completed','Invoiced','Withdrawn','Closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'New',
  `priority` enum('Emergency','Low','Standard','Urgent') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Standard',
  `po_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8_unicode_ci NOT NULL,
  `authorizer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `before_signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'uploads/Signatures/<company_id>',
  `before_sign_date` date NOT NULL,
  `after_signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'uploads/Signatures/<company_id>',
  `after_sign_date` date NOT NULL,
  `owner_signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'uploads/Signatures/<company_id>',
  `owner_sign_date` date NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `work_order_number`, `customer_id`, `employee_id`, `job_location`, `start_date`, `start_time`, `end_date`, `end_time`, `event_color`, `customer_reminder_notification`, `timezone`, `is_recurring`, `date_issued`, `job_type`, `job_name`, `job_description`, `status`, `priority`, `po_number`, `instructions`, `authorizer_name`, `before_signature`, `before_sign_date`, `after_signature`, `after_sign_date`, `owner_signature`, `owner_sign_date`, `date_created`, `date_updated`, `company_id`) VALUES
(6, 'WO-00005', 3, 2, '6055 Born Ct , Pensacola, FL 32504', '2020-09-09', '10:00 am', '2020-09-09', '12:00 pm', '#4cb052', '1 day before', 'Central Time (UTC -5)', 0, '2020-08-29', 'Install', 'Tommy Nguyen', 'New Install', 'Scheduled', 'Standard', '', 'Lorem ipsum dolor', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '2020-08-29 21:30:40', '0000-00-00 00:00:00', 1),
(4, 'WO-00003', 1, 2, '6055 Born Court , Pensacola, FL 32504', '2020-08-26', '10:00 am', '2020-08-26', '11:00 am', '#4cb052', '1 day before', 'Central Time (UTC -5)', 0, '2020-08-26', 'Service', 'Jane Smith', '', 'Scheduled', 'Standard', '', '', 'Tommy Nguyen', 'uploads/Signatures/1/WO-00003_before_1598453512695.jpg', '2020-08-26', 'uploads/Signatures/1/WO-00003_after_1598453512703.jpg', '2020-08-26', 'uploads/Signatures/1/WO-00003_owner_1598453512709.jpg', '2020-08-26', '2020-08-26 12:48:27', '0000-00-00 00:00:00', 1),
(5, 'WO-00004', 2, 0, '6867 Pine Forest Road , Pensacola, FL 32526', '2020-08-27', '8:00 am', '2020-08-27', '10:00 am', '#4cb052', '1 day before', '', 0, '2020-08-26', 'Service', 'John Doe', '', 'New', 'Standard', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '2020-08-26 14:42:12', '0000-00-00 00:00:00', 1),
(7, 'WO-00006', 3, 23, '6055 Born Ct , Pensacola, FL 32504', '2020-09-20', '8:30 am', '2020-09-20', '12:30 pm', '#4cb052', '1 day before', 'Central Time (UTC -5)', 0, '2020-09-20', 'Service', 'Tommy Nguyen', '', 'New', 'Standard', '', '', 'Tommy', 'uploads/Signatures/1/WO-00006_before_1600660042087.jpg', '2020-09-20', '', '0000-00-00', '', '0000-00-00', '2020-09-20 19:38:57', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_orders_items`
--

CREATE TABLE `work_orders_items` (
  `work_order_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_orders_items`
--

INSERT INTO `work_orders_items` (`work_order_id`, `items_id`, `qty`) VALUES
(4, 2, 1),
(4, 4, 1),
(5, 7, 1),
(5, 8, 1),
(5, 11, 1),
(6, 6, 1),
(6, 15, 1),
(6, 19, 1),
(7, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_orders_photo`
--

CREATE TABLE `work_orders_photo` (
  `id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'uploads/CompanyPhoto/<company_id>/<file_name>',
  `work_order_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `work_orders_photo`
--

INSERT INTO `work_orders_photo` (`id`, `path`, `work_order_id`, `company_id`) VALUES
(1, 'uploads/CompanyPhoto/1/WO-00005_photo_1598736642205.jpg', 6, 1),
(2, 'uploads/CompanyPhoto/1/WO-00005_photo_1598736642053.jpg', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_settings`
--

CREATE TABLE `work_order_settings` (
  `id` int(11) NOT NULL,
  `work_order_num_prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'WO-',
  `work_order_num_next` int(11) NOT NULL DEFAULT '1',
  `capture_customer_signature` tinyint(1) NOT NULL DEFAULT '1',
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `work_order_settings`
--

INSERT INTO `work_order_settings` (`id`, `work_order_num_prefix`, `work_order_num_next`, `capture_customer_signature`, `company_id`) VALUES
(1, 'WO-', 7, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order_types`
--

CREATE TABLE `work_order_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `work_order_types`
--

INSERT INTO `work_order_types` (`id`, `name`, `company_id`) VALUES
(1, 'Design', 1),
(2, 'Install', 1),
(3, 'Maintenance', 1),
(4, 'Repair', 1),
(5, 'Replace', 1),
(6, 'Service', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_status`
--

CREATE TABLE `work_status` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_bill`
--
ALTER TABLE `accounting_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_chart_of_accounts`
--
ALTER TABLE `accounting_chart_of_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `acc_detail_id` (`acc_detail_id`),
  ADD KEY `sub_acc_id` (`sub_acc_id`);

--
-- Indexes for table `accounting_check`
--
ALTER TABLE `accounting_check`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `accounting_existing_attachment`
--
ALTER TABLE `accounting_existing_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_expense`
--
ALTER TABLE `accounting_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_expense_attachment`
--
ALTER TABLE `accounting_expense_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_expense_category`
--
ALTER TABLE `accounting_expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_expense_transaction`
--
ALTER TABLE `accounting_expense_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_list_category`
--
ALTER TABLE `accounting_list_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_paydown`
--
ALTER TABLE `accounting_paydown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_receipts`
--
ALTER TABLE `accounting_receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_reconcile`
--
ALTER TABLE `accounting_reconcile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chart_of_accounts_id` (`chart_of_accounts_id`);

--
-- Indexes for table `accounting_rules`
--
ALTER TABLE `accounting_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_rules_category`
--
ALTER TABLE `accounting_rules_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_rules_conditions`
--
ALTER TABLE `accounting_rules_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_time_activity`
--
ALTER TABLE `accounting_time_activity`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendor_id` (`vendor_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `accounting_vendors`
--
ALTER TABLE `accounting_vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendor_id` (`vendor_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `accounting_vendor_credit`
--
ALTER TABLE `accounting_vendor_credit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_has_account_details`
--
ALTER TABLE `accounts_has_account_details`
  ADD PRIMARY KEY (`account_id`,`acc_detail_id`);

--
-- Indexes for table `account_detail`
--
ALTER TABLE `account_detail`
  ADD PRIMARY KEY (`acc_detail_id`);

--
-- Indexes for table `acs_access`
--
ALTER TABLE `acs_access`
  ADD PRIMARY KEY (`access_id`);

--
-- Indexes for table `acs_alarm`
--
ALTER TABLE `acs_alarm`
  ADD PRIMARY KEY (`alarm_id`);

--
-- Indexes for table `acs_assign`
--
ALTER TABLE `acs_assign`
  ADD PRIMARY KEY (`ass_id`);

--
-- Indexes for table `acs_billing`
--
ALTER TABLE `acs_billing`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `acs_office`
--
ALTER TABLE `acs_office`
  ADD PRIMARY KEY (`off_id`);

--
-- Indexes for table `acs_profile`
--
ALTER TABLE `acs_profile`
  ADD PRIMARY KEY (`prof_id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_dashboard_sort`
--
ALTER TABLE `ac_dashboard_sort`
  ADD PRIMARY KEY (`acds_id`);

--
-- Indexes for table `ac_leads`
--
ALTER TABLE `ac_leads`
  ADD PRIMARY KEY (`leads_id`);

--
-- Indexes for table `ac_leadtypes`
--
ALTER TABLE `ac_leadtypes`
  ADD PRIMARY KEY (`lead_id`);

--
-- Indexes for table `ac_module_sort`
--
ALTER TABLE `ac_module_sort`
  ADD PRIMARY KEY (`ams_id`);

--
-- Indexes for table `ac_salesarea`
--
ALTER TABLE `ac_salesarea`
  ADD PRIMARY KEY (`sa_id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointments_id`);

--
-- Indexes for table `banking_info`
--
ALTER TABLE `banking_info`
  ADD PRIMARY KEY (`banking_info_id`);

--
-- Indexes for table `before_after`
--
ALTER TABLE `before_after`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_category`
--
ALTER TABLE `booking_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_coupons`
--
ALTER TABLE `booking_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_forms`
--
ALTER TABLE `booking_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_info`
--
ALTER TABLE `booking_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_schedule_assigned_users`
--
ALTER TABLE `booking_schedule_assigned_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_service_items`
--
ALTER TABLE `booking_service_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_settings`
--
ALTER TABLE `booking_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_time_slots`
--
ALTER TABLE `booking_time_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_work_orders`
--
ALTER TABLE `booking_work_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_profile`
--
ALTER TABLE `business_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `companies_has_modules`
--
ALTER TABLE `companies_has_modules`
  ADD PRIMARY KEY (`company_id`,`modules_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`contracts_id`);

--
-- Indexes for table `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers_has_customer_settings`
--
ALTER TABLE `customers_has_customer_settings`
  ADD PRIMARY KEY (`customer_id`,`customer_settings_id`);

--
-- Indexes for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_settings`
--
ALTER TABLE `customer_settings`
  ADD PRIMARY KEY (`customer_settings_id`);

--
-- Indexes for table `customer_sources`
--
ALTER TABLE `customer_sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_types`
--
ALTER TABLE `customer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customize_lead_forms`
--
ALTER TABLE `customize_lead_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_forms`
--
ALTER TABLE `custom_forms`
  ADD PRIMARY KEY (`forms_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `esign_components`
--
ALTER TABLE `esign_components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimates`
--
ALTER TABLE `estimates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimates_items`
--
ALTER TABLE `estimates_items`
  ADD PRIMARY KEY (`estimates_id`,`items_id`);

--
-- Indexes for table `estimates_photo`
--
ALTER TABLE `estimates_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimate_settings`
--
ALTER TABLE `estimate_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_settings`
--
ALTER TABLE `event_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fb_choices`
--
ALTER TABLE `fb_choices`
  ADD PRIMARY KEY (`fc_id`),
  ADD KEY `Index 2` (`fc_element_id`);

--
-- Indexes for table `fb_forms`
--
ALTER TABLE `fb_forms`
  ADD PRIMARY KEY (`forms_id`);

--
-- Indexes for table `fb_forms_answers`
--
ALTER TABLE `fb_forms_answers`
  ADD PRIMARY KEY (`fa_id`),
  ADD KEY `Index 2` (`fa_form_id`,`fa_element_id`);

--
-- Indexes for table `fb_forms_elements`
--
ALTER TABLE `fb_forms_elements`
  ADD PRIMARY KEY (`fe_id`),
  ADD KEY `Form Id` (`fe_form_id`);

--
-- Indexes for table `fb_forms_products`
--
ALTER TABLE `fb_forms_products`
  ADD PRIMARY KEY (`fp_id`);

--
-- Indexes for table `filevault`
--
ALTER TABLE `filevault`
  ADD PRIMARY KEY (`file_id`,`folder_id`);

--
-- Indexes for table `file_folders`
--
ALTER TABLE `file_folders`
  ADD PRIMARY KEY (`folder_id`);

--
-- Indexes for table `file_folders_categories`
--
ALTER TABLE `file_folders_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `file_folders_permissions_roles`
--
ALTER TABLE `file_folders_permissions_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_folders_permissions_users`
--
ALTER TABLE `file_folders_permissions_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_responses`
--
ALTER TABLE `form_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_accounts`
--
ALTER TABLE `google_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gps_location`
--
ALTER TABLE `gps_location`
  ADD PRIMARY KEY (`gps_location_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices_items`
--
ALTER TABLE `invoices_items`
  ADD PRIMARY KEY (`invoice_id`,`items_id`);

--
-- Indexes for table `invoices_payment_schedule`
--
ALTER TABLE `invoices_payment_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices_photo`
--
ALTER TABLE `invoices_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_has_items`
--
ALTER TABLE `invoice_has_items`
  ADD PRIMARY KEY (`ihi_id`,`item_id`);

--
-- Indexes for table `invoice_settings`
--
ALTER TABLE `invoice_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_has_files`
--
ALTER TABLE `items_has_files`
  ADD PRIMARY KEY (`id`,`file_id`);

--
-- Indexes for table `items_has_storage_loc`
--
ALTER TABLE `items_has_storage_loc`
  ADD PRIMARY KEY (`id`,`item_id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`item_categories_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobs_id`);

--
-- Indexes for table `jobs_has_address`
--
ALTER TABLE `jobs_has_address`
  ADD PRIMARY KEY (`jobs_id`,`address_id`);

--
-- Indexes for table `jobs_has_contracts`
--
ALTER TABLE `jobs_has_contracts`
  ADD PRIMARY KEY (`jobs_id`,`contracts_id`);

--
-- Indexes for table `jobs_has_customers`
--
ALTER TABLE `jobs_has_customers`
  ADD PRIMARY KEY (`jobs_id`,`id`);

--
-- Indexes for table `jobs_has_employees`
--
ALTER TABLE `jobs_has_employees`
  ADD PRIMARY KEY (`jobs_id`,`employees_id`);

--
-- Indexes for table `jobs_has_files`
--
ALTER TABLE `jobs_has_files`
  ADD PRIMARY KEY (`jobs_id`,`file_id`);

--
-- Indexes for table `jobs_has_job_settings`
--
ALTER TABLE `jobs_has_job_settings`
  ADD PRIMARY KEY (`jobs_id`,`job_settings_id`);

--
-- Indexes for table `jobs_has_time_record`
--
ALTER TABLE `jobs_has_time_record`
  ADD PRIMARY KEY (`jobs_id`,`timesheet_id`);

--
-- Indexes for table `job_settings`
--
ALTER TABLE `job_settings`
  ADD PRIMARY KEY (`job_settings_id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_source`
--
ALTER TABLE `lead_source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`modules_id`);

--
-- Indexes for table `notification_settings`
--
ALTER TABLE `notification_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nsmart_features`
--
ALTER TABLE `nsmart_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nsmart_plans`
--
ALTER TABLE `nsmart_plans`
  ADD PRIMARY KEY (`nsmart_plans_id`);

--
-- Indexes for table `nsmart_plans_has_modules`
--
ALTER TABLE `nsmart_plans_has_modules`
  ADD PRIMARY KEY (`nsmart_plans_id`,`nsmart_feature_id`,`plan_heading_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`access_token`);

--
-- Indexes for table `oauth_authorization_codes`
--
ALTER TABLE `oauth_authorization_codes`
  ADD PRIMARY KEY (`authorization_code`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`refresh_token`);

--
-- Indexes for table `oauth_scopes`
--
ALTER TABLE `oauth_scopes`
  ADD PRIMARY KEY (`scope`);

--
-- Indexes for table `oauth_users`
--
ALTER TABLE `oauth_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `online_lead_form`
--
ALTER TABLE `online_lead_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`options_id`,`question_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payments_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permissions_id`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`phone_id`,`user_id`);

--
-- Indexes for table `plan_headings`
--
ALTER TABLE `plan_headings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_type`
--
ALTER TABLE `plan_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_type_has_items`
--
ALTER TABLE `plan_type_has_items`
  ADD PRIMARY KEY (`id`,`id1`);

--
-- Indexes for table `portfolio_pictures`
--
ALTER TABLE `portfolio_pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priority_list`
--
ALTER TABLE `priority_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`Questions_id`);

--
-- Indexes for table `quick_links`
--
ALTER TABLE `quick_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`records_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permissions_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_email_brandings`
--
ALTER TABLE `setting_email_brandings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_notifications`
--
ALTER TABLE `setting_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_online_payments`
--
ALTER TABLE `setting_online_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`signatures_id`);

--
-- Indexes for table `storage_loc`
--
ALTER TABLE `storage_loc`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_answer`
--
ALTER TABLE `survey_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_logic`
--
ALTER TABLE `survey_logic`
  ADD PRIMARY KEY (`sl_rec_no`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_template_answer`
--
ALTER TABLE `survey_template_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_template_questions`
--
ALTER TABLE `survey_template_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_themes`
--
ALTER TABLE `survey_themes`
  ADD PRIMARY KEY (`sth_rec_no`);

--
-- Indexes for table `survey_workspaces`
--
ALTER TABLE `survey_workspaces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tasks_participants`
--
ALTER TABLE `tasks_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks_status`
--
ALTER TABLE `tasks_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tasks_updates`
--
ALTER TABLE `tasks_updates`
  ADD PRIMARY KEY (`update_id`);

--
-- Indexes for table `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_attendance`
--
ALTER TABLE `timesheet_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_logs`
--
ALTER TABLE `timesheet_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_settings`
--
ALTER TABLE `timesheet_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_record`
--
ALTER TABLE `time_record`
  ADD PRIMARY KEY (`timesheet_id`);

--
-- Indexes for table `ts_settings_day`
--
ALTER TABLE `ts_settings_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_settings_total_day`
--
ALTER TABLE `ts_settings_total_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_total_week_duration`
--
ALTER TABLE `ts_total_week_duration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_weekly_total_shift`
--
ALTER TABLE `ts_weekly_total_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_break`
--
ALTER TABLE `user_break`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`details_id`);

--
-- Indexes for table `user_docfile`
--
ALTER TABLE `user_docfile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_docfile_recipients`
--
ALTER TABLE `user_docfile_recipients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_docphoto`
--
ALTER TABLE `user_docphoto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sign`
--
ALTER TABLE `user_sign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_has_users`
--
ALTER TABLE `vendor_has_users`
  ADD PRIMARY KEY (`vendor_id`,`user_id`);

--
-- Indexes for table `wizard_apps`
--
ALTER TABLE `wizard_apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wizard_workspace`
--
ALTER TABLE `wizard_workspace`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_orders_items`
--
ALTER TABLE `work_orders_items`
  ADD PRIMARY KEY (`work_order_id`,`items_id`);

--
-- Indexes for table `work_orders_photo`
--
ALTER TABLE `work_orders_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_order_settings`
--
ALTER TABLE `work_order_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_order_types`
--
ALTER TABLE `work_order_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_status`
--
ALTER TABLE `work_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `accounting_bill`
--
ALTER TABLE `accounting_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `accounting_chart_of_accounts`
--
ALTER TABLE `accounting_chart_of_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `accounting_check`
--
ALTER TABLE `accounting_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `accounting_existing_attachment`
--
ALTER TABLE `accounting_existing_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `accounting_expense`
--
ALTER TABLE `accounting_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `accounting_expense_attachment`
--
ALTER TABLE `accounting_expense_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `accounting_expense_category`
--
ALTER TABLE `accounting_expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `accounting_expense_transaction`
--
ALTER TABLE `accounting_expense_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `accounting_list_category`
--
ALTER TABLE `accounting_list_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `accounting_paydown`
--
ALTER TABLE `accounting_paydown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounting_receipts`
--
ALTER TABLE `accounting_receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `accounting_reconcile`
--
ALTER TABLE `accounting_reconcile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `accounting_rules`
--
ALTER TABLE `accounting_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `accounting_rules_category`
--
ALTER TABLE `accounting_rules_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `accounting_rules_conditions`
--
ALTER TABLE `accounting_rules_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `accounting_time_activity`
--
ALTER TABLE `accounting_time_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `accounting_vendors`
--
ALTER TABLE `accounting_vendors`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `account_detail`
--
ALTER TABLE `account_detail`
  MODIFY `acc_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `acs_access`
--
ALTER TABLE `acs_access`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `acs_alarm`
--
ALTER TABLE `acs_alarm`
  MODIFY `alarm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `acs_assign`
--
ALTER TABLE `acs_assign`
  MODIFY `ass_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acs_billing`
--
ALTER TABLE `acs_billing`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `acs_office`
--
ALTER TABLE `acs_office`
  MODIFY `off_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `acs_profile`
--
ALTER TABLE `acs_profile`
  MODIFY `prof_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1073;

--
-- AUTO_INCREMENT for table `ac_dashboard_sort`
--
ALTER TABLE `ac_dashboard_sort`
  MODIFY `acds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ac_leads`
--
ALTER TABLE `ac_leads`
  MODIFY `leads_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ac_leadtypes`
--
ALTER TABLE `ac_leadtypes`
  MODIFY `lead_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ac_module_sort`
--
ALTER TABLE `ac_module_sort`
  MODIFY `ams_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ac_salesarea`
--
ALTER TABLE `ac_salesarea`
  MODIFY `sa_id` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointments_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banking_info`
--
ALTER TABLE `banking_info`
  MODIFY `banking_info_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `before_after`
--
ALTER TABLE `before_after`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `booking_category`
--
ALTER TABLE `booking_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking_coupons`
--
ALTER TABLE `booking_coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking_forms`
--
ALTER TABLE `booking_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `booking_info`
--
ALTER TABLE `booking_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `booking_schedule_assigned_users`
--
ALTER TABLE `booking_schedule_assigned_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_service_items`
--
ALTER TABLE `booking_service_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `booking_settings`
--
ALTER TABLE `booking_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_time_slots`
--
ALTER TABLE `booking_time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `booking_work_orders`
--
ALTER TABLE `booking_work_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `business_profile`
--
ALTER TABLE `business_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'company_id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `contracts_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_cards`
--
ALTER TABLE `credit_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_settings`
--
ALTER TABLE `customer_settings`
  MODIFY `customer_settings_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_sources`
--
ALTER TABLE `customer_sources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_types`
--
ALTER TABLE `customer_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customize_lead_forms`
--
ALTER TABLE `customize_lead_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `custom_forms`
--
ALTER TABLE `custom_forms`
  MODIFY `forms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `esign_components`
--
ALTER TABLE `esign_components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estimates`
--
ALTER TABLE `estimates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `estimates_photo`
--
ALTER TABLE `estimates_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estimate_settings`
--
ALTER TABLE `estimate_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_settings`
--
ALTER TABLE `event_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fb_choices`
--
ALTER TABLE `fb_choices`
  MODIFY `fc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fb_forms`
--
ALTER TABLE `fb_forms`
  MODIFY `forms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fb_forms_answers`
--
ALTER TABLE `fb_forms_answers`
  MODIFY `fa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fb_forms_elements`
--
ALTER TABLE `fb_forms_elements`
  MODIFY `fe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `fb_forms_products`
--
ALTER TABLE `fb_forms_products`
  MODIFY `fp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `filevault`
--
ALTER TABLE `filevault`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `file_folders`
--
ALTER TABLE `file_folders`
  MODIFY `folder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `file_folders_categories`
--
ALTER TABLE `file_folders_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `file_folders_permissions_roles`
--
ALTER TABLE `file_folders_permissions_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_folders_permissions_users`
--
ALTER TABLE `file_folders_permissions_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `form_responses`
--
ALTER TABLE `form_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `google_accounts`
--
ALTER TABLE `google_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gps_location`
--
ALTER TABLE `gps_location`
  MODIFY `gps_location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices_payment_schedule`
--
ALTER TABLE `invoices_payment_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices_photo`
--
ALTER TABLE `invoices_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_has_items`
--
ALTER TABLE `invoice_has_items`
  MODIFY `ihi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_settings`
--
ALTER TABLE `invoice_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `items_has_storage_loc`
--
ALTER TABLE `items_has_storage_loc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `item_categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_settings`
--
ALTER TABLE `job_settings`
  MODIFY `job_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lead_source`
--
ALTER TABLE `lead_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `modules_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_settings`
--
ALTER TABLE `notification_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nsmart_features`
--
ALTER TABLE `nsmart_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nsmart_plans`
--
ALTER TABLE `nsmart_plans`
  MODIFY `nsmart_plans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `online_lead_form`
--
ALTER TABLE `online_lead_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `options_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payments_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permissions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `phone`
--
ALTER TABLE `phone`
  MODIFY `phone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plan_headings`
--
ALTER TABLE `plan_headings`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `plan_type`
--
ALTER TABLE `plan_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `portfolio_pictures`
--
ALTER TABLE `portfolio_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `priority_list`
--
ALTER TABLE `priority_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `Questions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `quick_links`
--
ALTER TABLE `quick_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `records_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `setting_email_brandings`
--
ALTER TABLE `setting_email_brandings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting_notifications`
--
ALTER TABLE `setting_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting_online_payments`
--
ALTER TABLE `setting_online_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signatures`
--
ALTER TABLE `signatures`
  MODIFY `signatures_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `storage_loc`
--
ALTER TABLE `storage_loc`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `survey_answer`
--
ALTER TABLE `survey_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_logic`
--
ALTER TABLE `survey_logic`
  MODIFY `sl_rec_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `survey_template_answer`
--
ALTER TABLE `survey_template_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=380;

--
-- AUTO_INCREMENT for table `survey_template_questions`
--
ALTER TABLE `survey_template_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `survey_themes`
--
ALTER TABLE `survey_themes`
  MODIFY `sth_rec_no` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `survey_workspaces`
--
ALTER TABLE `survey_workspaces`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks_participants`
--
ALTER TABLE `tasks_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tasks_updates`
--
ALTER TABLE `tasks_updates`
  MODIFY `update_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tax_rates`
--
ALTER TABLE `tax_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timesheet_attendance`
--
ALTER TABLE `timesheet_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timesheet_logs`
--
ALTER TABLE `timesheet_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timesheet_settings`
--
ALTER TABLE `timesheet_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_record`
--
ALTER TABLE `time_record`
  MODIFY `timesheet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `ts_settings_day`
--
ALTER TABLE `ts_settings_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ts_settings_total_day`
--
ALTER TABLE `ts_settings_total_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ts_total_week_duration`
--
ALTER TABLE `ts_total_week_duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ts_weekly_total_shift`
--
ALTER TABLE `ts_weekly_total_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_break`
--
ALTER TABLE `user_break`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_docfile`
--
ALTER TABLE `user_docfile`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_docfile_recipients`
--
ALTER TABLE `user_docfile_recipients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_docphoto`
--
ALTER TABLE `user_docphoto`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_sign`
--
ALTER TABLE `user_sign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendor_has_users`
--
ALTER TABLE `vendor_has_users`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wizard_apps`
--
ALTER TABLE `wizard_apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `wizard_workspace`
--
ALTER TABLE `wizard_workspace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `work_orders`
--
ALTER TABLE `work_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `work_orders_photo`
--
ALTER TABLE `work_orders_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_order_settings`
--
ALTER TABLE `work_order_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_order_types`
--
ALTER TABLE `work_order_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `work_status`
--
ALTER TABLE `work_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
