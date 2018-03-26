INSERT INTO `users` (`name`, `email`, `password`, `verified`, `gender`, `dob`, `country`, `area`, `bio`, `created_at`) VALUES
('Abdul Wahab', 'wabdul@gmail.com', 'wahab007', NULL, 'Male', '1994-05-10', 'India', 'Trichy', 'Wrestling Observer', '2018-03-03 22:58:15'),
('Virak Kohli', 'vkohli@gmail.com', 'vkohli007', NULL, 'Male', '1994-05-10', 'India', 'Delhi', 'Indian international cricketer, current captain of the India national team.', '2018-03-03 22:58:15'),
('Anushka Sharma', 'asharma@gmail.com', 'asharma007', NULL, 'Female', '1990-01-01', 'India', 'Mumbai', 'Actress', '2018-03-03 22:58:15'),
('Sachin Tendulkar', 'stendulkar@gmail.com', 'stendul007', NULL, 'Male', '1980-01-01', 'India', 'Mumbai',  'Master Blaster', '2018-03-03 22:58:15'),
('Mark Zuckerberg', 'mzuckerberg@gmail.com', 'mzuck007', NULL, 'Male', '1992-01-02', 'USA', 'San Francisco', 'CEO of Facebook', '2018-03-03 22:58:15'),
('Sham Idrees', 'sidrees@gmail.com', 'sidrees007', NULL, 'Male', '1992-01-02', 'Canada', 'Vancouver', 'Youtuber, Singer', '2018-03-03 22:58:15'),
('Queen Froggy', 'qfroggy@gmail.com', 'qfroggy007', NULL, 'Female', '1992-01-02', 'Canada', 'Toronto',  'I love travel and cooking', '2018-03-03 22:58:15'),
('Shahveer Jafry', 'sjafry@gmail.com', 'sjafry007', NULL, 'Male', '1992-01-02', 'Canada', 'Quebec', 'Coding fanatic, android development addict', '2018-03-03 22:58:15')
;

INSERT INTO interests(userID) VALUES
('3'),
('4'),
('5'),
('6'),
('7'),
('8'),
('9'),
('10')
;

UPDATE `interests` SET Java=1 Android=1 WHERE userID = 7;



INSERT INTO `friends`(`userOne`, `userTwo`, `status`, `actionUser`) VALUES 
( '1', '3', '1', '3' ),
( '1', '7', '1', '1' ),
( '1', '10', '1', '10' ),
( '1', '4', '0', '4' ),
( '1', '5', '0', '5' )
;