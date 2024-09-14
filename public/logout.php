<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page with a success message
header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php?message=Successfully logged out."); // Corrected path
exit();

