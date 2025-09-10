SHOW DATABASES;

CREATE TABLE admins (
    adminID INT(11) NOT NULL AUTO_INCREMENT,
    emailAddress VARCHAR(255) NOT NULL UNIQUE,
    password CHAR(64) NOT NULL,
    firstName VARCHAR(60) NOT NULL,
    lastName VARCHAR(60) NOT NULL,
    PRIMARY KEY (adminID)

);

SHOW TABLES;

SHOW CREATE TABLE admins;

DESCRIBE admins;

INSERT INTO admins
(emailAddress, password, firstName, lastName)
VALUES
('james@guitarshop.com', SHA2('myL0ngP@ssword', 256), 'James', 'Shields'),
('maggie@guitarshop.com', SHA2('iLoveNorthKorea', 256), 'Maggie', 'Shields'),
('bob@guitarshop.com', SHA2('CerialIsSoup', 256), 'Bob', 'Saget');

SELECT * FROM admins;
