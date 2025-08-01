<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "addmissionform";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $fname            = $_POST['fname'];
    $email            = $_POST['email'];
    $phonenumber      = $_POST['phonenumber'];
    $birthdate        = $_POST['birthdate'];
    $gender           = $_POST['gender'];
    $address          = $_POST['address'];
    $addressline2     = $_POST['addressline2'];
    $country          = $_POST['country'];
    $city             = $_POST['city'];
    $region           = $_POST['region'];
    $postalcode       = $_POST['postalcode'];
    $department       = $_POST['department'];
    $currentsymptoms  = $_POST['currentsymptoms'];
    $bloodgroup       = $_POST['bloodgroup'];

    $sql = "INSERT INTO `alldetails` (`fname`, `email`, `phonenumber`, `birthdate`, `gender`, `address`, `addressline2`, `country`, `city`, `region`, `postalcode`, `department`, `currentsymptoms`, `bloodgroup`) 
    VALUES ('$fname', '$email', '$phonenumber', '$birthdate', '$gender', '$address', '$addressline2', '$country', '$city', '$region', '$postalcode', '$department', '$currentsymptoms', '$bloodgroup')";

    if (mysqli_query($conn, $sql)) {
        echo "Data Inserted into Database";

    } else {
        echo "Failed to insert data: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
