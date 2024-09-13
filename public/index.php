<?php
// Start the session
session_start();

// Check if the user is already logged in and redirect accordingly
if (isset($_SESSION['user_id'])) {
    // Redirect to the appropriate dashboard based on user role
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
        exit;
    } else {
        header("Location: user_dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="css/index.css"> <!-- Link to index.css for this specific page -->
</head>
<body>
    <header class="page-header">
        <h1>Welcome to the Secure Login Application</h1>
    </header>
    <div class="button-container">
        <a href="register.php" class="btn left-btn">Register</a>
        <a href="login.php" class="btn right-btn">Login</a>
    </div>

    <script src="js/index.js"></script> <!-- Link to index.js for this specific page -->
</body>
</html>
