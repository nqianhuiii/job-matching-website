<?php
// Establish a database connection
include("database/connectdb.php");

if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

// Get the employer ID from the form or query string
$employerID = isset($_POST["employerID"]) ? $_POST["employerID"] : $_GET["employerID"];

// Fetch the employer details from the database
$sql = "SELECT companyName, industryType FROM employer WHERE employerID = '$employerID'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die('Query Error: ' . mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    // Employer details found, update the profile
    $row = mysqli_fetch_assoc($result);
    $companyName = $row["companyName"];
    $industryType = $row["industryType"];

    // Process the profile picture upload
    if (isset($_FILES["profilePicture"]) && $_FILES["profilePicture"]["error"] === 0) {
        $targetDir = "profile_pictures/";
        $targetFile = $targetDir . basename($_FILES["profilePicture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
        if ($check === false) {
            echo "Error: File is not an image.";
            $uploadOk = 0;
        }

        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "Error: File already exists.";
            $uploadOk = 0;
        }

        // Check the file size
        if ($_FILES["profilePicture"]["size"] > 500000) {
            echo "Error: File is too large.";
            $uploadOk = 0;
        }

        // Allow only certain file formats
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        // If all checks pass, move the uploaded file to the target directory
        if ($uploadOk) {
            if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFile)) {
                echo "Profile picture uploaded successfully.";
                // Update the profile picture path in the database
                $profilePicturePath = $targetFile;
                $sql = "UPDATE employer SET profilePicture = '$profilePicturePath' WHERE employerID = '$employerID'";
                mysqli_query($con, $sql);
            } else {
                echo "Error uploading the file.";
            }
        }
    }

    // Update other employer details in the database
    $companyName = $_POST["companyName"];
    $industryType = $_POST["industryType"];
    $sql = "UPDATE employer SET companyName = '$companyName', industryType = '$industryType' WHERE employerID = '$employerID'";
    mysqli_query($con, $sql);

    // Redirect back to the employer profile page
    header("Location: employer_profile.php?employerID=$employerID");
    exit();
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
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;1,100;1,400&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Add nav bar to every page, exp: sign up&login -->
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

 
    <h1>Update Employer Profile</h1>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="employerID" value="<?php echo $employerID; ?>">
        <label for="companyName">Company Name:</label>
        <input type="text" name="companyName" id="companyName" value="<?php echo $companyName; ?>" required><br><br>

        <label for="industryType">Industry Type:</label>
        <input type="text" name="industryType" id="industryType" value="<?php echo $industryType; ?>" required><br><br>

        <input type="submit" value="Update Profile">
    </form>

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
