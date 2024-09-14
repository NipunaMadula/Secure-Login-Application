<?php
// Start the session
session_start();

// If the user is already logged in, redirect them to the appropriate dashboard
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/admin_dashboard.php"); // Redirect to admin dashboard
    } else {
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/user_dashboard.php"); // Redirect to user dashboard
    }
    exit;
}

// Check for errors from previous submission
$error = isset($_SESSION['error']) ? $_SESSION['error'] : ''; // Retrieve error message if set
unset($_SESSION['error']); // Clear the error message after displaying it
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/Secure-Login-Application-GAHDSE232F-026/public/css/login.css"> <!-- Updated path to login.css -->
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        
        <?php if (!empty($error)): ?> <!-- Display error message if it exists -->
            <div class="error-message">
                <?= htmlspecialchars($error); ?> <!-- Use htmlspecialchars to prevent XSS -->
            </div>
        <?php endif; ?>
        
        <form id="loginForm" action="/Secure-Login-Application-GAHDSE232F-026/public/process_login.php" method="POST"> <!-- Updated action path -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>

        <p>Don't have an account? <a href="/Secure-Login-Application-GAHDSE232F-026/app/views/register.php">Register here</a></p> <!-- Updated link -->
    </div>

    <script src="/Secure-Login-Application-GAHDSE232F-026/public/js/login.js"></script> <!-- Updated path to login.js -->
</body>
</html>
