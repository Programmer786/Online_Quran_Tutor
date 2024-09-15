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

    $title = "Courses";

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }

    // Fetch courses
    $sql = "SELECT * FROM courses";
    $result = $conn->query($sql);

    $content = "../Administrator/courses_content.php";
    include '../setting/_Layout.php';

?>