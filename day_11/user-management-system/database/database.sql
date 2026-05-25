CREATE DATABASE user_management;

USE user_management;

CREATE TABLE users(

    id INT AUTO_INCREMENT PRIMARY KEY,

    full_name VARCHAR(100),

    username VARCHAR(100) UNIQUE,

    password VARCHAR(255),

    role VARCHAR(50),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE students(

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100),

    age INT,

    city VARCHAR(100),

    branch VARCHAR(100),

    profile_photo VARCHAR(255),

    resume VARCHAR(255),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);