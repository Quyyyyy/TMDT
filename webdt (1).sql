-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 06:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdt`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'trả góp'),
(2, 'nổi bật'),
(3, 'giá rẻ'),
(12, 'đề xuất');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `fullname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject_name` varchar(350) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `fullname`, `email`, `phone_number`, `subject_name`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Trần Vũ Minh Quý', 'minhquy3107@gmail.com', '+84342939269', 'chu de 1', 'sản phẩm tốt', 2, '2023-04-01 21:39:47', '2023-03-31 20:04:10'),
(2, 'Đào Trọng Phúc', 'phucdt@gmail.com', '+84963991723', 'chủ đề 2', 'sản phẩm tệ', 1, '2023-04-01 00:43:28', '2023-04-01 00:43:28'),
(3, 'Nguyễn Thanh Hùng', 'hungnt@gmail.com', '0917565468', 'iphone 11', 'chưa nhận được giao hàng', 0, '2023-04-28 19:46:54', '2023-04-28 19:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `galery`
--

CREATE TABLE `galery` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `thumbnail` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `total_money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `email`, `phone_number`, `address`, `note`, `order_date`, `status`, `total_money`) VALUES
(1, 7, 'Bùi Anh Hào', 'haoba@gmail.com', '+84934235277', 'Cầu Giấy', 'mua 2 điện thoại', '2023-04-01 11:42:05', 2, 13320000),
(2, 8, 'Phạm Hải Đăng', 'phamdb@gmail.com', '+84355916018', 'Hà Đông', 'mua 1 điện thoại', '2023-04-01 12:23:01', 1, 7560000),
(3, 8, 'Phạm Đèn Biển', 'phamdb@gmail.com', '0916999666', 'Trần Phú, Hà Đông', 'tvsnkl;df', '2023-04-28 18:17:09', 0, 16000000);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `total_money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `num`, `total_money`) VALUES
(1, 2, 8, 7560000, 1, 7560000),
(2, 1, 1, 6000000, 1, 6000000),
(3, 1, 7, 7320000, 1, 7320000),
(4, 3, 1, 6000000, 1, 6000000),
(5, 3, 10, 5000000, 2, 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `thumbnail` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `symbol` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pin` int(10) DEFAULT NULL,
  `ram` int(10) DEFAULT NULL,
  `rom` int(10) DEFAULT NULL,
  `CPU` varchar(50) DEFAULT NULL,
  `KTmanHinh` varchar(30) DEFAULT NULL,
  `cameraTruoc` varchar(30) DEFAULT NULL,
  `cameraSau` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `title`, `price`, `discount`, `thumbnail`, `description`, `created_at`, `updated_at`, `deleted`, `symbol`, `pin`, `ram`, `rom`, `CPU`, `KTmanHinh`, `cameraTruoc`, `cameraSau`) VALUES
(1, 2, 'Huawei-mate-20-pro-green', 6800000, 6000000, 'assets/photoshuawei-mate-20-pro-green-600x600.jpg', 'hãng:Huawei, pin:4200,\r\nram:6,\r\nrom:128,\r\nCPU: Hisilicon Kirin 980,\r\nKT màn hình : 6.39\",\r\ncamera trước:24,\r\ncamera sau:48', '2023-03-30 01:25:24', '2023-04-19 18:23:28', 0, 'Huawei', 4200, 8, 128, 'Hisilicon Kirin 980', '6.39\'\'', '24', '48'),
(7, 12, 'Huawei-nova-3-2', 7500000, 7320000, 'assets/photoshuawei-nova-3-2-600x600.jpg', 'hãng: Huawei, pin = 3750, ram = 4, rom = 128, CPU = Hisilicon Kirin 980, KT màn hình: 6.3\'\', camera trước: 24, camera sau: 60', '2023-03-30 18:04:51', '2023-04-19 18:02:30', 0, 'Huawei', 3750, 4, 128, 'Hisilicon Kirin 980', '6.3\'\'', '24', '60'),
(8, 2, 'Huawei-y5-2017', 8000000, 7560000, 'assets/photoshuawei-y5-2017-300x300.jpg', '<p>Hãng: huawei, pin: 4000, ram: 4, rom:128, CPU: kirin 970, KT màn hình: 6.28\'\', camera trước : 24, camera sau: 60. </p>', '2023-03-31 04:09:37', '2023-04-19 18:32:56', 0, 'Huawei', 4000, 4, 128, 'kirin 970', '6.28\'\'', '24', '60'),
(9, 1, 'Ipad-wifi-32gb-2018-thumb', 25000000, 25000000, 'assets/photosipad-wifi-32gb-2018-thumb-600x600.jpg', '<p>hãng: Apple, pin: 6000, ram: 32, rom: 528, CPU: M1, Kích thước màn hình: 9.7\'\', camera trước: 32, camera sau: 128.</p>', '2023-04-02 19:11:13', '2023-04-19 18:19:57', 0, 'Apple', 6000, 32, 528, 'M1', '9.7\'\'', '32', '128'),
(10, 3, 'Iphone-7-plus-32gb', 5000000, 5000000, 'assets/photosiphone-7-plus-32gb-600x600.jpg', '<p>hãng: Apple, pin: 2800, ram: 4, rom: 32, CPU: A10, kích thước màn hình: 5.28\'\', camera trước: 24, camera sau:32 </p>', '2023-04-02 19:11:16', '2023-04-19 18:19:58', 0, 'Apple', 2800, 4, 32, 'A10', '5.28\'\'', '24', '32'),
(11, 1, 'Iphone-x-256gb-silver', 12000000, 12000000, 'assets/photosiphone-x-256gb-silver-400x400.jpg', 'hãng: Apple, pin: 2800, ram: 4, rom: 32, CPU: A10, kích thước màn hình: 6.3\'\', camera trước: 24, camera sau:64', '2023-04-02 19:14:19', '2023-04-19 18:24:59', 0, 'Apple', 2800, 4, 32, 'A10', '6.3\'\'', '24', '64'),
(12, 1, 'Mobiistar-b310-orange', 1200000, 1000000, 'assets/photosmobiistar-b310-orange-600x600.jpg', '<p>hãng: Mobistar , pin: 8000, ram: 1, rom: 16, CPU: Snapdragon 888+, kích thước màn hình: 3\'\', camera trước: 0, camera sau: 16 <br></p>', '2023-04-02 19:54:21', '2023-04-19 19:58:00', 0, 'Mobistar', 8000, 1, 16, 'Snapdragon 888+', '3\'\'', '0', '16'),
(13, 2, 'Mobiistar-e-selfie-300', 5400000, 5400000, 'assets/photosmobiistar-e-selfie-300-600x600.jpg', '<p>hãng: Mobistar , pin: 5000, ram: 4, rom: 32, CPU: Snapdragon 415, kích thước màn hình: 6\'\', camera trước: 12, camera sau: 64<br></p>', '2023-04-02 19:45:23', '2023-04-19 19:02:02', 0, 'Mobistar', 5000, 4, 32, 'Snapdragon 415', '6\'\'', '12', '64'),
(14, 3, 'Mobiistar-x-3', 4800000, 4800000, 'assets/photosmobiistar-x-3-600x600.jpg', '<p>hãng: Mobistar , pin: 3800, ram: 4, rom: 16, CPU: Snapdragon 515, kích thước màn hình: 6.2\'\', camera trước: 16, camera sau: 24<br></p>', '2023-04-02 19:36:26', '2023-04-19 19:08:04', 0, 'Mobistar', 3800, 4, 16, 'Snapdragon  515', '6.2\'\'', '16', '24'),
(15, 12, 'Mobiistar-zumbo-s2-dual', 8000000, 8000000, 'assets/photosmobiistar-zumbo-s2-dual-300x300.jpg', '<p>hãng: Mobistar , pin: 8000, ram: 4, rom: 128, CPU: Snapdragon 712, kích thước màn hình: 6.8\'\', camera trước: 24, camera sau: 6<br></p>', '2023-04-02 19:47:28', '2023-04-19 19:06:05', 0, 'Mobistar', 8000, 4, 128, 'Snapdragon 712', '6.8\'\'', '24', '60'),
(16, 2, 'Nokia-51-plus-black', 6500000, 6500000, 'assets/photosnokia-51-plus-black-400x400.jpg', '<p>hãng: Nokia , pin: 8000, ram: 4, rom: 128, CPU: Snapdragon 450, kích thước màn hình: 6.3\'\', camera trước: 24, camera sau: 64 <br></p>', '2023-04-02 19:52:30', '2023-04-19 19:51:05', 0, 'Nokia', 8000, 4, 128, 'Snapdragon 450', '6.3\'\'', '24', '64'),
(17, 3, 'Oppo-a3s-32gb', 5700000, 5700000, 'assets/photosoppo-a3s-32gb-600x600.jpg', '<p>hãng: Oppo, pin: 4500, ram: 4, rom: 32, CPU: A3, kích thước màn hình: 5.6\'\', camera trước: 24, camera sau: 48 <br></p>', '2023-04-02 19:06:33', '2023-04-19 19:42:06', 0, 'Oppo', 4500, 4, 32, 'A3', '5.6\'\'', '24', '48'),
(18, 12, 'Oppo-f9-red', 7800000, 7800000, 'assets/photosoppo-f9-red-600x600.jpg', '<p>hãng: Oppo, pin: 5800, ram: 4, rom: 16, CPU: Snapdragon 715, kích thước màn hình: 5.8\'\', camera trước: 24, camera sau: 48<br></p>', '2023-04-02 19:05:35', '2023-04-19 19:27:07', 0, 'Oppo', 5800, 4, 16, 'Snapdragon 715', '5.8\'\'', '24', '48'),
(19, 2, 'Samsung-galaxy-a8-plus', 11000000, 11000000, 'assets/photossamsung-galaxy-a8-plus-2018-gold-600x600.jpg', '<p>hãng: Samsung, pin: 4000, ram: 4, rom: 128, CPU: Kryo 465, kích thước màn hình: 5.8\'\', camera trước: 24, camera sau: 64 <br></p>', '2023-04-02 19:13:37', '2023-04-19 19:27:10', 0, 'Samsung', 4000, 4, 128, 'Kryo 465', '5.8\'\'', '24', '64'),
(20, 1, 'Samsung-galaxy-j4-plus-pink', 14000000, 14000000, 'assets/photossamsung-galaxy-j4-plus-pink-400x400.jpg', '<p>hãng: Samsung, pin: 4000, ram: 8, rom: 128, CPU: kryo 777, kích thước màn hình: 6.8\'\', camera trước: 24, camera sau: 64 <br></p>', '2023-04-02 19:27:39', '2023-04-19 19:27:11', 0, 'Samsung', 4000, 8, 128, 'kryo 777', '6.8\'\'', '24', '64'),
(21, 3, 'Xiaomi-mi-8-1', 4300000, 4300000, 'assets/photosxiaomi-mi-8-1-600x600.jpg', '<p>hãng: Xiaomi, pin: 4000, ram: 4, rom: 128, CPU: Snapdragon 712, kích thước màn hình: 5.9\'\', camera trước: 24, camera sau: 48<br></p>', '2023-04-02 19:20:42', '2023-04-19 19:29:12', 0, 'Xiaomi', 4000, 4, 128, 'Snapdragon 712', '5.9\'\'', '24', '48'),
(22, 2, 'Xiaomi-mi-8-lite-black-1', 5000000, 5000000, 'assets/photosxiaomi-mi-8-lite-black-1-600x600.jpg', '<p>hãng: Xiaomi, pin: 5000, ram: 4, rom: 32, CPU: Snapdragon 615, kích thước màn hình: 6\'\', camera trước: 24, camera sau: 48<br></p>', '2023-04-02 19:07:44', '2023-04-19 19:19:13', 0, 'Xiaomi', 5000, 4, 32, 'Snapdragon 615', '6\'\'', '24', '48'),
(23, 12, 'Xiaomi-redmi-5-plus', 6500000, 6500000, 'assets/photosxiaomi-redmi-5-plus-600x600.jpg', '<p>hãng: Xiaomi, pin: 5200, ram: 4, rom: 128, CPU: Snapdragon 888, kích thước màn hình: 6.3\'\', camera trước: 24, camera sau: 48 <br></p>', '2023-04-02 19:32:46', '2023-04-19 19:02:14', 0, 'Xiaomi', 5200, 4, 128, 'Snapdragon 888', '6.3\'\'', '24', '48'),
(24, 3, 'Xiaomi-redmi-note-5-pro', 4300000, 4300000, 'assets/photosxiaomi-redmi-note-5-pro-600x600.jpg', '<p>hãng: Xiaomi, pin: 4500, ram: 4, rom: 16, CPU: Kryo 412, kích thước màn hình: 5\'\', camera trước: 16, camera sau: 48 <br></p>', '2023-04-02 19:25:48', '2023-04-19 19:29:15', 0, 'Xiaomi', 4500, 4, 16, 'Kryo 412', '5\'\'', '16', '48'),
(25, 1, 'Oppo A77s 8GB-128GB', 6290000, 6290000, 'assets/photosoppo-a77s-den (2).jpg', '<p>hãng: Oppo, kích thước màn hình: 6.55\'\', ram: 8 gb,rom: 128gb CPU: snapdragon 680.</p>', '2023-04-15 11:19:42', '2023-04-19 19:29:16', 0, 'Oppo', 0, 8, 126, 'Snapdragon 680', '6.55\'', '', ''),
(26, 3, 'realme C30s 2GB-32GB', 1890000, 1890000, 'assets/photosrealme-c30s-xanh-5 (2).jpg', '', '2023-04-15 11:03:49', '2023-04-19 19:53:16', 0, 'Realme', 0, 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `star` int(10) DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `id_user`, `id_product`, `star`, `content`, `created_at`, `deleted`) VALUES
(1, 7, 1, 4, 'sản phẩm khá tốt', '2023-04-18 23:47:59', 0),
(2, 1, 1, 4, 'dùng được', '2023-04-20 23:05:57', 0),
(3, 8, 1, 5, 'tốt', '2023-04-20 23:06:55', 0),
(4, 10, 7, 2, 'sản phẩm dùng tạm được', '2023-04-20 23:07:51', 0),
(5, 11, 7, 3, 'sản phẩm dùng khá ổn', '2023-04-20 23:08:55', 0),
(6, 9, 7, 1, 'trải nghiệm rất tệ', '2023-04-20 23:11:10', 0),
(7, 8, 7, 1, 'dùng rất tệ', '2023-04-20 23:13:43', 0),
(8, 10, 8, 2, 'dùng bình thường', '2023-04-20 23:14:56', 0),
(9, 1, 8, 2, 'dùng tệ', '2023-04-20 23:17:32', 0),
(10, 7, 8, 2, 'dùng tệ', '2023-04-20 23:18:05', 0),
(11, 9, 9, 5, 'dùng tốt', '2023-04-20 23:19:17', 0),
(12, 7, 9, 4, 'dùng tốt', '2023-04-20 23:20:58', 0),
(13, 11, 9, 4, 'trải nghiệm tốt', '2023-04-20 23:21:25', 0),
(15, 7, 12, 1, 'sản phẩm quá tệ', '2023-04-21 12:40:57', 0),
(16, 7, 16, 3, 'sản phẩm dùng ổn', '2023-04-21 15:33:22', 0),
(17, 9, 26, 2, 'dùng rất chán', '2023-04-21 19:26:53', 0),
(18, 10, 26, 2, 'sản phẩm dùng tạm được', '2023-04-21 19:28:00', 0),
(19, 8, 26, 3, 'dùng được', '2023-04-21 19:29:04', 0),
(20, 8, 17, 4, 'dùng rất tốt', '2023-04-21 19:29:36', 0),
(21, 11, 11, 5, 'sản phẩm dùng rất tốt', '2023-04-21 19:30:30', 0),
(22, 9, 22, 5, 'sản phẩm tốt', '2023-04-23 17:33:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `user_id` int(11) NOT NULL,
  `token` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`user_id`, `token`, `created_at`) VALUES
(1, '053756e049d7540a36ede2d852040b8c', '2023-04-01 05:29:49'),
(1, '0c846adeb0196b6007e957f74a25e71e', '2023-04-07 05:18:24'),
(1, '17a91c0437a1308409046fc988e3d195', '2023-04-06 19:19:20'),
(1, '2082320944e769ba4fd9ba3f63ad1540', '2023-04-28 19:19:30'),
(1, '22461b3a0505b9e4a135ac25692bfc86', '2023-04-21 13:14:23'),
(1, '2931b391164e36ec8d883b17dd377190', '2023-03-28 14:55:08'),
(1, '2985a64c3dbc0d98815aec3f9b31f634', '2023-04-13 12:05:42'),
(1, '2f7cb5e99d820da73623141606bc2fc1', '2023-04-07 05:27:56'),
(1, '333aa78c43e559e431d7ea133ccb22d2', '2023-04-21 17:10:40'),
(1, '3733abd56d00b1082db9fb175ac93a54', '2023-04-07 04:35:22'),
(1, '37423402736d163e7ee599e90f1a694f', '2023-04-15 15:33:33'),
(1, '3890e88bfc3785bc4925cfe814a4b322', '2023-04-15 21:32:45'),
(1, '3a218dcc5588a3e83aaa18163e8b7533', '2023-04-19 11:32:45'),
(1, '3c3449a2a1b404fcb1b38d830630fc20', '2023-04-13 12:37:55'),
(1, '3c718ca693c4eaea58c007e54e238d07', '2023-04-07 06:25:32'),
(1, '3e72fcdd6656b9355a4cd9c4dbbde585', '2023-04-06 18:18:55'),
(1, '42ba0074dcdd7ff85726ab940d514e66', '2023-03-28 15:51:23'),
(1, '436a04a56ec4da0608d8e3758f4a312b', '2023-04-06 18:44:53'),
(1, '460cc27af08d579ec96e2584caac9d2f', '2023-04-06 18:25:42'),
(1, '4d8266fb443342a2ad8799909e85ac22', '2023-03-28 17:34:26'),
(1, '4f18e34010417ee99f7686d40bf9e5a1', '2023-04-07 05:11:47'),
(1, '4fbe05a3874f59742804f8cade968d1d', '2023-04-06 18:40:25'),
(1, '5131fb3721d58cc57f872c1f0d2007aa', '2023-04-28 19:15:47'),
(1, '52d8a0cbbb0b458996f285fc4e99f25f', '2023-04-06 18:30:16'),
(1, '5434c61a45c1f4e84b162d66672139ed', '2023-03-31 04:28:50'),
(1, '5502a0fd27c9a0ac5aa4e39c5564543f', '2023-04-06 16:56:13'),
(1, '5755c7a5d8bcfda6dbac08529f8f82c6', '2023-03-28 17:18:14'),
(1, '5ddbc5c3e2ef80c76f9c040ebd2cfa16', '2023-04-06 18:24:19'),
(1, '6d6704618c0569f9b439e7733451ac4c', '2023-03-28 17:03:27'),
(1, '71e25046b3a78ed846fbf07322500680', '2023-04-06 19:46:35'),
(1, '77ec8010a101072bc9dc161550244314', '2023-04-06 16:26:22'),
(1, '7cb288c7b76391c080cfb26bec715b72', '2023-04-01 17:13:00'),
(1, '803639da6fd7d46a92614a2c6e918f2e', '2023-04-15 11:21:34'),
(1, '83dc3e132c2e355a5c4edbe32d2c8b71', '2023-04-06 18:30:44'),
(1, '856f1dabf4bb9aae3352f86a4afaa21d', '2023-04-06 16:54:58'),
(1, '8c11356e70f8ada1a92a1c6c378d1160', '2023-04-07 06:34:35'),
(1, '8fa3f0397d827352e38d9d337e653be3', '2023-03-30 18:39:38'),
(1, '910ae027e228f1172d7d9564f880a596', '2023-04-06 18:45:26'),
(1, '951f0f2fafddeaf7a9ccf70426eca638', '2023-04-13 12:13:03'),
(1, '960b889f1e30096531f1bcc5c9b319c4', '2023-04-13 11:56:49'),
(1, '9a004ed67013f185afc06461af494217', '2023-04-28 19:47:23'),
(1, '9b9b69cf079d6135a00cacaeb053d16e', '2023-04-19 18:09:45'),
(1, 'a35a8ea23aa2c4ff75b8355fb1d72908', '2023-04-06 18:32:02'),
(1, 'a88e1c68af7ab45036a2bb8f01836693', '2023-04-14 07:27:28'),
(1, 'abdd259429a6587318bdd13adc7ae91b', '2023-04-06 18:41:43'),
(1, 'ad82375c7b4fc439583cee1c391c3b62', '2023-04-18 22:04:48'),
(1, 'ad91cc74cd479a0827a3b93a6ea111ba', '2023-04-13 12:48:20'),
(1, 'adf13893df27ece68be6e9f34736ab00', '2023-04-06 18:58:15'),
(1, 'b3c8f79a4aa68f09496a24e0c7605fbb', '2023-04-06 18:35:08'),
(1, 'b7cd0a8310d97fa80eccf835d150879e', '2023-04-13 12:43:48'),
(1, 'b968bcaba797ec603132226580f3a321', '2023-04-28 18:51:00'),
(1, 'c14a7cb49eccc4f5c793d1f570c2e642', '2023-03-29 18:48:46'),
(1, 'c6fbc114e2b04c5bf3176799b0b7a06e', '2023-04-13 12:40:27'),
(1, 'c72728d4aeb8f09989dd2c3e7c191cb2', '2023-04-06 16:56:42'),
(1, 'db8979332ea505597e9bad54fa28d802', '2023-04-15 15:29:37'),
(1, 'def6fc8c3d980c2ad8a3f23e7fdf9a5c', '2023-04-06 18:17:46'),
(1, 'e26d00ea2d6375223941d73c1ded0eb4', '2023-04-06 18:11:36'),
(1, 'eaa12f7934fcb465e338eff05039b484', '2023-04-06 18:26:29'),
(1, 'f8e4476ecb5bec7a8f698e76e681ba1e', '2023-04-14 07:53:53'),
(7, '0722d3117389956c0a19d032383bc32c', '2023-04-06 18:08:51'),
(7, '080397a7cd849fc962bbb3e788b8ff64', '2023-04-13 12:56:08'),
(7, '09741c4518529882d0d57e89e535ec5d', '2023-04-21 09:46:26'),
(7, '0b5b3305b1baaa443666361a119f2274', '2023-04-07 16:16:05'),
(7, '161c17c9a99770c2f34fae740a4d1b0e', '2023-04-06 19:46:54'),
(7, '1a5a3779bae4f0f5d9608fd431902aef', '2023-04-06 18:52:30'),
(7, '1b6a1da912f292819921af6cf9e2cf90', '2023-04-14 07:54:54'),
(7, '2487777260972a93902753086ec01216', '2023-04-21 10:58:38'),
(7, '2f3a51a62877e3448ac6cfa8f88362a8', '2023-04-06 16:59:29'),
(7, '4648c6aa255127ea1d9a2b6e4902de6a', '2023-04-20 17:45:34'),
(7, '4df68d92b1d55d63019baa24401fc12c', '2023-04-06 16:52:02'),
(7, '61aa712a0c034abbf22d5cf91f1ff943', '2023-04-06 16:36:06'),
(7, '62ab9b1bcbe3250a62d782f113f0e32d', '2023-04-06 16:54:12'),
(7, '62c90af10b8a8c946aaaabf6aae5cc4b', '2023-04-06 16:50:57'),
(7, '6b309b2c5da557fe7dbca4daba27a08b', '2023-04-07 06:32:51'),
(7, '6ba5ce6814d30440e72d933faf8dbaf5', '2023-04-06 16:35:03'),
(7, '7dbe09701e59850801db44d14deaaf69', '2023-04-06 18:04:42'),
(7, '82dfb75e7fa23f9c3fbc95823548fd27', '2023-04-06 18:00:40'),
(7, '86d25941225f5eb3d54c416d0b658748', '2023-04-07 04:35:55'),
(7, '8c88132569b6b49714ea6e1154e25fe5', '2023-04-06 16:53:06'),
(7, '9819e34fb08ea456dcdc4c26554f5e4a', '2023-04-07 05:17:04'),
(7, 'a317d87562cf17baa2872a436b7d4297', '2023-04-06 16:34:15'),
(7, 'a90ecb515a4cfaac448c61fec257373c', '2023-04-21 15:30:20'),
(7, 'a92d7b0978aa05ac9475a7d36829f791', '2023-04-06 19:18:51'),
(7, 'a966751efd8866ae1a717717d9b37671', '2023-04-14 18:04:01'),
(7, 'b7169c49f9cce698277e9a1e307a93b7', '2023-04-07 05:28:22'),
(7, 'bdd17d822323e0f2ca8c50ecf9582a67', '2023-04-06 17:12:38'),
(7, 'c9c7c148cc600b1ca5be749529ce7fc7', '2023-04-13 12:42:37'),
(7, 'ceb312772b7ca1a63b1c66405611bb61', '2023-04-21 12:23:32'),
(7, 'd1efc6f82f52d5ab95035c04f96e36d0', '2023-04-18 21:49:04'),
(7, 'd376cd511d6edcad00217fbef0c6cc6f', '2023-04-18 20:40:47'),
(7, 'd5e3ef79043cdad48fa11149dde9dcd2', '2023-04-06 16:42:44'),
(7, 'd6df712b0cb4121c5f3783ec09b11a8b', '2023-04-06 18:01:59'),
(7, 'dfe0b239d4d14c210a4acba4a874da60', '2023-04-21 12:25:15'),
(7, 'e6c17262ef3ba57e01da14d3190dca41', '2023-04-06 17:55:43'),
(7, 'f18de0db889dc4aeac457cbba6c02cb4', '2023-04-06 16:57:32'),
(7, 'f621412d5f2f646793f50a6f1bd7ef60', '2023-04-06 18:14:00'),
(7, 'f71ecef099a10094dda1690717862d1e', '2023-04-06 18:03:47'),
(8, '445d630e8bca164360057706ede9b000', '2023-04-28 10:08:54'),
(8, '6c4f83f82da9905165264af27f7c973f', '2023-04-21 19:28:46'),
(8, 'c518ef24bf6b4d842b7a15820abfaa2d', '2023-04-23 10:17:58'),
(9, '098fb7b9fa93994a53748fba9cc89b16', '2023-04-21 19:26:23'),
(9, 'a84bd8e3bddd345b09bce89b21943ed4', '2023-03-28 17:34:02'),
(9, 'd2df8335ea474991bba0fae761385cec', '2023-04-23 17:30:32'),
(10, '143602ea138f417bc85bdae373b78259', '2023-04-23 10:22:17'),
(10, '4568860e0de71a61c5c3210006bd6a45', '2023-04-23 09:51:39'),
(10, '524c65c1d6ac2e471a0dfc9f051e404a', '2023-04-23 16:40:24'),
(10, '52e963a31efdb6a32882c057e44e0da3', '2023-04-22 21:46:48'),
(10, '59f8e7cfabcae713b4c8cb4c766908af', '2023-04-22 21:03:17'),
(10, '60fb6b2673dc4c7cd4e1c1c27a38c57a', '2023-04-23 08:59:39'),
(10, '8689860123011457cbcfaf0a717d503e', '2023-04-23 09:53:02'),
(10, '9ae8c089523a14bebbc32722b028727e', '2023-04-23 09:55:18'),
(10, '9c55bca0fef93a300815086c35345ade', '2023-04-21 19:27:32'),
(10, '9f43e0a71e63d50bcf48ad1f212f51c7', '2023-04-27 18:36:18'),
(10, 'affe70de6ff9ef572cc6a03cc108e444', '2023-04-22 19:22:43'),
(10, 'd38d37b708c4c1590b3f3ddc75c16eaa', '2023-04-22 21:17:33'),
(10, 'de6a4246b7fab0fd791a8e2bf91f69d3', '2023-04-22 11:12:29'),
(10, 'f2b7224fbb027e598b2b676dc5209700', '2023-04-22 21:13:51'),
(10, 'f51f67eb771baef02eb7ad1a3387078c', '2023-04-23 06:59:32'),
(10, 'ff5db16070d9bdb28f1e085ca884bbbe', '2023-04-22 20:57:38'),
(11, '2657aedd34de91b87dda615c30969491', '2023-04-21 19:30:02'),
(11, 'a13fb3f683aa0340b0d7cd39ce398447', '2023-04-06 18:10:15'),
(11, 'f510f9ecc22ba9ac23acfb83613d29d3', '2023-04-29 04:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone_number`, `address`, `password`, `role_id`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Trần Vũ Minh Quý', 'minhquy3107@gmail.com', '+84342939269', 'Hà Đông', '0023bedab2f3b0f4900d77f0293140b7', 1, '2023-03-28 14:53:50', '2023-03-28 15:01:07', 0),
(7, 'Bùi Anh Hào', 'haoba@gmail.com', '+84934235277', 'Cầu Giấy', '9689a06ebb5851c589c6399f45f83a96', 2, '2023-03-28 14:58:57', '2023-03-28 15:02:49', 0),
(8, 'Phạm Hải Đăng', 'phamdb@gmail.com', '+84355916018', 'Hà Đông', 'dcdcf7ef48f7d6c29b55a97789d5a747', 2, '2023-03-28 15:00:43', '2023-04-06 18:46:09', 0),
(9, 'Đào Trọng Phúc', 'phucdt@gmail.com', '+84963991723', 'Hà Đông', '780da22671e4c8eca1fee5e5bcb41880', 2, '2023-03-28 15:02:27', '2023-03-28 15:02:27', 0),
(10, 'Phạm Thành An', 'anpham@gmail.com', '+84359603526', 'Hà Đông', '9689a06ebb5851c589c6399f45f83a96', 2, '2023-03-28 18:51:06', '2023-04-01 20:09:47', 0),
(11, 'Trần Thị Hoài Thu', 'hoaithu2406@gmail.com', '+84917363465', 'Cổ Bản, Đồng Mai, Hà Đông, Hà Nội', 'fc44ca359d0381c4cf75ac21bb53724e', 2, '2023-04-06 18:09:51', '2023-04-07 06:27:14', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`user_id`,`token`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galery`
--
ALTER TABLE `galery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galery`
--
ALTER TABLE `galery`
  ADD CONSTRAINT `galery_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
