-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 08:36 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms-udruga`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `article_title` varchar(100) NOT NULL,
  `article_content` text NOT NULL,
  `article_image_src` varchar(50) NOT NULL,
  `article_image_alt` varchar(50) NOT NULL,
  `article_created_at` datetime NOT NULL,
  `article_author` int(11) NOT NULL,
  `article_route` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `article_title`, `article_content`, `article_image_src`, `article_image_alt`, `article_created_at`, `article_author`, `article_route`) VALUES
(1, 'Article Title 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In velit est, fermentum vel est eget, pretium pretium arcu. Nunc volutpat nisl euismod bibendum fringilla. Phasellus at nisi et massa rhoncus egestas. Donec cursus fringilla sapien a dignissim. Curabitur tempor mollis turpis, quis fringilla odio vestibulum quis. Cras et imperdiet mi. Mauris vel pretium leo. Etiam sed justo tempus, tempus velit ut, pulvinar nunc. Aenean fermentum porttitor arcu, non gravida ex.\r\n\r\nPraesent erat nulla, porta in risus sed, porttitor cursus urna. Ut vitae viverra leo. Nam ultrices a enim at volutpat. Suspendisse sapien dui, lacinia sit amet volutpat a, pharetra ac turpis. Suspendisse in ligula at sapien volutpat interdum vel et erat. Fusce ultrices pharetra neque, in vulputate mi commodo sed. Vivamus varius nisi sit amet mi lobortis aliquam. Nullam condimentum purus diam. Donec volutpat nisi tellus, at venenatis eros aliquam at. Sed neque odio, luctus sit amet risus facilisis, venenatis ornare mi. Donec at eros purus. Nam nisi ligula, mollis in sollicitudin sed, suscipit aliquam lacus. Sed auctor dolor id metus gravida condimentum. Quisque lobortis mi at erat dapibus vehicula. Nullam ac mattis enim, eget molestie odio. Vivamus congue ultrices libero quis aliquam.\r\n\r\nCurabitur feugiat magna tellus, eget laoreet lorem malesuada sed. Nulla facilisi. Sed consectetur molestie ex sit amet cursus. Aliquam erat volutpat. Maecenas enim libero, pharetra convallis ipsum sed, tincidunt mollis magna. Fusce eget lacus leo. Donec tristique vulputate ante, non finibus enim fringilla ac. Nulla luctus venenatis leo, et efficitur nunc mattis vitae. Sed quam augue, bibendum at scelerisque quis, scelerisque nec odio. Praesent nec eros scelerisque, blandit eros a, lacinia elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Mauris consectetur lectus justo.\r\n\r\nNunc mollis neque ac fermentum tempus. Pellentesque sed nisi ut nulla molestie vehicula non non dolor. Integer id orci ut nibh fermentum pulvinar. Nam non interdum tellus. Curabitur auctor odio nec neque sagittis laoreet. Donec nec quam quis sem viverra lobortis. Mauris nisl libero, dignissim id laoreet sed, efficitur eu quam. Vestibulum vitae ornare est. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut a nisi vel nulla porttitor pretium. Donec blandit efficitur nisi nec ornare. Cras vitae erat id ante pellentesque malesuada quis a nibh. Sed hendrerit dui nec diam consectetur, sit amet faucibus velit faucibus. Cras ut nisl congue, sodales eros aliquam, accumsan tellus. Mauris vel efficitur ipsum. Proin velit dui, cursus eget pharetra id, pulvinar interdum turpis.\r\n\r\nPraesent condimentum congue rhoncus. Etiam malesuada dolor ligula, sed molestie purus maximus sed. Sed nec massa arcu. Ut non molestie mi, sed luctus mi. Nunc ac ligula sed nisi rhoncus convallis vitae vel magna. Donec gravida ultrices suscipit. Ut sodales a est at semper. Morbi vehicula, nunc ac hendrerit tempor, nisi massa auctor dui, eget venenatis nisi nibh vel dui. Curabitur accumsan maximus tempor. Nulla tempus eleifend ligula, finibus rutrum elit rutrum et. In hac habitasse platea dictumst. Duis interdum tempus augue eu sagittis.', 'main-image.png', 'main image', '2023-05-01 00:00:00', 1, 'kratko');

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `navigation_id` int(11) NOT NULL,
  `navigation_order_id` int(11) NOT NULL,
  `navigation_parent_id` int(11) NOT NULL,
  `navigation_name` varchar(255) NOT NULL,
  `navigation_connection_type` varchar(50) NOT NULL,
  `navigation_connection_id` int(11) NOT NULL,
  `navigation_created_at` datetime NOT NULL,
  `navigation_route` varchar(255) NOT NULL,
  `navigation_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`navigation_id`, `navigation_order_id`, `navigation_parent_id`, `navigation_name`, `navigation_connection_type`, `navigation_connection_id`, `navigation_created_at`, `navigation_route`, `navigation_author`) VALUES
(1, 1, 0, 'Home', 'Article', 1, '0000-00-00 00:00:00', 'home', 1),
(2, 2, 0, 'About', 'Article', 2, '0000-00-00 00:00:00', 'about', 1),
(3, 3, 0, 'Contact', 'Article', 3, '0000-00-00 00:00:00', 'contact', 1),
(4, 4, 3, 'Admin', 'Article', 3, '0000-00-00 00:00:00', 'contact-admin', 1),
(5, 5, 3, 'Developer', 'Article', 5, '0000-00-00 00:00:00', 'contact-developer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `navigation_connection_types`
--

CREATE TABLE `navigation_connection_types` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `route` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `navigation_connection_types`
--

INSERT INTO `navigation_connection_types` (`id`, `type`, `route`) VALUES
(1, 'Article', '/article/'),
(2, 'Articles Category', '/articles/category/');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_right` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_right`) VALUES
(1, 'Navigation', 'Create'),
(2, 'Navigation', 'Edit'),
(3, 'Navigation', 'Delete'),
(4, 'Article', 'Create'),
(5, 'Article', 'Edit'),
(6, 'Article', 'Delete'),
(7, 'Article', 'Publish');

-- --------------------------------------------------------

--
-- Table structure for table `roles_connections`
--

CREATE TABLE `roles_connections` (
  `role_connection_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `connection_type` varchar(5) NOT NULL,
  `connection_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles_connections`
--

INSERT INTO `roles_connections` (`role_connection_id`, `role_id`, `connection_type`, `connection_id`) VALUES
(7, 4, 'USER', 3),
(8, 1, 'USER', 4),
(9, 2, 'USER', 4),
(10, 3, 'USER', 4),
(11, 2, 'USER', 1),
(12, 4, 'USER', 1),
(13, 7, 'USER', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'admin', 'admin@admin.com', 'admin'),
(3, 'name', 'name@name.com', 'name'),
(4, 'dummy', 'dummy@dummy.com', 'dummy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`navigation_id`);

--
-- Indexes for table `navigation_connection_types`
--
ALTER TABLE `navigation_connection_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `roles_connections`
--
ALTER TABLE `roles_connections`
  ADD PRIMARY KEY (`role_connection_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `navigation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `navigation_connection_types`
--
ALTER TABLE `navigation_connection_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles_connections`
--
ALTER TABLE `roles_connections`
  MODIFY `role_connection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
