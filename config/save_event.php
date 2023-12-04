<?php
require '../config/dbcon.php'; 

$event_name = $_POST['event_name'];
$event_start_date = date("Y-m-d", strtotime($_POST['event_start_date'])); 
$event_end_date = date("Y-m-d", strtotime($_POST['event_end_date'])); 
			
$insert_query = "INSERT INTO `calendar_event_master` (`event_name`, `event_start_date`, `event_end_date`) VALUES ('$event_name', '$event_start_date', '$event_end_date')";             

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
