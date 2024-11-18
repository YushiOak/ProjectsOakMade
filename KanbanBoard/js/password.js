function togglePassword() {
    // Get all the password cells
    var passwordCells = document.querySelectorAll('td[data-password]');

    // Toggle the visibility of the password value for each password cell
    passwordCells.forEach(function(cell) {
        if (cell.textContent === '***') {
            // Get the actual password value from the "data-password" attribute
            var password = cell.getAttribute('data-password');
            cell.textContent = password; // Display the actual password value
        } else {
            cell.textContent = '***'; // Hide the password value and display asterisks
        }
    });
}