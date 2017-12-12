-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2017 at 08:44 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `djp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_preferences`
--

CREATE TABLE `admin_preferences` (
  `id` tinyint(1) NOT NULL,
  `user_panel` tinyint(1) NOT NULL DEFAULT '0',
  `sidebar_form` tinyint(1) NOT NULL DEFAULT '0',
  `messages_menu` tinyint(1) NOT NULL DEFAULT '0',
  `notifications_menu` tinyint(1) NOT NULL DEFAULT '0',
  `tasks_menu` tinyint(1) NOT NULL DEFAULT '0',
  `user_menu` tinyint(1) NOT NULL DEFAULT '1',
  `ctrl_sidebar` tinyint(1) NOT NULL DEFAULT '0',
  `transition_page` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_preferences`
--

INSERT INTO `admin_preferences` (`id`, `user_panel`, `sidebar_form`, `messages_menu`, `notifications_menu`, `tasks_menu`, `user_menu`, `ctrl_sidebar`, `transition_page`) VALUES
(1, 1, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `case_type_id` tinyint(4) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `active` varchar(10) NOT NULL,
  `sorting` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `case_type_id`, `cat_id`, `active`, `sorting`) VALUES
(15, 'Sessions Murder', 1, 0, 'Yes', 2),
(16, 'Sessions Other', 1, 0, 'Yes', 3),
(17, 'Women Cases', 1, 15, 'Yes', 0),
(18, 'Juvenile Cases', 1, 15, 'Yes', 0),
(19, 'Narcotics Cases', 1, 0, 'Yes', 4),
(20, 'Appeal', 2, 0, 'Yes', 0),
(21, 'Family Appeal', 2, 20, 'Yes', 0),
(22, 'Bail Application', 1, 0, 'Yes', 1),
(23, 'Post-arrest', 1, 22, 'Yes', 0),
(24, 'Pre-arrest', 1, 22, 'Yes', 0),
(25, 'Cancellation of bail', 1, 22, 'Yes', 0),
(26, 'Illegal Dispossession Act', 1, 0, 'Yes', 8);

-- --------------------------------------------------------

--
-- Table structure for table `courts`
--

CREATE TABLE `courts` (
  `court_id` int(11) NOT NULL,
  `judge_id` tinyint(4) NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `district_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `desgn_id` int(11) NOT NULL,
  `desgn_name` varchar(100) NOT NULL,
  `desgn_short_name` varchar(10) NOT NULL,
  `sorting` int(11) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`desgn_id`, `desgn_name`, `desgn_short_name`, `sorting`, `active`) VALUES
(6, 'District & Sessions Judge', 'D & SJ', 1, 'Yes'),
(7, 'Addl: District & Sessions Judge', 'ASJ', 2, 'Yes'),
(8, 'Senior Civil Judge', 'Senior CJ', 3, 'Yes'),
(9, 'Civil Judge', 'CJ', 4, 'Yes'),
(10, 'Magistrate Section-30 (Class-I)', 'Class-I', 5, 'Yes'),
(11, 'Judicial Magistrate (Class-I)', 'Class-I', 6, 'Yes'),
(12, 'Judicial Magistrate', 'CJ', 7, 'Yes'),
(13, 'Civil Judge Family Court', 'CJ', 8, 'Yes'),
(14, 'Civil Judge (Class-I)', 'Class-I', 5, 'Yes'),
(15, 'Civil Judge (Class-II)', 'Class-II', 6, 'Yes'),
(16, 'Civil Judge (Class-III)', 'Class-III', 10, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `city_id` int(11) NOT NULL,
  `active` varchar(10) NOT NULL,
  `sorting` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `city_name`, `city_id`, `active`, `sorting`) VALUES
(1, 'Faisalabad', 0, 'Yes', 2),
(3, 'Lahore', 0, 'Yes', 1),
(4, 'Chinot', 0, 'Yes', 5),
(12, 'Jhang', 0, 'Yes', 3),
(13, 'Toba Take Singh', 0, 'Yes', 4),
(14, 'Jaranwala', 1, 'No', 2),
(15, 'Sumandri', 1, 'Yes', 1),
(16, 'Tandlianwala', 1, 'Yes', 3);

-- --------------------------------------------------------

--
-- Table structure for table `districts_users`
--

CREATE TABLE `districts_users` (
  `id` int(11) NOT NULL,
  `district_user_id` tinyint(4) NOT NULL,
  `district_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `bgcolor` char(7) NOT NULL DEFAULT '#607D8B'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `bgcolor`) VALUES
(1, 'admin', 'Administrator', '#f44336'),
(2, 'members', 'General User', '#2196F3'),
(3, 'super', 'Super Users', '#ff5722'),
(4, 'district', 'Admin user of districts', '#009688');

-- --------------------------------------------------------

--
-- Table structure for table `judges`
--

CREATE TABLE `judges` (
  `judge_id` int(11) NOT NULL,
  `judge_name` varchar(100) NOT NULL,
  `desgn_id` tinyint(4) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_joining` date NOT NULL,
  `date_of_retirement` date NOT NULL,
  `domicile_id` tinyint(4) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `seniority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `judges`
--

INSERT INTO `judges` (`judge_id`, `judge_name`, `desgn_id`, `date_of_birth`, `date_of_joining`, `date_of_retirement`, `domicile_id`, `gender`, `seniority`) VALUES
(1, 'Rai Aftab Ahmad', 7, '2017-12-11', '2017-12-11', '2017-12-11', 1, 'Male', 11),
(2, 'Abid Hussain Quraishi', 6, '2017-12-11', '2017-12-11', '2017-12-11', 3, 'Male', 331),
(3, 'Abid Hussain Quraishi', 6, '2017-12-11', '2017-12-11', '2017-12-11', 1, 'Male', 121);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `public_preferences`
--

CREATE TABLE `public_preferences` (
  `id` int(1) NOT NULL,
  `transition_page` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `public_preferences`
--

INSERT INTO `public_preferences` (`id`, `transition_page`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_of_cases`
--

CREATE TABLE `type_of_cases` (
  `case_type_id` int(11) NOT NULL,
  `case_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_of_cases`
--

INSERT INTO `type_of_cases` (`case_type_id`, `case_type`) VALUES
(1, 'Criminal'),
(2, 'Civil');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_courts`
--

CREATE TABLE `type_of_courts` (
  `court_type_id` int(11) NOT NULL,
  `court_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_of_courts`
--

INSERT INTO `type_of_courts` (`court_type_id`, `court_type`) VALUES
(1, 'Sessions'),
(2, 'Civil');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'ubbKewRMYv31hKaEQcspdO', 1268889823, 1513060703, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', 'waris', '$2y$08$T/J0wxK/karJnDpatdPCs.ddOj49k35Nel9Gc73MDa69O4w9/lcNO', NULL, 'user@admin.com', NULL, NULL, NULL, 'TkFkFCz9BRUYpPf7zEoGsO', 1512553577, 1512663067, 1, 'Malik1', 'Waris1', 'DSC Fsd1', '03007201629'),
(3, '::1', '', '$2y$08$ufAZIb7A2O.EgRidvi0a1OLQifH5T0JdbAdXF/X3GLd0T3OZCzxh2', NULL, 'super@admin.com', NULL, NULL, NULL, 'U9F82jQp08YIHehPODXfue', 1512570361, 1512581093, 1, 'User', 'Super', 'DSC Fsd', '03139201629'),
(4, '::1', 'Faisalabad', '$2y$08$a5lwTHew70EOnuKlStDfcuXfIzQOaP.eNMfeXzRHQsWmbzPDGit2q', NULL, 'faisalabad@admin.com', NULL, NULL, NULL, NULL, 1512972787, 1512982640, 1, 'Faisalabad', 'Fsd', 'Faisalabad', '03007201629'),
(5, '::1', 'ishfaq', '$2y$08$aFiAevMocfM9cabNMIICGugvGLnlwYmkY9G5itGQxzOJtEjN3ZE12', NULL, 'ishfaq11@admin.com', NULL, NULL, NULL, NULL, 1512976414, NULL, 1, 'Muhammad', 'Ishfaq', 'Faisalabad', '03007373777'),
(6, '::1', '', '$2y$08$wD.8saaPyFHXtlDYA9712Ol7sabVkPCZ6/NWcVXq5sNNOabbw0qzK', NULL, 'ishfaq1@admin.com', NULL, NULL, NULL, NULL, 1512977238, NULL, 1, 'Ali', 'Raza', 'Faisalabad', '99999999999'),
(7, '::1', '', '$2y$08$SRjNmGHFsx90/bGRrrd/0uOlJyY28e/mG8EAxPfkwrhgX7gwTD72i', NULL, 'user1@admin.com', NULL, NULL, NULL, NULL, 1513012412, NULL, 1, 'Malik', 'Waris', 'DSC Fsd', '888888888'),
(8, '::1', '', '$2y$08$Pxs8vb50kua9/giD7cB9HOlNu6jqJk5sKsV1u6BJqKKk0YvYOk69q', NULL, 'bilal@admin.com', NULL, NULL, NULL, NULL, 1513012492, NULL, 1, 'Bilal', 'raza', 'Faisalabad', '888888888'),
(9, '::1', 'sdfsadf', '$2y$08$7b0ZvKvdbZSBnIJoKRLXrepiP19ClybeS/3yf1f2kplL9rVxT5RnS', NULL, 'dsr@admin.com', NULL, NULL, NULL, NULL, 1513012567, NULL, 1, 'sdfsadf', 'sdfsdaf', 'sadfsdaf', '55555555555'),
(10, '::1', '1111', '$2y$08$9v7Ncof6cLVqFSJS7Xor8uuAW9W/KoWpB0foMiktZZR/u3pNHOnaC', NULL, 'fasd@gmail.com', NULL, NULL, NULL, NULL, 1513013150, NULL, 1, 'Bilal', 'akhtar', 'fasd', '1111222211'),
(11, '::1', '111', '$2y$08$5FdMq.MaltWruddzcGqPRuZxbgmXcJBHl5K5nLZZJqx1kB.FBUtZG', NULL, 'bilalbs@admin.com', NULL, NULL, NULL, NULL, 1513013456, NULL, 1, 'Malik', 'Fsd', 'DSC Fsd', '999999999'),
(12, '::1', 'sdfsdf', '$2y$08$zozL7ZbyC/YU7D2wr7h4JOc9bixvUxaZUzhXzfb2Yizk1jXVoi4O2', NULL, 'user111@admin.com', NULL, NULL, NULL, NULL, 1513013677, NULL, 1, 'Malik', 'Waris', 'DSC Fsd', '55555555555'),
(13, '::1', '111aaa', '$2y$08$.6Y26DLAKBSQBbF/pGUa5e5okwi2Dd7D1xVnk8HZWQlCfeDMgjk9O', NULL, 'sdfsdf555@gmail.com', NULL, NULL, NULL, NULL, 1513013897, NULL, 1, 'sadfsadf', 'sadfsadf', 'sdfsdf', '555555554'),
(14, '::1', '', '$2y$08$5RQla3U.TO6RXT8PMhfvPuuIx1m.6s4Q0I1alje1eeHGQ1Y7GvjY2', NULL, 'faisalabad1111@admin.com', NULL, NULL, NULL, NULL, 1513017648, NULL, 1, 'Bilal', 'Waris', 'DSC Fsd', '09999998888'),
(15, '::1', 'ds170400054', '$2y$08$Z0ldKDRogI/r33R1L/86CunwWlrjyJWEJ7JHwuNxrxmCShALnNEce', NULL, 'user@admin111.com', NULL, NULL, NULL, NULL, 1513024357, NULL, 1, 'Malik', 'Waris', 'DSC Fsd', '8887777776'),
(16, '::1', '', '$2y$08$qa.8JKh3bnQGjX8ziUwcbuFHr7b0l7XXt9YnpI./2.j/85w0LYPem', NULL, 'bila11l@admin.com', NULL, NULL, NULL, NULL, 1513024508, NULL, 1, 'Malik', 'Waris', 'DSC Fsd', '999999999'),
(17, '::1', '', '$2y$08$Lado4e3zhn9Pk1ue.tZoHOkcjCZvEZXc3E8rTOYB.D21qR1qmKa2a', NULL, 'dsr11@admin.com', NULL, NULL, NULL, NULL, 1513024677, NULL, 1, 'Bilal', 'Super', 'DSC Fsd', '6666555555'),
(18, '::1', '', '$2y$08$ccrT091D57Zdt/1nfuAfRu8UVwdm1ErWU7dJECnxPl0opDvSgOopq', NULL, 'dsr111@admin.com', NULL, NULL, NULL, NULL, 1513024743, NULL, 1, 'Bilal', 'Super', 'DSC Fsd', '6666555555'),
(19, '::1', 'ds1704000541111', '$2y$08$W6mE/PTfPGTmwtwJXrkSZOStrxhJeWdU4WkEKL4qPDJDtEf.fJI02', NULL, 'ds1111r1111@admin.com', NULL, NULL, NULL, NULL, 1513025649, NULL, 1, 'Bilal', 'Super', 'DSC Fsd', '6666555555'),
(20, '::1', 'shahid malik1', '$2y$08$m1NELWhqgcyo9iCAYYcYfud.BV1CM3Eu8q/1FDVb428/GpyOifwvy', NULL, 'shahidmalik@admin.com', NULL, NULL, NULL, NULL, 1513025711, NULL, 1, 'Shahid', 'Malik', 'Faisalabad', '03007201629');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(7, 2, 2),
(5, 3, 3),
(16, 4, 4),
(17, 5, 4),
(10, 6, 2),
(18, 7, 2),
(19, 8, 2),
(21, 9, 2),
(27, 10, 2),
(26, 11, 2),
(25, 12, 2),
(29, 13, 2),
(30, 14, 2),
(32, 15, 2),
(33, 16, 2),
(34, 17, 2),
(35, 18, 2),
(36, 19, 2),
(38, 20, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_preferences`
--
ALTER TABLE `admin_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_type_id` (`case_type_id`);

--
-- Indexes for table `courts`
--
ALTER TABLE `courts`
  ADD PRIMARY KEY (`court_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`desgn_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts_users`
--
ALTER TABLE `districts_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judges`
--
ALTER TABLE `judges`
  ADD PRIMARY KEY (`judge_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public_preferences`
--
ALTER TABLE `public_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_cases`
--
ALTER TABLE `type_of_cases`
  ADD PRIMARY KEY (`case_type_id`);

--
-- Indexes for table `type_of_courts`
--
ALTER TABLE `type_of_courts`
  ADD PRIMARY KEY (`court_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_preferences`
--
ALTER TABLE `admin_preferences`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `courts`
--
ALTER TABLE `courts`
  MODIFY `court_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `desgn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `districts_users`
--
ALTER TABLE `districts_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `judges`
--
ALTER TABLE `judges`
  MODIFY `judge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `public_preferences`
--
ALTER TABLE `public_preferences`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `type_of_cases`
--
ALTER TABLE `type_of_cases`
  MODIFY `case_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_of_courts`
--
ALTER TABLE `type_of_courts`
  MODIFY `court_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
