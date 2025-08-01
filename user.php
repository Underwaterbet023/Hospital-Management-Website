<?php
// allot_bed.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "addmissionform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $city = $_POST['ward-number'];
    $hospital = $_POST['bed-number'];
    $patientName = $_POST['patient-name']; // Assuming you have this field in your form
    $bedNumber = $_POST['bed-number']; // This needs to be captured as well
    $entryDate = date("Y-m-d");

    $sql = "INSERT INTO cityopd (city, hospital, patient_name, bed_number, entry_date)
            VALUES ('$city', '$hospital', '$patientName', '$bedNumber', '$entryDate')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital OPD System</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>

    <header>
        <div class="header-container">
            <h1>Hospital OPD System</h1>
        </div>
    </header>

    <div class="content">
        <div class="dataframe">
            <div class="dataframe-left">
                <h2>Select Hospital</h2>
                <form id="allot-bed-form">
                <form id="allot-bed-form" action="user.php" method="POST">
    <!-- Your form fields -->

                    <label for="ward-number">City</label>
                    <select id="ward-number" name="ward-number">
                        <option value="City 1">Delhi</option>
                    </select>

                    <label for="bed-number">Hospital</label>
                    <select id="bed-number" name="bed-number">
                        <option value="AIIMS, New Delhi">AIIMS, New Delhi</option>
                        <option value="City 2">All India Institute of Ayurveda AIIA New Delhi</option>
                        <option value="All India Institute of Ayurveda AIIA New Delhi">Composite Hospital CRPF New Delhi</option>
                        <option value="DELHI STATE CANCER INSTITUTES (EAST), DILSHAD GARDEN">DELHI STATE CANCER INSTITUTES (EAST), DILSHAD GARDEN</option>
                        <option value="DELHI STATE CANCER INSTITUTES (WEST), JANAK PURI">DELHI STATE CANCER INSTITUTES (WEST), JANAK PURI</option>
                        <option value="Dr. RML Hospital, New Delhi">Dr. RML Hospital, New Delhi</option>
                        <option value="Institute of Human Behaviour and Allied Sciences">Institute of Human Behaviour and Allied Sciences</option>
                        <option value="Kalawati Saran Childrens Hospital, New Delhi">Kalawati Saran Childrens Hospital, New Delhi</option>

                    </select>
                    <div id="bed-occupancy"></div>
                    

<table>
    <thead>
        <tr>
            <th>City</th>
            <th>Hospital</th>
            <th>Patient Name</th>
            <th>Entry Date</th>
        </tr>
    </thead>
    <tbody id="patient-table-body"></tbody>
</table>

                    <button type="submit" class="allot-btn">Allot Bed</button>
                </form>
            </div>
        </div>
    </div>

    </div>
    <script src="user.js"></script>
</body>
</html>

