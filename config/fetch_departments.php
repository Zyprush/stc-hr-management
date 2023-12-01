<?php
// Include your database connection code here
include '../config/dbcon.php';

// Fetch data from the 'departments' table
$query = "SELECT * FROM departments";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Create an array to store the department data
$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close the database connection
$conn->close();

// Return the data as JSON
echo json_encode($data);
?>
<?php

?>