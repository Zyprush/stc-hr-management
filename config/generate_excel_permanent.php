<?php
include 'dbcon.php';
require '../vendor/autoload.php'; // Path to autoload.php of PhpSpreadsheet

// Assuming $id is provided via $_GET or another method
$id = $_GET['id'] ?? null;

if ($id === null) {
    die('Invalid ID');
}

// Fetch department from 'departments' table based on $id
$departmentQuery = "SELECT Department FROM departments WHERE id = ?";
$stmt = $conn->prepare($departmentQuery);
$stmt->bind_param('i', $id);
$stmt->execute();
$departmentResult = $stmt->get_result();

if (!$departmentResult) {
    die('Error fetching department: ' . mysqli_error($conn));
}

$departmentData = $departmentResult->fetch_assoc();
$department = $departmentData['Department'];

// Fetch data from the 'employees' table based on the department
$query = "SELECT oldItem, newItem, position, name, employment, sg, amount, sg1, amount1 FROM employees WHERE office = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $department);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die('Error fetching data: ' . mysqli_error($conn));
}

// Create a new PhpSpreadsheet object
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set headers for the Excel file
$sheet->setCellValue('A1', 'PERSONNEL SCHEDULE FY 2024');
$sheet->mergeCells('A1:I1'); 

$sheet->setCellValue('A2', 'LGU: SANTA CRUZ, OCCIDENTAL MINDORO');
$sheet->mergeCells('A2:I2'); 

$sheet->setCellValue('A4', 'OFFICE:' . $department);
$sheet->mergeCells('A4:I4'); 

$sheet->setCellValue('A6', 'Item No.');
$sheet->mergeCells('A6:B6'); // Merge cells for 'Item No.' header

$sheet->setCellValue('A7', 'Old Item');
$sheet->setCellValue('B7', 'New Item');

$sheet->setCellValue('C6', 'Position Title');
$sheet->mergeCells('C6:C7');

$sheet->setCellValue('D6', 'Name of Incumbent');
$sheet->mergeCells('D6:D7');

$sheet->setCellValue('E6', 'Type of Employment');
$sheet->mergeCells('E6:E7');

$sheet->setCellValue('F6', 'Current Year Authorized Rate/Annum');
$sheet->mergeCells('F6:G6');
$sheet->setCellValue('F7', 'SG/Step');
$sheet->setCellValue('G7', 'Amount');

$sheet->setCellValue('H6', 'Budget Year Proposed Rate/Annum');
$sheet->mergeCells('H6:I6');
$sheet->setCellValue('H7', 'SG/Step');
$sheet->setCellValue('I7', 'Amount');

// Center align each cell individually
$centeredCells = ['A1', 'A2', 'A6', 'C6', 'D6', 'E6'];
foreach ($centeredCells as $cell) {
    $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle($cell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
}

// Set height for cells F6 and H6 directly using setRowHeight
$sheet->getRowDimension(6)->setRowHeight(30); // Set height for row 6 (F6)
$sheet->getRowDimension(7)->setRowHeight(30); // Set height for row 8 (H6)

// Set text wrap for cells F6 and H6
$sheet->getStyle('F6')->getAlignment()->setWrapText(true);
$sheet->getStyle('H6')->getAlignment()->setWrapText(true);


// Fetch and process each row of data
$rowCount = 8; // Start from row 8 for actual data
$totalAmount = 0; // Initialize total amount variable for 'amount' column
$totalAmount1 = 0; // Initialize total amount variable for 'amount1' column

// Array to hold all rows' data
$rowsData = [];

while ($row = mysqli_fetch_assoc($result)) {
    // Process 'amount' column
    $amount = str_replace(',', '', $row['amount']); // Remove commas from the string
    $amount = (int)$amount; // Convert string to integer
    $totalAmount += $amount; // Add amount to the total for 'amount' column

    // Process 'amount1' column
    $amount1 = str_replace(',', '', $row['amount1']); // Remove commas from the string
    $amount1 = (int)$amount1; // Convert string to integer
    $totalAmount1 += $amount1; // Add amount to the total for 'amount1' column

    // Process each row's data
    $rowData = [
        $row['oldItem'], // Old Item
        $row['newItem'], // New Item
        $row['position'],
        $row['name'],
        $row['employment'],
        $row['sg'], // Current Year SG/Step
        $row['amount'], // Current Year Amount
        $row['sg1'], // Budget Year SG/Step
        $row['amount1'] // Budget Year Amount
    ];

    // Add each row's data to the array
    $rowsData[] = $rowData;
}

// Add the 'Total' row at the end
$rowsData[] = ['', '', '', '', 'Total', '', number_format($totalAmount), '', number_format($totalAmount1)];

// Loop through the data array and add to the spreadsheet
foreach ($rowsData as $rowData) {
    $sheet->fromArray($rowData, NULL, 'A' . $rowCount);
    $rowCount++;
}

// Auto-fit column width for all columns
$columns = $sheet->getColumnIterator();
foreach ($columns as $column) {
    $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
}

// Center align all cells except for A4
$cellRange = 'A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow();
$sheet->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

// Determine the last row in the sheet
$lastRow = $sheet->getHighestRow();

// Set borders for the range from row 6 to the last row
$borderRange = 'A6:I' . $lastRow;
$sheet->getStyle($borderRange)->applyFromArray([
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
]);

// Create the last 5 rows with a border-bottom for each name
$lastRows = [
    ['', 'Prepared By:', '',  'Received By:', '',  'Approved By:', '',  ''],
    ['', '', '', '', '', '', '', ''],
    ['', 'LINA V. RAMOS', '', 'MARYNETTE T. SIBULAN', '', 'ERNESTO P. TORRELIZA', ''],
    ['', 'Chief Administrative Officer (HRMO V)', '', 'Local Budget Officer', '', 'Local Chief Executive', ''],
    ['', '', '', '', '', '', '', '']
];

// Row count for the last 5 rows
$lastRowCount = $sheet->getHighestRow() + 2; // Assuming a gap of 1 row between the data and the last 5 rows

// Add the last 5 rows to the spreadsheet for names
foreach ($lastRows as $index => $lastRowData) {
    $sheet->fromArray($lastRowData, NULL, 'A' . $lastRowCount);
    
    // Check if it's the third row (index 2) and set borders only for that row
    if ($index === 2) {
        // Set borders for the third row in columns B, D, and F
        $nameColumns = ['B', 'D', 'F'];
        foreach ($nameColumns as $column) {
            $cell = $column . $lastRowCount;
            $sheet->getStyle($cell)->applyFromArray([
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]);
        }
    }
    
    $lastRowCount++;
}

// Create a writer object
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

// Save the file into the 'employees_excel' folder
$folderPath = 'employees_excel/';
if (!file_exists($folderPath)) {
    mkdir($folderPath, 0777, true);
}
$filename = $folderPath . $department . '-List.xlsx';
$writer->save($filename);

// Set headers for file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename=' . basename($filename));
header('Cache-Control: max-age=0');

// Send file to browser
readfile($filename);
?>