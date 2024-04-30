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
        // Add more image paths as needed
    );
    // Return a random image path
    $image = $images[array_rand($images)];

 $imagedata = addslashes(file_get_contents($image));
 return $imagedata;
}

$array_students = array(
    array(
        "password" => "sdfgsdfg54",
        "dob" => "1989/11/21",
        "firstname" => "Aisha",
        "lastname" => "Khan",
        "house" => "23",
        "town" => "Manchester",
        "county" => "Lancashire",
        "country" => "United Kingdom",
        "postcode" => "M14 6TY",
    ),
    array(
        "password" => "ertyuio45",
        "dob" => "1994/07/15",
        "firstname" => "Zara",
        "lastname" => "Ahmed",
        "house" => "10",
        "town" => "Birmingham",
        "county" => "West Midlands",
        "country" => "United Kingdom",
        "postcode" => "B15 2DF",
    ),
    array(
        "password" => "dfghjkl65",
        "dob" => "1980/02/28",
        "firstname" => "Tom",
        "lastname" => "Smith",
        "house" => "45",
        "town" => "Liverpool",
        "county" => "Merseyside",
        "country" => "United Kingdom",
        "postcode" => "L1 1AB",
    ),
    array(
        "password" => "xcvbnm78",
        "dob" => "2002/09/30",
        "firstname" => "Sophie",
        "lastname" => "Jones",
        "house" => "17",
        "town" => "Leeds",
        "county" => "West Yorkshire",
        "country" => "United Kingdom",
        "postcode" => "LS1 3JY",
    ),
    array(
        "password" => "zxcvbnm92",
        "dob" => "1998/03/12",
        "firstname" => "Adam",
        "lastname" => "Brown",
        "house" => "73",
        "town" => "Sheffield",
        "county" => "South Yorkshire",
        "country" => "United Kingdom",
        "postcode" => "S1 2FG",
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
