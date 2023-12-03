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
    $id = "0";
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
                    <li class="submenu">
                        <!-- Add "has-submenu" class to create dropdown -->
                        <a href="#"><i data-feather="user"></i>
                            <span> Employee</span> </a>
                        <ul class="submenu">
                            <!-- Dropdown submenu for Employee -->
                            <li><a href="employee.php">Permanent</a></li>
                            <li><a href="employee-jo.php">Job Order</a></li>
                            <li><a href="employee-file.php" class="active">File</a></li>
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
                    <h4>201 Files</h4>
                    <h6><?php
                        // Fetch the name name from the 'departments' table based on the provided 'id'
                        $nameQuery = "SELECT name FROM employee_files WHERE ID = ?";
                        $nameStmt = $conn->prepare($nameQuery);

                        if ($nameStmt) {
                            $nameStmt->bind_param("i", $id);
                            $nameStmt->execute();
                            $nameResult = $nameStmt->get_result();

                            if ($nameResult->num_rows === 1) {
                                $nameRow = $nameResult->fetch_assoc();
                                echo $nameRow['name'];
                            } else {
                                echo "name not found";
                            }

                            $nameStmt->close();
                        } else {
                            echo "Error preparing name query";
                        }
                        ?></h6>
                </div>
                <div class="page-btn">
                    <!--
                        -->
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                        <img src="../assets/img/icons/plus.svg" alt="img" class="me-1">Add File
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
                                    <th>File Name</th>
                                    <th>Date Uploaded</th>
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
                            <?php 
                            if (isset($_GET['id'])) {
                                // Retrieve the 'id' parameter value
                                $id = $_GET['id'];
                                // Use the retrieved value (e.g., display it)
                                //echo "ID from URL: " . $id;
                            } else {
                                $id = "0";
                            }
                            ?>
                            <form action="../config/add_new_employee_file.php" method="post"
                                enctype="multipart/form-data">

                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                <div class="form-group">
                                    <label for="file">Add file</label>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                </div>

                                <!-- Submit button for the form -->
                                <button type="submit" class="btn btn-primary">Submit</button>
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
            "url": "../config/fetch_employee_files.php?id=" + id,
            "type": "POST",
            "dataSrc": ""
        },
        "columns": [{
                "data": "file_id",
                "visible": false
            },
            {
                "data": "file_name"
            },
            {
                "data": "upload_date"
            },
            {
                "data": null,
                "render": function(data, type, row) {
                    return `
                    <a class="m-1 pdf-button" href="../config/${row.file_directory}${row.file_name}" target="_blank">
                        <img src="../assets/img/icons/pdf.svg" alt="pdf">
                    </a>
                    <a class="m-1 download-button" href="../config/download_file.php?file_directory=${row.file_directory}&file_name=${row.file_name}">
                        <img src="../assets/img/icons/download.svg" alt="download">
                    </a>
                    <a class="m-1 printer-button" href="#" onclick="printFile('../config/${row.file_directory}${row.file_name}'); return false;">
                        <img src="../assets/img/icons/printer.svg" alt="printer">
                    </a>
                        `;
                }
            }
        ]
    });
});

function printFile(fileURL) {
    // Open a new window and load the file URL
    var fileWindow = window.open(fileURL);

    // When the file window finishes loading, trigger the print dialog
    fileWindow.onload = function() {
        fileWindow.print();
    };
}
</script>