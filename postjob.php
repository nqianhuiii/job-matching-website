<?php
// Check if the employer ID is provided in the URL
if (isset($_GET['employerID'])) {
    $employerID = $_GET['employerID'];

    // Get employer details from the database based on the employer ID
    // Modify this part to retrieve the specific employer details from your database
    $employer = [
        'username' => 'employer_username',
        'companyName' => 'company_name'
    ];

    // Check if the employer details are found
    if (!$employer) {
        echo "Employer not found.";
        exit();
    }
} else {
    echo "Invalid employer ID.";
    exit();
}
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
 <link rel="stylesheet" href="./css/postjob.css">
  

        </style>

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
            <a class="nav-item nav-link active" href="about.php">About</a>
            <a class="nav-item nav-link " href="contact.php">Contact</a>
        </div>
        <button class="btn btn-outline-secondary ml-auto" type="button">Sign Up</button>
    </nav>
    <section class="main">
    <div class="container">
        <h2>Post a Job</h2>



        <form method="post" action="process_job_post.php" class="job-post-form">
            <input type="hidden" name="employerID" value="<?php echo $employerID; ?>">
            <div class="form-group">
                <label for="jobTitle">Job Title:</label>
                <input type="text" name="jobTitle" id="jobTitle" required class="form-control">
            </div>

            <div class="form-group">
                <label for="salaryRange">Salary Range:</label>
                <input type="text" name="salaryRange" id="salaryRange" required class="form-control">
            </div>

            <div class="form-group">
                <label for="typeOfOffer">Type of Offer:</label>
                <input type="text" name="typeOfOffer" id="typeOfOffer" required class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Post Job</button>
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
</section>

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