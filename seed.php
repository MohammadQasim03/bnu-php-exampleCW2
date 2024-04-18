<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Sample arrays

$studentid = array(
    "80000000",
    "30000000",
    "40000000",
    "50000000",
    "60000000",
);

$first_names = array(
    "Mohammad",
    "Munir",
    "Joyson",
    "Keegan",
    "Imaan"
);

$county = array(
    "Bucks",
    "Surry",
    "Berkshire",
    "Yorkshire",
    "Hertfordshire",
);
$last_names = array(
    "Matloob",
    "Goris",
    "Fernadas",
    "Desouza",
    "Majid"
);

$countries = array(
    "USA",
    "Canada",
    "UK",
    "Australia",
    "Germany"
);

$birth_dates = array(
    "1995-01-15",
    "1998-05-20",
    "1992-09-10",
    "1997-11-25",
    "1990-03-05"
);

$towns = array(
    "Slough",
    "Bucks",
    "Nottingham",
    "Plymouth",
    "London",
);

// $ages = array(
//     "27",
//     "24",
//     "29",
//     "22",
//     "32"
// );

$house = array(
    "20 high street",
    "40 High Wycombe Street",
    "60 Manchestor High Light Street",
    "55 Nottingham Chalvey Street",
    "100 Reading Clive Road"
);

$Postcode = array(
    "SL1 2SQ",
    "ENG 5TH",
    "RD1 3PQ",
    "MK1 5TF",
    "LNK 9H0"
); 
// Insert data into database
for ($i = 0; $i < 5; $i++) {
    $student_id = $studentid[$i]; 
    $first_name = $first_names[$i];
    $last_name = $last_names[$i];
    $country = $countries[$i];
    $date_of_birth = $dates_of_birth[$i];
    $town = $towns[$i];
    // $age = $ages[$i];
    $truncated_house = substr($house[$i], 0, 255); // Truncate house data if needed

    // SQL query to insert data without specifying studentid
    $sql = "INSERT INTO `student` (`password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`)
    VALUES ('$date_of_birth', '$first_name', '$last_name', '$truncated_house', '$town', '', '$country', '$Postcode[$i]')"; 

    

    $result = mysqli_query($conn, $sql); // Execute SQL query

    if (!$result) {
        echo "Error inserting record: " . mysqli_error($conn) . "\n"; // Output error if insertion fails
    } else {
        echo "Record inserted successfully\n"; // Output success message if insertion is successful
    }
}

