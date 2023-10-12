<?php
include('../includes/header.php');
include('../config/authentication.php');
include('../config/department_count.php');
include('../config/fetch_events_dashboard.php');
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
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card shadow">
                        <div class="card-header text-white" style="background-color: #6859f3;">
                            <h5>Part-time Worker</h5>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center pt-5">
                            <h3> </h3>
                            <a href="employee.php" class="d-block p-2 rounded-3 pointer" style="background-color: #6859f3;">
                                <i class="fa fa-plus text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card shadow">
                        <div class="card-header text-white" style="background-color: #377ede;">
                            <h5>Department</h5>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center pt-5">
                            <h3> </h3>
                            <a href="department.php" class="d-block p-2 rounded-3 pointer" style="background-color: #377ede;">
                                <i class="fa fa-plus text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card shadow">
                        <div class="card-header text-white" style="background-color: #e95c41;">
                            <h5>Full-Time Worker</h5>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center pt-5">
                            <h3> </h3>
                            <a href="employee.php" class="d-block p-2 rounded-3 pointer" style="background-color: #e95c41;">
                                <i class="fa fa-plus text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-7 col-sm-12 col-12 d-flex">
                    <div class="card shadow flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Total Employees</h5>
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
                <div class="col-lg-5 col-sm-12 col-12 d-flex">
                    <div class="card shadow flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Events</h4>
                            <a href="event.php"><i class="fa fa-plus"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php
                                $colors = ['#20455a', '#fc6c74', '#f4cb8c']; // Define your colors here
                                $colorIndex = 0; // Initialize the color index

                                foreach ($events as $eventInfo) {
                                    // Get the current color from the array
                                    $color = $colors[$colorIndex];

                                    // Increment the color index, and wrap around if necessary
                                    $colorIndex = ($colorIndex + 1) % count($colors);
                                ?>
                                    <div class="card col-12 mb-2 p-1" style="border-left: 10px solid <?php echo $color; ?>;">
                                        <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            <?php echo $eventInfo; ?> <i class="fa fa-ellipsis-v"></i>
                                        </li>
                                    </div>
                                <?php
                                }
                                ?>
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
    var myDoughnutChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["Male", "Female"],
            datasets: [{
                data: [200, 300],
                backgroundColor: ["#6672fb", "#ff3d55"],
                hoverBackgroundColor: ["#3348db", "#d42644"]
            }]
        },
        options: {
            responsive: true
        }
    });
</script>