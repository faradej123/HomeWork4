DROP DATABASE IF EXISTS `shop-test-db`;
CREATE DATABASE IF NOT EXISTS `shop-test-db`;
USE `shop-test-db`;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
 `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `firstname` varchar(128) NOT NULL,
 `email` varchar(128) NOT NULL,
 `password` varchar(128) NOT NULL,
 `date_created` int NOT NULL,
 `role` varchar(12) NOT NULL
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
 `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `name` varchar(128) NOT NULL,
 `cost` decimal(10,2) NOT NULL,
 `count` int NOT NULL
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
 `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `user_id` int NOT NULL,
 `product_id` int NOT NULL,
 `count` int NOT NULL,
 KEY `user_id` (`user_id`),
 KEY `product_id` (`product_id`),
FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT,
FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
 `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `date_created` int NOT NULL,
 `user_id` int NOT NULL,
 KEY `user_id` (`user_id`),
FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `order_products`;
CREATE TABLE `order_products` (
 `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `order_id` int NOT NULL,
 `product_id` int NOT NULL,
 `count` int NOT NULL,
 KEY `order_id` (`order_id`),
 KEY `product_id` (`product_id`),
FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT,
FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `user_sessions`;
CREATE TABLE `user_sessions` (
 `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `session_id` varchar(128) NOT NULL,
 `user_id` int NOT NULL,
 `expiration_time` int NOT NULL,
 KEY `user_id` (`user_id`),
FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB;