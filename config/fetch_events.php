<?php
// Include your database connection code here
include '../config/dbcon.php';

// Fetch data from the 'events' table
$query = "SELECT * FROM events";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Create an array to store the event data
$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close the database connection
$conn->close();

// Return the data as JSON
echo json_encode($data);
