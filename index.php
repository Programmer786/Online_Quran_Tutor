<?php
session_start();
require 'Database/config.php';

if (isset($_SESSION['user_id'])) {
    // Redirect based on role_id
    if ($_SESSION['role_id'] == 1) {
        header("Location: Student/student_dashboard.php");
    } elseif ($_SESSION['role_id'] == 2) {
        header("Location: Tutor/instructor_dashboard.php");
    } elseif ($_SESSION['role_id'] == 3) {
        header("Location: Administrator/admin_dashboard.php");
    } else {
        header("Location: logout.php");
    }
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']); // Check if "Remember Me" is checked

    $stmt = $conn->prepare("SELECT id, username, password, role_id, isActive FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        if ($user && ($user['isActive'] == 1)) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['profile_photo'] = $user['profile_photo'];

            // Set a cookie if "Remember Me" is checked
            if ($remember) {
                setcookie('user_id', $user['id'], time() + (86400 * 30), "/"); // 86400 = 1 day
            }

            // Redirect based on role_id
            if ($user['role_id'] == 1) {
                header("Location: Student/student_dashboard.php");
            } elseif ($user['role_id'] == 2) {
                header("Location: Tutor/instructor_dashboard.php");
            } elseif ($user['role_id'] == 3) {
                header("Location: Administrator/admin_dashboard.php");
            } else {
                header("Location: logout.php");
            }
            exit;
        } else {
            $error = 'Please Contact to Administrator for Account Approve';
        }
    } else {
        $error = 'Invalid email or password';
    }
}

// Check if the user ID is set in the cookie and not in the session
if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
    $stmt = $conn->prepare("SELECT id, username, role_id FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role_id'] = $user['role_id'];
        $_SESSION['profile_photo'] = $user['profile_photo'];

        // Redirect based on role_id
        if ($user['role_id'] == 1) {
            header("Location: Student/student_dashboard.php");
        } elseif ($user['role_id'] == 2) {
            header("Location: Tutor/instructor_dashboard.php");
        } elseif ($user['role_id'] == 3) {
            header("Location: Administrator/admin_dashboard.php");
        } else {
            header("Location: logout.php");
        }
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | Tutor Management System</title>

    <!-- Meta -->
    <meta name="description" content="Tutor Management System" />
    <meta name="author" content="Bootstrap Gallery" />
    <meta property="og:title" content="Tutor Management System">
    <meta property="og:description" content="Tutor Management System">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Tutor Management System">
    <link rel="shortcut icon" href="assets/images/favicon.svg" />

    <!-- *************
        ************ CSS Files *************
    ************* -->
    <link rel="stylesheet" href="assets/fonts/bootstrap/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/css/main.min.css" />
</head>

<body class="bg-white">
    <!-- Container start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-sm-6 col-12">
                <form action="index.php" method="POST" class="my-5">
                    <div class="border border-light rounded-2 p-4 mt-5">
                        <div class="login-form">
                            <h2 class="fw-semibold mb-4" style="text-align: center;">Login</h2>
                            <?php if ($error): ?>
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="Enter password" required />
                                    <a href="#" class="input-group-text">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" name="remember" id="rememberPassword" />
                                    <label class="form-check-label" for="rememberPassword">Remember</label>
                                </div>
                            </div>
                            <div class="d-grid py-3 mt-2">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    Login
                                </button>
                            </div>
                            <div class="text-center pt-4">
                                <span>Not registered?</span>
                                <a href="register.php" class="text-blue text-decoration-underline ms-2">
                                    SignUp</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container end -->
</body>

</html>
