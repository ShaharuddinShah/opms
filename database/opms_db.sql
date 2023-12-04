-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2022 at 08:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `member_list`
--

CREATE TABLE `member_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `department` text NOT NULL,
  `position` text NOT NULL,
  `password` text NOT NULL,
  `generated_password` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `avatar` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_list`
--

INSERT INTO `member_list` (`id`, `code`, `firstname`, `middlename`, `lastname`, `gender`, `email`, `department`, `position`, `password`, `generated_password`, `status`, `avatar`, `date_created`, `date_updated`) VALUES
(1, '2022-0001', 'John', 'D', 'Smith', 'Male', 'jsmith@sample.com', 'IT Department', 'Web Developer', '5f92de022efaded7349590bf1fd332a6', 'zku8jn7x', 1, 'uploads/employee-1.png?v=1641966652', '2022-01-12 13:39:50', '2022-01-12 13:50:52'),
(2, '2022-0002', 'Claire', 'D', 'Blake', 'Female', 'cblake@sample.com', 'Design', 'Lead Front End Designer', '19e36ca1b52bb940291854cd5cd50328', 'j295eq4f', 1, 'uploads/employee-2.png?v=1650982662', '2022-01-12 13:46:11', '2022-06-21 18:56:27'),
(4, '2022-0003', 'Mark', 'Z', 'Cooper', 'Male', 'mcooper@sample.com', 'IT Department', 'Department Manager', '3d9009640925e364815164e83b665666', 'seihtq9q', 1, 'uploads/employee-4.png?v=1641966950', '2022-01-12 13:55:50', '2022-04-26 22:31:22'),
(5, '2022-0004', 'Samantha', 'C', 'Miller', 'Female', 'sam23@sample.com', 'HR Department', 'Office Clerk', 'b7d631291e99998916529dcaf68f05dd', '21iqfz9v', 0, 'uploads/employee-5.png?v=1641967103', '2022-01-12 13:58:23', '2022-01-12 14:04:43'),
(6, '2022-2205', 'Employee', '', 'One', 'Male', 'employee@email.com', '', '', '489e77b58dd509138e678ffe7718e7d4', '0l3v9clj', 1, NULL, '2022-05-22 11:32:53', '2022-05-22 11:34:03'),
(7, '2022-11', 'test', 'test', 'tester', 'Male', 'test@mail.com', 'Design', 'Designer', 'e3d48e5627747fe76d0766c05f98658b', 'q3rvh9tc', 1, NULL, '2022-06-05 02:42:22', NULL),
(8, '1111-11', 'test1', '', 'test1', 'Male', 'email@email.com', '', '', '6273a62b7c61d1eba5458343adb84412', '96gsl0c6', 1, NULL, '2022-06-05 09:51:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_list`
--

CREATE TABLE `project_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= New, 1= In-Progress, 2= Closed',
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_list`
--

INSERT INTO `project_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Project 101', 'This is a sample project only.', 2, 0, '2022-01-12 10:59:11', '2022-01-13 09:13:55'),
(2, 'Project 102', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer libero tortor, cursus sed massa et, pretium vulputate felis. Proin diam felis, aliquam vel mattis vitae, dictum sit amet justo. Quisque congue nibh leo, vitae placerat massa fringilla eget. Duis ut lobortis nulla. In dui nisi, sodales vel vestibulum in, sodales et mi.', 2, 0, '2022-01-12 11:33:31', '2022-04-10 02:46:21'),
(3, 'Project 103', 'I will be editing these details as a sample of the project in this system.', 1, 0, '2022-01-12 11:33:47', '2022-06-19 19:20:10'),
(4, 'Project 104', 'This project will highlight the fourth project in this system.', 1, 0, '2022-01-12 11:33:59', '2022-06-22 21:28:59'),
(5, 'Project 105', 'Etiam ultrices, purus a blandit porta, elit augue tincidunt risus, id posuere nibh risus quis urna. Donec vitae tellus sit amet odio lacinia consectetur. Maecenas pellentesque fringilla tortor mattis laoreet. Vestibulum nibh dolor, pulvinar sit amet enim sit amet, congue ultricies ligula. Nullam pellentesque erat eget ultrices blandit. Aliquam id erat sagittis, maximus dolor ullamcorper, finibus nibh. Nunc fermentum enim felis, hendrerit posuere felis scelerisque et', 0, 1, '2022-01-12 11:34:12', '2022-01-12 11:34:25'),
(6, 'New Project', 'New Project 1', 2, 0, '2022-06-05 09:50:35', '2022-06-19 18:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `report_list`
--

CREATE TABLE `report_list` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `work_type_id` int(30) NOT NULL,
  `description` text NOT NULL,
  `datetime_from` datetime NOT NULL,
  `datetime_to` datetime NOT NULL,
  `duration` float NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report_list`
--

INSERT INTO `report_list` (`id`, `project_id`, `member_id`, `work_type_id`, `description`, `datetime_from`, `datetime_to`, `duration`, `date_created`, `date_updated`) VALUES
(2, 1, 4, 1, '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Phasellus sit amet aliquam lorem. Vestibulum feugiat sed dolor vel cursus. Cras mattis eu urna id dignissim. Suspendisse potenti. Fusce vel dignissim augue, vitae lacinia augue. Integer efficitur tortor in est aliquet porttitor. Cras enim justo, feugiat eget sollicitudin id, euismod at quam.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', '2022-01-12 10:00:00', '2022-01-12 12:00:00', 7200, '2022-01-12 15:42:34', '2022-01-12 16:56:02'),
(4, 1, 4, 2, '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Sed accumsan laoreet posuere. Quisque nec est eget erat mollis ultricies quis a est. Duis ac euismod felis. Vestibulum id ipsum dictum tellus ultrices lacinia. Donec vel velit orci. Maecenas a nisl eu nisi tempus finibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin blandit urna vitae aliquam porttitor. Nunc tempus tristique dolor non laoreet.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', '2022-01-11 13:00:00', '2022-01-11 15:00:00', 7200, '2022-01-12 15:45:05', NULL),
(5, 2, 4, 4, '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Nulla in rhoncus risus. Vestibulum non lacus a mauris congue consectetur in nec enim. Vivamus sed risus metus. Phasellus nunc est, pellentesque ut congue at, malesuada gravida erat. Proin at blandit velit. Donec ut felis id purus sagittis congue vitae non libero. In bibendum, tellus et sollicitudin auctor, nibh nibh bibendum dui, et tempus ex dui nec quam. Integer a imperdiet augue. Aenean bibendum sapien non fringilla euismod. Sed a dui vitae nulla facilisis iaculis.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', '2022-01-11 13:00:00', '2022-01-11 15:30:00', 9000, '2022-01-12 15:46:14', NULL),
(6, 3, 6, 6, '&lt;p&gt;My first report&lt;/p&gt;', '2022-05-22 11:35:00', '2022-05-29 11:35:00', 604800, '2022-05-22 11:35:19', NULL),
(8, 3, 4, 7, '&lt;p&gt;report 2&lt;/p&gt;', '2022-05-22 12:30:00', '2022-05-29 12:30:00', 604800, '2022-05-22 12:30:50', NULL),
(9, 3, 7, 6, '&lt;p&gt;this is my first project&lt;br&gt;&lt;/p&gt;', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2022-06-05 03:15:00', NULL),
(10, 6, 8, 6, '&lt;p&gt;Report 1&lt;br&gt;&lt;/p&gt;', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2022-06-05 09:52:45', NULL),
(11, 4, 4, 6, '&lt;p&gt;This is the first report for project 104&lt;br&gt;&lt;/p&gt;', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2022-06-22 20:47:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Online Project Management System'),
(6, 'short_name', 'OPMS'),
(11, 'logo', 'uploads/logo-1650984962.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1650983264.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1655901665', NULL, 1, 1, '2022-04-01 14:02:37', '2022-06-22 20:41:05'),
(6, 'Claire', NULL, 'Blake', 'cblake', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/avatar-6.png?v=1650985111', NULL, 2, 1, '2022-04-12 16:04:17', '2022-06-21 18:54:09'),
(11, 'test3', NULL, 'lastName', 'test3', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-11.png?v=1649528316', NULL, 1, 1, '2022-04-10 02:18:35', '2022-06-20 08:08:24'),
(13, 'john', 'j', 'smith', 'john', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, 0, 1, '2022-06-23 10:36:37', NULL),
(26, 'new12', '', 'new', 'new@email.com', '7a0c8cec58c19340204f09a212487531', NULL, NULL, 0, 1, '2022-06-24 01:03:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `work_type_list`
--

CREATE TABLE `work_type_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_type_list`
--

INSERT INTO `work_type_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Support', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer libero tortor, cursus sed massa et, pretium vulputate felis. Proin diam felis, aliquam vel mattis vitae, dictum sit amet justo.', 1, 0, '2022-01-12 11:30:31', NULL),
(2, 'Technical', 'Quisque congue nibh leo, vitae placerat massa fringilla eget. Duis ut lobortis nulla. In dui nisi, sodales vel vestibulum in, sodales et mi. Sed faucibus dictum orci quis facilisis. Vestibulum quis porta mi', 1, 0, '2022-01-12 11:31:53', NULL),
(3, 'Revision', 'Ut ultrices ex at lacinia egestas. Aenean rhoncus nisl sit amet pellentesque sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', 1, 0, '2022-01-12 11:32:15', NULL),
(4, 'Quality Control', 'enean scelerisque quam ac tellus porttitor, sit amet elementum turpis tincidunt. Morbi ut sapien vel odio maximus tempus a a elit. Fusce elit libero, gravida sagittis velit ut, vulputate ullamcorper justo.', 1, 0, '2022-01-12 11:32:36', NULL),
(5, 'Testing', 'Suspendisse auctor diam sit amet magna sollicitudin, vel gravida leo aliquam. Nam dapibus posuere ligula ac placerat. Vestibulum egestas rhoncus vehicula.', 1, 0, '2022-01-12 11:33:13', NULL),
(6, 'Design', 'In vulputate, lacus at cursus pharetra, lorem lacus placerat magna, vitae rhoncus ante magna sit amet nisi. Nunc elementum metus nec elementum volutpat. Suspendisse at bibendum lectus, at scelerisque diam. Aliquam est massa, fermentum vel risus et, convallis semper diam.', 1, 0, '2022-01-12 11:34:54', NULL),
(7, 'Maintenance', 'Maecenas bibendum est quis lacus tincidunt porttitor. Donec at nulla a tellus rutrum gravida a varius tortor. Donec sodales sollicitudin lectus eu volutpat. Nulla pharetra euismod arcu, a vestibulum elit faucibus at. Nam placerat sem eget diam iaculis, quis venenatis lectus posuere.', 1, 0, '2022-01-12 11:35:14', '2022-04-26 23:55:01'),
(8, 'Beta Testing', 'n faucibus posuere sodales. Maecenas euismod, neque id consectetur ullamcorper, nisi erat ultrices urna, sit amet auctor odio magna vitae magna. Suspendisse a diam pellentesque, efficitur lacus eu, facilisis lacus', 1, 1, '2022-01-12 11:35:31', '2022-01-12 11:35:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member_list`
--
ALTER TABLE `member_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_list`
--
ALTER TABLE `project_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_list`
--
ALTER TABLE `report_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `employee_id` (`member_id`),
  ADD KEY `work_type_id` (`work_type_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_type_list`
--
ALTER TABLE `work_type_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member_list`
--
ALTER TABLE `member_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `project_list`
--
ALTER TABLE `project_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report_list`
--
ALTER TABLE `report_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `work_type_list`
--
ALTER TABLE `work_type_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `report_list`
--
ALTER TABLE `report_list`
  ADD CONSTRAINT `report_list_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_list_ibfk_2` FOREIGN KEY (`work_type_id`) REFERENCES `work_type_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_list_ibfk_3` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
