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
                            <li><a href="employee-file.php">File</a></li>
                        </ul>
                    </li>
                    <li class="active">
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
                    <h4><?php
                        // Fetch the office name from the 'departments' table based on the provided 'id'
                        $officeQuery = "SELECT name FROM evaluation WHERE ID = ?";
                        $officeStmt = $conn->prepare($officeQuery);

                        if ($officeStmt) {
                            $officeStmt->bind_param("i", $id);
                            $officeStmt->execute();
                            $officeResult = $officeStmt->get_result();

                            if ($officeResult->num_rows === 1) {
                                $officeRow = $officeResult->fetch_assoc();
                                echo $officeRow['name'];
                            } else {
                                echo "Office not found";
                            }

                            $officeStmt->close();
                        } else {
                            echo "Error preparing office query";
                        }
                        ?></h4>
                    <h6>Evaluation Details</h6>
                </div>
                <div class="page-btn">
                    <!--
                        -->
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                        Evaluate
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php
                    // Prepare and execute the query
                    $query = "SELECT * FROM evaluation_table WHERE evaluatee_id = ?";
                    $stmt = mysqli_prepare($conn, $query);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, 's', $id);
                        mysqli_stmt_execute($stmt);

                        // Get the result set
                        $result = mysqli_stmt_get_result($stmt);

                        // Check if there are any evaluations
                        if (mysqli_num_rows($result) > 0) {
                            $evaluationNumber = 1;

                            // Loop through each evaluation
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="card p-4">';
                                echo "<h4>Evaluation #$evaluationNumber</h4>";
                                echo "<p>Semester: {$row['semester']} Date: {$row['date']}</p>";

                                echo "</br>";

                                echo '<div class="row">';
                                echo '<div class="col-sm-3"><h5 class="fw-bold">Category</h5></div>';
                                echo '<div class="col-sm-3"><h5 class="fw-bold">MFO</h5></div>';
                                echo '<div class="col-sm-3"><h5 class="fw-bold">Rating</h5></div>';
                                echo '<div class="col-sm-3"><h5 class="fw-bold">File</h5></div>';
                                echo '</div>';

                                echo '<div class="row">';
                                echo '<div class="col-sm-3"><h5>Strategic Objectives</h5></div>';
                                echo "<div class='col-sm-3'><h4>{$row['strategic_mfo']}</h4></div>";
                                echo "<div class='col-sm-3'><h4>{$row['strategic_rating']}</h4></div>";
                                echo '<div class="col-sm-3"><h5><a href="' . $row['supporting_document'] . '" target="_blank">Download File</a></h5></div>';
                                echo '</div>';

                                echo '<div class="row">';
                                echo '<div class="col-sm-3"><h5>Core Functions</h5></div>';
                                echo "<div class='col-sm-3'><h4>{$row['core_function_mfo']}</h4></div>";
                                echo "<div class='col-sm-3'><h4>{$row['core_function_rating']}</h4></div>";
                                echo '<div class="col-sm-3"></div>';
                                echo '</div>';

                                echo '<div class="row">';
                                echo '<div class="col-sm-3"><h5>Support Functions</h5></div>';
                                echo "<div class='col-sm-3'><h4>{$row['support_function_mfo']}</h4></div>";
                                echo "<div class='col-sm-3'><h4>{$row['support_function_rating']}</h4></div>";
                                echo '<div class="col-sm-3"></div>';
                                echo '</div>';

                                echo "</br>";
                                echo "</br>";

                                echo '<div class="row">';
                                echo '<div class="col-sm-3"><h5>Total Overall Rating</h5></div>';
                                echo "<div class='col-sm-3'></div>";
                                echo "<div class='col-sm-3'><h4>{$row['total_overall_rating']}</h4></div>";
                                echo '<div class="col-sm-3"></div>';
                                echo '</div>';

                                echo '<div class="row">';
                                echo '<div class="col-sm-3"><h5>Final Average Rating</h5></div>';
                                echo "<div class='col-sm-3'></div>";
                                echo "<div class='col-sm-3'><h4>{$row['final_average_rating']}</h4></div>";
                                echo '<div class="col-sm-3"><a href="#" class="btn btn-primary m-2" onclick="confirmEdit(' . $row['ID'] . ')" hidden>Edit</a><a href="#" class="btn btn-danger" onclick="confirmDelete(' . $row['ID'] . ')">Delete</a></div>';
                                echo '</div>';

                                echo '<div class="row">';
                                echo '<div class="col-sm-3"><h5>Adjective Rating</h5></div>';
                                echo "<div class='col-sm-3'></div>";
                                echo "<div class='col-sm-3'><h4>{$row['adjective_rating']}</h4></div>";
                                echo '<div class="col-sm-3"></div>';
                                echo '</div>';

                                // Add more categories as needed

                                echo '</div>'; // Close the card div
                                echo '<br>'; // Add a line break between evaluations
                                $evaluationNumber++;
                            }
                        } else {
                            echo "No evaluations found.";
                        }

                        // Close the statement
                        mysqli_stmt_close($stmt);
                    } else {
                        echo 'No Evaluation Found';
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>

                </div>
            </div>


            <!-- Modal for adding employee -->
            <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog"
                aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEmployeeModalLabel">Evaluate</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                onclick="closeAddModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Your form for adding a new employee -->
                            <form action="../config/add_employee_evaluation.php" method="post"
                                enctype="multipart/form-data">

                                <input type="hidden" name="evaluatee_id"
                                    value="<?php echo htmlspecialchars($_GET['id']); ?>">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="semester" name="semester"
                                                placeholder="Semester">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control" id="date" name="date"
                                                placeholder="Date">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <strong>
                                                Category
                                            </strong>
                                        </div>
                                        <div class="col-sm-4">
                                            <strong>
                                                MFO
                                            </strong>
                                        </div>
                                        <div class="col-sm-4">
                                            <strong>
                                                Rating
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="text-center">
                                                Strategic Objectives
                                            </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="strategic_mfo"
                                                id="strategic_mfo">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="strategic_rating"
                                                id="strategic_rating">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="text-center">
                                                Core Function
                                            </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="core_function_mfo"
                                                id="core_function_mfo">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="core_function_rating"
                                                id="core_function_rating">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="text-center">
                                                Support Function
                                            </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="support_function_mfo"
                                                id="support_function_mfo">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="support_function_rating"
                                                id="support_function_rating">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="text-center">
                                                Total Overall Rating
                                            </p>
                                        </div>
                                        <div class="col-sm-4">

                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="total_overall_rating"
                                                id="total_overall_rating">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="text-center">
                                                Final Average Rating
                                            </p>
                                        </div>
                                        <div class="col-sm-4">

                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="final_average_rating"
                                                id="final_average_rating">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="text-center">
                                                Adjective Rating
                                            </p>
                                        </div>
                                        <div class="col-sm-4">

                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="adjective_rating"
                                                id="adjective_rating">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="supportingDocument">Supporting Document</label>
                                    <input type="file" class="form-control" id="supportingDocument"
                                        name="supportingDocument">
                                    <small class="form-text text-muted">Upload a file related to the evaluation.</small>
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
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this evaluation?")) {
        // If the user confirms, redirect to the delete URL or perform the delete action here
        window.location.href = "../config/delete_evaluation.php?id=" + id;
    }
}

function confirmEdit(id) {
    window.location.href = "../pages/edit_evaluation.php?id=" + id;
}

function closeAddModal() {
    $('#addEmployeeModal').modal('hide');
}
</script>