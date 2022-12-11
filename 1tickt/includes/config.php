<?php 
// Turns on output buffering 
ob_start();
session_start();
date_default_timezone_set("America/New_York");

try {
    // DB connection string, user, pw
    $connectionString = new PDO("mysql:dbname=1ticket_dev;host=localhost", "root", ""); 
    $connectionString->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $ex) {
    echo "Connection failed: " . $e->getMessage();
}
?>