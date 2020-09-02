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
-- Table structure for table `acs_admin`
--

CREATE TABLE `acs_admin` (
  `admin_id` int(11) NOT NULL,
  `fk_prof_id` int(2) NOT NULL,
  `entered_by` varchar(100) NOT NULL,
  `time_entered` varchar(20) NOT NULL,
  `assign_to` varchar(100) NOT NULL,
  `pre_install_survey` varchar(200) NOT NULL,
  `custom_field1` varchar(100) NOT NULL,
  `language` varchar(20) NOT NULL,
  `date_enter` varchar(20) NOT NULL,
  `sales_rep` int(2) NOT NULL,
  `post_install_survey` varchar(100) NOT NULL,
  `custom_field2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acs_admin`
--

INSERT INTO `acs_admin` (`admin_id`, `fk_prof_id`, `entered_by`, `time_entered`, `assign_to`, `pre_install_survey`, `custom_field1`, `language`, `date_enter`, `sales_rep`, `post_install_survey`, `custom_field2`) VALUES
(1, 3, 'asdf', 'asdf', 'asdf', 'asdf', '', '', '8/29/2020', 3, 'dfs', 'sdaf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acs_admin`
--
ALTER TABLE `acs_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acs_admin`
--
ALTER TABLE `acs_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
