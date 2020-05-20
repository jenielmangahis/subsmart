CREATE TABLE `customer_groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customer_groups` (`id`, `user_id`, `company_id`, `title`, `description`, `status`, `created_at`) VALUES
(2, 60, 15, 'Panel', '', 1, '2020-03-30 13:38:42'),
(3, 60, 15, 'Design', '', 1, '2020-03-30 13:40:56'),
(4, 55, 13, 'Test Group', '', 1, '2020-04-12 00:33:52'),
(5, 55, 13, 'VIP Customer', 'very interesting people', 1, '2020-04-21 16:44:01');


ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `customer_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


CREATE TABLE `customer_sources` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customer_sources` (`id`, `user_id`, `company_id`, `title`, `status`, `created_at`) VALUES
(1, 55, 13, 'Facebook', 1, '2020-04-21 16:45:04');

ALTER TABLE `customer_sources`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `customer_sources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


CREATE TABLE `customer_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `customer_types` (`id`, `title`, `description`, `company_id`) VALUES
(1, 'sdfsdfsdf', NULL, 13);

ALTER TABLE `customer_types`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `customer_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
