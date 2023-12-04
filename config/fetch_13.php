<?php
include 'dbcon.php'; // Include your database connection

// Calculate the date one month ago from today
$oneMonthAgo = date('Y-m-d', strtotime('-6 month'));

// Perform a select query to fetch data from the 'employees' table for employees who started at least 1 month ago
$query = "SELECT ID, name, office, position, start,
    TIMESTAMPDIFF(YEAR, start, CURDATE()) AS years_diff,
    TIMESTAMPDIFF(MONTH, start, CURDATE()) % 12 AS months_diff
    FROM employees 
    WHERE start <= '$oneMonthAgo'";

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
