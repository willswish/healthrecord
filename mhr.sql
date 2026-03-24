-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2026 at 09:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mhr`
--

-- --------------------------------------------------------

--
-- Table structure for table `current_medication`
--

CREATE TABLE `current_medication` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `current_medication` enum('Yes','No') DEFAULT 'No',
  `medication_specify` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_medication`
--

INSERT INTO `current_medication` (`id`, `student_id`, `current_medication`, `medication_specify`) VALUES
(1, 123, 'Yes', 'asd'),
(2, 234, 'No', 'ds');

-- --------------------------------------------------------

--
-- Table structure for table `medical_info`
--

CREATE TABLE `medical_info` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `fever` enum('Yes','No') DEFAULT 'No',
  `cough` enum('Yes','No') DEFAULT 'No',
  `sore_throat` enum('Yes','No') DEFAULT 'No',
  `runny_nose` enum('Yes','No') DEFAULT 'No',
  `fatigue` enum('Yes','No') DEFAULT 'No',
  `headache` enum('Yes','No') DEFAULT 'No',
  `difficulty_breathing` enum('Yes','No') DEFAULT 'No',
  `diarrhea` enum('Yes','No') DEFAULT 'No',
  `date_recorded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_info`
--

INSERT INTO `medical_info` (`id`, `student_id`, `fever`, `cough`, `sore_throat`, `runny_nose`, `fatigue`, `headache`, `difficulty_breathing`, `diarrhea`, `date_recorded`) VALUES
(0, '123', 'Yes', 'No', 'Yes', 'Yes', 'No', 'Yes', 'No', 'No', '2026-03-24 07:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `treatment` text NOT NULL,
  `severity` enum('mild','moderate','severe') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_records`
--

INSERT INTO `medical_records` (`id`, `student_id`, `date`, `diagnosis`, `treatment`, `severity`, `created_at`) VALUES
(1, '124', '2026-03-19', 'cold', 'fluids', 'mild', '2026-03-19 07:20:59'),
(2, '321', '2026-03-23', 'Hot', 'Tempra', 'severe', '2026-03-23 07:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`id`, `student_id`, `first_name`, `last_name`, `email`, `contact`, `address`, `created_at`, `updated_at`) VALUES
(1, 'clerk', 'clerk', 'clerk', 'clerk@gmail.com', '09123456789', 'dawdqw', '2026-03-24 05:51:46', '2026-03-24 05:51:46'),
(2, '21313', 'clerk', 'clerk', 'clerk@gmail.com', '09123456789', 'dawdqw', '2026-03-24 06:10:13', '2026-03-24 06:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`) VALUES
(1, 'admin', 'Administrator'),
(2, 'nurse', 'Health Nurse'),
(3, 'clerk', 'Health Clerk'),
(4, 'coordinator', 'Health Coordinator'),
(5, 'dean', 'Dean');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `screening`
--

CREATE TABLE `screening` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `vision_right_eye` enum('Pass','Fail') DEFAULT NULL,
  `vision_left_eye` enum('Pass','Fail') DEFAULT NULL,
  `hearing_left_ear` enum('Pass','Fail') DEFAULT NULL,
  `hearing_right_ear` enum('Pass','Fail') DEFAULT NULL,
  `screening_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `college` varchar(100) DEFAULT NULL,
  `blood_type` varchar(5) DEFAULT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `first_name`, `last_name`, `age`, `email`, `contact`, `course`, `college`, `blood_type`, `sex`, `religion`, `civil_status`, `allergies`, `created_at`) VALUES
(1, '123', 'Will ', 'Bar', 2, 'wchris@gmail.com', '0991', 'bsit', 'adu', 'O+', 'Male', 'catholic', 'Single', 'none', '2026-03-18 08:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','clerk','coordinator','dean','nurse') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$vevlBzW9aAO858eHWj2uOu5TyHBE/dGZdHfD8Z40DRNSJtbHp1zi2', 'admin', '2026-03-18 07:20:31'),
(2, 'Dean', '$2y$10$Xnwqa1ak3/.iYkzLnzUdJeyR/5GlICDA5E7C29l3Z.JTtulfh/GnG', 'dean', '2026-03-18 07:20:43'),
(3, 'Coordinator', '$2y$10$X7PEOaaXGLOXtY0zuPxpB.4UutyO.QbAokj3CRQkIhfqMlPKNGGwe', 'coordinator', '2026-03-18 07:21:03'),
(4, 'nurse', '$2y$10$CGF6eM5f6aCmrGXnR5yM/.uYcCQVmeI4ofF18NLiafgoLoxOHwTfq', 'nurse', '2026-03-18 07:21:12'),
(5, 'clerk', '$2y$10$q5oHVckV7XUiKu..RVypgeb/ki.M.dYYJuQlN4F6bhPxkH2V4Eswy', 'clerk', '2026-03-18 07:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `vaccinations`
--

CREATE TABLE `vaccinations` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `vaccine_name` varchar(100) DEFAULT NULL,
  `dose` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `provider` varchar(100) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vitals`
--

CREATE TABLE `vitals` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `temperature` decimal(4,1) DEFAULT NULL,
  `pulse_rate` int(11) DEFAULT NULL,
  `blood_pressure` varchar(10) DEFAULT NULL,
  `oxygen_level` int(11) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vitals`
--

INSERT INTO `vitals` (`id`, `student_id`, `date`, `time`, `temperature`, `pulse_rate`, `blood_pressure`, `oxygen_level`, `weight`, `height`) VALUES
(2, 123, '2026-03-19', '07:27:00', 98.0, 72, '120/90', 98, 67.00, 170.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `current_medication`
--
ALTER TABLE `current_medication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission`);

--
-- Indexes for table `screening`
--
ALTER TABLE `screening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vitals`
--
ALTER TABLE `vitals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `current_medication`
--
ALTER TABLE `current_medication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `screening`
--
ALTER TABLE `screening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vaccinations`
--
ALTER TABLE `vaccinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vitals`
--
ALTER TABLE `vitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
