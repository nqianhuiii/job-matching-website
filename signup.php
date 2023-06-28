<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JJWQ | Job Matching Platform</title>
    <link rel="icon" type="image/png" sizes="32x32" href="image/icon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;1,100;1,400&display=swap"
        rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/4.7.0/css/bootstrap-combined.no-icons.min.css"
        rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">        
        <link rel= "stylesheet" href= "css/signup.css";>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
        <img src="image/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Job Finder
        </a>
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="main.php">Home </a>
            <a class="nav-item nav-link" href="#">Find A Job</a>
            <a class="nav-item nav-link" href="about.php">About</a>
            <a class="nav-item nav-link" href="contact.php">Contact</a>        
        </div>
        <div class="navbar-nav ml-auto">
            <span class="nav-item nav-link mr-3">Already Registered</span>
            <button class="btn btn-outline-secondary ml-auto" type="button" onclick= "window.location.href='signin.php'">Sign In</button>
        </div>   
    </nav>
    <div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="signup-form" action="sql/signup_form.php" method="POST" onsubmit="return validateForm()">
                        <div>
                            <h4>Candidate Sign Up</h4>
                        </div>
                        <input type="hidden" name="type" value="1">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="phoneNo">Phone Number</label>
                            <input type="tel" class="form-control" id="phoneNo" name="phoneNo" required>
                            <p id="phoneNo-error" style="display: none; color: red; font-size: 10px">Invalid phone number format</p>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <p id="email-error" style="display: none; color: red; font-size: 10px">Invalid email format</p>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <p id="password-error" style="display: none; color: red; font-size: 10px">Password must be between 8-15 characters</p>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                            <p id="confirmPassword-error" style="display: none; color: red; font-size: 10px">Password does not match</p>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-black">Sign Up</button>
                        <div class="text-center mt-3">
                            <h>Already sign up? <a href="signin.php">Sign In Now</a></h>
                        </div>
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

        document.getElementById("signup-form").addEventListener("submit", function(event) {
            const emailValue = emailInput.value;
            const passwordValue = document.getElementById("password").value;
            const confirmPasswordValue = document.getElementById("confirmPassword").value;

            // Validate email format
            if (!validateEmail(emailValue)) {
                emailErrorMessage.style.display = "block";
                event.preventDefault(); // Prevent form submission
            } else {
                emailErrorMessage.style.display = "none";
            }

            // Check password length
            if (passwordValue.length < 8 || passwordValue.length > 15) {
                document.getElementById("password-error").style.display = "block";
                event.preventDefault(); // Prevent form submission
            } else {
                document.getElementById("password-error").style.display = "none";
            }

            // Check if passwords match
            if (passwordValue !== confirmPasswordValue) {
                document.getElementById("confirmPassword-error").style.display = "block";
                event.preventDefault(); // Prevent form submission
            } else {
                document.getElementById("confirmPassword-error").style.display = "none";
            }
        });

        const phoneInput = document.getElementById("phoneNo");
        phoneInput.addEventListener("input", function () {
            const phoneValue = phoneInput.value;

            // Remove non-numeric characters from the input value
            const numericValue = phoneValue.replace(/\D/g, "");

            // Display error message if the input value is not equal to the numeric value
            if (phoneValue !== numericValue) {
                document.getElementById("phoneNo-error").style.display = "block";
            } else {
                document.getElementById("phoneNo-error").style.display = "none";
            }
        });

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    });
</script>
