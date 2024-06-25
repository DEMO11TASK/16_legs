function validateForm() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // Hardcoded admin credentials (replace with secure implementation)
    var adminUsername = 'admin';
    var adminPassword = 'admin123';

    if (username.trim() === '' || password.trim() === '') {
        alert('Please enter both username and password.');
        return false;
    }

    if (username !== adminUsername || password !== adminPassword) {
        alert('Invalid username or password.');
        return false;
    }

    alert('Login successful!'); // Replace with redirection to admin page
    return true; // Form submission will proceed if true
}
