<?php

require_once __DIR__ . '/../../config/database.php'; // Correct path for Database class

class User
{
    private $db;

    // Constructor to initialize database connection
    public function __construct()
    {
        $database = new Database(); // Create an instance of Database
        $this->db = $database->getConnection(); // Get the connection from the instance
    }

    // Method to get user by ID
    public function getUserById($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to update user information
    public function updateUser($userId, $fullname, $email, $phone, $address)
    {
        $stmt = $this->db->prepare("UPDATE users SET fullname = ?, email = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([$fullname, $email, $phone, $address, $userId]);
    }

    // Method to find user by username
    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to find user by email (optional, if needed for email check)
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to register a new user
    public function register($fullname, $username, $email, $phone, $address, $password)
    {
        // Check if username or email already exists
        if ($this->findByUsername($username) || $this->findByEmail($email)) {
            return false; // User already exists
        }

        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Create a new user
        $stmt = $this->db->prepare("INSERT INTO users (fullname, username, email, phone, address, password) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$fullname, $username, $email, $phone, $address, $hashedPassword]);
    }

    // Method to verify user credentials for login
    public function login($username, $password)
    {
        $user = $this->findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user data if credentials are valid
        }
        return false; // Return false if credentials are invalid
    }
}
?>
