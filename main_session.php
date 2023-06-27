<?php
    session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JJWQ | Job Matching Platform</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./image/icon.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;1,100;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <!--Add nav bar to every page, exp: sign up&login-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#" >
            <img src="./image/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Job Finder
        </a>
            <div class="navbar-nav">
              <a class="nav-item nav-link active" href="main_session.php">Home </a>
              <a class="nav-item nav-link" href="findAjob.php"
              <?php if ($_SESSION['type'] != 1) { 
            echo "style='display: none;'"; 
            } ?> 
              >Find A Job</a>
              <a class="nav-item nav-link" href="about.php">About</a>
              <a class="nav-item nav-link" href="contact.php">Contact</a>        
            </div>

        <button class="btn btn-outline-secondary ml-auto mr-2" type="button"
        <?php if ($_SESSION['type'] != 1) { 
            echo "style='display: none;'"; 
            } ?>  
        onclick="window.location.href='employer_signup.php'">Register as Employer</button>

       <button class="btn btn-outline-secondary ml-auto mr-2" type="button" onclick="window.location.href='signout.php'">Sign Out</button> 

        <!-- Employer profile -->
        <button class="btn btn-outline-secondary " type="button"
        <?php if ($_SESSION['type'] != 2) { 
            echo "style='display: none;'"; 
            } ?>  
        onclick="window.location.href='employer.php?employerID=<?php echo $_SESSION['userID']; ?>'">Profile</button>

         <!-- Candidate profile -->
        <button class="btn btn-outline-secondary ml-auto mr-2" type="button"
        <?php if ($_SESSION['type'] != 1) { 
            echo "style='display: none;'"; 
            } ?>  
        onclick="window.location.href='display.php'">Profile</button>
    </nav>

    <div class="mainIntro">
        <h1 class="">The easiest way <br> to get your job !</h1> <br>
        <h4>Search between more than 50,000 open jobs !</h4>
    </div>

    <center>
    <div class="card">
        <div class="card-body">
            <form action="">
                <input type="text" placeholder="Job Title/Position">
                <input type="text" placeholder="Area/City/Town">
                <select name="category" id="category">
                    <option value="" selected disabled>Category</option>
                    <option value="">Education</option>
                    <option value="">Health care</option>
                    <option value="">Technology</option>
                </select>
                <button type="button" class="btn btn-success">Search</button>
            </form>
        </div>
      </div>
    </center>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
