<?php
// Start the session
session_start();

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Redirect to the correct login page
    header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php");
    exit;
}

// Include the necessary files and the Admin model
require_once __DIR__ . '/../models/Admin.php'; // Adjusted path for model inclusion

// Get user ID from the query parameter
if (!isset($_GET['id'])) {
    header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/admin_view_users.php");
    exit;
}

$user_id = $_GET['id'];

// Fetch user details from the database
$adminModel = new Admin();
$user = $adminModel->getUserById($user_id); // Method to get user details by ID

if (!$user) {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="/Secure-Login-Application-GAHDSE232F-026/public/css/admin_view_user_details.css"> <!-- Correct link to the CSS file -->
</head>
<body>
    <div class="container">
        <h1>User Details for <?= htmlspecialchars($user['fullname']); ?></h1>
        <p><strong>ID:</strong> <?= htmlspecialchars($user['id']); ?></p>
        <p><strong>Full Name:</strong> <?= htmlspecialchars($user['fullname']); ?></p>
        <p><strong>Username:</strong> <?= htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']); ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($user['address']); ?></p>
        <p><strong>Role:</strong> <?= htmlspecialchars($user['role']); ?></p>
        
        <a href="/Secure-Login-Application-GAHDSE232F-026/app/views/admin_view_users.php">Back to Users List</a>
    </div>
</body>
</html>
