<?php
/*
===============================================================
Name: James Shields
UCID: jfs62
Course: IT-202 Internet Applications (Section XX)
Assignment: Phase 1 – Login/Logout
File: website/main.inc.php
Store: Guitar Shop
Date: 2025-10-03
Email: jfs62@njit.edu
===============================================================
*/
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$loggedIn = !empty($_SESSION['login']);
?>

<?php if (!$loggedIn): ?>
  <h2>Please log in</h2>
  <form action="index.php" method="post" autocomplete="off">
    <label>Email:</label><br>
    <input type="text" name="emailAddress" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="hidden" name="content" value="validate">
    <input type="submit" value="Login">
  </form>
<?php else: ?>
  <h2>Guitar Shop</h2>
  <p>
    Welcome
    <?= htmlspecialchars($_SESSION['firstName'] . ' ' . $_SESSION['lastName']) ?>
    (<?= htmlspecialchars($_SESSION['pronouns']) ?>)
  </p>
  <p>Email: <?= htmlspecialchars($_SESSION['emailAddress']) ?></p>
  <a href="index.php?content=logout"><strong>Logout</strong></a>
<?php endif; ?>
