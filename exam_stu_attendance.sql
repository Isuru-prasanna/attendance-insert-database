-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2023 at 06:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `misbpudb`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam_stu_attendance`
--

CREATE TABLE `exam_stu_attendance` (
  `id` int(11) NOT NULL,
  `index_no` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `ac_year` int(11) NOT NULL,
  `attendance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_stu_attendance`
--

INSERT INTO `exam_stu_attendance` (`id`, `index_no`, `subject`, `ac_year`, `attendance`) VALUES
(197, 'BS/2018/01', '268', 2018, 100),
(198, 'LS/2018/30', '268', 2018, 100),
(199, 'LS/2018/31', '268', 2018, 100),
(200, 'BS/2018/01', '267', 2018, 2),
(201, 'LS/2018/31', '267', 2018, 2),
(202, 'BS/2018/01', '300', 2018, 1),
(203, 'BS/2018/03', '300', 2018, 1),
(204, 'LS/2018/30', '300', 2018, 1),
(205, 'LS/2018/31', '300', 2018, 1),
(206, 'LS/2018/32', '300', 2018, 1),
(207, 'LS/2018/33', '300', 2018, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_stu_attendance`
--
ALTER TABLE `exam_stu_attendance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam_stu_attendance`
--
ALTER TABLE `exam_stu_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
