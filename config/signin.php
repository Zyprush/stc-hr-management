<?php
// Enable secure session settings
ini_set('session.cookie_secure', 1); // Ensure session cookies are only transmitted over HTTPS
ini_set('session.cookie_httponly', 1); // Prevent client-side scripts from accessing session cookies
ini_set('session.use_only_cookies', 1); // Only use cookies to store session IDs
ini_set('session.cookie_samesite', 'Lax'); // Set SameSite attribute to mitigate CSRF attacks

// Include the database configuration
require_once 'dbcon.php';

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted email and password
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Prepare the query to prevent SQL injection
  $query = "SELECT * FROM credentials WHERE email = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if the user exists and the password is correct
  if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        // Start the session
        session_start();

        // Store user information in session variables
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        // Redirect to the dashboard or any other authorized page
        header('Location: ../pages/dashboard.php');
        exit();
    } else {
        $_SESSION['status'] = "Incorrect password!";
        header('Location: ../pages/signinup.php');
        exit();
    }
  } else {
    $_SESSION['status'] = "Not registered!";
    header('Location: ../pages/signinup.php');
    exit();
  }
}
