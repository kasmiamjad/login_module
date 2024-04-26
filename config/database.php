<?php


// Database configuration
$host = 'localhost';
$dbname = 'admin_panel';
$username = 'root';
$password = '';
$charset = 'utf8mb4';

// DSN - Data Source Name
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// PDO Options
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,       // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // Return associative arrays
    PDO::ATTR_EMULATE_PREPARES => false,               // Turn off emulation mode for "real" prepared statements
];

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $username, $password, $options);
    return $pdo;
} catch (PDOException $e) {
    // Handle error
    error_log("Connection error: " . $e->getMessage());
    die("Connection failed: " . $e->getMessage());
}
