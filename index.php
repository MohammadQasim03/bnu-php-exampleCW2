<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   echo template("templates/partials/header.php");

   if (isset($_GET['return'])) {
      $msg = "";
      if ($_GET['return'] == "fail") {$msg = "Login Failed. Please try again.";}
      $data['message'] = "<p>$msg</p>";
   }

   if (isset($_SESSION['id'])) {
      $data['content'] = "<p>Welcome to your dashboard.";


// Content for the homepage
// Content for the homepage
$data['content'] = "
<div class='container mt-5'>
    <div class='row'>
        <div class='col-md-8 offset-md-2'>
            <h2 class='text-center mb-4'>Welcome to MQM College</h2>
            <p>MQM College offers specialized education in cyber security, engineering, and technology administration. We are committed to providing high-quality training to prepare students for careers in the digital age.</p>
            <p>Located in EG1 2ER Egham, Central London Boardway, our campus provides a conducive environment for learning and growth.</p>
            <p>Our mission is to empower students with the knowledge and skills necessary to excel in the field of cyber security and technology.</p>
            <p>At MQM College, we prioritize innovation, excellence, and integrity in everything we do.</p>
        </div>
    </div>
</div>";

      
      echo template("templates/partials/nav.php");
      echo template("templates/default.php", $data);
   } else {
      echo template("templates/login.php", $data);
   }

   echo template("templates/partials/footer.php");

   // another test edit

?>
