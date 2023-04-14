-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2023 at 03:55 AM
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
(36, 13, 1, 1),
(40, 17, 20, 5),
(41, 17, 29, 1);

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
(4, 'Dressings/Sauces', 'Dressings/Sauces');

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
(20, 10, 19, 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `productId`, `quantity`, `orderDate`, `paymentMethod`, `orderStatus`) VALUES
(1, 1, '3', 1, '2023-01-07 11:32:57', 'Debit / Credit card', 'Delivered'),
(3, 1, '4', 1, '2023-01-17 11:43:04', 'Debit / Credit card', 'Delivered'),
(4, 1, '17', 1, '2023-01-19 08:14:17', 'Debit / Credit card', 'in Process'),
(8, 5, '2', 1, '2023-02-14 03:41:02', 'Debit / Credit card', 'Delivered');

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
(1, 1, 'Campbells Cream Of Mushroom Condensed Soup (420g)', '<p><var>Customize and create with this Cream of Mushroom Soup, which starts with mushrooms, garlic, and farm fresh cream for a smooth flavor. Or, make it the start of your next weeknight meal, like the crowd-pleasing Swedish meatballs and easy one-pot beef stroganoff. With high-quality ingredients, this canned soup always delivers feel-good nourishment. Campbell&rsquo;s Cream of Mushroom Soup is made with no preservatives.</var></p>\r\n\r\n<p><strong>(Expiry Date : 5/7/2024)</strong></p>\r\n', 'campbells-cream-of-mushroom-condensed-soup-420g', 7.99, 10, 'campbells-cream-of-mushroom-condensed-soup-420g_1680666629.webp', '2023-04-13', 2),
(2, 1, 'Hosen Choice Whole Mushroom (425g)', '<p><var>Hosen Choice Whole Mushroom is made from freshly picked mushrooms and immediately packed to seal in all the tangy goodness! Hosen Choice Whole Mushroom are delicious, tender yet firm in texture for the healthy choice for the entire family.</var></p>\r\n\r\n<p><strong>(Expiry Date : 5/7/2025)</strong></p>\r\n', 'hosen-choice-whole-mushroom-425g', 4.99, 10, 'hosen-choice-whole-mushroom-425g_1680666790.webp', '2018-05-10', 3),
(3, 1, 'Hosen Longan in Syrup (565g)', '<p><var>Hosen Longan in Syrup is made from freshly picked longan fruits from the trees and immediately packed to seal in all the tangy goodness! Hosen Longan are delicious, tender yet firm in texture for the healthy choice for the entire family.</var></p>\r\n\r\n<p><strong>(Expiry Date : 5/8/2025)</strong></p>\r\n', 'hosen-longan-syrup-565g', 6.99, 10, 'hosen-longan-syrup-565g_1680666928.webp', '2023-03-31', 1),
(4, 1, 'Barilla Spaghetti Pasta, 1 lb', '<p><var>Spaghetti pasta is the most popular pasta shape in Italy. The name comes from the Italian word spaghi, which means &quot;&quot;lengths of cord.&quot;&quot; Spaghetti pasta originates from the south of Italy and is commonly used with tomato pasta sauces, fresh vegetables, or fish. Barilla Spaghetti pasta is made from the finest durum wheat and is non-GMO verified, peanut-free and suitable for a vegan or vegetarian diet.</var></p>\r\n\r\n<ul>\r\n	<li>Cooks to Perfection Every Time: Perfect pasta in 10-11 minutes.</li>\r\n	<li>Barilla Spaghetti pasta pairs well with just about any kind of pasta sauce.</li>\r\n	<li>Try pairing spaghetti pasta with a simple tomato pasta sauce, with or without meat or vegetables, try it with a fish or oil-based pasta sauce or a carbonara.</li>\r\n	<li>Made with 100% durum wheat and water.</li>\r\n	<li>Lactose, peanut, shell fish, fish, tree nut, and soy free.</li>\r\n	<li>Suitable for vegetarians.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 3/3/2024)</strong></p>\r\n', 'barilla-spaghetti-pasta-1-lb', 9.99, 20, 'barilla-spaghetti-pasta-1-lb_1680667035.webp', '2018-05-10', 3),
(5, 1, 'Lay\'s Classic Potato Chips, Party Size, 13 oz Bag', '<p><var>It starts with farm-grown potatoes- cooked and seasoned to perfection. Then we add the tang of sour cream and sharp cheddar. So every Lay&#39;s potato chip is perfectly crispy and delicious. Happiness in every bite. The shareable size is perfect for your next party or gathering.</var></p>\r\n\r\n<p><strong>Lay&#39;s Classic Potato Chips, Party Size, 13 oz Bag:</strong></p>\r\n\r\n<ul>\r\n	<li>Includes 1 (13oz) bag of Lay&#39;s Potato Chips, Classic Flavor.</li>\r\n	<li>Farm-grown potatoes seasoned with just the right amount of salt.</li>\r\n	<li>Only 3 Ingredients: Potatoes, Vegetable Oil, and SaltLay&#39;s Classic Potato chips are made with no artificial flavors, no preservatives, and are Gluten Free.</li>\r\n	<li>Delicious alone or when with your favorite onion dip.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 3/6/2024)</strong></p>\r\n', 'lay-s-classic-potato-chips-party-size-13-oz-bag', 14.99, 10, 'lay-s-classic-potato-chips-party-size-13-oz-bag_1680667090.webp', '2023-03-31', 2),
(6, 1, 'OREO Chocolate Sandwich Cookies, Easter Snacks, Party Size, 25.5 oz', '<p><var>Take a delicious break with OREO Chocolate Sandwich Cookies, America&#39;s favorite sandwich cookie for over 100 years.&nbsp;Supremely dunkable, OREO cookies sandwich a rich creme filling between the bold taste of two chocolate wafers.</var></p>\r\n\r\n<ul>\r\n	<li>25.5 oz package of OREO Chocolate Sandwich Cookies .</li>\r\n	<li>Chocolate wafers filled with original OREO creme.</li>\r\n	<li>Party size sandwich cookies are perfectly dunkable.</li>\r\n	<li>Resealable package helps keep snack cookies fresh.</li>\r\n	<li>100% Sustainably Sourced Cocoa see Cocoa Life website for details.</li>\r\n</ul>\r\n', 'oreo-chocolate-sandwich-cookies-easter-snacks-party-size-25-5-oz', 13.99, 10, 'oreo-chocolate-sandwich-cookies-easter-snacks-party-size-25-5-oz_1680667178.webp', '0000-00-00', 0),
(7, 2, 'Oral-B CrossAction All In One Soft Toothbrushes, Deep Plaque Removal, (6 pcs)', '<ul>\r\n	<li>You will receive 6 Oral-B Cross Action All-In-One toothbrushes.</li>\r\n	<li>Removes up to 99% of plaque in hard-to-reach areas based on a single-use brushing study.</li>\r\n	<li>CrossAction bristles attack plaque with every stroke.</li>\r\n	<li>Tongue and cheek cleaner removes odor-causing bacteria.</li>\r\n	<li>Gum stimulators gently massage gums.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n', 'oral-b-crossaction-all-one-soft-toothbrushes-deep-plaque-removal-6-pcs', 22.99, 10, 'oral-b-crossaction-all-one-soft-toothbrushes-deep-plaque-removal-6-pcs_1680667275.jpg', '2023-04-12', 19),
(8, 1, 'Doritos Nacho Cheese Flavored Tortilla Chips, Party Size, 14.5 oz Bag', '<p><var>DORITOS isn&rsquo;t just a chip. It&rsquo;s fuel for disruption &mdash; our flavors ignite adventure and inspire action. With every crunch of these nacho cheese tortilla chips, we aim to redefine culture and support those who are boldly themselves. Are you ready? If so, crunch on. These crispy tortilla chips are perfect for sharing with family and friends.</var></p>\r\n\r\n<ul>\r\n	<li>Includes 1 (14.5oz) Party Size bag of Doritos Tortilla chips, Nacho Cheese flavor</li>\r\n	<li>Delicious nacho cheese flavor</li>\r\n	<li>Flavor on Another Level</li>\r\n	<li>Great anytime snack</li>\r\n	<li>Party size bag is perfect for sharing&nbsp;</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 2/5/2024)</strong></p>\r\n', 'doritos-nacho-cheese-flavored-tortilla-chips-party-size-14-5-oz-bag', 11.99, 10, 'doritos-nacho-cheese-flavored-tortilla-chips-party-size-14-5-oz-bag_1680667356.webp', '0000-00-00', 0),
(9, 2, 'Dove Deep Moisture Body Wash ', '<p><var>Just as everyone&#39;s skin is different, skin dryness can appear differently for everyone. From mild, occasionally dry skin driven by ageing, weather fluctuations or just life! To dry patches and skin dryness . No matter how dry your skin may look or feel, Dove has got you covered. Dove Deep Moisture body wash transforms even the driest skin in just one shower leaving you with softer smoother skin.&nbsp;</var></p>\r\n\r\n<ul>\r\n	<li>Dove Deep Moisture Body wash transforms even the driest skin in just one shower.</li>\r\n	<li>Moisturizing body wash that&rsquo;s made with Microbiome Nutrient Serum to nourish skin and its microbiome.</li>\r\n	<li>Cleanser with 98% biodegradable formula packaged in a 100% recycled plastic bottle.</li>\r\n	<li>Moisturize skin with this hydrating body wash for dry skin.</li>\r\n	<li>Sulfate and paraben free body wash.</li>\r\n</ul>\r\n', 'dove-deep-moisture-body-wash', 13.5, 10, 'dove-deep-moisture-body-wash_1680667432.jpg', '2023-04-12', 3),
(10, 2, 'CeraVe Daily Moisturizing Lotion for Dry Skin', '<ul>\r\n	<li><strong>[DAILY MOISTURIZING LOTION]</strong> Smooth, light-weight texture that is absorbed quickly, leaving skin feeling smooth and hydrated, never greasy.</li>\r\n	<li><strong>[LONG-LASTING HYDRATION]</strong> Contains Hyaluronic Acid to help retain skins natural moisture and MVE technology to provide 24 hour hydration.</li>\r\n	<li><strong>[GENTLE ON SKIN]</strong> Holds National Eczema Association (NEA) Seal of Acceptance. Fragrance free, allergy-tested, non-comedogenic, and suitable for use as a body lotion, face moisturizing lotion, and/or hand lotion.</li>\r\n	<li><strong>[3 ESSENTIAL CERAMIDES]</strong> Ceramides are found naturally in the skin and make up 50% of the lipids in the skin barrier. All CeraVe products are formulated with three essential ceramides (1, 3, 6-II) to help restore and maintain the skin&rsquo;s natural barrier.</li>\r\n	<li><strong>[DEVELOPED WITH DERMATOLOGISTS]</strong> CeraVe Skincare is developed with dermatologists and has products suitable for dry skin, sensitive skin, oily skin, acne-prone, and more.</li>\r\n</ul>\r\n', 'cerave-daily-moisturizing-lotion-dry-skin', 33.99, 10, 'cerave-daily-moisturizing-lotion-dry-skin_1680667633.jpg', '2023-03-30', 2),
(11, 2, ' Sunsilk Nourishing Soft and Smooth Shampoo (340ml)', '<p><var>Sunsilk Nourishing Soft &amp; Smooth Shampoo nourishes hair deeply, and makes it beautifully soft and smooth.</var></p>\r\n\r\n<ul>\r\n	<li>Quantity - 1 bottle of 360ml</li>\r\n	<li>It contains Argan oil, Babasu oil, Almond oil, Camellia oil &amp; Coconut Oil to nourish your hair.</li>\r\n	<li>Its unique blend of five natural oils and exclusive formula nourishes hair deeply without making it greasy or limp.</li>\r\n	<li>Its fresh perky fragrance works from the first wash, to keep your hair&rsquo;s texture silky soft and smooth.</li>\r\n</ul>\r\n', 'sunsilk-nourishing-soft-and-smooth-shampoo-340ml', 12.99, 15, 'sunsilk-nourishing-soft-and-smooth-shampoo-340ml_1680668548.jpg', '2018-05-12', 1),
(12, 2, 'Head and Shoulders', '<p><cite><small><big>Head and Shoulders Dandruff Shampoo, Classic Clean, 8.45 Fl OzHead &amp; Shoulders Classic Clean Shampoo provides proven protection from flakes, itch, oil and dryness with regular use to ensure that your scalp is at its best and your locks are 100% flake-free.</big></small></cite></p>\r\n\r\n<ul>\r\n	<li>Head &amp; Shoulders Classic Clean anti-dandruff shampoo fights flakes with a deep, clean feeling.</li>\r\n	<li>#1 dermatologist recommended dandruff brand.</li>\r\n	<li>Clinically proven.</li>\r\n	<li>Anti-dandruff shampoo with Head &amp; Shoulders classic fragrance.</li>\r\n	<li>pH balanced and gentle enough for everyday use, even on color or chemically treated hair.</li>\r\n</ul>\r\n', 'head-and-shoulders', 13.99, 15, 'head-and-shoulders_1680668629.webp', '2023-03-30', 1),
(13, 2, 'Colgate Total Whitening Toothpaste, Sensitivity Relief and Cavity Protection Mint, 4.8 Oz (Pack of 2)', '<p><var>Colgate Total Teeth Whitening Toothpaste leaves your mouth feeling fresh after every brush. This sugar-free and gluten-free whitening toothpaste not only helps remove stains for whiter teeth, but also keeps your whole mouth healthy by fighting bacteria on teeth, tongue, cheeks, and gums for 12 hours.</var></p>\r\n\r\n<ul>\r\n	<li>Two 4.8 oz tubes of Colgate Total Teeth Whitening Toothpaste.</li>\r\n	<li><strong>42%&nbsp;more sensitivity relief</strong> (versus a regular fluoride toothpaste after 8 weeks of use).</li>\r\n	<li>Get <strong>10 benefits</strong> and no trade-offs with Colgate Total toothpaste.</li>\r\n	<li>Use Colgate Total Whitening gel toothpaste to remove surface stains for a whiter, brighter smile.</li>\r\n	<li>Mint toothpaste leaves mouth feeling clean and breath refreshed.</li>\r\n</ul>\r\n', 'colgate-total-whitening-toothpaste-sensitivity-relief-and-cavity-protection-mint-4-8-oz-pack-of-2', 25.99, 15, 'colgate-total-whitening-toothpaste-sensitivity-relief-and-cavity-protection-mint-4-8-oz-pack-of-2_1680668432.jpg', '2023-03-30', 5),
(14, 2, 'Vaseline Original (100ml)', '<p><var>Vaseline Original Is An All-time Cult-Favorite To Fight Dryness And Provide Gloss And Conditioning.</var></p>\r\n\r\n<ul>\r\n	<li>A specialized formulation for deep nourishment.</li>\r\n	<li>Promises a natural and glossy shine.</li>\r\n	<li>Aids in locking in the moisture for long-lasting moisturization.</li>\r\n</ul>\r\n\r\n<p>A one-venture formula for dry and damaged skin, the Vaseline Original secures moisture and hydration to recuperate minor skin scratches and rashes along with saturating the face and hands to reestablish dry and damaged skin.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'vaseline-original-100ml', 8.99, 15, 'vaseline-original-100ml_1680668309.webp', '2018-05-10', 13),
(15, 2, 'Pantene Conditioner  with Hair Treatment Set', '<p><var>These formulas are crafted with protective antioxidants, Pro-Vitamin B5, and pH balancers, and made without parabens or colorants. This color-safe conditioner is gentle enough for everyday use on chemically-treated hair or color-treated hair, and gives you results that last for 72 plus hours without washing. For strands in need of extra moisture and repair follow with the Pantene Miracle.</var></p>\r\n\r\n<ul>\r\n	<li><strong>HARD WORKING</strong> Fuels hair with a potent blend of Pro-V nutrients and antioxidants so hair is shiny and free of frizz.</li>\r\n	<li><strong>LONG LASTING</strong> Gently conditions with a vitamin-rich formula with 2x more nutrients, with results that last 72 plus hours.</li>\r\n	<li><strong>SMOOTHNESS WITH EVERY WASH</strong> Soften stubborn strands to smooth hair for lasting frizz control.</li>\r\n	<li><strong>ROOT TO TIP NOURISHMENT</strong> These powerful Smooth &amp; Sleek formulas work together to permeate every strand, smoothing hair from the inside out.</li>\r\n	<li><strong>HAIR MASK SHOT</strong> dry hair moisturizing treatment noticeably repairs extreme damage in 1 use.</li>\r\n	<li>This is the NEW version of this item.</li>\r\n</ul>\r\n', 'pantene-conditioner-hair-treatment-set', 16.99, 15, 'pantene-conditioner-hair-treatment-set_1680668246.jpg', '2023-03-30', 1),
(16, 2, 'Colgate Cavity Protection Toothpaste with Fluoride, 6 Ounce (Pack of 6)', '<p><var>Colgate Cavity Protection Toothpaste with Fluoride provides trusted cavity protection for the entire family. Formulated with active fluoride, this toothpaste is clinically proven to help strengthen teeth and leave your mouth feeling fresh and clean. This Colgate toothpaste is ADA (American Dental Association) accepted. It has been trusted by dentists and parents globally for over 45 years.</var></p>\r\n\r\n<ul>\r\n	<li>Cleans teeth thoroughly.</li>\r\n	<li>Strengthens teeth enamel with active fluoride.</li>\r\n	<li>Great mint taste.</li>\r\n	<li>Anticavity fluoride toothpaste.</li>\r\n	<li>Gluten free.</li>\r\n</ul>\r\n', 'colgate-cavity-protection-toothpaste-fluoride-6-ounce-pack-of-6', 39.99, 15, 'colgate-cavity-protection-toothpaste-fluoride-6-ounce-pack-of-6_1680198898.jpg', '2023-03-30', 5),
(17, 1, 'Muesli Fitness Nutritious Energy,  Gluten Free (500G)', '<p>Cereals (Whole Grain Oat Flakes, Whole Grain Oat Flour), Oat Crisps (Whole Grain Oat Flour, Rice Flour, Wheat Flour, Sugar, Barley Malt Flour, Salt), Sugar Syrup (Sugar, Invert Sugar Syrup, Molasses), Sunflower Oil Non-Hydrogenated, Isomaltulose, Dried Cranberries, Pumpkin Seeds, Glucose Syrup Powder, Wheat Flakes (Wheat, Barley Malt Extract, Emulsifier from Plant Origin: Sunflower Lecithin), Acidity Regulator: Citric Acid, Salt, Antioxidant: Tocopherols. Minerals: Calcium, Iron.</p>\r\n\r\n<p>Contains Cereals containing Gluten. May contain Cow&#39;s Milk, Soyabeans and Nuts. Free from pork products and their derivatives.</p>\r\n\r\n<p><strong>(Expiry Date:2/25/2024)</strong></p>\r\n', 'muesli-fitness-nutritious-energy-gluten-free-500g', 21.99, 15, 'muesli-fitness-nutritious-energy-gluten-free-500g_1680116899.jpg', '2023-03-30', 1),
(18, 2, 'Cetaphil Face Wash, 16 oz , Fragrance Free, Gentle Foaming.', '<ul>\r\n	<li>CETAPHIL FRAGRANCE FREE DAILY FACIAL CLEANSER: Reinforces the skin barrier, balances skin and minimizes the appearance of pores, now in a fragrance free formula.</li>\r\n	<li><strong>IDEAL FOR SENSITIVE, COMBINATION TO OILY SKIN :</strong>&nbsp;Clinically proven to deep clean by removing dirt, excess oils, impurities and pollution microparticles.</li>\r\n	<li><strong>DEVELOPED FOR EVEN THE MOST SENSITIVE SKIN :&nbsp;</strong>The hypoallergenic, non-comedogenic formula is free of parabens and sulfates.</li>\r\n	<li><strong>DERMATOLOGIST RECOMMENDED</strong> for Sensitive Skin.</li>\r\n	<li><strong>DEFENDS AGAINST 5 SIGNS OF SKIN SENSITIVITY :</strong> Dryness, irritation, roughness, tightness and a weakened skin barrier.</li>\r\n</ul>\r\n', 'cetaphil-face-wash-16-oz-fragrance-free-gentle-foaming', 17.99, 15, 'cetaphil-face-wash-16-oz-fragrance-free-gentle-foaming_1680667904.jpg', '2023-03-30', 3),
(19, 2, 'Listerine Total Care Anticavity Fluoride Mouthwash, Helps Kill 99% of Bad Breath Germs, Fresh Mint, (1L)', '<ul>\r\n	<li><strong>FLUORIDE ANTICAVITY MOUTHWASH:</strong> 1-liter family size of Listerine Fluoride Anticavity Mouthwash in fresh mint flavor to improve oral health by helping to prevent cavities, strengthening teeth, and leaving a refreshing, clean feeling you can taste.</li>\r\n	<li><strong>6-IN-1 BENEFITS:</strong> Fluoride-rich mint mouthwash offers six dental hygiene benefits in one oral rinse to kill germs that cause bad breath, strengthen teeth, help prevent cavities, restore enamel, clean your mouth and freshen breath.</li>\r\n	<li><strong>50% STRONGER TEETH*: </strong>Anticavity fresh mint remineralizing mouthwash freshens breath while strengthening teeth 50% more than brushing alone, according to laboratory studies *vs brushing alone.</li>\r\n	<li><strong>PROTECTS DAY AND NIGHT :</strong> Help protect your mouth by adding a 60-second rinse of this powerful anticavity total care mouthwash to your morning and evening oral care routines.</li>\r\n</ul>\r\n\r\n<p><strong>ADA ACCEPTED:</strong> With approximately 7 weeks of supply, this multibenefit oral rinse in a refreshing Fresh Mint Flavor helps prevent tooth decay and is accepted by the American Dental Association&#39;s (ADA) Seal of Acceptance Program.</p>\r\n\r\n<p><strong>(Expiry date: 2/4/2025)</strong></p>\r\n', 'listerine-total-care-anticavity-fluoride-mouthwash-helps-kill-99-of-bad-breath-germs-fresh-mint-1l', 15.99, 15, 'listerine-total-care-anticavity-fluoride-mouthwash-helps-kill-99-of-bad-breath-germs-fresh-mint-1l_1680667796.jpg', '2023-03-30', 1),
(20, 3, 'Coca-Cola Soda Pop, 12 fl oz, 24 Pack Cans', '<p><var>Soda.Pop.Soft drink. Sparkling beverage.Whatever you call it, nothing compares to the refreshing, crisp taste of Coca-Cola Original Taste, the delicious soda you know and love. Enjoy with friends, on the go or with a meal. Whatever the occasion, wherever you are, Coca-Cola Original Taste makes life&rsquo;s special moments a little bit better.</var></p>\r\n\r\n<ul>\r\n	<li>24 cans of Coca-Cola Original Taste&mdash;the refreshing, crisp taste you know and love.</li>\r\n	<li>Great taste since 1886.</li>\r\n	<li>34 mg of caffeine in each 12 oz serving.</li>\r\n	<li>12 FL OZ in each can.</li>\r\n	<li>This sparkling beverage is best enjoyed ice-cold for maximum refreshment.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 24/2/2024)</strong></p>\r\n', 'coca-cola-soda-pop-12-fl-oz-24-pack-cans', 34.99, 15, 'coca-cola-soda-pop-12-fl-oz-24-pack-cans_1680666387.webp', '2023-04-14', 4),
(27, 1, 'Ayam Brand Tuna Flakes in Water Light 150g', '<ul>\r\n	<li>Fine flakes* of tuna</li>\r\n	<li>In vegetable broth for savory</li>\r\n	<li>98% reduced fat compared to Tuna flakes in Sunflower oil</li>\r\n	<li>150g</li>\r\n</ul>\r\n\r\n<p>*Ayam Brand&trade; tuna flakes are made off tuna chunks that are broken down mechanically. Hence you benefits from the same best tuna quality chunks in smaller pieces for a better mix in any recipe. Broken chunks absorb the vegetable broth and give the tuna a unique juicy texture.</p>\r\n\r\n<p>All Ayam Brand&trade; products contain <strong>no preservatives and no added MSG</strong>.</p>\r\n\r\n<p><strong>(Expiry Date : 5/5/2025)</strong></p>\r\n', 'ayam-brand-tuna-flakes-water-light-150g', 5.99, 20, 'ayam-brand-tuna-flakes-water-light-150g_1680666514.webp', '2023-04-12', 4),
(28, 4, 'Kewpie Roasted Sesame Dressing 210ml', '<p><var>Bring out the flavours of your food with&nbsp;<strong>KEWPIE ROASTED SESAME DRESSING</strong>. This nutty, creamy dressing can be used in a variety of ways from salad to meat dishes or even for steamboat. No added MSG.</var></p>\r\n\r\n<p><strong>(Expiry Date : 4/5/2024)</strong></p>\r\n', 'kewpie-roasted-sesame-dressing-210ml', 13.99, 20, 'kewpie-roasted-sesame-dressing-210ml_1680667722.webp', '2023-03-31', 1),
(29, 4, 'Chef Antonio Extraordinary Garlic Dipping and Pizza Sauce, 12 Ounce Bottle', '<p><var>Chef Antonio Extraordinary Garlic Dipping and Pizza Sauce adds the perfect finish of garlicky goodness. This sauce is a must-try for anyone who loves the bold flavors of garlic combined in a savory blend ideal for dipping vegetables, chips, pizza crusts, and even the whole pizza slice to send your taste buds into flavor heaven.&nbsp;</var></p>\r\n\r\n<ul>\r\n	<li>Rich, bold, and savory garlic sauce.</li>\r\n	<li>Perfect for use as a dipping sauce for vegetables, chips, and other snacks for dipping pizza crusts and even whole slices for mouth-watering garlicky goodness.</li>\r\n	<li>Great for anyone who just can&#39;t get enough of a smooth and delicious garlic taste.</li>\r\n	<li>Create the ultimate appetizer sure to get everyone raving at your next party, get-together, pot luck, and more.</li>\r\n	<li>12 fluid ounce bottle.</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 3/6/2025)</strong></p>\r\n', 'chef-antonio-extraordinary-garlic-dipping-and-pizza-sauce-12-ounce-bottle', 16.99, 20, 'chef-antonio-extraordinary-garlic-dipping-and-pizza-sauce-12-ounce-bottle_1680668176.jpeg', '2023-04-14', 3),
(30, 3, 'Pepsi Cola Soda Pop, 12 oz Cans, 24 Pack', '<p><var>Enjoy the sweet taste of Pepsi Cola soda. They come in a pack of 24 cans and each contains 12 fl oz. You can share them with others or save them for yourself to drink. Perfect for parties, meals, and anywhere you need to make a big impression. This 12 fl oz Pepsi is free of sugar and fat. It&#39;s suitable for sporting events and holidays.&nbsp;</var></p>\r\n\r\n<p><strong>Pepsi Soda, 12 oz Cans, 24 Count:</strong></p>\r\n\r\n<ul>\r\n	<li>Includes 12-oz cans.</li>\r\n	<li>150 calories per can.</li>\r\n	<li>No fat.</li>\r\n	<li>No cholesterol .</li>\r\n	<li>Low sodium .</li>\r\n	<li>Recyclable cans.</li>\r\n	<li>24-pack Pepsi is a caffeinated soft drink .</li>\r\n</ul>\r\n\r\n<p><strong>(Expiry Date : 3/3/2024)</strong></p>\r\n', 'pepsi-cola-soda-pop-12-oz-cans-24-pack', 34.99, 20, 'pepsi-cola-soda-pop-12-oz-cans-24-pack.webp', '2023-04-10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_id` varchar(50) NOT NULL,
  `sales_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `pay_id`, `sales_date`) VALUES
(9, 9, 'PAY-1RT494832H294925RLLZ7TZA', '2018-05-10'),
(10, 9, 'PAY-21700797GV667562HLLZ7ZVY', '2018-05-10');

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
(17, 'bradleytan119@gmail.com', '$2y$10$lfBYQDbdjrfBsfy4Be9P.ud.9/ZgJ9oDr2jZc4iwFrW5AtVklvM2q', 0, 'Bradley', 'Tan', '', '', '', 1, 'rNbsvQG6fi49', '', '2023-04-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
