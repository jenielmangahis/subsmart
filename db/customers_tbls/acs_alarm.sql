-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2020 at 06:27 AM
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
  `mon_waived` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acs_alarm`
--

INSERT INTO `acs_alarm` (`alarm_id`, `fk_prof_id`, `monitor_comp`, `monitor_id`, `install_date`, `credit_score_alarm`, `acct_type`, `acct_info`, `passcode`, `install_code`, `mcn`, `scn`, `contact1`, `contact2`, `contact3`, `contact4`, `contact5`, `contact6`, `panel_type`, `system_type`, `mon_waived`) VALUES
(5, 31, '', 0, '9/12/2020', 0, 'In-House', '', '', 0, 0, 0, '', '', '', '', '', '', 'DIGI', '', '');

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
  MODIFY `alarm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
