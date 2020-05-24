-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2020 at 08:46 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `is_default` char(1) DEFAULT 'N',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `is_default`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sizes', 'N', '2020-05-03 02:29:25', '2020-05-20 21:34:41', NULL),
(2, 'Color', 'N', '2020-05-03 03:28:16', '2020-05-03 03:28:16', NULL),
(3, 'Test', 'N', '2020-05-09 11:41:55', '2020-05-09 11:44:24', '2020-05-09 11:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) NOT NULL,
  `attribute_id` bigint(20) DEFAULT NULL,
  `attribute_value` varchar(50) DEFAULT NULL,
  `attribute_image` varchar(191) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `attribute_value`, `attribute_image`, `updated_at`) VALUES
(1, 1, 'Medium', 'gdfgd', '2020-05-20 21:35:05'),
(2, 1, 'Large', NULL, '2020-05-20 21:35:24'),
(5, 2, 'Pink', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) NOT NULL,
  `brand_name` varchar(150) DEFAULT NULL,
  `brand_slug` varchar(150) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_slug`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test123', 'test123', NULL, '2020-04-28 11:10:31', '2020-04-28 11:18:13', '2020-04-28 11:18:13'),
(2, 'test1234', 'test', NULL, '2020-04-28 11:26:47', '2020-05-03 01:54:50', NULL),
(3, 'nike', 'nike', NULL, '2020-05-03 03:47:06', '2020-05-03 03:47:06', NULL),
(4, 'nike 3', 'nike-3', NULL, '2020-05-03 03:50:47', '2020-05-03 03:50:47', NULL),
(5, 'dsds', 'dsds', NULL, '2020-05-03 03:51:01', '2020-05-03 03:51:01', NULL),
(6, 'dsds dsdsds', 'dsds-dsdsds', NULL, '2020-05-03 03:51:23', '2020-05-03 03:51:23', NULL),
(7, 'fdfdfdfd dsdsds', 'fdfdfdfd-dsdsds', NULL, '2020-05-03 03:52:26', '2020-05-03 03:52:26', NULL),
(8, 'ww22', 'ww22', NULL, '2020-05-03 03:53:20', '2020-05-03 03:53:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `category_slug` varchar(150) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `image`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'men', 'men', NULL, NULL, '2020-04-26 09:37:01', '2020-04-28 11:16:31', NULL),
(2, 'women', 'women', NULL, NULL, '2020-04-26 05:05:42', '2020-04-26 05:05:42', NULL),
(3, 'test', 'test', '9I6B73821588426491.JPG', NULL, '2020-04-30 10:51:57', '2020-05-07 11:34:47', '2020-05-07 11:34:47'),
(4, 'footware', 'footware', NULL, 2, '2020-05-09 10:37:28', '2020-05-09 10:37:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `subject` varchar(120) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Breezy Deals', 'admin@mail.com', 'test', 'sdfsdf', '2020-05-17 05:51:57', '2020-05-17 05:51:57', NULL),
(2, 'Breezy Deals', 'admin@mail.com', 'test', 'sdfsdf', '2020-05-17 05:52:19', '2020-05-17 05:52:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `order_no` varchar(20) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `address_id` int(20) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'P',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_no`, `total_amount`, `address_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'ORD_000001', '10.00', 1, 'P', '2020-05-24 00:02:20', '2020-05-24 08:45:30', NULL),
(2, 3, 'ORD_000002', '2.00', 1, 'P', '2020-05-24 00:33:12', '2020-05-24 00:33:12', NULL),
(3, 3, 'ORD_000003', '5.00', 1, 'P', '2020-05-24 00:37:25', '2020-05-24 08:45:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `product_price` varchar(20) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `attributes` varchar(2000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_id`, `order_id`, `product_price`, `quantity`, `total_price`, `attributes`) VALUES
(1, 3, 1, '2', '1.00', '2.00', 'a:2:{i:0;a:3:{s:14:\"attribute_name\";s:5:\"Sizes\";s:15:\"attribute_value\";s:6:\"Medium\";s:15:\"attribute_price\";s:4:\"5.00\";}i:1;a:3:{s:14:\"attribute_name\";s:5:\"Color\";s:15:\"attribute_value\";s:4:\"Pink\";s:15:\"attribute_price\";s:4:\"6.00\";}}'),
(2, 3, 1, '2', '1.00', '2.00', 'a:1:{i:0;a:3:{s:14:\"attribute_name\";s:5:\"Sizes\";s:15:\"attribute_value\";s:5:\"Large\";s:15:\"attribute_price\";s:4:\"3.00\";}}'),
(3, 2, 1, '6', '1.00', '6.00', 'a:1:{i:0;a:3:{s:14:\"attribute_name\";s:5:\"Color\";s:15:\"attribute_value\";s:4:\"Pink\";s:15:\"attribute_price\";s:4:\"5.00\";}}'),
(4, 3, 2, '2', '1.00', '2.00', NULL),
(5, 1, 3, '5', '1.00', '5.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_slug` varchar(150) NOT NULL,
  `product_description` text,
  `product_price` decimal(10,2) DEFAULT NULL,
  `brand_id` int(20) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_slug`, `product_description`, `product_price`, `brand_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Simple test Product', 'simple-test-product', 'Product Test description', '5.00', 3, 100, '2020-05-18 20:18:12', '2020-05-18 20:18:12', NULL),
(2, 'Another product', 'another-product', 'product description', '6.00', 3, 100, '2020-05-19 00:38:08', '2020-05-19 00:38:08', NULL),
(3, 'third product udated', 'third-product-udated', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '3.00', 3, 200, '2020-05-20 21:36:58', '2020-05-24 12:59:38', NULL),
(4, 'my latest product', 'my-latest-product', 'product description', '500.00', 3, 100, '2020-05-24 10:42:42', '2020-05-24 10:42:42', NULL),
(5, 'fdfdf', 'fdfdf', 'fdfjlj', '33.00', 3, 33, '2020-05-24 10:46:58', '2020-05-24 10:46:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attachments`
--

CREATE TABLE `product_attachments` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_attachments`
--

INSERT INTO `product_attachments` (`id`, `product_id`, `file_path`) VALUES
(1, 1, 'http://localhost/ecommerce/public/storage/files/1/product.jpg'),
(2, 2, 'http://localhost/ecommerce/public/storage/files/1/K46ULlrLtb.jpg'),
(4, 5, 'http://localhost/ecommerce/public/storage/files/1/K46ULlrLtb.jpg'),
(5, 5, 'http://localhost/ecommerce/public/storage/files/1/product.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `attribute_value_id` bigint(20) DEFAULT NULL,
  `quantity` bigint(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_value_id`, `quantity`, `price`) VALUES
(1, 2, 5, 0, '5.00'),
(13, 3, 2, 0, '3.00'),
(14, 3, 5, 0, '6.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_attribute_view`
-- (See below for the actual view)
--
CREATE TABLE `product_attribute_view` (
`id` bigint(20)
,`product_name` varchar(150)
,`product_slug` varchar(150)
,`product_description` text
,`product_price` decimal(10,2)
,`quantity` bigint(20)
,`created_at` timestamp
,`updated_at` timestamp
,`deleted_at` timestamp
,`attribute_name` varchar(191)
,`attribute_id` bigint(20)
,`attribute_value` varchar(50)
,`attribute_price` decimal(10,2)
,`attribute_value_id` bigint(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `product_id` bigint(20) DEFAULT NULL,
  `brand_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `product_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`product_id`, `category_id`) VALUES
(2, 1),
(3, 1),
(5, 1),
(1, 2),
(2, 4),
(3, 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_categories_view`
-- (See below for the actual view)
--
CREATE TABLE `product_categories_view` (
`product_id` bigint(20)
,`category_id` bigint(20)
,`category_name` varchar(150)
);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_id` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `amount`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 1, '10.00', '7T548660081470636', '2020-05-24 00:02:20', '2020-05-24 00:02:20'),
(2, 2, '2.00', '7YA58319MU123645X', '2020-05-24 00:33:12', '2020-05-24 00:33:12'),
(3, 3, '5.00', '0AK85813205904903', '2020-05-24 00:37:25', '2020-05-24 00:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  `type` char(5) DEFAULT 'CUS' COMMENT 'cus => customer, ADM => Admin',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `mobile`, `timezone`, `type`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mail.com', '$2y$10$QDPS0Son.IQsvwyzQWAxgenDtzEPf71oC4S9W50c64WUMW/1YkKEW', NULL, NULL, NULL, 'ADM', '2020-04-26 03:07:24', '2020-04-26 03:07:24'),
(2, 'inderjit', 'inderjit@mail.com', '$2y$10$R1lGIK/srPng4rSB8PVVievV2dsyn.3vG9lJ4WiC/wguTYw3xuszi', NULL, NULL, NULL, 'CUS', '2020-05-23 07:32:57', '2020-05-23 07:32:57'),
(3, 'Customer 1', 'customer1@mail.com', '$2y$10$m4Se4mTiNcg7igo/WOZ37ez0b7vy6MlU8XUQ9ooZKgkFSu7Fgbf8S', NULL, '9856325478', NULL, 'CUS', '2020-05-23 19:47:56', '2020-05-23 19:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `land_mark` varchar(50) DEFAULT NULL,
  `is_default` char(1) DEFAULT 'N',
  `address_type` char(5) DEFAULT 'H' COMMENT 'H => Home , O => Office'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `name`, `user_id`, `city`, `state`, `country`, `pincode`, `address`, `land_mark`, `is_default`, `address_type`) VALUES
(1, 'Home Address', 3, 'Jalandhar', 'Punjab', 'India', '144001', 'vpo hazara distt jalandhar', NULL, 'N', 'H'),
(2, 'Office address', 3, 'jalandhar', 'punjab', 'India', '144001', 'Cool road near Nimbus', 'Near State Bank of India', 'N', 'H');

-- --------------------------------------------------------

--
-- Structure for view `product_attribute_view`
--
DROP TABLE IF EXISTS `product_attribute_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_attribute_view`  AS  select `p`.`id` AS `id`,`p`.`product_name` AS `product_name`,`p`.`product_slug` AS `product_slug`,`p`.`product_description` AS `product_description`,`p`.`product_price` AS `product_price`,`p`.`quantity` AS `quantity`,`p`.`created_at` AS `created_at`,`p`.`updated_at` AS `updated_at`,`p`.`deleted_at` AS `deleted_at`,`a`.`name` AS `attribute_name`,`a`.`id` AS `attribute_id`,`av`.`attribute_value` AS `attribute_value`,`pa`.`price` AS `attribute_price`,`pa`.`attribute_value_id` AS `attribute_value_id` from (((`products` `p` join `product_attributes` `pa` on((`p`.`id` = `pa`.`product_id`))) join `attribute_values` `av` on((`pa`.`attribute_value_id` = `av`.`id`))) join `attributes` `a` on((`av`.`attribute_id` = `a`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `product_categories_view`
--
DROP TABLE IF EXISTS `product_categories_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_categories_view`  AS  select `pc`.`product_id` AS `product_id`,`pc`.`category_id` AS `category_id`,`c`.`category_name` AS `category_name` from (`product_categories` `pc` join `categories` `c` on((`pc`.`category_id` = `c`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_brand_slug` (`brand_slug`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_category_slug` (`category_slug`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_product_slug` (`product_slug`);

--
-- Indexes for table `product_attachments`
--
ALTER TABLE `product_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`attribute_value_id`),
  ADD KEY `attribute_value_id` (`attribute_value_id`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD UNIQUE KEY `uk_productid_brandid` (`brand_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD UNIQUE KEY `uk_productid_categoryid` (`category_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_email` (`email`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_attachments`
--
ALTER TABLE `product_attachments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
