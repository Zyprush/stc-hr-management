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
            <div class="page-header">
                <div class="page-title">
                    <h4>Office List</h4>
                    <h6>Manage Offices</h6>
                </div>
                <div class="page-btn">
                    <a href="#" class="btn btn-added" data-toggle="modal" data-target="#exampleModalCenter">
                        <img src="../assets/img/icons/plus.svg" alt="img" class="me-1"> Add Office
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="department_table" class="table">
                            <thead>
                                <tr>
                                    <th>Office</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Add -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Office</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../config/add_department.php" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="departmentName">Office Name:</label>
                                        <input type="text" class="form-control" id="departmentName" name="departmentName" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit -->
            <div class="modal fade" id="editDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDepartmentModalLabel">Edit Office</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editDepartmentForm" action="../config/edit_department.php" method="post">
                                <input type="hidden" name="edit_department_id" id="edit_department_id">
                                <div class="form-group">
                                    <label for="edit_department_name">Office Name:</label>
                                    <input type="text" class="form-control" id="edit_department_name" name="edit_department_name">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
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
    // Fetch data from PHP using AJAX
    var selectRoot = document.getElementById('root');

    // AJAX request
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var departments = JSON.parse(xhr.responseText);

                // Update options in the dropdown
                departments.forEach(function(department) {
                    var option = document.createElement('option');
                    option.value = department['Department']; // Assuming 'Department' is the column name
                    option.textContent = department['Department']; // Assuming 'Department' is the column name
                    selectRoot.appendChild(option);
                });
            } else {
                console.error('Request failed: ' + xhr.status);
            }
        }
    };

    xhr.open('GET', '../config/get_departments_root.php', true);
    xhr.send();
</script>

<script>
    $(document).ready(function() {
        var table = $('#department_table').DataTable({
            "ajax": {
                "url": "../config/fetch_departments.php",
                "type": "POST",
                "dataSrc": ""
            },
            "columns": [{
                    "data": "Department"
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        // Add a data-attribute to store the record ID
                        return `
                        <a class=" m-1" data-record-id="${row.ID}" href="department_childs.php?id=${row.ID}">
                            <img src="../assets/img/icons/eye.svg" alt="View">
                        </a>
                    `;
                    }
                }
            ]
        });

        $('#department_table tbody').on('click', '.view-button', function(event) {
            event.preventDefault(); // Prevent default link behavior

            var button = $(this);
            var recordId = $(button).data('record-id');

            window.location.href('department_childs.php?id=' + recordId);
        });
    });
</script>