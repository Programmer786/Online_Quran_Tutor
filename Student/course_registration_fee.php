<?php
session_start();
require '../Database/config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Fetch user data
$user = getUserData($_SESSION['user_id']);


$title = "Course Registration";

// Assuming role_id for tutors is 2
$tutor_role_id = 2;

$sql = "SELECT course_instructor_assigned.*, courses.name AS course_name, courses.description, courses.price, users.username AS tutor_name, users.profile_photo AS tutor_image
        FROM course_instructor_assigned 
        JOIN courses ON course_instructor_assigned.course_id = courses.id
        JOIN users ON course_instructor_assigned.instructor_id = users.id
        WHERE users.role_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tutor_role_id);
$stmt->execute();
$result = $stmt->get_result();

$content = "../Student/course_registration_fee_content.php";
include '../setting/_Layout.php';

$conn->close();
?>
