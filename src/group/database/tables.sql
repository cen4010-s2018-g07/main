 CREATE TABLE users ( 
     znumber CHAR(8) NOT NULL PRIMARY KEY,
     login_id INT UNIQUE,
     first_name VARCHAR(50),
     last_name VARCHAR(50),
     email VARCHAR(255),
     phone_number VARCHAR(20),
     college_id INT,
     dept_id INT
     ) ENGINE = INNODB;

CREATE TABLE accounts (
     login_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
     znumber CHAR(8) NOT NULL,
     username VARCHAR(50) NOT NULL UNIQUE,
     password VARCHAR(255) NOT NULL
     ) ENGINE = INNODB;

ALTER TABLE accounts ADD CONSTRAINT fk_znumber FOREIGN KEY (znumber) REFERENCES users(znumber) 
ON DELETE CASCADE ON UPDATE CASCADE;

/*
ALTER TABLE users ADD CONSTRAINT fk_login_id FOREIGN KEY (login_id) REFERENCES accounts(login_id) 
ON DELETE CASCADE ON UPDATE CASCADE;
*/