-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2020 at 03:03 PM
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
CREATE DATABASE IF NOT EXISTS `admintom_nsmart_companies` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `admintom_nsmart_companies`;

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
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
(27, ' (admin) Logged in', 2, '162.72.82.177', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `address1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
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

DROP TABLE IF EXISTS `banking_info`;
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
-- Table structure for table `business_profile`
--

DROP TABLE IF EXISTS `business_profile`;
CREATE TABLE `business_profile` (
  `id` int(11) NOT NULL,
  `b_name` varchar(255) NOT NULL,
  `b_email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `is_emergency_support` tinyint(1) DEFAULT NULL COMMENT '1=true',
  `year_est` char(4) DEFAULT NULL,
  `employee_count` int(6) DEFAULT NULL,
  `is_subcontract_allowed` tinyint(1) DEFAULT NULL,
  `EIN` char(9) DEFAULT NULL,
  `business_desc` text,
  `logo_id` int(11) DEFAULT NULL,
  `nsmart_plans_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL COMMENT 'user_id'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_profile`
--

INSERT INTO `business_profile` (`id`, `b_name`, `b_email`, `website`, `is_emergency_support`, `year_est`, `employee_count`, `is_subcontract_allowed`, `EIN`, `business_desc`, `logo_id`, `nsmart_plans_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES
(1, 'A Cool Company', 'company@test.com', 'acoolcompany.exp', 1, '2020', 6, 0, '123456789', 'A company that does cool stuff for cool people, because we are cool. OBVIOSULY', NULL, 1, '2020-05-20 19:24:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(2, 'NSmartrac', 'support@nsmartrac.com', 'nsmartrac.com', 0, '2020', 10, NULL, '123456789', NULL, NULL, 0, '2020-05-20 19:35:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `companies_has_modules`
--

DROP TABLE IF EXISTS `companies_has_modules`;
CREATE TABLE `companies_has_modules` (
  `company_id` int(11) NOT NULL,
  `modules_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
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

DROP TABLE IF EXISTS `credit_cards`;
CREATE TABLE `credit_cards` (
  `credit_cards_id` int(11) NOT NULL,
  `card_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'encrypt',
  `exp_day` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exp_yr` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CVV` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_type` enum('AMEX','Visa','Master','Discover') COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `added` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_method_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notification_method` varchar(6) DEFAULT NULL,
  `comments` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `company_id` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='data should be encrypted';

-- --------------------------------------------------------

--
-- Table structure for table `customers_has_customer_settings`
--

DROP TABLE IF EXISTS `customers_has_customer_settings`;
CREATE TABLE `customers_has_customer_settings` (
  `customer_id` int(11) NOT NULL,
  `customer_settings_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_settings`
--

DROP TABLE IF EXISTS `customer_settings`;
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
-- Table structure for table `custom_forms`
--

DROP TABLE IF EXISTS `custom_forms`;
CREATE TABLE `custom_forms` (
  `forms_id` int(11) NOT NULL,
  `form_title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `employees_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `payrate` decimal(8,2) DEFAULT NULL,
  `pay_type` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employees_id`, `role_id`, `hire_date`, `title`, `dob`, `payrate`, `pay_type`, `user_id`, `company_id`) VALUES
(1, 3, '2020-04-09', 'Cool Company Owner', '1985-02-10', 55000.00, 'Salary', 2, 1),
(2, 4, '2020-05-07', 'cool company manager', '1958-05-14', 45000.00, 'Salary', 3, 1),
(3, 7, '2020-05-19', 'Cool Tech Guy', '1990-01-23', 15.37, 'hourly', 4, 1),
(4, 1, '2020-05-01', 'Owner', '1950-08-06', NULL, NULL, 5, 2),
(5, 1, '2020-03-01', 'Project Manager', '1986-02-11', 20.00, 'hourly', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `estimates`
--

DROP TABLE IF EXISTS `estimates`;
CREATE TABLE `estimates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `job_location` varchar(255) DEFAULT NULL,
  `job_name` varchar(255) DEFAULT NULL,
  `estimate_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `purchase_order_number` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `estimate_items` text,
  `estimate_eqpt_cost` text CHARACTER SET utf8mb4,
  `deposit_request` mediumtext,
  `customer_message` text,
  `terms_conditions` text,
  `attachments` text,
  `instructions` text,
  `template_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `filevault`
--

DROP TABLE IF EXISTS `filevault`;
CREATE TABLE `filevault` (
  `file_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `file_path` varchar(255) NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  `file_size` int(11) DEFAULT NULL,
  `folder_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `alt_text` text,
  `company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `file_folders`
--

DROP TABLE IF EXISTS `file_folders`;
CREATE TABLE `file_folders` (
  `folder_id` int(11) NOT NULL,
  `folder_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `permissions` int(11) DEFAULT NULL COMMENT 'array (link to roles / specific users)',
  `created_by` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `password_protection` int(11) DEFAULT NULL COMMENT '1=yes',
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_responses`
--

DROP TABLE IF EXISTS `form_responses`;
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
-- Table structure for table `gps_location`
--

DROP TABLE IF EXISTS `gps_location`;
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
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `total_due` decimal(9,2) DEFAULT NULL,
  `balance` decimal(9,2) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `billing_type` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'reoccuring, payment plan, lump sum',
  `job_id` int(11) DEFAULT NULL,
  `billing_date` date DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'pending, late, paid',
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_has_items`
--

DROP TABLE IF EXISTS `invoice_has_items`;
CREATE TABLE `invoice_has_items` (
  `invoice_id` int(11) NOT NULL,
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
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(15) NOT NULL COMMENT 'service, material, product, fee',
  `model` varchar(100) NOT NULL,
  `COGS` decimal(8,2) NOT NULL COMMENT 'cost of goods sold',
  `price` decimal(8,2) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_categories_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1=active\\n0=non active',
  `vendor_id` int(11) NOT NULL,
  `units` varchar(25) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items_has_files`
--

DROP TABLE IF EXISTS `items_has_files`;
CREATE TABLE `items_has_files` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items_has_storage_loc`
--

DROP TABLE IF EXISTS `items_has_storage_loc`;
CREATE TABLE `items_has_storage_loc` (
  `id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `inserted_by` int(11) DEFAULT NULL,
  `insert_date` datetime DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

DROP TABLE IF EXISTS `item_categories`;
CREATE TABLE `item_categories` (
  `item_categories_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `jobs_id` int(11) NOT NULL,
  `job_number` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_type` int(11) DEFAULT NULL COMMENT 'questions > Job_type\\nOptions >user defined',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_address`
--

DROP TABLE IF EXISTS `jobs_has_address`;
CREATE TABLE `jobs_has_address` (
  `jobs_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_contracts`
--

DROP TABLE IF EXISTS `jobs_has_contracts`;
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

DROP TABLE IF EXISTS `jobs_has_customers`;
CREATE TABLE `jobs_has_customers` (
  `jobs_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_employees`
--

DROP TABLE IF EXISTS `jobs_has_employees`;
CREATE TABLE `jobs_has_employees` (
  `jobs_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `emp_role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_files`
--

DROP TABLE IF EXISTS `jobs_has_files`;
CREATE TABLE `jobs_has_files` (
  `jobs_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_job_settings`
--

DROP TABLE IF EXISTS `jobs_has_job_settings`;
CREATE TABLE `jobs_has_job_settings` (
  `jobs_id` int(11) NOT NULL,
  `job_settings_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_time_record`
--

DROP TABLE IF EXISTS `jobs_has_time_record`;
CREATE TABLE `jobs_has_time_record` (
  `jobs_id` int(11) NOT NULL,
  `timesheet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_settings`
--

DROP TABLE IF EXISTS `job_settings`;
CREATE TABLE `job_settings` (
  `job_settings_id` int(11) NOT NULL,
  `setting_type` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'job type\\npriority\\nstatus',
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `modules_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nsmart_plans`
--

DROP TABLE IF EXISTS `nsmart_plans`;
CREATE TABLE `nsmart_plans` (
  `nsmart_plans_id` int(11) NOT NULL,
  `plan_name` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nsmart_plans_has_modules`
--

DROP TABLE IF EXISTS `nsmart_plans_has_modules`;
CREATE TABLE `nsmart_plans_has_modules` (
  `nsmart_plans_id` int(11) NOT NULL,
  `modules_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `options_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `options` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `option_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `option_order` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
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

DROP TABLE IF EXISTS `payment_method`;
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

DROP TABLE IF EXISTS `permissions`;
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

DROP TABLE IF EXISTS `phone`;
CREATE TABLE `phone` (
  `phone_id` int(11) NOT NULL,
  `number` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'mobile, landline, voip, fax, office',
  `is_primary` tinyint(1) DEFAULT NULL,
  `accept_text` tinyint(1) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plan_type`
--

DROP TABLE IF EXISTS `plan_type`;
CREATE TABLE `plan_type` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1= active',
  `modified` datetime NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plan_type_has_items`
--

DROP TABLE IF EXISTS `plan_type_has_items`;
CREATE TABLE `plan_type_has_items` (
  `id` int(11) NOT NULL,
  `id1` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
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

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
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

DROP TABLE IF EXISTS `roles`;
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
(8, 'Sales', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
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

DROP TABLE IF EXISTS `settings`;
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
(3, 'timezone', 'Asia/Kolkata', '2018-07-15 19:24:17', NULL, NULL),
(4, 'login_theme', '1', '2019-06-06 13:34:28', NULL, NULL),
(5, 'date_format', 'd F, Y', '2020-01-04 02:01:45', NULL, NULL),
(6, 'datetime_format', 'h:m a - d M, Y ', '2020-01-04 02:02:24', NULL, NULL),
(7, 'google_recaptcha_enabled', '0', '2020-01-05 01:14:03', NULL, NULL),
(8, 'google_recaptcha_sitekey', '6LdIWswUAAAAAMRp6xt2wBu7V59jUvZvKWf_rbJc', '2020-01-05 01:14:17', NULL, NULL),
(9, 'google_recaptcha_secretkey', '6LdIWswUAAAAAIsdboq_76c63PHFsOPJHNR-z-75', '2020-01-05 01:14:40', NULL, NULL),
(10, 'bg_img_type', 'jpeg', '2020-01-07 00:23:33', NULL, NULL),
(11, 'schedule', 'a:9:{s:17:\"calendar_timezone\";s:15:\"America/Chicago\";s:21:\"calendar_default_view\";s:5:\"Month\";s:18:\"calendar_first_day\";s:1:\"0\";s:22:\"calender_day_starts_on\";s:7:\"7:00 AM\";s:20:\"calender_day_ends_on\";s:7:\"7:00 PM\";s:24:\"work_order_show_customer\";s:1:\"1\";s:23:\"work_order_show_details\";s:1:\"1\";s:21:\"work_order_show_price\";s:1:\"1\";s:10:\"btn-submit\";s:0:\"\";}', '2020-03-27 14:16:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `signatures`
--

DROP TABLE IF EXISTS `signatures`;
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

DROP TABLE IF EXISTS `storage_loc`;
CREATE TABLE `storage_loc` (
  `loc_id` int(11) NOT NULL,
  `location_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
CREATE TABLE `survey` (
  `id` int(11) UNSIGNED NOT NULL,
  `count_timer` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `published` tinyint(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_published` timestamp NULL DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `count_timer`, `count`, `title`, `published`, `created_by`, `date_created`, `date_published`, `company_id`) VALUES
(45, '11', 2, 'Local Host', 0, 2, '2020-04-23 12:31:03', NULL, 0),
(47, '', 0, 'test', 0, 2, '2020-05-13 10:48:57', NULL, 0),
(54, '', 0, 'zaw', 0, 0, '2020-05-26 08:09:33', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `survey_answer`
--

DROP TABLE IF EXISTS `survey_answer`;
CREATE TABLE `survey_answer` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_answer`
--

INSERT INTO `survey_answer` (`id`, `survey_id`, `question_id`, `answer`) VALUES
(20, 45, 291, 'test'),
(21, 45, 292, 'test2'),
(22, 45, 293, 'test1'),
(23, 45, 294, 'test.txt'),
(24, 45, 291, ''),
(25, 45, 293, 'test1'),
(26, 45, 294, ''),
(27, 45, 291, 'test'),
(28, 45, 293, 'test1'),
(29, 45, 294, 'test.txt'),
(30, 45, 291, 'test'),
(31, 45, 292, 'test1'),
(32, 45, 293, 'test1'),
(33, 45, 294, ''),
(34, 45, 291, 'test'),
(35, 45, 292, 'test2'),
(36, 45, 293, 'test1'),
(37, 45, 291, 'test'),
(38, 45, 292, 'test2'),
(39, 45, 293, 'test1'),
(40, 45, 291, 'test'),
(41, 45, 292, 'test2'),
(42, 45, 293, 'test1'),
(43, 45, 291, 'test'),
(44, 45, 292, 'test2'),
(45, 45, 293, 'test1'),
(46, 45, 291, ''),
(47, 45, 291, ''),
(48, 45, 291, ''),
(49, 45, 291, ''),
(50, 45, 291, ''),
(51, 45, 291, ''),
(52, 45, 291, ''),
(53, 45, 291, ''),
(54, 45, 291, ''),
(55, 45, 291, ''),
(56, 45, 291, ''),
(57, 45, 291, ''),
(58, 45, 291, ''),
(59, 45, 291, ''),
(60, 45, 291, ''),
(61, 45, 291, ''),
(62, 45, 291, ''),
(63, 45, 291, ''),
(64, 45, 291, ''),
(65, 45, 291, ''),
(66, 45, 291, ''),
(67, 45, 294, ''),
(68, 45, 291, ''),
(69, 45, 294, ''),
(70, 45, 291, 'Test'),
(71, 45, 292, 'test1'),
(72, 45, 293, 'test1'),
(73, 45, 294, 'test.txt'),
(74, 46, 300, 'test'),
(75, 46, 299, 'test long'),
(76, 46, 298, 'test'),
(77, 47, 304, ''),
(78, 47, 304, ''),
(79, 47, 304, ''),
(80, 47, 304, ''),
(81, 47, 304, '');

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

DROP TABLE IF EXISTS `survey_questions`;
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
  `image_position` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_questions`
--

INSERT INTO `survey_questions` (`id`, `survey_id`, `question`, `template_id`, `order`, `active`, `required`, `description`, `description_label`, `image_background`, `image_position`) VALUES
(76, 27, 'Your Question Here', 1, 0, NULL, NULL, '0', '', '', 0),
(166, 42, 'Your Question Heres', 3, 0, NULL, NULL, '0', '', '', 0),
(167, 42, 'Your Question Heres', 4, 0, NULL, NULL, '0', '', '', 0),
(168, 42, 'Welcome Message', 9, 0, NULL, NULL, '0', '', '', 0),
(169, 42, 'Enter Your Email Address', 5, 0, NULL, NULL, '0', '', '', 0),
(170, 42, 'Your Question Here', 6, 0, NULL, NULL, '0', '', '', 0),
(171, 42, 'Upload Image', 7, 0, NULL, NULL, '0', '', '', 0),
(179, 43, '[shortcode-1] [shortcode-1] @ @', 3, 1, NULL, NULL, '0', '', '', 0),
(180, 43, 'Your Question Here', 1, 2, NULL, NULL, '0', '', '', 0),
(181, 43, 'Your Question Here', 4, 0, NULL, NULL, '0', '', '', 0),
(182, 43, 'Welcome Message', 9, 0, NULL, NULL, '0', '', '', 0),
(193, 33, 'Your Question Here', 1, 0, NULL, 1, '1', 'Description Here', '', 0),
(194, 33, 'Your Question Here', 4, 0, NULL, NULL, '1', 'This is just a description', '', 0),
(195, 43, 'Your Question Here', 2, 0, NULL, NULL, '0', '', '', 0),
(196, 41, 'Your Question Here', 1, 0, NULL, NULL, '0', '', '', 0),
(209, 33, 'Your Question Here', 1, 0, NULL, NULL, '0', '', '', 0),
(291, 45, 'Super Long Text', 2, 1, NULL, NULL, '0', '', '', 0),
(292, 45, 'Single Choice', 3, 2, NULL, NULL, '0', '', '', 0),
(293, 45, 'Linkin Park', 4, 3, NULL, NULL, '0', '', '', 0),
(294, 45, 'images', 7, 4, NULL, NULL, '0', '', '', 0),
(296, 45, 'Welcome Message', 1, 0, NULL, NULL, '0', '', 'test.txt', 0),
(297, 45, 'Closing Screen', 19, 5, NULL, NULL, '0', '', '', 0),
(298, 46, 'question 3', 4, 2, NULL, 0, '0', '', '', 0),
(299, 46, 'hello, [shortcode-0] ?', 2, 1, NULL, NULL, '0', '', '', 0),
(300, 46, 'What is your name? ', 9, 0, NULL, NULL, '0', '', 'slider_login1.png', 0),
(301, 46, 'your ID', 16, 3, NULL, NULL, '0', '', '', 0),
(302, 47, 'Welcome ', 1, 0, NULL, NULL, '1', 'this is for test', '5thlimb-upselllogo.png', 2),
(303, 47, 'test question', 4, 1, NULL, NULL, '0', '', '', 1),
(304, 47, 'test@gmail.com', 5, 2, NULL, NULL, '0', '', '', 0),
(305, 47, '0915312131', 6, 3, NULL, NULL, '0', '', '', 0),
(306, 47, 'test', 7, 4, NULL, NULL, '0', '', '', 0),
(307, 47, '...', 11, 5, NULL, NULL, '0', '', '', 0),
(308, 47, '...', 18, 6, NULL, NULL, '0', '', '', 0),
(309, 47, 'test', 19, 7, NULL, NULL, '0', '', '', 0),
(325, 47, '...636', 16, 8, NULL, NULL, '0', '', '', 0),
(326, 48, 'Welcome Messagetest', 1, 0, NULL, NULL, '0', '', '', 1),
(327, 48, '...', 3, 1, NULL, NULL, '0', '', '', 0),
(328, 50, '...', 16, 0, NULL, NULL, '', '', '', 0),
(329, 54, 'Welcome Message', 1, 0, NULL, NULL, '', '', '', 0),
(330, 54, 'Welcome Message', 1, 0, NULL, NULL, '', '', '', 0),
(331, 54, '...', 2, 0, NULL, NULL, '', '', '', 0),
(332, 54, '...', 4, 0, NULL, NULL, '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `survey_template_answer`
--

DROP TABLE IF EXISTS `survey_template_answer`;
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
(323, '332', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', '');

-- --------------------------------------------------------

--
-- Table structure for table `survey_template_questions`
--

DROP TABLE IF EXISTS `survey_template_questions`;
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
(2, 'Long Text', '...', '<div class=\"input-content form-group\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', 'fa fa-align-justify', 'rgb(226, 109, 90)'),
(3, 'Single Choice', '...', '<div class=\"input-group input-content mb-1\">\r\n                                   <div class=\"input-group-prepend\">\r\n                                    <div class=\"input-group-text\">\r\n                                    <input name=\"options\"\r\n type=\"radio\" aria-label=\"Radio button for following text input\">\r\n                                    </div>\r\n                                  </div>\r\n                                  <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                </div>', 'fa fa-circle', 'rgb(116, 164, 191)'),
(4, 'Multiple Choice', '...', '<div class=\"input-content input-group mb-1\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                      <div class=\"input-group-text\">\r\n                                        <input type=\"checkbox\" aria-label=\"Checkbox for following text input\">\r\n                                      </div>\r\n                                    </div>\r\n                                    <input type=\"text\" class=\"form-control\" name=\"choices_label[]\">\r\n                                  </div>', 'fa fa-check', 'rgb(79, 169, 179)'),
(5, 'Email', '...', '<div class=\"form-group input-content\">\r\n   \r\n    <input type=\"email\" class=\"form-control\" name=\"answer[]\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', 'fa fa-envelope', 'rgb(58, 118, 133)'),
(6, 'Number', '...', '<div class=\"form-group input-content\">                                          <input type=\"number\" class=\"form-control\" name=\"answer\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', 'fa fa-sort-numeric-up-alt', 'rgb(224, 79, 120)'),
(7, 'Image', '...', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input form-control\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', 'fa fa-images', 'rgb(160, 134, 196)'),
(8, 'Phone Number', '...', ' 		<div class=\"form-group input-content\">                                   <input type=\"text\" class=\"form-control valid\" name=\"answer[]\" id=\"contact_phone\" placeholder=\"(555) 555-5555\" aria-invalid=\"false\">                                 </div>', 'fa fa-phone-square', 'rgb(63, 196, 106)'),
(9, 'Short Text', '...', '<div class=\"form-group input-content\">                                          <input type=\"text\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', 'fa fa-grip-lines', 'rgb(255, 186, 73)'),
(11, 'Yes/No', '...', '<div class=\"form-group input-content\">\r\n                                        <input type=\"checkbox\" checked data-toggle=\"toggle\" name=\"answer[]\"  data-on=\"Yes\" data-off=\"No\">                                   \r\n                                     </div>', 'fa fa-adjust', 'rgb(191, 57, 91)'),
(12, 'Rating', '...', ' <div class=\"form-group input-content\" id=\"rating-ability-wrapper\">\r\n                                   	    <input type=\"hidden\" id=\"selected_rating\" name=\"answer[]\" value=\"\" required=\"required\">\r\n                                   	    </label>\r\n                                   	    <h2 class=\"bold rating-header\" style=\"\">\r\n                                   	    <span class=\"selected-rating\">0</span><small> / 5</small>\r\n                                   	    </h2>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"1\" id=\"rating-star-1\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"2\" id=\"rating-star-2\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"3\" id=\"rating-star-3\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"4\" id=\"rating-star-4\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	    <button type=\"button\" class=\"btnrating btn btn-default btn-lg\" data-attr=\"5\" id=\"rating-star-5\">\r\n                                   	        <i class=\"fa fa-star\" aria-hidden=\"true\"></i>\r\n                                   	    </button>\r\n                                   	</div>', 'fa fa-star', 'rgb(243, 205, 89)'),
(13, 'Statement', '...', '<div class=\"form-group input-content\">                                                                             <textarea class=\"form-control\" name=\"answer[]\" rows=\"5\" placeholder=\"Enter your answer\"></textarea>                                      </div>', 'fa fa-quote-right', 'rgb(148, 174, 137)'),
(14, 'Website', '...', '<div class=\"form-group input-content\">\r\n    <input type=\"url\" class=\"form-control\" name=\"answer[]\" id=\"for_email\" placeholder=\"name@example.com\">\r\n  </div>', 'fa fa-link', 'rgb(186, 194, 108)'),
(15, 'Dropdown', '...', '  <div class=\"form-group input-content\">\r\n    <label for=\"exampleFormControlSelect1\">Example select</label>\r\n    <select class=\"form-control\" id=\"exampleFormControlSelect1\">\r\n      <option>1</option>\r\n      <option>2</option>\r\n      <option>3</option>\r\n      <option>4</option>\r\n      <option>5</option>\r\n    </select>\r\n  </div>', 'fa fa-chevron-down', 'rgb(88, 69, 122)'),
(16, 'Payment', '...', ' <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group required\'>\r\n                                <label class=\'control-label\'>Name on Card</label> <input\r\n                                    class=\'form-control\' size=\'4\' type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n     \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 form-group card required\'>\r\n                                <label class=\'control-label\'>Card Number</label> <input\r\n                                    autocomplete=\'off\' class=\'form-control card-number\' size=\'20\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-xs-12 col-md-4 form-group cvc required\'>\r\n                                <label class=\'control-label\'>CVC</label> <input autocomplete=\'off\'\r\n                                    class=\'form-control card-cvc\' placeholder=\'ex. 311\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Month</label> <input\r\n                                    class=\'form-control card-expiry-month\' placeholder=\'MM\' size=\'2\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                            <div class=\'col-xs-12 col-md-4 form-group expiration required\'>\r\n                                <label class=\'control-label\'>Expiration Year</label> <input\r\n                                    class=\'form-control card-expiry-year\' placeholder=\'YYYY\' size=\'4\'\r\n                                    type=\'text\'>\r\n                            </div>\r\n                        </div>\r\n      \r\n                        <div class=\'form-row row\'>\r\n                            <div class=\'col-md-12 error form-group hide\'>\r\n                                <div class=\'alert-danger alert\'>Please correct the errors and try\r\n                                    again.</div>\r\n                            </div>\r\n                        </div>', 'fa fa-credit-card', 'rgb(69, 122, 83)'),
(17, 'Date', '...', '<div class=\"form-group input-content\">                                          <input type=\"date\" class=\"form-control\" name=\"answer[]\" value=\"\" placeholder=\"Enter your answer\">                                       </div>', 'fa fa-calendar-alt', 'rgb(240, 159, 151)'),
(18, 'File', '...', '<div class=\"form-group input-content\">\r\n<div class=\"input-group\">\r\n  <div class=\"input-group-prepend\">\r\n    <span class=\"input-group-text\">Upload</span>\r\n  </div>\r\n  <div class=\"custom-file\">\r\n    <input name=\"answer[]\" type=\"file\" class=\"custom-file-input\" id=\"inputGroupFile01\">\r\n    <label class=\"custom-file-label\" for=\"inputGroupFile01\">Choose file</label>\r\n  </div>\r\n</div></div>\r\n', 'fa fa-folder', 'rgb(60, 105, 151)'),
(19, 'Closing Screen', 'Closing Screen', '', 'fa fa-clone', 'rgb(158, 118, 233)');

-- --------------------------------------------------------

--
-- Table structure for table `timesheet`
--

DROP TABLE IF EXISTS `timesheet`;
CREATE TABLE `timesheet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `clock_in` timestamp NULL DEFAULT NULL,
  `clock_out` timestamp NULL DEFAULT NULL,
  `session_key` varchar(255) NOT NULL,
  `clock_in_limit` int(11) NOT NULL DEFAULT '20',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `time_record`
--

DROP TABLE IF EXISTS `time_record`;
CREATE TABLE `time_record` (
  `timesheet_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `action` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'In\\nOut\\njob-in\\nJob-out\\nlunch-in\\nlunch-out',
  `timestamp` datetime DEFAULT NULL,
  `entry_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'manual\\nclock\\nadjusted',
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `profile_img` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FName`, `LName`, `username`, `email`, `password`, `password_plain`, `last_login`, `role`, `reset_token`, `status`, `created_at`, `updated_at`, `profile_img`, `company_id`) VALUES
(2, 'john ', 'smith', 'admin', 'support@nsmartrac.com', '2fcc60a9f1471784dfa4407e8bcdff01cca9bd27a9174ad3177f1ba2bb65850c', 'sony@123', '2020-05-27 06:05:11', 3, '', 1, '0000-00-00 00:00:00', '2020-05-26 19:41:56', 0, 1),
(3, 'Bart', 'Simpson', 'bsimpson', 'bsimpson@test.com', '2fcc60a9f1471784dfa4407e8bcdff01cca9bd27a9174ad3177f1ba2bb65850c', 'sony@123', '0000-00-00 00:00:00', 4, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1),
(4, 'Tech', 'Guy', 'techguy1', 'techguy1@test.com', '2fcc60a9f1471784dfa4407e8bcdff01cca9bd27a9174ad3177f1ba2bb65850c', 'sony@123', '0000-00-00 00:00:00', 7, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1),
(5, 'Tommy', 'n', 'tommy', 'tommy@nsmartrac.com', '2fcc60a9f1471784dfa4407e8bcdff01cca9bd27a9174ad3177f1ba2bb65850c', 'sony@123', '0000-00-00 00:00:00', 1, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 2),
(6, 'Jon', 'c', 'jonc', 'jonc@nsmartrac.com', '2fcc60a9f1471784dfa4407e8bcdff01cca9bd27a9174ad3177f1ba2bb65850c', 'sony@123', '0000-00-00 00:00:00', 1, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE `user_details` (
  `details_id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `business_URL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_has_users`
--

DROP TABLE IF EXISTS `vendor_has_users`;
CREATE TABLE `vendor_has_users` (
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='contacts';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`,`user_id`);

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
-- Indexes for table `business_profile`
--
ALTER TABLE `business_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies_has_modules`
--
ALTER TABLE `companies_has_modules`
  ADD PRIMARY KEY (`company_id`,`modules_id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`contracts_id`);

--
-- Indexes for table `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD PRIMARY KEY (`credit_cards_id`);

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
-- Indexes for table `customer_settings`
--
ALTER TABLE `customer_settings`
  ADD PRIMARY KEY (`customer_settings_id`);

--
-- Indexes for table `custom_forms`
--
ALTER TABLE `custom_forms`
  ADD PRIMARY KEY (`forms_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employees_id`);

--
-- Indexes for table `estimates`
--
ALTER TABLE `estimates`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `form_responses`
--
ALTER TABLE `form_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gps_location`
--
ALTER TABLE `gps_location`
  ADD PRIMARY KEY (`gps_location_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `invoice_has_items`
--
ALTER TABLE `invoice_has_items`
  ADD PRIMARY KEY (`invoice_id`,`item_id`);

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
  ADD PRIMARY KEY (`id`,`loc_id`);

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
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`modules_id`);

--
-- Indexes for table `nsmart_plans`
--
ALTER TABLE `nsmart_plans`
  ADD PRIMARY KEY (`nsmart_plans_id`);

--
-- Indexes for table `nsmart_plans_has_modules`
--
ALTER TABLE `nsmart_plans_has_modules`
  ADD PRIMARY KEY (`nsmart_plans_id`,`modules_id`);

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
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`Questions_id`);

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
-- Indexes for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_record`
--
ALTER TABLE `time_record`
  ADD PRIMARY KEY (`timesheet_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`details_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `business_profile`
--
ALTER TABLE `business_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `contracts_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_cards`
--
ALTER TABLE `credit_cards`
  MODIFY `credit_cards_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_settings`
--
ALTER TABLE `customer_settings`
  MODIFY `customer_settings_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_forms`
--
ALTER TABLE `custom_forms`
  MODIFY `forms_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employees_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `estimates`
--
ALTER TABLE `estimates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filevault`
--
ALTER TABLE `filevault`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_folders`
--
ALTER TABLE `file_folders`
  MODIFY `folder_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_responses`
--
ALTER TABLE `form_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gps_location`
--
ALTER TABLE `gps_location`
  MODIFY `gps_location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `item_categories_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_settings`
--
ALTER TABLE `job_settings`
  MODIFY `job_settings_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `modules_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nsmart_plans`
--
ALTER TABLE `nsmart_plans`
  MODIFY `nsmart_plans_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `options_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `phone_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plan_type`
--
ALTER TABLE `plan_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `Questions_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `records_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `survey_answer`
--
ALTER TABLE `survey_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `survey_template_answer`
--
ALTER TABLE `survey_template_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

--
-- AUTO_INCREMENT for table `survey_template_questions`
--
ALTER TABLE `survey_template_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `timesheet`
--
ALTER TABLE `timesheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_record`
--
ALTER TABLE `time_record`
  MODIFY `timesheet_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_has_users`
--
ALTER TABLE `vendor_has_users`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
