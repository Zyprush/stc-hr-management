
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
                    <h4>Contract of Service Employee List</h4>
                    <h6>Manage COS</h6>
                </div>
                <div class="page-btn">
                    <!--
                        <a href="#" class="btn btn-added" data-toggle="modal" data-target="#exampleModalCenter">
                            <img src="../assets/img/icons/plus.svg" alt="img" class="me-1"> Add Employee
                        </a>
                    -->
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                        <img src="../assets/img/icons/plus.svg" alt="img" class="me-1">Add Employee
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                        </div>
                        <div class="wordset">
                            <ul>
                                <!--
                                    <li>
                                        <a href="../config/generate_pdf_jo.php" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                                src="../assets/img/icons/pdf.svg" alt="img"></a>
                                    </li>
                                    <li>
                                        <a href="../config/generate_excel_jo.php" data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
                                            <img src="../assets/img/icons/excel.svg" alt="img">
                                        </a>
                                    </li>
                                -->
                                <li>
                                    <a href="../config/generate_excel_contract.php" data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="../assets/img/icons/printer.svg" alt="img"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="event_table" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Employment</th>
                                    <th>Office</th>
                                    <th>Position</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
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
                            <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Your form for adding a new employee -->
                            <form action="../config/add_new_employee_contract.php" method="post">

                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="EX. Juan A. Delacruz" required>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="office">Office Name</label>
                                            <select class="form-control" id="office" name="office" required>
                                                <option value="">--Select--</option>
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
                                        <div class="col-sm-6">
                                            <label for="position">Position Title</label>
                                            <input type="text" class="form-control" id="position" name="position" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="type">Type of Employment</label>
                                    <select type="text" class="form-control" id="employment" name="employment" required>
                                        <option value="Contract of Service">Contract of Service</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="start">Start Date</label>
                                            <input type="date" class="form-control" id="start" name="start" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="end">end Date</label>
                                            <input type="date" class="form-control" id="end" name="end" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="rate">Rate /Month</label>
                                            <input type="text" class="form-control" id="rate" name="rate" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="funding">Funding Chargers</label>
                                            <input type="text" class="form-control" id="funding" name="funding" required>
                                        </div>
                                    </div>

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
                            <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editEmployeeForm" action="../config/edit_employee_contract.php" method="post">
                                <input type="hidden" name="edit_employee_id" id="edit_employee_id">
                                <div class="form-group">
                                    <label for="edit_name">Name:</label>
                                    <input type="text" class="form-control" id="edit_name" name="edit_name">
                                </div>
                                <div class="form-group">
                                    <label for="edit_office">Office:</label>
                                    <select class="form-control" id="edit_office" name="edit_office" required>
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
                                    <label for="edit_employment">Type of Employment:</label>
                                    <select class="form-control" id="edit_employment" name="edit_employment" required>
                                        <option value="Contract of Service">Contract of Service</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="edit_start_date">Start Date:</label>
                                    <input type="date" class="form-control" id="edit_start_date" name="edit_start_date">
                                </div>
                                <div class="form-group">
                                    <label for="edit_end_date">End Date:</label>
                                    <input type="date" class="form-control" id="edit_end_date" name="edit_end_date">
                                </div>
                                <div class="form-group">
                                    <label for="edit_position">Position Title:</label>
                                    <input type="text" class="form-control" id="edit_position" name="edit_position">
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
                "url": "../config/fetch_employees_contract.php",
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
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        // Add action buttons here for edit, delete, etc.
                        return `
                    <a class="m-1" href="#" data-toggle="modal" data-target="#editEmployeeModal" data-record-id="${row.ID}">
                        <img src="../assets/img/icons/edit.svg" alt="Edit">
                    </a>
                    <a class="m-1 delete-button" data-record-id="${row.ID}" href="#">
                        <img src="../assets/img/icons/delete.svg" alt="Delete">
                    </a>
                `;
                    }
                }
            ]
        });

        // Handle delete button click
        $('#event_table tbody').on('click', '.delete-button', function() {
            var button = this;
            var recordId = $(button).data('record-id'); // Get the record ID from data-attribute

            var confirmDelete = confirm('Are you sure you want to delete this record?');

            if (confirmDelete) {
                $.ajax({
                    type: 'POST',
                    url: '../config/delete_employee_contract.php',
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
                url: '../config/fetch_employee_contract.php',
                data: {
                    employee_id: recordId
                },
                success: function(response) {
                    var employee = JSON.parse(response);

                    // Set the fetched employee details in the modal form fields
                    $('#edit_employee_id').val(employee.ID);
                    $('#edit_name').val(employee.name);
                    $('#edit_office').val(employee.office);
                    $('#edit_employment').val(employee.employment);
                    $('#edit_start_date').val(employee.start);
                    $('#edit_end_date').val(employee.end); // Added line for the 'end' field
                    $('#edit_position').val(employee.position);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' ' + error);
                }
            });
        });

    });
</script>