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

            if (empty($fullname) || empty($username) || empty($email) || empty($phone) || empty($address) || empty($password)) {
                $this->showRegisterForm("All fields are required.");
                return;
            }

            if ($this->userModel->usernameExists($username)) {
                $this->showRegisterForm("Username already exists.");
                return;
            }
            
            if ($this->userModel->findByEmail($email)) {
                $this->showRegisterForm("Email already exists.");
                return;
            }

            if ($this->userModel->register($fullname, $username, $email, $phone, $address, $password)) {
                header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php?msg=Registration successful, please login.");
                exit();
            } else {
                $this->showRegisterForm("Registration failed. Please try again.");
            }
        }
    }

    // Process user login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $user = $this->userModel->usernameExists($username);

            if ($user && password_verify($password, $user['password'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = 'user';

                header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/user_dashboard.php");
                exit();
            } else {
                // Check admin table if user is not found
                $admin = $this->userModel->findAdminByUsername($username);
                if ($admin && password_verify($password, $admin['password'])) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    $_SESSION['user_id'] = $admin['id'];
                    $_SESSION['username'] = $admin['username'];
                    $_SESSION['role'] = 'admin';

                    header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/admin_dashboard.php");
                    exit();
                } else {
                    $this->showLoginForm("Invalid username or password.");
                }
            }
        }
    }

    // Log out the user
    public function logout() {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php");
        exit();
    }
}
?>
