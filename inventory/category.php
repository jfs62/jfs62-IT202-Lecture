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
require_once 'database.php';

class Category {
    public $categoryID;
    public $categoryCode;
    public $categoryName;

    public function __construct($categoryID, $categoryCode, $categoryName) {
        $this->categoryID   = (int)$categoryID;
        $this->categoryCode = $categoryCode;
        $this->categoryName = $categoryName;
    }

    public function __toString() {
        return "<h2>Category Number: {$this->categoryID}</h2>\n"
             . "<h2>{$this->categoryCode}, {$this->categoryName}</h2>\n";
    }

    public function saveCategory() {
        $db = getDB();
        $sql = "INSERT INTO categories (categoryID, categoryCode, categoryName)
                VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("iss", $this->categoryID, $this->categoryCode, $this->categoryName);
        $ok = $stmt->execute();
        $stmt->close();
        $db->close();
        return $ok;
    }

    public static function getCategories() {
        $db = getDB();
        $sql = "SELECT categoryID, categoryCode, categoryName
                FROM categories
                ORDER BY categoryID";
        $result = $db->query($sql);
        if (!$result) { $db->close(); return null; }

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = new Category($row['categoryID'], $row['categoryCode'], $row['categoryName']);
        }
        $result->free();
        $db->close();
        return $categories ?: null;
    }

    public static function findCategory($categoryID) {
        $db = getDB();
        $sql = "SELECT categoryID, categoryCode, categoryName
                FROM categories
                WHERE categoryID = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $categoryID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        if ($row) {
            return new Category($row['categoryID'], $row['categoryCode'], $row['categoryName']);
        }
        return null;
    }

    public function updateCategory() {
        $db = getDB();
        $sql = "UPDATE categories
                SET categoryCode = ?, categoryName = ?
                WHERE categoryID = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssi", $this->categoryCode, $this->categoryName, $this->categoryID);
        $ok = $stmt->execute();
        $stmt->close();
        $db->close();
        return $ok;
    }

    public function removeCategory() {
        $db = getDB();
        $sql = "DELETE FROM categories WHERE categoryID = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $this->categoryID);
        $ok = $stmt->execute();
        $stmt->close();
        $db->close();
        return $ok;
    }
}
