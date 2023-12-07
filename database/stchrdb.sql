-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 07:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stchrdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar_event_master`
--

CREATE TABLE `calendar_event_master` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `event_start_date` date DEFAULT NULL,
  `event_end_date` date DEFAULT NULL,
  `event_time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `name`, `department`, `designation`, `email`, `password`, `role`) VALUES
(4, 'admins', 'first office', 'admin', 'admin', '$2y$10$BcJxAPE4p8YZwcC2Z5YJ7OlGIngNuSnVYOyxTTztgFDWSDc0TLL3a', 'Admin'),
(7, 'Juan A. Dela Cruz', 'first office', 'user lang', 'juan', '$2y$10$rp3xwt2R1DAHmboxdd40YO2sDEJQi3rdbZb1BZaTQKH1x4zI85klG', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `ID` int(11) NOT NULL,
  `Department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `oldItem` varchar(255) NOT NULL,
  `newItem` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `sg` varchar(255) NOT NULL,
  `sg1` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `amount1` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `employment` varchar(255) NOT NULL,
  `start` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees_jo`
--

CREATE TABLE `employees_jo` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `end` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `employment` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `funding` varchar(255) NOT NULL,
  `start` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_files`
--

CREATE TABLE `employee_files` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `ID` int(11) NOT NULL,
  `itemNo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `employment` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `average` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_table`
--

CREATE TABLE `evaluation_table` (
  `ID` int(11) NOT NULL,
  `evaluatee_id` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `strategic_mfo` varchar(255) NOT NULL,
  `strategic_rating` varchar(255) NOT NULL,
  `core_function_mfo` varchar(255) NOT NULL,
  `core_function_rating` varchar(255) NOT NULL,
  `support_function_mfo` varchar(255) NOT NULL,
  `support_function_rating` varchar(255) NOT NULL,
  `total_overall_rating` varchar(255) NOT NULL,
  `final_average_rating` varchar(255) NOT NULL,
  `adjective_rating` varchar(255) NOT NULL,
  `supporting_document` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `employee_files_id` int(11) NOT NULL,
  `upload_date` date DEFAULT curdate(),
  `file_name` varchar(255) NOT NULL,
  `file_directory` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainees`
--

CREATE TABLE `trainees` (
  `ID` int(11) NOT NULL,
  `trainee_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `training_type` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `trainee_position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar_event_master`
--
ALTER TABLE `calendar_event_master`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employees_jo`
--
ALTER TABLE `employees_jo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employee_files`
--
ALTER TABLE `employee_files`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `evaluation_table`
--
ALTER TABLE `evaluation_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `trainees`
--
ALTER TABLE `trainees`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar_event_master`
--
ALTER TABLE `calendar_event_master`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees_jo`
--
ALTER TABLE `employees_jo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_files`
--
ALTER TABLE `employee_files`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evaluation_table`
--
ALTER TABLE `evaluation_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainees`
--
ALTER TABLE `trainees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
