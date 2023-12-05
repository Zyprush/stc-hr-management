<?php
include 'dbcon.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $evaluationID = $_POST['id'];
    $semester = $_POST['semester'];
    $date = $_POST['date'];
    $strategic_mfo = $_POST['strategic_mfo'];
    $strategic_rating = $_POST['strategic_rating'];
    $core_function_mfo = $_POST['core_function_mfo'];
    $core_function_rating = $_POST['core_function_rating'];
    $support_function_mfo = $_POST['support_function_mfo'];
    $support_function_rating = $_POST['support_function_rating'];
    $total_overall_rating = $_POST['total_overall_rating'];
    $final_average_rating = $_POST['final_average_rating'];
    $adjective_rating = $_POST['adjective_rating'];

    // Check if a new file has been uploaded
    if ($_FILES['supporting_document']['size'] > 0) {
        // Handle file upload
        $uploadDir = '../evaluation_files/';
        $uploadedFileName = $uploadDir . basename($_FILES['supporting_document']['name']);

        if (move_uploaded_file($_FILES['supporting_document']['tmp_name'], $uploadedFileName)) {
            // Update the database with the new file path
            $updateQuery = "UPDATE evaluation_table SET semester=?, date=?, strategic_mfo=?, strategic_rating=?, core_function_mfo=?, core_function_rating=?, support_function_mfo=?, support_function_rating=?, total_overall_rating=?, final_average_rating=?, adjective_rating=?, supporting_document=? WHERE ID=?";
            $stmt = mysqli_prepare($conn, $updateQuery);

            if ($stmt) {
                mysqli_stmt_bind_param(
                    $stmt,
                    'ssssssssssssi',
                    $semester,
                    $date,
                    $strategic_mfo,
                    $strategic_rating,
                    $core_function_mfo,
                    $core_function_rating,
                    $support_function_mfo,
                    $support_function_rating,
                    $total_overall_rating,
                    $final_average_rating,
                    $adjective_rating,
                    $uploadedFileName,
                    $evaluationID
                );

                if (mysqli_stmt_execute($stmt)) {
                    // Update successful
                    echo "Evaluation updated successfully.";
                } else {
                    echo "Error updating evaluation: " . mysqli_error($conn);
                }
            } else {
                echo "Error preparing update statement: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error uploading file.";
        }
    } else {
        // No new file uploaded, update other fields excluding 'supporting_document'
        $updateQuery = "UPDATE evaluation_table SET semester=?, date=?, strategic_mfo=?, strategic_rating=?, core_function_mfo=?, core_function_rating=?, support_function_mfo=?, support_function_rating=?, total_overall_rating=?, final_average_rating=?, adjective_rating=? WHERE ID=?";
        $stmt = mysqli_prepare($conn, $updateQuery);

        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                'sssssssssssi',
                $semester,
                $date,
                $strategic_mfo,
                $strategic_rating,
                $core_function_mfo,
                $core_function_rating,
                $support_function_mfo,
                $support_function_rating,
                $total_overall_rating,
                $final_average_rating,
                $adjective_rating,
                $evaluationID
            );

            if (mysqli_stmt_execute($stmt)) {
                // Update successful
                echo "Evaluation updated successfully (without changing supporting_document).";
                // header('Location: ../pages/edit_evaluation.php?id=' . $evaluationID);
            } else {
                echo "Error updating evaluation: " . mysqli_error($conn);
                // header('Location: ../pages/edit_evaluation.php?id=' . $evaluationID);
            }
        } else {
            echo "Error preparing update statement: " . mysqli_error($conn);
            // header('Location: ../pages/edit_evaluation.php?id=' . $evaluationID);
        }

        mysqli_stmt_close($stmt);
    }
} else {
    echo "Invalid request.";
    // header('Location: ../pages/edit_evaluation.php?id=' . $evaluationID);
}

mysqli_close($conn);
?>
