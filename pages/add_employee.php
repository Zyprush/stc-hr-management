<?php
include('../includes/header.php');
include('../config/authentication.php');
include('../config/fetch_departments_options.php');
require('../config/countries.php');
?>

<!--
   <div id="global-loader">
    <div class="whirly-loader"> </div>
</div> 
-->


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
                        <a class="dropdown-item logout pb-0" href="../config/logout.php"><img
                                src="../assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
                    </div>
                </div>
            </li>
        </ul>


        <div class="dropdown mobile-user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                    class="fa fa-ellipsis-v"></i></a>
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
                        <form id="multiPageForm" method="POST" action="../config/add_employee_pds.php">
                            <!-- Page 1 -->
                            <div class="page" id="page1">
                                <h3 class="text-center mb-2">Basic Info</h3>
                                <!-- Your Page 1 content -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="firstName">First Name:</label>
                                            <input type="text" class="form-control" id="firstName" name="firstName"
                                                placeholder="Required">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="middleName">Middle Name:</label>
                                            <input type="text" class="form-control" id="middleName" name="middleName"
                                                placeholder="Optional">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="lastName">Last Name:</label>
                                            <input type="text" class="form-control" id="lastName" name="lastName"
                                                placeholder="Required">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="extension">Extension:</label>
                                            <input type="text" class="form-control" id="extension" name="extension"
                                                placeholder="Optional">
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

                            <!-- Page 2 content -->
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
                                            <input type="text" class="form-control" id="placeOfBirth"
                                                name="placeOfBirth" placeholder="15 characters" maxlength="15" pattern="[\w\s!@#$%^&*()-]+" title="Please enter up to 15 characters including special characters">
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
                                        <div class="col-sm-3">
                                            <label for="height">Height:</label>
                                            <input type="text" class="form-control" id="height" name="height"
                                                placeholder="(m)">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="weight">weight:</label>
                                            <input type="text" class="form-control" id="weight" name="weight"
                                                placeholder="(kg)">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="bloodtype">Blood Type:</label>
                                            <input type="text" class="form-control" id="bloodtype" name="bloodtype">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="philhealth">Philhealth ID No:</label>
                                            <input type="text" class="form-control" id="philhealth" name="philhealth">
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
                                                <option value="Dual Citizenship - By Birth">Dual Citizenship - By birth
                                                </option>
                                                <option value="Dual Citizenship - By Naturalization">Dual Citizenship -
                                                    By Naturalization</option>
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
                                            <input type="text" class="form-control" id="lotNo" name="lotNo"
                                                placeholder="House/Block/Lot No.">
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="street" name="street"
                                                placeholder="Street">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="barangay" name="barangay"
                                                placeholder="Barangay">
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="subdivision" name="subdivision"
                                                placeholder="Subdivision/Village">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="city" name="city"
                                                placeholder="City/Municipality">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="province" name="province"
                                                placeholder="Province">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="number" class="form-control" id="zipcode" name="zipcode"
                                                placeholder="ZIP Code">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="permanentAddress">Permanent Address:</label>
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="lotNo_permanent"
                                                name="lotNo_permanent" placeholder="House/Block/Lot No.">
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="street_permanent"
                                                name="street_permanent" placeholder="Street">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="barangay_permanent"
                                                name="barangay_permanent" placeholder="Barangay">
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <input type="text" class="form-control" id="subdivision_permanent"
                                                name="subdivision_permanent" placeholder="Subdivision/Village">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="city_permanent"
                                                name="city_permanent" placeholder="City/Municipality">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="province_permanent"
                                                name="province_permanent" placeholder="Province">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="zipcode_permanent"
                                                name="zipcode_permanent" placeholder="ZIP Code">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="contacts">Contacts:</label>
                                        <div class="col-sm-4 mb-1">
                                            <input type="tel" class="form-control" id="telephone" name="telephone"
                                                placeholder="Telephone">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="tel" class="form-control" id="mobile" name="mobile"
                                                placeholder="Phone/Mobile">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <h3 class="text-center mb-2 mt-2">II. Family Background</h3>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="spouseName">Spouse's Full Name:</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_surname"
                                                name="spouse_surname" placeholder="Spouse's Surname">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_firstname"
                                                name="spouse_firstname" placeholder="First Name">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_middlename"
                                                name="spouse_middlename" placeholder="Middle Name">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_extensionname"
                                                name="spouse_extensionname" placeholder="Extension Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="spouseInfo">Spouse's Additional Info:</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_occupation"
                                                name="spouse_occupation" placeholder="Occupation">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_employer"
                                                name="spouse_employer" placeholder="Employer/Business Name">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_business_address"
                                                name="spouse_business_address" placeholder="Business Address">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="spouse_telephone"
                                                name="spouse_telephone" placeholder="Telephone">
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
                                                    <input type="text" class="childName form-control"
                                                        name="childName[]">
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="childDOB">Date of Birth:</label>
                                                    <input type="date" class="childDOB form-control" name="childDOB[]">
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="childDOB">Add Child:</label>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="addChild()">Add Child</button>
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
                                            <input type="text" class="form-control" id="father_surname"
                                                name="father_surname" placeholder="Fathers Surname">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="father_firstname"
                                                name="father_firstname" placeholder="First Name">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="father_middlename"
                                                name="father_middlename" placeholder="Middle Name">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="father_extension"
                                                name="father_extension" placeholder="Extension Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="mother">Mother's Full Name:</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="mother_maiden"
                                                name="mother_maiden" placeholder="Mother's Maiden Name">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="mother_surname"
                                                name="mother_surname" placeholder="Surname">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="mother_firstname"
                                                name="mother_firstname" placeholder="First Name">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="mother_middlename"
                                                name="mother_middlename" placeholder="Middle Name">
                                        </div>
                                    </div>
                                </div>

                                <h3 class="text-center mb-2 mt-2">III. Educational Background</h3>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="elementary">Elementary</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="elem_nameOfSchool"
                                                name="elem_nameOfSchool" placeholder="Name Of School (Write in full)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="elem_degree" name="elem_degree"
                                                placeholder="Basic Education/Degree/Course">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="elem_from" name="elem_from"
                                                placeholder="From (Year)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="elem_to" name="elem_to"
                                                placeholder="To (Year)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="elem_high" name="elem_high"
                                                placeholder="Highest Level (if not grad)">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="elem_grad" name="elem_grad"
                                                placeholder="Year Graduated">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="elem_honor" name="elem_honor"
                                                placeholder="Scholar/Honors Received">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="secondary">Secondary</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="sec_nameOfSchool"
                                                name="sec_nameOfSchool" placeholder="Name Of School (Write in full)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="sec_degree" name="sec_degree"
                                                placeholder="Basic Education/Degree/Course">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="sec_from" name="sec_from"
                                                placeholder="From (Year)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="sec_to" name="sec_to"
                                                placeholder="To (Year)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="sec_high" name="sec_high"
                                                placeholder="Highest Level (if not grad)">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="sec_grad" name="sec_grad"
                                                placeholder="Year Graduated">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="sec_honor" name="sec_honor"
                                                placeholder="Scholar/Honors Received">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="vacational">Vocational/Trade Course</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="voc_nameOfSchool"
                                                name="voc_nameOfSchool" placeholder="Name Of School (Write in full)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="voc_degree" name="voc_degree"
                                                placeholder="Basic Education/Degree/Course">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="voc_from" name="voc_from"
                                                placeholder="From (Year)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="voc_to" name="voc_to"
                                                placeholder="To (Year)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="voc_high" name="voc_high"
                                                placeholder="Highest Level (if not grad)">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="voc_grad" name="voc_grad"
                                                placeholder="Year Graduated">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="voc_honor" name="voc_honor"
                                                placeholder="Scholar/Honors Received">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="college">College</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="college_nameOfSchool"
                                                name="college_nameOfSchool"
                                                placeholder="Name Of School (Write in full)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="college_degree"
                                                name="college_degree" placeholder="Basic Education/Degree/Course">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="college_from"
                                                name="college_from" placeholder="From (Year)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="college_to" name="college_to"
                                                placeholder="To (Year)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="college_high"
                                                name="college_high" placeholder="Highest Level (if not grad)">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="college_grad"
                                                name="college_grad" placeholder="Year Graduated">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="college_honor"
                                                name="college_honor" placeholder="Scholar/Honors Received">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="gradStud">Graduate Studies</label>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="grad_nameOfSchool"
                                                name="grad_nameOfSchool" placeholder="Name Of School (Write in full)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="grad_degree" name="grad_degree"
                                                placeholder="Basic Education/Degree/Course">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="grad_from" name="grad_from"
                                                placeholder="From (Year)">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" id="grad_to" name="grad_to"
                                                placeholder="To (Year)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="grad_high" name="grad_high"
                                                placeholder="Highest Level (if not grad)">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="grad_grad" name="grad_grad"
                                                placeholder="Year Graduated">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" id="grad_honor" name="grad_honor"
                                                placeholder="Scholar/Honors Received">
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
                                            <input type="text" class="form-control" placeholder="CSE/RA 1080 etc."
                                                name="eligibility[]" id="eligibility">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="Rating" name="rating[]"
                                                id="rating">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="Date of Examination"
                                                name="exam_date[]" id="exam_date">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="Place of examination"
                                                name="exam_place[]" id="exam_place">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="License Number"
                                                name="license_number[]" id="license_number">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="Date of Validity"
                                                name="validity_date[]" id="validity_date">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger delete-eligibility"
                                        style="display: none;">Delete</button>
                                </div>

                                <!-- Button to add a new eligibility section -->
                                <button type="button" class="btn btn-primary add-eligibility mb-2">Add
                                    Eligibility</button>

                                <!-- Container to hold the dynamically added sections -->
                                <div class="eligibility-container">
                                </div>

                                <h3 class="text-center mb-2 mt-2">V. WORK EXPERIENCE</h3>

                                <!-- Template for a work experience section -->
                                <div class="work-experience-template form-group">
                                    <div class="row">
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" placeholder="Position Title"
                                                name="position_title[]" id="position_title">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" placeholder="Department"
                                                name="department[]" id="department">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" placeholder="Monthly Salary"
                                                name="monthly_salary[]" id="monthly_salary">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" placeholder="salary/job/pay"
                                                name="salary_type[]" id="salary_type">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" placeholder="status of appointment"
                                                name="appointment_status[]" id="appointment_status">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="date" class="form-control" placeholder="From"
                                                name="work_from_date[]" id="work_from_date">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="date" class="form-control" placeholder="To"
                                                name="work_to_date[]" id="work_to_date">
                                        </div>
                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control" placeholder="Gov't Service? Y/N"
                                                name="govt_service[]" id="govt_service">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger delete-work-experience"
                                        style="display: none;">Delete</button>
                                </div>

                                <!-- Button to add a new work experience section -->
                                <button type="button" class="btn btn-primary add-work-experience mb-2">Add Work
                                    Experience</button>

                                <!-- Container to hold the dynamically added sections -->
                                <div class="work-experience-container">
                                </div>

                                <button type="button" class="btn btn-primary next float-end m-2">Next
                                    <i data-feather="arrow-right"></i>
                                </button>
                                <button type="button" class="btn btn-secondary prev float-end m-2">Previous</button>
                            </div>

                            <!-- Page 4 (Hidden by default) -->
                            <div class="page" id="page4" style="display: none;">
                                <!-- Your Page 4 content -->
                                <h3 class="text-center mb-2 mt-2">VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC /
                                    NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S</h3>

                                <!-- Template for a voluntary work section -->
                                <div class="voluntary-work-template form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control"
                                                placeholder="Name & Address of Organization" name="organization_name[]">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control"
                                                placeholder="Position/Nature of Work" name="work_position[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" placeholder="Number of Hours"
                                                name="hours_worked[]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" placeholder="From"
                                                name="work_from_date[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" placeholder="To"
                                                name="work_to_date[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-danger delete-voluntary-work"
                                                style="display: none;">Delete</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button to add a new voluntary work section -->
                                <button type="button" class="btn btn-primary add-voluntary-work mb-2">Add Voluntary
                                    Work</button>

                                <!-- Container to hold the dynamically added sections -->
                                <div class="voluntary-work-container">
                                </div>

                                <h3 class="text-center mb-2 mt-2">VII. LEARNING AND DEVELOPMENT (L&D)
                                    INTERVENTIONS/TRAINING PROGRAMS ATTENDED</h3>

                                <!-- Template for an L&D section -->
                                <div class="ld-template form-group">
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control"
                                                placeholder="Title of L&D Interventions/Training" name="ld_title[]">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control"
                                                placeholder="Type of LD (Managerial/Supervisor)" name="ld_type[]">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="Conducted/Sponsored by"
                                                name="ld_sponsor[]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="Number of Hours"
                                                name="ld_hours[]">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="From (Start)"
                                                name="ld_start_date[]">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" placeholder="To (Finish)"
                                                name="ld_finish_date[]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-danger delete-ld"
                                                style="display: none;">Delete</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button to add a new L&D section -->
                                <button type="button" class="btn btn-primary add-ld mb-2">Add L&D Section</button>

                                <!-- Container to hold the dynamically added L&D sections -->
                                <div class="ld-container">
                                </div>

                                <h3 class="text-center mb-2 mt-2">VIII. Other Information</h3>

                                <!-- Template for Special Skills and Hobbies section -->
                                <div class="skills-template form-group">
                                    <div class="row">
                                        <div class="col-sm-10 mb-1">
                                            <input type="text" class="form-control"
                                                placeholder="Special Skills and Hobbies" name="skills[]">
                                        </div>
                                        <div class="col-sm-2 mb-1">
                                            <button type="button" class="btn btn-danger delete-skill"
                                                style="display: none;">Delete</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button to add the first Special Skills and Hobbies section -->
                                <button type="button" class="btn btn-primary add-skill mb-2">Add Special
                                    Skill/Hobby</button>

                                <!-- Container to hold the dynamically added Special Skills and Hobbies sections -->
                                <div class="skills-container">
                                </div>

                                <!-- Template for Non-Academic Distinctions/Recognition section -->
                                <div class="distinctions-template form-group">
                                    <div class="row">
                                        <div class="col-sm-10 mb-1">
                                            <input type="text" class="form-control"
                                                placeholder="Non-Academic Distinctions/Recognition"
                                                name="distinctions[]">
                                        </div>
                                        <div class="col-sm-2 mb-1">
                                            <button type="button" class="btn btn-danger delete-distinction"
                                                style="display: none;">Delete</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button to add the first Non-Academic Distinctions/Recognition section -->
                                <button type="button" class="btn btn-primary add-distinction mb-2">Add
                                    Distinction/Recognition</button>

                                <!-- Container to hold the dynamically added Non-Academic Distinctions/Recognition sections -->
                                <div class="distinctions-container">
                                </div>

                                <!-- Template for Membership in Association/Organization section -->
                                <div class="membership-template form-group">
                                    <div class="row">
                                        <div class="col-sm-10 mb-1">
                                            <input type="text" class="form-control"
                                                placeholder="Membership in Association/Organization"
                                                name="memberships[]">
                                        </div>
                                        <div class="col-sm-2 mb-1">
                                            <button type="button" class="btn btn-danger delete-membership"
                                                style="display: none;">Delete</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button to add the first Membership in Association/Organization section -->
                                <button type="button" class="btn btn-primary add-membership mb-2">Add
                                    Membership</button>

                                <!-- Container to hold the dynamically added Membership in Association/Organization sections -->
                                <div class="membership-container">
                                </div>


                                <button type="button" class="btn btn-primary next float-end m-2">Next
                                    <i data-feather="arrow-right"></i>
                                </button>
                                <button type="button" class="btn btn-secondary prev float-end m-2">Previous</button>
                            </div>

                            <!-- Page 5 (Hidden by default) -->
                            <div class="page" id="page5" style="display: none;">
                                <!-- Your Page 5 content -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>34. Are you related by consanguinity or affinity to the appointing or
                                            recommending authority, or to the chief of bureau or office or to the person
                                            who has immediate supervision over you in the Office, Bureau, or Department
                                            where you will be appointed?</h6>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <h6>a. within the third degree?</h6>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="related_a" value="Yes"
                                                id="related_a_yes"> Yes
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="related_a" value="No"
                                                id="related_a_no"> No
                                        </label>
                                        <div class="details-input-a">
                                            <label for="related_details_a">If YES, give details</label>
                                            <input type="text" class="form-control" id="related_details_a"
                                                name="related_details_a">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <h6>b. within the fourth degree (for Local Government Unit - Career Employees)?
                                        </h6>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="related_b" value="Yes"
                                                id="related_b_yes"> Yes
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="related_b" value="No"
                                                id="related_b_no"> No
                                        </label>
                                        <div class="details-input-b">
                                            <label for="related_details_b">If YES, give details</label>
                                            <input type="text" class="form-control" id="related_details_b"
                                                name="related_details_b">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-1">
                                        <h6>35.</h6><br>
                                        <h6>a. Have you ever been found guilty of any administrative offense?</h6>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="guilty_admin_offense"
                                                value="Yes" id="guilty_admin_yes"> Yes
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="guilty_admin_offense"
                                                value="No" id="guilty_admin_no"> No
                                        </label>
                                        <div class="details-input-a">
                                            <label for="guilty_admin_details">If YES, give details</label>
                                            <input type="text" class="form-control" id="guilty_admin_details"
                                                name="guilty_admin_details">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <h6>b. Have you been criminally charged before any court?</h6>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="criminal_charged"
                                                value="Yes" id="criminal_charged_yes"> Yes
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="criminal_charged"
                                                value="No" id="criminal_charged_no"> No
                                        </label>
                                        <div class="details-input-b">
                                            <label for="if yes">If YES, give details</label> <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="criminal_charged_date">Date Filed:</label>
                                                    <input type="text" class="form-control" id="criminal_charged_date"
                                                        name="criminal_charged_date">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="criminal_charged_status">Status of Case/s:</label>
                                                    <input type="text" class="form-control" id="criminal_charged_status"
                                                        name="criminal_charged_status">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-1">
                                        <h6>36. Have you ever been convicted of any crime or violation of any law,
                                            decree, ordinance or regulation by any court or tribunal?</h6>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="crime_violation"
                                                value="Yes" id="crime_violation_yes"> Yes
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="crime_violation"
                                                value="No" id="crime_violation_no"> No
                                        </label>
                                        <div class="details-input-a">
                                            <label for="crime_violation_details">If YES, give details</label>
                                            <input type="text" class="form-control" id="crime_violation_details"
                                                name="crime_violation_details">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-1">
                                        <h6>37. Have you ever been separated from the service in any of the following
                                            modes: resignation, retirement, dropped from the rolls, dismissal,
                                            termination, end of term, finished contract or phased out (abolition) in the
                                            public or private sector?</h6>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="seperated_service"
                                                value="Yes" id="seperated_service_yes"> Yes
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="seperated_service"
                                                value="No" id="seperated_service_no"> No
                                        </label>
                                        <div class="details-input-a">
                                            <label for="seperated_service_details">If YES, give details</label>
                                            <input type="text" class="form-control" id="seperated_service_details"
                                                name="seperated_service_details">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-1">
                                        <h6>38. </h6><br>
                                        <h6>a. Have you ever been a candidate in a national or local election held
                                            within the last year (except Barangay election)?</h6>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="candidate" value="Yes"
                                                id="candidate_yes"> Yes
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="candidate" value="No"
                                                id="candidate_no"> No
                                        </label>
                                        <div class="details-input-a">
                                            <label for="candidate_details">If YES, give details</label>
                                            <input type="text" class="form-control" id="candidate_details"
                                                name="candidate_details">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <h6>b. Have you resigned from the government service during the three (3)-month
                                            period before the last election to promote/actively campaign for a national
                                            or local candidate?</h6>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="q38b" value="Yes"
                                                id="q38b_yes"> Yes
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="q38b" value="No"
                                                id="q38b_no"> No
                                        </label>
                                        <div class="details-input-a">
                                            <label for="q38b_details">If YES, give details</label>
                                            <input type="text" class="form-control" id="q38b_details"
                                                name="q38b_details">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-1">
                                        <h6>39. Have you acquired the status of an immigrant or permanent resident of
                                            another country?</h6>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="q39" value="Yes"
                                                id="q39_yes"> Yes
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="q39" value="No"
                                                id="q39_no"> No
                                        </label>
                                        <div class="details-input-a">
                                            <label for="q39_details">If YES, give details (country):</label>
                                            <input type="text" class="form-control" id="q39_details" name="q39_details">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-1">
                                        <h6>40. Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for
                                            Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA
                                            8972), please answer the following items:</h6><br>
                                        <h6>a. Are you a member of any indigenous group?</h6>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="q40a" value="Yes"
                                                id="q40a_yes"> Yes
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="q40a" value="No"
                                                id="q40a_no"> No
                                        </label>
                                        <div class="details-input-a">
                                            <label for="q40a_details">If YES, please specify:</label>
                                            <input type="text" class="form-control" id="q40a_details"
                                                name="q40a_details">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <h6>b. Are you a person with disability?</h6>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="q40b" value="Yes"
                                                id="q40b_yes"> Yes
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="q40b" value="No"
                                                id="q40b_no"> No
                                        </label>
                                        <div class="details-input-a">
                                            <label for="q40b_details">If YES, please specify ID No:</label>
                                            <input type="text" class="form-control" id="q40b_details"
                                                name="q40b_details">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <h6>c. Are you a solo parent?</h6>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="q40c" value="Yes"
                                                id="q40c_yes"> Yes
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="q40c" value="No"
                                                id="q40c_no"> No
                                        </label>
                                        <div class="details-input-a">
                                            <label for="q40c_details">If YES, please specify ID No:</label>
                                            <input type="text" class="form-control" id="q40c_details"
                                                name="q40c_details">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h6>41. References <span class="text-danger">
                                            (Person not related by consanguinity or
                                            affinity to applicant /appointee)
                                        </span></h6>
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" name="ref_name_1"
                                                placeholder="Full Name">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" name="ref_address_1"
                                                placeholder="Address">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" name="ref_number_1"
                                                placeholder="Tel/Mobile No.">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" name="ref_name_2"
                                                placeholder="Full Name">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" name="ref_address_2"
                                                placeholder="Address">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" name="ref_number_2"
                                                placeholder="Tel/Mobile No.">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" name="ref_name_3"
                                                placeholder="Full Name">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" name="ref_address_3"
                                                placeholder="Address">
                                        </div>
                                        <div class="col-sm-4 mb-1">
                                            <input type="text" class="form-control" name="ref_number_3"
                                                placeholder="Tel/Mobile No.">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary next float-end m-2">Submit <i
                                        data-feather="arrow-right"></i></button>
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
    clone.style.display = 'block';

    // Clear the input fields in the cloned section
    const inputs = clone.querySelectorAll('input');
    inputs.forEach((input) => {
        input.value = ''; // Clear the input value
    });

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

function addWorkExperienceSection() {
    const template = document.querySelector('.work-experience-template');
    const clone = template.cloneNode(true);
    clone.classList.remove('work-experience-template');

    // Clear the input fields in the cloned section
    const inputs = clone.querySelectorAll('input');
    inputs.forEach((input) => {
        input.value = ''; // Clear the input value
    });

    // Show the "Delete" button for the new section
    const deleteButton = clone.querySelector('.delete-work-experience');
    deleteButton.style.display = 'inline-block';

    // Attach a click event to the "Delete" button of the new section
    deleteButton.addEventListener('click', function() {
        clone.remove(); // Delete the section when the "Delete" button is clicked
    });

    const container = document.querySelector('.work-experience-container');
    container.appendChild(clone);
}

// Event listener for the "Add Work Experience" button
const addWorkExperienceButton = document.querySelector('.add-work-experience');
addWorkExperienceButton.addEventListener('click', addWorkExperienceSection);

function addVoluntaryWorkSection() {
    const template = document.querySelector('.voluntary-work-template');
    const clone = template.cloneNode(true);
    clone.classList.remove('voluntary-work-template');

    // Clear the input fields in the cloned section
    const inputs = clone.querySelectorAll('input');
    inputs.forEach((input) => {
        input.value = ''; // Clear the input value
    });

    // Show the "Delete" button for the new section
    const deleteButton = clone.querySelector('.delete-voluntary-work');
    deleteButton.style.display = 'inline-block';

    // Attach a click event to the "Delete" button of the new section
    deleteButton.addEventListener('click', function() {
        clone.remove(); // Delete the section when the "Delete" button is clicked
    });

    const container = document.querySelector('.voluntary-work-container');
    container.appendChild(clone);
}

// Event listener for the "Add Voluntary Work" button
const addVoluntaryWorkButton = document.querySelector('.add-voluntary-work');
addVoluntaryWorkButton.addEventListener('click', addVoluntaryWorkSection);

function addLDSection() {
    const template = document.querySelector('.ld-template');
    const clone = template.cloneNode(true);
    clone.classList.remove('ld-template');

    // Clear the input fields in the cloned section
    const inputs = clone.querySelectorAll('input');
    inputs.forEach((input) => {
        input.value = ''; // Clear the input value
    });

    // Show the "Delete" button for the new section
    const deleteButton = clone.querySelector('.delete-ld');
    deleteButton.style.display = 'inline-block';

    // Attach a click event to the "Delete" button of the new section
    deleteButton.addEventListener('click', function() {
        clone.remove(); // Delete the section when the "Delete" button is clicked
    });

    const container = document.querySelector('.ld-container');
    container.appendChild(clone);
}

// Event listener for the "Add L&D Section" button
const addLDButton = document.querySelector('.add-ld');
addLDButton.addEventListener('click', addLDSection);

function addSkillSection() {
    const template = document.querySelector('.skills-template');
    const clone = template.cloneNode(true);
    clone.classList.remove('skills-template');

    // Clear the input fields in the cloned section
    const input = clone.querySelector('input');
    input.value = ''; // Clear the input value

    // Show the "Delete" button for the new section
    const deleteButton = clone.querySelector('.delete-skill');
    deleteButton.style.display = 'inline-block';

    // Attach a click event to the "Delete" button of the new section
    deleteButton.addEventListener('click', function() {
        clone.remove(); // Delete the section when the "Delete" button is clicked
    });

    const container = document.querySelector('.skills-container');
    container.appendChild(clone);
}

// Event listener for the "Add Special Skill/Hobby" button
const addSkillButton = document.querySelector('.add-skill');
addSkillButton.addEventListener('click', addSkillSection);


function addDistinctionSection() {
    const template = document.querySelector('.distinctions-template');
    const clone = template.cloneNode(true);
    clone.classList.remove('distinctions-template');

    // Clear the input fields in the cloned section
    const input = clone.querySelector('input');
    input.value = ''; // Clear the input value

    // Show the "Delete" button for the new section
    const deleteButton = clone.querySelector('.delete-distinction');
    deleteButton.style.display = 'inline-block';

    // Attach a click event to the "Delete" button of the new section
    deleteButton.addEventListener('click', function() {
        clone.remove(); // Delete the section when the "Delete" button is clicked
    });

    const container = document.querySelector('.distinctions-container');
    container.appendChild(clone);
}

// Event listener for the "Add Distinction/Recognition" button
const addDistinctionButton = document.querySelector('.add-distinction');
addDistinctionButton.addEventListener('click', addDistinctionSection);


function addMembershipSection() {
    const template = document.querySelector('.membership-template');
    const clone = template.cloneNode(true);
    clone.classList.remove('membership-template');

    // Clear the input fields in the cloned section
    const input = clone.querySelector('input');
    input.value = ''; // Clear the input value

    // Show the "Delete" button for the new section
    const deleteButton = clone.querySelector('.delete-membership');
    deleteButton.style.display = 'inline-block';

    // Attach a click event to the "Delete" button of the new section
    deleteButton.addEventListener('click', function() {
        clone.remove(); // Delete the section when the "Delete" button is clicked
    });

    const container = document.querySelector('.membership-container');
    container.appendChild(clone);
}

// Event listener for the "Add Membership" button
const addMembershipButton = document.querySelector('.add-membership');
addMembershipButton.addEventListener('click', addMembershipSection);

</script>


<?php
include('../includes/footer.php');
?>