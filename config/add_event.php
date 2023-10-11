<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the event name and time from the POST request
    $eventName = $_POST['eventName'];
    $eventTime = $_POST['eventTime'];

    // Validate input data if needed

    // Check if the 'events' table exists, and create it if not
    $checkTableQuery = "SHOW TABLES LIKE 'events'";
    $tableResult = mysqli_query($conn, $checkTableQuery);

    if (!$tableResult) {
        echo 'Error checking table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($tableResult) == 0) {
        // The table doesn't exist, create it
        $createTableQuery = "CREATE TABLE events (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            EventName VARCHAR(255) NOT NULL,
            EventTime TIME NOT NULL
        )";

        if (mysqli_query($conn, $createTableQuery)) {
            echo 'Table "events" created successfully. ';
        } else {
            echo 'Error creating table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Now, perform the database insertion
    $insertQuery = "INSERT INTO events (EventName, EventTime) VALUES ('$eventName', '$eventTime')";

    if (mysqli_query($conn, $insertQuery)) {
        // Set a session value to indicate success
        session_start();
        $_SESSION['message'] = 'Event added successfully';

        // Redirect to event.php or the appropriate page for events
        header('Location: ../pages/event.php');
        exit();
    } else {
        echo 'Error inserting data: ' . mysqli_error($conn);

        // Set a session value to indicate the error
        session_start();
        $_SESSION['message'] = 'Error adding event';

        // Redirect to event.php or the appropriate page for events
        header('Location: ../pages/event.php');
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
