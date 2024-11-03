<style>
    #instructorDetails {
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        margin-top: 20px;
        font-size: 14px;
    }

    #instructorDetails h5 {
        font-weight: 700;
        color: #333;
    }

    #instructorDetails .info-group {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    #instructorDetails .info-group span {
        font-weight: bold;
        margin-right: 5px;
    }

    .accordion-button {
        font-weight: bold;
        font-size: 14px;
        padding: 0.5rem 1rem;
        background-color: #e7e7e7;
        border-radius: 4px;
        color: #333;
    }
</style>


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

    $title = "Tutor Assigned";

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }

    // Fetch course instructor assignments
    $sql = "SELECT course_instructor_assigned.*, courses.name AS course_name, users.username AS instructor_name 
            FROM course_instructor_assigned
            JOIN courses ON course_instructor_assigned.course_id = courses.id
            JOIN users ON course_instructor_assigned.instructor_id = users.id
            WHERE users.role_id = 2";  // Ensuring only instructors are fetched
    $result = $conn->query($sql);

    $content = "../Administrator/courses_assign_content.php";
    include '../setting/_Layout.php';

?>