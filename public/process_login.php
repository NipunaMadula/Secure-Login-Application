<?php
// Start the session
session_start();

// Include necessary files
require_once '../config/database.php'; // Ensure this path is correct
require_once '../app/models/User.php'; // Ensure this path is correct

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize input
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    // Check if fields are not empty
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php"); // Updated redirect path
        exit();
    }

    // Instantiate User model
    $userModel = new User();
    
    // Find the user by username
    $user = $userModel->findByUsername($username);
    
    if ($user) {
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Role can be 'admin' or 'user'

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/admin_dashboard.php"); // Updated redirect path
            } else {
                header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/user_dashboard.php"); // Updated redirect path
            }
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password.";
        }
    } else {
        $_SESSION['error'] = "User not found.";
    }

    // Redirect back to login page if error occurs
    header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php"); // Updated redirect path
    exit();
}
?>