<?php
// Establish a database connection
include("database/connectdb.php");

if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

// Get the post ID from the query string
if (!isset($_GET["postID"])) {
    die("Job post not found");
}
$postID = $_GET["postID"];

// Fetch the job post details from the database
$sql = "SELECT * FROM postJobs WHERE postID = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $postID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $jobTitle = $row["jobTitle"];
    $company = $row["company"];
    $salaryRange = $row["salaryRange"];
    $typeOfOffer = $row["typeOfOffer"];
    $description = $row["description"];
} else {
    // Job post not found
    die("Job post not found");
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobTitle = $_POST["jobTitle"];
    $company = $_POST["company"];
    $salaryRange = $_POST["salaryRange"];
    $typeOfOffer = $_POST["typeOfOffer"];
    $description = $_POST["description"];

    // Update the job post in the database
    $sql = "UPDATE postJobs SET jobTitle = ?, company = ?, salaryRange = ?, typeOfOffer = ?, description = ? WHERE postID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssss", $jobTitle, $company, $salaryRange, $typeOfOffer, $description, $postID);

    if ($stmt->execute()) {
        // Redirect to the job post management page
        header("Location: manage_posts_job.php?employerID=" . $row['employerID']);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close the database connection
$stmt->close();
$con->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Matching Platform - Edit Job Post</title>
    <link rel="stylesheet" href="css/edit_post_job.css">
</head>
<body>
<div class="container">
    <h1>Edit Job Post</h1>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . '?postID=' . $postID; ?>">
        <label for="jobTitle">Job Title:</label>
        <input type="text" name="jobTitle" id="jobTitle" value="<?php echo $jobTitle; ?>" required><br><br>

        <label for="company">Company:</label>
        <input type="text" name="company" id="company" value="<?php echo $company; ?>" required><br><br>

        <label for="salaryRange">Salary Range:</label>
        <input type="text" name="salaryRange" id="salaryRange" value="<?php echo $salaryRange; ?>" required><br><br>

        <label for="typeOfOffer">Type of Offer:</label>
        <input type="text" name="typeOfOffer" id="typeOfOffer" value="<?php echo $typeOfOffer; ?>" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo $description; ?></textarea><br><br>

        <input type="submit" value="Update Job Post">
    </form>
</div>
<script>
    // Function to validate the form before submission
    function validateForm(event) {
        var jobTitle = document.getElementById('jobTitle').value;
        var company = document.getElementById('company').value;
        var salaryRange = document.getElementById('salaryRange').value;
        var typeOfOffer = document.getElementById('typeOfOffer').value;
        var description = document.getElementById('description').value;

        if (jobTitle.trim() === '' || company.trim() === '' || salaryRange.trim() === '' ||
            typeOfOffer.trim() === '' || description.trim() === '') {
            alert('Please fill out all the required fields.');
            event.preventDefault(); // Prevent form submission
        }

        // Additional validation logic can be added here
    }

    // Attach the function to the form's onsubmit event
    var form = document.querySelector('form');
    form.addEventListener('submit', validateForm);
</script>
</body>
</html>

