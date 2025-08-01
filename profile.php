<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="profile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "addmissionform";

// Create a connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get patient ID from query string
$patientId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query to fetch patient details
$query = "SELECT * FROM alldetails WHERE user_id = $patientId";
$result = $mysqli->query($query);

$patient = $result->fetch_assoc();
$mysqli->close();
?>

<div class="container">
    <header>
        <h1>Patient Profile</h1>
    </header>

    <?php if ($patient): ?>
        <div class="card">
            <div class="card-header">
                Patient Information
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($patient["fname"]); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($patient["email"]); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($patient["phonenumber"]); ?></p>
                <p><strong>Birth Date:</strong> <?php echo htmlspecialchars($patient["birthdate"]); ?></p>
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($patient["gender"]); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($patient["address"]); ?></p>
                <p><strong>Street Address Line:</strong> <?php echo htmlspecialchars($patient["addressline2"]); ?></p>
                <p><strong>Country:</strong> <?php echo htmlspecialchars($patient["country"]); ?></p>
                <p><strong>City:</strong> <?php echo htmlspecialchars($patient["city"]); ?></p>
                <p><strong>Region:</strong> <?php echo htmlspecialchars($patient["region"]); ?></p>
                <p><strong>Postal Code:</strong> <?php echo htmlspecialchars($patient["postalcode"]); ?></p>
                <p><strong>Department:</strong> <?php echo htmlspecialchars($patient["department"]); ?></p>
                <p><strong>Current Symptoms:</strong> <?php echo htmlspecialchars($patient["currentsymptoms"]); ?></p>
                <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($patient["bloodgroup"]); ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <p>No patient data found.</p>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
