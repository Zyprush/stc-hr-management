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
            // Check if the date is '0000-00-00'
            if ($value === '0000-00-00') {
                // If it is, return an empty string
                return '';
            } else {
                // Convert date format from 'yyyy-mm-dd' to 'mm-dd-yyyy'
                $formattedValue = DateTime::createFromFormat('Y-m-d', $value)->format('m-d-Y');
                return $formattedValue;
            }
        } else {
            // Convert to uppercase
            $formattedValue = strtoupper($value);
    
            // Replace empty values with distinct 'N/A' values for array keys
            $formattedValue = !empty($formattedValue) ? $formattedValue : 'N/A' . str_repeat(' ', $naCounter++);
            return $formattedValue;
        }
    }
    
    
    // Fetching data from the database
    $lastName = formatData($row['LastName']);
    $firstName = formatData($row['FirstName']);
    $middleName = formatData($row['MiddleName']);
    $extensionName = formatData($row['Extension']);
    $birthdate = formatData($row['Birthdate'], 'date');

    //personal
    $placeOfBirth = formatData($row['PlaceOfBirth']) . '     ';
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

    //last page
    $related_a = formatData($row['related_a']);
    $related_details_a = formatData($row['related_details_a']);
    $related_b = formatData($row['related_b']);
    $related_details_b = formatData($row['related_details_b']);

    $guilty_admin_offense = formatData($row['guilty_admin_offense']);
    $guilty_admin_details = formatData($row['guilty_admin_details']);

    $criminal_charged = formatData($row['criminal_charged']);
    $criminal_charged_date = formatData($row['criminal_charged_date']);
    $criminal_charged_status = formatData($row['criminal_charged_status']);

    $crime_violation = formatData($row['crime_violation']);
    $crime_violation_details = formatData($row['crime_violation_details']);

    $seperated_service = formatData($row['seperated_service']);
    $seperated_service_details = formatData($row['seperated_service_details']);

    $candidate = formatData($row['candidate']);
    $candidate_details = formatData($row['candidate_details']);
    $q38b = formatData($row['q38b']);
    $q38b_details = formatData($row['q38b_details']);

    $q39 = formatData($row['q39']);
    $q39_details = formatData($row['q39_details']);

    $q40a = formatData($row['q40a']);
    $q40a_details = formatData($row['q40a_details']);
    $q40b = formatData($row['q40b']);
    $q40b_details = formatData($row['q40b_details']);
    $q40c = formatData($row['q40c']);
    $q40c_details = formatData($row['q40c_details']);

    $ref_name_1 = formatData($row['ref_name_1']);
    $ref_name_2 = formatData($row['ref_name_2']);
    $ref_name_3 = formatData($row['ref_name_3']);

    $ref_address_1 = formatData($row['ref_address_1']);
    $ref_address_2 = formatData($row['ref_address_2']);
    $ref_address_3 = formatData($row['ref_address_3']);

    $ref_number_1 = formatData($row['ref_number_1']);
    $ref_number_2 = formatData($row['ref_number_2']);
    $ref_number_3 = formatData($row['ref_number_3']);


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
        ${'experienceWFD' . $counter} = formatData($experienceRow['WorkFromDate'], 'date');
        ${'experienceWTD' . $counter} = formatData($experienceRow['WorkToDate'], 'date');
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

// Query to fetch voluntary_work of the employee
$voluntary_workQuery = "SELECT * FROM voluntary_work WHERE `EmployeeID` = ?";
$voluntary_workStmt = $conn->prepare($voluntary_workQuery);

if (!$voluntary_workStmt) {
    die("Error in voluntary_work SQL query: " . $conn->error);
}

$voluntary_workStmt->bind_param("i", $id);
$voluntary_workStmt->execute();
$voluntary_workResult = $voluntary_workStmt->get_result();

if ($voluntary_workResult->num_rows > 0) {
    $voluntary_workData = $voluntary_workResult->fetch_all(MYSQLI_ASSOC);

    $counter = 1;

    foreach ($voluntary_workData as $volunterRow) {
        ${'volunter' . $counter} = formatData($volunterRow['OrganizationName']);
        ${'volunterPosition' . $counter} = formatData($volunterRow['WorkPosition']);
        ${'volunterHours' . $counter} = formatData($volunterRow['HoursWorked']);
        ${'volunterWFD' . $counter} = formatData($volunterRow['WorkFromDate'], 'date');
        ${'volunterWTD' . $counter} = formatData($volunterRow['WorkToDate'], 'date');
        $counter++;
    }

    for ($i = 1; $i < $counter; $i++) {
        echo "$volunter1 $volunterPosition1 $volunterHours1 $volunterWFD1 $volunterWTD1";
    }
} else {
    echo "No voluntary_work found for the given EmployeeID.";
}

// Query to fetch learning_development of the employee
$learning_developmentQuery = "SELECT * FROM learning_development WHERE `EmployeeID` = ?";
$learning_developmentStmt = $conn->prepare($learning_developmentQuery);

if (!$learning_developmentStmt) {
    die("Error in learning_development SQL query: " . $conn->error);
}

$learning_developmentStmt->bind_param("i", $id);
$learning_developmentStmt->execute();
$learning_developmentResult = $learning_developmentStmt->get_result();

if ($learning_developmentResult->num_rows > 0) {
    $learning_developmentData = $learning_developmentResult->fetch_all(MYSQLI_ASSOC);

    $counter = 1;

    foreach ($learning_developmentData as $learningRow) {
        ${'learning' . $counter} = formatData($learningRow['LDTitle']);
        ${'learningType' . $counter} = formatData($learningRow['LDType']);
        ${'learningSponsor' . $counter} = formatData($learningRow['LDSponsor']);
        ${'learningHours' . $counter} = formatData($learningRow['LDHours']);
        ${'learningSD' . $counter} = formatData($learningRow['LDStartDate'], 'date');
        ${'learningFD' . $counter} = formatData($learningRow['LDFinishDate'], 'date');
        $counter++;
    }

    for ($i = 1; $i < $counter; $i++) {
        echo "$learning1 $learningType1 $learningSponsor1 $learningHours1 $learningSD1 $learningFD1";
    }
} else {
    echo "No learning_development found for the given EmployeeID.";
}

// Query to fetch special_skills of the employee
$special_skillsQuery = "SELECT * FROM special_skills WHERE `EmployeeID` = ?";
$special_skillsStmt = $conn->prepare($special_skillsQuery);

if (!$special_skillsStmt) {
    die("Error in special_skills SQL query: " . $conn->error);
}

$special_skillsStmt->bind_param("i", $id);
$special_skillsStmt->execute();
$special_skillsResult = $special_skillsStmt->get_result();

if ($special_skillsResult->num_rows > 0) {
    $special_skillsData = $special_skillsResult->fetch_all(MYSQLI_ASSOC);

    $counter = 1;

    foreach ($special_skillsData as $skillRow) {
        ${'skill' . $counter} = formatData($skillRow['Skill']);
        $counter++;
    }

    for ($i = 1; $i < $counter; $i++) {
        echo "$skill1";
    }
} else {
    echo "No special_skills found for the given EmployeeID.";
}

// Query to fetch non_academic_distinctions of the employee
$non_academic_distinctionsQuery = "SELECT * FROM non_academic_distinctions WHERE `EmployeeID` = ?";
$non_academic_distinctionsStmt = $conn->prepare($non_academic_distinctionsQuery);

if (!$non_academic_distinctionsStmt) {
    die("Error in non_academic_distinctions SQL query: " . $conn->error);
}

$non_academic_distinctionsStmt->bind_param("i", $id);
$non_academic_distinctionsStmt->execute();
$non_academic_distinctionsResult = $non_academic_distinctionsStmt->get_result();

if ($non_academic_distinctionsResult->num_rows > 0) {
    $non_academic_distinctionsData = $non_academic_distinctionsResult->fetch_all(MYSQLI_ASSOC);

    $counter = 1;

    foreach ($non_academic_distinctionsData as $distinctionRow) {
        ${'distinction' . $counter} = formatData($distinctionRow['Distinction']);
        $counter++;
    }

    for ($i = 1; $i < $counter; $i++) {
        echo "$distinction1";
    }
} else {
    echo "No non_academic_distinctions found for the given EmployeeID.";
}

// Query to fetch memberships of the employee
$membershipsQuery = "SELECT * FROM memberships WHERE `EmployeeID` = ?";
$membershipsStmt = $conn->prepare($membershipsQuery);

if (!$membershipsStmt) {
    die("Error in memberships SQL query: " . $conn->error);
}

$membershipsStmt->bind_param("i", $id);
$membershipsStmt->execute();
$membershipsResult = $membershipsStmt->get_result();

if ($membershipsResult->num_rows > 0) {
    $membershipsData = $membershipsResult->fetch_all(MYSQLI_ASSOC);

    $counter = 1;

    foreach ($membershipsData as $membershipRow) {
        ${'membership' . $counter} = formatData($membershipRow['Membership']);
        $counter++;
    }

    for ($i = 1; $i < $counter; $i++) {
        echo "$membership1";
    }
} else {
    echo "No memberships found for the given EmployeeID.";
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

            $experience2 . ' '  => ['x' => 38, 'y' => 117.5], // + 7.5
            $experienceDepartment2 . ' ' => ['x' => 89, 'y' => 117.5],
            $experienceSalary2 . ' ' => ['x' => 137, 'y' => 117.5],
            $experienceST2 . ' ' => ['x' => 152, 'y' => 117.5],
            $experienceAS2 . ' ' => ['x' => 167.5, 'y' => 117.5],
            $experienceWFD2 . ' ' => ['x' => 6.5, 'y' => 118.5],
            $experienceWTD2 . ' ' => ['x' => 23.5, 'y' => 118.5],
            $experienceGov2 . ' ' => ['x' => 200.5, 'y' => 117.5],

            $experience3 . '  '  => ['x' => 38, 'y' => 125], // + 7.5
            $experienceDepartment3 . '  ' => ['x' => 89, 'y' => 125],
            $experienceSalary3 . '  ' => ['x' => 137, 'y' => 125],
            $experienceST3 . '  ' => ['x' => 152, 'y' => 125],
            $experienceAS3 . '  ' => ['x' => 167.5, 'y' => 125],
            $experienceWFD3 . '  ' => ['x' => 6.5, 'y' => 125.5],
            $experienceWTD3 . '  ' => ['x' => 23.5, 'y' => 125.5],
            $experienceGov3 . '  ' => ['x' => 200.5, 'y' => 125],

            $experience4 . '   '  => ['x' => 38, 'y' => 132.5], // + 7.5
            $experienceDepartment4 . '   ' => ['x' => 89, 'y' => 132.5],
            $experienceSalary4 . '   ' => ['x' => 137, 'y' => 132.5],
            $experienceST4 . '   ' => ['x' => 152, 'y' => 132.5],
            $experienceAS4 . '   ' => ['x' => 167.5, 'y' => 132.5],
            $experienceWFD4 . '   ' => ['x' => 6.5, 'y' => 132.5],
            $experienceWTD4 . '   ' => ['x' => 23.5, 'y' => 132.5],
            $experienceGov4 . '   ' => ['x' => 200.5, 'y' => 132.5],

            $experience5 => ['x' => 38, 'y' => 140],
            $experienceDepartment5 => ['x' => 89, 'y' => 140],
            $experienceSalary5 => ['x' => 137, 'y' => 140],
            $experienceST5 => ['x' => 152, 'y' => 140],
            $experienceAS5 => ['x' => 167.5, 'y' => 140],
            $experienceWFD5 => ['x' => 6.5, 'y' => 140.5],
            $experienceWTD5 => ['x' => 23.5, 'y' => 140.5],
            $experienceGov5 => ['x' => 200.5, 'y' => 140],

            $experience6 => ['x' => 38, 'y' => 147.5],
            $experienceDepartment6 => ['x' => 89, 'y' => 147.5],
            $experienceSalary6 => ['x' => 137, 'y' => 147.5],
            $experienceST6 => ['x' => 152, 'y' => 147.5],
            $experienceAS6 => ['x' => 167.5, 'y' => 147.5],
            $experienceWFD6 => ['x' => 6.5, 'y' => 147.5],
            $experienceWTD6 => ['x' => 23.5, 'y' => 147.5],
            $experienceGov6 => ['x' => 200.5, 'y' => 147.5],

            $experience7 => ['x' => 38, 'y' => 155],
            $experienceDepartment7 => ['x' => 89, 'y' => 155],
            $experienceSalary7 => ['x' => 137, 'y' => 155],
            $experienceST7 => ['x' => 152, 'y' => 155],
            $experienceAS7 => ['x' => 167.5, 'y' => 155],
            $experienceWFD7 => ['x' => 6.5, 'y' => 155.5],
            $experienceWTD7 => ['x' => 23.5, 'y' => 155.5],
            $experienceGov7 => ['x' => 200.5, 'y' => 155],

            $experience8 => ['x' => 38, 'y' => 162.5],
            $experienceDepartment8 => ['x' => 89, 'y' => 162.5],
            $experienceSalary8 => ['x' => 137, 'y' => 162.5],
            $experienceST8 => ['x' => 152, 'y' => 162.5],
            $experienceAS8 => ['x' => 167.5, 'y' => 162.5],
            $experienceWFD8 => ['x' => 6.5, 'y' => 162.5],
            $experienceWTD8 => ['x' => 23.5, 'y' => 162.5],
            $experienceGov8 => ['x' => 200.5, 'y' => 162.5],

            $experience9 => ['x' => 38, 'y' => 170],
            $experienceDepartment9 => ['x' => 89, 'y' => 170],
            $experienceSalary9 => ['x' => 137, 'y' => 170],
            $experienceST9 => ['x' => 152, 'y' => 170],
            $experienceAS9 => ['x' => 167.5, 'y' => 170],
            $experienceWFD9 => ['x' => 6.5, 'y' => 170.5],
            $experienceWTD9 => ['x' => 23.5, 'y' => 170.5],
            $experienceGov9 => ['x' => 200.5, 'y' => 170],

            $experience10 => ['x' => 38, 'y' => 177.5],
            $experienceDepartment10 => ['x' => 89, 'y' => 177.5],
            $experienceSalary10 => ['x' => 137, 'y' => 177.5],
            $experienceST10 => ['x' => 152, 'y' => 177.5],
            $experienceAS10 => ['x' => 167.5, 'y' => 177.5],
            $experienceWFD10 => ['x' => 6.5, 'y' => 177.5],
            $experienceWTD10 => ['x' => 23.5, 'y' => 177.5],
            $experienceGov10 => ['x' => 200.5, 'y' => 177.5],
        ],
    ],
    [
        'Third page' => [

            $volunter1 => ['x' => 7, 'y' => 31],
            $volunterWFD1 . ' ' => ['x' => 84, 'y' => 32], //x + 2 // y + 1
            $volunterWTD1 . ' ' => ['x' => 101, 'y' => 32], //x + 2 // y + 1
            $volunterHours1 => ['x' => 115.5, 'y' => 31],
            $volunterPosition1 => ['x' => 133, 'y' => 31],

            $volunter2 => ['x' => 7, 'y' => 38],
            $volunterWFD2 . '  ' => ['x' => 84, 'y' => 39],
            $volunterWTD2 . '  ' => ['x' => 101, 'y' => 39],
            $volunterHours2 => ['x' => 115.5, 'y' => 38],
            $volunterPosition2 => ['x' => 133, 'y' => 38],

            $volunter3 => ['x' => 7, 'y' => 45],
            $volunterWFD3 . '   ' => ['x' => 84, 'y' => 46],
            $volunterWTD3 . '   ' => ['x' => 101, 'y' => 46],
            $volunterHours3 => ['x' => 115.5, 'y' => 45],
            $volunterPosition3 => ['x' => 133, 'y' => 45],

            $volunter4 => ['x' => 7, 'y' => 52],
            $volunterWFD4 . '    ' => ['x' => 84, 'y' => 52],
            $volunterWTD4 . '    ' => ['x' => 101, 'y' => 52],
            $volunterHours4 => ['x' => 115.5, 'y' => 52],
            $volunterPosition4 => ['x' => 133, 'y' => 52],

            $volunter5 => ['x' => 7, 'y' => 59],
            $volunterWFD5 . '     ' => ['x' => 84, 'y' => 59],
            $volunterWTD5 . '     ' => ['x' => 101, 'y' => 59],
            $volunterHours5 => ['x' => 115.5, 'y' => 59],
            $volunterPosition5 => ['x' => 133, 'y' => 59],

            $volunter6 => ['x' => 7, 'y' => 66],
            $volunterWFD6 . '      ' => ['x' => 84, 'y' => 66],
            $volunterWTD6 . '      ' => ['x' => 101, 'y' => 66],
            $volunterHours6 => ['x' => 115.5, 'y' => 66],
            $volunterPosition6 => ['x' => 133, 'y' => 66],

            $volunter7 => ['x' => 7, 'y' => 73],
            $volunterWFD7 . '       ' => ['x' => 84, 'y' => 73],
            $volunterWTD7 . '       ' => ['x' => 101, 'y' => 73],
            $volunterHours7 => ['x' => 115.5, 'y' => 73],
            $volunterPosition7 => ['x' => 133, 'y' => 73],                 

            $learning1 => ['x' => 8, 'y' => 108],
            $learningSD1 => ['x' => 84, 'y' => 108],
            $learningFD1 => ['x' => 101, 'y' => 108],
            $learningHours1 => ['x' => 115.5, 'y' => 108],
            $learningType1 => ['x' => 133, 'y' => 108],
            $learningSponsor1 => ['x' => 159, 'y' => 108],

            $learning2 => ['x' => 8, 'y' => 115.5],
            $learningSD2 => ['x' => 84, 'y' => 115.5],
            $learningFD2 => ['x' => 101, 'y' => 115.5],
            $learningHours2 => ['x' => 115.5, 'y' => 115.5],
            $learningType2 => ['x' => 133, 'y' => 115.5],
            $learningSponsor2 => ['x' => 159, 'y' => 115.5],

            $learning3 => ['x' => 8, 'y' => 123],
            $learningSD3 => ['x' => 84, 'y' => 123],
            $learningFD3 => ['x' => 101, 'y' => 123],
            $learningHours3 => ['x' => 115.5, 'y' => 123],
            $learningType3 => ['x' => 133, 'y' => 123],
            $learningSponsor3 => ['x' => 159, 'y' => 123],

            $learning4 => ['x' => 8, 'y' => 130.5],
            $learningSD4 => ['x' => 84, 'y' => 130.5],
            $learningFD4 => ['x' => 101, 'y' => 130.5],
            $learningHours4 => ['x' => 115.5, 'y' => 130.5],
            $learningType4 => ['x' => 133, 'y' => 130.5],
            $learningSponsor4 => ['x' => 159, 'y' => 130.5],

            $learning5 => ['x' => 8, 'y' => 138],
            $learningSD5 => ['x' => 84, 'y' => 138],
            $learningFD5 => ['x' => 101, 'y' => 138],
            $learningHours5 => ['x' => 115.5, 'y' => 138],
            $learningType5 => ['x' => 133, 'y' => 138],
            $learningSponsor5 => ['x' => 159, 'y' => 138],

            $learning6 => ['x' => 8, 'y' => 145.5],
            $learningSD6 => ['x' => 84, 'y' => 145.5],
            $learningFD6 => ['x' => 101, 'y' => 145.5],
            $learningHours6 => ['x' => 115.5, 'y' => 145.5],
            $learningType6 => ['x' => 133, 'y' => 145.5],
            $learningSponsor6 => ['x' => 159, 'y' => 145.5],

            $learning7 => ['x' => 8, 'y' => 153],
            $learningSD7 => ['x' => 84, 'y' => 153],
            $learningFD7 => ['x' => 101, 'y' => 153],
            $learningHours7 => ['x' => 115.5, 'y' => 153],
            $learningType7 => ['x' => 133, 'y' => 153],
            $learningSponsor7 => ['x' => 159, 'y' => 153],

            $learning8 => ['x' => 8, 'y' => 160.5],
            $learningSD8 => ['x' => 84, 'y' => 160.5],
            $learningFD8 => ['x' => 101, 'y' => 160.5],
            $learningHours8 => ['x' => 115.5, 'y' => 160.5],
            $learningType8 => ['x' => 133, 'y' => 160.5],
            $learningSponsor8 => ['x' => 159, 'y' => 160.5],

            $learning9 => ['x' => 8, 'y' => 168],
            $learningSD9 => ['x' => 84, 'y' => 168],
            $learningFD9 => ['x' => 101, 'y' => 168],
            $learningHours9 => ['x' => 115.5, 'y' => 168],
            $learningType9 => ['x' => 133, 'y' => 168],
            $learningSponsor9 => ['x' => 159, 'y' => 168],

            $learning10 => ['x' => 8, 'y' => 175.5],
            $learningSD10 => ['x' => 84, 'y' => 175.5],
            $learningFD10 => ['x' => 101, 'y' => 175.5],
            $learningHours10 => ['x' => 115.5, 'y' => 175.5],
            $learningType10 => ['x' => 133, 'y' => 175.5],
            $learningSponsor10 => ['x' => 159, 'y' => 175.5],

            $skill1 => ['x' => 8, 'y' => 251.5],
            $skill2 => ['x' => 8, 'y' => 259],
            $skill3 => ['x' => 8, 'y' => 266],
            $skill4 => ['x' => 8, 'y' => 273.5],
            $skill5 => ['x' => 8, 'y' => 281],
            $skill6 => ['x' => 8, 'y' => 288.5],
            $skill7 => ['x' => 8, 'y' => 296],

            $distinction1 => ['x' => 71, 'y' => 251.5],
            $distinction2 => ['x' => 71, 'y' => 259],
            $distinction3 => ['x' => 71, 'y' => 266],
            $distinction4 => ['x' => 71, 'y' => 273.5],
            $distinction5 => ['x' => 71, 'y' => 281],
            $distinction6 => ['x' => 71, 'y' => 288.5],
            $distinction7 => ['x' => 71, 'y' => 296],

            $membership1 => ['x' => 159, 'y' => 251.5],
            $membership2 => ['x' => 159, 'y' => 259],
            $membership3 => ['x' => 159, 'y' => 266],
            $membership4 => ['x' => 159, 'y' => 273.5],
            $membership5 => ['x' => 159, 'y' => 281],
            $membership6 => ['x' => 159, 'y' => 288.5],
            $membership7 => ['x' => 159, 'y' => 296],

        ],
    ],
    [
        'Fourth page' => [
            '•     ' => ['x' => $related_a === 'YES' ? 138.5 : 163 , 'y' => 18],
            '•      ' => ['x' => $related_b === 'YES' ? 138.5 : 163 , 'y' => 23.5],
            $related_details_b => ['x' => 146 , 'y' => 38],
            '•       ' => ['x' => $guilty_admin_offense === 'YES' ? 138 : 163 , 'y' => 40],
            '•        ' => ['x' => $criminal_charged === 'YES' ? 138 : 164 , 'y' => 57.5],
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
            || $text === $experienceWFD1 
                || $text === $experienceWTD1 
                    || $text === $experienceWFD2 . ' ' 
                        || $text === $experienceWTD2 . ' '
                            || $text === $experienceWFD3 . '  ' 
                                || $text === $experienceWTD3 . '  '
                                    || $text === $experienceWFD4 . '   ' 
                                        || $text === $experienceWTD4 . '   '
            || $text === $volunterWFD1 . ' ' || $text === $volunterWTD1 . ' '
            || $text === $volunterWFD2 . '  ' || $text === $volunterWTD2 . '  '
            || $text === $volunterWFD3 . '   ' || $text === $volunterWTD3 . '   '
            || $text === $volunterWFD4 . '    ' || $text === $volunterWTD4 . '    '
            || $text === $volunterWFD5 . '     ' || $text === $volunterWTD5 . '     '
            || $text === $volunterWFD7 . '      ' || $text === $volunterWTD7 . '      '
            || $text === $volunterWFD8 . '       ' || $text === $volunterWTD8 . '       '
            || $text === $learningSD1 || $text === $learningFD1
            || $text === $placeOfBirth
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