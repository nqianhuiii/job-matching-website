<?php
$jobTitle = $_POST['jobTitle'];
$company = $_POST['company'];
$description = $_POST['description'];
$startyear = $_POST['startyear'];
$endyear = $_POST['endyear'];


// Database connection
$conn = new mysqli("localhost", "root", "","jjwq");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    // Get the current maximum jobseeker_id from the jobseeker table
    $max_jobseeker_id_query = "SELECT MAX(jobseeker_id) AS max_jobseeker_id FROM jobseeker";
    $max_jobseeker_id_result = $conn->query($max_jobseeker_id_query);
    $max_jobseeker_id_row = $max_jobseeker_id_result->fetch_assoc();
    $max_jobseeker_id = $max_jobseeker_id_row['max_jobseeker_id'];

    // Increment the jobseeker_id by 1
    $jobseeker_id = $max_jobseeker_id;


    // Prepare the insert statement
    $stmt = $conn->prepare("INSERT INTO experience(jobseeker_id, jobTitle, company, description, startyear,endyear) VALUES (?, ?, ?, ?, ?,?)");

    // Iterate over the education details and insert each set of values
    for ($i = 0; $i < count($jobTitle); $i++) {
        // Get the values from the arrays
        $j = $jobTitle[$i];
        $c = $company[$i];
        $d = $description[$i];
        $s = $startyear[$i];
        $e = $endyear[$i];

        // Bind the values to the prepared statement
        $stmt->bind_param("isssss", $jobseeker_id, $j, $c, $d, $s, $e);

        // Execute the statement for each set of values
        $execval = $stmt->execute();

        // Check if the execution was successful
        if (!$execval) {
            echo "Error: Failed to insert data into the database.";
            break;
        }
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();

    header("Location: experience.php");
}
?>