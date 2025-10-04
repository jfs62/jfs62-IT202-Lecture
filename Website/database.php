<?php
/*
===============================================================
Name: James Shields
UCID: jfs62
Course: IT-202 Internet Applications (Section XX)
Assignment: Phase 1 – Login/Logout
File: website/database.php
Store: Guitar Shop
Date: 2025-10-03
Email: jfs62@njit.edu
===============================================================
*/

function getDB(): mysqli {
  // UPDATE THESE THREE LINES WITH YOUR REAL NJIT MYSQL CREDS
  $host     = 'sql1.njit.edu';
  $dbname   = 'jfs62';        
  $username = 'jfs62';        
  $password = 'Avatar0302!'; 
  $port     = 3306;

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  try {
    $db = new mysqli($host, $username, $password, $dbname, $port);
    $db->set_charset('utf8mb4');
    return $db;
  } catch (mysqli_sql_exception $e) {
    error_log('DB connect error: ' . $e->getMessage());
    http_response_code(500);
    exit('Database connection error.');
  }
}
