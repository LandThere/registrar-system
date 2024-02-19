

CREATE TABLE `esu_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `std_id` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `college` varchar(100) NOT NULL,
  `courname` varchar(100) NOT NULL,
  `started` varchar(100) NOT NULL,
  `folder` varchar(25) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `remarks` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




