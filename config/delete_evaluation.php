<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Assuming 'id' is passed in the URL as a parameter
    $id = $_GET['id'];

    // Prepare and execute the query to delete the evaluation
    $deleteQuery = "DELETE FROM evaluation_table WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $id); // Assuming 'ID' is an integer
        mysqli_stmt_execute($stmt);

        // Check if the deletion was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Redirect back to the page displaying evaluations
            header('Location: ../pages/evaluation.php');
            exit();
        } else {
            echo 'Error deleting evaluation.';
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo 'Error preparing delete statement: ' . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
