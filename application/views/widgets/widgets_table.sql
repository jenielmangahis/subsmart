-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2021 at 06:32 AM
-- Server version: 5.6.38
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
CREATE TABLE `widgets` (
  `w_id` int(11) NOT NULL,
  `w_name` char(255) NOT NULL,
  `w_description` varchar(300) NOT NULL,
  `w_view_link` char(100) NOT NULL,
  `w_icon` char(35) DEFAULT NULL,
  `w_more_options` varchar(300) NOT NULL,
  `w_has_sublink` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`w_id`, `w_name`, `w_description`, `w_view_link`, `w_icon`, `w_more_options`, `w_has_sublink`) VALUES
(1, 'Shortcuts', 'List of quick access icon', 'widgets/shortcuts', NULL, '', 0),
(2, 'Timesheet', 'View Login and Logout logs for Employees', 'dashboard/bulletin', NULL, '', 0),
(3, 'Upcoming Jobs', 'Check for upcoming jobs available', 'widgets/upcoming_jobs', NULL, '', 0),
(4, 'Jobs', 'Current Jobs Listed', 'widgets/jobs', NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `widgets_group`
--

DROP TABLE IF EXISTS `widgets_group`;
CREATE TABLE `widgets_group` (
  `wg_id` int(11) NOT NULL,
  `wg_user_id` int(11) NOT NULL,
  `wg_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `widgets_users`
--

DROP TABLE IF EXISTS `widgets_users`;
CREATE TABLE `widgets_users` (
  `wu_id` int(11) NOT NULL,
  `wu_user_id` int(11) NOT NULL,
  `wu_widget_id` int(11) NOT NULL,
  `wu_group_id` int(11) NOT NULL,
  `wu_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`w_id`);

--
-- Indexes for table `widgets_group`
--
ALTER TABLE `widgets_group`
  ADD PRIMARY KEY (`wg_id`);

--
-- Indexes for table `widgets_users`
--
ALTER TABLE `widgets_users`
  ADD PRIMARY KEY (`wu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `widgets_group`
--
ALTER TABLE `widgets_group`
  MODIFY `wg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `widgets_users`
--
ALTER TABLE `widgets_users`
  MODIFY `wu_id` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
