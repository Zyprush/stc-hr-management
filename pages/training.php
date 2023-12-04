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
                        <a class="dropdown-item" href="profile.php"> <i class="me-2" data-feather="user"></i> My Profile</a>
                        <a class="dropdown-item" href="settings.php"><i class="me-2" data-feather="settings"></i>Settings</a>
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
                    <li class="menu">
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
                    <li class="active">
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
                    <h4>Training</h4>
                    <h6>Manage Training</h6>
                </div>
                <div class="page-btn">
                    <!--
                        <a href="#" class="btn btn-added" data-toggle="modal" data-target="#exampleModalCenter">
                            <img src="../assets/img/icons/plus.svg" alt="img" class="me-1"> Add Employee
                        </a>
                    -->
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                        <img src="../assets/img/icons/plus.svg" alt="img" class="me-1">Add Trainee
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="event_table" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Training Type</th>
                                    <th>Full Name</th>
                                    <th>Duration</th>
                                    <th>Position</th>
                                    <th>Description</th>
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
            <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog"
                aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEmployeeModalLabel">Add Trainee</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Your form for adding a new employee -->
                            <form action="../config/add_new_trainee.php" method="post">

                                <div class="form-group">
                                    <label for="trainee_name">Name</label>
                                    <select class="form-control" id="trainee_name" name="trainee_name" required>
                                        <option value="">--Select--</option>
                                        <?php
                                        // Fetch name names from the 'names' table
                                        $sql = "SELECT name FROM employees";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $name = $row['name'];
                                                echo "<option value='" . htmlspecialchars($name, ENT_QUOTES) . "'>$name</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No names found</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="training">Training Type</label>
                                            <input type="text" class="form-control" id="training_type"
                                                name="training_type" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="duration">Duration</label>
                                            <input type="text" class="form-control" id="duration" name="duration"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        style="height: 100px; overflow-y: auto;" required>
                                </div>


                                <!-- Submit button for the form -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Employee Modal -->
            <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog"
                aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEmployeeModalLabel">Edit Trainee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editEmployeeForm" action="../config/edit_trainee.php" method="post">
                                <input type="hidden" name="edit_trainee_id" id="edit_trainee_id">
                                <div class="form-group">
                                    <label for="edit_trainee_name">Name of Trainee:</label>
                                    <input type="text" class="form-control" id="edit_trainee_name" name="edit_trainee_name" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="edit_training_type">Training Type</label>
                                    <input type="text" class="form-control" id="edit_training_type" name="edit_training_type" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit_duration">Duration</label>
                                    <input type="text" class="form-control" id="edit_duration" name="edit_duration" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit_trainee_position">Position</label>
                                    <input type="text" class="form-control" id="edit_trainee_position" name="edit_trainee_position" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="edit_description">Description</label>
                                    <input type="text" class="form-control" id="edit_description" name="edit_description" required>
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
            "url": "../config/fetch_trainees.php",
            "type": "POST",
            "dataSrc": ""
        },
        "columns": [{
                "data": "ID",
                "visible": false
            },
            {
                "data": "training_type"
            },
            {
                "data": "trainee_name"
            },
            {
                "data": "duration"
            },
            {
                "data": "trainee_position"
            },
            {
                "data": "description"
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
                url: '../config/delete_trainee.php',
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

        // Fetch trainee details by ID using AJAX
        $.ajax({
            type: 'POST',
            url: '../config/fetch_trainee.php',
            data: {
                trainee_id: recordId
            },
            success: function(response) {
                var trainee = JSON.parse(response);

                // Set the fetched trainee details in the modal form fields
                $('#edit_trainee_id').val(trainee.ID);
                $('#edit_trainee_name').val(trainee.trainee_name);
                $('#edit_training_type').val(trainee.training_type);
                $('#edit_duration').val(trainee.duration);
                $('#edit_description').val(trainee.description);
                $('#edit_trainee_position').val(trainee.trainee_position);

            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    });

});
</script>