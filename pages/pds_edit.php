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
    $spouseSurname = formatData($row['SpouseSurname']). ' ';
    $spouseFirstname = formatData($row['SpouseFirstname']). ' ';
    $spouseMiddlename = formatData($row['SpouseMiddlename']). ' ';
    $spouseExtensionname = formatData($row['SpouseExtensionname']). ' ';
    $spouseOccupation = formatData($row['SpouseOccupation']). ' ';
    $spouseEmployer = formatData($row['SpouseEmployer']). ' ';
    $spouseBusinessAddress = formatData($row['SpouseBusinessAddress']). ' ';
    $spouseTelephone = formatData($row['SpouseTelephone']). ' ';

    $fatherSurname = formatData($row['FatherSurname']). ' ';
    $fatherFirstname = formatData($row['FatherFirstname']). ' ';
    $fatherMiddlename = formatData($row['FatherMiddlename']). ' ';
    $fatherExtension = formatData($row['FatherExtension']). ' ';
    $motherMaiden = formatData($row['MotherMaiden']). '    ';
    $motherSurname = formatData($row['MotherSurname']). '  ';
    $motherFirstname = formatData($row['MotherFirstname']). ' ';
    $motherMiddlename = formatData($row['MotherMiddlename']). ' ';

    $elemNameOfSchool = formatData($row['ElemNameOfSchool']). ' ';
    $elemDegree = formatData($row['ElemDegree']). ' ';
    $elemFrom = formatData($row['ElemFrom']). '  ';
    $elemTo = formatData($row['ElemTo']). '             ';
    $elemHigh = formatData($row['ElemHigh']). '';
    $elemGrad = formatData($row['ElemGrad']). ' ';
    $elemHonor = formatData($row['ElemHonor']). ' ';

    $secNameOfSchool = formatData($row['SecNameOfSchool']). '  ';
    $secDegree = formatData($row['SecDegree']). '  ';
    $secFrom = formatData($row['SecFrom']). '   ';
    $secTo = formatData($row['SecTo']). '    ';
    $secHigh = formatData($row['SecHigh']). '  ';
    $secGrad = formatData($row['SecGrad']). '  ';
    $secHonor = formatData($row['SecHonor']). '  ';

    $vocNameOfSchool = formatData($row['VocNameOfSchool']). '   ';
    $vocDegree = formatData($row['VocDegree']). '   ';
    $vocFrom = formatData($row['VocFrom']). '     ';
    $vocTo = formatData($row['VocTo']). '     ';
    $vocHigh = formatData($row['VocHigh']). '   ';
    $vocGrad = formatData($row['VocGrad']). '   ';
    $vocHonor = formatData($row['VocHonor']). '   ';

    $collegeNameOfSchool = formatData($row['CollegeNameOfSchool']). ' ';
    $collegeDegree = formatData($row['CollegeDegree']). ' ';
    $collegeFrom = formatData($row['CollegeFrom']). '     ';
    $collegeTo = formatData($row['CollegeTo']). '       ';
    $collegeHigh = formatData($row['CollegeHigh']). ' ';
    $collegeGrad = formatData($row['CollegeGrad']). ' ';
    $collegeHonor = formatData($row['CollegeHonor']). ' ';

    $gradNameOfSchool = formatData($row['GradNameOfSchool']). '      ';
    $gradDegree = formatData($row['GradDegree']). '      ';
    $gradFrom = formatData($row['GradFrom']). '      ';
    $gradTo = formatData($row['GradTo']). '       ';
    $gradHigh = formatData($row['GradHigh']). '      ';
    $gradGrad = formatData($row['GradGrad']). '      ';
    $gradHonor = formatData($row['GradHonor']). '      ';




// File path to the PDF file you want to modify
$filePath = __DIR__ . '/../assets/pds/pds.pdf'; // Absolute path to the input PDF

// Construct the file name using the first name and last name of the employee
$outputFileName = $firstName . ' ' . $lastName . ' PDS.pdf';
$outputPath = __DIR__ . "/../assets/pds/{$outputFileName}";

//condition for civil status
if ($civilStatus === "SINGLE") {
    $civilCoordinates = ['x' => 38.3, 'y' => 83.5];
} elseif ($civilStatus === "MARRIED") {
    $civilCoordinates = ['x' => 56.7, 'y' => 83.5];
} elseif ($civilStatus === "WIDOWED") {
    $civilCoordinates = ['x' => 38.3, 'y' => 87.5];
} elseif ($civilStatus === "SEPARATED") {
    $civilCoordinates = ['x' => 56.7, 'y' => 87.5];
} else {
    $civilCoordinates = ['x' => 38.3, 'y' => 92];
}

$citizenshipCoordinates1 = ['x' => -5, 'y' => -5]; // Default empty values
$citizenshipCoordinates2 = ['x' => -5, 'y' => -5]; // Default empty values
//condition for citizenship
if ($citizenship === "FILIPINO") {
    $citizenshipCoordinates = ['x' => 136.8, 'y' => 60]; //filipino
} elseif ($citizenship === "DUAL CITIZENSHIP - BY BIRTH") {
    $citizenshipCoordinates = ['x' => 136.8, 'y' => 60]; //filipino
    $citizenshipCoordinates1 = ['x' => 162.5, 'y' => 60]; //DUAL
    $citizenshipCoordinates2 = ['x' => 167, 'y' => 64.5]; //BY BIRTH
} elseif ($citizenship ===  "DUAL CITIZENSHIP - BY NATURALIZATION") {
    $citizenshipCoordinates = ['x' => 136.8, 'y' => 60]; //filipino
    $citizenshipCoordinates1 = ['x' => 162.5, 'y' => 60]; //DUAL
    $citizenshipCoordinates2 = ['x' => 181, 'y' => 64.5]; //by naturalization
}

// Query to fetch children of the employee
$childrenQuery = "SELECT * FROM children WHERE `EmployeeID` = ?";
$childrenStmt = $conn->prepare($childrenQuery);

if (!$childrenStmt) {
    die("Error in children SQL query: " . $conn->error);
}

$childrenStmt->bind_param("i", $id);
$childrenStmt->execute();
$childrenResult = $childrenStmt->get_result();

if ($childrenResult->num_rows > 0) {
    $childrenData = $childrenResult->fetch_all(MYSQLI_ASSOC);

    $counter = 1;

    foreach ($childrenData as $childRow) {
        ${'child' . $counter} = formatData($childRow['ChildName']);
        ${'childDOB' . $counter} = formatData($childRow['ChildDOB'], 'date');
        $counter++;
    }

    for ($i = 1; $i < $counter; $i++) {
        echo "$child1 $childDOB1";
    }
} else {
    echo "No children found for the given EmployeeID.";
}

// Query to fetch eligibility of the employee
$eligibilityQuery = "SELECT * FROM eligibility WHERE `EmployeeID` = ?";
$eligibilityStmt = $conn->prepare($eligibilityQuery);

if (!$eligibilityStmt) {
    die("Error in eligibility SQL query: " . $conn->error);
}

$eligibilityStmt->bind_param("i", $id);
$eligibilityStmt->execute();
$eligibilityResult = $eligibilityStmt->get_result();

if ($eligibilityResult->num_rows > 0) {
    $eligibilityData = $eligibilityResult->fetch_all(MYSQLI_ASSOC);

    $counter = 1;

    foreach ($eligibilityData as $eligibleRow) {
        ${'eligible' . $counter} = formatData($eligibleRow['EligibilityName']);
        ${'eligibleRating' . $counter} = formatData($eligibleRow['Rating']);
        ${'eligibleDOE' . $counter} = formatData($eligibleRow['DateOfExamination']);
        ${'eligiblePOE' . $counter} = formatData($eligibleRow['PlaceOfExamination']);
        ${'eligibleNumber' . $counter} = formatData($eligibleRow['LicenseNumber']);
        ${'eligibleDOV' . $counter} = formatData($eligibleRow['DateOfValidity']);
        $counter++;
    }

    for ($i = 1; $i < $counter; $i++) {
        echo "$eligible1 $eligibleRating1 $eligibleDOE1 $eligiblePOE1 $eligibleNumber1 $eligibleDOV1";
    }
} else {
    echo "No eligibility found for the given EmployeeID.";
}

// Query to fetch work_experience of the employee
$work_experienceQuery = "SELECT * FROM work_experience WHERE `EmployeeID` = ?";
$work_experienceStmt = $conn->prepare($work_experienceQuery);

if (!$work_experienceStmt) {
    die("Error in work_experience SQL query: " . $conn->error);
}

$work_experienceStmt->bind_param("i", $id);
$work_experienceStmt->execute();
$work_experienceResult = $work_experienceStmt->get_result();

if ($work_experienceResult->num_rows > 0) {
    $work_experienceData = $work_experienceResult->fetch_all(MYSQLI_ASSOC);

    $counter = 1;

    foreach ($work_experienceData as $experienceRow) {
        ${'experience' . $counter} = formatData($experienceRow['PositionTitle']);
        ${'experienceDepartment' . $counter} = formatData($experienceRow['Department']);
        ${'experienceSalary' . $counter} = formatData($experienceRow['MonthlySalary']);
        ${'experienceST' . $counter} = formatData($experienceRow['SalaryType']);
        ${'experienceAS' . $counter} = formatData($experienceRow['AppointmentStatus']);
        ${'experienceWFD' . $counter} = formatData($experienceRow['WorkFromDate']);
        ${'experienceWTD' . $counter} = formatData($experienceRow['WorkToDate']);
        ${'experienceGov' . $counter} = formatData($experienceRow['GovtService']);
        $counter++;
    }

    for ($i = 1; $i < $counter; $i++) {
        echo "$experience1 $experienceDepartment1 $experienceSalary1 $experienceST1 $experienceAS1 $experienceWFD1
                $experienceWTD1 $experienceGov1 ";
    }
} else {
    echo "No work_experience found for the given EmployeeID.";
}



// Content for each section of every page
$pageContent = [
    [
        'First page' => [
            $lastName => ['x' => 38, 'y' => 43],
            $firstName => ['x' => 38, 'y' => 49.5],
            $middleName => ['x' => 38, 'y' => 56.5],
            $extensionName => ['x' => 195, 'y' => 49.5],
            $birthdate => ['x' => 38, 'y' => 65],
            $placeOfBirth => ['x' => 38, 'y' => 74],
            '•' => ['x' => $sex === 'MALE' ? 38.3 : 56.7, 'y' => 76.9],
            '• ' => $civilCoordinates,
            '•  ' => $citizenshipCoordinates,
            '•   ' => $citizenshipCoordinates1,
            '•    ' => $citizenshipCoordinates2,
            $dualCitizenship => ['x' => 134.5, 'y' => 81.5], //second citizenship
            $height => ['x' => 38, 'y' => 104],
            $weight => ['x' => 38, 'y' => 110],
            $bloodtype => ['x' => 38, 'y' => 116.5],
            $gsis => ['x' => 38, 'y' => 124.5],
            $pagibig => ['x' => 38, 'y' => 132],
            $philhealth => ['x' => 38, 'y' => 138.5],
            $sss => ['x' => 38, 'y' => 144.5],
            $tin => ['x' => 38, 'y' => 150.5],
            $agency => ['x' => 38, 'y' => 156.5],
            $lotNo => ['x' => 133, 'y' => 87.5],
            $street => ['x' => 175, 'y' => 87.5],
            $subdivision => ['x' => 133, 'y' => 95],
            $barangay => ['x' => 175, 'y' => 95],
            $city => ['x' => 130, 'y' => 102.5],
            $province => ['x' => 163, 'y' => 102.5],
            $zipcode => ['x' => 124, 'y' => 110],
            $lotNopermanent => ['x' => 133, 'y' => 114.5],
            $streetpermanent => ['x' => 175, 'y' => 114.5],
            $subdivisionpermanent => ['x' => 133, 'y' => 122.5],
            $barangaypermanent => ['x' => 175, 'y' => 122.5],
            $citypermanent => ['x' => 133, 'y' => 130.5], 
            $provincepermanent => ['x' => 163, 'y' => 130.5],
            $zipcodepermanent => ['x' => 124, 'y' => 138.5],
            $telephone => ['x' => 124, 'y' => 144.5],
            $mobile => ['x' => 124, 'y' => 150.5],
            $email => ['x' => 124, 'y' => 156.5],

            $spouseSurname => ['x' => 38, 'y' => 168],
            $spouseFirstname => ['x' => 38, 'y' => 174],
            $spouseExtensionname => ['x' => 115, 'y' => 174],
            $spouseMiddlename => ['x' => 38, 'y' => 180.5],
            $spouseOccupation => ['x' => 38, 'y' => 187],
            $spouseEmployer => ['x' => 38, 'y' => 193],
            $spouseBusinessAddress => ['x' => 38, 'y' => 199.5],
            $spouseTelephone => ['x' => 38, 'y' => 206],

            $child1 => ['x' => 124, 'y' => 174], // Y is +6.5 PER CHILD
            $childDOB1 => ['x' => 182, 'y' => 174], // Y is +6.5 PER CHILD
            $child2 => ['x' => 124, 'y' => 180.5], // Y is +6.5 PER CHILD
            $childDOB2 => ['x' => 182, 'y' => 180.5], // Y is +6.5 PER CHILD
            $child3 => ['x' => 124, 'y' => 187], // Y is +6.5 PER CHILD
            $childDOB3 => ['x' => 182, 'y' => 187], // Y is +6.5 PER CHILD
            $child4 => ['x' => 124, 'y' => 193.5], // Y is +6.5 PER CHILD
            $childDOB4 => ['x' => 182, 'y' => 193.5], // Y is +6.5 PER CHILD
            $child5 => ['x' => 124, 'y' => 200], // Y is +6.5 PER CHILD
            $childDOB5 => ['x' => 182, 'y' => 200], // Y is +6.5 PER CHILD
            $child6 => ['x' => 124, 'y' => 206.5], // Y is +6.5 PER CHILD
            $childDOB6 => ['x' => 182, 'y' => 206.5], // Y is +6.5 PER CHILD
            $child7 => ['x' => 124, 'y' => 213], // Y is +6.5 PER CHILD
            $childDOB7 => ['x' => 182, 'y' => 213], // Y is +6.5 PER CHILD
            $child8 => ['x' => 124, 'y' => 219.5], // Y is +6.5 PER CHILD
            $childDOB8 => ['x' => 182, 'y' => 219.5], // Y is +6.5 PER CHILD
            $child9 => ['x' => 124, 'y' => 226], // Y is +6.5 PER CHILD
            $childDOB9 => ['x' => 182, 'y' => 226], // Y is +6.5 PER CHILD
            $child10 => ['x' => 124, 'y' => 232.5], // Y is +6.5 PER CHILD
            $childDOB10 => ['x' => 182, 'y' => 232.5], // Y is +6.5 PER CHILD
            $child11 => ['x' => 124, 'y' => 239], // Y is +6.5 PER CHILD
            $childDOB11 => ['x' => 182, 'y' => 239], // Y is +6.5 PER CHILD
            $child12 => ['x' => 124, 'y' => 245.5], // Y is +6.5 PER CHILD
            $childDOB12 => ['x' => 182, 'y' => 245.5], // Y is +6.5 PER CHILD

            $fatherSurname => ['x' => 38, 'y' => 212.5],
            $fatherFirstname => ['x' => 38, 'y' => 218.5],
            $fatherExtension => ['x' => 115, 'y' => 218.5],
            $fatherMiddlename => ['x' => 38, 'y' => 225],

            $motherMaiden => ['x' => 38, 'y' => 231.5],
            $motherSurname => ['x' => 38, 'y' => 238],
            $motherFirstname => ['x' => 38, 'y' => 244.5],
            $motherMiddlename => ['x' => 38, 'y' => 250.5],

            $elemNameOfSchool => ['x' => 38, 'y' => 275],
            $elemDegree => ['x' => 92, 'y' => 275],
            $elemFrom => ['x' => 135, 'y' => 275],
            $elemTo => ['x' => 155, 'y' => 275],
            $elemHigh => ['x' => 168, 'y' => 275],
            $elemGrad => ['x' => 183, 'y' => 275],
            $elemHonor => ['x' => 194.5, 'y' => 275],

            $secNameOfSchool => ['x' => 38, 'y' => 281.7],
            $secDegree => ['x' => 92, 'y' => 281.7],
            $secFrom => ['x' => 135, 'y' => 281.7],
            $secTo => ['x' => 155, 'y' => 281.7],
            $secHigh => ['x' => 168, 'y' => 281.7],
            $secGrad => ['x' => 183, 'y' => 281.7],
            $secHonor => ['x' => 194.5, 'y' => 281.7],

            $vocNameOfSchool => ['x' => 38, 'y' => 288.3],
            $vocDegree => ['x' => 92, 'y' => 288.3],
            $vocFrom => ['x' => 135, 'y' => 288.3],
            $vocTo => ['x' => 155, 'y' => 288.3],
            $vocHigh => ['x' => 168, 'y' => 288.3],
            $vocGrad => ['x' => 183, 'y' => 288.3],
            $vocHonor => ['x' => 194.5, 'y' => 288.3],

            $collegeNameOfSchool => ['x' => 38, 'y' => 295.2],
            $collegeDegree => ['x' => 92, 'y' => 295.2],
            $collegeFrom => ['x' => 135, 'y' => 295.2],
            $collegeTo => ['x' => 155, 'y' => 295.2],
            $collegeHigh => ['x' => 168, 'y' => 295.2],
            $collegeGrad => ['x' => 183, 'y' => 295.2],
            $collegeHonor => ['x' => 194.5, 'y' => 295.2],

            $gradNameOfSchool => ['x' => 38, 'y' => 301.5],
            $gradDegree => ['x' => 92, 'y' => 301.5],
            $gradFrom => ['x' => 135, 'y' => 301.5],
            $gradTo => ['x' => 155, 'y' => 301.5],
            $gradHigh => ['x' => 168, 'y' => 301.5],
            $gradGrad => ['x' => 183, 'y' => 301.5],
            $gradHonor => ['x' => 194.5, 'y' => 301.5],
        ],
    ],
    [
        'Second page' => [
            $eligible1 => ['x' => 7, 'y' => 31], //x is the same but y is +7
            $eligibleRating1 => ['x' => 71, 'y' => 31],
            $eligibleDOE1 => ['x' => 89, 'y' => 31],
            $eligiblePOE1 => ['x' => 109, 'y' => 31],
            $eligibleNumber1 => ['x' => 169, 'y' => 31],
            $eligibleDOV1 => ['x' => 194, 'y' => 31],

            $eligible2 => ['x' => 7, 'y' => 38], //x is the same but y is +7
            $eligibleRating2 => ['x' => 71, 'y' => 38],
            $eligibleDOE2 => ['x' => 89, 'y' => 38],
            $eligiblePOE2 => ['x' => 109, 'y' => 38],
            $eligibleNumber2 => ['x' => 169, 'y' => 38],
            $eligibleDOV2 => ['x' => 194, 'y' => 38],

            $eligible3 => ['x' => 7, 'y' => 45], //x is the same but y is +7
            $eligibleRating3 => ['x' => 71, 'y' => 45],
            $eligibleDOE3 => ['x' => 89, 'y' => 45],
            $eligiblePOE3 => ['x' => 109, 'y' => 45],
            $eligibleNumber3 => ['x' => 169, 'y' => 45],
            $eligibleDOV3 => ['x' => 194, 'y' => 45],

            $eligible4 => ['x' => 7, 'y' => 52], //x is the same but y is +7
            $eligibleRating4 => ['x' => 71, 'y' => 52],
            $eligibleDOE4 => ['x' => 89, 'y' => 52],
            $eligiblePOE4 => ['x' => 109, 'y' => 52],
            $eligibleNumber4 => ['x' => 169, 'y' => 52],
            $eligibleDOV4 => ['x' => 194, 'y' => 52],

            $eligible5 => ['x' => 7, 'y' => 59], //x is the same but y is +7
            $eligibleRating5 => ['x' => 71, 'y' => 59],
            $eligibleDOE5 => ['x' => 89, 'y' => 59],
            $eligiblePOE5 => ['x' => 109, 'y' => 59],
            $eligibleNumber5 => ['x' => 169, 'y' => 59],
            $eligibleDOV5 => ['x' => 194, 'y' => 59],

            $eligible6 => ['x' => 7, 'y' => 66], //x is the same but y is +7
            $eligibleRating6 => ['x' => 71, 'y' => 66],
            $eligibleDOE6 => ['x' => 89, 'y' => 66],
            $eligiblePOE6 => ['x' => 109, 'y' => 66],
            $eligibleNumber6 => ['x' => 169, 'y' => 66],
            $eligibleDOV6 => ['x' => 194, 'y' => 66],

            $eligible7 => ['x' => 7, 'y' => 73], //x is the same but y is +7
            $eligibleRating7 => ['x' => 71, 'y' => 73],
            $eligibleDOE7 => ['x' => 89, 'y' => 73],
            $eligiblePOE7 => ['x' => 109, 'y' => 73],
            $eligibleNumber7 => ['x' => 169, 'y' => 73],
            $eligibleDOV7 => ['x' => 194, 'y' => 73],


            $experience1 => ['x' => 38, 'y' => 110.5],
            $experienceDepartment1 => ['x' => 89, 'y' => 110.5],
            $experienceSalary1 => ['x' => 137, 'y' => 110.5],
            $experienceST1 => ['x' => 152, 'y' => 110.5],
            $experienceAS1 => ['x' => 167.5, 'y' => 110.5],
            $experienceWFD1 => ['x' => 6.5, 'y' => 111.5],
            $experienceWTD1 => ['x' => 23.5, 'y' => 111.5],
            $experienceGov1 => ['x' => 200.5, 'y' => 110.5],

            $experience2 . ' '  => ['x' => 38, 'y' => 118],
            $experienceDepartment2 . ' ' => ['x' => 89, 'y' => 118],
            $experienceSalary2 . ' ' => ['x' => 137, 'y' => 118],
            $experienceST2 . ' ' => ['x' => 152, 'y' => 118],
            $experienceAS2 . ' ' => ['x' => 167.5, 'y' => 118],
            $experienceWFD2 . ' ' => ['x' => 6.5, 'y' => 119],
            $experienceWTD2 . ' ' => ['x' => 23.5, 'y' => 119],
            $experienceGov2 . ' ' => ['x' => 200.5, 'y' => 118],
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

            // Adjust font size for specific variables
            if ($text === $elemNameOfSchool 
            || $text === $elemDegree
                || $text === $elemFrom
                    || $text === $elemTo
                        || $text === $elemHigh
                            || $text === $elemGrad
                                || $text === $elemHonor
            || $text === $secNameOfSchool
                || $text === $secDegree
                    || $text === $secFrom
                        || $text === $secTo
                            || $text === $secHigh
                                || $text === $secGrad
                                    || $text === $secHonor
            || $text === $vocNameOfSchool
                || $text === $vocDegree
                    || $text === $vocFrom
                        || $text === $vocTo
                            || $text === $vocHigh
                                || $text === $vocGrad
                                    || $text === $vocHonor
            || $text === $collegeNameOfSchool
                || $text === $collegeDegree
                    || $text === $collegeFrom
                        || $text === $collegeTo
                            || $text === $collegeHigh
                                || $text === $collegeGrad
                                    || $text === $collegeHonor
            || $text === $gradNameOfSchool
                || $text === $gradDegree
                    || $text === $gradFrom
                        || $text === $gradTo
                            || $text === $gradHigh
                                || $text === $gradGrad
                                    || $text === $gradHonor
            || $text === $eligibleRating1
                || $text === $eligiblePOE1
                    || $text === $eligibleNumber1
                        || $text === $eligibleDOV1
            || $text === $experienceWFD1 || $text === $experienceWTD1 || $text === $experienceWFD2 || $text === $experienceWTD2
            ) {
                $pdf->SetFont('helvetica', '', 6); // Set the font size to 7 for the specified variables
                //$pdf->Write(0, chunk_split($text, 32, "\n"));
            } else {
                if (strpos($text, '•') !== false) {
                    $pdf->SetFont('helvetica', '', 30); // Set the font size to 30 for the dot character
                } else {
                    $pdf->SetFont('helvetica', '', 10); // Set the font size to 10 for other text
                }
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