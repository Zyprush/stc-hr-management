<?php
include('../config/dbcon.php');
include('../includes/header.php');
include('../config/authentication.php');
//include('../config/fetch_departments_options.php');
if (isset($_GET['id'])) {
    // Retrieve the 'id' parameter value
    $id = $_GET['id'];
    // Use the retrieved value (e.g., display it)
    //echo "ID from URL: " . $id;
} else {
    //echo "No ID parameter found in the URL.";
}
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

    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu">
                        <a href="dashboard.php"><i data-feather="home"></i>
                            <span> Dashboard</span> </a>
                    </li>
                    <li class="active">
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
                            <li><a href="employee-elective.php">Elective</a></li>
                            <li><a href="employee-coter.php">Coterminous</a></li>
                            <li><a href="employee-file.php">File</a></li>
                            <li><a href="employee-expired.php">Expired Contract</a></li>
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
            <div class="page-header">
                <div class="page-title">
                    <h4><?php
                        // Fetch the office name from the 'departments' table based on the provided 'id'
                        $officeQuery = "SELECT Department FROM departments WHERE ID = ?";
                        $officeStmt = $conn->prepare($officeQuery);

                        if ($officeStmt) {
                            $officeStmt->bind_param("i", $id);
                            $officeStmt->execute();
                            $officeResult = $officeStmt->get_result();

                            if ($officeResult->num_rows === 1) {
                                $officeRow = $officeResult->fetch_assoc();
                                echo $officeRow['Department'];
                            } else {
                                echo "Office not found";
                            }

                            $officeStmt->close();
                        } else {
                            echo "Error preparing office query";
                        }
                        ?></h4>
                    <h6>Permanent List</h6>
                </div>
                <div class="page-btn">
                    <!--
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
                                <!--
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                                src="../assets/img/icons/pdf.svg" alt="img"></a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                                src="../assets/img/icons/excel.svg" alt="img"></a>
                                    </li>
                                -->
                                <li>
                                    <a href="../config/generate_excel_permanent.php?id=<?php echo $id ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="../assets/img/icons/printer.svg" alt="img"></a>
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
                                    <th>Start Date</th>
                                    <th>Position Title</th>
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
                            <form action="../config/add_new_employee.php" method="post">

                                <div class="form-group">
                                    <label for="name">Name of Incumbent</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="EX. Juan A. Delacruz" required>
                                </div>

                                <div class="form-group">
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
                                                echo "<option value='$department'>$department</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No departments found</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="type">Type of Employment</label>
                                    <select type="text" class="form-control" id="employment" name="employment" required>
                                        <option value="">--Select--</option>
                                        <option value="Permanent">Permanent</option>
                                        <option value="Job Order">Job Order</option>
                                        <option value="Elective">Elective</option>
                                        <option value="Coterminous">Coterminous</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="start">Start Date</label>
                                    <input type="date" class="form-control" id="start" name="start" required>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="item">Item No.</label>
                                        <div class="col-sm-6">
                                            <label for="itemOld">Old</label>
                                            <input type="text" class="form-control" id="oldItem" name="oldItem" placeholder="0000" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="itemNew">New</label>
                                            <input type="text" class="form-control" id="newItem" name="newItem" placeholder="0000" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="position">Position Title</label>
                                    <input type="text" class="form-control" id="position" name="position" required>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="current">Current Year Authorized Rate/Annum</label>
                                        <div class="col-sm-6">
                                            <label for="sg">SG/Step</label>
                                            <input type="text" class="form-control" name="sg" id="sg" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" name="amount" id="amount" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="current">Budget Year Propose Rate/Annum</label>
                                        <div class="col-sm-6">
                                            <label for="sg">SG/Step</label>
                                            <input type="text" class="form-control" name="sg1" id="sg1" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" name="amount1" id="amount1" required>
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
                            <form id="editEmployeeForm" action="../config/edit_employee.php" method="post">
                                <input type="hidden" name="edit_employee_id" id="edit_employee_id">
                                <div class="form-group">
                                    <label for="edit_name">Name of Incumbent:</label>
                                    <input type="text" class="form-control" id="edit_name" name="edit_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_office">Office:</label>
                                    <select class="form-control" id="edit_office" name="edit_office" required>
                                        <option value="">--Select--</option>
                                        <?php
                                        // Establish database connection (ensure $conn is defined)
                                        include '../config/dbcon.php';

                                        // Fetch department names from the 'departments' table
                                        $sql = "SELECT Department FROM departments";
                                        $result = $conn->query($sql);

                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $department = $row['Department'];
                                                echo "<option value='" . htmlspecialchars($department, ENT_QUOTES) . "'>$department</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No departments found</option>";
                                        }

                                        // Close database connection
                                        $conn->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_employment">Type of Employment:</label>
                                    <select class="form-control" id="edit_employment" name="edit_employment" required>
                                        <option value="">--Select--</option>
                                        <option value="Permanent">Permanent</option>
                                        <option value="Job Order">Job Order</option>
                                        <option value="Elective">Elective</option>
                                        <option value="Coterminous">Coterminous</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="edit_start_date">Start Date:</label>
                                    <input type="date" class="form-control" id="edit_start_date" name="edit_start_date" required>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="edit_old_item">Item No. (Old):</label>
                                            <input type="text" class="form-control" id="edit_old_item" name="edit_old_item" placeholder="0000" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="edit_new_item">Item No. (New):</label>
                                            <input type="text" class="form-control" id="edit_new_item" name="edit_new_item" placeholder="0000" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="edit_position">Position Title:</label>
                                    <input type="text" class="form-control" id="edit_position" name="edit_position" required>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="edit_sg">Current Year Authorized Rate/Annum SG:</label>
                                        <div class="col-sm-6">
                                            <label for="edit_sg">SG/Step</label>
                                            <input type="text" class="form-control" id="edit_sg" name="edit_sg" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="edit_amount">Amount</label>
                                            <input type="text" class="form-control" id="edit_amount" name="edit_amount" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="edit_sg1">Budget Year Propose Rate/Annum SG:</label>
                                        <div class="col-sm-6">
                                            <label for="edit_sg1">SG/Step</label>
                                            <input type="text" class="form-control" id="edit_sg1" name="edit_sg1" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="edit_amount1">Amount</label>
                                            <input type="text" class="form-control" id="edit_amount1" name="edit_amount1" required>
                                        </div>
                                    </div>
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
        var id = "<?php echo $id; ?>";
        var table = $('#event_table').DataTable({
            "ajax": {
                "url": "../config/fetch_specific_employees.php?id=" + id,
                "type": "POST",
                "dataSrc": ""
            },
            "columns": [{
                    "data": "ID",
                    "visible": false
                },
                {
                    "data": "newItem"
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
                    "data": "start"
                },
                {
                    "data": "position"
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
                    url: '../config/delete_employee.php',
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

        // handle the edit event
        $('#event_table tbody').on('click', '[data-target="#editEmployeeModal"]', function() {
            var button = $(this);
            var recordId = button.data('record-id');

            // Fetch employee details by ID using AJAX
            $.ajax({
                type: 'POST',
                url: '../config/fetch_employee.php',
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
                    $('#edit_position').val(employee.position);
                    $('#edit_old_item').val(employee
                        .oldItem); // Added line for the 'oldItem' field
                    $('#edit_new_item').val(employee
                        .newItem); // Added line for the 'newItem' field
                    $('#edit_sg').val(employee.sg);
                    $('#edit_amount').val(employee.amount);
                    $('#edit_sg1').val(employee.sg1);
                    $('#edit_amount1').val(employee.amount1);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' ' + error);
                }
            });
        });

    });
</script>