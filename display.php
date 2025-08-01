<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="display.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
</head>
<body>
<?php 
// Database connection details
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

// Query to fetch all records
$query = "SELECT * FROM alldetails";

echo '<table border="1" cellspacing="2" cellpadding="2"> 
      <tr> 
          <th>User ID</th> 
          <th>Name</th> 
          <th>Email</th> 
          <th>Phone Number</th> 
          <th>Birth Date</th> 
          <th>Gender</th> 
          <th>Address</th> 
          <th>Street Address line</th> 
          <th>Country</th> 
          <th>City</th> 
          <th>Region</th> 
          <th>Postal Code</th> 
          <th>Department</th> 
          <th>Current Symptoms</th> 
          <th>Blood Group</th>
          <th>Action</th> <!-- New column for action button -->
      </tr>';

// Execute the query and fetch results
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr> 
                  <td>'.$row["user_id"].'</td> 
                  <td>'.$row["fname"].'</td> 
                  <td>'.$row["email"].'</td> 
                  <td>'.$row["phonenumber"].'</td> 
                  <td>'.$row["birthdate"].'</td> 
                  <td>'.$row["gender"].'</td> 
                  <td>'.$row["address"].'</td> 
                  <td>'.$row["addressline2"].'</td> 
                  <td>'.$row["country"].'</td> 
                  <td>'.$row["city"].'</td> 
                  <td>'.$row["region"].'</td> 
                  <td>'.$row["postalcode"].'</td> 
                  <td>'.$row["department"].'</td> 
                  <td>'.$row["currentsymptoms"].'</td> 
                  <td>'.$row["bloodgroup"].'</td> 
                  <td><a href="profile.php?id='.$row["user_id"].'" class="btn btn-primary">Profile</a></td> <!-- Button to view profile -->
              </tr>';
    }
    // Free result set
    $result->free();
} else {
    echo "Error: " . $mysqli->error;
}

// Close the connection
$mysqli->close();
?>
</table>
</body>
</html>
