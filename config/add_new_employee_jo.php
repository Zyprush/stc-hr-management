<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve employee details from the POST request
    $name = $_POST['name'];
    $office = $_POST['office'];
    $employment = $_POST['employment'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $position = $_POST['position'];

    // Validate employee details here if needed

    // Check if the 'employees_jo' table exists, and create it if not
    $checkTableQuery = "SHOW TABLES LIKE 'employees_jo'";
    $tableResult = mysqli_query($conn, $checkTableQuery);

    if (!$tableResult) {
        echo 'Error checking table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($tableResult) == 0) {
        // The table doesn't exist, create it
        $createTableQuery = "CREATE TABLE employees_jo (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            end VARCHAR(255) NOT NULL,
            position VARCHAR(255) NOT NULL,
            office VARCHAR(255) NOT NULL,
            employment VARCHAR(255) NOT NULL,
            start DATE
        )";

        if (mysqli_query($conn, $createTableQuery)) {
            echo 'Table "employees_jo" created successfully.';
        } else {
            echo 'Error creating table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Now, perform the database insertion using prepared statements
    $insertQuery = "INSERT INTO employees_jo (name, end, position, office, employment, start)
    VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, 'ssssss', $name, $end, $position, $office, $employment, $start);

    if (mysqli_stmt_execute($stmt)) {
        // Set a session value to indicate success
        session_start();
        $_SESSION['message'] = 'Employee added successfully';

        // Redirect to the employee-jo.php page (or your desired destination)
        header('Location: ../pages/employee-jo.php');
        exit();
    } else {
        echo 'Error inserting data: ' . mysqli_stmt_error($stmt);

        // Set a session value to indicate the error
        session_start();
        $_SESSION['message'] = 'Error adding employee-jo';

        // Redirect to the employee-jo.php page (or your desired destination)
        header('Location: ../pages/employee-jo.php');
        exit();
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
