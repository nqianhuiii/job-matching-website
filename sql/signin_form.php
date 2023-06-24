<?php

    include("connectdb.php");

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
            header("location:../main.php");
            exit();
        }

    }

    mysqli_close($con);
?>