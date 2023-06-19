<?php
    include("connectdb.php");

    $sql= "CREATE TABLE UserType(
        type int(1) PRIMARY KEY,
        name varchar(10)
    )";

    $insertsql= "INSERT INTO UserType(type, name) 
        VALUES(1, 'candidate'), (2, 'employer')";


    mysqli_query($con, $sql);
    mysqli_query($con, $insertsql);

    mysqli_close($con);
?>