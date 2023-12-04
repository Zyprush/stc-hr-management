<?php
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
                    <li class="active">
                        <a href="dashboard.php"><i data-feather="home"></i>
                            <span> Dashboard</span> </a>
                    </li>
                    <li class="menu">
                        <a href="department.php"><i data-feather="users"></i>
                            <span> Offices</span> </a>
                    </li>
                    <li class="submenu">
                        <!-- Add "has-submenu" class to create dropdown -->
                        <a href="#"><i data-feather="user"></i>
                            <span> Employee</span> </a>
                        <ul class="submenu">
                            <!-- Dropdown submenu for Employee -->
                            <li><a href="employee.php">Permanent</a></li>
                            <li><a href="employee-jo.php">Job Order</a></li>
                            <li><a href="employee-file.php">File</a></li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="evaluation.php"><i data-feather="users"></i>
                            <span> Evaluation</span> </a>
                    </li>
                    <li class="menu">
                        <a href="training.php"><i data-feather="users"></i>
                            <span> Training</span> </a>
                    </li>
                    <li class="submenu">
                        <!-- Add "has-submenu" class to create dropdown -->
                        <a href="#"><i data-feather="calendar"></i>
                            <span> Report</span> </a>
                        <ul class="submenu">
                            <!-- Dropdown submenu for Report -->
                            <li><a href="benefits.php">Benefits</a></li>
                            <li><a href="promotion.php">Promotion</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <!-- Add "has-submenu" class to create dropdown -->
                        <a href="#"><i data-feather="settings"></i>
                            <span> Settings</span> </a>
                        <ul class="submenu">
                            <!-- Dropdown submenu for Settings -->
                            <li><a href="settings.php">Office</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="page-wrapper">
        <div class="content">

            <div class="page-header">
                <div class="page-title">
                    <h4>Dashboard</h4>
                    <h6>Dashboard</h6>
                </div>
                <div class="page-btn">
                    <!--
                        <a href="#" class="btn btn-added" data-toggle="modal" data-target="#exampleModalCenter">
                        <img src="../assets/img/icons/plus.svg" alt="img" class="me-1"> Add Department
                    </a>
                    -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="card shadow">
                        <?php include('../config/department_count.php');?>
                        <div class="card-header text-white" style="background-color: #377ede;">
                            <h5>Offices</h5>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h1 class="text-center" style="margin: auto;"><?php echo $departmentCount; ?></h1>
                            <!--
                                <a href="department.php" class="d-block p-2 rounded-3 pointer" style="background-color: #377ede;">
                                    <i class="fa fa-plus text-white"></i>
                                </a>
                            -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="card shadow">
                        <div class="card-header text-white" style="background-color: #6859f3;">
                            <h5>Permanent</h5>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h1 class="text-center" style="margin: auto;"><?php echo $permanent; ?></h1>
                            <!--
                                <a href="employee.php" class="d-block p-2 rounded-3 pointer" style="background-color: #6859f3;">
                                    <i class="fa fa-plus text-white"></i>
                                </a>
                            -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="card shadow">
                        <div class="card-header text-white" style="background-color: #e95c41;">
                            <h5>Job Order</h5>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h1 class="text-center" style="margin: auto;"><?php echo $jo; ?></h1>
                            <!--
                                <a href="employee.php" class="d-block p-2 rounded-3 pointer" style="background-color: #e95c41;">
                                    <i class="fa fa-plus text-white"></i>
                                </a>
                            -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="card shadow">
                        <div class="card-header text-white bg-danger">
                            <h5>Expiring Contract</h5>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h1 class="text-center" style="margin: auto;"><?php echo $expiring; ?></h1>
                            <!--
                                <a href="employee.php" class="d-block p-2 rounded-3 pointer" style="background-color: #e95c41;">
                                    <i class="fa fa-plus text-white"></i>
                                </a>
                            -->
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-lg-6 col-sm-12 col-12 d-flex">
                    <div class="card shadow flex-fill">
                        <?php include('../config/employee-chart.php'); ?>
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Total Employees per Office</h5>
                            <a href="employee.php"><i class="fa fa-plus"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="doughnutChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12 col-12 d-flex">
                    <div class="card shadow flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Events</h5>
                            <a href="#"><i class="fa fa-plus"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        asdasd
                                    </div>
                                </div>
                            </div>
                        </div>
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
var ctxD = document.getElementById("doughnutChart").getContext('2d');
var departmentCounts = <?php echo json_encode($departmentCounts); ?>;

var labels = Object.keys(departmentCounts);
var data = Object.values(departmentCounts);

var myDoughnutChart = new Chart(ctxD, {
    type: 'doughnut',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: ["#6859f3", "#e95c41", "#4a3aae", "#c04532"], // Add more colors if needed
            hoverBackgroundColor: ["#4a3aae", "#c04532", "#2e255c", "#a82a1f"]
        }]
    },
    options: {
        responsive: true
    }
});
</script>