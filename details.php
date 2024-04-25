<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if logged in
if (isset($_SESSION['id'])) {
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // If the form has been submitted
    if (isset($_POST['submit'])) {
        // Build an SQL statement to update the student details
        $sql = "UPDATE student SET ";
        $sql .= "firstname = '" . $_POST['txtfirstname'] . "', ";
        $sql .= "lastname = '" . $_POST['txtlastname'] . "', ";
        $sql .= "house = '" . $_POST['txthouse'] . "', ";
        $sql .= "town = '" . $_POST['txttown'] . "', ";
        $sql .= "county = '" . $_POST['txtcounty'] . "', ";
        $sql .= "country = '" . $_POST['txtcountry'] . "', ";
        $sql .= "postcode = '" . $_POST['txtpostcode'] . "' ";
        $sql .= "WHERE studentid = '" . $_SESSION['id'] . "';";
        $result = mysqli_query($conn, $sql);

        $data['content'] = "<div class='container'><div class='alert alert-success' role='alert'>Your details have been updated.</div></div>";

    } else {
        // Build a SQL statement to return the student record with the id that matches the session variable.
        $sql = "SELECT * FROM student WHERE studentid='" . $_SESSION['id'] . "';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        // Form for updating details
        $data['content'] = <<<EOD
        <div class="container">
            <h2 class="my-4">My Details</h2>
            <form name="frmdetails" action="" method="post">
                <div class="mb-3">
                    <label for="txtfirstname" class="form-label">First Name:</label>
                    <input name="txtfirstname" type="text" class="form-control" value="{$row['firstname']}" required>
                </div>
                <div class="mb-3">
                    <label for="txtlastname" class="form-label">Surname:</label>
                    <input name="txtlastname" type="text" class="form-control" value="{$row['lastname']}" required>
                </div>
                <div class="mb-3">
                    <label for="txthouse" class="form-label">Number and Street:</label>
                    <input name="txthouse" type="text" class="form-control" value="{$row['house']}" required>
                </div>
                <div class="mb-3">
                    <label for="txttown" class="form-label">Town:</label>
                    <input name="txttown" type="text" class="form-control" value="{$row['town']}" required>
                </div>
                <div class="mb-3">
                    <label for="txtcounty" class="form-label">County:</label>
                    <input name="txtcounty" type="text" class="form-control" value="{$row['county']}" required>
                </div>
                <div class="mb-3">
                    <label for="txtcountry" class="form-label">Country:</label>
                    <input name="txtcountry" type="text" class="form-control" value="{$row['country']}" required>
                </div>
                <div class="mb-3">
                    <label for="txtpostcode" class="form-label">Postcode:</label>
                    <input name="txtpostcode" type="text" class="form-control" value="{$row['postcode']}" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Save</button>
            </form>
        </div>
EOD;

    }

    // Render the template
    echo template("templates/default.php", $data);

} else {
    // Redirect to index.php if not logged in
    header("Location: index.php");
    exit();
}

echo template("templates/partials/footer.php");
?>
