<?php
include '../config/dbcon.php'; // Include your database connection code here

if (isset($_POST['record_id'])) {
    $recordId = $_POST['record_id'];

    // Start a transaction to ensure atomicity (all or nothing)
    mysqli_autocommit($conn, false);

    // Prepare a DELETE statement to delete employee evaluations
    $evalQuery = "DELETE FROM evaluation WHERE ID = ?";
    $evalStmt = mysqli_prepare($conn, $evalQuery);

    // Prepare a DELETE statement to delete employee files
    $filesQuery = "DELETE FROM employee_files WHERE ID = ?";
    $filesStmt = mysqli_prepare($conn, $filesQuery);

    // Prepare a DELETE statement to delete an employee
    $employeeQuery = "DELETE FROM employees_elec WHERE ID = ?";
    $employeeStmt = mysqli_prepare($conn, $employeeQuery);

    if ($evalStmt && $filesStmt && $employeeStmt) {
        // Bind the parameter for all statements
        mysqli_stmt_bind_param($evalStmt, "i", $recordId);
        mysqli_stmt_bind_param($filesStmt, "i", $recordId);
        mysqli_stmt_bind_param($employeeStmt, "i", $recordId);

        // Execute the statements
        $evalSuccess = mysqli_stmt_execute($evalStmt);
        $filesSuccess = mysqli_stmt_execute($filesStmt);
        $employeeSuccess = mysqli_stmt_execute($employeeStmt);

        if ($evalSuccess && $filesSuccess && $employeeSuccess) {
            // Commit the transaction if all deletions are successful
            mysqli_commit($conn);
            echo 'Record and related data deleted successfully';
        } else {
            // Rollback the transaction if any deletion fails
            mysqli_rollback($conn);
            echo 'Error deleting record or related data: ' . mysqli_error($conn);
        }

        // Close all statements
        mysqli_stmt_close($evalStmt);
        mysqli_stmt_close($filesStmt);
        mysqli_stmt_close($employeeStmt);
    } else {
        // Handle the case where statement preparation fails
        echo 'Error preparing statement: ' . mysqli_error($conn);
    }

    // Restore autocommit mode
    mysqli_autocommit($conn, true);
} else {
    // Handle the case where no record ID is provided
    echo 'Record ID not provided';
}

// Close the database connection
mysqli_close($conn);
?>
