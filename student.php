<?php
// Include necessary files
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if user is logged in
if (isset($_SESSION['id'])) {
    // Include header and navigation
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Fetch student details from the database
    $sql = "SELECT *, studentid AS id FROM student";
    $result = mysqli_query($conn, $sql);

    // Start building the HTML content
    $data['content'] .= "<div style='background-color: #f8f9fa; padding: 20px;'>";

    // Start form
    $data['content'] .= "<form action='deletestudent.php' method='POST' 
    onsubmit=\"return confirm('Do you really want to submit the form?');\" 
    enctype='multipart/form-data'>";

    // Table headers
    $data['content'] .= "<h1 class='my-4'>Student Details</h1>";
    $data['content'] .= "<table class='table table-bordered'>";
    $data['content'] .= "<thead class='thead-dark'>";
    $data['content'] .= "<tr><th colspan='5' align='center'>Student Details</th></tr>";
    $data['content'] .= "<tr><th>StudentID</th><th>Password</th><th>Date Of Birth</th><th>Firstname</th><th>Lastname</th><th>House</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Image</th><th>Select</th></tr>";
    $data['content'] .= "</thead>";
    $data['content'] .= "<tbody>";

    // Display student data within the table
    while ($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<tr>";
        $data['content'] .= "<td>{$row["studentid"]}</td>";
        $data['content'] .= "<td>{$row["password"]}</td>";
        $data['content'] .= "<td>{$row["dob"]}</td>";
        $data['content'] .= "<td>{$row["firstname"]}</td>";
        $data['content'] .= "<td>{$row["lastname"]}</td>";
        $data['content'] .= "<td>{$row["house"]}</td>";
        $data['content'] .= "<td>{$row["town"]}</td>";
        $data['content'] .= "<td>{$row["county"]}</td>";
        $data['content'] .= "<td>{$row["country"]}</td>";
        $data['content'] .= "<td>{$row["postcode"]}</td>";
        
        // Check if image data is not null before encoding
        if ($row["photo"] !== null) {
            // Display image stored as BLOB data
            $imageData = base64_encode($row["photo"]);
            $data['content'] .= "<td><img src='data:image/jpeg;base64,{$imageData}' alt='Student Image' style='max-width: 100px; max-height: 100px;'></td>";
        } else {
            $data['content'] .= "<td>No Image</td>"; // Display placeholder if no image data
        }

        $data['content'] .= "<td><input type='checkbox' name='students[]' value='{$row["studentid"]}' /></td>";
        $data['content'] .= "</tr>";
    }

    // Close the table and form
    $data['content'] .= "</tbody>";
    $data['content'] .= "</table>";
    $data['content'] .= "<input type='submit' class='btn btn-danger' name='deletebtn' value='Delete' />";
    $data['content'] .= "</form>";
    $data['content'] .= "</div>"; // Close div

    // Render the template
    echo template("templates/default.php", $data);
    exit; // Exit the script after rendering the page content
} else {
    // Redirect to the login page if not logged in
    header("Location: index.php");
    exit; // Exit the script after redirection
}
?>

