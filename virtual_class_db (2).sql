-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 24, 2025 at 09:00 PM
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
-- Database: `virtual_class_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `section_id`, `title`, `description`, `due_date`, `created_at`) VALUES
(1, 6, 'Fossil Research Paper', 'submit with due date', '2025-06-16 03:22:00', '2025-06-16 08:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(5, 'accoutiggjvjv'),
(1, 'computer science'),
(3, 'INFORMATION TECHNOLOGY'),
(6, 'managment'),
(4, 'Science'),
(7, 'W');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `section_id`) VALUES
(3, 3, 5),
(7, 3, 6),
(13, 3, 11),
(4, 6, 5),
(15, 8, 6),
(16, 8, 11),
(5, 9, 6),
(12, 9, 11),
(14, 12, 11);

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `login_time`) VALUES
(1, 1, '2025-06-15 07:05:49'),
(2, 6, '2025-06-15 07:13:32'),
(3, 5, '2025-06-15 07:21:30'),
(4, 1, '2025-06-15 07:26:11'),
(5, 1, '2025-06-15 12:04:06'),
(6, 1, '2025-06-15 13:37:29'),
(7, 1, '2025-06-15 15:10:07'),
(8, 1, '2025-06-16 07:16:57'),
(9, 1, '2025-06-16 07:33:34'),
(10, 8, '2025-06-16 07:39:05'),
(11, 9, '2025-06-16 07:53:29'),
(12, 8, '2025-06-16 07:54:10'),
(13, 1, '2025-06-16 08:00:36'),
(14, 1, '2025-06-16 08:09:15'),
(15, 11, '2025-06-16 08:13:31'),
(16, 10, '2025-06-16 08:29:11'),
(17, 8, '2025-06-16 17:00:36'),
(18, 11, '2025-06-16 19:01:26'),
(19, 8, '2025-06-16 19:03:52'),
(20, 8, '2025-06-16 19:36:44'),
(21, 8, '2025-06-16 19:39:32'),
(22, 11, '2025-06-16 19:47:07'),
(23, 8, '2025-06-16 19:48:44'),
(24, 1, '2025-06-16 19:58:11'),
(25, 8, '2025-06-16 20:11:22'),
(26, 1, '2025-06-16 20:14:17'),
(27, 1, '2025-06-16 20:44:39'),
(28, 8, '2025-06-16 20:49:29'),
(29, 1, '2025-06-16 21:00:48'),
(30, 14, '2025-06-16 21:01:33'),
(31, 1, '2025-06-17 09:59:11'),
(32, 1, '2025-06-17 10:20:49'),
(33, 1, '2025-06-17 10:37:00'),
(34, 8, '2025-06-17 10:37:40'),
(35, 11, '2025-06-17 10:39:33'),
(36, 11, '2025-06-17 10:54:21'),
(37, 8, '2025-06-17 11:24:14'),
(38, 11, '2025-06-17 11:24:54'),
(39, 1, '2025-06-17 11:56:31'),
(40, 1, '2025-06-17 11:57:13'),
(41, 8, '2025-06-17 11:59:58'),
(42, 11, '2025-06-17 12:00:29'),
(43, 11, '2025-06-17 12:04:12'),
(44, 11, '2025-06-17 12:09:16'),
(45, 1, '2025-06-17 12:19:31'),
(46, 1, '2025-06-17 12:19:51'),
(47, 8, '2025-06-17 12:24:28'),
(48, 11, '2025-06-17 12:25:12'),
(49, 11, '2025-06-17 12:25:25'),
(50, 11, '2025-06-17 12:26:10'),
(51, 11, '2025-06-17 16:19:50'),
(52, 1, '2025-06-17 16:20:22'),
(53, 1, '2025-06-17 16:23:25'),
(54, 1, '2025-06-17 16:25:18'),
(55, 8, '2025-06-17 16:25:46'),
(56, 11, '2025-06-17 16:28:20'),
(57, 11, '2025-06-17 17:13:07'),
(58, 1, '2025-06-17 18:14:47'),
(59, 1, '2025-06-17 18:19:51'),
(60, 1, '2025-06-17 18:41:22'),
(61, 11, '2025-06-17 18:43:26'),
(62, 11, '2025-06-17 18:49:36'),
(63, 8, '2025-06-17 19:26:22'),
(64, 11, '2025-06-17 19:41:32'),
(65, 1, '2025-06-17 19:41:43'),
(66, 11, '2025-06-17 19:42:42'),
(67, 8, '2025-06-17 19:44:03'),
(68, 1, '2025-06-17 20:20:53'),
(69, 1, '2025-06-17 20:22:59'),
(70, 1, '2025-06-18 03:01:37'),
(71, 8, '2025-06-18 03:10:35'),
(72, 1, '2025-06-18 03:11:17'),
(73, 8, '2025-06-18 03:11:50'),
(74, 11, '2025-06-18 03:13:23'),
(75, 8, '2025-06-18 03:16:00'),
(76, 11, '2025-06-18 03:17:08'),
(77, 1, '2025-06-18 03:19:36'),
(78, 8, '2025-06-18 03:22:36'),
(79, 1, '2025-06-18 03:24:02'),
(80, 11, '2025-06-18 03:24:45'),
(81, 11, '2025-06-18 03:27:09'),
(82, 8, '2025-06-18 03:27:22'),
(83, 1, '2025-06-18 03:28:24'),
(84, 8, '2025-06-18 03:29:13'),
(85, 11, '2025-06-18 03:32:13'),
(86, 1, '2025-06-18 03:38:00'),
(87, 1, '2025-06-18 03:43:16'),
(88, 11, '2025-06-18 04:06:01'),
(89, 1, '2025-06-18 04:06:48'),
(90, 11, '2025-06-18 04:13:41'),
(91, 1, '2025-06-18 04:14:08'),
(92, 1, '2025-06-18 04:38:16'),
(93, 11, '2025-06-18 04:39:25'),
(94, 8, '2025-06-18 04:40:27'),
(95, 1, '2025-06-18 04:41:12'),
(96, 11, '2025-06-18 05:03:24'),
(97, 11, '2025-06-18 05:03:59'),
(98, 8, '2025-06-18 05:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `material_type` enum('file','video') NOT NULL DEFAULT 'file',
  `video_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `section_id`, `title`, `file_path`, `uploaded_at`, `material_type`, `video_url`) VALUES
(1, 4, 'project', 'uploads/1749899835-Group4PM.pptx', '2025-06-14 11:17:15', 'file', NULL),
(2, 6, 'CourseSyllabus.pdf', 'uploads/1750061880-IR_FinalAss.docx', '2025-06-16 08:18:00', 'file', NULL),
(3, 6, 'GCFHCG', '#', '2025-06-16 19:02:41', 'video', 'https://www.youtube.com/embed/8yRY1GnDv8o'),
(4, 6, 'maths', 'uploads/1750187385-Chapter-4.pptx', '2025-06-17 19:09:45', 'file', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `subject`, `content`, `is_read`, `created_at`) VALUES
(1, 6, 1, 'maths', 'hey', 1, '2025-06-15 07:20:47'),
(2, 8, 7, 'sdv', 'zdvfs', 0, '2025-06-16 07:48:32'),
(3, 8, 7, 'Re: Chat', 'sdgef', 0, '2025-06-16 07:48:40'),
(4, 8, 7, 'Re: Chat', 'afwds', 0, '2025-06-16 07:48:44'),
(5, 8, 3, 'zckdcdv', 'mahscvagagcdac', 0, '2025-06-16 07:51:48'),
(6, 9, 8, 'sfuwjkdjw', 'fcdjkadfjkckdfzjcvda', 1, '2025-06-16 07:53:56'),
(7, 8, 11, 'hello sir', 'how are you', 1, '2025-06-16 19:45:09'),
(8, 8, 11, 'Re: Chat', 'dadadk', 1, '2025-06-16 19:45:24'),
(9, 8, 11, 'Re: Chat', 'zjcjd', 1, '2025-06-16 19:45:29'),
(10, 8, 11, 'hello sir', 'how are you', 1, '2025-06-16 19:45:51'),
(11, 11, 8, 'Re: Chat', 'svk\\sfvjjfvsvkl', 1, '2025-06-16 19:47:44'),
(12, 11, 8, 'Re: Chat', 'dfdvd', 1, '2025-06-16 19:47:51'),
(13, 8, 7, 'hello sir', 'kfhvjvcvmfjksgvsv', 0, '2025-06-16 20:57:58'),
(14, 8, 7, 'Re: Chat', 'hell', 0, '2025-06-16 20:58:10'),
(15, 8, 12, 'hello sir', 'kfhvjvcvmfjksgvsv', 0, '2025-06-16 20:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_text` varchar(255) NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `option_text`, `is_correct`) VALUES
(1, 1, 'v', 1),
(2, 1, 'j', 0),
(3, 1, 'dtdtr', 0),
(4, 1, 'xfg', 0),
(5, 2, 'A. Allow the admin to view and edit passwords in plain text.', 0),
(6, 2, 'B. Let the admin reset passwords, but store the new password using a secure hashing algorithm like bcrypt.', 1),
(7, 2, 'C. Store passwords in a text file on the server so the admin can easily access them later.', 0),
(8, 2, 'D. Send the user\'s current password to the admin\'s email for verification.', 0),
(9, 3, 'A. Allow the admin to view and edit passwords in plain text.', 0),
(10, 3, 'B. Let the admin reset passwords, but store the new password using a secure hashing algorithm like bcrypt.', 1),
(11, 3, 'C. Store passwords in a text file on the server so the admin can easily access them later.', 0),
(12, 3, 'D. Send the user\'s current password to the admin\'s email for verification.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`) VALUES
(1, 4, 'mvv'),
(2, 4, '1.Which of the following is the most secure way for an Admin to reset a user\'s password in a web-based system?'),
(3, 5, 'Which of the following is the most secure way for an Admin to reset a user\'s password in a web-based system?');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `section_id`, `title`, `created_at`) VALUES
(1, 6, 'Fossil Research Paper', '2025-06-16 08:24:20'),
(2, 6, 'something', '2025-06-17 19:04:48'),
(3, 6, 'mid', '2025-06-17 19:10:21'),
(4, 6, 'jvj', '2025-06-17 19:43:18'),
(5, 6, 'week 1 pop up quiz', '2025-06-18 03:25:55'),
(6, 6, 'pop', '2025-06-18 04:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_attempts`
--

INSERT INTO `quiz_attempts` (`id`, `quiz_id`, `student_id`, `score`, `total_questions`, `completed_at`) VALUES
(1, 4, 8, 0, 1, '2025-06-17 19:44:51'),
(2, 5, 8, 1, 1, '2025-06-18 03:27:42');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `department_id`, `teacher_id`) VALUES
(4, 'A', 1, 5),
(5, 'B', 1, 5),
(6, 'Biology 101', 4, 11),
(11, 'D', 3, 7),
(12, 'W', 7, 11);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `grade` varchar(10) DEFAULT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `assignment_id`, `student_id`, `file_path`, `submitted_at`, `grade`, `feedback`) VALUES
(1, 1, 8, 'uploads/submissions/8-1-IR_FinalAss.docx', '2025-06-16 19:42:03', 'A+', 'Good keep it up.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` enum('admin','teacher','student') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gender` enum('male','female','other','not_specified') NOT NULL DEFAULT 'not_specified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `role`, `created_at`, `gender`) VALUES
(1, 'admin', '$2y$10$e022MSodMVg4o3OaZFQucuMXa8JZV44kljCojjPvQF3hLaOKOSjCO', 'System Administrator', 'admin', '2025-06-14 10:07:06', 'not_specified'),
(3, 'nat', '$2y$10$ISXUFEU3HoHwXFc29FGSI.sAKK6nBCjxCuf8BepvT0mem3wsUq9vO', 'naty', 'student', '2025-06-14 10:40:09', 'not_specified'),
(4, '@natty', '$2y$10$N7SIUEKqGMLlO3Wox6Wq9OuD4c2BVVt2KZ838ePRFjFCoDqHOMMN.', 'Natnael', 'teacher', '2025-06-14 10:48:00', 'not_specified'),
(5, 'dani', '$2y$10$ca5KBiIqQNGOnMrrDa5dKO2atevgKDAvdJxQiGIkQqHpm5.WOBa7W', 'dani', 'teacher', '2025-06-14 11:14:22', 'not_specified'),
(6, 'some', '$2y$10$k86b/nwkdNx2u/vOWujgEuCszVxFTttgH/FwjZwaiPjgGPIWGHf16', 'some', 'student', '2025-06-15 07:13:21', 'male'),
(7, 'boss', '$2y$10$58S2Te6S5G8nIaMQ5k0nZ.7qKCRCaVAZPs9IyyGs6zHrVNf7QRtau', 'boss', 'teacher', '2025-06-15 07:26:49', 'male'),
(8, 'one', '$2y$10$W5G38bKLD1jKS2GuN1Atv.dDjyBqxQeSB2119y16DguUXW7vUhm42', 'one', 'student', '2025-06-16 07:38:49', 'male'),
(9, 'aba', '$2y$10$e4uBVQrvKU1t6WUxYZnDP.KPADycN076ep2eLKf60NBdfAMIQqDyW', 'aba', 'student', '2025-06-16 07:53:12', 'male'),
(10, 'teststudent', '$2y$10$qX3TwZxwwURcr/766Hbm5.na0XMAEAElVTkQGarnn931fgt71PtCC', 'Test Student', 'student', '2025-06-16 08:07:16', 'male'),
(11, 'alangrant', '$2y$10$scpcbB3eCA7VFGPa.wlJce95YZUj.7/E/o0gIgzxJuZn3HXGGFQjm', 'Prof. Alan Grant', 'teacher', '2025-06-16 08:10:45', 'not_specified'),
(12, 'maty', '$2y$10$Jt5MTp3Vnm5SyjJm1TjBye85WiW83EmVPF306URkFSV4cC5GrWLoy', 'maty', 'student', '2025-06-16 20:00:09', 'not_specified'),
(14, 'miser', '$2y$10$DvffDECDY060nLP7gkTSQ.PuPDgQtN2s2SHgSPJmuFTFehXfC20B.', 'miser', 'teacher', '2025-06-16 21:01:16', 'not_specified'),
(15, 'ma', '$2y$10$llxNZlHPNuLunPkwAqJfse/IACppl7RTtDson/V4zWmJl8dgdEHhm', 'ma', 'student', '2025-06-18 04:11:29', 'not_specified'),
(16, 'geni', '$2y$10$ERL94WMW8bmWBSrKuao7t.aLoFbkrOSamWAFR5hkTvhR/Vb5t/bqO', 'geni', 'student', '2025-06-18 04:29:29', 'female');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`,`section_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quiz_id` (`quiz_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assignment_id` (`assignment_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

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
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `announcements_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD CONSTRAINT `login_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD CONSTRAINT `quiz_attempts_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_attempts_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sections_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
