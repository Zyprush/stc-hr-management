<?php
// Include your database connection code here
include '../config/dbcon.php';

// Fetch data from the 'departments' table
$query = "SELECT * FROM employees";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Create an array to store the department data
$data = array();

while ($row = $result->fetch_assoc()) {
    // Combine first, middle, last, and extension into FullName
    $fullName = $row['FirstName'] . ' ' . $row['MiddleName'] . ' ' . $row['LastName'] . ' ' . $row['Extension'];
    $row['FullName'] = $fullName;

    unset($row['FirstName'], $row['MiddleName'], $row['LastName'], $row['Extension']);

    $data[] = $row;
}

// Close the database connection
$conn->close();

// Return the data as JSON
echo json_encode($data);
?>
<?php

?>