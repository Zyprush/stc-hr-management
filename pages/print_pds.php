<?php

require '../vendor/autoload.php'; // Include Composer's autoloader

use PhpOffice\PhpSpreadsheet\IOFactory;
use setasign\Fpdi\Tcpdf\Fpdi;

// File path to the Excel file
$filePath = '../assets/pds/pds.xlsx';

// Load the existing Excel file
$spreadsheet = IOFactory::load($filePath);

// Modify cell D10 in Sheet1
$sheet1 = $spreadsheet->getSheetByName('C1');
$sheet1->setCellValue('D10', 'Alberio');

// Modify cell D11 in Sheet2
$sheet2 = $spreadsheet->getSheetByName('C2');
$sheet2->setCellValue('A5', 'CIVIL SERVICE PROFESSIONAL');

// Modify cell D12 in Sheet3
$sheet3 = $spreadsheet->getSheetByName('C3');
$sheet3->setCellValue('A6', 'N/A');

// Modify cell D13 in Sheet4
$sheet4 = $spreadsheet->getSheetByName('C4');
$sheet4->setCellValue('A52', 'JAKE DENVER ALBERIO');

// Save the modifications back to the file
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save($filePath);

echo 'Excel file edited successfully.';

// Loop through each sheet and save as an individual PDF
foreach ($spreadsheet->getSheetNames() as $sheetName) {
    $sheet = $spreadsheet->getSheetByName($sheetName);

    // Set the active sheet
    $spreadsheet->setActiveSheetIndexByName($sheetName);

    // Create a writer for each sheetexit
    $pdfWriter = IOFactory::createWriter($spreadsheet, 'Mpdf');
    $pdfWriter->save('../assets/pds/' . $sheetName . '.pdf');
}

echo 'Excel sheets converted to individual PDF files successfully.';

// Path to the merged PDF file (local file system path)
$mergedPdfPath = __DIR__ . '/../assets/pds/merged_pdf.pdf';

// Create an instance of Fpdi
$pdf = new Fpdi();

// Array of PDFs to merge
$pdfsToMerge = [
    '../assets/pds/C1.pdf',
    '../assets/pds/C2.pdf',
    '../assets/pds/C3.pdf',
    '../assets/pds/C4.pdf',
];

// Loop through each PDF and merge into one
foreach ($pdfsToMerge as $pdfToMerge) {
    $pageCount = $pdf->setSourceFile($pdfToMerge);
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $tplIdx = $pdf->importPage($pageNo);
        $pdf->AddPage();
        $pdf->useTemplate($tplIdx);
    }
}

// Save the merged PDF
$pdf->Output($mergedPdfPath, 'F');

echo 'PDF files merged successfully into a single multi-page PDF.';

// Remove the individual PDF files
foreach ($pdfsToMerge as $pdfToMerge) {
    unlink($pdfToMerge);
}

echo 'Individual PDF files removed.';
?>