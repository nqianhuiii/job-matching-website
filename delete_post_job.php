<?php
// Establish a database connection
include('database/connectdb.php');

if (!$con) {

    die('Could not connect: ' . mysqli_connect_error());

}

// Get the post ID from the query string
$postID = $_GET["postID"];

// Delete the job post from the database
$sql = "DELETE FROM postJobs WHERE postID = '$postID'";

if (mysqli_query($con, $sql) === TRUE) {
    // Redirect to the job post management page
    header("Location: manage_posts_job.php?employerID=$employerID");
    exit();
} else {
    echo "Error deleting record: " . mysqli_connect_error($con);

}

// Close the database connection
mysqli_close($con);
?>
