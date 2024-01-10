<?php
// Determine the current page
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li <?php echo ($currentPage === 'dashboard.php') ? 'class="active"' : 'class="menu"'; ?>>
                    <a href="dashboard.php"><i data-feather="home"></i>
                        <span> Dashboard</span> </a>
                </li>
                <li <?php echo ($currentPage === 'department.php' || $currentPage === 'department_childs.php') ? 'class="active"' : 'class="menu"'; ?>>
                    <a href="department.php"><i data-feather="users"></i>
                        <span> Offices</span> </a>
                </li>
                <li class="submenu">
                    <!-- Add "has-submenu" class to create dropdown -->
                    <a href="#"><i data-feather="user"></i>
                        <span> Employee</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="submenu">
                        <!-- Dropdown submenu for Employee -->
                        <li><a href="employee.php" <?php echo ($currentPage === 'employee.php') ? 'class="active"' : ''; ?>>Permanent</a></li>
                        <li><a href="employee-jo.php" <?php echo ($currentPage === 'employee-jo.php') ? 'class="active"' : ''; ?>>Job Order</a></li>
                        <li><a href="employee-elective.php" <?php echo ($currentPage === 'employee-elective.php') ? 'class="active"' : ''; ?>>Elective</a></li>
                        <li><a href="employee-coter.php" <?php echo ($currentPage === 'employee-coter.php') ? 'class="active"' : ''; ?>>Coterminous</a></li>
                        <li><a href="employee-file.php" <?php echo ($currentPage === 'employee-file.php' || $currentPage === 'employee-files.php') ? 'class="active"' : ''; ?>>File</a></li>
                        <li><a href="employee-expired.php" <?php echo ($currentPage === 'employee-expired.php') ? 'class="active"' : ''; ?>>Expired Contract</a></li>
                    </ul>
                </li>
                <li <?php echo ($currentPage === 'evaluation.php' || $currentPage === 'evaluation-child.php') ? 'class="active"' : 'class="menu"'; ?>>
                    <a href="evaluation.php"><i data-feather="users"></i>
                        <span> Evaluation</span> </a>
                </li>
                <li <?php echo ($currentPage === 'training.php') ? 'class="active"' : 'class="menu"'; ?>>
                    <a href="training.php"><i data-feather="users"></i>
                        <span> Training</span> </a>
                </li>
                <li class="submenu">
                    <!-- Add "has-submenu" class to create dropdown -->
                    <a href="#"><i data-feather="calendar"></i>
                        <span> Report</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="submenu">
                        <!-- Dropdown submenu for Report -->
                        <li><a href="benefits.php" <?php echo ($currentPage === 'benefits.php' || $currentPage === 'benefits-loyalty.php' || $currentPage === 'benefits-anniv.php' || $currentPage === 'benefits-retired.php' || $currentPage === 'benefits-13.php') ? 'class="active"' : ''; ?>>Benefits</a></li>
                        <li><a href="promotion.php" <?php echo ($currentPage === 'promotion.php') ? 'class="active"' : ''; ?>>Promotion</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <!-- Add "has-submenu" class to create dropdown -->
                    <a href="#"><i data-feather="settings"></i>
                        <span> Settings</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="submenu">
                        <!-- Dropdown submenu for Settings -->
                        <li><a href="settings.php" <?php echo ($currentPage === 'settings.php') ? 'class="active"' : ''; ?>>Office</a></li>
                        <?php
                        // Check if the user role is 'Admin'
                        if ($_SESSION['role'] === 'Admin') {
                            // If the role is 'Admin', display the list of users link
                            echo '<li><a href="users.php" ' . (($currentPage === 'users.php') ? 'class="active"' : '') . '>List of Users</a></li>';
                        }
                        ?>
                        <li><a href="user-log.php" <?php echo ($currentPage === 'user-log.php') ? 'class="active"' : ''; ?>>User Log</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>