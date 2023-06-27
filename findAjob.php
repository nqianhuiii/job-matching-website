<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JJWQ | Job Matching Platform</title>
    <link rel="icon" type="image/png" sizes="32x32" href="image/icon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;1,100;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/manage_post_job.css">

</head>

<body>
    <!--Add nav bar to every page, exp: sign up&login-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="image/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Job Finder
        </a>
        <div class="navbar-nav">
            <a class="nav-item nav-link " href="main_session.php">Home </a>
            <a class="nav-item nav-link active" href="findAjob.php">Find A Job</a>
            <a class="nav-item nav-link " href="about.php">About</a>
            <a class="nav-item nav-link " href="contact.php">Contact</a>
        </div>
    </nav>

    <div class="sdg">

        <?php
        // Get the employer ID from the query string
// Fetch job posts from the database for the specified employer
// Assuming you have a table named 'postJobs' with columns such as 'jobTitle' and 'salaryRange'
// Modify the query and table structure based on your actual setup
        include('database/connectdb.php');

        if (!$con) {
            die('Could not connect: ' . mysqli_connect_error());
        }

        $sql = "SELECT * FROM postJobs";
        $result = mysqli_query($con, $sql);

        // Check if any job posts were found
        if ($result->num_rows > 0) {
            // Job posts found, display them in a table
            echo "<div class='main'>";
            echo "<div class='container'>";
            echo "<h1 class='heading'>Available Job(s)</h1>";
            echo "<div class='table-container'>";
            echo "<table class='job-post-table'>";
            echo "<thead><tr><th>Job Title</th><th>Company</th><th>Salary Range</th><th>Type Offer</th><th>Description</th><th>Action</th></tr></thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $postID = $row["postID"];
                $jobTitle = $row["jobTitle"];
                $company = $row["company"];
                $salaryRange = $row["salaryRange"];
                $typeOfOffer = $row["typeOfOffer"];
                $description = $row["description"];

                echo "<tr>";
                echo "<td>$jobTitle</td>";
                echo "<td>$company</td>";
                echo "<td>$salaryRange</td>";
                echo "<td>$typeOfOffer</td>";
                echo "<td>$description</td>";
                echo "<td><a href='apply.php?postID=$postID' onclick='return confirmApply()'>Apply</a></td>";
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
            echo "<h1 class='heading'>Manage Job Posts</h1>";
            echo "<p>No job posts found.</p>";
            echo "</div>";
            echo "</div>";
        }

        mysqli_close($con);
        ?>
    </div>

    <script>
        function confirmApply() {
            return confirm("Are you sure you want to apply for this job?");
        }
    </script>



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