<?php
// Start the session
session_start();

// Include necessary files
require_once __DIR__ . '/../../config/database.php'; // Adjusted path to the database file

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php");
    exit();
}

// Get the user's details from the session
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// HTML for the admin dashboard
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/Secure-Login-Application-GAHDSE232F-026/public/css/admin_dashboard.css"> <!-- Update to your CSS path -->
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Welcome, <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p>Role: <?php echo htmlspecialchars($role, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    </header>
    
    <main>
        <h2>Admin Dashboard</h2>
        <p>Manage your application here.</p>
        
        <div class="button-container">
            <!-- Add buttons or links for admin functionalities -->
            <button onclick="location.href='/Secure-Login-Application-GAHDSE232F-026/app/views/admin_view_users.php'" class="admin-btn">View Users</button>
            <button onclick="location.href='/Secure-Login-Application-GAHDSE232F-026/app/views/admin_view_user_details.php'" class="admin-btn">User Details</button>
            <button onclick="location.href='/Secure-Login-Application-GAHDSE232F-026/app/views/admin_profile.php'" class="admin-btn">My Profile</button>
        </div>
    </main>

    <footer>
        <div class="logout-container">
            <a href="/Secure-Login-Application-GAHDSE232F-026/public/logout.php" class="logout-btn">Logout</a>
        </div>
    </footer>
</body>
</html>
