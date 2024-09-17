<?php 

require_once __DIR__ . '/../../config/database.php'; // Ensure correct path for Database class

class User
{
    private $db;

    // Constructor to initialize database connection
    public function __construct()
    {
        $database = new Database(); // Create a new Database instance
        $this->db = $database->getConnection(); // Get the database connection
    }

    // Method to get user by ID
    public function getUserById($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch and return user data
    }

    // Method to update user information
    public function updateUser($userId, $fullname, $email, $phone, $address)
    {
        $stmt = $this->db->prepare("UPDATE users SET fullname = :fullname, email = :email, phone = :phone, address = :address WHERE id = :id");

        // Bind parameters
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

        return $stmt->execute(); // Returns true on success, false on failure
    }

    // Method to check if the username exists
    public function usernameExists($username)
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false; // Return true if username exists
    }

    // Method to find user by email
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Return user data if found
    }

    // Method to register a new user
    public function register($fullname, $username, $email, $phone, $address, $password)
    {
        // Check if the username or email already exists
        if ($this->usernameExists($username) || $this->findByEmail($email)) {
            return false; // User already exists
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert new user
        $query = "INSERT INTO users (fullname, username, email, phone, address, password) 
                  VALUES (:fullname, :username, :email, :phone, :address, :password)";
        $stmt = $this->db->prepare($query);

        // Bind values
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':password', $hashedPassword); // Use the hashed password

        return $stmt->execute(); // Returns true on success, false on failure
    }

    // Method to validate user credentials
    public function validateUserCredentials($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user details if password is correct
        }
        return false; // Invalid username or password
    }

    // Method to find admin by username
    public function findAdminByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Return admin details if found
    }
}
