<?php
include('../config/dbcon.php');
include('../includes/header.php');
include('../config/authentication.php');

// Get user's ID or unique identifier (Replace 'userID' with your actual identifier)
$userID = $_SESSION['id']; // Example session variable storing the user ID

// Fetch user data from the 'credentials' table
$query = "SELECT id, name, department, designation, email, password, role FROM credentials WHERE id = $userID"; // Adjust query according to your table structure
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract form data
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate the old password
    if (password_verify($oldPassword, $userData['password'])) {
        // Check if the new password matches the confirmation
        if ($newPassword === $confirmPassword) {
            // Hash the new password before updating
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Perform the update query to change the password
            $updateQuery = "UPDATE credentials SET password = '$hashedPassword' WHERE id = $userID";

            // Execute the update query
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                // Redirect to the profile page or show a success message
                header('Location: profile.php');
                exit;
            } else {
                $errorMessage = "Failed to update password.";
            }
        } else {
            $errorMessage = "New passwords do not match.";
        }
    } else {
        $errorMessage = "Old password is incorrect.";
    }
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
                    <h4>Settings</h4>
                    <h6>Manage Profile</h6>
                </div>
                <div class="page-btn">
                    <!--
                      <a href="#" class="btn btn-added" data-toggle="modal" data-target="#exampleModalCenter">
                        <img src="../assets/img/icons/plus.svg" alt="img" class="me-1"> Add Department
                    </a>  
                    -->

                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <h4 class="mb-4">Edit Profile</h4>
                    <?php if (isset($errorMessage)) {
                        echo "<p class='text-danger'>$errorMessage</p>";
                    } ?>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" value="<?php echo $userData['name']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" value="<?php echo $userData['email']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="department">Department:</label>
                            <input type="text" name="department" value="<?php echo $userData['department']; ?>"><br>
                        </div>

                        <div class="form-group">
                            <label for="designation">Designation:</label>
                            <input type="text" name="designation" value="<?php echo $userData['designation']; ?>"><br>
                        </div>

                        <div class="form-group">
                            <label for="old_password">Old Password:</label>
                            <input type="password" name="old_password"><br>
                        </div>
                        
                        <div class="form-group">
                            <label for="new_password">New Password:</label>
                            <input type="password" name="new_password"><br>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password:</label>
                            <input type="password" name="confirm_password"><br>
                        </div>

                        <div class="form-group">
                            <label for="role">Role:</label>
                            <input type="text" name="role" value="<?php echo $userData['role']; ?>" readonly>
                        </div>

                        <!-- Add more input fields for other user details -->

                        <input type="submit" value="Update Profile" class="btn btn-primary">
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php
include('../includes/footer.php');
?>