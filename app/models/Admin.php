<?php

class Admin
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
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
        $query = "UPDATE users SET role = 'admin' WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
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
