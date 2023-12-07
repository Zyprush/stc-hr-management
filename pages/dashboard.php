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
                        <a class="dropdown-item" href="profile.php"> <i class="me-2" data-feather="user"></i> My
                            Profile</a>
                        <a class="dropdown-item" href="settings.php"><i class="me-2"
                                data-feather="settings"></i>Settings</a>
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
                <a class="dropdown-item" href="profile.php">My Profile</a>
                <a class="dropdown-item" href="settings.php">Settings</a>
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
                            <?php
                            // Check if the user role is 'Admin'
                            if ($_SESSION['role'] === 'Admin') {
                                // If the role is 'Admin', display the list of users link
                                echo '<li><a href="users.php">List of Users</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="page-wrapper">
        <div class="content">

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
                        <!---->
                        <div class="card-header d-flex justify-content-between align-items-center pr-5">
                            <h5 style="font-size:18px;font-weight:700;color:#212b36;margin:0px 0 0px 20px;">Calendar Events</h5>
                            <a href="event.php"><i class="fa fa-eye"></i></a>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Add New Event</h5>
                        </div>
                        <div class="modal-body">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="event_name">Event name</label>
                                            <input type="text" name="event_name" id="event_name" class="form-control"
                                                placeholder="Enter your event name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="event_start_date">Event start</label>
                                            <input type="date" name="event_start_date" id="event_start_date"
                                                class="form-control onlydatepicker" placeholder="Event start date">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="event_end_date">Event end</label>
                                            <input type="date" name="event_end_date" id="event_end_date"
                                                class="form-control" placeholder="Event end date">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="event_time">Event Time</label>
                                                <input type="time" name="event_time" id="event_time"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="save_event()">Save Event</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="">
                    <div class="card shadow">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title">
                                List of Contract nearly expires
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="expire_table" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Employment</th>
                                            <th>Office</th>
                                            <th>Position</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
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
    </div>
</div>

<script>
$(document).ready(function() {
    display_events();

    var table = $('#expire_table').DataTable({
        "ajax": {
            "url": "../config/fetch_employees_expire.php",
            "type": "POST",
            "dataSrc": ""
        },
        "columns": [{
                "data": "ID",
                "visible": false
            },
            {
                "data": "name"
            },
            {
                "data": "employment"
            },
            {
                "data": "office"
            },
            {
                "data": "position"
            },
            {
                "data": "start"
            },
            {
                "data": "end"
            }
        ]
    });

}); //end document.ready block

function display_events() {
    var events = new Array();
    $.ajax({
        url: '../config/display_event.php',
        dataType: 'json',
        success: function(response) {

            var result = response.data;
            $.each(result, function(i, item) {
                events.push({
                    event_id: result[i].event_id,
                    title: result[i].title,
                    start: result[i].start,
                    end: result[i].end,
                    color: result[i].color,
                    time: result[i].time,
                    url: result[i].url
                });
            })
            var calendar = $('#calendar').fullCalendar({
                defaultView: 'month',
                timeZone: 'local',
                editable: true,
                selectable: true,
                selectHelper: true,
                select: function(start, end) {
                    //alert(start);
                    //alert(end);
                    $('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
                    $('#event_end_date').val(moment(end).format('YYYY-MM-DD'));
                    $('#event_entry_modal').modal('show');
                },
                events: events,
                eventRender: function(event, element, view) {
                    element.bind('click', function() {
                        // Show a confirmation dialog before deleting the event
                        alert('Event Title: ' + event.title + '\n' + 'Event Time: ' + event.time);
                    });
                }

            }); //end fullCalendar block	
        }, //end success block
        error: function(xhr, status) {
            alert(response.msg);
        }
    }); //end ajax block	
}

function save_event() {
    var event_name = $("#event_name").val();
    var event_start_date = $("#event_start_date").val();
    var event_end_date = $("#event_end_date").val();
    var event_time = $("#event_time").val();
    if (event_name == "" || event_start_date == "" || event_end_date == "" || event_time == "") {
        alert("Please enter all required details.");
        return false;
    }
    $.ajax({
        url: "../config/save_event.php",
        type: "POST",
        dataType: 'json',
        data: {
            event_name: event_name,
            event_start_date: event_start_date,
            event_end_date: event_end_date,
            event_time: event_time
        },
        success: function(response) {
            $('#event_entry_modal').modal('hide');
            if (response.status == true) {
                alert(response.msg);
                location.reload();
            } else {
                alert(response.msg);
            }
        },
        error: function(xhr, status) {
            console.log('ajax error = ' + xhr.statusText);
            alert(response.msg);
        }
    });
    return false;
}
</script>

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