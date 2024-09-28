<?php
session_start();
require '../../Database/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $company_name = $_POST['company_name'];
    $job_title = $_POST['job_title'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];
    $file_upload = '';

    // Handle file upload
    if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_path = $_FILES['file_upload']['tmp_name'];
        $file_name = $_FILES['file_upload']['name'];
        $file_name = preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name);
        $file_upload = time() . "_" . $file_name;
        move_uploaded_file($file_tmp_path, "../../assets/uploads/" . $file_upload);
    }

    $stmt = $conn->prepare("INSERT INTO experiences (user_id, company_name, job_title, start_date, end_date, description, file_upload) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $user_id, $company_name, $job_title, $start_date, $end_date, $description, $file_upload);

    if ($stmt->execute()) {
        header("Location: ../profile.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
