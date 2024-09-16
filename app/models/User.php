<?php 

require_once __DIR__ . '/../../config/database.php'; // Ensure correct path for Database class

class User
{
    private $db;

    // Constructor to initialize database connection
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Method to get user by ID
    public function getUserById($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $stmt->execute([$userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to update user information
    public function updateUser($userId, $fullname, $email, $phone, $address)
    {
        $stmt = $this->db->prepare("UPDATE users SET fullname = ?, email = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([$fullname, $email, $phone, $address, $userId]);
    }

    // Method to check if the username exists
    public function usernameExists($username) {
        // SQL query to check for the username in the users table
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC); // Return the user data
    }
    
    // Method to find user by email
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
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
        $query = "INSERT INTO users (fullname, username, email, phone, address, password) VALUES (:fullname, :username, :email, :phone, :address, :password)";
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
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return password_verify($password, $user['password']) ? $user : false;
        }
        return false;
    }

    // Method to find admin by username
    public function findAdminByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
