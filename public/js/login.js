// login.js
document.getElementById('loginForm').addEventListener('submit', function (event) {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Basic validation: Ensure both fields are filled
    if (username === '' || password === '') {
        alert('Both fields are required.');
        event.preventDefault(); // Prevent form submission
    }

    // You can add more advanced validations here
});
