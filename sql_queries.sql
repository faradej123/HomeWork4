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

--5
SELECT `order_products`.`order_id`, `user`.`email`,
sum(`product`.`cost` * `order_products`.`count`) as `summ` 
FROM `order_products` 
LEFT JOIN `product` ON `product`.`id`=`order_products`.`product_id`
LEFT JOIN `order` ON `order`.`id`=`order_products`.`order_id`
LEFT JOIN `user` ON `user`.`id`=`order`.`user_id`
GROUP BY `order_products`.`order_id`, `user`.`email` ORDER BY `summ` ASC

--6
SELECT * FROM `user` WHERE `role` != "Admin" AND `role` != "User"