-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 18, 2020 at 12:59 PM
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
-- Table structure for table `business_settings`
--

DROP TABLE IF EXISTS `business_settings`;
CREATE TABLE `business_settings` (
  `business_id` int(11) NOT NULL,
  `b_name` varchar(255) NOT NULL,
  `b_email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `is_emergency_support` int(11) DEFAULT NULL COMMENT '1=true',
  `year_est` char(4) DEFAULT NULL,
  `employee_count` int(6) DEFAULT NULL,
  `is_subcontract_allowed` int(1) DEFAULT NULL,
  `EIN` char(9) DEFAULT NULL,
  `business_desc` text,
  `logo_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL,
  `nsmart_plans_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
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
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `published` tinyint(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_published` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

DROP TABLE IF EXISTS `survey_questions`;
CREATE TABLE `survey_questions` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `question` text NOT NULL,
  `template_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `active` int(11) DEFAULT NULL,
  `required` int(11) DEFAULT NULL,
  `description` int(1) NOT NULL DEFAULT '0',
  `description_label` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `survey_template_questions`
--

DROP TABLE IF EXISTS `survey_template_questions`;
CREATE TABLE `survey_template_questions` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `last_login` datetime NOT NULL,
  `role` int(11) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `profile_img` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FName`, `LName`, `username`, `email`, `password`, `password_plain`, `last_login`, `role`, `reset_token`, `status`, `created_at`, `updated_at`, `profile_img`, `company_id`) VALUES
(2, 'ad', 'min', 'admin', 'support@nsmartrac.com', '2fcc60a9f1471784dfa4407e8bcdff01cca9bd27a9174ad3177f1ba2bb65850c', 'sony@123', '2020-05-18 20:05:10', 1, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 2);

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
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`business_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`,`nsmart_plans_id`);

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
-- Indexes for table `files`
--
ALTER TABLE `files`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `business_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `employees_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estimates`
--
ALTER TABLE `estimates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
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
  MODIFY `permissions_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_template_answer`
--
ALTER TABLE `survey_template_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_template_questions`
--
ALTER TABLE `survey_template_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
