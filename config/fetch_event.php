<?php
require '../config/dbcon.php';

// Get the current date
$currentDate = date("Y-m-d");

// Fetch events for today and tomorrow
$select_query = "SELECT * FROM `calendar_event_master` WHERE `event_start_date` IN ('$currentDate', DATE_ADD('$currentDate', INTERVAL 1 DAY))";
$result = $conn->query($select_query);

$events = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

echo json_encode($events);
$conn->close();
?>
