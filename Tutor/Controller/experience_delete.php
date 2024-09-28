<?php
session_start();
require '../../Database/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Check if the experience exists
    $stmt = $conn->prepare("SELECT file_upload FROM experiences WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($file_upload);
        $stmt->fetch();
        $stmt->close();

        // Delete the experience from the database
        $stmt = $conn->prepare("DELETE FROM experiences WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Delete the uploaded file if it exists
            if (!empty($file_upload) && file_exists("../../assets/uploads/" . $file_upload)) {
                unlink("../../assets/uploads/" . $file_upload);
            }

            $_SESSION['message'] = "Experience Successfully Deleted.";
            $_SESSION['message_class'] = "alert-success";
            header("Location: ../profile.php");
        } else {
            $_SESSION['message'] = "Error deleting experience: " . $stmt->error;
            $_SESSION['message_class'] = "alert-danger";
            header("Location: ../profile.php");
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Experience not found.";
        $_SESSION['message_class'] = "alert-danger";
        header("Location: ../profile.php");
    }

    $conn->close();
} else {
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['message_class'] = "alert-danger";
    header("Location: ../profile.php");
}
?>
