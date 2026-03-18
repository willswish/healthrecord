-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2026 at 09:01 AM
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
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
