-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2021 at 01:52 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.3.27-1+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_details`
--

CREATE TABLE `account_details` (
  `id` bigint UNSIGNED NOT NULL,
  `vendor_id` int NOT NULL,
  `account_holder_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_details`
--

INSERT INTO `account_details` (`id`, `vendor_id`, `account_holder_name`, `account_number`, `bank_name`, `created_at`, `updated_at`) VALUES
(1, 11, 'kdjfkdjfk', '4415233', 'dkjdkgj', '2021-01-07 01:17:20', '2021-01-07 01:17:20'),
(2, 7, 'jhjhjh', 'nghgh', 'hjhjhj', '2021-01-07 02:14:18', '2021-01-07 02:14:18'),
(3, 8, 'jhjhj', 'hghjh', 'kjhjh', '2021-01-07 02:20:05', '2021-01-07 02:20:05'),
(4, 9, 'sdsadsd', 'sdsf', 'sdfdsf', '2021-01-07 02:35:28', '2021-01-07 02:35:28'),
(5, 3, 'jhjh', 'mnn', 'jkjk', '2021-01-13 10:30:49', '2021-01-13 10:30:49'),
(6, 9, 'demo-vendor', '125634152', 'bank', '2021-01-14 12:45:17', '2021-01-14 12:45:17'),
(7, 13, 'hghjg', '125263', 'jhj', '2021-01-14 16:54:32', '2021-01-14 16:54:32'),
(8, 14, 'test holder name', '0918273377380001', 'test bank name', '2021-01-15 05:12:39', '2021-01-15 05:12:39'),
(9, 19, 'abc', '1245263', '125263', '2021-01-18 09:46:06', '2021-01-18 09:46:06'),
(10, 20, 'fdhfd', '34534543543543', 'dsfsdaf', '2021-02-23 07:08:12', '2021-02-23 07:08:12'),
(11, 21, 'abc HOLDER', '1234567890', 'ABCD', '2021-02-24 04:24:28', '2021-02-24 04:24:28'),
(12, 23, 'fdsgfdg', '43534543', 'fdgdfg', '2021-03-09 04:00:38', '2021-03-09 04:00:38'),
(13, 25, 'hfdh', '54654646', 'hdfc', '2021-03-10 04:04:13', '2021-03-10 04:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `page` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `page`, `heading1`, `heading2`, `description`, `img`, `created_at`, `updated_at`) VALUES
(1, 'aboutus', 'ALL YOU NEED TO KNOW', 'About QuickVote', '<p><span style=\"color:#ffffff; font-family:Montserrat,sans-serif; font-size:19px\">Create a poll Contest in seconds. Your voters can vote from any location on any device.</span></p>', '/uploads/images/70df33b3a3b3d0086caf8eaf5e74e73c.jpg', '2021-01-04 08:59:48', '2021-02-23 03:39:46'),
(2, 'contact', 'CONTACT US NOW', 'Keep In Touch', 'Contact text edited', '/uploads/images/3e2d4bf4f762cadb735ab5bb676c6fe2.jpg', '2021-01-04 23:53:31', '2021-01-05 16:20:12'),
(3, 'pricing', 'SIMPLE PRICING FOR EVERYONE', 'QuickVote Plans', 'pricing text edited', '/uploads/images/36d1723151f6c20e569eeb3df65d5b5d.jpg', '2021-01-05 00:07:42', '2021-01-05 16:03:30'),
(4, 'faq', 'WE\'RE HERE TO HELP', 'QuickVote FAQs', 'ttttttt1', '/uploads/images/88739e1ceb407362268650d7378a43fa.jpg', '2021-01-05 09:06:11', '2021-01-05 16:15:21'),
(5, 'services', 'QUICKVOTE SERVICES', 'Our Services', 'description', '/uploads/images/9c351e92468e50f306a787747dde6078.jpg', '2021-01-07 13:47:08', '2021-01-07 13:47:08'),
(6, 'our-team', 'QUICKVOTE TEAM', 'Our Team', 'Description', '/uploads/images/23528b6f992ca2945ffeabd447720b76.jpg', '2021-01-07 13:48:16', '2021-01-07 13:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `parent_id` int NOT NULL DEFAULT '0',
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `parent_id`, `created_by`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Pageants', 'This is a good pageant category', 0, '2', '', '2021-01-15 12:57:31', '2021-01-15 12:57:31'),
(2, 'Sport', 'description', 0, '2', '/uploads/images/b8fc33c031e3841f5e118a4d0f201d00.png', '2021-01-18 09:17:46', '2021-01-18 09:17:46'),
(3, 'Singing', '<p>Singing</p>', 0, '2', '/uploads/images/1a36a05930f60e3b05f52f09172d16d8.png', '2021-02-12 13:21:52', '2021-02-12 13:21:52'),
(4, 'Dance', '<p>Dance</p>', 0, '2', '/uploads/images/1a9eccd9668be7bcbb1b54975397811c.png', '2021-02-12 13:22:09', '2021-02-12 13:22:09'),
(5, 'sadasd', '<p><u><strong>&lt;h1&gt;dfgfudsygfasd&lt;/h1&gt;</strong></u></p>', 0, '2', NULL, '2021-02-22 23:42:43', '2021-02-22 23:42:43'),
(6, 'fghfg', '<p>hgf gfhfghfg</p>', 5, '21', '/uploads/images/ba5fa733c7e7652f695b30131d2a967c.png', '2021-02-26 01:17:41', '2021-02-26 01:33:25'),
(7, 'test', '<p>cxvcx cxvcx</p>', 1, '2', '/uploads/images/b453c9602a995b0cf72915959061d87a.png', '2021-02-26 01:34:09', '2021-02-26 01:34:09'),
(8, 'cxvxcv', '<p>xcvxczvcxzv</p>', 3, '21', '/uploads/images/76e6ecd4c95dd3f22dd26761a26f6038.png', '2021-02-26 01:34:20', '2021-02-26 01:34:20'),
(9, '66', '<p>cxvxczvcxv</p>', 1, '2', '/uploads/images/9228fc55645e6d484f2181e1f9081a41.png', '2021-02-26 01:34:33', '2021-02-26 04:08:38'),
(10, 'cxvxczv', '<p>xcvxc cxvxcvxcvxcvxcv</p>', 3, '21', '/uploads/images/36a5dd9ea3ac8019e2426e4355101cd8.png', '2021-02-26 01:34:43', '2021-02-26 01:34:43'),
(11, 'xcvcxv cxv', '<p>cxvcxv cxvxc cxvxcv</p>', 3, '2', '/uploads/images/941791c6ef46bcd7acb69b5a6872083a.jpg', '2021-02-26 01:35:00', '2021-02-26 01:35:00'),
(12, '16th match cat', '<p>test dfdsf</p>', 0, '2', '/uploads/images/2275a72eb5cd114f54063903a57c9fd5.jpg', '2021-03-16 00:40:29', '2021-03-16 00:40:29'),
(13, '17 cat name', '<p>sdafsdds&nbsp;</p>', 1, '25', '/uploads/images/ed5eeedf194564155e7c0723d76e4a80.jpg', '2021-03-16 00:42:58', '2021-03-16 00:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 'Lagos', 1, '2021-03-02 03:53:12', '2021-03-02 03:53:12'),
(2, 'Ibadan', 1, '2021-03-02 04:12:04', '2021-03-02 04:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `company_informations`
--

CREATE TABLE `company_informations` (
  `id` bigint UNSIGNED NOT NULL,
  `vendor_id` int NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int NOT NULL,
  `state_id` int NOT NULL,
  `country_id` int NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_informations`
--

INSERT INTO `company_informations` (`id`, `vendor_id`, `company_name`, `address`, `city_id`, `state_id`, `country_id`, `phone`, `email`, `website`, `company_description`, `created_at`, `updated_at`) VALUES
(1, 111, 'sssd', 'sdsdsfsd', 444, 33, 3, '41523', 'gg@yopmail.com', 'xdsfsdfds', 'dsdff', '2021-01-07 01:17:19', '2021-01-07 01:17:19'),
(2, 7, 'rrr', 'kjkjk', 101, 4022, 57654, '12524120', 'hhh@gmail.com', 'sjdjsa djashdjas', 'ewjekrjwer', '2021-01-07 02:14:18', '2021-01-07 02:14:18'),
(3, 8, 'jhjh', 'jhjhjh', 101, 4022, 57607, '12452526', 'aa@gmail.com', 'sajhdsa jhjhjh', 'jhjqhdjqwhjwh', '2021-01-07 02:20:05', '2021-01-07 02:20:05'),
(4, 9, 'dfgfghgf', 'jjjh', 101, 4022, 57641, '1234568', 'lll@yopmail.com', 'jkadhjs kkjk jk', 'sfskdfdkjgkdf fkdgkfdgkdf', '2021-01-07 02:35:28', '2021-01-07 02:35:28'),
(5, 3, 'my company', 'address', 101, 4022, 132782, '12530502', 'gfg@gmail.com', 'gh.jhjnjn.com', 'uiuiuikj', '2021-01-13 10:30:49', '2021-01-13 10:30:49'),
(6, 9, 'Event management', 'my addredd', 161, 298, 76910, '12365742', 'mgmt@gmail.com', 'www.mySite.com', 'My first Company', '2021-01-14 12:45:17', '2021-01-14 12:45:17'),
(7, 13, 'demo', 'address', 161, 300, 76828, '1235263', 'demoVendor@yopmail.com', 'www.abc.com', 'cxjcdkj', '2021-01-14 16:54:32', '2021-01-14 16:54:32'),
(8, 14, 'Test company', 'Test company add', 101, 4015, 57686, '0987654321', 'test111@yopmail.com', 'Quick vote', 'test comp desc', '2021-01-15 05:12:39', '2021-01-15 05:12:39'),
(9, 19, 'new-vendor', 'address', 161, 294, 76967, '52415263', 'abc@yopmail.com', 'www.mybusiness.com', 'description', '2021-01-18 09:46:06', '2021-01-18 09:46:06'),
(10, 20, 'sdfdsaf', 'dsafasdfdasf', 161, 304, 76865, '34532454325', 'admin@yopmail.com', 'dfsgdsf.com', 'fdgdfs dfgdfsgdfs', '2021-02-23 07:08:12', '2021-02-23 07:08:12'),
(11, 21, 'new company', 'abc city', 161, 305, 77116, '0987654321', 'dilpreet@webspero.com', 'abc.com', 'abc DESCRIPTION', '2021-02-24 04:24:28', '2021-02-24 04:24:28'),
(12, 23, 'sdfgsdfg', 'sdfgfdsg', 1, 1, 2, '143535435', 'abcvandor@gmail.com', 'fdsaf.com', 'asdfsdafasdf', '2021-03-09 04:00:38', '2021-03-09 04:00:38'),
(13, 25, 'fdhd', 'fghhhhhhh', 1, 1, 2, '43534534', 'zxc@yopmail.com', 'dfsgd.com', 'dhfhfg fghgfhfd', '2021-03-10 04:04:13', '2021-03-10 04:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `contact_queries`
--

CREATE TABLE `contact_queries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 => NO, 1 => yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_queries`
--

INSERT INTO `contact_queries` (`id`, `name`, `email`, `subject`, `phone`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'aaaa', 'shukla.garima15@gmail.com', 'account creation issue', '07275505411', 'ghjg jj hjh jhjh kjh', '0', '2021-01-05 08:16:42', '2021-01-05 08:16:42'),
(2, 'jhj', 'demouser@yopmail.com', 'hgjh', '04152364150', 'jhjk kjkjk kjjkkj kjk', '0', '2021-01-05 08:19:06', '2021-01-05 08:19:06'),
(3, '!@!@#!#!', 'a@yopmail.com', '22', '1231231323123123231231313434434', 'dadd', '0', '2021-01-18 09:53:19', '2021-01-18 09:53:19'),
(4, 'test', 'a@yopmail.com', 'twt', '132333333333333332', 'hi', '0', '2021-01-18 09:57:10', '2021-01-18 09:57:10'),
(5, 'Test', 'a@yopmail.com', 'Hi', '1828838383', 'Hi', '0', '2021-01-19 04:13:48', '2021-01-19 04:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `contestants`
--

CREATE TABLE `contestants` (
  `id` bigint UNSIGNED NOT NULL,
  `voting_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `candidate_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` int DEFAULT NULL,
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contestants`
--

INSERT INTO `contestants` (`id`, `voting_id`, `name`, `phone`, `candidate_id`, `image`, `state_id`, `added_by`, `about`, `created_at`, `updated_at`) VALUES
(1, 1, 'First Contestants', '12345678', '1', 'uploads/images/c4e7e94f6a9289b42ed633154bdd510f.jpg', NULL, 2, 'sdfsdafsa', '2021-03-09 03:10:37', '2021-03-09 03:10:37'),
(2, 1, '2nd Contestants', '5435345', '102', 'uploads/images/46443d9121c1ad3c6b5cf96861df181d.png', NULL, 2, 'sdafdsaf', '2021-03-09 03:10:37', '2021-03-09 03:10:37'),
(3, 1, '3rd Contestants', '5435345', '103', 'uploads/images/89cd0909270bfbf6e5f674e78e3ffb39.jpeg', NULL, 2, 'dsfs', '2021-03-09 03:10:37', '2021-03-09 03:10:37'),
(4, 1, '4th Contestants', '3423423432', '104', 'uploads/images/46443d9121c1ad3c6b5cf96861df181d.png', NULL, 2, 'fsdaf dsfsdafsa', '2021-03-09 03:10:37', '2021-03-09 03:10:37'),
(5, 1, 'cont one', '5435345', '105', 'uploads/images/7c7240629a564751120a3f76064e98e0.png', NULL, 25, 'zxC zxCzxcz', '2021-03-10 04:33:28', '2021-03-10 04:33:28'),
(6, 1, 'gfhfgh', '32432432', '106', 'uploads/images/7c7240629a564751120a3f76064e98e0.png', NULL, 25, 'cxvfsdf sadfds', '2021-03-10 04:33:28', '2021-03-10 04:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonecode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `phonecode`, `currency`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Nigeria', '+234', 'NGN', 2, '2021-03-02 03:51:11', '2021-03-02 03:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `venue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_id` int DEFAULT NULL,
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `event_priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Pending','Accepted','Rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `image`, `organizer_name`, `category_id`, `user_id`, `start_date`, `end_date`, `venue`, `city_id`, `state_id`, `country_id`, `subcategory_id`, `timezone`, `description`, `event_priority`, `status`, `reason`, `created_at`, `updated_at`) VALUES
(1, 'Event One', '/uploads/images/6458a8628f3f89ae9b07fc9cfc7d54f7.jpeg', 'Abc Organise', 1, 2, '2021-03-09 14:06:00', '2021-03-31 14:06:00', NULL, '2', '1', '1', NULL, 'Africa/Kinshasa', '<p>Abc Organise</p>', 'low', '', NULL, '2021-03-09 03:08:06', '2021-03-09 03:08:06'),
(2, 'fdsgsdfgdfsg', '/uploads/images/e0eeb96e3285412ab6c0a75346ed703e.jpg', 'sdfgfdsg dfsgdfsg', 5, 25, '2021-03-10 15:26:00', '2021-03-31 15:26:00', NULL, '2', '1', '1', 6, 'Africa/Lagos', '<p>sfdgfdsg fdgdfgdf dfgfdg</p>', 'low', '', NULL, '2021-03-10 04:27:02', '2021-03-10 04:27:02'),
(3, 'dsfgsdfg', '/uploads/images/71056c4e46bcc819869b8586d1af0792.jpg', 'dsfgdsfg', 2, 2, '2021-03-11 16:57:00', '2021-03-31 16:57:00', NULL, '2', '1', '1', NULL, 'Africa/Lagos', '<p>dsfgdsf fdgdfsgdfs dfgdfsg</p>', 'low', '', NULL, '2021-03-11 05:57:49', '2021-03-11 05:57:49'),
(4, 'dfhffgfghfghfgh', '/uploads/images/8b6311114ad81068f8ee185f69bd339b.jpg', 'dfhfghfffd', 1, 2, '2021-03-11 17:51:00', '2021-03-31 17:51:00', NULL, '2', '1', '1', NULL, 'Africa/Lagos', '<p>fdgh fghfdg fghfg fghfd</p>', 'medium', '', NULL, '2021-03-11 06:52:30', '2021-03-11 06:52:30'),
(5, 'sadfsdafsda', '/uploads/images/d9f4db63c3733ea394dcba9a8644000b.jpg', 'sdafsda dsfsdf', 1, 2, '2021-03-11 00:00:00', '2021-03-30 00:00:00', NULL, '2', '1', '1', NULL, 'Africa/Lagos', '<p>dsfsda sdf sdfsdaf sdf</p>', 'medium', '', NULL, '2021-03-11 06:54:10', '2021-03-11 06:54:10'),
(6, 'sdfgdsfgdsfg', '/uploads/images/01744e3c6b1ab10ba6284eeff2dafe15.jpg', 'dfsg dfgdfsg', 1, 2, '2021-03-11 17:55:00', '2021-03-31 17:55:00', NULL, '2', '1', '1', NULL, 'Africa/Lagos', '<p>dfg dfg dsfgdsfg dsfg</p>', 'medium', '', NULL, '2021-03-11 06:55:37', '2021-03-11 06:55:37'),
(7, 'asdfdsaf', '/uploads/images/4d69cf7efe73e383af277fd53a6a1c1e.jpg', 'dsafdsaf', 2, 2, '2021-03-11 17:59:00', '2021-03-31 17:59:00', NULL, '2', '1', '1', NULL, 'Africa/Lagos', '<p>sdfsdafsda</p>', 'low', '', NULL, '2021-03-11 07:00:03', '2021-03-11 07:00:03'),
(8, 'sadfsdaf', '/uploads/images/24d51f36884b888954cd6e145f0085dc.png', 'sadfsdaf', 2, 2, '2021-03-11 18:00:00', '2021-03-31 18:00:00', NULL, '2', '1', '1', NULL, 'Africa/Lagos', '<p>sdfsdf</p>', 'low', '', NULL, '2021-03-11 07:01:06', '2021-03-11 07:01:06'),
(9, 'asdfasdf', '/uploads/images/3eb62d5ba2eeac2e773a4e34ce120f73.jpg', 'sdaf sdfs', 2, 2, '2021-03-11 18:01:00', '2021-03-31 18:01:00', NULL, '2', '1', '1', NULL, 'Africa/Lagos', '<p>dsfds dsfsdf sdfsadf</p>', 'low', '', NULL, '2021-03-11 07:02:25', '2021-03-11 07:02:25'),
(10, 'dfsgdsfg', '/uploads/images/b34578e2ede3415b38f2d355af7abf09.jpg', 'sdfgfdsg dfsgdfsg', 3, 25, '2021-03-11 18:43:00', '2021-03-31 18:44:00', NULL, '2', '1', '1', 8, 'Africa/Lagos', '<p>dfs fdg dfg dfg</p>', 'low', '', NULL, '2021-03-11 07:44:34', '2021-03-11 07:44:34'),
(11, 'sdafdsafds', '/uploads/images/ab4734c041b8f323a80683fb206d42a6.jpg', 'sdfgfdsg dfsgdfsg', 1, 25, '2021-03-11 18:45:00', '2021-03-30 18:45:00', NULL, '2', '1', '1', 9, 'Africa/Lagos', '<p>dsafa sdf sdf sdafdsf sdafdsfsd sdf</p>', 'medium', '', NULL, '2021-03-11 07:46:28', '2021-03-11 07:46:28'),
(12, 'Dsfgdsfg', '/uploads/images/72f45b402ef76267dbc6b5b3348c0180.jpg', 'Sdfgfdsg dfsgdfsg', 1, 25, '2021-03-11 18:47:00', '2021-03-31 18:47:00', NULL, '2', '1', '1', 9, 'Africa/Lagos', '<p>dfs dfgdfg dfg dfsg dfsg dfs</p>', 'low', 'Accepted', NULL, '2021-03-11 07:47:58', '2021-03-16 03:06:36'),
(13, 'Dfsgdfsg', '/uploads/images/cb4395fda941b5c25a79e0e18432f73e.jpg', 'Sdfgfdsg dfsgdfsg', 1, 25, '2021-03-11 18:49:00', '2021-03-30 18:49:00', NULL, '2', '1', '1', 9, 'Africa/Lagos', '<p>dfsg dfsg dfsg dfs</p>', 'low', 'Accepted', NULL, '2021-03-11 07:50:11', '2021-03-15 07:57:50'),
(14, 'Event test 234', '/uploads/images/5843eb6a077ac244b21b6d78e4b3d7ef.png', 'Sdfgfdsg dfsgdfsg', 3, 25, '2021-03-16 12:49:00', '2021-04-03 12:49:00', NULL, '2', '1', '1', 8, 'Africa/Lagos', '<p>dfgfdsg</p>', 'high', 'Accepted', NULL, '2021-03-16 01:50:33', '2021-03-16 03:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `question` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'Collapsible Group Item #2', '<span style=\"color: rgb(123, 123, 123); font-family: Poppins, sans-serif; font-size: 16px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span>', '2021-01-05 08:47:32', '2021-01-05 16:18:13'),
(5, 'Collapsible Group Item #1', '<span style=\"color: rgb(123, 123, 123); font-family: Poppins, sans-serif; font-size: 16px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span>', '2021-01-05 09:26:49', '2021-01-05 16:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `featured_events`
--

CREATE TABLE `featured_events` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(21, '2020_12_23_070930_create_sliders_table', 5),
(24, '2020_12_23_070931_create_sliders_table', 6),
(28, '2021_01_04_055450_create_pricing_plans_table', 9),
(29, '2021_01_04_055451_create_pricing_plans_table', 10),
(31, '2021_01_04_125301_create_banners_table', 11),
(32, '2014_10_12_000011_create_users_table', 12),
(33, '2014_10_12_100001_create_password_resets_table', 12),
(34, '2019_08_19_000001_create_failed_jobs_table', 12),
(35, '2020_11_27_103241_create_permission_tables', 12),
(36, '2020_12_16_062841_create_social_facebook_accounts_table', 12),
(37, '2020_12_18_052558_create_categories_table', 12),
(38, '2020_12_18_111200_create_events_table', 12),
(39, '2020_12_21_052010_create_countries_table', 12),
(40, '2020_12_21_052052_create_states_table', 12),
(41, '2020_12_21_052112_create_cities_table', 12),
(42, '2020_12_23_071137_create_pages_table', 13),
(43, '2020_12_23_071510_create_testimonials_table', 13),
(44, '2020_12_23_084421_create_featured_events_table', 13),
(45, '2020_12_24_115554_create_services_table', 13),
(46, '2021_01_04_055452_create_pricing_plans_table', 13),
(47, '2021_01_04_125311_create_banners_table', 13),
(48, '2021_01_05_130419_create_contact_queries_table', 14),
(49, '2021_01_05_135602_create_faqs_table', 15),
(50, '2021_02_24_083615_create_voting_contests_table', 16),
(51, '2021_02_25_120327_create_subcategories_table', 17),
(52, '2021_03_04_063333_create_voting_contestants_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\User', 3),
(2, 'App\\User', 9),
(2, 'App\\User', 13),
(2, 'App\\User', 14),
(3, 'App\\User', 16),
(3, 'App\\User', 17),
(2, 'App\\User', 19);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `page_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `img1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `section`, `heading1`, `heading2`, `heading3`, `description`, `img1`, `img2`, `img3`, `created_at`, `updated_at`) VALUES
(184, 'home', 'featured event', 'Featured Event', NULL, NULL, '<span style=\"color: rgb(123, 123, 123); font-family: Montserrat, sans-serif; font-size: 18px; text-align: center;\">We support all types of poll events, here are some recent events created on our platform.</span>', NULL, NULL, NULL, '2021-01-18 08:43:45', '2021-01-18 08:43:45'),
(185, 'home', 'about quickvote', 'About Quickvote.ng', NULL, NULL, '<p style=\"margin-bottom: 30px; font-family: Montserrat, sans-serif; font-size: 18px; line-height: 1.8; letter-spacing: 0.5px; color: rgb(123, 123, 123);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p><p style=\"margin-bottom: 30px; font-family: Montserrat, sans-serif; font-size: 18px; line-height: 1.8; letter-spacing: 0.5px; color: rgb(123, 123, 123);\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>', NULL, NULL, NULL, '2021-01-18 08:43:45', '2021-01-18 08:43:45'),
(186, 'home', 'our pricing', 'Our Pricing', NULL, NULL, '<span style=\"color: rgb(123, 123, 123); font-family: Montserrat, sans-serif; font-size: 18px; text-align: center; background-color: rgb(249, 249, 249);\">Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.</span>', NULL, NULL, NULL, '2021-01-18 08:43:45', '2021-01-18 08:43:45'),
(187, 'home', 'testimonial', 'What Our Client Say', NULL, NULL, '<span style=\"color: rgb(123, 123, 123); font-family: Montserrat, sans-serif; font-size: 18px; text-align: center;\">Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.</span>', NULL, NULL, NULL, '2021-01-18 08:43:45', '2021-01-18 08:43:45'),
(188, 'home', 'news and update', 'News and Updates', NULL, NULL, '<span style=\"color: rgb(255, 255, 255); font-family: Montserrat, sans-serif; font-size: 16px;\">Subscribe to our newsletter and receive the latest news from QuickVote.</span><br>', NULL, NULL, NULL, '2021-01-18 08:43:45', '2021-01-18 08:43:45'),
(189, 'home', 'trusted brands', 'News and Updates', NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-18 08:43:45', '2021-01-18 08:43:45'),
(195, 'our-investors', 'our-investors', 'Our Investors', NULL, NULL, 'Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features. Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features. Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features. Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.<br>', NULL, NULL, NULL, '2021-01-18 09:07:31', '2021-01-18 09:07:31'),
(196, 'our-team', 'our-team', 'Our Awesome Team', NULL, NULL, '<p style=\"font-family: Montserrat, sans-serif; color: rgb(123, 123, 123); font-size: 16px; text-align: center;\">Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.</p><div class=\"owl-carousel owl-theme owl-loaded\" style=\"-webkit-tap-highlight-color: transparent; position: relative; width: 1251.55px; z-index: 1; color: rgb(123, 123, 123); font-family: Poppins, sans-serif; font-size: 16px; text-align: center;\"><div class=\"owl-stage-outer\" style=\"position: relative; overflow: hidden; transform: translate3d(0px, 0px, 0px);\"><div class=\"owl-stage\" style=\"position: relative; touch-action: manipulation; transform: translate3d(-1253px, 0px, 0px); transition: all 0s ease 0s; width: 3343px;\"><div class=\"owl-item cloned\" style=\"-webkit-tap-highlight-color: transparent; position: relative; backface-visibility: hidden; transform: translate3d(0px, 0px, 0px); min-height: 1px; float: left; width: 415.85px; margin-right: 2px;\"><div class=\"item show\" style=\"padding: 0px 20px;\"><div class=\"team-mem\" style=\"padding: 60px 0px; margin: 50px auto 20px; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.133) 0px 0px 11px 0px;\"><img src=\"http://staging.webspero.com/Quickvote/img/team.jpg\" class=\"img-fluid profile-pic mb-4 mt-3\" style=\"max-width: 200px; margin: 0px auto; width: 200px; display: block;\"><h3 style=\"margin-top: 0px; margin-bottom: 0.5rem; font-weight: 600; line-height: 1.2; font-size: 26px; color: rgb(0, 0, 0);\">Scarlett Snow</h3><h4 style=\"margin-top: 0px; margin-bottom: 25px; line-height: 1.2; font-size: 18px; letter-spacing: 0.5px;\">Designer at Startup</h4><p class=\"follow-mem tc\" style=\"font-family: Montserrat, sans-serif;\"><a href=\"http://staging.webspero.com/Quickvote/team.html#\" style=\"color: rgb(0, 123, 255); margin: 5px;\"><span class=\"fab fa-linkedin-in\" style=\"color: rgb(0, 0, 0); font-size: 20px;\"></span></a>&nbsp;<a href=\"http://staging.webspero.com/Quickvote/team.html#\" style=\"color: rgb(0, 123, 255); margin: 5px;\"><span class=\"fab fa-twitter\" style=\"color: rgb(0, 0, 0); font-size: 20px;\"></span></a>&nbsp;<a href=\"http://staging.webspero.com/Quickvote/team.html#\" style=\"color: rgb(0, 123, 255); margin: 5px;\"><span class=\"fab fa-facebook-f\" style=\"color: rgb(0, 0, 0); font-size: 20px;\"></span></a>&nbsp;<a href=\"http://staging.webspero.com/Quickvote/team.html#\" style=\"color: rgb(0, 123, 255); margin: 5px;\"><span class=\"fab fa-instagram\" style=\"color: rgb(0, 0, 0); font-size: 20px;\"></span></a></p></div></div></div><div class=\"owl-item cloned\" style=\"-webkit-tap-highlight-color: transparent; position: relative; backface-visibility: hidden; transform: translate3d(0px, 0px, 0px); min-height: 1px; float: left; width: 415.85px; margin-right: 2px;\"><div class=\"item first prev\" style=\"padding: 0px 20px;\"><div class=\"team-mem\" style=\"padding: 60px 0px; margin: 50px auto 20px; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.133) 0px 0px 11px 0px;\"></div></div></div></div></div></div>', NULL, NULL, NULL, '2021-01-18 09:11:57', '2021-01-18 09:11:57'),
(207, 'aboutus', 'banner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-18 10:46:02', '2021-01-18 10:46:02'),
(208, 'aboutus', 'about quickvote', 'About Quickvote', NULL, NULL, '<p style=\"margin-bottom: 30px; font-family: Montserrat, sans-serif; font-size: 18px; line-height: 1.8; letter-spacing: 0.5px; color: rgb(123, 123, 123);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p><p style=\"margin-bottom: 30px; font-family: Montserrat, sans-serif; font-size: 18px; line-height: 1.8; letter-spacing: 0.5px; color: rgb(123, 123, 123);\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>', '/uploads/images/3d5db715d1e890ea882b1482eef0f03a.png', NULL, NULL, '2021-01-18 10:46:02', '2021-01-18 10:46:02'),
(209, 'aboutus', 'our services', 'Our Services', NULL, NULL, 'Our platform is free to use, users just have to sign up to vote but you \r\ncan also use our freemium or paid plan for instant voting and other cool\r\n features.', NULL, NULL, NULL, '2021-01-18 10:46:02', '2021-01-18 10:46:02'),
(210, 'aboutus', 'dedicated', 'We are dedicated to making your poll contest a success.', NULL, NULL, '<span style=\"color: rgb(123, 123, 123); font-family: Montserrat, sans-serif; font-size: 16px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</span><ul class=\"lstyle\" style=\"padding: 0px; list-style: none; color: rgb(123, 123, 123); font-family: Poppins, sans-serif; font-size: 16px;\"><li style=\"width: 239.156px; float: left; margin-bottom: 10px; padding-left: 40px;\">Pagaents</li><li style=\"width: 239.156px; float: left; margin-bottom: 10px; padding-left: 40px;\">Awards</li><li style=\"width: 239.156px; float: left; margin-bottom: 10px; padding-left: 40px;\">Shows</li><li style=\"width: 239.156px; float: left; margin-bottom: 10px; padding-left: 40px;\">Election</li><li style=\"width: 239.156px; float: left; margin-bottom: 10px; padding-left: 40px;\">Contests</li></ul>', '/uploads/images/3d5db715d1e890ea882b1482eef0f03a.png', NULL, NULL, '2021-01-18 10:46:02', '2021-01-18 10:46:02'),
(211, 'aboutus', 'our services2', 'Our Services', NULL, NULL, '<span style=\"color: rgb(123, 123, 123); font-family: Montserrat, sans-serif; font-size: 16px; text-align: center;\">Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.</span>', NULL, NULL, NULL, '2021-01-18 10:46:02', '2021-01-18 10:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pricing_plans`
--

CREATE TABLE `pricing_plans` (
  `id` bigint UNSIGNED NOT NULL,
  `plan_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_heading` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_features` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `page_heading` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricing_plans`
--

INSERT INTO `pricing_plans` (`id`, `plan_type`, `plan_amount`, `plan_heading`, `plan_features`, `button_text`, `created_at`, `updated_at`, `page_heading`, `description`) VALUES
(1, 'FREEMIUM', '50,000', 'One-time Contest fee', 'Instant Voting, Support & Monitoring, Voters Pays to Vote, Result Exports', 'Create Freemium Contest', '2021-01-18 08:47:08', '2021-01-18 08:47:08', 'Our Pricing', 'Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.'),
(2, 'PAID', '20%', 'Service Charge Per Paid Vote', 'Instant Voting, Support & Monitoring, Voters Pays to Vote, Result Exports', 'Get Started', '2021-01-18 08:47:08', '2021-01-18 08:47:08', 'Our Pricing', 'Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2021-01-04 07:46:23', '2021-01-04 07:46:23'),
(2, 'vendor', 'web', '2021-01-04 07:46:23', '2021-01-04 07:46:23'),
(3, 'user', 'web', '2021-01-04 07:46:23', '2021-01-04 07:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 3, 20, '2021-02-23 07:32:43', '2021-02-23 07:32:43'),
(2, 2, 21, '2021-02-23 02:14:38', '2021-02-23 02:14:38'),
(3, 2, 20, '2021-02-23 07:08:12', '2021-02-23 07:08:12'),
(4, 2, 21, '2021-02-24 04:24:28', '2021-02-24 04:24:28'),
(5, 3, 22, '2021-02-24 06:20:12', '2021-02-24 06:20:12'),
(6, 2, 23, '2021-03-09 04:00:38', '2021-03-09 04:00:38'),
(7, 2, 25, '2021-03-10 04:04:13', '2021-03-10 04:04:13'),
(8, 1, 2, '2021-03-10 04:04:13', '2021-03-10 04:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `image`, `text`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Transparency', '/uploads/images/e7dcd67e3a005847c814d85c1f87b787.png', '<span style=\"color: rgb(123, 123, 123); font-family: Montserrat, sans-serif; font-size: 16px; text-align: center; background-color: rgba(255, 255, 255, 0.41);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</span><br>', 'top', '2021-01-05 15:57:38', '2021-01-07 14:05:07'),
(2, 'Easy to use', '/uploads/images/142a429829db28dfb2ddd527ceb145ef.png', '<span style=\"color: rgb(123, 123, 123); font-family: Montserrat, sans-serif; font-size: 16px; text-align: center; background-color: rgba(255, 255, 255, 0.41);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</span><br>', 'top', '2021-01-05 15:57:38', '2021-01-07 14:05:07'),
(3, 'Accessibilty', '/uploads/images/78f1f43e287cfb9141f92b609f1071ed.png', '<span style=\"color: rgb(123, 123, 123); font-family: Montserrat, sans-serif; font-size: 16px; text-align: center; background-color: rgba(255, 255, 255, 0.41);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</span><br>', 'top', '2021-01-05 15:57:38', '2021-01-07 14:05:07'),
(4, 'User Anonimity', '/uploads/images/d68f040b5739c1be443ad2db0bc1bcd0.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'bottom', '2021-01-05 15:59:16', '2021-01-07 14:05:34'),
(5, 'Results Safety', '/uploads/images/1825e96528c88a9499bad1f526e3c817.png', '<span style=\"color: rgb(123, 123, 123); font-family: Montserrat, sans-serif; font-size: 16px; text-align: center; background-color: rgba(255, 255, 255, 0.875);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</span><br>', 'bottom', '2021-01-05 15:59:16', '2021-01-07 14:05:35'),
(6, 'Easy to customize', '/uploads/images/3dea74c16755adbbda2ddfefe1307f2b.png', '<span style=\"color: rgb(123, 123, 123); font-family: Montserrat, sans-serif; font-size: 16px; text-align: center; background-color: rgba(255, 255, 255, 0.875);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</span><br>', 'bottom', '2021-01-05 15:59:16', '2021-01-07 14:05:35'),
(7, 'Mobile Ready', '/uploads/images/9984bb49157f305efe02bd09b6cf23e8.png', '<span style=\"color: rgb(123, 123, 123); font-family: Montserrat, sans-serif; font-size: 16px; text-align: center; background-color: rgba(255, 255, 255, 0.875);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</span><br>', 'bottom', '2021-01-05 15:59:16', '2021-01-07 14:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `heading1`, `heading2`, `heading3`, `description`, `img1`, `img2`, `img3`, `created_at`, `updated_at`) VALUES
(5, 'home', 'EVER WISHED FOR', 'Transparent DigitalPolls?', NULL, '<span style=\"color: rgb(255, 255, 255); font-family: Montserrat, sans-serif; font-size: 19px; letter-spacing: 0.5px; text-align: center;\">Create a poll Contest in seconds. Your voters can vote from any location on any device.</span><br>', '/uploads/images/e7eac920dc873f78152f77256b7f31c2.jpg', NULL, NULL, '2020-12-28 04:02:46', '2021-01-05 15:43:48'),
(6, 'home', 'EVER WISHED FOR', 'Transparent DigitalPolls?', NULL, '<span style=\"color: rgb(255, 255, 255); font-family: Montserrat, sans-serif; font-size: 19px; letter-spacing: 0.5px; text-align: center;\">Create a poll Contest in seconds. Your voters can vote from any location on any device.</span><br>', '/uploads/images/0e8ae4dab6741988dc7420c52af4c5c8.jpg', NULL, NULL, '2020-12-28 04:39:06', '2021-01-05 15:41:39'),
(7, 'home', 'EVER WISHED FOR 1', 'Transparent DigitalPolls?', NULL, '<span style=\"color: rgb(255, 255, 255); font-family: Montserrat, sans-serif; font-size: 19px; letter-spacing: 0.5px; text-align: center;\">Create a poll Contest in seconds. Your voters can vote from any location on any device.</span><br>', '/uploads/images/545cc6ebb3e5cc41ed6c419eac339409.jpg', NULL, NULL, '2020-12-28 04:40:20', '2021-01-05 15:41:19'),
(8, 'trusted brands', NULL, NULL, NULL, NULL, '/uploads/images/334cfb35a32292b9fd97b0d4092642d4.png', NULL, NULL, '2020-12-28 05:29:59', '2021-01-05 15:40:34'),
(9, 'trusted brands', NULL, NULL, NULL, NULL, '/uploads/images/4a63a8ecd9134fa5e57f3c2bdb2d1b9f.png', NULL, NULL, '2020-12-28 05:31:09', '2021-01-05 15:40:30'),
(10, 'trusted brands', NULL, NULL, NULL, NULL, '/uploads/images/8994d3f8dea02357dd9891f26749e90e.png', NULL, NULL, '2020-12-28 05:32:00', '2021-01-05 15:40:24'),
(11, 'trusted brands', NULL, NULL, NULL, NULL, '/uploads/images/ba66d1e0d76cae3be1756892a49bd6d6.png', NULL, NULL, '2020-12-28 05:32:09', '2021-01-05 15:40:19'),
(12, 'trusted brands', NULL, NULL, NULL, NULL, '/uploads/images/9591a98fcfb052f4aa5752460590c751.png', NULL, NULL, '2020-12-28 05:32:45', '2021-01-05 15:40:15'),
(13, 'trusted brands', NULL, NULL, NULL, NULL, '/uploads/images/b40c067c106be88a94609d81b19371f1.png', NULL, NULL, '2020-12-28 05:32:56', '2021-01-05 15:39:51'),
(14, 'trusted brands', NULL, NULL, NULL, NULL, '/uploads/images/7512146e9fe04fc9c1260d511ecffcbe.png', NULL, NULL, '2020-12-28 05:33:19', '2021-01-05 15:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `social_facebook_accounts`
--

CREATE TABLE `social_facebook_accounts` (
  `user_id` int NOT NULL,
  `provider_user_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int NOT NULL,
  `country_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`, `country_code`, `created_at`, `updated_at`) VALUES
(1, 'Lagos', 1, 'NA', '2021-03-02 03:52:00', '2021-03-02 03:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `description`, `created_by`, `image`, `created_at`, `updated_at`) VALUES
(7, 1, 'sub test', '<p>dsfsd dsfds sdfsd sdfds sdfds sdfsa as sadfds&nbsp;</p>', '21', '/uploads/images/45c5459ccfbbb13de63d413c7af815be.jpeg', '2021-02-25 23:13:09', '2021-02-25 23:13:09'),
(8, 2, 'test Testimonials', '<p>sd dsfds sdf saf sdf sdf sdfsdf dsfsdfsdf</p>', '21', '/uploads/images/d58ab4cb0694ae203996651ff79e4596.png', '2021-02-25 23:13:25', '2021-02-25 23:13:25'),
(9, 2, 'abc sub cat', '<p>sdgdf dfg dfgdfg dgdfsgdf gdfgdfg dfgdsfgdg</p>', '21', '/uploads/images/ce2f2df784f450fdb166deae78034240.png', '2021-02-25 23:14:15', '2021-02-25 23:14:15'),
(10, 4, 'wwww', '<p>gfh fghgfhgfh fghfgh fghfghgf</p>', '21', '/uploads/images/c31802f8f21cdb331b7b3dc773778188.jpg', '2021-02-25 23:14:36', '2021-02-25 23:14:36'),
(11, 3, 'ttttttt', '<p>fghfg gfhfgh gfhgfhfgh</p>', '21', '/uploads/images/7f88d9041f3330bdbddf465e7f0a9fc4.png', '2021-02-25 23:14:56', '2021-02-25 23:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `image`, `name`, `designation`, `created_at`, `updated_at`) VALUES
(1, '/uploads/images/9c10ff617f27d0059997f93165fe6171.png', 'tiya', 'developer', '2021-01-07 05:14:18', '2021-01-13 10:20:39'),
(2, '/uploads/images/5943f37ac339b73663d2b4b7c8fa9676.png', 'John Paul', 'executive', '2021-01-13 10:21:07', '2021-01-13 10:21:07'),
(3, '/uploads/images/ff28ca4f72a439d4f3814ea1b30420a3.png', 'reza', 'designer', '2021-01-13 10:21:34', '2021-01-13 10:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `img`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, '/uploads/images/42d8d6eabe4c843f870b45768f39209c.png', 'Ximena Vegara', '<span style=\"color: rgb(34, 34, 34); font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; font-size: 12px; white-space: pre-wrap;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</span><br>', '2021-01-13 10:07:39', '2021-01-13 10:07:39'),
(2, '/uploads/images/760a0767ea51ef75e4d386058bff02f2.png', 'John Paul', '<span style=\"color: rgb(34, 34, 34); font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; font-size: 12px; white-space: pre-wrap;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</span><br>', '2021-01-13 10:09:01', '2021-01-13 10:09:01'),
(3, '/uploads/images/9c9a0332207c597b6967f6af8e8a3da6.png', 'jaun paul', '<span style=\"color: rgb(34, 34, 34); font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; font-size: 12px; white-space: pre-wrap;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</span><br>', '2021-01-13 10:12:23', '2021-01-13 10:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_number` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_by` int NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_number`, `ticket_type`, `name`, `quantity`, `price`, `start_date`, `end_date`, `created_by`, `event_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'paid', 'first tecket', '33', '333', '2021-04-19', '2021-05-28', 2, 1, '2021-03-09 03:08:06', '2021-03-09 03:08:06'),
(2, NULL, 'paid', 'second tecket', '33', '333', '2021-04-19', '2021-05-28', 2, 1, '2021-03-09 03:08:06', '2021-03-09 03:08:06'),
(3, NULL, 'paid', 'asdas', '334', '34', '2021-02-19', '2021-05-28', 2, 8, '2021-03-11 07:01:06', '2021-03-11 07:01:06'),
(4, NULL, 'paid', 'sdfsdaf', '33', '435', '2021-02-16', '2021-05-28', 2, 9, '2021-03-11 07:02:25', '2021-03-11 07:02:25'),
(5, NULL, 'paid', 'sdfsdafsad', '3', '333', '2021-02-16', '2021-02-28', 2, 9, '2021-03-11 07:02:26', '2021-03-11 07:02:26'),
(6, NULL, 'paid', 'dsfgdfsg', '44', '33', '2021-02-17', '2021-03-17', 25, 11, '2021-03-11 07:46:28', '2021-03-11 07:46:28'),
(7, NULL, 'paid', 'dsfgdfsg', '44', '444', '2021-02-17', '2021-03-17', 25, 11, '2021-03-11 07:46:28', '2021-03-11 07:46:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternate_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `gender`, `image`, `type`, `provider`, `provider_id`, `google_id`, `business_name`, `contact_name`, `phone`, `alternate_phone`, `address1`, `address2`, `city_id`, `state_id`, `postal`, `country_id`, `facebook`, `twitter`, `instagram`, `description`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'demo@yopmail.com', '$2y$10$Y4qUf8ia1lAddZBpbYXtrul4cNBpUPAv7HgL.5I3pCgZxHNmGSlW.', NULL, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-28 15:58:23', NULL, '2020-12-28 15:58:01', '2020-12-28 15:58:23'),
(2, NULL, NULL, 'admin@yopmail.com', '$2y$10$PrAhMYTjMpkRRnYnwwspgu0oO0AVht5esFsjWIFJ//X4gCAAmZY5y', NULL, NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-28 15:58:23', 'YqOVCJOIldii1atQcdY1zeA5NZsOn2oRvEXy6nWxP0CapHjcE80YMVrfySsF', '2020-12-28 15:58:01', '2021-01-18 04:22:54'),
(3, 'abc', 'vendor', 'vendor@yopmail.com', '$2y$10$nFJlB4dpC/2BCOYjRqShQuL/yR6/vWnEoYoJmzo/oPItzqDL7kuQ6', NULL, NULL, 'vendor', NULL, NULL, NULL, 'my business', NULL, '12524301', '12536030', 'address', 'address2', '24320', '3014', '203250', '82', NULL, NULL, NULL, NULL, '2021-01-13 16:07:10', NULL, '2021-01-13 10:30:49', '2021-01-29 14:24:25'),
(4, NULL, NULL, 'demouser@yopmail.com', '$2y$10$nFC9OwuUDzghdRGY0jd5cuG7dcUmOutMkkPoKBgtoznQbOECRp2Bq', NULL, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-14 06:08:23', NULL, '2021-01-14 06:08:01', '2021-01-14 06:08:23'),
(5, NULL, NULL, 'test@yopmail.com', '$2y$10$sciWqbzmTy9nAtkwrANX2.ov0WKuVczysin4QzICm.7MTRDcp8NCC', NULL, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-14 09:08:19', '2021-01-14 09:08:19'),
(6, 'Pallavi', 'Qa', 'testing@yopmail.com', '$2y$10$Grx0p6ZBaxBhrruE3AanoeP4GIjBY1vr068EQJXwksLKxmnRw8L8S', NULL, NULL, 'user', NULL, NULL, NULL, NULL, NULL, '1299300498930300373778329', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-14 09:53:19', 'UqBoB11Zbkkejvsd7voY4ySBc236mEbkiXhzm45zNrrRg7atFa40o6Ey6xDq', '2021-01-14 09:49:44', '2021-01-15 07:26:51'),
(7, NULL, NULL, 'testing111@yopmail.com', '$2y$10$rUAN3sF9vFIYpwp/uKffnefoNlVMUt8eg1c5AxGj6aRnsyKzgQJ1u', NULL, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-14 10:22:14', '2021-01-14 10:22:14'),
(8, NULL, NULL, 'testttt@yopmail.com', '$2y$10$lJsx4t.Eg5Weoew3TFnZEOyswGwmOOZK3vnFp9n177cakmuz0xUge', NULL, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-14 10:26:23', '2021-01-14 10:26:23'),
(9, 'demo', 'vendor', 'event-Vendor@yopmail.com', '$2y$10$xCZls7JewIU9Ni479BwOEO6oMBGWsUVfQI8d7Ql3O1h2SHlbbO7kC', NULL, NULL, 'vendor', NULL, NULL, NULL, 'event management', NULL, '12348596', '145263415', 'address', 'strret2', '76964', '298', '256310', '161', NULL, NULL, NULL, NULL, '2021-01-14 12:46:17', NULL, '2021-01-14 12:45:17', '2021-01-14 12:46:17'),
(10, NULL, NULL, 'demo-user@yopmail.com', '$2y$10$N1F1TC9hy8vj1UJd/SHrEO/C2.jG7gpnGbeG/35dlicNBnBXW7NOO', NULL, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-14 12:52:11', NULL, '2021-01-14 12:51:47', '2021-01-14 12:52:11'),
(11, 'Garima', 'Shukla', 'garima.webspero@gmail.com', 'eyJpdiI6Ilo5TzV0RURmUWhxVU1YSHVOVW9lTWc9PSIsInZhbHVlIjoiUkdCdS9wZjlkQVdDRnVZM1B5elhSMmMweVUxZUsvTkFaRk5ERXN5YkpTaz0iLCJtYWMiOiI3M2RjMjk4M2VlM2MwNjkyY2Q4Zjg4N2FlNDJjOGM4NDk5N2QyOThlMTM1NWZhZmViNTQxZjczM2Y0ZjAxNGEzIn0=', NULL, NULL, NULL, NULL, NULL, '102131811526497954764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-14 12:59:19', '2021-01-14 12:59:19'),
(12, 'Eze', 'Kingsley', 'toastmagazinenigeria@gmail.com', 'eyJpdiI6ImJNSng1bGJyajVjTU1pd2N2bDNBSFE9PSIsInZhbHVlIjoiMTFHUEpIVW52WWFRczJtbDhxUzk5bjVoNmVmc1ZMOXNWVG1rZTExbkVXND0iLCJtYWMiOiI0NjExNDExZGRmZDYyMmZhYzg2NzYwNjFlNWM3YTMxNDMwYjQ5MjlmZTE0NTFjYTI3YWM2YTc3ZGNlZmMwODI1In0=', NULL, NULL, NULL, NULL, NULL, '106880716961546153507', NULL, NULL, '+2348053682130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-14 16:02:32', '2021-01-14 16:02:49'),
(13, 'demo', 'vendor', 'demoVendor@yopmail.com', '$2y$10$PrAhMYTjMpkRRnYnwwspgu0oO0AVht5esFsjWIFJ//X4gCAAmZY5y', NULL, NULL, 'vendor', NULL, NULL, NULL, 'business', NULL, '415230', '1252630', 'address', 'ss', '76828', '300', '102030', '161', NULL, NULL, NULL, NULL, '2021-01-14 16:54:50', NULL, '2021-01-14 16:54:32', '2021-01-14 16:54:50'),
(14, 'test vendor name', 'test last name', 'testvendor@yopmail.com', '$2y$10$HYs3koFpHIlAZo.dybRHG.R6LY/YaWepLnoj6W.rUOvIvZ5L3Dfmi', NULL, NULL, 'vendor', NULL, NULL, NULL, 'test business name', NULL, '0987654321', '11111235677900001939345', 'test add1', 'test add2', '77051', '295', '123003', '161', NULL, NULL, NULL, NULL, '2021-01-15 05:16:49', NULL, '2021-01-15 05:12:39', '2021-01-15 05:42:13'),
(17, 'new', 'user', 'my@yopmail.com', '$2y$10$Ipxo7rSfHdZcB4hkhGuokewcNMZrWGNBWcqBVPLvTdVCjASranCoW', NULL, NULL, 'user', NULL, NULL, NULL, 'jhjhjk', 'hjgjh', '12345678', '123456352', 'kjkhjkh', 'jghjgjhh', '724', '3644', '12301', '11', NULL, NULL, NULL, 'hffhghg', '2021-01-18 09:16:54', NULL, '2021-01-18 09:16:54', '2021-01-18 09:16:54'),
(16, 'testuser', 'qa', 'testuser@yopmail.com', '$2y$10$y4n5MXWDF65sHqpYZs6Uuu4evS1lxSL2gH/dA3gKy3OPLXGf0wXJq', NULL, NULL, 'user', NULL, NULL, NULL, 'test', '121323131231', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-18 04:42:09', NULL, '2021-01-18 04:42:09', '2021-01-18 04:42:09'),
(18, NULL, NULL, 'new-user@yopmail.com', '$2y$10$TkuUdWfPqwNvPTeIO6xhiufDzXHGQ7pjjDbz5Pwiqqr5cUZPOj8au', NULL, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-18 09:42:20', NULL, '2021-01-18 09:42:05', '2021-01-18 09:42:20'),
(19, 'New', 'Vendor', 'new-vendor@yopmail.com', '$2y$10$PrAhMYTjMpkRRnYnwwspgu0oO0AVht5esFsjWIFJ//X4gCAAmZY5y', NULL, NULL, 'vendor', NULL, NULL, NULL, 'travel', NULL, '10234521', '12526341', 'hjgh', 'hgh23000', '77025', '299', '1020320', '161', NULL, NULL, NULL, NULL, '2021-01-18 09:46:20', '8nejbDombmuvsG4aJXoRJGcATqVDYtU79YbiCu1a9S9ivPxY47Uw7qvRks64', '2021-01-18 09:46:06', '2021-02-24 04:16:07'),
(20, 'dsfgdsfg', 'dfsgdsfgsdf', 'dss@c.com', '$2y$10$Xrvs7rrJxdYw/JETxxcx5eqI6FkVK10iRXmTSGJjQ0asG7VtIaxHa', NULL, NULL, 'vendor', NULL, NULL, NULL, 'dfsgsdfg', NULL, '3534534534', '345435345', 'dfsgdfsg', 'gdfsgdsfg', '76947', '323', '3453453', '161', NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-23 07:08:12', '2021-02-23 07:08:12'),
(21, 'Dilpreet', 'Sandhu', 'dilpreet@webspero.com', '$2y$10$/iDtyJuReVq6SgO66RUNaeJWkcvsYo0NPBa7TlINX3eIDSMZk5r5u', 'male', NULL, 'vendor', NULL, NULL, NULL, 'abc business', NULL, '09876543210', '12345678890', 'abc address', 'abc address 2', '77091', '288', '123456', '161', NULL, 'https://www.twitter.com/dilpreet1', 'https://www.instagram.com/dilpreet1', NULL, '2021-02-24 10:12:13', 'SXWKwoGnRdnIVOVlssaIDXvylwOAzrHsixSivJA3OsS5yXzHsB61ZVanAbcW', '2021-02-24 04:24:28', '2021-02-24 06:09:08'),
(22, 'abc', 'dfgdsfgdfs', 'dss@g.cm', '$2y$10$CxUS434y1wMLbkLw0o3qqO52igPjAuUwlfuW3.ZTthUxy56cRWa76', 'male', '/uploads/images/382bb1d56e56fc00903383b61d01036f.png', 'user', NULL, NULL, NULL, 'dfsgfsdgfsdg', '435345435', '32432534254', '3254325432', 'egdsfgsdfgdsfg', 'sdfgdsfgfdsg', '76925', '308', '435646', '161', NULL, 'https://www.twitter.com/dilpreet1', 'https://www.instagram.com/dilpreet1', 'dfsdf sdfsdafsd', '2021-02-24 06:20:12', NULL, '2021-02-24 06:20:12', '2021-02-26 02:54:12'),
(23, 'dsfgdsfgdsf', 'fdgdfsgd', 'abcvandor@gmail.com', '$2y$10$92HyWglsUw4ecmQj8jacpum5F9A0sw0PT5JjE/YWZWeVpdWVFzUsW', NULL, NULL, 'vendor', NULL, NULL, NULL, 'asdsasad', NULL, '34234234', 'fdgdfsgdfsg', 'dfsgdfgdfg', 'dfgdfgdfg', '1', '1', '454334', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-09 04:00:38', '2021-03-09 04:00:38'),
(24, 'sdfgsdfg', 'sfdgdsfg', 'zxcv@yopmail.com', '$2y$10$/taLEhMVBozgIGOT8.dOTubwPNgXSGOod7ThYPRUB7o1K.qMyfAwa', NULL, NULL, 'vendor', NULL, NULL, NULL, 'dfsgdsfgsdfg', NULL, '5435344', '345345', 'dfsgdf dfsgdfsgdfs dfg', 'dfsgdsfgd dfsgdf dsfg', '2', '1', '4354445', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-10 03:54:22', '2021-03-10 03:54:22'),
(25, 'sdfgfdsg', 'dfsgdfsg', 'zxc@yopmail.com', '$2y$10$PrAhMYTjMpkRRnYnwwspgu0oO0AVht5esFsjWIFJ//X4gCAAmZY5y', NULL, NULL, 'vendor', NULL, NULL, NULL, 'dfsgdfs', NULL, '546456', '346', 'fdhf fgh fghf', 'h fgh fgh fgh fh', '2', '1', '234323', '1', NULL, NULL, NULL, NULL, '2021-03-01 09:41:49', 'x0odU8szpjbSxGZCj4VARaYZl4oz7IeFBBcCGeT0pLCvp9bk5gugoiaEod2B', '2021-03-10 04:04:13', '2021-03-10 04:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `voting_contestants`
--

CREATE TABLE `voting_contestants` (
  `id` bigint UNSIGNED NOT NULL,
  `contestant_id` bigint UNSIGNED NOT NULL,
  `voting_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` int NOT NULL,
  `votes` int DEFAULT NULL,
  `coupon` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` int DEFAULT NULL,
  `eachamount` decimal(8,2) DEFAULT NULL,
  `totalamount` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `voting_contestants`
--

INSERT INTO `voting_contestants` (`id`, `contestant_id`, `voting_id`, `name`, `category_id`, `email`, `phone`, `votes`, `coupon`, `discount`, `eachamount`, `totalamount`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'abc user', NULL, 'admin@yopmail.com', 32423432, 59, NULL, NULL, NULL, NULL, '2021-03-09 03:20:57', '2021-03-09 03:25:55'),
(2, 1, 1, 'test1234', NULL, 'admin@yopmail.com', 456436, 3, NULL, NULL, NULL, NULL, '2021-03-09 03:29:49', '2021-03-09 03:29:49'),
(3, 1, 1, 'test Testimonials', NULL, 'admin@admin.com', 6435, 47, NULL, NULL, NULL, NULL, '2021-03-09 03:29:58', '2021-03-09 03:31:05'),
(4, 3, 1, 'gfhfgh', NULL, 'new-vendor@yopmail.com', 32423432, 45, NULL, NULL, NULL, NULL, '2021-03-09 03:31:38', '2021-03-09 03:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `voting_contests`
--

CREATE TABLE `voting_contests` (
  `id` bigint UNSIGNED NOT NULL,
  `category` enum('1','2') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=>Pageants (Not Categorized) ,2=>Awards (Categorized)',
  `category_id` int DEFAULT NULL,
  `type` enum('paid','free') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'free',
  `packages` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=>Disabled,1=>Enabled',
  `limit` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=>Disabled,1=>Enabled',
  `limit_count` int DEFAULT NULL,
  `profile_view` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=>OFF,1=>ON',
  `payment_gateway` enum('paystack','flutterwavwe','payu','interswitch') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'paystack',
  `payment_crypto` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `title` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fees` double DEFAULT NULL,
  `starting_date` datetime NOT NULL,
  `closing_date` datetime NOT NULL,
  `timezone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` enum('Pending','Accepted','Rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `reason` text COLLATE utf8_unicode_ci,
  `added_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `voting_contests`
--

INSERT INTO `voting_contests` (`id`, `category`, `category_id`, `type`, `packages`, `limit`, `limit_count`, `profile_view`, `payment_gateway`, `payment_crypto`, `title`, `image`, `fees`, `starting_date`, `closing_date`, `timezone`, `description`, `status`, `reason`, `added_by`, `created_at`, `updated_at`) VALUES
(1, '2', 6, 'free', '0', '1', 12, '0', 'flutterwavwe', '0', 'Votes first', '/uploads/images/5b6bb83db5d811518f5b2eb5d7353c15.jpg', 12, '2021-09-03 14:08:00', '2021-03-31 00:00:00', 'Africa/Lagos', 'sdafdsafdsfsadfsdaf', 'Accepted', NULL, 2, '2021-03-09 03:08:57', '2021-03-10 23:26:24'),
(2, '2', 8, 'free', '0', '0', NULL, '0', 'paystack', '0', 'vote first', '/uploads/images/3fb399f1a0bca436086a551e33a26f52.png', 123, '2021-11-03 10:25:00', '2021-04-21 10:25:00', 'Africa/Lagos', 'fgh', 'Accepted', NULL, 2, '2021-03-10 23:26:02', '2021-03-11 03:33:42'),
(4, '1', 8, 'paid', '1', '0', NULL, '0', 'paystack', '0', 'ghj hgjgh', '/uploads/images/bc4f6a753c4de0bb2e61c3ec4dc1a9f6.png', 565, '2021-03-11 15:02:00', '2021-03-31 15:02:00', 'Africa/Lagos', 'gjgh   gfjghj                         ghjgh', 'Accepted', NULL, 25, '2021-03-11 04:02:34', '2021-03-11 04:02:34'),
(5, '2', 10, 'free', '1', '1', 653, '0', 'payu', '0', 'gjgf gjhj', NULL, 66, '2021-03-11 15:03:00', '2021-04-01 15:03:00', 'Africa/Lagos', 'hjgfjg', 'Accepted', NULL, 25, '2021-03-11 04:03:52', '2021-03-11 04:03:52'),
(6, '2', 8, 'free', '0', '0', NULL, '0', 'flutterwavwe', '0', 'xcvxcvxc', '/uploads/images/75479f8c40a2a40b1d60be18f596d694.jpg', 3333, '2021-03-15 16:23:00', '2021-03-30 16:23:00', 'Africa/Lagos', 'sdf dsf sdfsd fsdfsdfs dfsdf', 'Accepted', NULL, 2, '2021-03-15 05:24:01', '2021-03-15 05:24:01'),
(7, '2', 13, 'free', '0', '0', NULL, '0', 'paystack', '0', 'vote test cont', '/uploads/images/6e004e9d77b6df8c50b201b014b428a0.jpg', 1234, '1970-01-01 00:00:00', '2021-01-04 11:43:00', 'Africa/Lagos', 'Sdafsadf', 'Accepted', NULL, 25, '2021-03-16 00:44:10', '2021-03-16 01:21:32'),
(8, '2', 13, 'free', '0', '0', NULL, '0', 'paystack', '0', 'test two', '/uploads/images/61547361e308c833332b9137c532df1e.jpeg', 343, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'Africa/Lagos', 'Fghfghfghfghfgh', 'Accepted', NULL, 25, '2021-03-16 01:25:01', '2021-03-16 03:13:18'),
(9, '2', 13, 'free', '0', '0', NULL, '0', 'flutterwavwe', '0', 'tgbnn', '/uploads/images/448109abd662f2281370cb1d370ad521.jpg', 344, '2021-03-16 12:48:00', '2021-03-31 12:48:00', 'Africa/Lagos', 'dffdfdf', 'Accepted', NULL, 25, '2021-03-16 01:48:36', '2021-03-16 01:48:36'),
(10, '1', NULL, 'free', '0', '0', NULL, '0', 'paystack', '0', 'tst 2345', '/uploads/images/c0771fc583497628c78d77eb5a09ebdc.png', 33, '2021-03-16 12:48:00', '2021-03-31 12:48:00', 'Africa/Lagos', 'dfgdfgdsfgfd', 'Accepted', NULL, 25, '2021-03-16 01:48:56', '2021-03-16 01:48:56'),
(11, '2', 13, 'free', '0', '0', NULL, '0', 'paystack', '0', 'fghfghgfh', '/uploads/images/2f95605640f9c7c9dc235f58fe2ba21c.jpg', 232, '2021-03-16 16:41:00', '2021-03-31 16:41:00', 'Africa/Lagos', 'dfgdfsgdfsgdfsg', 'Accepted', NULL, 25, '2021-03-16 05:41:44', '2021-03-16 05:41:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_details`
--
ALTER TABLE `account_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_informations`
--
ALTER TABLE `company_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_queries`
--
ALTER TABLE `contact_queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contestants`
--
ALTER TABLE `contestants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured_events`
--
ALTER TABLE `featured_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_event_id_foreign` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `voting_contestants`
--
ALTER TABLE `voting_contestants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voting_contestants_contestant_id_foreign` (`contestant_id`),
  ADD KEY `voting_contestants_voting_id_foreign` (`voting_id`);

--
-- Indexes for table `voting_contests`
--
ALTER TABLE `voting_contests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_details`
--
ALTER TABLE `account_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_informations`
--
ALTER TABLE `company_informations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contact_queries`
--
ALTER TABLE `contact_queries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contestants`
--
ALTER TABLE `contestants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `featured_events`
--
ALTER TABLE `featured_events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `voting_contestants`
--
ALTER TABLE `voting_contestants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voting_contests`
--
ALTER TABLE `voting_contests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `voting_contestants`
--
ALTER TABLE `voting_contestants`
  ADD CONSTRAINT `voting_contestants_contestant_id_foreign` FOREIGN KEY (`contestant_id`) REFERENCES `contestants` (`id`),
  ADD CONSTRAINT `voting_contestants_voting_id_foreign` FOREIGN KEY (`voting_id`) REFERENCES `voting_contests` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
