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
$conn = new mysqli("localhost", "root", "jkty12138", "jjwq_jmp");
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit;
} else {
    try {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        // Start the session
        session_start();

        // Check if the user is logged in
        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];

            // Check if the user's profile already exists in the database
            $existingProfileQuery = "SELECT * FROM profile WHERE userID = $userID";
            $existingProfileResult = mysqli_query($conn, $existingProfileQuery);

            if (!$existingProfileResult) {
                echo "Error executing the query: " . mysqli_error($conn);
                exit;
            }

            if (mysqli_num_rows($existingProfileResult) > 0) {
                // User's profile already exists, perform an update

                // Prepare the update statement for the profile table
                $stmt = $conn->prepare("UPDATE profile SET fullName = ?, nationality = ?, residentialStatus = ?, status = ?, specialization = ?, facebook = ?, instagram = ?, linkedin = ?, github = ? WHERE userID = ?");
                $stmt->bind_param("sssssssssi", $fullName, $nationality, $residentialStatus, $status, $specialization, $facebook, $instagram, $linkedin, $github, $userID);

                if ($stmt->execute()) {
                    echo "Profile updated successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                // User profile does not exist, insert a new row
                $insertQuery = "INSERT INTO profile (userID, fullName, nationality, residentialStatus, status, specialization, facebook, instagram, linkedin, github) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param("isssssssss", $userID, $fullName, $nationality, $residentialStatus, $status, $specialization, $facebook, $instagram, $linkedin, $github);

                if ($stmt->execute()) {
                    echo "New profile created successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            }
        } else {
            echo "User not logged in.";
        }

        // Close the database connection
        $conn->close();
        header("Location: ../display.php");
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>