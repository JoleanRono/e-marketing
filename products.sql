CREATE TABLE `products` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(200) CHARACTER SET latin1 NOT NULL,
 `desc` text CHARACTER SET latin1 NOT NULL,
 `price` decimal(7,2) NOT NULL,
 `rrp` decimal(7,2) NOT NULL DEFAULT 0.00,
 `quantity` int(11) NOT NULL,
 `img` text CHARACTER SET latin1 NOT NULL,
 `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8