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
    $name_department = $_POST['name_department'];
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
    $philhealth = $_POST['philhealth'];
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
    $mother_maiden = $_POST['mother_maiden'];
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

    //last page:
    $related_a = $_POST['related_a'];
    $related_details_a = $_POST['related_details_a'];
    $related_b = $_POST['related_b'];
    $related_details_b = $_POST['related_details_b'];

    $guilty_admin_offense = $_POST['guilty_admin_offense'];
    $guilty_admin_details = $_POST['guilty_admin_details'];
    
    $criminal_charged = $_POST['criminal_charged'];
    $criminal_charged_date = $_POST['criminal_charged_date'];
    $criminal_charged_status = $_POST['criminal_charged_status'];

    $crime_violation = $_POST['crime_violation'];
    $crime_violation_details = $_POST['crime_violation_details'];

    $seperated_service = $_POST['seperated_service'];
    $seperated_service_details = $_POST['seperated_service_details'];

    $candidate = $_POST['candidate'];
    $candidate_details = $_POST['candidate_details'];
    $q38b = $_POST['q38b'];
    $q38b_details = $_POST['q38b_details'];

    $q39 = $_POST['q39'];
    $q39_details = $_POST['q39_details'];

    $q40a = $_POST['q40a'];
    $q40a_details = $_POST['q40a_details'];
    $q40b = $_POST['q40b'];
    $q40b_details = $_POST['q40b_details'];
    $q40c = $_POST['q40c'];
    $q40c_details = $_POST['q40c_details'];

    $ref_name_1 = $_POST['ref_name_1'];
    $ref_name_2 = $_POST['ref_name_2'];
    $ref_name_3 = $_POST['ref_name_3'];

    $ref_address_1 = $_POST['ref_address_1'];
    $ref_address_2 = $_POST['ref_address_2'];
    $ref_address_3 = $_POST['ref_address_3'];

    $ref_number_1 = $_POST['ref_number_1'];
    $ref_number_2 = $_POST['ref_number_2'];
    $ref_number_3 = $_POST['ref_number_3'];



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
            MiddleName TEXT,
            LastName TEXT NOT NULL,
            Extension TEXT,
            StartDate DATE,
            Type TEXT NOT NULL,
            Name_department TEXT,
            Position TEXT NOT NULL,
            EndDate DATE,
            Birthdate DATE,
            PlaceOfBirth TEXT,
            Sex VARCHAR(10),  -- VARCHAR data type is kept for Sex
            CivilStatus TEXT,
            Height FLOAT,
            Weight FLOAT,
            BloodType TEXT,
            PhilHealth TEXT,
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
            MotherMaiden TEXT,
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
            GradHonor TEXT,
            related_a TEXT,
            related_details_a TEXT,
            related_b TEXT,
            related_details_b TEXT,
            guilty_admin_offense TEXT,
            guilty_admin_details TEXT,
            criminal_charged TEXT,
            criminal_charged_date TEXT,
            criminal_charged_status TEXT,
            crime_violation TEXT,
            crime_violation_details TEXT,
            seperated_service TEXT,
            seperated_service_details TEXT,
            candidate TEXT,
            candidate_details TEXT,
            q38b TEXT,
            q38b_details TEXT,
            q39 TEXT,
            q39_details TEXT,
            q40a TEXT,
            q40a_details TEXT,
            q40b TEXT,
            q40b_details TEXT,
            q40c TEXT,
            q40c_details TEXT,
            ref_name_1 TEXT,
            ref_name_2 TEXT,
            ref_name_3 TEXT,
            ref_address_1 TEXT,
            ref_address_2 TEXT,
            ref_address_3 TEXT,
            ref_number_1 TEXT,
            ref_number_2 TEXT,
            ref_number_3 TEXT
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

    // Check if the 'work_experience' table exists, and create it if not
    $checkWorkExperienceTableQuery = "SHOW TABLES LIKE 'work_experience'";
    $workExperienceTableResult = mysqli_query($conn, $checkWorkExperienceTableQuery);

    if (!$workExperienceTableResult) {
        echo 'Error checking "work_experience" table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($workExperienceTableResult) == 0) {
        // The 'work_experience' table doesn't exist, create it
        $createWorkExperienceTableQuery = "CREATE TABLE work_experience (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            EmployeeID INT,
            PositionTitle VARCHAR(255) NOT NULL,
            Department VARCHAR(255),
            MonthlySalary INT,
            SalaryType VARCHAR(50),
            AppointmentStatus VARCHAR(100),
            WorkFromDate DATE,
            WorkToDate DATE,
            GovtService VARCHAR(5)
        )";

        if (mysqli_query($conn, $createWorkExperienceTableQuery)) {
            echo 'Table "work_experience" created successfully.';
        } else {
            echo 'Error creating "work_experience" table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Check if the 'voluntary_work' table exists, and create it if not
    $checkVoluntaryWorkTableQuery = "SHOW TABLES LIKE 'voluntary_work'";
    $voluntaryWorkTableResult = mysqli_query($conn, $checkVoluntaryWorkTableQuery);

    if (!$voluntaryWorkTableResult) {
        echo 'Error checking "voluntary_work" table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($voluntaryWorkTableResult) == 0) {
        // The 'voluntary_work' table doesn't exist, create it
        $createVoluntaryWorkTableQuery = "CREATE TABLE voluntary_work (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            EmployeeID INT,
            OrganizationName VARCHAR(255) NOT NULL,
            WorkPosition VARCHAR(255),
            HoursWorked INT,
            WorkFromDate DATE,
            WorkToDate DATE
        )";

        if (mysqli_query($conn, $createVoluntaryWorkTableQuery)) {
            echo 'Table "voluntary_work" created successfully.';
        } else {
            echo 'Error creating "voluntary_work" table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Check if the 'learning_development' table exists, and create it if not
    $checkLDTableQuery = "SHOW TABLES LIKE 'learning_development'";
    $ldTableResult = mysqli_query($conn, $checkLDTableQuery);

    if (!$ldTableResult) {
        echo 'Error checking "learning_development" table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($ldTableResult) == 0) {
        // The 'learning_development' table doesn't exist, create it
        $createLDTableQuery = "CREATE TABLE learning_development (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            EmployeeID INT,
            LDTitle VARCHAR(255) NOT NULL,
            LDType VARCHAR(255) NOT NULL,
            LDSponsor VARCHAR(255),
            LDHours INT,
            LDStartDate DATE,
            LDFinishDate DATE
        )";

        if (mysqli_query($conn, $createLDTableQuery)) {
            echo 'Table "learning_development" created successfully.';
        } else {
            echo 'Error creating "learning_development" table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Check if the 'special_skills' table exists, and create it if not
    $checkSkillsTableQuery = "SHOW TABLES LIKE 'special_skills'";
    $skillsTableResult = mysqli_query($conn, $checkSkillsTableQuery);

    if (!$skillsTableResult) {
        echo 'Error checking "special_skills" table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($skillsTableResult) == 0) {
        // The 'special_skills' table doesn't exist, create it
        $createSkillsTableQuery = "CREATE TABLE special_skills (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            EmployeeID INT,
            Skill VARCHAR(255) NOT NULL
        )";

        if (mysqli_query($conn, $createSkillsTableQuery)) {
            echo 'Table "special_skills" created successfully.';
        } else {
            echo 'Error creating "special_skills" table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Check if the 'non_academic_distinctions' table exists, and create it if not
    $checkDistinctionsTableQuery = "SHOW TABLES LIKE 'non_academic_distinctions'";
    $distinctionsTableResult = mysqli_query($conn, $checkDistinctionsTableQuery);

    if (!$distinctionsTableResult) {
        echo 'Error checking "non_academic_distinctions" table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($distinctionsTableResult) == 0) {
        // The 'non_academic_distinctions' table doesn't exist, create it
        $createDistinctionsTableQuery = "CREATE TABLE non_academic_distinctions (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            EmployeeID INT,
            Distinction VARCHAR(255) NOT NULL
        )";

        if (mysqli_query($conn, $createDistinctionsTableQuery)) {
            echo 'Table "non_academic_distinctions" created successfully.';
        } else {
            echo 'Error creating "non_academic_distinctions" table: ' . mysqli_error($conn);
            exit;
        }
    }

    // Check if the 'memberships' table exists, and create it if not
    $checkMembershipsTableQuery = "SHOW TABLES LIKE 'memberships'";
    $membershipsTableResult = mysqli_query($conn, $checkMembershipsTableQuery);

    if (!$membershipsTableResult) {
        echo 'Error checking "memberships" table existence: ' . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($membershipsTableResult) == 0) {
        // The 'memberships' table doesn't exist, create it
        $createMembershipsTableQuery = "CREATE TABLE memberships (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            EmployeeID INT,
            Membership VARCHAR(255) NOT NULL
        )";

        if (mysqli_query($conn, $createMembershipsTableQuery)) {
            echo 'Table "memberships" created successfully.';
        } else {
            echo 'Error creating "memberships" table: ' . mysqli_error($conn);
            exit;
        }
    }



    // Now, perform the database insertion for the employee
    $insertEmployeeQuery = "INSERT INTO employees (
        FirstName, MiddleName, LastName, Extension, StartDate, Type, Name_department, Position, EndDate,
        Birthdate, PlaceOfBirth, Sex, CivilStatus, Height, Weight, BloodType, PhilHealth, GSIS, PagIbig, SSS, TIN,
        Agency, Citizenship, DualCitizenship, LotNo, Street, Barangay, Subdivision, City, Province, Zipcode,
        LotNoPermanent, StreetPermanent, BarangayPermanent, SubdivisionPermanent, CityPermanent, ProvincePermanent,
        ZipcodePermanent, Telephone, Mobile, Email, SpouseSurname, SpouseFirstname, SpouseMiddlename,
        SpouseExtensionname, SpouseOccupation, SpouseEmployer, SpouseBusinessAddress, SpouseTelephone, FatherSurname, FatherFirstname, FatherMiddlename, FatherExtension,
        MotherMaiden, MotherSurname, MotherFirstname, MotherMiddlename,
        ElemNameOfSchool, ElemDegree, ElemFrom, ElemTo, ElemHigh, ElemGrad, ElemHonor,
        SecNameOfSchool, SecDegree, SecFrom, SecTo, SecHigh, SecGrad, SecHonor,
        VocNameOfSchool, VocDegree, VocFrom, VocTo, VocHigh, VocGrad, VocHonor,
        CollegeNameOfSchool, CollegeDegree, CollegeFrom, CollegeTo, CollegeHigh, CollegeGrad, CollegeHonor,
        GradNameOfSchool, GradDegree, GradFrom, GradTo, GradHigh, GradGrad, GradHonor,
        related_a, related_details_a, related_b, related_details_b,
        guilty_admin_offense, guilty_admin_details, criminal_charged, criminal_charged_date, criminal_charged_status,
        crime_violation, crime_violation_details, seperated_service, seperated_service_details,
        candidate, candidate_details, q38b, q38b_details, q39, q39_details,
        q40a, q40a_details, q40b, q40b_details, q40c, q40c_details,
        ref_name_1, ref_name_2, ref_name_3, ref_address_1, ref_address_2, ref_address_3, ref_number_1, ref_number_2, ref_number_3
    ) VALUES (
        '$firstName', '$middleName', '$lastName', '$extension', '$startDate', '$type', '$name_department', '$position', '$endDate',
        '$birthdate', '$placeOfBirth', '$sex', '$civilStatus', $height, $weight, '$bloodtype', '$philhealth', '$gsis', '$pagibig', '$sss', '$tin',
        '$agency', '$citizenship', '$dualCitizenship', '$lotNo', '$street', '$barangay', '$subdivision', '$city', '$province', '$zipcode',
        '$lotNo_permanent', '$street_permanent', '$barangay_permanent', '$subdivision_permanent', '$city_permanent', '$province_permanent', '$zipcode_permanent',
        '$telephone', '$mobile', '$email', '$spouse_surname', '$spouse_firstname', '$spouse_middlename', '$spouse_extensionname',
        '$spouse_occupation', '$spouse_employer', '$spouse_business_address', '$spouse_telephone', '$father_surname', '$father_firstname', '$father_middlename', '$father_extension',
        '$mother_maiden', '$mother_surname', '$mother_firstname', '$mother_middlename',
        '$elem_nameOfSchool', '$elem_degree', '$elem_from', '$elem_to', '$elem_high', '$elem_grad', '$elem_honor',
        '$sec_nameOfSchool', '$sec_degree', '$sec_from', '$sec_to', '$sec_high', '$sec_grad', '$sec_honor',
        '$voc_nameOfSchool', '$voc_degree', '$voc_from', '$voc_to', '$voc_high', '$voc_grad', '$voc_honor',
        '$college_nameOfSchool', '$college_degree', '$college_from', '$college_to', '$college_high', '$college_grad', '$college_honor',
        '$grad_nameOfSchool', '$grad_degree', '$grad_from', '$grad_to', '$grad_high', '$grad_grad', '$grad_honor',
        '$related_a', '$related_details_a', '$related_b', '$related_details_b',
        '$guilty_admin_offense', '$guilty_admin_details', '$criminal_charged', '$criminal_charged_date', '$criminal_charged_status',
        '$crime_violation', '$crime_violation_details', '$seperated_service', '$seperated_service_details',
        '$candidate', '$candidate_details', '$q38b', '$q38b_details', '$q39', '$q39_details',
        '$q40a', '$q40a_details', '$q40b', '$q40b_details', '$q40c', '$q40c_details',
        '$ref_name_1', '$ref_name_2', '$ref_name_3',
        '$ref_address_1', '$ref_address_2', '$ref_address_3',
        '$ref_number_1', '$ref_number_2', '$ref_number_3'
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

        // Handle work experience information
        if (isset($_POST['position_title'])) {
            $positionTitles = $_POST['position_title'];
            $departments = $_POST['department'];
            $monthlySalaries = $_POST['monthly_salary'];
            $salaryTypes = $_POST['salary_type'];
            $appointmentStatuses = $_POST['appointment_status'];
            $workFromDates = $_POST['work_from_date'];
            $workToDates = $_POST['work_to_date'];
            $govtServices = $_POST['govt_service'];

            // Loop through the work experience arrays and insert them into the 'work_experience' table
            foreach ($positionTitles as $key => $positionTitle) {
                $positionTitle = mysqli_real_escape_string($conn, $positionTitle); // Sanitize the input
                $department = mysqli_real_escape_string($conn, $departments[$key]); // Sanitize the input
                $monthlySalary = mysqli_real_escape_string($conn, $monthlySalaries[$key]); // Sanitize the input
                $salaryType = mysqli_real_escape_string($conn, $salaryTypes[$key]); // Sanitize the input
                $appointmentStatus = mysqli_real_escape_string($conn, $appointmentStatuses[$key]); // Sanitize the input
                $workFromDate = mysqli_real_escape_string($conn, $workFromDates[$key]); // Sanitize the input
                $workToDate = mysqli_real_escape_string($conn, $workToDates[$key]); // Sanitize the input
                $govtService = mysqli_real_escape_string($conn, $govtServices[$key]); // Sanitize the input

                // Perform the database insertion for work experience data
                $workExperienceInsertQuery = "INSERT INTO work_experience (EmployeeID, PositionTitle, Department, MonthlySalary, SalaryType, AppointmentStatus, WorkFromDate, WorkToDate, GovtService) 
                VALUES ('$employeeID', '$positionTitle', '$department', '$monthlySalary', '$salaryType', '$appointmentStatus', '$workFromDate', '$workToDate', '$govtService')";

                if (mysqli_query($conn, $workExperienceInsertQuery)) {
                    // Work experience added successfully
                } else {
                    echo 'Error inserting work experience data: ' . mysqli_error($conn);
                    // Handle the error as needed
                }
            }
        }

        // Handle voluntary work information
        if (isset($_POST['organization_name'])) {
            $organizationNames = $_POST['organization_name'];
            $workPositions = $_POST['work_position'];
            $hoursWorked = $_POST['hours_worked'];
            $workFromDates = $_POST['work_from_date'];
            $workToDates = $_POST['work_to_date'];

            // Loop through the voluntary work arrays and insert them into the 'voluntary_work' table
            foreach ($organizationNames as $key => $organizationName) {
                $organizationName = mysqli_real_escape_string($conn, $organizationName); // Sanitize the input
                $workPosition = mysqli_real_escape_string($conn, $workPositions[$key]); // Sanitize the input
                $hourWorked = intval($hoursWorked[$key]); // Ensure this is properly sanitized based on your input requirements
                $workFromDate = mysqli_real_escape_string($conn, $workFromDates[$key]); // Sanitize the input
                $workToDate = mysqli_real_escape_string($conn, $workToDates[$key]); // Sanitize the input

                // Perform the database insertion for voluntary work data
                $voluntaryWorkInsertQuery = "INSERT INTO voluntary_work (EmployeeID, OrganizationName, WorkPosition, HoursWorked, WorkFromDate, WorkToDate)
                    VALUES ('$employeeID', '$organizationName', '$workPosition', '$hourWorked', '$workFromDate', '$workToDate')";

                if (mysqli_query($conn, $voluntaryWorkInsertQuery)) {
                    // Voluntary work data added successfully
                } else {
                    echo 'Error inserting voluntary work data: ' . mysqli_error($conn);
                    // Handle the error as needed
                }
            }
        }

        // Handle L&D information
        if (isset($_POST['ld_title'])) {
            $ldTitles = $_POST['ld_title'];
            $ldTypes = $_POST['ld_type'];
            $ldSponsors = $_POST['ld_sponsor'];
            $ldHours = $_POST['ld_hours'];
            $ldStartDates = $_POST['ld_start_date'];
            $ldFinishDates = $_POST['ld_finish_date'];

            // Loop through the L&D arrays and insert them into the 'learning_development' table
            foreach ($ldTitles as $key => $ldTitle) {
                $ldTitle = mysqli_real_escape_string($conn, $ldTitle); // Sanitize the input
                $ldType = mysqli_real_escape_string($conn, $ldTypes[$key]); // Sanitize the input
                $ldSponsor = mysqli_real_escape_string($conn, $ldSponsors[$key]); // Sanitize the input
                $ldHour = intval($ldHours[$key]); // Ensure this is properly sanitized based on your input requirements
                $ldStartDate = mysqli_real_escape_string($conn, $ldStartDates[$key]); // Sanitize the input
                $ldFinishDate = mysqli_real_escape_string($conn, $ldFinishDates[$key]); // Sanitize the input

                // Perform the database insertion for L&D data
                $ldInsertQuery = "INSERT INTO learning_development (EmployeeID, LDTitle, LDType, LDSponsor, LDHours, LDStartDate, LDFinishDate)
                    VALUES ('$employeeID', '$ldTitle', '$ldType', '$ldSponsor', '$ldHour', '$ldStartDate', '$ldFinishDate')";

                if (mysqli_query($conn, $ldInsertQuery)) {
                    // L&D data added successfully
                } else {
                    echo 'Error inserting L&D data: ' . mysqli_error($conn);
                    // Handle the error as needed
                }
            }
        }

        // Handle Special Skills and Hobbies information
        if (isset($_POST['skills'])) {
            $skills = $_POST['skills'];

            // Loop through the skills array and insert them into the 'special_skills' table
            foreach ($skills as $skill) {
                $skill = mysqli_real_escape_string($conn, $skill); // Sanitize the input

                // Perform the database insertion for skills data
                $skillInsertQuery = "INSERT INTO special_skills (EmployeeID, Skill)
                    VALUES ('$employeeID', '$skill')";

                if (mysqli_query($conn, $skillInsertQuery)) {
                    // Skill data added successfully
                } else {
                    echo 'Error inserting skill data: ' . mysqli_error($conn);
                    // Handle the error as needed
                }
            }
        }                                   

        // Handle Non-Academic Distinctions/Recognitions information
        if (isset($_POST['distinctions'])) {
            $distinctions = $_POST['distinctions'];

            // Loop through the distinctions array and insert them into the 'non_academic_distinctions' table
            foreach ($distinctions as $distinction) {
                $distinction = mysqli_real_escape_string($conn, $distinction); // Sanitize the input

                // Perform the database insertion for distinction data
                $distinctionInsertQuery = "INSERT INTO non_academic_distinctions (EmployeeID, Distinction)
                    VALUES ('$employeeID', '$distinction')";

                if (mysqli_query($conn, $distinctionInsertQuery)) {
                    // Distinction data added successfully
                } else {
                    echo 'Error inserting distinction data: ' . mysqli_error($conn);
                    // Handle the error as needed
                }
            }
        }

        // Handle Membership in Association/Organization information
        if (isset($_POST['memberships'])) {
            $memberships = $_POST['memberships'];

            // Loop through the memberships array and insert them into the 'memberships' table
            foreach ($memberships as $membership) {
                $membership = mysqli_real_escape_string($conn, $membership); // Sanitize the input

                // Perform the database insertion for membership data
                $membershipInsertQuery = "INSERT INTO memberships (EmployeeID, Membership)
                    VALUES ('$employeeID', '$membership')";

                if (mysqli_query($conn, $membershipInsertQuery)) {
                    // Membership data added successfully
                } else {
                    echo 'Error inserting membership data: ' . mysqli_error($conn);
                    // Handle the error as needed
                }
            }
        }


        // Set a session value to indicate success
        session_start();
        $_SESSION['message'] = 'Employee added successfully';

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