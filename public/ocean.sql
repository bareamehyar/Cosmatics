-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2021 at 12:27 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocean`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_ons_list`
--

CREATE TABLE `add_ons_list` (
  `id` int(11) UNSIGNED NOT NULL,
  `add_ons_cat_id` int(11) NOT NULL,
  `add_ons_list_en` varchar(200) COLLATE utf8_croatian_ci NOT NULL,
  `add_ons_list_ar` varchar(200) COLLATE utf8_croatian_ci NOT NULL,
  `price` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1- active / 2- not active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `add_ons_title`
--

CREATE TABLE `add_ons_title` (
  `id` int(11) NOT NULL,
  `add_ons_name_en` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `add_ons_name_ar` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `which_choice` tinyint(4) NOT NULL COMMENT '1- single / 2- multi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `slug`) VALUES
(1, 'View Dashboard', 'view-dashboard'),
(2, 'Create Branch', 'create-branch'),
(3, 'Edit Branch', 'edit-branch'),
(4, 'Delete Branch', 'delete-branch'),
(5, 'Control Sliders Branches', 'control-sliders-branches'),
(6, 'Create Category', 'create-category'),
(7, 'Edit Category', 'edit-category'),
(8, 'Delete Category', 'delete-category'),
(9, 'Create Item', 'create-item'),
(10, 'Edit Item', 'edit-item'),
(11, 'Delete Item', 'delete-item'),
(12, 'Create Add On\'s', 'create-add-on\'s'),
(13, 'Edit Add On\'s', 'edit-add-on\'s'),
(14, 'Delete Add On\'s', 'delete-add-on\'s'),
(15, 'Create Slider', 'create-slider'),
(16, 'Edit Slider', 'edit-slider'),
(17, 'Delete Slider', 'delete-slider'),
(18, 'View And Control Users Application', 'view-and-control-users-application'),
(19, 'View Orders', 'view-orders'),
(20, 'Create Payment Method', 'create-payment-method'),
(21, 'Edit Payment Method', 'edit-payment-method'),
(22, 'Delete Payment Method', 'delete-payment-method'),
(23, 'Control And Edit Application Settings', 'control-and-edit-application-settings'),
(24, 'Create City', 'create-city'),
(25, 'Edit City', 'edit-city'),
(26, 'Delete City', 'delete-city'),
(27, 'Create Area', 'create-area'),
(28, 'Edit Area', 'edit-area'),
(29, 'Delete Area', 'delete-area'),
(30, 'Create Delivery Price', 'create-delivery-price'),
(31, 'Edit Delivery Price', 'edit-delivery-price'),
(32, 'Delete Delivery Price', 'delete-delivery-price'),
(33, 'View Items Ordered Report', 'view-items-ordered-report'),
(34, 'View Users Ordered Report', 'view-users-ordered-report'),
(35, 'View Branches Sales Report', 'view-branches-sales-report');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`) VALUES
(1, 'Manager'),
(2, 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_permission`
--

CREATE TABLE `admin_role_permission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `admin_role_permission`
--

INSERT INTO `admin_role_permission` (`id`, `role_id`, `permission_id`) VALUES
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 8),
(8, 1, 9),
(9, 1, 16),
(10, 1, 23),
(11, 1, 35),
(12, 2, 1),
(13, 2, 20),
(14, 2, 21),
(15, 2, 22),
(16, 2, 30),
(17, 2, 31),
(18, 2, 32),
(19, 2, 33),
(20, 2, 34),
(21, 2, 35),
(22, 1, 1),
(23, 1, 34);

-- --------------------------------------------------------

--
-- Table structure for table `app_event`
--

CREATE TABLE `app_event` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `event_type` varchar(100) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `app_event`
--

INSERT INTO `app_event` (`id`, `phone_number`, `event_type`) VALUES
(1, '+962775054337', 'invite friend'),
(2, '+962775054337', 'invite friend'),
(3, '+962775054337', 'invite friend'),
(4, '+962775054337', 'call'),
(5, '+962775054337', 'instagram'),
(6, '+962775054337', 'instagram'),
(7, '+962775054337', 'facebook'),
(8, '+962775054337', 'web'),
(9, '+962775054337', 'instagram'),
(10, '+962775054337', 'instagram'),
(11, '+962790782033', 'invite friend'),
(12, '+962790782033', 'call'),
(13, '+962790782033', 'whats app'),
(14, '+962790782033', 'facebook'),
(15, '+962790782033', 'web'),
(16, '+962789642249', 'whats app'),
(17, '+962797456406', 'invite friend'),
(18, '+962797456406', 'invite friend'),
(19, '+962797456406', 'invite friend'),
(20, '+962797456406', 'call');

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `whats_app_number` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `whats_app_message` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `phone_number` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `web_url` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `facebook_url` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `instagram_url` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `google_play_url` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `app_store_url` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `delivery_estimation` int(11) NOT NULL,
  `accepting_order` tinyint(4) NOT NULL COMMENT '1- accepting / 2- not accepting '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `whats_app_number`, `whats_app_message`, `phone_number`, `web_url`, `facebook_url`, `instagram_url`, `google_play_url`, `app_store_url`, `delivery_estimation`, `accepting_order`) VALUES
(1, '+962797456406', 'hello', '+962797456406', 'https://goldenmeal.jo/', 'https://www.facebook.com/GoldenMealJO', 'https://www.instagram.com/goldenmeal/', 'https://google.play.me/goldenmeal', 'https://google.play.me/goldenmeal', 33, 1);

-- --------------------------------------------------------

--
-- Table structure for table `branch_table`
--

CREATE TABLE `branch_table` (
  `id` int(11) NOT NULL,
  `store_name` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `img_url` varchar(500) COLLATE utf8_croatian_ci NOT NULL,
  `phone_number` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `category_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `branch_table`
--

INSERT INTO `branch_table` (`id`, `store_name`, `latitude`, `longitude`, `img_url`, `phone_number`, `category_id`) VALUES
(1, 'Jabal AlHussain', 31.966924245173843, 35.91817950216251, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/branches/16279858402631275281840.png', '0791234567', 2),
(2, 'AlBayader', 31.95393822226927, 35.82401572837172, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/branches/16279870271635484573040.png', '0781234567', 1),
(4, 'test branch', 31.961385080645336, 35.9591404512167, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/branches/16304869333354308544760.png', '+962797456406', 1),
(5, 'Branch test', 31.95709609167449, 35.96142894701412, 'http://www.appdigisol.com/uploads/branches/1631694210404429429640.png', '0791234567', 2);

-- --------------------------------------------------------

--
-- Table structure for table `branch_table_images`
--

CREATE TABLE `branch_table_images` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `image_url` varchar(2000) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `branch_table_images`
--

INSERT INTO `branch_table_images` (`id`, `branch_id`, `image_url`) VALUES
(1, 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/sliders_branches/1/16279858681687734999560.png'),
(2, 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/sliders_branches/1/16279858681221892745480.png'),
(4, 3, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/sliders_branches/3/1630485570676586336800.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories_branches`
--

CREATE TABLE `categories_branches` (
  `id` bigint(20) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `img_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories_branches`
--

INSERT INTO `categories_branches` (`id`, `name_en`, `name_ar`, `status`, `img_url`) VALUES
(1, 'snaks', 'سناكات', 1, 's'),
(2, 'sanks', 'سناك', 2, 'http://www.appdigisol.com/uploads/branches_categories/16316935393746242884560.png');

-- --------------------------------------------------------

--
-- Table structure for table `category_items`
--

CREATE TABLE `category_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Branch_id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `sort_number` int(11) NOT NULL,
  `Status` int(11) NOT NULL COMMENT '0.Inactive 1.Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `OfferValue` float NOT NULL,
  `Offer_type` int(11) NOT NULL COMMENT '0.NoOffer 1.offer_parcent 2.offer_value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(11) NOT NULL,
  `category_name_en` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `category_name_ar` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `category_image_url` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `category_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1- active / 2- not active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `category_name_en`, `category_name_ar`, `category_image_url`, `category_status`) VALUES
(6, 'Fried Chicken Meals', 'وجبات الدجاج المقلي', 'https://dashboard.goldenmealpro.digisolapps.com/uploads/categories/16309145673192795905040.jpg', 1),
(7, 'Shawerma Meals', 'وجبات شاورما', 'https://dashboard.goldenmealpro.digisolapps.com/uploads/categories/16310011192148063012280.jpg', 1),
(8, 'Grill  Meals', 'وجبات المشاوي', 'https://dashboard.goldenmealpro.digisolapps.com/uploads/categories/16310050402324358707200.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city_name` varchar(100) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`) VALUES
(1, 'Amman'),
(2, 'Salt');

-- --------------------------------------------------------

--
-- Table structure for table `cities_area`
--

CREATE TABLE `cities_area` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `area_name` varchar(50) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `cities_area`
--

INSERT INTO `cities_area` (`id`, `city_id`, `area_name`) VALUES
(1, 1, 'Jabal Alhussain'),
(2, 1, 'Swalieh'),
(3, 2, '60th street');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_areas_price`
--

CREATE TABLE `delivery_areas_price` (
  `id` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `governorate` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `locality` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `sub_locality` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `neighborhood` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `price` decimal(7,2) NOT NULL,
  `supported` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `delivery_areas_price`
--

INSERT INTO `delivery_areas_price` (`id`, `country`, `governorate`, `locality`, `sub_locality`, `neighborhood`, `price`, `supported`) VALUES
(1, 'Jordan', NULL, NULL, NULL, NULL, '5.00', 1),
(2, 'Jordan', 'Amman Governorate', NULL, NULL, NULL, '3.00', 1),
(3, 'Jordan', 'Amman Governorate', 'Amman', NULL, NULL, '3.00', 1),
(4, 'Jordan', 'Amman Governorate', 'Amman', 'Sweileh', NULL, '4.00', 1),
(5, 'Jordan', 'Amman Governorate', 'Amman', 'Sweileh', 'Al Hai Al Sharqi', '1.50', 1),
(6, 'Jordan', 'Amman Governorate', 'Amman', 'Al Abdali', NULL, '2.50', 1),
(7, 'Jordan', 'Amman Governorate', 'Amman', 'Al Abdali', 'Jabal Al Hussein', '1.80', 0),
(8, 'Jordan', 'Amman Governorate', 'Amman', 'Al Abdali', 'Madinat Al Hussein', '1.30', 1),
(9, 'Jordan', 'Zarqa Governorate', NULL, NULL, NULL, '4.00', 0),
(10, 'Jordan', 'Zarqa Governorate', 'Russeifa', NULL, NULL, '1.50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_croatian_ci NOT NULL,
  `queue` text COLLATE utf8_croatian_ci NOT NULL,
  `payload` longtext COLLATE utf8_croatian_ci NOT NULL,
  `exception` longtext COLLATE utf8_croatian_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_user`
--

CREATE TABLE `feedback_user` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `user_note` varchar(2000) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items_branches`
--

CREATE TABLE `items_branches` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items_branches`
--

INSERT INTO `items_branches` (`id`, `item_id`, `branch_id`) VALUES
(1, 45, 4),
(2, 46, 5),
(3, 47, 1),
(4, 47, 2),
(5, 15, 2),
(6, 15, 5),
(7, 47, 5),
(8, 15, 1),
(9, 15, 4);

-- --------------------------------------------------------

--
-- Table structure for table `items_list`
--

CREATE TABLE `items_list` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_name_en` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `item_name_ar` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `item_price` varchar(20) COLLATE utf8_croatian_ci NOT NULL,
  `tax` decimal(4,2) NOT NULL DEFAULT 0.00,
  `item_description_en` text COLLATE utf8_croatian_ci NOT NULL,
  `item_description_ar` text COLLATE utf8_croatian_ci NOT NULL,
  `item_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1- active / 2- not active',
  `item_image` varchar(1000) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `items_list`
--

INSERT INTO `items_list` (`id`, `category_id`, `item_name_en`, `item_name_ar`, `item_price`, `tax`, `item_description_en`, `item_description_ar`, `item_status`, `item_image`) VALUES
(15, 6, 'Fried Chicken', 'الدجاج المقلي', '2.65', '20.20', '3 pcs  Chicken + 1 Fries + 1 Garlic  + 1 Coleslaw  + 1 Bun  + 1 Pepsi', 'قطع دجاج 3   ( قطعتين + جناح) +1 بطاطا +1 مثومة + 1كول سلو + 1 خبز +1 بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16309161241858242295040.jpg'),
(16, 6, 'Fried Chicken', 'الدجاج المقلي', '3.25', '0.00', '4 pcs  Chicken + 1 Fries + 1 Garlic  + 1 Coleslaw  + 1 Bun  + 1 Pepsi', 'قطع دجاج 4 + 1 بطاطا+ 1 مثومة+ 1 كول سلو+ 1 خبز + 1 بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16309163652633481406520.jpg'),
(17, 6, 'Fried Chicken', 'الدجاج المقلي', '6.50', '0.00', '8 pcs  Chicken + 2 Fries + 2 Garlic  + 2 Coleslaw  + 3 Bun  + 2 Pepsi', 'قطع دجاج 8  + 2 بطاطا + 2 مثومة + 2 كول سلو + 3 خبز + 2 بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16309166773897107858360.jpg'),
(18, 6, 'Fried Chicken', 'الدجاج المقلي', '9.95', '0.00', '12pcs  Chicken + 3 Fries + 4 Garlic  + 4 Coleslaw  + 4 Bun  + 3 Pepsi', 'قطعة دجاج 12+ 3 بطاطا + 4 مثومة + 4 كول سلو + 4 خبز + 3 بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/1630920420296217052200.jpg'),
(19, 6, 'Fried Chicken', 'الدجاج المقلي', '12.35', '0.00', '16 pcs  Chicken + 3 Fries + 5 Garlic  + 5 Coleslaw  + 4 Bun  + 3 Pepsi', 'قطعة دجاج 16 + 3 بطاطا + 5 مثومة  +5 كول سلو +4 خبز + 3 بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/1630922075600222473600.jpg'),
(20, 6, 'Fried Chicken', 'الدجاج المقلي', '3.40', '0.00', '4 pcs  Chicken + sauce + 1 Rice + 1 Pepsi', 'قطع دجاج 4 + أرز بسمتي + 1 بيبسي + 1 صوص', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16309998421993456813200.jpg'),
(21, 6, 'Fried Chicken', 'الدجاج المقلي', '7.75', '0.00', '8 pcs  Chicken + 3 sauce + 3 Rice + 2 Pepsi', 'قطع دجاج 8 + 3 ارز بسمتي + 3 صوص + 2 بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310000343098604086160.jpg'),
(22, 6, 'Fried Chicken', 'الدجاج المقلي', '13.25', '0.00', '16 pcs  Chicken + 4 sauce + 4 Rice + 4 Pepsi', 'قطعة دجاج 16  + 4 أرز بسمتي + 4 صوص + 4 بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310002642371489483560.jpg'),
(23, 6, 'Fried Chicken', 'الدجاج المقلي', '16.70', '0.00', '21 pcs  Chicken + 4 Fries + 6 Garlic  + 6 Coleslaw  + 8 Bun + 6 Pepsi', 'قطعة دجاج 21  + 4 بطاطا + 6 مثومة+ 6 كول سلو + 8 خبز + 6 بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310004661171332670000.jpg'),
(24, 6, 'Fried Chicken', 'الدجاج المقلي', '22.5', '0.00', '32 pcs  Chicken + 4 Fries + 8 Garlic  + 6 Coleslaw  + 10 Bun  + 8 Pepsi', 'قطعة دجاج  32 + 4 بطاطا + 8 مثومة+ 6 كول سلو + 10 خبز + 8 بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/163100069714493355120.jpg'),
(25, 6, 'Fried Chicken', 'الدجاج المقلي', '2.75', '0.00', '3 pcs  Chicken + sauce + 1 Rice + 1 Pepsi', 'قطع دجاج 3 ( قطعتين+ جناح) + 1صحن أرز +  1صوص + 1بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310009331105004760920.jpg'),
(26, 7, 'Shawerma Single', 'شاورما سادة', '1.30', '0.00', 'small sandwich  50g + Torshi + Garlic', 'ساندويش صغير 50 غم + مقبلات + مثومة', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310017952342767466800.jpg'),
(27, 7, 'Shawerma Single Meal', 'وجبة شاورما فردية', '1.90', '0.00', 'Sandwich Super + Fries + Torshi + Garlic + Mexican Sauce', 'ساندوش سوبر + بطاطا + مقبلات +  مثومة + مثومة مكسيكي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310029601196109755560.jpg'),
(28, 7, 'shawerma Super Meal', 'وجبة شاورما سوبر', '2.50', '0.00', 'Super Sandwich + Small Sandwich +  Fries + Torshi + Garlic + Mexican Sauce', 'ساندوش سوبر  + ساندويش عادي + بطاطا + مقبلات +  مثومة + مثومة مكسيكي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310031831539257201720.jpg'),
(29, 7, 'Shawerma Double Meal', 'وجبة شاورما دبل', '3.10', '0.00', '2 Sandwich Super + Fries + Torshi + Garlic + Mexican Sauce', 'عدد 2 ساندوش سوبر + بطاطا +  مقبلات + مثومة + مثومة مكسيكي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310033773338177610440.jpg'),
(30, 7, 'Shawerma Treble Meal', 'وجبة شاورما تربل', '4.20', '0.00', '3 Sandwich Super + Fries + Torshi + Garlic + Mexican Sauce', 'عدد 3 ساندوش سوبر + بطاطا +  مقبلات + مثومة + مثومة مكسيكي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310035172386451355320.jpg'),
(31, 7, 'Shawerma Save Meal', 'وجبة شاورما التوفير', '6', '0.00', '4 Sandwich Super + Fries + Torshi + Garlic + Mexican Sauce', 'عدد 4 ساندوش سوبر + بطاطا + مقبلات + مثومة + مثومة مكسيكي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310036972915668574560.jpg'),
(32, 7, 'Shawerma Walema Meal', 'وجبة شاورما الوليمة', '12', '0.00', '8 Sandwich Super + 4 Fries + Torshi + 3 Garlic + 2 Mexican Sauce', 'عدد 8 ساندوش سوبر + 4 بطاطا + مقبلات + 3 مثومة + 2 مثومة مكسيكي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310039293259363217480.jpg'),
(33, 7, 'Shawerma Alazema Meal', 'وجبة شاورما العزيمة', '15', '0.00', '10 Sandwich Super + 6 Fries + Torshi + 3 Garlic + 3 Mexican Sauce', 'عدد 10 ساندوش سوبر + 6 بطاطا + مقبلات + 3 مثومة + 3 مثومة مكسيكي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310040672593989367600.jpg'),
(34, 7, 'Shawerma Offer Meal', 'وجبة شاورما العرض', '9.95', '0.00', '6 Sandwich Super + 3 Fries + Torshi + 3 Garlic + 3 Mexican Sauce + 3 Pepsi', 'عدد 6 ساندوش سوبر + 3 بطاطا + 3 مثومة مكسيكي + 3 مثومة + 3 بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310042931654271977320.jpg'),
(35, 8, 'Grill 1 Meal', 'وجبة المشاوي 1', '3.40', '0.00', '2 Pcs chicken Tikka + 1 Rice + 1 sauce + 1 Pepsi', 'أرز بسمتي 1  + 1صوص + 1 بيبسي + 2 قطعة دجاج تكا', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310056023964865402680.jpg'),
(36, 8, 'Grill 2  Meal', 'وجبة المشاوي 2', '3.40', '0.00', '6 Pcs chicken Turkish + 1 Rice + 1 sauce + 1 Pepsi', 'قطع دجاج تركي 6  +1  أرز بسمتي + 1 صوص + 1 بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310062771974395828400.jpg'),
(37, 8, 'Grill 3 Meal', 'وجبة مشاوي 3', '3', '0.00', '2 Pcs chicken Tikka + 1 Fried + 1 Garlic + 1 Pepsi', 'قطعة دجاج تكا 2 + 1  بطاطا + 1 مثومة+ 1 بيبسي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310064871329189490000.jpg'),
(38, 8, 'Grill 4 Meal', 'وجبة مشاوي 4', '3.25', '0.00', '6  Pcs chicken Turkish + 1 Fries + 1 Garlic + 1 Pepsi + Turkish bread', 'قطعة دجاج تركي 6  + 1 بطاطا + 1 مثومة+ 1 بيبسي + 1 خبز تركي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310073001540603406240.jpg'),
(39, 8, 'Grill 5 Meal', 'وجبة مشاوي 5', '5.95', '0.00', '4 Pcs chicken Tikka + 2 Fries  + 2 Garlic + 2 Pepsi + 2 Bread', 'دجاج تكا 4 + 2 بطاطا + 2 مثومة + 2 بيبسي + 2 خبز', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310075383749491891960.jpg'),
(40, 8, 'Grill 6 Meal', 'وجبة مشاوي 6', '6.40', '0.00', '12 Pcs chicken Turkish + 2 Fries  + 2 Garlic + 2  Peps + 2 Turkish bread', 'قطعة دجاج تركي 12 + 2 بطاطا + 2 مثومة +2 بيبسي + 2 خبز تركي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/1631007820344088180080.jpg'),
(41, 8, 'Grill 7 Meal', 'وجبة مشاوي 7', '11.90', '0.00', '8 pcs  Chicken Tikka + 4  Fries  + 4 Garlic+ 4 Pepsi + 4 Bread', 'قطع دجاج تكا 8  +4 بطاطا + 4 مثومة + 4 بيبسي + 4 خبز', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310083363501722563400.jpg'),
(42, 8, 'Grill 8 Meal', 'وجبة مشاوي 8', '12.25', '0.00', '24 pcs  Chicken Turkish  + 4  Fries + 4 Garlic  + 4 Turkish bread + 4 Pepsi', 'قطعة دجاج تركي 24 + 4 بطاطا + 4 مثومة + 4 بيبسي+ + 4 خبز تركي', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310086483749507502760.jpg'),
(43, 8, '1 KG Chicken Grill', 'وجبة 1 كيلو شيش', '9.25', '0.00', '1 KG Chicken Grill  + 2 Fries + 2 Turkish Bread + 2 Garlic + 2 Mexican Sauce', 'كيلو شيش + 2 بطاطا + 2 خبز تركي + 2 مثومة + 2 مكسيكي ( عادي او حار )', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16310903272225959726120.jpg'),
(44, 7, 'dsa', 'يسش', '21', '2.00', 'das', 'يسش', 1, 'http://www.appdigisol.com/uploads/items/16317001843948756116560.png'),
(45, 7, 'dsa', 'يسش', '21', '2.00', 'das', 'يسش', 1, 'http://www.appdigisol.com/uploads/items/16317002392955373580080.png'),
(46, 6, 'dasdas', 'يسشيشس', '321', '2.00', 'das', 'يسش', 1, 'http://www.appdigisol.com/uploads/items/16317004851232594850640.png'),
(47, 7, 'safwas', 'يسشيشس', '21', '3.00', 'dsa', 'يشصس', 1, 'http://www.appdigisol.com/uploads/items/1631700562845837637840.png');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) NOT NULL,
  `title_en` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `title_ar` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `body_en` text COLLATE utf8_croatian_ci NOT NULL,
  `body_ar` text COLLATE utf8_croatian_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title_en`, `title_ar`, `body_en`, `body_ar`, `user_id`) VALUES
(7, 'Your Order ID #2 Has Been Received Successfully', 'تم إستلام طلبك رقم 2 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(8, 'Your Order ID #3 Has Been Received Successfully', 'تم إستلام طلبك رقم 3 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(9, 'Your Order ID #4 Has Been Received Successfully', 'تم إستلام طلبك رقم 4 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(10, 'Your Order ID #5 Has Been Received Successfully', 'تم إستلام طلبك رقم 5 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(11, 'Your Order ID #6 Has Been Received Successfully', 'تم إستلام طلبك رقم 6 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(12, 'Your Order ID #7 Has Been Received Successfully', 'تم إستلام طلبك رقم 7 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(13, 'Your Order ID #8 Has Been Received Successfully', 'تم إستلام طلبك رقم 8 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(14, 'Your Order ID #9 Has Been Received Successfully', 'تم إستلام طلبك رقم 9 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(15, 'Your Order ID #10 Has Been Received Successfully', 'تم إستلام طلبك رقم 10 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(16, 'Your Order ID #11 Has Been Received Successfully', 'تم إستلام طلبك رقم 11 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(17, 'Your Order ID #12 Has Been Received Successfully', 'تم إستلام طلبك رقم 12 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 3),
(18, 'Your Order ID #13 Has Been Received Successfully', 'تم إستلام طلبك رقم 13 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 3),
(19, 'Your Order ID #14 Has Been Received Successfully', 'تم إستلام طلبك رقم 14 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 3),
(20, 'Your Order ID #15 Has Been Received Successfully', 'تم إستلام طلبك رقم 15 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 3),
(21, 'Your Order ID #16 Has Been Received Successfully', 'تم إستلام طلبك رقم 16 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 3),
(22, 'Your Order ID #17 Has Been Received Successfully', 'تم إستلام طلبك رقم 17 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 4),
(23, 'Your Order ID is #5 Has Been Accepted', 'تمت الموافقة على طلبك رقم 5', 'the order will be preparing soon ..', 'سيتم تحضيره في أقرب وقت', 2),
(24, 'Your Order ID is #6 Has Been Accepted', 'تمت الموافقة على طلبك رقم 6', 'the order will be preparing soon ..', 'سيتم تحضيره في أقرب وقت', 2),
(25, 'Your Order ID is #7 Has Been Accepted', 'تمت الموافقة على طلبك رقم 7', 'the order will be preparing soon ..', 'سيتم تحضيره في أقرب وقت', 2),
(26, 'Your Order ID is #8 Has Been Accepted', 'تمت الموافقة على طلبك رقم 8', 'the order will be preparing soon ..', 'سيتم تحضيره في أقرب وقت', 2),
(27, 'Your Order ID is #8 Has Been Accepted', 'تمت الموافقة على طلبك رقم 8', 'the order will be preparing soon ..', 'سيتم تحضيره في أقرب وقت', 2),
(28, 'Your Order ID is #9 Has Been Accepted', 'تمت الموافقة على طلبك رقم 9', 'the order will be preparing soon ..', 'سيتم تحضيره في أقرب وقت', 2),
(29, 'Your Order ID is #10 Has Been Accepted', 'تمت الموافقة على طلبك رقم 10', 'the order will be preparing soon ..', 'سيتم تحضيره في أقرب وقت', 2),
(30, 'Your Order ID is #10 Has Been Accepted', 'تمت الموافقة على طلبك رقم 10', 'the order will be preparing soon ..', 'سيتم تحضيره في أقرب وقت', 2),
(31, 'Your Order ID #18 Has Been Received Successfully', 'تم إستلام طلبك رقم 18 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(32, 'Your Order ID #19 Has Been Received Successfully', 'تم إستلام طلبك رقم 19 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(33, 'Your Order ID #20 Has Been Received Successfully', 'تم إستلام طلبك رقم 20 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(34, 'Your Order ID #21 Has Been Received Successfully', 'تم إستلام طلبك رقم 21 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(35, 'Your Order ID #22 Has Been Received Successfully', 'تم إستلام طلبك رقم 22 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 3),
(36, 'Your Order ID #23 Has Been Received Successfully', 'تم إستلام طلبك رقم 23 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(37, 'Your Order ID #24 Has Been Received Successfully', 'تم إستلام طلبك رقم 24 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(38, 'Your Order ID #25 Has Been Received Successfully', 'تم إستلام طلبك رقم 25 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(39, 'Your Order ID #26 Has Been Received Successfully', 'تم إستلام طلبك رقم 26 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(40, 'Your Order ID #27 Has Been Received Successfully', 'تم إستلام طلبك رقم 27 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(41, 'Your Order ID #28 Has Been Received Successfully', 'تم إستلام طلبك رقم 28 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(42, 'Your Order ID #29 Has Been Received Successfully', 'تم إستلام طلبك رقم 29 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(43, 'Your Order ID #30 Has Been Received Successfully', 'تم إستلام طلبك رقم 30 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(44, 'Your Order ID #31 Has Been Received Successfully', 'تم إستلام طلبك رقم 31 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(45, 'Your Order ID #32 Has Been Received Successfully', 'تم إستلام طلبك رقم 32 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(46, 'Your Order ID #33 Has Been Received Successfully', 'تم إستلام طلبك رقم 33 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(47, 'Your Order ID #34 Has Been Received Successfully', 'تم إستلام طلبك رقم 34 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(48, 'Your Order ID #35 Has Been Received Successfully', 'تم إستلام طلبك رقم 35 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(49, 'Your Order ID #36 Has Been Received Successfully', 'تم إستلام طلبك رقم 36 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(50, 'Your Order ID #37 Has Been Received Successfully', 'تم إستلام طلبك رقم 37 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(51, 'Your Order ID #38 Has Been Received Successfully', 'تم إستلام طلبك رقم 38 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(52, 'Your Order ID #39 Has Been Received Successfully', 'تم إستلام طلبك رقم 39 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 3),
(53, 'Your Order ID #40 Has Been Received Successfully', 'تم إستلام طلبك رقم 40 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(54, 'Your Order ID #41 Has Been Received Successfully', 'تم إستلام طلبك رقم 41 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(55, 'Your Order ID #42 Has Been Received Successfully', 'تم إستلام طلبك رقم 42 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 2),
(56, 'Your Order ID #12 Has Been Rejected', 'تم رفض طلبك رقم 12', 'your order has been rejected for some reasons , please contact with order management team', 'لسبب ما ، يرجى التواصل مع فريق إدارة الطلبات', 3),
(57, 'Your Order ID is #13 Has Been Accepted', 'تمت الموافقة على طلبك رقم 13', 'the order will be preparing soon ..', 'سيتم تحضيره في أقرب وقت', 3),
(58, 'Your Order ID #11 Has Been Rejected', 'تم رفض طلبك رقم 11', 'your order has been rejected for some reasons , please contact with order management team', 'لسبب ما ، يرجى التواصل مع فريق إدارة الطلبات', 2),
(59, 'Your Order ID #5 Has Been Prepared', 'تم تحضير طلبك رقم 5', 'the order will be ready soon ..', 'سيتم تجهيزه في أقرب وقت', 3),
(60, 'Your Order ID #5 Is Ready Now', 'طلبك رقم 5 جاهز الآن', 'the order will be delivered to you soon ..', 'سيتم توصيله إليك لاحقا', 3),
(61, 'Your Order ID #5 Has Been Delieverd', 'تم توصيل طلبك رقم 5', 'thank your for your choice of golden meal restaurant', 'شكرا لأختيارك مطعم الوجبة الذهبية', 3),
(62, 'Your Order ID #16 Has Been Rejected', 'تم رفض طلبك رقم 16', 'your order has been rejected for some reasons , please contact with order management team', 'لسبب ما ، يرجى التواصل مع فريق إدارة الطلبات', 3),
(63, 'Your Order ID #81 Has Been Received Successfully', 'تم إستلام طلبك رقم 81 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 3),
(64, 'Your Order ID #82 Has Been Received Successfully', 'تم إستلام طلبك رقم 82 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 4),
(65, 'Your Order ID #83 Has Been Received Successfully', 'تم إستلام طلبك رقم 83 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 4),
(66, 'Your Order ID #84 Has Been Received Successfully', 'تم إستلام طلبك رقم 84 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 3),
(67, 'Your Order ID #85 Has Been Received Successfully', 'تم إستلام طلبك رقم 85 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(68, 'Your Order ID #86 Has Been Received Successfully', 'تم إستلام طلبك رقم 86 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 7),
(69, 'Your Order ID #87 Has Been Received Successfully', 'تم إستلام طلبك رقم 87 بنجاح', 'Your order is now under review', 'طلبك قيد المراجعة الآن', 9);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_croatian_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8_croatian_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_croatian_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `redirect` text COLLATE utf8_croatian_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` int(11) NOT NULL,
  `phone_number` varchar(50) COLLATE utf8_croatian_ci DEFAULT NULL,
  `Status` varchar(15) COLLATE utf8_croatian_ci NOT NULL DEFAULT '1' COMMENT '1-pending 2-accepted  3-prepare  4-completed   5-delivered  6-rejected',
  `paymentMethod` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `totalQty` varchar(10) COLLATE utf8_croatian_ci NOT NULL,
  `tax` double(8,2) NOT NULL DEFAULT 0.00,
  `Total_Amount` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `DropOffAddress` varchar(100) COLLATE utf8_croatian_ci DEFAULT NULL,
  `pickUpAddress` varchar(100) COLLATE utf8_croatian_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `instruction` varchar(1000) COLLATE utf8_croatian_ci DEFAULT NULL,
  `priceWithDelivery` float(10,5) DEFAULT NULL,
  `deliveryFee` float(10,5) DEFAULT NULL,
  `branchSelected` varchar(100) COLLATE utf8_croatian_ci DEFAULT NULL,
  `delivered_time` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `token` text COLLATE utf8_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `phone_number`, `Status`, `paymentMethod`, `totalQty`, `tax`, `Total_Amount`, `DropOffAddress`, `pickUpAddress`, `created_at`, `updated_at`, `instruction`, `priceWithDelivery`, `deliveryFee`, `branchSelected`, `delivered_time`, `token`) VALUES
(79, 1, '+962795644298', '1', 'Cash', '1', 0.00, '3.5', 'Area 5: Tla al-Ali', NULL, '2021-08-19 06:09:53', '2021-08-19 06:09:53', NULL, 6.50000, 3.00000, NULL, 'now', 'cKAetBcSQy6E3Rhr-5fDjs:APA91bF8jdEc5U60t8724F7O-QUQJkJlOSB4FulfwFlMOaaHGyL__e9_41xF1Nz7e7SZZUGpBEWND-MB1GCXMYz1t9TVIFxnrNFtzkWY4Wy80kWlk7H__S5ILllnqMXKY3qO6VzbeW-G'),
(80, 2, '+962795644298', '1', 'Cash', '1', 0.00, '3.5', 'Area 5: Tla al-Ali', NULL, '2021-08-19 06:11:53', '2021-08-19 06:11:53', NULL, 6.50000, 3.00000, NULL, 'now', 'cKAetBcSQy6E3Rhr-5fDjs:APA91bF8jdEc5U60t8724F7O-QUQJkJlOSB4FulfwFlMOaaHGyL__e9_41xF1Nz7e7SZZUGpBEWND-MB1GCXMYz1t9TVIFxnrNFtzkWY4Wy80kWlk7H__S5ILllnqMXKY3qO6VzbeW-G'),
(81, 3, '+962789642249', '1', 'Cash', '9', 0.00, '53', 'Area 8: Al Qweismeh', NULL, '2021-08-19 06:42:37', '2021-08-19 06:42:37', NULL, 56.00000, 3.00000, NULL, 'now', 'dyx_d4cgS7CvcIWas4UxlS:APA91bHM7t-i0HbIhVQW2RU42FUcsCICY87M-WKA3W0MHDwgxlfXMdWD2p3fmiTGmwVwKDgzOziZrkxcwzazB_iMo-gSrDjSA5s40uJHugtLPfVxEF57IjD2F2dHIgZeoQ00WwwPQtOm'),
(82, 4, '+962795644298', '1', 'Cash', '5', 0.00, '17.5', 'Area 4: Wadi As-Seir', NULL, '2021-08-24 16:58:14', '2021-08-24 16:58:14', NULL, 20.50000, 3.00000, NULL, 'now', 'cKAetBcSQy6E3Rhr-5fDjs:APA91bF8jdEc5U60t8724F7O-QUQJkJlOSB4FulfwFlMOaaHGyL__e9_41xF1Nz7e7SZZUGpBEWND-MB1GCXMYz1t9TVIFxnrNFtzkWY4Wy80kWlk7H__S5ILllnqMXKY3qO6VzbeW-G'),
(83, 5, '+962795644298', '1', 'Cash', '1', 0.00, '7.5', 'Area 4: Wadi As-Seir', NULL, '2021-08-24 17:03:13', '2021-08-24 17:03:13', NULL, 10.50000, 3.00000, NULL, 'now', 'cKAetBcSQy6E3Rhr-5fDjs:APA91bF8jdEc5U60t8724F7O-QUQJkJlOSB4FulfwFlMOaaHGyL__e9_41xF1Nz7e7SZZUGpBEWND-MB1GCXMYz1t9TVIFxnrNFtzkWY4Wy80kWlk7H__S5ILllnqMXKY3qO6VzbeW-G'),
(84, 6, '+962789642249', '1', 'Cash', '1', 0.00, '4', 'Area 9: Tla al-Ali', NULL, '2021-08-30 05:36:24', '2021-08-30 05:36:24', NULL, 7.00000, 3.00000, 'Jabal Alhussain', 'now', 'dyx_d4cgS7CvcIWas4UxlS:APA91bHM7t-i0HbIhVQW2RU42FUcsCICY87M-WKA3W0MHDwgxlfXMdWD2p3fmiTGmwVwKDgzOziZrkxcwzazB_iMo-gSrDjSA5s40uJHugtLPfVxEF57IjD2F2dHIgZeoQ00WwwPQtOm'),
(85, 7, '+962790782033', '1', 'Cash', '1', 0.00, '2.65', 'Area 4: null', NULL, '2021-09-06 06:45:58', '2021-09-06 06:45:58', NULL, 5.65000, 3.00000, NULL, 'now', NULL),
(86, 8, '+962790782033', '1', 'Cash', '1', 0.00, '3.25', 'Area 4: null', NULL, '2021-09-06 06:46:50', '2021-09-06 06:46:50', NULL, 6.25000, 3.00000, NULL, 'now', NULL),
(87, 9, '+962787676935', '1', 'Cash', '1', 0.00, '2.65', 'Area 2: null', NULL, '2021-09-06 07:08:58', '2021-09-06 07:08:58', NULL, 5.65000, 3.00000, NULL, 'now', 'esIHeGEeVUjTtQol3sj2lk:APA91bG0ZWcr-q12pb-_1k2r_lLIPAHTNc8ZqA7GLGPujNH55L5VINGfQ_P1L-9rTCcKS1Ku9r5s_el07M8SpbuFHWOMgTxrxFn9PSm-xl0iiLFLD9A2xsA2ekZDQicV6PHCepbuKJmx');

-- --------------------------------------------------------

--
-- Table structure for table `order_addons`
--

CREATE TABLE `order_addons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `AddOns_Category_id` bigint(20) UNSIGNED NOT NULL,
  `AddOns_Category_name` varchar(20) COLLATE utf8_croatian_ci NOT NULL,
  `AddOns_id` int(11) NOT NULL,
  `AddOns_name` varchar(20) COLLATE utf8_croatian_ci NOT NULL,
  `AddOns_price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `order_addons`
--

INSERT INTO `order_addons` (`id`, `order_item_id`, `AddOns_Category_id`, `AddOns_Category_name`, `AddOns_id`, `AddOns_name`, `AddOns_price`, `created_at`, `updated_at`) VALUES
(2, 86, 1, 'potatos', 2, 'medium', 1, '2021-08-30 05:36:24', '2021-08-30 05:36:24'),
(3, 86, 2, 'add', 4, 'katchab', 1, '2021-08-30 05:36:24', '2021-08-30 05:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `itemPrice` double(8,2) NOT NULL,
  `totalPrice` varchar(10) COLLATE utf8_croatian_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_image` varchar(200) COLLATE utf8_croatian_ci NOT NULL,
  `item_name_en` varchar(200) COLLATE utf8_croatian_ci NOT NULL,
  `item_name_ar` varchar(200) COLLATE utf8_croatian_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`, `itemPrice`, `totalPrice`, `category_id`, `item_image`, `item_name_en`, `item_name_ar`, `created_at`, `updated_at`) VALUES
(78, 80, 2, 1, 3.50, '3.5', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16279863032656419796560.png', 'Double Meal Shawarma', 'وجبة شاورما دبل', '2021-08-19 06:11:53', '2021-08-19 06:11:53'),
(79, 81, 5, 1, 7.50, '7.5', 2, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16279869141993309339320.jpg', 'دجاج بروستد8 قطع مع سدر أرز', 'Broasted chicken 8 pieces with cedar rice', '2021-08-19 06:42:37', '2021-08-19 06:42:37'),
(80, 81, 7, 1, 12.50, '12.5', 4, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16279872492257335609360.jpg', 'Chicken and a half - 18 pieces', 'دجاجة ونصف-18 قطعة', '2021-08-19 06:42:37', '2021-08-19 06:42:37'),
(81, 81, 6, 1, 7.50, '7.5', 4, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16279871123352096441240.jpg', 'chicken - 12 pieces', 'دجاجة-12قطعة', '2021-08-19 06:42:37', '2021-08-19 06:42:37'),
(82, 81, 8, 1, 8.00, '8', 3, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16279879342687351736640.png', 'Teka chicken 8 pices', 'دجاج تكا 8 قطع', '2021-08-19 06:42:37', '2021-08-19 06:42:37'),
(83, 81, 2, 5, 3.50, '3.5', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16279863032656419796560.png', 'Double Meal Shawarma', 'وجبة شاورما دبل', '2021-08-19 06:42:37', '2021-08-19 06:42:37'),
(84, 82, 2, 5, 3.50, '3.5', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16279863032656419796560.png', 'Double Meal Shawarma', 'وجبة شاورما دبل', '2021-08-24 16:58:14', '2021-08-24 16:58:14'),
(85, 83, 6, 1, 7.50, '7.5', 4, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16279871123352096441240.jpg', 'chicken - 12 pieces', 'دجاجة-12قطعة', '2021-08-24 17:03:13', '2021-08-24 17:03:13'),
(86, 84, 1, 1, 2.00, '4', 1, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16279862361865819478840.png', 'Single Meal', 'وجبة شاورما فردية', '2021-08-30 05:36:24', '2021-08-30 05:36:24'),
(87, 85, 15, 1, 2.65, '2.65', 6, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16309161241858242295040.jpg', 'Fried Chicken', 'الدجاج المقلي', '2021-09-06 06:45:58', '2021-09-06 06:45:58'),
(88, 86, 16, 1, 3.25, '3.25', 6, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16309163652633481406520.jpg', 'Fried Chicken', 'الدجاج المقلي', '2021-09-06 06:46:50', '2021-09-06 06:46:50'),
(89, 87, 15, 1, 2.65, '2.65', 6, 'https://dashboard.goldenmealpro.digisolapps.com/uploads/items/16309161241858242295040.jpg', 'Fried Chicken', 'الدجاج المقلي', '2021-09-06 07:08:58', '2021-09-06 07:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `title`) VALUES
(1, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_croatian_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_croatian_ci DEFAULT NULL,
  `payload` text COLLATE utf8_croatian_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT '1- category / 2- item',
  `navigate_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1 COMMENT '1- active / 2- not active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Silder_image` text COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `type`, `navigate_id`, `Status`, `created_at`, `updated_at`, `Silder_image`) VALUES
(6, 1, 1, 1, '2021-08-09 10:05:38', '2021-08-09 10:05:38', 'https://dashboard.goldenmealpro.digisolapps.com/uploads/main-slider/16285107381740861827040.jpg'),
(7, 1, 4, 1, '2021-08-09 10:05:54', '2021-08-09 10:05:54', 'https://dashboard.goldenmealpro.digisolapps.com/uploads/main-slider/16285107541353971177280.jpg'),
(8, 2, 2, 1, '2021-08-09 10:06:43', '2021-08-09 10:06:43', 'https://dashboard.goldenmealpro.digisolapps.com/uploads/main-slider/16285108031481869735400.jpg'),
(9, 1, 2, 1, '2021-09-01 06:55:40', '2021-09-01 06:55:40', 'https://dashboard.goldenmealpro.digisolapps.com/uploads/main-slider/16304865403425317234440.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userdashboard`
--

CREATE TABLE `userdashboard` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `MobileNumber` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `StoreID` bigint(20) UNSIGNED NOT NULL,
  `Action` varchar(255) COLLATE utf8_croatian_ci NOT NULL COMMENT '1 = All Action 2=insert 3 = update 4 = delete',
  `role` varchar(255) COLLATE utf8_croatian_ci NOT NULL COMMENT 'All=show all 1=show all Restaurants 2= show all Supermarkets 3= show all Pharmacies 4 = just user store  ',
  `remember_token` varchar(100) COLLATE utf8_croatian_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firebase_id` varchar(500) COLLATE utf8_croatian_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `MobileNumber` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `is_logged_in` tinyint(4) NOT NULL COMMENT '0- null 1- logged_in',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `Address` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `status` varchar(11) COLLATE utf8_croatian_ci NOT NULL DEFAULT '1' COMMENT 'unactive ,active',
  `remember_token` text COLLATE utf8_croatian_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Type` varchar(255) COLLATE utf8_croatian_ci NOT NULL DEFAULT 'user',
  `lat` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `long` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `allow_register_vor` int(1) NOT NULL DEFAULT 0,
  `allow_register_driver` int(1) DEFAULT 0,
  `driver_password` varchar(100) COLLATE utf8_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firebase_id`, `first_name`, `last_name`, `email`, `MobileNumber`, `is_logged_in`, `email_verified_at`, `password`, `Address`, `status`, `remember_token`, `created_at`, `updated_at`, `Type`, `lat`, `long`, `allow_register_vor`, `allow_register_driver`, `driver_password`) VALUES
(2, 'wEjR49E0NybVEGCGqOrGcW3p8wc2', 'alzo3bi', 'mohd', NULL, '+962775054337', 1, NULL, NULL, NULL, '0', NULL, NULL, '2021-09-13 06:21:41', 'user', NULL, NULL, 0, 0, NULL),
(3, 'iOU2uVGY6ah4lVVep9ftwOWxj5q2', 'maenhh', 'halhqq', NULL, '+962789642249', 1, NULL, NULL, NULL, '1', NULL, NULL, '2021-08-18 09:47:15', 'user', NULL, NULL, 0, 0, NULL),
(4, 'MesxZRC53pQoevRIuDEHGsymCcL2', 'Thair ', 'Zayed', NULL, '+962795644298', 1, NULL, NULL, NULL, '1', NULL, NULL, '2021-08-18 10:49:53', 'user', NULL, NULL, 0, 0, NULL),
(5, 'cEQct2y543e61ui6pkZBgveP9z93', 'Ali ', 'ALAUTYAT ', NULL, '+962785555594', 1, NULL, NULL, NULL, '1', NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(6, 'ra7iz3SwfnfvHvgIQfVNPvE430n2', 'maher', 'abu also rob', NULL, '+962799966188', 1, NULL, NULL, NULL, '1', NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(7, 'wI6TA8HCwPdQucAXsec4U7xHAM83', 'soso', 'bdoor', NULL, '+962790782033', 1, NULL, NULL, NULL, '1', NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(8, '3eFj2rDTK9RgFEsd9z3Ty98mz403', 'duhaaaa', 'Fuji', NULL, '+962795011901', 1, NULL, NULL, NULL, '1', NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(9, 'jYmwShkUa2ZKDRS5CyRybjLbS562', 'r', 'b', NULL, '+962787676935', 1, NULL, NULL, NULL, '1', NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(10, 'null', 'mohd', 'alzoubi', NULL, '+962797456406', 1, NULL, NULL, NULL, '1', NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_dashboards`
--

CREATE TABLE `users_dashboards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_dashboards`
--

INSERT INTO `users_dashboards` (`id`, `full_name`, `username`, `email`, `email_verified_at`, `password`, `active`, `profile_photo`, `remember_token`, `role_id`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'Admin admin', 'admin', 'admin@admin.com', '2021-08-03 07:38:01', '$2y$10$A51Ma0PlXfEWgamrLon/1.u5DaMW3u2aEnxHBkfi.nFxSV/8.ZnDC', 1, NULL, NULL, NULL, 1, '2021-08-03 07:38:01', '2021-08-03 07:38:01'),
(2, 'Mohammad Alzoubi', 'alzoubi', 'mohdalzoubi96@gmail.com', '2021-08-03 10:32:17', '$2y$10$k1msOOw3oEHNY1PsauiAnO4Bcp0tNVDsMSbjxSsb8fBNSUlC3VZ6G', 1, NULL, NULL, 1, 0, '2021-08-03 07:45:20', '2021-08-03 10:32:17'),
(3, 'Maen halah', 'maen', 'maen99mh@gmail.com', '2021-08-03 07:53:26', '$2y$10$rqsw4WmR6/FM66KzD4U4Zex1Me.DCuSfGd0wDK3RbDfCbZD7VNwcS', 1, NULL, NULL, 2, 0, '2021-08-03 07:46:05', '2021-08-03 07:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL,
  `user_phone` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `area_name` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `sub_local` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `building_number` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `floor_number` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `apartment_number` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_phone`, `title`, `area_name`, `sub_local`, `building_number`, `floor_number`, `apartment_number`, `latitude`, `longitude`) VALUES
(1, '+962775054337', 'Area 1: منطقة تلاع العلي', 'منطقة تلاع العلي', 'Al harameen circle ,Mecca Street, عمّان، Jordan', ' ', ' ', ' ', 31.97465263172342, 35.86552329361439),
(2, '+962795644298', 'Area 1: Tla al-Ali', 'Tla al-Ali', 'Orwa Ben Odhaynah St. 9, Amman, Jordan', ' ', ' ', ' ', 31.976191270722378, 35.86390994489193),
(7, '+962789642249', 'Area 4: Tla al-Ali', 'Tla al-Ali', 'Wasfi At-Tall St. 160, Amman, Jordan', ' ', ' ', ' ', 31.991136910200435, 35.86828999221325),
(8, '+962789642249', 'Area 5: منطقة تلاع العلي', 'منطقة تلاع العلي', 'ش. فيصل فرحان الجربة، عمّان،،, عمّان، Jordan', ' ', ' ', ' ', 31.983031502850093, 35.87569825351238),
(9, '+962789642249', 'Area 6: Wadi As-Seir', 'Wadi As-Seir', 'As Senaah, Amman, Jordan', ' ', ' ', ' ', 31.94592938664462, 35.83961885422468),
(10, '+962789642249', 'Area 7: Al Naser', 'Al Naser', 'Al-Beit Al-Haram St. 12, Amman, Jordan', ' ', ' ', ' ', 31.938790205465715, 36.00348237901926),
(11, '+962789642249', 'Area 8: Al Qweismeh', 'Al Qweismeh', 'Asem Ben Amir, Amman, Jordan', ' ', ' ', ' ', 31.924738115014765, 35.94664301723242),
(12, '+962789642249', 'Area 9: Tla al-Ali', 'Tla al-Ali', 'Saeed Kheir, Amman, Jordan', ' ', ' ', ' ', 31.979888449358192, 35.82398224622011),
(13, '+962795644298', 'Area 4: Tla al-Ali', 'Tla al-Ali', 'Issam Ad-Dabbas St. 13, Amman, Jordan', ' ', ' ', ' ', 31.97557297415817, 35.87029829621315),
(14, '+962789642249', 'Area 10: Al Abdali', 'Al Abdali', 'Q. Aliaa St., Amman, Jordan', ' ', ' ', ' ', 31.977638876099913, 35.90400964021683),
(15, '+962789642249', 'Area 11: null', 'null', 'Al-Madina Al-Monawara St, Amman, Jordan', ' ', ' ', ' ', 32.00256169340328, 35.87431322783232),
(16, '+962795644298', 'Area 5: Tla al-Ali', 'Tla al-Ali', 'Prs. Rahmah St. 9, Amman, Jordan', ' ', ' ', ' ', 31.98083547192176, 35.86241662502289),
(17, '+962790782033', 'Area 3: null', 'null', 'Zarqa, Amman - Zarqa Highway, Amman, Jordan', ' ', ' ', ' ', 32.047540397195796, 36.09191045165062),
(18, '+962790782033', 'Area 4: null', 'null', 'Amman, Muhammad Sayil Al-Husban 19, Amman, Jordan', ' ', ' ', ' ', 31.982271059860526, 35.86797449737787),
(19, '+962790782033', 'Area 2: null', 'null', 'Amman, Zahar 3, Amman, Jordan', ' ', ' ', ' ', 31.976377839612717, 35.864303559064865),
(20, '+962789642249', 'Area 12: Wadi As-Seir', 'Wadi As-Seir', 'Al-Madina Al-Monawara St 1, Amman, Jordan', ' ', ' ', ' ', 31.9608284673811, 35.86563661694527),
(21, '+962775054337', 'Area 1: منطقة تلاع العلي', 'منطقة تلاع العلي', 'Al harameen circle ,Mecca Street, عمّان، Jordan', ' ', ' ', ' ', 31.97470410971145, 35.86544383317232),
(22, '+962795644298', 'Area 1: Tla al-Ali', 'Tla al-Ali', 'Mecca St. 2, Amman, Jordan', ' ', ' ', ' ', 31.96455157997191, 35.88393498212099),
(23, '+962795644298', 'Area 4: Wadi As-Seir', 'Wadi As-Seir', 'الصويفية،، Amman, Jordan', ' ', ' ', ' ', 31.959141937871134, 35.86208201944828),
(24, '+962795644298', 'Area 5: null', 'null', '7VPW+42H, Jerash, Jordan', ' ', ' ', ' ', 32.28502667614962, 35.89495450258255),
(25, '+962787676935', 'Area 2: null', 'null', 'Amman, Jihad Zino Street 5, Amman, Jordan', ' ', ' ', ' ', 31.976977644649377, 35.86117006838322),
(26, '+962789642249', 'Area 1: منطقة تلاع العلي', 'منطقة تلاع العلي', 'Al harameen circle ,Mecca Street, عمّان، Jordan', ' ', ' ', ' ', 31.974723733909194, 35.865360014140606);

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_ons_list`
--
ALTER TABLE `add_ons_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `add_ons_cat_id` (`add_ons_cat_id`);

--
-- Indexes for table `add_ons_title`
--
ALTER TABLE `add_ons_title`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_role_permission`
--
ALTER TABLE `admin_role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `permisssion_id` (`permission_id`);

--
-- Indexes for table `app_event`
--
ALTER TABLE `app_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_table`
--
ALTER TABLE `branch_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `branch_table_images`
--
ALTER TABLE `branch_table_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories_branches`
--
ALTER TABLE `categories_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_items`
--
ALTER TABLE `category_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_items_branch_id_foreign` (`Branch_id`),
  ADD KEY `category_items_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities_area`
--
ALTER TABLE `cities_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_areas_price`
--
ALTER TABLE `delivery_areas_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_user`
--
ALTER TABLE `feedback_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_branches`
--
ALTER TABLE `items_branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `items_list`
--
ALTER TABLE `items_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_list_ibfk_1` (`category_id`);

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
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_addons`
--
ALTER TABLE `order_addons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_addons_order_id_foreign` (`order_item_id`) USING BTREE;

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdashboard`
--
ALTER TABLE `userdashboard`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_dashboards_name_unique` (`name`),
  ADD UNIQUE KEY `user_dashboards_mobilenumber_unique` (`MobileNumber`),
  ADD UNIQUE KEY `user_dashboards_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_mobilenumber_unique` (`MobileNumber`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_dashboards`
--
ALTER TABLE `users_dashboards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_dashboards_username_unique` (`username`),
  ADD UNIQUE KEY `users_dashboards_email_unique` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_ons_list`
--
ALTER TABLE `add_ons_list`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `add_ons_title`
--
ALTER TABLE `add_ons_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_role_permission`
--
ALTER TABLE `admin_role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `app_event`
--
ALTER TABLE `app_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branch_table`
--
ALTER TABLE `branch_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `branch_table_images`
--
ALTER TABLE `branch_table_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories_branches`
--
ALTER TABLE `categories_branches`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_items`
--
ALTER TABLE `category_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities_area`
--
ALTER TABLE `cities_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_areas_price`
--
ALTER TABLE `delivery_areas_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_user`
--
ALTER TABLE `feedback_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items_branches`
--
ALTER TABLE `items_branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `items_list`
--
ALTER TABLE `items_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `order_addons`
--
ALTER TABLE `order_addons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `userdashboard`
--
ALTER TABLE `userdashboard`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_dashboards`
--
ALTER TABLE `users_dashboards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_ons_list`
--
ALTER TABLE `add_ons_list`
  ADD CONSTRAINT `add_ons_list_ibfk_1` FOREIGN KEY (`add_ons_cat_id`) REFERENCES `add_ons_title` (`id`);

--
-- Constraints for table `add_ons_title`
--
ALTER TABLE `add_ons_title`
  ADD CONSTRAINT `add_ons_title_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items_list` (`id`);

--
-- Constraints for table `admin_role_permission`
--
ALTER TABLE `admin_role_permission`
  ADD CONSTRAINT `admin_role_permission_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `admin_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_role_permission_ibfk_3` FOREIGN KEY (`permission_id`) REFERENCES `admin_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branch_table`
--
ALTER TABLE `branch_table`
  ADD CONSTRAINT `branch_table_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories_branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items_branches`
--
ALTER TABLE `items_branches`
  ADD CONSTRAINT `items_branches_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_branches_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items_list`
--
ALTER TABLE `items_list`
  ADD CONSTRAINT `items_list_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_dashboards`
--
ALTER TABLE `users_dashboards`
  ADD CONSTRAINT `users_dashboards_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `admin_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
