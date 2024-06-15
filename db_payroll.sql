-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 09:40 AM
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
-- Database: `db_payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `department_id` int(11) NOT NULL,
  `department_type` varchar(255) NOT NULL,
  `department_code` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department_type`, `department_code`, `department_name`, `status`) VALUES
(1, 'Faculty', 'HM', 'Hotel Management', 'Active');

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
(3, 11, '1', '1', '1', '2024-06-13', 'Male', 'Married', '2024-06-20', 'Active', '11', '12312@gmail.com', '11', '1', '1'),
(4, 234, '343', '4', '34', '2024-06-14', 'Male', 'Married', '2024-06-25', 'Active', '234', '234@asdf.com', '2342', '342', '34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_details`
--

CREATE TABLE `tbl_employee_details` (
  `details_id` int(11) NOT NULL,
  `employee_details_id` int(11) NOT NULL,
  `employee_details_position` int(11) NOT NULL,
  `employee_details_department` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_details`
--

INSERT INTO `tbl_employee_details` (`details_id`, `employee_details_id`, `employee_details_position`, `employee_details_department`) VALUES
(3, 3, 1, NULL),
(4, 4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_salary`
--

CREATE TABLE `tbl_employee_salary` (
  `salary_id` int(11) NOT NULL,
  `employee_salary` int(11) NOT NULL,
  `salary` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_salary`
--

INSERT INTO `tbl_employee_salary` (`salary_id`, `employee_salary`, `salary`) VALUES
(1, 3, 123.00),
(2, 4, 123.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_salary_adjustment`
--

CREATE TABLE `tbl_employee_salary_adjustment` (
  `salary_adjustment_id` int(11) NOT NULL,
  `id_salary` int(11) NOT NULL,
  `salary_adjustment` decimal(10,0) NOT NULL,
  `reason` text NOT NULL,
  `effective_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holiday`
--

CREATE TABLE `tbl_holiday` (
  `holiday_id` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date DEFAULT NULL,
  `type_of_holiday` varchar(255) NOT NULL,
  `name_of_holiday` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_holiday`
--

INSERT INTO `tbl_holiday` (`holiday_id`, `date_from`, `date_to`, `type_of_holiday`, `name_of_holiday`, `status`) VALUES
(1, '2024-06-12', '0000-00-00', 'Special (Non-Working) Holidays', '123', 'Active'),
(2, '2024-06-19', '2024-06-18', 'Local School Declaration', '12333', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `position_id` int(11) NOT NULL,
  `employee_type` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `salary_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`position_id`, `employee_type`, `position`, `type`, `salary_type`, `status`) VALUES
(1, 'Staff', 'Admission Officer', 'Not Regular', 'Hourly Rate', 'Active'),
(2, 'Faculty', 'Program Head', 'Regular', 'Monthly Rate', 'Active');

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
(1, 'master', 'master', 'Payroll Master', 'Active'),
(2, 'SchoolAdmin', 'SchoolAdmin', 'School Admin', 'Active'),
(3, 'Accounting', 'Accounting', 'Accounting', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tbl_employee_details`
--
ALTER TABLE `tbl_employee_details`
  ADD PRIMARY KEY (`details_id`),
  ADD KEY `employee_details_id` (`employee_details_id`),
  ADD KEY `employee_details_position` (`employee_details_position`),
  ADD KEY `employee_details_department` (`employee_details_department`);

--
-- Indexes for table `tbl_employee_salary`
--
ALTER TABLE `tbl_employee_salary`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `employee_salary` (`employee_salary`);

--
-- Indexes for table `tbl_employee_salary_adjustment`
--
ALTER TABLE `tbl_employee_salary_adjustment`
  ADD PRIMARY KEY (`salary_adjustment_id`),
  ADD KEY `id_salary` (`id_salary`);

--
-- Indexes for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_employee_details`
--
ALTER TABLE `tbl_employee_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_employee_salary`
--
ALTER TABLE `tbl_employee_salary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_employee_salary_adjustment`
--
ALTER TABLE `tbl_employee_salary_adjustment`
  MODIFY `salary_adjustment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_employee_details`
--
ALTER TABLE `tbl_employee_details`
  ADD CONSTRAINT `tbl_employee_details_ibfk_1` FOREIGN KEY (`employee_details_id`) REFERENCES `tbl_employee` (`employee_id`),
  ADD CONSTRAINT `tbl_employee_details_ibfk_2` FOREIGN KEY (`employee_details_position`) REFERENCES `tbl_position` (`position_id`),
  ADD CONSTRAINT `tbl_employee_details_ibfk_3` FOREIGN KEY (`employee_details_department`) REFERENCES `tbl_department` (`department_id`);

--
-- Constraints for table `tbl_employee_salary`
--
ALTER TABLE `tbl_employee_salary`
  ADD CONSTRAINT `tbl_employee_salary_ibfk_1` FOREIGN KEY (`employee_salary`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_employee_salary_adjustment`
--
ALTER TABLE `tbl_employee_salary_adjustment`
  ADD CONSTRAINT `tbl_employee_salary_adjustment_ibfk_1` FOREIGN KEY (`id_salary`) REFERENCES `tbl_employee_salary` (`salary_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
