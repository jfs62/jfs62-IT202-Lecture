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
require_once("item.php");
$itemID = $_POST['itemID'];
$item = Item::findItem($itemID);
$item->itemID = $_POST['itemID'];
$item->itemName = $_POST['itemName'];
$item->categoryID = $_POST['categoryID'];
$item->listPrice = $_POST['listPrice'];
$result = $item->updateItem();
if ($result) {
   echo "<h2>Item $itemID updated</h2>\n";
} else {
   echo "<h2>Problem updating item $itemID</h2>\n";
}
?>
