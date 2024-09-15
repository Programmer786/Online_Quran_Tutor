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

    $title = "Assignment Submission";

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];

    // Fetch assignments submitted for the courses assigned to this instructor
    $stmt_submissions = $conn->prepare("
        SELECT 
            assignment_submissions.id,
            assignment_submissions.file_path,
            assignment_submissions.submitted_at,
            deadline_materials.title AS assignment_title,
            courses.name AS course_name,
            users.username AS student_name
        FROM assignment_submissions
        JOIN deadline_materials ON assignment_submissions.deadline_material_id = deadline_materials.id
        JOIN courses ON deadline_materials.course_id = courses.id
        JOIN users ON assignment_submissions.user_id = users.id
        JOIN course_instructor_assigned ON courses.id = course_instructor_assigned.course_id
        WHERE course_instructor_assigned.instructor_id = ?
    ");
    $stmt_submissions->bind_param("i", $user_id);
    $stmt_submissions->execute();
    $result_submissions = $stmt_submissions->get_result();

    $title = "Show Submitted Assignments";
    $content = "../Tutor/show_submitted_assignments_content.php";
    include '../setting/_Layout.php';
?>