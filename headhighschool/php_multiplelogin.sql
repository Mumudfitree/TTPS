-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2021 at 08:55 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_multiplelogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `choose_a_teaching`
--

CREATE TABLE `choose_a_teaching` (
  `choose_id` int(20) NOT NULL,
  `master_id` int(20) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `subject_id` int(20) NOT NULL,
  `class_id` int(20) NOT NULL,
  `time_id` int(20) NOT NULL,
  `date` varchar(30) NOT NULL,
  `year_id` int(10) NOT NULL,
  `status_choose` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `choose_a_teaching`
--

INSERT INTO `choose_a_teaching` (`choose_id`, `master_id`, `grade_id`, `subject_id`, `class_id`, `time_id`, `date`, `year_id`, `status_choose`) VALUES
(1, 50, 9, 31, 36, 1, 'วันจันทร์', 1, 'Active'),
(2, 50, 12, 32, 38, 3, 'วันอังคาร', 1, 'Active'),
(3, 50, 9, 33, 36, 5, 'วันพุธ', 1, 'Active'),
(4, 50, 9, 31, 38, 7, 'วันศุกร์', 1, 'Active'),
(5, 83, 12, 32, 38, 4, 'วันศุกร์', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(20) NOT NULL,
  `name_role` varchar(50) NOT NULL,
  `status_role` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `name_role`, `status_role`) VALUES
(1, 'ผู้ดูแลระบบ', 'Active'),
(2, 'ผู้อำนวยการ', 'Active'),
(3, 'รองผู้อำนวยการ', 'Active'),
(4, 'ฝ่ายวิชาการ', 'Inactive'),
(5, 'ครู', 'Active'),
(6, 'หัวหน้าช่วงชั้นประถม', 'Active'),
(7, 'หัวหน้าช่วงชั้นมัธยม', 'Active'),
(10, 'ผู้จัดการ', 'Inactive'),
(12, 'adminๆ', 'Inactive'),
(13, 'ประถมต้น', 'Inactive'),
(14, 'Adminqq1', 'Inactive'),
(15, 'ผู้ดูแลระบบ11', 'Inactive'),
(16, 'ฝ่ายวิชาการ112', 'Inactive'),
(17, 'ผู้อำนวยการmm', 'Inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `choose_a_teaching`
--
ALTER TABLE `choose_a_teaching`
  ADD PRIMARY KEY (`choose_id`),
  ADD KEY `FK_class_id` (`class_id`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `grade_id` (`grade_id`),
  ADD KEY `time_id` (`time_id`),
  ADD KEY `year` (`year_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choose_a_teaching`
--
ALTER TABLE `choose_a_teaching`
  MODIFY `choose_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choose_a_teaching`
--
ALTER TABLE `choose_a_teaching`
  ADD CONSTRAINT `FK_class_id` FOREIGN KEY (`class_id`) REFERENCES `classroom` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_master_id` FOREIGN KEY (`master_id`) REFERENCES `login_information` (`master_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
