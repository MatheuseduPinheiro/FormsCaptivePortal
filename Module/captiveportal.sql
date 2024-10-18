CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT,
    name_user VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    registration_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL DEFAULT NULL,  -- Adiciona um campo para armazenar o último login
    PRIMARY KEY (id),
    CONSTRAINT un_email UNIQUE (email)
);
