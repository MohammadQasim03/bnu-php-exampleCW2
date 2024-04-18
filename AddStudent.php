<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");
// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {
    
    var_dump($_POST);

      // build an sql statment to update the student details
    //   $sql = "update student set firstname ='" . $_POST['txtfirstname'] . "',";
    //   $sql .= "lastname ='" . $_POST['txtlastname']  . "',";
    //   $sql .= "house ='" . $_POST['txthouse']  . "',";
    //   $sql .= "town ='" . $_POST['txttown']  . "',";
    //   $sql .= "county ='" . $_POST['txtcounty']  . "',";
    //   $sql .= "country ='" . $_POST['txtcountry']  . "',";
    //   $sql .= "postcode ='" . $_POST['txtpostcode']  . "' ";
    //   $sql .= "where studentid = '" . $_SESSION['id'] . "';";

    //TO DO: INSERT SATEMENT 
    $sql = "INSERT INTO `student` (`password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`)
    VALUES ('$2y$10$.LJBOl64nZWEVVE/v5mgNuzR01zx1zoyXuGJUa/zp2U.MQxkps3LS', '$date_of_birth', '$first_name', '$last_name', '$truncated_house', '$town', '', '$country', '$Postcode[$i]')";
    
    echo $sql;

      $result = mysqli_query($conn,$sql);


      $data['content'] = "<p> Student Recorded has been Added</p>";

   }
   else {
    
      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <h2>Added New Students </h2>
   <form name="frmdetails" action="" method="post">
   Student ID :
   <input name="studentid" type="number" value="" /><br/>
   Password :
   <input name="Password" type="text" value="" /><br/>
   First Name :
   <input name="firstname" type="text" value="" /><br/>
   Surname :
   <input name="lastname" type="text"  value="" /><br/>
   Number and Street :
   <input name="house" type="text"  value="" /><br/>
   Town :
   <input name="town" type="text"  value="" /><br/>
   County :
   <input name="county" type="text"  value="" /><br/>
   Country :
   <input name="country" type="text"  value="" /><br/>
   Postcode :
   <input name="postcode" type="text"  value="" /><br/>
   <input type="submit" value="Save" name="submit"/>
   </form>

EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");
