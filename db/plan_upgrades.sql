-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2020 at 09:37 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

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
-- Table structure for table `plan_upgrades`
--

CREATE TABLE `plan_upgrades` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sms_fee` float NOT NULL,
  `service_fee` float NOT NULL,
  `status` smallint(6) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_upgrades`
--

INSERT INTO `plan_upgrades` (`id`, `name`, `description`, `sms_fee`, `service_fee`, `status`, `date_created`, `date_modified`) VALUES
(3, 'Online Booking', 'Set your services with prices and place a booking form on your website and collect leads from your customers.', 0.05, 5, 1, '2020-11-03 04:17:33', '0000-00-00 00:00:00'),
(4, 'Lead Contact Form', 'Lead Contact Form description', 0.05, 5, 1, '2020-11-03 04:18:12', '0000-00-00 00:00:00'),
(5, 'Ask for Review', 'Ask for Review Description', 0.05, 5, 1, '2020-11-03 04:19:11', '2020-11-03 04:25:03'),
(6, 'Virtual Number', 'Virtual Number Description', 0.05, 5, 1, '2020-11-03 04:19:45', '0000-00-00 00:00:00'),
(7, 'Call Forwarding', 'Call Forwarding Description', 0.05, 5, 1, '2020-11-03 04:20:17', '0000-00-00 00:00:00'),
(8, 'Campaign Builder', 'Campaign Builder Description', 0.05, 5, 1, '2020-11-03 04:20:49', '0000-00-00 00:00:00'),
(9, 'Estimator', 'Estimator Description', 0.05, 5, 1, '2020-11-03 04:21:20', '0000-00-00 00:00:00'),
(10, 'Wizard', 'Wizard Description', 0.05, 5, 1, '2020-11-03 04:21:42', '0000-00-00 00:00:00'),
(11, 'Credit Report', 'Credit Report Description', 0.05, 5, 1, '2020-11-03 04:22:12', '0000-00-00 00:00:00'),
(12, 'Video Estimate', 'Video Estimate Description', 0.05, 5, 1, '2020-11-03 04:22:43', '0000-00-00 00:00:00'),
(13, 'Payroll', 'Payroll description', 0.05, 5, 1, '2020-11-03 04:23:06', '0000-00-00 00:00:00'),
(14, 'Inventory Management', 'Inventory Management Description', 0.05, 5, 1, '2020-11-03 04:23:43', '0000-00-00 00:00:00'),
(15, 'My Accountant', 'My Accountant Description', 0.05, 5, 1, '2020-11-03 04:24:16', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plan_upgrades`
--
ALTER TABLE `plan_upgrades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plan_upgrades`
--
ALTER TABLE `plan_upgrades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
