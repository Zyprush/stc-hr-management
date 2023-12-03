<?php
include 'dbcon.php'; // Include your database connection

// Check if 'id' parameter exists
if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'No ID parameter found']);
    exit;
}

$id = $_GET['id']; // Retrieve the 'id' parameter value

// Fetch data from the 'files' table based on 'employee_files_id'
$query = "SELECT file_id, file_name, upload_date, file_directory FROM files WHERE employee_files_id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(['error' => 'Error preparing file query']);
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['error' => 'No matching files found']);
    exit;
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$stmt->close();
mysqli_close($conn);

echo json_encode($data);
?>
