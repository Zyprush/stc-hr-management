<?php
include '../config/dbcon.php'; // Include your database connection code here

if (isset($_POST['record_id'])) {
    $recordId = $_POST['record_id'];

    // Retrieve file directory and name based on the record ID before deletion
    $getFileQuery = "SELECT file_directory, file_name FROM files WHERE file_id = ?";
    $stmt = mysqli_prepare($conn, $getFileQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $recordId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $fileDirectory, $fileName);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // Prepare a DELETE statement to delete a record based on its ID
        $deleteQuery = "DELETE FROM files WHERE file_id = ?";
        $stmtDelete = mysqli_prepare($conn, $deleteQuery);

        if ($stmtDelete) {
            mysqli_stmt_bind_param($stmtDelete, "i", $recordId);

            if (mysqli_stmt_execute($stmtDelete)) {
                // Deletion successful
                echo 'Record deleted successfully! ';

                // Delete the file from the directory
                $filePath = $fileDirectory . $fileName;
                //echo($filePath);
                if (file_exists($filePath)) {
                    if (unlink($filePath)) {
                        echo 'File deleted successfully!';
                    } else {
                        echo 'Error deleting file';
                    }
                } else {
                    echo 'File not found';
                }
            } else {
                // Handle the case where the deletion fails
                echo 'Error deleting record: ' . mysqli_error($conn);
            }

            mysqli_stmt_close($stmtDelete);
        } else {
            // Handle the case where the statement preparation fails
            echo 'Error preparing delete statement: ' . mysqli_error($conn);
        }
    } else {
        // Handle the case where the file details retrieval fails
        echo 'Error fetching file details: ' . mysqli_error($conn);
    }
} else {
    // Handle the case where no record ID is provided
    echo 'Record ID not provided';
}

// Close the database connection
mysqli_close($conn);
?>
