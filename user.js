document.addEventListener('DOMContentLoaded', () => {
    const allotBedForm = document.getElementById('allot-bed-form');
    const patientTableBody = document.getElementById('patient-table-body');
    const bedOccupancyContainer = document.getElementById('bed-occupancy');

    let patientData = []; // Array to store patient data
    let bedStatus = {}; // Object to track bed occupancy

    // Fetch bed status from the server
    function initializeBedStatus() {
        fetch('opd.php')
            .then(response => response.json())
            .then(data => {
                const cities = ['City 1']; // Since you have only one city (Delhi)
                const hospitals = [
                    'Bed 1', 'Bed 2', 'Bed 3', 'Bed 4',
                    'Bed 5', 'Bed 6', 'Bed 7', 'Bed 8'
                ];

                cities.forEach(city => {
                    hospitals.forEach(hospital => {
                        bedStatus[`${city}-${hospital}`] = 'available';
                    });
                });

                data.forEach(patient => {
                    const bedKey = `${patient.city}-${patient.hospital}`;
                    bedStatus[bedKey] = 'occupied';
                });

                updateBedOccupancy();
            })
            .catch(error => console.error('Error fetching bed status:', error));
    }

    // Update the bed occupancy display
    function updateBedOccupancy() {
        bedOccupancyContainer.innerHTML = '';
        let availableBeds = 8;
        let occupiedBeds = 0;

        for (let bed in bedStatus) {
            const status = bedStatus[bed];
            const bedDiv = document.createElement('div');
            bedDiv.className = `bed-status ${status}`;
            bedDiv.textContent = `${bed}: ${status.charAt(0).toUpperCase() + status.slice(1)}`;
            bedOccupancyContainer.appendChild(bedDiv);

            // Count available and occupied beds
            if (status === 'available') {
                availableBeds++;
            } else if (status === 'occupied') {
                occupiedBeds++;
            }
        }

        // Display the counts of available and occupied beds
        const summaryDiv = document.createElement('div');
        summaryDiv.className = 'bed-summary';
        summaryDiv.textContent = `Available Beds: ${availableBeds} | Occupied Beds: ${occupiedBeds}`;
        bedOccupancyContainer.appendChild(summaryDiv);
    }

    // Update the patient table
    function updatePatientTable() {
        patientTableBody.innerHTML = '';
        patientData.forEach(patient => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${patient.city}</td>
                <td>${patient.hospital}</td>
                <td>${patient.entryDate}</td>
            `;
            patientTableBody.appendChild(row);
        });
    }

    // Handle bed allotment
    allotBedForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const city = document.getElementById('ward-number').value;
        const hospital = document.getElementById('bed-number').value;

        const bedKey = `${city}-${hospital}`;

        if (bedStatus[bedKey] === 'occupied') {
            alert('This bed is already occupied.');
        } else {
            // Update bed status
            bedStatus[bedKey] = 'occupied';

            // Get current date
            const currentDate = new Date().toISOString().split('T')[0]; // Format as YYYY-MM-DD

            // Add patient data
            patientData.push({
                city,
                hospital,
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
