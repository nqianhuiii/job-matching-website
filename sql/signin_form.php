<?php

    include("../database/connectdb.php");

    mysqli_select_db($con, "jjwq");

    $sql= "SELECT * FROM User WHERE email='$_POST[email]'";

    $result= mysqli_query($con, $sql);

    $user= mysqli_fetch_assoc($result);

    if($user){

        // retrieve stored password
        $storedPassword= $user['password'];

        // encrypt the user input password
        $salt= "nBigi6%$^&RW9ma";
        $encryptedPassword= sha1($_POST['password']. $salt);

        if($storedPassword === $encryptedPassword){
            session_start(); // Start the session

            // Set session variables
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['email'] = $user['email'];

            header("location:../main_session.php");
            exit();
        }

    }

    mysqli_close($con);
?>