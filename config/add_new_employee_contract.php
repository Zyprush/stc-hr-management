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
    $rate = $_POST['rate'];
    $funding = $_POST['funding'];

    // Validate employee details here if needed

    // Check if the 'employee_contract' table exists, and create it if not
    $checkTableQuery = "SHOW TABLES LIKE 'employee_contract'";
    $tableResult = mysqli_query($conn, $checkTableQuery);

    if (!$tableResult) {
        echo 'Error checking table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($tableResult) == 0) {
        // The table doesn't exist, create it
        $createTableQuery = "CREATE TABLE employee_contract (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            end VARCHAR(255) NOT NULL,
            position VARCHAR(255) NOT NULL,
            office VARCHAR(255) NOT NULL,
            employment VARCHAR(255) NOT NULL,
            rate VARCHAR(255) NOT NULL,
            funding VARCHAR(255) NOT NULL,
            start DATE
        )";

        if (mysqli_query($conn, $createTableQuery)) {
            echo 'Table "employee_contract" created successfully.';
        } else {
            echo 'Error creating table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Now, perform the database insertion using prepared statements
    $insertQuery = "INSERT INTO employee_contract (name, end, position, office, employment, start, rate, funding)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $insertQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssssss', $name, $end, $position, $office, $employment, $start, $rate, $funding);

        if (mysqli_stmt_execute($stmt)) {
            // Set a session value to indicate success
            session_start();
            $_SESSION['message'] = 'Employee added successfully';

            // Redirect to the employee-jo.php page (or your desired destination)
            header('Location: ../pages/employee-contract.php');
            exit();
        } else {
            echo 'Error inserting data: ' . mysqli_stmt_error($stmt);
            // Rest of your error handling code...
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo 'Error creating prepared statement: ' . mysqli_error($conn);
        // Rest of your error handling code...
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);