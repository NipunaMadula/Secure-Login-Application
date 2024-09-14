<?php
// Start the session
session_start();

// Set a timeout duration (in seconds)
$timeout_duration = 1800; // 30 minutes

// Check if the session variable for last activity is set
if (isset($_SESSION['LAST_ACTIVITY'])) {
    // Calculate the session's lifetime
    $session_life = time() - $_SESSION['LAST_ACTIVITY'];

    // If the session has timed out
    if ($session_life > $timeout_duration) {
        // Unset all session variables
        session_unset();
        // Destroy the session
        session_destroy();
        // Redirect to the login page
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php");
        exit;
    }
}

// Update last activity time stamp
$_SESSION['LAST_ACTIVITY'] = time();

// Include database connection
require_once __DIR__ . '/../../config/database.php';

// Create a PDO instance
$database = new Database();
$pdo = $database->getConnection();

// Assuming the admin is logged in and their username is stored in the session
$username = $_SESSION['username']; // Adjust this based on how you store the username

// Prepare the SQL statement to prevent SQL injection
$stmt = $pdo->prepare("SELECT id, username, created_at, role FROM admin WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();

$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin) {
    echo "<h1>Admin Profile</h1>";
    echo "ID: " . htmlspecialchars($admin['id']) . "<br>";
    echo "Username: " . htmlspecialchars($admin['username']) . "<br>";
    echo "Password: <em>Stored securely (not displayed for security reasons)</em><br>";
    echo "Created At: " . htmlspecialchars($admin['created_at']) . "<br>";
    echo "Role: " . htmlspecialchars($admin['role']) . "<br>"; // Displaying the role
} else {
    echo "Admin not found.";
}
?>
