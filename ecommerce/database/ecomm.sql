-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 05:51 PM
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
-- Database: `ecomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(153, 9, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cat_slug` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `cat_slug`) VALUES
(1, 'Pantry and Snacks', 'Pantry and Snacks'),
(2, 'Personal Hygiene', 'Personal Hygiene'),
(3, 'Beverages', 'Beverages'),
(4, 'Dressings & Sauces', 'Dressings/Sauces');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `sales_id`, `product_id`, `quantity`) VALUES
(14, 9, 11, 2),
(15, 9, 13, 5),
(16, 9, 3, 2),
(17, 9, 1, 3),
(18, 10, 13, 3),
(19, 10, 2, 4),
(20, 10, 19, 5),
(23, 12, 20, 4),
(24, 12, 30, 3),
(25, 12, 18, 3),
(26, 12, 12, 4),
(27, 12, 4, 4),
(28, 13, 4, 7),
(29, 14, 20, 1),
(30, 15, 15, 1),
(31, 15, 27, 1),
(32, 16, 27, 3),
(33, 17, 2, 3),
(34, 17, 3, 3),
(35, 17, 21, 2),
(36, 17, 26, 2),
(37, 17, 25, 2),
(38, 17, 22, 2),
(39, 17, 28, 2),
(40, 17, 29, 2),
(41, 18, 2, 8),
(42, 19, 7, 7),
(43, 20, 20, 1),
(44, 20, 7, 1),
(45, 21, 7, 4),
(46, 21, 19, 1),
(47, 22, 7, 5),
(48, 23, 1, 1),
(49, 24, 20, 1),
(50, 25, 7, 1),
(51, 26, 7, 1),
(52, 26, 1, 1),
(53, 36, 7, 1),
(54, 36, 20, 5),
(55, 37, 1, 5),
(56, 38, 20, 10),
(57, 39, 25, 10),
(58, 40, 7, 10),
(59, 41, 20, 8),
(60, 42, 2, 10),
(61, 43, 7, 7),
(62, 44, 20, 7),
(63, 45, 2, 7),
(64, 46, 19, 1),
(65, 47, 20, 8),
(66, 48, 20, 5),
(67, 49, 2, 5),
(68, 50, 2, 7),
(69, 51, 20, 5),
(70, 52, 19, 2),
(71, 53, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `order_status` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_name`, `order_status`, `order_date`) VALUES
(18, 'Bradley Tan', 'Pending', '2023-04-27'),
(19, 'Bradley Tan', 'Delivered', '2023-04-27'),
(20, 'Bradley Tan', 'Pending', '2023-05-06'),
(21, 'Bradley Tan', 'Pending', '2023-05-06'),
(22, 'Bradley Tan', 'Pending', '2023-05-06'),
(23, 'Bradley Tan', 'Pending', '2023-05-06'),
(24, 'Bradley Tan', 'Pending', '2023-05-06'),
(25, 'Bradley Tan', 'Pending', '2023-05-09'),
(26, 'Bradley Tan', 'Pending', '2023-05-09'),
(27, 'dark seid', 'Pending', '2023-05-09'),
(28, 'dark seid', 'Pending', '2023-05-09'),
(29, 'dark seid', 'Pending', '2023-05-09'),
(30, 'dark seid', 'Pending', '2023-05-09'),
(31, 'dark seid', 'Pending', '2023-05-09'),
(32, 'dark seid', 'Pending', '2023-05-09'),
(33, 'dark seid', 'Pending', '2023-05-09'),
(34, 'dark seid', 'Pending', '2023-05-09'),
(35, 'dark seid', 'Pending', '2023-05-09'),
(36, 'dark seid', 'Pending', '2023-05-24'),
(37, 'dark seid', 'Pending', '2023-05-24'),
(38, 'dark seid', 'Pending', '2023-05-24'),
(39, 'dark seid', 'Pending', '2023-05-24'),
(40, 'dark seid', 'Pending', '2023-05-24'),
(41, 'dark seid', 'Pending', '2023-05-24'),
(42, 'dark seid', 'Pending', '2023-05-24'),
(43, 'dark seid', 'Pending', '2023-05-24'),
(44, 'dark seid', 'Pending', '2023-05-24'),
(45, 'dark seid', 'Pending', '2023-05-24'),
(46, 'dark seid', 'Pending', '2023-05-26'),
(47, 'dark seid', 'Pending', '2023-05-26'),
(48, 'dark seid', 'Pending', '2023-05-26'),
(49, 'dark seid', 'Pending', '2023-05-26'),
(50, 'dark seid', 'Pending', '2023-05-26'),
(51, 'dark seid', 'Pending', '2023-05-26'),
(52, 'Bradley Tan', 'Pending', '2023-05-26'),
(53, 'Bradley Tan', 'Pending', '2023-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `payment_card`
--

CREATE TABLE `payment_card` (
  `id` int(11) NOT NULL,
  `card_name` varchar(50) NOT NULL,
  `exp_month` int(2) NOT NULL,
  `exp_year` int(2) NOT NULL,
  `card_num` varchar(16) NOT NULL,
  `card_verify` int(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_card`
--

INSERT INTO `payment_card` (`id`, `card_name`, `exp_month`, `exp_year`, `card_num`, `card_verify`, `created_at`, `user_id`) VALUES
(1, 'Manoj', 1, 2023, '1234123412341234', 1, '2023-05-06 12:40:50', 17),
(2, 'Dark seid', 1, 2025, '213424243453555', 1, '2023-05-09 17:32:52', 9),
(3, 'dfsdssweew', 1, 2023, '1252458523212512', 1, '2023-05-23 03:28:23', 9);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `products_quantity` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `date_view` date NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `slug`, `price`, `products_quantity`, `photo`, `date_view`, `counter`) VALUES
(1, 1, 'Campbells Cream Of Mushroom Condensed Soup (420g)', '<p><var>Customize and create with this Cream of Mushroom Soup, which starts with mushrooms, garlic, and farm fresh cream for a smooth flavor. Or, make it the start of your next weeknight meal, like the crowd-pleasing Swedish meatballs and easy one-pot beef stroganoff. With high-quality ingredients, this canned soup always delivers feel-good nourishment. Campbell&rsquo;s Cream of Mushroom Soup is made with no preservatives.</var></p>\r\n\r\n<p><strong>(Expiry Date : 5/7/2025)</strong></p>\r\n', 'campbells-cream-of-mushroom-condensed-soup-420g', 5.29, 10, 'campbells-cream-of-mushroom-condensed-soup-420g_1680666629.webp', '2023-05-26', 3),
(2, 1, 'Hosen Choice Whole Mushroom (425g)', '<p><var>Hosen Choice Whole Mushroom is made from freshly picked mushrooms and immediately packed to seal in all the tangy goodness! Hosen Choice Whole Mushroom are delicious, tender yet firm in texture for the healthy choice for the entire family.</var></p>\r\n\r\n<p><strong>(Expiry Date : 5/7/2025)</strong></p>\r\n', 'hosen-choice-whole-mushroom-425g', 5.65, 0, 'hosen-choice-whole-mushroom-425g_1682446756.png', '2023-05-26', 10),
(3, 1, 'Hosen Longan in Syrup (565g)', '<p><var>Hosen Longan in Syrup is made from freshly picked longan fruits from the trees and immediately packed to seal in all the tangy goodness! Hosen Longan are delicious, tender yet firm in texture for the healthy choice for the entire family.</var></p>\r\n\r\n<p><strong>(Expiry Date : 5/8/2025)</strong></p>\r\n', 'hosen-longan-syrup-565g', 9.5, 10, 'hosen-longan-syrup-565g_1682447059.png', '2023-05-14', 2),
(4, 1, 'Barilla Spaghetti No.5 (500g )', '<p><var>Spaghetti pasta is the most popular pasta shape in Italy. The name comes from the Italian word spaghi, which means &quot;&quot;lengths of cord.&quot;&quot; Spaghetti pasta originates from the south of Italy and is commonly used with tomato pasta sauces, fresh vegetables, or fish. Barilla Spaghetti pasta is made from the finest durum wheat and is non-GMO verified, peanut-free and suitable for a vegan or vegetarian diet.</var></p>\r\n\r\n<ul>\r\n	<li>Cooks to Perfection Every Time: Perfect pasta in 10-11 minutes.</li>\r\n	<li>Barilla Spaghetti pasta pairs well with just about any kind of pasta sauce.</li>\r\n	<li>Try pairing spaghetti pasta with a simple tomato pasta sauce, with or without meat or vegetables, try it with a fish or oil-based pasta sauce or a carbonara.</li>\r\n	<li>Made with 100% durum wheat and water.</li>\r\n	<li>Lactose, peanut, shell fish, fish, tree nut, and soy free.</li>\r\n	<li>Suitable for vegetarians.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 3/3/2024)</strong></p>\r\n', 'barilla-spaghetti-no-5-500g', 7.49, 20, 'barilla-spaghetti-pasta_1682448010.jpg', '2023-05-14', 1),
(5, 1, 'Lay\'s Classic Potato Chips, Party Size (368g)', '<p><var>It starts with farm-grown potatoes- cooked and seasoned to perfection. Then we add the tang of sour cream and sharp cheddar. So every Lay&#39;s potato chip is perfectly crispy and delicious. Happiness in every bite. The shareable size is perfect for your next party or gathering.</var></p>\r\n\r\n<p><strong>Lay&#39;s Classic Potato Chips, Party Size, 13 oz Bag:</strong></p>\r\n\r\n<ul>\r\n	<li>Includes 1 (13oz) bag of Lay&#39;s Potato Chips, Classic Flavor.</li>\r\n	<li>Farm-grown potatoes seasoned with just the right amount of salt.</li>\r\n	<li>Only 3 Ingredients: Potatoes, Vegetable Oil, and SaltLay&#39;s Classic Potato chips are made with no artificial flavors, no preservatives, and are Gluten Free.</li>\r\n	<li>Delicious alone or when with your favorite onion dip.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 3/6/2024)</strong></p>\r\n', 'lay-s-classic-potato-chips-party-size-368g', 12.99, 10, 'lay-s-classic-potato-chips-party-size-13-oz-bag_1680667090.webp', '2023-05-14', 1),
(6, 1, 'OREO Chocolate Sandwich Cookies, Party Size (325g)', '<p><var>Take a delicious break with OREO Chocolate Sandwich Cookies, America&#39;s favorite sandwich cookie for over 100 years.&nbsp;Supremely dunkable, OREO cookies sandwich a rich creme filling between the bold taste of two chocolate wafers.</var></p>\r\n\r\n<ul>\r\n	<li>Chocolate wafers filled with original OREO creme.</li>\r\n	<li>Party size sandwich cookies are perfectly dunkable.</li>\r\n	<li>Resealable package helps keep snack cookies fresh.</li>\r\n	<li>100% Sustainably Sourced Cocoa see Cocoa Life website for details.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date:18/3/2025)</strong></p>\r\n', 'oreo-chocolate-sandwich-cookies-party-size-325g', 6.5, 10, 'oreo-chocolate-sandwich-cookies-easter-snacks-party-size-25-5-oz_1680667178.webp', '2023-04-19', 1),
(7, 2, 'Oral-B CrossAction All In One Soft Toothbrushes, Deep Plaque Removal (6 pcs)', '<ul>\r\n	<li>You will receive 6 Oral-B Cross Action All-In-One toothbrushes.</li>\r\n	<li>Removes up to 99% of plaque in hard-to-reach areas based on a single-use brushing study.</li>\r\n	<li>CrossAction bristles attack plaque with every stroke.</li>\r\n	<li>Tongue and cheek cleaner removes odor-causing bacteria.</li>\r\n	<li>Gum stimulators gently massage gums.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n', 'oral-b-crossaction-all-one-soft-toothbrushes-deep-plaque-removal-6-pcs', 22.99, 7, 'oral-b-crossaction-all-one-soft-toothbrushes-deep-plaque-removal-6-pcs_1680667275.jpg', '2023-05-29', 1),
(8, 1, 'Doritos Nacho Cheese Flavored Tortilla Chips, Party Size (411g)', '<p><var>DORITOS isn&rsquo;t just a chip. It&rsquo;s fuel for disruption &mdash; our flavors ignite adventure and inspire action. With every crunch of these nacho cheese tortilla chips, we aim to redefine culture and support those who are boldly themselves. Are you ready? If so, crunch on. These crispy tortilla chips are perfect for sharing with family and friends.</var></p>\r\n\r\n<ul>\r\n	<li>Includes 1 (14.5oz) Party Size bag of Doritos Tortilla chips, Nacho Cheese flavor</li>\r\n	<li>Delicious nacho cheese flavor</li>\r\n	<li>Flavor on Another Level</li>\r\n	<li>Great anytime snack</li>\r\n	<li>Party size bag is perfect for sharing&nbsp;</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 22/5/2024)</strong></p>\r\n', 'doritos-nacho-cheese-flavored-tortilla-chips-party-size-411g', 11.99, 10, 'doritos-nacho-cheese-flavored-tortilla-chips-party-size-14-5-oz-bag_1680667356.webp', '0000-00-00', 0),
(9, 2, 'Dove Deep Moisture Body Wash (650ml)', '<p><var>Just as everyone&#39;s skin is different, skin dryness can appear differently for everyone. From mild, occasionally dry skin driven by ageing, weather fluctuations or just life! To dry patches and skin dryness . No matter how dry your skin may look or feel, Dove has got you covered. Dove Deep Moisture body wash transforms even the driest skin in just one shower leaving you with softer smoother skin.&nbsp;</var></p>\r\n\r\n<ul>\r\n	<li>Dove Deep Moisture Body wash transforms even the driest skin in just one shower.</li>\r\n	<li>Moisturizing body wash that&rsquo;s made with Microbiome Nutrient Serum to nourish skin and its microbiome.</li>\r\n	<li>Cleanser with 98% biodegradable formula packaged in a 100% recycled plastic bottle.</li>\r\n	<li>Moisturize skin with this hydrating body wash for dry skin.</li>\r\n	<li>Sulfate and paraben free body wash.</li>\r\n</ul>\r\n', 'dove-deep-moisture-body-wash-650ml', 18.9, 10, 'dove-deep-moisture-body-wash_1680667432.jpg', '2023-05-17', 2),
(10, 2, 'CeraVe Daily Moisturizing Lotion for Dry Skin (562ml)', '<ul>\r\n	<li><strong>[DAILY MOISTURIZING LOTION]</strong> Smooth, light-weight texture that is absorbed quickly, leaving skin feeling smooth and hydrated, never greasy.</li>\r\n	<li><strong>[LONG-LASTING HYDRATION]</strong> Contains Hyaluronic Acid to help retain skins natural moisture and MVE technology to provide 24 hour hydration.</li>\r\n	<li><strong>[GENTLE ON SKIN]</strong> Holds National Eczema Association (NEA) Seal of Acceptance. Fragrance free, allergy-tested, non-comedogenic, and suitable for use as a body lotion, face moisturizing lotion, and/or hand lotion.</li>\r\n	<li><strong>[3 ESSENTIAL CERAMIDES]</strong> Ceramides are found naturally in the skin and make up 50% of the lipids in the skin barrier. All CeraVe products are formulated with three essential ceramides (1, 3, 6-II) to help restore and maintain the skin&rsquo;s natural barrier.</li>\r\n	<li><strong>[DEVELOPED WITH DERMATOLOGISTS]</strong> CeraVe Skincare is developed with dermatologists and has products suitable for dry skin, sensitive skin, oily skin, acne-prone, and more.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 3/4/2026)</strong></p>\r\n', 'cerave-daily-moisturizing-lotion-dry-skin-562ml', 119, 10, 'cerave-daily-moisturizing-lotion-dry-skin_1680667633.jpg', '2023-05-13', 2),
(11, 2, ' Sunsilk Nourishing Soft and Smooth Shampoo (340ml)', '<p><var>Sunsilk Nourishing Soft &amp; Smooth Shampoo nourishes hair deeply, and makes it beautifully soft and smooth.</var></p>\r\n\r\n<ul>\r\n	<li>Quantity - 1 bottle of 360ml</li>\r\n	<li>It contains Argan oil, Babasu oil, Almond oil, Camellia oil &amp; Coconut Oil to nourish your hair.</li>\r\n	<li>Its unique blend of five natural oils and exclusive formula nourishes hair deeply without making it greasy or limp.</li>\r\n	<li>Its fresh perky fragrance works from the first wash, to keep your hair&rsquo;s texture silky soft and smooth.</li>\r\n</ul>\r\n', 'sunsilk-nourishing-soft-and-smooth-shampoo-340ml', 12.99, 15, 'sunsilk-nourishing-soft-and-smooth-shampoo-340ml_1680668548.jpg', '2018-05-12', 1),
(12, 2, 'Head and Shoulders (430ml)', '<p><cite><small><big>Head and Shoulders Dandruff Shampoo, Classic Clean, 8.45 Fl OzHead &amp; Shoulders Classic Clean Shampoo provides proven protection from flakes, itch, oil and dryness with regular use to ensure that your scalp is at its best and your locks are 100% flake-free.</big></small></cite></p>\r\n\r\n<ul>\r\n	<li>Head &amp; Shoulders Classic Clean anti-dandruff shampoo fights flakes with a deep, clean feeling.</li>\r\n	<li>#1 dermatologist recommended dandruff brand.</li>\r\n	<li>Clinically proven.</li>\r\n	<li>Anti-dandruff shampoo with Head &amp; Shoulders classic fragrance.</li>\r\n	<li>pH balanced and gentle enough for everyday use, even on color or chemically treated hair.</li>\r\n</ul>\r\n', 'head-and-shoulders-430ml', 13.99, 15, 'head-and-shoulders_1680668629.webp', '2023-04-19', 1),
(13, 2, 'Colgate Total Whitening Toothpaste,  272g (Pack of 2)', '<p><var>Colgate Total Teeth Whitening Toothpaste leaves your mouth feeling fresh after every brush. This sugar-free and gluten-free whitening toothpaste not only helps remove stains for whiter teeth, but also keeps your whole mouth healthy by fighting bacteria on teeth, tongue, cheeks, and gums for 12 hours.</var></p>\r\n\r\n<ul>\r\n	<li>Two 4.8 oz tubes of Colgate Total Teeth Whitening Toothpaste.</li>\r\n	<li><strong>42%&nbsp;more sensitivity relief</strong> (versus a regular fluoride toothpaste after 8 weeks of use).</li>\r\n	<li>Get <strong>10 benefits</strong> and no trade-offs with Colgate Total toothpaste.</li>\r\n	<li>Use Colgate Total Whitening gel toothpaste to remove surface stains for a whiter, brighter smile.</li>\r\n	<li>Mint toothpaste leaves mouth feeling clean and breath refreshed.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 25/6/2026)</strong></p>\r\n', 'colgate-total-whitening-toothpaste-272g-pack-of-2', 25.99, 15, 'colgate-total-whitening-toothpaste-sensitivity-relief-and-cavity-protection-mint-4-8-oz-pack-of-2_1680668432.jpg', '2023-05-24', 1),
(14, 2, 'Vaseline Original (100ml)', '<p><var>Vaseline Original Is An All-time Cult-Favorite To Fight Dryness And Provide Gloss And Conditioning.</var></p>\r\n\r\n<ul>\r\n	<li>A specialized formulation for deep nourishment.</li>\r\n	<li>Promises a natural and glossy shine.</li>\r\n	<li>Aids in locking in the moisture for long-lasting moisturization.</li>\r\n</ul>\r\n\r\n<p>A one-venture formula for dry and damaged skin, the Vaseline Original secures moisture and hydration to recuperate minor skin scratches and rashes along with saturating the face and hands to reestablish dry and damaged skin.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'vaseline-original-100ml', 8.99, 15, 'vaseline-original-100ml_1680668309.webp', '2023-05-24', 1),
(15, 2, 'Pantene Pro-V Smooth and Sleek Shampoo (745ml)', '<p><var>These formulas are crafted with protective antioxidants, Pro-Vitamin B5, and pH balancers, and made without parabens or colorants. This color-safe conditioner is gentle enough for everyday use on chemically-treated hair or color-treated hair, and gives you results that last for 72 plus hours without washing. For strands in need of extra moisture and repair follow with the Pantene Miracle.</var></p>\r\n\r\n<ul>\r\n	<li><strong>HARD WORKING</strong> Fuels hair with a potent blend of Pro-V nutrients and antioxidants so hair is shiny and free of frizz.</li>\r\n	<li><strong>LONG LASTING</strong> Gently conditions with a vitamin-rich formula with 2x more nutrients, with results that last 72 plus hours.</li>\r\n	<li><strong>SMOOTHNESS WITH EVERY WASH</strong> Soften stubborn strands to smooth hair for lasting frizz control.</li>\r\n	<li><strong>ROOT TO TIP NOURISHMENT</strong> These powerful Smooth &amp; Sleek formulas work together to permeate every strand, smoothing hair from the inside out.</li>\r\n	<li><strong>HAIR MASK SHOT</strong> dry hair moisturizing treatment noticeably repairs extreme damage in 1 use.</li>\r\n	<li>This is the NEW version of this item.</li>\r\n</ul>\r\n', 'pantene-pro-v-smooth-and-sleek-shampoo-745ml', 16.99, 15, 'pantene-conditioner-hair-treatment-set_1680668246.jpg', '2023-04-27', 1),
(16, 2, 'Colgate Cavity Protection Toothpaste with Fluoride (225g) ', '<p><var>Colgate Cavity Protection Toothpaste with Fluoride provides trusted cavity protection for the entire family. Formulated with active fluoride, this toothpaste is clinically proven to help strengthen teeth and leave your mouth feeling fresh and clean. This Colgate toothpaste is ADA (American Dental Association) accepted. It has been trusted by dentists and parents globally for over 45 years.</var></p>\r\n\r\n<ul>\r\n	<li>Cleans teeth thoroughly.</li>\r\n	<li>Strengthens teeth enamel with active fluoride.</li>\r\n	<li>Great mint taste.</li>\r\n	<li>Anticavity fluoride toothpaste.</li>\r\n	<li>Gluten free.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 25/2/2026)</strong></p>\r\n', 'colgate-cavity-protection-toothpaste-fluoride-225g', 12.99, 15, 'colgate-cavity-protection-toothpaste-fluoride-6-ounce-pack-of-6_1680198898.jpg', '2023-03-30', 5),
(17, 1, 'Muesli Fitness Nutritious Energy,  Gluten Free (500G)', '<p>Cereals (Whole Grain Oat Flakes, Whole Grain Oat Flour), Oat Crisps (Whole Grain Oat Flour, Rice Flour, Wheat Flour, Sugar, Barley Malt Flour, Salt), Sugar Syrup (Sugar, Invert Sugar Syrup, Molasses), Sunflower Oil Non-Hydrogenated, Isomaltulose, Dried Cranberries, Pumpkin Seeds, Glucose Syrup Powder, Wheat Flakes (Wheat, Barley Malt Extract, Emulsifier from Plant Origin: Sunflower Lecithin), Acidity Regulator: Citric Acid, Salt, Antioxidant: Tocopherols. Minerals: Calcium, Iron.</p>\r\n\r\n<p>Contains Cereals containing Gluten. May contain Cow&#39;s Milk, Soyabeans and Nuts. Free from pork products and their derivatives.</p>\r\n\r\n<p><strong>(Expiry Date:23/2/2024)</strong></p>\r\n', 'muesli-fitness-nutritious-energy-gluten-free-500g', 19.5, 15, 'muesli-fitness-nutritious-energy-gluten-free-500g_1680116899.jpg', '2023-03-30', 1),
(18, 2, 'Cetaphil Daily Facial Cleanser (473ml)', '<ul>\r\n	<li>CETAPHIL FRAGRANCE FREE DAILY FACIAL CLEANSER: Reinforces the skin barrier, balances skin and minimizes the appearance of pores, now in a fragrance free formula.</li>\r\n	<li><strong>IDEAL FOR SENSITIVE, COMBINATION TO OILY SKIN :</strong>&nbsp;Clinically proven to deep clean by removing dirt, excess oils, impurities and pollution microparticles.</li>\r\n	<li><strong>DEVELOPED FOR EVEN THE MOST SENSITIVE SKIN :&nbsp;</strong>The hypoallergenic, non-comedogenic formula is free of parabens and sulfates.</li>\r\n	<li><strong>DERMATOLOGIST RECOMMENDED</strong> for Sensitive Skin.</li>\r\n	<li><strong>DEFENDS AGAINST 5 SIGNS OF SKIN SENSITIVITY :</strong> Dryness, irritation, roughness, tightness and a weakened skin barrier.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 5/6/2026)</strong></p>\r\n', 'cetaphil-daily-facial-cleanser-473ml', 39.99, 15, 'cetaphil-face-wash-16-oz-fragrance-free-gentle-foaming_1680667904.jpg', '2023-04-19', 1),
(19, 2, 'Listerine Total Care Anticavity Fluoride Mouthwash (1L)', '<ul>\r\n	<li><strong>FLUORIDE ANTICAVITY MOUTHWASH:</strong> 1-liter family size of Listerine Fluoride Anticavity Mouthwash in fresh mint flavor to improve oral health by helping to prevent cavities, strengthening teeth, and leaving a refreshing, clean feeling you can taste.</li>\r\n	<li><strong>6-IN-1 BENEFITS:</strong> Fluoride-rich mint mouthwash offers six dental hygiene benefits in one oral rinse to kill germs that cause bad breath, strengthen teeth, help prevent cavities, restore enamel, clean your mouth and freshen breath.</li>\r\n	<li><strong>50% STRONGER TEETH*: </strong>Anticavity fresh mint remineralizing mouthwash freshens breath while strengthening teeth 50% more than brushing alone, according to laboratory studies *vs brushing alone.</li>\r\n	<li><strong>PROTECTS DAY AND NIGHT :</strong> Help protect your mouth by adding a 60-second rinse of this powerful anticavity total care mouthwash to your morning and evening oral care routines.</li>\r\n</ul>\r\n\r\n<p><strong>ADA ACCEPTED:</strong> With approximately 7 weeks of supply, this multibenefit oral rinse in a refreshing Fresh Mint Flavor helps prevent tooth decay and is accepted by the American Dental Association&#39;s (ADA) Seal of Acceptance Program.</p>\r\n\r\n<p><strong>(Expiry date: 2/4/2026)</strong></p>\r\n', 'listerine-total-care-anticavity-fluoride-mouthwash-1l', 15.99, 5, 'listerine-total-care-anticavity-fluoride-mouthwash-helps-kill-99-of-bad-breath-germs-fresh-mint-1l_1680667796.jpg', '2023-05-26', 7),
(20, 3, 'Coca-Cola Soda Pop, 360ml (24 Pack Cans)', '<p><var>Soda.Pop.Soft drink. Sparkling beverage.Whatever you call it, nothing compares to the refreshing, crisp taste of Coca-Cola Original Taste, the delicious soda you know and love. Enjoy with friends, on the go or with a meal. Whatever the occasion, wherever you are, Coca-Cola Original Taste makes life&rsquo;s special moments a little bit better.</var></p>\r\n\r\n<ul>\r\n	<li>24 cans of Coca-Cola Original Taste&mdash;the refreshing, crisp taste you know and love.</li>\r\n	<li>Great taste since 1886.</li>\r\n	<li>34 mg of caffeine in each 12 oz serving.</li>\r\n	<li>12 FL OZ in each can.</li>\r\n	<li>This sparkling beverage is best enjoyed ice-cold for maximum refreshment.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 24/2/2024)</strong></p>\r\n', 'coca-cola-soda-pop-360ml-24-pack-cans', 34.99, 0, 'coca-cola-soda-pop-12-fl-oz-24-pack-cans_1680666387.webp', '2023-05-26', 10),
(21, 1, 'Ayam Brand Tuna Flakes in Water Light (150g)', '<ul>\r\n	<li>Fine flakes* of tuna</li>\r\n	<li>In vegetable broth for savory</li>\r\n	<li>98% reduced fat compared to Tuna flakes in Sunflower oil</li>\r\n	<li>150g</li>\r\n</ul>\r\n\r\n<p>*Ayam Brand&trade; tuna flakes are made off tuna chunks that are broken down mechanically. Hence you benefits from the same best tuna quality chunks in smaller pieces for a better mix in any recipe. Broken chunks absorb the vegetable broth and give the tuna a unique juicy texture.</p>\r\n\r\n<p>All Ayam Brand&trade; products contain <strong>no preservatives and no added MSG</strong>.</p>\r\n\r\n<p><strong>(Expiry Date : 5/5/2025)</strong></p>\r\n', 'ayam-brand-tuna-flakes-water-light-150g', 7.29, 0, 'ayam-brand-tuna-flakes-water-light-150g_1682446255.jpg', '2023-04-27', 1),
(22, 4, 'Kewpie Roasted Sesame Dressing (210ml)', '<p><var>Bring out the flavours of your food with&nbsp;<strong>KEWPIE ROASTED SESAME DRESSING</strong>. This nutty, creamy dressing can be used in a variety of ways from salad to meat dishes or even for steamboat. No added MSG.</var></p>\r\n\r\n<p><strong>(Expiry Date : 4/5/2024)</strong></p>\r\n', 'kewpie-roasted-sesame-dressing-210ml', 9.9, 20, 'kewpie-roasted-sesame-dressing-210ml_1682447367.webp', '2023-05-11', 1),
(23, 4, 'Chef Antonio Extraordinary Garlic Dipping and Pizza Sauce (354ml)', '<p><var>Chef Antonio Extraordinary Garlic Dipping and Pizza Sauce adds the perfect finish of garlicky goodness. This sauce is a must-try for anyone who loves the bold flavors of garlic combined in a savory blend ideal for dipping vegetables, chips, pizza crusts, and even the whole pizza slice to send your taste buds into flavor heaven.&nbsp;</var></p>\r\n\r\n<ul>\r\n	<li>Rich, bold, and savory garlic sauce.</li>\r\n	<li>Perfect for use as a dipping sauce for vegetables, chips, and other snacks for dipping pizza crusts and even whole slices for mouth-watering garlicky goodness.</li>\r\n	<li>Great for anyone who just can&#39;t get enough of a smooth and delicious garlic taste.</li>\r\n	<li>Create the ultimate appetizer sure to get everyone raving at your next party, get-together, pot luck, and more.</li>\r\n	<li>12 fluid ounce bottle.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 3/6/2025)</strong></p>\r\n', 'chef-antonio-extraordinary-garlic-dipping-and-pizza-sauce-354ml', 13.99, 20, 'chef-antonio-extraordinary-garlic-dipping-and-pizza-sauce-12-ounce-bottle_1680668176.jpeg', '2023-05-24', 1),
(24, 3, 'Pepsi Cola Soda Pop, 360ml (24 Pack Cans)', '<p><var>Enjoy the sweet taste of Pepsi Cola soda. They come in a pack of 24 cans and each contains 12 fl oz. You can share them with others or save them for yourself to drink. Perfect for parties, meals, and anywhere you need to make a big impression. This 12 fl oz Pepsi is free of sugar and fat. It&#39;s suitable for sporting events and holidays.&nbsp;</var></p>\r\n\r\n<p><strong>Pepsi Soda, 12 oz Cans, 24 Count:</strong></p>\r\n\r\n<ul>\r\n	<li>Includes 12-oz cans.</li>\r\n	<li>150 calories per can.</li>\r\n	<li>No fat.</li>\r\n	<li>No cholesterol .</li>\r\n	<li>Low sodium .</li>\r\n	<li>Recyclable cans.</li>\r\n	<li>24-pack Pepsi is a caffeinated soft drink .</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 3/3/2025)</strong></p>\r\n', 'pepsi-cola-soda-pop-360ml-24-pack-cans', 34.99, 20, 'pepsi-cola-soda-pop-12-oz-cans-24-pack.webp', '2023-05-24', 1),
(25, 3, 'MARIGOLD UHT 100% APPLE JUICE (1L)', '<p>Marigold 100% Juice Apple 1 Liter.<br />\r\n<br />\r\nISO 9001 QMS &amp; 22000 FSMS CertifiedHACCP Food Safety System in Place.</p>\r\n\r\n<p><strong>(Expiry Date:18/7/2024)</strong></p>\r\n', 'marigold-uht-100-apple-juice-1l', 5.99, 7, 'marigold-uht-100-apple-juice-1l.png', '2023-05-25', 1),
(26, 3, 'MARIGOLD UHT 100% ORANGE JUICE (1L)', '<p>ISO 9001 QMS &amp; 22000 FSMS CertifiedHACCP Food Safety System in Place.</p>\r\n\r\n<p><strong>(Expiry Date:18/7/2024)</strong></p>\r\n', 'marigold-uht-100-orange-juice-1l', 5.99, 15, 'marigold-uht-100-orange-juice-1l.png', '2023-05-24', 1),
(27, 3, 'VSOY MULTI GRAIN S/BEAN UHT (1L)', '<p>V-Soy Multigrain No Sugar Added is made from high-quality whole soybean and another four selected natural grains. It does not add any cane sugar and lactose-free.</p>\r\n\r\n<p>With our exclusive recipe, V-Soy Multigrain No Sugar Added is a delicious soy drink with smooth and high fiber.</p>\r\n\r\n<p><strong>(Expiry Date:18/4/2025)</strong></p>\r\n', 'vsoy-multi-grain-s-bean-uht-1l', 5.69, 18, 'vsoy-multi-grain-s-bean-uht-1l_1682609584.png', '2023-04-28', 1),
(28, 4, 'PREGO MUSHROOM PASTA SAUCE (350g)', '<p>Prego Mushroom Tomato Pasta Sauce 350g<br />\r\n<br />\r\nTomatoes,Sugar,Mushrooms,Canola Oil,Salt,Herbs,Onions,Garlic,Spices,Acidity Regulator (INS330),</p>\r\n\r\n<p>Contains Permitted Flavoring Substance.</p>\r\n\r\n<p><strong>(Expiry Date : 20/5/2026)</strong></p>\r\n', 'prego-mushroom-pasta-sauce-350g', 7.65, 15, 'prego-mushroom-pasta-sauce-350g.png', '2023-04-28', 1),
(29, 4, 'HEINZ CHILLI SAUCE (320g)', '<p>Heinz Chilli Sauce 320g<br />\r\n<br />\r\n<em>Sugar,Chili,Salt,Tomato Paste,Starch,Vinegar,Garlic,Contains Permitted Food Conditioner (E260, E330, E300),</em></p>\r\n\r\n<p><em>Contains Permitted Preservative (E211),Spices.</em></p>\r\n\r\n<p>Heinz Chilli Sauce uses the only freshest and purest chillies to make the best chilli sauce recipe.&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Great for adding a kick of flavor to burger and fries.</li>\r\n	<li>Classic for glass bottle - Perfect for table top use.</li>\r\n	<li>Cap features a tamper-evident seal with a safety &quot;pop-up&quot; button.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 22/9/2025)</strong></p>\r\n', 'heinz-chilli-sauce-320g', 6.9, 15, 'heinz-chilli-sauce-320g.png', '2023-04-27', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_id` varchar(50) NOT NULL,
  `sales_date` date NOT NULL,
  `ship_name` varchar(100) NOT NULL,
  `ship_contact` varchar(25) NOT NULL,
  `street1` varchar(255) NOT NULL,
  `street2` varchar(255) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `orderStatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `pay_id`, `sales_date`, `ship_name`, `ship_contact`, `street1`, `street2`, `postcode`, `city`, `state`, `country`, `orderStatus`) VALUES
(18, 17, 'CC - 2626585485485486', '2023-04-27', 'Manoj', '0123456789', 'Street1', 'Street2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(19, 17, 'CC - 26548598635214', '2023-04-27', 'Manoj', '0123456789', 'Street1', 'Street2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Delivered'),
(20, 17, 'CC - 1234123412341234', '2023-05-06', 'Manoj', '0123456789', 'Street1, ', 'Street2, ', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(21, 17, 'CC - 1234567812345678', '2023-05-06', 'Manoj', '0123456789', 'Street 1', 'Street 2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(22, 17, 'CC - 1234567812345678', '2023-05-06', 'Manoj', '0123456789', 'Street 1', 'Street 2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(23, 17, 'CC - 1234567812345678', '2023-05-06', 'Manoj', '0123456789', 'Street 1', 'Street 2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(24, 17, 'CC - 1234123412341234', '2023-05-06', 'Manoj', '0123456789', 'Street 1', 'Street 2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(25, 17, 'CC - 1234123412341234', '2023-05-09', 'Manoj', '0123456789', 'STREET1', 'STREET2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(26, 17, 'CC - 1234123412341234', '2023-05-09', 'Manoj', '0123456789', 'STREET1', 'STREET2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(27, 9, 'CC - 213424243453555', '2023-05-09', 'Darkseid', '0122343454', 'address1', 'address2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(28, 9, 'CC - 213424243453555', '2023-05-09', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(29, 9, 'CC - 213424243453555', '2023-05-09', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(30, 9, 'CC - 213424243453555', '2023-05-09', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(31, 9, 'CC - 213424243453555', '2023-05-09', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(32, 9, 'CC - 213424243453555', '2023-05-09', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(33, 9, 'CC - 213424243453555', '2023-05-09', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(34, 9, 'CC - 213424243453555', '2023-05-09', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(35, 9, 'CC - 213424243453555', '2023-05-09', 'Darkseid', '0123456789', 'address1', 'address2', '75350', 'melaka', 'Melaka', 'Malaysia', 'Pending'),
(36, 9, 'CC - 213424243453555', '2023-05-24', 'Hhashd', '0124548578', 'wweq', 'qweqwe', '75450', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(37, 9, 'CC - 213424243453555', '2023-05-24', 'Hhashd', '0124548578', 'wweq', 'qweqwe', '75450', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(38, 9, 'CC - 213424243453555', '2023-05-24', 'Hhashd', '0124548578', 'wweq', 'qweqwe', '75450', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(39, 9, 'CC - 213424243453555', '2023-05-24', 'Hhashd', '0124548578', 'wweq', 'qweqwe', '75450', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(40, 9, 'CC - 213424243453555', '2023-05-24', 'Hhashd', '0124548578', 'wweq', 'qweqwe', '75450', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(41, 9, 'CC - 213424243453555', '2023-05-24', 'Hhashd', '0124548578', 'wweq', 'qweqwe', '75450', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(42, 9, 'CC - 213424243453555', '2023-05-24', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(43, 9, 'CC - 213424243453555', '2023-05-24', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(44, 9, 'CC - 213424243453555', '2023-05-24', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(45, 9, 'CC - 213424243453555', '2023-05-24', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka', 'Melaka', 'Malaysia', 'Pending'),
(46, 9, 'CC - 213424243453555', '2023-05-26', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(47, 9, 'CC - 213424243453555', '2023-05-26', 'Darkseid', '0123456789', 'address1', 'address2', '75450', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(48, 9, 'CC - 213424243453555', '2023-05-26', 'Darkseid', '0123456789', 'address1', 'address2', '75350', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(49, 9, 'CC - 213424243453555', '2023-05-26', 'Darkseid', '0123456789', 'address1', 'address2', '75350', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(50, 9, 'CC - 213424243453555', '2023-05-26', 'Darkseid', '0123456789', 'address1', 'address2', '75350', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(51, 9, 'CC - 213424243453555', '2023-05-26', 'Darkseid', '0123456789', 'address1', 'address2', '75350', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(52, 17, 'CC - 1234123412341234', '2023-05-26', 'Manoj', '0123456789', 'address1', 'address2', '75450', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending'),
(53, 17, 'CC - 1234123412341234', '2023-05-26', 'Manoj', '0123456789', 'address1', 'address2', '75450', 'Melaka Tengah', 'Melaka', 'Malaysia', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `activate_code` varchar(15) NOT NULL,
  `reset_code` varchar(15) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `firstname`, `lastname`, `address`, `contact_info`, `photo`, `status`, `activate_code`, `reset_code`, `created_on`) VALUES
(1, 'admin@admin.com', '$2y$10$MJPKgCPHFSNQuMWlwcRYluMEpYWhVbP4W9bBUeVOVItMB7Quem7f.', 1, 'Admin', '', '', '', 'thanos1.jpg', 1, '', '', '2020-12-30'),
(9, 'darkseid@gmail.com', '$2y$10$ZnrShKWTKqdo704wAVl96uqNGHLHP9tg07xs.tk2Vl2dpN7K8NIiG', 0, 'dark', 'seid', 'Jalan Ayer Keroh Lama, 75450 Bukit Beruang, Melaka', '09458423256', 'male2.png', 1, '', 'BOvkJoQ8M1F6dp7', '2020-12-30'),
(17, 'bradleytan119@gmail.com', '$2y$10$lfBYQDbdjrfBsfy4Be9P.ud.9/ZgJ9oDr2jZc4iwFrW5AtVklvM2q', 0, 'Bradley', 'Tan', '', '', '', 1, 'rNbsvQG6fi49', 'zlc1O3JvDapEBS9', '2023-04-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payment_card`
--
ALTER TABLE `payment_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2468;

--
-- AUTO_INCREMENT for table `payment_card`
--
ALTER TABLE `payment_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
