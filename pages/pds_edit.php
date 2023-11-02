<?php

require_once('../vendor/autoload.php');
require_once('../config/dbcon.php');

use setasign\Fpdi\Tcpdf\Fpdi;

// Retrieve the ID parameter from the URL
$id = $_GET['id'];

// Query to fetch employee data based on the ID
$query = "SELECT * FROM employees WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    function formatData($value) {
        // Convert to uppercase
        $formattedValue = strtoupper($value);
    
        // Replace empty values with 'N/A'
        $formattedValue = !empty($formattedValue) ? $formattedValue : 'N/A';
    
        return $formattedValue;
    }
    
    // Fetching data from the database
    $lastName = formatData($row['LastName']);
    $firstName = formatData($row['FirstName']);
    $middleName = formatData($row['MiddleName']);
    $extensionName = formatData($row['Extension']);
    $birthdate = formatData($row['Birthdate']);

// File path to the PDF file you want to modify
$filePath = __DIR__ . '/../assets/pds/pds.pdf'; // Absolute path to the input PDF

// Construct the file name using the first name and last name of the employee
$outputFileName = $firstName . ' ' . $lastName . ' PDS.pdf';
$outputPath = __DIR__ . "/../assets/pds/{$outputFileName}";

// Content for each section of every page
$pageContent = [
    [
        'First page' => [
            $lastName => ['x' => 48, 'y' => 43],
            $firstName => ['x' => 48, 'y' => 49.5],
            $middleName => ['x' => 48, 'y' => 56.5],
            $extensionName => ['x' => 195, 'y' => 49.5],
            $birthdate => ['x' => 48, 'y' => 65],
        ],
    ],
    [
        'Second page' => [
            'Works stuff' => ['x' => 60, 'y' => 60],
        ],
    ],
    [
        'Third page' => [
            'Family matter' => ['x' => 70, 'y' => 70],
        ],
    ],
    [
        'Fourth page' => [
            'Work collage' => ['x' => 80, 'y' => 80],
        ],
    ],
];

// Create an instance of FPDI
$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile($filePath);

for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    $templateId = $pdf->importPage($pageNo);

    // Set the page size in portrait orientation (8.5x13 inches)
    $pdf->AddPage('P', [8.5 * 25.4, 13 * 25.4]); // Width and Height in millimeters (1 inch = 25.4 mm)

    $pdf->useTemplate($templateId);

    // Set font for each page
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetTextColor(0, 0, 0);

    // Add text content for each section of every page
    foreach ($pageContent[$pageNo - 1] as $sectionName => $sectionContent) {
        foreach ($sectionContent as $text => $coordinates) {
            $pdf->SetXY($coordinates['x'], $coordinates['y']);
            $pdf->Write(0, $text);
        }
    }
}

// Output the modified PDF to a file with a new name
$pdf->Output($outputPath, 'F');

echo 'Modified PDF saved successfully as ' . $outputPath;

} else {
    echo 'No data found for the provided ID.';
}
?>