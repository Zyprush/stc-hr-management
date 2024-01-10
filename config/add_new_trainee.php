<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve employee details from the POST request
    $trainee_name = $_POST['trainee_name'];
    $training_type = $_POST['training_type'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];
    $training_date = $_POST['training_date']; // Added 'training_date' variable

    // Fetching position based on trainee name from employees table
    $getPositionQuery = "SELECT position FROM employees WHERE name = ?";
    $stmtPosition = mysqli_prepare($conn, $getPositionQuery);
    mysqli_stmt_bind_param($stmtPosition, 's', $trainee_name);
    mysqli_stmt_execute($stmtPosition);
    mysqli_stmt_bind_result($stmtPosition, $trainee_position);

    // Fetch the result
    mysqli_stmt_fetch($stmtPosition);
    mysqli_stmt_close($stmtPosition);

    // Check if the 'trainees' table exists, and create it if not
    $checkTableQuery = "SHOW TABLES LIKE 'trainees'";
    $tableResult = mysqli_query($conn, $checkTableQuery);

    if (!$tableResult) {
        echo 'Error checking table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($tableResult) == 0) {
        // The table doesn't exist, create it
        $createTableQuery = "CREATE TABLE trainees (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            trainee_name VARCHAR(255) NOT NULL,
            description VARCHAR(255) NOT NULL,
            training_type VARCHAR(255) NOT NULL,
            duration VARCHAR(255) NOT NULL,
            training_date DATE NOT NULL,  -- Change data type to DATE
            trainee_position VARCHAR(255) NOT NULL
        )";

        if (mysqli_query($conn, $createTableQuery)) {
            echo 'Table "trainees" created successfully.';
        } else {
            echo 'Error creating table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Now, perform the database insertion using prepared statements
    $insertQuery = "INSERT INTO trainees (trainee_name, description, training_type, duration, training_date, trainee_position)
    VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, 'ssssss', $trainee_name, $description, $training_type, $duration, $training_date, $trainee_position);

    if (mysqli_stmt_execute($stmt)) {
        // Set a session value to indicate success
        session_start();
        $_SESSION['message'] = 'Employee added successfully';

        // Redirect to the employee-jo.php page (or your desired destination)
        header('Location: ../pages/training.php');
        exit();
    } else {
        echo 'Error inserting data: ' . mysqli_stmt_error($stmt);

        // Set a session value to indicate the error
        session_start();
        $_SESSION['message'] = 'Error adding trainee';

        // Redirect to the employee-jo.php page (or your desired destination)
        header('Location: ../pages/training.php');
        exit();
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>
