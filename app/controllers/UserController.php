<?php 

require_once __DIR__ . '/../models/User.php'; // Use __DIR__ for the correct path

class UserController
{
    public function __construct()
    {
        // Start the session if it's not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Show user dashboard
    public function showDashboard()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login if user is not logged in
            header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php");
            exit();
        }

        // Include the user dashboard view using __DIR__
        include __DIR__ . '/../views/user_dashboard.php'; // Corrected path
    }

    // Show user profile page
    public function showProfile()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login if user is not logged in
            header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php");
            exit();
        }

        // Fetch user details from the User model
        $userId = $_SESSION['user_id'];
        $user = User::getUserById($userId);

        // Check if user exists
        if ($user) {
            include __DIR__ . '/../views/user_profile.php'; // Corrected path
        } else {
            // Handle user not found
            $_SESSION['message'] = "User not found.";
            header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/user_dashboard.php");
            exit();
        }
    }

    // Handle profile updates
    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {
                // Redirect to login if user is not logged in
                header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php");
                exit();
            }

            // Sanitize input to prevent XSS or SQL injection
            $userId = $_SESSION['user_id'];
            $fullname = htmlspecialchars(trim($_POST['fullname']), ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
            $phone = htmlspecialchars(trim($_POST['phone']), ENT_QUOTES, 'UTF-8');
            $address = htmlspecialchars(trim($_POST['address']), ENT_QUOTES, 'UTF-8');

            // Update user details in the database
            $updateSuccess = User::updateUser($userId, $fullname, $email, $phone, $address);

            if ($updateSuccess) {
                $_SESSION['message'] = "Profile updated successfully!";
            } else {
                $_SESSION['message'] = "Failed to update profile.";
            }

            // Redirect back to the profile page
            header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/user_profile.php");
            exit();
        }
    }

    // Other user-related methods can be added here...
}
