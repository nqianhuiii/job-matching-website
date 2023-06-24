<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JJWQ | Job Matching Platform</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/image/icon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel= "stylesheet" href= "css/signup.css";>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
        <img src="/image/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Job Finder
        </a>
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
                        <div class="row">
                            <div class="col-md-6">
                                <img src="image/signup.png" class="img-fluid" alt="Image">
                            </div>
                            <div class="col-md-6">
                                <form action= "sql/signup_form.php" method= "POST">
                                    <input type="hidden" name="type" value="1">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNo">Phone Number</label>
                                        <input type="phoneNo" class="form-control" id="phoneNo" name="phoneNo">
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
                                    <button type="submit" class="btn btn-primary">Sign Up</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</body>
</html>