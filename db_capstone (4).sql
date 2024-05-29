-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 02:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_capstone`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `display_employee`
-- (See below for the actual view)
--
CREATE TABLE `display_employee` (
`employee_id` int(11)
,`employee_number` int(11)
,`full_name` varchar(511)
,`date_of_birth` date
,`date_hired` date
,`contact_no` varchar(255)
,`email_address` varchar(255)
,`employee_type` varchar(255)
,`position` varchar(255)
,`part_time` tinyint(1)
,`department_id` int(11)
,`position_id` int(11)
,`department` varchar(255)
,`department_name` varchar(255)
,`department_status` enum('Active','Inactive')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `display_offset`
-- (See below for the actual view)
--
CREATE TABLE `display_offset` (
`employee_id` int(11)
,`employee_number` int(11)
,`full_name` varchar(511)
,`offset_id` int(11)
,`total_offset` int(11)
,`offset_contents_id` int(11)
,`used_offset` int(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contribution_pag_ibig`
--

CREATE TABLE `tbl_contribution_pag_ibig` (
  `pag_ibig_id` int(11) NOT NULL,
  `contribution_name` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contribution_pag_ibig`
--

INSERT INTO `tbl_contribution_pag_ibig` (`pag_ibig_id`, `contribution_name`, `date_created`, `status`) VALUES
(1, 'Pag-Ibig', '2024-05-26', 'Inactive'),
(2, 'Pag-Ibig', '2024-05-26', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contribution_pag_ibig_contents`
--

CREATE TABLE `tbl_contribution_pag_ibig_contents` (
  `pag_ibig_contents_id` int(11) NOT NULL,
  `pag_ibig_id` int(11) NOT NULL,
  `fund_salary` int(11) NOT NULL,
  `empyloyee_percentage` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contribution_pag_ibig_contents`
--

INSERT INTO `tbl_contribution_pag_ibig_contents` (`pag_ibig_contents_id`, `pag_ibig_id`, `fund_salary`, `empyloyee_percentage`) VALUES
(1, 1, 23, 23.00),
(2, 2, 23, 23.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contribution_sss`
--

CREATE TABLE `tbl_contribution_sss` (
  `sss_id` int(11) NOT NULL,
  `contribution_name` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contribution_sss`
--

INSERT INTO `tbl_contribution_sss` (`sss_id`, `contribution_name`, `date_created`, `status`) VALUES
(1, 'SSS', '2024-05-21', 'Inactive'),
(2, 'SSS', '2024-05-21', 'Inactive'),
(3, 'SSS', '2024-05-21', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contribution_sss_contents`
--

CREATE TABLE `tbl_contribution_sss_contents` (
  `sss_contents_id` int(11) NOT NULL,
  `sss_id` int(11) NOT NULL,
  `minimum_price` decimal(10,2) NOT NULL,
  `maximum_price` decimal(10,2) NOT NULL,
  `employee_compensation` int(11) NOT NULL,
  `sss_rate` decimal(10,3) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contribution_sss_contents`
--

INSERT INTO `tbl_contribution_sss_contents` (`sss_contents_id`, `sss_id`, `minimum_price`, `maximum_price`, `employee_compensation`, `sss_rate`, `total`) VALUES
(1, 1, 4250.00, 4749.99, 4000, 0.045, 202.50),
(2, 2, 4250.00, 4749.99, 4000, 0.045, 202.50),
(3, 3, 5250.00, 5749.99, 5000, 0.045, 247.50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employee_id` int(11) NOT NULL,
  `employee_number` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `date_hired` date NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `brangay` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`employee_id`, `employee_number`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `gender`, `civil_status`, `date_hired`, `status`, `contact_no`, `email_address`, `province`, `brangay`, `street`) VALUES
(1, 2147483647, 'Juan Miguel', 'Blanco', 'Omambac', '2024-05-22', 'Male', 'Single', '2024-05-22', 'Active', '1222222222222', '1222222222222@gmail.com', '1222222222222', '1222222222222', '1222222222222'),
(2, 3, 'Patricia', 'Pocare', 'Rafael', '0000-00-00', 'Male', 'Single', '2024-05-22', 'Active', '1222222222222', '1222222222222@gmail.com', '1222222222222', '1222222222222', '1222222222222'),
(3, 23, 'sherwin', '23', 'piodos', '2024-05-23', 'Male', 'Single', '2024-05-22', 'Active', '09236525998', '1222222222222@gmail.com', '23', '23', '23'),
(5, 123, '123', '123', '123', '2024-05-29', 'Female', 'Single', '2024-05-21', 'Active', '123', '12312@gmail.com', '123', '123', '12'),
(6, 23, 'Juan Miguel', 'Blanco', 'Omambac', '2024-05-22', 'Male', 'Single', '2024-05-02', 'Active', '1222222222222', '1222222222222@gmail.com', '1222222222222', '1222222222222', '1222222222222'),
(7, 2147483647, 'a', 'a', 'a', '2024-05-30', 'Male', 'Single', '2024-05-13', 'Active', '32', '1222222222222@gmail.com', '1222222222222', '1222222222222', 'part time full time'),
(8, 123, '123', '213', '123', '2024-05-11', 'Male', 'Single', '2024-05-16', 'Active', '123', '123123@gmail.com', '123', '123', '123'),
(9, 123, '123', '213', '123', '2024-05-11', 'Male', 'Single', '2024-05-16', 'Active', '123', '123123@gmail.com', '123', '123', '123'),
(10, 2147483647, 'RONIEL', '', 'ALCORDO', '2024-05-28', 'Female', 'Single', '2024-05-29', 'Active', '1222222222222', '123333333333@gmail.com', '12312', '123', '1222222222222'),
(11, 2000374996, 'ADORACION', '', 'ANASARIAS', '2024-05-23', 'Male', 'Single', '2024-05-15', 'Active', '1222222222222', '12312@gmail.com', '123333333333', 'part time full time', '123333333333'),
(12, 2000372478, 'JOSHUA', '', 'BABAN', '2024-05-21', 'Male', 'Married', '2024-05-08', 'Active', '1222222222222', '1222222222222@gmail.com', '1222222222222', '1222222222222', '123333333333'),
(13, 2147483647, 'BEVERLY', '', 'BACULI', '2024-05-14', 'Male', 'Single', '2024-05-22', 'Active', '1222222222222', '1222222222222@gmail.com', '1222222222222', '1222222222222', 'master'),
(14, 2147483647, 'BEVERLY', '', 'BACULI', '2024-05-16', 'Male', 'Married', '2024-05-16', 'Active', '', '', '1222222222222', '1222222222222', ''),
(15, 2147483647, 'LECILDA', '', 'BELACHO', '2024-05-20', 'Female', 'Single', '2024-05-15', 'Active', '', '', '32', 'part time full time', ''),
(16, 2000372473, 'YELLA MAE', '', 'BORINAGA', '2024-05-23', 'Female', 'Married', '2024-05-21', 'Active', '', '', '1222222222222', 'part time full time', ''),
(17, 2000372472, 'TONI ROSE', '', 'SEBLOS', '2024-05-17', 'Male', 'Single', '2024-05-16', 'Active', '', '', '1222222222222', '1222222222222', 'part time full time');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_contribution`
--

CREATE TABLE `tbl_employee_contribution` (
  `contribution_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `employee_pag_ibig_no` varchar(255) DEFAULT NULL,
  `employee_SSS_no` varchar(255) DEFAULT NULL,
  `employee_phil_health_no` varchar(255) DEFAULT NULL,
  `employee_tin_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_contribution`
--

INSERT INTO `tbl_employee_contribution` (`contribution_id`, `employee_id`, `employee_pag_ibig_no`, `employee_SSS_no`, `employee_phil_health_no`, `employee_tin_no`) VALUES
(1, 1, '123333333333', '123333333333', '', '123333333333'),
(2, 2, '1222222222222', '1222222222222', '1222222222222', '1222222222222'),
(3, 3, '23', '23', '23', '23'),
(5, 5, '123', '123', '123', '123'),
(6, 6, '1222222222222', '1222222222222', '1222222222222', '1222222222222'),
(7, 7, '3232', '2323', '2323', '2323'),
(8, 8, '123', '123', '123', '123'),
(9, 9, '123', '123', '123', '123'),
(10, 10, '123333333333', '123333333333', '1222222222222', '123333333333'),
(11, 11, '1222222222222', 'part time full time', '123333333333', 'part time full time'),
(12, 12, '123', '12222222222221222222222222', '', '23'),
(13, 13, 'part time full time', 'part time full time', '12312', 'part time full time'),
(14, 14, '', '', '', ''),
(15, 15, '', '', '', ''),
(16, 16, '', '', '', ''),
(17, 17, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_contribution_deductions`
--

CREATE TABLE `tbl_employee_contribution_deductions` (
  `contribution_deductions_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `pag_ibig_id` int(11) DEFAULT NULL,
  `sss_id` int(11) DEFAULT NULL,
  `sss_loan_id` int(11) DEFAULT NULL,
  `pag_ibig_loan_id` int(11) DEFAULT NULL,
  `deductions_jam_lock_id` int(11) DEFAULT NULL,
  `deductions_proware_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_contribution_deductions`
--

INSERT INTO `tbl_employee_contribution_deductions` (`contribution_deductions_id`, `employee_id`, `pag_ibig_id`, `sss_id`, `sss_loan_id`, `pag_ibig_loan_id`, `deductions_jam_lock_id`, `deductions_proware_id`) VALUES
(1, 2, 2, 3, 1, 1, 1, 1),
(2, 1, NULL, NULL, NULL, NULL, 2, 2),
(3, 5, NULL, NULL, NULL, NULL, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_deductions_jam_lock`
--

CREATE TABLE `tbl_employee_deductions_jam_lock` (
  `deductions_jam_lock_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_deductions_jam_lock`
--

INSERT INTO `tbl_employee_deductions_jam_lock` (`deductions_jam_lock_id`, `employee_id`) VALUES
(2, 1),
(1, 2),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_deductions_jam_lock_content`
--

CREATE TABLE `tbl_employee_deductions_jam_lock_content` (
  `deductions_jam_lock_content_id` int(11) NOT NULL,
  `deductions_jam_lock_id` int(11) NOT NULL,
  `monthly_due` decimal(10,0) NOT NULL,
  `deduction_type` enum('Monthly','Bi-Monthly') NOT NULL,
  `no_of_month` int(11) NOT NULL,
  `payment` int(100) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_deductions_jam_lock_content`
--

INSERT INTO `tbl_employee_deductions_jam_lock_content` (`deductions_jam_lock_content_id`, `deductions_jam_lock_id`, `monthly_due`, `deduction_type`, `no_of_month`, `payment`, `date_from`, `date_to`, `status`) VALUES
(1, 1, 23, '', 23, 23, '2024-05-21', '2026-04-21', 'Active'),
(2, 2, 0, 'Monthly', 0, 0, '0000-00-00', '0000-00-00', 'Active'),
(3, 3, 23, '', 23, 23, '2024-05-23', '2026-04-23', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_deductions_pag_ibig_loan`
--

CREATE TABLE `tbl_employee_deductions_pag_ibig_loan` (
  `pag_ibig_loan_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_deductions_pag_ibig_loan`
--

INSERT INTO `tbl_employee_deductions_pag_ibig_loan` (`pag_ibig_loan_id`, `employee_id`) VALUES
(2, 1),
(1, 2),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_deductions_pag_ibig_loan_content`
--

CREATE TABLE `tbl_employee_deductions_pag_ibig_loan_content` (
  `deductions_pag_ibig_loan_content_id` int(11) NOT NULL,
  `pag_ibig_loan_id` int(11) NOT NULL,
  `monthly_due` decimal(10,2) DEFAULT NULL,
  `deduction_type` enum('Monthly','Bi-Monthly') DEFAULT NULL,
  `no_of_month` int(11) DEFAULT NULL,
  `payment` int(100) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_deductions_pag_ibig_loan_content`
--

INSERT INTO `tbl_employee_deductions_pag_ibig_loan_content` (`deductions_pag_ibig_loan_content_id`, `pag_ibig_loan_id`, `monthly_due`, `deduction_type`, `no_of_month`, `payment`, `date_from`, `date_to`, `status`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_deductions_proware`
--

CREATE TABLE `tbl_employee_deductions_proware` (
  `deductions_proware_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_deductions_proware`
--

INSERT INTO `tbl_employee_deductions_proware` (`deductions_proware_id`, `employee_id`) VALUES
(2, 1),
(1, 2),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_deductions_proware_content`
--

CREATE TABLE `tbl_employee_deductions_proware_content` (
  `deductions_proware_content_id` int(11) NOT NULL,
  `deductions_proware_id` int(11) DEFAULT NULL,
  `monthly_due` decimal(10,2) DEFAULT NULL,
  `deduction_type` enum('Monthly','Bi-Monthly') DEFAULT NULL,
  `no_of_month` int(11) DEFAULT NULL,
  `payment` int(100) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_deductions_proware_content`
--

INSERT INTO `tbl_employee_deductions_proware_content` (`deductions_proware_content_id`, `deductions_proware_id`, `monthly_due`, `deduction_type`, `no_of_month`, `payment`, `date_from`, `date_to`, `status`) VALUES
(1, 1, 233.00, 'Bi-Monthly', 23, 23, '2024-05-21', '2026-04-21', 'Active'),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 23.00, 'Monthly', 23, 23, '2024-05-23', '2026-04-23', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_deductions_sss_loan`
--

CREATE TABLE `tbl_employee_deductions_sss_loan` (
  `sss_loan_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_deductions_sss_loan`
--

INSERT INTO `tbl_employee_deductions_sss_loan` (`sss_loan_id`, `employee_id`) VALUES
(2, 1),
(1, 2),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_deductions_sss_loan_content`
--

CREATE TABLE `tbl_employee_deductions_sss_loan_content` (
  `deductions_SSS_loan_content_id` int(11) NOT NULL,
  `sss_loan_id` int(11) DEFAULT NULL,
  `monthly_due` decimal(10,2) DEFAULT NULL,
  `deduction_type` enum('Monthly','Bi-Monthly') DEFAULT NULL,
  `no_of_month` int(11) DEFAULT NULL,
  `payment` int(100) DEFAULT NULL,
  `date_from` date NOT NULL,
  `date_to` date DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_deductions_sss_loan_content`
--

INSERT INTO `tbl_employee_deductions_sss_loan_content` (`deductions_SSS_loan_content_id`, `sss_loan_id`, `monthly_due`, `deduction_type`, `no_of_month`, `payment`, `date_from`, `date_to`, `status`) VALUES
(1, 1, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL),
(2, 2, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL),
(3, 3, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_department`
--

CREATE TABLE `tbl_employee_department` (
  `department_id` int(11) NOT NULL,
  `employee_type_id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_department`
--

INSERT INTO `tbl_employee_department` (`department_id`, `employee_type_id`, `department`, `department_name`, `status`) VALUES
(1, 2, 'IT', 'Information Technology', 'Active'),
(2, 2, 'HM', 'Hotel Management', 'Active'),
(3, 2, 'GE', 'General Education', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_details`
--

CREATE TABLE `tbl_employee_details` (
  `details_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `employee_type_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `part_time` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_details`
--

INSERT INTO `tbl_employee_details` (`details_id`, `employee_id`, `employee_type_id`, `position_id`, `department_id`, `part_time`) VALUES
(2, 2, 1, 2, NULL, 0),
(3, 3, 1, 6, NULL, 0),
(5, 5, 1, 1, NULL, 0),
(6, 6, 2, 6, 1, 0),
(7, 7, 2, 4, 2, 1),
(8, 8, 1, 1, NULL, 1),
(9, 9, 1, 1, NULL, 1),
(10, 10, 1, 1, NULL, 1),
(11, 11, 1, 1, NULL, 1),
(12, 12, 2, 5, 1, 0),
(13, 13, 1, 3, NULL, 1),
(14, 14, 1, 2, NULL, 1),
(15, 15, 1, 3, NULL, 1),
(16, 16, 1, 3, NULL, 0),
(17, 17, 1, 2, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_educational_background_college`
--

CREATE TABLE `tbl_employee_educational_background_college` (
  `college_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `college_name_of_school` varchar(255) DEFAULT NULL,
  `college_degree_course` varchar(255) DEFAULT NULL,
  `college_year_graduated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_educational_background_college`
--

INSERT INTO `tbl_employee_educational_background_college` (`college_id`, `employee_id`, `college_name_of_school`, `college_degree_course`, `college_year_graduated`) VALUES
(1, 1, '123333333333', '123333333333', '0000-00-00'),
(2, 2, '1222222222222', '1222222222222', '0000-00-00'),
(3, 3, '23', '23', '0000-00-00'),
(4, 5, NULL, NULL, NULL),
(5, 6, NULL, NULL, NULL),
(6, 7, NULL, NULL, NULL),
(7, 8, NULL, NULL, NULL),
(8, 9, NULL, NULL, NULL),
(9, 10, NULL, NULL, NULL),
(10, 11, NULL, NULL, NULL),
(11, 12, NULL, NULL, NULL),
(12, 13, NULL, NULL, NULL),
(13, 14, NULL, NULL, NULL),
(14, 15, NULL, NULL, NULL),
(15, 16, NULL, NULL, NULL),
(16, 17, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_educational_background_doctoral`
--

CREATE TABLE `tbl_employee_educational_background_doctoral` (
  `doctoral_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `doctoral_name_of_school` varchar(255) DEFAULT NULL,
  `doctoral_degree_course` varchar(255) DEFAULT NULL,
  `doctoral_year_graduated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_educational_background_doctoral`
--

INSERT INTO `tbl_employee_educational_background_doctoral` (`doctoral_id`, `employee_id`, `doctoral_name_of_school`, `doctoral_degree_course`, `doctoral_year_graduated`) VALUES
(1, 1, '123333333333', '123333333333', '0000-00-00'),
(2, 2, '1222222222222', '1222222222222', '0000-00-00'),
(3, 3, '23', '23', '0000-00-00'),
(4, 5, NULL, NULL, NULL),
(5, 6, NULL, NULL, NULL),
(6, 7, NULL, NULL, NULL),
(7, 8, NULL, NULL, NULL),
(8, 9, NULL, NULL, NULL),
(9, 10, NULL, NULL, NULL),
(10, 11, NULL, NULL, NULL),
(11, 12, NULL, NULL, NULL),
(12, 13, NULL, NULL, NULL),
(13, 14, NULL, NULL, NULL),
(14, 15, NULL, NULL, NULL),
(15, 16, NULL, NULL, NULL),
(16, 17, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_educational_background_graduate`
--

CREATE TABLE `tbl_employee_educational_background_graduate` (
  `graduate_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `graduate_name_of_school` varchar(255) DEFAULT NULL,
  `graduate_degree_course` varchar(255) DEFAULT NULL,
  `graduate_year_graduated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_educational_background_graduate`
--

INSERT INTO `tbl_employee_educational_background_graduate` (`graduate_id`, `employee_id`, `graduate_name_of_school`, `graduate_degree_course`, `graduate_year_graduated`) VALUES
(1, 1, '123333333333', '123333333333', '0000-00-00'),
(2, 2, '1222222222222', '1222222222222', '0000-00-00'),
(3, 3, '23', '23', '0000-00-00'),
(4, 5, NULL, NULL, NULL),
(5, 6, NULL, NULL, NULL),
(6, 7, NULL, NULL, NULL),
(7, 8, NULL, NULL, NULL),
(8, 9, NULL, NULL, NULL),
(9, 10, NULL, NULL, NULL),
(10, 11, NULL, NULL, NULL),
(11, 12, NULL, NULL, NULL),
(12, 13, NULL, NULL, NULL),
(13, 14, NULL, NULL, NULL),
(14, 15, NULL, NULL, NULL),
(15, 16, NULL, NULL, NULL),
(16, 17, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_offset`
--

CREATE TABLE `tbl_employee_offset` (
  `offset_id` int(11) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `total_offset` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_position`
--

CREATE TABLE `tbl_employee_position` (
  `position_id` int(11) NOT NULL,
  `employee_type_id` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_position`
--

INSERT INTO `tbl_employee_position` (`position_id`, `employee_type_id`, `position`, `status`) VALUES
(1, 1, 'Cashier', 'Active'),
(2, 1, 'Admission Officer', 'Active'),
(3, 1, 'Utility', 'Active'),
(4, 2, 'Part - Time', 'Active'),
(5, 2, 'Part - Time Full Load', 'Active'),
(6, 2, 'Program Head', 'Active'),
(28, 1, '34', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_process_biometrics`
--

CREATE TABLE `tbl_employee_process_biometrics` (
  `process_biometrics_id` int(11) NOT NULL,
  `biometric_cut_off` char(255) NOT NULL,
  `date_created` date NOT NULL,
  `status` enum('To be Process','Approve') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_process_biometrics_contents`
--

CREATE TABLE `tbl_employee_process_biometrics_contents` (
  `process_biometrics_content_id` int(11) NOT NULL,
  `process_biometrics_id` int(11) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `total_tardy` decimal(10,2) DEFAULT NULL,
  `overtime` decimal(10,2) DEFAULT NULL,
  `total_hrs_work` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_process_biometrics_contents`
--

INSERT INTO `tbl_employee_process_biometrics_contents` (`process_biometrics_content_id`, `process_biometrics_id`, `employee_id`, `total_tardy`, `overtime`, `total_hrs_work`) VALUES
(1, NULL, 1, 14.25, 23.00, 104.00),
(2, NULL, 2, 1.25, 0.00, 104.00),
(3, NULL, 1, 14.25, 23.00, 104.00),
(4, NULL, 2, 1.25, 0.00, 104.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_salary`
--

CREATE TABLE `tbl_employee_salary` (
  `salary_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `effective_date` date NOT NULL,
  `salary` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_salary`
--

INSERT INTO `tbl_employee_salary` (`salary_id`, `employee_id`, `effective_date`, `salary`) VALUES
(1, 2, '2024-05-15', 4250.00),
(2, 1, '2024-05-15', 1000.00),
(3, 5, '2024-05-14', 23333.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_salary_content`
--

CREATE TABLE `tbl_employee_salary_content` (
  `salary_content_id` int(11) NOT NULL,
  `salary_id` int(11) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_schedule`
--

CREATE TABLE `tbl_employee_schedule` (
  `schedule_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `effective_date_from` date NOT NULL,
  `effective_date_to` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_schedule_contents`
--

CREATE TABLE `tbl_employee_schedule_contents` (
  `schedule_contents_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `day_of_week` enum('Mon','Tue','Wed','TH','Fri','Sat') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_type`
--

CREATE TABLE `tbl_employee_type` (
  `employee_type_id` int(11) NOT NULL,
  `employee_type` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_type`
--

INSERT INTO `tbl_employee_type` (`employee_type_id`, `employee_type`, `status`) VALUES
(1, 'Staff', 'Active'),
(2, 'Faculty', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emplyoee_bank_details`
--

CREATE TABLE `tbl_emplyoee_bank_details` (
  `bank_details_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_emplyoee_bank_details`
--

INSERT INTO `tbl_emplyoee_bank_details` (`bank_details_id`, `employee_id`, `account_no`, `account_name`) VALUES
(1, 1, '123333333333', '123333333333'),
(2, 2, '1222222222222', '1222222222222'),
(3, 3, '23', '23'),
(5, 5, '123', '123'),
(6, 6, '1222222222222', '1222222222222'),
(7, 7, '2323', '2323'),
(8, 8, '123', '123'),
(9, 9, '123', '123'),
(10, 10, 'part time full time', ''),
(11, 11, '123', '32'),
(12, 12, 'part time full time', '32'),
(13, 13, '123', '1222222222222'),
(14, 14, '', ''),
(15, 15, '', ''),
(16, 16, '', ''),
(17, 17, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holiday`
--

CREATE TABLE `tbl_holiday` (
  `holiday_id` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date DEFAULT NULL,
  `type_of_holiday` enum('Regular Holiday','Special Non-working') NOT NULL,
  `name_of_holiday` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_holiday`
--

INSERT INTO `tbl_holiday` (`holiday_id`, `date_from`, `date_to`, `type_of_holiday`, `name_of_holiday`, `status`) VALUES
(1, '2024-05-24', '0000-00-00', 'Regular Holiday', 'Regular Holiday', 'Active'),
(2, '2024-05-24', '0000-00-00', 'Regular Holiday', 'Regular Holiday', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_credits`
--

CREATE TABLE `tbl_leave_credits` (
  `leave_credits_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave_credits`
--

INSERT INTO `tbl_leave_credits` (`leave_credits_id`, `employee_id`) VALUES
(2, 3),
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_credits_content`
--

CREATE TABLE `tbl_leave_credits_content` (
  `leave_credits_content_id` int(11) NOT NULL,
  `leave_credits_id` int(11) NOT NULL,
  `sick_leave` int(11) DEFAULT NULL,
  `vacation_leave` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave_credits_content`
--

INSERT INTO `tbl_leave_credits_content` (`leave_credits_content_id`, `leave_credits_id`, `sick_leave`, `vacation_leave`) VALUES
(1, 1, 29, 19),
(7, 2, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offset`
--

CREATE TABLE `tbl_offset` (
  `offset_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `total_offset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_offset`
--

INSERT INTO `tbl_offset` (`offset_id`, `employee_id`, `total_offset`) VALUES
(1, 7, 145),
(2, 6, 223),
(3, 12, 72);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offset_contents`
--

CREATE TABLE `tbl_offset_contents` (
  `offset_contents_id` int(11) NOT NULL,
  `offset_id` int(11) DEFAULT NULL,
  `used_offset` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_offset_contents`
--

INSERT INTO `tbl_offset_contents` (`offset_contents_id`, `offset_id`, `used_offset`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tardiness`
--

CREATE TABLE `tbl_tardiness` (
  `tardiness_id` int(11) NOT NULL,
  `tardiness` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tardiness`
--

INSERT INTO `tbl_tardiness` (`tardiness_id`, `tardiness`, `unit`, `status`) VALUES
(1, 34, '34', 'Active'),
(2, 34, '34', 'Active'),
(3, 34, '34', 'Active'),
(4, 34, '34', 'Active'),
(5, 34, '34', 'Active'),
(6, 34, '34', 'Active'),
(7, 34, '34', 'Active'),
(8, 34, '34', 'Active'),
(9, 34, '34', 'Active'),
(10, 34, '34', 'Active'),
(11, 34, '34', 'Active'),
(12, 34, '34', 'Active'),
(13, 34, '34', 'Active'),
(14, 34, '34', 'Active'),
(15, 34, '34', 'Active'),
(16, 34, '34', 'Active'),
(17, 34, '34', 'Active'),
(18, 34, '34', 'Active'),
(19, 34, '34', 'Active'),
(20, 34, '34', 'Active'),
(21, 34, '34', 'Active'),
(22, 34, '34', 'Active'),
(23, 22, '213', 'Active'),
(24, 22, '213', 'Active'),
(25, 22, '213', 'Active'),
(26, 22, '213', 'Active'),
(27, 22, '213', 'Active'),
(28, 23, '23', 'Active'),
(29, 23, '23', 'Active'),
(30, 23, '23', 'Active'),
(31, 12, '12', 'Active'),
(32, 12, '12', 'Active'),
(33, 12, '12', 'Active'),
(34, 12, '12', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_travel`
--

CREATE TABLE `tbl_travel` (
  `travel_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `travel_date_from` date NOT NULL,
  `tavel_date_to` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `reason` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_travel`
--

INSERT INTO `tbl_travel` (`travel_id`, `employee_id`, `travel_date_from`, `tavel_date_to`, `time_from`, `time_to`, `reason`, `status`) VALUES
(1, 1, '2024-05-15', '2024-05-22', '11:11:00', '04:07:00', 'sdfsadf', 'Active'),
(2, 1, '2024-05-15', '2024-05-22', '11:11:00', '04:07:00', 'sdfsadf', 'Active'),
(3, 1, '2024-05-15', '2024-05-22', '11:11:00', '04:07:00', 'sdfsadf', 'Active'),
(4, 1, '2024-05-15', '2024-05-22', '11:11:00', '04:07:00', 'sdfsadf', 'Active'),
(5, 1, '2024-05-15', '2024-05-22', '11:11:00', '04:07:00', 'sdfsadf', 'Active'),
(6, 1, '2024-05-15', '2024-05-22', '11:11:00', '04:07:00', 'sdfsadf', 'Active'),
(7, 3, '2024-05-23', '2024-08-17', '14:59:00', '13:05:00', 'travel', 'Active'),
(8, 3, '2024-05-23', '2024-08-17', '14:59:00', '13:05:00', 'travel', 'Active'),
(9, 3, '2024-05-23', '2024-08-17', '14:59:00', '13:05:00', 'travel', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `user_id` int(11) NOT NULL,
  `Employee_ID` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Userlevel` varchar(20) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`user_id`, `Employee_ID`, `Password`, `Userlevel`, `Status`) VALUES
(2, 'SchoolAdmin', 'SchoolAdmin', 'School Admin', 'Active'),
(3, 'master', 'master', 'Payroll Master', 'Active'),
(4, 'Faculty', 'Faculty', 'Faculty', 'Active'),
(6, 'PayrollMaster', 'PayrollMaster', 'Payroll Master', 'Active'),
(7, 'Accounting', 'Accounting', 'Accounting', 'Active');

-- --------------------------------------------------------

--
-- Structure for view `display_employee`
--
DROP TABLE IF EXISTS `display_employee`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `display_employee`  AS SELECT `e`.`employee_id` AS `employee_id`, `e`.`employee_number` AS `employee_number`, concat(`e`.`first_name`,' ',`e`.`last_name`) AS `full_name`, `e`.`date_of_birth` AS `date_of_birth`, `e`.`date_hired` AS `date_hired`, `e`.`contact_no` AS `contact_no`, `e`.`email_address` AS `email_address`, `et`.`employee_type` AS `employee_type`, `ep`.`position` AS `position`, `ed`.`part_time` AS `part_time`, `ed`.`department_id` AS `department_id`, `ed`.`position_id` AS `position_id`, `d`.`department` AS `department`, `d`.`department_name` AS `department_name`, `d`.`status` AS `department_status` FROM ((((`tbl_employee` `e` left join `tbl_employee_details` `ed` on(`e`.`employee_id` = `ed`.`employee_id`)) left join `tbl_employee_type` `et` on(`ed`.`employee_type_id` = `et`.`employee_type_id`)) left join `tbl_employee_position` `ep` on(`ed`.`position_id` = `ep`.`position_id`)) left join `tbl_employee_department` `d` on(`ed`.`department_id` = `d`.`department_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `display_offset`
--
DROP TABLE IF EXISTS `display_offset`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `display_offset`  AS SELECT `e`.`employee_id` AS `employee_id`, `e`.`employee_number` AS `employee_number`, concat(`e`.`first_name`,' ',`e`.`last_name`) AS `full_name`, `of`.`offset_id` AS `offset_id`, `of`.`total_offset` AS `total_offset`, `ofc`.`offset_contents_id` AS `offset_contents_id`, `ofc`.`used_offset` AS `used_offset` FROM ((`tbl_offset` `of` left join `tbl_employee` `e` on(`e`.`employee_id` = `of`.`employee_id`)) left join `tbl_offset_contents` `ofc` on(`of`.`offset_id` = `ofc`.`offset_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_contribution_pag_ibig`
--
ALTER TABLE `tbl_contribution_pag_ibig`
  ADD PRIMARY KEY (`pag_ibig_id`);

--
-- Indexes for table `tbl_contribution_pag_ibig_contents`
--
ALTER TABLE `tbl_contribution_pag_ibig_contents`
  ADD PRIMARY KEY (`pag_ibig_contents_id`),
  ADD KEY `pag_ibig_id` (`pag_ibig_id`);

--
-- Indexes for table `tbl_contribution_sss`
--
ALTER TABLE `tbl_contribution_sss`
  ADD PRIMARY KEY (`sss_id`);

--
-- Indexes for table `tbl_contribution_sss_contents`
--
ALTER TABLE `tbl_contribution_sss_contents`
  ADD PRIMARY KEY (`sss_contents_id`),
  ADD KEY `sss_id` (`sss_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tbl_employee_contribution`
--
ALTER TABLE `tbl_employee_contribution`
  ADD PRIMARY KEY (`contribution_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_employee_contribution_deductions`
--
ALTER TABLE `tbl_employee_contribution_deductions`
  ADD PRIMARY KEY (`contribution_deductions_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `sss_id` (`sss_id`),
  ADD KEY `fk_employee_deductions_pag_ibig` (`pag_ibig_id`),
  ADD KEY `deductions_jam_lock_id` (`deductions_jam_lock_id`),
  ADD KEY `pag_ibig_loan_id` (`pag_ibig_loan_id`),
  ADD KEY `tbl_employee_contribution_deductions_ibfk_6` (`sss_loan_id`),
  ADD KEY `deductions_proware_id` (`deductions_proware_id`);

--
-- Indexes for table `tbl_employee_deductions_jam_lock`
--
ALTER TABLE `tbl_employee_deductions_jam_lock`
  ADD PRIMARY KEY (`deductions_jam_lock_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_employee_deductions_jam_lock_content`
--
ALTER TABLE `tbl_employee_deductions_jam_lock_content`
  ADD PRIMARY KEY (`deductions_jam_lock_content_id`),
  ADD KEY `deductions_jam_lock_id` (`deductions_jam_lock_id`);

--
-- Indexes for table `tbl_employee_deductions_pag_ibig_loan`
--
ALTER TABLE `tbl_employee_deductions_pag_ibig_loan`
  ADD PRIMARY KEY (`pag_ibig_loan_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_employee_deductions_pag_ibig_loan_content`
--
ALTER TABLE `tbl_employee_deductions_pag_ibig_loan_content`
  ADD PRIMARY KEY (`deductions_pag_ibig_loan_content_id`),
  ADD KEY `pag_ibig_loan_id` (`pag_ibig_loan_id`);

--
-- Indexes for table `tbl_employee_deductions_proware`
--
ALTER TABLE `tbl_employee_deductions_proware`
  ADD PRIMARY KEY (`deductions_proware_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_employee_deductions_proware_content`
--
ALTER TABLE `tbl_employee_deductions_proware_content`
  ADD PRIMARY KEY (`deductions_proware_content_id`),
  ADD KEY `deductions_proware_id` (`deductions_proware_id`);

--
-- Indexes for table `tbl_employee_deductions_sss_loan`
--
ALTER TABLE `tbl_employee_deductions_sss_loan`
  ADD PRIMARY KEY (`sss_loan_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_employee_deductions_sss_loan_content`
--
ALTER TABLE `tbl_employee_deductions_sss_loan_content`
  ADD PRIMARY KEY (`deductions_SSS_loan_content_id`),
  ADD KEY `sss_loan_id` (`sss_loan_id`);

--
-- Indexes for table `tbl_employee_department`
--
ALTER TABLE `tbl_employee_department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `emplyoee_type_id` (`employee_type_id`);

--
-- Indexes for table `tbl_employee_details`
--
ALTER TABLE `tbl_employee_details`
  ADD PRIMARY KEY (`details_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `employee_type_id` (`employee_type_id`),
  ADD KEY `position_id` (`position_id`),
  ADD KEY `tbl_employee_details_ibfk_4` (`department_id`);

--
-- Indexes for table `tbl_employee_educational_background_college`
--
ALTER TABLE `tbl_employee_educational_background_college`
  ADD PRIMARY KEY (`college_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_employee_educational_background_doctoral`
--
ALTER TABLE `tbl_employee_educational_background_doctoral`
  ADD PRIMARY KEY (`doctoral_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_employee_educational_background_graduate`
--
ALTER TABLE `tbl_employee_educational_background_graduate`
  ADD PRIMARY KEY (`graduate_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_employee_offset`
--
ALTER TABLE `tbl_employee_offset`
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_employee_position`
--
ALTER TABLE `tbl_employee_position`
  ADD PRIMARY KEY (`position_id`),
  ADD KEY `emplyoee_type_id` (`employee_type_id`);

--
-- Indexes for table `tbl_employee_process_biometrics`
--
ALTER TABLE `tbl_employee_process_biometrics`
  ADD PRIMARY KEY (`process_biometrics_id`);

--
-- Indexes for table `tbl_employee_process_biometrics_contents`
--
ALTER TABLE `tbl_employee_process_biometrics_contents`
  ADD PRIMARY KEY (`process_biometrics_content_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `process_biometrics_id` (`process_biometrics_id`);

--
-- Indexes for table `tbl_employee_salary`
--
ALTER TABLE `tbl_employee_salary`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_employee_salary_content`
--
ALTER TABLE `tbl_employee_salary_content`
  ADD PRIMARY KEY (`salary_content_id`),
  ADD KEY `salary_id` (`salary_id`);

--
-- Indexes for table `tbl_employee_schedule`
--
ALTER TABLE `tbl_employee_schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_employee_schedule_contents`
--
ALTER TABLE `tbl_employee_schedule_contents`
  ADD PRIMARY KEY (`schedule_contents_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `tbl_employee_type`
--
ALTER TABLE `tbl_employee_type`
  ADD PRIMARY KEY (`employee_type_id`);

--
-- Indexes for table `tbl_emplyoee_bank_details`
--
ALTER TABLE `tbl_emplyoee_bank_details`
  ADD PRIMARY KEY (`bank_details_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indexes for table `tbl_leave_credits`
--
ALTER TABLE `tbl_leave_credits`
  ADD PRIMARY KEY (`leave_credits_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_leave_credits_content`
--
ALTER TABLE `tbl_leave_credits_content`
  ADD PRIMARY KEY (`leave_credits_content_id`),
  ADD KEY `leave_creadits_id` (`leave_credits_id`);

--
-- Indexes for table `tbl_offset`
--
ALTER TABLE `tbl_offset`
  ADD PRIMARY KEY (`offset_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_offset_contents`
--
ALTER TABLE `tbl_offset_contents`
  ADD PRIMARY KEY (`offset_contents_id`),
  ADD KEY `offset_id` (`offset_id`);

--
-- Indexes for table `tbl_tardiness`
--
ALTER TABLE `tbl_tardiness`
  ADD PRIMARY KEY (`tardiness_id`);

--
-- Indexes for table `tbl_travel`
--
ALTER TABLE `tbl_travel`
  ADD PRIMARY KEY (`travel_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_contribution_pag_ibig`
--
ALTER TABLE `tbl_contribution_pag_ibig`
  MODIFY `pag_ibig_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_contribution_pag_ibig_contents`
--
ALTER TABLE `tbl_contribution_pag_ibig_contents`
  MODIFY `pag_ibig_contents_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_contribution_sss`
--
ALTER TABLE `tbl_contribution_sss`
  MODIFY `sss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_contribution_sss_contents`
--
ALTER TABLE `tbl_contribution_sss_contents`
  MODIFY `sss_contents_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_employee_contribution`
--
ALTER TABLE `tbl_employee_contribution`
  MODIFY `contribution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_employee_contribution_deductions`
--
ALTER TABLE `tbl_employee_contribution_deductions`
  MODIFY `contribution_deductions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee_deductions_jam_lock`
--
ALTER TABLE `tbl_employee_deductions_jam_lock`
  MODIFY `deductions_jam_lock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee_deductions_jam_lock_content`
--
ALTER TABLE `tbl_employee_deductions_jam_lock_content`
  MODIFY `deductions_jam_lock_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee_deductions_pag_ibig_loan`
--
ALTER TABLE `tbl_employee_deductions_pag_ibig_loan`
  MODIFY `pag_ibig_loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee_deductions_pag_ibig_loan_content`
--
ALTER TABLE `tbl_employee_deductions_pag_ibig_loan_content`
  MODIFY `deductions_pag_ibig_loan_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee_deductions_proware`
--
ALTER TABLE `tbl_employee_deductions_proware`
  MODIFY `deductions_proware_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee_deductions_proware_content`
--
ALTER TABLE `tbl_employee_deductions_proware_content`
  MODIFY `deductions_proware_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee_deductions_sss_loan`
--
ALTER TABLE `tbl_employee_deductions_sss_loan`
  MODIFY `sss_loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee_deductions_sss_loan_content`
--
ALTER TABLE `tbl_employee_deductions_sss_loan_content`
  MODIFY `deductions_SSS_loan_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee_department`
--
ALTER TABLE `tbl_employee_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_employee_details`
--
ALTER TABLE `tbl_employee_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_employee_educational_background_college`
--
ALTER TABLE `tbl_employee_educational_background_college`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_employee_educational_background_doctoral`
--
ALTER TABLE `tbl_employee_educational_background_doctoral`
  MODIFY `doctoral_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_employee_educational_background_graduate`
--
ALTER TABLE `tbl_employee_educational_background_graduate`
  MODIFY `graduate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_employee_position`
--
ALTER TABLE `tbl_employee_position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_employee_process_biometrics`
--
ALTER TABLE `tbl_employee_process_biometrics`
  MODIFY `process_biometrics_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee_process_biometrics_contents`
--
ALTER TABLE `tbl_employee_process_biometrics_contents`
  MODIFY `process_biometrics_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_employee_salary`
--
ALTER TABLE `tbl_employee_salary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee_salary_content`
--
ALTER TABLE `tbl_employee_salary_content`
  MODIFY `salary_content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee_schedule`
--
ALTER TABLE `tbl_employee_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee_schedule_contents`
--
ALTER TABLE `tbl_employee_schedule_contents`
  MODIFY `schedule_contents_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee_type`
--
ALTER TABLE `tbl_employee_type`
  MODIFY `employee_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_emplyoee_bank_details`
--
ALTER TABLE `tbl_emplyoee_bank_details`
  MODIFY `bank_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_leave_credits`
--
ALTER TABLE `tbl_leave_credits`
  MODIFY `leave_credits_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_leave_credits_content`
--
ALTER TABLE `tbl_leave_credits_content`
  MODIFY `leave_credits_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_offset`
--
ALTER TABLE `tbl_offset`
  MODIFY `offset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_offset_contents`
--
ALTER TABLE `tbl_offset_contents`
  MODIFY `offset_contents_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_tardiness`
--
ALTER TABLE `tbl_tardiness`
  MODIFY `tardiness_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_travel`
--
ALTER TABLE `tbl_travel`
  MODIFY `travel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_contribution_pag_ibig_contents`
--
ALTER TABLE `tbl_contribution_pag_ibig_contents`
  ADD CONSTRAINT `tbl_contribution_pag_ibig_contents_ibfk_1` FOREIGN KEY (`pag_ibig_id`) REFERENCES `tbl_contribution_pag_ibig` (`pag_ibig_id`);

--
-- Constraints for table `tbl_contribution_sss_contents`
--
ALTER TABLE `tbl_contribution_sss_contents`
  ADD CONSTRAINT `tbl_contribution_sss_contents_ibfk_1` FOREIGN KEY (`sss_id`) REFERENCES `tbl_contribution_sss` (`sss_id`);

--
-- Constraints for table `tbl_employee_contribution`
--
ALTER TABLE `tbl_employee_contribution`
  ADD CONSTRAINT `tbl_employee_contribution_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_employee_contribution_deductions`
--
ALTER TABLE `tbl_employee_contribution_deductions`
  ADD CONSTRAINT `tbl_employee_contribution_deductions_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`),
  ADD CONSTRAINT `tbl_employee_contribution_deductions_ibfk_2` FOREIGN KEY (`pag_ibig_id`) REFERENCES `tbl_contribution_pag_ibig` (`pag_ibig_id`),
  ADD CONSTRAINT `tbl_employee_contribution_deductions_ibfk_3` FOREIGN KEY (`sss_id`) REFERENCES `tbl_contribution_sss` (`sss_id`),
  ADD CONSTRAINT `tbl_employee_contribution_deductions_ibfk_4` FOREIGN KEY (`deductions_jam_lock_id`) REFERENCES `tbl_employee_deductions_jam_lock` (`deductions_jam_lock_id`),
  ADD CONSTRAINT `tbl_employee_contribution_deductions_ibfk_5` FOREIGN KEY (`pag_ibig_loan_id`) REFERENCES `tbl_employee_deductions_pag_ibig_loan` (`pag_ibig_loan_id`),
  ADD CONSTRAINT `tbl_employee_contribution_deductions_ibfk_6` FOREIGN KEY (`sss_loan_id`) REFERENCES `tbl_employee_deductions_sss_loan` (`sss_loan_id`),
  ADD CONSTRAINT `tbl_employee_contribution_deductions_ibfk_7` FOREIGN KEY (`deductions_proware_id`) REFERENCES `tbl_employee_deductions_proware` (`deductions_proware_id`);

--
-- Constraints for table `tbl_employee_deductions_jam_lock`
--
ALTER TABLE `tbl_employee_deductions_jam_lock`
  ADD CONSTRAINT `tbl_employee_deductions_jam_lock_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_employee_deductions_jam_lock_content`
--
ALTER TABLE `tbl_employee_deductions_jam_lock_content`
  ADD CONSTRAINT `tbl_employee_deductions_jam_lock_content_ibfk_1` FOREIGN KEY (`deductions_jam_lock_id`) REFERENCES `tbl_employee_deductions_jam_lock` (`deductions_jam_lock_id`);

--
-- Constraints for table `tbl_employee_deductions_pag_ibig_loan`
--
ALTER TABLE `tbl_employee_deductions_pag_ibig_loan`
  ADD CONSTRAINT `tbl_employee_deductions_pag_ibig_loan_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_employee_deductions_pag_ibig_loan_content`
--
ALTER TABLE `tbl_employee_deductions_pag_ibig_loan_content`
  ADD CONSTRAINT `tbl_employee_deductions_pag_ibig_loan_content_ibfk_1` FOREIGN KEY (`pag_ibig_loan_id`) REFERENCES `tbl_employee_deductions_pag_ibig_loan` (`pag_ibig_loan_id`);

--
-- Constraints for table `tbl_employee_deductions_proware`
--
ALTER TABLE `tbl_employee_deductions_proware`
  ADD CONSTRAINT `tbl_employee_deductions_proware_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_employee_deductions_proware_content`
--
ALTER TABLE `tbl_employee_deductions_proware_content`
  ADD CONSTRAINT `tbl_employee_deductions_proware_content_ibfk_1` FOREIGN KEY (`deductions_proware_id`) REFERENCES `tbl_employee_deductions_proware` (`deductions_proware_id`);

--
-- Constraints for table `tbl_employee_deductions_sss_loan`
--
ALTER TABLE `tbl_employee_deductions_sss_loan`
  ADD CONSTRAINT `tbl_employee_deductions_sss_loan_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_employee_deductions_sss_loan_content`
--
ALTER TABLE `tbl_employee_deductions_sss_loan_content`
  ADD CONSTRAINT `tbl_employee_deductions_sss_loan_content_ibfk_1` FOREIGN KEY (`sss_loan_id`) REFERENCES `tbl_employee_deductions_sss_loan` (`sss_loan_id`);

--
-- Constraints for table `tbl_employee_department`
--
ALTER TABLE `tbl_employee_department`
  ADD CONSTRAINT `tbl_employee_department_ibfk_1` FOREIGN KEY (`employee_type_id`) REFERENCES `tbl_employee_type` (`employee_type_id`);

--
-- Constraints for table `tbl_employee_details`
--
ALTER TABLE `tbl_employee_details`
  ADD CONSTRAINT `tbl_employee_details_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`),
  ADD CONSTRAINT `tbl_employee_details_ibfk_2` FOREIGN KEY (`employee_type_id`) REFERENCES `tbl_employee_type` (`employee_type_id`),
  ADD CONSTRAINT `tbl_employee_details_ibfk_3` FOREIGN KEY (`position_id`) REFERENCES `tbl_employee_position` (`position_id`),
  ADD CONSTRAINT `tbl_employee_details_ibfk_4` FOREIGN KEY (`department_id`) REFERENCES `tbl_employee_department` (`department_id`);

--
-- Constraints for table `tbl_employee_educational_background_college`
--
ALTER TABLE `tbl_employee_educational_background_college`
  ADD CONSTRAINT `tbl_employee_educational_background_college_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_employee_educational_background_doctoral`
--
ALTER TABLE `tbl_employee_educational_background_doctoral`
  ADD CONSTRAINT `tbl_employee_educational_background_doctoral_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_employee_educational_background_graduate`
--
ALTER TABLE `tbl_employee_educational_background_graduate`
  ADD CONSTRAINT `tbl_employee_educational_background_graduate_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_employee_offset`
--
ALTER TABLE `tbl_employee_offset`
  ADD CONSTRAINT `tbl_employee_offset_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_employee_position`
--
ALTER TABLE `tbl_employee_position`
  ADD CONSTRAINT `tbl_employee_position_ibfk_1` FOREIGN KEY (`employee_type_id`) REFERENCES `tbl_employee_type` (`employee_type_id`);

--
-- Constraints for table `tbl_employee_process_biometrics_contents`
--
ALTER TABLE `tbl_employee_process_biometrics_contents`
  ADD CONSTRAINT `tbl_employee_process_biometrics_contents_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`),
  ADD CONSTRAINT `tbl_employee_process_biometrics_contents_ibfk_2` FOREIGN KEY (`process_biometrics_id`) REFERENCES `tbl_employee_process_biometrics` (`process_biometrics_id`);

--
-- Constraints for table `tbl_employee_salary`
--
ALTER TABLE `tbl_employee_salary`
  ADD CONSTRAINT `tbl_employee_salary_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_employee_salary_content`
--
ALTER TABLE `tbl_employee_salary_content`
  ADD CONSTRAINT `tbl_employee_salary_content_ibfk_1` FOREIGN KEY (`salary_id`) REFERENCES `tbl_employee_salary` (`salary_id`);

--
-- Constraints for table `tbl_employee_schedule`
--
ALTER TABLE `tbl_employee_schedule`
  ADD CONSTRAINT `tbl_employee_schedule_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_employee_schedule_contents`
--
ALTER TABLE `tbl_employee_schedule_contents`
  ADD CONSTRAINT `tbl_employee_schedule_contents_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `tbl_employee_schedule` (`schedule_id`);

--
-- Constraints for table `tbl_emplyoee_bank_details`
--
ALTER TABLE `tbl_emplyoee_bank_details`
  ADD CONSTRAINT `tbl_emplyoee_bank_details_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_leave_credits`
--
ALTER TABLE `tbl_leave_credits`
  ADD CONSTRAINT `tbl_leave_credits_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_leave_credits_content`
--
ALTER TABLE `tbl_leave_credits_content`
  ADD CONSTRAINT `tbl_leave_credits_content_ibfk_1` FOREIGN KEY (`leave_credits_id`) REFERENCES `tbl_leave_credits` (`leave_credits_id`);

--
-- Constraints for table `tbl_offset`
--
ALTER TABLE `tbl_offset`
  ADD CONSTRAINT `tbl_offset_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_offset_contents`
--
ALTER TABLE `tbl_offset_contents`
  ADD CONSTRAINT `tbl_offset_contents_ibfk_1` FOREIGN KEY (`offset_id`) REFERENCES `tbl_offset` (`offset_id`);

--
-- Constraints for table `tbl_travel`
--
ALTER TABLE `tbl_travel`
  ADD CONSTRAINT `tbl_travel_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
