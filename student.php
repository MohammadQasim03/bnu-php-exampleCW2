<?php // Start PHP script
include("_includes/config.inc"); // Include configuration file
include("_includes/dbconnect.inc"); // Include database connection file
include("_includes/functions.inc"); // Include functions file

if (isset($_SESSION['id']) ) { // Check if session ID is set
    echo template("templates/partials/header.php"); // Include header template
    echo template("templates/partials/nav.php"); // Include navigation template

    $sql = "select * from student"; // SQL query to select all student data
    $result = mysqli_query($conn, $sql); // Execute SQL query
    $data['content'] .= "<body>"; // Start HTML body
    $data['content'] .= "<form method='post' action='deletestudent.php' onsubmit='return confirmSubmission()'>"; // Form for deleting students with confirmation

    // Table to display student details
    $data['content'] .= "<table class='table table-striped'>";
    $data['content'] .= "<thead class='thead-dark'><tr><th colspan='12' class='text-center'>Student Details</th></tr></thead>";
    $data['content'] .= "<tr><th>Student ID</th><th>Name</th><th>Lastname</th><th>DOB</th><th>Street</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Hash</th><th>Student Image</th><th>Select</th></tr>";

    while ($row = mysqli_fetch_array($result)) { // Loop through each row of student data
        $data['content'] .= "<tr><td> $row[studentid] </td>"; // Display student ID
        $data['content'] .= "<td> $row[firstname] </td>"; // Display student first name
        $data['content'] .= "<td> $row[lastname] </td>"; // Display student last name
        $data['content'] .= "<td> $row[dob] </td>"; // Display student date of birth
        $data['content'] .= "<td> $row[house] </td>"; // Display student house
        $data['content'] .= "<td> $row[town] </td>"; // Display student town
        $data['content'] .= "<td> $row[county] </td>"; // Display student county
        $data['content'] .= "<td> $row[country] </td>"; // Display student country
        $data['content'] .= "<td> $row[postcode] </td>"; // Display student postcode
        $data['content'] .= "<td> $row[password] </td>"; // Display student password (this might be sensitive information)
        $data['content'] .= "<td><img src='data:image/jpeg;charset=utf8;base64," . base64_encode($row['photo']) . "' height='100' width='100'></td>"; // Display student image
        $data['content'] .= "<td><input type='checkbox' name='students[]' value='$row[studentid]'/> </td></tr>"; // Checkbox to select student for deletion
    }

    $data['content'] .= "</table>"; // End of table
    $data['content'] .= "<div>"; // Start of div for delete button
    $data['content'] .= "<button type='submit'>Delete</button>"; // Delete button
    $data['content'] .= "</div>"; // End of div for delete button
    $data['content'] .= "</form>"; // End of form

    echo template("templates/default.php", $data); // Include default template with data
    if (isset($_GET['error'])) { // Check if there's an error message in the URL
        echo "<p style='color: red;font-weight: bold; '> $_GET[error]</p>"; // Display error message
    }

    echo "<div>"; // Start of div for success message
    if (isset($_GET['success'])) { // Check if there's a success message in the URL
        if ($_GET['success'] == 1) { // Check if it's a singular success message
            echo "<p style='color: lightgreen;font-weight: bold; '> Successfully Deleted $_GET[success] Student</p>"; // Display singular success message
        } else {
            echo "<p style='color: lightgreen; font-weight: bold;'> Successfully Deleted $_GET[success] Students</p>"; // Display plural success message
        }
    }

    echo "</div>"; // End of div for success message
    $data['content'] .= "</body>"; // End of HTML body
} else {
    header("Location: index.php"); // Redirect to index.php if session ID is not set
}

echo template("templates/partials/footer.php"); // Include footer template

?>

<script>
function confirmSubmission() {
    return confirm("Are you sure you want to delete the selected students?");
}
</script>