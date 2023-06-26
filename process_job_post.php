<?php
session_start();

// Establish a database connection
include('database/connectdb.php');

if (!$con) {

    die('Could not connect: ' . mysqli_connect_error());

}

// Process form submission
    $employerID = $_POST["employerID"];
    $jobTitle = $_POST["jobTitle"];
    $company = $_POST["company"];
    $salaryRange = $_POST["salaryRange"];
    $typeOfOffer = $_POST["typeOfOffer"];
    $description = $_POST["description"];

    $stmt = $con->prepare("INSERT INTO postJobs (employerID, jobTitle, company, salaryRange, typeOfOffer, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $employerID, $jobTitle, $company, $salaryRange, $typeOfOffer, $description);

    if ($stmt->execute()) {
        // Redirect to the employer profile page
        header("Location: employer.php?employerID=$employerID");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }


// Close the database connection
mysqli_close($con);
?>
