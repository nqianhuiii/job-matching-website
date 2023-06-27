<?php

    include("connectdb.php");


    $salt= "nBigi6%$^&RW9ma";
    $password= sha1($_POST['password']. $salt);

    // register as user by default, type = 1
    $sql= "INSERT INTO User(username, password, email, type, contactNo)
            VALUES ('$_POST[username]', '$password', '$_POST[email]', '1' ,  '$_POST[phoneNo]')";

    if(!mysqli_query($con, $sql)){
        die('Error'.mysqli_connect_error());
    }else
    $javascriptCode = "
        <script>
            var promptMessage = 'Sign up successful. Please sign in again.';
            var signInAgain = confirm(promptMessage);

            if (signInAgain) {
                // Redirect to the sign-in page
                window.location.href = '../signin.php';
            }
        </script>
    ";

    echo $javascriptCode;
    exit();
    
?>