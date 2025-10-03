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
session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Inventory Helper</title></head>
<body>
   <section id="container">
       <main>
           <?php
           if (isset($_REQUEST['content'])) {
               include($_REQUEST['content'] . ".inc.php");
           } else {
               include("main.inc.php");
           }
           ?>
       </main>
   </section>
</body>
</html>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$content = $_REQUEST['content'] ?? 'main';
$view = preg_replace('/[^a-zA-Z0-9_]/', '', $content) . '.inc.php';
if (!file_exists($view)) $view = 'main.inc.php';
?><!DOCTYPE html>
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