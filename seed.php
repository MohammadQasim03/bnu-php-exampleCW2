<?php

require "_includes/config.inc";
require "_includes/dbconnect.inc";
require "_includes/functions.inc";

$students = [
    [
        "studentid" => "22225432",
        "password" => "jhytdcbn65",
        "dob" => "1990/04/09",
        "firstname" => "Munir",
        "lastname" => "Gorsi",
        "house" => "50",
        "town" => "Slough",
        "county" => "Berkshire",
        "country" => "United Kingdom",
        "postcode" => "SL1 1LM",
    ],
    [
        "studentid" => "22213254",
        "password" => "kocxrhmj09",
        "dob" => "1996/09/04",
        "firstname" => "Qasim",
        "lastname" => "Matloob",
        "house" => "1",
        "town" => "Slough",
        "county" => "Berkshire",
        "country" => "United Kingdom",
        "postcode" => "SL1 3KL",
    ],
    [
        "studentid" => "22645928",
        "password" => "dfrghuyb60",
        "dob" => "1981/03/07",
        "firstname" => "Jack",
        "lastname" => "Jacob",
        "house" => "7",
        "town" => "Reading",
        "county" => "Berkshire",
        "country" => "United Kingdom",
        "postcode" => "RG1 3QN",
    ],
    [
        "studentid" => "22275678",
        "password" => "qsuophcrf8",
        "dob" => "2001/05/08",
        "firstname" => "Alan",
        "lastname" => "Parkinson",
        "house" => "33",
        "town" => "London",
        "county" => "London",
        "country" => "United Kingdom",
        "postcode" => "NW10 9YT",
    ],
    [
        "studentid" => "2226543",
        "password" => "mqsxcght54",
        "dob" => "1999/01/02",
        "firstname" => "Kaleem",
        "lastname" => "Karim",
        "house" => "85",
        "town" => "Windsor",
        "county" => "Berkshire",
        "country" => "United Kingdom",
        "postcode" => "SL4 5GH",
    ],
];

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Loop through each student and insert into the database
    foreach ($students as $student_array) {
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
     
        // Building the SQL query
        $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
                VALUES ('$studentid','$password','$dob','$firstname', '$lastname', '$house', '$town', '$county', '$country', '$postcode')";
     
        $result = mysqli_query($conn, $sql);
     
        // Checking if the query was successful
        if ($result) {
            echo "Record inserted successfully for student with ID: $studentid<br>";
        } else {
            echo "Error inserting record: " . mysqli_error($conn) . "<br>";
        }
    }
} else {
    // Redirect to index.php if not logged in
    header("Location: index.php");
    exit();
}

?>

