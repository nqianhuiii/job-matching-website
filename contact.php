<?php
if (isset($_GET['submitted']) && $_GET['submitted'] === 'true') {
    echo '<script>alert("Form submitted successfully.");</script>';
}
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>JJWQ | Job Matching Platform</title>
  <link rel="icon" type="image/png" sizes="32x32" href="/image/icon.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;1,100;1,400&display=swap"
    rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/4.7.0/css/bootstrap-combined.no-icons.min.css"
    rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/contact.css">
  <link rel="stylesheet" href="css/main.css">

</head>

<body>
  <!--Add nav bar to every page, exp: sign up&login-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="/image/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Job Finder
    </a>
    <div class="navbar-nav">
      <a class="nav-item nav-link " href="main.php">Home </a>
      <a class="nav-item nav-link" href="#">Find A Job</a>
      <a class="nav-item nav-link" href="about.php">About</a>
      <a class="nav-item nav-link active" href="contact.php">Contact</a>
    </div>
    <button class="btn btn-outline-secondary ml-auto" type="button" onclick= "window.location.href= 'signup.php'">Sign Up</button>
  </nav>

  <section class="main">
    <div class="container">
      <form id="contact-form" action="../database/contact_form.php" method="post">

        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Your name.." required>

        <label for="phone">Contact Number</label>
        <input type="telephone" id="phone" name="phone" placeholder="+(60)" required>

        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="abc@gmail.com" required>
        <p id="email-error" style="display: none; color: red;">Invalid email format</p>

        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" placeholder="What'd you like to tell ?" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Write something.." style="height:100px"
          required></textarea>

        <input type="submit" value="Submit"></input>

      </form>
    </div>

    <div class="container1">
      <h3>Contact Us!</h3>
      <table class="table-item">
        <tr>
          <td style="width:30px;"><i class="fa fa-phone" aria-hidden="true"></i></td>
          <td>+(60)12-345 6789</td>
        </tr>
        <tr>
          <td><i class="fa fa-envelope" aria-hidden="true"></i></td>
          <td>jjwq2023@gmail.com</td>
        </tr>
        <tr>
          <td><i class="fa fa-map-marker" aria-hidden="true"></i></td>
          <td>UTM, Skudai, Johor</td>
        </tr>
      </table>


    </div>
  </section>
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