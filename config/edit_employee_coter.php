<?php
// Include your database connection code here
include '../config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the employee ID and new employee details from the form
    $employeeId = $_POST['edit_employee_id'];
    $newName = $_POST['edit_name'];
    $newAddress = $_POST['edit_address'];
    $newStartDate = $_POST['edit_start_date'];
    $newEndDate = $_POST['edit_end_date'];
    $newPosition = $_POST['edit_position'];
    $newSalary = $_POST['edit_salary']; // Added line for the 'edit_budget_amount' field

    // Prepare and execute the SQL UPDATE query using prepared statements
    $query = "UPDATE employees_coter SET name = ?, address = ?, start = STR_TO_DATE(?, '%Y-%m-%d'), end = STR_TO_DATE(?, '%Y-%m-%d'),position = ?, salary = ? WHERE ID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssssssi", $newName, $newAddress, $newStartDate, $newEndDate, $newPosition, $newSalary, $employeeId);
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows > 0) {
            // Employee updated successfully
            session_start();
            $_SESSION['status'] = "Employee updated successfully";
        } else {
            // Employee update failed
            session_start();
            $_SESSION['status'] = "Employee update failed";
        }

        $stmt->close();
    } else {
        // Error preparing SQL statement
        session_start();
        $_SESSION['status'] = "Error preparing SQL statement";
    }

    // Close the database connection
    $conn->close();
}

// Redirect to the employee.php page or wherever you want to redirect
header('Location: ../pages/employee-coter.php');
exit();
