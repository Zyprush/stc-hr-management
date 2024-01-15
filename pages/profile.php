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
                    <h4>Account</h4>
                    <h6>Manage Account</h6>
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

                    <h4 class="mb-4">Edit Account</h4>
                    <?php if (isset($errorMessage)) {
                        echo "<p class='text-danger'>$errorMessage</p>";
                    } ?>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" value="<?php echo $userData['name']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">Username:</label>
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