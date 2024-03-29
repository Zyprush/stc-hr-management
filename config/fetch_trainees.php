<?php
include 'dbcon.php'; // Include your database connection

// Perform a select query to fetch data from the 'trainees' table
$query = "SELECT ID, trainee_name, training_date, description, training_type, duration, trainee_position FROM trainees";

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
