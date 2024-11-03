<?php
session_start();
require '../Database/config.php';

// Check if the user is an administrator
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Fetch user data
$user = getUserData($_SESSION['user_id']);

$title = "View All Feedback";

// SQL Query to fetch all feedback
$sql = "SELECT feedback.rating, feedback.comments, feedback.created_at, 
               courses.name AS course_name, 
               users.username AS student_name
        FROM feedback
        JOIN courses ON feedback.course_id = courses.id
        JOIN users ON feedback.user_id = users.id
        ORDER BY feedback.created_at DESC";
$result_feedback = $conn->query($sql);

$content = "../Administrator/view_feedback_content.php";
include '../setting/_Layout.php';
?>
