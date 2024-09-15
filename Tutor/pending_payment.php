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

    $title = "Course Payment Verification";

    // Fetch course_registration
    $user_id = $_SESSION['user_id']; // Assuming you have the user ID in session
    
    $sql = "SELECT course_registration.*, courses.name AS course_name
            FROM course_registration
            JOIN courses ON course_registration.course_id = courses.id
            JOIN course_instructor_assigned ON course_registration.course_id = course_instructor_assigned.course_id
            WHERE course_instructor_assigned.instructor_id = ? AND course_registration.payment_status = 'Pending'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();   

    $content = "../Tutor/pending_payment_content.php";
    include '../setting/_Layout.php';
?>
