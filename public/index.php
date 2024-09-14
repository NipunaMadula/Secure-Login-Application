<?php
// Start the session
session_start();

// Include the AuthController for handling registration and login logic
require_once __DIR__ . '/../app/controllers/AuthController.php';

$authController = new AuthController();

// Check if the user is already logged in and redirect accordingly
if (isset($_SESSION['user_id'])) {
    // Redirect to the appropriate dashboard based on user role
    if ($_SESSION['role'] === 'admin') {
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/admin_dashboard.php");
        exit;
    } else {
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/user_dashboard.php");
        exit;
    }
}

// Simple routing logic to handle register and login requests
$requestUri = $_SERVER['REQUEST_URI'];
if (strpos($requestUri, '/Secure-Login-Application-GAHDSE232F-026/register') !== false) {
    $authController->showRegisterForm(); // Method to show the registration form
    exit; // Stop further execution
} elseif (strpos($requestUri, '/Secure-Login-Application-GAHDSE232F-026/login') !== false) {
    $authController->showLoginForm(); // Method to show the login form
    exit; // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="/Secure-Login-Application-GAHDSE232F-026/public/css/index.css"> <!-- Correct link to index.css -->
</head>
<body>
    <div class="container">
        <h1>Welcome to the Secure Login Application</h1>
        <div class="button-container">
            <a href="/Secure-Login-Application-GAHDSE232F-026/app/views/register.php" class="button">Register</a> <!-- Correct link to register -->
            <a href="/Secure-Login-Application-GAHDSE232F-026/app/views/login.php" class="button">Login</a> <!-- Correct link to login -->
        </div>
        <p>Already have an account? <a href="/Secure-Login-Application-GAHDSE232F-026/app/views/login.php" class="login-link">Login</a></p>
    </div>
</body>
</html>
