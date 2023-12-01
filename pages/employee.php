<?php
include('../includes/header.php');
include('../config/authentication.php');
//include('../config/fetch_departments_options.php');
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
                    <li class="menu">
                        <a href="dashboard.php"><i data-feather="home"></i>
                            <span> Dashboard</span> </a>
                    </li>
                    <li class="menu">
                        <a href="department.php"><i data-feather="users"></i>
                            <span> Offices</span> </a>
                    </li>
                    <li class="active">
                        <a href="employee.php"><i data-feather="user"></i>
                            <span> Employee</span> </a>
                    </li>
                    <li class="menu">
                        <a href="report.php"><i data-feather="bar-chart-2"></i>
                            <span> Evaluation</span> </a>
                    </li>
                    <li class="menu">
                        <a href="event.php"><i data-feather="calendar"></i>
                            <span> Report </span> </a>
                    </li>
                    <li class="menu">
                        <a href="activities.php"><i data-feather="activity"></i>
                            <span> Promotion</span> </a>
                    </li>
                    <li class="menu">
                        <a href="benefits.php"><i data-feather="award"></i>
                            <span> Benefits</span> </a>
                    </li>
                    <li class="menu">
                        <a href="settings.php"><i data-feather="settings"></i>
                            <span> Settings</span> </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Employee List</h4>
                    <h6>Manage Employee</h6>
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
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                            src="../assets/img/icons/pdf.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                            src="../assets/img/icons/excel.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                            src="../assets/img/icons/printer.svg" alt="img"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="event_table" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>FullName</th>
                                    <th>Start Date</th>
                                    <th>Type</th>
                                    <th>Department</th>
                                    <th>Position</th>
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
            <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog"
                aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
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
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="EX. Juan A. Delacruz" required>
                                </div>

                                <div class="form-group">
                                    <label for="office">Name of Incumbent</label>
                                    <input type="text" class="form-control" id="office" name="office"
                                        placeholder="EX. Juan A. Delacruz" required>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="item">Item No.</label>
                                        <div class="col-sm-6">
                                            <label for="itemOld">Old</label>
                                            <input type="text" class="form-control" id="oldItem" name="oldItem"
                                                placeholder="0000" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="itemNew">New</label>
                                            <input type="text" class="form-control" id="newItem" name="newItem"
                                                placeholder="0000" required>
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
                                            <input type="number" class="form-control" name="amount1" id="amount1"
                                                required>
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
            <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog"
                aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
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
                                    <label for="edit_first_name">First Name:</label>
                                    <input type="text" class="form-control" id="edit_first_name" name="edit_first_name">
                                </div>
                                <div class="form-group">
                                    <label for="edit_middle_name">Middle Name:</label>
                                    <input type="text" class="form-control" id="edit_middle_name"
                                        name="edit_middle_name">
                                </div>
                                <div class="form-group">
                                    <label for="edit_last_name">Last Name:</label>
                                    <input type="text" class="form-control" id="edit_last_name" name="edit_last_name">
                                </div>
                                <div class="form-group">
                                    <label for="edit_extension">Extension:</label>
                                    <input type="text" class="form-control" id="edit_extension" name="edit_extension">
                                </div>
                                <div class="form-group">
                                    <label for="edit_start_date">Start Date:</label>
                                    <input type="text" class="form-control" id="edit_start_date" name="edit_start_date">
                                </div>
                                <div class="form-group">
                                    <label for="edit_employee_type">Type:</label>
                                    <input type="text" class="form-control" id="edit_employee_type"
                                        name="edit_employee_type">
                                </div>
                                <div class="form-group">
                                    <label for="edit_employee_department">Department:</label>
                                    <input type="text" class="form-control" id="edit_employee_department"
                                        name="edit_employee_department">
                                </div>
                                <div class="form-group">
                                    <label for="edit_employee_position">Position:</label>
                                    <input type="text" class="form-control" id="edit_employee_position"
                                        name="edit_employee_position">
                                </div>
                                <div class="form-group">
                                    <label for="edit_end_date">End Date:</label>
                                    <input type="text" class="form-control" id="edit_end_date" name="edit_end_date">
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
            "url": "../config/fetch_employees.php",
            "type": "POST",
            "dataSrc": ""
        },
        "columns": [{
                "data": "ID"
            },
            {
                "data": "FullName"
            },
            {
                "data": "StartDate"
            },
            {
                "data": "Type"
            },
            {
                "data": "Name_department"
            },
            {
                "data": "Position"
            },
            {
                "data": "EndDate"
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
                    <a class="m-1 pdf-button" data-record-id="${row.ID}" href="#">
                        <img src="../assets/img/icons/pdf.svg" alt="PDF">
                    </a>
                `;
                }
            }
        ]
    });

    $('#event_table tbody').on('click', '.pdf-button', function(event) {
        event.preventDefault(); // Prevent default link behavior

        var button = $(this);
        var recordId = $(button).data('record-id');

        // Open the PDF file using the constructed file name
        window.open('pds_edit.php?id=' + recordId);
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

    // Handle Edit button click
    $('#event_table tbody').on('click', '[data-toggle="modal"][data-target="#editEmployeeModal"]', function() {
        var button = this;
        var recordId = $(button).data('record-id');

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
                $('#edit_first_name').val(employee.FirstName);
                $('#edit_middle_name').val(employee.MiddleName);
                $('#edit_last_name').val(employee.LastName);
                $('#edit_extension').val(employee.Extension);
                $('#edit_start_date').val(employee.StartDate);
                $('#edit_employee_type').val(employee.Type);
                $('#edit_employee_department').val(employee.Name_department);
                $('#edit_employee_position').val(employee.Position);
                $('#edit_end_date').val(employee.EndDate);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    });
});
</script>