<?php
include 'dbcon.php'; // Include your database connection

// Calculate the date ten years ago from today
$tenYearsAgo = date('Y-m-d', strtotime('-10 years'));

// Perform a select query to fetch data from the 'employees' table for employees who started 10 or more years ago
$query = "SELECT ID, name, office, position, start,
    TIMESTAMPDIFF(YEAR, start, CURDATE()) AS years_diff,
    TIMESTAMPDIFF(MONTH, start, CURDATE()) % 12 AS months_diff
    FROM employees 
    WHERE start <= '$tenYearsAgo'";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['error' => 'Error fetching data']);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $years = $row['years_diff'];
    $months = $row['months_diff'];

    $duration = ($years > 0 ? $years . ' year' . ($years !== 1 ? 's' : '') : '') . 
        ($months > 0 ? ($years > 0 ? ' and ' : '') . $months . ' month' . ($months !== 1 ? 's' : '') : '');

    $row['duration'] = $duration;
    unset($row['years_diff']);
    unset($row['months_diff']);

    $data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
