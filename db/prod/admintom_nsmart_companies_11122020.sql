-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 11, 2020 at 09:52 AM
-- Server version: 5.6.41-84.1
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
-- Table structure for table `timesheet_attendance`
--

CREATE TABLE `timesheet_attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift_duration` decimal(10,2) NOT NULL,
  `break_duration` decimal(10,2) NOT NULL,
  `overtime` double(10,2) NOT NULL,
  `overtime_status` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timesheet_attendance`
--

INSERT INTO `timesheet_attendance` (`id`, `user_id`, `shift_duration`, `break_duration`, `overtime`, `overtime_status`, `date_created`, `status`, `notes`) VALUES
(1, 14, 0.18, 0.00, 0.00, 1, '2020-11-10 22:26:20', 0, ''),
(2, 14, 0.00, 0.00, 0.00, 1, '2020-11-10 22:38:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_departments`
--

CREATE TABLE `timesheet_departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timesheet_departments`
--

INSERT INTO `timesheet_departments` (`id`, `name`, `company_id`) VALUES
(1, 'Sales', 1),
(2, 'Marketing', 1),
(3, 'Tech Support', 1);

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_invite_link`
--

CREATE TABLE `timesheet_invite_link` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `invitation_code` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_job_codes`
--

CREATE TABLE `timesheet_job_codes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_job_sites`
--

CREATE TABLE `timesheet_job_sites` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coordinates` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diameter` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timesheet_job_sites`
--

INSERT INTO `timesheet_job_sites` (`id`, `name`, `address`, `coordinates`, `diameter`, `company_id`) VALUES
(1, 'Manhattan', 'Manhattan, New York, NY, 10036, United States', '40.75921099999999,-73.98463799999995', 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_leave`
--

CREATE TABLE `timesheet_leave` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_hours` double(10,2) NOT NULL,
  `pto_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timesheet_leave`
--

INSERT INTO `timesheet_leave` (`id`, `user_id`, `total_hours`, `pto_id`, `status`, `date_created`) VALUES
(1, 14, 8.00, 2, 1, '2020-11-05 07:27:20');

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_leave_date`
--

CREATE TABLE `timesheet_leave_date` (
  `id` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timesheet_leave_date`
--

INSERT INTO `timesheet_leave_date` (`id`, `leave_id`, `date`) VALUES
(1, 1, '2020-11-02'),
(2, 1, '2020-11-04'),
(3, 1, '2020-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_logs`
--

CREATE TABLE `timesheet_logs` (
  `id` int(11) NOT NULL,
  `attendance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_location` varchar(255) NOT NULL,
  `action` varchar(100) NOT NULL,
  `entry_type` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `workorder_id` int(11) NOT NULL DEFAULT '0',
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timesheet_logs`
--

INSERT INTO `timesheet_logs` (`id`, `attendance_id`, `user_id`, `user_location`, `action`, `entry_type`, `status`, `approved_by`, `company_id`, `workorder_id`, `date_created`) VALUES
(1, 1, 14, '40.759211,-73.984638', 'Check in', 'Normal', 0, 0, 1, 0, '2020-11-10 22:26:21'),
(2, 1, 14, '40.759211,-73.984638', 'Break in', 'Normal', 0, 0, 1, 0, '2020-11-10 22:29:41'),
(3, 1, 14, '40.759211,-73.984638', 'Break out', 'Normal', 0, 0, 1, 0, '2020-11-10 22:29:47'),
(4, 1, 14, '40.759211,-73.984638', 'Check out', 'Normal', 0, 0, 1, 0, '2020-11-10 22:37:45'),
(5, 2, 14, '40.759211,-73.984638', 'Check in', 'Normal', 0, 0, 1, 0, '2020-11-10 22:38:02'),
(6, 2, 14, '40.759211,-73.984638', 'Check out', 'Normal', 0, 0, 1, 0, '2020-11-10 22:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_notification_settings`
--

CREATE TABLE `timesheet_notification_settings` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `clocked_in_reminder` tinyint(1) NOT NULL DEFAULT '1',
  `clocked_in_reminder_time` time NOT NULL,
  `clocked_out_reminder` tinyint(1) NOT NULL DEFAULT '1',
  `clocked_out_reminder_time` time NOT NULL,
  `when_enter_a_job_site` tinyint(1) NOT NULL DEFAULT '1',
  `when_leave_a_job_site` tinyint(1) NOT NULL DEFAULT '1',
  `clocked_in_for_12h` tinyint(1) NOT NULL DEFAULT '1',
  `clocked_in_for_24h` tinyint(1) NOT NULL DEFAULT '1',
  `days_to_be_reminded` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'MON,TUE,WED,THU,FRI',
  `when_user_clock_in` tinyint(4) NOT NULL DEFAULT '1',
  `when_user_clock_out` tinyint(4) NOT NULL DEFAULT '1',
  `when_user_start_a_break` tinyint(4) NOT NULL DEFAULT '1',
  `when_user_ends_a_break` tinyint(4) NOT NULL DEFAULT '1',
  `when_time_entry_is_modified` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timesheet_notification_settings`
--

INSERT INTO `timesheet_notification_settings` (`id`, `company_id`, `clocked_in_reminder`, `clocked_in_reminder_time`, `clocked_out_reminder`, `clocked_out_reminder_time`, `when_enter_a_job_site`, `when_leave_a_job_site`, `clocked_in_for_12h`, `clocked_in_for_24h`, `days_to_be_reminded`, `when_user_clock_in`, `when_user_clock_out`, `when_user_start_a_break`, `when_user_ends_a_break`, `when_time_entry_is_modified`) VALUES
(1, 1, 1, '08:00:00', 1, '08:00:00', 1, 1, 1, 1, 'MON,TUE,WED,THU,FRI', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_pto`
--

CREATE TABLE `timesheet_pto` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timesheet_pto`
--

INSERT INTO `timesheet_pto` (`id`, `name`, `company_id`) VALUES
(1, 'Sick Leave', 1),
(2, 'Vacation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_settings`
--

CREATE TABLE `timesheet_settings` (
  `id` int(11) NOT NULL,
  `project_name` varchar(100) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `notes` text,
  `total_duration_w` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `allow_departments` tinyint(1) NOT NULL DEFAULT '0',
  `workweek_start_day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL DEFAULT 'Monday',
  `regular_hours_per_week` varchar(255) NOT NULL DEFAULT '40h',
  `regular_hours_per_day` varchar(255) NOT NULL DEFAULT '8h',
  `overtime` enum('No Overtime','Daily Overtime','Weekly Overtime') NOT NULL DEFAULT 'Weekly Overtime',
  `allow_email_report` tinyint(1) NOT NULL DEFAULT '1',
  `payroll_workweek_start_day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL DEFAULT 'Monday',
  `payroll_schedule` enum('Weekly','Bi-Weekly','Semi-Monthly','Monthly','Custom') NOT NULL DEFAULT 'Weekly',
  `allow_manual_entries` tinyint(1) NOT NULL DEFAULT '1',
  `roles` varchar(255) DEFAULT NULL,
  `allow_fixed_timezone` tinyint(1) NOT NULL DEFAULT '0',
  `allow_use_decimal_hours` tinyint(1) NOT NULL DEFAULT '0',
  `round_clock_inout_times` tinyint(1) NOT NULL DEFAULT '0',
  `round_increment` varchar(255) DEFAULT NULL,
  `break_rule` enum('Manual','Automatic') NOT NULL DEFAULT 'Manual',
  `break_length` varchar(255) DEFAULT NULL,
  `break_type` varchar(255) DEFAULT NULL,
  `require_job_code` tinyint(1) NOT NULL DEFAULT '0',
  `allow_location_tracking` tinyint(1) NOT NULL DEFAULT '0',
  `allow_user_specific` tinyint(1) NOT NULL DEFAULT '0',
  `allow_clock_in_restrictions` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timesheet_settings`
--

INSERT INTO `timesheet_settings` (`id`, `project_name`, `company_id`, `notes`, `total_duration_w`, `date_created`, `status`, `allow_departments`, `workweek_start_day`, `regular_hours_per_week`, `regular_hours_per_day`, `overtime`, `allow_email_report`, `payroll_workweek_start_day`, `payroll_schedule`, `allow_manual_entries`, `roles`, `allow_fixed_timezone`, `allow_use_decimal_hours`, `round_clock_inout_times`, `round_increment`, `break_rule`, `break_length`, `break_type`, `require_job_code`, `allow_location_tracking`, `allow_user_specific`, `allow_clock_in_restrictions`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, 1, 'Monday', '40h', '8h', 'Weekly Overtime', 1, 'Monday', 'Weekly', 1, 'Admins, Managers, Employees', 0, 0, 0, NULL, 'Manual', '30m', 'Unpaid', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_team_members`
--

CREATE TABLE `timesheet_team_members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('Admin','Manager','Employee') COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL DEFAULT '0',
  `department_role` enum('Manager','Member') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Member',
  `will_track_location` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'accepted or not',
  `company_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timesheet_team_members`
--

INSERT INTO `timesheet_team_members` (`id`, `user_id`, `name`, `email`, `role`, `department_id`, `department_role`, `will_track_location`, `status`, `company_id`) VALUES
(1, 14, 'Jonah Pacas-Abanil', 'jpabanil@icloud.com', 'Admin', 3, 'Member', 1, 1, 1),
(2, 2, 'Lauren Williams', 'support@nsmartrac.com', 'Admin', 0, 'Member', 1, 1, 1),
(3, 0, NULL, 'jonas@gmail.com', 'Employee', 0, 'Member', 1, 0, 1),
(4, 5, 'Tommy Nguyen', 'tommy@nsmartrac.com', 'Employee', 0, '', 1, 1, 1),
(5, 0, NULL, 'moresecureadi@gmail.com', 'Employee', 0, 'Member', 1, 0, 1),
(6, 0, NULL, 'moresecureadi@gmail.com', 'Employee', 0, 'Member', 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `timesheet_attendance`
--
ALTER TABLE `timesheet_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_departments`
--
ALTER TABLE `timesheet_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_invite_link`
--
ALTER TABLE `timesheet_invite_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_job_codes`
--
ALTER TABLE `timesheet_job_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_job_sites`
--
ALTER TABLE `timesheet_job_sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_leave`
--
ALTER TABLE `timesheet_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_leave_date`
--
ALTER TABLE `timesheet_leave_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_logs`
--
ALTER TABLE `timesheet_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_notification_settings`
--
ALTER TABLE `timesheet_notification_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_pto`
--
ALTER TABLE `timesheet_pto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_settings`
--
ALTER TABLE `timesheet_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_team_members`
--
ALTER TABLE `timesheet_team_members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `timesheet_attendance`
--
ALTER TABLE `timesheet_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timesheet_departments`
--
ALTER TABLE `timesheet_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `timesheet_invite_link`
--
ALTER TABLE `timesheet_invite_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timesheet_job_codes`
--
ALTER TABLE `timesheet_job_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timesheet_job_sites`
--
ALTER TABLE `timesheet_job_sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timesheet_leave`
--
ALTER TABLE `timesheet_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timesheet_leave_date`
--
ALTER TABLE `timesheet_leave_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `timesheet_logs`
--
ALTER TABLE `timesheet_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `timesheet_notification_settings`
--
ALTER TABLE `timesheet_notification_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timesheet_pto`
--
ALTER TABLE `timesheet_pto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timesheet_settings`
--
ALTER TABLE `timesheet_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timesheet_team_members`
--
ALTER TABLE `timesheet_team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
