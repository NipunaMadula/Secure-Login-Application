<?php

require_once __DIR__ . '/../../config/database.php'; // Ensure this is the correct path for your database connection

class Admin
{
    private $db;

    public function __construct()
    {
        // Initialize the database connection
        $database = new Database(); // Create an instance of Database
        $this->db = $database->getConnection(); // Get the database connection from the instance
    }

    // Get all users
    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Promote a user to admin
    public function promoteUserToAdmin($userId)
    {
        // First, insert the user into the 'admin' table
        $query = "INSERT INTO admin (username, password) 
                  SELECT username, password FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $userId);

        if ($stmt->execute()) {
            // After successful insertion, delete the user from the 'users' table
            $deleteQuery = "DELETE FROM users WHERE id = :id";
            $deleteStmt = $this->db->prepare($deleteQuery);
            $deleteStmt->bindParam(':id', $userId);
            return $deleteStmt->execute();
        }

        return false; // Return false if the insertion failed
    }

    // Get a specific user's details
    public function getUserById($userId)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
