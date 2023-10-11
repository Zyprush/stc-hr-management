<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the department name from the POST request
    $departmentName = $_POST['departmentName'];

    // Validate departmentName here if needed

    // Check if the 'departments' table exists, and create it if not
    $checkTableQuery = "SHOW TABLES LIKE 'departments'";
    $tableResult = mysqli_query($conn, $checkTableQuery); // Use $conn here

    if (!$tableResult) {
        echo 'Error checking table existence: ' . mysqli_error($conn); // Use $conn here
        exit;
    }

    if (mysqli_num_rows($tableResult) == 0) {
        // The table doesn't exist, create it
        $createTableQuery = "CREATE TABLE departments (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            Department VARCHAR(255) NOT NULL
        )";

        if (mysqli_query($conn, $createTableQuery)) { // Use $conn here
            echo 'Table "departments" created successfully. ';
        } else {
            echo 'Error creating table: ' . mysqli_error($conn); // Use $conn here
            exit;
        }
    }

    // Now, perform the database insertion
    $insertQuery = "INSERT INTO departments (Department) VALUES ('$departmentName')";

    if (mysqli_query($conn, $insertQuery)) { // Use $conn here
        // Set a session value to indicate success
        session_start();
        $_SESSION['message'] = 'Department added successfully';

        // Redirect to department.php
        header('Location: ../pages/department.php');
        exit();
    } else {
        echo 'Error inserting data: ' . mysqli_error($conn); // Use $conn here

        // Set a session value to indicate the error
        session_start();
        $_SESSION['message'] = 'Error adding department';

        // Redirect to department.php
        header('Location: ../pages/department.php');
        exit();
    }
}

// Close the database connection
mysqli_close($conn); // Use $conn here
