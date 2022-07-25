CREATE TABLE `boom` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `subject` text NOT NULL,
 `comment` varchar(100) NOT NULL,
 `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1