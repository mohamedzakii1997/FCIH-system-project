-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2018 at 12:24 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `englishName` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `englishName`, `username`, `password`, `email`, `remember_token`, `profilePicture`) VALUES
(1, 'waleed', 'waleed', '$2y$10$mFoCiUehOVuD1llLlxy7A.tvCv5AhofGvrGJMUGqp3j7Xpi5yfFDu', 'waleed@gmail.com', 'AbRr6lE8gqJCjTUX8CFV9h3N6qi6yczPKkKF9ZjdSRRjG0ueQ6jnGYBzPRhz', 'admins/1/IHkTMx0BxbUyslctbAlXxv8xasjLHf6yqyN25eOa.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `professor_id` int(10) UNSIGNED NOT NULL,
  `header` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assistants`
--

CREATE TABLE `assistants` (
  `id` int(10) UNSIGNED NOT NULL,
  `englishName` varchar(50) NOT NULL,
  `arabicName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salary` decimal(7,2) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `SSN` char(20) NOT NULL,
  `mainDepartmentId` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assistants`
--

INSERT INTO `assistants` (`id`, `englishName`, `arabicName`, `email`, `username`, `password`, `salary`, `gender`, `SSN`, `mainDepartmentId`, `remember_token`, `profilePicture`) VALUES
(4, 'Amr hamza', 'عمرو حمزه', 'amr@gmail.com', 'amrhamza', '$2y$10$GbO5HEz8wx8DTTNJ3zPAkOKrzcpnVoUtypuZ5//aVbZkSIwmQtN0e', '3000.00', 'Male', '56545654', 3, NULL, 'assistants/4/LTYFfTQRt93asZwBSrrfYI5zE3iK14pEkWxWGJfo.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `assistant_course`
--

CREATE TABLE `assistant_course` (
  `assistantId` int(10) UNSIGNED NOT NULL,
  `courseId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assistant_course`
--

INSERT INTO `assistant_course` (`assistantId`, `courseId`) VALUES
(4, 14),
(4, 15),
(4, 22),
(4, 24),
(4, 26),
(4, 27),
(4, 28),
(4, 29),
(4, 36),
(4, 38),
(4, 39),
(4, 40);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `courseCode` varchar(8) NOT NULL,
  `hours` tinyint(2) UNSIGNED NOT NULL DEFAULT '3',
  `englishName` varchar(50) NOT NULL,
  `arabicName` varchar(50) NOT NULL,
  `departmentId` int(10) UNSIGNED NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `totalGrade` tinyint(3) UNSIGNED NOT NULL DEFAULT '100',
  `finalGrade` tinyint(3) UNSIGNED NOT NULL DEFAULT '60',
  `midtermGrade` tinyint(2) UNSIGNED NOT NULL DEFAULT '20',
  `prerequisiteCourseId` int(10) UNSIGNED DEFAULT NULL,
  `category` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `courseCode`, `hours`, `englishName`, `arabicName`, `departmentId`, `available`, `totalGrade`, `finalGrade`, `midtermGrade`, `prerequisiteCourseId`, `category`) VALUES
(14, 'HU111', 2, 'English 1', 'لغة إنجليزية -1', 2, 1, 100, 60, 20, NULL, 1),
(15, 'HU112', 2, 'English 2', 'لغة إنجليزية -2', 2, 1, 100, 60, 20, 14, 1),
(16, 'HU313', 2, 'human rights', 'حقوق الإنسان', 2, 0, 100, 60, 20, NULL, 1),
(17, 'HU121', 3, 'Fundamentals of Economics', 'مبادئ الاقتصاد', 2, 0, 100, 60, 20, NULL, 0),
(18, 'HU331', 3, 'Fundamentals of Accounting', 'مبادئ المحاسبة', 2, 0, 100, 60, 20, NULL, 0),
(19, 'HU332', 3, 'Creative Thinking', 'التفكير الإبداعي', 2, 0, 100, 60, 20, NULL, 0),
(20, 'HU333', 3, 'Mass Communication', 'الإعلام', 2, 0, 100, 60, 20, NULL, 0),
(21, 'HU334', 3, 'Professional Ethics', 'أخلاقيات المهنة', 2, 0, 100, 60, 20, NULL, 0),
(22, 'MA111', 3, 'Mathematics – 1', 'رياضيات – 1', 1, 1, 100, 60, 20, NULL, 1),
(23, 'MA112', 3, 'Discrete Mathematics', 'تراكيب محددة', 1, 0, 100, 60, 20, NULL, 1),
(24, 'MA113', 3, 'Mathematics – 2', 'رياضيات – 2', 1, 1, 100, 60, 20, 22, 1),
(25, 'ST121', 3, 'Probability and Statistics 1', 'إحصاء واحتمالات – 1', 1, 0, 100, 60, 20, NULL, 1),
(26, 'IT111', 3, 'Electronics', 'الكترونيات – 1', 1, 1, 100, 60, 20, NULL, 1),
(27, 'PH111', 3, 'Physics', 'فيزياء', 1, 1, 100, 60, 20, NULL, 1),
(28, 'CS111', 3, 'Introduction to Computers', 'مقدمة فى الحاسبات', 1, 1, 100, 60, 20, NULL, 1),
(29, 'CS112', 3, 'Programming – 1', 'برمجة الحاسبات – 1', 1, 1, 100, 50, 20, 28, 1),
(30, 'CS221', 3, 'Logic Design', 'تصميم منطقي', 1, 0, 100, 60, 20, NULL, 1),
(31, 'CS214', 3, 'Data Structures', 'هياكل البيانات', 1, 0, 100, 50, 20, 29, 1),
(32, 'CS316', 3, 'Algorithms', 'خوارزميات', 1, 0, 100, 50, 20, 29, 1),
(33, 'IT221', 3, 'Data Communication', 'تراسل البيانات', 1, 0, 100, 60, 20, NULL, 1),
(34, 'IS240', 3, 'Operations Research', 'بحوث العمليات', 1, 0, 100, 60, 20, NULL, 1),
(35, 'HU122', 3, 'Fundamentals of Management', 'مبادئ الإدارة', 1, 0, 100, 60, 20, NULL, 1),
(36, 'IS231', 3, 'Fundamentals of Information Systems', 'أساسيات نظم المعلومات', 1, 1, 100, 60, 20, NULL, 1),
(37, 'IS211', 3, 'Database System – 1', 'نظم قواعد البيانات – 1', 1, 0, 100, 50, 20, NULL, 1),
(38, 'IT222', 3, 'Computer Networks – 1', 'شبكات الحاسبات – 1', 1, 1, 100, 60, 20, 33, 1),
(39, 'IT223', 3, 'Internet Technology', 'تكنولوجيا الإنترنت', 1, 1, 100, 50, 20, NULL, 1),
(40, 'CS241', 3, 'Operating Systems – 1', 'نظم التشغيل – 1', 1, 1, 100, 50, 20, 29, 1),
(41, 'CS251', 3, 'Software Engineering – 1', 'هندسة البرمجيات – 1', 1, 1, 100, 50, 20, 28, 1),
(42, 'CS213', 3, 'Programming – 2', 'برمجة الحاسبات – 2', 1, 0, 100, 50, 20, 29, 1),
(43, 'ST122', 3, 'Probability and Statistics – 2', 'إحصاء واحتمالات – 2', 1, 0, 100, 60, 20, 25, 0),
(44, 'IS351', 3, 'System Analysis and Design - 1', 'تحليل و تصميم نظم المعلومات - 1', 1, 0, 100, 60, 20, NULL, 0),
(45, 'MA214', 3, 'Mathematics – 3', 'رياضيات – 3', 1, 0, 100, 60, 20, 24, 0),
(46, 'IS321', 3, 'Projects Management', 'إدارة المشروعات', 1, 0, 100, 60, 20, NULL, 0),
(47, 'IT241', 3, 'Signals and Systems', 'إشارات ونظم', 1, 0, 100, 60, 20, 24, 0),
(48, 'IS342', 3, 'Simulation Languages', 'لغات المحاكاة', 1, 0, 100, 60, 20, 51, 0),
(49, 'CS313', 3, 'Programming – 3', 'برمجة الحاسبات – 3', 1, 0, 100, 60, 20, 42, 0),
(50, 'IT211', 3, 'Computer Maintenance', 'صيانة الحاسب', 1, 0, 100, 60, 20, NULL, 0),
(51, 'IS241', 3, 'Modeling and Simulation', 'النمذجة والمحاكاة', 1, 0, 100, 60, 20, NULL, 0),
(52, 'CS317', 3, 'Concepts of Programming Languages', 'مفاهيم لغات الحاسب', 6, 0, 100, 60, 20, 42, 1),
(53, 'CS322', 3, 'Computer Organization', 'تنظيم الحاسبات', 6, 0, 100, 60, 20, 30, 1),
(54, 'CS494', 3, 'Selected Topics in Computer Science- 1', 'موضوعات مختارة فى علوم الحاسب-1', 6, 0, 100, 60, 20, 42, 1),
(55, 'CS342', 3, 'Operating Systems – 2', 'نظم التشغيل – 2', 6, 0, 100, 60, 20, 40, 1),
(56, 'CS352', 3, 'Software Engineering – 2', 'هندسة البرمجيات – 2', 6, 0, 100, 60, 20, 41, 1),
(57, 'CS433', 3, 'Computer Vision', 'الرؤية بالحاسب', 6, 0, 100, 60, 20, 32, 1),
(58, 'CS361', 3, 'Artificial Intelligence', 'الذكاء الاصطناعي', 6, 0, 100, 60, 20, 29, 1),
(59, 'CS419', 3, 'Compilers', 'المترجمات', 6, 0, 100, 60, 20, 31, 1),
(60, 'CS498', 6, 'Project', 'مشروع', 6, 0, 200, 200, 0, 59, 1),
(61, 'CS423', 3, 'Advanced Computer Organization', 'تنظيم حاسبات متقدم', 6, 0, 100, 60, 20, 30, 0),
(62, 'CS462', 3, 'Natural Languages Processing', 'معالجة اللغات الطبيعية', 6, 0, 100, 60, 20, 42, 0),
(63, 'CS471', 3, 'Parallel Processing', 'المعالجة على التوازي', 6, 0, 100, 60, 20, 42, 0),
(64, 'CS318', 3, 'Assembly Language', 'لغة التجميع', 6, 0, 100, 60, 20, 42, 0),
(65, 'CS396', 3, 'Selected Topics in Computer Science – 2', 'موضوعات مختارة فى علوم الحاسب-2', 6, 0, 100, 60, 20, 54, 0),
(66, 'CS495', 3, 'Selected Topics in Computer Science-3', 'موضوعات مختارة فى علوم الحاسب-3', 6, 0, 100, 60, 20, 65, 0),
(67, 'CS496', 3, 'Selected Topics in Computer Science-4', 'موضوعات مختارة فى علوم الحاسب-4', 6, 0, 100, 60, 20, 66, 0),
(68, 'IS345', 3, 'Internet Applications', 'تطبيقات الإنترنت', 3, 0, 100, 60, 20, 39, 1),
(69, 'IS312', 3, 'Database Systems – 2', 'نظم قواعد البيانات – 2', 3, 0, 100, 60, 20, 37, 1),
(70, 'IS313', 3, 'Inf.Storage and Retrieval', 'تخزين واسترجاع البيانات', 3, 0, 100, 60, 20, 37, 1),
(71, 'IS359', 3, 'Analysis and Design of Information Systems –1', 'تحليل وتصميم نظم المعلومات – 1', 3, 0, 100, 60, 20, 61, 1),
(72, 'IS352', 3, 'Analysis and Design of Information Systems-2', 'تحليل وتصميم نظم المعلومات – 2', 3, 0, 100, 60, 20, 71, 1),
(73, 'IS414', 3, 'Information Systems Security', 'تأمين نظم المعلومات', 3, 0, 100, 60, 20, 37, 1),
(74, 'IS451', 3, 'Decision Support Systems', 'نظم دعم اتخاذ القرار', 3, 1, 100, 60, 20, 36, 1),
(75, 'IS333', 3, 'Management Information Systems', 'نظم المعلومات الإدارية', 3, 1, 100, 60, 20, 36, 1),
(76, 'IS498', 6, 'Project', 'مشروع', 3, 0, 200, 100, 0, 72, 1),
(77, 'IS421', 3, 'Data Mining', 'التنقيب فى البيانات', 3, 0, 100, 60, 20, 37, 0),
(78, 'IS415', 3, 'Object Oriented Database', 'قواعد البيانات الشيئية', 3, 0, 100, 60, 20, 37, 0),
(79, 'IS453', 3, 'Information Systems Development Methodologies', 'منهجيات تطوير نظم المعلومات', 3, 0, 100, 60, 20, 72, 0),
(80, 'IS441', 3, 'Intelligent Information Systems', 'نظم المعلومات الذكية', 3, 0, 100, 60, 20, 69, 0),
(81, 'IS442', 3, 'E-Commerce', 'التجارة الإلكترونية', 3, 0, 100, 60, 20, 68, 0),
(83, 'IS435', 3, 'Information Centers Management', 'إدارة مراكز المعلومات', 3, 0, 100, 60, 20, 69, 0),
(84, 'IS334', 3, 'Accounting Information Systems', 'نظم المعلومات المحاسبية', 3, 0, 100, 60, 20, 69, 0),
(85, 'IS422', 3, 'Data Warehousing', 'مستودعات البيانات', 3, 0, 100, 60, 20, 69, 0),
(86, 'IS416', 3, 'Distributed Database', 'قواعد البيانات الموزعة', 3, 0, 100, 60, 20, 69, 0),
(87, 'IT311', 3, 'Computer Architecture', 'عمارة الحاسبات', 4, 0, 100, 60, 20, 30, 1),
(88, 'IT321', 3, 'Communication Technology', 'تكنولوجيا الاتصالات', 4, 0, 100, 60, 20, 33, 1),
(89, 'IT322', 3, 'Computers Network –2', 'شبكات الحاسبات – 2', 4, 0, 100, 60, 20, 38, 1),
(90, 'IT331', 3, 'Computer Graphics – 1', 'نظم الرسم بالحاسب – 1', 4, 0, 100, 60, 20, 42, 1),
(91, 'IT341', 3, 'Digital Signal Processing', 'معالجة الإشارات الرقمية', 4, 0, 100, 60, 20, 47, 1),
(92, 'IT342', 3, 'Pattern Recognitions', 'Pattern Recognitions', 4, 0, 100, 60, 20, 38, 1),
(93, 'IT433', 3, 'Multimedia', 'الوسائط المتعددة', 4, 0, 100, 60, 20, 42, 1),
(94, 'IT441', 3, 'Image Processing – 1', 'معالجة الصور -1', 4, 0, 100, 60, 20, 32, 1),
(95, 'IT498', 6, 'Project', 'مشروع', 4, 0, 200, 200, 0, 94, 1),
(96, 'IT411', 3, 'Distributed and Parallel systems', 'نظم الحاسبات الموزعة والمتوازية', 4, 0, 100, 60, 20, 87, 0),
(97, 'IT412', 3, 'Real Time Systems', 'نظم الزمن الحقيقي', 4, 0, 100, 60, 20, 87, 0),
(98, 'IT431', 3, 'Virtual Reality', 'الواقع الافتراضي', 4, 0, 100, 60, 20, 87, 0),
(99, 'IT332', 3, 'Computer Graphics – 2', 'نظم الرسم بالحاسب – 2', 4, 0, 100, 60, 20, 90, 0),
(100, 'IT414', 3, 'Embedded Systems', 'النظم المدمجة', 4, 0, 100, 60, 20, 87, 0),
(101, 'IT442', 3, 'Image Processing – 2', 'معالجة الصور -2', 4, 0, 100, 60, 20, 94, 0),
(102, 'IT423', 3, 'Information and Networks Security', 'تأمين شبكات والمعلومات', 4, 0, 100, 60, 20, 87, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_evaluations`
--

CREATE TABLE `course_evaluations` (
  `courseId` int(10) UNSIGNED NOT NULL,
  `studentId` int(10) UNSIGNED NOT NULL,
  `value` tinyint(2) NOT NULL DEFAULT '0',
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_professor`
--

CREATE TABLE `course_professor` (
  `courseId` int(10) UNSIGNED NOT NULL,
  `professorId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_professor`
--

INSERT INTO `course_professor` (`courseId`, `professorId`) VALUES
(14, 3),
(15, 3),
(15, 4),
(22, 3),
(24, 4),
(26, 3),
(27, 3),
(28, 3),
(29, 4),
(36, 3),
(36, 4),
(38, 4),
(40, 4),
(41, 4),
(74, 4),
(75, 4);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `symbol` char(4) NOT NULL,
  `mandatory` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `optional` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `symbol`, `mandatory`, `optional`) VALUES
(1, 'College', 'GE', 63, 9),
(2, 'University', 'Uv', 6, 6),
(3, 'Information System', 'IS', 30, 15),
(4, 'Information Technology', 'IT', 30, 15),
(6, 'Computer Science', 'CS', 30, 15);

-- --------------------------------------------------------

--
-- Table structure for table `exceptional_requests`
--

CREATE TABLE `exceptional_requests` (
  `studentId` int(10) UNSIGNED NOT NULL,
  `courseId` int(10) UNSIGNED NOT NULL,
  `message` text,
  `reason` enum('Needed To Finish My Last Semester','Needed to Register a Department Next Semester','My GPA More Than 3.4') NOT NULL,
  `answer` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int(10) UNSIGNED NOT NULL,
  `professorId` int(10) UNSIGNED NOT NULL,
  `courseId` int(10) UNSIGNED NOT NULL,
  `location` varchar(10) NOT NULL,
  `duration` tinyint(1) NOT NULL DEFAULT '3',
  `day` tinyint(1) UNSIGNED NOT NULL,
  `time` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `professorId`, `courseId`, `location`, `duration`, `day`, `time`) VALUES
(1, 3, 14, 'hall 200', 3, 0, 9),
(2, 3, 22, 'hall200', 3, 0, 12),
(3, 3, 26, 'hall', 3, 0, 15),
(4, 3, 27, 'hall112', 3, 1, 9),
(5, 3, 28, 'hal 21', 3, 1, 13),
(6, 3, 36, 'hall1', 3, 2, 15),
(7, 3, 14, 'hal1', 3, 2, 9),
(8, 3, 27, 'hall 191', 3, 4, 15),
(9, 4, 15, 'hal 193', 3, 0, 9),
(10, 4, 24, 'hall', 3, 0, 12),
(11, 4, 29, 'hall 12', 3, 2, 12),
(12, 4, 38, 'hall 92', 3, 1, 13),
(13, 4, 36, 'hall 82', 3, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_id`, `notifiable_type`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('05d3bb05-9561-4739-ae20-4c0578f2201e', 'App\\Notifications\\PuchNotification', 1, 'App\\Admin', '{"studentName":"ahmed","reason":"Needed To Finish My Last Semester"}', '2018-04-19 15:04:43', '2018-04-19 15:04:35', '2018-04-19 15:04:43'),
('09b6c0b5-4efb-42f5-bdf9-492171357945', 'App\\Notifications\\PuchNotification', 1, 'App\\Student', '{"header":"ahmed","description":"ahmed anta fan yabny"}', '2018-03-27 10:26:55', '2018-03-27 10:26:29', '2018-03-27 10:26:55'),
('1196061a-63f7-410b-9cfe-8e37f07b57af', 'App\\Notifications\\PuchNotification', 1, 'App\\Admin', '{"studentName":"ahmed","reason":"My GPA More Than 3.4"}', '2018-04-19 14:55:05', '2018-04-19 14:40:14', '2018-04-19 14:55:05'),
('446bb141-b6eb-4a3c-b42a-ee43983eff9e', 'App\\Notifications\\PuchNotification', 1, 'App\\Student', '{"header":"ahmed tany","description":"ahmed tanyyyyyyyy"}', '2018-03-27 11:02:38', '2018-03-27 11:02:09', '2018-03-27 11:02:38'),
('672d3dc6-4dbb-4896-b88b-e8ac1a619927', 'App\\Notifications\\PuchNotification', 1, 'App\\Student', '{"header":"bbbc","description":"bbc"}', '2018-03-27 11:42:22', '2018-03-27 11:41:58', '2018-03-27 11:42:22'),
('a19d7cb1-298b-4810-8ae6-76e37802cf4f', 'App\\Notifications\\PuchNotification', 1, 'App\\Student', '{"header":"we","description":"we"}', '2018-03-27 11:45:36', '2018-03-27 11:44:56', '2018-03-27 11:45:36'),
('b4bdd11d-0340-4978-8e64-3616bb6e2e6c', 'App\\Notifications\\PuchNotification', 1, 'App\\Student', '{"header":"ahmed","description":"ahmed"}', '2018-03-27 11:49:54', '2018-03-27 11:49:31', '2018-03-27 11:49:54'),
('b63139c4-4826-41b3-8510-c573f162b1f7', 'App\\Notifications\\PuchNotification', 1, 'App\\Student', '{"header":"abc","description":"abc"}', '2018-03-27 11:37:15', '2018-03-27 11:37:04', '2018-03-27 11:37:15'),
('b6d00624-eb99-493d-9c8c-d87b2c396824', 'App\\Notifications\\PuchNotification', 1, 'App\\Student', '{"header":"ww","description":"ww"}', '2018-03-27 11:47:40', '2018-03-27 11:47:25', '2018-03-27 11:47:40'),
('ba75f128-42ea-4464-90d3-3c7f745b650a', 'App\\Notifications\\PuchNotification', 1, 'App\\Student', '{"header":"new notification","description":"there are the description of the notification"}', '2018-03-27 13:57:53', '2018-03-27 13:57:49', '2018-03-27 13:57:53'),
('bfa73a91-6571-4481-b583-42d9dacac834', 'App\\Notifications\\PuchNotification', 1, 'App\\Student', '{"header":"new","description":"new"}', '2018-03-27 11:48:32', '2018-03-27 11:48:22', '2018-03-27 11:48:32'),
('d1b31062-f24c-40e3-aa7d-bdbb615bd7ce', 'App\\Notifications\\PuchNotification', 1, 'App\\Student', '{"header":"afkws","description":"flkfj"}', '2018-03-27 11:55:02', '2018-03-27 11:54:44', '2018-03-27 11:55:02'),
('ffcdb3ca-444f-4e23-9c7c-a002d67353c5', 'App\\Notifications\\PuchNotification', 1, 'App\\Student', '{"header":"art","description":"art"}', '2018-03-27 11:49:09', '2018-03-27 11:48:56', '2018-03-27 11:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id` int(10) UNSIGNED NOT NULL,
  `englishName` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `SSN` char(20) NOT NULL,
  `arabicName` varchar(50) NOT NULL,
  `salary` decimal(7,2) UNSIGNED NOT NULL,
  `mainDepartmentId` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`id`, `englishName`, `username`, `password`, `email`, `gender`, `SSN`, `arabicName`, `salary`, `mainDepartmentId`, `remember_token`, `profilePicture`) VALUES
(3, 'Mustfa Ali', 'mustfaali', '$2y$10$3H/55lQnburml.mn7C94q.XpxzmGAGEhSlzokpPerZd7/1ukYWMiu', 'mustfa@gmail.com', 'Male', '5676545676', 'مصطفى على', '3000.00', 3, NULL, 'professors/3/cf2PgdLZ871jH3UBGPmWOAxQvm7zr7MMVoLhlhCY.jpeg'),
(4, 'hossam hassen', 'hossamhassen', '$2y$10$sk6W.BmHS3/.CHpc5U6U4OBwLeQykBeWv75fV.IVHR.Vr.ZVxMXeK', 'hossam@gmail.com', 'Male', '5654345654', 'حسام حسن', '5000.00', 6, NULL, 'professors/4/n5FhAx6eT3NhSljwYPW2A78XkFKG876LePkeINdc.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `courseId` int(10) UNSIGNED NOT NULL,
  `studentId` int(10) UNSIGNED NOT NULL,
  `fingalGrade` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `midtermGrade` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `classworkGrade` tinyint(2) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resourses`
--

CREATE TABLE `resourses` (
  `id` int(10) UNSIGNED NOT NULL,
  `courseId` int(10) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` enum('lecture','section') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `grade` int(10) UNSIGNED NOT NULL,
  `rate` enum('F','D','D+','C','C+','B','B+','A','A+') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `student_id`, `course_id`, `grade`, `rate`) VALUES
(13, 3, 14, 88, 'A'),
(14, 3, 22, 77, 'B'),
(15, 3, 26, 85, 'A'),
(16, 3, 27, 36, 'F'),
(17, 3, 28, 36, 'F'),
(18, 3, 36, 82, 'B+'),
(19, 3, 23, 80, 'B+'),
(20, 3, 27, 59, 'D'),
(21, 3, 28, 64, 'D'),
(22, 3, 30, 79, 'B'),
(23, 3, 33, 86, 'A'),
(24, 3, 39, 89, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `courseId` int(10) UNSIGNED NOT NULL,
  `assistantId` int(10) UNSIGNED NOT NULL,
  `location` varchar(10) NOT NULL,
  `duration` tinyint(1) UNSIGNED NOT NULL DEFAULT '2',
  `day` tinyint(1) UNSIGNED NOT NULL,
  `time` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `courseId`, `assistantId`, `location`, `duration`, `day`, `time`) VALUES
(1, 14, 4, 'hall2', 2, 0, 9),
(2, 14, 4, 'hall12', 2, 0, 11),
(3, 22, 4, 'hll12', 2, 0, 13),
(4, 22, 4, 'hall29', 2, 0, 15),
(5, 15, 4, 'hall59', 2, 1, 9),
(6, 15, 4, 'hall 95', 2, 1, 11),
(7, 24, 4, 'hll', 2, 1, 13),
(8, 24, 4, 'hall 50', 2, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `status`) VALUES
(1, 'course registration', 0),
(2, 'table', 1),
(3, 'exceptional requests', 1),
(4, 'my courses', 1),
(5, 'department registration', 0),
(6, 'transcript', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `englishName` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `arabicName` varchar(50) NOT NULL,
  `level` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `GPA` decimal(3,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `gender` enum('Male','Female') NOT NULL,
  `SSN` char(20) NOT NULL,
  `hours` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `mainDepartmentId` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `englishName`, `username`, `password`, `email`, `arabicName`, `level`, `GPA`, `gender`, `SSN`, `hours`, `mainDepartmentId`, `remember_token`, `profilePicture`) VALUES
(3, 'Mohmed Zaki', 'mohamedzaki', '$2y$10$JucL.cJfEKbrWzINEnwIO.k9asd9qEapNv0TwlsJiEF.x7T.0stTe', 'mohamedZaki@gmail.com', 'محمد زكى', 1, '2.80', 'Male', '665456765456', 29, 1, '18wgt8q2ko8eXimnaSGHH10C89mEDH9lnEUiP6y9tOHQCYOi6toKzuZPFuYR', NULL),
(4, 'Ahmed Gamal', 'ahmedgamal', '$2y$10$qtfvXV1pu69xivTZkZ21..bv64rlmT1/F0djER7GS5t6cXgdUcPk6', 'ahmed@gmail.com', 'احمد جمال', 1, '0.00', 'Male', '566545445', 0, 1, 'SFXdq8HarRea8yxKSxM3oGNXjVjCC1alp6JQ5Q95DiDKE9JHyWdWF2VIECZr', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Indexes for table `assistants`
--
ALTER TABLE `assistants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `mainDepartmentId` (`mainDepartmentId`);

--
-- Indexes for table `assistant_course`
--
ALTER TABLE `assistant_course`
  ADD PRIMARY KEY (`assistantId`,`courseId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courseCode` (`courseCode`),
  ADD KEY `departmentId` (`departmentId`),
  ADD KEY `prerequisiteCourseId` (`prerequisiteCourseId`);

--
-- Indexes for table `course_evaluations`
--
ALTER TABLE `course_evaluations`
  ADD PRIMARY KEY (`courseId`,`studentId`),
  ADD KEY `studentId` (`studentId`);

--
-- Indexes for table `course_professor`
--
ALTER TABLE `course_professor`
  ADD PRIMARY KEY (`courseId`,`professorId`),
  ADD KEY `professorId` (`professorId`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exceptional_requests`
--
ALTER TABLE `exceptional_requests`
  ADD PRIMARY KEY (`studentId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professorId` (`professorId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `mainDepartmentId` (`mainDepartmentId`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`courseId`,`studentId`),
  ADD KEY `studentId` (`studentId`);

--
-- Indexes for table `resourses`
--
ALTER TABLE `resourses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assistantId` (`assistantId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `mainDepartmentId` (`mainDepartmentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `assistants`
--
ALTER TABLE `assistants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `resourses`
--
ALTER TABLE `resourses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `professors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assistants`
--
ALTER TABLE `assistants`
  ADD CONSTRAINT `assistants_ibfk_1` FOREIGN KEY (`mainDepartmentId`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assistant_course`
--
ALTER TABLE `assistant_course`
  ADD CONSTRAINT `assistant_course_ibfk_1` FOREIGN KEY (`assistantId`) REFERENCES `assistants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assistant_course_ibfk_2` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`departmentId`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`prerequisiteCourseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_evaluations`
--
ALTER TABLE `course_evaluations`
  ADD CONSTRAINT `course_evaluations_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_evaluations_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_professor`
--
ALTER TABLE `course_professor`
  ADD CONSTRAINT `course_professor_ibfk_1` FOREIGN KEY (`professorId`) REFERENCES `professors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_professor_ibfk_2` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exceptional_requests`
--
ALTER TABLE `exceptional_requests`
  ADD CONSTRAINT `exceptional_requests_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exceptional_requests_ibfk_2` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lectures`
--
ALTER TABLE `lectures`
  ADD CONSTRAINT `lectures_ibfk_1` FOREIGN KEY (`professorId`) REFERENCES `professors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lectures_ibfk_2` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `professors`
--
ALTER TABLE `professors`
  ADD CONSTRAINT `professors_ibfk_1` FOREIGN KEY (`mainDepartmentId`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resourses`
--
ALTER TABLE `resourses`
  ADD CONSTRAINT `resourses_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`assistantId`) REFERENCES `assistants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sections_ibfk_2` FOREIGN KEY (`assistantId`) REFERENCES `assistants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sections_ibfk_3` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`mainDepartmentId`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
