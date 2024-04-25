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

    // Handle file upload
    if(isset($_FILES['student_image'])) {
        $upload_directory = "uploads/"; // Directory to store uploaded files
        
        // Loop through each uploaded file
        foreach($_FILES['student_image']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['student_image']['name'][$key];
            $file_tmp = $_FILES['student_image']['tmp_name'][$key];
            
            // Move the uploaded file to the designated directory
            move_uploaded_file($file_tmp, $upload_directory . $file_name);
            
            // Update the database with the file path for each student
            $student_id = $_POST['student_id'][$key];
            $image = $upload_directory . $student_id . ".jpg"; // Assuming JPEG format
            $update_sql = "UPDATE student SET image_path='$image' WHERE studentid='$student_id'";
            mysqli_query($conn, $update_sql);
        }
    }

    // Fetch student details from the database
    $sql = "SELECT *, studentid AS id FROM student";
    $result = mysqli_query($conn, $sql);

    // Start building the HTML content
    $data['content'] .= "<div style='background-color: #f8f9fa; padding: 20px;'>";

    // Start form
    $data['content'] .= "<form action='deletestudent.php' method='POST' onsubmit=\"return confirm('Do you really want to submit the form?');\" enctype='multipart/form-data'>";

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
        $data['content'] .= " <td><img src='studentimage.php?id=$row[studentid]' height='100' width='100'  </td>";
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

