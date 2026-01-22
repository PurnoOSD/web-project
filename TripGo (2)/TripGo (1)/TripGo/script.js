// 1. Form Validation
const bookingForm = document.getElementById('bookingForm');

if (bookingForm) {
    bookingForm.addEventListener('submit', function(e) {
        const destination = document.getElementById('destination').value;
        const date = document.getElementById('travelDate').value;

        if (destination.length < 3) {
            alert("Destination must be at least 3 characters long.");
            e.preventDefault(); // Stop form from submitting
        }

        const selectedDate = new Date(date);
        const today = new Date();
        if (selectedDate < today) {
            alert("You cannot book a trip in the past!");
            e.preventDefault();
        }
    });
}

// 2. Simple Filter Function (Frontend Search)
const searchInput = document.getElementById('searchInput');
if (searchInput) {
    searchInput.addEventListener('keyup', function() {
        const filter = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('#bookingTable tbody tr');

        rows.forEach(row => {
            const text = row.cells[0].textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
}