-- Create a database for Gutenberg Project
CREATE DATABASE IF NOT EXISTS challenge34;

USE challenge34;

CREATE TABLE IF NOT EXISTS authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150),
    alias VARCHAR(500),
    birth_date VARCHAR(10),
    death_date VARCHAR(10),
    webpage VARCHAR(200)
);

CREATE TABLE IF NOT EXISTS Books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_author int,
    title VARCHAR(150),
    description VARCHAR(500),
    languages VARCHAR(10),
    Bookshelves JSON,
    Subjects JSON,
    FOREIGN KEY (id_author) REFERENCES authors(id)
);