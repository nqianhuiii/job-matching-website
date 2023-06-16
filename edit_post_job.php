<?php
// Establish a database connection
include("database/connectdb.php");

if (!$con) {

    die('Could not connect: ' . mysqli_connect_error());

}

// Get the post ID from the query string
$postID = $_GET["postID"];

// Fetch the job post details from the database
$sql = "SELECT * FROM postJobs WHERE postID = '$postID'";
$result =mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $jobTitle = $row["jobTitle"];
    $salaryRange = $row["salaryRange"];
    $typeOfOffer = $row["typeOfOffer"];
} else {
    // Job post not found
    die("Job post not found");
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobTitle = $_POST["jobTitle"];
    $salaryRange = $_POST["salaryRange"];
    $typeOfOffer = $_POST["typeOfOffer"];

    // Update the job post in the database
    $sql = "UPDATE postJobs SET jobTitle = '$jobTitle', salaryRange = '$salaryRange', typeOfOffer = '$typeOfOffer' WHERE postID = '$postID'";

    if (mysqli_query($con, $sql) === TRUE) {
        // Redirect to the job post management page
        header("Location: manage_posts_job.php?employerID=$employerID");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_connect_error();
    }
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Matching Platform - Edit Job Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Job Post</h1>

    <form method="post" action="manage_posts_job.php">
        <label for="jobTitle">Job Title:</label>
        <input type="text" name="jobTitle" id="jobTitle" value="<?php echo $jobTitle; ?>" required><br><br>

        <label for="salaryRange">Salary Range:</label>
        <input type="text" name="salaryRange" id="salaryRange" value="<?php echo $salaryRange; ?>" required><br><br>

        <label for="typeOfOffer">Type of Offer:</label>
        <input type="text" name="typeOfOffer" id="typeOfOffer" value="<?php echo $typeOfOffer; ?>" required><br><br>

        <input type="submit" value="Update Job Post">
    </form>
    </div>
</body>
</html>
