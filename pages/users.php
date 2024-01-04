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
                            <li><a href="employee-elective.php">Elective</a></li>
                            <li><a href="employee-coter.php">Coterminous</a></li>
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
                                echo '<li><a href="users.php" class="active">List of Users</a></li>';
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
                    <h4>Manage Accounts</h4>
                    <h6>Users List</h6>
                </div>
                <div class="page-btn">
                    <!--
                        <a href="#" class="btn btn-added" data-toggle="modal" data-target="#exampleModalCenter">
                            <img src="../assets/img/icons/plus.svg" alt="img" class="me-1"> Add Employee
                        </a>
                    -->
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                        <img src="../assets/img/icons/plus.svg" alt="img" class="me-1">Add User
                    </a>
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
                                    <th>User Type</th>
                                    <th>Office</th>
                                    <th>Position</th>
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
                            <h5 class="modal-title" id="addEmployeeModalLabel">Add User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Your form for adding a new employee -->
                            <form action="../config/signup.php" method="post" onsubmit="return validatePassword()">

                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="FullName" id="name" name="name"
                                        required />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Username" id="email"
                                        name="email" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Position" id="designation"
                                        name="designation" required />
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
                                            <input class="form-control" type="password" placeholder="Password"
                                                id="password" name="password" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="password" placeholder="Confirm Password"
                                                id="confirmPassword" name="confirmPassword" required />
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
            <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog"
                aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEmployeeModalLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editEmployeeForm" action="../config/edit_user.php" method="post"
                                onsubmit="return validateNewPassword()">
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
                                    <input type="text" class="form-control" id="edit_designation"
                                        name="edit_designation">
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
                                    <input type="password" class="form-control" id="edit_old_password"
                                        name="edit_old_password">
                                </div>

                                <div class="form-group">
                                    <label for="edit_new_password">New Password:</label>
                                    <input type="password" class="form-control" id="edit_new_password"
                                        name="edit_new_password">
                                </div>

                                <div class="form-group">
                                    <label for="edit_re_new_password">Retype New Password:</label>
                                    <input type="password" class="form-control" id="edit_re_new_password"
                                        name="edit_re_new_password">
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
            "url": "../config/fetch_user.php",
            "type": "POST",
            "dataSrc": ""
        },
        "columns": [{
                "data": "id",
                "visible": false
            },
            {
                "data": "name"
            },
            {
                "data": "email"
            },
            {
                "data": "role"
            },
            {
                "data": "department"
            },
            {
                "data": "designation"
            },
            {
                "data": null,
                "render": function(data, type, row) {
                    // Add action buttons here for edit, delete, etc.
                    return `
                    <a class="m-1" href="#" data-toggle="modal" data-target="#editEmployeeModal" data-record-id="${row.id}">
                        <img src="../assets/img/icons/edit.svg" alt="Edit">
                    </a>
                    <a class="m-1 delete-button" data-record-id="${row.id}" href="#">
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