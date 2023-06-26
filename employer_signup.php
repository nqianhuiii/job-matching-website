<?php

session_start();
// Establish a database connection
include('database/connectdb.php');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

// Process form submission
if (isset($_POST["userID"], $_POST["companyName"], $_POST["industryType"])) {
    $userID = $_SESSION['userID'];
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
  <link rel="stylesheet" href="./css/employer_signup.css">

</head>

<body>
  <!--Add nav bar to every page, exp: sign up&login-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="./image/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Job Finder
    </a>
    <div class="navbar-nav ml-auto">
        <button class="btn btn-outline-secondary ml-auto" type="button" onclick= "window.location.href='sign_out.php'">Sign Out</button>
    </div>
  </nav>

  <section class="main">
  <div class="container custom-container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <img src="image/resume.jpg" class="img-fluid" alt="Photo">
              </div>
              <div class="col-md-6">
                <!-- Right Section (Form) -->
                <form id="emp" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                  <div class>  
                    <h4><strong>Employer Company Sign Up</strong></h4>
                    <p>Create your company account now</p>
                  </div> 
                  <input type="hidden" name="userID" value="1">

                  <div>
                    <label for="companyName">Company Name:</label>
                    <input type="text" name="companyName" id="companyName" required><br><br>
                  </div>
                  <div>
                    <label for="industryType">Industry Type:</label>
                    <input type="text" name="industryType" id="industryType" required><br><br>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block btn-black">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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