<?php
include 'dbcon.php'; // Include your database connection

// Perform a select query to fetch data from the 'employees' table
$query = "SELECT ID, name, newItem, office, employment, start, position FROM employees";

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
