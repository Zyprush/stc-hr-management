<?php
// Include your database connection code here
include '../config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the department ID and new department name from the form
    $departmentId = $_POST['edit_department_id'];
    $newDepartmentName = $_POST['edit_department_name'];

    // Prepare and execute the SQL UPDATE query
    $query = "UPDATE departments SET Department = ? WHERE ID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("si", $newDepartmentName, $departmentId);
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows > 0) {
            // Department updated successfully
            session_start();
            $_SESSION['status'] = "Department updated successfully";
        } else {
            // Department update failed
            session_start();
            $_SESSION['status'] = "Department update failed";
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

// Redirect to the department.php page
header('Location: ../pages/department.php');
exit();
