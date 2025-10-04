<?php
/*
===============================================================
Name: James Shields
UCID: jfs62
Course: IT-202 Internet Applications (Section XX)
Assignment: Phase 1 – Login/Logout
File: website/validate.inc.php
Store: Guitar Shop
Date: 2025-10-03
Email: jfs62@njit.edu
===============================================================
*/
require_once 'database.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$emailAddress = trim($_POST['emailAddress'] ?? '');
$password     = $_POST['password'] ?? '';

$db = getDB();
if (!$db) {
  
  echo "<h2>Sorry, database connection error.</h2>";
  echo '<a href="index.php">Back</a>';
  exit;
}
$hashedPassword = hash('sha256', $password);
$sql = "SELECT firstName, lastName, pronouns
        FROM GuitarManagers
        WHERE emailAddress = ? AND password = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("ss", $emailAddress, $hashedPassword);
$stmt->execute();
$stmt->bind_result($firstName, $lastName, $pronouns);
$ok = $stmt->fetch();
$stmt->close();
$db->close();

if ($ok) {
  $_SESSION['login']        = true;
  $_SESSION['emailAddress'] = $emailAddress;
  $_SESSION['firstName']    = $firstName;
  $_SESSION['lastName']     = $lastName;
  $_SESSION['pronouns']     = $pronouns;

  include 'main.inc.php';
  exit;
}
?>
<h2>Sorry, login incorrect for Guitar Shop Inventory</h2>
<a href="index.php">Please try again</a>
