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

class Item
{
    public $itemID;
    public $itemName;
    public $categoryID;
    public $listPrice;

    public function __construct($itemID, $itemName, $categoryID, $listPrice)
    {
        $this->itemID     = $itemID;      // int
        $this->itemName   = $itemName;    // string
        $this->categoryID = $categoryID;  // int
        $this->listPrice  = $listPrice;   // float/double
    }

    public function __toString()
    {
        $output  = "<h2>Item: {$this->itemID}</h2>\n";
        $output .= "<h2>Name: {$this->itemName}</h2>\n";
        $output .= "<h2>Category ID: {$this->categoryID} at {$this->listPrice}</h2>\n";
        return $output;
    }

    public function saveItem()
    {
        $db = getDB(); // expects a mysqli connection

        $query = "INSERT INTO items (itemID, itemName, categoryID, listPrice) VALUES (?, ?, ?, ?)";
        $stmt  = $db->prepare($query);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $db->error);
        }

        // Types: i = int, s = string, i = int, d = double
        if (!$stmt->bind_param(
            "isid",
            $this->itemID,
            $this->itemName,
            $this->categoryID,
            $this->listPrice
        )) {
            throw new Exception("Bind failed: " . $stmt->error);
        }

        $result = $stmt->execute();
        if (!$result) {
            $err = $stmt->error;
            $stmt->close();
            $db->close();
            throw new Exception("Execute failed: " . $err);
        }

        $stmt->close();
        $db->close();

        return $result;
    }
static function findItem($itemID)
   {
       $db = getDB();
       $query = "SELECT * FROM items WHERE itemID = $itemID";
       $result = $db->query($query);
       $row = $result->fetch_array(MYSQLI_ASSOC);
       if ($row) {
           $item = new Item(
               $row['itemID'],
               $row['itemName'],
               $row['categoryID'],
               $row['listPrice']
           );
           $db->close();
           return $item;
       } else {
           $db->close();
           return NULL;
       }
   }
   function updateItem()
   {
       $db = getDB();
       $query = "UPDATE items SET itemName= ?, " .
           "categoryID= ?, listPrice= ? WHERE itemID = $this->itemID";
       $stmt = $db->prepare($query);
       $stmt->bind_param(
           "sid",
           $this->itemName,
           $this->categoryID,
           $this->listPrice
       );
       $result = $stmt->execute();
       $db->close();
       return $result;
   }

}
?>

