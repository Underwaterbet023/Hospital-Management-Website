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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wardNumber = $conn->real_escape_string($_POST['ward-number']);
    $bedNumber = $conn->real_escape_string($_POST['bed-number']);
    $patientName = $conn->real_escape_string($_POST['patient-name']);
    $entryDate = $conn->real_escape_string($_POST['entry-date']);

    // Check if the bed is already occupied
    $checkBed = "SELECT * FROM opd WHERE ward_number='$wardNumber' AND bed_number='$bedNumber'";
    $result = $conn->query($checkBed);

    if ($result->num_rows == 0) {
        // Bed is available, insert the patient data
        $sql = "INSERT INTO opd (ward_number, bed_number, patient_name, entry_date) 
                VALUES ('$wardNumber', '$bedNumber', '$patientName', '$entryDate')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully');</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('This bed is already occupied.');</script>";
    }
}

// Close the connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital OPD System</title>
    <link rel="stylesheet" href="opd.css">
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
                <h2>Allot Bed</h2>
                <form  action="opd.php" method="POST" id="allot-bed-form">
                    <label for="ward-number">Ward Number</label>
                    <select id="ward-number" name="ward-number">
                        <option value="Ward 1">Ward 1</option>
                        <option value="Ward 2">Ward 2</option>
                        <option value="Ward 3">Ward 3</option>
                        <option value="Ward 4">Ward 4</option>
                        <option value="Ward 5">Ward 5</option>
                    </select>

                    <label for="bed-number">Bed Number</label>
                    <select id="bed-number" name="bed-number">
                        <option value="Bed 1">Bed 1</option>
                        <option value="Bed 2">Bed 2</option>
                        <option value="Bed 3">Bed 3</option>
                        <option value="Bed 4">Bed 4</option>
                        <option value="Bed 5">Bed 5</option>
                        <option value="Bed 6">Bed 6</option>
                        <option value="Bed 7">Bed 7</option>
                        <option value="Bed 8">Bed 8</option>
                    </select>

                    <label for="patient-name">Patient Name</label>
                    <input type="text" id="patient-name" name="patient-name" required>

                    <label for="entry-date">Entry Date</label>
                    <input type="date" id="entry-date" name="entry-date" required>

                    <button type="submit" class="allot-btn">Allot Bed</button>
                </form>
            </div>

            <div class="dataframe-right">
                <h2>Patient Details</h2>
                <div class="patient-list">
                    <table>
                        <thead>
                            <tr>
                                <th>Ward Number</th>
                                <th>Bed Number</th>
                                <th>Patient Name</th>
                                <th>Entry Date</th>
                            </tr>
                        </thead>
                        <tbody id="patient-table-body">
                            <!-- Rows of patient data will be added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <h2>Bed Occupancy</h2>
        <div id="bed-occupancy">
            <div class="bed-status available">Ward 1-Bed 1: Available</div>
            <div class="bed-status available">Ward 1-Bed 2: Available</div>
            <div class="bed-status available">Ward 1-Bed 3: Available</div>
            <div class="bed-status available">Ward 1-Bed 4: Available</div>
            <div class="bed-status available">Ward 1-Bed 5: Available</div>
            <div class="bed-status available">Ward 1-Bed 6: Available</div>
            <div class="bed-status available">Ward 1-Bed 7: Available</div>
            <div class="bed-status available">Ward 1-Bed 8: Available</div>

            <div class="bed-status available">Ward 2-Bed 1: Available</div>
            <div class="bed-status available">Ward 2-Bed 2: Available</div>
            <div class="bed-status available">Ward 2-Bed 3: Available</div>
            <div class="bed-status available">Ward 2-Bed 4: Available</div>
            <div class="bed-status available">Ward 2-Bed 5: Available</div>
            <div class="bed-status available">Ward 2-Bed 6: Available</div>
            <div class="bed-status available">Ward 2-Bed 7: Available</div>
            <div class="bed-status available">Ward 2-Bed 8: Available</div>

            <div class="bed-status available">Ward 3-Bed 1: Available</div>
            <div class="bed-status available">Ward 3-Bed 2: Available</div>
            <div class="bed-status available">Ward 3-Bed 3: Available</div>
            <div class="bed-status available">Ward 3-Bed 4: Available</div>
            <div class="bed-status available">Ward 3-Bed 5: Available</div>
            <div class="bed-status available">Ward 3-Bed 6: Available</div>
            <div class="bed-status available">Ward 3-Bed 7: Available</div>
            <div class="bed-status available">Ward 3-Bed 8: Available</div>

            <div class="bed-status available">Ward 4-Bed 1: Available</div>
            <div class="bed-status available">Ward 4-Bed 2: Available</div>
            <div class="bed-status available">Ward 4-Bed 3: Available</div>
            <div class="bed-status available">Ward 4-Bed 4: Available</div>
            <div class="bed-status available">Ward 4-Bed 5: Available</div>
            <div class="bed-status available">Ward 4-Bed 6: Available</div>
            <div class="bed-status available">Ward 4-Bed 7: Available</div>
            <div class="bed-status available">Ward 4-Bed 8: Available</div>

            <div class="bed-status available">Ward 5-Bed 1: Available</div>
            <div class="bed-status available">Ward 5-Bed 2: Available</div>
            <div class="bed-status available">Ward 5-Bed 3: Available</div>
            <div class="bed-status available">Ward 5-Bed 4: Available</div>
            <div class="bed-status available">Ward 5-Bed 5: Available</div>
            <div class="bed-status available">Ward 5-Bed 6: Available</div>
            <div class="bed-status available">Ward 5-Bed 7: Available</div>
            <div class="bed-status available">Ward 5-Bed 8: Available</div>
        </div>
    </div>

    <script src="opd.js"></script>
</body>
</html>
