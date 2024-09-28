<?php
session_start();
require '../../Database/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the document to delete the file from the server
    $stmt = $conn->prepare("SELECT doc_file_name FROM documents WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($doc_file_name);
    $stmt->fetch();
    $stmt->close();

    // Delete the document record from the database
    $stmt = $conn->prepare("DELETE FROM documents WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Delete the file from the server
        if (file_exists("../../assets/uploads/" . $doc_file_name)) {
            unlink("../../assets/uploads/" . $doc_file_name);
        }
        $_SESSION['message'] = "Document successfully deleted.";
        $_SESSION['message_class'] = "alert-success";
    } else {
        $_SESSION['message'] = "Error deleting document.";
        $_SESSION['message_class'] = "alert-danger";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../profile.php");
    exit;
}
?>
