DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `name` varchar(255) NOT NULL,
    `userId` int(3) NOT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`name`, `userId`, `password`) VALUES
('Admin', '999', '$2y$12$pSe7DWznXBHgvAZ9AtvJl.OxFhmX9694wFTmEJL5kKFsrmsb5uzzu');