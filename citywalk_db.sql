-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2025 at 06:29 PM
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
-- Database: `citywalk_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `action_description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`log_id`, `user_id`, `action_type`, `action_description`, `ip_address`, `created_at`) VALUES
(1, 1, 'login', 'User logged in', '::1', '2025-12-19 04:19:25'),
(2, 1, 'update_product', 'Updated product: Casual Canvas Sneakers', '::1', '2025-12-19 04:22:03'),
(3, 1, 'update_product', 'Updated product: Elegant Heels', '::1', '2025-12-19 04:22:23'),
(4, 1, 'update_product', 'Updated product: Kids Sports Shoes', '::1', '2025-12-19 04:22:38'),
(5, 1, 'place_order', 'Placed order: CW20251219095309909', '::1', '2025-12-19 04:23:09'),
(6, 2, 'login', 'User logged in', '::1', '2025-12-19 04:23:57'),
(7, 2, 'place_order', 'Placed order: CW20251219095408396', '::1', '2025-12-19 04:24:08'),
(8, 1, 'login', 'User logged in', '::1', '2025-12-19 04:24:23'),
(9, 1, 'delete_product', 'Deleted product ID: 1', '::1', '2025-12-19 04:32:43'),
(10, 1, 'delete_product', 'Deleted product ID: 3', '::1', '2025-12-19 04:32:49'),
(11, 1, 'delete_product', 'Deleted product ID: 2', '::1', '2025-12-19 04:32:59'),
(12, 1, 'update_product', 'Updated product: Ballet Flats', '::1', '2025-12-19 04:33:12'),
(13, 1, 'update_product', 'Updated product: Casual Sandals', '::1', '2025-12-19 04:33:37'),
(14, 1, 'update_product', 'Updated product: Wedge Sandals', '::1', '2025-12-19 04:34:04'),
(15, 1, 'update_product', 'Updated product: Ankle Boots', '::1', '2025-12-19 04:34:19'),
(16, 1, 'update_product', 'Updated product: Rain Boots', '::1', '2025-12-19 04:35:03'),
(17, 1, 'delete_product', 'Deleted product ID: 24', '::1', '2025-12-19 04:35:07'),
(18, 1, 'update_product', 'Updated product: Sports Trainers', '::1', '2025-12-19 04:35:19'),
(19, 1, 'delete_product', 'Deleted product ID: 20', '::1', '2025-12-19 04:35:30'),
(20, 1, 'update_product', 'Updated product: Colorful Sneakers', '::1', '2025-12-19 04:35:51'),
(21, 1, 'update_product', 'Updated product: Velcro Sandals', '::1', '2025-12-19 04:36:03'),
(22, 1, 'delete_product', 'Deleted product ID: 21', '::1', '2025-12-19 04:36:35'),
(23, 1, 'login', 'User logged in', '::1', '2025-12-19 05:14:06'),
(24, 1, 'update_order', 'Updated order #2 to shipped', '::1', '2025-12-19 05:14:16'),
(25, 1, 'add_product', 'Added product: Women Sport Shoes', '::1', '2025-12-19 05:25:27'),
(26, 1, 'update_product', 'Updated product: Women Sport Shoes', '::1', '2025-12-19 05:25:51'),
(27, 1, 'place_order', 'Placed order: CW20251219105629937', '::1', '2025-12-19 05:26:29'),
(28, 2, 'login', 'User logged in', '::1', '2025-12-19 05:29:19'),
(29, 2, 'place_order', 'Placed order: CW20251219105932361', '::1', '2025-12-19 05:29:32'),
(30, 1, 'login', 'User logged in', '::1', '2025-12-19 05:30:53'),
(31, 1, 'add_product', 'Added product: Classic Oxford Shoes 1233', '::1', '2025-12-19 05:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `banner_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `description`, `is_active`, `created_at`) VALUES
(1, 'City Walk Premium', 'Premium quality footwear', 1, '2025-12-19 04:17:04'),
(2, 'City Walk Casual', 'Comfortable casual footwear', 1, '2025-12-19 04:17:04'),
(3, 'City Walk Sport', 'Sports and athletic footwear', 1, '2025-12-19 04:17:04'),
(4, 'City Walk Elegance', 'Elegant formal footwear', 1, '2025-12-19 04:17:04'),
(5, 'City Walk Summer', 'Summer collection', 1, '2025-12-19 04:17:04'),
(6, 'City Walk Kids', 'Kids footwear collection', 1, '2025-12-19 04:17:04'),
(7, 'City Walk School', 'School shoes collection', 1, '2025-12-19 04:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_category` varchar(50) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `slug`, `description`, `parent_category`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Men', 'men', 'Professional & Casual Footwear for Men', NULL, 1, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03'),
(2, 'Women', 'women', 'Elegant & Comfortable Styles for Women', NULL, 2, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03'),
(3, 'Kids', 'kids', 'Fun & Durable Designs for Kids', NULL, 3, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03'),
(4, 'Formal', 'formal', 'Formal footwear', 'men', 1, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03'),
(5, 'Casual', 'casual', 'Casual footwear', 'men', 2, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03'),
(6, 'Athletic', 'athletic', 'Athletic footwear', 'men', 3, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03'),
(7, 'Boots', 'boots', 'Boots', 'men', 4, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03'),
(8, 'Sandals', 'sandals', 'Sandals', 'men', 5, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03'),
(9, 'Heels', 'heels', 'High heels', 'women', 1, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03'),
(10, 'Flats', 'flats', 'Flat shoes', 'women', 2, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03'),
(11, 'Wedges', 'wedges', 'Wedge shoes', 'women', 3, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03'),
(12, 'Sneakers', 'sneakers', 'Sneakers', 'kids', 1, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03'),
(13, 'School', 'school', 'School shoes', 'kids', 2, 1, '2025-12-19 04:17:03', '2025-12-19 04:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `page_id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `page_title` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `meta_title` varchar(200) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`page_id`, `slug`, `page_title`, `content`, `meta_title`, `meta_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'about-us', 'About Us', '<h1>About City Walk</h1><p>Premium footwear for every step of your journey. We are committed to providing quality, comfort, and style in every pair.</p>', 'About City Walk', 'Learn more about City Walk footwear', 'active', '2025-12-19 04:17:04', '2025-12-19 04:25:10'),
(2, 'privacy-policy', 'Privacy Policy', '<h1>Privacy Policy</h1><p>Your privacy is important to us. This privacy policy explains how we collect, use, and protect your personal information.</p>', 'Privacy Policy', 'City Walk Privacy Policy', 'active', '2025-12-19 04:17:04', '2025-12-19 04:17:04'),
(3, 'terms-conditions', 'Terms and Conditions', '<h1>Terms and Conditions</h1><p>Please read these terms carefully before using our website or services.</p>', 'Terms and Conditions', 'City Walk Terms and Conditions', 'active', '2025-12-19 04:17:04', '2025-12-19 04:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `faq_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`faq_id`, `question`, `answer`, `category`, `display_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'What is your return policy?1234567890', 'We offer a 30-day return policy on all unused items in original packaging.', 'Returns', 1, 'active', '2025-12-19 04:17:04', '2025-12-19 05:28:04'),
(2, 'How long does shipping take?', 'Standard shipping takes 3-5 business days within Sri Lanka.', 'Shipping', 2, 'active', '2025-12-19 04:17:04', '2025-12-19 04:17:04'),
(3, 'Do you offer international shipping?', 'Currently, we only ship within Sri Lanka.', 'Shipping', 3, 'active', '2025-12-19 04:17:04', '2025-12-19 04:17:04'),
(4, 'How can I track my order?', 'Once your order is shipped, you will receive a tracking number via email.', 'Orders', 4, 'active', '2025-12-19 04:17:04', '2025-12-19 04:17:04'),
(5, 'What payment methods do you accept?', 'We accept credit cards, debit cards, and cash on delivery.', 'Payment', 5, 'active', '2025-12-19 04:17:04', '2025-12-19 04:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `subscriber_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `shipping_cost` decimal(10,2) DEFAULT 0.00,
  `tax_amount` decimal(10,2) DEFAULT 0.00,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `order_status` enum('pending','confirmed','processing','shipped','delivered','cancelled','refunded') DEFAULT 'pending',
  `payment_status` enum('pending','paid','failed','refunded') DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `shipping_address` text NOT NULL,
  `billing_address` text DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `courier_name` varchar(100) DEFAULT NULL,
  `tracking_number` varchar(100) DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `customer_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_number`, `total_amount`, `subtotal`, `shipping_cost`, `tax_amount`, `discount_amount`, `order_status`, `payment_status`, `payment_method`, `shipping_address`, `billing_address`, `customer_name`, `customer_email`, `customer_phone`, `courier_name`, `tracking_number`, `admin_notes`, `customer_notes`, `created_at`, `updated_at`, `shipped_at`, `delivered_at`) VALUES
(1, 1, 'CW20251219095309909', 27000.00, NULL, 0.00, 0.00, 0.00, 'pending', 'pending', 'Cash on Delivery', '', NULL, 'Admin', 'admin@citywalk.lk', '', NULL, NULL, NULL, NULL, '2025-12-19 04:23:09', '2025-12-19 04:23:09', NULL, NULL),
(2, 2, 'CW20251219095408396', 26900.00, NULL, 0.00, 0.00, 0.00, 'shipped', 'pending', 'Cash on Delivery', '', NULL, 'AazDa', 'aaz@gmail.com', '', NULL, NULL, NULL, NULL, '2025-12-19 04:24:08', '2025-12-19 05:14:16', NULL, NULL),
(3, 1, 'CW20251219105629937', 33800.00, NULL, 0.00, 0.00, 0.00, 'pending', 'pending', 'Cash on Delivery', '', NULL, 'Admin', 'admin@citywalk.lk', '', NULL, NULL, NULL, NULL, '2025-12-19 05:26:29', '2025-12-19 05:26:29', NULL, NULL),
(4, 2, 'CW20251219105932361', 40600.00, NULL, 0.00, 0.00, 0.00, 'pending', 'pending', 'Cash on Delivery', '', NULL, 'AazDa', 'aaz@gmail.com', '', NULL, NULL, NULL, NULL, '2025-12-19 05:29:32', '2025-12-19 05:29:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `product_name`, `size`, `color`, `quantity`, `unit_price`, `subtotal`) VALUES
(1, 1, 1, 'Classic Oxford Dress Shoes', NULL, NULL, 1, 12500.00, 12500.00),
(2, 1, 2, 'Casual Canvas Sneakers', NULL, NULL, 1, 5500.00, 5500.00),
(3, 1, 4, 'Kids Sports Shoes', NULL, NULL, 2, 4500.00, 9000.00),
(4, 2, 1, 'Classic Oxford Dress Shoes', NULL, NULL, 1, 12500.00, 12500.00),
(5, 2, 2, 'Casual Canvas Sneakers', NULL, NULL, 1, 5500.00, 5500.00),
(6, 2, 3, 'Elegant Heels', NULL, NULL, 1, 8900.00, 8900.00),
(7, 3, 8, 'Classic Oxford Shoes', NULL, NULL, 1, 12500.00, 12500.00),
(8, 3, 9, 'Derby Dress Shoes', NULL, NULL, 1, 11800.00, 11800.00),
(9, 3, 10, 'Leather Loafers', NULL, NULL, 1, 9500.00, 9500.00),
(10, 4, 4, 'Kids Sports Shoes', NULL, NULL, 1, 4500.00, 4500.00),
(11, 4, 8, 'Classic Oxford Shoes', NULL, NULL, 1, 12500.00, 12500.00),
(12, 4, 9, 'Derby Dress Shoes', NULL, NULL, 2, 11800.00, 23600.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category` varchar(50) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `features` text DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT 0.00,
  `review_count` int(11) DEFAULT 0,
  `badge` varchar(50) DEFAULT NULL,
  `heel_height` enum('flat','low','medium','high') DEFAULT 'flat',
  `is_new` tinyint(1) DEFAULT 0,
  `is_featured` tinyint(1) DEFAULT 0,
  `stock_quantity` int(11) DEFAULT 0,
  `status` enum('active','inactive','out_of_stock') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `slug`, `category_id`, `sub_category`, `brand_id`, `price`, `description`, `features`, `rating`, `review_count`, `badge`, `heel_height`, `is_new`, `is_featured`, `stock_quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Classic Oxford Dress Shoes', 'classic-oxford-dress-shoes', 1, 'formal', 1, 12500.00, 'Timeless oxford design perfect for formal occasions', 'Premium leather, Cushioned insole, Breathable lining', 4.50, 45, 'Best Seller', 'flat', 0, 1, 23, 'inactive', '2025-12-19 04:17:04', '2025-12-19 04:32:43'),
(2, 'Casual Canvas Sneakers', 'casual-canvas-sneakers', 1, 'casual', 2, 5500.00, 'Comfortable everyday sneakers', 'Canvas upper, Rubber sole, Lightweight', 4.20, 32, '', 'flat', 1, 1, 48, 'inactive', '2025-12-19 04:17:04', '2025-12-19 04:32:59'),
(3, 'Elegant Heels', 'elegant-heels', 2, 'heels', 4, 8900.00, 'Sophisticated heels for special occasions', 'Leather finish, Pointed toe, Cushioned footbed', 4.70, 28, 'Popular', 'high', 0, 1, 14, 'inactive', '2025-12-19 04:17:04', '2025-12-19 04:32:49'),
(4, 'Kids Sports Shoes', 'kids-sports-shoes', 3, 'sneakers', 6, 4500.00, 'Durable sports shoes for active kids', 'Non-slip sole, Breathable mesh, Velcro straps', 4.30, 18, '', 'flat', 1, 0, 37, 'active', '2025-12-19 04:17:04', '2025-12-19 05:29:32'),
(8, 'Classic Oxford Shoes', 'classic-oxford-shoes', 1, 'formal', 1, 12500.00, 'Premium leather oxford shoes perfect for professional settings and formal occasions. Handcrafted with attention to detail.', '[\"Genuine leather\", \"Cushioned sole\", \"Professional finish\", \"Multiple sizes\"]', 4.80, 156, 'Best Seller', 'flat', 0, 1, 23, 'active', '2025-12-19 04:31:54', '2025-12-19 05:29:32'),
(9, 'Derby Dress Shoes', 'derby-dress-shoes', 1, 'formal', 1, 11800.00, 'Elegant derby shoes with premium finish. Perfect for business meetings and formal events.', '[\"Premium leather\", \"Comfortable fit\", \"Durable construction\"]', 4.60, 98, NULL, 'flat', 0, 1, 15, 'active', '2025-12-19 04:31:54', '2025-12-19 05:29:32'),
(10, 'Leather Loafers', 'leather-loafers', 1, 'casual', 2, 9500.00, 'Comfortable leather loafers for everyday wear. Versatile and stylish.', '[\"Genuine leather\", \"Slip-on design\", \"All-day comfort\"]', 4.70, 203, 'Popular', 'flat', 0, 1, 29, 'active', '2025-12-19 04:31:54', '2025-12-19 05:26:29'),
(11, 'Canvas Sneakers', 'canvas-sneakers', 1, 'casual', 2, 6500.00, 'Classic canvas sneakers perfect for casual outings and weekend wear.', '[\"Breathable canvas\", \"Rubber sole\", \"Lightweight\"]', 4.50, 145, NULL, 'flat', 0, 1, 40, 'active', '2025-12-19 04:31:54', '2025-12-19 04:31:54'),
(12, 'Running Shoes', 'running-shoes', 1, 'athletic', 3, 13500.00, 'High-performance running shoes with advanced cushioning technology.', '[\"Breathable mesh\", \"Shock absorption\", \"Lightweight design\"]', 4.90, 287, 'Top Rated', 'flat', 1, 1, 22, 'active', '2025-12-19 04:31:54', '2025-12-19 04:31:54'),
(13, 'Hiking Boots', 'hiking-boots', 1, 'boots', 1, 15800.00, 'Durable hiking boots built for adventure. Water-resistant and comfortable.', '[\"Water-resistant\", \"Ankle support\", \"Rugged outsole\"]', 4.80, 174, NULL, 'flat', 0, 1, 15, 'active', '2025-12-19 04:31:54', '2025-12-19 04:31:54'),
(14, 'Classic Pumps', 'classic-pumps', 2, 'heels', 4, 9800.00, 'Timeless pumps that elevate any outfit. Perfect for office and evening wear.', '[\"Synthetic leather\", \"3-inch heel\", \"Cushioned insole\"]', 4.70, 189, 'Best Seller', 'medium', 0, 1, 28, 'active', '2025-12-19 04:31:54', '2025-12-19 04:31:54'),
(15, 'Stiletto Heels', 'stiletto-heels', 2, 'heels', 4, 11500.00, 'Elegant stiletto heels for special occasions. Make a statement with every step.', '[\"Premium finish\", \"4-inch heel\", \"Elegant design\"]', 4.60, 142, NULL, 'high', 0, 1, 20, 'active', '2025-12-19 04:31:54', '2025-12-19 04:31:54'),
(16, 'Ballet Flats', 'ballet-flats', 2, 'flats', 4, 7500.00, 'Comfortable ballet flats for all-day wear. Stylish and practical.', '[\"Soft material\", \"Flexible sole\", \"Multiple colors\"]', 4.80, 256, 'Popular', 'flat', 0, 1, 35, 'active', '2025-12-19 04:31:54', '2025-12-19 04:31:54'),
(17, 'Casual Sandals', 'casual-sandals', 2, 'sandals', 5, 5800.00, 'Light and comfortable sandals perfect for summer days.', '[\"Comfortable straps\", \"Cushioned footbed\", \"Durable sole\"]', 4.50, 167, '', 'flat', 0, 1, 45, 'active', '2025-12-19 04:31:54', '2025-12-19 04:33:37'),
(18, 'Wedge Sandals', 'wedge-sandals', 2, 'wedges', 4, 8900.00, 'Stylish wedge sandals combining comfort and height.', '[\"Stable wedge heel\", \"Comfortable fit\", \"Elegant design\"]', 4.70, 198, '', 'medium', 1, 1, 25, 'active', '2025-12-19 04:31:54', '2025-12-19 04:34:04'),
(19, 'Ankle Boots', 'ankle-boots', 2, 'boots', 1, 13200.00, 'Trendy ankle boots perfect for any season. Versatile and fashionable.', '[\"Premium material\", \"Side zipper\", \"Comfortable fit\"]', 4.80, 215, 'New Arrival', 'low', 1, 1, 18, 'active', '2025-12-19 04:31:54', '2025-12-19 04:31:54'),
(20, 'School Shoes Black', 'school-shoes-black', 3, 'school', 7, 4500.00, 'Durable black school shoes designed for daily wear. Easy to clean and maintain.', '[\"Durable material\", \"Easy to clean\", \"Comfortable fit\"]', 4.60, 234, 'Best Seller', 'flat', 0, 1, 50, 'inactive', '2025-12-19 04:31:54', '2025-12-19 04:35:30'),
(21, 'Colorful Sneakers', 'colorful-sneakers', 3, 'sneakers', 6, 5200.00, 'Fun and colorful sneakers kids will love. Perfect for play and casual wear.', '[\"Vibrant colors\", \"Comfortable padding\", \"Durable construction\"]', 4.70, 189, 'Popular', 'flat', 0, 1, 40, 'inactive', '2025-12-19 04:31:54', '2025-12-19 04:36:35'),
(22, 'Sports Trainers', 'sports-trainers', 3, 'athletic', 6, 6800.00, 'Active sports shoes for energetic kids. Great support and durability.', '[\"Athletic support\", \"Breathable\", \"Non-slip sole\"]', 4.80, 156, '', 'flat', 0, 1, 30, 'active', '2025-12-19 04:31:54', '2025-12-19 04:35:19'),
(23, 'Velcro Sandals', 'velcro-sandals', 3, 'sandals', 6, 3800.00, 'Easy-to-wear sandals with velcro straps. Perfect for summer activities.', '[\"Easy velcro closure\", \"Comfortable footbed\", \"Durable straps\"]', 4.50, 167, '', 'flat', 0, 1, 55, 'active', '2025-12-19 04:31:54', '2025-12-19 04:36:03'),
(24, 'Character Shoes', 'character-shoes', 3, 'casual', 6, 4800.00, 'Fun shoes featuring popular characters. Kids love them!', '[\"Favorite characters\", \"Comfortable fit\", \"Fun designs\"]', 4.90, 312, 'Kids Favorite', 'flat', 1, 1, 45, 'inactive', '2025-12-19 04:31:54', '2025-12-19 04:35:07'),
(25, 'Rain Boots', 'rain-boots', 3, 'boots', 6, 5500.00, 'Waterproof rain boots to keep feet dry. Available in bright colors.', '[\"100% waterproof\", \"Easy to clean\", \"Bright colors\"]', 4.70, 198, '', 'flat', 0, 1, 35, 'active', '2025-12-19 04:31:54', '2025-12-19 04:35:03'),
(26, 'Women Sport Shoes', 'women-sport-shoes', 1, 'athletic ', 6, 12000.00, 'qweuiofx', '[\"sdfghj\",\"asdfghj\"]', 4.80, 0, 'New Arrival', 'flat', 1, 0, 50, 'active', '2025-12-19 05:25:27', '2025-12-19 05:25:27'),
(28, 'Classic Oxford Shoes 1233', 'classic-oxford-shoes-1233', 1, 'athletic ', 4, 12000.00, '', '', 4.00, 0, 'New Arrival', 'flat', 0, 0, 50, 'active', '2025-12-19 05:32:17', '2025-12-19 05:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `color_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_name` varchar(50) NOT NULL,
  `color_code` varchar(7) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`color_id`, `product_id`, `color_name`, `color_code`, `stock_quantity`) VALUES
(1, 1, 'Black', '#000000', 15),
(2, 1, 'Brown', '#8B4513', 10),
(9, 2, 'Blue', '#0000ff', 25),
(10, 2, 'White', '#ffffff', 25),
(11, 3, 'Black', '#000000', 7),
(12, 3, 'Red', '#ff0000', 8),
(13, 4, 'Blue', '#0000ff', 20),
(14, 4, 'Pink', '#ffc0cb', 20),
(17, 26, 'Black', '#000000', 25),
(18, 26, 'Blue', '#000000', 25),
(19, 28, 'Black', '#000000', 50);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `alt_text` varchar(200) DEFAULT NULL,
  `is_primary` tinyint(1) DEFAULT 0,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `image_url`, `alt_text`, `is_primary`, `display_order`, `created_at`) VALUES
(1, 1, 'assets/products/men/product-1.webp', 'Classic Oxford Dress Shoes', 1, 1, '2025-12-19 04:17:04'),
(5, 2, 'uploads/products/product_2_1766118123_0.jpg', 'Casual Canvas Sneakers - Image 1', 1, 0, '2025-12-19 04:22:03'),
(6, 3, 'uploads/products/product_3_1766118143_0.jpg', 'Elegant Heels - Image 1', 1, 0, '2025-12-19 04:22:23'),
(7, 4, 'uploads/products/product_4_1766118158_0.jpg', 'Kids Sports Shoes - Image 1', 1, 0, '2025-12-19 04:22:38'),
(8, 8, './assets/products/men/product-1.webp', 'Classic Oxford Shoes', 1, 1, '2025-12-19 04:31:54'),
(9, 9, './assets/products/men/product-2.jpg', 'Derby Dress Shoes', 1, 1, '2025-12-19 04:31:54'),
(10, 10, './assets/products/men/product-5.jpg', 'Leather Loafers', 1, 1, '2025-12-19 04:31:54'),
(11, 11, './assets/products/men/product-6.avif', 'Canvas Sneakers', 1, 1, '2025-12-19 04:31:54'),
(12, 12, './assets/products/men/product-3.jpg', 'Running Shoes', 1, 1, '2025-12-19 04:31:54'),
(13, 13, './assets/products/men/product-4.jpg', 'Hiking Boots', 1, 1, '2025-12-19 04:31:54'),
(14, 14, './assets/products/women/product-5.jpg', 'Classic Pumps', 1, 1, '2025-12-19 04:31:54'),
(15, 15, './assets/products/women/product-6.jpg', 'Stiletto Heels', 1, 1, '2025-12-19 04:31:54'),
(20, 20, './assets/products/kids/product-1.webp', 'School Shoes Black', 1, 1, '2025-12-19 04:31:54'),
(24, 24, './assets/products/kids/product-5.webp', 'Character Shoes', 1, 1, '2025-12-19 04:31:54'),
(26, 16, 'uploads/products/product_16_1766118792_0.jpg', 'Ballet Flats - Image 1', 1, 0, '2025-12-19 04:33:12'),
(27, 17, 'uploads/products/product_17_1766118817_0.jpg', 'Casual Sandals - Image 1', 1, 0, '2025-12-19 04:33:37'),
(28, 18, 'uploads/products/product_18_1766118844_0.jpg', 'Wedge Sandals - Image 1', 1, 0, '2025-12-19 04:34:04'),
(29, 19, 'uploads/products/product_19_1766118859_0.jpg', 'Ankle Boots - Image 1', 1, 0, '2025-12-19 04:34:19'),
(30, 25, 'uploads/products/product_25_1766118903_0.jpg', 'Rain Boots - Image 1', 1, 0, '2025-12-19 04:35:03'),
(31, 22, 'uploads/products/product_22_1766118919_0.jpg', 'Sports Trainers - Image 1', 1, 0, '2025-12-19 04:35:19'),
(32, 21, 'uploads/products/product_21_1766118951_0.jpg', 'Colorful Sneakers - Image 1', 1, 0, '2025-12-19 04:35:51'),
(33, 23, 'uploads/products/product_23_1766118963_0.webp', 'Velcro Sandals - Image 1', 1, 0, '2025-12-19 04:36:03'),
(35, 26, 'uploads/products/product_26_1766121951_0.jpg', 'Women Sport Shoes - Image 1', 1, 0, '2025-12-19 05:25:51'),
(36, 28, 'uploads/products/product_28_1766122337_0.jpg', 'Classic Oxford Shoes 1233 - Image 1', 1, 0, '2025-12-19 05:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `size_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `stock_quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`size_id`, `product_id`, `size`, `stock_quantity`) VALUES
(1, 1, '40', 10),
(2, 1, '41', 8),
(3, 1, '42', 7),
(13, 2, '39', 15),
(14, 2, '40', 20),
(15, 2, '41', 15),
(16, 3, '36', 5),
(17, 3, '37', 5),
(18, 3, '38', 5),
(19, 4, '30', 15),
(20, 4, '31', 15),
(21, 4, '32', 10),
(24, 26, '8', 25),
(25, 26, '9', 25),
(26, 28, '6', 50);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `promotion_id` int(11) NOT NULL,
  `promotion_name` varchar(200) NOT NULL,
  `promo_code` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `discount_type` enum('percentage','fixed') NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `usage_count` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `review_title` varchar(200) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `is_verified_purchase` tinyint(1) DEFAULT 0,
  `is_approved` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `user_type` enum('customer','admin') DEFAULT 'customer',
  `status` enum('active','inactive','suspended') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `first_name`, `last_name`, `phone`, `address`, `city`, `postal_code`, `user_type`, `status`, `created_at`, `updated_at`, `last_login`) VALUES
(1, 'admin', 'admin@citywalk.lk', '$2y$10$GpzAML4FOJA24xr.TUCQi.fQ1xnOa7Kjn1kpo8z2sb/FBmpoQNbP6', 'Admin', 'User', '+94771234567', NULL, NULL, NULL, 'admin', 'active', '2025-12-19 04:17:03', '2025-12-19 05:30:53', '2025-12-19 05:30:53'),
(2, 'aaz', 'aaz@gmail.com', '$2y$10$Kp0/2V3Vy0Qh2VShOTo4qeoAt3bR6voeoi7UWNpqKckP5n45Zjogq', 'AazDa', 'User', NULL, NULL, NULL, NULL, 'customer', 'active', '2025-12-19 04:23:50', '2025-12-19 05:29:19', '2025-12-19 05:29:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_action` (`action_type`),
  ADD KEY `idx_created` (`created_at`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`banner_id`),
  ADD KEY `idx_active` (`status`),
  ADD KEY `idx_order` (`display_order`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `brand_name` (`brand_name`),
  ADD KEY `idx_brand_name` (`brand_name`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_session` (`session_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_parent` (`parent_category`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_slug` (`slug`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`faq_id`),
  ADD KEY `idx_category` (`category`),
  ADD KEY `idx_order` (`display_order`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`subscriber_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_order_number` (`order_number`),
  ADD KEY `idx_status` (`order_status`),
  ADD KEY `idx_created` (`created_at`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `idx_order` (`order_id`),
  ADD KEY `idx_product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_category` (`category_id`),
  ADD KEY `idx_price` (`price`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_featured` (`is_featured`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`color_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `idx_product` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `idx_product` (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`size_id`),
  ADD UNIQUE KEY `unique_product_size` (`product_id`,`size`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `idx_product` (`product_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promotion_id`),
  ADD UNIQUE KEY `promo_code` (`promo_code`),
  ADD KEY `idx_dates` (`start_date`,`end_date`),
  ADD KEY `idx_active` (`status`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `idx_product` (`product_id`),
  ADD KEY `idx_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_user_type` (`user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `subscriber_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promotion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`) ON DELETE SET NULL;

--
-- Constraints for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_colors_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
