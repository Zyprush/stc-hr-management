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
    $newOldItem = $_POST['edit_old_item']; // Added line for the 'edit_old_item' field
    $newNewItem = $_POST['edit_new_item']; // Added line for the 'edit_new_item' field
    $newPosition = $_POST['edit_position'];
    $newSg = $_POST['edit_sg'];
    $newAmount = $_POST['edit_amount']; // Added line for the 'edit_amount' field
    $newSg1 = $_POST['edit_sg1']; // Added line for the 'edit_budget_sg' field
    $newAmount1 = $_POST['edit_amount1']; // Added line for the 'edit_budget_amount' field

    // Prepare and execute the SQL UPDATE query using prepared statements
    $query = "UPDATE employees SET name = ?, office = ?, employment = ?, start = STR_TO_DATE(?, '%Y-%m-%d'), oldItem = ?, newItem = ?, position = ?, sg = ?, amount = ?, sg1 = ?, amount1 = ? WHERE ID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("sssssssssssi", $newName, $newOffice, $newEmployment, $newStartDate, $newOldItem, $newNewItem, $newPosition, $newSg, $newAmount, $newSg1, $newAmount1, $employeeId);
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
