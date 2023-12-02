<?php
// Include your database connection code here
include '../config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the employee ID and new employee details from the form
    $employeeId = $_POST['edit_employee_id'];
    $newName = $_POST['edit_name'];
    $newOffice = $_POST['edit_office'];
    $newEmployment = $_POST['edit_employment'];
    $newStartDate = $_POST['edit_start_date'];
    $newEndDate = $_POST['edit_end_date']; // Added line for the 'end' field
    $newPosition = $_POST['edit_position'];

    // Prepare and execute the SQL UPDATE query
    $query = "UPDATE employees_jo SET name = ?, office = ?, employment = ?, start = STR_TO_DATE(?, '%Y-%m-%d'), end = STR_TO_DATE(?, '%Y-%m-%d'), position = ? WHERE ID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssssssi", $newName, $newOffice, $newEmployment, $newStartDate, $newEndDate, $newPosition, $employeeId);
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
header('Location: ../pages/employee-jo.php');
exit();
