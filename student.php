<?php
 
include("_includes/config.inc");

include("_includes/dbconnect.inc");

include("_includes/functions.inc");
 
if (isset($_SESSION['id']) ) {

    echo template("templates/partials/header.php");

    echo template("templates/partials/nav.php");
 
    $sql = "select * from student";

    $result = mysqli_query($conn, $sql);
 
    $data['content'] .= "<body>";

    $data['content'] .= "<form method='post' action='deletestudent.php' onsubmit='return confirmSubmission()'>";
      // Table to display student details
      $data['content'] .= "<table class='table table-striped'>";
      $data['content'] .= "<thead class='thead-dark'><tr><th colspan='12' class='text-center'>Student Details</th></tr></thead>";
      $data['content'] .= "<tr><th>Student ID</th><th>Name</th><th>Lastname</th><th>DOB</th><th>Street</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Hash</th><th>Student Image</th><th>Select</th></tr>";
 
    while ($row = mysqli_fetch_array($result)) {

        $data['content'] .= "<tr><td> $row[studentid] </td>";

        $data['content'] .= "<td> $row[firstname] </td>";

        $data['content'] .= "<td> $row[lastname] </td>";

        $data['content'] .= "<td> $row[dob] </td>";

        $data['content'] .= "<td> $row[house] </td>";

        $data['content'] .= "<td> $row[town] </td>";

        $data['content'] .= "<td> $row[county] </td>";

        $data['content'] .= "<td> $row[country] </td>";

        $data['content'] .= "<td> $row[postcode] </td>";

        $data['content'] .= "<td> $row[password] </td>";

        $data['content'] .= "<td><img src='data:image/jpeg;charset=utf8;base64," . base64_encode($row['photo']) . "' height='100' width='100'></td>";

        $data['content'] .= "<td><input type='checkbox' name='students[]' value='$row[studentid]'/> </td></tr>";

    }

    $data['content'] .= "</table>";

    $data['content'] .= "<div>";
 
    $data['content'] .= "<button type='submit'>Delete</button>";

    $data['content'] .= "</div>";

    $data['content'] .= "</form>";
 
    echo template("templates/default.php", $data);
 
    if (isset($_GET['error'])) {

        echo "<p style='color: red;font-weight: bold; '> $_GET[error]</p>";

    }
 
    echo "<div>";

    if (isset($_GET['success'])) {

        if ($_GET['success'] == 1) {

            echo "<p style='color: lightgreen;font-weight: bold; '> Successfully Deleted $_GET[success] Student</p>";

        } else {

            echo "<p style='color: lightgreen; font-weight: bold;'> Successfully Deleted $_GET[success] Students</p>";

        }

    }

    echo "</div>";

    $data['content'] .= "</body>";

} else {

    header("Location: index.php");

}
 
echo template("templates/partials/footer.php");
 
?>