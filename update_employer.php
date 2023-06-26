<?php
session_start();

$employerID = isset($_GET["employerID"]) ? $_GET["employerID"] : ""; // Get the employer ID from the query string

// Fetch employer details from the database
// Assuming you have a table named 'employers' with columns such as 'companyName', 'industryType', 'email', and 'contactNo'
// Modify the query and table structure based on your actual setup
include('database/connectdb.php');

if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

$sql = "SELECT companyName, industryType FROM employer WHERE employerID = '$employerID'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die('Query Error: ' . mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    // Employer details found, fetch the current values
    $row = mysqli_fetch_assoc($result);
    $companyName = $row["companyName"];
    $industryType = $row["industryType"];

    // Fetch user details from the 'user' table
    $userID = 1; // Assuming you have a specific user ID to retrieve the details
    $userSql = "SELECT username, email, contactNo FROM user WHERE userID = '$userID'";
    $userResult = mysqli_query($con, $userSql);

    if (!$userResult) {
        die('User Query Error: ' . mysqli_error($con));
    }

    if (mysqli_num_rows($userResult) > 0) {
        $userRow = mysqli_fetch_assoc($userResult);
        $username = $userRow["username"];
        $email = $userRow["email"];
        $contactNo = $userRow["contactNo"];
    } else {
        // User details not found, handle the error or redirect to an appropriate page
        die("User not found");
    }
} else {
    // Employer details not found, handle the error or redirect to an appropriate page
    die("Employer not found");
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update Employer Details | LinkedIn</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./image/icon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;1,100;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-xr7kw9MYXcvCkA4Di9vxeQRTeNPf2Gxlckv3Y/ksRo3bh2HGG1gIeVKb4b1rIvPkJpF1rDHyZMxQMXgmfjS0iw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/linkedin.css">
</head>

<body>
    <header class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./image/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
                Job Finder
            </a>
        </div>
    </header>

    <div class="container update-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Employer Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="update_process.php" method="POST">
                            <input type="hidden" name="employerID" value="<?php echo $employerID; ?>">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="<?php echo $username; ?>">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="abc@gmail.com" 
                                    value="<?php echo $email; ?>">
                                    <p id="email-error" style="display: none; color: red;">Invalid email format</p>
                            </div>

                            <div class="form-group">
                                <label for="contactNo">Contact No</label>
                                <input type="tel" class="form-control" id="contactNo" name="contactNo" placeholder="+(60)"
                                    value="<?php echo $contactNo; ?>">
                            </div>

                            <div class="form-group">
                                <label for="companyName">Company Name</label>
                                <input type="text" class="form-control" id="companyName" name="companyName"
                                    value="<?php echo $companyName; ?>">
                            </div>

                            <div class="form-group">
                                <label for="industryType">Industry Type</label>
                                <input type="text" class="form-control" id="industryType" name="industryType"
                                    value="<?php echo $industryType; ?>">
                            </div>


                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
      const emailInput = document.getElementById("email");
    const emailErrorMessage = document.getElementById("email-error");

    emailInput.addEventListener("blur", function() {
      const emailValue = emailInput.value;

      // Validate email format
      if (!validateEmail(emailValue)) {
        emailErrorMessage.style.display = "block";
      } else {
        emailErrorMessage.style.display = "none";
      }
    });

    document.getElementById("contact-form").addEventListener("submit", function(event) {
      const emailValue = emailInput.value;

      // Validate email format
      if (!validateEmail(emailValue)) {
        emailErrorMessage.style.display = "block";
        event.preventDefault(); // Prevent form submission
      } else {
        emailErrorMessage.style.display = "none";
      }
    });

    function validateEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }

      const phoneInput = document.getElementById("phone");
      phoneInput.addEventListener("input", function () {
        const phoneValue = phoneInput.value;
        const formattedPhoneValue = formatPhoneNumber(phoneValue);
        phoneInput.value = formattedPhoneValue;
      });

      function formatPhoneNumber(phoneNumber) {
        // Remove all non-numeric characters from the input
        const formattedNumber = phoneNumber.replace(/\D/g, "");
        return formattedNumber;
      }
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        integrity="sha512-tfB2QZbrKQoLckwSFAaz7kH63vJy8VRWjGJTK3kx/yWj3YbR1F1eCEl/4jNRwRPMLpPXPwGnWwrY14tvFeIsow=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>