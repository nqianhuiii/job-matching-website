<?php
// Establish a database connection
include('database/connectdb.php');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

// Process form submission
if (isset($_POST["userID"], $_POST["companyName"], $_POST["industryType"])) {
    $userID = $_POST["userID"];
    $companyName = $_POST["companyName"];
    $industryType = $_POST["industryType"];
   

    // Escape the user input to prevent SQL injection
    $userID = mysqli_real_escape_string($con, $userID);
    $companyName = mysqli_real_escape_string($con, $companyName);
    $industryType = mysqli_real_escape_string($con, $industryType);

    // Insert employer details into the database
    $sql = "INSERT INTO employer (userID, companyName, industryType) VALUES ('$userID', '$companyName', '$industryType')";

    if (mysqli_query($con, $sql)) {
        // Get the employer ID of the newly inserted record
        $employerID = mysqli_insert_id($con);

        // Redirect to the employer page
        header("Location: employer.php?employerID=$employerID");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }

}
// Close the database connection
mysqli_close($con);
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>JJWQ | Job Matching Platform</title>
  <link rel="icon" type="image/png" sizes="32x32" href="./image/icon.png" />
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
  <link rel="stylesheet" href="./css/contact.css">
  <link rel="stylesheet" href="css/main.css">

</head>

<body>
  <!--Add nav bar to every page, exp: sign up&login-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="./image/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Job Finder
    </a>
    <div class="navbar-nav">
      <a class="nav-item nav-link " href="main.php">Home </a>
      <a class="nav-item nav-link" href="#">Find A Job</a>
      <a class="nav-item nav-link" href="about.php">About</a>
      <a class="nav-item nav-link active" href="contact.php">Contact</a>
    </div>
    <button class="btn btn-outline-secondary ml-auto" type="button">Sign Up</button>
  </nav>

  <section class="main">
    <div class="container">
      <form id="emp" action="<?php echo $_SERVER["PHP_SELF"]; ?>"method="post">
        <h3>Fill in The Following Details.....</h3>
       <input type="hidden" name="userID" value="1"> <!-- Assuming a user with ID 1 is already logged in, you can change this based on your authentication system -->

        <label for="companyName">Company Name:</label>
        <input type="text" name="companyName" id="companyName" required><br><br>

        <label for="industryType">Industry Type:</label>
        <input type="text" name="industryType" id="industryType" required><br><br>

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