CREATE DATABASE generosliterarios;
USE `generosliterarios`;

CREATE TABLE IF NOT EXISTS `generosliterarios`.`usuarios` (
    `id_user` varchar(15) NOT NULL,
    `name` varchar(45) DEFAULT NULL,
    `gender` varchar(45) DEFAULT NULL,
    `preferences` varchar(200) DEFAULT NULL,
    PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuarios` (`id_user`, `name`, `gender`, `preferences`) VALUES
('franciscot', 'Francisco Tovar', 'Masculino', "['Terror', 'Ficcion', 'Policiaca', 'Ciencia']"),