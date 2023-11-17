    <?php
    // Include your database connection code here
    include '../config/dbcon.php';

    // Check if the 'departments' table exists
    $checkTableQuery = "SHOW TABLES LIKE 'departments'";
    $tableResult = mysqli_query($conn, $checkTableQuery);

    if (!$tableResult) {
        die("Error checking table existence: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($tableResult) === 0) {
        // The table doesn't exist
        die("No department table exists");
    }

    // Fetch data from the 'departments' table
    $query = "SELECT Department FROM departments"; // Replace 'departments' with your actual table name
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows === 0) {
        // No data in the table
        die("No department data available");
    }

    $conn->close();
