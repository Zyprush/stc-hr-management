<?php
session_start();
include 'dbcon.php';

// Fetch department data from the 'departments' table where Root is 'None'
$query = "SELECT * FROM departments WHERE Root = 'None'";
$result = mysqli_query($conn, $query);

$departments = array();
while ($row = mysqli_fetch_assoc($result)) {
    $departments[] = $row;
}

// Return department data as JSON
echo json_encode($departments);

mysqli_close($conn);
?>
