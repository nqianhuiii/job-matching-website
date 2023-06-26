<?php
// Database connection
$conn = new mysqli("localhost", "root", "","jjwq");
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit;
}

// Image upload
$imageDirectory = "Myfile/"; // Specify the directory to store uploaded images
$imagePath = $imageDirectory . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));

// Check if the image file is a valid image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check !== false) {
    // Move the uploaded image to the specified directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        // Get the jobseeker_id for the current user (from session or any other source)
        $maxJobseekerIdQuery = "SELECT MAX(jobseeker_id) AS max_jobseeker_id FROM jobseeker";
        $maxJobseekerIdResult = $conn->query($maxJobseekerIdQuery);
        $maxJobseekerIdRow = $maxJobseekerIdResult->fetch_assoc();
        $maxJobseekerId = $maxJobseekerIdRow['max_jobseeker_id'];

        $jobseeker_id = $maxJobseekerId; // Replace with the actual jobseeker_id value

        // Verify if the jobseeker_id exists in the jobseeker table
        $verifyJobseekerQuery = "SELECT * FROM jobseeker WHERE jobseeker_id = ?";
        $verifyJobseekerStmt = $conn->prepare($verifyJobseekerQuery);
        $verifyJobseekerStmt->bind_param("i", $jobseeker_id);
        $verifyJobseekerStmt->execute();
        $verifyJobseekerResult = $verifyJobseekerStmt->get_result();

        // If jobseeker_id doesn't exist, handle the error
        if ($verifyJobseekerResult->num_rows === 0) {
            echo "Error: Invalid jobseeker_id.";
            $verifyJobseekerStmt->close();
            $conn->close();
            exit();
        }

        // Get the image text
        $image_text = $_POST['image_text'];

        // Prepare the insert statement for the image table
        $insertImageQuery = "INSERT INTO images (jobseeker_id, image, image_text) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertImageQuery);
        $stmt->bind_param("iss", $jobseeker_id, $imagePath, $image_text);

        if ($stmt->execute()) {
            echo "Image uploaded successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Failed to upload the image.";
    }
} else {
    echo "Error: Invalid image file.";
}

// Close the database connection
$conn->close();
header("Location: main.php");
?>