<?php
require '../Database/config.php';

$user_id = $_GET['user_id'];

// Fetch experience details
$experience_query = "SELECT company_name, job_title, no_of_year, description FROM experiences WHERE user_id = ?";
$stmt = $conn->prepare($experience_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$experience_result = $stmt->get_result();
$experience = $experience_result->fetch_all(MYSQLI_ASSOC);

// Fetch education details (if applicable)
$education = "No education details available"; // Placeholder for education logic

echo json_encode(['experience' => $experience, 'education' => $education]);
?>
