<?php
// signup.php

// Include the database configuration
require_once 'dbcon.php';

// Start the session
session_start();

// Check if the table exists, if not, create it
$createTableQuery = "CREATE TABLE IF NOT EXISTS credentials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  department VARCHAR(255) NOT NULL,
  designation VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('Admin', 'User') NOT NULL DEFAULT 'User'
)";
$conn->query($createTableQuery);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted data
  $name = $_POST['name'];
  $department = $_POST['department'];
  $designation = $_POST['designation'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Check if the user's email already exists in the credentials table
  $checkEmailQuery = "SELECT COUNT(*) FROM credentials WHERE email = ?";
  $stmt = $conn->prepare($checkEmailQuery);
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_row();
  $emailExists = $row[0] > 0;

  if ($emailExists) {
    // Email already exists
    $_SESSION['status'] = "Email already exists!";
    header('Location: ../pages/signinup.php');
    exit();
  }

  // Insert the user into the credentials table
  $insertUserQuery = "INSERT INTO credentials (name, department, designation, email, password, role) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($insertUserQuery);
  $stmt->bind_param('ssssss', $name, $department, $designation, $email, $hashedPassword, $role);
  $insertResult = $stmt->execute();

  if ($insertResult) {
    // User added successfully
    $_SESSION['status'] = "User added successfully!";
    header('Location: ../pages/signinup.php');
    exit();
  } else {
    // User insertion failed
    $_SESSION['status'] = "Error! Please sign up again!";
    header('Location: ../pages/signinup.php');
    exit();
  }
}
