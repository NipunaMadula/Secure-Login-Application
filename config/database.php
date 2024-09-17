<?php

// Load Composer's autoloader
require_once __DIR__ . '/../vendor/autoload.php'; 

// Load environment variables from the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Ensure the correct path to .env
$dotenv->load();

class Database {
    private $conn; // Property to hold the database connection

    // Function to get the database connection
    public function getConnection() {
        // Initialize the connection as null
        $this->conn = null; 

        try {
            // Construct the DSN using environment variables from the .env file
            $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8";

            // Create a new PDO connection with the DSN, username, and password
            $this->conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

            // Set PDO attributes for error handling and fetch modes
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            // Output connection error and stop execution
            echo "Connection error: " . $exception->getMessage();
            exit();
        }

        // Return the established database connection
        return $this->conn;
    }
}
