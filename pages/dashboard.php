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
            <a id="toggle_btn" href="#">
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

            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <img src="../assets/img/icons/notification-bing.svg" alt="img" />
                    <span class="badge rounded-pill">0</span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Events Notifications</span>
                        <a href="#" class="clear-noti" hidden> Clear All </a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <script>
                                $(document).ready(function() {
                                    $.ajax({
                                        url: '../config/fetch_event.php',
                                        type: 'GET',
                                        dataType: 'json',
                                        success: function(events) {
                                            if (events.length > 0) {
                                                displayNotifications(events);
                                            }
                                        },
                                        error: function(error) {
                                            console.error('Error fetching events:', error);
                                        }
                                    });

                                    // Add click event for clearing notifications
                                    $('.clear-noti').on('click', function() {
                                        clearNotifications();
                                    });
                                });

                                function displayNotifications(events) {
                                    const notificationList = $('.notification-list');
                                    const notificationCount = $('.badge');

                                    // Clear existing notifications
                                    notificationList.empty();

                                    events.forEach(function(event) {
                                        const currentDateTime = new Date();
                                        const formattedCurrentDateTime = currentDateTime.toLocaleString();

                                        const eventDateTime = new Date(event.event_start_date + ' ' + event.event_time);
                                        const timeDifference = currentDateTime - eventDateTime;
                                        const hoursDifference = Math.floor(timeDifference / (1000 * 60 * 60));

                                        const timeAgo = getTimeAgo(timeDifference);

                                        // Display notification for both future and past events
                                        const notificationHTML = `
                                            <li class="notification-message">
                                                <a href="#">
                                                    <div class="media d-flex">
                                                        <span class="avatar flex-shrink-0">
                                                            <img alt="" src="../assets/img/event_notif.png" />
                                                        </span>
                                                        <div class="media-body flex-grow-1">
                                                            <p class="noti-details">
                                                                <span class="noti-title">${event.event_name}</span>
                                                                ${hoursDifference >= 0 ?
                                                                    `started ${timeAgo}` :
                                                                    `will start ${formatEventDateTime(eventDateTime)}`}
                                                            </p>
                                                            <p class="noti-time">
                                                                <span class="notification-time">${formattedCurrentDateTime}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        `;
                                        notificationList.append(notificationHTML);
                                    });

                                    // Update the notification badge count
                                    notificationCount.text(events.length);
                                }

                                function clearNotifications() {
                                    // You can implement logic to clear notifications here
                                    // For example, you might want to remove notifications from local storage or mark them as read in the database
                                    // Then, you can update the UI accordingly
                                    const notificationList = $('.notification-list');
                                    const notificationCount = $('.badge');

                                    // Clear existing notifications
                                    notificationList.empty();

                                    // Update the notification badge count to 0
                                    notificationCount.text('0');
                                }

                                function getTimeAgo(milliseconds) {
                                    const seconds = Math.floor(milliseconds / 1000);
                                    if (seconds < 60) {
                                        return `${seconds} second${seconds > 1 ? 's' : ''} ago`;
                                    } else if (seconds < 3600) {
                                        const minutes = Math.floor(seconds / 60);
                                        return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
                                    } else {
                                        const hours = Math.floor(seconds / 3600);
                                        return `${hours} hour${hours > 1 ? 's' : ''} ago`;
                                    }
                                }

                                function formatEventDateTime(eventDateTime) {
                                    const options = {
                                        hour: 'numeric',
                                        minute: 'numeric'
                                    };
                                    return `today at ${eventDateTime.toLocaleTimeString('en-US', options)}`;
                                }
                            </script>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="#" hidden>View all NoÏtifications</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="#" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
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
                        <a class="dropdown-item" href="settings.php"><i class="me-2" data-feather="settings"></i>Settings</a>
                        <hr class="m-0">
                        <a class="dropdown-item logout pb-0" href="../config/logout.php"><img src="../assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
                    </div>
                </div>
            </li>

        </ul>

        <div class="dropdown mobile-user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.php">My Profile</a>
                <a class="dropdown-item" href="settings.php">Settings</a>
                <a class="dropdown-item" href="../config/logout.php">Logout</a>
            </div>
        </div>
    </div>

    <?php include('../includes/sidebar.php'); ?>

    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <a href="department.php" class="text-black">
                        <div class="card shadow">
                            <?php include('../config/department_count.php'); ?>
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
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <a href="employee.php" class="text-black">
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
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <a href="employee-jo.php" class="text-black">
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
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <a href="#expired_table" class="text-black">
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
                    </a>
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

            <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                                            <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Enter your event name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="event_start_date">Event start</label>
                                            <input type="date" name="event_start_date" id="event_start_date" class="form-control onlydatepicker" placeholder="Event start date">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="event_end_date">Event end</label>
                                            <input type="date" name="event_end_date" id="event_end_date" class="form-control" placeholder="Event end date">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="event_time">Event Time</label>
                                                <input type="time" name="event_time" id="event_time" class="form-control">
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

            <div class="row" id="expired_table">
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

    // Define a fixed set of colors
    var fixedColors = ['#FF5733', '#33FF57', '#5733FF', '#FF33A1', '#33A1FF', '#A1FF33'];

    var myDoughnutChart = new Chart(ctxD, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: fixedColors,
                hoverBackgroundColor: fixedColors.map(function(color) {
                    // Adjust hover colors if needed
                    // For simplicity, I'm making it slightly darker here
                    return color.replace(/(..)/g, function(colorPart) {
                        return ('0' + Math.max(0, parseInt(colorPart, 16) - 20).toString(16)).slice(-2);
                    });
                })
            }]
        },
        options: {
            responsive: true
        }
    });
</script>