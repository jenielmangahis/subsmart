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
-- Table structure for table `acs_tech`
--

CREATE TABLE `acs_tech` (
  `tech_id` int(11) NOT NULL,
  `fk_prof_id` int(11) UNSIGNED NOT NULL,
  `tech_arrive_time` varchar(20) NOT NULL,
  `tech_complete_time` varchar(20) NOT NULL,
  `time_given` varchar(20) NOT NULL,
  `date_given` varchar(20) NOT NULL,
  `tech_assign` varchar(100) NOT NULL,
  `custom_field1` varchar(100) NOT NULL,
  `custom_field2` varchar(100) NOT NULL,
  `custom_field3` varchar(100) NOT NULL,
  `custom_field4` varchar(100) NOT NULL,
  `url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acs_tech`
--

INSERT INTO `acs_tech` (`tech_id`, `fk_prof_id`, `tech_arrive_time`, `tech_complete_time`, `time_given`, `date_given`, `tech_assign`, `custom_field1`, `custom_field2`, `custom_field3`, `custom_field4`, `url`) VALUES
(1, 3, '3456', '', '', '8/29/2020', '', '', '', '', 'sdfg', 'sdfg'),
(2, 6, '534', '45', '54', '8/29/2020', 'hg', 'fgdh', 'fgh', '', 'fgd', 'fgh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acs_tech`
--
ALTER TABLE `acs_tech`
  ADD PRIMARY KEY (`tech_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acs_tech`
--
ALTER TABLE `acs_tech`
  MODIFY `tech_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
