<?php
// Include your database connection code here
include '../config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the employee ID and new employee details from the form
    $employeeId = $_POST['edit_employee_id'];
    $newFirstName = $_POST['edit_first_name'];
    $newMiddleName = $_POST['edit_middle_name'];
    $newLastName = $_POST['edit_last_name'];
    $newExtension = $_POST['edit_extension'];
    $newStartDate = $_POST['edit_start_date'];
    $newEmployeeType = $_POST['edit_employee_type'];
    $newEmployeeDepartment = $_POST['edit_employee_department'];
    $newEmployeePosition = $_POST['edit_employee_position'];
    $newEndDate = $_POST['edit_end_date'];

    // Prepare and execute the SQL UPDATE query
    $query = "UPDATE employees SET FirstName = ?, MiddleName = ?, LastName = ?, Extension = ?, StartDate = ?, Type = ?, Department = ?, Position = ?, EndDate = ? WHERE ID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("sssssssssi", $newFirstName, $newMiddleName, $newLastName, $newExtension, $newStartDate, $newEmployeeType, $newEmployeeDepartment, $newEmployeePosition, $newEndDate, $employeeId);
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
header('Location: ../pages/employee.php');
exit();
