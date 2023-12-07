<?php
// Include your database connection code here
include '../config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Prepare and execute an SQL SELECT query to fetch user details
    $query = "SELECT id, name,department, designation, email, role FROM credentials WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Return the user details as JSON
            echo json_encode($user);
        } else {
            echo 'user not found';
        }

        $stmt->close();
    } else {
        // Handle the case where the statement preparation fails
        echo 'Error preparing SQL statement: ' . mysqli_error($conn);
    }
} else {
    // Handle the case where no user ID is provided
    echo 'user ID not provided';
}

// Close the database connection
mysqli_close($conn);
