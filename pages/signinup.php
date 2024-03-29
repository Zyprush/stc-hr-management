<?php
session_start();

include('../includes/log-header.php');

if (isset($_SESSION['logged_in'])) {
    // Redirect to another page (e.g., dashboard)
    header('Location: dashboard.php');
    exit();
}
?>


<div class="container">
    <div class="forms-container">
        <div class="signin-signup">

            <form action="../config/signin.php" class="sign-in-form" method="POST">
                <h2 class="title">
                    <?php
                    if (isset($_SESSION['status'])) {
                        if (!empty($_SESSION['status'])) {
                            echo $_SESSION['status'];
                            unset($_SESSION['status']);
                        } else {
                            echo "Sign-in form";
                        }
                    } else {
                        echo "Sign in.";
                    }
                    ?>
                </h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username" id="email" name="email" required />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" id="password" name="password" required />
                    <img src="../assets/img/icons/eye.svg" id="togglePassword" alt="View" style="position: absolute; right: 20px; margin-top: 15px;">
                </div>
                <input type="submit" value="Login" class="btn solid" />

            </form>

            <form action="../config/signup.php" class="sign-up-form" method="POST">
                <h2 class="title">Sign up</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="FullName" id="name" name="name" required />
                </div>
                <div class="input-field">
                    <i class="fas fa-building"></i>
                    <input type="text" placeholder="Department" id="department" name="department" required />
                </div>
                <div class="input-field">
                    <i class="fas fa-user-tie"></i>
                    <input type="text" placeholder="Designation" id="designation" name="designation" required />
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" id="email" name="email" />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" id="password" name="password" />
                </div>
                <div class="input-field">
                    <i class="fas fa-user-shield"></i>
                    <span>Role
                        <label for="admin">
                            <input type="radio" id="admin" name="role" value="Admin" required /> Admin
                        </label>
                        <label for="user">
                            <input type="radio" id="user" name="role" value="User" required /> User
                        </label>
                    </span>
                </div>

                <input type="submit" class="btn" value="Sign up" />
            </form>

        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <button class="btn transparent" id="sign-up-btn" hidden>
                    Sign up
                </button>
            </div>
            <img src="../assets/img/log.svg" class="image" alt=""/>
        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>Already have an account?</h3>
                <p>
                    Signing into your account grants access to personalized content and settings.
                </p>
                <button class="btn transparent" id="sign-in-btn">
                    Sign in
                </button>
            </div>
            <img src="../assets/img/register.svg" class="image" alt="" />
        </div>
    </div>
</div>

<?php
include('../includes/log-footer.php')
?>

<script>
    // JavaScript to toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>