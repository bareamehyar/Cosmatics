-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2021 at 09:28 AM
-- Server version: 5.7.34
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goldenus_golden_meal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_ons`
--

CREATE TABLE `add_ons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL,
  `price` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `AddOns_Categories_Id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `add_ons_categories`
--

CREATE TABLE `add_ons_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `name_ar` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `add_ons_categories`
--

INSERT INTO `add_ons_categories` (`id`, `name_en`, `name_ar`, `item_id`, `created_at`, `updated_at`) VALUES
(4, 'Potato', 'بطاطا', 1, NULL, NULL),
(5, 'chesse', 'جبنة', 1, NULL, NULL),
(6, 'Americana mayonnaise', 'مايونيز امريكانا', 1, NULL, NULL),
(7, 'extra drinks', 'مشروبات اضافية', 6, NULL, NULL),
(8, 'side cheese', 'جبنة جانبية', 6, NULL, NULL),
(9, 'BBQ sauce', 'باربيكيو صوص', 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `add_ons_list`
--

CREATE TABLE `add_ons_list` (
  `id` int(11) NOT NULL,
  `add_ons_cat_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `add_ons_list_en` varchar(200) COLLATE utf8_croatian_ci NOT NULL,
  `add_ons_list_ar` varchar(200) COLLATE utf8_croatian_ci NOT NULL,
  `price` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1- active / 2- not active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `add_ons_list`
--

INSERT INTO `add_ons_list` (`id`, `add_ons_cat_id`, `item_id`, `add_ons_list_en`, `add_ons_list_ar`, `price`, `status`) VALUES
(1, 1, 1, 'Small Potato', 'بطاطا صغير', '0.5', 1),
(2, 1, 1, 'medium Potato', 'بطاطا وسط', '0.9', 1),
(3, 1, 1, 'large potato', 'بطاطا كبير', '1.2', 1),
(4, 2, 1, 'Mozzarella cheese', 'جبنة موزريلا', '1.00', 1),
(5, 2, 1, 'Kashkawan cheese', 'جبنة قشقوان', '1.10', 1),
(6, 3, 1, 'one Box', 'علبة واحدة', '0.3', 1),
(7, 2, 1, 'Mix Cheese', 'مكس اجبان', '1.50', 1);

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

--
-- Dumping data for table `add_ons_title`
--

INSERT INTO `add_ons_title` (`id`, `add_ons_name_en`, `add_ons_name_ar`, `item_id`, `which_choice`) VALUES
(1, 'Potato', 'بطاطا', 1, 1),
(2, 'cheese', 'جبنة', 1, 2),
(3, 'Americana mayonnaise', 'امريكانا مايونيز', 1, 1),
(4, 'extra drinks', 'مشروبات اضافية', 6, 2),
(5, 'side cheese', 'جبنة جانبية', 6, 1),
(6, 'BBQ sauce', 'باربيكيو صوص', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `whats_app_number` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `whats_app_message` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `phone_number` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `web_url` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `facebook_url` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `instagram_url` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `google_play_url` varchar(1000) COLLATE utf8_croatian_ci NOT NULL,
  `app_store_url` varchar(1000) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `created_at`, `updated_at`, `whats_app_number`, `whats_app_message`, `phone_number`, `web_url`, `facebook_url`, `instagram_url`, `google_play_url`, `app_store_url`) VALUES
(1, NULL, NULL, '+962797456406', 'Hello Golden Meal, ...', '+962797456406', 'https://goldenmeal.jo/', 'https://www.facebook.com/GoldenMealJO/', 'https://www.instagram.com/goldenmeal/', 'https://play.google.com/store/apps/developer?id=DIGI+SOL+FZE&hl=ar&gl=US', 'https://play.google.com/store/apps/developer?id=DIGI+SOL+FZE&hl=ar&gl=US');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `EstimatedTime` int(11) NOT NULL DEFAULT '0',
  `user_vendor` int(11) DEFAULT NULL,
  `vendor_password` varchar(100) COLLATE utf8_croatian_ci DEFAULT NULL,
  `register_vendor_status` int(1) NOT NULL COMMENT '2.haveVendor 1.Active0.InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches_stores`
--

CREATE TABLE `branches_stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_name` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `branche_id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(200) COLLATE utf8_croatian_ci NOT NULL,
  `latitude` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `longitude` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches_work_hours`
--

CREATE TABLE `branches_work_hours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Branch_id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `StartHour` time NOT NULL,
  `EndHour` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

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
  `phone_number` varchar(50) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `branch_table`
--

INSERT INTO `branch_table` (`id`, `store_name`, `latitude`, `longitude`, `img_url`, `phone_number`) VALUES
(1, 'Abu Nuseir', 32.06439, 35.88025, 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/branch.png', '065230111'),
(2, 'Alhussein', 31.97, 35.92, 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/alhussein.png', '065230111'),
(3, 'Albayader', 31.9542255, 35.8390563, 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/bayader.png', '065230111'),
(4, 'Prince Hassan Street', 31.9083743, 35.9381798, 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/prince_hussein.png', '065230111'),
(5, 'Al-Salt', 32.0333, 35.7333, 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/salt.png', '065230111'),
(6, 'Sweileh', 32.021888, 35.8439368, 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/sweileh.png', '065230111');

-- --------------------------------------------------------

--
-- Table structure for table `cards_tables`
--

CREATE TABLE `cards_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `card_number` bigint(255) NOT NULL,
  `month` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `security_code` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_branch_names`
--

CREATE TABLE `category_branch_names` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `name_ar` text COLLATE utf8_croatian_ci NOT NULL,
  `ImageUrl` text COLLATE utf8_croatian_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

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
  `category_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1- active / 2- not active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `category_name_en`, `category_name_ar`, `category_image_url`, `category_status`) VALUES
(1, 'Shawerma', 'شاورما', 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/Shawerma.png', 1),
(2, 'Snacks', 'سناك', 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/Snacks.png', 1),
(3, 'Fried Chicken', 'بروستد', 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/Fried Chicken.png', 1),
(4, 'Barbeque', 'مشاوي', 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/Barbeque.png', 1),
(5, 'Tika Chicken', 'دجاج تكا', 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/Tika Chicken.png', 1),
(6, 'Turkish Chicken', 'دجاج تركي', 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/Turkish Chicken.png', 1),
(7, 'Single Meals', 'الوجبات الفردية', 'https://goldenmealpro.digisolapps.com/golden_meal_backend/public/upload/Single Meal.png', 1);

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
(2, 'Irbid'),
(3, 'Salt'),
(4, 'Zarqa');

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
(1, 1, 'Jabal Alhussein'),
(2, 1, 'Sweileh'),
(3, 1, 'Abu Nusseir'),
(4, 1, 'Maddineh Street'),
(5, 2, '100th Street'),
(6, 2, 'University Street'),
(7, 3, 'Yarqa'),
(8, 3, 'Allan'),
(9, 3, '60th Street'),
(16, 4, 'Hashmieh');

-- --------------------------------------------------------

--
-- Table structure for table `cuisines`
--

CREATE TABLE `cuisines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CuisineType` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branche_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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

--
-- Dumping data for table `feedback_user`
--

INSERT INTO `feedback_user` (`id`, `phone_number`, `user_email`, `user_note`) VALUES
(18, '+962797456406', 'zzzzz', 'nooooo'),
(19, '+962790782033', 'fsdvfsdv', 'nono'),
(20, '+962790782033', 'mohdalzoubi96.2@gmail.com', 'my in digisol fze.com');

-- --------------------------------------------------------

--
-- Table structure for table `feed_back_orders`
--

CREATE TABLE `feed_back_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_rating` int(11) NOT NULL,
  `delivery_rating` int(11) NOT NULL,
  `rejected_reason` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

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
  `item_description_en` varchar(500) COLLATE utf8_croatian_ci NOT NULL,
  `item_description_ar` varchar(500) COLLATE utf8_croatian_ci NOT NULL,
  `item_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1- active / 2- not active',
  `item_image` varchar(1000) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `items_list`
--

INSERT INTO `items_list` (`id`, `category_id`, `item_name_en`, `item_name_ar`, `item_price`, `item_description_en`, `item_description_ar`, `item_status`, `item_image`) VALUES
(1, 1, 'Normal Shawerma', 'شاورما عادي', '2.00', 'Normal Shawerma with potato and pepsi', 'شاورما عادي مع بطاطا مع بيبسي', 1, 'https://goldenmeal.jo/Upload/Product/a40a0913-e413-43d2-9cb5-ce0c3f49f17e.jpg'),
(2, 1, 'Shawerma Super', 'شاورما سوبر', '2.90', 'Shawerma Super with potato and pepsi', 'شاورما سوبر مع بطاطا و بيبسي', 1, 'https://goldenmeal.jo/Upload/Product/d7ab2a53-db6d-486b-a184-682d10c21a95.jpg'),
(3, 1, 'Shawerma Double', 'شاورما دبل', '3.50', 'Shawerma Double with potato and pepsi\r\n', 'شاورما دبل مع بطاطا و بيبسي', 1, 'https://goldenmeal.jo/Upload/Product/b6473acb-d1cf-4c53-8a12-5777eaf7f0b7.jpg'),
(4, 1, 'Shawerma Trouble', 'شاورما تربل ', '4.20', 'Shawerma Trouble with potato and pepsi', 'شاورما تربل  مع بطاطا و بيبسي', 1, 'https://goldenmeal.jo/Upload/Product/468e05f6-1191-4338-ac48-2f0f9e1bebf5.jpg'),
(5, 1, 'savings meal', 'وجبة التوفير', '7.00', '4 super sandwiches + fries + appetizers + 2 garlic dip + 2 Mexican garlic dip', 'عدد 4 ساندويش سوبر +بطاطا+مقبلات+2 مثومة+2 مثومة مكسيكي', 1, 'https://goldenmeal.jo/Upload/Product/a5b4dff7-532a-4027-8396-25aeb4e07e4b.jpg'),
(6, 1, 'Intention meal', 'وجبة العزيمة', '14.0', '10 super sandwiches + 1 potato + appetizers + 3 garlic dip + 3 Mexican garlic dip', 'عدد 10 ساندويش سوبر+1 بطاطا+مقبلات+3 مثومة+3 مثومة مكسيكي', 1, 'https://goldenmeal.jo/Upload/Product/bb3b2ffe-5e43-494c-b7ca-6176dff3c073.jpg'),
(7, 2, 'snack', 'الوجبة الخفيفة', '2.75', '4 broasted pieces + basmati rice plate + sauce + Pepsi', 'قطع بروستد عدد 4+صحن أرز بسمتي+صوص+بيبسي', 1, 'https://goldenmeal.jo/Upload/Product/697c76fa-6da4-4432-9619-cdc564b1f719.jpg'),
(8, 3, 'Combo 1', 'كومبو 1', '2.65', 'Three pieces of chicken (two pieces + wing) +1 fries +1 garlic dip +1 coleslaw +1 bread +1 Pepsi +1 water', 'ثلاثة قطع دجاج (قطعتين +جناح)+1 بطاطا+1 مثومة+1 كولسلو+1 خبز+1 بيبسي+1 مياه', 1, 'https://goldenmeal.jo/Upload/Product/05455d5a-5113-41c1-b1d2-8abdb62191ed.jpg'),
(9, 4, 'Grills 3', 'مشاوي 3\r\n', '3.00', 'Two pieces of chicken tikka (half chicken) + fries + garlic + pepsi + tortilla bread', 'قطعتين دجاج تكا(نصف دجاجة)+بطاطا+مثومة+بيبسي+خبز تورتيلا', 1, 'https://goldenmeal.jo/Upload/Product/7f62b700-549a-4dac-911e-567be0bc2a67.jpg'),
(10, 5, '2 chicken tikka - 8 pieces', 'دجاجتين تكا-8 قطع', '15.00', '8 pieces of chicken tikka + cedar basmati rice + 8 sauces', 'قطع دجاج تكا عدد 8 +سدر أرز بسمتي+8 صوص', 1, 'https://goldenmeal.jo/Upload/Product/529313eb-36cb-474f-97e0-f71c57a3de6a.jpg'),
(11, 6, 'Chicken and a half - 18 pieces', 'دجاجة ونصف-18 قطعة', '12.50', 'Chicken and a half -18 pieces + cedar basmati rice + 6 sauces', 'دجاجة ونصف -18 قطعة+سدر أرز بسمتي+6 صوص', 1, 'https://goldenmeal.jo/Upload/Product/53fcae6b-a4a6-41be-9223-0594da233d1d.jpg'),
(12, 7, 'Crispy 1', 'كرسبي 1\r\n', '2.50', 'Three pieces of crispy with rice basmati dish + sauce + Pepsi', 'ثلاث قطع كرسبي مع صحن أرزبسمتي +صوص+بيبسي', 1, 'https://goldenmeal.jo/Upload/Product/63eadefe-736e-489f-8d1e-16b445b5f9b0.png');

-- --------------------------------------------------------

--
-- Table structure for table `items_tables`
--

CREATE TABLE `items_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `item_image` text COLLATE utf8_croatian_ci NOT NULL,
  `status` int(11) NOT NULL,
  `price` float NOT NULL,
  `Is_Sizes` int(11) NOT NULL COMMENT '0.InSizes 1.Sizes',
  `Description` text COLLATE utf8_croatian_ci NOT NULL,
  `Description_ar` text COLLATE utf8_croatian_ci NOT NULL,
  `Offer_Activation` int(11) NOT NULL COMMENT '0.InActive 1.Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `Rate` float(2,1) NOT NULL,
  `OfferValue` float NOT NULL,
  `Offer_type` int(11) NOT NULL COMMENT '0.NoOffer 1.offer_parcent 2.offer_value',
  `HasToppings` int(11) NOT NULL COMMENT '0.no has 1.has topping'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_sizes`
--

CREATE TABLE `item_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lang_translations`
--

CREATE TABLE `lang_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(2) COLLATE utf8_croatian_ci NOT NULL,
  `translate_title` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `translate` text COLLATE utf8_croatian_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `translate_title_ar` text COLLATE utf8_croatian_ci NOT NULL,
  `translate_ar` text COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_branch_categories`
--

CREATE TABLE `main_branch_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Branch_id` bigint(20) UNSIGNED NOT NULL,
  `category_branch_name_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marsols`
--

CREATE TABLE `marsols` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branche_id` bigint(20) UNSIGNED NOT NULL,
  `tax` double(8,2) NOT NULL,
  `marsols_Image` text COLLATE utf8_croatian_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0.InActive 1.Active',
  `city` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `long` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `delivery_free` int(11) DEFAULT NULL COMMENT '0.InActive 1.Active',
  `rating` int(11) DEFAULT NULL,
  `order_count` int(11) DEFAULT NULL,
  `street_number` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `street_name` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

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
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_croatian_ci,
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
  `scopes` text COLLATE utf8_croatian_ci,
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
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `offer_Image` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `Branches_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offer_sliders`
--

CREATE TABLE `offer_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Branches_id` bigint(20) UNSIGNED NOT NULL,
  `Silder_image` text COLLATE utf8_croatian_ci NOT NULL,
  `Status` int(11) NOT NULL COMMENT '0.InActive 1.Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `tax` double(8,2) NOT NULL DEFAULT '0.00',
  `Total_Amount` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `DropOffAddress` varchar(100) COLLATE utf8_croatian_ci DEFAULT NULL,
  `pickUpAddress` varchar(100) COLLATE utf8_croatian_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `instruction` varchar(1000) COLLATE utf8_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `phone_number`, `Status`, `paymentMethod`, `totalQty`, `tax`, `Total_Amount`, `DropOffAddress`, `pickUpAddress`, `created_at`, `updated_at`, `instruction`) VALUES
(148, 1, '+962797456406', '1', 'Cash', '2', 0.00, '4', 'Work', NULL, '2021-07-08 05:00:14', '2021-07-08 05:00:14', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `order_drivers`
--

CREATE TABLE `order_drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(15) COLLATE utf8_croatian_ci NOT NULL COMMENT '	0-pending 1-accepted 2-pickup 3-completed 4-Rejected	',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

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
(156, 148, 1, 2, 2.00, '2', 1, 'https://goldenmeal.jo/Upload/Product/a40a0913-e413-43d2-9cb5-ce0c3f49f17e.jpg', 'Normal Shawerma', 'شاورما عادي', '2021-07-08 05:00:14', '2021-07-08 05:00:14');

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
-- Table structure for table `payment_meyhod`
--

CREATE TABLE `payment_meyhod` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `payment_meyhod`
--

INSERT INTO `payment_meyhod` (`id`, `title`) VALUES
(1, 'Cash'),
(2, 'Credit Card On Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacies`
--

CREATE TABLE `pharmacies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branche_id` bigint(20) UNSIGNED NOT NULL,
  `tax` double(8,2) NOT NULL,
  `pharmacies_Image` text COLLATE utf8_croatian_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0.InActive 1.Active',
  `city` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `long` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `delivery_free` int(11) DEFAULT '0' COMMENT '0.InActive 1.Active',
  `rating` float(5,1) DEFAULT '0.0',
  `order_count` int(11) DEFAULT NULL,
  `street_number` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `street_name` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `estimate_delivery_time` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `RatingCount` int(11) NOT NULL,
  `OfferValue` float NOT NULL,
  `Offer_type` int(11) NOT NULL COMMENT '0.NoOffer 1.offer_parcent 2.offer_value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `promo_codes_name` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `promo_code_type` varchar(255) COLLATE utf8_croatian_ci NOT NULL COMMENT '0-parcent 1-value',
  `value` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-active 0-expired',
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `max_number_of_used` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo_code_users`
--

CREATE TABLE `promo_code_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promoCode_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_uses_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Cuisines_id` bigint(20) UNSIGNED NOT NULL,
  `branche_id` bigint(20) UNSIGNED NOT NULL,
  `tax` double(8,2) NOT NULL,
  `Restaurant_Image` text COLLATE utf8_croatian_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0.InActive 1.Active',
  `city` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `long` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `delivery_free` int(11) DEFAULT '0' COMMENT '0.InActive 1.Active',
  `rating` float(2,1) DEFAULT '0.0',
  `order_count` int(11) DEFAULT NULL,
  `street_number` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `street_name` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `estimate_delivery_time` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `RatingCount` int(11) NOT NULL,
  `OfferValue` float NOT NULL,
  `Offer_type` int(11) NOT NULL COMMENT '0.NoOffer 1.offer_parcent 2.offer_value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_croatian_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_croatian_ci,
  `payload` text COLLATE utf8_croatian_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branche_id` bigint(20) UNSIGNED NOT NULL,
  `tax` json NOT NULL,
  `shipments_Image` text COLLATE utf8_croatian_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0.InActive 1.Active',
  `city` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `long` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `delivery_free` int(11) DEFAULT NULL COMMENT '0.InActive 1.Active',
  `rating` int(11) DEFAULT NULL,
  `order_count` int(11) DEFAULT NULL,
  `street_number` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `street_name` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_order_details`
--

CREATE TABLE `shipment_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8_croatian_ci NOT NULL COMMENT '1. size 2.weight 3.time',
  `details` text COLLATE utf8_croatian_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Branches_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_croatian_ci NOT NULL COMMENT '*-category *-subCategory  *-item\r\n*-branche *vendr',
  `cat_id` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '1' COMMENT '0.InActive 1.Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Silder_image` text COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supermarkets`
--

CREATE TABLE `supermarkets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branche_id` bigint(20) UNSIGNED NOT NULL,
  `tax` double(8,2) NOT NULL,
  `supermarkets_Image` text COLLATE utf8_croatian_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0.InActive 1.Active',
  `city` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `long` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `delivery_free` int(11) DEFAULT NULL COMMENT '0.InActive 1.Active',
  `rating` float(5,1) DEFAULT '0.0',
  `order_count` int(11) DEFAULT NULL,
  `street_number` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `street_name` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `estimate_delivery_time` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `RatingCount` int(11) NOT NULL,
  `OfferValue` float NOT NULL,
  `Offer_type` int(11) NOT NULL COMMENT '0.NoOffer 1.offer_parcent 2.offer_value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `UserDashboard`
--

CREATE TABLE `UserDashboard` (
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
  `status` varchar(11) COLLATE utf8_croatian_ci DEFAULT NULL COMMENT 'unactive ,active',
  `remember_token` text COLLATE utf8_croatian_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Type` varchar(255) COLLATE utf8_croatian_ci NOT NULL DEFAULT 'user',
  `lat` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `long` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `allow_register_vor` int(1) NOT NULL DEFAULT '0',
  `allow_register_driver` int(1) DEFAULT '0',
  `driver_password` varchar(100) COLLATE utf8_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firebase_id`, `first_name`, `last_name`, `email`, `MobileNumber`, `is_logged_in`, `email_verified_at`, `password`, `Address`, `status`, `remember_token`, `created_at`, `updated_at`, `Type`, `lat`, `long`, `allow_register_vor`, `allow_register_driver`, `driver_password`) VALUES
(67, 'Efun9pQHlQhdlxLsFy7Eq56Vmg62', 'alzo3bi', 'mohd', NULL, '+962797456406', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(68, 'wI6TA8HCwPdQucAXsec4U7xHAM83', 'suhaib', 'albdoor', NULL, '+962790782033', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(69, 'V3MAZ5Rc3vh6BCM85pCa0jHwmNw1', 'بشار ‏', 'فارس ‏', NULL, '+962779988244', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(70, 'n5vPiVLmCpXDHESDeQCgEOLjpnC2', 'bashar ', 'bashar ', NULL, '+962787872994', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(72, 'cEQct2y543e61ui6pkZBgveP9z93', 'علي ‏', 'العطيات ‏', NULL, '+962785555594', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(73, 'reychrJYvDYor6gAZU1dSWiqDJb2', 'barea', 'mehyar', NULL, '+962792841178', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(74, 'MesxZRC53pQoevRIuDEHGsymCcL2', 'ثائر ‏', 'زايد', NULL, '+962795644298', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(75, 'kbsi5Ply1xTSjrmgffpUOJ6Vqim2', 'ahmed', 'Ammous ', NULL, '+962795125656', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL),
(76, 'wEjR49E0NybVEGCGqOrGcW3p8wc2', 'mohamma', 'null', NULL, '+962775054337', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL, 0, 0, NULL);

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
  `apartment_number` varchar(50) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_phone`, `title`, `area_name`, `sub_local`, `building_number`, `floor_number`, `apartment_number`) VALUES
(44, '+962797456406', 'Work', 'amman', 'mecca st', '7', '8', '1');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_image` text COLLATE utf8_croatian_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 - InActive 1- Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_sliders`
--

CREATE TABLE `vendor_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `Branch_id` bigint(20) UNSIGNED NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '1' COMMENT '0.InActive 1.Active',
  `Silder_image` text COLLATE utf8_croatian_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_ons`
--
ALTER TABLE `add_ons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `add_ons_item_id_foreign` (`item_id`),
  ADD KEY `add_ons_lang_id_foreign` (`lang_id`),
  ADD KEY `add_ons_addons_categories_id_foreign` (`AddOns_Categories_Id`);

--
-- Indexes for table `add_ons_categories`
--
ALTER TABLE `add_ons_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_ons_list`
--
ALTER TABLE `add_ons_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_ons_title`
--
ALTER TABLE `add_ons_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branches_vendor_id_foreign` (`vendor_id`),
  ADD KEY `branches_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `branches_stores`
--
ALTER TABLE `branches_stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branches_stores_branche_id_foreign` (`branche_id`),
  ADD KEY `branches_stores_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `branches_work_hours`
--
ALTER TABLE `branches_work_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branches_work_hours_branch_id_foreign` (`Branch_id`);

--
-- Indexes for table `branch_table`
--
ALTER TABLE `branch_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards_tables`
--
ALTER TABLE `cards_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cards_tables_user_id_foreign` (`user_id`);

--
-- Indexes for table `category_branch_names`
--
ALTER TABLE `category_branch_names`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_branch_names_vendor_id_foreign` (`vendor_id`);

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
-- Indexes for table `cuisines`
--
ALTER TABLE `cuisines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourites_branche_id_foreign` (`branche_id`),
  ADD KEY `favourites_user_id_foreign` (`user_id`);

--
-- Indexes for table `feedback_user`
--
ALTER TABLE `feedback_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_back_orders`
--
ALTER TABLE `feed_back_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feed_back_orders_order_id_foreign` (`order_id`);

--
-- Indexes for table `items_list`
--
ALTER TABLE `items_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_tables`
--
ALTER TABLE `items_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_tables_lang_id_foreign` (`lang_id`),
  ADD KEY `items_tables_category_id_foreign` (`category_id`);

--
-- Indexes for table `item_sizes`
--
ALTER TABLE `item_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_sizes_item_id_foreign` (`item_id`),
  ADD KEY `item_sizes_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `lang_translations`
--
ALTER TABLE `lang_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_branch_categories`
--
ALTER TABLE `main_branch_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_branch_categories_branch_id_foreign` (`Branch_id`),
  ADD KEY `main_branch_categories_category_branch_name_id_foreign` (`category_branch_name_id`);

--
-- Indexes for table `marsols`
--
ALTER TABLE `marsols`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marsols_branche_id_foreign` (`branche_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_branches_id_foreign` (`Branches_id`);

--
-- Indexes for table `offer_sliders`
--
ALTER TABLE `offer_sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_sliders_branches_id_foreign` (`Branches_id`);

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
-- Indexes for table `order_drivers`
--
ALTER TABLE `order_drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_drivers_driver_id_foreign` (`driver_id`),
  ADD KEY `order_drivers_order_id_foreign` (`order_id`);

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
-- Indexes for table `payment_meyhod`
--
ALTER TABLE `payment_meyhod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacies`
--
ALTER TABLE `pharmacies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pharmacies_branche_id_foreign` (`branche_id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_code_users`
--
ALTER TABLE `promo_code_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_code_users_promocode_id_foreign` (`promoCode_id`),
  ADD KEY `promo_code_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurants_branche_id_foreign` (`branche_id`),
  ADD KEY `restaurants_cuisines_id_foreign` (`Cuisines_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipments_branche_id_foreign` (`branche_id`);

--
-- Indexes for table `shipment_order_details`
--
ALTER TABLE `shipment_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_branches_id_foreign` (`Branches_id`);

--
-- Indexes for table `supermarkets`
--
ALTER TABLE `supermarkets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supermarkets_branche_id_foreign` (`branche_id`);

--
-- Indexes for table `UserDashboard`
--
ALTER TABLE `UserDashboard`
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
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendors_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `vendor_sliders`
--
ALTER TABLE `vendor_sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_sliders_vendor_id_foreign` (`vendor_id`),
  ADD KEY `vendor_sliders_branch_id_foreign` (`Branch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_ons`
--
ALTER TABLE `add_ons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `add_ons_categories`
--
ALTER TABLE `add_ons_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `add_ons_list`
--
ALTER TABLE `add_ons_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `add_ons_title`
--
ALTER TABLE `add_ons_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=377;

--
-- AUTO_INCREMENT for table `branches_stores`
--
ALTER TABLE `branches_stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `branches_work_hours`
--
ALTER TABLE `branches_work_hours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch_table`
--
ALTER TABLE `branch_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cards_tables`
--
ALTER TABLE `cards_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_branch_names`
--
ALTER TABLE `category_branch_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category_items`
--
ALTER TABLE `category_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=625;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities_area`
--
ALTER TABLE `cities_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cuisines`
--
ALTER TABLE `cuisines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `feedback_user`
--
ALTER TABLE `feedback_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `feed_back_orders`
--
ALTER TABLE `feed_back_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items_list`
--
ALTER TABLE `items_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `items_tables`
--
ALTER TABLE `items_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=720;

--
-- AUTO_INCREMENT for table `item_sizes`
--
ALTER TABLE `item_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lang_translations`
--
ALTER TABLE `lang_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1964;

--
-- AUTO_INCREMENT for table `main_branch_categories`
--
ALTER TABLE `main_branch_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `marsols`
--
ALTER TABLE `marsols`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

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
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offer_sliders`
--
ALTER TABLE `offer_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `order_addons`
--
ALTER TABLE `order_addons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `order_drivers`
--
ALTER TABLE `order_drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `payment_meyhod`
--
ALTER TABLE `payment_meyhod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pharmacies`
--
ALTER TABLE `pharmacies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `promo_code_users`
--
ALTER TABLE `promo_code_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipment_order_details`
--
ALTER TABLE `shipment_order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `supermarkets`
--
ALTER TABLE `supermarkets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `UserDashboard`
--
ALTER TABLE `UserDashboard`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vendor_sliders`
--
ALTER TABLE `vendor_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_ons`
--
ALTER TABLE `add_ons`
  ADD CONSTRAINT `add_ons_addons_categories_id_foreign` FOREIGN KEY (`AddOns_Categories_Id`) REFERENCES `add_ons_categories` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `add_ons_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items_tables` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `add_ons_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `lang_translations` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `lang_translations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `branches_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`);

--
-- Constraints for table `branches_stores`
--
ALTER TABLE `branches_stores`
  ADD CONSTRAINT `branches_stores_branche_id_foreign` FOREIGN KEY (`branche_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `branches_stores_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `lang_translations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branches_work_hours`
--
ALTER TABLE `branches_work_hours`
  ADD CONSTRAINT `branches_work_hours_branch_id_foreign` FOREIGN KEY (`Branch_id`) REFERENCES `branches` (`id`);

--
-- Constraints for table `category_branch_names`
--
ALTER TABLE `category_branch_names`
  ADD CONSTRAINT `category_branch_names_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
