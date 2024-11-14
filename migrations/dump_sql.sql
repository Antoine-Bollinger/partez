DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
    `userId` int(3) NOT NULL,
    `password` varchar(255) NOT NULL,
    `name` varchar(255) NOT NULL,
    PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`userId`, `password`, `name`) VALUES
(:userId, :password, "Test");
