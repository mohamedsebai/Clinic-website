-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2023 at 04:53 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vcare_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `location` varchar(50) NOT NULL DEFAULT 'EraaSoft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `name`, `email`, `phone`, `doctor_id`, `status`, `location`, `created_at`) VALUES
(118, 'Mohamed sebai', 'mohamedseabeai@gmail.com', '+201149725209', 26, 0, 'EraaSoft', '2023-08-19 02:31:55'),
(119, 'Mohamed sebai', 'mohamedseabeai@gmail.com', '+201149725209', 27, 0, 'EraaSoft', '2023-08-19 02:32:00'),
(120, 'Mohamed sebai', 'mohamedseabeai@gmail.com', '+201149725209', 28, 0, 'EraaSoft', '2023-08-19 02:32:03'),
(121, 'Mohamed sebai', 'mohamedseabeai@gmail.com', '+201149725209', 29, 0, 'EraaSoft', '2023-08-19 02:32:08'),
(122, 'Mohamed sebai', 'mohamedseabeai@gmail.com', '+201149725209', 28, 0, 'EraaSoft', '2023-08-19 02:32:13'),
(123, 'Mohamed sebai', 'mohamedseabeai@gmail.com', '1149725209', 27, 0, 'EraaSoft', '2023-08-19 02:34:10'),
(124, 'Mohamed sebai', 'mohamedseabeai@gmail.com', '1149725209', 29, 0, 'EraaSoft', '2023-08-19 02:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`, `created_at`) VALUES
(9, 'Cairo', '2023-08-17 01:00:54'),
(11, 'Asyut', '2023-08-17 01:00:57'),
(12, 'Minya', '2023-08-18 14:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `major_id` int(11) NOT NULL,
  `doctor_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `phone`, `email`, `password`, `summary`, `city_id`, `major_id`, `doctor_img`, `created_at`) VALUES
(26, 'Mohamed sebai', '+201149725209', 'mohamedseabeai@gmail.com', '$2y$10$LhL4EVjQDSmMc4KZz/tauOzvkNf5QNj6JdVGerMxb0tSTTMQxF53m', 'this is summary of or doctor mohamed seabeai', 9, 45, 'IMG-1954135782.jpg', '2023-08-19 02:28:50'),
(27, 'Ahmed sebai', '+201149725209', 'mohamedseabeai@gmail.comdoctor', '$2y$10$8TDEbd5pM1MWYGgrz8sOi.AVv/1NBjrHRAkbPTBz41QEYrlkyIRee', 'this is summary of or doctor hassan seabeai', 11, 46, 'IMG-1917520948.jpg', '2023-08-19 02:33:06'),
(28, 'sayad sebai', '+201149725209', 'mohamedseabeai@gmail.comdoctor2', '$2y$10$s00s7Ge98g5.afa0iPwsyOG/ea8o7KL0B7w/KorF1m9n7xogqUzXm', 'this is summary of or doctor sayad seabeai', 12, 47, 'IMG-892828301.jpeg', '2023-08-19 02:30:39'),
(29, 'yasser sebai', '+201149725209', 'mohamedseabeai@gmail.comdoctor4', '$2y$10$8IsiIrahLIEtT7.8HpWBG.HVSgayMteZVV6J6oXP95e7/9mw6IIa6', 'this is summary of or doctor yasser seabeai', 11, 48, 'IMG-1837723109.jpeg', '2023-08-19 02:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `title`, `img`, `created_at`) VALUES
(45, 'Biology', 'IMG-1967317677.jpg', '2023-08-19 02:27:23'),
(46, 'Biochemistry', 'IMG-480708533.jpg', '2023-08-19 02:27:39'),
(47, 'Biomedical engineering', 'IMG-634890318.jpg', '2023-08-19 02:27:51'),
(48, 'Psychology', 'IMG-394736312.jpg', '2023-08-19 02:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `phone`, `subject`, `content`, `created_at`) VALUES
(7, 'mohamedsebai', 'mohamedseabeai@gmail.com', '1149725209', 'sadfasdf', 'asdfasdf', '2023-08-17 00:32:03'),
(8, 'mohameds@gmail.com', 'mohamedseabeai@gmail.com', '1149725209', 'this is subject', 'this is message', '2023-08-19 00:17:59'),
(9, 'mohameds@gmail.com', 'mohamedseabeai@gmail.com', '1149725209', 'this is subject', 'this is messgae', '2023-08-19 00:18:19'),
(10, 'mohameds@gmail.com', 'mohamedseabeai@gmail.com', '1149725209', 'asdf', 'asdfasdf', '2023-08-19 00:18:26'),
(11, 'mohameds@gmail.com', 'mohamedseabeai@gmail.com', '1149725209', 'asdfasd', 'fsdf', '2023-08-19 00:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `title`, `content`, `created_at`) VALUES
(12, 'everything you need is found at VCare.', 'search for a doctor and book an appointment in a hospital, clinic, home visit or even by phone,you can also order medicine or book a surgery.', '2023-08-19 02:42:34'),
(13, 'everything you need is found at VCare.', 'search for a doctor and book an appointment in a hospital, clinic, home visit or even by phone,you can also order medicine or book a surgery.', '2023-08-18 13:52:19'),
(15, 'everything you need is found at VCare.', 'search for a doctor and book an appointment in a hospital, clinic, home visit or even by phone,you can also order medicine or book a surgery.', '2023-08-18 13:52:23'),
(17, 'everything you need is found at VCare.', 'everything you need is found at VCare.\r\neverything you need is found at VCare.', '2023-08-19 00:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `rate` tinyint(4) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `rate`, `doctor_id`, `created_at`) VALUES
(66, 3, 27, '2023-08-19 02:34:21'),
(67, 5, 27, '2023-08-19 02:34:27'),
(68, 5, 29, '2023-08-19 02:36:54'),
(69, 4, 26, '2023-08-19 02:49:22'),
(70, 5, 26, '2023-08-19 02:49:33'),
(71, 1, 26, '2023-08-19 02:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `profile_img`, `role`, `created_at`, `update_at`) VALUES
(52, 'mohamedseabeai', 'mohamedseabeai@gmail.com', '$2y$10$JPOd99Eg5t/PJS7PRnMEheRyCmuEcoJJqZT2NkbeVvwvfzDVd/wf2', '+201149725209', 'IMG-750000649.jpg', 'admin', '2023-08-19 02:22:50', '0000-00-00 00:00:00'),
(53, 'mohamedseabeai', 'mohamedseabeai@gmail.comadmin', '$2y$10$8A72Jg0Htt8vqHgmXl64.uWRDYriGaQMnBNJQDEAwIirozjha6hi.', '+201149725209', 'IMG-22461697.jpg', 'admin', '2023-08-19 02:24:04', '0000-00-00 00:00:00'),
(54, 'mohamedseabeai', 'mohamedseabeai@gmail.com', '$2y$10$mHY2QuTeVcLptqJHkZs53uvEPE/9uW2hqEaWoIdNZ9GaBM0n7JGra', '201149725209', 'IMG-325527301.jpg', 'user', '2023-08-19 02:25:27', '0000-00-00 00:00:00'),
(55, 'mohamedseabeai', 'mohamedseabeai@gmail.comuser', '$2y$10$G4eW.fYPYb.kCc4dQ/1Sf.3.OnXMn0WDEvJOVLLTbjvPcQiSR3VOa', '201149725209', 'IMG-658279081.jpg', 'user', '2023-08-19 02:25:48', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `major_id` (`major_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
