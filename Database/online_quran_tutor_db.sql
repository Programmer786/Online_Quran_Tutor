-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 01:16 PM
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
-- Database: `online_quran_tutor_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `id` int(11) NOT NULL,
  `deadline_material_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment_submissions`
--

INSERT INTO `assignment_submissions` (`id`, `deadline_material_id`, `user_id`, `file_path`, `submitted_at`) VALUES
(3, 6, 8, '8_9912070075.png', '2024-07-20 12:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `class_notification`
--

CREATE TABLE `class_notification` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `class_date` date DEFAULT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_notification`
--

INSERT INTO `class_notification` (`id`, `course_id`, `user_id`, `title`, `content`, `class_date`, `from_time`, `to_time`, `created_at`) VALUES
(2, 3, 2, 'Aut labore modi elig', 'Iusto sed labore aut', '1970-10-15', '07:31:00', '20:07:00', '2024-08-16 10:52:13'),
(3, 1, 2, 'Nam quis ipsam labor', 'Tempor modi molestia', '2024-08-22', '20:00:00', '18:53:00', '2024-08-16 10:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(20,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `price`, `created_at`) VALUES
(1, 'Hafiz Quran', 'This is for Hafiz Quran', 500.00, '2024-07-16 14:17:49'),
(3, 'Nazra', 'THis is Nazra', 600.00, '2024-07-16 16:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `course_instructor_assigned`
--

CREATE TABLE `course_instructor_assigned` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_instructor_assigned`
--

INSERT INTO `course_instructor_assigned` (`id`, `course_id`, `instructor_id`, `assigned_at`) VALUES
(1, 1, 9, '2024-07-16 18:57:58'),
(3, 1, 2, '2024-07-16 18:58:16'),
(4, 3, 2, '2024-07-17 13:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `course_materials`
--

CREATE TABLE `course_materials` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_materials`
--

INSERT INTO `course_materials` (`id`, `course_id`, `user_id`, `title`, `content`, `file_path`, `created_at`) VALUES
(7, 1, 2, 'Video', 'rauf', '2_4759740800.mp4', '2024-07-18 16:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `course_registration`
--

CREATE TABLE `course_registration` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `receipt_path` varchar(255) DEFAULT NULL,
  `price` decimal(20,2) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_registration`
--

INSERT INTO `course_registration` (`id`, `course_id`, `user_id`, `transaction_no`, `receipt_path`, `price`, `payment_status`, `created_at`) VALUES
(3, 1, 1, '56465456465465', '1_1725893375.jpg', 500.00, 'Rejected', '2024-08-15 09:30:25'),
(4, 3, 1, '75674878768', '1_3160211571.png', 600.00, 'Verified', '2024-08-15 09:31:29'),
(5, 1, 8, '65448972', '8_3254293241.jpg', 500.00, 'Pending', '2024-08-16 13:15:28'),
(6, 3, 8, '874654654', '8_4020376962.jpg', 600.00, 'Pending', '2024-08-16 13:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `deadline_materials`
--

CREATE TABLE `deadline_materials` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('lecture','assignment','quiz') NOT NULL,
  `content` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deadline_materials`
--

INSERT INTO `deadline_materials` (`id`, `course_id`, `user_id`, `title`, `type`, `content`, `file_path`, `from_date`, `to_date`, `created_at`) VALUES
(4, 1, 2, 'fgfdgsfd g', 'lecture', '23312afdsafdfd', '2_6935292541.pdf', '2024-07-17', '2024-07-26', '2024-07-17 12:47:07'),
(5, 3, 2, 'ghfdhgfdh', 'assignment', 'hgfhfdghgfdh', '2_3915731912.docx', '2024-07-17', '2024-08-15', '2024-07-17 13:12:16'),
(6, 1, 2, 'dsfdsgfdgf', 'assignment', 'fgfdsgertr', '2_2333576706.docx', '2024-07-18', '2024-08-31', '2024-07-18 14:21:15'),
(7, 1, 2, 'Question No:1', 'quiz', 'the question is the like jnkashd jhj  hsdjsahj', '2_3832170304.png', '2024-07-20', '2024-07-25', '2024-07-20 15:49:49');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doc_title` enum('cnic','passport','degree','certificate','cv') NOT NULL,
  `doc_file_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `doc_title`, `doc_file_name`, `created_at`) VALUES
(6, 2, 'cnic', '1727521301_8_9912070075.png', '2024-09-28 11:01:41'),
(7, 2, 'passport', '1727521311_CuisineSnap_AI.pdf', '2024-09-28 11:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `no_of_year` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file_upload` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id`, `user_id`, `company_name`, `job_title`, `no_of_year`, `start_date`, `end_date`, `description`, `file_upload`, `created_at`) VALUES
(2, 2, 'sfdsfas', 'adsfdsfsdafsff', NULL, '2024-09-17', '2024-09-11', 'dFDsfadfzvcxvzxcv', '1727521274_CuisineSnap_AI.pdf', '2024-09-28 11:01:14'),
(3, 2, 'vcxzvfdhshgfh', 'ghgfhhghfg', NULL, '2024-09-28', '2024-09-07', 'bncnnb', '1727521292_8_3254293241.jpg', '2024-09-28 11:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Student'),
(2, 'Tutor'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cnic` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `quranic_qualification` enum('Haifz','Tajweed','Tafseer','Nazra','Basic_Language_Courses','Other_Relevant_Qualification') DEFAULT 'Haifz',
  `profile_photo` varchar(255) DEFAULT NULL,
  `upload_cv` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `cnic`, `date_of_birth`, `gender`, `age`, `address`, `phone`, `quranic_qualification`, `profile_photo`, `upload_cv`, `password`, `role_id`, `isActive`, `created_at`) VALUES
(1, 'student', 'student@gmail.com', NULL, NULL, 'Male', NULL, '', '', 'Haifz', '1721137070_SCO.png', NULL, '$2y$10$cQPzUVw8ZD8K2t2kaVCM6.Hu.wfMX4lu7xbz8OGSDp0OhqIYStS2.', 1, 1, '2024-07-15 19:07:31'),
(2, 'Mulajan123', 'ins@gmail.com', NULL, NULL, 'Female', NULL, 'Village Waligai P/O Waligai Tehsel Domail District Bannu', '03366645807', 'Haifz', '1721137054_Python_Libraries_for_Data_Science__1_.jpg', NULL, '$2y$10$cQPzUVw8ZD8K2t2kaVCM6.Hu.wfMX4lu7xbz8OGSDp0OhqIYStS2.', 2, 1, '2024-07-15 18:40:09'),
(3, 'admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, 'Village Waligai P/O Waligai Tehsel Domail District Bannu', '03366645807', 'Haifz', '3_Snapchat-1153098798-removebg.png', NULL, '$2y$10$j2XFr7difFJRtl2oF9K7ROYW.65SjWD/WbvL7xn/m2eIn94N9BB0W', 3, 1, '2024-07-15 19:07:31'),
(8, 'kaleeem', 'kaleem@gmail.com', NULL, NULL, 'Female', NULL, '', '', 'Haifz', '1721137084_1208507_amazing_gaming_wallpapers_hd_3840x2160.jpg', NULL, '$2y$10$KnNvr1GTyeSPzToCCiZTS.25q.KSHj62/jQ8P4oaJHQAqIjztj.De', 1, 1, '2024-07-16 10:18:01'),
(9, 'AsadKhan2', 'asad2@gmail.com', NULL, NULL, 'Male', NULL, '2 Village Waligai P/O Waligai Tehsel Domail District Bannu', '03362222222', 'Haifz', '1721136406_University.png', NULL, '$2y$10$XvbEq4V5NY2Z3F.AiiIUNuIDRv85h9vkjEuYrznbRf3nrwoOTC1a2', 2, 1, '2024-07-16 10:19:17'),
(11, 'kaleemjani', 'kaleemjani@gmail.com', NULL, NULL, 'Male', NULL, '', '', 'Haifz', '1722261632_dino_reichmuth_5Rhl_kSRydQ_unsplash.jpg', NULL, '$2y$10$Elz/Cjk.UVHmkJ5HUjl/j.O1T34KcibM7dIMDZiRqPbYru4w/w.cu', 2, 1, '2024-07-29 13:51:07'),
(16, 'raufjanan', 'raufjanan@gmail.com', NULL, NULL, 'Male', NULL, NULL, NULL, 'Haifz', NULL, NULL, '$2y$10$w1jSXdGhxNybUmYMoy1Mo.jug9bK0yq0ay9q3iQ0eOaRUBYo6LcB.', 1, 1, '2024-07-29 15:28:39'),
(18, 'admingdfgfdg', 'raufkhalid90@hotmail.com', NULL, NULL, 'Male', NULL, NULL, NULL, 'Haifz', NULL, NULL, '$2y$10$GxzP1nzRy.0az65PDfR.yusGXAmdnYK/tWsKnclstxCP.fM4gNmL.', 1, 1, '2024-07-29 15:32:55'),
(19, 'kaleem212', 'kaleem212@gmail.com', NULL, NULL, 'Male', NULL, NULL, NULL, 'Haifz', NULL, NULL, '$2y$10$4ibYUh6xiGqsv3zjtf9MoeWHjJ2wl.Wk909Lzs94aEN7iK71yduy.', 1, 1, '2024-07-29 15:34:51'),
(21, 'vihajej', 'jopyladihu@mailinator.com', '1213216546549', '1973-09-11', 'Female', 85, 'Repellendus Ad mole', '+1 (651) 912-9879', 'Tajweed', '1726375088_2_3832170304.png', NULL, '$2y$10$Kn0c3cPHXa2T7OVoeJTsiu3CXOZVqlTZ2KM3IV9l0CDRmdRwPMsQi', 2, 1, '2024-09-15 04:38:08'),
(22, 'zavowyt', 'pecif@mailinator.com', 'Similique qui', '2015-06-20', 'Other', 12, 'Ad accusantium iure ', '+1 (585) 634-8761', 'Other_Relevant_Qualification', '1727512581_Hot_Dog___Train__1_.jpg', NULL, '$2y$10$zOSbCcITQo29lNsz0vFPTObIuNrGdyRHgC6NWPvLIIAV8822xLRhK', 1, 0, '2024-09-28 08:36:21'),
(23, 'juteb', 'nukoce@mailinator.com', 'Amet reprehe', '1982-07-12', 'Male', 8, 'Molestias fugiat du', '+1 (327) 929-5253', 'Haifz', '1727513528_DALL__E_2024_09_25_21.48.30___An_updated_modern_logo_for_a_tech_startup_named__Ezee_SOl_Tech_._The_design_should_incorporate_a_sleek_and_minimal_smartphone_and_web_browser_icon_to_.webp', '1727513528_CuisineSnap_AI.pdf', '$2y$10$ANicViFeii.J9ipcURDlB.lxenh/kcy.tHjmKRAtpPmxywK5zzdPO', 2, 0, '2024-09-28 08:52:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deadline_material_id` (`deadline_material_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `class_notification`
--
ALTER TABLE `class_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_instructor_assigned`
--
ALTER TABLE `course_instructor_assigned`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `course_materials`
--
ALTER TABLE `course_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_registration`
--
ALTER TABLE `course_registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `deadline_materials`
--
ALTER TABLE `deadline_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_ibfk_1` (`user_id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiences_ibfk_1` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class_notification`
--
ALTER TABLE `class_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_instructor_assigned`
--
ALTER TABLE `course_instructor_assigned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_materials`
--
ALTER TABLE `course_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_registration`
--
ALTER TABLE `course_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deadline_materials`
--
ALTER TABLE `deadline_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD CONSTRAINT `assignment_submissions_ibfk_1` FOREIGN KEY (`deadline_material_id`) REFERENCES `deadline_materials` (`id`),
  ADD CONSTRAINT `assignment_submissions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `course_instructor_assigned`
--
ALTER TABLE `course_instructor_assigned`
  ADD CONSTRAINT `course_instructor_assigned_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_instructor_assigned_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_materials`
--
ALTER TABLE `course_materials`
  ADD CONSTRAINT `course_materials_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_materials_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_registration`
--
ALTER TABLE `course_registration`
  ADD CONSTRAINT `course_registration_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_registration_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deadline_materials`
--
ALTER TABLE `deadline_materials`
  ADD CONSTRAINT `deadline_materials_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deadline_materials_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
