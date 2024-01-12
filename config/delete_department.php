<?php
include '../config/dbcon.php'; // Include your database connection code here

if (isset($_POST['record_id'])) {
    $recordId = $_POST['record_id'];

    // 1. Create a new table if it doesn't exist
    $createTableQuery = "CREATE TABLE IF NOT EXISTS deleted_department (
        ID INT PRIMARY KEY,
        Department VARCHAR(255),  -- Adjust the columns based on your 'departments' table
        -- Add other columns as needed
        deletion_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $createTableResult = mysqli_query($conn, $createTableQuery);

    if ($createTableResult) {
        // 2. Insert the record into the new table
        $insertQuery = "INSERT INTO deleted_department (ID, Department) SELECT ID, Department FROM departments WHERE ID = ?";
        $stmtInsert = mysqli_prepare($conn, $insertQuery);

        if ($stmtInsert) {
            mysqli_stmt_bind_param($stmtInsert, "i", $recordId);

            if (mysqli_stmt_execute($stmtInsert)) {
                // 3. Prepare a DELETE statement to delete the record from the original table
                $deleteQuery = "DELETE FROM departments WHERE ID = ?";
                $stmtDelete = mysqli_prepare($conn, $deleteQuery);

                if ($stmtDelete) {
                    mysqli_stmt_bind_param($stmtDelete, "i", $recordId);

                    if (mysqli_stmt_execute($stmtDelete)) {
                        echo 'Record deleted successfully';
                    } else {
                        echo 'Error deleting record: ' . mysqli_error($conn);
                    }

                    mysqli_stmt_close($stmtDelete);
                } else {
                    echo 'Error preparing delete statement: ' . mysqli_error($conn);
                }
            } else {
                echo 'Error saving record to deleted_department table: ' . mysqli_error($conn);
            }

            mysqli_stmt_close($stmtInsert);
        } else {
            echo 'Error preparing insert statement: ' . mysqli_error($conn);
        }
    } else {
        echo 'Error creating table: ' . mysqli_error($conn);
    }
} else {
    echo 'Record ID not provided';
}

// Close the database connection
mysqli_close($conn);
?>
