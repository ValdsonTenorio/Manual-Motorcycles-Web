CREATE DATABASE api_db;

USE api_db;

CREATE TABLE motors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    mark VARCHAR(100) NOT NULL,
    cylinder INT NOT NULL,
    year INT NOT NULL
);
CREATE TABLE parts(
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(100) NOT NULL,
    price FLOAT NOT NULL,
    description VARCHAR(10) NOT NULL,
    id_motors INT NOT NULL,
    FOREIGN KEY (id_motors) REFERENCES motors(id)
);