<?php
include('../config/dbcon.php');
include('../includes/header.php');
include('../config/authentication.php')
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
                    <h4>User's Log</h4>
                    <h6>Manage User's Log</h6>
                </div>
                <div class="page-btn">
                    <!--
                        <a href="#" class="btn btn-added" data-toggle="modal" data-target="#exampleModalCenter">
                            <img src="../assets/img/icons/plus.svg" alt="img" class="me-1"> Add Employee
                        </a>
                        <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                            <img src="../assets/img/icons/plus.svg" alt="img" class="me-1">Add User
                        </a>
                    -->
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['status'])) {
                        if (!empty($_SESSION['status'])) {
                            echo $_SESSION['status'];
                            unset($_SESSION['status']);
                        } else {
                            echo "";
                        }
                    } else {
                        echo "";
                    }
                    ?>
                    <div class="table-responsive">
                        <table id="event_table" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Time of Login</th>
                                    <th>Time of Logout</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal for adding employee -->
            <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEmployeeModalLabel">Add User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Your form for adding a new employee -->
                            <form action="../config/signup.php" method="post" onsubmit="return validatePassword()">

                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="FullName" id="name" name="name" required />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Username" id="email" name="email" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Position" id="designation" name="designation" required />
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="department" id="department" required>
                                        <option value="">--Select Office--</option>
                                        <?php
                                        // Fetch department names from the 'departments' table
                                        $sql = "SELECT Department FROM departments";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $department = $row['Department'];
                                                echo "<option value='" . htmlspecialchars($department, ENT_QUOTES) . "'>$department</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No departments found</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input class="form-control" type="password" placeholder="Password" id="password" name="password" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="password" placeholder="Confirm Password" id="confirmPassword" name="confirmPassword" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="">--Select--</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>

                                <!-- Submit button for the form -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Edit Employee Modal -->
            <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEmployeeModalLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editEmployeeForm" action="../config/edit_user.php" method="post" onsubmit="return validateNewPassword()">
                                <input type="hidden" name="edit_user_id" id="edit_user_id">
                                <div class="form-group">
                                    <label for="edit_name">Name:</label>
                                    <input type="text" class="form-control" id="edit_name" name="edit_name">
                                </div>

                                <div class="form-group">
                                    <label for="edit_email">Username:</label>
                                    <input type="text" class="form-control" id="edit_email" name="edit_email">
                                </div>

                                <div class="form-group">
                                    <label for="edit_designation">Position:</label>
                                    <input type="text" class="form-control" id="edit_designation" name="edit_designation">
                                </div>

                                <div class="form-group">
                                    <label for="edit_department">Office:</label>
                                    <select class="form-control" id="edit_department" name="edit_department" required>
                                        <option value="">--Select--</option>
                                        <?php
                                        // Fetch department names from the 'departments' table
                                        $sql = "SELECT Department FROM departments";
                                        $result = $conn->query($sql);

                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $department = $row['Department'];
                                                echo "<option value='$department'>$department</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No departments found</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="edit_old_password">Current Password:</label>
                                    <input type="password" class="form-control" id="edit_old_password" name="edit_old_password">
                                </div>

                                <div class="form-group">
                                    <label for="edit_new_password">New Password:</label>
                                    <input type="password" class="form-control" id="edit_new_password" name="edit_new_password">
                                </div>

                                <div class="form-group">
                                    <label for="edit_re_new_password">Retype New Password:</label>
                                    <input type="password" class="form-control" id="edit_re_new_password" name="edit_re_new_password">
                                </div>

                                <div class="form-group">
                                    <label for="edit_role">User Type:</label>
                                    <select class="form-control" id="edit_role" name="edit_role" required>
                                        <option value="">--Select--</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
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
    $(document).ready(function() {
        var table = $('#event_table').DataTable({
            "ajax": {
                "url": "../config/fetch_user_logs.php",
                "type": "POST",
                "dataSrc": ""
            },
            "order": [
                [3, 'desc'] // 3 is the index of the 'login_time' column
            ],
            "columns": [{
                    "data": "id",
                    "visible": false
                },
                {
                    "data": "name",
                    "render": function(data, type, row) {
                        return data ? data : '<span style="color: red;">Deleted User</span>';
                    }
                },
                {
                    "data": "email",
                    "render": function(data, type, row) {
                        return data ? data : '<span style="color: red;">Deleted User</span>';
                    }
                },
                {
                    "data": "login_time",
                    "render": function(data, type, row) {
                        return formatDateTime(data);
                    }
                },
                {
                    "data": "logout_time",
                    "render": function(data, type, row) {
                        if (data !== row.login_time) {
                            return formatDateTime(data);
                        } else {
                            return '<span style="color: green;">Logged In</span>';
                        }
                    }
                },
                {
                    "data": null,
                    "visible": false,
                    "render": function(data, type, row) {
                        return `
                    <a class="m-1 delete-button" data-record-id="${row.id}" href="#">
                        <img src="../assets/img/icons/delete.svg" alt="Delete">
                    </a>`;
                    }
                }
            ]
        });

        // Helper function to format date and time
        function formatDateTime(dateTime) {
            return new Date(dateTime).toLocaleString();
        }


        // Handle delete button click
        $('#event_table tbody').on('click', '.delete-button', function() {
            var button = this;
            var recordId = $(button).data('record-id'); // Get the record ID from data-attribute

            var confirmDelete = confirm('Are you sure you want to delete this record?');

            if (confirmDelete) {
                $.ajax({
                    type: 'POST',
                    url: '../config/delete_user.php',
                    data: {
                        record_id: recordId // Pass the record_id as a parameter
                    },
                    success: function(response) {
                        alert(response);
                        table.ajax.reload(); // Refresh the DataTable
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + ' ' + error);
                    }
                });
            }
        });

        //handle the edit event
        $('#event_table tbody').on('click', '[data-target="#editEmployeeModal"]', function() {
            var button = $(this);
            var recordId = button.data('record-id');

            // Fetch employee details by ID using AJAX
            $.ajax({
                type: 'POST',
                url: '../config/fetch_users.php',
                data: {
                    user_id: recordId
                },
                success: function(response) {
                    var user = JSON.parse(response);

                    // Set the fetched user details in the modal form fields
                    $('#edit_user_id').val(user.id);
                    $('#edit_name').val(user.name);
                    $('#edit_email').val(user.email);
                    $('#edit_department').val(user.department);
                    $('#edit_designation').val(user.designation);
                    $('#edit_role').val(user.role);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' ' + error);
                }
            });
        });

    });

    function validatePassword() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;

        // Check if the password fields match
        if (password !== confirmPassword) {
            alert("Passwords do not match");
            return false; // Prevent form submission
        }
        return true; // Proceed with form submission
    }

    function validateNewPassword() {
        var password = document.getElementById("edit_new_password").value;
        var confirmPassword = document.getElementById("edit_re_new_password").value;

        // Check if the password fields match
        if (password !== confirmPassword) {
            alert("Passwords do not match");
            return false; // Prevent form submission
        }
        return true; // Proceed with form submission
    }
</script>