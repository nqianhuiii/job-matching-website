<?php
$employerID = isset($_GET["employerID"]) ? $_GET["employerID"] : ""; // Get the employer ID from the query string

// Fetch employer details from the database
// Assuming you have a table named 'employers' with columns such as 'companyName' and 'industryType'
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
    // Employer details found, display the profile
    $row = mysqli_fetch_assoc($result);
    $companyName = $row["companyName"];
    $industryType = $row["industryType"];
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
    <title>JJWQ | Job Matching Platform</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./image/icon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;1,100;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/employer.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f1f1;
        }

        .navbar {
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
            font-size: 28px;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #555;
        }

        p {
            margin-bottom: 10px;
            font-size: 16px;
            color: #555;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto;
            object-fit: cover;
            object-position: center;
        }

        .social-media {
            margin-top: 20px;
            text-align: center;
        }

        .social-media a {
            display: inline-block;
            margin: 0 10px;
            font-size: 20px;
            color: #007bff;
        }

        .button-group {
            margin-top: 30px;
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #1e7e34;
            border-color: #1e7e34;
        }
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
    <div class="container">
        <h1>Employer Profile</h1>
    
        <form method="post" action="update_profile.php" enctype="multipart/form-data">
        <input type="hidden" name="employerID" value="<?php echo $employerID; ?>">
            <div class="form-group">
                <label for="profilePicture">Profile Picture:</label>
                <input type="file" class="form-control-file" id="profilePicture" name="profilePicture">
            </div>

            <div class="form-group">
                <label for="companyName">Company Name:</label>
                <input type="text" class="form-control" id="companyName" name="companyName" value="<?php echo $companyName; ?>">
            </div>

            <div class="form-group">
                <label for="industryType">Industry Type:</label>
                <input type="text" class="form-control" id="industryType" name="industryType" value="<?php echo $industryType; ?>">
            </div>

            <div class="button-group">
            <a href="update_profile.php?employerID=<?php echo $employerID; ?>">Edit Profile</a>
            </div>
        </form>

        <p>Company Name: <?php echo $companyName; ?></p>
        <p>Industry Type: <?php echo $industryType; ?></p>

        <div class="social-media">
            <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>

        <div class="button-group">
            <a href="manage_posts_job.php?employerID=<?php echo $employerID; ?>" class="btn btn-primary">Manage Post Jobs</a>
            <a href="postjob.php?employerID=<?php echo $employerID; ?>" class="btn btn-success">Post Job</a>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
