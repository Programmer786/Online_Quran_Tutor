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
    $cnic = $_POST['cnic'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $quranic_qualification = $_POST['quranic_qualification'];
    // $profile_photo = $_FILES['profile_photo']['name'];
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

            if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
                $file_tmp_path = $_FILES['profile_photo']['tmp_name'];
                $file_name = $_FILES['profile_photo']['name'];
                $file_name = preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name);
                $profile_photo = time() . "_" . $file_name;
                move_uploaded_file($file_tmp_path, "assets/uploads/" . $profile_photo);

            }

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, email, cnic, date_of_birth, gender, age, address, phone, quranic_qualification, profile_photo, password, role_id, isActive) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssisssssii", $username, $email, $cnic, $date_of_birth, $gender, $age, $address, $phone, $quranic_qualification, $profile_photo, $password, $role_id, $isActive);
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
    <title>Admin Templates - Dashboard Templates - Venus Admin Template</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
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
                <form action="register.php" method="POST" class="form-control was-validated my-5" enctype="multipart/form-data">
                    <div class="border border-light rounded-2 p-4 mt-5">
                        <div class="login-form">
                            <h2 class="fw-semibold mb-4" style="text-align: center;">Create your account</h2>
                            <?php if ($message): ?>
                                <div class="alert <?php echo $message_class; ?>"><?php echo $message; ?></div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter your username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">CNIC</label>
                                <input type="text" class="form-control" name="cnic" maxlength="13" placeholder="Enter your CNIC">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="date_of_birth">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Age</label>
                                <input type="number" class="form-control" name="age" placeholder="Enter your age">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter your address">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" placeholder="Enter your phone number">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quranic Qualification</label>
                                <select class="form-select" id="quranic_qualification" name="quranic_qualification">
                                    <option value="Haifz" selected>Haifz</option>
                                    <option value="Tajweed">Tajweed</option>
                                    <option value="Tafseer">Tafseer</option>
                                    <option value="Nazra">Nazra</option>
                                    <option value="Basic_Language_Courses">Basic Language Courses</option>
                                    <option value="Other_Relevant_Qualification">Other Relevant Qualification</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Profile Photo</label>
                                <input type="file" class="form-control" name="profile_photo" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required/>
                                    <a href="#" class="input-group-text" id="togglePassword">
                                        <i class="bi bi-eye" id="toggleIcon"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" id="role_id" name="role_id" required>
                                    <option value="" disabled selected>Select a role</option>
                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?php echo $role['id']; ?>"><?php echo htmlspecialchars($role['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" value="1" id="termsConditions" required />
                                    <label class="form-check-label" for="termsConditions">I agree to the terms and conditions</label>
                                </div>
                            </div>
                            <div class="d-grid py-3 mt-2">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    Signup
                                </button>
                            </div>
                            <div class="text-center pt-4">
                                <span>Already have an account?</span>
                                <a href="index.php" class="text-blue text-decoration-underline ms-2">Login</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container end -->

    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            e.preventDefault();
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        });
    </script>
</body>
</html>
