-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 03:08 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinefoodsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `date`) VALUES
(1, 'admin1', '11111111', 'admin1@imail.com', '2023-10-18 05:08:04'),
(2, 'admin2', '22222222', 'admin2@imail.com', '2023-10-18 05:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `c_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `rs_id`, `c_id`, `title`, `slogan`, `price`, `img`) VALUES
(56, 6, 1, 'Signature Mala Spicy', 'Tongue-tingling and aromatic broth, infused with a potent blend of Sichuan peppercorns, dried chili peppers, and various spices, delivering a numbing and spicy flavor profile to elevate hot pot and other dishes.', '19.90', '655910dc857ca.jpg'),
(57, 7, 1, 'Signature Mala Spicy', 'Tongue-tingling and aromatic broth, infused with a potent blend of Sichuan peppercorns, dried chili peppers, and various spices, delivering a numbing and spicy flavor profile to elevate hot pot and other dishes.', '19.90', '655910dc857ca.jpg'),
(58, 8, 1, 'Signature Mala Spicy', 'Tongue-tingling and aromatic broth, infused with a potent blend of Sichuan peppercorns, dried chili peppers, and various spices, delivering a numbing and spicy flavor profile to elevate hot pot and other dishes.', '19.90', '655910dc857ca.jpg'),
(59, 9, 1, 'Signature Mala Spicy', 'Tongue-tingling and aromatic broth, infused with a potent blend of Sichuan peppercorns, dried chili peppers, and various spices, delivering a numbing and spicy flavor profile to elevate hot pot and other dishes.', '19.90', '655910dc857ca.jpg'),
(60, 10, 1, 'Signature Mala Spicy', 'Tongue-tingling and aromatic broth, infused with a potent blend of Sichuan peppercorns, dried chili peppers, and various spices, delivering a numbing and spicy flavor profile to elevate hot pot and other dishes.', '19.90', '655910dc857ca.jpg'),
(61, 6, 1, 'Pepper Mushroom', 'Rich and earthy broth crafted from assorted mushrooms, creating a savory and umami-packed foundation for hearty and comforting dishes.', '19.90', '655911ab988ac.jpg'),
(62, 7, 1, 'Pepper Mushroom', 'Rich and earthy broth crafted from assorted mushrooms, creating a savory and umami-packed foundation for hearty and comforting dishes.', '19.90', '655911ab988ac.jpg'),
(63, 8, 1, 'Pepper Mushroom', 'Rich and earthy broth crafted from assorted mushrooms, creating a savory and umami-packed foundation for hearty and comforting dishes.', '19.90', '655911ab988ac.jpg'),
(64, 9, 1, 'Pepper Mushroom', 'Rich and earthy broth crafted from assorted mushrooms, creating a savory and umami-packed foundation for hearty and comforting dishes.', '19.90', '655911ab988ac.jpg'),
(65, 10, 1, 'Pepper Mushroom', 'Rich and earthy broth crafted from assorted mushrooms, creating a savory and umami-packed foundation for hearty and comforting dishes.', '19.90', '655911ab988ac.jpg'),
(67, 6, 1, 'Sweet Tomato', 'Comforting and flavorful broth made from ripe tomatoes, aromatic herbs, and spices, providing a classic and wholesome taste.', '19.90', '65591215c1b14.jpg'),
(68, 7, 1, 'Sweet Tomato', 'Comforting and flavorful broth made from ripe tomatoes, aromatic herbs, and spices, providing a classic and wholesome taste.', '19.90', '65591215c1b14.jpg'),
(69, 8, 1, 'Sweet Tomato', 'Comforting and flavorful broth made from ripe tomatoes, aromatic herbs, and spices, providing a classic and wholesome taste.', '19.90', '65591215c1b14.jpg'),
(70, 9, 1, 'Sweet Tomato', 'Comforting and flavorful broth made from ripe tomatoes, aromatic herbs, and spices, providing a classic and wholesome taste.', '19.90', '65591215c1b14.jpg'),
(71, 10, 1, 'Sweet Tomato', 'Comforting and flavorful broth made from ripe tomatoes, aromatic herbs, and spices, providing a classic and wholesome taste.', '19.90', '65591215c1b14.jpg'),
(72, 6, 2, 'Curry Marinated Chicken', 'Succulent poultry infused with a vibrant blend of aromatic curry spices, delivering a flavorful and enticing culinary experience.', '18.90', '655989ebd4f8d.jpg'),
(73, 7, 2, 'Curry Marinated Chicken', 'Succulent poultry infused with a vibrant blend of aromatic curry spices, delivering a flavorful and enticing culinary experience.', '18.90', '655989f9e5668.jpg'),
(74, 8, 2, 'Curry Marinated Chicken', 'Succulent poultry infused with a vibrant blend of aromatic curry spices, delivering a flavorful and enticing culinary experience.', '18.90', '65598a050fce7.jpg'),
(75, 9, 2, 'Curry Marinated Chicken', 'Succulent poultry infused with a vibrant blend of aromatic curry spices, delivering a flavorful and enticing culinary experience.', '18.90', '65598a1387ebe.jpg'),
(76, 10, 2, 'Curry Marinated Chicken', 'Succulent poultry infused with a vibrant blend of aromatic curry spices, delivering a flavorful and enticing culinary experience.', '18.90', '65598a1fef1b2.jpg'),
(77, 6, 2, 'Kobe Beef Slices', 'Exceptionally tender and marbled, offering a luxurious dining experience with their rich flavor and melt-in-your-mouth texture.', '25.90', '655989c56b491.jpg'),
(78, 7, 2, 'Kobe Beef Slices', 'Exceptionally tender and marbled, offering a luxurious dining experience with their rich flavor and melt-in-your-mouth texture.', '25.90', '655989c56b491.jpg'),
(79, 8, 2, 'Kobe Beef Slices', 'Exceptionally tender and marbled, offering a luxurious dining experience with their rich flavor and melt-in-your-mouth texture.', '25.90', '655989c56b491.jpg'),
(80, 9, 2, 'Kobe Beef Slices', 'Exceptionally tender and marbled, offering a luxurious dining experience with their rich flavor and melt-in-your-mouth texture.', '25.90', '655989c56b491.jpg'),
(81, 10, 2, 'Kobe Beef Slices', 'Exceptionally tender and marbled, offering a luxurious dining experience with their rich flavor and melt-in-your-mouth texture.', '25.90', '655989c56b491.jpg'),
(82, 6, 2, 'Golden Pork Intestine', 'Crispy and savory deep-fried pork intestines, offering a flavorful and indulgent delicacy with a satisfying crunch.', '20.90', '65598a9c18d02.jpg'),
(83, 7, 2, 'Golden Pork Intestine', 'Crispy and savory deep-fried pork intestines, offering a flavorful and indulgent delicacy with a satisfying crunch.', '20.90', '65598a9c18d02.jpg'),
(84, 8, 2, 'Golden Pork Intestine', 'Crispy and savory deep-fried pork intestines, offering a flavorful and indulgent delicacy with a satisfying crunch.', '20.90', '65598a9c18d02.jpg'),
(85, 9, 2, 'Golden Pork Intestine', 'Crispy and savory deep-fried pork intestines, offering a flavorful and indulgent delicacy with a satisfying crunch.', '20.90', '65598a9c18d02.jpg'),
(86, 10, 2, 'Golden Pork Intestine', 'Crispy and savory deep-fried pork intestines, offering a flavorful and indulgent delicacy with a satisfying crunch.', '20.90', '65598a9c18d02.jpg'),
(87, 6, 2, 'Premium Pork Belly', 'Succulent and well-marbled cut, known for its exceptional tenderness and rich flavor, perfect for indulgent and delicious meals.', '20.90', '65598cbf813c1.png'),
(88, 7, 2, 'Premium Pork Belly', 'Succulent and well-marbled cut, known for its exceptional tenderness and rich flavor, perfect for indulgent and delicious meals.', '20.90', '65598cbf813c1.png'),
(89, 8, 2, 'Premium Pork Belly', 'Succulent and well-marbled cut, known for its exceptional tenderness and rich flavor, perfect for indulgent and delicious meals.', '20.90', '65598cbf813c1.png'),
(90, 9, 2, 'Premium Pork Belly', 'Succulent and well-marbled cut, known for its exceptional tenderness and rich flavor, perfect for indulgent and delicious meals.', '20.90', '65598cbf813c1.png'),
(91, 10, 2, 'Premium Pork Belly', 'Succulent and well-marbled cut, known for its exceptional tenderness and rich flavor, perfect for indulgent and delicious meals.', '20.90', '65598cbf813c1.png'),
(92, 6, 2, 'Grass Fed Lamb Slice', 'Lean and flavorful meat, imbued with natural grassy notes, offering a delectable and wholesome culinary experience.', '25.90', '6559a63f08e24.jpg'),
(93, 7, 2, 'Grass Fed Lamb Slice', 'Lean and flavorful meat, imbued with natural grassy notes, offering a delectable and wholesome culinary experience.', '25.90', '6559a63f08e24.jpg'),
(94, 8, 2, 'Grass Fed Lamb Slice', 'Lean and flavorful meat, imbued with natural grassy notes, offering a delectable and wholesome culinary experience.', '25.90', '6559a63f08e24.jpg'),
(95, 9, 2, 'Grass Fed Lamb Slice', 'Lean and flavorful meat, imbued with natural grassy notes, offering a delectable and wholesome culinary experience.', '25.90', '6559a63f08e24.jpg'),
(96, 10, 2, 'Grass Fed Lamb Slice', 'Lean and flavorful meat, imbued with natural grassy notes, offering a delectable and wholesome culinary experience.', '25.90', '6559a63f08e24.jpg'),
(97, 6, 2, 'Lamb Rib Slice **SELECTED BRANCH ONLY', 'Juicy and tender cut, boasting a perfect balance of meat and fat, delivering a savory and satisfying dining experience.', '26.90', '6559baba877a4.jpg'),
(101, 10, 2, 'Lamb Rib Slice **SELECTED BRANCH ONLY', 'Juicy and tender cut, boasting a perfect balance of meat and fat, delivering a savory and satisfying dining experience.', '26.90', '6559bacec3aae.jpg'),
(102, 6, 5, 'Mussels', 'Delicate, briny flavor, often prepared steamed or in savory dishes, showcasing their plump and succulent texture.', '18.90', '6559a828c4ce1.jpg'),
(103, 7, 5, 'Mussels', 'Delicate, briny flavor, often prepared steamed or in savory dishes, showcasing their plump and succulent texture.', '18.90', '6559a828c4ce1.jpg'),
(104, 8, 5, 'Mussels', 'Delicate, briny flavor, often prepared steamed or in savory dishes, showcasing their plump and succulent texture.', '18.90', '6559a828c4ce1.jpg'),
(105, 9, 5, 'Mussels', 'Delicate, briny flavor, often prepared steamed or in savory dishes, showcasing their plump and succulent texture.', '18.90', '6559a828c4ce1.jpg'),
(106, 10, 5, 'Mussels', 'Delicate, briny flavor, often prepared steamed or in savory dishes, showcasing their plump and succulent texture.', '18.90', '6559a828c4ce1.jpg'),
(107, 6, 5, 'Signature Fish Slices', 'Delicate and versatile, offering a light and flaky texture that enhances a variety of dishes with their fresh and mild seafood flavor.', '15.90', '6559a8e7c0b48.jpg'),
(108, 7, 5, 'Signature Fish Slices', 'Delicate and versatile, offering a light and flaky texture that enhances a variety of dishes with their fresh and mild seafood flavor.', '15.90', '6559a8d9f33a4.jpg'),
(109, 8, 5, 'Signature Fish Slices', 'Delicate and versatile, offering a light and flaky texture that enhances a variety of dishes with their fresh and mild seafood flavor.', '15.90', '6559a8ce7b9e0.jpg'),
(110, 9, 5, 'Signature Fish Slices', 'Delicate and versatile, offering a light and flaky texture that enhances a variety of dishes with their fresh and mild seafood flavor.', '15.90', '6559a8c18c8ae.jpg'),
(111, 10, 5, 'Signature Fish Slices', 'Delicate and versatile, offering a light and flaky texture that enhances a variety of dishes with their fresh and mild seafood flavor.', '15.90', '6559a8ada9a7a.jpg'),
(112, 6, 5, 'Squishy Squid Ball', 'Savory and chewy seafood snack made from minced squid, shaped into bite-sized spheres, and typically enjoyed deep-fried for a delicious and satisfying treat.', '18.90', '6559a939cb993.jpg'),
(113, 7, 5, 'Squishy Squid Ball', 'Savory and chewy seafood snack made from minced squid, shaped into bite-sized spheres, and typically enjoyed deep-fried for a delicious and satisfying treat.', '18.90', '6559a939cb993.jpg'),
(114, 8, 5, 'Squishy Squid Ball', 'Savory and chewy seafood snack made from minced squid, shaped into bite-sized spheres, and typically enjoyed deep-fried for a delicious and satisfying treat.', '18.90', '6559a939cb993.jpg'),
(115, 9, 5, 'Squishy Squid Ball', 'Savory and chewy seafood snack made from minced squid, shaped into bite-sized spheres, and typically enjoyed deep-fried for a delicious and satisfying treat.', '18.90', '6559a939cb993.jpg'),
(116, 10, 5, 'Squishy Squid Ball', 'Savory and chewy seafood snack made from minced squid, shaped into bite-sized spheres, and typically enjoyed deep-fried for a delicious and satisfying treat.', '18.90', '6559a939cb993.jpg'),
(117, 6, 5, 'Squid Roll', 'Delectable seafood treat featuring tender squid wrapped around a flavorful filling, offering a savory and satisfying culinary delight.', '15.90', '6559a99d71001.jpg'),
(118, 7, 5, 'Squid Roll', 'Delectable seafood treat featuring tender squid wrapped around a flavorful filling, offering a savory and satisfying culinary delight.', '15.90', '6559a99d71001.jpg'),
(119, 8, 5, 'Squid Roll', 'Delectable seafood treat featuring tender squid wrapped around a flavorful filling, offering a savory and satisfying culinary delight.', '15.90', '6559a99d71001.jpg'),
(120, 9, 5, 'Squid Roll', 'Delectable seafood treat featuring tender squid wrapped around a flavorful filling, offering a savory and satisfying culinary delight.', '15.90', '6559a99d71001.jpg'),
(121, 10, 5, 'Squid Roll', 'Delectable seafood treat featuring tender squid wrapped around a flavorful filling, offering a savory and satisfying culinary delight.', '15.90', '6559a99d71001.jpg'),
(122, 6, 7, 'Frozen Tofu', 'Firm and chewy texture, offering a unique and porous consistency that absorbs flavors when thawed and cooked.', '10.90', '6559aa942377f.jpg'),
(123, 7, 7, 'Frozen Tofu', 'Firm and chewy texture, offering a unique and porous consistency that absorbs flavors when thawed and cooked.', '10.90', '6559aa942377f.jpg'),
(124, 8, 7, 'Frozen Tofu', 'Firm and chewy texture, offering a unique and porous consistency that absorbs flavors when thawed and cooked.', '10.90', '6559aa942377f.jpg'),
(125, 9, 7, 'Frozen Tofu', 'Firm and chewy texture, offering a unique and porous consistency that absorbs flavors when thawed and cooked.', '10.90', '6559aa942377f.jpg'),
(126, 10, 7, 'Frozen Tofu', 'Firm and chewy texture, offering a unique and porous consistency that absorbs flavors when thawed and cooked.', '10.90', '6559aa942377f.jpg'),
(127, 6, 7, 'Fortune Gold Bag Tofu ', 'Tofu pouches filled with a savory mixture, symbolizing good luck and prosperity in both taste and presentation.', '12.90', '6559ab918711d.jpg'),
(128, 7, 7, 'Fortune Gold Bag Tofu ', 'Tofu pouches filled with a savory mixture, symbolizing good luck and prosperity in both taste and presentation.', '12.90', '6559ab7f0293f.jpg'),
(129, 8, 7, 'Fortune Gold Bag Tofu ', 'Tofu pouches filled with a savory mixture, symbolizing good luck and prosperity in both taste and presentation.', '12.90', '6559ab6d41623.jpg'),
(130, 9, 7, 'Fortune Gold Bag Tofu ', 'Tofu pouches filled with a savory mixture, symbolizing good luck and prosperity in both taste and presentation.', '12.90', '6559ab5e37102.jpg'),
(131, 10, 7, 'Fortune Gold Bag Tofu ', 'Tofu pouches filled with a savory mixture, symbolizing good luck and prosperity in both taste and presentation.', '12.90', '6559ab4f456de.jpg'),
(132, 6, 8, 'Crown Daisy', 'Leafy green vegetable with a slightly bitter and peppery taste, commonly used in Asian cuisine for its distinctive flavor and crisp texture.', '8.90', '6559af7098a66.jpg'),
(133, 7, 8, 'Crown Daisy', 'Leafy green vegetable with a slightly bitter and peppery taste, commonly used in Asian cuisine for its distinctive flavor and crisp texture.', '8.90', '6559af7098a66.jpg'),
(134, 8, 8, 'Crown Daisy', 'Leafy green vegetable with a slightly bitter and peppery taste, commonly used in Asian cuisine for its distinctive flavor and crisp texture.', '8.90', '6559af7098a66.jpg'),
(135, 9, 8, 'Crown Daisy', 'Leafy green vegetable with a slightly bitter and peppery taste, commonly used in Asian cuisine for its distinctive flavor and crisp texture.', '8.90', '6559af7098a66.jpg'),
(136, 10, 8, 'Crown Daisy', 'Leafy green vegetable with a slightly bitter and peppery taste, commonly used in Asian cuisine for its distinctive flavor and crisp texture.', '8.90', '6559af7098a66.jpg'),
(137, 6, 8, 'Fresh Mushrooms', 'Earthy and versatile fungi, prized for their robust flavor and unique texture, adding depth to a variety of dishes.', '9.90', '6559b0b167629.jpg'),
(138, 7, 8, 'Fresh Mushrooms', 'Earthy and versatile fungi, prized for their robust flavor and unique texture, adding depth to a variety of dishes.', '9.90', '6559b0b167629.jpg'),
(139, 8, 8, 'Fresh Mushrooms', 'Earthy and versatile fungi, prized for their robust flavor and unique texture, adding depth to a variety of dishes.', '9.90', '6559b0b167629.jpg'),
(140, 9, 8, 'Fresh Mushrooms', 'Earthy and versatile fungi, prized for their robust flavor and unique texture, adding depth to a variety of dishes.', '9.90', '6559b0b167629.jpg'),
(141, 10, 8, 'Fresh Mushrooms', 'Earthy and versatile fungi, prized for their robust flavor and unique texture, adding depth to a variety of dishes.', '9.90', '6559b0b167629.jpg'),
(142, 6, 8, 'Potato Slices', 'Thinly cut rounds of starchy goodness, versatile for frying, baking, or roasting, offering a crispy and satisfying texture in various culinary creations.', '9.90', '6559b1a513e97.jpg'),
(143, 7, 8, 'Potato Slices', 'Thinly cut rounds of starchy goodness, versatile for frying, baking, or roasting, offering a crispy and satisfying texture in various culinary creations.', '9.90', '6559b1a513e97.jpg'),
(144, 8, 8, 'Potato Slices', 'Thinly cut rounds of starchy goodness, versatile for frying, baking, or roasting, offering a crispy and satisfying texture in various culinary creations.', '9.90', '6559b1a513e97.jpg'),
(145, 9, 8, 'Potato Slices', 'Thinly cut rounds of starchy goodness, versatile for frying, baking, or roasting, offering a crispy and satisfying texture in various culinary creations.', '9.90', '6559b1a513e97.jpg'),
(146, 10, 8, 'Potato Slices', 'Thinly cut rounds of starchy goodness, versatile for frying, baking, or roasting, offering a crispy and satisfying texture in various culinary creations.', '9.90', '6559b1a513e97.jpg'),
(147, 6, 9, 'Signature Hand Pulled Noodles', 'Artisanal strands of freshly made dough, skillfully stretched and pulled by hand, resulting in a uniquely textured and satisfying noodle for a delicious culinary experience.', '13.90', '6559b79e90d32.jpg'),
(148, 7, 9, 'Signature Hand Pulled Noodles', 'Artisanal strands of freshly made dough, skillfully stretched and pulled by hand, resulting in a uniquely textured and satisfying noodle for a delicious culinary experience.', '13.90', '6559b79e90d32.jpg'),
(149, 8, 9, 'Signature Hand Pulled Noodles', 'Artisanal strands of freshly made dough, skillfully stretched and pulled by hand, resulting in a uniquely textured and satisfying noodle for a delicious culinary experience.', '13.90', '6559b79e90d32.jpg'),
(150, 9, 9, 'Signature Hand Pulled Noodles', 'Artisanal strands of freshly made dough, skillfully stretched and pulled by hand, resulting in a uniquely textured and satisfying noodle for a delicious culinary experience.', '13.90', '6559b79e90d32.jpg'),
(151, 10, 9, 'Signature Hand Pulled Noodles', 'Artisanal strands of freshly made dough, skillfully stretched and pulled by hand, resulting in a uniquely textured and satisfying noodle for a delicious culinary experience.', '13.90', '6559b79e90d32.jpg'),
(152, 6, 10, 'Fried Fish Cake', 'Crispy and golden-brown delight, featuring a savory blend of fish, starch, and seasonings, creating a flavorful and satisfying snack or dish.', '14.90', '6559b9782defb.png'),
(153, 7, 10, 'Fried Fish Cake', 'Crispy and golden-brown delight, featuring a savory blend of fish, starch, and seasonings, creating a flavorful and satisfying snack or dish.', '14.90', '6559b9782defb.png'),
(154, 8, 10, 'Fried Fish Cake', 'Crispy and golden-brown delight, featuring a savory blend of fish, starch, and seasonings, creating a flavorful and satisfying snack or dish.', '14.90', '6559b9782defb.png'),
(155, 9, 10, 'Fried Fish Cake', 'Crispy and golden-brown delight, featuring a savory blend of fish, starch, and seasonings, creating a flavorful and satisfying snack or dish.', '14.90', '6559b9782defb.png'),
(156, 10, 10, 'Fried Fish Cake', 'Crispy and golden-brown delight, featuring a savory blend of fish, starch, and seasonings, creating a flavorful and satisfying snack or dish.', '14.90', '6559b9782defb.png'),
(157, 6, 10, 'Sichuan Chicken Feet', 'Spicy and flavorful delicacy, featuring tenderly cooked chicken feet immersed in a bold Sichuan peppercorn and chili-infused sauce', '14.90', '6559b9bcd0913.png'),
(158, 7, 10, 'Sichuan Chicken Feet', 'Spicy and flavorful delicacy, featuring tenderly cooked chicken feet immersed in a bold Sichuan peppercorn and chili-infused sauce', '14.90', '6559b9bcd0913.png'),
(159, 8, 10, 'Sichuan Chicken Feet', 'Spicy and flavorful delicacy, featuring tenderly cooked chicken feet immersed in a bold Sichuan peppercorn and chili-infused sauce', '14.90', '6559b9bcd0913.png'),
(160, 9, 10, 'Sichuan Chicken Feet', 'Spicy and flavorful delicacy, featuring tenderly cooked chicken feet immersed in a bold Sichuan peppercorn and chili-infused sauce', '14.90', '6559b9bcd0913.png'),
(161, 10, 10, 'Sichuan Chicken Feet', 'Spicy and flavorful delicacy, featuring tenderly cooked chicken feet immersed in a bold Sichuan peppercorn and chili-infused sauce', '14.90', '6559b9bcd0913.png'),
(162, 7, 10, 'Steamed Mini Bun **SELECTED BRANCH ONLY', 'Petite, pillowy dough pockets filled with delectable savory or sweet fillings, offering a delightful and bite-sized culinary treat.', '14.90', '6559ba10e4a0a.jpg'),
(163, 9, 10, 'Steamed Mini Bun **SELECTED BRANCH ONLY', 'Petite, pillowy dough pockets filled with delectable savory or sweet fillings, offering a delightful and bite-sized culinary treat.', '14.90', '6559ba40521c7.jpg'),
(164, 10, 10, 'Steamed Mini Bun **SELECTED BRANCH ONLY', 'Petite, pillowy dough pockets filled with delectable savory or sweet fillings, offering a delightful and bite-sized culinary treat.', '14.90', '6559ba5094f8b.jpg'),
(165, 6, 11, 'Plum Juice', 'Refreshing beverage with a sweet-tart flavor, derived from ripe plums, offering a thirst-quenching and fruity delight.', '6.90', '6559bb6d4e735.jpg'),
(166, 7, 11, 'Plum Juice', 'Refreshing beverage with a sweet-tart flavor, derived from ripe plums, offering a thirst-quenching and fruity delight.', '6.90', '6559bb6d4e735.jpg'),
(167, 8, 11, 'Plum Juice', 'Refreshing beverage with a sweet-tart flavor, derived from ripe plums, offering a thirst-quenching and fruity delight.', '6.90', '6559bb6d4e735.jpg'),
(168, 9, 11, 'Plum Juice', 'Refreshing beverage with a sweet-tart flavor, derived from ripe plums, offering a thirst-quenching and fruity delight.', '6.90', '6559bb6d4e735.jpg'),
(169, 10, 11, 'Plum Juice', 'Refreshing beverage with a sweet-tart flavor, derived from ripe plums, offering a thirst-quenching and fruity delight.', '6.90', '6559bb6d4e735.jpg'),
(170, 6, 11, 'Jasmine Peach Juice', 'Refreshing blend of fragrant jasmine tea and sweet peach flavors, creating a delightful and aromatic beverage.', '6.90', '6559bbfea2a7d.jpg'),
(171, 7, 11, 'Jasmine Peach Juice', 'Refreshing blend of fragrant jasmine tea and sweet peach flavors, creating a delightful and aromatic beverage.', '6.90', '6559bbfea2a7d.jpg'),
(172, 8, 11, 'Jasmine Peach Juice', 'Refreshing blend of fragrant jasmine tea and sweet peach flavors, creating a delightful and aromatic beverage.', '6.90', '6559bbfea2a7d.jpg'),
(173, 9, 11, 'Jasmine Peach Juice', 'Refreshing blend of fragrant jasmine tea and sweet peach flavors, creating a delightful and aromatic beverage.', '6.90', '6559bbfea2a7d.jpg'),
(174, 10, 11, 'Jasmine Peach Juice', 'Refreshing blend of fragrant jasmine tea and sweet peach flavors, creating a delightful and aromatic beverage.', '6.90', '6559bbfea2a7d.jpg'),
(185, 6, 12, 'Flavored Ice Cream', 'Delightful frozen treat, blending creamy textures with a variety of enticing tastes such as vanilla, chocolate, or fruity notes, creating a delectable dessert experience.', '2.90', '6559d42496b1b.jpg'),
(186, 7, 12, 'Flavored Ice Cream', 'Delightful frozen treat, blending creamy textures with a variety of enticing tastes such as vanilla, chocolate, or fruity notes, creating a delectable dessert experience.', '2.90', '6559d42496b1b.jpg'),
(187, 8, 12, 'Flavored Ice Cream', 'Delightful frozen treat, blending creamy textures with a variety of enticing tastes such as vanilla, chocolate, or fruity notes, creating a delectable dessert experience.', '2.90', '6559d42496b1b.jpg'),
(188, 9, 12, 'Flavored Ice Cream', 'Delightful frozen treat, blending creamy textures with a variety of enticing tastes such as vanilla, chocolate, or fruity notes, creating a delectable dessert experience.', '2.90', '6559d42496b1b.jpg'),
(189, 10, 12, 'Flavored Ice Cream', 'Delightful frozen treat, blending creamy textures with a variety of enticing tastes such as vanilla, chocolate, or fruity notes, creating a delectable dessert experience.', '2.90', '6559d42496b1b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dishes_category`
--

CREATE TABLE `dishes_category` (
  `c_id` int(222) NOT NULL,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dishes_category`
--

INSERT INTO `dishes_category` (`c_id`, `c_name`, `date`) VALUES
(1, 'Soup Base', '2023-10-21 09:13:36'),
(2, 'Meat', '2023-11-18 19:43:33'),
(5, 'Seafood', '2023-10-21 09:13:36'),
(7, 'Tofu', '2023-10-21 09:13:36'),
(8, 'Vegetables', '2023-11-19 04:20:17'),
(9, 'Noodles', '2023-11-19 04:20:30'),
(10, 'Snacks', '2023-10-21 09:13:36'),
(11, 'Beverages', '2023-10-21 09:13:36'),
(12, 'Desserts', '2023-10-21 09:13:36'),
(13, 'Others', '2023-10-21 14:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `book_id` int(11) NOT NULL,
  `reservationID` varchar(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `book_date` date NOT NULL,
  `book_time` time NOT NULL,
  `rs_id` varchar(250) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_number` varchar(255) NOT NULL,
  `book_people` varchar(250) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`book_id`, `reservationID`, `u_id`, `book_date`, `book_time`, `rs_id`, `book_name`, `book_number`, `book_people`, `status`, `date`) VALUES
(153, 'R-9876', 44, '2023-11-22', '08:00:00', '8', 'ng zheqian', '+6012-3775379', '2', 'Reservation Completed', '2023-11-19 16:18:51'),
(155, 'R-2511', 44, '2023-11-28', '12:00:00', '6', 'ng zheqian', '+6012-3775379', '3', 'Reservation Completed', '2023-11-19 16:19:06'),
(156, 'R-9613', 44, '2023-11-22', '07:30:00', '8', 'ng zheqian', '+6012-3775379', '4', 'Reservation Cancelled', '2023-11-19 16:50:31'),
(157, 'R-2648', 44, '2023-11-22', '07:00:00', '7', 'ng zheqian', '+6012-3775379', '3', 'Reservation Completed', '2023-11-19 16:18:26'),
(158, 'R-9128', 44, '2023-11-21', '11:30:00', '6', 'ng zheqian', '+6012-3775379', '1', 'Reservation Completed', '2023-11-19 16:17:02'),
(159, 'R-3203', 62, '2023-12-02', '17:30:00', '7', 'Jee Ryan', '+6012-9042981', '2', 'Reservation Completed', '2023-11-19 15:52:16'),
(160, 'R-1532', 62, '2023-11-25', '12:30:00', '7', 'Jee Ryan', '+6012-9042981', '5', 'Reservation Completed', '2023-11-28 01:25:35'),
(161, 'R-5508', 44, '2023-11-24', '16:30:00', '6', 'ryan', '+6012-3775379', '8', 'Reservation Completed', '2023-11-22 07:07:59'),
(162, 'R-3155', 69, '2023-12-07', '12:00:00', '6', 'qwe qwe', '+6011-11111111', '1', 'Reservation Completed', '2023-11-28 01:36:51'),
(163, 'R-9881', 69, '2023-12-07', '12:00:00', '6', 'qwe qwe', '+6011-11111111', '1', 'Reservation Completed', '2023-11-28 01:28:48'),
(164, 'R-0400', 69, '2023-12-07', '12:00:00', '6', 'qwe qwe', '+6011-11111111', '1', 'Reservation Completed', '2023-11-28 01:37:06'),
(165, 'R-9667', 69, '2023-12-07', '12:00:00', '6', 'qwe qwe', '+6011-11111111', '1', 'Reservation Cancelled', '2023-11-28 01:10:30'),
(166, 'R-8025', 44, '2023-12-01', '10:30:00', '7', 'ng zheqian', '+6012-3775379', '2', 'Reservation Completed', '2023-11-28 01:36:18'),
(167, 'R-2051', 44, '2023-12-01', '13:00:00', '9', 'ng zheqian', '+6012-3775379', '8', 'Reservation Cancelled', '2023-11-28 02:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `rs_id` int(222) NOT NULL,
  `res_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `url` varchar(222) NOT NULL,
  `o_hr` varchar(222) NOT NULL,
  `c_hr` varchar(222) NOT NULL,
  `o_days` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`rs_id`, `res_name`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `date`) VALUES
(6, 'Malapot Kitchen Kepong', 'malapotkepong@gmail.com', '+6012-904 2981', 'www.malapotkepong.com', '10am', '10pm', 'Everyday', '29, Jalan Metro Perdana, Taman Jaya, \r\n52100 Kepong, Wilayah Persekutuan Kuala Lumpur  ', '6559049f33189.jpg', '2023-11-18 18:38:23'),
(7, 'Malapot Kitchen Sunway', 'malapotsunway@gmail.com', '+6012-377 5379', 'www.malapotsunway.com', '10am', '10pm', 'Everyday', '    52, Jalan PJS 11/28b, Bandar Sunway, 47500 Petaling Jaya, Selangor      ', '65654499e2fd1.jpg', '2023-11-28 01:38:33'),
(8, 'Malapot Kitchen Cheras', 'malapotcheras@gmail.com', '+6014-9931993', 'www.malapotcheras.com', '6am', '9pm', 'Everyday', ' 17, Jalan Cengkeh, Taman Cheras, 56100 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur    ', '655a384620cf7.jpg', '2023-11-19 16:31:02'),
(9, 'Malapot Kitchen Genting', 'malapotgenting@gmail.com', '+6011-102 1678', 'www.malapotgenting.com', '11am', '11pm', 'Everyday', '  Lot T3-25-30, Genting Highlands, 69000 Genting Highlands, Pahang    ', '655ef7498eca7.jpg', '2023-11-23 06:55:05'),
(10, 'Malapot Kitchen Johor', 'malapotjohor@gmail.com', '+60124-330 3913', 'www.malapotjohor.com', '10am', '10pm', 'Everyday', '   25, Jalan Dato Abdullah Tahir, Taman Abad, 80300 Johor Bahru, Johor   ', '656544851b6da.jpg', '2023-11-28 01:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` date DEFAULT NULL,
  `address` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `gender`, `birthday`, `address`, `date`, `image`) VALUES
(44, 'ngzheqian', 'zheqian', 'ng', '22029052@imail.sunway.edu.my', '+6012-3775379', '$2y$10$zHgB/Q2YoPN7rkX8CPmqhuaPyUc8syDt34CjtFBXCzolrPDUBWcWO', 'female', '2023-06-01', '123,Jalan ABC', '2023-11-28 01:47:21', 'f164e656d8bc2f2d307d352fa4e3546a.jpg'),
(45, 'ryanjee1', 'ryan', 'Jee', 'ryan@imail.sunway.edu.my', '+6012-3775379', '$2y$10$e2vnfY2EWPkjcxZdj9wkaeX0mfA.d5kh.eogliGK4lOZDc54BsRcu', 'male', '2023-10-01', '123,Jalan ABC', '2023-10-21 11:33:06', ''),
(46, 'perth11', 'perth', 'wong', 'perth_0@Hotmail.com', '+6012-3456789', '$2y$10$OoRIRyPy/bS8SbtXMfN3j.5JhaFbFm3TCFwZH76MfA.qhI8lfFOf2', 'female', '2023-10-01', '909,Jalan Klang', '2023-10-19 07:36:43', ''),
(47, 'sdfsfs', 'sfsdfsf', 'sfsdfsf', 'adada@imail.com', '+6012-3775379', '$2y$10$Yo7XHHRdQvdvNEWihcg7NeSc3OJlS2qLQnnSmRRd7G8hWg4cvrR7m', 'female', '2023-10-01', '123,Jalan', '2023-10-19 08:04:32', ''),
(61, 'sadfsdfs', 'eced', 'dsfadf', 'safdfs@hotmail.com', '+6012-3775379', '$2y$10$niQHTCafS2qg5TyIIlLweu/nwBDxmfEs2E0maW17thc/7XuVR0Hg2', 'male', '2023-10-01', '123,Jalan Sunway', '2023-10-21 13:35:59', ''),
(62, 'ryanjee', 'Ryan', 'Jee', 'jeemengzhe@gmail.com', '+6012-9042981', '$2y$10$QZnq.jBrINVAI7UrAXmLduRBXibr746W9P6NdSvKWKYWzRTTInCQ6', 'male', '2003-12-02', 'Kepong', '2023-11-19 14:53:31', '6ccf43a0f0a1a2711227b5e62cb71cc9.png'),
(63, 'perthwong', 'perth', 'wong', 'nzheqian@gmail.com', '+6012-3775379', '$2y$10$hFfIdFVo4BeyL4P.5xLVfuAjfM5mVj97c5KbI5g9IopBD./fTpCGy', 'female', '2006-01-10', '123,Jalan Perth', '2023-11-08 10:02:07', ''),
(64, 'ngzheqian1', 'zheqian', 'ng', '11@hotmail.com', '+6012-3775379', '$2y$10$a3KCXr/dFv7XC.uubuK1SeXqHMPGJ2nGRl7UMI8XgLPO6lZs6H5Gu', 'female', '2023-10-30', '123,Jalan 123', '2023-11-13 18:20:48', ''),
(65, 'ngzheqian2', 'zheqian', 'ng', '12131@hotmail.com', '+6012-3775379', '$2y$10$D4sM/AGMwR9Hd63GRHmaVe.kS1Jy7mv4h5F.THFe4AguASdGLxxzi', 'male', '2023-11-07', '123,Jalan 121313132', '2023-11-13 18:21:42', ''),
(66, 'ngzheqian3', 'zheqian', 'ng', '1212@hotmailc.om', '+6012-3775379', '$2y$10$bTARDyvr/nIaqmDBsZt8YeiLBOQ3wVxFH5rPBVJ9n.LlPOs06QYTy', 'female', '2023-10-30', '13231,Jalan 1212343242', '2023-11-13 18:22:34', ''),
(67, 'ngzheqian4', 'zheqian', 'ng', '1231@hotmail.com', '+6012-3775379', '$2y$10$6bWReRehL0Q4rc4K41.pTOGDwn7F3fKbcF8/dXMnFSF5Y9ck6oLFu', 'male', '2023-11-01', '13213,Jalan 123413342', '2023-11-13 18:23:24', ''),
(68, 'ngzheqian6', 'zheqian', 'ng', '122029052@imail.sunway.edu.my', '+6012-3775379', '$2y$10$cDM/R5HGZOAARWbSd7QfruHUsSJAo2JcK7cSuRfXu4jwmjAeGDSGS', 'female', '2023-10-19', '123,Jalan 123', '2023-11-16 07:32:25', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `d_id` int(222) NOT NULL,
  `c_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `o_num` varchar(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `d_id`, `c_id`, `rs_id`, `o_num`, `title`, `quantity`, `price`, `status`, `date`) VALUES
(122, 44, 36, 2, 6, 'TO-3933', 'Popcorn', 1, '25.00', 'Order Collected', '2023-11-16 19:16:24'),
(123, 44, 36, 7, 6, 'TO-3933', 'Tofu', 1, '25.00', 'Order Collected', '2023-11-16 19:16:24'),
(126, 62, 64, 2, 9, 'TO-2289', 'Premium Pork Belly', 1, '20.90', 'Order Collected', '2023-11-19 16:15:27'),
(131, 62, 60, 1, 10, 'TO-0306', 'Sweet Tomato', 1, '19.90', 'Order Collected', '2023-11-19 16:15:15'),
(132, 62, 60, 2, 10, 'TO-0306', 'Golden Pork Intestine', 1, '20.90', 'Order Collected', '2023-11-19 16:15:15'),
(134, 62, 56, 1, 6, 'TO-9302', 'Pepper Mushroom', 1, '19.90', 'Order Collected', '2023-11-19 16:14:58'),
(135, 62, 56, 2, 6, 'TO-9302', 'Premium Pork Belly', 1, '20.90', 'Order Collected', '2023-11-19 16:14:58'),
(137, 62, 63, 1, 8, 'TO-0388', 'Sweet Tomato', 1, '19.90', 'Order Collected', '2023-11-19 15:48:13'),
(138, 62, 63, 1, 8, 'TO-0388', 'Kobe Beef Slices', 1, '25.90', 'Order Collected', '2023-11-19 15:48:13'),
(139, 44, 60, 1, 10, 'TO-1735', 'Signature Mala Spicy', 1, '19.90', 'Order Collected', '2023-11-22 07:07:30'),
(140, 44, 60, 1, 10, 'TO-1735', 'Pepper Mushroom', 1, '19.90', 'Order Collected', '2023-11-22 07:07:30'),
(141, 44, 60, 1, 10, 'TO-1735', 'Sweet Tomato', 1, '19.90', 'Order Collected', '2023-11-22 07:07:30'),
(142, 44, 60, 2, 10, 'TO-1735', 'Golden Pork Intestine', 1, '20.90', 'Order Collected', '2023-11-22 07:07:30'),
(143, 44, 60, 2, 10, 'TO-1735', 'Grass Fed Lamb Slice', 1, '25.90', 'Order Collected', '2023-11-22 07:07:30'),
(144, 44, 60, 8, 10, 'TO-1735', 'Crown Daisy', 1, '8.90', 'Order Collected', '2023-11-22 07:07:30'),
(146, 69, 57, 1, 7, 'TO-8016', 'Pepper Mushroom', 1, '19.90', 'Preparing Your Order', '2023-11-28 00:48:25'),
(147, 69, 57, 2, 7, 'TO-8016', 'Curry Marinated Chicken', 1, '18.90', 'Preparing Your Order', '2023-11-28 00:48:25'),
(148, 69, 57, 2, 7, 'TO-8016', 'Kobe Beef Slices', 1, '25.90', 'Preparing Your Order', '2023-11-28 00:48:25'),
(149, 69, 57, 2, 7, 'TO-8016', 'Golden Pork Intestine', 1, '20.90', 'Preparing Your Order', '2023-11-28 00:48:25'),
(150, 69, 57, 2, 7, 'TO-8016', 'Premium Pork Belly', 1, '20.90', 'Preparing Your Order', '2023-11-28 00:48:25'),
(151, 69, 57, 5, 7, 'TO-8016', 'Mussels', 1, '18.90', 'Preparing Your Order', '2023-11-28 00:48:25'),
(152, 44, 56, 1, 6, 'TO-2708', 'Signature Mala Spicy', 1, '19.90', 'Order Collected', '2023-11-28 02:03:24'),
(153, 44, 56, 1, 6, 'TO-2708', 'Pepper Mushroom', 1, '19.90', 'Order Collected', '2023-11-28 02:03:24'),
(154, 44, 56, 2, 6, 'TO-2708', 'Grass Fed Lamb Slice', 1, '25.90', 'Order Collected', '2023-11-28 02:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `users_ordersin`
--

CREATE TABLE `users_ordersin` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `d_id` int(222) NOT NULL,
  `c_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `o_num` varchar(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_ordersin`
--

INSERT INTO `users_ordersin` (`o_id`, `u_id`, `d_id`, `c_id`, `rs_id`, `o_num`, `title`, `quantity`, `price`, `status`, `date`) VALUES
(186, 44, 36, 1, 6, 'DI-4464', 'Chicken Slices', 1, '25.00', 'Order Served', '2023-11-19 16:14:11'),
(187, 44, 36, 2, 6, 'DI-4464', 'Popcorn', 1, '25.00', 'Order Served', '2023-11-19 16:14:11'),
(188, 44, 36, 7, 6, 'DI-4464', 'Tofu', 1, '25.00', 'Order Served', '2023-11-19 16:14:11'),
(189, 44, 36, 1, 6, 'DI-6217', 'Chicken Slices', 1, '25.00', 'Order Served', '2023-11-16 19:10:38'),
(190, 44, 36, 2, 6, 'DI-6217', 'Popcorn', 1, '25.00', 'Order Served', '2023-11-16 19:10:38'),
(191, 44, 36, 7, 6, 'DI-6217', 'Tofu', 1, '25.00', 'Order Served', '2023-11-16 19:10:38'),
(192, 44, 39, 3, 8, 'DI-0793', 'Beef ', 1, '25.00', 'Order Served', '2023-11-19 16:14:23'),
(193, 44, 39, 7, 8, 'DI-0793', 'Tofu', 1, '25.00', 'Order Served', '2023-11-19 16:14:23'),
(194, 44, 36, 1, 6, 'DI-7295', 'Chicken Slices', 1, '25.00', 'Order Served', '2023-11-19 16:14:31'),
(195, 44, 36, 2, 6, 'DI-7295', 'Popcorn', 3, '25.00', 'Order Served', '2023-11-19 16:14:31'),
(196, 44, 36, 2, 6, 'DI-7295', 'Tofu', 1, '25.00', 'Order Served', '2023-11-19 16:14:31'),
(197, 44, 38, 1, 7, 'DI-4872', 'Chicken Slices', 2, '25.00', 'Order Served', '2023-11-16 19:10:57'),
(198, 44, 38, 2, 7, 'DI-4872', 'Popcorn', 2, '25.00', 'Order Served', '2023-11-16 19:10:57'),
(199, 44, 38, 7, 7, 'DI-4872', 'Tofu', 1, '25.00', 'Order Served', '2023-11-16 19:10:57'),
(200, 62, 56, 1, 6, 'DI-4315', 'Signature Mala Spicy', 1, '19.90', 'Order Served', '2023-11-19 12:16:31'),
(201, 62, 56, 1, 6, 'DI-4315', 'Curry Marinated Chicken', 1, '18.90', 'Order Served', '2023-11-19 12:16:31'),
(202, 62, 56, 1, 6, 'DI-4315', 'Premium Pork Belly', 1, '20.90', 'Order Served', '2023-11-19 12:16:31'),
(203, 62, 56, 2, 6, 'DI-4315', 'Signature Fish Slices', 1, '15.90', 'Order Served', '2023-11-19 12:16:31'),
(204, 62, 56, 2, 6, 'DI-4315', 'Fortune Gold Bag Tofu ', 1, '12.90', 'Order Served', '2023-11-19 12:16:31'),
(205, 62, 56, 5, 6, 'DI-4315', 'Fresh Mushrooms', 1, '9.90', 'Order Served', '2023-11-19 12:16:31'),
(206, 62, 56, 7, 6, 'DI-4315', 'Plum Juice', 1, '6.90', 'Order Served', '2023-11-19 12:16:31'),
(207, 62, 59, 1, 9, 'DI-2139', 'Signature Mala Spicy', 1, '19.90', 'Order Served', '2023-11-19 16:10:43'),
(208, 62, 59, 1, 9, 'DI-2139', 'Pepper Mushroom', 1, '19.90', 'Order Served', '2023-11-19 16:10:43'),
(209, 62, 59, 2, 9, 'DI-2139', 'Curry Marinated Chicken', 1, '18.90', 'Order Served', '2023-11-19 16:10:43'),
(210, 62, 59, 2, 9, 'DI-2139', 'Premium Pork Belly', 1, '20.90', 'Order Served', '2023-11-19 16:10:43'),
(211, 44, 58, 1, 8, 'DI-4302', 'Signature Mala Spicy', 1, '19.90', 'Order Served', '2023-11-22 06:44:17'),
(212, 44, 58, 1, 8, 'DI-4302', 'Sweet Tomato', 1, '19.90', 'Order Served', '2023-11-22 06:44:17'),
(213, 44, 58, 2, 8, 'DI-4302', 'Curry Marinated Chicken', 1, '18.90', 'Order Served', '2023-11-22 06:44:17'),
(214, 44, 58, 2, 8, 'DI-4302', 'Premium Pork Belly', 1, '20.90', 'Order Served', '2023-11-22 06:44:17'),
(215, 44, 58, 5, 8, 'DI-4302', 'Mussels', 1, '18.90', 'Order Served', '2023-11-22 06:44:17'),
(216, 44, 59, 1, 9, 'DI-6559', 'Signature Mala Spicy', 1, '19.90', 'Order Served', '2023-11-22 06:45:40'),
(217, 44, 59, 2, 9, 'DI-6559', 'Premium Pork Belly', 1, '20.90', 'Order Served', '2023-11-22 06:45:40'),
(218, 44, 59, 2, 9, 'DI-6559', 'Grass Fed Lamb Slice', 10, '25.90', 'Order Served', '2023-11-22 06:45:40'),
(219, 44, 56, 1, 6, 'DI-3701', 'Signature Mala Spicy', 1, '19.90', 'Order Served', '2023-11-22 07:06:39'),
(220, 44, 56, 2, 6, 'DI-3701', 'Curry Marinated Chicken', 1, '18.90', 'Order Served', '2023-11-22 07:06:39'),
(221, 44, 56, 5, 6, 'DI-3701', 'Mussels', 1, '18.90', 'Order Served', '2023-11-22 07:06:39'),
(222, 44, 56, 12, 6, 'DI-3701', 'Flavored Ice Cream', 1, '2.90', 'Order Served', '2023-11-22 07:06:39'),
(223, 69, 56, 1, 6, 'DI-2035', 'Signature Mala Spicy', 1, '19.90', NULL, '2023-11-28 00:42:30'),
(224, 69, 56, 1, 6, 'DI-2035', 'Pepper Mushroom', 1, '19.90', NULL, '2023-11-28 00:42:30'),
(225, 69, 56, 1, 6, 'DI-2035', 'Sweet Tomato', 1, '19.90', NULL, '2023-11-28 00:42:30'),
(226, 69, 56, 2, 6, 'DI-2035', 'Curry Marinated Chicken', 1, '18.90', NULL, '2023-11-28 00:42:30'),
(227, 69, 56, 2, 6, 'DI-2035', 'Kobe Beef Slices', 1, '25.90', NULL, '2023-11-28 00:42:30'),
(228, 44, 56, 1, 6, 'DI-8603', 'Signature Mala Spicy', 1, '19.90', 'Order Served', '2023-11-28 02:06:06'),
(229, 44, 56, 1, 6, 'DI-8603', 'Pepper Mushroom', 1, '19.90', 'Order Served', '2023-11-28 02:06:06'),
(230, 44, 56, 2, 6, 'DI-8603', 'Golden Pork Intestine', 10, '20.90', 'Order Served', '2023-11-28 02:06:06'),
(231, 44, 56, 8, 6, 'DI-8603', 'Crown Daisy', 2, '8.90', 'Order Served', '2023-11-28 02:06:06'),
(232, 44, 56, 8, 6, 'DI-8603', 'Squishy Squid Ball', 1, '18.90', 'Order Served', '2023-11-28 02:06:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `dishes_category`
--
ALTER TABLE `dishes_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `book_date` (`book_date`),
  ADD KEY `book_name` (`book_name`),
  ADD KEY `book_number` (`book_number`),
  ADD KEY `book_people` (`book_people`),
  ADD KEY `book_time` (`book_time`),
  ADD KEY `res` (`rs_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `users_ordersin`
--
ALTER TABLE `users_ordersin`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `dishes_category`
--
ALTER TABLE `dishes_category`
  MODIFY `c_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `rs_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `users_ordersin`
--
ALTER TABLE `users_ordersin`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
