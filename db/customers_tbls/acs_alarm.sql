-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2020 at 05:15 AM
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
  `contact4` varchar(100) NOT NULL,
  `contact5` varchar(100) NOT NULL,
  `contact6` varchar(100) NOT NULL,
  `panel_type` varchar(100) NOT NULL,
  `system_type` varchar(100) NOT NULL,
  `mon_waived` varchar(100) NOT NULL,
  `rebate_offer` decimal(10,2) NOT NULL,
  `verification` varchar(100) NOT NULL,
  `rebate_check1` decimal(10,2) NOT NULL,
  `rebate_check2` decimal(10,2) NOT NULL,
  `warranty_type` varchar(100) NOT NULL,
  `custom_field1_alarm` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acs_alarm`
--
ALTER TABLE `acs_alarm`
  ADD PRIMARY KEY (`alarm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acs_alarm`
--
ALTER TABLE `acs_alarm`
  MODIFY `alarm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
