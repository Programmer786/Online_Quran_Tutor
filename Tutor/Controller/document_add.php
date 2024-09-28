<?php
session_start();
require '../../Database/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $doc_title = $_POST['doc_title'];
    $doc_file_name = '';

    // Handle file upload
    if (isset($_FILES['doc_file']) && $_FILES['doc_file']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_path = $_FILES['doc_file']['tmp_name'];
        $file_name = $_FILES['doc_file']['name'];
        $file_name = preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name);
        $doc_file_name = time() . "_" . $file_name;
        move_uploaded_file($file_tmp_path, "../../assets/uploads/" . $doc_file_name);
    }


    // Insert document details into the database
    $stmt = $conn->prepare("INSERT INTO documents (user_id, doc_title, doc_file_name) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $doc_title, $doc_file_name);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Document Successfully Added.";
        $_SESSION['message_class'] = "alert-success";
        header("Location: ../profile.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
