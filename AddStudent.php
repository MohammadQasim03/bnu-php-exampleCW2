<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {
   
   // Include header and navigation
   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // Handle form submission
   if (isset($_POST['submit'])) {
      // Validate form inputs (you can add more validation as needed)
      if (empty($_POST['password'])) {
         echo "Password is required.";
      } else {
         // Hash the password
         $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

         // Extract form data
         $date_of_birth = $_POST['dob'];
         $first_name = $_POST['firstname'];
         $last_name = $_POST['lastname'];
         $house = $_POST['house'];
         $town = $_POST['town'];
         $county = $_POST['county'];
         $country = $_POST['country'];
         $postcode = $_POST['postcode'];
         $student_id = $_POST['studentid'];

         // Prepare SQL statement
         $sql = "INSERT INTO `student` (`studentid`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`, `password`)
                 VALUES ('$student_id', '$date_of_birth', '$first_name', '$last_name', '$house', '$town', '$county', '$country', '$postcode', '$hashed_password')";

         // Execute SQL query
         if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
         } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         }
      }
   }
   
   // Display the form
   $data['content'] = <<<EOD
   <h2>Add New Student</h2>
   <form name="frmdetails" action="" method="post">
      Student ID:
      <input name="studentid" type="number" required /><br/>
      Password:
      <input name="password" type="password" required /><br/>
      Date of Birth:
      <input name="dob" type="date" /><br/>
      First Name:
      <input name="firstname" type="text" /><br/>
      Last Name:
      <input name="lastname" type="text" /><br/>
      Number and Street:
      <input name="house" type="text" /><br/>
      Town:
      <input name="town" type="text" /><br/>
      County:
      <input name="county" type="text" /><br/>
      Country:
      <input name="country" type="text" /><br/>
      Postcode:
      <input name="postcode" type="text" /><br/>
      <input type="submit" value="Save" name="submit"/>
   </form>
EOD;

   // Render the template
   echo template("templates/default.php", $data);

   // Include footer
   echo template("templates/partials/footer.php");

} else {
   // Redirect to index.php if not logged in
   header("Location: index.php");
   exit();
}
?>
