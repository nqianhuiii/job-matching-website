<?php

    include("../database/connectdb.php");

    mysqli_select_db($con, "jjwq");

    $salt= "nBigi6%$^&RW9ma";
    $password= sha1($_POST['password']. $salt);

    $sql= "INSERT INTO User(username, password, email, type, contactNo)
            VALUES ('$_POST[username]', '$password', '$_POST[email]', '$_POST[type]',  '$_POST[phoneNo]')";

    if(!mysqli_query($con, $sql)){
        die('Error'.mysqli_connect_error());
    }

    //if username or/and email is/are repeated 

    mysqli_close($con);

    header("location: ../main_session.php");
    exit();
?>