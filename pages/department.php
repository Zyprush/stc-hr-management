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
                    <li class="menu">
                        <a href="dashboard.php"><i data-feather="home"></i>
                            <span> Dashboard</span> </a>
                    </li>
                    <li class="active">
                        <a href="department.php"><i data-feather="users"></i>
                            <span> Office</span> </a>
                    </li>
                    <li class="menu">
                        <a href="employee.php"><i data-feather="user"></i>
                            <span> Employee</span> </a>
                    </li>
                    <li class="menu">
                        <a href="evaluation.php"><i data-feather="bar-chart-2"></i>
                            <span> Evaluation</span> </a>
                    </li>
                    <li class="menu">
                        <a href="report.php"><i data-feather="calendar"></i>
                            <span> Report</span> </a>
                    </li>
                    <li class="menu">
                        <a href="activities.php"><i data-feather="activity"></i>
                            <span> Promotion </span> </a>
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
                    <h4>Department List</h4>
                    <h6>Manage Departments</h6>
                </div>
                <div class="page-btn">
                    <a href="#" class="btn btn-added" data-toggle="modal" data-target="#exampleModalCenter">
                        <img src="../assets/img/icons/plus.svg" alt="img" class="me-1"> Add Department
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="department_table" class="table">
                            <thead>
                                <tr>
                                    <th>Department</th>
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
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../config/add_department.php" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="departmentName">Department:</label>
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
                            <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editDepartmentForm" action="../config/edit_department.php" method="post">
                                <input type="hidden" name="edit_department_id" id="edit_department_id">
                                <div class="form-group">
                                    <label for="edit_department_name">Department Name:</label>
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
                        <a class="view-button m-1" data-record-id="${row.ID}" href="#">
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

            // Open the PDF file using the constructed file name
            window.open('department_childs.php?id=' + recordId);
        });
    });
</script>