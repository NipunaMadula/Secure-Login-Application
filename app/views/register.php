<?php
// Start the session
session_start();

// Check for errors from previous registration attempts
$error = isset($_SESSION['error']) ? $_SESSION['error'] : ''; // Retrieve error message if set
unset($_SESSION['error']); // Clear the error message after displaying it
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/Secure-Login-Application-GAHDSE232F-026/public/css/register.css">

    <link rel="stylesheet" href="/Secure-Login-Application-GAHDSE232F-026/public/css/register.css"> <!-- Updated path to register.css -->
    <script src="/Secure-Login-Application-GAHDSE232F-026/public/js/register.js" defer></script> <!-- Updated path to register.js -->
</head>
<body>
    <div class="container">
        <h1>Create an Account</h1>
        
        <?php if (!empty($error)): ?> <!-- Display error message if it exists -->
            <div class="error-message">
                <?= htmlspecialchars($error); ?> <!-- Use htmlspecialchars to prevent XSS -->
            </div>
        <?php endif; ?>

        <form id="registerForm" action="/Secure-Login-Application-GAHDSE232F-026/public/process_register.php" method="POST"> <!-- Updated action path -->
            <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" required>
                <div class="error-message" id="fullnameError"></div>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <div class="error-message" id="usernameError"></div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <div class="error-message" id="emailError"></div>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
                <div class="error-message" id="phoneError"></div>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
                <div class="error-message" id="addressError"></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <div class="error-message" id="passwordError"></div>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <div class="error-message" id="confirmPasswordError"></div>
            </div>
            <button type="submit">Register</button>
            </form>
            <p class="footer-link">Already have an account? <a href="/Secure-Login-Application-GAHDSE232F-026/app/views/login.php">Login here</a></p> <!-- Link to login page -->
            </div>
</body>
</html>