<?php
if (isset($_GET['file_directory']) && isset($_GET['file_name'])) {
    $file_directory = $_GET['file_directory'];
    $file_name = $_GET['file_name'];

    // Validate the file path to prevent directory traversal
    if (strpos($file_directory, '..') !== false || strpos($file_directory, '/') === 0) {
        // Invalid file path
        exit('Invalid file path');
    }

    // Construct the complete file path by combining directory and file name
    $file_path = __DIR__ . '/' . $file_directory . $file_name;

    echo $file_path;

    // Check if the file exists
    if (file_exists($file_path)) {
        // Set headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_path));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        // File not found
        exit('File not found');
    }
} else {
    // File directory or file name not provided
    exit('File directory or file name not provided');
}
?>
