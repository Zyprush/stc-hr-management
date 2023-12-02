<?php
session_start();
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the department name from the POST request
    $departmentName = $_POST['departmentName'];

    // Validate $departmentName if needed

    // Check if the 'departments' table exists, and create it if not
    $checkTableQuery = "SHOW TABLES LIKE 'departments'";
    $tableResult = mysqli_query($conn, $checkTableQuery);

    if (!$tableResult) {
        echo 'Error checking table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($tableResult) == 0) {
        // The table doesn't exist, create it
        $createTableQuery = "CREATE TABLE departments (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            Department VARCHAR(255) NOT NULL
        )";

        if (mysqli_query($conn, $createTableQuery)) {
            echo 'Table "departments" created successfully. ';
        } else {
            echo 'Error creating table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Now, perform the database insertion with prepared statement
    $insertQuery = "INSERT INTO departments (Department) VALUES (?)";

    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, "s", $departmentName);

    if (mysqli_stmt_execute($stmt)) {
        // Set a session value to indicate success
        $_SESSION['message'] = 'Department added successfully';

        // Redirect to department.php
        header('Location: ../pages/department.php');
        exit();
    } else {
        echo 'Error inserting data: ' . mysqli_error($conn);

        // Set a session value to indicate the error
        $_SESSION['message'] = 'Error adding department';

        // Redirect to department.php
        header('Location: ../pages/department.php');
        exit();
    }

    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
