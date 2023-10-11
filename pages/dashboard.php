<?php
include('../includes/header.php');
include('../config/authentication.php');
include('../config/department_count.php');
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
                    <li class="active">
                        <a href="dashboard.php"><img src="../assets/img/icons/dashboard.svg" alt="img"><span> Dashboard</span> </a>
                    </li>
                    <li class="menu">
                        <a href="department.php"><img src="../assets/img/icons/places.svg" alt="img"><span> Department</span> </a>
                    </li>
                    <li class="menu">
                        <a href="employee.php"><img src="../assets/img/icons/users1.svg" alt="img"><span> Employee</span> </a>
                    </li>
                    <li class="menu">
                        <a href="report.php"><img src="../assets/img/icons/time.svg" alt="img"><span> Report</span> </a>
                    </li>
                    <li class="menu">
                        <a href="event.php"><img src="../assets/img/icons/purchase1.svg" alt="img"><span> Event</span> </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-4 col-sm-3 col-12 d-flex">
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            <h4>100</h4>
                            <h5>Part-time Worker</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-3 col-12 d-flex">
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            <?php
                            if ($departmentCount > 0) {
                                echo "<h4>Total: $departmentCount</h4>";
                            } else {
                                echo "<h4>No data</h4>";
                            }
                            ?>
                            <h5>Departments</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file-text"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-3 col-12 d-flex">
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            <h4>100</h4>
                            <h5>Full time</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user-check"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Total Employee</h5>
                            <div class="dropdown">
                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="event.php" class="dropdown-item">Event List</a>
                                    </li>
                                    <li>
                                        <a href="add_event.php" class="dropdown-item">Add Event</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chartjs-wrapper-demo">
                                <canvas id="chartDonut" class="h-300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Events</h4>
                            <div class="dropdown">
                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="event.php" class="dropdown-item">Event List</a>
                                    </li>
                                    <li>
                                        <a href="add_event.php" class="dropdown-item">Add Event</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="card col-12 mb-2 p-1 bg-primary">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Event 1 <i class="fa fa-ellipsis-v"></i>
                                    </li>
                                </div>
                                <div class="card col-12 mb-2 p-1 bg-secondary">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Event 1 <i class="fa fa-ellipsis-v"></i>
                                    </li>
                                </div>
                                <div class="card col-12 mb-2 p-1 bg-warning">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Event 1 <i class="fa fa-ellipsis-v"></i>
                                    </li>
                                </div>
                                <div class="card col-12 mb-2 p-1 bg-danger">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Event 1 <i class="fa fa-ellipsis-v"></i>
                                    </li>
                                </div>
                                <div class="card col-12 mb-2 p-1 bg-primary">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Event 1 <i class="fa fa-ellipsis-v"></i>
                                    </li>
                                </div>
                                <div class="card col-12 mb-2 p-1 bg-success ">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Event 1 <i class="fa fa-ellipsis-v"></i>
                                    </li>
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