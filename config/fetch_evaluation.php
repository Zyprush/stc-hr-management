<?php
include 'dbcon.php'; // Include your database connection

// Perform a select query to fetch data from the 'evaluation' table
$query = "SELECT ID, name, itemNo, office, employment, semester, average FROM evaluation";

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
