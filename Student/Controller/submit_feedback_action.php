<?php
session_start();
require '../../Database/config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $user_id = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $comments = isset($_POST['comments']) ? trim($_POST['comments']) : null;

    // Validate if course_id exists in the courses table
    $stmt_check = $conn->prepare("SELECT id FROM courses WHERE id = ?");
    $stmt_check->bind_param("i", $course_id);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows == 0) {
        $_SESSION['message'] = "Invalid course selection.";
        $_SESSION['message_class'] = "alert-danger";
        $stmt_check->close();
        header("Location: ../submit_feedback.php");
        exit;
    }

    $stmt_check->close();

    // Check if feedback for the same course and user already exists
    $stmt_duplicate_check = $conn->prepare("SELECT id FROM feedback WHERE course_id = ? AND user_id = ?");
    $stmt_duplicate_check->bind_param("ii", $course_id, $user_id);
    $stmt_duplicate_check->execute();
    $stmt_duplicate_check->store_result();

    if ($stmt_duplicate_check->num_rows > 0) {
        $_SESSION['message'] = "You have already submitted feedback for this course.";
        $_SESSION['message_class'] = "alert-danger";
        $stmt_duplicate_check->close();
        header("Location: ../submit_feedback.php");
        exit;
    }

    $stmt_duplicate_check->close();

    // Insert feedback record into the database
    $stmt = $conn->prepare("INSERT INTO feedback (user_id, course_id, rating, comments, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiis", $user_id, $course_id, $rating, $comments);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Feedback submitted successfully.";
        $_SESSION['message_class'] = "alert-success";
    } else {
        $_SESSION['message'] = "There was an error submitting your feedback.";
        $_SESSION['message_class'] = "alert-danger";
    }

    $stmt->close();
}

$conn->close();
header("Location: ../submit_feedback.php");
exit;
?>
