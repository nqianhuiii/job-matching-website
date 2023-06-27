<?php
// Create connection
// Create database
// Create table
include("connectdb.php");

$sql8 = "CREATE TABLE UserType (
    type INT(1) PRIMARY KEY,
    name VARCHAR(10)
)";
mysqli_query($con, $sql8);

$insertsql = "INSERT INTO UserType (type, name) 
    VALUES (1, 'candidate'), (2, 'employer')";
mysqli_query($con, $insertsql);

$sql7 = "CREATE TABLE User (
    userID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    email VARCHAR(255),
    type INT(1),
    contactNo VARCHAR(15),
    FOREIGN KEY (type) REFERENCES UserType (type),
    CONSTRAINT UC_User_Username UNIQUE (username),
    CONSTRAINT UC_User_Email UNIQUE (email)
)";
mysqli_query($con, $sql7);

$sql3 = "CREATE TABLE Employer (
    employerID INT PRIMARY KEY AUTO_INCREMENT,
    userID INT,
    companyName VARCHAR(255),
    industryType VARCHAR(255),
    profilePicture VARCHAR(255),
    FOREIGN KEY (userID) REFERENCES User (userID)
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
    description VARCHAR(600),
    FOREIGN KEY (employerID) REFERENCES Employer (employerID)
)";
mysqli_query($con, $sql4);

$sql5 = "CREATE TABLE applications (
    applicationID INT PRIMARY KEY AUTO_INCREMENT,
    postID INT,
    employerID INT,
    jobSeekerID INT,
    FOREIGN KEY (postID) REFERENCES postJobs (postID),
    FOREIGN KEY (employerID) REFERENCES Employer (employerID)
)";
mysqli_query($con, $sql5);

$sql = "CREATE TABLE contactForm (
    contactFormID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (contactFormID),
    Name VARCHAR(191),
    Email VARCHAR(191),
    phoneNo VARCHAR(20),
    Subject VARCHAR(50),
    Description VARCHAR(300)
)";
mysqli_query($con, $sql);

$sql17 = "CREATE TABLE profile (
    jobSeekerID INT PRIMARY KEY AUTO_INCREMENT,
    userID INT,
    fullName VARCHAR(50),
    nationality VARCHAR(50),
    residentialStatus VARCHAR(50),
    status VARCHAR(50),
    specialization VARCHAR(50),
    facebook VARCHAR(50),
    instagram VARCHAR(50),
    linkedin VARCHAR(50),
    github VARCHAR(50),
    FOREIGN KEY (userID) REFERENCES User (userID)
)";
mysqli_query($con, $sql17);

mysqli_close($con);
?>
