<!-- logout.php -->
<?php
session_start();

// Update the logout_time in login_logs table
require_once 'dbcon.php'; // Include the database configuration
$updateLogoutQuery = "UPDATE login_logs SET logout_time = CURRENT_TIMESTAMP WHERE user_id = ?";
$updateLogoutStmt = $conn->prepare($updateLogoutQuery);
$updateLogoutStmt->bind_param('i', $_SESSION['id']);
$updateLogoutStmt->execute();

// Destroy the session
session_destroy();

// Redirect to the login page
header('Location: ../pages/signinup.php');
exit();
?>
