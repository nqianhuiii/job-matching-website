<?php
// Retrieve form data
$fullName = $_POST['fullName'];
$nationality = $_POST['nationality'];
$residentialStatus = $_POST['residentialStatus'];
$status = $_POST['status'];
$specialization = $_POST['specialization'];
$facebook = $_POST['facebook'];
$instagram = $_POST['instagram'];
$linkedin = $_POST['linkedin'];
$github = $_POST['github'];

// Database connection
$conn = new mysqli("localhost", "root", "","jjwq");
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit;
} else {

    // Get the current maximum jobseeker_id from the jobseeker table
    $maxJobseekerIdQuery = "SELECT MAX(jobseeker_id) AS max_jobseeker_id FROM jobseeker";
    $maxJobseekerIdResult = $conn->query($maxJobseekerIdQuery);
    $maxJobseekerIdRow = $maxJobseekerIdResult->fetch_assoc();
    $maxJobseekerId = $maxJobseekerIdRow['max_jobseeker_id'];

    // Increment the jobseeker_id by 1
    $jobseekerId = $maxJobseekerId;



    // Prepare the insert statement for the profile table
    $stmt = $conn->prepare("INSERT INTO profile (jobseeker_id, fullName, nationality, residentialStatus, status, specialization, facebook, instagram, linkedin, github) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssss", $jobseekerId, $fullName, $nationality, $residentialStatus, $status, $specialization, $facebook, $instagram, $linkedin, $github);

    if ($stmt->execute()) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();


    // Close the database connection
    $conn->close();
    header("Location: main.php");
}
?>