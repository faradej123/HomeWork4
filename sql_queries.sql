--1
SELECT count(`id`) as `count` FROM `order`WHERE (`user_id` = "7") AND (`date_created` BETWEEN "1617610132" AND "1617690837");

--2
SELECT `user_id`, `firstname`, `email` FROM 
(SELECT `user`.`id` as `user_id`, `user`.`firstname`, `user`.`email`, `order`.`id` as `order_id` 
FROM `user` LEFT JOIN `order` on `user`.`id`=`order`.`user_id`) as `result` 
WHERE `result`.`order_id` IS NULL

--3
SELECT `product_id`, SUM(`count`) as `count` FROM `order_products` GROUP BY `product_id`

--4
SELECT `order`.`user_id`, `user`.`firstname`, `user`.`email` FROM `order` 
LEFT JOIN `user` ON `order`.`user_id`=`user`.`id` 
WHERE `order`.`date_created` < UNIX_TIMESTAMP(NOW())-864000 GROUP BY `order`.`user_id`
UNION
SELECT `user_id`, `firstname`, `email` FROM 
(SELECT `user`.`id` as `user_id`, `user`.`firstname`, `user`.`email`, `order`.`id` as `order_id` 
FROM `user` LEFT JOIN `order` on `user`.`id`=`order`.`user_id`) as `result` 
WHERE `result`.`order_id` IS NULL

--5 TO DO
SELECT `order`.`id`, `user`.`firstname`, `user`.`email` FROM `order` LEFT JOIN `user` ON `order`.`user_id`=`user`.`id`;

SELECT `order`.`id`, `product`.`cost` FROM `order_products` WHERE GROUP BY `order_products`.`order_id` 