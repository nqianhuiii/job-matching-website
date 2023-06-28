<?php
// apply.php

// Retrieve the postID from the URL parameter
if (isset($_GET['postID'])) {
    $postID = $_GET['postID'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "jjwq");
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

                // Retrieve the employerID for the selected job post
                $employerIDQuery = "SELECT employerID FROM postJobs WHERE postID = $postID";
                $employerIDResult = mysqli_query($conn, $employerIDQuery);
                $employerIDRow = mysqli_fetch_assoc($employerIDResult);
                $employerID = $employerIDRow['employerID'];

                // Prepare the insert statement for the applications table
                $stmt = $conn->prepare("INSERT INTO applications (postID, employerID, jobSeekerID) VALUES (?, ?, ?)");
                $stmt->bind_param("iii", $postID, $employerID, $userID);

                if ($stmt->execute()) {
                    $javascriptCode = "
        <script>
            var promptMessage = 'Apply Successfully!';
            var done = confirm(promptMessage);

            if (done) {
                window.location.href = 'findAjob.php';
            }
        </script>
    ";

                    echo $javascriptCode;
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "User not logged in.";
            }

            // Close the database connection
            $conn->close();
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "No postID specified.";
}
?>