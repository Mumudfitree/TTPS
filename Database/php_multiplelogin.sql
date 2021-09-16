-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2021 at 11:00 PM
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
  `login_id` int(20) NOT NULL,
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

INSERT INTO `choose_a_teaching` (`choose_id`, `login_id`, `grade_id`, `subject_id`, `class_id`, `time_id`, `date`, `year_id`, `status_choose`) VALUES
(1, 7, 1, 1, 1, 7, 'วันจันทร์', 1, 'Active'),
(2, 7, 3, 7, 25, 6, 'วันอังคาร', 1, 'Active'),
(25, 2, 2, 6, 8, 7, 'วันศุกร์', 1, 'Active'),
(26, 2, 4, 9, 15, 5, 'วันอังคาร', 1, 'Active'),
(27, 2, 1, 3, 3, 5, 'วันพฤหัสบดี', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `class_id` int(20) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `name_classroom` varchar(50) NOT NULL,
  `status_class` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`class_id`, `grade_id`, `name_classroom`, `status_class`) VALUES
(1, 1, 'ป.1/1', 'Active'),
(2, 1, 'ป.1/2', 'Active'),
(3, 1, 'ป.2/1', 'Active'),
(4, 1, 'ป.2/2', 'Active'),
(5, 1, 'ป.3/1', 'Active'),
(6, 1, 'ป.3/2', 'Active'),
(7, 2, 'ป.4/1', 'Active'),
(8, 2, 'ป.4/2', 'Active'),
(9, 2, 'ป.5/1', 'Active'),
(10, 2, 'ป.5/2', 'Active'),
(11, 2, 'ป.6/1', 'Active'),
(12, 2, 'ป.6/2', 'Active'),
(13, 4, 'ม.1/1', 'Active'),
(14, 4, 'ม.1/2', 'Active'),
(15, 4, 'ม.2/1', 'Active'),
(16, 4, 'ม.2/2', 'Active'),
(17, 4, 'ม.3/1', 'Active'),
(18, 4, 'ม.3/2', 'Active'),
(19, 5, 'ม.4/1', 'Active'),
(20, 5, 'ม.4/2', 'Active'),
(21, 5, 'ม.5/1', 'Active'),
(22, 5, 'ม.5/2', 'Active'),
(23, 5, 'ม.6/1', 'Active'),
(24, 5, 'ม.6/2', 'Active'),
(25, 3, 'ป.6/2', 'Active'),
(26, 6, 'ม.6/2', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `grade_level`
--

CREATE TABLE `grade_level` (
  `grade_id` int(20) NOT NULL,
  `grade_level_user` varchar(50) NOT NULL,
  `name_gradelevel` varchar(50) NOT NULL,
  `status_grade` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grade_level`
--

INSERT INTO `grade_level` (`grade_id`, `grade_level_user`, `name_gradelevel`, `status_grade`) VALUES
(1, 'ประถมศึกษา', 'ประถมต้น', 'Active'),
(2, 'ประถมศึกษา', 'ประถมปลาย', 'Active'),
(3, 'ประถมศึกษา', 'อิสลามศึกษา', 'Active'),
(4, 'มัธยมศึกษา', 'มัธยมต้น', 'Active'),
(5, 'มัธยมศึกษา', 'มัธยมปลาย', 'Active'),
(6, 'มัธยมศึกษา', 'อิสลามศึกษา', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `login_information`
--

CREATE TABLE `login_information` (
  `login_id` int(10) NOT NULL,
  `user_id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_role_id` int(20) NOT NULL,
  `status_login` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_information`
--

INSERT INTO `login_information` (`login_id`, `user_id`, `username`, `password`, `user_role_id`, `status_login`) VALUES
(1, 1, 'admin', '123456', 1, 'Active'),
(2, 2, 'test_teacher', '123456', 5, 'Active'),
(3, 3, 'test_director', '123456', 2, 'Active'),
(4, 4, 'primary', '123456', 6, 'Active'),
(5, 5, 'high', '123456', 7, 'Active'),
(6, 6, 'd_director', '123456', 3, 'Active'),
(7, 7, 'teacher', '123456', 5, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `prepare_to_teach`
--

CREATE TABLE `prepare_to_teach` (
  `id_prepare` int(11) NOT NULL,
  `choose_id` int(20) NOT NULL,
  `date_prepare` varchar(50) NOT NULL,
  `learning` varchar(1000) NOT NULL,
  `purpose` varchar(1000) NOT NULL,
  `how_to_teach` varchar(1000) NOT NULL,
  `media` varchar(1000) NOT NULL,
  `measure` varchar(1000) NOT NULL,
  `status_prepare_hours` varchar(20) NOT NULL DEFAULT 'Checking',
  `status_prepare` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prepare_to_teach`
--

INSERT INTO `prepare_to_teach` (`id_prepare`, `choose_id`, `date_prepare`, `learning`, `purpose`, `how_to_teach`, `media`, `measure`, `status_prepare_hours`, `status_prepare`) VALUES
(1, 1, '17/09/2021', ' PHP เป็นภาษาสคริปต์ ( Scripting Language ) คำสั่งต่างๆ จะเก็บในรูปของข้อความ (Text)อาจเขียนแทรกอยู่ภายในภาษา HTML หรือใช้งานอิสระก็ได้ แต่ในการใช้งานจริงมักใช้งานร่วมกับภาษา HTML ดังนั้นการเขียนโปรแกรมนี้ต้องมีความรู้ด้านภาษา HTML เป็นอย่างดี อย่างไรก็ตามเราสามารถใช้โปรแกรมประยุกต์มาช่วยอำนวยความสะดวกในการสร้างงานได้\r\n\r\nเช่น Macromedia Dreamweaver หรือโปรแกรมประเภท Editor เช่น EditPlus ฯลฯ โปรแกรมเหล่านี้จะช่วยจำแนกคำ เช่น คำสั่ง คำทั่วไป ตัวแปร ฯลฯ ให้มีสีต่างกันเพื่อสะดวกในการสังเกตและมีตัวเลขบอกบรรทัดทำให้สะดวกในการแก้ไข\r\n\r\n \r\n\r\n           PHP คือ ภาษาคอมพิวเตอร์ Server-Side Script ซึ่งใช้ในการจัดทำเว็บไซต์และสามารถประมวลผลออกมาในรูปแบบHTML โดยมีรากฐานโครงสร้างคำสั่งมาจากภาษา ภาษาซี ภาษาจาวา และ ภาษาเพิร์ล เป้าหมายหลักของภาษาPHP คือให้นักพัฒนาเว็บไซต์สามารถเขียนเว็บเพจ ที่มีความตอบโต้ได้อย่างรวดเร็ว', ' PHP เป็นภาษาสคริปต์ ( Scripting Language ) คำสั่งต่างๆ จะเก็บในรูปของข้อความ (Text)อาจเขียนแทรกอยู่ภายในภาษา HTML หรือใช้งานอิสระก็ได้ แต่ในการใช้งานจริงมักใช้งานร่วมกับภาษา HTML ดังนั้นการเขียนโปรแกรมนี้ต้องมีความรู้ด้านภาษา HTML เป็นอย่างดี อย่างไรก็ตามเราสามารถใช้โปรแกรมประยุกต์มาช่วยอำนวยความสะดวกในการสร้างงานได้\r\n\r\nเช่น Macromedia Dreamweaver หรือโปรแกรมประเภท Editor เช่น EditPlus ฯลฯ โปรแกรมเหล่านี้จะช่วยจำแนกคำ เช่น คำสั่ง คำทั่วไป ตัวแปร ฯลฯ ให้มีสีต่างกันเพื่อสะดวกในการสังเกตและมีตัวเลขบอกบรรทัดทำให้สะดวกในการแก้ไข\r\n\r\n \r\n\r\n           PHP คือ ภาษาคอมพิวเตอร์ Server-Side Script ซึ่งใช้ในการจัดทำเว็บไซต์และสามารถประมวลผลออกมาในรูปแบบHTML โดยมีรากฐานโครงสร้างคำสั่งมาจากภาษา ภาษาซี ภาษาจาวา และ ภาษาเพิร์ล เป้าหมายหลักของภาษาPHP คือให้นักพัฒนาเว็บไซต์สามารถเขียนเว็บเพจ ที่มีความตอบโต้ได้อย่างรวดเร็ว', ' PHP เป็นภาษาสคริปต์ ( Scripting Language ) คำสั่งต่างๆ จะเก็บในรูปของข้อความ (Text)อาจเขียนแทรกอยู่ภายในภาษา HTML หรือใช้งานอิสระก็ได้ แต่ในการใช้งานจริงมักใช้งานร่วมกับภาษา HTML ดังนั้นการเขียนโปรแกรมนี้ต้องมีความรู้ด้านภาษา HTML เป็นอย่างดี อย่างไรก็ตามเราสามารถใช้โปรแกรมประยุกต์มาช่วยอำนวยความสะดวกในการสร้างงานได้\r\n\r\nเช่น Macromedia Dreamweaver หรือโปรแกรมประเภท Editor เช่น EditPlus ฯลฯ โปรแกรมเหล่านี้จะช่วยจำแนกคำ เช่น คำสั่ง คำทั่วไป ตัวแปร ฯลฯ ให้มีสีต่างกันเพื่อสะดวกในการสังเกตและมีตัวเลขบอกบรรทัดทำให้สะดวกในการแก้ไข\r\n\r\n \r\n\r\n           PHP คือ ภาษาคอมพิวเตอร์ Server-Side Script ซึ่งใช้ในการจัดทำเว็บไซต์และสามารถประมวลผลออกมาในรูปแบบHTML โดยมีรากฐานโครงสร้างคำสั่งมาจากภาษา ภาษาซี ภาษาจาวา และ ภาษาเพิร์ล เป้าหมายหลักของภาษาPHP คือให้นักพัฒนาเว็บไซต์สามารถเขียนเว็บเพจ ที่มีความตอบโต้ได้อย่างรวดเร็ว', ' PHP เป็นภาษาสคริปต์ ( Scripting Language ) คำสั่งต่างๆ จะเก็บในรูปของข้อความ (Text)อาจเขียนแทรกอยู่ภายในภาษา HTML หรือใช้งานอิสระก็ได้ แต่ในการใช้งานจริงมักใช้งานร่วมกับภาษา HTML ดังนั้นการเขียนโปรแกรมนี้ต้องมีความรู้ด้านภาษา HTML เป็นอย่างดี อย่างไรก็ตามเราสามารถใช้โปรแกรมประยุกต์มาช่วยอำนวยความสะดวกในการสร้างงานได้\r\n\r\nเช่น Macromedia Dreamweaver หรือโปรแกรมประเภท Editor เช่น EditPlus ฯลฯ โปรแกรมเหล่านี้จะช่วยจำแนกคำ เช่น คำสั่ง คำทั่วไป ตัวแปร ฯลฯ ให้มีสีต่างกันเพื่อสะดวกในการสังเกตและมีตัวเลขบอกบรรทัดทำให้สะดวกในการแก้ไข\r\n\r\n \r\n\r\n           PHP คือ ภาษาคอมพิวเตอร์ Server-Side Script ซึ่งใช้ในการจัดทำเว็บไซต์และสามารถประมวลผลออกมาในรูปแบบHTML โดยมีรากฐานโครงสร้างคำสั่งมาจากภาษา ภาษาซี ภาษาจาวา และ ภาษาเพิร์ล เป้าหมายหลักของภาษาPHP คือให้นักพัฒนาเว็บไซต์สามารถเขียนเว็บเพจ ที่มีความตอบโต้ได้อย่างรวดเร็ว', ' PHP เป็นภาษาสคริปต์ ( Scripting Language ) คำสั่งต่างๆ จะเก็บในรูปของข้อความ (Text)อาจเขียนแทรกอยู่ภายในภาษา HTML หรือใช้งานอิสระก็ได้ แต่ในการใช้งานจริงมักใช้งานร่วมกับภาษา HTML ดังนั้นการเขียนโปรแกรมนี้ต้องมีความรู้ด้านภาษา HTML เป็นอย่างดี อย่างไรก็ตามเราสามารถใช้โปรแกรมประยุกต์มาช่วยอำนวยความสะดวกในการสร้างงานได้\r\n\r\nเช่น Macromedia Dreamweaver หรือโปรแกรมประเภท Editor เช่น EditPlus ฯลฯ โปรแกรมเหล่านี้จะช่วยจำแนกคำ เช่น คำสั่ง คำทั่วไป ตัวแปร ฯลฯ ให้มีสีต่างกันเพื่อสะดวกในการสังเกตและมีตัวเลขบอกบรรทัดทำให้สะดวกในการแก้ไข\r\n\r\n \r\n\r\n           PHP คือ ภาษาคอมพิวเตอร์ Server-Side Script ซึ่งใช้ในการจัดทำเว็บไซต์และสามารถประมวลผลออกมาในรูปแบบHTML โดยมีรากฐานโครงสร้างคำสั่งมาจากภาษา ภาษาซี ภาษาจาวา และ ภาษาเพิร์ล เป้าหมายหลักของภาษาPHP คือให้นักพัฒนาเว็บไซต์สามารถเขียนเว็บเพจ ที่มีความตอบโต้ได้อย่างรวดเร็ว', 'Checking', 'Active'),
(2, 25, '20/09/2021', 'xsa', 'asc', 'sdc', 'sdc', 'sdcsd', 'Checking', 'Active'),
(3, 26, '22/09/2021', 'sfvvdfv', 'dfvd', 'zfvdfv', 'dfvsdf', 'vdsfvsdfv', 'Checking', 'Active'),
(4, 26, '23/09/2021', 'dscsdc', 'sdcsdc', 'sdc', 'sdc', 'sdc', 'Checking', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(20) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `code_subject` varchar(20) NOT NULL,
  `name_subject` varchar(50) NOT NULL,
  `status_subject` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `grade_id`, `code_subject`, `name_subject`, `status_subject`) VALUES
(1, 1, 'ค 11101', 'คณิตศาสตร์', 'Active'),
(2, 1, 'อ 11101', 'อังกฤษ', 'Active'),
(3, 1, 'ส 11101', 'สังคมศึกษา', 'Active'),
(4, 2, 'ค 21101', 'คณิตศาสตร์', 'Active'),
(5, 2, 'อ 21101', 'อังกฤษ', 'Active'),
(6, 2, 'ส 21101', 'สังคมศึกษา', 'Active'),
(7, 3, 'อห 11101', 'อาหรับ', 'Active'),
(8, 4, 'ค 32101', 'คณิตศาสตร์(เพิ่มเติม)', 'Active'),
(9, 4, 'ว 11101', 'วิทยาศาสตร์และเทคโนโลยี', 'Active'),
(10, 5, 'คม 11101', 'เคมี', 'Active'),
(11, 5, 'ฟ 21101', 'ฟิสิกส์', 'Active'),
(12, 6, 'มล 11311', 'มาลายู', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `time_id` int(20) NOT NULL,
  `time_name` varchar(50) NOT NULL,
  `year_id` int(10) NOT NULL,
  `status_time` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`time_id`, `time_name`, `year_id`, `status_time`) VALUES
(1, '08:00 - 09:00', 1, 'Active'),
(2, '09:00 - 10:00', 1, 'Active'),
(3, '10:00 - 11:00', 1, 'Active'),
(4, '11:00 - 12:00', 1, 'Active'),
(5, '13:00 - 14:00', 1, 'Active'),
(6, '14:00 - 15:00', 1, 'Active'),
(7, '15:00 - 16:00', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `user_id` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status_user` varchar(10) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`user_id`, `firstname`, `lastname`, `email`, `status_user`) VALUES
(1, 'นายทดสอบ', 'ผู้ดูแลระบบ', 'admin@gmail.com', 'Active'),
(2, 'ทดสอบ', 'คุณครู', 'test_teacher@gmail.com', 'Active'),
(3, 'ทดสอบ', 'ผู้อำนวยการ', 'director@gmail.com', 'Active'),
(4, 'หัวหน้า', 'ประถม', 'pri@gmail.com', 'Active'),
(5, 'หัวหน้า', 'มัธยม', 'hight@gmail.com', 'Active'),
(6, 'รอง', 'ผู้อำนวยการ', 'diputydirector@gmail.com', 'Active'),
(7, 'วิโรจน์', 'ครูน่าน', 'Wi@gmail.com', 'Active');

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
(5, 'ครู', 'Active'),
(6, 'หัวหน้าช่วงชั้นประถม', 'Active'),
(7, 'หัวหน้าช่วงชั้นมัธยม', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_summary`
--

CREATE TABLE `weekly_summary` (
  `id_prepare_week` int(20) NOT NULL,
  `choose_id` int(20) NOT NULL,
  `date_prepare_week` varchar(20) NOT NULL,
  `goal` varchar(1000) NOT NULL,
  `result` varchar(1000) NOT NULL,
  `activity_good` varchar(1000) NOT NULL,
  `activity_nogood` varchar(1000) NOT NULL,
  `problem` varchar(1000) NOT NULL,
  `student` varchar(1000) NOT NULL,
  `Solve_the_problem` text NOT NULL,
  `status_prepare_week` varchar(20) NOT NULL DEFAULT 'Checking',
  `status_week` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weekly_summary`
--

INSERT INTO `weekly_summary` (`id_prepare_week`, `choose_id`, `date_prepare_week`, `goal`, `result`, `activity_good`, `activity_nogood`, `problem`, `student`, `Solve_the_problem`, `status_prepare_week`, `status_week`) VALUES
(1, 1, '20/09/2021', ' PHP เป็นภาษาสคริปต์ ( Scripting Language ) คำสั่งต่างๆ จะเก็บในรูปของข้อความ (Text)อาจเขียนแทรกอยู่ภายในภาษา HTML หรือใช้งานอิสระก็ได้ แต่ในการใช้งานจริงมักใช้งานร่วมกับภาษา HTML ดังนั้นการเขียนโปรแกรมนี้ต้องมีความรู้ด้านภาษา HTML เป็นอย่างดี อย่างไรก็ตามเราสามารถใช้โปรแกรมประยุกต์มาช่วยอำนวยความสะดวกในการสร้างงานได้\r\n\r\nเช่น Macromedia Dreamweaver หรือโปรแกรมประเภท Editor เช่น EditPlus ฯลฯ โปรแกรมเหล่านี้จะช่วยจำแนกคำ เช่น คำสั่ง คำทั่วไป ตัวแปร ฯลฯ ให้มีสีต่างกันเพื่อสะดวกในการสังเกตและมีตัวเลขบอกบรรทัดทำให้สะดวกในการแก้ไข\r\n\r\n \r\n\r\n           PHP คือ ภาษาคอมพิวเตอร์ Server-Side Script ซึ่งใช้ในการจัดทำเว็บไซต์และสามารถประมวลผลออกมาในรูปแบบHTML โดยมีรากฐานโครงสร้างคำสั่งมาจากภาษา ภาษาซี ภาษาจาวา และ ภาษาเพิร์ล เป้าหมายหลักของภาษาPHP คือให้นักพัฒนาเว็บไซต์สามารถเขียนเว็บเพจ ที่มีความตอบโต้ได้อย่างรวดเร็ว', ' PHP เป็นภาษาสคริปต์ ( Scripting Language ) คำสั่งต่างๆ จะเก็บในรูปของข้อความ (Text)อาจเขียนแทรกอยู่ภายในภาษา HTML หรือใช้งานอิสระก็ได้ แต่ในการใช้งานจริงมักใช้งานร่วมกับภาษา HTML ดังนั้นการเขียนโปรแกรมนี้ต้องมีความรู้ด้านภาษา HTML เป็นอย่างดี อย่างไรก็ตามเราสามารถใช้โปรแกรมประยุกต์มาช่วยอำนวยความสะดวกในการสร้างงานได้\r\n\r\nเช่น Macromedia Dreamweaver หรือโปรแกรมประเภท Editor เช่น EditPlus ฯลฯ โปรแกรมเหล่านี้จะช่วยจำแนกคำ เช่น คำสั่ง คำทั่วไป ตัวแปร ฯลฯ ให้มีสีต่างกันเพื่อสะดวกในการสังเกตและมีตัวเลขบอกบรรทัดทำให้สะดวกในการแก้ไข\r\n\r\n \r\n\r\n           PHP คือ ภาษาคอมพิวเตอร์ Server-Side Script ซึ่งใช้ในการจัดทำเว็บไซต์และสามารถประมวลผลออกมาในรูปแบบHTML โดยมีรากฐานโครงสร้างคำสั่งมาจากภาษา ภาษาซี ภาษาจาวา และ ภาษาเพิร์ล เป้าหมายหลักของภาษาPHP คือให้นักพัฒนาเว็บไซต์สามารถเขียนเว็บเพจ ที่มีความตอบโต้ได้อย่างรวดเร็ว', ' PHP เป็นภาษาสคริปต์ ( Scripting Language ) คำสั่งต่างๆ จะเก็บในรูปของข้อความ (Text)อาจเขียนแทรกอยู่ภายในภาษา HTML หรือใช้งานอิสระก็ได้ แต่ในการใช้งานจริงมักใช้งานร่วมกับภาษา HTML ดังนั้นการเขียนโปรแกรมนี้ต้องมีความรู้ด้านภาษา HTML เป็นอย่างดี อย่างไรก็ตามเราสามารถใช้โปรแกรมประยุกต์มาช่วยอำนวยความสะดวกในการสร้างงานได้\r\n\r\nเช่น Macromedia Dreamweaver หรือโปรแกรมประเภท Editor เช่น EditPlus ฯลฯ โปรแกรมเหล่านี้จะช่วยจำแนกคำ เช่น คำสั่ง คำทั่วไป ตัวแปร ฯลฯ ให้มีสีต่างกันเพื่อสะดวกในการสังเกตและมีตัวเลขบอกบรรทัดทำให้สะดวกในการแก้ไข\r\n\r\n \r\n\r\n           PHP คือ ภาษาคอมพิวเตอร์ Server-Side Script ซึ่งใช้ในการจัดทำเว็บไซต์และสามารถประมวลผลออกมาในรูปแบบHTML โดยมีรากฐานโครงสร้างคำสั่งมาจากภาษา ภาษาซี ภาษาจาวา และ ภาษาเพิร์ล เป้าหมายหลักของภาษาPHP คือให้นักพัฒนาเว็บไซต์สามารถเขียนเว็บเพจ ที่มีความตอบโต้ได้อย่างรวดเร็ว', ' PHP เป็นภาษาสคริปต์ ( Scripting Language ) คำสั่งต่างๆ จะเก็บในรูปของข้อความ (Text)อาจเขียนแทรกอยู่ภายในภาษา HTML หรือใช้งานอิสระก็ได้ แต่ในการใช้งานจริงมักใช้งานร่วมกับภาษา HTML ดังนั้นการเขียนโปรแกรมนี้ต้องมีความรู้ด้านภาษา HTML เป็นอย่างดี อย่างไรก็ตามเราสามารถใช้โปรแกรมประยุกต์มาช่วยอำนวยความสะดวกในการสร้างงานได้\r\n\r\nเช่น Macromedia Dreamweaver หรือโปรแกรมประเภท Editor เช่น EditPlus ฯลฯ โปรแกรมเหล่านี้จะช่วยจำแนกคำ เช่น คำสั่ง คำทั่วไป ตัวแปร ฯลฯ ให้มีสีต่างกันเพื่อสะดวกในการสังเกตและมีตัวเลขบอกบรรทัดทำให้สะดวกในการแก้ไข\r\n\r\n \r\n\r\n           PHP คือ ภาษาคอมพิวเตอร์ Server-Side Script ซึ่งใช้ในการจัดทำเว็บไซต์และสามารถประมวลผลออกมาในรูปแบบHTML โดยมีรากฐานโครงสร้างคำสั่งมาจากภาษา ภาษาซี ภาษาจาวา และ ภาษาเพิร์ล เป้าหมายหลักของภาษาPHP คือให้นักพัฒนาเว็บไซต์สามารถเขียนเว็บเพจ ที่มีความตอบโต้ได้อย่างรวดเร็ว', ' PHP เป็นภาษาสคริปต์ ( Scripting Language ) คำสั่งต่างๆ จะเก็บในรูปของข้อความ (Text)อาจเขียนแทรกอยู่ภายในภาษา HTML หรือใช้งานอิสระก็ได้ แต่ในการใช้งานจริงมักใช้งานร่วมกับภาษา HTML ดังนั้นการเขียนโปรแกรมนี้ต้องมีความรู้ด้านภาษา HTML เป็นอย่างดี อย่างไรก็ตามเราสามารถใช้โปรแกรมประยุกต์มาช่วยอำนวยความสะดวกในการสร้างงานได้\r\n\r\nเช่น Macromedia Dreamweaver หรือโปรแกรมประเภท Editor เช่น EditPlus ฯลฯ โปรแกรมเหล่านี้จะช่วยจำแนกคำ เช่น คำสั่ง คำทั่วไป ตัวแปร ฯลฯ ให้มีสีต่างกันเพื่อสะดวกในการสังเกตและมีตัวเลขบอกบรรทัดทำให้สะดวกในการแก้ไข\r\n\r\n \r\n\r\n           PHP คือ ภาษาคอมพิวเตอร์ Server-Side Script ซึ่งใช้ในการจัดทำเว็บไซต์และสามารถประมวลผลออกมาในรูปแบบHTML โดยมีรากฐานโครงสร้างคำสั่งมาจากภาษา ภาษาซี ภาษาจาวา และ ภาษาเพิร์ล เป้าหมายหลักของภาษาPHP คือให้นักพัฒนาเว็บไซต์สามารถเขียนเว็บเพจ ที่มีความตอบโต้ได้อย่างรวดเร็ว', ' PHP เป็นภาษาสคริปต์ ( Scripting Language ) คำสั่งต่างๆ จะเก็บในรูปของข้อความ (Text)อาจเขียนแทรกอยู่ภายในภาษา HTML หรือใช้งานอิสระก็ได้ แต่ในการใช้งานจริงมักใช้งานร่วมกับภาษา HTML ดังนั้นการเขียนโปรแกรมนี้ต้องมีความรู้ด้านภาษา HTML เป็นอย่างดี อย่างไรก็ตามเราสามารถใช้โปรแกรมประยุกต์มาช่วยอำนวยความสะดวกในการสร้างงานได้\r\n\r\nเช่น Macromedia Dreamweaver หรือโปรแกรมประเภท Editor เช่น EditPlus ฯลฯ โปรแกรมเหล่านี้จะช่วยจำแนกคำ เช่น คำสั่ง คำทั่วไป ตัวแปร ฯลฯ ให้มีสีต่างกันเพื่อสะดวกในการสังเกตและมีตัวเลขบอกบรรทัดทำให้สะดวกในการแก้ไข\r\n\r\n \r\n\r\n           PHP คือ ภาษาคอมพิวเตอร์ Server-Side Script ซึ่งใช้ในการจัดทำเว็บไซต์และสามารถประมวลผลออกมาในรูปแบบHTML โดยมีรากฐานโครงสร้างคำสั่งมาจากภาษา ภาษาซี ภาษาจาวา และ ภาษาเพิร์ล เป้าหมายหลักของภาษาPHP คือให้นักพัฒนาเว็บไซต์สามารถเขียนเว็บเพจ ที่มีความตอบโต้ได้อย่างรวดเร็ว', ' PHP เป็นภาษาสคริปต์ ( Scripting Language ) คำสั่งต่างๆ จะเก็บในรูปของข้อความ (Text)อาจเขียนแทรกอยู่ภายในภาษา HTML หรือใช้งานอิสระก็ได้ แต่ในการใช้งานจริงมักใช้งานร่วมกับภาษา HTML ดังนั้นการเขียนโปรแกรมนี้ต้องมีความรู้ด้านภาษา HTML เป็นอย่างดี อย่างไรก็ตามเราสามารถใช้โปรแกรมประยุกต์มาช่วยอำนวยความสะดวกในการสร้างงานได้\r\n\r\nเช่น Macromedia Dreamweaver หรือโปรแกรมประเภท Editor เช่น EditPlus ฯลฯ โปรแกรมเหล่านี้จะช่วยจำแนกคำ เช่น คำสั่ง คำทั่วไป ตัวแปร ฯลฯ ให้มีสีต่างกันเพื่อสะดวกในการสังเกตและมีตัวเลขบอกบรรทัดทำให้สะดวกในการแก้ไข\r\n\r\n \r\n\r\n           PHP คือ ภาษาคอมพิวเตอร์ Server-Side Script ซึ่งใช้ในการจัดทำเว็บไซต์และสามารถประมวลผลออกมาในรูปแบบHTML โดยมีรากฐานโครงสร้างคำสั่งมาจากภาษา ภาษาซี ภาษาจาวา และ ภาษาเพิร์ล เป้าหมายหลักของภาษาPHP คือให้นักพัฒนาเว็บไซต์สามารถเขียนเว็บเพจ ที่มีความตอบโต้ได้อย่างรวดเร็ว', 'Complete', 'Active'),
(2, 25, '21/09/2021', 'fdvdvv', 'dsfvsd', 'fvdfvsdfv', 'dsfvsd', 'fvdsfvdsfv', 'sdfvdsfv', 'sdfvdfv', 'Complete', 'Active'),
(4, 26, '22/09/2021', 'w4gdgbfgb', 'fdgbdfgbdfgb', 'fdgbdfgb', 'fdgbdfgb', 'fdgbdfgb', 'dfgbfdgb', 'dfgbfdgb', 'Checking', 'Active'),
(9, 2, '22/09/2021', 'cuycyu', 'cu', 'cucuc', 'cuycuy', 'cyucuyc', 'ycuycuyc', 'ddfd', 'Checking', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `year_id` int(20) NOT NULL,
  `year_name` int(10) NOT NULL,
  `term` varchar(30) NOT NULL,
  `status_year` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`year_id`, `year_name`, `term`, `status_year`) VALUES
(1, 2021, '1', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `choose_a_teaching`
--
ALTER TABLE `choose_a_teaching`
  ADD PRIMARY KEY (`choose_id`),
  ADD KEY `FK_class_id` (`class_id`),
  ADD KEY `master_id` (`login_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `grade_id` (`grade_id`),
  ADD KEY `time_id` (`time_id`),
  ADD KEY `year` (`year_id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `grade_id` (`grade_id`);

--
-- Indexes for table `grade_level`
--
ALTER TABLE `grade_level`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `login_information`
--
ALTER TABLE `login_information`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `user_role_id` (`user_role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `prepare_to_teach`
--
ALTER TABLE `prepare_to_teach`
  ADD PRIMARY KEY (`id_prepare`),
  ADD KEY `choose_id` (`choose_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `grade_id` (`grade_id`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`time_id`),
  ADD KEY `year_id` (`year_id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- Indexes for table `weekly_summary`
--
ALTER TABLE `weekly_summary`
  ADD PRIMARY KEY (`id_prepare_week`),
  ADD KEY `choose_id` (`choose_id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choose_a_teaching`
--
ALTER TABLE `choose_a_teaching`
  MODIFY `choose_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `class_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `grade_level`
--
ALTER TABLE `grade_level`
  MODIFY `grade_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_information`
--
ALTER TABLE `login_information`
  MODIFY `login_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prepare_to_teach`
--
ALTER TABLE `prepare_to_teach`
  MODIFY `id_prepare` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `time_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `weekly_summary`
--
ALTER TABLE `weekly_summary`
  MODIFY `id_prepare_week` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `year_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_information`
--
ALTER TABLE `login_information`
  ADD CONSTRAINT `FK_role` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`user_role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
