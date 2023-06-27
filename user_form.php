<?php
// Start the session
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "jkty12138", "jjwq_jmp");
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit;
}

// Check if the user is logged in
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];

    // Fetch the user's profile data from the database
    $profileQuery = "SELECT * FROM profile WHERE jobSeekerID = $userID";
    $profileResult = mysqli_query($conn, $profileQuery);

    if (!$profileResult) {
        die("Error executing the query: " . mysqli_error($conn));
    }

    $profileData = mysqli_fetch_assoc($profileResult);
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>

<head>
    <title>JJWQ | Job Matching Platform</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./image/icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./image/icon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;1,100;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;1,100;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* Global styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }

    header {
        background-color: #283E4A;
        color: #fff;
        padding: 20px 0;
    }

    header h1 {
        font-size: 24px;
        text-align: center;
    }

    .profile-section {
        background-color: #fff;
        padding: 20px;
        margin: 20px 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .profile-details h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }

    .profile-details p {
        font-size: 16px;
        color: #777;
        margin-bottom: 10px;
    }

    .social-icons {
        margin-top: 20px;
    }

    .social-icons a {
        color: #555;
        text-decoration: none;
        font-size: 20px;
        margin-right: 10px;
    }

    .form-section {
        background-color: #fff;
        padding: 20px;
        margin: 20px 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #283E4A;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .button-group a {
        text-decoration: none;
    }

    .button-group button {
        padding: 10px 20px;
        background-color: #283E4A;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        margin-right: 10px;
    }

    .button-group button:hover {
        background-color: #47657D;
    }

    footer {
        background-color: #283E4A;
        color: #fff;
        padding: 10px 0;
        text-align: center;
    }

    footer p {
        font-size: 14px;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="./image/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Job Finder
        </a>
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="main_session.php">Home </a>
            <center>
                <button class="btn btn-outline-secondary" onclick="window.location.href='display.php'">Display
                    Profile</button>
            </center>

        </div>
    </nav>

    <div class="form-section">
        <div class="container">
            <h2>Edit Profile:</h2>
            <form action="database/profile_database.php" method="POST">
                <div class="about_section">
                    <div class="form-group">
                        <label for="fullNameInput">Full Name:</label>
                        <input type="text" id="fullNameInput" name="fullName" value="<?php echo isset($profileData['fullName']) ? $profileData['fullName'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nationalityInput">Nationality:</label>
                        <input type="text" id="nationalityInput" name="nationality" value="<?php echo isset($profileData['nationality']) ? $profileData['nationality'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="residentialStatusInput">Residential Status:</label>
                        <input type="text" id="residentialStatusInput" name="residentialStatus" value="<?php echo isset($profileData['residentialStatus']) ? $profileData['residentialStatus'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="statusInput">Status:</label>
                        <input type="text" id="statusInput" name="status" value="<?php echo isset($profileData['status']) ? $profileData['status'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="specializationInput">Specialization:</label>
                        <input type="text" id="specializationInput" name="specialization" value="<?php echo isset($profileData['specialization']) ? $profileData['specialization'] : ''; ?>">
                    </div>
                </div>

                <div class="social_section">
                    <div class="form-group">
                        <label for="facebookInput">Facebook:</label>
                        <input type="text" id="facebookInput" name="facebook" value="<?php echo isset($profileData['facebook']) ? $profileData['facebook'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="instagramInput">Instagram:</label>
                        <input type="text" id="instagramInput" name="instagram" value="<?php echo isset($profileData['instagram']) ? $profileData['instagram'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="linkedinInput">LinkedIn:</label>
                        <input type="text" id="linkedinInput" name="linkedin" value="<?php echo isset($profileData['linkedin']) ? $profileData['linkedin'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="githubInput">GitHub:</label>
                        <input type="text" id="githubInput" name="github" value="<?php echo isset($profileData['github']) ? $profileData['github'] : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit">Save</button>
                </div>
            </form>

            <hr>
            </hr>

        </div>
    </div>


</body>

</html>