<?php
// Include your database connection code here
include 'dbcon.php';

// Fetch 'id' parameter from URL
$id = $_GET['id'] ?? null;

if ($id !== null) {
    // Fetch the 'Department' name corresponding to the provided 'id'
    $query = "SELECT Department FROM departments WHERE ID = $id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $departmentName = $row['Department'];

        // Fetch departments where 'Root' matches the identified department name
        $query = "SELECT * FROM departments WHERE Root = '$departmentName'";
        $result = $conn->query($query);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        // Create an array to store the department data
        $data = array();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Return the data as JSON
        echo json_encode($data);
    } else {
        echo "No department found for the given ID.";
    }
} else {
    echo "No ID parameter provided.";
}

// Close the database connection
$conn->close();
?>
