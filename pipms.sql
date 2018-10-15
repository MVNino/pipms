-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2018 at 12:37 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pipms`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `int_department_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'foreign key for departments',
  `int_user_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'foreign key for users',
  `char_gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtm_birthdate` date NOT NULL,
  `char_applicant_type` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_home_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bigInt_cellphone_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mdmInt_telephone_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`int_id`, `int_department_id`, `int_user_id`, `char_gender`, `dtm_birthdate`, `char_applicant_type`, `str_home_address`, `bigInt_cellphone_number`, `mdmInt_telephone_number`) VALUES
(1, 2, 2, 'M', '1999-04-10', 'Student', 'Las Piñas City, Philippines', '09508203815', '87000'),
(2, 2, 3, 'M', '1998-12-12', 'Student', '263 G. TERESA ST. STA MESA BGY 592, Manila', '09553648946', '87000'),
(3, NULL, NULL, 'M', '1998-12-12', 'Student', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `author_account_requests`
--

CREATE TABLE `author_account_requests` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `int_applicant_id` int(10) UNSIGNED NOT NULL,
  `str_first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `str_last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `char_request_status` char(12) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `str_account_request_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `str_branch_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_branch_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdmTxt_branch_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_branch_profile_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_branch_profile_image.png',
  `str_branch_banner_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_branch_banner_image.png',
  `str_branch_contact_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`int_id`, `str_branch_name`, `str_branch_address`, `mdmTxt_branch_description`, `str_branch_profile_image`, `str_branch_banner_image`, `str_branch_contact_link`, `created_at`, `updated_at`) VALUES
(1, 'PUP Main', 'Anonas Street, Santa Mesa, Manila', 'The Polytechnic University of the Philippines (PUP) is a government educational institution governed by Republic Act Number 8292 known as the Higher Education Modernization Act of 1997, and its Implementing Rules and Regulations contained in the Commission on Higher Education Memorandum Circular No. 4, series 1997. PUP is one of the country\'s highly competent educational institutions. The PUP Community is composed of the Board of Regents, University Officials, Administrative and Academic Personnel, Students, various Organizations, and the Alumni.', 'default_branch_profile_image.png', 'default_branch_banner_image.png', '/', '2018-10-12 08:16:07', '2018-10-12 08:16:07'),
(2, 'PUP Taguig', 'Taguig City', 'There is no description submitted for PUP Taguig.', 'default_branch_profile_image.png', 'default_branch_banner_image.png', NULL, '2018-10-12 13:40:46', '2018-10-12 13:40:46'),
(3, 'PUP San Juan', 'San Juan City', 'There is no description submitted for PUP San Juan.', 'default_branch_profile_image.png', 'default_branch_banner_image.png', NULL, '2018-10-12 13:41:18', '2018-10-12 13:41:18'),
(4, 'PUP Mariveles', 'Mariveles, Bataan', 'There is no description submitted for PUP Mariveles.', 'default_branch_profile_image.png', 'default_branch_banner_image.png', NULL, '2018-10-12 13:42:04', '2018-10-12 13:42:04'),
(5, 'PUP Quezon City', 'Don Fabian St., Commonwealth, Quezon City', 'This branch is located at Don Fabian St., Commonwealth, Quezon City.', 'default_branch_profile_image.png', 'default_branch_banner_image.png', 'quezoncity/contactinfo.aspx', '2018-10-12 15:08:37', '2018-10-12 15:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `int_branch_id` int(10) UNSIGNED NOT NULL COMMENT 'foreign key for branches',
  `char_college_code` char(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_college_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdmTxt_college_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_college_profile_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_college_profile_image.png',
  `str_college_banner_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_college_banner_image.png',
  `str_college_contact_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`int_id`, `int_branch_id`, `char_college_code`, `str_college_name`, `mdmTxt_college_description`, `str_college_profile_image`, `str_college_banner_image`, `str_college_contact_link`, `created_at`, `updated_at`) VALUES
(1, 1, 'CCIS', 'College of Computer and Information Sciences', 'The trends in computing and the field of information and communications technology are rapidly evolving.  The age of information and knowledge engineering is adherent.  The importance of IT is no longer in the management of the structure (infra- and human capital) but more so on the relevance and importance of the available information.  We no longer manage computers, we manage information.  Thus a need to realign the name of the college to reflect the importance of computers and information in the advent of knowledge engineering in today’s information age.', 'default_college_profile_image.png', 'CCIS_collegeBannerImg_1539332424.jpg', 'ccis/contactinfo.aspx', '2018-10-12 08:20:24', '2018-10-12 08:20:24'),
(2, 4, 'CBA', 'College of Business Administration', 'There is no description submitted for CBA.', 'CBA_collegeProfileImg_1539351833.png', 'default_college_banner_image.png', NULL, '2018-10-12 13:43:53', '2018-10-12 13:44:22'),
(3, 3, 'CAFA', 'College of Architecture and Fine Arts', 'There is no description submitted for CAFA.', 'CAFA_collegeProfileImg_1539351886.png', 'default_college_banner_image.png', NULL, '2018-10-12 13:44:46', '2018-10-12 13:44:46'),
(4, 2, 'COC', 'College of Communication', 'There is no description submitted for COC.', 'default_college_profile_image.png', 'default_college_banner_image.png', NULL, '2018-10-12 13:45:01', '2018-10-12 13:45:01'),
(5, 1, 'CAF', 'College of Accountancy and Finance', 'The College of Accountancy and Finance provides undergraduate programs in the field of accountancy, banking and finance.', 'default_college_profile_image.png', 'default_college_banner_image.png', 'caf/contactinfo.aspx', '2018-10-12 15:23:39', '2018-10-12 15:23:39'),
(6, 1, 'CAL', 'College of Arts and Letters', 'There is no description submitted for CAL.', 'default_college_profile_image.png', 'default_college_banner_image.png', 'cal/contactinfo.aspx', '2018-10-12 15:26:25', '2018-10-12 15:26:25'),
(7, 1, 'CBA', 'College of Business Administration', 'There is no description submitted for CBA.', 'default_college_profile_image.png', 'default_college_banner_image.png', 'cba/contactinfo.aspx', '2018-10-12 15:27:35', '2018-10-12 15:27:35'),
(8, 1, 'CAFA', 'College of Architecture and Fine Arts', 'There is no description submitted for CAFA.', 'default_college_profile_image.png', 'default_college_banner_image.png', 'cafa/contactinfo.aspx', '2018-10-12 15:30:44', '2018-10-12 15:30:44'),
(9, 1, 'COED', 'College of Education', 'There is no description submitted for COED.', 'default_college_profile_image.png', 'default_college_banner_image.png', 'coed/contactinfo.aspx', '2018-10-12 15:31:46', '2018-10-12 15:31:46'),
(10, 2, 'CHK', 'College of Human Kinetics', 'There is no description submitted for College of Human Kinetics.', 'default_college_profile_image.png', 'default_college_banner_image.png', 'chk/contactinfo.aspx', '2018-10-12 15:32:31', '2018-10-12 15:33:23'),
(11, 3, 'CS', 'College of Science', 'There is no description submitted for CS.', 'default_college_profile_image.png', 'default_college_banner_image.png', 'cs/contactinfo.aspx', '2018-10-12 15:35:09', '2018-10-12 15:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `copyrights`
--

CREATE TABLE `copyrights` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `int_user_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'foreign key for users',
  `int_applicant_id` int(10) UNSIGNED NOT NULL COMMENT 'foreign key for applicants',
  `int_project_type_id` int(10) UNSIGNED NOT NULL COMMENT 'foreign key for project_types',
  `int_project_id` int(10) UNSIGNED DEFAULT NULL,
  `str_custom_project` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `str_project_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdmTxt_project_description` mediumtext COLLATE utf8mb4_unicode_ci,
  `str_exec_summary_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `char_copyright_status` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `dtm_schedule` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dtm_to_submit` datetime DEFAULT NULL,
  `dtm_on_process` datetime DEFAULT NULL,
  `dtm_copyrighted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `copyrights`
--

INSERT INTO `copyrights` (`int_id`, `int_user_id`, `int_applicant_id`, `int_project_type_id`, `int_project_id`, `str_custom_project`, `str_project_title`, `mdmTxt_project_description`, `str_exec_summary_file`, `char_copyright_status`, `dtm_schedule`, `created_at`, `updated_at`, `dtm_to_submit`, `dtm_on_process`, `dtm_copyrighted`) VALUES
(1, NULL, 1, 1, 1, NULL, 'PIPMS', '<p>PUP - Intellectual Property Management System. Developed for IPMO.</p>', 'PIPMS_executiveSummaryFile_1539337980.docx', 'to submit', '2018-10-13 15:00:00', '2018-10-12 09:53:00', '2018-10-12 10:36:15', '2018-10-12 18:36:15', NULL, NULL),
(2, NULL, 1, 1, 1, NULL, 'Shop-Ey', '<p><em>Shopping</em>&nbsp;Cart 0 item/s &middot; Fila Disruptor. The FILA&nbsp;<em>Shop</em>. Philippines; Change Region &middot; News &middot; FAQs &middot; Terms and Conditions &middot; Size Guide&nbsp;</p>', 'Shop-Ey_executiveSummaryFile_1539341178.pdf', 'pending', NULL, '2018-10-12 10:46:18', '2018-10-12 10:46:18', NULL, NULL, NULL),
(3, NULL, 2, 1, 2, NULL, 'Biztrack', '<p>Learn about working at&nbsp;<em>biztrack</em>.io. Join LinkedIn today for free. See who you know at&nbsp;<em>biztrack</em>.io, leverage your professional network, and get hired.</p>', 'Biztrack_executiveSummaryFile_1539361031.docx', 'to submit', '2018-10-13 15:00:00', '2018-10-12 16:17:11', '2018-10-12 17:56:51', '2018-10-13 01:56:51', NULL, NULL),
(4, NULL, 2, 4, 2, NULL, 'Piece of Me', '<p>A literary work. A sub project. A <em><strong>piece of me.</strong></em></p>', 'Piece of Me_executiveSummaryFile_1539368326.docx', 'pending', NULL, '2018-10-12 18:18:46', '2018-10-12 18:18:46', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `co_authors`
--

CREATE TABLE `co_authors` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `int_applicant_id` int(10) UNSIGNED NOT NULL COMMENT 'foreign key for applicants',
  `int_copyright_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'foreign key for copyrights',
  `str_first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `str_last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `co_authors`
--

INSERT INTO `co_authors` (`int_id`, `int_applicant_id`, `int_copyright_id`, `str_first_name`, `str_middle_name`, `str_last_name`) VALUES
(1, 1, NULL, 'Marlon', 'Villa', 'Niño'),
(2, 1, NULL, 'Archie', 'Atienza', 'Causaren'),
(3, 1, NULL, 'Elyssa', 'Mae', 'Mortel'),
(4, 1, NULL, 'Eduardo', NULL, 'Danes'),
(5, 1, NULL, 'Ang', NULL, 'Gara'),
(6, 1, NULL, 'Lean', NULL, 'Chua'),
(7, 2, NULL, 'Mark', NULL, 'Bati-on'),
(8, 2, NULL, 'Wesley', NULL, 'Cua'),
(9, 2, NULL, 'Christine', NULL, 'Leynes'),
(10, 2, NULL, 'Moira', NULL, 'Dela Torre'),
(11, 2, NULL, 'Moira', NULL, 'Dela Torre'),
(12, 2, NULL, 'Decem', NULL, 'Avenue'),
(13, 2, NULL, 'Jhon', NULL, 'Dahen');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `int_college_id` int(10) UNSIGNED NOT NULL COMMENT 'foreign key for colleges',
  `char_department_code` char(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_department_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdmTxt_department_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_department_profile_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_department_profile_image.png',
  `str_department_banner_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_department_banner_image.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`int_id`, `int_college_id`, `char_department_code`, `str_department_name`, `mdmTxt_department_description`, `str_department_profile_image`, `str_department_banner_image`, `created_at`, `updated_at`) VALUES
(2, 1, 'BSIT', 'Bachelor of Science in Information Technology', 'The mission of the Department of Information Technology is to produce IT professionals competent in the areas of systems analysis and design, applications development, database administration, network administration, and systems implementation and maintenance among others.', 'default_department_profile_image.png', 'BSIT_deptBannerImg_1539332514.jpeg', '2018-10-12 08:21:54', '2018-10-12 08:21:54'),
(3, 1, 'BSCS', 'Bachelor of Science in Computer Science', 'There is no description submitted for BSCS.', 'default_department_profile_image.png', 'default_department_banner_image.png', '2018-10-12 13:45:30', '2018-10-12 13:45:30'),
(4, 3, 'BS-ARCHI', 'Bachelor of Science in Architecture', 'There is no description submitted for BS-ARCHI.', 'default_department_profile_image.png', 'default_department_banner_image.png', '2018-10-12 13:45:52', '2018-10-12 13:45:52'),
(5, 2, 'BSOA', 'Bachelor of Science in Office Administration', 'There is no description submitted for BSOA.', 'default_department_profile_image.png', 'default_department_banner_image.png', '2018-10-12 13:46:12', '2018-10-12 13:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `event_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `str_subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mdmTxt_message` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `char_message_status` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`int_id`, `sender_id`, `receiver_id`, `str_subject`, `mdmTxt_message`, `char_message_status`, `created_at`, `updated_at`, `email`, `sender_name`) VALUES
(1, 0, 1, 'To greet', 'Hey there admin! You okay?', '0', '2018-10-12 16:10:42', '2018-10-12 16:10:42', 'Admin', 'karl.causaren@gmail.com'),
(2, 1, 0, 'To reply', 'Yes I am', '0', '2018-10-12 19:01:05', '2018-10-12 19:01:05', 'karl.causaren@gmail.com', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_05_25_123929_create_messages_table', 1),
(4, '2018_07_03_034812_create_branches_table', 1),
(5, '2018_07_03_034859_create_colleges_table', 1),
(6, '2018_07_03_035223_create_departments_table', 1),
(7, '2018_07_03_035744_create_applicants_table', 1),
(8, '2018_07_03_045010_create_project_types_table', 1),
(9, '2018_07_03_046023_create_projects_table', 1),
(10, '2018_07_03_064618_create_copyrights_table', 1),
(11, '2018_07_03_065125_create_patents_table', 1),
(12, '2018_07_27_080535_create_co_authors_table', 1),
(13, '2018_08_12_074533_create_receipts_table', 1),
(14, '2018_08_18_014003_create_notifications_table', 1),
(15, '2018_08_27_013126_create_author_account_requests_table', 1),
(16, '2018_09_18_153229_create_requirements_table', 1),
(17, '2018_10_02_183631_add_status_dates_to_copyrights', 1),
(18, '2018_10_02_183726_add_status_dates_to_patents', 1),
(19, '2018_10_07_191721_create_events_table', 1),
(20, '2018_10_13_000416_add_columns_to_messages', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('08889fd5-8ad0-4a6f-be61-93d8a6b390c4', 'App\\Notifications\\ApplicantRequests', 'App\\User', 1, '{\"data\":\"<b>Copyright request<\\/b> by <b>Karl Causaren<\\/b> of <i>BSIT-CCIS-PUP Main<\\/i>\"}', NULL, '2018-10-12 16:17:11', '2018-10-12 16:17:11'),
('1f76a51f-caaf-4bd2-978c-4f4551cafbf8', 'App\\Notifications\\AnAuthorAccountAdded', 'App\\User', 1, '{\"data\":\"<b>Karl Chester Causaren<\\/b> is now a registered author account owner.\"}', NULL, '2018-10-12 11:09:12', '2018-10-12 11:09:12'),
('2fbffccc-ad15-4791-b7eb-ad7912021dcc', 'App\\Notifications\\ApplicantRequestsPatent', 'App\\User', 1, '{\"data\":\"<b>Copyright and Patent request<\\/b> by <b>Edgardo Cubian<\\/b> of <i>BSIT-CCIS-PUP Main<\\/i>\"}', NULL, '2018-10-12 10:01:41', '2018-10-12 10:01:41'),
('55b0354b-0be4-49e4-bbee-ddc02a3e5982', 'App\\Notifications\\ApplicantRequests', 'App\\User', 1, '{\"data\":\"<b>Copyright request<\\/b> by <b>Edgardo Cubian<\\/b> of <i>BSIT-CCIS-PUP Main<\\/i>\"}', NULL, '2018-10-12 10:46:19', '2018-10-12 10:46:19'),
('7562af83-f325-41d7-ae59-e4bc19f3038d', 'App\\Notifications\\ApplicantRequests', 'App\\User', 1, '{\"data\":\"<b>Copyright request<\\/b> by <b>Karl Causaren<\\/b> of <i>BSIT-CCIS-PUP Main<\\/i>\"}', '2018-10-12 19:18:22', '2018-10-12 18:18:46', '2018-10-12 19:18:22'),
('77de7c21-2085-4823-9b63-e3436b931feb', 'App\\Notifications\\AuthorAccountRequested', 'App\\User', 1, '{\"data\":\"Karl Chester Causaren requested for an author account\"}', '2018-10-12 11:04:23', '2018-10-12 11:03:47', '2018-10-12 11:04:23'),
('95b2cdd4-99ca-45a3-b79a-f2627ee502bb', 'App\\Notifications\\ApplicantRequests', 'App\\User', 1, '{\"data\":\"<b>Copyright request<\\/b> by <b>Edgardo Cubian<\\/b> of <i>BSIT-CCIS-PUP Main<\\/i>\"}', NULL, '2018-10-12 09:53:01', '2018-10-12 09:53:01'),
('ade46be0-e4c2-45bb-9c1d-72ecf8a72550', 'App\\Notifications\\AnAuthorAccountAdded', 'App\\User', 1, '{\"data\":\"<b>Edgardo Cubian<\\/b> is now a registered author account owner.\"}', NULL, '2018-10-12 09:01:20', '2018-10-12 09:01:20'),
('c7aa03fb-0662-46b1-bb22-5384bce6c99d', 'App\\Notifications\\AppointmentSetDb', 'App\\User', 3, '{\"data\":\"<b>Appointment<\\/b> for your actual submission of requirements for copyright registration: <b>Oct 13, 3:00 PM<\\/b>\"}', NULL, '2018-10-12 17:57:00', '2018-10-12 17:57:00'),
('d24acad5-5cc9-4ddc-8ac6-ce58e18eccab', 'App\\Notifications\\AuthorAccountRequested', 'App\\User', 1, '{\"data\":\"Edgardo Cubian requested for an author account\"}', '2018-10-12 21:25:55', '2018-10-12 08:26:22', '2018-10-12 21:25:55'),
('ea5e50ce-d8be-41ac-9033-db18cf1bc9c1', 'App\\Notifications\\ApplicantRequestsPatent', 'App\\User', 1, '{\"data\":\"<b>Copyright and Patent request<\\/b> by <b>Karl Causaren<\\/b> of <i>BSIT-CCIS-PUP Main<\\/i>\"}', '2018-10-12 19:18:10', '2018-10-12 18:22:29', '2018-10-12 19:18:10'),
('ffe80e33-85e5-4768-a02d-99a989d875f1', 'App\\Notifications\\AppointmentSetDb', 'App\\User', 2, '{\"data\":\"<b>Appointment<\\/b> for your actual submission of requirements for copyright registration: <b>Oct 12, 9:00 PM<\\/b>\"}', NULL, '2018-10-12 10:36:27', '2018-10-12 10:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patents`
--

CREATE TABLE `patents` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `int_copyright_id` int(10) UNSIGNED NOT NULL COMMENT 'foreign key for copyrights',
  `int_project_type_id` int(10) UNSIGNED NOT NULL COMMENT 'foreign key for project_types',
  `int_project_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'foreign key for projects',
  `str_custom_project` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `str_patent_project_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdmTxt_patent_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_patent_summary_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `char_patent_status` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `dtm_schedule` datetime DEFAULT NULL COMMENT 'schedule of actual application',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dtm_to_submit` datetime DEFAULT NULL,
  `dtm_on_process` datetime DEFAULT NULL,
  `dtm_patented` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patents`
--

INSERT INTO `patents` (`int_id`, `int_copyright_id`, `int_project_type_id`, `int_project_id`, `str_custom_project`, `str_patent_project_title`, `mdmTxt_patent_description`, `str_patent_summary_file`, `char_patent_status`, `dtm_schedule`, `created_at`, `updated_at`, `dtm_to_submit`, `dtm_on_process`, `dtm_patented`) VALUES
(1, 1, 2, 1, NULL, 'PIPMS Kapstun', 'There is no description supplied.', 'PIPMS Kapstun_patentExecSummary_1539338500.docx', 'pending', NULL, '2018-10-12 10:01:40', '2018-10-12 10:01:40', NULL, NULL, NULL),
(2, 3, 2, 1, NULL, 'BizTracking and Monitoring', '<p>Patent request for<em><strong> BizTrack </strong></em>business startup.</p>', 'BizTracking and Monitoring_patentExecSummary_1539368549.pdf', 'to submit', '2018-10-13 15:30:00', '2018-10-12 18:22:29', '2018-10-12 18:31:45', '2018-10-13 02:31:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `int_department_id` int(10) UNSIGNED NOT NULL COMMENT 'foreign key for departments',
  `int_project_type_id` int(10) UNSIGNED NOT NULL COMMENT 'foreign key for project_types',
  `str_project_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `int_year_level` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `char_semester` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdmTxt_project_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`int_id`, `int_department_id`, `int_project_type_id`, `str_project_name`, `int_year_level`, `char_semester`, `mdmTxt_project_description`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Capstone Project', '4th', '2nd', 'A capstone course, also known as capstone unit or a senior thesis or senior seminar serves as the culminating and usually integrative experience of an educational program.', '2018-10-12 08:24:30', '2018-10-12 13:47:36'),
(2, 2, 1, 'System Analysis and Design(SAD)', '3rd', '2nd', 'There is no description submitted for System Analysis and Design(SAD).', '2018-10-12 13:46:42', '2018-10-12 13:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `project_types`
--

CREATE TABLE `project_types` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `char_project_type` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `char_classification` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_project_type_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_project_type_image.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_types`
--

INSERT INTO `project_types` (`int_id`, `char_project_type`, `char_classification`, `str_project_type_image`) VALUES
(1, 'Thesis', 'C', 'default_project_type_image.png'),
(2, 'New Process or Methodology', 'P', 'New Process or Methodology_projectTypeImg_1539332058.jpg'),
(3, 'Architectural Plan', 'C', 'Architectural Plan_projectTypeImg_1539347410.jpg'),
(4, 'Literary Work', 'C', 'Literary Work_projectTypeImg_1539347556.jpg'),
(5, 'Musical Works', 'C', 'Musical Works_projectTypeImg_1539348010.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `int_applicant_id` int(10) UNSIGNED NOT NULL COMMENT 'foreign key for applicants',
  `int_copyright_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'foreign key for copyrights',
  `char_receipt_code` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_receipt_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`int_id`, `int_applicant_id`, `int_copyright_id`, `char_receipt_code`, `str_receipt_image`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'PUP-MN003A', 'PUP-MN003A_receipt_1539332781.png', '2018-10-12 08:26:21', '2018-10-12 08:26:21'),
(2, 2, NULL, 'RC-0002', 'RC-0002_receipt_1539342227.jpg', '2018-10-12 11:03:47', '2018-10-12 11:03:47'),
(3, 3, NULL, 'RC-0002', 'RC-0002_receipt_1539342399.jpg', '2018-10-12 11:06:39', '2018-10-12 11:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `int_id` int(10) UNSIGNED NOT NULL,
  `str_requirement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `char_ipr` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`int_id`, `str_requirement`, `char_ipr`, `created_at`, `updated_at`) VALUES
(1, 'Affidavit for Copyright', 'C', '2018-10-12 08:14:54', '2018-10-12 08:14:54'),
(2, 'Affidavit for Copyright Co-Ownership', 'C', '2018-10-12 08:15:09', '2018-10-12 08:15:09'),
(3, 'Patent Search Result', 'P', '2018-10-12 08:15:26', '2018-10-12 08:15:26'),
(4, 'Triplicate copies of the notarized Application Form', 'C', '2018-10-12 13:35:40', '2018-10-12 13:35:40'),
(5, 'Triplicate copies of the Affidavit of Copyright Co-ownership', 'C', '2018-10-12 13:36:03', '2018-10-12 13:36:03'),
(6, 'Duplicate copies of the document/s (hardbound or softcopy) as deposit to the National Library of the Philippines', 'C', '2018-10-12 13:36:26', '2018-10-12 13:36:26'),
(7, 'Technical description of the design, if the work applied for registration is an original ornamental design (classification H)', 'C', '2018-10-12 13:36:49', '2018-10-12 13:36:49'),
(8, 'Official receipt of filing fee from PUP', 'C', '2018-10-12 13:37:10', '2018-10-12 13:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `str_first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `str_last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `str_user_image_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_user_image.png',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `isAdmin` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `str_first_name`, `str_middle_name`, `str_last_name`, `str_username`, `email`, `password`, `str_user_image_code`, `status`, `isAdmin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Marlon', 'Villa', 'Niño', 'ninoadmin', 'ninomarlonvilla@gmail.com', '$2y$10$D.aEQncOmPuK9QgXw4uzCO/5hHqFg90hA.3UvpnVHKUTZ5bcGQnZi', 'lonlon.jpg', 1, 1, 'qmdQz4oulv3i1SSX8qxyh7DyQ7OYeNuXDLrJcXqeKYWeld8hzUuvyCzoEYl9', '2018-10-12 08:12:33', '2018-10-12 08:12:33'),
(2, 'Edgardo', 'Junior', 'Cubian', 'edsanity', 'ed.cubian@gmail.com', '$2y$10$UdymrcPaV31rK2DvJ.pOs.drcNhfFdkUw4pubJvDQQJIZL7Ko3rym', 'Edgardo_AuthorProfileImg_1539335885.png', 1, 0, 'wfWKNM4m1Z1h15B1152NrmcbdRSryabIfLMT8ddSRCEscvLb5HiKcKprIjIv', '2018-10-12 09:01:19', '2018-10-12 09:18:05'),
(3, 'Karl', 'Atienza', 'Causaren', 'karlcausaren', 'karl.causaren@gmail.com', '$2y$10$QeYOgUAP7NJzCgeaH8I63ulWGbLSh60OZhzXi6AeORd8t/sHCN.ea', 'Karl_AuthorProfileImg_1539366935.jpg', 1, 0, 'Ddn25LAwGkUuPmfNkctKxPF6zU7vdg6r4N2T288TmPRr1PwhI8Zo5clm6Af3', '2018-10-12 11:09:11', '2018-10-12 17:55:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`int_id`),
  ADD KEY `applicants_int_user_id_foreign` (`int_user_id`),
  ADD KEY `applicants_int_department_id_foreign` (`int_department_id`);

--
-- Indexes for table `author_account_requests`
--
ALTER TABLE `author_account_requests`
  ADD PRIMARY KEY (`int_id`),
  ADD UNIQUE KEY `author_account_requests_str_email_unique` (`str_email`),
  ADD KEY `author_account_requests_int_applicant_id_foreign` (`int_applicant_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`int_id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`int_id`),
  ADD KEY `colleges_int_branch_id_foreign` (`int_branch_id`);

--
-- Indexes for table `copyrights`
--
ALTER TABLE `copyrights`
  ADD PRIMARY KEY (`int_id`),
  ADD KEY `copyrights_int_user_id_foreign` (`int_user_id`),
  ADD KEY `copyrights_int_applicant_id_foreign` (`int_applicant_id`),
  ADD KEY `copyrights_int_project_type_id_foreign` (`int_project_type_id`),
  ADD KEY `copyrights_int_project_id_foreign` (`int_project_id`);

--
-- Indexes for table `co_authors`
--
ALTER TABLE `co_authors`
  ADD PRIMARY KEY (`int_id`),
  ADD KEY `co_authors_int_applicant_id_foreign` (`int_applicant_id`),
  ADD KEY `co_authors_int_copyright_id_foreign` (`int_copyright_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`int_id`),
  ADD KEY `departments_int_college_id_foreign` (`int_college_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`int_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patents`
--
ALTER TABLE `patents`
  ADD PRIMARY KEY (`int_id`),
  ADD KEY `patents_int_copyright_id_foreign` (`int_copyright_id`),
  ADD KEY `patents_int_project_type_id_foreign` (`int_project_type_id`),
  ADD KEY `patents_int_project_id_foreign` (`int_project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`int_id`),
  ADD KEY `projects_int_department_id_foreign` (`int_department_id`),
  ADD KEY `projects_int_project_type_id_foreign` (`int_project_type_id`);

--
-- Indexes for table `project_types`
--
ALTER TABLE `project_types`
  ADD PRIMARY KEY (`int_id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`int_id`),
  ADD KEY `receipts_int_applicant_id_foreign` (`int_applicant_id`),
  ADD KEY `receipts_int_copyright_id_foreign` (`int_copyright_id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`int_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_str_username_unique` (`str_username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `author_account_requests`
--
ALTER TABLE `author_account_requests`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `copyrights`
--
ALTER TABLE `copyrights`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `co_authors`
--
ALTER TABLE `co_authors`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `patents`
--
ALTER TABLE `patents`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_types`
--
ALTER TABLE `project_types`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `int_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_int_department_id_foreign` FOREIGN KEY (`int_department_id`) REFERENCES `departments` (`int_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `applicants_int_user_id_foreign` FOREIGN KEY (`int_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `author_account_requests`
--
ALTER TABLE `author_account_requests`
  ADD CONSTRAINT `author_account_requests_int_applicant_id_foreign` FOREIGN KEY (`int_applicant_id`) REFERENCES `applicants` (`int_id`) ON UPDATE CASCADE;

--
-- Constraints for table `colleges`
--
ALTER TABLE `colleges`
  ADD CONSTRAINT `colleges_int_branch_id_foreign` FOREIGN KEY (`int_branch_id`) REFERENCES `branches` (`int_id`) ON UPDATE CASCADE;

--
-- Constraints for table `copyrights`
--
ALTER TABLE `copyrights`
  ADD CONSTRAINT `copyrights_int_applicant_id_foreign` FOREIGN KEY (`int_applicant_id`) REFERENCES `applicants` (`int_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `copyrights_int_project_id_foreign` FOREIGN KEY (`int_project_id`) REFERENCES `projects` (`int_id`),
  ADD CONSTRAINT `copyrights_int_project_type_id_foreign` FOREIGN KEY (`int_project_type_id`) REFERENCES `project_types` (`int_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `copyrights_int_user_id_foreign` FOREIGN KEY (`int_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `co_authors`
--
ALTER TABLE `co_authors`
  ADD CONSTRAINT `co_authors_int_applicant_id_foreign` FOREIGN KEY (`int_applicant_id`) REFERENCES `applicants` (`int_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `co_authors_int_copyright_id_foreign` FOREIGN KEY (`int_copyright_id`) REFERENCES `copyrights` (`int_id`) ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_int_college_id_foreign` FOREIGN KEY (`int_college_id`) REFERENCES `colleges` (`int_id`) ON UPDATE CASCADE;

--
-- Constraints for table `patents`
--
ALTER TABLE `patents`
  ADD CONSTRAINT `patents_int_copyright_id_foreign` FOREIGN KEY (`int_copyright_id`) REFERENCES `copyrights` (`int_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patents_int_project_id_foreign` FOREIGN KEY (`int_project_id`) REFERENCES `projects` (`int_id`),
  ADD CONSTRAINT `patents_int_project_type_id_foreign` FOREIGN KEY (`int_project_type_id`) REFERENCES `project_types` (`int_id`) ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_int_department_id_foreign` FOREIGN KEY (`int_department_id`) REFERENCES `departments` (`int_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_int_project_type_id_foreign` FOREIGN KEY (`int_project_type_id`) REFERENCES `project_types` (`int_id`) ON UPDATE CASCADE;

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_int_applicant_id_foreign` FOREIGN KEY (`int_applicant_id`) REFERENCES `applicants` (`int_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `receipts_int_copyright_id_foreign` FOREIGN KEY (`int_copyright_id`) REFERENCES `copyrights` (`int_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
