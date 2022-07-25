CREATE TABLE `boom` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `penname` text NOT NULL,
 `comment` varchar(100) NOT NULL,
 `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4