<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve employee details from the POST request
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $extension = $_POST['extension'];
    $startDate = $_POST['startDate']; // Make sure the input name matches the form
    $type = $_POST['type'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $endDate = $_POST['endDate'];

    // Validate employee details here if needed

    // Check if the 'employees' table exists, and create it if not
    $checkTableQuery = "SHOW TABLES LIKE 'employees'";
    $tableResult = mysqli_query($conn, $checkTableQuery);

    if (!$tableResult) {
        echo 'Error checking table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($tableResult) == 0) {
        // The table doesn't exist, create it
        $createTableQuery = "CREATE TABLE employees (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            FirstName VARCHAR(255) NOT NULL,
            MiddleName VARCHAR(255) NOT NULL,
            LastName VARCHAR(255) NOT NULL,
            Extension VARCHAR(255),
            StartDate DATE,
            Type VARCHAR(255) NOT NULL,
            Department VARCHAR(255) NOT NULL,
            Position VARCHAR(255) NOT NULL,
            EndDate DATE
        )";

        if (mysqli_query($conn, $createTableQuery)) {
            echo 'Table "employees" created successfully.';
        } else {
            echo 'Error creating table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Now, perform the database insertion
    $insertQuery = "INSERT INTO employees (FirstName, MiddleName, LastName, Extension, StartDate, Type, Department, Position, EndDate)
                    VALUES ('$firstName', '$middleName', '$lastName', '$extension', '$startDate', '$type', '$department', '$position', '$endDate')";

    if (mysqli_query($conn, $insertQuery)) {
        // Set a session value to indicate success
        session_start();
        $_SESSION['message'] = 'Employee added successfully';

        // Redirect to the employee.php page (or your desired destination)
        header('Location: ../pages/employee.php');
        exit();
    } else {
        echo 'Error inserting data: ' . mysqli_error($conn);

        // Set a session value to indicate the error
        session_start();
        $_SESSION['message'] = 'Error adding employee';

        // Redirect to the employee.php page (or your desired destination)
        header('Location: ../pages/employee.php');
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
