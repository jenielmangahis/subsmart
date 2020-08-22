-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2020 at 02:41 AM
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
-- Table structure for table `ac_leads`
--

CREATE TABLE `ac_leads` (
  `leads_id` int(11) NOT NULL,
  `fk_lead_id` int(11) NOT NULL,
  `fk_sa_id` int(11) NOT NULL,
  `fk_sr_id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middle_initial` varchar(10) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `suffix` varchar(10) NOT NULL,
  `st_number` varchar(100) NOT NULL,
  `st_direction` varchar(50) NOT NULL,
  `st_name` varchar(100) NOT NULL,
  `st_type` varchar(50) NOT NULL,
  `apt_ste_space` varchar(100) NOT NULL,
  `condo_name` varchar(200) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `county` varchar(100) NOT NULL,
  `country` varchar(10) NOT NULL,
  `phone_home` varchar(50) NOT NULL,
  `phone_cell` varchar(50) NOT NULL,
  `email_add` varchar(150) NOT NULL,
  `sss_num` varchar(100) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ac_leads`
--
ALTER TABLE `ac_leads`
  ADD PRIMARY KEY (`leads_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ac_leads`
--
ALTER TABLE `ac_leads`
  MODIFY `leads_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
