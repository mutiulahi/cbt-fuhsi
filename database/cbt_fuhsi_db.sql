-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2022 at 04:01 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbt_fuhsi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `check_subject`
--

CREATE TABLE `check_subject` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `examination_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `check_subject`
--

INSERT INTO `check_subject` (`id`, `user_id`, `examination_id`) VALUES
(1, '2022101HB', 1),
(2, '2022101HB', 2);

-- --------------------------------------------------------

--
-- Table structure for table `correct_options`
--

CREATE TABLE `correct_options` (
  `id` int(11) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `correct_options`
--

INSERT INTO `correct_options` (`id`, `examination_id`, `question_id`, `answer`) VALUES
(1, 1, 1, 'biology is the studies id life'),
(2, 1, 2, 'home3'),
(3, 1, 3, 'exam4'),
(4, 2, 4, 'biologchemy is the studies id life'),
(5, 2, 5, 'home3 chem'),
(6, 2, 6, 'exam4 chem');

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `total_number_of_question` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `access` int(11) NOT NULL DEFAULT 1,
  `session` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examinations`
--

INSERT INTO `examinations` (`id`, `subject`, `total_number_of_question`, `status`, `access`, `session`) VALUES
(1, 'Biology', '20', 1, 1, '2022/2023'),
(2, 'Chemistry', '20', 1, 1, '2022/22023'),
(3, 'English', '10', 1, 1, '2022/2023'),
(4, 'Physics', '10', 1, 1, '2022/2023');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question_option` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `examination_id`, `question_id`, `question_option`) VALUES
(1, 1, 1, 'biology is life'),
(2, 1, 1, 'biology is book'),
(3, 1, 1, 'biology is the studies id life'),
(4, 1, 1, 'biology'),
(5, 1, 2, 'home1'),
(6, 1, 2, 'home2'),
(7, 1, 2, 'home3'),
(8, 1, 2, 'home4'),
(9, 1, 3, 'exam1'),
(10, 1, 3, 'exam2'),
(11, 1, 3, 'exam3'),
(12, 1, 3, 'exam4'),
(13, 2, 4, 'biolchemogy is life'),
(14, 2, 4, 'chem is book'),
(15, 2, 4, 'chem is the studies id life'),
(16, 2, 4, 'chem'),
(17, 2, 5, 'home1chem'),
(18, 2, 5, 'home2chem'),
(19, 2, 5, 'home3chem'),
(20, 2, 5, 'home4 chem'),
(21, 2, 6, 'exam1chem'),
(22, 2, 6, 'exam2chem '),
(23, 2, 6, 'exam3 chem'),
(24, 2, 6, 'exam4 chem');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `examination_id`, `question`) VALUES
(1, 1, 'What is biology'),
(2, 1, 'how many home'),
(3, 1, 'exam'),
(4, 2, 'What is chem'),
(5, 2, 'how many chem'),
(6, 2, 'exam chem');

-- --------------------------------------------------------

--
-- Table structure for table `students_answers`
--

CREATE TABLE `students_answers` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `examination_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_answers`
--

INSERT INTO `students_answers` (`id`, `user_id`, `question_id`, `option_id`, `examination_id`) VALUES
(1, '2022101HB', 3, 11, 1),
(2, '2022101HB', 2, 5, 1),
(3, '2022101HB', 1, 1, 1),
(4, '2022101HB', 5, 19, 2),
(5, '2022101HB', 4, 13, 2),
(6, '2022101HB', 6, 24, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `jamb` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `login_at` varchar(50) DEFAULT NULL,
  `logout_at` varchar(50) DEFAULT NULL,
  `is_login` int(11) NOT NULL DEFAULT 0,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `jamb`, `email`, `phone`, `login_at`, `logout_at`, `is_login`, `role`) VALUES
(1, 'Mutiulahi Tesleem', '2022101HB', 'tescode@gmail.com', '07067526407', '', '', 0, 0),
(2, 'Admin', 'admin123', 'admin@gmail.com', '09078787878', NULL, NULL, 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `check_subject`
--
ALTER TABLE `check_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `correct_options`
--
ALTER TABLE `correct_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_answers`
--
ALTER TABLE `students_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `check_subject`
--
ALTER TABLE `check_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `correct_options`
--
ALTER TABLE `correct_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students_answers`
--
ALTER TABLE `students_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
