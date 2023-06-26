<!DOCTYPE html>
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
        <img src="/image/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
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
                    <form action="sql/signup_form.php" method="POST">
                        <div>
                            <h4>Candidate Sign Up</h4>
                        </div>
                        <input type="hidden" name="type" value="1">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="phoneNo">Phone Number</label>
                            <input type="tel" class="form-control" id="phoneNo" name="phoneNo">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-black">Sign Up</button>
                        <div class= "text-center mt-3">
                            <h>Already sign up? <a href= "signin.php" >Sign In Now</a></h>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

  
</body>
</html>