-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2022 at 12:04 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sofiadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_db`
--

CREATE TABLE `admin_db` (
  `id` int(10) NOT NULL,
  `username` varchar(115) NOT NULL,
  `password` varchar(115) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_db`
--

INSERT INTO `admin_db` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `total` double(25,2) NOT NULL,
  `size` varchar(115) NOT NULL,
  `expiration` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `qty`, `total`, `size`, `expiration`) VALUES
(165, 40, 2, 1, 2000.00, 'Large', '2022-10-28'),
(166, 40, 43, 1, 250.00, 'Large', '2022-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `order_data`
--

CREATE TABLE `order_data` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(10) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `qty` int(20) NOT NULL,
  `total` double(25,2) NOT NULL,
  `order_no` bigint(20) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `rate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_data`
--

INSERT INTO `order_data` (`order_id`, `customer_id`, `product_id`, `prod_name`, `qty`, `total`, `order_no`, `order_status`, `rate`) VALUES
(66, 3, 1, 'Nike Air Force', 3, 4652.00, 719297, 'DELIVERED', 'DONE'),
(67, 3, 2, 'Nike Air Max', 1, 5050.00, 841417, 'CANCELLED', 'NOT'),
(68, 3, 2, 'Nike Air Max', 1, 5050.00, 104027, 'CANCELLED', 'NOT'),
(69, 32, 20, 'Nike Oliver', 1, 4500.00, 730221, 'DELIVERED', 'NOT'),
(70, 32, 1, 'Nike Air Force', 1, 4652.00, 501506, 'CANCELLED', 'NOT'),
(71, 33, 20, 'Nike Oliver', 4, 4500.00, 299613, 'DELIVERED', 'DONE'),
(72, 33, 25, 'Leaves', 2, 1200.00, 412954, 'CANCELLED', 'NOT'),
(73, 33, 25, 'Leaves', 2, 1200.00, 392702, 'CANCELLED', 'NOT'),
(74, 33, 2, 'Nike Zoom Fly 5', 1, 5050.00, 522525, 'DELIVERED', 'NOT'),
(75, 33, 30, 'Girl Graphic', 1, 550.00, 651784, 'CANCELLED', 'NOT'),
(76, 35, 45, 'Converse Jacket', 1, 750.00, 500854, 'DELIVERED', 'DONE'),
(77, 35, 57, 'Nike Airmax', 2, 2000.00, 389098, 'CANCELLED', 'NOT'),
(78, 35, 31, 'Jeans Woman', 1, 545.00, 827735, 'DELIVERED', 'NOT'),
(79, 36, 46, 'Thrasher Jacket', 1, 550.00, 980181, 'DELIVERED', 'DONE'),
(80, 37, 56, 'Gray Jacket', 1, 550.00, 236325, 'CANCELLED', 'NOT'),
(81, 37, 56, 'Gray Jacket', 1, 550.00, 280460, 'CANCELLED', 'NOT'),
(82, 37, 56, 'Gray Jacket', 1, 550.00, 195085, 'DELIVERED', 'NOT'),
(83, 39, 2, 'Nike Zoom Fly 5', 1, 2000.00, 148835, 'DELIVERED', 'NOT'),
(84, 39, 1, 'Nike Air Force', 1, 4652.50, 148835, 'DELIVERED', 'NOT'),
(85, 39, 31, 'Jeans Woman', 1, 545.00, 226253, 'DELIVERED', 'NOT'),
(86, 39, 53, 'White Jacket', 1, 750.00, 514437, 'DELIVERED', 'NOT'),
(87, 39, 43, 'Gray Jacket', 2, 500.00, 605736, 'DELIVERED', 'NOT'),
(88, 39, 51, 'Home Free Shirt', 1, 550.00, 605736, 'DELIVERED', 'NOT'),
(89, 39, 54, 'POLO', 1, 550.00, 605736, 'PENDING', 'NOT'),
(90, 40, 40, 'Gown Dress', 1, 1500.00, 0, 'CANCELLED', 'NOT'),
(91, 40, 41, 'Heart Necklaces', 1, 999.00, 334178, 'PENDING', 'NOT');

-- --------------------------------------------------------

--
-- Table structure for table `product_data`
--

CREATE TABLE `product_data` (
  `product_id` int(10) NOT NULL,
  `product_name` text NOT NULL,
  `description` text NOT NULL,
  `price` double(25,2) NOT NULL,
  `ratings` text NOT NULL,
  `image_path` text NOT NULL,
  `front_image` text NOT NULL,
  `back_image` text NOT NULL,
  `small` int(10) NOT NULL,
  `medium` int(10) NOT NULL,
  `large` int(10) NOT NULL,
  `category` text NOT NULL,
  `release_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_data`
--

INSERT INTO `product_data` (`product_id`, `product_name`, `description`, `price`, `ratings`, `image_path`, `front_image`, `back_image`, `small`, `medium`, `large`, `category`, `release_date`) VALUES
(1, 'Nike Air Force', 'NIKE AIR FORCE 1 07', 4652.50, '4.29', 'sofiaimages/Products/NikeAirZoomPegasus.png', 'sofiaimages/Products/NikeAirZoomPegasus.png', 'sofiaimages/Products/NikeAirZoomPegasus.png', 63, 65, 65, 'Footwear', '2019-03-29'),
(2, 'Nike Zoom Fly 5', 'Nike Zoom Fly 5', 2000.00, '4.20', 'sofiaimages/Products/NikeZoomFly5.png', 'sofiaimages/Products/zoomfly5sample2.png', 'sofiaimages/Products/zoomfly5sample.png', 0, 0, 57, 'Footwear', '2022-09-03'),
(30, 'Girl Graphic', 'Graphic Shirt', 550.00, 'No Ratings Yet', 'sofiaimages/Products/graphicshirt.png', 'sofiaimages/Products/graphicshirt.png', 'sofiaimages/Products/', 0, -1, 0, 'Tops', '2022-09-03'),
(31, 'Jeans Woman', 'High Quality', 545.00, 'No Ratings Yet', 'sofiaimages/Products/JeansWoman.png', 'sofiaimages/Products/jeanswomansample.png', 'sofiaimages/Products/jeanswomansample.png', 0, 0, 0, 'Bottoms', '2022-09-04'),
(40, 'Gown Dress', 'For Woman', 1500.00, 'No Ratings Yet', 'sofiaimages/Products/GownDress.png', 'sofiaimages/Products/GownDress.png', 'sofiaimages/Products/', 0, 0, 0, 'Dresses', '2022-09-01'),
(41, 'Heart Necklaces', 'Necklace for Gift', 999.00, 'No Ratings Yet', 'sofiaimages/Products/heartnecklace.png', 'sofiaimages/Products/heartnecklace.png', 'sofiaimages/Products/', 0, 0, 0, 'Accessories', '2022-09-02'),
(43, 'Gray Jacket', 'Jacket', 250.00, 'No Ratings Yet', 'sofiaimages/Products/bg.png', 'sofiaimages/Products/santacruz.jpg', 'sofiaimages/Products/', 0, 0, 1, 'Tops', '2022-09-05'),
(44, 'BTI Shirt', 'Brotherhood', 750.00, 'No Ratings Yet', 'sofiaimages/Products/btinobg.png', 'sofiaimages/Products/bti.jpg', '', 0, 0, 1, 'Tops', '2022-09-06'),
(45, 'Converse Jacket', 'Converse Cream', 750.00, '5.00', 'sofiaimages/Products/290519988_5125448994177129_8135508939330893278_n-removebg-preview.png', 'sofiaimages/Products/290519988_5125448994177129_8135508939330893278_n.jpg', 'sofiaimages/Products/290519988_5125448994177129_8135508939330893278_n.jpg', 0, 0, 1, 'Tops', '2022-09-06'),
(46, 'Thrasher Jacket', 'Thrasher Black', 550.00, '5.00', 'sofiaimages/Products/290982250_5128652537190108_723090015068115689_n-removebg-preview.png', 'sofiaimages/Products/290982250_5128652537190108_723090015068115689_n.jpg', 'sofiaimages/Products/290982250_5128652537190108_723090015068115689_n.jpg', 0, 0, -1, 'Tops', '2022-09-06'),
(47, 'NBA Cap', '2018 NBA Finals', 350.00, 'No Ratings Yet', 'sofiaimages/Products/nbacap.png', 'sofiaimages/Products/294119906_5152042154851146_8108732878572040037_n.jpg', 'sofiaimages/Products/294119906_5152042154851146_8108732878572040037_n.jpg', 0, 0, 1, 'Accessories', '2022-09-06'),
(48, 'ESPRIT', 'Long sleeves', 550.00, 'No Ratings Yet', 'sofiaimages/Products/290976436_5128653767189985_4682722704649601627_n-removebg-preview.png', 'sofiaimages/Products/290976436_5128653767189985_4682722704649601627_n.jpg', 'sofiaimages/Products/290976436_5128653767189985_4682722704649601627_n.jpg', 0, 0, 1, 'Tops', '2022-09-06'),
(49, 'US Shirt', 'US Map', 550.00, 'No Ratings Yet', 'sofiaimages/Products/295056186_5166284250093603_6899787534898383582_n-removebg-preview.png', 'sofiaimages/Products/295056186_5166284250093603_6899787534898383582_n.jpg', 'sofiaimages/Products/295056186_5166284250093603_6899787534898383582_n.jpg', 0, 0, 1, 'Tops', '2022-09-06'),
(50, 'NRA Shirt', 'Golden Eagles', 550.00, 'No Ratings Yet', 'sofiaimages/Products/295221095_5166284386760256_861098582328155379_n-removebg-preview.png', 'sofiaimages/Products/295221095_5166284386760256_861098582328155379_n.jpg', 'sofiaimages/Products/295221095_5166284386760256_861098582328155379_n.jpg', 0, 0, 1, 'Tops', '2022-09-06'),
(51, 'Home Free Shirt', 'Holiday Special', 550.00, 'No Ratings Yet', 'sofiaimages/Products/295014027_5166284596760235_3317162550430418074_n-removebg-preview.png', 'sofiaimages/Products/295014027_5166284596760235_3317162550430418074_n-removebg-preview.png', '', 0, 0, 0, 'Tops', '2022-09-06'),
(52, 'Polo Shirt', 'Blue Polo', 550.00, 'No Ratings Yet', 'sofiaimages/Products/296054318_5181144045274290_4098136949122727395_n-removebg-preview.png', 'sofiaimages/Products/296054318_5181144045274290_4098136949122727395_n.jpg', 'sofiaimages/Products/296120732_5181152551940106_8577100419308557787_n.jpg', 0, 0, 1, 'Tops', '2022-09-06'),
(53, 'White Jacket', 'Plain White', 750.00, 'No Ratings Yet', 'sofiaimages/Products/290180779_5120132404708788_5330418301432729110_n-removebg-preview.png', 'sofiaimages/Products/290236462_5120130018042360_4674407407884418180_n.jpg', 'sofiaimages/Products/290236462_5120130018042360_4674407407884418180_n.jpg', 0, 0, 0, 'Tops', '2022-09-06'),
(54, 'POLO', 'Polo Shirt', 550.00, 'No Ratings Yet', 'sofiaimages/Products/295831085_5181144038607624_6427978054469749986_n-removebg-preview.png', 'sofiaimages/Products/295831085_5181144038607624_6427978054469749986_n.jpg', 'sofiaimages/Products/295831085_5181144038607624_6427978054469749986_n.jpg', 0, 0, 0, 'Tops', '2022-09-06'),
(55, 'Holster California', 'Women Jacket', 550.00, 'No Ratings Yet', 'sofiaimages/Products/whitejacket.png', 'sofiaimages/Products/292873841_5129145083807520_4906732401271884072_n.jpg', 'sofiaimages/Products/292706181_5129145497140812_3356295473977026751_n.jpg', 0, 0, 1, 'Tops', '2022-09-06'),
(56, 'Gray Jacket', 'Cotton Women', 550.00, 'No Ratings Yet', 'sofiaimages/Products/291629764_5128654393856589_7430172355215764538_n-removebg-preview.png', 'sofiaimages/Products/291629764_5128654393856589_7430172355215764538_n.jpg', 'sofiaimages/Products/291424721_5128653133856715_2272761616531662313_n.jpg', 0, 0, 0, 'Tops', '2022-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rate_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `five` int(150) NOT NULL,
  `four` int(150) NOT NULL,
  `three` int(150) NOT NULL,
  `two` int(150) NOT NULL,
  `one` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rate_id`, `product_id`, `five`, `four`, `three`, `two`, `one`) VALUES
(1, 1, 4, 1, 2, 0, 0),
(2, 2, 2, 8, 0, 0, 0),
(14, 19, 1, 3, 1, 0, 0),
(15, 13, 0, 1, 1, 0, 0),
(16, 20, 1, 2, 0, 0, 0),
(17, 45, 1, 0, 0, 0, 0),
(18, 46, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `ID` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phoneno` text NOT NULL,
  `email_add` varchar(100) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`ID`, `name`, `address`, `phoneno`, `email_add`, `username`, `password`) VALUES
(36, 'Arjohn Cu', 'Valenzuela City', '09657485734', 'arjohn@gmail.com', 'arjohn', 'f6d4c3682b75fb061b42c1547123190e'),
(37, 'Taylor Swift', 'Bulacan', '09675645345', 'taylor@gmail.com', 'taylor', '7d70663568cac5af684503681e3a4d41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_db`
--
ALTER TABLE `admin_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `order_data`
--
ALTER TABLE `order_data`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product_data`
--
ALTER TABLE `product_data`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_db`
--
ALTER TABLE `admin_db`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `order_data`
--
ALTER TABLE `order_data`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `product_data`
--
ALTER TABLE `product_data`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rate_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
