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

    $title = "Users";

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }

    // Fetch user data with roles
    $sql = "SELECT users.id, users.username, users.email, users.address, users.phone, users.profile_photo, users.password, users.role_id, users.created_at, users.isActive, roles.name as role_name
    FROM users
    JOIN roles ON users.role_id = roles.id";
    $result = $conn->query($sql);

    $content = "../Administrator/user_content.php";
    include '../setting/_Layout.php';

?>