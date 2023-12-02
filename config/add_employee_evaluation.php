<?php
include 'dbcon.php';

// Function to create the table if it doesn't exist
function createTableIfNeeded($conn)
{
    $checkTableQuery = "SHOW TABLES LIKE 'evaluation_table'";
    $tableResult = mysqli_query($conn, $checkTableQuery);

    if (!$tableResult) {
        echo 'Error checking table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($tableResult) == 0) {
        // The table doesn't exist, create it
        $createTableQuery = "CREATE TABLE evaluation_table (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            evaluatee_id VARCHAR(255) NOT NULL,
            semester VARCHAR(255) NOT NULL,
            date DATE NOT NULL,
            strategic_mfo VARCHAR(255) NOT NULL,
            strategic_rating VARCHAR(255) NOT NULL,
            core_function_mfo VARCHAR(255) NOT NULL,
            core_function_rating VARCHAR(255) NOT NULL,
            support_function_mfo VARCHAR(255) NOT NULL,
            support_function_rating VARCHAR(255) NOT NULL,
            total_overall_rating VARCHAR(255) NOT NULL,
            final_average_rating VARCHAR(255) NOT NULL,
            adjective_rating VARCHAR(255) NOT NULL,
            supporting_document VARCHAR(255) NOT NULL
        )";

        if (!mysqli_query($conn, $createTableQuery)) {
            echo 'Error creating table: ' . mysqli_error($conn);
            exit;
        }
        echo 'Table "evaluation_table" created successfully.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create the table if it doesn't exist
    createTableIfNeeded($conn);

    // Retrieve form data
    $evaluatee_id = $_POST['evaluatee_id'];
    $semester = $_POST['semester'];
    $date = $_POST['date'];
    $strategic_mfo = $_POST['strategic_mfo'];
    $strategic_rating = $_POST['strategic_rating'];
    $core_function_mfo = $_POST['core_function_mfo'];
    $core_function_rating = $_POST['core_function_rating'];
    $support_function_mfo = $_POST['support_function_mfo'];
    $support_function_rating = $_POST['support_function_rating'];
    $total_overall_rating = $_POST['total_overall_rating'];
    $final_average_rating = $_POST['final_average_rating'];
    $adjective_rating = $_POST['adjective_rating'];
    // ... (retrieve other form fields)

    // File upload handling
    $uploadDir = '../evaluation_files/';

    // Create the directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $supportingDocument = $_FILES['supportingDocument'];

    $uploadedFileName = $uploadDir . basename($supportingDocument['name']);

    if (move_uploaded_file($supportingDocument['tmp_name'], $uploadedFileName)) {
        echo 'File uploaded successfully.';
    } else {
        echo 'Error uploading file.';
        exit;
    }

    $insertQuery = "INSERT INTO evaluation_table (evaluatee_id, semester, date, strategic_mfo, strategic_rating, core_function_mfo, core_function_rating, support_function_mfo, support_function_rating, total_overall_rating, final_average_rating, adjective_rating, supporting_document)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $insertQuery);

    if (!$stmt) {
        echo 'Error preparing statement: ' . mysqli_error($conn);
        exit;
    }

    mysqli_stmt_bind_param(
        $stmt,
        'sssssssssssss',  // Adjust the data types based on your actual data
        $evaluatee_id,
        $semester,
        $date,
        $strategic_mfo,
        $strategic_rating,
        $core_function_mfo,
        $core_function_rating,
        $support_function_mfo,
        $support_function_rating,
        $total_overall_rating,
        $final_average_rating,
        $adjective_rating,
        $uploadedFileName
    );

    // Print or echo values for debugging
    echo "evaluatee_id: $evaluatee_id, semester: $semester, date: $date, ...";

    // Perform database insertion using prepared statements
    if (mysqli_stmt_execute($stmt)) {
        // Set a session value to indicate success
        session_start();
        $_SESSION['message'] = 'Evaluation added successfully';

        // Redirect to the desired destination
        header('Location: ../pages/evaluation-child.php?id=' . $evaluatee_id);
        exit();
    } else {
        echo 'Error inserting data: ' . mysqli_error($conn);

        // Set a session value to indicate the error
        session_start();
        $_SESSION['message'] = 'Error adding evaluation';

        // Redirect to the desired destination
        header('Location: ../pages/evaluation-child.php?id=' . $evaluatee_id);
        exit;
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
