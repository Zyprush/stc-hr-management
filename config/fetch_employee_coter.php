<?php
// Include your database connection code here
include '../config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employee_id'])) {
    $employeeId = $_POST['employee_id'];

    // Prepare and execute an SQL SELECT query to fetch employee details
    $query = "SELECT ID, name, office, employment, start, position, sg, oldItem, newItem, amount, sg1, amount1 FROM employees_coter WHERE ID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $employeeId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $employee = $result->fetch_assoc();

            // Return the employee details as JSON
            echo json_encode($employee);
        } else {
            echo 'Employee not found';
        }

        $stmt->close();
    } else {
        // Handle the case where the statement preparation fails
        echo 'Error preparing SQL statement: ' . mysqli_error($conn);
    }
} else {
    // Handle the case where no employee ID is provided
    echo 'Employee ID not provided';
}

// Close the database connection
mysqli_close($conn);
