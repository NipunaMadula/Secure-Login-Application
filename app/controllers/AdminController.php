<?php

require_once __DIR__ . '/../models/Admin.php'; // Load the Admin model
require_once __DIR__ . '/../models/User.php';  // Load the User model

class AdminController
{
    private $adminModel;
    private $userModel;

    public function __construct()
    {
        // Initialize models
        $this->adminModel = new Admin(); 
        $this->userModel = new User();
    }

    // Show the admin dashboard
    public function showAdminDashboard()
    {
        // Include the admin dashboard view from app/views/
        include __DIR__ . '/../views/admin_dashboard.php';
    }

    // Display all users for the admin
    public function showAllUsers()
    {
        // Get all users from the database
        $users = $this->userModel->getAllUsers();

        // Include the view from app/views/ and pass users data
        include __DIR__ . '/../views/admin_view_users.php';
    }

    // Promote a user to admin
    public function promoteToAdmin($userId)
    {
        // Promote the user to admin
        if ($this->adminModel->promoteUserToAdmin($userId)) {
            header('Location: /Secure-Login-Application-GAHDSE232F-026/app/views/admin_dashboard.php?promote=success');
            exit();
        } else {
            echo "Failed to promote user.";
        }
    }

    // Demote an admin to a regular user (optional)
    public function demoteAdmin($userId)
    {
        if ($this->adminModel->demoteAdminToUser($userId)) {
            header('Location: /Secure-Login-Application-GAHDSE232F-026/app/views/admin_dashboard.php?demote=success');
            exit();
        } else {
            echo "Failed to demote admin.";
        }
    }

    // Delete a user (only admin can do this)
    public function deleteUser($userId)
    {
        if ($this->userModel->deleteUserById($userId)) {
            header('Location: /Secure-Login-Application-GAHDSE232F-026/app/views/admin_dashboard.php?delete=success');
            exit();
        } else {
            echo "Failed to delete user.";
        }
    }

    // View a specific user details (optional)
    public function viewUserDetails($userId)
    {
        // Get user details by ID
        $user = $this->userModel->getUserById($userId);

        // Include a user details view from app/views/
        include __DIR__ . '/../views/admin_view_user_details.php';
    }
}
