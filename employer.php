<?php
session_start(); // Start the session

// Retrieve the user's information from session variables
$email = $_SESSION['email'];

$employerID = isset($_GET["employerID"]) ? $_GET["employerID"] : ""; // Get the employer ID from the query string

// Fetch employer details from the database
// Assuming you have a table named 'employers' with columns such as 'companyName' and 'industryType'
// Modify the query and table structure based on your actual setup
include('database/connectdb.php');

if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

$sql = "SELECT companyName, industryType, profilePicture FROM employer WHERE employerID = '$employerID'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die('Query Error: ' . mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    // Employer details found, display the profile
    $row = mysqli_fetch_assoc($result);
    $companyName = $row["companyName"];
    $industryType = $row["industryType"];
    $profilePicture = $row["profilePicture"];
} else {
    // Employer details not found, handle the error or redirect to an appropriate page
    die("Employer not found");
}

// Fetch user details for the employer from the user table
// $userID = 1; // Assuming the employer's user ID is 1 (change it according to your database structure)
$userID = $_SESSION['userID'];
$userSql = "SELECT username, email, contactNo FROM user WHERE userID = '$userID'";
$userResult = mysqli_query($con, $userSql);

if (!$userResult) {
    die('Query Error: ' . mysqli_error($con));
}

if (mysqli_num_rows($userResult) > 0) {
    $userRow = mysqli_fetch_assoc($userResult);
    $username = $userRow["username"];
    $contactNo = $userRow["contactNo"];
} else {
    $username = "N/A";
    $contactNo = "N/A";
}
if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
    $tempName = $_FILES['profilePicture']['tmp_name'];
    $fileName = $_FILES['profilePicture']['name'];

    // Move the uploaded file to the desired location
    move_uploaded_file($tempName, "profile-pictures/" . $fileName);
    $profilePicture = "profile-pictures/" . $fileName;

    // Update the profile picture path in the database
    $updateSql = "UPDATE employer SET profilePicture = '$profilePicture' WHERE employerID = '$employerID'";
    $updateResult = mysqli_query($con, $updateSql);

    if (!$updateResult) {
        die('Query Error: ' . mysqli_error($con));
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Employer Profile | LinkedIn</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./image/icon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;1,100;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-xr7kw9MYXcvCkA4Di9vxeQRTeNPf2Gxlckv3Y/ksRo3bh2HGG1gIeVKb4b1rIvPkJpF1rDHyZMxQMXgmfjS0iw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/employer.css">
    <script>
        // Function to update the label text with the selected file path
        function updateFileName() {
            var input = document.getElementById('profilePicture');
            var label = document.getElementById('customFileLabel');
            if (input.files.length > 0) {
                label.setAttribute('data-browse', input.files[0].name);
            } else {
                label.setAttribute('data-browse', 'Choose File');
            }
        }
    </script>
</head>

<body>
    <header class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./image/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
                Job Finder
            </a>
        </div>
        <button class="btn btn-primary" onclick="window.location.href='main_session.php'">Back</button>
        <span>&nbsp;</span>
        <a href="postjob.php?employerID=<?php echo $employerID; ?>" class="btn btn-success">Post Job</a>
    </header>

    <div class="container profile-container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <div class="profile-picture">
                        <?php
                        $defaultProfilePicture = "image/profile-picture.jpg"; // Path to the default profile picture
                        // Use the profile picture path from the database if available
                        $profilePicture = $profilePicture ?? $defaultProfilePicture;
                        ?>

                        <img src="<?php echo $profilePicture; ?>" alt="Profile Picture">
                    </div>

                    <!-- Add an input field for the user to upload a profile picture -->
                    <div class="profile-details">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="profilePicture" name="profilePicture"
                                    onchange="updateFileName()">
                                <label class="custom-file-label" for="profilePicture" id="customFileLabel">Choose
                                    File</label>
                                <button type="submit" class="btn btn-primary upload-button">Upload</button>
                            </div>
                        </form>
                        <br>
                        <p>Username:
                            <?php echo $username; ?>
                        </p>
                        <p>Email:
                            <?php echo $email; ?>
                        </p>
                        <p>Contact No:
                            <?php echo $contactNo; ?>
                        </p>

                        <div class="button-group">
                            <a href="manage_posts_job.php?employerID=<?php echo $employerID; ?>"
                                class="btn btn-primary">Manage Post Jobs</a>
                        </div>


                    </div>

                </div>
                <br>

            </div>

            <div class="col-md-9">
                <div class="profile-content">
                    <h1>User Details</h1>
                    <p>Company Name:
                        <?php echo $companyName; ?>
                    <p>
                    <p>Industry Type:
                        <?php echo $industryType; ?>
                    </p>
                </div>
                <br>

                <a href="update_employer.php?employerID=<?php echo $employerID; ?>" class="btn btn-primary"
                    style="text-align:center;">Update Profile</a>

                <?php
                include('database/connectdb.php');
                $sql = "SELECT * FROM applications WHERE employerID = '$employerID'";
                $result = mysqli_query($con, $sql);

                // Check if any job posts were found
                if ($result->num_rows > 0) {
                    // Job posts found, display them in a table
                    echo "<div class='main'>";
                    echo "<div class='container'>";
                    echo "<h1 class='heading'>Applications</h1>";
                    echo "<div class='table-container'>";
                    echo "<table border='1px solid black'>";
                    echo "<thead><tr><th style='padding:10px' width='20%'>Job Title</th><th style='padding:10px'>Full Name</th>
                    <th style='padding:10px'>Facebook</th>
                    <th style='padding:10px'>Instagram</th>
                    <th style='padding:10px'>LinkedIn</th>
                    <th style='padding:10px'>GitHub</th>
                    <th style='padding:10px'>Contact Number</th>
                    </tr></thead>";
                    echo "<tbody>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        $postID = $row["postID"];
                        $jobSeekerID = $row["jobSeekerID"];

                        // Retrieve fullName from user table based on jobSeekerID
                        $userQuery = "SELECT fullName,facebook,instagram,linkedin,github FROM profile WHERE userID = '$jobSeekerID'";
                        $userQuery1 = "SELECT contactNo FROM user WHERE userID = '$jobSeekerID'";
                        $userQuery2 = "SELECT jobTitle FROM postjobs WHERE postID = '$postID'";
                        $userResult = mysqli_query($con, $userQuery);
                        $userResult1 = mysqli_query($con, $userQuery1);
                        $userResult2 = mysqli_query($con, $userQuery2);

                        if ($userResult && mysqli_num_rows($userResult) > 0) {
                            $userRow = mysqli_fetch_assoc($userResult);
                            $userRow1 = mysqli_fetch_assoc($userResult1);
                            $userRow2 = mysqli_fetch_assoc($userResult2);
                            $jobTitle = $userRow2["jobTitle"];
                            $fullName = $userRow["fullName"];
                            $facebook = $userRow["facebook"];
                            $instagram = $userRow["instagram"];
                            $linkedin = $userRow["linkedin"];
                            $github = $userRow["github"];
                            $contactNo = $userRow1["contactNo"];
                        }

                        echo "<tr>";
                        echo "<td align='center'>$jobTitle</td>";
                        echo "<td align='center'>$fullName</td>";
                        echo "<td align='center'>$facebook</td>";
                        echo "<td align='center'>$instagram</td>";
                        echo "<td align='center'>$linkedin</td>";
                        echo "<td align='center'>$github</td>";
                        echo "<td align='center'>$contactNo</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    // No job posts found
                    echo "<div class='main'>";
                    echo "<div class='container'>";
                    echo "<h1 class='heading'>Applications</h1>";
                    echo "<p>No applications found.</p>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>

            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        integrity="sha512-tfB2QZbrKQoLckwSFAaz7kH63vJy8VRWjGJTK3kx/yWj3YbR1F1eCEl/4jNRwRPMLpPXPwGnWwrY14tvFeIsow=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</html>