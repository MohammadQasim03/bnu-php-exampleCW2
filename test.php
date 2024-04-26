<?php
   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

// checks whether we are logged in.
 {
// Array of student data
$array_students = array(
    array(
        "studentid" => "12342364",
        "password" => "doggy1234",
        "dob" => "2002-01-24",
        "firstname" => "James",
        "lastname" => "Bond",
        "house" => "10 Oak Avenue",
        "town" => "London",
        "county" => "Greater London",
        "country" => "United Kingdom",
        "postcode" => "SW1A 1AA",
    ),
    array(
        "studentid" => "98765432",
        "password" => "pass1234",
        "dob" => "1999-05-15",
        "firstname" => "Sophia",
        "lastname" => "Jones",
        "house" => "25 Willow Lane",
        "town" => "Manchester",
        "county" => "Greater Manchester",
        "country" => "United Kingdom",
        "postcode" => "M1 1AB",
    ),
    array(
        "studentid" => "56781234",
        "password" => "securePWD",
        "dob" => "2003-10-08",
        "firstname" => "Emily",
        "lastname" => "Taylor",
        "house" => "42 Elm Street",
        "town" => "Birmingham",
        "county" => "West Midlands",
        "country" => "United Kingdom",
        "postcode" => "B1 1AA",
    ),
    array(
        "studentid" => "34567890",
        "password" => "passphrase",
        "dob" => "1998-12-03",
        "firstname" => "Jack",
        "lastname" => "Brown",
        "house" => "8 Birch Avenue",
        "town" => "Glasgow",
        "county" => "Glasgow City",
        "country" => "United Kingdom",
        "postcode" => "G1 1AA",
    ),
    array(
        "studentid" => "78901234",
        "password" => "qwerty123",
        "dob" => "2001-07-20",
        "firstname" => "Amelia",
        "lastname" => "Wilson",
        "house" => "15 Pine Road",
        "town" => "Edinburgh",
        "county" => "City of Edinburgh",
        "country" => "United Kingdom",
        "postcode" => "EH1 1AA",
    ),
);
// Loop through each student and insert into the database
// foreach ($array_students as $key => $student_array) {
    foreach ($array_students as $student_array) {
    // Extracting values from the student array
    $studentid = mysqli_real_escape_string($conn, $student_array['studentid']);
    $password = mysqli_real_escape_string($conn, password_hash($student_array['password'], PASSWORD_DEFAULT));
    $dob = mysqli_real_escape_string($conn, $student_array['dob']);
    $firstname = mysqli_real_escape_string($conn, $student_array['firstname']);
    $lastname = mysqli_real_escape_string($conn, $student_array['lastname']);
    $house = mysqli_real_escape_string($conn, $student_array['house']);
    $town = mysqli_real_escape_string($conn, $student_array['town']);
    $county = mysqli_real_escape_string($conn, $student_array['county']);
    $country = mysqli_real_escape_string($conn, $student_array['country']);
    $postcode = mysqli_real_escape_string($conn, $student_array['postcode']);

    $random = rand(1,4);
    $image = "/Applications/XAMPP/xamppfiles/htdocs/bnu-php-exampleCW2".$random.".jpg";
    $imagedata = addslashes(file_get_contents($image));

    // Building the SQL query
    $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, image_path )
            VALUES ('$studentid','$password','$dob','$firstname', '$lastname', '$house', '$town', '$county', '$country', '$postcode', '$imagedata')";
    $result = mysqli_query($conn, $sql);
    // Checking if the query was successful
    if ($result) {
        echo "Record inserted successfully<br>";
    } else {
        echo "Error inserting record: " . mysqli_error($conn) . "<br>";
    }
}
}{
header("Location: index.php");
}
?>