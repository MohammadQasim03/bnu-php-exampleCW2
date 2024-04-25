<?php
// Set content type to specify that the response will be an image
header("Content-type: image/jpg, image/jpeg");
// header("Content-type: image/jpeg");

// Include the database connection file
include ("_include/dbconnect.inc");

// SQL query to select the student image based on the provided student ID ($_GET['id'])
$sql = "SELECT image FROM student WHERE studentid='$_GET[id]'";

// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Fetch the result row
$row = mysqli_fetch_array($result);

// Get the student image data from the fetched row
$image = $row["image"];

// Output the image data, which will display the image in the browser
echo $image;

// Close the database connection
mysqli_close($conn);
?>
