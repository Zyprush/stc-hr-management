<?php
include '../config/dbcon.php'; // Include your database connection code here

// Prepare a SQL query to count the number of departments
$query = "SELECT COUNT(*) as departmentCount FROM departments"; // Replace 'departments' with your actual table name
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $departmentCount = $row['departmentCount'];
    } else {
        // Handle the case where there is no data in the table
        $departmentCount = 0;
    }
} else {
    // Handle the case where the query fails
    $departmentCount = 0;
}
