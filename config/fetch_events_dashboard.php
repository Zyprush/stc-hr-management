<?php
function convertTo12HourFormat($time)
{
    // Convert 24-hour time format (e.g., "13:30") to 12-hour time format (e.g., "01:30 PM")
    $time_in_12_hour_format = date("h:i A", strtotime($time));

    return $time_in_12_hour_format;
}

// Include your database connection code here
include '../config/dbcon.php';

// Fetch data from the 'events' table if it exists
$query = "SELECT EventName, EventTime FROM events"; // Replace 'events' with your actual table name

// Check if the table exists
$tableCheckQuery = "SHOW TABLES LIKE 'events'";
$tableCheckResult = $conn->query($tableCheckQuery);

if (!$tableCheckResult) {
    die("Error checking table existence: " . $conn->error);
}

if ($tableCheckResult->num_rows > 0) {
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Create an array to store the event data
    $events = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $eventName = $row['EventName'];
            $eventTime24Hour = $row['EventTime'];
            $eventTime12Hour = convertTo12HourFormat($eventTime24Hour);

            // Format the event data as "Event Name at Event Time"
            $eventInfo = $eventName . ' at ' . $eventTime12Hour;

            $events[] = $eventInfo;
        }
    } else {
        $events[] = "No Data"; // If there are no rows, return "No Data" in the response
    }
} else {
    $events[] = "No Data"; // If the table doesn't exist, return "No Data" in the response
}

// Close the database connection
$conn->close();

// Return the data as JSON
echo json_encode($events);
