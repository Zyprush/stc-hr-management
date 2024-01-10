<?php
include 'dbcon.php'; // Include your database connection

// Perform a select query to fetch data from the 'employees' table for employees with the latest 'very satisfactory' or 'excellent' rating
$query = "SELECT e.ID, e.name, e.office, e.position, ev.adjective_rating 
          FROM employees AS e
          LEFT JOIN (
              SELECT evaluatee_id, MAX(date) AS latest_date
              FROM evaluation_table
              GROUP BY evaluatee_id
          ) AS latest_eval ON e.ID = latest_eval.evaluatee_id
          LEFT JOIN evaluation_table AS ev ON ev.evaluatee_id = latest_eval.evaluatee_id AND ev.date = latest_eval.latest_date
          WHERE ev.adjective_rating IN ('Very Satisfactory', 'Outstanding')";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['error' => 'Error fetching data']);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
