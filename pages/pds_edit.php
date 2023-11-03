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

    // Initialize the 'N/A' counter variable
    $naCounter = 0;

    // Function to format data
    function formatData($value, $type = '') {
        global $naCounter; // Access the global counter variable

        if ($type === 'date') {
            // Convert date format from 'yyyy-mm-dd' to 'mm-dd-yyyy'
            $formattedValue = DateTime::createFromFormat('Y-m-d', $value)->format('m-d-Y');
        } else {
            // Convert to uppercase
            $formattedValue = strtoupper($value);

            // Replace empty values with distinct 'N/A' values for array keys
            $formattedValue = !empty($formattedValue) ? $formattedValue : 'N/A' . str_repeat(' ', $naCounter++);        
        }

        return $formattedValue;
    }

    
    // Fetching data from the database
    $lastName = formatData($row['LastName']);
    $firstName = formatData($row['FirstName']);
    $middleName = formatData($row['MiddleName']);
    $extensionName = formatData($row['Extension']);
    $birthdate = formatData($row['Birthdate'], 'date');

    //personal
    $placeOfBirth = formatData($row['PlaceOfBirth']);
    $sex = formatData($row['Sex']);
    $civilStatus = formatData($row['CivilStatus']);
    $height = formatData($row['Height']);
    $weight = formatData($row['Weight']);
    $bloodtype = formatData($row['BloodType']);
    $philhealth = formatData($row['PhilHealth']);
    $gsis = formatData($row['GSIS']);
    $pagibig = formatData($row['PagIbig']);
    $sss = formatData($row['SSS']);
    $tin = formatData($row['TIN']);
    $agency = formatData($row['Agency']);
    $citizenship = formatData($row['Citizenship']);
    $dualCitizenship = formatData($row['DualCitizenship']);
    $lotNo = formatData($row['LotNo']);
    $street = formatData($row['Street']);
    $barangay = formatData($row['Barangay']);
    $subdivision = formatData($row['Subdivision']);
    $city = formatData($row['City']);
    $province = formatData($row['Province']);
    $zipcode = formatData($row['Zipcode']);
    $lotNopermanent = formatData($row['LotNoPermanent']) . ' ';
    $streetpermanent = formatData($row['StreetPermanent']) . ' ';
    $barangaypermanent = formatData($row['BarangayPermanent']) . ' ';
    $subdivisionpermanent = formatData($row['SubdivisionPermanent']) . ' ';
    $citypermanent = formatData($row['CityPermanent']) . ' ';
    $provincepermanent = formatData($row['ProvincePermanent']) . ' ';
    $zipcodepermanent = formatData($row['ZipcodePermanent']) . ' ';
    $telephone = formatData($row['Telephone']);
    $mobile = formatData($row['Mobile']);
    $email = formatData($row['Email']);

    //family
    $spouseSurname = formatData($row['SpouseSurname']);
    $spouseFirstname = formatData($row['SpouseFirstname']);
    $spouseMiddlename = formatData($row['SpouseMiddlename']);
    $spouseExtensionname = formatData($row['SpouseExtensionname']);
    $spouseOccupation = formatData($row['SpouseOccupation']);
    $spouseEmployer = formatData($row['SpouseEmployer']);
    $spouseBusinessAddress = formatData($row['SpouseBusinessAddress']);
    $spouseTelephone = formatData($row['SpouseTelephone']);

    $fatherSurname = formatData($row['FatherSurname']);
    $fatherFirstname = formatData($row['FatherFirstname']);
    $fatherMiddlename = formatData($row['FatherMiddlename']);
    $fatherExtension = formatData($row['FatherExtension']);
    $motherSurname = formatData($row['MotherSurname']);
    $motherFirstname = formatData($row['MotherFirstname']);
    $motherMiddlename = formatData($row['MotherMiddlename']);

    $elemNameOfSchool = formatData($row['ElemNameOfSchool']);
    $elemDegree = formatData($row['ElemDegree']);
    $elemFrom = formatData($row['ElemFrom']);
    $elemTo = formatData($row['ElemTo']);
    $elemHigh = formatData($row['ElemHigh']);
    $elemGrad = formatData($row['ElemGrad']);
    $elemHonor = formatData($row['ElemHonor']);

    $secNameOfSchool = formatData($row['SecNameOfSchool']);
    $secDegree = formatData($row['SecDegree']);
    $secFrom = formatData($row['SecFrom']);
    $secTo = formatData($row['SecTo']);
    $secHigh = formatData($row['SecHigh']);
    $secGrad = formatData($row['SecGrad']);
    $secHonor = formatData($row['SecHonor']);

    $vocNameOfSchool = formatData($row['VocNameOfSchool']);
    $vocDegree = formatData($row['VocDegree']);
    $vocFrom = formatData($row['VocFrom']);
    $vocTo = formatData($row['VocTo']);
    $vocHigh = formatData($row['VocHigh']);
    $vocGrad = formatData($row['VocGrad']);
    $vocHonor = formatData($row['VocHonor']);

    $collegeNameOfSchool = formatData($row['CollegeNameOfSchool']);
    $collegeDegree = formatData($row['CollegeDegree']);
    $collegeFrom = formatData($row['CollegeFrom']);
    $collegeTo = formatData($row['CollegeTo']);
    $collegeHigh = formatData($row['CollegeHigh']);
    $collegeGrad = formatData($row['CollegeGrad']);
    $collegeHonor = formatData($row['CollegeHonor']);

    $gradNameOfSchool = formatData($row['GradNameOfSchool']);
    $gradDegree = formatData($row['GradDegree']);
    $gradFrom = formatData($row['GradFrom']);
    $gradTo = formatData($row['GradTo']);
    $gradHigh = formatData($row['GradHigh']);
    $gradGrad = formatData($row['GradGrad']);
    $gradHonor = formatData($row['GradHonor']);




// File path to the PDF file you want to modify
$filePath = __DIR__ . '/../assets/pds/pds.pdf'; // Absolute path to the input PDF

// Construct the file name using the first name and last name of the employee
$outputFileName = $firstName . ' ' . $lastName . ' PDS.pdf';
$outputPath = __DIR__ . "/../assets/pds/{$outputFileName}";

//condition for civil status
if ($civilStatus === "SINGLE") {
    $civilCoordinates = ['x' => 48, 'y' => 83.5];
} elseif ($civilStatus === "MARRIED") {
    $civilCoordinates = ['x' => 66.5, 'y' => 83.5];
} elseif ($civilStatus === "WIDOWED") {
    $civilCoordinates = ['x' => 48, 'y' => 87.5];
} elseif ($civilStatus === "SEPARATED") {
    $civilCoordinates = ['x' => 66.5, 'y' => 87.5];
} else {
    $civilCoordinates = ['x' => 48, 'y' => 92];
}

$citizenshipCoordinates1 = ['x' => -5, 'y' => -5]; // Default empty values
$citizenshipCoordinates2 = ['x' => -5, 'y' => -5]; // Default empty values
//condition for citizenship
if ($citizenship === "FILIPINO") {
    $citizenshipCoordinates = ['x' => 134.5, 'y' => 60]; //filipino
} elseif ($citizenship === "DUAL CITIZENSHIP - BY BIRTH") {
    $citizenshipCoordinates = ['x' => 134.5, 'y' => 60]; //filipino
    $citizenshipCoordinates1 = ['x' => 160.5, 'y' => 60]; //DUAL
    $citizenshipCoordinates2 = ['x' => 165, 'y' => 64.5]; //BY BIRTH
} elseif ($citizenship ===  "DUAL CITIZENSHIP - BY NATURALIZATION") {
    $citizenshipCoordinates = ['x' => 134.5, 'y' => 60]; //filipino
    $citizenshipCoordinates1 = ['x' => 160.5, 'y' => 60]; //DUAL
    $citizenshipCoordinates2 = ['x' => 179, 'y' => 64.5]; //by naturalization
}
// Content for each section of every page
$pageContent = [
    [
        'First page' => [
            $lastName => ['x' => 48, 'y' => 43],
            $firstName => ['x' => 48, 'y' => 49.5],
            $middleName => ['x' => 48, 'y' => 56.5],
            $extensionName => ['x' => 195, 'y' => 49.5],
            $birthdate => ['x' => 48, 'y' => 65],
            $placeOfBirth => ['x' => 48, 'y' => 74],
            '•' => ['x' => $sex === 'MALE' ? 48 : 66.5, 'y' => 77],
            '• ' => $civilCoordinates,
            '•  ' => $citizenshipCoordinates,
            '•   ' => $citizenshipCoordinates1,
            '•    ' => $citizenshipCoordinates2,
            $dualCitizenship => ['x' => 134.5, 'y' => 81.5], //second citizenship
            $height => ['x' => 48, 'y' => 104],
            $weight => ['x' => 48, 'y' => 110],
            $bloodtype => ['x' => 48, 'y' => 116.5],
            $gsis => ['x' => 48, 'y' => 124.5],
            $pagibig => ['x' => 48, 'y' => 132],
            $philhealth => ['x' => 48, 'y' => 138.5],
            $sss => ['x' => 48, 'y' => 144.5],
            $tin => ['x' => 48, 'y' => 150.5],
            $agency => ['x' => 48, 'y' => 156.5],
            $lotNo => ['x' => 133, 'y' => 87.5],
            $street => ['x' => 175, 'y' => 87.5],
            $subdivision => ['x' => 133, 'y' => 95],
            $barangay => ['x' => 175, 'y' => 95],
            $city => ['x' => 130, 'y' => 102.5],
            $province => ['x' => 163, 'y' => 102.5],
            $zipcode => ['x' => 120, 'y' => 110],
            $lotNopermanent => ['x' => 133, 'y' => 114.5],
            $streetpermanent => ['x' => 175, 'y' => 114.5],
            $subdivisionpermanent => ['x' => 133, 'y' => 122.5],
            $barangaypermanent => ['x' => 175, 'y' => 122.5],
            $citypermanent => ['x' => 133, 'y' => 130.5], 
            $provincepermanent => ['x' => 163, 'y' => 130.5],
            $zipcodepermanent => ['x' => 120, 'y' => 138.5],
            $telephone => ['x' => 120, 'y' => 144.5],
            $mobile => ['x' => 120, 'y' => 150.5],
            $email => ['x' => 120, 'y' => 156.5],

            $spouseSurname => ['x' => 48, 'y' => 168],
            $spouseFirstname => ['x' => 48, 'y' => 174],
            $spouseExtensionname => ['x' => 110, 'y' => 174],
            $spouseMiddlename => ['x' => 48, 'y' => 180.5],
            $spouseOccupation => ['x' => 48, 'y' => 187],
            $spouseEmployer => ['x' => 48, 'y' => 193],
            $spouseBusinessAddress => ['x' => 48, 'y' => 199.5],
            $spouseTelephone => ['x' => 48, 'y' => 206],

            'CHILD1' => ['x' => 120, 'y' => 174], // Y is +6.5 PER CHILD
            'MM/DD/YYYY' => ['x' => 181, 'y' => 174], // Y is +6.5 PER CHILD
            'CHILD2' => ['x' => 120, 'y' => 180.5], // Y is +6.5 PER CHILD
            'MM/DD/YYY0' => ['x' => 181, 'y' => 180.5], // Y is +6.5 PER CHILD
            'CHILD3' => ['x' => 120, 'y' => 187], // Y is +6.5 PER CHILD
            'MM/DD/YY00' => ['x' => 181, 'y' => 187], // Y is +6.5 PER CHILD
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

            if (strpos($text, '•') !== false) {
                $pdf->SetFont('helvetica', '', 30); // Set the font size to 30 for the dot character
            } else {
                $pdf->SetFont('helvetica', '', 10); // Set the font size to 10 for other text
            }

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