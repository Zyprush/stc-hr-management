<?php

include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve employee details from the POST request
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $extension = $_POST['extension'];
    $startDate = $_POST['startDate'];
    $type = $_POST['type'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $endDate = $_POST['endDate'];

    // Add the new variables
    $birthdate = $_POST['birthdate'];
    $placeOfBirth = $_POST['placeOfBirth'];
    $sex = $_POST['sex'];
    $civilStatus = $_POST['civilStatus'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bloodtype = $_POST['bloodtype'];
    $gsis = $_POST['gsis'];
    $pagibig = $_POST['pagibig'];
    $sss = $_POST['sss'];
    $tin = $_POST['tin'];
    $agency = $_POST['agency'];
    $citizenship = $_POST['citizenship'];
    $dualCitizenship = $_POST['dualCitizenship'];
    $lotNo = $_POST['lotNo'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $subdivision = $_POST['subdivision'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zipcode = $_POST['zipcode'];
    $lotNo_permanent = $_POST['lotNo_permanent'];
    $street_permanent = $_POST['street_permanent'];
    $barangay_permanent = $_POST['barangay_permanent'];
    $subdivision_permanent = $_POST['subdivision_permanent'];
    $city_permanent = $_POST['city_permanent'];
    $province_permanent = $_POST['province_permanent'];
    $zipcode_permanent = $_POST['zipcode_permanent'];
    $telephone = $_POST['telephone'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $spouse_surname = $_POST['spouse_surname'];
    $spouse_firstname = $_POST['spouse_firstname'];
    $spouse_middlename = $_POST['spouse_middlename'];
    $spouse_extensionname = $_POST['spouse_extensionname'];
    $spouse_occupation = $_POST['spouse_occupation'];
    $spouse_employer = $_POST['spouse_employer'];
    $spouse_business_address = $_POST['spouse_business_address'];
    $spouse_telephone = $_POST['spouse_telephone'];

    //parents
    $father_surname = $_POST['father_surname'];
    $father_firstname = $_POST['father_firstname'];
    $father_middlename = $_POST['father_middlename'];
    $father_extension = $_POST['father_extension'];
    $mother_surname = $_POST['mother_surname'];
    $mother_firstname = $_POST['mother_firstname'];
    $mother_middlename = $_POST['mother_middlename'];

    //Schools
    $elem_nameOfSchool = $_POST['elem_nameOfSchool'];
    $elem_degree = $_POST['elem_degree'];
    $elem_from = $_POST['elem_from'];
    $elem_to = $_POST['elem_to'];
    $elem_high = $_POST['elem_high'];
    $elem_grad = $_POST['elem_grad'];
    $elem_honor = $_POST['elem_honor'];

    $sec_nameOfSchool = $_POST['sec_nameOfSchool'];
    $sec_degree = $_POST['sec_degree'];
    $sec_from = $_POST['sec_from'];
    $sec_to = $_POST['sec_to'];
    $sec_high = $_POST['sec_high'];
    $sec_grad = $_POST['sec_grad'];
    $sec_honor = $_POST['sec_honor'];

    $voc_nameOfSchool = $_POST['voc_nameOfSchool'];
    $voc_degree = $_POST['voc_degree'];
    $voc_from = $_POST['voc_from'];
    $voc_to = $_POST['voc_to'];
    $voc_high = $_POST['voc_high'];
    $voc_grad = $_POST['voc_grad'];
    $voc_honor = $_POST['voc_honor'];

    $college_nameOfSchool = $_POST['college_nameOfSchool'];
    $college_degree = $_POST['college_degree'];
    $college_from = $_POST['college_from'];
    $college_to = $_POST['college_to'];
    $college_high = $_POST['college_high'];
    $college_grad = $_POST['college_grad'];
    $college_honor = $_POST['college_honor'];

    $grad_nameOfSchool = $_POST['grad_nameOfSchool'];
    $grad_degree = $_POST['grad_degree'];
    $grad_from = $_POST['grad_from'];
    $grad_to = $_POST['grad_to'];
    $grad_high = $_POST['grad_high'];
    $grad_grad = $_POST['grad_grad'];
    $grad_honor = $_POST['grad_honor'];


    // Validate employee details here if needed

    // Check if the 'employees' table exists, and create it if not
    $checkTableQuery = "SHOW TABLES LIKE 'employees'";
    $tableResult = mysqli_query($conn, $checkTableQuery);

    if (!$tableResult) {
        echo 'Error checking table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($tableResult) == 0) {
        // The table doesn't exist, create it
        $createTableQuery = "CREATE TABLE employees (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            FirstName TEXT NOT NULL,
            MiddleName TEXT NOT NULL,
            LastName TEXT NOT NULL,
            Extension TEXT,
            StartDate DATE,
            Type TEXT NOT NULL,
            Department TEXT,
            Position TEXT NOT NULL,
            EndDate DATE,
            Birthdate DATE,
            PlaceOfBirth TEXT,
            Sex VARCHAR(10),  -- VARCHAR data type is kept for Sex
            CivilStatus TEXT,
            Height FLOAT,
            Weight FLOAT,
            BloodType TEXT,
            GSIS TEXT,
            PagIbig TEXT,
            SSS TEXT,
            TIN TEXT,
            Agency TEXT,
            Citizenship TEXT,
            DualCitizenship TEXT,
            LotNo TEXT,
            Street TEXT,
            Barangay TEXT,
            Subdivision TEXT,
            City TEXT,
            Province TEXT,
            Zipcode TEXT,
            LotNoPermanent TEXT,
            StreetPermanent TEXT,
            BarangayPermanent TEXT,
            SubdivisionPermanent TEXT,
            CityPermanent TEXT,
            ProvincePermanent TEXT,
            ZipcodePermanent TEXT,
            Telephone TEXT,
            Mobile TEXT,
            Email TEXT,
            SpouseSurname TEXT,
            SpouseFirstname TEXT,
            SpouseMiddlename TEXT,
            SpouseExtensionname TEXT,
            SpouseOccupation TEXT,
            SpouseEmployer TEXT,
            SpouseBusinessAddress TEXT,
            SpouseTelephone TEXT,
            FatherSurname TEXT,
            FatherFirstname TEXT,
            FatherMiddlename TEXT,
            FatherExtension TEXT,
            MotherSurname TEXT,
            MotherFirstname TEXT,
            MotherMiddlename TEXT,
            ElemNameOfSchool TEXT,
            ElemDegree TEXT,
            ElemFrom TEXT,
            ElemTo TEXT,
            ElemHigh TEXT,
            ElemGrad TEXT,
            ElemHonor TEXT,
            SecNameOfSchool TEXT,
            SecDegree TEXT,
            SecFrom TEXT,
            SecTo TEXT,
            SecHigh TEXT,
            SecGrad TEXT,
            SecHonor TEXT,
            VocNameOfSchool TEXT,
            VocDegree TEXT,
            VocFrom TEXT,
            VocTo TEXT,
            VocHigh TEXT,
            VocGrad TEXT,
            VocHonor TEXT,
            CollegeNameOfSchool TEXT,
            CollegeDegree TEXT,
            CollegeFrom TEXT,
            CollegeTo TEXT,
            CollegeHigh TEXT,
            CollegeGrad TEXT,
            CollegeHonor TEXT,
            GradNameOfSchool TEXT,
            GradDegree TEXT,
            GradFrom TEXT,
            GradTo TEXT,
            GradHigh TEXT,
            GradGrad TEXT,
            GradHonor TEXT
        )";
    
        if (mysqli_query($conn, $createTableQuery)) {
            echo 'Table "employees" created successfully.';
        } else {
            echo 'Error creating table: ' . mysqli_error($conn);
            exit;
        }
    }
    

    // Check if the 'children' table exists, and create it if not
    $checkChildrenTableQuery = "SHOW TABLES LIKE 'children'";
    $childrenTableResult = mysqli_query($conn, $checkChildrenTableQuery);

    if (!$childrenTableResult) {
        echo 'Error checking "children" table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($childrenTableResult) == 0) {
        // The 'children' table doesn't exist, create it
        $createChildrenTableQuery = "CREATE TABLE children (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            EmployeeID INT,
            ChildName VARCHAR(255) NOT NULL,
            ChildDOB DATE
        )";

        if (mysqli_query($conn, $createChildrenTableQuery)) {
            echo 'Table "children" created successfully.';
        } else {
            echo 'Error creating "children" table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Check if the 'eligibility' table exists, and create it if not
$checkEligibilityTableQuery = "SHOW TABLES LIKE 'eligibility'";
$eligibilityTableResult = mysqli_query($conn, $checkEligibilityTableQuery);

if (!$eligibilityTableResult) {
    echo 'Error checking "eligibility" table existence: ' . mysqli_error($conn);
    exit;
}

if (mysqli_num_rows($eligibilityTableResult) == 0) {
    // The 'eligibility' table doesn't exist, create it
    $createEligibilityTableQuery = "CREATE TABLE eligibility (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        EmployeeID INT,
        EligibilityName VARCHAR(255) NOT NULL,
        Rating VARCHAR(50),
        DateOfExamination VARCHAR(50),
        PlaceOfExamination VARCHAR(255),
        LicenseNumber VARCHAR(50),
        DateOfValidity VARCHAR(50)
    )";

    if (mysqli_query($conn, $createEligibilityTableQuery)) {
        echo 'Table "eligibility" created successfully.';
    } else {
        echo 'Error creating "eligibility" table: ' . mysqli_error($conn);
        exit;
    }
}


    // Now, perform the database insertion for the employee
    $insertEmployeeQuery = "INSERT INTO employees (
        FirstName, MiddleName, LastName, Extension, StartDate, Type, Department, Position, EndDate,
        Birthdate, PlaceOfBirth, Sex, CivilStatus, Height, Weight, BloodType, GSIS, PagIbig, SSS, TIN,
        Agency, Citizenship, DualCitizenship, LotNo, Street, Barangay, Subdivision, City, Province, Zipcode,
        LotNoPermanent, StreetPermanent, BarangayPermanent, SubdivisionPermanent, CityPermanent, ProvincePermanent,
        ZipcodePermanent, Telephone, Mobile, Email, SpouseSurname, SpouseFirstname, SpouseMiddlename,
        SpouseExtensionname, SpouseOccupation, SpouseEmployer, SpouseBusinessAddress, SpouseTelephone, FatherSurname, FatherFirstname, FatherMiddlename, FatherExtension,
        MotherSurname, MotherFirstname, MotherMiddlename,
        ElemNameOfSchool, ElemDegree, ElemFrom, ElemTo, ElemHigh, ElemGrad, ElemHonor,
        SecNameOfSchool, SecDegree, SecFrom, SecTo, SecHigh, SecGrad, SecHonor,
        VocNameOfSchool, VocDegree, VocFrom, VocTo, VocHigh, VocGrad, VocHonor,
        CollegeNameOfSchool, CollegeDegree, CollegeFrom, CollegeTo, CollegeHigh, CollegeGrad, CollegeHonor,
        GradNameOfSchool, GradDegree, GradFrom, GradTo, GradHigh, GradGrad, GradHonor
    ) VALUES (
        '$firstName', '$middleName', '$lastName', '$extension', '$startDate', '$type', '$department', '$position', '$endDate',
        '$birthdate', '$placeOfBirth', '$sex', '$civilStatus', $height, $weight, '$bloodtype', '$gsis', '$pagibig', '$sss', '$tin',
        '$agency', '$citizenship', '$dualCitizenship', '$lotNo', '$street', '$barangay', '$subdivision', '$city', '$province', '$zipcode',
        '$lotNo_permanent', '$street_permanent', '$barangay_permanent', '$subdivision_permanent', '$city_permanent', '$province_permanent', '$zipcode_permanent',
        '$telephone', '$mobile', '$email', '$spouse_surname', '$spouse_firstname', '$spouse_middlename', '$spouse_extensionname',
        '$spouse_occupation', '$spouse_employer', '$spouse_business_address', '$spouse_telephone', '$father_surname', '$father_firstname', '$father_middlename', '$father_extension',
        '$mother_surname', '$mother_firstname', '$mother_middlename',
        '$elem_nameOfSchool', '$elem_degree', '$elem_from', '$elem_to', '$elem_high', '$elem_grad', '$elem_honor',
        '$sec_nameOfSchool', '$sec_degree', '$sec_from', '$sec_to', '$sec_high', '$sec_grad', '$sec_honor',
        '$voc_nameOfSchool', '$voc_degree', '$voc_from', '$voc_to', '$voc_high', '$voc_grad', '$voc_honor',
        '$college_nameOfSchool', '$college_degree', '$college_from', '$college_to', '$college_high', '$college_grad', '$college_honor',
        '$grad_nameOfSchool', '$grad_degree', '$grad_from', '$grad_to', '$grad_high', '$grad_grad', '$grad_honor'
    )";

    if (mysqli_query($conn, $insertEmployeeQuery)) {
        // Retrieve the auto-generated employee ID
        $employeeID = mysqli_insert_id($conn);

        // Now, handle child information
        if (isset($_POST['childName'])) {
            $childNames = $_POST['childName'];
            $childDOBs = $_POST['childDOB'];

            // Loop through the child arrays and insert them into the 'children' table
            foreach ($childNames as $key => $childName) {
                $childName = mysqli_real_escape_string($conn, $childName); // Sanitize the input
                $childDOB = mysqli_real_escape_string($conn, $childDOBs[$key]); // Sanitize the input

                // Perform the database insertion for child data
                $childInsertQuery = "INSERT INTO children (EmployeeID, ChildName, ChildDOB) VALUES ('$employeeID', '$childName', '$childDOB')";

                if (mysqli_query($conn, $childInsertQuery)) {
                    // Child added successfully
                } else {
                    echo 'Error inserting child data: ' . mysqli_error($conn);
                    // Handle the error as needed
                }
            }
        }
        // Handle eligibility information
    if (isset($_POST['eligibility'])) {
        $eligibilityNames = $_POST['eligibility'];
        $ratings = $_POST['rating'];
        $examDates = $_POST['exam_date'];
        $examPlaces = $_POST['exam_place'];
        $licenseNumbers = $_POST['license_number'];
        $validityDates = $_POST['validity_date'];

        // Loop through the eligibility arrays and insert them into the 'eligibility' table
        foreach ($eligibilityNames as $key => $eligibilityName) {
            $eligibilityName = mysqli_real_escape_string($conn, $eligibilityName); // Sanitize the input
            $rating = mysqli_real_escape_string($conn, $ratings[$key]); // Sanitize the input
            $examDate = mysqli_real_escape_string($conn, $examDates[$key]); // Sanitize the input
            $examPlace = mysqli_real_escape_string($conn, $examPlaces[$key]); // Sanitize the input
            $licenseNumber = mysqli_real_escape_string($conn, $licenseNumbers[$key]); // Sanitize the input
            $validityDate = mysqli_real_escape_string($conn, $validityDates[$key]); // Sanitize the input

            // Perform the database insertion for eligibility data
            $eligibilityInsertQuery = "INSERT INTO eligibility (EmployeeID, EligibilityName, Rating, DateOfExamination, PlaceOfExamination, LicenseNumber, DateOfValidity) 
            VALUES ('$employeeID', '$eligibilityName', '$rating', '$examDate', '$examPlace', '$licenseNumber', '$validityDate')";

            if (mysqli_query($conn, $eligibilityInsertQuery)) {
                // Eligibility added successfully
            } else {
                echo 'Error inserting eligibility data: ' . mysqli_error($conn);
                // Handle the error as needed
            }
        }
    }

        // Set a session value to indicate success
        session_start();
        $_SESSION['message'] = 'Employee and child data added successfully';

        // Redirect to the employee.php page (or your desired destination)
        header('Location: ../pages/employee.php');
        exit();
    } else {
        echo 'Error inserting employee data: ' . mysqli_error($conn);

        // Set a session value to indicate the error
        session_start();
        $_SESSION['message'] = 'Error adding employee';

        // Redirect to the employee.php page (or your desired destination)
        header('Location: ../pages/employee.php');
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>