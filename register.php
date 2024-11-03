<?php
session_start();
require 'Database/config.php';

// Fetch roles from the database
$roles_result = $conn->query("SELECT * FROM roles WHERE name != 'Administrator'");
$roles = [];
while ($row = $roles_result->fetch_assoc()) {
    $roles[] = $row;
}

$message = '';
$message_class = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role_id = $_POST['role_id'];
    $isActive = 0;

    // Validate inputs
    if (empty($username) || empty($email) || empty($password) || empty($role_id)) {
        $message = 'All fields are required.';
        $message_class = 'alert-danger';
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = 'Email is already registered.';
            $message_class = 'alert-danger';
        } else {
            $stmt->close();

            // Handle profile photo upload
            if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
                $file_tmp_path = $_FILES['profile_photo']['tmp_name'];
                $file_name = $_FILES['profile_photo']['name'];
                $file_name = preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name);
                $profile_photo = time() . "_" . $file_name;
                move_uploaded_file($file_tmp_path, "assets/uploads/" . $profile_photo);
            }

            // Handle CV upload
            if (isset($_FILES['upload_cv']) && $_FILES['upload_cv']['error'] === UPLOAD_ERR_OK) {
                $cv_tmp_path = $_FILES['upload_cv']['tmp_name'];
                $cv_name = $_FILES['upload_cv']['name'];
                $cv_name = preg_replace("/[^a-zA-Z0-9.]/", "_", $cv_name);
                $upload_cv = time() . "_" . $cv_name;
                move_uploaded_file($cv_tmp_path, "assets/uploads/" . $upload_cv);
            }

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role_id, isActive) VALUES ( ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $username, $email, $password, $role_id, $isActive);
            if ($stmt->execute()) {
                $message = 'Registration successful!';
                $message_class = 'alert-success';
            } else {
                $message = 'Registration failed. Please try again.';
                $message_class = 'alert-danger';
            }
            $stmt->close();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student/Tutor Registration</title>
    
    <!-- Meta -->
    <meta name="description" content="Register for Online Quran Learning Platform" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <link rel="shortcut icon" href="assets/images/favicon.svg" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/fonts/bootstrap/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/css/main.min.css" />
    <style>
        /* Set a Quranic-themed background image */
        body {
            background-image: url('assets/images/quran_background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Style the registration form card */
        .form-control {
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
        }

        /* Style headings and labels */
        h2 {
            color: #15616D; /* Quranic green */
            text-align: center;
            font-weight: bold;
        }

        label {
            color: #333;
        }

        /* Customize the submit button */
        .btn-primary {
            background-color: #15616D;
            border: none;
            color: #fff;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #138A8A;
        }

        .text-blue {
            color: #15616D;
        }
    </style>
</head>
<body>
    <!-- Container start -->
    <div class="container">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10">
            <form action="register.php" method="POST" class="form-control" enctype="multipart/form-data">
                <h2>Create your account</h2>
                <?php if ($message): ?>
                    <div class="alert <?php echo $message_class; ?>"><?php echo $message; ?></div>
                <?php endif; ?>

                <!-- Username field -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter your username" required>
                </div>

                <!-- Email field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                </div>

                <!-- Profile photo upload -->
                <div class="mb-3">
                    <label for="profile_photo" class="form-label">Profile Photo</label>
                    <input type="file" class="form-control" name="profile_photo">
                </div>

                <!-- Password field with toggle -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                        <button type="button" class="input-group-text" id="togglePassword">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Role selection dropdown -->
                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select class="form-select" name="role_id" required>
                        <option value="" disabled selected>Select a role</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?php echo $role['id']; ?>"><?php echo htmlspecialchars($role['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Terms and conditions checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="termsConditions" required>
                    <label class="form-check-label" for="termsConditions">I agree to the terms and conditions</label>
                </div>

                <!-- Submit button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Signup</button>
                </div>
                
                <!-- Login link -->
                <div class="text-center mt-3">
                    <span>Already have an account?</span>
                    <a href="index.php" class="text-blue text-decoration-underline ms-2">Login</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Container end -->

    <!-- JavaScript for Password Toggle -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            e.preventDefault();
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    </script>
</body>
</html>
