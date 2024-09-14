<?php
// Start the session
session_start();

// Include necessary files
require_once __DIR__ . '/../../config/database.php'; // Adjusted path to the database file

// Check if user is logged in, if not redirect to login page
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
            <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
            <p>Role: <?php echo htmlspecialchars($role); ?></p>
        </div>
    </header>
    
    <main>
        <h2>Admin Dashboard</h2>
        <p>Manage your application here.</p>
        
        <div class="button-container">
            <!-- Add buttons or links for admin functionalities -->
            <button onclick="location.href='manage_users.php'" class="admin-btn">Manage Users</button>
            <button onclick="location.href='view_reports.php'" class="admin-btn">View Reports</button>
            <button onclick="location.href='settings.php'" class="admin-btn">Settings</button>
        </div>
    </main>

    <footer>
        <div class="logout-container">
            <a href="/Secure-Login-Application-GAHDSE232F-026/public/logout.php" class="logout-btn">Logout</a>
        </div>
    </footer>
</body>
</html>
