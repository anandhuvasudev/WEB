CREATE DATABASE StudentDB;

USE StudentDB;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30),
    last_name VARCHAR(30),
    dob DATE,
    email VARCHAR(50),
    mobile VARCHAR(15),
    gender VARCHAR(10),
    password VARCHAR(255)
);
