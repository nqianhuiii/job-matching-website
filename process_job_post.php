<?php
// Establish a database connection
include('database/connectdb.php');

if (!$con) {

    die('Could not connect: ' . mysqli_connect_error());

}

// Process form submission
    $employerID = $_POST["employerID"];
    $jobTitle = $_POST["jobTitle"];
    $salaryRange = $_POST["salaryRange"];
    $typeOfOffer = $_POST["typeOfOffer"];

    // Insert job post details into the database
    $sql = "INSERT INTO postJobs (employerID, jobTitle, salaryRange, typeOfOffer) VALUES ('$employerID', '$jobTitle', '$salaryRange', '$typeOfOffer')";

    if ($con->query($sql) === TRUE) {
        // Redirect to the employer profile page
        header("Location: employer.php?employerID=$employerID");
        exit();
    }
    else {

        echo "Error : " . mysqli_connect_error();
    
    }  


// Close the database connection
mysqli_close($con);
?>
