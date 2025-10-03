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
function getDB() {
    $host = 'sql1.njit.edu';
    $port = 3306;
    $dbname = 'jfs62';
    $username = 'jfs62';
    $password = 'Avatar0302!';

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $db = new mysqli($host, $username, $password, $dbname, $port);
        $db->set_charset("utf8mb4");

        error_log("Connected to the $host database!");
        //echo "Connected to the $host database!";
        return $db;

    } catch (mysqli_sql_exception $e) {
        error_log("Database connection error: " . $e->getMessage(), 0);
       // echo "Connection failed: " . $e->getMessage();
        return null; 
    }
}

//getDB();
?>