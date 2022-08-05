-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 25, 2016 at 12:35 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `est`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `county` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` int(10) unsigned NOT NULL,
  `type` enum('Change','Add','Delete') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Change',
  `target` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car_parks`
--

CREATE TABLE `car_parks` (
  `id` int(10) unsigned NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `lat` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `long` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sku` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `featured` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `car_parks`
--

INSERT INTO `car_parks` (`id`, `capacity`, `lat`, `long`, `sku`, `priority`, `featured`, `created_at`, `updated_at`) VALUES
(1, 130, '52.451180', '-1.508392', 'ctk', 2, 'true', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(2, 250, '52.457417', '-1.485650', 'wayside', 5, 'true', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(5, 100, '52.449425', '-1.494300', 'A', 2, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(6, 200, '52.446724', '-1.496185', 'B', 3, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(7, 400, '52.445091', '-1.498151', 'C', 1, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(8, 10, '52.449432', '-1.496429', 'D', 8, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(9, 200, '52.444752', '-1.510125', 'stfinbarrs', 0, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(10, 200, '52.453850', '-1.497809', 'leekes', 1, 'true', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(14, 15, '52.446724', '-1.496185', 'B-disabled', 10, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(15, 40, '52.449425', '-1.494300', 'A-disabled', 11, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(17, 100, '52.449509', '-1.493414', 'A-B', 1, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(18, 100, '52.449425', '-1.494300', 'A-guest', 1, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(19, 100, '52.446724', '-1.496185', 'B-guest', 1, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(20, 100, '52.449425', '-1.494300', 'A-disabled-guest ', 1, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(21, 100, '52.453777', '-1.511988', 'exhall', 99, 'true', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(22, 50, '52.445091', '-1.498151', 'C-guest', 5, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(23, 30, '52.449425', '-1.494300', 'A-reserve', 99, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(24, 10, '52.445091', '-1.498151', 'C-coaches', 99, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(25, 1000, '52.431149', '-1.506407', 'Coventrians', 1, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(26, 20, '52.449432', '-1.496429', 'CPD Disabled', 99, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(27, 50, '52.445091', '-1.498151', 'C Disabled', 99, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(28, 50, '52.458927', '-1.486090', 'LIP7', 5, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(29, 100, '', '', 'C MB', 1, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(31, 250, '52.457417', '1.485650', 'mtvfwayside', 5, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(32, 150, '52.457417', '1.485650', 'mtvswayside', 6, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(35, 1000, '', '', '50', 1, '', '2016-04-22 12:57:53', '2016-04-22 12:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `car_parks_lang`
--

CREATE TABLE `car_parks_lang` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL DEFAULT '1',
  `car_park_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `directions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `car_parks_lang`
--

INSERT INTO `car_parks_lang` (`id`, `language_id`, `car_park_id`, `name`, `description`, `directions`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Car Park 1, Christ the King', '8 to 10 minutes walk to Ricoh Arena - Satnav: CV7 9HR', 'Christ the King, park-and-walk site is located on Winding House Lane,\nWhich is accessible by leaving the M6 at J3 towards Coventry and going along the A444 for half a mile,\nThen turn right at the first roundabout (third exit) into Winding House Lane,\nContinue for half a mile and the car park is on the right,\nOur team will be on hand to direct you to a parking space.\nThere’s then a short 8-15 minute walk to the Arena.\nSat Nav users: Winding House Lane, CV7 9HR\nNB: There is a 2.2m vehicle height restriction at this car park', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(2, 1, 2, 'Car Park 2, Wayside Business Park ', 'Nearest to M6 Junction 3, 15 minutes walk (0.8 miles) to the Ricoh Arena - Satnav: CV6 6NY', 'Wayside Business Park, park-and-walk site is accessible from J3 of the M6,\nFollow the B4113 towards Bedworth,\nTake the third exit at the roundabout and Wayside Business Park is on your left.\nOur team will be on hand to direct you to a parking space.\nThere’s then a short 15-20 minute walk to the Arena.\nSat Nav users: CV6 6NY', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(5, 1, 5, 'Car Park A', 'On-site parking - Satnav: CV6 6GE * May have up to 20 minutes lockdown at final whistle', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane\nSat Nav users: CV6 6GE', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(6, 1, 6, 'Car Park B ', 'On-site parking - Satnav: CV6 6GE - You must arrive 45 minutes before kick-off, access to this car park maybe closed for safety reasons.', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(7, 1, 7, 'Car Park C ', 'On-site parking - Satnav: Phoenix way, CV6 6GE', 'Accessible from the A444 Phoenix Way Road dual carriageway, followed by a short walk across the pedestrian footbridge or under the subway to the arena', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(8, 1, 8, 'Car Park D', 'On-site parking - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane\nSat Nav users: CV6 6GE', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(9, 1, 9, 'Car Park 3, St Finbarrs', '12/15 minutes walk to the Ricoh Arena, 0.6 miles - Satnav: CV6 4DG', 'St Finbarrs FC, park and walk site, leave the M6 at J3 onto the A444 towards Coventry,\nGoing along the A444 for half a mile, then turn right at the first roundabout (third exit),\nInto Winding House Lane,\nAt Traffic lights exit left onto Hen Lane,\nThen Next Traffic lights left onto Holbrook Lane opposite the Old Peugeot Garage.\nOur team will be on hand to direct you to a parking space.\nThere’s then a short 10-15 minute walk to the Arena.', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(10, 1, 10, 'Car Park 6, Leekes', 'Nearest off-site carpark to Ricoh Arena, this service includes a couple of minutes shuttle bus ride to the Ricoh Arena. - Satnav: CV6 6PA', 'Leekes Home Store is situated directly off of the A444.\nOnly accessible when heading down the A444 towards the Arena (from the M6 Roundabout).\nTake the slip road into the business estate and travel along Silverstone Drive.\nMake your way into the home store car park and our team will direct you to a parking space.\nThere is then a shuttle bus to take you to the Ricoh Arena, pick up is on Silverstone Drive.\nSat Nav users: Silverstone Drive, CV6 6PA', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(14, 1, 14, 'Car Park B - Blue Badge Holders', 'On-site parking for strictly blue badge holders only - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane\nSat Nav users: CV6 6GE', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(15, 1, 15, 'Car Park A - Blue Badge Holders', 'On-site parking for strictly blue badge holders only - Satnav: CV6 6GE * May have up to 20 minutes lockdown at final whistle', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane\nSat Nav users: CV6 6GE', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(17, 1, 17, 'Car Park A and B ', 'On-site parking - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane\nSat Nav users: CV6 6GE', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(18, 1, 18, 'Car Park A (Guest)', 'Guest List On-site parking - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane\nSat Nav users: CV6 6GE', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(19, 1, 19, 'Car Park B (Guest) ', 'Guest List On-site parking - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane\nSat Nav users: CV6 6GE', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(20, 1, 20, 'Car Park A - Disabled (Guest)', 'Disabled Guest List On-site parking - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane\nSat Nav users: CV6 6GE', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(21, 1, 21, 'Car Park 5, Exhall Grange School ', '12/15 minutes walk to Ricoh Arena - Satnav: CV7 8PE', 'Car park is closed for Coventry City football games.\nExhall Grange School, park and walk site is located on Winding House Lane,\nWhich is accessible by leaving the M6 at J3 towards Coventry and going along the A444 for half a mile,\nThen turn right at the first roundabout (third exit) into Winding House Lane,\nContinue for half a mile, turn right at the next roundabout, second exit into Exhall Grange School.\nOur team will be on hand to direct you to a parking space.\nThere’s then a short 8-15 minute walk to the Arena.\nSat Nav users: Central Blvd, Coventry CV7 8PE, UK', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(22, 1, 22, 'Car Park C (Guest)', 'Guest List On-site parking - Satnav: Phoenix way, CV6 6GE', 'Accessible from the A444 Phoenix Way Road dual carriageway, followed by a short walk across the pedestrian footbridge or under the subway to the arena', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(23, 1, 23, 'Car Park A - Reserve', 'On-site parking - Satnav: CV6 6GE * May have up to 20 minutes lockdown at final whistle', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane\nSat Nav users: CV6 6GE', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(24, 1, 24, 'Car Park C - Coaches', 'On-site Coach parking - Satnav: Phoenix way, CV6 6GE', 'Accessible from the A444 Phoenix Way Road dual carriageway, followed by a short walk across the pedestrian footbridge or under the subway to the arena', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(25, 1, 25, 'Car Park 4, Coventrians RFC ', 'Coventrians RFC is a Park and Ride site. There’s then a short 15-20 minute free Bus Shuttle. Satnav: CV6 4AG', 'Coventrians RFC, park and ride site is located in Yelverton Road.\nLeave the M6 at J3 onto the A444 towards Coventry,\nA444 Roundabout, continue straight on the A444 and go past The Ricoh Arena and Tesco on your left,\nAt the next roundabout, take the second exit onto Holbrooks Way,\nNext island go left-ish,\nNext mini island, Continue straight ahead,\nYelveton Lane is on your right, before the bridge.\nOur team will be on hand to direct you to a parking space.\nThere’s then a short 10-15 minute free Bus Shuttle.\nSat Nav users: CV6 4AG', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(26, 1, 26, 'Car Park D - Blue Badge Holders', 'On-site parking for strictly blue badge holders only - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane\nSat Nav users: CV6 6GE', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(27, 1, 27, 'Car Park C - Blue Badge Holders', 'On-site parking for strictly blue badge holders only - Satnav: Phoenix way, CV6 6GE', 'Accessible from the A444 Phoenix Way Road dual carriageway, followed by a short walk across the pedestrian footbridge or under the subway to the arena', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(28, 1, 28, 'Car Park 7 Leisure Ireland Parking', 'Nearest to M6 Junction 3, 15 minutes walk (0.8 miles) to the Ricoh Arena - Satnav: CV7 9GA', 'Leisure Ireland Parking, park-and-walk site is accessible from J3 of the M6,\nFollow the B4113 towards Bedworth,\nTake the 1st exit at the roundabout and Leisure Ireland Parking is on your right hand side.\nOur team will be on hand to direct you to a parking space.\nThere’s then a short 15-20 minute walk to the Arena.\nSat Nav users: CV7 9GA', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(29, 1, 29, 'Car Park C - Mini Bus', 'description', 'directions', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(31, 1, 31, 'Car Park 2, Wayside Business Park - Friday Parking', 'This car park will give you a parking for 1 day. Nearest carpark to M6 Junction 3, 15 minutes walk (0.8 miles) to the Ricoh Arena - Satnav: CV6 6NY', 'Wayside Business Park, park-and-walk site is accessible from J3 of the M6,\nFollow the B4113 towards Bedworth,\nTake the third exit at the roundabout and Wayside Business Park is on your left.\nOur team will be on hand to direct you to a parking space.\nThere’s then a short 15-20 minute walk to the Arena.\nSat Nav users: CV6 6NY', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(32, 1, 32, 'Wayside Business Park Car Park 2 - Saturday Parking Only', 'This car park will give you 1 day parking. Nearest car park to M6 Junction 3, 15 minutes walk (0.8 miles) to the Ricoh Arena - Satnav: CV6 6NY', 'Wayside Business Park, park-and-walk site is accessible from J3 of the M6,\nFollow the B4113 towards Bedworth,\nTake the third exit at the roundabout and Wayside Business Park is on your left.\nOur team will be on hand to direct you to a parking space.\nThere’s then a short 15-20 minute walk to the Arena.\nSat Nav users: CV6 6NY', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(35, 1, 35, 'Madejski Stadium official park and ride', 'TMadejski Stadium official coach travel.\nLeaves Car Park C 11:00am.\nLeaves Madejski Stadium 1 hour after the final whistle.', '', '2016-04-22 12:57:53', '2016-04-22 12:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `car_park_owners`
--

CREATE TABLE `car_park_owners` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `car_park_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `type`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'team', 'football', '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(2, 'team', 'rugby', '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(3, 'single', 'snooker', '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(4, 'single', 'generic', '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(5, 'single', 'gaming', '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(6, 'single', 'music', '2016-04-22 12:57:52', '2016-04-22 12:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories_lang`
--

CREATE TABLE `categories_lang` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories_lang`
--

INSERT INTO `categories_lang` (`id`, `language_id`, `category_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Football', '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(2, 1, 2, 'Rugby', '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(3, 1, 3, 'Snooker', '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(4, 1, 4, 'Generic', '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(5, 1, 5, 'Gaming', '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(6, 1, 6, 'Music', '2016-04-22 12:57:52', '2016-04-22 12:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `allowed_usage` int(11) NOT NULL,
  `valid_from_date` date NOT NULL,
  `valid_to_date` date NOT NULL,
  `allocated` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `usage` enum('Percentage','Amount') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Percentage',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons_allocated`
--

CREATE TABLE `coupons_allocated` (
  `id` int(10) unsigned NOT NULL,
  `coupon_id` int(10) unsigned NOT NULL,
  `single_ticket_id` int(10) unsigned NOT NULL,
  `multi_ticket_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `team1_id` int(10) unsigned DEFAULT NULL,
  `team2_id` int(10) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `featured` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `status` enum('active','inactive','cancelled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'inactive',
  `orig_event_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `category_id`, `team1_id`, `team2_id`, `date`, `time`, `featured`, `status`, `orig_event_id`, `created_at`, `updated_at`) VALUES
(103, 2, 0, 0, '2016-05-08', '15:00:00', '', 'active', 120, '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(104, 4, 0, 0, '2016-05-08', '11:00:00', '', 'active', 119, '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(105, 3, 0, 0, '2016-11-12', '11:00:00', '', 'active', 118, '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(106, 3, 0, 0, '2016-11-11', '13:00:00', '', 'active', 117, '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(107, 3, 0, 0, '2016-11-10', '13:00:00', '', 'active', 116, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(108, 3, 0, 0, '2016-11-09', '13:00:00', '', 'active', 115, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(109, 3, 0, 0, '2016-11-08', '13:00:00', '', 'active', 114, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(110, 3, 0, 0, '2016-11-07', '13:00:00', '', 'active', 113, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(111, 4, 0, 0, '1970-01-01', '11:00:00', '', 'active', 112, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(112, 6, 0, 0, '1970-01-01', '19:00:00', '', 'active', 111, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(113, 6, 0, 0, '2016-06-03', '16:30:00', '', 'active', 110, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(114, 6, 0, 0, '2016-08-12', '09:00:00', '', 'active', 109, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(115, 6, 0, 0, '1970-01-01', '10:00:00', '', 'active', 108, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(116, 6, 0, 0, '1970-01-01', '16:15:00', '', 'active', 107, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(117, 2, 49, 16, '2016-04-09', '15:15:00', '', 'active', 106, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(118, 1, 11, 11, '2018-02-01', '10:00:00', '', 'active', 105, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(119, 6, 0, 0, '1970-01-01', '17:00:00', '', 'active', 104, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(120, 6, 0, 0, '1970-01-01', '16:00:00', '', 'active', 99, '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(121, 4, 0, 0, '1970-01-01', '19:00:00', '', 'active', 98, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(122, 1, 11, 31, '2015-11-07', '15:00:00', '', 'active', 97, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(123, 2, 49, 22, '1970-01-01', '14:45:00', '', 'active', 96, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(124, 2, 49, 47, '1970-01-01', '17:15:00', '', 'active', 93, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(125, 1, 15, 21, '1970-01-01', '17:45:00', '', 'active', 92, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(126, 2, 49, 24, '2016-05-07', '15:30:00', '', 'active', 91, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(127, 2, 49, 29, '2016-04-03', '15:00:00', '', 'active', 90, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(128, 2, 49, 39, '1970-01-01', '14:00:00', '', 'active', 89, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(129, 2, 49, 30, '2016-03-12', '13:45:00', '', 'active', 88, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(130, 2, 49, 20, '1970-01-01', '15:15:00', '', 'active', 87, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(131, 2, 49, 28, '2016-02-06', '14:00:00', '', 'active', 86, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(132, 2, 49, 22, '1970-01-01', '15:15:00', '', 'active', 85, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(133, 2, 49, 52, '2016-01-10', '14:00:00', '', 'active', 84, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(134, 2, 49, 41, '1970-01-01', '14:00:00', '', 'active', 83, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(135, 2, 49, 2, '1970-01-01', '17:15:00', '', 'active', 82, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(136, 2, 49, 16, '2015-12-05', '17:30:00', '', 'active', 81, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(137, 2, 49, 29, '2015-10-04', '15:00:00', '', 'active', 80, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(138, 5, 0, 0, '1970-01-01', '08:00:00', '', 'active', 79, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(139, 5, 0, 0, '1970-01-01', '08:00:00', '', 'active', 78, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(140, 5, 0, 0, '1970-01-01', '15:00:00', '', 'active', 77, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(141, 2, 49, 19, '2015-11-08', '15:00:00', '', 'active', 76, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(142, 2, 49, 2, '1970-01-01', '14:00:00', '', 'active', 70, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(143, 1, 11, 43, '1970-01-01', '15:00:00', '', 'active', 69, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(144, 1, 11, 4, '1970-01-01', '19:45:00', '', 'active', 68, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(145, 1, 11, 26, '1970-01-01', '15:00:00', '', 'active', 67, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(146, 1, 11, 10, '1970-01-01', '19:45:00', '', 'active', 66, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(147, 1, 11, 46, '1970-01-01', '15:00:00', '', 'active', 65, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(148, 1, 11, 38, '2016-03-05', '15:00:00', '', 'active', 64, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(149, 1, 11, 17, '1970-01-01', '15:00:00', '', 'active', 63, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(150, 1, 11, 7, '1970-01-01', '15:00:00', '', 'active', 62, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(151, 1, 11, 42, '1970-01-01', '15:00:00', '', 'active', 61, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(152, 1, 11, 6, '1970-01-01', '15:00:00', '', 'active', 60, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(153, 1, 11, 48, '2016-01-12', '19:45:00', '', 'active', 59, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(154, 1, 11, 36, '1970-01-01', '15:00:00', '', 'active', 58, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(155, 1, 11, 33, '1970-01-01', '15:00:00', '', 'active', 57, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(156, 1, 11, 14, '1970-01-01', '15:00:00', '', 'active', 56, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(157, 1, 11, 18, '1970-01-01', '15:00:00', '', 'active', 55, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(158, 1, 11, 34, '1970-01-01', '15:00:00', '', 'active', 54, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(159, 1, 11, 3, '1970-01-01', '15:00:00', '', 'active', 53, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(160, 1, 11, 44, '2015-10-03', '15:00:00', '', 'active', 52, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(161, 1, 11, 1, '2015-11-03', '19:45:00', '', 'active', 51, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(162, 1, 11, 9, '1970-01-01', '15:00:00', '', 'active', 50, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(163, 1, 11, 45, '1970-01-01', '19:45:00', '', 'active', 49, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(164, 1, 11, 13, '1970-01-01', '19:30:00', '', 'active', 48, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(165, 1, 11, 50, '2015-08-08', '15:00:00', '', 'active', 47, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(166, 4, 0, 0, '1970-01-01', '19:00:00', '', 'active', 46, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(167, 3, 0, 0, '1970-01-01', '10:00:00', '', 'active', 45, '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(168, 3, 0, 0, '1970-01-01', '10:00:00', '', 'active', 44, '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(169, 3, 0, 0, '2015-11-12', '10:00:00', '', 'active', 43, '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(170, 3, 0, 0, '1970-01-01', '10:00:00', '', 'active', 42, '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(171, 3, 0, 0, '2015-11-11', '10:00:00', '', 'active', 41, '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(172, 2, 49, 40, '2015-09-05', '16:00:00', '', 'active', 40, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(173, 3, 0, 0, '2015-11-10', '10:00:00', '', 'active', 39, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(174, 2, 49, 8, '2015-02-01', '14:00:00', '', 'active', 38, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(175, 1, 11, 13, '1970-01-01', '15:00:00', '', 'active', 37, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(176, 1, 11, 33, '1970-01-01', '19:45:00', '', 'active', 36, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(177, 1, 11, 10, '2015-04-11', '15:00:00', '', 'active', 35, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(178, 1, 11, 23, '2015-04-01', '19:45:00', '', 'active', 34, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(179, 1, 11, 14, '1970-01-01', '15:00:00', '', 'active', 33, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(180, 1, 11, 36, '2015-03-07', '15:00:00', '', 'active', 32, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(181, 1, 11, 27, '1970-01-01', '15:00:00', '', 'active', 31, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(182, 1, 11, 4, '2015-03-10', '19:45:00', '', 'active', 30, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(183, 2, 49, 30, '2015-05-09', '15:15:00', '', 'active', 29, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(184, 2, 49, 16, '1970-01-01', '14:00:00', '', 'active', 28, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(185, 2, 49, 41, '2015-03-08', '14:00:00', '', 'active', 27, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(186, 2, 49, 22, '1970-01-01', '13:00:00', '', 'active', 26, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(187, 2, 49, 19, '2015-03-01', '13:00:00', '', 'active', 20, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(188, 1, 11, 42, '2015-02-10', '19:45:00', '', 'active', 19, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(189, 1, 11, 38, '1970-01-01', '15:00:00', '', 'active', 18, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(190, 1, 11, 46, '2015-01-12', '19:45:00', '', 'active', 17, '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(191, 1, 11, 35, '2014-11-12', '19:45:00', '', 'active', 16, '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(192, 2, 49, 20, '1970-01-01', '14:00:00', '', 'active', 15, '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(193, 2, 49, 39, '2015-01-04', '14:00:00', '', 'active', 13, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(194, 1, 11, 51, '2014-11-09', '14:00:00', '', 'active', 12, '2016-04-25 07:50:04', '2016-04-25 07:50:04'),
(195, 2, 49, 24, '1970-01-01', '14:00:00', '', 'active', 11, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(196, 1, 11, 9, '1970-01-01', '15:00:00', '', 'active', 10, '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(197, 1, 11, 17, '1970-01-01', '15:00:00', '', 'active', 9, '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(198, 1, 11, 48, '1970-01-01', '15:00:00', '', 'active', 8, '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(199, 1, 11, 32, '1970-01-01', '15:00:00', '', 'active', 7, '2016-04-25 07:50:07', '2016-04-25 07:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `events_lang`
--

CREATE TABLE `events_lang` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL DEFAULT '1',
  `event_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events_lang`
--

INSERT INTO `events_lang` (`id`, `language_id`, `event_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 103, 'Coventry Bears v Keighley Cougars', 'Coventry Bears welcome Keighley Cougars to the Ricoh Arena.', '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(2, 1, 104, 'Coventry Bears v Keighley Cougars', '', '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(3, 1, 105, 'Champion of Champions Snooker', 'Champion of Champions snooker returns to Coventry, get your car parking here.', '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(4, 1, 106, 'Champion of Champions Snooker', 'Champion of Champions snooker returns to Coventry, get your car parking here.', '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(5, 1, 107, 'Champion of Champions Snooker', 'Champion of Champions snooker returns to Coventry, get your car parking here.', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(6, 1, 108, 'Champion of Champions Snooker', 'Champion of Champions snooker returns to Coventry, get your car parking here.', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(7, 1, 109, 'Champion of Champions Snooker', 'Champion of Champions snooker returns to Coventry, get your car parking here.', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(8, 1, 110, 'Champion of Champions Snooker', 'Champion of Champions snooker returns to Coventry, get your car parking here.', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(9, 1, 111, 'European Champions Cup Semi Final Coach Travel to Madejski Stadium', 'K.O TBC\r\nMadejski Stadium official coach travel.\r\nPlease book 1 per person travelling.\r\nLeaves Car Park C 11:00am.\r\nLeaves Madejski Stadium 1 hour after the final whistle.\r\nParking and leaving your car for the duration of the day at the Ricoh Arena is inc', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(10, 1, 112, 'Jess Glynne', 'Jess Glynne - Jaguar Hall', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(11, 1, 113, 'Bruce Springsteen', 'The Boss returns to the Ricoh Arena this Summer. Buy your car parking here.', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(12, 1, 114, 'MELA', 'Bollywood favourite Rahat Fateh Ali Khan, who sells out shows across the world, will headline the Mela Coventry and take centre stage in a concert on Friday, August 12 to open the festival.', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(13, 1, 115, 'MTV Crashes Saturday Parking Only', '', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(14, 1, 116, 'MTV Crashes Friday Parking Only', 'Are you ready for MTV''s The Crashes? The event will be broadcast across MTV’s flagship UK music TV channels, and will be followed by a Club MTV event on Saturday, May 28.', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(15, 1, 117, 'Wasps v Exeter Chiefs', 'Wasps have made it to the QF''s of the champions cup! Book your parking here.', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(16, 1, 118, 'Coventry City v Coventry City', '', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(17, 1, 119, 'MTV Crashes', 'Are you ready for MTV''s The Crashes? The event will be broadcast across MTV’s flagship UK music TV channels, and will be followed by a Club MTV event on Saturday, May 28.\r\n\r\nPlease choose the car park or campsite that you require.', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(18, 1, 120, 'Rihanna', 'Anti World Tour 2016 at the Ricoh Arena\r\n\r\nDoors Open at 16.00', '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(19, 1, 121, 'Rihanna', 'Non event - Please delete', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(20, 1, 122, 'Coventry City v Northampton Town', 'FA Cup first round', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(21, 1, 123, 'Wasps v Leinster', 'European Rugby Champions Cup', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(22, 1, 124, 'Wasps v Toulon', 'European Rugby Champions Cup', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(23, 1, 125, 'England U21 v Kazakhstan U21', 'The Young Lions will face Kazakhstan in their Group 9 match', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(24, 1, 126, 'Wasps v London Irish', '', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(25, 1, 127, 'Wasps v Northampton Saints', '', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(26, 1, 128, 'Wasps v Sale Sharks', '', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(27, 1, 129, 'Wasps v Leicester Tigers', '', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(28, 1, 130, 'Wasps v Harlequins', '', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(29, 1, 131, 'Wasps v Newcastle Falcons', '', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(30, 1, 132, 'Wasps v Leinster', '', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(31, 1, 133, 'Wasps v Worcester Warriors', '', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(32, 1, 134, 'Wasps v Saracens', '', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(33, 1, 135, 'Wasps v Bath', '', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(34, 1, 136, 'Wasps v Exeter Chiefs', 'Aviva Premiership', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(35, 1, 137, 'Wasps v Northampton Saints', '', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(36, 1, 138, 'Insomnia Gaming Festival - Day 3', '', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(37, 1, 139, 'Insomnia Gaming Festival - Day 2', '', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(38, 1, 140, 'Insomnia Gaming Festival - Day 1', '', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(39, 1, 141, 'Wasps v Gloucester', 'Aviva Premiership', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(40, 1, 142, 'Wasps v Bath', 'Aviva Premiership', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(41, 1, 143, 'Coventry City v Sheffield United', '', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(42, 1, 144, 'Coventry City v Bradford City', '', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(43, 1, 145, 'Coventry City v Millwall', '', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(44, 1, 146, 'Coventry City v Colchester United', '', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(45, 1, 147, 'Coventry City v Swindon Town', '', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(46, 1, 148, 'Coventry City v Rochdale', '', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(47, 1, 149, 'Coventry City v Fleetwood Town', '', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(48, 1, 150, 'Coventry City v Bury', '', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(49, 1, 151, 'Coventry City v Scunthorpe United', '', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(50, 1, 152, 'Coventry City v Burton Albion', '', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(51, 1, 153, 'Coventry City v Walsall', '', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(52, 1, 154, 'Coventry City v Port Vale', '', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(53, 1, 155, 'Coventry City v Oldham Athletic', '', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(54, 1, 156, 'Coventry City v Doncaster Rovers', '', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(55, 1, 157, 'Coventry City v Gillingham', '', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(56, 1, 158, 'Coventry City v Peterborough United', '', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(57, 1, 159, 'Coventry City v Blackpool', '', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(58, 1, 160, 'Coventry City v Shrewsbury Town', '', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(59, 1, 161, 'Coventry City v Barnsley', '', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(60, 1, 162, 'Coventry City v Chesterfield', '', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(61, 1, 163, 'Coventry City v Southend United', '', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(62, 1, 164, 'Coventry City v Crewe Alexandra', 'Sky Bet League 1', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(63, 1, 165, 'Coventry City v Wigan Athletic', 'Sky Bet League 1', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(64, 1, 166, 'Singha Premiership Rugby 7s', 'Group B of the Singha Premiership Rugby 7s Series. Watch as Harlequins, Northampton Saints, Saracens and Wasps do battle.', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(65, 1, 167, 'Champions of Champions Snooker', '', '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(66, 1, 168, 'Champions of Champions Snooker', '', '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(67, 1, 169, 'Champions of Champions Snooker', '', '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(68, 1, 170, 'Champions of Champions Snooker', '', '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(69, 1, 171, 'Champions of Champions Snooker', '', '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(70, 1, 172, 'Wasps v Samoa', 'Rugby World Cup Campaign (warm-up).', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(71, 1, 173, 'Champion of Champions Snooker', 'Snooker&#8217;s new showpiece event Champion of Champions returns to the Ricoh Arena in Coventry, November 10-15 2015, and will bring together many of the best snooker players on the planet.', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(72, 1, 174, 'Wasps v Cardiff Blues', 'LV= Cup', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(73, 1, 175, 'Coventry City v Crewe Alexandra', 'Sky Bet League 1', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(74, 1, 176, 'Coventry City v Oldham Athletic', 'Sky Bet League 1', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(75, 1, 177, 'Coventry City v Colchester United', 'Sky Bet League 1', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(76, 1, 178, 'Coventry City v Leyton Orient', 'Sky Bet League 1', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(77, 1, 179, 'Coventry City v Doncaster Rovers', 'Sky Bet League 1', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(78, 1, 180, 'Coventry City v Port Vale', 'Sky Bet League 1', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(79, 1, 181, 'Coventry City v Milton Keynes Dons', 'Sky Bet League 1', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(80, 1, 182, 'Coventry City v Bradford City', 'Sky Bet League 1', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(81, 1, 183, 'Wasps v Leicester Tigers', 'Aviva Premiership', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(82, 1, 184, 'Wasps v Exeter Chiefs', 'Aviva Premiership', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(83, 1, 185, 'Wasps v Saracens', 'Aviva Premiership', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(84, 1, 186, 'Wasps v Leinster', 'European Rugby Champions Cup', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(85, 1, 187, 'Wasps v Gloucester', 'Aviva Premiership', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(86, 1, 188, 'Coventry City v Scunthorpe United', 'Sky Bet League 1', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(87, 1, 189, 'Coventry City v Rochdale', 'Sky Bet League 1', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(88, 1, 190, 'Coventry City v Swindon Town', 'Sky Bet League 1', '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(89, 1, 191, 'Coventry City v Plymouth Argyle', 'Johnstone''s Paint Trophy', '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(90, 1, 192, 'Wasps v Harlequins', 'Aviva Premiership', '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(91, 1, 193, 'Wasps v Sale Sharks', 'Aviva Premiership', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(92, 1, 194, 'Coventry City v Worcester City', 'The FA Cup - First Round', '2016-04-25 07:50:04', '2016-04-25 07:50:04'),
(93, 1, 195, 'Wasps v London Irish', 'Aviva Premiership', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(94, 1, 196, 'Coventry City v Chesterfield', 'Sky Bet League 1', '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(95, 1, 197, 'Coventry City v Fleetwood Town', 'Sky Bet League 1', '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(96, 1, 198, 'Coventry City v Walsall', '', '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(97, 1, 199, 'Coventry City v Notts County', '', '2016-04-25 07:50:07', '2016-04-25 07:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int(10) unsigned NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest_lists`
--

CREATE TABLE `guest_lists` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `spaces` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest_list_guests`
--

CREATE TABLE `guest_list_guests` (
  `id` int(10) unsigned NOT NULL,
  `guest_list_id` int(10) unsigned NOT NULL,
  `guest_id` int(10) unsigned NOT NULL,
  `email_sent` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `date_sent` datetime DEFAULT NULL,
  `checked_in` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `guid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', NULL, NULL),
(2, 'fr', 'French', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_02_22_091606_create_db_structure', 1);

-- --------------------------------------------------------

--
-- Table structure for table `multi_tickets`
--

CREATE TABLE `multi_tickets` (
  `id` int(10) unsigned NOT NULL,
  `multi_ticket_group_id` int(10) unsigned NOT NULL,
  `car_park_id` int(10) unsigned NOT NULL,
  `price` int(11) NOT NULL,
  `spaces` int(11) NOT NULL DEFAULT '0',
  `used` int(11) NOT NULL DEFAULT '0',
  `status` enum('online','offline','private') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'offline',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `multi_tickets`
--

INSERT INTO `multi_tickets` (`id`, `multi_ticket_group_id`, `car_park_id`, `price`, `spaces`, `used`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1000, 10, 0, 'private', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(2, 1, 1, 10500, 50, 0, 'private', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(3, 1, 1, 16800, 20, 0, 'private', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(4, 1, 1, 16800, 31, 0, 'private', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(5, 1, 1, 4700, 100, 0, 'offline', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(6, 1, 1, 8800, 27, 0, 'offline', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(7, 1, 1, 8800, 54, 0, 'offline', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(8, 1, 1, 3999, 12, 0, 'offline', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(9, 1, 1, 3999, 24, 0, 'offline', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(10, 2, 1, 11000, 0, 0, 'private', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(11, 2, 1, 0, 10, 0, 'private', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(12, 2, 1, 0, 35, 0, 'private', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(13, 2, 1, 0, 550, 0, 'private', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(14, 2, 1, 0, 120, 0, 'private', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(15, 2, 1, 11000, 8, 0, 'online', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(16, 2, 1, 11000, 0, 0, 'private', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(17, 2, 1, 9000, 19, 0, 'online', '2016-04-22 12:57:53', '2016-04-22 12:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `multi_tickets_group`
--

CREATE TABLE `multi_tickets_group` (
  `id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `status` enum('online','offline','private') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'offline',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `multi_tickets_group`
--

INSERT INTO `multi_tickets_group` (`id`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'offline', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(2, 2, 'offline', '2016-04-22 12:57:53', '2016-04-22 12:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `multi_tickets_group_lang`
--

CREATE TABLE `multi_tickets_group_lang` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL DEFAULT '1',
  `multi_ticket_group_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `multi_tickets_group_lang`
--

INSERT INTO `multi_tickets_group_lang` (`id`, `language_id`, `multi_ticket_group_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'CCFC Half Season Ticket', 'CCFC Half Season Ticket on sale - Includes all CCFC home fixtures for the day that you buy your ticket until the end of the 2015-2016 season.', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(2, 1, 2, 'Wasps Season 15/16', '', '2016-04-22 12:57:53', '2016-04-22 12:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `multi_ticket_events`
--

CREATE TABLE `multi_ticket_events` (
  `id` int(10) unsigned NOT NULL,
  `event_id` int(10) unsigned NOT NULL,
  `multi_ticket_group_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL,
  `level` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `id1` int(10) unsigned DEFAULT NULL,
  `id2` int(10) unsigned DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  `order_ref` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_ref` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `orig_order_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `single_ticket_id` int(10) unsigned DEFAULT NULL,
  `multi_ticket_id` int(10) unsigned DEFAULT NULL,
  `price_paid` int(11) NOT NULL,
  `coupon_id` int(10) unsigned DEFAULT NULL,
  `plate_id` int(10) unsigned DEFAULT NULL,
  `checked_in` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `guid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pin_lists`
--

CREATE TABLE `pin_lists` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pin_list_guests`
--

CREATE TABLE `pin_list_guests` (
  `id` int(10) unsigned NOT NULL,
  `pin_list_id` int(10) unsigned NOT NULL,
  `guest_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plates`
--

CREATE TABLE `plates` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `guest_id` int(10) unsigned DEFAULT NULL,
  `plate_number` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL,
  `event_id` int(10) unsigned NOT NULL,
  `car_park_id` int(10) unsigned NOT NULL,
  `allocated` int(11) DEFAULT NULL,
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL,
  `status` enum('online','offline','private','disabled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'online',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1423 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `event_id`, `car_park_id`, `allocated`, `opening_time`, `closing_time`, `status`, `created_at`, `updated_at`) VALUES
(728, 103, 5, 300, '11:00:00', '22:00:00', 'online', '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(729, 104, 5, 300, '11:00:00', '23:00:00', 'online', '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(730, 105, 17, 100, '11:00:00', '23:00:00', 'online', '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(731, 106, 17, 100, '11:00:00', '23:00:00', 'online', '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(732, 107, 17, 100, '11:00:00', '23:00:00', 'online', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(733, 108, 17, 100, '11:00:00', '23:00:00', 'online', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(734, 109, 17, 100, '11:00:00', '23:00:00', 'online', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(735, 110, 17, 100, '11:00:00', '23:00:00', 'online', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(736, 111, 35, 450, '11:00:00', '11:00:00', 'online', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(737, 112, 5, 100, '16:00:00', '23:59:00', 'online', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(738, 112, 15, 20, '16:00:00', '23:59:00', 'online', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(739, 112, 6, 100, '16:00:00', '23:59:00', 'online', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(740, 112, 14, 20, '16:00:00', '23:59:00', 'online', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(741, 112, 7, 100, '16:00:00', '23:59:00', 'online', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(742, 112, 27, 20, '16:00:00', '23:59:00', 'online', '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(743, 113, 1, 900, '09:00:00', '01:30:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(744, 113, 7, 600, '09:00:00', '03:00:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(745, 113, 15, 40, '09:00:00', '03:00:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(746, 113, 28, 180, '09:00:00', '02:00:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(747, 113, 27, 150, '09:00:00', '02:00:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(748, 113, 24, 20, '09:00:00', '02:00:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(749, 113, 29, 20, '09:00:00', '02:00:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(750, 113, 21, 1000, '14:00:00', '01:00:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(751, 113, 5, 80, '09:00:00', '03:00:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(752, 113, 2, 250, '16:30:00', '00:30:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(753, 115, 2, 280, '09:00:00', '23:45:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(754, 115, 7, 500, '09:00:00', '23:45:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(755, 115, 15, 40, '09:00:00', '23:45:00', 'online', '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(756, 116, 28, 100, '12:00:00', '00:00:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(757, 116, 10, 200, '10:15:00', '16:15:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(758, 116, 7, 400, '08:00:00', '23:45:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(759, 116, 15, 40, '08:00:00', '23:45:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(760, 117, 1, 145, '12:00:00', '18:30:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(761, 117, 2, 300, '12:00:00', '18:30:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(762, 117, 7, 192, '12:00:00', '22:30:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(763, 117, 28, 170, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(764, 117, 21, 140, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(765, 117, 10, 290, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(766, 117, 15, 37, '12:00:00', '19:30:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(767, 117, 6, 50, '12:00:00', '20:00:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(768, 117, 5, 103, '12:00:00', '23:00:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(769, 117, 27, 75, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(770, 117, 14, 5, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(771, 117, 29, 11, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(772, 117, 24, 9, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(773, 117, 8, 10, '14:45:00', '14:45:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(774, 117, 6, 10, '14:15:00', '14:15:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(775, 119, 1, 200, '10:00:00', '23:45:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(776, 119, 2, 250, '12:00:00', '23:00:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(777, 119, 7, 400, '15:30:00', '23:45:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(778, 119, 28, 50, '14:00:00', '19:00:00', 'online', '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(779, 120, 1, 500, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(780, 120, 2, 250, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(781, 120, 7, 250, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(782, 120, 28, 100, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(783, 120, 15, 11, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(784, 120, 1, 500, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(785, 120, 2, 280, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(786, 120, 28, 100, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(787, 121, 1, 500, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(788, 121, 2, 250, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(789, 121, 7, 250, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(790, 121, 15, 40, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(791, 122, 5, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(792, 122, 6, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(793, 122, 7, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(794, 122, 15, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(795, 122, 14, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(796, 122, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(797, 122, 1, 130, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(798, 122, 2, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(799, 122, 9, 200, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(800, 122, 8, 10, '09:00:00', '11:00:00', 'online', '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(801, 124, 5, 150, '11:00:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(802, 124, 6, 165, '11:00:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(803, 124, 7, 100, '14:00:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(804, 124, 15, 5, '11:00:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(805, 124, 14, 15, '11:00:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(806, 124, 27, 5, '14:00:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(807, 124, 1, 125, '14:00:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(808, 124, 2, 220, '14:00:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(809, 124, 9, 200, '14:00:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(810, 124, 28, 125, '14:00:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(811, 124, 8, 10, '14:00:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(812, 124, 24, 15, '14:00:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(813, 124, 10, 248, '15:15:00', '20:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(814, 124, 21, 100, '14:30:00', '20:30:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(815, 125, 7, 228, '14:45:00', '20:45:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(816, 125, 1, 130, '14:45:00', '20:45:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(817, 125, 24, 10, '15:45:00', '21:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(818, 125, 15, 10, '15:45:00', '21:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(819, 125, 27, 20, '15:45:00', '21:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(820, 125, 29, 100, '15:00:00', '21:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(821, 125, 5, 50, '15:00:00', '21:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(822, 125, 6, 100, '15:00:00', '21:00:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(823, 126, 1, 130, '12:30:00', '18:30:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(824, 126, 2, 250, '12:30:00', '18:30:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(825, 126, 5, 50, '12:30:00', '18:30:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(826, 126, 7, 100, '12:30:00', '18:30:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(827, 126, 28, 50, '12:30:00', '18:30:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(828, 126, 15, 26, '12:30:00', '18:30:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(829, 126, 5, 100, '10:00:00', '18:30:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(830, 126, 24, 10, '12:30:00', '18:30:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(831, 126, 6, 20, '12:00:00', '23:45:00', 'online', '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(832, 127, 1, 125, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(833, 127, 2, 285, '12:15:00', '19:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(834, 127, 5, 151, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(835, 127, 6, 80, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(836, 127, 7, 175, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(837, 127, 15, 41, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(838, 127, 14, 8, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(839, 127, 27, 30, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(840, 127, 28, 200, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(841, 127, 24, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(842, 127, 8, 1, '10:30:00', '10:30:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(843, 127, 21, 125, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(844, 127, 29, 5, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(845, 127, 10, 201, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(846, 128, 1, 68, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(847, 128, 2, 190, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(848, 128, 5, 120, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(849, 128, 6, 45, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(850, 128, 7, 180, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(851, 128, 15, 30, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(852, 128, 14, 9, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(853, 128, 27, 25, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(854, 128, 28, 150, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(855, 128, 21, 100, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(856, 128, 24, 10, '11:00:00', '19:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(857, 128, 8, 10, '11:00:00', '11:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(858, 129, 2, 290, '10:45:00', '16:45:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(859, 129, 1, 137, '10:45:00', '16:45:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(860, 129, 5, 90, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(861, 129, 6, 23, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(862, 129, 7, 150, '10:45:00', '16:45:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(863, 129, 15, 40, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(864, 129, 14, 9, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(865, 129, 27, 40, '10:45:00', '16:45:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(866, 129, 28, 130, '10:45:00', '16:45:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(867, 129, 24, 10, '10:45:00', '16:45:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(868, 129, 29, 10, '10:45:00', '16:45:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(869, 129, 10, 275, '10:45:00', '16:45:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(870, 129, 21, 115, '10:45:00', '16:45:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(871, 129, 8, 1, '13:30:00', '13:30:00', 'online', '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(872, 130, 1, 135, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(873, 130, 2, 280, '12:00:00', '20:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(874, 130, 5, 150, '11:00:00', '23:30:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(875, 130, 6, 75, '11:00:00', '23:30:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(876, 130, 7, 125, '12:00:00', '21:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(877, 130, 15, 10, '11:00:00', '23:30:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(878, 130, 14, 12, '11:00:00', '23:30:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(879, 130, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(880, 130, 28, 100, '12:00:00', '20:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(881, 130, 29, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(882, 130, 24, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(883, 130, 8, 10, '23:30:00', '23:30:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(884, 130, 21, 100, '12:00:00', '20:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(885, 130, 21, 100, '12:00:00', '18:30:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(886, 131, 1, 135, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(887, 131, 2, 280, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(888, 131, 5, 125, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(889, 131, 6, 100, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(890, 131, 7, 150, '11:00:00', '19:30:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(891, 131, 8, 10, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(892, 131, 15, 10, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(893, 131, 14, 10, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(894, 131, 27, 50, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(895, 131, 28, 11, '11:00:00', '19:30:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(896, 131, 29, 10, '11:00:00', '20:30:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(897, 131, 24, 10, '12:00:00', '20:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(898, 132, 1, 130, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(899, 132, 2, 253, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(900, 132, 9, 200, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(901, 132, 8, 10, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(902, 132, 5, 110, '09:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(903, 132, 6, 82, '09:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(904, 132, 7, 110, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(905, 132, 27, 10, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(906, 132, 28, 72, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(907, 132, 15, 8, '09:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(908, 132, 14, 8, '09:00:00', '18:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(909, 132, 10, 200, '12:30:00', '18:30:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(910, 132, 21, 120, '12:30:00', '18:30:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(911, 132, 24, 10, '12:00:00', '20:00:00', 'online', '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(912, 133, 1, 112, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(913, 133, 2, 253, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(914, 133, 9, 1, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(915, 133, 8, 10, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(916, 133, 5, 130, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(917, 133, 6, 83, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(918, 133, 7, 100, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(919, 133, 27, 20, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(920, 133, 15, 15, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(921, 133, 14, 10, '11:00:00', '17:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(922, 133, 28, 50, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(923, 133, 24, 20, '11:00:00', '17:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(924, 133, 21, 110, '11:00:00', '17:00:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(925, 133, 10, 150, '19:45:00', '19:45:00', 'online', '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(926, 134, 1, 141, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(927, 134, 2, 250, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(928, 134, 9, 12, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(929, 134, 8, 10, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(930, 134, 5, 175, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(931, 134, 6, 24, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(932, 134, 7, 112, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(933, 134, 27, 20, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(934, 134, 15, 5, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(935, 134, 28, 50, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(936, 134, 14, 5, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(937, 134, 21, 115, '11:15:00', '18:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(938, 134, 10, 50, '11:15:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(939, 134, 24, 10, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(940, 135, 5, 130, '14:15:00', '21:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(941, 135, 6, 25, '14:15:00', '21:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(942, 135, 7, 125, '14:15:00', '21:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(943, 135, 15, 5, '14:15:00', '21:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(944, 135, 14, 5, '14:15:00', '21:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(945, 135, 27, 15, '14:15:00', '21:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(946, 135, 1, 120, '14:15:00', '21:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(947, 135, 2, 250, '14:15:00', '21:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(948, 135, 9, 0, '14:15:00', '21:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(949, 135, 28, 22, '14:15:00', '21:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(950, 135, 24, 10, '14:15:00', '21:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(951, 135, 8, 10, '14:15:00', '20:15:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(952, 136, 1, 110, '14:30:00', '20:30:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(953, 136, 2, 250, '14:30:00', '20:30:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(954, 136, 9, 7, '14:30:00', '23:30:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(955, 136, 8, 10, '11:30:00', '00:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(956, 136, 27, 10, '14:30:00', '23:30:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(957, 136, 7, 105, '14:30:00', '23:30:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(958, 136, 6, 30, '11:30:00', '00:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(959, 136, 5, 150, '11:30:00', '00:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(960, 136, 15, 5, '11:30:00', '00:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(961, 136, 14, 5, '11:30:00', '00:00:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(962, 136, 28, 50, '14:30:00', '20:30:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(963, 136, 24, 10, '14:15:00', '20:30:00', 'online', '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(964, 137, 1, 130, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(965, 137, 6, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(966, 137, 7, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(967, 137, 14, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(968, 137, 27, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(969, 137, 2, 250, '12:00:00', '21:15:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(970, 137, 9, 200, '12:00:00', '21:15:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(971, 137, 5, 100, '12:00:00', '21:15:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(972, 137, 15, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(973, 137, 28, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(974, 137, 24, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(975, 137, 8, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(976, 138, 21, 800, '08:00:00', '21:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(977, 138, 14, 15, '09:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(978, 139, 21, 800, '08:00:00', '21:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(979, 139, 14, 15, '09:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(980, 140, 21, 800, '08:00:00', '21:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(981, 140, 14, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(982, 141, 1, 74, '12:00:00', '22:45:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(983, 141, 2, 220, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(984, 141, 5, 200, '11:00:00', '22:45:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(985, 141, 6, 100, '11:00:00', '22:45:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(986, 141, 7, 50, '12:00:00', '22:45:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(987, 141, 9, 150, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(988, 141, 10, 200, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(989, 141, 14, 15, '11:00:00', '22:45:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(990, 141, 15, 5, '11:00:00', '22:45:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(991, 141, 24, 10, '12:00:00', '22:45:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(992, 141, 27, 10, '12:00:00', '22:45:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(993, 141, 8, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(994, 141, 28, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(995, 142, 1, 130, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(996, 142, 2, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(997, 142, 5, 150, '11:00:00', '22:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(998, 142, 6, 100, '11:00:00', '23:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(999, 142, 7, 100, '12:00:00', '21:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1000, 142, 9, 200, '11:00:00', '14:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1001, 142, 10, 200, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1002, 142, 14, 5, '11:00:00', '21:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1003, 142, 15, 40, '12:00:00', '23:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1004, 142, 24, 10, '12:00:00', '23:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1005, 142, 27, 20, '12:00:00', '19:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1006, 142, 28, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1007, 142, 8, 10, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1008, 143, 5, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1009, 143, 6, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1010, 143, 7, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1011, 143, 15, 40, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1012, 143, 14, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1013, 143, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1014, 143, 8, 10, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1015, 143, 1, 130, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1016, 143, 2, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1017, 144, 5, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1018, 144, 6, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1019, 144, 7, 300, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1020, 144, 15, 40, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1021, 144, 14, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1022, 144, 27, 50, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1023, 144, 8, 10, '16:15:00', '22:15:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1024, 144, 1, 130, '23:15:00', '23:15:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1025, 144, 2, 250, '23:15:00', '23:15:00', 'online', '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(1026, 145, 5, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1027, 145, 6, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1028, 145, 7, 150, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1029, 145, 15, 40, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1030, 145, 14, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1031, 145, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1032, 145, 8, 10, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1033, 145, 27, 50, '10:00:00', '18:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1034, 145, 2, 250, '12:00:00', '18:45:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1035, 145, 1, 130, '12:00:00', '18:30:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1036, 146, 5, 150, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1037, 146, 6, 150, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1038, 146, 7, 300, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1039, 146, 15, 40, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1040, 146, 14, 15, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1041, 146, 27, 50, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1042, 146, 8, 10, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1043, 146, 1, 130, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1044, 146, 2, 250, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1045, 146, 24, 5, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(1046, 147, 5, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1047, 147, 6, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1048, 147, 7, 300, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1049, 147, 15, 40, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1050, 147, 14, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1051, 147, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1052, 147, 8, 10, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1053, 147, 1, 130, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1054, 147, 2, 250, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1055, 147, 24, 18, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1056, 147, 29, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1057, 148, 5, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1058, 148, 6, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1059, 148, 7, 170, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1060, 148, 15, 20, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1061, 148, 14, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1062, 148, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1063, 148, 8, 10, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1064, 148, 2, 250, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1065, 148, 1, 130, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1066, 149, 5, 150, '12:45:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1067, 149, 6, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1068, 149, 7, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1069, 149, 15, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1070, 149, 14, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1071, 149, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1072, 149, 8, 10, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1073, 149, 1, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1074, 149, 2, 200, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1075, 149, 29, 100, '12:00:00', '23:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1076, 149, 24, 10, '12:00:00', '23:00:00', 'online', '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(1077, 150, 5, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1078, 150, 6, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1079, 150, 7, 450, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1080, 150, 15, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1081, 150, 14, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1082, 150, 27, 20, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1083, 150, 8, 0, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1084, 150, 1, 130, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1085, 150, 2, 250, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1086, 151, 5, 70, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1087, 151, 6, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1088, 151, 7, 200, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1089, 151, 15, 5, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1090, 151, 14, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1091, 151, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1092, 151, 8, 10, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1093, 151, 1, 130, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1094, 151, 2, 250, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1095, 152, 5, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1096, 152, 6, 25, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1097, 152, 7, 210, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1098, 152, 15, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1099, 152, 14, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1100, 152, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1101, 152, 8, 10, '12:15:00', '18:15:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1102, 152, 1, 130, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1103, 152, 2, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1104, 152, 7, 1, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1105, 153, 5, 125, '14:00:00', '23:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1106, 153, 6, 35, '14:00:00', '23:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1107, 153, 7, 400, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1108, 153, 15, 5, '14:00:00', '23:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1109, 153, 14, 5, '14:00:00', '23:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1110, 153, 27, 14, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1111, 153, 8, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1112, 153, 1, 130, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1113, 153, 2, 150, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1114, 153, 24, 10, '16:30:00', '22:30:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1115, 153, 29, 10, '16:30:00', '22:30:00', 'online', '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(1116, 154, 5, 91, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1117, 154, 6, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1118, 154, 7, 200, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1119, 154, 15, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1120, 154, 14, 8, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1121, 154, 27, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1122, 154, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1123, 154, 8, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1124, 154, 1, 130, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1125, 154, 2, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1126, 155, 5, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1127, 155, 6, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1128, 155, 7, 200, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1129, 155, 15, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1130, 155, 14, 5, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1131, 155, 27, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1132, 155, 8, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1133, 155, 1, 130, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1134, 155, 2, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1135, 156, 5, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1136, 156, 6, 0, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1137, 156, 7, 41, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1138, 156, 15, 5, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1139, 156, 14, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1140, 156, 27, 1, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1141, 156, 8, 0, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1142, 156, 1, 120, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1143, 156, 2, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1144, 156, 9, 0, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(1145, 157, 5, 100, '09:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1146, 157, 6, 100, '09:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1147, 157, 7, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1148, 157, 15, 5, '09:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1149, 157, 14, 5, '09:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1150, 157, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1151, 157, 8, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1152, 157, 1, 130, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1153, 157, 2, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1154, 157, 9, 200, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1155, 157, 24, 5, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1156, 158, 5, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1157, 158, 6, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1158, 158, 7, 150, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1159, 158, 15, 5, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1160, 158, 14, 5, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1161, 158, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1162, 158, 1, 130, '12:00:00', '21:30:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1163, 158, 2, 250, '12:00:00', '21:30:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1164, 158, 9, 200, '21:30:00', '21:30:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1165, 158, 8, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1166, 159, 5, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1167, 159, 6, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1168, 159, 7, 200, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1169, 159, 15, 40, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1170, 159, 14, 5, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1171, 159, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1172, 159, 8, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1173, 159, 1, 130, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1174, 159, 2, 250, '12:00:00', '18:30:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1175, 159, 9, 200, '12:00:00', '21:30:00', 'online', '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(1176, 160, 5, 1, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1177, 160, 6, 150, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1178, 160, 7, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1179, 160, 15, 40, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1180, 160, 14, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1181, 160, 27, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1182, 160, 8, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1183, 160, 9, 200, '12:15:00', '22:15:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1184, 160, 1, 130, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1185, 160, 2, 250, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1186, 161, 5, 100, '16:00:00', '22:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1187, 161, 6, 100, '16:00:00', '22:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1188, 161, 7, 100, '12:00:00', '23:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1189, 161, 15, 40, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1190, 161, 14, 15, '12:30:00', '12:30:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1191, 161, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1192, 161, 8, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1193, 161, 1, 130, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1194, 161, 2, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1195, 161, 9, 200, '12:00:00', '21:30:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1196, 162, 5, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1197, 162, 6, 20, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1198, 162, 7, 150, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1199, 162, 15, 40, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1200, 162, 14, 15, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1201, 162, 1, 130, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1202, 162, 2, 250, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1203, 162, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1204, 162, 8, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1205, 162, 9, 200, '12:15:00', '22:00:00', 'online', '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(1206, 163, 7, 40, '17:30:00', '22:30:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1207, 163, 6, 0, '17:30:00', '22:30:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1208, 163, 5, 0, '17:30:00', '22:30:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1209, 163, 18, 100, '17:30:00', '22:30:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1210, 163, 15, 0, '17:30:00', '22:30:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1211, 163, 14, 0, '17:30:00', '22:30:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1212, 163, 1, 140, '16:00:00', '22:30:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1213, 163, 2, 180, '16:30:00', '22:45:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1214, 163, 27, 50, '16:00:00', '22:30:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1215, 163, 9, 200, '17:15:00', '22:45:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1216, 163, 8, 10, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1217, 164, 1, 130, '18:00:00', '22:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1218, 164, 2, 250, '17:30:00', '22:30:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1219, 164, 5, 20, '17:00:00', '23:59:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1220, 164, 6, 100, '17:00:00', '23:59:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1221, 164, 7, 100, '17:00:00', '23:59:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1222, 164, 14, 15, '17:00:00', '23:59:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1223, 164, 15, 40, '17:00:00', '23:59:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1224, 164, 5, 100, '17:00:00', '23:59:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1225, 164, 27, 50, '17:00:00', '23:59:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1226, 164, 8, 10, '17:00:00', '23:59:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1227, 164, 9, 200, '17:30:00', '22:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1228, 165, 1, 130, '12:15:00', '17:45:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1229, 165, 2, 250, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1230, 165, 6, 20, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1231, 165, 7, 200, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1232, 165, 5, 20, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1233, 165, 15, 40, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1234, 165, 14, 5, '12:00:00', '12:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46');
INSERT INTO `products` (`id`, `event_id`, `car_park_id`, `allocated`, `opening_time`, `closing_time`, `status`, `created_at`, `updated_at`) VALUES
(1235, 165, 27, 50, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1236, 165, 8, 10, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1237, 166, 7, 40, '16:00:00', '01:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1238, 166, 26, 15, '16:00:00', '23:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1239, 166, 14, 3, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1240, 166, 6, 100, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1241, 166, 1, 530, '16:00:00', '02:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1242, 166, 9, 150, '16:00:00', '23:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1243, 166, 8, 40, '16:00:00', '23:00:00', 'online', '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(1244, 167, 17, 100, '10:00:00', '23:00:00', 'online', '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(1245, 168, 17, 100, '10:00:00', '23:00:00', 'online', '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(1246, 169, 17, 100, '10:00:00', '23:00:00', 'online', '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(1247, 170, 17, 100, '10:00:00', '23:00:00', 'online', '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(1248, 171, 17, 100, '10:15:00', '23:00:00', 'online', '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(1249, 172, 1, 140, '12:00:00', '19:30:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1250, 172, 7, 100, '12:00:00', '19:30:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1251, 172, 27, 26, '12:00:00', '19:30:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1252, 172, 14, 7, '12:00:00', '19:30:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1253, 172, 6, 50, '12:00:00', '19:30:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1254, 172, 2, 250, '12:15:00', '22:00:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1255, 172, 9, 250, '12:00:00', '22:30:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1256, 172, 24, 20, '14:00:00', '20:00:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1257, 172, 5, 50, '13:30:00', '20:00:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1258, 172, 8, 1, '21:45:00', '21:45:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1259, 173, 5, 100, '10:00:00', '23:59:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1260, 173, 15, 20, '10:00:00', '23:00:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1261, 173, 17, 100, '10:00:00', '23:00:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1262, 174, 1, 140, '11:15:00', '17:00:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1263, 174, 2, 250, '11:15:00', '17:30:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1264, 174, 5, 188, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1265, 174, 15, 33, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1266, 174, 7, 100, '11:30:00', '18:00:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1267, 174, 6, 65, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1268, 174, 9, 32, '11:15:00', '17:30:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1269, 174, 8, 70, '11:00:00', '17:30:00', 'online', '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(1270, 175, 1, 140, '12:00:00', '20:45:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1271, 175, 2, 250, '12:00:00', '20:45:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1272, 175, 7, 400, '12:00:00', '21:00:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1273, 175, 7, 400, '12:00:00', '21:00:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1274, 176, 1, 140, '17:15:00', '22:00:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1275, 176, 2, 250, '17:00:00', '22:00:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1276, 176, 7, 400, '17:00:00', '23:00:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1277, 177, 1, 140, '12:15:00', '20:45:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1278, 177, 2, 250, '12:00:00', '20:45:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1279, 177, 7, 400, '12:00:00', '21:00:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1280, 178, 1, 140, '18:00:00', '22:00:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1281, 178, 2, 250, '17:30:00', '22:15:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1282, 178, 7, 400, '16:00:00', '23:00:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1283, 179, 1, 120, '12:15:00', '17:45:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1284, 179, 2, 150, '12:15:00', '17:45:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1285, 179, 7, 400, '12:00:00', '21:00:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1286, 179, 14, 5, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1287, 179, 5, 1, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(1288, 180, 1, 120, '12:15:00', '17:45:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1289, 180, 2, 150, '12:15:00', '17:45:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1290, 180, 7, 400, '12:00:00', '21:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1291, 180, 9, 200, '12:15:00', '20:30:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1292, 180, 8, 10, '12:15:00', '20:30:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1293, 181, 1, 121, '12:15:00', '17:45:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1294, 181, 2, 150, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1295, 181, 7, 200, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1296, 181, 8, 0, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1297, 181, 9, 200, '21:15:00', '13:15:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1298, 182, 1, 120, '16:15:00', '22:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1299, 182, 2, 150, '16:45:00', '22:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1300, 182, 7, 100, '22:00:00', '19:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1301, 182, 9, 200, '12:15:00', '20:30:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1302, 183, 1, 400, '12:15:00', '17:30:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1303, 183, 2, 290, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1304, 183, 15, 29, '11:15:00', '18:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1305, 183, 5, 81, '11:15:00', '18:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1306, 183, 6, 50, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1307, 183, 7, 102, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1308, 183, 9, 155, '11:15:00', '21:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1309, 183, 10, 360, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1310, 183, 24, 15, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1311, 183, 14, 15, '11:15:00', '11:15:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1312, 183, 8, 10, '11:15:00', '17:15:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1313, 183, 21, 600, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1314, 183, 25, 1000, '12:15:00', '20:00:00', 'online', '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(1315, 184, 1, 144, '11:15:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1316, 184, 2, 280, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1317, 184, 15, 25, '10:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1318, 184, 5, 150, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1319, 184, 6, 101, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1320, 184, 7, 100, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1321, 184, 10, 250, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1322, 184, 14, 15, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1323, 184, 9, 400, '11:15:00', '21:45:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1324, 184, 8, 10, '10:15:00', '10:15:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1325, 185, 1, 135, '11:15:00', '17:30:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1326, 185, 2, 267, '11:15:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1327, 185, 15, 25, '10:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1328, 185, 5, 250, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1329, 185, 6, 150, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1330, 185, 7, 165, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1331, 185, 10, 240, '11:15:00', '17:45:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1332, 185, 14, 15, '10:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1333, 185, 9, 110, '12:00:00', '23:30:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1334, 185, 8, 0, '11:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1335, 186, 1, 144, '10:00:00', '16:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1336, 186, 2, 290, '10:00:00', '16:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1337, 186, 5, 185, '10:00:00', '16:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1338, 186, 15, 30, '10:00:00', '19:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1339, 186, 9, 205, '10:00:00', '22:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1340, 186, 6, 49, '10:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1341, 186, 7, 150, '10:00:00', '20:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1342, 186, 14, 0, '16:45:00', '16:45:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1343, 186, 10, 260, '11:15:00', '18:30:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1344, 186, 23, 30, '10:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1345, 186, 8, 0, '10:00:00', '18:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1346, 186, 21, 100, '10:00:00', '17:00:00', 'online', '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(1347, 187, 1, 130, '10:15:00', '17:00:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1348, 187, 2, 270, '10:15:00', '17:00:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1349, 187, 7, 100, '11:00:00', '19:30:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1350, 187, 14, 15, '11:00:00', '19:30:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1351, 187, 15, 25, '11:00:00', '19:30:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1352, 187, 6, 175, '11:00:00', '19:30:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1353, 187, 10, 250, '10:15:00', '17:00:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1354, 187, 5, 200, '11:00:00', '23:30:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1355, 187, 9, 200, '11:15:00', '21:00:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1356, 187, 8, 0, '08:00:00', '23:45:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1357, 188, 1, 120, '16:30:00', '23:00:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1358, 188, 2, 150, '16:30:00', '23:00:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1359, 188, 7, 100, '11:00:00', '19:00:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1360, 189, 1, 120, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1361, 189, 2, 150, '12:15:00', '18:00:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1362, 189, 7, 100, '11:15:00', '19:00:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1363, 189, 5, 20, '12:00:00', '18:00:00', 'online', '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(1364, 190, 1, 120, '16:00:00', '23:00:00', 'online', '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(1365, 190, 2, 150, '16:30:00', '23:00:00', 'online', '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(1366, 190, 7, 30, '11:15:00', '19:00:00', 'online', '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(1367, 191, 1, 120, '17:30:00', '22:30:00', 'online', '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(1368, 191, 2, 150, '17:30:00', '22:30:00', 'online', '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(1369, 192, 1, 130, '11:00:00', '18:00:00', 'online', '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(1370, 192, 7, 100, '11:00:00', '19:00:00', 'online', '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(1371, 192, 14, 15, '11:00:00', '21:30:00', 'online', '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(1372, 192, 6, 50, '11:00:00', '21:30:00', 'online', '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(1373, 192, 15, 25, '11:00:00', '21:00:00', 'online', '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(1374, 192, 2, 270, '11:00:00', '17:00:00', 'online', '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(1375, 192, 10, 230, '11:00:00', '17:00:00', 'online', '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(1376, 192, 5, 100, '11:00:00', '18:00:00', 'online', '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(1377, 192, 9, 200, '13:00:00', '13:00:00', 'online', '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(1378, 192, 8, 0, '14:15:00', '14:15:00', 'online', '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(1379, 192, 21, 120, '14:15:00', '18:00:00', 'online', '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(1380, 193, 1, 138, '11:15:00', '17:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1381, 193, 2, 270, '11:15:00', '17:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1382, 193, 7, 50, '11:00:00', '20:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1383, 193, 14, 10, '10:00:00', '22:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1384, 193, 6, 50, '10:00:00', '22:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1385, 193, 15, 30, '11:00:00', '20:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1386, 193, 5, 40, '11:00:00', '20:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1387, 193, 9, 300, '11:15:00', '18:15:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1388, 193, 10, 0, '13:00:00', '16:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1389, 193, 21, 75, '11:15:00', '17:30:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1390, 193, 8, 100, '11:00:00', '20:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1391, 193, 18, 500, '11:00:00', '20:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1392, 193, 20, 300, '11:00:00', '17:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1393, 193, 22, 50, '11:00:00', '17:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1394, 193, 19, 100, '11:00:00', '17:00:00', 'online', '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(1395, 194, 1, 120, '11:00:00', '16:00:00', 'online', '2016-04-25 07:50:04', '2016-04-25 07:50:04'),
(1396, 194, 2, 100, '11:00:00', '16:00:00', 'online', '2016-04-25 07:50:04', '2016-04-25 07:50:04'),
(1397, 194, 9, 1, '11:00:00', '16:00:00', 'online', '2016-04-25 07:50:04', '2016-04-25 07:50:04'),
(1398, 194, 10, 50, '11:00:00', '16:00:00', 'online', '2016-04-25 07:50:04', '2016-04-25 07:50:04'),
(1399, 195, 1, 130, '11:00:00', '17:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1400, 195, 2, 240, '11:00:00', '17:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1401, 195, 5, 20, '10:00:00', '22:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1402, 195, 15, 31, '10:00:00', '22:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1403, 195, 6, 50, '10:00:00', '22:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1404, 195, 10, 370, '11:00:00', '17:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1405, 195, 10, 370, '11:00:00', '17:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1406, 195, 9, 200, '11:00:00', '21:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1407, 195, 8, 100, '10:00:00', '22:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1408, 195, 18, 500, '11:00:00', '17:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1409, 195, 19, 300, '12:00:00', '17:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1410, 195, 20, 300, '11:00:00', '17:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1411, 195, 21, 200, '11:00:00', '17:00:00', 'online', '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(1412, 196, 1, 120, '12:00:00', '18:00:00', 'online', '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(1413, 196, 2, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(1414, 197, 1, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(1415, 197, 2, 150, '12:00:00', '18:00:00', 'online', '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(1416, 197, 17, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(1417, 197, 5, 20, '12:00:00', '23:45:00', 'online', '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(1418, 197, 7, 100, '12:00:00', '22:00:00', 'online', '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(1419, 198, 1, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(1420, 198, 2, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(1421, 199, 1, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:50:07', '2016-04-25 07:50:07'),
(1422, 199, 2, 100, '12:00:00', '18:00:00', 'online', '2016-04-25 07:50:07', '2016-04-25 07:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `created_at`, `updated_at`) VALUES
(1, '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(2, '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(3, '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(4, '2016-04-22 12:57:52', '2016-04-22 12:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `roles_lang`
--

CREATE TABLE `roles_lang` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL DEFAULT '1',
  `role_id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles_lang`
--

INSERT INTO `roles_lang` (`id`, `language_id`, `role_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Admin', NULL, '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(2, 1, 2, 'Registered', NULL, '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(3, 1, 3, 'Guest List', NULL, '2016-04-22 12:57:52', '2016-04-22 12:57:52'),
(4, 1, 4, 'Car Park Owner', NULL, '2016-04-22 12:57:52', '2016-04-22 12:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `single_tickets`
--

CREATE TABLE `single_tickets` (
  `id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=696 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `single_tickets`
--

INSERT INTO `single_tickets` (`id`, `product_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 728, 300, '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(2, 729, 0, '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(3, 730, 500, '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(4, 731, 500, '2016-04-25 07:49:25', '2016-04-25 07:49:25'),
(5, 732, 500, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(6, 733, 500, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(7, 734, 500, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(8, 735, 500, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(9, 736, 1500, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(10, 737, 1000, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(11, 738, 1000, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(12, 739, 1000, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(13, 740, 1000, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(14, 741, 1000, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(15, 742, 1000, '2016-04-25 07:49:26', '2016-04-25 07:49:26'),
(16, 743, 2000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(17, 744, 2000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(18, 745, 2000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(19, 746, 2000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(20, 747, 2000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(21, 748, 3000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(22, 749, 3000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(23, 750, 2000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(24, 751, 2000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(25, 752, 2000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(26, 753, 1000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(27, 754, 1000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(28, 755, 1000, '2016-04-25 07:49:27', '2016-04-25 07:49:27'),
(29, 756, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(30, 757, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(31, 758, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(32, 759, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(33, 760, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(34, 761, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(35, 762, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(36, 763, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(37, 764, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(38, 765, 1500, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(39, 766, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(40, 767, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(41, 768, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(42, 769, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(43, 770, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(44, 771, 2000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(45, 772, 2000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(46, 773, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(47, 774, 1000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(48, 775, 2000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(49, 776, 2000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(50, 777, 2000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(51, 778, 2000, '2016-04-25 07:49:28', '2016-04-25 07:49:28'),
(52, 779, 2000, '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(53, 780, 2000, '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(54, 781, 2000, '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(55, 782, 2000, '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(56, 783, 2000, '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(57, 784, 2000, '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(58, 785, 2000, '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(59, 786, 2000, '2016-04-25 07:49:29', '2016-04-25 07:49:29'),
(60, 787, 2000, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(61, 788, 2000, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(62, 789, 2000, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(63, 790, 2000, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(64, 791, 1000, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(65, 792, 1000, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(66, 793, 500, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(67, 794, 1000, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(68, 795, 1000, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(69, 796, 500, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(70, 797, 500, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(71, 798, 500, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(72, 799, 500, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(73, 800, 1000, '2016-04-25 07:49:30', '2016-04-25 07:49:30'),
(74, 801, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(75, 802, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(76, 803, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(77, 804, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(78, 805, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(79, 806, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(80, 807, 2000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(81, 808, 1500, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(82, 809, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(83, 810, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(84, 811, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(85, 812, 2000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(86, 813, 2000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(87, 814, 2000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(88, 815, 500, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(89, 816, 500, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(90, 817, 2000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(91, 818, 500, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(92, 819, 500, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(93, 820, 1500, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(94, 821, 500, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(95, 822, 500, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(96, 823, 500, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(97, 824, 500, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(98, 825, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(99, 826, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(100, 827, 500, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(101, 828, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(102, 829, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(103, 830, 2000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(104, 831, 1000, '2016-04-25 07:49:31', '2016-04-25 07:49:31'),
(105, 832, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(106, 833, 500, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(107, 834, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(108, 835, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(109, 836, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(110, 837, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(111, 838, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(112, 839, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(113, 840, 500, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(114, 841, 2000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(115, 842, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(116, 843, 500, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(117, 844, 2000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(118, 845, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(119, 846, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(120, 847, 300, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(121, 848, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(122, 849, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(123, 850, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(124, 851, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(125, 852, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(126, 853, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(127, 854, 500, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(128, 855, 200, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(129, 856, 2000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(130, 857, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(131, 858, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(132, 859, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(133, 860, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(134, 861, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(135, 862, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(136, 863, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(137, 864, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(138, 865, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(139, 866, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(140, 867, 2000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(141, 868, 2000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(142, 869, 1500, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(143, 870, 500, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(144, 871, 1000, '2016-04-25 07:49:32', '2016-04-25 07:49:32'),
(145, 872, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(146, 873, 700, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(147, 874, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(148, 875, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(149, 876, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(150, 877, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(151, 878, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(152, 879, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(153, 880, 700, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(154, 881, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(155, 882, 2000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(156, 883, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(157, 884, 200, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(158, 885, 200, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(159, 886, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(160, 887, 500, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(161, 888, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(162, 889, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(163, 890, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(164, 891, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(165, 892, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(166, 893, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(167, 894, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(168, 895, 500, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(169, 896, 2000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(170, 897, 2000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(171, 898, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(172, 899, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(173, 900, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(174, 901, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(175, 902, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(176, 903, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(177, 904, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(178, 905, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(179, 906, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(180, 907, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(181, 908, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(182, 909, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(183, 910, 1000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(184, 911, 2000, '2016-04-25 07:49:33', '2016-04-25 07:49:33'),
(185, 912, 1000, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(186, 913, 700, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(187, 914, 700, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(188, 915, 1000, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(189, 916, 1000, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(190, 917, 1000, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(191, 918, 1000, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(192, 919, 1000, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(193, 920, 1000, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(194, 921, 1000, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(195, 922, 700, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(196, 923, 2000, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(197, 924, 1000, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(198, 925, 1000, '2016-04-25 07:49:35', '2016-04-25 07:49:35'),
(199, 926, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(200, 927, 700, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(201, 928, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(202, 929, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(203, 930, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(204, 931, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(205, 932, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(206, 933, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(207, 934, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(208, 935, 700, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(209, 936, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(210, 937, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(211, 938, 2000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(212, 939, 2000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(213, 940, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(214, 941, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(215, 942, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(216, 943, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(217, 944, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(218, 945, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(219, 946, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(220, 947, 800, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(221, 948, 800, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(222, 949, 800, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(223, 950, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(224, 951, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(225, 952, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(226, 953, 700, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(227, 954, 700, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(228, 955, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(229, 956, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(230, 957, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(231, 958, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(232, 959, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(233, 960, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(234, 961, 1000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(235, 962, 700, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(236, 963, 2000, '2016-04-25 07:49:36', '2016-04-25 07:49:36'),
(237, 964, 500, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(238, 965, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(239, 966, 500, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(240, 967, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(241, 968, 500, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(242, 969, 500, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(243, 970, 500, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(244, 971, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(245, 972, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(246, 973, 500, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(247, 974, 2000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(248, 975, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(249, 976, 1200, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(250, 977, 1200, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(251, 978, 1200, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(252, 979, 1200, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(253, 980, 1200, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(254, 981, 1200, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(255, 982, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(256, 983, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(257, 984, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(258, 985, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(259, 986, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(260, 987, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(261, 988, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(262, 989, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(263, 990, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(264, 991, 2000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(265, 992, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(266, 993, 1000, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(267, 994, 500, '2016-04-25 07:49:37', '2016-04-25 07:49:37'),
(268, 995, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(269, 996, 500, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(270, 997, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(271, 998, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(272, 999, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(273, 1000, 500, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(274, 1001, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(275, 1002, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(276, 1003, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(277, 1004, 2000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(278, 1005, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(279, 1006, 500, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(280, 1007, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(281, 1008, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(282, 1009, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(283, 1010, 500, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(284, 1011, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(285, 1012, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(286, 1013, 500, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(287, 1014, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(288, 1015, 300, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(289, 1016, 150, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(290, 1017, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(291, 1018, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(292, 1019, 500, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(293, 1020, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(294, 1021, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(295, 1022, 500, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(296, 1023, 1000, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(297, 1024, 200, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(298, 1025, 200, '2016-04-25 07:49:39', '2016-04-25 07:49:39'),
(299, 1026, 1000, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(300, 1027, 1000, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(301, 1028, 500, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(302, 1029, 1000, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(303, 1030, 1000, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(304, 1031, 500, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(305, 1032, 1000, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(306, 1033, 1000, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(307, 1034, 200, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(308, 1035, 200, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(309, 1036, 1000, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(310, 1037, 1000, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(311, 1038, 500, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(312, 1039, 1000, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(313, 1040, 1000, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(314, 1041, 500, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(315, 1042, 1000, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(316, 1043, 300, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(317, 1044, 150, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(318, 1045, 1000, '2016-04-25 07:49:40', '2016-04-25 07:49:40'),
(319, 1046, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(320, 1047, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(321, 1048, 500, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(322, 1049, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(323, 1050, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(324, 1051, 500, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(325, 1052, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(326, 1053, 500, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(327, 1054, 250, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(328, 1055, 2000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(329, 1056, 2000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(330, 1057, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(331, 1058, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(332, 1059, 500, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(333, 1060, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(334, 1061, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(335, 1062, 500, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(336, 1063, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(337, 1064, 250, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(338, 1065, 500, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(339, 1066, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(340, 1067, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(341, 1068, 500, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(342, 1069, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(343, 1070, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(344, 1071, 500, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(345, 1072, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(346, 1073, 500, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(347, 1074, 250, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(348, 1075, 1000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(349, 1076, 2000, '2016-04-25 07:49:41', '2016-04-25 07:49:41'),
(350, 1077, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(351, 1078, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(352, 1079, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(353, 1080, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(354, 1081, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(355, 1082, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(356, 1083, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(357, 1084, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(358, 1085, 250, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(359, 1086, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(360, 1087, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(361, 1088, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(362, 1089, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(363, 1090, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(364, 1091, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(365, 1092, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(366, 1093, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(367, 1094, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(368, 1095, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(369, 1096, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(370, 1097, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(371, 1098, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(372, 1099, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(373, 1100, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(374, 1101, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(375, 1102, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(376, 1103, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(377, 1104, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(378, 1105, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(379, 1106, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(380, 1107, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(381, 1108, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(382, 1109, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(383, 1110, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(384, 1111, 1000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(385, 1112, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(386, 1113, 500, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(387, 1114, 2000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(388, 1115, 2000, '2016-04-25 07:49:42', '2016-04-25 07:49:42'),
(389, 1116, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(390, 1117, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(391, 1118, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(392, 1119, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(393, 1120, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(394, 1121, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(395, 1122, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(396, 1123, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(397, 1124, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(398, 1125, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(399, 1126, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(400, 1127, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(401, 1128, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(402, 1129, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(403, 1130, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(404, 1131, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(405, 1132, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(406, 1133, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(407, 1134, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(408, 1135, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(409, 1136, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(410, 1137, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(411, 1138, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(412, 1139, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(413, 1140, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(414, 1141, 1000, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(415, 1142, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(416, 1143, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(417, 1144, 500, '2016-04-25 07:49:43', '2016-04-25 07:49:43'),
(418, 1145, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(419, 1146, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(420, 1147, 500, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(421, 1148, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(422, 1149, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(423, 1150, 500, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(424, 1151, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(425, 1152, 500, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(426, 1153, 500, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(427, 1154, 500, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(428, 1155, 2000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(429, 1156, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(430, 1157, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(431, 1158, 500, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(432, 1159, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(433, 1160, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(434, 1161, 500, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(435, 1162, 500, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(436, 1163, 300, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(437, 1164, 500, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(438, 1165, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(439, 1166, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(440, 1167, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(441, 1168, 500, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(442, 1169, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(443, 1170, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(444, 1171, 500, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(445, 1172, 1000, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(446, 1173, 500, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(447, 1174, 350, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(448, 1175, 200, '2016-04-25 07:49:44', '2016-04-25 07:49:44'),
(449, 1176, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(450, 1177, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(451, 1178, 500, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(452, 1179, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(453, 1180, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(454, 1181, 500, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(455, 1182, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(456, 1183, 250, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(457, 1184, 500, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(458, 1185, 300, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(459, 1186, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(460, 1187, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(461, 1188, 500, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(462, 1189, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(463, 1190, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(464, 1191, 500, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(465, 1192, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(466, 1193, 500, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(467, 1194, 500, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(468, 1195, 500, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(469, 1196, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(470, 1197, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(471, 1198, 500, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(472, 1199, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(473, 1200, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(474, 1201, 500, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(475, 1202, 300, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(476, 1203, 500, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(477, 1204, 1000, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(478, 1205, 250, '2016-04-25 07:49:45', '2016-04-25 07:49:45'),
(479, 1206, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(480, 1207, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(481, 1208, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(482, 1209, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(483, 1210, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(484, 1211, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(485, 1212, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(486, 1213, 250, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(487, 1214, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(488, 1215, 200, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(489, 1216, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(490, 1217, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(491, 1218, 250, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(492, 1219, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(493, 1220, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(494, 1221, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(495, 1222, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(496, 1223, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(497, 1224, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(498, 1225, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(499, 1226, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(500, 1227, 100, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(501, 1228, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(502, 1229, 300, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(503, 1230, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(504, 1231, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(505, 1232, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(506, 1233, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(507, 1234, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(508, 1235, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(509, 1236, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(510, 1237, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(511, 1238, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(512, 1239, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(513, 1240, 1000, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(514, 1241, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(515, 1242, 500, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(516, 1243, 0, '2016-04-25 07:49:46', '2016-04-25 07:49:46'),
(517, 1244, 500, '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(518, 1245, 500, '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(519, 1246, 500, '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(520, 1247, 500, '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(521, 1248, 500, '2016-04-25 07:49:47', '2016-04-25 07:49:47'),
(522, 1249, 500, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(523, 1250, 500, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(524, 1251, 500, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(525, 1252, 1000, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(526, 1253, 1000, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(527, 1254, 500, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(528, 1255, 500, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(529, 1256, 2000, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(530, 1257, 1000, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(531, 1258, 0, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(532, 1259, 500, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(533, 1260, 500, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(534, 1261, 500, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(535, 1262, 700, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(536, 1263, 300, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(537, 1264, 500, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(538, 1265, 500, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(539, 1266, 500, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(540, 1267, 500, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(541, 1268, 100, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(542, 1269, 0, '2016-04-25 07:49:49', '2016-04-25 07:49:49'),
(543, 1270, 500, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(544, 1271, 150, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(545, 1272, 500, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(546, 1273, 500, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(547, 1274, 400, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(548, 1275, 150, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(549, 1276, 500, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(550, 1277, 500, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(551, 1278, 300, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(552, 1279, 500, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(553, 1280, 500, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(554, 1281, 200, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(555, 1282, 500, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(556, 1283, 390, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(557, 1284, 150, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(558, 1285, 500, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(559, 1286, 1000, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(560, 1287, 1000, '2016-04-25 07:49:50', '2016-04-25 07:49:50'),
(561, 1288, 400, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(562, 1289, 150, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(563, 1290, 500, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(564, 1291, 250, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(565, 1292, 0, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(566, 1293, 500, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(567, 1294, 300, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(568, 1295, 500, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(569, 1296, 0, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(570, 1297, 250, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(571, 1298, 400, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(572, 1299, 150, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(573, 1300, 500, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(574, 1301, 250, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(575, 1302, 1000, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(576, 1303, 1000, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(577, 1304, 500, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(578, 1305, 1000, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(579, 1306, 1000, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(580, 1307, 1000, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(581, 1308, 1000, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(582, 1309, 2000, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(583, 1310, 2000, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(584, 1311, 500, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(585, 1312, 1000, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(586, 1313, 1000, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(587, 1314, 500, '2016-04-25 07:49:51', '2016-04-25 07:49:51'),
(588, 1315, 600, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(589, 1316, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(590, 1317, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(591, 1318, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(592, 1319, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(593, 1320, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(594, 1321, 700, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(595, 1322, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(596, 1323, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(597, 1324, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(598, 1325, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(599, 1326, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(600, 1327, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(601, 1328, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(602, 1329, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(603, 1330, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(604, 1331, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(605, 1332, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(606, 1333, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(607, 1334, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(608, 1335, 1500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(609, 1336, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(610, 1337, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(611, 1338, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(612, 1339, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(613, 1340, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(614, 1341, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(615, 1342, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(616, 1343, 1500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(617, 1344, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(618, 1345, 500, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(619, 1346, 1000, '2016-04-25 07:49:52', '2016-04-25 07:49:52'),
(620, 1347, 999, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(621, 1348, 400, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(622, 1349, 1000, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(623, 1350, 500, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(624, 1351, 500, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(625, 1352, 1000, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(626, 1353, 999, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(627, 1354, 1000, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(628, 1355, 500, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(629, 1356, 10000, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(630, 1357, 350, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(631, 1358, 275, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(632, 1359, 500, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(633, 1360, 350, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(634, 1361, 150, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(635, 1362, 500, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(636, 1363, 500, '2016-04-25 07:49:58', '2016-04-25 07:49:58'),
(637, 1364, 400, '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(638, 1365, 150, '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(639, 1366, 500, '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(640, 1367, 300, '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(641, 1368, 300, '2016-04-25 07:49:59', '2016-04-25 07:49:59'),
(642, 1369, 1000, '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(643, 1370, 1000, '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(644, 1371, 500, '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(645, 1372, 1000, '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(646, 1373, 500, '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(647, 1374, 500, '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(648, 1375, 1000, '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(649, 1376, 1000, '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(650, 1377, 500, '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(651, 1378, 1000, '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(652, 1379, 500, '2016-04-25 07:50:01', '2016-04-25 07:50:01'),
(653, 1380, 500, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(654, 1381, 500, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(655, 1382, 500, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(656, 1383, 500, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(657, 1384, 500, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(658, 1385, 500, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(659, 1386, 500, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(660, 1387, 500, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(661, 1388, 500, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(662, 1389, 500, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(663, 1390, 0, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(664, 1391, 0, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(665, 1392, 0, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(666, 1393, 0, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(667, 1394, 0, '2016-04-25 07:50:03', '2016-04-25 07:50:03'),
(668, 1395, 300, '2016-04-25 07:50:04', '2016-04-25 07:50:04'),
(669, 1396, 300, '2016-04-25 07:50:04', '2016-04-25 07:50:04'),
(670, 1397, 300, '2016-04-25 07:50:04', '2016-04-25 07:50:04'),
(671, 1398, 500, '2016-04-25 07:50:04', '2016-04-25 07:50:04'),
(672, 1399, 1000, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(673, 1400, 500, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(674, 1401, 500, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(675, 1402, 500, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(676, 1403, 500, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(677, 1404, 1000, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(678, 1405, 1000, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(679, 1406, 500, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(680, 1407, 0, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(681, 1408, 0, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(682, 1409, 0, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(683, 1410, 0, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(684, 1411, 1000, '2016-04-25 07:50:05', '2016-04-25 07:50:05'),
(685, 1412, 400, '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(686, 1413, 150, '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(687, 1414, 400, '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(688, 1415, 150, '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(689, 1416, 500, '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(690, 1417, 1000, '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(691, 1418, 500, '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(692, 1419, 250, '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(693, 1420, 150, '2016-04-25 07:50:06', '2016-04-25 07:50:06'),
(694, 1421, 300, '2016-04-25 07:50:07', '2016-04-25 07:50:07'),
(695, 1422, 300, '2016-04-25 07:50:07', '2016-04-25 07:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `logo` blob,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `category_id`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 0x6261726e736c65795f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(2, 2, 0x626174685f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(3, 1, 0x626c61636b706f6f6c5f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(4, 1, 0x62726164666f72645f636974795f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(5, 1, 0x62726973746f6c5f636974795f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(6, 1, 0x627572746f6e5f616c62696f6e5f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(7, 1, 0x627572795f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(8, 2, 0x636172646966665f626c7565735f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(9, 1, 0x636865737465726669656c645f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(10, 1, 0x636f6c636865737465725f756e697465645f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(11, 1, 0x636f76656e7472795f636974795f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(12, 1, 0x637261776c65795f746f776e5f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(13, 1, 0x63726577655f616c6578616e6472615f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(14, 1, 0x646f6e6361737465725f726f766572735f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(15, 1, 0x656e676c616e645f7532315f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(16, 2, 0x6578657465725f6368696566735f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(17, 1, 0x666c656574776f6f645f746f776e5f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(18, 1, 0x67696c6c696e6768616d5f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(19, 2, 0x676c6f756365737465725f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(20, 2, 0x6861726c657175696e735f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(21, 1, 0x6b617a616b687374616e5f7532315f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(22, 1, 0x6c65696e737465725f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(23, 1, 0x6c6579746f6e5f6f7269656e745f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(24, 2, 0x6c6f6e646f6e5f69726973685f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(25, 2, 0x6c6f6e646f6e5f77656c73685f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(26, 1, 0x6d696c6c77616c6c5f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(27, 1, 0x6d6b5f646f6e735f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(28, 2, 0x6e6577636173746c655f66616c636f6e735f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(29, 2, 0x6e6f727468616d70746f6e5f7361696e74735f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(30, 1, 0x6c65696365737465725f7469676572735f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(31, 1, 0x6e6f727468616d70746f6e5f746f776e5f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(32, 1, 0x6e6f7474735f636f756e74795f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(33, 1, 0x6f6c6468616d5f6174686c657469635f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(34, 1, 0x7065746572626f726f7567685f756e697465645f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(35, 1, 0x706c796d6f7574685f617267796c655f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(36, 1, 0x706f72745f76616c655f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(37, 1, 0x70726573746f6e5f6e6f7274685f656e645f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(38, 1, 0x726f636864616c655f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(39, 2, 0x73616c655f736861726b735f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(40, 2, 0x73616d6f615f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(41, 2, 0x7361726163656e735f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(42, 1, 0x7363756e74686f7270655f756e697465645f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(43, 1, 0x736865666669656c645f756e697465645f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(44, 1, 0x736872657773627572795f746f776e5f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(45, 1, 0x736f757468656e645f756e697465645f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(46, 1, 0x7377696e646f6e5f746f776e5f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(47, 2, 0x746f756c6f6e5f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(48, 1, 0x77616c73616c6c5f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(49, 2, 0x77617370735f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(50, 1, 0x776967616e5f6174686c657469635f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(51, 1, 0x776f726365737465725f636974795f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(52, 2, 0x776f726365737465725f77617272696f72735f72632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(53, 1, 0x79656f76696c5f746f776e5f66632e706e67, 'active', '2016-04-22 12:57:53', '2016-04-22 12:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `teams_lang`
--

CREATE TABLE `teams_lang` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL DEFAULT '1',
  `team_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teams_lang`
--

INSERT INTO `teams_lang` (`id`, `language_id`, `team_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Barnsley', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(2, 1, 2, 'Bath', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(3, 1, 3, 'Blackpool', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(4, 1, 4, 'Bradford City', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(5, 1, 5, 'Bristol City', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(6, 1, 6, 'Burton Albion', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(7, 1, 7, 'Bury', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(8, 1, 8, 'Cardiff Blues', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(9, 1, 9, 'Chesterfield', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(10, 1, 10, 'Colchester United', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(11, 1, 11, 'Coventry City', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(12, 1, 12, 'Crawley Town', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(13, 1, 13, 'Crewe Alexandra', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(14, 1, 14, 'Doncaster Rovers', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(15, 1, 15, 'England U21', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(16, 1, 16, 'Exeter Chiefs', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(17, 1, 17, 'Fleetwood Town', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(18, 1, 18, 'Gillingham', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(19, 1, 19, 'Gloucester', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(20, 1, 20, 'Harlequins', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(21, 1, 21, 'Kazakhstan U21', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(22, 1, 22, 'Leinster', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(23, 1, 23, 'Leyton Orient', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(24, 1, 24, 'London Irish', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(25, 1, 25, 'London Welsh', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(26, 1, 26, 'Millwall', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(27, 1, 27, 'Milton Keynes Dons', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(28, 1, 28, 'Newcastle Falcons', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(29, 1, 29, 'Northampton Saints', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(30, 1, 30, 'Leicester Tigers', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(31, 1, 31, 'Northampton Town', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(32, 1, 32, 'Notts County', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(33, 1, 33, 'Oldham Athletic', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(34, 1, 34, 'Peterborough United', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(35, 1, 35, 'Plymouth Argyle', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(36, 1, 36, 'Port Vale', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(37, 1, 37, 'Preston North End', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(38, 1, 38, 'Rochdale', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(39, 1, 39, 'Sale Sharks', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(40, 1, 40, 'Samoa', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(41, 1, 41, 'Saracens', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(42, 1, 42, 'Scunthorpe United', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(43, 1, 43, 'Sheffield United', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(44, 1, 44, 'Shrewsbury Town', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(45, 1, 45, 'Southend United', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(46, 1, 46, 'Swindon Town', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(47, 1, 47, 'Toulon', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(48, 1, 48, 'Walsall', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(49, 1, 49, 'Wasps', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(50, 1, 50, 'Wigan Athletic', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(51, 1, 51, 'Worcester City', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(52, 1, 52, 'Worcester Warriors', '2016-04-22 12:57:53', '2016-04-22 12:57:53'),
(53, 1, 53, 'Yeovil Town', '2016-04-22 12:57:53', '2016-04-22 12:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `address_id` int(10) unsigned DEFAULT NULL,
  `language_id` int(10) unsigned NOT NULL DEFAULT '1',
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('guest','registered') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'guest',
  `checked_in` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `address_id`, `language_id`, `firstname`, `lastname`, `password`, `telephone`, `email`, `type`, `checked_in`, `status`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 1, NULL, 1, 'Mary', 'Bohdanowitsch', '', NULL, 'marybohdanowitsch@yahoo.co.uk', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(2, 1, NULL, 1, 'Tom', 'Legg', '', NULL, 'tom.legg@estuk.co.uk ', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(3, 1, NULL, 1, 'Sarah', 'Jane', '', NULL, 'sarah.jane@estuk.co.uk', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(4, 1, NULL, 1, 'brian', 'test@capuk.eu', '', NULL, 'test@capuk.eu', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(5, 1, NULL, 1, 'Daniel', 'Salotra', '', NULL, 'daniel.salotra@estuk.co.uk', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(6, 1, NULL, 1, 'Anthony', 'Kavanagh', '', NULL, 'anthony.kavanagh@estuk.co.uk ', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(7, 1, NULL, 1, 'Christopher', 'O’Toole', '', NULL, 'Christopher.otoole@estuk.co.uk', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(8, 3, NULL, 1, 'David', 'Busst', '', NULL, 'David.Busst@ccfc.co.uk', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(9, 3, NULL, 1, 'Nicki', 'Pollard', '', NULL, 'Nicki.Pollard@ccfc.co.uk', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(10, 3, NULL, 1, 'Kieran', 'Crowley', '', NULL, 'kieran.crowley@ccfc.co.uk', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(11, 3, NULL, 1, 'Vicki', 'Gough', '', NULL, 'Vicki.Gough@ccfc.co.uk', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(12, 3, NULL, 1, 'Tynan', 'Scope', '', NULL, 'tynan.scope@ccfc.co.uk', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(13, 3, NULL, 1, 'Simon', 'Goroll', '', NULL, 'simon.goroll@wasps.co.uk ', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(14, 3, NULL, 1, 'Joe', 'Hagan', '', NULL, 'Joe.Hagen@ricoharena.com', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(15, 3, NULL, 1, 'Melissa', 'Spence', '', NULL, 'mspence@hortons.co.uk', 'registered', '', '', '0000-00-00 00:00:00', '2016-04-22 12:57:52', NULL),
(16, 3, NULL, 1, 'Ambassador', 'Ambassador', '', NULL, 'ambassador@example.com ', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(17, 3, NULL, 1, 'Clair', 'Fitzgerald', '', NULL, 'clair@capuk.eu', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(18, 3, NULL, 1, 'Melissa', 'Platt', '', NULL, 'melissa.platt@wasps.co.uk ', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(19, 3, NULL, 1, 'Baginton Fields', 'School', '', NULL, 'baginton@example.com', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(20, 3, NULL, 1, 'Hospo', 'Hospo', '', NULL, 'hospo@example.com ', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(21, 3, NULL, 1, 'Guestlist', 'Test', '', NULL, 'test@example.com', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(22, 3, NULL, 1, 'Kevin', 'Harman', '', NULL, 'kevin.harman@wasps.co.uk', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(23, 3, NULL, 1, 'Roxie', 'Haines', '', NULL, 'roxie.haines@wasps.co.uk', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL),
(24, 3, NULL, 1, 'AndrewGL', 'Williams', '', NULL, 'me@andrew-williams.com', 'registered', '', 'active', '2016-04-22 12:57:52', '2016-04-22 12:57:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wastages`
--

CREATE TABLE `wastages` (
  `id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `wastage_reason_id` int(10) unsigned NOT NULL,
  `spaces` int(11) NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wastage_reasons`
--

CREATE TABLE `wastage_reasons` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wastage_reasons_lang`
--

CREATE TABLE `wastage_reasons_lang` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL DEFAULT '1',
  `wastage_reason_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_postcode_index` (`postcode`);

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_parks`
--
ALTER TABLE `car_parks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_parks_lang`
--
ALTER TABLE `car_parks_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_parks_lang_car_park_id_foreign` (`car_park_id`),
  ADD KEY `car_parks_lang_language_id_foreign` (`language_id`);

--
-- Indexes for table `car_park_owners`
--
ALTER TABLE `car_park_owners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_park_owners_user_id_foreign` (`user_id`),
  ADD KEY `car_park_owners_car_park_id_foreign` (`car_park_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories_lang`
--
ALTER TABLE `categories_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_lang_category_id_foreign` (`category_id`),
  ADD KEY `categories_lang_language_id_foreign` (`language_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons_allocated`
--
ALTER TABLE `coupons_allocated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_allocated_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupons_allocated_multi_ticket_id_index` (`multi_ticket_id`),
  ADD KEY `coupons_allocated_single_ticket_id_index` (`single_ticket_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_category_id_foreign` (`category_id`),
  ADD KEY `events_featured_index` (`featured`);

--
-- Indexes for table `events_lang`
--
ALTER TABLE `events_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_lang_event_id_foreign` (`event_id`),
  ADD KEY `events_lang_language_id_foreign` (`language_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_lists`
--
ALTER TABLE `guest_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guest_lists_user_id_foreign` (`user_id`),
  ADD KEY `guest_lists_product_id_foreign` (`product_id`);

--
-- Indexes for table `guest_list_guests`
--
ALTER TABLE `guest_list_guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guest_list_guests_guest_list_id_foreign` (`guest_list_id`),
  ADD KEY `guest_list_guests_guest_id_foreign` (`guest_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_tickets`
--
ALTER TABLE `multi_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `multi_tickets_car_park_id_foreign` (`car_park_id`),
  ADD KEY `multi_tickets_multi_ticket_group_id_foreign` (`multi_ticket_group_id`);

--
-- Indexes for table `multi_tickets_group`
--
ALTER TABLE `multi_tickets_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `multi_tickets_group_category_id_foreign` (`category_id`);

--
-- Indexes for table `multi_tickets_group_lang`
--
ALTER TABLE `multi_tickets_group_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `multi_tickets_group_lang_multi_ticket_group_id_foreign` (`multi_ticket_group_id`),
  ADD KEY `multi_tickets_group_lang_language_id_foreign` (`language_id`);

--
-- Indexes for table `multi_ticket_events`
--
ALTER TABLE `multi_ticket_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `multi_ticket_events_event_id_foreign` (`event_id`),
  ADD KEY `multi_ticket_events_multi_ticket_group_id_foreign` (`multi_ticket_group_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_ref_unique` (`order_ref`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_address_id_foreign` (`address_id`),
  ADD KEY `orders_transaction_ref_index` (`transaction_ref`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_single_ticket_id_index` (`single_ticket_id`),
  ADD KEY `order_details_multi_ticket_id_index` (`multi_ticket_id`),
  ADD KEY `order_details_plate_id_index` (`plate_id`);

--
-- Indexes for table `pin_lists`
--
ALTER TABLE `pin_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pin_lists_user_id_foreign` (`user_id`);

--
-- Indexes for table `pin_list_guests`
--
ALTER TABLE `pin_list_guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pin_list_guests_pin_list_id_foreign` (`pin_list_id`),
  ADD KEY `pin_list_guests_guest_id_foreign` (`guest_id`);

--
-- Indexes for table `plates`
--
ALTER TABLE `plates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plates_user_id_index` (`user_id`),
  ADD KEY `plates_guest_id_index` (`guest_id`),
  ADD KEY `plates_plate_number_index` (`plate_number`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_event_id_foreign` (`event_id`),
  ADD KEY `products_car_park_id_foreign` (`car_park_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_lang`
--
ALTER TABLE `roles_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_lang_role_id_foreign` (`role_id`),
  ADD KEY `roles_lang_language_id_foreign` (`language_id`);

--
-- Indexes for table `single_tickets`
--
ALTER TABLE `single_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `single_tickets_product_id_foreign` (`product_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_category_id_foreign` (`category_id`);

--
-- Indexes for table `teams_lang`
--
ALTER TABLE `teams_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_lang_team_id_foreign` (`team_id`),
  ADD KEY `teams_lang_language_id_foreign` (`language_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `wastages`
--
ALTER TABLE `wastages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wastages_product_id_foreign` (`product_id`),
  ADD KEY `wastages_wastage_reason_id_foreign` (`wastage_reason_id`);

--
-- Indexes for table `wastage_reasons`
--
ALTER TABLE `wastage_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wastage_reasons_lang`
--
ALTER TABLE `wastage_reasons_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wastage_reasons_lang_wastage_reason_id_foreign` (`wastage_reason_id`),
  ADD KEY `wastage_reasons_lang_language_id_foreign` (`language_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `car_parks`
--
ALTER TABLE `car_parks`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `car_parks_lang`
--
ALTER TABLE `car_parks_lang`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `car_park_owners`
--
ALTER TABLE `car_park_owners`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `categories_lang`
--
ALTER TABLE `categories_lang`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coupons_allocated`
--
ALTER TABLE `coupons_allocated`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=200;
--
-- AUTO_INCREMENT for table `events_lang`
--
ALTER TABLE `events_lang`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `guest_lists`
--
ALTER TABLE `guest_lists`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `guest_list_guests`
--
ALTER TABLE `guest_list_guests`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `multi_tickets`
--
ALTER TABLE `multi_tickets`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `multi_tickets_group`
--
ALTER TABLE `multi_tickets_group`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `multi_tickets_group_lang`
--
ALTER TABLE `multi_tickets_group_lang`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `multi_ticket_events`
--
ALTER TABLE `multi_ticket_events`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pin_lists`
--
ALTER TABLE `pin_lists`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pin_list_guests`
--
ALTER TABLE `pin_list_guests`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plates`
--
ALTER TABLE `plates`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1423;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roles_lang`
--
ALTER TABLE `roles_lang`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `single_tickets`
--
ALTER TABLE `single_tickets`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=696;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `teams_lang`
--
ALTER TABLE `teams_lang`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `wastages`
--
ALTER TABLE `wastages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wastage_reasons`
--
ALTER TABLE `wastage_reasons`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wastage_reasons_lang`
--
ALTER TABLE `wastage_reasons_lang`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_parks_lang`
--
ALTER TABLE `car_parks_lang`
  ADD CONSTRAINT `car_parks_lang_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `car_parks_lang_car_park_id_foreign` FOREIGN KEY (`car_park_id`) REFERENCES `car_parks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `car_park_owners`
--
ALTER TABLE `car_park_owners`
  ADD CONSTRAINT `car_park_owners_car_park_id_foreign` FOREIGN KEY (`car_park_id`) REFERENCES `car_parks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `car_park_owners_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `categories_lang`
--
ALTER TABLE `categories_lang`
  ADD CONSTRAINT `categories_lang_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `categories_lang_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `coupons_allocated`
--
ALTER TABLE `coupons_allocated`
  ADD CONSTRAINT `coupons_allocated_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `events_lang`
--
ALTER TABLE `events_lang`
  ADD CONSTRAINT `events_lang_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `events_lang_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `guest_lists`
--
ALTER TABLE `guest_lists`
  ADD CONSTRAINT `guest_lists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `guest_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `guest_list_guests`
--
ALTER TABLE `guest_list_guests`
  ADD CONSTRAINT `guest_list_guests_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `guest_list_guests_guest_list_id_foreign` FOREIGN KEY (`guest_list_id`) REFERENCES `guest_lists` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `multi_tickets`
--
ALTER TABLE `multi_tickets`
  ADD CONSTRAINT `multi_tickets_multi_ticket_group_id_foreign` FOREIGN KEY (`multi_ticket_group_id`) REFERENCES `multi_tickets_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `multi_tickets_car_park_id_foreign` FOREIGN KEY (`car_park_id`) REFERENCES `car_parks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `multi_tickets_group`
--
ALTER TABLE `multi_tickets_group`
  ADD CONSTRAINT `multi_tickets_group_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `multi_tickets_group_lang`
--
ALTER TABLE `multi_tickets_group_lang`
  ADD CONSTRAINT `multi_tickets_group_lang_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `multi_tickets_group_lang_multi_ticket_group_id_foreign` FOREIGN KEY (`multi_ticket_group_id`) REFERENCES `multi_tickets_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `multi_ticket_events`
--
ALTER TABLE `multi_ticket_events`
  ADD CONSTRAINT `multi_ticket_events_multi_ticket_group_id_foreign` FOREIGN KEY (`multi_ticket_group_id`) REFERENCES `multi_tickets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `multi_ticket_events_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pin_lists`
--
ALTER TABLE `pin_lists`
  ADD CONSTRAINT `pin_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pin_list_guests`
--
ALTER TABLE `pin_list_guests`
  ADD CONSTRAINT `pin_list_guests_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pin_list_guests_pin_list_id_foreign` FOREIGN KEY (`pin_list_id`) REFERENCES `pin_lists` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_car_park_id_foreign` FOREIGN KEY (`car_park_id`) REFERENCES `car_parks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `products_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `roles_lang`
--
ALTER TABLE `roles_lang`
  ADD CONSTRAINT `roles_lang_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `roles_lang_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `single_tickets`
--
ALTER TABLE `single_tickets`
  ADD CONSTRAINT `single_tickets_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teams_lang`
--
ALTER TABLE `teams_lang`
  ADD CONSTRAINT `teams_lang_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `teams_lang_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wastages`
--
ALTER TABLE `wastages`
  ADD CONSTRAINT `wastages_wastage_reason_id_foreign` FOREIGN KEY (`wastage_reason_id`) REFERENCES `wastage_reasons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `wastages_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wastage_reasons_lang`
--
ALTER TABLE `wastage_reasons_lang`
  ADD CONSTRAINT `wastage_reasons_lang_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `wastage_reasons_lang_wastage_reason_id_foreign` FOREIGN KEY (`wastage_reason_id`) REFERENCES `wastage_reasons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
