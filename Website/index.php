<?php
/*
===============================================================
Name: James Shields
UCID: jfs62
Course: IT-202 Internet Applications (Section XX)
Assignment: Phase 1 – Login/Logout
File: website/index.php
Store: Guitar Shop
Date: 2025-10-03
Email: jfs62@njit.edu
===============================================================
*/
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$content = $_REQUEST['content'] ?? 'main';
$view = in_array($content, ['main','validate','logout'], true)
  ? $content . '.inc.php'
  : 'main.inc.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Guitar Shop Inventory Website</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php include $view; ?>
</body>
</html>
