<?php
session_start();
require_once __DIR__ . '/../config/database.php'; // Include the database configuration

// Create a new instance of the Database class and establish the connection
$database = new Database();
$conn = $database->getConnection(); // Get the connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data and sanitize the input
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Validate input (you can extend this for more robust validation)
    if (empty($fullname) || empty($email) || empty($phone) || empty($address)) {
        $_SESSION['message'] = "All fields are required.";
        header('Location: ../views/user_profile.php');
        exit();
    }

    // Ensure the user is logged in
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message'] = "You must be logged in to update your profile.";
        header('Location: ../views/login.php');
        exit();
    }

    // Get the user ID from the session
    $user_id = $_SESSION['user_id']; 

    // Update user details in the database using a prepared statement
    $stmt = $conn->prepare("UPDATE users SET fullname = ?, email = ?, phone = ?, address = ? WHERE id = ?");

    // Execute the statement with the parameters as an array
    if ($stmt->execute([$fullname, $email, $phone, $address, $user_id])) {
        $_SESSION['message'] = "Profile updated successfully!";
    } else {
        $_SESSION['message'] = "Profile update failed: " . implode(", ", $stmt->errorInfo());
    }

    // Close the database connection (optional, PDO automatically handles it)
    $conn = null;

   // Redirect back to the profile page
   header('Location: ../app/views/user_profile.php');

    exit();
}
?>
