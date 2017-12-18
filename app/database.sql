CREATE DATABASE app;
CREATE TABLE users (
    ID int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    email varchar(255) NOT NULL,
    pwd varchar(255) NOT NULL,
    LastName varchar(255) NOT NULL,
    FirstName varchar(255) NOT NULL,
    City varchar(255) NOT NULL
);

INSERT INTO users VALUES (1, "lavan.prep@gmail.com", "test", "Lavan", "PREPANANTHA", "Le Bourget"); 
UPDATE users SET email="lavan.prep1@gmail.com" WHERE ID=1; 
INSERT INTO users VALUES (2, "test@gmail.com", "test", "test", "test", "test");
DELETE FROM users WHERE email="test@gmail.com";

DROP DATABASE app;
DROP TABLE users;
