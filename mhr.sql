-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2026 at 09:02 AM
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
(1, '124', '2026-03-19', 'cold', 'fluids', 'mild', '2026-03-19 07:20:59');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `vitals`
--
ALTER TABLE `vitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
