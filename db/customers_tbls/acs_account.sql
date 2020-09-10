-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2020 at 05:14 AM
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
-- Table structure for table `acs_account`
--

CREATE TABLE `acs_account` (
  `acct_id` int(11) NOT NULL,
  `fk_prof_id` int(2) NOT NULL,
  `entered_by` varchar(100) NOT NULL,
  `time_entered` varchar(50) NOT NULL,
  `sales_date` varchar(20) NOT NULL,
  `credit_score` int(11) NOT NULL,
  `mon_comp` varchar(100) NOT NULL,
  `acct_type` varchar(20) NOT NULL,
  `mon_id` int(50) NOT NULL,
  `language` varchar(30) NOT NULL,
  `signal_confirm_num` int(50) NOT NULL,
  `mon_confirmation` varchar(100) NOT NULL,
  `abort_code` int(100) NOT NULL,
  `sales_rep` int(2) NOT NULL,
  `technician` varchar(100) NOT NULL,
  `save_date` varchar(20) NOT NULL,
  `save_by` varchar(100) NOT NULL,
  `cancel_date` varchar(20) NOT NULL,
  `cancel_reason` varchar(50) NOT NULL,
  `sched_conflict` int(2) NOT NULL,
  `install_date` varchar(20) NOT NULL,
  `tech_arrive_time` varchar(20) NOT NULL,
  `tech_depart_time` varchar(20) NOT NULL,
  `panel_type` varchar(50) NOT NULL,
  `pre_install_survey` varchar(20) NOT NULL,
  `post_install_survey` varchar(20) NOT NULL,
  `mon_waived` varchar(100) NOT NULL,
  `rebate_offer` int(2) NOT NULL,
  `rebate_check1` varchar(50) NOT NULL,
  `amount1` decimal(10,2) NOT NULL,
  `rebate_check2` varchar(50) NOT NULL,
  `amount2` decimal(10,2) NOT NULL,
  `activation_fee` decimal(10,2) NOT NULL,
  `way_of_pay` decimal(20,0) NOT NULL,
  `lead_source` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acs_account`
--
ALTER TABLE `acs_account`
  ADD PRIMARY KEY (`acct_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acs_account`
--
ALTER TABLE `acs_account`
  MODIFY `acct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
