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
$items = Item::getItems();
foreach ($items as $item) {
   $itemID = $item->itemID;
   $itemName = $item->itemName;
   $itemPrice = $item->listPrice;
   $option = $itemID . " - " . $itemName .  " - " . $itemPrice;
   echo "$option<br>";
}
?>
