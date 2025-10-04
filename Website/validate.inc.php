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

$sql = "SELECT firstName, lastName, pronouns
        FROM GuitarManagers
        WHERE emailAddress = ? AND password = SHA2(?, 256)";

$stmt = $db->prepare($sql);
$stmt->bind_param("ss", $emailAddress, $password);

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

  echo "<h2>Login Successful!</h2>";
  echo "<p>Welcome, " . htmlspecialchars($firstName . ' ' . $lastName) . " (" . htmlspecialchars($pronouns) . ")</p>";
  echo "<p>Email: " . htmlspecialchars($emailAddress) . "</p>";
  echo '<a href="index.php">Go to main page</a>';
  exit;
}
?>
<h2>Sorry, login incorrect for Guitar Shop Inventory</h2>
<a href="index.php">Please try again</a>
