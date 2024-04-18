<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if user is logged in
if (isset($_SESSION['id'])) {

    // Check if students array is set and not empty
    if (!empty($_POST['students'])) {
        // Loop over the selected students and build the SQL query to delete them
        foreach ($_POST['students'] as $studentId) {
            // Escape the student ID to prevent SQL injection
            $escapedStudentId = mysqli_real_escape_string($conn, $studentId);
            // Add each student ID to the SQL query
            $sql = "DELETE FROM student WHERE studentid = '$escapedStudentId';";
            // Run the query
            $result = mysqli_query($conn, $sql);
            // Check if the query was successful
            if (!$result) {
                // Handle the case where the deletion failed
                echo "Error deleting student with ID: $studentId<br>";
            }
        }
    } else {
        // Handle the case where no students were selected for deletion
        echo "No students selected for deletion<br>";
    }

    // Redirect to student.php after handling form submission
    header("Location: student.php");
    exit; // Exit the script after redirecting
} else {
    // Redirect to index.php if user is not logged in
    header("Location: index.php");
    exit; // Exit the script after redirecting
}
?>
