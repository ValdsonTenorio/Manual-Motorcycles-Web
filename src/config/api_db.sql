CREATE DATABASE api_db;

USE api_db;

CREATE TABLE motors (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    mark VARCHAR(100) NOT NULL,
    cylinder INT NOT NULL,
    ano INT NOT NULL
);
CREATE TABLE parts(
    id SERIAL PRIMARY KEY,
    tipo VARCHAR(100) NOT NULL,
    price FLOAT NOT NULL,
    descricao VARCHAR(100) NOT NULL,
    id_motors INT NOT NULL,
    FOREIGN KEY (id_motors) REFERENCES motors(id)
);