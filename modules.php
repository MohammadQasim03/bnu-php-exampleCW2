<?php
   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   // check logged in
   if (isset($_SESSION['id'])) {
      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      // Build SQL statement that selects a student's modules
      $sql = "SELECT * FROM studentmodules sm, module m WHERE m.modulecode = sm.modulecode AND sm.studentid = '" . $_SESSION['id'] ."';";
      $result = mysqli_query($conn, $sql);

      // Prepare page content
      $modules_html = "<div class='container'>";
      $modules_html .= "<div class='row'>";
      $modules_html .= "<div class='col'>";
      $modules_html .= "<h2>Modules</h2>";
      $modules_html .= "<div class='table-responsive'>";
      $modules_html .= "<table class='table table-bordered'>";
      $modules_html .= "<thead class='thead-dark'>";
      $modules_html .= "<tr>";
      $modules_html .= "<th scope='col'>Code</th>";
      $modules_html .= "<th scope='col'>Type</th>";
      $modules_html .= "<th scope='col'>Level</th>";
      $modules_html .= "</tr>";
      $modules_html .= "</thead>";
      $modules_html .= "<tbody>";

      // Display the modules within the HTML table
      while ($row = mysqli_fetch_array($result)) {
         $modules_html .= "<tr>";
         $modules_html .= "<td>" . $row['modulecode'] . "</td>";
         $modules_html .= "<td>" . $row['name'] . "</td>";
         $modules_html .= "<td>" . $row['level'] . "</td>";
         $modules_html .= "</tr>";
      }

      $modules_html .= "</tbody>";
      $modules_html .= "</table>";
      $modules_html .= "</div>"; // Close table-responsive
      $modules_html .= "</div>"; // Close col
      $modules_html .= "</div>"; // Close row
      $modules_html .= "</div>"; // Close container

      // Render the template
      echo $modules_html;
      echo template("templates/partials/footer.php");

   } else {
      header("Location: index.php");
   }
?>
