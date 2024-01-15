<?php
include 'dbcon.php';
require '../vendor/autoload.php'; // Path to autoload.php of PhpSpreadsheet

// Fetch data from the 'employee_contract' table
$query = "SELECT name, position, rate, start, end, funding, office FROM employee_contract";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error fetching data: ' . mysqli_error($conn));
}

// Create a new PhpSpreadsheet object
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set headers for the Excel file
$sheet->fromArray(['Name', 'Designation', 'Rate/Month', 'No. of months', 'Period of Employment', 'Funding Charges', 'Office Assignment'], NULL, 'A1');

// Fetch and process each row of data
$rowCount = 2; // Start from row 2 for data
while ($row = mysqli_fetch_assoc($result)) {
    $startDate = new DateTime($row['start']);
    $endDate = new DateTime($row['end']);
    $interval = $startDate->diff($endDate);
    $numberOfMonths = $interval->format('%m');

    $periodOfEmployment = $row['start'] . ' to ' . $row['end'];

    $rowData = [
        $row['name'],
        $row['position'],
        $row['rate'],
        $numberOfMonths,
        $periodOfEmployment,
        $row['funding'],
        $row['office']
    ];

    // Add data to the spreadsheet
    $sheet->fromArray($rowData, NULL, 'A' . $rowCount);
    $rowCount++;
}

// Create a writer object
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

// Save the file into the 'jo_excel' folder
$folderPath = 'contract_excel/';
if (!file_exists($folderPath)) {
    mkdir($folderPath, 0777, true);
}
$filename = $folderPath . 'Contractual-Employees.xlsx';
$writer->save($filename);

// Set headers for file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename=' . basename($filename));
header('Cache-Control: max-age=0');

// Send file to browser
readfile($filename);
?>
