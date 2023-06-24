<?php
//Create connection
// Create database
// Create table
include("connectdb.php");


$sql3= "CREATE TABLE Employer (
    employerID INT PRIMARY KEY AUTO_INCREMENT,
    userID INT,
    companyName VARCHAR(255),
    industryType VARCHAR(255),
    profilePicture VARCHAR(255),
    FOREIGN KEY (userID) REFERENCES User(userID)
)";
mysqli_query($con, $sql3);

$sql4 = "CREATE TABLE postJobs (
    postID INT PRIMARY KEY AUTO_INCREMENT,
    employerID INT,
    applicationID INT,
    jobTitle VARCHAR(255),
    company VARCHAR(255),
    salaryRange VARCHAR(255),
    typeOfOffer VARCHAR(255),
    description varchar(600),
    FOREIGN KEY (employerID) REFERENCES Employer(employerID)
)";
mysqli_query($con, $sql4);

$sql5 = "CREATE TABLE applications (
    applicationID INT PRIMARY KEY AUTO_INCREMENT,
    postID INT,
    employerID INT,
    jobSeekerID INT,
    FOREIGN KEY (postID) REFERENCES postJobs(postID),
    FOREIGN KEY (employerID) REFERENCES Employer(employerID)
)";
mysqli_query($con, $sql5);

$sql6 = "CREATE TABLE jobseeker (
    jobSeekerID INT PRIMARY KEY AUTO_INCREMENT,
    userID INT,
    fullName VARCHAR(255),
    age INT,
    gender VARCHAR(255),
    FOREIGN KEY (userID) REFERENCES User(userID)
)";
mysqli_query($con, $sql6);

mysqli_close($con);
?>