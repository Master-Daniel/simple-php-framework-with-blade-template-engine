<?php

// Enable error reporting (for development)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Define base path
define('BASE_PATH', dirname(__DIR__));

// Start session
session_start();

// Load Composer dependencies
require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . '/app/Helpers/config.php';
require BASE_PATH . '/app/Helpers/helpers.php';
require BASE_PATH . '/app/Services/BladeConfig.php';

// Load environment variables (if using .env)
if (file_exists(BASE_PATH . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    $dotenv->load();
}

// Initialize Database Connection
try {
    $db = new PDO(
        "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}


// Pass $blade and $db to routes
require BASE_PATH . '/routes/web.php';
