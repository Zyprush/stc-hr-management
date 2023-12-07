<?php
session_start();
// Include your database connection code here
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user_id'])) {
    $userId = $_POST['edit_user_id'];
    $oldPassword = $_POST['edit_old_password'];
    $newPassword = $_POST['edit_new_password'];
    $retypeNewPassword = $_POST['edit_re_new_password'];

    // Validate old password before proceeding
    $query = "SELECT password FROM credentials WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify old password
            if (password_verify($oldPassword, $user['password'])) {
                // Old password matches, proceed with updating user details
                if ($newPassword === $retypeNewPassword) {
                    // Hash the new password before updating
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    // Update user details in the database
                    $updateQuery = "UPDATE credentials SET name=?, email=?, department=?, designation=?, role=?, password=? WHERE id=?";
                    $updateStmt = $conn->prepare($updateQuery);

                    if ($updateStmt) {
                        $updateStmt->bind_param("ssssssi", $_POST['edit_name'], $_POST['edit_email'], $_POST['edit_department'], $_POST['edit_designation'], $_POST['edit_role'], $hashedPassword, $userId);
                        $updateStmt->execute();

                        // Check if the update was successful
                        if ($updateStmt->affected_rows > 0) {
                            echo 'User details updated successfully';
                            $_SESSION['status'] = "User Updated Successfully";
                            header('Location: ../pages/users.php');
                            exit();
                        } else {
                            echo 'Failed to update user details';
                            $_SESSION['status'] = "Failed to Update";
                            header('Location: ../pages/users.php');
                        }

                        $updateStmt->close();
                    } else {
                        echo 'Error preparing update statement: ' . mysqli_error($conn);
                    }
                } else {
                    echo 'New passwords do not match';
                    $_SESSION['status'] = "New Passwords do not match";
                    header('Location: ../pages/users.php');
                    exit();
                }
            } else {
                echo 'Incorrect old password';
                $_SESSION['status'] = "Incorrect old Password";
                header('Location: ../pages/users.php');
                exit();
            }
        } else {
            echo 'User not found';
        }

        $stmt->close();
    } else {
        echo 'Error preparing SQL statement: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid request';
}

// Close the database connection
mysqli_close($conn);
?>