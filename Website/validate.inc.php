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
 error_log("\$_POST " . print_r($_POST, true));
 require_once('database.php');
 $emailAddress = $_POST['emailAddress'];
 $password = $_POST['password'];
 $query = "SELECT firstName, lastName FROM admins " .
        "WHERE emailAddress = ? AND password = SHA2(?,256)";
 $db = getDB();
 $stmt = $db->prepare($query);
 $stmt->bind_param("ss", $emailAddress, $password);
 $stmt->execute();
 $stmt->bind_result($firstName, $lastName);
 $fetched = $stmt->fetch();
 $name = "$firstName $lastName";
 if ($fetched && isset($name)) {
   echo "<h2>Welcome to Inventory Helper, $name</h2>\n";
   $_SESSION['login'] = $name;
   header("Location: index.php");
 } else {
   echo "<h2>Sorry, login incorrect</h2>\n";
   echo "<a href=\"index.php\">Please try again</a>\n";
 }
 echo "<H1>Guitar Shop</H1>";
?>


