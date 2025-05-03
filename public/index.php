<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));

session_start();

require_once BASE_PATH . '/vendor/autoload.php';
require_once BASE_PATH . '/app/Helpers/config.php';
require_once BASE_PATH . '/app/Helpers/helpers.php';
require_once BASE_PATH . '/app/Services/BladeConfig.php';

// Load env
if (file_exists(BASE_PATH . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    $dotenv->load();
}

// Initialize DB
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

// Initialize the router ONCE here
$router = new \Bramus\Router\Router();

// Share common dependencies
$shared = [
    'blade' => $blade,
    'db' => $db,
    'router' => $router,
];

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');

// Load routes
require BASE_PATH . '/routes/web.php';
require BASE_PATH . '/routes/api.php';

// Run the router once
$router->run();
