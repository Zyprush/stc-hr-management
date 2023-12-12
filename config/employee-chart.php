<?php
// Include your database connection code here
include 'dbcon.php';

// Initialize an array to store department counts
$departmentCounts = [];

// Check if 'employees' table exists
$checkEmployeesTableQuery = "SHOW TABLES LIKE 'employees'";
$tableResultEmployees = mysqli_query($conn, $checkEmployeesTableQuery);
$employeesTableExists = mysqli_num_rows($tableResultEmployees) > 0;

// Check if 'employees_jo' table exists
$checkEmployeesJoTableQuery = "SHOW TABLES LIKE 'employees_jo'";
$tableResultEmployeesJo = mysqli_query($conn, $checkEmployeesJoTableQuery);
$employeesJoTableExists = mysqli_num_rows($tableResultEmployeesJo) > 0;

// Check if 'employees_elec' table exists
$checkEmployeesElecTableQuery = "SHOW TABLES LIKE 'employees_elec'";
$tableResultEmployeesElec = mysqli_query($conn, $checkEmployeesElecTableQuery);
$employeesElecTableExists = mysqli_num_rows($tableResultEmployeesElec) > 0;

// Retrieve department names from the 'departments' table
$sqlDepartments = "SELECT Department FROM departments";
$resultDepartments = $conn->query($sqlDepartments);

if ($resultDepartments->num_rows > 0) {
    while ($row = $resultDepartments->fetch_assoc()) {
        $department = $row['Department'];

        // Initialize counts to 0
        $employeeCountEmployees = 0;
        $employeeCountEmployeesJo = 0;
        $employeeCountEmployeesElec = 0;

        // Retrieve employee count for each department from the 'employees' table if it exists
        if ($employeesTableExists) {
            $sqlEmployees = "SELECT COUNT(*) AS employeeCount FROM employees WHERE office = ?";
            $stmtEmployees = $conn->prepare($sqlEmployees);
            $stmtEmployees->bind_param("s", $department);
            $stmtEmployees->execute();
            $resultEmployees = $stmtEmployees->get_result();
            $rowEmployees = $resultEmployees->fetch_assoc();
            $employeeCountEmployees = $rowEmployees['employeeCount'];
            $stmtEmployees->close();
        }

        // Retrieve employee count for each department from the 'employees_jo' table if it exists
        if ($employeesJoTableExists) {
            $sqlEmployeesJo = "SELECT COUNT(*) AS employeeCount FROM employees_jo WHERE office = ?";
            $stmtEmployeesJo = $conn->prepare($sqlEmployeesJo);
            $stmtEmployeesJo->bind_param("s", $department);
            $stmtEmployeesJo->execute();
            $resultEmployeesJo = $stmtEmployeesJo->get_result();
            $rowEmployeesJo = $resultEmployeesJo->fetch_assoc();
            $employeeCountEmployeesJo = $rowEmployeesJo['employeeCount'];
            $stmtEmployeesJo->close();
        }

        // Retrieve employee count for each department from the 'employees_elec' table if it exists
        if ($employeesElecTableExists) {
            $sqlEmployeesElec = "SELECT COUNT(*) AS employeeCount FROM employees_elec WHERE office = ?";
            $stmtEmployeesElec = $conn->prepare($sqlEmployeesElec);
            $stmtEmployeesElec->bind_param("s", $department);
            $stmtEmployeesElec->execute();
            $resultEmployeesElec = $stmtEmployeesElec->get_result();
            $rowEmployeesElec = $resultEmployeesElec->fetch_assoc();
            $employeeCountEmployeesElec = $rowEmployeesElec['employeeCount'];
            $stmtEmployeesElec->close();
        }

        // Total employee count for the department
        $totalEmployeeCount = $employeeCountEmployees + $employeeCountEmployeesJo + $employeeCountEmployeesElec;

        // Store the result in the array
        $departmentCounts[$department] = $totalEmployeeCount;
    }
}

// Close the database connection
$conn->close();
?>
