<?php

    
    include("connectdb.php");

    
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

            session_start(); 
            // Set session variables
            $_SESSION['login'] = "YES" ;
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['type'] = $user['type'];

           
            header("location:../main_session.php");
            exit();
        }else {
            $error = "<script>
                var signInAgain = confirm('Wrong E-mail/Password!'); 
                if (signInAgain) {
                    window.location.href = '../signin.php';
                }
            </script>";
            echo $error;
        }
    } 

?>