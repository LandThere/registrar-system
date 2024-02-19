

CREATE TABLE `main_archive` (
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;


INSERT INTO main_archive VALUES
("22","202009922","Jon","Aves","","M","CCS","BSIT","1948-1949","A1","Active","huh","2023-03-23",""),
("27","202001821","Cherry","Arat","","F","CCS","BSIT","1948-1949","","Active","","2023-03-25","");


