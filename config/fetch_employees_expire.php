<?php
include 'dbcon.php'; // Include your database connection

// Get today's date
$today = date('Y-m-d');

// Calculate the date after 7 days
$sevenDaysAfter = date('Y-m-d', strtotime($today . ' + 7 days'));

// Perform a select query to fetch data from both 'employees_jo' and 'employee_contract' tables
$query = "(
    SELECT ID, name, end, office, employment, start, position FROM employees_jo 
    WHERE end BETWEEN '$today' AND '$sevenDaysAfter'
) UNION (
    SELECT ID, name, end, office, employment, start, position FROM employee_contract 
    WHERE end BETWEEN '$today' AND '$sevenDaysAfter'
)";

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
