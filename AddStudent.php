<?php
// Include necessary files
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {
   
   // Include header and navigation
   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // Handle form submission
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

         // Handle file upload
         $image = $_FILES['studentimage']['tmp_name'];
         $imagedata = addslashes(file_get_contents($image)); // Encode image data

         // Prepare SQL statement to insert student data into the database
         $sql = "INSERT INTO student (studentid, dob, firstname, lastname, house, town, county, country, postcode, password, photo)
                 VALUES ('$student_id', '$date_of_birth', '$first_name', '$last_name', '$house', '$town', '$county', '$country', '$postcode', '$hashed_password', '$imagedata')";

         // Execute SQL query
         if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
         } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         }
      }
   }
   
   // Display the form for adding a new student
   $data['content'] = <<<EOD
   <div class="container-fluid bg-light py-4">
      <div class="row justify-content-center">
         <div class="col-md-6">
            <h2 class="mb-4">Add New Student</h2>
            <form name="frmdetails" id="studentForm" action="" method="post" enctype="multipart/form-data">
               <div class="form-group">
                  <label for="studentid">Student ID:</label>
                  <input id="studentid" name="studentid" type="number" class="form-control" required />
               </div>
               <div class="form-group">
                  <label for="password">Password:</label>
                  <input id="password" name="password" type="password" class="form-control" required />
               </div>
               <div class="form-group">
                  <label for="dob">Date of Birth:</label>
                  <input id="dob" name="dob" type="date" class="form-control" />
               </div>
               <div class="form-group">
                  <label for="firstname">First Name:</label>
                  <input id="firstname" name="firstname" type="text" class="form-control" required />
               </div>
               <div class="form-group">
                  <label for="lastname">Last Name:</label>
                  <input id="lastname" name="lastname" type="text" class="form-control" required />
               </div>
               <div class="form-group">
                  <label for="house">Number and Street:</label>
                  <input id="house" name="house" type="text" class="form-control" required />
               </div>
               <div class="form-group">
                  <label for="town">Town:</label>
                  <input id="town" name="town" type="text" class="form-control" />
               </div>
               <div class="form-group">
                  <label for="county">County:</label>
                  <input id="county" name="county" type="text" class="form-control" />
               </div>
               <div class="form-group">
                  <label for="country">Country:</label>
                  <input id="country" name="country" type="text" class="form-control" />
               </div>
               <div class="form-group">
                  <label for="postcode">Postcode:</label>
                  <input id="postcode" name="postcode" type="text" class="form-control" required />
               </div>
               <div class="form-group">
                  <label for="studentimage">Student Image:</label>
                  <input type="file" name="studentimage" id="studentimage" class="form-control-file" accept="image/jpeg, image/png, image/jpg" required><br>
                  <div class="form-group">
                     <img id="preview" src="" alt="Student Image Preview" class="img-thumbnail">
                  </div>
               </div>
               <button type="submit" class="btn btn-primary">Save</button>
            </form>
         </div>
      </div>
   </div>

   <script>
      // JavaScript function for previewing uploaded image
      function previewImage(event) {
         var reader = new FileReader();
         reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
         };
         reader.readAsDataURL(event.target.files[0]);
      }
      // Attach event listener to the file input for image preview
      document.getElementById("studentimage").addEventListener("change", previewImage);
   </script>
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
