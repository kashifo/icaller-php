CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `verified` varchar(10) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `country` varchar(25) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users Table';


CREATE TABLE `icaller`.`interests` (
  `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `userID` int(10) NOT NULL,  
  `Islam` int DEFAULT NULL,
  `Java` int DEFAULT NULL,
  `Android` int DEFAULT NULL,
  `JavaScript` int DEFAULT NULL,
  `Python` int DEFAULT NULL,
  `PC` int DEFAULT NULL,
  `XBox` int DEFAULT NULL,
  `PlayStation` int DEFAULT NULL,
  `WiiU` int DEFAULT NULL,
  `Asian` int DEFAULT NULL,
  `Indian` int DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Interests Table';

SELECT userID FROM `interests` WHERE JavaScript AND Python IS NOT NULL;

CREATE TABLE `icaller`.`friends` (
  `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `userOne` int(10) NOT NULL,
  `userTwo` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `actionUser` int(10) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`userOne`) REFERENCES users(`id`),
  FOREIGN KEY (`userTwo`) REFERENCES users(`id`),
  FOREIGN KEY (`actionUser`) REFERENCES users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Friend Status Table';

//SEND FRND REQ
INSERT INTO `friends`(`userOne`, `userTwo`, `status`, `actionUser`) VALUES ( '1', '2', '0', '1' );

//GET FRND REQS
SELECT actionUser FROM `friends` WHERE ( userOne = 2 OR userTwo = 2 ) AND status = 0 AND actionUser != 2;

SELECT u.name FROM users u, friends f WHERE u.id = f.actionUser;

//GET FRND REQS WITH NAME
SELECT * from users WHERE id = ( SELECT actionUser FROM `friends` WHERE ( userOne = 2 OR userTwo = 2 ) AND status = 0 AND actionUser != 2);


//ACCEPT FRND REQS
UPDATE `friends` SET `status` = 1, `actionUser` = 2 WHERE userOne = 1 AND userTwo = 2;

//GET FRIEND LIST
SELECT * from users WHERE id = (SELECT id FROM `friends` WHERE ( userOne = 2 OR userTwo = 2 ) AND `status` = 1);

SELECT IF(userOne==2, userTwo, userOne)




