<?php
include '../config/dbcon.php'; // Include your database connection code here

if (isset($_POST['record_id'])) {
    $recordId = $_POST['record_id'];

    // Delete associated records in the login_logs table
    $queryDeleteLogs = "DELETE FROM login_logs WHERE user_id = ?";
    $stmtDeleteLogs = mysqli_prepare($conn, $queryDeleteLogs);

    if ($stmtDeleteLogs) {
        mysqli_stmt_bind_param($stmtDeleteLogs, "i", $recordId);
        mysqli_stmt_execute($stmtDeleteLogs);
        mysqli_stmt_close($stmtDeleteLogs);
    } else {
        echo 'Error deleting associated login logs: ' . mysqli_error($conn);
    }

    // Prepare a DELETE statement to delete a record based on its ID
    $query = "DELETE FROM credentials WHERE id = ?"; // Replace 'your_table_name' with your actual table name
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $recordId); // Assuming 'ID' is an integer

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Deletion successful
            echo 'Record deleted successfully';
        } else {
            // Handle the case where the deletion fails
            echo 'Error deleting record: ' . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the case where the statement preparation fails
        echo 'Error preparing statement: ' . mysqli_error($conn);
    }
} else {
    // Handle the case where no record ID is provided
    echo 'Record ID not provided';
}

// Close the database connection
mysqli_close($conn);
