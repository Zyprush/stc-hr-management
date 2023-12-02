<?php
include '../config/dbcon.php'; // Include your database connection code here

// Prepare a SQL query to count the number of departments
$departmentQuery = "SELECT COUNT(*) as departmentCount FROM departments"; // Replace 'departments' with your actual table name
$departmentResult = mysqli_query($conn, $departmentQuery);

// Prepare a SQL query to count the number of employees
$employeeQuery = "SELECT COUNT(*) as employeeCount FROM employees"; // Replace 'employees' with your actual table name
$employeeResult = mysqli_query($conn, $employeeQuery);

// Prepare a SQL query to count the number of employees_jo
$joQuery = "SELECT COUNT(*) as joCount FROM employees_jo"; // Replace 'employees_jo' with your actual table name
$joResult = mysqli_query($conn, $joQuery);

// Prepare a SQL query to count the number of employees_jo with contracts expiring within the next 7 days
$expiringQuery = "SELECT COUNT(*) as expiringCount FROM employees_jo WHERE end >= NOW() AND end <= DATE_ADD(NOW(), INTERVAL 7 DAY)";
$expiringResult = mysqli_query($conn, $expiringQuery);

// Initialize variables
$departmentCount = 0;
$employeeCount = 0;
$joCount = 0;
$expiringCount = 0;

// Check for the number of departments
if ($departmentResult) {
    if (mysqli_num_rows($departmentResult) > 0) {
        $departmentRow = mysqli_fetch_assoc($departmentResult);
        $departmentCount = $departmentRow['departmentCount'];
    }
}

// Check for the number of employees
if ($employeeResult) {
    if (mysqli_num_rows($employeeResult) > 0) {
        $employeeRow = mysqli_fetch_assoc($employeeResult);
        $employeeCount = $employeeRow['employeeCount'];
    }
}

// Check for the number of employees_jo
if ($joResult) {
    if (mysqli_num_rows($joResult) > 0) {
        $joRow = mysqli_fetch_assoc($joResult);
        $joCount = $joRow['joCount'];
    }
}

// Check for the number of expiring contracts
if ($expiringResult) {
    if (mysqli_num_rows($expiringResult) > 0) {
        $expiringRow = mysqli_fetch_assoc($expiringResult);
        $expiringCount = $expiringRow['expiringCount'];
    }
}

// Use the counts as needed
$permanent = $employeeCount; // Assuming you want to store the count of employees in $permanent
$jo = $joCount; // Assuming you want to store the count of employees from 'employees_jo' in $jo
$expiring = $expiringCount; // Assuming you want to store the count of expiring contracts in the next 7 days in $expiring

// $departmentCount now contains the count of departments, or it's set to 0 if there's an issue with the query or no data in the table
// $employeeCount now contains the count of employees, or it's set to 0 if there's an issue with the query or no data in the table
// $joCount now contains the count of employees from the 'employees_jo' table, or it's set to 0 if there's an issue with the query or no data in the table
// $expiringCount now contains the count of expiring contracts in the next 7 days, or it's set to 0 if there's an issue with the query or no data in the table
// $permanent now contains the count of employees from the 'employees' table
