<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Function to generate a random ID
function generateRandomID() {
    return mt_rand(10000000, 99999999); // Generate a random 8-digit number
}

// Function to generate a random image path
function getRandomImage() {
    // Array of sample image paths
    $images = array(
        "1.jpg",
        "2.jpg",
        "3.jpg",
        "4.jpg",
        "5.jpg",
        // Add more image paths as needed
    );
    // Return a random image path
    $image = $images[array_rand($images)];

 $imagedata = addslashes(file_get_contents($image));
 return $imagedata;
}

// Array of student data without IDs
$array_students = array(
    array(
        "password" => "jhytdcbn65",
        "dob" => "1990/04/09",
        "firstname" => "Munir",
        "lastname" => "Gorsi",
        "house" => "50",
        "town" => "Slough",
        "county" => "Berkshire",
        "country" => "United Kingdom",
        "postcode" => "SL1 1LM",
    ),
    array(
        "password" => "kocxrhmj09",
        "dob" => "1996/09/04",
        "firstname" => "Qasim",
        "lastname" => "Matloob",
        "house" => "1",
        "town" => "Slough",
        "county" => "Berkshire",
        "country" => "United Kingdom",
        "postcode" => "SL1 3KL",
    ),
    array(
        "password" => "dfrghuyb60",
        "dob" => "1981/03/07",
        "firstname" => "Jack",
        "lastname" => "Jacob",
        "house" => "7",
        "town" => "Reading",
        "county" => "Berkshire",
        "country" => "United Kingdom",
        "postcode" => "RG1 3QN",
    ),
    array(
        "password" => "qsuophcrf8",
        "dob" => "2001/05/08",
        "firstname" => "Alan",
        "lastname" => "Parkinson",
        "house" => "33",
        "town" => "London",
        "county" => "London",
        "country" => "United Kingdom",
        "postcode" => "NW10 9YT",
    ),
    array(
        "password" => "mqsxcght54",
        "dob" => "1999/01/02",
        "firstname" => "Kaleem",
        "lastname" => "Karim",
        "house" => "85",
        "town" => "Windoser",
        "county" => "Berkshire",
        "country" => "United Kingdom",
        "postcode" => "SL4 5GH",
    ),
);

// Loop through each student data
foreach ($array_students as $student_array) {
    // Generate a random ID
    $studentid = generateRandomID();

    // Check if studentid already exists in the database
    $check_query = "SELECT * FROM student WHERE studentid='$studentid'";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        // Student ID already exists, regenerate ID
        $studentid = generateRandomID();
    }

    // Proceed with insertion
    $password = $student_array['password'];
    $dob = $student_array['dob'];
    $firstname = $student_array['firstname'];
    $lastname = $student_array['lastname'];
    $house = $student_array['house'];
    $town = $student_array['town'];
    $county = $student_array['county'];
    $country = $student_array['country'];
    $postcode = $student_array['postcode'];

    // Generate a random image path
    $imagedata = getRandomImage();

    $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, photo) 
            VALUES ('$studentid', '$password', '$dob', '$firstname', '$lastname', '$house', '$town', '$county', '$country', '$postcode', '$imagedata')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully for student with ID $studentid<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
    }
}

?>
