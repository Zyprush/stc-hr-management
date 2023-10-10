<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  $_SESSION['status'] = "Login to access this page";
  header('Location: ../pages/signinup.php');
  exit();
}

// The user is logged in
$userId = $_SESSION['id'];
$name = $_SESSION['name'];
$role = $_SESSION['role'];
