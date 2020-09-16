-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2020 at 06:28 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nsmartrac`
--

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
-- Indexes for dumped tables
--

--
-- Indexes for table `acs_office`
--
ALTER TABLE `acs_office`
  ADD PRIMARY KEY (`off_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acs_office`
--
ALTER TABLE `acs_office`
  MODIFY `off_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
