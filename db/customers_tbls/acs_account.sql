-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2020 at 02:47 AM
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
-- Dumping data for table `acs_account`
--

INSERT INTO `acs_account` (`acct_id`, `fk_prof_id`, `entered_by`, `time_entered`, `sales_date`, `credit_score`, `mon_comp`, `acct_type`, `mon_id`, `language`, `signal_confirm_num`, `mon_confirmation`, `abort_code`, `sales_rep`, `technician`, `save_date`, `save_by`, `cancel_date`, `cancel_reason`, `sched_conflict`, `install_date`, `tech_arrive_time`, `tech_depart_time`, `panel_type`, `pre_install_survey`, `post_install_survey`, `mon_waived`, `rebate_offer`, `rebate_check1`, `amount1`, `rebate_check2`, `amount2`, `activation_fee`, `way_of_pay`, `lead_source`) VALUES
(1, 3, 'asadf', '654', '8/28/2020', 46, '1102', '', 6346, '', 456, '5546', 657, 0, '', '8/28/2020', '', '8/28/2020', '', 0, '8/28/2020', '567', '67', '', '', '', '0', 0, '6', '56.00', '6', '65.00', '0.00', '0', 'Door');

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
  MODIFY `acct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
