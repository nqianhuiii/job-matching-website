<?php
session_start();
// Establish a database connection
$conn = new mysqli("localhost", "root", "jkty12138", "jjwq_jmp");

if (!$conn) {
    die('Could not connect: ' . mysqli_connect_error());
}
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$userID = $_SESSION['userID'];
$profileQuery = "SELECT * FROM profile WHERE userID = $userID";
$profileResult = mysqli_query($conn, $profileQuery);

if (!$profileResult) {
    die("Error executing the query: " . mysqli_error($conn));
}

if (mysqli_num_rows($profileResult) > 0) {
    $profileData = mysqli_fetch_assoc($profileResult);
} else {
    // No data found
    $profileData = false;
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
    /* Reset default styles */
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
        padding: 20px;
        text-align: center;
    }

    h1 {
        font-size: 24px;
    }

    .profile-section {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

    }

    .profile-section img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .profile-section h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .profile-section p {
        font-size: 16px;
        color: #777;
        margin-bottom: 10px;
    }

    .image-section {
        text-align: center;
        margin-bottom: 20px;
    }

    .image-section img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
        border: 2px solid #283E4A;
    }

    .image-section p {
        font-size: 16px;
        color: #777;
        margin-bottom: 10px;
    }


    .hidden {
        display: none;
    }

    .hidden1 {
        display: none;
    }

    button#toggleButton {
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        font-size: inherit;
        color: inherit;
        cursor: pointer;
        outline: none;
        text-decoration: underline;
    }

    button#toggle1Button {
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        font-size: inherit;
        color: inherit;
        cursor: pointer;
        outline: none;
        text-decoration: underline;
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

        </div>
    </nav>

    <br>


    <div class="container">
        <div class="image-section">
            <img src="image/profile-picture.jpg" alt="Profile Image">
        </div>

        <div class="profile-section">
            <center>
                <button class="btn btn-outline-secondary" onclick="window.location.href='user_form.php'">
                    Edit
                    Profile</button>
            </center>
            <h1>Introduction</h1>
            <br>
            <p>
                Name: <strong>
                    <?php echo isset($profileData['fullName']) ? $profileData['fullName'] : 'No data'; ?>
                </strong>
            </p>
            <p>
                Nationality: <strong>
                    <?php echo isset($profileData['nationality']) ? $profileData['nationality'] : 'No data'; ?>
                </strong>
            </p>
            <p>
                ResidentialStatus: <strong>
                    <?php echo isset($profileData['residentialStatus']) ? $profileData['residentialStatus'] : 'No data'; ?>
                </strong>
            </p>
            <p>
                Status: <strong>
                    <?php echo isset($profileData['status']) ? $profileData['status'] : 'No data'; ?>
                </strong>
            </p>
            <p>
                Specialization: <strong>
                    <?php echo isset($profileData['specialization']) ? $profileData['specialization'] : 'No data'; ?>
                </strong>
            </p>
            <p>
                Facebook: <strong>
                    <?php echo isset($profileData['facebook']) ? $profileData['facebook'] : 'No data'; ?>
                </strong>
            </p>
            <p>
                Instagram: <strong>
                    <?php echo isset($profileData['instagram']) ? $profileData['instagram'] : 'No data'; ?>
                </strong>
            </p>
            <p>
                LinkedIn: <strong>
                    <?php echo isset($profileData['linkedin']) ? $profileData['linkedin'] : 'No data'; ?>
                </strong>
            </p>
            <p>
                GitHub: <strong>
                    <?php echo isset($profileData['github']) ? $profileData['github'] : 'No data'; ?>
                </strong>
            </p>
        </div>


    </div>

</body>

</html>