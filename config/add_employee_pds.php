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
            FirstName VARCHAR(255) NOT NULL,
            MiddleName VARCHAR(255) NOT NULL,
            LastName VARCHAR(255) NOT NULL,
            Extension VARCHAR(255),
            StartDate DATE,
            Type VARCHAR(255) NOT NULL,
            Department VARCHAR(255) NOT NULL,
            Position VARCHAR(255) NOT NULL,
            EndDate DATE,
            Birthdate DATE,
            PlaceOfBirth VARCHAR(255),
            Sex VARCHAR(10),
            CivilStatus VARCHAR(20),
            Height FLOAT,
            Weight FLOAT,
            BloodType VARCHAR(5),
            GSIS VARCHAR(20),
            PagIbig VARCHAR(20),
            SSS VARCHAR(20),
            TIN VARCHAR(20),
            Agency VARCHAR(255),
            Citizenship VARCHAR(255),
            DualCitizenship VARCHAR(255),
            LotNo VARCHAR(255),
            Street VARCHAR(255),
            Barangay VARCHAR(255),
            Subdivision VARCHAR(255),
            City VARCHAR(255),
            Province VARCHAR(255),
            Zipcode VARCHAR(20),
            LotNoPermanent VARCHAR(255),
            StreetPermanent VARCHAR(255),
            BarangayPermanent VARCHAR(255),
            SubdivisionPermanent VARCHAR(255),
            CityPermanent VARCHAR(255),
            ProvincePermanent VARCHAR(255),
            ZipcodePermanent VARCHAR(20),
            Telephone VARCHAR(20),
            Mobile VARCHAR(20),
            Email VARCHAR(255),
            SpouseSurname VARCHAR(255),
            SpouseFirstname VARCHAR(255),
            SpouseMiddlename VARCHAR(255),
            SpouseExtensionname VARCHAR(255),
            SpouseOccupation VARCHAR(255),
            SpouseEmployer VARCHAR(255),
            SpouseBusinessAddress VARCHAR(255),
            SpouseTelephone VARCHAR(20)
        )";

        if (mysqli_query($conn, $createTableQuery)) {
            echo 'Table "employees" created successfully.';
        } else {
            echo 'Error creating table: ' . mysqli_error($conn);
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
        SpouseExtensionname, SpouseOccupation, SpouseEmployer, SpouseBusinessAddress, SpouseTelephone
    ) VALUES (
        '$firstName', '$middleName', '$lastName', '$extension', '$startDate', '$type', '$department', '$position', '$endDate',
        '$birthdate', '$placeOfBirth', '$sex', '$civilStatus', $height, $weight, '$bloodtype', '$gsis', '$pagibig', '$sss', '$tin',
        '$agency', '$citizenship', '$dualCitizenship', '$lotNo', '$street', '$barangay', '$subdivision', '$city', '$province', '$zipcode',
        '$lotNo_permanent', '$street_permanent', '$barangay_permanent', '$subdivision_permanent', '$city_permanent', '$province_permanent', '$zipcode_permanent',
        '$telephone', '$mobile', '$email', '$spouse_surname', '$spouse_firstname', '$spouse_middlename', '$spouse_extensionname',
        '$spouse_occupation', '$spouse_employer', '$spouse_business_address', '$spouse_telephone'
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
