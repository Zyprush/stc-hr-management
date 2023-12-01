<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve employee details from the POST request
    $name = $_POST['name'];
    $office = $_POST['office'];
    $employment = $_POST['employment'];
    $start = $_POST['start'];
    $oldItem = $_POST['oldItem'];
    $newItem = $_POST['newItem'];
    $position = $_POST['position'];
    $sg = $_POST['sg']; // Make sure the input name matches the form
    $amount = $_POST['amount'];
    $sg1 = $_POST['sg1'];
    $amount1 = $_POST['amount1'];

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
            name VARCHAR(255) NOT NULL,
            oldItem VARCHAR(255) NOT NULL,
            newItem VARCHAR(255) NOT NULL,
            position VARCHAR(255) NOT NULL,
            sg VARCHAR(255) NOT NULL,
            sg1 VARCHAR(255) NOT NULL,
            amount VARCHAR(255) NOT NULL,
            amount1 VARCHAR(255) NOT NULL,
            office VARCHAR(255) NOT NULL,
            employment VARCHAR(255) NOT NULL,
            start DATE
        )";

        if (mysqli_query($conn, $createTableQuery)) {
            echo 'Table "employees" created successfully.';
        } else {
            echo 'Error creating table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Now, perform the database insertion
    $insertQuery = "INSERT INTO employees (name, oldItem, newItem, position, sg, sg1, amount, amount1, office, employment, start)
    VALUES ('$name', '$oldItem', '$newItem', '$position', '$sg', '$sg1', '$amount', '$amount1', '$office', '$employment', '$start')";


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