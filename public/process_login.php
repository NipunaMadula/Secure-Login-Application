<?php 

// Set secure session cookie parameters
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '', 
    'secure' => true, 
    'httponly' => true, 
    'samesite' => 'Strict' 
]);

// Start the session
session_start();
require_once __DIR__ . '/../vendor/autoload.php'; // Load Composer's autoload file

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..'); // Path to the project root
$dotenv->load();

// Include necessary files
require_once '../config/database.php'; // Ensure this path is correct
require_once '../app/models/User.php'; // Ensure this path is correct

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize input
    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);

    // Check if fields are not empty
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php"); // Redirect to login page
        exit();
    }

    // Instantiate User model
    $userModel = new User();

    // Validate user credentials
    $user = $userModel->validateUserCredentials($username, $password);
    
    if ($user) {
        // Password is correct, set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname']; // Set fullname for user session
        $_SESSION['role'] = 'user'; // Set the role as 'user'

        // Redirect to user dashboard
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/user_dashboard.php");
        exit();
    }

    // If not found, check admin table
    $admin = $userModel->findAdminByUsername($username);

    $pepperl = $_ENV['PEPPER'];

    // Add pepper to the password
    $pepperedPasswordadmin = $password . $pepperl;
    
    if ($admin && password_verify($pepperedPasswordadmin, $admin['password'])) {
        // Password is correct, set session variables for the admin
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['username'] = $admin['username'];
        $_SESSION['fullname'] = $admin['fullname']; // Set fullname for admin session
        $_SESSION['role'] = 'admin'; // Set the role as 'admin'

        // Redirect to admin dashboard
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/admin_dashboard.php");
        exit();
    }

    // If no user or admin found, set an error message
    $_SESSION['error'] ="Ïnvalid Username or Password";
}

// Redirect back to login page if error occurs
header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php");
exit();

?>
