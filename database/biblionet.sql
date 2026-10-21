CREATE DATABASE IF NOT EXISTS biblionet CHARACTER SET utf8mb4;
USE biblionet;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (nom, email, password)
VALUES ('Bibliothécaire', 'admin@biblionet.ga', '$2y$10$E2htFcx2dQ7pLC3lShaiXuX98s9tPJAagtAEKaxa/KA1lCE/YQQ1O');