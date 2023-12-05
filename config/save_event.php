<?php
require '../config/dbcon.php'; 

$event_name = $_POST['event_name'];
$event_start_date = date("Y-m-d", strtotime($_POST['event_start_date'])); 
$event_end_date = date("Y-m-d", strtotime($_POST['event_end_date'])); 

// Process event time to convert 24-hour format to 12-hour format with AM/PM
$event_time = date("h:i A", strtotime($_POST['event_time'])); 

$insert_query = "INSERT INTO `calendar_event_master` (`event_name`, `event_start_date`, `event_end_date`, `event_time`) VALUES ('$event_name', '$event_start_date', '$event_end_date', '$event_time')";             

if ($conn->query($insert_query) === TRUE) {
    $data = array(
        'status' => true,
        'msg' => 'Event added successfully!'
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Sorry, Event not added.'
    );
}

echo json_encode($data);   
?>
