<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if user is logged in
if (isset($_SESSION['id'])) {
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Build SQL statement to select unique student details
    $sql = "Select * from student;";
    $result = mysqli_query($conn, $sql);

    // Start the form
    $data['content'] .= "<form action='deletestudent.php' method='POST' onsubmit=\"return confirm('Do you really want to submit the form?');\">";

    // Prepare page content - opening table tag
    $data['content'] .= "<table border='1'>";
    $data['content'] .= "<tr><th colspan='5' align='center'>Student Details</th></tr>";
    $data['content'] .= "<tr><th>StudentID</th><th>Password</th><th>Date Of Birth</th><th>Firstname</th><th>Lastname</th><th>House</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Select</th></tr>";

    // Display the student data within the HTML table
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
        $data['content'] .= "<td> <input type='checkbox' name='students[]' value='{$row["studentid"]}' /> </td>";
        $data['content'] .= "</tr>";
    }

    // Close the table
    $data['content'] .= "</table>";

    // Add delete button / Added Javascript Validation.
    $data['content'] .= "<input type='submit' name='deletebtn' value='Delete' />";

    // Close the form
    $data['content'] .= "</form>";

    // Render the template
    echo template("templates/default.php", $data);
    exit; // Exit the script after rendering the page content
} else {
    header("Location: index.php");
    exit; // Exit the script after redirecting
}
?>









