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

// Get form input
$emailAddress = trim($_POST['emailAddress'] ?? '');
$password     = $_POST['password'] ?? '';

if ($emailAddress === '' || $password === '') {
    http_response_code(400);
    echo "<h2>Missing email or password</h2>";
    echo '<a href="index.php">Back</a>';
    exit;
}

$db = getDB();

// Use prepared statement with SHA2 hashing in SQL
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
    echo "<p>Welcome, " . htmlspecialchars("$firstName $lastName") . " (" . htmlspecialchars($pronouns) . ")</p>";
    echo "<p>Email: " . htmlspecialchars($emailAddress) . "</p>";
    echo '<a href="index.php">Go to main page</a>';
} else {
    echo "<h2>Login is unsuccessful</h2>";
    echo '<a href="index.php">Try again</a>';
}
?>