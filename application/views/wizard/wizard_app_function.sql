-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2021 at 06:38 PM
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
-- Table structure for table `wizard_apps`
--

DROP TABLE IF EXISTS `wizard_apps`;
CREATE TABLE `wizard_apps` (
  `id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_img` varchar(255) NOT NULL,
  `show_app` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= hide , 1= show',
  `defaultdata` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wizard_apps`
--

INSERT INTO `wizard_apps` (`id`, `app_name`, `app_img`, `show_app`, `defaultdata`) VALUES
(26, 'Gmail', 'wizard/img/google-ic2.png', 1, 1),
(45, 'Google Sheets', 'wizard/img/google-ic6.png', 1, 1),
(46, 'Google Calendar', 'wizard/img/google-ic4.png', 1, 1),
(47, 'Google Drive', 'wizard/img/google-ic5.png', 1, 1),
(49, 'Google Contacts', 'wizard/img/googlecontacts.jpg', 1, 1),
(50, 'Google Forms', 'wizard/img/googleforms.png', 1, 1),
(52, 'Evernote', 'wizard/img/evernote.png', 1, 1),
(53, 'Google Tasks', 'wizard/img/googletasks.png', 1, 1),
(54, 'Calendly', 'wizard/img/calendly.png', 1, 1),
(56, 'Google Docs', 'wizard/img/google-ic1.png', 1, 1),
(65, 'Calendar', 'css/icons/images/schedule-icon.svg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wizard_app_function`
--

DROP TABLE IF EXISTS `wizard_app_function`;
CREATE TABLE `wizard_app_function` (
  `wiz_app_func_id` int(11) NOT NULL,
  `wiz_app_nice_name` char(55) NOT NULL,
  `wiz_app_id` int(11) NOT NULL,
  `wiz_app_function` char(55) NOT NULL,
  `wiz_func_desc` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wizard_app_function`
--

INSERT INTO `wizard_app_function` (`wiz_app_func_id`, `wiz_app_nice_name`, `wiz_app_id`, `wiz_app_function`, `wiz_func_desc`) VALUES
(2, 'Create Calendar', 65, 'createCalendar', 'You use this if you want to have your own calendar.'),
(3, 'Update Calendar', 65, 'updateCalendar', 'You use this if you wish to do some changes in your calendar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wizard_apps`
--
ALTER TABLE `wizard_apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wizard_app_function`
--
ALTER TABLE `wizard_app_function`
  ADD PRIMARY KEY (`wiz_app_func_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wizard_apps`
--
ALTER TABLE `wizard_apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `wizard_app_function`
--
ALTER TABLE `wizard_app_function`
  MODIFY `wiz_app_func_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
