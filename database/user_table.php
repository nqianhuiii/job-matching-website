<?php
    include("connectdb.php");

    $sql= "CREATE TABLE User(
        userID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username varchar(50),
        password varchar(255),
        email varchar(255),
        type int(1),
        contactNo varchar(15),
        FOREIGN KEY (type) REFERENCES UserType(type),
        CONSTRAINT UC_User_Username UNIQUE (username),
        CONSTRAINT UC_User_Email UNIQUE (email)
    )";

    mysqli_query($con, $sql);

    mysqli_close($con);
?>