-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 11:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furniture`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_referrals`
--

CREATE TABLE `customer_referrals` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `referred_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finished_planks`
--

CREATE TABLE `finished_planks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finished_planks`
--

INSERT INTO `finished_planks` (`id`, `name`, `description`, `image`, `price`) VALUES
(4, 'akila', 'hgfds', 'https://obaidibrahimbm.com/wp-content/uploads/2024/06/New-Project-28.jpg', 1350.00),
(6, 'sdfs', 'lkkdgffggggvggv', 'https://plywooders.com/wp-content/uploads/2024/03/6359641338337500001629250.jpg', 67.00),
(7, 'xzx', 'xxczdsd', 'https://media.istockphoto.com/id/984342712/photo/color-paint-cans.jpg?s=612x612&w=0&k=20&c=4QWjtMKMohJp3Htz4olUvogja8ezC3vN140vsBJZRY0=', 1223.00);

-- --------------------------------------------------------

--
-- Table structure for table `furniture`
--

CREATE TABLE `furniture` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furniture`
--

INSERT INTO `furniture` (`id`, `name`, `description`, `price`, `stock`, `image_url`) VALUES
(1, 'sofa', 'The luscious Belevedere Hall Suite is the perfect place for a relaxed conversation with your friends and family. This elegant hall suite creates a warm and cozy ambiance and will perfectly fill up your living space with a touch of contemporary glamour.', 8998.00, 544, 'Assets/1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `furnitures`
--

CREATE TABLE `furnitures` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `furniture_orders`
--

CREATE TABLE `furniture_orders` (
  `id` int(11) NOT NULL,
  `furniture_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furniture_orders`
--

INSERT INTO `furniture_orders` (`id`, `furniture_id`, `customer_name`, `contact_number`, `email`, `address`, `postal_code`, `order_date`, `user_id`) VALUES
(1, 1, 'dilaksha Lakshan', '0774730315', 'dilakshalakshan2001@gmail.com', '161/c , pasala asala panugalgoda , dikkumbura', '10115', '2024-09-11 16:06:48', NULL),
(2, 1, 'dilaksha Lakshan', '0774730315', 'dilakshalakshan2001@gmail.com', 'sdhfsj', '10115', '2024-09-11 16:24:44', NULL),
(3, 1, 'dilaksha Lakshan', '0774730315', 'dilakshalakshan2001@gmail.com', 'jhghjh', '10115', '2024-09-11 17:25:20', NULL),
(4, 1, 'dilaksha Lakshan', '0774730315', 'dilakshalakshan2001@gmail.com', 'jhghjh', '10115', '2024-09-11 17:26:11', NULL),
(5, 1, 'dilaksha Lakshan', '0774730315', 'dilakshalakshan2001@gmail.com', '6578', '10115', '2024-09-11 17:28:46', NULL),
(6, 1, 'akila', '123456', 'akilahub@gmail.com', 'asc', '5100', '2024-09-12 02:08:45', NULL),
(7, 1, 'Vimukthi shehan', '123456', 'jayasooriyashehan4@gmail.com', 'polonnaruwa', '5100', '2024-10-21 18:33:18', 16),
(8, 1, 'Vimukthi', '123456', 'akilahub@gmail.com', 'polonnaruwa', '5100', '2024-10-21 20:58:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `furniture_reviews`
--

CREATE TABLE `furniture_reviews` (
  `id` int(11) NOT NULL,
  `furniture_id` int(11) NOT NULL,
  `reviewer_name` varchar(255) NOT NULL,
  `review_text` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furniture_reviews`
--

INSERT INTO `furniture_reviews` (`id`, `furniture_id`, `reviewer_name`, `review_text`, `rating`, `created_at`) VALUES
(1, 1, 'dilaksha Lakshan', 'nice', 3, '2024-09-11 16:13:06'),
(3, 1, 'dilaksha Lakshan', 'nice', 4, '2024-09-11 16:24:58'),
(5, 1, 'dilaksha Lakshan', 'klk', 2, '2024-09-11 17:28:55'),
(7, 1, 'akila', 'sdvgfg', 3, '2024-09-12 02:09:48'),
(8, 1, 'akila', 'uuuu', 4, '2024-10-10 17:11:32'),
(9, 1, 'ghfhgh', 'fgdggg', 5, '2024-10-13 15:30:47');

-- --------------------------------------------------------

--
-- Table structure for table `material_categories`
--

CREATE TABLE `material_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material_categories`
--

INSERT INTO `material_categories` (`id`, `name`, `description`) VALUES
(1, 'Hardwood Lumber', 'High-quality hardwood for furniture and cabinetry'),
(2, 'Softwood Lumber', 'Versatile softwood for construction and general woodworking'),
(3, 'Plywood', 'Engineered wood panels for various applications'),
(4, 'MDF (Medium Density Fiberboard)', 'Composite wood product for interior use'),
(5, 'Particle Board', 'Engineered wood product made from wood chips and resin'),
(6, 'Veneer', 'Thin decorative wood sheets for surface finishing'),
(7, 'Reclaimed Wood', 'Salvaged wood with unique character for eco-friendly projects'),
(8, 'Exotic Wood', 'Rare and distinctive wood species for specialty projects'),
(9, 'Bamboo', 'Sustainable and durable material for flooring and decorative elements'),
(10, 'Cedar', 'Aromatic wood ideal for outdoor projects and closet lining');

-- --------------------------------------------------------

--
-- Table structure for table `material_requests`
--

CREATE TABLE `material_requests` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` enum('pending','processing','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `furniture_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paint_items`
--

CREATE TABLE `paint_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paint_items`
--

INSERT INTO `paint_items` (`id`, `name`, `image`) VALUES
(2, 'kjhk', 'https://media.istockphoto.com/id/984342712/photo/color-paint-cans.jpg?s=612x612&w=0&k=20&c=4QWjtMKMohJp3Htz4olUvogja8ezC3vN140vsBJZRY0='),
(3, 'dafa', 'https://plywooders.com/wp-content/uploads/2024/03/6359641338337500001629250.jpg'),
(5, 'akila', 'https://media.istockphoto.com/id/1385618550/photo/paint-cans-and-paint-brushes-and-how-to-choose-the-perfect-interior-paint-color-and-good-for.jpg?s=612x612&w=0&k=20&c=CEW3tlWaVX61SR8pr7TUX2ac3VvzhbF2Ee_YsMp3joM=');

-- --------------------------------------------------------

--
-- Table structure for table `paint_orders`
--

CREATE TABLE `paint_orders` (
  `id` int(11) NOT NULL,
  `paint_color` varchar(255) NOT NULL,
  `letters` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `paint_name` varchar(255) NOT NULL,
  `paint_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paint_orders`
--

INSERT INTO `paint_orders` (`id`, `paint_color`, `letters`, `quantity`, `address`, `name`, `contact`, `paint_name`, `paint_id`, `created_at`, `user_id`) VALUES
(1, 'color1', 10, 12, 'adsda', 'st', '212112', 'Paint 2', 2, '2024-09-11 03:42:24', NULL),
(2, 'color2', 10, 2, 'adsda', 'aluth', '222222', 'Paint 3', 3, '2024-09-11 03:44:37', NULL),
(3, 'color2', 10, 11, 'adsda', 'test', '12345678', 'Paint 5', 5, '2024-09-11 03:45:54', NULL),
(4, 'color2', 15, 5, 'adsda', 'yfffv', '65685865', 'Paint 2', 2, '2024-09-11 03:55:54', NULL),
(5, 'color1', 10, 12, 'ADAGHBZ', 'sdfs', '999999999', 'Paint 5', 5, '2024-09-12 00:53:10', NULL),
(6, 'color2', 15, 4, 'ADAGHBZ', 'jhgh', '999999999', 'Paint 1', 1, '2024-09-12 02:14:35', NULL),
(7, 'color1', 10, 2, 'qqss', 'susantha', '1123232', 'Medifresh Paint', 1, '2024-09-12 22:10:58', NULL),
(8, 'color1', 15, 12, 'sasdxasd', 'ss vv ', '12122232', 'Medifresh Paint', 1, '2024-09-12 22:12:48', NULL),
(9, 'color1', 10, 12, 'sdjdncdn', 'szcakilahub@gmail.com', '999999999', 'Medifresh Paint', 1, '2024-09-12 22:19:35', NULL),
(10, 'color2', 10, 22, 'dsddsd', 'scsdasd', '12321321', 'Medifresh Paint', 1, '2024-09-12 22:22:20', NULL),
(11, 'color2', 15, 7, 'qqss', 'akila', '999999999', 'Weatherbond Advance', 2, '2024-09-12 22:41:39', NULL),
(12, 'color1', 10, 12, 'sssss', 'dilshan', '22132333', 'Medifresh Paint', 1, '2024-09-13 06:12:21', NULL),
(13, 'color1', 15, 1, 'ADAGHBZ', 'akila', '999999999', 'Weatherbond Advance', 2, '2024-09-14 15:05:33', NULL),
(14, 'color1', 10, 2, 'colombo', 'Akila', '22132333', 'Weatherbond Advance', 2, '2024-10-21 19:08:51', NULL),
(18, 'White', 10, 3, 'sasdxasd', 'vimukthi', '12122232', 'Weatherbond Advance', 2, '2024-10-21 20:54:48', 16);

-- --------------------------------------------------------

--
-- Table structure for table `planks`
--

CREATE TABLE `planks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planks`
--

INSERT INTO `planks` (`id`, `name`, `description`, `price`, `image`, `created_at`) VALUES
(1, 'akila', 'aadasfA', 123.00, 'Brown and Orange Modern Spicy Chicken Wings Poster.png', '2024-10-10 18:51:05'),
(2, 'adfsa', 'dFAGS', 111.00, 'pikaso_edit_Candid-image-photography-natural-textures-highly-r__2_-removebg-preview.png', '2024-10-10 18:52:03'),
(3, 'adfsa', 'dFAGS', 111.00, 'pikaso_edit_Candid-image-photography-natural-textures-highly-r__2_-removebg-preview.png', '2024-10-10 18:57:31'),
(4, 'adfsa', 'dFAGS', 111.00, 'pikaso_edit_Candid-image-photography-natural-textures-highly-r__2_-removebg-preview.png', '2024-10-10 18:57:34'),
(5, 'akila', 'dfsg', 12.00, 'WhatsApp Image 2024-10-09 at 20.45.32_9e9da3c0.jpg', '2024-10-10 18:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `plank_purchases`
--

CREATE TABLE `plank_purchases` (
  `id` int(11) NOT NULL,
  `plank_name` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `address` text NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plank_purchases`
--

INSERT INTO `plank_purchases` (`id`, `plank_name`, `customer_name`, `email`, `phone`, `quantity`, `address`, `purchase_date`, `user_id`) VALUES
(1, 'Oak Plank', 'dilaksha Lakshan', 'dilakshalakshan2001@gmail.com', '0774730315', 5, '465468', '2024-09-11 18:25:30', NULL),
(2, 'Oak Plank', 'dilaksha Lakshan', 'dilakshalakshan2001@gmail.com', '0774730315', 5, 'iusadyuga', '2024-09-11 18:30:18', NULL),
(3, 'Oak Plank', 'jhgh', 'jayasooriyashehan4@gmail.com', 'mishel@2002', 5, 'gtuertuhei', '2024-09-12 00:45:47', NULL),
(4, 'Oak Plank', 'sdfs', 'rathne@222', '11111111', 2, 'scdasf', '2024-09-12 02:13:11', NULL),
(5, 'Oriented Strand Board', 'nnn', 'sfddgg@2001', '555555', 3, 'dtdtrjsreaer', '2024-09-12 19:20:33', NULL),
(6, 'Plywood', 'sdfs', 'sfddgg@2001', '0898989', 3, 'tytuy', '2024-09-12 19:21:05', NULL),
(7, 'Lumber (Dimensional Lumber)', 'sdfs', 'jayasooriyashehan4@gmail.com', '11111111', 77, 'ghghg', '2024-09-12 20:02:47', NULL),
(8, 'Lumber (Dimensional Lumber) Rs.2000', 'jhgh', 'sfddgg@2001', '0898989', 3, 'fdfdh', '2024-09-12 23:24:59', NULL),
(9, 'Lumber (Dimensional Lumber) Rs.2000', 'mngh', 'mngh@gmail.com', '0786543212', 3, 'ngmbo', '2024-09-13 05:31:17', NULL),
(10, 'Plywood Rs.1200', 'v', 'sfddgg@2001', '0898989', 1, 'polonnruwa', '2024-09-13 05:51:24', NULL),
(11, 'Lumber (Dimensional Lumber) Rs.2000', 'mnjb', 'mnjb@gmail.com', '11111111', 2, 'nbg', '2024-09-13 06:09:19', NULL),
(12, 'Engineered Wood Rs.2400', 'akila', 'jayasooriyashehan4@gmail.com', '0786543212', 5, 'fhgfhfhghg', '2024-10-10 17:08:08', 16),
(13, 'Plywood Rs.1200', 'supun ponnayekd', 'akilahub@gmail.com', '11111111', 12, 'malbe', '2024-10-21 18:56:08', 16),
(14, 'Plywood Rs.1200', 'akila', 'jayasooriyashehan4@gmail.com', '0898989', 12, 'aaaa', '2024-10-21 20:45:16', 16),
(15, 'Plywood Rs.1200', 'akila', 'jayasooriyashehan4@gmail.com', '0898989', 12, 'aaaa', '2024-10-21 20:48:42', 16);

-- --------------------------------------------------------

--
-- Table structure for table `plank_rentals`
--

CREATE TABLE `plank_rentals` (
  `id` int(11) NOT NULL,
  `plank_name` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `duration` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plank_rentals`
--

INSERT INTO `plank_rentals` (`id`, `plank_name`, `customer_name`, `email`, `phone`, `duration`, `request_date`) VALUES
(1, 'Oak Plank', 'dilaksha Lakshan', 'dilakshalakshan2001@gmail.com', '0774730315', 5, '2024-09-11 18:07:39'),
(2, 'Oak Plank', 'hghh', 'dilakshalakshan200123@gmail.com', '0787867991', 5, '2024-09-11 18:26:58'),
(3, 'Oak Plank', 'dilaksha Lakshan', 'dilakshalakshan200123@gmail.com', '0787867991', 5, '2024-09-11 18:29:59'),
(4, 'Oak Plank', 'sdfs', 'yugui@gmail.com', 'hihiu', 4, '2024-09-12 00:46:18'),
(5, 'Oak Plank', 'akila', 'rathne@222', '123456', 2, '2024-09-12 02:12:43'),
(6, 'Oak Plank', 'jhgh', 'sfddgg@2001', '0898989', 66, '2024-09-12 18:42:10'),
(7, 'Lumber (Dimensional Lumber)', 'mngh', 'mngh@gmail.com', '0786543212', 23, '2024-09-13 05:32:15'),
(8, 'Lumber (Dimensional Lumber)', 'mngh', 'mngh@gmail.com', '0786543212', 23, '2024-09-13 05:42:24'),
(9, 'Lumber (Dimensional Lumber)', 'mnjb', 'mnjb@gmail.com', '11111111', 2, '2024-09-13 06:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `furniture_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roof_items`
--

CREATE TABLE `roof_items` (
  `id` int(11) NOT NULL,
  `measurement` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roof_items`
--

INSERT INTO `roof_items` (`id`, `measurement`, `price`) VALUES
(1, '2x2 - 05 meters', 50.00),
(2, '2x2 - 10 meters', 90.00),
(3, '2x4 - 5 meters', 75.00),
(4, '2x4 - 10 meters', 135.00),
(5, '2x6 - 5 meters', 100.00),
(6, '2x6 - 10 meters', 180.00),
(7, '3x5 - 5 meters', 125.00),
(8, '3x5 - 10 meters', 225.00),
(9, '3x6 - 5 meters', 150.00),
(10, '3x6 - 10 meters', 270.00);

-- --------------------------------------------------------

--
-- Table structure for table `roof_orders`
--

CREATE TABLE `roof_orders` (
  `id` int(11) NOT NULL,
  `wood_type` varchar(50) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roof_orders`
--

INSERT INTO `roof_orders` (`id`, `wood_type`, `customer_name`, `email`, `contact_number`, `address`, `total_price`, `created_at`, `user_id`) VALUES
(1, 'sahdfk', 'dilaksha Lakshan', 'dilakshalakshan2001@gmail.com', '0774730315', 'virusewana , andugoda road , dikkumbura', 1060.00, '2024-09-11 12:53:14', 0),
(2, 'sahdfk', 'dilaksha Lakshan', 'dilakshalakshan2001@gmail.com', '0774730315', '465468', 320.00, '2024-09-11 13:11:34', 0),
(18, 'teek', 'Vimukthi', 'jayasooriyashehan4@gmail.com', '0714166833', 'polonnaruwa', 900.00, '2024-10-13 15:26:49', 16),
(38, 'mahogani', 'jhgh', 'jayasooriyashehan4@gmail.com', '0750569545', 'gvgcgjc', 90.00, '2024-10-19 08:27:53', 16),
(39, 'teak', 'akila', 'rathne@222', '0750569545', 'eeeee', 200.00, '2024-10-21 20:44:39', 16),
(40, 'teak', 'akila', 'sfddgg@2001', '0714166833', 'polonnaruwa', 270.00, '2024-10-21 20:58:25', 16);

-- --------------------------------------------------------

--
-- Table structure for table `roof_order_items`
--

CREATE TABLE `roof_order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `measurement` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roof_order_items`
--

INSERT INTO `roof_order_items` (`id`, `order_id`, `measurement`, `quantity`, `price`) VALUES
(1, 1, '2x2 - 05 meters', 2, 50.00),
(2, 1, '2x4 - 10 meters', 2, 135.00),
(3, 1, '3x6 - 5 meters', 1, 150.00),
(4, 1, '3x6 - 10 meters', 2, 270.00),
(5, 2, '2x2 - 05 meters', 1, 50.00),
(6, 2, '3x6 - 10 meters', 1, 270.00),
(48, 18, '2x4 - 5 meters', 3, 75.00),
(49, 18, '3x5 - 10 meters', 3, 225.00),
(100, 38, '2x2 - 10 meters', 1, 90.00),
(101, 39, '2x2 - 05 meters', 4, 50.00),
(102, 40, '2x2 - 10 meters', 3, 90.00);

-- --------------------------------------------------------

--
-- Table structure for table `roof_services`
--

CREATE TABLE `roof_services` (
  `id` int(11) NOT NULL,
  `roof_size` int(11) DEFAULT NULL,
  `roof_type` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roof_services`
--

INSERT INTO `roof_services` (`id`, `roof_size`, `roof_type`, `address`, `user_id`, `created_at`) VALUES
(3, 67, 'Amano', 'polonnaruwa', 14, '2024-10-02 20:50:10'),
(4, 6796, 'Amano', 'malabe', 16, '2024-10-19 10:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `service_bookings`
--

CREATE TABLE `service_bookings` (
  `id` int(11) NOT NULL,
  `paint_object` varchar(255) NOT NULL,
  `object_size` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_bookings`
--

INSERT INTO `service_bookings` (`id`, `paint_object`, `object_size`, `created_at`) VALUES
(1, 'roof', '133', '2024-09-11 03:47:06'),
(2, 'roof', '1337', '2024-09-11 03:56:07'),
(3, 'wall', '12', '2024-09-12 02:15:00'),
(4, 'roof', '12', '2024-09-12 22:11:34'),
(5, 'roof', '0001', '2024-09-12 22:13:10'),
(6, 'wall', '12', '2024-09-12 22:41:53'),
(7, 'both', '12', '2024-09-12 22:57:29'),
(8, 'wall', '12', '2024-09-13 06:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `tree_sales`
--

CREATE TABLE `tree_sales` (
  `id` int(11) NOT NULL,
  `tree_name` varchar(255) NOT NULL,
  `expected_price` decimal(10,2) NOT NULL,
  `address` text NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tree_sales`
--

INSERT INTO `tree_sales` (`id`, `tree_name`, `expected_price`, `address`, `owner_name`, `contact_number`, `email`, `created_at`, `status`, `user_id`) VALUES
(4, 'akila ', 21.00, 'akila@gmail.com', 'thadiyahh', '12345', 'rathne@222', '2024-09-12 00:52:04', NULL, 16),
(6, 'akila', 1222.00, 'sfafa', 'thadiya', '12345', 'sfddgg@2001', '2024-09-12 23:00:25', 'Accepted', NULL),
(7, 'akila', 8888.00, 'dth', 'thadiya', '12345', 'sfddgg@2001', '2024-09-12 23:33:02', 'Accepted', NULL),
(9, 'jack', 2000.00, 'kandy', 'piyal', '0714166833', 'g@gmail.com', '2024-09-13 06:01:53', 'Accepted', NULL),
(10, 'teek', 1222.00, 'dJDHJSBJHA', 'thadiya', '0714166833', 'sfddgg@2001', '2024-10-02 22:06:53', 'Accepted', NULL),
(11, 'kumbuk', 4443.00, 'ffds', 'thadiya', '0714166833', 'akilahub@gmail.com', '2024-10-19 05:38:31', 'Pending', 16),
(12, 'akila', 5000.00, 'polonnaruwa', 'jithm', '0714166833', 'akilahub@gmail.com', '2024-10-19 07:51:35', 'Pending', NULL),
(13, 'akila', 66666.00, 'polonn', 'thadiya', '0750569545', 'jayasooriyashehan4@gmail.com', '2024-10-19 07:54:52', 'Pending', NULL),
(14, 'kumbuk', 66767.00, 'bvjvjv', 'thadiya', 'hjgjh', 'akilahub@gmail.com', '2024-10-19 10:25:58', 'Pending', NULL),
(15, 'kumbuk', 66767.00, 'bvjvjv', 'thadiya', 'hjgjh', 'akilahub@gmail.com', '2024-10-19 10:27:28', 'Pending', 16),
(16, 'kumbuk', 77777777.00, 'hhhhhhh', 'jithm', '0750569545', 'g@gmail.com', '2024-10-19 10:27:42', 'Pending', 16),
(17, 'kumbuk', 12333.00, 'polonnaruwa', 'jithm', '0714166833', 'akilahub@gmail.com', '2024-10-21 20:39:13', 'Pending', 16),
(18, 'kumbuk', 123333.00, 'ssss', 'thadiya', '124', 'rathne@222', '2024-10-21 20:39:44', 'Pending', 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'dexler', 'dilakshalakshan2001@gmail.com', '$2y$10$mNj9xhVTU8ftac.L9nZbKev3dsL6X0miKXmwGs8k8eOwzrNwsSROC', NULL),
(2, 'galle', 'pakaya@gmail.com', '$2y$10$cUb9aZ2vjjBo7Ce4UDz30.vuuTJlB6BdLfSmrvIMB0U0sU3KqFxei', NULL),
(3, 'ccc', 'sfddgg@2001', '$2y$10$C1pCF7VWe8Kt.b4K8NF.t.B8UIMjo4FEnUnx4CnRl9wAWcPHh62oW', NULL),
(4, 'akila', 'akilahub@gmail.com', '$2y$10$Ahk7ONk0N8YrPrCUEMFfPOoX2HwF2elSWOHHE/gQCnnsAWyGuFZmG', NULL),
(5, 'lena', 'lena@2gmail.com', '$2y$10$d.hNgEOZeL5kK3EgZtuRs.pHgZSdb5xgaUYvkTvHcYByeAFBvKKNa', NULL),
(6, 'vimu', 'jayasooriyashehan4@gmail.com', '$2y$10$9EnlC7m2lrAdXfBbXJeZceqmFGsLeTiE5DQho3MTW0triQhUHntcS', NULL),
(7, 'jithm', 'ji@gmail.com', '$2y$10$atxnLGlfT9I8QbZugSDLNe6S/HGZnDG29hNq.Gzwd2y6Ip2TH.MiK', NULL),
(8, 'abc', 'g@gmail.com', '$2y$10$clNIoWg9p3bzf33aAf5kx.3mDy9YTlHl8hBcyZJs3tbHDIHmsbcJ.', NULL),
(9, 'parami puki', 'paro@hgmail.com', '$2y$10$VZL9o6pAJxrE2BbpKEdYTODmXMM0VTaaNunYlz8BC0SUsQG0q9gWu', NULL),
(10, 'kcc abc', 'abc@gmail.com', '$2y$10$NPSx2gFxiY5EzF0J6WBHyOIZcFP8qYXsc./KSeKIQLcSP6m5pE3hm', NULL),
(11, 'rusty', 'rusty@gmail.com', '$2y$10$72r3qiN3On.9n6jEYr4a7.9UuB.Z7h6j7TyJAjy6xJ6Uhfm2UMIxi', NULL),
(12, 'podi', 'podi@gmail.com', '$2y$10$YRdy0lR3/K4Z/uT2kBw7xeCryOZQ4o2KyQ40ZPPgv2zw9K/7Xqvai', NULL),
(13, 'doom', 'doom@gmail.com', '$2y$10$9ObRTtxUPpmdZDyt4WdBB.Hegdt7XAmv/1j3KWd47KY4mvv9MNPym', NULL),
(16, 'cool', 'cool@gmail.com', '$2y$10$dHhH3IEdHe2r6Ved6EVmnugz7FhV9zKIb3pBt9MJiJDg6lJBKEM6G', NULL),
(17, 'bad', 'bad@gmail.com', '$2y$10$puvkta18/ORj/znuRZ4E3OCeaBIaf2r4.1Ee4sIl8cKE4rRgbduSG', NULL),
(18, 'uuu', 'uuu@gmail.com', '$2y$10$lwBeU33S8.RLTjzqxEMy.OutH6OsVHT7SjIH6EdkkPzlLry7hqBIW', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `window_services`
--

CREATE TABLE `window_services` (
  `id` int(11) NOT NULL,
  `window_size` int(11) DEFAULT NULL,
  `window_type` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `window_services`
--

INSERT INTO `window_services` (`id`, `window_size`, `window_type`, `address`, `user_id`, `created_at`) VALUES
(2, 0, 'Wooden', '', 1, '2024-09-12 00:42:30'),
(4, 450, 'Wooden', 'akilahub@gmail.com', 4, '2024-09-12 02:11:39'),
(9, 23, 'Board', 'wqeew', 0, '2024-10-11 07:44:32'),
(10, 128, 'Board', 'colombo', 16, '2024-10-19 10:20:38'),
(11, 12, 'Board', 'colombo', 16, '2024-10-21 20:18:35'),
(12, 12, 'Board', 'colombo', 16, '2024-10-21 20:22:52'),
(13, 12, 'Board', 'colombo', 16, '2024-10-21 20:23:37'),
(14, 12, 'Wooden', 'badulla', 16, '2024-10-21 20:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `wood_item_orders`
--

CREATE TABLE `wood_item_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `window_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `wood_measurement` varchar(50) NOT NULL,
  `referrer_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wood_item_orders`
--

INSERT INTO `wood_item_orders` (`id`, `user_id`, `window_type`, `name`, `email`, `contact_number`, `address`, `wood_measurement`, `referrer_id`, `order_date`) VALUES
(2, 1, 'jhg', 'hghh', 'nrsgraphic@gmail.com', '01548', '161/c , pasala asala panugalgoda , dikkumbura', '2x4-05', 1, '2024-09-11 13:48:43'),
(3, 1, 'jhg', 'hghh', 'nrsgraphic@gmail.com', '01548', '161/c , pasala asala panugalgoda , dikkumbura', '2x2-10', NULL, '2024-09-11 13:59:27'),
(4, 2, 'jhg', 'hghh', 'nrsgraphic@gmail.com', '01548', '161/c , pasala asala panugalgoda , dikkumbura', '3x5-10', NULL, '2024-09-11 14:00:08'),
(5, 2, 'jhg', 'hghh', 'nrsgraphicahsfihudkudshyfi@gmail.com', '01548', 'iusadyuga', '2x2-05', 2, '2024-09-11 14:09:52'),
(6, 2, 'jhg', 'hghh', 'nrsgraphicahsfihudkudshyfi@gmail.com', '01548', 'iusadyuga', '2x2-05', 2, '2024-09-11 14:23:35'),
(7, 4, 'aasdm', 'szcakilahub@gmail.com', 'asc@akila.com', 'zcx', 'asc', '2x6-05', 4, '2024-09-12 02:05:56'),
(8, 5, 'aasdm', 'jhgh', 'sfddgg@2001', '12345', 'cgfgcg', '2x2-05', 5, '2024-09-12 10:06:55'),
(9, 6, 'qqq', 'qqq', 'jayasooriyashehan4@gmail.com', '12345', 'qqsd', '3x6-05', 4, '2024-09-12 20:48:22'),
(10, 6, 'aasdm', 'jhgh', 'sfddgg@2001', '12345', 'nmnn', '2x2-05', 6, '2024-09-12 20:49:29'),
(11, 6, 'aasdm', 'jhgh', 'sfddgg@2001', '124', 'frwtrw', '2x2-05', NULL, '2024-09-12 22:38:09'),
(12, 6, 'aasdm', 'jhgh', 'sfddgg@2001', '12345', 'dsCA', '2x2-05', NULL, '2024-09-12 22:47:53'),
(13, 8, 'teak', 'vimukthi', 'jayasooriyashehan4@gmail.com', '3445647776767', 'sfdghjhhj', '2x2-05', NULL, '2024-09-13 06:03:24'),
(14, 9, 'aasdm', 'jhgh', 'jayasooriyashehan4@gmail.com', '0714166833', 'qdewgre', '2x6-05', NULL, '2024-09-14 14:59:14'),
(21, 16, 'Mahogani', 'vimukthi', 'jayasooriyashehan4@gmail.com', '0750569545', 'colombo city', '3x6-10', NULL, '2024-10-19 06:50:57'),
(23, 16, 'Teek', 'supun tharaka', 'jayasooriyashehan4@gmail.com', '0714166833', 'malabe', '2x6-10', NULL, '2024-10-19 07:36:06'),
(24, 17, 'Teek', 'akila', 'jayasooriyashehan4@gmail.com', '0714166833', 'polonnaruwa', '2x4-05', NULL, '2024-10-19 07:42:24'),
(25, 17, 'Teek', 'shehan', 'akilahub@gmail.com', '0714166833', 'qwqw', '2x6-10', NULL, '2024-10-19 07:43:45'),
(26, 16, 'Teek', 'sadalu', 'jayasooriyashehan4@gmail.com', '0714166833', 'polonna', '2x6-05', NULL, '2024-10-19 07:55:38'),
(27, 16, 'Teek', 'michel', 'rathne@222', '0714166833', 'colombo', '2x6-10', NULL, '2024-10-20 15:59:17'),
(28, 16, 'Teek', 'akila', 'sfddgg@2001', '0714166833', 'polo', '2x4-05', NULL, '2024-10-21 20:44:14'),
(29, 16, 'Teek', 'akila', 'jayasooriyashehan4@gmail.com', '0714166833', 'polonnaruwa', '2x4-05', NULL, '2024-10-21 20:57:57'),
(30, 18, 'Teek', 'akila', 'jayasooriyashehan4@gmail.com', '0714166833', 'polonnaruwa', '2x6-10', NULL, '2024-10-21 21:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `wood_orders`
--

CREATE TABLE `wood_orders` (
  `id` int(11) NOT NULL,
  `window_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `wood_measurement` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wood_orders`
--

INSERT INTO `wood_orders` (`id`, `window_type`, `name`, `email`, `contact_number`, `address`, `wood_measurement`, `order_date`) VALUES
(1, 'jhg', 'hghh', 'nrsgraphic@gmail.com', '01548', '161/c , pasala asala panugalgoda , dikkumbura', '2x4-10', '2024-09-11 11:00:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_referrals`
--
ALTER TABLE `customer_referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `referred_by` (`referred_by`);

--
-- Indexes for table `finished_planks`
--
ALTER TABLE `finished_planks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `furniture`
--
ALTER TABLE `furniture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `furnitures`
--
ALTER TABLE `furnitures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `furniture_orders`
--
ALTER TABLE `furniture_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `furniture_id` (`furniture_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `furniture_reviews`
--
ALTER TABLE `furniture_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `furniture_id` (`furniture_id`);

--
-- Indexes for table `material_categories`
--
ALTER TABLE `material_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_requests`
--
ALTER TABLE `material_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `furniture_id` (`furniture_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `paint_items`
--
ALTER TABLE `paint_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paint_orders`
--
ALTER TABLE `paint_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planks`
--
ALTER TABLE `planks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plank_purchases`
--
ALTER TABLE `plank_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plank_rentals`
--
ALTER TABLE `plank_rentals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `furniture_id` (`furniture_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roof_items`
--
ALTER TABLE `roof_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roof_orders`
--
ALTER TABLE `roof_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roof_order_items`
--
ALTER TABLE `roof_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `roof_services`
--
ALTER TABLE `roof_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_bookings`
--
ALTER TABLE `service_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tree_sales`
--
ALTER TABLE `tree_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `window_services`
--
ALTER TABLE `window_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wood_item_orders`
--
ALTER TABLE `wood_item_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `referrer_id` (`referrer_id`);

--
-- Indexes for table `wood_orders`
--
ALTER TABLE `wood_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_referrals`
--
ALTER TABLE `customer_referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `finished_planks`
--
ALTER TABLE `finished_planks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `furniture`
--
ALTER TABLE `furniture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `furnitures`
--
ALTER TABLE `furnitures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `furniture_orders`
--
ALTER TABLE `furniture_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `furniture_reviews`
--
ALTER TABLE `furniture_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `material_categories`
--
ALTER TABLE `material_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `material_requests`
--
ALTER TABLE `material_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paint_items`
--
ALTER TABLE `paint_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `paint_orders`
--
ALTER TABLE `paint_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `planks`
--
ALTER TABLE `planks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plank_purchases`
--
ALTER TABLE `plank_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `plank_rentals`
--
ALTER TABLE `plank_rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roof_items`
--
ALTER TABLE `roof_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roof_orders`
--
ALTER TABLE `roof_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `roof_order_items`
--
ALTER TABLE `roof_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `roof_services`
--
ALTER TABLE `roof_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_bookings`
--
ALTER TABLE `service_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tree_sales`
--
ALTER TABLE `tree_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `window_services`
--
ALTER TABLE `window_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wood_item_orders`
--
ALTER TABLE `wood_item_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `wood_orders`
--
ALTER TABLE `wood_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_referrals`
--
ALTER TABLE `customer_referrals`
  ADD CONSTRAINT `customer_referrals_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `roof_orders` (`id`),
  ADD CONSTRAINT `customer_referrals_ibfk_2` FOREIGN KEY (`referred_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `furniture_orders`
--
ALTER TABLE `furniture_orders`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `furniture_orders_ibfk_1` FOREIGN KEY (`furniture_id`) REFERENCES `furniture` (`id`);

--
-- Constraints for table `furniture_reviews`
--
ALTER TABLE `furniture_reviews`
  ADD CONSTRAINT `furniture_reviews_ibfk_1` FOREIGN KEY (`furniture_id`) REFERENCES `furniture` (`id`);

--
-- Constraints for table `material_requests`
--
ALTER TABLE `material_requests`
  ADD CONSTRAINT `material_requests_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `material_categories` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`furniture_id`) REFERENCES `furniture` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`furniture_id`) REFERENCES `furniture` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `roof_order_items`
--
ALTER TABLE `roof_order_items`
  ADD CONSTRAINT `roof_order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `roof_orders` (`id`);

--
-- Constraints for table `wood_item_orders`
--
ALTER TABLE `wood_item_orders`
  ADD CONSTRAINT `wood_item_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wood_item_orders_ibfk_2` FOREIGN KEY (`referrer_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
