<?php
// Include your database connection code here
include 'dbcon.php';

// Initialize an array to store department counts
$departmentCounts = [];

// Retrieve department names from the 'departments' table
$sqlDepartments = "SELECT Department FROM departments";
$resultDepartments = $conn->query($sqlDepartments);

if ($resultDepartments->num_rows > 0) {
    while ($row = $resultDepartments->fetch_assoc()) {
        $department = $row['Department'];

        // Retrieve employee count for each department from the 'employees' table
        $sqlEmployees = "SELECT COUNT(*) AS employeeCount FROM employees WHERE office = ?";
        $stmtEmployees = $conn->prepare($sqlEmployees);
        $stmtEmployees->bind_param("s", $department);
        $stmtEmployees->execute();
        $resultEmployees = $stmtEmployees->get_result();
        $rowEmployees = $resultEmployees->fetch_assoc();
        $employeeCountEmployees = $rowEmployees['employeeCount'];

        // Retrieve employee count for each department from the 'employees_jo' table
        $sqlEmployeesJo = "SELECT COUNT(*) AS employeeCount FROM employees_jo WHERE office = ?";
        $stmtEmployeesJo = $conn->prepare($sqlEmployeesJo);
        $stmtEmployeesJo->bind_param("s", $department);
        $stmtEmployeesJo->execute();
        $resultEmployeesJo = $stmtEmployeesJo->get_result();
        $rowEmployeesJo = $resultEmployeesJo->fetch_assoc();
        $employeeCountEmployeesJo = $rowEmployeesJo['employeeCount'];

        // Total employee count for the department
        $totalEmployeeCount = $employeeCountEmployees + $employeeCountEmployeesJo;

        // Store the result in the array
        $departmentCounts[$department] = $totalEmployeeCount;

        // Close the statements
        $stmtEmployees->close();
        $stmtEmployeesJo->close();
    }
}

// Close the database connection
$conn->close();
