-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 10:32 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `renteverything`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` int(10) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `ip_add`, `qty`) VALUES
(6, 0, 0),
(7, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Electronics'),
(2, 'Clothings'),
(3, 'Jewelary & Watches'),
(4, 'Bags & Shoes'),
(5, 'Furniture'),
(6, 'Home & Garden'),
(7, 'Toys & Kids'),
(8, 'sports & outdors'),
(9, 'Weddings & Events'),
(10, 'Education & Office Supplies'),
(11, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(15) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(15) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `customer_image` text NOT NULL,
  `customer_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`, `customer_ip`) VALUES
(1, 'Maleha Israt Chowdhury', 'maleha.ick@gmail.com', 'maleha', 'Bangladesh', 'Dhaka', '2345678', 'Jahurul Islam City Gate, A/2 Jahurul Islam Ave, Dhaka 1212', 'dog.jpg', '0'),
(6, 'mow monira', 'mow.monira@gmail.com', 'm', 'bangladesh', 'dhaka', '01254783', '12/a c das lane', 'dog.jpg', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `due_amount` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `total_products` int(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`order_id`, `customer_id`, `due_amount`, `invoice_no`, `total_products`, `order_date`, `order_status`) VALUES
(9, 0, 750, 89000703, 2, '0000-00-00 00:00:00', 'pending'),
(11, 0, 650, 236963112, 2, '0000-00-00 00:00:00', 'pending'),
(12, 0, 100, 1345135440, 1, '0000-00-00 00:00:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `pending_orders`
--

CREATE TABLE `pending_orders` (
  `customer_id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_no` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pending_orders`
--

INSERT INTO `pending_orders` (`customer_id`, `order_id`, `invoice_no`, `product_id`, `qty`, `order_status`) VALUES
(0, 8, 2002070629, 0, 1, 'pending'),
(0, 9, 89000703, 6, 1, 'pending'),
(0, 10, 898761320, 0, 1, 'pending'),
(0, 11, 236963112, 7, 1, 'pending'),
(0, 12, 1345135440, 5, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product_id` int(15) NOT NULL,
  `cat_id` int(15) NOT NULL,
  `Date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `Product_title` text NOT NULL,
  `Product_img` varchar(100) NOT NULL,
  `Rent_price` int(15) NOT NULL,
  `status` varchar(15) NOT NULL,
  `Product_des` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_id`, `cat_id`, `Date`, `Product_title`, `Product_img`, `Rent_price`, `status`, `Product_des`, `product_keywords`) VALUES
(1, 1, '2020-05-18 19:44:52.529987', 'HP laptop', 'laptop.jpg', 50000, 'on', 'Contact number:0123354 \r\n brand new products.', 'hp,laptop'),
(4, 2, '2020-05-18 19:44:31.770805', 'green punjabi', 'punjabi.jpg', 500, 'on', 'Contact number:0123354 branded punjabi', 'green,punjabi'),
(5, 3, '2020-05-18 19:45:08.403438', 'Rolex watch', 'watch1.jpg', 100, 'on', 'Contact number:0123354 new.', 'rolex,watch'),
(6, 5, '2020-05-18 19:45:20.134186', 'wodden chair', 'BasicChair.jpg', 250, 'on', 'Contact number:0123354 old.', 'wodden, chair'),
(7, 4, '2020-05-18 19:43:59.203743', 'black shoe', '4.jpg', 150, 'on', 'Contact number:0123354 size:44  ', 'black, shoe'),
(8, 10, '2020-05-18 19:44:13.322526', 'pen container', 'king.jpg', 50, 'on', 'Contact number:0123354 new.', 'container'),
(9, 6, '2020-05-18 19:45:00.144951', 'mirror', '201946_1.jpg', 150, 'on', 'Contact number:0123354 old.', 'mirror');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pending_orders`
--
ALTER TABLE `pending_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pending_orders`
--
ALTER TABLE `pending_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
