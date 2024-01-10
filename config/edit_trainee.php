<?php
// Include your database connection code here
include '../config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the trainee ID and new trainee details from the form
    $traineeId = $_POST['edit_trainee_id'];
    $newTraineeName = $_POST['edit_trainee_name'];
    $newTrainingType = $_POST['edit_training_type'];
    $newTrainingDate = $_POST['edit_training_date'];
    $newDuration = $_POST['edit_duration'];
    $newTraineePosition = $_POST['edit_trainee_position'];
    $newDescription = $_POST['edit_description'];

    // Prepare and execute the SQL UPDATE query using prepared statements
    $query = "UPDATE trainees SET trainee_name = ?, training_type = ?, training_date = ?, duration = ?, trainee_position = ?, description = ? WHERE ID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssssssi", $newTraineeName, $newTrainingType, $newTrainingDate, $newDuration, $newTraineePosition, $newDescription, $traineeId);
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows > 0) {
            // Trainee updated successfully
            session_start();
            $_SESSION['status'] = "Trainee updated successfully";
        } else {
            // Trainee update failed
            session_start();
            $_SESSION['status'] = "Trainee update failed";
        }

        $stmt->close();
    } else {
        // Error preparing SQL statement
        session_start();
        $_SESSION['status'] = "Error preparing SQL statement";
    }

    // Close the database connection
    $conn->close();
}

// Redirect to the trainee.php page or wherever you want to redirect
header('Location: ../pages/training.php');
exit();
?>
