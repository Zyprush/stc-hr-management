<?php
include 'dbcon.php'; // Include your database connection

// Check if 'id' parameter exists
if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'No ID parameter found']);
    exit;
}

$id = $_GET['id']; // Retrieve the 'id' parameter value

// Fetch 'Department' value from the 'departments' table based on the provided 'id'
$departmentQuery = "SELECT Department FROM departments WHERE ID = ?";
$departmentStmt = $conn->prepare($departmentQuery);

if (!$departmentStmt) {
    echo json_encode(['error' => 'Error preparing department query']);
    exit;
}

$departmentStmt->bind_param("i", $id);
$departmentStmt->execute();
$departmentResult = $departmentStmt->get_result();

if ($departmentResult->num_rows === 0) {
    echo json_encode(['error' => 'Department not found']);
    exit;
}

$departmentRow = $departmentResult->fetch_assoc();
$department = $departmentRow['Department'];

// Fetch specific employee data from the 'employees' table based on 'office' matching 'Department'
$query = "SELECT ID, name, newItem, office, employment, start, position FROM employees WHERE office = ?";

$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(['error' => 'Error preparing employee query']);
    exit;
}

$stmt->bind_param("s", $department);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['error' => 'No matching employee found']);
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
