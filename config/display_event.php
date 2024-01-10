<?php
require '../config/dbcon.php';

$display_query = "SELECT event_id, event_name, event_start_date, event_end_date, event_time FROM calendar_event_master";
$results = $conn->query($display_query);

$static_colors = array(
    '#3498db', '#e74c3c', '#2ecc71', '#f39c12', '#9b59b6',
    '#16a085', '#d35400', '#27ae60', '#c0392b', '#8e44ad'
);

$color_index = 0;

if ($results->num_rows > 0) {
    $data_arr = array();
    $i = 1;
    while ($data_row = $results->fetch_assoc()) {
        $data_arr[$i]['event_id'] = $data_row['event_id'];
        $data_arr[$i]['title'] = $data_row['event_name'];
        $data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['event_start_date']));
        $data_arr[$i]['end'] = date("Y-m-d", strtotime($data_row['event_end_date']));
        $data_arr[$i]['color'] = $static_colors[$color_index];
        $data_arr[$i]['time'] = $data_row['event_time'];

        $color_index = ($color_index + 1) % count($static_colors); // Loop through colors

        $i++;
    }

    $data = array(
        'status' => true,
        'msg' => 'successfully!',
        'data' => $data_arr
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Error!'
    );
}

echo json_encode($data);
?>
