<?php
$salary = $_POST['salary'];
$location = $_POST['location'];


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


    $jobseekerId = $maxJobseekerId;



    // Prepare the insert statement for the profile table
    $stmt = $conn->prepare("INSERT INTO expectation (jobseeker_id,salary,location) VALUES (?, ?,?)");
    $stmt->bind_param("iss", $jobseekerId, $salary, $location);

    if ($stmt->execute()) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();


    // Close the database connection
    $conn->close();
    header("Location: dashboard.php");
}
?>