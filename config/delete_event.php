<?php
include '../config/dbcon.php'; // Include your database connection code here

if (isset($_POST['record_id'])) {
    $recordId = $_POST['record_id'];

    // Prepare a DELETE statement to delete a record based on its ID
    $query = "DELETE FROM events WHERE ID = ?"; // Use the 'events' table
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $recordId); // Assuming 'ID' is an integer

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Deletion successful
            echo 'Event deleted successfully';
        } else {
            // Handle the case where the deletion fails
            echo 'Error deleting event: ' . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the case where the statement preparation fails
        echo 'Error preparing statement: ' . mysqli_error($conn);
    }
} else {
    // Handle the case where no record ID is provided
    echo 'Event ID not provided';
}

// Close the database connection
mysqli_close($conn);
