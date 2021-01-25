-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2021 at 01:57 PM
-- Server version: 5.7.33
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admintom_nsmart_companies`
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
(65, 'Calendar', 'css/icons/images/schedule-icon.svg', 1, 1),
(68, 'Work calendar', '', 1, 1),
(69, 'Accounting', '/css/icons/images/cash-1.1s-47px.svg', 1, 1);

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
(3, 'Update Calendar', 65, 'updateCalendar', 'You use this if you wish to do some changes in your calendar'),
(4, 'Saving Estimate', 69, 'saveEstimate', 'Estimate form'),
(5, 'Payment Method', 69, 'savepaymethod', 'Adding new payment method'),
(6, 'Receive Payment', 69, 'addReceivePayment', 'Receive Payment form'),
(7, '', 65, '', ''),
(8, 'Create Event Form', 65, 'get_event_form', 'Loads create event form'),
(9, 'Upcoming Events', 65, 'load_upcoming_events', 'Loads upcoming events list'),
(10, 'Google Calendar', 65, 'load_calendar', 'Show enabled google calendar'),
(11, 'Google Event', 65, '_create_google_event', 'Save event to your google public calendar'),
(12, 'Google Calendar', 65, '_create_google_calendar', 'Creates google public calendar'),
(13, 'Scheduled Estimates', 65, '_load_scheduled_estimates', 'Loads scheduled estimates'),
(14, 'Settings', 65, 'settings/schedule', 'For changing calendar timezone and bind google accounts');

-- --------------------------------------------------------

--
-- Table structure for table `wizard_workspace`
--

DROP TABLE IF EXISTS `wizard_workspace`;
CREATE TABLE `wizard_workspace` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wizard_workspace`
--

INSERT INTO `wizard_workspace` (`id`, `name`, `created_at`) VALUES
(13, 'Universal Flow Templates', '2020-08-18 01:40:54'),
(14, 'tommy', '2020-08-18 09:19:27'),
(15, 'Testing 19', '2020-08-19 02:02:51'),
(16, 'Construction Industry Flow Templatess', '2020-08-19 02:36:28');

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
-- Indexes for table `wizard_workspace`
--
ALTER TABLE `wizard_workspace`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wizard_apps`
--
ALTER TABLE `wizard_apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `wizard_app_function`
--
ALTER TABLE `wizard_app_function`
  MODIFY `wiz_app_func_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wizard_workspace`
--
ALTER TABLE `wizard_workspace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
