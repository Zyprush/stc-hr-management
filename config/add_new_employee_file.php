<?php
include 'dbcon.php'; // Include your database connection file

function createFilesTable($conn) {
    // SQL query to create the 'files' table if it doesn't exist
    $createTableQuery = "CREATE TABLE IF NOT EXISTS files (
        file_id INT AUTO_INCREMENT PRIMARY KEY,
        employee_files_id INT NOT NULL,
        upload_date DATE DEFAULT CURRENT_DATE,
        file_name VARCHAR(255) NOT NULL,
        file_directory VARCHAR(255) NOT NULL
    )";

    if (mysqli_query($conn, $createTableQuery)) {
        echo 'Table "files" created successfully.<br>';
    } else {
        echo 'Error creating table: ' . mysqli_error($conn) . '<br>';
    }
}

// Create 'files' table if it doesn't exist
createFilesTable($conn);

// Handle file upload and database insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_FILES['file'])) {
        $employee_files_id = $_POST['id'];
        $upload_date = date('Y-m-d'); // Current date and time
        $file_name = $_FILES['file']['name'];
        $file_directory = '201_files/' . $employee_files_id . '/'; // Directory path for storing files

        // Create the directory if it doesn't exist
        if (!file_exists($file_directory)) {
            if (!mkdir($file_directory, 0777, true)) {
                die('Failed to create directory.'); // Stop execution if directory creation fails
            }
        }

        // Move uploaded file to the designated directory
        $target_file = $file_directory . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            // Insert file details into the 'files' table
            $insertFileQuery = "INSERT INTO files (employee_files_id, upload_date, file_name, file_directory)
                                VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertFileQuery);

            // Check if the statement was prepared successfully
            if ($stmt) {
                // Bind parameters to the prepared statement
                mysqli_stmt_bind_param($stmt, 'isss', $employee_files_id, $upload_date, $file_name, $file_directory);

                // Execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    echo 'File uploaded and record inserted successfully.<br>';
                } else {
                    echo 'Error inserting file record: ' . mysqli_error($conn) . '<br>';
                }

                // Close the statement
                mysqli_stmt_close($stmt);

                header('location: ../pages/employee-files.php?id=' . $employee_files_id);
            } else {
                echo 'Error preparing statement: ' . mysqli_error($conn) . '<br>';
            }
        } else {
            echo 'Error uploading file.<br>';
        }
    } else {
        echo 'ID or file not found. POST variables: ' . print_r($_POST, true) . ', FILES: ' . print_r($_FILES, true);
    }
}

mysqli_close($conn);
?>
