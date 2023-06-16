<?php
//Create connection
// Create database
// Create table
include("connectdb.php");
$sql = "CREATE TABLE contactForm
(
contactFormID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(contactFormID),
Name varchar(191),
Email varchar(191),
phoneNo varchar(20),
Subject varchar(50),
Description varchar(300)
)";
// Execute query
mysqli_query($con, $sql);


$sql1 = "CREATE TABLE JJWQmember (
    memberID int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(memberID),
    Name varchar(50),
    matricsNo varchar(9)
)";
mysqli_query($con, $sql1);

$sql2 = "CREATE TABLE User (
    userID INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255),
    password VARCHAR(255),
    email VARCHAR(255),
    type VARCHAR(255),
    contactNo VARCHAR(255)
)";
mysqli_query($con, $sql2);

$sql3= "CREATE TABLE Employer (
    employerID INT PRIMARY KEY AUTO_INCREMENT,
    userID INT,
    companyName VARCHAR(255),
    industryType VARCHAR(255),
    FOREIGN KEY (userID) REFERENCES User(userID)
)";
mysqli_query($con, $sql3);

$sql4 = "CREATE TABLE postJobs (
    postID INT PRIMARY KEY AUTO_INCREMENT,
    employerID INT,
    applicationID INT,
    jobTitle VARCHAR(255),
    companyName VARCHAR(255),
    salaryRange VARCHAR(255),
    typeOfOffer VARCHAR(255),
    Description varchar(300),
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