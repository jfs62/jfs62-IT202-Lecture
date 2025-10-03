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
require_once('item.php');
$itemID = $_POST['itemID'];
if ((trim($itemID) == '') or (!is_numeric($itemID))) {
   echo "<h2>Sorry, you must enter a valid item ID number</h2>\n";
} else {
   $itemName = $_POST['itemName'];
   $categoryID = $_POST['categoryID'];
   $listPrice = $_POST['listPrice'];
   $item = new Item(
       $itemID,
       $itemName,
       $categoryID,
       $listPrice
   );
   $result = $item->saveItem();
   if ($result)
       echo "<h2>New Item #$itemID successfully added</h2>\n";
   else
       echo "<h2>Sorry, there was a problem adding that item</h2>\n";
}
?>
