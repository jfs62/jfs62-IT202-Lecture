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
require_once('database.php');
class Category
{
   public $categoryID;
   public $categoryCode;
   public $categoryName;
   function __construct($categoryID, $categoryCode, $categoryName)
   {
       $this->categoryID = $categoryID;
       $this->categoryCode = $categoryCode;
       $this->categoryName = $categoryName;
   }
   function __toString()
   {
       $output = "<h2>Category Number: $this->categoryID</h2>\n" .
           "<h2>$this->categoryCode, $this->categoryName</h2>\n";
       return $output;
   }
 function saveCategory()
   {
       $db = getDB();
       $query = "INSERT INTO categories VALUES (?, ?, ?)";
       $stmt = $db->prepare($query);
       $stmt->bind_param(
           "iss",
           $this->categoryID,
           $this->categoryCode,
           $this->categoryName
       );
       $result = $stmt->execute();
       $db->close();
       return $result;
   }
   static function getCategories()
   {
       $db = getDB();
       $query = "SELECT * FROM categories";
       $result = $db->query($query);
       if (mysqli_num_rows($result) > 0) {
           $categories = array();
           while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
               $category = new Category(
                   $row['categoryID'],
                   $row['categoryCode'],
                   $row['categoryName']
               );
               array_push($categories, $category);
               unset($category);
           }
           $db->close();
           return $categories;
       } else {
           $db->close();
           return NULL;
       }
   }
static function findCategory($categoryID)
   {
       $db = getDB();
       $query = "SELECT * FROM categories WHERE categoryID = $categoryID";
       $result = $db->query($query);
       $row = $result->fetch_array(MYSQLI_ASSOC);
       if ($row) {
           $category = new Category(
               $row['categoryID'],
               $row['categoryCode'],
               $row['categoryName']
           );
           $db->close();
           return $category;
       } else {
           $db->close();
           return NULL;
       }
   }
 function updateCategory()
   {
       $db = getDB();
       $query = "UPDATE categories SET categoryID = ?, categoryCode = ?, " .
           "categoryName = ? " .
           "WHERE categoryID = $this->categoryID";
       $stmt = $db->prepare($query);
       $stmt->bind_param(
           "iss",
           $this->categoryID,
           $this->categoryCode,
           $this->categoryName
       );
       $result = $stmt->execute();
       $db->close();
       return $result;
   }


}
?>
  function removeCategory()
   {
       $db = getDB();
       $query = "______ FROM __________ WHERE categoryID = $this->categoryID";
       $result = $db->query($query);
       $db->close();
       return $result;
   }
