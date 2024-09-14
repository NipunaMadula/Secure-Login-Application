<?php
// Start the session
session_start();

// Include necessary files using relative paths
require_once __DIR__ . '/../config/database.php'; // Correct path to the database file
require_once __DIR__ . '/../app/models/User.php'; // Correct path to the User model

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize input
    $fullname = htmlspecialchars(trim($_POST['fullname']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if fields are not empty
    if (empty($fullname) || empty($username) || empty($email) || empty($phone) || empty($address) || empty($password) || empty($confirmPassword)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/register.php"); // Redirect back to register if any field is empty
        exit();
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/register.php"); // Redirect back to register if passwords do not match
        exit();
    }

    // Check password strength
    $passwordPattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/";
    if (!preg_match($passwordPattern, $password)) {
        $_SESSION['error'] = "Password must be at least 8 characters long and include uppercase, lowercase, a number, and a special character.";
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/register.php"); // Redirect back to register if password is weak
        exit();
    }

    // Instantiate User model
    $userModel = new User();
    
    // Check if username or email is already taken
    if ($userModel->findByUsername($username)) {
        $_SESSION['error'] = "Username is already taken.";
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/register.php"); // Redirect back to register if username is taken
        exit();
    }
    if ($userModel->findByEmail($email)) {
        $_SESSION['error'] = "Email is already registered.";
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/register.php"); // Redirect back to register if email is taken
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Save the user to the database
    try {
        // Use register method to create a user
        $userCreated = $userModel->register($fullname, $username, $email, $phone, $address, $hashedPassword);
        
        if ($userCreated) {
            $_SESSION['success'] = "You have successfully registered. Please log in.";
            header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php"); // Redirect to login after successful registration
            exit();
        } else {
            $_SESSION['error'] = "Registration failed. Please try again.";
            header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/register.php"); // Redirect back to register on failure
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "An error occurred: " . $e->getMessage();
        header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/register.php"); // Redirect back to register on error
        exit();
    }
}
?>
