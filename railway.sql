DROP DATABASE IF EXISTS `igor_db`;
CREATE DATABASE IF NOT EXISTS `igor_db`;
USE `igor_db`;

DROP TABLE IF EXISTS `wagon_type`;
CREATE TABLE IF NOT EXISTS `wagon_type`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `type` VARCHAR(64) NOT NULL,
    `cost_mod` FLOAT NOT NULL
)ENGINE=INNODB;

DROP TABLE IF EXISTS `wagon`;
CREATE TABLE IF NOT EXISTS `wagon`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `number` INT NOT NULL,
    `wagon_type_id` INT NOT NULL,
    FOREIGN KEY(`wagon_type_id`) REFERENCES `wagon_type`(`id`)
)ENGINE=INNODB;

DROP TABLE IF EXISTS `seat`;
CREATE TABLE IF NOT EXISTS `seat`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `number` INT NOT NULL,
    `wagon_id` INT NOT NULL,
    FOREIGN KEY(`wagon_id`) REFERENCES `wagon`(`id`)
)ENGINE=INNODB;

DROP TABLE IF EXISTS `train_type`;
CREATE TABLE IF NOT EXISTS `train_type`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`type` VARCHAR(128) NOT NULL,
    `cost_mod` FLOAT NOT NULL
)ENGINE=INNODB;

DROP TABLE IF EXISTS `train`;
CREATE TABLE IF NOT EXISTS `train`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`number` INT NOT NULL,
    `train_type_id` INT NOT NULL,
    FOREIGN KEY(`train_type_id`) REFERENCES `train_type`(`id`)
)ENGINE=INNODB;


DROP TABLE IF EXISTS `wagon_in_train`;
CREATE TABLE IF NOT EXISTS `wagon_in_train`(
	`train_id` INT NOT NULL,
    `wagon_id` INT NOT NULL,
    FOREIGN KEY(`wagon_id`) REFERENCES `wagon`(`id`),
    FOREIGN KEY(`train_id`) REFERENCES `train`(`id`)
)ENGINE=INNODB;

DROP TABLE IF EXISTS `route`;
CREATE TABLE IF NOT EXISTS `route`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`title` VARCHAR(256) NOT NULL
)ENGINE=INNODB;

DROP TABLE IF EXISTS `seats_in_sheduled_route`;
CREATE TABLE IF NOT EXISTS `seats_in_sheduled_route`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `seat_id` INT NOT NULL,
    FOREIGN KEY(`seat_id`) REFERENCES `seat`(`id`)
)ENGINE=INNODB;

DROP TABLE IF EXISTS `sheduled_route`;
CREATE TABLE IF NOT EXISTS `sheduled_route`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`route_id` INT NOT NULL,
    `seats_in_sheduled_route_id` INT NOT NULL,
    FOREIGN KEY(`route_id`) REFERENCES `route`(`id`),
    FOREIGN KEY(`seats_in_sheduled_route_id`) REFERENCES `seats_in_sheduled_route`(`id`)
)ENGINE=INNODB;

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`title` VARCHAR(256) NOT NULL
)ENGINE=INNODB;

DROP TABLE IF EXISTS `station`;
CREATE TABLE IF NOT EXISTS `station`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(256) NOT NULL,
    `city_id` INT NOT NULL,
    FOREIGN KEY(`city_id`) REFERENCES `city`(`id`)
)ENGINE=INNODB;

DROP TABLE IF EXISTS `station_in_route`;
CREATE TABLE IF NOT EXISTS `station_in_route`(
    `sheduled_route_id` INT NOT NULL,
	`station_id` INT NOT NULL,
    `time_comming` DATE NOT NULL,
    `time_leave` DATE NOT NULL,
    FOREIGN KEY(`sheduled_route_id`) REFERENCES `sheduled_route`(`id`),
    FOREIGN KEY(`station_id`) REFERENCES `station`(`id`)
)ENGINE=INNODB;

DROP TABLE IF EXISTS `station_cost`;
CREATE TABLE IF NOT EXISTS `station_cost`(
    `station_id_first` INT NOT NULL,
	`station_id_second` INT NOT NULL,
    `station_cost` FLOAT NOT NULL,
    FOREIGN KEY(`station_id_first`) REFERENCES `station`(`id`),
    FOREIGN KEY(`station_id_second`) REFERENCES `station`(`id`)
)ENGINE=INNODB;

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`first_name` VARCHAR(128) NOT NULL,
    `last_name` VARCHAR(128) NOT NULL
)ENGINE=INNODB;

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`sheduled_route_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `seat_id` INT NOT NULL,
    `wagon_id` INT NOT NULL,
    FOREIGN KEY(`sheduled_route_id`) REFERENCES `sheduled_route`(`id`),
    FOREIGN KEY(`user_id`) REFERENCES `user`(`id`)
)ENGINE=INNODB;
