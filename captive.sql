CREATE TABLE autenticado (
    id SERIAL,
    nome VARCHAR(50) NOT NULL,
    sobrenome VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mac_address VARCHAR(17) NOT NULL,
    last_update_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_autenticados PRIMARY KEY (id),
    UNIQUE (email),
    UNIQUE (mac_address)
);
