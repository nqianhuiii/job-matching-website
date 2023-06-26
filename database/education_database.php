<?php

$institution = $_POST['institution'];
$qualification = $_POST['qualification'];
$field = $_POST['field'];
$graduation = $_POST['graduation'];


$conn = new mysqli("localhost", "root", "","jjwq");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
  
    $max_jobseeker_id_query = "SELECT MAX(jobseeker_id) AS max_jobseeker_id FROM jobseeker";
    $max_jobseeker_id_result = $conn->query($max_jobseeker_id_query);
    $max_jobseeker_id_row = $max_jobseeker_id_result->fetch_assoc();
    $max_jobseeker_id = $max_jobseeker_id_row['max_jobseeker_id'];

    
    $jobseeker_id = $max_jobseeker_id;




   
    $stmt = $conn->prepare("INSERT INTO education (jobseeker_id, institution, qualification, field, graduation) VALUES (?, ?, ?, ?, ?)");

    // Iterate over the education details and insert each set of values
    for ($i = 0; $i < count($institution); $i++) {
        // Get the values from the arrays
        $inst = $institution[$i];
        $qual = $qualification[$i];
        $fld = $field[$i];
        $grad = $graduation[$i];

        // Bind the values to the prepared statement
        $stmt->bind_param("issss", $jobseeker_id, $inst, $qual, $fld, $grad);

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

    header("Location: education.php");
}
?>