-- ============================================================
-- Name: James Shields
-- UCID: jfs62
-- Course: IT-202 Internet Applications (Section XX)
-- Assignment: Phase 1 – Login/Logout
-- Store: Guitar Shop
-- Date: 2025-10-03
-- Email: jfs62@njit.edu
-- ============================================================

CREATE TABLE IF NOT EXISTS `GuitarManagers` (
  `GuitarManagerID` INT(11) NOT NULL AUTO_INCREMENT,
  `emailAddress`    VARCHAR(255) NOT NULL UNIQUE,
  `password`        VARCHAR(64)  NOT NULL, -- SHA-256 hex
  `pronouns`        VARCHAR(60)  NOT NULL,
  `firstName`       VARCHAR(60)  NOT NULL,
  `lastName`        VARCHAR(60)  NOT NULL,
  `DateTimeCreated` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateTimeUpdated` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`GuitarManagerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `GuitarManagers` (emailAddress, password, pronouns, firstName, lastName) VALUES
('taylor@guitarshop.com', SHA2('myLongP@ssword', 256), 'She/Her',  'Taylor', 'Swift'),
('brad@guitarshop.com',   SHA2('MySecurePass!1', 256), 'He/Him',    'Brad',   'Pitt'),
('alex@guitarshop.com',   SHA2('AnotherPass!2', 256), 'They/Them', 'Alex',   'Rivera');
