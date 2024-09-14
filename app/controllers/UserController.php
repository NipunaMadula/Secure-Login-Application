<?php

require_once '../app/models/User.php';

class UserController
{
    // Ensure user is logged in for every action in this controller
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login if user is not logged in
            header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php");
            exit();
        }
    }

    // Show user dashboard
    public function showDashboard()
    {
        // Fetch any user-specific data needed for the dashboard, for example:
        // $userData = User::getUserData($_SESSION['user_id']);
        include '../app/views/user_dashboard.php';
    }

    // Show user profile page
    public function showProfile()
    {
        // Fetch user details from the User model
        $userId = $_SESSION['user_id'];
        $user = User::getUserById($userId);

        include '../app/views/user_profile.php';
    }

    // Handle profile updates
    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
