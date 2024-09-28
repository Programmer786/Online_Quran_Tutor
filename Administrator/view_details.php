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

    $title = "Users Details";


    $user_id = $_GET['id'];

    // Fetch user details
    $user_stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $user_stmt->bind_param("i", $user_id);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    $user = $user_result->fetch_assoc();

    // Fetch user experiences
    $experience_stmt = $conn->prepare("SELECT * FROM experiences WHERE user_id = ?");
    $experience_stmt->bind_param("i", $user_id);
    $experience_stmt->execute();
    $experience_result = $experience_stmt->get_result();

    // Fetch user documents
    $document_stmt = $conn->prepare("SELECT * FROM documents WHERE user_id = ?");
    $document_stmt->bind_param("i", $user_id);
    $document_stmt->execute();
    $document_result = $document_stmt->get_result();

    $content = "../Administrator/view_details_content.php";
    include '../setting/_Layout.php';

?>