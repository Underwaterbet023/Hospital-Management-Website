<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "addmissionform";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch bed occupancy data
$sql = "SELECT ward_number, bed_number FROM opd WHERE 1";
$result = $conn->query($sql);

$bedData = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $bedData[] = $row;
        
    }
}



// Return the data as JSON
echo json_encode($bedData);

// Close the connection
$conn->close();
?>
