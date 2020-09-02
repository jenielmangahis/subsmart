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
-- Table structure for table `acs_access`
--

CREATE TABLE `acs_access` (
  `access_id` int(11) NOT NULL,
  `fk_prof_id` int(11) UNSIGNED NOT NULL,
  `portal_status` varchar(20) NOT NULL,
  `reset_password` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `custom_field1` varchar(100) NOT NULL,
  `custom_field2` varchar(100) NOT NULL,
  `cancel_date` varchar(20) NOT NULL,
  `collect_date` varchar(20) NOT NULL,
  `cancel_reason` varchar(250) NOT NULL,
  `collect_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acs_access`
--

INSERT INTO `acs_access` (`access_id`, `fk_prof_id`, `portal_status`, `reset_password`, `login`, `password`, `custom_field1`, `custom_field2`, `cancel_date`, `collect_date`, `cancel_reason`, `collect_amount`) VALUES
(1, 3, '1', '', '', '', '', '', '8/29/2020', '8/29/2020', '', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acs_access`
--
ALTER TABLE `acs_access`
  ADD PRIMARY KEY (`access_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acs_access`
--
ALTER TABLE `acs_access`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
