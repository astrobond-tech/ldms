-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2025 at 11:10 AM
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
-- Database: `drms`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_pages`
--

CREATE TABLE `auth_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `section` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auth_pages`
--

INSERT INTO `auth_pages` (`id`, `title`, `description`, `section`, `image`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, '[\"Secure Access, Seamless Experience.\",\"Your Trusted Gateway to Digital Security.\",\"Fast, Safe & Effortless Login.\"]', '[\"Securely access your account with ease. Whether you\'re logging in, signing up, or resetting your password, we ensure a seamless and protected experience. Your data, your security, our priority.\",\"Fast, secure, and hassle-free authentication. Sign in with confidence and experience a seamless way to access your account\\u2014because your security matters.\",\"A seamless and secure way to access your account. Whether you\'re logging in, signing up, or recovering your password, we ensure your data stays protected at every step.\"]', '1', 'upload/images/auth_page.svg', 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `book_assigns`
--

CREATE TABLE `book_assigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assign_to` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `room_no` varchar(255) DEFAULT NULL,
  `rack_no` varchar(255) DEFAULT NULL,
  `shelf_no` varchar(255) DEFAULT NULL,
  `box_no` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `archive` tinyint(1) DEFAULT 0,
  `stage_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `contact_number` varchar(191) DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `rate` double(8,2) NOT NULL DEFAULT 0.00,
  `applicable_packages` varchar(191) DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `valid_for` date DEFAULT NULL,
  `use_limit` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_histories`
--

CREATE TABLE `coupon_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon` int(11) NOT NULL DEFAULT 0,
  `package` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `archive` int(11) NOT NULL DEFAULT 0,
  `stage_id` text DEFAULT NULL,
  `assign_to` text DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `sub_category_id` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `tages` varchar(191) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_comments`
--

CREATE TABLE `document_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `document_id` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_histories`
--

CREATE TABLE `document_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document` int(11) NOT NULL DEFAULT 0,
  `action` varchar(191) DEFAULT NULL,
  `action_user` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `f_a_q_s`
--

CREATE TABLE `f_a_q_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `enabled` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `f_a_q_s`
--

INSERT INTO `f_a_q_s` (`id`, `question`, `description`, `enabled`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'What features does your software offer?', 'Our software provides a range of features including automation tools, real-time analytics, cloud-based access, secure data storage, seamless integrations, and customizable solutions tailored to your business needs.', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(2, 'Is your software easy to use?', 'Yes! Our platform is designed to be user-friendly and intuitive, so your team can get started quickly without a steep learning curve.', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(3, 'Can I integrate your software with my existing systems?', 'Absolutely! Our software is built to easily integrate with your current tools and systems, making the transition seamless and efficient.', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(4, 'Is customer support available?', 'Yes! We offer 24/7 customer support. Our dedicated team is ready to assist you with any questions or issues you may have.', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(5, 'Is my data secure with your software?', 'Yes. We use advanced encryption and data protection protocols to ensure your data is secure and private at all times.', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(6, 'Can I customize the software to fit my business needs?', 'Yes! Our software is highly customizable to adapt to your unique workflows and requirements.', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(7, 'What types of businesses can benefit from your software?', 'Our solutions are suitable for a wide range of industries, including retail, healthcare, finance, marketing, and more. We tailor our offerings to meet the specific needs of each business.', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(8, 'Is there a free trial available?', 'Yes! We offer a free trial so you can explore the features and capabilities of our software before committing.', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(9, 'Do I need technical expertise to use the software?', 'Not at all. Our software is designed for users of all skill levels. Plus, our support team is available to guide you through any setup or usage questions.', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(10, 'How often is the software updated?', 'We regularly release updates to improve features, security, and overall performance, ensuring that you always have access to the latest technology.', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `home_pages`
--

CREATE TABLE `home_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `section` varchar(191) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `content_value` text DEFAULT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_pages`
--

INSERT INTO `home_pages` (`id`, `title`, `section`, `content`, `content_value`, `enabled`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Header Menu', 'Section 0', NULL, '{\"name\":\"Header Menu\",\"menu_pages\":[\"1\",\"2\"]}', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(2, 'Banner', 'Section 1', NULL, '{\"name\":\"Banner\",\"section_enabled\":\"active\",\"title\":\"DRMS SaaS - Digital Record Management System\",\"sub_title\":\"Document and Records Management System (DRMS SaaS) software refers to the various features and functionalities that the software offers to help organizations manage their digital documents effectively.\",\"btn_name\":\"Get Started\",\"btn_link\":\"#\",\"section_footer_text\":\"Manage your business efficiently with our all-in-one solution designed for performance, security, and scalability.\",\"section_footer_image\":{},\"section_main_image\":{},\"section_footer_image_path\":\"upload\\/homepage\\/banner_2.png\",\"section_main_image_path\":\"upload\\/homepage\\/banner_1.png\",\"box_image_1_path\":\"\",\"box_image_2_path\":\"\",\"box_image_3_path\":\"\",\"Box1_image_path\":\"\",\"Box2_image_path\":\"\",\"Sec4_box1_image_path\":\"\",\"Sec4_box2_image_path\":\"\",\"Sec4_box3_image_path\":\"\",\"Sec4_box4_image_path\":\"\",\"Sec4_box5_image_path\":\"\",\"Sec4_box6_image_path\":\"\",\"Sec7_box1_image_path\":\"\",\"Sec7_box2_image_path\":\"\",\"Sec7_box3_image_path\":\"\",\"Sec7_box4_image_path\":\"\",\"Sec7_box5_image_path\":\"\",\"Sec7_box6_image_path\":\"\",\"Sec7_box7_image_path\":\"\",\"Sec7_box8_image_path\":\"\"}', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(3, 'OverView', 'Section 2', NULL, '{\"name\":\"OverView\",\"section_enabled\":\"active\",\"Box1_title\":\"Customers\",\"Box1_number\":\"500+\",\"Box2_title\":\"Subscription Plan\",\"Box2_number\":\"4+\",\"Box3_title\":\"Language\",\"Box3_number\":\"11+\",\"box1_number_image\":{},\"box2_number_image\":{},\"box3_number_image\":{},\"section_footer_image_path\":\"\",\"section_main_image_path\":\"\",\"box_image_1_path\":\"upload\\/homepage\\/OverView_1.svg\",\"box_image_2_path\":\"upload\\/homepage\\/OverView_2.svg\",\"box_image_3_path\":\"upload\\/homepage\\/OverView_3.svg\",\"Box1_image_path\":\"\",\"Box2_image_path\":\"\",\"Sec4_box1_image_path\":\"\",\"Sec4_box2_image_path\":\"\",\"Sec4_box3_image_path\":\"\",\"Sec4_box4_image_path\":\"\",\"Sec4_box5_image_path\":\"\",\"Sec4_box6_image_path\":\"\",\"Sec7_box1_image_path\":\"\",\"Sec7_box2_image_path\":\"\",\"Sec7_box3_image_path\":\"\",\"Sec7_box4_image_path\":\"\",\"Sec7_box5_image_path\":\"\",\"Sec7_box6_image_path\":\"\",\"Sec7_box7_image_path\":\"\",\"Sec7_box8_image_path\":\"\"}', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(4, 'AboutUs', 'Section 3', NULL, '{\"name\":\"AboutUs\",\"section_enabled\":\"active\",\"Box1_title\":\"Empower Your Business to Thrive with Us\",\"Box1_info\":\"Unlock growth, streamline operations, and achieve success with our innovative solutions.\",\"Box1_list\":[\"Simplify and automate your business processes for maximum efficiency.\",\"Receive tailored strategies to meet business needs and unlock potential.\",\"Grow confidently with flexible solutions that adapt to your business needs.\",\"Make smarter decisions with real-time analytics and performance tracking.\",\"Rely on 24\\/7 expert assistance to keep your business running smoothly.\"],\"Box2_title\":\"Eliminate Paperwork, Elevate Productivity\",\"Box2_info\":\"Simplify your operations with seamless digital solutions and focus on what truly matters.\",\"Box2_list\":[\"Replace manual paperwork with automated workflows.\",\"Secure cloud storage lets you manage documents on the go.\",\"Streamlined processes save time and reduce errors.\",\"Keep your information safe with encrypted storage.\",\"Reduce printing, storage, and administrative expenses.\",\"Go green by minimizing paper use and waste.\"],\"section_footer_image_path\":\"\",\"section_main_image_path\":\"\",\"box_image_1_path\":\"\",\"box_image_2_path\":\"\",\"box_image_3_path\":\"\",\"Box1_image_path\":\"upload\\/homepage\\/img-customize-1.svg\",\"Box2_image_path\":\"upload\\/homepage\\/img-customize-2.svg\"}', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(5, 'Offer', 'Section 4', NULL, '{\"name\":\"Offer\",\"section_enabled\":\"active\",\"Sec4_title\":\"What Our Software Offers\",\"Sec4_info\":\"Our software provides powerful, scalable solutions designed to streamline your business operations.\",\"Sec4_box1_title\":\"User-Friendly Interface\",\"Sec4_box1_enabled\":\"active\",\"Sec4_box1_info\":\"Simplify operations with an intuitive and easy-to-use platform.\",\"Sec4_box2_title\":\"End-to-End Automation\",\"Sec4_box2_enabled\":\"active\",\"Sec4_box2_info\":\"Automate repetitive tasks to save time and increase efficiency.\",\"Sec4_box3_title\":\"Customizable Solutions\",\"Sec4_box3_enabled\":\"active\",\"Sec4_box3_info\":\"Tailor features to fit your unique business needs and workflows.\",\"Sec4_box4_title\":\"Scalable Features\",\"Sec4_box4_enabled\":\"active\",\"Sec4_box4_info\":\"Grow your business with flexible solutions that scale with you.\",\"Sec4_box5_title\":\"Enhanced Security\",\"Sec4_box5_enabled\":\"active\",\"Sec4_box5_info\":\"Protect your data with advanced encryption and security protocols.\",\"Sec4_box6_title\":\"Real-Time Analytics\",\"Sec4_box6_enabled\":\"active\",\"Sec4_box6_info\":\"Gain actionable insights with live data tracking and reporting.\",\"Sec4_box1_image\":{},\"Sec4_box2_image\":{},\"Sec4_box3_image\":{},\"Sec4_box4_image\":{},\"Sec4_box5_image\":{},\"Sec4_box6_image\":{},\"section_footer_image_path\":\"\",\"section_main_image_path\":\"\",\"box_image_1_path\":\"\",\"box_image_2_path\":\"\",\"box_image_3_path\":\"\",\"Box1_image_path\":\"\",\"Box2_image_path\":\"\",\"Sec4_box1_image_path\":\"upload\\/homepage\\/offers_1.svg\",\"Sec4_box2_image_path\":\"upload\\/homepage\\/offers_2.svg\",\"Sec4_box3_image_path\":\"upload\\/homepage\\/offers_3.svg\",\"Sec4_box4_image_path\":\"upload\\/homepage\\/offers_4.svg\",\"Sec4_box5_image_path\":\"upload\\/homepage\\/offers_5.svg\",\"Sec4_box6_image_path\":\"upload\\/homepage\\/offers_6.svg\",\"Sec7_box1_image_path\":\"\",\"Sec7_box2_image_path\":\"\",\"Sec7_box3_image_path\":\"\",\"Sec7_box4_image_path\":\"\",\"Sec7_box5_image_path\":\"\",\"Sec7_box6_image_path\":\"\",\"Sec7_box7_image_path\":\"\",\"Sec7_box8_image_path\":\"\"}', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(6, 'Pricing', 'Section 5', NULL, '{\"name\":\"Pricing\",\"section_enabled\":\"active\",\"Sec5_title\":\"Flexible Pricing\",\"Sec5_info\":\"Get started for free, upgrade later in our application.\",\"section_footer_image_path\":\"\",\"section_main_image_path\":\"\",\"box_image_1_path\":\"\",\"box_image_2_path\":\"\",\"box_image_3_path\":\"\",\"Box1_image_path\":\"\",\"Box2_image_path\":\"\",\"Sec4_box1_image_path\":\"\",\"Sec4_box2_image_path\":\"\",\"Sec4_box3_image_path\":\"\",\"Sec4_box4_image_path\":\"\",\"Sec4_box5_image_path\":\"\",\"Sec4_box6_image_path\":\"\",\"Sec7_box1_image_path\":\"\",\"Sec7_box2_image_path\":\"\",\"Sec7_box3_image_path\":\"\",\"Sec7_box4_image_path\":\"\",\"Sec7_box5_image_path\":\"\",\"Sec7_box6_image_path\":\"\",\"Sec7_box7_image_path\":\"\",\"Sec7_box8_image_path\":\"\"}', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(7, 'Core Features', 'Section 6', NULL, '{\"name\":\"Core Features\",\"section_enabled\":\"active\",\"Sec6_title\":\"Core Features\",\"Sec6_info\":\"Core Modules For Your Business\",\"Sec6_Box_title\":[\"Dashboard\",\"Subscription Plan\",\"Document\",\"Document Details\",\"User Logged History\"],\"Sec6_Box_subtitle\":[\"DRMS SaaS software refers to the various features and functionalities that the software offers to help organizations manage their digital documents effectively.\",\"DRMS SaaS software refers to the various features and functionalities that the software offers to help organizations manage their digital documents effectively.\",\"DRMS SaaS software refers to the various features and functionalities that the software offers to help organizations manage their digital documents effectively.\",\"DRMS SaaS software refers to the various features and functionalities that the software offers to help organizations manage their digital documents effectively.\",\"DRMS SaaS software refers to the various features and functionalities that the software offers to help organizations manage their digital documents effectively.\",\"DRMS SaaS software refers to the various features and functionalities that the software offers to help organizations manage their digital documents effectively.\"],\"Sec6_box_image\":[{},{},{},{},{},{}],\"section_footer_image_path\":\"\",\"section_main_image_path\":\"\",\"box_image_1_path\":\"\",\"box_image_2_path\":\"\",\"box_image_3_path\":\"\",\"Box1_image_path\":\"\",\"Box2_image_path\":\"\",\"Sec4_box1_image_path\":\"\",\"Sec4_box2_image_path\":\"\",\"Sec4_box3_image_path\":\"\",\"Sec4_box4_image_path\":\"\",\"Sec4_box5_image_path\":\"\",\"Sec4_box6_image_path\":\"\",\"Sec6_box0_image_path\":\"upload\\/homepage\\/1.png\",\"Sec6_box1_image_path\":\"upload\\/homepage\\/2.png\",\"Sec6_box2_image_path\":\"upload\\/homepage\\/3.png\",\"Sec6_box3_image_path\":\"upload\\/homepage\\/4.png\",\"Sec6_box4_image_path\":\"upload\\/homepage\\/5.png\",\"Sec6_box5_image_path\":\"upload\\/homepage\\/6.png\",\"Sec6_box6_image_path\":\"\",\"Sec7_box1_image_path\":\"\",\"Sec7_box2_image_path\":\"\",\"Sec7_box3_image_path\":\"\",\"Sec7_box4_image_path\":\"\",\"Sec7_box5_image_path\":\"\",\"Sec7_box6_image_path\":\"\",\"Sec7_box7_image_path\":\"\",\"Sec7_box8_image_path\":\"\"}', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(8, 'Testimonials', 'Section 7', NULL, '{\"name\":\"Testimonials\",\"section_enabled\":\"active\",\"Sec7_title\":\"What Our Customers Say About Us\",\"Sec7_info\":\"We\\u2019re proud of the impact our software has had on businesses just like yours. Hear directly from our customers about how our solutions have made a difference in their day-to-day operations\",\"Sec7_box1_name\":\"Lenore Becker\",\"Sec7_box1_tag\":null,\"Sec7_box1_Enabled\":\"active\",\"Sec7_box1_review\":\"Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Quisque ut nisi. Nulla porta dolor. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc.\",\"Sec7_box2_name\":\"Damian Morales\",\"Sec7_box2_tag\":\"New\",\"Sec7_box2_Enabled\":\"active\",\"Sec7_box2_review\":\"Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Vestibulum rutrum.\",\"Sec7_box3_name\":\"Oleg Lucas\",\"Sec7_box3_tag\":null,\"Sec7_box3_Enabled\":\"active\",\"Sec7_box3_review\":\"Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Quisque ut nisi. Nulla porta dolor. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc.\",\"Sec7_box4_name\":\"Jerome Mccoy\",\"Sec7_box4_tag\":null,\"Sec7_box4_Enabled\":\"active\",\"Sec7_box4_review\":\"Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Quisque ut nisi. Nulla porta dolor. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc.\",\"Sec7_box5_name\":\"Rafael Carver\",\"Sec7_box5_tag\":null,\"Sec7_box5_Enabled\":\"active\",\"Sec7_box5_review\":\"Aenean leo ligula, porttitor eu, consequat vitae, eleifend.\",\"Sec7_box6_name\":\"Edan Rodriguez\",\"Sec7_box6_tag\":null,\"Sec7_box6_Enabled\":\"active\",\"Sec7_box6_review\":\"Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Quisque ut nisi. Nulla porta dolor. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc.\",\"Sec7_box7_name\":\"Kalia Middleton\",\"Sec7_box7_tag\":null,\"Sec7_box7_Enabled\":\"active\",\"Sec7_box7_review\":\"Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Vestibulum rutrum, mi nec elementum.\",\"Sec7_box8_name\":\"Zenaida Chandler\",\"Sec7_box8_tag\":null,\"Sec7_box8_Enabled\":\"active\",\"Sec7_box8_review\":\"Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Quisque ut nisi. Nulla porta dolor. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc.\",\"Sec7_box1_image\":{},\"Sec7_box2_image\":{},\"Sec7_box3_image\":{},\"Sec7_box4_image\":{},\"Sec7_box5_image\":{},\"Sec7_box6_image\":{},\"Sec7_box7_image\":{},\"Sec7_box8_image\":{},\"section_footer_image_path\":\"\",\"section_main_image_path\":\"\",\"box_image_1_path\":\"\",\"box_image_2_path\":\"\",\"box_image_3_path\":\"\",\"Box1_image_path\":\"\",\"Box2_image_path\":\"\",\"Sec4_box1_image_path\":\"\",\"Sec4_box2_image_path\":\"\",\"Sec4_box3_image_path\":\"\",\"Sec4_box4_image_path\":\"\",\"Sec4_box5_image_path\":\"\",\"Sec4_box6_image_path\":\"\",\"Sec7_box1_image_path\":\"upload\\/homepage\\/review_1.png\",\"Sec7_box2_image_path\":\"upload\\/homepage\\/review_2.png\",\"Sec7_box3_image_path\":\"upload\\/homepage\\/review_3.png\",\"Sec7_box4_image_path\":\"upload\\/homepage\\/review_4.png\",\"Sec7_box5_image_path\":\"upload\\/homepage\\/review_5.png\",\"Sec7_box6_image_path\":\"upload\\/homepage\\/review_6.png\",\"Sec7_box7_image_path\":\"upload\\/homepage\\/review_7.png\",\"Sec7_box8_image_path\":\"upload\\/homepage\\/review_8.png\"}', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(9, 'Choose US', 'Section 8', NULL, '{\"name\":\"Choose US\",\"section_enabled\":\"active\",\"Sec8_title\":\"Reason to Choose US\",\"Sec8_box1_info\":\"Proven Expertise\",\"Sec8_box2_info\":\"Customizable Solutions\",\"Sec8_box3_info\":\"Seamless Integration\",\"Sec8_box4_info\":\"Exceptional Support\",\"Sec8_box5_info\":\"Scalable and Future-Proof\",\"Sec8_box6_info\":\"Security You Can Trust\",\"Sec8_box7_info\":\"User-Friendly Interface\",\"Sec8_box8_info\":\"Innovation at Its Core\",\"section_footer_image_path\":\"\",\"section_main_image_path\":\"\",\"box_image_1_path\":\"\",\"box_image_2_path\":\"\",\"box_image_3_path\":\"\",\"Box1_image_path\":\"\",\"Box2_image_path\":\"\",\"Sec4_box1_image_path\":\"\",\"Sec4_box2_image_path\":\"\",\"Sec4_box3_image_path\":\"\",\"Sec4_box4_image_path\":\"\",\"Sec4_box5_image_path\":\"\",\"Sec4_box6_image_path\":\"\",\"Sec7_box1_image_path\":\"\",\"Sec7_box2_image_path\":\"\",\"Sec7_box3_image_path\":\"\",\"Sec7_box4_image_path\":\"\",\"Sec7_box5_image_path\":\"\",\"Sec7_box6_image_path\":\"\",\"Sec7_box7_image_path\":\"\",\"Sec7_box8_image_path\":\"\"}', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(10, 'FAQ', 'Section 9', NULL, '{\"name\":\"FAQ\",\"section_enabled\":\"active\",\"Sec9_title\":\"Frequently Asked Questions (FAQ)\",\"Sec9_info\":\"Please refer the Frequently ask question for your quick help\",\"section_footer_image_path\":\"\",\"section_main_image_path\":\"\",\"box_image_1_path\":\"\",\"box_image_2_path\":\"\",\"box_image_3_path\":\"\",\"Box1_image_path\":\"\",\"Box2_image_path\":\"\",\"Sec4_box1_image_path\":\"\",\"Sec4_box2_image_path\":\"\",\"Sec4_box3_image_path\":\"\",\"Sec4_box4_image_path\":\"\",\"Sec4_box5_image_path\":\"\",\"Sec4_box6_image_path\":\"\",\"Sec7_box1_image_path\":\"\",\"Sec7_box2_image_path\":\"\",\"Sec7_box3_image_path\":\"\",\"Sec7_box4_image_path\":\"\",\"Sec7_box5_image_path\":\"\",\"Sec7_box6_image_path\":\"\",\"Sec7_box7_image_path\":\"\",\"Sec7_box8_image_path\":\"\"}', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(11, 'AboutUS - Footer', 'Section 10', NULL, '{\"name\":\"AboutUS - Footer\",\"section_enabled\":\"active\",\"Sec10_title\":\"About DRMS SaaS\",\"Sec10_info\":\"Document and Records Management System (DRMS SaaS) software refers to the various features and functionalities that the software offers to help organizations manage their digital documents effectively.\",\"section_footer_image_path\":\"\",\"section_main_image_path\":\"\",\"box_image_1_path\":\"\",\"box_image_2_path\":\"\",\"box_image_3_path\":\"\",\"Box1_image_path\":\"\",\"Box2_image_path\":\"\",\"Sec4_box1_image_path\":\"\",\"Sec4_box2_image_path\":\"\",\"Sec4_box3_image_path\":\"\",\"Sec4_box4_image_path\":\"\",\"Sec4_box5_image_path\":\"\",\"Sec4_box6_image_path\":\"\",\"Sec7_box1_image_path\":\"\",\"Sec7_box2_image_path\":\"\",\"Sec7_box3_image_path\":\"\",\"Sec7_box4_image_path\":\"\",\"Sec7_box5_image_path\":\"\",\"Sec7_box6_image_path\":\"\",\"Sec7_box7_image_path\":\"\",\"Sec7_box8_image_path\":\"\"}', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `logged_histories`
--

CREATE TABLE `logged_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `ip` varchar(191) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `details` text DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_05_21_065337_create_permission_tables', 1),
(6, '2021_05_08_100002_create_subscriptions_table', 1),
(7, '2021_05_08_124950_create_settings_table', 1),
(8, '2021_05_29_180034_create_notice_boards_table', 1),
(9, '2021_05_29_183858_create_contacts_table', 1),
(10, '2023_07_23_051513_create_documents_table', 1),
(11, '2023_07_23_052655_create_categories_table', 1),
(12, '2023_07_23_052715_create_sub_categories_table', 1),
(13, '2023_07_23_105702_create_tags_table', 1),
(14, '2023_07_31_160008_create_document_comments_table', 1),
(15, '2023_07_31_170000_create_reminders_table', 1),
(16, '2023_08_01_161941_create_version_histories_table', 1),
(17, '2023_08_02_145848_create_share_documents_table', 1),
(18, '2023_08_03_172747_create_document_histories_table', 1),
(19, '2023_08_04_164513_create_logged_histories_table', 1),
(20, '2024_01_12_141909_create_coupons_table', 1),
(21, '2024_01_12_171136_create_coupon_histories_table', 1),
(22, '2024_02_17_052552_create_package_transactions_table', 1),
(23, '2024_11_25_115027_create_notifications_table', 1),
(24, '2024_11_29_061023_add_email_verification_token_to_users_table', 1),
(25, '2025_01_01_032920_create_f_a_q_s_table', 1),
(26, '2025_01_01_052842_create_pages_table', 1),
(27, '2025_01_01_115236_create_home_pages_table', 1),
(28, '2025_01_30_090542_create_auth_pages_table', 1),
(29, '2025_02_05_065605_add_twofa_secret_to_users_table', 1),
(30, '2025_07_24_094606_version20_filled', 1),
(31, '2025_07_24_114553_create_stages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notice_boards`
--

CREATE TABLE `notice_boards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `attachment` varchar(191) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `short_code` text DEFAULT NULL,
  `enabled_email` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `module`, `name`, `subject`, `message`, `short_code`, `enabled_email`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'user_create', 'New User', 'Welcome', '\n                    <p><strong>Dear {new_user_name}</strong>,</p><p>&nbsp;</p><blockquote><p>Welcome to {company_name}! We are excited to have you on board and look forward to providing you with an exceptional experience.</p><p>We hope you enjoy your experience with us. If you have any feedback, feel free to share it with us.</p><p>&nbsp;</p><p>Your account details are as follows:</p><p><strong>App Link:</strong> <a href=\"{app_link}\">{app_link}</a></p><p><strong>Username:</strong> {username}</p><p><strong>Password:</strong> {password}</p><p>&nbsp;</p><p>Thank you for choosing .</p></blockquote>', '[\"{company_name}\",\"{company_email}\",\"{company_phone_number}\",\"{company_address}\",\"{company_currency}\",\"{new_user_name}\",\"{app_link}\",\"{username}\",\"{password}\"]', 0, 2, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(2, 'reminder_create', 'New Reminder', '{subject}', '\n                <p><strong>Reminder:</strong> {subject}</p><p>&nbsp;</p><blockquote><p>{message}</p></blockquote><p>&nbsp;</p><p><em>Created by:</em> {created_by}</p><p>Thank you!</p>', '[\"{company_name}\",\"{company_email}\",\"{company_phone_number}\",\"{company_address}\",\"{company_currency}\",\"{subject}\",\"{message}\",\"{created_by}\"]', 0, 2, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(3, 'document_share', 'Share Document', 'Document Share: {document_name}', '\n                <p><strong>Dear User,</strong></p>\n                <p>&nbsp;</p>\n                <blockquote>\n                    <p>The document <strong>{document_name}</strong> has been shared with you by <strong>{share_by}</strong>.</p>\n                    <p>Please review the document at your convenience.</p>\n                </blockquote>\n                <p>&nbsp;</p>\n                <p>If you have any questions or need further assistance, feel free to reach out to the sender.</p>\n                <p>Thank you!</p>\n                <p>Best regards,</p>\n                <p>{share_by}</p>', '[\"{company_name}\",\"{company_email}\",\"{company_phone_number}\",\"{company_address}\",\"{company_currency}\",\"{document_name}\",\"{share_by}\"]', 0, 2, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(4, 'user_create', 'New User', 'Welcome', '\n                    <p><strong>Dear {new_user_name}</strong>,</p><p>&nbsp;</p><blockquote><p>Welcome to {company_name}! We are excited to have you on board and look forward to providing you with an exceptional experience.</p><p>We hope you enjoy your experience with us. If you have any feedback, feel free to share it with us.</p><p>&nbsp;</p><p>Your account details are as follows:</p><p><strong>App Link:</strong> <a href=\"{app_link}\">{app_link}</a></p><p><strong>Username:</strong> {username}</p><p><strong>Password:</strong> {password}</p><p>&nbsp;</p><p>Thank you for choosing .</p></blockquote>', '[\"{company_name}\",\"{company_email}\",\"{company_phone_number}\",\"{company_address}\",\"{company_currency}\",\"{new_user_name}\",\"{app_link}\",\"{username}\",\"{password}\"]', 0, 5, '2025-10-02 15:16:00', '2025-10-02 15:16:00'),
(5, 'reminder_create', 'New Reminder', '{subject}', '\n                <p><strong>Reminder:</strong> {subject}</p><p>&nbsp;</p><blockquote><p>{message}</p></blockquote><p>&nbsp;</p><p><em>Created by:</em> {created_by}</p><p>Thank you!</p>', '[\"{company_name}\",\"{company_email}\",\"{company_phone_number}\",\"{company_address}\",\"{company_currency}\",\"{subject}\",\"{message}\",\"{created_by}\"]', 0, 5, '2025-10-02 15:16:00', '2025-10-02 15:16:00'),
(6, 'document_share', 'Share Document', 'Document Share: {document_name}', '\n                <p><strong>Dear User,</strong></p>\n                <p>&nbsp;</p>\n                <blockquote>\n                    <p>The document <strong>{document_name}</strong> has been shared with you by <strong>{share_by}</strong>.</p>\n                    <p>Please review the document at your convenience.</p>\n                </blockquote>\n                <p>&nbsp;</p>\n                <p>If you have any questions or need further assistance, feel free to reach out to the sender.</p>\n                <p>Thank you!</p>\n                <p>Best regards,</p>\n                <p>{share_by}</p>', '[\"{company_name}\",\"{company_email}\",\"{company_phone_number}\",\"{company_address}\",\"{company_currency}\",\"{document_name}\",\"{share_by}\"]', 0, 5, '2025-10-02 15:16:00', '2025-10-02 15:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `package_transactions`
--

CREATE TABLE `package_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `subscription_id` int(11) NOT NULL DEFAULT 0,
  `subscription_transactions_id` varchar(191) NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT 0.00,
  `transaction_id` varchar(191) DEFAULT NULL,
  `payment_status` varchar(191) DEFAULT NULL,
  `payment_type` varchar(191) DEFAULT NULL,
  `holder_name` varchar(100) DEFAULT NULL,
  `card_number` varchar(10) DEFAULT NULL,
  `card_expiry_month` varchar(10) DEFAULT NULL,
  `card_expiry_year` varchar(10) DEFAULT NULL,
  `receipt` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `enabled` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `enabled`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Privacy Policy', 'privacy_policy', '<h3><strong>1. Information We Collect</strong></h3><p>We may collect the following types of information from you:</p><h4><strong>a. Personal Information</strong></h4><ul><li>Name, email address, phone number, and other contact details.</li><li>Payment information (if applicable).</li></ul><h4><strong>b. Non-Personal Information</strong></h4><ul><li>Browser type, operating system, and device information.</li><li>Usage data, including pages visited, time spent, and other analytical data.</li></ul><h4><strong>c. Information You Provide</strong></h4><ul><li>Information you voluntarily provide when contacting us, signing up, or completing forms.</li></ul><h4><strong>d. Cookies and Tracking Technologies</strong></h4><ul><li>We use cookies, web beacons, and other tracking tools to enhance your experience and analyze usage patterns.</li></ul><h3><strong>2. How We Use Your Information</strong></h3><p>We use the information collected for the following purposes:</p><ul><li>To provide, maintain, and improve our Services.</li><li>To process transactions and send you confirmations.</li><li>To communicate with you, including responding to inquiries or providing updates.</li><li>To personalize your experience and deliver tailored content.</li><li>To comply with legal obligations and protect against fraud or misuse.</li></ul><h3><strong>3. How We Share Your Information</strong></h3><p>We do not sell your personal information. However, we may share your information with:</p><ul><li><strong>Service Providers:</strong> Third-party vendors who assist in providing our Services.</li><li><strong>Legal Authorities:</strong> When required to comply with legal obligations or protect our rights.</li><li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets, your information may be transferred.</li></ul><h3><strong>4. Data Security</strong></h3><p>We implement appropriate technical and organizational measures to protect your data against unauthorized access, disclosure, alteration, or destruction. However, no method of transmission or storage is 100% secure, and we cannot guarantee absolute security.</p><h3><strong>5. Your Rights</strong></h3><p>You have the right to:</p><ul><li>Access, correct, or delete your personal data.</li><li>Opt-out of certain data processing activities, including marketing communications.</li><li>Withdraw consent where processing is based on consent.</li></ul><p>To exercise your rights, please contact us at [contact email].</p><h3><strong>6. Third-Party Links</strong></h3><p>Our Services may contain links to third-party websites. We are not responsible for the privacy practices or content of these websites. Please review their privacy policies before engaging with them.</p><h3><strong>7. Children\'s Privacy</strong></h3><p>Our Services are not intended for children under the age of [13/16], and we do not knowingly collect personal information from them. If we become aware that a child has provided us with personal data, we will take steps to delete it.</p><h3><strong>8. Changes to This Privacy Policy</strong></h3><p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with a revised \'Last Updated\' date. Your continued use of the Services after such changes constitutes your acceptance of the new terms.</p><h3>&nbsp;</h3>', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(2, 'Terms & Conditions', 'terms_conditions', '<h3><strong>1. Acceptance of Terms</strong></h3><p>By using our Services, you confirm that you are at least [18 years old or the legal age in your jurisdiction] and capable of entering into a binding agreement. If you are using our Services on behalf of an organization, you represent that you have the authority to bind that organization to these Terms.</p><h3><strong>2. Use of Services</strong></h3><p>You agree to use our Services only for lawful purposes and in accordance with these Terms. You must not:</p><ul><li>Violate any applicable laws or regulations.</li><li>Use our Services in a manner that could harm, disable, overburden, or impair them.</li><li>Attempt to gain unauthorized access to our systems or networks.</li><li>Transmit any harmful code, viruses, or malicious software.</li></ul><h3><strong>3. User Accounts</strong></h3><p>If you create an account with us, you are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. You agree to notify us immediately of any unauthorized use of your account or breach of security.</p><h3><strong>4. Intellectual Property</strong></h3><p>All content, trademarks, logos, and intellectual property associated with our Services are owned by [Your Company Name] or our licensors. You are granted a limited, non-exclusive, non-transferable license to access and use the Services for personal or authorized business purposes. Any unauthorized use, reproduction, or distribution is prohibited.</p><h3><strong>5. Payment and Billing</strong> (if applicable)</h3><p>If our Services involve payments:</p><ul><li>All fees are due at the time of purchase unless otherwise agreed.</li><li>We reserve the right to change pricing or introduce new fees with prior notice.</li><li>Refunds, if applicable, will be handled according to our [Refund Policy].</li></ul><h3><strong>6. Termination of Services</strong></h3><p>We reserve the right to suspend or terminate your access to our Services at our discretion, without prior notice, if:</p><ul><li>You breach these Terms.</li><li>We are required to do so by law.</li><li>Our Services are discontinued or altered.</li></ul><h3><strong>7. Limitation of Liability</strong></h3><p>To the fullest extent permitted by law:</p><ul><li>[Your Company Name] and its affiliates shall not be liable for any direct, indirect, incidental, or consequential damages resulting from your use of our Services.</li><li>Our liability is limited to the amount you paid, if any, for accessing our Services.</li></ul><h3><strong>8. Indemnification</strong></h3><p>You agree to indemnify and hold [Your Company Name], its affiliates, employees, and partners harmless from any claims, liabilities, damages, losses, or expenses arising from your use of the Services or violation of these Terms.</p><h3><strong>9. Modifications to Terms</strong></h3><p>We may update these Terms from time to time. Any changes will be effective immediately upon posting, and your continued use of the Services constitutes your acceptance of the revised Terms.</p>', 1, 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage user', 'web', NULL, NULL),
(2, 'create user', 'web', NULL, NULL),
(3, 'edit user', 'web', NULL, NULL),
(4, 'delete user', 'web', NULL, NULL),
(5, 'show user', 'web', NULL, NULL),
(6, 'manage role', 'web', NULL, NULL),
(7, 'create role', 'web', NULL, NULL),
(8, 'edit role', 'web', NULL, NULL),
(9, 'delete role', 'web', NULL, NULL),
(10, 'manage contact', 'web', NULL, NULL),
(11, 'create contact', 'web', NULL, NULL),
(12, 'edit contact', 'web', NULL, NULL),
(13, 'delete contact', 'web', NULL, NULL),
(14, 'manage note', 'web', NULL, NULL),
(15, 'create note', 'web', NULL, NULL),
(16, 'edit note', 'web', NULL, NULL),
(17, 'delete note', 'web', NULL, NULL),
(18, 'manage logged history', 'web', NULL, NULL),
(19, 'delete logged history', 'web', NULL, NULL),
(20, 'manage pricing packages', 'web', NULL, NULL),
(21, 'create pricing packages', 'web', NULL, NULL),
(22, 'edit pricing packages', 'web', NULL, NULL),
(23, 'delete pricing packages', 'web', NULL, NULL),
(24, 'buy pricing packages', 'web', NULL, NULL),
(25, 'manage pricing transation', 'web', NULL, NULL),
(26, 'manage coupon', 'web', NULL, NULL),
(27, 'create coupon', 'web', NULL, NULL),
(28, 'edit coupon', 'web', NULL, NULL),
(29, 'delete coupon', 'web', NULL, NULL),
(30, 'manage coupon history', 'web', NULL, NULL),
(31, 'delete coupon history', 'web', NULL, NULL),
(32, 'manage account settings', 'web', NULL, NULL),
(33, 'manage password settings', 'web', NULL, NULL),
(34, 'manage general settings', 'web', NULL, NULL),
(35, 'manage company settings', 'web', NULL, NULL),
(36, 'manage email settings', 'web', NULL, NULL),
(37, 'manage payment settings', 'web', NULL, NULL),
(38, 'manage seo settings', 'web', NULL, NULL),
(39, 'manage google recaptcha settings', 'web', NULL, NULL),
(40, 'manage notification', 'web', NULL, NULL),
(41, 'edit notification', 'web', NULL, NULL),
(42, 'manage FAQ', 'web', NULL, NULL),
(43, 'create FAQ', 'web', NULL, NULL),
(44, 'edit FAQ', 'web', NULL, NULL),
(45, 'delete FAQ', 'web', NULL, NULL),
(46, 'manage Page', 'web', NULL, NULL),
(47, 'create Page', 'web', NULL, NULL),
(48, 'edit Page', 'web', NULL, NULL),
(49, 'delete Page', 'web', NULL, NULL),
(50, 'show Page', 'web', NULL, NULL),
(51, 'manage home page', 'web', NULL, NULL),
(52, 'edit home page', 'web', NULL, NULL),
(53, 'manage footer', 'web', NULL, NULL),
(54, 'edit footer', 'web', NULL, NULL),
(55, 'manage 2FA settings', 'web', NULL, NULL),
(56, 'manage category', 'web', NULL, NULL),
(57, 'create category', 'web', NULL, NULL),
(58, 'edit category', 'web', NULL, NULL),
(59, 'delete category', 'web', NULL, NULL),
(60, 'manage sub category', 'web', NULL, NULL),
(61, 'create sub category', 'web', NULL, NULL),
(62, 'edit sub category', 'web', NULL, NULL),
(63, 'delete sub category', 'web', NULL, NULL),
(64, 'manage tag', 'web', NULL, NULL),
(65, 'create tag', 'web', NULL, NULL),
(66, 'edit tag', 'web', NULL, NULL),
(67, 'delete tag', 'web', NULL, NULL),
(68, 'manage document', 'web', NULL, NULL),
(69, 'create document', 'web', NULL, NULL),
(70, 'edit document', 'web', NULL, NULL),
(71, 'delete document', 'web', NULL, NULL),
(72, 'show document', 'web', NULL, NULL),
(73, 'manage my document', 'web', NULL, NULL),
(74, 'edit my document', 'web', NULL, NULL),
(75, 'delete my document', 'web', NULL, NULL),
(76, 'show my document', 'web', NULL, NULL),
(77, 'create my document', 'web', NULL, NULL),
(78, 'manage reminder', 'web', NULL, NULL),
(79, 'create reminder', 'web', NULL, NULL),
(80, 'edit reminder', 'web', NULL, NULL),
(81, 'delete reminder', 'web', NULL, NULL),
(82, 'show reminder', 'web', NULL, NULL),
(83, 'manage my reminder', 'web', NULL, NULL),
(84, 'manage document history', 'web', NULL, NULL),
(85, 'download document', 'web', NULL, NULL),
(86, 'preview document', 'web', NULL, NULL),
(87, 'manage comment', 'web', NULL, NULL),
(88, 'create comment', 'web', NULL, NULL),
(89, 'manage version', 'web', NULL, NULL),
(90, 'create version', 'web', NULL, NULL),
(91, 'manage share document', 'web', NULL, NULL),
(92, 'delete share document', 'web', NULL, NULL),
(93, 'create share document', 'web', NULL, NULL),
(94, 'manage mail', 'web', NULL, NULL),
(95, 'send mail', 'web', NULL, NULL),
(96, 'manage auth page', 'web', NULL, NULL),
(97, 'book assign', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `assign_user` varchar(191) DEFAULT NULL,
  `document_id` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', 0, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(2, 'owner', 'web', 1, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(3, 'manager', 'web', 2, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(4, 'employee', 'web', 2, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(5, 'employee', 'web', 5, '2025-10-02 15:15:59', '2025-10-02 15:15:59'),
(6, 'Manager', 'web', 5, '2025-10-02 18:14:25', '2025-10-02 18:14:25');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 6),
(2, 1),
(2, 2),
(2, 3),
(2, 6),
(3, 1),
(3, 2),
(3, 3),
(3, 6),
(4, 1),
(4, 2),
(4, 3),
(4, 6),
(5, 1),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 5),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(11, 5),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(12, 5),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(13, 5),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(15, 5),
(16, 1),
(16, 2),
(16, 3),
(16, 4),
(16, 5),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(17, 5),
(18, 2),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(22, 1),
(23, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(32, 2),
(32, 4),
(32, 5),
(33, 1),
(33, 2),
(33, 4),
(33, 5),
(34, 1),
(34, 2),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(38, 1),
(39, 1),
(40, 2),
(41, 2),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(55, 2),
(55, 3),
(55, 4),
(55, 5),
(56, 2),
(56, 3),
(56, 6),
(57, 2),
(57, 3),
(57, 6),
(58, 2),
(58, 3),
(59, 2),
(59, 3),
(59, 6),
(60, 2),
(60, 3),
(60, 6),
(61, 2),
(61, 3),
(61, 6),
(62, 2),
(62, 3),
(62, 6),
(63, 2),
(63, 3),
(63, 6),
(64, 2),
(64, 3),
(65, 2),
(65, 3),
(66, 2),
(66, 3),
(67, 2),
(67, 3),
(68, 2),
(68, 3),
(68, 6),
(69, 2),
(69, 3),
(69, 6),
(70, 2),
(70, 3),
(70, 6),
(71, 2),
(71, 3),
(71, 6),
(72, 2),
(72, 3),
(72, 6),
(73, 2),
(73, 3),
(73, 4),
(73, 5),
(73, 6),
(74, 2),
(74, 3),
(74, 4),
(74, 5),
(74, 6),
(75, 2),
(75, 3),
(75, 4),
(75, 5),
(75, 6),
(76, 2),
(76, 3),
(76, 4),
(76, 5),
(76, 6),
(77, 2),
(77, 3),
(77, 4),
(77, 5),
(77, 6),
(78, 2),
(78, 3),
(79, 2),
(79, 3),
(80, 2),
(80, 3),
(81, 2),
(81, 3),
(82, 2),
(82, 3),
(82, 4),
(82, 5),
(83, 2),
(83, 3),
(83, 4),
(83, 5),
(84, 2),
(84, 3),
(85, 2),
(85, 3),
(85, 4),
(85, 5),
(86, 2),
(86, 3),
(86, 4),
(86, 5),
(87, 2),
(87, 3),
(87, 4),
(87, 5),
(87, 6),
(88, 2),
(88, 3),
(88, 4),
(88, 5),
(88, 6),
(89, 2),
(89, 3),
(89, 4),
(89, 5),
(89, 6),
(90, 2),
(90, 3),
(90, 6),
(91, 2),
(91, 3),
(91, 4),
(91, 5),
(92, 2),
(92, 3),
(93, 2),
(93, 3),
(93, 4),
(93, 5),
(94, 2),
(94, 3),
(95, 2),
(95, 3),
(96, 1),
(97, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `value` varchar(191) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `type`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'bank_transfer_payment', 'on', 'payment', 1, NULL, NULL),
(2, 'bank_name', 'Bank of America', 'payment', 1, NULL, NULL),
(3, 'bank_holder_name', 'SmartWeb Infotech', 'payment', 1, NULL, NULL),
(4, 'bank_account_number', '4242 4242 4242 4242', 'payment', 1, NULL, NULL),
(5, 'bank_ifsc_code', 'BOA45678', 'payment', 1, NULL, NULL),
(6, 'bank_other_details', '', 'payment', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `share_documents`
--

CREATE TABLE `share_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `document_id` int(11) NOT NULL DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `color` varchar(191) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `package_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `interval` varchar(191) DEFAULT NULL,
  `user_limit` int(11) DEFAULT NULL,
  `document_limit` int(11) DEFAULT NULL,
  `enabled_document_history` int(11) NOT NULL DEFAULT 0,
  `enabled_logged_history` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `title`, `package_amount`, `interval`, `user_limit`, `document_limit`, `enabled_document_history`, `enabled_logged_history`, `created_at`, `updated_at`) VALUES
(1, 'Basic', 0.00, 'Monthly', 10, 10, 1, 1, '2025-09-24 13:20:23', '2025-09-24 13:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) DEFAULT NULL,
  `last_name` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `profile` varchar(191) DEFAULT NULL,
  `phone_number` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `lang` varchar(191) DEFAULT NULL,
  `subscription` int(11) DEFAULT NULL,
  `subscription_expire_date` date DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `email_verification_token` varchar(191) DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `twofa_secret` text DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `type`, `profile`, `phone_number`, `address`, `lang`, `subscription`, `subscription_expire_date`, `parent_id`, `email_verified_at`, `email_verification_token`, `password`, `twofa_secret`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, 'superadmin@gmail.com', 'super admin', 'avatar.png', NULL, NULL, 'english', NULL, NULL, 0, '2025-09-24 13:20:22', NULL, '$2y$10$GpNNKgOaNsdhryHIFvoNEukeACO9xbccsCGMlHaWO/G2v6KRToYWy', NULL, 1, NULL, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(2, 'Owner', NULL, 'owner@gmail.com', 'owner', 'avatar.png', NULL, NULL, 'english', 1, '2025-10-24', 1, '2025-09-24 13:20:22', NULL, '$2y$10$GpNNKgOaNsdhryHIFvoNEukeACO9xbccsCGMlHaWO/G2v6KRToYWy', NULL, 1, NULL, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(3, 'Manager', NULL, 'manager@gmail.com', 'manager', 'avatar.png', NULL, NULL, 'english', 0, NULL, 2, '2025-09-24 13:20:22', NULL, '$2y$10$GpNNKgOaNsdhryHIFvoNEukeACO9xbccsCGMlHaWO/G2v6KRToYWy', NULL, 1, NULL, '2025-09-24 13:20:22', '2025-09-24 13:20:22'),
(4, 'Employee', NULL, 'employee@gmail.com', 'employee', 'avatar.png', NULL, NULL, 'english', 0, NULL, 2, '2025-09-24 13:20:23', NULL, '$2y$10$GpNNKgOaNsdhryHIFvoNEukeACO9xbccsCGMlHaWO/G2v6KRToYWy', NULL, 1, NULL, '2025-09-24 13:20:23', '2025-09-24 13:20:23'),
(5, 'Mr.Harun', NULL, 'harun@demo.com', 'owner', NULL, NULL, NULL, 'english', 1, NULL, 1, '2025-10-02 15:16:00', NULL, '$2y$10$GpNNKgOaNsdhryHIFvoNEukeACO9xbccsCGMlHaWO/G2v6KRToYWy', NULL, 1, NULL, '2025-10-02 15:15:59', '2025-10-02 15:16:00'),
(6, 'Md. Harun', 'Rashid', 'harun@book.com', 'employee', 'avatar.png', '017104555555', NULL, 'english', NULL, NULL, 5, '2025-10-02 18:25:30', NULL, '$2y$10$5xGHlArJ74UGQGpz2DxTCe5t4d3UfI4nHUl/Gr0iSl7Ut2uIbya/6', NULL, 1, NULL, '2025-10-02 18:25:30', '2025-10-02 18:26:46'),
(7, 'Rashid', 'Tak', 'rashid@tak.com', 'employee', 'avatar.png', '017122222222', NULL, 'english', NULL, NULL, 5, '2025-10-02 18:26:25', NULL, '$2y$10$b8OJIRRdd1bf.uKPOwtKN.27tUlmoSCk6XZ1wUdYCmJDpI..NBe8a', NULL, 1, NULL, '2025-10-02 18:26:25', '2025-10-02 18:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `version_histories`
--

CREATE TABLE `version_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(191) DEFAULT NULL,
  `current_version` varchar(191) NOT NULL DEFAULT '0',
  `document_id` varchar(191) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_pages`
--
ALTER TABLE `auth_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_assigns`
--
ALTER TABLE `book_assigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_histories`
--
ALTER TABLE `coupon_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_comments`
--
ALTER TABLE `document_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_histories`
--
ALTER TABLE `document_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_pages`
--
ALTER TABLE `home_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logged_histories`
--
ALTER TABLE `logged_histories`
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
-- Indexes for table `notice_boards`
--
ALTER TABLE `notice_boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_transactions`
--
ALTER TABLE `package_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_transactions_subscription_transactions_id_unique` (`subscription_transactions_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_name_parent_id_unique` (`name`,`parent_id`);

--
-- Indexes for table `share_documents`
--
ALTER TABLE `share_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_title_unique` (`title`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `version_histories`
--
ALTER TABLE `version_histories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_pages`
--
ALTER TABLE `auth_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_assigns`
--
ALTER TABLE `book_assigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_histories`
--
ALTER TABLE `coupon_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_comments`
--
ALTER TABLE `document_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_histories`
--
ALTER TABLE `document_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `home_pages`
--
ALTER TABLE `home_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `logged_histories`
--
ALTER TABLE `logged_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notice_boards`
--
ALTER TABLE `notice_boards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `package_transactions`
--
ALTER TABLE `package_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `share_documents`
--
ALTER TABLE `share_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `version_histories`
--
ALTER TABLE `version_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
