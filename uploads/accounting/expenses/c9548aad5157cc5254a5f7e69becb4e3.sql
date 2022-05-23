-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2021 at 01:23 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` int(11) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `about` text NOT NULL,
  `comments` text NOT NULL,
  `notify_email` tinyint(1) NOT NULL DEFAULT 0,
  `notify_sms` tinyint(1) NOT NULL DEFAULT 0,
  `employment_type` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `date_hired` date NOT NULL,
  `pay_type` varchar(255) NOT NULL,
  `pay_rate` decimal(8,2) NOT NULL,
  `travel_rate` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `profile_img` text DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `img_type` text NOT NULL,
  `profile_img_type` varchar(100) NOT NULL DEFAULT '',
  `address` int(11) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `menus` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FName`, `LName`, `username`, `email`, `password`, `password_plain`, `last_login`, `role`, `reset_token`, `status`, `about`, `comments`, `notify_email`, `notify_sms`, `employment_type`, `birthdate`, `date_hired`, `pay_type`, `pay_rate`, `travel_rate`, `created_at`, `updated_at`, `profile_img`, `company_id`, `img_type`, `profile_img_type`, `address`, `phone`, `mobile`, `menus`) VALUES
(2, 'Lauren', 'Williams', 'Lauren', 'support@nsmartrac.com', '1be0222750aaf3889ab95b5d593ba12e4ff1046474702d6b4779f4b527305b23', 'Password2', '2021-01-06 21:31:51', 1, '$2y$10$QHAQRM8x5JmAkGg6lnXDlOXU9mjDyRKEwdA9XQ04OoRrCF15X4VTG', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '0000-00-00 00:00:00', '2021-01-07 09:51:42', 'p_2', 1, 'jpg', '0', 0, '0', '', 'Work Order, Tasks, Bulletin, Wizard, Files Vault, Trac360, Reports, Estimates, Accounting, Marketing, Leads, Invoices, Cost Estimator, Route Planner, Customers, Collage Maker, Virtual Estimator, Inventory, Quick Links, Business Contacts, Employees, Time Clock, eSign, Calendar'),
(5, 'Tommy', 'N', 'tommy', 'tommy@nsmartrac.com', '2a931915c226b6fa050191e0e32f44a9882d76a595bbf7de63109fdc6b2ec416', 'sony@123', '2020-08-28 14:09:24', 1, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '0000-00-00 00:00:00', '2020-08-28 14:09:24', NULL, 2, '', '0', 0, '', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(6, 'Jon', 'C', 'jonc', 'jonc@nsmartrac.com', '2fcc60a9f1471784dfa4407e8bcdff01cca9bd27a9174ad3177f1ba2bb65850c', 'sony@123', '2020-09-22 04:09:53', 1, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '0000-00-00 00:00:00', '2020-09-22 04:53:28', NULL, 2, '', '0', 0, '', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(10, 'Stephen', 'Cabalida', 'stephen', 'stephencabalida80@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-09-13 07:22:39', 38, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-07-06 21:55:34', '2020-09-13 07:22:39', NULL, 1, 'jpg', '0', 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(11, 'Artemeo', 'Alberca', 'artemeo', 'jeykell125@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-11-22 07:11:58', 38, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-07-06 22:01:38', '2020-11-22 21:58:45', NULL, 1, 'jpg', '0', 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(12, 'Jerry ', 'Tiu', 'jerry', 'rarecandy06@gmail.co', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-11-05 09:11:04', 22, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-07-06 22:03:08', '2020-11-05 09:04:16', NULL, 1, 'jpg', '0', 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(13, 'Welyelf', 'Hisula', 'welyelf', 'wrhisula1123@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-09-12 13:25:58', 22, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-07-06 22:04:46', '2020-09-12 13:25:58', NULL, 1, 'jpg', '0', 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(14, 'Jonah ', 'Pacas-Abanil', 'jonah', 'jpabanil@icloud.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-11-11 11:11:58', 22, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-07-06 22:08:07', '2020-11-11 11:58:55', NULL, 1, 'jpg', '0', 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(15, 'Gil', 'Francis Carillo', 'gil', 'gilfranciscarillo@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-11-11 07:11:16', 22, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-07-06 22:10:45', '2020-11-11 07:16:28', NULL, 1, 'jpg', '0', 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(16, 'Neil', 'Diagdal', 'neil', 'neildiagdal@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-08-28 14:09:24', 6, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-07-06 22:12:20', '2020-08-28 14:09:24', NULL, 1, '', '0', 0, '', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(17, 'Bryann', 'Revina', 'bryann', 'bryann.revina03@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-09-12 13:28:50', 22, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-07-06 22:13:35', '2020-09-12 13:28:50', NULL, 1, 'jpg', '0', 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(18, 'Gene', 'Terry Rejano', 'gene', 'geneterryrejano@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-08-28 14:09:24', 6, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-07-06 22:17:19', '2020-08-28 14:09:24', NULL, 1, '', '0', 0, '', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(22, 'Nik', 'Estrada', 'nik', 'logicalcodes09@gmail.com', '19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd', 'Password1', '2020-11-06 14:11:44', 22, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-07-07 04:02:46', '2020-11-06 14:44:51', NULL, 1, 'jpg', '0', 0, '0', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(23, 'Tommy', 'Nguyen', '', 'sales@nsmartrac.com', '', '', '2020-08-28 14:09:24', 0, '', 1, '', '', 0, 1, '', '1971-11-06', '2020-07-25', '', '1.00', '12.00', '2020-07-25 20:37:08', '2020-08-28 14:09:24', '0', 1, '', '0', 0, '', '', 'Leads, Customers, Estimates, Invoices, Calendar, Work Order, Employees, Route Planner, Reports, Inventory, Quick Links, Business Contacts, Accounting, Files Vault, eSign, Tasks, Bulletin, Collage Maker, Cost Estimator, Virtual Estimator, Time Clock, Marketing, Trac360, Wizard'),
(24, 'fdf', 'dfdf', 'bryann@gmail.com', 'bryann@gmail.com', '496ab265df01fa02e5e0bacbd0a7977f783598cb79552ebad0601c8b19ed0aae', 'dfdsfd', '2020-09-15 02:41:19', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-09-15 02:41:19', '0000-00-00 00:00:00', NULL, 1, '', '0', 0, '', '', NULL),
(25, 'test bryan5', 'test last', 'testbryann5@gmail.com', 'testbryann5@gmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', 'abc123', '2020-09-15 08:26:37', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-09-15 08:26:37', '0000-00-00 00:00:00', NULL, 2, '', '0', 0, '', '', NULL),
(26, 'test bryan 5', 'test last', 'testbryab5@gmail.com', 'testbryab5@gmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', 'abc123', '2020-09-15 08:35:59', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-09-15 08:35:59', '0000-00-00 00:00:00', NULL, 3, '', '0', 0, '', '', NULL),
(27, 'Bry', 'Rev', 'bryann@gmail.com', 'bryann@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '123456', '2020-09-23 13:10:20', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-09-23 13:10:20', '0000-00-00 00:00:00', NULL, 4, '', '', 0, '', '', NULL),
(28, 'Bry', 'Rev', 'bryann@gmail.com', 'bryann@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '123456', '2020-09-23 13:12:17', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-09-23 13:12:17', '0000-00-00 00:00:00', NULL, 5, '', '', 0, '', '', NULL),
(29, 'Bry', 'Rev', 'bryann@gmail.com', 'bryann@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '123456', '2020-09-23 13:12:52', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-09-23 13:12:52', '0000-00-00 00:00:00', NULL, 6, '', '', 0, '', '', NULL),
(30, 'Bry', 'Rev', 'bryann@gmail.com', 'bryann@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '123456', '2020-09-23 13:14:06', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-09-23 13:14:06', '0000-00-00 00:00:00', NULL, 7, '', '', 0, '', '', NULL),
(31, 'Bryann', 'Revina', 'bryann.revina03@gmail.com', 'bryann.revina03@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '123456', '2020-09-23 13:22:25', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-09-23 13:22:25', '0000-00-00 00:00:00', NULL, 8, '', '', 0, '', '', NULL),
(32, 'Bryann', 'Revina', 'bryann.revina03@gmail.com', 'bryann.revina03@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '123456', '2020-09-23 13:30:09', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-09-23 13:30:09', '0000-00-00 00:00:00', NULL, 9, '', '', 0, '', '', NULL),
(33, 'Bryann', 'Revina', 'bry.revina@test.com', 'bry.revina@test.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '123456', '2020-09-23 13:36:24', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-09-23 13:36:24', '0000-00-00 00:00:00', NULL, 10, '', '', 0, '', '', NULL),
(34, 'Bryann', 'Revina', 'bryann@gmail.com', 'bryann@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '123456', '2020-09-24 06:30:03', 0, '', 0, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-09-24 06:30:03', '0000-00-00 00:00:00', NULL, 11, '', '', 0, '', '', NULL),
(35, 'Bryann', 'Revina', 'bryann.revina03@gmail.com', 'bryann.revina03@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '123456', '2020-09-24 06:39:39', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-09-24 06:36:31', '2020-09-24 06:39:39', NULL, 1, '', '', 0, '', '', NULL),
(36, 'Bryann', 'Revina', 'bryann.revina0@gmail.com', 'bryann.revina0@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '123456', '2020-10-06 02:47:28', 0, '', 0, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-10-06 02:47:28', '0000-00-00 00:00:00', NULL, 1, '', '', 0, '', '', NULL),
(37, 'testbryan11', 'revina', 'testbryan11@test.com', 'testbryan11@test.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', 'abc123', '2020-10-11 18:10:39', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-10-12 07:30:02', '2020-10-12 07:39:17', NULL, 2, '', '', 0, '', '', NULL),
(38, 'test bryan 11', 'revina', 'testbryan11@test.com', 'testbryan11@test.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', 'abc123', '2020-10-12 08:10:24', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-10-12 08:09:39', '2020-10-12 08:10:24', NULL, 3, '', '', 0, '', '', NULL),
(39, 'test bryan 11', 'revina', 'testbryan11@test.com', 'testbryan11@test.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', 'abc123', '2020-10-13 09:24:03', 0, '', 0, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-10-13 09:24:03', '0000-00-00 00:00:00', NULL, 4, '', '', 0, '', '', NULL),
(40, 'test bryan 12', 'revina', 'testbryan12@test.com', 'testbryan12@test.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', 'abc123', '2020-10-26 22:10:08', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-10-27 11:07:11', '2020-10-27 11:08:38', NULL, 5, '', '', 0, '', '', NULL),
(41, 'test bryann12', 'revina', 'testbryann12@gmail.com', 'testbryann12@gmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', 'abc123', '2020-10-26 22:10:13', 0, '', 1, '', '', 0, 0, '', '0000-00-00', '0000-00-00', '', '0.00', '0.00', '2020-10-27 11:12:41', '2020-10-27 11:13:37', NULL, 6, '', '', 0, '', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
