<?php
session_start();
require '../Database/config.php';

// Fetch user data
$user = getUserData($_SESSION['user_id']);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$title = "Submit Feedback";

// Fetch courses for the logged-in student
$user_id = $_SESSION['user_id'];
$sql = "SELECT courses.id, courses.name FROM courses
        JOIN course_registration ON courses.id = course_registration.course_id
        WHERE course_registration.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_courses = $stmt->get_result();

// Fetch feedback submitted by the logged-in student
$sql_feedback = "SELECT feedback.rating, feedback.comments, feedback.created_at, courses.name AS course_name 
                 FROM feedback 
                 JOIN courses ON feedback.course_id = courses.id 
                 WHERE feedback.user_id = ?";
$stmt_feedback = $conn->prepare($sql_feedback);
$stmt_feedback->bind_param("i", $user_id);
$stmt_feedback->execute();
$result_feedback = $stmt_feedback->get_result();

$content = "../Student/submit_feedback_content.php";
include '../setting/_Layout.php';
?>
