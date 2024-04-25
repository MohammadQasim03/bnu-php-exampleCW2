<?php
// Include necessary files
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if logged in
if (isset($_SESSION['id'])) {
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // If a module has been selected
    if (isset($_POST['selmodule'])) {
        $sql = "INSERT INTO studentmodules VALUES ('" .  $_SESSION['id'] . "','" . $_POST['selmodule'] . "');";
        $result = mysqli_query($conn, $sql);
        $module_name_sql = "SELECT name FROM module WHERE modulecode='" . $_POST['selmodule'] . "'";
        $module_name_result = mysqli_query($conn, $module_name_sql);
        $module_name = mysqli_fetch_assoc($module_name_result)['name'];
        $data['content'] .= "<div class='alert alert-success' role='alert'>The module <strong>$module_name</strong> has been assigned to you.</div>";
    } else { // If a module has not been selected
        // Build SQL statement that selects all the modules
        $sql = "SELECT * FROM module";
        $result = mysqli_query($conn, $sql);

        $data['content'] .= "<div style='background-color: #f8f9fa; padding: 20px;'>";
        $data['content'] .= "<form name='frmassignmodule' action='' method='post' class='my-4'>";
        $data['content'] .= "<label for='selmodule' class='form-label'>Select a module to assign</label>";
        $data['content'] .= "<select name='selmodule' class='form-select mb-3'>";
        
        // Display the module names in a dropdown selection box
        while ($row = mysqli_fetch_array($result)) {
            $data['content'] .= "<option value='$row[modulecode]'>$row[name]</option>";
        }
        
        $data['content'] .= "</select>";
        $data['content'] .= "<button type='submit' name='confirm' class='btn btn-primary'>Save</button>";
        $data['content'] .= "</form>";
        $data['content'] .= "</div>"; // Close div
    }

    // Render the template
    echo template("templates/default.php", $data);
    echo template("templates/partials/footer.php");
} else {
    // Redirect to index.php if not logged in
    header("Location: index.php");
    exit();
}
?>

