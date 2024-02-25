<?php
include 'dbcon.php'; // Include your database connection

// Get the current date
$currentDate = date('Y-m-d');

// Perform a select query to fetch data from the 'employees_jo' table
$query1 = "SELECT ID, name, end, office, employment, start, position FROM employees_jo WHERE end <= '$currentDate' OR end IS NULL";

// Perform a select query to fetch data from the 'employee_contract' table
//$query2 = "SELECT * FROM employee_contract WHERE end <= '$currentDate' OR end IS NULL";

// Combine the results using UNION
$query = "($query1) ";

// UNION ($query2)

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
