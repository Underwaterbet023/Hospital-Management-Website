<?php
// Database connection settings
$servername = "localhost"; // Usually 'localhost'
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "addmissionform"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add a new medicine
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addData'])) {
        $refNo = $_POST['refNo'];
        $companyName = $_POST['companyName'];
        $medicineType = $_POST['medicineType'];
        $medicineName = $_POST['medicineName'];
        $lotNo = $_POST['lotNo'];
        $issueDate = $_POST['issueDate'];
        $expDate = $_POST['expDate'];
        $uses = $_POST['uses'];
        $dosage = $_POST['dosage'];
        $productQt = $_POST['productQt'];
        $price = $_POST['price'];

        // Insert into database
        $sql = "INSERT INTO medicines (ref_no, company_name, medicine_type, medicine_name, lot_no, issue_date, exp_date, uses, dosage, product_quantity, price)
                VALUES ('$refNo', '$companyName', '$medicineType', '$medicineName', '$lotNo', '$issueDate', '$expDate', '$uses', '$dosage', '$productQt', '$price')";

        if ($conn->query($sql) === TRUE) {
            echo "New medicine added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Function to fetch all medicines
function getMedicines($conn) {
    $sql = "SELECT * FROM medicines";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['ref_no']}</td>
                    <td>{$row['company_name']}</td>
                    <td>{$row['medicine_type']}</td>
                    <td>{$row['medicine_name']}</td>
                    <td>{$row['lot_no']}</td>
                    <td>{$row['issue_date']}</td>
                    <td>{$row['exp_date']}</td>
                    <td>{$row['uses']}</td>
                    <td>{$row['dosage']}</td>
                    <td>{$row['product_quantity']}</td>
                    <td>{$row['price']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='11'>No medicines found</td></tr>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Management System</title>
    <link rel="stylesheet" href="pharmacy.css">
    <link rel="stylesheet" href="pharmacy.js">
</head>
<body>
    <div class="container">
        <div class="header">
            PHARMACY MANAGEMENT SYSTEM
        </div>

        <!-- Medicine Information Form -->
        <form id="medicine-info-form" method="post" action="pharmacy.php">
            <div class="form-group">
                <label for="refNo">Reference No:</label>
                <input type="text" id="refNo" name="refNo" required>
            </div>
            <div class="form-group">
                <label for="companyName">Company Name:</label>
                <input type="text" id="companyName" name="companyName" required>
            </div>
            <div class="form-group">
                <label for="medicineType">Type of Medicine:</label>
                <select id="medicineType" name="medicineType" required>
                    <option value="Tablet">Tablet</option>
                    <option value="Liquid">Liquid</option>
                    <option value="Capsules">Capsules</option>
                    <option value="Topical">Topical Medicines</option>
                    <option value="Drops">Drops</option>
                    <option value="Inhalers">Inhalers</option>
                    <option value="Injection">Injection</option>
                </select>
            </div>
            <div class="form-group">
                <label for="medicineName">Medicine Name:</label>
                <input type="text" id="medicineName" name="medicineName" required>
            </div>
            <div class="form-group">
                <label for="lotNo">Lot No:</label>
                <input type="text" id="lotNo" name="lotNo" required>
            </div>
            <div class="form-group">
                <label for="issueDate">Issue Date:</label>
                <input type="date" id="issueDate" name="issueDate" required>
            </div>
            <div class="form-group">
                <label for="expDate">Exp Date:</label>
                <input type="date" id="expDate" name="expDate" required>
            </div>
            <div class="form-group">
                <label for="uses">Uses:</label>
                <input type="text" id="uses" name="uses" required>
            </div>
            <div class="form-group">
                <label for="dosage">Dosage:</label>
                <input type="text" id="dosage" name="dosage" required>
            </div>
            <div class="form-group">
                <label for="productQt">Product Quantity:</label>
                <input type="number" id="productQt" name="productQt" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
            </div>

            <!-- Button Section -->
            <div class="button-group">
                <button type="submit" name="addData" id="addData">Add Medicine</button>
                <!-- Implement update, delete, reset functionality as needed -->
                <button type="reset" id="resetData">Reset</button>
                <button type="button" id="exitData" onclick="exitForm()">Exit</button>
            </div>
        </form>

        <!-- Table Section -->
        <div class="table-container">
            <table id="medicineTable">
                <thead>
                    <tr>
                        <th>Reference No</th>
                        <th>Company Name</th>
                        <th>Type of Medicine</th>
                        <th>Medicine Name</th>
                        <th>Lot No</th>
                        <th>Issue Date</th>
                        <th>Exp Date</th>
                        <th>Uses</th>
                        <th>Dosage</th>
                        <th>Product Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php getMedicines($conn); ?>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            Pharmacy Management System © 2024
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
