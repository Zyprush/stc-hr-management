<?php
// Include your database connection file
include '../config/dbcon.php'; // Replace with the correct path to your connection file

// Check if event_id is provided via POST request
if(isset($_POST['event_id'])) {
    // Sanitize the input to prevent SQL injection
    $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);

    // Query to delete the event from the calendar_event_master table
    $deleteQuery = "DELETE FROM calendar_event_master WHERE event_id = '$event_id'";

    if(mysqli_query($conn, $deleteQuery)) {
        // Deletion successful
        $response = array(
            'status' => true,
            'message' => 'Event deleted successfully'
        );
        echo json_encode($response);
    } else {
        // Deletion failed
        $response = array(
            'status' => false,
            'message' => 'Failed to delete event'
        );
        echo json_encode($response);
    }
} else {
    // If event_id is not provided
    $response = array(
        'status' => false,
        'message' => 'Event ID not provided'
    );
    echo json_encode($response);
}

// Close the database connection
mysqli_close($conn);
?>
