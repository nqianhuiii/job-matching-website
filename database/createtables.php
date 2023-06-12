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

mysqli_close($con);
?>