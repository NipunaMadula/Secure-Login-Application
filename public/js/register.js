document.getElementById('registerForm').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    let valid = true;

    // Clear previous error messages
    document.querySelectorAll('.error-message').forEach(msg => msg.innerHTML = '');

    // Check if passwords match
    if (password !== confirmPassword) {
        document.getElementById('confirmPasswordError').innerHTML = "Passwords do not match.";
        valid = false; // Set valid to false
    }

    // Check password strength
    const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    if (!passwordPattern.test(password)) {
        document.getElementById('passwordError').innerHTML = "Password must be at least 8 characters long and include uppercase, lowercase, a number, and a special character.";
        valid = false; // Set valid to false
    }

    if (!valid) {
        event.preventDefault(); // Prevent form submission
    }
});
