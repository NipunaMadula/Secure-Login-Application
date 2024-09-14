<?php
// app/controllers/AuthController.php

require '../app/models/User.php'; // Adjust the path as needed
require '../app/models/Admin.php'; // Adjust the path as needed

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User(); // Initialize the User model
    }

    // Show the registration form
    public function showRegisterForm($error = null) {
        include '../app/views/register.php'; // Include the registration form view
    }

    // Show the login form
    public function showLoginForm($error = null) {
        include '../app/views/login.php'; // Include the login form view
    }

    // Process user registration
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate the input
            $fullname = trim($_POST['fullname']);
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $address = trim($_POST['address']);
            $password = trim($_POST['password']);

            // Simple validation (you can enhance this as needed)
            if (empty($fullname) || empty($username) || empty($email) || empty($phone) || empty($address) || empty($password)) {
                $error = "All fields are required.";
                $this->showRegisterForm($error);
                return;
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Call the User model to register the user
            if ($this->userModel->register($fullname, $username, $email, $phone, $address, $hashedPassword)) {
                // Registration successful
                header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php?msg=Registration successful, please login.");
                exit();
            } else {
                // Registration failed
                $error = "Registration failed. Please try again.";
                $this->showRegisterForm($error);
            }
        }
    }

    // Process user login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            // Call the User model to authenticate the user
            $user = $this->userModel->login($username, $password);

            if ($user) {
                // Start the session if not already started
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                // Store user data in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username']; // Store username for reference
                $_SESSION['role'] = $user['role']; // Assuming role is stored in the user table

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/admin_dashboard.php");
                } else {
                    header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/user_dashboard.php");
                }
                exit();
            } else {
                // Invalid credentials
                $error = "Invalid username or password.";
                $this->showLoginForm($error);
            }
        }
    }

    // Log out the user
    public function logout() {
        // Start the session
        session_start();
        // Unset all session variables
        $_SESSION = array();
        // Destroy the session
        session_destroy();
        // Redirect to index with logout message
        header("Location: /Secure-Login-Application-GAHDSE232F-026/public/index.php?msg=You have logged out successfully.");
        exit();
    }
}
?>
