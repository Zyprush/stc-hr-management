<?php
include('../includes/header.php');
include('../config/authentication.php');
include('../config/fetch_departments_options.php');
require('../config/countries.php');
?>


<div id="global-loader">
    <div class="whirly-loader"> </div>
</div>

<div class="main-wrapper">

    <div class="header">

        <div class="header-left active">
            <a href="dashboard.php" class="logo">
                STC HR Management
            </a>
            <a href="dashboard.php" class="logo-small">
                HR
            </a>
            <a id="toggle_btn" href="javascript:void(0);">
            </a>
        </div>

        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <ul class="nav user-menu">
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-img"><img src="../assets/img/icons/users1.svg" alt="">
                        <span class="status online"></span></span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilename">
                        <div class="profileset">
                            <span class="user-img"><img src="../assets/img/icons/users1.svg" alt="">
                                <span class="status online"></span></span>
                            <div class="profilesets">
                                <h6><?php echo $name; ?></h6>
                                <h5><?php echo $role; ?></h5>
                            </div>
                        </div>
                        <hr class="m-0">
                        <a class="dropdown-item" href="#"> <i class="me-2" data-feather="user"></i> My Profile</a>
                        <a class="dropdown-item" href="#"><i class="me-2" data-feather="settings"></i>Settings</a>
                        <hr class="m-0">
                        <a class="dropdown-item logout pb-0" href="../config/logout.php"><img src="../assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
                    </div>
                </div>
            </li>
        </ul>


        <div class="dropdown mobile-user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">My Profile</a>
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="../config/logout.php">Logout</a>
            </div>
        </div>

    </div>


    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu">
                        <a href="dashboard.php"><i data-feather="home"></i>
                            <span> Dashboard</span> </a>
                    </li>
                    <li class="menu">
                        <a href="department.php"><i data-feather="users"></i>
                            <span> Department</span> </a>
                    </li>
                    <li class="active">
                        <a href="employee.php"><i data-feather="user"></i>
                            <span> Employee</span> </a>
                    </li>
                    <li class="menu">
                        <a href="report.php"><i data-feather="bar-chart-2"></i>
                            <span> Evaluation</span> </a>
                    </li>
                    <li class="menu">
                        <a href="event.php"><i data-feather="calendar"></i>
                            <span> Event</span> </a>
                    </li>
                    <li class="menu">
                        <a href="activities.php"><i data-feather="activity"></i>
                            <span> Activities</span> </a>
                    </li>
                    <li class="menu">
                        <a href="benefits.php"><i data-feather="award"></i>
                            <span> Benefits</span> </a>
                    </li>
                    <li class="menu">
                        <a href="settings.php"><i data-feather="settings"></i>
                            <span> Settings</span> </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Add Employee</h4>
                        <h6>Employee > Add</h6>
                    </div>
                    <div class="page-btn">
                        <!--
                            
                            <a href="#" class="btn btn-added">
                                <img src="../assets/img/icons/plus.svg" alt="img" class="me-1"> Save
                            </a>
                        -->
                    </div>
                </div>
                <div class="container">
                    <div class="card shadow p-4">
                        <form id="multiPageForm" method="POST" action="process_form.php">
                            <!-- Page 1 -->
                            <div class="page" id="page1">
                                <h3 class="text-center mb-2">Basic Info</h3>
                                <!-- Your Page 1 content -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="firstName">First Name:</label>
                                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Required">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="middleName">Middle Name:</label>
                                            <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Optional">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="lastName">Last Name:</label>
                                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Required">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="extension">Extension:</label>
                                            <input type="text" class="form-control" id="extension" name="extension" placeholder="Optional">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="type">Type of Employment:</label>
                                            <select class="form-control" id="type" name="type">
                                                <option value="">--Select--</option>
                                                <option value="Permanent">Permanent</option>
                                                <option value="Job Order">Job Order</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="department">Department:</label>
                                            <select class="form-control" id="department" name="department">
                                                <option value="">--Select--</option> <!-- Default option -->
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                    $departmentName = $row['Department'];
                                                    echo "<option value=\"$departmentName\">$departmentName</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="position">Position:</label>
                                            <input type="text" class="form-control" id="position" name="position">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="startDate">Start Date:</label>
                                            <input type="date" class="form-control" id="startDate" name="startDate">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="endDate">End Date:</label>
                                            <input type="date" class="form-control" id="endDate" name="endDate">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary next float-end m-2">Next
                                    <i data-feather="arrow-right"></i>
                                </button>

                            </div>

                            <!-- Page 2 (Hidden by default) -->
                            <!-- Your Page 2 content -->
                            <div class="page" id="page2" style="display: none;">
                                <h3 class="text-center mb-2">I. Personal Information</h3>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="birthdate">Date of Birth:</label>
                                            <input type="date" class="form-control" id="birthdate" name="birthdate">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="placeOfBirth">Place of Birth:</label>
                                            <input type="text" class="form-control" id="placeOfBirth" name="placeOfBirth">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="sex">Sex:</label>
                                            <select class="form-control" id="sex" name="sex">
                                                <option value="">--Select--</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="civilStatus">Civil Status:</label>
                                            <select class="form-control" id="civilStatus" name="civilStatus">
                                                <option value="">--Select--</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="widowed">widowed</option>
                                                <option value="Separated">Separated</option>
                                                <option value="Other/s">Other/s</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="height">Height:</label>
                                            <input type="text" class="form-control" id="height" name="height" placeholder="(m)">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="weight">weight:</label>
                                            <input type="text" class="form-control" id="weight" name="weight" placeholder="(kg)">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="bloodtype">Blood Type:</label>
                                            <input type="text" class="form-control" id="bloodtype" name="bloodtype">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="gsis">GSIS ID No:</label>
                                            <input type="text" class="form-control" id="gsis" name="gsis">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="pagibig">PAGIBIG ID No:</label>
                                            <input type="text" class="form-control" id="pagibig" name="pagibig">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="sss">SSS ID No:</label>
                                            <input type="text" class="form-control" id="sss" name="sss">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="tin">TIN No:</label>
                                            <input type="text" class="form-control" id="tin" name="tin">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="agency">Agency Employee No:</label>
                                            <input type="text" class="form-control" id="agency" name="agency">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="citizenship">Citizenship:</label>
                                            <select class="form-control" id="citizenship" name="citizenship">
                                                <option value="">--Select--</option>
                                                <option value="Filipino">Filipino</option>
                                                <option value="Dual Citizenship - By Birth">Dual Citizenship - By birth</option>
                                                <option value="Dual Citizenship - By Naturalization">Dual Citizenship - By Naturalization</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="dualCitizenship">If holder of Dual Citizenship:</label>
                                            <select class="form-control" id="dualCitizenship" name="dualCitizenship">
                                                <option value="">--Select Country--</option>
                                                <?php
                                                foreach ($countries as $country) {
                                                    echo "<option value=\"$country\">$country</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="residentialAddress">Residential Address:</label>
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="lotNo" name="lotNo" placeholder="House/Block/Lot No.">
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="street" name="street" placeholder="Street">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Barangay">
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="subdivision" name="subdivision" placeholder="Subdivision/Village">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="city" name="city" placeholder="City/Municipality">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="province" name="province" placeholder="Province">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="ZIP Code">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="permanentAddress">Permanent Address:</label>
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="lotNoP" name="lotNoP" placeholder="House/Block/Lot No.">
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="streetP" name="streetP" placeholder="Street">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="barangayP" name="barangayP" placeholder="Barangay">
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="subdivisionP" name="subdivisionP" placeholder="Subdivision/Village">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="cityP" name="cityP" placeholder="City/Municipality">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="provinceP" name="provinceP" placeholder="Province">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="zipcodeP" name="zipcodeP" placeholder="ZIP Code">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="contacts">Contacts:</label>
                                        <div class="col-sm-4 mb-1">
                                            <input type="tel" class="form-control" id="tel" name="tel" placeholder="Telephone">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="tel" class="form-control" id="number" name="number" placeholder="Phone/Mobile">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <h3 class="text-center mb-2 mt-2">II. Family Background</h3>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="spouseName">Spouse's Full Name:</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_surname" name="spouse_surname" placeholder="Spouse's Surname">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_firstname" name="spouse_firstname" placeholder="First Name">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_middlename" name="spouse_middlename" placeholder="Middle Name">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_extensionname" name="spouse_extensionname" placeholder="Extension Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="spouseInfo">Spouse's Additional Info:</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_occupation" name="spouse_occupation" placeholder="Occupation">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_employer" name="spouse_employer" placeholder="Employer/Business Name">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_business_address" name="spouse_business_address" placeholder="Business Address">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_telephone" name="spouse_telephone" placeholder="Telephone">
                                        </div>
                                    </div>
                                </div>
                                <!-- Children -->
                                <div id="childrenContainer">
                                    <!-- Up to 10 sets of child input fields -->
                                    <div class="child-entry">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label for="childName">Child's Name:</label>
                                                    <input type="text" class="childName form-control" name="childName[]">
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="childDOB">Date of Birth:</label>
                                                    <input type="date" class="childDOB form-control" name="childDOB[]">
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="childDOB">Add Child:</label>
                                                    <button type="button" class="btn btn-primary" onclick="addChild()">Add Child</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Children -->
                                <div class="form-group">
                                    <div class="row">
                                        <label for="father">Father's Full Name:</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="father_surname" name="father_surname" placeholder="Fathers Surname">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="father_firstname" name="father_firstname" placeholder="First Name">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="father_middlename" name="father_middlename" placeholder="Middle Name">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="father_extension" name="father_extension" placeholder="Extension Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="mother">Mother's Maiden Name:</label>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="mother_surname" name="mother_surname" placeholder="Surname">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="mother_firstname" name="mother_firstname" placeholder="First Name">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="mother_middlename" name="mother_middlename" placeholder="Middle Name">
                                        </div>
                                    </div>
                                </div>

                                <h3 class="text-center mb-2 mt-2">III. Educational Background</h3>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="elementary">Elementary</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="elem_nameOfSchool" name="elem_nameOfSchool" placeholder="Name Of School (Write in full)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="elem_degree" name="elem_degree" placeholder="Basic Education/Degree/Course">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="elem_from" name="elem_from" placeholder="From (Year)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="elem_to" name="elem_to" placeholder="To (Year)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="elem_high" name="elem_high" placeholder="Highest Level (if not grad)">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="elem_grad" name="elem_grad" placeholder="Year Graduated">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="elem_honor" name="elem_honor" placeholder="Scholar/Honors Received">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="secondary">Secondary</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="sec_nameOfSchool" name="sec_nameOfSchool" placeholder="Name Of School (Write in full)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="sec_degree" name="sec_degree" placeholder="Basic Education/Degree/Course">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="sec_from" name="sec_from" placeholder="From (Year)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="sec_to" name="sec_to" placeholder="To (Year)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="sec_high" name="sec_high" placeholder="Highest Level (if not grad)">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="sec_grad" name="sec_grad" placeholder="Year Graduated">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="sec_honor" name="sec_honor" placeholder="Scholar/Honors Received">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="vacational">Vocational/Trade Course</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="voc_nameOfSchool" name="voc_nameOfSchool" placeholder="Name Of School (Write in full)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="voc_degree" name="voc_degree" placeholder="Basic Education/Degree/Course">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="voc_from" name="voc_from" placeholder="From (Year)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="voc_to" name="voc_to" placeholder="To (Year)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="voc_high" name="voc_high" placeholder="Highest Level (if not grad)">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="voc_grad" name="voc_grad" placeholder="Year Graduated">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="voc_honor" name="voc_honor" placeholder="Scholar/Honors Received">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="college">College</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="college_nameOfSchool" name="college_nameOfSchool" placeholder="Name Of School (Write in full)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="college_degree" name="college_degree" placeholder="Basic Education/Degree/Course">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="college_from" name="college_from" placeholder="From (Year)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="college_to" name="college_to" placeholder="To (Year)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="college_high" name="college_high" placeholder="Highest Level (if not grad)">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="college_grad" name="college_grad" placeholder="Year Graduated">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="college_honor" name="college_honor" placeholder="Scholar/Honors Received">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="gradStud">Graduate Studies</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="grad_nameOfSchool" name="grad_nameOfSchool" placeholder="Name Of School (Write in full)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="grad_degree" name="grad_degree" placeholder="Basic Education/Degree/Course">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="grad_from" name="grad_from" placeholder="From (Year)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="grad_to" name="grad_to" placeholder="To (Year)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="grad_high" name="grad_high" placeholder="Highest Level (if not grad)">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="grad_grad" name="grad_grad" placeholder="Year Graduated">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="grad_honor" name="grad_honor" placeholder="Scholar/Honors Received">
                                        </div>
                                    </div>
                                </div>



                                <button type="button" class="btn btn-primary next float-end m-2">Next
                                    <i data-feather="arrow-right"></i>
                                </button>
                                <button type="button" class="btn btn-secondary prev float-end m-2">Previous</button>
                            </div>

                            <!-- Page 3 (Hidden by default) -->
                            <div class="page" id="page3" style="display: none;">
                                <!-- Your Page 3 content -->
                                <h3 class="text-center mb-2 mt-2">IV. CIVIL SERVICE ELIGIBILITY</h3>

                                <!-- Template for an eligibility section -->
                                <div class="eligibility-template form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="CSE/RA 1080 etc.">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="Rating">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="Date of Examination">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="Place of examination">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="License Number">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="Date of Validity">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger delete-eligibility" style="display: none;">Delete</button>
                                </div>

                                <!-- Button to add a new eligibility section -->
                                <button type="button" class="btn btn-primary add-eligibility">Add Eligibility</button>

                                <!-- Container to hold the dynamically added sections -->
                                <div class="eligibility-container">
                                </div>

                                <button type="button" class="btn btn-primary next float-end m-2">Next
                                    <i data-feather="arrow-right"></i>
                                </button>
                                <button type="button" class="btn btn-secondary prev float-end m-2">Previous</button>
                            </div>

                            <!-- Page 4 (Hidden by default) -->
                            <div class="page" id="page4" style="display: none;">
                                <!-- Your Page 4 content -->

                                <!-- ... (Your inputs for Page 4) ... -->

                                <button type="button" class="btn btn-primary next float-end m-2">Next
                                    <i data-feather="arrow-right"></i>
                                </button>
                                <button type="button" class="btn btn-secondary prev float-end m-2">Previous</button>
                            </div>

                            <!-- Page 5 (Hidden by default) -->
                            <div class="page" id="page5" style="display: none;">
                                <!-- Your Page 5 content -->

                                <!-- ... (Your inputs for Page 5) ... -->

                                <button type="button" class="btn btn-primary next float-end m-2">Next
                                    <i data-feather="arrow-right"></i>
                                </button>
                                <button type="button" class="btn btn-secondary prev float-end m-2">Previous</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var current_page = 1;
        var total_pages = 5;

        // Function to validate the current page's inputs

        function validateInputs() {

            var isValid = true;

            /*
            
            //firstName
            var firstName = $("#firstName").val().trim();
            if (firstName === "") {
                isValid = false;
                $("#firstName").addClass("border-2 border-danger");
            } else {
                $("#firstName").removeClass("border-2 border-danger");
            }

            //lastName
            var lastName = $("#lastName").val().trim();
            if (lastName === "") {
                isValid = false;
                $("#lastName").addClass("border-2 border-danger");
            } else {
                $("#lastName").removeClass("border-2 border-danger");
            }

            //startDate
            var startDate = $("#startDate").val().trim();
            if (startDate === "") {
                isValid = false;
                $("#startDate").addClass("border-2 border-danger");
            } else {
                $("#startDate").removeClass("border-2 border-danger");
            }

            //type
            var type = $("#type").val().trim();
            if (type === "") {
                isValid = false;
                $("#type").addClass("border-2 border-danger");
            } else {
                $("#type").removeClass("border-2 border-danger");
            }

            //department
            var department = $("#department").val().trim();
            if (department === "") {
                isValid = false;
                $("#department").addClass("border-2 border-danger");
            } else {
                $("#department").removeClass("border-2 border-danger");
            }

            //position
            var position = $("#position").val().trim();
            if (position === "") {
                isValid = false;
                $("#position").addClass("border-2 border-danger");
            } else {
                $("#position").removeClass("border-2 border-danger");
            }

            //endDate
            var endDate = $("#endDate").val().trim();
            if (endDate === "") {
                isValid = false;
                $("#endDate").addClass("border-2 border-danger");
            } else {
                $("#endDate").removeClass("border-2 border-danger");
            }
            */

            return isValid;
        }


        $(".next").click(function() {
            if (current_page < total_pages) {
                // Validate inputs before proceeding
                if (validateInputs()) {
                    $("#page" + current_page).hide();
                    current_page++;
                    $("#page" + current_page).show();
                }
            }
        });

        $(".prev").click(function() {
            if (current_page > 1) {
                $("#page" + current_page).hide();
                current_page--;
                $("#page" + current_page).show();
            }
        });

        // Form submission
        $("#multiPageForm").submit(function(event) {
            // Validate inputs before submitting
            if (!validateInputs()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });

    function addChild() {
        // Create a new child entry
        const childEntry = document.createElement("div");
        childEntry.classList.add("child-entry", "form-group");

        // Child's Name input field
        const childNameDiv = document.createElement("div");
        childNameDiv.classList.add("col-sm-5");

        const childNameLabel = document.createElement("label");
        childNameLabel.textContent = "Child's Name";

        const childNameInput = document.createElement("input");
        childNameInput.type = "text";
        childNameInput.classList.add("childName", "form-control");
        childNameInput.name = "childName[]";

        childNameDiv.appendChild(childNameLabel);
        childNameDiv.appendChild(childNameInput);

        // Date of Birth input field
        const childDOBDiv = document.createElement("div");
        childDOBDiv.classList.add("col-sm-5");

        const childDOBLabel = document.createElement("label");
        childDOBLabel.textContent = "Date of Birth";

        const childDOBInput = document.createElement("input");
        childDOBInput.type = "date";
        childDOBInput.classList.add("childDOB", "form-control");
        childDOBInput.name = "childDOB[]";

        childDOBDiv.appendChild(childDOBLabel);
        childDOBDiv.appendChild(childDOBInput);

        // Delete Button
        const deleteButtonDiv = document.createElement("div");
        deleteButtonDiv.classList.add("col-sm-2");

        const deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.classList.add("btn", "btn-danger");
        deleteButton.textContent = "Delete";
        deleteButton.style.marginTop = "32px"; // Adjust the margin for vertical alignment

        deleteButton.onclick = function() {
            childEntry.remove(); // Remove the child entry when the delete button is clicked
        };

        deleteButtonDiv.appendChild(deleteButton);

        // Create a row to contain the child entry and Delete Button
        const row = document.createElement("div");
        row.classList.add("row");
        row.appendChild(childNameDiv);
        row.appendChild(childDOBDiv);
        row.appendChild(deleteButtonDiv);

        // Append the row to the child entry
        childEntry.appendChild(row);

        // Append the child entry to the container
        const childrenContainer = document.getElementById("childrenContainer");
        childrenContainer.appendChild(childEntry);

        // Initialize Feather Icons
        feather.replace();
    }

    function addEligibilitySection() {
        const template = document.querySelector('.eligibility-template');
        const clone = template.cloneNode(true);
        clone.classList.remove('eligibility-template');

        // Show the "Delete" button for the new section
        const deleteButton = clone.querySelector('.delete-eligibility');
        deleteButton.style.display = 'inline-block';

        // Attach a click event to the "Delete" button of the new section
        deleteButton.addEventListener('click', function() {
            clone.remove(); // Delete the section when the "Delete" button is clicked
        });

        const container = document.querySelector('.eligibility-container');
        container.appendChild(clone);
    }

    // Event listener for the "Add Eligibility" button
    const addEligibilityButton = document.querySelector('.add-eligibility');
    addEligibilityButton.addEventListener('click', addEligibilitySection);
</script>




<?php
include('../includes/footer.php');
?>