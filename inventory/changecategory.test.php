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
require_once("category.php");
$categoryID = $_POST['categoryID'];
$category = Category::findCategory($categoryID);
$category->categoryID = $_POST['categoryID'];
$category->categoryCode = $_POST['categoryCode'];
$category->categoryName = $_POST['categoryName'];
$result = $category->updateCategory();
if ($result) {
   echo "<h2>Category $categoryID updated</h2>\n";
} else {
   echo "<h2>Problem updating category $categoryID</h2>\n";
}
?>
