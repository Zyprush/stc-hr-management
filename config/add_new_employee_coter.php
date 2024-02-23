<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve employee details from the POST request
    $name = $_POST['name'];
    $address = $_POST['address'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    // Validate employee details here if needed

    // Check if the 'employees_coter' table exists, and create it if not
    $checkTableQuery = "SHOW TABLES LIKE 'employees_coter'";
    $tableResult = mysqli_query($conn, $checkTableQuery);

    if (!$tableResult) {
        echo 'Error checking table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($tableResult) == 0) {
        // The table doesn't exist, create it
        $createTableQuery = "CREATE TABLE employees_coter (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            address VARCHAR(255) NOT NULL,
            start DATE,
            end DATE,
            position VARCHAR(255) NOT NULL,
            salary VARCHAR(255) NOT NULL
        )";

        if (mysqli_query($conn, $createTableQuery)) {
            echo 'Table "employees_coter" created successfully.';
        } else {
            echo 'Error creating table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Now, perform the database insertion using prepared statements
    $insertQuery = "INSERT INTO employees_coter (name, address, start, end, position, salary)
    VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, 'ssssss', $name, $address, $start, $end, $position, $salary);

    if (mysqli_stmt_execute($stmt)) {
        // Set a session value to indicate success
        session_start();
        $_SESSION['message'] = 'Employee added successfully';

        // Check and create the 'evaluation' table if it doesn't exist
        $checkEvaluationTableQuery = "SHOW TABLES LIKE 'evaluation'";
        $evaluationTableResult = mysqli_query($conn, $checkEvaluationTableQuery);

        if (!$evaluationTableResult) {
            echo 'Error checking evaluation table existence: ' . mysqli_error($conn);
            exit;
        }

        if (mysqli_num_rows($evaluationTableResult) == 0) {
            // The table doesn't exist, create it
            $createEvaluationTableQuery = "CREATE TABLE evaluation (
                ID INT AUTO_INCREMENT PRIMARY KEY,
                itemNo VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                employment VARCHAR(255) NOT NULL,
                office VARCHAR(255) NOT NULL,
                semester VARCHAR(255) NOT NULL,
                average VARCHAR(255) NOT NULL
            )";

            if (mysqli_query($conn, $createEvaluationTableQuery)) {
                echo 'Table "evaluation" created successfully.';
            } else {
                echo 'Error creating evaluation table: ' . mysqli_error($conn);
                exit;
            }
        }

        // Redirect to the employee.php page (or your desired destination)
        header('Location: ../pages/employee-coter.php');
        exit();
    } else {
        // ... (your existing code to handle insertion error)
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connections
mysqli_close($conn);
