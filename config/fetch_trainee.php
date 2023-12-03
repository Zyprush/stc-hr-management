<?php
// Include your database connection code here
include '../config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trainee_id'])) {
    $traineeId = $_POST['trainee_id'];

    // Prepare and execute an SQL SELECT query to fetch employee details
    $query = "SELECT ID, trainee_name, training_type, duration, description, trainee_position FROM trainees WHERE ID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $traineeId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $trainee = $result->fetch_assoc();

            // Return the trainee details as JSON
            echo json_encode($trainee);
        } else {
            echo 'trainee not found';
        }

        $stmt->close();
    } else {
        // Handle the case where the statement preparation fails
        echo 'Error preparing SQL statement: ' . mysqli_error($conn);
    }
} else {
    // Handle the case where no trainee ID is provided
    echo 'trainee ID not provided';
}

// Close the database connection
mysqli_close($conn);
