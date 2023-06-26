<?php
session_start();
$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : "";

$employerID = isset($_POST["employerID"]) ? $_POST["employerID"] : ""; // Get the employer ID from the form
$companyName = isset($_POST["companyName"]) ? $_POST["companyName"] : ""; // Get the updated company name
$industryType = isset($_POST["industryType"]) ? $_POST["industryType"] : ""; // Get the updated industry type
$username = isset($_POST["username"]) ? $_POST["username"] : ""; // Get the updated username
$email = isset($_POST["email"]) ? $_POST["email"] : ""; // Get the updated email
$contactNo = isset($_POST["contactNo"]) ? $_POST["contactNo"] : ""; // Get the updated contact number

// Update employer details in the 'employer' table
include('database/connectdb.php');

if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

$updateEmployerSql = "UPDATE employer SET companyName = '$companyName', industryType = '$industryType' WHERE employerID = '$employerID'";
$updateEmployerResult = mysqli_query($con, $updateEmployerSql);

if (!$updateEmployerResult) {
    die('Update Error: ' . mysqli_error($con));
}

// Update username, email, and contact number in the 'user' table
$updateUserSql = "UPDATE user SET username = '$username', email = '$email', contactNo = '$contactNo' WHERE userID = '$userID'";
$updateUserResult = mysqli_query($con, $updateUserSql);

if (!$updateUserResult) {
    die('Update Error: ' . mysqli_error($con));
}

mysqli_close($con);

// Redirect back to the employer profile page
header("Location: employer.php?employerID=$employerID");
exit();
?>

