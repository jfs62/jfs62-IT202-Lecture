-- ============================================================
-- Name: James Shields
-- UCID: jfs62
-- Course: IT-202 Internet Applications (Section XX)
-- Assignment: Phase 1 – Login/Logout
-- Store: Guitar Shop
-- Date: 2025-10-03
-- Email: jfs62@njit.edu
-- ============================================================

CREATE TABLE items (
 itemID           INT(11)        NOT NULL,
 itemName         VARCHAR(255)   NOT NULL,
 categoryID       INT(11)        NOT NULL,
 listPrice        DECIMAL(10,2)  NOT NULL,
 PRIMARY KEY (itemID)
);

INSERT INTO items
(itemID, itemName, categoryID, listPrice)
VALUES
(1000, 'Fender Stratocaster', 100, 699.00);

SELECT * from items;

SELECT * FROM items JOIN categories ON items.categoryID = categories.categoryID;

-- Optional
DELETE from items where itemID = 1000;