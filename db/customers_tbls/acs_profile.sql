-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2020 at 02:48 AM
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
-- Table structure for table `acs_profile`
--

CREATE TABLE `acs_profile` (
  `prof_id` int(11) NOT NULL,
  `fk_user_id` int(2) NOT NULL,
  `fk_sa_id` int(2) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `prefix` varchar(15) NOT NULL,
  `suffix` varchar(20) NOT NULL,
  `business_name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ssn` varchar(50) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `phone_h` varchar(50) NOT NULL,
  `phone_w` varchar(50) NOT NULL,
  `phone_m` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `mail_add` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `cross_street` varchar(100) NOT NULL,
  `subdivision` varchar(100) NOT NULL,
  `img_path` text NOT NULL,
  `sched_conflict` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acs_profile`
--

INSERT INTO `acs_profile` (`prof_id`, `fk_user_id`, `fk_sa_id`, `first_name`, `last_name`, `middle_name`, `prefix`, `suffix`, `business_name`, `email`, `ssn`, `date_of_birth`, `phone_h`, `phone_w`, `phone_m`, `fax`, `mail_add`, `city`, `state`, `country`, `zip_code`, `cross_street`, `subdivision`, `img_path`, `sched_conflict`) VALUES
(3, 2, 3, 'sdfg', 'sdfg', 'dsfg', 'Cnl.', 'Esq.', 'sdfg', 'sdfg@sdfg.dfg', '3456', '08/27/2020', '4567', '4567', '5467', 'dfgh', 'dfgh', 'dfgh', 'dfgh', 'fgh', 'fdgh', 'fdgh', 'fgh', 'dfghg', 0),
(4, 2, 1, 'test', 'test', 'test', '0', '', '', 'test@gmail.com', '', '', '', '', '5467', 'dfgh', 'dfgh', 'dfgh', 'dfgh', 'fgh ', 'fdgh', 'fdgh', 'fgh', '', 0),
(5, 2, 3, 'Kobe', 'Bryant', 'C', 'Captain', 'DS', '', 'kobe@gmail.com', '', '', '6565656565', '', '', '', '', '', '', ' ', '', '', '', '', 0),
(6, 2, 1, 'asdf', 'asdf', 'asdf', '0', '', '', 'asdf@sf.dfg', '', '', '', '', '', '', '', '', '', ' ', '', '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acs_profile`
--
ALTER TABLE `acs_profile`
  ADD PRIMARY KEY (`prof_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acs_profile`
--
ALTER TABLE `acs_profile`
  MODIFY `prof_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
