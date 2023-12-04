<?php
include 'dbcon.php'; // Include your database connection

// Calculate the date that corresponds to the age of 60 years from today
$age60 = date('Y-m-d', strtotime('-60 years'));

// Perform a select query to fetch data from the 'employees' table for employees who are 60 years and above
$query = "SELECT ID, name, office, position, birthday,
    TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age
    FROM employees 
    WHERE birthday <= '$age60'";

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
