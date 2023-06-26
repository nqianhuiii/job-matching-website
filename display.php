<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'jjwq';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$maxJobseekerIdQuery = "SELECT MAX(jobseeker_id) AS max_id FROM jobseeker";
$result = mysqli_query($conn, $maxJobseekerIdQuery);
$row = mysqli_fetch_assoc($result);
$maxJobseekerId = $row['max_id'];

// Retrieve image data
$imageQuery = "SELECT * FROM images WHERE jobseeker_id = $maxJobseekerId";
$imageResult = mysqli_query($conn, $imageQuery);
$imageRow = mysqli_fetch_assoc($imageResult);
$imageUrl = $imageRow['image'];

// Retrieve profile data
$profileQuery = "SELECT * FROM profile WHERE jobseeker_id = $maxJobseekerId";
$profileResult = mysqli_query($conn, $profileQuery);
$profileData = mysqli_fetch_assoc($profileResult);

// Retrieve education data

$educationQuery = "SELECT * FROM education WHERE jobseeker_id = $maxJobseekerId";
$educationResult = mysqli_query($conn, $educationQuery);

$experienceQuery = "SELECT * FROM experience WHERE jobseeker_id = $maxJobseekerId";
$experienceResult = mysqli_query($conn, $experienceQuery);

$expectationQuery = "SELECT * FROM expectation WHERE jobseeker_id = $maxJobseekerId";
$expectationResult = mysqli_query($conn, $expectationQuery);
$expectData = mysqli_fetch_assoc($expectationResult);


// Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html>

<head>
    <title>LinkedIn Profile</title>

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

    .education-section {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .education-section h3 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .education-section ul {
        list-style-type: disc;
        padding-left: 20px;
    }

    .education-section li {
        font-size: 16px;
        color: #555;
        margin-bottom: 10px;
    }

    .education-section li strong {
        font-weight: bold;
    }

    .experience-section {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .experience-section h3 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .experience-section ul {
        list-style-type: disc;
        padding-left: 20px;
    }

    .experience-section li {
        font-size: 16px;
        color: #555;
        margin-bottom: 10px;
    }

    .experience-section li strong {
        font-weight: bold;
    }



    footer {
        background-color: #283E4A;
        color: #fff;
        padding: 10px;
        text-align: center;
    }

    footer p {
        font-size: 14px;
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

    .expectation-section {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .expectation-section p {
        font-size: 16px;
        color: #777;
        margin-bottom: 10px;
    }

    .expectation-section p strong {
        font-weight: bold;
    }
</style>

<body>
    <header>
        <h1>My Profile</h1>
    </header>

    <div class="container">
        <div class="image-section">
            <img src="<?php echo $imageUrl; ?>" alt="Profile Image">
            <p>
                <?php echo $imageRow['image_text']; ?>
            </p>
        </div>

        <div class="profile-section">
            <h1>Introduction</h1>
            <br>
            <p>
                Name:<strong>
                    <?php echo $profileData['fullName']; ?>
                </strong>
            </p>
            <p>
                Nationality:<strong>
                    <?php echo $profileData['nationality']; ?>
                </strong>
            </p>
            <p>
                ResidentialStatus:<strong>
                    <?php echo $profileData['residentialStatus']; ?>
                </strong>
            </p>
            <p>
                Status:<strong>
                    <?php echo $profileData['status']; ?>
                </strong>
            </p>
            <p>
                Specialization:<strong>
                    <?php echo $profileData['specialization']; ?>
                </strong>
            </p>
            <p>
                Facebook:<strong>
                    <?php echo $profileData['facebook']; ?>
                </strong>
            </p>
            <p>
                Instagram:<strong>
                    <?php echo $profileData['instagram']; ?>
                </strong>
            </p>
            <p>
                LinkedIn:<strong>
                    <?php echo $profileData['linkedin']; ?>
                </strong>
            </p>
            <p>
                Git hub:<strong>
                    <?php echo $profileData['github']; ?>
                </strong>
            </p>
        </div>


        <div class="education-section">
            <?php

            $educationSql = "SELECT * FROM education WHERE jobseeker_id = $maxJobseekerId";



            if ($educationResult->num_rows > 0) {

                echo "<h2>Education</h2>";
                echo "</br>";

                while ($educationRow = $educationResult->fetch_assoc()) {
                    $institution = $educationRow['institution'];
                    $qualification = $educationRow['qualification'];
                    $field = $educationRow['field'];
                    $graduation = $educationRow['graduation'];

                    echo "<li class='hidden'>";
                    echo "<strong>Institution:</strong> $institution<br>";
                    echo "<strong>Qualification:</strong> $qualification<br>";
                    echo "<strong>Field:</strong> $field<br>";
                    echo "<strong>Graduation:</strong> $graduation<br>";
                    echo "</li>";



                }



            }
            ?>
            <button id="toggleButton">Click to see</button>

        </div>

        <div class="experience-section">
            <?php
            $educationSql = "SELECT * FROM experience WHERE jobseeker_id = $maxJobseekerId";


            if ($experienceResult->num_rows > 0) {
                echo "<h2>Experience</h2>";
                echo "</br>";

                while ($experienceRow = $experienceResult->fetch_assoc()) {
                    $jobTitle = $experienceRow['jobTitle'];
                    $company = $experienceRow['company'];
                    $description = $experienceRow['description'];
                    $startyear = $experienceRow['startyear'];
                    $endyear = $experienceRow['endyear'];

                    echo "<li class='hidden1'>";
                    echo "<strong>Job Title:</strong>  $jobTitle<br>";
                    echo "<strong>Company:</strong>  $company<br>";
                    echo "<strong>Description:</strong>  $description<br>";
                    echo "<strong>Start year:</strong>  $startyear<br>";
                    echo "<strong>End year:</strong>  $endyear<br>";


                    echo "</li>";



                }



            }
            ?>
            <button id="toggle1Button">Click to see</button>

        </div>

        <div class="expectation-section">
            <h1>Expectation</h1>
            <br>
            <p>
                Salary:<strong>
                    <?php echo $expectData['salary']; ?>
                </strong>
            </p>
            <p>
                Location:<strong>
                    <?php echo $expectData['location']; ?>
                </strong>
            </p>
        </div>



    </div>

    <footer>
        <p>&copy; 2023 MyProfile. All rights reserved.</p>
    </footer>
    <script>

        const toggleButton = document.getElementById('toggleButton');
        const educationItems = document.querySelectorAll('.education-section li');

        toggleButton.addEventListener('click', function () {
            educationItems.forEach(function (item) {
                item.classList.toggle('hidden');
            });

            if (toggleButton.textContent === 'Click to see') {
                toggleButton.textContent = 'Click to close';
            } else {
                toggleButton.textContent = 'Click to see';
            }
        });

        const toggle1Button = document.getElementById('toggle1Button');
        const experienceItems = document.querySelectorAll('.experience-section li');

        toggle1Button.addEventListener('click', function () {
            experienceItems.forEach(function (item1) {
                item1.classList.toggle('hidden1');
            });

            if (toggle1Button.textContent === 'Click to see') {
                toggle1Button.textContent = 'Click to close';
            } else {
                toggle1Button.textContent = 'Click to see';
            }
        });


    </script>

</body>

</html>