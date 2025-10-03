<?php
/*
===============================================================
Name: James Shields
UCID: jfs62
Course: IT-202 Internet Applications (Section XX)
Assignment: Phase 1 – Login/Logout
Store: Guitar Shop
Date: 2025-10-03
Email: jfs62@njit.edu
===============================================================
*/
declare(strict_types=1);

// Uses your existing DB helper that must define function getDB(): mysqli
require_once __DIR__ . '/database.php';

/**
 * Define Category only if not already loaded elsewhere.
 */
if (!class_exists('Category')) {
    class Category
    {
        public int $categoryID;
        public string $categoryCode;
        public string $categoryName;

        public function __construct(int $categoryID, string $categoryCode, string $categoryName)
        {
            $this->categoryID   = $categoryID;
            $this->categoryCode = $categoryCode;
            $this->categoryName = $categoryName;
        }

        public function __toString(): string
        {
            $id   = htmlspecialchars((string)$this->categoryID, ENT_QUOTES, 'UTF-8');
            $code = htmlspecialchars($this->categoryCode, ENT_QUOTES, 'UTF-8');
            $name = htmlspecialchars($this->categoryName, ENT_QUOTES, 'UTF-8');

            return "Category {$id} — {$code}: {$name}";
        }

        public function saveCategory(): bool
        {
            $db = getDB();
            $sql = "INSERT INTO categories (categoryID, categoryCode, categoryName) VALUES (?, ?, ?)";
            $stmt = $db->prepare($sql);
            if (!$stmt) {
                $db->close();
                return false;
            }

            $stmt->bind_param(
                "iss",
                $this->categoryID,
                $this->categoryCode,
                $this->categoryName
            );

            $ok = $stmt->execute();
            $stmt->close();
            $db->close();
            return $ok;
        }
    }
}

/**
 * Define Item only if not already loaded elsewhere.
 */
if (!class_exists('Item')) {
    class Item
    {
        public int $itemID;
        public string $itemName;
        public int $categoryID;
        public float $listPrice;

        public function __construct(int $itemID, string $itemName, int $categoryID, float $listPrice)
        {
            $this->itemID     = $itemID;
            $this->itemName   = $itemName;
            $this->categoryID = $categoryID;
            $this->listPrice  = $listPrice;
        }

        public function __toString(): string
        {
            $id    = htmlspecialchars((string)$this->itemID, ENT_QUOTES, 'UTF-8');
            $name  = htmlspecialchars($this->itemName, ENT_QUOTES, 'UTF-8');
            $cat   = htmlspecialchars((string)$this->categoryID, ENT_QUOTES, 'UTF-8');
            $price = htmlspecialchars(number_format($this->listPrice, 2, '.', ''), ENT_QUOTES, 'UTF-8');

            return "Item {$id} — {$name} (Category {$cat}) \${$price}";
        }

        public static function getItems(): ?array
        {
            $db = getDB();
            $sql = "SELECT itemID, itemName, categoryID, listPrice FROM items";
            $result = $db->query($sql);

            if (!$result) {
                $db->close();
                return null;
            }

            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = new self(
                    (int)$row['itemID'],
                    (string)$row['itemName'],
                    (int)$row['categoryID'],
                    (float)$row['listPrice']
                );
            }
            $result->free();
            $db->close();

            return $items ?: null;
        }
    }
}

/**
 * Handle the POST request to add a category.
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "<h2>Method not allowed</h2>\n";
    exit;
}

$categoryID   = $_POST['categoryID']   ?? '';
$categoryCode = $_POST['categoryCode'] ?? '';
$categoryName = $_POST['categoryName'] ?? '';

if (trim($categoryID) === '' || !is_numeric($categoryID)) {
    echo "<h2>Sorry, you must enter a valid category ID number</h2>\n";
    exit;
}

$categoryID   = (int)$categoryID;
$categoryCode = trim($categoryCode);
$categoryName = trim($categoryName);

$category = new Category($categoryID, $categoryCode, $categoryName);
$result   = $category->saveCategory();

if ($result) {
    echo "<h2>New Category #{$categoryID} successfully added</h2>\n";
    echo "<h2>" . htmlspecialchars((string)$category, ENT_QUOTES, 'UTF-8') . "</h2>\n";
} else {
    echo "<h2>Sorry, there was a problem adding that category</h2>\n";
}

