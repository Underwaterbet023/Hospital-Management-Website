document.addEventListener('DOMContentLoaded', () => {
    const allotBedForm = document.getElementById('allot-bed-form');
    const patientTableBody = document.getElementById('patient-table-body');
    const bedOccupancyContainer = document.getElementById('bed-occupancy');

    let patientData = []; // Array to store patient data
    let bedStatus = {}; // Object to track bed occupancy

    // Fetch bed status from the server
    function initializeBedStatus() {
        fetch('get_bed_status.php')
            .then(response => response.json())
            .then(data => {
                const wards = ['Ward 1', 'Ward 2', 'Ward 3', 'Ward 4', 'Ward 5'];
                const beds = ['Bed 1', 'Bed 2', 'Bed 3', 'Bed 4', 'Bed 5', 'Bed 6', 'Bed 7', 'Bed 8'];

                wards.forEach(ward => {
                    beds.forEach(bed => {
                        bedStatus[`${ward}-${bed}`] = 'available';
                    });
                });

                data.forEach(patient => {
                    const bedKey = `${patient.ward_number}-${patient.bed_number}`;
                    bedStatus[bedKey] = 'occupied';
                });

                updateBedOccupancy();
            })
            .catch(error => console.error('Error fetching bed status:', error));
    }

    // Update the bed occupancy display
    function updateBedOccupancy() {
        bedOccupancyContainer.innerHTML = '';
        for (let bed in bedStatus) {
            const status = bedStatus[bed];
            const bedDiv = document.createElement('div');
            bedDiv.className = `bed-status ${status}`;
            bedDiv.textContent = `${bed}: ${status.charAt(0).toUpperCase() + status.slice(1)}`;
            bedOccupancyContainer.appendChild(bedDiv);
        }
    }

    // Update the patient table
    function updatePatientTable() {
        patientTableBody.innerHTML = '';
        patientData.forEach(patient => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${patient.wardNumber}</td>
                <td>${patient.bedNumber}</td>
                <td>${patient.name}</td>
                <td>${patient.entryDate}</td>
            `;
            patientTableBody.appendChild(row);
        });
    }

    // Handle bed allotment
    allotBedForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const wardNumber = document.getElementById('ward-number').value;
        const bedNumber = document.getElementById('bed-number').value;
        const patientName = document.getElementById('patient-name').value;

        const bedKey = `${wardNumber}-${bedNumber}`;

        if (bedStatus[bedKey] === 'occupied') {
            alert('This bed is already occupied.');
        } else {
            // Update bed status
            bedStatus[bedKey] = 'occupied';

            // Get current date
            const currentDate = new Date().toISOString().split('T')[0]; // Format as YYYY-MM-DD

            // Add patient data
            patientData.push({
                wardNumber,
                bedNumber,
                name: patientName,
                entryDate: currentDate
            });

            // Update UI
            updatePatientTable();
            updateBedOccupancy();

            // Clear form fields
            allotBedForm.reset();
        }
    });

    // Initialize the system
    initializeBedStatus();
});
