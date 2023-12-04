<?php
include 'dbcon.php';
require '../vendor/autoload.php'; // Path to autoload.php of TCPDF

// Fetch data from the 'employees_jo' table
$query = "SELECT name, position, rate, start, end, funding, office FROM employees_jo";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error fetching data: ' . mysqli_error($conn));
}

// Create a new TCPDF object
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Creator');
$pdf->SetAuthor('Author');
$pdf->SetTitle('Employee Data');
$pdf->SetSubject('Employee Data PDF');
$pdf->SetKeywords('Employee, Data, PDF');

// Add a page
$pdf->AddPage();

// Set some content to display fetched data
$html = '<h1>Employee Data</h1>';
$html .= '<table border="1">
    <tr>
        <th>Name</th>
        <th>Designation</th>
        <th>Rate/Month</th>
        <th>No. of months</th>
        <th>Period of Employment</th>
        <th>Funding Charges</th>
        <th>Office Assignment</th>
    </tr>';

while ($row = mysqli_fetch_assoc($result)) {
    $startDate = new DateTime($row['start']);
    $endDate = new DateTime($row['end']);
    $interval = $startDate->diff($endDate);
    $numberOfMonths = $interval->format('%m');
    
    $periodOfEmployment = $row['start'] . ' to ' . $row['end'];

    $html .= '<tr>
        <td>' . $row['name'] . '</td>
        <td>' . $row['position'] . '</td>
        <td>' . $row['rate'] . '</td>
        <td>' . $numberOfMonths . '</td>
        <td>' . $periodOfEmployment . '</td>
        <td>' . $row['funding'] . '</td>
        <td>' . $row['office'] . '</td>
    </tr>';
}

$html .= '</table>';

// Output the HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('Job-Order-Employees.pdf', 'D'); // 'D' for downloading

// Stop further execution
exit;
?>
