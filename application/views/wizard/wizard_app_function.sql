-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2021 at 03:01 AM
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
(65, 'Calendar', 'css/icons/images/schedule-icon.svg', 1, 1),
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
  `wiz_func_desc` varchar(300) NOT NULL,
  `has_config` tinyint(4) NOT NULL,
  `config_fn` char(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wizard_app_function`
--

INSERT INTO `wizard_app_function` (`wiz_app_func_id`, `wiz_app_nice_name`, `wiz_app_id`, `wiz_app_function`, `wiz_func_desc`, `has_config`, `config_fn`) VALUES
(4, 'Saving Estimate', 69, 'saveEstimate', 'Estimate form', 0, NULL),
(5, 'Payment Method', 69, 'savepaymethod', 'Adding new payment method', 0, NULL),
(6, 'Receive Payment', 69, 'addReceivePayment', 'Receive Payment form', 0, NULL),
(8, 'Create Event Form', 65, 'get_event_form', 'Loads create event form', 0, NULL),
(9, 'Upcoming Events', 65, 'load_upcoming_events', 'Loads upcoming events list', 0, NULL),
(10, 'Google Calendar', 65, 'load_calendar', 'Show enabled google calendar', 0, NULL),
(11, 'Google Event', 65, '_create_google_event', 'Save event to your google public calendar', 0, NULL),
(12, 'Google Calendar', 65, '_create_google_calendar', 'Creates google public calendar', 0, NULL),
(13, 'Scheduled Estimates', 65, '_load_scheduled_estimates', 'Loads scheduled estimates', 0, NULL),
(14, 'Settings', 65, 'settings/schedule', 'For changing calendar timezone and bind google accounts', 0, NULL),
(15, 'Send an Email', 26, 'sendEmail', 'Send an Email once the Trigger App is fired', 1, 'setupGmailSend');

-- --------------------------------------------------------

--
-- Table structure for table `wizard_automate`
--

DROP TABLE IF EXISTS `wizard_automate`;
CREATE TABLE `wizard_automate` (
  `wa_id` int(11) NOT NULL,
  `wa_name` char(55) NOT NULL,
  `wa_user_id` int(11) NOT NULL,
  `wa_trigger_app_id` int(11) NOT NULL,
  `wa_action_app_id` int(11) NOT NULL,
  `wa_is_enabled` tinyint(1) NOT NULL,
  `wa_date_created` datetime NOT NULL,
  `wa_date_enabled` datetime NOT NULL,
  `wa_date_disabled` datetime NOT NULL,
  `wa_config_data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wizard_automate`
--

INSERT INTO `wizard_automate` (`wa_id`, `wa_name`, `wa_user_id`, `wa_trigger_app_id`, `wa_action_app_id`, `wa_is_enabled`, `wa_date_created`, `wa_date_enabled`, `wa_date_disabled`, `wa_config_data`) VALUES
(1, 'Calendar to Gmail', 62, 8, 15, 1, '2021-01-27 02:30:58', '2021-01-27 02:30:58', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wizard_gmail_config`
--

DROP TABLE IF EXISTS `wizard_gmail_config`;
CREATE TABLE `wizard_gmail_config` (
  `id` int(11) NOT NULL,
  `wgc_user_id` int(11) NOT NULL,
  `wgc_to` char(55) NOT NULL,
  `wgc_cc` char(55) DEFAULT NULL,
  `wgc_bcc` char(55) DEFAULT NULL,
  `wgc_from` char(55) NOT NULL,
  `wgc_from_name` char(55) NOT NULL,
  `wgc_subject` char(200) NOT NULL,
  `wgc_body` varchar(500) NOT NULL,
  `appfunc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='For use in sending email';

--
-- Dumping data for table `wizard_gmail_config`
--

INSERT INTO `wizard_gmail_config` (`id`, `wgc_user_id`, `wgc_to`, `wgc_cc`, `wgc_bcc`, `wgc_from`, `wgc_from_name`, `wgc_subject`, `wgc_body`, `appfunc_id`) VALUES
(1, 62, 'genru06@gmail.com', '0', '0', 'info@nsmartrac.com', 'nSmarTrac', 'New Event was Created', 'hi {username}\nYou have created a new Event', 1);

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
-- Indexes for table `wizard_automate`
--
ALTER TABLE `wizard_automate`
  ADD PRIMARY KEY (`wa_id`);

--
-- Indexes for table `wizard_gmail_config`
--
ALTER TABLE `wizard_gmail_config`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `wiz_app_func_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wizard_automate`
--
ALTER TABLE `wizard_automate`
  MODIFY `wa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wizard_gmail_config`
--
ALTER TABLE `wizard_gmail_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wizard_workspace`
--
ALTER TABLE `wizard_workspace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
