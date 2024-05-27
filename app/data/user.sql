DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
    `id` INT(4) NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `roles` TEXT NOT NULL,
    `timestamp_register` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `timestamp_update` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE (`email`)
);

INSERT INTO `user`
(`email`, `password`, `roles`)
VALUES
('example@test.com', '123', 'ADMIN');
