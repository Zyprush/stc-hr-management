<?php
include 'dbcon.php'; // Include your database connection

// Perform a select query to fetch data from the 'login_logs' table with JOIN on 'credentials'
$query = "SELECT login_logs.*, credentials.name, credentials.email 
          FROM login_logs 
          LEFT JOIN credentials ON login_logs.user_id = credentials.id
          ORDER BY login_time DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['error' => 'Error fetching data']);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'id' => $row['id'],
        'user_id' => $row['user_id'],
        'login_time' => $row['login_time'],
        'logout_time' => $row['logout_time'],
        'name' => $row['name'],
        'email' => $row['email']
    ];
}

mysqli_close($conn);

echo json_encode($data);
?>
