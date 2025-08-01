// Function to add medicine details to the table
function addMedicine() {
    const tableBody = document.getElementById('tableBody');
    const row = document.createElement('tr');

    // Get form values
    const refNo = document.getElementById('refNo').value;
    const companyName = document.getElementById('companyName').value;
    const medicineType = document.getElementById('medicineType').value;
    const medicineName = document.getElementById('medicineName').value;
    const lotNo = document.getElementById('lotNo').value;
    const issueDate = document.getElementById('issueDate').value;
    const expDate = document.getElementById('expDate').value;
    const uses = document.getElementById('uses').value;
    const dosage = document.getElementById('dosage').value;
    const productQt = document.getElementById('productQt').value;
    const price = document.getElementById('price').value;

    // Create table cells and append values
    row.innerHTML = `
        <td>${refNo}</td>
        <td>${companyName}</td>
        <td>${medicineType}</td>
        <td>${medicineName}</td>
        <td>${lotNo}</td>
        <td>${issueDate}</td>
        <td>${expDate}</td>
        <td>${uses}</td>
        <td>${dosage}</td>
        <td>${productQt}</td>
        <td>${price}</td>
    `;

    tableBody.appendChild(row);

    // Clear the form
    resetForm();
}

// Function to update medicine details in the table (simplified)
function updateMedicine() {
    alert('Update functionality is not implemented in this example.');
}

// Function to delete medicine details from the table (simplified)
function deleteMedicine() {
    alert('Delete functionality is not implemented in this example.');
}

// Function to reset the form
function resetForm() {
    document.getElementById('medicine-info-form').reset();
}

// Function to exit the form (clear the table)
function exitForm() {
    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = ''; // Clear the table
}
