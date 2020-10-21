CREATE TABLE IF NOT EXISTS `food` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(100) NOT NULL,
  `price` double(9,2) NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `food` (`id`, `name`, `code`, `price`, `image`) VALUES
(1, 'Salmon Burger', 'fish', 6.00, 'images/fishburger.jpg'),
(2, 'Cheesy Chicken Burger', 'chicken', 5.00, 'images/chickenburger.jpg');