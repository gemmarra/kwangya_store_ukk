-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 29, 2024 at 01:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kwangya_store`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_category` (IN `id` INT)   BEGIN
DELETE FROM category WHERE category_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_denomination` (IN `id` INT)   BEGIN
DELETE FROM denomination WHERE denomination_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_product` (IN `id` BIGINT(14))   BEGIN
DELETE FROM product WHERE product_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_user` (IN `myemail` VARCHAR(50))   BEGIN
DELETE FROM user WHERE email = myemail;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_category` (IN `name` VARCHAR(50))   BEGIN
INSERT INTO category VALUES (NULL, name);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_denomination` (IN `name` VARCHAR(30))   BEGIN
INSERT INTO denomination VALUES (NULL, name);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_product` (IN `product_id` BIGINT(14), IN `product_name` VARCHAR(50), IN `category` INT(5), IN `stock` INT(5), IN `denomination` INT(5), IN `selling_price` DECIMAL(10,2), IN `purchase_price` VARCHAR(50))   BEGIN
INSERT INTO product VALUES (product_id, product_name, category, stock, denomination, selling_price, purchase_price);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_purchase` (IN `date` DATETIME, IN `expend` DECIMAL(10,2), IN `receipt` VARCHAR(50))   BEGIN
INSERT INTO `purchase` (`purchase_id`, `datetime`, `expenditure_total`, `receipt_image`) VALUES (NULL, date, expend, receipt);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_user` (IN `myemail` VARCHAR(50), IN `myname` VARCHAR(50), IN `mypw` VARCHAR(16), IN `myrole` ENUM('cashier','administrator','inventory_manager'))   BEGIN
INSERT INTO user VALUES (myemail, myname, mypw, myrole);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `report_monthly` (IN `monthly` INT(2), IN `yearly` YEAR(4))   BEGIN
SELECT *
FROM selling
WHERE DATE_FORMAT(selling.datetime, '%Y-%m') = CONCAT(yearly, '-', LPAD(monthly, 2, '0'));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `report_yearly` (IN `yearly` YEAR)   BEGIN
SELECT *
FROM selling
WHERE DATE_FORMAT(selling.datetime, '%Y') = yearly;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_category` (IN `name` VARCHAR(50))   BEGIN
SELECT * FROM category WHERE category_name LIKE CONCAT('%',name,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_denomination` (IN `name` VARCHAR(50))   BEGIN
SELECT * FROM denomination WHERE denomination_name LIKE CONCAT('%',name,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_product` (IN `this` VARCHAR(50))   BEGIN
SELECT product.product_id, product.product_name, category.category_name, product.stock, denomination.denomination_name, product.selling_price, product.purchase_price FROM product JOIN category ON product.category=category.category_id JOIN denomination ON product.denomination=denomination.denomination_id WHERE product.product_name OR product.product_id LIKE CONCAT('%',this,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_product_id_no_zero` (IN `id` BIGINT(14))   BEGIN
SELECT product.product_id, product.product_name, category.category_name, product.stock, denomination.denomination_name, product.selling_price, product.purchase_price FROM product JOIN category ON product.category=category.category_id JOIN denomination ON product.denomination=denomination.denomination_id WHERE product.product_id LIKE CONCAT('%',id,'%') && product.stock > 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_product_name` (IN `name` VARCHAR(50))   BEGIN
SELECT product.product_id, product.product_name, category.category_name, product.stock, denomination.denomination_name, product.selling_price, product.purchase_price FROM product JOIN category ON product.category=category.category_id JOIN denomination ON product.denomination=denomination.denomination_id WHERE product.product_name LIKE CONCAT('%',name,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_purchase` (IN `purchase_date` VARCHAR(30))   BEGIN
SELECT * FROM purchase WHERE purchase.datetime LIKE CONCAT('%',purchase_date,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_user` (IN `myname` VARCHAR(30))   BEGIN
SELECT * FROM user WHERE user.name LIKE CONCAT ('%',myname,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_category` ()   BEGIN
SELECT * FROM category;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_denomination` ()   BEGIN
SELECT * FROM denomination;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_product` ()   BEGIN
SELECT product.product_id, product.product_name, category.category_name, product.stock, denomination.denomination_name, product.selling_price, product.purchase_price FROM product JOIN category ON product.category=category.category_id JOIN denomination ON product.denomination=denomination.denomination_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_product_no_zero` ()   BEGIN
SELECT product.product_id, product.product_name, category.category_name, product.stock, denomination.denomination_name, product.selling_price, product.purchase_price FROM product JOIN category ON product.category=category.category_id JOIN denomination ON product.denomination=denomination.denomination_id WHERE product.stock > 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_purchase` ()   BEGIN
SELECT * FROM purchase;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_selling` ()   BEGIN
SELECT * FROM selling;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_sellingdetails` (IN `facturs` VARCHAR(50))   BEGIN
SELECT selling_details.details_id, selling_details.factur, product.product_name, selling_details.quantity, selling_details.price_total FROM selling_details JOIN product ON product.product_id = selling_details.product_id WHERE selling_details.factur = facturs;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_user` ()   BEGIN
SELECT * FROM user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_details` (IN `sellingID` INT(11))   BEGIN
SELECT selling_details.details_id, selling_details.factur, product.product_name, selling_details.quantity, selling_details.price_total FROM selling_details JOIN product ON product.product_id = selling_details.product_id WHERE selling_details.selling_id = sellingID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `today_income` ()   BEGIN
SELECT SUM(grand_total) FROM selling WHERE DATE(datetime) = CURRENT_DATE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `today_selling` ()   BEGIN
SELECT COUNT(selling_id) FROM selling WHERE DATE(datetime) = CURRENT_DATE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `zero_stock` ()   BEGIN
SELECT COUNT(product_id) FROM product WHERE stock = 0;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(2007, 'Belts'),
(2008, 'Baseball Caps'),
(2009, 'Pillowcases'),
(2010, 'Photobooks'),
(2011, 'Flats'),
(2012, 'Mules'),
(2013, 'Socks'),
(2014, 'Sandals'),
(2015, 'Suspenders'),
(2016, 'Tote Bags'),
(2017, 'Gloves'),
(2018, 'Baseball Caps'),
(2019, 'Tumblers'),
(2020, 'Slip-Ons'),
(2021, 'Combat Boots'),
(2022, 'Magnets'),
(2023, 'Tote Bags'),
(2024, 'Dress Shoes'),
(2025, 'Earrings'),
(2026, 'Espadrilles'),
(2027, 'Makeup Bags'),
(2028, 'Photocards'),
(2029, 'Baseball Caps'),
(2030, 'Shoes'),
(2031, 'Photobooks'),
(2032, 'Fashion Apparel'),
(2033, 'Dress Shoes'),
(2034, 'Hair Accessories'),
(2035, 'Pens'),
(2036, 'Flip Flops'),
(2037, 'Dress Shoes'),
(2038, 'Gloves'),
(2039, 'Mugs'),
(2040, 'Pumps'),
(2041, 'Hair Accessories'),
(2042, 'Makeup Bags'),
(2043, 'Concert DVDs'),
(2044, 'Stickers'),
(2045, 'Pins'),
(2046, 'Bucket Hats'),
(2047, 'Pens'),
(2048, 'Pillowcases'),
(2049, 'Rings'),
(2050, 'Fashion Apparel'),
(2051, 'Photobooks'),
(2052, 'Watches'),
(2053, 'Fashion Apparel'),
(2054, 'Espadrilles'),
(2055, 'T-shirts'),
(2056, 'Towels'),
(2057, 'Earrings'),
(2058, 'Notebooks'),
(2059, 'Keychains'),
(2060, 'Suspenders'),
(2061, 'Pumps'),
(2062, 'Suspenders'),
(2063, 'Belts'),
(2064, 'Heels'),
(2065, 'Mules'),
(2066, 'Leggings'),
(2067, 'Bracelets'),
(2068, 'Pillowcases'),
(2069, 'Wallets'),
(2070, 'Rain Boots'),
(2071, 'Ankle Boots'),
(2072, 'Baseball Caps'),
(2073, 'Casual Shoes'),
(2074, 'Posters'),
(2075, 'Mousepads'),
(2076, 'Formal Shoes'),
(2077, 'Tank Tops'),
(2078, 'Pins'),
(2079, 'Tumblers'),
(2080, 'Hair Accessories'),
(2081, 'Rings'),
(2082, 'Blankets'),
(2083, 'Plush Toys'),
(2084, 'Bracelets'),
(2085, 'Makeup Bags'),
(2086, 'Beanies'),
(2087, 'Postcards'),
(2088, 'Pumps'),
(2089, 'Blankets'),
(2090, 'Tote Bags'),
(2091, 'Beanies'),
(2092, 'Slides'),
(2093, 'Magnets'),
(2094, 'Suspenders'),
(2095, 'Notebooks'),
(2096, 'Backpacks'),
(2097, 'Belts'),
(2098, 'Heels'),
(2099, 'Tumblers'),
(2100, 'Photocards'),
(2101, 'Slides'),
(2102, 'Loafers'),
(2103, 'Wallets'),
(2104, 'Hoodies'),
(2105, 'Concert DVDs'),
(2106, 'Bracelets'),
(2107, 'Belts'),
(2108, 'Baseball Caps'),
(2109, 'Pillowcases'),
(2110, 'Photobooks'),
(2111, 'Flats'),
(2112, 'Mules'),
(2113, 'Socks'),
(2114, 'Sandals'),
(2115, 'Suspenders'),
(2116, 'Tote Bags'),
(2117, 'Gloves'),
(2118, 'Baseball Caps'),
(2119, 'Tumblers'),
(2120, 'Slip-Ons'),
(2121, 'Combat Boots'),
(2122, 'Magnets'),
(2123, 'Tote Bags'),
(2124, 'Dress Shoes'),
(2125, 'Earrings'),
(2126, 'Espadrilles'),
(2127, 'Makeup Bags'),
(2128, 'Photocards'),
(2129, 'Baseball Caps'),
(2130, 'Shoes'),
(2131, 'Photobooks'),
(2132, 'Fashion Apparel'),
(2133, 'Dress Shoes'),
(2134, 'Hair Accessories'),
(2135, 'Pens'),
(2136, 'Flip Flops'),
(2137, 'Dress Shoes'),
(2138, 'Gloves'),
(2139, 'Mugs'),
(2140, 'Pumps'),
(2141, 'Hair Accessories'),
(2142, 'Makeup Bags'),
(2143, 'Concert DVDs'),
(2144, 'Stickers'),
(2145, 'Pins'),
(2146, 'Bucket Hats'),
(2147, 'Pens'),
(2148, 'Pillowcases'),
(2149, 'Rings'),
(2150, 'Fashion Apparel'),
(2151, 'Photobooks'),
(2152, 'Watches'),
(2153, 'Fashion Apparel'),
(2154, 'Espadrilles'),
(2155, 'T-shirts'),
(2156, 'Towels'),
(2157, 'Earrings'),
(2158, 'Notebooks'),
(2159, 'Keychains'),
(2160, 'Suspenders'),
(2161, 'Pumps'),
(2162, 'Suspenders'),
(2163, 'Belts'),
(2164, 'Heels'),
(2165, 'Mules'),
(2166, 'Leggings'),
(2167, 'Bracelets'),
(2168, 'Pillowcases'),
(2169, 'Wallets'),
(2170, 'Rain Boots'),
(2171, 'Ankle Boots'),
(2172, 'Baseball Caps'),
(2173, 'Casual Shoes'),
(2174, 'Posters'),
(2175, 'Mousepads'),
(2176, 'Formal Shoes'),
(2177, 'Tank Tops'),
(2178, 'Pins'),
(2179, 'Tumblers'),
(2180, 'Hair Accessories'),
(2181, 'Rings'),
(2182, 'Blankets'),
(2183, 'Plush Toys'),
(2184, 'Bracelets'),
(2185, 'Makeup Bags'),
(2186, 'Beanies'),
(2187, 'Postcards'),
(2188, 'Pumps'),
(2189, 'Blankets'),
(2190, 'Tote Bags'),
(2191, 'Beanies'),
(2192, 'Slides'),
(2193, 'Magnets'),
(2194, 'Suspenders'),
(2195, 'Notebooks'),
(2196, 'Backpacks'),
(2197, 'Belts'),
(2198, 'Heels'),
(2199, 'Tumblers'),
(2200, 'Photocards'),
(2201, 'Slides'),
(2202, 'Loafers'),
(2203, 'Wallets'),
(2204, 'Hoodies'),
(2205, 'Concert DVDs'),
(2206, 'Bracelets');

-- --------------------------------------------------------

--
-- Table structure for table `denomination`
--

CREATE TABLE `denomination` (
  `denomination_id` int(11) NOT NULL,
  `denomination_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `denomination`
--

INSERT INTO `denomination` (`denomination_id`, `denomination_name`) VALUES
(4, 'cabinet'),
(5, 'bin'),
(6, 'vault'),
(7, 'box'),
(8, 'sack'),
(9, 'carton'),
(10, 'locker'),
(11, 'tote'),
(12, 'sack'),
(13, 'shelf'),
(14, 'crate'),
(15, 'box'),
(16, 'cask'),
(17, 'bag'),
(18, 'rack'),
(19, 'drum'),
(20, 'shelf'),
(21, 'shelf'),
(22, 'canister'),
(23, 'bin'),
(24, 'drum'),
(25, 'packet'),
(26, 'canister'),
(27, 'vessel'),
(28, 'bucket'),
(29, 'vault'),
(30, 'bucket'),
(31, 'cask'),
(32, 'vessel'),
(33, 'rack');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` bigint(14) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category` int(5) NOT NULL,
  `stock` int(5) NOT NULL,
  `denomination` int(5) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `category`, `stock`, `denomination`, `selling_price`, `purchase_price`) VALUES
(11845378419434, 'SHINee keychain', 2081, 57, 27, 367259.00, 802018.00),
(14268809462842, 'Girls\' Generation hoodie', 2046, 80, 22, 932599.00, 555465.00),
(16140708740560, 'Super Junior pillow', 2096, 27, 19, 490803.00, 597151.00),
(16740309594175, 'f(x) hoodie', 2030, 95, 30, 358179.00, 551500.00),
(18910780264044, 'TVXQ! hoodie', 2076, 83, 13, 443376.00, 604591.00),
(19060552971462, 'TVXQ! lightstick', 2077, 5, 9, 774222.00, 416525.00),
(22018532049370, 'NCT 127 poster', 2012, 15, 27, 781509.00, 607843.00),
(22349927441718, 'TVXQ! t-shirt', 2070, 26, 9, 354707.00, 366493.00),
(23716887183096, 'Super Junior t-shirt', 2078, 16, 18, 862921.00, 334498.00),
(24109115363526, 'TVXQ! lightstick', 2095, 19, 31, 307262.00, 495736.00),
(27097006106868, 'NCT 127 poster', 2015, 3, 22, 370561.00, 440594.00),
(28284073862622, 'Girls\' Generation album', 2045, 37, 6, 904362.00, 529563.00),
(35137648412843, 'SuperM backpack', 2073, 3, 17, 970029.00, 650199.00),
(39418110033107, 'BoA t-shirt', 2092, 35, 23, 849837.00, 845552.00),
(39711467892208, 'BoA t-shirt', 2085, 26, 11, 926146.00, 964073.00),
(39741701040868, 'BoA hoodie', 2057, 88, 9, 798422.00, 916069.00),
(41883525339422, 'f(x) phone case', 2059, 6, 11, 622669.00, 643998.00),
(42070190421155, 'BoA hoodie', 2009, 100, 26, 460039.00, 624530.00),
(42634011337231, 'Red Velvet keychain', 2060, 20, 20, 777123.00, 874448.00),
(42763120945561, 'f(x) keychain', 2059, 76, 32, 983878.00, 323964.00),
(43848549410843, 'Super Junior hat', 2082, 6, 29, 353035.00, 934811.00),
(45504463150143, 'f(x) lightstick', 2013, 55, 7, 925870.00, 323586.00),
(47848309309342, 'NCT 127 poster', 2020, 48, 4, 334188.00, 389859.00),
(47963215977373, 'BoA album', 2075, 19, 16, 918356.00, 657903.00),
(50131859215903, 'Super Junior hat', 2094, 10, 15, 997988.00, 686859.00),
(50304647828027, 'TVXQ! socks', 2045, 2, 15, 308132.00, 878291.00),
(51613307071759, 'Super Junior t-shirt', 2078, 44, 18, 869088.00, 855352.00),
(58234494757127, 'f(x) t-shirt', 2067, 20, 9, 929716.00, 399110.00),
(64988836514844, 'NCT 127 lightstick', 2047, 92, 29, 580327.00, 712165.00),
(66137946217870, 'BoA poster', 2083, 12, 14, 950426.00, 567295.00),
(66654796215397, 'Super Junior lightstick', 2009, 52, 21, 441508.00, 738768.00),
(69009304063587, 'BoA album', 2053, 22, 5, 468071.00, 960195.00),
(74859203990525, 'SHINee poster', 2053, 95, 15, 598439.00, 404366.00),
(78337760275957, 'TVXQ! t-shirt', 2086, 91, 14, 916142.00, 444618.00),
(82332998222711, 'SuperM t-shirt', 2064, 22, 26, 741159.00, 859728.00),
(83007838534917, 'Super Junior poster', 2085, 42, 25, 988406.00, 712258.00),
(83958029059163, 'SHINee lightstick', 2091, 99, 19, 365062.00, 543432.00),
(86850913148061, 'Red Velvet t-shirt', 2020, 15, 21, 390592.00, 756700.00),
(87899703699304, 'EXO poster', 2015, 32, 8, 383312.00, 809628.00),
(89371495661556, 'SuperM poster', 2022, 17, 30, 580280.00, 669081.00),
(90702077227704, 'EXO hoodie', 2035, 78, 9, 809308.00, 709782.00),
(91443981403068, 'NCT 127 poster', 2033, 36, 21, 402283.00, 793134.00),
(96042603563594, 'TVXQ! poster', 2038, 72, 31, 805463.00, 641000.00),
(99145667602741, 'f(x) keychain', 2071, 16, 7, 986578.00, 344535.00),
(99394435857531, 'BoA hoodie', 2019, 69, 16, 657104.00, 789776.00);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `expenditure_total` decimal(10,2) NOT NULL,
  `receipt_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `datetime`, `expenditure_total`, `receipt_image`) VALUES
(1, '2024-02-13 07:25:18', 4000000.00, 'receipt.png'),
(2, '2024-02-15 07:31:00', 5000000.00, 'rabu_abu_2024.png');

-- --------------------------------------------------------

--
-- Table structure for table `selling`
--

CREATE TABLE `selling` (
  `selling_id` int(11) NOT NULL,
  `factur` char(12) NOT NULL,
  `datetime` datetime NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `payed_money` decimal(10,2) NOT NULL,
  `change_money` decimal(10,2) NOT NULL,
  `cashier` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `selling`
--

INSERT INTO `selling` (`selling_id`, `factur`, `datetime`, `grand_total`, `payed_money`, `change_money`, `cashier`) VALUES
(28, '202402290004', '2024-02-29 07:26:11', 3192363.00, 3200000.00, 7637.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `selling_details`
--

CREATE TABLE `selling_details` (
  `details_id` int(11) NOT NULL,
  `selling_id` int(11) NOT NULL,
  `factur` char(12) NOT NULL,
  `product_id` bigint(14) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `selling_details`
--

INSERT INTO `selling_details` (`details_id`, `selling_id`, `factur`, `product_id`, `quantity`, `price_total`) VALUES
(115, 28, '202402290005', 22349927441718, 9, 3192363.00);

--
-- Triggers `selling_details`
--
DELIMITER $$
CREATE TRIGGER `update_stock_selling` AFTER INSERT ON `selling_details` FOR EACH ROW UPDATE product
    SET stock = CASE
                    WHEN (stock - NEW.quantity) < 0 THEN 0
                    ELSE (stock - NEW.quantity)
                END
    WHERE product_id = NEW.product_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(35) NOT NULL,
  `role` enum('cashier','administrator','inventory_manager','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `name`, `password`, `role`) VALUES
('armin@yahoo.com', 'Armin', '12345678', 'inventory_manager'),
('peterparker@gmail.com', 'Peter Parker', 'aa890a4de63a97f87ca08ea36412c779', 'administrator'),
('raisa@gmail.com', 'Raisa', '25d55ad283aa400af464c76d713c07ad', 'cashier'),
('yanti@gmail.com', 'Yanti', '$2y$10$1y4WxmwNk', 'cashier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `denomination`
--
ALTER TABLE `denomination`
  ADD PRIMARY KEY (`denomination_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category` (`category`),
  ADD KEY `denomination` (`denomination`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `selling`
--
ALTER TABLE `selling`
  ADD PRIMARY KEY (`selling_id`);

--
-- Indexes for table `selling_details`
--
ALTER TABLE `selling_details`
  ADD PRIMARY KEY (`details_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `selling_id` (`selling_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2207;

--
-- AUTO_INCREMENT for table `denomination`
--
ALTER TABLE `denomination`
  MODIFY `denomination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `selling`
--
ALTER TABLE `selling`
  MODIFY `selling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `selling_details`
--
ALTER TABLE `selling_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `selling_details`
--
ALTER TABLE `selling_details`
  ADD CONSTRAINT `selling_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `selling_details_ibfk_2` FOREIGN KEY (`selling_id`) REFERENCES `selling` (`selling_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
