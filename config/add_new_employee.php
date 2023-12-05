<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve employee details from the POST request
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $office = $_POST['office'];
    $employment = $_POST['employment'];
    $start = $_POST['start'];
    $oldItem = $_POST['oldItem'];
    $newItem = $_POST['newItem'];
    $position = $_POST['position'];
    $sg = $_POST['sg'];
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
            birthday DATE NOT NULL,
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

    // Now, perform the database insertion using prepared statements
    $insertQuery = "INSERT INTO employees (name, birthday, oldItem, newItem, position, sg, sg1, amount, amount1, office, employment, start)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, 'ssssssssssss', $name, $birthday, $oldItem, $newItem, $position, $sg, $sg1, $amount, $amount1, $office, $employment, $start);

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

        // Insert data into the 'evaluation' table
        $insertEvaluationQuery = "INSERT INTO evaluation (itemNo, name, employment, office, semester, average)
        VALUES (?, ?, ?, ?, 'n/a', 'n/a')";
        $stmtEvaluation = mysqli_prepare($conn, $insertEvaluationQuery);
        mysqli_stmt_bind_param($stmtEvaluation, 'ssss', $newItem, $name, $employment, $office);
        mysqli_stmt_execute($stmtEvaluation);
        mysqli_stmt_close($stmtEvaluation);

        // Check and create the 'employee_files' table if it doesn't exist
        $checkFilesTableQuery = "SHOW TABLES LIKE 'employee_files'";
        $filesTableResult = mysqli_query($conn, $checkFilesTableQuery);

        if (!$filesTableResult) {
            echo 'Error checking employee_files table existence: ' . mysqli_error($conn);
            exit;
        }

        if (mysqli_num_rows($filesTableResult) == 0) {
            // The table doesn't exist, create it
            $createFilesTableQuery = "CREATE TABLE employee_files (
                ID INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                office VARCHAR(255) NOT NULL
            )";

            if (mysqli_query($conn, $createFilesTableQuery)) {
                echo 'Table "employee_files" created successfully.';
            } else {
                echo 'Error creating employee_files table: ' . mysqli_error($conn);
                exit;
            }
        }

        // Insert data into the 'employee_files' table
        $insertFilesQuery = "INSERT INTO employee_files (name, office) VALUES (?, ?)";
        $stmtFiles = mysqli_prepare($conn, $insertFilesQuery);
        mysqli_stmt_bind_param($stmtFiles, 'ss', $name, $office);
        mysqli_stmt_execute($stmtFiles);
        mysqli_stmt_close($stmtFiles);

        // Redirect to the employee.php page (or your desired destination)
        header('Location: ../pages/employee.php');
        exit();
    } else {
        // ... (your existing code to handle insertion error)
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connections
mysqli_close($conn);
