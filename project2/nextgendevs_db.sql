-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2026 at 09:38 AM
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
-- Database: `nextgendevs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE `aboutus` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `full_name` varchar(80) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `project_part1` text NOT NULL,
  `project_part2` text NOT NULL,
  `languages` varchar(80) NOT NULL,
  `fav_programming` varchar(50) NOT NULL,
  `quote_translated` varchar(100) NOT NULL,
  `quote_original` varchar(100) NOT NULL,
  `icon_source` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`id`, `student_id`, `full_name`, `nickname`, `role`, `project_part1`, `project_part2`, `languages`, `fav_programming`, `quote_translated`, `quote_original`, `icon_source`) VALUES
(1, 106225401, 'Ng Jing Yee', 'Jingyee', 'Organizer & Developer', 'Develop apply.html, Manage Github & Jira project, Give inputs on page design, Organize team communication', 'Maintain the project database, Develop EOI table, Develop server-side validataion for apply.php, Create process_eoi.php', 'Mandarin, Bahasa Melayu, & English', 'Python', 'Believe in yourself, and anything is possible', '相信自己，一切皆有可能', 'images/python.ico'),
(2, 106403058, 'Eaint Wunna Aung', 'Charlotte', 'Leader & Developer', 'Create jobs.html, Oversee the project progress and completion status, Act as a group representative, Give inputs on page design', 'Create settings.php and ensure database connection on the localhost, create jobs table and render job information from database to jobs.php', 'Burmese & English', 'Python', 'The things happen in a natural course of events', 'Phit yoe phit sin', 'images/python.ico'),
(3, 106399199, 'Ye Htet Aung', 'Louis', 'Editor & Developer', 'Create about.html & styles.css, Review & edit all files for consistency, formatting, and accessibility, Design the external css file', 'Create login.php with authentication from admin_login table, Create manage.php, Create aboutus table and load information from the table to about.php', 'Burmese, English, & German', 'Java', 'What you have is what you have', 'Was man hat, das hat man', 'images/java.ico'),
(4, 106201456, 'Amirul Afif', 'Afif', 'Manager & Developer', 'Create index.html & styles.css, Monitor the project workflow on Jira, Design the external css file', 'Organize file folder, Convert HTML files to PHP format, Convert shared HTML into .inc format and include in every php pages, Design presentation slides', 'Bahasa Melayu & English', 'Java', 'Stay calm', 'Kekal tenang', 'images/java.ico');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `username` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`username`, `pwd`) VALUES
('Admin', '$2y$10$Ea1xetsVQg/zBj6WnZSYl.IpUVahy2YG60Uk.S9PdICSlm6jf8CkC'),
('afif', '$2y$10$zYuBwyowmV9PYhcH4kcPyOxAidil1vavdqStxRyGnuv83PfcpygCe'),
('charlotte', '$2y$10$j3akQJRoVBap2CwxgiX7cuisJ4agrprDrZrkNlDbQVlTIbkkCGRZS'),
('jingyee', '$2y$10$mehD3cBfMwb60oUSQ0WtWuSLZts5LKRPeHmMhYztmPFxTt/W/XoYW'),
('louis', '$2y$10$cfXb2wzhtshMzEKhFDm4deriXJKhIzX0lipFzGlCzZInVROZ.rFAC');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `jobref` varchar(5) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `street` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` varchar(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skill` text DEFAULT NULL,
  `others` text DEFAULT NULL,
  `status` enum('New','Current','Final') DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `jobref`, `fname`, `lname`, `dob`, `gender`, `street`, `suburb`, `state`, `postcode`, `email`, `phone`, `skill`, `others`, `status`) VALUES
(1, 'dlr01', 'Jing Yee', 'Ng', '01/05/2006', 'female', 'NO.30 Jalan PU 12/5', 'Puchong', 'VIC', '1234', '106225401@student.swin.edu.au', '01118582008', 'excel, mysql, python', 'HTML, CSS, PHP, Ruby', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `reference_number` varchar(10) NOT NULL,
  `anchor_slug` varchar(20) NOT NULL,
  `title` varchar(150) NOT NULL,
  `short_description` text NOT NULL,
  `salary_min` decimal(10,2) NOT NULL,
  `salary_max` decimal(10,2) NOT NULL,
  `salary_currency` varchar(5) NOT NULL DEFAULT 'AUD',
  `salary_period` varchar(30) NOT NULL DEFAULT 'per month',
  `reporting_line` varchar(200) NOT NULL,
  `key_responsibilities` text NOT NULL,
  `essential_requirements` text NOT NULL,
  `preferable_requirements` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `reference_number`, `anchor_slug`, `title`, `short_description`, `salary_min`, `salary_max`, `salary_currency`, `salary_period`, `reporting_line`, `key_responsibilities`, `essential_requirements`, `preferable_requirements`) VALUES
(1, 'DLR01', 'digital', 'Digital Learning Support Officer', 'Provide technical and user support for digital learning platforms, helping staff and students deliver and access online education effectively.', 5000.00, 6250.00, 'AUD', 'per month', 'Reports to the Digital Learning Manager', 'Support academic staff in using the LMS|Troubleshoot technical issues|Assist with setting up online classes and materials|Provide training to users|Monitor system performance', 'Diploma/Degree in IT, Computer Science, or related field|Basic knowledge of web technologies|Strong problem-solving skills|Good communication skills', 'Experience with LMS platforms (Moodle, Blackboard)|Prior IT support experience|Familiarity with online tools (Zoom, Teams)'),
(2, 'LMS02', 'admin', 'Learning Management System (LMS) Administrator', 'Manage and maintain the university\'s Learning Management System to ensure reliable and efficient operation.', 5800.00, 7500.00, 'AUD', 'per month', 'Reports to the Head of IT Services', 'Maintain and update LMS platform|Manage user accounts and permissions|Ensure system security and backups|Troubleshoot system issues|Work with academic staff on system improvements', 'Degree in IT or related field|Knowledge of system administration|Understanding of web systems|Strong analytical skills', 'Experience managing LMS platforms|Knowledge of databases and servers|Experience in higher education IT systems'),
(3, 'RES03', 'research', 'Research Technology Assistant', 'Support researchers by managing software, systems, and data tools used in academic research.', 6200.00, 7900.00, 'AUD', 'per month', 'Reports to the Research Systems Coordinator', 'Provide support for research software|Assist with data handling and storage|Troubleshoot system issues|Help set up research tools|Maintain documentation', 'Degree in IT, Computer Science, or related field|Understanding of databases/data handling|Attention to detail|Ability to work independently and in a team', 'Experience with data tools (Excel, Python)|Knowledge of research systems|Experience in academic environments');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `reference_number` (`reference_number`),
  ADD UNIQUE KEY `anchor_slug` (`anchor_slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
