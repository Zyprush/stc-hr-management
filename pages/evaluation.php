<?php
include('../config/dbcon.php');
include('../includes/header.php');
include('../config/authentication.php');
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
                            <span> Offices</span> </a>
                    </li>
                    <li class="menu">
                        <a href="employee.php"><i data-feather="user"></i>
                            <span> Employee</span> </a>
                    </li>
                    <li class="active">
                        <a href="evaluation.php"><i data-feather="bar-chart-2"></i>
                            <span> Evaluation</span> </a>
                    </li>
                    <li class="menu">
                        <a href="report.php"><i data-feather="calendar"></i>
                            <span> Report </span> </a>
                    </li>
                    <li class="menu">
                        <a href="activities.php"><i data-feather="activity"></i>
                            <span> Promotion</span> </a>
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
            <div class="page-header">
                <div class="page-title">
                    <h4>Evaluation</h4>
                    <h6>Manage Evaluation</h6>
                </div>
                <div class="page-btn">
                    <!--
                        <a href="#" class="btn btn-added" data-toggle="modal" data-target="#exampleModalCenter">
                            <img src="../assets/img/icons/plus.svg" alt="img" class="me-1"> Add Employee
                        </a>
                        <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                            <img src="../assets/img/icons/plus.svg" alt="img" class="me-1">Add Employee
                        </a>
                    -->
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                        </div>
                        <div class="wordset">
                            <ul>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="../assets/img/icons/pdf.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="../assets/img/icons/excel.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="../assets/img/icons/printer.svg" alt="img"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="event_table" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Item No.</th>
                                    <th>Office</th>
                                    <th>Full Name</th>
                                    <th>Type of Employment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('../includes/footer.php');
?>

<script>
    $(document).ready(function() {
        var table = $('#event_table').DataTable({
            "ajax": {
                "url": "../config/fetch_evaluation.php",
                "type": "POST",
                "dataSrc": ""
            },
            "columns": [{
                    "data": "ID",
                    "visible": false
                },
                {
                    "data": "itemNo"
                },
                {
                    "data": "office"
                },
                {
                    "data": "name"
                },
                {
                    "data": "employment"
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        // Add action buttons here for edit, delete, etc.
                        return `
                        <a class="view-button m-1" data-record-id="${row.ID}" href="#">
                            <img src="../assets/img/icons/eye.svg" alt="View">
                        </a>
                `;
                    }
                }
            ]
        });
    });


    $('#event_table tbody').on('click', '.view-button', function(event) {
        event.preventDefault(); // Prevent default link behavior

        var button = $(this);
        var recordId = $(button).data('record-id');

        // Open the PDF file using the constructed file name
        window.open('evaluation-child.php?id=' + recordId);
    });
</script>