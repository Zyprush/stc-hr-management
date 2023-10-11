<?php
// Include your database connection code here
include '../config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the event ID, new event name, and new event time from the form
    $eventId = $_POST['edit_event_id'];
    $newEventName = $_POST['edit_event_name'];
    $newEventTime = $_POST['edit_event_time'];

    // Prepare and execute the SQL UPDATE query
    $query = "UPDATE events SET EventName = ?, EventTime = ? WHERE ID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssi", $newEventName, $newEventTime, $eventId);
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows > 0) {
            // Event updated successfully
            session_start();
            $_SESSION['status'] = "Event updated successfully";
        } else {
            // Event update failed
            session_start();
            $_SESSION['status'] = "Event update failed";
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

// Redirect to the event.php page (or the page where you list events)
header('Location: ../pages/event.php');
exit();
