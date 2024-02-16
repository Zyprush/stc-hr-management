<?php
$sname = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'stchrbd';

// Create a new mysqli object and establish the connection
$conn = new mysqli($sname, $user, $pass, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Unable to connect to the database: " . $conn->connect_error);
}
