-- ============================================================
-- Name: James Shields
-- UCID: jfs62
-- Course: IT-202 Internet Applications (Section XX)
-- Assignment: Phase 1 – Login/Logout (Export)
-- Store: Guitar Shop
-- Date: 2025-10-03
-- Email: jfs62@njit.edu
-- ============================================================

DROP TABLE IF EXISTS `GuitarManagers`;

CREATE TABLE `GuitarManagers` (
  `GuitarManagerID` int(11) NOT NULL AUTO_INCREMENT,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `pronouns` varchar(60) NOT NULL,
  `firstName` varchar(60) NOT NULL,
  `lastName` varchar(60) NOT NULL,
  `DateTimeCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateTimeUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`GuitarManagerID`),
  UNIQUE KEY `uniq_email` (`emailAddress`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `GuitarManagers`
(`GuitarManagerID`,`emailAddress`,`password`,`pronouns`,`firstName`,`lastName`,`DateTimeCreated`,`DateTimeUpdated`) VALUES
(1,'taylor@guitarshop.com','3cdfa761361762ddedc01ea1428db10a92e327325f490f7f34f1b1b91d994f22','She/Her','Taylor','Swift','2025-10-03 17:00:00','2025-10-03 17:00:00'),
(2,'brad@guitarshop.com','08f6adbf0589ed8c49437338bd87536b102e8732cac5ef5e46c26e002c04dcc1','He/Him','Brad','Pitt','2025-10-03 17:02:00','2025-10-03 17:02:00'),
(3,'alex@guitarshop.com','e1b19284e75bc820712e00565c6a273d30fb74dfc2959991893fad8f8864218f','They/Them','Alex','Rivera','2025-10-03 17:03:00','2025-10-03 17:03:00');
