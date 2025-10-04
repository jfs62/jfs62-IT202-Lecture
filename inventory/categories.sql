-- ============================================================
-- Name: James Shields
-- UCID: jfs62
-- Course: IT-202 Internet Applications (Section XX)
-- Assignment: Phase 1 – Login/Logout
-- Store: Guitar Shop
-- Date: 2025-10-03
-- Email: jfs62@njit.edu
-- ============================================================
CREATE TABLE categories (
  categoryID     INT(11)      NOT NULL,
  categoryCode   VARCHAR(10)  NOT NULL,
  categoryName   VARCHAR(255) NOT NULL,
  PRIMARY KEY (categoryID)
);

INSERT INTO categories
(categoryID, categoryCode, categoryName)
VALUES (100, 'GTR', 'Guitars');

-- Optional cleanup
DELETE FROM categories WHERE categoryID = 100;

SELECT * FROM categories;
