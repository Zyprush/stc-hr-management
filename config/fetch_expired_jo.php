<?php
include 'dbcon.php'; // Include your database connection

// Get the current date
$currentDate = date('Y-m-d');

// Perform a select query to fetch data from the 'employees_jo' table
$query = "SELECT ID, name, end, office, employment, start, position FROM employees_jo WHERE end <= '$currentDate' OR end IS NULL";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['error' => 'Error fetching data']);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
