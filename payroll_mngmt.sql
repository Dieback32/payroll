-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2018 at 03:06 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll_mngmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `duration` decimal(10,2) NOT NULL,
  `overtime` decimal(10,2) NOT NULL,
  `undertime` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `shift_id`, `date_in`, `date_out`, `duration`, `overtime`, `undertime`) VALUES
(3, 1, 2, '2018-05-24', '2018-05-24', '2.87', '0.00', '5.13'),
(4, 1, 12, '2018-05-25', '2018-05-25', '8.85', '0.85', '0.00'),
(7, 1, 31, '2018-05-26', '2018-05-26', '4.32', '0.00', '3.68'),
(10, 1, 40, '2018-05-28', '2018-05-28', '9.42', '1.42', '0.00'),
(13, 1, 55, '2018-05-29', '2018-05-29', '3.05', '0.00', '4.95'),
(15, 1, 61, '2018-05-30', '2018-05-30', '2.34', '0.00', '5.66'),
(19, 1, 75, '2018-07-14', '2018-07-14', '8.03', '0.03', '0.00'),
(20, 1, 77, '2018-07-16', '0000-00-00', '0.00', '0.00', '0.00'),
(22, 2, 82, '2018-07-17', '2018-07-17', '9.24', '1.24', '0.00'),
(23, 1, 84, '2018-07-18', '0000-00-00', '0.00', '0.00', '0.00'),
(24, 1, 85, '2018-07-20', '2018-07-20', '2.26', '0.00', '5.74'),
(25, 1, 88, '2018-07-23', '2018-07-23', '8.34', '0.34', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`) VALUES
(1, 'Web Development II'),
(2, 'Marketing Department');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `total_employees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `department_id`, `designation`, `total_employees`) VALUES
(2, 2, 'Staff III', 2),
(3, 2, 'Staff II', 1),
(4, 1, 'Web Designer', 2),
(6, 1, 'Backend Developer', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee_allowance`
--

CREATE TABLE `employee_allowance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `allowance_type` int(11) NOT NULL,
  `allowance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_allowance`
--

INSERT INTO `employee_allowance` (`id`, `employee_id`, `allowance_type`, `allowance`) VALUES
(1, 1, 1, '3000.00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_breaks`
--

CREATE TABLE `employee_breaks` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `break_duration` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_breaks`
--

INSERT INTO `employee_breaks` (`id`, `employee_id`, `shift_id`, `break_duration`) VALUES
(1, '1', 2, '0.90'),
(2, '1', 2, '0.23'),
(3, '1', 2, '0.05'),
(4, '1', 2, '0.15'),
(5, '1', 12, '0.23'),
(6, '1', 12, '0.55'),
(7, '1', 20, '0.18'),
(8, '1', 25, '0.02'),
(9, '1', 25, '0.63'),
(10, '1', 31, '0.10'),
(11, '1', 31, '0.12'),
(12, '1', 40, '0.08'),
(13, '1', 40, '0.03'),
(16, '1', 57, '0.25'),
(17, '1', 67, '0.00'),
(18, '1', 72, '0.03'),
(19, '1', 88, '0.18');

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `em_firstname` varchar(30) NOT NULL,
  `em_lastname` varchar(30) NOT NULL,
  `em_home_address` varchar(200) NOT NULL,
  `em_phone` varchar(50) NOT NULL,
  `em_mobile` varchar(50) NOT NULL,
  `em_email` varchar(100) NOT NULL,
  `em_skype` varchar(50) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `paypal_accnt` varchar(255) NOT NULL,
  `monthly_salary` decimal(10,2) NOT NULL,
  `leave_credits` int(11) NOT NULL,
  `sick_credits` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `employee_id`, `em_firstname`, `em_lastname`, `em_home_address`, `em_phone`, `em_mobile`, `em_email`, `em_skype`, `designation_id`, `startdate`, `paypal_accnt`, `monthly_salary`, `leave_credits`, `sick_credits`, `status`) VALUES
(1, '12345', 'Billie Joe', 'Armstrong', 'sample text', '999999999', '999999999', 'sample@example.com', 'sampleID', 6, '2017-11-06', 'sample22@paypal.com', '25000.00', 0, 0, 1),
(2, '140337', 'Kirk', 'Hammett', 'sample text', '999999999', '999999999', 'sample@example.com', 'sampleID', 4, '2018-05-01', 'sample256@paypal.com', '12000.00', 0, 0, 0),
(15, '548963312', 'Danica', 'Anderson', 'sample text', '9999999999', '9999999999', 'sample@gmail.com', 'sampleID', 3, '2018-02-14', 'sample@paypal.com', '16000.00', 0, 0, 0),
(16, '54975611', 'Marvin', 'Marvella', 'sample text', '999999999', '9999999999', 'sample@example.com', 'sampleID', 2, '2018-03-12', 'sample2526@paypal.com', '12000.00', 0, 0, 0),
(20, '3wc346740005', 'Meggie', 'Cruz', 'sample text', '9999999999', '999999999', 'sample@example.com', 'sampleID', 2, '2018-02-01', 'sample2526@paypal.com', '19000.00', 0, 0, 0),
(21, '3wc191588321', 'James', 'Hetfield', 'sample text', '98988989898', '98989898989', 'sample232@example.com', 'sampleID', 6, '2018-02-07', 'sample666@paypal.com', '16000.00', 0, 0, 0),
(26, '3wc664356302', 'Myles', 'Kenedy', 'Bora', '999999999', '999999999', 'myles66@gmail.com', 'myles.kenedy', 4, '2018-06-05', 'myles666@gmail.com', '16000.00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `expected_shifts`
--

CREATE TABLE `expected_shifts` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `year` year(4) NOT NULL,
  `month` int(2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expected_shifts`
--

INSERT INTO `expected_shifts` (`id`, `date`, `year`, `month`, `status`) VALUES
(32, '2018-05-01', 2018, 5, 1),
(33, '2018-05-02', 2018, 5, 1),
(34, '2018-05-03', 2018, 5, 1),
(35, '2018-05-04', 2018, 5, 1),
(36, '2018-05-05', 2018, 5, 1),
(37, '2018-05-06', 2018, 5, 0),
(38, '2018-05-07', 2018, 5, 1),
(39, '2018-05-08', 2018, 5, 1),
(40, '2018-05-09', 2018, 5, 1),
(41, '2018-05-10', 2018, 5, 1),
(42, '2018-05-11', 2018, 5, 1),
(43, '2018-05-12', 2018, 5, 1),
(44, '2018-05-13', 2018, 5, 0),
(45, '2018-05-14', 2018, 5, 1),
(46, '2018-05-15', 2018, 5, 1),
(47, '2018-05-16', 2018, 5, 1),
(48, '2018-05-17', 2018, 5, 1),
(49, '2018-05-18', 2018, 5, 1),
(50, '2018-05-19', 2018, 5, 1),
(51, '2018-05-20', 2018, 5, 0),
(52, '2018-05-21', 2018, 5, 1),
(53, '2018-05-22', 2018, 5, 1),
(54, '2018-05-23', 2018, 5, 1),
(55, '2018-05-24', 2018, 5, 1),
(56, '2018-05-25', 2018, 5, 1),
(57, '2018-05-26', 2018, 5, 1),
(58, '2018-05-27', 2018, 5, 0),
(59, '2018-05-28', 2018, 5, 1),
(60, '2018-05-29', 2018, 5, 1),
(61, '2018-05-30', 2018, 5, 1),
(62, '2018-05-31', 2018, 5, 1),
(63, '2018-06-01', 2018, 6, 1),
(64, '2018-06-02', 2018, 6, 1),
(65, '2018-06-03', 2018, 6, 0),
(66, '2018-06-04', 2018, 6, 1),
(67, '2018-06-05', 2018, 6, 1),
(68, '2018-06-06', 2018, 6, 1),
(69, '2018-06-07', 2018, 6, 1),
(70, '2018-06-08', 2018, 6, 1),
(71, '2018-06-09', 2018, 6, 2),
(72, '2018-06-10', 2018, 6, 0),
(73, '2018-06-11', 2018, 6, 1),
(74, '2018-06-12', 2018, 6, 1),
(75, '2018-06-13', 2018, 6, 1),
(76, '2018-06-14', 2018, 6, 1),
(77, '2018-06-15', 2018, 6, 1),
(78, '2018-06-16', 2018, 6, 1),
(79, '2018-06-17', 2018, 6, 0),
(80, '2018-06-18', 2018, 6, 1),
(81, '2018-06-19', 2018, 6, 1),
(82, '2018-06-20', 2018, 6, 1),
(83, '2018-06-21', 2018, 6, 1),
(84, '2018-06-22', 2018, 6, 1),
(85, '2018-06-23', 2018, 6, 1),
(86, '2018-06-24', 2018, 6, 0),
(87, '2018-06-25', 2018, 6, 1),
(88, '2018-06-26', 2018, 6, 1),
(89, '2018-06-27', 2018, 6, 1),
(90, '2018-06-28', 2018, 6, 1),
(91, '2018-06-29', 2018, 6, 1),
(92, '2018-06-30', 2018, 6, 1),
(93, '2018-07-01', 2018, 7, 0),
(94, '2018-07-02', 2018, 7, 1),
(95, '2018-07-03', 2018, 7, 1),
(96, '2018-07-04', 2018, 7, 1),
(97, '2018-07-05', 2018, 7, 1),
(98, '2018-07-06', 2018, 7, 1),
(99, '2018-07-07', 2018, 7, 1),
(100, '2018-07-08', 2018, 7, 0),
(101, '2018-07-09', 2018, 7, 1),
(102, '2018-07-10', 2018, 7, 1),
(103, '2018-07-11', 2018, 7, 1),
(104, '2018-07-12', 2018, 7, 1),
(105, '2018-07-13', 2018, 7, 1),
(106, '2018-07-14', 2018, 7, 1),
(107, '2018-07-15', 2018, 7, 0),
(108, '2018-07-16', 2018, 7, 1),
(109, '2018-07-17', 2018, 7, 1),
(110, '2018-07-18', 2018, 7, 1),
(111, '2018-07-19', 2018, 7, 1),
(112, '2018-07-20', 2018, 7, 1),
(113, '2018-07-21', 2018, 7, 1),
(114, '2018-07-22', 2018, 7, 0),
(115, '2018-07-23', 2018, 7, 1),
(116, '2018-07-24', 2018, 7, 1),
(117, '2018-07-25', 2018, 7, 1),
(118, '2018-07-26', 2018, 7, 1),
(119, '2018-07-27', 2018, 7, 1),
(120, '2018-07-28', 2018, 7, 1),
(121, '2018-07-29', 2018, 7, 0),
(122, '2018-07-30', 2018, 7, 1),
(123, '2018-07-31', 2018, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payslip`
--

CREATE TABLE `payslip` (
  `id` int(11) NOT NULL,
  `id_number` bigint(20) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `worked_days` int(11) NOT NULL,
  `holiday` int(11) NOT NULL,
  `overtime` decimal(10,2) NOT NULL,
  `undertime` decimal(10,2) NOT NULL,
  `paid_leaves` decimal(10,2) NOT NULL,
  `paid_sick` decimal(10,2) NOT NULL,
  `deduction` decimal(11,2) NOT NULL,
  `gross` decimal(10,2) NOT NULL,
  `total_earn` decimal(10,2) NOT NULL,
  `net` decimal(11,2) NOT NULL,
  `status` int(11) NOT NULL,
  `logs` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payslip`
--

INSERT INTO `payslip` (`id`, `id_number`, `employee_id`, `date_from`, `date_to`, `worked_days`, `holiday`, `overtime`, `undertime`, `paid_leaves`, `paid_sick`, `deduction`, `gross`, `total_earn`, `net`, `status`, `logs`) VALUES
(31, 175602879, 1, '2018-06-01', '2018-06-29', 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '961.54', '961.54', 0, 1532122570),
(35, 562463478, 1, '2018-07-16', '2018-07-20', 1, 0, '0.00', '689.90', '0.00', '0.00', '689.90', '961.54', '961.54', '271.63', 1, 1532183413),
(36, 591143179, 2, '2018-07-16', '2018-07-20', 1, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '461.54', '461.54', '461.54', 0, 1532183944),
(37, 365341548, 1, '2018-05-24', '2018-05-30', 6, 0, '272.84', '2334.13', '0.00', '0.00', '2334.13', '5769.23', '6042.07', '3707.93', 1, 1532186028),
(38, 43001001, 1, '2018-07-23', '2018-07-23', 1, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '961.54', '961.54', '961.54', 0, 1532382457);

-- --------------------------------------------------------

--
-- Table structure for table `process_list`
--

CREATE TABLE `process_list` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request_leave`
--

CREATE TABLE `request_leave` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `status` int(1) NOT NULL,
  `logs` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_leave`
--

INSERT INTO `request_leave` (`id`, `employee_id`, `request_date`, `status`, `logs`) VALUES
(1, 1, '2018-05-31', 1, 1527172162),
(2, 1, '2018-05-29', 0, 1527350421);

-- --------------------------------------------------------

--
-- Table structure for table `request_overtime`
--

CREATE TABLE `request_overtime` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_overtime`
--

INSERT INTO `request_overtime` (`id`, `employee_id`, `shift_id`, `date`, `note`, `status`) VALUES
(1, '12345', 40, '2018-05-28', 'sample text', 1),
(2, '12345', 12, '2018-05-25', 'asdfsdafsadf', 1),
(3, '12345', 57, '2018-05-30', 'asdfsdfsadf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `request_sickleaves`
--

CREATE TABLE `request_sickleaves` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_sickleaves`
--

INSERT INTO `request_sickleaves` (`id`, `employee_id`, `request_date`, `status`) VALUES
(1, 1, '2018-05-31', 1),
(3, 1, '2018-05-27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE `summary` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `month` int(2) NOT NULL,
  `total_shift` decimal(10,2) NOT NULL,
  `total_overtime` decimal(10,2) NOT NULL,
  `total_undertime` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `summary`
--

INSERT INTO `summary` (`id`, `employee_id`, `year`, `month`, `total_shift`, `total_overtime`, `total_undertime`) VALUES
(1, 1, 2018, 5, '30.85', '1.42', '19.42'),
(2, 2, 2018, 5, '0.71', '0.00', '0.00'),
(15, 15, 2018, 6, '0.00', '0.00', '0.00'),
(16, 16, 2018, 6, '0.00', '0.00', '0.00'),
(20, 20, 2018, 6, '0.00', '0.00', '0.00'),
(21, 21, 2018, 6, '0.00', '0.00', '0.00'),
(26, 1, 2018, 6, '0.00', '0.00', '0.00'),
(27, 2, 2018, 6, '0.00', '0.00', '0.00'),
(28, 15, 2018, 6, '0.00', '0.00', '0.00'),
(29, 16, 2018, 6, '0.00', '0.00', '0.00'),
(34, 26, 2018, 6, '0.00', '0.00', '0.00'),
(35, 1, 2018, 7, '18.63', '0.00', '5.74'),
(36, 2, 2018, 7, '0.00', '0.00', '0.00'),
(37, 15, 2018, 7, '0.00', '0.00', '0.00'),
(38, 16, 2018, 7, '0.00', '0.00', '0.00'),
(39, 20, 2018, 7, '0.00', '0.00', '0.00'),
(40, 21, 2018, 7, '0.00', '0.00', '0.00'),
(41, 26, 2018, 7, '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authorization` int(1) NOT NULL,
  `logged` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `user_id`, `username`, `password`, `authorization`, `logged`) VALUES
(1, 1, 'billie', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 0),
(2, 0, 'admin', '0192023a7bbd73250516f069df18b500', 1, 0),
(10, 2, 'kirk.h', '482c811da5d5b4bc6d497ffa98491e38', 2, 0),
(11, 15, 'danica.a', '482c811da5d5b4bc6d497ffa98491e38', 2, 0),
(12, 16, 'marvin.m', 'db3fc40e6439d4d972870252ccc72f62', 2, 0),
(14, 20, 'meggie.c', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 0),
(15, 21, 'james.h', '7c8a7c5f8338b02d82840d64e23e47e6', 2, 0),
(20, 26, 'myles.k', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `working_shift`
--

CREATE TABLE `working_shift` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `punch_type` int(2) NOT NULL,
  `time` bigint(20) NOT NULL,
  `shift_details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `working_shift`
--

INSERT INTO `working_shift` (`id`, `employee_id`, `date`, `punch_type`, `time`, `shift_details`) VALUES
(2, '1', '2018-05-24', 1, 1527186501, 'Punch in at 2018-05-24 02:28 PM'),
(3, '1', '2018-05-24', 2, 1527187130, 'Break started at 2018-05-24 02:38 PM'),
(4, '1', '2018-05-24', 3, 1527190370, 'Break ended at 2018-05-24 03:32 PM'),
(5, '1', '2018-05-24', 2, 1527191531, 'Break started at 2018-05-24 03:52 PM'),
(6, '1', '2018-05-24', 3, 1527192372, 'Break ended at 2018-05-24 04:06 PM'),
(7, '1', '2018-05-24', 2, 1527194590, 'Break started at 2018-05-24 04:43 PM'),
(8, '1', '2018-05-24', 3, 1527194790, 'Break ended at 2018-05-24 04:46 PM'),
(9, '1', '2018-05-24', 2, 1527194796, 'Break started at 2018-05-24 04:46 PM'),
(10, '1', '2018-05-24', 3, 1527195337, 'Break ended at 2018-05-24 04:55 PM'),
(11, '1', '2018-05-24', 0, 1527201623, 'Punch Out at 2018-05-24 06:40 PM'),
(12, '1', '2018-05-25', 1, 1527252123, 'Punch in at 2018-05-25 08:42 AM'),
(13, '1', '2018-05-25', 2, 1527254879, 'Break started at 2018-05-25 09:27 AM'),
(14, '1', '2018-05-25', 3, 1527255725, 'Break ended at 2018-05-25 09:42 AM'),
(15, '1', '2018-05-25', 2, 1527269100, 'Break started at 2018-05-25 01:25 PM'),
(16, '1', '2018-05-25', 3, 1527271132, 'Break ended at 2018-05-25 01:58 PM'),
(17, '1', '2018-05-25', 0, 1527286800, 'Punch Out at 2018-05-25 06:20 PM'),
(31, '1', '2018-05-26', 1, 1527356689, 'Punch in at 2018-05-26 01:44 PM'),
(32, '1', '2018-05-26', 2, 1527358714, 'Break started at 2018-05-26 02:18 PM'),
(33, '1', '2018-05-26', 3, 1527359077, 'Break ended at 2018-05-26 02:24 PM'),
(34, '1', '2018-05-26', 2, 1527368707, 'Break started at 2018-05-26 05:05 PM'),
(35, '1', '2018-05-26', 3, 1527369146, 'Break ended at 2018-05-26 05:12 PM'),
(36, '1', '2018-05-26', 0, 1527373034, 'Punch Out at 2018-05-26 06:17 PM'),
(39, '1', '2018-05-27', 1, 1527436550, 'Punch in at 2018-05-27 11:55 AM'),
(40, '1', '2018-05-28', 1, 1527512033, 'Punch in at 2018-05-28 08:53 AM'),
(41, '1', '2018-05-28', 2, 1527514160, 'Break started at 2018-05-28 09:29 AM'),
(42, '1', '2018-05-28', 3, 1527514463, 'Break ended at 2018-05-28 09:34 AM'),
(43, '1', '2018-05-28', 2, 1527537935, 'Break started at 2018-05-28 04:05 PM'),
(44, '1', '2018-05-28', 3, 1527538064, 'Break ended at 2018-05-28 04:07 PM'),
(45, '1', '2018-05-28', 0, 1527546334, 'Punch Out at 2018-05-28 06:25 PM'),
(46, '1', '2018-05-28', 0, 1527546365, 'Punch Out at 2018-05-28 06:26 PM'),
(55, '1', '2018-05-29', 1, 1527621902, 'Punch in at 2018-05-29 03:25 PM'),
(56, '1', '2018-05-29', 0, 1527632887, 'Punch Out at 2018-05-29 06:28 PM'),
(61, '1', '2018-05-30', 1, 1527686523, 'Punch in at 2018-05-30 11:41 AM'),
(62, '1', '2018-05-30', 0, 1527694956, 'Punch Out at 2018-05-30 11:42 AM'),
(67, '1', '2018-07-13', 1, 1531512233, 'Punch in at 2018-07-13 04:03 PM'),
(68, '1', '2018-07-13', 2, 1531512764, 'Break started at 2018-07-13 04:12 PM'),
(69, '1', '2018-07-13', 2, 1531512791, 'Break started at 2018-07-13 04:13 PM'),
(70, '1', '2018-07-13', 3, 1531512797, 'Break ended at 2018-07-13 04:13 PM'),
(71, '1', '2018-07-13', 3, 1531512827, 'Break ended at 2018-07-13 04:13 PM'),
(72, '1', '2018-07-13', 1, 1531515286, 'Punch in at 2018-07-13 04:54 PM'),
(73, '1', '2018-07-13', 2, 1531515551, 'Break started at 2018-07-13 04:59 PM'),
(74, '1', '2018-07-13', 3, 1531515724, 'Break ended at 2018-07-13 05:02 PM'),
(75, '1', '2018-07-14', 1, 1531574565, 'Punch in at 2018-07-14 09:22 AM'),
(76, '1', '2018-07-14', 0, 1531603460, 'Punch Out at 2018-07-14 05:24 PM'),
(77, '1', '2018-07-16', 1, 1531747234, 'Punch in at 2018-07-16 09:20 AM'),
(78, '1', '2018-07-16', 1, 1531779473, 'Punch in at 2018-07-16 06:17 PM'),
(79, '1', '2018-07-16', 1, 1531779650, 'Punch in at 2018-07-16 06:20 PM'),
(80, '1', '2018-07-16', 1, 1531779844, 'Punch in at 2018-07-16 06:24 PM'),
(82, '2', '2018-07-17', 1, 1531833176, 'Punch in at 2018-07-17 09:12 AM'),
(83, '1', '2018-07-17', 0, 1531866436, 'Punch Out at 2018-07-17 06:27 PM'),
(84, '1', '2018-07-18', 1, 1531919382, 'Punch in at 2018-07-18 09:09 AM'),
(85, '1', '2018-07-20', 1, 1532092365, 'Punch in at 2018-07-20 09:12 AM'),
(86, '1', '2018-07-20', 0, 1532100490, 'Punch Out at 2018-07-20 11:28 AM'),
(87, '1', '2018-07-21', 1, 1532178667, 'Punch in at 2018-07-21 09:11 AM'),
(88, '1', '2018-07-23', 1, 1532351720, 'Punch in at 2018-07-23 09:15 AM'),
(89, '1', '2018-07-23', 2, 1532381599, 'Break started at 2018-07-23 05:33 PM'),
(90, '1', '2018-07-23', 3, 1532382294, 'Break ended at 2018-07-23 05:44 PM'),
(91, '1', '2018-07-23', 0, 1532382397, 'Punch Out at 2018-07-23 05:46 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_allowance`
--
ALTER TABLE `employee_allowance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_breaks`
--
ALTER TABLE `employee_breaks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expected_shifts`
--
ALTER TABLE `expected_shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslip`
--
ALTER TABLE `payslip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process_list`
--
ALTER TABLE `process_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_leave`
--
ALTER TABLE `request_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_overtime`
--
ALTER TABLE `request_overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_sickleaves`
--
ALTER TABLE `request_sickleaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `summary`
--
ALTER TABLE `summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `working_shift`
--
ALTER TABLE `working_shift`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_allowance`
--
ALTER TABLE `employee_allowance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_breaks`
--
ALTER TABLE `employee_breaks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `expected_shifts`
--
ALTER TABLE `expected_shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `payslip`
--
ALTER TABLE `payslip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `process_list`
--
ALTER TABLE `process_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_leave`
--
ALTER TABLE `request_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_overtime`
--
ALTER TABLE `request_overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_sickleaves`
--
ALTER TABLE `request_sickleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `summary`
--
ALTER TABLE `summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `working_shift`
--
ALTER TABLE `working_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
