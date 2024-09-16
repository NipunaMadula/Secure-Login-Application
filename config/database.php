<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Load Composer's autoloader

// Load environment variables from the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Correct path to the .env file
$dotenv->load();

class Database {
    private $conn;

    // Function to get the database connection
    public function getConnection() {
        $this->conn = null; // Initialize the connection as null

        try {
            // Create a new PDO connection using environment variables
            $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8"; // Ensure UTF-8 charset for compatibility
            $this->conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Default fetch mode for cleaner code

        } catch (PDOException $exception) {
            // Output connection error message
            echo "Connection error: " . $exception->getMessage();
            exit(); // Exit if there is a connection error
        }

        return $this->conn; // Return the connection
    }
}
?>